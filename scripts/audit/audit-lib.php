<?php
/**
 * Harnais commun des audits externes.
 *
 * Chaque auditeur est un script PHP exécuté dans un vrai WordPress
 * (via « wp eval-file »). Le harnais leur donne :
 *
 *   - un compteur par gravité (bloquant, majeur, mineur, info) ;
 *   - une ligne de constat horodatée ;
 *   - un rapport Markdown + un rapport HTML + un résumé JSON, écrits dans
 *     docs/audits/.
 *
 * LA RÈGLE DE LA PREUVE
 * ---------------------
 * Un auditeur n'a pas le droit de conclure sans preuve. Toute vérification
 * porte donc une preuve : un extrait de la page réellement servie, une ligne
 * de code avec son numéro, ou la sortie d'une commande. Le harnais refuse
 * d'enregistrer un constat sans preuve (il le classe alors « non étayé »),
 * et le rapport HTML reproduit la preuve mot pour mot. C'est ce qui sépare
 * un audit d'un avis : l'avis dit « ça pourrait être mieux », l'audit montre
 * la ligne de code et la mesure.
 *
 * Gravité (échelle de l'audit externe) :
 *   bloquant — le site est en danger ou inutilisable : à corriger avant toute mise en ligne ;
 *   majeur    — le problème gêne l'utilisateur ou casse une promesse faite dans la roadmap ;
 *   mineur    — à planifier ;
 *   info      — remarque, piste d'amélioration.
 *
 * Le script sort avec le code 1 si (et seulement si) il y a un constat
 * bloquant : la CI peut donc servir de barrière automatique.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/rapport-html.php';

$GLOBALS['seca_audit'] = array(
	'domaine'   => 'audit',
	'titre'     => 'Audit',
	'expert'    => '',
	'perimetre' => '',
	'constats'  => array(),
	'forces'    => array(),
	'scenarios' => array(),
	'ok'        => 0,
	'bloquant'  => 0,
	'majeur'    => 0,
	'mineur'    => 0,
	'info'      => 0,
	'debut'     => time(),
);

/**
 * Démarre un audit.
 *
 * @param string $domaine Identifiant court (seo, contenu, ux, dev, securite).
 * @param string $titre   Titre lisible du rapport.
 */
function audit_titre( $domaine, $titre ) {
	$GLOBALS['seca_audit']['domaine'] = $domaine;
	$GLOBALS['seca_audit']['titre']   = $titre;

	printf( "\n=== %s ===\n", $titre );
}

/**
 * Enregistre un contrôle.
 *
 * @param string $libelle   Ce qui est vérifié.
 * @param bool   $condition Résultat du contrôle.
 * @param string $detail    Détail utile en cas d'échec.
 * @param string $gravite   bloquant|majeur|mineur|info (quand l'échec compte).
 * @param string $preuve    La PREUVE : extrait servi, ligne de code, mesure.
 * @return bool
 */
function audit_verifier( $libelle, $condition, $detail = '', $gravite = 'mineur', $preuve = '' ) {
	if ( $condition ) {
		$GLOBALS['seca_audit']['ok']++;

		printf( "  ok    %s\n", $libelle );

		return true;
	}

	/* Un constat sans preuve n'est pas un constat : il est rejeté par le
	   harnais, et compté à part pour que le rapport le dise. */
	$etaye = ( '' !== trim( (string) $preuve ) );

	if ( ! $etaye ) {
		$GLOBALS['seca_audit']['constats'][] = array(
			'libelle' => $libelle,
			'detail'  => $detail,
			'gravite' => $gravite,
			'preuve'  => '',
			'etaye'   => false,
		);

		$GLOBALS['seca_audit']['non_etaye'] = $GLOBALS['seca_audit']['non_etaye'] + 1;

		printf( "  %-7s %s — [NON ÉTAYÉ : aucune preuve] %s\n", strtoupper( $gravite ), $libelle, ( '' !== $detail ? '— ' . $detail : '' ) );

		return false;
	}

	$GLOBALS['seca_audit']['constats'][] = array(
		'libelle' => $libelle,
		'detail'  => $detail,
		'gravite' => $gravite,
		'preuve'  => $preuve,
		'etaye'   => true,
	);

	if ( isset( $GLOBALS['seca_audit'][ $gravite ] ) ) {
		$GLOBALS['seca_audit'][ $gravite ]++;
	}

	printf( "  %-7s %s%s\n", '[' . strtoupper( $gravite ) . ']', $libelle, ( '' !== $detail ? ' — ' . $detail : '' ) );

	return false;
}

/**
 * Enregistre une remarque (sans échec).
 *
 * @param string $libelle Remarque.
 * @param string $detail  Détail.
 */
function audit_info( $libelle, $detail = '', $preuve = '' ) {
	$GLOBALS['seca_audit']['constats'][] = array(
		'libelle' => $libelle,
		'detail'  => $detail,
		'gravite' => 'info',
		'preuve'  => $preuve,
		'etaye'   => '' !== trim( (string) $preuve ),
	);

	$GLOBALS['seca_audit']['info']++;

	printf( "  [INFO] %s%s\n", $libelle, ( '' !== $detail ? ' — ' . $detail : '' ) );
}

/**
 * Identifie l'expert : son domaine et son périmètre exact.
 *
 * Un auditeur qui ne dit pas ce qu'il couvre (et ce qu'il ne couvre pas)
 * n'est pas impartial : son silence serait pris pour une garantie.
 *
 * @param string $expert    Nom du domaine d'expertise.
 * @param string $perimetre Ce qui est couvert, et ce qui ne l'est pas.
 */
function audit_expert( $expert, $perimetre ) {
	$GLOBALS['seca_audit']['expert']    = $expert;
	$GLOBALS['seca_audit']['perimetre'] = $perimetre;

	printf( "\n  Expert : %s\n", $expert );
	printf( "  Périmètre : %s\n", $perimetre );
}

/**
 * Enregistre une force constatée (et sa preuve).
 *
 * Un rapport qui ne dit que les défauts est injuste : il faut aussi dire
 * ce qui est bon, et le prouver de la même manière.
 *
 * @param string $libelle Ce qui est bon.
 * @param string $preuve  La preuve.
 */
function audit_force( $libelle, $preuve = '' ) {
	$GLOBALS['seca_audit']['forces'][] = array(
		'libelle' => $libelle,
		'preuve'  => $preuve,
	);

	printf( "  [FORCE] %s\n", $libelle );
}

/**
 * Enregistre un scénario réellement joué, avec sa sortie.
 *
 * C'est la trace d'exécution : le Comité peut vérifier qu'un scénario a
 * bien été joué, et relire ce qu'il a produit.
 *
 * @param string $nom    Nom du scénario.
 * @param string $resultat Ce que le scénario a donné (court).
 * @param string $sortie  La sortie brute (la preuve).
 */
function audit_scenario( $nom, $resultat, $sortie = '' ) {
	$GLOBALS['seca_audit']['scenarios'][] = array(
		'nom'     => $nom,
		'resultat'=> $resultat,
		'sortie'  => $sortie,
	);

	printf( "  [SCÉNARIO] %s → %s\n", $nom, $resultat );
}

/**
 * Termine l'audit : écrit le rapport et renvoie le code de sortie.
 *
 * @param string $dossier Dossier de sortie (docs/audits).
 * @return int
 */
function audit_fin( $dossier = null ) {
	$a = $GLOBALS['seca_audit'];

	$racine = dirname( dirname( dirname( __FILE__ ) ) );

	if ( null === $dossier ) {
		$dossier = $racine . '/docs/audits';
	}

	if ( ! is_dir( $dossier ) ) {
		wp_mkdir_p( $dossier );
	}

	$nom = $a['domaine'] . '-' . gmdate( 'Y-m-d', $a['debut'] );

	/* Le rapport Markdown : la même forme pour les cinq auditeurs. */
	$markdown  = "# " . $a['titre'] . "\n\n";
	$markdown .= "- **Date** : " . gmdate( 'd/m/Y H:i', $a['debut'] ) . " UTC\n";
	$markdown .= "- **Auditeur** : " . $a['domaine'] . "\n";
	$markdown .= "- **Contrôles réussis** : " . $a['ok'] . "\n";
	$markdown .= "- **Constats** : " . $a['bloquant'] . " bloquant(s), " . $a['majeur'] . " majeur(s), "
		. $a['mineur'] . " mineur(s), " . $a['info'] . " info(s)\n\n";

	if ( empty( $a['constats'] ) ) {
		$markdown .= "## Verdict\n\n**Conforme.** Aucun constat.\n";
	} else {
		$markdown .= "## Constats\n\n";

		foreach ( array( 'bloquant', 'majeur', 'mineur', 'info' ) as $niveau ) {
			$du_niveau = array();

			foreach ( $a['constats'] as $constat ) {
				if ( $constat['gravite'] === $niveau ) {
					$du_niveau[] = $constat;
				}
			}

			if ( empty( $du_niveau ) ) {
				continue;
			}

			$markdown .= "### " . ucfirst( $niveau ) . " (" . count( $du_niveau ) . ")\n\n";

			foreach ( $du_niveau as $constat ) {
				$markdown .= "- **" . $constat['libelle'] . "**";

				if ( '' !== $constat['detail'] ) {
					$markdown .= " — " . $constat['detail'];
				}

				$markdown .= "\n";
			}

			$markdown .= "\n";
		}

		$markdown .= "## Verdict\n\n";

		if ( $a['bloquant'] > 0 ) {
			$markdown .= "**Non conforme.** " . $a['bloquant'] . " constat(s) bloquant(s) : correction exigée avant mise en ligne.\n";
		} elseif ( $a['majeur'] > 0 ) {
			$markdown .= "**Réserves.** " . $a['majeur'] . " constat(s) majeur(s) à traiter avant la prochaine version.\n";
		} else {
			$markdown .= "**Conforme avec observations.** Aucun constat bloquant ni majeur.\n";
		}
	}

	file_put_contents( $dossier . '/' . $nom . '.md', $markdown );

	/* Le rapport HTML fait foi : il porte les preuves et les forces. */
	file_put_contents( $dossier . '/' . $nom . '.html', audit_html_rapport( $a ) );

	file_put_contents(
		$dossier . '/' . $nom . '.json',
		wp_json_encode(
			array(
				'domaine'   => $a['domaine'],
				'titre'     => $a['titre'],
				'expert'    => $a['expert'],
				'perimetre' => $a['perimetre'],
				'date'      => gmdate( 'c', $a['debut'] ),
				'ok'        => $a['ok'],
				'non_etaye' => isset( $a['non_etaye'] ) ? $a['non_etaye'] : 0,
				'forces'    => $a['forces'],
				'scenarios' => $a['scenarios'],
				'bloquant' => $a['bloquant'],
				'majeur'   => $a['majeur'],
				'mineur'   => $a['mineur'],
				'info'     => $a['info'],
				'constats' => $a['constats'],
			),
			JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
		)
	);

	printf(
		"\n%s : %d contrôle(s) réussi(s) — %d bloquant, %d majeur, %d mineur, %d info\n",
		$a['domaine'],
		$a['ok'],
		$a['bloquant'],
		$a['majeur'],
		$a['mineur'],
		$a['info']
	);

	printf( "Rapport : docs/audits/%s.html\n", $nom );

	/* IMPORTANT
	   On termine par exit() et non par return : quand un script est
	   lancé par « wp eval-file », la valeur renvoyée par return est
	   IGNORÉE par WP-CLI, et le code de sortie reste 0. La barrière
	   (run-audits.sh) repose pourtant sur ce code de sortie : sans
	   exit(), un constat bloquant ne bloquerait rien.
	   Vérifié le 01/11/2026 : « wp eval-file » avec « return 3 »
	   sort avec le code 0 ; avec « exit(7) » il sort avec le code 7. */
	exit( $a['bloquant'] > 0 ? 1 : 0 );
}

/**
 * Cherche une chaîne dans tous les fichiers d'un dossier.
 *
 * @param string $dossier Dossier à parcourir.
 * @param string $motif   Motif (expression régulière).
 * @param string $extension Extension à filtrer (sans point).
 * @return array Tableau de « fichier:ligne:contenu ».
 */
function audit_chercher( $dossier, $motif, $extension = 'php' ) {
	$trouves = array();

	if ( ! is_dir( $dossier ) ) {
		return $trouves;
	}

	$files = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $dossier, FilesystemIterator::SKIP_DOTS ) );

	foreach ( $files as $fichier ) {
		if ( ! $fichier->isFile() ) {
			continue;
		}

		if ( $extension && pathinfo( $fichier->getFilename(), PATHINFO_EXTENSION ) !== $extension ) {
			continue;
		}

		$lignes = file( $fichier->getPathname(), FILE_IGNORE_NEW_LINES );

		if ( false === $lignes ) {
			continue;
		}

		foreach ( $lignes as $numero => $ligne ) {
			if ( preg_match( $motif, $ligne ) ) {
				$trouves[] = $fichier->getPathname() . ':' . ( $numero + 1 ) . ':' . trim( $ligne );
			}
		}
	}

	return $trouves;
}

/**
 * Renvoie le contenu d'une ligne précise d'un fichier.
 *
 * @param string $chemin  Chemin du fichier.
 * @param int    $numero  Numéro de ligne (1 = première).
 * @return string
 */
function audit_ligne( $chemin, $numero ) {
	$lignes = @file( $chemin, FILE_IGNORE_NEW_LINES );

	if ( false === $lignes || ! isset( $lignes[ $numero - 1 ] ) ) {
		return '';
	}

	return $lignes[ $numero - 1 ];
}

/**
 * Exécute une commande shell et renvoie sa sortie.
 *
 * @param string $commande Commande.
 * @return string Sortie (vide si la commande échoue).
 */
function audit_exec( $commande ) {
	$sortie = array();
	$code   = 0;

	exec( $commande . ' 2>/dev/null', $sortie, $code );

	if ( 0 !== $code ) {
		return '';
	}

	return implode( "\n", $sortie );
}
