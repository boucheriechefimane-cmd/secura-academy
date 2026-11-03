<?php
/**
 * Empreinte du RESERVOIR (le pool) de chaque room, dans l'ordre
 * exact ou le moteur les puise.
 *
 * Le reservoir est ce qui fait que deux eleves n'ont jamais la
 * meme epreuve. Toute la correction doit le laisser STRICTEMENT
 * identique : seuls les points de controle (taches « test ») doivent
 * retroncer.
 */
$seca_wp = getenv( 'SECA_WP_DIR' ) ? getenv( 'SECA_WP_DIR' ) : '/home/user/wp';
require_once $seca_wp . '/wp-load.php';

$rooms = get_posts( array( 'post_type' => 'secura_room', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );

foreach ( $rooms as $room ) {
	foreach ( array( array( 'exam', 'test' ), array( 'test', 'exam' ) ) as $types ) {
		$pool = Secura_Exam::pool( $room->ID, $types );

		$empreintes = array();

		foreach ( $pool as $entree ) {
			$q = $entree['question'];

			$empreintes[] = $q['question'] . '|'
				. $q['mode'] . '|'
				. implode( '/', (array) $q['choices'] ) . '|'
				. (int) $q['correct'] . '|'
				. $q['source'] . '|'
				. $entree['room'] . '|' . $entree['task'] . '|' . $entree['q'];
		}

		printf(
			"%s\t%s\t%d\t%s\n",
			$room->post_name,
			implode( ',', $types ),
			count( $pool ),
			md5( implode( '#', $empreintes ) )
		);
	}
}
