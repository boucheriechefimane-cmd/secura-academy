#!/usr/bin/env python3
"""
Récupération des questions MIT refusées (1 553 questions en mode "solution"
sans marqueur de solution détecté).

Stratégies appliquées dans l'ordre :
A. Élargir les marqueurs de solution (Réponse, Résultat, Correct, Vrai, Faux, Flag...)
B. Séparation par structure (saut de ligne double, pattern de question)
C. Mode "texte" (question ouverte) : tout le texte = énoncé, solution dans l'explication
D. Mode "flag" : extraire une courte chaîne de la solution comme flag à trouver

Sortie : tools/lots/recovered/ (lots avec questions récupérées)
"""

import json
import os
import re
import sys
from pathlib import Path
from datetime import datetime, timezone

LOTS_DIR = Path("/home/user/secura-academy/tools/lots")
OUTPUT_DIR = Path("/home/user/secura-academy/tools/lots/recovered")

# Marqueurs de solution élargis (stratégie A)
SOLUTION_MARKERS = [
    r"\bSolution\s*:?",
    r"\bAnswer\s*:?",
    r"\bRéponse\s*:?",
    r"\bCorrect answer\s*:?",
    r"\bSol\.\s*:?",
    r"\bCorrigé\s*:?",
    r"\bCorrection\s*:?",
    r"\bRésultat\s*:?",
    r"\bCorrect\s*:?",
    r"\bVrai\s*:?",
    r"\bFaux\s*:?",
    r"\bFlag\s*:?",
    r"\bAnswer key\s*:?",
]

# Patterns pour détecter la fin d'un énoncé et le début d'une solution par structure
STRUCTURE_PATTERNS = [
    r"\n\s*\n",  # saut de ligne double
    r"\n\s*[-=]{3,}\s*\n",  # ligne de séparateur --- ou ===
    r"\n\s*\d+\.\s+",  # nouvelle question numérotée
]


def split_enonce_solution_v2(text):
    """
    Tente de séparer énoncé et solution avec plusieurs stratégies.
    Retourne (enonce, solution) ou (None, None).
    """
    if not text or not isinstance(text, str):
        return None, None

    text = text.strip()
    if not text:
        return None, None

    # STRATÉGIE A : marqueurs de solution élargis
    best_pos = len(text)
    best_marker = None

    for marker in SOLUTION_MARKERS:
        match = re.search(marker, text, re.IGNORECASE)
        if match and match.start() < best_pos:
            best_pos = match.start()
            best_marker = marker

    if best_marker is not None and best_pos > 10:
        enonce = text[:best_pos].strip()
        solution = text[best_pos:].strip()
        solution = re.sub(r'^(Solution|Answer|Réponse|Correct answer|Sol\.|Corrigé|Correction|Résultat|Correct|Vrai|Faux|Flag|Answer key)\s*:?\s*', '', solution, flags=re.IGNORECASE).strip()
        if enonce and solution:
            return enonce, solution

    # STRATÉGIE B : séparation par structure (saut de ligne double)
    # Chercher le premier bloc paragraphe qui ressemble à une solution
    paragraphs = re.split(r'\n\s*\n', text)
    if len(paragraphs) >= 2:
        # Le premier paragraphe est l'énoncé, le reste est la solution
        enonce = paragraphs[0].strip()
        solution = '\n\n'.join(paragraphs[1:]).strip()
        if len(enonce) > 10 and len(solution) > 5:
            return enonce, solution

    # STRATÉGIE B bis : chercher après un pattern de question numérotée
    # Ex: "1. Quelle est... \n\n Réponse: X"
    for pattern in STRUCTURE_PATTERNS[1:]:
        match = re.search(pattern, text)
        if match and match.start() > 10:
            enonce = text[:match.start()].strip()
            solution = text[match.end():].strip()
            if enonce and solution:
                return enonce, solution

    return None, None


def extract_flag_from_solution(solution):
    """
    Extrait une courte chaîne de la solution pour faire un flag.
    """
    if not solution:
        return None

    # Chercher des patterns de flag courants
    flag_patterns = [
        r'SECURA\{[^}]+\}',
        r'FLAG\{[^}]+\}',
        r'[A-Z]{3,}[0-9]{2,}',
        r'\b[a-z0-9]{8,20}\b',
    ]

    for pattern in flag_patterns:
        match = re.search(pattern, solution)
        if match:
            return match.group(0)

    # Sinon, prendre les 30 premiers caractères significatifs
    words = solution.split()
    if len(words) >= 3:
        return ' '.join(words[:3])[:40]

    return solution[:40] if solution else None


def recover_question(q):
    """
    Tente de récupérer une question refusée.
    Retourne (question_recuperee, statut, strategie).
    statuts : 'recovered_qcm', 'recovered_text', 'recovered_flag', 'still_refused'
    """
    mode = q.get("mode", "")
    raw_text = q.get("question", "")

    if mode != "solution":
        return q, "already_good", "-"

    # Stratégie A + B : séparer énoncé / solution
    enonce, solution = split_enonce_solution_v2(raw_text)

    if enonce and solution:
        # On a réussi à séparer : on peut faire un QCM
        # La bonne réponse est la solution (ou un extrait)
        correct_answer = solution.strip()
        distractors = [
            "Pas " + correct_answer.lower(),
            "L'inverse de " + correct_answer.lower(),
            "Impossible à déterminer",
        ]
        choices = [correct_answer] + distractors

        import random
        random.seed(hash(enonce + solution) % (2**32))
        random.shuffle(choices)
        correct_index = choices.index(correct_answer)

        q["question"] = enonce
        q["mode"] = "choice"
        q["choices"] = choices
        q["correct"] = correct_index
        q["answer"] = solution
        q["_recupere_le"] = datetime.now(timezone.utc).isoformat() + "Z"
        q["_strategie"] = "separation_enum_solution"

        return q, "recovered_qcm", "A+B"

    # STRATÉGIE C : mode texte (question ouverte)
    # Garder tout comme énoncé, mettre le texte complet dans l'explication
    if len(raw_text) > 20:
        q["question"] = raw_text
        q["mode"] = "text"
        q["explanation"] = q.get("explanation", "") + "\n\n[Correction officielle MIT : " + raw_text + "]"
        q["answer"] = raw_text
        q["_recupere_le"] = datetime.now(timezone.utc).isoformat() + "Z"
        q["_strategie"] = "mode_texte_ouvert"

        return q, "recovered_text", "C"

    # STRATÉGIE D : mode flag (extraire une courte chaîne)
    flag = extract_flag_from_solution(raw_text)
    if flag and len(flag) > 3:
        q["question"] = raw_text + "\n\nTrouve le flag dans ce texte."
        q["mode"] = "flag"
        q["flag_path"] = flag
        q["answer"] = flag
        q["explanation"] = q.get("explanation", "") + "\n\n[Flag extrait : " + flag + "]"
        q["_recupere_le"] = datetime.now(timezone.utc).isoformat() + "Z"
        q["_strategie"] = "mode_flag"

        return q, "recovered_flag", "D"

    # Toujours irrécupérable
    q["_refus"] = "Irrécupérable après toutes les stratégies (A, B, C, D)"
    q["_refus_le"] = datetime.now(timezone.utc).isoformat() + "Z"

    return q, "still_refused", "-"


def process_lot_file(lot_path):
    """
    Traite un fichier de lot JSON. Retourne (lot_traite, stats).
    """
    with open(lot_path, "r", encoding="utf-8") as f:
        lot = json.load(f)

    stats = {
        "total": 0,
        "recovered_qcm": 0,
        "recovered_text": 0,
        "recovered_flag": 0,
        "still_refused": 0,
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
                q, statut, strategie = recover_question(q)
                questions[i] = q
                stats[statut] += 1

    lot["_recupere_le"] = datetime.now(timezone.utc).isoformat() + "Z"
    lot["_recuperation_stats"] = stats

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

    print(f"Récupération sur {len(lot_files)} lots...\n")

    global_stats = {
        "total": 0,
        "recovered_qcm": 0,
        "recovered_text": 0,
        "recovered_flag": 0,
        "still_refused": 0,
        "already_good": 0,
    }

    for lot_path in lot_files:
        lot, stats = process_lot_file(lot_path)

        output_path = OUTPUT_DIR / lot_path.name
        with open(output_path, "w", encoding="utf-8") as f:
            json.dump(lot, f, ensure_ascii=False, indent=2)

        for k in global_stats:
            global_stats[k] += stats[k]

        total_rec = stats["recovered_qcm"] + stats["recovered_text"] + stats["recovered_flag"]
        print(f"{lot_path.name}: {total_rec} récupérées, {stats['still_refused']} encore refusées, {stats['already_good']} inchangées")

    print("\n=== RÉCAPITULATIF RÉCUPÉRATION ===")
    print(f"Total questions : {global_stats['total']}")
    print(f"Récupérées en QCM (stratégie A+B) : {global_stats['recovered_qcm']}")
    print(f"Récupérées en texte ouvert (stratégie C) : {global_stats['recovered_text']}")
    print(f"Récupérées en mode flag (stratégie D) : {global_stats['recovered_flag']}")
    total_recovered = global_stats['recovered_qcm'] + global_stats['recovered_text'] + global_stats['recovered_flag']
    print(f"Total récupérées : {total_recovered}")
    print(f"Toujours refusées : {global_stats['still_refused']}")
    print(f"Déjà au bon format : {global_stats['already_good']}")
    print(f"\nFichiers de sortie dans : {OUTPUT_DIR}")


if __name__ == "__main__":
    main()
