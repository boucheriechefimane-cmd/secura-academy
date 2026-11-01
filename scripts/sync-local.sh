#!/usr/bin/env bash
#
# Recopie le plugin et le thème du dépôt dans le WordPress local de test.
#
# À lancer après chaque modification du plugin ou du thème, avant de
# rejouer une recette ou un scénario local :
#
#   bash scripts/sync-local.sh              # WordPress dans /home/user/wp
#   bash scripts/sync-local.sh /tmp/wp-test # ailleurs
#
# Le dépôt GitHub reste la référence : ce bac à sable n'est qu'un moyen
# de vérifier le plugin dans un vrai WordPress.

set -euo pipefail

REPO_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )/.." && pwd )"
WP_DIR="${1:-/home/user/wp}"
WP_CLI="${SECA_WP_CLI:-/home/user/wp-cli.phar}"

if [ ! -d "$WP_DIR/wp-content/plugins" ]; then
	echo "WordPress n'existe pas encore dans $WP_DIR." >&2
	echo "Lancez d'abord : bash scripts/wordpress-local.sh $WP_DIR" >&2
	exit 1
fi

rm -rf "$WP_DIR/wp-content/plugins/secura-academy" "$WP_DIR/wp-content/themes/secura-learning"
cp -r "$REPO_DIR/wp-content/plugins/secura-academy" "$WP_DIR/wp-content/plugins/secura-academy"
cp -r "$REPO_DIR/wp-content/themes/secura-learning" "$WP_DIR/wp-content/themes/secura-learning"

if [ -f "$WP_CLI" ]; then
	php "$WP_CLI" --path="$WP_DIR" --allow-root option update active_plugins --format=json \
		'["secura-academy/secura-academy.php","akismet/akismet.php"]' >/dev/null
fi

echo "Plugin et thème recopiés dans $WP_DIR"
