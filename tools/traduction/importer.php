<?php
/**
 * Applique un fichier de traduction anglaise à une room.
 *
 * Refuse d'écrire si un seul champ reste vide : une room à moitié traduite
 * est pire qu'une room non traduite, parce qu'elle donne l'illusion d'être
 * terminée. Le script dit exactement ce qui manque.
 *
 * Usage :
 *   wp eval-file tools/traduction/importer.php <fichier-en.json>
 *
 * Le fichier attendu a la forme :
 *   { "room_id": 12, "en": { "title": "...", "excerpt": "...",
 *       "tasks": [ { "title": "...", "content": "...",
 *                    "questions": [ {"question":"","hint":"","explanation":""} ] } ] } }
 */

if ( ! isset( $args[0] ) || ! is_file( $args[0] ) ) {
	echo "Usage : wp eval-file tools/traduction/importer.php <fichier-en.json>\n";
	exit( 1 );
}

$data = json_decode( file_get_contents( $args[0] ), true );

if ( ! is_array( $data ) || empty( $data['room_id'] ) || ! isset( $data['en'] ) ) {
	echo "Fichier invalide : « room_id » et « en » sont obligatoires.\n";
	exit( 1 );
}

$room_id = (int) $data['room_id'];
$room    = get_post( $room_id );

if ( ! $room || 'secura_room' !== $room->post_type ) {
	echo "Room $room_id introuvable.\n";
	exit( 1 );
}

$taches = get_post_meta( $room_id, SECURA_META_TASKS, true );
$en     = $data['en'];

// --- Contrôles avant écriture -------------------------------------------
$manques = array();

if ( '' === trim( (string) ( $en['title'] ?? '' ) ) ) {
	$manques[] = 'title';
}

if ( count( (array) ( $en['tasks'] ?? array() ) ) !== count( (array) $taches ) ) {
	printf(
		"Le fichier décrit %d tâches, la room en a %d : refusé.\n",
		count( (array) ( $en['tasks'] ?? array() ) ),
		count( (array) $taches )
	);
	exit( 1 );
}

foreach ( (array) $taches as $i => $tache ) {
	$t = $en['tasks'][ $i ] ?? array();

	if ( '' === trim( (string) ( $t['title'] ?? '' ) ) ) {
		$manques[] = sprintf( 'tâche %d : title', $i + 1 );
	}

	$fr_c = trim( wp_strip_all_tags( (string) ( $tache['content'] ?? '' ) ) );
	if ( '' !== $fr_c && '' === trim( wp_strip_all_tags( (string) ( $t['content'] ?? '' ) ) ) ) {
		$manques[] = sprintf( 'tâche %d : content', $i + 1 );
	}

	foreach ( (array) ( $tache['questions'] ?? array() ) as $j => $q ) {
		$en_q = $t['questions'][ $j ] ?? array();

		foreach ( array( 'question', 'hint', 'explanation' ) as $champ ) {
			$fr_v = trim( wp_strip_all_tags( (string) ( $q[ $champ ] ?? '' ) ) );
			if ( '' === $fr_v ) {
				continue;
			}

			$en_v = trim( wp_strip_all_tags( (string) ( $en_q[ $champ ] ?? '' ) ) );

			if ( '' === $en_v ) {
				$manques[] = sprintf( 'tâche %d question %d : %s', $i + 1, $j + 1, $champ );
			} elseif ( $en_v === $fr_v ) {
				$manques[] = sprintf( 'tâche %d question %d : %s identique au français', $i + 1, $j + 1, $champ );
			}
		}
	}
}

if ( $manques ) {
	echo "REFUSÉ : traduction incomplète.\n";
	foreach ( array_slice( $manques, 0, 20 ) as $m ) {
		echo "  - $m\n";
	}
	if ( count( $manques ) > 20 ) {
		printf( "  ... et %d autres.\n", count( $manques ) - 20 );
	}
	exit( 1 );
}

// --- Écriture ------------------------------------------------------------
$i18n = get_post_meta( $room_id, SECURA_META_I18N, true );
$i18n = is_array( $i18n ) ? $i18n : array();

// On ne touche ni au français ni à l'arabe : on remplace l'anglais seul.
$i18n['en'] = array(
	'title'   => $en['title'],
	'excerpt' => $en['excerpt'] ?? '',
	'content' => $en['content'] ?? ( $i18n['en']['content'] ?? '' ),
	'tasks'   => $en['tasks'],
);

update_post_meta( $room_id, SECURA_META_I18N, $i18n );

printf( "Room %d « %s » : anglais appliqué (%d tâches).\n", $room_id, $en['title'], count( (array) $en['tasks'] ) );
