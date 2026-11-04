#!/usr/bin/env python3
"""Non-regression : les lots deja livres ne doivent pas changer.

On rejoue chaque extracteur sur le dossier de documents du cours, puis on
compare les corrections (les « explanations ») avec celles du lot livre.
Un lot qui change est un signal d'alarme : soit l'extracteur a ete
corrige, soit quelque chose a casse.

Usage :
    python3 tools/non-regression-lots.py
"""

import io
import json
import os
import subprocess
import sys

RACINE = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
OUTILS = os.path.join(RACINE, "tools")
LOTS = os.path.join(OUTILS, "lots")

# Chaque cas : le dossier des documents, puis la liste des extracteurs
# (outil, format, prefixe de la question, prefixe de la solution, theme).
CAS = {
    "mit-ocw-6-253-examens": (
        "6-253-convex-analysis-and-optimization-spring-2012",
        [("import-mit-probleme-solution.py", None,
          "[MIT 6.253 — question d’examen, en anglais] ", None, "algorithmes")]),
    "mit-ocw-6-450-examens": (
        "6-450-principles-of-digital-communications-i-fall-2006",
        [("import-mit-probleme-solution.py", None,
          "[MIT 6.450 — question d’examen, en anglais] ", None, "communications")]),
    "mit-ocw-6-661-examens": (
        "6-661-receivers-antennas-and-signals-spring-2003",
        [("import-mit-probleme-solution.py", None,
          "[MIT 6.661 — question d’examen, en anglais] ", None, "communications")]),
    "mit-ocw-6-832-examens": (
        "6-832-underactuated-robotics-spring-2009",
        [("import-mit-probleme-solution.py", None,
          "[MIT 6.832 — question d’examen, en anglais] ", None, "algorithmes")]),
    "mit-ocw-6-262-examens": (
        "6-262-discrete-stochastic-processes-spring-2011",
        [("import-mit-probleme-solution.py", None,
          "[MIT 6.262 — question d’examen, en anglais] ", None, "algorithmes")]),
    "mit-ocw-6-042j-examens": (
        "6-042j-mathematics-for-computer-science-fall-2010",
        [("import-mit-probleme-solution.py", None,
          "[MIT 6.042J — question d’examen, en anglais] ", None, "algorithmes")]),
    "mit-ocw-6-111-examens": (
        "6-111-introductory-digital-systems-laboratory-spring-2006",
        [("import-mit-probleme-solution.py", None,
          "[MIT 6.111 — question d’exercice, en anglais] ", None, "algorithmes"),
         ("import-mit-expressions.py", None,
          "[MIT 6.111 — exercice d’algebre booléenne, en anglais] ", None,
          "algorithmes")]),
    "mit-ocw-18-404j-examens": (
        "18-404j-theory-of-computation-fall-2020",
        [("import-mit-parts-reponses.py", "parts-reponses",
          "[MIT — question d’examen, en anglais] ", None,
          "comment-marche-un-ordinateur-de-la-donnee-au-programme")]),
    "mit-ocw-6-851-examens": (
        "ocw-6-851",
        [("import-mit-parts-reponses.py", "numeros-reponses",
          "[MIT — question d’examen, en anglais] ", None,
          "comment-marche-un-ordinateur-de-la-donnee-au-programme")]),
    "mit-ocw-14-15j-examens": (
        "ocw-14-15j",
        [("import-mit-sous-questions.py", None,
          "[MIT 14.15J — question d’examen, en anglais] ",
          "Corrige officiel du MIT : ", "algorithmes")]),
}

DOSSIERS = ("/home/user/run/ocw-suite", "/home/user/run/ocw-prioritaires",
             "/home/user/run")


def dossier_du_cours(slug):
    for base in DOSSIERS:
        chemin = os.path.join(base, slug)
        if os.path.isdir(chemin):
            return chemin
    return None


def corrections(lot):
    return sorted(q.get("explanation", "") for r in lot["rooms"]
                  for t in r["tasks"].values() for q in t)


def main():
    echecs = 0
    for source, (slug, extracteurs) in sorted(CAS.items()):
        dossier = dossier_du_cours(slug)
        if not dossier:
            print("%-28s documents absents : non verifie" % source)
            echecs += 1
            continue
        trouvees = []
        for index, (outil, format_, prefixe, prefixe_solution, theme) in enumerate(extracteurs):
            sortie = "/tmp/non-regression-%s-%d.json" % (source, index)
            commande = [sys.executable, os.path.join(OUTILS, outil),
                        "--texte", dossier, "--sortie", sortie,
                        "--source", source, "--url", "u",
                        "--attribution", "MIT OpenCourseWare, essai",
                        "--prefixe", prefixe, "--theme", theme]
            if format_:
                commande += ["--format", format_]
            if prefixe_solution:
                commande += ["--prefixe-solution", prefixe_solution]
            resultat = subprocess.run(commande, capture_output=True, text=True)
            if resultat.returncode != 0 or not os.path.exists(sortie):
                print("%-28s ECHEC : %s" % (source, resultat.stderr.strip()[-90:]))
                echecs += 1
                break
            trouvees.append(json.load(io.open(sortie, encoding="utf-8")))
        else:
            nouveau = {"rooms": []}
            for lot in trouvees:
                nouveau["rooms"].extend(lot["rooms"])
            livre = json.load(io.open(os.path.join(LOTS, "%s.json" % source),
                                      encoding="utf-8"))
            a, b = corrections(livre), corrections(nouveau)
            if a == b:
                print("%-28s ok (%d corrections identiques)" % (source, len(a)))
            else:
                print("%-28s DIFFERENT : livre %d, nouveau %d"
                      % (source, len(a), len(b)))
                echecs += 1
    print("-" * 60)
    print("%d lot(s) verifie(s), %d difference(s)" % (len(CAS), echecs))
    return 1 if echecs else 0


if __name__ == "__main__":
    raise SystemExit(main())
