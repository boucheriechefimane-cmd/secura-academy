#!/usr/bin/env python3
"""Telecharge les documents d'un cours MIT OCW, en parallele.

Le moteur de criblage (`criblage-ocw.py`) dit quels cours meritent un
regard : on y trouve les documents d'examen, avec ou sans corrige. Ce
script fait la suite : il telecharge les PDF (et leur version texte) dans
un dossier, avec N telechargeurs en parallele — c'est la que les « six
robots » montrent leur utilite : un seul telephone et six robots qui
attendent, c'est lent ; six robots et un seul telephone qui fait les six
appels en meme temps, c'est rapide.

Usage :
    python3 tools/telecharger-ocw.py --cours 6-867-machine-learning-fall-2006 \
        --dossier /home/user/run/ocw-6-867 --travailleurs 6
    python3 tools/telecharger-ocw.py --rapport rapport.json --dossier D \
        --travailleurs 6 --prefixes 6- 18-
"""

import argparse
import concurrent.futures
import io
import json
import os
import re
import subprocess
import sys

URL_COURS = "https://ocw.mit.edu/courses/%s/"
RE_PDF = re.compile(r'/courses/[^"\'<>\s\\]+?\.pdf')
RE_SOLUTION = re.compile(r'(^|[_\-\s])(sol|soln|solution|solutions|solution)([_\-\s.]|$)', re.I)


def curl(url, chemin=None):
    r = subprocess.run(['curl', '-sL', '--max-time', '120', url], capture_output=True)
    data = r.stdout
    if chemin:
        with open(chemin, 'wb') as f:
            f.write(data)
    return data


def pages_du_cours(slug):
    """Les pages du cours qui peuvent contenir des documents."""
    html = curl(URL_COURS % slug).decode('utf-8', 'ignore')
    ressources = sorted(set(re.findall(r'/courses/[^"\'<>\s\\]+?/resources/([a-z0-9\-_.%]+)/', html)))
    return ressources


def documents_du_cours(slug, dossier):
    """Les PDF du cours : on passe par les pages de ressources."""
    if not os.path.isdir(dossier):
        os.makedirs(dossier)
    sitemap = curl(URL_COURS % slug + 'sitemap.xml').decode('utf-8', 'ignore')
    pages = sorted(set(re.findall(r'/courses/[^"\'<>\s\\]+?/pages/([a-z0-9\-_]+)/', sitemap)))
    if not pages:
        pages = sorted(set(re.findall(r'/courses/[^"\'<>\s\\]+?/pages/([a-z0-9\-_]+)/',
                                       curl(URL_COURS % slug).decode('utf-8', 'ignore'))))
    documents = {}
    for page in pages:
        html = curl(URL_COURS % slug + 'pages/%s/' % page).decode('utf-8', 'ignore')
        ressources = sorted(set(re.findall(r'/courses/[^"\'<>\s\\]+?/resources/([a-z0-9\-_.%]+)/', html)))
        for res in ressources:
            page_html = curl(URL_COURS % slug + 'resources/%s/' % res).decode('utf-8', 'ignore')
            for pdf in RE_PDF.findall(page_html):
                nom = pdf.split('/')[-1]
                documents[nom] = 'https://ocw.mit.edu' + pdf
        for pdf in RE_PDF.findall(html):
            nom = pdf.split('/')[-1]
            documents[nom] = 'https://ocw.mit.edu' + pdf
    return documents


def telecharger_un(cours):
    slug, nom, url, dossier = cours
    pdf = os.path.join(dossier, nom)
    txt = os.path.join(dossier, nom + '.txt')
    if os.path.exists(txt) and os.path.getsize(txt) > 200:
        return (nom, 'deja la')
    data = curl(url, pdf)
    if len(data) < 1000:
        return (nom, 'echec (%d o)' % len(data))
    r = subprocess.run(['pdftotext', '-layout', pdf, txt], capture_output=True)
    if r.returncode != 0:
        return (nom, 'pdftotext a echoue')
    taille = os.path.getsize(txt) if os.path.exists(txt) else 0
    return (nom, 'ok (%d o de texte)' % taille)


def main():
    analyseur = argparse.ArgumentParser(description="Telechargement des documents OCW.")
    analyseur.add_argument('--cours', nargs='*', default=None)
    analyseur.add_argument('--rapport', default=None)
    analyseur.add_argument('--dossier', required=True)
    analyseur.add_argument('--travailleurs', type=int, default=6)
    analyseur.add_argument('--prefixes', nargs='*', default=None)
    analyseur.add_argument('--avec-corrige-seulement', action='store_true')
    args = analyseur.parse_args()

    if not os.path.isdir(args.dossier):
        os.makedirs(args.dossier)

    if args.rapport:
        with io.open(args.rapport, encoding='utf-8') as f:
            rapport = json.load(f)
        retenus = [c for c in rapport if c['a_un_corrige'] and c['reutilisable']]
        if args.prefixes:
            retenus = [c for c in retenus if any(c['cours'].startswith(p) for p in args.prefixes)]
        slugs = [c['cours'] for c in retenus]
    else:
        slugs = args.cours

    tous = []
    for slug in slugs:
        print('-> %s' % slug, flush=True)
        docs = documents_du_cours(slug, args.dossier)
        if args.avec_corrige_seulement:
            docs = {n: u for n, u in docs.items() if RE_SOLUTION.search(n)}
        for nom, url in sorted(docs.items()):
            tous.append((slug, nom, url, args.dossier))

    print('documents a telecharger : %d' % len(tous), flush=True)
    ok = 0
    with concurrent.futures.ThreadPoolExecutor(max_workers=args.travailleurs) as execu:
        for nom, etat in execu.map(telecharger_un, tous):
            if etat.startswith('ok') or etat == 'deja la':
                ok += 1
            else:
                print('   %-60s %s' % (nom[:60], etat))
    print('telecharges : %d / %d' % (ok, len(tous)))
    return 0


if __name__ == '__main__':
    raise SystemExit(main())
