#!/usr/bin/env python3
"""Calcule le drapeau d'un defi Juice Shop et l'ecrit dans le lab.

Quand l'eleve resout un defi de l'OWASP Juice Shop, l'application lui
affiche un code de drapeau. Ce code n'est pas un texte libre : c'est une
empreinte HMAC-SHA1 du nom du defi, calculee avec la cle `CTF_KEY`
(que nous fixons dans le manifeste du lab).

Ce script :
  1. calcule le code pour un defi donne ;
  2. l'ecrit dans labs/juice-shop/flags/flag-<defi>.txt (fichier que le
     serveur compare a la reponse de l'eleve, en root).

Usage :
    python3 tools/juice-shop/ctf-flag.py --challenge "Login Admin"
    python3 tools/juice-shop/ctf-flag.py --challenge "Admin Section"
"""

import argparse
import hashlib
import hmac
import io
import os

RACINE = os.path.dirname(os.path.abspath(__file__))
LAB = os.path.join(os.path.dirname(os.path.dirname(RACINE)), 'labs', 'juice-shop')

# La cle de notre lab : elle est aussi dans labs/juice-shop/docker-compose.yml
# (variable CTF_KEY du service « juice »). Les deux doivent rester identiques.
CLE = 'SECURA{juice_shop_owasp}'


def calculer_cle(cle, defi):
    """Le calcul de Juice Shop : HMAC-SHA1(cle, nom_du_defi)."""

    return hmac.new(cle.encode('utf-8'), defi.encode('utf-8'), hashlib.sha1).hexdigest()


def nom_fichier(defi):
    base = ''.join(
        caractere if caractere.isalnum() else '-'
        for caractere in defi.lower()
    ).strip('-')

    while '--' in base:
        base = base.replace('--', '-')

    return 'flag-{0}.txt'.format(base)


def ecrire(defi, cle):
    valeur = calculer_cle(cle, defi)
    dossier = os.path.join(LAB, 'flags')

    if not os.path.isdir(dossier):
        os.makedirs(dossier)

    chemin = os.path.join(dossier, nom_fichier(defi))

    with io.open(chemin, 'w', encoding='utf-8') as fichier:
        fichier.write(valeur + '\n')

    print('defi   : {0}'.format(defi))
    print('drapeau: {0}'.format(valeur))
    print('ecrit  : {0}'.format(chemin))

    return chemin


def main():
    analyseur = argparse.ArgumentParser(description='Drapeau d\'un defi Juice Shop.')
    analyseur.add_argument('--challenge', required=True, help='nom du defi (en anglais)')
    analyseur.add_argument('--key', default=CLE, help='cle CTF_KEY du lab')

    arguments = analyseur.parse_args()

    ecrire(arguments.challenge, arguments.key)


if __name__ == '__main__':
    main()
