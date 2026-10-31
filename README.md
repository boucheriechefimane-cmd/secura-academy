# Secura Academy

Plateforme d'apprentissage de la cybersécurité sous WordPress : des **rooms** guidées,
des exercices corrigés côté serveur, une progression conservée sur le compte de
l'apprenant, des **XP** et des **trophées**.

L'expérience s'inspire des principes d'apprentissage guidé et de gamification
que l'on retrouve chez TryHackMe — parcours court, action suivante évidente,
progression visible — **sans copier** sa marque, ses textes, ses illustrations ni
ses composants propriétaires. L'identité visuelle et éditoriale est originale.

> **Statut : MVP / starter kit.** Ce dépôt est un point de départ fonctionnel, pas
> un produit prêt pour la production. La section [Limites connues](#limites-connues)
> liste ce qui reste à traiter avant une ouverture publique.

---

## Sommaire

- [Ce que contient le dépôt](#ce-que-contient-le-dépôt)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Utilisation](#utilisation)
- [Éditer les rooms](#éditer-les-rooms)
- [Palette et personnalisation](#palette-et-personnalisation)
- [Architecture technique](#architecture-technique)
- [Sécurité](#sécurité)
- [Déploiement](#déploiement)
- [Limites connues](#limites-connues)
- [Prochaines étapes](#prochaines-étapes)
- [Licence](#licence)

---

## Ce que contient le dépôt

```
secura-academy/
├── wp-content/
│   ├── plugins/secura-academy/          # Plugin « Secura Academy »
│   │   ├── secura-academy.php           # Amorçage, constantes, chargement des modules
│   │   ├── includes/
│   │   │   ├── default-rooms.php        # Les 6 rooms FR créées à l'activation
│   │   │   ├── class-secura-rooms.php   # CPT, meta box, contenu par défaut
│   │   │   ├── class-secura-progress.php# XP, progression, trophées, niveaux
│   │   │   ├── class-secura-ajax.php    # Endpoints AJAX (nonces, validation)
│   │   │   └── class-secura-dashboard.php # Shortcode et rendu du tableau de bord
│   │   └── assets/
│   │       ├── academy.css              # Styles du tableau de bord et des rooms
│   │       ├── academy.js               # Interactions (rooms, validation, XP)
│   │       ├── admin.css                # Styles de la meta box d'édition
│   │       └── admin.js                 # Ajout / suppression de questions
│   └── themes/secura-learning/          # Thème sombre et responsive
│       ├── style.css                    # Styles + en-tête du thème
│       ├── functions.php                # Réglages, menus, Personnaliseur (palette)
│       ├── header.php
│       ├── footer.php
│       ├── index.php
│       └── page.php
├── .github/workflows/deploy.yml         # Lint PHP + tests + déploiement vers WordPress
├── tests/smoke-test.php                 # Harnais de vérification de la logique serveur
├── docs/                                # Documentation de déploiement, backlog, passation
├── AUDIT-UX.md                          # Audit UX/UI et décisions de refonte
├── .gitignore
└── README.md
```

## Prérequis

- WordPress **6.0** ou supérieur
- PHP **7.4** ou supérieur
- Un hébergeur avec accès SSH + `rsync` (pour le déploiement automatisé)

## Installation

### Manuelle

1. Copier `wp-content/plugins/secura-academy` dans le dossier `plugins/` de votre installation.
2. Copier `wp-content/themes/secura-learning` dans le dossier `themes/`.
3. Dans l'admin WordPress : **Extensions → Activer** « Secura Academy », puis **Apparence → Thèmes → Activer** « Secura Learning ».
4. L'activation du plugin crée automatiquement **6 rooms en français** (voir plus bas).

### Via l'admin WordPress

Compressez le dossier `wp-content/plugins/secura-academy` en ZIP (le dossier, pas son contenu),
ainsi que `wp-content/themes/secura-learning`, puis téléversez-les via **Extensions → Ajouter → Téléverser** /
**Apparence → Thèmes → Ajouter → Téléverser**.

### Page de parcours

Créez une page et déposez le shortcode :

```
[secura_academy]
```

Options disponibles :

| Attribut | Valeur par défaut | Rôle |
|---|---|---|
| `title` | « Votre parcours de cybersécurité » | Titre du bloc |
| `rooms` | `-1` (toutes) | Nombre de rooms affichées |

## Utilisation

- **Visiteur non connecté** : aperçu du parcours et appel à l'inscription.
- **Apprenant connecté** : tableau de bord personnalisé.
  - Niveau, XP total, rooms terminées, collection de trophées.
  - Barres de progression par room et progression globale du parcours.
  - Les rooms sont **séquentielles** : une room reste verrouillée tant que la précédente n'est pas terminée.
  - Chaque question validée correctement attribue des XP **une seule fois**.
  - La complétion d'une room verse un bonus XP et débloque un trophée.

### Les 6 rooms livrées

| # | Room | Difficulté | Durée |
|---|---|---|---|
| 01 | Penser comme un défenseur | Facile | 20 min |
| 02 | Les fondamentaux du réseau | Facile | 25 min |
| 03 | Sécuriser une application web | Moyen | 35 min |
| 04 | Mémoire et défenses | Moyen | 30 min |
| 05 | Authentification | Moyen | 30 min |
| 06 | Chiffrement et HTTPS | Difficile | 40 min |

> Ces contenus sont des exercices originaux d'introduction. Ce n'est **ni** un cours MIT,
> **ni** une adaptation autorisée de supports MIT, **ni** une reproduction de contenus
> TryHackMe. Voir `docs/PASSATION-SECURA-ARENA.md` pour le cadrage des références.

### Niveaux

| Niveau | Libellé | XP requis |
|---|---|---|
| 1 | Débutant | 0 |
| 2 | Apprenti | 100 |
| 3 | Défenseur junior | 250 |
| 4 | Analyste | 500 |
| 5 | Expert | 900 |
| 6 | Red team | 1500 |

## Éditer les rooms

**Rooms → Ajouter une room.**

- **Titre**, **extrait** et **contenu** : champs WordPress standards.
- **Ordre** : champ « Ordre de la page » (attribut `page-attributes`) — il définit la
  séquence du parcours.
- **Parcours Secura** (meta box) :
  - *Difficulté* — facile, moyen, difficile, expert.
  - *Durée indicative* en minutes.
  - *Bonus XP* à la complétion.
  - *Questions* : énoncé, réponses acceptées (une par ligne), indice, XP.
    Le bouton « + Ajouter une question » crée une ligne supplémentaire.

Une question sans réponse acceptée est ignorée à l'enregistrement : les réponses
ne sont jamais stockées en clair dans le HTML public.

## Palette et personnalisation

**Apparence → Personnaliser → Palette Secura** expose six couleurs :

| Réglage | Variable CSS | Défaut |
|---|---|---|
| Couleur d'accent | `--secura-accent` | `#2dd4a7` |
| Fond principal | `--secura-bg` | `#0b1220` |
| Surfaces | `--secura-surface` | `#131c2e` |
| Bordures | `--secura-border` | `#26344f` |
| Texte principal | `--secura-text` | `#e9eefc` |
| Texte secondaire | `--secura-muted` | `#9db0d0` |

Le plugin consomme ces variables : un changement de palette s'applique au
tableau de bord sans toucher au CSS.

## Architecture technique

### Type de contenu

`secura_room` — type de contenu personnalisé, public, avec `page-attributes`
pour l'ordre du parcours. Les règles de rewriting sont en `rooms`.

### Données apprenant

Tout est stocké en `user_meta` de l'utilisateur connecté :

| Clé | Contenu |
|---|---|
| `secura_xp` | Total de XP accumulés (entier) |
| `secura_progress` | Progression par room : questions résolues, état, XP gagnés |
| `secura_trophies` | Collection de trophées (slug, nom, description, icône, date) |

Ces données sont supprimées avec le compte utilisateur. Elles sont exportables
via les outils d'export WordPress ; il reste à formaliser la politique de
conservation (voir [Limites connues](#limites-connues)).

### Endpoints AJAX

Les deux endpoints sont réservés aux utilisateurs connectés et protégés par un
nonce (`secura_academy`).

| Action | Paramètres | Retour |
|---|---|---|
| `secura_get_room` | `room_id` | Titre, contenu, difficulté, étapes **sans les réponses** |
| `secura_validate_answer` | `room_id`, `question`, `answer` | `correct`, `xp_awarded`, `total_xp`, `new_trophies`, `room_completed` |

### Normalisation des réponses

La comparaison ignore la casse, les accents, les espaces multiples et la
ponctuation finale, afin d'accepter « AES », « aes » ou « AES. » comme la même
réponse. Plusieurs formulations peuvent être déclarées par question.

## Sécurité

- **Les réponses ne quittent jamais le serveur.** Elles ne figurent ni dans le HTML,
  ni dans les attributs `data-*`, ni dans les réponses JSON envoyées au navigateur.
  La vérification est faite côté serveur, à chaque soumission.
- **Nonce WordPress** sur les deux endpoints AJAX, avec expiration native.
- **`current_user_can()`** sur l'enregistrement de la meta box d'édition,
  plus une vérification de nonce et le rejet des révisions automatiques.
- **Sanitisation** systématique des entrées (`sanitize_text_field`,
  `sanitize_textarea_field`, `absint`) et **échappement** à la sortie
  (`esc_html`, `esc_attr`, `esc_url`, `esc_textarea`).
- **Idempotence** : l'XP n'est attribué qu'une seule fois par question et par
  utilisateur, même en rejouant la requête.
- **Restriction aux rooms publiées** : une room non publiée ou d'un autre type
  n'est jamais servie.

## Déploiement

Le dépôt est versionné sur GitHub. Le workflow `.github/workflows/deploy.yml` :

1. vérifie la syntaxe de tous les fichiers PHP (job `lint`) ;
2. sur `push` sur `main`, prend une **sauvegarde** de la version déployée,
   synchronise le plugin et le thème via `rsync`, puis contrôle que le site répond.

La configuration des secrets GitHub est détaillée dans
[`docs/deploiement.md`](docs/deploiement.md).

## Limites connues

À traiter avant une ouverture publique (voir aussi `AUDIT-UX.md`) :

- **Pas de vrais labs.** Le « terminal » est une simulation textuelle guidée ;
  aucun conteneur ni machine n'est exécuté. Ne pas le présenter comme un
  environnement actif.
- **Pas de confirmation par e-mail**, ni mot de passe oublié personnalisé,
  ni anti-spam, ni limitation des tentatives (rate limiting).
- **Pas de page de profil** dédiée, pas de streak fiable, pas de classement,
  pas de recherche ni de filtres dans le catalogue.
- **Suppression / export des données** à formaliser (RGPD) : la progression et
  les trophées vivent dans les `user_meta`.
- **Multi-site** non pris en charge explicitement.
- **Aucune suite de tests end-to-end.** La CI vérifie la syntaxe PHP et exécute
  `tests/smoke-test.php`, un harnais léger qui émule les fonctions WordPress
  utilisées pour tester la normalisation des réponses, les paliers de niveau,
  l'idempotence des XP, la complétion de room et les trophées (26 assertions).
  Le comportement en conditions réelles reste à valider en staging.
- **Revue de sécurité et tests d'accessibilité** à faire avec une version
  WordPress/PHP cible en staging, avant production.

## Prochaines étapes

1. Page de profil avec l'historique de progression et la collection de trophées.
2. Catalogue avec recherche, filtre par difficulté et par durée.
3. Badges configurables et tableau de bord enrichi (voir `docs/backlog.md`).
4. Tests automatisés (PHPUnit + Playwright) et pipeline de staging.
5. Cadre de confidentialité : export, suppression, durée de conservation.

## Licence

Code sous licence **MIT**. Les contenus pédagogiques sont originaux.
Les références bibliographiques (MIT OpenCourseWare 6.858 / 6.857) sont citées
à titre documentaire : vérifier licence, attribution et restrictions avant toute
republication de supports issus de ces cours.
