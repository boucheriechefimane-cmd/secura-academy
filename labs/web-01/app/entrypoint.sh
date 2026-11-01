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

# Le serveur web est lance en arriere-plan AVANT la commande recue. Sans
# cela, la commande de maintien en vie du plugin (sleep infinity)
# remplacerait le serveur : la machine serait allumee mais ne repondrait
# plus sur le port 8080.
# Le dossier de journal peut ne pas exister (conteneur non root) :
# on le cree si possible, sinon le journal part a la racine.
mkdir -p /var/log/app 2>/dev/null || true
apache2-foreground >/var/log/app/apache.log 2>&1 &
WEB_PID=$!

if [ "$#" -gt 0 ] && [ "$1" != "apache2-foreground" ]; then
	exec "$@"
fi

wait "$WEB_PID"
