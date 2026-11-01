# -*- coding: utf-8 -*-
"""MIT 6.857 - Network and Computer Security : quatre rooms.

Sources : MIT OpenCourseWare (CC BY-NC-SA 4.0). Textes originaux.
"""

MIT = 'MIT OpenCourseWare'
LIC = 'CC BY-NC-SA 4.0 - MIT OpenCourseWare'
INST = 'MIT - 6.858 Computer Systems Security (Fall 2014)'

ROOMS = [
    {
        'title': 'Segmenter, isoler, pivoter : la sécurité réseau',
        'excerpt': 'Le réseau ne protège pas tout seul : sans segmentation, une porte ouverte donne tout le bâtiment.',
        'content': 'La leçon 12 de 6.858 : ce que le réseau TCP/IP garantit, ce qu\'il ne garantit pas, et le rôle de la segmentation.',
        'difficulty': 'moyen',
        'duration': 35,
        'xp_bonus': 45,
        'video': {
            'id': 'BZTWXl9QNK8',
            'title': '12. Network Security',
            'channel': MIT,
            'institution': INST,
            'license': LIC,
            'duration': '1:18:26',
            'note': 'Cours vidéo de l\'université (MIT OpenCourseWare). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — segmentation et pivot',
        'lesson': (
            '<p>Le réseau repose sur TCP/IP, un protocole qui a été conçu pour <em>transporter</em>, pas pour <em>protéger</em>. '
            'Trois exemples de ce qu\'il ne fait pas :</p>'
            '<ul>'
            '<li><strong>Les numéros de séquence</strong> sont courts (32 bits) : on peut les deviner et injecter des données dans une connexion.</li>'
            '<li><strong>L\'adresse IP</strong> se spoof facilement : rien ne vérifie que la machine qui envoie est bien celle qu\'elle dit être.</li>'
            '<li><strong>Le chiffrement de base</strong> n\'existe pas dans TCP/IP : tout passe en clair sur le câble.</li>'
            '</ul>'
            '<p>La parade de base est <strong>la segmentation</strong> : découper le réseau en zones, '
            'et placer des pare-feu <em>entre</em> les zones. '
            'Le but n\'est pas d\'empêcher l\'attaque, mais d\'empêcher qu\'elle se propage : '
            'un serveur web compromis dans la zone « public » ne doit pas pouvoir joindre la base de données dans la zone « données ».</p>'
            '<p>Et si l\'attaquant est <em>déjà</em> dans le réseau ? C\'est le <strong>pivot</strong> : '
            'utiliser une machine compromise comme relais pour atteindre une zone qu\'on ne voit pas. '
            'Un vrai pare-feu qui bloque un trafic venant de l\'intérieur est donc indispensable : '
            'la zone publique ne parle jamais directement à la zone interne.</p>'
            '<p><strong>À retenir :</strong> la sécurité réseau ne se joue pas sur le câble, mais sur le <em>plan</em> : '
            'qui parle à qui, et avec quelle justification.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions sur ce que le réseau fait, et ce qu\'il ne fait pas.</p>',
        'practice': [
            {
                'q': 'Une machine du réseau public peut envoyer une requête directly au serveur de base de données. Quel est le défaut ?',
                'choices': [
                    'Aucun : c\'est normal, le réseau public est fait pour ça',
                    'La segmentation est incomplete : la zone publique ne devrait pas joindre la zone des données',
                    'Le serveur de base de données est trop lent',
                    'Le protocole TCP/IP est trop ancien',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'À quoi sert un pare-feu, s\'il est entre deux zones qui se parlent librement ?',
                'explain': 'Si le public joint directement les données, il n\'y a plus de séparation : la moindre faille sur le web donne accès aux données. La segmentation existe pour que ce chemin n\'existe pas.',
            },
            {
                'q': 'Pourquoi le chiffrement des protocoles modernes est-il fait « au-dessus » de TCP/IP plutôt que « dans » TCP/IP ?',
                'choices': [
                    'Parce que c\'est plus rapide',
                    'Parce que la sécurité doit venir de l\'application (TLS) et non d\'un transport qui ne connaît pas le contexte',
                    'Parce que TCP/IP est interdit en Europe',
                    'Parce que le routeur ne sait pas chiffrer',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le transport ignore ce qu\'il transporte : il ne peut pas savoir ce qui est secret.',
                'explain': 'Le transport déplace des octets, sans savoir ce qu\'ils signifient. La confidentialité doit donc être apportée par l\'application (TLS) ou par un tunnel (VPN), qui connaissent le sens des données.',
            },
        ],
        'mission_title': 'Task 3 : La mission — le plan de segmentation',
        'mission': {
            'prompt': (
                '<p>Dans la salle des cours, l\'équipe a laissé le <em>plan de segmentation</em> '
                'du réseau du laboratoire (le document qui décrit les zones et le pare-feu entre elles).</p>'
                '<p><strong>Mission.</strong> Lis ce plan et relève la <em>valeur du numéro de zone</em> '
                'attribuée à la zone des données sensibles (le champ <code>zone_id</code> de la zone la plus restreinte).</p>'
            ),
            'question': 'Releve le numero de zone (zone_id) de la zone des donnees sensibles dans le plan de segmentation.',
            'flag_path': '/root/flags/flag-u06.txt',
            'xp': 30,
            'hint': 'Le plan est dans <code>/srv/cours</code> : liste les dossiers, puis lis les fichiers de type « plan » ou « segmentation ».',
            'explain': 'Lire un plan de segmentation, c\'etit savoir où placer un pare-feu. Le numéro de zone permet de vérifier qu\'on parle de la bonne zone.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Quel est le rôle principal de la segmentation réseau ?',
                'choices': [
                    'Accélérer les échanges entre zones',
                    'Limiter la propagation d\'une compromission d\'une zone à l\'autre',
                    'Réduire le nombre de serveurs',
                    'Rendre le pare-feu inutile',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Pense au rôle du pare-feu « entre » les zones.',
                'explain': 'La segmentation ne vise pas à interdire tout, mais à <em>cloisonner</em> : une compromission doit rester dans sa zone. C\'est la différence entre un réseau plat et un réseau maîtrisé.',
            },
            {
                'q': 'Une machine compromise dans la zone « public » arrive à joindre la zone « interne ». Que faut-il en premier ?',
                'choices': [
                    'Changer tous les mots de passe',
                    'Rechercher où le chemin a étéPossible : règle de pare-feu, route, ou service exposé',
                    'Éteindre le serveur web',
                    'Installer un antivirus sur la machine compromise',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Un chemin possible est un chemin à refermer.',
                'explain': 'On cherche d\'où vient le passage : une règle trop large, un tunnel, un service qui écoute. Réparer la cause (le chemin) plutôt que traiter les symptômes (la machine compromise).',
            },
            {
                'q': 'Pourquoi un pare-feu bloque-t-il rarement le trafic venant de l\'intérieur ?',
                'choices': [
                    'Parce qu\'il ne sait pas faire',
                    'Parce que le trafic sortant est considéré comme légitime : c\'est l\'administration qu\'il faut limiter',
                    'Parce que le routeur bloque en amont',
                    'Parce que le pare-feu ne voit que le trafic entrant',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le pare-feu filtre le trafic qu\'il voit. Le trafic sortant est-il filtrable ?',
                'explain': 'Un pare-feu stateful voit le trafic dans les deux sens, mais il laisse sortir ce qui est « demandé ». La vraie parade au pivot est la segmentation + le contrôle des flux sortants.',
            },
            {
                'q': 'Un VPN relie deux sites distants. Quel risque nouveau introduit-il ?',
                'choices': [
                    'Aucun : il chiffre tout',
                    'Il crée un chemin entre les deux réseaux : une compromission peut se propager d\'un site à l\'autre',
                    'Il ralentit forcément toutes les communications',
                    'Il remplace la necessity d\'un pare-feu',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Un VPN relie deux zones. Qu\'est-ce qu\'il y a sur le pont ?',
                'explain': 'Un VPN est un tunnel : il rend joignables deux zones qui ne l\'étaient pas. Il faut donc appliquer entre elles les mêmes règles qu\'à l\'intérieur de chaque zone.',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'تقسيم الشبكة والعزل والدوران حولها',
                'excerpt': 'الشبكة لا تحمي وحدها: بدون تقسيم، باب واحد مفتوح يفتح المبنى كله.',
                'tasks': [
                    'المهمة 1: الدرس — التقسيم والدوران',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — مخطط التقسيم',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'Segmenting, isolating and pivoting: network security',
                'excerpt': 'A network does not protect on its own: without segmentation, one open door gives away the whole building.',
                'tasks': [
                    'Task 1: Lesson - segmentation and pivot',
                    'Task 2: Practice',
                    'Task 3: Mission - the segmentation plan',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
    {
        'title': 'TLS et HTTPS : le chiffrement qui tient la route',
        'excerpt': 'Ce que TLS négocie, ce qu\'il prouve, et pourquoi le cadenas du navigateur ne veut pas dire grand-chose.',
        'content': 'La leçon 14 de 6.858 : la négociation TLS, les certificats, et les limites du « HTTPS = sûr ».',
        'difficulty': 'moyen',
        'duration': 35,
        'xp_bonus': 45,
        'video': {
            'id': 'q1OF_0ICt9A',
            'title': '14. SSL and HTTPS',
            'channel': MIT,
            'institution': INST,
            'license': LIC,
            'duration': '1:18:18',
            'note': 'Cours vidéo de l\'université (MIT OpenCourseWare). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — ce que TLS garantit (et ce qu\'il ne garantit pas)',
        'lesson': (
            '<p>Quand tu te connectes en HTTPS, trois choses se jouent :</p>'
            '<ol>'
            '<li><strong>Le canal</strong> : le client et le serveur négocient un algorithme de chiffrement et une clé de session. '
            'Tout ce qui suit passe chiffré, et personne au milieu ne peut lire ni modifier.</li>'
            '<li><strong>L\'identité</strong> : le serveur présente un <strong>certificat</strong>, '
            'qui dit « je suis bien intranet.lab ». Le client le vérifie : signature de l\'autorité, date de validité, nom attendu.</li>'
            '<li><strong>La fraîcheur</strong> : un numéro unique par session évite qu\'on rejoue un ancien message.</li>'
            '</ol>'
            '<p>Le point dur, dans le cours, c\'est la <strong>chaîne de confiance</strong>. '
            'Le certificat n\'est pas signé par lui-même : il est signé par une autorité, qui est elle-même signée par une autre, '
            'jusqu\'à une racineoid <em>déjà</em> dans le navigateur. '
            'Si la racine est compromise, tout s\'effondre : c\'est le sujet des « autorites de certification » et de leurs incidents.</p>'
            '<p>Et les limites à retenir :</p>'
            '<ul>'
            '<li>HTTPS ne dit rien sur ce que le site <em>fait</em> de tes données une fois reçues.</li>'
            '<li>Un certificat valide ne dit pas que le site est honnête : il dit que quelqu\'un a payé pour ce nom.</li>'
            '<li>Le cadenas du navigateur garantit le chiffrement et l\'identité <em>technique</em>, pas la réputation.</li>'
            '</ul>'
            '<p><strong>À retenir :</strong> TLS protège le <em>tuyau</em>. Ce qui se passe à l\'autre bout du tuyau est l\'affaire de l\'application.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions sur ce que le cadenas garantit vraiment.</p>',
        'practice': [
            {
                'q': 'Un site affiche le cadenas du navigateur. Qu\'est-ce qui est garanti ?',
                'choices': [
                    'Que le site est honnête et ne collectera pas tes données',
                    'Que la connexion est chiffrée et que le nom du certificat correspond au site',
                    'Que le site n\'a jamais subi d\'attaque',
                    'Que le contenu de la page est exact',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Deux garanties, pas cinq.',
                'explain': 'Le cadenas couvre le canal (chiffrement) et l\'identité technique (le nom du certificat). Il ne dit rien du comportement du site une fois les données reçues.',
            },
            {
                'q': 'Pourquoi une autorité de certification compromise est-elle un problème majeur ?',
                'choices': [
                    'Parce qu\'elle devient lente',
                    'Parce qu\'elle peut signer des certificats pour n\'importe quel nom, et que les navigateurs font confiance à sa racine',
                    'Parce qu\'elle ne peut plus signer de certificats gratuits',
                    'Parce que les certificats expirent trop vite',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'La racine est déjà dans le navigateur : elle est donc acceptée sans discussion.',
                'explain': 'Toute la chaîne repose sur la racine. Si une autorité intermediate est compromise, elle peut obtenir des certificats valides pour des noms qu\'elle ne contrôle pas, et tous les navigateurs les accepteront.',
            },
        ],
        'mission_title': 'Task 3 : La mission — l\'audit du certificat',
        'mission': {
            'prompt': (
                '<p>Dans la salle des cours, un <em>audit TLS</em> a été laissé : le document qui décrit '
                'le certificat du service interne (version, algorithme, autorité de signature).</p>'
                '<p><strong>Mission.</strong> Lis cet audit et relève la <em>valeur de l\'algorithme de signature</em> '
                'annoncée pour le certificat (le champ <code>signature_algorithm</code>).</p>'
            ),
            'question': 'Releve l\'algorithme de signature du certificat, indique dans l\'audit TLS.',
            'flag_path': '/root/flags/flag-u07.txt',
            'xp': 30,
            'hint': 'L\'audit se trouve dans <code>/srv/cours</code>, dans le dossier du cours reseau.',
            'explain': 'Lire un audit TLS, c\'est savoir juger la qualité d\'un certificat : algorithme, taille de clé, durée de validité, autorité signataire.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Que négocie TLS au début de la connexion ?',
                'choices': [
                    'L\'algorithme de chiffrement et la clé de session',
                    'Le contenu de la page',
                    'Le mot de passe de l\'utilisateur',
                    'Le numéro de carte bancaire',
                ],
                'correct': 0,
                'xp': 10,
                'hint': 'C\'est l\'étape « handshake ».',
                'explain': 'Le handshake négocie la suite cryptographique et établit la clé de session. Les données applicatives ne suivent qu\'ensuite, chiffrées.',
            },
            {
                'q': 'Un certificat est signé par une autorité intermédiaire, elle-même signée par une racine. À quoi sert la racine ?',
                'choices': [
                    'À chiffrer le trafic',
                    'À être le point de confianceultimate : le navigateur lui fait confiance sans la vérifier à chaque connexion',
                    'À stocker les mots de passe',
                    'À choisir le prix du certificat',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'La racine est déjà dans le navigateur : qu\'est-ce que ça change ?',
                'explain': 'La racine est le point d\'ancrage de la confiance : elle est livrée avec le navigateur, donc acceptée d\'office. Toute la chaîne se vérifie par là.',
            },
            {
                'q': 'Un site est en HTTPS mais la page contient un script chargé en HTTP. Que se passe-t-il ?',
                'choices': [
                    'Rien : la page est en HTTPS, donc tout est protégé',
                    'Le script peut être intercepté et modifié : le mixed content casse la garantie sur cette partie',
                    'Le navigateur refuse d\'afficher la page',
                    'Le certificat est révoqué',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Toute la page n\'est pas forcément en HTTPS.',
                'explain': 'Le mixed content (une ressource en HTTP dans une page HTTPS) est bloqué par les navigateurs modernes, ou pire, exécuté en clair : la garantie ne couvre que le trafic HTTPS.',
            },
            {
                'q': 'Pourquoi la date de validité du certificat compte-t-elle ?',
                'choices': [
                    'Pour la facturation',
                    'Parce qu\'un certificat trop ancien peut signer desalgorithms aujourd\'hui consideres faibles, et qu\'il faut pouvoir le revoquer',
                    'Pour Savoir qui a achete le domaine',
                    'Parce que le navigateur ne supporte que les certificats de moins d\'un an',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Pense à la révocation et au changement des algorithmes.',
                'explain': 'La durée limite la fenêtre d\'exploitation d\'un algorithme ou d\'une clé devenu faible, et permet de révoquer un certificat compromis dans un délai borné.',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'TLS وHTTPS: التشفير الذي يصمد',
                'excerpt': 'ما الذي يتفاوضه TLS، وما الذي يثبته، ولماذا أيقونة القفل في المتصفح لا تعني الكثير.',
                'tasks': [
                    'المهمة 1: الدرس — ما الذي يضمنه TLS',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — تدقيق الشهادة',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'TLS and HTTPS: the encryption that holds up',
                'excerpt': 'What TLS negotiates, what it proves, and why the browser padlock does not mean much.',
                'tasks': [
                    'Task 1: Lesson - what TLS guarantees',
                    'Task 2: Practice',
                    'Task 3: Mission - the certificate audit',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
    {
        'title': 'S\'authentifier : mot de passe, session, second facteur',
        'excerpt': 'Comment on prouve qui on est, et pourquoi le mot de passe seul ne suffit plus.',
        'content': 'La leçon 17 de 6.858 : les mots de passe, les cookies de session, et les secondes preuves.',
        'difficulty': 'moyen',
        'duration': 35,
        'xp_bonus': 45,
        'video': {
            'id': 'MT7X17ZRo1U',
            'title': '17. User Authentication',
            'channel': MIT,
            'institution': INST,
            'license': LIC,
            'duration': '1:19:48',
            'note': 'Cours vidéo de l\'université (MIT OpenCourseWare). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — prouver qui on est',
        'lesson': (
            '<p>Un système d\'authentification répond à trois questions :</p>'
            '<ul>'
            '<li><strong>Que prouvez-vous ?</strong> Quelque chose que vous <em>savez</em> (mot de passe), '
            'que vous <em>avez</em> (carte, clé), ou que vous <em>êtes</em> (empreinte, visage).</li>'
            '<li><strong>À qui le prouvez-vous ?</strong> Le serveur, à travers un canal protégé ; '
            'sinon, votre mot de passe voyage en clair et peut être rejoué.</li>'
            '<li><strong>Et ensuite ?</strong> Le serveur crée une <strong>session</strong> : '
            'un identifiant aléatoire, difficulté à deviner, associé à un cookie protégé.</li>'
            '</ul>'
            '<p>La faiblesse historique est le mot de passe : court, réutilisé, transmis ou stocké mal. '
            'Les parades : <strong>longueur</strong> (une phrase de quatre mots bat un mot complicated), '
            '<strong>hachage avec sel</strong> (le sel est stocké à côté, il empêche que deux mots de passe identiques donnent le même résultat), '
            'et <strong>second facteur</strong> (un code à usage unique sur ton téléphone).</p>'
            '<p>Et surtout : la <strong>déconnexion</strong> et la <strong>session</strong>. '
            'Un cookie de session mal protégé (pas de HttpOnly, pas d\'expiration, jamais révoqué) est aussi grave '
            'qu\'un mot de passe faible : il ne se vole pas, il se copie.</p>'
            '<p><strong>À retenir :</strong> on n\'authentifie pas un mot de passe, on authentifie une <em>session</em>. '
            'Tout ce qui weakens la session (cookie non protégé, pas d\'expiration, pas de révocation) est un défaut d\'authentification.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions : le bon réflexe, et le maillon faible oublié.</p>',
        'practice': [
            {
                'q': 'Quel est le meilleur mot de passe selon les recommandations du cours ?',
                'choices': [
                    'Un mot complicated avec des chiffres et des symboles',
                    'Une phrase de plusieurs mots, longue et sans date ni nom personnel',
                    'Le même que partout, avec une majuscule ajoutée',
                    'Un mot tiré du dictionnaire, avec un chiffre à la fin',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Ce qui compte, c\'est la longueur et l\'imprévisibilité, pas la « complexité ».',
                'explain': 'Les recommendations actuelles privilégient la longueur : « chat bleu vraiment rapide » est plus fort et plus facile à retenir qu\'un « P@ssw0rd! ».',
            },
            {
                'q': 'Le site propose « se souvenir de moi » avec un jeton qui ne expire jamais et n\'est pas révocable. Quel est le problème ?',
                'choices': [
                    'Aucun, c\'est pratique',
                    'Un jeton volé reste utilisable indéfiniment : la session ne peut plus être retirée',
                    'Le jeton est trop court',
                    'Le navigateur refusera de le stocker',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Pense à ce que tu fais quand tu crois qu\'un compte a été volé.',
                'explain': 'La révocabilité est ce qui permet de couper l\'accès. Sans elle, « se déconnecter de tous les appareils » est impossible, et un jeton volé est un accès permanent.',
            },
        ],
        'mission_title': 'Task 3 : La mission — la politique d\'authentification',
        'mission': {
            'prompt': (
                '<p>Dans la salle des cours, la <em>politique d\'authentification</em> du service '
                '(le document qui fixe les règles : longueur minimale, nombre de tentatives, Second facteur).</p>'
                '<p><strong>Mission.</strong> Lis cette politique et relève la <em>valeur de la longueur minimale '
                'd\'un mot de passe</em> (champ <code>min_length</code>).</p>'
            ),
            'question': 'Releve la longueur minimale de mot de passe fixee par la politique d\'authentification.',
            'flag_path': '/root/flags/flag-u08.txt',
            'xp': 30,
            'hint': 'La politique est dans <code>/srv/cours</code>, dans le dossier du cours sur l\'authentification.',
            'explain': 'Lire une politique d\'authentification, c\'est savoir si un service est correctement réglé : longueur, tentatives,Second facteur, déblocage.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Pourquoi un mot de passe est-il salé avant d\'être haché ?',
                'choices': [
                    'Pour le rendre plus long',
                    'Pour que deux comptes avec le même mot de passe n\'aient pas la même empreinte, et pour que des tables précalculées ne servent à rien',
                    'Pour chiffrer la base de données',
                    'Pour que le mot de passe soit plus rapide à taper',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Que se passe-t-il si tout le monde a le même mot de passe ?',
                'explain': 'Le sel rend le calcul unique par compte : une table précalculée (arc-en-ciel) ne peut plus être appliquée d\'un coup à toute la base. C\'est aussi ce qui permet de changer d\'algorithme plus tard.',
            },
            {
                'q': 'Quel est le rôle du cookie de session ?',
                'choices': [
                    'Stocker le mot de passe en clair pour ne pas le redemander',
                    'Porter un identifiant de session aléatoire, difficile à deviner, qui remplace le mot de passe à chaque requête',
                    'Chiffrer la page pour le moteur de recherche',
                    'Empêcher lesARAM de se souvenir du site',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le mot de passe ne doit pas circuler à chaque requête.',
                'explain': 'Le cookie ne contient qu\'un identifiant aléatoire, non devinable, associé côté serveur à la session. Voler le cookie, c\'etit voler la session : d\'où l\'importance de HttpOnly et Secure.',
            },
            {
                'q': 'Un second facteur « ce que tu sais » (un code PIN) est-il vraiment un second facteur ?',
                'choices': [
                    'Oui, c\'est une information supplémentaire',
                    'Non : un second facteur doit être d\'une autre nature que le mot de passe, sinon un vol du mot de passe suffit',
                    'Oui, mais seulement s\'il est long',
                    'Non, parce que les PIN sont interdits',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Les trois facteurs : ce que vous savez, ce que vous avez, ce que vous êtes.',
                'explain': 'Le second facteur doit venir d\'une autre catégorie : ce que vous <em>avez</em> (téléphone) ou ce que vous <em>êtes</em> (biométrie). Un PIN reste « ce que vous savez ».',
            },
            {
                'q': 'Que doit faire un serveur quand il reçoit trop de tentatives de connexion ?',
                'choices': [
                    'Bloquer définitivement le compte sans prévenir l\'utilisateur',
                    'Ralentir ou bloquer temporairement les tentatives, et prévenir l\'utilisateur',
                    'Ne rien faire : le limitation est du ressort de l\'utilisateur',
                    'Envoyer le mot de passe en clair pour vérifier',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Pense à la fois à l\'attaque et à l\'utilisateur légitime.',
                'explain': 'Limiter les tentatives freine le bourrage d\'identifiants ; bloquer le compte sans prévenir punit l\'utilisateur légitime (et devient un déni de service gratuit).',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'المصادقة: كلمة المرور والجلسة والعامل الثاني',
                'excerpt': 'كيف نثبت أنك أنت، ولماذا لا تكفي كلمة المرور وحدها.',
                'tasks': [
                    'المهمة 1: الدرس — إثبات الهوية',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — سياسة المصادقة',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'Authenticating: password, session, second factor',
                'excerpt': 'How we prove who you are, and why a password alone is no longer enough.',
                'tasks': [
                    'Task 1: Lesson - proving identity',
                    'Task 2: Practice',
                    'Task 3: Mission - the authentication policy',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
    {
        'title': 'Cryptographie : clé, chiffrement, signature',
        'excerpt': 'Les trois briques de la cryptographie moderne, et la question qui décide de tout : à qui faites-vous confiance ?',
        'content': 'La leçon 10 du cours 6.042 de Ron Rivest, qui pose les bases du cours 6.857.',
        'difficulty': 'difficile',
        'duration': 40,
        'xp_bonus': 55,
        'video': {
            'id': 'hRDOmMEZtPo',
            'title': 'Lecture 10: Cryptography',
            'channel': MIT,
            'institution': 'MIT - 6.042 Mathematics for Computer Science (R. Rivest)',
            'license': LIC,
            'duration': '1:21:09',
            'note': 'Cours vidéo de l\'université (MIT OpenCourseWare). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — les trois briques',
        'lesson': (
            '<p>Ron Rivest commence par une question simple : <strong>à qui fais-tu confiance ?</strong> '
            'Toute la cryptographie moderne découle de cette réponse.</p>'
            '<ol>'
            '<li><strong>Le chiffrement symétrique</strong> (une clé pour chiffrer et déchiffrer : AES). '
            'Rapide, solide, mais les deux parties doivent partager la clé : comment l\'échanger sans laonyaoyer ? '
            'C\'est le problème de la distribution des clés.</li>'
            '<li><strong>Le chiffrement asymétrique</strong> (deux clés liées : une publique, une privée : RSA, courbes elliptiques). '
            'La clé publique peut circuler à la main, sur un canal non sécurisé : c\'est elle qui résout le problème de la distribution. '
            'Plus lent, donc réservé aux clés et aux signatures.</li>'
            '<li><strong>La signature numérique</strong> : on signe avec sa clé privée, on vérifie avec la clé publique. '
            'Elle prouve <em>l\'origine</em> et <em>l\'intégrité</em> du message — pas sa secret.</li>'
            '</ol>'
            '<p>Et le <strong>hachage</strong> : une empreinte courte et à sens unique. '
            'Elle vérifie qu\'un fichier n\'a pas changé (c\'est l\'empreinte numérique du cours), '
            'et sert de base aux mots de passe (avec sel) et aux signatures.</p>'
            '<p><strong>À retenir :</strong> le chiffrement cache, la signature prouve. '
            'Confondre les deux, c\'est la erreur classique de l\'exercice.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions : à quoi sert chaque brique, et à qui l\'on fait confiance.</p>',
        'practice': [
            {
                'q': 'Pourquoi utilise-t-on du chiffrement asymétrique pour échanger une clé de session ?',
                'choices': [
                    'Parce qu\'il est plus rapide',
                    'Parce que sa clé publique peut circuler sans secret, résolvant le problème de la distribution des clés',
                    'Parce que le chiffrement symétrique est interdit',
                    'Parce que la clé publique est plus courte',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le problème à résoudre est la distribution, pas la vitesse.',
                'explain': 'Le symétrique est rapide mais exige un canal sûr pour la clé. L\'asymétrique, lent, sert à protéger cette clé : le canal n\'a plus besoin d\'être secret.',
            },
            {
                'q': 'Un message signé est-il chiffré ?',
                'choices': [
                    'Oui, signer revient à chiffrer avec la clé privée',
                    'Non : la signature prouve l\'origine et l\'intégrité, le contenu reste lisible par tous',
                    'Oui, sauf si la clé est ancienne',
                    'Cela dépend du serveur',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Que fait la signature, et que ne fait-elle pas ?',
                'explain': 'La signature ne cache rien : elle prouve qui a produit le message et qu\'il n\'a pas été modifié. C\'est le chiffrement qui cache.',
            },
        ],
        'mission_title': 'Task 3 : La mission — le carnet de cryptographie',
        'mission': {
            'prompt': (
                '<p>Dans la salle des cours, le cours 6.042 a laissé son <em>carnet de cryptographie</em> '
                '(le document qui présente les trois briques avec leurs algorithmes).</p>'
                '<p><strong>Mission.</strong> Lis ce carnet et relève la <em>valeur de la taille de clé</em> '
                'utilisée par l\'exemple de chiffrement symétrique (champ <code>key_size</code>, en bits).</p>'
            ),
            'question': 'Releve la taille de cle (key_size, en bits) indiquee dans le carnet de cryptographie.',
            'flag_path': '/root/flags/flag-u09.txt',
            'xp': 30,
            'hint': 'Le carnet est dans <code>/srv/cours</code>, dossier du cours de cryptographie.',
            'explain': 'Connaître la taille de clé d\'un exemple, c\'et understand ce que « fort » veut dire : la sécurité repose sur le temps de calcul, pas sur le secret de l\'algorithme.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Qu\'est-ce qu\'un hachage « à sens unique » ?',
                'choices': [
                    'Un chiffrement qu\'on ne peut déchiffrer que dans un sens',
                    'Une fonction qu\'on ne peut pas inverser : retrouver l\'original à partir de l\'empreinte est calculellement impossible',
                    'Un chiffrement dont la clé est aléatoire',
                    'Une empreinte qui change à chaque exécution',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'On peut calculer l\'empreinte dans un sens ; l\'autre est hors de portée.',
                'explain': 'Le hachage est déterministe (même entrée, même empreinte) mais non inversible en pratique. C\'est ce qui permet de vérifier l\'intégrité sans garder le secret.',
            },
            {
                'q': 'Que prouve une signature numérique ?',
                'choices': [
                    'Que le message est secret',
                    'Que le message provient du détenteur de la clé privée et qu\'il n\'a pas été modifié',
                    'Que le destinataire est de bonne foi',
                    'Que le message a été envoyé par le réseau',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Deux garanties, pas une.',
                'explain': 'La signature couvre l\'<em>origine</em> (authentification) et l\'<em>intégrité</em>. Elle ne dit rien du secret ni de la honesty du destinataire.',
            },
            {
                'q': 'Pourquoi ne fait-on pas confiance aux algorithmes secrets ?',
                'choices': [
                    'Parce qu\'ils sont plus lents',
                    'Parce qu\'un algorithme secret ne peut être étudié : or la sécurité repose sur le fait que tout le monde peut vérifier qu\'il résiste',
                    'Parce que la loi l\'interdit',
                    'Parce qu\'ils ne marchent qu\'avec des clés courtes',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Kerckhoffs : la sécurité ne doit pas reposer sur le secret du système.',
                'explain': 'Le principe de Kerckhoffs : le secret, c\'est la clé ; l\'algorithme doit être public et auditable. Un algorithme secret cache forcément des faiblesses.',
            },
            {
                'q': 'Un service utilise du chiffrement symétrique avec la même clé pour tous les clients. Quel est le défaut ?',
                'choices': [
                    'C\'est le plus efficace',
                    'La compromission d\'une clé expose tous les clients, et il faut un canal sûr pour la distribuer',
                    'C\'est trop lent pour Internet',
                    'Les clients ne peuvent plus communiquer entre eux',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Pense à ce que devient la clé si elle sort une seule fois.',
                'explain': 'Une clé par session évite qu\'une fuite unique compromette tout le monde, et l\'asymétrique peut protéger l\'échange de cette clé de session.',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'التشفير: المفتاح والتعمية والتوقيع',
                'excerpt': 'اللبنات الثلاث للتشفير الحديث، والسؤال الذي يحدد كل شيء: بمن تثق؟',
                'tasks': [
                    'المهمة 1: الدرس — اللبنات الثلاث',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — دفتر التشفير',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'Cryptography: key, encryption, signature',
                'excerpt': 'The three building blocks of modern cryptography, and the question that decides everything: who do you trust?',
                'tasks': [
                    'Task 1: Lesson - the three building blocks',
                    'Task 2: Practice',
                    'Task 3: Mission - the cryptography notebook',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
]
