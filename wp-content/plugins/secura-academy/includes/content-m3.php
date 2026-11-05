<?php
/**
 * Les dix scenarios M3 — dix missions jouables, une par semaine.
 *
 * Chaque scenario part d'une situation que n'importe quel apprenant peut
 * rencontrer (un service qui ne repond plus, un mot de passe oublie, une
 * page qui se trahit), puis demande d'agir sur une vraie machine et de
 * rapporter une preuve : le drapeau.
 *
 * Le drapeau n'est PAS un texte a recopier : il est verifie par le
 * serveur, qui va le lire dans la machine de l'apprenant. On ne peut pas
 * valider l'etape sans l'avoir vraiment trouve.
 *
 * Une seule image sert plusieurs scenarios (multi-01) : c'est ce qui rend
 * le contenu tenable dans le temps.
 *
 * Les questions d'entrainement et d'examen sont de vrais QCM : une seule
 * bonne reponse par question, les distracteurs etant de vraies erreurs
 * d'apprenant (et non des reformulations de la bonne reponse).
 *
 * @package Secura_Academy
 */

defined( 'ABSPATH' ) || exit;

/**
 * Les dix scenarios M3.
 *
 * @return array[]
 */
function seca_default_rooms_m3() {
	return array(
array(
			'title' => 'Le service qui ne repond plus',
			'excerpt' => 'Un service plante, personne ne sait pourquoi. Apprends a faire un triage methodique avant de toucher a quoi que ce soit.',
			'content' => 'Ton equipe support te passe un ticket d\'incident : plus personne ne peut se connecter. Tu ne vas pas deviner : tu vas observer, relever, puis conclure. Cette methode — observer, relever, conclure — est le squelette de tout le reste de la plateforme.',
			'difficulty' => 'facile',
			'duration' => 25,
			'xp_bonus' => 30,
			'track' => 'm3',
			'lab' => array(
				'enabled' => 1,
				'driver' => 'auto',
				'mode' => 'single',
				'image' => 'securalabs/multi-01:1.0',
				'network' => 'seca_lab',
				'command' => 'sleep infinity',
				'workdir' => '/home/ctf',
				'target' => 'http://127.0.0.1:8080',
				'ttl' => 3600,
				'allow' => array( 'ls', 'cat', 'grep', 'curl', 'head', 'tail', 'wc' ),
			),
			'tasks' => array(
				array(
					'type' => 'lesson',
					'format' => 'lecon',
					'title' => 'Task 1 : Le triage en quatre gestes',
					'content' => '<p>Quand un service ne repond plus, on ne « corrige » pas au hasard. On suit une methode :</p><ol><li><strong>Relever</strong> : qu\'est-ce qui ne marche pas, depuis quand, pour qui ?</li><li><strong>Observer</strong> : la machine elle-meme. Une page d\'etat, un fichier de configuration, un journal : la panne y laisse toujours une trace.</li><li><strong>Comparer</strong> : ce qui est dit dans la trace et ce qui est attendu.</li><li><strong>Conclure</strong> : une phrase, pas une intuition.</li></ol><p><strong>A retenir :</strong> une bonne observation vaut mieux qu\'une correction au hasard. Sur cette machine, l\'application est saine : le probleme vient de la <em>configuration</em>.</p>',
					'questions' => array(),
				),
				array(
					'type' => 'practice',
					'format' => 'qcm',
					'title' => 'Task 2 : Entrainement',
					'content' => '<p>Trois questions pour ancrer la methode du triage.</p>',
					'questions' => array(
						array(
							'question' => 'Tu dois diagnostiquer un site qui ne repond plus. Par quoi commencer ?',
							'mode' => 'choice',
							'choices' => array( 'En changeant le mot de passe de la base', 'En supprimant les journaux pour repartir de zero', 'Par collecter des preuves sur la machine', 'En redemarrant le serveur tout de suite' ),
							'correct' => 2,
							'xp' => 10,
							'hint' => 'Une correction sans observation, c\'est un coup au hasard.',
							'explanation' => 'Le triage commence par l\'observation : une page d\'etat, un journal, une configuration. On corrige apres, pas avant.',
						),
						array(
							'question' => 'Tu lis un fichier de configuration et tu y trouves un mot de passe en clair. Que retiens-tu ?',
							'mode' => 'choice',
							'choices' => array( 'C\'est normal pour un serveur interne', 'Il suffit de restreindre les droits du fichier', 'Ce n\'est un probleme que si le fichier est sur Internet', 'Un secret en clair dans un fichier est un risque, il faut le signaler' ),
							'correct' => 3,
							'xp' => 10,
							'hint' => 'Pense au sort du fichier : qui peut le lire ?',
							'explanation' => 'Un secret ecrit en clair dans un fichier est lu par quiconque a acces au fichier. C\'est un defaut a signaler, meme si ce n\'est pas la panne.',
						),
						array(
							'question' => 'Qu\'est-ce qui fait qu\'une trace dans un journal est utile ?',
							'mode' => 'choice',
							'choices' => array( 'Elle est horodatee et elle dit ce qui s\'est passe', 'Elle est ecrite en couleur dans le terminal', 'Elle contient le nom de l\'administrateur du serveur', 'Plus le fichier de journal est gros, plus la trace est utile' ),
							'correct' => 0,
							'xp' => 10,
							'hint' => 'Sans heure ni evenement, une ligne de journal ne raconte rien.',
							'explanation' => 'Une trace utile indique QUAND et QUOI. C\'est ce qui permet de relier un evenement a une periode precis.',
						),
					),
				),
				array(
					'type' => 'test',
					'format' => 'qcm',
					'title' => 'Task 3 : La mission',
					'content' => '<p><strong>Mission.</strong> Deploie la machine, puis fais ton triage. L\'application est-elle en cause ? Ou bien la configuration ?</p><p>La reponse est dans la machine : lis la configuration de l\'application et releve son numero de version interne. Ce code est la preuve que tu as conclu le triage.</p>',
					'questions' => array(
						array(
							'question' => 'Releve le code de version interne de l\'application (le « build_id »).',
							'mode' => 'flag',
							'flag_path' => '/root/flags/flag-01.txt',
							'xp' => 30,
							'hint' => 'La page d\'etat du service indique ou se trouve la configuration. Elle est dans /srv/app.',
							'explanation' => 'Le code de version (build_id) identifie precisement la version deployee. En exploitation, on s\'en sert pour savoir quel correctif appliquer.',
						),
					),
				),
				array(
					'type' => 'exam',
					'format' => 'qcm',
					'title' => 'Task 4 : Examen de fin de scenario',
					'content' => '<p>Cinq questions, chronometrees. 60 % suffisent pour valider.</p>',
					'time_limit' => 300,
					'pass_score' => 60,
					'questions' => array(
						array(
							'question' => 'Quel est le premier reflexe lors d\'un service qui ne repond plus ?',
							'mode' => 'choice',
							'choices' => array( 'Reinstaller le serveur', 'Couper le trafic pour proteger le site', 'Collecter des preuves', 'Redemarrer le service' ),
							'correct' => 2,
							'xp' => 15,
							'hint' => 'Le premier reflexe, c\'est de voir, pas de toucher.',
							'explanation' => 'Observer d\'abord : redemarrer sans comprendre detruit souvent la seule preuve.',
						),
						array(
							'question' => 'Pourquoi un secret ecrit en clair dans un fichier de configuration est-il un probleme ?',
							'mode' => 'choice',
							'choices' => array( 'Parce que le fichier ne peut pas etre sauvegarde', 'Parce que le fichier occupe trop de place', 'Parce que les fichiers de configuration sont lents a lire', 'Parce que quiconque peut lire le fichier peut le lire' ),
							'correct' => 3,
							'xp' => 15,
							'hint' => 'Qui peut lire le fichier ?',
							'explanation' => 'La reponse repose sur l\'acces au fichier, pas sur la difficultes a deviner le mot de passe.',
						),
						array(
							'question' => 'Que doit contenir une trace de journal exploitable ?',
							'mode' => 'choice',
							'choices' => array( 'L\'heure et l\'evenement', 'Le nombre de visiteurs du jour', 'La couleur du site', 'Le mot de passe de l\'administrateur' ),
							'correct' => 0,
							'xp' => 15,
							'hint' => 'Une trace exploitable dit QUAND et QUOI.',
							'explanation' => 'L\'heure permet de situer l\'evenement, l\'evenement dit ce qui s\'est passe.',
						),
						array(
							'question' => 'Sur cette machine, ou se trouve le fichier de configuration de l\'application ?',
							'mode' => 'choice',
							'choices' => array( 'Dans /var/log/app/access.log', 'Dans /srv/app', 'Dans /var/backups/app/db.sql.bak', 'Dans /etc/passwd' ),
							'correct' => 1,
							'xp' => 15,
							'hint' => 'Regarde ce que dit la page d\'etat du service.',
							'explanation' => 'La page d\'etat du service (status.php) indique le chemin : c\'est exactement a cela que sert une page de diagnostic.',
						),
						array(
							'question' => 'Un service qui repond lentement, que faut-il faire en premier ?',
							'mode' => 'choice',
							'choices' => array( 'Redemarrer le service pour liberer la memoire', 'Migrer le service vers un autre serveur', 'Mesurer avant d\'optimiser', 'Augmenter la memoire du serveur' ),
							'correct' => 2,
							'xp' => 15,
							'hint' => 'On optimise ce qu\'on a mesure.',
							'explanation' => 'On mesure d\'abord : optimiser sans mesure, c\'est deviner.',
						),
					),
				),
			),
			'terminal' => array(
				'intro' => 'appareil@intranet:~$ ',
				'unknown' => 'bash: commande introuvable. Essaie « help ».',
				'success' => 'Diagnostic note : le service est en cause, pas la machine.',
				'steps' => array(
					array(
						'match' => array( 'curl -s http://localhost:8080/status.php', '/curl .*status\\.php/' ),
						'output' => 'Intranet — état du service
version : 2.4.1
journal : /var/log/app/access.log
config  : /srv/app/app.conf
',
						'hint' => 'La page d\'état du service indique où se trouve la configuration.',
					),
					array(
						'match' => array( 'cat /srv/app/app.conf', '/cat .*app\\.conf/' ),
						'output' => '[app]
name        = intranet
version     = 2.4.1
build_id    = FLAG=SECURA{triage_patient}
',
						'hint' => 'Le fichier de configuration contient le numéro de version interne.',
					),
				),
			),
			'i18n' => array(
				'ar' => array(
					'title' => 'الخدمة التي لا تستجيب',
					'excerpt' => 'خدمة متوقفة ولا أحد يعرف لماذا. تعلّم الفحص المنهجي قبل لمس أي شيء.',
					'tasks' => array(
						array(
							'title' => 'المهمة 1: الفرز بأربع خطوات',
						),
						array(
							'title' => 'المهمة 2: تدريب',
						),
						array(
							'title' => 'المهمة 3: المهمة — التشخيص',
						),
						array(
							'title' => 'المهمة 4: الامتحان',
						),
					),
				),
				'en' => array(
					'title' => 'The service that stopped answering',
					'excerpt' => 'A service is down and nobody knows why. Learn to triage methodically before touching anything.',
					'tasks' => array(
						array(
							'title' => 'Task 1: Triage in four steps',
						),
						array(
							'title' => 'Task 2: Practice',
						),
						array(
							'title' => 'Task 3: The mission',
						),
						array(
							'title' => 'Task 4: Exam',
						),
					),
				),
			),
		),
array(
			'title' => 'Le mot de passe oublie',
			'excerpt' => 'Personne ne se souvient du mot de passe de la base. Une seule source de verite existe — et elle est lisible.',
			'content' => 'Un mot de passe oublie n\'est pas un vrai probleme technique : c\'est un probleme d\'information. La bonne question n\'est pas « quel est le mot de passe ? » mais « ou est-ce que le mot de passe est note ? ».',
			'difficulty' => 'facile',
			'duration' => 20,
			'xp_bonus' => 25,
			'track' => 'm3',
			'lab' => array(
				'enabled' => 1,
				'driver' => 'auto',
				'mode' => 'single',
				'image' => 'securalabs/multi-01:1.0',
				'network' => 'seca_lab',
				'command' => 'sleep infinity',
				'workdir' => '/home/ctf',
				'target' => 'http://127.0.0.1:8080',
				'ttl' => 3600,
				'allow' => array( 'ls', 'cat', 'grep', 'curl', 'head' ),
			),
			'tasks' => array(
				array(
					'type' => 'lesson',
					'format' => 'lecon',
					'title' => 'Task 1 : Ou sont les secrets ?',
					'content' => '<p>Un secret (mot de passe, cle, jeton) doit etre stocke une seule fois, en un seul endroit, et l\'acces a cet endroit doit etre controle. Dans la realite, on trouve tres souvent l\'inverse :</p><ul><li>le secret est ecrit en clair dans un fichier de configuration ;</li><li>le fichier est lisible par tout le monde ;</li><li>et le meme secret a ete recopie dans trois autres fichiers.</li></ul><p><strong>A retenir :</strong> chercher un secret, c\'est chercher <em>ou il est</em>, pas <em>ce qu\'il est</em>. Et le dire, c\'est deja une Vulnerability : un secret en clair dans un fichier lisible, c\'est un secret a changer.</p>',
					'questions' => array(),
				),
				array(
					'type' => 'practice',
					'format' => 'qcm',
					'title' => 'Task 2 : Entrainement',
					'content' => '<p>Deux questions sur le stockage des secrets.</p>',
					'questions' => array(
						array(
							'question' => 'Ou doit se trouver un mot de passe, dans une application qui tourne bien ?',
							'mode' => 'choice',
							'choices' => array( 'Dans un fichier de configuration protege par un mot de passe', 'Dans le code source, chiffre par l\'application', 'Dans une variable de session', 'Dans un coffre (gestionnaire de secrets), pas dans un fichier lisible' ),
							'correct' => 3,
							'xp' => 10,
							'hint' => 'Pense a ce que veut dire « accessible par quiconque a le fichier ».',
							'explanation' => 'Le secret separe de l\'application : un coffre, des variables d\'environnement injectees, un service de secrets. Jamais en clair dans un fichier lisible.',
						),
						array(
							'question' => 'Tu trouves un mot de passe en clair dans un fichier de configuration. Quelle est la bonne reaction ?',
							'mode' => 'choice',
							'choices' => array( 'Le signaler et le faire tourner', 'Le corriger immediatement, sans rien dire a personne', 'Ne rien faire : c\'est un detail', 'Le publier dans le canal de l\'equipe pour que chacun le memorise' ),
							'correct' => 0,
							'xp' => 10,
							'hint' => 'Le probleme ne disparait pas parce que tu l\'as vu.',
							'explanation' => 'On signale, on propose un correctif (un coffre de secrets), puis on fait tourner la reponse. Le secret doit aussi etre change.',
						),
					),
				),
				array(
					'type' => 'test',
					'format' => 'qcm',
					'title' => 'Task 3 : La mission',
					'content' => '<p><strong>Mission.</strong> L\'equipe a besoin du mot de passe de la base pour une restauration. Il est note quelque part sur la machine. Trouve-le.</p><p>Indice : la page d\'etat du service indique ou se trouve la configuration de l\'application.</p>',
					'questions' => array(
						array(
							'question' => 'Quel est le mot de passe de la base de donnees ?',
							'mode' => 'text',
							'xp' => 30,
							'hint' => 'Le fichier de configuration est dans /srv/app. Lis-le en entier.',
							'explanation' => 'Le mot de passe etait ecrit en clair dans la configuration. C\'est exactement le defaut qu\'on signale : il faut un coffre de secrets et un changement immediat du mot de passe.',
							'answers' => array( 'Intranet2019!' ),
						),
					),
				),
				array(
					'type' => 'exam',
					'format' => 'qcm',
					'title' => 'Task 4 : Examen de fin de scenario',
					'content' => '<p>Cinq questions chronometrees. 60 % suffisent.</p>',
					'time_limit' => 300,
					'pass_score' => 60,
					'questions' => array(
						array(
							'question' => 'Quel est le risque principal d\'un secret en clair dans un fichier ?',
							'mode' => 'choice',
							'choices' => array( 'Qu\'il ralentit le chargement de l\'application', 'Qu\'il occupe une ligne de trop dans le fichier', 'Qu\'il expire au bout de quelques jours', 'Qu\'il est lisible par qu\'a le fichier' ),
							'correct' => 3,
							'xp' => 15,
							'hint' => 'Le secret separe de l\'application.',
							'explanation' => 'La protection d\'un secret repose sur le controle d\'acces au fichier ou il se trouve.',
						),
						array(
							'question' => 'Un secret trouve en clair doit-il etre change ?',
							'mode' => 'choice',
							'choices' => array( 'Oui, toujours', 'Non, tant que le serveur reste interne', 'Seulement si le fichier a ete publie sur Internet', 'Seulement si un administrateur l\'a signale' ),
							'correct' => 0,
							'xp' => 15,
							'hint' => 'On suppose que le secret a ete vu : il faut le considerer vole.',
							'explanation' => 'Oui : s\'il etait en clair, il faut considerer qu\'il a pu etre lu, et le changer.',
						),
						array(
							'question' => 'Que permet de faire une page de diagnostic (status.php) ?',
							'mode' => 'choice',
							'choices' => array( 'Reinitialiser la base de donnees', 'Repérer ou se trouvent les informations de l\'application', 'Modifier la configuration de l\'application a distance', 'Redemarrer le service web' ),
							'correct' => 1,
							'xp' => 15,
							'hint' => 'Une page de diagnostic observe, elle ne commande pas.',
							'explanation' => 'Elle donne des chemins : c\'est une aide immense… et un point d\'entree pour un attaquant.',
						),
						array(
							'question' => 'Ou va le mot de passe d\'une application dans une architecture propre ?',
							'mode' => 'choice',
							'choices' => array( 'Dans le journal de demarrage du serveur', 'Dans un commentaire du fichier de configuration', 'Dans un coffre de secrets', 'Dans un fichier .env en clair a cote du code' ),
							'correct' => 2,
							'xp' => 15,
							'hint' => 'Le secret doit etre injecte au moment du demarrage.',
							'explanation' => 'Coffre de secrets, variables d\'environnement injectees au demarrage, ou service de secrets : le secret n\'est plus sur le disque lisible.',
						),
						array(
							'question' => 'Pourquoi un secret recopie dans plusieurs fichiers est-il dangereux ?',
							'mode' => 'choice',
							'choices' => array( 'Parce que l\'application demarre plus lentement', 'Parce que les fichiers ne peuvent plus etre compares', 'Parce qu\'il faut redeployer a chaque changement de secret', 'Parce qu\'il faut le changer partout' ),
							'correct' => 3,
							'xp' => 15,
							'hint' => 'Chaque copie est une porte d\'entree de plus.',
							'explanation' => 'Chaque copie est un point de fuite et un forgot de rotation : le secret se change sur un seul endroit.',
						),
					),
				),
			),
			'terminal' => array(
				'intro' => 'appareil@intranet:~$ ',
				'unknown' => 'bash: commande introuvable. Essaie « help ».',
				'success' => 'Secret localise. Un secret en clair est aussi un signalement a faire.',
				'steps' => array(
					array(
						'match' => array( 'cat /srv/app/app.conf', '/cat .*app\\.conf/' ),
						'output' => '[database]
host        = 127.0.0.1
name        = intranet
db_password = Intranet2019!
',
						'hint' => 'Le fichier de configuration est dans /srv/app.',
					),
				),
			),
			'i18n' => array(
				'ar' => array(
					'title' => 'كلمة المرور المنسية',
					'excerpt' => 'لا أحد يتذكر كلمة مرور قاعدة البيانات. هناك مصدر واحد للحقيقة، وهو مقروء.',
					'tasks' => array(
						array(
							'title' => 'المهمة 1: أين تُخزَّن الأسرار؟',
						),
						array(
							'title' => 'المهمة 2: تدريب',
						),
						array(
							'title' => 'المهمة 3: المهمة',
						),
						array(
							'title' => 'المهمة 4: الامتحان',
						),
					),
				),
				'en' => array(
					'title' => 'The forgotten password',
					'excerpt' => 'Nobody remembers the database password. There is one source of truth, and it is readable.',
					'tasks' => array(
						array(
							'title' => 'Task 1: Where do secrets live?',
						),
						array(
							'title' => 'Task 2: Practice',
						),
						array(
							'title' => 'Task 3: The mission',
						),
						array(
							'title' => 'Task 4: Exam',
						),
					),
				),
			),
		),
array(
			'title' => 'La page qui se trahit',
			'excerpt' => 'Une page renvoie ta saisie telle quelle. Un robot visite les pages la nuit : que va-t-il se passer ?',
			'content' => 'Ton equipe a deploye un moteur de recherche interne. Un soir, tu remarques que la page renvoie exactement ce que tu as tape. Une seule personne utilise ce moteur : l\'administrateur, qui le consulte chaque matin depuis son poste. Un script execute dans la page d\'un administrateur, c\'est un script execute avec ses droits.',
			'difficulty' => 'moyen',
			'duration' => 30,
			'xp_bonus' => 40,
			'track' => 'm3',
			'lab' => array(
				'enabled' => 1,
				'driver' => 'auto',
				'mode' => 'single',
				'image' => 'securalabs/multi-01:1.0',
				'network' => 'seca_lab',
				'command' => 'sleep infinity',
				'workdir' => '/home/ctf',
				'target' => 'http://127.0.0.1:8080',
				'ttl' => 3600,
				'allow' => array( 'ls', 'cat', 'grep', 'curl', 'head', 'python3' ),
			),
			'tasks' => array(
				array(
					'type' => 'lesson',
					'format' => 'lecon',
					'title' => 'Task 1 : Pourquoi une page qui « renvoie » est grave',
					'content' => '<p>Une page web fait trois choses : elle recoit des donnees (URL, formulaire), elle les melange a du code, et elle renvoie le resultat au navigateur.</p><p>Si les donnees sont renvoyees <strong>sans etre echappees</strong>, le navigateur les interprete comme du code : c\'est une <strong>injection de script</strong> (XSS). Le probleme n\'est pas la page : c\'est <em>qui la regarde</em>.</p><p>Un administrateur qui consulte la page avec sa session ouverte devient le vehicule. C\'est ce qu\'on appelle une <strong>injection de script reflechie</strong> : ta saisie revient dans la page, et c\'est le visiteur qui la declenche.</p><p><strong>A retenir :</strong> la parade n\'est pas de filtrer les mots dangereux, c\'est d\'<strong>echapper</strong> la sortie ( transformer `&lt;` en `&amp;lt;`) et d\'ajouter une en-tete CSP. Tant que tu reflects la saisie dans la page, tu reflects du code.</p>',
					'questions' => array(),
				),
				array(
					'type' => 'practice',
					'format' => 'qcm',
					'title' => 'Task 2 : Entrainement',
					'content' => '<p>Deux questions pour comprendre le mecanisme.</p>',
					'questions' => array(
						array(
							'question' => 'Qu\'est-ce qui rend une injection de script dangerous ?',
							'mode' => 'choice',
							'choices' => array( 'Elle s\'execute dans le navigateur du visiteur, avec ses droits', 'Elle s\'execute sur le serveur, avec les droits de l\'administrateur', 'Elle s\'execute dans la base de donnees', 'Elle ne s\'execute que sur les navigateurs anciens' ),
							'correct' => 0,
							'xp' => 10,
							'hint' => 'La page est sur TON serveur, mais elle est lue par SON navigateur.',
							'explanation' => 'Le script s\'execute chez le visiteur. Si le visiteur est un administrateur connecte, c\'est sa session qui est volee.',
						),
						array(
							'question' => 'Quelle est la parade correcte contre une injection de script ?',
							'mode' => 'choice',
							'choices' => array( 'Demander a l\'utilisateur de ne pas cliquer', 'Echapper la sortie et poser une CSP', 'Bloquer le mot « script » dans la saisie', 'Refuser toutes les requetes contenant des chevrons' ),
							'correct' => 1,
							'xp' => 10,
							'hint' => 'Le filtre par liste de mots est toujours incomplet.',
							'explanation' => 'On echappe systematiquement la sortie (htmlspecialchars) et on pose une CSP en defense en profondeur. Filtrer « script » est une impasse.',
						),
					),
				),
				array(
					'type' => 'test',
					'format' => 'qcm',
					'title' => 'Task 3 : La mission',
					'content' => '<p><strong>Mission.</strong> Le fichier <code>/home/ctf/notes.txt</code> mentionne un robot de supervision qui visite les pages la nuit. Lis-le, puis fais-lui visiter une page qui contient un script. Observe ce qu\'il enregistre, et rapporte le jeton qu\'il a vole.</p><p>Le robot ne comprend pas le JavaScript : il detecte la presence d\'un script et enregistre ce que le script aurait vole. La page se trouve dans <code>/var/www/html/</code>, et le journal du robot dans <code>/var/log/app/</code>.</p>',
					'questions' => array(
						array(
							'question' => 'Le robot a enregistre un jeton de session : donne-le.',
							'mode' => 'flag',
							'flag_path' => '/root/flags/flag-03.txt',
							'xp' => 35,
							'hint' => 'Le robot est lance par une page de l\'application. Fais-lui visiter une page ou ta saisie revient telle quelle.',
							'explanation' => 'Une charge utile de script dans la page de recherche, visitee par le robot de supervision, a fait enregistrer le jeton de l\'administrateur. La parade : echapper la sortie et poser une CSP.',
						),
					),
				),
				array(
					'type' => 'exam',
					'format' => 'qcm',
					'title' => 'Task 4 : Examen de fin de scenario',
					'content' => '<p>Cinq questions chronometrees. 60 % suffisent.</p>',
					'time_limit' => 300,
					'pass_score' => 60,
					'questions' => array(
						array(
							'question' => 'Ou s\'execute le code d\'une injection de script ?',
							'mode' => 'choice',
							'choices' => array( 'Dans le navigateur du visiteur', 'Dans le serveur web, avec les droits du service', 'Dans la base de donnees', 'Dans le terminal de l\'administrateur' ),
							'correct' => 0,
							'xp' => 15,
							'hint' => 'Qui execute le code que tu injectes ?',
							'explanation' => 'Dans le navigateur du visiteur : le serveur envoie du texte, c\'est le navigateur qui l\'execute.',
						),
						array(
							'question' => 'Pourquoi une injection reflechie est-elle dangereuse en entreprise ?',
							'mode' => 'choice',
							'choices' => array( 'Parce qu\'elle supprime les cookies du visiteur', 'Parce qu\'un visiteur de confiance (admin) peut la declencher', 'Parce qu\'elle sature le serveur de requetes', 'Parce qu\'elle rend le site plus lent pour tous' ),
							'correct' => 1,
							'xp' => 15,
							'hint' => 'Pense a qui consulte cette page en entreprise.',
							'explanation' => 'L\'impact depend de la victime. Viser un administrateur transforme une faille anodine en une prise de controle.',
						),
						array(
							'question' => 'Que fait exactement « echapper la sortie » ?',
							'mode' => 'choice',
							'choices' => array( 'Remplacer les mots dangereux par des asterisques', 'Bloquer la requete si elle contient une balise', 'Transformer les caracteres speciaux pour qu\'ils ne soient plus interpretes', 'Supprimer tous les caracteres < et > du texte' ),
							'correct' => 2,
							'xp' => 15,
							'hint' => 'On ne supprime pas le contenu : on change sa signification.',
							'explanation' => 'On transforme `<`, `>`, `&`, `"` en entites HTML : le navigateur les affiche au lieu de les executer.',
						),
						array(
							'question' => 'Un filtre qui bloque le mot « script » suffit-il ?',
							'mode' => 'choice',
							'choices' => array( 'Oui, si le filtre est applique sur toutes les pages', 'Oui, si l\'encodage de la page est en UTF-8', 'Oui, sauf sur les pages de connexion', 'Non, il est toujours contournable' ),
							'correct' => 3,
							'xp' => 15,
							'hint' => 'Un filtre se contourne avec une variante.',
							'explanation' => 'Oui : « scr<script>ipt » ou une balise d\'evenement contournent le filtre. Il faut echapper, pas filtrer.',
						),
						array(
							'question' => 'Une CSP, c\'est quoi ?',
							'mode' => 'choice',
							'choices' => array( 'Une en-tete qui dit au navigateur ce qu\'il a le droit de charger', 'Un pare-feu installe dans le navigateur', 'Une regle qui interdit aux robots de visiter la page', 'Un mot de passe du compte administrateur' ),
							'correct' => 0,
							'xp' => 15,
							'hint' => 'C\'est un en-tete envoye par le serveur au navigateur.',
							'explanation' => 'Content-Security-Policy : meme si un script s\'insere, le navigateur refuse de charger des sources non declarees. C\'est une defense en profondeur.',
						),
					),
				),
			),
			'terminal' => array(
				'intro' => 'appareil@intranet:~$ ',
				'unknown' => 'bash: commande introuvable. Essaie « help ».',
				'success' => 'Le robot a enregistre le jeton. La session d\'administrateur est compromise.',
				'steps' => array(
					array(
						'match' => array( 'cat /home/ctf/notes.txt', '/cat .*notes\\.txt/' ),
						'output' => 'Le robot de supervision visite les pages de l\'application chaque nuit.
Il est lance par bot.php.
',
						'hint' => 'Le ticket d\'incident te dit qui visite les pages la nuit.',
					),
					array(
						'match' => array( 'cat /var/log/app/stolen.txt', '/cat .*stolen\\.txt/' ),
						'output' => 'RIEN_DE_VOLE_POUR_LE_MOMENT
',
						'hint' => 'Le journal du robot est dans /var/log/app/.',
					),
				),
			),
			'i18n' => array(
				'ar' => array(
					'title' => 'الصفحة التي تفضح نفسها',
					'excerpt' => 'صفحة تُعيد ما تكتبه حرفيًا. روبوت يتصفح الصفحات ليلًا: ماذا سيحدث؟',
					'tasks' => array(
						array(
							'title' => 'المهمة 1: لماذا « إعادة » صفحة خطيرة',
						),
						array(
							'title' => 'المهمة 2: تدريب',
						),
						array(
							'title' => 'المهمة 3: المهمة',
						),
						array(
							'title' => 'المهمة 4: الامتحان',
						),
					),
				),
				'en' => array(
					'title' => 'The page that gives itself away',
					'excerpt' => 'A page echoes exactly what you type. A bot visits pages at night: what will happen?',
					'tasks' => array(
						array(
							'title' => 'Task 1: Why an echoing page is dangerous',
						),
						array(
							'title' => 'Task 2: Practice',
						),
						array(
							'title' => 'Task 3: The mission',
						),
						array(
							'title' => 'Task 4: Exam',
						),
					),
				),
			),
		),
array(
			'title' => 'La requete qui ne se fie a personne',
			'excerpt' => 'L\'application construit sa requete a partir de ce que tu tapes. Et si elle te croyait sur parole ?',
			'content' => 'La connexion de l\'application « Intranet » se fait en deux temps : le serveur envoie la page, ton navigateur renvoie ce que tu as tape, le serveur construit une requete SQL avec, puis l\'execute. Entre le second et le troisieme, il y a un point ou tu peux parler au serveur autrement que prevu.',
			'difficulty' => 'moyen',
			'duration' => 30,
			'xp_bonus' => 40,
			'track' => 'm3',
			'lab' => array(
				'enabled' => 1,
				'driver' => 'auto',
				'mode' => 'single',
				'image' => 'securalabs/multi-01:1.0',
				'network' => 'seca_lab',
				'command' => 'sleep infinity',
				'workdir' => '/home/ctf',
				'target' => 'http://127.0.0.1:8080',
				'ttl' => 3600,
				'allow' => array( 'ls', 'cat', 'grep', 'curl', 'python3', 'sqlite3' ),
			),
			'tasks' => array(
				array(
					'type' => 'lesson',
					'format' => 'lecon',
					'title' => 'Task 1 : Ce qu\'est une requete prete',
					'content' => '<p>Une requete SQL, c\'est du texte. Ce texte est construit par le programme, souvent a partir de ce que l\'utilisateur a tape :</p><p style="background:#1b1b1b;padding:.6em;color:#eee;font-family:monospace">SELECT id, username FROM users WHERE username = \'<b>ce que tu tapes</b>\' AND password = \'<b>ce que tu tapes</b>\'</p><p>Si tu tapes une apostrophe, tu fermes la chaine du programme et tu <strong>ecris a sa place</strong>. Une apostrophe suivie d\'un commentaire (`--`) neutralise la suite de la requete : la condition sur le mot de passe disparait.</p><p>La parade ne consiste pas a interdire l\'apostrophe : elle consiste a <strong>ne jamais coller les donnees dans le texte de la requete</strong>, mais a les passer a part (requete preparee), pour que le moteur distingue la structure et les donnees.</p><p><strong>A retenir :</strong> une requete preparee neutralise l\'injection ; un filtre sur un caractere la reporte.</p>',
					'questions' => array(),
				),
				array(
					'type' => 'practice',
					'format' => 'qcm',
					'title' => 'Task 2 : Entrainement',
					'content' => '<p>Deux questions sur les requetes.</p>',
					'questions' => array(
						array(
							'question' => 'Qu\'est-ce qui rend une requete SQL injectable ?',
							'mode' => 'choice',
							'choices' => array( 'Le grand nombre de tables dans la base', 'Le collage des donnees dans le texte de la requete', 'Le fait d\'utiliser une base de donnees SQL', 'L\'utilisation de requetes preparees' ),
							'correct' => 1,
							'xp' => 10,
							'hint' => 'Regarde comment la requete est construite.',
							'explanation' => 'Quand la donnee utilisateur entre dans le texte de la requete, elle peut en modifier la structure. Une requete preparee passe la donnee a part : plus d\'injection.',
						),
						array(
							'question' => 'Pourquoi une requete preparee est-elle sure ?',
							'mode' => 'choice',
							'choices' => array( 'Parce qu\'elle interdit toute erreur d\'authentification', 'Parce que le moteur refuse les requetes trop longues', 'Parce que la structure est fixee a l\'avance et la donnee est traitee comme une donnee', 'Parce qu\'elle est chiffree avant d\'arriver au serveur' ),
							'correct' => 2,
							'xp' => 10,
							'hint' => 'Le moteur distingue-t-il la structure et la donnee ?',
							'explanation' => 'Le moteur SQL recoit la structure et les donnees separement : aucune donnee ne peut plus modifier la structure de la requete.',
						),
					),
				),
				array(
					'type' => 'test',
					'format' => 'qcm',
					'title' => 'Task 3 : La mission',
					'content' => '<p><strong>Mission.</strong> L\'administration a perdu son mot de passe, mais elle existe. Passe outre l\'authentification, puis va chercher les secrets de l\'application : ils sont dans une table de la base de donnees. La page d\'administration (fournie apres connexion) te dira laquelle.</p><p>Indice : le fichier de notes en parle, et la page de connexion est sur le port 8080.</p>',
					'questions' => array(
						array(
							'question' => 'Le secret de la table « secrets » : donne-le.',
							'mode' => 'flag',
							'flag_path' => '/root/flags/flag-04.txt',
							'xp' => 35,
							'hint' => 'Une apostrophe ferme la chaine du programme. Essaie un commentaire apres, pour que le reste de la requete soit ignore.',
							'explanation' => 'Une apostrophe et un commentaire ont transforme la condition : la connexion passe sans mot de passe. La parade : requetes preparees partout, et un mot de passe haché (pas en clair) dans la base.',
						),
					),
				),
				array(
					'type' => 'exam',
					'format' => 'qcm',
					'title' => 'Task 4 : Examen de fin de scenario',
					'content' => '<p>Cinq questions chronometrees. 60 % suffisent.</p>',
					'time_limit' => 300,
					'pass_score' => 60,
					'questions' => array(
						array(
							'question' => 'Quelle est la parade contre l\'injection SQL ?',
							'mode' => 'choice',
							'choices' => array( 'L\'utilisation du HTTPS', 'Les requetes preparees', 'Le filtrage de l\'apostrophe dans le formulaire', 'La mise en cache des pages' ),
							'correct' => 1,
							'xp' => 15,
							'hint' => 'La parade se trouve dans le code, pas dans le filtre.',
							'explanation' => 'Requetes preparees : la structure est fixee, la donnee ne peut plus la modifier.',
						),
						array(
							'question' => 'Pourquoi faut-il hacher les mots de passe en base ?',
							'mode' => 'choice',
							'choices' => array( 'Pour que les identifiants soient plus courts', 'Pour que la connexion soit plus rapide', 'Pour qu\'une fuite de la base ne donne pas les mots de passe', 'Pour que la base occupe moins de place' ),
							'correct' => 2,
							'xp' => 15,
							'hint' => 'Pense au pire : la base est volee.',
							'explanation' => 'Si la base est volee, un mot de passe hache (avec sel) ne donne pas acces aux comptes.',
						),
						array(
							'question' => 'Que fait un commentaire SQL (`--`) dans une charge utile ?',
							'mode' => 'choice',
							'choices' => array( 'Il rend la requete plus lente', 'Il supprime la table visee', 'Il bloque la connexion au serveur', 'Il neutralise la fin de la requete' ),
							'correct' => 3,
							'xp' => 15,
							'hint' => 'Il sert a ignorer la fin de la requete.',
							'explanation' => 'Il ignore le reste de la requete : la condition sur le mot de passe disparait, la connexion passe.',
						),
						array(
							'question' => 'Un filtre qui refuse l\'apostrophe est-il une parade suffisante ?',
							'mode' => 'choice',
							'choices' => array( 'Non, il est contournable', 'Oui, si le filtre est applique a toutes les entrees', 'Oui, car l\'apostrophe est le seul caractere dangereux', 'Oui, si la base utilise l\'encodage UTF-8' ),
							'correct' => 0,
							'xp' => 15,
							'hint' => 'Un filtre porte sur un texte ; l\'attaque porte sur la structure.',
							'explanation' => 'Il est contournable (encodages, autres bases, autres techniques). La seule parade durable est la requete preparee.',
						),
						array(
							'question' => 'Pourquoi la table « secrets » est-elle une cible privilegiee ?',
							'mode' => 'choice',
							'choices' => array( 'Parce que son nom se devine facilement', 'Parce qu\'elle contient ce qu\'on ne doit pas perdre', 'Parce qu\'elle contient le plus grand nombre de lignes', 'Parce qu\'elle est la seule table modifiable' ),
							'correct' => 1,
							'xp' => 15,
							'hint' => 'Toutes les tables sont accessibles ; celle-ci coute plus cher.',
							'explanation' => 'Une injection SQL ne s\'arrête pas aux comptes : elle donne acces a toutes les tables. On segmente et on limite les privileges du compte applicatif.',
						),
					),
				),
			),
			'terminal' => array(
				'intro' => 'appareil@intranet:~$ ',
				'unknown' => 'bash: commande introuvable. Essaie « help ».',
				'success' => 'La connexion est passee. La base est ouverte : reste a lire les secrets.',
				'steps' => array(
					array(
						'match' => array( 'cat /home/ctf/notes.txt', '/cat .*notes\\.txt/' ),
						'output' => 'Le portail de connexion est sur http://localhost:8080/index.php
L\'administration a perdu son mot de passe.
',
						'hint' => 'Commence par lire le ticket d\'incident.',
					),
					array(
						'match' => array( 'cat /srv/app/app.conf', '/cat .*app\\.conf/' ),
						'output' => '[database]
host = 127.0.0.1
name = intranet
',
						'hint' => 'La configuration indique ou est la base.',
					),
				),
			),
			'i18n' => array(
				'ar' => array(
					'title' => 'الاستعلام الذي لا يثق بأحد',
					'excerpt' => 'التطبيق يبني استعلامه من ما تكتبه. وماذا لو صدّقك؟',
					'tasks' => array(
						array(
							'title' => 'المهمة 1: ما الاستعلام الجاهز؟',
						),
						array(
							'title' => 'المهمة 2: تدريب',
						),
						array(
							'title' => 'المهمة 3: المهمة',
						),
						array(
							'title' => 'المهمة 4: الامتحان',
						),
					),
				),
				'en' => array(
					'title' => 'The query that trusts no one',
					'excerpt' => 'The app builds its query from what you type. What if it believed you?',
					'tasks' => array(
						array(
							'title' => 'Task 1: What is a prepared query?',
						),
						array(
							'title' => 'Task 2: Practice',
						),
						array(
							'title' => 'Task 3: The mission',
						),
						array(
							'title' => 'Task 4: Exam',
						),
					),
				),
			),
		),
array(
			'title' => 'Le fichier qu\'on n\'aurait pas du laisser',
			'excerpt' => 'Une page qui telecharge un fichier sur demande. Et si tu demandais un autre fichier que celui prevu ?',
			'content' => 'Le service de documentation permet de télécharger un fichier par son nom. C\'est une feature très agréable — et une porte directe vers tout ce que le serveur peut lire.',
			'difficulty' => 'moyen',
			'duration' => 25,
			'xp_bonus' => 35,
			'track' => 'm3',
			'lab' => array(
				'enabled' => 1,
				'driver' => 'auto',
				'mode' => 'single',
				'image' => 'securalabs/multi-01:1.0',
				'network' => 'seca_lab',
				'command' => 'sleep infinity',
				'workdir' => '/home/ctf',
				'target' => 'http://127.0.0.1:8080',
				'ttl' => 3600,
				'allow' => array( 'ls', 'cat', 'grep', 'curl', 'head', 'strings' ),
			),
			'tasks' => array(
				array(
					'type' => 'lesson',
					'format' => 'lecon',
					'title' => 'Task 1 : Le chemin que tu choisis',
					'content' => '<p>Une <strong>traversee de repertoire</strong> consiste a faire sortir un chemin du dossier attendu. Le serveur prend un nom de fichier et l\'ajoute a un prefixe :</p><p style="background:#1b1b1b;padding:.6em;color:#eee;font-family:monospace">/var/www/html/ + <b>ce que tu demandes</b></p><p>Si ce que tu demandes contient <code>../</code>, le chemin remonte. Trois <code>../</code> depuis <code>/var/www/html</code> arrivent a la racine, et la suite du chemin devient libre.</p><p><strong>A retenir :</strong> la parade n\'est pas de filtrer « ../ » (un seul suffit a bloquer, mais les variantes sont infinies : encodages, doubles barres…). La parade est de <strong>resoudre le chemin reel puis de verifier qu\'il reste dans le dossier autorise</strong>.</p>',
					'questions' => array(),
				),
				array(
					'type' => 'practice',
					'format' => 'qcm',
					'title' => 'Task 2 : Entrainement',
					'content' => '<p>Deux questions sur les chemins.</p>',
					'questions' => array(
						array(
							'question' => 'Comment separe-t-on le nom du chemin de la donnee ?',
							'mode' => 'choice',
							'choices' => array( 'En filtrant les caracteres interdits', 'En refusant tout nom qui contient un point', 'En resolvant le chemin reel puis en verifiant qu\'il reste dans le dossier autorise', 'En verifiant le prefixe du texte saisi' ),
							'correct' => 2,
							'xp' => 10,
							'hint' => 'Le prefixe du texte n\'est pas une barriere.',
							'explanation' => 'On normalise (realpath) puis on compare au dossier autorise. C\'est la seule verification qui resiste aux variantes.',
						),
						array(
							'question' => 'Pourquoi filtrer la chaine « ../ » est-il fragile ?',
							'mode' => 'choice',
							'choices' => array( 'Parce que le serveur met plus de temps a repondre', 'Parce que les navigateurs modernes bloquent cette chaine', 'Parce que la chaine est trop courte pour etre filtree', 'Parce qu\'il existe de nombreuses variantes' ),
							'correct' => 3,
							'xp' => 10,
							'hint' => 'Pense aux doubles barres, aux encodages URL, aux chemins absolus.',
							'explanation' => 'Un filtre par chaine est toujours contournable. La verification doit porter sur le chemin resolu, pas sur le texte.',
						),
					),
				),
				array(
					'type' => 'test',
					'format' => 'qcm',
					'title' => 'Task 3 : La mission',
					'content' => '<p><strong>Mission.</strong> La page de documentation (<code>/download.php</code>) telecharge un fichier par son nom. Les sauvegardes automatiques de l\'application sont laissees dans <code>/var/backups/</code>. Recupere la cle de licence qui s\'y trouve.</p><p>Indice : <code>/robots.txt</code> de l\'application peut deja te renseigner.</p>',
					'questions' => array(
						array(
							'question' => 'La cle de licence trouvee dans la sauvegarde : donne-la.',
							'mode' => 'flag',
							'flag_path' => '/root/flags/flag-05.txt',
							'xp' => 35,
							'hint' => 'Le nom du fichier est ajoute a un prefixe. Essaie de remonter de trois repertoires, puis de redescendre dans /var/backups/app/.',
							'explanation' => 'La sauvegarde en clair de l\'application etait accessible par traversee de repertoire. La parade : resoudre le chemin reel et verifier qu\'il reste dans le dossier autorise, et supprimer les sauvegardes du serveur web.',
						),
					),
				),
				array(
					'type' => 'exam',
					'format' => 'qcm',
					'title' => 'Task 4 : Examen de fin de scenario',
					'content' => '<p>Quatre questions chronometrees. 60 % suffisent.</p>',
					'time_limit' => 300,
					'pass_score' => 60,
					'questions' => array(
						array(
							'question' => 'Qu\'est-ce qu\'une traversee de repertoire ?',
							'mode' => 'choice',
							'choices' => array( 'Copier un fichier vers un autre dossier', 'Lister les fichiers presents dans un dossier', 'Faire sortir un chemin du dossier autorise', 'Se deplacer d\'un dossier a un autre dans l\'arborescence' ),
							'correct' => 2,
							'xp' => 20,
							'hint' => 'C\'est sortir du cadre prevu.',
							'explanation' => 'On fait sortir le chemin du dossier prevu pour lire un fichier qui n\'etait pas expose.',
						),
						array(
							'question' => 'Quelle verification resiste a toutes les variantes ?',
							'mode' => 'choice',
							'choices' => array( 'Bloquer la chaine « ../ » dans la saisie', 'Verifier que le nom ne contient pas de slash', 'Refuser les requetes contenant « %2e%2e »', 'Resoudre le chemin puis verifier qu\'il reste dans le dossier' ),
							'correct' => 3,
							'xp' => 20,
							'hint' => 'La seule verification solide porte sur le chemin resolu.',
							'explanation' => 'La verification porte sur le chemin resolu (realpath) : s\'il deborde, on refuse.',
						),
						array(
							'question' => 'Que faut-il faire des sauvegardes placees dans le dossier servi par le web ?',
							'mode' => 'choice',
							'choices' => array( 'Les sortir du serveur web', 'Les chiffrer avec un mot de passe', 'Les renommer en .bak', 'Les proteger par une authentification HTTP' ),
							'correct' => 0,
							'xp' => 20,
							'hint' => 'Si le serveur web peut les lire, l\'attaquant aussi.',
							'explanation' => 'Une sauvegarde n\'a rien a faire sur un serveur web. On la sort du dossier servi, et on la chiffre au repos.',
						),
						array(
							'question' => 'Pourquoi un fichier robots.txt est-il utile a l\'attaquant ?',
							'mode' => 'choice',
							'choices' => array( 'Il oblige les moteurs de recherche a s\'arreter', 'Il liste les chemins a ne pas visiter… donc a visiter', 'Il permet de desactiver le pare-feu du site', 'Il contient le mot de passe de l\'administration' ),
							'correct' => 1,
							'xp' => 20,
							'hint' => 'Ce fichier est fait pour dire au monde ce qui existe.',
							'explanation' => 'Un robots.txt liste les chemins sensibles : c\'est une carte pour l\'attaquant (et un rappel pour le defenseur de verifier ses secrets).',
						),
					),
				),
			),
			'terminal' => array(
				'intro' => 'appareil@intranet:~$ ',
				'unknown' => 'bash: commande introuvable. Essaie « help ».',
				'success' => 'Clé de licence récupérée. Les sauvegardes n\'ont rien à faire sur un serveur web.',
				'steps' => array(
					array(
						'match' => array( 'curl -s http://localhost:8080/robots.txt', '/curl .*robots\\.txt/' ),
						'output' => 'User-agent: *
Disallow: /admin.php
Disallow: /bot.php
Disallow: /status.php
Disallow: /var/backups/
',
						'hint' => 'Le fichier robots.txt liste les chemins que le site veut cacher.',
					),
					array(
						'match' => array( 'cat /var/backups/app/licences.sql', '/cat .*licences\\.sql/' ),
						'output' => '-- Sauvegarde automatique des licences
INSERT INTO licences VALUES (1, \'licence principale\', \'FLAG=SECURA{backup_exposed}\');
',
						'hint' => 'Les sauvegardes sont dans /var/backups/app/.',
					),
				),
			),
			'i18n' => array(
				'ar' => array(
					'title' =>  'الملف الذي كان يجب ألا يبقى',
					'excerpt' => 'صفحة تنزّل ملفًا بالاسم. وماذا لو طلبت ملفًا آخر؟',
					'tasks' => array(
						array(
							'title' => 'المهمة 1: المسار الذي تختاره',
						),
						array(
							'title' => 'المهمة 2: تدريب',
						),
						array(
							'title' => 'المهمة 3: المهمة',
						),
						array(
							'title' => 'المهمة 4: الامتحان',
						),
					),
				),
				'en' => array(
					'title' => 'The file that should not have been there',
					'excerpt' => 'A page downloads a file by name. What if you asked for a different file?',
					'tasks' => array(
						array(
							'title' => 'Task 1: The path you choose',
						),
						array(
							'title' => 'Task 2: Practice',
						),
						array(
							'title' => 'Task 3: The mission',
						),
						array(
							'title' => 'Task 4: Exam',
						),
					),
				),
			),
		),
array(
			'title' => 'Qui a force la porte ?',
			'excerpt' => 'Une rafale de tentatives échouées, puis une requete qui aboutit. Ton job : remettre l\'histoire dans l\'ordre.',
			'content' => 'Un rapport automatique signale une activite inhabituelle sur le portail. Tu as le journal. Une seule question : que s\'est-il passe, et qu\'est-ce que l\'attaquant a obtenu ?',
			'difficulty' => 'moyen',
			'duration' => 25,
			'xp_bonus' => 35,
			'track' => 'm3',
			'lab' => array(
				'enabled' => 1,
				'driver' => 'auto',
				'mode' => 'single',
				'image' => 'securalabs/multi-01:1.0',
				'network' => 'seca_lab',
				'command' => 'sleep infinity',
				'workdir' => '/home/ctf',
				'target' => 'http://127.0.0.1:8080',
				'ttl' => 3600,
				'allow' => array(
					'ls',
					'cat',
					'grep',
					'head',
					'tail',
					'wc',
					'sort',
					'uniq',
					'cut',
					'awk',
				),
			),
			'tasks' => array(
				array(
					'type' => 'lesson',
					'format' => 'lecon',
					'title' => 'Task 1 : Lire un journal comme une histoire',
					'content' => '<p>Un journal d\'acces est une suite de lignes, chacune decrivant une requete :</p><p style="background:#1b1b1b;padding:.6em;color:#eee;font-family:monospace">IP - - [date heure] \\"METHODE chemin HTTP/1.1\\" CODE taille</p><p>Trois lectures suffisent :</p><ul><li><strong>Qui ?</strong> l\'adresse IP en debut de ligne ; regrouper les lignes par IP revele les machines qui insistent.</li><li><strong>Quand ?</strong> l\'horodatage : une rafale de tentatives en quelques minutes n\'est pas un comportement normal.</li><li><strong>Quoi ?</strong> le code de reponse : <code>401</code> echec, <code>200</code> succes. Une rafale de 401 suivie d\'un 200, c\'est une cible qui a ccede.</li></ul><p><strong>A retenir :</strong> on ne lit pas un journal ligne a ligne, on le <em>regroupe</em>. Les outils (grep, sort, uniq, wc) servent exactement a cela.</p>',
					'questions' => array(),
				),
				array(
					'type' => 'practice',
					'format' => 'qcm',
					'title' => 'Task 2 : Entrainement',
					'content' => '<p>Deux questions sur la lecture de journaux.</p>',
					'questions' => array(
						array(
							'question' => 'Quelle sequence indique une authentification reussie apres plusieurs echecs ?',
							'mode' => 'choice',
							'choices' => array( 'Plusieurs 200 puis un 401', 'Un 404 suivi d\'un 301', 'Plusieurs 500 puis un 200', 'Plusieurs 401 puis un 200' ),
							'correct' => 3,
							'xp' => 10,
							'hint' => 'Regarde les codes de reponse.',
							'explanation' => '401 = refuse, 200 = accepte. L\'ordre compte : plusieurs echecs puis un succes, c\'est un forcage reussi.',
						),
						array(
							'question' => 'Pourquoi regrouper les lignes par adresse IP ?',
							'mode' => 'choice',
							'choices' => array( 'Pour voir quelle machine insiste', 'Pour compter le nombre total de lignes', 'Pour chiffrer le contenu des requetes', 'Pour trier les pages par ordre alphabetique' ),
							'correct' => 0,
							'xp' => 10,
							'hint' => 'Une ligne seule ne dit rien ; cent lignes les memes, si.',
							'explanation' => 'Le regroupement fait apparaitre les schemas : une IP qui insiste, une IP qui telecharge beaucoup, une IP inconnue.',
						),
					),
				),
				array(
					'type' => 'test',
					'format' => 'qcm',
					'title' => 'Task 3 : La mission',
					'content' => '<p><strong>Mission.</strong> Le journal du service est dans <code>/var/log/app/access.log</code>. Une rafale de tentatives a eu lieu, puis une requete inhabituelle a reussi. Retrouve le jeton que l\'attaquant a obtenu en fin de sequence.</p><p>Indice : la derniere requete de la rafale n\'est pas une tentative de connexion.</p>',
					'questions' => array(
						array(
							'question' => 'Le jeton obtenu par l\'attaquant : donne-le.',
							'mode' => 'flag',
							'flag_path' => '/root/flags/flag-06.txt',
							'xp' => 35,
							'hint' => 'Cherche une requete qui sort du lot dans les dernieres lignes du journal, et lis ses parametres.',
							'explanation' => 'Apres la rafale de 401, une requete de type export a reussi avec un jeton en parametre : la donnee exfiltree est la, en clair, dans le journal. Parade : surveiller les exports, tourner les jetons, et ne jamais mettre de secret dans une URL.',
						),
					),
				),
				array(
					'type' => 'exam',
					'format' => 'qcm',
					'title' => 'Task 4 : Examen de fin de scenario',
					'content' => '<p>Quatre questions chronometrees. 60 % suffisent.</p>',
					'time_limit' => 300,
					'pass_score' => 60,
					'questions' => array(
						array(
							'question' => 'Que signifie le code de reponse HTTP 401 ?',
							'mode' => 'choice',
							'choices' => array( 'Requete traitee avec succes', 'Ressource introuvable', 'Le serveur a change de version', 'Acces refuse (non authentifie)' ),
							'correct' => 3,
							'xp' => 20,
							'hint' => '401 = 401 Unauthorized.',
							'explanation' => '401 : authentification exigee et fournie de maniere insuffisante. 403 : authentifie mais pas autorise.',
						),
						array(
							'question' => 'Pourquoi un secret dans une URL est-il une mauvaise idee ?',
							'mode' => 'choice',
							'choices' => array( 'Parce qu\'il finit dans les journaux et l\'historique', 'Parce que les URL ne sont pas chiffrees en HTTPS', 'Parce qu\'une URL est trop courte pour un secret', 'Parce que le navigateur bloque les URL longues' ),
							'correct' => 0,
							'xp' => 20,
							'hint' => 'Pense a tout ce qui garde une copie de l\'URL.',
							'explanation' => 'Les URL sont loguees par le serveur, les proxies et le navigateur. Un secret n\'a rien a faire dedans.',
						),
						array(
							'question' => 'Qu\'indique une rafale de 401 suivie d\'un 200 ?',
							'mode' => 'choice',
							'choices' => array( 'Un scan de ports reussi', 'Une authentification a reussi apres plusieurs echecs', 'Un serveur qui a change de version', 'Une panne du service de DNS' ),
							'correct' => 1,
							'xp' => 20,
							'hint' => 'L\'ordre des codes compte autant que les codes.',
							'explanation' => 'C\'est la signature d\'une tentative de forcage qui finit par reussir : c\'est l\'evenement a alerter.',
						),
						array(
							'question' => 'Quel est l\'interet de l\'horodatage dans un journal ?',
							'mode' => 'choice',
							'choices' => array( 'Chiffrer le contenu du journal', 'Compter le nombre d\'evenements par jour', 'Situer l\'evenement dans le temps', 'Rendre le fichier journal plus lisible' ),
							'correct' => 2,
							'xp' => 20,
							'hint' => 'Sans heure, impossible de relier deux evenements.',
							'explanation' => 'Sans heure, on ne peut ni coreler avec un autre systeme, ni mesurer une rafale, ni dater l\'intrusion.',
						),
					),
				),
			),
			'terminal' => array(
				'intro' => 'appareil@intranet:~$ ',
				'unknown' => 'bash: commande introuvable. Essaie « help ».',
				'success' => 'Séquence reconstituée : une rafale, puis un export réussi.',
				'steps' => array(
					array(
						'match' => array( 'wc -l /var/log/app/access.log', '/wc .*access\\.log/' ),
						'output' => '53 /var/log/app/access.log
',
						'hint' => 'Le journal du service est dans /var/log/app/.',
					),
					array(
						'match' => array( 'tail -5 /var/log/app/access.log', '/tail .*access\\.log/' ),
						'output' => '198.51.100.7 - - [12/Oct/2026:09:38:00 +0200] "GET /export.csv?jeton=FLAG=SECURA{log_never_lies}" 200 2140
',
						'hint' => 'Regarde les dernieres lignes : la derniere requete sort du lot.',
					),
				),
			),
			'i18n' => array(
				'ar' => array(
					'title' => 'من حاول فتح الباب؟',
					'excerpt' => 'موجة من المحاولات الفاشلة، ثم طلب ناجح. مهمتك: إعادة ترتيب الحكاية.',
					'tasks' => array(
						array(
							'title' => 'المهمة 1: قراءة السجل كقصة',
						),
						array(
							'title' => 'المهمة 2: تدريب',
						),
						array(
							'title' => 'المهمة 3: المهمة',
						),
						array(
							'title' => 'المهمة 4: الامتحان',
						),
					),
				),
				'en' => array(
					'title' => 'Who forced the door?',
					'excerpt' => 'A burst of failed attempts, then one request that succeeds. Put the story back in order.',
					'tasks' => array(
						array(
							'title' => 'Task 1: Reading a log as a story',
						),
						array(
							'title' => 'Task 2: Practice',
						),
						array(
							'title' => 'Task 3: The mission',
						),
						array(
							'title' => 'Task 4: Exam',
						),
					),
				),
			),
		),
array(
			'title' => 'Le reseau qui parle trop',
			'excerpt' => 'Une machine, trois noeuds, des ports ouverts. Commence par savoir qui est en face, avant de toucher quoi que ce soit.',
			'content' => 'Tu demarres sur une machine du reseau de laboratoire. Avant toute action, une question : sur quels ports ecoute-t-on, et que fait le service qui repond ? La cartographie est la premiere competence de l\'exploitation — et la premiere competence du defenseur.',
			'difficulty' => 'moyen',
			'duration' => 30,
			'xp_bonus' => 40,
			'track' => 'm3',
			'lab' => array(
				'enabled' => 1,
				'driver' => 'auto',
				'mode' => 'compose',
				'service' => 'attacker',
				'compose' => 'net-01/docker-compose.yml',
				'project' => 'seca_net01',
				'network' => 'seca_lab',
				'workdir' => '/home/ctf',
				'target' => 'http://web:8080',
				'ttl' => 3600,
				'allow' => array( 'ls', 'cat', 'grep', 'nmap', 'curl', 'python3', 'nc', 'ping' ),
				'flag_service' => 'web',
			),
			'tasks' => array(
				array(
					'type' => 'lesson',
					'format' => 'lecon',
					'title' => 'Task 1 : Cartographier avant d\'attaquer',
					'content' => '<p>Un port ouvert est une <strong>fenetre</strong> : un service ecoute, et ce service a des faiblesses possibles. Cartographier, c\'est lister les fenetres.</p><p>Le modele TCP en quatre etapes (6.857) :</p><ol><li><strong>SYN</strong> : le client demande l\'ouverture ;</li><li><strong>SYN-ACK</strong> : le serveur accepte ;</li><li><strong>ACK</strong> : la connexion est etablie ;</li><li>les echanges de donnees commencent.</li></ol><p>Un balayage (scan) envoie des SYN sur une plage de ports : les reponses dessinent la carte. Un port <strong>filtre</strong> ne repond pas (ferme ou bloque), un port <strong>ferme</strong> repond « refuse », un port <strong>ouvert</strong> repond « ouvert » : la difference se voit au temps de reponse.</p><p><strong>A retenir :</strong> un service expose sur Internet est une surface d\'attaque. La parade n\'est pas de tout fermer : c\'est de n\'exposer que le necessaire, et de savoir ce qui est expose.</p>',
					'questions' => array(),
				),
				array(
					'type' => 'practice',
					'format' => 'qcm',
					'title' => 'Task 2 : Entrainement',
					'content' => '<p>Deux questions sur le reseau.</p>',
					'questions' => array(
						array(
							'question' => 'Que revele un port ouvert ?',
							'mode' => 'choice',
							'choices' => array( 'Qu\'un service ecoute et constitue une surface d\'attaque', 'Que la machine est hors ligne', 'Que le pare-feu est desactive', 'Que le service est a jour de ses correctifs' ),
							'correct' => 0,
							'xp' => 10,
							'hint' => 'Pense a ce que tu peux tenter contre ce service.',
							'explanation' => 'Un port ouvert, c\'est une porte d\'entree possible. C\'est aussi une responsabilite pour le defenseur.',
						),
						array(
							'question' => 'Pourquoi limiter ce que le serveur expose sur Internet ?',
							'mode' => 'choice',
							'choices' => array( 'Pour eviter d\'avoir a mettre a jour le systeme', 'Pour reduire la surface d\'attaque', 'Pour economiser de la bande passante', 'Pour que le site s\'affiche plus vite' ),
							'correct' => 1,
							'xp' => 10,
							'hint' => 'Chaque port ouvert est une opportunite pour un attaquant.',
							'explanation' => 'Moins de ports exposes = moins de possibilites. C\'est le principe du moindre privilege, applique au reseau.',
						),
					),
				),
				array(
					'type' => 'test',
					'format' => 'qcm',
					'title' => 'Task 3 : La mission',
					'content' => '<p><strong>Mission.</strong> Tu es sur la machine « attaquant ». Le noeud « web » est joignable : trouve ce qu\'il expose, puis recupere la cle de licence qu\'il distribue dans un export.</p><p>Indice : un export CSV est un fichier qu\'on peut lire directement depuis le navigateur.</p>',
					'questions' => array(
						array(
							'question' => 'La cle de licence trouvee dans l\'export : donne-la.',
							'mode' => 'flag',
							'flag_path' => '/root/flags/flag-07.txt',
							'xp' => 35,
							'hint' => 'Commence par regarder quels ports repondent sur le noeud web. Un export se telecharge par HTTP.',
							'explanation' => 'Le noeud web exposait un export CSV contenant les cles de licence. Parade : ne pas servir d\'export en clair sur un service accessible, et surveiller les telechargements de masse.',
						),
					),
				),
				array(
					'type' => 'exam',
					'format' => 'qcm',
					'title' => 'Task 4 : Examen de fin de scenario',
					'content' => '<p>Quatre questions chronometrees. 60 % suffisent.</p>',
					'time_limit' => 300,
					'pass_score' => 60,
					'questions' => array(
						array(
							'question' => 'Que signifie un port « ouvert » ?',
							'mode' => 'choice',
							'choices' => array( 'Un service y ecoute', 'Le port est bloque par le pare-feu', 'Le port est reserve aux administrateurs', 'Le port attend une configuration' ),
							'correct' => 0,
							'xp' => 20,
							'hint' => 'Un port ouvert, c\'est une porte d\'entree possible.',
							'explanation' => 'Un service y ecoute et accepte les connexions : c\'est une surface d\'attaque.',
						),
						array(
							'question' => 'Quelle est l\'idee du principe du moindre privilege ?',
							'mode' => 'choice',
							'choices' => array( 'Accorder les droits uniquement aux administrateurs', 'N\'accorder que les droits necessaires', 'Refuser tout acces a l\'utilisateur par defaut', 'Donner tous les droits pour eviter les blocages' ),
							'correct' => 1,
							'xp' => 20,
							'hint' => 'Le principe du moindre privilege, en une phrase.',
							'explanation' => 'Un acces limite = une compromission limitee. C\'est vrai aussi pour les ports exposes.',
						),
						array(
							'question' => 'Pourquoi un pare-feu filtre-t-il des ports plutot que des applications ?',
							'mode' => 'choice',
							'choices' => array( 'Parce qu\'une application peut ecouter sur n\'importe quel port', 'Parce que le filtrage par port est plus rapide', 'Parce que c\'est simple et robuste a mettre en place', 'Parce que les ports sont plus faciles a configurer' ),
							'correct' => 2,
							'xp' => 20,
							'hint' => 'Le filtrage par application n\'existe pas partout.',
							'explanation' => 'Filtrer par port est simple et efficace a grande echelle ; le filtrage applicatif (WAF) vient en complement.',
						),
						array(
							'question' => 'Que fait un scan de ports ?',
							'mode' => 'choice',
							'choices' => array( 'Il copie les fichiers de la machine', 'Il modifie les regles du pare-feu', 'Il identifie le responsable humain d\'une machine', 'Il dessine la carte des services ecoutants' ),
							'correct' => 3,
							'xp' => 20,
							'hint' => 'C\'est une cartographie, pas une intrusion.',
							'explanation' => 'Il envoie des probes sur une plage et observe les reponses : c\'est la cartographie de base.',
						),
					),
				),
			),
			'terminal' => array(
				'intro' => 'attaquant@lab:~$ ',
				'unknown' => 'bash: commande introuvable. Essaie « help ».',
				'success' => 'Le noeud web est cartographie. Cle de licence recuperee.',
				'steps' => array(
					array(
						'match' => array( 'nmap -sT web', '/nmap .*web/' ),
						'output' => 'Starting Nmap 7.80 ( https://nmap.org )
Nmap scan report for web (10.89.1.2)
Host is up (0.0004s latency).
Not shown: 997 closed tcp ports
PORT     STATE SERVICE
8080/tcp open  http
',
						'hint' => 'Le noeud web s\'appelle « web » dans le reseau du lab.',
					),
					array(
						'match' => array( 'curl -s http://web:8080/export.csv', '/curl .*export\\.csv/' ),
						'output' => 'client;licence;cle
hopital-nord;LIC-2026-118;FLAG=SECURA{ports_are_loud}
clinique-sud;LIC-2026-119;MAINT-2026-8842
',
						'hint' => 'Un export se telecharge en HTTP sur le port ouvert.',
					),
				),
			),
			'i18n' => array(
				'ar' => array(
					'title' => 'الشبكة التي تتكلم كثيرًا',
					'excerpt' => 'آلة، ثلاث عقد، منافذ مفتوحة. اعرف من أمامك أولًا قبل أن تلمس شيئًا.',
					'tasks' => array(
						array(
							'title' => 'المهمة 1: ارسم الخريطة قبل الهجوم',
						),
						array(
							'title' => 'المهمة 2: تدريب',
						),
						array(
							'title' => 'المهمة 3: المهمة',
						),
						array(
							'title' => 'المهمة 4: الامتحان',
						),
					),
				),
				'en' => array(
					'title' => 'The network that talks too much',
					'excerpt' => 'One machine, three nodes, open ports. Know who is on the other side before touching anything.',
					'tasks' => array(
						array(
							'title' => 'Task 1: Map before you attack',
						),
						array(
							'title' => 'Task 2: Practice',
						),
						array(
							'title' => 'Task 3: The mission',
						),
						array(
							'title' => 'Task 4: Exam',
						),
					),
				),
			),
		),
array(
			'title' => 'Traverser le mur',
			'excerpt' => 'Un serveur compromis, un mot de passe reutilise, et un noeud qui n\'ecoute que depuis l\'interieur du reseau.',
			'content' => 'Tu as passe la porte du noeud « web ». Ce noeud n\'est pas le but : c\'est un tremplin. Le vrai secret est sur un autre noeud, qui n\'ecoute que depuis l\'interieur du reseau du laboratoire. Pour l\'atteindre, il te faut un acces au reseau — et un identifiant.',
			'difficulty' => 'difficile',
			'duration' => 40,
			'xp_bonus' => 60,
			'track' => 'm3',
			'lab' => array(
				'enabled' => 1,
				'driver' => 'auto',
				'mode' => 'compose',
				'service' => 'attacker',
				'compose' => 'net-01/docker-compose.yml',
				'project' => 'seca_net01',
				'network' => 'seca_lab',
				'workdir' => '/home/ctf',
				'target' => 'noeud interne : http://internal:8080',
				'ttl' => 3600,
				'allow' => array( 'ls', 'cat', 'grep', 'nmap', 'curl', 'python3', 'nc', 'ping' ),
				'flag_service' => 'internal',
			),
			'tasks' => array(
				array(
					'type' => 'lesson',
					'format' => 'lecon',
					'title' => 'Task 1 : Le pivot',
					'content' => '<p>Un <strong>pivot</strong>, c\'est utiliser une machine compromise pour atteindre un reseau auquel on n\'a pas directement acces. L\'attaquant n\'exploite pas une faille : il utilise un acces legitime, celui que la machine compromise possede deja.</p><p>Les etapes sont toujours les memes :</p><ol><li><strong>Atteindre</strong> une premiere machine ;</li><li><strong>Recuperer</strong> un identifiant (un mot de passe, une cle, un jeton) ;</li><li><strong>Se replanter</strong> : utiliser cet identite pour aller plus loin ;</li><li><strong>Atteindre</strong> la cible finale, qui n\'etait pas joignable avant.</li></ol><p>Le piege classique : le mot de passe de la premiere machine est <strong>reutilise</strong> sur la seconde. Les equipes forgetting de changer un secret apres une compromission restent les premieres victimes.</p><p><strong>A retenir :</strong> un secret reutilise n\'est pas un secret : c\'est une cle. Defendre, c\'est aussi unicifier les mots de passe (un gestionnaire de secrets) et les tourner.</p><p><strong>Dans ce lab :</strong> le nœud « web » n\'est pas une fin. C\'est un tremplin. Il héberge un outil de supervision (« superviseur-interne ») qui va chercher une page sur <em>un autre poste</em> et la renvoie. Ce n\'est pas une faille qu\'on exploite : c\'est une fonction métier, utilisée sans restriction — c\'est souvent comme ça que les pivots arrivent dans la vraie vie.</p><p>Le nœud « internal » n\'est sur aucun réseau que ta machine voit : seul « web » y a accès. Deux réseaux qui ne se croisent jamais.</p>',
					'questions' => array(),
				),
				array(
					'type' => 'practice',
					'format' => 'qcm',
					'title' => 'Task 2 : Entrainement',
					'content' => '<p>Deux questions sur le pivot.</p>',
					'questions' => array(
						array(
							'question' => 'Qu\'est-ce qu\'un pivot ?',
							'mode' => 'choice',
							'choices' => array( 'Demander un acces administrateur a l\'utilisateur', 'Utiliser une machine compromise pour atteindre un reseau inaccessible directement', 'Changer l\'adresse IP de sa machine', 'Rediriger le trafic d\'un site vers un autre' ),
							'correct' => 1,
							'xp' => 10,
							'hint' => 'Le reseau final n\'etait pas joignable avant.',
							'explanation' => 'Le pivot change de point de vue : on utilise l\'acces deja obtenu pour atteindre ce qui etait hors de portee.',
						),
						array(
							'question' => 'Pourquoi la reutilisation de mots de passe est-elle si dangereuse ?',
							'mode' => 'choice',
							'choices' => array( 'Parce que le navigateur peut les enregistrer', 'Parce que l\'utilisateur les recopie mal', 'Parce qu\'une seule compromission ouvre plusieurs portes', 'Parce que les mots de passe sont souvent trop courts' ),
							'correct' => 2,
							'xp' => 10,
							'hint' => 'Pense a ce que tu viens de faire dans ce scenario.',
							'explanation' => 'L\'impact d\'une compromission est proportionnel au nombre de systemes accessibles avec les memes identifiants.',
						),
					),
				),
				array(
					'type' => 'test',
					'format' => 'qcm',
					'title' => 'Task 3 : La mission',
					'content' => '<p><strong>Mission.</strong> Le noeud « web » contient un secret (un mot de passe). Ce secret est aussi valable sur le noeud « internal », qui n\'ecoute que depuis le reseau du lab. Connecte-toi et recupere le drapeau de l\'archivage.</p><p>Indice : le fichier de configuration du noeud « web » se trouve dans <code>/srv/app/</code>.</p>',
					'questions' => array(
						array(
							'question' => 'Le drapeau de l\'archivage interne : donne-le.',
							'mode' => 'flag',
							'flag_path' => '/root/flags/flag-08.txt',
							'xp' => 45,
							'hint' => 'Trois indices : (1) le noeud « web » liste ses pages dans robots.txt ; (2) sa configuration est dans /srv/app/app.conf ; (3) le noeud « internal » n\'ecoute que depuis le reseau interne, mais le noeud « web » sait l\'atteindre.',
							'explanation' => 'Le pivot n\'est pas une exploitation : c\'est l\'usage d\'un acces legitime (l\'outil de supervision et le compte de service reutilise). Parade : filtrer les destinations du proxy, ne jamais reutiliser un secret, et segmenter reellement les reseaux.',
						),
					),
				),
				array(
					'type' => 'exam',
					'format' => 'qcm',
					'title' => 'Task 4 : Examen de fin de scenario',
					'content' => '<p>Cinq questions chronometrees. 60 % suffisent.</p>',
					'time_limit' => 300,
					'pass_score' => 60,
					'questions' => array(
						array(
							'question' => 'Quelles sont les deux etapes d\'un pivot ?',
							'mode' => 'choice',
							'choices' => array( 'Chiffrer ses fichiers, puis les envoyer a l\'exterieur', 'Atteindre une machine, puis utiliser ses acces pour aller plus loin', 'Scanner le reseau, puis envoyer des e-mails', 'Cacher ses traces, puis supprimer les journaux' ),
							'correct' => 1,
							'xp' => 15,
							'hint' => 'Deux etapes : un acces, puis un usage de cet acces.',
							'explanation' => 'Compromettre une machine, recuperer un acces, puis l\'utiliser pour atteindre une cible inaccessible directement.',
						),
						array(
							'question' => 'Pourquoi le noeud interne n\'etait-il pas joignable au depart ?',
							'mode' => 'choice',
							'choices' => array( 'Parce qu\'il avait plus d\'adresse IP', 'Parce que son serveur web etait arrete', 'Parce qu\'il n\'ecoute que depuis le reseau interne', 'Parce qu\'il n\'etait pas demarre' ),
							'correct' => 2,
							'xp' => 15,
							'hint' => 'Il repond quand tu es deja dedans.',
							'explanation' => 'La segmentation reseau limite la propagation : c\'est une bonne defense… a condition que les identifiants ne circulent pas.',
						),
						array(
							'question' => 'Que faut-il faire d\'un secret apres une compromission ?',
							'mode' => 'choice',
							'choices' => array( 'Le garder : il a deja ete change', 'Le mettre dans un fichier .env', 'Le transmettre a l\'utilisateur qui l\'a utilise', 'Le changer' ),
							'correct' => 3,
							'xp' => 15,
							'hint' => 'Le secret a ete expose : il faut le considerer vole.',
							'explanation' => 'Il faut le considerer comme vole et le changer partout ou il a servi.',
						),
						array(
							'question' => 'Que fait la segmentation reseau ?',
							'mode' => 'choice',
							'choices' => array( 'Elle limite la propagation d\'une compromission', 'Elle augmente la bande passante du reseau', 'Elle chiffre tous les echanges du reseau', 'Elle supprime la necessite d\'un pare-feu' ),
							'correct' => 0,
							'xp' => 15,
							'hint' => 'Elle contient l\'impact, elle ne l\'annule pas.',
							'explanation' => 'Des sous-reseaux separes limitent la propagation. Mais un secret reutilise traverse les segments sans effort.',
						),
						array(
							'question' => 'Pourquoi un mot de passe en clair dans une configuration est-il particulierement grave lors d\'un pivot ?',
							'mode' => 'choice',
							'choices' => array( 'Parce qu\'il est ecrit avec des caracteres speciaux', 'Parce qu\'il donne un acces direct a tous les systemes qui l\'utilisent', 'Parce qu\'il ralentit le traitement des requetes', 'Parce qu\'il occupe une ligne dans le fichier' ),
							'correct' => 1,
							'xp' => 15,
							'hint' => 'Un seul secret peut ouvrir plusieurs portes.',
							'explanation' => 'Un secret unique et reutilise, c\'est une cle qui ouvre plusieurs portes : l\'impact explose.',
						),
					),
				),
			),
			'terminal' => array(
				'intro' => 'attaquant@lab:~$ ',
				'unknown' => 'bash: commande introuvable. Essaie « help ».',
				'success' => 'Pivot reussi. Le noeud interne est compromis.',
				'steps' => array(
					array(
						'match' => array( 'curl -s http://web:8080/robots.txt', '/curl .*robots/' ),
						'output' => 'User-agent: *
Disallow: /admin.php
Disallow: /diag.php
Disallow: /proxy.php
Disallow: /backup/
',
						'hint' => 'Le fichier robots.txt liste les pages que l\'application ne veut pas voir indexees.',
					),
					array(
						'match' => array( 'curl -s http://web:8080/diag.php', '/curl .*diag/' ),
						'output' => '=== Diagnostic Intranet ===
app_name : Intranet
version  : 2.4.1
--- /srv/app/app.conf ---
# Configuration interne — ne pas diffuser.
app_user = admin
db_password = Intranet2019!
proxy_tool = /proxy.php
--- fin ---
',
						'hint' => 'La page de diagnostic affiche la configuration de l\'application.',
					),
					array(
						'match' => array( 'curl -s -d username=admin -d password=Intranet2019! "http://web:8080/proxy.php?url=http://internal:8080/"', '/proxy\\.php.*internal/' ),
						'output' => 'Archivage interne
Réservé aux dossiers patients archivés.
Accès Granted.
Dossier archivé : FLAG=SECURA{pivot_accompli}
',
						'hint' => 'L\'outil de supervision du noeud « web » va chercher la page sur un autre poste : c\'est le pivot.',
					),
				),
			),
			'i18n' => array(
				'ar' => array(
					'title' => 'عبور الجدار',
					'excerpt' => 'خادم مخترَق، كلمة مرور مُعاد استخدامها، وعقدة لا تستمع إلا من داخل الشبكة.',
					'tasks' => array(
						array(
							'title' => 'المهمة 1: الانعطافة',
						),
						array(
							'title' => 'المهمة 2: تدريب',
						),
						array(
							'title' => 'المهمة 3: المهمة',
						),
						array(
							'title' => 'المهمة 4: الامتحان',
						),
					),
				),
				'en' => array(
					'title' => 'Through the wall',
					'excerpt' => 'A compromised server, a reused password, and a node that only listens from inside the network.',
					'tasks' => array(
						array(
							'title' => 'Task 1: The pivot',
						),
						array(
							'title' => 'Task 2: Practice',
						),
						array(
							'title' => 'Task 3: The mission',
						),
						array(
							'title' => 'Task 4: Exam',
						),
					),
				),
			),
		),
array(
			'title' => 'Le binaire qui obeit trop',
			'excerpt' => 'Un programme local ecrit trop vite. La pile, elle, ne pardonne pas.',
			'content' => 'Sur cette machine, un binaire a ete compile avec negligence : il ecrit dans un tampon sans verifier la taille de l\'entree. Ce genre de faute s\'appelle un <strong>depassement de tampon</strong>, et c\'est encore la base de beaucoup d\'exploits.',
			'difficulty' => 'difficile',
			'duration' => 40,
			'xp_bonus' => 60,
			'track' => 'm3',
			'lab' => array(
				'enabled' => 1,
				'driver' => 'auto',
				'mode' => 'single',
				'image' => 'securalabs/bin-01:1.0',
				'network' => 'seca_lab',
				'command' => 'sleep infinity',
				'workdir' => '/home/ctf',
				'target' => 'binaire vulnerable : /home/ctf/vulnerable',
				'ttl' => 3600,
				/* Cette room enseigne le setuid : sans cette exception,
				   « no-new-privileges » annule le bit et le scenario devient
				   impossible. Toutes les autres limites restent en place. */
				'allow_setuid' => 1,
				'allow' => array( 'ls', 'cat', 'file', 'checksec', 'gdb', 'python3', 'gcc', 'strings' ),
			),
			'tasks' => array(
				array(
					'type' => 'lesson',
					'format' => 'lecon',
					'title' => 'Task 1 : La pile, le tampon, et les quatre defenses',
					'content' => '<p>Un programme reserve un espace en memoire (le <strong>buffer</strong>) pour y ecrire ce que l\'utilisateur saisit. Si la saisie depasse la place reserve, elle <strong>ecrase ce qui se trouve apres</strong> : les variables locales, puis l\'adresse de retour de la fonction. Reecrire cette adresse, c\'etait detourner le programme vers le code de l\'attaquant.</p><p>Quatre defenses se combinent (6.858) :</p><ul><li><strong>NX</strong> (No-eXecute) : la pile n\'est pas executable ; on ne peut pas y mettre du code, il faut passer par unetechnique existante (ROP).</li><li><strong>ASLR</strong> : les adresses sont randomisees a chaque execution ; on ne peut pas deviner ou sont le code et la pile.</li><li><strong>Canary</strong> (cookie de pile) : une valeur sentinelle placee entre le tampon et l\'adresse de retour ; si elle change, le programme s\'arrete avant de revenir.</li><li><strong>PIE / RELRO</strong> : randomisation du binaire et protections de la table GOT.</li></ul><p><strong>A retenir :</strong> aucune parade n\'est suffisante seule ; c\'est leur <em>combinaison</em> qui rend l\'exploitation couteuse. Et le mieux est encore de ne pas ecrire sans verifier la taille.</p><p><strong>Un détail qui change tout :</strong> sur cette machine, le carnet de commandes est installé en <strong>setuid root</strong>. Le bit setuid veut dire : « même si je suis lancé par un simple utilisateur, le noyau me donne les droits de son propriétaire ». Un débordement de tampon dans un programme setuid root ne donne pas un shell d\'utilisateur : il donne un shell <strong>root</strong>. C\'est pourquoi on ne laisse jamais de programme setuid dans les mains d\'un utilisateur non fiable.</p>',
					'questions' => array(),
				),
				array(
					'type' => 'practice',
					'format' => 'qcm',
					'title' => 'Task 2 : Entrainement',
					'content' => '<p>Deux questions sur la memoire.</p>',
					'questions' => array(
						array(
							'question' => 'Que se passe-t-il quand un programme ecrit plus que la taille du tampon ?',
							'mode' => 'choice',
							'choices' => array( 'Les caracteres en trop sont ignores', 'La memoire est etendue automatiquement', 'Il ecrase la memoire voisine, y compris l\'adresse de retour', 'Le programme s\'arrete avec une erreur' ),
							'correct' => 2,
							'xp' => 10,
							'hint' => 'Le tampon est dans la pile, et l\'adresse de retour est juste apres.',
							'explanation' => 'C\'est le principe du depassement de tampon : ecraser l\'adresse de retour, c\'est detourner l\'execution.',
						),
						array(
							'question' => 'A quoi sert le canary ?',
							'mode' => 'choice',
							'choices' => array( 'A interdire toute ecriture dans la pile', 'A chiffrer le contenu de la pile', 'A rendre le binaire impossible a decompiler', 'A detecter la corruption de la pile avant le retour' ),
							'correct' => 3,
							'xp' => 10,
							'hint' => 'Il ne bloque rien : il signale.',
							'explanation' => 'Le canary ne previent pas l\'ecriture ; il detecte qu\'elle a eu lieu et fait terminer le programme au retour, sans laisser l\'attaquant contrôler l\'execution.',
						),
					),
				),
				array(
					'type' => 'test',
					'format' => 'qcm',
					'title' => 'Task 3 : La mission',
					'content' => '<p><strong>Mission.</strong> Un binaire vulnereble est dans <code>/home/ctf/</code>. Il attend une saisie et la copie dans un tampon trop petit. Depasse ce tampon pour obtenir un shell, puis lis le drapeau que l\'administrateur a laisse dans <code>/root/flag.txt</code>.</p><p>Indice : le ticket d\'incident precise ce que le programme attend.</p>',
					'questions' => array(
						array(
							'question' => 'Le drapeau lu apres avoir obtenu un shell : donne-le.',
							'mode' => 'flag',
							'flag_path' => '/root/flag.txt',
							'xp' => 45,
							'hint' => 'Le carnet de commandes (/home/ctf/vulnerable) lit ta saisie sans vérifier sa longueur, et il est installé en setuid root : ton shell sera root.',
							'explanation' => 'Le dépassement de tampon a detourne l\'execution vers un shell root, parce que le binaire est setuid. Parade : verifier les longueurs, compiler avec les defenses (canary, NX, PIE, RELRO), et surtout ne pas donner le setuid a un programme fragile.',
						),
					),
				),
				array(
					'type' => 'exam',
					'format' => 'qcm',
					'title' => 'Task 4 : Examen de fin de scenario',
					'content' => '<p>Cinq questions chronometrees. 60 % suffisent.</p>',
					'time_limit' => 300,
					'pass_score' => 60,
					'questions' => array(
						array(
							'question' => 'Que bloque la defense NX ?',
							'mode' => 'choice',
							'choices' => array( 'La lecture du fichier binaire', 'L\'utilisation des threads', 'L\'execution de code dans la pile', 'L\'execution de code dans le tas (heap)' ),
							'correct' => 2,
							'xp' => 15,
							'hint' => 'NX rend la pile non executable.',
							'explanation' => 'NX marque la pile non executable : impossible d\'y ecrire du code et l\'executer directement.',
						),
						array(
							'question' => 'Que fait ASLR ?',
							'mode' => 'choice',
							'choices' => array( 'Il chiffre le binaire dans le fichier executable', 'Il verifie l\'integrite du binaire au demarrage', 'Il interdit l\'execution d\'un binaire non signe', 'Il randomise les adresses a chaque execution' ),
							'correct' => 3,
							'xp' => 15,
							'hint' => 'ASLR = adresses aleatoires.',
							'explanation' => 'ASLR randomise la pile, la bibliotheque et la pile executable : on ne peut plus deviner les adresses.',
						),
						array(
							'question' => 'Que gagne-t-on a activer les defenses (canary, NX, PIE) a la compilation ?',
							'mode' => 'choice',
							'choices' => array( 'Parce que le code vulnerable disparait a la compilation', 'Le binaire devient plus rapide', 'Le code source est plus court', 'Les erreurs sont detectees a l\'execution' ),
							'correct' => 0,
							'xp' => 15,
							'hint' => 'Les flags de compilation changent le code produit.',
							'explanation' => 'Les flags de compilation (-fstack-protector-strong, -fPIE, RELRO) changent le code produit : la faille disparait, pas seulement son exploitation.',
						),
						array(
							'question' => 'Quelle est la parade la plus efficace contre un depassement de tampon ?',
							'mode' => 'choice',
							'choices' => array( 'Deplacer le tampon en memoire globale', 'Verifier la taille avant d\'ecrire', 'Activer ASLR', 'Compiler avec le bit NX' ),
							'correct' => 1,
							'xp' => 15,
							'hint' => 'La parade ultime est dans le code, pas dans les options.',
							'explanation' => 'La parade ultime est dans le code : on verifie la longueur avant d\'ecrire. Les defenses systeme sont la deuxieme ligne.',
						),
						array(
							'question' => 'Comment s\'appelle une technique qui reutilise des morceaux de code deja presents dans le binaire ?',
							'mode' => 'choice',
							'choices' => array( 'Le remplacement de la table GOT', 'Le debordement d\'entier', 'ROP (Return-Oriented Programming)', 'L\'injection de shellcode dans la pile' ),
							'correct' => 2,
							'xp' => 15,
							'hint' => 'On reutilise du code deja present : le mot commence par R.',
							'explanation' => 'Avec NX actif, on ne peut pas injecter de code : on reutilise des morceaux de code existants (gadgets) pour construire l\'appel systeme.',
						),
					),
				),
			),
			'terminal' => array(
				'intro' => 'attaquant@cible:~$ ',
				'unknown' => 'bash: commande introuvable. Essaie « help ».',
				'success' => 'Shell obtenu. Le drapeau est dans /root/flag.txt.',
				'steps' => array(
					array(
						'match' => array( 'file /home/ctf/vulnerable', '/file .*vulnerable/' ),
						'output' => '/home/ctf/vulnerable: ELF 64-bit LSB executable, x86-64, version 1 (SYSV), dynamically linked, not stripped
',
						'hint' => 'Le carnet de commandes est dans /home/ctf/.',
					),
					array(
						'match' => array( 'ls -l /home/ctf/vulnerable', '/ls -l .*vulnerable/' ),
						'output' => '-rwsr-xr-x 1 root root 8104 Jan  9 09:12 /home/ctf/vulnerable
',
						'hint' => 'Le bit « s » dans -rws signale un programme setuid.',
					),
					array(
						'match' => array( 'cat /root/flag.txt', '/cat .*flag\\.txt/' ),
						'output' => "cat: /root/flag.txt: Permission denied\n",
						'hint' => 'Sans shell root, /root reste ferme. Le drapeau ne vient qu\'apres le debordement.',
					),
				),
			),
			'i18n' => array(
				'ar' => array(
					'title' => 'الثنائي المفرط في الطاعة',
					'excerpt' => 'برنامج محلي يكتب بسرعة أكبر. والمكدس لا يغفر.',
					'tasks' => array(
						array(
							'title' => 'المهمة 1: المكدس والمخزن والدفاعات الأربع',
						),
						array(
							'title' => 'المهمة 2: تدريب',
						),
						array(
							'title' => 'المهمة 3: المهمة',
						),
						array(
							'title' => 'المهمة 4: الامتحان',
						),
					),
				),
				'en' => array(
					'title' => 'The binary that obeys too much',
					'excerpt' => 'A local program writes too fast. The stack does not forgive.',
					'tasks' => array(
						array(
							'title' => 'Task 1: The stack, the buffer and the four defences',
						),
						array(
							'title' => 'Task 2: Practice',
						),
						array(
							'title' => 'Task 3: The mission',
						),
						array(
							'title' => 'Task 4: Exam',
						),
					),
				),
			),
		),
array(
			'title' => 'Le certificat qui ne prouve rien',
			'excerpt' => 'Le cadenas de la connexion. Regarde de tres pres ce qu\'il dit, et ce qu\'il ne dit pas.',
			'content' => 'L\'application ecoute aussi en HTTPS, sur le port 8443. La connexion est chiffree : personne ne peut lire le trafic. Mais le chiffrement ne dit rien de l\'identite du serveur : c\'est le role du certificat. Et un certificat auto-signe, c\'est un certificat que personne n\'a verifie.',
			'difficulty' => 'difficile',
			'duration' => 35,
			'xp_bonus' => 55,
			'track' => 'm3',
			'lab' => array(
				'enabled' => 1,
				'driver' => 'auto',
				'mode' => 'single',
				'image' => 'securalabs/multi-01:1.0',
				'network' => 'seca_lab',
				'command' => 'sleep infinity',
				'workdir' => '/home/ctf',
				'target' => 'https://127.0.0.1:8443',
				'ttl' => 3600,
				'allow' => array( 'ls', 'cat', 'grep', 'curl', 'openssl', 'python3' ),
			),
			'tasks' => array(
				array(
					'type' => 'lesson',
					'format' => 'lecon',
					'title' => 'Task 1 : Chiffrer, oui — prouver, non',
					'content' => '<p>Le protocole TLS apporte deux choses :</p><ul><li><strong>la confidentialite</strong> : ce qui circule est chiffre, un tiers ne peut pas le lire ;</li><li><strong>l\'authentification</strong> : le serveur prouve qui il est.</li></ul><p>Cette preuve repose sur un <strong>certificat</strong>, signe par une autorite que le navigateur deja confiance. Si le certificat est <strong>auto-signe</strong> (signature par lui-meme), le navigateur peut dire : « je ne connais aucune autorite qui confirme cette identite » — et il doit alors te demander d\'accepter l\'exception. Un certificat mal configure = plus aucune garantie d\'identite.</p><p>Le TLS a aussi son point faible : les <strong>noms de serveur (SNI)</strong> permettent a un serveur de proposer plusieurs certificats selon le nom demande. C\'est la base des sites a « noms virtuels » — et un mecanisme que les environnements d\'equilibrage doivent surveiller.</p><p><strong>A retenir :</strong> « le cadenas est ferme » ne veut pas dire « je sais avec qui je parle ». Chiffrement et identite sont deux choses separees.</p>',
					'questions' => array(),
				),
				array(
					'type' => 'practice',
					'format' => 'qcm',
					'title' => 'Task 2 : Entrainement',
					'content' => '<p>Deux questions sur TLS.</p>',
					'questions' => array(
						array(
							'question' => 'Que garantit le chiffrement TLS ?',
							'mode' => 'choice',
							'choices' => array( 'L\'identite du serveur, pas la confidentialite', 'L\'integrite des fichiers du serveur', 'La disponibilite du service', 'La confidentialite des donnees, pas l\'identite du serveur' ),
							'correct' => 3,
							'xp' => 10,
							'hint' => 'Deux fonctions distinctes.',
							'explanation' => 'Le chiffrement cache le contenu ; l\'authentification (certificat) prouve l\'identite. Les deux sont necessaires et separees.',
						),
						array(
							'question' => 'Que signale un certificat auto-signe ?',
							'mode' => 'choice',
							'choices' => array( 'Qu\'aucune autorite independante n\'a confirme l\'identite du serveur', 'Que le certificat est expire', 'Que le chiffrement utilise est trop faible', 'Que le serveur ne supporte pas TLS 1.3' ),
							'correct' => 0,
							'xp' => 10,
							'hint' => 'Qui a signe ? Est-ce quelqu\'un d\'independant ?',
							'explanation' => 'Auto-signe = la preuve vient du serveur lui-meme, elle ne vaut rien. Il faut une chaine de confiance (autorite) ou, pour un service interne, une PKI d\'entreprise.',
						),
					),
				),
				array(
					'type' => 'test',
					'format' => 'qcm',
					'title' => 'Task 3 : La mission',
					'content' => '<p><strong>Mission.</strong> L\'application ecoute en HTTPS sur le port 8443. Ouvre la connexion en TLS, examine le certificat (qui a signe ? pour quel nom ?), puis trouve la page reservee a la connexion securisee et rapporte la cle qu\'elle contient.</p><p>Indice : la page reservee n\'existe qu\'en HTTPS — en HTTP simple, elle renvoie « page introuvable ».</p>',
					'questions' => array(
						array(
							'question' => 'La cle de distribution trouvee en HTTPS : donne-la.',
							'mode' => 'flag',
							'flag_path' => '/root/flags/flag-10.txt',
							'xp' => 45,
							'hint' => 'Regarde d\'abord le certificat avec openssl, puis essaie de lire la page reservee en https (et en http pour comparer).',
							'explanation' => 'Le certificat etait auto-signe : le chiffrement etait bon, l\'identite ne l\'etait pas. Parade : un certificat signe par une autorite (ou une PKI interne), avec une surveillance de la configuration TLS et du SNI.',
						),
					),
				),
				array(
					'type' => 'exam',
					'format' => 'qcm',
					'title' => 'Task 4 : Examen de fin de scenario',
					'content' => '<p>Cinq questions chronometrees. 60 % suffisent.</p>',
					'time_limit' => 300,
					'pass_score' => 60,
					'questions' => array(
						array(
							'question' => 'Le SNI, c\'est quoi ?',
							'mode' => 'choice',
							'choices' => array( 'Un mecanisme de chiffrement du nom de domaine', 'Un en-tete envoye par le navigateur pour signer la connexion', 'Le renouvellement automatique des certificats', 'Le mecanisme qui permet de proposer un certificat selon le nom demande' ),
							'correct' => 3,
							'xp' => 15,
							'hint' => 'Le serveur propose un certificat different selon le nom demande.',
							'explanation' => 'SNI (Server Name Indication) permet a un serveur de proposer un certificat different par nom : indispensable pour l\'hebergement mutualise, a surveiller de pres.',
						),
						array(
							'question' => 'Pourquoi un certificat auto-signe est-il refuse par le navigateur ?',
							'mode' => 'choice',
							'choices' => array( 'Parce qu\'aucune autorite de confiance ne l\'a signe', 'Parce que le certificat est trop volumineux', 'Parce que la cle privee est trop courte', 'Parce que le navigateur exige la version 3 de TLS' ),
							'correct' => 0,
							'xp' => 15,
							'hint' => 'Le navigateur cherche une chaine de confiance.',
							'explanation' => 'La chaine de confiance : le navigateur ne connait pas cette signature, donc il ne peut pas garantir l\'identite.',
						),
						array(
							'question' => 'Le cadenas du navigateur etant vert, que peux-tu dire du serveur ?',
							'mode' => 'choice',
							'choices' => array( 'Qu\'il utilise la version la plus recente de TLS', 'Qu\'il est chiffre, mais pas forcement qui il est', 'Qu\'il est de confiance et sans faille', 'Qu\'il a passe tous les tests de securite' ),
							'correct' => 1,
							'xp' => 15,
							'hint' => 'Le cadenas parle du chiffrement, pas de l\'identite.',
							'explanation' => 'Tu sais que le canal est confidentiel. Si l\'autorite est douteuse, tu ne sais rien de l\'identite.',
						),
						array(
							'question' => 'Quel est l\'interet du HSTS ?',
							'mode' => 'choice',
							'choices' => array( 'D\'interdire les mots de passe faibles', 'De signer automatiquement les certificats', 'De forcer le navigateur a n\'utiliser que HTTPS', 'De chiffrer le contenu des pages' ),
							'correct' => 2,
							'xp' => 15,
							'hint' => 'HTTP Strict Transport Security.',
							'explanation' => 'HSTS (HTTP Strict Transport Security) interdit les retombees en HTTP : l\'attaquant ne peut plus forcer une connexion en clair.',
						),
						array(
							'question' => 'Dans un service interne, comment garantir l\'identite du serveur ?',
							'mode' => 'choice',
							'choices' => array( 'En desactivant la verification des certificats', 'En acceptant n\'importe quel certificat auto-signe', 'En utilisant le protocole HTTP en interne', 'Avec une autorite interne (PKI) et des certificats emis par elle' ),
							'correct' => 3,
							'xp' => 15,
							'hint' => 'Il faut une autorite a qui les machines font confiance.',
							'explanation' => 'On deploie sa propre autorite de certification interne : les machines lui font confiance, et chaque service a un certificat emis par elle.',
						),
					),
				),
			),
			'terminal' => array(
				'intro' => 'attaquant@intranet:~$ ',
				'unknown' => 'bash: commande introuvable. Essaie « help ».',
				'success' => 'Connexion TLS analysee. Le certificat est auto-signe.',
				'steps' => array(
					array(
						'match' => array( 'openssl s_client -connect localhost:8443', '/openssl s_client .*8443/' ),
						'output' => 'subject=CN = intranet.lab
issuer=CN = intranet.lab
Verify return code: 18 (self-signed certificate)
',
						'hint' => 'La commande openssl s_client permet de voir le certificat du serveur.',
					),
					array(
						'match' => array( 'curl -sk https://localhost:8443/tls-secret.php', '/curl .*tls-secret/' ),
						'output' => 'Registre des cles de distribution
cle_habilitee = FLAG=SECURA{tls_not_proof}
',
						'hint' => 'La page reservee n\'existe qu\'en HTTPS. Le fichier s\'appelle tls-secret.php.',
					),
				),
			),
			'i18n' => array(
				'ar' => array(
					'title' => 'الشهادة التي لا تثبت شيئًا',
					'excerpt' => 'قفل الاتصال. انظر جيدًا إلى ما يقوله، وإلى ما لا يقوله.',
					'tasks' => array(
						array(
							'title' => 'المهمة 1: التشفير نعم، الإثبات لا',
						),
						array(
							'title' => 'المهمة 2: تدريب',
						),
						array(
							'title' => 'المهمة 3: المهمة',
						),
						array(
							'title' => 'المهمة 4: الامتحان',
						),
					),
				),
				'en' => array(
					'title' => 'The certificate that proves nothing',
					'excerpt' => 'The padlock of the connection. Look closely at what it says, and what it does not.',
					'tasks' => array(
						array(
							'title' => 'Task 1: Encryption yes, proof no',
						),
						array(
							'title' => 'Task 2: Practice',
						),
						array(
							'title' => 'Task 3: The mission',
						),
						array(
							'title' => 'Task 4: Exam',
						),
					),
				),
			),
		),	);
}
