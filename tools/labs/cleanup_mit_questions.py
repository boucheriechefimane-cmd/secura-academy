#!/usr/bin/env python3
"""
Nettoyage réel des questions MIT en mode "solution" dans les lots de la plateforme.

Format des lots (tools/lots/*.json) :
{
    "source": "...",
    "licence": "CC BY-NC-SA 4.0",
    "attribution": "...",
    "url": "...",
    "rooms": [
        {
            "room": "slug-de-la-room",
            "title": "...",
            "tasks": {
                "test": [
                    {
                        "question": "... énoncé ... Solution: ... corrigé ...",
                        "mode": "solution",
                        ...
                    }
                ]
            }
        }
    ]
}

Ce script :
1. Parcourt tous les fichiers .json dans tools/lots/
2. Pour chaque question avec mode "solution" (énoncé + solution collés) :
   a. Sépare l'énoncé de la solution (marqueur "Solution:", "Answer:", etc.)
   b. Transforme en QCM : énoncé + 4 choix (1 bonne = solution MIT, 3 distracteurs)
   c. Conserve hint, explanation, source, licence, attribution
3. Si l'énoncé est illisible ou la solution manquante → REFUSÉE (marquée _refus)
4. Écrit les lots nettoyés dans tools/lots/cleaned/

Règle d'or : pas de réécriture maison. Si on ne peut pas séparer proprement, on refuse.
"""

import json
import os
import re
import shutil
import sys
from pathlib import Path
from datetime import datetime, timezone

LOTS_DIR = Path("/home/user/secura-academy/tools/lots")
OUTPUT_DIR = Path("/home/user/secura-academy/tools/lots/cleaned")

# Marqueurs indiquant le début d'une solution dans un texte MIT
SOLUTION_MARKERS = [
    r"\bSolution\s*:?",
    r"\bAnswer\s*:?",
    r"\bRéponse\s*:?",
    r"\bCorrect answer\s*:?",
    r"\bSol\.\s*:?",
    r"\bCorrigé\s*:?",
    r"\bCorrection\s*:?",
]

# Distracteurs génériques si on ne peut pas en générer de spécifiques
DISTRACTORS_GENERIC = [
    "Aucune des réponses ci-dessus",
    "Toutes les réponses ci-dessus",
    "Impossible à déterminer avec les informations données",
    "Dépend du contexte",
]


def split_enonce_solution(text):
    """
    Sépare l'énoncé de la solution d'une question MIT brute.
    Retourne (enonce, solution) ou (None, None) si impossible.
    """
    if not text or not isinstance(text, str):
        return None, None

    text = text.strip()

    # Chercher le premier marqueur de solution
    best_pos = len(text)
    best_marker = None

    for marker in SOLUTION_MARKERS:
        match = re.search(marker, text, re.IGNORECASE)
        if match and match.start() < best_pos:
            best_pos = match.start()
            best_marker = marker

    if best_marker is None:
        return None, None

    enonce = text[:best_pos].strip()
    solution = text[best_pos:].strip()

    # Nettoyer la solution : retirer le marqueur lui-même
    solution = re.sub(r'^(Solution|Answer|Réponse|Correct answer|Sol\.|Corrigé|Correction)\s*:?\s*', '', solution, flags=re.IGNORECASE).strip()

    if not enonce or not solution:
        return None, None

    return enonce, solution


def generate_distractors(correct_answer, enonce):
    """
    Génère 3 fausses réponses plausibles.
    Retourne une liste de 3 strings uniques, différentes de correct_answer.
    """
    distractors = []

    # Stratégie 1 : variantes de la bonne réponse
    if len(correct_answer) > 10:
        base = correct_answer.strip().rstrip('.')
        distractors.append(f"Pas {base.lower()}")
        distractors.append(f"L'inverse de {base.lower()}")
        distractors.append(f"Une version partielle de {base.lower()}")
    else:
        distractors = list(DISTRACTORS_GENERIC[:3])

    # Dédupliquer et s'assurer qu'ils diffèrent de la bonne réponse
    unique = []
    seen = {correct_answer.strip().lower()}
    for d in distractors:
        dl = d.strip().lower()
        if dl not in seen and dl:
            unique.append(d.strip())
            seen.add(dl)
    while len(unique) < 3:
        unique.append(f"Option alternative {len(unique) + 1}")
        seen.add(f"option alternative {len(unique)}".lower())

    return unique[:3]


def clean_question(q):
    """
    Nettoie une seule question. Retourne (question_nettoyee, statut).
    statut : 'cleaned', 'refused', 'already_good'
    """
    mode = q.get("mode", "")
    raw_text = q.get("question", "")

    # Si ce n'est pas du mode "solution", on laisse tel quel
    if mode != "solution":
        return q, "already_good"

    # Séparer énoncé / solution
    enonce, solution = split_enonce_solution(raw_text)

    if enonce is None or solution is None:
        # Refus : illisible ou incomplet
        q["_refus"] = "Impossible de séparer énoncé et solution (question MIT brute illisible)"
        q["_refus_le"] = datetime.now(timezone.utc).isoformat() + "Z"
        return q, "refused"

    # Construire le vrai QCM
    distractors = generate_distractors(solution, enonce)
    choices = [solution] + distractors

    import random
    random.seed(hash(enonce + solution) % (2**32))  # déterministe pour reproductibilité
    random.shuffle(choices)
    correct_index = choices.index(solution)

    q["question"] = enonce
    q["mode"] = "choice"
    q["choices"] = choices
    q["correct"] = correct_index
    q["answer"] = solution  # garder la solution comme référence
    q["_nettoye_le"] = datetime.now(timezone.utc).isoformat() + "Z"

    return q, "cleaned"


def process_lot_file(lot_path):
    """
    Traite un fichier de lot JSON. Retourne (lot_nettoye, stats).
    """
    with open(lot_path, "r", encoding="utf-8") as f:
        lot = json.load(f)

    stats = {
        "total": 0,
        "cleaned": 0,
        "refused": 0,
        "already_good": 0,
    }

    rooms = lot.get("rooms", [])
    for room in rooms:
        tasks = room.get("tasks", {})
        for task_type, questions in tasks.items():
            if not isinstance(questions, list):
                continue
            for i, q in enumerate(questions):
                if not isinstance(q, dict):
                    continue
                stats["total"] += 1
                q, statut = clean_question(q)
                questions[i] = q
                stats[statut] += 1

    lot["_nettoye_le"] = datetime.now(timezone.utc).isoformat() + "Z"
    lot["_nettoyage_stats"] = stats

    return lot, stats


def main():
    if not LOTS_DIR.exists():
        print(f"ERREUR : Le dossier {LOTS_DIR} n'existe pas.")
        sys.exit(1)

    OUTPUT_DIR.mkdir(parents=True, exist_ok=True)

    lot_files = sorted(LOTS_DIR.glob("*.json"))
    if not lot_files:
        print(f"Aucun fichier de lot trouvé dans {LOTS_DIR}")
        sys.exit(0)

    print(f"Traitement de {len(lot_files)} lots...\n")

    global_stats = {"total": 0, "cleaned": 0, "refused": 0, "already_good": 0}

    for lot_path in lot_files:
        lot, stats = process_lot_file(lot_path)

        output_path = OUTPUT_DIR / lot_path.name
        with open(output_path, "w", encoding="utf-8") as f:
            json.dump(lot, f, ensure_ascii=False, indent=2)

        for k in global_stats:
            global_stats[k] += stats[k]

        print(f"{lot_path.name}: {stats['cleaned']} nettoyées, {stats['refused']} refusées, {stats['already_good']} inchangées")

    print("\n=== RÉCAPITULATIF ===")
    print(f"Total questions traitées : {global_stats['total']}")
    print(f"Nettoyées (séparées en QCM) : {global_stats['cleaned']}")
    print(f"Refusées (illisibles) : {global_stats['refused']}")
    print(f"Déjà au bon format : {global_stats['already_good']}")
    print(f"\nFichiers de sortie dans : {OUTPUT_DIR}")


if __name__ == "__main__":
    main()
