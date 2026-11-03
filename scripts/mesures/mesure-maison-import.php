<?php
/**
 * Mesure : pour chaque room, taille de chaque tache AVEC et SANS
 * les questions importees (celles qui portent une cle 'source').
 */
$rooms = get_posts( array( 'post_type' => 'secura_room', 'numberposts' => -1, 'post_status' => 'publish' ) );
$totaux = array( 'test' => 0, 'exam' => 0, 'practice' => 0 );
$lignes  = array();
$impact  = 0;

foreach ( $rooms as $room ) {
	$taches = Secura_Rooms::get_tasks( $room->ID );

	foreach ( $taches as $index => $tache ) {
		$maison = 0;
		$import = 0;

		foreach ( (array) $tache['questions'] as $q ) {
			if ( ! empty( $q['source'] ) ) {
				$import++;
			} else {
				$maison++;
			}
		}

		$type = $tache['type'];

		if ( isset( $totaux[ $type ] ) ) {
			$totaux[ $type ] += $import;
		}

		if ( $import > 0 ) {
			$lignes[] = sprintf( '%-58s %-9s t%-2d total=%-3d maison=%-3d import=%-3d', $room->post_name, $type, $index, $maison + $import, $maison, $import );
		}

		if ( 'test' === $type && $import > 0 ) {
			$impact++;
		}
	}
}

echo "--- Taches contenant des questions importees ---\n";
foreach ( $lignes as $ligne ) {
	echo $ligne . "\n";
}

echo "\n--- Totaux par type de tache ---\n";
foreach ( $totaux as $type => $n ) {
	printf( "%-10s %d question(s) importee(s)\n", $type, $n );
}

printf( "\n%d tache(s) 'test' gonflee(s) par des imports.\n", $impact );
