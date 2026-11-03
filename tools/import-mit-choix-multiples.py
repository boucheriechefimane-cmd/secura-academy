# -*- coding: utf-8 -*-
"""Extrait les questions d'un examen MIT OCW a choix multiples.

Pourquoi un septieme extracteur : le MIT 6.005 « Software Construction »
(Spring 2016) presente ses quiz ainsi :

    Problem 1 (Multiple Choice) (20 points).

     (a) Which of the following must be true of an underdetermined
         function specification? (choose all that apply)

        A. An underdetermined spec means the implementation is unwritten.
        B. An underdetermined spec means the implementation is nondeterministic.
        C. An underdetermined spec allows multiple valid outputs for some input.
        D. An underdetermined spec allows multiple valid inputs that give
           some output.

Et son corrige officiel reprend l'enonce, options comprises, puis ajoute :

    Solution. C. None of the other options must be true.

LE PRINCIPE, et ce qui garantit qu'aucune reponse n'est inventee :

1. l'enonce est decoupe en problemes (« Problem N ... ») puis en parties
   (« (a) ... ») ; chaque partie porte ses options (« A. ... », « B. ... »)
   ;
2. le corrige est decoupe de la meme maniere ; chaque partie y porte un
   repere « Solution. » ;
3. les problemes sont apparies **par ordre**, avec une **verification** :
   meme titre, et surtout **le meme nombre de parties** des deux cotes ;
4. les parties sont apparies **par ordre dans le probleme**, avec une
   **verification** : les premiers mots de la partie doivent etre les
   memes dans l'enonce et dans le corrige ;
5. la reponse est **exactement** ce qui suit le repere « Solution. ».

Trois sorties possibles :

- la partie a des options et le corrige nomme **une seule** lettre : la
  question devient une question a choix, avec **les options d'origine**
  (lettre et texte), et la justification du MIT devient l'explication ;
- la partie n'a pas d'option (une question redigee) : la question reste
  une redaction, et la correction officielle du MIT est l'explication ;
- la partie a des options mais le corrige en nomme **plusieurs**
  (« Solution. A, C, D. ») : la question est **refusee**. La plateforme
  n'a qu'une seule bonne reponse par question ; en garder une
  parmi plusieurs serait en inventer une.

Usage :
    python3 tools/import-mit-choix-multiples.py --texte dossier/ \
        --sortie lot.json --source id --url ... --attribution "..." \
        --prefixe "[MIT 6.005 — question d’examen, en anglais] "
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


# Un probleme : « Problem 1 (Multiple Choice) (20 points). »
RE_PROBLEME = re.compile(r"^\s*Problem\s+(\d+)\s*[.:]?\s*(.*)$")

# Une partie : « (a) enonce »
RE_PARTIE = re.compile(r"^\s*\(([a-z])\)\s+(\S.*)$")

# Une option : « A. texte »
RE_OPTION = re.compile(r"^\s*([A-Z])\.\s+(\S.*)$")

# Le repere du corrige : « Solution. C. None of the other options... »
RE_SOLUTION = re.compile(r"^\s*Solution\s*\.\s*(.*)$", re.I)

# Un enonce qui depend d'un support absent (schema, tableau, dessin).
RE_INCOMPLET = re.compile(
    r"\bthe figure\b"
    r"|\bthe diagram\b"
    r"|\bas shown (?:above|below)\b"
    r"|\bthe graph\b"
    r"|\bthe following\b"
    r"|\bthe table\b"
    r"|\bthe code below\b"
    r"|\bthe next page\b",
    re.I,
)

# Le caractere de remplacement : le PDF a perdu un symbole.
RE_DEFORME = re.compile("[�]")

# La longueur minimale de la reponse redigee (mode « solution »).
REPONSE_MIN = 80

# Les pieds de page et les en-tetes de ces PDF.
RE_PIED = re.compile(
    r"^\s*Solutions? to Quiz \d+.*$"
    r"|^\s*6\.005\s+Software Construction.*$"
    r"|^\s*Quiz \d+\s*$"
    r"|^\s*Name\s*:\s*_*\s*$"
    r"|^\s*\d{1,2}\s*$",
    re.I,
)

RE_ENTETE = re.compile(r"ocw\.mit\.edu/terms", re.I)


def charger(chemin):
    """Renvoie les lignes utiles d'un texte extrait d'un PDF OCW."""
    with io.open(chemin, encoding="utf-8", errors="replace") as f:
        texte = f.read()
    lignes = texte.split("\n")
    # L'en-tete OCW (la citation) est en fin de fichier : on le coupe
    # partout ou il apparait.
    for i, ligne in enumerate(lignes):
        if RE_ENTETE.search(ligne):
            lignes = lignes[:i]
            break
    return [l.rstrip() for l in lignes if l.strip() and not RE_PIED.match(l)]


def normaliser(texte):
    return re.sub(r"\s+", " ", texte).strip()


def decouper(chemin):
    """Decoupe le fichier en problemes, puis en parties.

    Renvoie [{titre, contexte, parties: [{cle, lignes}]}].
    """
    lignes = charger(chemin)
    problemes = []
    courant = None
    partie = None

    def fermer_partie():
        nonlocal partie
        if partie is not None and courant is not None:
            courant["parties"].append(partie)
        partie = None

    def fermer_probleme():
        nonlocal courant
        fermer_partie()
        if courant is not None:
            problemes.append(courant)
        courant = None

    for ligne in lignes:
        m = RE_PROBLEME.match(ligne)
        if m and not ligne.startswith(" "):
            fermer_probleme()
            courant = {"titre": m.group(2).strip(), "contexte": [], "parties": []}
            continue

        m = RE_PARTIE.match(ligne)
        if m and courant is not None:
            fermer_partie()
            partie = {"cle": m.group(1), "lignes": [m.group(2).strip()]}
            continue

        if partie is not None:
            partie["lignes"].append(ligne.strip())
        elif courant is not None:
            courant["contexte"].append(ligne.strip())

    fermer_probleme()
    return problemes


def options_de(lignes):
    """Separe l'enonce d'une partie et ses options.

    Renvoie (lignes_enonce, [(lettre, texte), ...]).
    """
    options = []
    for ligne in lignes:
        m = RE_OPTION.match(ligne)
        if m:
            options.append((m.group(1), m.group(2).strip()))
        elif not options:
            continue
        else:
            # Une ligne qui n'est pas une option, apres le debut des
            # options : on l'ajoute a la derniere option (une option peut
            # tenir sur plusieurs lignes).
            if options:
                options[-1] = (options[-1][0], options[-1][1] + " " + ligne.strip())
    return options


def separe_reponse(lignes):
    """Separe la partie du corrige en (avant, reponse, apres).

    Le repere « Solution. » coupe la partie : ce qui precede est
    l'enonce et ses options, ce qui suit est la justification. Sans
    cette separation, la ligne « Solution. » serait avalee par la
    derniere option — et la reponse deviendrait introuvable.
    """
    for i, ligne in enumerate(lignes):
        m = RE_SOLUTION.match(ligne)
        if m:
            morceaux = [m.group(1).strip()]
            for suite in lignes[i + 1:]:
                morceaux.append(suite.strip())
            return lignes[:i], normaliser(" ".join(morceaux))
    return lignes, None


def premiers_mots(texte, n=12):
    return " ".join(texte.split()[:n]).lower()


def construire(chemin_examen, chemin_corrige, prefixe, attribution, licence, xp=20):
    """Apparie les parties de l'enonce aux reponses du corrige officiel."""
    problemes_examen = decouper(chemin_examen)
    problemes_corrige = decouper(chemin_corrige)

    questions = []

    for index, probleme in enumerate(problemes_examen):
        if index >= len(problemes_corrige):
            break
        corrige = problemes_corrige[index]

        if premiers_mots(probleme["titre"], 3) != premiers_mots(corrige["titre"], 3):
            continue
        if len(probleme["parties"]) != len(corrige["parties"]):
            print("    probleme %d : %d partie(s) dans l'enonce, %d dans le corrige — abandonne"
                  % (index + 1, len(probleme["parties"]), len(corrige["parties"])), file=sys.stderr)
            continue

        for position, partie_examen in enumerate(probleme["parties"]):
            partie_corrige = corrige["parties"][position]

            enonce_examen = normaliser(" ".join(partie_examen["lignes"]))
            enonce_corrige = normaliser(" ".join(partie_corrige["lignes"]))

            if premiers_mots(enonce_examen) != premiers_mots(enonce_corrige):
                print("    partie %s : l'enonce ne correspond pas — refusee" % partie_examen["cle"],
                      file=sys.stderr)
                continue

            lignes_corrige, reponse = separe_reponse(partie_corrige["lignes"])
            if reponse is None:
                print("    partie %s : pas de repere « Solution. » — refusee" % partie_examen["cle"],
                      file=sys.stderr)
                continue

            if RE_DEFORME.search(enonce_examen) or RE_DEFORME.search(reponse):
                print("    partie %s : enonce ou reponse deforme(e) — refusee" % partie_examen["cle"],
                      file=sys.stderr)
                continue
            if RE_INCOMPLET.search(enonce_examen) or RE_INCOMPLET.search(reponse):
                print("    partie %s : depend d'un schema absent — refusee" % partie_examen["cle"],
                      file=sys.stderr)
                continue

            # L'enonce de la partie, sans les options.
            lignes_sans_options = []
            for ligne in partie_examen["lignes"]:
                if RE_OPTION.match(ligne):
                    break
                lignes_sans_options.append(ligne)
            enonce = normaliser(" ".join(lignes_sans_options))

            options_examen = options_de(partie_examen["lignes"])
            options_corrige = options_de(lignes_corrige)

            contexte = normaliser(" ".join(probleme["contexte"]))
            texte_question = prefixe + (probleme["titre"] + "\n" if probleme["titre"] else "")
            if contexte:
                texte_question += contexte + "\n"
            texte_question += enonce

            if len(options_examen) >= 2:
                # Les options d'origine, avec leur lettre : la correction
                # officielle parle de la lettre (« Solution. C. »), donc
                # la lettre doit rester visible.
                lettres = [lettre for lettre, _ in options_examen]
                if lettres != [chr(ord("A") + i) for i in range(len(lettres))]:
                    print("    partie %s : options numerotees a trous — refusee" % partie_examen["cle"],
                          file=sys.stderr)
                    continue
                if [l for l, _ in options_corrige] != lettres:
                    print("    partie %s : les options du corrige ne correspondent pas — refusee"
                          % partie_examen["cle"], file=sys.stderr)
                    continue

                m = re.match(r"^([A-Z])(\s*[,;]\s*[A-Z])*\.", reponse)
                if not m:
                    print("    partie %s : la reponse ne nomme pas une option — refusee"
                          % partie_examen["cle"], file=sys.stderr)
                    continue
                trouvees = re.findall(r"\b([A-Z])\b", reponse.split(".")[0])
                if len(trouvees) != 1:
                    print("    partie %s : la reponse en nomme %d — une seule est admise, refusee"
                          % (partie_examen["cle"], len(trouvees)), file=sys.stderr)
                    continue
                lettre = trouvees[0]
                if lettre not in lettres:
                    print("    partie %s : la reponse (%s) n'est pas une option — refusee"
                          % (partie_examen["cle"], lettre), file=sys.stderr)
                    continue
                justification = reponse.split(".", 1)[1].strip() if "." in reponse else ""
                if not justification:
                    justification = "Reponse officielle du MIT : " + lettre + "."
                questions.append({
                    "question": texte_question,
                    "mode": "choice",
                    "choices": ["%s. %s" % (l, t) for l, t in options_examen],
                    "correct": lettres.index(lettre),
                    "hint": "Question d’examen du MIT : choisis la bonne proposition ; la correction officielle du MIT s’affiche après ta réponse.",
                    "explanation": "Corrigé officiel du MIT : " + justification,
                    "source": attribution,
                    "licence": licence,
                    "xp": xp,
                })
            else:
                if len(reponse) < REPONSE_MIN:
                    print("    partie %s : reponse trop courte — refusee" % partie_examen["cle"],
                          file=sys.stderr)
                    continue
                questions.append({
                    "question": texte_question,
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
