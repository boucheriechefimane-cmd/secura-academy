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
			'flag_service' => '',
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
		$manifest['service']  = isset( $raw['service'] ) ? trim( (string) $raw['service'] ) : '';
		$manifest['flag_service'] = isset( $raw['flag_service'] ) ? trim( (string) $raw['flag_service'] ) : '';
		$manifest['compose'] = self::resolve_path( isset( $raw['compose'] ) ? $raw['compose'] : '' );
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
				/* Certains moteurs (Podman) n'exposent pas ce champ. On
				   verifie alors simplement que la commande de base
				   repond : c'est le moteur qui compte, pas sa version. */
				$fallback = self::run( array( 'docker', 'ps', '--format', '{{.Names}}' ), 12 );

				$available = ( 0 === $fallback['code'] ) ? '1' : '0';
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
	 * Dossier des labs sur le serveur.
	 *
	 * Par défaut `wp-content/secura-labs`. Peut être surdéfinie par l'option
	 * `secura_labs_path` (les labs vivent hors de WordPress).
	 *
	 * @return string
	 */
	public static function labs_path() {
		$path = self::labs_path_value();

		if ( ! is_string( $path ) || '' === trim( $path ) ) {
			$path = defined( 'WP_CONTENT_DIR' ) ? WP_CONTENT_DIR . '/secura-labs' : ABSPATH . 'wp-content/secura-labs';
		}

		return rtrim( trim( $path ), '/' );
	}

	/**
	 * Valeur du dossier des labs, sans le repli par defaut.
	 *
	 * Trois sources sontessayees dans l'ordre :
	 *
	 * 1. la constante `SECURA_LABS_PATH` du fichier wp-config.php (la plus
	 *    fiable : elle ndepend d'aucun cache) ;
	 * 2. l'option `secura_labs_path` du menu Reglages ;
	 * 3. une lecture directe en base, pour les servers dont le cache
	 *    d'options declare a tort que l'option n'existe pas.
	 *
	 * @return string Chemin du dossier des labs, ou chaine vide.
	 */
	public static function labs_path_value() {
		if ( defined( 'SECURA_LABS_PATH' ) && is_string( SECURA_LABS_PATH ) && '' !== trim( SECURA_LABS_PATH ) ) {
			return trim( SECURA_LABS_PATH );
		}

		$path = get_option( 'secura_labs_path', '' );

		if ( is_string( $path ) && '' !== trim( $path ) ) {
			return trim( $path );
		}

		global $wpdb;

		if ( isset( $wpdb ) && is_object( $wpdb ) ) {
			/* Nom d'option fixe : aucune valeur saisie par l'utilisateur,
			   donc aucune injection possible. */
			$value = $wpdb->get_var( "SELECT option_value FROM {$wpdb->options} WHERE option_name = 'seca_labs_path' LIMIT 1" );

			if ( is_string( $value ) && '' !== trim( $value ) ) {
				return trim( $value );
			}
		}

		return '';
	}

	/**
	 * Indique d'ou vient le dossier des labs (constante, option ou defaut).
	 *
	 * @return string
	 */
	public static function labs_path_source() {
		if ( defined( 'SECURA_LABS_PATH' ) && is_string( SECURA_LABS_PATH ) && '' !== trim( SECURA_LABS_PATH ) ) {
			return 'constante';
		}

		if ( '' !== self::labs_path_value() ) {
			return 'option';
		}

		return 'defaut';
	}

	/**
	 * Résout un chemin de lab : absolu, ou relatif au dossier des labs.
	 *
	 * @param string $path Chemin déclaré dans le manifeste.
	 * @return string
	 */
	public static function resolve_path( $path ) {
		$path = trim( (string) $path );

		if ( '' === $path ) {
			return '';
		}

		if ( '/' === substr( $path, 0, 1 ) ) {
			return $path;
		}

		return self::labs_path() . '/' . ltrim( $path, '/' );
	}

	/**
	 * Nom du réseau Docker d'un apprenant pour une room.
	 *
	 * Un réseau par apprenant et par room : deux élèves ne sont jamais sur le
	 * même réseau, et le réseau est créé sans sortie Internet.
	 *
	 * @param int   $user_id  Identifiant de l'apprenant.
	 * @param int   $room_id  Identifiant de la room.
	 * @param array $manifest Manifeste.
	 * @return string
	 */
	public static function network_name( $user_id, $room_id, $manifest = array() ) {
		$base = isset( $manifest['network'] ) && '' !== trim( (string) $manifest['network'] ) ? trim( (string) $manifest['network'] ) : 'seca_lab';

		return $base . '_' . absint( $user_id ) . '_' . absint( $room_id );
	}

	/**
	 * Nom du projet Docker Compose d'un apprenant pour une room.
	 *
	 * @param int   $user_id  Identifiant de l'apprenant.
	 * @param int   $room_id  Identifiant de la room.
	 * @param array $manifest Manifeste.
	 * @return string
	 */
	public static function project_name( $user_id, $room_id, $manifest = array() ) {
		$prefix = isset( $manifest['project'] ) && '' !== trim( (string) $manifest['project'] ) ? trim( (string) $manifest['project'] ) : 'seca_lab';

		return $prefix . '_' . absint( $user_id ) . '_' . absint( $room_id );
	}

	/**
	 * Variables d'environnement passées à Docker Compose.
	 *
	 * Elles permettent au fichier `docker-compose.yml` de labelliser chaque
	 * service : le nettoyage automatique sait alors retrouver la pile.
	 *
	 * @param int   $user_id  Identifiant de l'apprenant.
	 * @param int   $room_id  Identifiant de la room.
	 * @param array $manifest Manifeste.
	 * @return array
	 */
	public static function compose_env( $user_id, $room_id, $manifest = array() ) {
		return array(
			'SECA_LAB_USER'    => (string) absint( $user_id ),
			'SECA_LAB_ROOM'    => (string) absint( $room_id ),
			'SECA_LAB_PROJECT' => self::project_name( $user_id, $room_id, $manifest ),
			'SECA_LAB_COMPOSE' => isset( $manifest['compose'] ) ? (string) $manifest['compose'] : '',
		);
	}

	/**
	 * Crée le réseau dédié d'un apprenant s'il n'existe pas encore.
	 *
	 * Le réseau est créé `--internal` : aucune sortie vers Internet, aucune
	 * passerelle vers l'hôte. Les conteneurs ne peuvent parler qu'entre eux.
	 *
	 * @param string $network Nom du réseau.
	 * @return bool
	 */
	public static function ensure_network( $network ) {
		$inspect = self::run( array( 'docker', 'network', 'inspect', $network ), 15 );

		if ( 0 === $inspect['code'] ) {
			return true;
		}

		$create = self::run( array( 'docker', 'network', 'create', '--internal', '--driver', 'bridge', $network ), 30 );

		return 0 === $create['code'];
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
			$result = self::compose_up( $manifest, $user_id, $room_id );
		} else {
			/* Le reseau dedie doit exister AVANT la machine : Docker ne
			   cree pas un reseau demande par « --network », la commande
			   echouerait donc si l'on oubliait cette etape. */
			self::ensure_network( self::network_name( $user_id, $room_id, $manifest ) );

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
			self::run(
				self::compose_command( $manifest, array( 'down', '-v' ), $user_id, $room_id ),
				30,
				self::compose_env( $user_id, $room_id, $manifest )
			);

			/* Selon le moteur de Compose, les conteneurs du projet ne
			   portent pas toujours le meme nom (projet_service_1 ou
			   projet-service-1). On supprime donc aussi tout ce qui
			   porte l'etiquette du projet : rien ne doit traîner. */
			$project = self::project_name( $user_id, $room_id, $manifest );
			$listed  = self::run(
				array(
					'docker',
					'ps',
					'-a',
					'--filter',
					'label=seca.lab.project=' . $project,
					'--format',
					'{{.Names}}',
				),
				20
			);

			foreach ( preg_split( '/\R/', (string) $listed['output'] ) as $name ) {
				$name = trim( $name );

				if ( '' !== $name ) {
					self::run( array( 'docker', 'rm', '-f', $name ), 20 );
				}
			}
		} else {
			self::run( array( 'docker', 'rm', '-f', self::container_name( $user_id, $room_id ) ), 20 );
		}

		/* Le reseau dedie est supprime avec la machine : rien ne traine. */
		self::run( array( 'docker', 'network', 'rm', self::network_name( $user_id, $room_id, $manifest ) ), 20 );

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
	/**
	 * Lit un fichier de la machine de l'apprenant (drapeau, par exemple).
	 *
	 * Le serveur lit le fichier DANS la machine de l'apprenant : le
	 * drapeau attendu ne quitte jamais le serveur, et l'apprenant ne
	 * peut pas valider l'etape sans l'avoir reellement trouve.
	 *
	 * @param int    $user_id  Identifiant de l'apprenant.
	 * @param int    $room_id  Identifiant de la room.
	 * @param string $path     Chemin du fichier dans la machine.
	 * @return string Contenu du fichier (chaîne vide si illisible).
	 */
	public static function read_file( $user_id, $room_id, $path ) {
		$path = self::safe_machine_path( $path );

		if ( '' === $path ) {
			return '';
		}

		$manifest = self::get_manifest( $room_id );
		$status   = self::status( $user_id, $room_id );

		if ( 'docker' !== $status['driver'] || 'running' !== $status['state'] ) {
			return '';
		}

		/* La lecture se fait en root dans le conteneur : le fichier de
		   reponse n'est pas lisible par l'apprenant (400 root), seule la
		   machine elle-meme y accede. */
		if ( 'compose' === $manifest['mode'] ) {
			/* Le drapeau peut vivre sur un AUTRE service de la pile
			   (c'est le cas du pivot : le secret est sur le noeud
			   interne, pas sur la machine de l'apprenant). */
			$flag_service = '' !== $manifest['flag_service'] ? $manifest['flag_service'] : $manifest['service'];

			$line = self::compose_command(
				$manifest,
				array( 'exec', '-T', '-u', '0', $flag_service, 'cat', $path ),
				$user_id,
				$room_id
			);
		} else {
			$line = array(
				'docker',
				'exec',
				'-u',
				'0',
				self::container_name( $user_id, $room_id ),
				'cat',
				$path,
			);
		}

		$result = self::run( $line, 15 );

		if ( 0 !== $result['code'] ) {
			return '';
		}

		return trim( (string) $result['output'] );
	}

	/**
	 * Verifie que le drapeaux propose par l'apprenant est bien celui de
	 * sa machine.
	 *
	 * @param int    $user_id  Identifiant de l'apprenant.
	 * @param int    $room_id  Identifiant de la room.
	 * @param string $path     Chemin du fichier de drapeau.
	 * @param string $answer   Drapeau propose par l'apprenant.
	 * @return bool
	 */
	public static function flag_matches( $user_id, $room_id, $path, $answer ) {
		$answer = trim( (string) $answer );
		$real   = self::read_file( $user_id, $room_id, $path );

		if ( '' === $real || '' === $answer ) {
			return false;
		}

		return 0 === strcasecmp( $real, $answer );
	}

	/**
	 * Un chemin de fichier de drapeau doit etre absolu et sans caractere
	 * dangerous : le plugin l'execute dans la machine de l'apprenant.
	 *
	 * @param string $path Chemin propose.
	 * @return string Chemin accepte (chaîne vide si refuse).
	 */
	public static function safe_machine_path( $path ) {
		$path = trim( (string) $path );

		if ( '' === $path || '/' !== substr( $path, 0, 1 ) ) {
			return '';
		}

		if ( ! preg_match( '#^/[A-Za-z0-9._/-]+$#', $path ) ) {
			return '';
		}

		if ( false !== strpos( $path, '..' ) ) {
			return '';
		}

		return $path;
	}

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
				array( 'exec', '-T', '-w', $manifest['workdir'], $manifest['service'], 'bash', '-lc', $command ),
				$user_id,
				$room_id
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
	public static function compose_command( $manifest, $args, $user_id = 0, $room_id = 0 ) {
		$line = array( 'docker', 'compose', '-f', $manifest['compose'] );

		/* Le projet est toujours unique par apprenant et par room : deux
		   élèves ne peuvent pas partager la même pile de conteneurs. */
		$line[] = '-p';
		$line[] = self::project_name( $user_id, $room_id, $manifest );

		foreach ( $args as $arg ) {
			$line[] = $arg;
		}

		return $line;
	}

	/**
	 * Commande de démarrage du conteneur d'un apprenant (mode `single`).
	 *
	 * Le réseau est celui de l'apprenant : deux élèves ne sont jamais sur le
	 * même réseau, et le réseau ne donne pas accès à Internet.
	 *
	 * @param int   $user_id  Identifiant de l'apprenant.
	 * @param int   $room_id  Identifiant de la room.
	 * @param array $manifest Manifeste.
	 * @return array
	 */
	public static function container_command( $user_id, $room_id, $manifest ) {
		$line = array(
			'docker',
			'run',
			'-d',
			'--name',
			self::container_name( $user_id, $room_id ),
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
			self::network_name( $user_id, $room_id, $manifest ),
			'-w',
			$manifest['workdir'],
			$manifest['image'],
		);

		/* La commande du manifeste est une chaine (« sleep infinity ») :
		   Docker attend une liste d'arguments, sinon le conteneur
		   cherche un programme du nom exact « sleep infinity » et
		   s'arrete aussitot. */
		foreach ( preg_split( '/\s+/', trim( (string) $manifest['command'] ) ) as $word ) {
			if ( '' !== $word ) {
				$line[] = $word;
			}
		}

		return $line;
	}

	/**
	 * Commande de lancement d'une machine unique, sous forme de chaine.
	 *
	 * @param int   $user_id  Identifiant de l'apprenant.
	 * @param int   $room_id  Identifiant de la room.
	 * @param array $manifest Manifeste du lab.
	 * @return string
	 */
	public static function container_command_line( $user_id, $room_id, $manifest ) {
		return implode( ' ', self::container_command( $user_id, $room_id, $manifest ) );
	}

	public static function container_up( $user_id, $room_id, $manifest ) {
		$line = self::container_command( $user_id, $room_id, $manifest );

		/* Un conteneur du meme nom peut subsister : page rechargee, machine
		   arretee brutalement, redemarrage du serveur. Sans ce nettoyage,
		   Docker refuse de creer le conteneur (« name already in use ») et
		   l'apprenant ne peut plus redeployer sa machine. */
		self::run(
			array(
				'docker',
				'rm',
				'-f',
				self::container_name( $user_id, $room_id ),
			),
			30
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
	public static function compose_up( $manifest, $user_id = 0, $room_id = 0 ) {
		$env = self::compose_env( $user_id, $room_id, $manifest );

		/* Construction des images : la premiere fois, c'est long (telechargement
		   de l'image de base et des paquets). Ensuite, le cache Docker rend
		   l'operation quasi instantanee. On construit donc separement, avec
		   un delai generous, puis on demarre la pile sans reconstruire. */
		$build = self::run(
			self::compose_command( $manifest, array( 'build' ), $user_id, $room_id ),
			900,
			$env
		);

		$result = self::run(
			self::compose_command( $manifest, array( 'up', '-d', '--no-build' ), $user_id, $room_id ),
			180,
			$env
		);

		return array(
			'ok'     => 0 === $result['code'],
			'output' => ( '' !== trim( $build['output'] ) ? $build['output'] . "\n" : '' ) . $result['output'],
		);
	}

	/**
	 * Exécute une commande externe sans shell (forme tableau de `proc_open`).
	 *
	 * @param array $line    Commande et arguments.
	 * @param int   $timeout Secondes.
	 * @return array
	 */
	public static function run( $line, $timeout = 15, $env = array() ) {
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

		/* On part de l'environnement complet du serveur : sans cela, le
		   client Docker ne retrouve ni le demon (DOCKER_HOST), ni le
           dossier de configuration de l'utilisateur (HOME), et le lab
		   demarre dans un contextedifferent de celui de l'administrateur. */
		$environment = getenv();

		if ( ! is_array( $environment ) ) {
			$environment = array();
		}

		$environment['LANG'] = 'C.UTF-8';

		if ( empty( $environment['PATH'] ) ) {
			$environment['PATH'] = '/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin';
		}

		foreach ( (array) $env as $key => $value ) {
			$environment[ (string) $key ] = (string) $value;
		}

		$pipes   = array();
		$process = @proc_open( $line, $descriptors, $pipes, null, $environment );

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

		/* Les noms d'un coup, puis les etiquettes un par un : la lecture
		   des etiquettes passe par « inspect », qui parle la meme langue
		   sur Docker et sur Podman. */
		$containers = self::run( array( 'docker', 'ps', '-a', '--filter', 'label=seca.lab=1', '--format', '{{.Names}}' ), 15 );

		if ( 0 !== $containers['code'] ) {
			return;
		}

		$label_format = '{{index .Config.Labels "seca.lab.project"}}|{{index .Config.Labels "seca.lab.compose"}}|{{index .Config.Labels "seca.lab.room"}}|{{index .Config.Labels "seca.lab.user"}}';

		foreach ( explode( "\n", $containers['output'] ) as $line ) {
			$name = trim( $line );

			if ( '' === $name ) {
				continue;
			}

			$labels = self::run( array( 'docker', 'inspect', '-f', $label_format, $name ), 10 );

			if ( 0 !== $labels['code'] ) {
				continue;
			}

			$parts   = explode( '|', $labels['output'] );
			$project = trim( isset( $parts[0] ) ? $parts[0] : '' );
			$compose = trim( isset( $parts[1] ) ? $parts[1] : '' );
			$room    = absint( isset( $parts[2] ) ? $parts[2] : 0 );
			$user    = absint( isset( $parts[3] ) ? $parts[3] : 0 );

			/* Conteneur Compose : la room vient du label. */
			if ( '' !== $project && $room > 0 ) {
				$manifest = self::get_manifest( $room );
				$started  = self::started_at( $name );

				if ( $started > 0 && ( time() - $started ) > (int) $manifest['ttl'] ) {
					if ( '' !== $compose && file_exists( $compose ) ) {
						self::run(
							array( 'docker', 'compose', '-f', $compose, '-p', $project, 'down', '-v' ),
							30,
							self::compose_env( $user, $room, $manifest )
						);
					} else {
						self::run( array( 'docker', 'rm', '-f', $name ), 20 );
					}
				}

				continue;
			}

			/* Conteneur unique : le nom encode l'apprenant et la room. */
			if ( ! preg_match( '/^seca_lab_(\d+)_(\d+)$/', $name, $matches ) ) {
				continue;
			}

			$room_id   = (int) $matches[2];
			$user_id   = (int) $matches[1];
			$manifest  = self::get_manifest( $room_id );
			$started   = self::started_at( $name );

			if ( $started > 0 && ( time() - $started ) > (int) $manifest['ttl'] ) {
				self::run( array( 'docker', 'rm', '-f', $name ), 20 );
				self::run( array( 'docker', 'network', 'rm', self::network_name( $user_id, $room_id, $manifest ) ), 20 );
			}
		}
	}

	/**
	 * Date de démarrage d'un conteneur (timestamp Unix), 0 si inconnu.
	 *
	 * @param string $name Nom du conteneur.
	 * @return int
	 */
	public static function started_at( $name ) {
		$inspect = self::run( array( 'docker', 'inspect', '-f', '{{.State.StartedAt}}', $name ), 10 );

		if ( 0 !== $inspect['code'] ) {
			return 0;
		}

		$timestamp = strtotime( trim( $inspect['output'] ) );

		return $timestamp ? (int) $timestamp : 0;
	}
}
