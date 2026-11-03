#!/usr/bin/env python3
"""Onzieme extracteur : le format Stanford CS224N.

Les examens partiels de NLP de Stanford (CS224N) sont publies en deux
fichiers : l'examen et le corrige. Le corrige reprend l'integralite de
l'examen et y ajoute la reponse officielle, de trois facons :

1. **Les QCM a coches** (le corrige de l'examen Winter 2018) : chaque
   proposition est precedee d'un signe - `©` si elle n'est pas la bonne,
   `√` si c'est la bonne reponse. L'enonce dit « color all the circles you
   think are correct » : il peut donc y avoir plusieurs bonnes reponses.
   Quand il y en a une seule, la plateforme la note comme un QCM a une
   seule bonne reponse ; quand il y en a plusieurs, la question reste
   entiere et la correction officielle s'affiche (on ne transforme pas la
   question en autre chose).

2. **Les QCM a lettres avec « Solution: X. »** (les partiels
   d'entrainement) : l'enonce tient en un paragraphe, les propositions
   sont `A. ... B. ... C. ...`, et le corrige commence par « Solution: C. ».

3. **Les questions redigees** : elles sont suivies de « Solution: ... »
   qui donne la reponse complete de l'ecole.

Comme pour les autres extracteurs Stanford : rien n'est reecrit. Stanford
ne publie pas de licence explicite sur ces pages : c'est trace dans le
catalogue des sources, et chaque question porte l'attribution complete.

Garde-fous :
- une partie sans correction officielle est refusee ;
- un corrige de moins de 30 caracteres est refuse ;
- quand le corrige est colle a la fin d'une proposition (mise en page
  Stanford), il en est extrait et rendu tel quel.
"""

import argparse
import io
import json
import re
import sys

LICENCE = "Aucune licence explicite publiee sur ces pages"
XP = 20
HINT = ("Question d’examen de Stanford : rédige ta réponse, puis la "
        "correction officielle de Stanford s’affiche.")
HINT_CHOIX = ("Question d’examen de Stanford : choisis la bonne proposition, "
              "puis la correction officielle de Stanford s’affiche.")

RE_ENTETE = re.compile(r'^(Title|URL Source|Published Time|Number of Pages|Markdown Content):', re.I)
# Un en-tete de partie : « (a) (2 points) » ou « i. (3 points) »
RE_PARTIE = re.compile(r'(?:\(([a-z])\)|([ivx]{1,4})\.)\s*\((\d+)\s*points?\)')
# Un QCM a lettres : « A. texte »
RE_OPTION = re.compile(r'(?:^|\s)([A-Z])\.\s+(?=\S)')
RE_SOLUTION = re.compile(r'\bSolution\s*:\s*', re.I)


def nettoyer(texte):
    lignes = []
    for ligne in texte.split('\n'):
        if RE_ENTETE.match(ligne.strip()):
            continue
        lignes.append(ligne.rstrip())
    return '\n'.join(lignes)


def controler(correction):
    if len(correction.strip()) < 30:
        return None, "correction trop courte (%d caracteres)" % len(correction.strip())
    return correction.strip(), None


def parties(texte):
    """Decoupe le texte en parties : [(cle, points, bloc)]."""
    marques = list(RE_PARTIE.finditer(texte))
    resultat = []
    for i, m in enumerate(marques):
        fin = marques[i + 1].start() if i + 1 < len(marques) else len(texte)
        cle = m.group(1) or m.group(2)
        resultat.append((cle, m.group(3), texte[m.end():fin]))
    return resultat


def decouper_options(texte):
    """Separe les propositions « A. ... B. ... » d'un enonce QCM."""
    positions = [(m.start(1), m.group(1)) for m in RE_OPTION.finditer(texte)]
    if len(positions) < 2:
        return None
    premier = None
    for i, (pos, lettre) in enumerate(positions):
        if lettre == 'A':
            premier = i
            break
    if premier is None:
        return None
    positions = positions[premier:]
    lettres = [l for _, l in positions]
    if lettres != [chr(ord('A') + i) for i in range(len(lettres))]:
        return None
    morceaux = []
    for i, (pos, _) in enumerate(positions):
        fin = positions[i + 1][0] if i + 1 < len(positions) else len(texte)
        morceaux.append(texte[pos:fin].strip())
    return morceaux


def analyser_coches(bloc):
    """Variante 1 : propositions marquees par `©` (faux) et `√` (vrai)."""
    lignes = bloc.split('\n')
    stem = []
    propositions = []
    for ligne in lignes:
        s = ligne.strip()
        if s.startswith('©') or s.startswith('√'):
            propositions.append([s[0], s[1:].strip()])
        elif propositions and s:
            propositions[-1][1] += ' ' + s
        elif not propositions and s:
            stem.append(s)
    if len(propositions) < 2:
        return None, "moins de deux propositions"
    justification = ''
    for p in propositions:
        m = RE_SOLUTION.search(p[1])
        if m:
            justification = p[1][m.end():].strip()
            p[1] = p[1][:m.start()].strip()
    justes = [i for i, p in enumerate(propositions) if p[0] == '√']
    if not justes:
        return None, "aucune proposition cochee"
    return {'stem': ' '.join(stem).strip(),
            'propositions': [p[1] for p in propositions],
            'justes': justes, 'justification': justification}, None


def analyser_lettres(bloc):
    """Variante 2 : enonce en un paragraphe, corrige « Solution: C. ... »."""
    m = RE_SOLUTION.search(bloc)
    if not m:
        return None, "aucun « Solution: »"
    avant = bloc[:m.start()].strip()
    correction = bloc[m.end():].strip()
    propositions = decouper_options(avant)
    if not propositions:
        return None, "propositions illisibles"
    debut = avant.find(propositions[0])
    stem = avant[:debut].strip()
    m2 = re.match(r'\(?([A-Z])\)?[.:)]?\s*', correction)
    if not m2:
        return None, "lettre de reponse introuvable"
    lettre = m2.group(1)
    if lettre not in [chr(ord('A') + i) for i in range(len(propositions))]:
        return None, "lettre « %s » hors des propositions" % lettre
    return {'stem': stem, 'propositions': propositions,
            'justes': [ord(lettre) - ord('A')], 'justification': correction}, None


def analyser_redaction(bloc):
    """Variante 3 : question ouverte suivie de « Solution: ... »."""
    m = RE_SOLUTION.search(bloc)
    if not m:
        return None, "aucun « Solution: »"
    stem = bloc[:m.start()].strip()
    correction = bloc[m.end():].strip()
    if not stem:
        return None, "enonce vide"
    return {'stem': stem, 'correction': correction}, None


def main():
    analyseur = argparse.ArgumentParser(description="Extracteur Stanford CS224N.")
    analyseur.add_argument("--fichiers", nargs='+', required=True,
                            help="fichiers de texte (corriges de Stanford)")
    analyseur.add_argument("--sortie", required=True)
    analyseur.add_argument("--source", required=True)
    analyseur.add_argument("--url", required=True)
    analyseur.add_argument("--attribution", required=True)
    analyseur.add_argument("--prefixe", default="[Stanford — question d’examen, en anglais] ")
    analyseur.add_argument("--theme", required=True)
    analyseur.add_argument("--licence", default=LICENCE)
    analyseur.add_argument("--titre", default="")
    args = analyseur.parse_args()

    questions = []
    journal = []
    for chemin in args.fichiers:
        texte = nettoyer(io.open(chemin, encoding='utf-8', errors='ignore').read())
        for cle, points, bloc in parties(texte):
            etiquette = ("[%s — %s] " % (args.titre, cle)) if args.titre else ''
            q, pb = analyser_coches(bloc)
            if q is not None:
                if len(q['justes']) == 1:
                    questions.append({
                        "question": "%s%s%s\n%s" % (args.prefixe, etiquette, q['stem'],
                                                    '\n'.join(q['propositions'])),
                        "mode": "choice",
                        "choices": q['propositions'],
                        "correct": q['justes'][0],
                        "hint": HINT_CHOIX,
                        "explanation": "Corrigé officiel de Stanford : " + (
                            q['justification'] if q['justification']
                            else q['propositions'][q['justes'][0]]),
                        "source": args.attribution,
                        "licence": args.licence,
                        "xp": XP,
                    })
                else:
                    texte_corrige = ("Corrigé officiel de Stanford : propositions "
                                     + ", ".join(chr(ord('A') + i) for i in q['justes'])
                                     + ". ")
                    if q['justification']:
                        texte_corrige += q['justification']
                    if len(texte_corrige) < 30:
                        journal.append("%s (%s) : correction trop courte" % (args.titre, cle))
                        continue
                    questions.append({
                        "question": "%s%s%s\n%s\nRéponds par les lettres des propositions justes (A, D par exemple)."
                                    % (args.prefixe, etiquette, q['stem'],
                                       '\n'.join(q['propositions'])),
                        "mode": "solution",
                        "hint": HINT,
                        "explanation": texte_corrige,
                        "source": args.attribution,
                        "licence": args.licence,
                        "xp": XP,
                    })
                continue

            q, pb = analyser_lettres(bloc)
            if q is not None:
                questions.append({
                    "question": "%s%s%s\n%s" % (args.prefixe, etiquette, q['stem'],
                                                '\n'.join(q['propositions'])),
                    "mode": "choice",
                    "choices": q['propositions'],
                    "correct": q['justes'][0],
                    "hint": HINT_CHOIX,
                    "explanation": "Corrigé officiel de Stanford : " + q['justification'],
                    "source": args.attribution,
                    "licence": args.licence,
                    "xp": XP,
                })
                continue

            q, pb = analyser_redaction(bloc)
            if q is not None:
                correction, pb = controler(q['correction'])
                if pb:
                    journal.append("%s (%s) : %s" % (args.titre, cle, pb))
                    continue
                questions.append({
                    "question": "%s%s%s" % (args.prefixe, etiquette, q['stem']),
                    "mode": "solution",
                    "hint": HINT,
                    "explanation": "Corrigé officiel de Stanford : " + correction,
                    "source": args.attribution,
                    "licence": args.licence,
                    "xp": XP,
                })
                continue
            journal.append("%s (%s) : %s" % (args.titre or chemin, cle, pb))

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
