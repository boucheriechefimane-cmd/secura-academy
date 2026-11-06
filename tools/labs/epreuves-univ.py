#!/usr/bin/env python3
"""Epreuves de la machine univ-01 : les 22 manipulations produisent-elles le drapeau ?

POURQUOI CE SCRIPT EXISTE
-------------------------
Le 6 novembre 2026, la mesure a montre que 15 des 22 drapeaux de univ-01
etaient ecrits en clair dans les documents de cours : l'eleve lisait, il ne
manipulait pas. La correction fait porter aux documents la DONNEE, et au
drapeau le RESULTAT d'une commande.

Cette correction peut casser de deux facons, et les deux sont invisibles a
la lecture :

  1. la commande indiquee a l'eleve ne produit pas la valeur du drapeau
     (le drapeau devient invalide, la room est insoluble) ;
  2. la valeur apparait quelque part dans un document lisible
     (le drapeau redevient une lecture, on a rien corrige).

Ce script verifie la premiere. tools/controle/drapeaux-lisibles.php verifie
la seconde. Les deux sont necessaires : l'un sans l'autre laisse passer la
moitie du defaut.

Usage :
    python3 tools/labs/epreuves-univ.py --conteneur univ
    python3 tools/labs/epreuves-univ.py --conteneur univ --verbeux

Sortie 0 si les 22 epreuves passent, 1 sinon.
"""

import argparse
import ast
import os
import subprocess
import sys

ICI = os.path.dirname(os.path.abspath(__file__))
RACINE = os.path.dirname(os.path.dirname(ICI))
FABRIQUE = os.path.join(RACINE, "labs", "univ-01", "make-lab.py")


def regles():
    """Lit REGLES dans make-lab.py sans l'executer.

    On ne peut pas importer le module : il calcule FLAGS au chargement, donc
    il lirait les fichiers locaux au lieu de la machine testee. ast suffit.
    """
    with open(FABRIQUE, encoding="utf-8") as handle:
        arbre = ast.parse(handle.read())

    for noeud in arbre.body:
        if isinstance(noeud, ast.Assign) and getattr(noeud.targets[0], "id", "") == "REGLES":
            return ast.literal_eval(noeud.value)

    raise SystemExit("REGLES introuvable dans %s" % FABRIQUE)


def drapeaux_attendus():
    """Les drapeaux tels que le serveur les lira dans /root/flags."""
    attendus = {}
    dossier = os.path.join(RACINE, "labs", "univ-01", "flag")

    for nom in sorted(os.listdir(dossier)):
        with open(os.path.join(dossier, nom), encoding="utf-8") as handle:
            attendus[nom] = handle.read().strip()

    return attendus


def joue(conteneur, commande):
    """Joue la commande dans la machine, comme l'eleve, sans privileges."""
    essai = [
        "docker", "exec",
        "--user", "1000:1000",
        conteneur,
        "bash", "-lc", commande,
    ]

    try:
        return subprocess.run(essai, capture_output=True, text=True, timeout=60)
    except FileNotFoundError:
        raise SystemExit(
            "docker est introuvable : ce script doit tourner la ou les images "
            "sont disponibles (workflow Machines, ou un poste avec Docker)."
        )


def main():
    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--conteneur", default="univ", help="nom du conteneur lance")
    analyseur.add_argument("--verbeux", action="store_true", help="affiche chaque commande")
    options = analyseur.parse_args()

    liste = regles()
    attendus = drapeaux_attendus()

    if len(liste) != len(attendus):
        print("ECHEC : %d regles pour %d drapeaux" % (len(liste), len(attendus)))
        return 1

    echecs = 0

    for indice, regle in enumerate(liste, start=1):
        nom = "flag-u%02d.txt" % indice
        commande = regle[3]
        attendu = attendus.get(nom, "")

        resultat = joue(options.conteneur, commande)
        sortie = (resultat.stdout or "").strip()

        if options.verbeux:
            print("  %s" % commande)
            print("    -> %r" % sortie[:80])

        # Une commande qui echoue, ou qui ne dit rien, ne produit pas le
        # drapeau : l'eleve ne peut pas valider meme en faisant juste.
        if resultat.returncode != 0:
            print("ECHEC %s : la commande sort en %d" % (nom, resultat.returncode))
            print("       %s" % commande)
            print("       %s" % (resultat.stderr or "").strip()[:200])
            echecs += 1
            continue

        if sortie == "":
            print("ECHEC %s : la commande ne produit rien" % nom)
            print("       %s" % commande)
            echecs += 1
            continue

        # Le drapeau attendu est « SECURA{<radical>_<valeur>} ». La commande
        # ne produit que la valeur : c'est bien ce que l'eleve recopie.
        valeur = attendu.replace("SECURA{", "").replace("}", "")
        radical = regle[1]
        if not valeur.startswith(radical + "_"):
            print("ECHEC %s : drapeau %r, radical %r" % (nom, attendu, radical))
            echecs += 1
            continue

        attendu_nu = valeur[len(radical) + 1:]

        if sortie != attendu_nu:
            print("ECHEC %s : la commande produit %r, le drapeau dit %r"
                  % (nom, sortie[:80], attendu_nu[:80]))
            print("       %s" % commande)
            echecs += 1

    total = len(liste)
    print()
    if echecs:
        print("VERDICT : ECHEC — %d epreuves sur %d ne produisent pas le drapeau." % (echecs, total))
        return 1

    print("VERDICT : REUSSI — %d manipulations sur %d produisent le drapeau attendu." % (total, total))
    return 0


if __name__ == "__main__":
    sys.exit(main())
