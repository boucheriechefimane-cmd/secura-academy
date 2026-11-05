# Contribution — passation

1. Décrivez le changement et son lien avec la roadmap pertinente.
2. Pour une source externe, vérifiez **les droits effectifs** et l'attribution
   avant import. La présence dans le catalogue ou l'origine universitaire ne
   vaut pas autorisation générale de réutiliser un contenu.
3. Préservez les corrections officielles : pas de QCM ou de réponse inventés
   pour faire passer un contrôle de format.
4. Pour le code, contrôlez la compatibilité annoncée, les permissions, les
   nonces et l'échappement des données ; isolez les labs vulnérables.
5. Lancez `php tests/smoke-test.php`, `php tests/audit-test.php`,
   `php tests/sondes-contenu-test.php`, `python3 tests/import-test.py` et
   `python3 tests/archives-test.py`, puis les audits pertinents sur un site de
   test lorsque l'environnement le permet. Documentez les tests non effectués.
6. Proposez une revue avant fusion ; aucune mise en production sans accord.

Les règles de signalement confidentiel sont dans [`SECURITY.md`](../SECURITY.md).
