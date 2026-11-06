#!/bin/bash
# Applique toutes les traductions anglaises du dépôt à la base WordPress.
#
# Une seule source de vérité : les fichiers content/en/*.en.json, versionnés.
# La base n'est qu'une projection : on peut la reconstruire à tout moment.
#
# Usage : tools/traduction/appliquer-tout.sh [chemin-wordpress]
set -euo pipefail

DEPOT="$(cd "$(dirname "$0")/../.." && pwd)"
WP="${1:-/home/user/wp-sandbox/www}"
PHP="${PHP:-php}"

if ! command -v "$PHP" >/dev/null 2>&1; then
	PHP=/home/user/tools/native-php/php
fi

WP_CLI="${WP_CLI:-/home/user/tools/wp-cli.phar}"

total=0
for fichier in "$DEPOT"/content/en/*.en.json; do
	[ -e "$fichier" ] || continue
	PHPRC= "$PHP" "$WP_CLI" --path="$WP" --allow-root eval-file \
		"$DEPOT/tools/traduction/importer.php" "$fichier" || {
			echo "ÉCHEC : $fichier"
			exit 1
		}
	total=$((total + 1))
done

echo "$total fichier(s) appliqué(s)."
