#!/usr/bin/env bash
#
# Recrée le bac à sable WordPress local (environnement de test).
#
# Pourquoi ce script ?
# L'installation de test (WordPress + base de données + plugin + thème)
# occupe plus de 120 Mo. Elle n'est pas versionnée : le dépôt GitHub ne
# contient que le plugin, le thème et les machines. Ce script permet de
# la reconstruire en une commande, à l'identique, quand on en a besoin.
#
# Ce que fait le script, dans l'ordre :
#   1. vérifie que MariaDB (ou MySQL) tourne ;
#   2. crée la base « seca_wp » et l'utilisateur « seca » ;
#   3. télécharge WordPress en français (via WP-CLI) ;
#   4. installe WordPress (site local, administrateur « admin ») ;
#   5. copie le plugin et le thème du dépôt dans WordPress ;
#   6. active le plugin, qui installe lui-même les rooms et les parcours ;
#   7. indique le chemin des machines (option « seca_labs_path ») ;
#   8. crée deux apprenants de test (alice, bob) pour le test à deux ;
#   9. vérifie que tout est en place.
#
# Utilisation :
#   bash scripts/wordpress-local.sh                 # installation complète
#   bash scripts/wordpress-local.sh /tmp/wp-test    # ailleurs
#
# Après une modification du plugin ou du thème :
#   bash scripts/sync-local.sh                      # recopie dans WordPress
#
# Aucun secret réel : le mot de passe est un mot de passe local de test.

set -euo pipefail

REPO_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )/.." && pwd )"
WP_DIR="${1:-/home/user/wp}"
WP_URL="http://localhost:8080"
WP_ADMIN_USER="admin"
WP_ADMIN_PASSWORD="admin_local_pw"
WP_ADMIN_EMAIL="admin@secura-academy.local"
DB_NAME="secura_wp"
DB_USER="secura"
DB_PASSWORD="seca_local_pw"
LABS_PATH="${SECA_LABS_PATH:-/opt/secura-labs}"
WP_CLI="${SECA_WP_CLI:-/home/user/wp-cli.phar}"

say() { printf '\n\033[1;34m== %s\033[0m\n' "$1"; }

say "1. Base de données"

if ! command -v mariadb >/dev/null 2>&1 && ! command -v mysql >/dev/null 2>&1; then
	echo "ERREUR : ni mariadb ni mysql n'est installé." >&2
	exit 1
fi

MYSQL_BIN="$( command -v mariadb || command -v mysql )"

sudo "$MYSQL_BIN" -e "CREATE DATABASE IF NOT EXISTS ${DB_NAME} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
sudo "$MYSQL_BIN" -e "CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASSWORD}';"
sudo "$MYSQL_BIN" -e "GRANT ALL PRIVILEGES ON ${DB_NAME}.* TO '${DB_USER}'@'localhost'; FLUSH PRIVILEGES;"

say "2. WP-CLI"

if [ ! -f "$WP_CLI" ]; then
	curl -sSL -o "$WP_CLI" https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
	chmod +x "$WP_CLI"
fi

wp() { php "$WP_CLI" --path="$WP_DIR" --allow-root "$@"; }

say "3. Téléchargement de WordPress (français)"

if [ ! -f "$WP_DIR/wp-settings.php" ]; then
	mkdir -p "$WP_DIR"
	wp core download --locale=fr_FR
fi

if [ ! -f "$WP_DIR/wp-config.php" ]; then
	wp config create --dbname="$DB_NAME" --dbuser="$DB_USER" --dbpass="$DB_PASSWORD" --dbhost=localhost --locale=fr_FR
fi

say "4. Installation de WordPress"

if ! wp core is-installed >/dev/null 2>&1; then
	wp core install \
		--url="$WP_URL" \
		--title="Secura Academy (bac à sable local)" \
		--admin_user="$WP_ADMIN_USER" \
		--admin_password="$WP_ADMIN_PASSWORD" \
		--admin_email="$WP_ADMIN_EMAIL" \
		--locale=fr_FR \
		--skip-email
fi

say "5. Copie du plugin et du thème du dépôt"

mkdir -p "$WP_DIR/wp-content/plugins" "$WP_DIR/wp-content/themes"
rm -rf "$WP_DIR/wp-content/plugins/secura-academy" "$WP_DIR/wp-content/themes/secura-learning"
cp -r "$REPO_DIR/wp-content/plugins/secura-academy" "$WP_DIR/wp-content/plugins/secura-academy"
cp -r "$REPO_DIR/wp-content/themes/secura-learning" "$WP_DIR/wp-content/themes/secura-learning"

say "6. Activation du plugin (il installe les rooms et les parcours)"

# On passe par l'option « active_plugins » : WP-CLI ne sait pas toujours
# retrouver un plugin installé à la main dans un dossier ajouté après coup.
wp option update active_plugins --format=json \
	'["secura-academy/secura-academy.php","akismet/akismet.php"]' >/dev/null
wp option update seca_labs_path "$LABS_PATH" >/dev/null
wp rewrite structure '/%postname%/' --hard >/dev/null 2>&1 || true

say "7. Apprenants de test"

for learner in alice bob; do
	if ! wp user get "$learner" >/dev/null 2>&1; then
		wp user create "$learner" "$learner@secura-academy.local" \
			--role=subscriber \
			--user_pass="$learner" >/dev/null
		echo "  $learner créé (mot de passe : $learner)"
	else
		echo "  $learner existe déjà"
	fi
done

say "8. Vérification"

ROOMS="$( wp eval 'echo count(get_posts(array("post_type"=>"secura_room","numberposts"=>-1,"fields"=>"ids")));' 2>/dev/null || echo 0 )"
PATHS="$( wp eval 'echo count(get_posts(array("post_type"=>"secura_path","numberposts"=>-1,"fields"=>"ids")));' 2>/dev/null || echo 0 )"
VERSION="$( wp plugin list --name=secura-academy --field=version 2>/dev/null || echo '?' )"

echo "  Plugin      : seca-academy $VERSION"
echo "  Rooms       : $ROOMS"
echo "  Parcours    : $PATHS"
echo "  Machines    : $LABS_PATH"
echo "  WordPress   : $WP_DIR"
echo "  Site        : $WP_URL"
echo "  Admin       : $WP_ADMIN_USER / $WP_ADMIN_PASSWORD"
echo
echo "Pour démarrer le serveur local :"
echo "  php -S 0.0.0.0:8080 -t $WP_DIR"
