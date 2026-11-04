<?php
/**
 * Empreinte des QUESTIONS normalisees, room par room et tache par
 * tache.
 *
 * Sert de reference de non-regression : apres une correction, seule la
 * TAILLE de la tache « test » doit avoir change ; le contenu doit etre
 * identique. L'empreinte du reservoir (pool) est l'autre piece :
 * `scripts/mesures/empreinte-reservoir.php`.
 *
 * Usage :
 *   SECA_WP_DIR=/home/user/wp php scripts/mesures/empreinte-questions.php > avant.tsv
 *   ... la correction ...
 *   SECA_WP_DIR=/home/user/wp php scripts/mesures/empreinte-questions.php > apres.tsv
 *   diff avant.tsv apres.tsv
 */
$seca_wp = getenv( 'SECA_WP_DIR' ) ? getenv( 'SECA_WP_DIR' ) : '/home/user/wp';
require_once $seca_wp . '/wp-load.php';

$rooms = get_posts( array( 'post_type' => 'secura_room', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );

foreach ( $rooms as $room ) {
	$taches = Secura_Rooms::get_tasks( $room->ID );

	foreach ( $taches as $index => $tache ) {
		$empreintes = array();

		foreach ( $tache['questions'] as $q ) {
			$empreintes[] = md5(
				$q['question'] . '|'
				. $q['mode'] . '|'
				. implode( '/', (array) $q['choices'] ) . '|'
				. (int) $q['correct'] . '|'
				. $q['explanation'] . '|'
				. $q['source']
			);
		}

		printf(
			"%s\t%d\t%d\t%s\n",
			$room->post_name,
			$index,
			count( $tache['questions'] ),
			md5( implode( ',', $empreintes ) )
		);
	}
}
