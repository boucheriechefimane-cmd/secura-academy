# -*- coding: utf-8 -*-
"""M7 — Les six rooms de brief et la room Kahoot.

Les briefs sont les six vidéos d'introduction des labs : avant de
commencer, on regarde comment l Professors of the lab works. Chaque
brief a sa preuve : une valeur relevée dans la machine du dojo.

La room Kahoot est la révision : le même contenu, jouable en classe
(avec Kahoot) ou seul dans la plateforme (sans compte).

Textes originaux. Vidéos : pwn.college, CYBER.ORG, Joe Ma.
"""

from rooms_m7 import q, LAB_DOJO, CH_PWN, LIC_PWN, INST_PWN, CH_CYBER, LIC_CYBER, INST_CYBER, CH_JOE, LIC_JOE, INST_JOE


BRIEFS = [
    {
        'code': 'b01',
        'fichier': '01-presentation.txt',
        'valeur': 'brief_presentation',
        'titre': "Brief 1 : le dojo, comment on s'entraîne",
        'excerpt': "Avant les défis : la méthode. Le dojo n'est pas un jeu de casse, c'est une échelle.",
        'ar_titre': 'موجز 1: الدوجو، كيف تتدرّب',
        'ar_excerpt': 'قبل التحديات: الطريقة. الدوجو ليس لعبة كسر، بل سُلّم.',
        'en_titre': 'Brief 1: the dojo, how you train',
        'en_excerpt': 'Before the challenges: the method. The dojo is not a cracking game, it is a ladder.',
        'contenu': "Brief 1 : le dojo de pwn.college et la méthode des ceintures.",
        'resume': (
            "<p>Un dojo, ce n'est pas une liste de failles à enfoncer : c'est une <strong>échelle</strong>. "
            "On monte ceinture par ceinture, et chaque ceinture fabrique une compétence.</p>"
            "<p>La règle du dojo, en trois points :</p>"
            "<ol>"
            "<li><strong>Chercher la preuve, pas la faille.</strong> Un exercice te demande de "
            "relever une valeur précise. C'est une preuve : on peut vérifier que tu as "
            "compris, pas deviner ce que l'auteur avait dans la tête.</li>"
            "<li><strong>Une seule commande à la fois.</strong> Au début, on lit. Ensuite seulement, "
            "on casse. Les ceintures hawks le font dans cet ordre, et ça marche.</li>"
            "<li><strong>Le dojo n'est pas un jeu solo.</strong> C'est un entraînement : on peut "
            "recommencer, se tromper, et recommencer. L'objectif n'est pas la victoire, "
            "c'est la competence.</li>"
            "</ol>"
            "<p><strong>À retenir :</strong> dans notre plateforme, chaque défi se valide avec un "
            "drapeau lu dans ta machine, par le serveur, en root. Tu ne peux pas tricher : "
            "tu peux seulement apprendre.</p>"
        ),
        'practice': [
            q(
                "Qu'est-ce qui distingue un exercice « à preuve » d'un exercice « à deviner » ?",
                [
                    "Le prix",
                    "La preuve se vérifie automatiquement : il y a une seule bonne réponse, à lire dans la machine",
                    "Le nombre de questions",
                    "La durée",
                ],
                1,
                "Qu'est-ce qui permet de dire « c'est bon » ?",
                "Une preuve se vérifie : le serveur lit la valeur dans la machine et la compare. Un exercice « à deviner » demande de reformuler ce que l'auteur avait en tête : c'est flou, et c'est démotivant.",
            ),
            q(
                "Pourquoi commencer par lire avant de chercher à casser ?",
                [
                    "Parce que c'est plus lent, donc plus sérieux",
                    "Parce qu'on ne sait pas où chercher avant d'avoir vu ce qu'il y a",
                    "Parce que les outils de lecture sont plus beaux",
                    "Parce que les comptes d'accès sont compliqués",
                ],
                1,
                "Tu cherches quoi, exactement, avant d'avoir regardé ?",
                "C'est la méthode du dojo : observer d'abord (ce qui tourne, ce qui est écrit, qui possède quoi), puis agir. Un choc frontal sur une application qu'on n'a pas lue, c'est de la-devinette.",
            ),
        ],
        'exam': [
            q(
                "Le serveur compare ta réponse au drapeau qu'il garde dans la machine, en root. Pourquoi « en root » ?",
                [
                    "Pour aller plus vite",
                    "Pour que le drapeau soit illisible par l'apprenant : il doit le trouver, pas le copier",
                    "Parce que les conteneurs tournent en root",
                    "Pour compresser le fichier",
                ],
                1,
                "Qui doit pouvoir lire le fichier de drapeau ?",
                "Si l'élève pouvait lire le fichier de drapeau, la mission ne prouverait rien : il copierait la réponse. En le mettant en 400 root:root, on oblige l'élève à passer par la compréhension.",
            ),
            q(
                "Un exercice est « à preuve » quand…",
                [
                    "il a une image à télécharger",
                    "la réponse se trouve dans la machine et se vérifie sans ambiguïté",
                    "il dure plus de dix minutes",
                    "il vient d'une université",
                ],
                1,
                "La vérification automatique, c'est la clé.",
                "La règle que nous appliquons à toutes les missions : une seule bonne réponse, lisible dans la machine, vérifiée par le serveur. C'est ce qui distingue une plateforme d'apprentissage d'un questionnaire.",
            ),
        ],
        'video': {
            'id': 'hh4XAU6XYP0',
            'title': 'Introduction: What is pwn.college?',
            'channel': CH_PWN,
            'institution': INST_PWN,
            'license': LIC_PWN,
            'duration': '9:10',
            'note': "Brief 1 : la méthode du dojo (pwn.college, Arizona State University).",
        },
        'mission': {
            'question': "Relève la valeur du brief 1 (la méthode du dojo).",
            'flag_path': '/root/flags/flag-b01.txt',
            'hint': "Les briefs sont dans <code>/srv/briefs</code>.",
            'explain': "Chaque brief est validé par une preuve lue dans la machine du dojo : c'est la même mécanique que pour les défis, et elle vaut pour toutes les rooms.",
        },
    },
    {
        'code': 'b02',
        'fichier': '02-talking-web.txt',
        'valeur': 'brief_talking_web',
        'titre': "Brief 2 : le web, comment on parle à un serveur",
        'excerpt': "HTTP, en clair : une requête, une réponse. Le web n'est pas magique.",
        'ar_titre': 'موجز 2: الويب، كيف يتحدث إلى خادم',
        'ar_excerpt': 'HTTP، بوضوح: طلب ثم رد. الويب ليس سحرا.',
        'en_titre': 'Brief 2: the web, how you talk to a server',
        'en_excerpt': 'HTTP, in plain words: a request, a response. The web is not magic.',
        'contenu': "Brief 2 : comment un navigateur parle à un serveur (pwn.college, « Talking Web »).",
        'resume': (
            "<p>Un site web, c'est un programme qui reçoit des textes et répond par des textes. "
            "Rien de plus. Le « web » n'est pas une magie : c'est un dialogue, et le dialogue est "
            "lisible.</p>"
            "<p>La mécanique, en quatre temps :</p>"
            "<ol>"
            "<li>Le navigateur envoie une <strong>requête</strong> : une méthode (GET, POST), "
            "une adresse, des en-têtes, et parfois un corps.</li>"
            "<li>Le serveur lit la requête, exécute son code, prépare une <strong>réponse</strong> : "
            "un code de statut (200, 404, 500…), des en-têtes, puis un corps.</li>"
            "<li>Le corps peut être du HTML, du JSON, une image… ou du texte qui est ensuite "
            "exécuté par ton navigateur (JavaScript).</li>"
            "<li>Chaque échange laisse une trace : dans les journaux du serveur, "
            "dans l'historique du navigateur, dans la mémoire du serveur.</li>"
            "</ol>"
            "<p><strong>À retenir :</strong> tester une application web, c'est d'abord <em>lire les échanges</em>. "
            "Une injection SQL, une XSS, une fuite de secret : dans les trois cas, "
            "quelque chose que tu n'aurais pas dû pouvoir écrire se retrouve dans une requête.</p>"
        ),
        'practice': [
            q(
                "Que contient une requête HTTP GET ?",
                [
                    "Une méthode, une adresse, des en-têtes et parfois un corps",
                    "Seulement l'adresse du site",
                    "Uniquement des données chiffrées",
                    "Un mot de passe et un nom d'utilisateur",
                ],
                0,
                "La requête, c'est une envelope : qu'y a-t-il dedans ?",
                "Une requête HTTP, c'est une méthode (GET, POST…), une adresse (la route et la requête), des en-têtes (qui parle, quel format, quel navigateur) et parfois un corps. Le POST envoie des données ; le GET les met dans l'adresse.",
            ),
            q(
                "Que signifie le code de statut HTTP 404 ?",
                [
                    "Le serveur a planté",
                    "La ressource demandée n'existe pas",
                    "La requête a été refusée par le pare-feu",
                    "Le site est en maintenance",
                ],
                1,
                "404 : laCombination de « pas trouvé » et de « 400-something ».",
                "404 = Not Found : le serveur répond, mais la page n'existe pas. 500 = Internal Server Error : le serveur a planté en traitant la requête. 403 = Forbidden : le serveur a compris, mais refuse.",
            ),
        ],
        'exam': [
            q(
                "Une XSS (injection de script) consiste à…",
                [
                    "Détruire la base de données",
                    "Faire exécuter du code par le navigateur d'une autre personne",
                    "Inonder le serveur de requêtes",
                    "Chiffrer les échanges",
                ],
                1,
                "Le « X » de XSS, c'est le script.",
                "Une XSS, c'est du code que tu places dans une donnée que l'application réutilise sans l'échapper, et qui s'exécute chez celui qui affiche la page. Le risque : voler une session, ou agir avec les droits de la victime.",
            ),
            q(
                "Pourquoi lire les journaux du serveur est-il utile pour un test ?",
                [
                    "Parce qu'ils contiennent le code source",
                    "Parce qu'ils montrent les requêtes reçues : on y voit ce que l'application a compris de ce qu'on lui a envoyé",
                    "Parce qu'ils accélèrent le serveur",
                    "Parce qu'ils remplacent les tests",
                ],
                1,
                "Le journal est le récit de la requête.",
                "Quand l'application se comporte bizarrement, le journal montre la requête telle qu'elle a été reçue. C'est souvent là qu'on voit la différence entre ce qu'on a envoyé et ce que le serveur a compris.",
            ),
        ],
        'video': {
            'id': 'UW13N0CV-4s',
            'title': 'pwn.college - Talking Web - Introduction',
            'channel': CH_PWN,
            'institution': INST_PWN,
            'license': LIC_PWN,
            'duration': '9:43',
            'note': "Brief 2 : comment le web parle au serveur (pwn.college).",
        },
        'mission': {
            'question': "Relève la valeur du brief 2 (le web en clair).",
            'flag_path': '/root/flags/flag-b02.txt',
            'hint': "Les briefs sont dans <code>/srv/briefs</code>.",
            'explain': "Même mécanique : une preuve lue dans la machine, comparée par le serveur en root.",
        },
    },
    {
        'code': 'b03',
        'fichier': '03-exploitation.txt',
        'valeur': 'brief_exploitation',
        'titre': "Brief 3 : les scénarios d'exploitation",
        'excerpt': "Exploiter, ce n'est pas « casser » : c'est faire faire à un programme quelque chose qu'il ne prévoyait pas.",
        'ar_titre': 'موجز 3: سيناريوهات الاستغلال',
        'ar_excerpt': 'الاستغلال ليس «الكسر»: إنك تجعل برنامجا يفعل شيئا لم يتوقعه.',
        'en_titre': 'Brief 3: exploitation scenarios',
        'en_excerpt': 'Exploiting is not "breaking": it is making a program do something it did not expect.',
        'contenu': "Brief 3 : ce qu'est une exploitation et pourquoi elle est toujours un scénario (pwn.college).",
        'resume': (
            "<p>Le mot « exploitation » fait peur, mais l'idée est simple : "
            "<strong>faire faire à un programme quelque chose qu'il ne prévoyait pas</strong>.</p>"
            "<p>Tout scénario d'exploitation a la même forme, en quatre temps :</p>"
            "<ol>"
            "<li><strong>Le déclencheur</strong> : l'entrée que l programmes ne contrôle pas "
            "(une donnée envoyée par le réseau, un fichier, un paramètre).</li>"
            "<li><strong>L'écart</strong> : le programme fait une hypothèse qui n'est pas garantie "
            "(« ce texte tient dans 32 octets », « ce nom est le bon »).</li>"
            "<li><strong>La deviation</strong> : l'entrée trigger déborde, se déforme, ou "
            "s'exécute à la place de quelque chose d'autre.</li>"
            "<li><strong>L'effet</strong> : ce que l'attaquant obtient — lire un fichier, "
            "exécuter une commande, devenir root.</li>"
            "</ol>"
            "<p>Le bon réflexe : <strong>chercher l'hypothèse fragile</strong>. Dans un programme, "
            "c'est presque toujours une taille, un nombre, ou une permission : "
            "« et si la donnée était plus grande que prévu ? ».</p>"
            "<p><strong>À retenir :</strong> une exploitation est toujours un <em>scénario</em>, "
            "donc elle s'écrit. Si tu ne peux pas expliquer en trois phrases comment ça marche, "
            "tu n'as probablement rien trouvé.</p>"
        ),
        'practice': [
            q(
                "Dans un scénario d'exploitation, qu'est-ce que « l'hypothèse fragile » ?",
                [
                    "Le pare-feu de l'entreprise",
                    "Une belief du programme qui n'est pas garantie, par exemple « cette donnée tient dans 32 octets »",
                    "Le nom du programme",
                    "La vitesse du réseau",
                ],
                1,
                "Quelle phrase le programme suppose-t-il être vraie ?",
                "L'hypothèse fragile est l'endroit où le programme fait confiance sans vérifier : une taille maximale, un identifiant, un droit d'accès. C'est là que se glisse l'exploitation.",
            ),
            q(
                "Pourquoi « ça plante » n'est pas une preuve d'exploitation ?",
                [
                    "Parce qu'un programme qui plante est juste mal programmé",
                    "Parce qu'un plantage est un résultat, pas un contrôle : il faut obtenir l'effet recherché",
                    "Parce que les plantages sont rares",
                    "Parce qu'il faut rebooter",
                ],
                1,
                "Un crash, c'est un effet de bord. L'exploitation, c'est un effet voulu.",
                "Faire planter un programme est un déni de service, pas une exploitation. L'exploitation, c'est obtenir une capacité qu'on n'avait pas : lire un fichier confidentiel, exécuter une commande, escalader des droits.",
            ),
        ],
        'exam': [
            q(
                "Dans un dépassement de tampon, qu'est-ce qui est écrasé ?",
                [
                    "Le fichier sur le disque",
                    "Des données situées juste après le tampon dans la mémoire (variables, adresse de retour)",
                    "Le mot de passe du compte",
                    "La configuration du réseau",
                ],
                1,
                "Le débordement va plus loin que la place prévue.",
                "C'est la leçon 3 du cours 6.858 : le programme alloue un tampon, mais ne vérifie pas que l'écriture tient dedans. Ce qui suit le tampon en mémoire — variables locales, canari, adresse de retour — se retrouve écrasé. D'où les défenses (canari, NX, ASLR).",
            ),
            q(
                "Comment un testeur écrit-il un scénario d'exploitation ?",
                [
                    "En essaysant des outils au hasard jusqu'à ce que ça marche",
                    "En écrivant d'abord l'hypothèse, le déclencheur et l'effet attendu, puis en le vérifiant",
                    "En copiant un script trouvé en ligne",
                    "En lisant le code source de l'application",
                ],
                1,
                "Une hypothèse, un déclencheur, un effet.",
                "La méthode est discipline : on écrit ce qu'on suppose, comment on le déclenche, et ce qu'on doit obtenir. Ensuite seulement on essaie. C'est ce qui distingue un test d'une suite de commandes.",
            ),
        ],
        'video': {
            'id': 'A5CnZGst5u4',
            'title': 'pwn.college - Exploitation Scenarios - Introduction',
            'channel': CH_PWN,
            'institution': INST_PWN,
            'license': LIC_PWN,
            'duration': '7:21',
            'note': "Brief 3 : le scénario d'exploitation (pwn.college).",
        },
        'mission': {
            'question': "Relève la valeur du brief 3 (le scénario d'exploitation).",
            'flag_path': '/root/flags/flag-b03.txt',
            'hint': "Les briefs sont dans <code>/srv/briefs</code>.",
            'explain': "Même mécanique : une preuve lue dans la machine, comparée par le serveur en root.",
        },
    },
    {
        'code': 'b04',
        'fichier': '04-registres.txt',
        'valeur': 'brief_registres',
        'titre': "Brief 4 : les registres, le carnet du processeur",
        'excerpt': "Le processeur ne garde presque rien en mémoire : il travaille dans une douzaine de cases qu'on oublie aussitôt.",
        'ar_titre': 'موجز 4: السجلات، دفتر المعالج',
        'ar_excerpt': 'المعالج لا يحتفظ في الذاكرة بشيء تقريبًا: يعمل في اثنتي عشرة خانة ينساها بسرعة.',
        'en_titre': "Brief 4: registers, the processor's notebook",
        'en_excerpt': 'The processor keeps almost nothing in memory: it works in a dozen slots it forgets very quickly.',
        'contenu': "Brief 4 : les registres du processeur (pwn.college, « Assembly Crash Course — Registers »).",
        'resume': (
            "<p>Un processeur ne lit pas les variables. Il lit des <strong>registres</strong> : "
            "des cases de mémoire Minuscules, très rapides, en nombre fixe (une douzaine sur x86-64).</p>"
            "<p>Les plus utiles à connaître :</p>"
            "<ul>"
            "<li><code>rax</code>, <code>rbx</code>, <code>rcx</code>, <code>rdx</code> — usage général ;</li>"
            "<li><code>rdi</code>, <code>rsi</code>, <code>rdx</code> — les trois premiers arguments "
            "(convention d'appel System V, celle de Linux sur x86-64) ;</li>"
            "<li><code>rsp</code> — le pointeur de pile : il dit où est le sommet de la pile ;</li>"
            "<li><code>rbp</code> — le pointeur de base, la frame de la fonction en cours.</li>"
            "</ul>"
            "<p>Pourquoi ça compte pour la sécurité : au moment d'un appel de fonction, "
            "l'<strong>adresse de retour</strong> est empilée. Si un débordement atteint cette adresse, "
            "le programme sautera ailleurs : c'est le principe de l'attaque « smashing the stack ».</p>"
            "<p><strong>À retenir :</strong> pour comprendre une exploitation, il faut savoir "
            "où sont les données <em>en ce moment</em>. Les registres, c'est la réponse.</p>"
        ),
        'practice': [
            q(
                "Où se trouve l'adresse de retour d'une fonction ?",
                [
                    "Dans un fichier du disque",
                    "Sur la pile, au-dessus des variables locales",
                    "Dans un registre du processeur",
                    "Dans le journal du serveur",
                ],
                1,
                "Au moment de l'appel, qu'est-ce qui est empilé ?",
                "La convention d'appel empile l'adresse de retour, puis les variables locales. Un débordement de tampon écrit au-delà du tampon local et finit par atteindre cette adresse : d'où la possibility de détourner l'exécution.",
            ),
            q(
                "À quoi servent les registres comme `rdi`, `rsi`, `rdx` ?",
                [
                    "À stocker des fichiers sur le disque",
                    "À passer les arguments d'une fonction, selon la convention d'appel",
                    "À mesurer le temps d'exécution",
                    "À chiffrer la mémoire",
                ],
                1,
                "Comment un programme passe-t-il une valeur à une fonction ?",
                "Sur x86-64 sous Linux, les trois premiers arguments passent dans rdi, rsi et rdx. Savoir cela permet de lire un désassemblage — et de comprendre une exploitation qui construit une chaîne « /bin/sh ».",
            ),
        ],
        'exam': [
            q(
                "Pourquoi une architecture sans registres serait-elle très lente ?",
                [
                    "Parce que les registres coûtent cher en mémoire",
                    "Parce que le processeur est rapide, mais la mémoire ordinaire ne l'est pas : les registres sont la mémoire la plus rapide qui existe",
                    "Parce que les registres ne sont pas fiables",
                    "Parce que le code serait plus long",
                ],
                1,
                "La vitesse vient de la distance, pas de la quantité.",
                "Un registre est dans le processeur : un cycle. Une case de mémoire ordinaire demande des dizaines de cycles. Un programme qui travaille en mémoire est donc lent. Les registres sont la mémoire la plus rapide — et la plus petite.",
            ),
            q(
                "Le « canari » (stack protector), c'est quoi ?",
                [
                    "Un mot de passe du système",
                    "Une valeur placed entre le tampon et l'adresse de retour, vérifiée avant le retour : si elle a changé, le programme s'arrête",
                    "Un pare-feu du noyau",
                    "Une copie de sauvegarde du tampon",
                ],
                1,
                "Un gardien entre le tampon et l'adresse de retour.",
                "Le canari est une valeur aléatoire posée entre le tampon local et l'adresse de retour. Avant de revenir, la fonction la compare : si elle a changé, c'est qu'un débordement a eu lieu, et le programme s'interrompt. C'est la défense vue en cours 6.858.",
            ),
        ],
        'video': {
            'id': 'IWbIZerH930',
            'title': 'pwn college - Assembly Crash Course - Registers',
            'channel': CH_PWN,
            'institution': INST_PWN,
            'license': LIC_PWN,
            'duration': '13:47',
            'note': "Brief 4 : les registres du processeur (pwn.college).",
        },
        'mission': {
            'question': "Relève la valeur du brief 4 (les registres).",
            'flag_path': '/root/flags/flag-b04.txt',
            'hint': "Les briefs sont dans <code>/srv/briefs</code>.",
            'explain': "Même mécanique : une preuve lue dans la machine, comparée par le serveur en root.",
        },
    },
    {
        'code': 'b05',
        'fichier': '05-ne-pas-se-faire-avor.txt',
        'valeur': 'brief_pas_avor',
        'titre': "Brief 5 : ne pas se faire avoir",
        'excerpt': "La règle d'or de l'hygiène numérique : ce qui a l'air trop beau, ou trop urgent, est presque toujours une mise en scène.",
        'ar_titre': 'موجز 5: لا تُخدع',
        'ar_excerpt': 'القاعدة الذهبية للنظافة الرقمية: ما يبدو جميلا جدا، أو عاجلا جدا، هو في الغالب تمثيل.',
        'en_titre': 'Brief 5: do not get fooled',
        'en_excerpt': 'The golden rule of digital hygiene: what looks too good, or too urgent, is almost always a set-up.',
        'contenu': "Brief 5 : les pièges de l'hygiène numérique (CYBER.ORG, « Don't Get Tricked! »).",
        'resume': (
            "<p>La vidéo de CYBER.ORG s'adresse aux plus jeunes : c'est le niveau où les "
            "pièges deviennent <em>quotidiens</em>. Trois réflexes :</p>"
            "<ul>"
            "<li><strong>L'urgence est un outil.</strong> « Votre compte sera fermé dans "
            "deux heures », « il te reste 3 minutes » : l'urgence empêche de réfléchir. "
            "Un vrai service ne menace pas de te punir.</li>"
            "<li><strong>La faille de l'émotion.</strong> La peur (« tu as été hacké »), "
            "la curiosité (« regarde cette photo »), la sympathie (« j'ai besoin d'aide ») : "
            "ce sont des portes d'entrée, pas des sentiments.</li>"
            "<li><strong>La règle de la pause.</strong> Quand un message te presse, on s'arrête : "
            "on vérifie l'adresse, on ouvre le site en tapant l'adresse soi-même, "
            "on demande à un adulte.</li>"
            "</ul>"
            "<p><strong>À retenir :</strong> la technique la plus efficace contre l'hameçonnage, "
            "ce n'est pas de reconnaître un faux message : c'est de savoir <em>où aller</em> "
            "sans passer par le message.</p>"
        ),
        'practice': [
            q(
                "Pourquoi l'urgence est-elle un indice d'hameçonnage ?",
                [
                    "Parce que les vrais services sont toujours lents",
                    "Parce qu'elle empêche de vérifier : on agit avant de réfléchir",
                    "Parce que les e-mails urgents sont rares",
                    "Parce qu'elle rend le message plus court",
                ],
                1,
                "Que fait l'urgence sur toi ?",
                "L'urgence est une technique sociale : elle court-circuite la vérification. Si une menace te presse d'agir tout de suite, c'est précisément le moment de slows down — et de vérifier d'où vient le message.",
            ),
            q(
                "Quelle est la meilleure façon de vérifier un message qui demande de se connecter ?",
                [
                    "Cliquer sur le lien puis regarder l'adresse",
                    "Ouvrir le site en tapant son adresse dans le navigateur, sans passer par le lien",
                    "Répondre au message pour demander",
                    "Cliquer sur le lien et vérifier le cadenas",
                ],
                1,
                "Si tu passes par le lien, tu ne peux plus vérifier.",
                "Le cadenas n'indique que la connexion est chiffrée — pas que le site est le bon. La seule méthode fiable : saisir l'adresse soi-même, ou appeler le service par un numéro connu.",
            ),
        ],
        'exam': [
            q(
                "Quel est le rôle du second facteur d'authentification (MFA) ?",
                [
                    "Rendre le mot de passe plus long",
                    "Ajouter une preuve que le voleur de mot de passe n'a normalement pas : un code, une clé, une application",
                    "Empêcher les courriers indésirables",
                    "Sauvegarder les comptes",
                ],
                1,
                "Le mot de passe seul est une seule preuve.",
                "Le second facteur change la nature de l'authentification : même avec le mot de passe, il manque quelque chose. C'est ce qui rend le hameçonnage de mots de passe beaucoup moins rentable — d'où les vidéos de CYBER.ORG sur ce sujet.",
            ),
            q(
                "Pourquoi la longueur d'un mot de passe compte-t-elle plus que sa complexité ?",
                [
                    "Parce que les mots de passe complexes sont trop longs à taper",
                    "Parce que la longueur rend l'énumération impossible en un temps raisonnable, même avec un alphabet complet",
                    "Parce que les sites l'exigent",
                    "Parce qu'un mot de passe complexe est plus difficile à retenir, donc on l'écrit",
                ],
                1,
                "Chercher toutes les combinaisons, ça prend un temps fou.",
                "La force d'un mot de passe se mesure en combien d'essais il faut. Ajouter un caractère multiplies le nombre de combinaisons ; passer de 8 à 12 caractères le multiplie par plus de 16 000. Un mot de passe long et prévisible bat un mot de passe court et compliqué.",
            ),
        ],
        'video': {
            'id': 'LEC0r-v2EtU',
            'title': "Don't Get Tricked! K-2 Cybersecurity Basics Lesson",
            'channel': CH_CYBER,
            'institution': INST_CYBER,
            'license': LIC_CYBER,
            'duration': '6:06',
            'note': "Brief 5 : l'hygiène numérique au quotidien (CYBER.ORG).",
        },
        'mission': {
            'question': "Relève la valeur du brief 5 (ne pas se faire avoir).",
            'flag_path': '/root/flags/flag-b05.txt',
            'hint': "Les briefs sont dans <code>/srv/briefs</code>.",
            'explain': "Même mécanique : une preuve lue dans la machine, comparée par le serveur en root.",
        },
    },
    {
        'code': 'b06',
        'fichier': '06-explorer-application.txt',
        'valeur': 'brief_explorer',
        'titre': "Brief 6 : explorer une application web",
        'excerpt': "Avant de chercher une faille : regarde l'application comme un utilisateur, puis comme un attaquant.",
        'ar_titre': 'موجز 6: استكشاف تطبيق ويب',
        'ar_excerpt': 'قبل البحث عن ثغرة: انظر التطبيق ك مستخدم، ثم ك مهاجم.',
        'en_titre': 'Brief 6: exploring a web application',
        'en_excerpt': 'Before looking for a flaw: look at the application as a user, then as an attacker.',
        'contenu': "Brief 6 : explorer une application web avec OWASP Juice Shop (démonstration de Joe Ma).",
        'resume': (
            "<p>La démonstration de Joe Ma montre l'ordre qu'il faut respecter : "
            "<strong>d'abord regarder, ensuite attaquer</strong>.</p>"
            "<ol>"
            "<li><strong>Regarde comme un utilisateur.</strong> Chaque bouton, chaque champ, "
            "chaque lien : à quoi ça sert, qui y accède, qu'est-ce qui se passe quand ça échoue.</li>"
            "<li><strong>Regarde les rôles.</strong> Un visiteur, un client, un administrateur : "
            "qu'est-ce qu'un visiteur ne devrait pas pouvoir voir ?</li>"
            "<li><strong>Regarde les entrées.</strong> Chaque formulaire envoie quelque chose : "
            "que se passe-t-il si ce n'est pas ce qu'on attend ?</li>"
            "<li><strong>Regarde ce qui est exposé.</strong> Les messages d'erreur, les fichiers "
            "laissés sur le serveur, les pages oubliées.</li>"
            "</ol>"
            "<p><strong>À retenir :</strong> une application mal testée est d'abord une application "
            "mal <em>comprise</em>. La faille est souvent dans une zone que personne n'a "
            "prise la peine de regarder.</p>"
        ),
        'practice': [
            q(
                "Par quoi commencer pour tester une application web ?",
                [
                    "Par un scanner automatique",
                    "Par une lecture attentive de l'application : ses fonctions, ses rôles, ses entrées",
                    "Par l'envoi de beaucoup de requêtes",
                    "Par le code source, s'il est disponible",
                ],
                1,
                "Avant de lancer quoi que ce soit, qu'est-ce qu'on comprend ?",
                "Le scanner trouve des anomalies que l'application a oubliées ; l'humain comprend les fonctions. L'ordre compte : comprendre d'abord, puis tester.",
            ),
            q(
                "Quel est l'intérêt d'essayer l'application avec un compte « simple » puis un compte « administrateur » ?",
                [
                    "Pour aller plus vite",
                    "Pour voir ce que le rôle simple ne devrait pas voir : c'est là que se logent les défauts d'autorisation",
                    "Pour occuper le compte",
                    "Pour tester le navigateur",
                ],
                1,
                "Un test, c'est une comparaison.",
                "Le rôle simple sert de référence : tout ce qu'il voit, tout le monde devrait le voir. Tout ce qu'il voit en plus, c'est un défaut d'autorisation à documenter.",
            ),
        ],
        'exam': [
            q(
                "Un message d'erreur détaillé (chemin du fichier, version de la library) est-il un problème ?",
                [
                    "Non, c'est utile pour l'utilisateur",
                    "Oui : il donne à l'attaquant une carte de l'application (technologies, arborescence, versions)",
                    "Non, si le site est en HTTPS",
                    "Non, tant qu'aucun secret n'apparaît",
                ],
                1,
                "Une erreur trop bavarde est une fuite d'information.",
                "Le message d'erreur détaillé est un classique de l'OWASP : il facilite l'exploitation. En production, on montre un message générique et on garde le détail dans les journaux, côté serveur.",
            ),
            q(
                "Quelle est la différence entre une faille et une mauvaise configuration ?",
                [
                    "Aucune, c'est la même chose",
                    "La faille est un bug du code ; la mauvaise configuration est un réglage qui laisse une porte ouverte alors que le code est correct",
                    "La configuration se corrige plus vite",
                    "La faille est toujours plus grave",
                ],
                1,
                "Un côté code, un côté réglages.",
                "Les deux sont des portes, mais pas de la même nature : l'une se corrige dans le code, l'autre dans les fichiers de configuration ou dans les règles d'accès. Un audit les cherche toutes les deux.",
            ),
        ],
        'video': {
            'id': 'Xf162olFpfo',
            'title': 'Exploring Web Application Security with OWASP Juice Shop',
            'channel': CH_JOE,
            'institution': INST_JOE,
            'license': LIC_JOE,
            'duration': '4:23',
            'note': "Brief 6 : explorer une application web (démonstration de Joe Ma).",
        },
        'mission': {
            'question': "Relève la valeur du brief 6 (explorer une application web).",
            'flag_path': '/root/flags/flag-b06.txt',
            'hint': "Les briefs sont dans <code>/srv/briefs</code>.",
            'explain': "Même mécanique : une preuve lue dans la machine, comparée par le serveur en root.",
        },
    },
]


def room_brief(brief):
    """Fabrique une room de brief."""

    return {
        'title': brief['titre'],
        'excerpt': brief['excerpt'],
        'content': brief['contenu'],
        'difficulty': 'facile',
        'duration': 20,
        'xp_bonus': 30,
        'track': 'avance',
        'lab': LAB_DOJO,
        'video': brief['video'],
        'lesson_title': 'Task 1 : Leçon — ' + brief['titre'].split(':', 1)[-1].strip(),
        'lesson': brief['resume'],
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': "<p>Deux questions pour vérifier que le brief est passé.</p>",
        'practice': brief['practice'],
        'mission_title': 'Task 3 : La mission — la preuve du brief',
        'mission': {
            'prompt': (
                "<p>Le brief est écrit dans la machine du dojo, dans "
                "<code>/srv/briefs/{0}</code>.</p>"
                "<p><strong>Mission.</strong> Ouvre ce document et relève la valeur qu'il annonce. "
                "Le serveur la compare au drapeau qu'il garde en root.</p>"
            ).format(brief['fichier']),
            'question': brief['mission']['question'],
            'flag_path': brief['mission']['flag_path'],
            'xp': 20,
            'hint': brief['mission']['hint'],
            'explain': brief['mission']['explain'],
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': "<p>Deux questions sur ce brief. 60 % suffisent pour valider.</p>",
        'exam': brief['exam'],
        'i18n': {
            'ar': {
                'title': brief['ar_titre'],
                'excerpt': brief['ar_excerpt'],
                'tasks': [
                    'المهمة 1: الدرس — ' + brief['ar_titre'].split(':', 1)[-1].strip(),
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — دليل الموجز',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': brief['en_titre'],
                'excerpt': brief['en_excerpt'],
                'tasks': [
                    'Task 1: Lesson - ' + brief['en_titre'].split(':', 1)[-1].strip(),
                    'Task 2: Practice',
                    'Task 3: Mission - the proof of the brief',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    }


BRIEF_ROOMS = [room_brief(brief) for brief in BRIEFS]


# ---------------------------------------------------------------------------
# La room Kahoot : la révision jouable en classe
# ---------------------------------------------------------------------------

KAHOOT_QUESTIONS = [
    q(
        "Qu'est-ce qu'un modèle de menace ?",
        [
            "La liste des failles connues d'un produit",
            "La phrase qui relie ce qu'on protège, qui est l'adversaire et ce qu'il est capable de faire",
            "Le plan de test d'une application",
            "La liste des serveurs de l'entreprise",
        ],
        1,
        "Trois questions, une phrase.",
        "Le modèle de menace est la base de toute sécurité : on part de ce qu'on protège et de ce que l'adversaire peut faire, puis on en déduit les mécanismes. Sans lui, on protège au hasard.",
    ),
    q(
        "Que vaut un mot de passe long et prévisible ?",
        [
            "Moins qu'un mot de passe court et compliqué",
            "Autant, si le site est bien protégé",
            "Plus qu'un mot de passe court et compliqué",
            "Rien : la longueur ne compte pas",
        ],
        2,
        "Le nombre de combinaisons à tester.",
        "La force se mesure en nombre d'essais. Un mot de passe long multiplic les combinaisons à tester : « chat1234 » (8 caractères) se trouve en quelques heures sur une machine, « Correct-Cheval-Batterie-9 » (24) demandera des années.",
    ),
    q(
        "Une injection SQL, c'est…",
        [
            "Un virus qui infecte la base",
            "Un code qui s'insère dans la requête SQL parce que la donnée n'est pas séparée du code",
            "Un trop grand nombre de connexions",
            "Une sauvegarde de la base",
        ],
        1,
        "Donnée et code mélangés.",
        "L'injection vient de l'absence de séparation : la donnée de l'utilisateur est concaténée dans la requête. Elle devient alors du code SQL — et peut lire, écrire, ou supprimer.",
    ),
    q(
        "Quel est le rôle d'un pare-feu ?",
        [
            "Rendre le réseau plus rapide",
            "Appliquer une politique : qui a le droit de passer, et vers où",
            "Chiffrer les données en transit",
            "Supprimer les virus",
        ],
        1,
        "Une politique de passage.",
        "Le pare-feu est une règle de filtrage. Il ne chiffre rien et il ne nettoie rien : il applique une politique de flux. Une règle mal écrite laisse passer ce qu'elle devait bloquer.",
    ),
    q(
        "Le « moindre privilège », c'est…",
        [
            "Donner tous les droits à l'administrateur",
            "Ne donner à un service que les droits dont il a besoin",
            "Créer un seul compte pour toute l'entreprise",
            "Fermer tous les ports",
        ],
        1,
        "Juste ce qu'il faut, et pas plus.",
        "Un service qui tourne avec trop de droits transforme un bug en catastrophe. Le moindre privilège coûte peu à mettre en place et limite l'impact d'une compromission.",
    ),
    q(
        "Une XSS, c'est…",
        [
            "Un mot de passe en clair dans une base",
            "Du code exécuté dans le navigateur d'un visiteur, à cause d'une donnée non échappée",
            "Un serveur qui ne répond plus",
            "Un site qui charge lentement",
        ],
        1,
        "Le script voyage avec la donnée.",
        "XSS = Cross-Site Scripting : l'application réinjecte une donnée dans sa page sans l'échapper, et le navigateur exécute le code. Conséquence : voler une session, ou agir au nom de la victime.",
    ),
    q(
        "Que prouve le certificat TLS ?",
        [
            "Que le site est rapide",
            "À qui on parle : la clé publique est bien liée à ce nom de domaine",
            "Que le site est de bonne qualité",
            "Que le mot de passe est fort",
        ],
        1,
        "L'identité du serveur.",
        "Le chiffrement protège de l'écoute ; le certificat protège de l'usurpation. Les deux sont nécessaires : HTTPS sans certificat vérifié ne protège que du réseau, pas de l'intermédiaire.",
    ),
    q(
        "Le hachage (hash) d'un mot de passe est…",
        [
            "Réversible avec la bonne clé",
            "À sens unique : on le recalcule pour vérifier",
            "Réversible avec le nom de l'utilisateur",
            "Trop lent pour être utile",
        ],
        1,
        "On ne relit pas une empreinte.",
        "La fonction de hachage est à sens unique. On vérifie un mot de passe en recalculant son empreinte et en comparant — d'où le sel, pour que deux comptes ayant le même mot de passe n'aient pas la même empreinte.",
    ),
    q(
        "Comment se protéger de l'hameçonnage ?",
        [
            "En vérifiant soigneusement chaque message",
            "En allant sur le site en tapant son adresse, sans passer par le lien du message",
            "En ne répondant jamais",
            "En installant un antivirus",
        ],
        1,
        "Ne passe pas par le lien.",
        "La vérification manuelle est faillible : un message bien écrit trompe tout le monde. La parade la plus efficace est mécanique : saisir l'adresse soi-même, ou appeler le service par un numéro connu.",
    ),
    q(
        "Un débordement de tampon exploité, c'est…",
        [
            "Un programme qui plante",
            "L'écriture au-delà du tampon, qui écrase l'adresse de retour et fait sauter l'exécution ailleurs",
            "Une erreur de compilation",
            "Un disque plein",
        ],
        1,
        "Ce qui suit le tampon en mémoire.",
        "C'est la leçon 3 du cours 6.858 : le programme ne vérifie pas la taille de l'entrée. En écrasant l'adresse de retour, l'attaquant choisit où le programme va continuer. D'où les défenses : canari, NX, ASLR.",
    ),
]


KAHOOT_ROOM = {
    'title': "Kahoot : la révision des labs avancés",
    'excerpt': "Le même contenu, jouable en classe (avec Kahoot) ou seul dans la plateforme (sans compte).",
    'content': "Room de révision : dix questions sur les labs avancés. En classe, on peut lancer le quiz Kahoot (le code est donné) ; seul, on répond aux dix questions ici.",
    'difficulty': 'facile',
    'duration': 20,
    'xp_bonus': 40,
    'track': 'avance',
    'lab': LAB_DOJO,
    'video': {
        'id': 'LEC0r-v2EtU',
        'title': "Don't Get Tricked! K-2 Cybersecurity Basics Lesson",
        'channel': CH_CYBER,
        'institution': INST_CYBER,
        'license': LIC_CYBER,
        'duration': '6:06',
        'note': "Rappel : le réflexe d'hygiène numérique avant de commencer (CYBER.ORG).",
    },
    'kahoot': {
        'title': 'Quiz Kahoot — les labs avancés (10 questions)',
        'intro': "En classe : lance le quiz Kahoot et donne le code aux élèves. "
                 "Sans compte, sans installation : le même contenu est en bas, et les questions "
                 "peuvent être exportées en CSV pour un Kahoot maison ou un autre outil.",
        'link': 'https://kahoot.it/',
        'code': 'SECURA1',
    },
    'lesson_title': 'Task 1 : Leçon — comment on révise',
    'lesson': (
        "<p>Réviser, ce n'est pas relire : c'est <strong>répondre sans regarder</strong>.</p>"
        "<p>Le format de cette room est fait pour ça : dix questions, un minuteur, et une "
        "explication à chaque réponse — même quand c'est faux. En classe, on peut passer "
        "par Kahoot : même durée, même série de questions, et les élèves jouent avec leur "
        "téléphone. Sans compte Kahoot, la room fonctionne telle quelle.</p>"
        "<p><strong>À retenir :</strong> une erreur expliquée vaut mieux qu\'une bonne réponse "
        "sans raison. C\'est pour ça que chaque proposition erronée est commentée.</p>"
    ),
    'practice_title': 'Task 2 : Entraînement',
    'practice_intro': "<p>Deux questions pour se mettre en route.</p>",
    'practice': [
        q(
            "Quel est le meilleur moyen de mémoriser une notion de sécurité ?",
            [
                "La relire trois fois",
                "L'expliquer à quelqu'un d'autre, et vérifier ce qu'on a compris",
                "La recopier mot pour mot",
                "La regarder en vidéo une seconde fois",
            ],
            1,
            "Ce qui compte, c'est la restitution.",
            "Expliquer oblige à reconstituer la logique, et donc à repérer les trous. C'est pour ça que les salles de la plateforme expliquent chaque erreur : la répétition espacée fait le reste.",
        ),
        q(
            "À quoi sert un quiz en classe, en plus de noter ?",
            [
                "À classer les élèves",
                "À montrer tout de suite à chacun ce qu'il a raté, et à en discuter",
                "À occuper le temps",
                "À remplacer les cours",
            ],
            1,
            "Le quiz est un outil de discussion.",
            "Le valeur d'un quiz n'est pas la note : c'est le moment où chacun découvre son angle mort, et où la classe en discute. C'est exactement ce que fait la plateforme : l'explication est systématique.",
        ),
    ],
    'mission_title': 'Task 3 : La mission — la preuve de révision',
    'mission': {
        'prompt': (
            "<p>La révision a laissé une trace dans la machine du dojo : "
            "<code>/srv/briefs/07-revision.txt</code>.</p>"
            "<p><strong>Mission.</strong> Ouvre le document et relève la valeur annoncée.</p>"
        ),
        'question': "Relève la valeur du document de révision.",
        'flag_path': '/root/flags/flag-b07.txt',
        'xp': 20,
        'hint': "Le document est dans <code>/srv/briefs</code>.",
        'explain': "Même mécanique que partout ailleurs : une preuve lue dans la machine, comparée par le serveur en root.",
    },
    'exam_title': 'Task 4 : Examen de fin de room',
    'exam_intro': "<p>Les dix questions du quiz, chronométrées. 60 % suffisent pour valider.</p>",
    'exam': KAHOOT_QUESTIONS,
    'i18n': {
        'ar': {
            'title': 'كاهوت: مراجعة المخابر المتقدمة',
            'excerpt': 'نفس المحتوى، يُلعب في القسم (بكاهوت) أو وحدك في المنصة (بلا حساب).',
            'tasks': [
                'المهمة 1: الدرس — كيف نراجع',
                'المهمة 2: تدريب',
                'المهمة 3: المهمة — دليل المراجعة',
                'المهمة 4: امتحان نهاية الغرفة',
            ],
        },
        'en': {
            'title': 'Kahoot: reviewing the advanced labs',
            'excerpt': 'The same content, playable in class (with Kahoot) or alone on the platform (no account needed).',
            'tasks': [
                'Task 1: Lesson - how we review',
                'Task 2: Practice',
                'Task 3: Mission - the proof of the review',
                'Task 4: End-of-room exam',
            ],
        },
    },
}
