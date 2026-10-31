<?php
/**
 * Vérification légère de la logique serveur de Secura Academy.
 *
 * Ce harnais émule les quelques fonctions WordPress utilisées par
 * Secura_Progress et Secura_Rooms, afin de tester la logique sans
 * installation WordPress complète.
 *
 * Exécution : php tests/smoke-test.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', '/tmp/' );
}

define( 'SECURA_POST_TYPE', 'secura_room' );
define( 'SECURA_META_QUESTIONS', '_secura_questions' );
define( 'SECURA_META_DIFFICULTY', '_secura_difficulty' );
define( 'SECURA_META_DURATION', '_secura_duration' );
define( 'SECURA_META_XP_BONUS', '_secura_xp_bonus' );
define( 'SECURA_USER_XP', 'secura_xp' );
define( 'SECURA_USER_PROGRESS', 'secura_progress' );
define( 'SECURA_USER_TROPHIES', 'secura_trophies' );

/* ---------------------------------------------------------------------
 * Émulation WordPress minimale
 * ------------------------------------------------------------------ */

$GLOBALS['securatest_meta']  = array();
$GLOBALS['securatest_users'] = array();

function absint( $value ) {
	return abs( (int) $value );
}

function sanitize_key( $key ) {
	return preg_replace( '/[^a-z0-9_\-]/', '', strtolower( (string) $key ) );
}

function sanitize_text_field( $value ) {
	return trim( preg_replace( '/[\r\n\t]+/', ' ', wp_strip_all_tags( (string) $value ) ) );
}

function sanitize_textarea_field( $value ) {
	return trim( wp_strip_all_tags( (string) $value ) );
}

function wp_strip_all_tags( $value ) {
	return strip_tags( (string) $value );
}

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

function get_post_meta( $post_id, $key, $single = false ) {
	$value = isset( $GLOBALS['securatest_meta'][ $post_id ][ $key ] ) ? $GLOBALS['securatest_meta'][ $post_id ][ $key ] : '';

	return $single ? $value : ( is_array( $value ) ? $value : array() );
}

function update_post_meta( $post_id, $key, $value ) {
	$GLOBALS['securatest_meta'][ $post_id ][ $key ] = $value;
	return true;
}

function get_user_meta( $user_id, $key, $single = false ) {
	$value = isset( $GLOBALS['securatest_users'][ $user_id ][ $key ] ) ? $GLOBALS['securatest_users'][ $user_id ][ $key ] : '';

	return $single ? $value : ( is_array( $value ) ? $value : array() );
}

function update_user_meta( $user_id, $key, $value ) {
	$GLOBALS['securatest_users'][ $user_id ][ $key ] = $value;
	return true;
}

function current_time( $type ) {
	return gmdate( 'Y-m-d H:i:s' );
}

function __( $text, $domain = 'default' ) {
	return $text;
}

function _e( $text, $domain = 'default' ) {
	echo $text;
}

function esc_html__( $text, $domain = 'default' ) {
	return htmlspecialchars( $text, ENT_QUOTES, 'UTF-8' );
}

function esc_html( $text ) {
	return htmlspecialchars( (string) $text, ENT_QUOTES, 'UTF-8' );
}

function esc_attr( $text ) {
	return htmlspecialchars( (string) $text, ENT_QUOTES, 'UTF-8' );
}

/* ---------------------------------------------------------------------
 * Chargement du code testé
 * ------------------------------------------------------------------ */

require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-progress.php';
require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-rooms.php';

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

echo "Normalisation des réponses\n";
check( 'aes' === Secura_Progress::normalize_answer( '  AES. ' ), 'casse, espaces et ponctuation sont ignorés' );
check( 'depassement de tampon' === Secura_Progress::normalize_answer( 'Dépassement de Tampon' ), 'les accents sont ignorés' );
check( 'diffie-hellman' === Secura_Progress::normalize_answer( 'Diffie-Hellman' ), 'les tirets internes sont conservés' );
check( Secura_Progress::answer_matches( 'AES', array( 'aes', 'Aes-256' ) ), 'une réponse acceptée est reconnue' );
check( ! Secura_Progress::answer_matches( 'RSA', array( 'AES' ) ), 'une réponse non listée est rejetée' );
check( ! Secura_Progress::answer_matches( '', array( 'AES' ) ), 'une réponse vide est rejetée' );
check( ! Secura_Progress::answer_matches( 'AES', array() ), 'une liste vide ne valide rien' );

echo "\nPaliers de niveau\n";
check( 1 === Secura_Progress::level_for_xp( 0 )['number'], 'niveau 1 à 0 XP' );
check( 2 === Secura_Progress::level_for_xp( 100 )['number'], 'niveau 2 à 100 XP' );
check( 4 === Secura_Progress::level_for_xp( 500 )['number'], 'niveau 4 à 500 XP' );
check( 6 === Secura_Progress::level_for_xp( 1500 )['number'], 'niveau 6 à 1500 XP' );

echo "\nAttribution des XP (idempotence)\n";
$GLOBALS['securatest_users'] = array();
$first  = Secura_Progress::award_question( 7, 42, 0, 10 );
$second = Secura_Progress::award_question( 7, 42, 0, 10 );
check( 10 === $first['awarded'] && ! $first['already'], 'la première validation attribue les XP' );
check( 0 === $second['awarded'] && $second['already'], 'la revalidation n\'attribue pas de XP' );
check( 10 === $second['total_xp'], 'le total XP reste stable' );
check( 10 === (int) get_user_meta( 7, SECURA_USER_XP, true ), 'le total XP est bien persisté' );

echo "\nComplétion de room\n";
$GLOBALS['securatest_meta'][ 42 ][ SECURA_META_QUESTIONS ] = array(
	array( 'question' => 'Q1', 'answers' => array( 'A1' ), 'xp' => 10, 'hint' => '' ),
	array( 'question' => 'Q2', 'answers' => array( 'A2' ), 'xp' => 15, 'hint' => '' ),
);
$GLOBALS['securatest_meta'][ 42 ][ SECURA_META_XP_BONUS ] = 25;

$incomplete = Secura_Progress::complete_room( 7, 42 );
check( ! $incomplete['completed'], 'une room incomplète n\'est pas validée' );

Secura_Progress::award_question( 7, 42, 0, 10 );
Secura_Progress::award_question( 7, 42, 1, 15 );
$completed = Secura_Progress::complete_room( 7, 42 );
check( $completed['completed'] && 25 === $completed['xp'], 'la room complétée verse le bonus' );
check( 50 === (int) get_user_meta( 7, SECURA_USER_XP, true ), 'le XP total cumule questions et bonus' );

$again = Secura_Progress::complete_room( 7, 42 );
check( $again['already'] && 0 === $again['xp'], 'un second bonus n\'est pas versé' );
check( 50 === (int) get_user_meta( 7, SECURA_USER_XP, true ), 'le XP total est inchangé' );

echo "\nTrophées\n";
$added = Secura_Progress::add_trophy( 7, 'first_key', 'Première clé', 'Description', '🔑' );
check( $added['added'], 'un trophée est ajouté' );
$again_trophy = Secura_Progress::add_trophy( 7, 'first_key', 'Première clé', 'Description', '🔑' );
check( ! $again_trophy['added'], 'un trophée déjà obtenu n\'est pas dupliqué' );
check( 1 === count( get_user_meta( 7, SECURA_USER_TROPHIES, true ) ), 'la collection contient un trophée' );

echo "\nLecture des questions\n";
$questions = Secura_Rooms::get_questions( 42 );
check( 2 === count( $questions ), 'les questions sont relues' );
check( 'A1' === $questions[0]['answers'][0], 'les réponses acceptées sont conservées' );

$GLOBALS['securatest_meta'][ 43 ][ SECURA_META_QUESTIONS ] = array(
	array( 'question' => 'Sans réponse', 'answers' => array(), 'xp' => 10 ),
	array( 'question' => 'Question valide', 'answers' => array( 'Oui' ), 'xp' => 10 ),
);
$filtered = Secura_Rooms::get_questions( 43 );
check( 1 === count( $filtered ), 'une question sans réponse acceptée est ignorée' );

echo "\n" . str_repeat( '-', 46 ) . "\n";
echo "Résultat : " . $passed . " test(s) réussi(s), " . $failed . " échec(s).\n";

exit( $failed > 0 ? 1 : 0 );
