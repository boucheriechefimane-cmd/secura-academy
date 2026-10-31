# Quel hébergement pour la production ?

> Guide de décision, écrit pour l'administrateur du site.
> Réponse courte : **le mutualisé suffit pour tout sauf les machines de
> laboratoire.** Et la solution la plus simple pour avoir les vraies machines
> est de **rester chez Hostinger mais de passer sur un VPS** (la gamme VPS de
> Hostinger a Docker et l'accès root).

---

## 1. La règle à retenir

Le plugin ne « se connecte » pas à Docker : il **appelle la commande `docker`
sur la machine où WordPress tourne**.

```
élève clique « Déployer la machine »
        ↓
WordPress (sur votre serveur) exécute :  docker run -d --name seca_lab_12_6 …
        ↓
Docker démarre la machine de l'élève
```

Donc : **pour que les vraies machines existent, il faut Docker sur le serveur
qui héberge WordPress.** Point.

---

## 2. Les trois options, avantages et défauts

### Option A — Mutualisé (Hostinger Premium / Unlimited) + lab *simulé*

| | |
|---|---|
| **Prix** | ~2–3 €/mois (engagement 12 à 48 mois) |
| **Docker** | ❌ impossible (pas de root, pas de conteneurs) |
| **Ce que voient les élèves** | les cours, les QCM, les examens chronométrés, les médailles, le certificat, et un **terminal scénarisé** (mode `simulated`, déjà dans le plugin) |
| **Administration** | nulle : hPanel, SSL, sauvegardes automatiques |

**Avantages**
- Le moins cher, de loin.
- Rien à administrer : pas de mise à jour de Linux, pas de « le serveur est tombé ».
- WordPress installé en un clic.
- Le plugin **bascule tout seul** : si Docker est absent, il utilise le
  terminal simulé (`driver: auto` → `docker` si disponible, sinon `simulated`).
  Aucun message d'erreur, aucune page cassée.

**Défauts**
- **Pas de vraies machines** : pas de vraie injection SQL à explorer, pas de vrai
  binaire vulnérable, pas de vrai réseau à deux nœuds.
- L'exercice devient « played » (des réponses attendues) au lieu d'être
  « pratiqué » (on agit et on découvre).

### Option B — Mutualisé + un serveur de lab séparé (2 serveurs)

| | |
|---|---|
| **Prix** | l'abonnement mutualisé **+** un petit serveur |
| **Docker** | ✅ mais sur une *autre* machine |
| **Statut dans le code** | ❌ **non implémenté** |

**Avantages**
- On garde l'hébergement mutualisé bien rangé pour le site.
- Les lab ne consomment pas les ressources du site.

**Défauts**
- Le plugin devrait piloter Docker **à distance** (protocole Docker ou SSH) :
  ce travail n'est **pas fait**, il faudrait l'écrire (~1 à 2 semaines) et le
  sécuriser.
- Deux serveurs = deux sauvegardes, deuxICl, deux factures.
- La latence réseau entre le site et le lab se sent dans le terminal.

> Verdict : à réserver pour plus tard, si le VPS devient trop cher ou trop
> chargé. **Pas maintenant.**

### Option C — Un VPS (Hostinger VPS / KVM) : WordPress **et** Docker sur la même machine

| | |
|---|---|
| **Prix** | à partir de ~5 $/mois (KVM 1 : 1 vCPU, 4 Go de RAM, 50 Go NVMe ; engagement 24 mois) |
| **Docker** | ✅ (accès root, image Ubuntu avec Docker préinstallée en un clic) |
| **Ce que voient les élèves** | les vraies machines : une vraie injection SQL sur une vraie application web Apache/PHP, un vrai binaire vulnérable, un vrai réseau à deux nœuds |
| **Administration** | à faire : sauvegardes, mises à jour de sécurité |

**Avantages**
- **Les vraies machines**, donc la promesse pédagogique tenue : ce n'est pas
  un exerciseur de QCM, c'est une vraie plateforme.
- Un seul serveur, un seul site, une seule facture.
- La recette serveur (`scripts/recette-serveur.sh`) s'applique **telle quelle** :
  10 lignes et 22 vérifications.
- L'isolation entre élèves est réelle (un réseau sans Internet par élève,
  vérifié dans la CI à chaque push).
- Les élèves peuvent faire tourner leurs propres commandes `nmap`, `curl`,
  `python3`… et casser leur machine : c'est le cœur de l'expérience.

**Défauts**
- Il faut installer WordPress + PHP + MariaDB sur le VPS (ou partir d'une
  image hPanel qui les installe).
- Les sauvegardes sont **votre** responsabilité (une tâche cron suffit, cf.
  `docs/RECETTE-SERVEUR.md`).
- Si le VPS s'arrête, le site s'arrête aussi (en mutualisé, c'est l'hébergeur
  qui s'en charge).
- Un VPS mal configuré est plus exposé qu'un mutualisé : le pare-feu et les
  mises à jour comptent.

---

## 3. Ce que je vous recommande, dans l'ordre

### Étape 1 — maintenant : mutualisé + lab simulé

Gardez votre Hostinger mutualisé. Le plugin y fonctionne **immédiatement** :
cours, QCM, examens, médailles, certificat, et le terminal simulé pour les
rooms de lab. Vous pouvez ouvrir la plateforme aux élèves tout de suite,
sans risque et sans coût supplémentaire.

### Étape 2 — quand vous voulez les vraies machines : passer chez Hostinger VPS

Hostinger propose une gamme **VPS (KVM)** avec accès root et des images
prêtes à l'emploi (Ubuntu + Docker en un clic) :

1. hPanel → **VPS** → prendre la plus petite formule (KVM 1 : 1 vCPU, 4 Go
   de RAM, 50 Go de disque — de quoi faire tourner le site *et* quelques
   lab simultanés).
2. Choisir l'image **Ubuntu 24.04 avec Docker**.
3. Vous connecter en SSH (le hPanel donne la commande de connexion).
4. Installer WordPress (ou le partir de l'image hPanel) puis **coller la
   checklist de 10 lignes** de `docs/RECETTE-SERVEUR.md`.
5. Rejouer la recette : `sudo bash /opt/secura-academy/scripts/recette-serveur.sh`
   → attendu : `22 reussis, 0 echecs`.

Le site peut rester sur le mutualisé au début si vous préférez, **mais** les
machines de lab devront alors tourner sur le VPS → c'est l'option B, non
implémentée. Donc : **WordPress et Docker sur le même VPS.**

---

## 4. Le coût comparé

| | Mutualisé (Premium) | VPS KVM 1 |
|---|---|---|
| Prix | 2–3 €/mois (engagement long) | ~5 $/mois + TVA (engagement 24 mois) |
| WordPress | installé en 1 clic | à installer (ou image hPanel) |
| Docker | ❌ | ✅ |
| Lab réel | ❌ (simulé) | ✅ |
| Élèves simultanés sur un lab | illimité (simulé) | quelques dizaines (les lab sont isolés, 512 Mo chacun) |
| Sauvegardes | fournies | à mettre en place (cron) |
| Temps d'administration | ~0 | ~1 h la première fois, puis ~10 min/mois |

**À ce prix-là, le VPS est l'investissement qui fait la différence** : c'est
lui qui permet les vraies machines, qui est le cœur du projet.

---

## 5. Ce qui est déjà prêt dans les deux cas

| Fonction | Mutualisé | VPS |
|---|---|---|
| Cours, leçons, parcours | ✅ | ✅ |
| QCM de validation (3 modes de question) | ✅ | ✅ |
| Examens chronométrés, barème, médailles | ✅ | ✅ |
| Certificat imprimable | ✅ | ✅ |
| Multilingue FR / AR / EN, RTL | ✅ | ✅ |
| Terminal de la room | ✅ simulé | ✅ simulé + vrai terminal de lab |
| Machine lab (web / binaire / réseau) | ❌ → bascule en simulé | ✅ |
| Isolation réelle entre élèves | n/a | ✅ vérifiée à chaque push |

---

## 6. Ce que vous pouvez tester tout de suite, sans rien payer de plus

La CI du dépôt construit et lance **de vraies machines à chaque push** (le
runner GitHub a Docker) :

- `.github/workflows/labs.yml` → construit les 3 images, lance deux machines
  sur deux réseaux distincts, vérifie qu'elles ne se voient pas, que le
  drapeau est accessible, que la pile réseau de 4 services monte et
  s'arrête. Résultat au dernier push : **17 réussis, 0 échec**.

Vous pouvez donc **valider le projet sur GitHub avec Docker** dès aujourd'hui,
sans serveur : c'est exactement ce que ce workflow fait.
