#!/usr/bin/env bash
#
# Sonde OpenLearn (The Open University).
#
# Pourquoi : c'est la seule banque de questions qu'on ait trouvée sous une
# licence QUI AUTORISE UN USAGE COMMERCIAL (CC BY-SA 4.0), avec des quiz
# d'informatique et de cybersécurité. MIT OCW est excellent mais « NC »
# (non commercial) ; PortSwigger et MIT 6.1600 sont interdits.
#
# Ce que fait cette sonde, et rien de plus :
#   1. elle essaie d'atteindre la page du cours ;
#   2. elle regarde si les questions des quiz sont dans le HTML rendu ;
#   3. elle rend un verdict lisible (fichier de sortie + résumé).
#
# Elle ne télécharge rien d'utile et ne modifie rien : c'est un outil de
# veille, à lancer manuellement ou dans une CI.
#
# Usage : bash tools/probe-openlearn.sh [sortie.txt]

set -uo pipefail

SORTIE="${1:-/tmp/openlearn-sonde.txt}"
: > "$SORTIE"

URLS=(
  "https://www.open.ac.uk/openlearn/computing-it"
  "https://www.open.ac.uk/openlearn/science-mathematics-technology/cybersecurity"
  "https://www.open.ac.uk/openlearn/mathematics-statistics"
)

echo "=== Sonde OpenLearn — $(date -u '+%Y-%m-%d %H:%M:%S') UTC ===" | tee -a "$SORTIE"

for url in "${URLS[@]}"; do
  echo "" | tee -a "$SORTIE"
  echo "--- $url" | tee -a "$SORTIE"

  code=$(curl -sL -o /tmp/ol-page.html -w '%{http_code}' \
      --max-time 40 \
      -A 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0 Safari/537.36' \
      "$url")

  taille=$(wc -c < /tmp/ol-page.html)
  echo "réponse HTTP : $code — taille : $taille octets" | tee -a "$SORTIE"

  if [ "$code" != "200" ]; then
    echo "VERDICT : page inaccessible (protection anti-robot probable) — rien de récupérable." | tee -a "$SORTIE"
    continue
  fi

  # Un quiz Moodle en ligne laisse-t-il des traces dans le HTML ?
  quiz=$(grep -ci 'quiz' /tmp/ol-page.html || true)
  questions=$(grep -ciE 'question[ _-]?(1|one|txt|id)|multiple choice|single answer|choisir une réponse' /tmp/ol-page.html || true)

  echo "occurrences de « quiz » : $quiz — traces de questions : $questions" | tee -a "$SORTIE"

  if [ "$questions" -gt 0 ]; then
    echo "VERDICT : des questions semblent présentes dans le HTML — l'import serait possible." | tee -a "$SORTIE"
    grep -oE 'https://[^"'"'"' ]*openlearn[^"'"'"' ]*' /tmp/ol-page.html | sort -u | head -20 >> "$SORTIE"
  else
    echo "VERDICT : le HTML ne contient pas les questions (le quiz est rendu par Moodle, hors HTML)." | tee -a "$SORTIE"
  fi
done

echo "" | tee -a "$SORTIE"
echo "Rapport complet : $SORTIE" | tee -a "$SORTIE"
