<?php
/**
 * Chargeur des traductions anglaises.
 *
 * Pourquoi des fichiers separes plutot que tout dans content-*.php : le
 * contenu francais fait deja plusieurs centaines de kilo-octets. Y ajouter
 * la traduction anglaise, l'arabe, puis les corrections de l'un ou de
 * l'autre, rendrait ces fichiers impossibles a relire et a comparer. Ici,
 * chaque langue a ses fichiers, indexes par cle stable de room : on peut
 * relire une traduction sans traverser le contenu, et savoir en un coup
 * d'oeil quelle room est traduite.
 *
 * Convention : un fichier par bloc de parcours, chacun renvoyant un tableau
 * `cle de room => array( 'title', 'excerpt', 'content', 'tasks' )` de la
 * meme forme que ce que le plugin stocke en meta.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Traduction anglaise d'une room, ou tableau vide.
 *
 * @param string $cle Cle stable de la room (`m3-01`, `univ-12`...).
 * @return array
 */
function seca_i18n_en( $cle ) {
	static $cache = array();

	$cle = (string) $cle;

	if ( '' === $cle ) {
		return array();
	}

	if ( isset( $cache[ $cle ] ) ) {
		return $cache[ $cle ];
	}

	/* Le bloc est le prefixe avant le tiret : `m3-01` -> `m3`. */
	$bloc = substr( $cle, 0, (int) strrpos( $cle, '-' ) );

	$fichiers = array(
		'demo'   => 'en-demo.php',
		'm3'     => 'en-m3.php',
		'univ'   => 'en-univ.php',
		'avance' => 'en-avance.php',
	);

	if ( ! isset( $fichiers[ $bloc ] ) ) {
		$cache[ $cle ] = array();

		return array();
	}

	$fichier = __DIR__ . '/' . $fichiers[ $bloc ];

	if ( ! file_exists( $fichier ) ) {
		$cache[ $cle ] = array();

		return array();
	}

	$toutes = include $fichier;

	if ( ! is_array( $toutes ) ) {
		$cache[ $cle ] = array();

		return array();
	}

	$cache[ $cle ] = isset( $toutes[ $cle ] ) && is_array( $toutes[ $cle ] ) ? $toutes[ $cle ] : array();

	return $cache[ $cle ];
}

/**
 * Nombre de rooms anglaises disponibles, par bloc. Sert au diagnostic :
 * « le fichier est-il charge, ou est-ce la fusion qui ne prend pas ? »
 *
 * @return array
 */
function seca_i18n_en_bilan() {
	$bilan    = array();
	$fichiers = glob( __DIR__ . '/en-*.php' );

	foreach ( (array) $fichiers as $fichier ) {
		$rooms = include $fichier;

		if ( is_array( $rooms ) ) {
			$bilan[ basename( $fichier, '.php' ) ] = count( $rooms );
		}
	}

	return $bilan;
}
