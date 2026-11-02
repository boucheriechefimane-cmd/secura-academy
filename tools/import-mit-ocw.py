#!/usr/bin/env python3
"""Extrait les questions d'examen de MIT 6.858 (Fall 2014) et les verifie
contre le corrige officiel.

Le principe : rien n'est invente ici. Le script lit les PDF des quiz et de
leurs corriges (texte extrait avec pdftotext), en tire les items repondus
par choix ou vrai/faux, et n'accepte un item que si la reponse est
litteralement dans le corrige officiel du MIT. La justification du corrige
devient l'explication de l'eleve : c'est la meilleure pedagogie qu'on
puisse offrir, et elle est ecrite par les enseignants du MIT.

Chaque item est rattache a son enonce parent (celui qui contient le listing
de code ou la question de reference) : sans cela, « An adversary can trick
the program... » ne veut rien dire pour l'eleve. Un item qui reste
 incomprehensible est refuse plutot qu'importe tel quel.

Les questions gardent leur langue d'origine (anglais) et leur format
d'origine (2 ou 3 propositions) : c'est un examen, on ne le reecrit pas.
Un prefixe les signale a l'eleve (« question d'examen MIT, en anglais »).

Usage :
    python3 tools/import-mit-ocw.py --texte dossier/ --sortie lot.json
"""

import argparse
import json
import os
import re
import sys

LIGATURES = {
    "ﬀ": "ff", "ﬁ": "fi", "ﬂ": "fl", "ﬃ": "ffi", "ﬄ": "ffl",
    "’": "'", "‘": "'", "“": '"', "”": '"', "—": "-", "–": "-",
}

ATTRIBUTION = ("MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 "
               "— quiz d'examen et corrigé officiel (MIT EECS)")
LICENCE = "CC BY-NC-SA 4.0"
PREFIXE = "[MIT 6.858 — question d’examen, en anglais] "
INDICE = ("Question d’examen du MIT : la justification du corrigé officiel "
          "est affichée juste après ta réponse.")

RE_ENTETE = re.compile(r"^\s*(\d+)\.\s*\[(\d+)\s*points?\]:?\s*(.*)$")
RE_CHOIX = re.compile(r"^\s*([A-D])\.\s+(\S.*)$")
RE_VRAI_FAUX = re.compile(r"^\s*([A-Z])\.\s*True\s*/\s*False\s*(.*)$")
RE_REPONSE = re.compile(r"^\s*Answer:\s*(.*)$")
RE_PAGE = re.compile(r"^\s*\d{1,3}\s*$")
RE_ENTETE_PAGE = re.compile(r"^\s*This page intentionally left blank\.\s*$")
# Titre de section du corrige (« IV User authentication ») : la justification
# d'un item s'arrete la.
RE_SECTION = re.compile(r"^\s*(?:[IVX]{1,4}|[A-H])\s+[A-Z][A-Za-z].*$")

# Un item qui renvoie a une figure, a un listing de code ou a un article ne
# se comprend pas seul : on ne l'importe pas plutot que de le rendre
# incomprehensible pour l'eleve.
RE_INCOMPLET = re.compile(
    r"\bline\s+\d+\b"                     # « Line 4 » (figure de code)
    r"|\bthe above\b"                     # « at the above lines »
    r"|\bthe figure\b"
    r"|\bas described in the paper\b"
    r"|\bfrom the paper\b"
    r"|\bthe paper\b"
    r"|\bthe authors of the paper\b"
    r"|\bcircle from the paper\b"
    r"|\bsolid circle\b"
    r"|\btest[0-9]\b"                    # fonctions test1, test2...
    r"|\bthe following (figure|lines|code snippet)\b",
    re.I,
)

JUSTIFICATION_MIN = 40   # caracteres : en dessous, MIT n'a pas explique
ENONCE_MIN = 50           # caracteres : en dessous, l'item est tronque


def nettoyer(texte):
    """Rend un texte PDF lisible : ligatures, espaces, pieds de page."""
    for avant, apres in LIGATURES.items():
        texte = texte.replace(avant, apres)
    texte = re.sub(r"[ \t]+", " ", texte)
    return texte.strip()


def lignes_utiles(chemin):
    with open(chemin, encoding="utf-8", errors="replace") as f:
        lignes = f.read().split("\n")
    return [l for l in lignes if not RE_PAGE.match(l) and not RE_ENTETE_PAGE.match(l)]


def contexte_avant(lignes, index):
    """Le paragraphe qui precede l'item : il donne souvent la question
    complete (« le systeme devient-il plus ou moins vulnerable ? »)."""
    j = index - 1
    while j >= 0 and not lignes[j].strip():
        j -= 1
    if j < 0:
        return ""
    fin = j
    while j >= 0 and lignes[j].strip():
        j -= 1
    paragraphe = " ".join(l.strip() for l in lignes[j + 1:fin + 1])
    if paragraphe.endswith("?") or "Circle the best answer" in paragraphe:
        return nettoyer(paragraphe)
    return ""


def lire_vrai_faux(lignes, i, parent):
    """Lit un item « A. True / False <enonce> » et son corrige."""
    n = len(lignes)
    m = RE_VRAI_FAUX.match(lignes[i])
    if not m:
        return None, i

    enonce = m.group(2).strip()
    i += 1
    while i < n:
        if RE_REPONSE.match(lignes[i]) or RE_VRAI_FAUX.match(lignes[i]) \
                or RE_ENTETE.match(lignes[i]) or RE_SECTION.match(lignes[i]):
            break
        enonce = (enonce + " " + lignes[i].strip()).strip()
        i += 1

    reponse = ""
    justification = []
    while i < n:
        mr = RE_REPONSE.match(lignes[i])
        if mr:
            reste = mr.group(1).strip()
            mm = re.match(r"^(True|False)\.?\s*(.*)$", reste, re.I)
            if mm:
                reponse = mm.group(1).capitalize()
                justification.append(mm.group(2))
            else:
                reponse = reste
            i += 1
            blancs = 0
            while i < n:
                if not lignes[i].strip():
                    blancs += 1
                    if blancs >= 2:
                        break
                    i += 1
                    continue
                if RE_REPONSE.match(lignes[i]) or RE_VRAI_FAUX.match(lignes[i]) \
                        or RE_ENTETE.match(lignes[i]) or RE_SECTION.match(lignes[i]) \
                        or RE_CHOIX.match(lignes[i]):
                    break
                blancs = 0
                justification.append(lignes[i].strip())
                i += 1
            break
        i += 1

    if reponse not in ("True", "False") or not enonce:
        return None, i

    if parent:
        enonce = parent + " — " + enonce

    return {
        "type": "vrai_faux",
        "enonce": enonce,
        "choix": ["True", "False"],
        "reponse": reponse,
        "justification": nettoyer(" ".join(justification)),
    }, i


def lire_choix(lignes, i, cadre):
    """Lit un item a choix multiples (« 4. [3 points]: ... A. ... B. ... »)."""
    n = len(lignes)
    choix = []
    while i < n:
        mc = RE_CHOIX.match(lignes[i])
        if not mc:
            break
        lettre = mc.group(1)
        texte = mc.group(2).strip()
        i += 1
        while i < n and not RE_CHOIX.match(lignes[i]) \
                and not RE_REPONSE.match(lignes[i]) \
                and not RE_ENTETE.match(lignes[i]) \
                and not RE_SECTION.match(lignes[i]):
            texte = (texte + " " + lignes[i].strip()).strip()
            i += 1
        choix.append((lettre, nettoyer(texte)))

    # Pas de choix : cet enonce n'est pas un item a choix (question ouverte).
    if len(choix) < 2:
        return None, i

    reponse = ""
    justification = []
    while i < n and not RE_ENTETE.match(lignes[i]):
        mr = RE_REPONSE.match(lignes[i])
        if mr:
            reste = mr.group(1).strip()
            mm = re.match(r"^([A-D])\.?\s*(.*)$", reste)
            if mm:
                reponse = mm.group(1)
                justification.append(mm.group(2))
            else:
                reponse = reste
            i += 1
            blancs = 0
            while i < n:
                if not lignes[i].strip():
                    blancs += 1
                    if blancs >= 2:
                        break
                    i += 1
                    continue
                if RE_REPONSE.match(lignes[i]) or RE_CHOIX.match(lignes[i]) \
                        or RE_ENTETE.match(lignes[i]) or RE_VRAI_FAUX.match(lignes[i]) \
                        or RE_SECTION.match(lignes[i]):
                    break
                if RE_ENTETE.match(lignes[i]):
                    break
                blancs = 0
                justification.append(lignes[i].strip())
                i += 1
            break
        i += 1

    if len(choix) < 2 or not reponse:
        return None, i

    return {
        "type": "choix",
        "enonce": cadre,
        "choix": [c[1] for c in choix],
        "lettres": [c[0] for c in choix],
        "reponse": reponse,
        "justification": nettoyer(" ".join(justification)),
    }, i


def extraire_items(chemin):
    """Extrait les items (vrai/faux et choix multiples) d'un corrige officiel."""
    lignes = lignes_utiles(chemin)
    items = []
    i = 0
    n = len(lignes)
    contexte_courant = ""

    while i < n:
        ligne = lignes[i]

        # Un titre de section remet le contexte a zero.
        if RE_SECTION.match(ligne):
            contexte_courant = ""
            i += 1
            continue

        me = RE_ENTETE.match(ligne)
        if me:
            entete = me.group(3).strip()
            index_entete = i
            i += 1
            corps = []
            while i < n and not RE_CHOIX.match(lignes[i]) \
                    and not RE_VRAI_FAUX.match(lignes[i]) \
                    and not RE_ENTETE.match(lignes[i]) \
                    and not RE_SECTION.match(lignes[i]):
                corps.append(lignes[i].strip())
                i += 1

            parent = nettoyer(" ".join([entete] + corps))
            parent = re.sub(r"\(Circle True or False for each choice\.\)", "", parent).strip()
            parent = re.sub(r"Circle the best answer for each question\.?", "", parent).strip()
            parent = parent.strip(" .—-")

            if i < n and RE_VRAI_FAUX.match(lignes[i]):
                # Item vrai/faux : chacun herite de l'enonce parent.
                while i < n and RE_VRAI_FAUX.match(lignes[i]):
                    item, i = lire_vrai_faux(lignes, i, parent)
                    if item:
                        items.append(item)
                continue

            # Item a choix multiples : le cadre vient de la section.
            cadre = contexte_avant(lignes, index_entete)
            if cadre:
                contexte_courant = cadre
            cadre = contexte_courant
            item, i = lire_choix(lignes, i, cadre)
            if item:
                if item["enonce"]:
                    item["enonce"] = item["enonce"] + " — " + entete
                else:
                    item["enonce"] = entete
                items.append(item)
            continue

        if RE_VRAI_FAUX.match(ligne):
            item, i = lire_vrai_faux(lignes, i, "")
            if item:
                items.append(item)
            continue

        i += 1

    return items


# Les rooms dont le reservoir d'examen est trop juste (mesure reelle :
# Secura_Exam::pool_size), avec le nombre de questions qui manquent.
# La sonde reproductible est run/probe-pool.php.
CIBLES = [
    ("kahoot-la-revision-des-labs-avances", 16, "tous"),
    ("traverser-le-mur", 9, "reseau"),
    ("le-mot-de-passe-oublie", 8, "auth"),
    ("la-page-qui-se-trahit", 8, "web"),
    ("la-requete-qui-ne-se-fie-a-personne", 8, "web"),
    ("le-binaire-qui-obeit-trop", 8, "memoire"),
    ("le-certificat-qui-ne-prouve-rien", 8, "crypto"),
    ("le-service-qui-ne-repond-plus", 7, "tous"),
    ("le-fichier-quon-naurait-pas-du-laisser", 6, "os"),
    ("qui-a-force-la-porte", 6, "os"),
    ("comment-marche-un-ordinateur-de-la-donnee-au-programme", 6, "memoire"),
    ("donnees-et-systemes-organiser-linformation", 6, "os"),
    ("le-reseau-qui-parle-trop", 5, "reseau"),
    ("la-boutique-en-ligne-se-connecter-en-administrateur", 4, "web"),
    ("la-zone-administrateur-ce-quun-administrateur-voit", 4, "os"),
    ("penser-comme-un-defenseur", 3, "tous"),
    ("securiser-une-application-web", 3, "web"),
    ("memoire-et-defenses", 3, "memoire"),
    ("authentification", 3, "auth"),
    ("chiffrement-et-https", 3, "crypto"),
    ("le-top-10-owasp-et-la-surface-dattaque", 2, "web"),
    ("valider-les-entrees-le-premier-remede-anti-injection", 2, "web"),
    ("journaux-et-audit-la-trace-qui-vaut-de-lor", 2, "os"),
    ("les-fondamentaux-du-reseau", 1, "reseau"),
]

MOTS_THEMES = {
    "reseau": ("firewall", "network", "packet", "tcp", "ddos", "dns", "router",
               "wireless", "denial", "tor", "proxy", "segmentation", "captcha"),
    "web": ("web", "javascript", "cookie", "xss", "sql", "browser", "http",
            "url", "dropbox", "website", "origin", "cors", "php", "get[",
            "mysql", "sanitiz"),
    "memoire": ("stack", "buffer", "heap", "memory", "overflow", "canary",
                "rop", "baggy", "bound", "allocator", "return address", "strcpy",
                "virtual memory", "page"),
    "auth": ("password", "authentication", "login", "session", "srp",
             "credential", "username", "token", "spam"),
    "crypto": ("key", "encrypt", "cipher", "hash", "signature", "random",
               "diffie", "hmac", "tls", "certificate", "kerberos", "rsa"),
    "os": ("process", "system call", "kernel", "permission", "privilege",
           "sandbox", "native client", "okws", "symbolic", "android", "manifest",
           "chroot", "file descriptor", "capsicum", "okd"),
}


def themes_de(item):
    """Les themes dont parle l'item."""
    texte = (item["enonce"] + " " + item["justification"]).lower()
    trouves = set()
    for theme, clefs in MOTS_THEMES.items():
        for clef in clefs:
            if clef in texte:
                trouves.add(theme)
                break
    return trouves


def repartir(questions):
    """Repartit les questions dans les rooms qui ont besoin de questions.

    On commence par les rooms dont le reservoir est le plus juste, et on
    respecte le theme : une question de memoire va dans une room de
    memoire, une question web dans une room web. Quand aucune room du
    theme ne manque plus de questions, la question va dans la room qui
    manque le plus.
    """
    capacite = {slug: manque for slug, manque, _ in CIBLES}
    themes_cibles = {slug: theme for slug, _, theme in CIBLES}
    par_room = {}

    for question in questions:
        texte = question["question"].lower()
        trouves = set()
        for theme, clefs in MOTS_THEMES.items():
            for clef in clefs:
                if clef in texte:
                    trouves.add(theme)
                    break

        eligibles = [c for c in CIBLES if capacite[c[0]] > 0
                     and (themes_cibles[c[0]] == "tous" or themes_cibles[c[0]] in trouves)]
        if not eligibles:
            eligibles = [c for c in CIBLES if capacite[c[0]] > 0]
        if not eligibles:
            eligibles = list(CIBLES)

        # On remplit d'abord les rooms les moins remplies (proportionnellement),
        # pour ne pas laisser un reservoir de cote.
        choisi = min(eligibles, key=lambda c: len(par_room.get(c[0], [])) / c[1])
        capacite[choisi[0]] -= 1
        par_room.setdefault(choisi[0], []).append(question)

    return par_room


def construire_questions(items):
    """Transforme les items en questions de la plateforme.

    Trois filtres, tous justes par la regle de la maison : on n'importe que
    ce qui est complet et comprehensible.

      1. l'item doit se comprendre seul (pas de « Line 4 », pas de renvoi
         a une figure ou a un article) ;
      2. le corrige officiel doit expliquer la reponse : sans explication,
         l'eleve devinerait, et la plateforme promet l'inverse ;
      3. pas de doublon (les memes quizzes sont repris d'annee en annee).

    L'ordre des propositions est Melange de facon deterministe : c'est la
    regle de la plateforme (« jamais les memes questions dans le meme ordre »),
    et cela evite aussi que toutes les bonnes reponses importees tombent a la
    meme place.
    """
    questions = []
    position = 0
    vus = set()

    for item in items:
        enonce = item["enonce"].strip()
        justification = item["justification"].strip()

        if RE_INCOMPLET.search(enonce):
            continue
        if len(enonce) < ENONCE_MIN:
            continue
        if len(justification) < JUSTIFICATION_MIN:
            continue

        # La clef de doublon porte sur la fin de l'item (l'enonce propre) :
        # plusieurs items d'une meme section partagent le meme contexte.
        cle = re.sub(r"[^a-z0-9]+", " ", enonce.lower()).strip()[-100:]
        if cle in vus:
            continue
        vus.add(cle)

        choix = list(item["choix"])

        index = None
        for i, proposition in enumerate(choix):
            if proposition.strip().lower() == item["reponse"].strip().lower():
                index = i
                break
        if index is None and item["type"] == "choix":
            for i, lettre in enumerate(item["lettres"]):
                if lettre == item["reponse"]:
                    index = i
                    break
        if index is None:
            continue

        # Rotation deterministe : la bonne reponse change de place.
        decalage = position % len(choix)
        if decalage:
            choix = choix[decalage:] + choix[:decalage]
            index = (index - decalage) % len(choix)

        questions.append({
            "question": PREFIXE + enonce,
            "mode": "choice",
            "choices": choix,
            "correct": index,
            "xp": 20,
            "hint": INDICE,
            "explanation": "Corrige officiel du MIT : " + justification,
            "source": ATTRIBUTION,
            "licence": LICENCE,
        })
        position += 1

    return questions


def main(argv=None):
    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--texte", required=True,
                            help="dossier contenant les fichiers .txt (pdftotext)")
    analyseur.add_argument("--sortie", required=True, help="lot JSON a ecrire")
    args = analyseur.parse_args(argv)

    fichiers = sorted(f for f in os.listdir(args.texte) if f.endswith("_sol.txt"))
    if not fichiers:
        print("Aucun corrige (*_sol.txt) dans %s" % args.texte)
        return 1

    tous = []
    for nom in fichiers:
        items = extraire_items(os.path.join(args.texte, nom))
        tous.extend(items)
        print("  %-16s %2d item(s)" % (nom.replace("_sol.txt", ""), len(items)))

    questions = construire_questions(tous)
    print("Total : %d item(s) extraits, %d question(s) retenues."
          % (len(tous), len(questions)))

    # Repartition dans les rooms qui ont le reservoir le plus juste.
    par_room = repartir(questions)

    lot = {
        "source": "mit-ocw-6858-examens",
        "licence": LICENCE,
        "attribution": ATTRIBUTION,
        "url": "https://ocw.mit.edu/courses/6-858-computer-systems-security-fall-2014/pages/exams/",
        "rooms": [
            {
                "room": slug,
                "title": slug,
                # « test » et non « exam » : les questions importees
                # grossissent le reservoir de la section (c'est ce qui rend
                # les copies distinctes) sans allonger l'epreuve elle-meme.
                "tasks": {"test": questions_room},
            }
            for slug, questions_room in sorted(par_room.items())
        ],
    }

    dossier = os.path.dirname(os.path.abspath(args.sortie))
    if dossier:
        os.makedirs(dossier, exist_ok=True)
    with open(args.sortie, "w", encoding="utf-8") as f:
        json.dump(lot, f, ensure_ascii=False, indent=2)

    print("")
    print("Repartition :")
    for slug, questions_room in sorted(par_room.items()):
        print("  %-52s %d question(s)" % (slug, len(questions_room)))
    print("")
    print("Lot ecrit : %s" % args.sortie)
    return 0


if __name__ == "__main__":
    sys.exit(main())
