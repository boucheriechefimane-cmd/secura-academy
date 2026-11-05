# Développement — passation

## Code et contenu

- Plugin : `wp-content/plugins/secura-academy/` ; point d'entrée
  `secura-academy.php` et classes dans `includes/`.
- Thème : `wp-content/themes/secura-learning/`.
- Questions importées : `tools/lots/*.json`, puis fichiers générés
  `wp-content/plugins/secura-academy/includes/content-import-*.php`.
- Sources et autorisations : `tools/sources-autorisees.json`,
  `docs/SOURCES-CONTENU.md` et `LICENSES.md`.

Les importateurs contrôlent le format et le catalogue, mais ne remplacent pas
la vérification humaine des droits. Ne transformez pas automatiquement une
réponse rédigée en QCM ou en réponse exacte : les transformations du ZIP ont
été écartées pour éviter des corrections erronées.

Pour vérifier un lot sans écrire :

```bash
python3 tools/import-questions.py --verifier tools/lots/mit-ocw-6858-examens.json
```

Pour générer un lot, utilisez `--importer` après validation des droits et
avec un répertoire de sortie temporaire, puis relisez le résultat. Le test
`tests/import-test.py` vérifie que les PHP livrés correspondent aux lots.
Voir `docs/IMPORTER-QUESTIONS.md` pour le format complet.

## Modifier une room ou un lab

Suivez les modèles et les contrôles du code existant, plutôt que de remplacer
massivement les métadonnées de rooms. Les dossiers Blue/DVWA supplémentaires
du ZIP sont des copies et **pas des labs validés** : voir `labs/README.md`.
Les vidéos et contenus externes exigent une vérification de droits distincte.
Les classes de front/examen/certificat du ZIP sont conservées mais non chargées ;
voir `wp-content/plugins/secura-academy/includes/EXPERIMENTAL-ZIP.md`.

## Tests

```bash
php tests/smoke-test.php
php tests/audit-test.php
php tests/sondes-contenu-test.php
python3 tests/import-test.py
python3 tests/archives-test.py
```

Les audits en situation réelle et les tests Docker sont complémentaires :
voir [`AUDITS.md`](AUDITS.md) et [`LABS-OPERATIONS.md`](LABS-OPERATIONS.md).
Ne pas déployer en production sans accord explicite.
