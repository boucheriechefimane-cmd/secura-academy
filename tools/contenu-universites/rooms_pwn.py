# -*- coding: utf-8 -*-
"""pwn.college (Arizona State University) : quatre rooms.

Source : pwn.college (ASU). Les supports (videos, slides) sont reutilisables
a but non commercial, avec attribution. Les textes des rooms sont originaux.
"""

CH = 'pwn.college'
LIC = 'Reutilisation non commerciale autorisee, avec attribution (pwn.college)'
INST = 'pwn.college (Arizona State University)'

ROOMS = [
    {
        'title': 'x86 et mémoire : comprendre la pile',
        'excerpt': 'Registres, pile, adresses : les trois Ingredients que le CPU manipule en permanence.',
        'content': 'Le refresher assembleur de pwn.college : comment le processeur range les donnees, et pourquoi la pile est l\'endroit ou les debordements.First.',
        'difficulty': 'moyen',
        'duration': 35,
        'xp_bonus': 45,
        'video': {
            'id': 'HahXfnOsSUU',
            'title': 'pwn college - Assembly Crash Course - Memory',
            'channel': CH,
            'institution': INST,
            'license': LIC,
            'duration': '28:23',
            'note': 'Vidéo de l\'université (pwn.college). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — registres, pile, adresses',
        'lesson': (
            '<p>Un programme qui s\'exécute, c\'est trois choses qui bougent en permanence : '
            'des <strong>données</strong>, des <strong>adresses</strong>, et un <strong>compteur de programme</strong> '
            'qui dit « execute cette instruction ». En x86-64, les données vivent d\'abord dans des <strong>registres</strong> '
            '(des cases ultra rapides : <code>rax</code>, <code>rdi</code>, <code>rsp</code>, <code>rbp</code>...), '
            'puis en <strong>mémoire</strong>, qui est découpée en zones.</p>'
            '<p>La zone qui nous intéresse est la <strong>pile</strong> (<em>stack</em>). '
            'À chaque appel de fonction, la pile <em>grandit</em> vers le bas : '
            'on y pose les variables locales, puis l\'adresse de retour. '
            'Schéma mental du haut vers le bas :</p>'
            '<ul>'
            '<li>variables locales (le buffer que l\'on va remplir) ;</li>'
            '<li>le <strong>canari</strong> (une valeur sentinelle) ;</li>'
            '<li>l\'<strong>adresse de retour</strong> (l\'endroit où le CPU doit reprendre après la fonction) ;</li>'
            '<li>la <strong>pointeur de pile</strong> (<code>rsp</code>), qui dit où s\'arrête la pile.</li>'
            '</ul>'
            '<p>Deux idées à retenir :</p>'
            '<ul>'
            '<li><strong>Un dépassement déborde vers le haut</strong> : vers l\'adresse de retour. C\'est exactement ce qu\'on cherche à atteindre.</li>'
            '<li><strong>Les adresses sont des nombres</strong> : si je connais l\'adresse d\'une instruction, je peux y sauter. '
            'C\'est le point de départ du ROP, qu\'on verra dans deux rooms.</li>'
            '</ul>'
            '<p><strong>À retenir :</strong> comprendre la pile, c\'etit comprendre <em>où</em> un programme place ses données — '
            'et donc où un attaquant peut agir.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions sur la pile et les registres.</p>',
        'practice': [
            {
                'q': 'Dans quel sens grandit la pile pendant un appel de fonction ?',
                'choices': [
                    'Vers le haut, vers les adresses croissantes',
                    'Vers le bas, vers les adresses décroissantes',
                    'Elle ne grandit jamais',
                    'Cela dépend du compilateur',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Sur x86-64, la pile descend : <code>rsp</code> diminue.',
                'explain': 'La pile grandit vers les adresses décroissantes (la « stacked » pointe vers le bas). Le <code>rsp</code> est le pointeur de pile : c\'est lui qui délimite le sommet.',
            },
            {
                'q': 'Pourquoi un débordement de tampon « vers le haut » est-il si recherché ?',
                'choices': [
                    'Parce qu\'il est plus rapide',
                    'Parce que l\'adresse de retour se trouve juste au-dessus du buffer',
                    'Parce que les variables locales sont en haut',
                    'Parce que le canari est placé en bas',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Dessine la pile : buffer, canari, adresse de retour.',
                'explain': 'Le buffer est en bas du cadre de pile, l\'adresse de retour juste au-dessus : un débordement qui écrase cette adresse permet de contrôler où le CPU ira ensuite. C\'est là que se joue le canari.',
            },
        ],
        'mission_title': 'Task 3 : La mission — le carnet de mémoire',
        'mission': {
            'prompt': (
                '<p>Dans le dossier <code>/home/ctf/pwn</code>, pwn.college a laissé son '
                '<em>carnet de mémoire</em> : les notes du refresher assembleur, avec les chiffres du TP.</p>'
                '<p><strong>Mission.</strong> Lis ces notes et relève la <em>valeur du nombre d\'octets '
                'réservés au buffer</em> dans le TP (champ <code>buffer_size</code>).</p>'
            ),
            'question': 'Releve la taille du buffer (buffer_size, en octets) indiquee dans le carnet de memoire.',
            'flag_path': '/root/flags/flag-u10.txt',
            'xp': 30,
            'hint': 'Un <code>ls /home/ctf/pwn</code> suffit : lis ensuite le fichier de notes.',
            'explain': 'Connaître la taille du buffer, c\'est pouvoir calculer l\'offset : c\'est le premier chiffre du TP.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'À quoi sert le registre <code>rsp</code> ?',
                'choices': [
                    'Il contient le résultat de la dernière addition',
                    'Il pointe sur le sommet de la pile',
                    'Il indique le nombre d\'instructions exécutées',
                    'Il stocke l\'adresse du segment de code',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'sp = stack pointer.',
                'explain': '<code>rsp</code> est le pointeur de pile : il marque le sommet du cadre courant. <code>rbp</code> (base pointer) sert à accéder aux variables locales de façon stable.',
            },
            {
                'q': 'Un programme alloue un buffer de 32 octets et n\'écrit pas d\'octet de canari. Pourquoi est-ce plus risqué ?',
                'choices': [
                    'Parce que le programme sera plus lent',
                    'Parce que le débordement écrase directement l\'adresse de retour, sans avertissement',
                    'Parce que le buffer ne pourra pas être lu',
                    'Parce que le compilateur refusera de produire le binaire',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Sans sentinelle, rien ne remarque la corruption.',
                'explain': 'Le canari est une sentinelle : sans lui, la corruption passe inaperçue jusqu\'au retour, où le CPU saute n\'importe où. Le débordement devient directement exploitable.',
            },
            {
                'q': 'Que se passe-t-il si un programme écrit 40 octets dans un buffer de 32 ?',
                'choices': [
                    'Le programme s\'arrête avec une erreur',
                    'Les 8 octets en trop écrasent ce qui se trouve après le buffer, dans la pile',
                    'Le buffer s\'agrandit automatiquement',
                    'La mémoire est purgée',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'En C, un tableau n\'a pas de garde-fou.',
                'explain': 'Un tableau C n\'est qu\'une zone de mémoire : écrire au-delà écrase la mémoire voisine. C\'est exactement ce que le canari cherche à détecter.',
            },
            {
                'q': 'Pourquoi les registres sont-ils si importants pour l\'exploitation ?',
                'choices': [
                    'Parce qu\'ils stockent le mot de passe de l\'utilisateur',
                    'Parce qu\'ils contiennent les adresses et les données en cours d\'usage, donc un contrôle sur eux revient à contrôler le programme',
                    'Parce qu\'ils sont l\'unique mémoire qui survit au redémarrage',
                    'Parce qu\'ils remplacent le disque dur',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Pense à ce que le CPU copie d\'un registre vers la mémoire.',
                'explain': 'Le CPU travaille d\'abord dans les registres, puis déverse en mémoire. Agir sur les registres, c\'est agir sur le comportement du programme : c\'est le principe du ROP.',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'x86 والذاكرة: فهم المكدس',
                'excerpt': 'السجلات والمكدس والعناوين: المكونات التي يعالجها المعالج باستمرار.',
                'tasks': [
                    'المهمة 1: الدرس — السجلات والمكدس والعناوين',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — دفتر الذاكرة',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'x86 and memory: understanding the stack',
                'excerpt': 'Registers, stack, addresses: the three ingredients the CPU handles constantly.',
                'tasks': [
                    'Task 1: Lesson - registers, stack, addresses',
                    'Task 2: Practice',
                    'Task 3: Mission - the memory notebook',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
    {
        'title': 'Déborder la pile : le canari et l\'offset',
        'excerpt': 'Comment on mesure un offset, et pourquoi le canari ne sert à rien si on ne sait pas où il est.',
        'content': 'La vidéo « Smashing the Stack » de pwn.college : le mécanisme du débordement et la mesure de l\'offset.',
        'difficulty': 'moyen',
        'duration': 35,
        'xp_bonus': 45,
        'video': {
            'id': 'PVx1hUlMxtQ',
            'title': 'pwn.college - Memory Errors - Smashing the Stack',
            'channel': CH,
            'institution': INST,
            'license': LIC,
            'duration': '16:35',
            'note': 'Vidéo de l\'université (pwn.college). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — mesurer l\'offset',
        'lesson': (
            '<p>Le canari est un obstacle, pas un mur : on peut l\'écraser. Mais il faut pour cela '
            'connaître <strong>exactement</strong> combien d\'octets séparent le début du buffer '
            'et le canari. Cet <strong>offset</strong> se mesure, et c\'est tout le travail du TP.</p>'
            '<p>La méthode classique, en trois temps :</p>'
            '<ol>'
            '<li>Écris une longue suite de caractères reconnaissables (<code>AAAAAAAA...AAAA</code>) '
            'pour dépasser le buffer et écraser le canari et l\'adresse de retour.</li>'
            '<li>Le programme plante (SIGSEGV ou « stack smashing detected ») : laPositions du plantage '
            'te dit à peu près où tu es arrivé.</li>'
            '<li>Affine en changeant la taille et le motif (souvent <code>A</code>, puis <code>B</code>, '
            'puis <code>C</code>…) pour localiser <em>exactement</em> l\'octet qui casse quelque chose.</li>'
            '</ol>'
            '<p>Une fois l\'offset connu, l\'attaque devient précise : on remplit le buffer, '
            'on réécrit le canari avec sa valeur d\'origine (si on la connaît), puis on place '
            'l\'adresse voulue à la place de l\'adresse de retour.</p>'
            '<p>Et le contre-mesure : <strong>ASLR</strong> (les adresses changent), '
            '<strong>NX</strong> (la pile n\'est pas exécutable) et le canari. '
            'Le cours montre que combiner ces trois protections rend l\'exploitation directe '
            'très coûteuse : il faut alors passer par le ROP (room suivante).</p>'
            '<p><strong>À retenir :</strong> l\'offset n\'est pas une astuce, c\'est une mesure. '
            'On ne « devine » pas : on mesure, on recommence, on affine.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions sur la mesure et les protections.</p>',
        'practice': [
            {
                'q': 'Pourquoi écrit-on un motif reconnaissable (AAAA..., BBBB...) dans le buffer ?',
                'choices': [
                    'Pour remplir la mémoire plus vite',
                    'Pour repérer à quel octet le programme se casse et en déduire l\'offset',
                    'Pour que le canari soit content',
                    'Pour obtenir un meilleur score au TP',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Le motif sert de règle graduée.',
                'explain': 'Un motif de octets distincts (AAAA BBBB CCCC) sert de règle : quand le programme casse, on sait exactement où on en est, donc combien d\'octets il faut avant l\'adresse de retour.',
            },
            {
                'q': 'ASLR rend l\'adresse de retour imprévisible. Comment le cours propose-t-il de faire face ?',
                'choices': [
                    'En essayant des adresses au hasard jusqu\'à ce que ça marche',
                    'En utilisant des fuites d\'adresse (ASLR bypass) ou en acceptant que l\'exploitation directe coûte plus cher',
                    'En désactivant ASLR dans le code',
                    'En utilisant des mots de passe plus longs',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'On ne devine pas une adresse aléatoire : on la récupère.',
                'explain': 'ASLR impose de <em>révéler</em> l\'adresse (fuite d\'information : adresse affichée dans une page, pointeur dans un crash, etc.). À défaut, l\'exploitation devient une question de probabilités.',
            },
        ],
        'mission_title': 'Task 3 : La mission — le canari',
        'mission': {
            'prompt': (
                '<p>Dans <code>/home/ctf/pwn</code>, les notes du TP « Smashing the stack » '
                'ont été laissées : elles décrivent le programme vulnérable et la façon de mesurer l\'offset.</p>'
                '<p><strong>Mission.</strong> Lis ces notes et relève la <em>valeur du canari</em> '
                'utilisée par le programme vulnérable du TP (champ <code>canary_value</code>).</p>'
            ),
            'question': 'Releve la valeur du canari (canary_value) indiquee dans les notes du TP stack smashing.',
            'flag_path': '/root/flags/flag-u11.txt',
            'xp': 30,
            'hint': 'Toujours <code>/home/ctf/pwn</code> : un <code>ls</code> puis un <code>cat</code>.',
            'explain': 'Connaître la valeur du canari, c\'est comprendre qu\'il peut être « remis en place » : la protection n\'arrête que les attaques qui ne l\'ont pas anticipé.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Qu\'est-ce que l\'offset dans un débordement de tampon ?',
                'choices': [
                    'Le nombre d\'octets entre le début du buffer et l\'adresse de retour',
                    'L\'adresse de base du programme',
                    'La taille du canari',
                    'Le décalage entre le code et les données',
                ],
                'correct': 0,
                'xp': 10,
                'hint': 'C\'est la distance à parcourir pour atteindre la cible.',
                'explain': 'L\'offset est cette distance. Une fois mesuré, on sait exactement combien d\'octets écrire pour atteindre l\'adresse de retour sans détruire autre chose.',
            },
            {
                'q': 'Pourquoi le canari n\'empêche-t-il pas l\'exploitation, il la détecte-t-il seulement ?',
                'choices': [
                    'Parce qu\'il est trop petit',
                    'Parce qu\'il est vérifié au retour de la fonction : la corruption est déjà faite',
                    'Parce qu\'il est chiffré',
                    'Parce qu\'il expire',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Quand le canari est-il comparé ?',
                'explain': 'Le canari est comparé au moment du retour, entre la sortie de la fonction et le saut. L\'adresse de retour a déjà été écrasée : c\'est une détection, pas une prévention.',
            },
            {
                'q': 'ASLR et NX sont activés : que devient l\'approche directe ?',
                'choices': [
                    'Impossible',
                    'Beaucoup plus coûteux : l\'adresse est inconnue et la charge utile ne peut pas s\'exécuter dans la pile',
                    'Exactement aussi facile qu\'avant',
                    'Nécessairement plus rapide',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Les trois protections ne créent pas un mur : elles créent un coût.',
                'explain': 'L\'exploitation directe devient coûteuse : l\'adresse est imprévisible (ASLR) et la charge utile ne peut pas s\'exécuter dans la pile (NX). L\'attaquant passe alors au ROP, qui est la room suivante.',
            },
            {
                'q': 'Un programme détecte « stack smashing detected » et s\'arrête. Qu\'est-ce que cela prouve ?',
                'choices': [
                    'Que le canari a été écrasé : l\'offset est peut-être bon, mais le canari doit être restauré',
                    'Que l\'offset est faux',
                    'Que le programme estpatché',
                    'Que la pile est pleine',
                ],
                'correct': 0,
                'xp': 10,
                'hint': 'Le canari est l\'alarme, pas le mur.',
                'explain': 'La détection t\'indique que le débordement a atteint le canari. L\'offset est probablement dans la bonne zone ; pour réussir, il faut réécrire le canari avec sa valeur d\'origine (d\'où les fuites étudiées ensuite).',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'تجاوز المكدس: الكاناري والإزاحة',
                'excerpt': 'كيف نقيس الإزاحة، ولماذا لا يفيد الكاناري إن لم تعرف أين يقع.',
                'tasks': [
                    'المهمة 1: الدرس — قياس الإزاحة',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — الكاناري',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'Smashing the stack: the canary and the offset',
                'excerpt': 'How to measure an offset, and why the canary is useless if you do not know where it sits.',
                'tasks': [
                    'Task 1: Lesson - measuring the offset',
                    'Task 2: Practice',
                    'Task 3: Mission - the canary',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
    {
        'title': 'ROP : construire une attaque sans shellcode',
        'excerpt': 'Quand la pile ne peut plus exécuter, on fait rebondir le programme sur lui-même.',
        'content': 'L\'introduction au Return-Oriented Programming de pwn.college : le principe des gadgets et des chaînes de retour.',
        'difficulty': 'difficile',
        'duration': 40,
        'xp_bonus': 55,
        'video': {
            'id': 'El8-vMDJ1zY',
            'title': 'pwn.college - Return Oriented Programming - Introduction',
            'channel': CH,
            'institution': INST,
            'license': LIC,
            'duration': '8:54',
            'note': 'Vidéo de l\'université (pwn.college). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — le retour comme instruction',
        'lesson': (
            '<p>Avec NX, la pile est une zone de <em>données</em> : on ne peut plus y déposer de code à exécuter. '
            'Mais on peut toujours <strong>choisir l\'endroit où le programme reprend</strong>. '
            'C\'est tout le principe du ROP.</p>'
            '<p>L\'idée est simple et startling : un programme déjà compilé contient des morceaux de code '
            'utiles qui se terminent par <code>ret</code>. Ce sont des <strong>gadgets</strong>. '
            'Si l\'adresse de retour pointe sur un gadget qui pose un registre, puis sur un autre gadget qui enchaîne, '
            'le programme enchaîne des actions <em>sans exécuter une seule de nos instructions</em>.</p>'
            '<p>Exemple de raisonnement :</p>'
            '<ol>'
            '<li>Il faut que <code>rdi</code> contienne l\'adresse de la commande <code>"/bin/sh"</code>.</li>'
            '<li>Il faut ensuite appeler <code>execve</code>.</li>'
            '<li>Un gadget <code>pop rdi ; ret</code> permet de placer une valeur dans <code>rdi</code>.</li>'
            '<li>On empile : <code>pop rdi</code>, puis l\'adresse de la chaîne, puis l\'adresse de <code>execve</code>.</li>'
            '</ol>'
            '<p>Chaque gadget se termine par <code>ret</code> : le « retour » devient l\'instruction qui '
            'enchaîne la chaîne. C\'est élégant, et c\'est exactement l\'idée du cours : '
            'on ne crée pas de code, on <em>réutilise</em> celui qui existe, comme on répare un moteur '
            'avec des pièces d\'un autre moteur.</p>'
            '<p>Et le bricolage toujours recommencé : c\'est le <strong>« binary lego »</strong>. '
            'Les outils (<code>ROPgadget</code>, <code>pwntools</code>) servent à trouver les gadgets '
            'et à bâtir la chaîne automatiquement.</p>'
            '<p><strong>À retenir :</strong> le ROP montre que « pas de code injectable » ne veut pas dire « pas d\'exploitation ». '
            'Il déplace la difficulté, il ne la supprime pas.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions sur le principe du ROP.</p>',
        'practice': [
            {
                'q': 'Qu\'est-ce qu\'un « gadget » en ROP ?',
                'choices': [
                    'Un bout de code ajouté au programme par l\'attaquant',
                    'Un bout de code déjà présent dans le binaire, qui se termine par <code>ret</code>',
                    'Un outil qui trouve les vulnérabilités',
                    'Une fonction de la libc',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Avec NX, on ne peut pas déposer de code : qu\'est-ce qu\'on utilise à la place ?',
                'explain': 'Un gadget, c\'est une séquence d\'instructions déjà compilées qui se termine par un <code>ret</code>. On ne crée rien : on recycle. C\'est ce qui rend la technique si portable.',
            },
            {
                'q': 'Pourquoi la protection NX (pile non exécutable) ne bloque-t-elle pas le ROP ?',
                'choices': [
                    'Parce qu\'NX ne s\'applique qu\'au noyau',
                    'Parce qu\'on n\'exécute pas de code placé dans la pile : on saute vers du code déjà exécutable',
                    'Parce que le ROP utilise desAES',
                    'Parce que NX désactive le canari',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'NX interdit d\'exécuter la pile, pas d\'y mettre des adresses.',
                'explain': 'La pile ne contient que des <em>adresses</em> : le CPU saute vers du code located elsewhere (le code du programme), qui est exécutable. La pile reste une donnée.',
            },
        ],
        'mission_title': 'Task 3 : La mission — la chaîne de gadgets',
        'mission': {
            'prompt': (
                '<p>Dans <code>/home/ctf/pwn</code>, le TP « Return Oriented Programming » a laissé '
                'sa <em>chaîne de gadgets</em> annotée (l\'ordre des gadgets à empiler).</p>'
                '<p><strong>Mission.</strong> Lis cette annotation et relève la <em>valeur du nombre '
                'de gadgets</em> dans la chaîne (champ <code>chain_length</code>).</p>'
            ),
            'question': 'Releve le nombre de gadgets (chain_length) de la chaine indiquee dans le TP ROP.',
            'flag_path': '/root/flags/flag-u12.txt',
            'xp': 30,
            'hint': 'Le TP ROP est dans <code>/home/ctf/pwn</code> : plusieurs fichiers, lis celui qui parle de la chaîne.',
            'explain': 'Compter les gadgets d\'une chaîne, c\'et understand qu\'une exploitation est un <em>assemblage</em> : chaque pièce a un rôle, l\'ordre compte.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Quel gadget est typiquement utilisé pour placer un argument dans le premier registre ?',
                'choices': [
                    '<code>syscall ; ret</code>',
                    '<code>pop rdi ; ret</code>',
                    '<code>leave ; ret</code>',
                    '<code>nop ; ret</code>',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Il faut « dépiler » une valeur dans un registre.',
                'explain': 'En ABI System V, les arguments passent dans <code>rdi</code>, <code>rsi</code>... Un gadget <code>pop rdi ; ret</code> y place la valeur empilée, et le <code>ret</code> suivant enchaîne le prochain gadget.',
            },
            {
                'q': 'Que se passe-t-il si la chaîne de gadgets est dans le mauvais ordre ?',
                'choices': [
                    'Le programme fait la même chose, l\'ordre n\'a pas d\'importance',
                    'Les valeurs arrivent dans les mauvais registres et l\'appel système échoue',
                    'Le programme démarre plus lentement',
                    'Le canari est désactivé',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Chaque gadget agit sur l\'état du CPU au moment où il s\'exécute.',
                'explain': 'Le ROP est un programme écrit en codes de retour : l\'ordre des pièces détermine ce qui se passe. Un mauvais ordre donne des registres mal remplis, donc un appel qui échoue.',
            },
            {
                'q': 'Pourquoi le ROP est-il considéré comme une technique plus avancée que le débordement « classique » ?',
                'choices': [
                    'Parce qu\'il demande plus d\'octets',
                    'Parce qu\'il faut comprendre la conventions d\'appel, trouver les gadgets et construire une chaîne cohérente',
                    'Parce qu\'il ne fonctionne qu\'avec de vieux noyaux',
                    'Parce qu\'il n\'a besoin d\'aucune adresse',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'On ne dépose plus de code : on construit un en assembleur de gadgets.',
                'explain': 'Il faut connaître l\'ABI (quels registres, dans quel ordre), trouver des gadgets compatibles et ordonner la chaîne. C\'est de la vraie construction, pas de la brute force.',
            },
            {
                'q': 'Un programme sans aucun gadget utile (pas de <code>pop rdi</code>, pas de <code>syscall</code> utile) est-il exploitable par ROP ?',
                'choices': [
                    'Oui, toujours',
                    'Non, pas par cette technique : il faut chercher une autre primitive',
                    'Oui, en écrivant le shellcode dans le tas',
                    'Oui, si le programme est en 64 bits',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'La chaîne a besoin de pièces ; sans pièces, pas de chaîne.',
                'explain': 'Le ROP dépend des gadgets présents. Si le binaire n\'en offre pas, l\'attaquant change de technique (ret2libc, JOP, ou autre primitive).',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'ROP: هجوم بلا شيفرة شل',
                'excerpt': 'عندما لا يمكن تنفيذ المكدس، نُرجع البرنامج إلى نفسه.',
                'tasks': [
                    'المهمة 1: الدرس — العودة كتعليمة',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — سلسلة القطع',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'ROP: building an attack without shellcode',
                'excerpt': 'When the stack cannot execute, you bounce the program off itself.',
                'tasks': [
                    'Task 1: Lesson - the return as an instruction',
                    'Task 2: Practice',
                    'Task 3: Mission - the gadget chain',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
    {
        'title': 'Vulnérabilité de format string : printf qui parle trop',
        'excerpt': 'Un %s de trop, et le programme va chercher l\'information à ta place.',
        'content': 'L\'introduction aux format string exploits de pwn.college : lire la mémoire, puis écrire dedans.',
        'difficulty': 'difficile',
        'duration': 40,
        'xp_bonus': 55,
        'video': {
            'id': 'vc_9Ujkpy7I',
            'title': 'Format String Exploits - Introduction',
            'channel': CH,
            'institution': INST,
            'license': LIC,
            'duration': '9:47',
            'note': 'Vidéo de l\'université (pwn.college). Cette room est notre pratique du même cours.',
        },
        'lesson_title': 'Task 1 : Leçon — le format qui devient une adresse',
        'lesson': (
            '<p>La famille <code>printf</code> estodr flexible : '
            '<code>printf("%s", s)</code> affiche une chaîne, mais <code>printf(s)</code> '
            'l\'interprète comme un <em>format</em>. '
            'Si l\'utilisateur contrôle <code>s</code>, il contrôle ce que le programme va '
            '<strong>lire en mémoire</strong> — et parfois ce qu\'il va <strong>écrire</strong>.</p>'
            '<p>La mécanique est simple à comprendre :</p>'
            '<ul>'
            '<li><code>%x</code> affiche un mot hexadécimal lu dans la pile (ou dans les registres) ;</li>'
            '<li><code>%s</code> affiche la chaîne pointée par la valeur lue ;</li>'
            '<li><code>%n</code> <strong>écrit</strong> le nombre de caractères affichés à l\'adresse lue ;</li>'
            '<li><code>%n</code> est le plus dangereux : c\'est une <strong>écriture arbitraire</strong>.</li>'
            '</ul>'
            '<p>Deux conséquences :</p>'
            '<ol>'
            '<li><strong>Fuite d\'information</strong> : en empilant des <code>%p</code>, on fait cracher au programme '
            'les adresses qu\'il a en mémoire. Avec ASLR, c\'est de l\'or : on récupère la base du programme '
            'ou l\'adresse d\'une pile libc.</li>'
            '<li><strong>Écriture arbitraire</strong> : avec <code>%n</code>, on écrit une valeur choisie '
            'à l\'adresse choisie. On peut alors écraser une entrée de table de sauts, un pointeur de fonction, '
            'ou le GOT (table des fonctions déjà résolues) pour prendre le contrôle du flot.</li>'
            '</ol>'
            '<p>La parade est simple et connue : <strong>toujours passer le format comme constante</strong>, '
            'jamais comme donnée. <code>printf("%s", user_input)</code> et non <code>printf(user_input)</code>. '
            'Le compilateur peut même vous aider : <code>gcc -Wformat-security</code> avertit.</p>'
            '<p><strong>À retenir :</strong> une format string, c\'est un contrôleur de lecture <em>et</em> '
            'd\'écriture fourni à l\'utilisateur. Le corriger coûte une ligne de code ; l\'exploiter demande des heures.</p>'
        ),
        'practice_title': 'Task 2 : Entraînement',
        'practice_intro': '<p>Deux questions : lire, écrire, et réparer.</p>',
        'practice': [
            {
                'q': 'Que fait le spécificateur <code>%n</code> dans un contexte d\'exploitation ?',
                'choices': [
                    'Il affiche le nombre de caractères déjà écrits',
                    'Il écrit le nombre de caractères affichés à l\'adresse qu\'il vient de lire : c\'est une écriture arbitraire',
                    'Il lit un nombre depuis le réseau',
                    'Il nettoie la pile',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Presque tous les spécificateurs lisent. Celui-là écrit.',
                'explain': 'Les autres spécificateurs (%x, %s, %p) lisent. <code>%n</code> écrit le compteur de caractères à l\'adresse lue sur la pile : d\'où une écriture arbitraire en mémoire.',
            },
            {
                'q': 'Comment corrige-t-on une format string vulnérable ?',
                'choices': [
                    'En filtrant les caractères <code>%</code> et <code>n</code>',
                    'En passant le format comme constante : <code>printf("%s", saisie)</code>',
                    'En allouant plus de mémoire',
                    'En cryptant la saisie',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'La parade du cours est d\'un seul geste.',
                'explain': 'Le format doit être une constante, la donnée reste une donnée. Le filtre de caractères est une solution de fortune : il se contourne (double %% ou autres encodages) et il masque la vraie erreur de conception.',
            },
        ],
        'mission_title': 'Task 3 : La mission — la fuite d\'adresse',
        'mission': {
            'prompt': (
                '<p>Dans <code>/home/ctf/pwn</code>, le TP « Format String Exploits » a laissé '
                'son <em>carnet de fuite</em> : les notes des manipulations d\'affichage utilisées pour '
                'récupérer les adresses.</p>'
                '<p><strong>Mission.</strong> Lis ce carnet et relève la <em>valeur du nombre de '
                'spécificateurs</em> utilisés dans l\'exemple de fuite (champ <code>specifier_count</code>).</p>'
            ),
            'question': 'Releve le nombre de specificateurs (specifier_count) utilises dans l\'exemple de fuite du carnet.',
            'flag_path': '/root/flags/flag-u13.txt',
            'xp': 30,
            'hint': 'Le carnet de fuite est dans <code>/home/ctf/pwn</code> : lis les fichiers de notes.',
            'explain': 'Compter les spécificateurs, c\'et understand la mécanique : chaque <code>%p</code> consomme une valeur de la pile, donc décale la lecture d\'un cran.',
        },
        'exam_title': 'Task 4 : Examen de fin de room',
        'exam_intro': '<p>Quatre questions chronométrées. 60 % suffisent pour valider.</p>',
        'exam': [
            {
                'q': 'Quel est le risque exact de <code>printf(user_input)</code> ?',
                'choices': [
                    'Un risque de performance',
                    'L\'utilisateur contrôle ce que printf lit (et parfois écrit) en mémoire',
                    'Un débordement de tampon automatique',
                    'Une fuite de la variable d\'environnement PATH',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'printf n\'a pas un rôle de lecteur : il est un formateur.',
                'explain': 'La donnée est interprétée comme un format : l\'utilisateur choisit les spécificateurs, donc les endroits de la mémoire lus — et avec <code>%n</code>, écrits.',
            },
            {
                'q': 'Comment une format string permet-elle de contourner ASLR ?',
                'choices': [
                    'En encryptant le binaire',
                    'En faisant cracher au programme les adresses qu\'il a en mémoire : on récupère ainsi une base à calculer',
                    'En desactivant le noyau',
                    'En changeant la fréquence du processeur',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'ASLR cache les adresses ; une fuite les révèle.',
                'explain': 'Une fuite d\'adresse (adresse de la pile, d\'une bibliothèque, du programme) permet de calculer les adressesDespite l\'aléatoire : l\'aléatoire devient connu.',
            },
            {
                'q': 'Pourquoi <code>%n</code> est-il si recherché en exploitation ?',
                'choices': [
                    'Parce qu\'il imprime des nombres très grands',
                    'Parce qu\'il permet d\'écrire une valeur choisie à une adresse choisie',
                    'Parce qu\'il arrête le programme',
                    'Parce qu\'il vérifie le mot de passe',
                ],
                'correct': 1,
                'xp': 10,
                'hint': 'Les autres spécificateurs lisent. Celui-là écrit.',
                'explain': '<code>%n</code> transforme la fuite en écriture : on peut écraser une adresse de retour, un GOT, un pointeur de fonction. C\'est la primitive qui permet l\'exploitation moderne.',
            },
            {
                'q': 'Un programme affiche une saisie utilisateur avec <code>printf("%s", saisie)</code>. Quel est le risque restant ?',
                'choices': [
                    'Aucun pour la format string, mais la saisie reste à valider en longueur (dépassement de tampon possible)',
                    'La format string reste exploitable',
                    'Le programme va planter',
                    'La saisie sera chiffrée deux fois',
                ],
                'correct': 0,
                'xp': 10,
                'hint': 'Corriger la format string ne corrige pas tout.',
                'explain': 'Le correctif de la format string est acquis, mais la longueur de la saisie reste à contrôler (et le type, si on veut éviter les injections). La sécurité se gagne brique par brique.',
            },
        ],
        'i18n': {
            'ar': {
                'title': 'ثغرة سلسلة التنسيق: printf الذي يتكلم أكثر',
                'excerpt': 'محول %s زائد، فيذهب البرنامج ويجلب المعلومة بدلًا منك.',
                'tasks': [
                    'المهمة 1: الدرس — التنسيق الذي يصبح عنوانًا',
                    'المهمة 2: تدريب',
                    'المهمة 3: المهمة — تسريب العنوان',
                    'المهمة 4: امتحان نهاية الغرفة',
                ],
            },
            'en': {
                'title': 'Format string vulnerability: a printf that talks too much',
                'excerpt': 'One %s too many, and the program goes looking for the information on your behalf.',
                'tasks': [
                    'Task 1: Lesson - the format that becomes an address',
                    'Task 2: Practice',
                    'Task 3: Mission - the address leak',
                    'Task 4: End-of-room exam',
                ],
            },
        },
    },
]
