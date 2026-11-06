<?php
/**
 * Mesure l'état de l'anglais, room par room.
 *
 * Ce script ne devine rien : pour chaque room, il regarde le contenu
 * d'origine et sa traduction anglaise stockée en meta, et dit ce qui
 * manque. Sortie 0 si toutes les rooms sont réellement en anglais.
 *
 * Usage :
 *   wp eval-file tools/recette-apprenants/mesure-anglais.php
 */

$rooms = get_posts(
	array(
		'post_type'      => 'secura_room',
		'post_status'    => 'any',
		'posts_per_page' => -1,
		'orderby'        => 'title',
		'order'          => 'ASC',
	)
);

$total        = count( $rooms );
$sans_titre   = array();
$sans_taches  = array();
$sans_trad    = array();
$champs_total = 0;
$champs_vides = array();
$champs_copie = array();

if ( isset( $args[0] ) && 'liste' === $args[0] ) {
	foreach ( $rooms as $room ) {
		$t  = Secura_I18n::translate_post( $room->ID, 'en' );
		$t  = is_array( $t ) ? $t : array();
		$ta = get_post_meta( $room->ID, defined( 'SECURA_META_TASKS' ) ? SECURA_META_TASKS : '_secura_tasks', true );
		printf( "%6d  %-45s taches=%2d  trads_taches=%2d  titre_en=%s\n",
			$room->ID,
			mb_substr( $room->post_title, 0, 45 ),
			is_array( $ta ) ? count( $ta ) : 0,
			isset( $t['tasks'] ) && is_array( $t['tasks'] ) ? count( $t['tasks'] ) : 0,
			( isset( $t['title'] ) && '' !== trim( (string) $t['title'] ) ) ? 'oui' : 'NON'
		);
	}
	return;
}

foreach ( $rooms as $room ) {
	$tr   = Secura_I18n::translate_post( $room->ID, 'en' );
	$trad = is_array( $tr ) ? $tr : array();

	$titre_en = isset( $trad['title'] ) ? trim( $trad['title'] ) : '';

	if ( '' === $titre_en ) {
		$sans_titre[] = $room->post_title;
	}

	$taches = get_post_meta( $room->ID, defined( 'SECURA_META_TASKS' ) ? SECURA_META_TASKS : '_secura_tasks', true );
	$nb_t   = is_array( $taches ) ? count( $taches ) : 0;
	$nb_tr  = isset( $trad['tasks'] ) && is_array( $trad['tasks'] ) ? count( $trad['tasks'] ) : 0;

	if ( $nb_t > 0 && $nb_tr < $nb_t ) {
		$sans_taches[] = sprintf( '%s (%d/%d tâches traduites)', $room->post_title, $nb_tr, $nb_t );
	}

	if ( '' === $titre_en && 0 === $nb_tr ) {
		$sans_trad[] = $room->post_title;
	}

	// Contrôle champ par champ : un titre traduit ne suffit pas. On vérifie
	// chaque tâche, chaque question, chaque indice et chaque explication.
	$orig_taches = is_array( $taches ) ? $taches : array();
	$en_taches   = isset( $trad['tasks'] ) && is_array( $trad['tasks'] ) ? $trad['tasks'] : array();

	foreach ( $orig_taches as $i => $tache ) {
		$en_tache = isset( $en_taches[ $i ] ) ? $en_taches[ $i ] : array();

		// Le titre de la tâche.
		$champs_total++;
		$en_t = isset( $en_tache['title'] ) ? trim( $en_tache['title'] ) : '';
		if ( '' === $en_t ) {
			$champs_vides[] = sprintf( '%s > tâche %d (titre)', $room->post_title, $i + 1 );
		}

		// Le corps de la tâche, s'il existe.
		$fr_c = isset( $tache['content'] ) ? trim( wp_strip_all_tags( $tache['content'] ) ) : '';
		if ( '' !== $fr_c ) {
			$champs_total++;
			$en_c = isset( $en_tache['content'] ) ? trim( wp_strip_all_tags( $en_tache['content'] ) ) : '';
			if ( '' === $en_c ) {
				$champs_vides[] = sprintf( '%s > tâche %d (contenu)', $room->post_title, $i + 1 );
			} elseif ( $fr_c === $en_c ) {
				$champs_copie[] = sprintf( '%s > tâche %d (contenu identique au français)', $room->post_title, $i + 1 );
			}
		}

		// Les questions : énoncé, indice, explication.
		$fr_qs = isset( $tache['questions'] ) && is_array( $tache['questions'] ) ? $tache['questions'] : array();
		$en_qs = isset( $en_tache['questions'] ) && is_array( $en_tache['questions'] ) ? $en_tache['questions'] : array();

		foreach ( $fr_qs as $j => $q ) {
			$en_q = isset( $en_qs[ $j ] ) ? $en_qs[ $j ] : array();

			foreach ( array( 'question', 'hint', 'explanation' ) as $champ ) {
				$fr_v = isset( $q[ $champ ] ) ? trim( wp_strip_all_tags( $q[ $champ ] ) ) : '';
				if ( '' === $fr_v ) {
					continue;
				}

				$champs_total++;
				$en_v = isset( $en_q[ $champ ] ) ? trim( wp_strip_all_tags( $en_q[ $champ ] ) ) : '';

				if ( '' === $en_v ) {
					$champs_vides[] = sprintf( '%s > tâche %d > question %d (%s)', $room->post_title, $i + 1, $j + 1, $champ );
				} elseif ( $fr_v === $en_v ) {
					$champs_copie[] = sprintf( '%s > tâche %d > question %d (%s identique au français)', $room->post_title, $i + 1, $j + 1, $champ );
				}
			}
		}
	}

}

if ( $sans_titre ) {
	echo "\nRooms sans titre anglais :\n";
	foreach ( $sans_titre as $t ) {
		echo "  - $t\n";
	}
}

if ( $sans_taches ) {
	echo "\nRooms aux tâches incomplètes :\n";
	foreach ( $sans_taches as $t ) {
		echo "  - $t\n";
	}
}

printf( "Sans titre anglais        : %d\n", count( $sans_titre ) );
printf( "Tâches incomplètement EN  : %d\n", count( $sans_taches ) );
printf( "Sans aucune traduction EN : %d\n", count( $sans_trad ) );
printf( "Champs de texte contrôlés : %d\n", $champs_total );
printf( "Champs encore en français : %d\n", count( $champs_copie ) );
printf( "Champs sans traduction    : %d\n", count( $champs_vides ) );

if ( $champs_copie ) {
	echo "\nChamps identiques au français (donc non traduits) :\n";
	foreach ( array_slice( $champs_copie, 0, 25 ) as $c ) {
		echo "  - $c\n";
	}
	if ( count( $champs_copie ) > 25 ) {
		printf( "  ... et %d autres.\n", count( $champs_copie ) - 25 );
	}
}

if ( $champs_vides ) {
	echo "\nChamps sans aucune traduction :\n";
	foreach ( array_slice( $champs_vides, 0, 25 ) as $c ) {
		echo "  - $c\n";
	}
	if ( count( $champs_vides ) > 25 ) {
		printf( "  ... et %d autres.\n", count( $champs_vides ) - 25 );
	}
}

$pret = ( 0 === count( $champs_vides ) && 0 === count( $champs_copie ) && $total > 0 );

echo "\n";
echo $pret
	? "VERDICT : les $total rooms sont réellement en anglais ($champs_total champs contrôlés).\n"
	: sprintf(
		"VERDICT : l'anglais n'est PAS terminé — %d champs sans traduction, %d champs restés en français, sur %d contrôlés.\n",
		count( $champs_vides ),
		count( $champs_copie ),
		$champs_total
	);

exit( $pret ? 0 : 1 );
