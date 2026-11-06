#!/usr/bin/env python3
"""Controle : aucun document du dojo ne doit contenir un drapeau reel.

LE PROBLEME, MESURE LE 6 NOVEMBRE 2026
--------------------------------------
Les 20 documents de defi ecrivaient le drapeau en clair :

    02_dossier_cache = FLAG=SECURA{cache_oublie}

`cat` suffisait donc. Les cinq ceintures du dojo, presentees comme un
entrainement progressif, validaient une lecture — exactement ce que la
plateforme pretend ne pas faire. Sur les 60 drapeaux du catalogue, 42
etaient dans ce cas.

CE QUE FAIT CE CONTROLE
-----------------------
Il relit tous les documents de defi et refuse tout `SECURA{...}` qui
ressemble a une valeur reelle. Les gabarits sont autorises et necessaires :
« rapporte le port sous la forme SECURA{port_NNNN} » explique ce qu'on
attend sans donner la reponse.

Un gabarit contient un marqueur de forme : N, NN, NNNN, AAAA, `...`, ou
un mot generique de la consigne (nom, valeur). Une valeur reelle est une
chaine qu'on pourrait recopier telle quelle.

Ce controle est lance par la CI : un nouveau document qui remet un drapeau
en clair casse le build le jour meme.

Usage :
    python3 tools/controle/dojo-sans-drapeau.py [--verbeux]

Sortie 0 si tout est propre, 1 sinon.
"""

import glob
import os
import re
import sys

RACINE = os.path.dirname(os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
DOCUMENTS = os.path.join(RACINE, "labs", "dojo-01", "cours")

# Un gabarit : ce qui explique la FORME attendue sans donner la valeur.
GABARITS = {
    "nom", "valeur", "motdepasse", "port_NNNN", "N_lignes", "ligne_N_valeur",
    "AAAA-MM-JJ", "indice-...", "0x...", "12caracteres", "N", "NN", "NNNN",
    "nom_du_fichier", "nom-du-fichier", "port", "date", "cle", "CODE",
}

MOTIF = re.compile(r"SECURA\{([^}]*)\}")


def est_gabarit(valeur):
    """Cette valeur est-elle une consigne de forme, ou une vraie reponse ?"""
    v = valeur.strip()

    if v in GABARITS:
        return True

    # Un gabarit ecrit en majuscules generiques (PORT_NNNN, DATE_AAAA)
    if re.fullmatch(r"[A-Z_0-9]{1,20}", v) and ("N" in v or "AAAA" in v or v.isupper()):
        return True

    # Un gabarit avec des points de suspension
    if "..." in v:
        return True

    return False


def main():
    verbeux = "--verbeux" in sys.argv

    if not os.path.isdir(DOCUMENTS):
        print("Docs introuvables :", DOCUMENTS)
        return 1

    fichiers = sorted(glob.glob(os.path.join(DOCUMENTS, "**", "*.txt"), recursive=True))

    if not fichiers:
        print("Aucun document de defi trouve.")
        return 1

    vrais = []
    gabarits = 0

    for fichier in fichiers:
        with open(fichier, encoding="utf-8") as f:
            for numero, ligne in enumerate(f, 1):
                for m in MOTIF.finditer(ligne):
                    valeur = m.group(1)

                    if est_gabarit(valeur):
                        gabarits += 1
                        continue

                    vrais.append(
                        "{0}:{1}  SECURA{{{2}}}".format(
                            os.path.relpath(fichier, RACINE), numero, valeur
                        )
                    )

    print("DOCUMENTS DE DEFI SANS DRAPEAU — controle du dojo")
    print("")
    print("  documents analyses        : {0}".format(len(fichiers)))
    print("  gabarits de forme (ok)    : {0}".format(gabarits))
    print("  drapeaux en clair (faux)  : {0}".format(len(vrais)))

    if vrais:
        print("")
        print("DRAPEAUX A RETIRER (le defi redevient une lecture) :")

        for ligne in vrais:
            print("  -", ligne)

        print("")
        print("VERDICT : REFUSE — un document de defi contient un drapeau recopiable.")
        return 1

    print("")
    print("VERDICT : ACCEPTE — aucun document ne contient de drapeau recopiable.")
    return 0


if __name__ == "__main__":
    sys.exit(main())
