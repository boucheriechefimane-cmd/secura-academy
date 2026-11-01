<?php
/**
 * Harnais commun des audits externes.
 *
 * Chaque auditeur est un script PHP exécuté dans un vrai WordPress
 * (via « wp eval-file »). Le harnais leur donne :
 *
 *   - un compteur par gravité (bloquant, majeur, mineur, info) ;
 *   - une ligne de constat horodatée ;
 *   - un rapport Markdown + un résumé JSON, écrits dans docs/audits/.
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

$GLOBALS['seca_audit'] = array(
	'domaine'   => 'audit',
	'titre'     => 'Audit',
	'constats'  => array(),
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
 * @return bool
 */
function audit_verifier( $libelle, $condition, $detail = '', $gravite = 'mineur' ) {
	if ( $condition ) {
		$GLOBALS['seca_audit']['ok']++;

		printf( "  ok    %s\n", $libelle );

		return true;
	}

	$GLOBALS['seca_audit']['constats'][] = array(
		'libelle' => $libelle,
		'detail'  => $detail,
		'gravite' => $gravite,
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
function audit_info( $libelle, $detail = '' ) {
	$GLOBALS['seca_audit']['constats'][] = array(
		'libelle' => $libelle,
		'detail'  => $detail,
		'gravite' => 'info',
	);

	$GLOBALS['seca_audit']['info']++;

	printf( "  [INFO] %s%s\n", $libelle, ( '' !== $detail ? ' — ' . $detail : '' ) );
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

	file_put_contents(
		$dossier . '/' . $nom . '.json',
		wp_json_encode(
			array(
				'domaine'  => $a['domaine'],
				'titre'    => $a['titre'],
				'date'     => gmdate( 'c', $a['debut'] ),
				'ok'       => $a['ok'],
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

	printf( "Rapport : docs/audits/%s.md\n", $nom );

	return $a['bloquant'] > 0 ? 1 : 0;
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
