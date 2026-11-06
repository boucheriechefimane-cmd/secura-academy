#!/usr/bin/env python3
"""Controle de qualite du contenu « Les universites ».

Verifie, avant de generer le PHP :
  - la structure de chaque room (cles obligatoires) ;
  - chaque question : 4 propositions, un seul index correct, une explication ;
  - LA BONNE REPONSE N'EST JAMAIS LA PLUS LONGUE (voir plus bas : c'est la
    regle qui empeche de reussir un examen sans lire les propositions) ;
  - aucune reprise de texte suspect (caracteres CJK, cyrillique) ;
  - chaque identifiant de video est present dans la liste verifiee
    (tools/videos/videos-verifies.json) ;
  - chaque mission pointe vers un chemin de drapeau coherent.

Usage : python3 check.py
Code de sortie : 0 si tout va bien, 1 sinon.
"""
import io
import json
import os
import re
import sys

HERE = os.path.dirname(os.path.abspath(__file__))
ROOT = os.path.abspath(os.path.join(HERE, '..', '..'))
VERIFIED = os.path.join(ROOT, 'tools', 'videos', 'videos-verifies.json')

MODULES = [
    'rooms_mit858',
    'rooms_mit857',
    'rooms_pwn',
    'rooms_cyber',
    'rooms_owasp',
    'rooms_stanford',
    'rooms_m7',
]

REQUIRED = [
    'title', 'excerpt', 'content', 'difficulty', 'duration', 'xp_bonus',
    'video', 'lesson_title', 'lesson', 'practice_title', 'practice_intro',
    'practice', 'mission_title', 'mission', 'exam_title', 'exam', 'i18n',
]

VIDEO_KEYS = ['id', 'title', 'channel', 'institution', 'license']

SUSPECT = re.compile(r'[\u4e00-\u9fff\u3040-\u30ff\u0400-\u04ff\uac00-\ud7af]')
LATIN_IN_ARABIC = re.compile(r'[\u0600-\u06FF][A-Za-z]{2,}')
ENGLISH = re.compile(r'\b(the|and|is|are|you|not|with|from|this|that|when|what|why|how|your|be)\b')

# LA REGLE DE LONGUEUR, ET POURQUOI ELLE EST STRICTE.
#
# Mesure du 6 novembre 2026 : 255 questions sur 356 (72 %) se gagnaient en
# cochant TOUJOURS la proposition la plus longue, en francais comme en
# anglais. Sur les rooms universitaires, c'etait 93 % des questions et 35
# examens sur 36. L'epreuve ne mesurait plus la comprehension : elle mesurait
# la capacite a reperer la proposition la mieux redigee.
#
# Deux precautions, apprises en se trompant :
#
# 1. STRICTEMENT plus courte, pas « pas plus longue ». Un outil qui compte la
#    question comme gagnee des que la bonne reponse ATTEINT la longueur
#    maximale (tools/controle/qualite-qcm.py) est trop indulgent : a egalite
#    avec une mauvaise proposition, l'eleve ne peut pas trancher, il a une
#    chance sur deux. Ici, l'egalite est refusee.
#
# 2. ON MESURE LES DEUX LANGUES. Les propositions anglaises vivent dans un
#    autre fichier (includes/i18n/en-univ.php) : une bonne reponse courte en
#    francais peut etre la plus longue en anglais. Mesure du meme jour :
#    258 questions gagnables en anglais contre 255 en francais — les listes
#    ne se recouvrent pas exactement.
LONGUEUR_SEUIL = 3  # en dessous, la longueur ne dit rien : tout est court

# Les cles de room (`univ-01`, ...) ne sont PAS dans les sources Python : elles
# sont posees a l'installation, par bloc, dans l'ordre. On refait donc la meme
# liste, dans le meme ordre, a partir des blocs du fichier genere — et on
# verifie qu'elle tombe juste avant de s'en servir. Une cle fausse produirait
# des comparaisons silencieusement fausses.
ROOM_KEY = re.compile(r"^\t'([a-z0-9]+-\d+)'\s*=>\s*array\(\s*$")
BLOC_KEY = re.compile(r"\$blocs = array\((.*?)\n\t\t\);", re.S)
BLOC_ENTRY = re.compile(r"'([a-z0-9]+)'\s*=>\s*seca_default_rooms")
ROOM_QUESTIONS = {}


def gagnee_a_la_longueur(choices, correct):
    """Vrai si la bonne reponse est (a egalite) la plus longue."""
    if not choices or not isinstance(correct, int) or correct < 0 or correct >= len(choices):
        return False
    longueurs = [len(choice) for choice in choices]
    return longueurs[correct] >= max(longueurs)


def questions_du_php(chemin):
    """Lit, dans le PHP genere, les questions telles qu'elles sont LIVREES.

    C'est le seul contenu qui compte : `build.py` deplace la bonne reponse
    (rebalance : position = (offset + rang) % 4), donc l'index `correct`
    des sources ne designe ni la meme proposition ni la meme longueur.
    Mesurer les sources, c'est mesurer un brouillon.

    Retour : dict {cle_de_room: [{'q':…, 'choices': [...], 'correct': n}, …]}
    """
    if not os.path.exists(chemin):
        return {}
    with io.open(chemin, encoding='utf-8') as handle:
        source = handle.read()

    positions = [m.start() for m in re.finditer(r"^array\($", source, re.M)]
    positions.append(len(source))

    rooms = {}
    for numero in range(len(positions) - 1):
        bloc = source[positions[numero]:positions[numero + 1]]
        questions = []
        # Le motif tolere ce qui s'intercale entre `mode` et `choices` : les
        # questions parametriques y portent leur bloc 'variants', et une
        # regex trop stricte en oubliait 5 sur 204 lors du premier essai.
        for morceau in re.finditer(
                r"'question' => '((?:[^'\\]|\\.)*)',\s*\n\s*'mode' => 'choice',"
                r".*?'choices' => array\((.*?)\n\t+\)", bloc, re.S):
            choix = [
                texte.replace("\\'", "'").replace('\\\\', '\\')
                for texte in re.findall(r"'((?:[^'\\]|\\.)*)'", morceau.group(2))
            ]
            suite = bloc[morceau.end():morceau.end() + 200]
            trouve = re.search(r"'correct' => (\d+)", suite)
            if not choix or not trouve:
                continue
            questions.append({
                'q': morceau.group(1).replace("\\'", "'"),
                'choices': choix,
                'correct': int(trouve.group(1)),
            })
        rooms['univ-%02d' % (numero + 1)] = questions
    return rooms


def index_corrects_du_php(chemin):
    """Lit, dans le PHP genere, les index `correct` des rooms universitaires.

    C'est le SEUL endroit ou la position de la bonne reponse est ecrite :
    build.py deplace la bonne proposition (rebalance), et le fichier anglais
    a ete reordonne de la meme facon — son ordre n'est donc ni celui des
    sources, ni un ordre a nous.

    Retour : dict {cle_de_room: [index, ...]} dans l'ordre des questions.
    """
    if not os.path.exists(chemin):
        return {}
    with io.open(chemin, encoding='utf-8') as handle:
        source = handle.read()

    # Une room = un `array(` en debut de ligne, au premier niveau
    # d'indentation (`\t\tarray(`) ; ses questions sont plus profondes.
    # On ne peut PAS delimiter les rooms par leur image de lab : les six
    # rooms d'un meme bloc partagent la meme (`securalabs/univ-01:1.0`),
    # ce qui faisait passer 36 rooms pour une seule lors du premier essai.
    positions = [m.start() for m in re.finditer(r"^array\($", source, re.M)]
    positions.append(len(source))

    resultat = {}
    for numero in range(len(positions) - 1):
        debut, fin = positions[numero], positions[numero + 1]
        resultat['univ-%02d' % (numero + 1)] = [
            int(index) for index in re.findall(r"'correct' => (\d+)", source[debut:fin])
        ]
    return resultat


def verifie_longueurs_par_longueur(where, choices, longueur_bonne, problems, langue):
    """Meme controle que verifie_longueurs, quand on connait la longueur de
    la bonne reponse mais pas sa position."""
    longueurs = [len(choice) for choice in choices]
    if max(longueurs) < LONGUEUR_SEUIL:
        return
    meilleure_mauvaise = max(l for l in longueurs if l != longueur_bonne) \
        if longueur_bonne in longueurs else max(longueurs)
    if longueur_bonne > meilleure_mauvaise:
        problems.append(
            '%s [%s] : la bonne reponse est la plus longue (%d car. contre %d) '
            '— raccourcis-la ou allonge une mauvaise' % (where, langue, longueur_bonne, meilleure_mauvaise))
    elif longueur_bonne == meilleure_mauvaise:
        problems.append(
            '%s [%s] : la bonne reponse fait la meme longueur qu\'une mauvaise '
            '(%d car.) — a egalite, l\'eleve tire a pile ou face' % (where, langue, longueur_bonne))


def verifie_longueurs(where, choices, correct, problems, langue):
    """Ajoute un probleme si la bonne reponse est la plus longue.

    On ne signale que les cas ou la longueur peut servir de raccourci : des
    propositions de trois caracteres (« NX », « TCP ») ont des ecarts sans
    signification.
    """
    longueurs = [len(choice) for choice in choices]
    if max(longueurs) < LONGUEUR_SEUIL:
        return
    bonne = longueurs[correct]
    meilleure_mauvaise = max(l for i, l in enumerate(longueurs) if i != correct)
    if bonne > meilleure_mauvaise:
        problems.append(
            '%s [%s] : la bonne reponse est la plus longue (%d car. contre %d) '
            '— raccourcis-la ou allonge une mauvaise' % (where, langue, bonne, meilleure_mauvaise))
    elif bonne == meilleure_mauvaise:
        problems.append(
            '%s [%s] : la bonne reponse fait la meme longueur qu\'une mauvaise '
            '(%d car.) — a egalite, l\'eleve tire a pile ou face' % (where, langue, bonne))


I18N_FILE = os.path.join(
    ROOT, 'wp-content', 'plugins', 'secura-academy', 'includes', 'i18n', 'en-univ.php')

CHOICE_LINE = re.compile(r"^\s*'choices'\s*=>\s*array\(\s*$")


def propositions_anglaises(chemin):
    """Lit les propositions anglaises dans le fichier PHP livre.

    On ne peut pas passer par PHP : check.py tourne dans l'integration
    continue sans WordPress ni base. On lit donc la source, qui est ecrite
    par machine (une proposition par ligne) — c'est une contrainte de format,
    pas une heuristique : si elle casse, le controle le dit au lieu de
    mesurer faux.

    Retour : liste de dicts {'cle', 'propositions', 'correct'}.
    """
    if not os.path.exists(chemin):
        return []

    with io.open(chemin, encoding='utf-8') as handle:
        lignes = handle.read().split('\n')

    rooms, courante, ordre = {}, None, []
    i = 0
    while i < len(lignes):
        ligne = lignes[i]

        partie = re.match(r"^\t'([a-z0-9-]+)' => array\($", ligne)
        if partie:
            courante = partie.group(1)
            rooms[courante] = []
            ordre.append(courante)

        if courante and CHOICE_LINE.match(ligne):
            propositions = []
            i += 1
            while i < len(lignes) and not re.match(r'^\s*\),\s*$', lignes[i]):
                contenu = re.match(r"^\s*(?:'((?:[^'\\]|\\.)*)'|'((?:[^'\\]|\\.)*)'),\s*$", lignes[i])
                if contenu:
                    texte = contenu.group(1) if contenu.group(1) is not None else contenu.group(2)
                    propositions.append(texte.replace("\\'", "'").replace('\\\\', '\\'))
                else:
                    propositions = None
                    break
                i += 1
            if propositions:
                rooms[courante].append(propositions)

        i += 1

    return [(cle, rooms[cle]) for cle in ordre]


CONTENU_PHP = os.path.join(
    ROOT, 'wp-content', 'plugins', 'secura-academy', 'includes', 'content-universites.php')

ROOMS_PHP = os.path.join(
    ROOT, 'wp-content', 'plugins', 'secura-academy', 'includes', 'class-secura-rooms.php')


def cles_univ(rooms_univ, problems):
    """Reconstruit les cles `univ-NN` comme le fait l'installation.

    L'ordre des blocs est celui de `$blocs` dans class-secura-rooms.php ;
    `univ` y est le troisieme bloc, donc la numerotation repart a 01 pour la
    premiere room universitaire. On ne retrouve pas tout seul le numero du
    bloc : on demande au fichier quels blocs existent, et on prend l'index de
    `univ`. Si la lecture echoue, on le dit — mieux vaut un controle muet
    qu'un controle faux.
    """
    if not os.path.exists(ROOMS_PHP):
        problems.append('class-secura-rooms.php introuvable : cle des rooms inconnue')
        return []
    with io.open(ROOMS_PHP, encoding='utf-8') as handle:
        source = handle.read()
    bloc = BLOC_KEY.search(source)
    if not bloc:
        problems.append('liste $blocs illisible : cle des rooms inconnue')
        return []
    noms = BLOC_ENTRY.findall(bloc.group(1))
    if 'univ' not in noms:
        problems.append('bloc « univ » absent de $blocs')
        return []
    prefixe = 'univ'
    return ['%s-%02d' % (prefixe, index + 1) for index in range(len(rooms_univ))]


def lab_flags_folder(room):
    """Le dossier du lab ou se trouvent les drapeaux de cette room."""

    lab = room.get('lab', {})

    if lab.get('mode') == 'compose':
        compose = lab.get('compose', '')
        return os.path.join(ROOT, 'labs', os.path.dirname(compose), 'flags')

    image = lab.get('image', 'securalabs/univ-01:1.0')
    nom = image.split('/')[-1].split(':')[0]

    return os.path.join(ROOT, 'labs', nom, 'flag')


def main():
    sys.path.insert(0, HERE)
    problems = []
    ids = []
    total_fr = 0
    gagnees_fr = 0

    verified = {}
    if os.path.exists(VERIFIED):
        with io.open(VERIFIED, encoding='utf-8') as handle:
            data = json.load(handle)
        entries = data.get('videos', data) if isinstance(data, dict) else data
        for entry in entries:
            if isinstance(entry, dict) and entry.get('id'):
                verified[entry['id']] = entry

    rooms = []
    rooms_univ = []
    for name in MODULES:
        path = os.path.join(HERE, name + '.py')
        if not os.path.exists(path):
            problems.append('fichier manquant : %s.py' % name)
            continue
        with io.open(path, encoding='utf-8') as handle:
            raw = handle.read()
        for match in SUSPECT.finditer(raw):
            problems.append('%s.py : caractere suspect %r' % (name, match.group(0)))
        for match in LATIN_IN_ARABIC.finditer(raw):
            context = raw[max(0, match.start() - 30):match.end() + 30].replace('\n', ' ')
            if ' و' in context or 'SOP' in context or 'CSRF' in context:
                continue
            problems.append('%s.py : melange de scripts %r' % (name, match.group(0)))
        module = __import__(name)
        rooms.extend(module.ROOMS)
        # Les rooms de CE depot sont toutes universitaires : c'est ce
        # generateur qui les produit. La meme liste, dans le meme ordre.
        rooms_univ.extend(module.ROOMS)

    seen = set()
    for room in rooms:
        title = room.get('title', '(sans titre)')
        for key in REQUIRED:
            if key not in room:
                problems.append('%s : cle manquante %s' % (title, key))
        if title in seen:
            problems.append('titre en double : %s' % title)
        seen.add(title)

        video = room.get('video', {})
        for key in VIDEO_KEYS:
            if not video.get(key):
                problems.append('%s : video sans %s' % (title, key))
        video_id = video.get('id', '')
        ids.append(video_id)
        if not re.match(r'^[A-Za-z0-9_-]{11}$', video_id or ''):
            problems.append('%s : identifiant de video invalide %r' % (title, video_id))
        if verified and video_id not in verified:
            problems.append('%s : video non verifiee (%s)' % (title, video_id))

        for label, questions in (('entrainement', room.get('practice', [])), ('examen', room.get('exam', []))):
            if len(questions) < 2:
                problems.append('%s : %s trop court' % (title, label))
            for number, question in enumerate(questions):
                where = '%s / %s q%d' % (title, label, number + 1)
                if not question.get('q'):
                    problems.append('%s : question vide' % where)
                choices = question.get('choices', [])
                if len(choices) != 4:
                    problems.append('%s : %d propositions (4 attendues)' % (where, len(choices)))
                if len(set(choices)) != len(choices):
                    problems.append('%s : propositions repetees' % where)
                correct = question.get('correct')
                if not isinstance(correct, int) or correct < 0 or correct >= len(choices):
                    problems.append('%s : index correct invalide' % where)
                if not question.get('explain'):
                    problems.append('%s : explication manquante' % where)
                if not question.get('hint'):
                    problems.append('%s : indice manquant' % where)
                for field in ('q', 'hint', 'explain'):
                    text = question.get(field, '')
                    if isinstance(text, str) and ENGLISH.search(text):
                        problems.append('%s : %s semble redige en anglais' % (where, field))
                    if field == 'q':
                        for choice in choices:
                            if ENGLISH.search(choice):
                                problems.append('%s : proposition en anglais' % where)
                                break

                # Le raccourci de longueur, en francais. En anglais, il est
                # verifie plus bas, contre le fichier de traduction.
                # La longueur se mesure PLUS BAS, sur le fichier livre : ici
                # on ne voit que les sources, et build.py a deplace la bonne
                # reponse depuis. Mesurer ici donnait 190 alertes fantomes.

        mission = room.get('mission', {})
        if not mission.get('prompt'):
            problems.append('%s : mission incomplete (prompt)' % title)

        preuves = mission.get('questions') or [mission]
        dossier = lab_flags_folder(room)

        for preuve in preuves:
            for key in ('question', 'flag_path', 'hint', 'explain'):
                if not preuve.get(key):
                    problems.append('%s : mission incomplete (%s)' % (title, key))
            chemin = str(preuve.get('flag_path', ''))
            if not chemin.startswith('/root/flags/'):
                problems.append('%s : chemin de drapeau inattendu %r' % (title, chemin))
            elif dossier and not os.path.isfile(os.path.join(dossier, os.path.basename(chemin))):
                problems.append('%s : drapeau absent du lab (%s)' % (title, os.path.basename(chemin)))

        i18n = room.get('i18n', {})
        for lang in ('ar', 'en'):
            if lang not in i18n:
                problems.append('%s : traduction %s manquante' % (title, lang))
                continue
            tr = i18n[lang]
            if not tr.get('title') or not tr.get('excerpt'):
                problems.append('%s : traduction %s incomplete' % (title, lang))
            if len(tr.get('tasks', [])) != 4:
                problems.append('%s : traduction %s : 4 titres de taches attendus' % (title, lang))

    # LE RACCOURCI DE LONGUEUR, VU EN ANGLAIS.
    #
    # Les propositions anglaises ne sont pas dans les sources : elles vivent
    # dans le fichier livre, en face des cles de room. On mesure donc le
    # fichier livre tel qu'il est, room par room, dans l'ordre ou les
    # propositions apparaissent. Une room dont le nombre de blocs ne tombe
    # pas juste fait SIGNALER le decalage au lieu de comparer au hasard.

    cles = cles_univ(rooms_univ, problems)
    if len(cles) != len(rooms_univ):
        problems.append('%d cles pour %d rooms universitaires' % (len(cles), len(rooms_univ)))
    else:
        for cle, room in zip(cles, rooms_univ):
            ROOM_QUESTIONS[cle] = list(room.get('practice', []) + room.get('exam', []))

    # --- Le raccourci de longueur, en francais, sur le contenu LIVRE. ---
    total_fr = 0
    gagnees_fr = 0
    for cle, questions_livrees in questions_du_php(CONTENU_PHP).items():
        for question in questions_livrees:
            total_fr += 1
            if gagnee_a_la_longueur(question['choices'], question['correct']):
                gagnees_fr += 1
            verifie_longueurs('%s / %s' % (cle, question['q'][:40]), question['choices'],
                              question['correct'], problems, 'fr')

    index_php = index_corrects_du_php(CONTENU_PHP)
    total_en = 0
    gagnees_en = 0
    for cle, blocs in propositions_anglaises(I18N_FILE):
        attendues = ROOM_QUESTIONS.get(cle, [])

        if len(blocs) != len(attendues):
            problems.append(
                '%s [en] : %d blocs de propositions pour %d questions — '
                'le fichier de traduction ne suit plus le contenu'
                % (cle, len(blocs), len(attendues)))
            continue

        for number, (propositions, question_source) in enumerate(zip(blocs, attendues)):
            intitule = question_source.get('q', '')[:40]
            total_en += 1
            if number >= len(index_php.get(cle, [])):
                problems.append('%s [en] : index correct introuvable dans le PHP' % intitule)
                continue
            correct_fichier = index_php[cle][number]
            if not 0 <= correct_fichier < len(propositions):
                problems.append('%s [en] : index correct hors bornes' % intitule)
                continue
            # Comparer des LONGUEURS, pas des chaines : max() sur une liste
            # de chaines trie alphabetiquement, et comptait donc n'importe
            # quoi (38 au lieu de 126 lors du premier essai).
            if len(propositions[correct_fichier]) >= max(len(p) for p in propositions):
                gagnees_en += 1
            verifie_longueurs(('%s / %s' % (cle, intitule)), propositions,
                              correct_fichier, problems, 'en')

    print('longueur [fr] : %d question(s) mesuree(s), %d gagnable(s) a la longueur'
          % (total_fr, gagnees_fr))
    print('longueur [en] : %d question(s) mesuree(s), %d gagnable(s) a la longueur'
          % (total_en, gagnees_en))

    # Le meme chiffre, room par room : c'est la liste de travail. On la trie
    # par gravite, pour commencer par les rooms ou l'epreuve ne mesure rien.
    par_room = {}
    for cle, questions_livrees in questions_du_php(CONTENU_PHP).items():
        gagnees = sum(1 for q in questions_livrees
                      if gagnee_a_la_longueur(q['choices'], q['correct']))
        if gagnees:
            par_room[cle] = (gagnees, len(questions_livrees))
    if par_room:
        print('\nrooms a reprendre (%d) :' % len(par_room))
        for cle, (gagnees, total) in sorted(par_room.items(), key=lambda x: -x[1][0]):
            print('  %-8s %2d question(s) gagnable(s) sur %2d' % (cle, gagnees, total))

    print('rooms : %d' % len(rooms))
    print('videos : %d (identifiants uniques : %d)' % (len(ids), len(set(ids))))
    total_questions = 0

    for room in rooms:
        mission = room.get('mission', {})
        preuves = mission.get('questions') or ([mission] if mission else [])
        total_questions += len(room.get('practice', [])) + len(room.get('exam', [])) + len(preuves)

    print('questions : %d' % total_questions)

    if problems:
        print('\n%d probleme(s) :' % len(problems))
        for problem in problems:
            print(' -', problem)
        return 1

    print('\nOK : tout est coherent.')
    return 0


if __name__ == '__main__':
    sys.exit(main())
