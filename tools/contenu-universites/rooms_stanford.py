# -*- coding: utf-8 -*-
"""Stanford - Engineering Everywhere : deux rooms.

Source : Stanford, cours CS105 / CS106A (Engineering Everywhere, CC BY-NC-SA 4.0).
Textes originaux.
"""

CH = 'Stanford'
LIC = 'CC BY-NC-SA 4.0 - Stanford Engineering Everywhere'
INST = 'Stanford - Engineering Everywhere (SEE)'

ROOMS = [
    {
        'title': 'Comment marche un ordinateur : de la donnée au programme',
        'excerpt': 'Des bits aux instructions : ce qui se passe vraiment entre le clavier et le résultat affiché.',
        'content': 'La première leçon de Stanford (CS105, \"Introduction to Computers\") : comment une machine transforme des données en programme.',
        'difficulty': 'facile',
        'duration': 30,
        'xp_bonus': 40,
        'video': {
            'id': 'KkMDCCdjyW8',
            'title': 'Lecture 1 | Programming Methodology (Stanford)',
            'channel': CH,
            'institution': INST,
            'license': LIC,
            'duration': '49:47',
            'note': 'Cours vidéo de l\'université (Stanford). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — de la donnée au programme',
        'lesson': (
            '<p>Un ordinateur ne « comprend » rien : il exécute des instructions, dans l\'ordre, '
            'a une vitesse folle et sans jamais se lasser. Tout le reste est de l\'organisation.</p>'
            '<p>Le trajet d\'un programme, en quatre couches :</p>'
            '<ol>'
            '<li><strong>Les données</strong> : tout est nombre binaire. Un caractère est un nombre, '
            'une image est un tableau de nombres, un son est une suite d\'échantillons. '
            'La seule unité de la machine, c\'est le bit.</li>'
            '<li><strong>La mémoire</strong> : une longue suite d\'octets, numérotés. '
            'Chaque case porte une <em>adresse</em>. '
            'Une variable, c\'est un nom donné à une adresse : le programme manipule des noms, la machine manipule des adresses.</li>'
            '<li><strong>L\'instruction</strong> : une opération élémentaire (charger, ajouter, stocker, sauter). '
            'Un programme, c\'est une longue suite de ces instructions.</li>'
            '<li><strong>Le cycle</strong> : le processeur prend l\'instruction à l\'adresse pointée par le compteur, '
            'l\'exécute, passe à la suivante. Rien d\'autre. '
            'C\'est là que se glissent les notions de sécurité : '
            'qui contrôle le compteur de programme, et que se passe-t-il quand on lui fait sauter ailleurs ?</li>'
            '</ol>'
            '<p>La notion de <strong>langage de haut niveau</strong> vient ensuite : '
            'on écrit <code>x = 5 + 3</code>, le compilateur traduit en instructions, '
            'l\'assembleur les traduit en codes machines, et le processeur les exécute. '
            'Chaque couche ajoute du confort… et parfois des erreurs (les famous <em>buffer overflow</em> '
            'viennent de ce que la couche C ne protège pas la mémoire).</p>'
            '<p><strong>À retenir :</strong> l\'ordinateur est une machine à instructions qui manipule des '
            'adresses. Toute la sécurité repose sur le contrôle de ces trois choses : '
            'les données, les adresses, et le compteur de programme.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions : ce que la machine fait, et ce que le langage cache.</p>',
        'practice': [
            {
                'q': 'Que fait réellement un processeur ?',
                'choices': [
                    'Il comprend le programme et l\'exécute selon le sens',
                    'Il lit des instructions, les exécute une par une, et passe à la suivante',
                    'Il compile le code source',
                    'Il stocke les données sur le disque',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le processeur ne connaît ni le sens, ni les intentions : il suit un compteur.',
                'explain': 'Le processeur exécute un flux d\'instructions piloté par un compteur de programme. Toute la sécurité des systèmes repose sur le contrôle de ce compteur — d\'où l\'intérêt des defenses comme le canari ou le NX.',
            },
            {
                'q': 'Pourquoi dit-on que le langage C est « proche de la machine » ?',
                'choices': [
                    'Parce qu\'il est plus rapide que tous les autres langages',
                    'Parce qu\'il laisse le programmeur gérer la mémoire : il n\'y a ni garbage collector ni vérification automatique des bornes',
                    'Parce qu\'il a été écrit en assembleur',
                    'Parce qu\'il n\'a pas de fonctions',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Ce n\'est pas une question de vitesse, c\'est une question de garanties.',
                'explain': 'En C, la gestion de la mémoire est à la charge du programmeur : c\'est une puissance (performance, contrôle) et un risque (dépassements, use-after-free). C\'est exactement ce que les labs pwn.college exploitent.',
            },
        ],
        'mission_title': 'Task 3 : La mission — le schéma de la machine',
        'mission': {
            'prompt': (
                '<p>Dans la salle des cours, le cours de Stanford a laissé son '
                '<em>schéma de la machine</em> (le document qui décrit les couches, de la donnée au processeur).</p>'
                '<p><strong>Mission.</strong> Lis ce schéma et relève la <em>valeur du nombre d\'octets</em> '
                'attribués à une adresse (champ <code>address_size</code>).</p>'
            ),
            'question': 'Releve la taille d\'adresse (address_size, en octets) indiquee dans le schema de la machine.',
            'flag_path': '/root/flags/flag-u21.txt',
            'xp': 30,
            'hint': 'Le schéma est dans <code>/srv/cours/stanford</code>.',
            'explain': 'La taille d\'une adresse détermine l\'espace mémoire adressable (2^64 octets en 64 bits). C\'est aussi ce qui rend les adresses «(devinables » sans ASLR : d\'où l\'importance de l\'aléatoire.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Qu\'est-ce qu\'une adresse mémoire ?',
                'choices': [
                    'Le contenu d\'une case mémoire',
                    'Un numéro qui désigne une case mémoire',
                    'Le nom d\'une variable dans le code',
                    'La taille d\'un programme',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'C\'est ce qui permet d\'accéder à une case sans ambiguïté.',
                'explain': 'L\'adresse est le numéro d\'accès à une case. Le nom de variable n\'est qu\'une traduction faite par le compilateur : au niveau machine, il n\'y a que des numéros.',
            },
            {
                'q': 'À quoi correspond le « compteur de programme » ?',
                'choices': [
                    'Au nombre de lignes du programme',
                    'À l\'adresse de la prochaine instruction à exécuter',
                    'À la taille de la mémoire utilisée',
                    'Au temps d\'exécution cumulé',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'C\'est lui qui décide où le programme va ensuite.',
                'explain': 'Le compteur de programme indique l\'instruction suivante. Il est incrémenté après chaque instruction, sauf si une instruction de saut le modifie : d\'où l\'importance de l\'adresse de retour dans la pile.',
            },
            {
                'q': 'Que se passe-t-il quand un programme est compilé ?',
                'choices': [
                    'Il est copié sur le disque',
                    'Il est traduit en instructions, puis en codes machines que le processeur peut exécuter',
                    'Il est exécuté immédiatement pour vérifier qu\'il marche',
                    'Il est chiffré',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le compilateur produit une nouvelle forme du programme.',
                'explain': 'Chaîne de compilation : source → code machine → exécution. L\'optimiseur joue sur le code intermédiaire, pas sur les algorithmes : la sémantique doit rester la même.',
            },
            {
                'q': 'Pourquoi un « garbage collector » rend-il-il l\'exploitation plus difficile ?',
                'choices': [
                    'Parce qu\'il ralentit tout',
                    'Parce qu\'il gère la mémoire à la place du programmeur : il n\'y a ni use-after-free ni double freeing exploitable de la même façon',
                    'Parce qu\'il interdit les pointeurs',
                    'Parce qu\'il rend le code illisible',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le problème de la gestion manuelle de la mémoire, c\'est qu\'elle se trompe.',
                'explain': 'En C, le programmeur libère la mémoire : une double libération ou un accès après libération est une faille exploitable classique. Un ramasse-miettes automatique supprime cette famille de bugs — c\'est l\'argument des langages à mémoire sûre (que le cours 6.858 mentionne en fin de parcours).',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'كيف يعمل الحاسوب: من البيانات إلى البرنامج',
                'excerpt': 'من البتات إلى التعليمات: ما يحدث فعلًا بين لوحة المفاتيح والنتيجة المعروضة.',
                'tasks': [
                    'المهمة 1: الدرس — من البيانات إلى البرنامج',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — مخطط الآلة',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'How a computer works: from data to program',
                'excerpt': 'From bits to instructions: what really happens between the keyboard and the result on screen.',
                'tasks': [
                    'Task 1: Lesson - from data to program',
                    'Task 2: Practice',
                    'Task 3: Mission - the machine diagram',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
    {
        'title': 'Données et systèmes : organiser l\'information',
        'excerpt': 'Des fichiers aux bases de données : comment on range l\'information, et pourquoi le rangement est une question de sécurité.',
        'content': 'La deuxième leçon de Stanford (CS105) : comment l\'information est structurée, stockée, et recherchée.',
        'difficulty': 'facile',
        'duration': 30,
        'xp_bonus': 40,
        'video': {
            'id': '0LoKDDRlfZc',
            'title': 'Lecture 2 | Programming Methodology (Stanford)',
            'channel': CH,
            'institution': INST,
            'license': LIC,
            'duration': '48:20',
            'note': 'Cours vidéo de l\'université (Stanford). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — ranger, chercher, séparer',
        'lesson': (
            '<p>Toute l\'informatique tient dans une phrase : <strong>ranger l\'information pour la retrouver</strong>. '
            'Le web, un jeu, un site de commerce : ce sont des données rangées et relues.</p>'
            '<p>Les paliers du rangement :</p>'
            '<ul>'
            '<li><strong>Le fichier</strong> : un bloc d\'octets nommé. Simple, mais pour trouver une information, '
            'il faut tout lire. C\'est le cas d\'un <em>log</em> : on le lit à la fin pour savoir ce qui s\'est passé.</li>'
            '<li><strong>La table (base de données)</strong> : des lignes et des colonnes typées, avec des index. '
            'L\'index, c\'est le « sommaire » : il permet de trouver une ligne sans tout parcourir. '
            'C\'est un compromis : de la place en plus, du temps gagné.</li>'
            '<li><strong>La requête</strong> : on ne lit plus les données, on pose une question. '
            '« Donne-moi les commandes du client X après le 3 mars ». '
            'C\'est le langage SQL, et c\'est aussi le point d\'entrée classique des injections.</li>'
            '</ul>'
            '<p>Et la notion de <strong>séparation des responsabilités</strong> : '
            'données, code applicatif, configuration, journaux. '
            'Les mélanger est la cause numéro un des fuites : '
            'un mot de passe écrit dans le code, une clé de chiffrement dans un fichier servi au public, '
            'un journal dans le même répertoire que les données.</p>'
            '<p>Pour la sécurité, deux règles tirees de cette organisation :</p>'
            '<ol>'
            '<li><strong>Un accès, un besoin</strong> : le service web lit les données, il ne modifie pas le schéma. '
            'Un compte de service distinct pour la lecture, un autre pour l\'écriture : '
            'c\'est la version « données » de la séparation des privilèges.</li>'
            '<li><strong>Le secret ne vit pas à côté des données</strong> : il vit dans un endroit protégé, '
            'avec un accès mesuré et une durée de vie limitée.</li>'
            '</ol>'
            '<p><strong>À retenir :</strong> la sécurité des données commence par leur rangement. '
            'Qui peut lire, qui peut écrire, et où sont les secrets : trois questions à se poser avant tout.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions : ranger correctement, et séparer les responsabilités.</p>',
        'practice': [
            {
                'q': 'Pourquoi une base de données utilise-t-elle des index ?',
                'choices': [
                    'Pour chiffrer les données',
                    'Pour retrouver une ligne rapidement sans parcourir toute la table',
                    'Pour compressor le fichier',
                    'Pour obliger à utiliser des requêtes préparées',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Pense au sommaire d\'un livre.',
                'explain': 'L\'index est un sommaire : il accélère la recherche au prix de la place occupée et du coût de maintenance. C\'est aussi un élément à surveiller : un index mal choisi peut ralentir les écritures.',
            },
            {
                'q': 'Un site place le fichier de configuration (avec la clé de chiffrement) dans le dossier public du site. Quel est le risque ?',
                'choices': [
                    'Aucun : le fichier est protégé par son nom',
                    'Quiconque peut le télécharger : le secret est public, et la clé de chiffrement ne protège plus rien',
                    'Le site devient plus lent',
                    'La base de données est vidée',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Dossier public = dossier téléchargeable.',
                'explain': 'C\'est l\'erreur classique de rangement : un secret à côté du contenu public. La règle : le secret vit dans un emplacement protégé, hors de ce qui est servi, avec un accès mesuré.',
            },
        ],
        'mission_title': 'Task 3 : La mission — le plan de rangement',
        'mission': {
            'prompt': (
                '<p>Dans la salle des cours, le cours de Stanford a laissé son '
                '<em>plan de rangement</em> (la façon dont l\'équipe range ses données et ses secrets).</p>'
                '<p><strong>Mission.</strong> Lis ce plan et relève la <em>valeur du nombre d\'emplacements</em> '
                'prévus pour les secrets (champ <code>secret_locations</code>).</p>'
            ),
            'question': 'Releve le nombre d\'emplacements (secret_locations) prevus pour les secrets dans le plan de rangement.',
            'flag_path': '/root/flags/flag-u22.txt',
            'xp': 30,
            'hint': 'Le plan de rangement est dans <code>/srv/cours/stanford</code>.',
            'explain': 'Compter les emplacements de secrets, c\'est vérifier qu\'aucun d\'eux n\'a été oublié dans la zone publique : chaque emplacement doit avoir son propre contrôle d\'accès.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Quel est l\'avantage d\'une base de données sur un simple fichier texte ?',
                'choices': [
                    'Elle est plus petite',
                    'Elle permet de poser des questions (requêtes) sur les données et de les retrouver sans tout parcourir',
                    'Elle est plus sécurisée par nature',
                    'Elle n\'a pas besoin de mots de passe',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Pense à « demander » au lieu de « chercher ».',
                'explain': 'La base de données ne rend pas les données sûres : elle rend la <em>recherche</em> efficace. La sécurité vient des droits, pas du moteur.',
            },
            {
                'q': 'Pourquoi le compte de service qui lit les données ne doit-il pas pouvoir modifier le schéma ?',
                'choices': [
                    'Pour que le site soit plus rapide',
                    'Pour limiter les dégâts : une injection SQL ne pourra pas modifier la structure ni supprimer les tables',
                    'Parce que SQLite l\'interdit',
                    'Pour que les sauvegardes soient plus petites',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'C\'est le principe du moindre privilège, appliqué aux données.',
                'explain': 'Un compte en lecture seule ne peut pas faire de dégâts structurels : même si l\'injection passe, elle se limite à lire. C\'est une barrière de sécurité classique et peu coûteuse.',
            },
            {
                'q': 'Que signifie la séparation des responsabilités appliquée aux données ?',
                'choices': [
                    'Chaque service a sa propre base de données',
                    'Les données, la configuration, les secrets et les journaux sont stockés à des endroits différents, avec des accès distincts',
                    'Chaque développeur travaille sur sa propre copie',
                    'Les requêtes sont écrites dans des fichiers séparés',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Pense à ce qui doit être public, privé et secret.',
                'explain': 'La séparation, c\'est ranger ce qui n\'a pas le même niveau de sensibilité dans des endroits différents : contenu public, données privées, secrets protégés, journaux techniques. Chaque zone a son contrôle d\'accès.',
            },
            {
                'q': 'Une requête SQL constructed en concatenant une saisie utilisateur, même avec un échappement manuel, reste risquée. Pourquoi ?',
                'choices': [
                    'Parce que SQL est un langage lent',
                    'Parce que l\'échappement manuel est fragile : chaque type de données a ses règles, et une règle oubliée rouvre la faille',
                    'Parce que le moteur refuse les requêtes longues',
                    'Parce que les index se déclenchent',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'L\'échappement à la main, c\'est une suite de règles à ne pas oublier.',
                'explain': 'La requête préparée déplace la sécurité dans le moteur : la frontière entre code et donnée est garantie par construction. L\'échappement manuel, lui, dépend de l\'attention du développeur et du contexte (chaîne, nombre, identifiant, date).',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'البيانات والأنظمة: تنظيم المعلومات',
                'excerpt': 'من الملفات إلى قواعد البيانات: كيف نرتّب المعلومات، ولماذا التنظيم مسألة أمنية.',
                'tasks': [
                    'المهمة 1: الدرس — الترتيب والبحث والفصل',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — مخطط الترتيب',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'Data and systems: organising information',
                'excerpt': 'From files to databases: how information is arranged, and why arranging it is a security matter.',
                'tasks': [
                    'Task 1: Lesson - storing, searching, separating',
                    'Task 2: Practice',
                    'Task 3: Mission - the storage plan',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
]
