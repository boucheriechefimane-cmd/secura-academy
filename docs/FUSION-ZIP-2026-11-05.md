# Fusion sélective du ZIP — 05/11/2026

## Périmètre

Comparaison du ZIP livré avec le dépôt au commit `da510ef`, puis intégration
sur une branche de travail. Le ZIP d'origine et les archives reconstruites
restent **hors dépôt**. Aucun dossier `google_drive/` n'a été réintroduit.
Les fichiers du dépôt plus récents ont été préservés : il n'y a pas eu
écrasement global du dépôt par le ZIP.

Le [rapport d'audit initial](AUDIT-2026-11-05-ZIP-ET-DEPOT.md) conserve le
contexte historique ; cette page indique les décisions prises ensuite.

## Décisions de fusion

| Élément | Décision et raison |
|---|---|
| Campagne d'audit du 04/11 | Les 54 rapports supplémentaires (18 auditeurs, trois formats) sont archivés comme preuves historiques, sans recalcul. |
| Questions importées | Les 49 lots JSON et les 49 PHP générés du dépôt sont conservés. La version ZIP perdait 33 questions et convertissait des corrections rédigées en réponses exactes ou en QCM artificiels. Le test d'import vérifie désormais que les PHP livrés correspondent aux lots validés. |
| Récoltes intermédiaires | `tools/lots/cleaned/`, `tools/lots/recovered/` et `tools/lots-origine-sauvegarde/` restent hors Git et sont ignorés ; les scripts de réécriture automatique non fiables ne sont pas intégrés. |
| Examens, certificats et fronts du ZIP | Quatre classes et deux fichiers JS sont conservés pour revue mais **ne sont pas chargés**. Les points d'entrée AJAX nouveaux ont été retirés et le moteur préexistant conservé. Les défauts comprennent des réponses divulguées, des contrats AJAX incompatibles et des PDF de certificat publics : voir [`EXPERIMENTAL-ZIP.md`](../wp-content/plugins/secura-academy/includes/EXPERIMENTAL-ZIP.md). Ne pas activer avant correction et recette réelle. |
| Dossiers de labs supplémentaires | Les quatre dossiers sont conservés comme prototypes, avec avertissements : trois copient `multi-01`, le quatrième `bin-01`. Ils ne prouvent ni l'existence de nouveaux scénarios Blue/DVWA, ni leur fonctionnement. Les 520 drapeaux redondants ajoutés pendant la fusion ont été retirés ; les drapeaux historiques sont préservés. Voir [`labs/README.md`](../labs/README.md). |
| Orchestrateur et recettes de test du ZIP | Les scripts qui remappaient les rooms, la pile réseau expérimentale et les scripts de test créant des comptes à mot de passe fixe ou modifiant des données ne sont pas intégrés. Leurs originaux restent dans le ZIP. Le Compose Juice Shop et le moteur du dépôt restent inchangés. |
| Attribution du thème | Le bloc supplémentaire du ZIP a été écarté : il doublait la liste des sources du plugin et généralisait à tort l'absence de réécriture à l'ensemble de la page. Les attributions préexistantes restent en place ; leur conformité juridique doit être vérifiée. |
| Sondes de contenu | Les deux sondes sont intégrées avec limites explicites, corrections de décompte et tests simulés. Leurs heuristiques ne remplacent ni une vérification humaine ni une recette WordPress : voir [`README-SONDES-ZIP.md`](../scripts/audit/README-SONDES-ZIP.md). |
| Documentation | Guide développeur, passation et roadmap historique du ZIP sont adaptés ; la pile Compose de passation non validée reste dans le ZIP. Les versions du plugin (`0.13.0`) et du thème (`0.8.4`) distinguent les nouveaux paquets du dépôt initial, sans prétendre que les prototypes sont activés. |

## P0 mécaniques

- `audit_verifier()` sépare les échecs non étayés des constats établis.
  `audit_fin()` bloque les échecs non étayés **bloquants ou majeurs** ; les
  rapports HTML, Markdown et JSON indiquent séparément l'échec et la barrière.
  Un échec mineur ou informatif non étayé rend l'audit incomplet sans bloquer.
  Le lanceur bloque aussi si un auditeur ne peut pas s'exécuter.
- Le contrôle de noms reconnaît notamment le texte, `aria-label`,
  `aria-labelledby`, `title` et l'`alt` d'une image, sans confondre un
  attribut `data-aria-label` avec ARIA. Ce n'est qu'une heuristique : le nom
  calculé, la taille et l'espacement des cibles WCAG 2.5.8 restent à mesurer
  dans un navigateur.
- `LICENSE`, `LICENSES.md` et `SECURITY.md` précisent le périmètre MIT du code
  original annoncé, la GPL-2.0-or-later du thème et les conditions propres
  aux contenus tiers. Les archives contiennent les notices appropriées.
- Le signalement privé GitHub était désactivé ; l'intégration n'avait pas les
  droits pour l'activer (HTTP 403). Un administrateur doit l'activer. Aucun
  canal privé opérationnel ni délai de réponse n'a été inventé.

## Vérifications réalisées et limites

Les commandes ci-dessous ont été exécutées localement avec PHP natif 8.3.31
et Python 3 ; les nouveaux tests sont ajoutés au workflow CI :

```bash
php tests/smoke-test.php            # 333 réussis
php tests/audit-test.php            # 68 réussis, dont le lanceur
php tests/sondes-contenu-test.php   # 12 réussis, WordPress simulé
python3 tests/import-test.py        # 81 contrôles avec PHP disponible
python3 tests/archives-test.py      # 4 tests
```

Le script d'archives a produit les cinq ZIP hors dépôt ; leur intégrité, les
notices, les sources `COPY` des Dockerfiles et le test d'import dans l'archive
recette extraite ont été vérifiés. Cela ne prouve pas que les images se
construisent ou fonctionnent avec Docker. Les archives ne sont pas supposées
identiques octet pour octet aux livrables historiques.

Un analyseur PHP **7.4 émulé en WebAssembly** a aussi vérifié la syntaxe de
129 fichiers PHP et exécuté les 12 contrôles simulés des sondes. Il a révélé
une notation octale incompatible dans `audit-dev.php`, corrigée ici ; la CI
contrôle maintenant aussi la syntaxe des scripts. L'émulateur ne valide pas
les processus enfants : les suites dépendant de `exec` ont été testées en PHP
natif 8.3, pas en PHP 7.4 natif.

La recette complète WordPress, les 18 audits sur un site réel, les tests Docker,
l'isolation entre apprenants et le rendu navigateur restent à effectuer. Les
échecs précédents des workflows étaient liés au quota GitHub Actions ; les
résultats CI du nouveau commit doivent être vérifiés séparément. Ces
validations et la revue des licences vidéo restent nécessaires avant toute
mise en production.
