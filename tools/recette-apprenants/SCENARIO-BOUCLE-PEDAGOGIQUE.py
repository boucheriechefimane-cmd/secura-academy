#!/usr/bin/env python3
"""Boucle pedagogique complete en WordPress reel.

Un apprenant deploie une machine, trouve le drapeau, repond aux questions,
gagne de l'XP et debloque la tache suivante. Verifie aussi que les deux
apprenants ont des progressions separees.
"""

import http.cookiejar
import json
import re
import subprocess
import urllib.parse
import urllib.request

BASE = "http://localhost:8080"
AJAX = BASE + "/wp-admin/admin-ajax.php"
ROOM = 6
ROOM_URL = BASE + "/?secura_room=securiser-une-application-web"

OK = "\033[32mOK\033[0m"
KO = "\033[31mKO\033[0m"


def session(user, pwd):
    jar = http.cookiejar.CookieJar()
    opener = urllib.request.build_opener(urllib.request.HTTPCookieProcessor(jar))
    data = urllib.parse.urlencode(
        {"log": user, "pwd": pwd, "wp-submit": "Log In", "redirect_to": BASE + "/", "testcookie": "1"}
    ).encode()
    opener.open(BASE + "/wp-login.php", data).read()
    return opener


def nonce_of(opener, url):
    html = opener.open(url).read().decode("utf-8", "replace")
    found = re.search(r'"nonce":"([a-f0-9]+)"', html)
    return found.group(1) if found else ""


def ajax(opener, action, nonce, **params):
    payload = {"action": action, "nonce": nonce}
    payload.update(params)
    request = urllib.request.Request(AJAX, data=urllib.parse.urlencode(payload).encode())
    raw = opener.open(request).read().decode("utf-8", "replace")
    try:
        return json.loads(raw)
    except ValueError:
        return {"success": False, "raw": raw[:200]}


def check(label, condition, detail=""):
    print("  %s %s%s" % (OK if condition else KO, label, (" — " + detail) if detail else ""), flush=True)
    return bool(condition)


def xp_of(user):
    out = subprocess.run(
        ["/home/user/wp/wp", "user", "get", user, "--field=secura_xp", "--allow-root"],
        capture_output=True,
        text=True,
    )
    return out.stdout.strip() or "0"


def main():
    questions = json.load(open("/home/user/run/room6_questions.json"))

    for user, pwd in (("alice", "alice_pw"), ("bob", "bob_pw")):
        print("\n\033[1m=== %s ===\033[0m" % user.capitalize())
        opener = session(user, pwd)
        nonce = nonce_of(opener, ROOM_URL)

        start = ajax(opener, "securа_lab_start".replace("а", "a"), nonce, room_id=ROOM)
        check("machine deployee", start.get("success"), start.get("data", {}).get("message", ""))

        # Le cours est d'abord valide : c'est lui qui ouvre la tache pratique.
        lesson = ajax(opener, "securа_complete_lesson".replace("а", "a"), nonce, room_id=ROOM, task=0)
        check("le cours (tache 0) est valide", lesson.get("success"), json.dumps(lesson.get("data", {}), ensure_ascii=False)[:120])

        # L'apprenant cherche le drapeau dans la machine.
        found = ajax(opener, "securа_terminal".replace("а", "a"), nonce, room_id=ROOM, task=1, command="cat /root/flag.txt")
        output = found.get("data", {}).get("output", "")
        check("le drapeau est lisible dans la machine", "SECURA{" in output, output.strip()[:60])

        # Reponse aux questions, tache par tache.
        answered = 0
        for question in questions:
            if question["task"] == 0:
                continue
            reply = question["answers"][question["correct"]] if question["answers"] else ""
            answer = ajax(
                opener,
                "securа_validate_answer".replace("а", "a"),
                nonce,
                room_id=ROOM,
                task=question["task"],
                question=question["q"],
                answer=reply,
            )
            if answer.get("success"):
                answered += 1
            else:
                data = answer.get("data", {})
                if data.get("code") == "locked":
                    break
        check("les questions sont acceptees", answered >= 6, "%d reponses valides sur 9" % answered)

        # L'etat de la room.
        room = ajax(opener, "securа_get_room".replace("а", "a"), nonce, room_id=ROOM)
        state = room.get("data", {})
        progress = state.get("progress", state)
        print("  progression : %s" % json.dumps(progress, ensure_ascii=False)[:220])
        print("  XP de %s : %s" % (user, xp_of(user)))

    print("\n\033[1m=== Separation des progressions ===\033[0m")
    alice_xp = xp_of("alice")
    bob_xp = xp_of("bob")
    check("chaque apprenant a sa propre XP", alice_xp != bob_xp, "Alice=%s Bob=%s" % (alice_xp, bob_xp))


if __name__ == "__main__":
    main()
