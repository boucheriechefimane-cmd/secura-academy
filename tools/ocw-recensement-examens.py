#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""Recense les cours MIT OpenCourseWare qui publie des examens OU des quiz
AVEC corriges officiels.

Pourquoi : le site est gratuit (decision du proprietaire, 02/11/2026), donc
les licences « NC » (CC BY-NC-SA) sont utilisables — c'est le materiel
universitaire de qualite qui remplit les reservoirs d'examens.

Le recenseement est systematique, pas a la main : on part du sitemap OCW
(2 587 cours), on ne garde que les cours techniques (systemes, reseaux,
crypto, securite), on lit la page de chaque cours et on note :
  - les types de ressources annonces (« Exam Solutions », « Exams », ...) ;
  - la page « exams » ou les PDF d'examens ;
  - la licence (toujours CC BY-NC-SA 4.0 sur OCW).

Usage :
    python3 tools/ocw-recensement-examens.py            # tableau sur stdout
    python3 tools/ocw-recensement-examens.py --json f   # pour l'audit
"""

from __future__ import annotations

import argparse
import json
import os
import re
import sys
import time
import urllib.error
import urllib.request

RACINE = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
SITEMAP = "https://ocw.mit.edu/sitemap.xml"
UA = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0 Safari/537.36"

# Mots qui signalent un cours technique exploitable pour nous.
MOTS = [
    "security", "cryptograph", "crypto", "network", "operating-system",
    "computer-systems", "trust", "firewall", "hacking", "malware",
    "6-858", "6-857", "6-1600", "6-566", "6-3900", "6-875", "6-876",
    "6-897", "6-828", "6-1810", "6-829", "6-263", "attack", "forensic",
    "reverse-engineering", "6-5630", "6-1600", "systems-security",
]

# Cours hors perimetre : politique, management, mathematiques, economie.
EXCLUS = [
    "poverty", "international-relations", "cyberpolitics", "national-security",
    "budget", "anthropology", "metallurgy", "supply-networks", "social-movements",
    "neural-networks", "regression-and-classification", "geothermal",
    "organizational", "policy", "economics", "business",
]


def http(url, delai=0.6):
    requete = urllib.request.Request(url, headers={"User-Agent": UA})
    for essai in range(3):
        try:
            with urllib.request.urlopen(requete, timeout=45) as reponse:
                return reponse.read().decode("utf-8", "replace")
        except (urllib.error.URLError, urllib.error.HTTPError, TimeoutError) as exc:
            if essai == 2:
                return ""
            time.sleep(2 + essai * 2)
    return ""


def cours_candidats():
    sitemap = http(SITEMAP)
    urls = re.findall(r"<loc>(https://ocw\.mit\.edu/courses/([^<]+)/sitemap\.xml)</loc>", sitemap)
    candidats = []
    for url, slug in urls:
        if any(m in slug for m in EXCLUS):
            continue
        if any(m in slug for m in MOTS):
            candidats.append((slug, "https://ocw.mit.edu/courses/%s/" % slug))
    return sorted(candidats)


def types_de_ressources(html):
    """Renvoie la liste des types de ressources annonces par la page du cours."""
    bloc = re.search(r"Learning Resource Types(.*?)(?:</ul>|</div>|Departments)", html, re.S)
    if not bloc:
        return []
    brut = bloc.group(1)
    if "resource-type" in brut:
        items = re.findall(r'>([^<>]{2,40})<', brut)
    else:
        items = re.findall(r">\s*([A-Z][A-Za-z /&'-]{2,40})\s*<", brut)
    return sorted({i.strip() for i in items if i.strip()})


def liens_examens(html, base):
    """Renvoie les URL des pages/PDF d'examens trouvees sur la page du cours."""
    liens = []
    for href, texte in re.findall(r'href="([^"]+)"[^>]*>([^<]{0,80})<', html):
        bas = href.lower()
        if any(m in bas for m in ("/exams", "/exam", "quiz", "problem-set")) or \
           any(m in texte.lower() for m in ("exam", "quiz", "problem set")):
            if href.startswith("/"):
                href = "https://ocw.mit.edu" + href
            elif not href.startswith("http"):
                continue
            if href not in liens:
                liens.append(href)
    return liens


def main(argv=None):
    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--json", help="ecrire le recensement dans ce fichier")
    analyseur.add_argument("--delai", type=float, default=0.6)
    args = analyseur.parse_args(argv)

    candidats = cours_candidats()
    print("Cours techniques retenus : %d" % len(candidats), file=sys.stderr)

    resultats = []
    for index, (slug, url) in enumerate(candidats, 1):
        html = http(url)
        if not html:
            print("[%d/%d] %s : page inaccessible" % (index, len(candidats), slug), file=sys.stderr)
            continue
        types = types_de_ressources(html)
        liens = liens_examens(html, url)
        avec_examens = any("exam" in t.lower() for t in types)
        avec_corriges = any("solution" in t.lower() for t in types)
        # Un « Assignment with Examples », c'est un probleme avec son corrige
        # officiel : c'est du materiel importable au meme titre qu'un examen
        # avec corriges.
        avec_enonces_corriges = any(
            "assignments with examples" in t.lower() or "problem sets with solutions" in t.lower()
            for t in types
        )
        if not (avec_examens or avec_corriges or avec_enonces_corriges):
            continue
        ligne = {
            "slug": slug,
            "url": url,
            "types": types,
            "exams": avec_examens,
            "corriges": avec_corriges,
            "enonces_corriges": avec_enonces_corriges,
            "liens": liens[:12],
        }
        resultats.append(ligne)
        print(
            "[%d/%d] %-52s exams=%-5s corriges=%-5s enonces=%-5s liens=%d"
            % (
                index, len(candidats), slug[:52], avec_examens, avec_corriges,
                avec_enonces_corriges, len(liens),
            ),
            file=sys.stderr,
        )
        time.sleep(args.delai)

    if args.json:
        with open(args.json, "w", encoding="utf-8") as fichier:
            json.dump(resultats, fichier, ensure_ascii=False, indent=2)
        print("Recensement ecrit : %s" % args.json, file=sys.stderr)

    print("")
    print("%-52s %-7s %-9s %-9s %s" % ("cours", "examens", "corriges", "enonces", "types annonces"))
    print("-" * 120)
    for ligne in resultats:
        print(
            "%-52s %-7s %-9s %-9s %s"
            % (
                ligne["slug"][:52],
                "oui" if ligne["exams"] else "non",
                "oui" if ligne["corriges"] else "non",
                "oui" if ligne["enonces_corriges"] else "non",
                ", ".join(ligne["types"])[:55],
            )
        )
    print("")
    print("Total : %d cours avec examens et/ou corriges" % len(resultats))
    return 0


if __name__ == "__main__":
    sys.exit(main())
