<?php
/**
 * Sonde : le reservoir reel, par SECTION (le « niveau »).
 *
 * Pourquoi par section et non par room ? parce que le moteur ne tire pas
 * dans la room : `Secura_Exam::pool()` fusionne la room avec toutes les
 * rooms de sa section. Une question ajoutee dans une room grossit donc le
 * reservoir de TOUS les examens de la section. Mesurer room par room
 * compte deux fois le meme besoin : c'est ce qui rendait la repartition
 * des imports trompeuse.
 *
 * Ce que la sonde produit, pour chaque section :
 *   - pool   : le reservoir commun a tous les examens de la section ;
 *   - besoin : la plus grande taille d'epreuve de la section, fois cinq
 *               (le contrat du moteur : un reservoir au moins cinq fois
 *               plus grand que l'epreuve) ;
 *   - manque : ce qu'il reste a ajouter pour que TOUS les examens de la
 *               section soient servis.
 *
 * Usage : SECA_WP_DIR=/chemin/vers/wordpress php scripts/audit/probe-sections.php
 *
 *        SECA_WP_DIR=/chemin/vers/wordpress \
 *          php scripts/audit/probe-sections.php --json > tools/cibles-sections.json
 *
 * Le mode « --json » ecrit la meme mesure dans un fichier que les
 * extracteurs d'import lisent (tools/repartition-themes.py). C'est la
 * mesure qui remplace la table figee des rooms : on ne repart plus
 * les questions importees au hasard, on les pose dans les sections dont
 * le reservoir reellement manque de questions.
 */
$seca_wp = getenv( 'SECA_WP_DIR' ) ? getenv( 'SECA_WP_DIR' ) : '/home/user/wp';
require_once $seca_wp . '/wp-load.php';

$rooms = get_posts(
	array(
		'post_type'   => 'secura_room',
		'numberposts' => -1,
		'orderby'     => 'menu_order',
		'order'       => 'ASC',
	)
);

/* Les rooms d'une section, et les sections vues depuis chaque parcours. */
$section_rooms = array();
$section_titre = array();

foreach ( get_posts( array( 'post_type' => 'secura_path', 'numberposts' => -1, 'post_status' => 'publish' ) ) as $parcours ) {
	$sections = get_post_meta( $parcours->ID, SECURA_META_PATH_SECTIONS, true );

	if ( ! is_array( $sections ) ) {
		continue;
	}

	foreach ( $sections as $index => $section ) {
		$liste = isset( $section['rooms'] ) ? array_map( 'absint', (array) $section['rooms'] ) : array();

		if ( empty( $liste ) ) {
			continue;
		}

		$cle = $parcours->post_name . ' :: ' . ( isset( $section['title'] ) ? $section['title'] : $index );

		foreach ( $liste as $id ) {
			$section_rooms[ $id ][] = $cle;
			$section_titre[ $cle ] = $cle;
		}
	}
}

$mesures = array();

foreach ( $rooms as $room ) {
	$taches = Secura_Rooms::get_tasks( $room->ID );

	foreach ( $taches as $index => $tache ) {
		if ( 'exam' !== $tache['type'] ) {
			continue;
		}

		$cle = isset( $section_rooms[ $room->ID ][0] ) ? $section_rooms[ $room->ID ][0] : 'sans-section :: ' . $room->post_name;

		if ( ! isset( $mesures[ $cle ] ) ) {
			$mesures[ $cle ] = array(
				'pool'    => 0,
				'epreuve' => 0,
				'examens' => array(),
				'rooms'   => array(),
			);
		}

		$pool    = Secura_Exam::pool_size( $room->ID, $index );
		$epreuve = count( $tache['questions'] );

		if ( $pool > $mesures[ $cle ]['pool'] ) {
			$mesures[ $cle ]['pool'] = $pool;
		}
		if ( $epreuve > $mesures[ $cle ]['epreuve'] ) {
			$mesures[ $cle ]['epreuve'] = $epreuve;
		}

		$mesures[ $cle ]['examens'][ $room->post_name ] = $epreuve;
		$mesures[ $cle ]['rooms'][ $room->post_name ]  = count( $tache['questions'] );
	}
}

$total = 0;
$json = in_array( '--json', $argv, true );

foreach ( $mesures as $cle => $mesure ) {
	$besoin = max( 10, $mesure['epreuve'] * 5 );
	$manque = max( 0, $besoin - $mesure['pool'] );

	$total += $manque;

	if ( ! $json ) {
		printf(
			"%-78s pool=%-3d epreuve_max=%-3d besoin=%-3d manque=%d\n",
			$cle,
			$mesure['pool'],
			$mesure['epreuve'],
			$besoin,
			$manque
		);
	}
}

if ( ! $json ) {
	echo "TOTAL MANQUE (par section) : ", $total, "\n";
}

/* ------------------------------------------------------------------ */
/* Le meme resultat, en JSON : c'est la mesure que lisent les         */
/* extracteurs d'import.                                              */
/* ------------------------------------------------------------------ */

if ( $json ) {
	$sortie = array(
		'mesure'   => gmdate( 'c' ),
		'total'    => $total,
		'sections' => array(),
	);

	foreach ( $mesures as $cle => $mesure ) {
		$besoin = max( 10, $mesure['epreuve'] * 5 );

		$sortie['sections'][ $cle ] = array(
			'pool'    => $mesure['pool'],
			'epreuve' => $mesure['epreuve'],
			'besoin'  => $besoin,
			'manque'  => max( 0, $besoin - $mesure['pool'] ),
			'examens' => $mesure['examens'],
			'rooms'   => $mesure['rooms'],
		);
	}

	echo json_encode( $sortie, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ), "\n";
}
