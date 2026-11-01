#!/usr/bin/env bash
#
# Fabrique les cinq archives livrables :
#
#   secura-academy-plugin.zip     le plugin seul (à poser dans wp-content/plugins)
#   secura-academy-wordpress.zip  le plugin + le thème (installation en deux clics)
#   secura-learning-theme.zip     le thème seul
#   secura-academy-labs.zip       les machines Docker des labs
#   secura-academy-recette.zip    les scripts et documents de recette
#
# Utilisation :
#   bash scripts/build-archives.sh            # écrit dans /home/user
#   bash scripts/build-archives.sh /tmp/zips # ailleurs
#
# Les archives sont regeneratees apres chaque refonte : elles doivent
# toujours correspondre exactement au depot.

set -euo pipefail

REPO_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )/.." && pwd )"
DEST="${1:-/home/user}"
TMP="$( mktemp -d )"

trap 'rm -rf "$TMP"' EXIT

mkdir -p "$DEST"

echo "Preparation…"

# 1. Plugin
mkdir -p "$TMP/plugin/secura-academy"
cp -r "$REPO_DIR/wp-content/plugins/secura-academy/." "$TMP/plugin/secura-academy/"

# 2. WordPress (plugin + theme)
mkdir -p "$TMP/wordpress/plugins" "$TMP/wordpress/themes"
cp -r "$REPO_DIR/wp-content/plugins/secura-academy" "$TMP/wordpress/plugins/secura-academy"
cp -r "$REPO_DIR/wp-content/themes/secura-learning" "$TMP/wordpress/themes/secura-learning"

# 3. Theme
mkdir -p "$TMP/theme/secura-learning"
cp -r "$REPO_DIR/wp-content/themes/secura-learning/." "$TMP/theme/secura-learning/"

# 4. Labs
mkdir -p "$TMP/labs"
cp -r "$REPO_DIR/labs/." "$TMP/labs/"

# 5. Recette
mkdir -p "$TMP/recette/scripts" "$TMP/recette/docs"
cp "$REPO_DIR/scripts/recette-serveur.sh" "$TMP/recette/scripts/"
cp "$REPO_DIR/scripts/test-labs-ci.sh" "$TMP/recette/scripts/"
cp "$REPO_DIR/scripts/wordpress-local.sh" "$TMP/recette/scripts/"
cp "$REPO_DIR/scripts/sync-local.sh" "$TMP/recette/scripts/"
cp "$REPO_DIR/docs/RECETTE-SERVEUR.md" "$TMP/recette/docs/"
cp "$REPO_DIR/docs/HEBERGEMENT.md" "$TMP/recette/docs/"
cp "$REPO_DIR/docs/SCENARIOS-M3.md" "$TMP/recette/docs/"
cp "$REPO_DIR/docs/SOURCES-CONTENU.md" "$TMP/recette/docs/"
cp "$REPO_DIR/docs/LABS-AVANCES.md" "$TMP/recette/docs/"
cp "$REPO_DIR/docs/ROADMAP.md" "$TMP/recette/docs/"
cp "$REPO_DIR/docs/COMPATIBILITE-PLUGINS.md" "$TMP/recette/docs/"
cp "$REPO_DIR/docs/CONTENU-MIT.md" "$TMP/recette/docs/"

# Les outils : le generateur de contenu (avec le controle qualite),
# l'outil de verification des drapeaux Juice Shop et le catalogue video.
mkdir -p "$TMP/recette/tools"
cp -r "$REPO_DIR/tools/contenu-universites" "$TMP/recette/tools/contenu-universites"
cp -r "$REPO_DIR/tools/contenu-m3" "$TMP/recette/tools/contenu-m3"
cp -r "$REPO_DIR/tools/juice-shop" "$TMP/recette/tools/juice-shop"
cp -r "$REPO_DIR/tools/videos" "$TMP/recette/tools/videos"
rm -rf "$TMP/recette/tools/contenu-universites/__pycache__"

cp "$REPO_DIR/scripts/ci-wordpress.sh" "$TMP/recette/scripts/"
cp "$REPO_DIR/scripts/build-archives.sh" "$TMP/recette/scripts/"

# Le comite d'audit externe : les cinq auditeurs et leur lanceur.
mkdir -p "$TMP/recette/scripts/audit"
cp "$REPO_DIR/scripts/audit/"*.php "$REPO_DIR/scripts/audit/run-audits.sh" "$TMP/recette/scripts/audit/"

cp "$REPO_DIR/docs/AUDITS-CADRE.md" "$TMP/recette/docs/"
cp "$REPO_DIR/docs/AUDITS-REGISTRE.md" "$TMP/recette/docs/"

python3 - "$TMP" "$DEST" <<'PY'
import os
import sys
import zipfile

tmp, dest = sys.argv[1], sys.argv[2]

archives = [
    ('plugin',   'secura-academy-plugin.zip',    'secura-academy-plugin'),
    ('wordpress','secura-academy-wordpress.zip', 'secura-academy-wordpress'),
    ('theme',    'secura-learning-theme.zip',    'secura-learning-theme'),
    ('labs',     'secura-academy-labs.zip',      'secura-academy-labs'),
    ('recette',  'secura-academy-recette.zip',   'secura-academy-recette'),
]

for dossier, nom, _ in archives:
    racine = os.path.join(tmp, dossier)
    cible = os.path.join(dest, nom)
    with zipfile.ZipFile(cible, 'w', zipfile.ZIP_DEFLATED) as zf:
        for root, dirs, files in os.walk(racine):
            dirs[:] = [d for d in dirs if d != '.git']
            for f in sorted(files):
                if f.startswith('.'):
                    continue
                chemin = os.path.join(root, f)
                zf.write(chemin, os.path.relpath(chemin, racine))
    taille = os.path.getsize(cible) / 1024.0
    with zipfile.ZipFile(cible) as zf:
        fichiers = len(zf.namelist())
        assert zf.testzip() is None
    print(f"  {nom:36s} {taille:7.1f} Ko  {fichiers:3d} fichiers")
PY

echo "Terminé : les archives sont dans $DEST"
