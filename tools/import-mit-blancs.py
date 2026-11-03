#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""Extrait les questions d'un examen MIT OCW presentees sous forme de
blancs a remplir, avec le corrige officiel publie.

Pourquoi ce quatrieme extracteur : apres « N. [X points]: », « probleme
+ sous-questions » et « 1.1 », on trouve des examens ou l'eleve doit
ECRIRE sa reponse dans un blanc imprime, et ou le corrige officiel
imprime la bonne reponse juste au-dessus du blanc. C'est le format des
quiz du MIT 6.004 (Computation Structures).

LE PRINCIPE, et ce qui garantit qu'aucune reponse n'est inventee :

  1. l'enonce et le corrige sont decoupes en SOUS-QUESTIONS, chacune
     commence par une lettre entre parentheses « (A) », « (B) »… ;
  2. dans l'enonce, la sous-question se termine par un BLANC (« ____ »)
     qui dit ce qu'il faut repondre (« Setup time (ps): ____ ») ;
  3. dans le corrige, la meme sous-question porte le MEME blanc, et la
     reponse officielle est imprimee au-dessus du blanc (ou sur la meme
     ligne, apres les traits) ;
  4. l'appariement est VERIFIE : le libelle du blanc de l'enonce doit
     se retrouver dans le corrige. Sinon, la question est abandonnee ;
  5. la reponse retenue est ce que le corrige a mis dans le blanc, et
     rien d'autre.

Ce qui n'est pas extractible est refuse : une question a options
circlees (le corrige les met en gras, et pdftotext ne voit pas le
gras), une question qui depend d'un schema ou d'un tableau absent, une
reponse repartie sur plusieurs lignes, une reponse en phrase. On
prefere une question de moins a une question dont la reponse serait
devinee.

Usage :
    python3 tools/import-mit-blancs.py --texte dossier/ --sortie lot.json \\
        --source id --url ... --attribution "..." \\
        --prefixe "[MIT 6.004 — question d’examen, en anglais] "
"""

from __future__ import annotations

import argparse
import importlib.util
import json
import os
import re
import sys

RACINE = os.path.dirname(os.path.abspath(__file__))


def charger_module(nom, fichier):
    specification = importlib.util.spec_from_file_location(nom, fichier)
    module = importlib.util.module_from_spec(specification)
    specification.loader.exec_module(module)
    return module


BLOCS = charger_module("import_mit_blocs", os.path.join(RACINE, "import-mit-blocs.py"))

# --------------------------------------------------------------------------
# Une sous-question commence par « (A) », « (B) »… (lettre en majuscule).
RE_PARTIE = re.compile(r"^\s*\(([A-Z])\)\s*(.*)$")

# Un blanc a remplir : une suite de traits de soulignement.
RE_BLANC = re.compile(r"_{3,}")

# Le libelle du blanc : ce qui precede les traits sur la ligne.
RE_LIBELLE = re.compile(r"^(.*?)_{3,}\s*(.*)$")

# Une enonce qui depend d'un support absent (schema, tableau, dessin).
RE_INCOMPLET = re.compile(
    r"\b(?:figure|figures|diagram|diagrams|table below|graph below|shown below|"
    r"as shown|in the figure|the figure above|see figure|drawing|sketch|"
    r"attach|boxed|schematic)\b",
    re.I,
)

# Une reponse qui est une phrase plutot qu'une reponse : on la refuse.
RE_PHRASE = re.compile(r"[a-z]\s+[a-z]+\s+[a-z]+\s+[a-z]+\s+[a-z]+")

# Un gabarit de pied de page ou de bas de page de quiz.
RE_PIED = re.compile(
    r"^\s*6\.004\s+Spring\s+2009\s+-\s+\d+\s+of\s+\d+\s+-\s+Quiz.*$"
)

ENONCE_MIN = 40
ENONCE_MAX = 900
REPONSE_MAX = 60


def lignes_utiles(chemin):
    lignes = BLOCS.lignes_utiles(chemin)
    return [l for l in lignes if not RE_PIED.match(l)]


RE_PROBLEME = re.compile(r"^\s*Problem\s+\d+\s*[.(]?", re.I)


def decouper_parties(lignes):
    """Decoupe le texte en sous-questions « (A) », « (B) »…

    Chaque sous-question garde l'enonce du PROBLEME parent : sans lui,
    la question perd le contexte (« les valeurs de chaque semaphore »
    ne veut rien dire si le probleme ne dit pas quels semaphores)."""
    parties = []
    courante = None
    probleme = []
    dans_probleme = False

    for ligne in lignes:
        entete = RE_PARTIE.match(ligne)

        if entete:
            courante = {
                "lettre": entete.group(1),
                "lignes": [entete.group(2).rstrip()],
                "probleme": list(probleme),
            }
            parties.append(courante)
            dans_probleme = False
            continue

        # Un nouveau probleme reinitialise le decoupage : les parties
        # recommencent a « (A) ».
        if RE_PROBLEME.match(ligne):
            courante = None
            probleme = []
            dans_probleme = True
            continue

        if dans_probleme:
            if ligne.strip():
                probleme.append(ligne.strip())
            else:
                dans_probleme = False
            continue

        if courante is not None:
            # On garde l'indentation : c'est elle qui dit si la ligne
            # appartient a l'enonce (a gauche) ou a la reponse officielle
            # (colonne de droite).
            courante["lignes"].append(ligne.rstrip())

    return parties


def trouver_blanc(partie):
    """Renvoie (libelle, ligne) du blanc de la sous-question, ou None."""
    for ligne in partie["lignes"]:
        if RE_BLANC.search(ligne):
            correspondance = RE_LIBELLE.match(ligne)
            if correspondance is None:
                continue
            libelle = correspondance.group(1).strip(" :;,.-")
            reste = correspondance.group(2).strip()
            return libelle, ligne, reste
    return None


def texte_enonce(partie):
    """Le texte de la sous-question, sans le blanc, avec son contexte."""
    lignes = []
    for ligne in partie["lignes"]:
        if RE_BLANC.search(ligne):
            correspondance = RE_LIBELLE.match(ligne)
            if correspondance is not None:
                libelle = correspondance.group(1).strip()
                if libelle:
                    if not libelle.endswith(":"):
                        libelle += " :"
                    lignes.append(libelle)
            break
        if ligne.strip():
            lignes.append(ligne.strip())

    contexte = "\n".join(partie.get("probleme", [])).strip()
    corps = "\n".join(lignes).strip()

    if contexte:
        return contexte + "\n\n" + corps

    return corps


# Une ligne « pure » : un seul bloc de texte, c'est-a-dire une ligne
# entierement blancoe a gauche puis la reponse. Une ligne qui porte a la
# fois l'enonce et la reponse (« The correct Huffman tree is   10 ») est
# refusee : on ne sait pas ou s'arrete l'enonce.
RE_PURE = re.compile(r"^\s*\S[^\s].*\S\s*$")

# La reponse officielle est alignee a droite, dans la colonne de droite
# de la page : elle commence bien plus loin que l'enonce.
COLONNE_REPONSE = 45


def reponse_dans_corrige(partie, libelle_attendu):
    """La reponse officielle, ou None si elle n'est pas sure."""
    lignes = partie["lignes"]

    for index, ligne in enumerate(lignes):
        if not RE_BLANC.search(ligne):
            continue

        correspondance = RE_LIBELLE.match(ligne)
        if correspondance is None:
            return None

        libelle = correspondance.group(1).strip(" :;,.-")
        sur_la_ligne = correspondance.group(2).strip()

        # Le libelle doit etre le MEME que dans l'enonce : c'est la
        # verification de l'appariement.
        if libelle.lower() != libelle_attendu.lower():
            return None

        # Cas 1 : la reponse est imprimee sur la meme ligne, apres les
        # traits (« Latency: ________ns; 1/180 ns-1 »).
        if sur_la_ligne:
            # Une parenthese ou une virgule n'est pas une reponse : c'est
            # la fin de l'enonce (« Asymptotic throughput: Teta(____ ) »).
            if not re.search(r"[A-Za-z0-9]", sur_la_ligne):
                sur_la_ligne = ""
            elif sur_la_ligne.startswith("(") and sur_la_ligne.endswith(")"):
                sur_la_ligne = ""

        if sur_la_ligne:
            if len(sur_la_ligne) > REPONSE_MAX:
                return None
            return sur_la_ligne

        # Cas 2 : la reponse est imprimee au-dessus du blanc, alignee a
        # droite, seule sur sa ligne. Si la ligne porte autre chose, la
        # reponse est probablement repartie : on refuse.
        for position in range(index - 1, max(-1, index - 4), -1):
            candidate = lignes[position]

            if not candidate.strip():
                continue

            if not RE_PURE.match(candidate):
                return None

            if len(candidate) - len(candidate.lstrip()) < COLONNE_REPONSE:
                return None

            reponse = candidate.strip()

            if not reponse or len(reponse) > REPONSE_MAX:
                return None

            return reponse

        return None

    return None


def construire(chemin_examen, chemin_corrige, prefixe, attribution, licence, xp=20):
    with open(chemin_examen, encoding="utf-8", errors="replace") as fichier:
        lignes_examen = lignes_utiles(chemin_examen)
    with open(chemin_corrige, encoding="utf-8", errors="replace") as fichier:
        lignes_corrige = lignes_utiles(chemin_corrige)

    parties_examen = decouper_parties(lignes_examen)
    parties_corrige = decouper_parties(lignes_corrige)

    questions = []
    vues = set()

    for index, partie in enumerate(parties_examen):
        blanc = trouver_blanc(partie)
        if blanc is None:
            continue

        libelle, _, _ = blanc

        enonce = BLOCS.nettoyer(texte_enonce(partie))
        if len(enonce) < ENONCE_MIN or len(enonce) > ENONCE_MAX:
            continue

        # Une enonce qui depend d'un schema ou d'un tableau absent est
        # refusee : la reponse serait devinee.
        if RE_INCOMPLET.search(enonce):
            continue

        # La sous-question correspondante du corrige : on les apparie par
        # leur LETTRE, puis on verifie le libelle du blanc.
        correspondante = None
        for candidate in parties_corrige:
            if candidate["lettre"] == partie["lettre"]:
                correspondante = candidate
                break

        if correspondante is None:
            continue

        reponse = reponse_dans_corrige(correspondante, libelle)
        if reponse is None:
            continue

        reponse = reponse.strip(" .;:,")
        if not reponse or len(reponse) > REPONSE_MAX:
            continue
        if "…" in reponse or "..." in reponse:
            continue
        if RE_PHRASE.search(reponse):
            continue

        clef = enonce[:220]
        if clef in vues:
            continue
        vues.add(clef)

        questions.append({
            "question": "%s\n\n%s" % (prefixe, enonce),
            "mode": "solution",
            "xp": xp,
            "hint": "Question d’examen du MIT : rédige ta réponse, puis la "
                    "correction officielle du MIT s’affiche.",
            "explanation": "Réponse officielle du MIT pour « %s » : %s. "
                           "C'est la valeur que le corrigé officiel du MIT "
                           "inscrit dans le blanc de cette question." % (libelle, reponse),
            "source": attribution,
            "licence": licence,
        })

    return questions


def main(argv=None):
    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--texte", required=True, help="dossier des .txt (pdftotext)")
    analyseur.add_argument("--sortie", required=True, help="lot JSON a ecrire")
    analyseur.add_argument("--source", required=True)
    analyseur.add_argument("--url", required=True)
    analyseur.add_argument("--attribution", required=True)
    analyseur.add_argument("--licence", default="CC BY-NC-SA 4.0")
    analyseur.add_argument("--prefixe", required=True)
    analyseur.add_argument("--theme", default="algorithmes",
                            help="theme du cours d'origine : cyber, donnees, "
                                 "algorithmes, cpp, performance, compilation, langage")
    analyseur.add_argument("--xp", type=int, default=20)
    args = analyseur.parse_args(argv)

    fichiers = sorted(
        f for f in os.listdir(args.texte)
        if f.endswith(".txt")
        and not re.search(r"(sol|solution|answer)", f, re.I)
    )
    if not fichiers:
        print("Aucun enonce dans %s" % args.texte, file=sys.stderr)
        return 1

    questions = []
    vues = set()

    for nom in fichiers:
        base = nom[:-len(".txt")]
        corrige = None
        for suffixe in ("_sol.txt", "-solutions.txt", "_solutions.txt", "_answers.txt"):
            candidat = os.path.join(args.texte, base + suffixe)
            if os.path.exists(candidat):
                corrige = candidat
                break
        if corrige is None:
            print("  %-34s pas de corrige — ignore" % base, file=sys.stderr)
            continue

        lot = construire(
            os.path.join(args.texte, nom),
            corrige,
            args.prefixe,
            args.attribution,
            args.licence,
            args.xp,
        )
        retenues = 0
        for question in lot:
            clef = question["question"][:220]
            if clef in vues:
                continue
            vues.add(clef)
            questions.append(question)
            retenues += 1
        print("  %-34s %2d question(s)" % (base, retenues), file=sys.stderr)

    print("Total : %d question(s) avec corrige officiel." % len(questions))

    if not questions:
        print("Aucune question retenue : rien n'est importe (on ne devine jamais).", file=sys.stderr)
        return 1

    module = charger_module("import_mit_ocw", os.path.join(RACINE, "import-mit-ocw.py"))

    par_room = module.repartir(questions, args.theme)

    rooms = []
    for slug, questions_room in sorted(par_room.items()):
        if not questions_room:
            continue
        rooms.append({
            "room": slug,
            "title": slug,
            "tasks": {"test": questions_room},
        })

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

    print("Lot ecrit : %s (%d room(s))" % (args.sortie, len(rooms)))
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
