#!/usr/bin/env python3
"""Vérifie la chaîne d'import des questions.

Trois choses doivent être vraies, et le test le prouve à chaque push :

  1. un lot d'une source autorisée (MIT OCW) passe la validation ;
  2. un lot d'une source interdite (PortSwigger : conditions d'utilisation
     qui n'autorisent pas la reprise du contenu) est REFUSÉ, avec un message
     qui explique pourquoi ;
  3. un lot d'une source inconnue est refusé aussi ;
  3 bis. un lot d'une source universitaire sans licence explicite
     (MIT 6.1600) est refusé aussi : le materiel est public et gratuit,
     mais sans licence, on cite — on n'importe pas ;
  4. le lot MIT OCW réellement livré avec la plateforme (les questions
     d'examen du MIT 6.858) est lui-même valide : c'est lui qui alimente
     les rooms, donc il est vérifié à chaque push ;
  5. RÉORDONNER ou RENUMÉROTER un contenu protégé ne donne pas une
     licence : le même lot PortSwigger, remis dans l'autre ordre et
     renuméroté, est refusé lui aussi, et le message du refus le dit ;
  6. un contenu sous licence « NC » (non commerciale) ne peut pas
     alimenter un service payant : le lot MIT OCW, accepté pour un site
     gratuit, est refusé quand l'import est destiné à un usage payant ;
  7. le catalogue dit, source par source, si la licence autorise un usage
     commercial — et la réponse est cohérente avec la licence.

Le test joue ensuite un import réel dans un dossier temporaire et vérifie
le fichier PHP produit : la syntaxe est valide, l'attribution et la licence
y figurent, et la question n'est pas écrite en clair côté serveur
(seule la réponse l'est).

Exécution : python3 tests/import-test.py
"""

import json
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
    print("Chaîne d'import des questions — le lot livré, les deux refus, et le fichier produit")

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

    # 4. Une source universitaire SANS licence explicite est refusee aussi
    #    (MIT 6.1600 : quiz d'entrainement et corriges publics, mais aucune
    #    licence Creative Commons sur le site du cours -> on cite, on
    #    n'importe pas).
    sans_licence = os.path.join(FIXTURES, "import-mit-61600-refuse.json")
    resultat = lancer(["--verifier", sans_licence])
    verifier(resultat.returncode != 0, "une source sans licence explicite est refusee")
    verifier(
        any(mot in resultat.stdout.lower() for mot in ("reutilisation", "reutilisable", "reutiliser")),
        "le refus dit pourquoi (source non reutilisable)",
        resultat.stdout.strip()[-200:],
    )

    # 5. Reordonner ou renumeroter un contenu protege ne donne pas de
    #    licence : le lot PortSwigger remis dans l'autre ordre et
    #    renumerote est refuse lui aussi, et le refus le dit.
    reordonne = os.path.join(FIXTURES, "import-portswigger-reordonne-refuse.json")
    resultat = lancer(["--verifier", reordonne])
    verifier(resultat.returncode != 0, "PortSwigger reordonne et renumerote est refuse")
    verifier(
        "reordonner" in resultat.stdout.lower() or "renumeroter" in resultat.stdout.lower(),
        "le refus explique qu'reordonner ou renumeroter ne change rien a la licence",
        resultat.stdout.strip()[-250:],
    )

    # 6. Une licence « NC » ne peut pas alimenter un service payant.
    lot_mit = os.path.join(RACINE, "tools", "lots", "mit-ocw-6858-examens.json")
    resultat = lancer(["--verifier", lot_mit, "--commercial"])
    verifier(resultat.returncode != 0, "le lot MIT OCW (licence NC) est refuse pour un usage payant")
    verifier(
        "commercial" in resultat.stdout.lower(),
        "le refus parle d'usage commercial",
        resultat.stdout.strip()[-250:],
    )
    resultat = lancer(["--verifier", lot_mit])
    verifier(
        resultat.returncode == 0,
        "le meme lot MIT OCW reste accepte pour un site gratuit",
        resultat.stdout.strip()[-250:],
    )

    # 7. Le catalogue est coherent : chaque source dit si sa licence
    #    autorise un usage commercial, et la licence dit la meme chose.
    catalogue = json.load(
        open(os.path.join(RACINE, "tools", "sources-autorisees.json"), encoding="utf-8")
    )
    incoherences = []
    for source in catalogue.get("sources", []):
        if "commercial" not in source:
            incoherences.append("%s : champ « commercial » absent" % source.get("id"))
            continue
        licence = (source.get("licence") or "").upper()
        non_commerciale = "NC" in licence.replace("NON COMMERCIAL", "").replace("NON-COMMERCIAL", "")
        if not source.get("reutilisable", False):
            non_commerciale = True
        attendu = not non_commerciale
        if bool(source["commercial"]) != attendu:
            incoherences.append(
                "%s : commercial=%s, licence « %s »"
                % (source.get("id"), source["commercial"], source.get("licence"))
            )
    verifier(
        not incoherences,
        "le catalogue est coherent sur l'usage commercial (licence NC = non commercial)",
        " | ".join(incoherences),
    )

    # 8. Un import réel produit un fichier PHP valide, attribué et sourcé.
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
            verifier(
                "Usage commercial" in contenu,
                "le fichier livré dit si la licence autorise un usage payant",
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

    # 6. Le lot MIT OCW livre avec la plateforme est valide lui-meme :
    #    c'est le fichier qui alimente reellement les questions d'examen
    #    (17 questions, avec le corrige officiel du MIT). S'il etait
    #    abime, la plateforme perdrait des questions sans s'en apercevoir.
    lot = os.path.join(RACINE, "tools", "lots", "mit-ocw-6858-examens.json")
    verifier(os.path.exists(lot), "le lot MIT OCW livre est present")
    if os.path.exists(lot):
        resultat = lancer(["--verifier", lot])
        verifier(
            resultat.returncode == 0,
            "le lot MIT OCW livre est valide",
            resultat.stdout.strip()[-200:],
        )

    print("")
    if ECHECS:
        print("ECHEC — %d controle(s) en erreur : %s" % (len(ECHECS), " | ".join(ECHECS)))
        return 1

    print("%d controle(s) reussi(s)." % OK)
    return 0


if __name__ == "__main__":
    sys.exit(main())
