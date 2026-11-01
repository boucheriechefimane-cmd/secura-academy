#!/usr/bin/env python3
"""Fabrique le fichier de contenu « Les universites » du plugin Secura Academy.

Le contenu est ecrit ici (et non dans le PHP) pour que la relecture et la
mise a jour soient simples : on edite un fichier Python, on relance le
generateur, on verifie le PHP.

Sortie : wp-content/plugins/secura-academy/includes/content-universites.php

Regles :
  - le texte est ORIGINAL (aucune reprise de cours existant) ;
  - les videos citees sont celles verifiees dans tools/videos/ (oEmbed) ;
  - chaque question a UNE seule bonne reponse ;
  - la mission se valide par un drapeau lu dans la machine de l'apprenant.

Usage : python3 build.py
"""
import io
import os
import sys

HERE = os.path.dirname(os.path.abspath(__file__))
ROOT = os.path.abspath(os.path.join(HERE, '..', '..'))
OUT = os.path.join(
    ROOT,
    'wp-content', 'plugins', 'secura-academy', 'includes', 'content-universites.php',
)

sys.path.insert(0, HERE)

import rooms_mit858      # noqa: E402
import rooms_mit857      # noqa: E402
import rooms_pwn         # noqa: E402
import rooms_cyber       # noqa: E402
import rooms_owasp       # noqa: E402
import rooms_stanford
import rooms_m7    # noqa: E402

BLOCKS = [
    ('MIT 6.858 — Computer Systems Security (Fall 2014)', rooms_mit858.ROOMS),
    ('MIT 6.857 — Network and Computer Security', rooms_mit857.ROOMS),
    ('pwn.college — Arizona State University', rooms_pwn.ROOMS),
    ('CYBER.ORG — Cybersecurity & Infrastructure Security Education', rooms_cyber.ROOMS),
    ('OWASP Foundation', rooms_owasp.ROOMS),
    ('Stanford — Engineering Everywhere (SEE)', rooms_stanford.ROOMS),
    ('M7 — Les labs avancés (Juice Shop, dojo, briefs, Kahoot)', rooms_m7.ROOMS),
]


def php_str(value):
    """Chaine PHP en apostrophes simples."""
    if value is None:
        return "''"
    text = str(value)
    text = text.replace('\\', '\\\\').replace("'", "\\'")
    return "'" + text + "'"


def php_list(items, indent):
    pad = '\t' * indent
    out = []
    for item in items:
        out.append(pad + php_str(item) + ',')
    return '\n'.join(out)


def rebalance(questions, offset=0):
    """Répartit les bonnes réponses sur les quatre positions.

    Sans cela, toutes les bonnes réponses d'une room finiraient à la même
    place : l'apprenant apprendrait la position, pas la notion. On ne
    touche pas au texte : on déplace la bonne proposition.
    """
    total = len(questions)
    result = []

    for index, question in enumerate(questions):
        choices = list(question['choices'])
        correct = int(question['correct'])

        if correct < 0 or correct >= len(choices):
            result.append(question)
            continue

        target = (offset + index) % 4

        if target != correct:
            good = choices[correct]
            others = [choice for position, choice in enumerate(choices) if position != correct]
            others.insert(target, good)
            question = dict(question)
            question['choices'] = others
            question['correct'] = target

        result.append(question)

    return result


def render_question(question, indent, index):
    pad = '\t' * indent
    lines = []
    lines.append(pad + 'array(')
    lines.append(pad + "\t'question' => " + php_str(question['q']) + ',')
    lines.append(pad + "\t'mode' => 'choice',")
    lines.append(pad + "\t'choices' => array(")
    lines.append(php_list(question['choices'], indent + 2))
    lines.append(pad + '\t),')
    lines.append(pad + "\t'correct' => %d," % int(question['correct']))
    lines.append(pad + "\t'xp' => %d," % int(question.get('xp', 10)))
    lines.append(pad + "\t'hint' => " + php_str(question.get('hint', '')) + ',')
    lines.append(pad + "\t'explanation' => " + php_str(question.get('explain', '')) + ',')
    lines.append(pad + '),')
    return '\n'.join(lines)


def render_room(room, room_index=0):
    room = dict(room)
    room['practice'] = rebalance(room['practice'], room_index % 4)
    room['exam'] = rebalance(room['exam'], (room_index + 1) % 4)

    lines = []
    lines.append('array(')
    lines.append("\t'title' => " + php_str(room['title']) + ',')
    lines.append("\t'excerpt' => " + php_str(room['excerpt']) + ',')
    lines.append("\t'content' => " + php_str(room.get('content', '')) + ',')
    lines.append("\t'difficulty' => " + php_str(room.get('difficulty', 'moyen')) + ',')
    lines.append("\t'duration' => %d," % int(room.get('duration', 30)))
    lines.append("\t'xp_bonus' => %d," % int(room.get('xp_bonus', 40)))
    lines.append("\t'track' => " + php_str(room.get('track', 'universites')) + ",")
    lines.append("\t'lab' => array(")
    lines.append("\t\t'enabled' => 1,")
    lines.append("\t\t'driver' => 'auto',")

    lab = room.get('lab', {})

    lines.append("\t\t'mode' => " + php_str(lab.get('mode', 'single')) + ",")
    lines.append("\t\t'image' => " + php_str(lab.get('image', 'securalabs/univ-01:1.0')) + ",")

    if lab.get('mode') == 'compose':
        lines.append("\t\t'compose' => " + php_str(lab.get('compose', '')) + ",")
        lines.append("\t\t'project' => " + php_str(lab.get('project', '')) + ",")
        lines.append("\t\t'flag_service' => " + php_str(lab.get('flag_service', '')) + ",")

    lines.append("\t\t'network' => " + php_str(lab.get('network', 'seca_lab')) + ",")
    lines.append("\t\t'command' => " + php_str(lab.get('command', 'sleep infinity')) + ",")
    lines.append("\t\t'workdir' => " + php_str(lab.get('workdir', '/home/ctf')) + ",")
    lines.append("\t\t'target' => " + php_str(lab.get('target', 'http://127.0.0.1:8080')) + ",")
    lines.append("\t\t'ttl' => %d," % int(lab.get('ttl', 3600)))
    lines.append("\t\t'allow' => array( " + ', '.join("'%s'" % item for item in lab.get('allow', ['ls', 'cat', 'grep', 'head', 'tail', 'wc', 'find', 'file', 'stat', 'strings'])) + " ),")
    lines.append('\t),')

    video = room['video']
    lines.append("\t'video' => array(")
    lines.append("\t\t'id' => " + php_str(video['id']) + ',')
    lines.append("\t\t'title' => " + php_str(video['title']) + ',')
    lines.append("\t\t'channel' => " + php_str(video['channel']) + ',')
    lines.append("\t\t'institution' => " + php_str(video['institution']) + ',')
    lines.append("\t\t'license' => " + php_str(video['license']) + ',')
    lines.append("\t\t'duration' => " + php_str(video.get('duration', '')) + ',')
    lines.append("\t\t'note' => " + php_str(video.get('note', '')) + ',')
    lines.append('\t),')

    lines.append("\t'tasks' => array(")

    # Task 1 : la lecon (le cours de l'universite est dans la video).
    lines.append("\t\tarray(")
    lines.append("\t\t\t'type' => 'lesson',")
    lines.append("\t\t\t'format' => 'lecon',")
    lines.append("\t\t\t'title' => " + php_str(room['lesson_title']) + ',')
    lines.append("\t\t\t'content' => " + php_str(room['lesson']) + ',')
    lines.append("\t\t\t'questions' => array(),")
    lines.append('\t\t),')

    # Task 2 : l'entrainement.
    lines.append("\t\tarray(")
    lines.append("\t\t\t'type' => 'practice',")
    lines.append("\t\t\t'format' => 'qcm',")
    lines.append("\t\t\t'title' => " + php_str(room['practice_title']) + ',')
    lines.append("\t\t\t'content' => " + php_str(room['practice_intro']) + ',')
    lines.append("\t\t\t'questions' => array(")
    for index, question in enumerate(room['practice']):
        lines.append(render_question(question, 4, index))
    lines.append('\t\t\t),')
    lines.append('\t\t),')

    # Task 3 : la mission (preuve lue dans la machine).
    mission = room['mission']
    preuves = mission.get('questions') or [mission]

    lines.append("\t\tarray(")
    lines.append("\t\t\t'type' => 'test',")
    lines.append("\t\t\t'format' => 'pratique',")
    lines.append("\t\t\t'title' => " + php_str(room['mission_title']) + ',')
    lines.append("\t\t\t'content' => " + php_str(mission['prompt']) + ',')
    lines.append("\t\t\t'questions' => array(")

    for preuve in preuves:
        lines.append("\t\t\t\tarray(")
        lines.append("\t\t\t\t\t'question' => " + php_str(preuve['question']) + ',')
        lines.append("\t\t\t\t\t'mode' => 'flag',")
        lines.append("\t\t\t\t\t'flag_path' => " + php_str(preuve['flag_path']) + ',')
        lines.append("\t\t\t\t\t'xp' => %d," % int(preuve.get('xp', 30)))
        lines.append("\t\t\t\t\t'hint' => " + php_str(preuve.get('hint', '')) + ',')
        lines.append("\t\t\t\t\t'explanation' => " + php_str(preuve.get('explain', '')) + ',')
        lines.append('\t\t\t\t),')

    lines.append("\t\t\t),")
    lines.append('\t\t),')

    # Task 4 : l'examen.
    lines.append("\t\tarray(")
    lines.append("\t\t\t'type' => 'exam',")
    lines.append("\t\t\t'format' => 'qcm',")
    lines.append("\t\t\t'title' => " + php_str(room['exam_title']) + ',')
    lines.append("\t\t\t'content' => " + php_str(room.get('exam_intro', '')) + ',')
    lines.append("\t\t\t'time_limit' => %d," % int(room.get('exam_time', 300)))
    lines.append("\t\t\t'pass_score' => %d," % int(room.get('pass_score', 60)))
    lines.append("\t\t\t'questions' => array(")
    for index, question in enumerate(room['exam']):
        lines.append(render_question(question, 4, index))
    lines.append('\t\t\t),')
    lines.append('\t\t),')

    lines.append('\t),')

    # Le bloc Kahoot (facultatif) : le quiz a lancer en classe.
    if room.get('kahoot'):
        kahoot = room['kahoot']
        lines.append("\t'kahoot' => array(")
        lines.append("\t\t'title' => " + php_str(kahoot.get('title', '')) + ',')
        lines.append("\t\t'intro' => " + php_str(kahoot.get('intro', '')) + ',')
        lines.append("\t\t'link' => " + php_str(kahoot.get('link', '')) + ',')
        lines.append("\t\t'code' => " + php_str(kahoot.get('code', '')) + ',')
        lines.append('\t),')

    # Traductions (titre, extrait, titres de taches) comme pour les scenarios M3.
    lines.append("\t'i18n' => array(")
    for lang in ('ar', 'en'):
        tr = room['i18n'][lang]
        lines.append("\t\t%s => array(" % php_str(lang))
        lines.append("\t\t\t'title' => " + php_str(tr['title']) + ',')
        lines.append("\t\t\t'excerpt' => " + php_str(tr['excerpt']) + ',')
        lines.append("\t\t\t'tasks' => array(")
        for task_title in tr['tasks']:
            lines.append("\t\t\t\tarray( 'title' => " + php_str(task_title) + ' ),')
        lines.append('\t\t\t),')
        lines.append('\t\t),')
    lines.append('\t),')

    lines.append('),')
    return '\n'.join(lines)


def render_function(name, doc, blocks):
    """Genere une fonction PHP qui renvoie les rooms d'une liste de blocs."""

    lines = []
    lines.append('/**')
    lines.append(' * %s' % doc)
    lines.append(' *')
    lines.append(' * @return array[]')
    lines.append(' */')
    lines.append('function %s() {' % name)
    lines.append('\treturn array(')

    for titre, rooms in blocks:
        lines.append('/* =====================================================================')
        lines.append(' * %s' % titre)
        lines.append(' * ================================================================== */')
        lines.append('')

        for index, room in enumerate(rooms):
            lines.append(render_room(room, index))
            lines.append('')

    lines.append('\t);')
    lines.append('}')

    return '\n'.join(lines)


def main():
    header = '''<?php
/**
 * Les vingt-deux rooms « Les universites ».
 *
 * Chaque room reprend une notion d'un cours reellement gratuit et ouvert :
 * MIT 6.858, MIT 6.857, pwn.college, CYBER.ORG, OWASP et Stanford.
 *
 * Trois principes :
 *
 * 1. Le texte est ORIGINAL. On n'a pas recopie un cours : on ecrit notre
 *    version courte, concrete, et on renvoie vers la video du professeur
 *    (chargee au clic) pour la version longue et officielle.
 * 2. La mission ne se valide pas avec une phrase : le serveur lit le
 *    drapeau dans la machine de l'apprenant (`labs/univ-01`), en root.
 * 3. Chaque video est attribuee (institution, auteur, licence) juste sous
 *    la facade, et le lien vers la source reste toujours visible.
 *
 * Fichier genere par `tools/contenu-universites/build.py` : on edite les
 * fichiers de ce dossier, puis on relance le generateur.
 *
 * @package Secura_Academy
 */

defined( 'ABSPATH' ) || exit;
'''

    universites = [(titre, rooms) for titre, rooms in BLOCKS if titre.startswith('M7') is False]
    avance = [(titre, rooms) for titre, rooms in BLOCKS if titre.startswith('M7')]

    corps_universites = render_function(
        'seca_default_rooms_universites',
        'Les vingt-deux rooms « Les universites ».',
        universites
    )

    corps_avance = render_function(
        'seca_default_rooms_avance',
        'Les quatorze rooms des labs avances (M7).',
        avance
    )

    text = header + corps_universites + '\n\n' + corps_avance + '\n'
    with io.open(OUT, 'w', encoding='utf-8') as handle:
        handle.write(text)

    total = sum(len(rooms) for _, rooms in BLOCKS)
    questions = 0
    for _, rooms in BLOCKS:
        for room in rooms:
            mission = room.get('mission', {})
            preuves = mission.get('questions') or ([mission] if mission else [])
            questions += len(room['practice']) + len(room['exam']) + len(preuves)
    print('ecrit : %s' % OUT)
    print('rooms : %d | questions : %d' % (total, questions))


if __name__ == '__main__':
    main()
