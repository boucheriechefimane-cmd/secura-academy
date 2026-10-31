<?php
/**
 * Endpoints AJAX : chargement d'une room et validation d'une réponse.
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
	 */
	public static function init() {
		add_action( 'wp_ajax_secura_get_room', array( __CLASS__, 'get_room' ) );
		add_action( 'wp_ajax_secura_validate_answer', array( __CLASS__, 'validate_answer' ) );
	}

	/**
	 * Vérifie le nonce et l'authentification.
	 *
	 * @return bool
	 */
	private static function check_request() {
		$nonce = isset( $_REQUEST['nonce'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ) : '';

		if ( ! wp_verify_nonce( $nonce, 'secura_academy' ) ) {
			wp_send_json_error(
				array(
					'message' => __( 'Session expirée. Rechargez la page pour continuer.', 'seca-academy' ),
					'code'    => 'invalid_nonce',
				),
				403
			);
		}

		if ( ! is_user_logged_in() ) {
			wp_send_json_error(
				array(
					'message' => __( 'Connectez-vous pour valider vos réponses.', 'seca-academy' ),
					'code'    => 'not_logged_in',
				),
				401
			);
		}

		return true;
	}

	/**
	 * Charge une room et ses étapes (jamais les réponses).
	 */
	public static function get_room() {
		self::check_request();

		$room_id = isset( $_POST['room_id'] ) ? absint( wp_unslash( $_POST['room_id'] ) ) : 0;
		$room    = $room_id ? get_post( $room_id ) : null;

		if ( ! $room || SECURA_POST_TYPE !== $room->post_type || 'publish' !== $room->post_status ) {
			wp_send_json_error(
				array(
					'message' => __( 'Room introuvable.', 'seca-academy' ),
					'code'    => 'not_found',
				),
				404
			);
		}

		$questions = Secura_Rooms::get_questions( $room_id );
		$progress  = Secura_Progress::get_room_progress( get_current_user_id(), $room_id );
		$steps     = array();

		foreach ( $questions as $index => $question ) {
			$steps[] = array(
				'index'    => $index,
				'question' => $question['question'],
				'hint'     => $question['hint'],
				'xp'       => $question['xp'],
				'solved'   => in_array( $index, $progress['solved'], true ),
			);
		}

		wp_send_json_success(
			array(
				'roomId'     => $room_id,
				'title'      => get_the_title( $room ),
				'excerpt'    => $room->post_excerpt,
				'content'    => wpautop( wp_kses_post( $room->post_content ) ),
				'difficulty' => Secura_Rooms::get_difficulty( $room_id ),
				'duration'   => absint( get_post_meta( $room_id, SECURA_META_DURATION, true ) ),
				'xpBonus'    => absint( get_post_meta( $room_id, SECURA_META_XP_BONUS, true ) ),
				'steps'      => $steps,
			)
		);
	}

	/**
	 * Valide une réponse et attribue la progression.
	 */
	public static function validate_answer() {
		self::check_request();

		$room_id = isset( $_POST['room_id'] ) ? absint( wp_unslash( $_POST['room_id'] ) ) : 0;
		$index   = isset( $_POST['question'] ) ? intval( wp_unslash( $_POST['question'] ) ) : -1;
		$answer  = isset( $_POST['answer'] ) ? sanitize_textarea_field( wp_unslash( $_POST['answer'] ) ) : '';

		$room = $room_id ? get_post( $room_id ) : null;

		if ( ! $room || SECURA_POST_TYPE !== $room->post_type || 'publish' !== $room->post_status ) {
			wp_send_json_error(
				array(
					'message' => __( 'Room introuvable.', 'seca-academy' ),
					'code'    => 'not_found',
				),
				404
			);
		}

		if ( $index < 0 ) {
			wp_send_json_error(
				array(
					'message' => __( 'Étape invalide.', 'seca-academy' ),
					'code'    => 'invalid_step',
				),
				400
			);
		}

		$questions = Secura_Rooms::get_questions( $room_id );

		if ( ! isset( $questions[ $index ] ) ) {
			wp_send_json_error(
				array(
					'message' => __( 'Étape invalide.', 'seca-academy' ),
					'code'    => 'invalid_step',
				),
				400
			);
		}

		$user_id = get_current_user_id();
		$before  = Secura_Progress::get_state( $user_id );
		$correct = Secura_Progress::answer_matches( $answer, $questions[ $index ]['answers'] );

		if ( ! $correct ) {
			wp_send_json_success(
				array(
					'correct'   => false,
					'message'   => __( 'Réponse incorrecte. Relisez l\'énoncé et réessayez.', 'seca-academy' ),
					'total_xp'  => $before['xp'],
				)
			);
		}

		$award = Secura_Progress::award_question( $user_id, $room_id, $index, $questions[ $index ]['xp'] );

		/* Premier trophée de la carrière. */
		Secura_Progress::add_trophy(
			$user_id,
			'first_key',
			__( 'Première clé', 'seca-academy' ),
			__( 'Valider une première réponse correcte.', 'seca-academy' ),
			'🔑'
		);

		/* Fin de room : bonus et trophée dédié. */
		$completion = Secura_Progress::complete_room( $user_id, $room_id );

		if ( $completion['completed'] && ! $completion['already'] ) {
			Secura_Progress::add_trophy(
				$user_id,
				'room_' . $room_id,
				__( 'Maître de la room', 'seca-academy' ),
				sprintf(
					/* translators: %s : titre de la room. */
					__( 'Compléter « %s ».', 'seca-academy' ),
					get_the_title( $room )
				),
				'🏆'
			);
		}

		$after = Secura_Progress::get_state( $user_id );
		$new_trophies = array_values( array_diff_key( $after['trophies'], $before['trophies'] ) );

		$message = $award['already']
			? __( 'Bonne réponse, déjà validée. Aucun XP supplémentaire.', 'seca-academy' )
			: sprintf(
				/* translators: %d : XP gagnés. */
				__( 'Bonne réponse ! +%d XP', 'seca-academy' ),
				$award['awarded']
			);

		if ( $completion['completed'] && ! $completion['already'] && $completion['xp'] > 0 ) {
			$message .= sprintf(
				' ' . __( 'Room complétée : +%d XP de bonus.', 'seca-academy' ),
				$completion['xp']
			);
		}

		wp_send_json_success(
			array(
				'correct'      => true,
				'already'      => $award['already'],
				'message'      => $message,
				'xp_awarded'   => $award['awarded'] + $completion['xp'],
				'total_xp'     => $after['xp'],
				'room_completed' => ! empty( $completion['completed'] ),
				'new_trophies' => $new_trophies,
			)
		);
	}
}
