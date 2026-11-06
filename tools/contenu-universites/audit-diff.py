#!/usr/bin/env python3
"""Montre, question par question, ce qui a ete REEcrit dans les bonnes reponses.

A quoi ca sert
--------------
Un eleve ne peut pas relire 204 questions. Un relecteur non plus. Mais il
peut relire la vingtaine de phrases qui ont ete modifiees. Ce script
fabrique exactement cette liste.

Ce que le script ne fait PAS
----------------------------
Il ne dit pas si le nouveau texte est vrai. Il ne peut pas : c'est un
probleme de contenu, pas de code. Il produit la liste courte sur laquelle
un humain tranche. Aucun controle automatique de ce depot ne peut remplacer
cette lecture ; le dire clairement vaut mieux que laisser croire le
contraire.

L'extraction n'est PAS reecrite ici : le script importe `questions_du_php`
de `check.py`, pour que la comparaison porte sur exactement le meme texte
que celui que verifie le garde-fou. Deux extracteurs differents, ce sont
deux verites differentes.

Usage :
    python3 audit-diff.py             # comparer a la base de la branche
    python3 audit-diff.py --base SHA  # comparer a un autre commit
"""
import argparse
import html
import io
import os
import re
import subprocess
import sys
import tempfile

HERE = os.path.dirname(os.path.abspath(__file__))
ROOT = os.path.abspath(os.path.join(HERE, '..', '..'))
sys.path.insert(0, HERE)

import check  # noqa: E402

CIBLE = 'wp-content/plugins/secura-academy/includes/content-universites.php'
SORTIE = os.path.join(ROOT, 'docs', 'audit-reecritures.html')

# Un mot-outil en fin de phrase : la signature d'une reponse coupee au
# ciseau. La liste reste courte et volontairement severe : un detecteur
# large criait sur « le contenu reste lisible par tous ».
MOT_OUTIL_FINAL = re.compile(
    r"\b(de|du|des|le|la|les|un|une|et|ou|au|aux|en|dans|sur|pour|par|"
    r"avec|sans|que|qui|dont|car|mais|donc|si|comme|plus|moins)\s*[.!?]?$",
    re.I,
)


def nettoie(texte):
    """Retire les balises : elles ne portent pas le sens de la phrase."""
    return re.sub(r'\s+', ' ', re.sub(r'<[^>]+>', '', texte)).strip()


def questions(chemin):
    """{cle_room: [{q, choices, correct}]} via l'extracteur de check.py."""
    return check.questions_du_php(chemin)


def questions_du_commit(commit):
    """Ecrit la version du commit dans un fichier temporaire, puis l'extrait.

    `questions_du_php` lit un chemin, pas une chaine : lui donner un texte
    demanderait de reecrire l'extraction, et donc d'en avoir deux.
    """
    try:
        contenu = subprocess.check_output(
            ['git', '-C', ROOT, 'show', '%s:%s' % (commit, CIBLE)],
            stderr=subprocess.PIPE,
        )
    except subprocess.CalledProcessError:
        sys.exit(
            "Le fichier %s n'existe pas au commit %s.\n"
            "Choisis un commit ou il existe : git log --oneline -- %s"
            % (CIBLE, commit, CIBLE)
        )

    descripteur, chemin = tempfile.mkstemp(suffix='.php')
    try:
        with os.fdopen(descripteur, 'wb') as fichier:
            fichier.write(contenu)
        return questions(chemin)
    finally:
        os.unlink(chemin)


def bonne_reponse(question):
    """La bonne reponse, ou None si l'index sort du tableau."""
    choix, correct = question['choices'], question['correct']
    return choix[correct] if 0 <= correct < len(choix) else None


def compare(avant, apres):
    """Les lignes ou la BONNE reponse a change.

    L'appariement se fait par (room, rang de la question). Comparer par
    position dans la liste des propositions serait faux : `rebalance()`
    deplace la bonne reponse dans le tableau a chaque build.
    """
    lignes = []
    for cle, liste in apres.items():
        ancienne_liste = avant.get(cle, [])
        for rang, question in enumerate(liste):
            texte_apres = bonne_reponse(question)
            if rang >= len(ancienne_liste):
                lignes.append((cle, rang, question['q'], None, texte_apres))
                continue
            texte_avant = bonne_reponse(ancienne_liste[rang])
            if texte_avant != texte_apres:
                lignes.append(
                    (cle, rang, question['q'], texte_avant, texte_apres))
    return lignes


GRAVITE = {
    'tronquee': ('Reponse tronquee', '#b3261e',
                 "Plus courte ET finit par un mot qui appelle une suite. "
                 "C'est le cas a relire en premier : un ciseau de longueur "
                 "a peut-etre casse le sens."),
    'raccourcie': ('Raccourcie', '#8a5a00',
                   "Plus courte, sans troncature visible. Verifier que le "
                   "sens n'a pas ete perdu."),
    'allongee': ('Allongee', '#1b5e20',
                 "Plus longue : c'est la correction voulue (on etoffe au "
                 "lieu de couper)."),
    'reformulee': ('Reformulee', '#0b5394', "Meme longueur, autre texte."),
    'ajoutee': ('Question ajoutee', '#555555',
                "Aucune version anterieure a la base."),
}


def nature(avant, apres):
    """Classe le changement, pour que la relecture commence par le risque."""
    if avant is None:
        return 'ajoutee'
    if len(apres) < len(avant):
        return 'tronquee' if MOT_OUTIL_FINAL.search(apres) else 'raccourcie'
    if len(apres) > len(avant):
        return 'allongee'
    return 'reformulee'


def rendu(lignes, base):
    """Une page autonome : elle s'ouvre sans serveur, et se relit a deux."""
    compte = {}
    for ligne in lignes:
        nature_ligne = nature(ligne[3], ligne[4])
        compte[nature_ligne] = compte.get(nature_ligne, 0) + 1

    morceaux = [
        '<!doctype html><html lang="fr"><meta charset="utf-8">',
        '<title>Relecture des bonnes reponses reecrites</title>',
        '<style>',
        'body{font:15px/1.55 system-ui,sans-serif;max-width:1100px;'
        'margin:2em auto;padding:0 1em;color:#1a1a1a;background:#fff}',
        'h1{font-size:1.5em;margin-bottom:.2em}',
        '.compte{color:#555;margin-bottom:1.2em}',
        '.n{margin:1.4em 0;border-left:4px solid #ccc;padding:.2em 0 .2em 1em}',
        '.n h2{font-size:1em;margin:.2em 0 .4em;font-weight:600}',
        '.tag{display:inline-block;font-size:.72em;font-weight:700;color:#fff;'
        'padding:.15em .5em;border-radius:3px;margin-right:.5em}',
        '.avant,.apres{font-family:ui-monospace,monospace;font-size:.9em;'
        'padding:.5em .7em;border-radius:4px;margin:.3em 0;'
        'white-space:pre-wrap}',
        '.avant{background:#fdecea;text-decoration:line-through;color:#7a1c14}',
        '.apres{background:#e8f5e9;color:#14361a}',
        '.note{font-size:.82em;color:#666;margin-top:.3em}',
        'code{background:#f0f0f0;padding:.1em .3em;border-radius:3px}',
        '</style>',
        '<h1>Relecture des bonnes reponses reecrites</h1>',
        '<p class="compte">Comparaison avec <code>%s</code> &mdash; '
        '<strong>%d ligne(s) a relire</strong> (%s).</p>'
        % (html.escape(base), len(lignes),
           ', '.join('%d %s' % (v, k) for k, v in sorted(compte.items()))),
        '<p class="note">Cette page ne dit pas si le nouveau texte est vrai : '
        'aucun programme ne peut le dire. Elle donne la liste courte sur '
        'laquelle un humain tranche ; les sources sont dans '
        '<code>docs/VERIFICATION-CONTENU.md</code>.</p>',
    ]

    for nature_voulue in ('tronquee', 'raccourcie', 'reformulee', 'allongee',
                          'ajoutee'):
        for cle, rang, enonce, avant, apres in lignes:
            if nature(avant, apres) != nature_voulue:
                continue
            titre, couleur, aide = GRAVITE[nature_voulue]
            morceaux.append(
                '<div class="n" style="border-left-color:%s">' % couleur)
            morceaux.append(
                '<h2><span class="tag" style="background:%s">%s</span>'
                '<code>%s</code> q%d &mdash; %s</h2>'
                % (couleur, html.escape(titre), html.escape(cle), rang,
                   html.escape(nettoie(enonce))))
            if avant is not None:
                morceaux.append(
                    '<div class="avant">%s</div>' % html.escape(nettoie(avant)))
            morceaux.append(
                '<div class="apres">%s</div>' % html.escape(nettoie(apres)))
            morceaux.append('<p class="note">%s</p>' % html.escape(aide))
            morceaux.append('</div>')

    morceaux.append('</html>')
    return '\n'.join(morceaux)


def main():
    analyse = argparse.ArgumentParser(description=__doc__)
    analyse.add_argument(
        '--base', default='da510ef',
        help='commit de reference (defaut : base de la branche)')
    options = analyse.parse_args()

    avant = questions_du_commit(options.base)
    apres = questions(check.CONTENU_PHP)

    total_avant = sum(len(v) for v in avant.values())
    total_apres = sum(len(v) for v in apres.values())

    if not total_apres:
        sys.exit("Aucune question extraite : le format du PHP a change.")
    if total_avant != total_apres:
        print("ATTENTION : %d questions a la base, %d aujourd'hui. Une "
              "question a ete ajoutee ou perdue ; le compte est affiche."
              % (total_avant, total_apres))

    lignes = compare(avant, apres)

    with io.open(SORTIE, 'w', encoding='utf-8') as fichier:
        fichier.write(rendu(lignes, options.base))

    print("questions comparees : %d" % total_apres)
    print("bonnes reponses modifiees : %d" % len(lignes))
    for nature_voulue in ('tronquee', 'raccourcie', 'reformulee', 'allongee',
                          'ajoutee'):
        total = sum(1 for l in lignes
                    if nature(l[3], l[4]) == nature_voulue)
        if total:
            print("  %-12s %d" % (nature_voulue, total))
    print("page : %s" % os.path.relpath(SORTIE, ROOT))


if __name__ == '__main__':
    main()
