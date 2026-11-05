#!/usr/bin/env bash
#
# Lance les dix-huit audits externes dans un WordPress réel.
#
# Chaque auditeur est un script PHP exécuté dans le site (comme le ferait
# un visiteur : on lit les pages rendues, pas le code source).
#
# Usage :
#   SECA_WP_DIR=/chemin/vers/wordpress bash scripts/audit/run-audits.sh
#
# Le script sort avec le code 1 si un seul audit trouve un constat de
# fond (bloquant OU majeur), même sans preuve : c'est la barrière automatique. Avant le
# 01/11/2026, seul le « bloquant » bloquait — un défaut réel de gravité
# « majeur » passait en silence alors que la plateforme était déclarée
# conforme. Les niveaux « mineur » et « info » restent informatifs.

set -uo pipefail

REPO_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )/../.." && pwd )"
WP_DIR="${SECA_WP_DIR:-/tmp/wp-audit}"
WP_CLI="${WP_CLI:-wp}"   # peut contenir plusieurs mots ("php /chemin/wp-cli.phar")

# Les dix-sept spécialités. Les cinq premières sont le comité d'origine ;
# les dix suivantes sont le bloc T (pédagogie, performance, données
# structurées, accessibilité, multilingue, RGPD, moteur, onboarding,
# licences, DevOps) ; la dernière est le panel des dix élèves, qui joue
# la plateforme comme un élève et vérifie notamment que deux élèves ne
# passent pas la même copie d'examen ; la dernière encore est le moteur
# d'épreuves, qui mesure les réservoirs et les variantes ; la toute
# dernière est le contrôle des questions de machine, qui joue pour de
# vrai les questions de drapeau et d'action sur les vraies machines.
AUDITS="seo contenu ux-ui dev securite pedagogie performance donnees-structurees accessibilite multilingue rgpd moteur onboarding licences devops panel-eleves epreuves drapeaux"
CONSTATS=0

cd "$REPO_DIR"

echo "============================================================"
echo " Comité d'audit externe — 18 auditeurs spécialisés"
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
		CONSTATS=$((CONSTATS + 1))
	fi
done

echo ""
echo "============================================================"

if [ "$CONSTATS" -gt 0 ]; then
	echo " $CONSTATS audit(s) en échec : constat de fond ou contrôle grave non étayé."
	echo " La plateforme ne peut pas être déclarée conforme : corriger, puis relancer."
else
	echo " Aucun échec bloquant ou majeur. Lire aussi les rapports et leurs limites."
fi

echo "============================================================"

exit "$CONSTATS"
