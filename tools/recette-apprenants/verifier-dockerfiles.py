#!/usr/bin/env python3
"""Verifie les Dockerfiles du depot sans Docker.

Un `docker build` echoue en trente secondes, mais dans la mesure de ce
depot, il echoue *au milieu d'un run de vingt minutes* qui a deja
construit neuf images : le prix d'une erreur de syntaxe y est tres eleve.

Ce script attrape les pieges classiques en une fraction de seconde :

  1. une continuation de ligne (`\\`) suivie d'un commentaire `#` : Docker
     ne sait pas continuer une instruction apres un commentaire, le build
     casse avec un message qui ne parle pas de la vraie cause ;
  2. une continuation de ligne en fin de fichier (instruction tronquee) ;
  3. une instruction vide (`RUN`, `COPY` sans argument) ;
  4. un `COPY`/`ADD` dont la source n'existe pas dans le contexte.

Usage :
    python3 tools/recette-apprenants/verifier-dockerfiles.py [dossier]

Sortie 0 si tout est propre, 1 sinon, avec le fichier et la ligne.
"""

import re
import sys
from pathlib import Path


def verifier(fichier):
    """Rend la liste des problemes trouves dans un Dockerfile."""
    problemes = []
    lignes = fichier.read_text(encoding="utf-8").splitlines()

    for numero, ligne in enumerate(lignes, start=1):
        nue = ligne.rstrip()

        # 1 et 2 : continuation de ligne suivie d'un commentaire ou de rien.
        if nue.endswith("\\"):
            suite = lignes[numero] if numero < len(lignes) else ""
            if not suite.strip():
                problemes.append(
                    (numero, "continuation de ligne en fin de fichier : "
                             "l'instruction est tronquee")
                )
            elif suite.strip().startswith("#"):
                problemes.append(
                    (numero, "continuation de ligne suivie d'un commentaire : "
                             "Docker s'arrete la et le build casse")
                )

        # 3 : instruction sans argument.
        if re.match(r"^\s*(RUN|COPY|ADD|CMD|ENTRYPOINT|WORKDIR)\s*$", nue):
            problemes.append((numero, "instruction sans argument"))

    # 4 : les COPY/ADD dont la source manque dans le contexte.
    contexte = fichier.parent
    for numero, ligne in enumerate(lignes, start=1):
        trouve = re.match(r"^\s*(COPY|ADD)\s+(.+)$", ligne)
        if not trouve:
            continue

        arguments = trouve.group(2).split()
        # On ignore les options (--chown=...) et les sources distantes.
        arguments = [a for a in arguments if not a.startswith("--")]

        if len(arguments) < 2:
            continue

        for source in arguments[:-1]:
            if "://" in source or source.startswith("$"):
                continue
            if not (contexte / source).exists():
                problemes.append(
                    (numero, "source absente du contexte : %s" % source)
                )

    return problemes


def main():
    racine = Path(sys.argv[1]) if len(sys.argv) > 1 else Path(__file__).resolve().parents[2]
    fichiers = sorted(racine.glob("labs/*/Dockerfile"))

    if not fichiers:
        print("Aucun Dockerfile trouve sous %s/labs" % racine)
        return 1

    total = 0
    for fichier in fichiers:
        problemes = verifier(fichier)
        nom = "%s/%s" % (fichier.parent.name, fichier.name)

        if problemes:
            total += len(problemes)
            for numero, message in problemes:
                print("KO   %-42s ligne %3d : %s" % (nom, numero, message))
        else:
            print("OK   %s" % nom)

    print()
    if total:
        print("%d probleme(s) : le build echouerait." % total)
        return 1

    print("%d Dockerfile(s) propres." % len(fichiers))
    return 0


if __name__ == "__main__":
    sys.exit(main())
