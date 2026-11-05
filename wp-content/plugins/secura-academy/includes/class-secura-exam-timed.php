<?php
/**
 * Examens chronométrés : chaque élève reçoit sa propre copie avec un minuteur.
 *
 * Le problème : sans chronomètre, un élève peut chercher les réponses
 * indéfiniment. La solution tient en trois gestes :
 *
 *  1. LE DÉPART : quand l'élève clique sur « Commencer l'examen », on
 *     enregistre l'heure de début et la durée dans ses métadonnées.
 *
 *  2. LE TIRAge ALÉATOIRE : on pioche N questions dans le réservoir de
 *    la section (niveau), propres à cet élève. Deux élèves n'ont pas
 *    la même copie.
 *
 *  3. L'EXPIRATION : à chaque affichage, on calcule le temps restant.
 *    Quand il atteint zéro, l'examen est verrouillé et les réponses
 *    sont figées (ou soumises automatiquement).
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Moteur d'examen chronométré.
 */
final class Secura_Exam_Timed {

	/**
	 * Méta où sont stockés les examens en cours.
	 * Format : array( room_id => array( started_at, duration, paper ) )
	 */
	const META = 'secura_exam_timed';

	/**
	 * Méta des résultats d'examen finis.
	 * Format : array( room_id => array( score, passed, finished_at, answers ) )
	 */
	const RESULT_META = 'secura_exam_results';

	/**
	 * Nombre de questions par examen par défaut.
	 */
	const DEFAULT_COUNT = 10;

	/**
	 * Durée par défaut en minutes.
	 */
	const DEFAULT_DURATION = 15;

	/**
	 * Démarre un examen chronométré pour un utilisateur sur une room.
	 *
	 * @param int   $user_id      Identifiant de l'utilisateur.
	 * @param int   $room_id      Identifiant de la room.
	 * @param int   $count        Nombre de questions à tirer.
	 * @param int   $duration_min Durée en minutes.
	 * @return array              Résultat avec ok, questions, temps_restant.
	 */
	public static function start( $user_id, $room_id, $count = self::DEFAULT_COUNT, $duration_min = self::DEFAULT_DURATION ) {
		$user_id = absint( $user_id );
		$room_id = absint( $room_id );
		$count   = absint( $count );
		$duration_min = absint( $duration_min );

		if ( ! $user_id || ! $room_id ) {
			return array( 'ok' => false, 'message' => 'Paramètres invalides.' );
		}

		// Vérifier que la room a un lab/examen configuré
		$manifest = Secura_Lab::get_manifest( $room_id );
		if ( ! $manifest['enabled'] ) {
			return array( 'ok' => false, 'message' => 'Cette room n\'a pas d\'examen configuré.' );
		}

		// Tirage des questions depuis le réservoir
		$pool = Secura_Exam::pool( $room_id, array( 'exam', 'test', 'practice' ) );

		if ( count( $pool ) < $count ) {
			$count = count( $pool ); // On prend tout ce qui est disponible
		}

		if ( $count === 0 ) {
			return array( 'ok' => false, 'message' => 'Aucune question disponible pour cet examen.' );
		}

		// Mélanger et piocher sans remise
		shuffle( $pool );
		$selected = array_slice( $pool, 0, $count );

		// Construire le papier d'examen (questions mélangées, propositions mélangées)
		$paper = array();
		foreach ( $selected as $entry ) {
			$q = $entry['question'];
			$q_copy = $q;

			// Mélanger les choix si c'est un QCM
			if ( ! empty( $q_copy['choices'] ) && is_array( $q_copy['choices'] ) ) {
				$choices = $q_copy['choices'];
				$correct_index = isset( $q_copy['correct'] ) ? (int) $q_copy['correct'] : 0;
				$correct_answer = $choices[ $correct_index ];

				shuffle( $choices );
				$new_correct = array_search( $correct_answer, $choices, true );

				$q_copy['choices'] = $choices;
				$q_copy['correct'] = $new_correct;
				$q_copy['_original_correct'] = $correct_index; // Pour la correction
			}

			$paper[] = array(
				'id'    => md5( $entry['room'] . '|' . $entry['task'] . '|' . $entry['q'] . '|' . $user_id ),
				'room'  => $entry['room'],
				'task'  => $entry['task'],
				'q'     => $entry['q'],
				'data'  => $q_copy,
			);
		}

		// Enregistrer le départ de l'examen
		$exams = get_user_meta( $user_id, self::META, true );
		if ( ! is_array( $exams ) ) {
			$exams = array();
		}

		$exams[ (string) $room_id ] = array(
			'started_at'    => time(),
			'duration_min'  => $duration_min,
			'paper'         => $paper,
			'answers'       => array(),
			'finished'      => false,
		);

		update_user_meta( $user_id, self::META, $exams );

		return array(
			'ok'               => true,
			'room_id'          => $room_id,
			'questions'        => $paper,
			'time_remaining'   => $duration_min * 60,
			'duration_min'     => $duration_min,
			'message'          => 'Examen démarré. Bonne chance.',
		);
	}

	/**
	 * Récupère le temps restant en secondes pour un examen en cours.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $room_id Identifiant de la room.
	 * @return int Secondes restantes (0 si expiré ou inexistant).
	 */
	public static function time_remaining( $user_id, $room_id ) {
		$user_id = absint( $user_id );
		$room_id = absint( $room_id );

		$exams = get_user_meta( $user_id, self::META, true );
		if ( ! is_array( $exams ) || ! isset( $exams[ (string) $room_id ] ) ) {
			return 0;
		}

		$exam = $exams[ (string) $room_id ];

		if ( ! empty( $exam['finished'] ) ) {
			return 0;
		}

		$elapsed = time() - (int) $exam['started_at'];
		$remaining = (int) $exam['duration_min'] * 60 - $elapsed;

		return max( 0, $remaining );
	}

	/**
	 * Vérifie si un examen est expiré.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $room_id Identifiant de la room.
	 * @return bool Vrai si expiré.
	 */
	public static function is_expired( $user_id, $room_id ) {
		return self::time_remaining( $user_id, $room_id ) <= 0;
	}

	/**
	 * Récupère le papier d'examen en cours (questions sans les réponses correctes).
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $room_id Identifiant de la room.
	 * @return array Papier d'examen ou array vide.
	 */
	public static function get_paper( $user_id, $room_id ) {
		$user_id = absint( $user_id );
		$room_id = absint( $room_id );

		$exams = get_user_meta( $user_id, self::META, true );
		if ( ! is_array( $exams ) || ! isset( $exams[ (string) $room_id ] ) ) {
			return array();
		}

		$exam = $exams[ (string) $room_id ];

		if ( empty( $exam['paper'] ) ) {
			return array();
		}

		// Retourner les questions sans les indices de correction
		$public_paper = array();
		foreach ( $exam['paper'] as $q ) {
			$public = $q['data'];
			unset( $public['_original_correct'] );
			$public_paper[] = array(
				'id'    => $q['id'],
				'data'  => $public,
			);
		}

		return $public_paper;
	}

	/**
	 * Enregistre une réponse pour une question de l'examen en cours.
	 *
	 * @param int    $user_id Identifiant de l'utilisateur.
	 * @param int    $room_id Identifiant de la room.
	 * @param string $q_id    Identifiant de la question (md5).
	 * @param mixed  $answer  Réponse de l'élève.
	 * @return array          Résultat.
	 */
	public static function answer( $user_id, $room_id, $q_id, $answer ) {
		$user_id = absint( $user_id );
		$room_id = absint( $room_id );

		$exams = get_user_meta( $user_id, self::META, true );
		if ( ! is_array( $exams ) || ! isset( $exams[ (string) $room_id ] ) ) {
			return array( 'ok' => false, 'message' => 'Aucun examen en cours.' );
		}

		$exam = &$exams[ (string) $room_id ];

		if ( ! empty( $exam['finished'] ) ) {
			return array( 'ok' => false, 'message' => 'L\'examen est déjà terminé.' );
		}

		if ( self::is_expired( $user_id, $room_id ) ) {
			$exam['finished'] = true;
			update_user_meta( $user_id, self::META, $exams );
			return array( 'ok' => false, 'message' => 'Temps écoulé. L\'examen a été verrouillé.' );
		}

		$exam['answers'][ $q_id ] = array(
			'answer' => $answer,
			'at'     => time(),
		);

		update_user_meta( $user_id, self::META, $exams );

		return array( 'ok' => true, 'time_remaining' => self::time_remaining( $user_id, $room_id ) );
	}

	/**
	 * Soumet l'examen et calcule le score.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $room_id Identifiant de la room.
	 * @return array Résultat avec score, total, passé, temps_restant.
	 */
	public static function submit( $user_id, $room_id ) {
		$user_id = absint( $user_id );
		$room_id = absint( $room_id );

		$exams = get_user_meta( $user_id, self::META, true );
		if ( ! is_array( $exams ) || ! isset( $exams[ (string) $room_id ] ) ) {
			return array( 'ok' => false, 'message' => 'Aucun examen en cours.' );
		}

		$exam = $exams[ (string) $room_id ];

		if ( empty( $exam['finished'] ) ) {
			$exam['finished'] = true;
		}

		$paper = $exam['paper'];
		$answers = $exam['answers'];

		$score = 0;
		$total = count( $paper );
		$details = array();

		foreach ( $paper as $q ) {
			$q_id = $q['id'];
			$q_data = $q['data'];
			$correct = isset( $q_data['correct'] ) ? (int) $q_data['correct'] : null;
			$user_answer = isset( $answers[ $q_id ]['answer'] ) ? $answers[ $q_id ]['answer'] : null;

			$is_correct = false;

			if ( 'choice' === $q_data['mode'] && is_int( $user_answer ) ) {
				$is_correct = ( $user_answer === $correct );
			} elseif ( 'text' === $q_data['mode'] ) {
				// Pour les questions texte, on compare normalisées (lowercase, trim)
				$user_norm = strtolower( trim( (string) $user_answer ) );
				$expected  = strtolower( trim( (string) ( $q_data['answer'] ?? $q_data['correct_answer'] ?? '' ) ) );
				$is_correct = ( '' !== $expected && $user_norm === $expected );
			}

			if ( $is_correct ) {
				$score++;
			}

			$details[] = array(
				'id'          => $q_id,
				'question'    => $q_data['question'] ?? '',
				'user_answer' => $user_answer,
				'correct'     => $is_correct,
				'explanation' => $q_data['explanation'] ?? '',
			);
		}

		$passed = $total > 0 && ( $score / $total ) >= 0.6; // Seuil de réussite : 60%

		// Sauvegarder le résultat
		$results = get_user_meta( $user_id, self::RESULT_META, true );
		if ( ! is_array( $results ) ) {
			$results = array();
		}

		$results[ (string) $room_id ] = array(
			'score'       => $score,
			'total'       => $total,
			'percentage'  => $total > 0 ? round( ( $score / $total ) * 100 ) : 0,
			'passed'      => $passed,
			'finished_at' => time(),
			'details'     => $details,
		);

		update_user_meta( $user_id, self::RESULT_META, $results );

		// Marquer l'examen comme terminé
		$exam['finished'] = true;
		update_user_meta( $user_id, self::META, $exams );

		return array(
			'ok'             => true,
			'score'          => $score,
			'total'          => $total,
			'percentage'     => $total > 0 ? round( ( $score / $total ) * 100 ) : 0,
			'passed'         => $passed,
			'time_remaining' => self::time_remaining( $user_id, $room_id ),
			'details'        => $details,
		);
	}

	/**
	 * Vérifie si un utilisateur a réussi l'examen d'une room.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $room_id Identifiant de la room.
	 * @return array|null Résultat ou null si jamais passé.
	 */
	public static function get_result( $user_id, $room_id ) {
		$user_id = absint( $user_id );
		$room_id = absint( $room_id );

		$results = get_user_meta( $user_id, self::RESULT_META, true );
		if ( ! is_array( $results ) || ! isset( $results[ (string) $room_id ] ) ) {
			return null;
		}

		return $results[ (string) $room_id ];
	}

	/**
	 * Supprime un examen en cours (pour recommencer).
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $room_id Identifiant de la room.
	 * @return bool
	 */
	public static function abandon( $user_id, $room_id ) {
		$user_id = absint( $user_id );
		$room_id = absint( $room_id );

		$exams = get_user_meta( $user_id, self::META, true );
		if ( ! is_array( $exams ) ) {
			return true;
		}

		unset( $exams[ (string) $room_id ] );
		update_user_meta( $user_id, self::META, $exams );

		return true;
	}

	/**
	 * Nombre de questions disponibles dans le réservoir pour une room.
	 *
	 * @param int $room_id Identifiant de la room.
	 * @return int
	 */
	public static function available_count( $room_id ) {
		$pool = Secura_Exam::pool( $room_id, array( 'exam', 'test', 'practice' ) );
		return count( $pool );
	}
}
