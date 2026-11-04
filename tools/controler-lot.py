#!/usr/bin/env python3
"""Controle qualite des lots produits par les extracteurs.

Verifie, pour chaque question :
- l'enonce n'est pas vide ni trop court ;
- la reponse n'est pas une copie de l'enonce ;
- il n'y a pas de doublon (enonce + reponse identiques) ;
- la reponse fait au moins 30 caracteres (regle de la plateforme) ;
- l'indice est present ;
- la licence et l'attribution sont renseignees ;
- l'enonce ne contient pas de pied de page ;
- la room qui accueille le lot existe bien dans le plugin.

Ce dernier point compte : le plugin ignore SILENCIEUSEMENT les questions
d'une room qu'il ne connait pas. Une faute de frappe dans un lot ferait
donc disparaitre des questions sans le moindre avertissement.

Le script sort en erreur si une seule question viole une regle : on
prefere un lot vide a un lot douteux.
"""

import io
import json
import os
import re
import sys

RACINE = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
ROOMS = os.path.join(RACINE, "tools", "rooms-connues.json")

RE_PIED = re.compile(r"(MIT OpenCourseWare|ocw\.mit\.edu|^\s*-?\d{1,3}\s*-\s*$)")


def rooms_connues():
    """Les slugs de rooms que le plugin sait creer."""
    if not os.path.exists(ROOMS):
        return None
    with io.open(ROOMS, encoding="utf-8") as fichier:
        return json.load(fichier)


def verifie(lot, nom, rooms=None):
    erreurs = []
    vues = set()
    # L'attribution et la licence du lot servent de repli : l'importeur
    # les reporte sur chaque question au moment de generer le fichier
    # PHP. Ce qui compte, c'est que l'eleve voie une attribution.
    attribution_lot = (lot.get("attribution") or "").strip()
    licence_lot = (lot.get("licence") or "").strip()
    questions = [q for r in lot["rooms"] for t in r["tasks"].values() for q in t]
    for r in lot["rooms"]:
        room = r.get("room") or r.get("title")
        if rooms is not None and room not in rooms:
            erreurs.append("%s : room '%s' inconnue du plugin (les questions "
                            "seraient ignorees sans bruit)" % (nom, room))
    for i, q in enumerate(questions):
        enonce = (q.get("question") or "").strip()
        reponse = (q.get("explanation") or "").strip()
        clef = "%s||%s" % (enonce, reponse)
        if clef in vues:
            erreurs.append("%s : question %d doublon" % (nom, i))
        vues.add(clef)
        if len(enonce) < 20:
            erreurs.append("%s : question %d enonce trop court" % (nom, i))
        if len(reponse) < 30:
            erreurs.append("%s : question %d reponse trop courte" % (nom, i))
        if reponse and enonce and reponse.strip() == enonce.strip():
            erreurs.append("%s : question %d la reponse est l'enonce" % (nom, i))
        if not q.get("hint"):
            erreurs.append("%s : question %d indice manquant" % (nom, i))
        licence = (q.get("licence") or licence_lot).strip()
        if not licence:
            erreurs.append("%s : question %d licence manquante" % (nom, i))
        attribution = (q.get("attribution") or attribution_lot).strip()
        if not attribution:
            erreurs.append("%s : question %d attribution manquante" % (nom, i))
        # L'attribution de la question peut etre plus courte que celle du
        # lot (le lot ajoute souvent « — quiz d'examen et corrige
        # officiel ») : ce qui compte est qu'elle nomme le meme cours.
        if attribution_lot and attribution:
            if not (attribution_lot.startswith(attribution[:40])
                    or attribution.startswith(attribution_lot[:40])):
                erreurs.append("%s : question %d attribution differente de celle "
                                "du lot" % (nom, i))
        if RE_PIED.search(enonce):
            erreurs.append("%s : question %d pied de page dans l'enonce" % (nom, i))
        if q.get("mode") not in ("choice", "solution"):
            erreurs.append("%s : question %d mode inconnu (%s)" % (
                nom, i, q.get("mode")))
    return len(questions), erreurs


def main(argv):
    total = 0
    erreurs = []
    rooms = rooms_connues()
    for chemin in argv:
        lot = json.load(io.open(chemin, encoding="utf-8"))
        n, errs = verifie(lot, chemin, rooms)
        total += n
        erreurs.extend(errs)
        print("%-52s %4d question(s)" % (chemin.split('/')[-1][:52], n))
    print("-" * 60)
    print("TOTAL : %d questions" % total)
    if erreurs:
        print("PROBLEMES :")
        for e in erreurs[:40]:
            print("  - %s" % e)
        return 1
    print("Aucun probleme : toutes les questions respectent les regles.")
    return 0


if __name__ == "__main__":
    raise SystemExit(main(sys.argv[1:]))
