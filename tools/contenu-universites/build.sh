#!/usr/bin/env bash
#
# Reconstruit le contenu des rooms universitaires.
#
# Deux étapes, dans cet ordre :
#   1. build.py génère le fichier PHP à partir des sources (rooms_*.py) ;
#   2. parametre-questions.py ajoute les variantes numériques (les {mots}),
#      que le moteur d'épreuves remplace à chaque copie d'examen.
#
# L'ordre compte : sans l'étape 2, les questions paramétriques perdent leurs
# variantes (et donc les chiffres changent plus d'une copie à l'autre).
#
# GARDE-FOU
# Certaines traductions (arabe, anglais) ont été corrigées à la main dans
# le fichier livré. Si la régénération les perd, le script s'en aperçoit
# (il compte les caractères arabes avant et après) et restaure la version
# livrée : mieux vaut un avertissement qu'une traduction perdue.
#
# Usage : bash tools/contenu-universites/build.sh

set -e

cd "$(dirname "$0")/../.."

FICHIER="wp-content/plugins/secura-academy/includes/content-universites.php"
SAUVEGARDE="$(mktemp)"

cp "$FICHIER" "$SAUVEGARDE"

arabes_avant=$(grep -o '[ء-ي]' "$SAUVEGARDE" | wc -l)

echo "1. Génération du contenu…"
python3 tools/contenu-universites/build.py

echo "2. Ajout des questions paramétriques…"
# Le script sort en 1 quand il n'y a rien à changer : ce n'est pas une erreur.
python3 tools/parametre-questions.py || echo "   (variantes déjà présentes)"

echo "3. Vérification de la syntaxe PHP…"
php -l "$FICHIER"

arabes_apres=$(grep -o '[ء-ي]' "$FICHIER" | wc -l)

if [ "$arabes_avant" -gt 0 ] && [ "$arabes_apres" -lt $(( arabes_avant * 9 / 10 )) ]; then
	echo ""
	echo "ATTENTION : la régénération a perdu des traductions arabes"
	echo "  avant : $arabes_avant caractères arabes"
	echo "  après : $arabes_apres caractères arabes"
	echo "→ version livrée restaurée ; corrige les sources (tools/contenu-universites/rooms_*.py) puis relance."
	cp "$SAUVEGARDE" "$FICHIER"
	rm -f "$SAUVEGARDE"
	exit 1
fi

rm -f "$SAUVEGARDE"

echo ""
echo "Contenu régénéré (arabe : $arabes_avant → $arabes_apres caractères)."
echo "Relis le diff : git diff wp-content/plugins/secura-academy/includes/content-universites.php"
