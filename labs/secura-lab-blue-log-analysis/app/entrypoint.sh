#!/bin/sh
# Prépare la machine : base de données, journaux, configuration oubliée.
#
# Tout est créé au démarrage pour que l'image reste légère et que le
# contenu soit lisible dans le dépôt.
set -e

# --- Base de données de l'application -------------------------------------
if [ ! -f /var/www/html/db.sqlite ]; then
	php -r '
		$db = new SQLite3("/var/www/html/db.sqlite");
		$db->exec("CREATE TABLE users (id INTEGER PRIMARY KEY, username TEXT, password TEXT, role TEXT)");
		$db->exec("INSERT INTO users VALUES (1, \"admin\", \"admin123\", \"admin\")");
		$db->exec("INSERT INTO users VALUES (2, \"soignant\", \"soignant123\", \"soignant\")");
		$db->exec("CREATE TABLE secrets (id INTEGER PRIMARY KEY, label TEXT, value TEXT)");
		$db->exec("INSERT INTO secrets VALUES (1, \"cle_licence\", \"FLAG=SECURA{sql_quotes_only}\")");
		$db->exec("INSERT INTO secrets VALUES (2, \"jeton_maint\", \"MAINT-2026-8842\")");
	'
	chmod 666 /var/www/html/db.sqlite
fi

# --- Sauvegarde oubliée (le scénario « le fichier oublié ») ----------------
mkdir -p /var/backups/app 2>/dev/null || true
if [ ! -f /var/backups/app/db.sql.bak ]; then
	cp /var/www/html/db.sqlite /var/backups/app/db.sql.bak
fi

# Sauvegarde en clair : c'est ce que le script de sauvegarde laisse
# derriere lui (et ce que l'on trouve par traversee de repertoire).
if [ ! -f /var/backups/app/licences.sql ]; then
	cat > /var/backups/app/licences.sql <<'SQL'
-- Sauvegarde automatique des licences (script de sauvegarde nightly)
CREATE TABLE licences (id INTEGER PRIMARY KEY, nom TEXT, cle TEXT);
INSERT INTO licences VALUES (1, 'licence principale', 'FLAG=SECURA{backup_exposed}');
SQL
fi

# --- Configuration de l'application (le mot de passe oublié) --------------
mkdir -p /srv/app 2>/dev/null || true
if [ ! -f /srv/app/app.conf ]; then
	cat > /srv/app/app.conf <<'CONF'
# Configuration de l'application Intranet (ne pas deployer en production)
[app]
name        = intranet
version     = 2.4.1
build_id    = FLAG=SECURA{triage_patient}

[database]
host        = 127.0.0.1
name        = intranet
# Mot de passe de la base, pose en clair pendant la migration :
# db_password = Intranet2019!
db_password = Intranet2019!

[session]
admin_token = FLAG=SECURA{xss_reflected}
CONF
fi
chmod 644 /srv/app/app.conf

# --- Journal d'accès : la rafale de tentatives ratées --------------------
mkdir -p /var/log/app 2>/dev/null || true
if [ ! -f /var/log/app/access.log ]; then
	cat > /var/log/app/access.log <<'LOG'
203.0.113.24 - - [12/Oct/2026:08:41:02 +0200] "GET /index.php HTTP/1.1" 200 812
203.0.113.24 - - [12/Oct/2026:08:42:19 +0200] "POST /index.php HTTP/1.1" 200 812
198.51.100.7 - - [12/Oct/2026:09:14:51 +0200] "GET /status.php HTTP/1.1" 200 1204
198.51.100.7 - - [12/Oct/2026:09:15:03 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:15:07 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:15:11 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:15:16 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:15:21 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:15:27 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:15:33 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:15:40 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:15:48 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:15:57 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:16:04 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:16:12 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:16:22 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:16:33 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:16:45 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:16:58 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:17:12 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:17:27 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:17:44 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:18:02 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:18:21 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:18:42 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:19:04 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:19:28 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:19:53 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:20:19 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:20:47 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:21:16 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:21:47 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:22:19 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:22:53 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:23:28 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:24:05 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:24:43 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:25:22 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:26:03 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:26:46 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:27:31 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:28:18 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:29:07 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:29:58 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:30:51 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:31:46 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:32:43 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:33:42 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:34:43 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:35:46 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:36:51 +0200] "POST /index.php HTTP/1.1" 401 512
198.51.100.7 - - [12/Oct/2026:09:38:00 +0200] "GET /export.csv?jeton=FLAG=SECURA{log_never_lies}" 200 2140
203.0.113.24 - - [12/Oct/2026:09:39:11 +0200] "GET /index.php HTTP/1.1" 200 812
LOG
fi
chmod 644 /var/log/app/access.log

# --- Le robot de l'administrateur (scénario « injection de script ») ------
# Le robot visite une page comme le ferait un navigateur, mais il ne
# comprend pas le JavaScript : il détecte la présence d'un script et
# enregistre ce que le script aurait volé (le jeton de session).
mkdir -p /var/log/app 2>/dev/null || true
if [ ! -f /var/log/app/stolen.txt ]; then
	printf 'RIEN_DE_VOLE_POUR_LE_MOMENT\n' > /var/log/app/stolen.txt
fi
chmod 666 /var/log/app/stolen.txt

# Les droits peuvent être refusés si le conteneur tourne sans root :
# on ne casse pas le démarrage.
chown -R ctf:ctf /var/www/html /home/ctf 2>/dev/null || true

# Le serveur web est lancé en arrière-plan AVANT la commande reçue.
# Sans cela, la commande de maintien en vie du plugin (sleep infinity)
# remplacerait le serveur : la machine serait allumée mais ne
# répondrait plus sur le port 8080.
apache2-foreground >/var/log/app/apache.log 2>&1 &
WEB_PID=$!

if [ "$#" -gt 0 ] && [ "$1" != "apache2-foreground" ]; then
	exec "$@"
fi

wait "$WEB_PID"
