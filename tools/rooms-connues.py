#!/usr/bin/env python3
"""Liste les rooms reelles du plugin, a partir de son code PHP.

Pourquoi ce fichier existe
--------------------------
Une room dans un lot de questions qui n'existe pas dans le plugin n'est
PAS signalee : le plugin ignore silencieusement les questions d'une room
inconnue. Une faute de frappe dans un lot disparait donc sans bruit.
Pour que cela ne puisse plus arriver, chaque lot est verifie contre la
liste des rooms reelles.

Comment la liste est produite
-----------------------------
Les rooms sont declarees dans les fichiers de contenu du plugin, avec
un titre (« title »). WordPress en tire le slug (post_name) avec
sanitize_title() : minuscules, accents retires, tout ce qui n'est pas
une lettre, un chiffre ou un tiret devient un tiret.

On reproduit cette regle ici, puis on compare avec les rooms reellement
creees sur le site (option --verifier-site) : le fichier JSON ecrit
n'est accepte que si les deux listes tombent d'accord.

Usage :
    python3 tools/rooms-connues.py --ecrire tools/rooms-connues.json
    python3 tools/rooms-connues.py --ecrire tools/rooms-connues.json --verifier-site
"""

import argparse
import io
import json
import os
import re
import subprocess
import sys
import unicodedata

RACINE = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))

FICHIERS_CONTENU = (
    "wp-content/plugins/secura-academy/includes/default-content.php",
    "wp-content/plugins/secura-academy/includes/content-m3.php",
    "wp-content/plugins/secura-academy/includes/content-universites.php",
)

# Titre d'une room. On ne se fie pas a l'indentation (elle change d'un
# fichier a l'autre) : une room est reperee par sa cle 'difficulty' (une
# tache n'en a pas), et son titre est le dernier 'title' vu avant elle.
RE_DIFFICULTE = re.compile(r"^[ \t]*'difficulty'\s*=>", re.MULTILINE)
RE_TITRE = re.compile(r"^[ \t]*'title'\s*=>\s*'(.*)',\s*$", re.MULTILINE)


def slug_wordpress(titre):
    """Reproduit sanitize_title() de WordPress (contexte 'display').

    WordPress retire les accents, SUPPRIME les caracteres qui ne sont pas
    des lettres, chiffres, espaces, tirets ou soulignes (une apostrophe
    disparait au lieu de devenir un tiret), puis transforme les espaces
    en tirets.
    """
    texte = titre.lower()
    sans_accents = "".join(
        caractere
        for caractere in unicodedata.normalize("NFD", texte)
        if unicodedata.category(caractere) != "Mn"
    )
    sans_accents = sans_accents.replace("ß", "ss").replace("æ", "ae")
    sans_accents = sans_accents.replace("œ", "oe").replace("ø", "o")
    # Suppression (et non remplacement) des caracteres interdits.
    tirets = re.sub(r"[^a-z0-9\s_-]", "", sans_accents)
    tirets = re.sub(r"[\s_]+", "-", tirets)
    tirets = re.sub(r"-{2,}", "-", tirets)
    return tirets.strip("-")


def titres_rooms(racine=RACINE):
    """Les titres de toutes les rooms declarees dans le plugin."""
    titres = []
    for relatif in FICHIERS_CONTENU:
        chemin = os.path.join(racine, relatif)
        with io.open(chemin, encoding="utf-8") as fichier:
            contenu = fichier.read()
        for bloc in re.findall(
            r"function\s+seca_default_rooms[a-z0-9_]*\s*\(\s*\)\s*\{(.*?)\n\}",
            contenu,
            re.DOTALL,
        ):
            for difficultes in RE_DIFFICULTE.finditer(bloc):
                precedents = list(RE_TITRE.finditer(bloc, 0, difficultes.start()))
                if precedents:
                    titres.append(precedents[-1].group(1))
    return titres


def rooms_du_site(chemin_wp="/home/user/wp", wp_cli="/home/user/wp-cli.phar"):
    """Les rooms reellement creees sur le site local (slug => titre)."""
    script = (
        "<?php\n"
        "$posts = get_posts(array('post_type' => SECURA_POST_TYPE, "
        "'post_status' => 'any', 'numberposts' => -1, 'fields' => 'ids'));\n"
        "$sortie = array();\n"
        "foreach ($posts as $id) { $p = get_post($id); "
        "$sortie[$p->post_name] = $p->post_title; }\n"
        "echo json_encode($sortie);\n"
    )
    chemin_script = "/tmp/_rooms_php.php"
    with io.open(chemin_script, "w", encoding="utf-8") as fichier:
        fichier.write(script)
    resultat = subprocess.run(
        ["php", wp_cli, "--path=%s" % chemin_wp, "eval-file", chemin_script],
        capture_output=True,
        text=True,
    )
    sortie = resultat.stdout.strip()
    debut = sortie.find("{")
    fin = sortie.rfind("}")
    if debut < 0 or fin < 0:
        raise RuntimeError("le site local n'a pas repondu : %s" % sortie[:200])
    return json.loads(sortie[debut:fin + 1])


def main(argv=None):
    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--ecrire", help="fichier JSON a ecrire")
    analyseur.add_argument("--verifier-site", action="store_true")
    analyseur.add_argument("--wp", default="/home/user/wp")
    analyseur.add_argument("--wp-cli", default="/home/user/wp-cli.phar")
    args = analyseur.parse_args(argv)

    titres = titres_rooms()
    rooms = {}
    for titre in titres:
        rooms[slug_wordpress(titre)] = titre
    rooms = dict(sorted(rooms.items()))
    print("%d room(s) declaree(s) dans le plugin" % len(rooms))

    if args.verifier_site:
        reels = rooms_du_site(args.wp, args.wp_cli)
        manquantes = set(rooms) - set(reels)
        en_trop = set(reels) - set(rooms)
        if manquantes or en_trop:
            print("Les listes ne tombent pas d'accord :", file=sys.stderr)
            for slug in sorted(manquantes):
                print("  declaree mais absente du site : %s" % slug, file=sys.stderr)
            for slug in sorted(en_trop):
                print("  sur le site mais non declaree  : %s" % slug, file=sys.stderr)
            return 1
        print("Les %d rooms du site correspondent aux declarations du plugin." % len(reels))

    if args.ecrire:
        with io.open(args.ecrire, "w", encoding="utf-8") as fichier:
            json.dump(rooms, fichier, ensure_ascii=False, indent=1, sort_keys=True)
            fichier.write("\n")
        print("Ecrit : %s" % args.ecrire)
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
