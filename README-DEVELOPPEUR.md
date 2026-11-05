# Secura Academy — guide développeur

Le dépôt est la source de travail : plugin et thème dans `wp-content/`,
machines dans `labs/`, importateurs et lots dans `tools/`, scripts dans
`scripts/`, tests dans `tests/` et documentation dans `docs/` et `handoff/`.
Les ZIP de livraison ne sont pas versionnés ; `scripts/build-archives.sh`
les produit dans un dossier de sortie choisi.

## Premiers contrôles

```bash
php tests/smoke-test.php
php tests/audit-test.php
php tests/sondes-contenu-test.php
python3 tests/import-test.py
python3 tests/archives-test.py
```

Le guide de [passation](handoff/README.md) détaille l'installation, les labs,
les audits et la préparation d'une release. Les audits complets nécessitent
un vrai WordPress ; les tests de labs nécessitent Docker.

## Points d'attention

- Les lots et le PHP généré du dépôt ont été conservés : le ZIP transformait
  automatiquement des questions de façon non fiable et vidait un lot.
- Les dossiers de labs supplémentaires du ZIP comprennent des copies de
  machines existantes, et non des labs Blue/DVWA validés : voir
  [`labs/README.md`](labs/README.md). Ne pas exposer les labs vulnérables.
- Les prototypes de front, d’examen et de certificat du ZIP ne sont pas chargés :
  voir [`EXPERIMENTAL-ZIP.md`](wp-content/plugins/secura-academy/includes/EXPERIMENTAL-ZIP.md).
- Les licences des contenus tiers sont distinctes de celle du code : consulter
  [`LICENSES.md`](LICENSES.md) et [`docs/SOURCES-CONTENU.md`](docs/SOURCES-CONTENU.md).
- Les échecs graves sans preuve bloquent désormais la barrière et sont
  présentés comme non étayés, pas comme des constats établis.
- Aucune mise en production sans accord explicite et recette adaptée.

La synthèse des décisions et des exclusions de la fusion figure dans
[`docs/FUSION-ZIP-2026-11-05.md`](docs/FUSION-ZIP-2026-11-05.md).
