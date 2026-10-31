#!/usr/bin/env bash
#
# Déploiement du plugin Secura Academy et du thème Secura Learning
# sur une installation WordPress.
#
# Variables d'environnement attendues :
#   WP_HOST         nom d'hôte ou IP du serveur
#   WP_SSH_USER     utilisateur SSH autorisé
#   WP_PATH         chemin absolu de l'installation WordPress
#   WP_SITE_URL     URL publique du site (contrôle HTTP, optionnel)
#
# La clé privée doit déjà être écrite dans ~/.ssh/deploy_key et l'hôte
# dans ~/.ssh/known_hosts (voir le job « Configurer SSH » du workflow).

set -euo pipefail

PLUGIN_PATH="wp-content/plugins/secura-academy"
THEME_PATH="wp-content/themes/secura-learning"

if [ -z "${WP_HOST:-}" ] || [ -z "${WP_SSH_USER:-}" ] || [ -z "${WP_PATH:-}" ]; then
	echo "Secrets de déploiement absents : déploiement ignoré."
	echo "Configurez WP_HOST, WP_SSH_USER et WP_PATH dans les secrets du dépôt."
	exit 0
fi

KEY="$HOME/.ssh/deploy_key"
TARGET="${WP_SSH_USER}@${WP_HOST}"
BACKUP_DIR="$HOME/secura-backups"
STAMP="$(date -u +%Y%m%d-%H%M%S)"
SSH_ARGS=(-i "$KEY" -o StrictHostKeyChecking=yes -o BatchMode=yes)

echo ">> Sauvegarde de la version déployée"
ssh "${SSH_ARGS[@]}" "$TARGET" \
	"mkdir -p '$BACKUP_DIR' && tar -czf '$BACKUP_DIR/secura-$STAMP.tar.gz' -C '$WP_PATH' '$PLUGIN_PATH' '$THEME_PATH'"

echo ">> Synchronisation du plugin"
rsync -az --delete --no-owner --no-group -e "ssh -i $KEY -o StrictHostKeyChecking=yes -o BatchMode=yes" \
	"$PLUGIN_PATH/" "$TARGET:$WP_PATH/$PLUGIN_PATH/"

echo ">> Synchronisation du thème"
rsync -az --delete --no-owner --no-group -e "ssh -i $KEY -o StrictHostKeyChecking=yes -o BatchMode=yes" \
	"$THEME_PATH/" "$TARGET:$WP_PATH/$THEME_PATH/"

if [ -n "${WP_SITE_URL:-}" ]; then
	echo ">> Contrôle HTTP du site"
	curl -fsS --max-time 20 "$WP_SITE_URL" -o /dev/null -w 'HTTP %{http_code}\n'
fi

echo ">> Déploiement terminé."
