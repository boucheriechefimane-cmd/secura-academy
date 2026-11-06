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

EXAMEN_MIN_QUESTIONS = 4
EXAMEN_MIN_SEUIL = 80

# CE QU'ON MESURE, ET POURQUOI CE N'EST PAS « LA BONNE REPONSE EST-ELLE LONGUE ».
#
# Premier essai (6/11) : compter les questions ou la bonne reponse fait au
# moins 90 % de l'option la plus longue. Ce seuil est faux, et je l'ai vu en
# corrigeant la premiere room : quand quatre options ont la MEME longueur —
# ce qui est justement le but — la bonne reponse depasse mecaniquement 85 %
# du maximum. Le seuil comptait donc des questions saines comme fautives, et
# laissait passer les vrais raccourcis.
#
# Ce qui compte est le resultat d'une attaque, pas une longueur : un eleve qui
# coche TOUJOURS l'option la plus longue reussit-il cet examen ? On calcule
# son score et on le compare au seuil de l'examen. C'est rejouable, et c'est
# la seule chose qui dit si l'epreuve discrimine.
#
# A egalite de longueur, on compte la question comme gagnee : c'est
# l'hypothese la PLUS FAVORABLE a l'eleve qui triche, donc celle qui accuse
# le moins. Si l'examen tombe meme la, il tombe.


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
      $plus_longues = 0;
      foreach ($longueurs as $l) { if ($l === $max) { $plus_longues++; } }
      $qcm[] = array(
        "room" => $cle, "tache" => $ti, "q" => $qi,
        "question" => $q["question"],
        "bonne" => $q["choices"][(int) $q["correct"]],
        "longueur_bonne" => $bonne, "longueur_max" => $max,
        "plus_longues" => $plus_longues,
        "options" => count($choix),
        // Le raccourci GAGNE cette question : la bonne reponse est la plus
        // longue (seule, ou a egalite — on est severe avec nous-memes).
        "fautive" => ($bonne === $max),
        // Il ne gagne que si elle est la seule de cette longueur.
        "determinante" => ($bonne === $max && 1 === $plus_longues),
      );
    }
    if (($t["type"] ?? "") !== "exam") continue;
    // Le score qu'obtient un eleve qui coche TOUJOURS la plus longue, en
    // comptant gagnee toute question ou la bonne reponse atteint la
    // longueur maximale (hypothese la plus favorable a l'eleve).
    $nb = 0; $gagne = 0;
    foreach (($t["questions"] ?? array()) as $q) {
      $c = $q["choices"] ?? array();
      if (count($c) < 3 || ($q["correct"] ?? -1) < 0) continue;
      $nb++;
      $l = array_map("mb_strlen", $c);
      if ($l[(int) $q["correct"]] === max($l)) { $gagne++; }
    }
    $examens[] = array(
      "room" => $cle,
      "questions" => count($t["questions"] ?? array()),
      "corrigeables" => $nb,
      "gagne_par_longueur" => $gagne,
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
    determinantes = [q for q in qcm if q["determinante"]]
    par_room = {}

    for q in fautives:
        par_room[q["room"]] = par_room.get(q["room"], 0) + 1

    petits = [e for e in examens if e["questions"] < EXAMEN_MIN_QUESTIONS]
    sous_seuil = [e for e in examens if e["seuil"] < EXAMEN_MIN_SEUIL]

    # L'attaque : cocher toujours la plus longue. Un examen qui reste
    # au-dessus de son seuil est un examen qui se passe sans lire.
    tombent = [
        e for e in examens
        if e["corrigeables"] and 100.0 * e["gagne_par_longueur"] / e["corrigeables"] >= e["seuil"]
    ]

    part = len(fautives) / len(qcm) * 100 if qcm else 0
    part_det = len(determinantes) / len(qcm) * 100 if qcm else 0
    part_exam = len(tombent) / len(examens) * 100 if examens else 0

    print("\nQUALITE DES QCM — controle du 6 novembre 2026\n")
    print("  QCM a choix multiples                    : %d" % len(qcm))
    print("  bonne reponse la plus longue (gagne)     : %d (%.0f %%)" % (len(fautives), part))
    print("  dont SEULE de cette longueur             : %d (%.0f %%)" % (len(determinantes), part_det))
    print("  rooms ou le raccourci existe             : %d" % len(par_room))
    print()
    print("  examens                                  : %d" % len(examens))
    print("  dont moins de %d questions                : %d" % (EXAMEN_MIN_QUESTIONS, len(petits)))
    print("  dont le seuil est sous %d %%               : %d" % (EXAMEN_MIN_SEUIL, len(sous_seuil)))
    print("  REUSSIS en cochant toujours la plus longue: %d (%.0f %%)" % (len(tombent), part_exam))
    print()

    if options.liste:
        print("A REECRIRE — la bonne reponse est la plus longue :\n")

        for q in fautives:
            marque = " (seule de sa longueur)" if q["determinante"] else ""
            print("  %s > q%d%s : %s" % (q["room"], q["q"] + 1, marque, q["question"][:70]))
            print("      bonne (%d car.) : %s" % (q["longueur_bonne"], q["bonne"][:66]))
            print("      la plus longue fait %d caracteres" % q["longueur_max"])

        if tombent:
            print("\nEXAMENS QUI SE PASSENT SANS LIRE (%d) :\n" % len(tombent))

            for e in sorted(tombent, key=lambda x: -x["gagne_par_longueur"]):
                score = 100.0 * e["gagne_par_longueur"] / e["corrigeables"]
                print("  %-16s %2d questions, seuil %2d %%, score par la plus longue %3.0f %%"
                      % (e["room"], e["corrigeables"], e["seuil"], score))

        if petits:
            print("\nEXAMENS TROP COURTS (%d) :\n" % len(petits))

            for e in petits:
                print("  %-16s %d question(s), seuil %d %%" % (e["room"], e["questions"], e["seuil"]))
    else:
        print("  (%d rooms a reprendre ; --liste donne le detail)" % len(par_room))

    # Le verdict pese d'abord ce qui se mesure sans discuter : un examen
    # qu'on reussit sans lire est une epreuve morte, quel que soit son seuil.
    verdict = 10.0
    verdict -= min(6.0, part_exam / 100 * 6)     # examens gagnes a l'attaque
    verdict -= min(2.0, part_det / 100 * 4)      # questions au raccourci net
    verdict -= min(1.0, len(petits) / max(1, len(examens)) * 3)
    verdict -= min(1.0, len(sous_seuil) / max(1, len(examens)) * 2)
    verdict = round(max(0.0, verdict), 1)

    print("\nVERDICT : %.1f/10 pour la qualite des QCM et des examens" % verdict)

    if fautives or petits or sous_seuil:
        return 1

    return 0


if __name__ == "__main__":
    sys.exit(main())
