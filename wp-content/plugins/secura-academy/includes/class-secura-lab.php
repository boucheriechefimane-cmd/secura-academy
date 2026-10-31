<?php
/**
 * Lab réel : pilotage de machines cibles isolées.
 *
 * Deux pilotes cohabitent :
 *
 * - `simulated` : le terminal scénarisé historique (aucun Docker requis) ;
 * - `docker`    : une vraie machine, dans un conteneur éphémère, isolated.
 *
 * Le contrat AJAX (`secura_terminal`) ne change pas : le front ne sait pas
 * quel pilote est actif. Si Docker est absent de l'hébergement, le repli est
 * automatique — la plateforme reste utilisable sur mutualisé.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Moteur de lab.
 */
class Secura_Lab {

	const META        = '_secura_lab';
	const STATE_META  = 'secura_labs';
	const MAX_OUTPUT  = 8192;
	const DEFAULT_TTL = 3600;
	const HARD_DENY   = 'docker nsenter mount umount sudo su chroot unshare kubectl crictl nsenter';

	/**
	 * Branche les hooks.
	 */
	public static function init() {
		add_action( 'seca_lab_cleanup', array( __CLASS__, 'cleanup_expired' ) );
	}

	/**
	 * Programme le nettoyage des conteneurs expirés.
	 */
	public static function schedule_cleanup() {
		if ( ! wp_next_scheduled( 'seca_lab_cleanup' ) ) {
			wp_schedule_event( time() + 300, 'hourly', 'seca_lab_cleanup' );
		}
	}

	/* ---------------------------------------------------------------------
	 * Manifeste
	 * ------------------------------------------------------------------ */

	/**
	 * Manifeste normalisé d'une room.
	 *
	 * @param int $room_id Identifiant de la room.
	 * @return array
	 */
	public static function get_manifest( $room_id ) {
		$raw = get_post_meta( $room_id, self::META, true );

		return self::normalize_manifest( is_array( $raw ) ? $raw : array() );
	}

	/**
	 * Normalise un manifeste de lab.
	 *
	 * @param array $raw Manifeste brut.
	 * @return array
	 */
	public static function normalize_manifest( $raw ) {
		$manifest = array(
			'enabled'  => false,
			'driver'   => 'auto',
			'mode'     => 'single',
			'image'    => '',
			'service'  => '',
			'compose'  => '',
			'project'  => '',
			'network'  => 'seca_lab',
			'command'  => 'bash -l',
			'workdir'  => '/home/ctf',
			'target'   => '',
			'ttl'      => self::DEFAULT_TTL,
			'allow'    => array(),
			'deny'     => array(),
			'user'     => '1000:1000',
			'memory'   => '512m',
			'cpus'     => '1',
			'pids'     => 256,
		);

		if ( ! is_array( $raw ) ) {
			return $manifest;
		}

		$manifest['enabled'] = ! empty( $raw['enabled'] );
		$manifest['driver']  = in_array( isset( $raw['driver'] ) ? $raw['driver'] : '', array( 'auto', 'docker', 'simulated' ), true ) ? $raw['driver'] : 'auto';
		$manifest['mode']    = in_array( isset( $raw['mode'] ) ? $raw['mode'] : '', array( 'single', 'compose' ), true ) ? $raw['mode'] : 'single';
		$manifest['image']   = isset( $raw['image'] ) ? trim( (string) $raw['image'] ) : '';
		$manifest['service'] = isset( $raw['service'] ) ? trim( (string) $raw['service'] ) : '';
		$manifest['compose'] = isset( $raw['compose'] ) ? trim( (string) $raw['compose'] ) : '';
		$manifest['project'] = isset( $raw['project'] ) ? trim( (string) $raw['project'] ) : '';
		$manifest['network'] = isset( $raw['network'] ) && '' !== trim( (string) $raw['network'] ) ? trim( (string) $raw['network'] ) : 'seca_lab';
		$manifest['command'] = isset( $raw['command'] ) && '' !== trim( (string) $raw['command'] ) ? trim( (string) $raw['command'] ) : 'bash -l';
		$manifest['workdir'] = isset( $raw['workdir'] ) && '' !== trim( (string) $raw['workdir'] ) ? trim( (string) $raw['workdir'] ) : '/home/ctf';
		$manifest['target']  = isset( $raw['target'] ) ? trim( (string) $raw['target'] ) : '';
		$manifest['ttl']     = isset( $raw['ttl'] ) ? max( 300, absint( $raw['ttl'] ) ) : self::DEFAULT_TTL;
		$manifest['user']    = isset( $raw['user'] ) && '' !== trim( (string) $raw['user'] ) ? trim( (string) $raw['user'] ) : '1000:1000';
		$manifest['memory']  = isset( $raw['memory'] ) && '' !== trim( (string) $raw['memory'] ) ? trim( (string) $raw['memory'] ) : '512m';
		$manifest['cpus']    = isset( $raw['cpus'] ) && '' !== trim( (string) $raw['cpus'] ) ? trim( (string) $raw['cpus'] ) : '1';
		$manifest['pids']    = isset( $raw['pids'] ) ? max( 16, absint( $raw['pids'] ) ) : 256;

		$manifest['allow'] = self::string_list( isset( $raw['allow'] ) ? $raw['allow'] : array() );
		$manifest['deny']  = self::string_list( isset( $raw['deny'] ) ? $raw['deny'] : array() );

		/* Un lab sans image ni compose ne peut pas démarrer : on le désactive. */
		if ( 'single' === $manifest['mode'] && '' === $manifest['image'] ) {
			$manifest['enabled'] = false;
		}

		if ( 'compose' === $manifest['mode'] && ( '' === $manifest['compose'] || '' === $manifest['service'] ) ) {
			$manifest['enabled'] = false;
		}

		return $manifest;
	}

	/**
	 * Transforme une liste (chaîne ou tableau) en tableau de chaînes.
	 *
	 * @param mixed $value Valeur brute.
	 * @return array
	 */
	public static function string_list( $value ) {
		if ( is_string( $value ) ) {
			$value = preg_split( '/[\r\n,]+/', $value );
		}

		if ( ! is_array( $value ) ) {
			return array();
		}

		$out = array();

		foreach ( $value as $item ) {
			$item = trim( (string) $item );

			if ( '' !== $item ) {
				$out[] = $item;
			}
		}

		return array_values( array_unique( $out ) );
	}

	/* ---------------------------------------------------------------------
	 * Pilotes
	 * ------------------------------------------------------------------ */

	/**
	 * Docker est-il utilisable sur cet hébergement ?
	 *
	 * @return bool
	 */
	public static function docker_available() {
		$cached = get_transient( 'seca_docker_available' );

		if ( false !== $cached ) {
			return '1' === (string) $cached;
		}

		$available = '1';

		if ( ! self::can_exec() ) {
			$available = '0';
		} else {
			$result = self::run( array( 'docker', 'info', '--format', '{{.ServerVersion}}' ), 6 );

			if ( 0 !== $result['code'] ) {
				$available = '0';
			}
		}

		set_transient( 'seca_docker_available', $available, 300 );

		return '1' === $available;
	}

	/**
	 * Le moteur peut-il exécuter des commandes externes ?
	 *
	 * @return bool
	 */
	public static function can_exec() {
		if ( ! function_exists( 'proc_open' ) ) {
			return false;
		}

		$disabled = array_map( 'trim', explode( ',', (string) ini_get( 'disable_functions' ) ) );

		return ! in_array( 'proc_open', $disabled, true );
	}

	/**
	 * Pilote effectif pour une room.
	 *
	 * @param int $room_id Identifiant de la room.
	 * @return string `docker` ou `simulated`.
	 */
	public static function resolve_driver( $room_id ) {
		$manifest = self::get_manifest( $room_id );

		if ( ! $manifest['enabled'] ) {
			return 'simulated';
		}

		if ( 'simulated' === $manifest['driver'] ) {
			return 'simulated';
		}

		if ( 'docker' === $manifest['driver'] ) {
			return self::docker_available() ? 'docker' : 'simulated';
		}

		return self::docker_available() ? 'docker' : 'simulated';
	}

	/* ---------------------------------------------------------------------
	 * Cycle de vie
	 * ------------------------------------------------------------------ */

	/**
	 * Nom du conteneur d'un apprenant pour une room.
	 *
	 * @param int $user_id Identifiant de l'apprenant.
	 * @param int $room_id Identifiant de la room.
	 * @return string
	 */
	public static function container_name( $user_id, $room_id ) {
		return 'seca_lab_' . absint( $user_id ) . '_' . absint( $room_id );
	}

	/**
	 * État des labs d'un apprenant.
	 *
	 * @param int $user_id Identifiant de l'apprenant.
	 * @return array
	 */
	public static function get_states( $user_id ) {
		$states = get_user_meta( $user_id, self::STATE_META, true );

		return is_array( $states ) ? $states : array();
	}

	/**
	 * Enregistre l'état d'un lab.
	 *
	 * @param int    $user_id Identifiant de l'apprenant.
	 * @param string $key     Clé de room.
	 * @param array  $state   État.
	 */
	public static function save_state( $user_id, $key, $state ) {
		$states          = self::get_states( $user_id );
		$states[ $key ] = $state;

		update_user_meta( $user_id, self::STATE_META, $states );
	}

	/**
	 * Statut d'un lab pour un apprenant.
	 *
	 * @param int $user_id Identifiant de l'apprenant.
	 * @param int $room_id Identifiant de la room.
	 * @return array
	 */
	public static function status( $user_id, $room_id ) {
		$manifest = self::get_manifest( $room_id );
		$driver   = self::resolve_driver( $room_id );
		$states   = self::get_states( $user_id );
		$key      = (string) absint( $room_id );
		$state    = isset( $states[ $key ] ) && is_array( $states[ $key ] ) ? $states[ $key ] : array();

		$result = array(
			'enabled'   => $manifest['enabled'],
			'driver'    => $driver,
			'state'     => 'idle',
			'target'    => $manifest['target'],
			'ttl'       => (int) $manifest['ttl'],
			'expires_in' => 0,
			'message'   => '',
		);

		if ( ! $manifest['enabled'] ) {
			$result['message'] = __( 'Cette room n\'a pas de machine déployable.', 'seca-academy' );

			return $result;
		}

		if ( 'simulated' === $driver ) {
			$result['state']   = 'simulated';
			$result['message'] = __( 'Terminal simulé : aucun moteur de lab sur cet hébergement.', 'seca-academy' );

			return $result;
		}

		if ( empty( $state['started_at'] ) ) {
			$result['message'] = __( 'Machine à déployer.', 'seca-academy' );

			return $result;
		}

		$elapsed = time() - absint( $state['started_at'] );

		if ( $elapsed > (int) $manifest['ttl'] ) {
			$result['state']   = 'expired';
			$result['message'] = __( 'La machine a expiré : redéploie-la pour continuer.', 'seca-academy' );

			return $result;
		}

		$result['state']      = 'running';
		$result['expires_in'] = max( 0, (int) $manifest['ttl'] - $elapsed );
		$result['message']    = __( 'Machine déployée.', 'seca-academy' );

		return $result;
	}

	/**
	 * Démarre (ou relance) la machine d'un apprenant.
	 *
	 * @param int $user_id Identifiant de l'apprenant.
	 * @param int $room_id Identifiant de la room.
	 * @return array
	 */
	public static function start( $user_id, $room_id ) {
		$manifest = self::get_manifest( $room_id );
		$driver   = self::resolve_driver( $room_id );

		if ( ! $manifest['enabled'] ) {
			return array(
				'ok'      => false,
				'state'   => 'unavailable',
				'message' => __( 'Cette room n\'a pas de machine déployable.', 'seca-academy' ),
			);
		}

		if ( 'simulated' === $driver ) {
			return array(
				'ok'      => true,
				'state'   => 'simulated',
				'message' => __( 'Terminal simulé : aucun moteur de lab sur cet hébergement.', 'seca-academy' ),
			);
		}

		if ( ! self::can_exec() ) {
			return array(
				'ok'      => false,
				'state'   => 'unavailable',
				'message' => __( 'L\'exécution de commandes est désactivée sur cet hébergement.', 'seca-academy' ),
			);
		}

		/* Un redéploiement repart de zéro : on stoppe l'éventuel conteneur. */
		self::stop( $user_id, $room_id );

		if ( 'compose' === $manifest['mode'] ) {
			$result = self::compose_up( $manifest );
		} else {
			$result = self::container_up( $user_id, $room_id, $manifest );
		}

		if ( ! $result['ok'] ) {
			return array(
				'ok'      => false,
				'state'   => 'error',
				'message' => __( 'Le déploiement de la machine a échoué.', 'seca-academy' ),
				'detail'  => $result['output'],
			);
		}

		self::save_state(
			$user_id,
			(string) absint( $room_id ),
			array(
				'started_at' => time(),
				'container'  => self::container_name( $user_id, $room_id ),
				'mode'       => $manifest['mode'],
			)
		);

		return array(
			'ok'      => true,
			'state'   => 'running',
			'target'  => $manifest['target'],
			'message' => __( 'Machine déployée. Bonne chasse.', 'seca-academy' ),
		);
	}

	/**
	 * Arrête la machine d'un apprenant.
	 *
	 * @param int $user_id Identifiant de l'apprenant.
	 * @param int $room_id Identifiant de la room.
	 * @return bool
	 */
	public static function stop( $user_id, $room_id ) {
		$manifest = self::get_manifest( $room_id );

		if ( ! $manifest['enabled'] || ! self::can_exec() ) {
			return false;
		}

		if ( 'compose' === $manifest['mode'] ) {
			self::run( self::compose_command( $manifest, array( 'down', '-v' ) ), 30 );
		} else {
			self::run( array( 'docker', 'rm', '-f', self::container_name( $user_id, $room_id ) ), 20 );
		}

		$states = self::get_states( $user_id );
		unset( $states[ (string) absint( $room_id ) ] );
		update_user_meta( $user_id, self::STATE_META, $states );

		return true;
	}

	/**
	 * Exécute une commande dans la machine de l'apprenant.
	 *
	 * @param int    $user_id Identifiant de l'apprenant.
	 * @param int    $room_id Identifiant de la room.
	 * @param string $command Commande.
	 * @return array
	 */
	public static function exec( $user_id, $room_id, $command ) {
		$command = trim( (string) $command );

		if ( '' === $command ) {
			return array(
				'ok'      => false,
				'output'  => '',
				'code'    => 0,
				'message' => __( 'Commande vide.', 'seca-academy' ),
			);
		}

		$manifest = self::get_manifest( $room_id );
		$status   = self::status( $user_id, $room_id );

		if ( 'docker' !== $status['driver'] ) {
			return array(
				'ok'      => false,
				'output'  => '',
				'code'    => 0,
				'message' => __( 'Aucune machine déployée.', 'seca-academy' ),
			);
		}

		if ( 'running' !== $status['state'] ) {
			return array(
				'ok'      => false,
				'output'  => '',
				'code'    => 0,
				'message' => __( 'Déploie la machine avant de lancer une commande.', 'seca-academy' ),
			);
		}

		if ( ! self::command_allowed( $command, $manifest ) ) {
			return array(
				'ok'      => false,
				'output'  => '',
				'code'    => 126,
				'message' => __( 'Cette commande est bloquée par la politique du lab.', 'seca-academy' ),
			);
		}

		if ( 'compose' === $manifest['mode'] ) {
			$line = self::compose_command(
				$manifest,
				array( 'exec', '-T', '-w', $manifest['workdir'], $manifest['service'], 'bash', '-lc', $command )
			);
		} else {
			$line = array(
				'docker',
				'exec',
				'-i',
				'-w',
				$manifest['workdir'],
				self::container_name( $user_id, $room_id ),
				'bash',
				'-lc',
				$command,
			);
		}

		$result = self::run( $line, 20 );

		$output = self::sanitize_output( $result['output'] );

		return array(
			'ok'      => true,
			'output'  => $output,
			'code'    => (int) $result['code'],
			'message' => '',
		);
	}

	/* ---------------------------------------------------------------------
	 * Sécurité
	 * ------------------------------------------------------------------ */

	/**
	 * Une commande est-elle autorisée par la politique du lab ?
	 *
	 * @param string $command  Commande.
	 * @param array  $manifest Manifeste.
	 * @return bool
	 */
	public static function command_allowed( $command, $manifest ) {
		$command = strtolower( trim( (string) $command ) );

		if ( '' === $command ) {
			return false;
		}

		foreach ( self::string_list( isset( $manifest['deny'] ) ? $manifest['deny'] : array() ) as $denied ) {
			if ( false !== strpos( $command, strtolower( $denied ) ) ) {
				return false;
			}
		}

		foreach ( explode( ' ', self::HARD_DENY ) as $denied ) {
			if ( preg_match( '/(^|[\s;|&\/])' . preg_quote( $denied, '/' ) . '($|[\s;|&])/', $command ) ) {
				return false;
			}
		}

		$allow = self::string_list( isset( $manifest['allow'] ) ? $manifest['allow'] : array() );

		if ( empty( $allow ) ) {
			return true;
		}

		$binary = strtok( $command, ' ' );

		foreach ( $allow as $allowed ) {
			if ( $binary === strtolower( $allowed ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Nettoie une sortie de commande : ANSI retirés, taille bornée.
	 *
	 * @param string $output Sortie brute.
	 * @return string
	 */
	public static function sanitize_output( $output ) {
		$output = (string) $output;

		/* Séquences ANSI (couleurs, curseur). */
		$output = preg_replace( '/\x1B\[[0-9;?]*[ -\/]*[@-~]/', '', $output );
		$output = preg_replace( '/\x1B\][^\x07]*(?:\x07|\x1B\\\\)/', '', $output );
		$output = preg_replace( '/[\x00-\x08\x0B\x0C\x0E-\x1F]/', '', $output );

		$output = str_replace( "\r\n", "\n", $output );
		$output = trim( $output );

		if ( strlen( $output ) > self::MAX_OUTPUT ) {
			$output = substr( $output, 0, self::MAX_OUTPUT ) . "\n[... sortie tronquee ...]";
		}

		return $output;
	}

	/* ---------------------------------------------------------------------
	 * Exécution
	 * ------------------------------------------------------------------ */

	/**
	 * Commande `docker compose` d'un lab.
	 *
	 * @param array $manifest Manifeste.
	 * @param array $args     Arguments.
	 * @return array
	 */
	public static function compose_command( $manifest, $args ) {
		$line = array( 'docker', 'compose', '-f', $manifest['compose'] );

		if ( ! empty( $manifest['project'] ) ) {
			$line[] = '-p';
			$line[] = $manifest['project'];
		}

		foreach ( $args as $arg ) {
			$line[] = $arg;
		}

		return $line;
	}

	/**
	 * Démarre le conteneur d'une room (mode `single`).
	 *
	 * @param int   $user_id  Identifiant de l'apprenant.
	 * @param int   $room_id  Identifiant de la room.
	 * @param array $manifest Manifeste.
	 * @return array
	 */
	public static function container_up( $user_id, $room_id, $manifest ) {
		$name = self::container_name( $user_id, $room_id );

		$line = array(
			'docker',
			'run',
			'-d',
			'--name',
			$name,
			'--label',
			'seca.lab=1',
			'--user',
			$manifest['user'],
			'--cap-drop',
			'ALL',
			'--security-opt',
			'no-new-privileges',
			'--pids-limit',
			(string) $manifest['pids'],
			'--memory',
			$manifest['memory'],
			'--cpus',
			$manifest['cpus'],
			'--tmpfs',
			'/tmp:rw,noexec,nosuid,size=32m',
			'--network',
			$manifest['network'],
			'-w',
			$manifest['workdir'],
			$manifest['image'],
			$manifest['command'],
		);

		$result = self::run( $line, 60 );

		return array(
			'ok'     => 0 === $result['code'],
			'output' => $result['output'],
		);
	}

	/**
	 * Démarre les services d'un lab (mode `compose`).
	 *
	 * @param array $manifest Manifeste.
	 * @return array
	 */
	public static function compose_up( $manifest ) {
		$result = self::run( self::compose_command( $manifest, array( 'up', '-d' ) ), 120 );

		return array(
			'ok'     => 0 === $result['code'],
			'output' => $result['output'],
		);
	}

	/**
	 * Exécute une commande externe sans shell (forme tableau de `proc_open`).
	 *
	 * @param array $line    Commande et arguments.
	 * @param int   $timeout Secondes.
	 * @return array
	 */
	public static function run( $line, $timeout = 15 ) {
		$output = '';
		$code   = -1;

		if ( ! self::can_exec() ) {
			return array(
				'output' => '',
				'code'   => 127,
			);
		}

		$descriptors = array(
			0 => array( 'pipe', 'r' ),
			1 => array( 'pipe', 'w' ),
			2 => array( 'pipe', 'w' ),
		);

		$pipes   = array();
		$process = @proc_open( $line, $descriptors, $pipes, null, array( 'LANG' => 'C.UTF-8' ) );

		if ( ! is_resource( $process ) ) {
			return array(
				'output' => '',
				'code'   => 127,
			);
		}

		if ( isset( $pipes[0] ) ) {
			fclose( $pipes[0] );
		}

		stream_set_blocking( $pipes[1], false );
		stream_set_blocking( $pipes[2], false );

		$deadline = time() + max( 1, (int) $timeout );

		while ( time() < $deadline ) {
			$read   = array( $pipes[1], $pipes[2] );
			$write  = null;
			$except = null;

			$changed = @stream_select( $read, $write, $except, 1 );

			if ( false === $changed ) {
				break;
			}

			foreach ( $read as $stream ) {
				$chunk = fread( $stream, 8192 );

				if ( false !== $chunk && '' !== $chunk ) {
					$output .= $chunk;
				}
			}

			if ( feof( $pipes[1] ) && feof( $pipes[2] ) ) {
				break;
			}
		}

		fclose( $pipes[1] );
		fclose( $pipes[2] );

		$status = proc_get_status( $process );

		if ( $status['running'] ) {
			proc_terminate( $process, 9 );
		}

		proc_close( $process );

		$code = (int) $status['exitcode'];

		if ( 0 !== $code && -1 === $code && '' !== $output ) {
			$code = 1;
		}

		return array(
			'output' => $output,
			'code'   => $code,
		);
	}

	/* ---------------------------------------------------------------------
	 * Nettoyage
	 * ------------------------------------------------------------------ */

	/**
	 * Arrête les machines expirées.
	 */
	public static function cleanup_expired() {
		if ( ! self::can_exec() ) {
			return;
		}

		$containers = self::run( array( 'docker', 'ps', '-a', '--filter', 'label=seca.lab=1', '--format', '{{.Names}}' ), 15 );

		if ( 0 !== $containers['code'] ) {
			return;
		}

		foreach ( explode( "\n", $containers['output'] ) as $name ) {
			$name = trim( $name );

			if ( '' === $name ) {
				continue;
			}

			/* Le nom encode l'apprenant et la room : on compare au TTL du lab. */
			if ( ! preg_match( '/^seca_lab_(\d+)_(\d+)$/', $name, $matches ) ) {
				continue;
			}

			$room_id   = (int) $matches[2];
			$manifest  = self::get_manifest( $room_id );
			$inspect   = self::run( array( 'docker', 'inspect', '-f', '{{.State.StartedAt}}', $name ), 10 );
			$started   = 0;

			if ( 0 === $inspect['code'] ) {
				$timestamp = strtotime( trim( $inspect['output'] ) );

				if ( $timestamp ) {
					$started = $timestamp;
				}
			}

			if ( $started > 0 && ( time() - $started ) > (int) $manifest['ttl'] ) {
				self::run( array( 'docker', 'rm', '-f', $name ), 20 );
			}
		}
	}
}
