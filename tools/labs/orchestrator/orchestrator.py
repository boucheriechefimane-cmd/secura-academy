#!/usr/bin/env python3
"""
Orchestrateur de labs Docker pour Secura Academy.

Lance un conteneur Docker isolé par élève quand il clique sur "Démarrer le lab",
et le détruit quand il termine. Chaque élève a son propre environnement jetable.

Compatible avec :
- Un vrai Docker Engine (production VPS)
- L'emulateur Docker CLI (sandbox / tests)

Usage :
    python3 tools/labs/orchestrator/orchestrator.py start <lab_id> <student_id>
    python3 tools/labs/orchestrator/orchestrator.py stop <container_id>
    python3 tools/labs/orchestrator/orchestrator.py list
    python3 tools/labs/orchestrator/orchestrator.py cleanup
    python3 tools/labs/orchestrator/orchestrator.py status
"""

import argparse
import json
import os
import subprocess
import sys
import uuid
from datetime import datetime, timezone

# ============================================================
# CONFIGURATION
# ============================================================

CONFIG = {
    "network_name": "secura-labs-net",
    "max_lab_minutes": 60,
    "default_image": "bkimminich/juice-shop",
    "base_port": 3000,
    "labs_dir": os.path.join(os.path.dirname(__file__), "..", "images"),
    # Binaire docker (peut etre l'emulateur en sandbox, vrai docker en prod)
    "docker_bin": os.environ.get("SECURA_DOCKER_BIN", "docker"),
}

# ============================================================
# HELPERS DOCKER CLI
# ============================================================

def docker_cmd(*args, input_text=None):
    """Execute une commande docker et retourne (code_retour, stdout, stderr)."""
    cmd = [CONFIG["docker_bin"]] + list(args)
    try:
        result = subprocess.run(
            cmd,
            input=input_text,
            capture_output=True,
            text=True,
            timeout=60,
        )
        return result.returncode, result.stdout.strip(), result.stderr.strip()
    except FileNotFoundError:
        print(f"ERREUR : binaire '{CONFIG['docker_bin']}' introuvable.")
        print("Installez Docker ou definissez SECURA_DOCKER_BIN vers l'emulateur.")
        sys.exit(1)
    except subprocess.TimeoutExpired:
        print("ERREUR : commande docker timeout.")
        sys.exit(1)


def docker_inspect_json(name_or_id):
    """Execute docker inspect sans --format et retourne le JSON complet parse."""
    rc, out, err = docker_cmd("inspect", name_or_id)
    if rc != 0:
        return None, err
    if not out:
        return None, ""
    try:
        data = json.loads(out)
        if isinstance(data, list) and len(data) > 0:
            return data[0], None
        return data, None
    except json.JSONDecodeError:
        return None, "Impossible de parser l'inspect"


def ensure_network():
    """Cree le reseau Docker isole pour les labs s'il n'existe pas."""
    rc, out, err = docker_cmd("network", "ls", "--filter", f"name={CONFIG['network_name']}", "--format", "{{.Name}}")
    if rc != 0:
        print(f"ERREUR reseau : {err}")
        sys.exit(1)
    if CONFIG["network_name"] not in out.splitlines():
        rc, out, err = docker_cmd("network", "create", "--driver", "bridge", CONFIG["network_name"])
        if rc != 0:
            print(f"ERREUR creation reseau : {err}")
            sys.exit(1)
        print(f"Reseau '{CONFIG['network_name']}' cree.")


# ============================================================
# CATALOGUE DES LABS
# ============================================================

LAB_IMAGES = {
    # --- Red Team (attaque) ---
    "owasp-juice-shop": {
        "image": "bkimminich/juice-shop",
        "port": 3000,
        "type": "red",
        "vulnerability": "OWASP Top 10 - Injection SQL, XSS, Broken Access Control",
        "description": "Site web vulnerable intentionnel pour s'entrainer a l'exploitation.",
    },
    "dvwa": {
        "image": "vulnerables/web-dvwa",
        "port": 80,
        "type": "red",
        "vulnerability": "OWASP Top 10 - 19 vulnerabilites web",
        "description": "Damn Vulnerable Web Application pour tests d'intrusion web.",
    },
    "metasploitable": {
        "image": "pianoid/metasploitable",
        "port": 22,
        "type": "red",
        "vulnerability": "MITRE ATT&CK - Exploitation de services, escalade de privileges",
        "description": "Machine vulnerable pour tests d'intrusion reseau.",
    },
    # --- Blue Team (defense) ---
    "blue-log-analysis": {
        "image": "ubuntu:22.04",
        "port": None,
        "type": "blue",
        "vulnerability": "MITRE ATT&CK T1003 - Detection de vol de credentials dans les logs",
        "description": "L'eleve analyse des logs systeme pour detecter une intrusion.",
    },
    "blue-firewall": {
        "image": "ubuntu:22.04",
        "port": None,
        "type": "blue",
        "vulnerability": "NIST SP 800-41 - Configuration de pare-feu et blocage de ports",
        "description": "L'eleve configure des regles iptables pour bloquer une attaque simulee.",
    },
}

# ============================================================
# PORT LIBRE
# ============================================================

def find_free_port(start_port):
    import socket
    port = start_port
    while port < 65535:
        with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
            try:
                s.bind(("0.0.0.0", port))
                return port
            except OSError:
                port += 1
    raise RuntimeError("Aucun port libre disponible.")


# ============================================================
# ACTIONS PRINCIPALES
# ============================================================

def start_lab(lab_key, student_id):
    """Lance un conteneur Docker isole pour un eleve sur un lab donne."""
    ensure_network()

    if lab_key not in LAB_IMAGES:
        print(f"ERREUR : Lab '{lab_key}' inconnu. Labs disponibles : {list(LAB_IMAGES.keys())}")
        sys.exit(1)

    lab = LAB_IMAGES[lab_key]
    container_name = f"secura-lab-{lab_key}-{student_id}-{uuid.uuid4().hex[:8]}"

    started_at = datetime.now(timezone.utc).isoformat()

    # Construire la commande docker run
    run_args = [
        "run",
        "--name", container_name,
        "--network", CONFIG["network_name"],
        "--detach",
        "--label", f"secura.lab=true",
        "--label", f"secura.lab.key={lab_key}",
        "--label", f"secura.student.id={student_id}",
        "--label", f"secura.started.at={started_at}",
        "--env", f"STUDENT_ID={student_id}",
        "--env", f"LAB_KEY={lab_key}",
        "--env", f"STARTED_AT={started_at}",
    ]

    host_port = None
    if lab["port"]:
        host_port = find_free_port(CONFIG["base_port"])
        run_args += ["-p", f"{host_port}:{lab['port']}"]

    run_args.append(lab["image"])

    # Si le lab a une commande par defaut, on la laisse (l'image en a une)
    rc, out, err = docker_cmd(*run_args)
    if rc != 0:
        print(f"ERREUR lancement lab : {err}")
        sys.exit(1)

    container_id = out.splitlines()[0] if out else ""

    print(json.dumps({
        "status": "started",
        "container_id": container_id[:12] if container_id else "",
        "container_name": container_name,
        "lab_key": lab_key,
        "lab_type": lab["type"],
        "student_id": student_id,
        "host_port": host_port,
        "container_port": lab["port"],
        "network": CONFIG["network_name"],
        "message": f"Lab '{lab_key}' demarre pour l'etudiant {student_id}",
    }, indent=2, ensure_ascii=False))


def stop_lab(container_id_or_name):
    """Arrete et supprime un conteneur de lab (par nom ou ID complet)."""
    # L'emulateur Docker ne supporte rm -f qu'avec le nom du conteneur.
    # En production (vrai Docker), l'ID fonctionne aussi.
    rc, out, err = docker_cmd("rm", "-f", container_id_or_name)
    if rc != 0:
        print(f"ERREUR arret : {err}")
        sys.exit(1)
    print(json.dumps({
        "status": "stopped",
        "container": container_id_or_name,
        "message": "Conteneur arrete et supprime.",
    }, indent=2, ensure_ascii=False))


def list_labs():
    """Liste tous les labs Secura en cours."""
    rc, out, err = docker_cmd("ps", "-a", "--format", "{{.ID}}|{{.Names}}")
    if rc != 0:
        print(f"ERREUR list : {err}")
        sys.exit(1)

    now = datetime.now(timezone.utc)
    result = []

    for line in out.splitlines():
        if not line.strip():
            continue
        parts = line.split("|")
        if len(parts) < 2:
            continue
        full_cid, name = parts[0], parts[1]
        short_cid = full_cid[:12]

        # Inspect complet (JSON) pour recupere labels et statut
        inspect_data, err = docker_inspect_json(name)
        if inspect_data is None:
            continue

        config = inspect_data.get("Config", {})
        state = inspect_data.get("State", {})
        labels = config.get("Labels", {})

        if labels.get("secura.lab") != "true":
            continue

        lab_key = labels.get("secura.lab.key", "")
        student_id = labels.get("secura.student.id", "")
        started_at = labels.get("secura.started.at", "")
        status = state.get("Status", "")

        if not lab_key:
            continue

        # Calculer l'age
        age_minutes = -1
        if started_at:
            try:
                started_dt = datetime.fromisoformat(started_at)
                age_minutes = int((now - started_dt).total_seconds() / 60)
            except Exception:
                age_minutes = -1

        lab_info = LAB_IMAGES.get(lab_key, {})
        result.append({
            "container_id": short_cid,
            "name": name,
            "status": status,
            "lab_key": lab_key,
            "lab_type": lab_info.get("type", "?"),
            "student_id": student_id,
            "age_minutes": age_minutes,
        })

    print(json.dumps(result, indent=2, ensure_ascii=False))


def cleanup_old_labs():
    """Detruit les labs dont la duree depasse la limite configuree."""
    ensure_network()
    rc, out, err = docker_cmd("ps", "-a", "--format", "{{.ID}}|{{.Names}}")
    if rc != 0:
        print(f"ERREUR cleanup : {err}")
        sys.exit(1)

    now = datetime.now(timezone.utc)
    cleaned = []

    for line in out.splitlines():
        if not line.strip():
            continue
        parts = line.split("|")
        if len(parts) < 2:
            continue
        full_cid, name = parts[0], parts[1]
        short_cid = full_cid[:12]

        inspect_data, err = docker_inspect_json(name)
        if inspect_data is None:
            continue

        labels = inspect_data.get("Config", {}).get("Labels", {})
        if labels.get("secura.lab") != "true":
            continue

        started_at = labels.get("secura.started.at", "")
        student_id = labels.get("secura.student.id", "")

        age_minutes = CONFIG["max_lab_minutes"] + 1
        if started_at:
            try:
                started_dt = datetime.fromisoformat(started_at)
                age_minutes = int((now - started_dt).total_seconds() / 60)
            except Exception:
                pass

        if age_minutes > CONFIG["max_lab_minutes"]:
            rc3, _, err3 = docker_cmd("rm", "-f", full_cid)
            if rc3 == 0:
                cleaned.append({
                    "container_id": short_cid,
                    "name": name,
                    "student_id": student_id,
                    "age_minutes": age_minutes,
                })
            else:
                print(f"WARNING : impossible de supprimer {short_cid} : {err3}")

    print(json.dumps({
        "status": "cleanup_done",
        "cleaned_count": len(cleaned),
        "cleaned": cleaned,
    }, indent=2, ensure_ascii=False))


def status():
    """Statut de Docker et du reseau."""
    rc, out, err = docker_cmd("info", "--format", "{{.ServerVersion}}")
    server_version = out if rc == 0 else "inconnu"

    rc2, out2, _ = docker_cmd("network", "ls", "--filter", f"name={CONFIG['network_name']}", "--format", "{{.Name}}")
    network_exists = CONFIG["network_name"] in out2.splitlines()

    print(json.dumps({
        "docker": "ok",
        "server_version": server_version,
        "docker_bin": CONFIG["docker_bin"],
        "network": CONFIG["network_name"],
        "network_exists": network_exists,
        "max_lab_minutes": CONFIG["max_lab_minutes"],
        "available_labs": list(LAB_IMAGES.keys()),
    }, indent=2, ensure_ascii=False))


# ============================================================
# CLI
# ============================================================

def main():
    parser = argparse.ArgumentParser(description="Orchestrateur de labs Docker Secura Academy")
    sub = parser.add_subparsers(dest="command", required=True)

    p_start = sub.add_parser("start", help="Demarrer un lab pour un etudiant")
    p_start.add_argument("lab", help="Cle du lab (ex: owasp-juice-shop)")
    p_start.add_argument("student", help="Identifiant de l'etudiant")

    p_stop = sub.add_parser("stop", help="Arreter et supprimer un lab")
    p_stop.add_argument("container", help="ID ou nom du conteneur")

    sub.add_parser("list", help="Lister les labs en cours")
    sub.add_parser("cleanup", help="Nettoyer les labs expires")
    sub.add_parser("status", help="Statut de Docker et du reseau")

    args = parser.parse_args()

    if args.command == "start":
        start_lab(args.lab, args.student)
    elif args.command == "stop":
        stop_lab(args.container)
    elif args.command == "list":
        list_labs()
    elif args.command == "cleanup":
        cleanup_old_labs()
    elif args.command == "status":
        status()


if __name__ == "__main__":
    main()
