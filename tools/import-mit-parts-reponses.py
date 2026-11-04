#!/usr/bin/env python3
"""Huitieme extracteur MIT : les parties numerotees et les reponses en ligne.

Deux formats qu'aucun extracteur precedent ne couvrait.

1. « parts-reponses » (MIT 18.404J Theory of Computation) : l'enonce
   annonce « reponds Vrai, Faux, ou question ouverte a chaque proposition »,
   le corrige donne la reponse **en ligne** : « (a) False, hierarchy
   theorem. ». Chaque proposition devient une question, et la reponse
   officielle est reprise telle quelle.

   - Quand la reponse officielle commence par « True », « False » ou
     « Open », la question est proposee en **choix multiple**, avec les
     trois reponses que le MIT lui-meme propose dans l'enonce (Vrai, Faux,
     question ouverte). On n'invente aucune proposition.
   - Quand la reponse est une phrase (une demonstration), la question est
     une **redaction** : l'eleve ecrit, la correction officielle du MIT
     s'affiche.

2. « numeros-reponses » (MIT 6.851 Advanced Data Structures) : l'enonce
   numrote ses problemes (1., 2., 3.) et le corrige (« Sample solution »)
   reprend les memes numeros pour les reponses. Chaque numero donne une
   question redigee.

Les garde-fous (ils ont tous etepayes par un cas reel) :
- la correction doit faire au moins 80 caracteres, sinon elle est un
  fragment de mise en page, pas une reponse ;
- une correction qui commence par une minuscule est un fragment (le
  pdftotext a coupe la phrase en deux) : refusee ;
- les pieds de page OCW (« MIT OpenCourseWare », l'URL, le nom du cours)
  sont retires de la correction ;
- l'enonce et le corrige sont apparies par le numero (et la lettre de la
  partie) : si l'un des deux manque, la question est refusee plutot que
  devinee ;
- on ne reecrit jamais l'enonce : il est repris mot pour mot.

Usage :
    python3 tools/import-mit-parts-reponses.py --texte DOSSIER \
        --sortie SORTIE.json --format parts-reponses \
        --source SOURCE --url URL --attribution ATTRIBUTION \
        --prefixe "[MIT — question d’examen, en anglais] " --theme THEME
"""

import argparse
import io
import json
import os
import re
import sys

# L'appariement enonce <-> corrige est fait par le module partage
# (le hash de ressource d'OCW differe d'un fichier a l'autre).
sys.path.insert(0, os.path.dirname(os.path.abspath(__file__)))
from ocw_appariement import enonces_avec_corrige  # noqa: E402
from ocw_pieds import retirer_pieds_de_page  # noqa: E402

LICENCE = "CC BY-NC-SA 4.0"
XP = 20

HINT_SOLUTION = ("Question d’examen du MIT : rédige ta réponse, puis la "
                 "correction officielle du MIT s’affiche.")
HINT_CHOICE = ("Question d’examen du MIT : la justification du corrigé "
               "officiel est affichée après ta réponse.")

RE_PROBLEME = re.compile(r'^\s{0,6}(\d{1,2})\.\s+(\S.*)$')
RE_PARTIE_DEBUT = re.compile(r'^\s{0,6}\(([a-z])\)\s*(.*)$')
RE_PARTIE_EN_LIGNE = re.compile(r'\(([a-z])\)\s*(.*?)(?=\s\([a-z]\)\s|$)')
RE_FOOTER = re.compile(r'(MIT OpenCourseWare|https?://ocw\.mit\.edu|Spring\s*\'?\d\d|Fall\s*\'?\d\d)'
                       r'.*$', re.MULTILINE)

# Les pieds de page d'OCW sont retires par le module partage
# `tools/ocw_pieds.py` : le bloc occupe plusieurs lignes, le retirer
# ligne par ligne en laissait des morceaux dans l'enonce de la question.
def nettoyer(texte):
    """Retire les pieds de page OCW et les lignes vides en trop."""
    texte = retirer_pieds_de_page(texte)
    lignes = [l.rstrip() for l in texte.split('\n')]
    return '\n'.join(lignes)


def decouper_problemes(texte):
    """Decoupe un document en problemes numerotes.

    Retourne (preambule, {numero: [lignes]}). Une ligne qui commence par
    « 3. » ouvre le probleme 3 ; tout le reste est du contenu.
    """
    lignes = texte.split('\n')
    preambule = []
    problemes = {}
    courant = None
    for ligne in lignes:
        m = RE_PROBLEME.match(ligne)
        if m and not ligne.lstrip().startswith(('•', '-', '*')):
            numero = int(m.group(1))
            # Un numero deja vu, ou un numero qui recommence a 1 apres un
            # autre bloc : on ne melange pas deux listes.
            if numero in problemes:
                courant = None
                continue
            courant = numero
            problemes[numero] = []
            # La suite de la ligne compte : « 1. (a) False, ... » porte
            # deja la premiere partie de la reponse.
            if m.group(2).strip():
                problemes[numero].append(m.group(2).strip())
            continue
        if courant is None:
            preambule.append(ligne)
        else:
            problemes[courant].append(ligne)
    return '\n'.join(preambule).strip(), problemes


def parties_dun_probleme(lignes):
    """Extrait les parties « (a) ... » d'un probleme.

    Retourne [(lettre, texte)] ; le texte d'une partie va jusqu'a la
    partie suivante (les lignes de continuation sont gardees).
    """
    parties = []
    courante = None
    for ligne in lignes:
        m = RE_PARTIE_DEBUT.match(ligne)
        if m:
            courante = (m.group(1), [m.group(2).strip()])
            parties.append(courante)
            continue
        if courante is not None:
            courante[1].append(ligne.strip())
    resultat = []
    for lettre, morceaux in parties:
        texte = '\n'.join([m for m in morceaux if m]).strip()
        resultat.append((lettre, texte))
    return resultat


def reponses_dun_probleme(lignes):
    """Extrait les reponses « (a) <reponse> » d'un corrige.

    Les reponses sont en ligne : la ligne qui commence par « (a) » porte
    la reponse ; les lignes suivantes la completent jusqu'a la partie
    suivante.
    """
    reponses = []
    courante = None
    for ligne in lignes:
        ligne = ligne.strip()
        if not ligne:
            continue
        m = RE_PARTIE_DEBUT.match(ligne)
        if m:
            texte = m.group(2)
            # La meme ligne peut porter d'autres parties : « (a) False, ...
            # (b) True, ... ». La correction de (a) s'arrete a (b),
            # sinon elleilerait la reponse suivante.
            suite = RE_PARTIE_EN_LIGNE.search(texte)
            if suite:
                texte = texte[:suite.start()].strip()
            courante = (m.group(1), [texte.strip()])
            reponses.append(courante)
            for lettre2, suite in RE_PARTIE_EN_LIGNE.findall(ligne)[1:]:
                courante = (lettre2, [suite.strip()])
                reponses.append(courante)
            continue
        if courante is not None:
            courante[1].append(ligne)
    resultat = {}
    for lettre, morceaux in reponses:
        texte = '\n'.join([m for m in morceaux if m]).strip()
        # Une ligne peut porter plusieurs reponses : « (a) ... (b) ... ».
        for lettre2, suite in RE_PARTIE_EN_LIGNE.findall(texte):
            if lettre2 != lettre and lettre2 not in resultat:
                resultat[lettre2] = suite.strip()
        resultat[lettre] = texte
    return resultat


def controle_correction(reponse):
    """Une correction doit etre une reponse, pas un fragment de mise en page."""
    reponse = reponse.strip()
    if len(reponse) < 80:
        return None, "reponse trop courte (%d caracteres)" % len(reponse)
    if reponse[0].islower():
        return None, "la reponse commence par une minuscule : fragment de mise en page"
    if 'MIT OpenCourseWare' in reponse or 'ocw.mit.edu' in reponse:
        return None, "pied de page OCW dans la reponse"
    return reponse, None


RE_TITRE_PROBLEME = re.compile(r'^\s*Problem\s+\d+', re.IGNORECASE)


def corps_sans_entete(lignes):
    """Le corps d'un document : tout ce qui suit la ligne « Problem N »."""
    for i, ligne in enumerate(lignes):
        if RE_TITRE_PROBLEME.match(ligne):
            return lignes[i + 1:]
    return lignes


def blocs_numerotes(lignes):
    """Les blocs « 1. », « 2. » ... d'un document, dans l'ordre.

    Sert au format « numeros-reponses » : l'enonce et le corrige sont
    deux listes de blocs numerotes. On garde le **numero** de chaque
    bloc : l'appariement se fait alors par le numero lui-meme, et non
    par le rang — un corrige dont les problemes sont dans un autre ordre
    est alors refuse, au lieu d'etre apparie de travers.
    """
    blocs = []
    courant = None
    for ligne in lignes:
        m = RE_PROBLEME.match(ligne)
        if m:
            courant = [int(m.group(1)), [m.group(2).strip()]]
            blocs.append(courant)
            continue
        if courant is not None:
            courant[1].append(ligne.strip())
    if not blocs:
        # Pas d'items numerotes : le document ne contient qu'un probleme.
        corps = corps_sans_entete(lignes)
        texte = '\n'.join([l.strip() for l in corps if l.strip()]).strip()
        return [(None, texte)] if texte else []
    return [(numero, '\n'.join([x for x in texte if x]).strip())
            for numero, texte in blocs]


def apparier_par_numero(enonces, solutions):
    """Apparie deux listes de blocs numerotes PAR LEUR NUMERO.

    Renvoie [(numero, enonce, reponse)], ou None si l'appariement est
    impossible (numeros absents d'un cote, ou mismatch). On refuse
    d'apparier par le rang : un corrige dont l'ordre differe de celui
    de l'enonce donnerait des questions faussees.
    """
    numeros_enonce = [numero for numero, _ in enonces]
    numeros_corrige = [numero for numero, _ in solutions]
    sans_numero_enonce = all(n is None for n in numeros_enonce)
    sans_numero_corrige = all(n is None for n in numeros_corrige)
    if sans_numero_enonce and sans_numero_corrige:
        # Aucun des deux documents ne numrote ses items : il n'y a qu'un
        # probleme de chaque cote, l'appariement ne peut pas etre errone et le
        # compte des blocs fait foi.
        if len(enonces) != len(solutions):
            return None
        return [(None, enonce, reponse)
                for (numero, enonce), (numero2, reponse) in zip(enonces, solutions)]
    if None in numeros_enonce or None in numeros_corrige:
        return None
    if sorted(numeros_enonce) != sorted(numeros_corrige):
        return None
    table = dict(solutions)
    return [(numero, texte, table[numero]) for numero, texte in enonces]


RE_MARQUEUR_REPONSE = re.compile(
    r'^[ \t]*(ANSWER|Answer|SOLUTION|Solution|SOLUTIONS|Solutions)[ \t]*[:.]?[ \t]*$')
RE_MARQUEUR_REPONSE_INLINE = re.compile(
    r'\b(?:ANSWER|Answer|SOLUTION|Solution)\b[ \t]*[:.]')


def _normalise(texte):
    """Un texte compare : minuscules, espaces groupes, ponctuation finale coupee."""
    texte = re.sub(r'\s+', ' ', (texte or '')).strip().lower()
    return texte.strip('.:;,()[]"\'')


def _meme_enonce(avant, enonce):
    """Le texte « avant » est-il l'enonce de la question ?

    On compare apres normalisation : minuscules, espaces groupes, la
    ponctuation finale coupee, et sans le prefixe « Problem 3. » ni la
    lettre de partie « (a) ».
    """
    avant_n = _normalise(avant)
    enonce_n = _normalise(enonce)
    if not avant_n or not enonce_n:
        return False
    avant_sans_titre = re.sub(r'^problem\s+\d+[.:]?\s*', '', avant_n)
    avant_sans_lettre = re.sub(r'^\(?[a-z]\)?\s*', '', avant_sans_titre)
    enonce_sans_lettre = re.sub(r'^\(?[a-z]\)?\s*', '', enonce_n)
    for gauche, droite in ((avant_sans_titre, enonce_n),
                           (avant_sans_lettre, enonce_sans_lettre)):
        if gauche and droite and (gauche in droite or droite in gauche):
            return True
    return False


def corrige_sans_repetition(reponse, enonce):
    """Retire l'enonce repete en tete du corrige officiel.

    Beaucoup de corriges du MIT repetent l'enonce du probleme avant le
    marqueur « ANSWER: » ou « Solution: » — sur sa propre ligne, ou
    termine en fin de ligne. On ne garde que ce qui suit le marqueur —
    mais SEULEMENT si le texte avant le marqueur est bien l'enonce
    (compare apres normalisation). Dans le doute, on ne touche a rien.
    """
    marqueur = RE_MARQUEUR_REPONSE_INLINE.search(reponse)
    if not marqueur:
        return reponse
    avant = reponse[:marqueur.start()]
    apres = reponse[marqueur.end():].strip()
    if not apres or not _meme_enonce(avant, enonce):
        return reponse
    return apres


def choisir_mode(reponse):
    """Renvoie ('choice', index) ou ('solution', None) selon la reponse du MIT."""
    for index, debut in enumerate(('True', 'False', 'Open')):
        if reponse.startswith(debut):
            return 'choice', index
    return 'solution', None


def fabriquer_question(prefixe, enonce, reponse, source, mode, index=None,
                       licence=LICENCE):
    """Construit une question du lot, ou None si la correction ne suffit pas."""
    if mode == 'choice':
        return {
            "question": prefixe + enonce,
            "mode": "choice",
            "hint": HINT_CHOICE,
            "explanation": "Corrigé officiel du MIT : " + reponse,
            "source": source,
            "licence": licence,
            "xp": XP,
            "choices": ["True", "False", "Open question"],
            "correct": index,
        }
    return {
        "question": prefixe + enonce,
        "mode": "solution",
        "hint": HINT_SOLUTION,
        "explanation": "Corrigé officiel du MIT : " + reponse,
        "source": source,
        "licence": licence,
        "xp": XP,
    }


def paires_de_fichiers(dossier):
    """Les paires (enonce, corrige) du dossier.

    L'appariement est fait par `tools/ocw_appariement.py`, le module
    partage avec les autres extracteurs : il tient compte du hash de
    ressource d'OCW (qui differe d'un fichier a l'autre) et des
    marqueurs de corrige (`_sol`, `_soln`, `examsol`, `solutions`...).
    Avant, on exigeait exactement `<base>_sol.txt` : le MIT 14.15J
    nomme son corrige `..._examsol`, et la paire n'etait donc pas
    trouvee.
    """
    paires = []
    for enonce, corrige in enonces_avec_corrige(dossier):
        base = re.sub(r'\.txt$', '', os.path.basename(enonce))
        paires.append((enonce, corrige, base))
    return paires


def extraire_parts_reponses(enonce_txt, corrige_txt, prefixe, source, journal,
                            licence=LICENCE):
    """MIT 18.404J : les parties (a), (b)... et leurs reponses en ligne."""
    questions = []
    _, problemes = decouper_problemes(enonce_txt)
    _, solutions = decouper_problemes(corrige_txt)
    for numero in sorted(problemes):
        if numero not in solutions:
            continue
        enonces = dict(parties_dun_probleme(problemes[numero]))
        reponses = reponses_dun_probleme(solutions[numero])
        for lettre in sorted(enonces):
            if lettre not in reponses:
                journal.append("probleme %d, partie (%s) : pas de reponse dans le corrige" % (numero, lettre))
                continue
            enonce = enonces[lettre]
            reponse = reponses[lettre]
            # On retire d'abord l'enonce repete en tete du corrige : c'est
            # la reponse qu'on garde qui doit passer le controle de
            # longueur, pas celle qui contient l'enonce.
            reponse = corrige_sans_repetition(reponse, enonce)
            mode, index = choisir_mode(reponse)
            if mode == 'solution':
                reponse, pb = controle_correction(reponse)
                if pb:
                    journal.append("probleme %d, partie (%s) : %s" % (numero, lettre, pb))
                    continue
            question = fabriquer_question(prefixe, enonce, reponse, source, mode,
                                         index, licence)
            if question:
                questions.append(question)
    return questions


def extraire_numeros_reponses(enonce_txt, corrige_txt, prefixe, source, journal,
                               licence=LICENCE):
    """MIT 6.851 : les problemes 1., 2., 3. et le « Sample solution »."""
    questions = []
    lignes = enonce_txt.split('\n')
    contexte_lignes = corps_sans_entete(lignes)
    # On s'arrete au premier item numerote : le contexte, c'est ce qui
    # precede l'item (le titre du probleme), pas l'en-tete du cours.
    for i, ligne in enumerate(contexte_lignes):
        if RE_PROBLEME.match(ligne):
            contexte_lignes = contexte_lignes[:i]
            break
    contexte = ' '.join(l.strip() for l in contexte_lignes
                        if l.strip() and not l.strip().lower().startswith(
                            ('be sure to read', 'remember to')))
    if len(contexte) > 700:
        contexte = contexte[:700].rsplit(' ', 1)[0]
    enonces = blocs_numerotes(enonce_txt.split('\n'))
    solutions = blocs_numerotes(corrige_txt.split('\n'))
    if len(enonces) != len(solutions):
        journal.append("l'enonce annonce %d item(s), le corrige en a %d : appariement refuse"
                       % (len(enonces), len(solutions)))
        return questions
    paires = apparier_par_numero(enonces, solutions)
    if paires is None:
        journal.append("les numeros de l'enonce et du corrige ne se "
                       "correspondent pas : appariement refuse")
        return questions
    for numero, enonce, reponse in paires:
        if not enonce or not reponse:
            continue
        reponse = corrige_sans_repetition(reponse, enonce)
        reponse, pb = controle_correction(reponse)
        if pb:
            journal.append("item %s : %s" % (numero, pb))
            continue
        question = fabriquer_question(
            prefixe, (contexte + "\n" if contexte else "") + enonce, reponse,
            source, 'solution', None, licence)
        if question:
            questions.append(question)
    return questions


def rooms_du_lot(questions, theme):
    """Les rooms qui accueillent les questions.

    `--theme` accepte deux choses :
    - le slug d'une room reelle (par exemple
      « comment-marche-un-ordinateur-de-la-donnee-au-programme ») :
      toutes les questions vont dans cette room ;
    - un theme (« algorithmes », « communications », « cyber »…) : les
      questions sont alors reparties dans les rooms de la section du
      theme, d'apres la mesure du site (module tools/repartition-themes.py).
    """
    rooms_connues = charger_rooms_connues()

    if rooms_connues and theme in rooms_connues:
        return [{
            "room": theme,
            "title": theme,
            "tasks": {"test": questions},
        }]

    par_room = repartir(questions, theme)
    if not par_room:
        return []
    return [{
        "room": slug,
        "title": slug,
        "tasks": {"test": quest},
    } for slug, quest in sorted(par_room.items())]


def charger_rooms_connues():
    """Les slugs de rooms que le plugin sait creer (liste vide si absente)."""
    chemin = os.path.join(os.path.dirname(os.path.abspath(__file__)),
                          "rooms-connues.json")
    if not os.path.exists(chemin):
        return {}
    with io.open(chemin, encoding="utf-8") as fichier:
        return json.load(fichier)


def repartir(questions, theme):
    """Pose les questions dans les rooms reelles, d'apres la MESURE du site."""
    import importlib.util

    chemin = os.path.join(os.path.dirname(os.path.abspath(__file__)),
                          "repartition-themes.py")
    specification = importlib.util.spec_from_file_location("repartition", chemin)
    module = importlib.util.module_from_spec(specification)
    specification.loader.exec_module(module)
    return module.repartir(questions, theme)


def main():
    analyseur = argparse.ArgumentParser(description="Huitieme extracteur MIT : parties + reponses.")
    analyseur.add_argument("--texte", required=True, help="dossier des fichiers de texte")
    analyseur.add_argument("--sortie", required=True, help="fichier JSON du lot")
    analyseur.add_argument("--format", required=True,
                           choices=["parts-reponses", "numeros-reponses"])
    analyseur.add_argument("--source", required=True)
    analyseur.add_argument("--url", required=True)
    analyseur.add_argument("--attribution", required=True)
    analyseur.add_argument("--licence", default=LICENCE)
    analyseur.add_argument("--prefixe", default="[MIT — question d’examen, en anglais] ")
    analyseur.add_argument("--theme", required=True,
                        help="la room qui accueille le lot, ou un theme "
                             "(« algorithmes », « cyber »…) : les questions sont "
                             "alors reparties dans les rooms de sa section")
    args = analyseur.parse_args()

    paires = paires_de_fichiers(args.texte)
    if not paires:
        print("Aucune paire enonce + corrige trouvee dans %s" % args.texte, file=sys.stderr)
        return 2

    journal = []
    questions = []
    for enonce_f, corrige_f, base in paires:
        enonce_txt = nettoyer(io.open(enonce_f, encoding='utf-8', errors='ignore').read())
        corrige_txt = nettoyer(io.open(corrige_f, encoding='utf-8', errors='ignore').read())
        if args.format == 'parts-reponses':
            trouvees = extraire_parts_reponses(enonce_txt, corrige_txt, args.prefixe,
                                              args.source, journal, args.licence)
        else:
            trouvees = extraire_numeros_reponses(enonce_txt, corrige_txt, args.prefixe,
                                                 args.source, journal, args.licence)
        for q in trouvees:
            # Le champ « source » d'une question porte l'attribution
            # complete : c'est elle qui sera affichee a l'eleve.
            q['source'] = args.attribution
        print("%-30s %3d question(s)" % (base, len(trouvees)))
        questions.extend(trouvees)

    if not questions:
        print("Aucune question retenue : rien n'est importe (on ne devine jamais).", file=sys.stderr)
        for ligne in journal[:12]:
            print("   " + ligne, file=sys.stderr)
        return 3

    lot = {
        "source": args.source,
        "licence": args.licence,
        "attribution": args.attribution,
        "url": args.url,
        "rooms": rooms_du_lot(questions, args.theme),
    }
    with io.open(args.sortie, 'w', encoding='utf-8') as f:
        f.write(json.dumps(lot, ensure_ascii=False, indent=2) + "\n")
    print("Total : %d question(s) avec corrige officiel." % len(questions))
    for ligne in journal[:12]:
        print("   refuse : " + ligne)
    return 0


if __name__ == '__main__':
    raise SystemExit(main())
