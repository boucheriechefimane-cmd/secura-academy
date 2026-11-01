# -*- coding: utf-8 -*-
"""
Transforme le contenu M3 :
  1. corrige les caracteres parasites ;
  2. transforme les questions « texte » des taches Entrainement et Examen
     en QCM a une seule bonne reponse (mode « choice ») ;
  3. regenere includes/content-m3.php proprement.
"""
import json
import pathlib
import re
import sys

sys.path.insert(0, '/home/user')
from m3_qcm_table import TABLE  # noqa: E402

SRC = pathlib.Path('/home/user/secura-academy/wp-content/plugins/secura-academy/includes/content-m3.php')
JSON_IN = pathlib.Path('/tmp/m3.json')

# ---------------------------------------------------------------- correctifs
FIXES = [
    ('uneTicket', 'un ticket'),
    ('baliseEvenement', "balise d'evenement"),
    ('caracteres speatifs', 'caracteres speciaux'),
    ('tuReflects', 'tu reflects'),
    ('tu Reflects', 'tu reflects'),
    ('La保密 repose', 'La reponse repose'),
    ('un拽 probleme', 'un vrai probleme'),
    ('les和环境 d\'equilibrage', "les environnements d'equilibrage"),
    ("الملف الذي كان shouldn\\'t يبقى", "الملف الذي كان يجب ألا يبقى"),
    ('une requete qui succeeds', 'une requete qui aboutit'),
    ("Many 401 et un 200", 'Plusieurs 401 puis un 200'),
    ('Des 401 puis un 200', 'Plusieurs 401 puis un 200'),
    ('Une suite de 401 et un 200', 'Plusieurs 401 puis un 200'),
]


def fix_text(value):
    if isinstance(value, str):
        for old, new in FIXES:
            value = value.replace(old, new)
        return value
    if isinstance(value, list):
        return [fix_text(v) for v in value]
    if isinstance(value, dict):
        return {k: fix_text(v) for k, v in value.items()}
    return value


# ------------------------------------------------------------- serialisation
def php_string(text):
    text = text.replace('\\', '\\\\')
    text = text.replace("'", "\\'")
    return "'" + text + "'"


def php_value(value, indent):
    pad = '\t' * indent
    if isinstance(value, bool):
        return '1' if value else '0'
    if isinstance(value, int):
        return str(value)
    if isinstance(value, float):
        return str(value)
    if isinstance(value, str):
        return php_string(value)
    if isinstance(value, list):
        return php_array(value, indent)
    if isinstance(value, dict):
        return php_array(value, indent)
    return 'null'


def php_array(value, indent):
    pad = '\t' * indent
    inner = '\t' * (indent + 1)
    if not value:
        return 'array()'
    # liste de scalaires courte : sur une seule ligne
    if isinstance(value, list) and all(not isinstance(v, (list, dict)) for v in value):
        if len(value) <= 8:
            return 'array( ' + ', '.join(php_value(v, indent) for v in value) + ' )'
        lines = [inner + php_value(v, indent + 1) + ',' for v in value]
        return 'array(\n' + '\n'.join(lines) + '\n' + pad + ')'
    lines = []
    if isinstance(value, list):
        for item in value:
            lines.append(inner + php_value(item, indent + 1) + ',')
    else:
        for key, item in value.items():
            lines.append(inner + php_string(key) + ' => ' + php_value(item, indent + 1) + ',')
    return 'array(\n' + '\n'.join(lines) + '\n' + pad + ')'


def ordered(mapping, order):
    """Remet les cles dans l'ordre du modele, les autres a la fin."""
    out = {}
    for key in order:
        if key in mapping:
            out[key] = mapping[key]
    for key, value in mapping.items():
        if key not in out:
            out[key] = value
    return out


ROOM_ORDER = ['title', 'excerpt', 'content', 'difficulty', 'duration', 'xp_bonus',
              'track', 'lab', 'tasks', 'terminal', 'i18n']
LAB_ORDER = ['enabled', 'driver', 'mode', 'image', 'service', 'compose', 'project',
             'network', 'command', 'workdir', 'target', 'ttl', 'allow', 'deny',
             'user', 'memory', 'cpus', 'pids']
TASK_ORDER = ['type', 'format', 'title', 'content', 'time_limit', 'pass_score',
              'questions', 'terminal']
Q_ORDER = ['question', 'mode', 'flag_path', 'choices', 'correct', 'xp', 'hint',
           'explanation']
TERM_ORDER = ['intro', 'unknown', 'success', 'steps']
STEP_ORDER = ['match', 'output', 'hint']

HEADER = """<?php
/**
 * Les dix scenarios M3 — dix missions jouables, une par semaine.
 *
 * Chaque scenario part d'une situation que n'importe quel apprenant peut
 * rencontrer (un service qui ne repond plus, un mot de passe oublie, une
 * page qui se trahit), puis demande d'agir sur une vraie machine et de
 * rapporter une preuve : le drapeau.
 *
 * Le drapeau n'est PAS un texte a recopier : il est verifie par le
 * serveur, qui va le lire dans la machine de l'apprenant. On ne peut pas
 * valider l'etape sans l'avoir vraiment trouve.
 *
 * Une seule image sert plusieurs scenarios (multi-01) : c'est ce qui rend
 * le contenu tenable dans le temps.
 *
 * Les questions d'entrainement et d'examen sont de vrais QCM : une seule
 * bonne reponse par question, les distracteurs etant de vraies erreurs
 * d'apprenant (et non des reformulations de la bonne reponse).
 *
 * @package Secura_Academy
 */

defined( 'ABSPATH' ) || exit;

/**
 * Les dix scenarios M3.
 *
 * @return array[]
 */
function seca_default_rooms_m3() {
\treturn array(
"""

FOOTER = "\t);\n}\n"


def render(rooms):
    blocks = []
    for room in rooms:
        room = ordered(room, ROOM_ORDER)
        if 'lab' in room:
            room['lab'] = ordered(room['lab'], LAB_ORDER)
        new_tasks = []
        for task in room['tasks']:
            task = ordered(task, TASK_ORDER)
            new_questions = []
            for question in task.get('questions', []):
                if 'explication' in question and 'explanation' not in question:
                    question['explanation'] = question.pop('explication')
                new_questions.append(ordered(question, Q_ORDER))
            task['questions'] = new_questions
            if 'terminal' in task and isinstance(task['terminal'], dict):
                term = ordered(task['terminal'], TERM_ORDER)
                if 'steps' in term:
                    term['steps'] = [ordered(s, STEP_ORDER) for s in term['steps']]
                task['terminal'] = term
            new_tasks.append(task)
        room['tasks'] = new_tasks
        if 'terminal' in room and isinstance(room['terminal'], dict):
            term = ordered(room['terminal'], TERM_ORDER)
            if 'steps' in term:
                term['steps'] = [ordered(s, STEP_ORDER) for s in term['steps']]
            room['terminal'] = term
        blocks.append(php_value(room, 2) + ',')
    return HEADER + '\n'.join(blocks) + FOOTER


# ------------------------------------------------------------------ pipeline
def main():
    rooms = json.loads(JSON_IN.read_text(encoding='utf-8'))
    rooms = fix_text(rooms)

    for room in rooms:
        room['track'] = 'm3'

    stats = {'qcm': 0, 'manque': []}
    for r_index, room in enumerate(rooms, 1):
        for task in room['tasks']:
            kind = task['type']
            letter = {'practice': 'P', 'exam': 'E', 'test': 'M'}.get(kind)
            if letter is None:
                continue
            for q_index, question in enumerate(task.get('questions', []), 1):
                if question.get('mode') == 'flag':
                    continue
                if kind == 'test':
                    continue
                key = (r_index, letter, q_index)
                entry = TABLE.get(key)
                if entry is None:
                    stats['manque'].append(key)
                    continue
                answers = question.pop('answers', [])
                if not answers:
                    stats['manque'].append(key)
                    continue
                correct = answers[0]
                choices = [correct] + list(entry['d'])
                # position de la bonne reponse : ni toujours 1, ni toujours la derniere
                position = (r_index * 7 + q_index * 3 + len(kind)) % 4
                shuffled = choices[position:] + choices[:position]
                question['mode'] = 'choice'
                question['choices'] = shuffled
                question['correct'] = shuffled.index(correct)
                if entry.get('q'):
                    question['question'] = entry['q']
                if entry.get('h'):
                    question['hint'] = entry['h']
                stats['qcm'] += 1

    if stats['manque']:
        print('SANS TABLE :', stats['manque'])

    SRC.write_text(render(rooms), encoding='utf-8')
    print('QCM convertis :', stats['qcm'])

    # verification
    rooms2 = json.loads(json.dumps(rooms))
    for room in rooms2:
        for task in room['tasks']:
            for question in task.get('questions', []):
                if question.get('mode') == 'choice':
                    choices = question['choices']
                    assert len(choices) == 4, question['question']
                    assert len(set(choices)) == 4, ('doublon', question['question'])
                    assert 0 <= question['correct'] < 4, question['question']
    print('controle interne OK')


if __name__ == '__main__':
    main()
