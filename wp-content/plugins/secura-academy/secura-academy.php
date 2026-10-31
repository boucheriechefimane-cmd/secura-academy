<?php
/**
 * Plugin Name:       Secura Academy
 * Plugin URI:        https://github.com/boucheriechefimane-cmd/secura-academy
 * Description:       Plateforme d'apprentissage gratuite et multilingue de la cybersécurité : parcours, rooms guidées, exercices pratiques, examens, XP, médailles et terminal simulé.
 * Version:           0.4.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Secura Academy
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       seca-academy
 *
 * @package Secura_Academy
 *
 * 0.3.0 — Validation croisée : le QCM valide, la manipulation pratique valide
 *         aussi. Format par tâche (leçon / QCM / pratique / mixte), seuil de
 *         passage effectif, terminal jouable dans chaque room, réservation
 *         atomique des questions, reprise d'un examen raté, limitation de débit,
 *         schéma de progression versionné, messages serveur traduits.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SECURA_ACADEMY_VERSION', '0.4.0' );
define( 'SECURA_ACADEMY_FILE', __FILE__ );
define( 'SECURA_ACADEMY_PATH', plugin_dir_path( __FILE__ ) );
define( 'SECURA_ACADEMY_URL', plugin_dir_url( __FILE__ ) );

/* Identifiants de stockage. */
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
define( 'SECURA_USER_TROPHIES', 'secura_trophies' );
define( 'SECURA_USER_MEDALS', 'secura_medals' );
define( 'SECURA_USER_EXAMS', 'secura_exams' );
define( 'SECURA_USER_TERMINALS', 'secura_terminals' );
define( 'SECURA_USER_STREAK', 'secura_streak' );
define( 'SECURA_USER_LANG', 'secura_lang' );
define( 'SECURA_USER_RANKS', 'secura_ranks' );
define( 'SECURA_OPTION_FIRST_BLOOD', 'secura_first_blood' );

require_once SECURA_ACADEMY_PATH . 'includes/class-secura-i18n.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-rooms.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-paths.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-progress.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-terminal.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-lab.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-ajax.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-dashboard.php';
require_once SECURA_ACADEMY_PATH . 'includes/default-content.php';

/**
 * Amorce le plugin.
 */
final class Secura_Academy {

	/**
	 * Branche les différents modules.
	 */
	public static function init() {
		Secura_I18n::init();
		Secura_Rooms::init();
		Secura_Paths::init();
		Secura_Progress::init();
		Secura_Terminal::init();
		Secura_Lab::init();
		Secura_Ajax::init();
		Secura_Dashboard::init();
	}
}

Secura_Academy::init();

register_activation_hook( SECURA_ACADEMY_FILE, array( 'Secura_Rooms', 'activate' ) );
