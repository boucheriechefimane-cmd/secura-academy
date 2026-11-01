<?php
/**
 * Recette de bout en bout, dans un WordPress réel.
 *
 * Ce script s'exécute dans WordPress (via « wp eval-file »). Il vérifie
 * que la plateforme fonctionne vraiment :
 *
 *   1. le plugin est bien chargé et les contenu sont là ;
 *   2. un QCM se valide, l'XP monte, une mauvaise réponse est refusée ;
 *   3. la bonne réponse ne quitte jamais le serveur ;
 *   4. les trois langues sont bien présentes dans une room ;
 *   5. (option --avec-machine) une mission se valide par un drapeau lu
 *      dans la vraie machine de l'apprenant, et une mauvaise réponse est
 *      refusée.
 *
 * Il sort avec le code 1 si une vérification échoue : la CI peut donc
 * transformer ce fichier en barrière automatique.
 *
 * Utilisation :
 *   wp eval-file tools/recette-apprenants/wp-e2e.php
 *   wp eval-file tools/recette-apprenants/wp-e2e.php --avec-machine
 */

$avec_machine = in_array( '--avec-machine', isset( $args ) ? (array) $args : array(), true );

/* « wp eval-file » exécute le fichier dans une fonction : les compteurs
   vivent donc dans les variables globales, sinon ils resteraient à zéro. */
$GLOBALS['seca_e2e_ok']  = 0;
$GLOBALS['seca_e2e_ko']  = 0;

function verifier( $libelle, $condition, $detail = '' ) {
	if ( $condition ) {
		$GLOBALS['seca_e2e_ok']++;
		printf( "  ok   %s\n", $libelle );
	} else {
		$GLOBALS['seca_e2e_ko']++;
		printf( "  ECHEC %s%s\n", $libelle, ( '' !== $detail ? ' — ' . $detail : '' ) );
	}
}

echo "\n=== Recette de bout en bout (WordPress réel) ===\n";

/* ------------------------------------------------------------------ */
echo "\n1. Le plugin et les contenus\n";

verifier( 'le plugin est chargé', class_exists( 'Secura_Rooms' ) && class_exists( 'Secura_Ajax' ) );

$rooms = get_posts(
	array(
		'post_type'   => 'secura_room',
		'post_status' => 'publish',
		'numberposts' => -1,
	)
);

$paths = get_posts(
	array(
		'post_type'   => 'secura_path',
		'post_status' => 'publish',
		'numberposts' => -1,
	)
);

verifier( 'les rooms sont là (au moins 6)', count( $rooms ) >= 6, 'trouvées : ' . count( $rooms ) );
verifier( 'les parcours sont là (au moins 1)', count( $paths ) >= 1, 'trouvés : ' . count( $paths ) );

$m3 = 0;

foreach ( $rooms as $room ) {
	if ( 'm3' === get_post_meta( $room->ID, '_secura_track', true ) ) {
		$m3++;
	}
}

verifier( 'les scénarios M3 sont là (10)', 10 === $m3, 'trouvés : ' . $m3 );

/* ------------------------------------------------------------------ */
echo "\n2. Les trois langues\n";

$room_fr = null;

foreach ( $rooms as $room ) {
	if ( ! $room_fr ) {
		$room_fr = $room;
	}
}

$i18n = get_post_meta( $room_fr->ID, '_secura_i18n', true );

$langues = is_array( $i18n ) ? array_keys( $i18n ) : array();
$francais = '' !== trim( (string) get_post_field( 'post_title', $room_fr->ID ) );

verifier(
	'la room porte le français (contenu de base)',
	$francais,
	$room_fr->post_title
);

verifier(
	'la room porte les traductions arabe et anglaise',
	count( array_intersect( array( 'ar', 'en' ), $langues ) ) === 2,
	implode( ',', $langues )
);

/* ------------------------------------------------------------------ */
echo "\n3. Un QCM se valide, et l'XP monte\n";

if ( ! defined( 'DOING_AJAX' ) ) {
	define( 'DOING_AJAX', true );
}

/* « wp_send_json » termine le script : on l'intercepte pour pouvoir
   enchaîner plusieurs appels dans le même passage. */
add_filter(
	'wp_die_ajax_handler',
	function () {
		return function ( $message, $title = '', $args = array() ) {
			throw new Exception( is_string( $message ) ? $message : wp_json_encode( $message ) );
		};
	}
);

function repondre_a( $room_id, $task, $question, $answer ) {
	$_POST = array(
		'room_id'  => $room_id,
		'task'     => $task,
		'question' => $question,
		'answer'   => $answer,
		'nonce'    => wp_create_nonce( 'secura_academy' ),
	);
	$_REQUEST = $_POST;

	/* WordPress ecrit la reponse JSON puis termine le script : on capture
	   ce qui est ecrit, c'est la seule maniere fiable de la lire. */
	ob_start();
	$message = '';

	try {
		Secura_Ajax::validate_answer();
	} catch ( Exception $exception ) {
		$message = $exception->getMessage();
	}

	$sortie  = ob_get_clean();
	$payload = json_decode( $sortie, true );

	if ( ! is_array( $payload ) && '' !== $message ) {
		$payload = json_decode( $message, true );
	}

	return is_array( $payload ) ? $payload : array( 'success' => false );
}

/* Un apprenant tout neuf a chaque execution : la recette doit pouvoir
   etre rejouee autant de fois qu'on veut, avec le meme resultat. */
$jeton      = substr( md5( (string) microtime( true ) . getmypid() ), 0, 8 );
$identifiant = 'recette-' . $jeton;
$courriel   = $identifiant . '@secura-academy.local';

if ( get_user_by( 'login', $identifiant ) ) {
	wp_delete_user( get_user_by( 'login', $identifiant )->ID );
}

$user_id = wp_insert_user(
	array(
		'user_login' => $identifiant,
		'user_pass'  => wp_generate_password( 20 ),
		'user_email' => $courriel,
		'role'       => 'subscriber',
	)
);

if ( is_wp_error( $user_id ) ) {
	verifier( 'un apprenant de test peut etre cree', false, $user_id->get_error_message() );
} else {
	wp_set_current_user( $user_id );

	$room_m3 = null;

	foreach ( $rooms as $room ) {
		if ( 'm3' === get_post_meta( $room->ID, '_secura_track', true ) ) {
			$room_m3 = $room;
			break;
		}
	}

	if ( ! $room_m3 ) {
		verifier( 'un scénario M3 est disponible', false );
	} else {
		$taches = get_post_meta( $room_m3->ID, '_secura_tasks', true );

		$xp_avant = (int) get_user_meta( $user_id, 'secura_xp', true );

		/* Leçon : elle ouvre la suite. */
		$_POST = array(
			'room_id' => $room_m3->ID,
			'task'    => 0,
			'nonce'   => wp_create_nonce( 'secura_academy' ),
		);
		$_REQUEST = $_POST;

		ob_start();

		try {
			Secura_Ajax::complete_lesson();
		} catch ( Exception $exception ) {
			// La fin de script est interceptee : c'est normal.
			unset( $exception );
		}

		ob_end_clean();

		/* Entraînement : la première question à choix. */
		$pratique = isset( $taches[1]['questions'] ) ? $taches[1]['questions'] : array();
		$bonne    = '';
		$mode     = '';

		foreach ( $pratique as $question ) {
			if ( 'choice' === ( isset( $question['mode'] ) ? $question['mode'] : 'text' ) ) {
				$bonne = $question['choices'][ $question['correct'] ];
				$mode  = 'choice';
				break;
			}
		}

		if ( '' === $bonne ) {
			verifier( 'une question à choix existe dans l’entraînement', false );
		} else {
			$mauvaise = '';

			foreach ( $pratique[0]['choices'] as $choix ) {
				if ( $choix !== $bonne ) {
					$mauvaise = $choix;
					break;
				}
			}

			$refusee = repondre_a( $room_m3->ID, 1, 0, $mauvaise );
			verifier(
				'une mauvaise proposition est refusée',
				isset( $refusee['data']['correct'] ) && false === $refusee['data']['correct'],
				wp_json_encode( $refusee )
			);

			$acceptée = repondre_a( $room_m3->ID, 1, 0, $bonne );
			verifier( 'la bonne proposition est acceptée', ! empty( $acceptée['success'] ), wp_json_encode( $acceptée ) );

			$xp_apres = (int) get_user_meta( $user_id, 'secura_xp', true );
			verifier( 'l’XP a monté', $xp_apres > $xp_avant, $xp_avant . ' -> ' . $xp_apres );
		}

		/* Ce que le client reçoit : jamais la bonne réponse. */
		$_POST = array(
			'room_id' => $room_m3->ID,
			'task'    => 1,
			'nonce'   => wp_create_nonce( 'secura_academy' ),
		);
		$_REQUEST = $_POST;

		$envoye = null;

		ob_start();

		try {
			Secura_Ajax::get_task();
		} catch ( Exception $exception ) {
			$envoye = json_decode( $exception->getMessage(), true );
		}

		$sortie = ob_get_clean();

		if ( ! is_array( $envoye ) ) {
			$envoye = json_decode( $sortie, true );
		}

		$expose = false;

		if ( is_array( $envoye ) && isset( $envoye['data']['task']['questions'] ) ) {
			foreach ( $envoye['data']['task']['questions'] as $question ) {
				if ( isset( $question['correct'] ) || isset( $question['answers'] ) || isset( $question['flag_path'] ) ) {
					$expose = true;
				}
			}
		}

		verifier( 'la bonne réponse ne quitte jamais le serveur', ! $expose );
	}
}

/* ------------------------------------------------------------------ */
if ( $avec_machine ) {
	echo "\n4. Une mission se valide par le drapeau de la vraie machine\n";

	$room_m3 = null;

	foreach ( $rooms as $room ) {
		if ( 'm3' === get_post_meta( $room->ID, '_secura_track', true ) ) {
			$room_m3 = $room;
			break;
		}
	}

	if ( ! $room_m3 ) {
		verifier( 'un scénario M3 est disponible', false );
	} else {
		wp_set_current_user( $user_id );

		set_transient( 'seca_docker_available', '1', 300 );

		$demarrage = Secura_Lab::start( $user_id, $room_m3->ID );
		verifier( 'la machine de l’apprenant se déploie', ! empty( $demarrage['ok'] ), wp_json_encode( $demarrage ) );

		if ( ! empty( $demarrage['ok'] ) ) {
			$taches  = get_post_meta( $room_m3->ID, '_secura_tasks', true );
			$mission = isset( $taches[2]['questions'][0] ) ? $taches[2]['questions'][0] : array();

			/* Le drapeau attendu n'est pas dans le contenu (il est dans
			   la machine) : on va le lire dans les sources des labs,
			   comme le ferait un joueur qui trouve le fichier. */
			$manifeste = get_post_meta( $room_m3->ID, '_secura_lab', true );
			$image     = isset( $manifeste['image'] ) ? $manifeste['image'] : '';
			$service   = isset( $manifeste['flag_service'] ) && $manifeste['flag_service'] ? $manifeste['flag_service'] : '';
			$chemin    = isset( $mission['flag_path'] ) ? $mission['flag_path'] : '';

			$laboratoires = Secura_Lab::labs_path();
			$dossier      = '';

			if ( '' !== $image ) {
				$dossier = preg_replace( '/^securalabs\//', '', preg_replace( '/:.*$/', '', $image ) );
			}

			$attendu = '';

			if ( '' !== $chemin && '' !== $dossier && $laboratoires ) {
				$source = $laboratoires . '/' . $dossier . '/flag/' . basename( $chemin );

				if ( is_readable( $source ) ) {
					$attendu = trim( (string) file_get_contents( $source ) );
				}
			}

			if ( '' === $attendu ) {
				verifier( 'le drapeau attendu est lisible dans les sources des labs', false, $chemin );
			} else {
				$refusee = repondre_a( $room_m3->ID, 2, 0, 'FLAG=SECURA{bidon}' );
				verifier(
					'un mauvais drapeau est refusé',
					isset( $refusee['data']['correct'] ) && false === $refusee['data']['correct'],
					wp_json_encode( $refusee )
				);

				$acceptée = repondre_a( $room_m3->ID, 2, 0, $attendu );
				verifier( 'le bon drapeau est accepté', ! empty( $acceptée['success'] ), wp_json_encode( $acceptée ) );
			}

			Secura_Lab::stop( $user_id, $room_m3->ID );
		}
	}
}

echo "\n=== Résultat : " . (int) $GLOBALS['seca_e2e_ok'] . " réussi(s), " . (int) $GLOBALS['seca_e2e_ko'] . " échec(s) ===\n";

if ( (int) $GLOBALS['seca_e2e_ko'] > 0 ) {
	exit( 1 );
}

exit( 0 );
