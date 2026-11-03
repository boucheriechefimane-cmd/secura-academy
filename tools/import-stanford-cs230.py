#!/usr/bin/env python3
"""Neuvieme extracteur : le format Stanford CS230.

Le document (un partiel de Stanford) est fait de « (a) (2 points) <enonce> »
suivis des options « (i) ... (iv) ... », puis d'un « Solution: ... » et,
parfois, d'une explication. C'est le meme principe que le format MIT, mais
la mise en page est celle de Stanford.

Attention : contrairement au MIT, Stanford ne fait pas figurer de licence
explicite sur ces pages. L'import se fait sur decision du proprietaire du
site, avec attribution complete de la source (ecole, cours, examen,
corrige) sous chaque question. C'est un choix editorial, pas une
permission : il est trace dans le catalogue des sources.

Garde-fous :
- une partie sans « Solution: » est refusee (on ne devine jamais) ;
- les options (i), (ii)... sont reprises mot pour mot dans l'enonce ;
- une question a plusieurs bonnes reponses devient une REDACTION : la
  plateforme n'a qu'une seule bonne reponse, on ne peut pas en garder une
  parmi plusieurs sans en inventer une.
"""

import argparse
import io
import json
import os
import re
import sys

LICENCE = "Aucune licence explicite publiee sur ces pages"
XP = 20
HINT_SOLUTION = ("Question d’examen de Stanford : rédige ta réponse, puis la "
                 "correction officielle de Stanford s’affiche.")

RE_PARTIE = re.compile(r'^\s*\(([a-z])\)\s*(?:\((\d+)\s*points?\))?\s*(.*)$')
RE_OPTION = re.compile(r'^\s*\(([ivx]+)\)\s*(.*)$')
RE_SOLUTION = re.compile(r'^\s*Solution\s*:\s*(.*)$', re.IGNORECASE)


def controler(correction):
    if len(correction.strip()) < 30:
        return None, "correction trop courte (%d caracteres)" % len(correction.strip())
    return correction.strip(), None


def main():
    analyseur = argparse.ArgumentParser(description="Extracteur Stanford CS230.")
    analyseur.add_argument("--texte", required=True, help="fichier de texte")
    analyseur.add_argument("--sortie", required=True)
    analyseur.add_argument("--source", required=True)
    analyseur.add_argument("--url", required=True)
    analyseur.add_argument("--attribution", required=True)
    analyseur.add_argument("--prefixe", default="[Stanford — question d’examen, en anglais] ")
    analyseur.add_argument("--theme", required=True)
    args = analyseur.parse_args()

    texte = io.open(args.texte, encoding='utf-8', errors='ignore').read()
    parties = []
    journal = []
    partie = None
    for ligne in texte.split('\n'):
        ligne = ligne.rstrip()
        mo = RE_OPTION.match(ligne)
        m = RE_PARTIE.match(ligne)
        if m and not mo:
            if partie is not None and partie['solution'] is None:
                journal.append("partie (%s) sans correction : refusee" % partie['lettre'])
            partie = {'lettre': m.group(1), 'enonce': [m.group(3).strip()], 'options': [],
                      'solution': None, 'explication': []}
            parties.append(partie)
            continue
        if partie is None:
            continue
        if RE_SOLUTION.match(ligne):
            partie['solution'] = RE_SOLUTION.match(ligne).group(1).strip()
            continue
        if mo and partie['solution'] is None:
            partie['options'].append('(%s) %s' % (mo.group(1), mo.group(2).strip()))
            continue
        if partie['solution'] is not None:
            if ligne.strip():
                partie['explication'].append(ligne.strip())
            continue
        if ligne.strip():
            partie['enonce'].append(ligne.strip())

    questions = []
    for p in parties:
        if p['solution'] is None:
            continue
        correction = 'Corrigé officiel de Stanford : ' + p['solution']
        if p['explication']:
            correction += ' ' + ' '.join(p['explication'])
        correction, pb = controler(correction)
        if pb:
            journal.append("partie (%s) : %s" % (p['lettre'], pb))
            continue
        enonce = '\n'.join([x for x in p['enonce'] if x])
        if p['options']:
            enonce = enonce + '\n' + '\n'.join(p['options'])
        questions.append({
            "question": args.prefixe + enonce,
            "mode": "solution",
            "hint": HINT_SOLUTION,
            "explanation": correction,
            "source": args.attribution,
            "licence": LICENCE,
            "xp": XP,
        })

    if not questions:
        print("Aucune question retenue : rien n'est importe (on ne devine jamais).", file=sys.stderr)
        for l in journal[:12]:
            print("   " + l, file=sys.stderr)
        return 3

    lot = {
        "source": args.source,
        "licence": LICENCE,
        "attribution": args.attribution,
        "url": args.url,
        "rooms": [{"room": args.theme, "title": args.theme,
                   "tasks": {"test": questions}}],
    }
    with io.open(args.sortie, 'w', encoding='utf-8') as f:
        f.write(json.dumps(lot, ensure_ascii=False, indent=2) + "\n")
    print("Total : %d question(s) avec corrige officiel." % len(questions))
    for l in journal[:12]:
        print("   refuse : " + l)
    return 0


if __name__ == '__main__':
    raise SystemExit(main())
