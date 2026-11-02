<?php
/**
 * Plugin Name:       Secura Academy
 * Plugin URI:        https://github.com/boucheriechefimane-cmd/secura-academy
 * Description:       Plateforme d'apprentissage gratuite et multilingue de la cybersécurité : parcours, rooms guidées, exercices pratiques, examens, XP, médailles et terminal simulé.
 * Version:           0.10.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Secura Academy
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       seca-academy
 *
 * @package Secura_Academy
 *
 * 0.10.0 — Le reservoir d'un examen ne compte plus deux fois la meme
 *           question (la question d'entrainement et la question
 *           d'examen d'une meme room) : la mesure etait gonflee de
 *           moitie, et deux eleves pouvaient recevoir le meme ensemble
 *           de questions. Le reservoir deduplique desormais, et
 *           l'ENSEMBLE de questions est reserve par un compteur : deux
 *           eleves ne peuvent pas avoir le meme examen tant que le
 *           reservoir le permet. L'ordre et les chiffres restent tires
 *           au sort, et la copie d'un eleve reste reproductible.
 *           Premiere importation d'un examen reel : 17 questions du MIT
 *           OpenCourseWare 6.858 (Fall 2014), avec le corrige officiel
 *           du MIT (licence CC BY-NC-SA 4.0), dans le format d'origine.
 * 0.9.1 — Les questions qui demandent la machine (drapeau, action) ne se
 *           tirent plus au sort : elles font partie de la mission de la
 *           room, donc elles restent TOUJOURS dans la copie de l'eleve.
 *           Avant, le tirage pouvait les remplacer par d'autres questions
 *           de la section : les 60 questions de drapeau et la question
 *           d'action n'etaient donc jamais posees — la room etait
 *           impossible a valider. Le reste du tirage (ordre des
 *           propositions, chiffres) est unchanged.
 *           Nouvelle : l'import de questions deja validees (universites,
 *           OWASP, NIST, examens de certification autorises). Le
 *           catalogue des sources et l'outil d'import refusent tout ce
 *           qui n'y figure pas ; la room affiche un encart « Sources ».
 * 0.9.0 — Chaque eleve passe SA copie. Avant, tous les eleves avaient
 *           exactement le meme examen : memes questions, meme ordre,
 *           memes chiffres — une photo d'ecran suffisait a reussir.
 *           Desormais l'examen est tire au sort dans le reservoir du
 *           niveau (la section entiere du parcours), les propositions
 *           sont melangees, et les chiffres changent quand l'explication
 *           ne parle pas d'eux (sinon l'explication deviendrait fausse).
 *           Une nouvelle tentative redonne une autre copie ; recharger
 *           la page conserve la copie en cours.
 *           Les questions PARAMETRIQUES vont plus loin : leurs chiffres
 *           sont ecrits avec des {mots} (par exemple « un buffer de
 *           {taille} octets ») et le moteur y injecte les valeurs d'une
 *           variante tiree au sort. Deux eleves qui font le meme examen
 *           ne voient donc pas les memes nombres — et l'explication, qui
 *           utilise les memes {mots}, reste vraie. C'est la seule facon
 *           de changer un chiffre qui est un fait (un port, un code
 *           HTTP) : ici, le chiffre est invente par la question.
 * 0.8.4 — Correction : le bloc Kahoot titrait en <h3> alors que tous les
 *           autres blocs de room titrent en <h2>. Dans la room « Kahoot :
 *           la revision des labs avances », la hierarchie des titres
 *           sautait donc du niveau 1 au niveau 3 — un lecteur d'ecran
 *           annoncait « titre de niveau 2 manquant ». Le rendu visible
 *           est inchange (le style est porte par la classe
 *           « seca-kahoot-title »).
 * 0.8.3 — Le thème livre la feuille de style arabe : elle était demandée
 *           à une adresse qui n'existait pas (404), donc la mise en page
 *           arabe n'était jamais appliquée. Elle est en outre chargée
 *           dès que le visiteur lit en arabe, même si le site est en
 *           français. Un contrôle automatique vérifie désormais que
 *           toutes les feuilles de style d'une page se chargent.
 * 0.8.2 — Correctif : les pages légales sont créées partout, pas seulement
 *           sur un serveur web. Le plugin rangeait les textes légaux dans
 *           une variable globale ; or WP-CLI charge WordPress dans une
 *           portée de fonction, où une variable globale de plugin
 *           n'existe pas. Les pages légales n'étaient donc créées que par
 *           le web — jamais dans la CI, ni sur un site installé en ligne
 *           de commande. Les textes passent désormais par une fonction,
 *           qui existe dans tous les contextes ; et l'installation est
 *           vérifiée explicitement (scripts/ci-wordpress.sh), avec un
 *           message clair quand elle échoue.
 * 0.8.1 — Correctif : les noms d'actions AJAX sont revenus a leur contrat
 *           « secura_* » (le front, la recette et le plugin doivent
 *           employer le meme nom). Deux controles d'audit automatiques
 *           verifient désormais cette coherence.
 * 0.8.0 — Le comité d'audit à 15 experts : preuve obligatoire, rapports HTML,
 *           pages légales publiées, certification de chaque parcours.
 * 0.7.0 — Les robots d'IA et le maillage interne.
 *   - robots.txt écrit par le plugin : les robots de recherche et de
 *     citation (Googlebot, OAI-SearchBot, ChatGPT-User, Claude-SearchBot,
 *     Claude-User, PerplexityBot…) et les robots d'entraînement (GPTBot,
 *     ClaudeBot, Google-Extended, Applebot-Extended, CCBot…) sont nommés
 *     un par un et explicitement autorisés ; le plan du site est déclaré ;
 *   - llms.txt généré à partir du contenu réel (parcours et rooms avec
 *     leurs vraies adresses) : il ne peut pas devenir faux ;
 *   - l'accueil liste les 52 rooms et les 4 parcours ; chaque page de
 *     parcours liste ses rooms ; le catalogue public lie chaque room ;
 *   - la page d'accueil « Parcours » est créée automatiquement, et les
 *     textes de démonstration de WordPress sont mis de côté ;
 *   - l'archive d'auteur est fermée : elle exposait le nom du compte
 *     d'administration et dupliquait les contenus ;
 *   - les titres et descriptions suivent la langue affichée : une page
 *     arabe ne porte plus un titre français (Google y voyait un doublon) ;
 *   - 37 chaînes de traduction dégradées et 2 extraits français corrompus
 *     ont été reprises (72 corrections).
 *
 * 0.6.0 — Le bloc universitaire : la vidéo du cours dans la room, et les
 *   labs avancés.
 *   - la vidéo d'un cours apparaît en FAÇADE (image + bouton) : rien n'est
 *     chargé de YouTube avant le clic, iframe « youtube-nocookie » ensuite,
 *     lien de secours toujours visible, attribution (source, auteur, licence,
 *     durée) traduite en français, arabe et anglais ;
 *   - 22 rooms « Les universités » (MIT 6.858, MIT 6.857, pwn.college,
 *     CYBER.ORG, OWASP, Stanford) avec leurs vidéos réelles et 155 questions ;
 *   - 14 rooms de labs avancés : OWASP Juice Shop (application vulnérable
 *     officielle), un dojo de vingt défis en cinq ceintures, six briefs vidéo,
 *     et le quiz Kahoot exportable en CSV ;
 *   - trois nouvelles machines : « univ-01 » (salle des cours), « dojo-01 »
 *     (le dojo) et le lab Juice Shop (réseau fermé, drapeaux protégés) ;
 *   - les preuves restent vérifiées par le serveur, dans la machine, en root.
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

define( 'SECURA_ACADEMY_VERSION', '0.10.0' );
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
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-exam.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-terminal.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-lab.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-settings.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-ajax.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-dashboard.php';
require_once SECURA_ACADEMY_PATH . 'includes/default-content.php';
require_once SECURA_ACADEMY_PATH . 'includes/content-m3.php';
require_once SECURA_ACADEMY_PATH . 'includes/content-universites.php';

/* Les questions importees depuis l'exterieur (universites, examens).
   Chaque fichier est produit par tools/import-questions.py : il porte
   sa licence et son attribution, et le plugin ne charge que ceux-la. */
foreach ( (array) glob( SECURA_ACADEMY_PATH . 'includes/content-import-*.php' ) as $seca_import ) {
	require_once $seca_import;
}
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-video.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-kahoot.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-schema.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-robots.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-llms.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-site.php';
require_once SECURA_ACADEMY_PATH . 'includes/class-secura-authors.php';

/* Les pages legales : un simple tableau de textes, dans les trois
   langues. On le charge une fois pour toute la vie du site.

   On passe par une FONCTION, et non par une variable globale. La
   raison est subtle et a cout cher : WP-CLI charge WordPress dans une
   PORTEE DE FONCTION (Runner::load_wordpress), et une variable globale
   d'un plugin n'y existe donc pas. En CI, tout passe par WP-CLI : les
   pages legales n'etaient donc jamais creees, alors que tout
   fonctionnait sur un vrai serveur web. Une fonction, elle, existe
   toujours, quel que soit le contexte. */
if ( ! function_exists( 'seca_textes_legaux' ) ) {
	/**
	 * Les textes des pages legales, dans les trois langues.
	 *
	 * Le tableau est mis en cache pour la duree de la requete : il ne
	 * change jamais au cours d'une visite.
	 *
	 * @return array
	 */
	function seca_textes_legaux() {
		static $textes = null;

		if ( null === $textes ) {
			$textes = require SECURA_ACADEMY_PATH . 'includes/content-legal.php';
		}

		return is_array( $textes ) ? $textes : array();
	}
}

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
		Secura_Kahoot::init();
		Secura_Schema::init();
		Secura_Robots::init();
		Secura_Llms::init();
		Secura_Site::init();
		Secura_Authors::init();
	}
}

Secura_Academy::init();

register_activation_hook( SECURA_ACADEMY_FILE, array( 'Secura_Rooms', 'activate' ) );
