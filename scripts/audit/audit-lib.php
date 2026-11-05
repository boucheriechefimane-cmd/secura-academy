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
 * La barrière échoue pour un échec bloquant ou majeur, même si la preuve
 * manque : un audit incomplet ne doit jamais passer au vert par défaut.
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
	'constats_non_etayes' => array(),
	'forces'    => array(),
	'scenarios' => array(),
	'ok'        => 0,
	'bloquant'  => 0,
	'majeur'    => 0,
	'mineur'    => 0,
	'info'      => 0,
	'non_etaye' => 0,
	'debut'     => time(),
);

/**
 * Normalise un texte pour comparer deux écritures de la même chose.
 *
 * Le HTML servi et le JSON publié n'écrivent pas tout à fait de la même
 * façon : WordPress transforme les apostrophes droites en apostrophes
 * typographiques (’), et le HTML les échappe en &#8217;. Comparer les
 * deux chaînes brutalement produit donc un FAUX POSITIF : le titre est
 * bien à l'écran, mais l'octet diffère.
 *
 * On ramène donc les deux textes à la même forme : entités décodées,
 * apostrophes unifiées, espaces réduits. On ne compare toujours que le
 * texte — un titre vraiment différent reste détecté.
 *
 * @param string $texte Le texte à normaliser.
 * @return string
 */
function audit_normaliser_texte( $texte ) {
	$texte = html_entity_decode( (string) $texte, ENT_QUOTES | ENT_HTML5, 'UTF-8' );

	/* Apostrophes typographiques et guillemets : on ramène à l'apostrophe
	   droite, comme dans la source du contenu. */
	$texte = str_replace(
		array( "\xe2\x80\x99", "\xe2\x80\x98", "\xe2\x80\x9b", "\xe2\x80\x9c", "\xe2\x80\x9d" ),
		array( "'", "'", "'", '"', '"' ),
		$texte
	);

	$texte = preg_replace( '/\s+/u', ' ', $texte );

	return trim( (string) $texte );
}

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
		$GLOBALS['seca_audit']['constats_non_etayes'][] = array(
			'libelle' => $libelle,
			'detail'  => $detail,
			'gravite' => $gravite,
			'preuve'  => '',
			'etaye'   => false,
		);

		$GLOBALS['seca_audit']['non_etaye'] = $GLOBALS['seca_audit']['non_etaye'] + 1;

		/* On n'affiche pas la gravite seule : « BLOQUANT » en majuscules
		   ferait croire a un constat bloque, alors que le harnais vient
		   de le rejeter. La gravite annoncee reste lisible, mais le
		   statut « non etaye » passe devant. */
		printf( "  [NON ÉTAYÉ] (%s) %s%s\n", strtoupper( $gravite ), $libelle, ( '' !== $detail ? ' — ' . $detail : '' ) );

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

	printf( "  [SCÉNARIO] %s : %s\n", $nom, $resultat );
}

/**
 * Nombre d'échecs sans preuve dont la gravité annoncée bloque la CI.
 *
 * Ils ne sont pas présentés comme des constats établis : ils indiquent
 * qu'un contrôle important a échoué sans que l'audit puisse le prouver.
 *
 * @param array $a État de l'audit.
 * @return int
 */
function audit_non_etayes_graves( $a ) {
	$nombre = 0;

	foreach ( isset( $a['constats_non_etayes'] ) ? $a['constats_non_etayes'] : array() as $constat ) {
		if ( in_array( $constat['gravite'], array( 'bloquant', 'majeur' ), true ) ) {
			$nombre++;
		}
	}

	return $nombre;
}

/**
 * Détermine l'état de la barrière, y compris les contrôles incomplets.
 *
 * @param array $a État de l'audit.
 * @return bool
 */
function audit_barriere_bloquee( $a ) {
	return $a['bloquant'] > 0 || $a['majeur'] > 0 || audit_non_etayes_graves( $a ) > 0;
}

/**
 * Libellé et explication communs aux rapports HTML et Markdown.
 *
 * @param array $a État de l'audit.
 * @return array
 */
function audit_verdict( $a ) {
	if ( $a['bloquant'] > 0 ) {
		return array( 'libelle' => 'Non conforme', 'phrase' => $a['bloquant'] . ' constat(s) bloquant(s) : correction exigée avant mise en ligne.', 'couleur' => '#b3261e' );
	}
	if ( $a['majeur'] > 0 ) {
		return array( 'libelle' => 'Réserves', 'phrase' => $a['majeur'] . ' constat(s) majeur(s) à traiter avant la prochaine version.', 'couleur' => '#9a5b00' );
	}
	if ( ! empty( $a['constats_non_etayes'] ) ) {
		return array( 'libelle' => 'Audit incomplet', 'phrase' => 'Des contrôles ont échoué sans preuve ; leur résultat doit être vérifié.', 'couleur' => '#9a5b00' );
	}
	if ( empty( $a['constats'] ) ) {
		return array( 'libelle' => 'Conforme', 'phrase' => 'Aucun constat.', 'couleur' => '#1b7f4b' );
	}

	return array( 'libelle' => 'Conforme avec observations', 'phrase' => 'Aucun constat bloquant ni majeur.', 'couleur' => '#1b7f4b' );
}

/**
 * Termine l'audit : écrit les rapports et termine avec le code de sortie.
 *
 * @param string $dossier Dossier de sortie (docs/audits).
 * @return void
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

	$verdict = audit_verdict( $a );
	$non_etayes_graves = audit_non_etayes_graves( $a );

	/* Le rapport Markdown distingue les constats prouvés des échecs à étayer. */
	$markdown  = "# " . $a['titre'] . "\n\n";
	$markdown .= "- **Date** : " . gmdate( 'd/m/Y H:i', $a['debut'] ) . " UTC\n";
	$markdown .= "- **Auditeur** : " . $a['domaine'] . "\n";
	$markdown .= "- **Contrôles réussis** : " . $a['ok'] . "\n";
	$markdown .= "- **Constats retenus** : " . $a['bloquant'] . " bloquant(s), " . $a['majeur'] . " majeur(s), "
		. $a['mineur'] . " mineur(s), " . $a['info'] . " info(s)\n";
	$markdown .= "- **Échecs non étayés** : " . $a['non_etaye'] . "\n";
	$markdown .= "- **Barrière** : " . ( audit_barriere_bloquee( $a ) ? 'échec' : 'réussite' ) . "\n\n";

	if ( ! empty( $a['constats'] ) ) {
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
	}

	if ( ! empty( $a['constats_non_etayes'] ) ) {
		$markdown .= "## Échecs non étayés (" . count( $a['constats_non_etayes'] ) . ")\n\n";
		$markdown .= "Ces contrôles ont échoué mais ne constituent pas des constats établis sans preuve.\n\n";
		foreach ( $a['constats_non_etayes'] as $constat ) {
			$markdown .= "- **" . $constat['libelle'] . "** (gravité annoncée : " . $constat['gravite'] . ")";
			if ( '' !== $constat['detail'] ) {
				$markdown .= " — " . $constat['detail'];
			}
			$markdown .= "\n";
		}
		$markdown .= "\n";
	}

	$markdown .= "## Verdict\n\n**" . $verdict['libelle'] . ".** " . $verdict['phrase'] . "\n";
	if ( $non_etayes_graves > 0 ) {
		$markdown .= "\nLa barrière échoue : " . $non_etayes_graves . " contrôle(s) bloquant(s) ou majeur(s) sont non étayés.\n";
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
				'non_etaye' => $a['non_etaye'],
				'barriere_bloquee' => audit_barriere_bloquee( $a ),
				'constats_non_etayes' => $a['constats_non_etayes'],
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
		"\n%s : %d contrôle(s) réussi(s) — %d bloquant, %d majeur, %d mineur, %d info, %d non étayé(s)\n",
		$a['domaine'],
		$a['ok'],
		$a['bloquant'],
		$a['majeur'],
		$a['mineur'],
		$a['info'],
		$a['non_etaye']
	);

	printf( "Rapport : docs/audits/%s.html\n", $nom );

	/* WP-CLI ignore un return de eval-file : exit est indispensable pour
	   transmettre le résultat au lanceur et à la CI. Un échec grave non
	   étayé bloque aussi, sans être compté comme constat prouvé. */
	exit( audit_barriere_bloquee( $a ) ? 1 : 0 );
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
