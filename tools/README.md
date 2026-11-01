# Outils de travail (hors production)

Ces fichiers ne font pas partie du plugin : ce sont les **outils de
fabrication** du contenu et les **harnais de recette** utilisés pendant le
développement. Ils sont versionnés pour que le travail soit reproductible
(surtout utile quand on ajoute une nouvelle série de cours).

## `contenu-m3/` — fabrique de contenu

Le contenu d'une série de scénarios est produit en trois temps :

| Étape | Outil | Rôle |
|---|---|---|
| 1. Saisie | `m3_qcm_table.py` | Le tableau des questions à choix (une seule bonne réponse, 4 propositions, les distracteurs sont de vraies erreurs d'apprenant). |
| 2. Correction | `m3_patch_json.py` | Ajuste le JSON intermédiaire (drapeaux, services, cohérence desmachine). |
| 3. Génération | `m3_transform.py` | Écrit le fichier PHP du plugin (`includes/content-m3.php`) à partir du JSON. |

Le JSON intermédiaire se trouve dans `/tmp/m3.json` (fichier de travail,
volontairement hors du dépôt : c'est une brouillon, pas une source).

```
python3 tools/contenu-m3/m3_qcm_table.py     # 1. remplit /tmp/m3.json
python3 tools/contenu-m3/m3_patch_json.py     # 2. corrige /tmp/m3.json
python3 tools/contenu-m3/m3_transform.py      # 3. réécrit content-m3.php
php -l wp-content/plugins/secura-academy/includes/content-m3.php   # toujours
```

`m3_transform.py` est **idempotent** : le relancer réécrit le même fichier.

Les deux autres fichiers sont les blocs de tests ajoutés à la main :

* `bloc-test-m3.php` → inséré dans `tests/smoke-test.php` (logique serveur) ;
* `bloc-test-labs-m3.sh` → inséré dans `scripts/test-labs-ci.sh` (machines réelles).

## `recette-apprenants/` — recette « deux élèves en parallèle »

| Fichier | Rôle |
|---|---|
| `scenario.py` | Rejoue le protocole complet en WordPress réel : connexion, ouverture d'une room, déploiement de la machine, commande réelle dans la machine, réponse avec le drapeau. |
| `boucle_pedagogique.py` | Vérifie la boucle pédagogique : progression, verrouillage, XP, médailles. |
| `SCENARIO-*.py` | Copies lisibles des deux scénarios joués à deux (pour le rapport de recette). |

Ils s'exécutent **après** la reconstruction du bac à sable local :

```
bash scripts/wordpress-local.sh
php -S 0.0.0.0:8080 -t /home/user/wp &
python3 tools/recette-apprenants/scenario.py
```

## Règle d'hygiène

Tout ce qui est lourd et reproductible **ne reste pas** dans l'espace de
travail : le WordPress de test est reconstruit par
`scripts/wordpress-local.sh`, les images Docker des machines sont
reconstruites par la CI (`scripts/test-labs-ci.sh`). Le dépôt GitHub reste
la référence.
