# Labs — machines cibles réelles

**Roadmap :** `docs/ROADMAP.md`, milestone **M1**.
**Statut :** moteur livré (code + tests), 3 machines fournies, branchement
room ↔ machine à faire pour chaque room (5 minutes dans l'admin).

---

## 1. Le principe

Le contrat AJAX ne change pas. Le front appelle `secura_terminal` comme avant ;
c'est le **serveur** qui décide :

```
secura_terminal(room, tâche, commande)
        │
        ├─ la room a un manifeste de lab ET Docker est disponible
        │      └─ Secura_Lab::exec()  → docker exec dans un conteneur éphémère
        │                              → la sortie réelle revient au learner
        │
        └─ sinon
               └─ Secura_Terminal::run() → terminal scénarisé (historique)
```

Le repli est automatique : sur un hébergement mutualisé sans Docker, le site
reste **entièrement utilisable** avec les terminaux scénarisés. Rien n'est cassé,
rien n'est bloqué.

---

## 2. Les deux pilotes

| Pilote | Quand | Ce que l'apprenant voit |
|---|---|---|
| `simulated` | pas de manifeste, ou Docker absent, ou `driver=simulated` | terminal scénarisé (comportement actuel) |
| `docker` | manifeste actif + Docker disponible | **vraie machine**, sortie réelle du conteneur |

`driver=auto` (valeur par défaut) choisit `docker` si possible, `simulated`
sinon. La détection est mise en cache 5 minutes.

---

## 3. Modèle d'isolement

C'est la partie à faire relire avant toute mise en production.

| Mesure | Détail |
|---|---|
| Utilisateur | `--user 1000:1000` : jamais root dans le conteneur |
| Capacités | `--cap-drop ALL` : aucune capacité noyau |
| Escalade | `--security-opt no-new-privileges` |
| Processus | `--pids-limit 256` : pas de fork bomb |
| Ressources | `--memory 512m`, `--cpus 1` |
| `/tmp` | `--tmpfs /tmp:rw,noexec,nosuid,size=32m` |
| Réseau | **un réseau par apprenant et par room** (`seca_lab_<apprenant>_<room>`), créé `--internal` : **aucune sortie Internet**, aucune passerelle vers l'hôte |
| Montages | **aucun** montage de l'hôte, aucun socket Docker exposé |
| Durée de vie | TTL par défaut 1 h, nettoyage horaire (`seca_lab_cleanup`) |
| Unité | un conteneur **par apprenant et par room** : pas de partage, pas de fuite entre élèves |
| Sortie | ANSI retirés, tronquée à 8 Ko |
| Durée d'exécution | 20 s maximum par commande |
| Quota | 120 commandes/minute/apprenant |
| Audit | chaque commande est journalisée dans l'historique du terminal |

### Politique de commandes

- **Blocages systématiques** (non contournables) : `docker`, `nsenter`,
  `mount`, `umount`, `sudo`, `su`, `chroot`, `unshare`, `kubectl`, `crictl`.
- **Liste blanche** par lab (champ « Commandes autorisées »). Vide = tout est
  autorisé, sauf les blocages systématiques. C'est l'isolation qui protège,
  pas le filtre : un lab de fuzzing a besoin de `python3`, `nmap`, `gdb`.
- **Liste noire** complémentaire par lab.

---

## 4. Installer l'hôte

### 4.1 Prérequis

- Docker Engine 24+ (`docker` dans le `PATH` de l'utilisateur du site web) ;
- `proc_open` **non** désactivé dans `php.ini` (`disable_functions`) ;
- un utilisateur dédié, non root, autorisé à parler au socket Docker.

> ⚠ **Point d'attention majeur.** Par défaut, l'utilisateur qui peut parler au
> socket Docker peut **prendre la main sur l'hôte**. C'est équivalent à root.
> Pour un hébergement mutualisé, on ne lance **pas** Docker et on garde le
> mode simulé. Pour un VPS dédié, on crée un utilisateur `seca` sans shell,
> et le site web tourne sous ce même utilisateur.

### 4.2 Réseau dédié

**Aucun réseau à créer à la main.** Depuis la v0.5.1, le plugin crée lui-même
le réseau de chaque apprenant, avec la commande :

```bash
docker network create --internal --driver bridge seca_lab_<apprenant>_<room>
```

Le réseau est **sans sortie Internet** (`--internal`) : les conteneurs ne
peuvent parler qu'entre eux, jamais vers l'extérieur ni vers l'hôte. Il est
supprimé avec la machine.

> ⚠ Ne créez **plus** un réseau `seca_lab` global : un réseau partagé entre
> apprenants permettrait à un élève d'atteindre la machine d'un autre.

### 4.3 Construire les images

```bash
cd /opt/secura-labs
docker build -t securalabs/web-01:1.0 web-01
docker build -t securalabs/bin-01:1.0 bin-01
docker compose -f net-01/docker-compose.yml build
```

### 4.4 Déploiement

Le script `scripts/deploy.sh` copie le plugin et le thème. Les labs vont dans
un dossier **hors WordPress**, par exemple `/opt/secura-labs`, avec des
permissions en lecture seule pour l'utilisateur du site.

---

## 5. Brancher une room à une machine

Dans l'admin : **Rooms → [une room] → Machine cible (lab)**.

| Champ | Exemple (web-01) | Exemple (net-01) |
|---|---|---|
| Activer une machine cible | oui | oui |
| Pilote | Automatique | Automatique |
| Mode | Conteneur unique | Docker Compose (plusieurs nœuds) |
| Image Docker | `securalabs/web-01:1.0` | *(vide)* |
| Fichier docker-compose.yml | *(vide)* | `net-01/docker-compose.yml` (chemin relatif, résolu depuis le dossier des labs) |
| Service à attaquer | *(vide)* | `attacker` |
| Cible affichée | `http://web:80` | `http://web:80` |
| Réseau Docker (préfixe) | `seca_lab` | `seca_lab` |
| Durée de vie | 3600 | 3600 |
| Commandes autorisées | *(vide = toutes)* | `ls`, `cat`, `grep`, `nmap`, `curl`, `python3`, `nc` |

En mode Compose, le plugin lance `docker compose -f … -p … up -d` et exécute
les commandes via `docker compose exec -T <service> bash -lc "<commande>"`.

### Isolation multi-apprenants (résolu en v0.5.1)

Le plugin **suffixe automatiquement** le réseau et le projet Compose :

| Élément | Nom calculé | Exemple (apprenant 5, room 42) |
|---|---|---|
| Conteneur (mode unique) | `seca_lab_<apprenant>_<room>` | `seca_lab_5_42` |
| Réseau Docker | `<prefixe>_<apprenant>_<room>` | `seca_lab_5_42` |
| Projet Compose | `<prefixe>_<apprenant>_<room>` | `seca_net01_5_42` |
| Réseau Compose | `<projet>_seca_lab` | `seca_net01_5_42_seca_lab` |

Le fichier `docker-compose.yml` ne fixe **plus** de nom de conteneur : Compose
nomme les services `<projet>-<service>-1`. Deux apprenants peuvent donc jouer
en même temps, sans jamais se croiser.

Chaque service porte des étiquettes (`seca.lab.user`, `seca.lab.room`,
`seca.lab.project`, `seca.lab.compose`) : le nettoyage horaire retrouve la pile
d'un apprenant et la démonte quand le TTL est dépassé.

### Dossier des labs

Le dossier qui contient les machines se règle dans
**Réglages → Secura Academy → Dossier des labs** (par défaut
`wp-content/secura-labs`). Un chemin relatif dans le champ
« docker-compose.yml » est résolu depuis ce dossier.

---

## 6. Les trois machines fournies

### 6.1 `labs/web-01` — application web vulnérable

- PHP 8.2 + Apache, formulaire de connexion avec **injection SQL**.
- Parcours attendu : scan → robots.txt → injection sur le formulaire →
  session administrateur → lecture du drapeau dans `/root/flag.txt`.
- Indices : `notes.txt` dans `/home/ctf`, sauvegarde `backup/db.sqlite.bak`.
- Drapeau : `SECURA{sql_injection_web}`.

### 6.2 `labs/bin-01` — binaire vulnérable

- Programme C compilé **sans** protections (`-fno-stack-protector -z execstack
  -no-pie`).
- Parcours attendu : `file`/`checksec` → lecture du code → construction de la
  charge utile → shell → drapeau.
- Drapeau : `SECURA{buffer_overflow}`.

### 6.3 `labs/net-01` — réseau à deux nœuds

- Trois services (`attacker`, `web`, `db`) + une cible interne (`internal`).
- Parcours attendu :compromettre `web` → récupérer un accès à `internal` →
  second drapeau. C'est l'introduction au **pivot**.

---

## 7. Ce qui reste à faire (M1)

- [x] Projet Compose et réseau uniques par apprenant et par room (v0.5.1).
- [x] Réseau sans sortie Internet (`--internal`, `internal: true`).
- [x] Rooms de démonstration branchées à une vraie machine (3 rooms).
- [x] Page de réglages pour le dossier des labs et le first blood.
- [ ] **Vérification sur un hôte Docker réel** : le bac à sable de
      développement n'a pas de démon Docker ; la construction des images et le
      test « deux apprenants en parallèle » restent à faire sur le serveur.
- [ ] Rotation des images par digest (`@sha256:…`) au lieu des tags.
- [ ] Rotation des images par digest (`@sha256:…`) au lieu des tags.
- [ ] Répertoire de labs pour **toutes** les rooms de contenu (M3).
- [ ] Journal d'audit accessible à l'admin (commandes jouées, par élève).
- [ ] Test de bout en bout du lab dans la CI (staging).

---

## 8. Avertissement

Ces machines sont **vulnérables par construction**. Elles ne doivent jamais
être déployées sur un réseau de production, ni exposées sur Internet. Elles
sont isolées, éphémères, et détruites à l'expiration.
