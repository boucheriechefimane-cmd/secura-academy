#!/usr/bin/env python3
"""Le moteur de la recolte : on ne « navigue » plus, oncrible.

Le sitemap d'OCW donne les 2 587 cours en une requete. C'est une boussole :
elle dit ou sont les cours, pas ce qu'ils contiennent. Ce script ajoute la
deuxieme moitie — le **criblage** — et il le fait en automatique :

1. le sitemap donne la liste des cours ;
2. on ne garde que les cours dont le numero est dans la liste demandee
   (par defaut les cours EECS : 6.*, 18.*) ;
3. pour chaque cours, on lit son sitemap, puis la page de chaque
   ressource — c'est la que figure le **nom du fichier** ;
4. le nom du fichier est le signal le plus fiable qui soit : un fichier
   « ..._soln.pdf », « ..._sol.pdf », « ...-Solutions.pdf » annonce un
   corrige officiel ; « quiz1.pdf » sans « sol » n'en annonce pas ;
5. le rapport dit, pour chaque cours : la licence, les documents
   d'examen trouves, et si un corrige est present.

Et comme le criblage se fait par le net, il se partage : `--shard 2/6`
ne traite qu'un sixieme des cours. Six machines, six tranches, chacune
ecrit son rapport, on les fusionne.

Usage :
    python3 tools/criblage-ocw.py --sortie rapport.json --prefixes 6- 18- --shard 0/6
    python3 tools/criblage-ocw.py --fusionner rapport.json rapport-*.json --sortie cible.json
"""

import argparse
import concurrent.futures
import glob
import io
import json
import os
import re
import subprocess
import sys
import time

SITEMAP_COURS = "https://ocw.mit.edu/sitemap.xml"
URL_COURS = "https://ocw.mit.edu/courses/%s/"
URL_SITEMAP_COURS = "https://ocw.mit.edu/courses/%s/sitemap.xml"

RE_LICENCE = re.compile(r'creativecommons\.org/licenses/([a-z\-]+)/([0-9.]+)', re.I)
RE_PDF = re.compile(r'/courses/[^"\'<>\s\\]+?\.pdf')
RE_PAGE = re.compile(r'/courses/[^"\'<>\s\\]+?/pages/([a-z0-9\-_]+)/')
# Un fichier qui porte un corrige
RE_SOLUTION = re.compile(r'(^|[_\-\s])(sol|soln|solution|solutions|solutions|answer|answers|key|keys)([_\-\s.]|$)', re.I)
# Un fichier qui est un examen
RE_EXAMEN = re.compile(r'(exam|quiz|midterm|final|problem|pset|hw|assignment|recitation|exercise|test)', re.I)
# Les pages qui peuvent contenir des documents de correction
PAGES_INTERESSANTES = ('exam', 'quiz', 'midterm', 'final', 'assign', 'problem', 'pset',
                        'recitation', 'exercise', 'readings', 'resource', 'homework', 'hw')


def curl(url, cache=None, delai=0.0):
    """Telecharge une URL (avec un cache disque, la recolle se refait souvent)."""
    if cache:
        if os.path.exists(cache):
            with io.open(cache, encoding='utf-8', errors='ignore') as f:
                return f.read()
        dossier = os.path.dirname(cache)
        if dossier and not os.path.isdir(dossier):
            os.makedirs(dossier, exist_ok=True)
    r = subprocess.run(['curl', '-sL', '--max-time', '60', url], capture_output=True)
    texte = r.stdout.decode('utf-8', 'ignore')
    if cache:
        with io.open(cache, 'w', encoding='utf-8') as f:
            f.write(texte)
    if delai:
        time.sleep(delai)
    return texte


def cours_du_sitemap(cache='/tmp/ocw-sitemap.xml'):
    if not os.path.exists(cache):
        curl(SITEMAP_COURS, cache)
    with io.open(cache, encoding='utf-8', errors='ignore') as f:
        return re.findall(r'/courses/([^/]+)/sitemap\.xml', f.read())


def licence_du_cours(html):
    """La licence est dans le pied de page : une URL creativecommons."""
    m = RE_LICENCE.search(html)
    if not m:
        return None
    return 'CC %s %s' % (m.group(1).upper(), m.group(2))


def ressources_du_cours(slug, cache_dir='/tmp/ocw-cache'):
    """Les documents du cours : nom de fichier + URL, avec le nom du fichier."""
    if not os.path.isdir(cache_dir):
        os.makedirs(cache_dir, exist_ok=True)
    sitemap = curl(URL_SITEMAP_COURS % slug, os.path.join(cache_dir, slug + '-sitemap.xml'))
    pages = sorted(set(RE_PAGE.findall(sitemap)))
    pages = [p for p in pages if any(i in p.lower() for i in PAGES_INTERESSANTES)] or pages
    documents = {}
    for page in pages:
        html = curl(URL_COURS % slug + 'pages/%s/' % page,
                    os.path.join(cache_dir, '%s-%s.html' % (slug, page)))
        # Les ressources liees depuis la page
        ressources = sorted(set(re.findall(r'/courses/[^"\'<>\s\\]+?/resources/([a-z0-9\-_.%]+)/', html)))
        for res in ressources:
            page_html = curl(URL_COURS % slug + 'resources/%s/' % res,
                             os.path.join(cache_dir, '%s-%s.html' % (slug, res)))
            for pdf in RE_PDF.findall(page_html):
                nom = pdf.split('/')[-1]
                documents[nom] = 'https://ocw.mit.edu' + pdf
        for pdf in RE_PDF.findall(html):
            nom = pdf.split('/')[-1]
            documents[nom] = 'https://ocw.mit.edu' + pdf
    return documents


def analyser_cours(slug):
    cours_html = curl(URL_COURS % slug, '/tmp/ocw-cache/%s-cours.html' % slug)
    licence = licence_du_cours(cours_html)
    documents = ressources_du_cours(slug)
    examens = {n: u for n, u in documents.items() if RE_EXAMEN.search(n)}
    corriges = [n for n in examens if RE_SOLUTION.search(n)]
    sans_corrige = [n for n in examens if not RE_SOLUTION.search(n)]
    return {
        'cours': slug,
        'licence': licence,
        'reutilisable': bool(licence and 'BY' in licence),
        'documents_examen': sorted(examens),
        'a_un_corrige': bool(corriges),
        'corriges': sorted(corriges),
        'sans_corrige': sorted(sans_corrige),
        'score': (2 if licence else 0) + (5 if corriges else 0),
    }


def main():
    analyseur = argparse.ArgumentParser(description="Criblage automatique des cours MIT OCW.")
    analyseur.add_argument('--sortie', required=True)
    analyseur.add_argument('--prefixes', nargs='*', default=['6-', '18-'],
                            help='prefixes de numero de cours a garder')
    analyseur.add_argument('--shard', default='0/1', help='i/n : traite un dixieme des cours')
    analyseur.add_argument('--limite', type=int, default=0, help='maximum de cours (0 = tous)')
    analyseur.add_argument('--travailleurs', type=int, default=6)
    analyseur.add_argument('--fusionner', nargs='*', default=None)
    args = analyseur.parse_args()

    if args.fusionner is not None:
        # Les fichiers peuvent etre donnes explicitement, ou designes par un
        # motif. Le motif est developpe ICI, pas par le shell : dans le
        # workflow, chaque artefact est extrait dans son propre sous-dossier
        # (rapports/rapport-robot-0/rapport-0.json), et le motif doit donc
        # chercher dans l'arborescence. On accepte aussi bien un motif que
        # des fichiers precis.
        fichiers = []
        for motif in args.fusionner:
            if any(c in motif for c in '*?['):
                found = glob.glob(motif, recursive=True)
                fichiers += [f for f in found if os.path.isfile(f)]
            else:
                fichiers.append(motif)

        if not fichiers:
            print('aucun rapport a fusionner : rien a faire', file=sys.stderr)
            return 1

        fusion = []
        for f in sorted(set(fichiers)):
            with io.open(f, encoding='utf-8') as fh:
                fusion += json.load(fh)

        with io.open(args.sortie, 'w', encoding='utf-8') as fh:
            fh.write(json.dumps(fusion, ensure_ascii=False, indent=2) + "\n")
        candidats = [c for c in fusion if c['a_un_corrige'] and c['reutilisable']]
        print('%d cours analyses | %d avec un corrige et une licence reutilisable'
              % (len(fusion), len(candidats)))
        for c in sorted(candidats, key=lambda x: -x['score'])[:20]:
            print('   %-58s %-28s %d document(s)' % (c['cours'][:58], str(c['licence'])[:28],
                                                     len(c['documents_examen'])))
        return 0

    tous = cours_du_sitemap()
    gardes = [s for s in tous if any(s.startswith(p) for p in args.prefixes)]
    i, n = [int(x) for x in args.shard.split('/')]
    part = gardes[i::n]
    if args.limite:
        part = part[:args.limite]
    print('candidat : %d cours (sur %d dans le sitemap, %d retenus), tranche %d/%d'
          % (len(part), len(tous), len(gardes), i + 1, n))
    resultats = []
    with concurrent.futures.ThreadPoolExecutor(max_workers=args.travailleurs) as execu:
        for r in execu.map(analyser_cours, part):
            resultats.append(r)
            marque = 'OUI' if r['a_un_corrige'] else 'non'
            print('   %-56s corrige:%-4s licence:%s' % (r['cours'][:56], marque, r['licence']))
    with io.open(args.sortie, 'w', encoding='utf-8') as fh:
        fh.write(json.dumps(resultats, ensure_ascii=False, indent=2) + "\n")
    print('rapport : %s (%d cours)' % (args.sortie, len(resultats)))
    return 0


if __name__ == '__main__':
    raise SystemExit(main())
