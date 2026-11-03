#!/usr/bin/env python3
"""Extrait les questions d'examen de MIT 6.858 (2009-2014) et les verifie
contre le corrige officiel.

Le principe : rien n'est invente ici. Le script lit les PDF des quiz et de
leurs corriges (texte extrait avec pdftotext), en tire les items repondus
par choix ou vrai/faux, ET les problemes d'examen dont la reponse est
redigee, et n'accepte un item que si la reponse est litteralement dans le
corrige officiel du MIT. La justification du corrige devient
l'explication de l'eleve : c'est la meilleure pedagogie qu'on puisse offrir,
et elle est ecrite par les enseignants du MIT.

Deux formes de question en sortent :

- les items a choix (QCM a trois propositions, vrai/faux) : ils sont
  rendus tels quels, propositions d'origine, ordre melange ;
- les problemes d'examen rediges (« expliquez comment un attaquant peut
  encore exploiter un debordement de tampon ») : ils sont rendus avec le
  type « solution » — l'eleve redige sa reponse, puis la correction
  officielle du MIT s'affiche. Aucune note automatique n'est inventee :
  une redaction ne se note pas par une machine.

Les PDF se recuperent avec `tools/ocw-recupere.py` (le site de OCW
renvoie des erreurs 503 quand on lui demande trop de choses d'un coup :
le telechargement se fait donc en serie).

Chaque item est rattache a son enonce parent (celui qui contient le listing
de code ou la question de reference) : sans cela, « An adversary can trick
the program... » ne veut rien dire pour l'eleve. Un item qui reste
 incomprehensible est refuse plutot qu'importe tel quel.

Les questions gardent leur langue d'origine (anglais) et leur format
d'origine (2 ou 3 propositions) : c'est un examen, on ne le reecrit pas.
Un prefixe les signale a l'eleve (« question d'examen MIT, en anglais »).

Usage :
    python3 tools/import-mit-ocw.py --texte dossier/ --sortie lot.json
"""

import argparse
import json
import os
import re
import sys

LIGATURES = {
    "ﬀ": "ff", "ﬁ": "fi", "ﬂ": "fl", "ﬃ": "ffi", "ﬄ": "ffl",
    "’": "'", "‘": "'", "“": '"', "”": '"', "—": "-", "–": "-",
}

ATTRIBUTION = ("MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 "
               "— quiz d'examen et corrigé officiel (MIT EECS)")
LICENCE = "CC BY-NC-SA 4.0"
PREFIXE = "[MIT 6.858 — question d’examen, en anglais] "
INDICE = ("Question d’examen du MIT : la justification du corrigé officiel "
          "est affichée juste après ta réponse.")

RE_ENTETE = re.compile(r"^\s*(\d+)\.\s*\[(\d+)\s*points?\]:?\s*(.*)$")
RE_CHOIX = re.compile(r"^\s*([A-D])\.\s+(\S.*)$")
RE_VRAI_FAUX = re.compile(r"^\s*([A-Z])\.\s*True\s*/\s*False\s*(.*)$")
RE_REPONSE = re.compile(r"^\s*Answer:\s*(.*)$")
RE_PAGE = re.compile(r"^\s*\d{1,3}\s*$")
RE_ENTETE_PAGE = re.compile(r"^\s*This page intentionally left blank\.\s*$")
# Titre de section du corrige (« IV User authentication ») : la justification
# d'un item s'arrete la.
RE_SECTION = re.compile(r"^\s*(?:[IVX]{1,4}|[A-H])\s+[A-Z][A-Za-z].*$")

# Un item qui renvoie a une figure, a un listing de code ou a un article ne
# se comprend pas seul : on ne l'importe pas plutot que de le rendre
# incomprehensible pour l'eleve.
RE_INCOMPLET = re.compile(
    r"\bline\s+\d+\b"                     # « Line 4 » (figure de code)
    r"|\bthe above\b"                     # « at the above lines »
    r"|\bthe figure\b"
    r"|\bas described in the paper\b"
    r"|\bfrom the paper\b"
    r"|\bthe paper\b"
    r"|\bthe authors of the paper\b"
    r"|\bcircle from the paper\b"
    r"|\bsolid circle\b"
    r"|\btest[0-9]\b"                    # fonctions test1, test2...
    r"|\bthe following (figure|lines|code snippet)\b",
    re.I,
)

JUSTIFICATION_MIN = 40   # caracteres : en dessous, MIT n'a pas explique
ENONCE_MIN = 50           # caracteres : en dessous, l'item est tronque

# Pour les items a reponse redigee (problemes d'examen) : il faut un
# enonce complet et une correction officielle developpee, sinon l'eleve
# n'a rien a apprendre.
ENONCE_SOLUTION_MIN = 60
JUSTIFICATION_SOLUTION_MIN = 120

PREFIXE_SOLUTION = "[MIT 6.858 — problème d’examen, en anglais] "
INDICE_SOLUTION = ("Problème d’examen du MIT : rédige ta réponse, puis la "
                   "correction officielle du MIT s’affiche.")


def nettoyer(texte):
    """Rend un texte PDF lisible : ligatures, espaces, pieds de page."""
    for avant, apres in LIGATURES.items():
        texte = texte.replace(avant, apres)
    texte = re.sub(r"[ \t]+", " ", texte)
    return texte.strip()


def lignes_utiles(chemin):
    with open(chemin, encoding="utf-8", errors="replace") as f:
        lignes = f.read().split("\n")
    return [l for l in lignes if not RE_PAGE.match(l) and not RE_ENTETE_PAGE.match(l)]


def contexte_avant(lignes, index):
    """Le paragraphe qui precede l'item : il donne souvent la question
    complete (« le systeme devient-il plus ou moins vulnerable ? »)."""
    j = index - 1
    while j >= 0 and not lignes[j].strip():
        j -= 1
    if j < 0:
        return ""
    fin = j
    while j >= 0 and lignes[j].strip():
        j -= 1
    paragraphe = " ".join(l.strip() for l in lignes[j + 1:fin + 1])
    if paragraphe.endswith("?") or "Circle the best answer" in paragraphe:
        return nettoyer(paragraphe)
    return ""


def lire_vrai_faux(lignes, i, parent):
    """Lit un item « A. True / False <enonce> » et son corrige."""
    n = len(lignes)
    m = RE_VRAI_FAUX.match(lignes[i])
    if not m:
        return None, i

    enonce = m.group(2).strip()
    i += 1
    while i < n:
        if RE_REPONSE.match(lignes[i]) or RE_VRAI_FAUX.match(lignes[i]) \
                or RE_ENTETE.match(lignes[i]) or RE_SECTION.match(lignes[i]):
            break
        enonce = (enonce + " " + lignes[i].strip()).strip()
        i += 1

    reponse = ""
    justification = []
    while i < n:
        mr = RE_REPONSE.match(lignes[i])
        if mr:
            reste = mr.group(1).strip()
            mm = re.match(r"^(True|False)\.?\s*(.*)$", reste, re.I)
            if mm:
                reponse = mm.group(1).capitalize()
                justification.append(mm.group(2))
            else:
                reponse = reste
            i += 1
            blancs = 0
            while i < n:
                if not lignes[i].strip():
                    blancs += 1
                    if blancs >= 2:
                        break
                    i += 1
                    continue
                if RE_REPONSE.match(lignes[i]) or RE_VRAI_FAUX.match(lignes[i]) \
                        or RE_ENTETE.match(lignes[i]) or RE_SECTION.match(lignes[i]) \
                        or RE_CHOIX.match(lignes[i]):
                    break
                blancs = 0
                justification.append(lignes[i].strip())
                i += 1
            break
        i += 1

    if reponse not in ("True", "False") or not enonce:
        return None, i

    if parent:
        enonce = parent + " — " + enonce

    return {
        "type": "vrai_faux",
        "enonce": enonce,
        "choix": ["True", "False"],
        "reponse": reponse,
        "justification": nettoyer(" ".join(justification)),
    }, i


def lire_choix(lignes, i, cadre):
    """Lit un item a choix multiples (« 4. [3 points]: ... A. ... B. ... »)."""
    n = len(lignes)
    choix = []
    while i < n:
        mc = RE_CHOIX.match(lignes[i])
        if not mc:
            break
        lettre = mc.group(1)
        texte = mc.group(2).strip()
        i += 1
        while i < n and not RE_CHOIX.match(lignes[i]) \
                and not RE_REPONSE.match(lignes[i]) \
                and not RE_ENTETE.match(lignes[i]) \
                and not RE_SECTION.match(lignes[i]):
            texte = (texte + " " + lignes[i].strip()).strip()
            i += 1
        choix.append((lettre, nettoyer(texte)))

    # Pas de choix : cet enonce n'est pas un item a choix (question ouverte).
    if len(choix) < 2:
        return None, i

    reponse = ""
    justification = []
    while i < n and not RE_ENTETE.match(lignes[i]):
        mr = RE_REPONSE.match(lignes[i])
        if mr:
            reste = mr.group(1).strip()
            mm = re.match(r"^([A-D])\.?\s*(.*)$", reste)
            if mm:
                reponse = mm.group(1)
                justification.append(mm.group(2))
            else:
                reponse = reste
            i += 1
            blancs = 0
            while i < n:
                if not lignes[i].strip():
                    blancs += 1
                    if blancs >= 2:
                        break
                    i += 1
                    continue
                if RE_REPONSE.match(lignes[i]) or RE_CHOIX.match(lignes[i]) \
                        or RE_ENTETE.match(lignes[i]) or RE_VRAI_FAUX.match(lignes[i]) \
                        or RE_SECTION.match(lignes[i]):
                    break
                if RE_ENTETE.match(lignes[i]):
                    break
                blancs = 0
                justification.append(lignes[i].strip())
                i += 1
            break
        i += 1

    if len(choix) < 2 or not reponse:
        return None, i

    return {
        "type": "choix",
        "enonce": cadre,
        "choix": [c[1] for c in choix],
        "lettres": [c[0] for c in choix],
        "reponse": reponse,
        "justification": nettoyer(" ".join(justification)),
    }, i


def lire_solution(lignes, corps, entete, contexte):
    """Lit un item dont la reponse est redigee (un vrai probleme d'examen).

    Dans les corriges du MIT, ces items se presentent ainsi :

        2. [5 points]: What are the verification states needed at (2)?
        Answer:
           - valid[EAX-0, EAX+256), from above.
           - valid[ECX-0, ECX+4), to satisfy the subsequent write ...

    L'enonce est la question du MIT ; la correction est la reponse
    officielle, ecrite par les enseignants. On ne reformule rien : la
    plateforme montre le probleme, l'eleve redige, puis la correction
    officielle s'affiche.
    """
    index = None

    for i, ligne in enumerate(corps):
        if RE_REPONSE.match(ligne):
            index = i
            break

    if index is None:
        return None

    reponse = RE_REPONSE.match(corps[index]).group(1).strip()
    justification = [reponse] if reponse else []
    justification.extend(l.strip() for l in corps[index + 1:] if l.strip())

    # L'enonce : la ligne d'en-tete du MIT, puis la suite du probleme
    # (le texte qui precede le « Answer: »), puis le contexte de la
    # section si l'en-tete seul ne suffit pas a comprendre.
    enonce = " ".join([entete.strip()] + [l.strip() for l in corps[:index] if l.strip()])

    if contexte:
        enonce = contexte + " — " + enonce

    return {
        "type": "solution",
        "enonce": enonce,
        "choix": [],
        "reponse": "",
        "justification": nettoyer(" ".join(justification)),
    }


def extraire_items(chemin):
    """Extrait les items (vrai/faux et choix multiples) d'un corrige officiel."""
    lignes = lignes_utiles(chemin)
    items = []
    i = 0
    n = len(lignes)
    contexte_courant = ""

    while i < n:
        ligne = lignes[i]

        # Un titre de section remet le contexte a zero.
        if RE_SECTION.match(ligne):
            contexte_courant = ""
            i += 1
            continue

        me = RE_ENTETE.match(ligne)
        if me:
            entete = me.group(3).strip()
            index_entete = i
            i += 1
            corps = []
            while i < n and not RE_CHOIX.match(lignes[i]) \
                    and not RE_VRAI_FAUX.match(lignes[i]) \
                    and not RE_ENTETE.match(lignes[i]) \
                    and not RE_SECTION.match(lignes[i]):
                corps.append(lignes[i].strip())
                i += 1

            parent = nettoyer(" ".join([entete] + corps))
            parent = re.sub(r"\(Circle True or False for each choice\.\)", "", parent).strip()
            parent = re.sub(r"Circle the best answer for each question\.?", "", parent).strip()
            parent = parent.strip(" .—-")

            if i < n and RE_VRAI_FAUX.match(lignes[i]):
                # Item vrai/faux : chacun herite de l'enonce parent.
                while i < n and RE_VRAI_FAUX.match(lignes[i]):
                    item, i = lire_vrai_faux(lignes, i, parent)
                    if item:
                        items.append(item)
                continue

            # Item a reponse redigee : le corrige officiel suit l'enonce
            # dans le meme bloc (ligne « Answer: » puis la correction).
            if any(RE_REPONSE.match(ligne) for ligne in corps):
                cadre = contexte_avant(lignes, index_entete)
                item = lire_solution(lignes, corps, entete, cadre)
                if item:
                    items.append(item)
                continue

            # Item a choix multiples : le cadre vient de la section.
            cadre = contexte_avant(lignes, index_entete)
            if cadre:
                contexte_courant = cadre
            cadre = contexte_courant
            item, i = lire_choix(lignes, i, cadre)
            if item:
                if item["enonce"]:
                    item["enonce"] = item["enonce"] + " — " + entete
                else:
                    item["enonce"] = entete
                items.append(item)
            continue

        if RE_VRAI_FAUX.match(ligne):
            item, i = lire_vrai_faux(lignes, i, "")
            if item:
                items.append(item)
            continue

        i += 1

    return items


# La repartition des questions importees ne se decide plus ici, mais dans
# tools/repartition-themes.py, a partir d'une MESURE du site
# (scripts/audit/probe-sections.php). Deux raisons :
#
#   - l'ancienne table CIBLES etait figee : elle datait d'une mesure
#     ancienne, et les questions de base de donnees ou d'algorithmes
#     atterrissaient dans « authentification » ;
#   - le moteur tire ses questions dans toute la SECTION d'une room :
#     c'est donc la section, et non la room, qui est l'unite de besoin.
#
# On importe ici le module pour que tous les extracteurs (celui-ci, celui
# des blocs, celui des sous-questions) repartissent de la meme maniere.
_repartition = None


def module_repartition():
    """Le module de repartition, charge une seule fois."""
    global _repartition

    if _repartition is None:
        import importlib.util

        chemin = os.path.join(
            os.path.dirname(os.path.abspath(__file__)), "repartition-themes.py"
        )
        specification = importlib.util.spec_from_file_location(
            "repartition_themes", chemin
        )
        module = importlib.util.module_from_spec(specification)
        specification.loader.exec_module(module)
        _repartition = module

    return _repartition


def repartir(questions, theme="cyber"):
    """Repartit les questions dans les rooms, d'apres la mesure du site.

    `theme` est le theme du cours d'origine : « cyber » pour 6.858, 6.828
    et 14.15J ; « donnees » pour 6.830 ; « algorithmes » pour 6.006 et
    6.046J ; « cpp » pour 1.124J ; « performance » pour 6.172.

    Le theme n'est pas devine d'apres les mots de la question : il est
    declare par l'appelant, qui sait de quel cours viennent les
    questions.
    """
    return module_repartition().repartir(questions, theme)


def construire_questions(items):
    """Transforme les items en questions de la plateforme.

    Trois filtres, tous justes par la regle de la maison : on n'importe que
    ce qui est complet et comprehensible.

      1. l'item doit se comprendre seul (pas de « Line 4 », pas de renvoi
         a une figure ou a un article) ;
      2. le corrige officiel doit expliquer la reponse : sans explication,
         l'eleve devinerait, et la plateforme promet l'inverse ;
      3. pas de doublon (les memes quizzes sont repris d'annee en annee).

    L'ordre des propositions est Melange de facon deterministe : c'est la
    regle de la plateforme (« jamais les memes questions dans le meme ordre »),
    et cela evite aussi que toutes les bonnes reponses importees tombent a la
    meme place.
    """
    questions = []
    position = 0
    vus = set()

    for item in items:
        enonce = item["enonce"].strip()
        justification = item["justification"].strip()

        if RE_INCOMPLET.search(enonce):
            continue
        if len(enonce) < ENONCE_MIN:
            continue
        if len(justification) < JUSTIFICATION_MIN:
            continue

        # La clef de doublon porte sur la fin de l'item (l'enonce propre) :
        # plusieurs items d'une meme section partagent le meme contexte.
        cle = re.sub(r"[^a-z0-9]+", " ", enonce.lower()).strip()[-100:]
        if cle in vus:
            continue
        vus.add(cle)

        if item["type"] == "solution":
            # Un probleme d'examen universitaire : l'eleve redige sa
            # reponse, la correction officielle lui est ensuite montree.
            if len(enonce) < ENONCE_SOLUTION_MIN:
                continue
            if len(justification) < JUSTIFICATION_SOLUTION_MIN:
                continue
            questions.append({
                "question": PREFIXE_SOLUTION + enonce,
                "mode": "solution",
                "xp": 20,
                "hint": INDICE_SOLUTION,
                "explanation": "Corrige officiel du MIT : " + justification,
                "source": ATTRIBUTION,
                "licence": LICENCE,
            })
            position += 1
            continue

        choix = list(item["choix"])

        index = None
        for i, proposition in enumerate(choix):
            if proposition.strip().lower() == item["reponse"].strip().lower():
                index = i
                break
        if index is None and item["type"] == "choix":
            for i, lettre in enumerate(item["lettres"]):
                if lettre == item["reponse"]:
                    index = i
                    break
        if index is None:
            continue

        # Rotation deterministe : la bonne reponse change de place.
        decalage = position % len(choix)
        if decalage:
            choix = choix[decalage:] + choix[:decalage]
            index = (index - decalage) % len(choix)

        questions.append({
            "question": PREFIXE + enonce,
            "mode": "choice",
            "choices": choix,
            "correct": index,
            "xp": 20,
            "hint": INDICE,
            "explanation": "Corrige officiel du MIT : " + justification,
            "source": ATTRIBUTION,
            "licence": LICENCE,
        })
        position += 1

    return questions


def main(argv=None):
    # Les constantes du module deviennent des reglages : le meme
    # extracteur sert pour 6.858, 6.828, 6.5660... (declaration globale
    # avant tout usage).
    global ATTRIBUTION, LICENCE, PREFIXE, PREFIXE_SOLUTION

    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--texte", required=True,
                            help="dossier contenant les fichiers .txt (pdftotext)")
    analyseur.add_argument("--sortie", required=True, help="lot JSON a ecrire")
    analyseur.add_argument("--source", default="mit-ocw-6858-examens",
                            help="identifiant de la source dans tools/sources-autorisees.json")
    analyseur.add_argument("--url", default="https://ocw.mit.edu/courses/6-858-computer-systems-security-fall-2014/pages/exams/",
                            help="page du cours sur MIT OpenCourseWare")
    analyseur.add_argument("--attribution", default=ATTRIBUTION,
                            help="mention affichee a l'eleve")
    analyseur.add_argument("--licence", default=LICENCE, help="licence annoncee")
    analyseur.add_argument("--prefixe", default=PREFIXE,
                            help="prefixe devant l'enonce (indique le cours et la langue)")
    analyseur.add_argument("--prefixe-solution", default=PREFIXE_SOLUTION,
                            help="prefixe devant un probleme redige")
    analyseur.add_argument("--tache", default="test",
                            help="tache de la room qui recoit les questions (test ou exam)")
    args = analyseur.parse_args(argv)

    ATTRIBUTION = args.attribution
    LICENCE = args.licence
    PREFIXE = args.prefixe
    PREFIXE_SOLUTION = args.prefixe_solution

    fichiers = sorted(f for f in os.listdir(args.texte) if f.endswith("_sol.txt"))
    if not fichiers:
        print("Aucun corrige (*_sol.txt) dans %s" % args.texte)
        return 1

    tous = []
    for nom in fichiers:
        items = extraire_items(os.path.join(args.texte, nom))
        tous.extend(items)
        print("  %-16s %2d item(s)" % (nom.replace("_sol.txt", ""), len(items)))

    questions = construire_questions(tous)
    print("Total : %d item(s) extraits, %d question(s) retenues."
          % (len(tous), len(questions)))

    # Repartition dans les rooms qui ont le reservoir le plus juste.
    par_room = repartir(questions)

    lot = {
        "source": args.source,
        "licence": LICENCE,
        "attribution": ATTRIBUTION,
        "url": args.url,
        "rooms": [
            {
                "room": slug,
                "title": slug,
                # « test » et non « exam » : les questions importees
                # grossissent le reservoir de la section (c'est ce qui rend
                # les copies distinctes) sans allonger l'epreuve elle-meme.
                "tasks": {args.tache: questions_room},
            }
            for slug, questions_room in sorted(par_room.items())
        ],
    }

    dossier = os.path.dirname(os.path.abspath(args.sortie))
    if dossier:
        os.makedirs(dossier, exist_ok=True)
    with open(args.sortie, "w", encoding="utf-8") as f:
        json.dump(lot, f, ensure_ascii=False, indent=2)

    print("")
    print("Repartition :")
    for slug, questions_room in sorted(par_room.items()):
        print("  %-52s %d question(s)" % (slug, len(questions_room)))
    print("")
    print("Lot ecrit : %s" % args.sortie)
    return 0


if __name__ == "__main__":
    sys.exit(main())
