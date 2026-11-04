#!/usr/bin/env python3
"""Note la qualite d'un lot de questions : la reponse repond-elle ?

Un lot peut contenir beaucoup de questions et des questions fausses.
On mesure donc, pour chaque lot :
- le nombre de questions ;
- combien de reponses sont IDENTIQUES a l'enonce (piege le plus grave :
  l'enonce publie comme si c'etait sa reponse) ;
- combien de reponses ne contiennent aucun signe de reponse (pas de
  chiffre, pas de signe « = », pas de phrase) ;
- combien de enonces sont trop courts ou de reponses trop courtes.

Le score sert a choisir, entre plusieurs extracteurs, celui qui produit
le lot le plus fiable pour un cours donne.

Usage :
    python3 tools/noter-lots.py --dossier /home/user/run/ocw-suite --sortie /tmp/notes.json
"""

import argparse
import io
import json
import os
import re
import subprocess
import sys

RACINE = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
OUTILS = os.path.join(RACINE, "tools")

EXTRACTEURS = (
    ("import-mit-probleme-solution.py", None),
    ("import-mit-parts-reponses.py", "parts-reponses"),
    ("import-mit-parts-reponses.py", "numeros-reponses"),
    ("import-mit-sous-questions.py", None),
    ("import-mit-titre-items.py", None),
    ("import-mit-enonce-repete.py", None),
    ("import-mit-blancs.py", None),
    ("import-mit-choix-multiples.py", None),
    ("import-mit-vrai-faux.py", None),
    ("import-mit-expressions.py", None),
)

RE_CHIFFRE = re.compile(r"[0-9=≤≥<>±]|(?:True|False|Yes|No|Vrai|Faux)")


def normalise(texte):
    return re.sub(r"\s+", " ", (texte or "")).strip().lower()


def note(lot):
    questions = [q for r in lot.get("rooms", []) for t in r["tasks"].values() for q in t]
    identiques = 0
    sans_reponse = 0
    trop_courtes = 0
    for q in questions:
        enonce = q.get("question", "")
        reponse = q.get("explanation", "")
        # On retire le prefixe et la formule « Corrige officiel du MIT : ».
        corps = normalise(re.sub(r"^\[[^\]]*\]\s*", "", enonce))
        rep = normalise(re.sub(r"^Corrig[ée] officiel du MIT\s*:\s*", "", reponse))
        if corps and corps == rep:
            identiques += 1
        elif not RE_CHIFFRE.search(reponse):
            sans_reponse += 1
        if len(reponse) < 30:
            trop_courtes += 1
    n = len(questions)
    return {
        "questions": n,
        "identiques": identiques,
        "sans_reponse": sans_reponse,
        "trop_courtes": trop_courtes,
        "score": n - 5 * identiques - 2 * sans_reponse - trop_courtes,
    }


def main(argv=None):
    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--dossier", required=True)
    analyseur.add_argument("--theme", default="algorithmes")
    analyseur.add_argument("--sortie")
    analyseur.add_argument("--prefixe", default="[MIT — question d’examen, en anglais] ")
    args = analyseur.parse_args(argv)

    resultats = {}
    for slug in sorted(os.listdir(args.dossier)):
        chemin = os.path.join(args.dossier, slug)
        if not os.path.isdir(chemin):
            continue
        mesures = {}
        for outil, format_ in EXTRACTEURS:
            sortie = "/tmp/note-%s.json" % slug
            commande = [sys.executable, os.path.join(OUTILS, outil),
                        "--texte", chemin, "--sortie", sortie,
                        "--source", "test", "--url", "https://exemple.test",
                        "--attribution", "MIT OpenCourseWare, essai",
                        "--prefixe", args.prefixe, "--theme", args.theme]
            if format_:
                commande += ["--format", format_]
            resultat = subprocess.run(commande, capture_output=True, text=True,
                                      cwd=RACINE)
            if resultat.returncode != 0 or not os.path.exists(sortie):
                continue
            with io.open(sortie, encoding="utf-8") as fichier:
                mesures["%s%s" % (outil.replace("import-mit-", "").replace(".py", ""),
                                   " (%s)" % format_ if format_ else "")] = note(json.load(fichier))
        resultats[slug] = mesures
        meilleur = ""
        if mesures:
            meilleur = max(mesures.items(), key=lambda kv: kv[1]["score"])[0]
        print("%-56s %s" % (slug[:56], meilleur))

    if args.sortie:
        with io.open(args.sortie, "w", encoding="utf-8") as fichier:
            json.dump(resultats, fichier, ensure_ascii=False, indent=1)
        print("Ecrit : %s" % args.sortie)
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
