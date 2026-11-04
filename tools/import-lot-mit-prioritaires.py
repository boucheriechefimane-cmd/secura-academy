#!/usr/bin/env python3
"""Fabrique les lots d'import pour la campagne des cours prioritaires.

Ce script est le **cahier de route executable** de la campagne : il dit
quels cours sont vises, avec quel extracteur, dans quelle room thematique,
et avec quelle attribution. Relancer ce script reproduit exactement les
memes lots — c'est ce qui permet de verifier qu'on n'a rien invente.

Regles tenues :
- on n'ecrit que ce que le MIT publie (enonce + corrige officiel) ;
- la licence annoncee est celle verifiee sur la page du cours (ici
  CC BY-NC-SA 4.0 pour les sept cours, verifiee le 04/11/2026) ;
- l'attribution nomme le cours ET la source des tests ;
- un cours dont le format n'est pas couvert n'est pas importe : il est
  signale dans le rapport, sans question devinee.

Usage :
    python3 tools/import-lot-mit-prioritaires.py --texte <dossier> \
        --sortie tools/lots
"""

import argparse
import io
import json
import os
import subprocess
import sys

ICI = os.path.dirname(os.path.abspath(__file__))

# Les sept cours retenus parmi les douze prioritaires, et le refus
# motive des cinq autres.
COURS = [
    {
        "slug": "6-253-convex-analysis-and-optimization-spring-2012",
        "source": "mit-ocw-6-253-examens",
        "url": "https://ocw.mit.edu/courses/6-253-convex-analysis-and-optimization-spring-2012/",
        "attribution": "MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012",
        "theme": "algorithmes",
        "extracteurs": [("import-mit-probleme-solution.py",
                         "[MIT 6.253 — question d’examen, en anglais] ")],
    },
    {
        "slug": "6-450-principles-of-digital-communications-i-fall-2006",
        "source": "mit-ocw-6-450-examens",
        "url": "https://ocw.mit.edu/courses/6-450-principles-of-digital-communications-i-fall-2006/",
        "attribution": "MIT OpenCourseWare, 6.450 Principles of Digital Communications I, Fall 2006",
        "theme": "communications",
        "extracteurs": [("import-mit-probleme-solution.py",
                         "[MIT 6.450 — question d’examen, en anglais] ")],
    },
    {
        "slug": "6-661-receivers-antennas-and-signals-spring-2003",
        "source": "mit-ocw-6-661-examens",
        "url": "https://ocw.mit.edu/courses/6-661-receivers-antennas-and-signals-spring-2003/",
        "attribution": "MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003",
        "theme": "communications",
        "extracteurs": [("import-mit-probleme-solution.py",
                         "[MIT 6.661 — question d’examen, en anglais] ")],
    },
    {
        "slug": "6-832-underactuated-robotics-spring-2009",
        "source": "mit-ocw-6-832-examens",
        "url": "https://ocw.mit.edu/courses/6-832-underactuated-robotics-spring-2009/",
        "attribution": "MIT OpenCourseWare, 6.832 Underactuated Robotics, Spring 2009",
        "theme": "algorithmes",
        "extracteurs": [("import-mit-probleme-solution.py",
                         "[MIT 6.832 — question d’examen, en anglais] ")],
    },
    {
        "slug": "6-262-discrete-stochastic-processes-spring-2011",
        "source": "mit-ocw-6-262-examens",
        "url": "https://ocw.mit.edu/courses/6-262-discrete-stochastic-processes-spring-2011/",
        "attribution": "MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011",
        "theme": "algorithmes",
        "extracteurs": [("import-mit-probleme-solution.py",
                         "[MIT 6.262 — question d’examen, en anglais] ")],
    },
    {
        "slug": "6-042j-mathematics-for-computer-science-fall-2010",
        "source": "mit-ocw-6-042j-examens",
        "url": "https://ocw.mit.edu/courses/6-042j-mathematics-for-computer-science-fall-2010/",
        "attribution": "MIT OpenCourseWare, 6.042J / 18.062J Mathematics for Computer Science, Fall 2010",
        "theme": "algorithmes",
        "extracteurs": [("import-mit-probleme-solution.py",
                         "[MIT 6.042J — question d’examen, en anglais] ")],
    },
    {
        "slug": "6-111-introductory-digital-systems-laboratory-spring-2006",
        "source": "mit-ocw-6-111-examens",
        "url": "https://ocw.mit.edu/courses/6-111-introductory-digital-systems-laboratory-spring-2006/",
        "attribution": "MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006",
        "theme": "algorithmes",
        "extracteurs": [
            ("import-mit-probleme-solution.py",
             "[MIT 6.111 — question d’exercice, en anglais] "),
            ("import-mit-expressions.py",
             "[MIT 6.111 — exercice d’algebre booléenne, en anglais] "),
        ],
    },
]


def fusionner(lots):
    """Fusionne plusieurs lots en un seul : les rooms sont regroupees."""
    fusion = None
    for lot in lots:
        if fusion is None:
            fusion = json.loads(json.dumps(lot))
            fusion["rooms"] = []
        for room in lot["rooms"]:
            trouve = None
            for existant in fusion["rooms"]:
                if existant["room"] == room["room"]:
                    trouve = existant
                    break
            if trouve is None:
                fusion["rooms"].append(json.loads(json.dumps(room)))
            else:
                trouve["tasks"]["test"].extend(room["tasks"]["test"])
    return fusion


def main(argv=None):
    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--texte", required=True,
                           help="dossier des cours telecharges")
    analyseur.add_argument("--sortie", required=True,
                           help="dossier ou ecrire les lots")
    analyseur.add_argument("--licence", default="CC BY-NC-SA 4.0")
    args = analyseur.parse_args(argv)

    if not os.path.isdir(args.texte):
        print("Dossier introuvable : %s" % args.texte, file=sys.stderr)
        return 1
    if not os.path.isdir(args.sortie):
        os.makedirs(args.sortie)

    total = 0
    bilan = []
    for cours in COURS:
        dossier = os.path.join(args.texte, cours["slug"])
        if not os.path.isdir(dossier):
            print("%-56s ABSENT (telechargement a refaire)" % cours["slug"][:56])
            bilan.append((cours["slug"], 0, "documents absents"))
            continue

        lots = []
        echecs = []
        for script, prefixe in cours["extracteurs"]:
            temporaire = "/tmp/lot-%s-%s.json" % (cours["source"], script[:12])
            commande = [
                sys.executable, os.path.join(ICI, script),
                "--texte", dossier,
                "--sortie", temporaire,
                "--source", cours["source"],
                "--url", cours["url"],
                "--attribution", cours["attribution"],
                "--licence", args.licence,
                "--prefixe", prefixe,
                "--theme", cours["theme"],
            ]
            resultat = subprocess.run(commande, capture_output=True, text=True)
            if resultat.returncode != 0 or not os.path.exists(temporaire):
                echecs.append((script, resultat.stderr.strip().split('\n')[-1]
                               if resultat.stderr.strip() else ""))
                continue
            lots.append(json.load(io.open(temporaire, encoding="utf-8")))

        if not lots:
            print("%-56s 0 question(s)  [%s]" % (
                cours["slug"][:56],
                "; ".join("%s : %s" % e for e in echecs) or "aucune paire trouvee"))
            bilan.append((cours["slug"], 0, "; ".join(e[0] for e in echecs)))
            continue

        fusion = fusionner(lots)
        n = sum(len(t) for r in fusion["rooms"] for t in r["tasks"].values())
        chemin = os.path.join(args.sortie, "%s.json" % cours["source"])
        with io.open(chemin, "w", encoding="utf-8") as f:
            f.write(json.dumps(fusion, ensure_ascii=False, indent=2))
        total += n
        print("%-56s %3d question(s)  -> %s" % (
            cours["slug"][:56], n, os.path.basename(chemin)))
        bilan.append((cours["slug"], n, ""))

    print("-" * 74)
    print("TOTAL : %d question(s)" % total)
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
