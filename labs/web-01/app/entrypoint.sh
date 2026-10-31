#!/bin/sh
# Prépare la base et les droits au démarrage.
set -e

if [ ! -f /var/www/html/db.sqlite ]; then
	php -r '
		$db = new SQLite3("/var/www/html/db.sqlite");
		$db->exec("CREATE TABLE users (id INTEGER PRIMARY KEY, username TEXT, password TEXT, role TEXT)");
		$db->exec("INSERT INTO users VALUES (1, \"admin\", \"admin123\", \"admin\")");
		$db->exec("INSERT INTO users VALUES (2, \"nurse\", \"nurse123\", \"soignant\")");
	'
	chmod 666 /var/www/html/db.sqlite
fi

mkdir -p /var/www/html/backup
cp /var/www/html/db.sqlite /var/www/html/backup/db.sqlite.bak

# Le conteneur peut tourner sans etre root : on ne casse pas le demarrage
# si le changement de proprietaire est refuse.
chown -R ctf:ctf /var/www/html /home/ctf 2>/dev/null || true

exec "$@"
