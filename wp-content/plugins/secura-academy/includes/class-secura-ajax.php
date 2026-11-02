<?php
/**
 * Endpoints AJAX : rooms, tâches, validation, indices, terminal, examens.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Traite les requêtes AJAX du plugin.
 */
final class Secura_Ajax {

	/**
	 * Branche les hooks.
	 *
	 * Chaque action est enregistrée DEUX fois : pour les visiteurs
	 * connectés (wp_ajax_) et pour les visiteurs non connectés
	 * (wp_ajax_nopriv_).
	 *
	 * Pourquoi ? Sans le pendant « nopriv », WordPress ne fait jamais
	 * appel au gestionnaire pour un visiteur anonyme : il répond « 0 »
	 * à la requête, sans code HTTP exploitable. Le script du navigateur
	 * recevait alors une erreur muette (« Une erreur est survenue. »)
	 * au lieu d'une invitation à créer un compte.
	 *
	 * Aucun risque de fuite : check_request() est appelé en tête de
	 * chaque gestionnaire et renvoie 401 « Connectez-vous pour
	 * continuer. » avant tout traitement.
	 *
	 * Les noms d'actions sont un CONTRAT : ils sont écrits dans
	 * assets/academy.js (le front), dans les tests et dans la recette
	 * des deux apprenants. Changer un de ces noms casse le site sans
	 * qu'aucune erreur ne soit visible dans les journaux : WordPress
	 * repond simplement « 0 » a l'appel AJAX. Ne pas y toucher.
	 */
	public static function init() {
		$actions = array(
			'secura_get_room'        => 'get_room',
			'secura_get_task'        => 'get_task',
			'secura_validate_answer' => 'validate_answer',
			'secura_hint'            => 'hint',
			'secura_terminal'        => 'terminal',
			'secura_complete_lesson' => 'complete_lesson',
			'secura_start_exam'      => 'start_exam',
			'secura_lab_start'       => 'lab_start',
			'secura_lab_stop'        => 'lab_stop',
			'secura_lab_status'      => 'lab_status',
			'secura_set_lang'        => 'set_lang',
		);

		foreach ( $actions as $action => $methode ) {
			add_action( 'wp_ajax_' . $action, array( __CLASS__, $methode ) );
			add_action( 'wp_ajax_nopriv_' . $action, array( __CLASS__, $methode ) );
		}
	}

	/**
	 * Vérifie le nonce et l'authentification.
	 */
	private static function check_request() {
		$nonce = isset( $_REQUEST['nonce'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ) : '';

		if ( ! wp_verify_nonce( $nonce, 'secura_academy' ) ) {
			wp_send_json_error(
				array(
					'message' => Secura_I18n::t( 'invalid_nonce', '', 'Session expirée. Rechargez la page pour continuer.' ),
					'code'    => 'invalid_nonce',
				),
				403
			);
		}

		if ( ! is_user_logged_in() ) {
			wp_send_json_error(
				array(
					'message' => Secura_I18n::t( 'not_logged_in', '', 'Connectez-vous pour continuer.' ),
					'code'    => 'not_logged_in',
					/* Les adresses suivent : l'élève voit une porte à
					   pousser, pas un mur. */
					'login_url'    => wp_login_url(),
					'register_url' => wp_registration_url(),
				),
				401
			);
		}
	}

	/**
	 * Limitation de débit : évite qu'un script automatisé martèle l'API.
	 *
	 * @param string $bucket Identifiant du compteur.
	 * @param int    $limit  Nombre d'appels autorisés.
	 * @param int    $window Fenêtre en secondes.
	 * @return bool Vrai si l'appel est autorisé.
	 */
	private static function throttle( $bucket, $limit = 40, $window = 60 ) {
		$key   = 'secura_throttle_' . substr( md5( $bucket ), 0, 20 );
		$count = (int) get_transient( $key );

		if ( $count >= $limit ) {
			return false;
		}

		set_transient( $key, $count + 1, $window );

		return true;
	}

	/**
	 * Récupère une room et ses tâches (jamais les réponses).
	 */
	public static function get_room() {
		self::check_request();

		$room_id = isset( $_POST['room_id'] ) ? absint( wp_unslash( $_POST['room_id'] ) ) : 0;
		$view    = Secura_Rooms::get_room_view( $room_id );

		if ( ! $view ) {
			wp_send_json_error( array( 'message' => Secura_I18n::t( 'room_not_found', '', 'Room introuvable.' ) ), 404 );
		}

		$user_id = get_current_user_id();
		$state   = Secura_Progress::get_room_state( $user_id, $room_id );
		$tasks   = array();

		foreach ( $view['tasks'] as $index => $task ) {
			$tstate      = isset( $state['tasks'][ (string) $index ] ) ? $state['tasks'][ (string) $index ] : array();
			$exam        = Secura_Progress::exam_state( $user_id, $room_id, $index );
			$unlocked    = Secura_Progress::is_task_unlocked( $view['tasks'], $index, $state );
			$solved      = isset( $tstate['solved'] ) ? count( $tstate['solved'] ) : 0;
			$total       = count( $task['questions'] );
			$time_left   = 0;

			if ( 'exam' === $task['type'] && $exam && ! empty( $exam['finished_at'] ) && empty( $exam['passed'] ) ) {
				/* Examen raté : la tentative repart de zéro. */
				$exam = Secura_Progress::start_exam( $user_id, $room_id, $index );
			}

			if ( 'exam' === $task['type'] && $exam && $task['time_limit'] > 0 ) {
				$time_left = max( 0, ( $task['time_limit'] * 60 ) - ( time() - absint( $exam['started_at'] ) ) );
			}

			$tasks[] = array(
				'index'      => $index,
				'type'       => $task['type'],
				'format'     => isset( $task['format'] ) ? $task['format'] : 'qcm',
				'title'      => $task['title'],
				'questions'  => $total,
				'solved'     => $solved,
				'score'      => Secura_Progress::task_score( $task, $tstate ),
				'threshold'  => Secura_Progress::task_threshold( $task ),
				'done'       => Secura_Progress::is_task_done( $task, $tstate ),
				'unlocked'   => $unlocked,
				'time_limit' => (int) $task['time_limit'],
				'pass_score' => (int) $task['pass_score'],
				'time_left'  => $time_left,
				'passed'     => $exam ? ! empty( $exam['passed'] ) : false,
				'has_terminal' => ! empty( $task['terminal']['steps'] ),
			);
		}

		$lab = Secura_Lab::status( $user_id, $room_id );

		wp_send_json_success(
			array(
				'room'       => array(
					'id'         => $view['id'],
					'title'      => $view['title'],
					'excerpt'    => $view['excerpt'],
					'content'    => $view['content'],
					'difficulty' => $view['difficulty'],
					'duration'   => $view['duration'],
					'xp_bonus'   => $view['xp_bonus'],
				),
				'tasks'      => $tasks,
				'lab'        => $lab,
				'completed'  => ! empty( $state['completed'] ),
				'best_score' => isset( $state['best_score'] ) ? absint( $state['best_score'] ) : 0,
				'medal'      => isset( $state['medal'] ) ? $state['medal'] : '',
			)
		);
	}

	/**
	 * Récupère une tâche : contenu, questions, terminal (sans les sorties).
	 */
	public static function get_task() {
		self::check_request();

		$room_id = isset( $_POST['room_id'] ) ? absint( wp_unslash( $_POST['room_id'] ) ) : 0;
		$index   = isset( $_POST['task'] ) ? intval( wp_unslash( $_POST['task'] ) ) : 0;
		$reveal  = isset( $_POST['reveal'] ) && '1' === $_POST['reveal'];

		$view = Secura_Rooms::get_room_view( $room_id );

		if ( ! $view || ! isset( $view['tasks'][ $index ] ) ) {
			wp_send_json_error( array( 'message' => Secura_I18n::t( 'task_not_found', '', 'Tâche introuvable.' ) ), 404 );
		}

		$user_id = get_current_user_id();
		$task    = $view['tasks'][ $index ];
		$state   = Secura_Progress::get_room_state( $user_id, $room_id );

		if ( ! Secura_Progress::is_task_unlocked( $view['tasks'], $index, $state ) ) {
			wp_send_json_error(
				array(
					'message' => Secura_I18n::t( 'lock_task', '', 'Terminez la tâche précédente pour continuer.' ),
					'code'    => 'locked',
				),
				403
			);
		}

		$tstate  = isset( $state['tasks'][ (string) $index ] ) ? $state['tasks'][ (string) $index ] : array();
		$done    = Secura_Progress::is_task_done( $task, $tstate );
		$is_exam = 'exam' === $task['type'];
		$exam    = Secura_Progress::exam_state( $user_id, $room_id, $index );

		/* Examen échoué : une nouvelle tentative repart d'un chronomètre neuf
		   pour que l'apprenant puisse améliorer son score. */
		if ( $is_exam && $exam && ! empty( $exam['finished_at'] ) && empty( $exam['passed'] ) ) {
			$exam = Secura_Progress::start_exam( $user_id, $room_id, $index );
		}

		if ( $is_exam && $exam && $task['time_limit'] > 0 && Secura_Progress::exam_expired( $exam, $task['time_limit'] ) ) {
			wp_send_json_error(
				array(
					'message' => Secura_I18n::t( 'expired', '', "Le temps de l'examen est écoulé." ),
					'code'    => 'expired',
				),
				403
			);
		}

		/* Chaque eleve recoit SA copie de l'epreuve : les questions
		   tirees au sort (reservoir du niveau, propositions melangees,
		   chiffres varies) remplacent la liste d'origine. C'est aussi
		   ce qui rend l'examen impossible a repeter par capture
		   d'ecran. */
		$task['questions'] = Secura_Exam::paper( $user_id, $room_id, $index, $task );

		$view['tasks'][ $index ] = $task;

		$questions = array();

		foreach ( $task['questions'] as $q_index => $question ) {
			$entry = array(
				'index'        => $q_index,
				'question'     => $question['question'],
				'mode'         => isset( $question['mode'] ) ? $question['mode'] : 'text',
				'choices'      => isset( $question['choices'] ) ? array_values( $question['choices'] ) : array(),
				'xp'           => (int) $question['xp'],
				'hint'         => $question['hint'],
				'weight'       => (int) $question['weight'],
				'requires_step' => (int) $question['requires_step'],
				'solved'       => isset( $tstate['solved'][ (string) $q_index ] ),
				'explanation'  => '',
			);

			/* L'explication n'est révélée qu'après la réussite, ou après la
			   fin de la tâche (récapitulatif pédagogique). */
			if ( $reveal && ( $done || ! empty( $entry['solved'] ) ) ) {
				$entry['explanation'] = $question['explanation'];
			}

			$questions[] = $entry;
		}

		$terminal = array(
			'intro'   => isset( $task['terminal']['intro'] ) ? $task['terminal']['intro'] : '',
			'steps'   => isset( $task['terminal']['steps'] ) ? count( $task['terminal']['steps'] ) : 0,
			'current' => 0,
		);

		if ( $terminal['steps'] > 0 ) {
			$tstate_terminal = Secura_Terminal::get_state( $user_id, $room_id, $index );
			$terminal['current'] = isset( $tstate_terminal['step'] ) ? absint( $tstate_terminal['step'] ) : 0;
		}

		wp_send_json_success(
			array(
				'task'      => array(
					'index'      => $index,
					'type'       => $task['type'],
					'format'     => isset( $task['format'] ) ? $task['format'] : 'qcm',
					'title'      => $task['title'],
					'content'    => $task['content'],
					'questions'  => $questions,
					'terminal'   => $terminal,
					'time_limit' => (int) $task['time_limit'],
					'pass_score' => (int) $task['pass_score'],
					'threshold'  => Secura_Progress::task_threshold( $task ),
					'score'      => Secura_Progress::task_score( $task, $tstate ),
					'done'       => $done,
					'passed'     => $exam ? ! empty( $exam['passed'] ) : false,
					'terminal_done' => ! empty( $tstate['terminal_done'] ),
					'time_left'  => $exam && $task['time_limit'] > 0 ? max( 0, ( $task['time_limit'] * 60 ) - ( time() - absint( $exam['started_at'] ) ) ) : 0,
				),
				'room_id'   => $room_id,
			)
		);
	}

	/**
	 * Valide une réponse.
	 */
	public static function validate_answer() {
		self::check_request();

		if ( ! self::throttle( 'validate_' . get_current_user_id(), 40, 60 ) ) {
			wp_send_json_error(
				array(
					'message' => Secura_I18n::t( 'slow_down', '', 'Tu vas un peu trop vite : laisse le temps au jeu de souffler.' ),
					'code'    => 'slow_down',
				),
				429
			);
		}

		$room_id = isset( $_POST['room_id'] ) ? absint( wp_unslash( $_POST['room_id'] ) ) : 0;
		$index   = isset( $_POST['task'] ) ? intval( wp_unslash( $_POST['task'] ) ) : 0;
		$q_index = isset( $_POST['question'] ) ? intval( wp_unslash( $_POST['question'] ) ) : -1;
		$answer  = isset( $_POST['answer'] ) ? sanitize_textarea_field( wp_unslash( $_POST['answer'] ) ) : '';

		$view = Secura_Rooms::get_room_view( $room_id );

		if ( ! $view || ! isset( $view['tasks'][ $index ] ) ) {
			wp_send_json_error( array( 'message' => Secura_I18n::t( 'task_not_found', '', 'Tâche introuvable.' ) ), 404 );
		}

		if ( $q_index < 0 || ! isset( $view['tasks'][ $index ]['questions'][ $q_index ] ) ) {
			wp_send_json_error( array( 'message' => Secura_I18n::t( 'question_invalid', '', 'Question invalide.' ) ), 400 );
		}

		$user_id = get_current_user_id();
		$task    = $view['tasks'][ $index ];

		/* On note la copie TIREE, celle que l'eleve a reellement vue :
		   si l'ordre des propositions a change, c'est la nouvelle
		   position de la bonne reponse qui fait foi. */
		$task['questions'] = Secura_Exam::paper( $user_id, $room_id, $index, $task );

		$view['tasks'][ $index ] = $task;

		$question = $view['tasks'][ $index ]['questions'][ $q_index ];
		$state   = Secura_Progress::get_room_state( $user_id, $room_id );

		if ( ! Secura_Progress::is_task_unlocked( $view['tasks'], $index, $state ) ) {
			wp_send_json_error(
				array(
					'message' => Secura_I18n::t( 'lock_task', '', 'Terminez la tâche précédente pour continuer.' ),
					'code'    => 'locked',
				),
				403
			);
		}

		/* Examen : contrôle du chronomètre côté serveur. */
		if ( 'exam' === $task['type'] ) {
			$exam = Secura_Progress::exam_state( $user_id, $room_id, $index );

			if ( ! $exam ) {
				$exam = Secura_Progress::start_exam( $user_id, $room_id, $index );
			} elseif ( ! empty( $exam['finished_at'] ) && empty( $exam['passed'] ) ) {
				/* L'examen précédent a été raté : on relance une tentative
				   propre plutôt que de refuser la réponse. */
				$exam = Secura_Progress::start_exam( $user_id, $room_id, $index );
			}

			if ( Secura_Progress::exam_expired( $exam, $task['time_limit'] ) ) {
				wp_send_json_error(
					array(
						'message' => Secura_I18n::t( 'expired', '', "Le temps de l'examen est écoulé." ),
						'code'    => 'expired',
					),
					403
				);
			}
		}

		/* Étape de terminal obligatoire avant de répondre. */
		if ( $question['requires_step'] >= 0 ) {
			$terminal_state = Secura_Terminal::get_state( $user_id, $room_id, $index );
			$current        = isset( $terminal_state['step'] ) ? absint( $terminal_state['step'] ) : 0;

			if ( $current < $question['requires_step'] ) {
				wp_send_json_error(
					array(
						'message' => Secura_I18n::t( 'explore', '', "Explorez d'abord la machine dans le terminal." ),
						'code'    => 'explore',
					),
					403
				);
			}
		}

		$already = isset( $state['tasks'][ (string) $index ]['solved'][ (string) $q_index ] );
		$mode    = isset( $question['mode'] ) ? $question['mode'] : 'text';

		if ( 'action' === $mode ) {
			/* Question sans reponse : l'apprenant declare avoir realise
			   l'action. Le serveur verifie l'etat reel du terminal. */
			$correct = Secura_Progress::action_completed( $user_id, $room_id, $index, $question );
		} elseif ( 'flag' === $mode ) {
			/* Le drapeau est lu dans la machine de l'apprenant : on ne
			   peut pas valider l'etape sans l'avoir vraiment trouve. */
			$correct = Secura_Lab::flag_matches(
				$user_id,
				$room_id,
				isset( $question['flag_path'] ) ? $question['flag_path'] : '',
				$answer
			);
		} elseif ( 'choice' === $mode ) {
			$expected = isset( $question['choices'][ (int) $question['correct'] ] ) ? $question['choices'][ (int) $question['correct'] ] : '';
			$correct  = ( '' !== $expected ) && Secura_Progress::answer_matches( $answer, array( $expected ) );
		} elseif ( 'solution' === $mode ) {
			/* Un probleme d'examen universitaire : la redaction n'est pas
			   corrigee automatiquement (ce serait pretendre qu'une machine
			   comprend une reponse en prose). L'eleve doit avoir tente
			   (au moins quelques mots), puis la correction officielle de
			   l'ecole lui est montree : c'est elle qui fait la leçon. */
			$correct = ( strlen( trim( (string) $answer ) ) >= 10 );
		} else {
			$correct = Secura_Progress::answer_matches( $answer, $question['answers'] );
		}

		if ( ! $correct ) {
			wp_send_json_success(
				array(
					'correct'   => false,
					'message'   => Secura_I18n::t( 'wrong', '', 'Pas encore, réessayez.' ),
					'hint'      => $question['hint'],
					'total_xp'  => Secura_Progress::get_xp( $user_id ),
				)
			);
		}

		$xp_before = Secura_Progress::get_xp( $user_id );
		$level_before = Secura_Progress::level_for_xp( $xp_before );
		$hint_used = Secura_Progress::hint_used( $user_id, $room_id, $index, $q_index );
		$points    = 0;
		$rank      = 1.0;

		/* La question est réservée avant le versement des XP : deux requêtes
		   simultanées ne peuvent donc pas se partager la récompense. */
		$claimed = Secura_Progress::claim_question( $user_id, $room_id, $index, $q_index, $hint_used );

		if ( ! $already && $claimed ) {
			$award = Secura_Progress::award(
				$user_id,
				array(
					'room_id'      => $room_id,
					'task_index'   => $index,
					'question'     => $q_index,
					'base_xp'      => $question['xp'],
					'difficulty'   => $view['difficulty_key'],
					'type'         => $task['type'],
					'hint_used'    => $hint_used,
					'question_key' => $room_id . ':' . $index . ':' . $q_index,
				)
			);

			$points = $award['points'];
			$rank   = $award['rank'];
		} elseif ( ! $claimed ) {
			Secura_Progress::mark_question( $user_id, $room_id, $index, $q_index, $hint_used );
		}

		$state = Secura_Progress::get_room_state( $user_id, $room_id );
		$done  = Secura_Progress::is_task_done( $task, isset( $state['tasks'][ (string) $index ] ) ? $state['tasks'][ (string) $index ] : array() );

		/* Examen : clôture et médaille. */
		$exam_result = null;

		if ( 'exam' === $task['type'] && $done ) {
			$exam_result = self::close_exam( $user_id, $room_id, $index, $task, $state, $view['difficulty_key'] );
		}

		/* Médaille de room dès que toutes les questions sont résolues. */
		$medal  = null;
		$room_complete = false;

		if ( self::room_is_complete( $view['tasks'], $state ) ) {
			$room_complete = true;
			$medal = self::update_room_medal( $user_id, $room_id, $view, $state );
		}

		$xp_after = Secura_Progress::get_xp( $user_id );
		$level_after = Secura_Progress::level_for_xp( $xp_after );

		wp_send_json_success(
			array(
				'correct'       => true,
				'already'       => (bool) $already,
				'message'       => $already
					? Secura_I18n::t( 'solved', '', 'Validée' )
					: ( 'solution' === $mode
						? sprintf( /* translators: %d : points gagnés. */ Secura_I18n::t( 'solution_xp', '', 'Correction officielle affichée. +%d XP' ), $points )
						: sprintf( /* translators: %d : points gagnés. */ Secura_I18n::t( 'correct_xp', '', 'Bonne réponse ! +%d XP' ), $points ) ),
				'points'        => $points,
				'rank'          => $rank,
				'hint_used'     => $hint_used,
				'explanation'   => $question['explanation'],
				'total_xp'      => $xp_after,
				'level'         => $level_after,
				'level_up'      => $level_after['number'] > $level_before['number'],
				'task_done'     => $done,
				'room_complete' => $room_complete,
				'medal'         => $medal,
				'exam'          => $exam_result,
			)
		);
	}

	/**
	 * Clôture d'un examen : score, seuil, médaille.
	 *
	 * @param int    $user_id    Identifiant de l'utilisateur.
	 * @param int    $room_id    Identifiant de la room.
	 * @param int    $index      Index de la tâche.
	 * @param array  $task       Tâche.
	 * @param array  $state      État de la room.
	 * @param string $difficulty Clé de difficulté de la room.
	 * @return array
	 */
	private static function close_exam( $user_id, $room_id, $index, $task, $state, $difficulty = 'facile' ) {
		$total   = count( $task['questions'] );
		$correct = 0;

		foreach ( $task['questions'] as $q_index => $question ) {
			if ( isset( $state['tasks'][ (string) $index ]['solved'][ (string) $q_index ] ) ) {
				$correct++;
			}
		}

		$score  = $total > 0 ? (int) round( ( $correct / $total ) * 100 ) : 0;
		$passed = $score >= (int) $task['pass_score'];
		$exam   = Secura_Progress::finish_exam( $user_id, $room_id, $index, $score, $passed );

		/* Le bonus de réussite n'est versé qu'à la première réussite. */
		$awarded = ! empty( $exam['awarded'] );

		if ( $passed && ! $awarded ) {
			$bonus = Secura_Progress::base_points( $difficulty ) * 2;

			Secura_Progress::award(
				$user_id,
				array(
					'room_id'    => $room_id,
					'task_index' => $index,
					'base_xp'    => $bonus,
					'difficulty' => $difficulty,
					'type'       => 'exam',
				)
			);

			$exam    = Secura_Progress::mark_exam_awarded( $user_id, $room_id, $index );
			$awarded = true;
		}

		$medal = '';

		if ( $passed ) {
			$threshold = (int) $task['pass_score'];
			$level     = 'bronze';

			if ( $score >= $threshold + 20 ) {
				$level = 'gold';
			} elseif ( $score >= $threshold + 10 ) {
				$level = 'silver';
			}

			$medal = Secura_Progress::add_medal( $user_id, 'exam_' . $room_id . '_' . $index, $level, $score );
			$medal = $medal['added'] ? $level : $medal['medal'];
		}

		return array(
			'score'      => $score,
			'passed'     => $passed,
			'threshold'  => (int) $task['pass_score'],
			'correct'    => $correct,
			'total'      => $total,
			'medal'      => $medal,
			'awarded'    => $awarded,
			'best_score' => isset( $exam['best_score'] ) ? absint( $exam['best_score'] ) : $score,
		);
	}

	/**
	 * La room est-elle entièrement complétée ?
	 *
	 * @param array $tasks Tâches.
	 * @param array $state État.
	 * @return bool
	 */
	private static function room_is_complete( $tasks, $state ) {
		foreach ( $tasks as $index => $task ) {
			$tstate = isset( $state['tasks'][ (string) $index ] ) ? $state['tasks'][ (string) $index ] : array();

			if ( ! Secura_Progress::is_task_done( $task, $tstate ) ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Calcule et enregistre la médaille de room, verse le bonus.
	 *
	 * @param int   $user_id Identifiant de l'utilisateur.
	 * @param int   $room_id Identifiant de la room.
	 * @param array $view    Vue de la room.
	 * @param array $state   État.
	 * @return string
	 */
	private static function update_room_medal( $user_id, $room_id, $view, $state ) {
		$score = Secura_Progress::compute_score( $view['tasks'], $state );
		$medal = Secura_Progress::medal_for( $score['score'], $score['hints'] );

		$was_completed = ! empty( $state['completed'] );

		if ( ! $was_completed ) {
			$bonus = (int) $view['xp_bonus'];

			if ( 0 === $score['hints'] && $bonus > 0 ) {
				$bonus = (int) ceil( $bonus * 1.25 );
			}

			if ( $bonus > 0 ) {
				Secura_Progress::award(
					$user_id,
					array(
						'room_id'    => $room_id,
						'base_xp'    => $bonus,
						'difficulty' => 'facile',
						'type'       => 'test',
					)
				);
			}

			$state['completed']  = true;
			$state['best_score'] = max( isset( $state['best_score'] ) ? absint( $state['best_score'] ) : 0, $score['score'] );
			$state['medal']      = $medal ? $medal : ( isset( $state['medal'] ) ? $state['medal'] : '' );
			Secura_Progress::save_room_state( $user_id, $room_id, $state );
		} elseif ( $score['score'] > ( isset( $state['best_score'] ) ? absint( $state['best_score'] ) : 0 ) ) {
			$state['best_score'] = $score['score'];
			$state['medal']      = $medal ? $medal : ( isset( $state['medal'] ) ? $state['medal'] : '' );
			Secura_Progress::save_room_state( $user_id, $room_id, $state );
		}

		if ( $medal ) {
			Secura_Progress::add_medal( $user_id, 'room_' . $room_id, $medal, $score['score'] );
		}

		self::check_path_completion( $user_id, $room_id );

		return $medal;
	}

	/**
	 * Vérifie si un parcours vient d'être complété.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $room_id Identifiant de la room.
	 */
	private static function check_path_completion( $user_id, $room_id ) {
		foreach ( Secura_Paths::get_paths() as $path ) {
			$contains = false;

			foreach ( Secura_Paths::get_sections( $path->ID ) as $section ) {
				if ( in_array( (int) $room_id, $section['rooms'], true ) ) {
					$contains = true;
					break;
				}
			}

			if ( ! $contains ) {
				continue;
			}

			$progress = Secura_Paths::get_progress( $user_id, $path->ID );

			if ( $progress['total'] > 0 && $progress['done'] === $progress['total'] ) {
				$medal = Secura_Paths::path_medal( $user_id, $path->ID );
				Secura_Progress::add_medal( $user_id, 'path_' . $path->ID, $medal ? $medal : 'silver', 100 );

				$bonus = absint( get_post_meta( $path->ID, SECURA_META_XP_BONUS, true ) );

				if ( $bonus > 0 ) {
					Secura_Progress::award(
						$user_id,
						array(
							'room_id'    => $path->ID,
							'base_xp'    => $bonus,
							'difficulty' => 'facile',
							'type'       => 'test',
						)
					);
				}
			}
		}
	}

	/**
	 * Ouvre un indice : il sera tracé et réduira les points.
	 */
	public static function hint() {
		self::check_request();

		$room_id = isset( $_POST['room_id'] ) ? absint( wp_unslash( $_POST['room_id'] ) ) : 0;
		$index   = isset( $_POST['task'] ) ? intval( wp_unslash( $_POST['task'] ) ) : 0;
		$q_index = isset( $_POST['question'] ) ? intval( wp_unslash( $_POST['question'] ) ) : 0;

		$view = Secura_Rooms::get_room_view( $room_id );

		if ( ! $view || ! isset( $view['tasks'][ $index ]['questions'][ $q_index ] ) ) {
			wp_send_json_error( array( 'message' => Secura_I18n::t( 'question_not_found', '', 'Question introuvable.' ) ), 404 );
		}

		$task = $view['tasks'][ $index ];

		if ( 'exam' === $task['type'] ) {
			wp_send_json_error(
				array(
					'message' => Secura_I18n::t( 'no_hint', '', "Aucun indice n'est disponible pendant un examen." ),
					'code'    => 'no_hint',
				),
				403
			);
		}

		Secura_Progress::mark_hint( get_current_user_id(), $room_id, $index, $q_index );

		wp_send_json_success(
			array(
				'hint' => $view['tasks'][ $index ]['questions'][ $q_index ]['hint'],
			)
		);
	}

	/**
	 * Exécute une commande dans le terminal simulé.
	 */
	public static function terminal() {
		self::check_request();

		$room_id = isset( $_POST['room_id'] ) ? absint( wp_unslash( $_POST['room_id'] ) ) : 0;
		$index   = isset( $_POST['task'] ) ? intval( wp_unslash( $_POST['task'] ) ) : 0;
		$input   = isset( $_POST['command'] ) ? sanitize_text_field( wp_unslash( $_POST['command'] ) ) : '';

		$view = Secura_Rooms::get_room_view( $room_id );

		if ( ! $view || ! isset( $view['tasks'][ $index ] ) ) {
			wp_send_json_error( array( 'message' => Secura_I18n::t( 'task_not_found', '', 'Tâche introuvable.' ) ), 404 );
		}

		$user_id = get_current_user_id();
		$state   = Secura_Progress::get_room_state( $user_id, $room_id );

		if ( ! Secura_Progress::is_task_unlocked( $view['tasks'], $index, $state ) ) {
			wp_send_json_error(
				array(
					'message' => Secura_I18n::t( 'lock_task', '', 'Terminez la tâche précédente pour continuer.' ),
					'code'    => 'locked',
				),
				403
			);
		}

		$result = self::run_terminal( $user_id, $room_id, $index, $view['tasks'][ $index ], $input );

		/* Le scénario bouclé valide la tâche pratique. */
		if ( ! empty( $result['completed'] ) ) {
			Secura_Progress::mark_terminal_done( $user_id, $room_id, $index );
		}

		wp_send_json_success( $result );
	}

	/**
	 * Joue une commande : lab réel si disponible, terminal simulé sinon.
	 *
	 * @param int    $user_id Identifiant de l'utilisateur.
	 * @param int    $room_id Identifiant de la room.
	 * @param int    $index   Index de la tâche.
	 * @param array  $task    Tâche.
	 * @param string $input   Commande.
	 * @return array
	 */
	private static function run_terminal( $user_id, $room_id, $index, $task, $input ) {
		$manifest = Secura_Lab::get_manifest( $room_id );

		if ( $manifest['enabled'] && 'docker' === Secura_Lab::resolve_driver( $room_id ) ) {
			if ( ! self::throttle( 'lab_exec_' . $user_id, 120, 60 ) ) {
				return array(
					'output'    => '',
					'matched'   => false,
					'step'      => 0,
					'total'     => 0,
					'completed' => false,
					'hint'      => '',
					'live'      => true,
					'message'   => Secura_I18n::t( 'slow_down', '', 'Tu vas un peu trop vite : laisse le temps au jeu de souffler.' ),
				);
			}

			$lab = Secura_Lab::exec( $user_id, $room_id, $input );

			Secura_Terminal::push_history( $user_id, $room_id, $index, $input, $lab['output'] );

			/* Sur une vraie machine, la sortie affichee est celle de la
			   machine — mais les etapes du scenario doivent malgre tout
			   avancer, sinon les questions qui exigent une exploration
			   (« termine l'exploration ») resteraient bloquees pour
			   toujours. On fait donc calculer l'etat des etapes, et on
			   garde la vraie sortie. */
			$etapes = Secura_Terminal::run( $user_id, $room_id, $index, $task, $input );

			return array(
				'output'    => $lab['output'],
				'matched'   => (bool) $etapes['matched'],
				'step'      => (int) $etapes['step'],
				'total'     => (int) $etapes['total'],
				'completed' => (bool) $etapes['completed'],
				'hint'      => isset( $etapes['hint'] ) ? $etapes['hint'] : '',
				'live'      => true,
				'message'   => $lab['message'],
				'code'      => (int) $lab['code'],
			);
		}

		return Secura_Terminal::run( $user_id, $room_id, $index, $task, $input );
	}

	/**
	 * Déploie la machine d'une room.
	 */
	public static function lab_start() {
		self::check_request();

		$room_id = isset( $_POST['room_id'] ) ? absint( wp_unslash( $_POST['room_id'] ) ) : 0;
		$view    = Secura_Rooms::get_room_view( $room_id );

		if ( ! $view ) {
			wp_send_json_error( array( 'message' => Secura_I18n::t( 'room_not_found', '', 'Room introuvable.' ) ), 404 );
		}

		$result = Secura_Lab::start( get_current_user_id(), $room_id );

		if ( empty( $result['ok'] ) ) {
			wp_send_json_error( $result, 500 );
		}

		wp_send_json_success( $result );
	}

	/**
	 * Arrête la machine d'une room.
	 */
	public static function lab_stop() {
		self::check_request();

		$room_id = isset( $_POST['room_id'] ) ? absint( wp_unslash( $_POST['room_id'] ) ) : 0;
		$view    = Secura_Rooms::get_room_view( $room_id );

		if ( ! $view ) {
			wp_send_json_error( array( 'message' => Secura_I18n::t( 'room_not_found', '', 'Room introuvable.' ) ), 404 );
		}

		Secura_Lab::stop( get_current_user_id(), $room_id );

		wp_send_json_success( Secura_Lab::status( get_current_user_id(), $room_id ) );
	}

	/**
	 * Statut de la machine d'une room.
	 */
	public static function lab_status() {
		self::check_request();

		$room_id = isset( $_POST['room_id'] ) ? absint( wp_unslash( $_POST['room_id'] ) ) : 0;
		$view    = Secura_Rooms::get_room_view( $room_id );

		if ( ! $view ) {
			wp_send_json_error( array( 'message' => Secura_I18n::t( 'room_not_found', '', 'Room introuvable.' ) ), 404 );
		}

		wp_send_json_success( Secura_Lab::status( get_current_user_id(), $room_id ) );
	}

	/**
	 * Marque une tâche de type leçon comme terminée.
	 */
	public static function complete_lesson() {
		self::check_request();

		$room_id = isset( $_POST['room_id'] ) ? absint( wp_unslash( $_POST['room_id'] ) ) : 0;
		$index   = isset( $_POST['task'] ) ? intval( wp_unslash( $_POST['task'] ) ) : 0;

		$view = Secura_Rooms::get_room_view( $room_id );

		if ( ! $view || ! isset( $view['tasks'][ $index ] ) ) {
			wp_send_json_error( array( 'message' => Secura_I18n::t( 'task_not_found', '', 'Tâche introuvable.' ) ), 404 );
		}

		$user_id = get_current_user_id();
		$state   = Secura_Progress::get_room_state( $user_id, $room_id );

		if ( ! Secura_Progress::is_task_unlocked( $view['tasks'], $index, $state ) ) {
			wp_send_json_error( array( 'message' => Secura_I18n::t( 'lock_task', '', 'Terminez la tâche précédente pour continuer.' ), 'code' => 'locked' ), 403 );
		}

		$key = (string) $index;

		if ( ! isset( $state['tasks'][ $key ] ) ) {
			$state['tasks'][ $key ] = array( 'solved' => array(), 'hints' => array(), 'done' => false );
		}

		$state['tasks'][ $key ]['done'] = true;

		Secura_Progress::save_room_state( $user_id, $room_id, $state );

		wp_send_json_success(
			array(
				'done'     => true,
				'total_xp' => Secura_Progress::get_xp( $user_id ),
			)
		);
	}

	/**
	 * Démarre le chronomètre d'un examen.
	 */
	public static function start_exam() {
		self::check_request();

		$room_id = isset( $_POST['room_id'] ) ? absint( wp_unslash( $_POST['room_id'] ) ) : 0;
		$index   = isset( $_POST['task'] ) ? intval( wp_unslash( $_POST['task'] ) ) : 0;

		$view = Secura_Rooms::get_room_view( $room_id );

		if ( ! $view || ! isset( $view['tasks'][ $index ] ) ) {
			wp_send_json_error( array( 'message' => Secura_I18n::t( 'task_not_found', '', 'Tâche introuvable.' ) ), 404 );
		}

		$force = isset( $_POST['force'] ) && '1' === $_POST['force'];

		$exam = Secura_Progress::start_exam( get_current_user_id(), $room_id, $index, $force );

		wp_send_json_success(
			array(
				'started_at' => absint( $exam['started_at'] ),
				'time_left'  => max( 0, ( (int) $view['tasks'][ $index ]['time_limit'] * 60 ) - ( time() - absint( $exam['started_at'] ) ) ),
			)
		);
	}

	/**
	 * Change la langue de l'utilisateur.
	 */
	public static function set_lang() {
		self::check_request();

		$lang = isset( $_POST['lang'] ) ? sanitize_key( wp_unslash( $_POST['lang'] ) ) : '';

		if ( ! Secura_I18n::set_user_lang( $lang ) ) {
			wp_send_json_error( array( 'message' => Secura_I18n::t( 'lang_unavailable', '', 'Langue non disponible.' ) ), 400 );
		}

		wp_send_json_success( array( 'lang' => $lang ) );
	}
}
