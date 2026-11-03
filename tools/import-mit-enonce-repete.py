# -*- coding: utf-8 -*-
"""Extrait les questions d'un examen MIT OCW dont le corrige REPETE l'enonce.

Pourquoi un cinquieme extracteur : chaque universite presente ses
examens autrement. On a deja traite le format « N. [X points]: » avec
items a choix (6.830), le format « probleme + sous-questions » (6.006,
6.046J), le format « Question N. » (1.124J) et le format « blanc a
remplir » (6.004). Le MIT 6.189 « Multicore Programming Primer » en
utilise un autre : le corrige officiel **repete l'enonce** avant de
repondre.

LE PRINCIPE, et ce qui garantit qu'aucune reponse n'est inventee :

1. l'enonce est decoupe en blocs, chaque bloc commence par « Question
   N: » ;
2. pour chaque bloc, on cherche dans le corrige officiel un motif
   construit a partir des **mots exacts** de l'enonce (chaud, la ligne
   peut etre coupee differemment dans le corrige) ;
3. si ce motif est retrouve, la reponse est **exactement le texte qui
   suit** dans le corrige, rien d'autre ;
4. si le motif n'est pas retrouve — le corrige ne repete pas l'enonce,
   ou le repete autrement — la question est **abandonnee**. Aucun
   appariement par ordre n'est tolere : c'est ce qui garantit qu'on ne
   melange jamais deux questions.

Ce qui n'est pas extractible est refuse : une reponse courte, une
reponse qui depend d'un schema absent (« the figure below »), une
reponse deformee par l'extraction (caractere de remplacement), une
reponse qui est du code.

Usage :
    python3 tools/import-mit-enonce-repete.py --texte dossier/ \
        --sortie lot.json --source id --url ... --attribution "..." \
        --prefixe "[MIT 6.189 — question d’examen, en anglais] "
"""

import argparse
import importlib.util
import io
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

# --------------------------------------------------------------------------
# Un bloc de question commence par « Question 12: » (le numero peut etre
# suivi d'un point).
RE_QUESTION = re.compile(r"^\s*Question\s+(\d+)\s*[:.]\s*(.*)$")

# Un enonce qui depend d'un support absent (schema, tableau, dessin).
RE_INCOMPLET = re.compile(
    r"\bthe figure\b"
    r"|\bthe diagram\b"
    r"|\bas shown (?:above|below)\b"
    r"|\bthe tree shown\b"
    r"|\bthe graph\b"
    r"|\bthe following\b"
    r"|\bthe code below\b"
    r"|\bthe table\b",
    re.I,
)

# Le caractere de remplacement : le PDF a perdu un symbole (formule,
# indice, greek). Une reponse qui en contient est deformee : refus.
RE_DEFORME = re.compile("[\ufffd]")

# Une reponse qui est du code : on ne l'importe pas comme redigee.
RE_CODE = re.compile(r"[{};]\s*$|^\s*(?:public|private|static|void|int|class|import)\b", re.M)

# La longueur minimale de la reponse officielle. En dessous, il n'y a
# rien a apprendre : l'eleve recevrait une reponse sèche.
REPONSE_MIN = 120

# Les en-tetes OCW (« Please use the following citation format... ») ne
# font pas partie de l'enonce.
RE_ENTETE = re.compile(r"ocw\.mit\.edu/terms", re.I)


def charger(chemin):
    """Renvoie les lignes utiles d'un texte extrait d'un PDF OCW."""
    with io.open(chemin, encoding="utf-8", errors="replace") as f:
        texte = f.read()
    lignes = texte.split("\n")
    # On coupe l'en-tete OCW (la citation) : il se termine par l'adresse
    # des conditions d'utilisation.
    for i, ligne in enumerate(lignes):
        if RE_ENTETE.search(ligne):
            lignes = lignes[i + 1:]
            break
    # On retire les lignes vides en bout de bloc et les pages vides.
    return [l.rstrip() for l in lignes]


def normaliser(texte):
    """Ramene un texte a une seule ligne, sans espaces multiples."""
    return re.sub(r"\s+", " ", texte).strip()


def bloc_questions(lignes):
    """Decoupe l'enonce en blocs « Question N: ... ».

    Renvoie une liste de (numero, texte). Un bloc s'acheve quand un
    nouveau « Question N: » commence, ou a la fin du fichier.
    """
    blocs = []
    courant = None
    for ligne in lignes:
        m = RE_QUESTION.match(ligne)
        if m:
            if courant is not None:
                blocs.append(courant)
            courant = [m.group(1), [m.group(2)]]
        elif courant is not None:
            courant[1].append(ligne)
    if courant is not None:
        blocs.append(courant)
    return [(n, normaliser(" ".join(paras))) for n, paras in blocs]


def motif_de(enonce):
    """Construit le motif qui retrouve l'enonce dans le corrige.

    Chaque mot est echappe, et les espaces deviennent « un espace ou
    plus » : la ligne peut etre coupee autrement dans le corrige.
    """
    mots = [re.escape(m) for m in enonce.split(" ") if m]
    if not mots:
        return None
    return re.compile(r"\s+".join(mots))


def reponse_officielle(enonce, corrige):
    """Renvoie la reponse officielle, ou None si elle est introuvable.

    La reponse est le texte qui suit l'enonce repete dans le corrige.
    Elle s'arrete a la question suivante, si le corrige en contient une.
    """
    motif = motif_de(enonce)
    if motif is None:
        return None
    m = motif.search(corrige)
    if not m:
        return None
    suite = corrige[m.end():]
    # La reponse s'arrete a la question suivante du corrige.
    m2 = RE_QUESTION.match(suite.lstrip())
    if m2:
        suite = suite.lstrip()[: m2.start()]
    return normaliser(suite)


def construire(chemin_examen, chemin_corrige, prefixe, attribution, licence, xp=20):
    """Apparie les questions de l'enonce aux reponses du corrige officiel."""
    questions = []
    enonce = charger(chemin_examen)
    corrige = charger(chemin_corrige)
    corps_corrige = normaliser("\n".join(corrige))

    for numero, texte in bloc_questions(enonce):
        if len(texte) < 40:
            continue  # enonce tronque
        if RE_INCOMPLET.search(texte):
            continue  # depend d'un schema absent
        if RE_DEFORME.search(texte):
            continue

        reponse = reponse_officielle(texte, corps_corrige)
        if reponse is None:
            print("    question %s : l'enonce n'est pas repete dans le corrige — refusee" % numero,
                  file=sys.stderr)
            continue
        if len(reponse) < REPONSE_MIN:
            print("    question %s : reponse trop courte — refusee" % numero, file=sys.stderr)
            continue
        if RE_INCOMPLET.search(reponse):
            print("    question %s : la reponse depend d'un schema — refusee" % numero, file=sys.stderr)
            continue
        if RE_DEFORME.search(reponse):
            print("    question %s : reponse deformee par l'extraction — refusee" % numero, file=sys.stderr)
            continue
        if RE_CODE.search(reponse):
            print("    question %s : la reponse est du code — refusee" % numero, file=sys.stderr)
            continue

        questions.append({
            "question": prefixe + texte,
            "mode": "solution",
            "hint": "Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.",
            "explanation": "Corrigé officiel du MIT : " + reponse,
            "source": attribution,
            "licence": licence,
            "xp": xp,
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
    analyseur.add_argument("--theme", default="cyber",
                            help="theme du cours d'origine : cyber, donnees, "
                                 "algorithmes, cpp, performance, compilation, langage")
    analyseur.add_argument("--xp", type=int, default=20)
    args = analyseur.parse_args(argv)

    suffixes = ("_soln.txt", "_sol.txt", "-solutions.txt", "_solutions.txt", "_answers.txt")
    fichiers = sorted(
        f for f in os.listdir(args.texte)
        if f.endswith(".txt") and not re.search(r"(sol|solution|answer)", f, re.I)
    )
    if not fichiers:
        print("Aucun enonce dans %s" % args.texte, file=sys.stderr)
        return 1

    questions = []
    vues = set()

    for nom in fichiers:
        base = nom[:-len(".txt")]
        corrige = None
        for suffixe in suffixes:
            candidat = os.path.join(args.texte, base + suffixe)
            if os.path.exists(candidat):
                corrige = candidat
                break
        if corrige is None:
            print("  %-24s pas de corrige — ignore" % base, file=sys.stderr)
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
        print("  %-24s %2d question(s)" % (base, retenues), file=sys.stderr)

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
    with io.open(args.sortie, "w", encoding="utf-8") as f:
        json.dump(lot, f, ensure_ascii=False, indent=2)
        f.write("\n")
    print("Lot ecrit : %s (%d room(s))" % (args.sortie, len(rooms)))
    return 0


if __name__ == "__main__":
    sys.exit(main())
