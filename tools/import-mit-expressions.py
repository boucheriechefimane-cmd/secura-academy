#!/usr/bin/env python3
"""Quatorzieme extracteur MIT : l'enonce et le corrige, ligne par ligne.

Pourquoi un quatorzieme extracteur
----------------------------------
Le MIT 6.111 « Introductory Digital Systems Laboratory » (Spring 2006) publie
un exercise d'algebre booleenne ou l'enonce et le corrige sont **alignes
ligne par ligne** :

    l'enonce :                      le corrige :
       1) a + 0 =                     1) a + 0 = a
       5) a + ab =                    5) a + ab = a (1 + b) = a

C'est le seul format ou l'on puisse **verifier** l'appariement sans
ambiguite : le membre de gauche est identique des deux cotes. Le membre de
droite du corrige est la reponse officielle.

On en fait une question de la plateforme : l'eleve voit l'expression (le
membre de gauche, mot pour mot) et l'expression a trouver ; la reponse
affichee est la correction du MIT, telle qu'il l'a ecrite — jamais une
reponse inventee, jamais une expression reecrite.

Les details qui comptent :
- l'appariement se fait par le **numero**, et le membre de gauche doit
  etre **rigoureusement le meme** des deux cotes (comparaison apres
  normalisation des espaces) ; sinon la question est refusee ;
- une ligne de contexte (« For (11), (12), (13), f (a, b, c) = a + b + c »)
  est ajoutee aux items qu'elle concerne ;
- l'instruction du MIT (« Simplify each expression by algebraic
  manipulation ») est reprise mot pour mot ;
- une reponse trop courte, ou une ligne qui n'est pas une expression
  (une phrase, un schema), est refusee.

Usage :
    python3 tools/import-mit-expressions.py --texte dossier/ \
        --sortie lot.json --source id --url ... --attribution "..." \
        --prefixe "[MIT — question d’examen, en anglais] " --theme THEME
"""

import argparse
import importlib.util
import io
import json
import os
import re
import sys

# L'appariement enonce <-> corrige : le hash de ressource d'OCW differe
# d'un fichier a l'autre, un appariement par nom exact ne trouve donc
# rien. Le module fait les deux : exact d'abord, puis sans le hash.
sys.path.insert(0, os.path.dirname(os.path.abspath(__file__)))
from ocw_appariement import apparier  # noqa: E402


LICENCE = "CC BY-NC-SA 4.0"
XP = 20

HINT = ("Question d’exercice du MIT : rédige ta réponse, puis la correction "
        "officielle du MIT s’affiche.")

# Une ligne d'expression : « 12) a + ab = » ou « 12) a + ab = a + b ».
RE_EXPRESSION = re.compile(r"^\s{0,20}(\d{1,3})\)\s*(.+?)\s*=\s*(.*)$")

# Une ligne de contexte pour plusieurs items : « For (11), (12), (13), ... ».
RE_CONTEXTE = re.compile(r"^\s{0,20}For\s*\(([^)]*)\)\s*,?\s*(.+)$", re.I)

# L'instruction donnee par le MIT.
RE_INSTRUCTION = re.compile(
    r"(Simplify each expression[^\n]*)"
    r"|(Determine whether[^\n]*)"
    r"|(Reduce[^\n]*)",
    re.I,
)

# Ce qui n'est pas une expression booleenne : une phrase, un schema.
RE_PAS_EXPRESSION = re.compile(
    r"\bthe figure\b|\bthe diagram\b|\bas shown\b|\bthe table\b|"
    r"\bthe following\b|\bthe code\b|\bsee figure\b|\bthe graph\b",
    re.I,
)

RE_DEFORME = re.compile("[�]")

# Une expression est courte si elle ne contient ni lettre ni chiffre.
RE_NON_EXPRESSION = re.compile(r"^[^A-Za-z0-9]+$")


def normaliser(expression):
    """L'expression, sans les espaces : deux membres de gauche egaux
    doivent l'etre une fois la mise en page du PDF corrigee."""
    return re.sub(r"\s+", "", expression)


def lignes_expressions(texte):
    """Les lignes d'expression du texte : {numero: (gauche, droite, ligne)}."""
    trouvees = {}
    for ligne in texte.split('\n'):
        m = RE_EXPRESSION.match(ligne)
        if not m:
            continue
        numero = m.group(1)
        gauche = m.group(2).strip()
        droite = m.group(3).strip()
        # Un numero deja vu : on garde la premiere occurrence (l'enonce
        # se repete parfois dans les rappels).
        if numero in trouvees:
            continue
        trouvees[numero] = (gauche, droite, ligne)
    return trouvees


def contextes(texte):
    """Les contextes partages : {numero: texte}."""
    resultat = {}
    for ligne in texte.split('\n'):
        m = RE_CONTEXTE.match(ligne)
        if not m:
            continue
        numeros = re.findall(r"\d+", m.group(1))
        for numero in numeros:
            resultat[numero] = m.group(2).strip()
    return resultat


def instruction(texte):
    """L'instruction du MIT, reprise mot pour mot."""
    for ligne in texte.split('\n'):
        m = RE_INSTRUCTION.search(ligne)
        if m:
            return (m.group(1) or m.group(2) or m.group(3)).strip()
    return ""


def construire(enonce_path, corrige_path, prefixe, attribution, licence, xp):
    questions = []
    refus = []

    texte_enonce = io.open(enonce_path, encoding='utf-8', errors='ignore').read()
    texte_corrige = io.open(corrige_path, encoding='utf-8', errors='ignore').read()

    items_enonce = lignes_expressions(texte_enonce)
    items_corrige = lignes_expressions(texte_corrige)
    partages = contextes(texte_enonce)
    consigne = instruction(texte_enonce)

    # Deux items de MEME membre de gauche mais de reponses differentes :
    # c'est le signe d'un symbole perdu a l'extraction (la barre de
    # complement, par exemple : « a + a' = 1 » et « a + a = a » ont le
    # meme membre de gauche une fois la barre disparue). On refuse les
    # deux plutot que de publier une question fausse.
    memes_gauchs = {}
    for numero, (gauche, droite, _) in items_corrige.items():
        cle = normaliser(gauche)
        memes_gauchs.setdefault(cle, []).append(numero)
    ambigus = set()
    for numeros in memes_gauchs.values():
        reponses = set()
        for numero in numeros:
            if numero in items_corrige:
                reponses.add(items_corrige[numero][1])
        if len(numeros) > 1 and len(reponses) > 1:
            ambigus.update(numeros)

    for numero in sorted(items_enonce, key=lambda n: int(n)):
        if numero in ambigus:
            refus.append((numero, "-", "un symbole a ete perdu a l'extraction : "
                         "le membre de gauche est identique a celui d'un autre "
                         "item, mais la reponse differe"))
            continue
        if numero not in items_corrige:
            refus.append((numero, "-", "pas de corrige pour cet item"))
            continue
        gauche_enonce, droite_enonce, _ = items_enonce[numero]
        gauche_corrige, droite_corrige, _ = items_corrige[numero]

        if normaliser(gauche_enonce) != normaliser(gauche_corrige):
            refus.append((numero, "-", "les membres de gauche different : "
                         "appariement refuse"))
            continue
        if not droite_corrige:
            refus.append((numero, "-", "le corrige ne donne pas de reponse"))
            continue
        if RE_DEFORME.search(gauche_corrige) or RE_DEFORME.search(droite_corrige):
            refus.append((numero, "-", "expression deformee par l'extraction"))
            continue
        if RE_PAS_EXPRESSION.search(gauche_corrige):
            refus.append((numero, "-", "l'item depend d'un schema absent"))
            continue
        if RE_NON_EXPRESSION.match(droite_corrige):
            refus.append((numero, "-", "la reponse n'est pas une expression"))
            continue
        if len(droite_corrige) < 1:
            refus.append((numero, "-", "reponse vide"))
            continue

        enonce = "%s = " % gauche_enonce
        if numero in partages:
            enonce = "%s\n%s = " % (partages[numero], gauche_enonce)
        if consigne:
            enonce = "%s\n%s" % (consigne, enonce)

        questions.append({
            "question": "%s\n%s" % (prefixe, enonce),
            "mode": "solution",
            "hint": HINT,
            "xp": xp,
            "explanation": "Corrigé officiel du MIT : %s = %s" % (
                gauche_corrige, droite_corrige),
            "source": attribution,
            "licence": licence,
            "attribution": attribution,
        })

    return questions, refus


def module_repartition():
    """Charge tools/repartition-themes.py (nom avec tirets : pas importable
    directement)."""
    chemin = os.path.join(os.path.dirname(os.path.abspath(__file__)),
                          "repartition-themes.py")
    spec = importlib.util.spec_from_file_location("repartition_themes", chemin)
    module = importlib.util.module_from_spec(spec)
    spec.loader.exec_module(module)
    return module


def repartir(questions, theme):
    """Pose les questions dans les rooms reelles, d'apres une MESURE du
    site (tools/cibles-sections.json) — jamais d'apres une liste figee."""
    try:
        return module_repartition().repartir(questions, theme)
    except Exception as exc:  # pragma: no cover - depend du site mesure
        print("Repartition impossible (%s) : le lot n'est pas ecrit." % exc,
              file=sys.stderr)
        return None


def main(argv=None):
    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--texte", required=True, help="dossier des .txt (pdftotext)")
    analyseur.add_argument("--sortie", required=True, help="lot JSON a ecrire")
    analyseur.add_argument("--source", required=True)
    analyseur.add_argument("--url", required=True)
    analyseur.add_argument("--attribution", required=True)
    analyseur.add_argument("--licence", default=LICENCE)
    analyseur.add_argument("--prefixe", required=True)
    analyseur.add_argument("--theme", default="cyber",
                           help="theme du cours d'origine : cyber, donnees, "
                                "algorithmes, cpp, performance, compilation, langage")
    analyseur.add_argument("--xp", type=int, default=XP)
    args = analyseur.parse_args(argv)

    questions = []
    vues = set()

    for nom in sorted(os.listdir(args.texte)):
        if not nom.endswith(".txt"):
            continue
        corrige = apparier(nom, args.texte)
        if corrige is None:
            continue
        lot, refus = construire(
            os.path.join(args.texte, nom),
            corrige,
            args.prefixe,
            args.attribution,
            args.licence,
            args.xp,
        )
        retenues = 0
        for question in lot:
            corps = question["question"]
            if args.prefixe and corps.startswith(args.prefixe):
                corps = corps[len(args.prefixe):]
            clef = "%s||%s" % (corps[:220], question.get("explanation", "")[:80])
            if clef in vues:
                continue
            vues.add(clef)
            questions.append(question)
            retenues += 1
        if retenues:
            print("  %-40s %2d question(s)" % (nom[:40], retenues))
        for numero, lettre, motif in refus:
            print("     %s (%s) refuse : %s" % (numero, lettre, motif), file=sys.stderr)

    if not questions:
        print("Aucune question retenue : rien n'est importe (on ne devine jamais).")
        return 1

    par_room = repartir(questions, args.theme)
    if not par_room:
        return 1

    rooms = []
    for slug, quest in sorted(par_room.items()):
        rooms.append({
            "room": slug,
            "title": slug,
            "tasks": {"test": quest},
        })

    lot = {
        "source": args.source,
        "licence": args.licence,
        "attribution": args.attribution,
        "url": args.url,
        "rooms": rooms,
    }
    with io.open(args.sortie, "w", encoding="utf-8") as f:
        f.write(json.dumps(lot, ensure_ascii=False, indent=2))
    print("Total : %d question(s) avec corrige officiel." % len(questions))
    print("Lot ecrit : %s" % args.sortie)
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
