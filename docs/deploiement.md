# Déploiement vers WordPress

Le dépôt `secura-academy` est versionné sur GitHub. Le workflow
`.github/workflows/deploy.yml` automatise la mise en ligne du plugin et du thème
sur un hébergeur disposant d'un accès SSH.

## Fonctionnement

Deux workflows distincts :

```
.github/workflows/ci.yml
   └─ job verify → php -l sur tous les fichiers PHP
                → php tests/smoke-test.php (26 assertions)
                → contrôle des espaces en fin de ligne

.github/workflows/deploy.yml       (sur push sur main, ou lancement manuel)
   └─ job deploy
        ├─ configuration de la clé SSH
        └─ bash scripts/deploy.sh
             ├─ sauvegarde de la version déployée (tar.gz)
             ├─ rsync du plugin et du thème (avec suppression des fichiers obsolètes)
             └─ contrôle HTTP du site
```

La sauvegarde est créée dans `~/secura-backups/` sur le serveur, avant chaque
synchronisation. En cas de régression, il suffit de décompresser l'archive
correspondante — la procédure complète est décrite plus bas
(« Restaurer une sauvegarde »).

Les sauvegardes sont **purgées automatiquement** : seules les 10 plus
récentes sont conservées (`WP_GARDER_SAUVEGARDES` pour changer ce nombre).
Sans cette purge, les archives s'empilent à chaque déploiement jusqu'à
saturer le disque du serveur.

Tant que les secrets ne sont pas renseignés, `scripts/deploy.sh` affiche
« Secrets de déploiement absents : déploiement ignoré » et se termine en
succès : la CI reste verte et le serveur n'est jamais touché par erreur.

> **Note.** L'URL du site n'est pas déclarée dans `environment.url` : le
> contexte `secrets` n'y est pas autorisé et provoque un rejet du workflow
> ("workflow file issue", aucun job créé). L'adresse publique est passée au
> script via une variable d'environnement.

## Secrets à configurer

Dans **Settings → Secrets and variables → Actions → New repository secret** :

| Secret | Contenu | Exemple |
|---|---|---|
| `WP_HOST` | Nom d'hôte ou IP du serveur | `web.monsite.fr` |
| `WP_SSH_USER` | Utilisateur SSH autorisé | `deploy` |
| `WP_PATH` | Chemin absolu de l'installation WordPress | `/home/deploy/www/monsite` |
| `WP_SITE_URL` | URL publique du site (contrôle HTTP) | `https://monsite.fr` |
| `WP_SSH_PRIVATE_KEY` | Clé privée SSH (format PEM, sans passphrase) | `-----BEGIN OPENSSH PRIVATE KEY-----…` |
| `WP_KNOWN_HOSTS` | Empreintes du serveur, une par ligne | `monsite.fr ssh-ed25519 AAAAC3…` |

### Générer la paire de clés

```bash
# Sur votre machine
ssh-keygen -t ed25519 -C "github-actions@secura-academy" -f ./secura_deploy
cat ./secura_deploy            # → WP_SSH_PRIVATE_KEY
ssh-keyscan -p 22 monsite.fr  # → WP_KNOWN_HOSTS (vérifiez l'empreinte !)
```

Ajoutez ensuite la **clé publique** (`./secura_deploy.pub`) dans
`~/.ssh/authorized_keys` du compte `WP_SSH_USER`, avec des restrictions
(`command="…"` ou `from="…"` si votre hébergeur le permet).

### Récupérer `WP_KNOWN_HOSTS` depuis GitHub

Les runners GitHub sont derrière une adresse IP changeante : ne restreignez pas
l'accès par IP. Utilisez bien `known_hosts` vérifié manuellement.

## Premier déploiement manuel (recommandé)

Avant d'activer le workflow, vérifiez que la synchronisation fonctionne en local :

```bash
rsync -az --delete \
  --exclude '.git' --exclude '.github' \
  wp-content/plugins/secura-academy/ \
  user@host:/home/user/www/monsite/wp-content/plugins/secura-academy/
```

Puis activez le plugin et le thème depuis l'admin WordPress, et vérifiez :

- la page `[secura_academy]` s'affiche ;
- les 6 rooms sont présentes dans **Rooms** ;
- une réponse correcte crédite des XP et débloque un trophée ;
- une réponse incorrecte ne crédite rien et ne révèle pas la bonne réponse.

## Déploiement manuel (sans GitHub Actions)

```bash
rsync -az --delete wp-content/plugins/secura-academy/  user@host:/chemin/wp-content/plugins/secura-academy/
rsync -az --delete wp-content/themes/secura-learning/  user@host:/chemin/wp-content/themes/secura-learning/
```

## Environnement de staging

Le workflow n'exécute le déploiement que sur `main`. Pour tester :

- créez une branche `staging` et déclenchez le workflow manuellement
  (`workflow_dispatch`) ;
- ou dupliquez le job `deploy` avec un `environment: staging` et des secrets
  distincts.

Le job `deploy` utilise déjà la notion d'**environment** GitHub : ajoutez-y les
secrets de staging et une règle de protection (approbation manuelle) si vous
voulez verrouiller la production.

## Après le déploiement

```bash
# Vider les caches WordPress (si WP-CLI est disponible)
wp cache flush --path=/chemin/wordpress

# Vérifier l'état du plugin
wp plugin status secures-academy --path=/chemin/wordpress
```

## Restaurer une sauvegarde

> Une sauvegarde que l'on ne sait pas remettre en place ne sert à rien.
> Voici la procédure exacte, à exécuter **sur le serveur**, en SSH.
> Testez-la d'abord sur un environnement de test, jamais en production
> sans avoir vérifié que la sauvegarde est bonne.

### 1. Lister les sauvegardes disponibles

```bash
ls -lht ~/secura-backups/
```

Vous verrez deux familles de fichiers :

| Fichier | Contenu |
|---|---|
| `secura-AAAAMMJJ-HHMMSS.tar.gz` | le plugin et le thème de la version déployée |
| `base-AAAAMMJJ-HHMMSS.sql.gz` | la base de données (élèves, progrès, médailles) |

### 2. Restaurer le code (plugin + thème)

```bash
cd /chemin/wordpress
tar -xzf ~/secura-backups/secura-AAAAMMJJ-HHMMSS.tar.gz -C /chemin/wordpress
```

### 3. Restaurer la base de données

```bash
cd /chemin/wordpress
gunzip -c ~/secura-backups/base-AAAAMMJJ-HHMMSS.sql.gz | wp db import -
```

> **Attention.** Cette commande **remplace** la base actuelle par la
> sauvegarde : les élèves inscrits et leurs progrès disparaissent.
> Ne l'exécutez que si vous savez que la sauvegarde est la bonne.

### 4. Vérifier

```bash
wp cache flush --path=/chemin/wordpress
wp plugin status secures-academy --path=/chemin/wordpress
curl -fsS -o /dev/null -w 'HTTP %{http_code}\n' https://votre-site
```

### 5. Revenir en arrière plus tard

Le dépôt Git contient tout le code : si le problème vient du code,
`git revert` du commit fautif et redéployez — plus propre qu'une
restauration. La restauration d'archive sert surtout quand le serveur
a été modifié hors Git (ou quand la base est corrompue).

---

## Où sont les machines cibles (labs)

Les machines cibles vivent **hors de WordPress** (pour que WordPress reste
légère et que les images Docker ne soient pas versionnées avec le site).

Deux façons de dire au plugin où elles sont :

1. **Dans l'interface** : *Réglages → Secura Academy → Dossier des labs*,
   par exemple `/opt/secura-labs`. La page affiche en permanence le dossier
   réellement utilisé et signale s'il est absent ou illisible.
2. **Dans `wp-config.php`** (méthode la plus fiable, elle prime sur la
   précédente) :

   ```php
   define( 'SECURA_LABS_PATH', '/opt/secura-labs' );
   ```

Pour déposer les machines fournies :

```bash
# Sur le serveur
sudo mkdir -p /opt/secura-labs
sudo cp -r labs/* /opt/secura-labs/
sudo chown -R www-data:www-data /opt/secura-labs

# Construire les images
docker build -t securalabs/web-01:1.0 /opt/secura-labs/web-01
docker build -t securalabs/bin-01:1.0 /opt/secura-labs/bin-01
docker compose -f /opt/secura-labs/net-01/docker-compose.yml build
```

Le script `scripts/deploy.sh` accepte la variable `WP_LABS_PATH` pour
déposer le dossier `labs/` sur le serveur pendant un déploiement.

---

## Recette serveur (à faire une fois, sur le serveur)

Le site ne peut tourner ses machines de laboratoire que si **Docker est
installé sur le serveur où WordPress tourne** : le plugin appelle la
commande `docker` en local.

La procédure complète (où coller quoi, checklist de 10 lignes, script de
vérification, et que faire quand une ligne échoue) est dans
**[`docs/RECETTE-SERVEUR.md`](RECETTE-SERVEUR.md)**.

En résumé, sur le serveur :

```bash
bash /opt/secura-academy/scripts/recette-serveur.sh
```

Le résultat attendu est `Recette terminee : 22 reussis, 0 echecs`.

## Limites

- Le workflow ne synchronise **que** `wp-content/plugins/secura-academy` et
  `wp-content/themes/secura-learning` : ni la base de données, ni les
  `uploads`, ni `wp-config.php`.
- La migration de base de données éventuelle n'est pas gérée (aucune table
  customisée pour l'instant, tout est en `user_meta`).
- GitHub ne synchronise pas WordPress tout seul : c'est ce workflow qui
  constitue la passerelle.
