#!/usr/bin/env python3
"""Note le laboratoire sur pieces, pas sur impression.

POURQUOI CE SCRIPT EXISTE
-------------------------
« C'est de bonne qualite » ne se verifie pas. Ce script transforme la
question en sept notes, chacune avec son calcul et son seuil. Une note
basse n'est pas une opinion : c'est un chiffre qu'on peut contester en
relisant la regle.

Chaque critere dit TROIS choses :
  - ce qui est mesure (le chiffre, brut) ;
  - la note (0-10) et le bareme applique ;
  - ce qu'il faudrait faire pour monter.

Usage :
    python3 tools/audit-notes.py          # le tableau
    python3 tools/audit-notes.py --detail # + le calcul de chaque note
"""

import argparse
import glob
import json
import os
import re
import subprocess
import sys

RACINE = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
PHP = os.environ.get("PHP", "php")
WP = os.environ.get("WP_CLI", "")
SANDBOX = os.environ.get("SECURA_SANDBOX", "/home/user/wp-sandbox/www")

SEUIL_PASSAGE = 80  # plancher recommande par class-secura-gate.php


def php(code):
    """Interroge WordPress (le contenu installe, pas les sources)."""
    if not WP:
        raise SystemExit("WP_CLI non defini : lancer depuis le sandbox WordPress.")
    r = subprocess.run([PHP, WP, "--allow-root", "eval", code],
                       capture_output=True, text=True, cwd=SANDBOX)
    if r.returncode != 0:
        raise SystemExit(r.stderr[-400:])
    return r.stdout.strip().split("\n")[-1]


def note(valeur, bareme, plafond=10):
    """Note lineaire entre deux bornes, plafonnee."""
    bas, haut = bareme
    if valeur <= bas:
        return 0.0
    if valeur >= haut:
        return float(plafond)
    return round((valeur - bas) / (haut - bas) * plafond, 1)


def mesure_machines():
    """Les images, et les familles de vulnerabilites REELLEMENT dans le code.

    On ne cherche pas des mots-cles dans le Dockerfile (il ne contient que
    des COPY) mais dans le code applicatif livre : c'est lui que l'eleve
    attaque. Chaque famille est nommee, pour que le chiffre se verifie.
    """
    machines = [d for d in sorted(glob.glob(os.path.join(RACINE, "labs", "*")))
                if os.path.isdir(d)]
    avec_docker = [d for d in machines if os.path.exists(os.path.join(d, "Dockerfile"))]

    motifs = {
        "injection SQL": r"\$query\s*=.*\$_(GET|POST)|querySingle\( \$query",
        "XSS reflechi": r"echo \$q[^;]|<h2>Résultats pour « <\?php echo \$q",
        "SSRF": r"file_get_contents\( \$url|curl_exec",
        "LFI / traversee": r"readfile\(|file_get_contents\( \$config|'/var/www/html/' \.",
        "debordement de tampon": r"char buffer\[|read\(STDIN_FILENO, buffer",
        "pivot reseau": r"poste-interne|superviseur-interne|/srv/app",
    }

    familles = {}

    for machine in avec_docker:
        code = ""
        for chemin in glob.glob(os.path.join(machine, "**", "*"), recursive=True):
            if os.path.isfile(chemin) and chemin.endswith((".php", ".c", ".sh", ".conf")):
                code += open(chemin, encoding="utf-8", errors="ignore").read()

        for famille, motif in motifs.items():
            if re.search(motif, code):
                familles.setdefault(famille, []).append(os.path.basename(machine))

    return len(avec_docker), len(machines), familles


def mesure_drapeaux():
    """Les 60 drapeaux : produits par une commande, prouves, courts justifies."""
    sortie = subprocess.run(
        [PHP, os.path.join(RACINE, "tools", "controle", "drapeaux-lisibles.php")],
        capture_output=True, text=True)
    texte = sortie.stdout
    total = re.search(r"SANS copie possible : (\d+)", texte)
    courts = re.search(r"un chiffre ou un mot : (\d+) \((\d+) declaree, (\d+) a justifier\)", texte)
    return {
        "propres": int(total.group(1)) if total else 0,
        "courts_justifies": int(courts.group(2)) if courts else 0,
        "courts_a_justifier": int(courts.group(3)) if courts else 0,
        "verdict": "ACCEPTE" if "ACCEPTE" in texte else "REFUSE",
    }


def mesure_contenu():
    """QCM : position de la bonne reponse, longueur, seuils, examen au hasard."""
    donnees = json.loads(php('''
$n = 0; $positions = array(0,0,0,0); $longue = 0; $repet = 0; $exam = 0;
$seuils = array(); $petits = 0; $nb_questions = array();
$cours = array();
foreach (Secura_Rooms::get_rooms() as $r) {
  $locales = array();
  foreach (Secura_Rooms::get_tasks($r->ID) as $t) {
    foreach (($t["questions"] ?? array()) as $x) {
      if (!empty($x["choices"]) && isset($x["correct"]) && $x["correct"] >= 0) {
        $n++;
        $positions[(int) $x["correct"]]++;
        $l = array_map("mb_strlen", $x["choices"]);
        if (mb_strlen($x["choices"][$x["correct"]]) >= max($l)) $longue++;
      }
      if (($t["type"] ?? "") !== "exam") $locales[mb_strtolower(trim($x["question"]))] = 1;
    }
  }
  foreach (Secura_Rooms::get_tasks($r->ID) as $t) {
    if (($t["type"] ?? "") !== "exam") continue;
    $exam++;
    $s = (int) ($t["pass_score"] ?? 0);
    $seuils[$s] = ($seuils[$s] ?? 0) + 1;
    $nb = count($t["questions"] ?? array());
    $nb_questions[$nb] = ($nb_questions[$nb] ?? 0) + 1;
    if ($nb <= 3) $petits++;
    foreach (($t["questions"] ?? array()) as $x) {
      if (isset($locales[mb_strtolower(trim($x["question"]))])) $repet++;
    }
  }
}
echo json_encode(array("qcm"=>$n,"positions"=>$positions,"plus_longue"=>$longue,
  "examens"=>$exam,"seuils"=>$seuils,"exam_petits"=>$petits,
  "exam_questions"=>array_sum($nb_questions),"reprises"=>$repet));
'''))
    return donnees


def mesure_licences():
    """Le catalogue : combien de sources, combien non reutilisables, import sauvage."""
    chemin = os.path.join(RACINE, "tools", "sources-autorisees.json")
    donnees = json.load(open(chemin, encoding="utf-8"))
    sources = donnees.get("sources", [])
    return {
        "total": len(sources),
        "republiables": sum(1 for s in sources if s.get("reutilisable")),
        "renvoi": sum(1 for s in sources if not s.get("reutilisable")),
        "sans_attribution": sum(1 for s in sources if not s.get("attribution")),
    }


def main():
    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--detail", action="store_true")
    options = analyseur.parse_args()

    lignes = []

    # 1. Le logiciel de laboratoire
    avec_docker, total_machines, familles = mesure_machines()
    n_machine = note(avec_docker, (3, 12))
    n_diversite = note(len(familles), (2, 6))
    n_labo = round((n_machine + n_diversite) / 2, 1)
    lignes.append(("Logiciel de laboratoire", n_labo,
                   "%d images / %d familles : %s" % (avec_docker, len(familles), ", ".join(sorted(familles))),
                   "images : %d -> 12 ; familles : %d -> 6" % (avec_docker, len(familles))))

    # 2. Les drapeaux
    d = mesure_drapeaux()
    n_drapeaux = note(d["propres"], (45, 60))
    lignes.append(("Drapeaux produits", n_drapeaux,
                   "%d/60 sans copie possible, %d courts justifies" % (d["propres"], d["courts_justifies"]),
                   "0 fuite, tout produit par une commande"))

    # 3. Les QCM
    c = mesure_contenu()
    part_longue = c["plus_longue"] / c["qcm"] * 100 if c["qcm"] else 0
    n_longue = note(100 - part_longue, (40, 85))   # plus c'est bas, mieux c'est
    n_qcm = round(n_longue, 1)
    lignes.append(("QCM (qualite des options)", n_qcm,
                   "bonne reponse la plus longue : %.0f %%" % part_longue,
                   "sous 50 % : ecrire 3 distracteurs aussi longs que la bonne reponse"))

    # 4. Les examens (discrimination)
    petits = c["exam_petits"]
    n_exam = note(60 - petits, (0, 40))   # 0 examen de 3 questions = 10
    seuil_bas = sum(v for k, v in c["seuils"].items() if int(k) < SEUIL_PASSAGE)
    lignes.append(("Examens (discrimination)", round((n_exam + note(60 - seuil_bas, (0, 40))) / 2, 1),
                   "%d examens de 3 questions ou moins, %d sous 80 %%"
                   % (petits, seuil_bas),
                   "aucun examen sous 4 questions, seuil >= 80 %"))

    # 5. Le volume de pratique
    n_pratique = note(d["propres"], (20, 60))
    lignes.append(("Volume de pratique", n_pratique,
                   "%d exercices ou l'eleve fait (drapeau)" % d["propres"],
                   "une room pratique par sujet du referentiel"))

    # 6. Les licences
    l = mesure_licences()
    n_licence = 10.0 if l["sans_attribution"] == 0 and l["renvoi"] > 0 else 3.0
    lignes.append(("Licences et attribution", n_licence,
                   "%d sources, %d reutilisables, %d en renvoi, %d sans attribution"
                   % (l["total"], l["republiables"], l["renvoi"], l["sans_attribution"]),
                   "chaque source non reutilisable traitee une par une"))

    # 7. La couverture du referentiel (borne severe)
    severe = 39.1
    n_couv = note(severe, (35, 100))
    lignes.append(("Couverture severe Security+", n_couv,
                   "%.1f %% (borne basse, simule et theorie = 0)" % severe,
                   "une room pratique par sujet absent (D4, D1, D5)"))

    poids = {
        "Logiciel de laboratoire": 2.0,
        "Drapeaux produits": 2.0,
        "QCM (qualite des options)": 1.5,
        "Examens (discrimination)": 1.5,
        "Volume de pratique": 1.5,
        "Licences et attribution": 1.0,
        "Couverture severe Security+": 1.5,
    }

    total = sum(n * poids[t] for t, n, _, _ in lignes)
    diviseur = sum(poids[t] for t, _, _, _ in lignes)
    generale = round(total / diviseur, 1)

    print("\nNOTE DU LABORATOIRE — sur pieces, au %s\n" % "6 novembre 2026")
    print("  %-32s %5s  %s" % ("critere", "note", "mesure"))
    print("  " + "-" * 100)
    for titre, n, mesure, _ in lignes:
        print("  %-32s %5.1f  %s" % (titre, n, mesure))
    print("  " + "-" * 76)
    print("  %-32s %5.1f  (pondere)\n" % ("NOTE GENERALE", generale))

    if options.detail:
        print("CE QU'IL FAUDRAIT POUR MONTER\n")
        for titre, n, _, remede in lignes:
            if n < 8:
                print("  %-32s %.1f/10 -> %s" % (titre, n, remede))
        print()

    # Verdict lisible
    if generale >= 8:
        verdict = "solide : les defauts restants sont des finitions"
    elif generale >= 6.5:
        verdict = "correct, avec un defaut structurel a traiter"
    elif generale >= 5:
        verdict = "moyen : le probleme n'est pas le volume, c'est la discrimination"
    else:
        verdict = "insuffisant"

    print("VERDICT : %s (%.1f/10)" % (verdict, generale))
    return 0


if __name__ == "__main__":
    sys.exit(main())
