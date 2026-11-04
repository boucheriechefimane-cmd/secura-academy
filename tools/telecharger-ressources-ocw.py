#!/usr/bin/env python3
"""Telecharge les ressources d'une page de cours MIT OCW.

Usage :
    python3 tools/telecharger-ressources-ocw.py --cours <slug> \
        --page exams --dossier run/ocw-<slug>

Sert a re-telecharger les documents d'un cours deja importe, pour
verifier qu'un extracteur modifie ne change pas le contenu livre.
"""

import argparse
import io
import os
import re
import subprocess
import sys
import urllib.request

RE_RESSOURCE = re.compile(r'resources/([a-zA-Z0-9._-]+)')
RE_PDF = re.compile(r'"(/courses/[^"]+?/[a-f0-9]{32}_[^"]+\.pdf)"')


def lire(url):
    requete = urllib.request.Request(url, headers={"User-Agent": "Mozilla/5.0"})
    with urllib.request.urlopen(requete, timeout=30) as reponse:
        return reponse.read().decode("utf-8", "replace")


def main(argv=None):
    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--cours", required=True)
    analyseur.add_argument("--page", default="exams")
    analyseur.add_argument("--dossier", required=True)
    analyseur.add_argument("--maximum", type=int, default=60)
    args = analyseur.parse_args(argv)

    if not os.path.isdir(args.dossier):
        os.makedirs(args.dossier)

    base = "https://ocw.mit.edu/courses/%s" % args.cours
    page = lire("%s/pages/%s/" % (base, args.page))
    ressources = sorted(set(RE_RESSOURCE.findall(page)))[: args.maximum]
    print("%d ressource(s) trouvee(s) sur %s/pages/%s/" % (
        len(ressources), args.cours, args.page))

    telecharges = 0
    for ressource in ressources:
        try:
            html = lire("%s/resources/%s/" % (base, ressource))
        except Exception as exc:
            print("  %-40s inaccessible (%s)" % (ressource[:40], exc))
            continue
        found = RE_PDF.findall(html)
        if not found:
            continue
        chemin = found[0]
        nom = os.path.basename(chemin)
        pdf = os.path.join(args.dossier, nom)
        if not os.path.exists(pdf):
            try:
                requete = urllib.request.Request(
                    "https://ocw.mit.edu" + chemin,
                    headers={"User-Agent": "Mozilla/5.0"})
                with urllib.request.urlopen(requete, timeout=60) as reponse:
                    donnees = reponse.read()
                with open(pdf, "wb") as fichier:
                    fichier.write(donnees)
            except Exception as exc:
                print("  %-40s echec (%s)" % (nom[:40], exc))
                continue
            subprocess.run(["pdftotext", "-layout", pdf, pdf + ".txt"],
                           check=False)
            telecharges += 1
            print("  %-46s %8d o" % (nom[:46], len(donnees)))
    print("%d document(s) telecharge(s) dans %s" % (telecharges, args.dossier))
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
