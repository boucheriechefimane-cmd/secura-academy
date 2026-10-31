# Recette serveur — Secura Academy

> Où coller quoi, et dans quel ordre. Ce document s'adresse à l'administrateur
> du site (pas à l'apprenant).

---

## 1. La réponse courte : où ça se colle

| Où | Ce qu'on y met | Docker possible ? |
|---|---|---|
| **GitHub** (`boucheriechefimane-cmd/secura-academy`) | Le **code** : plugin, thème, labs, documentation. Rien à coller, c'est la source de vérité. | Non (et ce n'est pas le rôle de GitHub) |
| **Votre hébergement Hostinger** | Le **site WordPress** (le plugin, le thème, les cours, les QCM, le certificat). | **Non** : en mutualisé, on ne peut pas lancer de conteneurs. Les cours et les examens fonctionnent, les machines de laboratoire non. |
| **Votre serveur VPS** (le serveur qui a Docker) | Les **machines de laboratoire** (les images Docker) + l'exécution de la recette ci-dessous. | **Oui** |

**Conclusion en une phrase :** la checklist se colle et se lance **sur le
serveur qui a Docker** — c'est-à-dire votre VPS, pas GitHub, pas Hostinger.

### Pourquoi le plugin doit être sur le même serveur que Docker

Le plugin ne « se connecte » pas à Docker à distance : il **appelle la
commande `docker` sur la machine où WordPress tourne**. Concrètement, quand
un apprenant clique sur « Déployer la machine », WordPress exécute :

```
docker run -d --name seca_lab_12_6 --network seca_lab_12_6 …
```

Si Docker n'est pas installé sur ce serveur, la commande n'existe pas et la
machine ne démarre pas. Deux possibilités :

1. **Un seul serveur** (recommandé) : WordPress + Docker sur le même VPS →
   tout fonctionne.
2. **Deux serveurs** : il faudrait ajouter au plugin une connexion à distance
   (protocole Docker ou SSH). Ce n'est pas implémenté ; à prévoir plus tard.

---

## 2. La checklist de 10 lignes à coller sur le serveur

À coller dans un terminal **sur le serveur** (en root ou avec `sudo`).
Elle prépare le serveur et vérifie tout d'un coup.

```bash
sudo apt update && sudo apt install -y docker.io docker-compose-v2 unzip curl   # 1
sudo mkdir -p /opt/secura-labs /opt/secura-academy && cd /opt/secura-academy   # 2
unzip -o secura-academy-labs.zip -d /opt/secura-labs && sudo chmod -R a+rX /opt/secura-labs  # 3
cd /opt/secura-labs && sudo docker build -t securalabs/web-01:1.0 web-01         # 4
cd /opt/secura-labs && sudo docker build -t securalabs/bin-01:1.0 bin-01         # 5
sudo docker compose -f /opt/secura-labs/net-01/docker-compose.yml build          # 6
unzip -o secura-academy-plugin.zip -d /var/www/html/wp-content/plugins/          # 7
unzip -o secura-learning-theme.zip -d /var/www/html/wp-content/themes/           # 8
wp plugin activate secura-academy && wp theme activate secura-learning          # 9
wp option update seca_labs_path /opt/secura-labs && sudo bash /opt/secura-academy/scripts/recette-serveur.sh  # 10
```

**Attendu à la fin :** `Recette terminee : 22 reussis, 0 echecs`.

> Les fichiers `.zip` sont à téléverser sur le serveur au préalable
> (par exemple via `scp`) : `secura-academy-plugin.zip`,
> `secura-learning-theme.zip`, `secura-academy-labs.zip` et
> `secura-academy-recette.zip` (le script de vérification).
> Si vous préférez le dépôt Git :
> `git clone https://github.com/boucheriechefimane-cmd/secura-academy.git`
> (le dépôt étant privé, il faut un jeton personnel — voir §5).

---

## 3. La recette complète, commentée

Le script `scripts/recette-serveur.sh` fait les 10 vérifications suivantes
et affiche `OK` ou `KO` pour chacune.

| # | Ce qui est vérifié | Pourquoi c'est important |
|---|---|---|
| 1 | Docker installé, démon vivant, Compose présent | Sans démon, aucune machine ne démarre. |
| 2 | Plugin installé et actif | Sans lui, pas de laboratoire. |
| 3 | Dossier des labs présent et lisible | Le plugin y cherche les Dockerfiles et la pile Compose. |
| 4 | Images `securalabs/web-01:1.0` et `securalabs/bin-01:1.0` construites | Ce sont les machines cibles des apprenants. |
| 5 | Option `seca_labs_path` renseignée | Dit au plugin où sont les labs. |
| 6 | Création d'un réseau **sans sortie Internet** | Chaque apprenant a son réseau : pas de fuite vers Internet. |
| 7 | Une machine démarre, reste allumée, répond, et son drapeau est lisible | C'est le test « le lab est faisable ». |
| 8 | Deux machines sur deux réseaux : **A ne voit pas B**, et pas d'Internet | C'est le test décisif de l'isolation entre élèves. |
| 9 | La pile réseau (4 services) monte et s'arrête | La room « Les fondamentaux du réseau ». |
| 10 | Aucun reste de test | Pas de conteneurs qui traînent. |

### Lancer la recette

```bash
sudo bash /opt/secura-academy/scripts/recette-serveur.sh
```

Variables facultatives (si votre installation est ailleurs) :

```bash
sudo SECURA_LABS_PATH=/opt/secura-labs \
     SECURA_PLUGIN_DIR=/var/www/html/wp-content/plugins/secura-academy \
     WP_PATH=/var/www/html \
     bash /opt/secura-academy/scripts/recette-serveur.sh
```

---

## 4. Si une ligne affiche « KO »

| KO | Cause probable | Correctif |
|---|---|---|
| « le démon Docker ne répond pas » | Docker n'est pas démarré | `sudo systemctl enable --now docker` |
| « le plugin n'est pas actif » | Activation manquée | `wp plugin activate secura-academy` |
| « l'image … n'existe pas » | Images non construites | Reprendre les lignes 4 et 5 de la checklist |
| « un conteneur du même nom est supprimé… » (étape 7) | Conflit de nom improbable | `sudo docker rm -f seca_recette_*` puis relancer |
| « la machine A voit la machine B » | Les deux machines sont sur le même réseau | Recommencer depuis la ligne 6 (le plugin recrée un réseau par apprenant) |
| « la pile réseau ne démarre pas » | Images de la pile absentes | `sudo docker compose -f /opt/secura-labs/net-01/docker-compose.yml build` |
| « WP-CLI n'est pas installé » | Vérification automatique impossible | Installer WP-CLI (message affiché à l'écran) — sans gravité, le reste est vérifié |

---

## 5. Récupérer le code

Le dépôt est **privé**. Trois façons, de la plus simple à la plus complète :

1. **Les archives `.zip`** (recommandé pour la recette) :
   `secura-academy-plugin.zip`, `secura-learning-theme.zip`,
   `secura-academy-labs.zip` — à téléverser par `scp` ou depuis l'interface
   du serveur.
2. **Git en ligne de commande** (avec un jeton personnel, lu depuis la
   clé SSH du poste) :

   ```bash
   git clone https://github.com/boucheriechefimane-cmd/secura-academy.git /opt/secura-academy
   ```

3. **Depuis le poste de travail**, en SSH :

   ```bash
   scp secura-academy-plugin.zip secura-learning-theme.zip \
       secura-academy-labs.zip utilisateur@votre-serveur:/tmp/
   ```

---

## 6. Après la recette : le test « deux élèves en même temps »

La recette vérifie la mécanique. Le test qui compte, c'est le vôtre :

1. Créez deux comptes élèves (par exemple `alice` et `bob`).
2. Connectez-vous avec `alice` dans un navigateur, avec `bob` dans un autre
   (ou en navigation privée).
3. Dans chaque fenêtre : ouvrez la room « Sécuriser une application web » et
   cliquez sur **« Déployer la machine »**.
4. Vérifiez :
   - chaque fenêtre affiche une adresse de machine **différente** ;
   - dans le terminal, `hostname` donne un nom différent pour alice et bob ;
   - le drapeau de l'un n'apparaît **pas** chez l'autre.

Si ces quatre points sont bons, le laboratoire est opérationnel.

---

## 7. Ce que la recette ne remplace pas

- La **sauvegarde** du site (base de données + fichiers) : à mettre en place
  séparément (cron quotidien de `mysqldump` + `tar`).
- Le **pare-feu** : n'ouvrir que 80 (et 443 si vous servez le site en HTTPS).
  Les réseaux de laboratoire n'ont pas besoin d'être accessibles depuis
  l'extérieur.
- Le **nettoyage automatique** : le plugin démonte les machines expirées
  (1 heure par défaut) et supprime les réseaux devenus inutiles. Une tâche
  cron de secours est recommandée :

  ```bash
  sudo crontab -e
  # puis ajouter :
  0 * * * * docker ps -aq --filter "label=seca.lab=1" | xargs -r docker rm -f
  ```
