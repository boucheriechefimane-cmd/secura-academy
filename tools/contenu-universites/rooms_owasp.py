# -*- coding: utf-8 -*-
"""OWASP : trois rooms (Top 10, validation des entrees, journaux et audit).

Sources : OWASP Foundation, OWASP Top 10 (A09:2021), Cristi Vlad.
Textes originaux.
"""

ROOMS = [
    {
        'title': 'Le Top 10 OWASP et la surface d\'attaque',
        'excerpt': 'La liste que tout le monde cite, et ce qu\'elle sert vraiment : classer les risques, pas les faucilles.',
        'content': 'La vidéo de la fondation OWASP : pourquoi une liste de dix risques guides mieux qu\'un catalogue de failles.',
        'difficulty': 'facile',
        'duration': 30,
        'xp_bonus': 40,
        'video': {
            'id': 'nq-Igdk0o7s',
            'title': 'The How and Why of the OWASP Top Ten 2021 - Brian Glas',
            'channel': 'OWASP Foundation',
            'institution': 'OWASP Foundation',
            'license': 'Usage pedagogique avec attribution (OWASP Foundation)',
            'duration': '49:37',
            'note': 'Vidéo de la fondation OWASP. Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — une liste de risques, pas un catalogue',
        'lesson': (
            '<p>Le <strong>Top 10 OWASP</strong> est la liste des dix risques les plus présents dans les applications web. '
            'Elle estrevisionnée tous les ans, parce que le web change : les failles de navigateur ont reculé, '
            'les failles de logique et de configuration sont remontées.</p>'
            '<p>Deux idées à retenir de la vidéo de la fondation :</p>'
            '<ul>'
            '<li><strong>Une liste, c\'est un outil de priorisation.</strong> On ne peut pas corriger les dix mille problèmes '
            'd\'une application : on regarde d\'abord ce qui est dans la liste, parce que ce sont les risques '
            'que l\'on retrouve partout.</li>'
            '<li><strong>Les risques sont des catégories, pas des failles précises.</strong> '
            '« Injection » n\'est pas « mon application est injectable » : c\'est « mon application reçoit des données '
            'et les concatène dans une requête ». La catégorie sert à <?>penser, la faille exacte se trouve par le test.</li>'
            '</ul>'
            '<p>Et la notion de <strong>surface d\'attaque</strong> : tout ce que l\'application accepte du monde extérieur '
            '(formulaires, URL, en-têtes, fichiers, websockets). '
            'Plus la surface est large, plus il y a de chemins à tester. '
            'Réduire la surface (supprimer une vieille API, un port inutile, un module oublié) est une '
            'défense <em>gratuite</em>, avant même d\'écrire une ligne de code de sécurité.</p>'
            '<p>Les entrées de la version 2021 qu\'on rencontre le plus : '
            'contrôle d\'accès cassé, erreur cryptographique, injection, '
            'conception non sécurisée, misconfiguration, composants vulnérables, '
            'authentification défaillante, défaut d\'intégrité des données, '
            'journalisation et surveillance insuffisantes, et gestion d\'erreurs excessive.</p>'
            '<p><strong>À retenir :</strong> la liste ne sert pas à dire « on est protégé parce qu\'on a lu le Top 10 ». '
            'Elle sert à dire « voici par où commencer, et voici les questions à se poser ».</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions sur l\'usage de la liste et la surface d\'attaque.</p>',
        'practice': [
            {
                'q': 'Pourquoi la liste est-elle révisée régulièrement ?',
                'choices': [
                    'Parce que les éditeurs changent leurs règles',
                    'Parce que le web évolue : les risques qui reviennent le plus souvent changent',
                    'Parce que les laws change',
                    'Pour publier plus de pages',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Pense aux failles de navigateur, qui ont reculé.',
                'explain': 'La révision permet de refléter la réalité du terrain : les pratiques d\'hygiène s\'améliorent, donc d\'autres risques remontent. C\'est une photographie, pas un dogme.',
            },
            {
                'q': 'Une application expose une API de statistiques oubliée depuis 2019, sans authentification. De quoi s\'agit-il ?',
                'choices': [
                    'D\'un problème de mise à jour du système',
                    'D\'une surface d\'attaque inutile : la fermer réduit les chemins possibles sans écrire de code',
                    'D\'une bonne pratique d\'architecture',
                    'D\'un problème de nommage',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Chaque point d\'entrée est un chemin que quelqu\'un peut tester.',
                'explain': 'Chaque interface accessible est une porte possible. Réduire la surface (supprimer, restreindre, filtrer au reverse-proxy) est une action immédiate, à coût quasi nul, qui réduit le nombre de chemins à tester.',
            },
        ],
        'mission_title': 'Task 3 : La mission — le classement interne',
        'mission': {
            'prompt': (
                '<p>Dans la salle des cours, l\'équipe a laissé son <em>classement interne</em> '
                'des risques (la façon dont l\'équipe a priorisé ses corrections, en suivant le Top 10).</p>'
                '<p><strong>Mission.</strong> Lis ce classement et relève la <em>valeur du rang</em> '
                'attribué au premier risque corrigé (champ <code>top_risk</code>).</p>'
            ),
            'question': 'Releve le rang du premier risque corrige (top_risk) dans le classement interne des risques.',
            'flag_path': '/root/flags/flag-u18.txt',
            'xp': 30,
            'hint': 'Le classement est dans <code>/srv/cours/owasp</code>.',
            'explain': 'Prioriser, c\'est savoir par quoi commencer. Le classement d\'une équipe dit beaucoup sur sa maturité : on corrige d\'abord ce qui est le plus fréquent et le plus grave.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'À quoi sert concrètement le Top 10 OWASP ?',
                'choices': [
                    'À garantir qu\'une application est sûre',
                    'À prioriser les corrections et à donner un vocabulaire commun pour en parler',
                    'À remplacer les tests de sécurité',
                    'À fixer le prix d\'une application',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Personne n\'est sûr avec une liste.',
                'explain': 'La liste donne un ordre de bataille et un langage commun (dire « injection » et « contrôle d\'accès cassé » permet de désigner précisément un problème et de le suivre).',
            },
            {
                'q': 'Un contrôle d\'accès cassé, c\'est... ?',
                'choices': [
                    'Un pare-feu mal configuré',
                    'Le fait qu\'un utilisateur accède à une donnée ou à une fonction qui ne lui est pas destinée',
                    'Un mot de passe trop court',
                    'Un certificat expiré',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'C\'est la première entrée du Top 10 2021.',
                'explain': 'Le contrôle d\'accès cassé est le risque n°1 de 2021 : l\'utilisateur accède à ce qu\'il ne devrait pas voir. C\'est souvent une simple absence de vérification côté serveur : « l\'interface ne montre pas le bouton, donc personne ne peut le faire » n\'est pas une protection.',
            },
            {
                'q': 'Pourquoi réduire la surface d\'attaque est-il considéré comme une mesure de sécurité ?',
                'choices': [
                    'Parce que ça rend le site plus joli',
                    'Parce que chaque point d\'entrée retiré est un chemin d\'attaque que l\'on n\'a plus à surveiller ni tester',
                    'Parce que les routeurs le demandent',
                    'Parce que ça réduit le nombre d\'employés',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Moins de portes, moins de clés à garder.',
                'explain': 'La surface d\'attaque est l\'ensemble des entrées accessible. La réduire (API inutile, port ouvert, module obsolète) supprime des chemins avant même d\'avoir à les sécuriser — c\'est la parade la moins chère.',
            },
            {
                'q': 'Une erreur de gestion des erreurs qui affiche une trace JavaScript complète dans le navigateur. Quel risque ?',
                'choices': [
                    'Aucun : c\'est utile pour le débogage',
                    'L\'exposition d\'informations internes (chemins, versions, requêtes) qui facilite les attaques suivantes',
                    'Le site ne fonctionnera plus',
                    'La page ne sera pas indexée',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Que révèle une trace d\'erreur ?',
                'explain': 'Les messages d\'erreur détaillés sont une fuite d\'information : versions, chemins, structure de la base, parfois identifiants de connexion. En production, on journalise côté serveur et on affiche un message neutre.',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'أفضل 10 مخاطر من OWASP وسطح الهجوم',
                'excerpt': 'القائمة التي يشير إليها الجميع، وما فائدتها الحقيقية: ترتيب المخاطر لا عدّ الثغرات.',
                'tasks': [
                    'المهمة 1: الدرس — قائمة مخاطر لا كتالوج ثغرات',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — الترتيب الداخلي',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'The OWASP Top 10 and the attack surface',
                'excerpt': 'The list everyone quotes, and what it is really for: ranking risks, not counting vulnerabilities.',
                'tasks': [
                    'Task 1: Lesson - a list of risks, not a catalogue',
                    'Task 2: Practice',
                    'Task 3: Mission - the internal ranking',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
    {
        'title': 'Valider les entrées : le premier remède anti-injection',
        'excerpt': 'Ne jamais faire confiance à ce qui vient du monde extérieur : la règle qui élimine la moitié des failles web.',
        'content': 'La démonstration de Cristi Vlad sur l\'OWASP Juice Shop : tester la validation des entrées sur une vraie application vulnérable.',
        'difficulty': 'moyen',
        'duration': 35,
        'xp_bonus': 45,
        'video': {
            'id': 'EA8-GuMZykg',
            'title': 'Real World Application Security - How to Test with OWASP [Input Validation]',
            'channel': 'Cristi Vlad',
            'institution': 'OWASP (chapitre Presedint)',
            'license': 'Usage pedagogique avec attribution (Cristi Vlad)',
            'duration': '12:08',
            'note': 'Vidéo de Cristi Vlad (chapitre OWASP). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — valider, escaping, requêtes préparées',
        'lesson': (
            '<p>Trois notions à ne pas confondre, et qui règlent l\'essentiel des injections :</p>'
            '<ul>'
            '<li><strong>La validation</strong> : vérifier que la donnée est du bon <em>type</em> et dans le bon <em>domaine</em>. '
            '« 42 » pour un âge, « AAA-BBB-123 » pour un code postal, « 10/03/2026 » pour une date. '
            'Si la donnée n\'est pas conforme, on la refuse — et c\'est fini.</li>'
            '<li><strong>L\'échappement</strong> (ou <em>encoding</em>) : transformer les caractères spéciaux '
            'pour qu\'ils soient du texte et non du code. C\'est indispensable pour tout ce qui est affiché dans du HTML, '
            'du JavaScript, une URL ou une commande shell.</li>'
            '<li><strong>Les requêtes préparées</strong> (<em>prepared statements</em>) : '
            'c\'est LA parade pour les injections SQL. '
            'La requête et les données sont envoyées séparément : la base ne peut pas confondre '
            '« la donnée » et « la commande ».</li>'
            '</ul>'
            '<p>Et ce qui ne marche pas : <strong>échapper à la main</strong>, filtrer une liste de mots interdits '
            '(<code>OR</code>, <code>DROP</code>...), ou compter sur le front-end. '
            'Un filtre de mots se contourne en écrivant autrement ; '
            'une validation uniquement dans le navigateur est contournée par une simple requête HTTP.</p>'
            '<p>La règle d\'or, celle que la vidéo répète : '
            '<strong>« Ne jamais construire une commande ou une requête avec des données venues d\'ailleurs. »</strong> '
            'Si on ne peut pas utiliser de requête préparée, on échappe avec la fonction de la bibliothèque, '
            'jamais à la main.</p>'
            '<p>Et la même logique s\'applique au-delà du SQL : '
            'une commande shell construite par concaténation est une injection de commande ; '
            'un lien construit avec une donnée non échappée est une injection XSS.</p>'
            '<p><strong>À retenir :</strong> la validation, c\'est le bouclier ; l\'échappement, c\'est la Knee ; '
            'la requête préparée, c\'est le blindage. On utilise les trois.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions : la bonne parade, et le faux remède.</p>',
        'practice': [
            {
                'q': 'Quel est l\'avantage décisif d\'une requête préparée face à l\'injection SQL ?',
                'choices': [
                    'Elle est plus rapide à exécuter',
                    'La requête et les données sont envoyées séparément : la base ne peut plus interpréter la donnée comme du code',
                    'Elle supprime le besoin de valider les entrées',
                    'Elle chiffre la base de données',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Pense à la frontière entre « commande » et « donnée ».',
                'explain': 'La requête préparée fait respected la frontière : le paramètre est une valeur, jamais une portion de SQL. C\'est la parade structurelle, là où l\'échappement reste une technique.',
            },
            {
                'q': 'Un développeur filtre les mots « SELECT », « DROP » et « UNION » dans les champs de formulaire. Quel est le problème ?',
                'choices': [
                    'Aucun : c\'est une filtre efficace',
                    'La liste est infinie : on peut écrire la même chose autrement (commentaires, encodages, autres mots-clés)',
                    'C\'est trop lent pour un site moderne',
                    'Le navigateur refuse ce filtrage',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'On peut écrire « SELECT » autrement.',
                'explain': 'Le filtrage par mots-clés est un jeu sans fin : variantes d\'écriture, autres commandes, techniques d\'évasion. La parade sérieuse est structurelle (requête préparée) ou contextuelle (échappement adapté au contexte de sortie).',
            },
        ],
        'mission_title': 'Task 3 : La mission — la règle de validation',
        'mission': {
            'prompt': (
                '<p>Dans la salle des cours, le TP de validation des entrées a laissé sa '
                '<em>règle de validation</em> (la fiche des contrôles faits sur le formulaire).</p>'
                '<p><strong>Mission.</strong> Lis cette fiche et relève la <em>valeur du nombre de contrôles</em> '
                'listés pour le champ « code postal » (champ <code>zip_checks</code>).</p>'
            ),
            'question': 'Releve le nombre de controles (zip_checks) listes pour le champ code postal dans la fiche de validation.',
            'flag_path': '/root/flags/flag-u19.txt',
            'xp': 30,
            'hint': 'La fiche de validation est dans <code>/srv/cours/owasp</code>.',
            'explain': 'Compter les contrôles d\'un champ, c\'est mesurer la rigueur de la validation : chaque contrôle est une condition à écrire dans le code.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Quelle est la différence entre validation et échappement ?',
                'choices': [
                    'C\'est la même chose',
                    'La validation vérifie le type et le domaine de la donnée ; l\'échappement rend les caractères sûrs pour un contexte de sortie donné',
                    'La validation est côté client, l\'échappement côté serveur',
                    'L\'échappement est plus récent',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'L\'un refuse une donnée, l\'autre transforme ce qui reste.',
                'explain': 'La validation dit « cette valeur n\'est pas acceptable » ; l\'échappement dit « cette valeur est acceptable mais je la rends inerte pour cet usage ». Les deux sont complémentaires.',
            },
            {
                'q': 'Un champ « quantité » doit contenir un nombre entre 1 et 99. Quel est le bon contrôle ?',
                'choices': [
                    'Un <code>strip_tags()</code> sur la saisie',
                    'Vérifier que la saisie est un entier et qu\'il est dans l\'intervalle, sinon la refuser',
                    'Échapper la saisie avec <code>htmlspecialchars</code>',
                    'Limiter la longueur du champ à 3 caractères',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le contrôle doit correspondre au domaine annoncé.',
                'explain': 'Échapper ne transforme pas « 12; DROP TABLE » en nombre : la validation doit vérifier le type (entier) et le domaine (1..99). L\'échappement, lui, s\'applique à l\'affichage.',
            },
            {
                'q': 'Pourquoi la validation côté navigateur ne protège-t-elle pas l\'application ?',
                'choices': [
                    'Parce que les navigateurs sont anciens',
                    'Parce que l\'attaquant n\'a pas besoin du navigateur : il peut envoyer directement la requête HTTP',
                    'Parce que le JavaScript est désactivé',
                    'Parce que le clavier est en QWERTY',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Pense à l\'outil qui envoie la requête.',
                'explain': 'Le navigateur est un client comme un autre : on peut écrire la requête à la main (curl) ou avec un script. Toute règle de sécurité doit être appliquée côté serveur.',
            },
            {
                'q': 'Tu construis une commande shell pour traiter un nom de fichier uploadé. Quelle est la bonne approche ?',
                'choices': [
                    'Échapper le nom avec une fonction maison',
                    'Vérifier le nom (liste blanche de caractères autorisés, pas de caractère spécial) et l\'utiliser comme un seul argument',
                    'Le mettre entre guillemets et hopeful',
                    'L\'encoder en base64 avant de l\'utiliser',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le shell interprète certains caractères : espaces, points-virgules, tubes.',
                'explain': 'Un nom de fichier contenant un espace ou un « ; » change la commande. On valide le format (liste blanche) et on s\'assure que le nom reste un seul argument. Les fonctions de type <code>escapeshellarg</code> existent aussi : le principe est de ne jamais concaténer.',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'التحقق من المدخلات: أول علاج ضد الحقن',
                'excerpt': 'لا تثق أبدًا بما يأتي من الخارج: القاعدة التي تزيل نصف ثغرات الويب.',
                'tasks': [
                    'المهمة 1: الدرس — التحقق والترميز والاستعلامات المجهزة',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — قاعدة التحقق',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'Validating input: the first anti-injection remedy',
                'excerpt': 'Never trust what comes from outside: the rule that removes half of the web vulnerabilities.',
                'tasks': [
                    'Task 1: Lesson - validation, escaping, prepared statements',
                    'Task 2: Practice',
                    'Task 3: Mission - the validation rule',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
    {
        'title': 'Journaux et audit : la trace qui vaut de l\'or',
        'excerpt': 'Sans trace, pas d\'enquête : ce qu\'il faut logger, et ce qu\'il ne faut surtout pas logger.',
        'content': 'La vidéo OWASP sur les défaillances de journalisation (A09:2021) : ce qu\'un journal doit permettre de reconstituer.',
        'difficulty': 'moyen',
        'duration': 30,
        'xp_bonus': 40,
        'video': {
            'id': 'ODpooAzCuwM',
            'title': 'Security Logging and Monitoring Failures Explained | OWASP A09:2021',
            'channel': 'AppSecDojo',
            'institution': 'OWASP Top 10 (A09:2021)',
            'license': 'Usage pedagogique avec attribution (AppSecDojo)',
            'duration': '1:01',
            'note': 'Vidéo de la communauté OWASP. Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — journaliser, alerter, protéger',
        'lesson': (
            '<p>Un journal, c\'est la mémoire du système. Sans lui, un incident est un roman : '
            '« ça a dû arriver à quelqu\'un, mais je ne sais ni quand ni comment ». '
            'Avec lui, on peut reconstituer la chronologie et répondre aux trois questions '
            'que pose toujours un jury après un incident : <strong>que s\'est-il passé, '
            'est-ce que ça s\'est reproduit, est-ce qu\'on a été prévenu</strong>.</p>'
            '<p>Ce qu\'un journal doit contenir :</p>'
            '<ul>'
            '<li><strong>Qui</strong> : le compte concerné (et l\'adresse IP si elle est fiable).</li>'
            '<li><strong>Quoi</strong> : l\'action tentée (connexion, changement de mot de passe, export, refus).</li>'
            '<li><strong>Quand</strong> : l\'horodatage précis, avec fuseau.</li>'
            '<li><strong>Résultat</strong> : succès ou échec, et le code d\'erreur.</li>'
            '<li><strong>Origine</strong> : l\'IP, le user-agent, l\'identifiant de session.</li>'
            '</ul>'
            '<p>Et les <strong>deux pièges</strong> que la vidéo souligne :</p>'
            '<ol>'
            '<li><strong>Logger trop</strong> : journaliser les mots de passe, les numéros de carte, '
            'les jetons de session ou les données personnelles. '
            'Un journal devient alors une base de données sensible — et il faut le protéger comme telle '
            '(accès restreint, durée de conservation limitée).</li>'
            '<li><strong>Logger trop peu</strong> : ne pas journaliser les échecs d\'authentification, '
            'les changements de privilèges, les accès aux données sensibles. '
            'Sans ces traces, on ne voit pas la préparation d\'une attaque.</li>'
            '</ol>'
            '<p>Et la partie qu\'on oublie souvent : <strong>alerter</strong>. '
            'Un journal que personne ne surveille n\'a servi à rien. '
            'Une règle simple : un journal doit déclencher une alerte quand il contient un motif rare et grave '
            '(rafale d\'échecs, changement de permissions, export massif).</p>'
            '<p><strong>À retenir :</strong> le journal n\'est pas une trace technique, c\'est une pièce d\'enquête. '
            'Il doit êtrehorodaté, protégé, et lu.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions : quoi logger, quoi ne pas logger.</p>',
        'practice': [
            {
                'q': 'Quel élément ne doit JAMAIS être écrit dans un journal ?',
                'choices': [
                    'L\'horodatage',
                    'Le mot de passe ou le jeton de session en clair',
                    'L\'adresse IP de origem',
                    'Le résultat de l\'opération',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le journal doit permettre de reconstituer une action, pas de rejouer une authentification.',
                'explain': 'Un journal qui contient un mot de passe ou un jeton est une bombe : quiconque y accède prend le compte. On journalise l\'événement (« authentification réussie pour l\'utilisateur X »), jamais le secret.',
            },
            {
                'q': 'Pourquoi est-il important de journaliser les échecs d\'authentification ?',
                'choices': [
                    'Pour pouvoir bloquer définitivement les comptes',
                    'Parce qu\'une rafale d\'échecs est un signal d\'attaque : c\'est souvent la première alerte',
                    'Parce que le serveur l\'exige',
                    'Pour compter les utilisateurs actifs',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Ce qui n\'a pas réussi laisse une trace, et cette trace arrive souvent en premier.',
                'explain': 'L\'échec est le signal le plus précoce d\'une attaque par force brute. S\'il n\'est pas journalisé (ou pas surveillé), on l\'apprend en même temps que la compromission : trop tard.',
            },
        ],
        'mission_title': 'Task 3 : La mission — le plan de journalisation',
        'mission': {
            'prompt': (
                '<p>Dans la salle des cours, l\'équipe a laissé son <em>plan de journalisation</em> '
                '(la liste des événements à journaliser).</p>'
                '<p><strong>Mission.</strong> Lis ce plan et relève la <em>valeur du nombre d\'événements</em> '
                'prévus au journal (champ <code>event_count</code>).</p>'
            ),
            'question': 'Releve le nombre d\'evenements (event_count) prevus au journal dans le plan de journalisation.',
            'flag_path': '/root/flags/flag-u20.txt',
            'xp': 30,
            'hint': 'Le plan est dans <code>/srv/cours/owasp</code>.',
            'explain': 'Compter les événements à journaliser, c\'est mesurer si l\'on pourra reconstituer une journée d\'activité. Un plan court est un plan qui laisse des angles morts.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Quelles informations sont indispensables dans une ligne de journal de sécurité ?',
                'choices': [
                    'Le message d\'erreur complet',
                    'Qui, quoi, quand, quel résultat, depuis quelle origine',
                    'Le numéro de version du serveur',
                    'La couleur du terminal',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Cinq éléments : les cinq questions d\'une enquête.',
                'explain': 'Sans ces cinq éléments, la ligne ne permet pas de reconstituer l\'action : qui a fait quoi, quand, avec quel résultat, depuis où. Le message d\'erreur est utile mais secondaire.',
            },
            {
                'q': 'Un journal contient le mot de passe en clair « parce qu\'on en a besoin pour le support ». Que faut-il en penser ?',
                'choices': [
                    'C\'est acceptable si le journal est bien protégé',
                    'C\'est un risque majeur : le journal devient une base de secrets, avec une durée de vie plus longue que l\'incident',
                    'C\'est la bonne pratique',
                    'C\'est uniquement interdit en Europe',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Compare la durée de vie du journal à celle du mot de passe.',
                'explain': 'Un mot de passe dans un journal survit au changement de mot de passe : le journal est souvent conservé des mois, lu par des équipes nombreuses. La bonne pratique est de journaliser l\'événement, jamais le secret.',
            },
            {
                'q': 'Un journal est bien alimenté, mais personne ne le lit. Quel est le défaut ?',
                'choices': [
                    'Aucun : l\'écriture suffit',
                    'La surveillance fait partie du dispositif : sans alerte, le journal ne sert qu\'après l\'incident',
                    'Le journal est trop volumineux',
                    'Il faut écrire un deuxième journal',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le but du journal, c\'est l\'alerte, pas l\'archive.',
                'explain': 'Un journal surveillé permet d\'agir pendant l\'attaque ; un journal non surveillé sert d\'archive après coup. D\'où l\'importance des règles d\'alerte sur les événements rares et graves.',
            },
            {
                'q': 'Quel événement est le plus utile à journaliser pour détecter une compromission en cours ?',
                'choices': [
                    'L\'arrivée d\'un visiteur sur la page d\'accueil',
                    'Un changement de privilège ou de permissions',
                    'La taille d\'une image',
                    'Le chargement d\'une feuille de style',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Cherche l\'événement rare et grave, pas le bruit quotidien.',
                'explain': 'Les changements de privilèges (un compte qui devient administrateur, un accès à un fichier sensible) sont rares et graves : ce sont eux qui méritent une alerte. Le reste est du bruit.',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'السجلات والتدقيق: الأثر الذي يستحق ذهبًا',
                'excerpt': 'بلا أثر لا تحقيق: ما الذي يجب تسجيله، وما الذي يجب ألا يُسجَّل أبدًا.',
                'tasks': [
                    'المهمة 1: الدرس — التسجيل والتنبيه والحماية',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — مخطط التسجيل',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'Logs and audit: the trail worth gold',
                'excerpt': 'Without a trail, no investigation: what must be logged, and what must never be.',
                'tasks': [
                    'Task 1: Lesson - logging, alerting, protecting',
                    'Task 2: Practice',
                    'Task 3: Mission - the logging plan',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
]
