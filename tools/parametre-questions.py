# -*- coding: utf-8 -*-
"""Ajoute des variantes paramétriques à des questions déjà rédigées.

Une question paramétrique s'écrit avec des {mots} à la place des chiffres
inventés : le moteur d'épreuves (Secura_Exam) y injecte les valeurs d'une
variante tirée au sort, ce qui change les chiffres d'une copie à l'autre.

Ce script réécrit les blocs de question concernés : il repart du bloc
existant (énoncé, propositions, indice, explication), remplace les nombres
par des {mots} et insère la clé 'variants'.
"""

import io
import re
import sys

FICHIER = 'wp-content/plugins/secura-academy/includes/content-universites.php'

# Un mot-clé qui identifie la question, les remplacements à faire dans
# l'énoncé / les propositions / l'explication, et les jeux de valeurs.
QUESTIONS = [
    {
        'mot': "dans un buffer de 32 octets",
        'remplacements': [("32", "{taille}")],
        'variants': [
            {'taille': '32'}, {'taille': '64'}, {'taille': '16'},
            {'taille': '128'}, {'taille': '48'},
        ],
    },
    {
        'mot': "alloue un buffer de 32 octets",
        'remplacements': [("32", "{taille}")],
        'variants': [
            {'taille': '32'}, {'taille': '64'}, {'taille': '16'},
            {'taille': '128'}, {'taille': '256'},
        ],
    },
    {
        'mot': "40 octets dans un buffer de 32",
        'remplacements': [("40", "{ecrit}"), ("32", "{taille}"), ("8", "{trop}"),
                         ("\u00e9crire au-del\u00e0", "\u00e9crire {trop} octets au-del\u00e0 des {taille} octets r\u00e9serv\u00e9s")],
        'variants': [
            {'taille': '32', 'ecrit': '40', 'trop': '8'},
            {'taille': '64', 'ecrit': '72', 'trop': '8'},
            {'taille': '16', 'ecrit': '24', 'trop': '8'},
            {'taille': '48', 'ecrit': '56', 'trop': '8'},
            {'taille': '128', 'ecrit': '140', 'trop': '12'},
        ],
    },
    {
        'mot': "doit contenir un nombre entre 1 et 99",
        'remplacements': [("(1..99)", "({min}..{max})"), ("entre 1 et 99", "entre {min} et {max}")],
        'variants': [
            {'min': '1', 'max': '99'}, {'min': '1', 'max': '999'},
            {'min': '0', 'max': '100'}, {'min': '10', 'max': '500'},
            {'min': '1', 'max': '49'},
        ],
    },
    {
        'mot': "de 2 To de photos",
        'remplacements': [("2 To", "{gros}"), ("10 Go", "{petit}")],
        'variants': [
            {'gros': '2 To', 'petit': '10 Go'}, {'gros': '5 To', 'petit': '20 Go'},
            {'gros': '1 To', 'petit': '8 Go'}, {'gros': '12 To', 'petit': '50 Go'},
            {'gros': '500 Go', 'petit': '4 Go'},
        ],
    },
]


def trouver_bloc(source, mot):
    """Renvoie (debut, fin) du bloc array() qui contient le mot-clé."""
    index = source.find(mot)

    if index < 0:
        return None

    debut = source.rfind('array(', 0, index)

    if debut < 0:
        return None

    # La fin du bloc de question : la ligne qui suit le champ
    # 'explanation'. Les questions sont des elements consecutifs du
    # tableau : le bloc suivant commence par '\t\t\t\t\tarray('.
    explication = source.find("'explanation'", index)

    if explication < 0:
        return None

    fin = source.find("\n\t\t\t\t", explication)

    if fin < 0:
        return None

    suite = source[fin + 1:]

    if suite.startswith("\t\t\t\tarray("):
        return debut, fin + 1, True

    if suite.startswith("\t\t\t\t),"):
        return debut, fin + 1 + len("\t\t\t\t),"), False

    return None


def valeurs_champ(bloc, champ):
    """Renvoie la valeur PHP (chaîne) d'un champ du bloc."""
    motif = re.compile(r"'" + champ + r"'\s*=>\s*'((?:[^'\\]|\\.)*)'")
    m = motif.search(bloc)

    return m.group(1) if m else None


def appliquer(texte, remplacements):
    """Remplace les nombres par des {mots}, en textile."""
    for motif, remplacement in remplacements:
        texte = texte.replace(motif, remplacement)

    return texte


def bloc_php(question, variantes, choix, hint, explication, correct):
    tab = '\t' * 5
    out = "array(\n"
    out += tab + "'question' => '" + question + "',\n"
    out += tab + "'mode' => 'choice',\n"
    out += tab + "'variants' => array(\n"

    for jeu in variantes:
        paires = ", ".join("'%s' => '%s'" % (k, v) for k, v in jeu.items())
        out += tab + "\tarray( " + paires + " ),\n"

    out += tab + "),\n"
    out += tab + "'choices' => array(\n"

    for c in choix:
        out += tab + "\t'" + c + "',\n"

    out += tab + "),\n"
    out += tab + "'correct' => " + str(correct) + ",\n"
    out += tab + "'xp' => 10,\n"

    if hint:
        out += tab + "'hint' => '" + hint + "',\n"

    out += tab + "'explanation' => '" + explication + "',\n"
    out += tab + "),"

    return out


def main():
    source = io.open(FICHIER, encoding='utf-8').read()
    original = source

    for entree in QUESTIONS:
        repere = trouver_bloc(source, entree['mot'])

        if repere is None:
            print('INTROUVABLE :', entree['mot'])
            sys.exit(1)

        debut, fin, saut_ligne = repere
        bloc = source[debut:fin]

        question = valeurs_champ(bloc, 'question')
        hint = valeurs_champ(bloc, 'hint')
        explication = valeurs_champ(bloc, 'explanation')

        if question is None or explication is None:
            print('BLOC INCOMPLET :', entree['mot'])
            sys.exit(1)

        m = re.search(r"'choices'\s*=>\s*array\((.*?)\n\t\t\t\t\t\),", bloc, re.S)
        choix = re.findall(r"'((?:[^'\\]|\\.)*)'", m.group(1)) if m else []

        m = re.search(r"'correct'\s*=>\s*(\d+)", bloc)
        correct = int(m.group(1)) if m else 0

        question = appliquer(question, entree['remplacements'])
        explication = appliquer(explication, entree['remplacements'])

        if hint:
            hint = appliquer(hint, entree['remplacements'])

        choix = [appliquer(c, entree['remplacements']) for c in choix]

        nouveau = bloc_php(
            question, entree['variants'], choix, hint, explication, correct
        )

        if saut_ligne:
            nouveau = nouveau + '\n'

        source = source[:debut] + nouveau + source[fin:]

    if source == original:
        print('AUCUN CHANGEMENT')
        sys.exit(1)

    io.open(FICHIER, 'w', encoding='utf-8').write(source)
    print('%d questions paramétriques ajoutées.' % len(QUESTIONS))


if __name__ == '__main__':
    main()
