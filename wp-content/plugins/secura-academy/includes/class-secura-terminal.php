<?php
/**
 * Terminal simulé : le côté « jeu » des rooms.
 *
 * Aucune commande n'est réellement exécutée. Le contenu est un scénario
 * scripté, évalué côté serveur : l'apprenant explore, découvre un flag,
 * puis répond aux questions liées à ce qu'il a trouvé.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Simulateur de terminal.
 */
final class Secura_Terminal {

	/**
	 * Branche les hooks.
	 */
	public static function init() {
		// Aucune attache : le simulateur est appelé par les endpoints AJAX.
	}

	/**
	 * Clé de stockage de l'état d'un terminal.
	 *
	 * @param int $room_id Identifiant de la room.
	 * @param int $index   Index de la tâche.
	 * @return string
	 */
	public static function key( $room_id, $index ) {
		return absint( $room_id ) . ':' . absint( $index );
	}

	/**
	 * État courant d'un terminal.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $room_id Identifiant de la room.
	 * @param int $index   Index de la tâche.
	 * @return array
	 */
	public static function get_state( $user_id, $room_id, $index ) {
		$states = get_user_meta( $user_id, SECURA_USER_TERMINALS, true );
		$states = is_array( $states ) ? $states : array();
		$key    = self::key( $room_id, $index );

		if ( ! isset( $states[ $key ] ) || ! is_array( $states[ $key ] ) ) {
			return array(
				'step'    => 0,
				'history' => array(),
			);
		}

		return $states[ $key ];
	}

	/**
	 * Sauvegarde l'état d'un terminal.
	 *
	 * @param int   $user_id Identifiant de l'utilisateur.
	 * @param int   $room_id Identifiant de la room.
	 * @param int   $index   Index de la tâche.
	 * @param array $state   État.
	 */
	public static function save_state( $user_id, $room_id, $index, $state ) {
		$states = get_user_meta( $user_id, SECURA_USER_TERMINALS, true );
		$states = is_array( $states ) ? $states : array();

		$states[ self::key( $room_id, $index ) ] = $state;

		update_user_meta( $user_id, SECURA_USER_TERMINALS, $states );
	}

	/**
	 * Ajoute une entrée à l'historique du terminal.
	 *
	 * Utilisé par le lab réel : la sortie vient du conteneur, pas d'un scénario.
	 *
	 * @param int    $user_id Identifiant de l'utilisateur.
	 * @param int    $room_id Identifiant de la room.
	 * @param int    $index   Index de la tâche.
	 * @param string $command Commande jouée.
	 * @param string $output  Sortie obtenue.
	 */
	public static function push_history( $user_id, $room_id, $index, $command, $output ) {
		$state = self::get_state( $user_id, $room_id, $index );

		$state['history'][] = array(
			'cmd' => (string) $command,
			'out' => (string) $output,
		);

		if ( count( $state['history'] ) > 40 ) {
			$state['history'] = array_slice( $state['history'], -40 );
		}

		self::save_state( $user_id, $room_id, $index, $state );
	}

	/**
	 * Exécute une commande dans le terminal simulé.
	 *
	 * @param int    $user_id Identifiant de l'utilisateur.
	 * @param int    $room_id Identifiant de la room.
	 * @param int    $index   Index de la tâche.
	 * @param array  $task    Tâche (contient la définition du terminal).
	 * @param string $input   Commande saisie.
	 * @return array
	 */
	public static function run( $user_id, $room_id, $index, $task, $input ) {
		$definition = isset( $task['terminal'] ) && is_array( $task['terminal'] ) ? $task['terminal'] : array();

		if ( empty( $definition['steps'] ) || ! is_array( $definition['steps'] ) ) {
			return array(
				'output'    => '',
				'matched'   => false,
				'step'      => 0,
				'total'     => 0,
				'completed' => false,
				'hint'      => '',
			);
		}

		$input = trim( wp_strip_all_tags( (string) $input ) );

		if ( '' === $input ) {
			return array(
				'output'    => '',
				'matched'   => false,
				'step'      => self::get_state( $user_id, $room_id, $index )['step'],
				'total'     => count( $definition['steps'] ),
				'completed' => false,
				'hint'      => '',
			);
		}

		$state = self::get_state( $user_id, $room_id, $index );
		$steps = $definition['steps'];
		$step  = isset( $state['step'] ) ? absint( $state['step'] ) : 0;

		if ( $step >= count( $steps ) ) {
			return array(
				'output'    => isset( $definition['success'] ) ? $definition['success'] : '',
				'matched'   => true,
				'step'      => $step,
				'total'     => count( $steps ),
				'completed' => true,
				'hint'      => '',
			);
		}

		$current  = $steps[ $step ];
		$patterns = isset( $current['match'] ) ? (array) $current['match'] : array();
		$matched  = false;

		foreach ( $patterns as $pattern ) {
			if ( self::matches( $pattern, $input ) ) {
				$matched = true;
				break;
			}
		}

		if ( $matched ) {
			$output = isset( $current['output'] ) ? $current['output'] : '';
			$state['step'] = $step + 1;
		} else {
			/* L'eleve a tape une commande qui correspond a une AUTRE
			   etape du scenario. Le scenario n'est pas un ordre impose :
			   enqueter dans un autre ordre est legitimement ce qu'on
			   apprend. On cherche donc dans les etapes restantes, et on
			   marque celle qui correspond comme faite.
			   Sans cela, un eleve qui tape « cat app.conf » avant
			   « curl status.php » recevait « commande introuvable » :
			   le terminal lui mentait sur ce que la machine contient. */
			$trouve = -1;

			for ( $i = $step + 1; $i < count( $steps ); $i++ ) {
				$candidats = isset( $steps[ $i ]['match'] ) ? (array) $steps[ $i ]['match'] : array();

				foreach ( $candidats as $pattern ) {
					if ( self::matches( $pattern, $input ) ) {
						$trouve = $i;
						break 2;
					}
				}
			}

			if ( $trouve > -1 ) {
				$output = isset( $steps[ $trouve ]['output'] ) ? $steps[ $trouve ]['output'] : '';
				$state['step'] = max( $step, $trouve + 1 );
				$matched = true;
			} else {
				$output = self::reponse_honnete( $definition, $input, $state );
			}
		}

		$state['history'][] = array(
			'cmd' => $input,
			'out' => $output,
		);

		if ( count( $state['history'] ) > 40 ) {
			$state['history'] = array_slice( $state['history'], -40 );
		}

		self::save_state( $user_id, $room_id, $index, $state );

		return array(
			'output'    => $output,
			'matched'   => $matched,
			'step'      => $state['step'],
			'total'     => count( $steps ),
			'completed' => $state['step'] >= count( $steps ),
			'hint'      => $matched ? '' : ( isset( $current['hint'] ) ? $current['hint'] : '' ),
		);
	}

	/**
	 * Que répondre quand la commande ne correspond à aucune étape ?
	 *
	 * Deux mensonges à éviter :
	 *   - « commande introuvable » pour une commande qui existe (`ls`,
	 *     `cat`, `grep`...) : l'élève apprend un faux fait sur la machine ;
	 *   - une réponse vide, qui laisse croire que le terminal est cassé.
	 *
	 * On répond donc deux choses : ce que cet atelier accepte (extrait des
	 * motifs littéraux du scénario), et une piste. L'élève sait où il est.
	 *
	 * @param array  $definition Définition du terminal.
	 * @param string $input      Commande saisie.
	 * @param array  $state      État courant.
	 * @return string
	 */
	private static function reponse_honnete( $definition, $input, $state ) {
		$etapes = isset( $definition['steps'] ) ? (array) $definition['steps'] : array();
		$step   = isset( $state['step'] ) ? absint( $state['step'] ) : 0;
		$utiles = array();

		foreach ( $etapes as $etape ) {
			foreach ( (array) ( isset( $etape['match'] ) ? $etape['match'] : array() ) as $motif ) {
				$motif = trim( (string) $motif );

				if ( '' === $motif || '/' === substr( $motif, 0, 1 ) ) {
					continue;
				}

				$utiles[] = $motif;
			}
		}

		/* Une commande qui EXISTE sur la machine ne doit jamais etre
		   declaree introuvable. `ls`, `cat`, `grep` existent : ce qui est
		   vrai, c'est qu'elles ne font pas avancer CET atelier. La
		   difference n'est pas rhetorique : un eleve qui lit « introuvable »
		   croit que la machine n'a pas `ls`, et il n'essaiera plus. */
		$binaires = array( 'ls', 'cat', 'cd', 'pwd', 'grep', 'head', 'tail', 'wc', 'find', 'file', 'stat', 'strings', 'curl', 'wget', 'python3', 'nc', 'ssh', 'sudo', 'chmod', 'id', 'whoami', 'ps', 'ss', 'netstat', 'help' );
		$premier  = strtolower( (string) strtok( trim( (string) $input ), ' ' ) );
		$connue   = in_array( $premier, $binaires, true );

		if ( $connue ) {
			$message = sprintf(
				/* translators: %s : nom de la commande. */
				__( '« %s » fonctionne sur cette machine, mais ne fait rien avancer dans cet atelier.', 'seca-academy' ),
				$premier
			);
		} else {
			$message = isset( $definition['unknown'] ) ? (string) $definition['unknown'] : __( 'Cette commande ne donne rien ici.', 'seca-academy' );
		}

		if ( ! empty( $utiles ) ) {
			$message .= "\n\n" . __( 'Commandes utiles dans cet atelier : ', 'seca-academy' ) . implode( ', ', array_unique( $utiles ) );
		}

		$hint = isset( $etapes[ $step ]['hint'] ) ? (string) $etapes[ $step ]['hint'] : '';

		if ( '' !== $hint ) {
			$message .= "\n" . __( 'Piste : ', 'seca-academy' ) . wp_strip_all_tags( $hint );
		}

		return $message;
	}

	/**
	 * Compare une commande à un motif.
	 *
	 * Un motif entre slashes est traité comme une expression régulière ;
	 * sinon c'est une comparaison exacte, insensible à la casse.
	 *
	 * @param string $pattern Motif.
	 * @param string $input   Commande.
	 * @return bool
	 */
	public static function matches( $pattern, $input ) {
		$pattern = trim( (string) $pattern );
		$input   = trim( (string) $input );

		if ( '' === $pattern ) {
			return false;
		}

		$length = strlen( $pattern );

		if ( $length > 2 && '/' === $pattern[0] && '/' === $pattern[ $length - 1 ] ) {
			$regex = substr( $pattern, 1, -1 );

			return (bool) preg_match( '#' . $regex . '#i', $input );
		}

		return 0 === strcasecmp( $pattern, $input );
	}

	/**
	 * Normalise la définition de terminal stockée dans la meta.
	 *
	 * @param mixed $raw Valeur brute.
	 * @return array
	 */
	public static function normalize_definition( $raw ) {
		if ( is_string( $raw ) ) {
			$decoded = json_decode( $raw, true );
			$raw     = is_array( $decoded ) ? $decoded : array();
		}

		if ( ! is_array( $raw ) ) {
			return array();
		}

		$out = array(
			'intro'   => isset( $raw['intro'] ) ? (string) $raw['intro'] : '',
			'unknown' => isset( $raw['unknown'] ) ? (string) $raw['unknown'] : __( 'bash: commande introuvable', 'seca-academy' ),
			'success' => isset( $raw['success'] ) ? (string) $raw['success'] : '',
			'steps'   => array(),
		);

		if ( isset( $raw['steps'] ) && is_array( $raw['steps'] ) ) {
			foreach ( $raw['steps'] as $step ) {
				if ( ! is_array( $step ) ) {
					continue;
				}

				$out['steps'][] = array(
					'match'  => isset( $step['match'] ) ? (array) $step['match'] : array(),
					'output' => isset( $step['output'] ) ? (string) $step['output'] : '',
					'hint'   => isset( $step['hint'] ) ? (string) $step['hint'] : '',
				);
			}
		}

		return $out;
	}
}
