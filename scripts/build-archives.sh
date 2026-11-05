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
cp "$REPO_DIR/LICENSE" "$REPO_DIR/LICENSES.md" "$TMP/labs/"
mkdir -p "$TMP/labs/docs"
cp "$REPO_DIR/docs/SOURCES-CONTENU.md" "$TMP/labs/docs/"

# 5. Recette
mkdir -p "$TMP/recette/scripts" "$TMP/recette/docs"
cp "$REPO_DIR/LICENSE" "$REPO_DIR/LICENSES.md" "$TMP/recette/"
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
cp "$REPO_DIR/docs/IMPORTER-QUESTIONS.md" "$TMP/recette/docs/"
cp "$REPO_DIR/docs/RECOLTE-OCW-2026-11.md" "$TMP/recette/docs/"
cp "$REPO_DIR/docs/INVENTAIRE-BAC-A-SABLE.md" "$TMP/recette/docs/"

# Les outils : le generateur de contenu (avec le controle qualite),
# l'outil de verification des drapeaux Juice Shop et le catalogue video.
mkdir -p "$TMP/recette/tools"
cp -r "$REPO_DIR/tools/contenu-universites" "$TMP/recette/tools/contenu-universites"
cp -r "$REPO_DIR/tools/contenu-m3" "$TMP/recette/tools/contenu-m3"
cp -r "$REPO_DIR/tools/juice-shop" "$TMP/recette/tools/juice-shop"
cp -r "$REPO_DIR/tools/videos" "$TMP/recette/tools/videos"

# L'import de questions deja validees : le catalogue des sources et
# l'outil qui refuse tout ce qui n'y figure pas.
cp "$REPO_DIR/tools/import-questions.py" "$TMP/recette/tools/"
cp "$REPO_DIR/tools/import-mit-ocw.py" "$TMP/recette/tools/"
cp "$REPO_DIR/tools/ocw-recupere.py" "$TMP/recette/tools/"
cp "$REPO_DIR/tools/sources-autorisees.json" "$TMP/recette/tools/"
cp "$REPO_DIR/tools/rooms-connues.json" "$REPO_DIR/tools/controler-lot.py" "$TMP/recette/tools/"
cp "$REPO_DIR/tools/plugins-tiers.json" "$TMP/recette/tools/"
rm -rf "$TMP/recette/tools/contenu-universites/__pycache__"

# Le moteur de criblage OCW et le telechargeur parallelise : c'est ce qui
# remplace la navigation a la main dans le sitemap (boussole -> moteur).
cp "$REPO_DIR/tools/criblage-ocw.py" "$TMP/recette/tools/"
cp "$REPO_DIR/tools/telecharger-ocw.py" "$TMP/recette/tools/"

# Les douze extracteurs : un par format d'examen university.
mkdir -p "$TMP/recette/tools/extracteurs"
cp "$REPO_DIR/tools/import-mit-"*.py "$REPO_DIR/tools/import-stanford-"*.py "$TMP/recette/tools/extracteurs/" 2>/dev/null || true

# La recolte elle-meme : le rapport fusionne des six robots (430 cours).
mkdir -p "$TMP/recette/tools/recolte"
cp "$REPO_DIR/docs/recolte/"*.json "$TMP/recette/tools/recolte/" 2>/dev/null || true

# Le lot d'examen livre (MIT OCW 6.858) : c'est lui qui alimente les
# reserves d'examen, et il est verifiable a tout moment.
mkdir -p "$TMP/recette/tools/lots"
cp "$REPO_DIR/tools/lots/"*.json "$TMP/recette/tools/lots/"

# La chaine d'import, avec ses tests : le refus de PortSwigger y est
# prouve par un test automatique.
mkdir -p "$TMP/recette/tests/fixtures"
cp "$REPO_DIR/tests/import-test.py" "$TMP/recette/tests/"
cp "$REPO_DIR/tests/fixtures/"*.json "$TMP/recette/tests/fixtures/"
# Le test d'import compare chaque lot au PHP réellement livré.
mkdir -p "$TMP/recette/wp-content/plugins/secura-academy/includes"
cp "$REPO_DIR/wp-content/plugins/secura-academy/includes/"content-import-*.php \
   "$TMP/recette/wp-content/plugins/secura-academy/includes/"

cp "$REPO_DIR/scripts/ci-wordpress.sh" "$TMP/recette/scripts/"
cp "$REPO_DIR/scripts/build-archives.sh" "$TMP/recette/scripts/"

# Le comite d'audit externe : les dix-huit auditeurs et leur lanceur.
mkdir -p "$TMP/recette/scripts/audit"
cp "$REPO_DIR/scripts/audit/"*.php "$REPO_DIR/scripts/audit/run-audits.sh" "$TMP/recette/scripts/audit/"
cp "$REPO_DIR/scripts/audit/README-SONDES-ZIP.md" "$TMP/recette/scripts/audit/"

# Les mesures du bac a sable : elles comparent, elles ne testent pas.
mkdir -p "$TMP/recette/scripts/mesures"
cp "$REPO_DIR/scripts/mesures/"*.php "$REPO_DIR/scripts/mesures/README.md" "$TMP/recette/scripts/mesures/"

cp "$REPO_DIR/docs/AUDITS-CADRE.md" "$TMP/recette/docs/"
cp "$REPO_DIR/docs/AUDITS-REGISTRE.md" "$TMP/recette/docs/"
cp "$REPO_DIR/docs/SEO-GENERATION-AI.md" "$TMP/recette/docs/"

# Les mesures de la recette WordPress reelle (05/11/2026) : ce qui a ete
# corrige, ce qui reste non teste (Docker, MySQL, certificat PDF).
cp "$REPO_DIR/docs/RECETTE-2026-11-05-WORDPRESS-REEL.md" "$TMP/recette/docs/"

# Les rapports des dix-huit auditeurs du 05/11/2026 : ils voyagent avec la
# recette, sinon on livre des auditeurs sans leurs resultats.
mkdir -p "$TMP/recette/docs/audits"
cp "$REPO_DIR/docs/audits/"*-2026-11-05.md "$REPO_DIR/docs/audits/"*-2026-11-05.json \
   "$REPO_DIR/docs/audits/"*-2026-11-05.html "$TMP/recette/docs/audits/"

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
