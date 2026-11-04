#!/usr/bin/env python3
"""Treizieme extracteur MIT : le probleme, ses parties, et la solution officielle.

Pourquoi un treizieme extracteur
--------------------------------
Les douze extracteurs precedents couvrent des formats ou le corrige est
un fichier a part, et ou la reponse se repere par un marqueur connu.
Les cours qu'on trouve ensuite presentent l'examen et sa correction
**dans le meme document**, ou la correction est « en ligne » : la
reponse suit immediatement la partie, sans repere.

Quatre formes rencontrees, toutes traitees ici :

1. **reperage par les points** (MIT 6.450, Fall 2006) :

       Problem Q-1 (20 points)
       (a) Give an example of a Huffman code ...
       [6 points] The simplest example is for M = 2. ...

   L'enonce de la partie precede le repere ; la reponse le suit.

2. **reperage par « Solution. »** (MIT 6.253, Spring 2012) :

       Problem 1
       (a) Let C be a nonempty subset of Rn ...
       ...
       Solution.
       (a) We always have (l1 + l2)C ...

   Le corrige repete l'enonce, puis repond.

3. **reperage par « Solution 1a): »** (MIT 6.262, Spring 2011) :

       Problem 1: A final exam is started at time 0 ...
       a) Let Z be the time at which ...
       Solution 1a): Note that Z <= t if and only if ...

   Le repere nomme lui-meme le probleme et la partie.

4. **reponses en ligne** (MIT 6.661 Fall 2003, MIT 6.832 Spring 2009) :

       Problem 1.1
       a)  v(t) = u-1(t) e-alpha t, [See (1.2.1) in notes; ...]

   La correction ne repete pas l'enonce : elle est la reponse. L'enonce
   est alors cherche dans le fichier d'examen, et l'appariement se fait
   par (numero de probleme, lettre de partie) — des deux cotes.

LE PRINCIPE, et ce qui garantit qu'aucune reponse n'est inventee :

1. la reponse est **exactement un morceau contigu du corrige**, jamais
   une reconstitution ;
2. l'enonce est **exactement un morceau contigu de l'enonce** (ou du
   corrige, quand le corrige repete l'enonce) ;
3. l'appariement se fait par une **cle explicite** (numero de probleme,
   lettre de partie) qui doit exister **des deux cotes** ; si l'un des
   deux manque, la question est **abandonnee** — jamais devinee ;
4. une reponse trop courte, deformee par l'extraction, ou dependant d'un
   schema absent, est refusee.

Usage :
    python3 tools/import-mit-probleme-solution.py --texte dossier/ \
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
from ocw_pieds import RE_PIED_INTERNE  # noqa: E402


LICENCE = "CC BY-NC-SA 4.0"
XP = 20

HINT = ("Question d’examen du MIT : rédige ta réponse, puis la correction "
        "officielle du MIT s’affiche.")

# Un enonce qui depend d'un support absent (schema, tableau, dessin).
RE_INCOMPLET = re.compile(
    r"\bthe figure\b"
    r"|\bthe diagram\b"
    r"|\bas shown (?:above|below)\b"
    r"|\bthe tree shown\b"
    r"|\bthe graph\b"
    r"|\bthe code below\b"
    r"|\bthe table\b"
    r"|\bthe truth table\b"
    r"|\bthe karnaugh map\b"
    r"|\bthe following\b"
    r"|\bsee figure\b"
    r"|\bsee the figure\b",
    re.I,
)

# Le caractere de remplacement : le PDF a perdu un symbole (formule,
# indice, greek). Une reponse qui en contient est deformee : refus.
RE_DEFORME = re.compile("[�]")

# Les pieds de page OCW.
RE_FOOTER = re.compile(
    r"(MIT OpenCourseWare|https?://ocw\.mit\.edu|"
    r"MIT OpenCourseWare,?|\bMassachusetts Institute of Technology\b)"
    r".*$",
    re.MULTILINE,
)

# Les numeros de page et les dates de pied de page : « -2- », « 12/22/03 ».
RE_PIED = re.compile(r"^\s*(?:-\s*\d{1,3}\s*-|Page\s+\d+\s*$|\d{1,2}/\d{1,2}/\d{2,4})\s*$")

# Un en-tete de probleme. Deux formes :
# - avec le mot « Problem » : « Problem 1 », « Problem 1. [10 points] »,
#   « Problem 1.1 », « Problem Q-1 (20 points) » ;
# - sans : un numero suivi d'un point ou de deux espaces, suivi d'un titre
#   (« 1     Definition of Underactuated »).
#
# Le separateur est exige : sinon « 1) For a length 2n string... » — une
# simple ligne de liste — serait pris pour un en-tete de probleme, et le
# numero du probleme deviendrait faux.
RE_PROBLEME_MOT = re.compile(
    r"^\s{0,10}Problem\s+"
    r"([A-Z]?-?\d{1,2}(?:\.\d{1,2})*)"
    r"\s*[:.]?\s*"
    r"(?:\[[^\]]*\]\s*)?"
    r"(?:\(\s*\d+\s*points?\s*\)\s*)?"
    r"(.*)$",
    re.I,
)
RE_PROBLEME_NUM = re.compile(
    r"^\s{0,6}(\d{1,2}(?:\.\d{1,2})*)(?:\s*[.:]\s+|\s{2,})(\S.*)$"
)

# Une partie : « (a) ... » ou « a) ... ».
RE_PARTIE = re.compile(r"^\s{0,10}\(?([a-z])\)\s+(.*)$")

# Les lettres romaines : un cours peut numeroter ses sous-questions
# « (i) », « (ii) » a l'interieur d'une partie « (b) ».
LETTRES_ROMAINES = set("ivx")

# Le repere « [6 points] » qui introduit la reponse.
RE_REPERE_POINTS = re.compile(r"^\s{0,10}\[\s*(\d+)\s*points?\s*\]\s*(.*)$")

# Le repere « Solution. » (le corrige passe en phase reponse) ou
# « Solution 1a): ... » (le repere nomme le probleme ET la partie).
RE_SOLUTION_NOMME = re.compile(
    r"^\s{0,10}Solution\s+(\d{1,2}(?:\.\d{1,2})*)\s*([a-z])\)?\s*:\s*(.*)$"
)
RE_SOLUTION_PHASE = re.compile(r"^\s{0,10}Solution\s*\.?\s*(.*)$")

# Le repere « Solution: » (deux-points) : la reponse de la partie en
# cours, sur la meme ligne. Distinct de « Solution. » et de
# « Solution 2a) », qui ouvrent une nouvelle partie.
RE_SOLUTION_PHASE_INLINE = re.compile(r"^\s{0,10}Solution\s*:\s*(.*)$")


def nettoyer(texte):
    """Retire les pieds de page OCW, les numeros de page, et les lignes vides."""
    texte = RE_FOOTER.sub('', texte)
    lignes = [l.rstrip() for l in texte.replace('\r\n', '\n').split('\n')]
    lignes = [l for l in lignes if not RE_PIED.match(l)]
    # Le titre du document avec son numero de page (« Practice Exam 1:
    # All Questions, Spring 2022    23 ») n'est pas du contenu.
    lignes = [l for l in lignes if not RE_PIED_INTERNE.match(l)]
    return '\n'.join(lignes)


def decouper_problemes(texte):
    """Decoupe un document en problemes.

    Retourne {numero: [lignes]}. Une ligne d'en-tete ouvre un probleme ;
    le reste est son contenu.

    Une subtilite : dans un QCM, les propositions sont elles aussi
    numerotees (« 1. P and Q are equivalent »). Si on les prenait pour
    des en-tetes, le numero du probleme deviendrait faux. La regle : tant
    qu'un en-tete commence par le mot « Problem », les lignes numerotees
    qui suivent sont du **contenu** (les propositions) ; seules les
    lignes « Problem N » ouvrent un nouveau probleme. Un document qui
    n'emploie jamais le mot « Problem » ouvre un probleme sur chaque
    numero suivi d'un titre.
    """
    problemes = {}
    courant = None
    mot_du_cours = None
    for ligne in texte.split('\n'):
        m = RE_PROBLEME_MOT.match(ligne)
        if m is not None:
            mot_du_cours = True
        elif mot_du_cours is not True and not ligne.lstrip().startswith(('•', '-', '*', '|')):
            m = RE_PROBLEME_NUM.match(ligne)
            if m is not None:
                mot_du_cours = False
        if m is not None:
            numero = m.group(1)
            # Un numero deja vu : on ne melange pas deux listes.
            if numero in problemes:
                courant = None
                continue
            courant = numero
            problemes[numero] = []
            reste = (m.group(2) or '').strip()
            if reste:
                problemes[numero].append(reste)
            continue
        if courant is None:
            continue
        problemes[courant].append(ligne)
    return problemes


def parties_dun_probleme(lignes):
    """Les parties « (a) ... » / « a) ... » d'un probleme.

    Retourne [(lettre, texte)] ; le texte d'une partie va jusqu'a la
    partie suivante.
    """
    parties = []
    courante = None
    for ligne in lignes:
        m = RE_PARTIE.match(ligne)
        if m:
            courante = (m.group(1), [m.group(2).strip()])
            parties.append(courante)
            continue
        if courante is not None:
            courante[1].append(ligne.strip())
    return [(lettre, '\n'.join([m for m in morceaux if m]).strip())
            for lettre, morceaux in parties]


def segmenter(lignes):
    """Decoupe un bloc de probleme en (contexte, segments).

    Le **contexte** est ce qui precede la premiere partie : c'est
    l'en-tete du probleme et sonintroduction (« Problem 1: A final exam is
    started at time 0 ... »). Ce contexte n'est pas une question a part
    entiere : il est **prefixe** a l'enonce de chaque partie.

    Les **segments** sont (phase, lettre, texte). La phase est « enonce »
    jusqu'a un repere « Solution. » : a partir de la, les parties sont des
    REPONSES. Un repere « Solution 1a): » nomme directement le couple
    (probleme, partie).

    C'est ce qui distingue les deux familles :
    - MIT 6.253 : le corrige repete l'enonce, puis « Solution. » puis les
      reponses ;
    - MIT 6.661 : le corrige ne contient que les reponses, sans repere.

    Un probleme SANS parties (MIT 6.042J : « Problem 2. [10 points] »
    suivi de « Solution. ») est traite comme une partie unique, dont la
    lettre est la chaine vide.
    """
    segments = []
    phase = "enonce"
    lettre = None
    buffer = []
    avant_partie = []

    def vider():
        nonlocal buffer, lettre
        texte = '\n'.join([m for m in buffer if m]).strip()
        buffer = []
        if lettre is not None and texte:
            segments.append((phase, lettre, texte))
        lettre = None

    for ligne in lignes:
        m = RE_SOLUTION_NOMME.match(ligne)
        if m:
            vider()
            phase = "reponse"
            lettre = m.group(2)
            buffer = [m.group(3).strip()]
            continue
        m = RE_SOLUTION_PHASE_INLINE.match(ligne)
        if m and lettre is not None:
            # « Solution: <reponse> » : la reponse de la partie en cours.
            buffer.append(ligne.strip())
            continue
        m = RE_SOLUTION_PHASE.match(ligne)
        if m:
            contenu = m.group(1).strip().lstrip(':').strip()
            vider()
            phase = "reponse"
            lettre = ""
            # La reponse peut commencer sur la meme ligne : « Solution. T F F ».
            buffer = [contenu] if contenu else []
            continue
        m = RE_PARTIE.match(ligne)
        if m:
            # Une partie commence par « (a) », « (b ) »… Mais certains
            # cours numerotent leurs sous-questions « (i) », « (ii) » a
            # l'interieur d'une partie : ces sous-items ne sont PAS des
            # parties, sinon la partie (b) serait coupee en deux et la
            # reponse irait se perdre.
            if (m.group(1) in LETTRES_ROMAINES and lettre is not None
                    and lettre not in LETTRES_ROMAINES):
                buffer.append(ligne.strip())
                continue
            vider()
            lettre = m.group(1)
            buffer = [m.group(2).strip()]
            continue
        if lettre is not None:
            buffer.append(ligne.strip())
        else:
            avant_partie.append(ligne.strip())
    vider()
    contexte = '\n'.join([m for m in avant_partie if m]).strip()
    return contexte, segments


RE_REPERE_SOLUTION = re.compile(
    r'(?:^|\n)\s*(?:Solution|SOLUTION)\s*:\s*', re.MULTILINE)


def couper_reperes_solution(texte):
    """Separe l'enonce et la reponse d'un bloc porte par « Solution: ».

    Certains cours (MIT 18.05) ecrivent la reponse a la suite de la
    question, dans la meme partie : « ... Compute P(A|B). Solution: (i)
    Inclusion exclusion: ... ». On rend (enonce, reponse) ; si le
    repere est absent, la reponse est vide.
    """
    morceaux = RE_REPERE_SOLUTION.split(texte, maxsplit=1)
    if len(morceaux) < 2:
        return texte, ''
    return morceaux[0].strip(), morceaux[1].strip()


def couper_reperes_points(texte):
    """Separe l'enonce et la reponse d'un bloc porte par « [6 points] ».

    MIT 6.450 ecrit la partie, puis la reponse introduite par « [6 points] »
    dans le meme bloc. Ce qui precede le repere est l'enonce, ce qui le
    suit est la reponse.
    """
    lignes = texte.split('\n')
    avant, apres = [], []
    trouve = False
    for ligne in lignes:
        m = RE_REPERE_POINTS.match(ligne)
        if m and not trouve:
            trouve = True
            if m.group(2).strip():
                apres.append(m.group(2).strip())
            continue
        (apres if trouve else avant).append(ligne)
    return '\n'.join(avant).strip(), '\n'.join(apres).strip()


def reponses_marquees(lignes):
    """Les reponses annoncees par un repere, dans un bloc de probleme.

    Deux formes :
    - « [6 points] <reponse> » : le repere est dans la partie ;
    - « Solution 1a): <reponse> » : le repere nomme le probleme ET la
      partie, et il peut se trouver n'importe ou dans le document.
    """
    reponses = {}
    courante = None
    for ligne in lignes:
        m = RE_REPERE_POINTS.match(ligne)
        if m and courante is not None:
            morceaux = [m.group(2).strip()]
            courante[1].extend(morceaux)
            # La suite de la ligne est deja la reponse ; la partie
            # courante ne contient plus que l'enonce.
            courante = (courante[0], morceaux, True)
            reponses[courante[0]] = courante
            continue
        m = RE_REPERE_SOLUTION.match(ligne)
        if m:
            if m.group(1) and m.group(2):
                # « Solution 1a): <reponse> »
                cle = (m.group(1), m.group(2))
                suite = [m.group(3).strip()]
            else:
                # « Solution. » : la reponse suit, pour la partie en cours.
                if courante is None:
                    continue
                cle = (courante[0], None)
                suite = []
            courante = None
            continue
        if courante is not None:
            if len(courante) == 3:
                # On est deja dans la reponse : on la complete.
                reponses[courante[0]][1].append(ligne.strip())
            else:
                courante[1].append(ligne.strip())
    return reponses


def controle(reponse, minimum=30):
    """Une reponse doit etre une reponse, pas un fragment de mise en page."""
    reponse = reponse.strip()
    if len(reponse) < minimum:
        return None, "reponse trop courte (%d caracteres)" % len(reponse)
    if RE_DEFORME.search(reponse):
        return None, "reponse deformee par l'extraction"
    if 'MIT OpenCourseWare' in reponse or 'ocw.mit.edu' in reponse:
        return None, "pied de page OCW dans la reponse"
    if proportion_de_code(reponse) > 0.4:
        return None, "la reponse est du code, pas une reponse"
    if entete_de_page(reponse):
        return None, ("l'extraction a donne un en-tete de page, pas une reponse")
    return reponse, None


# Du code. Les quizzes en ligne du MIT 6.01 (exports PDF d'une plateforme
# de programmation) ont pour « corrige » l'implementation de reference :
# ce n'est pas une reponse qu'un eleve peut rediger.
RE_CODE = re.compile(
    r"^\s*(?:def |class |import |from \w+ import|return |for |while |if |else|"
    r"print\(|>>>|module |endmodule|input |output |inout |wire |reg |always|"
    r"assign |initial |parameter |localparam |function |task |//|#include|"
    r"using namespace|public |private |protected |void |int main|"
    r"console\.log|var |let |const |=>)",
    re.MULTILINE,
)


def proportion_de_code(texte):
    """La part de lignes qui sont du code."""
    lignes = [l for l in texte.split('\n') if l.strip()]
    if not lignes:
        return 0.0
    code = sum(1 for l in lignes if RE_CODE.match(l))
    return code / len(lignes)


# Un atelier de materiel (FPGA, VHDL, Verilog) : l'exercice suppose
# l'installation d'un outil que le lecteur n'a pas. Ce n'est pas une
# question, c'est une manipulation de laboratoire.
RE_OUTILLAGE = re.compile(
    r"\b(Xilinx|Vivado|CoreGen|ISE|Quartus|ModelSim|testbench|Verilog|VHDL|"
    r"Block RAM|VGA|FPGA)\b",
    re.I,
)

# Une table de transition, extraite en une suite de nombres : le sens est
# perdu, la question devient illisible.
RE_LIGNE_NUMERIQUE = re.compile(r"^[\d\s.,%+\-]*$")


# L'extraction peut attraper l'en-tete de page (le titre du document)
# au lieu de la reponse : « 6.111 Spring 2006 Problem Set 2 ».
RE_ENTETE_PAGE = re.compile(
    r"^\s*\d{1,2}\.\d{3}\b.*\b(Problem\s*Set|Exam|Quiz|Lecture|Lab|Homework|"
    r"Assignment|Page|Worksheet)\b",
    re.I,
)


def entete_de_page(texte):
    """Vrai si la reponse commence par un en-tete de document."""
    lignes = [l for l in texte.split('\n') if l.strip()]
    if not lignes:
        return False
    return bool(RE_ENTETE_PAGE.match(lignes[0].strip()))


def controler_enonce(enonce):
    if not enonce or len(enonce.strip()) < 15:
        return None, "enonce trop court"
    if RE_DEFORME.search(enonce):
        return None, "enonce deforme par l'extraction"
    if RE_INCOMPLET.search(enonce):
        return None, "depend d'un schema absent"
    if RE_OUTILLAGE.search(enonce):
        return None, ("exercice d'atelier : depend d'un outillage "
                      "specifique absent de la plateforme")
    return enonce.strip(), None


# Le numero de cours, tel qu'il apparait en tete de document : « 6.825 »,
# « 6.042/18.062J », « 6.01 ».
RE_NUMERO_COURS = re.compile(r"\b(\d{1,2}\.\d{3}[a-z]?)\b")


def numeros_de_cours(texte):
    """Les numeros de cours announces dans l'en-tete d'un document.

    On ne regarde que les vingt premieres lignes : c'est la que le MIT
    écrit « 6.891 Final Examination » ou « 6.825 Recitation Problems ».
    Le but est de pouvoir dire « ces deux documents ne sont pas le meme
    examen », meme si OCW les a ranges dans le meme dossier.
    """
    tete = '\n'.join(texte.split('\n')[:20])
    return set(RE_NUMERO_COURS.findall(tete))


# Les mots vides, pour comparer deux textes sans se laisser distraire par
# la ponctuation ni par les mots de liaison.
MOTS_VIDES = set("""
a an and are as at be but by for from has have if in into is it its of on or that the
then there these this to was were which who will with you your our their they them
show shown find give prove using use used consider each all any more most other
following problem question part solution points point answer answers true false
""".split())


def mots_pertinents(texte):
    mots = re.findall(r"[a-zà-ÿ]{4,}", texte.lower())
    return set(m for m in mots if m not in MOTS_VIDES)


def controle_paire(enonce, reponse):
    """Le corrige doit repondre, et repondre A CETTE question.

    Deux pieges reels :
    - un « corrige » qui est en fait le questionnaire rempli (les
      quizzes en ligne exportes en PDF par le MIT) : le texte de la
      reponse est alors le meme que celui de l'enonce ;
    - deux documents de cours differents ranges dans le meme dossier
      (le 6.825 « Recitation Problems » associe a un examen du 6.891).
    """
    a, b = mots_pertinents(enonce), mots_pertinents(reponse)
    if a and b:
        commun = len(a & b)
        union = len(a | b)
        if union and commun / union > 0.75:
            return None, "le corrige ne repond pas : c'est le meme texte que l'enonce"
    return reponse, None


def construire(enonce_path, corrige_path, prefixe, attribution, licence, xp):
    """Les questions d'un couple (enonce, corrige)."""
    questions = []
    refus = []

    texte_enonce = nettoyer(io.open(enonce_path, encoding='utf-8', errors='ignore').read())
    texte_corrige = nettoyer(io.open(corrige_path, encoding='utf-8', errors='ignore').read())

    prob_enonce = decouper_problemes(texte_enonce)
    prob_corrige = decouper_problemes(texte_corrige)

    # Deux documents qui n'ont pas le meme numero de cours ne sont pas
    # l'enonce et le corrige du meme examen : on refuse le couple entier.
    cours_enonce = numeros_de_cours(texte_enonce)
    cours_corrige = numeros_de_cours(texte_corrige)
    if cours_enonce and cours_corrige and cours_enonce != cours_corrige:
        refus.append(("document", "-", "les deux documents n'ont pas le meme "
                     "numero de cours (%s / %s)" % (
                         ", ".join(sorted(cours_enonce)), ", ".join(sorted(cours_corrige)))))
        return questions, refus

    for numero, lignes_corrige in prob_corrige.items():
        lignes_enonce = prob_enonce.get(numero)
        contexte, segments = segmenter(lignes_corrige)
        if not segments:
            # Aucune partie exploitable : le probleme n'est pas de forme
            # « enonce + reponse » (tableau de resultats, schema, ...).
            # On le dit, plutot que de disparaitre en silence.
            refus.append((numero, "-", "aucune partie « enonce + reponse » "
                         "exploitable dans le corrige"))
            continue

        # Les enonces et les reponses du corrige, separees.
        enonces_corrige, reponses_corrige = {}, {}
        for phase, lettre, texte in segments:
            if phase == "enonce":
                avant, reponse = couper_reperes_solution(texte)
                avant, apres = couper_reperes_points(avant)
                enonces_corrige[lettre] = avant
                if apres:
                    reponses_corrige[lettre] = apres
                if reponse:
                    reponses_corrige[lettre] = reponse
            else:
                reponses_corrige[lettre] = texte

        # Les enonces du fichier d'examen, pour le meme numero.
        enonces_examen = {}
        if lignes_enonce:
            parties = parties_dun_probleme(lignes_enonce)
            if parties:
                for lettre, texte in parties:
                    enonces_examen[lettre] = texte
            else:
                # Probleme sans parties : tout le bloc est l'enonce.
                enonces_examen[""] = '\n'.join(lignes_enonce).strip()

        for lettre in sorted(set(list(enonces_corrige) + list(reponses_corrige))):
            reponse = reponses_corrige.get(lettre, '')
            enonce = enonces_corrige.get(lettre, '')

            if not reponse:
                # Le corrige ne donne pas de reponse pour cette partie :
                # il s'agit d'un corrige « en ligne » dont la partie EST
                # la reponse. L'enonce vient alors du fichier d'examen.
                reponse = enonces_corrige.get(lettre, '').strip()
                enonce = enonces_examen.get(lettre, '').strip()

            if not enonce and lettre in enonces_examen:
                enonce = enonces_examen[lettre]

            # Le contexte du probleme prefixe l'enonce de chaque partie.
            if lettre and contexte:
                enonce = "%s\n%s" % (contexte, enonce) if enonce else contexte

            enonce, motif = controler_enonce(enonce)
            if enonce is None:
                refus.append((numero, lettre, motif))
                continue
            reponse, motif = controle(reponse)
            if reponse is None:
                refus.append((numero, lettre, motif))
                continue
            reponse, motif = controle_paire(enonce, reponse)
            if reponse is None:
                refus.append((numero, lettre, motif))
                continue

            questions.append({
                "question": "%s\n%s" % (prefixe, enonce),
                "mode": "solution",
                "hint": HINT,
                "xp": xp,
                "explanation": "Corrigé officiel du MIT : %s" % reponse,
                "source": attribution,
                "licence": licence,
                "attribution": attribution,
            })

    return questions, refus


def cle(texte, prefixe):
    """La clef de deduplication d'une question.

    On compare le texte **sans le prefixe** : sinon, un prefixe long
    (« [MIT 6.042J — question d’examen, en anglais] ») mange la fenetre de
    comparaison et fait passer pour doublons des questions distinctes.
    La reponse entre aussi dans la clef : deux items qui partagent le
    meme enonce mais ont des reponses differentes ne sont pas doublons.
    """
    if prefixe and texte.startswith(prefixe):
        texte = texte[len(prefixe):]
    return texte[:220]


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
                                "algorithmes, cpp, performance")
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
            clef = "%s||%s" % (cle(question["question"], args.prefixe),
                                  question.get("explanation", "")[:80])
            if clef in vues:
                continue
            vues.add(clef)
            questions.append(question)
            retenues += 1
        nomcourt = nom[:40]
        if retenues:
            print("  %-40s %2d question(s)" % (nomcourt, retenues))
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
