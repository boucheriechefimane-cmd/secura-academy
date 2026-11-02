#!/usr/bin/env python3
"""Récupère les fichiers d'un cours MIT OpenCourseWare (PDF + texte).

Pourquoi cet outil existe
-------------------------
Les questions d'examen que la plateforme importe viennent de MIT OCW.
Pour les récupérer de façon *reproductible* (et non « à la main, une fois »),
il faut deux choses :

1. connaître l'adresse du PDF : elle n'est pas devinable, elle est dans
   la page de la ressource (« .../resources/mit6_006f11_quiz1/ ») ;
2. convertir le PDF en texte pour pouvoir lire les questions et le
   corrigé : c'est le rôle de « pdftotext » (paquet poppler-utils).

Le téléchargement se fait **en série** (une requête à la fois) : le site
peut renvoyer des erreurs 503 quand plusieurs requêtes arrivent en même
temps, et on ne veut pas d'un outil qui échoue par intermittence.

Utilisation :
    python3 tools/ocw-recupere.py --cours 6-006-introduction-to-algorithms-fall-2011 \\
        --ressources mit6_006f11_quiz1,mit6_006f11_quiz1_sol --dossier /tmp/ocw
"""

import argparse
import os
import re
import subprocess
import sys
import time
import urllib.error
import urllib.request

UA_PAGE = (
    "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 "
    "(KHTML, like Gecko) Chrome/126.0 Safari/537.36"
)
UA_PDF = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0"


def requete(url, ua, essais=3, pause=3, attendre_pdf=True):
    """Télécharge une URL et renvoie les octets (ou None).

    Pour un PDF, une page HTML servie à la place est une erreur (le site
    peut renvoyer une page d'attente quand il est sollicité trop vite) :
    on réessaie. Pour une page web, le HTML est évidemment la réponse
    attendue : `attendre_pdf` est alors mis à False.
    """
    for essai in range(1, essais + 1):
        try:
            demande = urllib.request.Request(url, headers={"User-Agent": ua})
            with urllib.request.urlopen(demande, timeout=90) as reponse:
                donnees = reponse.read()
            if attendre_pdf and donnees[:15].lower().startswith(b"<!doctype html"):
                raise urllib.error.URLError("réponse HTML au lieu du PDF")
            return donnees
        except Exception as erreur:  # noqa: BLE001 — on veut tout rattraper ici
            print("    (essai %d/%d : %s)" % (essai, essais, erreur), file=sys.stderr)
            time.sleep(pause * essai)
    return None


def lien_pdf(page_html):
    """Retrouve l'adresse du PDF dans la page d'une ressource."""
    trousses = sorted(set(re.findall(r'(/courses/[^"\'\s<>]+?\.pdf)', page_html)))
    for trouille in trousses:
        if trouille.endswith(".pdf"):
            return "https://ocw.mit.edu" + trouille
    return None


def texte_du_pdf(chemin_pdf, chemin_txt):
    """Convertit le PDF en texte (pdftotext -layout)."""
    if not os.path.exists(chemin_txt):
        essai = subprocess.run(
            ["pdftotext", "-layout", chemin_pdf, chemin_txt],
            capture_output=True,
            text=True,
        )
        if essai.returncode != 0:
            print("    (pdftotext : %s)" % essai.stderr.strip()[:160], file=sys.stderr)
            return False
    return True


def main():
    analyseur = argparse.ArgumentParser(description="Récupère des fichiers d'un cours MIT OCW.")
    analyseur.add_argument("--cours", required=True, help="identifiant du cours (ex. 6-006-...)")
    analyseur.add_argument("--ressources", required=True, help="liste de ressources séparées par des virgules")
    analyseur.add_argument("--dossier", default="/tmp/ocw", help="dossier de destination")
    arguments = analyseur.parse_args()

    if not shutil_which("pdftotext"):
        print("pdftotext est introuvable : installez poppler-utils.", file=sys.stderr)
        return 1

    os.makedirs(arguments.dossier, exist_ok=True)
    recuperes = []
    echecs = []

    for ressource in [r.strip() for r in arguments.ressources.split(",") if r.strip()]:
        print("  %s…" % ressource)
        page = "https://ocw.mit.edu/courses/%s/resources/%s/" % (arguments.cours, ressource)
        html = requete(page, UA_PAGE, attendre_pdf=False)
        if not html:
            echecs.append(ressource)
            continue
        pdf = lien_pdf(html.decode("utf-8", "ignore"))
        if not pdf:
            print("    (aucun PDF trouvé)", file=sys.stderr)
            echecs.append(ressource)
            continue
        donnees = requete(pdf, UA_PDF)
        if not donnees:
            echecs.append(ressource)
            continue
        chemin_pdf = os.path.join(arguments.dossier, ressource + ".pdf")
        chemin_txt = os.path.join(arguments.dossier, ressource + ".txt")
        with open(chemin_pdf, "wb") as fichier:
            fichier.write(donnees)
        texte_du_pdf(chemin_pdf, chemin_txt)
        recuperes.append(ressource)
        time.sleep(2)

    print("  récupérés : %d | échecs : %d" % (len(recuperes), len(echecs)))
    if echecs:
        print("  en échec : %s" % ", ".join(echecs), file=sys.stderr)
    return 0 if not echecs else 1


def shutil_which(programme):
    for dossier in os.environ.get("PATH", "").split(os.pathsep):
        candidat = os.path.join(dossier, programme)
        if os.path.isfile(candidat) and os.access(candidat, os.X_OK):
            return candidat
    return None


if __name__ == "__main__":
    sys.exit(main())
