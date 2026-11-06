# -*- coding: utf-8 -*-
"""Reequilibre les QCM d'une room : la bonne reponse cesse d'etre la plus longue.

POURQUOI CET OUTIL EXISTE
-------------------------
Mesure du 6 novembre 2026, refaite le 7 : dans 67 % des 377 QCM du site, la
bonne reponse est l'option la plus longue. Cocher toujours la plus longue
valide 41 examens sur 59 sans lire une seule question. Le melange des
options a l'affichage (class-secura-ajax.php) ne corrige rien : il deplace
la position, pas la longueur.

REGLE APPLIQUEE
---------------
On ne touche PAS la bonne reponse : on reecrit les distracteurs.
Une bonne reponse raccourcie pour rentrer dans le moule perdrait sa nuance,
et une bonne reponse allongee est exactement le defaut qu'on corrige.

Chaque distracteur reecrit doit :
  1. etre FAUX, mais choisi par un eleve qui a mal compris ;
  2. appartenir au meme domaine que la question ;
  3. depasser la bonne reponse d'au moins 8 % ;
  4. ne pas etre plus long de plus de 90 % (sinon il se repere a sa forme).

BILINGUE
--------
Le francais est dans `'choices'` de `_secura_tasks` ; l'anglais est dans
`i18n.en.tasks[i].questions[j].choices`. Les deux sont corriges ensemble :
une room dont la version anglaise garde le raccourci est une room ou l'on
triche en changeant de langue.

LOCALISATION
------------
Ces rooms n'ont pas de cle en dur dans le fichier PHP : elle est calculee a
l'import (track + numero). On les designe donc par leur TITRE francais.

Une question est adressee par `(tache, rang du QCM dans la tache)`, en
commencant a 0. Le rang ne compte que les questions a choix multiples : une
question libre au milieu d'une tache ne decale rien.

UTILISATION
-----------
    python3 tools/contenu/reequilibre_qcm.py <fichier.php> <corrections.py> --verifie
    python3 tools/contenu/reequilibre_qcm.py <fichier.php> <corrections.py> --applique

Le module de corrections expose CORRECTIONS :

    CORRECTIONS = {
        'Le registre que personne ne lit': {
            (1, 0): {
                'fr': ['...', '...', '...'],   # les leurres, dans l'ordre
                'en': ['...', '...', '...'],
            },
        },
    }

On ne fournit que les LEURRES (3 pour un QCM a 4 options) : la bonne reponse
garde son texte et sa position, donc son index `correct` reste juste.
"""

import importlib.util
import re
import sys

RATIO_MIN = 1.08
RATIO_MAX = 1.90

CHOIX = re.compile(r"'choices'\s*=>\s*array\(((?:[^()]|\([^()]*\))*)\)")
OPTION = re.compile(r"'((?:[^'\\]|\\.)*)'")
BOUTEES = re.compile(r"'questions'\s*=>\s*array\(")


def longueur(texte):
    """Longueur utile : sans les balises, comme le mesure le verificateur."""
    return len(re.sub(r'<[^>]+>', '', texte))


# ---------------------------------------------------------------------
# Localisation
# ---------------------------------------------------------------------

# Le titre d'une room est en 3 tabulations ; celui d'une TACHE en 5. Cette
# difference est ce qui permet de decouper une room sans attraper « Task 4 ».
TITRE_ROOM = re.compile(r"^\t{3}'title'\s*=>\s*'", re.M)


def bornes_room(source, titre):
    """Les indices de debut et de fin d'une room, reperee par son titre."""
    ancre = "\t\t\t'title'      => '%s'" % titre
    pos = source.find(ancre)

    if pos < 0:
        raise SystemExit("room introuvable : %s" % titre)

    debut = source.rfind('array(', 0, pos)
    suivante = TITRE_ROOM.search(source, pos + len(ancre))
    fin = suivante.start() if suivante else len(source)

    return debut, fin


def separe_langues(bloc):
    """Le francais, puis l'anglais ('' s'il n'y a pas de traduction)."""
    marque = bloc.find("'i18n'")

    if marque < 0:
        return bloc, ''

    return bloc[:marque], bloc[marque:]


def taches(bloc):
    """Les tranches du bloc, une par tache, dans l'ordre.

    On decoupe sur `'questions' => array(` : chaque tache en porte une, et la
    premiere tranche (avant la premiere tache) est jetee.
    """
    marques = [m.end() for m in BOUTEES.finditer(bloc)]

    if not marques:
        return []

    tranches = []

    for i, debut in enumerate(marques):
        fin = marques[i + 1] if i + 1 < len(marques) else len(bloc)
        tranches.append(bloc[debut:fin])

    return tranches


def qcm_dune_tache(tranche):
    """Les QCM d'une tache : (debut, fin, options) pour chaque liste."""
    return [(m.start(1), m.end(1), OPTION.findall(m.group(1)))
            for m in CHOIX.finditer(tranche)]


def bons_dune_tache(tranche):
    return [int(m.group(1)) for m in re.finditer(r"'correct'\s*=>\s*(\d+)", tranche)]


# ---------------------------------------------------------------------
# Verification
# ---------------------------------------------------------------------

def defauts_question(options, correct, ou):
    if not 0 <= correct < len(options):
        return ['%s : bonne reponse hors des options' % ou]

    lc = longueur(options[correct])
    autres = [(i, longueur(o)) for i, o in enumerate(options) if i != correct]
    fautes = []

    if autres and all(l <= lc for _, l in autres):
        fautes.append('%s : la bonne reponse est la plus longue (%d car.)' % (ou, lc))

    for i, l in autres:
        if l <= lc < l * RATIO_MIN:
            fautes.append('%s : option %d trop courte (%d car. contre %d)' % (ou, i, l, lc))

        if l > lc * RATIO_MAX:
            fautes.append('%s : option %d trop longue (%d car. contre %d)' % (ou, i, l, lc))

    return fautes


def verifie_room(source, titre):
    """Verifie les deux langues. Renvoie (nombre de QCM vus, [defauts])."""
    debut, fin = bornes_room(source, titre)
    fr, en = separe_langues(source[debut:fin])

    fautes = []
    vus = 0

    for langue, bloc in (('fr', fr), ('en', en)):
        if not bloc:
            continue

        for ti, tranche in enumerate(taches(bloc)):
            qcm = qcm_dune_tache(tranche)
            bons = bons_dune_tache(tranche)

            for qi, ((_, _, options), correct) in enumerate(zip(qcm, bons)):
                if len(options) < 3:
                    continue

                vus += 1
                fautes += defauts_question(options, correct, '%s t%d q%d' % (langue, ti, qi))

    return vus, fautes


# ---------------------------------------------------------------------
# Application
# ---------------------------------------------------------------------

def _decoupe_taches(bloc):
    """Les bornes absolues (debut, fin) de chaque tache d'un bloc."""
    marques = [m.end() for m in BOUTEES.finditer(bloc)]

    if not marques:
        return []

    return [(d, marques[i + 1] if i + 1 < len(marques) else len(bloc))
            for i, d in enumerate(marques)]


def applique_room(source, titre, corrections):
    """Reecrit les leurres, en francais et en anglais. Ne bouge ni `correct`
    ni le texte de la bonne reponse."""
    debut, fin = bornes_room(source, titre)
    bloc = source[debut:fin]
    fr, en = separe_langues(bloc)

    nouveau_fr = _reecrit(fr, corrections, 'fr', titre)
    nouveau_en = _reecrit(en, corrections, 'en', titre) if en else ''

    return source[:debut] + nouveau_fr + nouveau_en + source[debut + len(bloc):]


def _reecrit(bloc, corrections, langue, titre):
    """Remplace les listes d'options indiquees, de la fin vers le debut.

    On travaille sur des decalages ABSOLUS dans `bloc`, et on applique les
    remplacements du plus loin au plus proche : chaque remplacement laisse
    donc intacts les decalages de ceux qui precedent.
    """
    if not bloc:
        return bloc

    remplacements = []

    for ti, (d, f) in enumerate(_decoupe_taches(bloc)):
        tranche = bloc[d:f]
        qcm = qcm_dune_tache(tranche)
        bons = bons_dune_tache(tranche)

        for qi, (dd, ff, options) in enumerate(qcm):
            textes = corrections.get((ti, qi))

            if not textes:
                continue

            leurres = textes[langue]
            correct = bons[qi] if qi < len(bons) else -1

            if len(leurres) != len(options) - 1:
                raise SystemExit(
                    "%s %s t%d q%d : %d leurres fournis, %d attendus"
                    % (titre, langue, ti, qi, len(leurres), len(options) - 1))

            if not 0 <= correct < len(options):
                raise SystemExit("%s %s t%d q%d : index de bonne reponse hors bornes"
                                 % (titre, langue, ti, qi))

            source_options = iter(leurres)
            remplacees = [
                o if i == correct else next(source_options)
                for i, o in enumerate(options)
            ]

            remplacements.append((d + dd, d + ff, ', '.join(_php(o) for o in remplacees)))

    for debut_remplacement, fin_remplacement, texte in sorted(remplacements, reverse=True):
        bloc = bloc[:debut_remplacement] + texte + bloc[fin_remplacement:]

    return bloc


def _php(texte):
    return "'" + texte.replace('\\', '\\\\').replace("'", "\\'") + "'"


def main():
    if len(sys.argv) < 3:
        raise SystemExit(__doc__)

    chemin, chemin_corrections = sys.argv[1], sys.argv[2]
    mode = sys.argv[3] if len(sys.argv) > 3 else '--verifie'

    spec = importlib.util.spec_from_file_location('corrections', chemin_corrections)
    module = importlib.util.module_from_spec(spec)
    spec.loader.exec_module(module)

    source = open(chemin, encoding='utf-8').read()

    if mode == '--applique':
        for titre, corrections in module.CORRECTIONS.items():
            source = applique_room(source, titre, corrections)

        open(chemin, 'w', encoding='utf-8').write(source)
        print("ecrit : %s (%d room(s))" % (chemin, len(module.CORRECTIONS)))

    total = 0
    fautes = []

    for titre in module.CORRECTIONS:
        n, f = verifie_room(source, titre)
        total += n
        fautes += f

    print("QCM verifies : %d" % total)
    print("defauts : %d" % len(fautes))

    for faute in fautes[:20]:
        print("  " + faute)

    return 0 if not fautes else 1


if __name__ == '__main__':
    sys.exit(main())
