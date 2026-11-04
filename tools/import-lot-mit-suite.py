#!/usr/bin/env python3
"""Fabrique les lots d'import de la suite des cours du criblage.

Ce script est le **cahier de route executable** de la deuxieme vague :
il dit quels cours sont vises, avec quel extracteur, dans quel theme de
room, et avec quelle attribution. Relancer ce script reproduit exactement
les memes lots.

Regles tenues (les memes qu'avant) :
- on n'ecrit que ce que le MIT publie (enonce + corrige officiel) ;
- la licence annoncee est celle verifiee sur la page du cours
  (CC BY-NC-SA 4.0 pour tous les cours de cette vague, verifiee par le
  moteur de criblage le 04/11/2026) ;
- l'attribution nomme le cours ET la source des tests ;
- un cours dont le format n'est pas couvert n'est pas importe : il est
  signale dans le rapport, avec son motif ;
- un cours dont le sujet n'a rien a voir avec la cybersecurite (chimie,
  sciences des materiaux) est refuse : la plateforme est une plateforme
  de securite, y loger un examen de chimie serait un mensonge.

Usage :
    python3 tools/import-lot-mit-suite.py --texte <dossier> --sortie tools/lots
"""

import argparse
import io
import json
import os
import re
import subprocess
import sys

ICI = os.path.dirname(os.path.abspath(__file__))

# slug -> (identifiant du lot, theme, [(extracteur, format, prefixe)])
# theme : le theme de room qui accueille les questions. « algorithmes »
# pour les cours de mathematique et d'informatique, « communications »
# pour les cours de signaux et d'electrotechnique.
COURS = [
    ("18-085-computational-science-and-engineering-i-summer-2020",
     "mit-ocw-18-085-examens", "algorithmes",
     [("import-mit-parts-reponses.py", "numeros-reponses",
       "[MIT 18.085 — question d’examen, en anglais] ")]),
    ("18-024-multivariable-calculus-with-theory-spring-2011",
     "mit-ocw-18-024-examens", "algorithmes",
     [("import-mit-parts-reponses.py", "numeros-reponses",
       "[MIT 18.024 — question d’examen, en anglais] ")]),
    ("18-034-honors-differential-equations-spring-2009",
     "mit-ocw-18-034-examens", "algorithmes",
     [("import-mit-parts-reponses.py", "numeros-reponses",
       "[MIT 18.034 — question d’examen, en anglais] ")]),
    ("18-04-complex-variables-with-applications-spring-2018",
     "mit-ocw-18-04-examens", "algorithmes",
     [("import-mit-probleme-solution.py", None,
       "[MIT 18.04 — question d’examen, en anglais] ")]),
    ("18-05-introduction-to-probability-and-statistics-spring-2022",
     "mit-ocw-18-05-examens", "algorithmes",
     [("import-mit-probleme-solution.py", None,
       "[MIT 18.05 — question d’examen, en anglais] ")]),
    ("18-06-linear-algebra-spring-2010",
     "mit-ocw-18-06-examens", "algorithmes",
     [("import-mit-parts-reponses.py", "parts-reponses",
       "[MIT 18.06 — question d’examen, en anglais] ")]),
    ("18-435j-quantum-computation-fall-2003",
     "mit-ocw-18-435j-examens", "algorithmes",
     [("import-mit-probleme-solution.py", None,
       "[MIT 18.435J — question d’examen, en anglais] ")]),
    ("18-440-probability-and-random-variables-spring-2014",
     "mit-ocw-18-440-examens", "algorithmes",
     [("import-mit-probleme-solution.py", None,
       "[MIT 18.440 — question d’examen, en anglais] ")]),
    ("18-443-statistics-for-applications-spring-2015",
     "mit-ocw-18-443-examens", "algorithmes",
     [("import-mit-parts-reponses.py", "numeros-reponses",
       "[MIT 18.443 — question d’examen, en anglais] ")]),
    ("18-600-probability-and-random-variables-fall-2019",
     "mit-ocw-18-600-examens", "algorithmes",
     [("import-mit-parts-reponses.py", "parts-reponses",
       "[MIT 18.600 — question d’examen, en anglais] ")]),
    ("18-102-introduction-to-functional-analysis-spring-2009",
     "mit-ocw-18-102-examens", "algorithmes",
     [("import-mit-parts-reponses.py", "numeros-reponses",
       "[MIT 18.102 — question d’examen, en anglais] ")]),
    ("6-003-signals-and-systems-fall-2011",
     "mit-ocw-6-003-examens", "communications",
     [("import-mit-parts-reponses.py", "numeros-reponses",
       "[MIT 6.003 — question d’examen, en anglais] ")]),
    ("6-011-introduction-to-communication-control-and-signal-processing-spring-2010",
     "mit-ocw-6-011-examens", "communications",
     [("import-mit-parts-reponses.py", "numeros-reponses",
       "[MIT 6.011 — question d’examen, en anglais] ")]),
    ("6-012-microelectronic-devices-and-circuits-fall-2009",
     "mit-ocw-6-012-f09-examens", "communications",
     [("import-mit-probleme-solution.py", None,
       "[MIT 6.012 — question d’examen, en anglais] ")]),
    ("6-013-electromagnetics-and-applications-spring-2009",
     "mit-ocw-6-013-examens", "communications",
     [("import-mit-probleme-solution.py", None,
       "[MIT 6.013 — question d’examen, en anglais] ")]),
    ("6-041-probabilistic-systems-analysis-and-applied-probability-fall-2010",
     "mit-ocw-6-041-f10-examens", "algorithmes",
     [("import-mit-probleme-solution.py", None,
       "[MIT 6.041 — question d’examen, en anglais] ")]),
    ("6-041sc-probabilistic-systems-analysis-and-applied-probability-fall-2013",
     "mit-ocw-6-041sc-examens", "algorithmes",
     [("import-mit-parts-reponses.py", "parts-reponses",
       "[MIT 6.041SC — question d’examen, en anglais] ")]),
    ("6-046j-introduction-to-algorithms-sma-5503-fall-2005",
     "mit-ocw-6-046j-f05-examens", "algorithmes",
     [("import-mit-parts-reponses.py", "numeros-reponses",
       "[MIT 6.046J — question d’examen, en anglais] ")]),
    ("6-7220j-nonlinear-optimization-spring-2025",
     "mit-ocw-6-7220j-examens", "algorithmes",
     [("import-mit-probleme-solution.py", None,
       "[MIT 6.7220J — question d’examen, en anglais] ")]),
    ("6-041-probabilistic-systems-analysis-and-applied-probability-spring-2006",
     "mit-ocw-6-041-s06-examens", "algorithmes",
     [("import-mit-probleme-solution.py", None,
       "[MIT 6.041 — question d’examen, en anglais] ")]),
    ("6-641-electromagnetic-fields-forces-and-motion-spring-2009",
     "mit-ocw-6-641-f09-examens", "communications",
     [("import-mit-parts-reponses.py", "numeros-reponses",
       "[MIT 6.641 — question d’examen, en anglais] ")]),
    ("6-973-communication-system-design-spring-2006",
     "mit-ocw-6-973-examens", "communications",
     [("import-mit-probleme-solution.py", None,
       "[MIT 6.973 — question d’examen, en anglais] ")]),
]

# Cours dont le sujet n'a rien a voir avec la cybersecurite : on ne les
# importe pas. Le motif est ecrit, il n'est pas devine.
# Les cours dont le format n'est pas exploitable, avec le motif ecrit.
# On ne complete jamais un document par du contenu redige : c'est le
# refus qui fait foi.
REFUS_FORMAT = {
    "18-03-differential-equations-spring-2010":
        "l'enonce est illisible a l'extraction (police non standard dans le PDF)",
    "18-075-advanced-calculus-for-engineers-fall-2004":
        "aucune paire enonce + corrige trouvee (les documents ne s'apparient pas)",
    "18-086-mathematical-methods-for-engineers-ii-spring-2006":
        "l'enonce extrait est un en-tete de feuille de travail, pas une question",
    "18-366-random-walks-and-diffusion-fall-2006":
        "appariement refuse : l'enonce annonce plus d'items que le corrige",
    "18-786-number-theory-ii-class-field-theory-spring-2016":
        "appariement refuse : l'enonce et le corrige n'ont pas les memes items",
    "18-966-geometry-of-manifolds-spring-2007":
        "aucune paire enonce + corrige trouvee (les documents ne s'apparient pas)",
    "6-012-microelectronic-devices-and-circuits-fall-2005":
        "le corrige est un PDF scanne : pas de couche texte",
    "6-01sc-introduction-to-electrical-engineering-and-computer-science-i-spring-2011":
        "les 'corriges' sont des copies remplies d'un quiz en ligne",
    "6-034-artificial-intelligence-spring-2005":
        "l'enonce renvoie a un arbre dessine, le corrige est un tableau",
    "6-035-computer-language-engineering-spring-2010":
        "les blocs de base sont sur la page suivante, la reponse est du code",
    "6-061-introduction-to-electric-power-systems-spring-2011":
        "le corrige ne dit pas ou commence la reponse (pas de repere)",
    "6-152j-micro-nano-processing-technology-fall-2005":
        "aucune paire enonce + corrige trouvee (les documents ne s'apparient pas)",
    "6-241j-dynamic-systems-and-control-spring-2011":
        "appariement refuse : l'enonce et le corrige n'ont pas les memes items",
    "6-341-discrete-time-signal-processing-fall-2005":
        "les cases cochees du corrige n'existent pas dans la couche texte",
    "6-641-electromagnetic-fields-forces-and-motion-spring-2005":
        "l'enonce extrait est une formule deposee hors de sa ligne (mise en page du PDF)",
    "6-642-continuum-electromechanics-fall-2008":
        "l'enonce extrait est un fragment de solution, pas la question",
    "6-825-techniques-in-artificial-intelligence-sma-5504-fall-2002":
        "l'enonce est un examen du 6.891, le corrige du 6.825",
}

REFUS_SUJET = {
    "3-00-thermodynamics-of-materials-fall-2002":
        "thermodynamique des materiaux : sans lien avec la securite",
    "3-012-fundamentals-of-materials-science-fall-2005":
        "science des materiaux : sans lien avec la securite",
    "3-034-organic-biomaterials-chemistry-fall-2005":
        "chimie des biomateriaux : sans lien avec la securite",
    "3-052-nanomechanics-of-materials-and-biomaterials-spring-2007":
        "nanomecanique des materiaux : sans lien avec la securite",
    "3-091sc-introduction-to-solid-state-chemistry-fall-2010":
        "chimie de l'etat solide : sans lien avec la securite",
    "3-15-electrical-optical-magnetic-materials-and-devices-fall-2006":
        "materiaux electriques, optiques et magnetiques : sans lien avec la securite",
    "3-205-thermodynamics-and-kinetics-of-materials-fall-2006":
        "thermodynamique des materiaux : sans lien avec la securite",
    "3-21-kinetic-processes-in-materials-spring-2006":
        "processus cinetiques dans les materiaux : sans lien avec la securite",
    "3-22-mechanical-behavior-of-materials-spring-2008":
        "comportement mecanique des materiaux : sans lien avec la securite",
    "3-40j-physical-metallurgy-fall-2009":
        "metallurgie physique : sans lien avec la securite",
}


def titre_du_cours(slug):
    """« 18-06-linear-algebra-spring-2010 » -> « 18.06 Linear Algebra, Spring 2010 ».

    Le numero de cours garde son point (« 6.013 »), le reste est mis en
    majuscules comme l'ecrit le MIT, et le semestre est mis en evidence.
    """
    corps = slug
    terme = ""
    for saison in ("-spring-", "-fall-", "-summer-", "-winter-", "-january-"):
        if saison in corps:
            corps, _, annee = corps.partition(saison)
            mois = saison.strip("-")
            mois = {"january": "January"}.get(mois, mois.capitalize())
            terme = "%s %s" % (mois, annee)
            break
    morceaux = corps.split("-")
    numero = "%s.%s" % (morceaux[0], morceaux[1]) if len(morceaux) > 1 else corps
    titre = " ".join(m.capitalize() for m in morceaux[2:]) if len(morceaux) > 2 else ""
    if terme:
        return "%s %s, %s" % (numero, titre, terme)
    return "%s %s" % (numero, titre)


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
    analyseur.add_argument("--texte", required=True)
    analyseur.add_argument("--sortie", required=True)
    analyseur.add_argument("--licence", default="CC BY-NC-SA 4.0")
    args = analyseur.parse_args(argv)

    if not os.path.isdir(args.texte):
        print("Dossier introuvable : %s" % args.texte, file=sys.stderr)
        return 1
    if not os.path.isdir(args.sortie):
        os.makedirs(args.sortie)

    total = 0
    bilan = []
    for slug, source, theme, extracteurs in COURS:
        dossier = os.path.join(args.texte, slug)
        if not os.path.isdir(dossier):
            print("%-58s ABSENT (telechargement a refaire)" % slug[:58])
            bilan.append({"cours": slug, "questions": 0, "motif": "documents absents"})
            continue

        attribution = ("MIT OpenCourseWare, %s — examen et corrigé officiel "
                       "(MIT EECS)" % titre_du_cours(slug))
        url = "https://ocw.mit.edu/courses/%s/" % slug

        lots = []
        for index, (outil, format_, prefixe) in enumerate(extracteurs):
            temporaire = "/tmp/lot-suite-%s-%d.json" % (source, index)
            commande = [sys.executable, os.path.join(ICI, outil),
                        "--texte", dossier, "--sortie", temporaire,
                        "--source", source, "--url", url,
                        "--attribution", attribution,
                        "--licence", args.licence,
                        "--prefixe", prefixe,
                        "--theme", theme]
            if format_:
                commande += ["--format", format_]
            resultat = subprocess.run(commande, capture_output=True, text=True)
            if resultat.returncode != 0 or not os.path.exists(temporaire):
                continue
            with io.open(temporaire, encoding="utf-8") as fichier:
                lot = json.load(fichier)
            if sum(len(t) for r in lot["rooms"] for t in r["tasks"].values()):
                lots.append(lot)

        if not lots:
            print("%-58s 0 question(s) : format non couvert" % slug[:58])
            bilan.append({"cours": slug, "questions": 0,
                          "motif": "aucun extracteur ne couvre ce format"})
            continue

        fusion = fusionner(lots)
        n = sum(len(t) for r in fusion["rooms"] for t in r["tasks"].values())
        chemin = os.path.join(args.sortie, "%s.json" % source)
        with io.open(chemin, "w", encoding="utf-8") as fichier:
            fichier.write(json.dumps(fusion, ensure_ascii=False, indent=2))
        total += n
        print("%-58s %3d question(s) -> %s" % (slug[:58], n, os.path.basename(chemin)))
        bilan.append({"cours": slug, "source": source, "questions": n, "motif": ""})

    for slug, motif in sorted(REFUS_FORMAT.items()):
        print("%-58s REFUS : %s" % (slug[:58], motif))
        bilan.append({"cours": slug, "questions": 0, "motif": motif})

    for slug, motif in sorted(REFUS_SUJET.items()):
        print("%-58s REFUS : %s" % (slug[:58], motif))
        bilan.append({"cours": slug, "questions": 0, "motif": motif})

    print("-" * 74)
    print("TOTAL : %d question(s)" % total)
    bilan_chemin = os.path.join(os.path.dirname(os.path.dirname(
        os.path.abspath(__file__))), "docs", "recolte", "bilan-suite-cours.json")
    with io.open(bilan_chemin, "w", encoding="utf-8") as fichier:
        json.dump(bilan, fichier, ensure_ascii=False, indent=1)
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
