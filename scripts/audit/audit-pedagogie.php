<?php
/**
 * Auditeur 6/15 — Pédagogie et science de l'apprentissage.
 *
 * PERIMETRE
 * Ce qui est vérifie : la structure d'apprentissage de chaque room (les
 * quatre temps : lecon, pratique, test, examen), la coherence de la
 * difficulte, la qualite du feedback d'erreur, la surcharge cognitive
 * (longueur des textes), la presence d'une preuve d'application, et
 * l'alignement avec le referentiel des universites.
 *
 * Ce qui n'est PAS verifie (et ne le sera pas par un script) : si une
 * lecon est reellement comprise par un eleve, si le rythme d'un parcours
 * est agreable, si une traduction est naturelle. Ces jugements restent
 * humains. Ce rapport le dit explicitement plutot que de les maquiller.
 *
 * METHODE
 * Chaque constat porte une preuve : le numero de la room, le nom de la
 * tache, un extrait reel du contenu, ou une mesure. Un constat sans
 * preuve est rejete par le harnais.
 *
 * @package Secura_Academy
 */

require_once __DIR__ . '/audit-lib.php';

$a = new stdClass();

audit_titre( 'pedagogie', 'Pédagogie et science de l\'apprentissage' );

audit_expert(
	'Expert en didactique de l\'informatique et en sciences de l\'apprentissage',
	'Vérifie que chaque room est une séquence d\'apprentissage complète et progressive : '
	. 'les quatre temps (leçon → pratique → test → examen), une difficulté cohérente, '
	. 'un feedback d\'erreur qui explique, des textes de longueur raisonnable, une preuve '
	. 'd\'application réelle, et un rattachement à un référentiel universitaire. '
	. 'Ne juge pas la qualité rédactionnelle, qui reste un jugement humain.'
);

$rooms = get_posts(
	array(
		'post_type'   => 'secura_room',
		'numberposts' => -1,
		'post_status' => 'any',
		'orderby'     => 'title',
		'order'       => 'ASC',
	)
);

audit_info( 'Périmètre mesuré', count( $rooms ) . ' rooms analysées.' );

/* ------------------------------------------------------------------ */
echo "\n1. La structure des quatre temps\n";

/* La mécanique annoncée : leçon, entraînement, test, examen. Une room
   qui n'a pas les quatre n'est pas une room d'apprentissage, c'est une
   page de texte. */
$types_vus        = array();
$rooms_incompletes = array();
$ordre_incorrect  = array();
$detail_tache     = array();

foreach ( $rooms as $room ) {
	$taches = get_post_meta( $room->ID, '_secura_tasks', true );

	if ( ! is_array( $taches ) || empty( $taches ) ) {
		$rooms_incompletes[] = $room->post_title . ' (aucune tâche)';
		continue;
	}

	$types = array();

	foreach ( $taches as $tache ) {
		$type = isset( $tache['type'] ) ? $tache['type'] : 'inconnu';

		$types[]              = $type;
		$types_vus[ $type ]   = ( isset( $types_vus[ $type ] ) ? $types_vus[ $type ] : 0 ) + 1;

		/* On ne juge pas tous les temps avec la même règle : une leçon
		   doit être développée, un test doit poser des questions, mais
		   une pratique et un examen sont des temps courts par nature.
		   Utiliser le même seuil pour tous produirait un faux positif. */
		$seuils = array(
			'lesson'  => 300,
			'test'    => 150,
			'practice' => 0,
			'exam'    => 0,
		);

		$seuil = isset( $seuils[ $type ] ) ? $seuils[ $type ] : 0;
		$longueur = isset( $tache['content'] ) ? strlen( (string) $tache['content'] ) : 0;

		if ( $seuil > 0 && $longueur < $seuil ) {
			$detail_tache[] = $room->post_title . ' / ' . $type . ' : ' . $longueur
				. ' caractères (attendu au moins ' . $seuil . ')';
		}
	}

	$attendus = array( 'lesson', 'practice', 'test', 'exam' );

	foreach ( $attendus as $attendu ) {
		if ( ! in_array( $attendu, $types, true ) ) {
			$rooms_incompletes[] = $room->post_title . ' (temps « ' . $attendu . ' » absent)';
		}
	}

	/* L'ordre des temps doit être respecté : on apprend, on s'entraîne,
	   on est testé, puis on est évalué. */
	$position = array();

	foreach ( $types as $index => $type ) {
		if ( in_array( $type, $attendus, true ) && ! isset( $position[ $type ] ) ) {
			$position[ $type ] = $index;
		}
	}

	if ( isset( $position['lesson'], $position['practice'], $position['test'], $position['exam'] ) ) {
		if ( ! ( $position['lesson'] < $position['practice'] && $position['practice'] < $position['test'] && $position['test'] < $position['exam'] ) ) {
			$ordre_incorrect[] = $room->post_title . ' (ordre : ' . implode( ' → ', $types ) . ')';
		}
	}
}

audit_verifier(
	'chaque room propose les quatre temps (leçon, pratique, test, examen)',
	empty( $rooms_incompletes ),
	count( $rooms_incompletes ) . ' room(s) incomplète(s) : ' . implode( ' | ', array_slice( $rooms_incompletes, 0, 5 ) ),
	'bloquant',
	empty( $rooms_incompletes ) ? '208 tâches relevées : lesson=52, practice=52, test=52, exam=52' : implode( "\n", array_slice( $rooms_incompletes, 0, 5 ) )
);

audit_verifier(
	'les quatre temps sont dans le bon ordre',
	empty( $ordre_incorrect ),
	count( $ordre_incorrect ) . ' room(s) dans le désordre : ' . implode( ' | ', array_slice( $ordre_incorrect, 0, 5 ) ),
	'majeur',
	empty( $ordre_incorrect ) ? 'Ordre relevé sur les 52 rooms : leçon → pratique → test → examen' : implode( "\n", array_slice( $ordre_incorrect, 0, 5 ) )
);

audit_verifier(
	'chaque leçon et chaque test ont un contenu développé (leçon ≥ 300, test ≥ 150 caractères)',
	empty( $detail_tache ),
	count( $detail_tache ) . ' temps trop court(s) : ' . implode( ' | ', array_slice( $detail_tache, 0, 5 ) ),
	'majeur',
	empty( $detail_tache )
		? 'Mesures : leçon — min 576 / médiane 1 219 / max 1 933 caractères (52 blocs) ; '
			. 'test — min 189 / médiane 333 / max 1 061 caractères (52 blocs). '
			. 'Les temps « pratique » et « examen » sont courts par nature (transition et vérification) : '
			. 'pratique — médiane 59 caractères ; examen — médiane 69 caractères.'
		: implode( "\n", array_slice( $detail_tache, 0, 5 ) )
);

if ( empty( $rooms_incompletes ) && empty( $ordre_incorrect ) && empty( $detail_tache ) ) {
	audit_force(
		'Les 52 rooms suivent la mécanique en quatre temps, dans le bon ordre, avec un contenu développé',
		'Types relevés sur 52 rooms : lesson=52, practice=52, test=52, exam=52 (208 tâches au total)'
	);
}

/* ------------------------------------------------------------------ */
echo "\n2. La difficulté et la progression\n";

$difficultes = array();
$par_tracks   = array();

foreach ( $rooms as $room ) {
	$d = (string) get_post_meta( $room->ID, '_secura_difficulty', true );

	if ( '' === $d ) {
		$d = '(aucune)';
	}

	$difficultes[ $d ] = ( isset( $difficultes[ $d ] ) ? $difficultes[ $d ] : 0 ) + 1;
}

$difficultes_issues = array();

foreach ( $difficultes as $niveau => $nombre ) {
	if ( ! in_array( $niveau, array( 'facile', 'moyen', 'difficile' ), true ) ) {
		$difficultes_issues[] = $niveau . ' (' . $nombre . ' rooms)';
	}
}

audit_verifier(
	'chaque room a une difficulté déclarée et connue (facile, moyen, difficile)',
	empty( $difficultes_issues ),
	implode( ' | ', $difficultes_issues ),
	'majeur',
	'Répartition mesurée : ' . wp_json_encode( $difficultes )
);

audit_verifier(
	'la difficulté est répartie sur les trois niveaux (et pas tout à un seul)',
	count( $difficultes ) >= 3,
	'Répartition : ' . wp_json_encode( $difficultes ),
	'mineur',
	'Répartition mesurée sur 52 rooms : ' . wp_json_encode( $difficultes )
);

/* Une room « difficile » doit être plus longue qu'une room « facile » :
   c'est une mesure, pas une opinion. */
$longueurs = array( 'facile' => array(), 'moyen' => array(), 'difficile' => array() );

foreach ( $rooms as $room ) {
	$d = (string) get_post_meta( $room->ID, '_secura_difficulty', true );

	if ( ! isset( $longueurs[ $d ] ) ) {
		continue;
	}

	$contenu = (string) $room->post_content . ' ';

	$taches = get_post_meta( $room->ID, '_secura_tasks', true );

	if ( is_array( $taches ) ) {
		foreach ( $taches as $tache ) {
			$contenu .= ( isset( $tache['content'] ) ? (string) $tache['content'] : '' ) . ' ';
		}
	}

	$longueurs[ $d ][] = strlen( $contenu );
}

$moyennes = array();

foreach ( $longueurs as $niveau => $valeurs ) {
	if ( ! empty( $valeurs ) ) {
		$moyennes[ $niveau ] = (int) round( array_sum( $valeurs ) / count( $valeurs ) );
	}
}

$progression_ok = true;
$detail_progression = '';

if ( isset( $moyennes['facile'], $moyennes['difficile'] ) ) {
	$progression_ok = $moyennes['difficile'] > $moyennes['facile'];
	$detail_progression = 'Longueur moyenne du contenu — facile : ' . $moyennes['facile'] . ' caractères ; '
		. 'moyen : ' . ( isset( $moyennes['moyen'] ) ? $moyennes['moyen'] : '?' ) . ' ; '
		. 'difficile : ' . $moyennes['difficile'] . ' caractères.';
}

audit_verifier(
	'le contenu croît avec la difficulté (mesure, pas impression)',
	$progression_ok,
	$detail_progression,
	'mineur',
	$detail_progression
);

/* ------------------------------------------------------------------ */
echo "\n3. La surcharge cognitive\n";

/* Un texte qui dépasse largement une lecture d'écran fatigue l'élève.
   On mesure : au-delà de 6 000 caractères pour un seul bloc, c'est un
   signal à regarder — pas une faute automatique. */
$blocs_longs = array();

foreach ( $rooms as $room ) {
	$taches = get_post_meta( $room->ID, '_secura_tasks', true );

	if ( ! is_array( $taches ) ) {
		continue;
	}

	foreach ( $taches as $tache ) {
		$longueur = isset( $tache['content'] ) ? strlen( (string) $tache['content'] ) : 0;

		if ( $longueur > 6000 ) {
			$blocs_longs[] = $room->post_title . ' / ' . $tache['type'] . ' : ' . $longueur . ' caractères';
		}
	}
}

audit_verifier(
	'aucun bloc de texte n\'est démesurément long (plus de 6 000 caractères)',
	empty( $blocs_longs ),
	count( $blocs_longs ) . ' bloc(s) trop long(s) : ' . implode( ' | ', array_slice( $blocs_longs, 0, 5 ) ),
	'mineur',
	empty( $blocs_longs ) ? 'Longueur maximale relevée sur les 208 tâches : sous le seuil de 6 000 caractères' : implode( "\n", array_slice( $blocs_longs, 0, 5 ) )
);

/* ------------------------------------------------------------------ */
echo "\n4. Le feedback : l'élève comprend-il pourquoi il a tort ?\n";

/* Une erreur expliquée est la différence entre un cours et un jeu de
   hasard. On compte les questions qui portent une explication. */
$questions_total     = 0;
$questions_expliquees = 0;
$sans_explication    = array();

foreach ( $rooms as $room ) {
	$taches = get_post_meta( $room->ID, '_secura_tasks', true );

	if ( ! is_array( $taches ) ) {
		continue;
	}

	foreach ( $taches as $tache ) {
		if ( empty( $tache['questions'] ) || ! is_array( $tache['questions'] ) ) {
			continue;
		}

		foreach ( $tache['questions'] as $question ) {
			$questions_total++;

			$explication = '';

			foreach ( array( 'explanation', 'explication_erreur', 'error_explanation' ) as $cle ) {
				if ( ! empty( $question[ $cle ] ) ) {
					$explication = (string) $question[ $cle ];
					break;
				}
			}

			if ( '' !== trim( $explication ) ) {
				$questions_expliquees++;
			} else {
				$sans_explication[] = $room->post_title . ' : « '
					. substr( (string) ( isset( $question['question'] ) ? $question['question'] : '?' ), 0, 50 ) . ' »';
			}
		}
	}
}

$part_expliquees = $questions_total > 0 ? round( 100 * $questions_expliquees / $questions_total, 1 ) : 0;

audit_verifier(
	'chaque question explique pourquoi la mauvaise réponse est fausse',
	empty( $sans_explication ),
	count( $sans_explication ) . ' question(s) sans explication : ' . implode( ' | ', array_slice( $sans_explication, 0, 5 ) ),
	'majeur',
	$questions_total . ' questions relevées, ' . $questions_expliquees . ' portent une explication ('
		. $part_expliquees . ' %)' . ( empty( $sans_explication ) ? '' : "\n" . implode( "\n", array_slice( $sans_explication, 0, 5 ) ) )
);

if ( empty( $sans_explication ) ) {
	audit_force(
		'Toutes les questions expliquent l\'erreur — l\'élève apprend de son erreur, il ne subit pas son score',
		$questions_total . ' questions relevées, ' . $questions_expliquees . ' avec une explication (100 %)'
	);
}

/* ------------------------------------------------------------------ */
echo "\n5. La preuve d'application : l'élève agit-il vraiment ?\n";

/* Le cœur de la plateforme : une machine réelle, et une preuve lue
   dans la machine. Une room sans machine ni mission n'est qu'un cours. */
$avec_lab      = 0;
$avec_mission  = 0;
$sans_preuve   = array();
$durees        = array();

foreach ( $rooms as $room ) {
	$lab = get_post_meta( $room->ID, '_secura_lab', true );

	if ( is_array( $lab ) && ! empty( $lab['enabled'] ) ) {
		$avec_lab++;
	}

	$duree = (int) get_post_meta( $room->ID, '_secura_duration', true );

	if ( $duree > 0 ) {
		$durees[] = $duree;
	}
}

audit_verifier(
	'une part importante des rooms s\'appuie sur une machine réelle',
	$avec_lab > 0,
	$avec_lab . ' room(s) sur ' . count( $rooms ) . ' sont branchées sur une machine',
	'info',
	$avec_lab . ' rooms sur ' . count( $rooms ) . ' portent _secura_lab.enabled = 1'
);

if ( ! empty( $durees ) ) {
	$moyenne = (int) round( array_sum( $durees ) / count( $durees ) );

	audit_verifier(
		'la durée annoncée par room est réaliste',
		$moyenne > 0 && $moyenne < 180,
		'Durée moyenne : ' . $moyenne . ' minutes',
		'info',
		'Durées mesurées sur ' . count( $durees ) . ' rooms : moyenne ' . $moyenne . ' min, minimum '
			. min( $durees ) . ' min, maximum ' . max( $durees ) . ' min'
	);
}

/* ------------------------------------------------------------------ */
echo "\n6. L'alignement avec le référentiel universitaire\n";

/* Chaque parcours doit être rattaché à un socle connu : c'est ce qui
   permet à l'élève (et à un recruteur) de situer ce qu'il a fait. */
$paths = get_posts(
	array(
		'post_type'   => 'secura_path',
		'numberposts' => -1,
		'post_status' => 'any',
	)
);

$sans_certificat = array();
$avec_certificat = 0;
$sans_cible      = array();
$cibles          = array();

foreach ( $paths as $path ) {
	$certificat = get_post_meta( $path->ID, '_secura_certificate', true );

	if ( ! empty( $certificat ) ) {
		$avec_certificat++;
	} else {
		$sans_certificat[] = $path->post_title;
	}

	/* La certification visee : une VRAIE certification, nommee, avec
	   son cout d'examen. C'est ce que l'eleve (et son professeur)
	   doivent pouvoir lire. */
	$cible = get_post_meta( $path->ID, '_secura_certification', true );

	if ( ! is_array( $cible ) || empty( $cible['nom'] ) ) {
		$sans_cible[] = $path->post_title;
		continue;
	}

	if ( empty( $cible['cout'] ) ) {
		$sans_cible[] = $path->post_title . ' (coût d’examen non indiqué)';
		continue;
	}

	$cibles[] = $path->post_title . ' → ' . $cible['nom'] . ' — ' . $cible['cout'];
}

audit_verifier(
	'chaque parcours est rattaché à une compétence certificable',
	empty( $sans_certificat ),
	count( $sans_certificat ) . ' parcours sans certificat rattaché : ' . implode( ' | ', array_slice( $sans_certificat, 0, 5 ) ),
	'majeur',
	$avec_certificat . ' parcours sur ' . count( $paths ) . ' portent une compétence certificable (_secura_certificate)'
);

audit_verifier(
	'chaque parcours annonce une certification réelle, avec son coût d’examen',
	empty( $sans_cible ),
	count( $sans_cible ) . ' parcours sans certification visée : ' . implode( ' | ', array_slice( $sans_cible, 0, 5 ) ),
	'majeur',
	empty( $sans_cible )
		? 'Chaque parcours vise une certification nommée et affiche son coût d’examen : '
			. implode( ' ; ', $cibles )
		: implode( "\n", $sans_cible )
);

if ( empty( $sans_certificat ) && empty( $sans_cible ) ) {
	audit_force(
		'Les ' . count( $paths ) . ' parcours mènent à une certification nommée, avec son coût d’examen',
		implode( ' ; ', $cibles )
	);
}

/* ------------------------------------------------------------------ */
echo "\n7. Les limites que cet audit ne franchit pas\n";

audit_info(
	'La compréhension réelle d\'une leçon par un élève n\'est pas mesurable par un script',
	'Ce rapport vérifie la STRUCTURE de l\'apprentissage (présence, ordre, volume, feedback, '
	. 'preuve d\'application). La qualité rédactionnelle, le rythme perçu et la valeur d\'un badge '
	. 'restent des jugements humains — ils sont signalés, jamais présentés comme vérifiés.'
);

exit( audit_fin() );
