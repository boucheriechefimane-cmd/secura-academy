#!/usr/bin/env python3
"""Recherche et verification de videos YouTube (identifiants reels, jamais inventes).

Usage :
    python3 yt_lookup.py search "requete" [max]
    python3 yt_lookup.py playlist PLAYLIST_ID [max]
    python3 yt_lookup.py verify VIDEO_ID [VIDEO_ID ...]
    python3 yt_lookup.py infos URL_VIDEO

Sources :
  - YouTube INNERTUBE (recherche + lecture de playlist)
  - YouTube oEmbed (verification d'existence + titre/auteur)

Licence : utilitaire interne du projet Secura Academy (MIT).
"""
import json
import re
import sys
import time
import urllib.error
import urllib.request

UA = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0 Safari/537.36"
CLIENT = {"clientName": "WEB", "clientVersion": "2.20240101.00.00", "hl": "en"}


def _post(url, payload):
    req = urllib.request.Request(
        url,
        data=json.dumps(payload).encode(),
        headers={
            "Content-Type": "application/json",
            "User-Agent": UA,
            "X-YouTube-Client-Name": "1",
            "X-YouTube-Client-Version": CLIENT["clientVersion"],
        },
    )
    return json.loads(urllib.request.urlopen(req, timeout=45).read().decode())


def search(query, limit=20):
    data = _post(
        "https://www.youtube.com/youtubei/v1/search?prettyPrint=false",
        {"context": {"client": CLIENT}, "query": query},
    )
    out, seen = [], set()

    def walk(node):
        if isinstance(node, dict):
            if "videoRenderer" in node:
                v = node["videoRenderer"]
                vid = v.get("videoId")
                if vid and vid not in seen:
                    seen.add(vid)
                    title = "".join(r.get("text", "") for r in v.get("title", {}).get("runs", []))
                    owner = "".join(r.get("text", "") for r in v.get("ownerText", {}).get("runs", []))
                    length = v.get("lengthText", {}).get("simpleText", "")
                    out.append({"id": vid, "title": title, "channel": owner, "duration": length})
            for val in node.values():
                walk(val)
        elif isinstance(node, list):
            for val in node:
                walk(val)

    walk(data)
    return out[:limit]


def playlist(playlist_id, limit=60):
    """Liste les videos d'une playlist (ID + titre + position)."""
    out, seen = [], set()

    def walk(node):
        if isinstance(node, dict):
            if "playlistVideoRenderer" in node:
                v = node["playlistVideoRenderer"]
                vid = v.get("videoId")
                if vid and vid not in seen:
                    seen.add(vid)
                    title = "".join(r.get("text", "") for r in v.get("title", {}).get("runs", []))
                    out.append({"id": vid, "title": title, "position": v.get("index", {}).get("simpleText", "")})
            for val in node.values():
                walk(val)
        elif isinstance(node, list):
            for val in node:
                walk(val)

    continuation = None
    for _ in range(6):
        payload = {
            "context": {"client": CLIENT},
            "browseId": "VL" + playlist_id,
        }
        if continuation:
            payload["continuation"] = continuation
        data = _post("https://www.youtube.com/youtubei/v1/browse?prettyPrint=false", payload)
        walk(data)
        if len(out) >= limit:
            break
        token = None
        for cont in data.get("contents", {}).get("twoColumnBrowseResultsRenderer", {}).get(
            "tabs", []
        ):
            for runner in cont.get("tabRenderer", {}).get("content", {}).get(
                "sectionListRenderer", {}
            ).get("contents", []):
                for item in runner.get("itemSectionRenderer", {}).get("contents", []):
                    for cont2 in item.get("playlistVideoListRenderer", {}).get("contents", []):
                        token = cont2.get("continuationItemRenderer", {}).get(
                            "continuationEndpoint", {}
                        ).get("continuationCommand", {}).get("token")
        if not token:
            break
        continuation = token
        time.sleep(0.2)
    return out[:limit]


def verify(video_id):
    """Verifie que la video existe et renvoie titre + auteur + miniature."""
    url = (
        "https://www.youtube.com/oembed?url=https://www.youtube.com/watch?v="
        + video_id
        + "&format=json"
    )
    req = urllib.request.Request(url, headers={"User-Agent": UA})
    try:
        data = json.loads(urllib.request.urlopen(req, timeout=25).read().decode())
        return {
            "id": video_id,
            "title": data.get("title", ""),
            "channel": data.get("author_name", ""),
            "thumbnail": data.get("thumbnail_url", ""),
            "ok": True,
        }
    except urllib.error.HTTPError as exc:
        return {"id": video_id, "ok": False, "error": "HTTP %s" % exc.code}
    except Exception as exc:  # pragma: no cover
        return {"id": video_id, "ok": False, "error": str(exc)}


def main():
    if len(sys.argv) < 3:
        print(__doc__)
        return 1
    cmd = sys.argv[1]
    args = sys.argv[2:]
    if cmd == "search":
        query = args[0]
        limit = int(args[1]) if len(args) > 1 else 20
        for item in search(query, limit):
            print("%s | %s | %s | %s" % (item["id"], item["title"][:90], item["channel"][:40], item["duration"]))
    elif cmd == "playlist":
        limit = int(args[1]) if len(args) > 2 else 60
        for item in playlist(args[0], limit):
            print("%s | %s %s" % (item["id"], item["position"], item["title"][:90]))
    elif cmd == "verify":
        for vid in args:
            info = verify(vid)
            if info["ok"]:
                print("%s OK | %s | %s" % (vid, info["title"][:95], info["channel"][:40]))
            else:
                print("%s KO | %s" % (vid, info.get("error")))
    elif cmd == "infos":
        for vid in args:
            print(json.dumps(verify(vid), ensure_ascii=False))
    else:
        print(__doc__)
        return 1
    return 0


if __name__ == "__main__":
    sys.exit(main())
