#!/usr/bin/env python3
"""Controle de qualite du contenu « Les universites ».

Verifie, avant de generer le PHP :
  - la structure de chaque room (cles obligatoires) ;
  - chaque question : 4 propositions, un seul index correct, une explication ;
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

    verified = {}
    if os.path.exists(VERIFIED):
        with io.open(VERIFIED, encoding='utf-8') as handle:
            data = json.load(handle)
        entries = data.get('videos', data) if isinstance(data, dict) else data
        for entry in entries:
            if isinstance(entry, dict) and entry.get('id'):
                verified[entry['id']] = entry

    rooms = []
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
