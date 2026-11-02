#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""Importer des questions venues de l'exterieur (universites, examens).

On ne redige rien : cet outil ne fait qu'injecter des questions deja
validees, en verifiant :

1. que la source est dans le catalogue `tools/sources-autorisees.json` ;
2. que la licence annoncee est bien celle du catalogue ;
3. que l'attribution et le lien sont presents ;
4. que chaque question respecte le format de la plateforme ;
5. que l'usage est compatible avec la licence : si l'import est destine a un
   service payant (`--commercial`), une licence « NC » (non commerciale)
   est refusee — et une source non reutilisable l'est aussi, meme si on a
   reordonne les questions ou change leurs numeros : une transformation ne
   redonne pas une licence.

Le resultat est un fichier PHP (`includes/content-import-<id>.php`) que le
plugin charge au demarrage. Les questions importees sont ajoutees a la
tache demandee de la room demandee ; leur attribution est conservee et
affichee dans la room.

Usage :
    python3 tools/import-questions.py --verifier <lot.json>
    python3 tools/import-questions.py --importer <lot.json> [--sortie <dossier>]
    python3 tools/import-questions.py --importer-dossier <dossier> [--sortie <dossier>]

Option :
    --commercial  l'import est destine a un service payant (abonnement,
                 cours premium). Les licences non commerciales sont alors
                 refusees : le site actuel est gratuit pour les eleves,
                 il ne peut pas le devenir avec ce contenu.
"""

from __future__ import annotations

import argparse
import json
import os
import sys
from datetime import datetime, timezone

RACINE = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
CATALOGUE = os.path.join(RACINE, "tools", "sources-autorisees.json")
SORTIE_PAR_DEFAUT = os.path.join(
    RACINE, "wp-content", "plugins", "secura-academy", "includes"
)

MODES_VALIDES = ("choice", "text", "flag", "action", "solution")


class ErreurImport(Exception):
    """Erreur claire, destinee a etre lue par un non-technicien."""


def charger_json(path):
    try:
        with open(path, "r", encoding="utf-8") as f:
            return json.load(f)
    except FileNotFoundError:
        raise ErreurImport("Fichier introuvable : %s" % path)
    except json.JSONDecodeError as exc:
        raise ErreurImport("JSON illisible (%s) : %s" % (path, exc))


def catalogue():
    donnees = charger_json(CATALOGUE)
    sources = {}
    for source in donnees.get("sources", []):
        sources[source["id"]] = source
    return sources


def verifier_lot(lot, sources, commercial=False):
    """Renvoie la liste des problemes rencontres (vide si tout va bien)."""
    problemes = []

    identifiant = lot.get("source")
    if not identifiant:
        return ["Le lot ne dit pas d'ou viennent les questions (cle 'source' manquante)."]

    source = sources.get(identifiant)
    if source is None:
        return [
            "Source inconnue : '%s'. Elle n'est pas dans tools/sources-autorisees.json "
            "-> import refuse." % identifiant
        ]

    if not source.get("reutilisable", False):
        return [
            "Source '%s' : la licence verifiee ne permet pas de reutiliser le contenu "
            "-> import refuse. Reordonner les questions, les renumeroter ou les "
            "reformuler ne change rien : une transformation d'un contenu protege "
            "reste un contenu protege, et la licence d'origine s'applique toujours."
            % identifiant
        ]

    if commercial and not source.get("commercial", False):
        return [
            "Source '%s' : la licence %s n'autorise PAS un usage commercial "
            "(pas de service payant, pas d'abonnement, pas de cours vendu). "
            "L'import est refuse pour un usage payant ; il reste autorise pour un "
            "site gratuit. Alternatives : obtenir une autorisation ecrite de "
            "l'editeur, ou choisir une source libre compatible avec un usage "
            "commercial." % (identifiant, source.get("licence", ""))
        ]

    licence = (lot.get("licence") or "").strip()
    if not licence:
        problemes.append("La licence n'est pas indiquee dans le lot.")
    elif licence.lower() != source["licence"].lower():
        problemes.append(
            "La licence annoncee (%s) ne correspond pas au catalogue (%s)."
            % (licence, source["licence"])
        )

    if not (lot.get("attribution") or "").strip():
        problemes.append("L'attribution est vide : impossible de crediter la source.")

    url = (lot.get("url") or "").strip()
    if not url and source.get("url"):
        problemes.append("Le lien de la source est vide.")
    if url and not url.startswith("http"):
        problemes.append("Le lien de la source n'est pas une adresse web : %s" % url)

    rooms = lot.get("rooms")
    if not isinstance(rooms, list) or not rooms:
        return problemes + ["Le lot ne contient aucune room (cle 'rooms' vide)."]

    for room in rooms:
        slug = room.get("room")
        if not slug:
            problemes.append("Une room du lot n'a pas de slug (cle 'room' manquante).")
            continue
        if not (room.get("title") or "").strip():
            problemes.append("La room '%s' n'a pas de titre." % slug)

        taches = room.get("tasks") or {}
        if not isinstance(taches, dict) or not taches:
            problemes.append("La room '%s' n'a aucune tache." % slug)
            continue

        for type_tache, questions in taches.items():
            if type_tache not in ("practice", "test", "exam"):
                problemes.append(
                    "La room '%s' utilise une tache inconnue '%s' "
                    "(attendu : practice, test ou exam)." % (slug, type_tache)
                )
                continue
            if not isinstance(questions, list) or not questions:
                problemes.append(
                    "La tache '%s' de la room '%s' ne contient aucune question."
                    % (type_tache, slug)
                )
                continue
            problemes.extend(verifier_questions(questions, slug, type_tache, source))

    return problemes


def verifier_questions(questions, slug, type_tache, source):
    problemes = []
    attribution = source["attribution"]
    licence = source["licence"]

    for index, question in enumerate(questions, start=1):
        prefixe = "Room '%s', tache '%s', question %d" % (slug, type_tache, index)
        enonce = (question.get("question") or "").strip()
        if not enonce:
            problemes.append("%s : l'enonce est vide." % prefixe)
            continue

        mode = (question.get("mode") or "choice").strip()
        if mode not in MODES_VALIDES:
            problemes.append(
                "%s : mode inconnu '%s' (attendu : %s)."
                % (prefixe, mode, ", ".join(MODES_VALIDES))
            )
            continue

        if mode == "choice":
            choix = question.get("choices")
            if not isinstance(choix, list) or len(choix) < 2:
                problemes.append("%s : une question a choix demande au moins 2 propositions." % prefixe)
                continue
            if len(set(str(c) for c in choix)) != len(choix):
                problemes.append("%s : deux propositions sont identiques." % prefixe)
            index_correct = question.get("correct")
            if not isinstance(index_correct, int) or not 0 <= index_correct < len(choix):
                problemes.append(
                    "%s : l'index de la bonne reponse doit etre un nombre entre 0 et %d."
                    % (prefixe, len(choix) - 1)
                )

        if mode == "text":
            reponses = question.get("answers")
            if not isinstance(reponses, list) or not reponses:
                problemes.append("%s : une question libre demande au moins une reponse acceptée." % prefixe)

        if mode == "flag" and not (question.get("flag_path") or "").strip():
            problemes.append("%s : une question de drapeau doit indiquer le fichier du drapeau." % prefixe)

        if mode == "solution":
            # Un probleme d'examen universitaire : l'eleve redige sa
            # reponse, et la correction officielle de l'ecole lui est
            # montree. Il faut donc une correction officielle — et
            # surtout pas de propositions a deviner.
            if question.get("choices"):
                problemes.append(
                    "%s : une question « solution » ne propose pas de propositions : c'est une redaction." % prefixe
                )
            if len((question.get("explanation") or "").strip()) < 80:
                problemes.append(
                    "%s : la correction officielle d'une question « solution » doit etre complete (80 caracteres minimum)." % prefixe
                )

        if not (question.get("explanation") or "").strip():
            problemes.append(
                "%s : l'explication est vide. Elle explique l'erreur, c'est la moitié du travail." % prefixe
            )

        if (question.get("source") or "").strip() != attribution:
            problemes.append(
                "%s : l'attribution doit etre exactement '%s'." % (prefixe, attribution)
            )

        xp = question.get("xp", 20)
        if not isinstance(xp, int) or xp <= 0:
            problemes.append("%s : les XP doivent etre un nombre entier positif." % prefixe)

        licence_question = (question.get("licence") or "").strip()
        if licence_question.lower() != licence.lower():
            problemes.append(
                "%s : la licence de la question (%s) doit correspondre a celle de la source (%s)."
                % (prefixe, licence_question or "vide", licence)
            )

    return problemes


def echapper_php(valeur):
    if valeur is None:
        return "null"
    if isinstance(valeur, bool):
        return "true" if valeur else "false"
    if isinstance(valeur, (int, float)):
        return str(valeur)
    if isinstance(valeur, list):
        return "array(" + ", ".join(echapper_php(v) for v in valeur) + ")"
    if isinstance(valeur, dict):
        morceaux = []
        for cle, val in valeur.items():
            morceaux.append("%s => %s" % (echapper_php(cle), echapper_php(val)))
        return "array(" + ", ".join(morceaux) + ")"
    texte = str(valeur)
    # Un texte importe peut contenir des fins de ligne : on retire les
    # espaces en fin de ligne (la CI les refuse) et on normalise les fins
    # de ligne, sans toucher au contenu.
    texte = "\n".join(ligne.rstrip() for ligne in texte.replace("\r\n", "\n").split("\n"))
    texte = texte.replace("\\", "\\\\").replace("'", "\\'")
    return "'%s'" % texte


def generer_php(lot, source):
    identifiant = lot["source"].replace("-", "_")
    lignes = []
    lignes.append("<?php")
    lignes.append("/**")
    lignes.append(" * Questions importees — %s" % source["nom"])
    lignes.append(" *")
    lignes.append(" * Genere par tools/import-questions.py : ne pas editer a la main.")
    lignes.append(" * Licence : %s" % source["licence"])
    lignes.append(
        " * Usage commercial : %s"
        % ("autorise" if source.get("commercial", False) else "NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves")
    )
    lignes.append(" * Attribution : %s" % source["attribution"])
    lignes.append(" */")
    lignes.append("if ( ! function_exists( 'seca_import_%s' ) ) {" % identifiant)
    lignes.append("\tfunction seca_import_%s() {" % identifiant)
    lignes.append("\t\treturn array(")
    lignes.append("\t\t\t'source' => %s," % echapper_php({
        "id": source["id"],
        "nom": source["nom"],
        "url": source.get("url", ""),
        "licence": source["licence"],
        "attribution": source["attribution"],
    }))
    lignes.append("\t\t\t'rooms' => array(")

    for room in lot.get("rooms", []):
        slug = room["room"]
        lignes.append("\t\t\t\t%s => array(" % echapper_php(slug))
        lignes.append("\t\t\t\t\t'title' => %s," % echapper_php(room.get("title", "")))
        lignes.append("\t\t\t\t\t'tasks' => array(")
        for type_tache, questions in (room.get("tasks") or {}).items():
            lignes.append("\t\t\t\t\t\t%s => array(" % echapper_php(type_tache))
            for question in questions:
                question = dict(question)
                question.setdefault("mode", "choice")
                question.setdefault("source", source["attribution"])
                question.setdefault("licence", source["licence"])
                lignes.append("\t\t\t\t\t\t\t%s," % echapper_php(question))
            lignes.append("\t\t\t\t\t\t),")
        lignes.append("\t\t\t\t\t),")
        lignes.append("\t\t\t\t),")

    lignes.append("\t\t\t),")
    lignes.append("\t\t);")
    lignes.append("\t}")
    lignes.append("}")
    lignes.append("")
    return "\n".join(lignes)


def importer(lot, sources, dossier_sortie, verifier_seulement=False, commercial=False):
    problemes = verifier_lot(lot, sources, commercial=commercial)

    if problemes:
        print("IMPORT REFUSE — %d probleme(s) :" % len(problemes))
        for probleme in problemes:
            print("  - %s" % probleme)
        return 1

    identifiant = lot["source"]
    source = sources[identifiant]
    nb = sum(
        len(questions)
        for room in lot.get("rooms", [])
        for questions in (room.get("tasks") or {}).values()
    )

    if verifier_seulement:
        print("Lot '%s' valide : %d question(s) pretes a etre importees." % (identifiant, nb))
        return 0

    os.makedirs(dossier_sortie, exist_ok=True)
    fichier = os.path.join(dossier_sortie, "content-import-%s.php" % identifiant.replace("-", "_"))
    with open(fichier, "w", encoding="utf-8") as f:
        f.write(generer_php(lot, source))

    print("Import '%s' : %d question(s) ecrites dans %s" % (identifiant, nb, fichier))
    print("  Licence      : %s" % source["licence"])
    print(
        "  Usage payant : %s"
        % ("autorise par la licence" if source.get("commercial", False) else "NON autorise par la licence (usage non commercial)")
    )
    print("  Attribution  : %s" % source["attribution"])
    print("  Le plugin recharge ces questions au demarrage (reactivation du plugin).")
    return 0


def main(argv=None):
    analyseur = argparse.ArgumentParser(description=__doc__)
    groupe = analyseur.add_mutually_exclusive_group(required=True)
    groupe.add_argument("--verifier", help="verifier un lot sans rien ecrire")
    groupe.add_argument("--importer", help="verifier puis ecrire un lot")
    groupe.add_argument(
        "--importer-dossier", help="verifier puis ecrire tous les lots d'un dossier"
    )
    analyseur.add_argument("--sortie", default=SORTIE_PAR_DEFAUT, help="dossier de sortie")
    analyseur.add_argument(
        "--commercial",
        action="store_true",
        help="l'import est destine a un service payant : les licences non commerciales sont refusees",
    )
    args = analyseur.parse_args(argv)

    sources = catalogue()
    code = 0

    if args.verifier:
        code = importer(
            charger_json(args.verifier), sources, args.sortie,
            verifier_seulement=True, commercial=args.commercial,
        )
    elif args.importer:
        code = importer(
            charger_json(args.importer), sources, args.sortie, commercial=args.commercial
        )
    else:
        dossiers = sorted(
            os.path.join(args.importer_dossier, nom)
            for nom in os.listdir(args.importer_dossier)
            if nom.endswith(".json")
        )
        if not dossiers:
            print("Aucun lot .json dans %s" % args.importer_dossier)
            return 1
        for chemin in dossiers:
            print("---- %s ----" % os.path.basename(chemin))
            code = max(
                code,
                importer(
                    charger_json(chemin), sources, args.sortie,
                    commercial=args.commercial,
                ),
            )

    return code


if __name__ == "__main__":
    sys.exit(main())
