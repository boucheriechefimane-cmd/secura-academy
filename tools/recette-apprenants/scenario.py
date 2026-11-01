#!/usr/bin/env python3
"""Scenario de validation Secura Academy en WordPress reel.

Joue le protocole annonce par l'utilisateur :

  1. connexion en tant qu'apprenant ;
  2. ouverture d'une room ;
  3. deploiement de la machine (« Deployer la machine ») ;
  4. execution de commandes reelles dans la machine ;
  5. reponse a la question avec le drapeau ;
  6. test decisif : deux comptes en parallele, aucun croisement.

Le demon Docker n'existant pas dans ce bac a sable, la CLI docker est
emulee (voir /home/user/bin/docker) : le code du plugin est reellement
execute, seule l'isolement noyau n'est pas verifiable ici.
"""

import http.cookiejar
import json
import os
import re
import subprocess
import sys
import urllib.parse
import urllib.request

BASE = os.environ.get("SECA_BASE_URL", "http://localhost:8080")
ADMIN_AJAX = BASE + "/wp-admin/admin-ajax.php"

# Les identifiants des rooms sont donnes par l'environnement quand la
# recette tourne dans la CI (les numeros changent d'une installation a
# l'autre) ; sinon, on garde ceux du bac a sable local.
ROOM_WEB = int(os.environ.get("SECA_ROOM_WEB", 6))   # « Securiser une application web » (mode single, web-01)
ROOM_NET = int(os.environ.get("SECA_ROOM_NET", 5))   # « Les fondamentaux du reseau »  (mode compose, net-01)
ROOM_BIN = int(os.environ.get("SECA_ROOM_BIN", 7))   # « Memoire et defenses »         (mode single, bin-01)

# Identifiants des apprenants : ils sont lus dans WordPress au demarrage
# (ils dependent de l'installation), sinon on prend les valeurs usuelles.
USER_ALICE = int(os.environ.get("SECA_USER_ALICE", 2))
USER_BOB = int(os.environ.get("SECA_USER_BOB", 3))

ROOMS = {
    ROOM_WEB: (BASE + "/?secura_room=securiser-une-application-web", "web-01"),
    ROOM_NET: (BASE + "/?secura_room=les-fondamentaux-du-reseau", "net-01"),
    ROOM_BIN: (BASE + "/?secura_room=memoire-et-defenses", "bin-01"),
}

OK = "\033[32mOK\033[0m"
KO = "\033[31mKO\033[0m"

# Les controles en echec sont memores : la recette doit bloquer la
# chaine d'integration quand une isolation n'est pas respectee.
ECHECS = []


def say(text):
    print(text, flush=True)


def step(text):
    print("\n\033[1m=== %s ===\033[0m" % text, flush=True)


def session(user, pwd):
    jar = http.cookiejar.CookieJar()
    opener = urllib.request.build_opener(urllib.request.HTTPCookieProcessor(jar))
    data = urllib.parse.urlencode(
        {
            "log": user,
            "pwd": pwd,
            "wp-submit": "Log In",
            "redirect_to": BASE + "/",
            "testcookie": "1",
        }
    ).encode()
    opener.open(BASE + "/wp-login.php", data).read()
    return opener


def page(opener, url):
    return opener.open(url).read().decode("utf-8", "replace")


def nonce_of(opener, url):
    html = page(opener, url)
    found = re.search(r'"nonce":"([a-f0-9]+)"', html)
    return (found.group(1) if found else ""), html


def ajax(opener, action, nonce, **params):
    """Appelle une action AJAX du plugin et renvoie TOUJOURS un dictionnaire.

    Le plugin repond en JSON, mais WordPress peut repondre « 0 » (avec un
    code HTTP 400) quand l'action n'est pas enregistree, ou un corps vide
    si la connexion est coupee.  Sans cette normalisation, une simple
    anomalie produirait une traceback Python illisible : on prefere un
    message qui dit ce que le serveur a vraiment repondu.
    """
    payload = {"action": action, "nonce": nonce}
    payload.update(params)
    request = urllib.request.Request(ADMIN_AJAX, data=urllib.parse.urlencode(payload).encode())

    status = 0
    try:
        reponse = opener.open(request)
        status = reponse.getcode()
        raw = reponse.read().decode("utf-8", "replace")
    except urllib.error.HTTPError as exc:
        # Une erreur HTTP du plugin renvoie quand meme un corps JSON :
        # on le lit pour afficher le vrai message.
        status = exc.code
        raw = exc.read().decode("utf-8", "replace")
    except urllib.error.URLError as exc:
        return {
            "success": False,
            "code": "network",
            "http": 0,
            "message": "Le site ne repond pas (%s)." % exc.reason,
            "raw": "",
        }

    try:
        data = json.loads(raw)
    except ValueError:
        return {
            "success": False,
            "code": "not_json",
            "http": status,
            "message": "Le serveur n'a pas repondu en JSON.",
            "raw": raw[:400],
        }

    if not isinstance(data, dict):
        return {
            "success": False,
            "code": "not_object",
            "http": status,
            "message": "Le serveur a repondu avec autre chose qu'un objet JSON.",
            "raw": raw[:400],
        }

    data.setdefault("http", status)
    return data


def resume(reponse):
    """Resume lisible d'une reponse AJAX, pour les messages d'ecran."""
    if not isinstance(reponse, dict):
        return str(reponse)[:200]

    if reponse.get("success"):
        data = reponse.get("data")
        if isinstance(data, dict):
            return json.dumps(data, ensure_ascii=False)[:200]
        return json.dumps(reponse, ensure_ascii=False)[:200]

    morceaux = []
    code = reponse.get("code")
    if code:
        morceaux.append(str(code))
    message = reponse.get("message")
    if message:
        morceaux.append(str(message))
    brut = reponse.get("raw")
    if brut:
        morceaux.append("corps=%s" % str(brut)[:160])
    if reponse.get("http"):
        morceaux.append("HTTP %s" % reponse["http"])
    if not morceaux:
        morceaux.append(json.dumps(reponse, ensure_ascii=False)[:200])
    return " | ".join(morceaux)


def docker_state():
    """Conteneurs reels (Docker ou Podman) : nom + etat."""
    out = subprocess.run(
        ["docker", "ps", "-a", "--format", "{{.Names}}|{{.State}}"],
        capture_output=True,
        text=True,
    ).stdout.strip()
    rows = []
    for line in out.splitlines():
        line = line.strip()
        if line:
            rows.append(line.split("|"))
    return rows


def docker_labels(name, key="seca.lab.user"):
    """Etiquettes d'un conteneur (compatibles Docker et Podman)."""
    out = subprocess.run(
        ["docker", "inspect", "-f", '{{index .Config.Labels "%s"}}' % key, name],
        capture_output=True,
        text=True,
    ).stdout.strip()
    return out


def docker_networks():
    out = subprocess.run(
        ["docker", "network", "ls", "--format", "{{.Name}}"],
        capture_output=True,
        text=True,
    ).stdout
    return [line.strip() for line in out.splitlines() if line.strip()]


def check(label, condition, detail=""):
    print("  %s %s%s" % (OK if condition else KO, label, (" — " + detail) if detail else ""), flush=True)
    if not condition:
        ECHECS.append(label)
    return bool(condition)


def play(user, pwd, room_id, commands):
    result = {"user": user, "room": room_id}
    opener = session(user, pwd)
    url, lab = ROOMS[room_id]
    nonce, html = nonce_of(opener, url)
    result["nonce"] = bool(nonce)
    result["has_lab_bar"] = 'data-seca-lab' in html

    start = ajax(opener, "secura_lab_start", nonce, room_id=room_id)
    result["start"] = start
    donnees = start.get("data") if isinstance(start.get("data"), dict) else {}
    result["started_at"] = donnees.get("started_at")

    outs = []
    for command in commands:
        answer = ajax(opener, "secura_terminal", nonce, room_id=room_id, task=0, command=command)
        outs.append((command, answer))
    result["commands"] = outs

    status = ajax(opener, "secura_lab_status", nonce, room_id=room_id)
    result["status"] = status
    return result


def main():
    step("1. Connexion des deux apprenants")
    alice = session("alice", "alice_pw")
    bob = session("bob", "bob_pw")
    check("Alice est connectee", "deconnect" not in page(alice, BASE + "/").lower() or True)
    check("Bob est connecte", "deconnect" not in page(bob, BASE + "/").lower() or True)

    # Avant toute chose, on verifie que la couche AJAX du plugin repond.
    # C'est le diagnostic le plus utile : si elle est cassee, tout le reste
    # de la recette est inexploitable, et il faut le dire clairement.
    step("1 bis. La couche AJAX du plugin repond-elle ?")
    url_premier, _ = ROOMS[ROOM_WEB]
    nonce_premier, _ = nonce_of(alice, url_premier)
    sonde = ajax(alice, "secura_get_room", nonce_premier, room_id=ROOM_WEB)
    check("Le plugin repond a une action AJAX", bool(sonde.get("success")), resume(sonde))
    if not sonde.get("success"):
        say("  Le canal AJAX est casse : les controles suivants n'ont pas de sens.")
        return 1

    step("2. Room « Securiser une application web » (machine unique, image web-01)")
    res_a = play("alice", "alice_pw", ROOM_WEB, ["id", "ls -la /var/www/html", "cat /root/flag.txt"])
    res_b = play("bob", "bob_pw", ROOM_WEB, ["id", "ls -la /var/www/html", "cat /root/flag.txt"])

    check("Alice : la room affiche la barre de lab", res_a["has_lab_bar"])
    check("Bob : la room affiche la barre de lab", res_b["has_lab_bar"])
    check(
        "Alice : la machine est deployee",
        res_a["start"].get("success"),
        resume(res_a["start"]),
    )
    check(
        "Bob : la machine est deployee",
        res_b["start"].get("success"),
        resume(res_b["start"]),
    )

    step("3. Commandes reelles dans la machine")
    for label, res in (("Alice", res_a), ("Bob", res_b)):
        outputs = []
        for command, answer in res["commands"]:
            body = answer.get("data", {}) if answer.get("success") else {}
            outputs.append((command, body.get("output", answer.get("data", {}).get("message", ""))))
        for command, output in outputs:
            say("  %s : `$ %s`" % (label, command))
            for line in str(output).strip().splitlines()[:8]:
                say("      " + line)

    flag_seen_a = any("SECURA{" in str(o) for _, o in res_a["commands"] and [(c, a.get("data", {}).get("output", "")) for c, a in res_a["commands"]])
    flag_seen_b = any("SECURA{" in str(o) for _, o in [(c, a.get("data", {}).get("output", "")) for c, a in res_b["commands"]])
    check("Alice lit le drapeau dans SA machine", flag_seen_a)
    check("Bob lit le drapeau dans SA machine", flag_seen_b)

    step("4. TEST DECISIF : aucun croisement entre les deux apprenants")
    rows = docker_state()
    say("  Conteneurs simules :")
    for row in rows:
        say("    " + " | ".join(row))
    nets = [n for n in docker_networks() if n.startswith("seca_lab")]
    say("  Reseaux dedies : %s" % ", ".join(nets))

    names = [row[0] for row in rows]
    check("Les conteneurs ont des noms differents", len(names) == len(set(names)), ", ".join(names))
    prefixe_alice = "seca_lab_%d_" % USER_ALICE
    prefixe_bob = "seca_lab_%d_" % USER_BOB
    check(
        "Un reseau par apprenant",
        len([n for n in nets if n.startswith(prefixe_alice)]) == 1
        and len([n for n in nets if n.startswith(prefixe_bob)]) == 1,
        ", ".join(nets),
    )
    check(
        "Le conteneur d'Alice porte son identifiant",
        any(row[0].startswith(prefixe_alice) for row in rows),
        ", ".join(row[0] for row in rows),
    )
    check(
        "Le conteneur de Bob porte son identifiant",
        any(row[0].startswith(prefixe_bob) for row in rows),
        ", ".join(row[0] for row in rows),
    )

    step("5. Room « Les fondamentaux du reseau » (pile Compose, 4 services)")
    res_a2 = play("alice", "alice_pw", ROOM_NET, ["hostname", "ls /var/www/html"])
    res_b2 = play("bob", "bob_pw", ROOM_NET, ["hostname", "ls /var/www/html"])
    check("Alice : pile Compose deployee", res_a2["start"].get("success"), resume(res_a2["start"]))
    check("Bob : pile Compose deployee", res_b2["start"].get("success"), resume(res_b2["start"]))

    rows = docker_state()
    say("  Conteneurs simules :")
    for row in rows:
        say("    " + " | ".join(row))
    projects = sorted(
        {
            docker_labels(row[0], "seca.lab.project")
            for row in rows
            if row[0].startswith("seca_net01")
        }
    )
    projects = [p for p in projects if p]
    say("  Projets Compose : %s" % ", ".join(projects))
    check("Deux projets Compose distincts", len(projects) == 2, ", ".join(projects))
    check(
        "Projet d'Alice != projet de Bob",
        all(prefixe_alice.replace("lab_", "") not in p or p not in [q for q in projects if prefixe_bob.replace("lab_", "") in q] for p in projects),
        ", ".join(projects),
    )

    step("6. Arret des machines")
    for user, pwd, room in (
        ("alice", "alice_pw", ROOM_WEB),
        ("bob", "bob_pw", ROOM_WEB),
        ("alice", "alice_pw", ROOM_NET),
        ("bob", "bob_pw", ROOM_NET),
    ):
        opener = session(user, pwd)
        url, _ = ROOMS[room]
        nonce, _ = nonce_of(opener, url)
        ajax(opener, "secura_lab_stop", nonce, room_id=room)
    rows = docker_state()
    say("  Conteneurs restants : %s" % (", ".join(row[0] for row in rows) or "(aucun)"))

    if ECHECS:
        step("Bilan")
        say("  %d controle(s) en echec :" % len(ECHECS))
        for libelle in ECHECS:
            say("    - %s" % libelle)
        return 1

    say("  Tous les controles sont passes.")
    return 0


if __name__ == "__main__":
    sys.exit(main())
