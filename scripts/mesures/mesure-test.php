<?php
/**
 * Mesure : combien de questions l'eleve recoit reellement dans chaque
 * tache, quand le reservoir d'une section a ete elargi par des imports.
 *
 * La regle du moteur (Secura_Exam::paper) :
 *   - pour un EXAMEN, le nombre de questions servies est la taille de
 *     l'epreuve ; elles sont tirees dans le reservoir de la section ;
 *   - pour un TEST, c'est le maximum entre la taille de la tache test
 *     de la room et la taille de son epreuve.
 *
 * Donc elargir une tache « test » grossit aussi le test servi a
 * l'eleve. On le mesure pour le voir.
 */
$seca_wp = getenv( 'SECA_WP_DIR' ) ? getenv( 'SECA_WP_DIR' ) : '/home/user/wp';
require_once $seca_wp . '/wp-load.php';

$user = get_users( array( 'number' => 1, 'fields' => array( 'ID' ) ) );
$user_id = $user ? (int) $user[0] : 0;

$rooms = get_posts( array( 'post_type' => 'secura_room', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );

printf( "%-52s %-9s %-6s %-6s %-8s %-8s\n", 'room', 'type', 'tache', 'epreuve', 'pool', 'servi' );

foreach ( $rooms as $room ) {
	$taches = Secura_Rooms::get_tasks( $room->ID );

	foreach ( $taches as $index => $tache ) {
		if ( ! in_array( $tache['type'], array( 'exam', 'test' ), true ) ) {
			continue;
		}

		$paper = Secura_Exam::paper( $user_id, $room->ID, $index, $tache );

		printf(
			"%-52s %-9s %-6d %-6d %-8d %-8d\n",
			substr( $room->post_name, 0, 52 ),
			$tache['type'],
			count( $tache['questions'] ),
			'tache',
			Secura_Exam::pool_size( $room->ID, $index ),
			count( $paper )
		);
	}
}
