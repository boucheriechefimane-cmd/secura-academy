#!/usr/bin/env python3
"""Joue les extracteurs sur les cours restants et affiche le journal.

Ce script sert a comprendre POURQUOI un cours ne donne aucune question :
le journal de chaque extracteur dit, partie par partie, ce qui a ete
refuse (reponse trop courte, pas de reponse dans le corrige, appariement
impossible...).

Usage :
    python3 tools/essayer-cours.py --texte <dossier> --cours 18-075 6-061 ...
"""

import argparse
import io
import json
import os
import subprocess
import sys

ICI = os.path.dirname(os.path.abspath(__file__))

OUTILS = [
    ("import-mit-parts-reponses.py", "parts-reponses"),
    ("import-mit-parts-reponses.py", "numeros-reponses"),
    ("import-mit-probleme-solution.py", None),
]


def main(argv=None):
    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--texte", required=True)
    analyseur.add_argument("--cours", nargs="+", required=True)
    analyseur.add_argument("--theme", default="algorithmes")
    args = analyseur.parse_args(argv)

    for slug in args.cours:
        dossier = os.path.join(args.texte, slug)
        if not os.path.isdir(dossier):
            print("%-60s ABSENT" % slug[:60])
            continue
        print("=" * 74)
        print(slug)
        for outil, format_ in OUTILS:
            temporaire = "/tmp/essai-%s.json" % slug
            commande = [sys.executable, os.path.join(ICI, outil),
                        "--texte", dossier, "--sortie", temporaire,
                        "--source", "essai", "--url", "https://ocw.mit.edu/courses/%s/" % slug,
                        "--attribution", "MIT OpenCourseWare, %s" % slug,
                        "--prefixe", "[MIT — question d’examen, en anglais] ",
                        "--theme", args.theme]
            if format_:
                commande += ["--format", format_]
            resultat = subprocess.run(commande, capture_output=True, text=True)
            nom = "%s/%s" % (outil.replace("import-mit-", "").replace(".py", ""),
                             format_ or "-")
            lignes = [l for l in (resultat.stdout or "").split("\n") if l.strip()]
            if not os.path.exists(temporaire):
                print("  %-30s ERREUR : %s" % (nom, (resultat.stderr or "")[:200]))
                continue
            with io.open(temporaire, encoding="utf-8") as fichier:
                lot = json.load(fichier)
            n = sum(len(t) for r in lot["rooms"] for t in r["tasks"].values())
            refus = [l.strip() for l in lignes if l.strip().startswith("refuse")]
            print("  %-30s %3d question(s), %d refus" % (nom, n, len(refus)))
            for l in refus[:6]:
                print("      %s" % l[:150])
            os.remove(temporaire)
    return 0


if __name__ == "__main__":
    sys.exit(main())
