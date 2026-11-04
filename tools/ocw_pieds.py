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
    return '\x0c'.join(gardees)


if __name__ == '__main__':
    import io
    import sys
    for chemin in sys.argv[1:]:
        texte = io.open(chemin, encoding='utf-8', errors='ignore').read()
        io.open(chemin, 'w', encoding='utf-8').write(retirer_pieds_de_page(texte))
        print("pieds de page retires : %s" % chemin)
