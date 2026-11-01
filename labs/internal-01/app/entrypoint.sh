#!/bin/sh
# Prépare le nœud interne.
set -e

chown -R ctf:ctf /var/www/html /home/ctf 2>/dev/null || true

# Le serveur web tourne en arrière-plan : la machine reste joignable même
# quand le plugin passe une commande de maintien en vie.
# Le dossier de journal peut ne pas exister (conteneur non root) :
# on le cree si possible, sinon le journal part a la racine.
mkdir -p /var/log/app 2>/dev/null || true
apache2-foreground >/var/log/app/apache.log 2>&1 &
WEB_PID=$!

if [ "$#" -gt 0 ] && [ "$1" != "apache2-foreground" ]; then
	exec "$@"
fi

wait "$WEB_PID"
