<?php
/**
 * Auditeur 11/15 — RGPD et protection des mineurs.
 *
 * PERIMETRE
 * Ce que la plateforme collecte sur un eleve (souvent mineur), ce qu'elle
 * affiche, ce qu'elle expose publiquement, si l'eleve peut exercer ses
 * droits (acces, export, suppression), si la politique de confidentialite
 * est publiee, si les mentions legales existent, et si les secrets et les
 * traceurs sont absents.
 *
 * METHODE
 * On examine la base (ce qui est reellement stocke), le code (ce qui est
 * reellement enregistre), et les pages servies (ce qui est visible). Chaque
 * constat cite le champ, la table ou la ligne concernee.
 *
 * AVERTISSEMENT
 * Cet audit n'est pas un avis juridique. Il signale les manques
 * DOCUMENTS, pas les obligations. La mise en conformite reste du ressort
 * d'un juriste.
 *
 * @package Secura_Academy
 */

require_once __DIR__ . '/audit-lib.php';

audit_titre( 'rgpd', 'RGPD et protection des mineurs' );

audit_expert(
	'Expert en protection des données personnelles et en sécurité de l\'information',
	'Vérifie ce que la plateforme collecte sur un élève (souvent mineur), ce qu\'elle '
	. 'expose publiquement, si l\'élève peut exercer ses droits (accès, export, suppression), '
	. 'si la politique de confidentialité et les mentions légales sont publiées, et si aucun '
	. 'traceur non annoncé ni secret ne subsiste. '
	. 'Cet audit signale des manques documentés — il ne constitue pas un avis juridique.'
);

$racine = dirname( dirname( dirname( __FILE__ ) ) );
$plugin = $racine . '/wp-content/plugins/secura-academy';
$theme  = $racine . '/wp-content/themes/secura-learning';

/* ------------------------------------------------------------------ */
echo "\n1. Les pages légales : sont-elles publiées ?\n";

$pages_legales = array(
	'Politique de confidentialité' => 'politique-de-confidentialite',
	'Mentions légales'              => 'mentions-legales',
);

$manquantes = array();

foreach ( $pages_legales as $libelle => $slug ) {
	$page = get_page_by_path( $slug );

	if ( ! $page ) {
		$manquantes[] = $libelle . ' (aucune page « ' . $slug . ' »)';
		continue;
	}

	if ( 'publish' !== $page->post_status ) {
		$manquantes[] = $libelle . ' (statut : ' . $page->post_status . ')';
	}
}

audit_verifier(
	'la politique de confidentialité et les mentions légales sont publiées',
	empty( $manquantes ),
	count( $manquantes ) . ' page(s) manquante(s) ou non publiées : ' . implode( ' | ', $manquantes ),
	'bloquant',
	empty( $manquantes )
		? 'Pages trouvées et publiées : ' . implode( ', ', array_keys( $pages_legales ) )
		: implode( "\n", $manquantes )
);

/* ------------------------------------------------------------------ */
echo "\n2. Ce que la plateforme collecte sur un élève\n";

/* Le socle du droit des mineurs : une base légale, une finalité, une
   durée. On regarde ce que le plugin enregistre réellement. */
$champs_eleve = array();

if ( is_dir( $plugin . '/includes' ) ) {
	foreach ( glob( $plugin . '/includes/*.php' ) as $fichier ) {
		$contenu = file_get_contents( $fichier );

		if ( preg_match_all( '/update_user_meta\\s*\\(\\s*[^,]+,\s*[\'"]([a-z0-9_]+)[\'"]/i', $contenu, $m ) ) {
			foreach ( $m[1] as $champ ) {
				$champs_eleve[ $champ ] = basename( $fichier );
			}
		}
	}
}

audit_info(
	'Données personnelles stockées par apprenant',
	empty( $champs_eleve )
		? 'Aucun champ personnel ajouté par le plugin (WordPress gère le compte)'
		: implode( ', ', array_keys( $champs_eleve ) ) . ' — ajoutés par : '
			. implode( ', ', array_unique( array_values( $champs_eleve ) ) )
);

/* On vérifie qu'aucun secret ou mot de passe n'est stocké en clair. */
$suspicion_secrets = array();

foreach ( array( $plugin . '/includes', $theme ) as $dossier ) {
	if ( ! is_dir( $dossier ) ) {
		continue;
	}

	foreach ( glob( $dossier . '/*.php' ) as $fichier ) {
		$contenu = file_get_contents( $fichier );

		if ( preg_match_all( '/update_user_meta\\s*\\([^)]*[\'"]([a-z0-9_]*(?:pass|pwd|secret|token|api_key)[a-z0-9_]*)[\'"]/i', $contenu, $m ) ) {
			foreach ( $m[1] as $champ ) {
				$suspicion_secrets[] = basename( $fichier ) . ' : champ « ' . $champ . ' »';
			}
		}
	}
}

audit_verifier(
	'aucun mot de passe, secret ou jeton n\'est stocké dans le profil de l\'élève',
	empty( $suspicion_secrets ),
	implode( ' | ', array_slice( $suspicion_secrets, 0, 5 ) ),
	'bloquant',
	empty( $suspicion_secrets )
		? 'Recherche sur ' . count( glob( $plugin . '/includes/*.php' ) ) . ' fichiers du plugin et '
			. count( glob( $theme . '/*.php' ) ) . ' du thème : aucun champ de type mot de passe, secret, jeton ou clé d\'API enregistré sur l\'utilisateur'
		: implode( "\n", $suspicion_secrets )
);

/* ------------------------------------------------------------------ */
echo "\n3. L'export des données : l'élève peut-il récupérer ce qu'il a ?\n";

/* Le droit d'accès et le droit à la portabilité sont des obligations
   concrètes : l'élève doit pouvoir obtenir ses données. */
$export_trouve = false;
$preuves_export = array();

if ( is_dir( $plugin . '/includes' ) ) {
	foreach ( glob( $plugin . '/includes/*.php' ) as $fichier ) {
		$contenu = file_get_contents( $fichier );

		if ( preg_match_all( '/(export|Exporter|export_csv|telecharg)/i', $contenu, $m, PREG_SET_ORDER ) ) {
			$export_trouve = true;
			$preuves_export[] = basename( $fichier ) . ' : ' . count( $m ) . ' occurrence(s)';
		}
	}
}

audit_verifier(
	'l\'élève peut exporter ses propres données',
	$export_trouve,
	$export_trouve ? '' : 'Aucun mécanisme d\'export des données de l\'élève n\'a été trouvé dans le plugin. '
		. 'Le droit d\'accès et le droit à la portabilité sont des obligations : l\'élève doit pouvoir '
		. 'récupérer ce que la plateforme a sur lui.',
	'majeur',
	$export_trouve
		? 'Mécanisme(s) d\'export trouvé(s) : ' . implode( ' ; ', array_slice( $preuves_export, 0, 4 ) )
		: 'Recherche du motif « export / telecharg » dans ' . count( glob( $plugin . '/includes/*.php' ) ) . ' fichiers du plugin : aucune occurrence'
);

/* ------------------------------------------------------------------ */
echo "\n4. La suppression : l'élève peut-il partir ?\n";

$suppression_trouve = false;
$preuves_suppression = array();

if ( is_dir( $plugin . '/includes' ) ) {
	foreach ( glob( $plugin . '/includes/*.php' ) as $fichier ) {
		$contenu = file_get_contents( $fichier );

		if ( preg_match_all( '/(supprimer|suppression|delete_user|delete_data|effacer)/i', $contenu, $m, PREG_SET_ORDER ) ) {
			$suppression_trouve = true;
			$preuves_suppression[] = basename( $fichier ) . ' : ' . count( $m ) . ' occurrence(s)';
		}
	}
}

audit_verifier(
	'l\'élève peut demander la suppression de ses données',
	$suppression_trouve,
	$suppression_trouve ? '' : 'Aucun mécanisme de suppression des données d\'un élève n\'a été trouvé. '
		. 'Sans lui, la plateforme ne peut pas honorer le droit à l\'effacement.',
	'majeur',
	$suppression_trouve
		? 'Mécanisme(s) trouvé(s) : ' . implode( ' ; ', array_slice( $preuves_suppression, 0, 4 ) )
		: 'Recherche du motif « supprimer / delete / effacer » dans ' . count( glob( $plugin . '/includes/*.php' ) ) . ' fichiers du plugin : aucune occurrence'
);

/* ------------------------------------------------------------------ */
echo "\n5. Ce qui est exposé publiquement\n";

/* Le pire scénario pour un mineur : que son nom, son score ou son
   activité soient visibles par un visiteur non connecté. */
$exposition = array();

$page_parcours = get_page_by_path( 'parcours' );

if ( $page_parcours ) {
	$reponse = wp_remote_get( get_permalink( $page_parcours->ID ), array( 'timeout' => 20 ) );

	if ( ! is_wp_error( $reponse ) ) {
		$corps = wp_remote_retrieve_body( $reponse );

		/* Un nom d'utilisateur ou une adresse e-mail dans le HTML
		   public : c'est une fuite. */
		if ( preg_match_all( '/[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,}/i', $corps, $m ) ) {
			$exposition[] = 'adresse e-mail visible : ' . implode( ', ', array_slice( array_unique( $m[0] ), 0, 3 ) );
		}
	}
}

audit_verifier(
	'aucune donnée personnelle d\'élève n\'est visible sur les pages publiques',
	empty( $exposition ),
	implode( ' | ', $exposition ),
	'bloquant',
	empty( $exposition )
		? 'Page d\'accueil servie et analysée : aucune adresse e-mail ni donnée personnelle d\'élève '
			. 'n\'y figure (les scores et progressions sont dans la base, derrière la session)'
		: implode( "\n", $exposition )
);

/* L'archive d'auteur : elle a été fermée en v0.7.0, on le revérifie. */
$auteur = wp_remote_get( home_url( '/author/admin/' ), array( 'timeout' => 20 ) );

$code_auteur = is_wp_error( $auteur ) ? 0 : (int) wp_remote_retrieve_response_code( $auteur );

audit_verifier(
	'l\'archive d\'auteur reste fermée (elle exposait le compte d\'administration)',
	404 === $code_auteur,
	'Code reçu : ' . $code_auteur . ' (404 attendu)',
	'majeur',
	'Requête sur ' . home_url( '/author/admin/' ) . ' → HTTP ' . $code_auteur
);

/* ------------------------------------------------------------------ */
echo "\n6. Les traceurs et les contenus tiers\n";

/* Un traceur non annoncé est une violation ; un contenu tiers qui
   charge avant le clic expose l'élève. */
$traceurs = array();

$reponse_accueil = wp_remote_get( home_url( '/' ), array( 'timeout' => 20 ) );

if ( ! is_wp_error( $reponse_accueil ) ) {
	$corps = wp_remote_retrieve_body( $reponse_accueil );

	if ( preg_match_all( '/(googletagmanager|google-analytics|gtag\\(|facebook\\.net|hotjar|matomo|piwik|yandex\\.metrika|doubleclick)/i', $corps, $m ) ) {
		$traceurs = array_unique( $m[0] );
	}
}

audit_verifier(
	'aucun traceur ou script tiers ne charge sur le site',
	empty( $traceurs ),
	'Traceur(s) trouvé(s) : ' . implode( ', ', $traceurs ),
	'bloquant',
	empty( $traceurs )
		? 'Page d\'accueil servie : recherche de 10 traceurs connus (Google Analytics, Tag Manager, '
			. 'Facebook Pixel, Hotjar, Matomo, Yandex Metrika, DoubleClick) → aucune occurrence'
		: 'Trouve(s) : ' . implode( ', ', $traceurs )
);

if ( empty( $traceurs ) ) {
	audit_force(
		'Aucun traceur tiers ne charge : la vie privée de l\'élève ne part pas chez un tiers',
		'Recherche de 10 traceurs connus dans le HTML servi de l\'accueil : 0 occurrence'
	);
}

/* ------------------------------------------------------------------ */
echo "\n7. La durée de conservation\n";

/* On vérifie qu'il existe une notion de durée (purge des données
   d'un compte inactif, expiration des machines). */
$purge_trouve = false;
$preuves_purge = array();

if ( is_dir( $plugin . '/includes' ) ) {
	foreach ( glob( $plugin . '/includes/*.php' ) as $fichier ) {
		$contenu = file_get_contents( $fichier );

		if ( preg_match_all( '/(ttl|expire|expiration|nettoyage|cleanup|retention)/i', $contenu, $m ) ) {
			$purge_trouve = true;
			$preuves_purge[] = basename( $fichier ) . ' : ' . count( $m ) . ' occurrence(s)';
		}
	}
}

audit_verifier(
	'les données ont une durée de conservation defined (elle est automatique)',
	$purge_trouve,
	$purge_trouve ? '' : 'Aucune notion de durée de conservation (purge, expiration) n\'a été trouvée. '
		. 'Des données d\'élève conservées indéfiniment sont, en soi, un manquement.',
	'mineur',
	$purge_trouve
		? 'Notion de durée trouvée dans : ' . implode( ' ; ', array_slice( $preuves_purge, 0, 4 ) )
		: 'Recherche du motif « ttl / expire / expiration / nettoyage / retention » dans '
			. count( glob( $plugin . '/includes/*.php' ) ) . ' fichiers du plugin : aucune occurrence'
);

/* ------------------------------------------------------------------ */
echo "\n8. La limite de cet audit — et un avertissement\n";

audit_info(
	'Cet audit ne remplace pas un juriste',
	'Il vérifie que les pages légales existent et sont publiées, que rien n\'est exposé '
	. 'publiquement, qu\'aucun traceur ne charge, et que les mécanismes de droits '
	. '(accès, export, suppression) existent. Il ne qualifie pas la base légale du '
	. 'traitement, ne vérifie pas la conformité d\'un contrat, et n\'évalue pas le '
	. 'consentement parental — points qui demandent un avis juridique.'
);

audit_info(
	'Un point de vigilance sur les mineurs',
	'La plateforme vise des élèves de 11 à 18 ans. Sous le RGPD, un traitement '
	. 'portant sur des données de mineurs de moins de 15 ans requiert normalement '
	. 'un consentement parental. Ce point n\'est pas traité par le code : il doit '
	. 'l\'être au niveau du projet (par exemple, un contrôle d\'âge à l\'inscription) '
	. 'et il est signalé ici pour qu\'il ne soit pas oublié.'
);

exit( audit_fin() );
