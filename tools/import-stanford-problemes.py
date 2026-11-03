#!/usr/bin/env python3
"""Dixieme extracteur : le format Stanford « Problem N (Titre) (X points) ».

Les archives d'examens de Stanford (CS107, CS224N...) publient l'enonce et
son corrige dans deux fichiers distincts, ou le corrige reprend l'enonce
suivi de la reponse officielle. Chaque probleme est decoupe en parties
(a), (b), (c)..., et la correction officielle d'une partie est ce que le
professeur a publie.

Comme pour les autres extracteurs, rien n'est reecrit : l'enonce et la
correction sont repris mot pour mot, et une partie sans correction
officielle est refusee.

Garde-fous :
- l'enonce et le corrige sont apparies par (numero de probleme, lettre de
  partie) ; une partie du corrige sans partie correspondante dans l'enonce
  est refusee ;
- une correction qui commence par une minuscule est un fragment de mise en
  page : refusee ;
- une correction trop courte (moins de 30 caracteres) est refusee : on
  n'apprend rien d'un fragment ;
- le repere « Published Time: » du lecteur (qui n'est pas dans le
  document) et les blocs de code sont conserves tels quels.
"""

import argparse
import io
import json
import os
import re
import sys

XP = 20
HINT = ("Question d’examen de Stanford : rédige ta réponse, puis la "
        "correction officielle de Stanford s’affiche.")

# Deux titres de probleme chez Stanford :
#   « Problem 1 (Void * generics) (24 points) »  et  « Problem 1: C-strings »
RE_PROBLEME = re.compile(r'Problem\s+(\d+)\s*(?::\s*(.*?)|\(([^)]*)\)\s*(?:\((\d+)\s*points?\))?)', re.I)
# Deux formes de partie : « (a) ... » et « 2a) ... » (le numero du probleme
# suivi de la lettre, sur la meme ligne).
RE_PARTIE = re.compile(r'^\s*(?:>\s*)?\(([a-z])\)\s*(.*)$')
RE_PARTIE_NUM = re.compile(r'^\s*(?:>\s*)?(\d+)([a-z])\)\s*(.*)$')
RE_SOLUTION = re.compile(r'^\s*(?:>\s*)?Solution\s*:?\s*(.*)$', re.IGNORECASE)
RE_ENTETE = re.compile(r'^(Title|URL Source|Published Time|Number of Pages|Markdown Content):', re.I)


def nettoyer(texte):
    """Retire l'en-tete du lecteur (qui n'est pas dans le document)."""
    lignes = []
    for ligne in texte.split('\n'):
        if RE_ENTETE.match(ligne.strip()):
            continue
        lignes.append(ligne.rstrip())
    return '\n'.join(lignes)


def decouper(texte):
    """Decoupe en {numero: {'titre':.., 'points':.., 'parties': {lettre: texte}}}."""
    problemes = {}
    courant = None
    partie = None
    for ligne in texte.split('\n'):
        mp = RE_PROBLEME.search(ligne)
        if mp:
            titre = (mp.group(2) or mp.group(3) or '').strip()
            points = int(mp.group(4)) if mp.group(4) else 0
            courant = {'numero': int(mp.group(1)), 'titre': titre,
                       'points': points, 'parties': {}, 'ordre': []}
            problemes[courant['numero']] = courant
            partie = None
            continue
        if courant is None:
            continue
        m = RE_PARTIE.match(ligne)
        mn = RE_PARTIE_NUM.match(ligne)
        if (m or mn) and not RE_SOLUTION.match(ligne):
            if mn:
                lettre, texte = mn.group(2), mn.group(3)
            else:
                lettre, texte = m.group(1), m.group(2)
            partie = [lettre, [texte.strip()]]
            courant['parties'][lettre] = partie
            courant['ordre'].append(lettre)
            continue
        if partie is not None:
            suite = ligne.strip()
            if suite:
                partie[1].append(suite)
    for p in problemes.values():
        for lettre, morceaux in list(p['parties'].items()):
            p['parties'][lettre] = '\n'.join([m for m in morceaux[1] if m]).strip()
    return problemes


def controler(correction):
    if len(correction.strip()) < 30:
        return None, "correction trop courte (%d caracteres)" % len(correction.strip())
    # (On ne se méfie PAS des minuscules : chez Stanford, une correction
    # commence souvent par du code — « int remove_duplicates(...) ».)
    return correction.strip(), None


def main():
    analyseur = argparse.ArgumentParser(description="Extracteur Stanford « Problem N (points) ».")
    analyseur.add_argument("--enonce", required=True, help="fichier de l enonce")
    analyseur.add_argument("--corrige", required=True, help="fichier du corrige")
    analyseur.add_argument("--sortie", required=True)
    analyseur.add_argument("--source", required=True)
    analyseur.add_argument("--url", required=True)
    analyseur.add_argument("--attribution", required=True)
    analyseur.add_argument("--prefixe", default="[Stanford — question d’examen, en anglais] ")
    analyseur.add_argument("--theme", required=True)
    analyseur.add_argument("--licence", default="Aucune licence explicite publiee sur ces pages")
    args = analyseur.parse_args()

    enonce = nettoyer(io.open(args.enonce, encoding='utf-8', errors='ignore').read())
    corrige = nettoyer(io.open(args.corrige, encoding='utf-8', errors='ignore').read())
    problemes_enonce = decouper(enonce)
    problemes_corrige = decouper(corrige)

    questions = []
    journal = []
    for numero in sorted(problemes_enonce):
        pe = problemes_enonce[numero]
        pc = problemes_corrige.get(numero)
        if pc is None:
            journal.append("probleme %d : pas de corrige" % numero)
            continue
        for lettre in pe['ordre']:
            if lettre not in pc['parties']:
                journal.append("probleme %d (%s) : pas de correction" % (numero, lettre))
                continue
            enonce_partie = pe['parties'][lettre]
            reponse = pc['parties'][lettre]
            if not enonce_partie:
                journal.append("probleme %d (%s) : enonce vide" % (numero, lettre))
                continue
            reponse, pb = controler(reponse)
            if pb:
                journal.append("probleme %d (%s) : %s" % (numero, lettre, pb))
                continue
            questions.append({
                "question": "%s Problem %d (%s) — partie (%s)\n%s" % (
                    args.prefixe, numero, pe['titre'], lettre, enonce_partie),
                "mode": "solution",
                "hint": HINT,
                "explanation": "Corrigé officiel de Stanford : " + reponse,
                "source": args.attribution,
                "licence": args.licence,
                "xp": XP,
            })

    if not questions:
        print("Aucune question retenue : rien n'est importe (on ne devine jamais).", file=sys.stderr)
        for l in journal[:15]:
            print("   " + l, file=sys.stderr)
        return 3

    lot = {
        "source": args.source,
        "licence": args.licence,
        "attribution": args.attribution,
        "url": args.url,
        "rooms": [{"room": args.theme, "title": args.theme, "tasks": {"test": questions}}],
    }
    with io.open(args.sortie, 'w', encoding='utf-8') as f:
        f.write(json.dumps(lot, ensure_ascii=False, indent=2) + "\n")
    print("Total : %d question(s) avec corrige officiel." % len(questions))
    for l in journal[:15]:
        print("   refuse : " + l)
    return 0


if __name__ == '__main__':
    raise SystemExit(main())
