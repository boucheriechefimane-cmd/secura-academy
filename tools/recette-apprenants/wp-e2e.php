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

/* WP-CLI n'accepte pas de parametre inconnu sur « eval-file » : le mode
   « avec les vraies machines » passe donc par une variable
   d'environnement (SECA_AVEC_MACHINE=1). */
$avec_machine = ( '1' === (string) getenv( 'SECA_AVEC_MACHINE' ) )
	|| in_array( '--avec-machine', isset( $args ) ? (array) $args : array(), true );

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

/**
 * Telecharge une adresse du site, en conservant le nom d'hote declare.
 *
 * WordPress peut rediriger une requete dont l'hote ne correspond pas a
 * l'adresse du site (code 301). On renvoie alors l'adresse canonique
 * declaree, qui est la bonne.
 *
 * @param string $url L'adresse a telecharger.
 * @return array Le corps de la reponse et son code.
 */
function securite_telecharger( $url ) {
	$reponse = wp_remote_get(
		$url,
		array(
			'timeout'     => 20,
			'redirection' => 5,
			'sslverify'   => false,
		)
	);

	if ( is_wp_error( $reponse ) ) {
		return array( '', 0 );
	}

	$code = (int) wp_remote_retrieve_response_code( $reponse );

	/* Une redirection vers l'adresse du site : on la suit a la main,
	   en gardant le nom d'hote attendu par WordPress. */
	if ( 301 === $code || 302 === $code ) {
		$hote = wp_parse_url( home_url( '/' ), PHP_URL_HOST );
		$port = wp_parse_url( home_url( '/' ), PHP_URL_PORT );

		if ( $hote ) {
			$cible = 'http://' . $hote . ( $port ? ':' . $port : '' ) . wp_parse_url( $url, PHP_URL_PATH );

			$second = wp_remote_get(
				$cible,
				array(
					'timeout'   => 20,
					'sslverify' => false,
					'headers'   => array( 'Host' => $hote . ( $port ? ':' . $port : '' ) ),
				)
			);

			if ( ! is_wp_error( $second ) ) {
				return array( wp_remote_retrieve_body( $second ), (int) wp_remote_retrieve_response_code( $second ) );
			}
		}
	}

	return array( wp_remote_retrieve_body( $reponse ), $code );
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

/* Le bloc universitaire : les 22 rooms de cours et les 14 rooms des
   labs avancés. */
$universites = 0;
$avance      = 0;
$avec_video  = 0;
$avec_kahoot = 0;

foreach ( $rooms as $room ) {
	$track = get_post_meta( $room->ID, '_secura_track', true );

	if ( 'universites' === $track ) {
		$universites++;
	} elseif ( 'avance' === $track ) {
		$avance++;
	}

	if ( get_post_meta( $room->ID, '_secura_video', true ) ) {
		$avec_video++;
	}

	if ( get_post_meta( $room->ID, '_secura_kahoot', true ) ) {
		$avec_kahoot++;
	}
}

/* Rejouer l'activation (ce que fait WordPress a chaque mise a jour du
   plugin) ne doit ni dupliquer les rooms, ni dupliquer les parcours,
   ni ecraser une room retouchee par l'enseignant. */
$avant_rooms    = count( $rooms );
$avant_parcours = count( $paths );

Secura_Rooms::activate();

$apres_rooms = count( get_posts( array( 'post_type' => 'secura_room', 'post_status' => 'any', 'numberposts' => -1 ) ) );
$apres_chemins = count( get_posts( array( 'post_type' => 'secura_path', 'post_status' => 'any', 'numberposts' => -1 ) ) );

verifier( 'réactiver le plugin ne duplique pas les rooms', $avant_rooms === $apres_rooms, 'avant : ' . $avant_rooms . ' après : ' . $apres_rooms );
verifier( 'réactiver le plugin ne duplique pas les parcours', $avant_parcours === $apres_chemins, 'avant : ' . $avant_parcours . ' après : ' . $apres_chemins );

verifier( 'les rooms universitaires sont là (22)', 22 === $universites, 'trouvées : ' . $universites );
verifier( 'les rooms des labs avancés sont là (14)', 14 === $avance, 'trouvées : ' . $avance );
verifier( 'chaque room universitaire a sa vidéo (36)', 36 === $avec_video, 'trouvées : ' . $avec_video );
verifier( 'le quiz Kahoot est installé (1)', 1 === $avec_kahoot, 'trouvés : ' . $avec_kahoot );

/* La façade vidéo : la page de la room contient l'image et le bouton,
   mais aucune balise iframe tant que l'élève n'a pas cliqué. */
$room_video = null;

foreach ( $rooms as $room ) {
	if ( get_post_meta( $room->ID, '_secura_video', true ) ) {
		$room_video = $room;
		break;
	}
}

if ( ! $room_video ) {
	verifier( 'une room avec vidéo est disponible', false );
} else {
	$page = do_shortcode( '[secura_academy_room id="' . $room_video->ID . '"]' );

	verifier( 'la façade vidéo est affichée', false !== strpos( $page, 'seca-video' ) );
	verifier( 'aucune iframe n’est chargée avant le clic', false === strpos( $page, '<iframe' ) );
	verifier( 'le lien vers la source reste visible', false !== strpos( $page, 'youtube.com/watch' ) );
}

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

			/* Le verrouillage progressif est actif : la mission n'est
			   ouverte que si l'entrainement est termine. On finit donc
			   l'entrainement (on repond juste a chaque question). */
			$pratique = isset( $taches[1]['questions'] ) ? $taches[1]['questions'] : array();

			foreach ( $pratique as $index => $question ) {
				$bonne = '';

				if ( 'choice' === ( isset( $question['mode'] ) ? $question['mode'] : 'text' ) ) {
					$bonne = $question['choices'][ $question['correct'] ];
				} elseif ( isset( $question['answers'][0] ) ) {
					$bonne = $question['answers'][0];
				}

				if ( '' !== $bonne ) {
					repondre_a( $room_m3->ID, 1, $index, $bonne );
				}
			}

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

/* ------------------------------------------------------------------ */
echo "\n4. Le site vu de l'extérieur : maillage et robots\n";

/* La page d'accueil doit exister et proposer les parcours : sans elle,
   le site commence par le texte de demonstration de WordPress et les
   rooms ne sont atteignables que par le plan du site. */
$page_parcours = get_page_by_path( 'parcours' );

verifier(
	'la page « Parcours » existe',
	(bool) $page_parcours,
	'page introuvable'
);

verifier(
	'la page « Parcours » est publiée',
	$page_parcours && 'publish' === $page_parcours->post_status,
	$page_parcours ? $page_parcours->post_status : '(absente)'
);

verifier(
	'le site affiche la page « Parcours » en accueil',
	'page' === get_option( 'show_on_front' ) && (int) get_option( 'page_on_front' ) > 0,
	'show_on_front = ' . get_option( 'show_on_front' ) . ', page_on_front = ' . get_option( 'page_on_front' )
);

verifier(
	'le shortcode de la plateforme est sur la page d\'accueil',
	$page_parcours && false !== strpos( (string) $page_parcours->post_content, '[secura_academy' ),
	'contenu : ' . ( $page_parcours ? substr( (string) $page_parcours->post_content, 0, 60 ) : '(absente)' )
);

/* Chaque room doit etre liee depuis son parcours : c'est le chemin que
   suivent les robots, et le seul que l'eleve suive. */
$rooms_liees = 0;

foreach ( $paths as $parcours ) {
	$page = get_permalink( $parcours->ID );
	list( $corps, $code_page ) = securite_telecharger( $page );

	if ( '' === $corps ) {
		continue;
	}

	if ( false !== strpos( $corps, '/rooms/' ) ) {
		$rooms_liees++;
	}
}

verifier(
	'chaque parcours lie ses rooms par de vrais liens',
	count( $paths ) === $rooms_liees,
	$rooms_liees . ' parcours sur ' . count( $paths )
);

/* Le fichier robots.txt doit nommer les robots d'IA et les autoriser. */
list( $robots_txt, $code_robots ) = securite_telecharger( home_url( '/robots.txt' ) );

verifier(
	'le fichier robots.txt est servi',
	'' !== trim( $robots_txt ),
	'robots.txt vide (code ' . $code_robots . ')'
);

$robots_ia = array( 'Googlebot', 'OAI-SearchBot', 'ChatGPT-User', 'Claude-SearchBot', 'Claude-User', 'PerplexityBot', 'GPTBot', 'ClaudeBot', 'Google-Extended' );

$robots_absents = array();

foreach ( $robots_ia as $robot ) {
	if ( false === stripos( $robots_txt, 'User-agent: ' . $robot ) ) {
		$robots_absents[] = $robot;
	}
}

verifier(
	'robots.txt nomme les robots d\'IA',
	empty( $robots_absents ),
	'robots absents : ' . implode( ', ', $robots_absents )
		. ' | code ' . $code_robots
		. ' | debut : ' . substr( preg_replace( '/\s+/', ' ', (string) $robots_txt ), 0, 200 )
);

/* On compare ligne par ligne : « Disallow: /wp-admin/ » contient la
   chaine « Disallow: / » mais ne ferme évidemment pas tout le site. */
$ferme_tout = false;

foreach ( preg_split( '/\r\n|\r|\n/', $robots_txt ) as $ligne_robots ) {
	if ( 'disallow: /' === strtolower( trim( $ligne_robots ) ) ) {
		$ferme_tout = true;
	}
}

verifier(
	'robots.txt ne ferme pas tout le site',
	! $ferme_tout,
	'le site se ferme lui-meme a l\'indexation'
);

verifier(
	'robots.txt declare le plan du site',
	false !== stripos( $robots_txt, 'Sitemap:' ),
	'aucun Sitemap: dans robots.txt (code ' . $code_robots . ')'
);

/* Le fichier llms.txt est genere : il doit repondre, et lister les rooms. */
list( $llms_txt, $code_llms ) = securite_telecharger( home_url( '/llms.txt' ) );

verifier(
	'le fichier llms.txt est servi',
	'' !== trim( $llms_txt ),
	'llms.txt vide (code ' . $code_llms . ')'
);

verifier(
	'llms.txt cite les rooms avec leurs adresses',
	false !== strpos( $llms_txt, '/rooms/' ),
	'aucune adresse de room dans llms.txt (code ' . $code_llms . ') | debut : '
		. substr( preg_replace( '/\s+/', ' ', (string) $llms_txt ), 0, 200 )
);

/* L'archive d'auteur ne doit pas exposer le compte d'administration. */
list( $corps_auteur, $code_auteur ) = securite_telecharger( home_url( '/author/admin/' ) );

verifier(
	'l\'archive d\'auteur est fermee',
	404 === (int) $code_auteur,
	'code recu : ' . $code_auteur
);

echo "\n=== Résultat : " . (int) $GLOBALS['seca_e2e_ok'] . " réussi(s), " . (int) $GLOBALS['seca_e2e_ko'] . " échec(s) ===\n";

if ( (int) $GLOBALS['seca_e2e_ko'] > 0 ) {
	exit( 1 );
}

exit( 0 );
