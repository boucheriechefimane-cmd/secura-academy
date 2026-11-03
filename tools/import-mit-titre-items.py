# -*- coding: utf-8 -*-
"""Extrait les questions d'un examen MIT OCW presente en « titre + items ».

Pourquoi un sixieme extracteur : le MIT 6.006 « Introduction to
Algorithms » (Spring 2008) presente ses quiz ainsi :

    1        Asymptotic Notation
    Decide whether these statements are True or False. ...
        1. If f (n) = Θ(g(n)) and g(n) = Θ(h(n)), then h(n) = Θ(f (n))

         Solution:   True. Θ is transitive.

Autrement dit : un **titre de probleme** en colonne de gauche, un
preambule, puis des **items numerotes** en retrait, et — dans le corrige
officiel — un repere « Solution: » qui donne la reponse.

LE PRINCIPE, et ce qui garantit qu'aucune reponse n'est inventee :

1. l'enonce est decoupe en problemes (le titre en colonne 0) puis en
   items (les lignes en retrait qui commencent par « N. ») ;
2. le corrige est decoupe de la meme maniere ; chaque item du corrige
   porte un repere « Solution: » ;
3. les problemes sont apparies **par ordre**, mais chaque appariement est
   **verifie** : le titre doit etre le meme ;
4. les items sont apparies **par ordre dans le probleme**, et chaque
   appariement est **verifie** : les premiers mots de l'item doivent
   etre les memes dans l'enonce et dans le corrige. Si l'un des deux
   problemes n'a pas le meme nombre d'items, l'appariement est abandonne :
   c'est exactement le piege du MIT 6.046J SMA-5503, dont le corrige
   omet une sous-question ;
5. la reponse est **exactement** le texte qui suit le repere « Solution: ».

Ce qui n'est pas extractible est refuse : un item deforme par
l'extraction (le caractere de remplacement), un item qui depend d'un
schema absent, une reponse trop courte pour qu'on en apprenne quelque
chose. La reponse d'un item vrai/faux (« True. Θ is transitive. ») rend
une question a deux propositions — True et False — comme le corrige les
donne, et la justification devient l'explication.

Usage :
    python3 tools/import-mit-titre-items.py --texte dossier/ \
        --sortie lot.json --source id --url ... --attribution "..." \
        --prefixe "[MIT 6.006 — question d’examen, en anglais] "
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


# Le titre d'un probleme : un numero en colonne 0, puis le titre.
RE_TITRE = re.compile(r"^(\d{1,2})\s{2,}(\S.*)$")

# Un item : une ligne en retrait qui commence par « N. ».
RE_ITEM = re.compile(r"^\s{4,}(\d{1,2})\.\s+(\S.*)$")

# Le repere du corrige.
RE_SOLUTION = re.compile(r"^\s*Solution\s*:\s*(.*)$", re.I)

# Un item qui depend d'un support absent (schema, tableau, dessin).
RE_INCOMPLET = re.compile(
    r"\bthe figure\b"
    r"|\bthe diagram\b"
    r"|\bas shown (?:above|below)\b"
    r"|\bthe graph\b"
    r"|\bthe following\b"
    r"|\bthe table\b"
    r"|\bthe code below\b",
    re.I,
)

# Le caractere de remplacement : le PDF a perdu un symbole. Une reponse
# qui en contient est deformee : refus.
RE_DEFORME = re.compile("[�]")

# La longueur minimale de la reponse redigee (mode « solution »).
REPONSE_MIN = 80

# Les pieds de page de ces PDF : « 2   Handout 6: Quiz 1 Practice
# Problems », « Handout 14: Quiz 1 Solutions   3 ».
RE_PIED = re.compile(
    r"^\s*\d{0,3}\s+Handout\s+\d+"
    r"|^\s*Handout\s+\d+"
    r"|^\s*\d{0,3}\s+Introduction to Algorithms: 6\.006"
    r"|^\s*6\.006\s+(?:Introduction to Algorithms|Quiz)"
    r"|^\s*Quiz\s+\d+\s+Practice Problems\s*$",
    re.I,
)

RE_ENTETE = re.compile(r"ocw\.mit\.edu/terms", re.I)


def charger(chemin):
    """Renvoie les lignes utiles d'un texte extrait d'un PDF OCW."""
    with io.open(chemin, encoding="utf-8", errors="replace") as f:
        texte = f.read()
    lignes = texte.split("\n")
    for i, ligne in enumerate(lignes):
        if RE_ENTETE.search(ligne):
            lignes = lignes[i + 1:]
            break
    return [l.rstrip() for l in lignes if l.strip() and not RE_PIED.match(l)]


def normaliser(texte):
    """Ramene un texte a une seule ligne, sans espaces multiples."""
    return re.sub(r"\s+", " ", texte).strip()


def decouper(chemin):
    """Decoupe le fichier en problemes, puis en items.

    Renvoie une liste de dictionnaires :
    {titre, contexte, items: [{cle, lignes}]}.
    """
    lignes = charger(chemin)
    problemes = []
    courant = None
    item = None

    def fermer_item():
        nonlocal item
        if item is not None and courant is not None:
            courant["items"].append(item)
        item = None

    def fermer_probleme():
        nonlocal courant
        fermer_item()
        if courant is not None:
            problemes.append(courant)
        courant = None

    for ligne in lignes:
        m = RE_TITRE.match(ligne)
        if m and not ligne.startswith(" "):
            fermer_probleme()
            courant = {"titre": m.group(2).strip(), "contexte": [], "items": []}
            continue

        m = RE_ITEM.match(ligne)
        if m and courant is not None:
            fermer_item()
            item = {"cle": m.group(1), "lignes": [m.group(2).strip()]}
            continue

        if item is not None:
            item["lignes"].append(ligne.strip())
        elif courant is not None:
            courant["contexte"].append(ligne.strip())

    fermer_probleme()
    return problemes


def reponse_de(lignes):
    """Renvoie la reponse officielle d'un item du corrige, ou None."""
    for i, ligne in enumerate(lignes):
        m = RE_SOLUTION.match(ligne)
        if m:
            reponse = [m.group(1).strip()]
            for suite in lignes[i + 1:]:
                if RE_SOLUTION.match(suite):
                    break
                reponse.append(suite.strip())
            return normaliser(" ".join(reponse))
    return None


def premiers_mots(texte, n=12):
    return " ".join(texte.split()[:n]).lower()


def construire(chemin_examen, chemin_corrige, prefixe, attribution, licence, xp=20):
    """Apparie les items de l'enonce aux reponses du corrige officiel."""
    problemes_examen = decouper(chemin_examen)
    problemes_corrige = decouper(chemin_corrige)

    questions = []

    for index, probleme in enumerate(problemes_examen):
        if index >= len(problemes_corrige):
            break
        corrige = problemes_corrige[index]

        # Verification 1 : le titre doit etre le meme.
        if premiers_mots(probleme["titre"], 4) != premiers_mots(corrige["titre"], 4):
            continue

        # Verification 2 : le corrige doit avoir autant d'items.
        if len(probleme["items"]) != len(corrige["items"]):
            print("    probleme %d : le corrige a %d item(s) contre %d — appariement abandonne"
                  % (index + 1, len(corrige["items"]), len(probleme["items"])), file=sys.stderr)
            continue

        for position, item_examen in enumerate(probleme["items"]):
            item_corrige = corrige["items"][position]

            enonce_item = normaliser(" ".join(item_examen["lignes"]))
            enonce_corrige = normaliser(" ".join(item_corrige["lignes"]))

            # Verification 3 : les premiers mots doivent etre les memes.
            if premiers_mots(enonce_item) != premiers_mots(enonce_corrige):
                print("    item %s : l'enonce ne correspond pas — refuse" % item_examen["cle"],
                      file=sys.stderr)
                continue

            reponse = reponse_de(item_corrige["lignes"])
            if reponse is None:
                print("    item %s : pas de repere « Solution: » — refuse" % item_examen["cle"],
                      file=sys.stderr)
                continue

            if RE_DEFORME.search(enonce_item) or RE_DEFORME.search(reponse):
                print("    item %s : enonce ou reponse deforme(e) par l'extraction — refuse"
                      % item_examen["cle"], file=sys.stderr)
                continue
            if RE_INCOMPLET.search(enonce_item) or RE_INCOMPLET.search(reponse):
                print("    item %s : depend d'un schema absent — refuse" % item_examen["cle"],
                      file=sys.stderr)
                continue

            contexte = normaliser(" ".join(probleme["contexte"]))
            enonce = prefixe + probleme["titre"] + "\n" + contexte + "\n" + enonce_item

            # Une reponse vrai/faux devient une question a deux
            # propositions ; la justification devient l'explication.
            m = re.match(r"^(True|False)\b\.?\s*(.*)$", reponse)
            if m:
                question = {
                    "question": enonce,
                    "mode": "choice",
                    "choices": ["True", "False"],
                    "correct": 0 if m.group(1).lower() == "true" else 1,
                    "hint": "Question d’examen du MIT : vrai ou faux ? La correction officielle du MIT s’affiche après ta réponse.",
                    "explanation": "Corrigé officiel du MIT : " + (m.group(2).strip() or m.group(1)),
                    "source": attribution,
                    "licence": licence,
                    "xp": xp,
                }
            else:
                if len(reponse) < REPONSE_MIN:
                    print("    item %s : reponse trop courte — refuse" % item_examen["cle"],
                          file=sys.stderr)
                    continue
                question = {
                    "question": enonce,
                    "mode": "solution",
                    "hint": "Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.",
                    "explanation": "Corrigé officiel du MIT : " + reponse,
                    "source": attribution,
                    "licence": licence,
                    "xp": xp,
                }
            questions.append(question)

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

    suffixes = ("_sol.txt", "-solutions.txt", "_solutions.txt", "_answers.txt", "_soln.txt")
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
