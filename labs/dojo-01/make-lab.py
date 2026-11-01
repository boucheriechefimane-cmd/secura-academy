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

import os
import shutil

RACINE = os.path.dirname(os.path.abspath(__file__))

# (identifiant, ceinture, titre, chemin dans la machine, valeur, outil)
DEFIS = [
    ("d01", 1, "Le premier fichier", "/srv/dojo/1-blanche/01-premier-fichier.txt",
     "drapeau_blanc", "cat"),
    ("d02", 1, "Le dossier cache", "/srv/dojo/1-blanche/02-dossier-cache.txt",
     "cache_oublie", "ls -a"),
    ("d03", 1, "Le mot dans le texte", "/srv/dojo/1-blanche/03-mot-dans-le-texte.txt",
     "mot_recherche", "grep"),
    ("d04", 1, "Les premiere et derniere lignes", "/srv/dojo/1-blanche/04-extremites.txt",
     "debut_et_fin", "head et tail"),
    ("d05", 2, "Le fichier protege", "/srv/dojo/2-jaune/05-fichier-protege.txt",
     "lecture_refusee", "stat"),
    ("d06", 2, "Le dossier du vrai proprietaire", "/srv/dojo/2-jaune/06-proprietaire.txt",
     "compte_du_service", "ls -l"),
    ("d07", 2, "La ligne cachee", "/srv/dojo/2-jaune/07-ligne-cachee.txt",
     "ligne_en_milieu", "grep -n"),
    ("d08", 2, "Le compte des caracteres", "/srv/dojo/2-jaune/08-taille.txt",
     "bon_comptage", "wc"),
    ("d09", 3, "Le port ouvert", "/srv/dojo/3-orange/09-port-ouvert.txt",
     "port_8080", "ss ou netstat"),
    ("d10", 3, "Le processus suspect", "/srv/dojo/3-orange/10-processus.txt",
     "processus_ecoute", "ps"),
    ("d11", 3, "La configuration oubliee", "/srv/dojo/3-orange/11-configuration.txt",
     "variable_oubliee", "cat ou grep"),
    ("d12", 3, "La regle du pare-feu", "/srv/dojo/3-orange/12-pare-feu.txt",
     "port_ferme", "grep"),
    ("d13", 4, "Le binaire et ses chaines", "/srv/dojo/4-verte/13-chaines.txt",
     "chaine_du_binaire", "strings"),
    ("d14", 4, "Le type de fichier", "/srv/dojo/4-verte/14-type.txt",
     "fichier_elf", "file"),
    ("d15", 4, "L'adresse du Echec", "/srv/dojo/4-verte/15-adresse.txt",
     "adresse_finale", "grep"),
    ("d16", 4, "La taille du fichier", "/srv/dojo/4-verte/16-taille.txt",
     "grosseur_anormale", "stat ou wc -c"),
    ("d17", 5, "L'empreinte du secret", "/srv/dojo/5-noire/17-empreinte.txt",
     "empreinte_sha256", "sha256sum"),
    ("d18", 5, "La cle privee", "/srv/dojo/5-noire/18-cle.txt",
     "cle_de_session", "grep"),
    ("d19", 5, "Le certificat", "/srv/dojo/5-noire/19-certificat.txt",
     "autorite_signataire", "openssl ou grep"),
    ("d20", 5, "Le mot de passe hashe", "/srv/dojo/5-noire/20-hache.txt",
     "empreinte_du_mot_de_passe", "sha256sum"),
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
    if os.path.isdir(RACINE):
        for dossier in ("cours", "flag", "notes"):
            chemin = os.path.join(RACINE, dossier)

            if os.path.isdir(chemin):
                shutil.rmtree(chemin)

    drapeaux = 0
    livrables = 0

    for identifiant, ceinture, titre, chemin_machine, valeur, outil in DEFIS:
        nom_ceinture = CEINTURES[ceinture][0]
        base = os.path.basename(chemin_machine)

        dossier_ceinture = "{0}-{1}".format(ceinture, nom_ceinture)

        ecrire(
            os.path.join(RACINE, "cours", dossier_ceinture, base),
            "# Defi {identifiant} - {titre}\n\n"
            "Ceinture {ceinture} ({nom_ceinture}) : {sous_titre}\n\n"
            "Outil attendu : {outil}\n\n"
            "Le compte rendu du dojo (a lire dans la machine) :\n\n"
            "    {cle} = FLAG=SECURA{{{valeur}}}\n\n"
            "Ce que tu fais : tu ouvres le fichier {chemin_machine}, tu trouves\n"
            "la ligne de compte rendu, et tu recopies la valeur entre accolades.\n"
            .format(
                identifiant=identifiant,
                titre=titre,
                ceinture=ceinture,
                nom_ceinture=nom_ceinture,
                sous_titre=CEINTURES[ceinture][1],
                outil=outil,
                cle=base.replace(".txt", "").replace("-", "_"),
                valeur=valeur,
                chemin_machine=chemin_machine,
            ),
        )

        ecrire(
            os.path.join(RACINE, "flag", "flag-{identifiant}.txt".format(identifiant=identifiant)),
            "FLAG=SECURA{{{valeur}}}\n".format(valeur=valeur),
        )

        drapeaux += 1
        livrables += 1

    for identifiant, titre, fichier, valeur in BRIEFS:
        ecrire(
            os.path.join(RACINE, "cours", "briefs", fichier),
            "# {0}\n\n"
            "Ce document resume le brief : ce qu'il faut savoir avant de commencer\n"
            "les labs, et la regle a retenir.\n\n"
            "Le compte rendu du brief :\n\n"
            "    {1} = FLAG=SECURA{{{2}}}\n"
            .format(
                titre,
                fichier.replace(".txt", "").replace("-", "_"),
                valeur,
            ),
        )

        ecrire(
            os.path.join(RACINE, "flag", "flag-{0}.txt".format(identifiant)),
            "FLAG=SECURA{{{0}}}\n".format(valeur),
        )

        drapeaux += 1
        livrables += 1

    lignes = [
        "Dojo Secura - vingt defis, cinq ceintures",
        "==========================================",
        "",
        "Chaque defi se resout en lisant un document du dojo. La valeur relevee",
        "est la preuve : le serveur la compare au drapeau du serveur, dans la",
        "machine, en root. Tu ne peux pas la copier ailleurs.",
        "",
        "Ceintures :",
    ]

    for ceinture, (nom, sous_titre) in CEINTURES.items():
        lignes.append("    /srv/dojo/{0}-{1}/    {2}".format(ceinture, nom, sous_titre))

    lignes += ["    /srv/briefs/           les six briefs et le document de revision", ""]
    lignes += ["", "Outils : ls, cat, grep, head, tail, wc, find, file, stat, strings, sha256sum", ""]

    for ceinture, (nom, sous_titre) in CEINTURES.items():
        lignes += ["Ceinture {0} ({1}) : {2}".format(ceinture, nom, sous_titre), INTRO[ceinture], ""]

    ecrire(os.path.join(RACINE, "notes", "notes.txt"), "\n".join(lignes))

    print("lab dojo-01 : {0} drapeaux, {1} livrables".format(drapeaux, livrables))


if __name__ == "__main__":
    fabriquer()
