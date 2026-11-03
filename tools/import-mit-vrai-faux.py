#!/usr/bin/env python3
"""Douzieme extracteur MIT : les QCM « T/F » (Vrai / Faux).

Plusieurs examens du MIT (6.867 Machine Learning, 6.041 Probabilistic
Systems...) sont des series de questions « (T/F - 2 points) <enonce> »
dont le corrige officiel imprime la reponse **en marge a droite** de la
question : « ...  T ». C'est la mise en page « a la colonne ».

Le principe reste le meme qu'ailleurs : la reponse est exactement ce que
le MIT a publie, et rien n'est reecrit. L'enonce est repris mot pour mot,
la reponse officielle du MIT est reprise telle quelle.

Garde-fous :
- seule une ligne qui commence par « N. (T/F - N points) » ouvre une
  question : tout le reste du document est ignore ;
- la reponse officielle doit etre un « T » ou un « F » isole en fin de
  ligne ; sinon la question est refusee ;
- les questions qui ne sont pas des T/F (les calculs, les developpements)
  ne sont pas des QCM : elles sont refusees, pas transfoquees ;
- le pied de page OCW (« Cite as: ... MIT OpenCourseWare ») est retire.
"""

import argparse
import io
import json
import os
import re
import sys

LICENCE = "CC BY-NC-SA 4.0"
XP = 20
HINT = ("Question d’examen du MIT : choisis la bonne proposition, puis la "
        "correction officielle du MIT s’affiche.")

RE_QUESTION = re.compile(r'^\s*(\d+)\.\s*\(T\s*/\s*F\s*[–—-]\s*(\d+)\s*points?\)\s*(.*)$')
RE_REPONSE = re.compile(r'\s{2,}([TF])\s*$')
RE_PIED = re.compile(r'^\s*(Cite as:|MIT OpenCourseWare|\(http://ocw|https://ocw|'
                      r'Downloaded on|\d{1,2}\s+\w+\s+\d{4}|\(?\d+\)?\s*$)')


def nettoyer_ligne(ligne):
    return re.sub(r'\s{2,}', ' ', ligne).strip()


def extraire(texte):
    """Renvoie [(enonce, reponse_officielle)] — rien d'autre n'est garde."""
    lignes = texte.split('\n')
    questions = []
    courante = None
    for ligne in lignes:
        if RE_PIED.match(ligne):
            if courante:
                courante = None
            continue
        m = RE_QUESTION.match(ligne)
        if m:
            corps = m.group(3)
            mr = RE_REPONSE.search(corps)
            if not mr:
                courante = None
                continue
            reponse = mr.group(1)
            enonce = nettoyer_ligne(corps[:mr.start()])
            if len(enonce) < 20:
                courante = None
                continue
            courante = {'enonce': [enonce], 'reponse': reponse}
            questions.append(courante)
            continue
        if courante is not None:
            s = ligne.strip()
            if s and not RE_PIED.match(ligne):
                courante['enonce'].append(nettoyer_ligne(s))
    resultat = []
    for q in questions:
        enonce = ' '.join(q['enonce']).strip()
        # Une question qui contient un autre debut de question a ete mal coupee
        enonce = re.sub(r'\s+\d+\.\s*\(T\s*/\s*F.*$', '', enonce).strip()
        if len(enonce) < 20:
            continue
        resultat.append((enonce, q['reponse']))
    return resultat


def main():
    analyseur = argparse.ArgumentParser(description="Extracteur MIT « T/F ».")
    analyseur.add_argument("--texte", required=True, help="dossier des fichiers de texte")
    analyseur.add_argument("--sortie", required=True)
    analyseur.add_argument("--source", required=True)
    analyseur.add_argument("--url", required=True)
    analyseur.add_argument("--attribution", required=True)
    analyseur.add_argument("--prefixe", default="[MIT — question d’examen, en anglais] ")
    analyseur.add_argument("--theme", required=True)
    analyseur.add_argument("--licence", default=LICENCE)
    args = analyseur.parse_args()

    questions = []
    vus = 0
    if not os.path.isdir(args.texte):
        print("Dossier introuvable : %s" % args.texte, file=sys.stderr)
        return 2
    for nom in sorted(os.listdir(args.texte)):
        if not nom.endswith('.txt'):
            continue
        texte = io.open(os.path.join(args.texte, nom), encoding='utf-8', errors='ignore').read()
        for enonce, reponse in extraire(texte):
            vus += 1
            questions.append({
                "question": "%s%s" % (args.prefixe, enonce),
                "mode": "choice",
                "choices": ["True (vrai)", "False (faux)"],
                "correct": 0 if reponse == 'T' else 1,
                "hint": HINT,
                "explanation": "Corrigé officiel du MIT : la réponse est « %s » (%s)."
                               % (reponse, "vrai" if reponse == 'T' else "faux"),
                "source": args.attribution,
                "licence": args.licence,
                "xp": XP,
            })

    if not questions:
        print("Aucune question retenue : rien n'est importe (on ne devine jamais).", file=sys.stderr)
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
    print("Total : %d question(s) Vrai/Faux avec corrige officiel." % len(questions))
    return 0


if __name__ == '__main__':
    raise SystemExit(main())
