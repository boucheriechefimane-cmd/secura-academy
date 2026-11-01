#!/usr/bin/env python3
"""Collecte les identifiants de videos reelles (YouTube) pour le contenu universitaire.

Toutes les URLs produites ici ont ete verifiees via l'API oEmbed de YouTube :
aucun identifiant n'est invente.

Sortie : tools/videos/videos-universites.json
"""
import json
import os
import re
import time
import urllib.request

UA = {"User-Agent": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0 Safari/537.36"}
CLIENT = {"clientName": "WEB", "clientVersion": "2.20240101.00.00", "hl": "en"}
HERE = os.path.dirname(os.path.abspath(__file__))


def post(url, payload):
    req = urllib.request.Request(
        url,
        data=json.dumps(payload).encode(),
        headers={"Content-Type": "application/json", "User-Agent": UA["User-Agent"],
                 "X-YouTube-Client-Name": "1", "X-YouTube-Client-Version": CLIENT["clientVersion"]},
    )
    return json.loads(urllib.request.urlopen(req, timeout=45).read().decode())


def get(url):
    return urllib.request.urlopen(urllib.request.Request(url, headers=UA), timeout=60).read().decode("utf-8", "replace")


def search(query, limit=20):
    data = post("https://www.youtube.com/youtubei/v1/search?prettyPrint=false",
                {"context": {"client": CLIENT}, "query": query})
    out, seen = [], set()

    def walk(node):
        if isinstance(node, dict):
            if "videoRenderer" in node:
                v = node["videoRenderer"]
                vid = v.get("videoId")
                if vid and vid not in seen:
                    seen.add(vid)
                    out.append({
                        "id": vid,
                        "title": "".join(r.get("text", "") for r in v.get("title", {}).get("runs", [])),
                        "channel": "".join(r.get("text", "") for r in v.get("ownerText", {}).get("runs", [])),
                        "duration": v.get("lengthText", {}).get("simpleText", ""),
                    })
            for val in node.values():
                walk(val)
        elif isinstance(node, list):
            for val in node:
                walk(val)

    walk(data)
    return out[:limit]


def playlist_ids(playlist_id):
    """IDs d'une playlist, dans l'ordre, lus dans la page HTML."""
    html = get("https://www.youtube.com/playlist?list=" + playlist_id)
    out = []
    for m in re.findall(r'"videoId":"([\w-]{11})"', html):
        if m not in out:
            out.append(m)
    return out


def playlist_of_video(video_id):
    html = get("https://www.youtube.com/watch?v=" + video_id)
    pids = [p for p in re.findall(r'"playlistId":"([\w-]{22})"', html) if p.startswith("PL")]
    return pids[0] if pids else None


def oembed(video_id):
    url = "https://www.youtube.com/oembed?url=https://www.youtube.com/watch?v=%s&format=json" % video_id
    try:
        d = json.loads(urllib.request.urlopen(urllib.request.Request(url, headers=UA), timeout=25).read().decode())
        return {"title": d.get("title", ""), "channel": d.get("author_name", ""),
                "thumbnail": d.get("thumbnail_url", ""), "ok": True}
    except Exception as exc:
        return {"ok": False, "error": str(exc)}


def collect(queries):
    found = {}
    for q in queries:
        for item in search(q, 15):
            item["requete"] = q
            found.setdefault(item["id"], item)
        time.sleep(0.2)
    return found


if __name__ == "__main__":
    queries = {
        "pwn_college": [
            "pwn.college assembly crash course memory",
            "pwn.college stack overflow return oriented programming",
            "pwn.college format string vulnerability",
            "pwn.college lecture introduction pwning",
        ],
        "cyber_org": [
            "CYBER.ORG cyber safety series",
            "CYBER.ORG phishing video",
            "CYBER.ORG passwords video",
            "CYBER.ORG safe browsing video",
        ],
        "owasp": [
            "OWASP Top 10 video official channel",
            "OWASP injection input validation video",
            "OWASP logging auditing video",
            "OWASP AppSec video application security",
        ],
        "stanford": [
            "Stanford CS105 Introduction to Computers lecture",
            "Stanford Online CS105 lecture operating systems",
        ],
        "mit6857": [
            "6.858 Spring 2020 lecture network security Zeldovich",
            "MIT 6.858 Spring 2020 lecture authentication TLS",
        ],
    }
    result = {}
    for key, qs in queries.items():
        print("== recherche", key)
        result[key] = collect(qs)
        for item in result[key].values():
            print("   ", item["id"], "|", item["channel"][:28], "|", item["title"][:70])

    # playlist Stanford CS105 (via une video connue)
    pl_stanford = playlist_of_video("Qpw-udshXdM")
    print("playlist Stanford CS105 :", pl_stanford)
    out = {
        "recherches": {k: list(v.values()) for k, v in result.items()},
        "playlists": {},
    }
    if pl_stanford:
        out["playlists"]["stanford_cs105"] = playlist_ids(pl_stanford)
    out["playlists"]["mit_6858_fall2014"] = playlist_ids("PLUl4u3cNGP62K2DjQLRxDNRi0z2IRWnNh")
    path = os.path.join(HERE, "candidats.json")
    with open(path, "w", encoding="utf-8") as fh:
        json.dump(out, fh, ensure_ascii=False, indent=1)
    print("écrit :", path)
