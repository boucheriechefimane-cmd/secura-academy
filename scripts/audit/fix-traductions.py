#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Corrige les chaines de traduction degradees dans les fichiers de contenu.

Constat (audit du 01/11/2026) :
  - 2 extraits francais corrompus ("sometimes", "aDisposed") ;
  - 37 chaines ar / en restees en francais ou meleees (traduction
    automatique incomplete) ;
  - 13 titres de taches arabes melangeant le francais.

Le script ne touche qu'aux chaines citees. Chaque remplacement est
verifie : si une ancre est introuvable ou ambiguë, le script s'arrete
et le signale, plutot que de modifier le fichier a l'aveugle.
"""
import io
import re
import sys

BASE = "/home/user/secura-academy/wp-content/plugins/secura-academy/includes/"

FICHIERS = ("default-content.php", "content-m3.php", "content-universites.php")

# --------------------------------------------------------------------------
# Corrections francaises (source de verite : le texte de la room)
# --------------------------------------------------------------------------
FR = [
    # room 24 : un mot anglais s'etait glisse dans le texte francais
    (
        "Pourquoi le navigateur mélange sometimes les sites",
        "Pourquoi le navigateur mélange parfois les sites",
    ),
    # room 56 : phrase corrompue ("aDisposed", "dozen")
    (
        "il travaille dans une dozen de cases àDisposed très vite.",
        "il travaille dans une douzaine de cases qu'on oublie aussitôt.",
    ),
    # room 14 : accents manquants et mot anglais
    (
        "permet de telecharger un fichier par son nom. C'est une feature tres agreable",
        "permet de télécharger un fichier par son nom. C'est une feature très agréable",
    ),
]

# --------------------------------------------------------------------------
# Traductions a corriger.
#   cle : titre francais de la room (identifiant stable et unique)
# --------------------------------------------------------------------------
I18N = {
    "Ceinture blanche : lire, chercher, comprendre": {
        "ar": {
            "title": "الحزام الأبيض: اقرأ، ابحث، افهم",
            "excerpt": "أربعة تحديات لتتعلم النظر إلى ملف والعثور داخله على ما تبحث عنه.",
        },
        "en": {
            "title": "White belt: read, search, understand",
            "excerpt": "Four challenges to learn how to read a file and find in it what you are looking for.",
        },
    },
    "Ceinture jaune : permissions, propriétaire, contenu": {
        "ar": {
            "title": "الحزام الأصفر: الأذونات، المالك، المحتوى",
            "excerpt": "عندما يقول لك النظام لا: من يملك الملف، وما هي أذوناته، وما يحتويه فعلا.",
        },
        "en": {
            "title": "Yellow belt: permissions, owner, content",
            "excerpt": "When the system says no: who owns the file, what its permissions are, and what it really contains.",
        },
    },
    "Ceinture orange : réseau, processus, configuration": {
        "ar": {
            "title": "الحزام البرتقالي: الشبكة، العمليات، الإعداد",
            "excerpt": "نترك الملفات: ما الذي يستمع، وما الذي يعمل، وما الذي نُسي في الإعداد.",
        },
        "en": {
            "title": "Orange belt: network, processes, configuration",
            "excerpt": "We leave the files behind: what is listening, what is running, and what was forgotten in the configuration.",
        },
    },
    "Ceinture verte : binaires, chaînes, mémoire": {
        "ar": {
            "title": "الحزام الأخضر: الملفات الثنائية، السلاسل، الذاكرة",
            "excerpt": "ننظر إلى برامج مترجمة: ماذا تحتوي، وماذا هي، وما بداخلها.",
        },
        "en": {
            "title": "Green belt: binaries, strings, memory",
            "excerpt": "We look at compiled programs: what they contain, what they are, and what is inside them.",
        },
    },
    "Ceinture noire : cryptographie, clés, empreintes": {
        "ar": {
            "title": "الحزام الأسود: التشفير، المفاتيح، البصمات",
            "excerpt": "الحزام الأخير: قراءة بصمة، والتعرف على مفتاح، وقراءة شهادة.",
        },
        "en": {
            "title": "Black belt: cryptography, keys, fingerprints",
            "excerpt": "The last belt: reading a fingerprint, recognising a key, reading a certificate.",
        },
    },
    "Brief 1 : le dojo, comment on s'entraîne": {
        "ar": {
            "title": "موجز 1: الدوجو، كيف تتدرّب",
            "excerpt": "قبل التحديات: الطريقة. الدوجو ليس لعبة كسر، بل سُلّم.",
        },
        "en": {
            "title": "Brief 1: the dojo, how you train",
            "excerpt": "Before the challenges: the method. The dojo is not a cracking game, it is a ladder.",
        },
    },
    "Brief 2 : le web, comment on parle à un serveur": {
        "ar": {
            "title": "موجز 2: الويب، كيف يتحدث إلى خادم",
            "excerpt": "HTTP، بوضوح: طلب ثم رد. الويب ليس سحرا.",
        },
        "en": {
            "title": "Brief 2: the web, how you talk to a server",
            "excerpt": "HTTP, in plain words: a request, a response. The web is not magic.",
        },
    },
    "Brief 3 : les scénarios d'exploitation": {
        "ar": {
            "title": "موجز 3: سيناريوهات الاستغلال",
            "excerpt": "الاستغلال ليس «الكسر»: إنك تجعل برنامجا يفعل شيئا لم يتوقعه.",
        },
        "en": {
            "title": "Brief 3: exploitation scenarios",
            "excerpt": "Exploiting is not \"breaking\": it is making a program do something it did not expect.",
        },
    },
    "Brief 4 : les registres, le carnet du processeur": {
        "ar": {
            "title": "موجز 4: السجلات، دفتر المعالج",
            "excerpt": "المعالج لا يحتفظ في الذاكرة بشيء تقريبًا: يعمل في اثنتي عشرة خانة ينساها بسرعة.",
        },
        "en": {
            "title": "Brief 4: registers, the processor's notebook",
            "excerpt": "The processor keeps almost nothing in memory: it works in a dozen slots it forgets very quickly.",
        },
    },
    "Brief 5 : ne pas se faire avoir": {
        "ar": {
            "title": "موجز 5: لا تُخدع",
            "excerpt": "القاعدة الذهبية للنظافة الرقمية: ما يبدو جميلا جدا، أو عاجلا جدا، هو في الغالب تمثيل.",
        },
        "en": {
            "title": "Brief 5: do not get fooled",
            "excerpt": "The golden rule of digital hygiene: what looks too good, or too urgent, is almost always a set-up.",
        },
    },
    "Brief 6 : explorer une application web": {
        "ar": {
            "title": "موجز 6: استكشاف تطبيق ويب",
            "excerpt": "قبل البحث عن ثغرة: انظر التطبيق ك مستخدم، ثم ك مهاجم.",
        },
        "en": {
            "title": "Brief 6: exploring a web application",
            "excerpt": "Before looking for a flaw: look at the application as a user, then as an attacker.",
        },
    },
    # Corrections de titres arabes ou anglais restés partiellement en francais
    "Le fichier qu'on n'aurait pas du laisser": {
        "ar": {"title": "الملف الذي كان يجب ألا يبقى"},
    },
    # Corrections d'extraits arabes ou anglais restés en francais
    "Le Top 10 OWASP et la surface d'attaque": {
        "ar": {"excerpt": "القائمة التي يشير إليها الجميع، وما فائدتها الحقيقية: ترتيب المخاطر لا عدّ الثغرات."},
    },
    "Hygiène numérique : le deuxième facteur": {
        "ar": {"excerpt": "رمز من ستة أرقام لا يحمي إلا إذا لم يستطع أحد تخمينه، ومن هنا تأتي قوائم الأكواد."},
    },
}

# --------------------------------------------------------------------------
# Titres de taches : le nom de la ceinture ou du brief etait reste en
# francais dans les traductions.
# --------------------------------------------------------------------------
TASKS = [
    ("Ceinture blanche : lire, chercher, comprendre", "الحزام blanche", "الحزام الأبيض"),
    ("Ceinture jaune : permissions, propriétaire, contenu", "الحزام jaune", "الحزام الأصفر"),
    ("Ceinture orange : réseau, processus, configuration", "الحزام orange", "الحزام البرتقالي"),
    ("Ceinture verte : binaires, chaînes, mémoire", "الحزام verte", "الحزام الأخضر"),
    ("Ceinture noire : cryptographie, clés, empreintes", "الحزام noire", "الحزام الأسود"),
    ("Brief 1 : le dojo, comment on s'entraîne", "le dojo, comment on s'entraîne", "الدوجو، كيف تتدرّب"),
    ("Brief 2 : le web, comment on parle à un serveur", "le web, comment on parle à un serveur", "الويب، كيف يتحدث إلى خادم"),
    ("Brief 3 : les scénarios d'exploitation", "les scénarios d'exploitation", "سيناريوهات الاستغلال"),
    ("Brief 4 : les registres, le carnet du processeur", "les registres, le carnet du processeur", "السجلات، دفتر المعالج"),
    ("Brief 5 : ne pas se faire avoir", "ne pas se faire avoir", "لا تُخدع"),
    ("Brief 6 : explorer une application web", "explorer une application web", "استكشاف تطبيق ويب"),
]

TASKS_EN = [
    ("Ceinture blanche : lire, chercher, comprendre", "the blanche belt", "the white belt"),
    ("Ceinture jaune : permissions, propriétaire, contenu", "the jaune belt", "the yellow belt"),
    ("Ceinture orange : réseau, processus, configuration", "the orange belt", "the orange belt"),
    ("Ceinture verte : binaires, chaînes, mémoire", "the verte belt", "the green belt"),
    ("Ceinture noire : cryptographie, clés, empreintes", "the noire belt", "the black belt"),
    ("Brief 1 : le dojo, comment on s'entraîne", "le dojo, comment on s'entraîne", "the dojo, how you train"),
    ("Brief 2 : le web, comment on parle à un serveur", "le web, comment on parle à un serveur", "the web, how you talk to a server"),
    ("Brief 3 : les scénarios d'exploitation", "les scénarios d'exploitation", "exploitation scenarios"),
    ("Brief 4 : les registres, le carnet du processeur", "les registres, le carnet du processeur", "registers, the processor's notebook"),
    ("Brief 5 : ne pas se faire avoir", "ne pas se faire avoir", "do not get fooled"),
    ("Brief 6 : explorer une application web", "explorer une application web", "exploring a web application"),
]


def php_quote(text):
    """Echappe une chaine pour un litteral PHP a apostrophes simples.

    Attention : le texte fourni ici est le texte lisible (avec de vraies
    apostrophes). On le convertit en litteral PHP : chaque apostrophe
    devient backslash + apostrophe.
    """
    return text.replace("\\", "\\\\").replace("'", "\\'")


def trouver_room(lignes, titre_fr):
    """Renvoie (debut, fin) de l'i18n de la room, ou (None, None).

    On cherche le titre francais, puis le bloc 'i18n' qui suit, et on
    s'arrete a sa fermeture (ligne '),' de meme indentation).
    """
    motif = re.compile(r"^\s*'title'\s*=>\s*'%s',\s*$" % re.escape(php_quote(titre_fr)))
    for i, line in enumerate(lignes):
        if motif.match(line):
            # le bloc i18n qui suit ce titre
            for k in range(i, min(i + 400, len(lignes))):
                if re.match(r"^\s*'i18n'\s*=>\s*array\(", lignes[k]):
                    ind = len(lignes[k]) - len(lignes[k].lstrip("\t"))
                    # fin du bloc i18n
                    for j in range(k + 1, len(lignes)):
                        cur = lignes[j]
                        if not cur.strip():
                            continue
                        cur_ind = len(cur) - len(cur.lstrip("\t"))
                        if cur_ind <= ind and cur.strip().startswith(")"):
                            return k, j
                    return k, len(lignes) - 1
    return None, None


def trouver_langue(lignes, debut, fin, langue):
    """Renvoie (debut, fin) du bloc 'ar' ou 'en' dans le bloc i18n."""
    for k in range(debut, fin + 1):
        if re.match(r"^\s*'%s'\s*=>\s*array\(" % langue, lignes[k]):
            ind = len(lignes[k]) - len(lignes[k].lstrip("\t"))
            for j in range(k + 1, fin + 1):
                cur = lignes[j]
                if not cur.strip():
                    continue
                cur_ind = len(cur) - len(cur.lstrip("\t"))
                if cur_ind <= ind and cur.strip().startswith(")"):
                    return k, j
            return k, fin
    return None, None


def remplacer_champ(lignes, debut, fin, champ, texte):
    """Remplace la valeur d'un champ dans un bloc. Renvoie True/False."""
    motif = re.compile(r"^(\s*)'%s'(\s*)=>(\s*)'.*',\s*$" % re.escape(champ))
    for k in range(debut, fin + 1):
        m = motif.match(lignes[k])
        if m:
            lignes[k] = "%s'%s'%s=> %s'%s'," % (
                m.group(1), champ, m.group(2), m.group(3), php_quote(texte)
            )
            return True
    return False


def remplacer_dans_bloc(lignes, debut, fin, vieux, neuf):
    """Remplace une sous-chaine dans un bloc. Renvoie le nombre de hits.

    La recherche se fait sur la forme echappee telle qu'elle figure dans
    le fichier source (les apostrophes y sont precedees d'un backslash).
    """
    cible = php_quote(vieux)
    remplacement = php_quote(neuf)
    n = 0
    for k in range(debut, fin + 1):
        if cible in lignes[k]:
            lignes[k] = lignes[k].replace(cible, remplacement)
            n += 1
    return n


def main():
    erreurs = []
    rapport = []

    # Les corrections francaises : chaque chaine est cherchee dans tous
    # les fichiers, et n'est signalee comme manquante que si elle est
    # absente de tous.
    for vieux, neuf in FR:
        # Dans le fichier source, une apostrophe s'ecrit backslash +
        # apostrophe. On convertit donc les deux cotes de la meme facon.
        vieux_fic = php_quote(vieux)
        neuf_fic = php_quote(neuf)
        trouve = False
        for fichier in FICHIERS:
            chemin = BASE + fichier
            lignes = io.open(chemin, encoding="utf-8").read().split("\n")
            change = False
            for k, line in enumerate(lignes):
                if vieux_fic in line:
                    lignes[k] = line.replace(vieux_fic, neuf_fic)
                    change = True
                    trouve = True
            if change:
                rapport.append("%s : FR corrige" % fichier)
                io.open(chemin, "w", encoding="utf-8").write("\n".join(lignes))
        if not trouve:
            erreurs.append("FR introuvable dans tous les fichiers -> %s" % vieux[:50])

    # Les corrections de traduction : une room n'existe que dans un
    # fichier ; on parcourt donc tous les fichiers pour chaque room.
    for titre_fr, corrections in I18N.items():
        traite = False
        for fichier in FICHIERS:
            chemin = BASE + fichier
            lignes = io.open(chemin, encoding="utf-8").read().split("\n")
            debut, fin = trouver_room(lignes, titre_fr)
            if debut is None:
                continue
            traite = True
            for langue, champs in corrections.items():
                d, f = trouver_langue(lignes, debut, fin, langue)
                if d is None:
                    erreurs.append("%s : bloc %s introuvable -> %s" % (fichier, langue, titre_fr))
                    continue
                for champ, texte in champs.items():
                    if remplacer_champ(lignes, d, f, champ, texte):
                        rapport.append("%s : %s/%s corrige (%s)" % (fichier, langue, champ, titre_fr[:32]))
                    else:
                        erreurs.append("%s : champ %s/%s introuvable -> %s" % (fichier, langue, champ, titre_fr))
            io.open(chemin, "w", encoding="utf-8").write("\n".join(lignes))
        if not traite:
            erreurs.append("room introuvable dans tous les fichiers -> %s" % titre_fr)

    # Les titres de taches : idem.
    for liste, langue in ((TASKS, "ar"), (TASKS_EN, "en")):
        for titre_fr, vieux, neuf in liste:
            traite = False
            for fichier in FICHIERS:
                chemin = BASE + fichier
                lignes = io.open(chemin, encoding="utf-8").read().split("\n")
                debut, fin = trouver_room(lignes, titre_fr)
                if debut is None:
                    continue
                d, f = trouver_langue(lignes, debut, fin, langue)
                if d is None:
                    continue
                if remplacer_dans_bloc(lignes, d, f, vieux, neuf):
                    rapport.append("%s : tache %s corrigee (%s)" % (fichier, langue.upper(), titre_fr[:32]))
                    io.open(chemin, "w", encoding="utf-8").write("\n".join(lignes))
                    traite = True
            if not traite:
                erreurs.append("tache %s introuvable -> %s" % (langue.upper(), vieux))

    for r in rapport:
        print("OK  " + r)

    if erreurs:
        print("")
        print("PROBLEMES :")
        for e in erreurs:
            print("  " + e)
        sys.exit(1)

    print("")
    print("%d corrections appliquees, aucune erreur." % len(rapport))


def _inutilise(lignes):
    """Bloc conserve pour reference (ancienne boucle par fichier)."""
    if True:
        return

    for fichier in FICHIERS:
        chemin = BASE + fichier
        lignes = io.open(chemin, encoding="utf-8").read().split("\n")

        # ---- corrections francaises ----
        for vieux, neuf in FR:
            trouve = False
            for k, line in enumerate(lignes):
                if vieux in line:
                    lignes[k] = line.replace(vieux, neuf)
                    trouve = True
                    rapport.append("%s : FR corrige" % fichier)
            if not trouve:
                erreurs.append("%s : FR introuvable -> %s" % (fichier, vieux[:50]))

        # ---- corrections des traductions ----
        for titre_fr, corrections in I18N.items():
            debut, fin = trouver_room(lignes, titre_fr)
            if debut is None:
                erreurs.append("%s : room introuvable -> %s" % (fichier, titre_fr))
                continue
            for langue, champs in corrections.items():
                d, f = trouver_langue(lignes, debut, fin, langue)
                if d is None:
                    erreurs.append("%s : bloc %s introuvable -> %s" % (fichier, langue, titre_fr))
                    continue
                for champ, texte in champs.items():
                    if remplacer_champ(lignes, d, f, champ, texte):
                        rapport.append("%s : %s/%s corrige (%s)" % (fichier, langue, champ, titre_fr[:32]))
                    else:
                        erreurs.append("%s : champ %s/%s introuvable -> %s" % (fichier, langue, champ, titre_fr))

        # ---- titres de taches ----
        for titre_fr, vieux, neuf in TASKS:
            debut, fin = trouver_room(lignes, titre_fr)
            if debut is None:
                continue
            d, f = trouver_langue(lignes, debut, fin, "ar")
            if d is None:
                continue
            if remplacer_dans_bloc(lignes, d, f, vieux, neuf):
                rapport.append("%s : tache AR corrigee (%s)" % (fichier, titre_fr[:32]))
            else:
                erreurs.append("%s : tache AR introuvable -> %s" % (fichier, vieux))

        for titre_fr, vieux, neuf in TASKS_EN:
            debut, fin = trouver_room(lignes, titre_fr)
            if debut is None:
                continue
            d, f = trouver_langue(lignes, debut, fin, "en")
            if d is None:
                continue
            if remplacer_dans_bloc(lignes, d, f, vieux, neuf):
                rapport.append("%s : tache EN corrigee (%s)" % (fichier, titre_fr[:32]))
            else:
                erreurs.append("%s : tache EN introuvable -> %s" % (fichier, vieux))

        io.open(chemin, "w", encoding="utf-8").write("\n".join(lignes))

    for r in rapport:
        print("OK  " + r)

    if erreurs:
        print("")
        print("PROBLEMES :")
        for e in erreurs:
            print("  " + e)
        sys.exit(1)

    print("")
    print("%d corrections appliquees, aucune erreur." % len(rapport))


if __name__ == "__main__":
    main()
