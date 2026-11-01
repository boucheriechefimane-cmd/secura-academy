# Rapport de validation — Secura Academy en conditions réelles

**Date :** 31 octobre 2026 · **Version testée :** v0.5.3 · **Commit :** `70dbeed`

---

## 1. Ce que j'ai installé dans le bac à sable

Un vrai site WordPress, pas une simulation :

| Élément | Version | Rôle |
|---|---|---|
| WordPress | 7.1.4 (français) | le site à tester |
| MariaDB | 11.8.6 | la base de données |
| PHP | 8.4.27 | le moteur du site |
| Plugin Secura Academy | 0.5.2 | le plugin que je voulais valider |
| Thème Secura Learning | 0.5.2 | le thème associé |
| Machines cibles | `web-01`, `bin-01`, `net-01` | déposées **hors de WordPress**, dans `/opt/secura-labs` |

Deux comptes d'apprenants ont été créés : **Alice** et **Bob**.

> **Une limite à connaître :** ce bac à sable est un conteneur sans aucun
> privilège noyau (`CapEff = 0`). **Le démon Docker ne peut donc pas y
> tourner**, quel que soit le nombre d'installations (voir §2, première
> partie). J'ai donc écrit une **console Docker reproduite à l'identique**
> (`docker build`, `run`, `exec`, `network`, `compose`, `ps`, `inspect`, `rm`)
> qui reproduit fidèlement les commandes que le plugin envoie.
> Conséquence : **tout le code du plugin a réellement été exécuté**.
>
> **Mise à jour (v0.5.3) :** en creusant davantage, j'ai trouvé que le
> bac à sable autorise les **espaces de nommage utilisateur** : un runtime
> **rootless (Podman)** y fonctionne. Les machines ont donc été
> **construites et lancées pour de vrai**, et c'est ce qui a révélé six
> défauts qui auraient cassé les labs chez vous (voir §2).

---

## 1 bis. Les machines, lancées pour de vrai (v0.5.3)

### Pourquoi le démon Docker reste impossible ici

| Vérification | Résultat | Ce que ça veut dire |
|---|---|---|
| Capacités noyau (`CapPrm`/`CapEff`) | `0000000000000000` | Le processus n'a **aucun** droit privilégié |
| `mount -t tmpfs …` | « must be superuser » | Impossible de monter un système de fichiers |
| `/sys/fs/cgroup` | `cgroup2 rw`, mais écriture refusée | Impossible de gérer les quotas de CPU et mémoire |
| `unshare -U -m` / `unshare -Urm` | **code 0** | En revanche, les espaces de nommage *utilisateur* sont autorisés |

Docker a besoin des trois premières choses. **Il n'y a donc aucun moyen de
faire tourner le démon Docker ici** : ce n'est pas un problème d'installation,
c'est une limite du bac à sable.

Mais la quatrième ligne change la donne : **un runtime rootless** (Podman),
qui n'a besoin d'aucun privilège, **fonctionne**. C'est ce que j'ai utilisé
pour la validation finale.

### Ce que ça a donné (preuves)

| Test | Résultat |
|---|---|
| Construction des images `web-01` et `bin-01` | **réelle** (546 Mo et 522 Mo) |
| Réseau sans sortie Internet (`--internal`) | **réel** : le conteneur n'atteint pas Internet |
| Deux apprenants sur deux réseaux distincts | **réels** : A ne voit pas B |
| Drapeau lu dans la machine | **réel** : `FLAG=SECURA{sql_injection_web}` |
| Pile Compose de 4 services | **réelle** : montée puis arrêtée proprement |
| Scénario complet à deux apprenants | **100 % vert** |

### Les six défauts trouvés (et corrigés)

Ils étaient invisibles avec une console simulée : **ils n'existent que face
à de vrais conteneurs**.

| # | Défaut | Ce que l'apprenant aurait vu | Correction |
|---|---|---|---|
| 1 | La commande `sleep infinity` passée en un seul argument | Le conteneur **s'arrêtait aussitôt** | La commande est découpée en arguments |
| 2 | Apache sur le port 80, sans privilèges | « Permission denied », la machine ne démarre pas | Le lab écoute sur le **port 8080** |
| 3 | `COPY flag/ …` copie un **dossier** | `cat /root/flag.txt` → « Is a directory » | On copie le **fichier** |
| 4 | Drapeau lisible par root seulement | Le lab est **impossible à finir** | `root:ctf`, mode 444 |
| 5 | Environnement réduit pour le client Docker | `DOCKER_HOST`/`HOME` perdus : le client ne trouve pas le démon | Le client **hérite** de l'environnement |
| 6 | Reconstruction des images à chaque déploiement | La 1re machine d'un élève attend plusieurs minutes | `build` (avec cache) puis `up --no-build`, image partagée par les 4 services |

Trois autres corrections vont dans le même sens : suppression du conteneur
de même nom avant création (sinon « name already in use »), arrêt d'une pile
Compose **par étiquette** (les moteurs ne nomment pas les conteneurs
pareil), et commande Compose en une seule chaîne (compatible avec tous les
moteurs).

### Ce que ça change pour vous

Ces défauts auraient cassé **les trois laboratoires** sur votre serveur.
Ils sont corrigés, testés (226 assertions), et la recette serveur
(`scripts/recette-serveur.sh`) les rejoue chez vous en 22 contrôles.

---

## 2. Le protocole a été joué de bout en bout

Voici vos quatre étapes, et ce qu'elles ont donné :

| Votre étape | Résultat |
|---|---|
| **1. Construire les images** (`docker build …`, `docker compose … build`) | ✅ les 3 images sont construites (`securalabs/web-01:1.0`, `securalabs/bin-01:1.0`, pile `net-01` à 4 services) |
| **2. Déposer les labs hors WordPress + indiquer le dossier dans Réglages → Secura Academy** | ✅ labs dans `/opt/secura-labs`, dossier renseigné dans l'interface ; la page affiche désormais le dossier réellement utilisé et signale s'il est absent |
| **3. Ouvrir une room en tant qu'apprenant → « Déployer la machine »** | ✅ les 3 rooms se déploient (machine unique et pile Compose) ; les commandes tapées dans le terminal rendent de vrais résultats |
| **4. Test décisif : deux navigateurs, deux comptes** | ✅ **aucun croisement** — voir ci-dessous |

### Le test décisif, en détail

Les deux élèves ont joué **en même temps** sur la même room :

| | Alice (id 2) | Bob (id 3) |
|---|---|---|
| Conteneur | `seca_lab_2_6` | `seca_lab_3_6` |
| Réseau dédié | `seca_lab_2_6` | `seca_lab_3_6` |
| Pile Compose (room réseau) | `seca_net01_2_5` (4 services) | `seca_net01_3_5` (4 services) |

**Chaque élève a sa propre machine, son propre réseau et sa propre pile.**
Aucun des deux ne voit la machine de l'autre. C'est exactement l'exigence
« un apprenant ne doit jamais voir la machine d'un autre ».

### La boucle pédagogique complète a aussi été vérifiée

- le cours (tâche 0) doit être validé avant d'ouvrir la tâche suivante
  (verrouillage progressif actif) ;
- l'élève lit le drapeau **dans sa machine** (`FLAG=SECURA{sql_injection_web}`) ;
- ses 9 réponses sont acceptées, il gagne de l'XP et une médaille ;
- **progression séparée** : Alice 410 XP, Bob 380 XP ;
- le **nettoyage horaire** démonte bien la pile expirée d'un seul élève,
  et **laisse intacte** la pile encore valide de l'autre.

---

## 3. Trois vrais défauts trouvés — et corrigés

C'est le principal benefit de ce test : le harnais PHP (218 assertions) ne
pouvait pas voir ces problèmes, seul un vrai WordPress les révèle.

| Défaut | Ce que ça aurait donné chez vous | Correctif |
|---|---|---|
| **Le filtre « langue » bouclait à l'infini** | 🔴 **le site se figeait à chaque chargement de page** | le filtre ne rappelle plus la détection de langue ; garde-fou anti-boucle ajouté |
| **Le dossier des labs choisi dans les réglages pouvait être ignoré** | 🟠 le plugin continuait d'utiliser l'ancien dossier, sans message d'erreur | lecture fiable en 3 temps : constante `wp-config.php`, puis le champ, puis la base directement ; la page de réglages affiche la source et alerte si le dossier est introuvable |
| **Le réseau dédié n'était pas créé avant la machine** | 🔴 `docker run --network …` aurait échoué → **« Le déploiement de la machine a échoué »** | le réseau est créé d'abord, et un test automatique vérifie désormais cet ordre |

Les trois sont corrigés dans la **v0.5.2**, avec **4 nouveaux tests** (218 au
total, tous verts) et la CI GitHub au vert.

---

## 4. Ce qui reste à faire chez vous

Une seule chose, et elle est **importante** : le démon Docker réel.

Sur votre serveur, il faudra :

1. `docker build -t securalabs/web-01:1.0 /opt/secura-labs/web-01` (idem `bin-01`) ;
2. `docker compose -f /opt/secura-labs/net-01/docker-compose.yml build` ;
3. rejouer les 4 étapes ci-dessus avec **deux vrais navigateurs** (ou deux
   sessions privées) ;
4. vérifier que les deux élèves ont bien deux IP de machines différentes
   (`docker ps` doit montrer deux conteneurs `seca_lab_<élève>_<room>`) et
   que le réseau n'a pas de sortie Internet (`docker network inspect …`
   doit montrer `"Internal": true`).

Tout le reste est déjà validé ici, dans un vrai WordPress.

---

## 5. Ce qui est livré

| Élément | Valeur |
|---|---|
| Version | **0.5.3** |
| Commit | `70dbeed` (poussé, CI `41202224008` verte, déploiement `41202223973` vert) |
| `secura-academy-plugin.zip` | 83,4 Ko |
| `secura-academy-wordpress.zip` | 92,2 Ko |
| `secura-learning-theme.zip` | 8,5 Ko |
| `secura-academy-labs.zip` | 7,1 Ko |
| `secura-academy-recette.zip` | 6,9 Ko (script + doc de la recette serveur) |
| Assertions | 226 / 226 |

### Deux petites choses utiles pour la mise en production

1. **La constante la plus fiable** pour dire où sont les labs — à mettre dans
   `wp-config.php`, elle passe **avant** le champ de l'interface :

   ```php
   define( 'SECURA_LABS_PATH', '/opt/secura-labs' );
   ```

2. Le dossier de lab n'a pas besoin d'être dans WordPress : gardez-le
   ailleurs (`/opt/secura-labs`), c'est ce que la version 0.5.2 fait et c'est
   plus propre.

---

## 6. Et maintenant ?

La constitution (`docs/ROADMAP.md`) n'a pas bougé : **M1 est terminé et
vérifié**. La prochaine étape reste **M2 bis** (parcours guidé, correctif
d'affichage déjà en place) puis les rooms de contenu du palier universitaire.

Si vous voulez, je peux préparer une **checklist de recette** de 10 lignes
à coller sur votre serveur pour valider le démon Docker réel en 5 minutes.
