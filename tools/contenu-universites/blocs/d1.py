# -*- coding: utf-8 -*-
"""Bloc D1 — les quatre sujets qui manquaient au referentiel SY0-701.

MESURE DU 7 NOVEMBRE 2026
-------------------------
`couverture.php` nommait quatre sujets absents des rooms :

    D1 1.1 — Controles de securite (categories et types)
    D1 1.3 — Zero trust
    D1 1.4 — Gestion du changement
    D1 1.7 — Securite physique (theorie seulement)

Les quatre sont dans le domaine D1, qui pese 12 % du score. Ce bloc les
traite par TROIS rooms, parce que 1.4 et 1.7 racontent la meme histoire :
un changement non documente qui ouvre une porte physique. Les separer
aurait produit deux rooms de vocabulaire, ce que le gabarit interdit.

Une room ne comble pas un trou en nommant le sujet : elle met l'eleve
devant une decision, avec une consequence.

SOURCES
-------
- NIST SP 800-207, Zero Trust Architecture (aout 2020), domaine public :
  le point de decision et le point d'application, et le fait que « zero
  trust » ne veut pas dire « aucun acces » mais « aucune confiance
  implicite ».
- NIST SP 800-53 Rev. 5, familles AC et PE, domaine public : la
  classification des controles et les controles physiques.
- NIST SP 800-128, Guide for Security-Focused Configuration Management
  (aout 2011), domaine public : le changement de configuration comme
  evenement a tracer, autoriser, verifier.

Aucun texte n'est reproduit. Le contenu est ecrit a partir de ces
documents, et chaque affirmation factuelle y renvoie.
"""

FONCTION = 'seca_default_rooms_d1'

ENTETE = [
    "D1 — Les trois rooms qui comblent les trous du domaine general.",
    "",
    "POURQUOI CES ROOMS EXISTENT",
    "---------------------------",
    "Mesure du 7 novembre 2026 : quatre sujets du domaine D1 n'etaient",
    "couverts par aucune room — ni les controles de securite (1.1), ni le",
    "zero trust (1.3), ni la gestion du changement (1.4), ni la securite",
    "physique (1.7). La banque de questions les nommait, les rooms les",
    "ignoraient : un eleve pouvait reussir l'examen sans avoir jamais vu",
    "la notion.",
    "",
    "Trois rooms plutot que quatre : 1.4 et 1.7 se racontent ensemble.",
    "Un changement de configuration non documente qui ouvre une porte",
    "physique, c'est une seule histoire, et c'est celle qui arrive.",
    "",
    "Chaque room suit le gabarit en quatre temps (docs/GABARIT-ROOMS.md) :",
    "lecon, entrainement, mise en situation dans un terminal simule, puis",
    "examen sans indice. Le terminal est simule : ces rooms fonctionnent",
    "sans conteneur.",
    "",
    "Sources : NIST SP 800-207 (zero trust), SP 800-53 Rev. 5 (familles AC",
    "et PE), SP 800-128 (gestion de configuration). Domaine public.",
    "Contenu original.",
]

ROOMS = [

    # =================================================================
    # 1.1 — Controles de securite
    # =================================================================
    {
        'title': "Le portique qui n'a arrete personne",
        'excerpt': "Un portique de detection est installe a l'entree. Un badge est pose sur chaque porte. Et l'incident a quand meme eu lieu. A toi de dire ce que chaque controle est cense faire — et ce qu'aucun d'eux ne faisait.",
        'content': "Un controle de securite ne vaut pas par son prix, mais par ce qu'il empeche, constate ou repare. Cette room t'apprend a classer un controle avant de l'acheter, et a reperer le controle qui manque dans une chaine pourtant complete.",
        'difficulty': 'facile',
        'duration': 30,
        'xp_bonus': 55,
        'track': 'concepts',
        'source': {
            'nom': 'NIST SP 800-53 Rev. 5 — Security and Privacy Controls (familles AC et PE)',
            'url': 'https://csrc.nist.gov/pubs/sp/800/53/r5/upd1/final',
            'licence': 'Domaine public (publication du NIST, Etats-Unis)',
            'attribution': 'NIST Special Publication 800-53 Revision 5, Security and Privacy Controls for Information Systems and Organizations',
        },
        'tasks': [
            {
                'type': 'lesson', 'format': 'lecon',
                'title': "Task 1 : Quatre categories, et une seule question a poser",
                'content': "<p>Un <strong>controle de securite</strong> est un dispositif qui modifie la probabilite ou l'impact d'un evenement. Le referentiel NIST SP 800-53 les range par <em>famille</em> (acces, audit, physique...), mais la classification qui sert au quotidien est celle du <em>moment</em> ou le controle agit. Quatre categories, et une question pour chacune :</p><ul><li><strong>preventif</strong> — il empeche l'evenement. Question : <em>qu'est-ce qui devient impossible ?</em> Un pare-feu, un badge, un mot de passe, une cloison.</li><li><strong>detectif</strong> — il constate l'evenement, sans l'empecher. Question : <em>comment le saurais-je ?</em> Une camera, un IDS, un journal, un portique de detection.</li><li><strong>correctif</strong> — il limite l'impact une fois l'evenement produit. Question : <em>comment je repare, et en combien de temps ?</em> Une sauvegarde restaurable, un correctif, un plan de reprise.</li><li><strong>dissuasif</strong> — il agit sur la decision de l'attaquant. Question : <em>que voit-il, et que craint-il ?</em> Une camera visible, un panneau, un gardien.</li></ul><p>Deux controles peuvent se superposer sans se remplacer. Un portique de detection est <strong>dissuasif</strong> (il se voit) et <strong>detectif</strong> (il alerte). Il n'est <strong>pas preventif</strong> : il ne bloque personne. C'est exactement l'erreur de la salle serveur racontee dans cette room.</p><p>Deux notions voisines, souvent confondues avec les quatre categories. Chacune repond a une question differente, et confondre la <em>categorie de controle</em> avec la nature du controle est l'erreur la plus courante d'un audit :</p><ul><li><strong>compensatoire</strong> — il remplace un controle impossible a mettre en place. Si la salle serveur ne peut pas avoir de cloison coupe-feu, on ajoute une detection incendie renforcee. Ce n'est pas la meme chose que <em>correctif</em> : le compensatoire remplace un preventif absent ;</li><li><strong>technique, administratif ou physique</strong> — c'est la <em>nature</em> du controle, pas son moment. Un badge est physique et preventif ; une politique de badge est administrative et preventive. Les deux sont necessaires, aucun ne suffit.</li></ul><p><strong>La question qui trie tout :</strong> « que se passe-t-il si ce controle tombe en panne ? » Un preventif qui tombe laisse passer ; un detectif qui tombe laisse passer <em>sans qu'on le sache</em>. C'est pour cela qu'un dispositif detectif doit etre surveille lui-meme.</p><p><strong>A retenir :</strong> classer un controle, c'est repondre a « a quel moment agit-il », pas a « combien coute-t-il ». Un controle qu'on ne sait pas classer est un controle qu'on ne saura pas verifier.</p>",
                'questions': [],
            },
            {
                'type': 'practice', 'format': 'qcm',
                'title': "Task 2 : Entrainement — trois controles a classer",
                'content': "<p>Trois dispositifs reels. A chaque fois : quelle est leur categorie, et que font-ils vraiment ?</p>",
                'questions': [
                    {
                        'question': "Un portique de detection magnetique est installe a l'entree du batiment. Un visiteur passe avec un objet metallique : le portique sonne, et un agent intervient. Comment le classer ?",
                        'topic': '1.1',
                        'choices': [
                            "Dissuasif et detectif : il se voit, et il signale — mais il ne bloque pas",
                            "Preventif : il empeche physiquement le passage de l'objet metallique",
                            "Correctif : il repare l'incident apres que l'objet est entre dans le batiment",
                            "Compensatoire : il remplace l'absence d'agent de securite a l'entree du site",
                        ],
                        'correct': 0, 'xp': 10,
                        'hint': "Le portique empeche-t-il le passage, ou le signale-t-il ?",
                        'explanation': "Le portique ne ferme aucune porte : il sonne. Il est detectif par ce qu'il fait, et dissuasif par ce qu'il montre. Un controle preventif a cet endroit serait un tourniquet, une porte verrouillee ou un agent qui refuse le passage.",
                    },
                    {
                        'question': "Une entreprise sauvegarde ses donnees chaque nuit, et verifie une restauration par trimestre. De quelle categorie releve cette verification ?",
                        'topic': '1.1',
                        'choices': [
                            "Correctif : la sauvegarde restaure, et la verification prouve qu'elle restaure",
                            "Preventif : la sauvegarde empeche la perte definitive des donnees, des qu'elle est planifiee et verifiee",
                            "Detectif seulement : la verification constate que la sauvegarde existe, mais ne restaure rien du tout",
                            "Dissuasif : la sauvegarde decourage l'attaquant de chiffrer les fichiers, par sa simple existence annoncee",
                        ],
                        'correct': 0, 'xp': 10,
                        'hint': "Une sauvegarde jamais restauree est-elle un controle, ou une intention ?",
                        'explanation': "La sauvegarde seule est une intention. C'est la restauration verifiee qui en fait un controle correctif : on sait, preuve en main, qu'on peut revenir en arriere. Sans ce test, on decouvre que la sauvegarde est illisible le jour de l'incident.",
                    },
                    {
                        'question': "Une salle serveur ne peut pas recevoir de cloison coupe-feu (batiment classe, murs porteurs). La direction installe a la place une detection incendie renforcee et un extincteur a gaz. Comment nommer ce dispositif ?",
                        'topic': '1.1',
                        'choices': [
                            "Compensatoire : il remplace un controle preventif impossible a installer",
                            "Preventif : il empeche le feu de se declencher dans la salle serveur, en coupant l'alimentation",
                            "Dissuasif : il decourage un incendie volontaire dans la salle, par sa seule presence visible serveur",
                            "Inefficace : sans cloison, aucun autre controle ne sert a rien et l'argent depense est perdu",
                        ],
                        'correct': 0, 'xp': 10,
                        'hint': "Le controle ne fait pas la meme chose que la cloison : il compense son absence.",
                        'explanation': "Une cloison empeche la propagation ; une detection renforcee et une extinction fixe limitent l'impact. On ne remplace pas un controle par son equivalent, on compense un manque assume. Le mot compte : il dit que le risque residuel est plus eleve, et qu'il a ete accepte.",
                    },
                ],
            },
            {
                'type': 'test', 'format': 'pratique',
                'title': "Task 3 : La mission — trouver le controle qui manque",
                'content': "<p><strong>Mission.</strong> L'atelier de l'entreprise a ete cambriole un dimanche. Quatre serveurs ont disparu, et personne ne l'a su avant le lundi matin. Le rapport de securite de la salle serveur est sur la machine de l'atelier.</p><p>Lis-le, et trouve <strong>le nombre de controles preventifs</strong> qui protegeaient reellement la salle, tel qu'il est ecrit dans le rapport (un nombre, en chiffres).</p>",
                'questions': [
                    {
                        'question': "Combien de controles PREVENTIFS protegeaient reellement la salle serveur, d'apres le rapport ?",
                        'mode': 'text', 'topic': '1.1',
                        'answers': [r'/\b3\b/'],
                        'xp': 40,
                        'hint': "Dans le terminal : <code>cat /srv/atelier/rapport-securite.md</code>. Compte les lignes marquees PREVENTIF, et ignore celles marquees DETECTIF ou DISSUASIF.",
                        'explanation': "Trois controles preventifs : la porte a badge, le sas a fermeture automatique, et le grillage des fenetres. Le rapport liste aussi une camera et un panneau — tous deux detectifs ou dissuasifs. C'est le coeur du sujet : la salle avait l'air protegee, et rien n'empechait un cambriolage le dimanche, quand le badge n'etait lu par personne et que la camera enregistrait sans alerter.",
                    },
                ],
                'terminal': {
                    'intro': 'audit@atelier:~$ ',
                    'unknown': "Cette commande ne donne rien ici. Le rapport est dans /srv/atelier.",
                    'success': "Rapport lu. Tu peux compter les controles preventifs.",
                    'steps': [
                        {
                            'match': ['ls /srv/atelier', r'/^ls .*atelier/', r'/^ls$/'],
                            'output': "rapport-securite.md\nregistre-visites.csv",
                        },
                        {
                            'match': [r'cat .*rapport-securite\.md', r'^cat /srv/atelier/rapport-securite\.md$'],
                            'output': "RAPPORT DE SECURITE — SALLE SERVEUR BATIMENT B\nDate : 12/09\nRedige par : service general\n\nCONTROLES EN PLACE\n-----------------------------------------\n1. Porte a badge sur le sas d entree ............ PREVENTIF\n2. SAS a fermeture automatique (une personne) ... PREVENTIF\n3. Grillage fixe sur les deux fenetres .......... PREVENTIF\n4. Camera fixe au plafond, enregistrement 30 j .. DETECTIF\n5. Panneau « local technique, acces interdit » .. DISSUASIF\n6. Extincteur a gaz, verifie en mars ............ CORRECTIF\n\nOBSERVATIONS\n-----------------------------------------\n- Les badges sont attribues a 14 personnes.\n- Aucun releve de badge n est imprime depuis janvier.\n- La camera enregistre, mais personne ne regarde les images.\n- Le sas reste ouvert en position jour le week-end.\n\nCONCLUSION DU SERVICE\nLa salle est protegee : trois controles preventifs, une camera,\net un panneau d avertissement.",
                        },
                        {
                            'match': [r'cat .*registre-visites\.csv', r'^cat /srv/atelier/registre-visites\.csv$'],
                            'output': "date,entree,sortie,visiteur,motif\n08/09,09:12,09:40,S. Ba,maintenance climatisation\n09/09,14:02,14:20,A. Diallo,depot de materiel\n10/09,10:15,10:55,S. Ba,maintenance climatisation\n(rien le samedi 11 ni le dimanche 12)",
                        },
                        {
                            'match': [r'cat .*', r'less .*', r'more .*'],
                            'output': "Aucun fichier de ce nom dans /srv/atelier.",
                        },
                    ],
                },
            },
            {
                'type': 'exam', 'format': 'qcm',
                'title': "Task 4 : Examen de fin de room",
                'content': "<p>Quatre questions, 8 minutes, seuil 80 %. Aucun indice.</p>",
                'time_limit': 8, 'pass_score': 80,
                'questions': [
                    {
                        'question': "Un controle detectif tombe en panne. Quelle est la consequence, comparee a un controle preventif qui tombe en panne ?",
                        'topic': '1.1',
                        'choices': [
                            "Le preventif laisse passer l'evenement ; le detectif laisse passer sans qu'on le sache",
                            "Aucune difference : dans les deux cas l'evenement se produit, et personne ne s'en apercoit jamais",
                            "Le detectif bloque quand meme l'evenement a lui seul, tandis que le preventif ne bloque plus rien du tout",
                            "Le preventif est plus grave, parce qu'un controle preventif coute beaucoup plus cher a remplacer",
                        ],
                        'correct': 0, 'xp': 15,
                        'explanation': "Un preventif en panne se voit a l'usage : la porte s'ouvre, le pare-feu laisse passer. Un detectif en panne ne se voit pas : plus aucune alerte, et l'illusion que tout va bien. C'est pourquoi un dispositif detectif doit etre surveille lui-meme — une camera que personne ne regarde n'est pas un controle.",
                    },
                    {
                        'question': "Une entreprise installe un panneau « zone video-surveillee » a l'entree, sans installer de camera. Que peut-on dire de ce controle ?",
                        'topic': '1.1',
                        'choices': [
                            "Il est dissuasif seulement : il agit sur la decision, et ne constate rien",
                            "Il est detectif : le panneau signale une intrusion a l'agent de securite",
                            "Il est preventif : le panneau empeche physiquement l'entree non autorisee",
                            "Il est correctif : le panneau permet de retrouver l'auteur apres les faits",
                        ],
                        'correct': 0, 'xp': 15,
                        'explanation': "Le panneau joue sur la crainte d'etre vu. Il ne constate rien, puisqu'il n'y a pas de camera — et c'est un probleme ethique autant que technique : annoncer une surveillance inexistante n'est pas un controle, c'est une affirmation fausse.",
                    },
                    {
                        'question': "Quelle suite de controles decrit correctement la chaine de protection d'une sauvegarde ?",
                        'topic': '1.1',
                        'choices': [
                            "Preventif (acces restreint au stockage), detectif (alerte sur echec), correctif (restauration testee)",
                            "Detectif (acces restreint au stockage), correctif (alerte sur echec), preventif (restauration testee).",
                            "Correctif (acces restreint au stockage), preventif (alerte sur echec), detectif (restauration testee).",
                            "Un seul controle suffit : une sauvegarde chiffree couvre les trois moments a la fois, sans autre mesure a la fois",
                        ],
                        'correct': 0, 'xp': 15,
                        'explanation': "Restreindre l'acces empeche (preventif). Alerter sur un echec de sauvegarde constate (detectif). Restaurer verifie repare (correctif). Une sauvegarde chiffree ne couvre qu'un seul de ces trois moments : la confidentialite du support. Elle ne dit rien de la restaurabilite.",
                    },
                    {
                        'question': "Pourquoi un controle compensatoire doit-il etre documente comme tel, avec le risque residuel accepte ?",
                        'topic': '1.1',
                        'choices': [
                            "Parce qu'il ne remplace pas le controle absent : le risque residuel est plus eleve, et doit etre accepte nommement",
                            "Parce qu'un controle compensatoire coute toujours plus cher que le controle qu'il remplace, a terme, en maintenance",
                            "Parce que la loi interdit d'installer un controle compensatoire sans une autorisation prealable ecrite et signee",
                            "Parce qu'un controle compensatoire devient automatiquement preventif au bout d'un an d'usage regulier",
                        ],
                        'correct': 0, 'xp': 15,
                        'explanation': "Le mot « compensatoire » est un aveu : on sait ce qui manque. Si l'aveu n'est pas ecrit, avec le nom de celui qui accepte le risque, l'organisation croit etre protegee alors qu'elle a choisi de ne pas l'etre. C'est exactement ce que le rapport de la salle serveur cachait.",
                    },
                ],
            },
        ],
    },

    # =================================================================
    # 1.3 — Zero trust
    # =================================================================
    {
        'title': "Le reseau interne etait sur",
        'excerpt': "« On est dans le reseau interne, donc on est en confiance. » C'est la phrase qui a coute le plus cher a cette entreprise. Suis l'attaque qui l'a rendue fausse, et decide ou placer le controle.",
        'content': "Le zero trust ne dit pas « ne faites confiance a personne » : il dit « ne faites confiance a rien sans l'avoir verifie ». Cette room t'apprend a placer un point de decision, et a reperer la confiance implicite qui reste dans une architecture.",
        'difficulty': 'moyen',
        'duration': 35,
        'xp_bonus': 65,
        'track': 'concepts',
        'source': {
            'nom': 'NIST SP 800-207 — Zero Trust Architecture',
            'url': 'https://csrc.nist.gov/pubs/sp/800/207/final',
            'licence': 'Domaine public (publication du NIST, Etats-Unis)',
            'attribution': 'NIST Special Publication 800-207, Zero Trust Architecture (aout 2020)',
        },
        'tasks': [
            {
                'type': 'lesson', 'format': 'lecon',
                'title': "Task 1 : Le chateau fort, et ce qui l'a remplace",
                'content': "<p>Le modele classique s'appelle le <strong>perimetre</strong> : un reseau interieur, repute sur, protege par un rempart (le pare-feu). Une fois dedans, on circule librement. Ce modele suppose que l'interieur est habite par des gens de confiance, et que l'attaquant est dehors.</p><p>Trois faits ont rendu cette hypothese fausse, et aucun n'est une mode :</p><ul><li><strong>le travail a distance</strong> — les utilisateurs sont dehors une partie du temps, et leurs postes aussi ;</li><li><strong>le cloud</strong> — les applications ne sont plus dans le batiment, et le « reseau interne » ne mene plus a elles ;</li><li><strong>la compromission par l'interieur</strong> — hameconnage, poste infecte, prestataire, compte vole. L'attaquant obtient souvent un point d'appui <em>interne</em> avant d'attaquer, et le perimetre ne l'arrete plus.</li></ul><p>Le <strong>zero trust</strong> — que le referentiel nomme aussi <em>confiance zero</em> — (NIST SP 800-207) en tire une regle simple : <em>aucune confiance implicite, quelle que soit la position reseau</em>. Chaque acces est evalue a chaque fois, sur des faits : qui demande, depuis quel appareil, quel est son etat, vers quelle ressource, pour quelle action.</p><p>Deux composants, et il faut les distinguer :</p><ul><li>le <strong>point de decision</strong> (PDP) : il recoit la demande, applique la politique, et rend un verdict — autoriser, refuser, ou autoriser partiellement ;</li><li>le <strong>point d'application</strong> (PEP) : il fait respecter le verdict. C'est la porte, pas le juge.</li></ul><p>Quatre malentendus, tous frequents :</p><ul><li>« zero trust veut dire zero acces » — non. Il veut dire <em>verification avant acces</em>. Un utilisateur legitime travaille normalement ;</li><li>« zero trust, c'est un produit » — non. C'est une architecture : une politique, des sources de contexte, et un point d'application. Un produit peut la servir, aucun ne la remplace ;</li><li>« le reseau interne est de confiance, seul l'exterieur est verifie » — c'est precisement l'erreur que le modele corrige ;</li><li>« zero trust supprime la segmentation » — non, il la rend plus fine : le micro-segment remplace le grand VLAN interne.</li></ul><p>Le principe qui resume tout, et qui vient du moindre privilege : <strong>un acces accorde pour une action ne vaut pas pour les autres</strong>. Lire un dossier ne donne pas le droit de l'ecrire, et se connecter le matin ne donne pas le droit de se connecter a minuit depuis un autre pays.</p><p><strong>A retenir :</strong> la question du zero trust n'est pas « suis-je dedans ou dehors », mais « sur quels faits je viens de decider, et ou est la porte qui applique ma decision ».</p>",
                'questions': [],
            },
            {
                'type': 'practice', 'format': 'qcm',
                'title': "Task 2 : Entrainement — trois confiances implicites",
                'content': "<p>Trois situations. A chaque fois : ou se trouve la confiance implicite, et que faudrait-il verifier ?</p>",
                'questions': [
                    {
                        'question': "Une application interne accepte toute requete venant d'une adresse IP du reseau 10.0.0.0/8, sans autre controle. Quel est le defaut zero trust ?",
                        'topic': '1.3',
                        'choices': [
                            "La confiance vient de la position reseau, et non de l'identite ni de l'etat de l'appareil",
                            "Aucun : une adresse IP interne est une preuve d'identite suffisante en pratique, dans un reseau maitrise",
                            "Le defaut est la taille du reseau : un /8 est trop grand pour etre segmente un jour correctement",
                            "Le defaut est l'absence de chiffrement, la position reseau n'ayant aucun rapport avec la question",
                        ],
                        'correct': 0, 'xp': 10,
                        'hint': "Un attaquant qui obtient un poste interne obtient aussi une adresse interne.",
                        'explanation': "L'adresse IP dit d'ou vient la connexion, pas qui la fait. Un poste infecte, un VPN mal configure ou un serveur detourne donnent une adresse interne parfaitement legitime. Le zero trust demande une identite verifiee et un etat d'appareil, pas une position.",
                    },
                    {
                        'question': "Un administrateur possede un compte a privileges eleves, qu'il utilise aussi pour lire ses courriels. Pourquoi est-ce un probleme dans une architecture zero trust ?",
                        'topic': '1.3',
                        'choices': [
                            "Le privilege est permanent et polyvalent : une action banale expose un droit qui ne devrait servir qu'a une action precise",
                            "Ce n'est pas un probleme des lors que le compte est protege par un second facteur d'authentification, meme s'il est polyvalent",
                            "Le probleme est la boite mail, qui devrait etre interdite a tout administrateur systeme du site, pour toujours et partout",
                            "Le probleme est la lenteur : un compte privilegie met plus de temps a s'authentifier a chaque fois qu'on l'ouvre, le matin",
                        ],
                        'correct': 0, 'xp': 10,
                        'hint': "Un courriel malveillant lu avec un compte administrateur, que se passe-t-il ?",
                        'explanation': "C'est le principe du moindre privilege applique dans le temps : un droit eleve doit exister au moment de l'action, pas avant ni apres. Un compte d'administration separe, et eleve a la demande, reduit la fenetre pendant laquelle une erreur de lecture devient une compromission totale.",
                    },
                    {
                        'question': "Une entreprise a deploye un portail d'authentification unique (SSO) devant toutes ses applications. Peut-elle dire qu'elle a fait du zero trust ?",
                        'topic': '1.3',
                        'choices': [
                            "Non : le SSO verifie l'identite une fois, il ne reevalue pas l'acces a chaque action",
                            "Oui : le SSO est le composant central du zero trust, et tout le reste en decoule naturellement",
                            "Oui, a condition que le SSO soit heberge dans le cloud et non sur un serveur du site",
                            "Non : le zero trust interdit le SSO, qui cree un point unique de defaillance pour tout le monde",
                        ],
                        'correct': 0, 'xp': 10,
                        'hint': "Une fois la session ouverte, que verifie-t-on avant chaque action ?",
                        'explanation': "Le SSO est une brique utile — il donne une identite fiable — mais il raisonne en session : une fois ouverte, elle dure. Le zero trust demande une decision par action, avec le contexte du moment. Le SSO repond a « qui es-tu », pas a « as-tu encore le droit, maintenant, d'ici ».",
                    },
                ],
            },
            {
                'type': 'test', 'format': 'pratique',
                'title': "Task 3 : La mission — compter les acces sans verification",
                'content': "<p><strong>Mission.</strong> L'audit d'architecture du service est sur la machine de l'atelier. Il liste les regles d'acces et, pour chacune, le controle applique.</p><p>Trouve <strong>le nombre de regles qui reposent sur la seule position reseau</strong>, sans verification d'identite ni d'etat de l'appareil, tel qu'il est ecrit dans l'audit (un nombre, en chiffres).</p>",
                'questions': [
                    {
                        'question': "Combien de regles d'acces reposent sur la seule position reseau, d'apres l'audit ?",
                        'mode': 'text', 'topic': '1.3',
                        'answers': [r'/\b5\b/'],
                        'xp': 40,
                        'hint': "Dans le terminal : <code>cat /srv/atelier/audit-architecture.md</code>. Compte les lignes dont la colonne CONTROLE vaut « position reseau ».",
                        'explanation': "Cinq regles sur huit ne verifient que la position. Trois verifient l'identite (compte nominatif) et une verifie l'etat de l'appareil — mais elles ne sont pas combinees : aucune regle ne demande les deux a la fois. C'est le defaut de fond : une architecture zero trust evalue plusieurs faits ensemble, pas un seul.",
                    },
                ],
                'terminal': {
                    'intro': 'architecte@atelier:~$ ',
                    'unknown': "Cette commande ne donne rien ici. L'audit est dans /srv/atelier.",
                    'success': "Audit lu. Tu peux compter les regles en confiance implicite.",
                    'steps': [
                        {
                            'match': ['ls /srv/atelier', r'/^ls .*atelier/', r'/^ls$/'],
                            'output': "audit-architecture.md\nplan-segmentation.txt",
                        },
                        {
                            'match': [r'cat .*audit-architecture\.md'],
                            'output': "AUDIT D ARCHITECTURE — ACCES AUX SERVICES INTERNES\nDate : 03/10\nAuditeur : cabinet externe\n\nREGLES D ACCES (8)\n-----------------------------------------\nR1  Administration BDD    | source 10.0.0.0/8      | CONTROLE : position reseau\nR2  Partages fichiers    | source 10.0.0.0/8      | CONTROLE : position reseau\nR3  Console de sauvegarde| source 10.20.0.0/16    | CONTROLE : compte nominatif\nR4  API facturation      | source 10.0.0.0/8      | CONTROLE : position reseau\nR5  Supervision          | source toute         | CONTROLE : position reseau\nR6  Portail RH           | source Internet      | CONTROLE : compte nominatif + etat appareil\nR7  Deploiement          | source 10.0.0.0/8      | CONTROLE : position reseau\nR8  Messagerie interne   | source 10.0.0.0/8      | CONTROLE : compte nominatif\n\nOBSERVATIONS\n-----------------------------------------\n- Le reseau 10.0.0.0/8 couvre 16 millions d adresses.\n- Le VPN attribue une adresse 10.x a tout poste connecte,\n  y compris personnel, sans controle d etat.\n- Une seule regle combine identite ET etat de l appareil : R6.\n- Le plan de segmentation prevu n a jamais ete applique.",
                        },
                        {
                            'match': [r'cat .*plan-segmentation\.txt'],
                            'output': "PLAN DE SEGMENTATION (jamais applique)\n- decouper 10.0.0.0/8 en 12 segments par metier\n- un pare-feu entre chaque segment\n- authentification par service, pas par reseau\nStatut : valide en comite, non finance.",
                        },
                        {
                            'match': [r'cat .*', r'less .*', r'more .*'],
                            'output': "Aucun fichier de ce nom dans /srv/atelier.",
                        },
                    ],
                },
            },
            {
                'type': 'exam', 'format': 'qcm',
                'title': "Task 4 : Examen de fin de room",
                'content': "<p>Quatre questions, 8 minutes, seuil 80 %. Aucun indice.</p>",
                'time_limit': 8, 'pass_score': 80,
                'questions': [
                    {
                        'question': "Dans une architecture zero trust, quelle est la difference entre le point de decision et le point d'application ?",
                        'topic': '1.3',
                        'choices': [
                            "Le premier rend le verdict sur la demande ; le second fait respecter ce verdict",
                            "Le premier fait respecter le verdict ; le second le rend apres inspection du trafic",
                            "Les deux sont synonymes : le vocabulaire change selon le fournisseur de la solution",
                            "Le premier est humain et le second automatique, dans toute architecture conforme",
                        ],
                        'correct': 0, 'xp': 15,
                        'explanation': "Le PDP juge, le PEP applique. Les confondre revient a croire qu'un pare-feu decide de la politique : il l'execute, sur ordre d'un autre composant. C'est cette separation qui permet de changer la politique sans toucher aux portes.",
                    },
                    {
                        'question': "Un poste de travail est infecte par un cheval de Troie. En quoi cela illustre-t-il la limite du modele perimetrique ?",
                        'topic': '1.3',
                        'choices': [
                            "Le poste est interne, donc repute sur : l'attaquant circule sans franchir le rempart",
                            "Le pare-feu aurait du bloquer le cheval de Troie, il est donc mal configure depuis le debut",
                            "Le modele perimetrique est adapte, c'est l'antivirus du poste qui a echoue tout seul seul",
                            "Cela n'illustre rien : un poste infecte reste un probleme de poste, et non un probleme de reseau",
                        ],
                        'correct': 0, 'xp': 15,
                        'explanation': "L'attaquant n'a pas eu besoin de forcer le perimetre : il est entre par un courriel, sur un poste legitime, et se retrouve a l'interieur avec les droits de ce poste. Le zero trust repond a cela en verifiant chaque acces, y compris ceux qui viennent de l'interieur.",
                    },
                    {
                        'question': "Que signifie « moindre privilege » applique a un compte d'administration, dans le temps ?",
                        'topic': '1.3',
                        'choices': [
                            "Le droit eleve n'existe que pendant l'action qui le justifie, puis il est retire",
                            "Le compte d'administration doit etre cree le plus tard possible apres l'embauche du salarie",
                            "Le compte doit avoir moins de droits que les autres comptes, de facon permanente et verifiee",
                            "Le mot de passe du compte doit etre change plus souvent que celui des autres utilisateurs",
                        ],
                        'correct': 0, 'xp': 15,
                        'explanation': "Le privilege doit etre une fenetre, pas un statut. Eleve a la demande, pour une duree bornee, il reduit la periode pendant laquelle un vol de session ou une erreur de manipulation devient une compromission. Un compte administrateur permanent est un droit ouvert vingt-quatre heures sur vingt-quatre.",
                    },
                    {
                        'question': "Une entreprise applique le zero trust a ses utilisateurs, mais laisse ses serveurs communiquer librement entre eux dans le meme VLAN. Quel est le probleme ?",
                        'topic': '1.3',
                        'choices': [
                            "La confiance implicite demeure entre serveurs : une machine compromise donne acces aux autres",
                            "Aucun : le zero trust ne concerne que les utilisateurs, jamais les machines qui se parlent entre elles",
                            "Le probleme est la taille du VLAN : au-dela de dix serveurs, il faut un autre modele reseau, plus plat",
                            "Le probleme est le chiffrement : les flux entre serveurs ne sont jamais chiffres, par defaut, en interne",
                        ],
                        'correct': 0, 'xp': 15,
                        'explanation': "C'est le mouvement lateral, et c'est la raison d'etre du micro-segment : un serveur web compromis ne doit pas pouvoir joindre la base de donnees simplement parce qu'ils partagent un VLAN. Le zero trust s'applique aux charges de travail aussi, souvent avec plus d'enjeu qu'aux utilisateurs.",
                    },
                ],
            },
        ],
    },

    # =================================================================
    # 1.4 + 1.7 — Gestion du changement et securite physique
    # =================================================================
    {
        'title': "La porte du fond, ouverte en decembre",
        'excerpt': "Une intervention de maintenance ouvre une porte qui ne se refermera pas. Personne n'a change la configuration : quelqu'un l'a changee, sans documenter, un vendredi. Voila comment un changement non trace devient une intrusion.",
        'content': "Deux sujets du referentiel se rejoignent dans une seule histoire : la gestion du changement (1.4) et la securite physique (1.7). Un changement de configuration non autorise et non documente, qui ouvre une porte — au sens propre.",
        'difficulty': 'moyen',
        'duration': 35,
        'xp_bonus': 65,
        'track': 'concepts',
        'source': {
            'nom': 'NIST SP 800-128 — Guide for Security-Focused Configuration Management',
            'url': 'https://csrc.nist.gov/pubs/sp/800/128/final',
            'licence': 'Domaine public (publication du NIST, Etats-Unis)',
            'attribution': 'NIST Special Publication 800-128, Guide for Security-Focused Configuration Management of Information Systems (aout 2011) ; NIST SP 800-53 Rev. 5, famille PE (Physical and Environmental Protection)',
        },
        'tasks': [
            {
                'type': 'lesson', 'format': 'lecon',
                'title': "Task 1 : Un changement, quatre traces, et une porte",
                'content': "<p>La <strong>gestion du changement</strong> (<em>change management</em> dans les referentiels anglais, et sur les offres d'emploi) n'est pas de la paperasse : c'est ce qui permet de repondre, six mois plus tard, a la question « qui a modifie cela, quand, pourquoi, et qui l'a valide ». Le NIST SP 800-128 en donne le socle : une <em>ligne de base</em> documentee, un <em>changement</em> autorise avant application, une <em>verification</em> apres, et un <em>retour arriere</em> possible.</p><p>Quatre elements, et il en manque toujours un dans les organisations en crise :</p><ul><li><strong>la ligne de base</strong> — l'etat de reference, ecrit. Sans elle, personne ne sait ce qui a change, puisque personne ne sait ce qu'il y avait avant ;</li><li><strong>l'autorisation</strong> — qui a le droit de changer quoi. Une urgence n'annule pas l'autorisation : elle la rend <em>a posteriori</em>, avec une trace ;</li><li><strong>la trace</strong> — le changement laisse une ecriture : ticket, journal, commit, bon d'intervention. Une modification sans trace n'est pas un changement, c'est un accident en attente ;</li><li><strong>le retour arriere</strong> — comment revenir a la ligne de base. Un changement qu'on ne sait pas defaire se decide a deux fois.</li></ul><p>Trois types de changement, et un seul exige la trace complete : le <strong>standard</strong> (pre-approuve, repetitif), le <strong>normal</strong> (valide en comite), l'<strong>urgent</strong> (applique tout de suite, valide apres). Le changement urgent est celui qui casse tout, parce qu'il est applique par quelqu'un qui n'a pas le temps d'ecrire.</p><p>La <strong>securite physique</strong> (sujet 1.7) obeit exactement aux memes regles, et c'est la que l'histoire de cette room se noue :</p><ul><li><strong>le controle d'acces physique</strong> — badge, sas, registre de visiteurs. Un badge non releve n'est pas un controle : c'est une serrure dont personne ne verifie la clef ;</li><li><strong>le tailgating</strong> — entrer derriere une personne autorisee, sans badge. Aucun badge ne l'empeche : seul un sas a fermeture automatique, ou une consigne tenue, le fait ;</li><li><strong>la salle serveur</strong> — un local dont l'acces est trace, et dont l'etat physique (temperature, eau, feu, alimentation) est surveille ;</li><li><strong>le changement physique</strong> — une intervention de maintenance qui ouvre une porte, deplace une armoire ou desactive une alarme est un changement de configuration au meme titre qu'une modification de pare-feu. Elle doit etre autorisee, tracee, et verifiee apres.</li></ul><p><strong>Le point qui relie les deux sujets :</strong> la plupart des intrusions physiques ne demandent aucune effraction. Elles profitent d'un changement non referme — une porte de service laissee en position jour, un badge de prestataire non revoque, une alarme coupee pour une intervention et jamais remise. Ce n'est pas un defaut de serrure : c'est un defaut de gestion du changement.</p><p><strong>A retenir :</strong> une porte n'est sure que si l'on sait qui l'a ouverte en dernier, pourquoi, et si elle a ete refermee. La question vaut pour la porte du batiment comme pour la regle de pare-feu.</p>",
                'questions': [],
            },
            {
                'type': 'practice', 'format': 'qcm',
                'title': "Task 2 : Entrainement — trois changements, trois defauts",
                'content': "<p>Trois changements reels. A chaque fois : quel element manque, et quelle porte s'ouvre ?</p>",
                'questions': [
                    {
                        'question': "Un prestataire intervient sur la climatisation un vendredi. Il desactive l'alarme de la salle serveur pour ne pas la declencher, et oublie de la remettre. Que manque-t-il ?",
                        'topic': '1.7',
                        'choices': [
                            "La verification apres intervention : personne n'a controle que l'etat initial etait retabli",
                            "L'autorisation : un prestataire ne devrait jamais toucher a une alarme, meme accompagne sur site",
                            "La ligne de base : l'alarme n'etait pas documentee avant l'intervention du prestataire du prestataire",
                            "Rien : c'est une intervention de maintenance, elle est hors du perimetre du changement",
                        ],
                        'correct': 0, 'xp': 10,
                        'hint': "L'intervention etait peut-etre autorisee. Qu'est-ce qui n'a pas eu lieu apres ?",
                        'explanation': "Desactiver une alarme peut etre legitime, et souvent necessaire. Ce qui manque, c'est la verification de retour a l'etat initial : une case a cocher en fin d'intervention, signee par l'accompagnant. La porte est restee ouverte pendant des semaines, sans que personne ne l'ait decide.",
                    },
                    {
                        'question': "Un administrateur modifie une regle de pare-feu pour depanner un utilisateur, sans ouvrir de ticket. Le changement fonctionne. Quel est le risque principal ?",
                        'topic': '1.4',
                        'choices': [
                            "Personne ne saura pourquoi cette regle existe, ni si elle peut etre retiree sans casser quelque chose",
                            "Aucun, puisque le changement a resolu le probleme et qu'il est reversible en theorie, sans risque aucun",
                            "Le risque est la performance du pare-feu, qui se degrade a chaque regle ajoutee au fil des ans, lentement",
                            "Le risque est juridique uniquement : la loi impose un ticket pour chaque modification du systeme, sans exception",
                        ],
                        'correct': 0, 'xp': 10,
                        'hint': "Dans six mois, quelqu'un voudra nettoyer les regles. Que fera-t-il de celle-la ?",
                        'explanation': "Une regle sans trace devient une regle intouchable : personne n'ose la retirer, de peur de casser un service dont plus personne ne se souvient. Le risque n'est pas le changement lui-meme, c'est qu'il devienne invisible et permanent. C'est ainsi qu'un pare-feu se remplit de trous que personne n'a decides.",
                    },
                    {
                        'question': "Quelle est la difference entre un changement normal et un changement urgent, du point de vue de la trace ?",
                        'topic': '1.4',
                        'choices': [
                            "Aucune sur la trace : l'urgent est simplement autorise apres application, pas avant",
                            "L'urgent n'a pas besoin de trace, puisqu'il repond a une situation exceptionnelle et imprevue",
                            "L'urgent se trace dans un journal different, qui n'est pas consultable par l'audit interne",
                            "L'urgent est autorise avant application, comme un changement normal, mais avec un delai plus court",
                        ],
                        'correct': 0, 'xp': 10,
                        'hint': "L'urgence change le moment de l'autorisation, pas son existence.",
                        'explanation': "Un changement urgent est applique d'abord, valide ensuite — c'est ce qui le rend urgent. Mais la trace reste obligatoire, et c'est elle qui permet la validation apres coup. Un changement urgent non trace est indistinguable d'une compromission : on ne peut pas dire s'il a ete decide ou subi.",
                    },
                ],
            },
            {
                'type': 'test', 'format': 'pratique',
                'title': "Task 3 : La mission — retrouver le changement qui a ouvert la porte",
                'content': "<p><strong>Mission.</strong> Une intrusion a eu lieu par une porte de service. Le journal des changements est sur la machine de l'atelier, et il contient toutes les interventions du batiment.</p><p>Trouve <strong>le numero du changement</strong> qui a laisse la porte ouverte (format <code>CHG-XX</code>). C'est lui qui explique l'intrusion.</p>",
                'questions': [
                    {
                        'question': "Quel numero de changement a laisse la porte de service ouverte ? (format CHG-XX)",
                        'mode': 'text', 'topic': '1.4',
                        'answers': [r'/CHG-?\s?0?7/i', r'/chg-?0?7/i'],
                        'xp': 40,
                        'hint': "Dans le terminal : <code>cat /srv/atelier/journal-changements.log</code>. Cherche une intervention sur un acces physique dont l'etat final n'est pas « referme ».",
                        'explanation': "Le CHG-07 est une intervention de maintenance sur le ferme-porte de la porte de service, cloturee sans verification de l'etat final. Le ferme-porte n'a pas ete remis en service, et la porte est restee ouverte pendant trois semaines. Le journal ne dit pas « porte ouverte » : il dit « non verifie ». C'est exactement le trou que la gestion du changement doit boucher.",
                    },
                ],
                'terminal': {
                    'intro': 'batiment@atelier:~$ ',
                    'unknown': "Cette commande ne donne rien ici. Le journal est dans /srv/atelier.",
                    'success': "Journal lu. Tu peux nommer le changement fautif.",
                    'steps': [
                        {
                            'match': ['ls /srv/atelier', r'/^ls .*atelier/', r'/^ls$/'],
                            'output': "journal-changements.log\nplan-acces.txt",
                        },
                        {
                            'match': [r'cat .*journal-changements\.log', r'grep .*CHG.*journal'],
                            'output': "JOURNAL DES CHANGEMENTS — BATIMENT B (trimestre 4)\n----------------------------------------------------\nCHG-01  02/10  Pare-feu      ajout regle 443 vers serveur MAJ   | cloture : verifie\nCHG-02  09/10  Badge         ajout prestataire S. Ba            | cloture : verifie\nCHG-03  14/10  Alarme        report detecteur couloir           | cloture : verifie\nCHG-04  21/10  Serveur       mise a jour noyau                  | cloture : verifie\nCHG-05  28/10  Reseau        changement VLAN atelier            | cloture : verifie\nCHG-06  04/11  Badge         revocation stagiaire A. Diallo     | cloture : verifie\nCHG-07  02/12  Physique      ferme-porte porte de service       | cloture : NON VERIFIE\nCHG-08  09/12  Sauvegarde    ajout volume archive               | cloture : verifie\nCHG-09  16/12  Physique      remplacement ampoule couloir       | cloture : verifie\n\nNOTE DE L EQUIPE BATIMENT\nLe ferme-porte de la porte de service a ete demonte pour\npeinture le 02/12. Il devait etre repose le lendemain.\nPersonne ne l a repose. La porte est restee en position\njour jusqu au constat du 23/12.\n\nAucune intrusion n a ete detectee : l alarme de la porte\nde service est sur le meme detecteur que le CHG-03,\nreporte au 14/10 et jamais remis en service.",
                        },
                        {
                            'match': [r'cat .*plan-acces\.txt'],
                            'output': "PLAN D ACCES — BATIMENT B\n- entree principale : badge + sas\n- porte de service : badge + ferme-porte (acces parking)\n- quai de livraison : badge + grille (journee seulement)\n- fenetres salle serveur : grillage fixe\nRegle : toute intervention sur un acces physique\n        exige une verification de l etat final, signee.",
                        },
                        {
                            'match': [r'cat .*', r'less .*', r'more .*'],
                            'output': "Aucun fichier de ce nom dans /srv/atelier.",
                        },
                    ],
                },
            },
            {
                'type': 'exam', 'format': 'qcm',
                'title': "Task 4 : Examen de fin de room",
                'content': "<p>Quatre questions, 8 minutes, seuil 80 %. Aucun indice.</p>",
                'time_limit': 8, 'pass_score': 80,
                'questions': [
                    {
                        'question': "Pourquoi la ligne de base est-elle le premier element de la gestion du changement ?",
                        'topic': '1.4',
                        'choices': [
                            "Sans etat de reference ecrit, personne ne peut dire ce qui a change ni revenir en arriere",
                            "Parce que la ligne de base est exigee par la loi avant tout changement informatique notable",
                            "Parce qu'elle remplace l'autorisation : un changement conforme a la base est approuve d'office",
                            "Parce qu'elle permet de mesurer la performance du systeme avant et apres le changement",
                        ],
                        'correct': 0, 'xp': 15,
                        'explanation': "La ligne de base est ce a quoi on compare. Sans elle, un changement est invisible : on ne peut ni le detecter, ni l'evaluer, ni l'annuler. C'est le sens du NIST SP 800-128 : la gestion de configuration commence par une description ecrite de l'etat attendu.",
                    },
                    {
                        'question': "Un sas a fermeture automatique protege contre quelle pratique, qu'un simple badge ne bloque pas ?",
                        'topic': '1.7',
                        'choices': [
                            "Le tailgating : entrer derriere une personne autorisee, sans presenter de badge",
                            "Le vol de badge : un badge vole ne fonctionne plus des qu'il est signale par son porteur",
                            "L'usurpation d'identite : le sas verifie la photo du porteur du badge a chaque passage",
                            "La perte de badge : le sas invalide le badge perdu des la premiere utilisation qui en est faite",
                        ],
                        'correct': 0, 'xp': 15,
                        'explanation': "Le tailgating ne casse aucune serrure : il profite de la politesse. Un badge unique ne l'empeche pas, puisqu'une seule presentation ouvre pour deux personnes. Seul un dispositif qui compte les passages — sas, tourniquet — ou une consigne tenue par les equipes le limite.",
                    },
                    {
                        'question': "Une intervention de maintenance desactive une alarme pendant deux heures. Quel est le controle qui manque le plus souvent, et qui compte le plus ?",
                        'topic': '1.7',
                        'choices': [
                            "La verification de remise en service en fin d'intervention, signee par un temoin",
                            "L'autorisation ecrite du prestataire, qui doit etre archivee pendant cinq ans par le service",
                            "L'information des salaries, qui doivent etre prevenus de la desactivation par courriel",
                            "La presence d'un agent de securite pendant toute la duree de l'intervention dans le batiment",
                        ],
                        'correct': 0, 'xp': 15,
                        'explanation': "Desactiver une alarme est parfois unavoidable — un detecteur se declenche a cause des travaux. Ce qui n'est pas acceptable, c'est de ne pas verifier qu'elle est revenue. Le controle manquant est un geste simple, en fin d'intervention, avec un nom en face. C'est celui que le CHG-07 de la room n'avait pas.",
                    },
                    {
                        'question': "Un changement de configuration non trace est decouvert six mois plus tard. Pourquoi est-il plus dangereux qu'un changement trace, meme s'il etait legitime au depart ?",
                        'topic': '1.4',
                        'choices': [
                            "Personne ne peut dire s'il a ete decide ou subi, ni s'il est encore necessaire",
                            "Il consomme plus de ressources, parce qu'il n'a pas ete optimise a l'application",
                            "Il expire automatiquement au bout d'un an, ce qui casse le service brutalement",
                            "Il n'est pas plus dangereux : seule la forme de la trace distingue les deux cas",
                        ],
                        'correct': 0, 'xp': 15,
                        'explanation': "Un changement trace porte son auteur, son motif et sa date : on peut le comprendre, le garder ou le retirer. Un changement non trace est indiscernable d'une porte derobee, et c'est cette ambiguite qui coute cher : soit on garde un trou, soit on retire une regle dont un service depend peut-etre.",
                    },
                ],
            },
        ],
    },
]


# ---------------------------------------------------------------------------
# Traduction anglaise
#
# Le texte anglais vit dans d1_en.py, pas ici : une traduction relue dans un
# fichier de 570 lignes qui contient aussi le francais ne se relit pas.
# Il est attache ici pour que le generateur (ecrire.py) n'ait qu'une seule
# forme de room a connaitre.
# ---------------------------------------------------------------------------

_CLE_PAR_TITRE = {
    "Le portique qui n'a arrete personne": 'concepts-01',
    "Le reseau interne etait sur": 'concepts-02',
    "La porte du fond, ouverte en decembre": 'concepts-03',
}


def _charge_traductions():
    import importlib.util
    import os

    chemin = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'd1_en.py')
    spec = importlib.util.spec_from_file_location('d1_en', chemin)
    module = importlib.util.module_from_spec(spec)
    spec.loader.exec_module(module)

    return module.EN


for _room in ROOMS:
    _trad = _charge_traductions().get(_CLE_PAR_TITRE.get(_room['title'], ''))

    if _trad:
        # L'index de la bonne reponse n'est pas traduit : il est recopie du
        # francais, question par question. Le verificateur a deja refuse un
        # desaccord de structure ; recopier ici evite de maintenir deux fois
        # le meme chiffre, et donc de le voir diverger.
        for _t_fr, _t_en in zip(_room['tasks'], _trad['tasks']):
            for _q_fr, _q_en in zip(_t_fr.get('questions') or [],
                                    _t_en.get('questions') or []):
                if 'correct' in _q_fr:
                    _q_en['correct'] = _q_fr['correct']

        # Les reponses ecrites ont besoin de leur motif dans les DEUX
        # langues : la question se lit en anglais, mais elle est notee par
        # le meme motif. Les choix, eux, ont leur traduction propre.
        for _t_fr, _t_en in zip(_room['tasks'], _trad['tasks']):
            for _q_fr, _q_en in zip(_t_fr.get('questions') or [],
                                    _t_en.get('questions') or []):
                if 'answers' in _q_fr:
                    _q_en['mode'] = 'text'
                    _q_en['answers'] = list(_q_fr['answers'])

        _room['en'] = {
            'title': _trad['title'],
            'excerpt': _trad['excerpt'],
            'tasks': _trad['tasks'],
        }

del _room
