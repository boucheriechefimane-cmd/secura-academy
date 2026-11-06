#!/usr/bin/env python3
"""Epreuves de la machine web-01 : l'injection SQL fonctionne-t-elle ?

POURQUOI CE SCRIPT EXISTE
-------------------------
La room « la requete qui ne se fie a personne » demande a l'eleve de se
connecter en administrateur sans connaitre le mot de passe. Si l'injection
ne marche plus — une version de PHP qui change, un echappement introduit par
megarde, un SQLite absent — la machine devient un mur, et l'eleve croit que
c'est lui qui ne sait pas faire.

Ce script joue l'attaque contre la machine qui tourne, exactement comme
l'eleve la jouerait avec curl. Il verifie ensuite que la connexion aboutit
ET que la page d'administration est reellement protegee (l'epreuve negative
compte autant que la positive : une application qui laisserait entrer tout
le monde ne serait pas un exercice).

Usage :
    python3 tools/labs/epreuves-web.py --base http://127.0.0.1:18080
    python3 tools/labs/epreuves-web.py --base http://127.0.0.1:18080 --verbeux

Sortie 0 si tout passe, 1 sinon.
"""

import argparse
import http.cookiejar
import sys
import urllib.error
import urllib.parse
import urllib.request


def session():
    """Ouvre une session HTTP qui garde les cookies (comme un navigateur)."""
    pot = http.cookiejar.CookieJar()
    ouvreur = urllib.request.build_opener(urllib.request.HTTPCookieProcessor(pot))

    return ouvreur, pot


def poster(ouvreur, url, donnees):
    corps = urllib.parse.urlencode(donnees).encode("utf-8")
    requete = urllib.request.Request(url, data=corps, method="POST")

    try:
        with ouvreur.open(requete, timeout=10) as reponse:
            return reponse.status, reponse.read().decode("utf-8", "replace")
    except urllib.error.HTTPError as erreur:
        return erreur.code, erreur.read().decode("utf-8", "replace")


def lire(ouvreur, url):
    try:
        with ouvreur.open(url, timeout=10) as reponse:
            return reponse.status, reponse.read().decode("utf-8", "replace")
    except urllib.error.HTTPError as erreur:
        return erreur.code, erreur.read().decode("utf-8", "replace")


def main():
    parseur = argparse.ArgumentParser()
    parseur.add_argument("--base", required=True)
    parseur.add_argument("--verbeux", action="store_true")
    options = parseur.parse_args()

    base = options.base.rstrip("/")
    ok = 0
    echecs = []

    print("EPREUVES — machine web-01, cible « {0} »".format(base))
    print("")

    # 1. L'application repond et propose un formulaire.
    ouvreur, _ = session()
    statut, page = lire(ouvreur, base + "/")

    if statut == 200 and "<form" in page.lower():
        ok += 1
    else:
        echecs.append("la page d'accueil ne presente pas de formulaire (statut {0})".format(statut))

    # 2. Une connexion avec de faux identifiants est refusee.
    ouvreur, _ = session()
    statut, page = poster(
        ouvreur, base + "/", {"username": "inconnu", "password": "mauvais"}
    )

    if "invalides" in page.lower() or "invalid" in page.lower():
        ok += 1
    else:
        echecs.append("une connexion avec de faux identifiants n'est pas refusee")

    # 3. L'injection en commentaire : ' OR 1=1 --
    #    C'est l'attaque de la room. Sans le commentaire, la clause sur le
    #    mot de passe resterait et la requete echouerait : le commentaire est
    #    la partie que l'eleve doit comprendre.
    ouvreur, pot = session()
    statut, page = poster(
        ouvreur, base + "/", {"username": "admin' OR 1=1 --", "password": "x"}
    )

    cookies = {c.name for c in pot}
    statut_admin, page_admin = lire(ouvreur, base + "/admin.php")

    if statut_admin == 200 and "administration" in page_admin.lower():
        ok += 1
        if options.verbeux:
            print("  injection : connexion administrateur obtenue")
    else:
        echecs.append(
            "l'injection SQL ne donne pas acces a l'administration "
            "(statut {0}, cookies {1})".format(statut_admin, cookies or "aucun")
        )

    # 4. La page d'administration est protegee sans session.
    ouvreur, _ = session()
    statut, page = lire(ouvreur, base + "/admin.php")

    if statut != 200 or "administration" not in page.lower():
        ok += 1
    else:
        echecs.append("la page d'administration est accessible SANS etre connecte")

    # 5. La page de diagnostic expose la configuration (elle fait partie du lab).
    statut, page = lire(urllib.request.build_opener(), base + "/diag.php")

    if statut == 200 and "app.conf" in page:
        ok += 1
    else:
        echecs.append("la page de diagnostic n'expose plus la configuration du lab")

    print("  epreuves reussies         : {0}/5".format(ok))

    if echecs:
        print("")
        print("ECHECS :")

        for echec in echecs:
            print("  -", echec)

        return 1

    print("")
    print("VERDICT : l'injection fonctionne, la page d'administration reste protegee.")
    return 0


if __name__ == "__main__":
    sys.exit(main())
