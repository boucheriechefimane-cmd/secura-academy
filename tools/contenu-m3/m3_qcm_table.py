# -*- coding: utf-8 -*-
"""
Table des QCM M3.

Cle : (scenario, type de tache, index de question)
Valeur : dict avec
  d : les 3 mauvaises propositions
  h : l'indice affiche apres un echec
  q : (optionnel) question reecrite

La bonne reponse est reprise telle quelle du contenu existant (1re reponse).
"""

TABLE = {
    # ---------------- Scenario 1 : triage ----------------
    (1, 'P', 1): {
        'd': ['En redemarrant le serveur tout de suite',
              'En changeant le mot de passe de la base',
              'En supprimant les journaux pour repartir de zero'],
        'h': 'Une correction sans observation, c\'est un coup au hasard.',
    },
    (1, 'P', 2): {
        'd': ['C\'est normal pour un serveur interne',
              'Il suffit de restreindre les droits du fichier',
              'Ce n\'est un probleme que si le fichier est sur Internet'],
        'h': 'Pense au sort du fichier : qui peut le lire ?',
    },
    (1, 'P', 3): {
        'd': ['Elle est ecrite en couleur dans le terminal',
              'Elle contient le nom de l\'administrateur du serveur',
              'Plus le fichier de journal est gros, plus la trace est utile'],
        'h': 'Sans heure ni evenement, une ligne de journal ne raconte rien.',
    },
    (1, 'E', 1): {
        'd': ['Redemarrer le service',
              'Reinstaller le serveur',
              'Couper le trafic pour proteger le site'],
        'h': 'Le premier reflexe, c\'est de voir, pas de toucher.',
    },
    (1, 'E', 2): {
        'd': ['Parce que le fichier ne peut pas etre sauvegarde',
              'Parce que le fichier occupe trop de place',
              'Parce que les fichiers de configuration sont lents a lire'],
        'h': 'Qui peut lire le fichier ?',
    },
    (1, 'E', 3): {
        'd': ['Le nombre de visiteurs du jour',
              'La couleur du site',
              'Le mot de passe de l\'administrateur'],
        'h': 'Une trace exploitable dit QUAND et QUOI.',
    },
    (1, 'E', 4): {
        'd': ['Dans /var/backups/app/db.sql.bak',
              'Dans /etc/passwd',
              'Dans /var/log/app/access.log'],
        'h': 'Regarde ce que dit la page d\'etat du service.',
    },
    (1, 'E', 5): {
        'd': ['Augmenter la memoire du serveur',
              'Redemarrer le service pour liberer la memoire',
              'Migrer le service vers un autre serveur'],
        'h': 'On optimise ce qu\'on a mesure.',
    },

    # ---------------- Scenario 2 : mot de passe ----------------
    (2, 'P', 1): {
        'd': ['Dans un fichier de configuration protege par un mot de passe',
              'Dans le code source, chiffre par l\'application',
              'Dans une variable de session'],
        'h': 'Pense a ce que veut dire « accessible par quiconque a le fichier ».',
    },
    (2, 'P', 2): {
        'd': ['Le corriger immediatement, sans rien dire a personne',
              'Ne rien faire : c\'est un detail',
              'Le publier dans le canal de l\'equipe pour que chacun le memorise'],
        'h': 'Le probleme ne disparait pas parce que tu l\'as vu.',
    },
    (2, 'E', 1): {
        'd': ['Qu\'il ralentit le chargement de l\'application',
              'Qu\'il occupe une ligne de trop dans le fichier',
              'Qu\'il expire au bout de quelques jours'],
        'h': 'Le secret separe de l\'application.',
    },
    (2, 'E', 2): {
        'd': ['Non, tant que le serveur reste interne',
              'Seulement si le fichier a ete publie sur Internet',
              'Seulement si un administrateur l\'a signale'],
        'h': 'On suppose que le secret a ete vu : il faut le considerer vole.',
    },
    (2, 'E', 3): {
        'd': ['Modifier la configuration de l\'application a distance',
              'Redemarrer le service web',
              'Reinitialiser la base de donnees'],
        'h': 'Une page de diagnostic observe, elle ne commande pas.',
    },
    (2, 'E', 4): {
        'd': ['Dans un fichier .env en clair a cote du code',
              'Dans le journal de demarrage du serveur',
              'Dans un commentaire du fichier de configuration'],
        'h': 'Le secret doit etre injecte au moment du demarrage.',
    },
    (2, 'E', 5): {
        'd': ['Parce que l\'application demarre plus lentement',
              'Parce que les fichiers ne peuvent plus etre compares',
              'Parce qu\'il faut redeployer a chaque changement de secret'],
        'h': 'Chaque copie est une porte d\'entree de plus.',
    },

    # ---------------- Scenario 3 : XSS ----------------
    (3, 'P', 1): {
        'd': ['Elle s\'execute sur le serveur, avec les droits de l\'administrateur',
              'Elle s\'execute dans la base de donnees',
              'Elle ne s\'execute que sur les navigateurs anciens'],
        'h': 'La page est sur TON serveur, mais elle est lue par SON navigateur.',
    },
    (3, 'P', 2): {
        'd': ['Bloquer le mot « script » dans la saisie',
              'Refuser toutes les requetes contenant des chevrons',
              'Demander a l\'utilisateur de ne pas cliquer'],
        'h': 'Le filtre par liste de mots est toujours incomplet.',
    },
    (3, 'E', 1): {
        'd': ['Dans le serveur web, avec les droits du service',
              'Dans la base de donnees',
              'Dans le terminal de l\'administrateur'],
        'h': 'Qui execute le code que tu injectes ?',
    },
    (3, 'E', 2): {
        'd': ['Parce qu\'elle sature le serveur de requetes',
              'Parce qu\'elle rend le site plus lent pour tous',
              'Parce qu\'elle supprime les cookies du visiteur'],
        'h': 'Pense a qui consulte cette page en entreprise.',
    },
    (3, 'E', 3): {
        'd': ['Supprimer tous les caracteres < et > du texte',
              'Remplacer les mots dangereux par des asterisques',
              'Bloquer la requete si elle contient une balise'],
        'h': 'On ne supprime pas le contenu : on change sa signification.',
    },
    (3, 'E', 4): {
        'd': ['Oui, si le filtre est applique sur toutes les pages',
              'Oui, si l\'encodage de la page est en UTF-8',
              'Oui, sauf sur les pages de connexion'],
        'h': 'Un filtre se contourne avec une variante.',
    },
    (3, 'E', 5): {
        'd': ['Un pare-feu installe dans le navigateur',
              'Une regle qui interdit aux robots de visiter la page',
              'Un mot de passe du compte administrateur'],
        'h': 'C\'est un en-tete envoye par le serveur au navigateur.',
    },

    # ---------------- Scenario 4 : injection SQL ----------------
    (4, 'P', 1): {
        'd': ['Le fait d\'utiliser une base de donnees SQL',
              'L\'utilisation de requetes preparees',
              'Le grand nombre de tables dans la base'],
        'h': 'Regarde comment la requete est construite.',
    },
    (4, 'P', 2): {
        'd': ['Parce qu\'elle est chiffree avant d\'arriver au serveur',
              'Parce qu\'elle interdit toute erreur d\'authentification',
              'Parce que le moteur refuse les requetes trop longues'],
        'h': 'Le moteur distingue-t-il la structure et la donnee ?',
    },
    (4, 'E', 1): {
        'd': ['Le filtrage de l\'apostrophe dans le formulaire',
              'La mise en cache des pages',
              'L\'utilisation du HTTPS'],
        'h': 'La parade se trouve dans le code, pas dans le filtre.',
    },
    (4, 'E', 2): {
        'd': ['Pour que la base occupe moins de place',
              'Pour que les identifiants soient plus courts',
              'Pour que la connexion soit plus rapide'],
        'h': 'Pense au pire : la base est volee.',
    },
    (4, 'E', 3): {
        'd': ['Il rend la requete plus lente',
              'Il supprime la table visee',
              'Il bloque la connexion au serveur'],
        'h': 'Il sert a ignorer la fin de la requete.',
    },
    (4, 'E', 4): {
        'd': ['Oui, si le filtre est applique a toutes les entrees',
              'Oui, car l\'apostrophe est le seul caractere dangereux',
              'Oui, si la base utilise l\'encodage UTF-8'],
        'h': 'Un filtre porte sur un texte ; l\'attaque porte sur la structure.',
    },
    (4, 'E', 5): {
        'd': ['Parce qu\'elle contient le plus grand nombre de lignes',
              'Parce qu\'elle est la seule table modifiable',
              'Parce que son nom se devine facilement'],
        'h': 'Toutes les tables sont accessibles ; celle-ci coute plus cher.',
    },

    # ---------------- Scenario 5 : traversee ----------------
    (5, 'P', 1): {
        'd': ['En verifiant le prefixe du texte saisi',
              'En filtrant les caracteres interdits',
              'En refusant tout nom qui contient un point'],
        'h': 'Le prefixe du texte n\'est pas une barriere.',
    },
    (5, 'P', 2): {
        'd': ['Parce que le serveur met plus de temps a repondre',
              'Parce que les navigateurs modernes bloquent cette chaine',
              'Parce que la chaine est trop courte pour etre filtree'],
        'h': 'Pense aux doubles barres, aux encodages URL, aux chemins absolus.',
    },
    (5, 'E', 1): {
        'd': ['Se deplacer d\'un dossier a un autre dans l\'arborescence',
              'Copier un fichier vers un autre dossier',
              'Lister les fichiers presents dans un dossier'],
        'h': 'C\'est sortir du cadre prevu.',
    },
    (5, 'E', 2): {
        'd': ['Bloquer la chaine « ../ » dans la saisie',
              'Verifier que le nom ne contient pas de slash',
              'Refuser les requetes contenant « %2e%2e »'],
        'h': 'La seule verification solide porte sur le chemin resolu.',
    },
    (5, 'E', 3): {
        'd': ['Les chiffrer avec un mot de passe',
              'Les renommer en .bak',
              'Les proteger par une authentification HTTP'],
        'h': 'Si le serveur web peut les lire, l\'attaquant aussi.',
    },
    (5, 'E', 4): {
        'd': ['Il permet de desactiver le pare-feu du site',
              'Il contient le mot de passe de l\'administration',
              'Il oblige les moteurs de recherche a s\'arreter'],
        'h': 'Ce fichier est fait pour dire au monde ce qui existe.',
    },

    # ---------------- Scenario 6 : journaux ----------------
    (6, 'P', 1): {
        'd': ['Plusieurs 200 puis un 401',
              'Un 404 suivi d\'un 301',
              'Plusieurs 500 puis un 200'],
        'h': 'Regarde les codes de reponse.',
    },
    (6, 'P', 2): {
        'd': ['Pour compter le nombre total de lignes',
              'Pour chiffrer le contenu des requetes',
              'Pour trier les pages par ordre alphabetique'],
        'h': 'Une ligne seule ne dit rien ; cent lignes les memes, si.',
    },
    (6, 'E', 1): {
        'd': ['Requete traitee avec succes',
              'Ressource introuvable',
              'Le serveur a change de version'],
        'h': '401 = 401 Unauthorized.',
    },
    (6, 'E', 2): {
        'd': ['Parce que les URL ne sont pas chiffrees en HTTPS',
              'Parce qu\'une URL est trop courte pour un secret',
              'Parce que le navigateur bloque les URL longues'],
        'h': 'Pense a tout ce qui garde une copie de l\'URL.',
    },
    (6, 'E', 3): {
        'd': ['Un serveur qui a change de version',
              'Une panne du service de DNS',
              'Un scan de ports reussi'],
        'h': 'L\'ordre des codes compte autant que les codes.',
    },
    (6, 'E', 4): {
        'd': ['Rendre le fichier journal plus lisible',
              'Chiffrer le contenu du journal',
              'Compter le nombre d\'evenements par jour'],
        'h': 'Sans heure, impossible de relier deux evenements.',
    },

    # ---------------- Scenario 7 : reseau ----------------
    (7, 'P', 1): {
        'd': ['Que la machine est hors ligne',
              'Que le pare-feu est desactive',
              'Que le service est a jour de ses correctifs'],
        'h': 'Pense a ce que tu peux tenter contre ce service.',
    },
    (7, 'P', 2): {
        'd': ['Pour economiser de la bande passante',
              'Pour que le site s\'affiche plus vite',
              'Pour eviter d\'avoir a mettre a jour le systeme'],
        'h': 'Chaque port ouvert est une opportunite pour un attaquant.',
    },
    (7, 'E', 1): {
        'd': ['Le port est bloque par le pare-feu',
              'Le port est reserve aux administrateurs',
              'Le port attend une configuration'],
        'h': 'Un port ouvert, c\'est une porte d\'entree possible.',
    },
    (7, 'E', 2): {
        'd': ['Refuser tout acces a l\'utilisateur par defaut',
              'Donner tous les droits pour eviter les blocages',
              'Accorder les droits uniquement aux administrateurs'],
        'h': 'Le principe du moindre privilege, en une phrase.',
    },
    (7, 'E', 3): {
        'd': ['Parce que les ports sont plus faciles a configurer',
              'Parce qu\'une application peut ecouter sur n\'importe quel port',
              'Parce que le filtrage par port est plus rapide'],
        'h': 'Le filtrage par application n\'existe pas partout.',
    },
    (7, 'E', 4): {
        'd': ['Il copie les fichiers de la machine',
              'Il modifie les regles du pare-feu',
              'Il identifie le responsable humain d\'une machine'],
        'h': 'C\'est une cartographie, pas une intrusion.',
    },

    # ---------------- Scenario 8 : pivot ----------------
    (8, 'P', 1): {
        'd': ['Changer l\'adresse IP de sa machine',
              'Rediriger le trafic d\'un site vers un autre',
              'Demander un acces administrateur a l\'utilisateur'],
        'h': 'Le reseau final n\'etait pas joignable avant.',
    },
    (8, 'P', 2): {
        'd': ['Parce que les mots de passe sont souvent trop courts',
              'Parce que le navigateur peut les enregistrer',
              'Parce que l\'utilisateur les recopie mal'],
        'h': 'Pense a ce que tu viens de faire dans ce scenario.',
    },
    (8, 'E', 1): {
        'd': ['Scanner le reseau, puis envoyer des e-mails',
              'Cacher ses traces, puis supprimer les journaux',
              'Chiffrer ses fichiers, puis les envoyer a l\'exterieur'],
        'h': 'Deux etapes : un acces, puis un usage de cet acces.',
    },
    (8, 'E', 2): {
        'd': ['Parce qu\'il n\'etait pas demarre',
              'Parce qu\'il avait plus d\'adresse IP',
              'Parce que son serveur web etait arrete'],
        'h': 'Il repond quand tu es deja dedans.',
    },
    (8, 'E', 3): {
        'd': ['Le garder : il a deja ete change',
              'Le mettre dans un fichier .env',
              'Le transmettre a l\'utilisateur qui l\'a utilise'],
        'h': 'Le secret a ete expose : il faut le considerer vole.',
    },
    (8, 'E', 4): {
        'd': ['Elle augmente la bande passante du reseau',
              'Elle chiffre tous les echanges du reseau',
              'Elle supprime la necessite d\'un pare-feu'],
        'h': 'Elle contient l\'impact, elle ne l\'annule pas.',
    },
    (8, 'E', 5): {
        'd': ['Parce qu\'il ralentit le traitement des requetes',
              'Parce qu\'il occupe une ligne dans le fichier',
              'Parce qu\'il est ecrit avec des caracteres speciaux'],
        'h': 'Un seul secret peut ouvrir plusieurs portes.',
    },

    # ---------------- Scenario 9 : memoire ----------------
    (9, 'P', 1): {
        'd': ['Le programme s\'arrete avec une erreur',
              'Les caracteres en trop sont ignores',
              'La memoire est etendue automatiquement'],
        'h': 'Le tampon est dans la pile, et l\'adresse de retour est juste apres.',
    },
    (9, 'P', 2): {
        'd': ['A interdire toute ecriture dans la pile',
              'A chiffrer le contenu de la pile',
              'A rendre le binaire impossible a decompiler'],
        'h': 'Il ne bloque rien : il signale.',
    },
    (9, 'E', 1): {
        'd': ['L\'execution de code dans le tas (heap)',
              'La lecture du fichier binaire',
              'L\'utilisation des threads'],
        'h': 'NX rend la pile non executable.',
    },
    (9, 'E', 2): {
        'd': ['Il chiffre le binaire dans le fichier executable',
              'Il verifie l\'integrite du binaire au demarrage',
              'Il interdit l\'execution d\'un binaire non signe'],
        'h': 'ASLR = adresses aleatoires.',
    },
    (9, 'E', 3): {
        'q': 'Que gagne-t-on a activer les defenses (canary, NX, PIE) a la compilation ?',
        'd': ['Le binaire devient plus rapide',
              'Le code source est plus court',
              'Les erreurs sont detectees a l\'execution'],
        'h': 'Les flags de compilation changent le code produit.',
    },
    (9, 'E', 4): {
        'd': ['Activer ASLR',
              'Compiler avec le bit NX',
              'Deplacer le tampon en memoire globale'],
        'h': 'La parade ultime est dans le code, pas dans les options.',
    },
    (9, 'E', 5): {
        'd': ['L\'injection de shellcode dans la pile',
              'Le remplacement de la table GOT',
              'Le debordement d\'entier'],
        'h': 'On reutilise du code deja present : le mot commence par R.',
    },

    # ---------------- Scenario 10 : TLS ----------------
    (10, 'P', 1): {
        'd': ['L\'identite du serveur, pas la confidentialite',
              'L\'integrite des fichiers du serveur',
              'La disponibilite du service'],
        'h': 'Deux fonctions distinctes.',
    },
    (10, 'P', 2): {
        'd': ['Que le certificat est expire',
              'Que le chiffrement utilise est trop faible',
              'Que le serveur ne supporte pas TLS 1.3'],
        'h': 'Qui a signe ? Est-ce quelqu\'un d\'independant ?',
    },
    (10, 'E', 1): {
        'd': ['Un mecanisme de chiffrement du nom de domaine',
              'Un en-tete envoye par le navigateur pour signer la connexion',
              'Le renouvellement automatique des certificats'],
        'h': 'Le serveur propose un certificat different selon le nom demande.',
    },
    (10, 'E', 2): {
        'd': ['Parce que le certificat est trop volumineux',
              'Parce que la cle privee est trop courte',
              'Parce que le navigateur exige la version 3 de TLS'],
        'h': 'Le navigateur cherche une chaine de confiance.',
    },
    (10, 'E', 3): {
        'd': ['Qu\'il est de confiance et sans faille',
              'Qu\'il a passe tous les tests de securite',
              'Qu\'il utilise la version la plus recente de TLS'],
        'h': 'Le cadenas parle du chiffrement, pas de l\'identite.',
    },
    (10, 'E', 4): {
        'd': ['De chiffrer le contenu des pages',
              'D\'interdire les mots de passe faibles',
              'De signer automatiquement les certificats'],
        'h': 'HTTP Strict Transport Security.',
    },
    (10, 'E', 5): {
        'd': ['En desactivant la verification des certificats',
              'En acceptant n\'importe quel certificat auto-signe',
              'En utilisant le protocole HTTP en interne'],
        'h': 'Il faut une autorite a qui les machines font confiance.',
    },
}
