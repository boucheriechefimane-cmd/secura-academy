<?php
/**
 * Les écritures « étrangères » et la règle qui les autorise.
 *
 * Un caractère d'une autre écriture placé dans un mot latin est
 * invisible à l'écran, mais casse la recherche du site : c'est le
 * défaut trouvé en v0.8.1 (un mot en coréen dans la politique de
 * confidentialité). L'audit « multilingue » interdit donc ces
 * caractères dans le code et dans le contenu rédigé.
 *
 * Exception : les questions IMPORTÉES sont reproduites mot pour mot.
 * Un examen de mathématiques contient des symboles grecs (lambda,
 * Gamma) qui font partie de l'énoncé ; réécrire l'énoncé pour
 * supprimer une lambda reviendrait à modifier un contenu protégé.
 * Le grec est donc toléré — et lui seul — dans les fichiers de
 * questions importées. Toutes les autres écritures restent
 * interdites partout, import compris.
 *
 * Ce fichier est la source unique : l'audit l'utilise, et les tests
 * automatiques (tests/smoke-test.php) le vérifient dans les deux
 * sens, pour qu'une correction future ne puisse pas affaiblir la
 * détection sans que la CI le voie.
 */

/**
 * Les écritures à surveiller.
 *
 * @return array<string,string> Motif PCRE => nom de l'écriture.
 */
function seca_ecritures_surveillees() {
	return array(
		'cyrillique' => '/[\x{0400}-\x{04FF}\x{0500}-\x{052F}]/u',
		'grecque'    => '/[\x{0370}-\x{03FF}\x{1F00}-\x{1FFF}]/u',
		'han'        => '/[\x{3400}-\x{4DBF}\x{4E00}-\x{9FFF}\x{F900}-\x{FAFF}]/u',
		'hiragana'   => '/[\x{3040}-\x{309F}]/u',
		'katakana'   => '/[\x{30A0}-\x{30FF}]/u',
		'hangul'     => '/[\x{AC00}-\x{D7AF}\x{1100}-\x{11FF}\x{3130}-\x{318F}]/u',
		'devanagari' => '/[\x{0900}-\x{097F}]/u',
		'thaï'       => '/[\x{0E00}-\x{0E7F}]/u',
		'hebreu'     => '/[\x{0590}-\x{05FF}]/u',
	);
}

/**
 * Le fichier contient-il des questions importées mot pour mot ?
 *
 * @param string $fichier Chemin du fichier.
 * @return bool
 */
function seca_est_contenu_importe( $fichier ) {
	return (bool) preg_match( '/content-import-.*\.php$/', (string) $fichier );
}

/**
 * Les écritures réellement interdites dans un fichier donné.
 *
 * @param string $fichier Chemin du fichier.
 * @return array<string,string> Motif PCRE => nom de l'écriture.
 */
function seca_ecritures_interdites( $fichier ) {
	$ecritures = seca_ecritures_surveillees();

	if ( seca_est_contenu_importe( $fichier ) ) {
		unset( $ecritures['grecque'] );
	}

	return $ecritures;
}

/**
 * Les caractères d'une écriture étrangère trouvés dans un contenu.
 *
 * C'est LA fonction de référence : l'audit s'en sert pour verdir, et
 * les tests automatiques l'interrogent pour vérifier que la règle
 * tient toujours (et qu'on ne peut pas l'affaiblir en silence).
 *
 * @param string $contenu Contenu à inspecter.
 * @param string $fichier Chemin du fichier (pour savoir s'il est importé).
 * @return array<int,array<string,mixed>> Liste des intrusions.
 */
function seca_caracteres_etrangers( $contenu, $fichier ) {
	$intrusions = array();

	foreach ( seca_ecritures_interdites( $fichier ) as $nom => $motif ) {
		if ( preg_match_all( $motif, $contenu, $trouves, PREG_OFFSET_CAPTURE ) ) {
			foreach ( $trouves[0] as $trouve ) {
				$intrusions[] = array(
					'ecriture' => $nom,
					'caractere' => $trouve[0],
					'position'  => $trouve[1],
				);
			}
		}
	}

	return $intrusions;
}
