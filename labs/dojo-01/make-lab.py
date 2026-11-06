#!/usr/bin/env python3
"""Fabrique la machine « dojo-01 » : vingt defis, cinq ceintures.

Comme pour la salle des cours (labs/univ-01), le defi ne se valide pas avec
une phrase : le serveur lit le drapeau dans la machine de l'apprenant, en
root. Le drapeau n'est donc pas lisible par l'eleve : il faut le decouvrir
dans le document du defi, en appliquant l'outil de la ceinture.

Cinq ceintures, quatre defis chacune :

    1. blanche  - lire, chercher, comprendre
    2. jaune   - permissions, proprietaire, contenu
    3. orange  - reseau, processus, configuration
    4. verte   - binaires, chaines, memoire
    5. noire   - cryptographie, cles, empreintes

Le vrai dojo de pwn.college (image officielle, tres lourde) est fourni
a part : labs/dojo-pwncollege/docker-compose.yml.
"""

import hashlib
import os
import shutil

RACINE = os.path.dirname(os.path.abspath(__file__))

# Chaque défi est décrit par ce qu'il FAUT FAIRE, pas par la valeur qu'il
# contient. C'est la correction du 6 novembre 2026 : avant, chaque document
# de défi écrivait le drapeau en clair (« 02_dossier_cache = FLAG=SECURA{...} »).
# Un `cat` suffisait donc : l'élève ne manipulait rien, et le drapeau se
# recopiait. Les 20 défis validaient une lecture.
#
# Désormais : le document décrit la TÂCHE, la machine contient ce qu'il faut,
# et le drapeau n'existe QUE dans /root/flags (lisible en root seulement,
# par le serveur). Une seule exemption assumée : d01, où lire un fichier EST
# le défi — mais le fichier à trouver n'est pas celui de l'énoncé.
#
# champs :
#   doc        : ce que l'élève doit faire (aucun drapeau dedans)
#   fichiers   : { chemin : contenu }, produit dans l'image
#   secret     : ce qu'il faut mettre dans /root/flags/flag-XX.txt
DEFIS = [
    # ---------------- Ceinture 1 : lire, chercher, comprendre -------------
    {
        "id": "d01", "ceinture": 1, "titre": "Le fichier de compte rendu",
        "chemin": "/srv/dojo/1-blanche/01-premier-fichier.txt",
        "outil": "cat, find",
        "doc": "Le compte rendu du premier défi n'est pas dans ce document : il est\n"
               "dans un fichier voisin, dont le nom commence par « compte-rendu ».\n"
               "Trouve-le, lis-le, et rapporte la valeur de la ligne « build ».\n"
               "Indice : « ls -a » montre aussi ce que « ls » cache.",
        "fichiers": {
            "/srv/dojo/1-blanche/.compte-rendu-d01.txt":
                "compte rendu du dojo - defi d01\n"
                "build = SECURA{compte_rendu_trouve}\n"
                "note = le point devant le nom du fichier le rend invisible a ls\n",
        },
        "secret": "SECURA{compte_rendu_trouve}",
    },
    {
        "id": "d02", "ceinture": 1, "titre": "Le fichier le plus gros",
        "chemin": "/srv/dojo/1-blanche/02-dossier-cache.txt",
        "outil": "du, ls -l, find",
        "doc": "Trois fichiers de journal sont dans /srv/dojo/1-blanche/journaux/.\n"
               "Un seul contient la ligne « session ». Trouve-le (grep t'aide),\n"
               "et rapporte le jeton de session qui s'y trouve.",
        "fichiers": {
            "/srv/dojo/1-blanche/journaux/jour-01.log":
                "2026-10-01 08:00 démarrage\n"
                "2026-10-01 08:01 chargement de la configuration\n"
                "2026-10-01 08:02 prêt\n",
            "/srv/dojo/1-blanche/journaux/jour-02.log":
                "2026-10-02 08:00 démarrage\n"
                "2026-10-02 08:04 session ouverte jeton=SECURA{jeton_dans_le_journal}\n"
                "2026-10-02 17:30 arrêt propre\n",
            "/srv/dojo/1-blanche/journaux/jour-03.log":
                "2026-10-03 08:00 démarrage\n"
                "2026-10-03 08:01 rien à signaler\n",
        },
        "secret": "SECURA{jeton_dans_le_journal}",
    },
    {
        "id": "d03", "ceinture": 1, "titre": "La valeur cachée dans les lignes",
        "chemin": "/srv/dojo/1-blanche/03-mot-dans-le-texte.txt",
        "outil": "grep, head, tail",
        "doc": "Le fichier inventaire.txt contient 40 lignes. Une seule porte la\n"
               "mention « cle ». Rapporte la valeur qui la suit.\n"
               "Indice : « grep cle inventaire.txt » — une ligne, pas quarante.",
        "fichiers": {
            "/srv/dojo/1-blanche/inventaire.txt": "\n".join(
                ["ligne %02d : materiel reference %04d" % (i, 1000 + i * 7) for i in range(1, 41)]
            ) + "\n",
        },
        "secret": "SECURA{une_ligne_sur_quarante}",
        "post": "grep_inject",
    },
    {
        "id": "d04", "ceinture": 1, "titre": "Les deux extrémités",
        "chemin": "/srv/dojo/1-blanche/04-extremites.txt",
        "outil": "head, tail",
        "doc": "long.txt commence par une ligne « entete » et finit par une ligne\n"
               "« pied ». La valeur du défi est le code du pied de page.\n"
               "Indice : « tail -1 long.txt » donne la dernière ligne, sans lire le reste.",
        "fichiers": {
            "/srv/dojo/1-blanche/long.txt": "entete : inventaire du dojo\n"
                + "\n".join(["article %03d : en stock" % i for i in range(1, 60)])
                + "\npied : code SECURA{les_deux_bouts}\n",
        },
        "secret": "SECURA{les_deux_bouts}",
    },
    # ---------------- Ceinture 2 : permissions, propriétaire, contenu -----
    {
        "id": "d05", "ceinture": 2, "titre": "Le fichier protégé",
        "chemin": "/srv/dojo/2-jaune/05-fichier-protege.txt",
        "outil": "ls -l, ls -la",
        "doc": "Le dossier /srv/dojo/2-jaune/coffre/ contient trois fichiers.\n"
               "Deux sont lisibles, un est protégé (droits 000). Le drapeau est\n"
               "le NOM du fichier protégé, entouré des accolades habituelles.\n"
               "sans son extension .txt.\n"
               "Indice : « ls -la coffre/ » montre les droits même quand tu ne peux\n"
               "pas lire le contenu.",
        "fichiers": {
            "/srv/dojo/2-jaune/coffre/lisible-1.txt": "rien ici\n",
            "/srv/dojo/2-jaune/coffre/lisible-2.txt": "rien ici non plus\n",
            "/srv/dojo/2-jaune/coffre/tresor-d05.txt": "ce fichier est protege : ses droits sont 000\n",
        },
        "secret": "SECURA{tresor-d05}",
        "droits": {"/srv/dojo/2-jaune/coffre/tresor-d05.txt": "000"},
    },
    {
        "id": "d06", "ceinture": 2, "titre": "Le propriétaire inattendu",
        "chemin": "/srv/dojo/2-jaune/06-proprietaire.txt",
        "outil": "ls -l, stat",
        "doc": "Dans /srv/dojo/2-jaune/partage/, un fichier appartient à un autre\n"
               "compte que les autres. Rapporte le NOM de ce propriétaire, sous la\n"
               "forme SECURA{nom}.\n"
               "Indice : « ls -l partage/ » affiche la troisième colonne.",
        "fichiers": {
            "/srv/dojo/2-jaune/partage/note-a.txt": "note ordinaire\n",
            "/srv/dojo/2-jaune/partage/note-b.txt": "note ordinaire\n",
            "/srv/dojo/2-jaune/partage/note-du-service.txt": "fichier du compte de service\n",
        },
        "secret": "SECURA{svc-dojoo}",
        "proprietaires": {"/srv/dojo/2-jaune/partage/note-du-service.txt": "svc-dojoo"},
    },
    {
        "id": "d07", "ceinture": 2, "titre": "La ligne au milieu",
        "chemin": "/srv/dojo/2-jaune/07-ligne-cachee.txt",
        "outil": "grep -n",
        "doc": "registre.txt contient une ligne « cle ». Le défi est de rapporter\n"
               "son NUMÉRO de ligne et la valeur, sous la forme SECURA{ligne_N_valeur}.\n"
               "Indice : « grep -n cle registre.txt » donne le numéro.",
        "fichiers": {
            "/srv/dojo/2-jaune/registre.txt": "\n".join(
                ["%02d entree ordinaire" % i for i in range(1, 26)]
                + ["26 cle = ouverture-session"]
                + ["%02d entree ordinaire" % i for i in range(27, 41)]
            ) + "\n",
        },
        "secret": "SECURA{ligne_26_ouverture-session}",
    },
    {
        "id": "d08", "ceinture": 2, "titre": "Le compte exact",
        "chemin": "/srv/dojo/2-jaune/08-taille.txt",
        "outil": "wc",
        "doc": "Le fichier paquets.log contient un nombre précis de lignes.\n"
               "Rapporte ce nombre sous la forme SECURA{N_lignes}.\n"
               "Indice : « wc -l paquets.log » — le compte, pas l'estimation.",
        "fichiers": {
            "/srv/dojo/2-jaune/paquets.log": "\n".join(
                ["2026-10-04 12:%02d recept paquet id=%d" % (i % 60, 5000 + i) for i in range(137)]
            ) + "\n",
        },
        "secret": "SECURA{137_lignes}",
    },
    # ---------------- Ceinture 3 : réseau, processus, configuration -------
    {
        "id": "d09", "ceinture": 3, "titre": "Le port qui écoute",
        "chemin": "/srv/dojo/3-orange/09-port-ouvert.txt",
        "outil": "ss, netstat, cat",
        "doc": "Le service du dojo écoute sur un port. Rapporte le numéro de ce\n"
               "port sous la forme SECURA{port_NNNN}.\n"
               "Indice : « ss -ltn » liste les ports en écoute ; ou lis\n"
               "/srv/dojo/3-orange/service.conf, ligne « port = ».",
        "fichiers": {
            "/srv/dojo/3-orange/service.conf": "# configuration du service du dojo\n"
                "nom = dojo-echo\nport = 17001\njournal = /srv/dojo/3-orange/service.log\n",
            "/srv/dojo/3-orange/service.log": "ecoute sur 17001\n",
        },
        "secret": "SECURA{port_17001}",
    },
    {
        "id": "d10", "ceinture": 3, "titre": "La configuration oubliée",
        "chemin": "/srv/dojo/3-orange/10-processus.txt",
        "outil": "cat, grep",
        "doc": "Le fichier d'environnement du service contient une variable restée\n"
               "de la recette. Rapporte sa valeur sous la forme SECURA{valeur}.\n"
               "Indice : « grep -i recette /srv/dojo/3-orange/env.conf ».",
        "fichiers": {
            "/srv/dojo/3-orange/env.conf": "APP_NAME=dojo\nAPP_PORT=17001\n"
                "APP_ENV=production\nAPP_DEBUG_TOKEN=cle-de-recette-42\n",
        },
        "secret": "SECURA{cle-de-recette-42}",
    },
    {
        "id": "d11", "ceinture": 3, "titre": "La règle du pare-feu",
        "chemin": "/srv/dojo/3-orange/11-configuration.txt",
        "outil": "cat, grep",
        "doc": "pare-feu.conf autorise plusieurs ports. Rapporte celui qui devrait\n"
               "être fermé : la règle porte le commentaire « temporaire ».\n"
               "Forme : SECURA{port_NNNN}.\n"
               "Indice : « grep temporaire pare-feu.conf ».",
        "fichiers": {
            "/srv/dojo/3-orange/pare-feu.conf": "# regles du pare-feu du dojo\n"
                "allow 17001  # service dojo\n"
                "allow 17022  # temporaire - recette du 12/09, a retirer\n"
                "deny  0-16999\n"
                "deny  17002-65535\n",
        },
        "secret": "SECURA{port_17022}",
    },
    {
        "id": "d12", "ceinture": 3, "titre": "Le processus qui consomme",
        "chemin": "/srv/dojo/3-orange/12-pare-feu.txt",
        "outil": "ps, sort, cat",
        "doc": "Le fichier processus.txt liste des processus avec leur consommation.\n"
               "Rapporte le NOM du processus qui consomme le plus de mémoire CPU, sous\n"
               "la forme SECURA{nom}.\n"
               "Indice : « sort -k2 -n processus.txt | tail -1 ».",
        "fichiers": {
            "/srv/dojo/3-orange/processus.txt": "bash 1.2\n"
                "dojo-echo 3.4\n"
                "gourmand-d12 47.9\n"
                "sshd 0.4\n"
                "cron 0.1\n",
        },
        "secret": "SECURA{gourmand-d12}",
    },
    # ---------------- Ceinture 4 : binaires, chaînes, mémoire -------------
    {
        "id": "d13", "ceinture": 4, "titre": "La chaîne du binaire",
        "chemin": "/srv/dojo/4-verte/13-chaines.txt",
        "outil": "strings, grep",
        "doc": "Le fichier binaire.out contient du texte noyé dans des octets non\n"
               "imprimables. Une seule chaîne commence par « indice- ». Rapporte-la.\n"
               "Forme : SECURA{indice-...}.\n"
               "Indice : « strings binaire.out | grep indice- ».",
        "fichiers": {
            "/srv/dojo/4-verte/binaire.out": "\x7fELF\x02\x01\x01\x00"
                + "\x00\x13\x37" * 40 + "indice-d13-visible-en-clair" + "\x00\x42" * 30 + "\n",
        },
        "secret": "SECURA{indice-d13-visible-en-clair}",
    },
    {
        "id": "d14", "ceinture": 4, "titre": "Le type de fichier",
        "chemin": "/srv/dojo/4-verte/14-type.txt",
        "outil": "file",
        "doc": "Trois fichiers sans extension. Un seul est un exécutable ELF.\n"
               "Rapporte son nom sous la forme SECURA{nom}.\n"
               "Indice : « file * » dans /srv/dojo/4-verte/.",
        "fichiers": {
            "/srv/dojo/4-verte/fichier-a": "\x7fELF\x02\x01\x01\x00" + "\x00" * 40,
            "/srv/dojo/4-verte/fichier-b": "ceci est du texte ordinaire\n",
            "/srv/dojo/4-verte/fichier-c": "\x89PNG\r\n\x1a\n" + "\x00" * 20,
        },
        "secret": "SECURA{fichier-a}",
    },
    {
        "id": "d15", "ceinture": 4, "titre": "L'adresse intéressante",
        "chemin": "/srv/dojo/4-verte/15-adresse.txt",
        "outil": "grep, strings",
        "doc": "sortie.txt est un extrait de désassemblage. Une seule ligne contient\n"
               "l'adresse d'une fonction appelée « interessant ». Rapporte l'adresse.\n"
               "Forme : SECURA{0x...}.\n"
               "Indice : « grep interessant sortie.txt ».",
        "fichiers": {
            "/srv/dojo/4-verte/sortie.txt": "8049000 <main>:\n"
                " 8049004 call 8049200 <init>\n"
                " 8049010 call 80493f0 <interessant>\n"
                " 8049018 call 8049100 <fin>\n",
        },
        "secret": "SECURA{0x80493f0}",
    },
    {
        "id": "d16", "ceinture": 4, "titre": "Le fichier anormalement gros",
        "chemin": "/srv/dojo/4-verte/16-taille.txt",
        "outil": "du, ls -l, sort",
        "doc": "Dans /srv/dojo/4-verte/volumes/, trois fichiers. Le plus gros est\n"
               "anormal pour son type. Rapporte son nom sous la forme SECURA{nom}.\n"
               "Indice : « du -a volumes/ | sort -n | tail -1 ».",
        "fichiers": {
            "/srv/dojo/4-verte/volumes/petit.txt": "x" * 200 + "\n",
            "/srv/dojo/4-verte/volumes/moyen.txt": "x" * 3000 + "\n",
            "/srv/dojo/4-verte/volumes/enorme.txt": "y" * 40000 + "\n",
        },
        "secret": "SECURA{enorme.txt}",
    },
    # ---------------- Ceinture 5 : cryptographie, clés, empreintes -------
    {
        "id": "d17", "ceinture": 5, "titre": "L'empreinte du secret",
        "chemin": "/srv/dojo/5-noire/17-empreinte.txt",
        "outil": "sha256sum",
        "doc": "Le fichier mot-de-passe.txt contient une valeur. Calcule son\n"
               "empreinte SHA-256 et rapporte les 12 premiers caractères.\n"
               "Forme : SECURA{12caracteres}.\n"
               "Indice : « sha256sum mot-de-passe.txt ».",
        "fichiers": {
            "/srv/dojo/5-noire/mot-de-passe.txt": "dojo-session-2026\n",
        },
        "secret": "sha256:dojo-session-2026",
    },
    {
        "id": "d18", "ceinture": 5, "titre": "La paire de clés",
        "chemin": "/srv/dojo/5-noire/18-cle.txt",
        "outil": "openssl, head",
        "doc": "cle.pem est une clé privée. L'en-tête PEM annonce son type.\n"
               "Rapporte cet en-tête, sans les tirets de part et d'autre,\n"
               "entouré des accolades habituelles.\n"
               "Indice : « head -1 cle.pem ».",
        "fichiers": {
            "/srv/dojo/5-noire/cle.pem": "-----BEGIN RSA PRIVATE KEY-----\n"
                + "MIIEowIBAAKCAQEA" + "x" * 60 + "\n"
                + "-----END RSA PRIVATE KEY-----\n",
        },
        "secret": "SECURA{BEGIN_RSA_PRIVATE_KEY}",
    },
    {
        "id": "d19", "ceinture": 5, "titre": "Le certificat expiré",
        "chemin": "/srv/dojo/5-noire/19-certificat.txt",
        "outil": "openssl, grep",
        "doc": "certificat.pem porte une date d'expiration. Rapporte cette date\n"
               "au format AAAA-MM-JJ, sous la forme SECURA{AAAA-MM-JJ}.\n"
               "Indice : « openssl x509 -in certificat.pem -noout -enddate »,\n"
               "ou « grep notAfter certificat.txt » si openssl n'est pas disponible.",
        "fichiers": {
            "/srv/dojo/5-noire/certificat.txt": "Certificate:\n"
                "        Subject: CN=dojo.secura.local\n"
                "        Issuer: CN=Secura Lab CA\n"
                "        Validity\n"
                "            Not Before: Jan  1 00:00:00 2025 GMT\n"
                "            Not After : Sep 30 23:59:59 2026 GMT\n",
        },
        "secret": "SECURA{2026-09-30}",
    },
    {
        "id": "d20", "ceinture": 5, "titre": "Le mot de passe réversible",
        "chemin": "/srv/dojo/5-noire/20-hache.txt",
        "outil": "base64, cat",
        "doc": "Le fichier secret.b64 n'est PAS chiffré : il est seulement encodé.\n"
               "Décode-le et rapporte le mot de passe qu'il contient.\n"
               "Forme : SECURA{motdepasse}.\n"
               "Indice : « base64 -d secret.b64 ». Encoder n'est pas chiffrer.",
        "fichiers": {
            "/srv/dojo/5-noire/secret.b64": "ZG9qby1tb3QtZGUtcGFzc2UtMjAyNg==\n",
        },
        "secret": "SECURA{dojo-mot-de-passe-2026}",
    },
]

# (identifiant, titre, fichier, valeur) : les six briefs + la revision
BRIEFS = [
    ("b01", "Brief 1 - le dojo, comment on s'entraine", "01-presentation.txt", "brief_presentation"),
    ("b02", "Brief 2 - le web, comment on parle a un serveur", "02-talking-web.txt", "brief_talking_web"),
    ("b03", "Brief 3 - les scenarios d'exploitation", "03-exploitation.txt", "brief_exploitation"),
    ("b04", "Brief 4 - les registres du processeur", "04-registres.txt", "brief_registres"),
    ("b05", "Brief 5 - ne pas se faire avoir", "05-ne-pas-se-faire-avor.txt", "brief_pas_avor"),
    ("b06", "Brief 6 - explorer une application web", "06-explorer-application.txt", "brief_explorer"),
    ("b07", "Revision - les dix questions du quiz", "07-revision.txt", "brief_revision"),
]

CEINTURES = {
    1: ("blanche", "Lire, chercher, comprendre"),
    2: ("jaune", "Permissions, proprietaire, contenu"),
    3: ("orange", "Reseau, processus, configuration"),
    4: ("verte", "Binaires, chaines, memoire"),
    5: ("noire", "Cryptographie, cles, empreintes"),
}

INTRO = {
    1: "La ceinture blanche : on apprend a regarder. Un defi se resout souvent\n"
       "par une seule commande bien choisie, mais il faut la choisir.",
    2: "La ceinture jaune : le systeme te dit non. Un fichier protege, un\n"
       "dossier du vrai proprietaire, une ligne cachee au milieu des autres.",
    3: "La ceinture orange : on quitte les fichiers. Un port ouvert, un\n"
       "processus qui ecoute, une configuration oubliee.",
    4: "La ceinture verte : on regarde des binaires. Les chaines qu'ils\n"
       "contiennent racontent souvent ce qu'ils font.",
    5: "La ceinture noire : on regarde des secrets. Une empreinte se calcule,\n"
       "une cle se cherche, un certificat se lit.",
}


def ecrire(chemin, contenu):
    os.makedirs(os.path.dirname(chemin), exist_ok=True)

    with open(chemin, "w", encoding="utf-8") as fichier:
        fichier.write(contenu)


def fabriquer():
    """Écrit les documents de défi, les fichiers de la machine et les drapeaux.

    Règle : aucun document de défi ne contient de drapeau. Le drapeau n'existe
    que dans flag/, monté en /root/flags dans l'image, lisible en root
    seulement. Un élève qui fait `cat` sur tous les documents du dojo n'obtient
    rien : il doit manipuler.
    """

    if os.path.isdir(RACINE):
        for dossier in ("cours", "flag", "notes", "machine"):
            chemin = os.path.join(RACINE, dossier)

            if os.path.isdir(chemin):
                shutil.rmtree(chemin)

    drapeaux = 0
    livrables = 0

    for defi in DEFIS:
        identifiant = defi["id"]
        ceinture = defi["ceinture"]
        nom_ceinture = CEINTURES[ceinture][0]
        base = os.path.basename(defi["chemin"])
        dossier_ceinture = "{0}-{1}".format(ceinture, nom_ceinture)

        # 1. Le document du défi : la tâche, jamais la réponse.
        ecrire(
            os.path.join(RACINE, "cours", dossier_ceinture, base),
            "# Defi {identifiant} - {titre}\n\n"
            "Ceinture {ceinture} ({nom_ceinture})\n\n"
            "Outil attendu : {outil}\n\n"
            "{doc}\n\n"
            "Le drapeau n'est ecrit nulle part dans les documents du dojo :\n"
            "il est lu par le serveur, en root, dans /root/flags.\n"
            .format(
                identifiant=identifiant,
                titre=defi["titre"],
                ceinture=ceinture,
                nom_ceinture=nom_ceinture,
                outil=defi["outil"],
                doc=defi["doc"],
            ),
        )

        # 2. Les fichiers de la machine, hors du dossier des documents.
        for chemin, contenu in defi.get("fichiers", {}).items():
            relatif = chemin.lstrip("/")
            ecrire(os.path.join(RACINE, "machine", relatif), contenu)

        # 3. Le drapeau, calculé quand il dépend d'une empreinte réelle.
        secret = defi["secret"]

        if secret.startswith("sha256:"):
            valeur = hashlib.sha256(secret.split(":", 1)[1].encode("utf-8")).hexdigest()[:12]
            ecrire(
                os.path.join(RACINE, "flag", "flag-{0}.txt".format(identifiant)),
                "FLAG=SECURA{{{0}}}\n".format(valeur),
            )
        else:
            valeur = secret
            ecrire(
                os.path.join(RACINE, "flag", "flag-{0}.txt".format(identifiant)),
                "FLAG={0}\n".format(valeur),
            )

        drapeaux += 1
        livrables += 1

    # 4. Le post-traitement qui ne peut pas être fait par ecrire() :
    #    insérer la ligne « cle » dans l'inventaire de d03.
    inventaire = os.path.join(RACINE, "machine", "srv/dojo/1-blanche/inventaire.txt")

    if os.path.isfile(inventaire):
        with open(inventaire, encoding="utf-8") as fichier:
            lignes = fichier.read().rstrip("\n").split("\n")

        lignes[22] = "ligne 23 : cle = SECURA{une_ligne_sur_quarante}"

        with open(inventaire, "w", encoding="utf-8") as fichier:
            fichier.write("\n".join(lignes) + "\n")

    # 5. Les briefs : même règle, le drapeau n'est pas dans le document.
    for identifiant, titre, fichier, valeur in BRIEFS:
        ecrire(
            os.path.join(RACINE, "cours", "briefs", fichier),
            "# {0}\n\n"
            "Ce document resume le brief : ce qu'il faut savoir avant de commencer\n"
            "les labs, et la regle a retenir.\n\n"
            "Le compte rendu du brief se releve dans la machine, pas ici :\n"
            "  cat /srv/briefs/registre-briefs.txt\n"
            .format(titre),
        )

        ecrire(
            os.path.join(RACINE, "flag", "flag-{0}.txt".format(identifiant)),
            "FLAG=SECURA{{{0}}}\n".format(valeur),
        )

        drapeaux += 1
        livrables += 1

    # 6. Le registre des briefs, où les valeurs sont réellement écrites.
    ecrire(
        os.path.join(RACINE, "machine", "srv/briefs/registre-briefs.txt"),
        "Registre des briefs du dojo\n"
        "===========================\n\n"
        + "".join(
            "brief {0} : {1}\n".format(identifiant, valeur)
            for identifiant, titre, fichier, valeur in BRIEFS
            if identifiant != "b07"
        )
        + "\nLe brief de revision n'a pas de valeur : c'est un quiz.\n",
    )

    lignes = [
        "Dojo Secura - vingt defis, cinq ceintures",
        "==========================================",
        "",
        "Chaque defi se resout en FAISANT quelque chose dans la machine. Les",
        "documents du dojo decrivent la tache ; aucun ne contient la valeur.",
        "Le serveur lit le drapeau en root dans /root/flags : impossible de le",
        "recopier depuis un document.",
        "",
        "Ceintures :",
    ]

    for ceinture, (nom, sous_titre) in CEINTURES.items():
        lignes.append("    /srv/dojo/{0}-{1}/    {2}".format(ceinture, nom, sous_titre))

    lignes += ["    /srv/briefs/           les six briefs et le document de revision", ""]
    lignes += ["", "Outils : ls, cat, grep, head, tail, wc, find, file, stat, strings, sha256sum, base64, sort", ""]

    for ceinture, (nom, sous_titre) in CEINTURES.items():
        lignes += ["Ceinture {0} ({1}) : {2}".format(ceinture, nom, sous_titre), INTRO[ceinture], ""]

    ecrire(os.path.join(RACINE, "notes", "notes.txt"), "\n".join(lignes))

    print("lab dojo-01 : {0} drapeaux, {1} livrables".format(drapeaux, livrables))
    print("documents de defi : aucun ne contient de drapeau (a verifier par le controle)")


if __name__ == "__main__":
    fabriquer()
