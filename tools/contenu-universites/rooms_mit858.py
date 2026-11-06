# -*- coding: utf-8 -*-
"""MIT 6.858 - Computer Systems Security (Fall 2014) : cinq rooms.

Source : MIT OpenCourseWare (CC BY-NC-SA 4.0). Les textes des rooms sont
originaux ; la video est le cours du professeur, avec attribution.
"""

MIT = 'MIT OpenCourseWare'
LIC = 'CC BY-NC-SA 4.0 - MIT OpenCourseWare'
INST858 = 'MIT - 6.858 Computer Systems Security (Fall 2014)'

ROOMS = [
    {
        'title': 'Menaces, vulnérabilités et modèle de menace',
        'excerpt': 'Avant de défendre quoi que ce soit, on décrit l\'attaque : ce que l\'adversaire veut, ce qu\'il peut faire, et ce qu\'on protège.',
        'content': 'Première leçon de 6.858 : la sécurité se raisonne à partir d\'un modèle de menace, pas à partir d\'une liste de failles.',
        'difficulty': 'facile',
        'duration': 30,
        'xp_bonus': 40,
        'video': {
            'id': 'GqmQg-cszw4',
            'title': '1. Introduction, Threat Models',
            'channel': MIT,
            'institution': INST858,
            'license': LIC,
            'duration': '1:17:13',
            'note': 'Cours vidéo de l\'université (MIT OpenCourseWare). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — le modèle de menace',
        'lesson': (
            '<p>Une <strong>menace</strong>, c\'est une <em>possibilité</em> qu\'une règle soit enfreinte. '
            'Une <strong>vulnérabilité</strong>, c\'est une faiblesse <em>réelle</em> qui rend cette possibilité plausible. '
            'Un <strong>modèle de menace</strong>, c\'est la phrase qui relie les deux : « si notre adversaire peut faire '
            'X, alors notre règle Y est en danger ».</p>'
            '<p>Trois questions suffisent à le poser :</p>'
            '<ul>'
            '<li><strong>Qu\'est-ce que je protège ?</strong> Une donnée, un service, une réputation. Sans ça, pas de priorité.</li>'
            '<li><strong>Qui est l\'adversaire ?</strong> Un script kiddie ? Un concurrent ? Un État ? Un employé mécontent ? '
            'Le modèle est plus prudent que l\'adversaire réel, sinon on se protège du mauvais côté.</li>'
            '<li><strong>De quoi est-il capable ?</strong> Lecture du réseau ? Exécution de code chez toi ? Tromper un humain ?</li>'
            '</ul>'
            '<p>Et la <strong>politique de sécurité</strong> : la règle que tu veux faire respecter. '
            '« Seul le service de facturation lit le dossier client. » '
            'Un <strong>mécanisme</strong> est ce qui la fait appliquer : une ACL, un chiffrement, un filtre de requêtes. '
            'Un mécanisme ne vaut que si l\'hypothèse du modèle de menace tient : '
            '<em>« tant que l\'adversaire respecte les règles du jeu, la politique est respectée »</em>.</p>'
            '<p><strong>À retenir :</strong> on ne chiffre pas « tout ». On protège ce qui a le plus de valeur, contre ce qui est le plus probable.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Trois questions pour fixer le vocabulaire avant la mission.</p>',
        'practice': [
            {
                'q': 'Dans la phrase « un pirate peut envoyer des requêtes forgées au service de facturation », qu\'est-ce qui est la menace et qu\'est-ce qui est la vulnérabilité ?',
                'choices': [
                    'La menace est le pirate ; la vulnérabilité est la requête forgée',
                    'La menace est la requête forgée ; la vulnérabilité est le pirate',
                    'La menace et la vulnérabilité sont la même chose',
                    'Il n\'y a pas de vulnérabilité : une requête forgée est normale',
                ],
                'correct': 0,
                'xp': 10,
                'hint': 'La menace, c\'est un scénario ; la vulnérabilité, c\'est une faiblesse technique qui rend le scénario possible.',
                'explain': 'Le pirate est l\'adversaire, pas la menace. La menace est le scénario (« il envoie des requêtes forgées ») ; la vulnérabilité est la faiblesse technique qui rend ce scénario possible (le service ne vérifie pas l\'origine de la requête).',
            },
            {
                'q': 'Un pare-feu bloque toutes les requêtes venant de l\'Internet. Quelle propriété ta politique peut-elle encore garantir ?',
                'choices': [
                    'La confidentialité des données clients',
                    'L\'intégrité des données, même face à un administrateur malveillant',
                    'L\'intégrité et la disponibilité du service, car le pare-feu est infranchissable',
                    'Rien : sans tester le système, aucune propriété ne peut être garantie',
                ],
                'correct': 3,
                'xp': 10,
                'hint': 'Un mécanisme ne prouve rien tout seul : il faut savoir quelles hypothèses il repose.',
                'explain': 'Le pare-feu est un mécanisme, pas une preuve. Tant qu\'on n\'a pas énuméré le modèle de menace (adversaire interne ? vulnérabilité applicative ?), on ne peut pas affirmer que la politique est respectée. C\'est tout le message de la leçon : la sécurité se démontre, elle ne se suppose pas.',
            },
            {
                'q': 'Tu as une base de données de 2 To de photos et un serveur web de 10 Go. Lequel protéger en premier ?',
                'choices': [
                    'Le serveur web : c\'est ce que les clients touchent en premier',
                    'La base de photos : elle est plus volumineuse, donc plus importante',
                    'Celui qui contient la donnée la plus difficile à récupérer',
                    'Les deux à parts égales, sinon ce n\'est pas sérieux',
                ],
                'correct': 2,
                'xp': 10,
                'hint': 'Pense au coût de la perte : que se passe-t-il si la donnée disparaît et ne peut pas revenir ?',
                'explain': 'La priorité vient du <em>coût de la perte</em>, pas du volume. Une photo ratée se refait ; une base clients irrécupérable est un drame. Le volume n\'est pas un critère de sécurité, c\'est un critère de stockage.',
            },
        ],
        'mission_title': 'Task 3 : La mission — l\'analyse de risque',
        'mission': {
            'prompt': (
                '<p>Sur la machine de la salle des cours, l\'équipe a laissé les livrables du semestre. Dans <code>/srv/cours/mit858</code>, le document <code>analyse-risque.md</code> liste les actifs, les adversaires possibles et les règles à faire respecter.</p><p><strong>Mission.</strong> Le drapeau de cette room est l\'<em>empreinte du document</em>, pas une phrase qu\'il contient : les huit premiers caractères du sha256 de ce fichier. Une empreinte ne se lit pas, elle se calcule — c\'est la preuve que tu as ouvert le bon fichier.</p>\'<p>Exécute <code>sha256sum</code> sur le document, puis garde les huit premiers caractères.</p>'
            ),
            'question': 'Calcule l\'empreinte (sha256, 8 premiers caracteres) du document analyse-risque.md du cours 6.858.',
            'flag_path': '/root/flags/flag-u01.txt',
            'xp': 30,
            'hint': 'La commande : <code>sha256sum /srv/cours/mit858/analyse-risque.md</code>, puis <code>cut -c1-8</code> sur la sortie. Vérifie d\'abord le nom exact du fichier avec <code>ls</code>.',
            'explain': 'Une empreinte prouve deux choses d\'un coup : que tu as lu le bon fichier, et qu\'il n\'a pas changé depuis. C\'est exactement ce qu\'un auditeur fait pour vérifier une pièce : il ne croit pas le contenu, il vérifie le sceau.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Quel est le rôle exact d\'un « mécanisme de sécurité » ?',
                'choices': [
                    'Garantir à lui seul que la politique est respectée',
                    'Faire appliquer la politique, tant que les hypothèses du modèle de menace sont vraies',
                    'Remplacer le modèle de menace, qui devient inutile',
                    'Documenter les décisions prises pour l\'équipe',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Un mécanisme agit « tant que » une condition est vraie. Laquelle ?',
                'explain': 'La phrase clé du cours : le mécanisme fait respecter la politique <em>tant que l\'adversaire respecte le modèle de menace</em>. Si le modèle est faux, le mécanisme ne protège plus.',
            },
            {
                'q': 'Ton service doit être accessible depuis chez les élèves, mais seulement les enseignants doivent pouvoir changer les paramètres. Quelle politique ?',
                'choices': [
                    'Tout le monde peut changer les paramètres, c\'est plus simple',
                    'Seuls les enseignants peuvent changer les paramètres ; tous les élèves peuvent utiliser le service',
                    'Les élèves accèdent au service par le réseau interne uniquement',
                    'Le service n\'est accessible qu\'aux enseignants',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Deux actions, deux populations : relis la question, elle en contient deux.',
                'explain': 'Une politique s\'écrit en principals × actions × objets : « les élèves peuvent utiliser le service ; seuls les enseignants peuvent le reconfigurer ». C\'est le module 1 de 6.858 (menaces) et 6.857 (politiques) qui pose ce cadre.',
            },
            {
                'q': 'Un service tourne avec les droits root alors qu\'il n\'a besoin que de lire un fichier. Que vaut-il faire ?',
                'choices': [
                    'Laisser tel quel : root marche toujours',
                    'Retirer les droits superflus : c\'est la séparation des privilèges',
                    'Ajouter un second service root pour la redondance',
                    'Désinstaller le service et le remplacer par un script maison',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'C\'est la leçon 4 du cours : « Privilege Separation ».',
                'explain': 'Retirer les droits superflus, c\'est appliquer le principe du moindre privilège : si le service est compromis, l\'attaquant n\'obtient qu\'un compte sans privilège. La leçon 4 du cours en fait un principe à part entière.',
            },
            {
                'q': 'Un pare-feu bloque 100 % des requêtes externes, mais l\'application a une injection SQL. Que conclure ?',
                'choices': [
                    'Le système est sûr : le pare-feu bloque tout',
                    'Le système est sûr tant que personne n\'essaie',
                    'Le mécanisme ne couvre pas la menace : il reste une vulnérabilité applicative',
                    'Il faut remplacer le pare-feu par un antivirus',
                ],
                'correct': 2,
                'xp': 10,
                'hint': 'Un mécanisme ne couvre que les menaces qu\'il a été conçu pour couvrir.',
                'explain': 'Le pare-feu traite la menace « venue du réseau ». L\'injection SQL est une menace « venue de l\'intérieur de la requête » : aucun pare-feu ne la couvre. C\'est la différence entre un mécanisme et une garantie.',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'التهديدات والثغرات ونموذج التهديد',
                'excerpt': 'قبل الدفاع عن أي شيء، صف الهجوم: ماذا يريد الخصم، وما يستطيع فعله، وما الذي تحميه.',
                'tasks': [
                    'المهمة 1: الدرس — نموذج التهديد',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — تحليل المخاطر',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'Threats, vulnerabilities and the threat model',
                'excerpt': 'Before defending anything, describe the attack: what the adversary wants, what they can do, and what you protect.',
                'tasks': [
                    'Task 1: Lesson - the threat model',
                    'Task 2: Practice',
                    'Task 3: Mission - the risk analysis',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
    {
        'title': 'Débordement de tampon : l\'attaque et les défenses',
        'excerpt': 'Ce qui se passe quand un programme écrit plus loin que sa case, et pourquoi les canaris, ASLR et le NX ont changé la donne.',
        'content': 'La leçon 3 de 6.858 : le débordement de tampon, puis les quatre défenses qui protègent aujourd\'hui la plupart des programmes.',
        'difficulty': 'moyen',
        'duration': 40,
        'xp_bonus': 50,
        'video': {
            'id': 'xSQxaie_h1o',
            'title': '3. Buffer Overflow Exploits and Defenses',
            'channel': MIT,
            'institution': INST858,
            'license': LIC,
            'duration': '1:21:38',
            'note': 'Cours vidéo de l\'université (MIT OpenCourseWare). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — le débordement et ses quatre garde-fous',
        'lesson': (
            '<p>Un programme C alloue un <em>buffer</em> de 64 octets sur la pile et y copie une chaîne sans vérifier sa longueur. '
            'L\'excédent déborde et écrase l\'<strong>adresse de retour</strong> : à la sortie de la fonction, le programme '
            'reprend la main <em>où l\'attaquant le décide</em>. Deux conditions suffisent à l\'exploitation : '
            '<strong>prendre le contrôle</strong> du compteur de programme, puis <strong>exécuter</strong> ce qu\'on a déposé.</p>'
            '<p>Les quatre défenses classiques, dans l\'ordre où elles sont apparues :</p>'
            '<ul>'
            '<li><strong>Éviter le bug</strong> : écrire du code qui vérifie les tailles. Efficace, mais cela repose sur l\'human : un seul oubli, et c\'est fini.</li>'
            '<li><strong>Le canari (stack canary)</strong> : une valeur secrète posée entre les variables locales et l\'adresse de retour. '
            'Si elle est modifiée, le programme s\'arrête avant de revenir. Elle ne bloque pas l\'écriture, elle détecte la corruption.</li>'
            '<li><strong>ASLR</strong> : les adresses changent à chaque lancement, donc l\'attaquant ne sait plus où viser. '
            'Un canari + ASLR, c\'est déjà très cher à contourner.</li>'
            '<li><strong>NX (No-eXecute)</strong> : la pile n\'est plus exécutable, on ne peut pas y déposer du code. '
            'Il faut alors rebondir sur du code déjà présent : c\'est le <em>ROP</em>, que tu verras chez pwn.college.</li>'
            '</ul>'
            '<p><strong>À retenir :</strong> une défense n\'est pas une muraille, c\'est un <em>obstacle</em>. On empile les obstacles ; l\'attaquant cherche le chemin le moins cher, pas le chemin impossible.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions : ce que chaque défense fait vraiment, et ce qu\'elle ne fait pas.</p>',
        'practice': [
            {
                'q': 'Un programme déborde et écrase l\'adresse de retour. Que se passe-t-il au canari ?',
                'choices': [
                    'Il bloque l\'écriture : le programme refuse de déborder',
                    'Il n\'est pas touché : il protège la pile entière',
                    'Il est écrasé lui aussi, et le programme le remarque au retour et s\'arrête',
                    'Il est chiffré, donc l\'attaquant ne peut pas le lire',
                ],
                'correct': 2,
                'xp': 10,
                'hint': 'Le canari est-il en amont ou en aval de l\'adresse de retour ?',
                'explain': 'Le canari ne prévient pas l\'écriture : il <em>détecte</em> la corruption. Placé entre les variables locales et l\'adresse de retour, il est écrasé en même temps que celle-ci ; au retour, la valeur est comparée et le programme s\'arrête. L\'ASLR, lui, change l\'adresse visée.',
            },
            {
                'q': 'Le programme est compilé avec ASLR, NX et un canari. Quelle attaque reste possible ?',
                'choices': [
                    'Aucune : les trois défense_rules rendent l\'exploitation impossible',
                    'L\'injection SQL sur la base de l\'application',
                    'Le ROP : rebondir sur des morceaux de code existants',
                    'La capture du trafic réseau en clair',
                ],
                'correct': 2,
                'xp': 10,
                'hint': 'NX interdit d\'exécuter la pile. Alors comment exécuter du code ?',
                'explain': 'NX rend la pile non exécutable, donc l\'attaquant ne dépose plus de shellcode : il enchaîne des « gadgets » déjà présents dans le programme (ROP). C\'est plus technique, pas impossible — et c\'est exactement le sujet des rooms pwn.college.',
            },
        ],
        'mission_title': 'Task 3 : La mission — le binaire vulnérable',
        'mission': {
            'prompt': (
                '<p>Dans la salle des cours, un TP de 6.858 a été préparé : le programme <code>vuln</code> '
                'et son <em>readme</em>. Le readme contient le résultat de l\'analyse du binaire '
                '(la taille du buffer, la fonction atteinte, l\'offset).</p>'
                '<p><strong>Mission.</strong> Lis le readme du TP et relève la <em>valeur d\'offset</em> '
                'qu\'il annonce (le nombre d\'octets nécessaires pour atteindre l\'adresse de retour). '
                'C\'est la preuve que tu as compris l\'exploit avant de l\'écrire.</p>'
            ),
            'question': 'Releve la valeur d\'offset annoncee dans le readme du TP sur le binaire vulnerable.',
            'flag_path': '/root/flags/flag-u02.txt',
            'xp': 30,
            'hint': 'Le TP est dans <code>/opt/labs</code> : commence par <code>ls /opt/labs</code> puis lis le fichier README.',
            'explain': 'L\'offset est le nombre d\'octets entre le début du buffer et l\'adresse de retour. Le calculer, c\'est comprendre pourquoi le canari fonctionne et où il se trouve.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Quel est le but exact d\'ASLR ?',
                'choices': [
                    'Chiffrer la mémoire du programme',
                    'Déplacer les zones de mémoire à chaque exécution pour viser à l\'aveugle',
                    'Empêcher le programme d\'écrire hors du buffer',
                    'Vérifier que le binaire n\'a pas été modifié',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'ASLR = Address Space Layout Randomization.',
                'explain': 'ASLR randomise les adresses : l\'attaquant doit donc deviner où se trouve l\'adresse de retour. Il ne l\'empêche pas d\'écrire : il rend la cible imprévisible.',
            },
            {
                'q': 'Pourquoi le NX rend-il nécessaire le ROP ?',
                'choices': [
                    'Parce que NX autorise l\'exécution dans le tas mais pas dans la pile',
                    'Parce que la pile n\'est plus exécutable : le code déposé ne peut pas être lancé directement',
                    'Parce que NX chiffre la pile',
                    'Parce que NX désactive le canari',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'NX = No-eXecute. Sur quelle zone pose-t-on le code ?',
                'explain': 'Avec NX, la pile est seulement des données : y déposer du shellcode ne suffit plus. L\'attaquant utilise alors des fragments de code déjà présents (gadgets) et construit une chaîne d\'appels : c\'est le Return-Oriented Programming.',
            },
            {
                'q': 'Un programme C lit avec <code>gets()</code> dans un buffer de 32 octets. Quel est le vrai problème ?',
                'choices': [
                    'gets() est trop lent',
                    'gets() n\'a aucune limite : la saisie peut dépasser le buffer et déborder',
                    'gets() fonctionne uniquement en ASCII',
                    'gets() ne fonctionne qu\'avec les tableaux',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le nom de la fonction dit tout : « get » sans « n » ni taille.',
                'explain': '<code>gets()</code> lit une ligne sans connaître la taille du tableau. C\'est l\'exemple même du bug que le cours montre en première minute, et la raison pour laquelle il ne doit plus être utilisé.',
            },
            {
                'q': 'Pourquoi le canari ne protège-t-il pas contre un débordement sur le tas ?',
                'choices': [
                    'Parce que le canari est trop court',
                    'Parce que le canari est posé sur la pile, pas entre les blocs du tas',
                    'Parce que le canari est chiffré',
                    'Parce que le canari expire après quelques secondes',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Où vit le canari ? Et où se trouve le tas ?',
                'explain': 'Le canari est un mécanisme de pile : entre les variables locales et l\'adresse de retour. Un débordement sur le tas écrase d\'autres données (pointeurs, tailles de blocs) et le canari ne le voit pas. D\'où les « electric fences » et d\'autres protections côté tas.',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'تجاوز المخزن المؤقت: الهجوم والدفاعات',
                'excerpt': 'ماذا يحدث عندما يكتب البرنامج أبعد من خانته، ولماذا غيّرت الدفاعات (canary وASLR وNX) قواعد اللعبة.',
                'tasks': [
                    'المهمة 1: الدرس — التجاوز وحراسه الأربعة',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — البرنامج الثغري',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'Buffer overflows: the attack and the defenses',
                'excerpt': 'What happens when a program writes past its box, and why canaries, ASLR and NX changed the game.',
                'tasks': [
                    'Task 1: Lesson - the overflow and its four guards',
                    'Task 2: Practice',
                    'Task 3: Mission - the vulnerable binary',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
    {
        'title': 'Architecture de confiance : séparer les privilèges',
        'excerpt': 'Comment on découpe un programme pour qu\'un bug n\'ait pas le pouvoir de tout détruire.',
        'content': 'La leçon 4 de 6.858 : la séparation des privilèges, la notion de « confiance », et le prix à payer.',
        'difficulty': 'moyen',
        'duration': 35,
        'xp_bonus': 45,
        'video': {
            'id': 'dNl22h1kW1k',
            'title': '4. Privilege Separation',
            'channel': MIT,
            'institution': INST858,
            'license': LIC,
            'duration': '1:23:29',
            'note': 'Cours vidéo de l\'université (MIT OpenCourseWare). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — séparer les pouvoirs',
        'lesson': (
            '<p>Un programme unique qui fait tout (parser une requête, écrire dans la base, envoyer un e-mail) est un programme '
            'dont <em>un seul bug</em> donne à l\'attaquant <em>tous les pouvoirs</em>. '
            'La <strong>séparation des privilèges</strong> consiste à le découper en deux :</p>'
            '<ul>'
            '<li>une partie <strong>sans privilège</strong>, qui fait le travail douteux (parser, calculer) ;</li>'
            '<li>une partie <strong>privilegiée</strong>, minuscule, qui fait le travail dangereux (écrire dans la base) '
            'et qui ne fait <em>que</em> ça, sur des données déjà validées.</li>'
            '</ul>'
            '<p>Les deux communiquent par un canal étroit et typé : la partie non privilégiée peut demander '
            '« ajoute cette ligne », jamais « exécute cette commande ». '
            'Un bug dans le parseur donne alors à l\'attaquant un programme <em>sans</em> privilège, '
            'et la partie privilégiée ne retrouve pas le droit de faire n\'importe quoi.</p>'
            '<p>La <strong>notion de confiance</strong> complète la idée : on dessine une frontière, et on décide '
            '« à l\'intérieur de cette frontière, je fais confiance ». Chaque bogue qui renverse une hypothèse de confiance '
            'doit être signalé : sinon, la frontière est fausse.</p>'
            '<p><strong>À retenir :</strong> la sécurité ne vient pas d\'un code parfait, mais d\'un découpage où '
            'l\'erreur d\'un composant reste locale. On appelle cela la <em>défense en profondeur</em>.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions sur le découpage et la confiance.</p>',
        'practice': [
            {
                'q': 'Dans une architecture à privilèges séparés, qui peut écrire dans la base de données ?',
                'choices': [
                    'La partie non privilégiée, directement',
                    'N\'importe quel processus du serveur',
                    'Seulement la partie privilégiée, sur demande de la partie non privilégiée',
                    'Le client, via une requête SQL directe',
                ],
                'correct': 2,
                'xp': 10,
                'hint': 'La séparation consiste justement à réserver le pouvoir à un seul composant.',
                'explain': 'Seul le composant privilégié écrit. Le composant non privilégié ne fait que <em>demander</em>, via un canal typé et limité. Le client n\'a jamais accès direct à la base.',
            },
            {
                'q': 'Tu trouves un bug dans la partie non privilégiée. Que se passe-t-il si tu n\'as jamais dit à personne que ce composant était de confiance ?',
                'choices': [
                    'Rien : un bug n\'a d\'importance que s\'il est critique',
                    'La frontière de confiance est fausse : l\'attaquant a peut-être déjà franchi le périmètre',
                    'Le programme se met à jour tout seul',
                    'Il faut réécrire le programme en Java',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'La confiance, c\'est une hypothèse écrite quelque part. Qui l\'a écrite ?',
                'explain': 'La confiance doit être <em>explicite</em>. Un composant « de confiance » sans documenter ce qu\'on attend de lui, c\'est une frontière imaginaire : le premier bogue/docs montre qu\'elle n\'existe pas.',
            },
        ],
        'mission_title': 'Task 3 : La mission — la politique de séparation',
        'mission': {
            'prompt': (
                '<p>Le cours 6.858 a laissé dans la salle des cours sa <em>politique de séparation des privilèges</em> '
                '(le fichier qui décrit quels processus tournent avec quels droits).</p>'
                '<p><strong>Mission.</strong> Lis cette politique et relève la <em>valeur du niveau de privilège '
                'du processus principal</em> qu\'elle fixe (le niveau de confiance annoncé pour le service web).</p>'
            ),
            'question': 'Releve le niveau de privilege du processus principal annonce dans la politique de separation des privileges.',
            'flag_path': '/root/flags/flag-u03.txt',
            'xp': 30,
            'hint': 'La politique est dans <code>/etc/secura-policy</code>. Un <code>ls</code> puis un <code>cat</code> suffisent.',
            'explain': 'Une politique de séparation des privilèges dit qui fait quoi et avec quels droits. Savoir lire ce document, c\'est savoir juger si un service est correctement découpé.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Quel est l\'objectif principal de la séparation des privilèges ?',
                'choices': [
                    'Accélérer le programme',
                    'Faire qu\'un bug dans une partie reste local et sans pouvoir',
                    'Réduire la taille du code',
                    'Éviter d\'écrire des tests',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Pense à ce que l\'attaquant obtient s\'il trouve un bug.',
                'explain': 'La séparation des privilèges limite le <em>pouvoir</em> obtenu par un bug. C\'est de la défense en profondeur : même avec un bogue, le système plie sans s\'effondrer.',
            },
            {
                'q': 'Un « canal étroit et typé » entre les deux parties, c\'est-à-dire ?',
                'choices': [
                    'Une interface qui n\'accepte que des messages attendus, pas des commandes libres',
                    'Un tunnel chiffré entre les deux processus',
                    'Un fichier partagé par les deux processus',
                    'Un port réseau réservé à l\'administration',
                ],
                'correct': 0,
                'xp': 10,
                'hint': 'Le canal doit interdire ce qui serait dangereux.',
                'explain': 'Le canal est <em>typé</em> : la partie non privilégiée peut demander des opérations prévues (« écrire une ligne de log »), pas enchaîner des commandes arbitraires. C\'est ce qui rend la frontière vérifiable.',
            },
            {
                'q': 'Quel est le risque principal quand on sépare les privilèges ?',
                'choices': [
                    'Le programme devient plus lent',
                    'La séparation ajoute des points de communication qui peuvent devenir des failles à eux-mêmes',
                    'Le code devient plus difficile à lire',
                    'Il faut réécrire le programme en Rust',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Chaque nouvelle frontière est une nouvelle surface.',
                'explain': 'Séparer crée une interface : si elle est mal faite (validation absente, courses, messages trop larges), elle devient le maillon faible. Le cours montre ce compromis à chaque cours.',
            },
            {
                'q': 'Le serveur web tourne en root et le service de sauvegarde aussi. Quel est le défaut ?',
                'choices': [
                    'Aucun : tout tourne avec les mêmes droits, c\'est cohérent',
                    'Les deux processus sont dans la même zone de confiance, donc une faille dans l\'un donne le pouvoir de l\'autre',
                    'La sauvegarde ne peut pas lire les logs',
                    'Le service web ne peut pas démarrer',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Deux processus avec les mêmes droits : quelle est la frontière ?',
                'explain': 'Si les deux processus ont les mêmes privilèges, il n\'y a pas de séparation : une faille dans le web donne root. Le cours insiste : la séparation ne sert à rien si les droits sont les mêmes.',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'بنية الثقة: فصل الامتيازات',
                'excerpt': 'كيف نقسم برنامجًا حتى لا يمنح خلل واحد سلطة تدمير كل شيء.',
                'tasks': [
                    'المهمة 1: الدرس — فصل السلطات',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — سياسة الفصل',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'Trust architecture: separating privileges',
                'excerpt': 'How a program is split so that a single bug cannot destroy everything.',
                'tasks': [
                    'Task 1: Lesson - splitting the powers',
                    'Task 2: Practice',
                    'Task 3: Mission - the separation policy',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
    {
        'title': 'Bac à sable : confiner le code natif',
        'excerpt': 'Isoler un programme douteux dans un espace fermé : le bac à sable, ses règles, et ce qu\'il ne protège pas.',
        'content': 'La leçon 7 de 6.858 : le sandboxing du code natif, ou comment faire tourner un programme sans lui faire confiance.',
        'difficulty': 'moyen',
        'duration': 35,
        'xp_bonus': 45,
        'video': {
            'id': 'I0Psvvky-44',
            'title': '7. Sandboxing Native Code',
            'channel': MIT,
            'institution': INST858,
            'license': LIC,
            'duration': '1:23:21',
            'note': 'Cours vidéo de l\'université (MIT OpenCourseWare). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — le bac à sable',
        'lesson': (
            '<p>Un <strong>bac à sable</strong> (<em>sandbox</em>) est un espace d\'exécution confiné : '
            'le programme y tourne, mais ses capacités sont réduites à une liste blanche. '
            'C\'est ce qui permet d\'ouvrir un fichier téléchargé, de tester une expression régulière douteuse, '
            'ou de faire tourner un plugin sans lui faire confiance.</p>'
            '<p>Les techniques se combinent :</p>'
            '<ul>'
            '<li><strong>Restrictions système</strong> : interdire certains appels système (ouvrir un réseau, exécuter un processus).</li>'
            '<li><strong>Espaces mémoire séparés</strong> : le programme tourne dans une zone qui ne contient que lui.</li>'
            '<li><strong>Contrôle des ressources</strong> : temps CPU, mémoire, nombre de fichiers : sinon un programme malveillant s\'installe en mangeant la machine.</li>'
            '<li><strong>Filtrage des appels</strong> : le bac à sable intercepte les appels et ne laisse passer que ceux autorisés.</li>'
            '</ul>'
            '<p>Et la question que pose le cours : <strong>que se passe-t-il si le programme s\'échappe du bac à sable ?</strong> '
            'Toute la sécurité repose alors sur la solidité du mécanisme lui-même. '
            'D\'où l\'idée de <em>défense en profondeur</em> : un bac à sable, plus une séparation des privilèges, '
            'plus un filtrage : si l\'un saute, les autres tiennent.</p>'
            '<p><strong>À retenir :</strong> un bac à sable ne rend pas le code sûr ; il rend <em>les dégâts</em> bornés. '
            'C\'est déjà énorme.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions : ce que le bac à sable borne, et ce qu\'il ne protège pas.</p>',
        'practice': [
            {
                'q': 'Un bac à sable limite la mémoire, le temps CPU et les appels système. Quel est l\'objectif exact ?',
                'choices': [
                    'Rendre le programme plus rapide',
                    'Borner les dégâts si le programme est malveillant ou bogué',
                    'Remplacer la revue de code',
                    'Garantir que le programme est correct',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le bac à sable ne juge pas le programme : il encadre ses pouvoirs.',
                'explain': 'Le bac à sable ne dit pas si le programme est bon ou mauvais : il dit « même s\'il l\'est, voici ce qu\'il peut faire ». La garantie porte sur les dégâts, pas sur la correctness.',
            },
            {
                'q': 'Pourquoi le cours insiste-t-il sur la défense en profondeur après la leçon sur le bac à sable ?',
                'choices': [
                    'Parce que le bac à sable est trop lent',
                    'Parce qu\'un mécanisme unique peut avoir une faille : les autres mechanisms limitent le dégât',
                    'Parce qu\'il faut deux serveurs web',
                    'Parce que le bac à sable ne marche que sous Linux',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Que se passe-t-il si l\'attaquant s\'échappe du bac à sable ?',
                'explain': 'Si l\'évasion est possible, un seul mécanisme ne suffit pas. Empiler des mécanismes indépendants (sandbox + privilèges séparés + filtrage) fait que l\'évasion d\'un ne suffit pas à tout casser.',
            },
        ],
        'mission_title': 'Task 3 : La mission — la règle de confinement',
        'mission': {
            'prompt': (
                '<p>Dans la salle des cours, l\'équipe a laissé le <em>profil de confinement</em> du bac à sable '
                'utilisé pour les vérifications automatisées : le fichier qui dit ce que le programme enfermé a le droit de faire.</p>'
                '<p><strong>Mission.</strong> Lis ce profil et relève la <em>valeur du nombre maximal de processus</em> '
                'qu\'il autorise (<code>max_processes</code>). C\'est la preuve que tu as compris ce que borne un bac à sable.</p>'
            ),
            'question': 'Releve la valeur de max_processes annoncee dans le profil de confinement du bac a sable.',
            'flag_path': '/root/flags/flag-u04.txt',
            'xp': 30,
            'hint': 'Le profil est un fichier de configuration : cherche un .conf ou un .toml dans <code>/etc/secura-policy</code>.',
            'explain': 'Borner le nombre de processus, c\'est empêcher un programme de lancer une pluie de sous-processus.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Quelle technique n\'est PAS un moyen de confiner un programme ?',
                'choices': [
                    'Interdire certains appels système',
                    'Isoler sa mémoire',
                    'Borner le temps CPU et la mémoire',
                    'Le compiler avec un optimiseur plus agressif',
                ],
                'correct': 3,
                'xp': 10,
                'hint': 'Une des quatre ne change pas les capacités du programme.',
                'explain': 'Un optimiseur change la vitesse, pas les droits. Le confinement, c\'est une question de <em>capacités</em> : appels système, mémoire, ressources, communications.',
            },
            {
                'q': 'Un programme confiné peut encore consommer toute la RAM de la machine si on oublie quoi ?',
                'choices': [
                    'La limite de mémoire',
                    'Le nom du processus',
                    'Le port d\'écoute',
                    'La variable d\'environnement PATH',
                ],
                'correct': 0,
                'xp': 10,
                'hint': 'Sans limite de ressources, un programme peut « manger » la machine.',
                'explain': 'Un confinement sans quota (mémoire, CPU, PIDs, taille de fichier) laisse un programme consommer la machine : c\'est un déni de service, pas une fuite de données, mais ça suffit pour paralyser le service.',
            },
            {
                'q': 'Après la leçon sur le bac à sable, le cours passe à « Ur/Web ». Pourquoi ?',
                'choices': [
                    'Parce que le langage est plus moderne',
                    'Parce que les langages à mémoire sûre montrent une autre voie pour réduire la surface d\'attaque',
                    'Parce qu\'il faut un langage plus rapide',
                    'Parce que le bac à sable est abandonné',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'La question n\'est pas seulement « où exécuter », mais aussi « quoi exécuter ».',
                'explain': 'Le cours montre deux familles de réponses : confiner l\'exécution (bac à sable) et réduire la surface d\'attaque à la source (langages à mémoire sûre, où le débordement de tampon n\'existe plus).',
            },
            {
                'q': 'Un bac à sable laisse passer tous les appels sauf l\'écriture de fichiers. Quel est le risque principal restant ?',
                'choices': [
                    'Aucun : le reste est sans importance',
                    'La consommation de CPU et de mémoire, si rien ne les borne',
                    'La couleur de l\'affichage du programme',
                    'Le nom du compte qui exécute',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Un bac à sable filtre des actions ; il ne gère pas forcément les ressources.',
                'explain': 'Filtrer les actions ne remplace pas les quotas : un programme qui alloue sans fin reste un problème. Les deux dimensions (actions autorisées, ressources) doivent être bornées.',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'الصندوق الرملي: حبس الكود الأصلي',
                'excerpt': 'عزل برنامج مشبوه في مساحة مغلقة: الصندوق الرملي وقواعده وما لا يحميه.',
                'tasks': [
                    'المهمة 1: الدرس — الصندوق الرملي',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — قاعدة الحبس',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'Sandboxing: confining native code',
                'excerpt': 'Isolating a doubtful program in a closed space: the sandbox, its rules, and what it does not protect.',
                'tasks': [
                    'Task 1: Lesson - the sandbox',
                    'Task 2: Practice',
                    'Task 3: Mission - the confinement profile',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
    {
        'title': 'Le web et ses règles : SOP, CSRF et sessions',
        'excerpt': 'Pourquoi le navigateur mélange parfois les sites, et comment on empêche un site de jouer à ta place.',
        'content': 'La leçon 9 de 6.858 : le modèle de sécurité du web, la même origine, et les attaques CSRF.',
        'difficulty': 'moyen',
        'duration': 35,
        'xp_bonus': 45,
        'video': {
            'id': 'WlmKwIe9z1Q',
            'title': '9. Securing Web Applications',
            'channel': MIT,
            'institution': INST858,
            'license': LIC,
            'duration': '1:22:08',
            'note': 'Cours vidéo de l\'université (MIT OpenCourseWare). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — le modèle de sécurité du web',
        'lesson': (
            '<p>Le web repose sur une règle simple et trompeuse : <strong>la même origine</strong>. '
            'Un script ne peut lire que les données de son propre site. C\'est ce qui protège le mot de passe '
            'qu\'on tape sur une banque, même si la page est truquée.</p>'
            '<p>Mais l\'interdiction a un versant aveugle : la <strong>policy SOP</strong> empêche une page '
            '<em>de lire</em> les réponses d\'un autre site, pas un autre site <em>d\'envoyer</em> une requête '
            'avec tes identifiants. C\'est le <strong>CSRF</strong> :</p>'
            '<ol>'
            '<li>tu es connecté à ta banque ;</li>'
            '<li>tu ouvres, dans un autre onglet, une page d\'un site malveillant ;</li>'
            '<li>cette page envoie automatiquement une requête à la banque : « vire 500 € à mon compte » ;</li>'
            '<li>la banque voit la requête, elle vient bien de toi (tes identifiants sont joints), elle l\'exécute.</li>'
            '</ol>'
            '<p>La parade la plus simple : le <strong>jeton CSRF</strong>. Le serveur place une valeur secrète '
            'dans le formulaire ; le navigateur renvoie ce jeton à chaque requête ; le serveur refuse toute requête '
            'sans jeton. Un site externe ne peut pas lire ce jeton (règle SOP), donc il ne peut pas le renvoyer.</p>'
            '<p>Et les autres parades : le mot de passe ne doit pas être stocké en clair, la session doit être '
            'protégée par un cookie <code>HttpOnly</code> et <code>Secure</code>, et les requêtes sensibles '
            'doivent être vérifiées côté serveur (on ne fait jamais confiance au formulaire).</p>'
            '<p><strong>À retenir :</strong> le navigateur est un intermédiaire de confiance. Il transmet des jetons '
            'à la demande, et il ne vérifie pas qui demande.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions sur le modèle du web et les parades.</p>',
        'practice': [
            {
                'q': 'La règle de même origine (SOP) empêche une page d\'un site A de lire la réponse du site B. Que ne l\'empêche-t-elle pas ?',
                'choices': [
                    'D\'empêcher d\'afficher un lien vers le site B',
                    'D\'empêcher le site B de recevoir une requête envoyée depuis la page A, identifiants compris',
                    'D\'empêcher le site A de charger une image du site B',
                    'D\'empêcher le navigateur de garder l\'historique',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'La SOP parle de <em>lire</em> les réponses. Elle dit quelque chose des requêtes ?',
                'explain': 'La SOP est une règle de <em>lecture</em>. Le navigateur envoi des requêtes avec les identifiants de session sans demander l\'avis de l\'utilisateur : c\'est l\'angle mort du CSRF.',
            },
            {
                'q': 'Pourquoi le jeton CSRF résiste-t-il à l\'attaque ?',
                'choices': [
                    'Parce qu\'il est chiffré',
                    'Parce qu\'une page tierce ne peut pas lire le jeton de la page',
                    'Parce qu\'il expire après une seconde',
                    'Parce qu\'il est stocké dans un cookie HttpOnly',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le site malveillant peut envoyer la requête ; peut-ilFilled le jeton ?',
                'explain': 'Le jeton est dans la page du site légitime ; le site malveillant ne peut pas le lire (SOP), donc il ne peut pas le recopier. Il ne peut pas le deviner non plus s\'il est aléatoire.',
            },
        ],
        'mission_title': 'Task 3 : La mission — les notes du cours web',
        'mission': {
            'prompt': (
                '<p>Dans la salle des cours, le cours 6.858 a laissé ses <em>notes sur le web</em> (<code>/srv/cours/mit858/web-notes.txt</code>) : elles récapitulent la politique de même origine, le CSRF et sa parade.</p><p><strong>Mission.</strong> Le bloc de configuration du formulaire est dans le fichier, en trois colonnes : <code>csrf     = TOKEN-…</code>. La valeur du drapeau est ce qui suit le <code>=</code>, tel quel. Trouve-la avec une commande, pas à l\'œil.</p>'
            ),
            'question': 'Extrais la valeur du champ csrf dans les notes du cours web (web-notes.txt).',
            'flag_path': '/root/flags/flag-u05.txt',
            'xp': 30,
            'hint': 'La ligne est indentée : <code>grep "^ *csrf" /srv/cours/mit858/web-notes.txt</code> la trouve, puis <code>cut -d" " -f5</code> isole la valeur. Plus court : <code>awk "/^ *csrf *=/{print $3}" /srv/cours/mit858/web-notes.txt</code>.',
            'explain': 'Un jeton anti-CSRF est une valeur aléatoire liée à la session : le formulaire légitime la connaît, un site tiers ne peut pas la deviner. Le lire dans un fichier de configuration, c\'est comprendre où le serveur la range et comment un attaquant pourrait la voler.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Une banque utilise un cookie de session sans l\'attribut HttpOnly. Quel risque ?',
                'choices': [
                    'Aucun risque, le cookie reste privé',
                    'Un script injecté dans une page peut lire le cookie de session',
                    'Le cookie devient plus gros',
                    'La session ne peut plus être fermée',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'HttpOnly : à qui le cookie est-il visible ?',
                'explain': 'HttpOnly empêche JavaScript de lire le cookie : une injection de script ne peut pas voler la session. Secure force HTTPS. Les deux vont ensemble.',
            },
            {
                'q': 'Quel est le rôle du cookie <code>SameSite</code> ?',
                'choices': [
                    'Chiffrer le cookie',
                    'Dire au navigateur de ne pas envoyer le cookie lors d\'une requête venue d\'un autre site',
                    'Allonger la durée de vie du cookie',
                    'Signer le cookie',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'SameSite = « même site ». Que se passe-t-il quand ce n\'est pas le cas ?',
                'explain': 'SameSite=Lax ou Strict fait que le cookie de session n\'accompagne pas une requête cross-site : c\'est une parade <em>supplémentaire</em> contre le CSRF, en plus du jeton.',
            },
            {
                'q': 'Le serveur vérifie l\'identifiant de l\'utilisateur envoyé par le formulaire, mais ne vérifie pas l\'origine de la requête. Quel est le risque ?',
                'choices': [
                    'Aucun : le serveur fait ce qu\'on lui demande',
                    'Une requête forgée depuis un autre site peut se faire passer pour l\'utilisateur connecté',
                    'Le serveur perdra ses données',
                    'Le mot de passe de l\'utilisateur sera envoyé en clair',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'La requête est-elle prouvée comme venant de l\'utilisateur ?',
                'explain': 'Sans vérification d\'origine (jeton CSRF, en-tête Origin, SameSite), une requête forgée est indistinguishable d\'une vraie requête pour le serveur : c\'est la définition du CSRF.',
            },
            {
                'q': 'Dans la défense en profondeur, que vient apporter le hachage du mot de passe si on a déjà un jeton CSRF ?',
                'choices': [
                    'Rien : les deux protègent la même chose',
                    'Un autre remède : même si la base est volée, les mots de passe ne sont pas directement utilisables',
                    'Le mot de passe devient plus court',
                    'La connexion devient plus rapide',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Les deux mécanismes protègent des choses différentes.',
                'explain': 'Le jeton CSRF protège l\'identité <em>pendant</em> la session ; le hachage protège les mots de passe <em>après</em> un vol de base. Chaque couche traite une menace différente.',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'الويب وقواعده: SOP وCSRF والجلسات',
                'excerpt': 'لماذا يخلط المتصفح أحيانًا المواقع، وكيف نمنع موقعًا من التصرف نيابةً عنك.',
                'tasks': [
                    'المهمة 1: الدرس — نموذج أمان الويب',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — ملاحظات درس الويب',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'The web and its rules: SOP, CSRF and sessions',
                'excerpt': 'Why browsers sometimes mix sites up, and how to stop a site acting on your behalf.',
                'tasks': [
                    'Task 1: Lesson - the web security model',
                    'Task 2: Practice',
                    'Task 3: Mission - the web course notes',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
]
