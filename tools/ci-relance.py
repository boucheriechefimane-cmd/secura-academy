#!/usr/bin/env python3
"""Relance les workflows GitHub qui ont echoue sans etapes (incident d'infrastructure).

Quand l'infrastructure de GitHub Actions ne peut plus affecter de runner,
chaque job echoue en deux secondes, SANS executer une seule etape. Ce n'est
pas un defaut du code : c'est visible dans l'API (`steps` vide,
`runner_name` vide). Ce script surveille les workflows du commit courant et
relance ceux qui echouent de cette facon, jusqu'a ce qu'ils passent ou que la
limite de temps soit atteinte.

Usage :
    python3 tools/ci-relance.py --sha <sha> [--minutes 60] [--intervalle 180]
"""

import argparse
import io
import json
import os
import re
import sys
import time
import urllib.error
import urllib.request

REPO = "boucheriechefimane-cmd/secura-academy"


def jeton():
    chemin = os.path.expanduser("~/.config/gh/hosts.yml")
    texte = io.open(chemin, encoding="utf-8").read()
    trouve = re.search(r"oauth_token:\s*(\S+)", texte)
    if not trouve:
        raise SystemExit("jeton introuvable dans %s" % chemin)
    return trouve.group(1)


def api(url, meth="GET", data=None, cle=None):
    corps = json.dumps(data).encode() if data is not None else None
    entetes = {
        "Authorization": "token " + cle,
        "Accept": "application/vnd.github+json",
        "User-Agent": "secura-ci-relance",
    }
    if corps:
        entetes["Content-Type"] = "application/json"
    requete = urllib.request.Request(url, headers=entetes, method=meth, data=corps)
    try:
        return json.load(urllib.request.urlopen(requete, timeout=60))
    except urllib.error.HTTPError as e:
        return {"_erreur": e.code, "_corps": e.read()[:300].decode("utf-8", "ignore")}


def main(argv=None):
    analyseur = argparse.ArgumentParser(description=__doc__)
    analyseur.add_argument("--sha", required=True)
    analyseur.add_argument("--minutes", type=int, default=90)
    analyseur.add_argument("--intervalle", type=int, default=180)
    args = analyseur.parse_args(argv)

    cle = jeton()
    base = "https://api.github.com/repos/%s" % REPO
    fin = time.time() + args.minutes * 60
    connus = {}

    while time.time() < fin:
        runs = api(base + "/actions/runs?head_sha=%s&per_page=30" % args.sha,
                   cle=cle)["workflow_runs"]
        for run in runs:
            nom = run["name"]
            etat = "%s/%s" % (run["status"], run["conclusion"])
            if connus.get(nom) != etat:
                print("%-45s %s" % (nom, etat), flush=True)
                connus[nom] = etat
            if run["status"] != "completed" or run["conclusion"] != "failure":
                continue
            # Un job qui echoue en quelques secondes, sans etape et sans
            # runner, est un incident d'infrastructure : on relance.
            jobs = api(base + "/actions/runs/%d/jobs?per_page=100" % run["id"],
                       cle=cle).get("jobs", [])
            suspect = jobs and all(
                (not j.get("steps")) and (not j.get("runner_name"))
                for j in jobs if j.get("conclusion") == "failure")
            if suspect:
                print("   -> incident d'infrastructure : relance du run %d"
                      % run["id"], flush=True)
                api(base + "/actions/runs/%d/rerun" % run["id"], meth="POST",
                    cle=cle)
                connus[nom] = "relance"
        if runs and len(runs) >= 5 and all(
                r["status"] == "completed" and r["conclusion"] == "success"
                for r in runs):
            print("Tous les workflows sont verts.", flush=True)
            return 0
        time.sleep(args.intervalle)
    print("Fin de la surveillance : au moins un workflow n'est pas vert.",
          flush=True)
    return 1


if __name__ == "__main__":
    sys.exit(main())
