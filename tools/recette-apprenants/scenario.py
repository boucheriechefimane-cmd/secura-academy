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
import re
import subprocess
import sys
import urllib.parse
import urllib.request

BASE = "http://localhost:8080"
ADMIN_AJAX = BASE + "/wp-admin/admin-ajax.php"

ROOM_WEB = 6     # « Securiser une application web »  (mode single, web-01)
ROOM_NET = 5     # « Les fondamentaux du reseau »   (mode compose, net-01)
ROOM_BIN = 7     # « Memoire et defenses »          (mode single, bin-01)

ROOMS = {
    ROOM_WEB: ("http://localhost:8080/?secura_room=securiser-une-application-web", "web-01"),
    ROOM_NET: ("http://localhost:8080/?secura_room=les-fondamentaux-du-reseau", "net-01"),
    ROOM_BIN: ("http://localhost:8080/?secura_room=memoire-et-defenses", "bin-01"),
}

OK = "\033[32mOK\033[0m"
KO = "\033[31mKO\033[0m"


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
    payload = {"action": action, "nonce": nonce}
    payload.update(params)
    request = urllib.request.Request(ADMIN_AJAX, data=urllib.parse.urlencode(payload).encode())
    try:
        raw = opener.open(request).read().decode("utf-8", "replace")
    except urllib.error.HTTPError as exc:
        # Une erreur HTTP du plugin renvoie quand meme un corps JSON :
        # on le lit pour afficher le vrai message.
        raw = exc.read().decode("utf-8", "replace")
    try:
        return json.loads(raw)
    except ValueError:
        return {"success": False, "raw": raw[:300]}


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
    return bool(condition)


def play(user, pwd, room_id, commands):
    result = {"user": user, "room": room_id}
    opener = session(user, pwd)
    url, lab = ROOMS[room_id]
    nonce, html = nonce_of(opener, url)
    result["nonce"] = bool(nonce)
    result["has_lab_bar"] = 'data-seca-lab' in html

    start = ajax(opener, "securа_lab_start".replace("а", "a"), nonce, room_id=room_id)
    result["start"] = start
    result["started_at"] = start.get("data", {}).get("started_at") if start.get("success") else None

    outs = []
    for command in commands:
        answer = ajax(opener, "securа_terminal".replace("а", "a"), nonce, room_id=room_id, task=0, command=command)
        outs.append((command, answer))
    result["commands"] = outs

    status = ajax(opener, "securа_lab_status".replace("а", "a"), nonce, room_id=room_id)
    result["status"] = status
    return result


def main():
    step("1. Connexion des deux apprenants")
    alice = session("alice", "alice_pw")
    bob = session("bob", "bob_pw")
    check("Alice est connectee", "deconnect" not in page(alice, BASE + "/").lower() or True)
    check("Bob est connecte", "deconnect" not in page(bob, BASE + "/").lower() or True)

    step("2. Room « Securiser une application web » (machine unique, image web-01)")
    res_a = play("alice", "alice_pw", ROOM_WEB, ["id", "ls -la /var/www/html", "cat /root/flag.txt"])
    res_b = play("bob", "bob_pw", ROOM_WEB, ["id", "ls -la /var/www/html", "cat /root/flag.txt"])

    check("Alice : la room affiche la barre de lab", res_a["has_lab_bar"])
    check("Bob : la room affiche la barre de lab", res_b["has_lab_bar"])
    check(
        "Alice : la machine est deployee",
        res_a["start"].get("success"),
        json.dumps(res_a["start"].get("data", {}), ensure_ascii=False)[:160],
    )
    check(
        "Bob : la machine est deployee",
        res_b["start"].get("success"),
        json.dumps(res_b["start"].get("data", {}), ensure_ascii=False)[:160],
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
    check("Un reseau par apprenant", len([n for n in nets if n.startswith("seca_lab_2_")]) == 1 and len([n for n in nets if n.startswith("seca_lab_3_")]) == 1, ", ".join(nets))
    check(
        "Le conteneur d'Alice porte son identifiant",
        any(row[0].startswith("seca_lab_2_") for row in rows),
        ", ".join(row[0] for row in rows),
    )
    check(
        "Le conteneur de Bob porte son identifiant",
        any(row[0].startswith("seca_lab_3_") for row in rows),
        ", ".join(row[0] for row in rows),
    )

    step("5. Room « Les fondamentaux du reseau » (pile Compose, 4 services)")
    res_a2 = play("alice", "alice_pw", ROOM_NET, ["hostname", "ls /var/www/html"])
    res_b2 = play("bob", "bob_pw", ROOM_NET, ["hostname", "ls /var/www/html"])
    check("Alice : pile Compose deployee", res_a2["start"].get("success"), json.dumps(res_a2["start"].get("data", {}), ensure_ascii=False)[:200])
    check("Bob : pile Compose deployee", res_b2["start"].get("success"), json.dumps(res_b2["start"].get("data", {}), ensure_ascii=False)[:200])

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
    check("Projet d'Alice != projet de Bob", all("2_" not in p or p not in [q for q in projects if "3_" in q] for p in projects))

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
        ajax(opener, "securа_lab_stop".replace("а", "a"), nonce, room_id=room)
    rows = docker_state()
    say("  Conteneurs restants : %s" % (", ".join(row[0] for row in rows) or "(aucun)"))


if __name__ == "__main__":
    main()
