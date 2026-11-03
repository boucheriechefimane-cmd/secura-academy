#!/usr/bin/env python3
"""Repartition thematique des questions importees dans les rooms.

Pourquoi ce fichier existe
---------------------------
La premiere version de la repartition (dans `import-mit-ocw.py`) lisait
une table figee, `CIBLES`, qui associait a chaque room un nombre de
questions manquantes. Cette table datait d'une mesure ancienne : elle
ne savoit rien du fait que le moteur tire ses questions dans TOUTE LA
SECTION de l'elevateur, et rien non plus des cours qui ne parlent pas
de securite (bases de donnees, algorithmes, performance). Resultat : les
questions de base de donnees atterrissaient dans « authentification ».

Trois corrections, donc :

1. **La mesure remplace la table.** `repartir()` ne lit plus une liste
   figee : il lit un fichier JSON produit par une mesure reelle du site
   (`scripts/audit/probe-sections.php`). Sans ce fichier, le script
   refuse de repartir plutot que de deviner.

2. **L'unite est la section, pas la room.** `Secura_Exam::pool()`
   fusionne une room avec toutes les rooms de sa section : une question
   posee dans une room grossit le reservoir de tous les examens de la
   section. Compter le besoin room par room compte deux fois le meme
   besoin et fausse la repartition.

3. **Les themes sont declares, pas devines par mots-cles.** Une question
   de base de donnees va dans la section « Donnees et systemes » ; une
   question d'algorithme va dans la section « Stanford : comment marche
   un ordinateur ». Le classement se fait sur le COURS d'origine (que
   l'appelant declare), pas sur des mots anglais qui peuvent apparaitre
   au hasard dans une question sur les transactions.

Chaque section declare un themes : liste de themes qu'elle accepte. Une
section sans theme n'accepte rien : mieux vaut refuser une question que
la poser dans un mauvais sujet.
"""

import json
import os

# Le fichier de mesure. Il est produit par :
#
#   SECA_WP_DIR=/chemin/vers/wordpress \
#     php scripts/audit/probe-sections.php --json > tools/cibles-sections.json
#
DECLARATION = "tools/cibles-sections.json"

# Themes acceptes par section. La cle est le prefixe du nom de section
# (« parcours :: Module 4 : Memoire et defenses »), le plus court possible
# pour rester lisible. La valeur est la liste des themes du cours.
#
# Ces themes sont ceux des cours MIT/OpenCourseWare que nous importons :
#
#   cyber       — 6.858, 6.828, 14.15J (securite des systemes, OS, reseaux)
#   donnees     — 6.830 (bases de donnees)
#   algorithmes — 6.006, 6.046J (conception et analyse d'algorithmes)
#   cpp         — 1.124J (fondations du genie logiciel, C++)
#   performance — 6.172 (performance des systemes logiciels)
#   compilation — 6.004 (structures de calcul)
#   langage     — 6.035 (genie des langages)
THEMES_SECTION = {
    # Parcours « Fondations : reseaux, web et cryptographie ».
    "fondations-reseaux-web-et-cryptographie :: Module 1": ["cyber"],
    "fondations-reseaux-web-et-cryptographie :: Module 2": ["cyber"],
    "fondations-reseaux-web-et-cryptographie :: Module 3": ["cyber"],
    "fondations-reseaux-web-et-cryptographie :: Module 4": ["cyber"],
    "fondations-reseaux-web-et-cryptographie :: Module 5": ["cyber"],
    "fondations-reseaux-web-et-cryptographie :: Module 6": ["cyber"],

    # Parcours « Scenarios M3 ».
    "scenarios-m3-dix-missions-reelles :: Module 1": ["cyber"],
    "scenarios-m3-dix-missions-reelles :: Module 2": ["cyber"],
    "scenarios-m3-dix-missions-reelles :: Module 3": ["cyber"],
    "scenarios-m3-dix-missions-reelles :: Module 4": ["cyber"],
    "scenarios-m3-dix-missions-reelles :: Module 5": ["cyber"],

    # Parcours « Les universites ».
    "les-universites-22-rooms-6-cours :: MIT 6.858": ["cyber"],
    "les-universites-22-rooms-6-cours :: MIT 6.857": ["cyber"],
    "les-universites-22-rooms-6-cours :: pwn.college": ["cyber"],
    "les-universites-22-rooms-6-cours :: CYBER.ORG": ["cyber"],
    "les-universites-22-rooms-6-cours :: OWASP": ["cyber"],
    # Stanford : « comment marche un ordinateur » accueille les cours
    # qui expliquent la machine et le programme.
    "les-universites-22-rooms-6-cours :: Stanford": ["algorithmes", "cpp", "donnees", "performance"],

    # Parcours « Les labs advances ».
    "les-labs-avances-juice-shop-dojo-et-quiz :: Lab 1": ["cyber"],
    "les-labs-avances-juice-shop-dojo-et-quiz :: Le dojo": ["cyber"],
    "les-labs-avances-juice-shop-dojo-et-quiz :: Les briefs": ["cyber"],
}

# Room de rattachement d'une section : la question est posee dans la room
# dont le sujet correspond le mieux au theme. On la choisit dans la
# section, pour que l'eleve trouve la question dans le lieu ou elle a
# sa place.
#
# Le choix est explicite et verifiable : la cle est le prefixe de section,
# la valeur est le slug de la room. La liste peut contenir plusieurs
# rooms : les questions sont reparties entre elles, au prorata.
ROOMS_SECTION = {
    "fondations-reseaux-web-et-cryptographie :: Module 1": ["penser-comme-un-defenseur"],
    "fondations-reseaux-web-et-cryptographie :: Module 2": ["les-fondamentaux-du-reseau"],
    "fondations-reseaux-web-et-cryptographie :: Module 3": ["securiser-une-application-web"],
    "fondations-reseaux-web-et-cryptographie :: Module 4": ["memoire-et-defenses"],
    "fondations-reseaux-web-et-cryptographie :: Module 5": ["authentification"],
    "fondations-reseaux-web-et-cryptographie :: Module 6": ["chiffrement-et-https"],

    "scenarios-m3-dix-missions-reelles :: Module 1": ["le-service-qui-ne-repond-plus"],
    "scenarios-m3-dix-missions-reelles :: Module 2": ["la-requete-qui-ne-se-fie-a-personne"],
    "scenarios-m3-dix-missions-reelles :: Module 3": ["le-fichier-quon-naurait-pas-du-laisser"],
    "scenarios-m3-dix-missions-reelles :: Module 4": ["le-reseau-qui-parle-trop"],
    "scenarios-m3-dix-missions-reelles :: Module 5": ["le-binaire-qui-obeit-trop"],

    "les-universites-22-rooms-6-cours :: MIT 6.858": ["menaces-vulnerabilites-et-modele-de-menace"],
    "les-universites-22-rooms-6-cours :: MIT 6.857": ["segmenter-isoler-pivoter-la-securite-reseau"],
    "les-universites-22-rooms-6-cours :: pwn.college": ["x86-et-memoire-comprendre-la-pile"],
    "les-universites-22-rooms-6-cours :: CYBER.ORG": ["mots-de-passe-la-longueur-bat-la-complexite"],
    "les-universites-22-rooms-6-cours :: OWASP": ["le-top-10-owasp-et-la-surface-dattaque"],
    "les-universites-22-rooms-6-cours :: Stanford": [
        "comment-marche-un-ordinateur-de-la-donnee-au-programme",
        "donnees-et-systemes-organiser-linformation",
    ],

    "les-labs-avances-juice-shop-dojo-et-quiz :: Lab 1": ["la-boutique-en-ligne-se-connecter-en-administrateur"],
    "les-labs-avances-juice-shop-dojo-et-quiz :: Le dojo": ["ceinture-blanche-lire-chercher-comprendre"],
    "les-labs-avances-juice-shop-dojo-et-quiz :: Les briefs": ["kahoot-la-revision-des-labs-avances"],
}


class ErreurRepartition(Exception):
    """La repartition est impossible : on prefere le dire."""


def chemin_declaration(racine=None):
    if racine is None:
        racine = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
    return os.path.join(racine, DECLARATION)


def trouver_prefixe(section, prefixes):
    """Le prefixe de section le plus long qui corresponde."""
    meilleur = None
    for prefixe in prefixes:
        if section.startswith(prefixe) and (meilleur is None or len(prefixe) > len(meilleur)):
            meilleur = prefixe
    return meilleur


def lire_mesure(racine=None):
    """Lit la mesure des sections produite par la sonde.

    Le fichier doit exister : sans mesure reelle, on ne repart pas.
    """
    chemin = chemin_declaration(racine)

    if not os.path.exists(chemin):
        raise ErreurRepartition(
            "Pas de mesure des sections (%s). Lancez d'abord :\n"
            "  SECA_WP_DIR=/chemin/vers/wordpress php scripts/audit/probe-sections.php --json > %s"
            % (DECLARATION, DECLARATION)
        )

    with open(chemin, "r", encoding="utf-8") as fichier:
        mesure = json.load(fichier)

    if "sections" not in mesure:
        raise ErreurRepartition("La mesure %s ne contient aucune section." % DECLARATION)

    return mesure


def sections_pertinentes(mesure, theme):
    """Les sections qui acceptent le theme, avec le besoin de chacune.

    Le besoin d'une section est le nombre de questions qu'il lui manque
    pour que TOUS ses examens aient un reservoir assez grand : c'est le
    reservoir le plus juste de la section qui commande.
    """
    resultat = []

    for section, mesure_section in mesure["sections"].items():
        prefixe = trouver_prefixe(section, THEMES_SECTION.keys())

        if prefixe is None:
            continue

        if theme not in THEMES_SECTION[prefixe]:
            continue

        besoin = int(mesure_section.get("besoin", 0))
        pool = int(mesure_section.get("pool", 0))
        manque = max(0, besoin - pool)

        resultat.append({
            "cle": prefixe,
            "section": section,
            "manque": manque,
            "pool": pool,
            "besoin": besoin,
        })

    return resultat


def repartir(questions, theme, mesure=None, racine=None):
    """Repartit les questions d'un cours dans les sections qui l'acceptent.

    `theme` est le theme du cours d'origine (« cyber », « donnees »,
    « algorithmes »...). Il est declare par l'appelant : on ne devine
    pas le sujet d'un cours en cherchant des mots anglais dans une
    question, on le sait.

    La repartition est proportionnelle au manque de chaque section : une
    section qui manque de dix questions en prend dix fois plus qu'une
    section qui en manque une. Et une section dont le besoin est deja
    couvert ne prend rien :yon ne noie pas un reservoir deja large.

    Les questions d'un meme cours restent dans leur section : on ne
    disperse pas un cours dans tout le site, on le garde la ou il
    s'explique.
    """
    if mesure is None:
        mesure = lire_mesure(racine)

    sections = sections_pertinentes(mesure, theme)

    if not sections:
        raise ErreurRepartition(
            "Aucune section n'accepte le theme « %s ». Declare cette section dans "
            "tools/repartition-themes.py avant d'importer." % theme
        )

    # Les sections qui ont encore besoin de questions, et le plus besoin
    # en premier.
    avec_besoin = [s for s in sections if s["manque"] > 0]
    sans_besoin = [s for s in sections if s["manque"] <= 0]

    # Repartition proportionnelle au manque.
    total_manque = sum(s["manque"] for s in avec_besoin)

    par_room = {}
    restants = list(questions)
    position = 0

    if avec_besoin and total_manque > 0:
        # On donne d'abord a chaque section son manque exact, au prorata.
        quotas = []
        reste = len(restants)

        for section in avec_besoin:
            part = section["manque"] / float(total_manque)
            quotas.append([section, int(part * reste)])

        # On arrondit en comblant les sections les plus en retard.
        distribue = sum(q[1] for q in quotas)
        while distribue < len(restants):
            quotas.sort(key=lambda q: (q[1] / float(max(1, q[0]["manque"])), -q[0]["manque"]))
            quotas[0][1] += 1
            distribue += 1

        for section, quota in quotas:
            if quota <= 0:
                continue
            portion = restants[:quota]
            restants = restants[quota:]
            placer(portion, section, par_room)
            position += quota

    # Ce qui reste (et le surplus) va dans les sections du meme theme
    # dont le reservoir est le plus juste : c'est la que les copies
    # d'examen se ressemblent le moins.
    while restants:
        candidates = avec_besoin + sans_besoin
        if not candidates:
            break
        section = min(candidates, key=lambda s: s["pool"])
        portion = [restants.pop(0)]
        placer(portion, section, par_room)
        section["pool"] += 1

    return par_room

def placer(questions, section, par_room):
    """Pose les questions dans les rooms de la section.

    Si la section declare plusieurs rooms, les questions sont reparties
    entre elles : le reservoir de la section est commun, mais chaque
    room garde son propre sujet.
    """
    rooms = ROOMS_SECTION.get(section["cle"], [])

    if not rooms:
        raise ErreurRepartition(
            "La section « %s » n'a pas de room declaree dans tools/repartition-themes.py."
            % section["section"]
        )

    # On equilibre : chaque room recoit le meme nombre de questions, a
    # un pres.
    existantes = {room: len(par_room.get(room, [])) for room in rooms}
    for question in questions:
        room = min(rooms, key=lambda r: (existantes[r], rooms.index(r)))
        par_room.setdefault(room, []).append(question)
        existantes[room] += 1


if __name__ == "__main__":
    import sys

    try:
        mesure = lire_mesure()
    except ErreurRepartition as erreur:
        print(str(erreur), file=sys.stderr)
        raise SystemExit(1)

    for theme in sorted({t for liste in THEMES_SECTION.values() for t in liste}):
        sections = sections_pertinentes(mesure, theme)
        print("theme %-12s -> %d section(s)" % (theme, len(sections)))
        for section in sorted(sections, key=lambda s: -s["manque"]):
            if section["manque"] > 0:
                print("    manque %-3d %s" % (section["manque"], section["section"]))
