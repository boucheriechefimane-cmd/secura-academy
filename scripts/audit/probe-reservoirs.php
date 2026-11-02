<?php
/**
 * Sonde : reservoir reel (Secura_Exam::pool_size) par examen.
 * C'est la mesure que fait l'auditeur des epreuves.
 */
/* $wp est un objet global de WordPress : on ne lui vole pas son nom. */
$seca_wp = getenv( 'SECA_WP_DIR' ) ? getenv( 'SECA_WP_DIR' ) : '/home/user/wp';
require_once $seca_wp . '/wp-load.php';

$rooms = get_posts( array( 'post_type' => 'secura_room', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
$total_manque = 0;
foreach ( $rooms as $room ) {
	$taches = Secura_Rooms::get_tasks( $room->ID );
	foreach ( $taches as $index => $tache ) {
		if ( 'exam' !== $tache['type'] ) {
			continue;
		}
		$pool    = Secura_Exam::pool_size( $room->ID, $index );
		$epreuve = count( $tache['questions'] );
		$besoin  = max( 10, $epreuve * 5 );
		$manque  = max( 0, $besoin - $pool );
		$total_manque += $manque;
		if ( $manque > 0 ) {
			printf( "%d\t%s\tpool=%d\tepreuve=%d\tbesoin=%d\tmanque=%d\n", $room->ID, $room->post_name, $pool, $epreuve, $besoin, $manque );
		}
	}
}
echo "TOTAL MANQUE : ", $total_manque, "\n";
