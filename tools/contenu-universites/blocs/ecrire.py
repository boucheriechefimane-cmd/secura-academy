#!/usr/bin/env python3
"""Ecrit un fichier de rooms PHP a partir de donnees Python.

POURQUOI CE SCRIPT EXISTE
-------------------------
Ecrire ces rooms a la main a coute six essais et trois fichiers casses : une
parenthese oubliee, et la room se retrouve avalee par la precedente. Le
fichier passe `php -l` sans broncher — il est syntaxiquement valide — mais la
fonction renvoie une room de moins. Un controle de syntaxe ne dit rien du
resultat : seule la lecture de ce que la fonction RENVOIE le dit.

Ce script produit le PHP a partir d'un dictionnaire. Il n'y a donc plus de
parenthese ecrite a la main, et l'indentation est calculee, pas tapee.

Usage :
    python3 ecrire.py <module> <chemin-de-sortie>

ou <module> expose  FONCTION (nom de la fonction PHP), ROOMS (liste) et
ENTETE (texte du commentaire d'en-tete).
"""
import importlib.util
import io
import os
import sys


def chaine(texte):
    """Chaine PHP en apostrophes simples."""
    return "'" + str(texte).replace('\\', '\\\\').replace("'", "\\'") + "'"


def ligne(indent, texte):
    return '\t' * indent + texte


def question_qcm(q, indent):
    l = [ligne(indent, 'array(')]
    l.append(ligne(indent + 1, "'question'    => %s," % chaine(q['question'])))
    l.append(ligne(indent + 1, "'mode'        => 'choice',"))
    if 'topic' in q:
        l.append(ligne(indent + 1, "'topic'       => %s," % chaine(q['topic'])))
    l.append(ligne(indent + 1, "'choices'     => array( %s ),"
                   % ', '.join(chaine(c) for c in q['choices'])))
    l.append(ligne(indent + 1, "'correct'     => %d," % q['correct']))
    l.append(ligne(indent + 1, "'xp'          => %d," % q.get('xp', 10)))
    if 'hint' in q:
        l.append(ligne(indent + 1, "'hint'        => %s," % chaine(q['hint'])))
    l.append(ligne(indent + 1, "'explanation' => %s," % chaine(q['explanation'])))
    l.append(ligne(indent, '),'))
    return l


def question_texte(q, indent):
    l = [ligne(indent, 'array(')]
    l.append(ligne(indent + 1, "'question'    => %s," % chaine(q['question'])))
    l.append(ligne(indent + 1, "'mode'        => 'text',"))
    if 'topic' in q:
        l.append(ligne(indent + 1, "'topic'       => %s," % chaine(q['topic'])))
    l.append(ligne(indent + 1, "'answers'     => array( %s ),"
                   % ', '.join(chaine(a) for a in q['answers'])))
    l.append(ligne(indent + 1, "'xp'          => %d," % q.get('xp', 20)))
    if 'hint' in q:
        l.append(ligne(indent + 1, "'hint'        => %s," % chaine(q['hint'])))
    l.append(ligne(indent + 1, "'explanation' => %s," % chaine(q['explanation'])))
    l.append(ligne(indent, '),'))
    return l


def terminal(term, indent):
    l = [ligne(indent, "'terminal' => array(")]
    l.append(ligne(indent + 1, "'intro'   => %s," % chaine(term['intro'])))
    l.append(ligne(indent + 1, "'unknown' => %s," % chaine(term['unknown'])))
    l.append(ligne(indent + 1, "'success' => %s," % chaine(term['success'])))
    l.append(ligne(indent + 1, "'steps'   => array("))
    for e in term['steps']:
        l.append(ligne(indent + 2, 'array('))
        l.append(ligne(indent + 3, "'match'  => array( %s ),"
                       % ', '.join(chaine(m) for m in e['match'])))
        l.append(ligne(indent + 3, "'output' => %s," % chaine(e['output'])))
        if 'hint' in e:
            l.append(ligne(indent + 3, "'hint'   => %s," % chaine(e['hint'])))
        l.append(ligne(indent + 2, '),'))
    l.append(ligne(indent + 1, '),'))
    l.append(ligne(indent, '),'))
    return l


def tache(t, indent):
    l = [ligne(indent, 'array(')]
    for cle in ('type', 'format'):
        if cle in t:
            l.append(ligne(indent + 1, "'%s'%s=> %s,"
                           % (cle, ' ' * (11 - len(cle)), chaine(t[cle]))))
    for cle in ('title', 'content'):
        if cle in t:
            l.append(ligne(indent + 1, "'%s'%s=> %s,"
                           % (cle, ' ' * (7 - len(cle)), chaine(t[cle]))))
    if 'time_limit' in t:
        l.append(ligne(indent + 1, "'time_limit' => %d," % t['time_limit']))
    if 'pass_score' in t:
        l.append(ligne(indent + 1, "'pass_score' => %d," % t['pass_score']))
    if t.get('questions'):
        l.append(ligne(indent + 1, "'questions' => array("))
        for q in t['questions']:
            l += (question_texte(q, indent + 2) if q.get('mode') == 'text'
                  else question_qcm(q, indent + 2))
        l.append(ligne(indent + 1, '),'))
    else:
        l.append(ligne(indent + 1, "'questions' => array(),"))
    if 'terminal' in t:
        l += terminal(t['terminal'], indent + 1)
    l.append(ligne(indent, '),'))
    return l


def tache_anglaise(t, indent):
    """Une tache traduite : titre, contenu, questions. Pas de terminal."""
    l = [ligne(indent, 'array(')]
    for cle in ('title', 'content'):
        if cle in t:
            l.append(ligne(indent + 1, "'%s'%s=> %s,"
                           % (cle, ' ' * (7 - len(cle)), chaine(t[cle]))))
    if t.get('questions'):
        l.append(ligne(indent + 1, "'questions' => array("))
        for q in t['questions']:
            l.append(ligne(indent + 2, 'array('))
            l.append(ligne(indent + 3, "'question'    => %s," % chaine(q['question'])))
            if q.get('mode') == 'text':
                l.append(ligne(indent + 3, "'answers'     => array( %s ),"
                               % ', '.join(chaine(a) for a in q['answers'])))
            else:
                l.append(ligne(indent + 3, "'choices'     => array( %s ),"
                               % ', '.join(chaine(c) for c in q['choices'])))
                l.append(ligne(indent + 3, "'correct'     => %d," % q['correct']))
            # Le controle de traduction exige un indice en anglais aussi.
            if 'hint' in q:
                l.append(ligne(indent + 3, "'hint'        => %s," % chaine(q['hint'])))
            l.append(ligne(indent + 3, "'explanation' => %s," % chaine(q['explanation'])))
            l.append(ligne(indent + 2, '),'))
        l.append(ligne(indent + 1, '),'))
    else:
        l.append(ligne(indent + 1, "'questions' => array(),"))
    l.append(ligne(indent, '),'))
    return l


def room(r, indent=3):
    l = [ligne(indent, 'array(')]
    for cle in ('title', 'excerpt', 'content', 'difficulty'):
        l.append(ligne(indent + 1, "'%s'%s=> %s,"
                       % (cle, ' ' * (12 - len(cle)), chaine(r[cle]))))
    l.append(ligne(indent + 1, "'duration'   => %d," % r['duration']))
    l.append(ligne(indent + 1, "'xp_bonus'   => %d," % r['xp_bonus']))
    l.append(ligne(indent + 1, "'track'      => %s," % chaine(r['track'])))
    l.append(ligne(indent + 1, "'source'     => array("))
    for cle in ('nom', 'url', 'licence', 'attribution'):
        l.append(ligne(indent + 2, "'%s'%s=> %s,"
                       % (cle, ' ' * (11 - len(cle)), chaine(r['source'][cle]))))
    l.append(ligne(indent + 1, '),'))
    l.append(ligne(indent + 1, "'tasks'      => array("))
    for t in r['tasks']:
        l += tache(t, indent + 2)
    l.append(ligne(indent + 1, '),'))
    en = r.get('en')
    if en:
        l.append(ligne(indent + 1, "'i18n'       => array("))
        l.append(ligne(indent + 2, "'en' => array("))
        l.append(ligne(indent + 3, "'title'   => %s," % chaine(en['title'])))
        l.append(ligne(indent + 3, "'excerpt' => %s," % chaine(en['excerpt'])))
        l.append(ligne(indent + 3, "'tasks'   => array("))
        for t in en['tasks']:
            l += tache_anglaise(t, indent + 4)
        l.append(ligne(indent + 3, '),'))
        l.append(ligne(indent + 2, '),'))
        l.append(ligne(indent + 1, '),'))
    l.append(ligne(indent, '),'))
    return l


def ecrire(module, sortie):
    entete = ['<?php', '/**'] + [' * ' + x if x else ' *'
                                 for x in module.ENTETE] + [' *', ' * @package Secura_Academy', ' */', '']
    corps = ["defined( 'ABSPATH' ) || exit;", '']
    corps.append('/**')
    corps.append(' * Les rooms du bloc.')
    corps.append(' *')
    corps.append(' * @return array[]')
    corps.append(' */')
    corps.append('function %s() {' % module.FONCTION)
    corps.append(ligne(1, 'return array('))
    for r in module.ROOMS:
        corps += room(r, 2)
    corps.append(ligne(1, ');'))
    corps.append('}')
    io.open(sortie, 'w', encoding='utf-8').write('\n'.join(entete + corps) + '\n')
    return len(module.ROOMS)


def charge(chemin):
    spec = importlib.util.spec_from_file_location('bloc', chemin)
    m = importlib.util.module_from_spec(spec)
    spec.loader.exec_module(m)
    return m


if __name__ == '__main__':
    if len(sys.argv) != 3:
        sys.exit(__doc__)
    total = ecrire(charge(sys.argv[1]), sys.argv[2])
    print("%d room(s) ecrite(s) dans %s" % (total, sys.argv[2]))
