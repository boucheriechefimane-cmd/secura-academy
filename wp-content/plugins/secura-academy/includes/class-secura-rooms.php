<?php
/**
 * Type de contenu « Rooms » : tâches, traductions, contenu par défaut.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Gère le CPT Room, ses tâches et ses traductions.
 */
final class Secura_Rooms {

	/**
	 * Reserve de questions importees, par room.
	 *
	 * Les questions importees d'une universite (licence CC BY-NC-SA) sont
	 * reservees : elles alimentent le reservoir des epreuves de la section
	 * (c'est ce qui fait varier les copies d'examen), mais elles ne doivent
	 * JAMAIS gonfler un point de controle. Le test doit avoir la taille de
	 * l'epreuve, jamais plus (cf. Secura_Exam::paper()).
	 *
	 * @var array
	 */
	private static $reserve = array();

	/**
	 * Types de question possibles.
	 *
	 * @return array
	 */
	public static function question_modes() {
		return array(
			'text'   => __( 'Reponse libre', 'seca-academy' ),
			'choice' => __( 'Choix multiple (une seule bonne reponse)', 'seca-academy' ),
			'action' => __( "Sans reponse (l'apprenant realise l'action)", 'seca-academy' ),
			'flag'   => __( 'Drapeau (verifie dans la machine de l\'apprenant)', 'seca-academy' ),
		);
	}

	/**
	 * Formats de tâche possibles.
	 *
	 * @return array
	 */
	public static function task_formats() {
		return array(
			'lecon'    => __( 'Leçon', 'seca-academy' ),
			'qcm'      => __( 'QCM', 'seca-academy' ),
			'pratique' => __( 'Pratique', 'seca-academy' ),
			'mixte'    => __( 'Mixte', 'seca-academy' ),
		);
	}

	/**
	 * Format par défaut d'une tâche, déduit de son type.
	 *
	 * @param string $type     Type de tâche.
	 * @param array  $terminal Définition du terminal.
	 * @return string
	 */
	public static function default_format( $type, $terminal = array() ) {
		if ( 'lesson' === $type ) {
			return 'lecon';
		}

		if ( 'test' === $type && ! empty( $terminal['steps'] ) ) {
			return 'mixte';
		}

		return 'qcm';
	}

	/**
	 * Types de tâches reconnus.
	 *
	 * @return array
	 */
	public static function task_types() {
		return array(
			'lesson'   => __( 'Leçon', 'seca-academy' ),
			'practice' => __( 'Entraînement', 'seca-academy' ),
			'test'     => __( "Test d'application", 'seca-academy' ),
			'exam'     => __( 'Examen', 'seca-academy' ),
		);
	}

	/**
	 * Branche les hooks.
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_post_type' ) );
		add_action( 'add_meta_boxes', array( __CLASS__, 'add_meta_boxes' ) );
		add_action( 'save_post_' . SECURA_POST_TYPE, array( __CLASS__, 'save_room' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_assets' ) );
	}

	/**
	 * Enregistre le type de contenu.
	 */
	public static function register_post_type() {
		$labels = array(
			'name'               => __( 'Rooms', 'seca-academy' ),
			'singular_name'      => __( 'Room', 'seca-academy' ),
			'menu_name'          => __( 'Rooms', 'seca-academy' ),
			'add_new'            => __( 'Ajouter', 'seca-academy' ),
			'add_new_item'       => __( 'Ajouter une nouvelle room', 'seca-academy' ),
			'edit_item'          => __( 'Modifier la room', 'seca-academy' ),
			'new_item'           => __( 'Nouvelle room', 'seca-academy' ),
			'search_items'       => __( 'Rechercher une room', 'seca-academy' ),
			'not_found'          => __( 'Aucune room trouvée.', 'seca-academy' ),
			'not_found_in_trash' => __( 'Aucune room dans la corbeille.', 'seca-academy' ),
			'all_items'          => __( 'Toutes les rooms', 'seca-academy' ),
		);

		register_post_type(
			SECURA_POST_TYPE,
			array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_rest'       => false,
				'has_archive'        => false,
				'hierarchical'       => false,
				'menu_position'      => 26,
				'menu_icon'          => 'dashicons-shield-alt',
				'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
				'rewrite'            => array( 'slug' => 'rooms', 'with_front' => false ),
				'capability_type'    => 'post',
			)
		);
	}

	/**
	 * Crée le contenu de démonstration à l'activation.
	 */
	public static function activate() {
		self::register_post_type();
		Secura_Paths::register_post_type();

		$existing = get_posts(
			array(
				'post_type'      => SECURA_POST_TYPE,
				'post_status'    => 'any',
				'numberposts'    => 1,
				'fields'         => 'ids',
				'no_found_rows'  => true,
				'suppress_filters' => false,
			)
		);

		/* Les rooms sont (re)creees a chaque activation : les nouvelles
		   rooms d'une mise a jour apparaissent, et les corrections de
		   contenu sont livrees — sauf si un enseignant a retouche la room. */
		self::create_default_rooms();

		Secura_Paths::create_default_paths();
		Secura_Progress::maybe_create_table();

		/* La page d'accueil et le nettoyage des textes de demonstration
		   de WordPress : sans cela, le site commence par afficher
		   « Bonjour tout le monde ! » et n'expose aucun parcours. */
		Secura_Site::install();

		flush_rewrite_rules();
	}

	/**
	 * Insère les rooms et les parcours de démonstration.
	 *
	 * Cette méthode est idempotente : elle peut être rejouée à chaque
	 * activation du plugin. Les rooms déjà installées sont mises à jour
	 * (pour livrer les corrections de contenu), mais seulement si
	 * l'enseignant ne les a pas retouchées : la progression des élèves
	 * n'est jamais touchée.
	 */
	public static function create_default_rooms() {
		$order = 0;

		/* Les rooms de démonstration viennent d'abord, puis les dix
		   scenarios M3 (parcours « Scenarios M3 »), puis les vingt-deux
		   rooms universitaires et les quatorze rooms des labs avances. */
		$blocs = array(
			'demo'   => seca_default_rooms(),
			'm3'     => seca_default_rooms_m3(),
			'univ'   => seca_default_rooms_universites(),
			'avance' => seca_default_rooms_avance(),
		);

		/* Les rooms deja installees, retrouvees par leur cle stable. */
		$existantes = array();

		$ids = get_posts(
			array(
				'post_type'      => SECURA_POST_TYPE,
				'post_status'    => 'any',
				'numberposts'    => -1,
				'fields'         => 'ids',
				'no_found_rows'  => true,
				'suppress_filters' => false,
			)
		);

		/* Les titres de reference : ils permettent de reconnaitre les
		   rooms installees avant l'existence des cles (mise a jour). */
		$titres = array();

		foreach ( $blocs as $nom_bloc => $liste ) {
			$index = 0;

			foreach ( $liste as $room ) {
				$titres[ $room['title'] ] = $nom_bloc . '-' . sprintf( '%02d', $index + 1 );

				$index++;
			}
		}

		foreach ( (array) $ids as $id ) {
			$cle = get_post_meta( $id, '_secura_key', true );

			if ( ! $cle ) {
				/* Migration : une room installee avant les cles. */
				$post = get_post( $id );

				if ( $post && isset( $titres[ $post->post_title ] ) ) {
					$cle = $titres[ $post->post_title ];

					update_post_meta( $id, '_secura_key', $cle );
					update_post_meta( $id, '_secura_content_hash', self::content_hash( $id ) );
				}
			}

			if ( $cle ) {
				$existantes[ $cle ] = (int) $id;
			}
		}

		foreach ( $blocs as $nom_bloc => $liste ) {
			$index = 0;

			foreach ( $liste as $room ) {
				$cle = $nom_bloc . '-' . sprintf( '%02d', $index + 1 );

				$index++;

				$post_id = isset( $existantes[ $cle ] ) ? $existantes[ $cle ] : 0;

				if ( $post_id ) {
					/* La room existe : on ne la remplace que si personne
					   ne l'a retouchee (empreinte du contenu stocke). */
					$empreinte = self::content_hash( $post_id );

					if ( $empreinte && $empreinte !== get_post_meta( $post_id, '_secura_content_hash', true ) ) {
						$order++;

						continue;
					}

					wp_update_post(
						array(
							'ID'           => $post_id,
							'post_title'   => $room['title'],
							'post_excerpt' => $room['excerpt'],
							'post_content' => isset( $room['content'] ) ? $room['content'] : '',
							'menu_order'   => $order,
						)
					);
				} else {
					$post_id = wp_insert_post(
						array(
							'post_type'    => SECURA_POST_TYPE,
							'post_status'  => 'publish',
							'post_title'   => $room['title'],
							'post_excerpt' => $room['excerpt'],
							'post_content' => isset( $room['content'] ) ? $room['content'] : '',
							'menu_order'   => $order,
						),
						true
					);

					if ( is_wp_error( $post_id ) ) {
						continue;
					}
				}

				update_post_meta( $post_id, '_secura_key', $cle );
				update_post_meta( $post_id, SECURA_META_TASKS, $room['tasks'] );
			update_post_meta( $post_id, SECURA_META_DIFFICULTY, $room['difficulty'] );
			update_post_meta( $post_id, SECURA_META_DURATION, (int) $room['duration'] );
			update_post_meta( $post_id, SECURA_META_XP_BONUS, (int) $room['xp_bonus'] );
			update_post_meta( $post_id, SECURA_META_I18N, isset( $room['i18n'] ) ? $room['i18n'] : array() );

			if ( ! empty( $room['track'] ) ) {
				update_post_meta( $post_id, SECURA_META_TRACK, $room['track'] );
			}

			if ( ! empty( $room['lab'] ) ) {
				update_post_meta( $post_id, '_secura_lab', $room['lab'] );
			}

			/* La video du cours : une facade (rien n'est charge avant le
			   clic) et le bloc d'attribution sous la video. */
			if ( ! empty( $room['video'] ) && is_array( $room['video'] ) ) {
				update_post_meta( $post_id, Secura_Video::META, $room['video'] );
			}

			/* Le bloc Kahoot (facultatif) : le quiz de classe. */
			if ( ! empty( $room['kahoot'] ) && is_array( $room['kahoot'] ) ) {
				update_post_meta( $post_id, Secura_Kahoot::META, $room['kahoot'] );
			}

			/* L'empreinte du contenu de reference : elle permet de savoir,
			   a la prochaine activation, si un enseignant a retouche la
			   room (et donc de ne pas l'ecraser). */
			update_post_meta( $post_id, '_secura_content_hash', self::content_hash( $post_id ) );

			$order++;
			}
		}
	}

	/**
	 * L'empreinte du contenu d'une room (contenu + taches).
	 *
	 * @param int $post_id Identifiant de la room.
	 * @return string
	 */
	protected static function content_hash( $post_id ) {
		$post = get_post( $post_id );

		if ( ! $post ) {
			return '';
		}

		$taches = get_post_meta( $post_id, SECURA_META_TASKS, true );

		return md5( $post->post_content . '|' . wp_json_encode( $taches ) );
	}

	/**
	 * Liste les rooms publiées, dans l'ordre du parcours.
	 *
	 * @return WP_Post[]
	 */
	public static function get_rooms() {
		$rooms = get_posts(
			array(
				'post_type'      => SECURA_POST_TYPE,
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'suppress_filters' => false,
			)
		);

		return is_array( $rooms ) ? $rooms : array();
	}

	/**
	 * Tâches normalisées d'une room.
	 *
	 * @param int $room_id Identifiant de la room.
	 * @return array
	 */
	/**
	 * Les lots de questions importees, charges au demarrage du plugin.
	 *
	 * Chaque lot vient d'un fichier includes/content-import-*.php, donc
	 * d'une source dont la licence a ete verifiee (voir
	 * tools/sources-autorisees.json et docs/SOURCES-CONTENU.md).
	 *
	 * @return array Liste { source, rooms }.
	 */
	public static function imports() {
		static $imports = null;

		if ( null !== $imports ) {
			return $imports;
		}

		$imports = array();

		foreach ( (array) get_defined_functions()['user'] as $fonction ) {
			if ( 0 !== strpos( $fonction, 'seca_import_' ) ) {
				continue;
			}

			$lot = call_user_func( $fonction );

			if ( is_array( $lot ) && isset( $lot['rooms'] ) ) {
				$imports[] = $lot;
			}
		}

		return $imports;
	}

	/**
	 * Les sources citees dans les questions importees d'une room.
	 *
	 * @param int $room_id Identifiant de la room.
	 * @return array Liste { nom, url, licence, attribution }.
	 */
	public static function sources_importees( $room_id ) {
		$room = get_post( $room_id );

		if ( ! $room ) {
			return array();
		}

		$sources = array();

		foreach ( self::imports() as $lot ) {
			if ( empty( $lot['rooms'][ $room->post_name ] ) ) {
				continue;
			}

			$source = isset( $lot['source'] ) ? $lot['source'] : array();

			if ( empty( $source['attribution'] ) ) {
				continue;
			}

			$cle = $source['attribution'];

			if ( ! isset( $sources[ $cle ] ) ) {
				$sources[ $cle ] = array(
					'nom'         => isset( $source['nom'] ) ? $source['nom'] : '',
					'url'         => isset( $source['url'] ) ? $source['url'] : '',
					'licence'     => isset( $source['licence'] ) ? $source['licence'] : '',
					'attribution' => $source['attribution'],
				);
			}
		}

		return array_values( $sources );
	}

	/**
	 * Ajoute les questions importees aux taches d'une room.
	 *
	 * Les questions importees passent exactement par la meme
	 * normalisation que les autres : memes regles, memes champs.
	 *
	 * @param int   $room_id Identifiant de la room.
	 * @param array $taches  Taches brutes.
	 * @return array
	 */
	private static function ajoute_questions_importees( $room_id, array $taches ) {
		$room = get_post( $room_id );

		if ( ! $room ) {
			return $taches;
		}

		foreach ( self::imports() as $lot ) {
			if ( empty( $lot['rooms'][ $room->post_name ]['tasks'] ) ) {
				continue;
			}

			foreach ( (array) $lot['rooms'][ $room->post_name ]['tasks'] as $type => $questions ) {
				if ( ! is_array( $questions ) || empty( $questions ) ) {
					continue;
				}

				$index = null;

				foreach ( $taches as $cle => $tache ) {
					if ( isset( $tache['type'] ) && $tache['type'] === $type ) {
						$index = $cle;
						break;
					}
				}

				if ( null === $index ) {
					continue;
				}

				if ( ! isset( $taches[ $index ]['questions'] ) || ! is_array( $taches[ $index ]['questions'] ) ) {
					$taches[ $index ]['questions'] = array();
				}

				foreach ( $questions as $question ) {
					if ( ! is_array( $question ) ) {
						continue;
					}

					$taches[ $index ]['questions'][] = $question;
				}
			}
		}

		return $taches;
	}

	public static function get_tasks( $room_id ) {
		$room_id = absint( $room_id );

		if ( ! $room_id ) {
			return array();
		}

		$raw = get_post_meta( $room_id, SECURA_META_TASKS, true );

		if ( ! is_array( $raw ) ) {
			$raw = array();
		}

		$raw = self::ajoute_questions_importees( $room_id, $raw );

		$tasks = array();

		foreach ( $raw as $task ) {
			if ( ! is_array( $task ) ) {
				continue;
			}

			$type = isset( $task['type'] ) && array_key_exists( $task['type'], self::task_types() ) ? $task['type'] : 'practice';

			$questions = array();

			if ( isset( $task['questions'] ) && is_array( $task['questions'] ) ) {
				foreach ( $task['questions'] as $q_index => $question ) {
					if ( ! is_array( $question ) ) {
						continue;
					}

					$text = isset( $question['question'] ) ? trim( (string) $question['question'] ) : '';

					if ( '' === $text ) {
						continue;
					}

					$mode = isset( $question['mode'] ) ? sanitize_key( $question['mode'] ) : 'text';

					if ( ! in_array( $mode, array( 'text', 'choice', 'action', 'flag', 'solution' ), true ) ) {
						$mode = 'text';
					}

					$answers = array();

					if ( isset( $question['answers'] ) && is_array( $question['answers'] ) ) {
						foreach ( $question['answers'] as $answer ) {
							$answer = trim( (string) $answer );

							if ( '' !== $answer ) {
								$answers[] = $answer;
							}
						}
					} elseif ( isset( $question['answer'] ) ) {
						foreach ( explode( '|', (string) $question['answer'] ) as $answer ) {
							$answer = trim( $answer );

							if ( '' !== $answer ) {
								$answers[] = $answer;
							}
						}
					}

					$choices = array();

					if ( isset( $question['choices'] ) && is_array( $question['choices'] ) ) {
						foreach ( $question['choices'] as $choice ) {
							$choice = trim( (string) $choice );

							if ( '' !== $choice ) {
								$choices[] = $choice;
							}
						}
					}

					$correct = isset( $question['correct'] ) ? intval( $question['correct'] ) : -1;

					/* Une question « drapeau » ne porte pas de reponse
					   attendue : c'est le serveur qui va lire le fichier
					   du drapeau dans la machine de l'apprenant. */
					$flag_path = '';

					if ( 'flag' === $mode ) {
						$flag_path = isset( $question['flag_path'] ) ? Secura_Lab::safe_machine_path( $question['flag_path'] ) : '';
					}

					/* Une question « solution » est un vrai probleme d'examen
					  universitaire : l'eleve redige sa reponse, puis la
					   correction officielle de l'ecole lui est Montree. Elle
					   n'a donc ni propositions ni reponse attendue, mais elle
					  doit porter sa correction officielle — sinon elle
					  n'apprend rien. */
					$explication = isset( $question['explanation'] ) ? trim( (string) $question['explanation'] ) : '';

					if ( 'solution' === $mode && '' === $explication ) {
						continue;
					}

					if ( 'action' !== $mode && 'flag' !== $mode && 'solution' !== $mode && empty( $answers ) && empty( $choices ) ) {
						continue;
					}

					if ( 'flag' === $mode && '' === $flag_path ) {
						continue;
					}

					if ( 'choice' === $mode && ( $correct < 0 || $correct >= count( $choices ) ) ) {
						continue;
					}

					/* Les variantes paramétriques : une liste de jeux de
					   valeurs { cle => valeur }. Le moteur d'épreuves en
					   tire un par copie (voir Secura_Exam). */
					$variants = array();

					if ( isset( $question['variants'] ) && is_array( $question['variants'] ) ) {
						foreach ( $question['variants'] as $jeu ) {
							if ( ! is_array( $jeu ) ) {
								continue;
							}

							$nettoyage = array();

							foreach ( $jeu as $cle => $valeur ) {
								$cle = preg_replace( '/[^A-Za-z0-9_]/', '', (string) $cle );

								if ( '' !== $cle ) {
									$nettoyage[ $cle ] = (string) $valeur;
								}
							}

							if ( ! empty( $nettoyage ) ) {
								$variants[] = $nettoyage;
							}
						}
					}

					$questions[] = array(
						'question'      => $text,
						'mode'          => $mode,
						'variants'      => $variants,
						'flag_path'     => $flag_path,
						'answers'       => $answers,
						'choices'       => $choices,
						'correct'       => $correct,
						'xp'            => isset( $question['xp'] ) ? absint( $question['xp'] ) : 0,
						'hint'          => isset( $question['hint'] ) ? (string) $question['hint'] : '',
						'explanation'   => $explication,
						'weight'        => isset( $question['weight'] ) ? absint( $question['weight'] ) : 1,
						'requires_step' => isset( $question['requires_step'] ) ? intval( $question['requires_step'] ) : -1,
						'source'        => isset( $question['source'] ) ? (string) $question['source'] : '',
						'licence'       => isset( $question['licence'] ) ? (string) $question['licence'] : '',
					);
				}
			}

			$format = isset( $task['format'] ) ? (string) $task['format'] : '';

			if ( ! array_key_exists( $format, self::task_formats() ) ) {
				$format = self::default_format( $type, isset( $task['terminal'] ) ? $task['terminal'] : array() );
			}

			$tasks[] = array(
				'type'       => $type,
				'format'     => $format,
				'title'      => isset( $task['title'] ) ? (string) $task['title'] : '',
				'content'    => isset( $task['content'] ) ? wp_kses_post( (string) $task['content'] ) : '',
				'time_limit' => isset( $task['time_limit'] ) ? absint( $task['time_limit'] ) : 0,
				'pass_score' => isset( $task['pass_score'] ) ? absint( $task['pass_score'] ) : 0,
				'questions'  => $questions,
				'terminal'   => Secura_Terminal::normalize_definition( isset( $task['terminal'] ) ? $task['terminal'] : array() ),
			);
		}

		/* SEPARATION IMPORT / CONTROLE.
		   Les questions importees portent une source et une licence : c'est
		   ce qui les distingue du contenu maison. On les retire des taches
		   (un point de controle ne doit pas faire 80 questions) et on les
		   met en reserve : la reserve alimente le reservoir des epreuves de
		   la section, donc les copies d'examen restent variees. */
		$reserve = array();

		foreach ( $tasks as $index => $tache ) {
			$maison = array();

			foreach ( (array) $tache['questions'] as $question ) {
				if ( ! empty( $question['source'] ) ) {
					$reserve[] = $question;

					continue;
				}

				$maison[] = $question;
			}

			$tasks[ $index ]['questions'] = $maison;
		}

		self::$reserve[ $room_id ] = $reserve;

		return $tasks;
	}

	/**
	 * La reserve de questions importees d'une room.
	 *
	 * Ce sont les questions reprises d'un examen d'universite, avec leur
	 * source et leur licence. Elles ne font partie d'aucune tache : elles
	 * sont tirees au sort dans le reservoir des epreuves de la section
	 * (cf. Secura_Exam::pool()), ce qui donne a chaque eleve une copie
	 * d'epreuve differente sans jamais alourdir les points de controle.
	 *
	 * @param int $room_id Identifiant de la room.
	 * @return array Liste de questions normalisees.
	 */
	public static function reserve( $room_id ) {
		$room_id = absint( $room_id );

		if ( ! $room_id ) {
			return array();
		}

		if ( ! isset( self::$reserve[ $room_id ] ) ) {
			self::get_tasks( $room_id );
		}

		return isset( self::$reserve[ $room_id ] ) ? self::$reserve[ $room_id ] : array();
	}

	/**
	 * Decoupe un champ multi-lignes en tableau de valeurs propres.
	 *
	 * @param mixed $value Valeur brute.
	 * @return array
	 */
	public static function split_lines( $value ) {
		if ( is_array( $value ) ) {
			$lines = $value;
		} else {
			$lines = preg_split( '/\r\n|\r|\n/', (string) $value );
		}

		$out = array();

		foreach ( (array) $lines as $line ) {
			$line = trim( sanitize_text_field( $line ) );

			if ( '' !== $line ) {
				$out[] = $line;
			}
		}

		return $out;
	}

	/**
	 * Vue complète d'une room, traduite dans la langue demandée.
	 *
	 * @param int    $room_id Identifiant de la room.
	 * @param string $lang    Langue.
	 * @return array|null
	 */
	public static function get_room_view( $room_id, $lang = '' ) {
		$room = get_post( $room_id );

		if ( ! $room || SECURA_POST_TYPE !== $room->post_type ) {
			return null;
		}

		$lang       = $lang ? $lang : Secura_I18n::current_lang();
		$translation = Secura_I18n::translate_post( $room_id, $lang );
		$tasks       = self::get_tasks( $room_id );
		$tasks       = Secura_I18n::translate_tasks( $tasks, $translation, $lang );

		return array(
			'id'         => $room->ID,
			'title'      => $translation['title'] ? $translation['title'] : get_the_title( $room ),
			'excerpt'    => $translation['excerpt'] ? $translation['excerpt'] : $room->post_excerpt,
			'content'    => $translation['content'] ? $translation['content'] : wpautop( wp_kses_post( $room->post_content ) ),
			'tasks'      => $tasks,
			'difficulty'     => self::get_difficulty( $room->ID ),
			'difficulty_key' => self::get_difficulty_key( $room->ID ),
			'duration'       => absint( get_post_meta( $room->ID, SECURA_META_DURATION, true ) ),
			'xp_bonus'       => absint( get_post_meta( $room->ID, SECURA_META_XP_BONUS, true ) ),
			'slug'           => $room->post_name,
		);
	}

	/**
	 * Clé brute de la difficulté (facile, moyen, difficile, expert).
	 *
	 * @param int $room_id Identifiant de la room.
	 * @return string
	 */
	public static function get_difficulty_key( $room_id ) {
		$difficulty = get_post_meta( $room_id, SECURA_META_DIFFICULTY, true );

		if ( ! is_string( $difficulty ) || ! array_key_exists( $difficulty, self::difficulty_labels() ) ) {
			return 'facile';
		}

		return $difficulty;
	}

	/**
	 * Difficulté lisible.
	 *
	 * @param int $room_id Identifiant de la room.
	 * @return string
	 */
	public static function get_difficulty( $room_id ) {
		$difficulty = get_post_meta( $room_id, SECURA_META_DIFFICULTY, true );
		$labels     = self::difficulty_labels();

		if ( ! is_string( $difficulty ) || ! isset( $labels[ $difficulty ] ) ) {
			return $labels['facile'];
		}

		return $labels[ $difficulty ];
	}

	/**
	 * Libellés de difficulté.
	 *
	 * @return array
	 */
	public static function difficulty_labels() {
		return array(
			'facile'    => __( 'Facile', 'seca-academy' ),
			'moyen'     => __( 'Moyen', 'seca-academy' ),
			'difficile' => __( 'Difficile', 'seca-academy' ),
			'expert'    => __( 'Expert', 'seca-academy' ),
		);
	}

	/* ---------------------------------------------------------------------
	 * Édition
	 * ------------------------------------------------------------------ */

	/**
	 * Déclare les meta boxes.
	 */
	public static function add_meta_boxes() {
		add_meta_box(
			'secura-room-details',
			__( 'Parcours Secura', 'seca-academy' ),
			array( __CLASS__, 'render_meta_box' ),
			SECURA_POST_TYPE,
			'normal',
			'high'
		);

		add_meta_box(
			'secura-room-translations',
			__( 'Traductions', 'seca-academy' ),
			array( __CLASS__, 'render_translations_box' ),
			SECURA_POST_TYPE,
			'normal',
			'default'
		);

		add_meta_box(
			'secura-room-lab',
			__( 'Machine cible (lab)', 'seca-academy' ),
			array( __CLASS__, 'render_lab_box' ),
			SECURA_POST_TYPE,
			'normal',
			'default'
		);
	}

	/**
	 * Meta box : machine cible déployable.
	 *
	 * @param WP_Post $post Room.
	 */
	public static function render_lab_box( $post ) {
		$manifest = Secura_Lab::get_manifest( $post->ID );
		$drivers  = array(
			'auto'      => __( 'Automatique (Docker si disponible, sinon simulation)', 'seca-academy' ),
			'docker'    => __( 'Docker (machine réelle)', 'seca-academy' ),
			'simulated' => __( 'Simulation (aucun moteur de lab)', 'seca-academy' ),
		);
		$modes     = array(
			'single'  => __( 'Conteneur unique', 'seca-academy' ),
			'compose' => __( 'Docker Compose (plusieurs nœuds)', 'seca-academy' ),
		);
		?>
		<div class="secura-metabox">
			<p class="description">
				<?php esc_html_e( 'Une machine réelle, isolée dans un conteneur éphémère, par apprenant et par room. Le conteneur est non-root, sans privilèges, sans réseau sortant, et expire automatiquement.', 'seca-academy' ); ?>
			</p>

			<p class="description">
				<?php esc_html_e( 'Isolation automatique : le réseau Docker et le projet Compose sont renommés pour chaque apprenant et chaque room (suffixe _apprenant_room). Deux élèves ne partagent donc jamais la même pile. Le réseau est créé sans sortie Internet.', 'seca-academy' ); ?>
			</p>

			<p class="description">
				<?php
				printf(
					/* translators: %s : chemin du dossier des labs sur le serveur. */
					esc_html__( 'Dossier des labs sur ce serveur : %s (réglable dans Réglages → Secura Academy). Un chemin relatif dans le champ « docker-compose.yml » est résolu par rapport à ce dossier.', 'seca-academy' ),
					'<code>' . esc_html( Secura_Lab::labs_path() ) . '</code>'
				);
				?>
			</p>

			<p>
				<label><?php esc_html_e( 'Activer une machine cible', 'seca-academy' ); ?></label>
				<input type="checkbox" name="secura_lab[enabled]" value="1" <?php checked( $manifest['enabled'] ); ?> />
			</p>

			<p>
				<label for="secura_lab_driver"><?php esc_html_e( 'Pilote', 'seca-academy' ); ?></label>
				<select id="secura_lab_driver" name="secura_lab[driver]">
					<?php foreach ( $drivers as $key => $label ) : ?>
						<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $manifest['driver'], $key ); ?>><?php echo esc_html( $label ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<label for="secura_lab_mode"><?php esc_html_e( 'Mode', 'seca-academy' ); ?></label>
				<select id="secura_lab_mode" name="secura_lab[mode]">
					<?php foreach ( $modes as $key => $label ) : ?>
						<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $manifest['mode'], $key ); ?>><?php echo esc_html( $label ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<label><?php esc_html_e( 'Image Docker (mode conteneur unique)', 'seca-academy' ); ?></label>
				<input type="text" class="large-text" name="secura_lab[image]" value="<?php echo esc_attr( $manifest['image'] ); ?>" placeholder="securalabs/web-01:1.0" />
			</p>

			<p>
				<label><?php esc_html_e( 'Fichier docker-compose.yml (mode multi-nœuds)', 'seca-academy' ); ?></label>
				<input type="text" class="large-text" name="secura_lab[compose]" value="<?php echo esc_attr( $manifest['compose'] ); ?>" placeholder="net-01/docker-compose.yml" />
			</p>

			<p>
				<label><?php esc_html_e( 'Service à attaquer', 'seca-academy' ); ?></label>
				<input type="text" class="large-text" name="secura_lab[service]" value="<?php echo esc_attr( $manifest['service'] ); ?>" placeholder="web" />
			</p>

			<p>
				<label><?php esc_html_e( 'Service où se trouve le fichier de drapeau (laisser vide si c\'est le même)', 'seca-academy' ); ?></label>
				<input type="text" class="large-text" name="secura_lab[flag_service]" value="<?php echo esc_attr( $manifest['flag_service'] ); ?>" placeholder="internal" />
			</p>

			<p>
				<label><?php esc_html_e( "Cible affichée à l'apprenant", 'seca-academy' ); ?></label>
				<input type="text" class="large-text" name="secura_lab[target]" value="<?php echo esc_attr( $manifest['target'] ); ?>" placeholder="http://web:8080" />
			</p>

			<p>
				<label><?php esc_html_e( 'Préfixe du réseau Docker (suffixé automatiquement par apprenant et room)', 'seca-academy' ); ?></label>
				<input type="text" class="large-text" name="secura_lab[network]" value="<?php echo esc_attr( $manifest['network'] ); ?>" />
			</p>

			<p>
				<label><?php esc_html_e( 'Dossier de travail', 'seca-academy' ); ?></label>
				<input type="text" class="large-text" name="secura_lab[workdir]" value="<?php echo esc_attr( $manifest['workdir'] ); ?>" />
			</p>

			<p>
				<label><?php esc_html_e( 'Durée de vie de la machine (secondes)', 'seca-academy' ); ?></label>
				<input type="number" class="small-text" name="secura_lab[ttl]" value="<?php echo esc_attr( $manifest['ttl'] ); ?>" min="300" step="300" />
			</p>

			<p>
				<label><?php esc_html_e( 'Limites de ressources', 'seca-academy' ); ?></label>
				<input type="text" name="secura_lab[memory]" value="<?php echo esc_attr( $manifest['memory'] ); ?>" placeholder="512m" />
				<input type="text" name="secura_lab[cpus]" value="<?php echo esc_attr( $manifest['cpus'] ); ?>" placeholder="1" />
				<input type="number" name="secura_lab[pids]" value="<?php echo esc_attr( $manifest['pids'] ); ?>" min="16" />
			</p>

			<p>
				<label><?php esc_html_e( 'Commandes autorisées (une par ligne, vide = toutes sauf blocages)', 'seca-academy' ); ?></label>
				<textarea name="secura_lab[allow]" rows="3" class="large-text code"><?php echo esc_textarea( implode( "\n", $manifest['allow'] ) ); ?></textarea>
			</p>

			<p>
				<label><?php esc_html_e( 'Commandes bloquées (une par ligne)', 'seca-academy' ); ?></label>
				<textarea name="secura_lab[deny]" rows="3" class="large-text code"><?php echo esc_textarea( implode( "\n", $manifest['deny'] ) ); ?></textarea>
			</p>
		</div>
		<?php
	}

	/**
	 * Meta box : paramètres, tâches et questions.
	 *
	 * @param WP_Post $post Post en cours d'édition.
	 */
	public static function render_meta_box( $post ) {
		$tasks      = self::get_tasks( $post->ID );
		$difficulty = get_post_meta( $post->ID, SECURA_META_DIFFICULTY, true );
		$duration   = absint( get_post_meta( $post->ID, SECURA_META_DURATION, true ) );
		$bonus      = absint( get_post_meta( $post->ID, SECURA_META_XP_BONUS, true ) );

		if ( ! is_string( $difficulty ) || '' === $difficulty ) {
			$difficulty = 'facile';
		}

		if ( ! $bonus ) {
			$bonus = 25;
		}

		wp_nonce_field( 'secura_save_room', 'secura_room_nonce' );
		?>
		<div class="secura-metabox">

			<p>
				<label for="secura_difficulty"><?php esc_html_e( 'Difficulté', 'seca-academy' ); ?></label>
				<select id="secura_difficulty" name="secura_difficulty">
					<?php foreach ( self::difficulty_labels() as $key => $label ) : ?>
						<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $difficulty, $key ); ?>><?php echo esc_html( $label ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<label for="secura_duration"><?php esc_html_e( 'Durée indicative (minutes)', 'seca-academy' ); ?></label>
				<input type="number" min="0" max="600" id="secura_duration" name="secura_duration" value="<?php echo esc_attr( $duration ); ?>" />
			</p>

			<p>
				<label for="secura_xp_bonus"><?php esc_html_e( 'Bonus XP à la complétion de la room', 'seca-academy' ); ?></label>
				<input type="number" min="0" max="500" id="secura_xp_bonus" name="secura_xp_bonus" value="<?php echo esc_attr( $bonus ); ?>" />
			</p>

			<h3 class="secura-metabox-title"><?php esc_html_e( 'Tâches', 'seca-academy' ); ?></h3>
			<p class="description">
				<?php esc_html_e( 'Une room suit l\'ordre : leçon → entraînement → test d\'application → examen. Les réponses attendues ne sont jamais envoyées au navigateur.', 'seca-academy' ); ?>
			</p>

			<div id="secura-tasks" class="secura-tasks">
				<?php
				if ( empty( $tasks ) ) {
					echo self::render_task_row( array( 'type' => 'lesson', 'title' => '', 'content' => '', 'time_limit' => 0, 'pass_score' => 0, 'questions' => array(), 'terminal' => array() ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendu échappé.
				} else {
					foreach ( $tasks as $task ) {
						echo self::render_task_row( $task ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendu échappé.
					}
				}
				?>
			</div>

			<p>
				<button type="button" class="button button-secondary" id="secura-add-task"><?php esc_html_e( '+ Ajouter une tâche', 'seca-academy' ); ?></button>
			</p>

			<script type="text/html" id="secura-task-template">
				<?php
				echo self::render_task_row( array( 'type' => 'lesson', 'title' => '', 'content' => '', 'time_limit' => 0, 'pass_score' => 0, 'questions' => array(), 'terminal' => array() ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendu échappé.
				?>
			</script>

			<script type="text/html" id="secura-question-template">
				<?php
				echo self::render_question_row( array( 'question' => '', 'answers' => array(), 'xp' => 10, 'hint' => '', 'explanation' => '', 'weight' => 1, 'requires_step' => -1 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendu échappé.
				?>
			</script>
		</div>
		<?php
	}

	/**
	 * Rendu d'une tâche.
	 *
	 * @param array $task Tâche.
	 * @return string
	 */
	private static function render_task_row( $task ) {
		$type    = isset( $task['type'] ) ? $task['type'] : 'lesson';
		$format  = isset( $task['format'] ) ? (string) $task['format'] : '';
		$title   = isset( $task['title'] ) ? $task['title'] : '';
		$content = isset( $task['content'] ) ? $task['content'] : '';
		$limit   = isset( $task['time_limit'] ) ? absint( $task['time_limit'] ) : 0;
		$pass    = isset( $task['pass_score'] ) ? absint( $task['pass_score'] ) : 0;
		$terminal = isset( $task['terminal'] ) ? $task['terminal'] : array();
		$questions = isset( $task['questions'] ) && is_array( $task['questions'] ) ? $task['questions'] : array();

		if ( ! array_key_exists( $format, self::task_formats() ) ) {
			$format = self::default_format( $type, $terminal );
		}

		$terminal_json = '';

		if ( ! empty( $terminal['steps'] ) ) {
			$terminal_json = wp_json_encode( $terminal, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
		}

		ob_start();
		?>
		<div class="secura-task-row">
			<div class="secura-task-head">
				<strong class="secura-task-label"><?php esc_html_e( 'Tâche', 'seca-academy' ); ?> <span class="secura-task-number">1</span></strong>
				<button type="button" class="button-link-delete seca-remove-task"><?php esc_html_e( 'Supprimer la tâche', 'seca-academy' ); ?></button>
			</div>

			<p>
				<label><?php esc_html_e( 'Type', 'seca-academy' ); ?></label>
				<select name="secura_tasks[][type]">
					<?php foreach ( self::task_types() as $key => $label ) : ?>
						<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $type, $key ); ?>><?php echo esc_html( $label ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<p class="secura-inline">
				<label><?php esc_html_e( 'Titre de la tâche', 'seca-academy' ); ?></label>
				<input type="text" class="large-text" name="secura_tasks[][title]" value="<?php echo esc_attr( $title ); ?>" />
			</p>

			<p class="secura-inline">
				<label><?php esc_html_e( 'Format', 'seca-academy' ); ?></label>
				<select name="secura_tasks[][format]">
					<?php foreach ( self::task_formats() as $key => $label ) : ?>
						<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $format, $key ); ?>><?php echo esc_html( $label ); ?></option>
					<?php endforeach; ?>
				</select>
				<span class="description"><?php esc_html_e( 'QCM = validation par questions ; Pratique = manipulation d\'une machine ; Mixte = les deux.', 'seca-academy' ); ?></span>
			</p>

			<p>
				<label><?php esc_html_e( 'Contenu pédagogique (HTML simple)', 'seca-academy' ); ?></label>
				<textarea name="secura_tasks[][content]" rows="6" class="large-text"><?php echo esc_textarea( $content ); ?></textarea>
			</p>

			<p class="secura-inline">
				<label><?php esc_html_e( 'Durée (min, examen)', 'seca-academy' ); ?></label>
				<input type="number" min="0" max="240" name="secura_tasks[][time_limit]" value="<?php echo esc_attr( $limit ); ?>" />
				<label><?php esc_html_e( 'Seuil de passage (%, examen)', 'seca-academy' ); ?></label>
				<input type="number" min="0" max="100" name="secura_tasks[][pass_score]" value="<?php echo esc_attr( $pass ); ?>" />
			</p>

			<p>
				<label><?php esc_html_e( 'Terminal simulé (JSON, optionnel)', 'seca-academy' ); ?></label>
				<textarea name="secura_tasks[][terminal]" rows="5" class="large-text code" placeholder='{"intro":"…","steps":[{"match":["ls"],"output":"…","hint":"…"}]}'><?php echo esc_textarea( $terminal_json ); ?></textarea>
				<span class="description"><?php esc_html_e( 'Les motifs entre slashes sont des expressions régulières, sinon la comparaison est exacte.', 'seca-academy' ); ?></span>
			</p>

			<div class="secura-questions">
				<?php
				foreach ( $questions as $question ) {
					echo self::render_question_row( $question ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendu échappé.
				}
				?>
			</div>

			<p>
				<button type="button" class="button button-small seca-add-question"><?php esc_html_e( '+ Ajouter une question', 'seca-academy' ); ?></button>
			</p>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Rendu d'une question.
	 *
	 * @param array $question Question.
	 * @return string
	 */
	private static function render_question_row( $question ) {
		$text        = isset( $question['question'] ) ? $question['question'] : '';
		$answers     = isset( $question['answers'] ) && is_array( $question['answers'] ) ? implode( "\n", $question['answers'] ) : '';
		$xp          = isset( $question['xp'] ) ? absint( $question['xp'] ) : 10;
		$hint        = isset( $question['hint'] ) ? $question['hint'] : '';
		$explanation = isset( $question['explanation'] ) ? $question['explanation'] : '';
		$weight      = isset( $question['weight'] ) ? absint( $question['weight'] ) : 1;
		$requires    = isset( $question['requires_step'] ) ? intval( $question['requires_step'] ) : -1;
		$mode        = isset( $question['mode'] ) ? sanitize_key( $question['mode'] ) : 'text';
		$choices     = isset( $question['choices'] ) && is_array( $question['choices'] ) ? $question['choices'] : array();
		$correct     = isset( $question['correct'] ) ? intval( $question['correct'] ) : -1;

		if ( ! in_array( $mode, array( 'text', 'choice', 'action' ), true ) ) {
			$mode = 'text';
		}

		ob_start();
		?>
		<div class="secura-question-row">
			<div class="secura-task-head">
				<strong class="secura-question-label"><?php esc_html_e( 'Question', 'seca-academy' ); ?> <span class="secura-question-number">1</span></strong>
				<button type="button" class="button-link-delete seca-remove-question"><?php esc_html_e( 'Supprimer', 'seca-academy' ); ?></button>
			</div>

			<p>
				<label><?php esc_html_e( 'Énoncé', 'seca-academy' ); ?></label>
				<textarea name="secura_tasks[][questions][][question]" rows="2" class="large-text"><?php echo esc_textarea( $text ); ?></textarea>
			</p>

			<p class="seca-inline">
				<label><?php esc_html_e( 'Type de question', 'seca-academy' ); ?></label>
				<select name="secura_tasks[][questions][][mode]" class="seca-question-mode">
					<?php foreach ( self::question_modes() as $mode_key => $mode_label ) : ?>
						<option value="<?php echo esc_attr( $mode_key ); ?>" <?php selected( $mode, $mode_key ); ?>><?php echo esc_html( $mode_label ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<label><?php esc_html_e( 'Réponses acceptées (une par ligne)', 'seca-academy' ); ?></label>
				<textarea name="secura_tasks[][questions][][answers]" rows="3" class="large-text"><?php echo esc_textarea( $answers ); ?></textarea>
			</p>
			<p>
				<label><?php esc_html_e( 'Choix proposés (un par ligne, question à choix)', 'seca-academy' ); ?></label>
				<textarea name="secura_tasks[][questions][][choices]" rows="3" class="large-text"><?php echo esc_textarea( implode( "\n", $choices ) ); ?></textarea>
			</p>

			<p class="seca-inline">
				<label><?php esc_html_e( 'Bonne réponse (choix à choix)', 'seca-academy' ); ?></label>
				<select name="secura_tasks[][questions][][correct]">
					<option value="-1"><?php esc_html_e( 'Aucune', 'seca-academy' ); ?></option>
					<?php foreach ( $choices as $choice_index => $choice_label ) : ?>
						<option value="<?php echo esc_attr( $choice_index ); ?>" <?php selected( $correct, $choice_index ); ?>><?php echo esc_html( $choice_label ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<label><?php esc_html_e( 'Explication affichée après la réponse', 'seca-academy' ); ?></label>
				<textarea name="secura_tasks[][questions][][explanation]" rows="2" class="large-text"><?php echo esc_textarea( $explanation ); ?></textarea>
			</p>

			<p class="secura-inline">
				<label><?php esc_html_e( 'Indice', 'seca-academy' ); ?></label>
				<input type="text" class="regular-text" name="secura_tasks[][questions][][hint]" value="<?php echo esc_attr( $hint ); ?>" />
			</p>

			<p class="secura-inline">
				<label><?php esc_html_e( 'XP', 'seca-academy' ); ?></label>
				<input type="number" min="0" max="200" name="secura_tasks[][questions][][xp]" value="<?php echo esc_attr( $xp ); ?>" />
				<label><?php esc_html_e( 'Poids', 'seca-academy' ); ?></label>
				<input type="number" min="1" max="5" name="secura_tasks[][questions][][weight]" value="<?php echo esc_attr( $weight ); ?>" />
				<label><?php esc_html_e( 'Étape terminal requise', 'seca-academy' ); ?></label>
				<input type="number" min="-1" max="20" name="secura_tasks[][questions][][requires_step]" value="<?php echo esc_attr( $requires ); ?>" />
			</p>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Meta box : traductions.
	 *
	 * @param WP_Post $post Post en cours d'édition.
	 */
	public static function render_translations_box( $post ) {
		$tasks        = self::get_tasks( $post->ID );
		$translations = get_post_meta( $post->ID, SECURA_META_I18N, true );
		$translations = is_array( $translations ) ? $translations : array();
		$languages    = Secura_I18n::languages();

		echo '<p class="description">' . esc_html__( 'Traduisez le contenu de la room. Laissez vide pour conserver la version d\'origine.', 'seca-academy' ) . '</p>';

		foreach ( $languages as $code => $language ) {
			$data = isset( $translations[ $code ] ) && is_array( $translations[ $code ] ) ? $translations[ $code ] : array();
			?>
			<details class="secura-translation" <?php echo ( $code === 'fr' ? 'open' : '' ); ?>>
				<summary><?php echo esc_html( $language['native'] . ' (' . $language['flag'] . ')' ); ?></summary>

				<p>
					<label><?php esc_html_e( 'Titre', 'seca-academy' ); ?></label>
					<input type="text" class="large-text" name="secura_i18n[<?php echo esc_attr( $code ); ?>][title]" value="<?php echo esc_attr( isset( $data['title'] ) ? $data['title'] : '' ); ?>" />
				</p>

				<p>
					<label><?php esc_html_e( 'Extrait', 'seca-academy' ); ?></label>
					<input type="text" class="large-text" name="secura_i18n[<?php echo esc_attr( $code ); ?>][excerpt]" value="<?php echo esc_attr( isset( $data['excerpt'] ) ? $data['excerpt'] : '' ); ?>" />
				</p>

				<?php foreach ( $tasks as $index => $task ) : ?>
					<?php
					$task_title = isset( $data['tasks'][ $index ]['title'] ) ? $data['tasks'][ $index ]['title'] : '';
					?>
					<p>
						<label><?php echo esc_html( sprintf( /* translators: %d : index de la tâche. */ __( 'Tâche %d — titre', 'seca-academy' ), $index + 1 ) ); ?></label>
						<input type="text" class="large-text" name="secura_i18n[<?php echo esc_attr( $code ); ?>][tasks][<?php echo esc_attr( $index ); ?>][title]" value="<?php echo esc_attr( $task_title ); ?>" />
					</p>

					<p>
						<label><?php echo esc_html( sprintf( /* translators: %d : index de la tâche. */ __( 'Tâche %d — scénario du terminal (JSON, optionnel)', 'seca-academy' ), $index + 1 ) ); ?></label>
						<textarea name="secura_i18n[<?php echo esc_attr( $code ); ?>][tasks][<?php echo esc_attr( $index ); ?>][terminal]" rows="3" class="large-text code" placeholder="{"intro":"user@cible:~$ ","steps":[{"match":["cat notes.txt"],"output":"FLAG=..."}]}"><?php echo esc_textarea( isset( $data['tasks'][ $index ]['terminal'] ) ? wp_json_encode( $data['tasks'][ $index ]['terminal'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) : '' ); ?></textarea>
						<span class="description"><?php esc_html_e( 'Laissez vide pour conserver le scénario d\'origine.', 'seca-academy' ); ?></span>
					</p>

					<?php
					$questions = isset( $task['questions'] ) ? $task['questions'] : array();

					foreach ( $questions as $q_index => $question ) :
					?>
						<p class="secura-translation-question">
							<label><?php echo esc_html( sprintf( /* translators: 1 : index de la tâche, 2 : index de la question. */ __( 'Tâche %1$d — question %2$d', 'seca-academy' ), $index + 1, $q_index + 1 ) ); ?></label>
							<textarea name="secura_i18n[<?php echo esc_attr( $code ); ?>][tasks][<?php echo esc_attr( $index ); ?>][questions][<?php echo esc_attr( $q_index ); ?>][question]" rows="2" class="large-text"><?php echo esc_textarea( isset( $data['tasks'][ $index ]['questions'][ $q_index ]['question'] ) ? $data['tasks'][ $index ]['questions'][ $q_index ]['question'] : '' ); ?></textarea>
							<textarea name="secura_i18n[<?php echo esc_attr( $code ); ?>][tasks][<?php echo esc_attr( $index ); ?>][questions][<?php echo esc_attr( $q_index ); ?>][choices]" rows="3" class="large-text" placeholder="<?php esc_attr_e( 'Choix traduits (un par ligne)', 'seca-academy' ); ?>"><?php echo esc_textarea( isset( $data['tasks'][ $index ]['questions'][ $q_index ]['choices'] ) && is_array( $data['tasks'][ $index ]['questions'][ $q_index ]['choices'] ) ? implode( "\n", $data['tasks'][ $index ]['questions'][ $q_index ]['choices'] ) : '' ); ?></textarea>
							<textarea name="secura_i18n[<?php echo esc_attr( $code ); ?>][tasks][<?php echo esc_attr( $index ); ?>][questions][<?php echo esc_attr( $q_index ); ?>][hint]" rows="1" class="large-text" placeholder="<?php esc_attr_e( 'Indice traduit', 'seca-academy' ); ?>"><?php echo esc_textarea( isset( $data['tasks'][ $index ]['questions'][ $q_index ]['hint'] ) ? $data['tasks'][ $index ]['questions'][ $q_index ]['hint'] : '' ); ?></textarea>
							<textarea name="secura_i18n[<?php echo esc_attr( $code ); ?>][tasks][<?php echo esc_attr( $index ); ?>]][questions][<?php echo esc_attr( $q_index ); ?>][explanation]" rows="2" class="large-text" placeholder="<?php esc_attr_e( 'Explication traduite', 'seca-academy' ); ?>"><?php echo esc_textarea( isset( $data['tasks'][ $index ]['questions'][ $q_index ]['explanation'] ) ? $data['tasks'][ $index ]['questions'][ $q_index ]['explanation'] : '' ); ?></textarea>
						</p>
					<?php endforeach; ?>
				<?php endforeach; ?>
			</details>
			<?php
		}
	}

	/**
	 * Enregistre la room.
	 *
	 * @param int     $post_id Identifiant du post.
	 * @param WP_Post $post    Post en cours d'enregistrement.
	 */
	public static function save_room( $post_id, $post ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! isset( $_POST['secura_room_nonce'] ) ) {
			return;
		}

		$nonce = sanitize_text_field( wp_unslash( $_POST['secura_room_nonce'] ) );

		if ( ! wp_verify_nonce( $nonce, 'secura_save_room' ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}

		$difficulty = isset( $_POST['secura_difficulty'] ) ? sanitize_key( wp_unslash( $_POST['secura_difficulty'] ) ) : 'facile';

		if ( ! array_key_exists( $difficulty, self::difficulty_labels() ) ) {
			$difficulty = 'facile';
		}

		update_post_meta( $post_id, SECURA_META_DIFFICULTY, $difficulty );
		update_post_meta( $post_id, SECURA_META_DURATION, isset( $_POST['secura_duration'] ) ? absint( wp_unslash( $_POST['secura_duration'] ) ) : 0 );
		update_post_meta( $post_id, SECURA_META_XP_BONUS, isset( $_POST['secura_xp_bonus'] ) ? absint( wp_unslash( $_POST['secura_xp_bonus'] ) ) : 25 );

		$raw   = isset( $_POST['secura_tasks'] ) && is_array( $_POST['secura_tasks'] ) ? wp_unslash( $_POST['secura_tasks'] ) : array();
		$clean = array();

		/* Les variantes paramétriques ne sont pas saisies dans le
		   formulaire : on les reporte de la room enregistrée, pour
		   qu'un enseignant qui corrige une question ne perde pas les
		   chiffres varied de la question. */
		$variantes_avant = array();
		$avant           = get_post_meta( $post_id, SECURA_META_TASKS, true );

		if ( is_array( $avant ) ) {
			foreach ( $avant as $t_index => $tache ) {
				if ( ! isset( $tache['questions'] ) || ! is_array( $tache['questions'] ) ) {
					continue;
				}

				foreach ( $tache['questions'] as $q_index => $question ) {
					if ( ! empty( $question['variants'] ) && is_array( $question['variants'] ) ) {
						$variantes_avant[ $t_index . ':' . $q_index ] = $question['variants'];
					}
				}
			}
		}

		foreach ( $raw as $t_index => $task ) {
			if ( ! is_array( $task ) ) {
				continue;
			}

			$type = isset( $task['type'] ) && array_key_exists( $task['type'], self::task_types() ) ? $task['type'] : 'practice';

			$questions = array();

			if ( isset( $task['questions'] ) && is_array( $task['questions'] ) ) {
				foreach ( $task['questions'] as $question ) {
					if ( ! is_array( $question ) ) {
						continue;
					}

					$text = isset( $question['question'] ) ? trim( sanitize_textarea_field( $question['question'] ) ) : '';

					if ( '' === $text ) {
						continue;
					}

					$mode = isset( $question['mode'] ) ? sanitize_key( $question['mode'] ) : 'text';

				if ( ! in_array( $mode, array( 'text', 'choice', 'action' ), true ) ) {
					$mode = 'text';
				}

				$answers = array();
				$choices = array();
				$correct = -1;

				if ( 'action' === $mode ) {
					/* Aucune reponse attendue : l'apprenant realise l'action. */
					$answers = array();
				} elseif ( 'choice' === $mode ) {
					$choices = self::split_lines( isset( $question['choices'] ) ? $question['choices'] : '' );
					$correct = isset( $question['correct'] ) ? intval( $question['correct'] ) : -1;

					if ( empty( $choices ) || $correct < 0 || $correct >= count( $choices ) ) {
						continue;
					}
				} else {
					$answers = self::split_lines( isset( $question['answers'] ) ? $question['answers'] : '' );

					if ( empty( $answers ) ) {
						continue;
					}
				}

				$questions[] = array(
					'question'      => $text,
					'mode'          => $mode,
					'variants'      => isset( $variantes_avant[ $t_index . ':' . $q_index ] ) ? $variantes_avant[ $t_index . ':' . $q_index ] : array(),
					'answers'       => $answers,
					'choices'       => $choices,
					'correct'       => $correct,
						'xp'            => isset( $question['xp'] ) ? absint( $question['xp'] ) : 10,
						'hint'          => isset( $question['hint'] ) ? sanitize_textarea_field( $question['hint'] ) : '',
						'explanation'   => isset( $question['explanation'] ) ? sanitize_textarea_field( $question['explanation'] ) : '',
						'weight'        => isset( $question['weight'] ) ? absint( $question['weight'] ) : 1,
						'requires_step' => isset( $question['requires_step'] ) ? intval( $question['requires_step'] ) : -1,
						'source'        => isset( $question['source'] ) ? (string) $question['source'] : '',
						'licence'       => isset( $question['licence'] ) ? (string) $question['licence'] : '',
					);
				}
			}

			$terminal = array();

			if ( isset( $task['terminal'] ) && '' !== trim( (string) $task['terminal'] ) ) {
				$decoded = json_decode( (string) $task['terminal'], true );
				$terminal = Secura_Terminal::normalize_definition( is_array( $decoded ) ? $decoded : array() );
			}

			$format = isset( $task['format'] ) ? (string) $task['format'] : '';

			if ( ! array_key_exists( $format, self::task_formats() ) ) {
				$format = self::default_format( $type, $terminal );
			}

			$clean[] = array(
				'type'       => $type,
				'format'     => $format,
				'title'      => isset( $task['title'] ) ? sanitize_text_field( $task['title'] ) : '',
				'content'    => isset( $task['content'] ) ? wp_kses_post( $task['content'] ) : '',
				'time_limit' => isset( $task['time_limit'] ) ? absint( $task['time_limit'] ) : 0,
				'pass_score' => isset( $task['pass_score'] ) ? absint( $task['pass_score'] ) : 0,
				'questions'  => $questions,
				'terminal'   => $terminal,
			);
		}

		update_post_meta( $post_id, SECURA_META_TASKS, $clean );

		/* Manifeste de lab. */
		$raw_lab = isset( $_POST['secura_lab'] ) && is_array( $_POST['secura_lab'] ) ? wp_unslash( $_POST['secura_lab'] ) : array();

		$manifest = array(
			'enabled' => ! empty( $raw_lab['enabled'] ),
			'driver'  => isset( $raw_lab['driver'] ) ? sanitize_key( $raw_lab['driver'] ) : 'auto',
			'mode'    => isset( $raw_lab['mode'] ) ? sanitize_key( $raw_lab['mode'] ) : 'single',
			'image'   => isset( $raw_lab['image'] ) ? sanitize_text_field( $raw_lab['image'] ) : '',
			'service' => isset( $raw_lab['service'] ) ? sanitize_text_field( $raw_lab['service'] ) : '',
			'flag_service' => isset( $raw_lab['flag_service'] ) ? sanitize_text_field( $raw_lab['flag_service'] ) : '',
			'compose' => isset( $raw_lab['compose'] ) ? sanitize_text_field( $raw_lab['compose'] ) : '',
			'project' => isset( $raw_lab['project'] ) ? sanitize_key( $raw_lab['project'] ) : '',
			'network' => isset( $raw_lab['network'] ) ? sanitize_text_field( $raw_lab['network'] ) : 'seca_lab',
			'command' => isset( $raw_lab['command'] ) ? sanitize_text_field( $raw_lab['command'] ) : 'bash -l',
			'workdir' => isset( $raw_lab['workdir'] ) ? sanitize_text_field( $raw_lab['workdir'] ) : '/home/ctf',
			'target'  => isset( $raw_lab['target'] ) ? sanitize_text_field( $raw_lab['target'] ) : '',
			'ttl'     => isset( $raw_lab['ttl'] ) ? absint( $raw_lab['ttl'] ) : 3600,
			'memory'  => isset( $raw_lab['memory'] ) ? sanitize_text_field( $raw_lab['memory'] ) : '512m',
			'cpus'    => isset( $raw_lab['cpus'] ) ? sanitize_text_field( $raw_lab['cpus'] ) : '1',
			'pids'    => isset( $raw_lab['pids'] ) ? absint( $raw_lab['pids'] ) : 256,
			'allow'   => isset( $raw_lab['allow'] ) ? sanitize_textarea_field( $raw_lab['allow'] ) : '',
			'deny'    => isset( $raw_lab['deny'] ) ? sanitize_textarea_field( $raw_lab['deny'] ) : '',
		);

		update_post_meta( $post_id, Secura_Lab::META, Secura_Lab::normalize_manifest( $manifest ) );

		/* Traductions. */
		$raw_tr = isset( $_POST['secura_i18n'] ) && is_array( $_POST['secura_i18n'] ) ? wp_unslash( $_POST['secura_i18n'] ) : array();
		$clean_tr = array();

		foreach ( $raw_tr as $code => $data ) {
			if ( ! is_array( $data ) ) {
				continue;
			}

			$entry = array(
				'title'   => isset( $data['title'] ) ? sanitize_text_field( $data['title'] ) : '',
				'excerpt' => isset( $data['excerpt'] ) ? sanitize_text_field( $data['excerpt'] ) : '',
				'tasks'   => array(),
			);

			if ( isset( $data['tasks'] ) && is_array( $data['tasks'] ) ) {
				foreach ( $data['tasks'] as $index => $task ) {
					if ( ! is_array( $task ) ) {
						continue;
					}

					$entry['tasks'][ $index ] = array(
						'title'     => isset( $task['title'] ) ? sanitize_text_field( $task['title'] ) : '',
						'terminal'  => array(),
						'questions' => array(),
					);

					if ( isset( $task['terminal'] ) && '' !== trim( (string) $task['terminal'] ) ) {
						$decoded = json_decode( (string) $task['terminal'], true );

						if ( is_array( $decoded ) ) {
							$entry['tasks'][ $index ]['terminal'] = Secura_Terminal::normalize_definition( $decoded );
						}
					}

					if ( isset( $task['questions'] ) && is_array( $task['questions'] ) ) {
						foreach ( $task['questions'] as $q_index => $question ) {
							if ( ! is_array( $question ) ) {
								continue;
							}

							$entry['tasks'][ $index ]['questions'][ $q_index ] = array(
								'question'    => isset( $question['question'] ) ? sanitize_textarea_field( $question['question'] ) : '',
								'hint'        => isset( $question['hint'] ) ? sanitize_textarea_field( $question['hint'] ) : '',
								'explanation' => isset( $question['explanation'] ) ? sanitize_textarea_field( $question['explanation'] ) : '',
							);
						}
					}
				}
			}

			$clean_tr[ sanitize_key( $code ) ] = $entry;
		}

		update_post_meta( $post_id, SECURA_META_I18N, $clean_tr );
	}

	/**
	 * Charge les scripts d'édition.
	 *
	 * @param string $hook Identifiant de l'écran.
	 */
	public static function admin_assets( $hook ) {
		if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
			return;
		}

		$screen = get_current_screen();

		if ( $screen && ! in_array( $screen->post_type, array( SECURA_POST_TYPE, SECURA_PATH_POST_TYPE ), true ) ) {
			return;
		}

		wp_enqueue_script(
			'secura-academy-admin',
			SECURA_ACADEMY_URL . 'assets/admin.js',
			array(),
			SECURA_ACADEMY_VERSION,
			true
		);

		wp_enqueue_style(
			'secura-academy-admin',
			SECURA_ACADEMY_URL . 'assets/admin.css',
			array(),
			SECURA_ACADEMY_VERSION
		);
	}
}
