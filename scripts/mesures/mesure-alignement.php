<?php
/**
 * Mesure : alignement entre la tache BRUTE (celle que le moteur
 * utilise pour le deverrouillage et la note) et la COPIE servie
 * (celle que l'eleve repond).
 *
 * is_task_unlocked() lit la tache brute ; l'etat « solved » est
 * indexe sur la copie servie. Si les deux n'ont pas le meme nombre
 * de questions, le deverrouillage est soit trop permissif (brute <
 * servie) soit bloque (brute > servie).
 */
$seca_wp = getenv( 'SECA_WP_DIR' ) ? getenv( 'SECA_WP_DIR' ) : '/home/user/wp';
require_once $seca_wp . '/wp-load.php';

$user    = get_users( array( 'number' => 1, 'fields' => array( 'ID' ) ) );
$user_id = $user ? (int) $user[0] : 0;

$rooms = get_posts( array( 'post_type' => 'secura_room', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );

$egaux       = 0;
$brute_plus  = 0;
$servi_plus  = 0;
$lignes      = array();

foreach ( $rooms as $room ) {
	$taches = Secura_Rooms::get_tasks( $room->ID );

	foreach ( $taches as $index => $tache ) {
		if ( ! in_array( $tache['type'], array( 'test', 'exam' ), true ) ) {
			continue;
		}

		$brute = count( $tache['questions'] );
		$serve = count( Secura_Exam::paper( $user_id, $room->ID, $index, $tache ) );

		if ( $brute === $serve ) {
			$egaux++;
			continue;
		}

		if ( $brute > $serve ) {
			$brute_plus++;
			$lignes[] = sprintf( 'BLOQUANT  %-50s %-5s brute=%-3d servi=%-3d', substr( $room->post_name, 0, 50 ), $tache['type'], $brute, $serve );
		} else {
			$servi_plus++;
			$lignes[] = sprintf( 'permissif  %-50s %-5s brute=%-3d servi=%-3d', substr( $room->post_name, 0, 50 ), $tache['type'], $brute, $serve );
		}
	}
}

foreach ( $lignes as $ligne ) {
	echo $ligne . "\n";
}

printf(
	"\n%d tache(s) alignee(s) | %d ou la copie servie est plus grande (deverrouillage trop permissif) | %d ou la tache brute est plus grande (DEVERROUILLAGE BLOQUE)\n",
	$egaux,
	$servi_plus,
	$brute_plus
);
