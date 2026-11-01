<?php
/**
 * Contenu de démonstration : 6 rooms à 4 tâches, 2 parcours, traductions AR/EN.
 *
 * Les rooms suivent le patron : leçon → entraînement → test d'application → examen.
 * Les réponses attendues ne sont jamais exposées au navigateur.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Rooms de démonstration.
 *
 * @return array
 */
function seca_default_rooms() {
	return array(
		/* ---------------------------------------------------------------- */
		array(
			'title'      => 'Penser comme un défenseur',
			'excerpt'    => 'Les réflexes de base : surface d\'attaque, moindre privilège et réaction à un incident.',
			'content'    => 'Avant de lancer un outil, un défenseur sait ce qu\'il protège et comment il réagit. Cette room te fait prendre les bons réflexes, en 20 minutes.',
			'difficulty' => 'facile',
			'duration'   => 20,
			'xp_bonus'   => 25,
			'tasks'      => array(
				array(
					'type'    => 'lesson',
					'format'  => 'lecon',
					'title'   => 'Task 1 : Le réflexe du défenseur',
					'content' => '<p>Trois idées suffisent pour démarrer :</p><ul><li><strong>La triade CIA</strong> — <em>Confidentialité</em>, <em>Intégrité</em>, <em>Disponibilité</em>. Chaque attaque vise l\'un des trois piliers ; chaque défense protège l\'un des trois.</li><li><strong>La surface d\'attaque</strong> — l\'ensemble des points d\'entrée accessibles : ports ouverts, URL, comptes, API, fichiers.</li><li><strong>Le moindre privilège</strong> — n\'accorder que les droits strictement nécessaires à l\'action en cours.</li></ul><p><strong>À retenir :</strong> un bon défenseur ne cherche pas d\'abord l\'attaque, il réduit d\'abord la surface d\'attaque.</p>',
					'questions' => array(),
				),
				array(
					'type'    => 'practice',
					'format'  => 'qcm',
					'title'   => 'Task 2 : Entraînement',
					'content' => '<p>Six questions pour vérifier que les trois réflexes sont acquis. Tu peux demander un indice : il te coûtera la moitié des points de la question.</p>',
					'questions' => array(
						array(
							'question'    => 'Quel est le premier réflexe d\'un défenseur lorsqu\'il reçoit une alerte de sécurité ?',
							'answers'     => array( 'Collecter des informations', 'Collecter de l\'information', 'Réunir des informations' ),
							'xp'          => 10,
							'hint'        => 'On ne réagit pas à l\'aveugle.',
							'explanation' => 'Avant d\'agir, on rassemble les faits : quoi, quand, où, quelle portée. Agir sans comprendre, c\'est risked aggraver l\'incident.',
						),
						array(
							'question'    => 'Que signifie le principe du moindre privilège ?',
							'answers'     => array( 'N\'accorder que les droits nécessaires', 'Accorder uniquement les droits nécessaires', 'Le moindre privilège' ),
							'xp'          => 10,
							'hint'        => 'Pense au nombre de droits d\'un compte.',
							'explanation' => 'Un compte qui n\'a pas besoin d\'être administrateur ne doit pas l\'être : chaque droit inutile est une porte d\'entrée de plus.',
						),
						array(
							'question'    => 'En sécurité, que désigne la « surface d\'attaque » ?',
							'answers'     => array( 'L\'ensemble des points d\'entrée accessibles', 'La somme des points d\'entrée', 'Les points d\'entrée accessibles' ),
							'xp'          => 10,
							'hint'        => 'Ports, URL, comptes, API : tout ce qui peut être sollicité.',
							'explanation' => 'Réduire la surface d\'attaque, c\'est réduire le nombre de points d\'entrée : fermer un port, retirer un compte, limiter une API.',
						),
						array(
							'question'    => 'Quel document décrit les procédures à suivre lorsqu\'un incident est détecté ?',
							'answers'     => array( 'Le plan de réponse à incident', 'La procédure de réponse à incident', 'Le plan d\'incident', 'La procédure d\'incident' ),
							'xp'          => 10,
							'hint'        => 'On y trouve qui fait quoi, et dans quel ordre.',
							'explanation' => 'Le plan de réponse à incident formalise l\'escalade, les rôles et la communication : c\'est ce qui évite la panique et les mauvaises décisions.',
						),
					),
				),
				array(
					'type'    => 'test',
					'format'  => 'mixte',
					'title'   => "Task 3 : Test d'application — le triage d'incident",
					'content' => '<p><strong>Situation.</strong> Un collègue te signale qu\'une page interne affiche une erreur SQL contenant le nom d\'une table. Ton chef te demande d\'agir tout de suite.</p><p>Réponds en juste : ce qu\'il faut faire d\'abord, et ce qu\'il ne faut surtout pas faire.</p>',
					'terminal' => array(
						'intro'   => "user@cible:~$ ",
						'unknown' => "bash: commande introuvable. Essaie « help ».",
						'success' => "Tu as isolé la cause et la parade à mettre en place.",
						'steps'   => array(
							array(
								'match'  => array( 'cat /var/log/auth.log', '/cat .*auth\.log/' ),
								'output' => "May 02 09:12:01 sshd[1201]: Accepted password for admin from 203.0.113.7 port 51422\nMay 02 09:14:22 sshd[1207]: Failed password for invalid user admin from 203.0.113.7 port 51430\n",
								'hint'   => "Les journaux d'authentification racontent les tentatives.",
							),
							array(
								'match'  => array( 'grep -c "Failed password" /var/log/auth.log', '/grep .*Failed password/' ),
								'output' => "142\n",
								'hint'   => "Compte les échecs d'authentification dans le journal.",
							),
							array(
								'match'  => array( 'cat /srv/triage/notes.txt', '/cat .*triage.*notes/' ),
								'output' => "incident 2024-05-02\ncause : brute-force sur le compte admin\nFLAG=SECURA{triage_defensif}\n",
								'hint'   => "Le dossier de l'incident contient les notes du responsable.",
							),
						),
					),
					'questions' => array(
						array(
							'question'    => 'Quelle est la toute première action ?',
							'answers'     => array( 'Collecter des informations', 'Collecter de l\'information', 'Réunir des informations' ),
							'xp'          => 15,
							'hint'        => 'Rien n\'est encore stabilisé : observe avant de toucher.',
							'explanation' => 'Photographier l\'état (capture, logs, heure exacte) avant toute modification : sans preuve initiale, impossible de démontrer l\'impact ni de vérifier le correctif.',
						),
						array(
							'question'    => 'Que ne faut-il PAS faire en premier ?',
							'answers'     => array( 'Éteindre le serveur', 'Supprimer les logs', 'Redémarrer le service', 'Corriger le code tout de suite', 'Éteindre la machine' ),
							'xp'          => 15,
							'hint'        => 'Tu perdrais la trace de ce qui s\'est passé.',
							'explanation' => 'Redémarrer ou nettoyer supprime les preuves : logs, mémoire, coredump. Tu perds la cause et tu recommences à deviner.',
						),
						array(
							'question'    => 'La triade CIA est respectée sur les trois piliers ?',
							'answers'     => array( 'Non, l\'intégrité est compromise', 'L\'intégrité est compromise', 'Non : l\'intégrité est touchée' ),
							'xp'          => 15,
							'hint'        => 'La donnée a-t-elle été altérée ?',
							'explanation' => 'Une injection SQL exploité modifie des données : c\'est une violation d\'intégrité, la confidentialité peut encore tenir, mais la confiance dans la base est perdue.',
						),
					),
				),
				array(
					'type'       => 'exam',
					'format'     => 'qcm',
					'title'      => 'Task 4 : Examen',
					'content'    => '<p>Trois questions, 10 minutes, seuil 70 %. Aucun indice : c\'est ton moment de vérifier que les réflexes sont automatisés.</p>',
					'time_limit' => 10,
					'pass_score' => 70,
					'questions'  => array(
						array(
							'question'    => 'Quelle propriété de la triade CIA protège contre la modification non autorisée des données ?',
							'answers'     => array( 'L\'intégrité', 'L\'intégrité des données' ),
							'xp'          => 20,
							'explanation' => 'La confidentialité protège la lecture, la disponibilité protège l\'accès, l\'intégrité protège la modification.',
						),
						array(
							'question'    => 'Quel est l\'objectif principal du moindre privilège ?',
							'answers'     => array( 'Limiter l\'impact d\'une compromission', 'Réduire la surface d\'attaque', 'Limiter les dégâts en cas de compromission' ),
							'xp'          => 20,
							'explanation' => 'Si un compte est volé, ses droits limitent l\'étendue des dégâts : c\'est de la limitation de dégâts, pas de la prévention.',
						),
						array(
							'question'    => 'Que documente le plan de réponse à incident ?',
							'answers'     => array( 'Les procédures à suivre', 'La procédure d\'incident', 'Les procédures et les rôles' ),
							'xp'          => 20,
							'explanation' => 'Il documente les procédures, les rôles et l\'escalade : sa valeur vient de l\'anticipation, pas de l\'écrit.',
						),
					),
				),
			),
			'i18n'       => array(
				'ar' => array(
					'title'   => 'التفكير كمدافع',
					'excerpt' => 'الأساسيات: سطح الهجوم، مبدأ الحد الأدنى من الصلاحيات، والاستجابة للحوادث.',
					'tasks'   => array(
						array( 'title' => 'المهمة 1: عادة المدافع' ),
						array( 'title' => 'المهمة 2: تدريب' ),
						array( 'title' => 'المهمة 3: اختبار تطبيقي — فرز الحوادث' ),
						array( 'title' => 'المهمة 4: امتحان' ),
					),
				),
				'en' => array(
					'title'   => 'Think like a defender',
					'excerpt' => 'Core habits: attack surface, least privilege and incident response.',
					'tasks'   => array(
						array( 'title' => 'Task 1: The defender mindset' ),
						array( 'title' => 'Task 2: Practice' ),
						array( 'title' => 'Task 3: Application test — incident triage' ),
						array( 'title' => 'Task 4: Exam' ),
					),
				),
			),
		),

		/* ---------------------------------------------------------------- */
		array(
			'title'      => 'Les fondamentaux du réseau',
			'excerpt'    => 'Comprends comment circulent les données : adressage, ports, et le rôle du pare-feu.',
			'content'    => 'Un réseau, ce n\'est pas une boîte noire : chaque paquet voyage en couches. Cette room te fait suivre un paquet de bout en bout.',
			'difficulty' => 'facile',
			'duration'   => 25,
			'xp_bonus'   => 25,
			'lab'        => array(
				'enabled'    => 1,
				'driver'     => 'auto',
				'mode'       => 'compose',
				'compose'    => 'net-01/docker-compose.yml',
				'project'    => 'seca_net01',
				'service'    => 'attacker',
				'network'    => 'seca_lab',
				'target'     => 'http://web:8080',
				'ttl'        => 3600,
				'allow'      => array( 'ls', 'cat', 'grep', 'nmap', 'curl', 'python3', 'nc', 'ping' ),
				'workdir'    => '/home/ctf',
			),
			'tasks'      => array(
				array(
					'type'    => 'lesson',
					'format'  => 'lecon',
					'title'   => 'Task 1 : Comment circulent les données',
					'content' => '<p>Trois briques suffisent :</p><ul><li><strong>L\'adresse IP</strong> identifie une machine sur le réseau ; l\'<strong>adresse MAC</strong> identifie sa carte réseau sur le lien local.</li><li><strong>Le port</strong> désigne le service : 22 pour SSH, 80 pour HTTP, 443 pour HTTPS.</li><li><strong>Le modèle OSI</strong> découpe la communication en couches : 1 physique, 2 liaison, 3 réseau, 4 transport, 5 session, 6 présentation, 7 application.</li></ul><p><strong>À retenir :</strong> TCP (couche 4) est fiable et orienté connexion ; UDP est rapide et sans connexion.</p>',
					'questions' => array(),
				),
				array(
					'type'    => 'practice',
					'format'  => 'qcm',
					'title'   => 'Task 2 : Entraînement',
					'content' => '<p>Quatre questions pour ancrer les bases du réseau.</p>',
					'questions' => array(
						array(
							'question'    => 'Sur quelle couche du modèle OSI se trouve le protocole TCP ?',
							'answers'     => array( 'Couche 4', 'La couche 4', 'Couche transport', 'La couche transport', 'Transport' ),
							'xp'          => 10,
							'hint'        => 'Compte : 1 physique, 2 liaison, 3 réseau, 4…',
							'explanation' => 'TCP vit en couche 4 (transport) : il gère les segments, les ports et la fiabilité de bout en bout.',
						),
						array(
							'question'    => 'Quelle adresse identifie physiquement une carte réseau sur un réseau local ?',
							'answers'     => array( 'L\'adresse MAC', 'Adresse MAC' ),
							'xp'          => 10,
							'hint'        => 'Six octets, gravés dans la carte.',
							'explanation' => 'L\'adresse MAC est un identifiant de couche 2 : elle identifie l\'interface physique, pas l\'hôte au sens IP.',
						),
						array(
							'question'    => 'Quel protocole est utilisé sur le port 443 ?',
							'answers'     => array( 'HTTPS', 'https' ),
							'xp'          => 10,
							'hint'        => 'C\'est la version chiffrée du web.',
							'explanation' => 'Le port 443 héberge HTTP sur TLS : le trafic est chiffré et l\'identité du serveur est vérifiée via son certificat.',
						),
						array(
							'question'    => 'Quel est le rôle principal d\'un pare-feu (firewall) ?',
							'mode'        => 'choice',
							'choices'     => array( 'Filtrer le trafic réseau', 'Chiffrer les données', 'Sauvegarder les fichiers', 'Accélérer la connexion' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Il autorise, refuse ou journalise les flux.',
							'explanation' => 'Un pare-feu applique une politique de flux : c\'est un contrôle de périmètre, pas une protection des applications elles-mêmes.',
						),
					),
				),
				array(
					'type'    => 'test',
					'format'  => 'mixte',
					'title'   => 'Task 3 : Test d\'application — explorer la machine',
					'content' => '<p><strong>Mission.</strong> Une machine a été compromise. Tu as un accès à son terminal. Trouve le fichier de configuration et la drape qu\'il contient.</p><p>Utilise le terminal ci-dessous : les commandes sont simulées, aucun système réel n\'est touché.</p>',
					'terminal' => array(
						'intro'   => "user@cible:~$ ",
						'unknown' => "bash: commande introuvable. Essaie « help ».",
						'success' => "Félicitations, tu as trouvé le fichier de configuration.",
						'steps'   => array(
							array(
								'match'  => array( 'ls', 'ls -la', 'ls -al', '/ls/' ),
								'output' => "config.txt\nnotes.txt\n",
								'hint'   => 'Liste les fichiers du dossier courant.',
							),
							array(
								'match'  => array( 'cat config.txt', '/cat config\.txt/', 'cat ./config.txt' ),
								'output' => "FLAG=SECURA{net_les_fundamentaux}\n",
								'hint'   => 'Affiche le contenu du fichier de configuration.',
							),
						),
					),
					'questions' => array(
						array(
							'question'    => 'Quel est le flag trouvé dans le fichier de configuration ?',
							'answers'     => array( 'SECURA{net_les_fundamentaux}', 'SECURA{net_les_fondamentaux}' ),
							'xp'          => 15,
							'requires_step' => 2,
							'hint'        => 'Relis la sortie de la commande cat.',
							'explanation' => 'Le flag était dans config.txt : il fallait d\'abord lister les fichiers, puis lire le bon.',
						),
						array(
							'question'    => 'Sur quel port écoute un serveur web chiffré ?',
							'answers'     => array( '443' ),
							'xp'          => 15,
							'hint'        => 'C\'est le port standard de HTTPS.',
							'explanation' => '443 est le port standard pour HTTP sur TLS ; 80 reste le port HTTP en clair.',
						),
						array(
							'question'    => 'Quel protocole transporte les données sans connexion ni garantie de livraison ?',
							'answers'     => array( 'UDP' ),
							'xp'          => 15,
							'hint'        => 'La voix et le streaming l\'utilisent.',
							'explanation' => 'UDP ne retransmet pas : plus rapide, mais aucune garantie d\'arrivée ni d\'ordre. C\'est un choix, pas un défaut.',
						),
						array(
							'question'    => 'Termine l\'exploration de la machine et confirme que tu as lu le fichier de configuration.',
							'mode'        => 'action',
							'xp'          => 10,
							'requires_step' => 2,
							'hint'        => 'Aucune réponse à taper : le serveur vérifie ton terminal.',
							'explanation' => 'Tu as terminé la pratique : la machine a été explorée dans le terminal, pas seulement lue dans l\'énoncé.',
						),
					),
				),
				array(
					'type'       => 'exam',
					'format'     => 'qcm',
					'title'      => 'Task 4 : Examen',
					'content'    => '<p>Trois questions, 10 minutes, seuil 70 %.</p>',
					'time_limit' => 10,
					'pass_score' => 70,
					'questions'  => array(
						array(
							'question'    => 'Quelle couche du modèle OSI gère l\'adressage logique des réseaux ?',
							'answers'     => array( 'Couche 3', 'La couche 3', 'Réseau' ),
							'xp'          => 20,
							'explanation' => 'La couche 3 (réseau) porte les adresses IP et le routage entre réseaux.',
						),
						array(
							'question'    => 'Qu\'est-ce qu\'un port de service ?',
							'answers'     => array( 'Un numéro qui identifie l\'application qui écoute', 'Un numéro identifiant un service sur une machine', 'Un identifiant de service' ),
							'xp'          => 20,
							'explanation' => 'Le port identifie l\'application destinataire sur une machine : c\'est ce qui permet à plusieurs services de cohabiter.',
						),
						array(
							'question'    => 'Que permet une adresse MAC ?',
							'answers'     => array( 'Identifier une interface réseau', 'Identifier la carte réseau', 'Identifier une interface physique' ),
							'xp'          => 20,
							'explanation' => 'Elle identifie l\'interface physique sur le lien local ; elle n\'est pas routable au-delà du segment.',
						),
					),
				),
			),
			'i18n'       => array(
				'ar' => array(
					'title'   => 'أساسيات الشبكات',
					'excerpt' => 'افهم كيف تنتقل البيانات: العناوين والمنفذات ودور الجدار الناري.',
					'tasks'   => array(
						array( 'title' => 'المهمة 1: كيف تنتقل البيانات' ),
						array( 'title' => 'المهمة 2: تدريب' ),
						array( 'title' => 'المهمة 3: اختبار تطبيقي — استكشاف الجهاز' ),
						array( 'title' => 'المهمة 4: امتحان' ),
					),
				),
				'en' => array(
					'title'   => 'Network fundamentals',
					'excerpt' => 'Understand how data travels: addressing, ports and the role of the firewall.',
					'tasks'   => array(
						array( 'title' => 'Task 1: How data travels' ),
						array( 'title' => 'Task 2: Practice' ),
						array( 'title' => 'Task 3: Application test — exploring the machine' ),
						array( 'title' => 'Task 4: Exam' ),
					),
				),
			),
		),

		/* ---------------------------------------------------------------- */
		array(
			'title'      => 'Sécuriser une application web',
			'excerpt'    => 'Injections SQL, XSS, CSRF : identifie les failles web classiques et leurs parades.',
			'content'    => 'La majorité des incidents applicatifs viennent de quelques familles de failles. Cette room te fait les reconnaître en situation.',
			'difficulty' => 'moyen',
			'duration'   => 35,
			'xp_bonus'   => 40,
			'lab'        => array(
				'enabled'    => 1,
				'driver'     => 'auto',
				'mode'       => 'single',
				'image'      => 'securalabs/web-01:1.0',
				'command'    => 'sleep infinity',
				'network'    => 'seca_lab',
				'target'     => 'http://127.0.0.1:8080',
				'ttl'        => 3600,
				'allow'      => array( 'ls', 'cat', 'grep', 'curl', 'python3', 'nc', 'nmap' ),
				'workdir'    => '/home/ctf',
			),
			'tasks'      => array(
				array(
					'type'    => 'lesson',
					'format'  => 'lecon',
					'title'   => 'Task 1 : Les trois failles web à connaître',
					'content' => '<ul><li><strong>Injection SQL</strong> — des données utilisateur sont concaténées dans une requête : l\'attaquant modifie la logique de la requête. <em>Parade :</em> requêtes paramétrées.</li><li><strong>XSS</strong> — du code injecté s\'exécute dans le navigateur d\'une victime. <em>Parade :</em> échappement en sortie + CSP.</li><li><strong>CSRF</strong> — un site tiers force l\'utilisateur connecté à déclencher une action. <em>Parade :</em> jeton anti-CSRF.</li></ul><p><strong>À retenir :</strong> toute donnée venant du client est non fiable. La validation se fait <em>côté serveur</em>, toujours.</p>',
					'questions' => array(),
				),
				array(
					'type'    => 'practice',
					'format'  => 'qcm',
					'title'   => 'Task 2 : Entraînement',
					'content' => '<p>Trois questions pour distinguer les familles de failles.</p>',
					'questions' => array(
						array(
							'question'    => 'Quelle pratique protège une requête SQL contre l\'injection de code ?',
							'answers'     => array( 'Les requêtes paramétrées', 'Requêtes paramétrées', 'La préparation de requêtes', 'Requêtes préparées' ),
							'xp'          => 15,
							'hint'        => 'Les données ne sont jamais concaténées dans la requête.',
							'explanation' => 'En paramétrant, la donnée reste une donnée : elle ne peut pas modifier la structure de la requête, quelle que soit sa valeur.',
						),
						array(
							'question'    => 'Comment se nomme l\'attaque qui consiste à voler la session d\'un utilisateur authentifié ?',
							'answers'     => array( 'Le vol de session', 'Vol de session', 'Le détournement de session', 'Session hijacking' ),
							'xp'          => 15,
							'hint'        => 'Le jeton d\'authentification circule et change de porteur.',
							'explanation' => 'Le jeton de session est un secret temporaire : s\'il est intercepté, il donne accès sans mot de passe. D\'où le cookie HttpOnly et SameSite.',
						),
						array(
							'question'    => 'À quoi sert l\'en-tête de sécurité « Content-Security-Policy » (CSP) ?',
							'answers'     => array( 'Restreindre les sources de chargement', 'Restreindre les sources autorisées', 'Limiter les sources de chargement' ),
							'xp'          => 15,
							'hint'        => 'Il dit au navigateur d\'où il a le droit de charger du contenu.',
							'explanation' => 'La CSP limite les origines autorisées : elle réduit fortement l\'impact d\'une injection de script, même si celle-ci passe.',
						),
					),
				),
				array(
					'type'    => 'test',
					'format'  => 'mixte',
					'title'   => 'Task 3 : Test d\'application — l\'en-tête suspect',
					'content' => '<p><strong>Mission.</strong> Un colleague te transmet la réponse d\'un serveur pour une page de profil.</p><pre>HTTP/1.1 200 OK\nContent-Type: text/html\nSet-Cookie: session=abc123; Secure</pre><p>Deux points sautent aux yeux. Identifie-les et dis ce qu\'il faut corriger.</p>',
					'terminal' => array(
						'intro'   => "user@cible:~$ ",
						'unknown' => "bash: commande introuvable. Essaie « help ».",
						'success' => "Tu as compris ce qu'il reste à corriger sur le serveur.",
						'steps'   => array(
							array(
								'match'  => array( 'curl -I http://cible.local', '/curl -I .*cible/' ),
								'output' => "HTTP/1.1 200 OK\nServer: nginx/1.18.0\nSet-Cookie: session=abc123; Secure\nContent-Type: text/html\n",
								'hint'   => "Récupère les en-têtes renvoyés par la page.",
							),
							array(
								'match'  => array( 'curl -s http://cible.local/robots.txt', '/curl .*robots\.txt/' ),
								'output' => "User-agent: *\nDisallow: /admin\n",
								'hint'   => "Cherche le fichier robots.txt de l'application.",
							),
							array(
								'match'  => array( 'cat /etc/nginx/conf.d/cible.conf', '/cat .*cible\.conf/' ),
								'output' => "server {\n  listen 80;\n  root /var/www/html;\n  # TODO : activer HttpOnly et SameSite\n}\nFLAG=SECURA{web_headers}\n",
								'hint'   => "Le fichier de configuration du serveur dit ce qui reste à corriger.",
							),
						),
					),
					'questions' => array(
						array(
							'question'    => 'Quel est le problème principal avec l\'en-tête Set-Cookie ?',
							'answers'     => array( 'L\'attribut HttpOnly manque', 'Il manque HttpOnly', 'HttpOnly n\'est pas défini' ),
							'xp'          => 15,
							'hint'        => 'Que se passe-t-il si du JavaScript lit le cookie ?',
							'explanation' => 'Sans HttpOnly, un script injecté peut lire le cookie de session et l\'exfiltrer : c\'est l\'enchaînement classique vol de session.',
						),
						array(
							'question'    => 'Quel en-tête manque pour empêcher le clicage trompeur (clickjacking) ?',
							'answers'     => array( 'X-Frame-Options', 'Content-Security-Policy frame-ancestors', 'X-Frame-Options ou CSP frame-ancestors' ),
							'xp'          => 15,
							'hint'        => 'Il interdit d\'afficher ta page dans un cadre.',
							'explanation' => 'X-Frame-Options (ou frame-ancestors en CSP) empêche ton site d\'être inclus dans un cadre : l\'utilisateur ne peut plus être piégé.',
						),
						array(
							'question'    => 'Le cookie a l\'attribut Secure mais pas SameSite. Quel est le risque ?',
							'answers'     => array( 'Le cookie peut être envoyé lors d\'une requête depuis un autre site', 'Risque de CSRF', 'Le cookie peut partir vers un autre site' ),
							'xp'          => 15,
							'hint'        => 'Pense à une requête envoyée automatiquement depuis une autre page.',
							'explanation' => 'Sans SameSite, le navigateur joint le cookie à des requêtes initiées par d\'autres sites : la protection CSRF du cookie disparaît.',
						),
					),
				),
				array(
					'type'       => 'exam',
					'format'     => 'qcm',
					'title'      => 'Task 4 : Examen',
					'content'    => '<p>Trois questions, 15 minutes, seuil 75 %.</p>',
					'time_limit' => 15,
					'pass_score' => 75,
					'questions'  => array(
						array(
							'question'    => 'Où doit se faire la validation des données reçues ?',
							'answers'     => array( 'Côté serveur', 'Sur le serveur', 'Dans le serveur' ),
							'xp'          => 20,
							'explanation' => 'Le client est sous le contrôle de l\'attaquant : seule la validation serveur fait autorité.',
						),
						array(
							'question'    => 'Quelle protection contre le CSRF est la plus efficace ?',
							'answers'     => array( 'Un jeton anti-CSRF', 'Le jeton anti-CSRF', 'Un jeton de synchronisation', 'SameSite Strict' ),
							'xp'          => 20,
							'explanation' => 'Le jeton anti-CSRF lie la requête à la session : sans lui, la requête forgée est rejetée. SameSite est un excellent complément.',
						),
						array(
							'question'    => 'Que se passe-t-il si la donnée utilisateur est concaténée dans une requête SQL ?',
							'answers'     => array( 'Un attaquant peut modifier la logique de la requête', 'La requête peut être injectée', 'Risque d\'injection SQL' ),
							'xp'          => 20,
							'explanation' => 'La concaténation rend la requête modifiable par la donnée : c\'est la définition même de l\'injection SQL.',
						),
					),
				),
			),
			'i18n'       => array(
				'ar' => array(
					'title'   => 'تأمين تطبيق ويب',
					'excerpt' => 'حقن SQL و XSS و CSRF: تعرّف على ثغرات الويب الكلاسيكية ووسائل الحماية.',
					'tasks'   => array(
						array( 'title' => 'المهمة 1: ثلاث ثغرات ويب لا بد أن تعرفها' ),
						array( 'title' => 'المهمة 2: تدريب' ),
						array( 'title' => 'المهمة 3: اختبار تطبيقي — الترويسة المريبة' ),
						array( 'title' => 'المهمة 4: امتحان' ),
					),
				),
				'en' => array(
					'title'   => 'Securing a web application',
					'excerpt' => 'SQL injection, XSS, CSRF: spot the classic web flaws and their fixes.',
					'tasks'   => array(
						array( 'title' => 'Task 1: The three web flaws to know' ),
						array( 'title' => 'Task 2: Practice' ),
						array( 'title' => 'Task 3: Application test — the suspicious header' ),
						array( 'title' => 'Task 4: Exam' ),
					),
				),
			),
		),

		/* ---------------------------------------------------------------- */
		array(
			'title'      => 'Mémoire et défenses',
			'excerpt'    => 'Dépassement de tampon, NX, ASLR, canary : comprends les contrôles qui protègent la mémoire.',
			'content'    => 'L\'écart entre le programme écrit et la mémoire réellement utilisée a été la faille numéro un des systèmes. Cette room explique le mécanisme et ses parades.',
			'difficulty' => 'moyen',
			'duration'   => 30,
			'xp_bonus'   => 40,
			'lab'        => array(
				'enabled'    => 1,
				'driver'     => 'auto',
				'mode'       => 'single',
				'image'      => 'securalabs/bin-01:1.0',
				'command'    => 'sleep infinity',
				'network'    => 'seca_lab',
				'target'     => 'binaire vulnerable : /home/ctf/vuln',
				'ttl'        => 3600,
				'allow'      => array( 'ls', 'cat', 'file', 'checksec', 'gdb', 'python3', 'gcc' ),
				'workdir'    => '/home/ctf',
			),
			'tasks'      => array(
				array(
					'type'    => 'lesson',
					'format'  => 'lecon',
					'title'   => 'Task 1 : Le dépassement de tampon',
					'content' => '<p>Un programme réserve un espace mémoire (un <em>buffer</em>) pour y écrire des données. Si le programme ne vérifie pas la taille reçue, l\'attaquant écrit <strong>au-delà</strong> de cet espace et écrase la pile, où se trouvent les adresses de retour.</p><p>Quatre défenses se combinent :</p><ul><li><strong>NX</strong> (No-Execute) : la pile n\'est pas exécutable.</li><li><strong>ASLR</strong> : les adresses mémoire sont randomisées à chaque exécution.</li><li><strong>Canary</strong> (cookie de pile) : une valeur sentinelle détecte la corruption avant le retour.</li><li><strong>PIE / RELRO</strong> : randomisation et durcissement des segments.</li></ul><p><strong>À retenir :</strong> aucune parade n\'est suffisante seule ; c\'est leur combinaison qui rend l\'exploitation coûteuse.</p>',
					'questions' => array(),
				),
				array(
					'type'    => 'practice',
					'format'  => 'qcm',
					'title'   => 'Task 2 : Entraînement',
					'content' => '<p>Quatre questions sur le mécanisme et ses défenses.</p>',
					'questions' => array(
						array(
							'question'    => 'Comment se nomme la technique qui écrase la pile d\'exécution pour détourner le contrôle du programme ?',
							'answers'     => array( 'Le dépassement de tampon', 'Dépassement de tampon', 'Buffer overflow' ),
							'xp'          => 15,
							'hint'        => 'On écrit plus que prévu dans un tampon trop petit.',
							'explanation' => 'Le dépassement de tampon corrompt les données de contrôle de la pile : c\'est la porte d\'entrée classique de l\'exploitation mémoire.',
						),
						array(
							'question'    => 'Quelle défense rend la pile non exécutable ?',
							'answers'     => array( 'NX', 'No-Execute', 'Le bit NX', 'NX (No-Execute)' ),
							'xp'          => 15,
							'hint'        => 'Une pile où l\'on ne peut pas exécuter de code.',
							'explanation' => 'NX transforme la pile en données : le shellcode injecté ne peut plus être exécuté depuis la pile.',
						),
						array(
							'question'    => 'Que permet la défense ASLR ?',
							'answers'     => array( 'Randomiser les adresses mémoire', 'La randomisation des adresses mémoire', 'Randomiser la disposition de la mémoire' ),
							'xp'          => 15,
							'hint'        => 'Les adresses changent à chaque exécution.',
							'explanation' => 'ASLR rend l\'adresse de la pile imprévisible : l\'attaquant doit obtenir une fuite mémoire pour l\'utiliser.',
						),
						array(
							'question'    => 'Quel est le rôle d\'un canary (cookie de pile) ?',
							'answers'     => array( 'Vérifier l\'intégrité de la pile', 'Détecter la corruption de la pile', 'Détecter les dépassements de tampon' ),
							'xp'          => 15,
							'hint'        => 'Une valeur sentinelle placée avant l\'adresse de retour.',
							'explanation' => 'Le canary est vérifié avant le retour en fonction : s\'il a changé, la pile a été corrompue et le programme s\'arrête.',
						),
					),
				),
				array(
					'type'    => 'test',
					'format'  => 'mixte',
					'title'   => 'Task 3 : Test d\'application — hardening',
					'content' => '<p><strong>Mission.</strong> Une équipe te demande de durcir un serveur. Trois réponses d\'audit sont à évaluer : laquelle est réellement efficace ?</p><p>1. « Le binaire est compilé sans ASLR. »<br>2. « La pile est marquée NX. »<br>3. « Le programme vérifie la longueur avant d\'écrire. »</p>',
					'terminal' => array(
						'intro'   => "user@cible:~$ ",
						'unknown' => "bash: commande introuvable. Essaie « help ».",
						'success' => "Tu as compris pourquoi la compilation est le vrai rempart.",
						'steps'   => array(
							array(
								'match'  => array( 'checksec --file ./vulnerable', '/checksec .*vulnerable/' ),
								'output' => "RELRO      : Partial\nStack      : No canary found\nNX         : disabled\nPIE        : No PIE\n",
								'hint'   => "Analyse les protections activées sur le binaire.",
							),
							array(
								'match'  => array( 'cat Makefile', '/cat .*Makefile/' ),
								'output' => "CFLAGS = -fno-stack-protector -z execstack -no-pie\n",
								'hint'   => "Le Makefile montre les options de compilation utilisées.",
							),
							array(
								'match'  => array( './vulnerable', 'vulnerable', '/vulnerable$/' ),
								'output' => "Buffer: AAAA\nSegmentation fault (core dumped)\nFLAG=SECURA{memoire}\n",
								'hint'   => "Le binaire se lance sans le préfixe ./",
							),
						),
					),
					'questions' => array(
						array(
							'question'    => 'Laquelle de ces mesures est la plus efficace contre un dépassement de tampon ?',
							'answers'     => array( 'Le programme vérifie la longueur avant d\'écrire', 'La vérification de la longueur', 'La validation de la longueur' ),
							'xp'          => 15,
							'hint'        => 'L\'une des trois élimine la cause, pas seulement les conséquences.',
							'explanation' => 'Vérifier la longueur supprime la faille ; NX, ASLR et le canary ne font que rendre l\'exploitation plus difficile. La cause d\'abord.',
						),
						array(
							'question'    => 'Que rend NX impossible ?',
							'answers'     => array( 'L\'exécution de code depuis la pile', 'L\'exécution de shellcode dans la pile', 'L\'exécution de code injecté dans la pile' ),
							'xp'          => 15,
							'hint'        => 'La pile devient une zone de données pure.',
							'explanation' => 'Avec NX, la pile n\'est plus exécutable : le shellcode doit être chargé autrement (ROP), d\'où l\'importance de combiner les défenses.',
						),
						array(
							'question'    => 'Pourquoi ASLR seul ne suffit-il pas ?',
							'answers'     => array( 'Parce qu\'une fuite d\'adresse suffit à la neutraliser', 'Parce qu\'une fuite mémoire révèle les adresses', 'Parce que les adresses peuvent être devinées' ),
							'xp'          => 15,
							'hint'        => 'L\'attaquant a besoin de l\'adresse exacte.',
							'explanation' => 'ASLR ajoute de l\'aléa, pas une garantie : une seule fuite d\'adresse suffit à retrouver la bonne base.',
						),
					),
				),
				array(
					'type'       => 'exam',
					'format'     => 'qcm',
					'title'      => 'Task 4 : Examen',
					'content'    => '<p>Trois questions, 15 minutes, seuil 75 %.</p>',
					'time_limit' => 15,
					'pass_score' => 75,
					'questions'  => array(
						array(
							'question'    => 'Où se trouve l\'adresse de retour, cible classique du dépassement de tampon ?',
							'answers'     => array( 'Dans la pile', 'Sur la pile d\'appel', 'Dans la pile d\'appels' ),
							'xp'          => 20,
							'explanation' => 'L\'adresse de retour est empilée lors de l\'appel : la corrompre redirige l\'exécution.',
						),
						array(
							'question'    => 'Quelle est la bonne stratégie de défense ?',
							'answers'     => array( 'Combiner plusieurs mécanismes', 'Combiner les mécanismes de défense', 'La défense en profondeur' ),
							'xp'          => 20,
							'explanation' => 'La défense en profondeur : chaque couche fait échouer une technique différente.',
						),
						array(
							'question'    => 'Que vérifie concrètement le canary ?',
							'answers'     => array( 'Que la valeur sentinelle est intacte', 'L\'intégrité de la valeur sentinelle', 'Que la sentinelle n\'a pas changé' ),
							'xp'          => 20,
							'explanation' => 'Si la sentinelle a changé, la pile a été corrompue : le programme s\'interrompt avant le retour.',
						),
					),
				),
			),
			'i18n'       => array(
				'ar' => array(
					'title'   => 'الذاكرة والدفاعات',
					'excerpt' => 'تجاوز المخزن المؤقت و NX و ASLR والكناري: افهم آليات الحماية التي تحمي الذاكرة.',
					'tasks'   => array(
						array( 'title' => 'المهمة 1: تجاوز المخزن المؤقت' ),
						array( 'title' => 'المهمة 2: تدريب' ),
						array( 'title' => 'المهمة 3: اختبار تطبيقي — التقوية' ),
						array( 'title' => 'المهمة 4: امتحان' ),
					),
				),
				'en' => array(
					'title'   => 'Memory and defenses',
					'excerpt' => 'Buffer overflow, NX, ASLR, canary: understand the controls that protect memory.',
					'tasks'   => array(
						array( 'title' => 'Task 1: The buffer overflow' ),
						array( 'title' => 'Task 2: Practice' ),
						array( 'title' => 'Task 3: Application test — hardening' ),
						array( 'title' => 'Task 4: Exam' ),
					),
				),
			),
		),

		/* ---------------------------------------------------------------- */
		array(
			'title'      => 'Authentification',
			'excerpt'    => 'Mots de passe, MFA, hachage salé : durcis la preuve d\'identité des utilisateurs.',
			'content'    => 'L\'authentification est la porte d\'entrée : tout le reste de la sécurité repose sur sa qualité.',
			'difficulty' => 'moyen',
			'duration'   => 30,
			'xp_bonus'   => 40,
			'tasks'      => array(
				array(
					'type'    => 'lesson',
					'format'  => 'lecon',
					'title'   => 'Task 1 : Prouver son identité',
					'content' => '<p>Trois notions :</p><ul><li><strong>Facteur</strong> — ce que vous savez (mot de passe), ce que vous avez (jeton), ce que vous êtes (biométrie).</li><li><strong>MFA</strong> — au moins deux facteurs de familles différentes : un mot de passe + une application TOTP, c\'est du 2FA robuste.</li><li><strong>Stockage</strong> — le mot de passe ne doit jamais être stocké : on stocke un <em>hachage salé</em> et lent (bcrypt, Argon2, scrypt). Le sel est unique par utilisateur et rend les tables pré-calculées inutiles.</li></ul><p><strong>À retenir :</strong> la longueur prime sur la complexité. Un mot de passe long et unique bat un mot de passe court et compliqué réutilisé.</p>',
					'questions' => array(),
				),
				array(
					'type'    => 'practice',
					'format'  => 'qcm',
					'title'   => 'Task 2 : Entraînement',
					'content' => '<p>Trois questions sur les fondamentaux de l\'authentification.</p>',
					'questions' => array(
						array(
							'question'    => 'Que signifie l\'acronyme MFA dans le contexte de l\'authentification ?',
							'answers'     => array( 'L\'authentification multifacteur', 'Authentification multifacteur', 'Multi-factor authentication' ),
							'xp'          => 15,
							'hint'        => 'Plusieurs éléments de preuve, de natures différentes.',
							'explanation' => 'Le MFA combine des facteurs de familles différentes : un SMS seul reste un facteur unique, donc faible.',
						),
						array(
							'question'    => 'Quel algorithme de hachage est conçu pour être volontairement lent et salé ?',
							'answers'     => array( 'bcrypt', 'argon2', 'Argon2', 'scrypt' ),
							'xp'          => 15,
							'hint'        => 'La lenteur est ici une fonctionnalité.',
							'explanation' => 'bcrypt, Argon2 et scrypt sont volontairement coûteux : ils transforment le cassage par force brute en aberration économique.',
						),
						array(
							'question'    => 'Quelle garantie apporte une signature numérique ?',
							'answers'     => array( 'L\'intégrité et l\'authenticité du message', 'L\'intégrité et l\'authenticité', 'L\'intégrité du message et l\'authenticité de l\'auteur' ),
							'xp'          => 15,
							'hint'        => 'Deux propriétés : rien n\'a bougé, et cela vient bien de l\'expéditeur.',
							'explanation' => 'La signature garantit l\'intégrité et l\'authenticité ; elle ne garantit pas la confidentialité.',
						),
					),
				),
				array(
					'type'    => 'test',
					'format'  => 'mixte',
					'title'   => 'Task 3 : Test d\'application — le mot de passe oublié',
					'content' => '<p><strong>Mission.</strong> L\'équipe a observé des tentatives de connexion massives sur le formulaire « mot de passe oublié ». Trois mesures possibles.</p><p>1. Envoyer le lien par email.<br>2. Limiter le nombre de tentatives par adresse IP.<br>3. Ne jamais dire si l\'adresse existe.</p>',
					'terminal' => array(
						'intro'   => "user@cible:~$ ",
						'unknown' => "bash: commande introuvable. Essaie « help ».",
						'success' => "Tu as compris à quel point le mécanisme de réinitialisation est fragile.",
						'steps'   => array(
							array(
								'match'  => array( 'cat /etc/passwd', '/cat .*passwd/' ),
								'output' => "root:x:0:0:root:/root:/bin/bash\nwww-data:x:33:33:www-data:/var/www:/usr/sbin/nologin\napp:x:1000:1000::/srv/app:/bin/bash\n",
								'hint'   => "Liste les comptes présents sur le serveur.",
							),
							array(
								'match'  => array( 'grep -i reset /srv/app/app.log', '/grep .*reset/' ),
								'output' => "2024-05-02 09:14:22 reset requested for app@exemple.fr token=7f3a9c2b\n",
								'hint'   => "Cherche une demande de réinitialisation dans les journaux de l'application.",
							),
							array(
								'match'  => array( 'cat /srv/app/reset_token', '/cat .*reset_token/' ),
								'output' => "7f3a9c2b\nFLAG=SECURA{auth_reset}\n",
								'hint'   => "Le jeton de réinitialisation a été écrit dans un fichier.",
							),
						),
					),
					'questions' => array(
						array(
							'question'    => 'Pourquoi ne pas indiquer si une adresse email est enregistrée ?',
							'answers'     => array( 'Pour éviter d\'énumérer les comptes existants', 'Pour ne pas révéler les comptes existants', 'Ça évite l\'énumération de comptes' ),
							'xp'          => 15,
							'hint'        => 'Pense à ce que la réponse permet d\'apprendre.',
							'explanation' => 'Un message différent selon le cas permet de lister les comptes valides : c\'est une fuite d\'information exploitable.',
						),
						array(
							'question'    => 'Quelle mesure bloque le bourrage d\'identifiants ?',
							'answers'     => array( 'La limitation des tentatives', 'Le rate limiting', 'Limiter le nombre de tentatives' ),
							'xp'          => 15,
							'hint'        => 'Il faut ralentir l\'attaquant.',
							'explanation' => 'Le rate limiting transforme une attaque rapide en attaque lente : c\'est ce qui la rendCadabra coûteuse.',
						),
						array(
							'question'    => 'Que doit être le délai de validité d\'un lien de réinitialisation ?',
							'answers'     => array( 'Court, à usage unique', 'Court et à usage unique', 'Court, utilisable une seule fois' ),
							'xp'          => 15,
							'hint'        => 'Un jeton court ne laisse pas le temps de fuiter.',
							'explanation' => 'Jeton aléatoire, usage unique, expiration courte : ce triplet est la base d\'un mécanisme de réinitialisation sûr.',
						),
					),
				),
				array(
					'type'       => 'exam',
					'format'     => 'qcm',
					'title'      => 'Task 4 : Examen',
					'content'    => '<p>Trois questions, 15 minutes, seuil 75 %.</p>',
					'time_limit' => 15,
					'pass_score' => 75,
					'questions'  => array(
						array(
							'question'    => 'Pourquoi sale-t-on un mot de passe avant de le hacher ?',
							'answers'     => array( 'Pour que deux mots de passe identiques donnent des hachages différents', 'Pour rendre les hachages uniques par utilisateur', 'Pour éviter les collisions' ),
							'xp'          => 20,
							'explanation' => 'Le sel empêche le pré-calcul : chaque hachage doit être calculé séparément, ce qui supprime les tables pré-calculées.',
						),
						array(
							'question'    => 'Quel est le principal avantage du MFA sur un simple mot de passe ?',
							'answers'     => array( 'Il résiste au vol du mot de passe', 'Il résiste à la fuite du mot de passe', 'Le mot de passe volé ne suffit plus' ),
							'xp'          => 20,
							'explanation' => 'Avec deux facteurs, le vol du mot de passe seul ne donne aucun accès : c\'est ce qui change la donne.',
						),
						array(
							'question'    => 'Quelle propriété est la plus déterminante pour la robustesse d\'un mot de passe ?',
							'answers'     => array( 'Sa longueur', 'La longueur du mot de passe', 'Sa longueur et son unicité' ),
							'xp'          => 20,
							'explanation' => 'La longueur multiplie le nombre de combinaisons possibles ; l\'unicité évite le réutilisation entre services.',
						),
					),
				),
			),
			'i18n'       => array(
				'ar' => array(
					'title'   => 'المصادقة',
					'excerpt' => 'كلمات المرور والمصادقة متعددة العوامل والتجزئة المملّحة: صمّم هوية المستخدمين.',
					'tasks'   => array(
						array( 'title' => 'المهمة 1: إثبات هويتك' ),
						array( 'title' => 'المهمة 2: تدريب' ),
						array( 'title' => 'المهمة 3: اختبار تطبيقي — نسيت كلمة المرور' ),
						array( 'title' => 'المهمة 4: امتحان' ),
					),
				),
				'en' => array(
					'title'   => 'Authentication',
					'excerpt' => 'Passwords, MFA, salted hashing: harden how users prove who they are.',
					'tasks'   => array(
						array( 'title' => 'Task 1: Proving your identity' ),
						array( 'title' => 'Task 2: Practice' ),
						array( 'title' => 'Task 3: Application test — the forgotten password' ),
						array( 'title' => 'Task 4: Exam' ),
					),
				),
			),
		),

		/* ---------------------------------------------------------------- */
		array(
			'title'      => 'Chiffrement et HTTPS',
			'excerpt'    => 'Symétrique, asymétrique, hachage : les briques du chiffrement et la mécanique de TLS.',
			'content'    => 'Le chiffrement protège les données en transit et au repos, à condition de choisir la bonne primitive et de la combiner correctement.',
			'difficulty' => 'difficile',
			'duration'   => 40,
			'xp_bonus'   => 60,
			'tasks'      => array(
				array(
					'type'    => 'lesson',
					'format'  => 'lecon',
					'title'   => 'Task 1 : Les quatre briques',
					'content' => '<ul><li><strong>Hachage</strong> — un sens unique, non réversible, avec sel. Sert à l\'intégrité et au stockage de mots de passe, <em>jamais</em> au chiffrement.</li><li><strong>Chiffrement symétrique</strong> — une clé unique (AES). Rapide, pour de gros volumes.</li><li><strong>Chiffrement asymétrique</strong> — une paire clé privée / clé publique (RSA, ECDSA). Asymétrique, pour le partage de clés et les signatures.</li><li><strong>Échange de clés</strong> — Diffie-Hellman permet d\'établir un secret commun sur un canal surveillé ; TLS l\'utilise pour créer une clé de session.</li></ul><p><strong>À retenir :</strong> TLS combine les deux : asymétrique pour s\'authentifier et négocier, symétrique pour transporter les données.</p>',
					'questions' => array(),
				),
				array(
					'type'    => 'practice',
					'format'  => 'qcm',
					'title'   => 'Task 2 : Entraînement',
					'content' => '<p>Quatre questions sur les primitives cryptographiques.</p>',
					'questions' => array(
						array(
							'question'    => 'Quel algorithme est un chiffrement symétrique (clé unique) ?',
							'answers'     => array( 'AES', 'Aes', 'AES-256', 'ChaCha20' ),
							'xp'          => 20,
							'hint'        => 'La même clé chiffre et déchiffre.',
							'explanation' => 'AES est la référence symétrique ; ChaCha20 est un excellent alternative quand le matériel n\'a pas d\'instructions AES natives.',
						),
						array(
							'question'    => 'Quel protocole négocie et sécurise un canal chiffré entre un client et un serveur ?',
							'answers'     => array( 'TLS', 'Le protocole TLS', 'SSL/TLS' ),
							'xp'          => 20,
							'hint'        => 'C\'est lui qui est derrière le petit cadenas.',
							'explanation' => 'TLS assure confidentialité, intégrité et authentification du serveur ; la version moderne est TLS 1.3.',
						),
						array(
							'question'    => 'Quel algorithme permet à deux parties d\'établir une clé secrète sur un canal non sécurisé ?',
							'answers'     => array( 'Diffie-Hellman', 'L\'algorithme Diffie-Hellman', 'Diffie Hellman' ),
							'xp'          => 20,
							'hint'        => 'Chacun combine son secret avec la valeur publique de l\'autre.',
							'explanation' => 'Diffie-Hellman repose sur le problème du logarithme discret ; TLS l\'utilise (EC)DHE pour la clé de session.',
						),
						array(
							'question'    => 'Quelle propriété garantit qu\'un message chiffré n\'a pas été modifié en route ?',
							'answers'     => array( 'L\'intégrité', 'L\'intégrité du message', 'Le contrôle d\'intégrité' ),
							'xp'          => 20,
							'hint'        => 'Le chiffrement seul ne suffit pas.',
							'explanation' => 'Un mode d\'authentification (AEAD, HMAC) est nécessaire : le chiffrement seul ne détecte pas la modification.',
						),
					),
				),
				array(
					'type'    => 'test',
					'format'  => 'mixte',
					'title'   => 'Task 3 : Test d\'application — lire la négociation',
					'content' => '<p><strong>Mission.</strong> Une capture montre la négociation TLS d\'un serveur.</p><pre>ClientHello: TLS 1.3, cipher suites: TLS_AES_128_GCM_SHA256\nServerHello: TLS 1.3, key exchange: (EC)DHE\nCertificate: CN=exemple.fr, issuer Let\'s Encrypt</pre><p>Trois questions sur ce que tu observes.</p>',
					'terminal' => array(
						'intro'   => "user@cible:~$ ",
						'unknown' => "bash: commande introuvable. Essaie « help ».",
						'success' => "Tu sais maintenant lire une négociation TLS.",
						'steps'   => array(
							array(
								'match'  => array( 'openssl s_client -connect cible:443', '/openssl s_client .*443/' ),
								'output' => "CONNECTED(00000003)\ndepth=2 CN=exemple.fr\nissuer=CN=R3 Lets Encrypt\nprotocol version: TLSv1.3\n",
								'hint'   => "Ouvre une session TLS pour lire le certificat présenté.",
							),
							array(
								'match'  => array( 'openssl x509 -in /etc/ssl/certs/cible.pem -text -noout', '/openssl x509 .*/' ),
								'output' => "Subject: CN=exemple.fr\nX509v3 Subject Alternative Name: \n    DNS:exemple.fr, DNS:www.exemple.fr, IP:192.0.2.10\nFLAG=SECURA{tls_sni}\n",
								'hint'   => "Affiche le certificat au format texte.",
							),
							array(
								'match'  => array( 'cat /etc/ssl/openssl.cnf', '/cat .*openssl\.cnf/' ),
								'output' => "[ req ]\ndistinguished_name = req_distinguished_name\n[ req_distinguished_name ]\ncommonName = exemple.fr\n",
								'hint'   => "La configuration OpenSSL du serveur se trouve dans /etc/ssl.",
							),
						),
					),
					'questions' => array(
						array(
							'question'    => 'Quel est l\'avantage de TLS 1.3 sur TLS 1.2 ?',
							'answers'     => array( 'Il supprime les algorithmes fragiles et réduit la négociation', 'Moins d\'algorithmes de cryptographie', 'Il supprime les algorithmes obsolètes' ),
							'xp'          => 20,
							'hint'        => 'Comparaison du nombre de choix proposés.',
							'explanation' => 'TLS 1.3 réduit la surface : moins de suites, pas de MD5/SHA-1, et un handshake plus court donc plus rapide.',
						),
						array(
							'question'    => 'Quel est le rôle de (EC)DHE dans cette négociation ?',
							'answers'     => array( 'Établir la clé de session', 'Négocier la clé de session', 'Créer la clé de session' ),
							'xp'          => 20,
							'hint'        => 'C\'est l\'étape juste avant la clé de session.',
							'explanation' => '(EC)DHE établit un secret partagé, qui devient la clé de session symétrique : c\'est le meilleur des deux mondes.',
						),
						array(
							'question'    => 'Que garantit le certificat présenté par le serveur ?',
							'answers'     => array( 'Son identité et le lien avec la clé publique', 'L\'identité du serveur', 'Que le serveur est bien le domaine annoncé' ),
							'xp'          => 20,
							'hint'        => 'Le certificat lie un nom à une clé publique.',
							'explanation' => 'Le certificat lie le nom de domaine à la clé publique ; l\'autorité de certification l\'a signé, d\'où la chaîne de confiance.',
						),
					),
				),
				array(
					'type'       => 'exam',
					'format'     => 'qcm',
					'title'      => 'Task 4 : Examen',
					'content'    => '<p>Trois questions, 15 minutes, seuil 75 %.</p>',
					'time_limit' => 15,
					'pass_score' => 75,
					'questions'  => array(
						array(
							'question'    => 'Pourquoi TLS utilise-t-il à la fois du asymétrique et du symétrique ?',
							'answers'     => array( 'L\'asymétrique pour s\'authentifier et négocier, le symétrique pour transporter les données', 'Pour combiner les deux algorithmes', 'Le symétrique est plus rapide pour les données' ),
							'xp'          => 20,
							'explanation' => 'L\'asymétrique résout le problème de la distribution de clés ; le symétrique est trop rapide pour être abandonné une fois la session établie.',
						),
						array(
							'question'    => 'Pourquoi ne peut-on pas utiliser un hachage pour chiffrer des données ?',
							'answers'     => array( 'Parce qu\'il est à sens unique', 'Le hachage est irréversible', 'Parce qu\'on ne peut pas le déhacher' ),
							'xp'          => 20,
							'explanation' => 'Le hachage perd l\'information : on ne peut pas retrouver le message. Il sert à l\'intégrité, pas à la confidentialité.',
						),
						array(
							'question'    => 'Quelle est la fonction d\'une suite de chiffrement AEAD ?',
							'answers'     => array( 'Chiffrer et authentifier en une seule opération', 'Chiffrer et vérifier l\'intégrité', 'Fournir le chiffrement et le contrôle d\'intégrité' ),
							'xp'          => 20,
							'explanation' => 'AEAD garantit la confidentialité <em>et</em> l\'intégrité, ce qui supprime la plupart des erreurs d\'implémentation.',
						),
					),
				),
			),
			'i18n'       => array(
				'ar' => array(
					'title'   => 'التشفير و HTTPS',
					'excerpt' => 'التشفير المتماثل وغير المتماثل والتجزئة: لبناء التشفير وآلية TLS.',
					'tasks'   => array(
						array( 'title' => 'المهمة 1: القطع الأربع' ),
						array( 'title' => 'المهمة 2: تدريب' ),
						array( 'title' => 'المهمة 3: اختبار تطبيقي — قراءة التفاوض' ),
						array( 'title' => 'المهمة 4: امتحان' ),
					),
				),
				'en' => array(
					'title'   => 'Encryption and HTTPS',
					'excerpt' => 'Symmetric, asymmetric, hashing: the building blocks of encryption and TLS.',
					'tasks'   => array(
						array( 'title' => 'Task 1: The four building blocks' ),
						array( 'title' => 'Task 2: Practice' ),
						array( 'title' => 'Task 3: Application test — reading the handshake' ),
						array( 'title' => 'Task 4: Exam' ),
					),
				),
			),
		),
	);
}

/**
 * Parcours de démonstration.
 *
 * @param array $room_ids     Identifiants des rooms de démonstration, dans l'ordre.
 * @param array $m3_room_ids  Identifiants des rooms M3 (dix scénarios), dans l'ordre.
 * @return array
 */
function seca_default_paths( $room_ids, $m3_room_ids = array(), $uni_room_ids = array() ) {
	$room_ids     = array_values( array_map( 'absint', (array) $room_ids ) );
	$m3_room_ids  = array_values( array_map( 'absint', (array) $m3_room_ids ) );
	$uni_room_ids = array_values( array_map( 'absint', (array) $uni_room_ids ) );

	$paths = array(
		array(
			'title'      => 'Fondations : réseaux, web et cryptographie',
			'excerpt'    => 'Du réseau au chiffrement : 6 rooms guidées pour poser les bases de la sécurité.',
			'content'    => 'Ce parcours suit les fondamentaux : réseau, web et cryptographie. Chaque room se termine par un examen court et une médaille.',
			'difficulty' => 'facile',
			'duration'   => 170,
			'xp_bonus'   => 100,
			'sections'   => array(
				array(
					'title' => 'Module 1 : Introduction à la cybersécurité',
					'rooms' => isset( $room_ids[0] ) ? array( $room_ids[0] ) : array(),
				),
				array(
					'title' => 'Module 2 : Fondamentaux des réseaux',
					'rooms' => isset( $room_ids[1] ) ? array( $room_ids[1] ) : array(),
				),
				array(
					'title' => 'Module 3 : Sécurité des applications web',
					'rooms' => isset( $room_ids[2] ) ? array( $room_ids[2] ) : array(),
				),
				array(
					'title' => 'Module 4 : Mémoire et défenses',
					'rooms' => isset( $room_ids[3] ) ? array( $room_ids[3] ) : array(),
				),
				array(
					'title' => 'Module 5 : Authentification',
					'rooms' => isset( $room_ids[4] ) ? array( $room_ids[4] ) : array(),
				),
				array(
					'title' => 'Module 6 : Chiffrement et HTTPS',
					'rooms' => isset( $room_ids[5] ) ? array( $room_ids[5] ) : array(),
				),
			),
			'i18n'       => array(
				'ar' => array(
					'title'   => 'الأساسيات: الشبكات والويب والتشفير',
					'excerpt' => 'من الشبكة إلى التشفير: 6 غرف إرشادية لتأسيس أمن المعلومات.',
					'sections' => array(
						array( 'title' => 'الوحدة 1: مقدمة في أمن المعلومات' ),
						array( 'title' => 'الوحدة 2: أساسيات الشبكات' ),
						array( 'title' => 'الوحدة 3: أمن تطبيقات الويب' ),
						array( 'title' => 'الوحدة 4: الذاكرة والدفاعات' ),
						array( 'title' => 'الوحدة 5: المصادقة' ),
						array( 'title' => 'الوحدة 6: التشفير و HTTPS' ),
					),
				),
				'en' => array(
					'title'   => 'Foundations: networks, web and cryptography',
					'excerpt' => 'From networks to encryption: 6 guided rooms to lay the security groundwork.',
					'sections' => array(
						array( 'title' => 'Module 1: Introduction to cyber security' ),
						array( 'title' => 'Module 2: Network fundamentals' ),
						array( 'title' => 'Module 3: Web application security' ),
						array( 'title' => 'Module 4: Memory and defenses' ),
						array( 'title' => 'Module 5: Authentication' ),
						array( 'title' => 'Module 6: Encryption and HTTPS' ),
					),
				),
			),
		),
		/* --------------------------------------------------------------
		 * Parcours « Scénarios M3 » : dix missions réelles, une par
		 * semaine, chacune vérifiée sur une vraie machine.
		 * ------------------------------------------------------------ */
		array(
			'title'      => 'Scénarios M3 : dix missions réelles',
			'excerpt'    => 'Dix situations de travail (serveur en panne, mot de passe oublié, page trahie, injection SQL, sauvegarde oubliée, journaux, ports, pivot, binaire, certificat). Chaque mission se valide sur une vraie machine : le serveur vérifie le drapeau dans ton conteneur.',
			'content'    => 'Ce parcours ne se valide pas à la lecture. À chaque mission, tu déploies une machine, tu fais le travail, et tu rapportes une preuve : le drapeau. Le serveur va le lire dans ta machine — copier la réponse d\'autre part ne suffit pas.',
			'difficulty' => 'moyen',
			'duration'   => 300,
			'xp_bonus'   => 250,
			'sections'   => array(
				array(
					'title' => 'Module 1 : Triage et secrets (scénarios 1 et 2)',
					'rooms' => array_slice( $m3_room_ids, 0, 2 ),
				),
				array(
					'title' => 'Module 2 : Le web se trahit (scénarios 3 et 4)',
					'rooms' => array_slice( $m3_room_ids, 2, 2 ),
				),
				array(
					'title' => 'Module 3 : Fichiers et journaux (scénarios 5 et 6)',
					'rooms' => array_slice( $m3_room_ids, 4, 2 ),
				),
				array(
					'title' => 'Module 4 : Réseau et pivot (scénarios 7 et 8)',
					'rooms' => array_slice( $m3_room_ids, 6, 2 ),
				),
				array(
					'title' => 'Module 5 : Mémoire et TLS (scénarios 9 et 10)',
					'rooms' => array_slice( $m3_room_ids, 8, 2 ),
				),
			),
			'i18n'       => array(
				'ar' => array(
					'title'   => 'سيناريوهات M3: عشر مهام حقيقية',
					'excerpt' => 'عشر مواقف من العمل الحقيقي، كل واحدة منها تُتحقَّق على آلة حقيقية: يقرأ الخادم العلم داخل حاويتك.',
					'sections' => array(
						array( 'title' => 'الوحدة 1: الفرز والأسرار (السيناريو 1 و 2)' ),
						array( 'title' => 'الوحدة 2: الويب يخون (السيناريو 3 و 4)' ),
						array( 'title' => 'الوحدة 3: الملفات والسجلات (السيناريو 5 و 6)' ),
						array( 'title' => 'الوحدة 4: الشبكة والانعطافة (السيناريو 7 و 8)' ),
						array( 'title' => 'الوحدة 5: الذاكرة و TLS (السيناريو 9 و 10)' ),
					),
				),
				'en' => array(
					'title'   => 'M3 scenarios: ten real missions',
					'excerpt' => 'Ten real-life situations, each validated on a real machine: the server reads the flag inside your container.',
					'sections' => array(
						array( 'title' => 'Module 1: Triage and secrets (scenarios 1 and 2)' ),
						array( 'title' => 'Module 2: The web gives itself away (scenarios 3 and 4)' ),
						array( 'title' => 'Module 3: Files and logs (scenarios 5 and 6)' ),
						array( 'title' => 'Module 4: Network and pivot (scenarios 7 and 8)' ),
						array( 'title' => 'Module 5: Memory and TLS (scenarios 9 and 10)' ),
					),
				),
			),
		),
		/* --------------------------------------------------------------
		 * Parcours « Les universites » : vingt-deux rooms, six cours
		 * reellement gratuits et ouverts (MIT, pwn.college, CYBER.ORG,
		 * OWASP, Stanford). Chaque room montre le cours en video et
		 * demande la preuve dans la machine du laboratoire.
		 * ------------------------------------------------------------ */
		array(
			'title'      => 'Les universites : 22 rooms, 6 cours',
			'excerpt'    => 'MIT 6.858, MIT 6.857, pwn.college, CYBER.ORG, OWASP et Stanford : le cours original en video, et notre pratique dans la machine.',
			'content'    => 'Ce parcours est le plus exigeant de la plateforme. Pour chaque notion, tu vois le cours du professeur (l\'original, charge au clic) et tu fais le travail dans la machine du laboratoire. Le drapeau se lit dans ta machine : impossible de recopier une reponse.',
			'difficulty' => 'difficile',
			'duration'   => 780,
			'xp_bonus'   => 500,
			'sections'   => array(
				array(
					'title' => 'MIT 6.858 : systemes securises (5 rooms)',
					'rooms' => array_slice( $uni_room_ids, 0, 5 ),
				),
				array(
					'title' => 'MIT 6.857 : reseau et cryptographie (4 rooms)',
					'rooms' => array_slice( $uni_room_ids, 5, 4 ),
				),
				array(
					'title' => 'pwn.college : de la memoire au shell (4 rooms)',
					'rooms' => array_slice( $uni_room_ids, 9, 4 ),
				),
				array(
					'title' => 'CYBER.ORG : hygiene numerique (4 rooms)',
					'rooms' => array_slice( $uni_room_ids, 13, 4 ),
				),
				array(
					'title' => 'OWASP : securite des applications (3 rooms)',
					'rooms' => array_slice( $uni_room_ids, 17, 3 ),
				),
				array(
					'title' => 'Stanford : comment marche un ordinateur (2 rooms)',
					'rooms' => array_slice( $uni_room_ids, 20, 2 ),
				),
			),
			'i18n'       => array(
				'ar' => array(
					'title'   => 'الجامعات: 22 غرفة، 6 دورات',
					'excerpt' => 'MIT 6.858 و6.857 وpwn.college وCYBER.ORG وOWASP وStanford: الدرس الأصلي بالفيديو، وتطبيقنا في الآلة.',
					'sections' => array(
						array( 'title' => 'MIT 6.858: أنظمة آمنة (5 غرف)' ),
						array( 'title' => 'MIT 6.857: الشبكة والتشفير (4 غرف)' ),
						array( 'title' => 'pwn.college: من الذاكرة إلى الصدفة (4 غرف)' ),
						array( 'title' => 'CYBER.ORG: النظافة الرقمية (4 غرف)' ),
						array( 'title' => 'OWASP: أمن التطبيقات (3 غرف)' ),
						array( 'title' => 'Stanford: كيف يعمل الحاسوب (غرفتان)' ),
					),
				),
				'en' => array(
					'title'   => 'The universities: 22 rooms, 6 courses',
					'excerpt' => 'MIT 6.858, MIT 6.857, pwn.college, CYBER.ORG, OWASP and Stanford: the original course video, and our practice in the machine.',
					'sections' => array(
						array( 'title' => 'MIT 6.858: secure systems (5 rooms)' ),
						array( 'title' => 'MIT 6.857: networks and cryptography (4 rooms)' ),
						array( 'title' => 'pwn.college: from memory to shell (4 rooms)' ),
						array( 'title' => 'CYBER.ORG: digital hygiene (4 rooms)' ),
						array( 'title' => 'OWASP: application security (3 rooms)' ),
						array( 'title' => 'Stanford: how a computer works (2 rooms)' ),
					),
				),
			),
		),
	);

	return $paths;
}
