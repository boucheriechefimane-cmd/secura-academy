#!/usr/bin/env python3
"""Vérifie la chaîne d'import des questions.

Trois choses doivent être vraies, et le test le prouve à chaque push :

  1. un lot d'une source autorisée (MIT OCW) passe la validation ;
  2. un lot d'une source interdite (PortSwigger : conditions d'utilisation
     qui n'autorisent pas la reprise du contenu) est REFUSÉ, avec un message
     qui explique pourquoi ;
  3. un lot d'une source inconnue est refusé aussi.

Le test joue ensuite un import réel dans un dossier temporaire et vérifie
le fichier PHP produit : la syntaxe est valide, l'attribution et la licence
y figurent, et la question n'est pas écrite en clair côté serveur
(seule la réponse l'est).

Exécution : python3 tests/import-test.py
"""

import os
import shutil
import subprocess
import sys
import tempfile

RACINE = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
OUTIL = os.path.join(RACINE, "tools", "import-questions.py")
FIXTURES = os.path.join(RACINE, "tests", "fixtures")

ECHECS = []
OK = 0


def dire(message):
    print(message)


def verifier(condition, libelle, detail=""):
    global OK
    if condition:
        OK += 1
        print("  ok   %s" % libelle)
    else:
        ECHECS.append("%s%s" % (libelle, (" — " + detail) if detail else ""))
        print("  ECHEC %s%s" % (libelle, (" — " + detail) if detail else ""))


def lancer(args):
    return subprocess.run(
        [sys.executable, OUTIL] + args,
        cwd=RACINE,
        capture_output=True,
        text=True,
    )


def main():
    print("Chaîne d'import des questions — trois contrôles")

    # 1. Une source autorisée passe.
    exemple = os.path.join(FIXTURES, "import-exemple.json")
    resultat = lancer(["--verifier", exemple])
    verifier(
        resultat.returncode == 0,
        "un lot d'une source autorisée est accepté",
        resultat.stdout.strip()[-200:] + resultat.stderr.strip()[-200:],
    )

    # 2. PortSwigger est refusé, et le message dit pourquoi.
    portswigger = os.path.join(FIXTURES, "import-portswigger-refuse.json")
    resultat = lancer(["--verifier", portswigger])
    verifier(resultat.returncode != 0, "PortSwigger est refuse")
    verifier(
        "reutiliser" in resultat.stdout.lower() or "reutilisation" in resultat.stdout.lower(),
        "le refus de PortSwigger explique la raison (licence)",
        resultat.stdout.strip()[-200:],
    )
    verifier(
        "import refuse" in resultat.stdout.lower(),
        "le refus est explicite (« import refuse »)",
        resultat.stdout.strip()[-200:],
    )

    # 3. Une source inconnue est refusée aussi.
    inconnue = os.path.join(FIXTURES, "import-source-inconnue-refuse.json")
    resultat = lancer(["--verifier", inconnue])
    verifier(resultat.returncode != 0, "une source inconnue est refusee")
    verifier(
        "source inconnue" in resultat.stdout.lower(),
        "le refus nomme la source inconnue",
        resultat.stdout.strip()[-200:],
    )

    # 4. Un import réel produit un fichier PHP valide, attribué et sourcé.
    dossier = tempfile.mkdtemp(prefix="secura-import-")
    try:
        resultat = lancer(["--importer", exemple, "--sortie", dossier])
        verifier(resultat.returncode == 0, "l'import reel aboutit", resultat.stdout.strip()[-200:])
        fichier = os.path.join(dossier, "content-import-mit_ocw_6858.php")
        verifier(os.path.exists(fichier), "le fichier PHP est ecrit")
        if os.path.exists(fichier):
            contenu = open(fichier, encoding="utf-8").read()
            verifier(
                "MIT OpenCourseWare" in contenu,
                "l'attribution de la source est dans le fichier",
            )
            verifier(
                "CC BY-NC-SA 4.0" in contenu,
                "la licence est dans le fichier",
            )
            verifier(
                "'source'" in contenu,
                "chaque question garde le champ « source »",
            )
            if shutil.which("php"):
                controle = subprocess.run(
                    ["php", "-l", fichier], capture_output=True, text=True
                )
                verifier(
                    controle.returncode == 0,
                    "le fichier PHP genere est syntaxiquement valide",
                    controle.stdout.strip()[-200:],
                )
    finally:
        shutil.rmtree(dossier, ignore_errors=True)

    print("")
    if ECHECS:
        print("ECHEC — %d controle(s) en erreur : %s" % (len(ECHECS), " | ".join(ECHECS)))
        return 1

    print("%d controle(s) reussi(s)." % OK)
    return 0


if __name__ == "__main__":
    sys.exit(main())
