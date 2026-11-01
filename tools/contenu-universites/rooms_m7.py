# -*- coding: utf-8 -*-
"""M7 — Les labs avancés : Juice Shop, dojo, briefs et Kahoot.

Quatorze rooms qui ferment le bloc U :

* 2 rooms OWASP Juice Shop (l'application vulnérable officielle) ;
* 5 rooms de dojo (les cinq ceintures, quatre défis chacune) ;
* 6 rooms de brief (les six vidéos d'introduction des labs) ;
* 1 room Kahoot (le quiz de révision, exportable).

Les textes sont originaux. Les vidéos sont celles des institutions
(pwn.college, CYBER.ORG, Joe Ma), intégrées en façade et attribuées.
"""

# ---------------------------------------------------------------------------
# Outils de lecture
# ---------------------------------------------------------------------------


def q(question, choices, correct, hint, explain, xp=10):
    """Une question à quatre propositions."""

    return {
        'q': question,
        'choices': choices,
        'correct': correct,
        'xp': xp,
        'hint': hint,
        'explain': explain,
    }


LAB_JUICE = {
    'mode': 'compose',
    'compose': 'juice-shop/docker-compose.yml',
    'project': 'seca_juice',
    'flag_service': 'flags',
    'network': 'seca_lab',
    'workdir': '/home/ctf',
    'target': 'http://juice:3000',
    'ttl': 3600,
    'allow': ['ls', 'cat', 'grep', 'head', 'tail', 'wc', 'find', 'curl', 'python3', 'nc'],
}

LAB_DOJO = {
    'mode': 'single',
    'image': 'securalabs/dojo-01:1.0',
    'network': 'seca_lab',
    'command': 'sleep infinity',
    'workdir': '/home/ctf',
    'target': 'http://127.0.0.1:8080',
    'ttl': 3600,
    'allow': ['ls', 'cat', 'grep', 'head', 'tail', 'wc', 'find', 'file', 'stat', 'strings', 'sha256sum'],
}

CH_PWN = 'pwn.college (Arizona State University)'
LIC_PWN = 'Reutilisation non commerciale autorisee, avec attribution (pwn.college)'
INST_PWN = 'pwn.college - Arizona State University'

CH_CYBER = 'CYBER.ORG'
LIC_CYBER = 'Usage pedagogique avec attribution (CYBER.ORG)'
INST_CYBER = 'CYBER.ORG - Cyber Safety Series'

CH_JOE = 'Joe Ma'
LIC_JOE = 'Usage pedagogique avec attribution (Joe Ma)'
INST_JOE = 'Joe Ma - OWASP Juice Shop (demonstration)'

# ---------------------------------------------------------------------------
# 1. Les deux rooms Juice Shop
# ---------------------------------------------------------------------------

JUICE_ROOMS = [
    {
        'title': 'La boutique en ligne : se connecter en administrateur',
        'excerpt': 'Une vraie application web vulnérable, seule dans un réseau fermé. On ne la casse pas : on s\'y connecte proprement.',
        'content': 'Première room du lab Juice Shop : l\'application officielle de l\'OWASP, isolée. Objectif : se connecter en administrateur, et relever le code que l\'application affiche quand un défi est résolu.',
        'difficulty': 'moyen',
        'duration': 40,
        'xp_bonus': 60,
        'track': 'avance',
        'lab': LAB_JUICE,
        'video': {
            'id': 'nq-Igdk0o7s',
            'title': 'The How and Why of the OWASP Top Ten 2021 - Brian Glas',
            'channel': 'OWASP Foundation',
            'institution': 'OWASP Foundation',
            'license': 'CC BY-SA 4.0 - OWASP',
            'duration': '49:37',
            'note': "Le Top 10 de l'OWASP : la liste de référence que la boutique Juice Shop rejoue, un point à la fois.",
        },
        'lesson_title': 'Task 1 : Leçon — une application web, et ce qu\'elle révèle',
        'lesson': (
            '<p>Tu vas travailler sur <strong>OWASP Juice Shop</strong> : une application de commerce en ligne '
            'volontairement vulnérable, écrite par l\'OWASP et utilisée partout dans le monde pour '
            'apprendre à tester une application web. Elle tourne ici <em>seule</em> dans un réseau fermé : '
            'personne dehors ne peut la voir.</p>'
            '<p>Trois choses à comprendre avant de commencer :</p>'
            '<ul>'
            '<li><strong>Une application web, c\'est un serveur qui répond à des requêtes.</strong> '
            'Ton terminal parle au serveur (port 3000) comme un navigateur le ferait. '
            'Ce que tu tapes dans le formulaire de connexion part dans une requête HTTP.</li>'
            '<li><strong>Une injection SQL, c\'est une requête qui contient du code.</strong> '
            'Si le serveur colle naivement ce que tu écris dans sa requête SQL, '
            'tu ne « falsifies » pas la donnée : tu <em>écris</em> une autre requête. '
            'Là où il attend un identifiant, tu peux faire lire toute la table des comptes.</li>'
            '<li><strong>Une preuve vaut mieux qu\'une intuition.</strong> '
            'L\'application tient un tableau de défis. Quand tu en résous un, '
            'elle affiche un <em>code de drapeau</em> : c\'est ce code qu\'on va te demander.</li>'
            '</ul>'
            '<p><strong>À retenir :</strong> on n\'attaque pas une application « pour le plaisir ». '
            'On teste une <em>idée</em> — « et si ce champ n\'était pas validé ? » — '
            'et on note ce que la machine repond. C\'est exactement le travail d\'un testeur.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions avant de toucher à la boutique.</p>',
        'practice': [
            q(
                'Que se passe-t-il si le serveur utilise directement ce que tu écris dans un champ pour construire sa requête SQL ?',
                [
                    'La requête est refusée, la base est protégée',
                    'Tu peux modifier le sens de la requête : c\'est une injection SQL',
                    'Le serveur affiche un message d\'erreur plus détaillé',
                    'Le champ est automatiquement nettoyé, donc il n\'y a rien à faire',
                ],
                1,
                'Pense à ce qui se passerait si ton texte devenait une nouvelle instruction.',
                'Une injection SQL vient de l\'absence de séparation entre les données et le code. Si la valeur est concaténée dans la requête, elle peut fermer la quote et ajouter ses propres conditions. C\'est la faille numéro un de l\'OWASP Top 10 depuis des années.',
            ),
            q(
                'Dans Juice Shop, que gagne-tu en te connectant avec une injection dans le formulaire de connexion ?',
                [
                    'Un accès administrateur, qui ouvre la zone d\'administration',
                    'Le code source complet de l\'application',
                    'La base de données de production de l\'OWASP',
                    'Rien : les injections ne marchent que sur les pages d\'inscription',
                ],
                0,
                'Une injection qui marche dans un formulaire marche dans les autres.',
                'Le champ « e-mail » de la connexion est famously injectable : une condition toujours vraie transforme la requête en « renvoie le premier compte », et ce compte est un administrateur. La zone d\'administration devient alors accessible.',
            ),
        ],
        'mission_title': 'Task 3 : La mission — le code du défi « Login Admin »',
        'mission': {
            'prompt': (
                '<p>La boutique est déployée dans ton lab : l\'application répond sur '
                '<code>http://juice:3000</code>. Ton terminal est à côté.</p>'
                '<p><strong>Mission.</strong> Connecte-toi en administrateur sans connaître le mot de passe '
                '(c\'est une injection SQL), puis relève le <strong>code de drapeau</strong> que '
                'l\'application affiche quand le défi « Login Admin » est résolu. '
                'C\'est une suite de 40 caractères hexadécimaux : recopie-la exactement.</p>'
            ),
            'question': 'Recopie le code de drapeau affiché par l\'application quand le défi « Login Admin » est résolu.',
            'flag_path': '/root/flags/flag-login-admin.txt',
            'xp': 40,
            'hint': 'Dans le formulaire de connexion, un e-mail comme <code>\' OR 1=1--</code> transforme la condition de la requête. Le code apparaît dans la notification de l\'application, en bas à droite.',
            'explain': 'Le code affiché par Juice Shop est une empreinte calculée à partir du nom du défi et d\'une clé que nous fixons. Ce n\'est pas une invention : c\'est la preuve que le défi « Login Admin » est réellement résolu dans l\'application. Le serveur de la plateforme compare ta réponse au code qu\'il garde de son côté.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Trois questions sur ce que tu viens de faire. 60 % suffisent pour valider.</p>',
        'exam': [
            q(
                'Pourquoi tester une application dans un réseau fermé est-il une bonne pratique ?',
                [
                    'C\'est plus rapide, donc moins cher',
                    'On évite d\'atteindre un système réel qui n\'a rien demandé',
                    'Le réseau fermé rend les failles invisibles',
                    'C\'est la seule façon de voir le code source',
                ],
                1,
                'Qui a autorisé le test ?',
                'Tester une application sans autorisation, c\'est une intrusion, même si c\'est « pour apprendre ». Le lab est isolé, hors d\'Internet, et personne d\'autre n\'est concerné : c\'est la condition pour apprendre tranquillement.',
            ),
            q(
                'Une injection SQL qui renvoie « trop de résultats » indique quoi ?',
                [
                    'Que la base est trop grosse',
                    'Que la requête a été exécutée mais renvoie plusieurs lignes : l\'injection a fonctionné',
                    'Que le compte est banni',
                    'Que le mot de passe est trop long',
                ],
                1,
                'Relis la phrase : le nombre de résultats est-il normal ?',
                'Quand l\'injection fonctionne, la condition est vraie pour plusieurs comptes : le serveur en renvoie plusieurs. C\'est le symptôme typique, et c\'est ce qui permet de passer d\'un compte normal à un compte administrateur.',
            ),
            q(
                'Qu\'est-ce qui distingue un test d\'une attaque ?',
                [
                    'L\'intention, et l\'autorisation',
                    'La vitesse',
                    'Le nombre de machines touchées',
                    'L\'utilisation d\'un outil',
                ],
                0,
                'Le même geste peut être un test ou une attaque : qu\'est-ce qui change ?',
                'Un test part d\'une autorisation et s\'arrête à la démonstration. Une attaque n\'a ni l\'un ni l\'autre. C\'est pourquoi la plateforme insiste : on travaille sur une application qui nous attend, isolée, et la preuve se lit dans la machine.',
            ),
        ],
        'i18n': {
            'ar': {
                'title': 'المتجر الإلكتروني: الدخول كمسؤول',
                'excerpt': 'تطبيق ويب مصاب حقيقي، وحيد في شبكة مغلقة. لا نكسره: ندخله بطريقة سليمة.',
                'tasks': [
                    'المهمة 1: الدرس — تطبيق ويب وما يكشفه',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — رمز التحدي «Login Admin»',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'The online shop: logging in as administrator',
                'excerpt': 'A real vulnerable web application, alone in a closed network. We do not break it: we log in properly.',
                'tasks': [
                    'Task 1: Lesson - a web application and what it reveals',
                    'Task 2: Practice',
                    'Task 3: Mission - the code of the "Login Admin" challenge',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
    {
        'title': 'La zone administrateur : ce qu\'un administrateur voit',
        'excerpt': 'Une fois dans l\'espace administrateur, on découvre ce que la boutique cache : les commandes des clients, les signalements, les produits.',
        'content': 'Deuxième room Juice Shop : après avoir obtenu un accès administrateur, on regarde ce que ce compte donne — et on comprend pourquoi les comptes powerful sont la cible numéro un.',
        'difficulty': 'moyen',
        'duration': 40,
        'xp_bonus': 60,
        'track': 'avance',
        'lab': LAB_JUICE,
        'video': {
            'id': 'EA8-GuMZykg',
            'title': 'Real World Application Security - How to Test with OWASP',
            'channel': 'OWASP Foundation',
            'institution': 'OWASP Foundation',
            'license': 'CC BY-SA 4.0 - OWASP',
            'duration': '12:08',
            'note': "Comment tester une application web en conditions réelles (OWASP).",
        },
        'lesson_title': 'Task 1 : Leçon — le compte qui peut tout',
        'lesson': (
            '<p>Un compte administrateur, dans une application, ce n\'est pas « un compte plus gros ». '
            'C\'est un compte qui peut <strong>voir et modifier les données des autres</strong>.</p>'
            '<p>Dans Juice Shop, l\'espace administration montre :</p>'
            '<ul>'
            '<li>le <strong>catalogue des produits</strong> (et le moyen de le modifier) ;</li>'
            '<li>la <strong>liste des commandes</strong> des clients (donc leurs adresses) ;</li>'
            '<li>les <strong>signalements</strong> des utilisateurs ;</li>'
            '<li>la <strong>configuration</strong> de l\'application.</li>'
            '</ul>'
            '<p>Deux idées à retenir pour la suite :</p>'
            '<ol>'
            '<li><strong>Le vrai danger n\'est pas le compte, c\'est ce qu\'il permet.</strong> '
            'Un compte admin sur une boutique, c\'est l\'accès aux données de tous les clients.</li>'
            '<li><strong>Chaque écran d\'administration est un nouvel endroit à tester.</strong> '
            'On y trouve souvent des fonctions que personne n\'utilise, donc personne ne teste : '
            'c\'est exactement là que se cachent les failles (injection, XSS stockée, '
            'téléversement de fichier sans contrôle).</li>'
            '</ol>'
            '<p><strong>À retenir :</strong> un test ne s\'arrête pas à « je suis entré ». '
            'Il va jusqu\'à « voici ce que cet accès permet vraiment de faire ».</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions sur les comptes et les droits.</p>',
        'practice': [
            q(
                'Pourquoi dit-on souvent que « l\'administrateur n\'est pas un superutilisateur » ?',
                [
                    'Parce qu\'un administrateur a moins de droits qu\'un utilisateur',
                    'Parce qu\'un administrateur a des droits différents, qui ne sont pas « plus de droits » mais « d\'autres droits »',
                    'Parce qu\'un administrateur est un role a part, pas un superutilisateur',
                    'Parce que le mot « administrateur » est un mot-clé ancien',
                ],
                1,
                'Il ne s\'agit pas de quantité, mais de nature.',
                'Un compte administrateur n\'est pas « root » : il est administrateur *de l\'application*. Dans Juice Shop, il ne peut pas chiffrer ni supprimer le serveur : il peut modifier le catalogue et lire les commandes. La security est une affaire de contexte, pas de volume de droits.',
            ),
            q(
                'Un endpoint d\'administration oublié (non lié dans le menu) est-il dangereux ?',
                [
                    'Non, si personne ne le connaît',
                    'Oui : l\'absence de lien ne protège pas, et l\'URL se devine ou se trouve',
                    'Non, le serveur le désactive tout seul',
                    'Seulement s\'il accepte des fichiers',
                ],
                1,
                'Une porte sans poignée n\'est pas une porte fermée.',
                'C\'est une erreur classique : un endpoint d\'administration retiré de l\'interface mais toujours actif. Un routeur le discovery vite, et il reste actif pendant des mois. La règle : ce qui n\'est plus utilisé doit être désactivé, pas caché.',
            ),
        ],
        'mission_title': 'Task 3 : La mission — le code du défi « Admin Section »',
        'mission': {
            'prompt': (
                '<p>Toujours dans la boutique (toujours déployée dans ton lab). '
                'Cette fois, l\'objectif n\'est plus de se connecter, mais d\'<strong>atteindre la zone '
                'd\'administration</strong> et de la regarder.</p>'
                '<p><strong>Mission.</strong> Une fois dans l\'espace administration, relève le '
                '<strong>code de drapeau</strong> que l\'application affiche quand le défi '
                '« Admin Section » est résolu (40 caractères hexadécimaux).</p>'
            ),
            'question': 'Recopie le code de drapeau affiché par l\'application quand le défi « Admin Section » est résolu.',
            'flag_path': '/root/flags/flag-admin-section.txt',
            'xp': 40,
            'hint': 'Une fois connecté en administrateur, la zone d\'administration devient accessible. Le code arrive dans la notification de l\'application.',
            'explain': 'Atteindre l\'espace administration, c\'est un défaut d\'autorisation : l\'application a laissé passer une session qui ne devrait pas donner accès à ces écrans. Le code affiché est la preuve que l\'écran a réellement été atteint.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Trois questions sur les droits et les écrans d\'administration. 60 % suffisent.</p>',
        'exam': [
            q(
                'Que faut-il tester en priorité dans un espace d\'administration ?',
                [
                    'Le logo et les couleurs',
                    'Les fonctions qui existent mais ne sont pas utilisées au quotidien',
                    'Le nombre d\'utilisateurs connectés',
                    'La vitesse d\'affichage',
                ],
                1,
                'C\'est là que personne ne va regarder.',
                'Les fonctions rarement utilisées échappent aux tests : personne ne les utilise, donc personne ne les surveille. C\'est là que se logent les vulnérabilités les plus graves, parce que personne ne les répare.',
            ),
            q(
                'Le « moindre privilège », pour un compte d\'administration, veut dire :',
                [
                    'Donner tous les droits pour aller vite',
                    'Ne donner que les droits qui servent à la tâche, et retirer le reste',
                    'Donner les droits au premier qui demande',
                    'Supprimer tous les comptes',
                ],
                1,
                'Moins, mais juste ce qu\'il faut.',
                'Un compte qui peut tout peut être volé puis utilisé pour tout. Le moindre privilège ne coûte presque rien à mettre en place et évite qu\'un vol de compte devienne une catastrophe.',
            ),
            q(
                'Pourquoi la boutique est-elle un cas d\'école ?',
                [
                    'Parce qu\'elle vend des produits interestingly',
                    'Parce qu\'elle réunit dans une même application toutes les failles classiques du web',
                    'Parce que c\'est la plus grande boutique du monde',
                    'Parce que son code est public',
                ],
                1,
                'Regarde la liste des défis : elle ressemble à l\'OWASP Top 10.',
                'Juice Shop réunit dans une seule application des vulnérabilités de toutes catégories : injection, XSS, mots de passe faibles, erreurs de configuration. C\'est pourquoi elle est l\'outil d\'apprentissage le plus utilisé au monde.',
            ),
        ],
        'i18n': {
            'ar': {
                'title': 'منطقة المسؤول: ما يراه المسؤول',
                'excerpt': 'بعد الدخول إلى مساحة المسؤول، نكتشف ما تخفيه المتجر: طلبات الزبائن، الشكاوى، المنتجات.',
                'tasks': [
                    'المهمة 1: الدرس — الحساب الذي يملك كل شيء',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — رمز التحدي «Admin Section»',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'The administrator area: what an administrator sees',
                'excerpt': 'Once inside the admin area, we discover what the shop hides: customer orders, reviews, products.',
                'tasks': [
                    'Task 1: Lesson - the account that can do everything',
                    'Task 2: Practice',
                    'Task 3: Mission - the code of the "Admin Section" challenge',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
]


# ---------------------------------------------------------------------------
# Les quatorze rooms de M7
# ---------------------------------------------------------------------------

import rooms_m7_dojo
import rooms_m7_briefs

ROOMS = (
    JUICE_ROOMS
    + rooms_m7_dojo.ROOMS
    + rooms_m7_briefs.BRIEF_ROOMS
    + [rooms_m7_briefs.KAHOOT_ROOM]
)
