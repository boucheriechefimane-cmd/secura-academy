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
	return 'fr_FR';
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
require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-rooms.php';
require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-paths.php';
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
 * Multilingue
 * ------------------------------------------------------------------ */

echo "\nMultilingue\n";
check( 3 === count( Secura_I18n::languages() ), 'trois langues sont proposées' );
check( 'rtl' === Secura_I18n::languages()['ar']['dir'], 'l\'arabe est en écriture de droite à gauche' );
check( 'fr' === Secura_I18n::current_lang(), 'le français est la langue par défaut' );
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

/* ---------------------------------------------------------------------
 * Bilan
 * ------------------------------------------------------------------ */

echo "\n" . str_repeat( '-', 46 ) . "\n";
echo "Résultat : " . $passed . " test(s) réussi(s), " . $failed . " échec(s).\n";

exit( $failed > 0 ? 1 : 0 );
