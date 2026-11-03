#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""Repere, pour plusieurs cours OCW, les paires « enonce + corrige ».

Pourquoi : une question n'est importable que si le corrige officiel
existe. Ce script liste les ressources d'examen de chaque cours et
appaire les fichiers dont le nom suggests un binome
(« mit6_xxx_quiz01 » / « mit6_xxx_quiz01_sol »). Il ne telecharge rien.

Usage :
    python3 tools/ocw-paires.py --cours A --cours B ...
    python3 tools/ocw-paires.py --depuis /home/user/run/ocw-recensement-json.json --filtre 6-
"""

from __future__ import annotations

import argparse
import json
import os
import re
import subprocess
import sys
import time

UA = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0 Safari/537.36"

MOTS_EXAMEN = ("exam", "quiz", "midterm", "final", "problem", "pset")


def http(url: str) -> str:
    for essai in range(3):
        try:
            resultat = subprocess.run(
                ["curl", "-sL", "--max-time", "40", "-A", UA, url],
                capture_output=True, timeout=60,
            )
            if resultat.returncode == 0:
                return resultat.stdout.decode("utf-8", "replace")
        except subprocess.TimeoutExpired:
            pass
        time.sleep(1 + essai * 2)
    return ""


def ressources_du_cours(cours: str) -> list[str]:
    sitemap = http("https://ocw.mit.edu/courses/%s/sitemap.xml" % cours)
    return [
        nom for _url, nom in re.findall(
            r"<loc>(https://ocw\.mit\.edu/courses/%s/resources/([^<]+)/)</loc>" % re.escape(cours),
            sitemap,
        )
    ]


def paires(noms: list[str]) -> tuple[list[str], list[str]]:
    """Separe les enonces de leurs corriges, et apparie les deux."""
    enonces = {}
    corriges = {}

    for nom in noms:
        base = nom.lower()
        if not any(mot in base for mot in MOTS_EXAMEN):
            continue
        if re.search(r"(sol|answer|solution)", base):
            clef = re.sub(r"(.*?)([_-](sol|answer|solution)[a-z0-9]*)$", r"\1", base)
            corriges[clef] = nom
        else:
            enonces[base] = nom

    apparies = []
    for clef, nom in sorted(enonces.items()):
        if clef in corriges:
            apparies.append((nom, corriges[clef]))
    return apparies, sorted(set(corriges.values()) - {c for _e, c in apparies})


def main(argv=None) -> int:
    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--cours", action="append", default=[], help="identifiant du cours")
    analyseur.add_argument("--depuis", help="fichier JSON du recensement")
    analyseur.add_argument("--filtre", default="", help="motif a garder (sur le slug)")
    analyseur.add_argument("--json", help="ecrire le resultat dans ce fichier")
    args = analyseur.parse_args(argv)

    cours = list(args.cours)
    if args.depuis:
        with open(args.depuis, encoding="utf-8") as f:
            donnees = json.load(f)
        for c in donnees:
            slug = c["slug"]
            if args.filtre and args.filtre not in slug:
                continue
            cours.append(slug)

    resultats = []
    for slug in cours:
        noms = ressources_du_cours(slug)
        apparies, orphelins = paires(noms)
        if apparies:
            print("%-56s %d paire(s) : %s"
                  % (slug[:56], len(apparies), ", ".join(e for e, _c in apparies)[:90]), file=sys.stderr)
            for enonce, corrige in apparies:
                print("      %-40s + %s" % (enonce, corrige))
        resultats.append({
            "cours": slug,
            "paires": [{"enonce": e, "corrige": c} for e, c in apparies],
            "corriges_sans_enonce": orphelins,
        })
        time.sleep(1)

    if args.json:
        with open(args.json, "w", encoding="utf-8") as f:
            json.dump(resultats, f, ensure_ascii=False, indent=2)

    return 0


if __name__ == "__main__":
    raise SystemExit(main())
