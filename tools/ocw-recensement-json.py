#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""Recense TOUS les cours MIT OpenCourseWare qui publient des examens OU
des quiz AVEC corriges officiels.

Pourquoi : le site est gratuit (decision du proprietaire, 02/11/2026), donc
les licences « NC » (CC BY-NC-SA) sont utilisables — c'est le materiel
universitaire de qualite qui remplit les reservoirs d'examens.

Mecanique : chaque cours OCW expose un « data.json » qui donne, entre
autres, la liste des « Learning Resource Types » (Exams, Exam Solutions,
Problem Sets with Solutions...). C'est plus fiable que de lire le HTML :
le JSON est stable, petit, et la liste des types y est complete.

On parcourt donc les 2 587 cours du sitemap, on garde ceux qui annoncent
des examens/corriges, et on note pour chacun :
  - le departement et le numero de cours ;
  - les types de ressources annonces ;
  - les pages « exams » du cours (liens dans le sitemap du cours) ;
  - le chemin de telechargement de chaque PDF.

Usage :
    python3 tools/ocw-recensement-json.py                 # tableau
    python3 tools/ocw-recensement-json.py --json f.json   # pour l'audit
    python3 tools/ocw-recensement-json.py --tous          # sans filtre technique
"""

from __future__ import annotations

import argparse
import json
import os
import re
import subprocess
import sys
import time

RACINE = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
SITEMAP = "https://ocw.mit.edu/sitemap.xml"
UA = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0 Safari/537.36"

# Types de ressources qui indiquent un materiaire d'examen utilisable.
TYPES_EXAMEN = {
    "exam solutions",
    "exams",
    "exams with solutions",
    "problem sets with solutions",
    "quizzes with solutions",
}

# Mots qui signalent un cours technique exploitable pour la plateforme
# (securite, systemes, reseaux, crypto, programmation).
MOTS_TECHNIQUES = [
    "security", "cryptograph", "crypto", "network", "operating-system",
    "operating system", "computer-system", "computer science", "software",
    "programming", "algorithm", "data-structure", "database", "distributed",
    "machine-learning", "artificial-intelligence", "computer-engineering",
    "information-security", "cyber", "attack", "trust", "malware",
    "compilers", "computer-architecture", "parallel-computing", "robotics",
    "web", "java", "python", "logic", "computation",
]

# Cours hors perimetre : politique, management, mathematiques, economie.
EXCLUS = [
    "poverty", "international-relations", "cyberpolitics", "national-security",
    "budget", "anthropology", "metallurgy", "supply-networks", "social-movements",
    "neural-networks", "regression-and-classification", "geothermal",
    "organizational", "policy", "economics", "business", "history", "literature",
]


def http(url: str) -> str:
    """Telecharge une URL (curl -sL, comme toujours dans cet environnement)."""
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


def slugs_du_sitemap() -> list[str]:
    brut = http(SITEMAP)
    return sorted({
        slug for _url, slug in re.findall(
            r"<loc>(https://ocw\.mit\.edu/courses/([^<]+)/sitemap\.xml)</loc>", brut
        )
    })


def data_json(slug: str) -> dict:
    brut = http("https://ocw.mit.edu/courses/%s/data.json" % slug)
    if not brut.strip():
        return {}
    try:
        return json.loads(brut)
    except json.JSONDecodeError:
        return {}


def pages_du_cours(slug: str) -> list[str]:
    """Les pages du cours (exams, quizzes...) d'apres son sitemap."""
    brut = http("https://ocw.mit.edu/courses/%s/sitemap.xml" % slug)
    return re.findall(r"<loc>([^<]+)</loc>", brut)


def fiches_examens(slug: str) -> list[str]:
    """Les URL de fichiers PDF d'examens (courses/.../download/...)."""
    brut = http("https://ocw.mit.edu/courses/%s/sitemap.xml" % slug)
    return sorted({
        url for url in re.findall(r"<loc>([^<]+)</loc>", brut)
        if "/download/" in url or url.lower().endswith(".pdf")
    })


def est_technique(cours: dict, slug: str) -> bool:
    if any(mot in slug for mot in EXCLUS):
        return False
    recherche = " ".join([
        slug,
        cours.get("course_title", ""),
        cours.get("course_description", "")[:400],
        " ".join(cours.get("topics", [])[0]) if cours.get("topics") else "",
        " ".join(cours.get("mit_learn_topics", [])[0]) if cours.get("mit_learn_topics") else "",
    ]).lower()
    return any(mot in recherche for mot in MOTS_TECHNIQUES)


def main(argv=None) -> int:
    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--json", help="ecrire le resultat dans ce fichier")
    analyseur.add_argument("--tous", action="store_true", help="ne pas filtrer sur le caractere technique")
    analyseur.add_argument("--limite", type=int, default=0, help="ne traiter que N cours (mise au point)")
    args = analyseur.parse_args(argv)

    slugs = slugs_du_sitemap()

    if args.limite:
        slugs = slugs[: args.limite]

    print("Cours OCW dans le sitemap : %d" % len(slugs), file=sys.stderr)

    resultats = []
    for index, slug in enumerate(slugs, 1):
        cours = data_json(slug)

        if not cours:
            continue

        types = cours.get("learning_resource_types") or []

        if not (TYPES_EXAMEN & {t.lower() for t in types}):
            continue

        if not args.tous and not est_technique(cours, slug):
            continue

        pages = pages_du_cours(slug)
        pages_examens = [p for p in pages if any(m in p.lower() for m in ("/exams", "/exam", "/quiz", "/problem-set", "/pset"))]
        fichiers = fiches_examens(slug)

        resultats.append({
            "slug": slug,
            "titre": cours.get("course_title", ""),
            "numero": cours.get("primary_course_number", ""),
            "departement": cours.get("department_numbers", []),
            "niveau": cours.get("level", []),
            "types": types,
            "pages_examens": pages_examens,
            "fichiers": fichiers,
            "professeurs": [i.get("title", "") for i in cours.get("instructors", [])],
            "annee": cours.get("year", ""),
            "licence": "CC BY-NC-SA 4.0 (MIT OpenCourseWare)",
        })

        print("[%d/%d] %s -> %d page(s) d'examen, %d fichier(s)"
              % (index, len(slugs), slug, len(pages_examens), len(fichiers)), file=sys.stderr)

    resultats.sort(key=lambda r: (str(r.get("numero")), r["slug"]))

    if args.json:
        with open(args.json, "w", encoding="utf-8") as f:
            json.dump(resultats, f, ensure_ascii=False, indent=2)
        print("Ecrit : %s (%d cours)" % (args.json, len(resultats)), file=sys.stderr)
    else:
        for r in resultats:
            print("%-12s %-62s %s | %d fichier(s)"
                  % (r.get("numero"), r["slug"][:62], ",".join(r["types"]), len(r["fichiers"])))

    return 0


if __name__ == "__main__":
    raise SystemExit(main())
