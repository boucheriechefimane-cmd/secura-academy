#!/usr/bin/env python3
"""Retire les pieds de page d'OCW des textes extraits des PDF.

Pourquoi
--------
Le MIT publie ses cours en PDF avec, en bas de chaque page, un bloc de
pied de page :

                1
    \\x0cMIT OpenCourseWare
    http://ocw.mit.edu
    6.851 Advanced Data Structures
    Spring 2012
    For information about citing these materials or our Terms of Use,
    visit: http://ocw.mit.edu/terms.
    \\x0c

`pdftotext` le restitue tel quel. Sans nettoyage, l'eleve lisait le
pied de page **au milieu de l'enonce** de sa question — c'est arrive
pour une question du MIT 14.15J.

Comment
-------
Le pied de page est le contenu du morceau compris entre deux sauts de
page (`\\x0c`). On retire donc le morceau **entier** s'il commence par
le marqueur d'OCW, et le numero de page isole qui le precede.

On ne retire un morceau que si le marqueur apparait **pres du
debut** de ce morceau : sinon on risquerait de supprimer du contenu
pour de bon.
"""

import re

RE_MARQUEUR = re.compile(
    r'(MIT OpenCourseWare|https?://ocw\.mit\.edu|Terms of Use)', re.I)

# Un numero de page seul sur sa ligne, c'est le pied de page. La
# mise en page de `pdftotext -layout` le colle a droite : il peut etre
# precede de dizaines d'espaces.
RE_NUMERO_PAGE = re.compile(r'^\s{0,80}\d{1,3}\s*$')

# Le pied de page interne du MIT : le titre du document et le numero de
# page, colles sur la meme ligne (« Practice Exam 1: All Questions,
# Spring 2022                    23 »). On ne le retire qu'en FIN de
# morceau : au milieu du texte, une ligne ressemble a cela peut etre
# du contenu.
RE_PIED_INTERNE = re.compile(
    r'^\s{0,40}\S.*\b(?:Spring|Fall|Summer|Winter|January|Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s*'
    r"\'?\d{2,4}\b\s{2,}\d{1,3}\s*$")

# Le marqueur doit etre dans les premieres lignes du morceau.
TETE = 4


def _tete(morceau):
    """Les premieres lignes non vides du morceau."""
    return [l for l in morceau.split('\n') if l.strip()][:TETE]


def retirer_pieds_de_page(texte):
    """Le texte, sans les pieds de page d'OCW ni les numeros de page isoles."""
    texte = texte.replace('\r\n', '\n')
    morceaux = texte.split('\x0c')
    gardees = []
    for morceau in morceaux:
        if RE_MARQUEUR.search('\n'.join(_tete(morceau))):
            # C'est un pied de page : on le jette, et on retire aussi le
            # numero de page qui le precedait.
            if gardees:
                lignes = gardees[-1].split('\n')
                while lignes and (not lignes[-1].strip()
                                  or RE_NUMERO_PAGE.match(lignes[-1])):
                    lignes.pop()
                gardees[-1] = '\n'.join(lignes)
            continue
        gardees.append(morceau)
    texte = '\x0c'.join(gardees)

    # Le pied de page interne du MIT est colle en fin de page, sans
    # saut de page : on le retire ligne par ligne, en fin de morceau.
    morceaux = texte.split('\x0c')
    for index, morceau in enumerate(morceaux):
        lignes = morceau.split('\n')
        if not lignes:
            continue
        # Le titre du document avec son numero de page peut aussi
        #'ouvrir la page (« Practice Exam 1: All Questions, Spring 2022
        #    2 ») : on le retire alors en tete de morceau.
        while lignes and RE_PIED_INTERNE.match(lignes[0]):
            lignes.pop(0)
        derniere = lignes[-1] if lignes else ''
        if not (RE_PIED_INTERNE.match(derniere) or RE_NUMERO_PAGE.match(derniere)):
            morceaux[index] = '\n'.join(lignes)
            continue
        # Pied de page interne du MIT (« ... Spring 2022    23 ») ou numero
        # de page seul : on le retire, et avec lui les lignes vides qui le
        # precedaient (c'est ce que faitait deja le nettoyage du bloc
        # OCW : la mise en page doit rester identique pour les
        # extracteurs).
        lignes.pop()
        while lignes and not lignes[-1].strip():
            lignes.pop()
        morceaux[index] = '\n'.join(lignes)
    return '\x0c'.join(morceaux)


if __name__ == '__main__':
    import io
    import sys
    for chemin in sys.argv[1:]:
        texte = io.open(chemin, encoding='utf-8', errors='ignore').read()
        io.open(chemin, 'w', encoding='utf-8').write(retirer_pieds_de_page(texte))
        print("pieds de page retires : %s" % chemin)
