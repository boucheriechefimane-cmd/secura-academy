# Déploiement vers WordPress

Le dépôt `secura-academy` est versionné sur GitHub. Le workflow
`.github/workflows/deploy.yml` automatise la mise en ligne du plugin et du thème
sur un hébergeur disposant d'un accès SSH.

## Fonctionnement

```
push sur main
   └─ job lint      → php -l sur tous les fichiers PHP (+ contrôle des espaces)
        └─ job deploy (si le lint passe)
             ├─ sauvegarde de la version déployée (tar.gz)
             ├─ rsync du plugin et du thème (avec suppression des fichiers obsolètes)
             └─ contrôle HTTP du site
```

La sauvegarde est créée dans `~/secura-backups/` sur le serveur, avant chaque
synchronisation. En cas de régression, il suffit de décompresser l'archive
correspondante.

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

## Limites

- Le workflow ne synchronise **que** `wp-content/plugins/secura-academy` et
  `wp-content/themes/secura-learning` : ni la base de données, ni les
  `uploads`, ni `wp-config.php`.
- La migration de base de données éventuelle n'est pas gérée (aucune table
  customisée pour l'instant, tout est en `user_meta`).
- GitHub ne synchronise pas WordPress tout seul : c'est ce workflow qui
  constitue la passerelle.
