#!/usr/bin/env python3
"""Appariement d'un examen avec son corrigé, dans un dossier OCW.

Pourquoi ce module existe
-------------------------
Les fichiers d'OCW sont nommés ainsi :

    6b7e833111c72d30c8dc133595ae56e3_MIT6_253S12_hw01.pdf        (l'énoncé)
    1c82f0600edcf8ab4da06362882b5d7b_MIT6_253S12_hw01_sol.pdf   (le corrigé)

Le **hash du début diffère** d'un fichier à l'autre : c'est un
identifiant de ressource, pas du contenu. Un appariement naïf, qui
cherche `<nom exact>_sol.txt`, ne trouve donc jamais le corrigé.

La règle : on essaie d'abord l'appariement exact (rapide, et le plus
sûr quand il fonctionne) ; sinon on **retire le hash** des deux côtés
et on apparie sur le reste du nom, qui est le vrai titre du document.

Le point important : on ne devine jamais. Si l'appariement est ambigu
— deux corrigés pour le même énoncé — on renvoie `None` et l'extracteur
refuse le document, plutôt que de choisir au hasard.
"""

import os
import re

# Les suffixes que MIT emploie pour le corrigé.
SUFFIXES_CORRIGE = (
    "_sol",
    "_soln",
    "_solution",
    "_solutions",
    "-solutions",
    "_answer",
    "_answers",
    "_key",
    "solution",
    "solutions",
)

# Certains cours mettent le mot « sol » EN TETE du nom du corrige
# (`sol_pset01.pdf` pour `pset01.pdf`).
PREFIXES_CORRIGE = (
    "sol_",
    "soln_",
    "solution_",
    "solutions_",
    "answer_",
    "answers_",
)

# Le hash de ressource : 32 caractères hexadécimaux, puis un tiret bas.
RE_HASH = re.compile(r"^[0-9a-f]{32}_", re.I)


def sans_hash(nom):
    """Retire le hash de ressource du début d'un nom de fichier."""
    return RE_HASH.sub("", nom)


def _est_un_corrige(nom):
    """Le nom est-il celui d'un corrigé ?

    Le marqueur (« sol », « soln », « solution », « answers », « key »)
    n'est pas toujours à la fin : MIT 6.832 écrit
    « ..._sol_pset01.pdf ». On le cherche donc partout dans le nom, mais
    en mot entier : « keyboard » n'est pas un corrigé.
    """
    return bool(RE_MARQUEUR.search(sans_hash(nom))
                or RE_MARQUEUR_COLLE.search(sans_hash(nom)))


def _base_sans_suffixe(nom):
    """Le nom de l'énoncé, corrigé de son suffixe ou préfixe de corrigé."""
    base = sans_hash(nom)
    minuscule = base.lower()
    for suffixe in SUFFIXES_CORRIGE:
        if minuscule.endswith(suffixe) and len(base) > len(suffixe):
            return base[: -len(suffixe)]
    for prefixe in PREFIXES_CORRIGE:
        if minuscule.startswith(prefixe) and len(base) > len(prefixe):
            return base[len(prefixe):]
    return base


# Le mot « sol » n'est pas toujours a la fin du nom : MIT 6.832 ecrit
# « MIT6_832s09_sol_pset01.pdf » pour le corrige de « ..._pset01.pdf ».
# On compare donc des « squelettes » : le nom sans le hash, sans le mot
# qui designe le corrige, et sans separateurs.
#
# Le marqueur est parfois **colle** au mot qui precede : le MIT 14.15J
# ecrit « ..._examsol.pdf » pour « ..._exam.pdf ». D'ou la seconde
# alternative : un mot connu suivi de « sol ».
RE_MARQUEUR = re.compile(
    r"(?<![a-z])(sol|soln|solution|solutions|answer|answers|key)(?![a-z])",
    re.I
)

# Le marqueur colle : « examsol » est le corrige de « exam ». On retire
# seulement « sol » et on garde le mot : « examsol » -> « exam ».
RE_MARQUEUR_COLLE = re.compile(
    r"(exam|quiz|hw|homework|problem|pset|midterm|mid|final|practice)soln?(?![a-z])",
    re.I
)


def _sans_marqueur(texte):
    """Retire le marqueur de corrige, en gardant le mot qui le porte."""
    texte = RE_MARQUEUR.sub("", texte)
    return RE_MARQUEUR_COLLE.sub(lambda m: m.group(1), texte)


def squelette(nom):
    """Le nom du document, hash et marqueur de corrigé retirés."""
    base = sans_hash(nom).lower()
    # L'extension n'est pas du document : « exam.pdf » et « examsol.pdf »
    # doivent donner le meme squelette une fois le marqueur retire.
    for extension in (".txt", ".pdf"):
        if base.endswith(extension):
            base = base[: -len(extension)]
    base = _sans_marqueur(base)
    return re.sub(r"[_\-\s.]+", "", base)


def lister(dossier):
    """Les fichiers de texte du dossier.

    Le téléchargeur nomme le texte d'un PDF `<nom-du-pdf>.txt` :
    `MIT6_253S12_hw01.pdf.txt`. On garde le nom tel quel, mais on
    distingue le document (sans « .txt ») de son fichier texte.
    """
    return sorted(f for f in os.listdir(dossier) if f.endswith(".txt"))


def _nom_document(nom_fichier):
    """Le nom du document, sans « .txt » ni « .pdf »."""
    base = nom_fichier[:-4] if nom_fichier.endswith(".txt") else nom_fichier
    if base.lower().endswith(".pdf"):
        base = base[:-4]
    return base


def apparier(nom_enonce, dossier):
    """Le chemin du corrigé de `nom_enonce`, ou None.

    `nom_enonce` est le nom du fichier texte (avec « .txt »).
    """
    base = _nom_document(nom_enonce)

    # 1. Appariement exact : le plus sûr quand il fonctionne.
    for suffixe in ("_sol", "_soln", "_solution", "_solutions", "-solutions",
                    "_answers", "_answer", "_key"):
        candidat = os.path.join(dossier, base + suffixe + ".txt")
        if os.path.exists(candidat):
            return candidat

    # 2. Appariement sans le hash : le vrai titre du document.
    #    Le candidat doit ETRE un corrige du meme document : son squelette
    #    (hash et marqueur retires) doit etre celui de l'enonce.
    #    Sans la premiere condition, l'enonce s'apparie a lui-meme ; sans la
    #    seconde, on pourrait apparier un corrige a l'enonce d'un autre.
    cible = squelette(base)
    if not cible:
        return None
    trouves = []
    for nom in os.listdir(dossier):
        if not nom.endswith(".txt"):
            continue
        document = _nom_document(nom)
        if document == base:
            continue
        if squelette(document) != cible:
            continue
        if not _est_un_corrige(document):
            continue
        trouves.append(os.path.join(dossier, nom))
    if len(trouves) == 1:
        return trouves[0]
    # Deux candidats : on ne choisit pas au hasard.
    return None


def enonces_avec_corrige(dossier):
    """Les paires (enoncé, corrigé) du dossier, en ignorant les énoncés
    sans corrigé. Les énoncés sont identifiés par le fait qu'ils ne
    sont PAS un corrigé."""
    paires = []
    for nom in lister(dossier):
        if _est_un_corrige(nom):
            continue
        corrige = apparier(nom, dossier)
        if corrige:
            paires.append((os.path.join(dossier, nom), corrige))
    return paires
