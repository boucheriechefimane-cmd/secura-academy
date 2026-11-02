# -*- coding: utf-8 -*-
"""CYBER.ORG : quatre rooms (hygiene numerique, ages 11-14).

Source : CYBER.ORG (Cyber Safety Series). Usage pedagogique avec attribution.
Textes originaux.
"""

CH = 'CYBER. ORG'
LIC = 'Usage pedagogique avec attribution (CYBER.ORG)'
INST = 'CYBER.ORG'

ROOMS = [
    {
        'title': 'Mots de passe : la longueur bat la complexité',
        'excerpt': 'Pourquoi « trois mots sans lien » est plus fort, plus sûr et plus facile à retenir que « P@ssw0rd! ».',
        'content': 'Le premier réflexe de cyber-hygiène : un mot de passe long, unique, et rangé dans un gestionnaire.',
        'difficulty': 'facile',
        'duration': 25,
        'xp_bonus': 35,
        'video': {
            'id': 'OiQKZWNeAjc',
            'title': 'Making Strong Passwords - Cyber Safety Series',
            'channel': CH,
            'institution': INST,
            'license': LIC,
            'duration': '1:53',
            'note': 'Vidéo de l\'université (CYBER.ORG). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — le mot de passe qui résiste',
        'lesson': (
            '<p>Un mot de passe, c\'est une <em>clé</em>. On ne la choisit pas pour qu\'elle soit aesthetics : '
            'on la choisit pour qu\'elle résiste. Trois règles, et le reste est de la décoration.</p>'
            '<ol>'
            '<li><strong>La longueur d\'abord.</strong> Chaque caractère ajouté multiplie le nombre de combinaisons. '
            'Quatre mots sans lien (« pêche verteocode porte bicycle ») se retiennent <em>et</em> résistent, '
            'alors qu\'un mot compliqué se devine par dictionnaire en quelques secondes.</li>'
            '<li><strong>L\'unicité ensuite.</strong> Un mot de passe réutilisé sur deux sites, c\'est deux sites '
            'qui peuvent être cambriolés avec le même passe. Le mot de passe du forum de jeux est devenu la clé de ta boîte mail.</li>'
            '<li><strong>Le rangement, enfin.</strong> Un gestionnaire de mots de passe (celui du navigateur, '
            'ou un logiciel dédié) crée un mot de passe différent pour chaque site et ne les retient qu\'à ta place. '
            'Il ne faut plus se souvenir : il faut savoir où c\'est.</li>'
            '</ol>'
            '<p>Et les réflexes d\'hygiène autour : ne jamais réutiliser le mot de passe d\'un autre compte, '
            'changer dès qu\'on a un doute (un service qui a été cambriolé), '
            'et vérifier qu\'un mot de passe n\'a pas fuité (un service qui le demande à l\'inscription est déjà en train de le stocker).</p>'
            '<p><strong>À retenir :</strong> la longueur est une technique, pas un caprice. '
            'Un mot de passe long, unique et rangé est imbattable — même s\'il a l\'air moins « fort ».</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions : le bon réflexe et le piège classique.</p>',
        'practice': [
            {
                'q': 'Quel mot de passe résiste le mieux à une attaque par dictionnaire ?',
                'choices': [
                    '« Basketball2024! » (un mot du dictionnaire + un année)',
                    '« jeep-orage-lanterne-cerisier » (quatre mots sans lien)',
                    '« Xz!7@qP » (huit caractères illisibles)',
                    '« monchat » (on ne devine jamais un animal)',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Une attaque par dictionnaire teste des mots, pas des phrases.',
                'explain': 'Les outils de cassage testent des millions de mots et de variantes. Quatre mots sans lien ne figurent dans aucun dictionnaire : c\'est la longueur et le hasard qui protègent, pas les symboles.',
            },
            {
                'q': 'Tu constates que le même mot de passe sert sur un forum de jeux et sur ta messagerie. Que faut-il faire ?',
                'choices': [
                    'Ne rien faire : c\'est le même mot de passe, donc c\'est cohérent',
                    'Changer d\'abord sur le compte le plus important, puis sur tous les autres, avec un mot de passe unique par site',
                    'Ajouter un chiffre à la fin partout',
                    'Envoyer un message aux amis pour qu\'ils changent aussi',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le compte le plus important est le plus exposé s\'il est cambriolé.',
                'explain': 'On commence par le compte le plus critique (messagerie, banque), puis on migre tous les autres vers des mots de passe uniques. Ajouter « 1 » à la fin ne change rien : c\'est la réutilisation qu\'il faut supprimer.',
            },
        ],
        'mission_title': 'Task 3 : La mission — la fiche des mots de passe',
        'mission': {
            'prompt': (
                '<p>Dans la salle des cours, l\'équipe a laissé une <em>fiche de passwords</em> '
                '(la fiche d\'hygiène de l\'atelier CYBER.ORG).</p>'
                '<p><strong>Mission.</strong> Lis cette fiche et relève la <em>valeur de la longueur minimale '
                'recommandée</em> en caractères (champ <code>min_length</code>).</p>'
            ),
            'question': 'Releve la longueur minimale de mot de passe (min_length) indiquee dans la fiche d\'hygiene.',
            'flag_path': '/root/flags/flag-u14.txt',
            'xp': 30,
            'hint': 'La fiche est dans <code>/srv/cours/cyber</code> : liste le dossier puis lis le fichier.',
            'explain': 'Une longueur minimale écrite dans une fiche, c\'est une règle qu\'on peut appliquer à un compte : c\'est ainsi que l\'hygiène devient une habitude.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Pourquoi « P@ssw0rd! » est-il moins sûr que « lama-velo-pluie-9 » ?',
                'choices': [
                    'Parce qu\'il contient un caractère spécial',
                    'Parce qu\'il est court et prévisible : les outils de cassage le testent en quelques secondes',
                    'Parce qu\'il contient des majuscules',
                    'Parce qu\'il est difficile à taper',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Les outils de cassage ne devinent pas au hasard : ils suivent des règles.',
                'explain': '« Password » + année + substitution de caractères est un des premiers motifs testés par les outils de cassage. La longueur d\'une phrase aléatoire, elle, n\'est dans aucun modèle.',
            },
            {
                'q': 'À quoi sert un gestionnaire de mots de passe ?',
                'choices': [
                    'À rendre les mots de passe plus courts',
                    'À créer et mémoriser un mot de passe unique par site, sans qu\'on ait à s\'en souvenir',
                    'À envoyer les mots de passe à la banque',
                    'À partager les mots de passe entre amis',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le problème n\'est pas de se souvenir, c\'est de ne pas réutiliser.',
                'explain': 'Le gestionnaire déplace la charge : on ne se souvient plus, on sait où c\'est. Chaque site reçoit un mot de passe différent, donc un vol de données n\'ouvre qu\'un compte.',
            },
            {
                'q': 'Un service te demande de choisir un mot de passe <em>avant</em> de créer le compte, et ne te laisse jamais le voir après. Est-ce un problème ?',
                'choices': [
                    'Non, c\'est normal',
                    'Oui, ça peut cacheter une mauvaise pratique : demander le mot de passe en clair empêche de le hacher correctement',
                    'Non, seulement si le service est en anglais',
                    'Oui, parce que le mot de passe doit contenir des chiffres',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Un bon service ne doit jamais avoir besoin de connaître ton mot de passe.',
                'explain': 'Un service qui veut te Connecter doit stocker un hash salé, pas le mot de passe. S\'il te le demande, il ne peut pas le hacher de façon fiable : c\'est un signal d\'alerte à vérifier.',
            },
            {
                'q': 'Quelle est la meilleure règle quand on hésite entre deux mots de passe ?',
                'choices': [
                    'Choisir celui qui est plus court, c\'est plus pratique',
                    'Choisir le plus long et le plus unique, même s\'il faut le noter au début',
                    'Choisir celui qui ressemble à un mot du dictionnaire, c\'est plus mémorable',
                    'Alterner majuscules et minuscules',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'La commodité a un coût ; le coût se paie plus tard.',
                'explain': 'La longueur et l\'unicité protègent ; la commodité fait perdre une minute. Le bon réflexe : le plus long, et un gestionnaire pour ne pas s\'en souvenir.',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'كلمات المرور: الطول أقوى من التعقيد',
                'excerpt': 'لماذا « ثلاث كلمات غير مترابطة » أقوى وأسلم وأسهل حفظًا من « P@ssw0rd! ».',
                'tasks': [
                    'المهمة 1: الدرس — كلمة المرور التي تصمد',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — ورقة كلمات المرور',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'Passwords: length beats complexity',
                'excerpt': 'Why "three unrelated words" is stronger, safer and easier to remember than "P@ssw0rd!".',
                'tasks': [
                    'Task 1: Lesson - the password that holds up',
                    'Task 2: Practice',
                    'Task 3: Mission - the password sheet',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
    {
        'title': 'Hameçonnage : lire un message avant de cliquer',
        'excerpt': 'Le hameçonnage ne se-rate pas : il se repère. Quatre signaux à vérifier en trente secondes.',
        'content': 'Le réflexe CYBER.ORG : ralentir, lire l\'adresse, vérifier qui envoie, se méfier de l\'urgence.',
        'difficulty': 'facile',
        'duration': 25,
        'xp_bonus': 35,
        'video': {
            'id': '08oJtFFH6a0',
            'title': 'Phishing - Cyber Safety Series',
            'channel': CH,
            'institution': INST,
            'license': LIC,
            'duration': '2:28',
            'note': 'Vidéo de l\'université (CYBER.ORG). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — les quatre signaux',
        'lesson': (
            '<p>Un message qui veut te faire agir vite est suspect par nature. '
            'L\'hameçonnage (phishing) est une <em>usine à mensonges</em> : '
            'un faux message qui imite une banque, une école, un service de livraison, '
            'pour obtenir un mot de passe, un code ou un clic qui installe un logiciel.</p>'
            '<p>Quatre signaux, à vérifier dans cet ordre :</p>'
            '<ol>'
            '<li><strong>L\'adresse réelle</strong> : on regarde le domaine, pas le nom affiché. '
            '« support@banque-secure.com » n\'est pas une banque. '
            'Les-domaines trompeur (remplacement de lettre, sous-domaine inattendu) sont le indice numéro un.</li>'
            '<li><strong>L\'urgence</strong> : « votre compte sera bloqué dans 24 h », « votre colis est en attente ». '
            'L\'urgence est un levier : elle court-circuite ta prudence. Une vraie banque ne menace pas par SMS.</li>'
            '<li><strong>La demande inhabituelle</strong> : demander un mot de passe, un code de validation ou un paiement '
            'par message, c\'est <em>toujours</em> suspect. Les codes de validation, par définition, ne se partagent jamais.</li>'
            '<li><strong>L\'incohérence</strong> : un ton inhabituel, une faute, un logo mal copié, '
            'un lien qui ne va pas là où il dit aller (survoler le lien avant de cliquer).</li>'
            '</ol>'
            '<p>La parade : <strong>ne jamais cliquer dans le message</strong>. '
            'Ouvrir le site en tapant l\'adresse soi-même, ou appeler le service par un numéro connu. '
            'Et si un message Creates de la panique, c\'est justement le moment de ralentir.</p>'
            '<p><strong>À retenir :</strong> la technique des pirates, ce n\'est pas la technique : c\'est l\'urgence. '
            'Apprendre à la voir, c\'est savoir s\'arrêter.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions : reconnaître, et réagir.</p>',
        'practice': [
            {
                'q': 'Tu reçois « Votre colis est bloqué,_regularisez dans 2 h : http://livraison-colis-urgent.xyz/paiement ». Que faut-il faire en premier ?',
                'choices': [
                    'Cliquer et payer les frais, le colis est peut-être vraiment bloqué',
                    'Ne pas cliquer : ouvrir le site du transporteur en tapant son adresse, ou appeler le numéro officiel',
                    'Transmettre le message à un ami pour demander son avis',
                    'Répondre au message pour demander de combien il s\'agit',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le message ne doit jamais être le chemin pour aller sur le site.',
                'explain': 'La règle : on ne passe jamais par le lien reçu. On va sur le site par l\'adresse connue, ou on appelle le numéro officiel. Le lien, lui, peut mener n\'importe où — et l\'urgence est exactement le piège.',
            },
            {
                'q': 'Un site te demande un code de validation par SMS pour « confirmer » une connexion. Que faut-il en penser ?',
                'choices': [
                    'C\'est une demande normale de double authentification',
                    'C\'est une tentative de vol : un code de validation ne se communique jamais, à personne',
                    'C\'est une preuve que le site est sérieux',
                    'Il faut le donner si le nom du site est correct',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'À qui appartient le code que tu reçois ?',
                'explain': 'Le code que tu reçois par SMS t\'authentifie, toi. Le donner à quelqu\'un lui permet de se connecter à ta place. C\'est l\'arnaque de base du hameçonnage ciblé.',
            },
        ],
        'mission_title': 'Task 3 : La mission — l\'exemple d\'hameçonnage',
        'mission': {
            'prompt': (
                '<p>Dans la salle des cours, l\'atelier CYBER.ORG a laissé un <em>exempleannotated</em> '
                'd\'un message d\'hameçonnage (le message d\'exercice, avec ses annotations).</p>'
                '<p><strong>Mission.</strong> Lis cet exemple et relève la <em>valeur du signal</em> '
                'indiqué comme le principal indice de l\'arnaque (champ <code>main_signal</code>, '
                'un mot en anglais : urgency, sender, link ou spelling).</p>'
            ),
            'question': 'Releve le signal principal (main_signal) indique dans l\'exemple de message d\'hameconnage.',
            'flag_path': '/root/flags/flag-u15.txt',
            'xp': 30,
            'hint': 'L\'exemple est dans <code>/srv/cours/cyber</code> : liste puis lis les fichiers.',
            'explain': 'Savoir nommer le signal principal, c\'est savoir regarder un message desconocido avec une grille, au lieu de réagir à l\'émotion.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Quel est le meilleur réflexe face à un message qui réclame une action urgente ?',
                'choices': [
                    'Répondre pour savoir de quoi il s\'agit',
                    'Prendre le temps : vérifier l\'adresse, l\'expéditeur, et aller sur le site par soi-même',
                    'Cliquer : les messages urgents sont rares, donc c\'est forcément légitime',
                    'Transférer à tout le monde',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'L\'urgence est un levier, pas une information.',
                'explain': 'L\'urgence sert à empêcher la vérification. Le bon réflexe, c\'est la pause : on vérifie l\'adresse réelle, l\'expéditeur, et on accède au service par ses propres moyens.',
            },
            {
                'q': 'Pourquoi l\'adresse du lien est-elle plus fiable que le nom affiché ?',
                'choices': [
                    'Parce que le nom affiché est toujours en anglais',
                    'Parce que le nom affiché se copie à volonté, alors que le domaine réel est enregistré et traçable',
                    'Parce que les liens sont toujours plus courts',
                    'Parce que le navigateur le montre en plus grand',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Que peut-on faire avec un nom affiché ? Rien. Avec un domaine ?',
                'explain': 'Le nom « affiché » est un texte libre : « MaBanque » se tape en une seconde. Le domaine, lui, s\'enregistre : c\'est là qu\'on peut voir « banque-officiielle-secure.ru » et comprendre.',
            },
            {
                'q': 'Un ami t\'envoie un lien vers un jeu, en disant « clique, c\'est drôle ». Quel est le risque ?',
                'choices': [
                    'Aucun : c\'est ton ami',
                    'Le compte de ton ami a pu être compromis : c\'est le rôle du message',
                    'Le lien est trop long',
                    'Ton ami viole la loi',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Un compte volé envoie des messages à ses contacts : c\'est un vecteur classique.',
                'explain': 'L\'identité de l\'expéditeur ne garantit rien : si le compte de ton ami est compromis, c\'est lui qui t\'écrit. D\'autre part, même un ami de confiance peut retransmettre un message piégé sans le savoir.',
            },
            {
                'q': 'Qu\'est-ce que le « smishing » ?',
                'choices': [
                    'Un type de hameçonnage par SMS',
                    'Un mot de passe troqué contre un produit',
                    'Une technique de chiffrement',
                    'Un jeu en ligne',
                ],
                'correct': 0,
                'xp': 10,
                'hint': 'C\'est le hameçonnage par SMS.',
                'explain': 'Le smishing est le hameçonnage par SMS : le message passe par le téléphone, donc il parle directement à l\'habitude. Le vishing, c\'est la même chose par téléphone.',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'التصيّد: اقرأ الرسالة قبل النقر',
                'excerpt': 'التصيّد لا يخطئ الخطأ: يمكن اكتشافه. أربع علامات للتحقق في ثلاثين ثانية.',
                'tasks': [
                    'المهمة 1: الدرس — العلامات الأربع',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — مثال التصيّد',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'Phishing: read the message before you click',
                'excerpt': 'Phishing does not miss: it can be spotted. Four signals to check in thirty seconds.',
                'tasks': [
                    'Task 1: Lesson - the four signals',
                    'Task 2: Practice',
                    'Task 3: Mission - the phishing example',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
    {
        'title': 'Publier en ligne : ce que les autres voient de toi',
        'excerpt': 'Les réseaux sociaux ne montrent pas seulement ce que tu publies : ils montrent ce que tes contacts publient sur toi.',
        'content': 'La vidéo CYBER.ORG sur les réseaux sociaux : ce que tu|Partages, et ce que tu peux contrôler.',
        'difficulty': 'facile',
        'duration': 25,
        'xp_bonus': 35,
        'video': {
            'id': '6iPKt6F64rc',
            'title': 'Social Media - Cyber Safety Series',
            'channel': CH,
            'institution': INST,
            'license': LIC,
            'duration': '2:04',
            'note': 'Vidéo de l\'université (CYBER.ORG). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — ce que tu publies, ce qu\'on publie sur toi',
        'lesson': (
            '<p>Publier en ligne, ce n\'est pas juste « mettre une photo ». '
            'Trois choses se jouent en même temps :</p>'
            '<ul>'
            '<li><strong>Ce que tu publies</strong> : photos, localisation, école, opinions. '
            'Ce qui est publié reste publié : un contenu peut être recopié, cité, ou ressorti des années plus tard.</li>'
            '<li><strong>Ce que les autres publient sur toi</strong> : une photo de toi à une fête, '
            'une mention, un like sur une photo de groupe. '
            'Les autres ont le droit de poster, même ce que tu aurais garder pour toi.</li>'
            '<li><strong>Ce que la plateforme en sait</strong> : ce que tu regardes, '
            'tes recherches, ta position, le temps passé. '
            'Les réglages de confidentialité existent, mais ils changent souvent : il faut les vérifier, pas supposer.</li>'
            '</ul>'
            '<p>Les réflexes utiles :</p>'
            '<ol>'
            '<li><strong>Réfléchir avant de publier</strong> : la règle des trois questions — '
            'est-ce que ça me concerne encore dans cinq ans ? est-ce que j\'aimerais que ma famille le voie ? '
            'est-ce que je peux l\'expliquer à un recruteur ?</li>'
            '<li><strong>Vérifier les réglages</strong> : liste d\'amis, localisation, '
            'qui peut commenter, qui peut t\'ajouter. Les valeurs par défaut sont souvent larges.</li>'
            '<li><strong>Limiter les traces</strong> : ne pas publier d\'adresse complète, '
            'pas de photo de badge, pas d\'info sur tes horaires.</li>'
            '<li><strong>Signaler et partir</strong> : face à du harcèlement ou à une menace, '
            'on bloque, on signale, on garde des preuves, et on ne répond pas.</li>'
            '</ol>'
            '<p><strong>À retenir :</strong> sur un réseau social, tu ne publies pas seulement : '
            'tu rends public ce que les autres disent de toi. C\'est le sens de « visibility ».</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions : ce que tu publies, ce que tu exposes.</p>',
        'practice': [
            {
                'q': 'Un ami poste une photo de toi à une soirée sur un compte public. Que peux-tu faire ?',
                'choices': [
                    'Rien : c\'est sa photo, il a le droit',
                    'Demander la suppression, signaler le contenu si besoin, garder une copie de la preuve, et ajuster tes réglages de confidentialité',
                    'Publier la même photo en retour',
                    'Changer de mot de passe',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'C\'est ton image : tu as des leviers, et il faut les utiliser vite.',
                'explain': 'Tu peux demander la suppression (souvent elle suffit), signaler, et surtout garder une preuve (capture, lien, date) : c\'est ce qui sert si la situation s\'aggrave. En parallèle, on durcit ses réglages pour la prochaine fois.',
            },
            {
                'q': 'Pourquoi publier la localisation en direct pendant un voyage est-il déconseillé ?',
                'choices': [
                    'Parce que cela consomme des données',
                    'Parce que cela indique à des inconnus où tu te trouves, précisément quand tu es seul',
                    'Parce que les téléphones s\'éteignent',
                    'Parce que les photos de voyage ne sont jamais autorisées',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Qui lit l\'information ?',
                'explain': 'La localisation en direct est une invitation. Les cambriolages et les embuscades commencent souvent par une information de ce type. Le bon réflexe : publier après, pas pendant.',
            },
        ],
        'mission_title': 'Task 3 : La mission — la charte de publication',
        'mission': {
            'prompt': (
                '<p>Dans la salle des cours, l\'atelier a laissé la <em>charte de publication</em> '
                'des réseaux sociaux (les règles de l\'atelier).</p>'
                '<p><strong>Mission.</strong> Lis cette charte et relève la <em>valeur du délai de publication</em> '
                'recommandé après un événement (champ <code>publish_delay_hours</code>).</p>'
            ),
            'question': 'Releve le delai de publication (publish_delay_hours) recommande dans la charte de publication.',
            'flag_path': '/root/flags/flag-u16.txt',
            'xp': 30,
            'hint': 'La charte est dans <code>/srv/cours/cyber</code>.',
            'explain': 'Un délai de publication, c\'est une règle simple qui évite beaucoup de problèmes : on laisse le temps à l\'information de se calmer avant de la partager.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Qu\'est-ce que la « visibilité » sur un réseau social ?',
                'choices': [
                    'La luminosité de l\'écran',
                    'Le nombre de personnes qui voient ce que vous publiez, vous ou vos contacts',
                    'La durée de vie d\'une publication',
                    'La taille de la photo',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'C\'est le paramètre qui décide de qui te voit.',
                'explain': 'La visibilité règle l\'audience : publique, « amis », « proches ». C\'est le premier réglage à vérifier sur chaque nouvelle plateforme.',
            },
            {
                'q': 'Pourquoi « je vais le supprimer après » n\'est pas une protection ?',
                'choices': [
                    'Parce que les réseaux sociaux sont lents',
                    'Parce que pendant ce temps, c\'est déjà recopié, capturé ou indexé',
                    'Parce que les photos ne peuvent pas être supprimées',
                    'Parce que les amis n\'ont pas le droit de voir',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Qui d\'autre peut avoir enregistré la capture ?',
                'explain': 'Un contenu publié est déjà recopiable : capture d\'écran, republication, moteur de recherche. La règle doit donc être « je ne publie pas ce que je ne veux pas voir circuler ».',
            },
            {
                'q': 'Face à un compte qui harcèle un ami, que faut-il faire en premier ?',
                'choices': [
                    'Répondre pour défendre son ami',
                    'Signaler, bloquer, et aider la victime à garder des preuves',
                    'Partager les captures pour que tout le monde voie',
                    'Ne rien faire : les.harceleurs s\'arrêtent vite',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Répondre nourrit souvent l\'attention du harceleur.',
                'explain': 'Signaler et bloquer coupe la diffusion, garder des preuves permet d\'agir ensuite (école, plateforme, éventuellement police). RépondreDeclare souvent l\'attaquant comme « winner ».',
            },
            {
                'q': 'Un questionnaire en ligne te demande le nom de ton établissement et ta date de naissance pour un « concours ». Que faire ?',
                'choices': [
                    'Répondre : ce n\'est que l\'école',
                    'Vérifier qui organise le questionnaire (site officiel, adresse de l\'établissement) avant de saisir des informations personnelles',
                    'Répondre avec de fausses informations',
                    'Demander à un ami de le faire à ta place',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Une information d\'établissement et de naissance suffit à identifier quelqu\'un.',
                'explain': 'Nom d\'établissement + date de naissance = une identité quasi complète. D\'autre part, « nom + date de naissance » est un couple très utilisé pour usurpation. Vérifier l\'organisateur, c\'est la base.',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'النشر على الإنترنت: ما يراه الآخرون عنك',
                'excerpt': 'الشبكات الاجتماعية لا تُظهر ما تنشره فقط: بل تُظهر ما ينشره جهاتك عنك.',
                'tasks': [
                    'المهمة 1: الدرس — ما تنشره وما تكشفه',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — ميثاق النشر',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'Posting online: what others see of you',
                'excerpt': 'Social networks do not only show what you post: they show what your contacts post about you.',
                'tasks': [
                    'Task 1: Lesson - what you post and what you expose',
                    'Task 2: Practice',
                    'Task 3: Mission - the publishing charter',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
    {
        'title': 'Hygiène numérique : le deuxième facteur',
        'excerpt': 'Un code à six chiffres ne protège que si personne ne peut le deviner : d\'où les listas de codes.',
        'content': 'La vidéo CYBER.ORG sur l\'authentification multifacteur : ce que le second facteur protège vraiment.',
        'difficulty': 'facile',
        'duration': 25,
        'xp_bonus': 35,
        'video': {
            'id': '-mdIH67HKqk',
            'title': 'Multi-factor Authentication - Cyber Safety Series',
            'channel': CH,
            'institution': INST,
            'license': LIC,
            'duration': '2:48',
            'note': 'Vidéo de l\'université (CYBER.ORG). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — les trois facteurs',
        'lesson': (
            '<p>Un facteur d\'authentification, c\'est une catégorie de preuve. Il y en a trois :</p>'
            '<ul>'
            '<li><strong>Ce que tu sais</strong> : un mot de passe, un PIN, la date de naissance.</li>'
            '<li><strong>Ce que tu as</strong> : ton téléphone, une clé USB, une carte à puce.</li>'
            '<li><strong>Ce que tu es</strong> : ton empreinte, ton visage, ton iris.</li>'
            '</ul>'
            '<p>L\'authentification multifacteur combine <strong>deux catégories différentes</strong>. '
            'C\'est ce qui compte : un second facteur qui est aussi « ce que tu sais » (un PIN) '
            'ne protège pas d\'un vol de mot de passe.</p>'
            '<p>Et là, la nuance qui fait la différence entre « activé » et « utile » :</p>'
            '<ul>'
            '<li><strong>Code reçu par SMS</strong> : utile contre le vol de mot de passe, mais le numéro peut être réattribué '
            'ou intercepté (SIM swap). Correct, mais perfectible.</li>'
            '<li><strong>Application d\'authentification</strong> (code à 6 chiffres qui change toutes les 30 secondes) : '
            'bien meilleur : rien ne transitera par le réseau.</li>'
            '<li><strong>Clé physique (FIDO2 / clé de sécurité)</strong> : la plus résistante, '
            'parce qu\'elle exige la présence physique de la clé et qu\'elle ne se laisse pas deviner.</li>'
            '</ul>'
            '<p>Et les deux règles qui restent : <strong>ne jamais partager un code</strong> '
            '(personne légitime ne te le demandera, jamais), et <strong>préférer l\'application à un SMS</strong> '
            'quand le service le propose.</p>'
            '<p><strong>À retenir :</strong> le deuxième facteur ne sert que s\'il vient d\'une autre catégorie '
            'que le mot de passe. Sinon, il ne bloque que les approximations grossières.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions : le bon facteur, et le mauvais réflexe.</p>',
        'practice': [
            {
                'q': 'Quel est le meilleur second facteur pour un compte de messagerie ?',
                'choices': [
                    'Un code reçu par SMS',
                    'Une application d\'authentification (code qui change) ou une clé de sécurité physique',
                    'Une question secrète : « quel était le nom de ton premier animal ? »',
                    'Un mot de passe plus long',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Ce qu\'on cherche, c\'est un facteur qui ne transite pas par le réseau.',
                'explain': 'L\'application d\'authentification et la clé FIDO2 sont les plus solides. Le SMS est correct maisinterceptable. La question secrète est presque toujours devinable ou trouvable en ligne : c\'est « ce que tu sais », donc pas un second facteur.',
            },
            {
                'q': 'Un service te demande le code reçu par SMS « pour vérifier que c\'est bien toi ». Que faut-il en faire ?',
                'choices': [
                    'Le donner : c\'est la procédure',
                    'Ne jamais le donner : un code reçu par SMS ne se communique à personne, et un service légitime n\'a pas besoin de le demander',
                    'Le donner seulement s\'il s\'agit de ta banque',
                    'L\'envoyer par mail à ton compte de secours',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Qui te demande de confirmer quelque chose ?',
                'explain': 'Le code prouve que c\'est TOI qui es connecté. Le donner à quelqu\'un, c\'est lui donner l\'accès. Un service légitime ne demande jamais ce code : il l\'a déjà, ou il t\'en envoie un nouveau.',
            },
        ],
        'mission_title': 'Task 3 : La mission — les facteurs de l\'atelier',
        'mission': {
            'prompt': (
                '<p>Dans la salle des cours, l\'atelier CYBER.ORG a laissé la <em>fiche des facteurs</em> '
                '(le document qui présente les trois catégories d\'authentification).</p>'
                '<p><strong>Mission.</strong> Lis cette fiche et relève la <em>valeur du nombre de facteurs '
                'recommandés</em> pour un compte sensible (champ <code>recommended_factors</code>).</p>'
            ),
            'question': 'Releve le nombre de facteurs (recommended_factors) recommande pour un compte sensible.',
            'flag_path': '/root/flags/flag-u17.txt',
            'xp': 30,
            'hint': 'La fiche des facteurs est dans <code>/srv/cours/cyber</code>.',
            'explain': 'Savoir combien de facteurs un compte sensible exige, c\'est savoir le niveau de protection qu\'on cherche à obtenir.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Qu\'est-ce qu\'un facteur d\'authentification ?',
                'choices': [
                    'Un mot de passe complexe',
                    'Une preuve d\'identité appartenant à une catégorie : ce que tu sais, ce que tu as, ce que tu es',
                    'Une question posée par le service client',
                    'Un code envoyé par mail',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le mot « facteur » renvoie à une catégorie, pas à un format.',
                'explain': 'Un facteur est une <em>catégorie</em> de preuve. La multifacteurisation consiste à en combiner deux de catégories différentes.',
            },
            {
                'q': 'Pourquoi un code SMS est-il considéré comme un second facteur plus faible qu\'une application ?',
                'choices': [
                    'Parce qu\'il est trop long',
                    'Parce qu\'il transite par le réseau et peut être intercepté ou détourné (SIM swap)',
                    'Parce qu\'il expire trop vite',
                    'Parce qu\'il n\'est pas chiffré de bout en bout',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Que se passe-t-il entre l\'antenne et ton téléphone ?',
                'explain': 'Le SMS passe par le réseau mobile : un transfert de numéro (SIM swap) ou une interception peut suffire. L\'application calcule le code sur l\'appareil : rien ne circule.',
            },
            {
                'q': 'Tu reçois un appel d\'un service qui demande le code SMS que tu viens de recevoir. Que fais-tu ?',
                'choices': [
                    'Tu le donnes : ils ont l\'information de ton compte',
                    'Tu raccroches et tu bloques le numéro : personne légitime ne demande ce code, et l\'appelant attendait justement que tu le donnes',
                    'Tu demandes leur adresse postale',
                    'Tu le donnes en le lisant à moitié',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le service sait déjà qu\'il t\'a envoyé un code : il n\'a pas besoin de le vérifier.',
                'explain': 'Un service qui t\'a envoyé un code sait qu\'il l\'a reçu. Il ne peut pas te le demander pour « vérifier » : c\'est la technique du vol de code par appel. On raccroche, on bloque, et on signale.',
            },
            {
                'q': 'Qu\'est-ce qui rend une clé de sécurité physique (FIDO2) si résistante ?',
                'choices': [
                    'Elle est très longue',
                    'Elle exige la présence physique de la clé et ne peut pas être devinée ni interceptée',
                    'Elle est chiffrée par le fabricant',
                    'Elle expire chaque année',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Ce n\'est pas la longueur qui la protège, c\'est ce qu\'elle exige.',
                'explain': 'La clé ne se laisse pas copier par un logiciel : la vérification se fait avec la clé physique, via un canal protégé de bout en bout. C\'est pourquoi le phishing-resistant MFA est considéré comme la référence.',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'النظافة الرقمية: العامل الثاني',
                'excerpt': 'رمز من ستة أرقام لا يحمي إلا إذا لم يستطع أحد تخمينه، ومن هنا تأتي قوائم الأكواد.',
                'tasks': [
                    'المهمة 1: الدرس — العوامل الثلاثة',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — عوامل الورشة',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'Digital hygiene: the second factor',
                'excerpt': 'A six-digit code only protects if nobody can guess it: hence the code lists.',
                'tasks': [
                    'Task 1: Lesson - the three factors',
                    'Task 2: Practice',
                    'Task 3: Mission - the workshop factors',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
]
