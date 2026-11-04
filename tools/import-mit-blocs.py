#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""Extrait les questions d'un examen MIT OCW dont le corrige officiel est
publie, quel que soit le format de l'examen.

Pourquoi ce troisieme extracteur : MIT OCW publie des examens dans des
formats tres differents. On en a deja traite deux (le format « N. [X
points]: » avec items a choix, et le format « probleme + sous-questions »
avec « (a) (2pt) »). Les cours qu'on trouve ensuite utilisent d'autres
presentations :

  - « 1. [6 points]: question »            (6.830 Database Systems)
  - « 1.1 » puis l'enonce                   (6.172 Performance Engineering)
  - « (a) [10 points] question »            (6.006, 6.046J Algorithmes)
  - « Question 3. question »                (1.124J Software Engineering)

LE PRINCIPE, et ce qui garantit qu'aucune reponse n'est inventee :

  1. l'enonce et le corrige sont decoupes en blocs, chaque bloc commence
     par un en-tete de question ;
  2. dans chaque bloc, un REPERE (« Answer: », « Solution: », « Write
     your answer below », « Fill in the blanks ») separe l'ENONCE de la
     REPONSE. Ce repere est la meme chose dans les deux fichiers : dans
     l'enonce il est suivi d'un blanc, dans le corrige il est suivi de la
     correction officielle ;
  3. les blocs sont apparies par leur ORDRE, et l'appariement est
     VERIFIE : l'enonce du bloc apparie doit se retrouver dans le
     corrige (comparaison des premiers mots, en ignorant la ponctuation).
     Sinon, la question est abandonnee ;
  4. la reponse retenue est le texte que le corrige place APRES le
     repere, et rien d'autre.

Ce qui n'est pas.extractible (une question a options cerclees, un
tableau, un schema) est refuse : on prefere une question de moins a une
question dont la reponse serait devinee.

Usage :
    python3 tools/import-mit-blocs.py --texte dossier/ --sortie lot.json \\
        --format points-colon --source id --url ... --attribution "..." \\
        --prefixe "[MIT 6.830 — question d’examen, en anglais] "
"""

from __future__ import annotations

import argparse
import importlib.util
import json
import os
import re
import sys
# L'appariement enonce <-> corrige : le hash de ressource d'OCW differe
# d'un fichier a l'autre, un appariement par nom exact ne trouve donc
# rien. Le module fait les deux : exact d'abord, puis sans le hash.
sys.path.insert(0, os.path.dirname(os.path.abspath(__file__)))
from ocw_appariement import apparier  # noqa: E402


LIGATURES = {
    "ﬀ": "ff", "ﬁ": "fi", "ﬂ": "fl", "ﬃ": "ffi", "ﬄ": "ffl",
    "’": "'", "‘": "'", "“": '"', "”": '"',
    "—": "-", "–": "-", "−": "-", " ": " ", "…": "...",
}

# --------------------------------------------------------------------------
# Les formats d'en-tete reconnus (nom -> (motif, groupe du numero, groupe du texte))
# --------------------------------------------------------------------------

RE_POINTS_COLON = (re.compile(r"^\s*(\d+)\.\s*\[(\d+)\s*(?:pts?|points?)\]\s*:?\s*(.*)$"), 1, 3)
RE_SOUS_NUMERO = (re.compile(r"^\s*(\d+\.\d+)\s*$"), 1, 0)
RE_PARTIE_POINTS = (re.compile(r"^\s*\(([a-z])\)\s*\[(\d+)\s*(?:pts?|points?)\]\s*(.*)$"), 1, 3)
RE_QUESTION = (re.compile(r"^\s*Question\s+(\d+)\.\s*(.*)$"), 1, 2)
# « (a) T F enonce » : les items vrai/faux des quizzes d'algorithmes.
RE_PARTIE_TF = (re.compile(r"^\s*\(([a-z])\)\s+T\s+F\s+(.*)$"), 1, 2)

FORMATS = {
    "points-colon": RE_POINTS_COLON,
    "sous-numero": RE_SOUS_NUMERO,
    "partie-points": RE_PARTIE_POINTS,
    "question-n": RE_QUESTION,
    "partie-tf": RE_PARTIE_TF,
}

# -----------------------------------------------------------------------
# Le format « Problem N. Titre [X points] (K parts) » suivi de sous-
# parties « (a) [Y points] enonce ».
#
# C'est le format des quizzes de 6.006 et 6.046J. Chaque sous-partie
# est une question a part entiere : elle a son propre enonce et sa
# propre correction officielle. Le probleme parent donne le contexte
# (parfois indispensable : l'algo est decrit juste avant).
#
# Ce format est traite a part : il a deux niveaux, et le decoupage
# simple par expression reguliere ne suffit pas.
# -----------------------------------------------------------------------

RE_PROBLEME = re.compile(r"^\s*Problem\s+(\d+)\.\s*(.*)$")
# La sous-partie peut porter ses points (« (a) [10 points] enonce »),
# ou les announcing dans le corrige seulement (« (a) T F enonce », puis
# « Solution: [3 points] True. … »). Les deux sont acceptes.
RE_PARTIE_PROBLEME = re.compile(
    r"^\s*\(([a-z])\)\s*(?:T\s+F\s+)?(?:\[(\d+)\s*(?:pts?|points?)\]\s*)?(.*)$", re.I
)

# Les reperes qui separent l'enonce de la reponse, dans l'enonce ET dans
# le corrige. Le premier trouve dans le bloc gagne.
REPERES = (
    re.compile(r"^\s*Answer\s*:\s*(.*)$", re.I),
    re.compile(r"^\s*Solution\s*:\s*(.*)$", re.I),
    re.compile(r"^\s*\(Write your answer[s]? in the space[s]? below[^)]*\)\s*$", re.I),
    re.compile(r"^\s*\(Fill in the blanks below\.?\)\s*$", re.I),
    re.compile(r"^\s*\(Write your answer in the space below each issue\.?\)\s*$", re.I),
)

# Un item dont la reponse est un grille de T/F ou des options cerclees :
# la reponse n'est pas dans le texte, on ne l'invente pas.
RE_INCOMPLET = re.compile(
    r"circle\s+T\s+or\s+F"
    r"|circle\s+(?:the\s+)?(?:best\s+)?answer"
    r"|circle\s+one"
    r"|\(circle\s+one\)"
    r"|check\s+(?:all|any)\s+(?:that|the)"
    r"|\bthe figure\b"
    r"|\bthe diagram\b"
    r"|\bas shown above\b"
    r"|\bas shown below\b"
    # Une reference a un element qui n'est pas dans l'enonce rend la
    # question incomprehensible : « the table above », « the code below »,
    # « the parameters given above », mais aussi « again » (la question
    # suppose un contexte deja donne) et « the log » (le journal n'est
    # pas fourni).
    r"|\babove\b"
    r"|\bbelow\b"
    r"|\bthe following\b"
    r"|\bagain\b"
    r"|\bpreviously\b"
    r"|\bearlier\b"
    r"|\bthe log\b"
    r"|\bthe CP record\b"
    r"|\bthe checkpoint\b"
    r"|\bthe transaction\b"
    r"|\bthe schedule\b"
    r"|\bthe table\b"
    r"|\bthe parameters\b",
    re.I,
)

ENONCE_MIN = 40          # caracteres : en dessous, l'item est tronque
REPONSE_MIN = 3          # caracteres : en dessous, il n'y a pas de reponse
REPONSE_MAX = 2000       # caracteres : au-dessus, c'est de la pagination
REPONSE_REDIGEE_MIN = 60  # pour le mode « solution », il faut de quoi apprendre

RE_PAGE = re.compile(r"^\s*\d{1,3}\s*$")
RE_PIED_COURS = re.compile(r"^\s*Name\s*:\s*$")
RE_PIED_NUM = re.compile(r"^\s*\d+\.\d+\s+\S.*\bPage\s+\d+\s+of\s+\d+\b.*$")
RE_PIED_NUM2 = re.compile(r"^\s*\d+\.\d+\s+(Fall|Spring|Summer|Winter)\b.*$")
RE_ENTETE_PDF = re.compile(r"^\s*\d{3,4}\s+\d{3,4}\s*$")
RE_FOOTER_COURSE = re.compile(r"^\s*(?:MIT OpenCourseWare|http://ocw\.mit\.edu).*$")
RE_SECTION = re.compile(r"^\s*(?:[IVX]{1,4}|[A-H])\s{2,}[A-Z].*$")


# Les pieds de page des PDF de MIT OCW : « 6.172 Practice Quiz 2 Name 15 »,
# « 6.046J/18.410J Final », « 6.006 Quiz 1 Name 2 ». Ils polluent la
# question et la correction ; on les retire.
RE_PIED_BIBLIO = re.compile(
    r"^\s*\d+\.\d{3}[A-Za-z]?(?:/\d+\.\d{3}[A-Za-z]?)?\s+.*$"
)
RE_PIED_MOTS = re.compile(
    r"\b(?:Name|Page|Final|Solutions?|Quiz|Exercise|Paper|Problems?)\b"
)


# Un pied de page peut se retrouver colle a la fin d'une ligne de texte
# (« … 6.006 Introduction to Algorithms Name 2 »). On retire le fragment.
RE_PIED_DANS_LIGNE = re.compile(
    r"\s*\b\d{1,2}\.\d{3}[A-Za-z]?(?:/\d{1,2}\.\d{3}[A-Za-z]?)?\b"
    r"\s+.*?\b(?:Name|Page|Final|Solutions?|Quiz|Exercise)\b.*$"
)


# Un pied de page peut se retrouver a la fin d'un bloc, suivi de la
# mention de licence d'OCW (« For information about citing these
# materials… »). On coupe tout ce qui suit.
RE_MENTION_LICENCE = re.compile(r"\bFor information about citing these materials\b", re.I)

# Les lignes qui forment un pied de page en fin de bloc.
RE_PIED_FIN = (
    re.compile(r"^\s*\d{1,2}\.\d{3}[A-Za-z]?(?:/\d{1,2}\.\d{3}[A-Za-z]?)?\b.*$"),
    re.compile(r"^\s*(?:Fall|Spring|Summer|Winter)\s+\d{4}\s*$"),
    re.compile(r"^\s*https?://ocw\.mit\.edu/?\s*$"),
    re.compile(r"^\s*MIT OpenCourseWare\s*$"),
    re.compile(r"^\s*End of Quiz.*$"),
    re.compile(r"^\s*For information about citing these materials.*$"),
)


def couper_pied_de_fin(texte):
    """Retire le pied de page qui peut cloturer un bloc de texte."""
    lignes = texte.split("\n")

    # On ne touche qu'a la fin : le pied de page est toujours en fin de
    # bloc (jamais au milieu d'une phrase).
    debut = len(lignes)
    for index in range(len(lignes) - 1, max(-1, len(lignes) - 8), -1):
        if any(motif.match(lignes[index]) for motif in RE_PIED_FIN):
            debut = index
            continue
        break

    if debut < len(lignes):
        lignes = lignes[:debut]

    return "\n".join(lignes)


def nettoyer_pieds(texte):
    # Un bloc peut finir par un pied de page suivi de la mention de
    # licence : on coupe la partir de cette mention.
    coupe = RE_MENTION_LICENCE.search(texte)
    if coupe:
        texte = texte[:coupe.start()]

    lignes = []
    for ligne in texte.split("\n"):
        if RE_PIED_BIBLIO.match(ligne) and RE_PIED_MOTS.search(ligne):
            continue
        trouve = RE_PIED_DANS_LIGNE.search(ligne)
        if trouve:
            ligne = ligne[:trouve.start()].rstrip()
        if ligne:
            lignes.append(ligne)
    return "\n".join(lignes)


def nettoyer(texte):
    for avant, apres in LIGATURES.items():
        texte = texte.replace(avant, apres)
    texte = re.sub(r"[ \t]+", " ", texte)
    texte = re.sub(r"\n{3,}", "\n\n", texte)
    texte = nettoyer_pieds(texte)
    texte = couper_pied_de_fin(texte)
    return texte.strip()


def lignes_utiles(chemin):
    with open(chemin, encoding="utf-8", errors="replace") as fichier:
        lignes = fichier.read().split("\n")
    return [
        l for l in lignes
        if l.strip()
        and not RE_PAGE.match(l)
        and not RE_PIED_COURS.match(l)
        and not RE_PIED_NUM.match(l)
        and not RE_PIED_NUM2.match(l)
        and not RE_ENTETE_PDF.match(l)
        and not RE_FOOTER_COURSE.match(l)
        and not RE_SECTION.match(l)
    ]


def decouper(chemin, format_):
    """Decoupe un fichier en blocs : chaque bloc commence par un en-tete."""
    motif, groupe_numero, groupe_texte = FORMATS[format_]
    lignes = lignes_utiles(chemin)
    blocs = []
    courant = None

    for ligne in lignes:
        m = motif.match(ligne)
        if m:
            if courant is not None:
                blocs.append(courant)
            texte = m.group(groupe_texte) if groupe_texte else ""
            courant = {"cle": m.group(groupe_numero), "lignes": [texte.strip()] if texte.strip() else []}
            continue
        if courant is not None:
            courant["lignes"].append(ligne.strip())

    if courant is not None:
        blocs.append(courant)

    return blocs


def separer_enonce_reponse(lignes):
    """Renvoie (enonce, reponse) grace au repere.

    L'enonce s'arrete au repere ; la reponse est ce qui suit. Si aucun
    repere n'est trouve, on renvoie (texte, "") : la question sera
    refusee plus bas, plutot que d'inventer une reponse.
    """
    for index, ligne in enumerate(lignes):
        for motif in REPERES:
            m = motif.match(ligne)
            if m:
                enonce = "\n".join(lignes[:index])
                suite = lignes[index + 1:]
                # Un repere « Answer: True » porte la reponse sur la meme
                # ligne : on la prend.
                if m.groups() and m.group(1).strip():
                    suite = [m.group(1).strip()] + suite
                return enonce, "\n".join(suite)
    return "\n".join(lignes), ""


def signature(texte, mots=18):
    texte = texte.lower()
    texte = re.sub(r"[^a-z0-9 ]+", " ", texte)
    return " ".join(texte.split()[:mots])


def comparer(enonce, corrige):
    """Le corrige officiel repete l'enonce : on verifie qu'il s'agit bien
    de la meme question. C'est la garde-fou qui interdit d'apparier
    l'enonce d'une question a la reponse d'une autre."""
    a = signature(enonce)
    b = signature(corrige)
    if not a or not b:
        return False
    if a == b:
        return True
    if a.startswith(b) or b.startswith(a):
        return True
    morceaux = [m for m in a.split() if len(m) > 3]
    if len(morceaux) >= 8:
        for i in range(len(morceaux) - 7):
            if " ".join(morceaux[i:i + 8]) in b:
                return True
    return False


def analyser_reponse(reponse):
    """Distingue « True/False » d'une reponse redigee."""
    brut = reponse.strip()
    # « [3 points] True. Let T (0) = 1. » : les points du bareme
    # precedent la reponse, on les retire avant de lire.
    brut = re.sub(r"^\s*\[\d+\s*(?:pts?|points?)\]\s*", "", brut, flags=re.I)
    if re.fullmatch(r"(?i)(true|false)\.?(\s+(and\s+.*)?)", brut):
        premiere = brut.split()[0].capitalize()
        return "vrai_faux", premiere, nettoyer(brut)
    if re.fullmatch(r"(?i)(true|false)", brut):
        return "vrai_faux", brut.strip().capitalize(), ""
    return "solution", "", nettoyer(brut)


def decouper_problemes(chemin):
    """Decoupe un fichier « Problem N. » en sous-parties « (a) ».

    Chaque sous-partie devient un bloc. Le probleme parent (son titre et
    le contexte qui precede la premiere sous-partie) est conserve : il
    est souvent indispensable pour comprendre l'enonce (« l'algorithme
    suivant », « le schema ci-dessus »...).
    """
    lignes = lignes_utiles(chemin)
    blocs = []
    contexte = []
    courant = None

    def fermer():
        nonlocal courant
        if courant is not None:
            blocs.append(courant)
            courant = None

    for ligne in lignes:
        m = RE_PROBLEME.match(ligne)
        if m:
            fermer()
            contexte = [ligne.strip()]
            continue

        m = RE_PARTIE_PROBLEME.match(ligne)
        if m:
            fermer()
            courant = {
                "cle": m.group(1),
                "lignes": list(contexte) + [m.group(3).strip()],
                "points": int(m.group(2)) if m.group(2) else 0,
                "contexte": list(contexte),
            }
            # Le contexte ne sert qu'a la premiere sous-partie : il est
            # deja dans le bloc.
            contexte = []
            continue

        if courant is not None:
            courant["lignes"].append(ligne.strip())
        elif contexte:
            contexte.append(ligne.strip())

    fermer()

    return blocs


def construire_problemes(texte_examen, texte_corrige, prefixe, attribution, licence, xp=20):
    """Construit les questions d'un fichier « Problem N. ».

    L'appariement se fait par ordre : les sous-parties de l'enonce et
    celles du corrige se correspondent une a une. La garde-fou
    `comparer()` verifie ensuite que c'est bien la meme question — on
    n'invente jamais l'appariement.
    """
    blocs_examen = decouper_problemes(texte_examen)
    blocs_corrige = decouper_problemes(texte_corrige)

    questions = []

    for index, bloc in enumerate(blocs_examen):
        if index >= len(blocs_corrige):
            break

        enonce_examen, _ = separer_enonce_reponse(bloc["lignes"])
        enonce_corrige, reponse_corrige = separer_enonce_reponse(blocs_corrige[index]["lignes"])

        enonce = nettoyer(enonce_examen)
        if len(enonce) < ENONCE_MIN:
            continue

        # Verification : l'enonce du corrige doit bien etre celui-la.
        if not comparer(enonce, nettoyer(enonce_corrige)):
            continue

        reponse = nettoyer(reponse_corrige)
        if len(reponse) < REPONSE_MIN:
            continue
        if len(reponse) > REPONSE_MAX:
            reponse = reponse[:REPONSE_MAX].rsplit(" ", 1)[0] + " [...]"

        genre, valeur, justification = analyser_reponse(reponse)
        if genre == "solution" and len(justification) < REPONSE_REDIGEE_MIN:
            continue

        if RE_INCOMPLET.search(enonce):
            continue

        if genre == "vrai_faux":
            questions.append({
                "question": "%s\n\n%s" % (prefixe, enonce),
                "mode": "choice",
                "xp": xp,
                "options": ["True", "False"],
                "answer": 0 if valeur == "True" else 1,
                "hint": "Question d’examen du MIT : choisis la bonne proposition, puis la "
                        "correction officielle du MIT s’affiche.",
                "explanation": justification or ("Réponse officielle du MIT : %s" % valeur),
                "source": attribution,
                "licence": licence,
            })
        else:
            questions.append({
                "question": "%s\n\n%s" % (prefixe, enonce),
                "mode": "solution",
                "xp": xp,
                "hint": "Question d’examen du MIT : rédige ta réponse, puis la "
                        "correction officielle du MIT s’affiche.",
                "explanation": "Corrigé officiel du MIT : %s" % justification,
                "source": attribution,
                "licence": licence,
            })

    return questions


def construire(texte_examen, texte_corrige, format_, prefixe, attribution, licence, xp=20):
    blocs_examen = decouper(texte_examen, format_)
    blocs_corrige = decouper(texte_corrige, format_)

    questions = []

    for index, bloc in enumerate(blocs_examen):
        if index >= len(blocs_corrige):
            break

        enonce_examen, _ = separer_enonce_reponse(bloc["lignes"])
        enonce_corrige, reponse_corrige = separer_enonce_reponse(blocs_corrige[index]["lignes"])

        enonce = nettoyer(enonce_examen)
        if len(enonce) < ENONCE_MIN:
            continue

        # Verification : l'enonce du corrige doit bien etre celui-la.
        if not comparer(enonce, nettoyer(enonce_corrige)):
            continue

        reponse = nettoyer(reponse_corrige)
        if len(reponse) < REPONSE_MIN:
            continue
        if len(reponse) > REPONSE_MAX:
            reponse = reponse[:REPONSE_MAX].rsplit(" ", 1)[0] + " [...]"

        genre, valeur, justification = analyser_reponse(reponse)
        if genre == "solution" and len(justification) < REPONSE_REDIGEE_MIN:
            continue

        # Une question dont la reponse est un tableau, un schema ou des
        # options cerclees ne se repond pas dans un texte : on la refuse.
        if RE_INCOMPLET.search(enonce):
            continue

        if genre == "vrai_faux":
            questions.append({
                "question": "%s\n\n%s" % (prefixe, enonce),
                "mode": "choice",
                "xp": xp,
                "options": ["True", "False"],
                "answer": 0 if valeur == "True" else 1,
                "hint": "Question d’examen du MIT : choisis la bonne proposition, puis la "
                        "correction officielle du MIT s’affiche.",
                "explanation": justification or ("Réponse officielle du MIT : %s" % valeur),
                "source": attribution,
                "licence": licence,
            })
        else:
            questions.append({
                "question": "%s\n\n%s" % (prefixe, enonce),
                "mode": "solution",
                "xp": xp,
                "hint": "Question d’examen du MIT : rédige ta réponse, puis la "
                        "correction officielle du MIT s’affiche.",
                "explanation": "Corrigé officiel du MIT : %s" % justification,
                "source": attribution,
                "licence": licence,
            })

    return questions


def main(argv=None):
    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--texte", required=True, help="dossier des .txt (pdftotext)")
    analyseur.add_argument("--sortie", required=True, help="lot JSON a ecrire")
    analyseur.add_argument("--format", required=True,
                            choices=sorted(FORMATS) + ["problem-parties"])
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
        corrige = apparier(nom, args.texte)
        if corrige is None:
            print("  %-34s pas de corrige — ignore" % base, file=sys.stderr)
            continue

        if args.format == "problem-parties":
            lot = construire_problemes(
                os.path.join(args.texte, nom),
                corrige,
                args.prefixe,
                args.attribution,
                args.licence,
                args.xp,
            )
        else:
            lot = construire(
                os.path.join(args.texte, nom),
                corrige,
                args.format,
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

    # La repartition est celle de l'extracteur « questions d'examen » : on
    # commence par les rooms dont le reservoir est le plus juste.
    chemin_base = os.path.join(os.path.dirname(os.path.abspath(__file__)), "import-mit-ocw.py")
    specification = importlib.util.spec_from_file_location("import_mit_ocw", chemin_base)
    module = importlib.util.module_from_spec(specification)
    specification.loader.exec_module(module)

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
