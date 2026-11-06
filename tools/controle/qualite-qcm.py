#!/usr/bin/env python3
"""Mesure la qualite des QCM et des examens, question par question.

POURQUOI CE SCRIPT EXISTE
-------------------------
La note du laboratoire (tools/audit-notes.py) a trouve le defaut : dans
83 % des QCM, la bonne reponse est la plus longue des options. Un eleve
qui coche toujours la plus longue reussit 89,6 % des examens sans lire.

Le melange des options retire le raccourci (le moteur le fait depuis le
6/11). Il ne corrige pas le contenu : les mauvaises options restent des
plaisanteries (« Reinstaller le serveur »), pas des erreurs plausibles.

Ce script liste les questions a reecrire, avec la raison. C'est une liste
de travail, pas un avis.

LES QUATRE REGLES D'UN BON DISTRACTEUR
--------------------------------------
1. Il est FAUX, mais un eleve qui a mal compris le choisirait.
2. Il fait la meme longueur que la bonne reponse (a 20 % pres).
3. Il appartient au meme domaine : pas de « chiffrer les donnees » comme
   option a une question sur le filtrage reseau.
4. Il ne se reconnait pas a sa forme (le plus court, le seul en anglais,
   le seul avec un chiffre...).

Usage :
    # sur le runner : wp est deja dans le PATH
    python3 tools/controle/qualite-qcm.py            # le bilan
    # en local, si wp est un phar et php n'est pas dans le PATH
    PHP=/chemin/php WP_CLI=/chemin/wp-cli.phar python3 tools/controle/qualite-qcm.py
    python3 tools/controle/qualite-qcm.py --liste    # la liste de travail
Sortie 0 si tout est au niveau, 1 sinon.
"""

import argparse
import json
import os
import subprocess
import sys

SANDBOX = os.environ.get("SECURA_SANDBOX", "/home/user/wp-sandbox/www")
# PHP est FACULTATIF : sur le runner, « wp » est un executable autonome.
# Le passer a php donnerait « Could not open input file: wp » — l'erreur
# rencontree au premier run.
PHP = os.environ.get("PHP", "").strip()
WP = os.environ.get("WP_CLI", "wp").strip()

LONGUEUR_TOLEREE = 1.2   # la bonne reponse peut depasser de 20 % au plus
EXAMEN_MIN_QUESTIONS = 4
EXAMEN_MIN_SEUIL = 80


def interroge(code):
    """Interroge WordPress.

    wp eval peut prefixer sa sortie (avertissements PHP, bannieres) : on
    cherche donc la derniere ligne qui EST du JSON, au lieu de prendre la
    derniere ligne tout court. Un script qui plante en silence ne vaut rien
    en CI, ou personne ne lit les journaux.
    """
    commande = ([PHP] if PHP else []) + [WP, "--allow-root", "eval", code]
    r = subprocess.run(commande, capture_output=True, text=True, cwd=SANDBOX)

    if r.returncode != 0:
        raise SystemExit("wp eval a echoue (%d) :\n%s" % (r.returncode, (r.stderr or r.stdout)[-800:]))

    for ligne in reversed(r.stdout.strip().split("\n")):
        ligne = ligne.strip()
        if ligne.startswith("{") or ligne.startswith("["):
            try:
                return json.loads(ligne)
            except ValueError:
                continue

    raise SystemExit("aucune sortie JSON de wp eval.\nstdout :\n%s\nstderr :\n%s"
                     % (r.stdout[-600:], r.stderr[-600:]))


def bilan():
    return interroge('''
$qcm = array(); $examens = array();
foreach (Secura_Rooms::get_rooms() as $r) {
  $cle = get_post_meta($r->ID, "_secura_key", true);
  foreach (Secura_Rooms::get_tasks($r->ID) as $ti => $t) {
    foreach (($t["questions"] ?? array()) as $qi => $q) {
      $choix = $q["choices"] ?? array();
      if (count($choix) < 3 || ($q["correct"] ?? -1) < 0) continue;
      $longueurs = array_map("mb_strlen", $choix);
      $max = max($longueurs);
      $bonne = $longueurs[(int) $q["correct"]];
      $qcm[] = array(
        "room" => $cle, "tache" => $ti, "q" => $qi,
        "question" => $q["question"],
        "bonne" => $q["choices"][(int) $q["correct"]],
        "longueur_bonne" => $bonne, "longueur_max" => $max,
        "options" => count($choix),
        "fautive" => ($bonne >= $max * 0.85),
      );
    }
    if (($t["type"] ?? "") !== "exam") continue;
    $examens[] = array(
      "room" => $cle,
      "questions" => count($t["questions"] ?? array()),
      "seuil" => (int) ($t["pass_score"] ?? 0),
    );
  }
}
echo json_encode(array("qcm" => $qcm, "examens" => $examens));
''')


def main():
    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--liste", action="store_true")
    options = analyseur.parse_args()

    d = bilan()
    qcm = d["qcm"]
    examens = d["examens"]

    fautives = [q for q in qcm if q["fautive"]]
    par_room = {}

    for q in fautives:
        par_room[q["room"]] = par_room.get(q["room"], 0) + 1

    petits = [e for e in examens if e["questions"] < EXAMEN_MIN_QUESTIONS]
    sous_seuil = [e for e in examens if e["seuil"] < EXAMEN_MIN_SEUIL]

    part = len(fautives) / len(qcm) * 100 if qcm else 0

    print("\nQUALITE DES QCM — controle du 6 novembre 2026\n")
    print("  QCM a choix multiples                : %d" % len(qcm))
    print("  dont la bonne reponse est la plus longue : %d (%.0f %%)" % (len(fautives), part))
    print("  rooms concernees                     : %d" % len(par_room))
    print()
    print("  examens                              : %d" % len(examens))
    print("  dont moins de %d questions            : %d" % (EXAMEN_MIN_QUESTIONS, len(petits)))
    print("  dont le seuil est sous %d %%           : %d" % (EXAMEN_MIN_SEUIL, len(sous_seuil)))
    print()

    if options.liste:
        print("A REECRIRE (la bonne reponse est la plus longue) :\n")

        for q in fautives:
            print("  %s > q%d : %s" % (q["room"], q["q"] + 1, q["question"][:78]))
            print("      bonne (%d car.) : %s" % (q["longueur_bonne"], q["bonne"][:70]))
            print("      la plus longue fait %d caracteres : ecourter la bonne, ou"
                  " allonger les mauvaises" % q["longueur_max"])

        if petits:
            print("\nEXAMENS TROP COURTS (%d) :\n" % len(petits))

            for e in petits:
                print("  %-16s %d question(s), seuil %d %%" % (e["room"], e["questions"], e["seuil"]))
    else:
        print("  (%d rooms a reprendre ; --liste donne le detail)" % len(par_room))

    verdict = 10.0
    verdict -= min(6.0, part / 100 * 7)
    verdict -= min(2.0, len(petits) / max(1, len(examens)) * 4)
    verdict -= min(2.0, len(sous_seuil) / max(1, len(examens)) * 4)
    verdict = round(max(0.0, verdict), 1)

    print("\nVERDICT : %.1f/10 pour la qualite des QCM et des examens" % verdict)

    if fautives or petits or sous_seuil:
        return 1

    return 0


if __name__ == "__main__":
    sys.exit(main())
