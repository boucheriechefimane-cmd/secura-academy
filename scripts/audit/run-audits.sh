#!/usr/bin/env bash
#
# Lance les cinq audits externes dans un WordPress réel.
#
# Chaque auditeur est un script PHP exécuté dans le site (comme le ferait
# un visiteur : on lit les pages rendues, pas le code source).
#
# Usage :
#   SECA_WP_DIR=/chemin/vers/wordpress bash scripts/audit/run-audits.sh
#
# Le script sort avec le code 1 si un seul audit trouve un constat
# bloquant : c'est la barrière automatique.

set -uo pipefail

REPO_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )/../.." && pwd )"
WP_DIR="${SECA_WP_DIR:-/tmp/wp-audit}"
WP_CLI="${WP_CLI:-wp}"   # peut contenir plusieurs mots ("php /chemin/wp-cli.phar")

AUDITS="seo contenu ux-ui dev securite"
BLOQUANTS=0

cd "$REPO_DIR"

echo "============================================================"
echo " Comité d'audit externe — 5 auditeurs spécialisés"
echo " WordPress : $WP_DIR"
echo "============================================================"

for audit in $AUDITS; do
	echo ""
	echo "------------------------------------------------------------"
	echo " Auditeur : $audit"
	echo "------------------------------------------------------------"

	# shellcheck disable=SC2086
	$WP_CLI --path="$WP_DIR" --allow-root eval-file "scripts/audit/audit-$audit.php"
	code=$?

	if [ "$code" -ne 0 ]; then
		BLOQUANTS=$((BLOQUANTS + 1))
	fi
done

echo ""
echo "============================================================"

if [ "$BLOQUANTS" -gt 0 ]; then
	echo " $BLOQUANTS audit(s) ont trouvé un constat BLOQUANT."
else
	echo " Aucun constat bloquant : la plateforme peut passer en ligne."
fi

echo "============================================================"

exit "$BLOQUANTS"
