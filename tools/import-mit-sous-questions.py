#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""Extrait les questions d'un examen MIT au format « problème + sous-questions ».

Pourquoi un second extracteur
------------------------------
Le cours 6.858 (et 6.828, 6.5660) présente ses examens sous la forme
« 1. [6 points]: … » : une ligne d'en-tête par question. Le cours 14.15J
(Networks) présente les siens sous la forme « 1. Titre du problème » puis
« (a) (2pt) … (b) (2pt) … » : une question = un problème + une sous-question,
et l'énoncé du problème est indispensable pour comprendre la question.

Le principe est le même que pour l'autre extracteur, et c'est le point
important : **rien n'est inventé**. On n'accepte une question que si le
corrigé officiel du MIT contient la réponse ; ce corrigé devient
l'explication affichée à l'élève. L'élève rédige sa réponse, puis la
correction officielle du MIT s'affiche mot pour mot — aucune note
automatique n'est inventée.

Usage :
    python3 tools/import-mit-sous-questions.py --texte dossier/ \
        --sortie lot.json --source mit-ocw-14-15j-examens \
        --attribution "MIT OpenCourseWare, 14.15J Networks, Spring 2018 …" \
        --prefixe "[MIT 14.15J — question d’examen, en anglais] "
"""

from __future__ import annotations

import argparse
import importlib.util
import json
import os
import re
import sys


def _charger_extracteur_de_base():
    """Recharge la repartition de l'extracteur « questions d'examen ».

    Les deux extracteurs partagent la meme regle de repartition : une
    question va dans la room dont le reservoir est le plus juste, en
    respectant le theme. On evite ainsi d'avoir deux regles qui divergent.
    """
    chemin = os.path.join(os.path.dirname(os.path.abspath(__file__)), "import-mit-ocw.py")
    specification = importlib.util.spec_from_file_location("import_mit_ocw", chemin)
    module = importlib.util.module_from_spec(specification)
    specification.loader.exec_module(module)
    return module

# Un en-tête de problème : « 1. Clustering » ou « 2. Centrality in Infinite Graphs. »
RE_PROBLEME = re.compile(r"^\s*(?:Problem\s+)?(\d+)[.:]?\s+([A-Z][^\n]{2,90})\s*$")
# Une sous-question : « (a) (2pt) Show that … »
RE_PARTIE = re.compile(r"^\s*\(([a-z])\)\s*\((\d+)\s*(?:pts?|points?)\)\s*(.+?)\s*$")
# Une ligne de séparation de page (le PDF paginé colle des « 12 » seuls).
RE_PAGINATION = re.compile(r"^\s*\d{1,3}\s*$")
LIGATURES = {
    "ﬀ": "ff", "ﬁ": "fi", "ﬂ": "fl", "ﬃ": "ffi", "ﬄ": "ffl",
    "’": "'", "‘": "'", "“": '"', "”": '"', "—": "-", "–": "-",
    " ": " ", "…": "...",
}


def nettoyer(texte):
    for avant, apres in LIGATURES.items():
        texte = texte.replace(avant, apres)
    texte = re.sub(r"[ \t]+", " ", texte)
    texte = re.sub(r"\n{3,}", "\n\n", texte)
    return texte.strip()


def lire_parties(chemin):
    """Renvoie { (probleme, lettre) : enonce } pour un fichier texte d'examen."""
    with open(chemin, encoding="utf-8", errors="replace") as fichier:
        lignes = fichier.read().split("\n")

    # On renvoie une LISTE ORDONNEE de parties : chaque partie porte son
    # texte (l'enonce) et le contexte qui la precede (le probleme dont elle
    # depend). L'ordre est plus fiable que la numerotation : dans certains
    # examens, le titre du probleme n'est pas numerote.
    parties = []            # [{'lettre':.., 'points':.., 'enonce':.., 'contexte':..}]
    contexte = []
    buffer_partie = []
    lettre_courante = None

    def vider_partie():
        if lettre_courante is None or not buffer_partie:
            return
        texte = nettoyer("\n".join(buffer_partie))
        if texte:
            parties.append(
                {
                    "lettre": lettre_courante,
                    "enonce": texte,
                    "contexte": nettoyer("\n".join(contexte)),
                }
            )

    for ligne in lignes:
        if not ligne.strip():
            continue
        if RE_PAGINATION.match(ligne):
            continue
        entree_probleme = RE_PROBLEME.match(ligne)
        entree_partie = RE_PARTIE.match(ligne)
        if entree_partie:
            # « (a) (2pt) ... » : le texte de la question commence sur la
            # MEME ligne — il ne faut pas le perdre.
            vider_partie()
            lettre_courante = entree_partie.group(1)
            buffer_partie = [entree_partie.group(3)]
            contexte = []
            continue
        if entree_probleme:
            # Un nouveau probleme : le contexte change.
            vider_partie()
            lettre_courante = None
            buffer_partie = []
            contexte = [entree_probleme.group(2).strip()]
            continue
        if lettre_courante is not None:
            buffer_partie.append(ligne)
        else:
            contexte.append(ligne)

    vider_partie()
    return parties


def comparer(enonce, solution):
    """Le corrige officiel repete l'enonce : on verifie que les deux
    corresponde, en ignorant la ponctuation et la casse. C'est la garde-fou
    qui empeche d'accoupler l'enonce d'une question a la reponse d'une
    autre."""
    def signature(texte):
        texte = texte.lower()
        texte = re.sub(r"[^a-z0-9 ]+", " ", texte)
        return " ".join(texte.split()[:18])

    a = signature(enonce)
    b = signature(solution)
    if not a or not b:
        return False
    if a == b:
        return True
    # Le corrige peut reformuler : on accepte si un fragment long est commun.
    morceaux = [m for m in a.split() if len(m) > 3]
    if len(morceaux) >= 8:
        commun = 0
        for i in range(len(morceaux) - 7):
            if " ".join(morceaux[i:i + 8]) in b:
                commun += 1
        return commun > 0
    return False


def construire(texte_examen, texte_corrige, prefixe, attribution, licence, xp=20):
    parties_examen = lire_parties(texte_examen)
    parties_corrige = lire_parties(texte_corrige)

    questions = []
    for index, partie in enumerate(parties_examen):
        if index >= len(parties_corrige):
            break
        solution_partie = parties_corrige[index]
        if not comparer(partie["enonce"], solution_partie["enonce"]):
            # Enonce et corrige ne se correspondent pas : on ne garde pas la
            # question (on ne devine jamais la reponse).
            continue
        contexte = partie["contexte"]
        if len(contexte) > 1200:
            contexte = contexte[:1200].rsplit(" ", 1)[0] + " [...]"
        question = "%s\n\n%s" % (prefixe, partie["enonce"])
        if contexte:
            question = "%s\n\nContexte : %s\n\n%s" % (prefixe, contexte, partie["enonce"])
        questions.append(
            {
                "question": question,
                "mode": "solution",
                "xp": xp,
                "hint": "Question d’examen du MIT : la justification du corrigé officiel "
                        "est affichée juste après ta réponse.",
                "explanation": "Corrige officiel du MIT : %s" % solution_partie["enonce"],
                "source": attribution,
                "licence": licence,
            }
        )
    return questions


def main(argv=None):
    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--texte", required=True, help="dossier des .txt (pdftotext)")
    analyseur.add_argument("--sortie", required=True, help="lot JSON a ecrire")
    analyseur.add_argument("--source", required=True, help="identifiant de la source")
    analyseur.add_argument("--url", required=True, help="page du cours sur MIT OCW")
    analyseur.add_argument("--attribution", required=True)
    analyseur.add_argument("--licence", default="CC BY-NC-SA 4.0")
    analyseur.add_argument("--prefixe", required=True)
    analyseur.add_argument("--prefixe-solution", required=True)
    analyseur.add_argument("--theme", default="cyber",
                            help="theme du cours d'origine : cyber, donnees, "
                                 "algorithmes, cpp, performance, compilation, langage")
    analyseur.add_argument("--tache", default="test")
    analyseur.add_argument("--repartition", default="",
                            help="fichier JSON de repartition {room: [questions]} (facultatif)")
    args = analyseur.parse_args(argv)

    fichiers = sorted(f for f in os.listdir(args.texte) if f.endswith("_sol.txt"))
    if not fichiers:
        print("Aucun corrige (*_sol.txt) dans %s" % args.texte)
        return 1

    questions = []
    vues = set()
    for nom in fichiers:
        base = nom[: -len("_sol.txt")]
        chemin_examen = os.path.join(args.texte, base + ".txt")
        if not os.path.exists(chemin_examen):
            print("  %-28s pas d'énoncé correspondant — ignoré" % base)
            continue
        lot = construire(
            chemin_examen,
            os.path.join(args.texte, nom),
            args.prefixe_solution,
            args.attribution,
            args.licence,
        )
        retenues = 0
        for question in lot:
            clef = question["question"][:220]
            if clef in vues:
                continue
            vues.add(clef)
            questions.append(question)
            retenues += 1
        print("  %-28s %2d question(s)" % (base, retenues))

    print("Total : %d question(s) avec corrige officiel." % len(questions))

    if args.repartition:
        with open(args.repartition, encoding="utf-8") as fichier:
            par_room = json.load(fichier)
    else:
        # Meme repartition que l'autre extracteur : on commence par les
        # rooms dont le reservoir est le plus juste.
        par_room = _charger_extracteur_de_base().repartir(questions)

    rooms = []
    for slug, questions_room in sorted(par_room.items()):
        if not questions_room:
            continue
        rooms.append(
            {
                "room": slug,
                "title": slug,
                "tasks": {args.tache: questions_room},
            }
        )

    lot = {
        "source": args.source,
        "licence": args.licence,
        "attribution": args.attribution,
        "url": args.url,
        "rooms": rooms,
    }

    dossier = os.path.dirname(os.path.abspath(args.sortie))
    if dossier:
        os.makedirs(dossier, exist_ok=True)
    with open(args.sortie, "w", encoding="utf-8") as fichier:
        json.dump(lot, fichier, ensure_ascii=False, indent=2)

    print("Lot ecrit : %s" % args.sortie)
    return 0


if __name__ == "__main__":
    sys.exit(main())
