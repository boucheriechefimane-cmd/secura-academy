#!/usr/bin/env bash
#
# Installe un WordPress complet pour la CI (et pour une recette locale).
#
# Ce script fait la même chose que « wordpress-local.sh », mais avec les
# options utiles à un environnement de test automatique :
#   - le journal des erreurs PHP est activé (WP_DEBUG_LOG) : c'est ce qui
#     permet de détecter qu'un plugin tiers casse notre plugin ;
#   - des plugins tiers peuvent être ajoutés à la suite, pour vérifier
#     qu'ils « marchent » sur le site (LiteSpeed Cache, Polylang, etc.) ;
#   - les identifiants des apprenants de test sont fixes.
#
# Utilisation :
#   bash scripts/ci-wordpress.sh                       # sans plugin tiers
#   bash scripts/ci-wordpress.sh polylang litespeed-cache   # avec des plugins
#
# Variables d'environnement reconnues :
#   SECA_WP_DIR      dossier WordPress        (défaut : /home/user/wp-ci)
#   SECA_LABS_PATH   dossier des machines     (défaut : <dépôt>/labs)
#   SECA_WP_URL      adresse du site          (défaut : http://localhost:8080)

set -euo pipefail

REPO_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )/.." && pwd )"
WP_DIR="${SECA_WP_DIR:-/home/user/wp-ci}"
WP_URL="${SECA_WP_URL:-http://localhost:8080}"
LABS_PATH="${SECA_LABS_PATH:-$REPO_DIR/labs}"
# WP-CLI : celui du systeme s'il existe (CI), sinon le phar local.
if [ -n "${SECA_WP_CLI:-}" ]; then
	WP_CLI="$SECA_WP_CLI"
elif command -v wp >/dev/null 2>&1; then
	WP_CLI="system"
else
	WP_CLI="/home/user/wp-cli.phar"
fi

DB_NAME="${SECA_DB_NAME:-seca_wp}"
DB_USER="${SECA_DB_USER:-secura}"
DB_PASSWORD="${SECA_DB_PASSWORD:-seca_ci_pw}"
DB_HOST="${SECA_DB_HOST:-127.0.0.1}"
DB_PORT="${SECA_DB_PORT:-3306}"

WP_ADMIN_USER="admin"
WP_ADMIN_PASSWORD="admin_ci_pw"
WP_ADMIN_EMAIL="admin@secura-academy.local"

PLUGINS_TIERS=( "$@" )

say() { printf '\n\033[1;34m== %s\033[0m\n' "$1"; }

wp() {
	if [ "$WP_CLI" = "system" ]; then
		wp --path="$WP_DIR" --allow-root "$@"
	else
		php "$WP_CLI" --path="$WP_DIR" --allow-root "$@"
	fi
}

say "1. WP-CLI"

if [ "$WP_CLI" != "system" ] && [ ! -f "$WP_CLI" ]; then
	curl -sSL -o "$WP_CLI" https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
	chmod +x "$WP_CLI"
fi

say "2. WordPress"

mkdir -p "$WP_DIR"

if [ ! -f "$WP_DIR/wp-settings.php" ]; then
	wp core download --locale=fr_FR
fi

if [ ! -f "$WP_DIR/wp-config.php" ]; then
	wp config create \
		--dbname="$DB_NAME" --dbuser="$DB_USER" --dbpass="$DB_PASSWORD" \
		--dbhost="$DB_HOST:$DB_PORT" --locale=fr_FR
fi

# Le journal des erreurs PHP : c'est le détecteur de fumée de la recette.
wp config set WP_DEBUG true --raw --type=constant >/dev/null
wp config set WP_DEBUG_LOG true --raw --type=constant >/dev/null
wp config set WP_DEBUG_DISPLAY false --raw --type=constant >/dev/null
wp config set SCRIPT_DEBUG true --raw --type=constant >/dev/null

if ! wp core is-installed >/dev/null 2>&1; then
	wp core install \
		--url="$WP_URL" \
		--title="Secura Academy (recette)" \
		--admin_user="$WP_ADMIN_USER" \
		--admin_password="$WP_ADMIN_PASSWORD" \
		--admin_email="$WP_ADMIN_EMAIL" \
		--locale=fr_FR \
		--skip-email
fi

say "3. Plugin et thème du dépôt"

rm -rf "$WP_DIR/wp-content/plugins/secura-academy" "$WP_DIR/wp-content/themes/secura-learning"
cp -r "$REPO_DIR/wp-content/plugins/secura-academy" "$WP_DIR/wp-content/plugins/secura-academy"
cp -r "$REPO_DIR/wp-content/themes/secura-learning" "$WP_DIR/wp-content/themes/secura-learning"

# Activation par l'option : WP-CLI ne retrouve pas toujours un plugin
# copié à la main dans un dossier ajouté après l'installation.
wp option update active_plugins --format=json \
	'["secura-academy/secura-academy.php","akismet/akismet.php"]' >/dev/null
wp option update seca_labs_path "$LABS_PATH" >/dev/null
wp rewrite structure '/%postname%/' --hard >/dev/null 2>&1 || true

# L'activation du plugin installe les rooms et les parcours. Comme on
# contourne l'activation (voir ci-dessus), on lance la meme installation
# a la main : c'est elle qui cree le contenu de depart.
wp eval 'Secura_Rooms::activate();' >/dev/null

# Notre theme (et non celui de WordPress) et le pack de langue arabe :
# sans le pack, WordPress ne sait pas que l'arabe s'ecrit de droite a
# gauche, et la page arabe ne se met pas en RTL.
wp theme activate secura-learning >/dev/null 2>&1 || echo "  (le theme n'a pas pu etre active)"
wp language core install ar >/dev/null 2>&1 || echo "  (le pack arabe n'a pas pu etre installe)" 

say "4. Plugins tiers"

if [ ${#PLUGINS_TIERS[@]} -eq 0 ]; then
	echo "  (aucun)"
else
	for slug in "${PLUGINS_TIERS[@]}"; do
		[ -z "$slug" ] && continue
		echo "  installation de $slug…"
		if wp plugin install "$slug" --activate --force >/dev/null 2>&1; then
			echo "    $slug installé et activé"
		else
			echo "    ATTENTION : $slug n'a pas pu être activé" >&2
			wp plugin install "$slug" --force 2>&1 | tail -3
		fi
	done
fi

say "5. Apprenants de test"

for learner in alice bob; do
	if ! wp user get "$learner" >/dev/null 2>&1; then
		wp user create "$learner" "$learner@secura-academy.local" \
			--role=subscriber --user_pass="${learner}_pw" >/dev/null
	fi
done
echo "  alice / alice_pw"
echo "  bob   / bob_pw"

say "6. Bilan"

ROOMS="$( wp eval 'echo count(get_posts(array("post_type"=>"secura_room","numberposts"=>-1,"fields"=>"ids")));' 2>/dev/null || echo 0 )"
PATHS="$( wp eval 'echo count(get_posts(array("post_type"=>"secura_path","numberposts"=>-1,"fields"=>"ids")));' 2>/dev/null || echo 0 )"

echo "  WordPress   : $WP_DIR"
echo "  Site        : $WP_URL"
echo "  Rooms       : $ROOMS"
echo "  Parcours    : $PATHS"
echo "  Machines    : $LABS_PATH"
echo "  Journal PHP : $WP_DIR/wp-content/debug.log"
