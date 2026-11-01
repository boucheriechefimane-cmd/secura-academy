<?php
/**
 * Audit externe — Contenu pédagogique.
 *
 * Contrôle le contenu comme le ferait un formateur qui reprend le
 * programme : est-ce que chaque room est complète, traduite, expliquée,
 * attribuée, et est-ce que le contenu dit la vérité (les chiffres
 * annoncés dans la documentation sont-ils les vrais) ?
 *
 * Usage : wp eval-file scripts/audit/audit-contenu.php
 *
 * @package Secura_Academy
 */

require_once dirname( __FILE__ ) . '/audit-lib.php';

audit_titre( 'contenu', 'Audit externe — Contenu pédagogique' );

$racine = dirname( dirname( dirname( __FILE__ ) ) );

$rooms = get_posts(
	array(
		'post_type'   => 'secura_room',
		'post_status' => 'publish',
		'numberposts' => -1,
		'orderby'     => 'menu_order',
		'order'       => 'ASC',
	)
);

$paths = get_posts(
	array(
		'post_type'   => 'secura_path',
		'post_status' => 'publish',
		'numberposts' => -1,
	)
);

/* ------------------------------------------------------------------ */
echo "\n1. Le squelette de chaque room\n";

$types_attendus = array( 'lesson', 'practice', 'test', 'exam' );
$manques        = array();
$sans_explica   = array();
$sans_indice    = array();
$questions_tot  = 0;
$choix_mauvais  = 0;
$positions      = array( 0 => 0, 1 => 0, 2 => 0, 3 => 0 );
$sans_attribution = array();
$sans_traduction  = array();

foreach ( $rooms as $room ) {
	$taches = get_post_meta( $room->ID, '_secura_tasks', true );
	$types  = array();

	foreach ( (array) $taches as $tache ) {
		if ( isset( $tache['type'] ) ) {
			$types[] = $tache['type'];
		}

		foreach ( (array) ( isset( $tache['questions'] ) ? $tache['questions'] : array() ) as $question ) {
			$questions_tot++;

			if ( 'choice' === ( isset( $question['mode'] ) ? $question['mode'] : '' ) ) {
				$choix = isset( $question['choices'] ) ? (array) $question['choices'] : array();
				$correct = isset( $question['correct'] ) ? (int) $question['correct'] : -1;

				if ( 4 !== count( $choix ) || $correct < 0 || $correct > 3 ) {
					$choix_mauvais++;
				} else {
					$positions[ $correct ]++;
				}

				if ( empty( $question['explanation'] ) ) {
					$sans_explica[] = $room->post_title;
				}

				if ( empty( $question['hint'] ) ) {
					$sans_indice[] = $room->post_title;
				}
			}
		}
	}

	foreach ( $types_attendus as $attendu ) {
		if ( ! in_array( $attendu, $types, true ) ) {
			$manques[] = $room->post_title . ' (sans ' . $attendu . ')';
		}
	}

	/* La vidéo doit être attribuée : source, auteur, licence, durée. */
	$video = get_post_meta( $room->ID, '_secura_video', true );

	if ( $video ) {
		foreach ( array( 'id', 'title', 'channel', 'license', 'duration' ) as $champ ) {
			if ( empty( $video[ $champ ] ) ) {
				$sans_attribution[] = $room->post_title . ' (vidéo sans ' . $champ . ')';
			}
		}
	}

	/* Les traductions : arabe et anglais, avec un titre. */
	$i18n = get_post_meta( $room->ID, '_secura_i18n', true );

	foreach ( array( 'ar', 'en' ) as $langue ) {
		if ( empty( $i18n[ $langue ]['title'] ) || empty( $i18n[ $langue ]['excerpt'] ) ) {
			$sans_traduction[] = $room->post_title . ' (traduction ' . $langue . ' incomplète)';
		}
	}
}

audit_verifier(
	'chaque room a les quatre temps du parcours (leçon, entraînement, mission, examen)',
	empty( $manques ),
	count( $manques ) . ' room(s) incomplète(s) : ' . implode( ' | ', array_slice( $manques, 0, 3 ) ),
	'majeur'
);

audit_verifier(
	'les questions à choix ont toutes quatre propositions et une seule bonne réponse',
	0 === $choix_mauvais,
	$choix_mauvais . ' question(s) malformée(s)',
	'bloquant'
);

audit_verifier(
	'chaque question explique la bonne réponse (l\'élève apprend, il ne devine pas)',
	empty( $sans_explica ),
	count( $sans_explica ) . ' question(s) sans explication',
	'majeur'
);

audit_verifier(
	'chaque question peut être aidée (un indice, sinon l\'élève est bloqué)',
	empty( $sans_indice ),
	count( $sans_indice ) . ' question(s) sans indice',
	'mineur'
);

audit_verifier(
	'les videos sont attribuees (source, auteur, licence, duree)',
	empty( $sans_attribution ),
	count( $sans_attribution ) . ' video(s) mal attribuee(s) : ' . implode( ' | ', array_slice( $sans_attribution, 0, 3 ) ),
	'majeur'
);

audit_verifier(
	'chaque room est traduite en arabe et en anglais',
	empty( $sans_traduction ),
	count( $sans_traduction ) . ' room(s) mal traduites : ' . implode( ' | ', array_slice( $sans_traduction, 0, 3 ) ),
	'majeur'
);

/* ------------------------------------------------------------------ */
echo "\n2. La qualite des questions (le piège de la position)\n";

$total_choix = array_sum( $positions );
$max_position = 0;
$position_fauteuse = '';

foreach ( $positions as $position => $nombre ) {
	if ( $total_choix > 0 && ( $nombre / $total_choix ) > $max_position ) {
		$max_position = $nombre / $total_choix;
		$position_fauteuse = (string) ( $position + 1 );
	}
}

audit_verifier(
	'la bonne reponse n\'est pas toujours a la meme place',
	$max_position < 0.40,
	'la bonne réponse est en position ' . $position_fauteuse . ' dans ' . round( $max_position * 100 ) . '% des cas',
	'majeur'
);

audit_verifier(
	'le nombre de questions est coherent avec le programme annonce',
	$questions_tot >= 250,
	'questions trouvées : ' . $questions_tot,
	'info'
);

/* ------------------------------------------------------------------ */
echo "\n3. Les parcours\n";

$rooms_sans_parcours = array();
$ids_rooms          = array();

foreach ( $rooms as $room ) {
	$ids_rooms[ $room->ID ] = true;
}

$references_mortes = array();

foreach ( $paths as $path ) {
	$sections = get_post_meta( $path->ID, '_secura_path_sections', true );

	foreach ( (array) $sections as $section ) {
		foreach ( (array) ( isset( $section['rooms'] ) ? $section['rooms'] : array() ) as $room_id ) {
			if ( ! isset( $ids_rooms[ $room_id ] ) ) {
				$references_mortes[] = $path->post_title . ' → room #' . $room_id;
			}
		}
	}
}

audit_verifier(
	'aucun parcours ne renvoie vers une room qui n\'existe plus',
	empty( $references_mortes ),
	implode( ' | ', array_slice( $references_mortes, 0, 3 ) ),
	'majeur'
);

$comptes = array();

foreach ( $paths as $path ) {
	$sections = get_post_meta( $path->ID, '_secura_path_sections', true );
	$nombre   = 0;

	foreach ( (array) $sections as $section ) {
		$nombre += count( (array) ( isset( $section['rooms'] ) ? $section['rooms'] : array() ) );
	}

	$comptes[] = $path->post_title . ' (' . $nombre . ' rooms)';
}

audit_info(
	'les parcours et leur contenu',
	implode( ' | ', $comptes )
);

/* ------------------------------------------------------------------ */
echo "\n4. Les preuves (missions) et les drapeaux\n";

$sans_preuve = array();
$sans_lab     = array();

foreach ( $rooms as $room ) {
	$taches = get_post_meta( $room->ID, '_secura_tasks', true );
	$a_mission = false;

	foreach ( (array) $taches as $tache ) {
		if ( 'test' !== ( isset( $tache['type'] ) ? $tache['type'] : '' ) ) {
			continue;
		}

		foreach ( (array) ( isset( $tache['questions'] ) ? $tache['questions'] : array() ) as $question ) {
			if ( 'flag' === ( isset( $question['mode'] ) ? $question['mode'] : '' ) ) {
				$a_mission = true;

				if ( empty( $question['flag_path'] ) ) {
					$sans_preuve[] = $room->post_title;
				}
			}
		}
	}

	if ( $a_mission && ! get_post_meta( $room->ID, '_secura_lab', true ) ) {
		$sans_lab[] = $room->post_title;
	}
}

audit_verifier(
	'chaque mission indique ou trouver la preuve (un chemin de drapeau)',
	empty( $sans_preuve ),
	implode( ' | ', array_slice( $sans_preuve, 0, 3 ) ),
	'bloquant'
);

audit_verifier(
	'chaque room avec mission est branchee sur une machine',
	empty( $sans_lab ),
	implode( ' | ', array_slice( $sans_lab, 0, 3 ) ),
	'bloquant'
);

/* ------------------------------------------------------------------ */
echo "\n5. Les defauts de fabrication\n";

$textes = array();

foreach ( $rooms as $room ) {
	$textes[] = $room->post_title . ' ' . $room->post_excerpt . ' ' . $room->post_content;

	$taches = get_post_meta( $room->ID, '_secura_tasks', true );

	foreach ( (array) $taches as $tache ) {
		$textes[] = ( isset( $tache['title'] ) ? $tache['title'] : '' ) . ' '
			. ( isset( $tache['content'] ) ? $tache['content'] : '' );

		foreach ( (array) ( isset( $tache['questions'] ) ? $tache['questions'] : array() ) as $question ) {
			$textes[] = ( isset( $question['question'] ) ? $question['question'] : '' ) . ' '
				. ( isset( $question['explanation'] ) ? $question['explanation'] : '' );

			foreach ( (array) ( isset( $question['choices'] ) ? $question['choices'] : array() ) as $choix ) {
				$textes[] = $choix;
			}
		}
	}
}

$texte = implode( "\n", $textes );

$places = array();

foreach ( array( 'TODO', 'Lorem ipsum', 'à compléter', 'A completer', 'XXX', 'FIXME', 'placeholder' ) as $motif ) {
	if ( false !== stripos( $texte, $motif ) ) {
		$places[] = $motif;
	}
}

audit_verifier(
	'aucun texte de remplissage n\'est resté dans le contenu',
	empty( $places ),
	implode( ' | ', $places ),
	'majeur'
);

/* Les caractères d'une autre alphabet : le signe d'un texte mal généré. */
$cjk = preg_match_all( '/[\x{3000}-\x{303F}\x{3040}-\x{30FF}\x{4E00}-\x{9FFF}\x{FF00}-\x{FFEF}]/u', $texte );
$cyr = preg_match_all( '/[\x{0400}-\x{04FF}]/u', $texte );

audit_verifier(
	'aucun caractère étranger ne s\'est glissé dans le texte',
	0 === $cjk && 0 === $cyr,
	'caractères asiatiques : ' . $cjk . ', cyrilliques : ' . $cyr,
	'majeur'
);

/* ------------------------------------------------------------------ */
echo "\n6. La documentation dit-elle la verite ?\n";

$readme = file_get_contents( $racine . '/README.md' );

if ( false !== strpos( $readme, '**' . count( $rooms ) . ' rooms**' ) ) {
	audit_verifier(
		'le README annonce le vrai nombre de rooms',
		true,
		'le README annonce ' . count( $rooms ) . ' rooms, comme l\'installation'
	);
} else {
	audit_verifier(
		'le README annonce le vrai nombre de rooms',
		false,
		'le README ne mentionne pas ' . count( $rooms ) . ' rooms (il en annonce un autre nombre)',
		'mineur'
	);
}

if ( false !== strpos( $readme, '**' . count( $paths ) . ' parcours**' ) ) {
	audit_verifier(
		'le README annonce le vrai nombre de parcours',
		true
	);
} else {
	audit_verifier(
		'le README annonce le vrai nombre de parcours',
		false,
		'le README ne mentionne pas ' . count( $paths ) . ' parcours',
		'mineur'
	);
}

/* ------------------------------------------------------------------ */
echo "\n7. Le quiz Kahoot\n";

$kahoot_trouve = false;

foreach ( $rooms as $room ) {
	$kahoot = get_post_meta( $room->ID, '_secura_kahoot', true );

	if ( ! $kahoot ) {
		continue;
	}

	$kahoot_trouve = true;

	$questions_kahoot = class_exists( 'Secura_Kahoot' )
		? Secura_Kahoot::questions( $room->ID )
		: array();

	audit_verifier(
		'le quiz Kahoot a dix questions',
		10 === count( (array) $questions_kahoot ),
		'questions trouvées : ' . count( (array) $questions_kahoot ),
		'mineur'
	);

	$sans_explication_kahoot = 0;

	foreach ( (array) $questions_kahoot as $question ) {
		if ( empty( $question['explain'] ) && empty( $question['explanation'] ) ) {
			$sans_explication_kahoot++;
		}
	}

	audit_verifier(
		'chaque question du quiz s\'explique (pour l\'enseignant qui relit après la séance)',
		0 === $sans_explication_kahoot,
		$sans_explication_kahoot . ' question(s) sans explication',
		'mineur'
	);
}

audit_verifier(
	'un quiz Kahoot est installé',
	$kahoot_trouve,
	'',
	'mineur'
);

exit( audit_fin() );
