<?php
/**
 * Plugin Name:       Secura Academy
 * Plugin URI:        https://github.com/boucheriechefimane-cmd/secura-academy
 * Description:       Plateforme d'apprentissage gratuite et multilingue de la cybersécurité : parcours, rooms guidées, exercices pratiques, examens, XP, médailles et terminal simulé.
 * Version:           0.5.6
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Secura Academy
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       seca-academy
 *
 * @package Secura_Academy
 *
 * 0.5.6 — La recette WordPress passe dans GitHub (avec vrais plugins tiers)
 *   - nouveau workflow « wordpress.yml » : vrai WordPress + MySQL en service,
 *     recette de bout en bout et compatibilité avec les plugins du site ;
 *   - notre sélecteur de langue utilise « ?seca_lang= » : il ne se marche
 *     plus dessus avec Polylang (qui Teachait une erreur 404 sur nos pages) ;
 *   - notre choix de langue passe devant celui des autres plugins multilingues.
 *
 * 0.5.5 — Correction : un déploiement réussi n'est plus déclaré en échec
 *   (lecture du code de sortie fiable sur PHP 7.4 et 8), outillage de
 *   fabrication versionné, espace de travail allégé.
 *
 * 0.5.4 — Les dix scénarios M3 : missions vérifiées sur une vraie machine
 *   (le serveur lit le drapeau dans le conteneur de l'apprenant, en root),
 *   vrais QCM à une seule bonne réponse, machines multi-01 et internal-01,
 *   parcours « Scénarios M3 », audit honnête (docs/SCENARIOS-M3.md).
 *
 * 0.5.3 — Machines réellement lancées (runtime rootless) + recette serveur
 * 0.5.2 — Corrections trouvées en conditions réelles (WordPress 7.1 + lab Docker)
 *   - le filtre « locale » ne boucle plus (le site se figeait) ;
 *   - le dossier des labs est lu de façon fiable (constante, option ou base) ;
 *   - le réseau dédié est créé avant la machine (sinon « docker run » échoue).
 *
 * 0.5.1 — Isolation stricte des machines cibles : réseau et projet Docker
 *         Compose renommés par apprenant et par room, réseau créé sans sortie
 *         Internet, rooms de démonstration branchées à une vraie machine,
 *         page de réglages (dossier des labs, first blood).
 *
 * 0.5.0 — Types de question : réponse libre, choix multiple (vrai QCM) et
 *         question « sans réponse » (l'apprenant confirme l'action, le
 *         serveur vérifie l'état réel du terminal). Correction du champ de
 *         saisie qui n'était pas inséré dans la page : le flux de réponse
 *         était cassé dans le navigateur.
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

define( 'SECURA_ACADEMY_VERSION', '0.5.6' );
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
define( 'SECURA_META_TRACK', '_secura_track' );
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
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-settings.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-ajax.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-dashboard.php';
require_once SECURA_ACADEMY_PATH . 'includes/default-content.php';
require_once SECURA_ACADEMY_PATH . 'includes/content-m3.php';
require_once SECURA_ACADEMY_PATH . 'includes/content-universites.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-video.php';

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
	Secura_Settings::init();
		Secura_Ajax::init();
		Secura_Dashboard::init();
		Secura_Video::init();
	}
}

Secura_Academy::init();

register_activation_hook( SECURA_ACADEMY_FILE, array( 'Secura_Rooms', 'activate' ) );
