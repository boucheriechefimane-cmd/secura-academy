# Installation — passation

Ce guide décrit une installation **de test**. Une validation sur WordPress et
Docker réels reste nécessaire avant toute mise en production.

## Préparer WordPress

1. Préparez une installation WordPress et sa base de données dans un
   environnement de test, avec PHP compatible avec le minimum déclaré par le
   plugin. Protégez l'accès et n'utilisez pas de données réelles d'élèves.
2. Copiez `wp-content/plugins/secura-academy/` et
   `wp-content/themes/secura-learning/` aux emplacements correspondants dans
   WordPress, puis activez le plugin et le thème via l'administration.
3. Vérifiez les réglages, les permaliens, les rooms et les parcours sur le
   site rendu. Vérifiez séparément les droits des contenus et des vidéos.
4. Pour les labs, lisez [`LABS-OPERATIONS.md`](LABS-OPERATIONS.md) : les
   images sont volontairement vulnérables et ne doivent pas être exposées.

La pile Compose de développement du ZIP n'est pas intégrée en l'état : elle
supposait une arborescence `sources/` différente et n'a pas été validée.
Les scripts `scripts/wordpress-local.sh` et `scripts/sync-local.sh` sont des
outils pour bac à sable : ils créent/modifient une base ou remplacent les
fichiers du plugin et du thème et peuvent modifier la liste des extensions
actives. Les lire et sauvegarder l'environnement avant toute utilisation.

## Contrôles

Depuis la racine du dépôt :

```bash
php tests/smoke-test.php
php tests/audit-test.php
php tests/sondes-contenu-test.php
python3 tests/import-test.py
python3 tests/archives-test.py
```

Les 18 audits demandent en plus un WordPress opérationnel, WP-CLI, et pour
certains contrôles Docker : voir [`AUDITS.md`](AUDITS.md). Les fichiers JSON
et PHP d'import sont déjà présents ; il n'est pas nécessaire de les régénérer
pour une simple installation.
