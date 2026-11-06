#!/usr/bin/env python3
"""Epreuves de la machine dojo-01 : les 20 defis se resolvent-ils vraiment ?

POURQUOI CE SCRIPT EXISTE
-------------------------
Une machine de laboratoire casse sans prevenir : un fichier qui n'est plus
copie, un droit qui change, un drapeau recalcule et plus mis a jour. Jusqu'ici
personne ne le voyait avant l'eleve.

Ce script se place DANS la machine (via docker exec), en tant qu'utilisateur
non privilegie `ctf`, et joue exactement la commande que l'eleve taperait. Il
compare ensuite la reponse obtenue au drapeau que le serveur, lui, lit en root
dans /root/flags.

Deux verites doivent coincider :
  1. ce que la manipulation produit dans la machine ;
  2. ce que le serveur attend comme preuve.

Si les deux divergent, le defi est inresolvable : l'eleve a beau faire juste,
il ne peut pas valider. C'est cette situation-la que le script detecte.

Usage :
    python3 tools/labs/epreuves-dojo.py --conteneur dojo
    python3 tools/labs/epreuves-dojo.py --conteneur dojo --verbeux

Sortie 0 si toutes les epreuves passent, 1 sinon.
"""

import argparse
import os
import re
import subprocess
import sys

def valeur_drapeau(drapeau):
    """La valeur interieure d'un drapeau : SECURA{port_17001} -> port_17001."""
    return drapeau.replace("SECURA{", "").replace("}", "")


def contient_drapeau(sortie, drapeau):
    """La sortie contient-elle la VALEUR du drapeau ?

    Le defi demande souvent un fragment (« le port », « l'en-tete PEM », « le
    proprietaire »), pas la ligne entiere. Comparer `flag in sortie` echoue
    alors que l'eleve a juste. On compare donc la valeur interieure :
    SECURA{port_17001} -> « port_17001 ». C'est ce que l'eleve lit et recopie.
    """
    valeur = valeur_drapeau(drapeau)

    return valeur != "" and valeur in sortie


# (identifiant, description, commande jouee dans la machine, calcul de la reponse)
# La commande tourne en tant que ctf (uid 1000). La fonction de calcul recoit
# la sortie et le drapeau reel, et rend True si l'eleve obtient le drapeau.
EPREUVES = [
    (
        "d01",
        "trouver le fichier cache et lire la ligne build",
        "cd /srv/dojo/1-blanche && grep -h '^build' .compte-rendu-d01.txt",
        lambda sortie, drapeau: contient_drapeau(sortie, drapeau),
    ),
    (
        "d02",
        "trouver le journal qui contient « session »",
        "grep -h 'session' /srv/dojo/1-blanche/journaux/*.log",
        lambda sortie, drapeau: contient_drapeau(sortie, drapeau),
    ),
    (
        "d03",
        "trouver la ligne « cle » parmi quarante",
        "grep -h ' cle ' /srv/dojo/1-blanche/inventaire.txt",
        lambda sortie, drapeau: contient_drapeau(sortie, drapeau),
    ),
    (
        "d04",
        "lire la derniere ligne",
        "tail -1 /srv/dojo/1-blanche/long.txt",
        lambda sortie, drapeau: contient_drapeau(sortie, drapeau),
    ),
    (
        "d05",
        "le nom du fichier protege, lu sans lire son contenu",
        "ls -1a /srv/dojo/2-jaune/coffre/ | grep tresor-d05",
        lambda sortie, drapeau: "tresor-d05" in sortie,
    ),
    (
        "d06",
        "le proprietaire inattendu",
        "ls -l /srv/dojo/2-jaune/partage/note-du-service.txt | awk '{print $3}'",
        lambda sortie, drapeau: "svc-dojoo" in sortie,
    ),
    (
        "d07",
        "le numero de la ligne cachee",
        "grep -n ' cle ' /srv/dojo/2-jaune/registre.txt",
        lambda sortie, drapeau: "26" in sortie and "ouverture-session" in sortie,
    ),
    (
        "d08",
        "le compte exact de lignes",
        "wc -l < /srv/dojo/2-jaune/paquets.log",
        # Le drapeau porte le nombre attendu : on compare le compte obtenu a
        # cette valeur, jamais a un nombre recopie dans ce fichier.
        lambda sortie, drapeau: re.search(r"\b" + re.escape(valeur_drapeau(drapeau).split("_")[0]) + r"\b", sortie) is not None,
    ),
    (
        "d09",
        "le port du service",
        "grep '^port' /srv/dojo/3-orange/service.conf",
        lambda sortie, drapeau: "17001" in sortie,
    ),
    (
        "d10",
        "la variable oubliee",
        "grep -i recette /srv/dojo/3-orange/env.conf",
        lambda sortie, drapeau: contient_drapeau(sortie, drapeau),
    ),
    (
        "d11",
        "la regle temporaire du pare-feu",
        "grep temporaire /srv/dojo/3-orange/pare-feu.conf",
        lambda sortie, drapeau: "17022" in sortie,
    ),
    (
        "d12",
        "le processus le plus gourmand",
        "sort -k2 -n /srv/dojo/3-orange/processus.txt | tail -1",
        lambda sortie, drapeau: "gourmand-d12" in sortie,
    ),
    (
        "d13",
        "la chaine lisible dans le binaire",
        "strings /srv/dojo/4-verte/binaire.out | grep indice-",
        lambda sortie, drapeau: contient_drapeau(sortie, drapeau),
    ),
    (
        "d14",
        "le fichier qui est un vrai ELF",
        "file /srv/dojo/4-verte/fichier-a /srv/dojo/4-verte/fichier-b /srv/dojo/4-verte/fichier-c",
        lambda sortie, drapeau: "ELF" in sortie and "fichier-a" in sortie,
    ),
    (
        "d15",
        "l'adresse de la fonction interessante",
        "grep interessant /srv/dojo/4-verte/sortie.txt",
        lambda sortie, drapeau: drapeau.replace("SECURA{", "").replace("}", "") in sortie,
    ),
    (
        "d16",
        "le fichier anormalement gros",
        "du -a /srv/dojo/4-verte/volumes/ | sort -n | tail -1",
        lambda sortie, drapeau: contient_drapeau(sortie, drapeau),
    ),
    (
        "d17",
        "les 12 premiers caracteres de l'empreinte SHA-256",
        "sha256sum /srv/dojo/5-noire/mot-de-passe.txt | cut -c1-12",
        lambda sortie, drapeau: drapeau.replace("SECURA{", "").replace("}", "") in sortie,
    ),
    (
        "d18",
        "l'en-tete PEM de la cle",
        "head -1 /srv/dojo/5-noire/cle.pem",
        lambda sortie, drapeau: contient_drapeau(sortie, drapeau),
    ),
    (
        "d19",
        "la date d'expiration du certificat",
        "grep 'Not After' /srv/dojo/5-noire/certificat.txt",
        lambda sortie, drapeau: "2026" in sortie and "Sep 30" in sortie,
    ),
    (
        "d20",
        "le mot de passe decode",
        "base64 -d /srv/dojo/5-noire/secret.b64",
        lambda sortie, drapeau: contient_drapeau(sortie, drapeau),
    ),
]

# Le fichier d'un defi qui DOIT rester illisible pour l'eleve (ceinture 2).
EPREUVES_NEGATIVES = [
    (
        "d05",
        "le fichier protege reste illisible",
        "cat /srv/dojo/2-jaune/coffre/tresor-d05.txt",
        "permission denied",
    ),
    (
        "flags",
        "les drapeaux du serveur sont hors de portee de l'eleve",
        "cat /root/flags/flag-d01.txt",
        "permission denied",
    ),
]


def executer(conteneur, commande, uid):
    """Joue une commande dans le conteneur, en tant qu'utilisateur donne."""
    complet = ["docker", "exec"]

    if uid is not None:
        complet += ["-u", str(uid)]

    complet += [conteneur, "bash", "-lc", commande]

    resultat = subprocess.run(complet, capture_output=True, text=True)

    return resultat.returncode, (resultat.stdout or "") + (resultat.stderr or "")


def lire_drapeau(conteneur, identifiant):
    """Lit le drapeau comme le fait le serveur : en root, dans /root/flags."""
    code, sortie = executer(
        conteneur,
        "cat /root/flags/flag-{0}.txt".format(identifiant),
        None,
    )

    if code != 0:
        return None

    m = re.search(r"FLAG=(SECURA\{[^}]*\})", sortie)

    return m.group(1) if m else None


def main():
    parseur = argparse.ArgumentParser()
    parseur.add_argument("--conteneur", required=True, help="nom du conteneur qui tourne")
    parseur.add_argument("--verbeux", action="store_true")
    options = parseur.parse_args()

    reussis = 0
    echecs = []

    print("EPREUVES — machine dojo-01, conteneur « {0} »".format(options.conteneur))
    print("")

    for identifiant, description, commande, verifie in EPREUVES:
        drapeau = lire_drapeau(options.conteneur, identifiant)

        if drapeau is None:
            echecs.append("{0} : le serveur ne peut pas lire le drapeau en root".format(identifiant))
            continue

        code, sortie = executer(options.conteneur, commande, 1000)

        if options.verbeux:
            print("  [{0}] $ {1}".format(identifiant, commande))
            print("      {0}".format(sortie.strip()[:160]))

        if verifie(sortie, drapeau):
            reussis += 1
        else:
            echecs.append(
                "{0} ({1}) : la commande ne produit pas le drapeau attendu".format(
                    identifiant, description
                )
            )

    print("  defis resolubles          : {0}/{1}".format(reussis, len(EPREUVES)))

    # Les epreuves negatives : ce qui doit rester inaccessible.
    negatifs_ok = 0

    for identifiant, description, commande, attendu in EPREUVES_NEGATIVES:
        code, sortie = executer(options.conteneur, commande, 1000)

        if code != 0 and attendu in sortie.lower():
            negatifs_ok += 1
        else:
            echecs.append("{0} : {1} — la commande aurait du echouer".format(identifiant, description))

    print("  barrieres tenues          : {0}/{1}".format(negatifs_ok, len(EPREUVES_NEGATIVES)))

    if echecs:
        print("")
        print("ECHECS :")

        for echec in echecs:
            print("  -", echec)

        return 1

    print("")
    print("VERDICT : les 20 defis se resolvent dans la machine, et les barrieres tiennent.")
    return 0


if __name__ == "__main__":
    sys.exit(main())
