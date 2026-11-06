# -*- coding: utf-8 -*-
"""Verifie la traduction anglaise du bloc D1 contre son original francais.

Usage :
    python3 verifie_d1_en.py          # sort 0 si tout passe, 1 sinon

POURQUOI CE CONTROLE EXISTE
---------------------------
`verifier-traductions.php` compare ce qui est INSTALLE. Il ne dit rien d'un
bloc qui n'a pas encore ete installe, et il ne dit rien non plus d'une room
sans traduction : il l'ignore, poliment (« pas encore traduite, ce n'est pas
une erreur »). Deux jours de suite, une room livree sans anglais est donc
passee entre les mailles, et le job `anglais.yml` est tombe.

Quatre regles, toutes bloquantes :

1. meme nombre de taches et de questions. Une question oubliee decale
   l'index `correct` : l'eleve qui repond juste est declare faux ;
2. meme nombre d'options par question, pour la meme raison ;
3. la bonne reponse anglaise n'est pas l'option la plus longue. C'est
   exactement la regle que mesure qualite-qcm.py, et la seule qui compte
   pour l'eleve : s'il peut gagner en cochant la plus longue, l'exercice ne
   mesure plus rien. La bande de ratio 1,08-1,90 du francais est verifiee
   aussi, mais en AVERTISSEMENT seulement : l'instrument ne la mesure pas
   sur l'anglais, et une bande stricte sur une langue plus concise que le
   francais pousserait a rallonger des leurres pour rien ;
4. aucun champ laisse en francais.
"""

import io
import os
import sys

import d1
import d1_en


def main():
    rooms = {r['title']: r for r in d1.ROOMS}
    erreurs = []
    avertissements = []

    for cle, trad in d1_en.EN.items():
        titre = [t for t, c in {
            "Le portique qui n'a arrete personne": 'concepts-01',
            "Le reseau interne etait sur": 'concepts-02',
            "La porte du fond, ouverte en decembre": 'concepts-03',
        }.items() if c == cle]

        if not titre or titre[0] not in rooms:
            erreurs.append('%s : room francaise introuvable' % cle)
            continue

        fr = rooms[titre[0]]
        t_fr, t_en = fr['tasks'], trad['tasks']

        if len(t_fr) != len(t_en):
            erreurs.append('%s : %d taches en francais, %d en anglais'
                           % (cle, len(t_fr), len(t_en)))
            continue

        for i, (a, b) in enumerate(zip(t_fr, t_en)):
            qa, qb = a.get('questions') or [], b.get('questions') or []

            if len(qa) != len(qb):
                erreurs.append('%s t%d : %d questions en francais, %d en anglais'
                               % (cle, i + 1, len(qa), len(qb)))
                continue

            for j, (x, y) in enumerate(zip(qa, qb)):
                ca, cb = x.get('choices'), y.get('choices')

                if not ca:
                    continue

                if len(ca) != len(cb):
                    erreurs.append('%s t%d q%d : %d options en francais, %d en anglais'
                                   % (cle, i + 1, j + 1, len(ca), len(cb)))
                    continue

                # Equilibre de l'ensemble ANGLAIS, meme regle que le francais.
                correct = x.get('correct')
                if isinstance(correct, int) and 0 <= correct < len(cb):
                    longueurs = [len(o) for o in cb]
                    bonne = longueurs[correct]

                    if bonne == max(longueurs):
                        erreurs.append(
                            '%s t%d q%d : la bonne reponse anglaise est la plus longue '
                            '(%d caracteres sur %d) — un eleve qui coche la plus longue gagne'
                            % (cle, i + 1, j + 1, bonne, max(longueurs)))

                    for k, o_en in enumerate(cb):
                        if k == correct or not bonne:
                            continue
                        ratio = len(o_en) / float(bonne)
                        if ratio < 1.08 or ratio > 1.90:
                            avertissements.append(
                                '%s t%d q%d option %d : ratio %.2f (hors bande 1,08-1,90)'
                                % (cle, i + 1, j + 1, k + 1, ratio))

                for champ in ('question', 'hint', 'explanation'):
                    if x.get(champ) and x.get(champ) == y.get(champ):
                        erreurs.append('%s t%d q%d : « %s » identique au francais'
                                       % (cle, i + 1, j + 1, champ))

                # Le repere technique doit survivre : un chemin traduit
                # envoie l'eleve dans le mur.
                for chemin in ('/srv/atelier',):
                    if chemin in (x.get('hint') or '') and chemin not in (y.get('hint') or ''):
                        erreurs.append('%s t%d q%d : l\'indice anglais a perdu %s'
                                       % (cle, i + 1, j + 1, chemin))

    for a in avertissements:
        print('  avis  ' + a)

    if erreurs:
        print('TRADUCTION D1 : %d probleme(s)' % len(erreurs))
        for e in erreurs[:40]:
            print('  - ' + e)
        return 1

    print('TRADUCTION D1 : 3 room(s), aucune incoherence.')
    return 0


if __name__ == '__main__':
    sys.exit(main())
