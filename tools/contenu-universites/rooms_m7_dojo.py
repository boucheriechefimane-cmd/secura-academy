# -*- coding: utf-8 -*-
"""M7 — Les cinq rooms de dojo (une par ceinture).

Le dojo Secura : cinq ceintures, quatre défis chacune. Chaque défi se
valide par une preuve lue dans la machine (labs/dojo-01) : le serveur
compare la réponse au drapeau qu'il garde en root.

Textes originaux. Vidéo de présentation : pwn.college (Arizona State
University), réutilisation non commerciale avec attribution.
"""

from rooms_m7 import q, LAB_DOJO, CH_PWN, LIC_PWN, INST_PWN


# Une vidéo par ceinture : les vidéos de pwn.college qui présentent
# exactement les outils de la ceinture.
VIDEO_CEINTURE = {
    1: {
        'id': 'A5CnZGst5u4',
        'title': 'pwn.college - Exploitation Scenarios - Introduction',
        'channel': CH_PWN,
        'institution': INST_PWN,
        'license': LIC_PWN,
        'duration': '7:21',
        'note': "Présentation de la méthode des scénarios d'exploitation (pwn.college).",
    },
    2: {
        'id': 'UW13N0CV-4s',
        'title': 'pwn.college - Talking Web - Introduction',
        'channel': CH_PWN,
        'institution': INST_PWN,
        'license': LIC_PWN,
        'duration': '9:43',
        'note': "Le web en clair : requêtes et réponses (pwn.college).",
    },
    3: {
        'id': 'hh4XAU6XYP0',
        'title': 'Introduction: What is pwn.college?',
        'channel': CH_PWN,
        'institution': INST_PWN,
        'license': LIC_PWN,
        'duration': '9:10',
        'note': "Ce qu'est le dojo, et pourquoi il est.gradué en ceintures (pwn.college).",
    },
    4: {
        'id': 'IWbIZerH930',
        'title': 'pwn college - Assembly Crash Course - Registers',
        'channel': CH_PWN,
        'institution': INST_PWN,
        'license': LIC_PWN,
        'duration': '13:47',
        'note': "Les registres du processeur (pwn.college).",
    },
    5: {
        'id': 'HahXfnOsSUU',
        'title': 'pwn college - Assembly Crash Course - Memory',
        'channel': CH_PWN,
        'institution': INST_PWN,
        'license': LIC_PWN,
        'duration': '28:23',
        'note': "La mémoire vue de près : registres et pile (pwn.college).",
    },
}


CEINTURES = [
    {
        'numero': 1,
        'nom': 'blanche',
        'ar_nom': 'الأبيض',
        'en_nom': 'white',
        'titre': 'Ceinture blanche : lire, chercher, comprendre',
        'excerpt': "Quatre défis pour apprendre à regarder un fichier et à y trouver ce qu'on cherche.",
        'ar_titre': 'الحزام الأبيض: اقرأ، ابحث، افهم',
        'ar_excerpt': 'أربعة تحديات لتتعلم النظر إلى ملف والعثور داخله على ما تبحث عنه.',
        'en_titre': 'White belt: read, search, understand',
        'en_excerpt': 'Four challenges to learn how to read a file and find in it what you are looking for.',
        'resume': (
            "<p>La première ceinture est celle de l'observation. Pas de technique compliquée : "
            "juste apprendre à regarder un fichier, à le parcourir, et à y repérer une valeur.</p>"
            "<p>Ce que tu vas apprendre :</p>"
            "<ul>"
            "<li><code>cat</code> — tout le fichier, d'un coup ;</li>"
            "<li><code>ls -a</code> — y compris ce qui est <em>caché</em> (le point devant) ;</li>"
            "<li><code>grep</code> — trouver une ligne qui contient un mot ;</li>"
            "<li><code>head</code> et <code>tail</code> — le début et la fin.</li>"
            "</ul>"
            "<p><strong>À retenir :</strong> avant de demander « comment je pirate ? », demande "
            "« qu'y a-t-il exactement dans ce fichier ? ». La plupart du temps, la réponse est "
            "déjà là, en clair.</p>"
        ),
        'challenges': [
            ('d01', 'Le premier fichier', '01-premier-fichier.txt', "Le fichier de compte rendu du premier défi."),
            ('d02', 'Le dossier caché', '02-dossier-cache.txt', "Un fichier commence par un point : les outils simples ne le voient pas."),
            ('d03', 'Le mot dans le texte', '03-mot-dans-le-texte.txt', "Une ligne contient un mot précis : il faut la retrouver."),
            ('d04', 'Les première et dernière lignes', '04-extremites.txt', "Le début et la fin du fichier, c'est souvent là que se trouve l'information."),
        ],
        'practice': [
            q(
                "Quelle commande affiche le contenu complet d'un fichier ?",
                ['cat', 'ls', 'cd', 'ps'],
                0,
                "Une commande pour lire, une pour lister.",
                "<code>cat</code> affiche le contenu. <code>ls</code> liste des fichiers, <code>cd</code> change de répertoire, <code>ps</code> liste les processus. Confusion classique : l'outil du jour n'est pas toujours l'outil du moment.",
            ),
            q(
                "Pourquoi utiliser `ls -a` plutôt que `ls` ?",
                [
                    "Pour avoir la taille des fichiers",
                    "Pour voir aussi les fichiers cachés (ceux qui commencent par un point)",
                    "Pour trier par date",
                    "Pour lister les dossiers seulement",
                ],
                1,
                "Qu'est-ce qui peut manquer à `ls` ?",
                "Les fichiers cachés commencent par un point. <code>ls</code> les saute ; <code>ls -a</code> les montre. C'est là que se cachent les fichiers de configuration « secrets » — et parfois les drapeaux.",
            ),
        ],
        'exam': [
            q(
                "Tu cherches une ligne qui contient « session ». Quelle commande est faite pour ça ?",
                ['grep', 'chmod', 'kill', 'tar'],
                0,
                "Une commande de recherche de texte.",
                "<code>grep</code> filtre les lignes qui contiennent un motif. <code>chmod</code> change des droits, <code>kill</code> arrête un processus, <code>tar</code> archive des fichiers. Retiens la famille : <code>grep</code> = chercher du texte.",
            ),
            q(
                "Un fichier s'appelle `.secret`. Quelle commande simple ne le montre pas ?",
                ['ls', 'ls -a', 'cat .secret', 'find .'],
                0,
                "Le point au début change tout.",
                "C'est exactement le piège du défi 2 : <code>ls</code> sans option ignore les fichiers cachés. <code>ls -a</code> les montre, et <code>cat .secret</code> lit celui-là.",
            ),
            q(
                "Tu veux la dernière ligne d'un long fichier de journal. Tu utilises ?",
                ['head -1', 'tail -1', 'grep -c', 'wc -l'],
                1,
                "La fin du fichier.",
                "<code>tail</code> affiche la fin, <code>head</code> le début. Pour un journal, la dernière ligne est souvent la plus récente : c'est là que se trouve l'événement intéressant.",
            ),
        ],
    },
    {
        'numero': 2,
        'nom': 'jaune',
        'ar_nom': 'الأصفر',
        'en_nom': 'yellow',
        'titre': "Ceinture jaune : permissions, propriétaire, contenu",
        'excerpt': "Quand le système te dit non : qui possède le fichier, quelles sont ses permissions, et ce qu'il contient vraiment.",
        'ar_titre': 'الحزام الأصفر: الأذونات، المالك، المحتوى',
        'ar_excerpt': 'عندما يقول لك النظام لا: من يملك الملف، وما هي أذوناته، وما يحتويه فعلا.',
        'en_titre': 'Yellow belt: permissions, owner, content',
        'en_excerpt': 'When the system says no: who owns the file, what its permissions are, and what it really contains.',
        'resume': (
            "<p>La ceinture jaune, c'est le moment où l'outil simple ne suffit plus. "
            "Le fichier est là, mais quelque chose te bloque : des <strong>permissions</strong>, "
            "un <strong>propriétaire</strong> différent du tien, un contenu qu'on ne voit qu'en partie.</p>"
            "<p>Ce que tu vas apprendre :</p>"
            "<ul>"
            "<li><code>ls -l</code> — les droits, le propriétaire, le groupe, la taille ;</li>"
            "<li><code>stat</code> — les détails d'un fichier (type, taille, permissions) ;</li>"
            "<li><code>grep -n</code> — le <em>numéro</em> de la ligne qui contient le mot ;</li>"
            "<li><code>wc</code> — compter lignes, mots ou octets.</li>"
            "</ul>"
            "<p><strong>À retenir :</strong> un fichier que tu ne peux pas lire n'est pas forcément absent. "
            "Il est peut-être protégé : et là, la bonne question n'est pas « comment le lire ? » "
            "mais « <em>qui</em> le lit, et pourquoi lui ? ».</p>"
        ),
        'challenges': [
            ('d05', 'Le fichier protégé', '05-fichier-protege.txt', "Les permissions d'un fichier se lisent d'un coup avec `ls -l`."),
            ('d06', 'Le dossier du vrai propriétaire', '06-proprietaire.txt', "Le propriétaire d'un fichier n'est pas forcément toi."),
            ('d07', 'La ligne cachée', '07-ligne-cachee.txt', "Une ligne cachée au milieu : `grep -n` donne son numéro."),
            ('d08', 'Le compte des caractères', '08-taille.txt', "Compter ce qu'il y a dans un fichier, c'est parfois la réponse."),
        ],
        'practice': [
            q(
                "Dans `ls -l`, que signifie la chaîne `-rwxr-xr-x` ?",
                [
                    "Le fichier est en lecture seule pour tout le monde",
                    "Le propriétaire peut lire, écrire et exécuter ; les autres peuvent lire et exécuter",
                    "Le fichier appartient au groupe root",
                    "Le fichier est un dossier",
                ],
                1,
                "Trois groupes de trois lettres : propriétaire, groupe, autres.",
                "Le premier trio est le propriétaire, le deuxième le groupe, le troisième les autres. <code>rwx</code> = lire, écrire, exécuter. <code>-rwxr-xr-x</code> : le propriétaire a tous les droits, le groupe et les autres seulement lire et exécuter.",
            ),
            q(
                "Que fait `grep -n` en plus de `grep` ?",
                [
                    "Il ignore la casse",
                    "Il affiche le numéro de ligne de chaque résultat",
                    "Il compte les résultats",
                    "Il cherche dans les sous-dossiers",
                ],
                1,
                "Le « n », c'est le numéro.",
                "<code>-n</code> affiche le numéro de ligne : pratique pour situer un élément dans un long fichier. <code>-i</code> ignore la casse, <code>-c</code> compte, <code>-r</code> descend dans les dossiers.",
            ),
        ],
        'exam': [
            q(
                "Tu vois `-rw-------` sur un fichier. Qui peut le lire ?",
                [
                    "Tout le monde",
                    "Le groupe du fichier",
                    "Uniquement le propriétaire",
                    "Personne, même le propriétaire",
                ],
                2,
                "Six tirets ou six lettres : que reste-t-il au propriétaire ?",
                "Les trois premiers signes concernent le propriétaire : <code>-rw-</code> signifie lecture seule pour lui, et rien pour le groupe ni les autres. C'est le mode typique d'un fichier de secret.",
            ),
            q(
                "Quel est l'intérêt de `stat` par rapport à `ls -l` ?",
                [
                    "Il donne plus de détails fins (type, inode, horodatages)",
                    "Il change les permissions",
                    "Il copie le fichier",
                    "Il ouvre le fichier dans un éditeur",
                ],
                0,
                "C'est la version détaillée de l'inspection.",
                "<code>stat</code> affiche l'inode, le type exact (fichier, dossier, lien), la taille et les dates. <code>ls -l</code> donne la vue condensée : <code>stat</code> donne la fiche complète.",
            ),
            q(
                "Un fichier appartient à `www-data` et tu es `ctf`. Que peux-tu en faire ?",
                [
                    "Le modifier, puisque le dossier t'appartient",
                    "Le lire s'il a les bons droits pour « autres », sinon rien",
                    "Le supprimer sans condition",
                    "Le devenir propriétaire",
                ],
                1,
                "Le propriétaire et les droits de lecture ne sont pas la même chose.",
                "Un compte de service (<code>www-data</code>) possède souvent les fichiers de l'application : c'est normal. Tes droits dépendent des permissions « autres ». Tu ne deviens jamais propriétaire d'un fichier qui ne t'appartient pas.",
            ),
        ],
    },
    {
        'numero': 3,
        'nom': 'orange',
        'ar_nom': 'البرتقالي',
        'en_nom': 'orange',
        'titre': "Ceinture orange : réseau, processus, configuration",
        'excerpt': "On quitte les fichiers : ce qui écoute, ce qui tourne, et ce qui a été oublié dans la configuration.",
        'ar_titre': 'الحزام البرتقالي: الشبكة، العمليات، الإعداد',
        'ar_excerpt': 'نترك الملفات: ما الذي يستمع، وما الذي يعمل، وما الذي نُسي في الإعداد.',
        'en_titre': 'Orange belt: network, processes, configuration',
        'en_excerpt': 'We leave the files behind: what is listening, what is running, and what was forgotten in the configuration.',
        'resume': (
            "<p>La ceinture orange, on arrête de lire des fichiers pour regarder "
            "<strong>ce qui est vivant</strong> : les ports ouverts, les processus qui tournent, "
            "et les configurations que quelqu'un a oubliées.</p>"
            "<p>Ce que tu vas apprendre :</p>"
            "<ul>"
            "<li><code>ss</code> (ou <code>netstat</code>) — les sockets et les ports qui écoutent ;</li>"
            "<li><code>ps</code> — les processus en cours ;</li>"
            "<li><code>cat</code> et <code>grep</code> sur les fichiers de configuration — "
            "les secrets qu'on a laissés dedans.</li>"
            "</ul>"
            "<p><strong>À retenir :</strong> une machine compromise se raconte par ses processus et ses ports. "
            "Avant de « chercher une faille », regarde ce qui tourne déjà : souvent, la faille est "
            "un service qu'on a oublié.</p>"
        ),
        'challenges': [
            ('d09', 'Le port ouvert', '09-port-ouvert.txt', "Ce qui écoute se voit avec `ss` ou `netstat`."),
            ('d10', 'Le processus suspect', '10-processus.txt', "Ce qui tourne se voit avec `ps`."),
            ('d11', 'La configuration oubliée', '11-configuration.txt', "Une variable laissée dans un fichier de configuration."),
            ('d12', 'La règle du pare-feu', '12-pare-feu.txt', "Une règle de filtrage, lisible comme du texte."),
        ],
        'practice': [
            q(
                "Quelle commande liste les ports qui écoutent ?",
                ['ss -lnt', 'ls -l /ports', 'cat /proc/ports.conf', 'ping -c1'],
                0,
                "« sockets » et « listening ».",
                "<code>ss -lnt</code> liste les sockets en écoute, au format numérique. <code>netstat -tlnp</code> fait la même chose avec le nom du processus — plus pratique quand on cherche « quel programme occupe ce port ».",
            ),
            q(
                "Pourquoi une variable secrète dans un fichier de configuration est-elle dangereuse ?",
                [
                    "Parce que le fichier est lent à lire",
                    "Parce qu'elle est souvent copiée, sauvegardée ou lue par un service plus large que prévu",
                    "Parce que les fichiers de configuration plantent le serveur",
                    "Parce que les variables ne fonctionnent qu'en production",
                ],
                1,
                "Qui lit ce fichier ?",
                "Une clé d'API oubliée dans un fichier de configuration finit par être copiée dans un ticket, dans une sauvegarde, ou lue par un script qui la retransmet. Le secret n'est plus secret dès qu'il est stocké en clair.",
            ),
        ],
        'exam': [
            q(
                "Un service écoute sur le port 8080. Quelle question poser en premier ?",
                [
                    "Quel programme l'occupe, et est-il censé être accessible de l'extérieur ?",
                    "Pourquoi le port n'est pas 80 ?",
                    "Le port 8080 est-il interdit ?",
                    "Faut-il redémarrer le serveur ?",
                ],
                0,
                "Un port ouvert n'est pas une faille : c'est une question.",
                "La bonne question est « est-ce normal ? ». Un port 8080 peut être la vitrine publique, ou une interface d'administration qui n'aurait jamais dû être exposée. C'est le rôle du testeur de le rapprocher de l'attendu.",
            ),
            q(
                "Que révèle un processus qui tourne avec les droits root alors que le service n'en a pas besoin ?",
                [
                    "Rien de particulier",
                    "Un défaut de moindre privilège : si le service est compromis, l'attaquant hérite de root",
                    "Une bonne pratique de performance",
                    "Le serveur est mal configuré au niveau réseau",
                ],
                1,
                "Que se passe-t-il si ce service est compromis ?",
                "C'est le principe du moindre privilège : un service qui tourne en root n'a aucun filet si on s'en sert. On lui retire les droits superflus : un bug devient alors un incident, pas une catastrophe.",
            ),
            q(
                "Pourquoi les règles de filtrage (pare-feu) sont-elles la cible numéro un ?",
                [
                    "Elles sont écrites en Perl",
                    "Parce qu'elles décident de ce qui entre et de ce qui sort : une règle mal écrite ouvre un passage",
                    "Parce qu'elles sont stockées en binaire",
                    "Parce qu'elles ralentissent le serveur",
                ],
                1,
                "Une règle est une porte : mal écrite, elle reste ouverte.",
                "Le filtrage est une politique : « qui a le droit de passer, et vers où ». Une règle oubliée (un « Any » de trop) est souvent plus grave qu'une faille applicative, parce qu'elle ne s'exploite pas : elle est déjà là.",
            ),
        ],
    },
    {
        'numero': 4,
        'nom': 'verte',
        'ar_nom': 'الأخضر',
        'en_nom': 'green',
        'titre': "Ceinture verte : binaires, chaînes, mémoire",
        'excerpt': "On regarde des programmes compilés : ce qu'ils contiennent, ce qu'ils sont, et ce qu'il y a dedans.",
        'ar_titre': 'الحزام الأخضر: الملفات الثنائية، السلاسل، الذاكرة',
        'ar_excerpt': 'ننظر إلى برامج مترجمة: ماذا تحتوي، وماذا هي، وما بداخلها.',
        'en_titre': 'Green belt: binaries, strings, memory',
        'en_excerpt': 'We look at compiled programs: what they contain, what they are, and what is inside them.',
        'resume': (
            "<p>La ceinture verte change de support : on ne lit plus des textes, on regarde des "
            "<strong>binaires</strong> — des programmes compilés.</p>"
            "<p>Ce que tu vas apprendre :</p>"
            "<ul>"
            "<li><code>file</code> — ce qu'est vraiment ce fichier (exécutable, archive, image) ;</li>"
            "<li><code>strings</code> — les bouts de texte cachés dans le binaire ;</li>"
            "<li><code>stat</code> — la taille exacte, un indice qui saute aux yeux ;</li>"
            "<li><code>grep</code> — retrouver une adresse, un message d'erreur, un mot de passe.</li>"
            "</ul>"
            "<p><strong>À retenir :</strong> un binaire ne cache presque rien, il <em>montre</em> mal. "
            "Les chaînes de caractères restent dans le fichier : le mot de passe, l'URL, le message "
            "d'erreur qui trahit une bibliothèque. C'est le principe même du cours 6.858 : "
            "« le programme ne dit pas ce qu'il fait, mais il en montre les morceaux ».</p>"
        ),
        'challenges': [
            ('d13', 'Le binaire et ses chaînes', '13-chaines.txt', "Les chaînes d'un binaire se lisent avec `strings`."),
            ('d14', 'Le type de fichier', '14-type.txt', "Le type réel d'un fichier se voit avec `file`."),
            ('d15', "L'adresse de l'échec", '15-adresse.txt', "Une adresse mémorable est souvent écrite en clair dans le binaire."),
            ('d16', 'La taille du fichier', '16-taille.txt', "Une taille anormale trahit un fichier qui contient plus que ce qu'il dit."),
        ],
        'practice': [
            q(
                "Que fait la commande `strings` ?",
                [
                    "Elle affiche les chaînes de caractères lisibles contenues dans un fichier",
                    "Elle transforme un fichier en texte ligne par ligne",
                    "Elle envoie des chaînes sur le réseau",
                    "Elle vérifie la signature d'un fichier",
                ],
                0,
                "Elle « tire les fils » du texte hors du binaire.",
                "Un binaire compilé est fait de code machine, mais il contient aussi des morceaux de texte : messages d'erreur, chemins, URL, identifiants. <code>strings</code> les extrait. C'est souvent la première chose à faire sur un programme inconnu.",
            ),
            q(
                "Pourquoi une taille de fichier absurde est-elle un indice ?",
                [
                    "Parce que les fichiers gros sont compressés",
                    "Parce qu'un fichier cache souvent autre chose : un exécutable dans un fichier image, une archive dans une image",
                    "Parce que la taille indique l'âge du fichier",
                    "Parce que les fichiers petits sont toujours sûrs",
                ],
                1,
                "Pense à ce qu'on cache dans une image.",
                "Les fichiers « image » ou « document » contiennent souvent un exécutable ou une archive : c'est la base de nombreuses troites. Une taille incohérente avec le format annoncé est le signal de le vérifier (<code>file</code>, puis <code>strings</code>).",
            ),
        ],
        'exam': [
            q(
                "Tu trouves dans un binaire la chaîne « /etc/passwd ». Qu'est-ce que ça indique ?",
                [
                    "Que le binaire est signé",
                    "Que le programme lit probablement ce fichier — donc qu'il est lié au mécanisme des comptes",
                    "Que le fichier est compressé",
                    "Que le binaire vient de Linux",
                ],
                1,
                "Une chaîne de chemin, c'est une intention.",
                "Les chaînes d'un binaire sont les traces de ce qu'il manipule. Retrouver « /etc/passwd » ou « /bin/sh » dans un programme est un indice fort : c'est ce qu'on exploite pour comprendre — et parfois pour passer root.",
            ),
            q(
                "La commande `file` sert à quoi ?",
                [
                    "À ouvrir un fichier dans un éditeur",
                    "À deviner le vrai type d'un fichier d'après son contenu",
                    "À supprimer un fichier",
                    "À comparer deux fichiers",
                ],
                1,
                "Elle dit ce que le fichier est vraiment.",
                "Un fichier peut porter une extension mensongère. <code>file</code> regarde les premiers octets (le « magic number ») et annonce la vérité : exécutable ELF, archive, image, script. C'est un mensonge de plus à démasquer.",
            ),
            q(
                "Pourquoi les binaires contiennent-ils encore des chaînes lisibles ?",
                [
                    "Parce que le langage C ne sait pas faire autrement",
                    "Parce que le programmeur a besoin de messages, de chemins et de libellés : le compilateur les garde",
                    "Parce que le binaire est chiffré",
                    "Parce que le processeur lit des chaînes",
                ],
                1,
                "Le programmeur a besoin de parler à l'utilisateur.",
                "Le code machine ne sait pas afficher « Bonjour ». Tous les textes affichés, tous les chemins utilisés, tous les messages d'erreur sont conservés tels quels dans le binaire. C'est ce qui rend l'analyse statique (<code>strings</code>) si utile.",
            ),
        ],
    },
    {
        'numero': 5,
        'nom': 'noire',
        'ar_nom': 'الأسود',
        'en_nom': 'black',
        'titre': "Ceinture noire : cryptographie, clés, empreintes",
        'excerpt': "La dernière ceinture : lire une empreinte, reconnaître une clé, lire un certificat.",
        'ar_titre': 'الحزام الأسود: التشفير، المفاتيح، البصمات',
        'ar_excerpt': 'الحزام الأخير: قراءة بصمة، والتعرف على مفتاح، وقراءة شهادة.',
        'en_titre': 'Black belt: cryptography, keys, fingerprints',
        'en_excerpt': 'The last belt: reading a fingerprint, recognising a key, reading a certificate.',
        'resume': (
            "<p>La ceinture noire, c'est le monde des <strong>secrets qui ne sont pas en clair</strong> : "
            "des empreintes, des clés, des certificats. On ne les casse pas (on ne « craque » pas une "
            "clé) : on les <em>reconnaît</em>, on les lit, on vérifie.</p>"
            "<p>Ce que tu vas apprendre :</p>"
            "<ul>"
            "<li><code>sha256sum</code> — calculer l'empreinte d'un fichier, et la comparer ;</li>"
            "<li><code>grep</code> — repérer une clé ou un secret dans un fichier ;</li>"
            "<li><code>openssl</code> — lire un certificat et comprendre ce qu'il dit.</li>"
            "</ul>"
            "<p><strong>À retenir :</strong> une empreinte n'est pas réversible : on ne « déchiffre » pas "
            "un hash, on le compare. Et comparer suppose qu'on sache à quoi comparer : "
            "c'est le rôle du serveur, dans notre plateforme.</p>"
        ),
        'challenges': [
            ('d17', "L'empreinte du secret", '17-empreinte.txt', "L'empreinte d'un fichier se calcule avec `sha256sum`."),
            ('d18', 'La clé privée', '18-cle.txt', "Une clé laisse des traces dans les fichiers de configuration."),
            ('d19', 'Le certificat', '19-certificat.txt', "Un certificat dit qui a émis, pour qui, et jusqu'à quand."),
            ('d20', 'Le mot de passe hashé', '20-hache.txt', "Le hache d'un mot de passe se vérifie, il ne se relit pas."),
        ],
        'practice': [
            q(
                "Que fait `sha256sum fichier` ?",
                [
                    "Il chiffre le fichier",
                    "Il calcule une empreinte de 64 caractères hexadécimaux du fichier",
                    "Il compare le fichier avec un autre",
                    "Il compresse le fichier",
                ],
                1,
                "Une empreinte, pas un chiffrement.",
                "<code>sha256sum</code> calcule une empreinte : la même donnée donne toujours la même empreinte, et on ne peut pas remonter de l'empreinte à la donnée. C'est ce qui permet de vérifier qu'un fichier n'a pas été modifié.",
            ),
            q(
                "Pourquoi ne peut-on pas retrouver un mot de passe à partir de son empreinte ?",
                [
                    "Parce que l'empreinte est trop courte",
                    "Parce que l'empreinte est calculée dans un seul sens : on vérifie en recalculant",
                    "Parce que le mot de passe est chiffré deux fois",
                    "Parce que sha256sum est un outil ancien",
                ],
                1,
                "On ne relit pas une empreinte : on la recalcule.",
                "La fonction de hachage est à sens unique par conception. Pour vérifier un mot de passe, on le hache et on compare les empreintes. C'est aussi pourquoi on sale les empreintes (sel) : deux utilisateurs avec le même mot de passe n'ont alors pas la même empreinte.",
            ),
        ],
        'exam': [
            q(
                "Un certificat TLS contient l'adresse du site. Pourquoi est-ce important ?",
                [
                    "Parce que le navigateur l'affiche",
                    "Parce qu'il permet de vérifier à qui on parle : c'est l'identité du serveur",
                    "Parce que cela accélère la connexion",
                    "Parce que cela chiffre le site",
                ],
                1,
                "Que prouve le certificat ?",
                "Le certificat lie une clé publique à un nom de domaine, et il est signé par une autorité. C'est une promesse vérifiable : « cette clé appartient bien à ce site ». Sans cette vérification, le chiffrement protège de l'écoute, mais pas de l'usurpation.",
            ),
            q(
                "Un fichier de configuration contient une clé privée en clair. Quel est le risque principal ?",
                [
                    "Le fichier devient plus lourd",
                    "Toute personne qui lit ce fichier peut se faire passer pour le service",
                    "Le serveur devient plus lent",
                    "La clé devient plus courte",
                ],
                1,
                "Une clé privée, ça s'utilise ou ça se vole.",
                "La clé privée est le secret qui rend la clé publique crédible. Lisible par un compte de service mal configuré, ou copiée dans une sauvegarde, elle permet de se faire passer pour le service — et de déchiffrer ce qui devait rester chiffré.",
            ),
            q(
                "Quelle est la différence entre un hash et un chiffrement ?",
                [
                    "Aucune, c'est la même chose",
                    "Le chiffrement est réversible avec la clé ; le hash ne l'est pas",
                    "Le hash est plus ancien",
                    "Le chiffrement ne fonctionne que sur les fichiers",
                ],
                1,
                "Réversible ou non : voilà la différence.",
                "Le chiffrement est une porte : on entre avec la clé, on ressort avec les données. Le hachage est une empreinte : impossible de revenir en arrière. Confondre les deux, c'est croire qu'on peut « décoder » un mot de passe haché.",
            ),
        ],
    },
]


def room_ceinture(ceinture):
    """Fabrique une room de dojo à partir de sa ceinture."""

    challenges = []
    preuves = []

    for identifiant, titre, fichier, commentaire in ceinture['challenges']:
        chemin = '/srv/dojo/{0}-{1}/{2}'.format(ceinture['numero'], ceinture['nom'], fichier)

        challenges.append(
            '<li><strong>{0}</strong> — {1} (<code>{2}</code>)</li>'.format(titre, commentaire, chemin)
        )

        preuves.append(
            {
                'question': "Relève la valeur du défi « {0} » ({1}).".format(titre, identifiant),
                'flag_path': '/root/flags/flag-{0}.txt'.format(identifiant),
                'xp': 20,
                'hint': "Le dossier de la ceinture {0} est dans <code>/srv/dojo</code>. "
                        "Ouvre le fichier du défi et recopie la valeur entre accolades.".format(ceinture['nom']),
                'explain': "Chaque défi du dojo se valide avec une preuve lue dans la machine : "
                           "le serveur compare ta réponse au drapeau qu'il garde en root. "
                           "L'outil du défi est indiqué dans le document lui-même.",
            }
        )

    liste = '\n'.join(challenges)

    return {
        'title': ceinture['titre'],
        'excerpt': ceinture['excerpt'],
        'content': "Ceinture {0} du dojo Secura : quatre défis, quatre preuves à relever dans la machine.".format(ceinture['nom']),
        'difficulty': 'moyen' if ceinture['numero'] <= 3 else 'difficile',
        'duration': 30,
        'xp_bonus': 50,
        'track': 'avance',
        'lab': LAB_DOJO,
        'video': VIDEO_CEINTURE[ceinture['numero']],
        'lesson_title': 'Task 1 : Leçon — la ceinture {0}'.format(ceinture['nom']),
        'lesson': ceinture['resume'],
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': "<p>Deux questions sur les outils de cette ceinture.</p>",
        'practice': ceinture['practice'],
        'mission_title': 'Task 3 : La mission — les quatre défis de la ceinture',
        'mission': {
            'prompt': (
                "<p>Le dojo est déployé dans ta machine. Les quatre défis de la ceinture "
                "<strong>{0}</strong> se trouvent dans :</p>"
                "<ul>{1}</ul>"
                "<p><strong>Mission.</strong> Ouvre chaque document, relève la valeur de compte rendu "
                "(la ligne <code>... = FLAG=SECURA{{...}}</code>), et réponds aux quatre questions. "
                "Le serveur compare chaque réponse au drapeau qu'il garde en root.</p>"
            ).format(ceinture['nom'], liste),
            'questions': preuves,
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': "<p>Trois questions sur cette ceinture. 60 % suffisent pour valider.</p>",
        'exam': ceinture['exam'],
        'i18n': {
            'ar': {
                'title': ceinture['ar_titre'],
                'excerpt': ceinture['ar_excerpt'],
                'tasks': [
                    'المهمة 1: الدرس — الحزام ' + ceinture['ar_nom'],
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — تحديات الحزام الأربعة',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': ceinture['en_titre'],
                'excerpt': ceinture['en_excerpt'],
                'tasks': [
                    'Task 1: Lesson - the ' + ceinture['en_nom'] + ' belt',
                    'Task 2: Practice',
                    'Task 3: Mission - the four challenges of the belt',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    }


ROOMS = [room_ceinture(ceinture) for ceinture in CEINTURES]
