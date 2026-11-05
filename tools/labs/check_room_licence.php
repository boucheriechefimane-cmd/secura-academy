<?php
/**
 * Vérifie quelles licences sont présentes dans une room donnée.
 * Usage : wp eval-file tools/labs/check_room_licence.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( "À exécuter avec wp eval-file.\n" );
}

$room_id = 22;

$tasks   = Secura_Rooms::get_tasks( $room_id );
$reserve = Secura_Rooms::reserve( $room_id );

echo "Room ID: $room_id\n";
echo "Tâches: " . ( is_array( $tasks ) ? count( $tasks ) : 'non-tableau' ) . "\n";
echo "Réserve: " . ( is_array( $reserve ) ? count( $reserve ) : 'non-tableau' ) . "\n\n";

$licences = array();

if ( is_array( $tasks ) ) {
	foreach ( $tasks as $task ) {
		if ( ! is_array( $task ) ) {
			continue;
		}
		$qs = isset( $task['questions'] ) && is_array( $task['questions'] ) ? $task['questions'] : array();
		foreach ( $qs as $q ) {
			if ( is_array( $q ) && ! empty( $q['licence'] ) ) {
				$licences[ $q['licence'] ] = true;
			}
		}
	}
}

if ( is_array( $reserve ) ) {
	foreach ( $reserve as $q ) {
		if ( is_array( $q ) && ! empty( $q['licence'] ) ) {
			$licences[ $q['licence'] ] = true;
		}
	}
}

if ( ! empty( $licences ) ) {
	echo "Licences trouvées :\n";
	foreach ( array_keys( $licences ) as $licence ) {
		echo " - $licence\n";
	}
} else {
	echo "Aucune licence trouvée dans les questions de cette room.\n";
}
