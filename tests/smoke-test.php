<?php
/**
 * Vérification de la logique serveur de Secura Academy.
 *
 * Ce harnais émule les fonctions WordPress utilisées par le plugin afin de
 * tester la logique métier (barème, verrouillage, examens, terminal simulé,
 * multilingue) et le fait que les réponses attendues ne quittent jamais le
 * serveur, sans installation WordPress complète.
 *
 * Exécution : php tests/smoke-test.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', '/tmp/' );
}

/* ---------------------------------------------------------------------
 * Constantes du plugin
 * ------------------------------------------------------------------ */

define( 'SECURA_POST_TYPE', 'secura_room' );
define( 'SECURA_PATH_POST_TYPE', 'secura_path' );
define( 'SECURA_META_TASKS', '_secura_tasks' );
define( 'SECURA_META_DIFFICULTY', '_secura_difficulty' );
define( 'SECURA_META_DURATION', '_secura_duration' );
define( 'SECURA_META_XP_BONUS', '_secura_xp_bonus' );
define( 'SECURA_META_I18N', '_secura_i18n' );
define( 'SECURA_META_PATH_SECTIONS', '_secura_path_sections' );
define( 'SECURA_META_PATH_I18N', '_secura_path_i18n' );
define( 'SECURA_USER_XP', 'secura_xp' );
define( 'SECURA_USER_PROGRESS', 'secura_progress' );
define( 'SECURA_USER_MEDALS', 'secura_medals' );
define( 'SECURA_USER_EXAMS', 'secura_exams' );
define( 'SECURA_USER_TERMINALS', 'secura_terminals' );
define( 'SECURA_USER_STREAK', 'secura_streak' );
define( 'SECURA_USER_LANG', 'secura_lang' );
define( 'SECURA_USER_RANKS', 'secura_ranks' );
define( 'SECURA_OPTION_FIRST_BLOOD', 'secura_first_blood' );

/* ---------------------------------------------------------------------
 * Les lots d'import des examens d'universite
 *
 * Ces fichiers ne portent que des donnees : les questions, leur
 * source, leur licence. On les charge ici pour que le test de
 * non-regression de la reserve (en bas de fichier) puisse les utiliser
 * comme un vrai WordPress les chargerait.
 * ------------------------------------------------------------------ */

foreach ( (array) glob( __DIR__ . '/../wp-content/plugins/secura-academy/includes/content-import-*.php' ) as $lot_import ) {
	require_once $lot_import;
}

/* ---------------------------------------------------------------------
 * Émulation WordPress minimale
 * ------------------------------------------------------------------ */

$GLOBALS['securatest_meta']   = array();
$GLOBALS['securatest_users']  = array();
$GLOBALS['securatest_posts']  = array();
$GLOBALS['securatest_options'] = array();

/**
 * Exception transportant une réponse JSON.
 */
class Secura_Test_Json extends Exception {

	/**
	 * Données envoyées.
	 *
	 * @var mixed
	 */
	public $data;

	/**
	 * Succès ?
	 *
	 * @var bool
	 */
	public $ok;

	/**
	 * Code HTTP.
	 *
	 * @var int
	 */
	public $status;

	/**
	 * Constructeur.
	 *
	 * @param mixed $data   Données.
	 * @param bool  $ok     Succès.
	 * @param int   $status Code HTTP.
	 */
	public function __construct( $data, $ok = true, $status = 200 ) {
		parent::__construct( 'json' );

		$this->data = $data;
		$this->ok   = $ok;
	}
}

/**
 * Valeur absolue entière.
 *
 * @param mixed $value Valeur.
 * @return int
 */
function absint( $value ) {
	return abs( (int) $value );
}

/**
 * Clé slugifiée.
 *
 * @param mixed $key Valeur.
 * @return string
 */
function sanitize_key( $key ) {
	return preg_replace( '/[^a-z0-9_\-]/', '', strtolower( (string) $key ) );
}

/**
 * Texte simple.
 *
 * @param mixed $value Valeur.
 * @return string
 */
function sanitize_text_field( $value ) {
	return trim( preg_replace( '/[\r\n\t]+/', ' ', wp_strip_all_tags( (string) $value ) ) );
}

/**
 * Texte long.
 *
 * @param mixed $value Valeur.
 * @return string
 */
function sanitize_textarea_field( $value ) {
	return trim( wp_strip_all_tags( (string) $value ) );
}

/**
 * Retire les balises.
 *
 * @param mixed $value Valeur.
 * @return string
 */
function wp_strip_all_tags( $value ) {
	return strip_tags( (string) $value );
}

/**
 * Retire les accents.
 *
 * @param mixed $value Valeur.
 * @return string
 */
function remove_accents( $value ) {
	$map = array(
		'á' => 'a', 'à' => 'a', 'â' => 'a', 'ä' => 'a', 'ã' => 'a',
		'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
		'í' => 'i', 'ì' => 'i', 'î' => 'i', 'ï' => 'i',
		'ó' => 'o', 'ò' => 'o', 'ô' => 'o', 'ö' => 'o', 'õ' => 'o',
		'ú' => 'u', 'ù' => 'u', 'û' => 'u', 'ü' => 'u',
		'ý' => 'y', 'ÿ' => 'y', 'ñ' => 'n', 'ç' => 'c',
		'œ' => 'oe', 'æ' => 'ae',
	);

	return strtr( (string) $value, $map );
}

/**
 * Meta d'un post.
 *
 * @param int    $post_id Identifiant.
 * @param string $key     Clé.
 * @param bool   $single  Valeur simple ?
 * @return mixed
 */
function get_post_meta( $post_id, $key, $single = false ) {
	$value = isset( $GLOBALS['securatest_meta'][ $post_id ][ $key ] ) ? $GLOBALS['securatest_meta'][ $post_id ][ $key ] : '';

	return $single ? $value : ( is_array( $value ) ? $value : array() );
}

/**
 * Écrit une meta de post.
 *
 * @param int    $post_id Identifiant.
 * @param string $key     Clé.
 * @param mixed  $value   Valeur.
 * @return bool
 */
function update_post_meta( $post_id, $key, $value ) {
	$GLOBALS['securatest_meta'][ $post_id ][ $key ] = $value;

	return true;
}

/**
 * Meta d'un utilisateur.
 *
 * @param int    $user_id Identifiant.
 * @param string $key     Clé.
 * @param bool   $single  Valeur simple ?
 * @return mixed
 */
function get_user_meta( $user_id, $key, $single = false ) {
	$value = isset( $GLOBALS['securatest_users'][ $user_id ][ $key ] ) ? $GLOBALS['securatest_users'][ $user_id ][ $key ] : '';

	return $single ? $value : ( is_array( $value ) ? $value : array() );
}

/**
 * Écrit une meta d'utilisateur.
 *
 * @param int    $user_id Identifiant.
 * @param string $key     Clé.
 * @param mixed  $value   Valeur.
 * @return bool
 */
function update_user_meta( $user_id, $key, $value ) {
	$GLOBALS['securatest_users'][ $user_id ][ $key ] = $value;

	return true;
}

/**
 * Option.
 *
 * @param string $name    Nom.
 * @param mixed  $default Défaut.
 * @return mixed
 */
function get_option( $name, $default = false ) {
	if ( 'WPLANG' === $name && ! isset( $GLOBALS['securatest_options'][ $name ] ) ) {
		/* L'emulation suit la langue du site reglee par le test. */
		return isset( $GLOBALS['securatest_site_locale'] ) ? $GLOBALS['securatest_site_locale'] : 'fr_FR';
	}

	return isset( $GLOBALS['securatest_options'][ $name ] ) ? $GLOBALS['securatest_options'][ $name ] : $default;
}

/**
 * Écrit une option.
 *
 * @param string $name  Nom.
 * @param mixed  $value Valeur.
 * @return bool
 */
function update_option( $name, $value ) {
	$GLOBALS['securatest_options'][ $name ] = $value;

	return true;
}

/**
 * Horodatage.
 *
 * @param string $type Type.
 * @return string
 */
function current_time( $type ) {
	return 'mysql' === $type ? gmdate( 'Y-m-d H:i:s' ) : gmdate( 'Y-m-d' );
}

/**
 * Lit un transient.
 *
 * @param string $key Clé.
 * @return mixed Valeur ou false.
 */
function get_transient( $key ) {
	return isset( $GLOBALS['securatest_transients'][ $key ] ) ? $GLOBALS['securatest_transients'][ $key ] : false;
}

/**
 * Écrit un transient.
 *
 * @param string $key       Clé.
 * @param mixed  $value     Valeur.
 * @param int    $expiration Expiration.
 * @return bool
 */
function set_transient( $key, $value, $expiration = 0 ) {
	$GLOBALS['securatest_transients'][ $key ] = $value;

	return true;
}

/**
 * Supprime un transient.
 *
 * @param string $key Clé.
 * @return bool
 */
function delete_transient( $key ) {
	unset( $GLOBALS['securatest_transients'][ $key ] );

	return true;
}

/**
 * Traduction.
 *
 * @param string $text   Texte.
 * @param string $domain Domaine.
 * @return string
 */
function __( $text, $domain = 'default' ) {
	return $text;
}

/**
 * Traduction plurielle.
 *
 * @param string $single Singulier.
 * @param string $plural Pluriel.
 * @param int    $number Nombre.
 * @param string $domain Domaine.
 * @return string
 */
function _n( $single, $plural, $number, $domain = 'default' ) {
	return 1 === (int) $number ? $single : $plural;
}

/**
 * Écho d'une traduction.
 *
 * @param string $text   Texte.
 * @param string $domain Domaine.
 */
function _e( $text, $domain = 'default' ) {
	echo $text;
}

/**
 * Traduction échappée.
 *
 * @param string $text   Texte.
 * @param string $domain Domaine.
 * @return string
 */
function esc_html__( $text, $domain = 'default' ) {
	return htmlspecialchars( $text, ENT_QUOTES, 'UTF-8' );
}

/**
 * Écho d'une traduction échappée.
 *
 * @param string $text   Texte.
 * @param string $domain Domaine.
 */
function esc_html_e( $text, $domain = 'default' ) {
	echo esc_html__( $text, $domain );
}

/**
 * Échappement HTML.
 *
 * @param mixed $text Valeur.
 * @return string
 */
function esc_html( $text ) {
	return htmlspecialchars( (string) $text, ENT_QUOTES, 'UTF-8' );
}

/**
 * Échappement d'attribut.
 *
 * @param mixed $text Valeur.
 * @return string
 */
function esc_attr( $text ) {
	return htmlspecialchars( (string) $text, ENT_QUOTES, 'UTF-8' );
}

/**
 * Échappement de zone de texte.
 *
 * @param mixed $text Valeur.
 * @return string
 */
function esc_textarea( $text ) {
	return htmlspecialchars( (string) $text, ENT_QUOTES, 'UTF-8' );
}

/**
 * Échappement d'URL.
 *
 * @param mixed $text Valeur.
 * @return string
 */
function esc_url( $text ) {
	return htmlspecialchars( (string) $text, ENT_QUOTES, 'UTF-8' );
}

/**
 * Encodage JSON (emulation).
 *
 * @param mixed $data Donnees.
 * @return string
 */
function wp_json_encode( $data ) {
	return json_encode( $data );
}

/**
 * L'adresse du site (emulation).
 *
 * @param string $path Chemin.
 * @return string
 */
function home_url( $path = '' ) {
	return 'https://exemple.test/' . ltrim( (string) $path, '/' );
}

/**
 * Ajout de parametres a une adresse (emulation).
 *
 * @param array  $args   Parametres.
 * @param string $url    Adresse.
 * @return string
 */
function add_query_arg( $args, $url = '' ) {
	/* WordPress REMPLACE la valeur d'une cle deja presente. L'ancienne
	   emulation ajoutait un second « seca_lang » : elle ne pouvait donc
	   pas prouver qu'un selecteur ne laisse pas deux langues dans
	   l'adresse. */
	$pairs = array();

	if ( false !== strpos( $url, '?' ) ) {
		$query = substr( $url, strpos( $url, '?' ) + 1 );
		$url   = substr( $url, 0, strpos( $url, '?' ) );

		foreach ( explode( '&', $query ) as $morceau ) {
			if ( '' === $morceau ) {
				continue;
			}

			$parts = explode( '=', $morceau, 2 );
			$pairs[ urldecode( $parts[0] ) ] = isset( $parts[1] ) ? urldecode( $parts[1] ) : '';
		}
	}

	foreach ( (array) $args as $key => $value ) {
		$pairs[ $key ] = (string) $value;
	}

	if ( ! $pairs ) {
		return $url;
	}

	$morceaux = array();

	foreach ( $pairs as $key => $value ) {
		$morceaux[] = rawurlencode( $key ) . '=' . rawurlencode( $value );
	}

	return $url . '?' . implode( '&', $morceaux );
}

/**
 * Retrait de parametres d'une adresse (emulation).
 *
 * @param mixed  $keys Cles a retirer.
 * @param string $url  Adresse.
 * @return string
 */
function remove_query_arg( $keys, $url = '' ) {
	$pairs = array();

	if ( false !== strpos( $url, '?' ) ) {
		$query = substr( $url, strpos( $url, '?' ) + 1 );
		$url   = substr( $url, 0, strpos( $url, '?' ) );

		foreach ( explode( '&', $query ) as $morceau ) {
			if ( '' === $morceau ) {
				continue;
			}

			$parts = explode( '=', $morceau, 2 );

			if ( in_array( urldecode( $parts[0] ), (array) $keys, true ) ) {
				continue;
			}

			$pairs[] = $morceau;
		}
	}

	return $pairs ? $url . '?' . implode( '&', $pairs ) : $url;
}

/**
 * Analyse d'une adresse (emulation minimale).
 *
 * @param string $url    Adresse.
 * @param int    $composant Composant demande.
 * @return mixed
 */
function wp_parse_url( $url, $composant = -1 ) {
	return -1 === $composant ? parse_url( $url ) : parse_url( $url, $composant );
}

/**
 * Fusion d'arguments.
 *
 * @param array $args     Arguments.
 * @param array $defaults Defaults.
 * @return array
 */
function wp_parse_args( $args, $defaults = array() ) {
	if ( is_object( $args ) ) {
		$args = get_object_vars( $args );
	}

	if ( ! is_array( $args ) ) {
		$args = array();
	}

	return array_merge( $defaults, $args );
}

/**
 * Retrait des slashes.
 *
 * @param mixed $value Valeur.
 * @return mixed
 */
function wp_unslash( $value ) {
	if ( is_array( $value ) ) {
		return array_map( 'wp_unslash', $value );
	}

	return is_string( $value ) ? stripslashes( $value ) : $value;
}

/**
 * Filtre neutre.
 *
 * @param mixed $value Valeur.
 * @return mixed
 */
function apply_filters( $tag, $value ) {
	return $value;
}

/**
 * Hook neutre.
 *
 * @param string $tag      Nom.
 * @param mixed  $callback Callback.
 * @param int    $priority Priorité.
 * @param mixed  $args     Arguments.
 */
function add_action( $tag, $callback, $priority = 10, $args = 1 ) {}

/**
 * Filtre neutre.
 *
 * @param string $tag      Nom.
 * @param mixed  $callback Callback.
 * @param int    $priority Priorité.
 * @param mixed  $args     Arguments.
 */
function add_filter( $tag, $callback, $priority = 10, $args = 1 ) {}

/**
 * Utilisateur connecté ?
 *
 * @return bool
 */
function is_user_logged_in() {
	return true;
}

/**
 * Identifiant de l'utilisateur courant.
 *
 * @return int
 */
function get_current_user_id() {
	return isset( $GLOBALS['securatest_user'] ) ? (int) $GLOBALS['securatest_user'] : 1;
}

/**
 * Locale du site.
 *
 * @return string
 */
function determine_locale() {
	$GLOBALS['securatest_locale_calls'] = isset( $GLOBALS['securatest_locale_calls'] ) ? $GLOBALS['securatest_locale_calls'] + 1 : 1;

	return isset( $GLOBALS['securatest_site_locale'] ) ? $GLOBALS['securatest_site_locale'] : 'fr_FR';
}

/**
 * Locale du site (ce que WPLANG vaut).
 *
 * @return string
 */
function get_locale() {
	return isset( $GLOBALS['securatest_site_locale'] ) ? $GLOBALS['securatest_site_locale'] : 'fr_FR';
}

/**
 * Bascule de locale.
 *
 * @param string $locale Locale.
 */
function switch_to_locale( $locale ) {}

/**
 * Contenu assaini.
 *
 * @param mixed $html HTML.
 * @return string
 */
function wp_kses_post( $html ) {
	return (string) $html;
}

/**
 * Paragraphes.
 *
 * @param string $text Texte.
 * @return string
 */
function wpautop( $text ) {
	return '<p>' . $text . '</p>';
}

/**
 * Post simulé.
 *
 * @param int $post_id Identifiant.
 * @return object
 */
function securatest_get_post( $post_id ) {
	if ( is_object( $post_id ) ) {
		return $post_id;
	}

	if ( isset( $GLOBALS['securatest_posts'][ $post_id ] ) ) {
		return $GLOBALS['securatest_posts'][ $post_id ];
	}

	$post = new stdClass();

	$post->ID           = (int) $post_id;
	$post->post_type    = SECURA_POST_TYPE;
	$post->post_title   = 'Room de test';
	$post->post_excerpt = 'Extrait de test';
	$post->post_content = 'Contenu de test';
	$post->post_name    = 'room-de-test';

	return $post;
}

/**
 * Récupère un post.
 *
 * @param int $post_id Identifiant.
 * @return object
 */
function get_post( $post_id = null ) {
	return securatest_get_post( $post_id );
}

/**
 * Titre d'un post.
 *
 * @param int $post_id Identifiant.
 * @return string
 */
function get_the_title( $post_id = null ) {
	$post = securatest_get_post( $post_id );

	return $post->post_title;
}

/**
 * Liste de posts.
 *
 * @param array $args Arguments.
 * @return array
 */
function get_posts( $args = array() ) {
	return isset( $GLOBALS['securatest_post_lists'] ) ? $GLOBALS['securatest_post_lists'] : array();
}

/**
 * Utilisateur simulé.
 *
 * @param int $user_id Identifiant.
 * @return object
 */
function get_userdata( $user_id ) {
	$user = new stdClass();

	$user->ID           = (int) $user_id;
	$user->user_login   = 'apprenant';
	$user->first_name   = 'Nadia';
	$user->last_name    = 'Benali';
	$user->display_name = 'Nadia Benali';

	return $user;
}

/**
 * Date formatée.
 *
 * @param string $format    Format.
 * @param int    $timestamp Horodatage.
 * @return string
 */
function date_i18n( $format, $timestamp = null ) {
	return gmdate( 'Y-m-d', $timestamp ? $timestamp : time() );
}

/**
 * Information du site.
 *
 * @param string $field Champ.
 * @return string
 */
function get_bloginfo( $field = 'name' ) {
	return 'Secura Academy';
}

/**
 * Permalien.
 *
 * @param int $post_id Identifiant.
 * @return string
 */
function get_permalink( $post_id = 0 ) {
	return 'https://exemple.test/?p=' . (int) $post_id;
}

/**
 * Objet interroge (emulation).
 *
 * @return int
 */
function get_queried_object_id() {
	return isset( $GLOBALS['securatest_queried_id'] ) ? (int) $GLOBALS['securatest_queried_id'] : 0;
}

/**
 * Nonce valide.
 *
 * @param string $nonce Nonce.
 * @param string $action Action.
 * @return bool
 */
function wp_verify_nonce( $nonce, $action = -1 ) {
	return true;
}

/**
 * Nonce créé.
 *
 * @param string $action Action.
 * @return string
 */
function wp_create_nonce( $action = -1 ) {
	return 'nonce-de-test';
}

/**
 * URL admin.
 *
 * @param string $path Chemin.
 * @return string
 */
function admin_url( $path = '' ) {
	return 'https://exemple.test/wp-admin/' . $path;
}

/**
 * Réponse JSON de succès.
 *
 * @param mixed $data   Données.
 * @param int   $status Code.
 * @throws Secura_Test_Json Toujours.
 */
function wp_send_json_success( $data = null, $status = null ) {
	throw new Secura_Test_Json( $data, true, $status );
}

/**
 * Réponse JSON d'erreur.
 *
 * @param mixed $data   Données.
 * @param int   $status Code.
 * @throws Secura_Test_Json Toujours.
 */
function wp_send_json_error( $data = null, $status = null ) {
	throw new Secura_Test_Json( $data, false, $status );
}

/* ---------------------------------------------------------------------
 * Chargement du code testé
 * ------------------------------------------------------------------ */

require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-i18n.php';
require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-progress.php';
require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-terminal.php';
require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-lab.php';
require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-rooms.php';
require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-settings.php';
require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-paths.php';
require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-exam.php';
require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-solution.php';
require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-gate.php';
require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-ajax.php';

/* ---------------------------------------------------------------------
 * Assertions
 * ------------------------------------------------------------------ */

$passed = 0;
$failed = 0;

/**
 * Vérifie une condition.
 *
 * @param bool   $condition Condition.
 * @param string $label     Libellé du test.
 */
function check( $condition, $label ) {
	global $passed, $failed;

	if ( $condition ) {
		$passed++;
		echo "  ok   " . $label . "\n";
	} else {
		$failed++;
		echo "  FAIL " . $label . "\n";
	}
}

/**
 * Capture la réponse JSON d'un appel AJAX.
 *
 * @param callable $callback Appel.
 * @return array|null
 */
function capture_json( $callback ) {
	try {
		call_user_func( $callback );
	} catch ( Secura_Test_Json $exception ) {
		return array(
			'data'   => $exception->data,
			'ok'     => $exception->ok,
			'status' => $exception->status,
		);
	}

	return null;
}

/* ---------------------------------------------------------------------
 * Normalisation des réponses
 * ------------------------------------------------------------------ */

echo "Normalisation des réponses\n";
check( 'aes' === Secura_Progress::normalize_answer( '  AES. ' ), 'casse, espaces et ponctuation sont ignorés' );
check( 'depassement de tampon' === Secura_Progress::normalize_answer( 'Dépassement de Tampon' ), 'les accents sont ignorés' );
check( 'diffie-hellman' === Secura_Progress::normalize_answer( 'Diffie-Hellman' ), 'les tirets internes sont conservés' );
check( Secura_Progress::answer_matches( 'AES', array( 'aes', 'Aes-256' ) ), 'une réponse acceptée est reconnue' );
check( ! Secura_Progress::answer_matches( 'RSA', array( 'AES' ) ), 'une réponse non listée est rejetée' );
check( ! Secura_Progress::answer_matches( '', array( 'AES' ) ), 'une réponse vide est rejetée' );
check( ! Secura_Progress::answer_matches( 'AES', array() ), 'une liste vide ne valide rien' );

/* ---------------------------------------------------------------------
 * Niveaux
 * ------------------------------------------------------------------ */

echo "\nPaliers de niveau\n";
check( 12 === count( Secura_Progress::levels() ), 'douze niveaux sont définis' );
check( 1 === Secura_Progress::level_for_xp( 0 )['number'], 'niveau 1 à 0 XP' );
check( 2 === Secura_Progress::level_for_xp( 100 )['number'], 'niveau 2 à 100 XP' );
check( 6 === Secura_Progress::level_for_xp( 1500 )['number'], 'niveau 6 à 1500 XP' );
check( 12 === Secura_Progress::level_for_xp( 15000 )['number'], 'niveau 12 à 15 000 XP' );
check( 12 === Secura_Progress::level_for_xp( 999999 )['number'], 'le niveau maximum est plafonné' );
check( null !== Secura_Progress::next_level( Secura_Progress::level_for_xp( 0 ) ), 'le niveau suivant est calculé' );
check( null === Secura_Progress::next_level( Secura_Progress::level_for_xp( 15000 ) ), 'aucun niveau au-delà du maximum' );

/* ---------------------------------------------------------------------
 * Barème
 * ------------------------------------------------------------------ */

echo "\nBarème unifié\n";
check( 10 === Secura_Progress::base_points( 'facile' ), 'base facile : 10 points' );
check( 20 === Secura_Progress::base_points( 'difficile' ), 'base difficile : 20 points' );
check( 0.0 === Secura_Progress::type_multiplier( 'lesson' ), 'une leçon ne rapporte pas de points' );
check( 0.5 === Secura_Progress::type_multiplier( 'practice' ), 'un entraînement rapporte la moitié' );
check( 1.0 === Secura_Progress::type_multiplier( 'test' ), 'un test rapporte la base' );
check( 1.5 === Secura_Progress::type_multiplier( 'exam' ), 'un examen rapporte 1,5 fois la base' );

/* ---------------------------------------------------------------------
 * Attribution des XP
 * ------------------------------------------------------------------ */

echo "\nAttribution des XP\n";
$GLOBALS['securatest_users'] = array();

$award = Secura_Progress::award(
	7,
	array(
		'room_id'    => 42,
		'base_xp'    => 20,
		'difficulty' => 'moyen',
		'type'       => 'test',
	)
);

check( 20 === $award['points'], 'un test verse la base attendue' );
check( 20 === (int) get_user_meta( 7, SECURA_USER_XP, true ), 'le XP total est persisté' );

$award_exam = Secura_Progress::award(
	7,
	array(
		'room_id'    => 42,
		'base_xp'    => 20,
		'difficulty' => 'moyen',
		'type'       => 'exam',
	)
);

check( 30 === $award_exam['points'], 'un examen applique le multiplicateur 1,5' );

$award_hint = Secura_Progress::award(
	7,
	array(
		'room_id'    => 42,
		'base_xp'    => 20,
		'difficulty' => 'moyen',
		'type'       => 'test',
		'hint_used'  => true,
	)
);

check( 10 === $award_hint['points'], 'un indice réduit les points de moitié' );

/* ---------------------------------------------------------------------
 * Indices et verrouillage
 * ------------------------------------------------------------------ */

echo "\nIndices et verrouillage progressif\n";
$GLOBALS['securatest_users'] = array();

$tasks = array(
	array(
		'type'      => 'lesson',
		'questions' => array(),
	),
	array(
		'type'      => 'practice',
		'questions' => array(
			array( 'question' => 'Q1', 'answers' => array( 'A1' ) ),
			array( 'question' => 'Q2', 'answers' => array( 'A2' ) ),
		),
	),
	array(
		'type'      => 'exam',
		'questions' => array(
			array( 'question' => 'Q3', 'answers' => array( 'A3' ) ),
		),
	),
);

check( Secura_Progress::is_task_unlocked( $tasks, 0, array() ), 'la première tâche est toujours ouverte' );
check( ! Secura_Progress::is_task_unlocked( $tasks, 1, array() ), 'la tâche suivante est verrouillée au départ' );

Secura_Progress::mark_hint( 7, 42, 1, 0 );
check( Secura_Progress::hint_used( 7, 42, 1, 0 ), 'l\'usage d\'un indice est mémorisé' );
check( ! Secura_Progress::hint_used( 7, 42, 1, 1 ), 'l\'indice est propre à chaque question' );

Secura_Progress::mark_question( 7, 42, 1, 0 );
Secura_Progress::mark_question( 7, 42, 1, 1 );

$state = Secura_Progress::get_room_state( 7, 42 );

check( Secura_Progress::is_task_done( $tasks[1], $state['tasks']['1'] ), 'la tâche est terminée quand toutes les questions sont résolues' );
check( Secura_Progress::is_task_unlocked( $tasks, 2, $state ), 'la tâche suivante se déverrouille' );

/* ---------------------------------------------------------------------
 * Score et médailles
 * ------------------------------------------------------------------ */

echo "\nScore et médailles\n";
$score = Secura_Progress::compute_score( $tasks, $state );
check( 67 === $score['score'], 'le score pondéré reflète les seules questions résolues' );
check( 1 === $score['hints'], 'les indices utilisés sont comptés' );
check( 'bronze' === Secura_Progress::medal_for( 60, 0 ), 'bronze à 60 %' );
check( 'silver' === Secura_Progress::medal_for( 80, 0 ), 'argent à 80 %' );
check( 'gold' === Secura_Progress::medal_for( 100, 0 ), 'or à 100 %' );
check( 'bronze' === Secura_Progress::medal_for( 100, 1 ), 'un indice fait retomber l\'or ou l\'argent au bronze' );
check( '' === Secura_Progress::medal_for( 50, 0 ), 'aucune médaille en dessous de 60 %' );

$medal = Secura_Progress::add_medal( 7, 'room_42', 'bronze', 65 );
check( $medal['added'], 'une médaille est enregistrée' );
$medal_up = Secura_Progress::add_medal( 7, 'room_42', 'gold', 100 );
check( $medal_up['added'], 'une médaille supérieure remplace la précédente' );
$medal_down = Secura_Progress::add_medal( 7, 'room_42', 'bronze', 65 );
check( ! $medal_down['added'], 'une médaille inférieure est ignorée' );
check( 'gold' === $medal_down['medal'], 'la médaille la plus haute est conservée' );

/* ---------------------------------------------------------------------
 * Examens chronométrés
 * ------------------------------------------------------------------ */

echo "\nExamens chronométrés\n";
$GLOBALS['securatest_users'] = array();

$exam = Secura_Progress::start_exam( 7, 42, 2 );
check( ! empty( $exam['started_at'] ), 'l\'examen démarre avec un horodatage' );
check( ! Secura_Progress::exam_expired( $exam, 10 ), 'un examen frais n\'est pas expiré' );
check( Secura_Progress::exam_expired( array( 'started_at' => time() - 601 ), 10 ), 'un examen dépassé est expiré' );
check( ! Secura_Progress::exam_expired( array( 'started_at' => time() - 601 ), 0 ), 'sans limite, l\'examen n\'expire pas' );

Secura_Progress::finish_exam( 7, 42, 2, 80, true );
$exam_state = Secura_Progress::exam_state( 7, 42, 2 );
check( 80 === (int) $exam_state['score'], 'le score de l\'examen est enregistré' );
check( true === (bool) $exam_state['passed'], 'la réussite est enregistrée' );
check( ! empty( $exam_state['awarded'] ) === false, 'le bonus n\'est pas encore versé' );

Secura_Progress::mark_exam_awarded( 7, 42, 2 );
$exam_state = Secura_Progress::exam_state( 7, 42, 2 );
check( ! empty( $exam_state['awarded'] ), 'le bonus de réussite est marqué' );

$retry = Secura_Progress::start_exam( 7, 42, 2 );
check( ! empty( $retry['awarded'] ), 'une nouvelle tentative conserve le bonus déjà versé' );
check( 80 === (int) $retry['best_score'], 'le meilleur score est conservé' );

/* ---------------------------------------------------------------------
 * Terminal simulé
 * ------------------------------------------------------------------ */

echo "\nTerminal simulé\n";
$GLOBALS['securatest_users'] = array();

$definition = Secura_Terminal::normalize_definition(
	array(
		'intro' => 'user@cible:~$ ',
		'steps' => array(
			array(
				'match'  => array( 'ls', 'ls -la' ),
				'output' => "config.txt\n",
				'hint'   => 'Liste les fichiers.',
			),
			array(
				'match'  => array( '/cat config\\.txt/' ),
				'output' => "FLAG=SECURA{test}\n",
			),
		),
	)
);

check( 2 === count( $definition['steps'] ), 'les étapes du terminal sont normalisées' );
check( Secura_Terminal::matches( 'ls', 'ls' ), 'une correspondance exacte fonctionne' );
check( Secura_Terminal::matches( 'ls', 'LS' ), 'la correspondance ignore la casse' );
check( ! Secura_Terminal::matches( 'ls', 'pwd' ), 'une commande différente est rejetée' );
check( Secura_Terminal::matches( '/cat config\\.txt/', 'cat config.txt' ), 'une expression régulière est prise en charge' );
check( ! Secura_Terminal::matches( '/cat config\\.txt/', 'cat notes.txt' ), 'une expression régulière filtre correctement' );

$task = array( 'terminal' => $definition );

$run = Secura_Terminal::run( 7, 42, 2, $task, 'pwd' );
check( ! $run['matched'], 'une commande inconnue ne progresse pas' );
check( 0 === $run['step'], 'le compteur d\'étapes reste à zéro' );
check( '' !== $run['hint'], 'un indice est proposé après un échec' );

$run = Secura_Terminal::run( 7, 42, 2, $task, 'ls' );
check( $run['matched'], 'la bonne commande est reconnue' );
check( 1 === $run['step'], 'le compteur d\'étapes progresse' );

$run = Secura_Terminal::run( 7, 42, 2, $task, 'cat config.txt' );
check( $run['matched'], 'la seconde étape est atteinte' );
check( 2 === $run['step'], 'le terminal est terminé' );
check( $run['completed'], 'la fin du scénario est signalée' );

/* ---------------------------------------------------------------------
 * Filtre « locale » : il ne doit jamais boucler
 * ------------------------------------------------------------------ */

echo "\nFiltre locale\n";

$GLOBALS['securatest_locale_calls'] = 0;

$filtered = Secura_I18n::filter_locale( 'en_US' );

check( 'en' === $filtered, 'le filtre locale mappe la langue du site sur la liste' );
check( 0 === $GLOBALS['securatest_locale_calls'], 'le filtre locale ne rappelle pas determine_locale (pas de boucle infinie)' );

$GLOBALS['securatest_locale_calls'] = 0;

$current = Secura_I18n::current_lang();

check( 'fr' === $current, 'la langue courante est la langue du site' );
check( $GLOBALS['securatest_locale_calls'] <= 1, 'current_lang consulte la locale au plus une fois' );

$GLOBALS['securatest_locale_calls'] = 0;

$again = Secura_I18n::filter_locale( 'fr_FR' );

check( 'fr' === $again, 'le filtre locale reste stable au second appel' );
check( 0 === $GLOBALS['securatest_locale_calls'], 'le second appel ne redemande pas la locale' );

/* ---------------------------------------------------------------------
 * Multilingue
 * ------------------------------------------------------------------ */

echo "\nMultilingue\n";
check( 3 === count( Secura_I18n::languages() ), 'trois langues sont proposées' );
check( 'rtl' === Secura_I18n::languages()['ar']['dir'], 'l\'arabe est en écriture de droite à gauche' );
check( 'fr' === Secura_I18n::current_lang(), 'le français est la langue par défaut' );

/* ---------------------------------------------------------------------
 * Adresses de langue : chaque version sert VRAIMENT sa langue
 *
 * Regression du 05/11/2026. Deux defauts mesures sur le WordPress reel,
 * installe en anglais :
 *  - la room sans parametre servait l'anglais, mais le theme la
 *    declarait hreflang="fr" et le lien « Francais » pointait vers elle ;
 *  - le selecteur du tableau de bord rechargeait l'adresse courante, ou
 *    « ?seca_lang=ar » gardait la priorite : le choix venait d'etre
 *    enregistre et la page revenait dans l'ancienne langue.
 * ------------------------------------------------------------------ */

echo "\nAdresses de langue\n";

$GLOBALS['securatest_site_locale'] = 'en_US';
$GLOBALS['securatest_queried_id']  = 0;
$_GET = array();

check( 'en' === Secura_I18n::langue_de_url( 'https://exemple.test/rooms/x/' ), 'une adresse nue sert la langue du site (ici l anglais)' );
check( 'fr' === Secura_I18n::langue_de_url( 'https://exemple.test/rooms/x/?seca_lang=fr' ), 'une adresse explicite sert la langue demandee' );
check( 'ar' === Secura_I18n::langue_de_url( 'https://exemple.test/rooms/x/?seca_lang=ar' ), 'l arabe est reconnu dans l adresse' );
check( 'en' === Secura_I18n::langue_de_url( 'https://exemple.test/rooms/x/?seca_lang=xx' ), 'une langue inconnue retombe sur la langue du site' );

$adresses = Secura_I18n::traductions_de_url( 'https://exemple.test/rooms/x/' );

check( 3 === count( $adresses ), 'les trois langues ont une adresse' );
check( 'https://exemple.test/rooms/x/?seca_lang=fr' === $adresses['fr'], 'le francais a une adresse explicite' );
check( 'https://exemple.test/rooms/x/?seca_lang=ar' === $adresses['ar'], 'l arabe a une adresse explicite' );
check( 'https://exemple.test/rooms/x/' === $adresses['en'], 'la langue du site garde l adresse nue (une seule adresse par page)' );
$deux_langues = array();

foreach ( $adresses as $code => $adresse ) {
	if ( $code === Secura_I18n::langue_du_site() ) {
		if ( false !== strpos( $adresse, 'seca_lang' ) ) {
			$deux_langues[] = $adresse;
		}

		continue;
	}

	if ( 1 !== substr_count( $adresse, 'seca_lang' ) || false === strpos( $adresse, 'seca_lang=' . $code ) ) {
		$deux_langues[] = $adresse;
	}
}

check( empty( $deux_langues ), 'chaque adresse porte UNE langue, la sienne : ' . implode( ' | ', $deux_langues ) );

/* Sur un site installe en francais, c'est le francais qui garde
   l'adresse nue : la regle suit la langue du site, elle ne la fixe pas. */
$GLOBALS['securatest_site_locale'] = 'fr_FR';
$adresses_fr = Secura_I18n::traductions_de_url( 'https://exemple.test/rooms/x/' );

check( 'https://exemple.test/rooms/x/' === $adresses_fr['fr'], 'sur un site francais, le francais garde l adresse nue' );
check( 'https://exemple.test/rooms/x/?seca_lang=en' === $adresses_fr['en'], 'sur un site francais, l anglais a son adresse explicite' );
$GLOBALS['securatest_site_locale'] = 'en_US';

$adresse_fr = Secura_I18n::url_pour_langue( 'fr', 'https://exemple.test/rooms/x/?seca_lang=ar' );

check( 'https://exemple.test/rooms/x/?seca_lang=fr' === $adresse_fr, 'changer de langue REMPLACE la langue de l adresse' );
check( 1 === substr_count( $adresse_fr, 'seca_lang' ), 'la nouvelle adresse ne garde pas l ancienne langue' );
check( '' === Secura_I18n::url_pour_langue( 'xx', 'https://exemple.test/' ), 'une langue inconnue ne fabrique pas d adresse' );
check( 'https://exemple.test/rooms/x/' === Secura_I18n::retirer_parametre_langue( 'https://exemple.test/rooms/x/?seca_lang=fr&page=2' ) || 'https://exemple.test/rooms/x/?page=2' === Secura_I18n::retirer_parametre_langue( 'https://exemple.test/rooms/x/?seca_lang=fr&page=2' ), 'retirer la langue garde les autres parametres' );

/* Le choix de la langue par URL reste prioritaire sur la preference
   enregistree : c'est ce que demande un lien explicite. */
$_GET = array( 'seca_lang' => 'ar' );
check( 'ar' === Secura_I18n::forced_lang(), 'le parametre d adresse impose la langue' );

/* Sans parametre, la preference de l'apprenant connecte s'applique. */
$_GET = array();
$GLOBALS['securatest_user']                        = 7;
$GLOBALS['securatest_users'][7][ SECURA_USER_LANG ] = 'fr';
check( 'fr' === Secura_I18n::forced_lang(), 'la preference enregistree s applique quand l adresse n impose rien' );
unset( $GLOBALS['securatest_users'][7][ SECURA_USER_LANG ] );
$GLOBALS['securatest_site_locale'] = 'fr_FR';

/* Regression : « ?lang= » appartient aux plugins multilingues (Polylang
   l'utilise pour ses adresses). Notre parametre a nous est « ?seca_lang= »,
   et « ?lang= » n'est lu que si aucun autre plugin ne s'en sert. */
check( false === Secura_I18n::other_language_plugin(), 'aucun plugin multilingue tiers n est detecte' );

$_GET['seca_lang'] = 'ar';

check( 'ar' === Secura_I18n::forced_lang(), 'notre parametre de langue fonctionne' );

$_GET['lang'] = 'en';

check( 'ar' === Secura_I18n::forced_lang(), 'notre parametre a la priorite sur le parametre classique' );

unset( $_GET['seca_lang'] );

check( 'en' === Secura_I18n::forced_lang(), 'le parametre classique reste accepte quand personne ne le revendique' );

unset( $_GET['lang'] );
check( 'ltr' === Secura_I18n::direction(), 'la direction par défaut est LTR' );

$dictionary = Secura_I18n::dictionary();
check( isset( $dictionary['fr']['dashboard'], $dictionary['ar']['dashboard'], $dictionary['en']['dashboard'] ), 'le dictionnaire couvre les trois langues' );
check( count( $dictionary['fr'] ) === count( $dictionary['ar'] ) && count( $dictionary['fr'] ) === count( $dictionary['en'] ), 'les trois dictionnaires ont le même nombre de clés' );

$translated = Secura_I18n::translate_tasks(
	array(
		array(
			'title'     => 'Task 1',
			'content'   => 'Contenu',
			'questions' => array(
				array(
					'question'    => 'Question ?',
					'hint'        => 'Indice',
					'explanation' => 'Explication',
				),
			),
		),
	),
	array(
		'tasks' => array(
			array(
				'title'     => 'المهمة 1',
				'questions' => array(
					array(
						'question' => 'سؤال ؟',
						'hint'     => 'تلميح',
					),
				),
			),
		),
	),
	'ar'
);

check( 'المهمة 1' === $translated[0]['title'], 'le titre de tâche est traduit' );
check( 'سؤال ؟' === $translated[0]['questions'][0]['question'], 'l\'énoncé est traduit' );
check( 'Explication' === $translated[0]['questions'][0]['explanation'], 'une traduction partielle conserve les valeurs d\'origine' );

/* ---------------------------------------------------------------------
 * Rooms : structure et propreté des données
 * ------------------------------------------------------------------ */

echo "\nStructure des rooms\n";

$GLOBALS['securatest_meta'][ 42 ][ SECURA_META_TASKS ] = array(
	array(
		'type'       => 'lesson',
		'title'      => 'Task 1',
		'content'    => '<p>Leçon</p>',
		'questions'  => array(),
	),
	array(
		'type'       => 'practice',
		'title'      => 'Task 2',
		'content'    => '<p>Entraînement</p>',
		'questions'  => array(
			array( 'question' => 'Q1', 'answers' => array( 'A1' ), 'xp' => 10, 'hint' => 'H', 'explanation' => 'E' ),
			array( 'question' => 'Sans réponse', 'answers' => array(), 'xp' => 10 ),
		),
	),
	array(
		'type'       => 'exam',
		'title'      => 'Task 3',
		'content'    => '<p>Examen</p>',
		'time_limit' => 10,
		'pass_score' => 70,
		'questions'  => array(
			array( 'question' => 'Q3', 'answers' => array( 'A3' ), 'xp' => 20 ),
		),
	),
);

$GLOBALS['securatest_meta'][ 42 ][ SECURA_META_DIFFICULTY ] = 'moyen';
$GLOBALS['securatest_meta'][ 42 ][ SECURA_META_DURATION ]   = 35;
$GLOBALS['securatest_meta'][ 42 ][ SECURA_META_XP_BONUS ]   = 40;

$room_tasks = Secura_Rooms::get_tasks( 42 );
check( 3 === count( $room_tasks ), 'les trois tâches sont relues' );
check( 1 === count( $room_tasks[1]['questions'] ), 'une question sans réponse acceptée est ignorée' );
check( 'moyen' === Secura_Rooms::get_difficulty_key( 42 ), 'la difficulté est normalisée' );
check( 'facile' === Secura_Rooms::get_difficulty_key( 999 ), 'une difficulté inconnue retombe sur facile' );

/* ---------------------------------------------------------------------
 * Parcours
 * ------------------------------------------------------------------ */

echo "\nParcours\n";

$GLOBALS['securatest_meta'][ 10 ][ SECURA_META_PATH_SECTIONS ] = array(
	array( 'title' => 'Module 1', 'rooms' => array( 42, 43 ) ),
	array( 'title' => 'Module 2', 'rooms' => array( '44' ) ),
);

$sections = Secura_Paths::get_sections( 10 );
check( 2 === count( $sections ), 'les sections du parcours sont relues' );
check( 2 === count( $sections[0]['rooms'] ), 'les rooms de la première section sont conservées' );
check( 44 === $sections[1]['rooms'][0], 'un identifiant de room est normalisé en entier' );

/* ---------------------------------------------------------------------
 * Contrat AJAX : aucune réponse attendue ne sort du serveur
 * ------------------------------------------------------------------ */

echo "\nSécurité du canal AJAX\n";

$GLOBALS['securatest_users'] = array();
$GLOBALS['securatest_user'] = 7;

/* Tant que la leçon n'est pas validée, la tâche 1 et l'examen sont verrouillés. */
$_POST = array(
	'nonce'   => 'nonce-de-test',
	'room_id' => 42,
	'task'    => 2,
	'question' => 0,
	'answer'  => 'a3',
);

$payload = capture_json(
	function () {
		Secura_Ajax::validate_answer();
	}
);

check( $payload && false === $payload['ok'], 'une question d\'examen verrouillée est refusée' );
check( isset( $payload['data']['code'] ) && 'locked' === $payload['data']['code'], 'le code d\'erreur indique le verrouillage' );

/* La leçon (tâche 0) doit être validée pour déverrouiller la tâche 1. */
$_POST = array(
	'nonce'   => 'nonce-de-test',
	'room_id' => 42,
	'task'    => 0,
);

capture_json(
	function () {
		Secura_Ajax::complete_lesson();
	}
);

$_POST = array(
	'nonce'   => 'nonce-de-test',
	'room_id' => 42,
	'task'    => 1,
);

$payload = capture_json(
	function () {
		Secura_Ajax::get_task();
	}
);

check( null !== $payload && true === $payload['ok'], 'la tâche est bien servie' );

if ( $payload && is_array( $payload['data'] ) ) {
	$questions = $payload['data']['task']['questions'];

	check( 1 === count( $questions ), 'les questions utiles sont envoyées' );
	check( ! isset( $questions[0]['answers'] ), 'la liste des réponses acceptées n\'est jamais envoyée' );
	check( 'H' === $questions[0]['hint'], 'l\'indice est fourni au client' );
	check( '' === $questions[0]['explanation'], 'l\'explication est masquée avant la réussite' );

	$_POST['reveal'] = '1';

	$revealed = capture_json(
		function () {
			Secura_Ajax::get_task();
		}
	);

	check( '' === $revealed['data']['task']['questions'][0]['explanation'], 'l\'explication reste masquée tant que la tâche n\'est pas finie' );
}

unset( $_POST['reveal'] );

$_POST = array(
	'nonce'   => 'nonce-de-test',
	'room_id' => 42,
	'task'    => 1,
	'question' => 0,
	'answer'  => 'mauvaise réponse',
);

$payload = capture_json(
	function () {
		Secura_Ajax::validate_answer();
	}
);

check( $payload && true === $payload['ok'] && false === $payload['data']['correct'], 'une réponse incorrecte est refusée' );
check( 0 === (int) get_user_meta( 7, SECURA_USER_XP, true ), 'une réponse incorrecte ne verse aucun XP' );

$_POST['answer'] = 'a1';

$payload = capture_json(
	function () {
		Secura_Ajax::validate_answer();
	}
);

check( $payload && true === $payload['ok'] && true === $payload['data']['correct'], 'une réponse correcte est acceptée' );
check( '' !== $payload['data']['explanation'], 'l\'explication est révélée après la réussite' );
check( $payload['data']['points'] > 0, 'des points sont gagnés' );

$xp_after = (int) get_user_meta( 7, SECURA_USER_XP, true );

$_POST['answer'] = 'a1';

$payload = capture_json(
	function () {
		Secura_Ajax::validate_answer();
	}
);

check( true === $payload['data']['already'], 'une question déjà validée est signalée' );
check( $xp_after === (int) get_user_meta( 7, SECURA_USER_XP, true ), 'revalider ne redonne pas de XP' );

$_POST = array(
	'nonce'   => 'nonce-de-test',
	'room_id' => 42,
	'task'    => 1,
	'question' => 0,
);

$payload = capture_json(
	function () {
		Secura_Ajax::hint();
	}
);

check( $payload && true === $payload['ok'], 'un indice peut être demandé' );
check( Secura_Progress::hint_used( 7, 42, 1, 0 ), 'l\'indice demandé est mémorisé côté serveur' );

/* L'examen est désormais accessible : la tâche précédente est terminée. */

/* Mais une reponse ne demarre JAMAIS le chronometre : sans start_exam,
   le serveur refuse (409 « exam_not_started »). C'est ce qui garantit
   que le temps accorde est celui du chronometre que l'eleve a vu. */
$_POST = array(
	'nonce'   => 'nonce-de-test',
	'room_id' => 42,
	'task'    => 2,
	'question' => 0,
	'answer'  => 'a3',
);

$payload = capture_json(
	function () {
		Secura_Ajax::validate_answer();
	}
);

check( $payload && false === $payload['ok'] && 'exam_not_started' === $payload['data']['code'], 'une reponse d examen sans chronometre est refusee' );
check( null === Secura_Progress::exam_state( 7, 42, 2 ), 'le refus ne cree pas de chronometre dans le dos de l eleve' );

$_POST = array(
	'nonce'   => 'nonce-de-test',
	'room_id' => 42,
	'task'    => 2,
);

/* Les QUESTIONS non plus ne sortent pas avant le chronometre. */
$_POST = array(
	'nonce'   => 'nonce-de-test',
	'room_id' => 42,
	'task'    => 2,
);

$payload = capture_json(
	function () {
		Secura_Ajax::get_task();
	}
);

check( $payload && false === $payload['ok'] && 'exam_not_started' === $payload['data']['code'], 'un examen non ouvert ne livre pas ses questions' );

/* Le chronometre ne se lance pas sur une tache qui n'est pas un examen. */
$_POST = array(
	'nonce'   => 'nonce-de-test',
	'room_id' => 42,
	'task'    => 1,
);

$payload = capture_json(
	function () {
		Secura_Ajax::start_exam();
	}
);

check( $payload && false === $payload['ok'] && 'not_an_exam' === $payload['data']['code'], 'pas de chronometre sur une tache qui n est pas un examen' );

/* Le chronometre ne se lance pas sur un examen encore verrouille. */
$_POST = array(
	'nonce'   => 'nonce-de-test',
	'room_id' => 42,
	'task'    => 9,
);

$payload = capture_json(
	function () {
		Secura_Ajax::start_exam();
	}
);

check( $payload && false === $payload['ok'], 'une tache inexistante ne demarre aucun chronometre (' . ( isset( $payload['data']['code'] ) ? $payload['data']['code'] : 'sans code' ) . ')' );

$_POST = array(
	'nonce'   => 'nonce-de-test',
	'room_id' => 42,
	'task'    => 2,
);

$payload = capture_json(
	function () {
		Secura_Ajax::start_exam();
	}
);

check( $payload && true === $payload['ok'] && $payload['data']['time_left'] > 0, 'le chronometre demarre a l ouverture de l examen' );

$_POST = array(
	'nonce'   => 'nonce-de-test',
	'room_id' => 42,
	'task'    => 2,
	'question' => 0,
	'answer'  => 'a3',
);

$payload = capture_json(
	function () {
		Secura_Ajax::validate_answer();
	}
);

check( $payload && true === $payload['ok'] && true === $payload['data']['correct'], 'l\'examen est accessible une fois la tâche précédente terminée' );
check( ! empty( $payload['data']['exam'] ), 'la clôture d\'examen est calculée' );
check( 100 === (int) $payload['data']['exam']['score'], 'le score de l\'examen vaut 100 %' );
check( true === (bool) $payload['data']['exam']['passed'], 'l\'examen est réussi' );
check( 'gold' === $payload['data']['exam']['medal'], 'une médaille est attribuée à l\'examen réussi' );

/* ---------------------------------------------------------------------
 * Le moteur d'épreuves : deux élèves, deux copies
 * --------------------------------------------------------------------- */

echo "\nLe moteur d'épreuves\n";

/* Une question paramétrique : les chiffres sont des {mots}, le moteur
   tire un jeu de valeurs par copie. */
$question_parametrique = array(
	'question'    => 'Un serveur ecoute sur le port {port}. Combien de connexions ?',
	'mode'        => 'choice',
	'choices'     => array( '{port} connexions', '10 connexions', '80 connexions' ),
	'correct'     => 0,
	'variants'    => array(
		array( 'port' => '8080' ),
		array( 'port' => '9090' ),
		array( 'port' => '8443' ),
	),
	'explanation' => 'Le port {port} est celui du serveur de test.',
);

$variante_a = Secura_Exam::variante( $question_parametrique, 12345 );
$variante_b = Secura_Exam::variante( $question_parametrique, 54321 );

check( false === strpos( $variante_a['question'], '{port}' ), 'la valeur du {mot} est injectée dans l\'énoncé' );
check( false === strpos( $variante_a['explanation'], '{port}' ), 'la valeur du {mot} est injectée dans l\'explication' );
check( false === strpos( $variante_a['choices'][0], '{port}' ), 'la valeur du {mot} est injectée dans les propositions' );
check( $variante_a['question'] !== $variante_b['question'] || $variante_a['choices'] !== $variante_b['choices'], 'deux tirages ne donnent pas la même copie' );

/* La bonne réponse suit la proposition melangee. */
$variante_c = Secura_Exam::variante(
	array(
		'question' => 'Q',
		'mode'     => 'choice',
		'choices'  => array( 'A', 'B', 'C', 'D' ),
		'correct'  => 0,
	),
	987
);

check( 'A' === $variante_c['choices'][ (int) $variante_c['correct'] ], 'la bonne réponse reste la bonne après le mélange' );
check( $variante_c['choices'] !== array( 'A', 'B', 'C', 'D' ), 'les propositions sont mélangées' );

/* Une question de drapeau reste dans sa room : elle ne voyage pas. */
$GLOBALS['securatest_meta'][ 45 ][ SECURA_META_TASKS ] = array(
	array(
		'type'      => 'exam',
		'title'     => 'Task 1',
		'content'   => '<p>Examen</p>',
		'questions' => array(
			array( 'question' => 'Drapeau', 'mode' => 'flag', 'flag_path' => '/root/flags/x.txt', 'xp' => 30 ),
		),
	),
);

$drapeaux_chez_elle = 0;
$drapeaux_ailleurs  = 0;

foreach ( Secura_Exam::pool( 45, array( 'exam' ) ) as $entree ) {
	if ( 'flag' === $entree['question']['mode'] ) {
		$drapeaux_chez_elle++;
	}
}

foreach ( Secura_Exam::pool( 42, array( 'exam' ) ) as $entree ) {
	if ( 'flag' === $entree['question']['mode'] ) {
		$drapeaux_ailleurs++;
	}
}

check( 1 === $drapeaux_chez_elle, 'la question de drapeau est dans le réservoir de SA room' );
check( 0 === $drapeaux_ailleurs, 'une question de drapeau ne voyage pas dans une autre room' );

/* Un examen avec plusieurs questions et plusieurs propositions : c'est
   le cas reel (les examens de la plateforme ont de 2 a 10 questions). */
$GLOBALS['securatest_meta'][ 42 ][ SECURA_META_TASKS ][2]['questions'] = array(
	array(
		'question' => 'E1',
		'mode'     => 'choice',
		'choices'  => array( 'a1', 'a2', 'a3', 'a4' ),
		'correct'  => 1,
		'xp'       => 20,
	),
	array(
		'question' => 'E2',
		'mode'     => 'choice',
		'choices'  => array( 'b1', 'b2', 'b3', 'b4' ),
		'correct'  => 2,
		'xp'       => 20,
	),
	array(
		'question' => 'E3',
		'mode'     => 'choice',
		'choices'  => array( 'c1', 'c2', 'c3', 'c4' ),
		'correct'  => 3,
		'xp'       => 20,
	),
);

/* Deux eleves, deux copies ; le meme eleve, la meme copie. */
$examen_room = 42;
$examen_task = 2;
$examen_tasks = Secura_Rooms::get_tasks( $examen_room );

$copie_eleve_1 = Secura_Exam::paper( 101, $examen_room, $examen_task, $examen_tasks[ $examen_task ] );
$copie_eleve_2 = Secura_Exam::paper( 102, $examen_room, $examen_task, $examen_tasks[ $examen_task ] );
$copie_eleve_1_bis = Secura_Exam::paper( 101, $examen_room, $examen_task, $examen_tasks[ $examen_task ] );

$empreinte = function ( $questions ) {
	$texte = '';

	foreach ( $questions as $question ) {
		$texte .= $question['question'] . '|' . implode( '/', (array) $question['choices'] ) . '##';
	}

	return md5( $texte );
};

check( $empreinte( $copie_eleve_1 ) !== $empreinte( $copie_eleve_2 ), 'deux élèves ne reçoivent pas la même copie' );
check( $empreinte( $copie_eleve_1 ) === $empreinte( $copie_eleve_1_bis ), 'recharger redonne la même copie' );
check( ! empty( $copie_eleve_1 ), 'la copie d\'examen n\'est pas vide' );

/* La copie interne garde les reponses attendues : c'est le serveur qui
   corrige. Ce qui ne doit JAMAIS sortir, c'est la copie envoyee au
   navigateur — verifie plus haut, dans la section AJAX. */
check( ! empty( $copie_eleve_1[0]['choices'] ), 'la copie interne conserve les propositions (le serveur corrige)' );

/* Le reservoir d'un examen est le niveau entier.
   On prend deux rooms neuves (77 et 78) : le moteur garde en memoire
   le niveau de chaque room, et l'on veut une mesure fraiche. */
foreach ( array( 77, 78 ) as $numero ) {
	$GLOBALS['securatest_meta'][ $numero ][ SECURA_META_TASKS ] = array(
		array(
			'type'      => 'exam',
			'title'     => 'Task 1',
			'content'   => '<p>Examen</p>',
			'questions' => array(
				array(
					'question' => 'F' . $numero,
					'mode'     => 'choice',
					'choices'  => array( 'f1', 'f2', 'f3', 'f4' ),
					'correct'  => 0,
					'xp'       => 20,
				),
			),
		),
	);
}

$parcours = new stdClass();
$parcours->ID         = 10;
$parcours->post_type  = SECURA_PATH_POST_TYPE;
$parcours->post_title = 'Fondations';

$GLOBALS['securatest_posts'][10]  = $parcours;
$GLOBALS['securatest_post_lists'] = array( 10 => $parcours );
$GLOBALS['securatest_meta'][ 10 ][ SECURA_META_PATH_SECTIONS ] = array(
	array( 'title' => 'Module 1', 'rooms' => array( 77, 78 ) ),
);

$pool_section = Secura_Exam::pool( 77, array( 'exam' ) );
$rooms_du_pool = array();

foreach ( $pool_section as $entree ) {
	$rooms_du_pool[ $entree['room'] ] = true;
}

check( isset( $rooms_du_pool[78] ), 'le réservoir d\'un examen contient les rooms du niveau' );
check( 2 === count( $rooms_du_pool ), 'le réservoir couvre les deux rooms du niveau' );


/* ---------------------------------------------------------------------
 * Contenu de démonstration
 * ------------------------------------------------------------------ */

echo "\nContenu de démonstration\n";

require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/default-content.php';

$rooms = seca_default_rooms();
check( 6 === count( $rooms ), 'six rooms de démonstration sont fournies' );

$structure_ok = true;

foreach ( $rooms as $room ) {
	$types = array();

	foreach ( $room['tasks'] as $task ) {
		$types[] = $task['type'];
	}

	if ( array( 'lesson', 'practice', 'test', 'exam' ) !== $types ) {
		$structure_ok = false;
	}

	foreach ( $room['tasks'] as $task ) {
		foreach ( $task['questions'] as $question ) {
			$mode = isset( $question['mode'] ) ? $question['mode'] : 'text';

			if ( 'action' === $mode ) {
				if ( empty( $question['explanation'] ) ) {
					$structure_ok = false;
				}

				continue;
			}

			if ( 'choice' === $mode ) {
				if ( empty( $question['choices'] ) || (int) $question['correct'] < 0 || empty( $question['explanation'] ) ) {
					$structure_ok = false;
				}

				continue;
			}

			if ( empty( $question['answers'] ) || empty( $question['explanation'] ) ) {
				$structure_ok = false;
			}
		}
	}
}

check( $structure_ok, 'chaque room suit le patron leçon → entraînement → test → examen avec réponses et explications' );
check( isset( $rooms[0]['i18n']['ar'], $rooms[0]['i18n']['en'] ), 'chaque room propose une traduction arabe et anglaise' );
check( isset( $rooms[1]['tasks'][2]['terminal']['steps'] ), 'une room embarque un terminal simulé' );

/* ---------------------------------------------------------------------
 * Types de question : reponse libre, choix multiple, sans reponse
 * ------------------------------------------------------------------ */

echo "\nTypes de question\n";

$GLOBALS['securatest_meta'][ 43 ][ SECURA_META_TASKS ] = array(
	array(
		'type'       => 'practice',
		'title'      => 'Task 1',
		'content'    => '<p>Pratique</p>',
		'questions'  => array(
			array( 'question' => 'Question a choix', 'mode' => 'choice', 'choices' => array( 'Bonne', 'Mauvaise' ), 'correct' => 0, 'xp' => 10, 'hint' => 'H', 'explanation' => 'E' ),
			array( 'question' => 'Action a faire', 'mode' => 'action', 'xp' => 10, 'hint' => 'H', 'explanation' => 'E' ),
			array( 'question' => 'Question texte', 'answers' => array( 'Reponse' ), 'xp' => 10, 'hint' => 'H', 'explanation' => 'E' ),
		),
	),
);

$tasks_modes = Secura_Rooms::get_tasks( 43 );

check( 3 === count( $tasks_modes[0]['questions'] ), 'les trois types de question sont conserves' );
check( 'choice' === $tasks_modes[0]['questions'][0]['mode'], 'le mode choix multiple est relu' );
check( 2 === count( $tasks_modes[0]['questions'][0]['choices'] ), 'les choix sont relus' );
check( 0 === (int) $tasks_modes[0]['questions'][0]['correct'], 'la bonne reponse est conservee cote serveur' );
check( 'action' === $tasks_modes[0]['questions'][1]['mode'], 'le mode sans reponse est relu' );
check( empty( $tasks_modes[0]['questions'][1]['answers'] ), 'une question sans reponse n\'attend aucune reponse' );
check( 'text' === $tasks_modes[0]['questions'][2]['mode'], 'le mode reponse libre est le defaut' );

/* Le client recoit le mode et les choix, jamais la bonne reponse. */
$_POST = array(
	'nonce'   => 'nonce-de-test',
	'room_id' => 43,
	'task'    => 0,
);

$payload_modes = capture_json(
	function () {
		Secura_Ajax::get_task();
	}
);

if ( $payload_modes && is_array( $payload_modes['data'] ) ) {
	$sent = $payload_modes['data']['task']['questions'];

	check( ! isset( $sent[0]['answers'] ) && ! isset( $sent[0]['correct'] ), 'la bonne reponse n\'est jamais envoyee au client' );
	check( 'choice' === $sent[0]['mode'] && 2 === count( $sent[0]['choices'] ), 'le mode et les choix sont envoyes au client' );
	check( 'action' === $sent[1]['mode'], 'le mode sans reponse est envoye au client' );
}

/* Une question a choix n\'accepte que la bonne proposition. */
$_POST = array(
	'nonce'   => 'nonce-de-test',
	'room_id' => 43,
	'task'    => 0,
	'question' => 0,
	'answer'  => 'Mauvaise',
);

$bad_choice = capture_json(
	function () {
		Secura_Ajax::validate_answer();
	}
);

check( $bad_choice && true === $bad_choice['ok'] && false === $bad_choice['data']['correct'], 'un mauvais choix est refuse' );

$_POST['answer'] = 'Bonne';

$good_choice = capture_json(
	function () {
		Secura_Ajax::validate_answer();
	}
);

check( $good_choice && true === $good_choice['ok'] && true === $good_choice['data']['correct'], 'le bon choix est accepte' );

/* Une question sans reponse se valide en confirmant l\'action. */
$_POST = array(
	'nonce'   => 'nonce-de-test',
	'room_id' => 43,
	'task'    => 0,
	'question' => 1,
	'answer'  => 'done',
);

$action_ok = capture_json(
	function () {
		Secura_Ajax::validate_answer();
	}
);

check( $action_ok && true === $action_ok['ok'] && true === $action_ok['data']['correct'], 'une question sans reponse se valide en confirmant l\'action' );
check( $action_ok && $action_ok['data']['points'] > 0, 'la confirmation d\'action rapporte des XP' );

/* ---------------------------------------------------------------------
 * Certificat de parcours
 * ------------------------------------------------------------------ */

echo "\nCertificat de parcours\n";

$path_post = new stdClass();

$path_post->ID           = 10;
$path_post->post_type    = SECURA_PATH_POST_TYPE;
$path_post->post_title   = 'Fondations';
$path_post->post_excerpt = 'Parcours de démonstration';
$path_post->post_content = 'Contenu';
$path_post->post_name    = 'fondations';

$GLOBALS['securatest_posts'][10]     = $path_post;
$GLOBALS['securatest_post_lists']    = array( 10 => $path_post );
$GLOBALS['securatest_meta'][10][ SECURA_META_PATH_SECTIONS ] = array(
	array( 'title' => 'Module 1', 'rooms' => array( 42 ) ),
);
$GLOBALS['securatest_meta'][10][ SECURA_META_DIFFICULTY ]    = 'facile';
$GLOBALS['securatest_meta'][10][ SECURA_META_DURATION ]      = 60;
$GLOBALS['securatest_meta'][10][ SECURA_META_XP_BONUS ]      = 100;
$GLOBALS['securatest_meta'][10][ '_secura_certificate' ]    = 1;

$GLOBALS['securatest_users'] = array();

check( null === Secura_Paths::get_certificate( 7, 10 ), 'aucun certificat tant que le parcours n\'est pas terminé' );

Secura_Progress::save_room_state(
	7,
	42,
	array(
		'tasks'      => array( '0' => array( 'solved' => array( '0' => true ), 'hints' => array(), 'done' => true ) ),
		'completed'  => true,
		'best_score' => 100,
		'medal'      => 'gold',
	)
);

$certificate = Secura_Paths::get_certificate( 7, 10 );

check( is_array( $certificate ), 'un certificat est délivré une fois le parcours terminé' );
check( 'Nadia Benali' === $certificate['name'], 'le certificat porte le nom de l\'apprenant' );
check( 'Fondations' === $certificate['title'], 'le certificat porte le titre du parcours' );
check( 1 === (int) $certificate['rooms'], 'le certificat compte les rooms validées' );
check( 40 === (int) $certificate['xp'], 'le certificat totalise les bonus XP des rooms du parcours' );
check( 1 === count( Secura_Paths::get_certificates( 7 ) ), 'le certificat est listé dans les certificats' );

$GLOBALS['securatest_meta'][10][ '_secura_certificate' ] = 0;
check( null === Secura_Paths::get_certificate( 7, 10 ), 'aucun certificat si l\'option est désactivée sur le parcours' );

/* ---------------------------------------------------------------------
 * Validation croisée : QCM de validation + test pratique à réussir
 * ------------------------------------------------------------------ */

echo "\nValidation croisée : QCM et test pratique\n";

$task_seuil = array(
	'type'       => 'test',
	'format'     => 'mixte',
	'pass_score' => 60,
	'questions'  => array(
		array( 'question' => 'Question 1', 'answers' => array( 'A' ), 'xp' => 10 ),
		array( 'question' => 'Question 2', 'answers' => array( 'A' ), 'xp' => 10 ),
		array( 'question' => 'Question 3', 'answers' => array( 'A' ), 'xp' => 10 ),
	),
);

$state_deux = array(
	'solved' => array( '0' => true, '1' => true ),
	'hints'  => array(),
);

check( 67 === Secura_Progress::task_score( $task_seuil, $state_deux ), 'le score de la tâche est calculé en pourcentage' );
check( 60 === Secura_Progress::task_threshold( $task_seuil ), 'le seuil de passage est lu depuis la tâche' );
check( Secura_Progress::is_task_done( $task_seuil, $state_deux ), 'le seuil de 60 % valide la tâche à 67 %' );
check( ! Secura_Progress::is_task_done( $task_seuil, array( 'solved' => array( '0' => true ), 'hints' => array() ) ), 'une tâche sous le seuil reste à faire' );

$task_strict = $task_seuil;
$task_strict['pass_score'] = 0;

check( 100 === Secura_Progress::task_threshold( $task_strict ), 'sans seuil explicite, le seuil retombe à 100 %' );
check( ! Secura_Progress::is_task_done( $task_strict, $state_deux ), 'sans seuil, toutes les questions sont exigées' );
check( Secura_Progress::is_task_done( $task_strict, array( 'solved' => array( '0' => true, '1' => true, '2' => true ), 'hints' => array() ) ), 'sans seuil, 100 % valide la tâche' );

$task_pratique = array(
	'type'      => 'test',
	'format'    => 'pratique',
	'questions' => array(),
	'terminal'  => array(
		'steps' => array(
			array( 'match' => array( 'ls' ), 'output' => 'notes.txt' ),
		),
	),
);

check( ! Secura_Progress::is_task_done( $task_pratique, array() ), 'un test pratique sans scénario joué reste à faire' );
check( Secura_Progress::is_task_done( $task_pratique, array( 'terminal_done' => true ) ), 'le scénario du terminal valide le test pratique' );

/* Réservation atomique d'une question. */

$GLOBALS['securatest_users'] = array();

check( Secura_Progress::claim_question( 55, 900, 0, 0 ), 'une question peut être réservée une première fois' );
check( ! Secura_Progress::claim_question( 55, 900, 0, 0 ), 'une question déjà résolue ne peut pas être réservée deux fois' );
check( Secura_Progress::claim_question( 55, 900, 0, 1 ), 'une autre question de la même tâche reste réservable' );

/* Reprise d'un examen raté. */

$exam = Secura_Progress::start_exam( 55, 900, 0 );
check( ! empty( $exam['started_at'] ), 'un examen démarre et horodate le début' );

$exams = get_user_meta( 55, SECURA_USER_EXAMS, true );
$exams[ Secura_Progress::exam_key( 900, 0 ) ]['finished_at'] = time();
$exams[ Secura_Progress::exam_key( 900, 0 ) ]['passed']      = false;
update_user_meta( 55, SECURA_USER_EXAMS, $exams );

$exam = Secura_Progress::start_exam( 55, 900, 0 );
check( 0 === (int) $exam['finished_at'], 'un examen raté peut être relancé automatiquement' );
check( ! empty( $exam['started_at'] ), 'la relance relance le chronomètre' );

$exams = get_user_meta( 55, SECURA_USER_EXAMS, true );
$exams[ Secura_Progress::exam_key( 900, 0 ) ]['finished_at'] = time();
$exams[ Secura_Progress::exam_key( 900, 0 ) ]['passed']      = true;
update_user_meta( 55, SECURA_USER_EXAMS, $exams );

$exam = Secura_Progress::start_exam( 55, 900, 0 );
check( ! empty( $exam['finished_at'] ), 'un examen réussi n\'est pas relancé automatiquement' );

$exam = Secura_Progress::start_exam( 55, 900, 0, true );
check( 0 === (int) $exam['finished_at'], 'un examen réussi peut être repassé sur demande explicite' );

/* Formats de tâches. */

check( in_array( 'lecon', array_keys( Secura_Rooms::task_formats() ), true ), 'le format leçon est proposé' );
check( 'lecon' === Secura_Rooms::default_format( 'lesson' ), 'une tâche de leçon est formatée leçon' );
check( 'mixte' === Secura_Rooms::default_format( 'test', $task_pratique['terminal'] ), 'un test avec terminal est formaté mixte' );
check( 'qcm' === Secura_Rooms::default_format( 'exam' ), 'un examen est formaté QCM' );

$rooms_demo = seca_default_rooms();
$formats_ok = true;
$mixte      = 0;
$terminals  = 0;

foreach ( $rooms_demo as $room ) {
	foreach ( $room['tasks'] as $task ) {
		if ( ! in_array( $task['format'], array( 'lecon', 'qcm', 'pratique', 'mixte' ), true ) ) {
			$formats_ok = false;
		}

		if ( 'mixte' === $task['format'] ) {
			$mixte++;
		}

		if ( ! empty( $task['terminal']['steps'] ) ) {
			$terminals++;
		}
	}
}

check( $formats_ok, 'chaque tâche du contenu de démonstration expose un format connu' );
check( 6 === $mixte, 'chaque room de démonstration propose un test pratique mixte' );
check( 6 === $terminals, 'chaque room de démonstration embarque un terminal jouable' );

/* Limitation de débit sur la validation. */

$GLOBALS['securatest_transients'] = array();
$GLOBALS['securatest_users']      = array();

for ( $i = 0; $i < 40; $i++ ) {
	capture_json(
		function () {
			Secura_Ajax::validate_answer();
		}
	);
}

$throttled = capture_json(
	function () {
		Secura_Ajax::validate_answer();
	}
);

check( ! $throttled['ok'], 'la validation est refusée au-delà du quota' );
check( 'slow_down' === ( isset( $throttled['data']['code'] ) ? $throttled['data']['code'] : '' ), 'le refus indique un ralentissement' );

/* Schéma de progression. */

check( 2 === Secura_Progress::schema_version(), 'le schéma de progression est versionné' );

$GLOBALS['securatest_users'] = array();

update_user_meta(
	66,
	SECURA_USER_PROGRESS,
	array(
		'42' => array(
			'solved' => array( '0' => true, '1' => true ),
			'completed' => true,
		),
	)
);

$migrated = Secura_Progress::migrate_progress( get_user_meta( 66, SECURA_USER_PROGRESS, true ) );

check( isset( $migrated['__schema'] ) && 2 === (int) $migrated['__schema'], 'une progression ancienne est migrée vers le schéma courant' );
check( isset( $migrated['42']['tasks'][0]['solved']['0'] ), 'la migration conserve les questions résolues' );
check( isset( $migrated['42']['tasks'][0]['terminal_done'] ), 'la migration ajoute le statut du terminal' );
check( 2 === (int) Secura_Progress::get_state( 66 )['schema'], 'l\'état exposé porte la version du schéma' );

/* Lab réel : manifeste, politique de commandes, repli automatique. */

echo "\nLab réel (machine déployable)\n";

$manifest = Secura_Lab::normalize_manifest(
	array(
		'enabled' => 1,
		'driver'  => 'docker',
		'image'   => 'securalabs/web-01:1.0',
		'target'  => 'http://web:8080',
		'ttl'     => 600,
	)
);

check( $manifest['enabled'], 'le manifeste active la machine cible' );
check( 'docker' === $manifest['driver'], 'le manifeste conserve le pilote demandé' );
check( 'securalabs/web-01:1.0' === $manifest['image'], 'le manifeste conserve l\'image' );
check( 600 === (int) $manifest['ttl'], 'le manifeste conserve la durée de vie' );
check( 3600 === Secura_Lab::normalize_manifest( array() )['ttl'], 'la durée de vie par défaut est d\'une heure' );

$manifest_vide = Secura_Lab::normalize_manifest( array( 'enabled' => 1, 'driver' => 'docker' ) );
check( ! $manifest_vide['enabled'], 'un lab sans image est désactivé automatiquement' );

$manifest_compose = Secura_Lab::normalize_manifest( array( 'enabled' => 1, 'mode' => 'compose', 'compose' => '/labs/web.yml' ) );
check( ! $manifest_compose['enabled'], 'un lab compose sans service est désactivé automatiquement' );

check( 'simulated' === Secura_Lab::resolve_driver( 1 ), 'une room sans lab reste en simulation' );

$driver_auto = Secura_Lab::resolve_driver( 1 );
check( in_array( $driver_auto, array( 'docker', 'simulated' ), true ), 'le pilote automatique aboutit à un pilote connu' );

check( 'seca_lab_7_42' === Secura_Lab::container_name( 7, 42 ), 'le nom du conteneur encode l\'apprenant et la room' );

$policy = Secura_Lab::normalize_manifest(
	array(
		'enabled' => 1,
		'image'   => 'x:1',
		'allow'   => "ls\ncat\ngrep",
		'deny'    => "rm",
	)
);

check( Secura_Lab::command_allowed( 'ls -la', $policy ), 'une commande de la liste blanche est autorisée' );
check( ! Secura_Lab::command_allowed( 'python3 -c "print(1)"', $policy ), 'une commande hors liste blanche est refusée' );
check( ! Secura_Lab::command_allowed( 'rm -rf /', $policy ), 'une commande explicitement bloquée est refusée' );
check( ! Secura_Lab::command_allowed( 'docker ps', $policy ), 'une commande d\'évasion de conteneur est bloquée par défaut' );
check( ! Secura_Lab::command_allowed( 'sudo cat /etc/shadow', $policy ), 'la montée de privilèges est bloquée par défaut' );
check( ! Secura_Lab::command_allowed( '', $policy ), 'une commande vide est refusée' );

$policy_libre = Secura_Lab::normalize_manifest( array( 'enabled' => 1, 'image' => 'x:1' ) );
check( Secura_Lab::command_allowed( 'nmap -sS 10.0.0.5', $policy_libre ), 'sans liste blanche, les outils du lab restent utilisables' );
check( ! Secura_Lab::command_allowed( 'nsenter -t 1 -m -- sh', $policy_libre ), 'les commandes noyau sont bloquées même sans liste blanche' );

check( "a\nb" === Secura_Lab::sanitize_output( "\x1b[32ma\x1b[0m\nb" ), 'les séquences ANSI sont retirées de la sortie' );
check( strlen( Secura_Lab::sanitize_output( str_repeat( 'a', 20000 ) ) ) < 9000, 'la sortie est tronquée' );

$status = Secura_Lab::status( 7, 42 );
check( ! $status['enabled'], 'une room sans lab n\'a pas de machine déployable' );
check( 'simulated' === $status['state'] || 'idle' === $status['state'], 'le statut d\'un lab absent est neutre' );

/* ---------------------------------------------------------------------
 * Isolation des labs : un reseau et une pile par apprenant
 * ------------------------------------------------------------------ */

echo "\nIsolation des labs\n";

$manifest_lab = array(
	'enabled' => 1,
	'driver'  => 'docker',
	'mode'    => 'compose',
	'compose' => 'net-01/docker-compose.yml',
	'project' => 'seca_net01',
	'network' => 'seca_lab',
	'service' => 'attacker',
	'ttl'     => 3600,
);

check( 'seca_lab_5_42' === Secura_Lab::network_name( 5, 42, $manifest_lab ), 'le reseau est unique par apprenant et par room' );
check( 'seca_net01_5_42' === Secura_Lab::project_name( 5, 42, $manifest_lab ), 'le projet Compose est unique par apprenant et par room' );
check( 'seca_net01_5_42' !== Secura_Lab::project_name( 6, 42, $manifest_lab ), 'deux apprenants ne partagent pas la meme pile' );
check( 'seca_lab_5_42' !== Secura_Lab::network_name( 6, 42, $manifest_lab ), 'deux apprenants ne partagent pas le meme reseau' );

$compose_line = Secura_Lab::compose_command( $manifest_lab, array( 'up', '-d' ), 5, 42 );

check( in_array( '-p', $compose_line, true ), 'la commande Compose impose un projet' );
check( in_array( 'seca_net01_5_42', $compose_line, true ), 'le projet impose porte le apprenant et la room' );

$compose_env = Secura_Lab::compose_env( 5, 42, $manifest_lab );

check( '5' === $compose_env['SECA_LAB_USER'], 'les variables Compose portent l apprenant' );
check( '42' === $compose_env['SECA_LAB_ROOM'], 'les variables Compose portent la room' );
check( 'seca_net01_5_42' === $compose_env['SECA_LAB_PROJECT'], 'les variables Compose portent le projet' );

check( false !== strpos( Secura_Lab::resolve_path( 'net-01/docker-compose.yml' ), 'net-01/docker-compose.yml' ), 'un chemin relatif est resolu' );
/* La commande de demarrage est verifiee champ par champ. */
$single = Secura_Lab::normalize_manifest(
	array(
		'enabled' => 1,
		'driver'  => 'docker',
		'mode'    => 'single',
		'image'   => 'securalabs/web-01:1.0',
		'command' => 'sleep infinity',
		'network' => 'seca_lab',
		'ttl'     => 3600,
	)
);

$line = Secura_Lab::container_command( 5, 42, $single );
$text = implode( ' ', $line );

check( false !== strpos( $text, '--name seca_lab_5_42' ), 'le conteneur est nomme par apprenant et room' );
check( false !== strpos( $text, '--network seca_lab_5_42' ), 'le conteneur est branche sur le reseau de l apprenant' );
check( false === strpos( $text, '--network seca_lab ' ), 'le conteneur n est jamais sur le reseau partage' );
check( false !== strpos( $text, '--cap-drop ALL' ), 'le conteneur est sans privileges' );
check( false !== strpos( $text, 'no-new-privileges' ), 'le conteneur bloque la montee de privileges' );
check( false !== strpos( $text, '--tmpfs /tmp:rw,noexec,nosuid' ), 'le repertoire temporaire est inoffensif' );
check( false !== strpos( $text, '--pids-limit' ) && false !== strpos( $text, '--memory' ), 'les ressources sont limitees' );

/* La commande du manifeste est une chaine : Docker attend une liste. */
check( in_array( 'sleep', $line, true ) && in_array( 'infinity', $line, true ), 'la commande du manifeste est decoupee en arguments' );
check( ! in_array( 'sleep infinity', $line, true ), 'la commande n est jamais un argument unique (le conteneur s arreterait aussitot)' );

check( '/opt/labs/x.yml' === Secura_Lab::resolve_path( '/opt/labs/x.yml' ), 'un chemin absolu est conserve' );

/* Regression : le reseau dedie doit etre cree AVANT la machine. Docker ne
   cree pas de reseau sur demande, donc « docker run --network ... »
   echouerait si le reseau manquait. Un faux « docker » journalise les
   commandes et permet de verifier l'ordre. */
$fake_dir  = sys_get_temp_dir() . '/seca_docker_fake';
$log_file  = $fake_dir . '/commands.log';
$fake_bin  = $fake_dir . '/docker';

if ( ! is_dir( $fake_dir ) ) {
	mkdir( $fake_dir, 0777, true );
}

@unlink( $log_file );

file_put_contents(
	$fake_bin,
	str_replace(
		'__LOG__',
		escapeshellarg( $log_file ),
		<<<'SH'
#!/bin/sh
printf '%s\\n' "$*" >> __LOG__
if [ "$1" = "info" ]; then echo 27.0.0; exit 0; fi
if [ "$1" = "network" ] && [ "$2" = "inspect" ]; then exit 1; fi
exit 0
SH
	)
);

chmod( $fake_bin, 0755 );

$old_path = getenv( 'PATH' );

putenv( 'PATH=' . $fake_dir . ':' . $old_path );

update_post_meta(
	42,
	'_secura_lab',
	array(
		'enabled' => 1,
		'driver'  => 'docker',
		'mode'    => 'single',
		'image'   => 'securalabs/web-01:1.0',
		'command' => 'sleep infinity',
		'network' => 'seca_lab',
		'ttl'     => 3600,
	)
);

set_transient( 'seca_docker_available', '1', 300 );

$start_lab = Secura_Lab::start( 5, 42 );

$journal = file_exists( $log_file ) ? file_get_contents( $log_file ) : '';

putenv( 'PATH=' . $old_path );

$pos_reseau   = strpos( $journal, 'network create' );
$pos_machine  = strpos( $journal, 'run -d' );

check( ! empty( $start_lab['ok'] ), 'la machine se deploie quand Docker est disponible' );

/* Regression : une commande qui se termine aussitot doit toujours renvoyer
   son vrai code de sortie. Sur PHP 7.4, un processus arrete mais pas encore
   ramasse peut etre annonce « en cours » : le code lu valait -1, donc un
   deploiement reussi etait declare en echec (dans la CI, un test sur trois
   echouait de facon aleatoire). */
$codes_stables = 0;

for ( $i_stable = 0; $i_stable < 40; $i_stable++ ) {
	$run_stable = Secura_Lab::run( array( '/bin/true' ), 10 );

	if ( 0 === (int) $run_stable['code'] ) {
		$codes_stables++;
	}
}

check( 40 === $codes_stables, 'une commande terminee renvoie toujours son vrai code de sortie' );
check( false !== $pos_reseau && false !== $pos_machine && $pos_reseau < $pos_machine, 'le reseau dedie est cree AVANT la machine' );
check( false !== strpos( $journal, 'network create --internal --driver bridge seca_lab_5_42' ), 'le reseau dedie est cree sans sortie Internet' );
check( false !== strpos( $journal, 'run -d' ), 'la machine est lancee dans le conteneur dedie' );

check( false !== strpos( $journal, 'rm -f seca_lab_5_42' ), 'un conteneur du meme nom est supprime avant la creation' );

/* Regression : une pile Compose se construit d abord (c est long la
   premiere fois), puis se demarre sans reconstruire. */
update_post_meta(
	42,
	'_secura_lab',
	array(
		'enabled' => 1,
		'driver'  => 'docker',
		'mode'    => 'compose',
		'compose' => 'net-01/docker-compose.yml',
		'project' => 'seca_net01',
		'service' => 'attacker',
		'network' => 'seca_lab',
		'ttl'     => 3600,
	)
);

@unlink( $log_file );

putenv( 'PATH=' . $fake_dir . ':' . $old_path );

$start_compose = Secura_Lab::start( 5, 42 );

$journal_compose = file_exists( $log_file ) ? file_get_contents( $log_file ) : '';

putenv( 'PATH=' . $old_path );

$pos_build = strpos( $journal_compose, 'build' );
$pos_up    = strpos( $journal_compose, 'up -d --no-build' );

check( ! empty( $start_compose['ok'] ), 'la pile Compose se deploie quand Docker est disponible' );
check( false !== $pos_build && false !== $pos_up && $pos_build < $pos_up, 'les images sont construites avant le demarrage de la pile' );
check( false !== strpos( $journal_compose, 'up -d --no-build' ), 'la pile demarre sans reconstruire les images' );

/* Regression : le client Docker herite de l environnement du serveur
   (DOCKER_HOST, HOME...). Sans cela, le client ne trouve pas le demon. */
$env_test = Secura_Lab::run( array( 'printenv', 'HOME' ), 10 );
$home_attendu = getenv( 'HOME' );

check( '' !== trim( (string) $env_test['output'] ), 'le client Docker herite de l environnement du serveur' );

if ( ! empty( $home_attendu ) ) {
	check( false !== strpos( (string) $env_test['output'], $home_attendu ), 'le dossier personnel du serveur est transmis au client Docker' );
}

/* Les rooms de demonstration sont branchees a une vraie machine. */
$demo_labs = 0;

foreach ( seca_default_rooms() as $demo_room ) {
	if ( ! empty( $demo_room['lab'] ) && ! empty( $demo_room['lab']['enabled'] ) ) {
		$demo_labs++;
	}
}

check( 3 === $demo_labs, 'trois rooms de demonstration sont branchees a une machine reelle' );

/* ---------------------------------------------------------------------
 * Frontend : le saisie de reponse doit etre branchee
 * ------------------------------------------------------------------ */

echo "\nFrontend\n";

$js_path = dirname( __DIR__ ) . '/wp-content/plugins/secura-academy/assets/academy.js';
$js      = file_exists( $js_path ) ? file_get_contents( $js_path ) : '';

check( false !== strpos( $js, 'box.appendChild( input )' ), 'le champ de reponse est insere dans la page' );
check( false !== strpos( $js, "'choice' === mode" ), 'le mode choix multiple est gere par le client' );
check( false !== strpos( $js, "'action' === mode" ), 'le mode sans reponse est gere par le client' );
check( false !== strpos( $js, 'radio.checked' ), 'la selection d\'un choix est lue avant validation' );

$css_path = dirname( __DIR__ ) . '/wp-content/plugins/secura-academy/assets/academy.css';
$css      = file_exists( $css_path ) ? file_get_contents( $css_path ) : '';

check( false !== strpos( $css, '.seca-choices' ), 'les choix multiples sont styles' );
check( false !== strpos( $css, '.seca-action-note' ), 'la consigne sans reponse est stylee' );

/* ---------------------------------------------------------------------
 * Scénarios M3 : contenu, QCM à une seule bonne réponse, missions
 * vérifiées sur une vraie machine (drapeaux lus par le serveur).
 * ------------------------------------------------------------------ */

echo "\nScénarios M3\n";

require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/content-m3.php';
require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-video.php';
require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/content-universites.php';
require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-kahoot.php';

$labs_dir = dirname( __DIR__ ) . '/labs';

$m3 = seca_default_rooms_m3();

check( 10 === count( $m3 ), 'dix scénarios M3 sont fournis' );

$m3_structure  = true;
$m3_qcm        = true;
$m3_flags      = true;
$m3_labs       = true;
$m3_positions  = array();
$m3_flag_count = 0;
$m3_qcm_count  = 0;

/* Correspondance service Compose -> dossier du lab. */
$m3_service_folder = array(
	'attacker'  => 'web-01',
	'web'       => 'web-01',
	'db'        => 'web-01',
	'internal'  => 'internal-01',
);

foreach ( $m3 as $room ) {
	$types = array();

	foreach ( $room['tasks'] as $task ) {
		$types[] = $task['type'];
	}

	if ( array( 'lesson', 'practice', 'test', 'exam' ) !== $types ) {
		$m3_structure = false;
	}

	if ( ! isset( $room['i18n']['ar'], $room['i18n']['en'] ) ) {
		$m3_structure = false;
	}

	if ( empty( $room['lab']['enabled'] ) ) {
		$m3_labs = false;
	}

	foreach ( $room['tasks'] as $task ) {
		foreach ( $task['questions'] as $question ) {
			$mode = isset( $question['mode'] ) ? $question['mode'] : 'text';

			if ( 'choice' === $mode ) {
				$m3_qcm_count++;
				$choices = isset( $question['choices'] ) ? $question['choices'] : array();

				/* Un vrai QCM : quatre propositions, une seule bonne,
				   aucune proposition dupliquee, une explication et
				   un indice. */
				if ( 4 !== count( $choices )
					|| count( array_unique( $choices ) ) !== 4
					|| ! isset( $choices[ (int) $question['correct'] ] )
					|| empty( $question['explanation'] )
					|| empty( $question['hint'] ) ) {
					$m3_qcm = false;
				}

				$m3_positions[ (int) $question['correct'] ] = isset( $m3_positions[ (int) $question['correct'] ] ) ? $m3_positions[ (int) $question['correct'] ] + 1 : 1;

				continue;
			}

			if ( 'flag' !== $mode ) {
				continue;
			}

			$m3_flag_count++;
			$flag_path = isset( $question['flag_path'] ) ? $question['flag_path'] : '';

			/* Le chemin doit etre accepte par le moteur (pas de
			   traversee de repertoire possible). */
			if ( '' === $flag_path || '' === Secura_Lab::safe_machine_path( $flag_path ) ) {
				$m3_flags = false;
				continue;
			}

			/* Le fichier de reponse doit exister dans le depot, et
			   contenir un drapeau. */
			if ( 'single' === $room['lab']['mode'] ) {
				$image = $room['lab']['image'];
				$folder = 'securalabs/' === substr( $image, 0, 11 ) ? substr( $image, 11, strpos( $image, ':' ) - 11 ) : '';
				$file = $labs_dir . '/' . $folder . '/flag/' . basename( $flag_path );
			} else {
				$service = ! empty( $room['lab']['flag_service'] ) ? $room['lab']['flag_service'] : $room['lab']['service'];
				$folder = isset( $m3_service_folder[ $service ] ) ? $m3_service_folder[ $service ] : '';
				$file = $labs_dir . '/' . $folder . '/flag/' . basename( $flag_path );
			}

			if ( ! is_file( $file ) ) {
				$m3_flags = false;
				continue;
			}

			$content = trim( (string) file_get_contents( $file ) );

			if ( 0 !== strpos( $content, 'FLAG=SECURA{' ) ) {
				$m3_flags = false;
			}
		}
	}
}

check( $m3_structure, 'chaque scénario M3 suit le patron leçon → entraînement → mission → examen, en FR/AR/EN' );
check( $m3_qcm, 'chaque question d\'entraînement et d\'examen est un QCM à quatre propositions et une seule bonne réponse' );
check( $m3_flags, 'chaque mission valide un drapeau réellement présent dans le dépôt (preuve de travail)' );
check( $m3_labs, 'chaque scénario M3 est branché sur une machine réelle' );
check( $m3_qcm_count >= 60, 'les scénarios M3 proposent plus de soixante questions d\'entraînement et d\'examen' );
check( $m3_flag_count >= 9, 'les scénarios M3 comportent au moins neuf missions vérifiées sur la machine' );
check( count( array_filter( $m3_positions, function ( $n ) { return $n > 0; } ) ) >= 3, 'la bonne réponse n\'est pas toujours à la même place' );

/* Les machines citees doivent exister dans le depot. */
$m3_images = array();

foreach ( $m3 as $room ) {
	if ( 'single' === $room['lab']['mode'] && ! empty( $room['lab']['image'] ) ) {
		$m3_images[ $room['lab']['image'] ] = true;
	}
}

$m3_images_ok = true;

foreach ( array_keys( $m3_images ) as $image ) {
	$folder = 'securalabs/' === substr( $image, 0, 11 ) ? substr( $image, 11, strpos( $image, ':' ) - 11 ) : '';

	if ( ! is_file( $labs_dir . '/' . $folder . '/Dockerfile' ) ) {
		$m3_images_ok = false;
	}
}

check( $m3_images_ok, 'chaque image Docker citée par les scénarios existe dans le dépôt (labs/)' );
check( is_file( $labs_dir . '/net-01/docker-compose.yml' ), 'la pile multi-nœuds citée par les scénarios 7 et 8 existe' );

/* Le parcours « Scénarios M3 » regroupe les dix rooms en cinq modules. */
$paths = seca_default_paths( array( 1, 2, 3, 4, 5, 6 ), array( 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ) );
$m3_path = isset( $paths[1] ) ? $paths[1] : array();

check( 4 === count( $paths ), 'quatre parcours sont crees : les fondations, les scénarios M3, Les universites et Les labs avances' );
check( isset( $m3_path['sections'] ) && 5 === count( $m3_path['sections'] ), 'le parcours M3 compte cinq modules' );
check( 10 === array_sum( array_map( function ( $section ) { return count( $section['rooms'] ); }, $m3_path['sections'] ) ), 'le parcours M3 contient les dix scénarios' );
check( isset( $m3_path['i18n']['ar'], $m3_path['i18n']['en'] ), 'le parcours M3 est traduit en arabe et en anglais' );

/* Le parcours « Les universités » : vingt-deux rooms en six modules. */
$paths_uni = seca_default_paths( array( 1 ), array( 2 ), array( 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31 ), array( 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53 ) );
$uni_path  = isset( $paths_uni[2] ) ? $paths_uni[2] : array();
$avance_path = isset( $paths_uni[3] ) ? $paths_uni[3] : array();

check( 4 === count( $paths_uni ), 'un quatrieme parcours est cree : Les labs avances' );
check( isset( $uni_path['sections'] ) && 6 === count( $uni_path['sections'] ), 'le parcours universitaire compte six modules' );
check( 22 === array_sum( array_map( function ( $section ) { return count( $section['rooms'] ); }, $uni_path['sections'] ) ), 'le parcours universitaire contient les vingt-deux rooms' );
check( isset( $uni_path['i18n']['ar'], $uni_path['i18n']['en'] ), 'le parcours universitaire est traduit en arabe et en anglais' );

/* Le parcours « Les labs avancés » : trois modules, quatorze rooms. */
check( isset( $avance_path['sections'] ) && 3 === count( $avance_path['sections'] ), 'le parcours des labs avancés compte trois modules' );
check( 14 === array_sum( array_map( function ( $section ) { return count( $section['rooms'] ); }, $avance_path['sections'] ) ), 'le parcours des labs avancés contient les quatorze rooms' );
check( isset( $avance_path['i18n']['ar'], $avance_path['i18n']['en'] ), 'le parcours des labs avancés est traduit en arabe et en anglais' );

/* Le moteur : un drapeau lu dans la machine de l'apprenant, en root. */
$flag_dir  = sys_get_temp_dir() . '/seca_docker_flag';
$flag_bin  = $flag_dir . '/docker';

if ( ! is_dir( $flag_dir ) ) {
	mkdir( $flag_dir, 0777, true );
}

file_put_contents(
	$flag_bin,
	<<<'SH'
#!/bin/sh
if [ "$1" = "info" ]; then echo 27.0.0; exit 0; fi
if [ "$1" = "exec" ]; then echo "FLAG=SECURA{triage_patient}"; exit 0; fi
exit 0
SH
);

chmod( $flag_bin, 0755 );

$old_path_flag = getenv( 'PATH' );

putenv( 'PATH=' . $flag_dir . ':' . $old_path_flag );

update_post_meta(
	77,
	'_secura_lab',
	array(
		'enabled' => 1,
		'driver'  => 'docker',
		'mode'    => 'single',
		'image'   => 'securalabs/multi-01:1.0',
		'command' => 'sleep infinity',
		'network' => 'seca_lab',
		'ttl'     => 3600,
	)
);

set_transient( 'seca_docker_available', '1', 300 );

Secura_Lab::start( 5, 77 );

$m3_flag_ok   = Secura_Lab::flag_matches( 5, 77, '/root/flags/flag-01.txt', 'FLAG=SECURA{triage_patient}' );
$m3_flag_ko  = Secura_Lab::flag_matches( 5, 77, '/root/flags/flag-01.txt', 'FLAG=SECURA{autre_chose}' );

putenv( 'PATH=' . $old_path_flag );

check( $m3_flag_ok, 'le serveur accepte le drapeau lu dans la machine de l\'apprenant' );

/* Le client ne recoit jamais la bonne reponse, ni le drapeau attendu. */
$m3_first = $m3[0];

update_post_meta(
	91,
	SECURA_META_TASKS,
	$m3_first['tasks']
);

update_post_meta(
	91,
	'_secura_lab',
	$m3_first['lab']
);

$_POST = array(
	'nonce'   => 'nonce-de-test',
	'room_id' => 91,
	'task'    => 0,
);

capture_json(
	function () {
		Secura_Ajax::complete_lesson();
	}
);

$_POST = array(
	'nonce'   => 'nonce-de-test',
	'room_id' => 91,
	'task'    => 1,
);

$payload_m3 = capture_json(
	function () {
		Secura_Ajax::get_task();
	}
);

if ( $payload_m3 && is_array( $payload_m3['data'] ) ) {
	$sent_m3 = $payload_m3['data']['task']['questions'];

	$expose = false;

	foreach ( $sent_m3 as $question_m3 ) {
		if ( isset( $question_m3['correct'] ) || isset( $question_m3['answers'] ) || isset( $question_m3['flag_path'] ) ) {
			$expose = true;
		}
	}

	check( ! $expose, 'la bonne reponse et le chemin du drapeau ne quittent jamais le serveur' );
	check( isset( $sent_m3[0]['choices'] ) && 4 === count( $sent_m3[0]['choices'] ), 'les quatre propositions du QCM sont envoyees au client' );
}
check( ! $m3_flag_ko, 'un mauvais drapeau est refuse meme si la machine est demarree' );
check( '' === Secura_Lab::safe_machine_path( '/root/flags/../../../etc/passwd' ), 'un chemin de drapeau contenant « .. » est refuse' );

/* ---------------------------------------------------------------------
 * Bloc universitaire : la facade video, les vingt-deux rooms et leurs
 * missions (preuve lue dans la machine « univ-01 »).
 * ------------------------------------------------------------------ */

echo "\nBloc universitaire\n";

$uni_rooms = seca_default_rooms_universites();

check( 22 === count( $uni_rooms ), 'vingt-deux rooms universitaires sont fournies' );

$uni_pattern_ok   = true;
$uni_video_ok     = true;
$uni_video_ids    = array();
$uni_flags_ok     = true;
$uni_questions_ok = true;
$uni_answers_balanced = true;
$uni_i18n_ok      = true;
$uni_lab_ok       = true;

$uni_labs_dir = dirname( __DIR__ ) . '/labs';
$uni_flag_dir = $uni_labs_dir . '/univ-01/flag';

foreach ( $uni_rooms as $room_uni ) {
	/* Le patron : lecon -> entrainement -> mission -> examen. */
	if ( ! isset( $room_uni['tasks'] ) || 4 !== count( $room_uni['tasks'] ) ) {
		$uni_pattern_ok = false;
		continue;
	}

	$types_uni = array();

	foreach ( $room_uni['tasks'] as $task_uni ) {
		$types_uni[] = $task_uni['type'];
	}

	if ( array( 'lesson', 'practice', 'test', 'exam' ) !== $types_uni ) {
		$uni_pattern_ok = false;
	}

	/* La video : identifiant reel, institution et licence. */
	if ( ! isset( $room_uni['video']['id'] ) || ! preg_match( '/^[A-Za-z0-9_-]{11}$/', $room_uni['video']['id'] ) ) {
		$uni_video_ok = false;
	} else {
		$uni_video_ids[] = $room_uni['video']['id'];
	}

	if ( empty( $room_uni['video']['institution'] ) || empty( $room_uni['video']['license'] ) || empty( $room_uni['video']['title'] ) ) {
		$uni_video_ok = false;
	}

	/* Les questions : QCM a quatre propositions, une seule bonne reponse. */
	$correct_positions = array();

	foreach ( $room_uni['tasks'] as $task_uni ) {
		foreach ( $task_uni['questions'] as $question_uni ) {
			if ( 'choice' !== $question_uni['mode'] ) {
				continue;
			}

			if ( 4 !== count( $question_uni['choices'] ) || ! isset( $question_uni['correct'] ) ) {
				$uni_questions_ok = false;
				continue;
			}

			$correct_positions[] = $question_uni['correct'];

			if ( empty( $question_uni['explanation'] ) || empty( $question_uni['hint'] ) ) {
				$uni_questions_ok = false;
			}
		}
	}

	/* La bonne reponse ne doit pas toujours etre a la meme place. */
	if ( count( array_unique( $correct_positions ) ) < 3 ) {
		$uni_answers_balanced = false;
	}

	/* La mission : un drapeau reellement present dans la machine. */
	foreach ( $room_uni['tasks'] as $task_uni ) {
		foreach ( $task_uni['questions'] as $question_uni ) {
			if ( 'flag' !== $question_uni['mode'] ) {
				continue;
			}

			$flag_name = basename( $question_uni['flag_path'] );

			if ( ! is_file( $uni_flag_dir . '/' . $flag_name ) ) {
				$uni_flags_ok = false;
			}
		}
	}

	/* La machine : une image qui existe dans le depot. */
	if ( empty( $room_uni['lab']['image'] ) || 'securalabs/univ-01:1.0' !== $room_uni['lab']['image'] ) {
		$uni_lab_ok = false;
	}

	/* Les traductions. */
	if ( ! isset( $room_uni['i18n']['ar']['title'], $room_uni['i18n']['en']['title'] ) ) {
		$uni_i18n_ok = false;
	} elseif ( 4 !== count( $room_uni['i18n']['ar']['tasks'] ) || 4 !== count( $room_uni['i18n']['en']['tasks'] ) ) {
		$uni_i18n_ok = false;
	}
}

check( $uni_pattern_ok, 'chaque room universitaire suit le patron lecon → entrainement → mission → examen' );
check( $uni_video_ok, 'chaque room universitaire porte une video reelle, avec institution et licence' );
check( $uni_questions_ok, 'chaque question universitaire est un QCM a quatre propositions, avec indice et explication' );
check( $uni_answers_balanced, 'la bonne reponse n\'est pas toujours a la meme place' );
check( $uni_flags_ok, 'chaque mission universitaire valide un drapeau present dans la machine univ-01' );
check( $uni_lab_ok, 'chaque room universitaire est branchee sur la machine univ-01' );
check( $uni_i18n_ok, 'chaque room universitaire est traduite en arabe et en anglais' );
check( 22 === count( array_unique( $uni_video_ids ) ), 'les vingt-deux rooms utilisent vingt-deux videos differentes' );
check( is_file( $uni_labs_dir . '/univ-01/Dockerfile' ), 'la machine univ-01 existe dans le depot' );

/* Le catalogue des videos verifiees : aucune identifiant invente. */
$uni_catalogue = dirname( __DIR__ ) . '/tools/videos/videos-verifies.json';

if ( is_file( $uni_catalogue ) ) {
	$uni_json = json_decode( file_get_contents( $uni_catalogue ), true );
	$uni_known = array();

	if ( isset( $uni_json['videos'] ) && is_array( $uni_json['videos'] ) ) {
		foreach ( $uni_json['videos'] as $entry ) {
			if ( isset( $entry['id'] ) ) {
				$uni_known[] = $entry['id'];
			}
		}
	}

	check( count( $uni_known ) >= 22, 'le catalogue des videos verifiees contient au moins vingt-deux entrees' );
	check( 0 === count( array_diff( $uni_video_ids, $uni_known ) ), 'chaque video utilisee est dans le catalogue verifie (aucun identifiant invente)' );
} else {
	check( false, 'le catalogue des videos verifiees est present dans le depot' );
}

/* La facade : rien n\'est charge avant le clic. */
$GLOBALS['securatest_meta'] = array();

update_post_meta( 4242, Secura_Video::META, array(
	'id'          => 'GqmQg-cszw4',
	'title'       => '1. Introduction, Threat Models',
	'channel'     => 'MIT OpenCourseWare',
	'institution' => 'MIT - 6.858 Computer Systems Security (Fall 2014)',
	'license'     => 'CC BY-NC-SA 4.0 - MIT OpenCourseWare',
	'duration'    => '1:17:13',
	'note'        => 'Cours video de l\'universite.',
) );

$uni_html = Secura_Video::render( 4242, 'fr' );

check( false !== strpos( $uni_html, 'data-seca-video-play' ), 'la facade video propose un bouton de lecture' );
check( false === strpos( $uni_html, '<iframe' ), 'aucun iframe n\'est present avant le clic' );
check( false === strpos( $uni_html, 'autoplay=1' ), 'la facade video ne demarre aucune lecture automatique' );
check( false !== strpos( $uni_html, 'youtube.com/watch?v=GqmQg-cszw4' ), 'le lien de secours vers la source est toujours visible' );
check( false !== strpos( $uni_html, 'youtube-nocookie.com/embed/GqmQg-cszw4' ), 'l\'integration prevue utilise youtube-nocookie' );
check( false !== strpos( $uni_html, 'CC BY-NC-SA 4.0' ), 'le bloc d\'attribution affiche la licence' );
check( false !== strpos( $uni_html, 'MIT - 6.858' ), 'le bloc d\'attribution affiche la source' );
check( false !== strpos( $uni_html, 'data-seca-video-id="GqmQg-cszw4"' ), 'la facade porte l\'identifiant de la video' );
check( '' === Secura_Video::render( 999999, 'fr' ), 'une room sans video n\'affiche aucun bloc video' );

/* Un identifiant invalide n\'est jamais accepte. */
$GLOBALS['securatest_meta'] = array();

update_post_meta( 4243, Secura_Video::META, array( 'id' => 'pas-un-id' ) );

check( false === Secura_Video::get( 4243 ), 'un identifiant de video invalide est refuse' );

/* ---------------------------------------------------------------------
 * M7 : les labs avances (Juice Shop, dojo, briefs, Kahoot).
 * ------------------------------------------------------------------ */

echo "\nM7 : les labs avancés\n";

$avance_rooms = seca_default_rooms_avance();

check( 14 === count( $avance_rooms ), 'quatorze rooms de labs avancés sont fournies' );

$m7_juice   = 0;
$m7_dojo    = 0;
$m7_briefs  = 0;
$m7_kahoot  = 0;
$m7_flags   = true;
$m7_labs    = true;
$m7_videos  = true;

$labs_root = dirname( __DIR__ ) . '/labs';

foreach ( $avance_rooms as $room_m7 ) {
	$lab = isset( $room_m7['lab'] ) ? $room_m7['lab'] : array();

	/* La video doit etre verifiee. */
	if ( empty( $room_m7['video']['id'] ) || ! preg_match( '/^[A-Za-z0-9_-]{11}$/', $room_m7['video']['id'] ) ) {
		$m7_videos = false;
	}

	/* La mission est la troisieme tache (« test »), en mode drapeau. */
	$preuves = array();

	foreach ( $room_m7['tasks'] as $tache ) {
		if ( isset( $tache['type'] ) && 'test' === $tache['type'] ) {
			foreach ( $tache['questions'] as $question ) {
				if ( isset( $question['mode'] ) && 'flag' === $question['mode'] ) {
					$preuves[] = $question;
				}
			}
		}
	}

	foreach ( $preuves as $preuve ) {
		$chemin = $preuve['flag_path'];
		$nom    = basename( $chemin );

		if ( isset( $lab['mode'] ) && 'compose' === $lab['mode'] ) {
			/* Lab Juice Shop : les drapeaux vivent dans le service « flags ». */
			$dossier = $labs_root . '/' . dirname( $lab['compose'] ) . '/flags';
		} else {
			$dossier = $labs_root . '/' . preg_replace( '/^securalabs\//', '', $lab['image'] );
			$dossier = preg_replace( '/:.*$/', '', $dossier ) . '/flag';
		}

		if ( ! is_file( $dossier . '/' . $nom ) ) {
			$m7_flags = false;
		}
	}

	if ( isset( $lab['mode'] ) && 'compose' === $lab['mode'] ) {
		$m7_juice++;

		if ( empty( $lab['flag_service'] ) || 'flags' !== $lab['flag_service'] ) {
			$m7_labs = false;
		}
	} elseif ( ! empty( $room_m7['kahoot'] ) ) {
		$m7_kahoot++;
	} elseif ( 4 === count( $preuves ) ) {
		$m7_dojo++;
	} else {
		$m7_briefs++;
	}
}

check( 2 === $m7_juice, 'deux rooms Juice Shop (application web vulnérable)' );
check( 5 === $m7_dojo, 'cinq rooms de dojo (une par ceinture)' );
check( 6 === $m7_briefs, 'six rooms de brief (les six vidéos d\'introduction)' );
check( 1 === $m7_kahoot, 'une room Kahoot (le quiz de révision)' );
check( $m7_flags, 'chaque mission des labs avancés valide un drapeau présent dans le dépôt' );
check( $m7_labs, 'le lab Juice Shop garde ses drapeaux dans un service dédié' );
check( $m7_videos, 'chaque room des labs avancés porte une vidéo vérifiée' );

/* Le dojo : vingt défis, cinq ceintures, dans la machine. */
$dojo_dir = $labs_root . '/dojo-01';

check( is_file( $dojo_dir . '/Dockerfile' ), 'la machine dojo-01 existe dans le dépôt' );

$dojo_flags = 0;

if ( is_dir( $dojo_dir . '/flag' ) ) {
	foreach ( (array) glob( $dojo_dir . '/flag/flag-*.txt' ) as $fichier ) {
		$dojo_flags++;
	}
}

check( 27 === $dojo_flags, 'le dojo-01 contient les vingt défis et les sept briefs (27 drapeaux)' );

/* Le lab Juice Shop : l'image officielle, isolee, et le service des drapeaux. */
$juice_compose = $labs_root . '/juice-shop/docker-compose.yml';

check( is_file( $juice_compose ), 'le lab Juice Shop existe dans le dépôt' );

if ( is_file( $juice_compose ) ) {
	$juice_texte = file_get_contents( $juice_compose );

	check( false !== strpos( $juice_texte, 'bkimminich/juice-shop' ), 'le lab Juice Shop utilise l\'image officielle de l\'OWASP' );
	check( false !== strpos( $juice_texte, 'internal: true' ), 'le lab Juice Shop est dans un reseau sans sortie' );
	check( false !== strpos( $juice_texte, 'CTF_KEY=' ), 'le lab Juice Shop definit la cle de ses drapeaux' );
}

/* Le bloc Kahoot : rendu et export. */
$kahoot_room = null;
$kahoot_id   = 5150;

foreach ( $avance_rooms as $room_m7 ) {
	if ( ! empty( $room_m7['kahoot'] ) ) {
		$kahoot_room = $room_m7;
		break;
	}
}

check( null !== $kahoot_room, 'la room Kahoot est presente' );

if ( $kahoot_room ) {
	update_post_meta( $kahoot_id, Secura_Kahoot::META, $kahoot_room['kahoot'] );
	update_post_meta( $kahoot_id, SECURA_META_TASKS, $kahoot_room['tasks'] );

	$kahoot_html = Secura_Kahoot::render( $kahoot_id, 'fr' );

	check( false !== strpos( $kahoot_html, 'seca-kahoot' ), 'le bloc Kahoot s\'affiche dans la room' );
	check( false !== strpos( $kahoot_html, 'SECURA1' ), 'le bloc Kahoot affiche le code du quiz' );
	check( false !== strpos( $kahoot_html, 'seca_kahoot=csv' ), 'le bloc Kahoot propose le telechargement du quiz' );

	$kahoot_csv = Secura_Kahoot::csv( $kahoot_id );
	$kahoot_lignes = explode( "\r\n", $kahoot_csv );

	check( 10 === count( $kahoot_lignes ), 'le quiz exporte contient les dix questions' );
	check( false !== strpos( $kahoot_csv, '"' ) && count( $kahoot_lignes ) > 0, 'l\'export CSV est bien formate' );

	$kahoot_json = json_decode( Secura_Kahoot::json( $kahoot_id ), true );

	check( is_array( $kahoot_json ) && 10 === count( $kahoot_json ), 'l\'export JSON contient les dix questions' );
	check( isset( $kahoot_json[0]['correct'] ) && isset( $kahoot_json[0]['explain'] ), 'l\'export JSON garde la bonne reponse et l\'explication (pour l\'enseignant)' );

	/* Le quiz n'est pas exportable par un visiteur non connecte. */
	check( '' === Secura_Kahoot::csv( 999999 ), 'une room sans quiz n\'exporte rien' );
}

/* ---------------------------------------------------------------------
 * Les caractères d'une écriture étrangère
 *
 * L'audit « multilingue » interdit qu'un caractère ressemblant à une
 * lettre latine (mais écrit dans une autre écriture) se glisse dans le
 * contenu : le lecteur ne le voit pas, mais la recherche du site ne
 * trouve plus le mot. Les questions IMPORTEES, en revanche, sont
 * reproduites mot pour mot : un examen de mathématiques contient des
 * symboles grecs (lambda, Gamma), qui font partie de l'énoncé.
 *
 * Ces tests prouvent que la règle tient toujours : le cyrillique et le
 * han restent interdits partout, le grec est toléré dans un contenu
 * importé et nowhere ailleurs.
 * ------------------------------------------------------------------ */

require_once __DIR__ . '/../scripts/audit/lib-ecritures.php';

$fichier_import = 'includes/content-import-mit_ocw_14_15j_examens.php';
$fichier_code   = 'includes/class-secura-rooms.php';

$grec     = "\u{03BB}";  // lambda
$cyrillic = "\u{0441}";  // s cyrillique, homoglyphe de « s » latin

$contenu_grec_importe = "Le plus grand vecteur propre est designe comme {$grec} .";
$contenu_grec_code    = "Le plus grand vecteur propre est designe comme {$grec} .";
$contenu_cyrillique   = "Les secrets du mot sont dans {$cyrillic}ecrets .";

/* Le grec mathématique : toléré dans un import, refusé partout ailleurs. */
check(
	0 === count( seca_caracteres_etrangers( $contenu_grec_importe, $fichier_import ) ),
	'le grec mathématique n\'est pas signalé dans un contenu importé'
);
check(
	1 === count( seca_caracteres_etrangers( $contenu_grec_code, $fichier_code ) ),
	'le grec est signalé dans notre propre code (seul le contenu importé y a droit)'
);
check(
	1 === count( seca_caracteres_etrangers( $contenu_grec_code, 'includes/mes-questions.php' ) ),
	'le grec reste signalé dans un fichier qui n\'est pas un import officiel'
);

/* Le cyrillique : interdit partout, import compris. */
check(
	1 === count( seca_caracteres_etrangers( $contenu_cyrillique, $fichier_code ) ),
	'un caractère cyrillique est signalé dans notre code'
);
check(
	1 === count( seca_caracteres_etrangers( $contenu_cyrillique, $fichier_import ) ),
	'un homoglyphe cyrillique reste signalé même dans un fichier importé'
);
check(
	count( seca_caracteres_etrangers( "Des mots \u{4E2D}\u{6587} ici.", $fichier_import ) ) >= 1,
	'le han reste signalé même dans un fichier importé'
);

/* Un texte français normal ne déclenche rien. */
check(
	0 === count( seca_caracteres_etrangers( 'Un texte tout a fait ordinaire, avec des accents : é è à ç ù.', $fichier_code ) ),
	'un texte français ordinaire ne déclenche aucune alerte'
);

/* La reconnaissance du fichier importé. */
check(
	true === seca_est_contenu_importe( $fichier_import ),
	'un fichier de questions importées est reconnu comme tel'
);
check(
	false === seca_est_contenu_importe( $fichier_code ),
	'un fichier de code ordinaire n\'est pas un import'
);

/* ---------------------------------------------------------------------
 * Non-regression : les examens d'universite sont en RESERVE
 *
 * Une question reprise d'un examen d'universite porte une cle 'source'.
 * Elle ne doit jamais entrer dans une tache : sinon le point de
 * controle de l'eleve gonfle (mesure : 80 questions au lieu de 4).
 * Elle vit dans la reserve, qui alimente le reservoir des epreuves :
 * les copies d'examen restent donc variees, et le point de controle
 * garde la taille de l'epreuve.
 * ------------------------------------------------------------------ */

$room_import = 991;

$post_import = new stdClass();

$post_import->ID           = $room_import;
$post_import->post_type    = SECURA_POST_TYPE;
$post_import->post_title   = 'Room de test (reserve)';
$post_import->post_excerpt = 'Extrait de test';
$post_import->post_content = 'Contenu de test';
$post_import->post_name    = 'comment-marche-un-ordinateur-de-la-donnee-au-programme';

$GLOBALS['securatest_posts'][ $room_import ] = $post_import;

$GLOBALS['securatest_meta'][ $room_import ][ SECURA_META_TASKS ] = array(
	array(
		'type'      => 'test',
		'questions' => array(
			array( 'question' => 'Question maison de la room', 'mode' => 'text', 'answers' => array( 'une reponse' ), 'explanation' => 'L\'explication de la question maison.' ),
		),
	),
	array(
		'type'      => 'exam',
		'questions' => array(
			array( 'question' => 'Question d\'examen maison', 'mode' => 'choice', 'choices' => array( 'a', 'b', 'c', 'd' ), 'correct' => 0, 'explanation' => 'L\'explication de la question d\'examen.' ),
		),
	),
);

$taches_import  = Secura_Rooms::get_tasks( $room_import );
$reserve_import = Secura_Rooms::reserve( $room_import );

$importees_dans_taches = 0;

foreach ( $taches_import as $tache_import ) {
	foreach ( (array) $tache_import['questions'] as $question_import ) {
		if ( ! empty( $question_import['source'] ) ) {
			$importees_dans_taches++;
		}
	}
}

check( 0 === $importees_dans_taches, 'aucune question d\'un examen d\'universite n\'entre dans une tache : le point de controle ne gonfle pas' );
check( count( $reserve_import ) > 0, 'la reserve de la room contient les questions importees' );
check( 2 === count( $taches_import ), 'la room garde ses deux taches' );
check( 1 === count( $taches_import[0]['questions'] ), 'la tache « test » garde sa seule question maison' );

$reservoir_import = 0;
$liste_import     = Secura_Exam::pool( $room_import, array( 'exam', 'test' ) );

foreach ( $liste_import as $entree_import ) {
	if ( ! empty( $entree_import['question']['source'] ) ) {
		$reservoir_import++;
	}
}

check( $reservoir_import > 0, 'la reserve alimente le reservoir des epreuves : les questions importees restent jouables' );
check( count( $liste_import ) > count( $taches_import[0]['questions'] ), 'le reservoir est plus grand que la tache seule (les copies d\'examen varient)' );

/* ---------------------------------------------------------------------
 * Les prototypes incomplets du ZIP ne doivent pas être activés sans revue.
 * ------------------------------------------------------------------ */

$bootstrap_plugin = file_get_contents( __DIR__ . '/../wp-content/plugins/secura-academy/secura-academy.php' );
$prototypes = array( 'class-secura-lab-front.php', 'class-secura-exam-timed.php', 'class-secura-certificate.php', 'class-secura-exam-front.php' );
$prototype_charge = false;
foreach ( $prototypes as $prototype ) {
	if ( preg_match( '/^\s*(?:require|include)(?:_once)?\b[^;]*' . preg_quote( $prototype, '/' ) . '/m', $bootstrap_plugin ) ) {
		$prototype_charge = true;
	}
}
check( ! $prototype_charge, 'les prototypes du ZIP restent non chargés tant que leurs défauts ne sont pas corrigés' );

$ajax_source = file_get_contents( __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-ajax.php' );
$prototype_routes = array( 'secura_exam_time', 'secura_exam_submit', 'secura_exam_answer', 'secura_certificate', 'secura_certificate_list' );
$route_exposee = false;
foreach ( $prototype_routes as $route ) {
	if ( false !== strpos( $ajax_source, "'" . $route . "'" ) ) {
		$route_exposee = true;
	}
}
check( ! $route_exposee, 'les points d’entrée AJAX des prototypes ne sont pas exposés' );

/* ---------------------------------------------------------------------
 * Bilan
 * ------------------------------------------------------------------ */

echo "\n" . str_repeat( '-', 46 ) . "\n";
echo "Résultat : " . $passed . " test(s) réussi(s), " . $failed . " échec(s).\n";

exit( $failed > 0 ? 1 : 0 );
