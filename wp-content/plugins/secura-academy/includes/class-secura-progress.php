<?php
/**
 * Progression, XP et trophées d'un apprenant.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Gère l'état d'apprentissage stocké en user_meta.
 */
final class Secura_Progress {

	/**
	 * Branche les hooks.
	 */
	public static function init() {
		// Aucun hook : l'état est manipulated par Secura_Ajax et le tableau de bord.
	}

	/**
	 * Paliers de niveau.
	 *
	 * @return array
	 */
	public static function levels() {
		return array(
			array(
				'number' => 1,
				'label'  => __( 'Débutant', 'seca-academy' ),
				'min'    => 0,
				'max'    => 99,
			),
			array(
				'number' => 2,
				'label'  => __( 'Apprenti', 'seca-academy' ),
				'min'    => 100,
				'max'    => 249,
			),
			array(
				'number' => 3,
				'label'  => __( 'Défenseur junior', 'seca-academy' ),
				'min'    => 250,
				'max'    => 499,
			),
			array(
				'number' => 4,
				'label'  => __( 'Analyste', 'seca-academy' ),
				'min'    => 500,
				'max'    => 899,
			),
			array(
				'number' => 5,
				'label'  => __( 'Expert', 'seca-academy' ),
				'min'    => 900,
				'max'    => 1499,
			),
			array(
				'number' => 6,
				'label'  => __( 'Red team', 'seca-academy' ),
				'min'    => 1500,
				'max'    => null,
			),
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

		foreach ( self::levels() as $level ) {
			if ( null === $level['max'] || ( $xp >= $level['min'] && $xp <= $level['max'] ) ) {
				return $level;
			}
		}

		$levels = self::levels();

		return end( $levels );
	}

	/**
	 * État complet d'un utilisateur.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @return array
	 */
	public static function get_state( $user_id ) {
		$user_id = absint( $user_id );

		$xp       = absint( get_user_meta( $user_id, SECURA_USER_XP, true ) );
		$progress = get_user_meta( $user_id, SECURA_USER_PROGRESS, true );
		$trophies = get_user_meta( $user_id, SECURA_USER_TROPHIES, true );

		if ( ! is_array( $progress ) ) {
			$progress = array();
		}

		if ( ! is_array( $trophies ) ) {
			$trophies = array();
		}

		return array(
			'xp'       => $xp,
			'progress' => $progress,
			'trophies' => array_values( $trophies ),
		);
	}

	/**
	 * Progression d'une room pour un utilisateur.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $room_id Identifiant de la room.
	 * @return array
	 */
	public static function get_room_progress( $user_id, $room_id ) {
		$state = self::get_state( $user_id );
		$key   = (string) absint( $room_id );

		if ( ! isset( $state['progress'][ $key ] ) ) {
			return array(
				'solved'    => array(),
				'completed' => false,
				'xp'        => 0,
			);
		}

		$room = $state['progress'][ $key ];
		$solved = array();

		if ( isset( $room['solved'] ) && is_array( $room['solved'] ) ) {
			$solved = array_map( 'intval', array_keys( $room['solved'] ) );
			sort( $solved );
		}

		return array(
			'solved'    => $solved,
			'completed' => ! empty( $room['completed'] ),
			'xp'        => isset( $room['xp'] ) ? absint( $room['xp'] ) : 0,
		);
	}

	/**
	 * Attribue l'XP d'une question, une seule fois par question et par utilisateur.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $room_id Identifiant de la room.
	 * @param int $index  Index de la question.
	 * @param int $xp     XP à attribuer.
	 * @return array{awarded:int,already:bool,total_xp:int}
	 */
	public static function award_question( $user_id, $room_id, $index, $xp ) {
		$state    = self::get_state( $user_id );
		$progress = $state['progress'];
		$key      = (string) absint( $room_id );
		$index    = absint( $index );
		$xp       = absint( $xp );

		if ( ! isset( $progress[ $key ] ) || ! is_array( $progress[ $key ] ) ) {
			$progress[ $key ] = array(
				'solved'    => array(),
				'completed' => false,
				'xp'        => 0,
			);
		}

		if ( ! isset( $progress[ $key ]['solved'] ) || ! is_array( $progress[ $key ]['solved'] ) ) {
			$progress[ $key ]['solved'] = array();
		}

		if ( isset( $progress[ $key ]['solved'][ $index ] ) ) {
			return array(
				'awarded'  => 0,
				'already'  => true,
				'total_xp' => $state['xp'],
			);
		}

		$progress[ $key ]['solved'][ $index ] = true;
		$progress[ $key ]['xp']              = absint( $progress[ $key ]['xp'] ) + $xp;
		$total_xp                            = $state['xp'] + $xp;

		update_user_meta( $user_id, SECURA_USER_XP, $total_xp );
		update_user_meta( $user_id, SECURA_USER_PROGRESS, $progress );

		return array(
			'awarded'  => $xp,
			'already'  => false,
			'total_xp' => $total_xp,
		);
	}

	/**
	 * Marque une room comme complétée si toutes les questions sont résolues.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $room_id Identifiant de la room.
	 * @return array{completed:bool,xp:int,already:bool}
	 */
	public static function complete_room( $user_id, $room_id ) {
		$state    = self::get_state( $user_id );
		$key      = (string) absint( $room_id );
		$progress = $state['progress'];

		if ( ! isset( $progress[ $key ] ) || ! is_array( $progress[ $key ] ) ) {
			return array(
				'completed' => false,
				'xp'        => 0,
				'already'   => false,
			);
		}

		if ( ! empty( $progress[ $key ]['completed'] ) ) {
			return array(
				'completed' => true,
				'xp'        => 0,
				'already'   => true,
			);
		}

		$questions = Secura_Rooms::get_questions( $room_id );
		$solved    = isset( $progress[ $key ]['solved'] ) ? $progress[ $key ]['solved'] : array();
		$total     = count( $questions );

		if ( 0 === $total ) {
			return array(
				'completed' => false,
				'xp'        => 0,
				'already'   => false,
			);
		}

		foreach ( array_keys( $questions ) as $index ) {
			if ( ! isset( $solved[ $index ] ) ) {
				return array(
					'completed' => false,
					'xp'        => 0,
					'already'   => false,
				);
			}
		}

		$bonus = absint( get_post_meta( $room_id, SECURA_META_XP_BONUS, true ) );
		$total_xp = $state['xp'] + $bonus;

		$progress[ $key ]['completed'] = true;

		update_user_meta( $user_id, SECURA_USER_XP, $total_xp );
		update_user_meta( $user_id, SECURA_USER_PROGRESS, $progress );

		return array(
			'completed' => true,
			'xp'        => $bonus,
			'already'   => false,
		);
	}

	/**
	 * Ajoute un trophée s'il n'a pas déjà été obtenu.
	 *
	 * @param int    $user_id     Identifiant de l'utilisateur.
	 * @param string $slug        Identifiant du trophée.
	 * @param string $name        Nom affiché.
	 * @param string $description Description courte.
	 * @param string $icon        Icône (caractère).
	 * @return array{added:bool,trophies:array}
	 */
	public static function add_trophy( $user_id, $slug, $name, $description, $icon ) {
		$trophies = get_user_meta( $user_id, SECURA_USER_TROPHIES, true );

		if ( ! is_array( $trophies ) ) {
			$trophies = array();
		}

		foreach ( $trophies as $trophy ) {
			if ( isset( $trophy['slug'] ) && $trophy['slug'] === $slug ) {
				return array(
					'added'    => false,
					'trophies' => array_values( $trophies ),
				);
			}
		}

		$trophies[] = array(
			'slug'        => sanitize_key( $slug ),
			'name'        => sanitize_text_field( $name ),
			'description' => sanitize_text_field( $description ),
			'icon'        => sanitize_text_field( $icon ),
			'date'        => current_time( 'mysql' ),
		);

		update_user_meta( $user_id, SECURA_USER_TROPHIES, array_values( $trophies ) );

		return array(
			'added'    => true,
			'trophies' => array_values( $trophies ),
		);
	}

	/**
	 * Normalise une réponse pour comparer sans tenir compte de la casse,
	 * des accents, des espaces multiples ou de la ponctuation finale.
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
