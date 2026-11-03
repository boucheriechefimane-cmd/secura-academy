# -*- coding: utf-8 -*-
"""Extrait les questions d'un examen MIT OCW presente en « choix multiples ».

Pourquoi un septieme extracteur : le MIT 6.005 « Software Construction »
(Spring 2016) presente ses quiz ainsi :

    Problem 1 (Multiple Choice) (20 points).
     (a) Which of the following must be true of an underdetermined
         function specification? (choose all that apply)
         A. An underdetermined spec means the implementation is unwritten.
         B. An underdetermined spec means the implementation is nondeterministic.
     Solution. C. None of the other options must be true.

Chaque probleme a des sous-questions (a), (b)... ; les sous-questions a
choix portent leurs propositions lettrees (A., B., C....) ; le corrige
officiel pose un repere « Solution. » suivi de la ou des bonnes
reponses, puis de la justification des enseignants du MIT.

Les autres problemes du meme quiz sont des questions redigees, et leur
corrige donne la reponse complete du MIT.

LE PRINCIPE, et ce qui garantit qu'aucune reponse n'est inventee :

1. l'enonce et le corrige sont decoupes de la meme facon : en problemes
   (« Problem N »), puis en sous-questions (« (a) ») ;
2. les problemes sont apparies **par ordre**, avec verification du
   titre ; les sous-questions sont apparies **par ordre dans le
   probleme**, avec verification des **premiers mots** de l'enonce ;
3. la reponse est **exactement** ce qui suit le repere « Solution. » ;
4. quand la sous-question a des propositions, les propositions viennent
   de l'enonce, et les bonnes lettres de la reponse officielle. Une
   sous-question a plusieurs bonnes reponses (« choose all that
   apply ») devient une question redigee : la plateforme ne note pas
   une reponse multiple, et on ne transforme pas une question en
   autre chose.

Ce qui n'est pas extractible est refuse : une reponse vide, une
reponse deformee par l'extraction, une question qui depend d'un schema
absent (« on the next page »), une sous-question dont les propositions
ne sont pas les memes dans l'enonce et dans le corrige.

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


# « Problem 1 (Multiple Choice) (20 points). »
RE_PROBLEME = re.compile(r"^\s*Problem\s+(\d+)\s*(.*)$")

# Une sous-question : « (a) texte »
RE_PARTIE = re.compile(r"^\s*\(([a-z])\)\s+(.*)$")

# Une proposition : « A. texte »
RE_OPTION = re.compile(r"^\s*([A-Z])\.\s+(.*)$")

# Le repere du corrige : « Solution. C. None of the other options... »
RE_SOLUTION = re.compile(r"^\s*Solution\.\s*(.*)$")

# Une question qui depend d'un support absent (schema, tableau, dessin,
# page suivante du document).
RE_INCOMPLET = re.compile(
    r"\bthe figure\b"
    r"|\bthe diagram\b"
    r"|\bas shown (?:above|below)\b"
    r"|\bthe graph\b"
    r"|\bthe following\b"
    r"|\bthe table\b"
    r"|\bthe next page\b"
    r"|\bthe code below\b"
    r"|\bon the next\b",
    re.I,
)

# Le caractere de remplacement : le PDF a perdu un symbole.
RE_DEFORME = re.compile("[�]")

# La longueur minimale d'une reponse redigee (mode « solution »).
REPONSE_MIN = 80

# Les pieds de page et les en-tetes de ces PDF.
RE_PIED = re.compile(
    r"^\s*\d{0,3}\s+MIT\s+6\.005"
    r"|^\s*MIT\s+6\.005"
    r"|^\s*\d{0,3}\s+Software Construction"
    r"|^\s*6\.005\s+Software Construction"
    r"|^\s*Quiz\s+\d+",
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
            lignes = lignes[:i]
            break
    nettoyees = []
    for ligne in lignes:
        ligne = ligne.rstrip()
        # Un pied de page peut etre colle en fin de ligne
        # (« … voteCounts[0] MIT OpenCourseWare https://ocw.mit.edu Spring 2016 »).
        for motif in ("MIT OpenCourseWare", "Solutions to Quiz", "Quiz 1 of 2", "Quiz 2 of 2"):
            coupe = ligne.find(motif)
            if coupe > 0:
                ligne = ligne[:coupe].rstrip()
        if ligne.strip() and not RE_PIED.match(ligne):
            nettoyees.append(ligne)
    return nettoyees


def normaliser(texte):
    """Ramene un texte a une seule ligne, sans espaces multiples."""
    return re.sub(r"\s+", " ", texte).strip()


def decouper(chemin):
    """Decoupe le fichier en problemes, puis en sous-questions.

    Renvoie une liste de dictionnaires :
    {numero, titre, parties: [{cle, lignes}]}.
    """
    lignes = charger(chemin)
    problemes = []
    probleme = None
    partie = None

    def fermer_partie():
        nonlocal partie
        if partie is not None and probleme is not None:
            probleme["parties"].append(partie)
        partie = None

    def fermer_probleme():
        nonlocal probleme
        fermer_partie()
        if probleme is not None:
            problemes.append(probleme)
        probleme = None

    for ligne in lignes:
        m = RE_PROBLEME.match(ligne)
        if m:
            fermer_probleme()
            probleme = {"numero": m.group(1), "titre": m.group(2).strip(), "parties": []}
            continue

        m = RE_PARTIE.match(ligne)
        if m and probleme is not None:
            fermer_partie()
            partie = {"cle": m.group(1), "lignes": [m.group(2).strip()]}
            continue

        if partie is not None:
            partie["lignes"].append(ligne.strip())
        elif probleme is not None:
            # Le texte qui precede la premiere sous-question (le
            # consigne du probleme) fait partie du probleme.
            probleme.setdefault("preambule", []).append(ligne.strip())

    fermer_probleme()
    return problemes


def separating_options(lignes):
    """Separe le texte de la question de ses propositions.

    Renvoie (texte, propositions) ou (None, None) si la ligne contient
    une proposition : le texte est alors les lignes d'avant, les
    propositions sont les lignes qui commencent par « A. », « B. »...
    """
    texte = []
    options = []
    for ligne in lignes:
        if RE_SOLUTION.match(ligne):
            # Le repere du corrige n'est pas la suite d'une proposition :
            # il commence la reponse.
            break
        if RE_OPTION.match(ligne):
            options.append(ligne)
        elif options:
            # La suite d'une proposition (une ligne qui ne commence pas
            # par une lettre) prolonge la proposition precedente.
            options[-1] = options[-1] + " " + ligne.strip()
        else:
            texte.append(ligne)
    return texte, options


def reponse_officielle(lignes):
    """Renvoie (lettres, justification) lues apres le repere « Solution. »."""
    for i, ligne in enumerate(lignes):
        m = RE_SOLUTION.match(ligne)
        if not m:
            continue
        brut = m.group(1).strip()
        suite = []
        for suivante in lignes[i + 1:]:
            if RE_SOLUTION.match(suivante) or RE_OPTION.match(suivante):
                break
            suite.append(suivante.strip())
        texte = normaliser(" ".join([brut] + suite))
        # Les bonnes reponses sont les lettres en debut : « C. », « A, D. »
        m2 = re.match(r"^([A-Z](?:\s*,\s*[A-Z])*)\.\s*(.*)$", texte)
        if not m2:
            return [], texte
        lettres = [l.strip() for l in m2.group(1).split(",") if l.strip()]
        return lettres, normaliser(m2.group(2))
    return None, None


def premiers_mots(texte, n=12):
    return " ".join(texte.split()[:n]).lower()


def construire(chemin_examen, chemin_corrige, prefixe, attribution, licence, xp=20):
    """Apparie les sous-questions de l'enonce aux reponses du corrige."""
    problemes_examen = decouper(chemin_examen)
    problemes_corrige = decouper(chemin_corrige)

    questions = []

    for index, probleme in enumerate(problemes_examen):
        if index >= len(problemes_corrige):
            break
        corrige = problemes_corrige[index]

        # Verification 1 : meme numero de probleme, meme titre.
        if probleme["numero"] != corrige["numero"]:
            continue
        if normaliser(probleme["titre"])[:40] != normaliser(corrige["titre"])[:40]:
            continue

        # Verification 2 : le corrige doit avoir autant de sous-questions.
        if len(probleme["parties"]) != len(corrige["parties"]):
            print("    probleme %s : le corrige a %d sous-question(s) contre %d — abandonne"
                  % (probleme["numero"], len(corrige["parties"]), len(probleme["parties"])),
                  file=sys.stderr)
            continue

        for position, partie_examen in enumerate(probleme["parties"]):
            partie_corrige = corrige["parties"][position]

            texte_examen, options_examen = separating_options(partie_examen["lignes"])
            texte_corrige, options_corrige = separating_options(partie_corrige["lignes"])

            enonce = normaliser(" ".join(texte_examen))
            enonce_corrige = normaliser(" ".join(texte_corrige))

            # Verification 3 : les premiers mots doivent etre les memes.
            if premiers_mots(enonce) != premiers_mots(enonce_corrige):
                print("    sous-question %s : l'enonce ne correspond pas — refusee"
                      % partie_examen["cle"], file=sys.stderr)
                continue

            # Verification 4 : les propositions doivent etre les memes.
            if len(options_examen) != len(options_corrige):
                print("    sous-question %s : les propositions ne correspondent pas — refusee"
                      % partie_examen["cle"], file=sys.stderr)
                continue
            options_ok = True
            for o_examen, o_corrige in zip(options_examen, options_corrige):
                if premiers_mots(o_examen, 6) != premiers_mots(o_corrige, 6):
                    options_ok = False
                    break
            if not options_ok:
                print("    sous-question %s : une proposition ne correspond pas — refusee"
                      % partie_examen["cle"], file=sys.stderr)
                continue

            lettres, justification = reponse_officielle(partie_corrige["lignes"])
            if lettres is None:
                print("    sous-question %s : pas de repere « Solution. » — refusee"
                      % partie_examen["cle"], file=sys.stderr)
                continue
            if not justification:
                print("    sous-question %s : reponse vide — refusee" % partie_examen["cle"],
                      file=sys.stderr)
                continue
            if RE_DEFORME.search(enonce) or RE_DEFORME.search(justification):
                print("    sous-question %s : enonce ou reponse deforme(e) — refusee"
                      % partie_examen["cle"], file=sys.stderr)
                continue
            if RE_INCOMPLET.search(enonce) or RE_INCOMPLET.search(justification):
                print("    sous-question %s : depend d'un schema absent — refusee"
                      % partie_examen["cle"], file=sys.stderr)
                continue

            libelle_probleme = "Problem %s%s" % (
                probleme["numero"],
                (" " + probleme["titre"]) if probleme["titre"] else "")

            if options_examen:
                propositions = []
                for ligne in options_examen:
                    m = RE_OPTION.match(ligne)
                    # On garde la lettre : c'est elle que le corrige cite.
                    propositions.append(normaliser(m.group(0)))
                index_justes = []
                for lettre in lettres:
                    trouve = False
                    for i, proposition in enumerate(propositions):
                        if proposition.startswith(lettre + "."):
                            if i not in index_justes:
                                index_justes.append(i)
                            trouve = True
                            break
                    if not trouve:
                        break
                if len(index_justes) != len(lettres):
                    print("    sous-question %s : les bonnes reponses ne correspondent pas — refusee"
                          % partie_examen["cle"], file=sys.stderr)
                    continue
                if len(index_justes) == 1:
                    # Une seule bonne reponse : la plateforme la note.
                    question = {
                        "question": prefixe + libelle_probleme + "\n" + enonce
                                    + "\n" + "\n".join(propositions),
                        "mode": "choice",
                        "choices": propositions,
                        "correct": index_justes[0],
                        "hint": "Question d’examen du MIT : choisis la bonne proposition, puis la correction officielle du MIT s’affiche.",
                        "explanation": "Corrigé officiel du MIT : " + justification,
                        "source": attribution,
                        "licence": licence,
                        "xp": xp,
                    }
                else:
                    # Plusieurs bonnes reponses : la plateforme ne note pas
                    # une reponse multiple. L'eleve redige, le corrige du
                    # MIT s'affiche — on ne change pas la question.
                    if len("Corrigé officiel du MIT : " + ", ".join(lettres)
                           + ". " + justification) < REPONSE_MIN:
                        print("    sous-question %s : reponse trop courte — refusee"
                              % partie_examen["cle"], file=sys.stderr)
                        continue
                    question = {
                        "question": prefixe + libelle_probleme + "\n" + enonce
                                    + "\n" + "\n".join(propositions)
                                    + "\nRéponds par les lettres des propositions justes (A, D par exemple).",
                        "mode": "solution",
                        "hint": "Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.",
                        "explanation": "Corrigé officiel du MIT : " + ", ".join(lettres)
                                    + ". " + justification,
                        "source": attribution,
                        "licence": licence,
                        "xp": xp,
                    }
            else:
                if len(justification) < REPONSE_MIN:
                    print("    sous-question %s : reponse trop courte — refusee"
                          % partie_examen["cle"], file=sys.stderr)
                    continue
                question = {
                    "question": prefixe + libelle_probleme + "\n" + enonce,
                    "mode": "solution",
                    "hint": "Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.",
                    "explanation": "Corrigé officiel du MIT : " + justification,
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
