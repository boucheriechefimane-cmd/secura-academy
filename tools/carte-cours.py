#!/usr/bin/env python3
"""Carte les formats des cours telecharges : combien de paires, quel extracteur.

Pour chaque cours du dossier donne, le script regarde :
1. combien de documents sont presents ;
2. combien de paires enonce / corrige l'appariement trouve
   (tools/ocw_appariement.py) ;
3. ce que chaque extracteur deja ecrit produit sur ce cours.

Le resultat sert a decider, cours par cours : quel extracteur utiliser,
ou quel nouveau format ecrire, ou quel refus motiver.

Usage :
    python3 tools/carte-cours.py --dossier /home/user/run/ocw-suite
"""

import argparse
import io
import json
import os
import subprocess
import sys

RACINE = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
OUTILS = os.path.join(RACINE, "tools")

# Les extracteurs et le format a leur passer (None = pas de --format).
EXTRACTEURS = (
    ("import-mit-blocs.py", None),
    ("import-mit-parts-reponses.py", "parts-reponses"),
    ("import-mit-parts-reponses.py", "numeros-reponses"),
    ("import-mit-probleme-solution.py", None),
    ("import-mit-sous-questions.py", None),
    ("import-mit-titre-items.py", None),
    ("import-mit-enonce-repete.py", None),
    ("import-mit-blancs.py", None),
    ("import-mit-choix-multiples.py", None),
    ("import-mit-vrai-faux.py", None),
    ("import-mit-expressions.py", None),
)

COMMANDES = {
    "import-mit-blocs.py": "Blocs",
    "import-mit-parts-reponses.py": "Parts",
    "import-mit-probleme-solution.py": "Problème",
    "import-mit-sous-questions.py": "Sous-quest.",
    "import-mit-titre-items.py": "Titre+items",
    "import-mit-enonce-repete.py": "Énoncé répété",
    "import-mit-blancs.py": "Blancs",
    "import-mit-choix-multiples.py": "Choix multiples",
    "import-mit-vrai-faux.py": "Vrai/Faux",
    "import-mit-expressions.py": "Expressions",
}


def paires(dossier):
    """Le nombre de paires enonce/corrige trouvees dans un dossier."""
    sys.path.insert(0, OUTILS)
    import ocw_appariement

    return len(ocw_appariement.enonces_avec_corrige(dossier))


def questions(outil, format_, dossier, sortie):
    """Le nombre de questions produites par un extracteur (None si erreur)."""
    commande = [sys.executable, os.path.join(OUTILS, outil),
                "--texte", dossier, "--sortie", sortie,
                "--source", "test", "--url", "https://exemple.test",
                "--attribution", "MIT OpenCourseWare, essai (MIT EECS)"]
    if format_:
        commande += ["--format", format_]
    commande += ["--theme", "algorithmes"]
    if outil != "import-mit-vrai-faux.py":
        commande += ["--prefixe", "[MIT — question d’examen, en anglais] "]
    resultat = subprocess.run(commande, capture_output=True, text=True,
                              cwd=RACINE)
    if resultat.returncode != 0:
        return 0
    try:
        with io.open(sortie, encoding="utf-8") as fichier:
            lot = json.load(fichier)
    except (IOError, ValueError):
        return 0
    return sum(len(t) for r in lot.get("rooms", []) for t in r.get("tasks", {}).values())


def main(argv=None):
    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--dossier", required=True)
    analyseur.add_argument("--json", help="ecrire le resultat dans ce fichier")
    args = analyseur.parse_args(argv)

    cours = sorted(d for d in os.listdir(args.dossier)
                   if os.path.isdir(os.path.join(args.dossier, d)))
    sortie = "/tmp/carte-cours.json"
    lignes = []

    for slug in cours:
        chemin = os.path.join(args.dossier, slug)
        documents = len([f for f in os.listdir(chemin) if f.endswith(".txt")])
        try:
            nb_paires = paires(chemin)
        except Exception as exc:
            nb_paires = -1
        resultats = {}
        for outil, format_ in EXTRACTEURS:
            n = questions(outil, format_, chemin, sortie)
            if n:
                cle = COMMANDES[outil]
                if format_:
                    cle += " (%s)" % format_
                resultats[cle] = n
        lignes.append({
            "cours": slug,
            "documents": documents,
            "paires": nb_paires,
            "extracteurs": resultats,
        })
        print("%-56s %3d doc  %3d paires  %s" % (
            slug[:56], documents, nb_paires,
            ", ".join("%s=%d" % (k, v) for k, v in sorted(resultats.items()))
            or "—"))

    if args.json:
        with io.open(args.json, "w", encoding="utf-8") as fichier:
            json.dump(lignes, fichier, ensure_ascii=False, indent=1)
        print("Ecrit : %s" % args.json)
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
