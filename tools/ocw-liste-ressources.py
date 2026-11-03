#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""Liste les ressources d'EXAMEN d'un cours MIT OpenCourseWare, et dit
lesquelles vont par paires (enonce + corrige).

Pourquoi : le sitemap d'un cours OCW liste les pages « /resources/<nom>/ »
— c'est la ou se trouvent les PDF. Pour importer une question, il faut
la page « /pages/exams/ » du cours (qui fait le lien entre un enonce et
son corrige) ou, a defaut, deviner les paires par le nom du fichier.

Ne telecharge rien : cet outil ne fait que lister, pour qu'on puisse
decider quoi recuperer ensuite (le telechargement se fait en serie, avec
tools/ocw-recupere.py).

Usage :
    python3 tools/ocw-liste-ressources.py --cours 6-828-operating-system-engineering-fall-2012
    python3 tools/ocw-liste-ressources.py --cours ... --json sortie.json
"""

from __future__ import annotations

import argparse
import json
import re
import subprocess
import sys
import time

UA = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0 Safari/537.36"

# Mots qui signalent une ressource d'examen ou de corrige.
MOTS_EXAMEN = ("exam", "quiz", "midterm", "final", "problem", "pset", "hw", "sol", "answer")


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


def titre_ressource(html: str) -> str:
    """Le titre lisible de la ressource (son nom dans le menu du cours)."""
    for motif in (
        r'<h1[^>]*>([^<]{2,120})</h1>',
        r'<title[^>]*>([^<]{2,160})</title>',
    ):
        trouve = re.search(motif, html, re.S)
        if trouve:
            return re.sub(r"\s+", " ", trouve.group(1)).strip()
    return ""


def main(argv=None) -> int:
    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--cours", required=True, help="identifiant du cours")
    analyseur.add_argument("--json", help="ecrire le resultat dans ce fichier")
    args = analyseur.parse_args(argv)

    base = "https://ocw.mit.edu/courses/%s" % args.cours

    sitemap = http(base + "/sitemap.xml")
    ressources = re.findall(
        r"<loc>(https://ocw\.mit\.edu/courses/%s/resources/([^<]+)/)</loc>" % re.escape(args.cours),
        sitemap,
    )
    pages = re.findall(
        r"<loc>(https://ocw\.mit\.edu/courses/%s/pages/([^<]+)/)</loc>" % re.escape(args.cours),
        sitemap,
    )

    liste = []
    for url, nom in ressources:
        if not any(mot in nom.lower() for mot in MOTS_EXAMEN):
            continue
        html = http(url)
        pdf = ""
        trouve = re.search(r'href="([^"]+\.pdf)"', html)
        if trouve:
            pdf = trouve.group(1)
            if pdf.startswith("/"):
                pdf = "https://ocw.mit.edu" + pdf
        liste.append({
            "nom": nom,
            "url": url,
            "titre": titre_ressource(html),
            "pdf": pdf,
            "est_corrige": bool(re.search(r"(sol|answer|solution)", nom, re.I)),
        })
        time.sleep(1)

    resultat = {
        "cours": args.cours,
        "pages": [p[1] for p in pages],
        "ressources": liste,
    }

    if args.json:
        with open(args.json, "w", encoding="utf-8") as f:
            json.dump(resultat, f, ensure_ascii=False, indent=2)
        print("Ecrit : %s" % args.json, file=sys.stderr)
    else:
        print("Pages du cours : %s" % ", ".join(resultat["pages"]))
        print("")
        for r in liste:
            print("%-52s %-8s %s" % (r["nom"][:52], "CORRIGE" if r["est_corrige"] else "", (r["titre"] or "")[:60]))
        print("")
        print("%d ressource(s) d'examen" % len(liste))

    return 0


if __name__ == "__main__":
    raise SystemExit(main())
