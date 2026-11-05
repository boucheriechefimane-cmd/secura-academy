# Passation technique

Ces guides reprennent et adaptent la documentation du ZIP au dépôt Git. Les
chemins partent de la racine du dépôt : il n'y a pas de répertoire `sources/`
ni d'archives préconstruites versionnées. Les procédures n'ont pas été
rejouées sur un WordPress ou un Docker réels pendant cette fusion.

- [Installation](INSTALLATION.md) · [Développement](DEVELOPMENT.md) ·
  [Contribution](CONTRIBUTING.md)
- [Audits](AUDITS.md) · [Opérations des labs](LABS-OPERATIONS.md) ·
  [Dépannage](TROUBLESHOOTING.md) · [Préparation d'une release](RELEASE.md)
- [Guide développeur](../README-DEVELOPPEUR.md) ·
  [Décisions de fusion](../docs/FUSION-ZIP-2026-11-05.md)

La pile Compose de développement et son fichier d'exemple, prévus pour une
arborescence différente et non validés, restent dans le ZIP original. Ne les
utilisez pas comme configuration de production. Les scripts locaux existants
peuvent modifier une base ou remplacer des fichiers : lisez-les et utilisez
exclusivement un environnement de test avant de les exécuter.
