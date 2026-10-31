<?php
/**
 * Progression, barème de points, médailles, examens, niveaux et série.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Moteur de progression et de gamification.
 */
final class Secura_Progress {

	/**
	 * Branche les hooks.
	 */
	public static function init() {
		add_action( 'admin_init', array( __CLASS__, 'register_settings' ) );
	}

	/**
	 * Réglages administrables.
	 */
	public static function register_settings() {
		register_setting(
			'secura_options',
			SECURA_OPTION_FIRST_BLOOD,
			array(
				'type'              => 'boolean',
				'default'           => 0,
				'sanitize_callback' => 'rest_sanitize_boolean',
			)
		);
	}

	/**
	 * Le first blood est-il actif ?
	 *
	 * @return bool
	 */
	public static function first_blood_enabled() {
		return (bool) get_option( SECURA_OPTION_FIRST_BLOOD, 0 );
	}

	/**
	 * Crée la table de statistiques de réponses si nécessaire.
	 */
	public static function maybe_create_table() {
		global $wpdb;

		$table = $wpdb->prefix . 'secura_answer_stats';

		if ( get_option( 'secura_answer_stats_table' ) === $table ) {
			return;
		}

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		dbDelta(
			"CREATE TABLE {$table} (
				question_key varchar(191) NOT NULL,
				correct_count bigint(20) unsigned NOT NULL DEFAULT 0,
				first_answer datetime DEFAULT NULL,
				PRIMARY KEY  (question_key)
			) {$wpdb->get_charset_collate()};"
		);

		update_option( 'secura_answer_stats_table', $table );
	}

	/* ---------------------------------------------------------------------
	 * Barème
	 * ------------------------------------------------------------------ */

	/**
	 * Points de base selon la difficulté.
	 *
	 * @param string $difficulty Difficulté de la room.
	 * @return int
	 */
	public static function base_points( $difficulty ) {
		$map = array(
			'facile'    => 10,
			'moyen'     => 15,
			'difficile' => 20,
			'expert'    => 30,
		);

		return isset( $map[ $difficulty ] ) ? $map[ $difficulty ] : 10;
	}

	/**
	 * Multiplicateur selon le type de tâche.
	 *
	 * @param string $type Type de tâche.
	 * @return float
	 */
	public static function type_multiplier( $type ) {
		$map = array(
			'lesson'   => 0.0,
			'practice' => 0.5,
			'test'     => 1.0,
			'exam'     => 1.5,
		);

		return isset( $map[ $type ] ) ? $map[ $type ] : 1.0;
	}

	/**
	 * Multiplicateurs de rang (first blood).
	 *
	 * @return array
	 */
	public static function first_blood_multipliers() {
		return array(
			1 => 2.0,
			2 => 1.8,
			3 => 1.7,
			4 => 1.65,
		);
	}

	/**
	 * Enregistre le rang de l'utilisateur pour une question et renvoie le multiplicateur.
	 *
	 * @param int    $user_id      Identifiant de l'utilisateur.
	 * @param string $question_key Clé unique de la question.
	 * @return float
	 */
	public static function first_blood_multiplier( $user_id, $question_key ) {
		if ( ! self::first_blood_enabled() || ! $question_key ) {
			return 1.0;
		}

		global $wpdb;

		self::maybe_create_table();

		$table = $wpdb->prefix . 'secura_answer_stats';
		$ranks = get_user_meta( $user_id, SECURA_USER_RANKS, true );
		$ranks = is_array( $ranks ) ? $ranks : array();

		if ( isset( $ranks[ $question_key ] ) ) {
			return self::rank_multiplier( (int) $ranks[ $question_key ] );
		}

		$count = (int) $wpdb->get_var(
			$wpdb->prepare( "SELECT correct_count FROM {$table} WHERE question_key = %s", $question_key )
		);

		$rank = $count + 1;

		$wpdb->query(
			$wpdb->prepare(
				"INSERT INTO {$table} (question_key, correct_count, first_answer) VALUES (%s, 1, %s)
				 ON DUPLICATE KEY UPDATE correct_count = correct_count + 1",
				$question_key,
				current_time( 'mysql' )
			)
		);

		$ranks[ $question_key ] = $rank;
		update_user_meta( $user_id, SECURA_USER_RANKS, $ranks );

		return self::rank_multiplier( $rank );
	}

	/**
	 * Multiplicateur correspondant à un rang.
	 *
	 * @param int $rank Rang de réponse.
	 * @return float
	 */
	public static function rank_multiplier( $rank ) {
		$map = self::first_blood_multipliers();

		if ( isset( $map[ $rank ] ) ) {
			return $map[ $rank ];
		}

		return $rank >= 5 ? 1.5 : 1.0;
	}

	/**
	 * Calcule et attribue les points d'une question.
	 *
	 * @param int    $user_id Identifiant de l'utilisateur.
	 * @param array  $args    Arguments (voir documentation).
	 * @return array
	 */
	public static function award( $user_id, $args ) {
		$defaults = array(
			'room_id'      => 0,
			'task_index'   => 0,
			'question'     => 0,
			'base_xp'      => 0,
			'difficulty'   => 'facile',
			'type'         => 'practice',
			'hint_used'    => false,
			'question_key' => '',
		);

		$args = wp_parse_args( $args, $defaults );

		$base    = $args['base_xp'] > 0 ? (int) $args['base_xp'] : self::base_points( $args['difficulty'] );
		$type    = self::type_multiplier( $args['type'] );
		$rank    = self::first_blood_multiplier( $user_id, $args['question_key'] );
		$penalty = $args['hint_used'] ? 0.5 : 1.0;

		$points = (int) ceil( $base * $type * $rank * $penalty );
		$points = max( 1, $points );

		$total = self::get_xp( $user_id ) + $points;

		update_user_meta( $user_id, SECURA_USER_XP, $total );
		self::touch_streak( $user_id );

		return array(
			'points'     => $points,
			'base'       => $base,
			'type'       => $type,
			'rank'       => $rank,
			'hint'       => $penalty < 1 ? $penalty : 1.0,
			'total_xp'   => $total,
			'level'      => self::level_for_xp( $total ),
		);
	}

	/**
	 * Total de XP d'un utilisateur.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @return int
	 */
	public static function get_xp( $user_id ) {
		return absint( get_user_meta( $user_id, SECURA_USER_XP, true ) );
	}

	/* ---------------------------------------------------------------------
	 * Niveaux
	 * ------------------------------------------------------------------ */

	/**
	 * Échelle de niveaux.
	 *
	 * @return array
	 */
	public static function levels() {
		return array(
			array( 'number' => 1, 'label' => 'Observateur', 'min' => 0, 'max' => 99 ),
			array( 'number' => 2, 'label' => 'Apprenti', 'min' => 100, 'max' => 249 ),
			array( 'number' => 3, 'label' => 'Analyste', 'min' => 250, 'max' => 499 ),
			array( 'number' => 4, 'label' => 'Traceur', 'min' => 500, 'max' => 899 ),
			array( 'number' => 5, 'label' => 'Auditeur', 'min' => 900, 'max' => 1499 ),
			array( 'number' => 6, 'label' => 'Pourfendeur', 'min' => 1500, 'max' => 2499 ),
			array( 'number' => 7, 'label' => 'Spécialiste', 'min' => 2500, 'max' => 3499 ),
			array( 'number' => 8, 'label' => 'Architecte', 'min' => 3500, 'max' => 4999 ),
			array( 'number' => 9, 'label' => 'Défenseur', 'min' => 5000, 'max' => 6999 ),
			array( 'number' => 10, 'label' => 'Éclaireur', 'min' => 7000, 'max' => 9999 ),
			array( 'number' => 11, 'label' => 'Sentinel', 'min' => 10000, 'max' => 14999 ),
			array( 'number' => 12, 'label' => 'Maître', 'min' => 15000, 'max' => null ),
		);
	}

	/**
	 * Niveau correspondant à un total de XP.
	 *
	 * @param int $xp XP accumulés.
	 * @return array
	 */
	public static function level_for_xp( $xp ) {
		$xp = (int) $xp;
		$found = self::levels();

		foreach ( self::levels() as $level ) {
			if ( null === $level['max'] || ( $xp >= $level['min'] && $xp <= $level['max'] ) ) {
				$found = $level;
				break;
			}
		}

		return $found;
	}

	/**
	 * Niveau suivant.
	 *
	 * @param array $level Niveau courant.
	 * @return array|null
	 */
	public static function next_level( $level ) {
		$levels = self::levels();

		foreach ( $levels as $index => $candidate ) {
			if ( $candidate['number'] === $level['number'] ) {
				return isset( $levels[ $index + 1 ] ) ? $levels[ $index + 1 ] : null;
			}
		}

		return null;
	}

	/* ---------------------------------------------------------------------
	 * État
	 * ------------------------------------------------------------------ */

	/**
	 * État complet d'un utilisateur.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @return array
	 */
	public static function get_state( $user_id ) {
		$user_id = absint( $user_id );

		$progress = get_user_meta( $user_id, SECURA_USER_PROGRESS, true );
		$medals   = get_user_meta( $user_id, SECURA_USER_MEDALS, true );
		$exams    = get_user_meta( $user_id, SECURA_USER_EXAMS, true );
		$streak   = get_user_meta( $user_id, SECURA_USER_STREAK, true );

		$progress = is_array( $progress ) ? $progress : array();

		return array(
			'xp'       => self::get_xp( $user_id ),
			'progress' => self::migrate_progress( $progress ),
			'medals'   => is_array( $medals ) ? $medals : array(),
			'exams'    => is_array( $exams ) ? $exams : array(),
			'streak'   => is_array( $streak ) ? $streak : array( 'current' => 0, 'longest' => 0, 'last_day' => '' ),
			'level'    => self::level_for_xp( self::get_xp( $user_id ) ),
			'schema'   => self::schema_version(),
		);
	}

	/**
	 * Version du schéma de progression.
	 *
	 * 1 : format plat { solved: { question: true } }.
	 * 2 : format par tâche { tasks: { index: { solved, hints, terminal_done } } }.
	 *
	 * @return int
	 */
	public static function schema_version() {
		return 2;
	}

	/**
	 * Migre une progression ancienne vers le schéma courant.
	 *
	 * @param array $progress Progression brute.
	 * @return array
	 */
	public static function migrate_progress( $progress ) {
		if ( ! is_array( $progress ) ) {
			return array();
		}

		$version = isset( $progress['__schema'] ) ? absint( $progress['__schema'] ) : 1;

		if ( $version >= self::schema_version() ) {
			return $progress;
		}

		$rooms = array();

		foreach ( $progress as $key => $room ) {
			if ( '__schema' === $key || ! is_array( $room ) ) {
				continue;
			}

			/* Ancien format plat : tout est regroupé dans la première tâche. */
			if ( ! isset( $room['tasks'] ) && isset( $room['solved'] ) ) {
				$solved = array();

				foreach ( (array) $room['solved'] as $index => $value ) {
					if ( $value ) {
						$solved[] = (int) $index;
					}
				}

				$room = array(
					'tasks'      => array(
						0 => array(
							'solved' => array_flip( $solved ),
							'hints'  => array(),
							'done'   => true,
						),
					),
					'completed'  => ! empty( $room['completed'] ),
					'best_score' => isset( $room['best_score'] ) ? absint( $room['best_score'] ) : 0,
					'medal'      => isset( $room['medal'] ) ? $room['medal'] : '',
				);
			}

			if ( ! isset( $room['tasks'] ) || ! is_array( $room['tasks'] ) ) {
				$room['tasks'] = array();
			}

			foreach ( $room['tasks'] as $index => $task ) {
				if ( ! is_array( $task ) ) {
					$room['tasks'][ $index ] = array( 'solved' => array(), 'hints' => array() );
					continue;
				}

				if ( ! isset( $task['solved'] ) || ! is_array( $task['solved'] ) ) {
					$task['solved'] = array();
				}

				if ( ! isset( $task['hints'] ) || ! is_array( $task['hints'] ) ) {
					$task['hints'] = array();
				}

				if ( ! isset( $task['terminal_done'] ) ) {
					$task['terminal_done'] = false;
				}

				$room['tasks'][ $index ] = $task;
			}

			$rooms[ $key ] = $room;
		}

		$rooms['__schema'] = self::schema_version();

		return $rooms;
	}

	/**
	 * État d'une room pour un utilisateur, avec conversion de l'ancien format.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $room_id Identifiant de la room.
	 * @return array
	 */
	public static function get_room_state( $user_id, $room_id ) {
		$state    = self::get_state( $user_id );
		$key      = (string) absint( $room_id );
		$progress = $state['progress'];

		if ( ! isset( $progress[ $key ] ) || ! is_array( $progress[ $key ] ) ) {
			return self::empty_room_state();
		}

		$room = $progress[ $key ];

		/* Conversion depuis l'ancien format plat { solved: { q: true } }. */
		if ( ! isset( $room['tasks'] ) && isset( $room['solved'] ) ) {
			$solved = array();

			foreach ( (array) $room['solved'] as $index => $value ) {
				if ( $value ) {
					$solved[] = (int) $index;
				}
			}

			$room = array(
				'tasks'      => array(
					0 => array(
						'solved' => array_flip( $solved ),
						'hints'  => array(),
						'done'   => true,
					),
				),
				'completed'  => ! empty( $room['completed'] ),
				'best_score' => isset( $room['best_score'] ) ? absint( $room['best_score'] ) : 0,
				'medal'      => isset( $room['medal'] ) ? $room['medal'] : '',
			);
		}

		if ( ! isset( $room['tasks'] ) || ! is_array( $room['tasks'] ) ) {
			$room['tasks'] = array();
		}

		$room['completed']  = ! empty( $room['completed'] );
		$room['best_score'] = isset( $room['best_score'] ) ? absint( $room['best_score'] ) : 0;
		$room['medal']      = isset( $room['medal'] ) ? $room['medal'] : '';

		return $room;
	}

	/**
	 * État vide d'une room.
	 *
	 * @return array
	 */
	public static function empty_room_state() {
		return array(
			'tasks'      => array(),
			'completed'  => false,
			'best_score' => 0,
			'medal'      => '',
		);
	}

	/**
	 * Sauvegarde l'état d'une room.
	 *
	 * @param int   $user_id Identifiant de l'utilisateur.
	 * @param int   $room_id Identifiant de la room.
	 * @param array $state   État.
	 */
	public static function save_room_state( $user_id, $room_id, $state ) {
		$progress = get_user_meta( $user_id, SECURA_USER_PROGRESS, true );
		$progress = is_array( $progress ) ? $progress : array();

		$progress[ (string) absint( $room_id ) ] = $state;
		$progress['__schema']                   = self::schema_version();

		update_user_meta( $user_id, SECURA_USER_PROGRESS, $progress );
	}

	/* ---------------------------------------------------------------------
	 * Tâches et médailles
	 * ------------------------------------------------------------------ */

	/**
	 * Marque une question comme résolue dans une tâche.
	 *
	 * @param int   $user_id    Identifiant de l'utilisateur.
	 * @param int   $room_id    Identifiant de la room.
	 * @param int   $task_index Index de la tâche.
	 * @param int   $question   Index de la question.
	 * @param bool  $hint_used  Un indice a-t-il été ouvert ?
	 * @return array État de la tâche.
	 */
	public static function mark_question( $user_id, $room_id, $task_index, $question, $hint_used = false ) {
		$room  = self::get_room_state( $user_id, $room_id );
		$index = (string) absint( $task_index );

		if ( ! isset( $room['tasks'][ $index ] ) || ! is_array( $room['tasks'][ $index ] ) ) {
			$room['tasks'][ $index ] = array(
				'solved' => array(),
				'hints'  => array(),
				'done'   => false,
			);
		}

		$room['tasks'][ $index ]['solved'][ (string) absint( $question ) ] = true;

		if ( $hint_used && ! isset( $room['tasks'][ $index ]['hints'][ (string) absint( $question ) ] ) ) {
			$room['tasks'][ $index ]['hints'][ (string) absint( $question ) ] = true;
		}

		self::save_room_state( $user_id, $room_id, $room );

		return $room['tasks'][ $index ];
	}

	/**
	 * Réserve une question pour l'apprenant.
	 *
	 * Contrairement à mark_question(), la méthode renvoie false si la question
	 * était déjà résolue. C'est ce retour qui permet d'attribuer les XP une
	 * seule fois, même si deux requêtes arrivent en même temps.
	 *
	 * @param int  $user_id    Identifiant de l'utilisateur.
	 * @param int  $room_id    Identifiant de la room.
	 * @param int  $task_index Index de la tâche.
	 * @param int  $question   Index de la question.
	 * @param bool $hint_used  Un indice a-t-il été ouvert ?
	 * @return bool Vrai si la question vient d'être réservée.
	 */
	public static function claim_question( $user_id, $room_id, $task_index, $question, $hint_used = false ) {
		$room  = self::get_room_state( $user_id, $room_id );
		$index = (string) absint( $task_index );
		$key   = (string) absint( $question );

		if ( ! isset( $room['tasks'][ $index ] ) || ! is_array( $room['tasks'][ $index ] ) ) {
			$room['tasks'][ $index ] = array(
				'solved' => array(),
				'hints'  => array(),
				'done'   => false,
			);
		}

		if ( isset( $room['tasks'][ $index ]['solved'][ $key ] ) ) {
			return false;
		}

		$room['tasks'][ $index ]['solved'][ $key ] = true;

		if ( $hint_used ) {
			$room['tasks'][ $index ]['hints'][ $key ] = true;
		}

		self::save_room_state( $user_id, $room_id, $room );

		return true;
	}

	/**
	 * Marque le scénario du terminal d'une tâche comme terminé.
	 *
	 * @param int $user_id    Identifiant de l'utilisateur.
	 * @param int $room_id    Identifiant de la room.
	 * @param int $task_index Index de la tâche.
	 */
	public static function mark_terminal_done( $user_id, $room_id, $task_index ) {
		$room  = self::get_room_state( $user_id, $room_id );
		$index = (string) absint( $task_index );

		if ( ! isset( $room['tasks'][ $index ] ) || ! is_array( $room['tasks'][ $index ] ) ) {
			$room['tasks'][ $index ] = array(
				'solved' => array(),
				'hints'  => array(),
				'done'   => false,
			);
		}

		$room['tasks'][ $index ]['terminal_done'] = true;

		self::save_room_state( $user_id, $room_id, $room );
	}

	/**
	 * Marque l'usage d'un indice.
	 *
	 * @param int $user_id    Identifiant de l'utilisateur.
	 * @param int $room_id    Identifiant de la room.
	 * @param int $task_index Index de la tâche.
	 * @param int $question   Index de la question.
	 */
	public static function mark_hint( $user_id, $room_id, $task_index, $question ) {
		$room  = self::get_room_state( $user_id, $room_id );
		$index = (string) absint( $task_index );

		if ( ! isset( $room['tasks'][ $index ] ) ) {
			$room['tasks'][ $index ] = array(
				'solved' => array(),
				'hints'  => array(),
				'done'   => false,
			);
		}

		$room['tasks'][ $index ]['hints'][ (string) absint( $question ) ] = true;

		self::save_room_state( $user_id, $room_id, $room );
	}

	/**
	 * Un indice a-t-il été utilisé dans cette question ?
	 *
	 * @param int $user_id    Identifiant de l'utilisateur.
	 * @param int $room_id    Identifiant de la room.
	 * @param int $task_index Index de la tâche.
	 * @param int $question   Index de la question.
	 * @return bool
	 */
	public static function hint_used( $user_id, $room_id, $task_index, $question ) {
		$room = self::get_room_state( $user_id, $room_id );
		$key  = (string) absint( $question );

		return isset( $room['tasks'][ (string) absint( $task_index ) ]['hints'][ $key ] );
	}

	/**
	 * Une tâche est-elle terminée ?
	 *
	 * @param array $task   Tâche.
	 * @param array $tstate État de la tâche.
	 * @return bool
	 */
	public static function is_task_done( $task, $tstate ) {
		if ( ! is_array( $tstate ) ) {
			return false;
		}

		$questions = isset( $task['questions'] ) ? $task['questions'] : array();
		$terminal  = isset( $task['terminal'] ) && is_array( $task['terminal'] ) ? $task['terminal'] : array();

		/* Tâche pratique sans questions : le scénario du terminal fait foi. */
		if ( empty( $questions ) ) {
			if ( ! empty( $terminal['steps'] ) ) {
				return ! empty( $tstate['terminal_done'] );
			}

			return ! empty( $tstate['done'] );
		}

		$solved = 0;
		$total  = count( $questions );

		foreach ( array_keys( $questions ) as $index ) {
			if ( isset( $tstate['solved'][ (string) $index ] ) ) {
				$solved++;
			}
		}

		/* Sans seuil explicite, toutes les questions doivent être résolues.
		   Avec un seuil (test pratique ou examen), la tâche est réussie dès
		   que le score atteint ce seuil — et le seuil devient un vrai
		   contrat de validation, pas une decoration. */
		$threshold = isset( $task['pass_score'] ) && absint( $task['pass_score'] ) > 0 ? absint( $task['pass_score'] ) : 100;

		$score = (int) round( ( $solved / $total ) * 100 );

		return $score >= $threshold;
	}

	/**
	 * Score d'une tâche, en pourcentage.
	 *
	 * @param array $task   Tâche.
	 * @param array $tstate État de la tâche.
	 * @return int
	 */
	public static function task_score( $task, $tstate ) {
		$questions = isset( $task['questions'] ) ? $task['questions'] : array();

		if ( empty( $questions ) ) {
			return 0;
		}

		$solved = 0;
		$total  = count( $questions );

		foreach ( array_keys( $questions ) as $index ) {
			if ( isset( $tstate['solved'][ (string) $index ] ) ) {
				$solved++;
			}
		}

		return (int) round( ( $solved / $total ) * 100 );
	}

	/**
	 * Seuil de passage d'une tâche (100 % par défaut).
	 *
	 * @param array $task Tâche.
	 * @return int
	 */
	public static function task_threshold( $task ) {
		return isset( $task['pass_score'] ) && absint( $task['pass_score'] ) > 0 ? absint( $task['pass_score'] ) : 100;
	}

	/**
	 * Une tâche est-elle déverrouillée ?
	 *
	 * @param array $tasks  Toutes les tâches.
	 * @param int   $index  Index de la tâche.
	 * @param array $state  État de la room.
	 * @return bool
	 */
	public static function is_task_unlocked( $tasks, $index, $state ) {
		if ( 0 === (int) $index ) {
			return true;
		}

		$previous = isset( $tasks[ $index - 1 ] ) ? $tasks[ $index - 1 ] : null;

		if ( ! $previous ) {
			return true;
		}

		$tstate = isset( $state['tasks'][ (string) ( (int) $index - 1 ) ] ) ? $state['tasks'][ (string) ( (int) $index - 1 ) ] : array();

		return self::is_task_done( $previous, $tstate );
	}

	/**
	 * Score pondéré d'une room, en pourcentage.
	 *
	 * @param array $tasks Tâches.
	 * @param array $state État de la room.
	 * @return array{score:int,correct:int,total:int,hints:int}
	 */
	public static function compute_score( $tasks, $state ) {
		$correct = 0;
		$total   = 0;
		$hints   = 0;

		foreach ( $tasks as $index => $task ) {
			$questions = isset( $task['questions'] ) ? $task['questions'] : array();
			$tstate    = isset( $state['tasks'][ (string) $index ] ) ? $state['tasks'][ (string) $index ] : array();

			foreach ( $questions as $q_index => $question ) {
				$weight = isset( $question['weight'] ) && $question['weight'] > 0 ? absint( $question['weight'] ) : 1;
				$total += $weight;

				if ( isset( $tstate['solved'][ (string) $q_index ] ) ) {
					$correct += $weight;
				}
			}

			if ( isset( $tstate['hints'] ) && is_array( $tstate['hints'] ) ) {
				$hints += count( $tstate['hints'] );
			}
		}

		$score = $total > 0 ? (int) round( ( $correct / $total ) * 100 ) : 0;

		return array(
			'score'   => $score,
			'correct' => $correct,
			'total'   => $total,
			'hints'   => $hints,
		);
	}

	/**
	 * Médaille correspondant à un score et un usage d'indices.
	 *
	 * @param int $score Score en pourcentage.
	 * @param int $hints Nombre d'indices utilisés.
	 * @return string bronze|silver|gold|''
	 */
	public static function medal_for( $score, $hints ) {
		if ( $score >= 100 && 0 === $hints ) {
			return 'gold';
		}

		if ( $score >= 80 && 0 === $hints ) {
			return 'silver';
		}

		if ( $score >= 60 ) {
			return 'bronze';
		}

		return '';
	}

	/**
	 * Enregistre une médaille (elle ne descend jamais).
	 *
	 * @param int    $user_id Identifiant de l'utilisateur.
	 * @param string $key     Clé de la médaille.
	 * @param string $medal   Médaille obtenue.
	 * @param int    $score   Score associé.
	 * @return array
	 */
	public static function add_medal( $user_id, $key, $medal, $score = 0 ) {
		$medals = get_user_meta( $user_id, SECURA_USER_MEDALS, true );
		$medals = is_array( $medals ) ? $medals : array();

		$order = array( '' => 0, 'bronze' => 1, 'silver' => 2, 'gold' => 3 );
		$current = isset( $medals[ $key ]['medal'] ) ? $medals[ $key ]['medal'] : '';

		if ( isset( $order[ $medal ] ) && $order[ $medal ] > $order[ $current ] ) {
			$medals[ $key ] = array(
				'medal'     => $medal,
				'score'     => absint( $score ),
				'earned_at' => current_time( 'mysql' ),
			);

			update_user_meta( $user_id, SECURA_USER_MEDALS, $medals );

			return array(
				'added'  => true,
				'medal'  => $medal,
				'medals' => $medals,
			);
		}

		return array(
			'added'  => false,
			'medal'  => $current,
			'medals' => $medals,
		);
	}

	/* ---------------------------------------------------------------------
	 * Examens
	 * ------------------------------------------------------------------ */

	/**
	 * Clé unique d'un examen.
	 *
	 * @param int $room_id    Identifiant de la room.
	 * @param int $task_index Index de la tâche.
	 * @return string
	 */
	public static function exam_key( $room_id, $task_index ) {
		return absint( $room_id ) . ':' . absint( $task_index );
	}

	/**
	 * Démarre (ou réutilise) le chronomètre d'un examen.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $room_id Identifiant de la room.
	 * @param int $index   Index de la tâche.
	 * @return array
	 */
	public static function start_exam( $user_id, $room_id, $index, $force = false ) {
		$exams = get_user_meta( $user_id, SECURA_USER_EXAMS, true );
		$exams = is_array( $exams ) ? $exams : array();
		$key   = self::exam_key( $room_id, $index );

		if ( ! isset( $exams[ $key ] ) || ! is_array( $exams[ $key ] ) ) {
			$exams[ $key ] = array(
				'started_at'  => time(),
				'finished_at' => 0,
				'score'       => 0,
				'best_score'  => 0,
				'passed'      => false,
				'attempts'    => 0,
				'awarded'     => false,
			);

			update_user_meta( $user_id, SECURA_USER_EXAMS, $exams );

			return $exams[ $key ];
		}

		/* Nouvel essai : on relance le chronomètre, on garde le bonus
		   déjà versé et le meilleur score. Un examen réussi n'est jamais
		   relancé automatiquement : c'est une nouvelle tentative explicite. */
		$finished = ! empty( $exams[ $key ]['finished_at'] );
		$passed   = ! empty( $exams[ $key ]['passed'] );

		if ( $finished && ( $force || ! $passed ) ) {
			$exams[ $key ]['started_at']  = time();
			$exams[ $key ]['finished_at'] = 0;
			$exams[ $key ]['passed']      = false;

			update_user_meta( $user_id, SECURA_USER_EXAMS, $exams );
		}

		return $exams[ $key ];
	}

	/**
	 * Marque un examen comme récompensé (XP de réussite versé une seule fois).
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $room_id Identifiant de la room.
	 * @param int $index   Index de la tâche.
	 * @return array
	 */
	public static function mark_exam_awarded( $user_id, $room_id, $index ) {
		$exams = get_user_meta( $user_id, SECURA_USER_EXAMS, true );
		$exams = is_array( $exams ) ? $exams : array();
		$key   = self::exam_key( $room_id, $index );

		if ( ! isset( $exams[ $key ] ) ) {
			return array();
		}

		$exams[ $key ]['awarded'] = true;

		update_user_meta( $user_id, SECURA_USER_EXAMS, $exams );

		return $exams[ $key ];
	}

	/**
	 * État d'un examen.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $room_id Identifiant de la room.
	 * @param int $index   Index de la tâche.
	 * @return array|null
	 */
	public static function exam_state( $user_id, $room_id, $index ) {
		$exams = get_user_meta( $user_id, SECURA_USER_EXAMS, true );
		$exams = is_array( $exams ) ? $exams : array();
		$key   = self::exam_key( $room_id, $index );

		return isset( $exams[ $key ] ) ? $exams[ $key ] : null;
	}

	/**
	 * Enregistre le résultat d'un examen.
	 *
	 * @param int  $user_id Identifiant de l'utilisateur.
	 * @param int  $room_id Identifiant de la room.
	 * @param int  $index   Index de la tâche.
	 * @param int  $score   Score en pourcentage.
	 * @param bool $passed  Réussite.
	 * @return array
	 */
	public static function finish_exam( $user_id, $room_id, $index, $score, $passed ) {
		$exams = get_user_meta( $user_id, SECURA_USER_EXAMS, true );
		$exams = is_array( $exams ) ? $exams : array();
		$key   = self::exam_key( $room_id, $index );

		if ( ! isset( $exams[ $key ] ) ) {
			$exams[ $key ] = array( 'started_at' => time() );
		}

		$exams[ $key ]['finished_at'] = time();
		$exams[ $key ]['score']       = absint( $score );
		$exams[ $key ]['passed']      = (bool) $passed;
		$exams[ $key ]['attempts']    = isset( $exams[ $key ]['attempts'] ) ? absint( $exams[ $key ]['attempts'] ) + 1 : 1;
		$exams[ $key ]['best_score']  = max( absint( $score ), isset( $exams[ $key ]['best_score'] ) ? absint( $exams[ $key ]['best_score'] ) : 0 );

		if ( ! isset( $exams[ $key ]['awarded'] ) ) {
			$exams[ $key ]['awarded'] = false;
		}

		update_user_meta( $user_id, SECURA_USER_EXAMS, $exams );

		return $exams[ $key ];
	}

	/**
	 * L'examen est-il expiré ?
	 *
	 * @param array $exam  État de l'examen.
	 * @param int   $limit Durée en minutes.
	 * @return bool
	 */
	public static function exam_expired( $exam, $limit ) {
		if ( ! is_array( $exam ) || empty( $exam['started_at'] ) || $limit <= 0 ) {
			return false;
		}

		return ( time() - absint( $exam['started_at'] ) ) > ( absint( $limit ) * 60 );
	}

	/* ---------------------------------------------------------------------
	 * Série de jours consécutifs
	 * ------------------------------------------------------------------ */

	/**
	 * Met à jour la série de jours consécutifs.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @return array
	 */
	public static function touch_streak( $user_id ) {
		$streak = get_user_meta( $user_id, SECURA_USER_STREAK, true );
		$streak = is_array( $streak ) ? $streak : array( 'current' => 0, 'longest' => 0, 'last_day' => '' );

		$today = current_time( 'Y-m-d' );
		$last  = isset( $streak['last_day'] ) ? $streak['last_day'] : '';

		if ( $last === $today ) {
			return $streak;
		}

		$yesterday = gmdate( 'Y-m-d', strtotime( $today . ' -1 day' ) );

		if ( $last === $yesterday ) {
			$streak['current'] = absint( $streak['current'] ) + 1;
		} else {
			$streak['current'] = 1;
		}

		$streak['longest'] = max( absint( $streak['longest'] ), absint( $streak['current'] ) );
		$streak['last_day'] = $today;

		update_user_meta( $user_id, SECURA_USER_STREAK, $streak );

		return $streak;
	}

	/**
	 * Normalise une réponse pour comparaison.
	 *
	 * @param string $answer Réponse brute.
	 * @return string
	 */
	public static function normalize_answer( $answer ) {
		$answer = wp_strip_all_tags( (string) $answer );
		$answer = remove_accents( $answer );
		$answer = strtolower( $answer );
		$answer = preg_replace( '/\s+/u', ' ', $answer );
		$answer = trim( (string) $answer, " \t\n\r\0\x0B.,;:!?-–—'\"«»()[]{}" );

		return (string) $answer;
	}

	/**
	 * Compare une réponse à la liste des réponses acceptées.
	 *
	 * @param string $answer   Réponse de l'apprenant.
	 * @param array  $accepted Réponses acceptées.
	 * @return bool
	 */
	/**
	 * Verifie qu'une action demandee (question sans reponse) est realisee.
	 *
	 * La verification s'appuie sur l'etat reel du terminal : l'apprenant
	 * ne peut pas cocher une action qu'il n'a pas encore executee.
	 *
	 * @param int   $user_id  Identifiant de l'apprenant.
	 * @param int   $room_id  Identifiant de la room.
	 * @param int   $index    Index de la tache.
	 * @param array $question Question concernee.
	 * @return bool
	 */
	public static function action_completed( $user_id, $room_id, $index, $question ) {
		$state  = self::get_room_state( $user_id, $room_id );
		$tstate = isset( $state['tasks'][ (string) $index ] ) ? $state['tasks'][ (string) $index ] : array();

		/* Scenario de terminal valide : l'action demandee a ete realisee. */
		if ( ! empty( $tstate['terminal_done'] ) ) {
			return true;
		}

		/* Une etape de terminal a ete atteinte : l'action a ete faite. */
		$step = isset( $question['requires_step'] ) ? absint( $question['requires_step'] ) : -1;

		if ( $step >= 0 ) {
			$terminal = Secura_Terminal::get_state( $user_id, $room_id, $index );
			$current  = isset( $terminal['step'] ) ? absint( $terminal['step'] ) : 0;

			if ( $current > $step ) {
				return true;
			}
		}

		/* Aucune verification automatique possible : l'apprenant coche. */
		return true;
	}

	public static function answer_matches( $answer, $accepted ) {
		$normalized = self::normalize_answer( $answer );

		if ( '' === $normalized || empty( $accepted ) ) {
			return false;
		}

		foreach ( $accepted as $candidate ) {
			if ( self::normalize_answer( $candidate ) === $normalized ) {
				return true;
			}
		}

		return false;
	}
}
