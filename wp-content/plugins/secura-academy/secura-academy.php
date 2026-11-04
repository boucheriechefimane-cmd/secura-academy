<?php
/**
 * Plugin Name:       Secura Academy
 * Plugin URI:        https://github.com/boucheriechefimane-cmd/secura-academy
 * Description:       Plateforme d'apprentissage gratuite et multilingue de la cybersécurité : parcours, rooms guidées, exercices pratiques, examens, XP, médailles et terminal simulé.
 * Version:           0.12.1
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Secura Academy
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       seca-academy
 *
 * @package Secura_Academy
 *
 * 0.12.1 — Les faux positifs du comite corriges a la racine.
 *
 *           - Les 20 questions du quiz MIT 6.172 ont enfin un indice :
 *             l'eleve etait bloque sans aucune aide. L'extracteur
 *             (tools/import-mit-blocs.py) et le lot sont corriges.
 *           - L'audit externe lui-meme etait en cause sur trois points :
 *             un typo de variable qui signalait 536 questions a tort,
 *             une regle qui contredisait son propre libelle sur le
 *             format Stanford CS224N (4 propositions), et une
 *             recherche d'attribution qui ignorait le HTML servi.
 *             Voir docs/AUDITS-REGISTRE.md.
 *
 * 0.12.0 — Le moteur de recolte, les six robots, et trois nouveaux cours
 *           (Stanford CS107, Stanford CS224N, MIT 6.867) : 144 questions
 *           de plus.
 *
 *           - Le moteur (tools/criblage-ocw.py) : le sitemap d'OCW donne
 *             2 587 cours en une requete, mais ne dit pas ce qu'ils
 *             contiennent. Le moteur lit chaque cours, regarde le NOM des
 *             fichiers (un fichier « ..._sol.pdf » annonce un corrige) et
 *             la licence de la page. Premier passage : 430 cours analyses,
 *             66 avec un corrige ET une licence Creative Commons, dont 55
 *             jamais vus.
 *           - Le partage en six (tools/criblage-ocw.py --shard i/6 et le
 *             workflow .github/workflows/criblage-ocw.yml) : six robots,
 *             chacun son sixieme du catalogue, puis fusion des rapports.
 *           - Le telechargement en parallele (tools/telecharger-ocw.py) :
 *             615 documents de neuf cours en 104 secondes, six en meme
 *             temps.
 *           - Dixieme extracteur (tools/import-stanford-problemes.py) : le
 *             format Stanford « Problem N (Titre) (X points) » avec les
 *             parties (a), (b)... et le corrige officiel separe.
 *             Stanford CS107 : 41 questions.
 *           - Onzieme extracteur (tools/import-stanford-cs224n.py) : les
 *             QCM a coches (© / √) et les QCM a lettres avec « Solution: ».
 *             Stanford CS224N : 67 questions.
 *           - Douzieme extracteur (tools/import-mit-vrai-faux.py) : les QCM
 *             « T/F » du MIT, dont la reponse officielle est imprimee en
 *             marge a droite. MIT 6.867 : 36 questions.
 *
 * 0.11.9 — Deux nouveaux extracteurs, 47 questions de plus, et une
 *           correction du bac a sable qui durait depuis des semaines.
 *
 *           - Huitieme extracteur (tools/import-mit-parts-reponses.py) :
 *             les parties numerotees avec les reponses en ligne (MIT
 *             18.404J) et les enonces numerotes avec leur corrige (MIT
 *             6.851). 32 questions.
 *           - Neuvieme extracteur (tools/import-stanford-cs230.py) : le
 *             format Stanford (« (a) (2 points) ... » puis « Solution: »).
 *             8 questions du midterm du CS230.
 *           - Le MIT 6.005 repasse de 2 a 9 questions : une question a
 *             plusieurs bonnes reponses devient une REDACTION (l'enonce
 *             et les propositions restent mot pour mot ; seule la maniere
 *             de repondre change, parce que la plateforme n'a qu'une
 *             seule bonne reponse).
 *           - La correction officielle d'une question redigee peut
 *             desormais faire 30 caracteres au lieu de 80 : la reponse
 *             d'un QCM est complete meme quand elle est courte
 *             (« Solution : (i), (iv). »).
 *
 * 0.11.8 — La recolte continue, et un faux negatif de diagnostic corrige.
 *           Quatre cours que l'on croyait illisibles (le diagnostic
 *           comptait les caracteres APRES l'en-tete OCW, qui est en fin de
 *           fichier) sont en fait parfaitement lisibles : le MIT 6.046J
 *           Spring 2012 (56 questions), le MIT 6.006 Fall 2011 (57), le
 *           MIT 6.005 Software Construction, et le MIT 6.01SC. Un
 *           septieme extracteur couvre le format « choix multiples » du
 *           6.005 : « Problem N » + parties (a) + options A./B./C. et un
 *           repere « Solution. » ; les options d'origine sont conservees,
 *           et une question dont le corrige nomme PLUSIEURS bonnes
 *           reponses est refusee — la plateforme n'a qu'une seule bonne
 *           reponse, en garder une parmi plusieurs en inventerait une.
 *           La banque passe de 735 a 850 questions et le manque de
 *           reservoir tombe de 22 a 20.
 *           est couvert. Les quiz du MIT 6.006 (Introduction to
 *           Algorithms, Spring 2008, licence CC BY-NC-SA 4.0) presentent
 *           chaque probleme par un titre, un preambule, puis des items
 *           numerotes ; le corrige officiel pose un repere « Solution: »
 *           apres chacun. Un sixieme extracteur apparie les problemes
 *           puis les items — par ordre, mais toujours VERIFIES : meme
 *           titre, memes premiers mots, et le meme nombre d'items des
 *           deux cotes (le corrige du 6.046J SMA-5503, lui, en omet un :
 *           l'appariement est alors abandonne). 15 questions retenues,
 *           20 refusees (reponses deformees par l'extraction, items qui
 *           dependent d'un schema, appariements qui ne correspondent
 *           pas). Les items vrai/faux gardent les deux propositions du
 *           corrige (True / False), et la justification du MIT devient
 *           l'explication. La banque passe de 720 a 735 questions.
 *           Les mini-quiz du MIT 6.189 (Multicore Programming Primer,
 *           janvier 2007, licence CC BY-NC-SA 4.0) sont corriges par le
 *           MIT en repetant l'enoncE avant de repondre. Un cinquieme
 *           extracteur retrouve l'enoncE dans le corrige mot pour mot,
 *           et ne retient que le texte qui suit : l'appariement est
 *           donc verifie, jamais suppose. 3 questions retenues sur 6
 *           (verrouillage mortel, conditions de concurrence, mur de
 *           memoire) ; les 3 autres sont refusees : une repose sur du
 *           code, une sur des schemas, une repete l'enoncE avec un mot
 *           different. La banque passe de 717 a 720 questions et le
 *           manque de reservoir des examens tombe de 25 a 22.
 *           couvert. Les quiz du MIT 6.004 (Computation Structures,
 *           Spring 2009, licence CC BY-NC-SA 4.0) se presentent sous la
 *           forme de blancs ou l'eleve ecrit sa reponse ; le corrige
 *           officiel imprime la bonne reponse juste au-dessus. Un
 *           quatrieme extracteur verifie l'appariement (le libelle du
 *           blanc doit etre le meme dans l'enonce et dans le corrige) et
 *           n'accepte que les reponses imprimees dans la colonne de
 *           droite : 5 questions retenues, 60 refusees. Les options
 *           cerclees (le corrige les met en gras, ce que pdftotext ne
 *           voit pas) et les questions qui dependent d'un schema sont
 *           refusees : on ne devine jamais une reponse. Le meme
 *           extracteur passe sur le MIT 6.035 : 0 question retenue, donc
 *           rien n'est importe. La banque passe de 712 a 717 questions.
 *           controle retrouve la taille de l'epreuve. Une question
 *           reprise d'un examen universitaire (elle porte sa source et
 *           sa licence) etait versee dans la tache « test » de la room :
 *           le point de controle de l'eleve grossissait alors jusqu'a
 *           80 questions a rendre, la regle du moteur (« le test fait
 *           la taille de l'epreuve, jamais plus ») etant detournee.
 *           Mesure : 36 rooms gonfles, 320 questions importees, point
 *           de controle de 80 et 77 questions sur les deux rooms
 *           Stanford. Correction : les questions importees vivent dans
 *           une RESERVE, qui alimente le reservoir des epreuves de la
 *           section — les copies d'examen restent donc aussi variees,
 *           et la copie servie du test revient a 2 a 10 questions
 *           (mesure apres : mediane 4, reservoir Stanford 164,
 *           manque de reservoir 25, 46 examens deverrouilles au lieu
 *           de 26). Trois garde-fous automatiques verifient la regle
 *           (aucune question importee dans une tache, copie servie
 *           jamais plus grande que l'epreuve, reserve bien alimentee
 *           par le reservoir) et six tests de non-regression
 *           verifient la separation.
 * 0.11.3 — Deux nouveaux cours d'examen du MIT sont importes avec leurs
 *           corriges officiels : 6.828 Operating System Engineering
 *           (Fall 2012, 4 examens) et 14.15J Networks (Spring 2018).
 *           45 questions de plus, chacune verifiee contre le corrige du
 *           MIT — la justification affichee a l'eleve est la reponse
 *           officielle, mot pour mot. La banque passe de 524 a 569
 *           questions, et le manque de reservoir des examens tombe de
 *           80 a 31. L'extracteur devient parametrable (cours, licence,
 *           attribution, prefixe) : le meme outil sert pour 6.858, 6.828,
 *           14.15J et les suivants ; un second extracteur prend en charge
 *           le format « probleme + sous-questions » (14.15J).
 * 0.11.2 — Un fichier JavaScript illisible casse TOUTE l'interface : plus
 *           aucune reponse n'est envoyee, plus aucun indice n'apparait. Une
 *           apostrophe non echappee dans une chaine (le message « ecris ta
 *           reponse avant d'afficher la correction ») rendait academy.js
 *           illisible par le navigateur. Aucun audit ne l'avait vu : les
 *           auditeurs interrogent le serveur, ils n'executent pas le
 *           JavaScript. Desormais la syntaxe de chaque fichier .js est
 *           verifiee (node --check) dans la CI ET avant les dix-huit
 *           auditeurs — et le controle a ete ajoute parce qu'il manquait,
 *           pas parce qu'il trouverait un defaut.
 * 0.11.1 — Le serveur valide enfin la COPIE servie a l'eleve. Il
 *           verifiait l'index de la reponse dans la liste d'origine,
 *           alors que l'eleve repond a la copie tiree (reservoir du
 *           niveau, propositions melangees) : quand la copie est plus
 *           longue que la liste d'origine, le serveur refusait des
 *           questions que l'eleve voyait (« Question invalide »), et
 *           la question de drapeau, toujours en fin de copie, ne
 *           pouvait plus etre repondue — la room ne pouvait plus etre
 *           finie. Le meme decalage donnait l'indice d'une autre
 *           question et faisait compter le score sur la mauvaise
 *           liste. Point de passage unique : Secura_Exam::question_copie(),
 *           utilise par le serveur et par les audits. En passant, le
 *           tirage ne renvoie plus jamais tout le reservoir : le test
 *           (point de controle) a la taille de l'examen de sa room,
 *           soit 2 a 5 questions au lieu de 2 a 39.
 * 0.11.0 — L'import d'un examen reel passe a l'echelle : les 12 quiz
 *           du MIT OpenCourseWare 6.858 (2009-2014) et leurs corriges
 *           officiels donnent 132 questions (17 a choix, 115 problemes
 *           d'examen rediges). Un nouveau type de question, « solution »,
 *           fait apparaitre un VRAI probleme d'examen universitaire :
 *           l'eleve redige sa reponse, puis la correction officielle de
 *           l'ecole s'affiche mot pour mot. Aucune note automatique
 *           n'est inventee (une redaction ne se note pas par machine).
 *           Le reservoir d'un examen passe de 6-24 a 9-39 questions
 *           distinctes, et les examens au reservoir trop juste sont
 *           passes de 36 a 22. Le catalogue des sources gagne une
 *           entree refusee : MIT 6.1600 (quiz et corriges publics, mais
 *           sans licence Creative Commons -> on cite, on n'importe pas),
 *           avec un test automatique qui le prouve.
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

define( 'SECURA_ACADEMY_VERSION', '0.12.1' );
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
