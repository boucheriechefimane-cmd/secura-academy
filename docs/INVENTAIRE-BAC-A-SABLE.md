# L'inventaire du bac à sable — 04/11/2026

> Ce document dit **ce qui vit dans le bac à sable** et **ce qui peut
> être jeté** sans perdre le travail. Le dépôt GitHub reste la référence :
> tout ce qui est ici est soit reconstructible, soit déjà dans le dépôt.

## Le principe

Trois questions, dans cet ordre :

1. **Est-ce dans le dépôt ?** → alors c'est un doublon : on jette.
2. **Est-ce téléchargeable en une commande ?** → alors c'est un cache : on jette.
3. **Est-ce unique ?** → alors c'est du travail : on **versionne** avant de jeter.

La règle de fond : **le bac à sable n'est pas un lieu de conservation**.
C'est un atelier. Ce qui compte dort dans le dépôt GitHub.

## Ce qui a été jeté le 04/11/2026

| Cible | Poids | Fichiers | Ce que c'était | Pourquoi ça peut disparaître |
|---|---|---|---|---|
| `run/` | **277 Mo** | 1 684 | les documents OCW téléchargés (615 PDF pour 9 cours), les rapports de criblage, les anciens scripts de répartition, les mesures | **re-téléchargeable** : `tools/telecharger-ocw.py` (615 documents en 104 s) et `tools/criblage-ocw.py` (le moteur, en GitHub). Le rapport de criblage est **archivé** dans `docs/recolte/`. |
| `wp/` | **65 Mo** | 3 521 | le WordPress local de test (cœur + plugin + thème + base) | **reconstruit en une commande** : `bash scripts/wordpress-local.sh`. Il était de surcroît **périmé** (plugin en v0.12.0 alors que le dépôt est en v0.12.1). |
| `wp-cli.phar` | **6,9 Mo** | 1 | WP-CLI | **téléchargé** par `scripts/wordpress-local.sh` lui-même. |
| `uploads/` | 44 Ko | 3 | `AUDIT-UX.md`, `PASSATION-SECURA-ARENA.md`, `SCENARIOS-M3.md` | **déjà dans le dépôt** (`AUDIT-UX.md` à la racine, les deux autres dans `docs/`). |

Résultat : **349 Mo vidés**, le bac à sable passe de ~360 Mo à ~11 Mo.

## Ce qui a été **gardé**, et pourquoi

| Cible | Poids | Raison |
|---|---|---|
| `secura-academy/` | 6,6 Mo | le dépôt lui-même |
| `*.zip` (5 archives) | 1,8 Mo | les livrables demandés |
| `bin/git-credential-gh` | 125 o | lit le jeton GitHub dans la configuration de la CLI : c'est **ce qui permet de pousser**, sans jamais écrire le jeton dans le dépôt |
| `bin/docker`, `docker-emulateur`, `docker-podman-shim` | 26 Ko | les substituts de Docker pour les labs (le bac à sable n'a pas de démon Docker) |
| `bin/wp` | 91 o | raccourci vers WP-CLI avec le bon `--path` |
| `.gitconfig` | 213 o | dit à git d'utiliser l'aide-credentials ci-dessus |

## Ce qui a été **versionné** avant d'être jeté

Un seul fichier du bac à sable avait une valeur unique : il ne se trouvait
nulle part ailleurs.

| Fichier | Rôle | Où il est maintenant |
|---|---|---|
| `run/empreinte-questions.php` | l'empreinte des questions normalisées, tâche par tâche : après une correction, **seule la taille de la tâche « test » doit avoir changé**, le contenu doit être identique | `scripts/mesures/empreinte-questions.php` |
| `run/optimiser.py`, `run/redistribuer.py` | la répartition des questions importées dans les rooms | **déjà remplacés** par `tools/repartition-themes.py`, plus juste : il mesure le site au lieu de lire une table figée, et compte par **section** (le moteur tire dans toute la section) au lieu de compter par room |
| `run/lots/*.json` | les anciens lots | **déjà dans le dépôt** (`tools/lots/`), vérifié question par question : **0 question absente** |
| `run/backup-rooms.php`, `run/backup-exam.php` | des sauvegardes du plugin | **obsolètes** : la version du dépôt est plus récente et contient en plus la fonction `reserve` |
| `run/ajout-sources.py`, `run/ajout-portswigger.py` | des one-offs qui écrivaient le catalogue | **obsolètes** : le catalogue est versionné (`tools/sources-autorisees.json`, 32 sources) |
| `run/wp-eval-file.php`, `run/probe-*.php`, `run/mesure-*.php` | des lanceurs de mesures | **déjà dans le dépôt** (`scripts/audit/`, `scripts/mesures/`) |

## Comment on reconstruit ce qui a été jeté

```bash
# le WordPress local de test (télécharge WP-CLI et WordPress, installe,
# copie le plugin et le thème, active, crée deux apprenants de test)
bash scripts/wordpress-local.sh
bash scripts/sync-local.sh          # après chaque modification du plugin

# les documents OCW (mesure : 615 documents de 9 cours en 104 s)
python3 tools/telecharger-ocw.py --cours 6-867-machine-learning-fall-2006 --sortie run/ocw-6-867

# la recolte (le moteur, partage en six, puis fusion)
python3 tools/criblage-ocw.py --shard 0/6 --sortie rapports/rapport-robot-0.json
python3 tools/criblage-ocw.py --fusion rapports/**/rapport-*.json --sortie rapports/criblage-ocw.json
```

## La règle qui évite de refaire ce ménage

**Un fichier qui n'est pas dans le dépôt n'a pas sa place durable dans le
bac à sable.** Dès qu'un script sert à plus d'une fois, il monte dans
`tools/` ou `scripts/` ; dès qu'une mesure sert à comparer, elle monte
dans `scripts/mesures/`. Le reste est un cache, et un cache se jette.
