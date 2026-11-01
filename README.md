# Secura Academy

Plateforme d'apprentissage de la cybersécurité sous WordPress : des **parcours**,
des **rooms** guidées qui ressemblent à un jeu, des **exercices pratiques** avec
terminal simulé, des **examens chronométrés**, des **XP**, des **médailles** et un
**niveau de progression**. Le tout est **gratuit** et **multilingue**
(français, arabe, anglais).

L'expérience s'inspire des principes d'apprentissage guidé et de gamification
que l'on retrouve chez TryHackMe — parcours court, action suivante évidente,
progression visible, récompense immédiate — **sans copier** sa marque, ses textes,
ses illustrations ni ses composants propriétaires. L'identité visuelle et
éditoriale est originale.

> **Statut : P0 livré.** Le moteur de jeu (modèle de tâches à 4 types,
> **validation croisée QCM + test pratique**, verrouillage progressif, barème
> unifié, médailles, examens chronométrés, parcours, terminal simulé,
> multilingue FR/AR/EN) est implémenté et testé.
> La section [Limites connues](#limites-connues) liste ce qui reste à traiter
> avant une ouverture publique.

---

## Sommaire

- [Ce que contient le dépôt](#ce-que-contient-le-dépôt)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Utilisation](#utilisation)
- [Le modèle de tâches](#le-modèle-de-tâches)
- [Barème, niveaux et médailles](#barème-niveaux-et-médailles)
- [Parcours et sections](#parcours-et-sections)
- [Le terminal simulé](#le-terminal-simulé)
- [Multilingue](#multilingue)
- [Éditer les rooms](#éditer-les-rooms)
- [Palette et personnalisation](#palette-et-personnalisation)
- [Architecture technique](#architecture-technique)
- [Sécurité](#sécurité)
- [Tests](#tests)
- [Déploiement](#déploiement)
- [Limites connues](#limites-connues)
- [Prochaines étapes](#prochaines-étapes)
- [Licence](#licence)

---

## Ce que contient le dépôt

```
secura-academy/
├── wp-content/
│   ├── plugins/secura-academy/             # Plugin « Secura Academy » v0.5.3
│   │   ├── secura-academy.php              # Amorçage, constantes, chargement des modules
│   │   ├── includes/
│   │   │   ├── default-content.php         # 6 rooms × 4 tâches + 2 parcours + traductions AR/EN
│   │   │   ├── content-m3.php               # 10 scénarios M3 × 4 tâches (missions à drapeaux)
│   │   │   ├── class-secura-i18n.php       # Langues FR/AR/EN, direction RTL, traduction du contenu
│   │   │   ├── class-secura-rooms.php      # CPT `secura_room`, méta-box tâches + traductions
│   │   │   ├── class-secura-paths.php      # CPT `secura_path`, sections, progression, certificat
│   │   │   ├── class-secura-progress.php   # Barème XP, niveaux, médailles, examens, streak
│   │   │   ├── class-secura-terminal.php   # Terminal simulé (scénarios serveur)
│   │   │   ├── class-secura-lab.php         # Lab réel : conteneurs Docker isolés
│   │   │   ├── class-secura-ajax.php       # 8 endpoints AJAX (nonce, XP idempotent)
│   │   │   └── class-secura-dashboard.php  # Shortcodes : tableau de bord, lecteur, profil
│   │   └── assets/
│   │       ├── academy.css                 # Design system du jeu (RTL via propriétés logiques)
│   │       ├── academy.js                  # Lecteur de room : validation, terminal, level-up
│   │       ├── admin.css                   # Styles de la méta-box d'édition
│   │       └── admin.js                    # Éditeur de tâches / questions / sections
│   └── themes/secura-learning/             # Thème sombre + RTL (v0.5.3)
│       ├── style.css                       # Styles + jetons de couleur
│       ├── style-rtl.css                   # Ajustements arabe (chargé si la locale est RTL)
│       ├── functions.php                   # Réglages, menus, Personnaliseur (palette)
│       ├── header.php
│       ├── footer.php
│       ├── index.php
│       ├── page.php
│       ├── single-secura_room.php          # Lecteur de room
│       └── archive-secura_room.php         # Catalogue des rooms
├── labs/                                   # Machines cibles réelles (Docker)
│   ├── web-01/                             # Application web vulnérable (injection SQL)
│   ├── bin-01/                             # Binaire C vulnérable (dépassement de tampon)
│   └── net-01/                             # Réseau à deux nœuds (pivot)
├── .github/workflows/ci.yml                 # Lint PHP + tests + espaces fin de ligne
├── .github/workflows/deploy.yml             # Déploiement vers WordPress (rsync + sauvegarde)
├── scripts/deploy.sh                       # Script de déploiement appelé par le workflow
├── tests/smoke-test.php                    # 250 assertions sur la logique serveur
├── docs/
│   ├── ROADMAP.md                          # CONSTITUTION du projet (source de vérité, revue à chaque session)
│   ├── AUDIT-EXPERIENCE-APPRENANT.md      # Audit UX apprenant + comparaison THM + alignement MIT
│   ├── ECARTS-TRYHACKME.md                 # Les 10 écarts face à THM et nos réponses concrètes
│   ├── SOURCES-CONTENU.md                  # Registre des sources : licences vérifiées, attribution
│   ├── labs.md                             # Documentation des labs (isolation, installation, branchement)
│   ├── ANALYSE-UX-TRYHACKME.md             # Analyse UX/UI + comparaison + points à régler
│   ├── CONTENU-MIT.md                      # Plan de contenu inspiré de 6.858 / 6.857 (palier 3 inclus)
│   ├── MODELE-XP-MEDAILES.md               # Spécification barème XP, médailles, examens
│   ├── deploiement.md                      # Configuration du déploiement GitHub → WordPress
│   ├── backlog.md                          # Backlog produit priorisé (P0 livré)
│   └── PASSATION-SECURA-ARENA.md           # Contexte projet d'origine
├── AUDIT-UX.md                             # Audit UX/UI et décisions de refonte
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
3. Dans l'admin WordPress : **Extensions → Activer** « Secura Academy », puis
   **Apparence → Thèmes → Activer** « Secura Learning ».
4. L'activation crée automatiquement **52 rooms** (4 tâches chacune) et **4 parcours** :
   les *Fondations* (6 rooms, 6 modules), les *Scénarios M3* (10 missions réelles,
   5 modules), les *Universités* (22 rooms de cours, 6 modules) et les *Labs
   avancés* (14 rooms : Juice Shop, dojo, briefs, Kahoot), avec leurs
   traductions arabes et anglaises.

### Via l'admin WordPress

Compressez le dossier `wp-content/plugins/secura-academy` en ZIP (le dossier, pas
son contenu), ainsi que `wp-content/themes/secura-learning`, puis téléversez-les via
**Extensions → Ajouter → Téléverser** / **Apparence → Thèmes → Ajouter → Téléverser**.

### Shortcodes

| Shortcode | Rôle |
|---|---|
| `[secura_academy]` | Tableau de bord : niveau, XP, médailles, série, parcours, catalogue des rooms |
| `[secura_academy path="12"]` | Idem, restreint à un parcours (identifiant ou slug) |
| `[secura_academy_room id="12"]` | Lecteur de room (le thème l'utilise automatiquement sur une room) |
| `[secura_academy_profile]` | Profil de l'apprenant : médailles, série, XP |
| `[secura_academy_certificate]` | Certificats de parcours (imprimables) |

Créez une page « Parcours » avec `[secura_academy]` et une page « Mon profil » avec
`[secura_academy_profile]`.

## Utilisation

Le lecteur de room est en **deux volets** sur grand écran : la consigne et les
questions d'un côté, la machine de l'autre. Sur mobile, les deux s'empilent. Le
terminal dispose d'un **historique navigable au clavier** (`↑` / `↓` pour
rappeler une commande, `Ctrl+C` pour abandonner la ligne en cours).


- **Visiteur non connecté** : aperçu du catalogue et appel à l'inscription gratuite.
- **Apprenant connecté** : tableau de bord personnalisé.
  - Niveau, XP total, médailles, série de jours consécutifs.
  - Parcours dépliés en modules, puis en sections, puis en rooms.
  - Les **tâches d'une room se verrouillent** : la tâche N s'ouvre quand la
    précédente est terminée. Les **rooms** d'un parcours restent accessibles
    librement, la progression sert au suivi, pas au cloisonnement.
  - Chaque question validée attribue des XP **une seule fois**.
  - La complétion d'une room verse un bonus XP et une médaille.
  - Animation de passage de niveau et confettis à la complétion d'une room.

### Les 6 rooms de fondations

| # | Room | Difficulté | Durée | Bonus |
|---|---|---|---|---|
| 01 | Penser comme un défenseur | Facile | 20 min | 25 XP |
| 02 | Les fondamentaux du réseau | Facile | 25 min | 25 XP |
| 03 | Sécuriser une application web | Moyen | 35 min | 40 XP |
| 04 | Mémoire et défenses | Moyen | 30 min | 40 XP |
| 05 | Authentification | Moyen | 30 min | 40 XP |
| 06 | Chiffrement et HTTPS | Difficile | 40 min | 60 XP |

> Ces contenus sont des exercices originaux d'introduction. Ce n'est **ni** un cours MIT,
> **ni** une adaptation autorisée de supports MIT, **ni** une reproduction de contenus
> TryHackMe. Voir `docs/PASSATION-SECURA-ARENA.md` pour le cadrage des références.

### Les 10 scénarios M3 (missions vérifiées sur une vraie machine)

| # | Scénario | Difficulté | Durée | Bonus |
|---|---|---|---|---|
| 01 | Le service qui ne répond plus (triage) | Facile | 25 min | 30 XP |
| 02 | Le mot de passe oublié (secret en clair) | Facile | 20 min | 25 XP |
| 03 | La page qui se trahit (XSS + robot) | Moyen | 30 min | 40 XP |
| 04 | La requête qui ne se fie à personne (injection SQL) | Moyen | 30 min | 40 XP |
| 05 | Le fichier qu'on n'aurait pas dû laisser (traversée) | Moyen | 25 min | 35 XP |
| 06 | Qui a forcé la porte ? (journaux) | Moyen | 25 min | 35 XP |
| 07 | Le réseau qui parle trop (ports, cartographie) | Moyen | 30 min | 40 XP |
| 08 | Traverser le mur (pivot) | Difficile | 40 min | 60 XP |
| 09 | Le binaire qui obéit trop (mémoire) | Difficile | 40 min | 60 XP |
| 10 | Le certificat qui ne prouve rien (TLS) | Difficile | 35 min | 55 XP |

Chaque mission se termine par une **preuve** : le serveur va lire le drapeau
**dans la machine de l'apprenant** (en root) et compare. Recopier une réponse
n'est pas possible. L'audit complet (difficulté par étape, ce que les tests
prouvent ou non, alignement MIT, cours externes) est dans
[`docs/SCENARIOS-M3.md`](docs/SCENARIOS-M3.md).

## Le modèle de tâches

Chaque room suit le même patron, calqué sur la progression pédagogique d'un jeu :

| Étape | Type | Format | Rôle | XP (base difficulté « moyen ») |
|---|---|---|---|---|
| 1 | `lesson` | `lecon` | Le contenu théorique, court et actionnable | 0 |
| 2 | `practice` | `qcm` | Entraînement guidé, indices disponibles | × 0,5 |
| 3 | `test` | `mixte` | Mise en situation : questions **et** terminal | × 1,0 |
| 4 | `exam` | `qcm` | Examen chronométré, sans indice, avec seuil | × 1,5 |

Chaque question porte : un énoncé, des réponses acceptées, un XP, un indice, une
**explication pédagogique** et un poids de calcul du score.

**L'explication n'est révélée qu'après la réussite** — c'est la récompense
pédagogique. Un échec affiche le message « Pas encore, réessayez » et l'indice
de la question, mais pas la solution. À la fin de la tâche, un récapitulatif
révèle toutes les explications, y compris celles des questions ratées : c'est le
« voir mes erreurs » qui fait progresser.

## Validation croisée : le QCM valide, la manipulation pratique

C'est le cœur du modèle : **le QCM n'est pas remplacé par la pratique, il la
complète**. Chaque tâche porte un **format** affiché dans l'interface :

| Format | Signification | Condition de réussite |
|---|---|---|
| `lecon` | Contenu théorique court | Lecture validée |
| `qcm` | Test de validation par questions | Score ≥ seuil de la tâche |
| `pratique` | Manipulation d'une machine (terminal) | Scénario du terminal terminé |
| `mixte` | Les deux : questions **et** manipulation | Les deux conditions réunies |

### Les trois types de question (v0.5.0)

Une question n'est pas forcément une phrase à orthographier. Depuis la
v0.5.0, l'éditeur choisit le type, et le serveur valide en conséquence :

| Type | Ce que l'apprenant fait | Ce que le serveur vérifie |
|---|---|---|
| `text` | Il tape une réponse | la réponse normalisée est dans la liste acceptée |
| `choice` | Il choisit une proposition | la proposition choisie est la bonne |
| `action` | Il **confirme avoir réalisé l'action** | **l'état réel du terminal** : impossible de valider une action non faite |

Les questions `choice` se traduisent (FR/AR/EN) comme les énoncés, et la
bonne réponse **n'est jamais envoyée au navigateur** (vérifié par les tests).

Règles appliquées côté serveur :

- **Le seuil (`pass_score`) est effectif.** Une tâche réglée à 60 % est réussie
  à 60 % — ce n'est plus une information décorative. Sans seuil explicite, la
  barre reste à 100 %.
- **Une tâche pratique sans questions** est validée par son scénario de
  terminal, et par lui seul : unanswered ne veut pas dire « réussi ».
- **Les 6 rooms livrées** comportent chacune un **test pratique jouable** dans
  un terminal simulé, en complément de leur QCM de validation.
- **Une question est réservée avant d'être créditée** (`Secura_Progress::claim_question()`) :
  deux requêtes simultanées ne peuvent pas se partager la récompense, l'XP
  n'est donc versé qu'une seule fois, même en concurrence.
- **Un examen raté se repassse.** Le chronomètre repart de zéro, le meilleur
  score et le bonus déjà versé sont conservés. Un examen **réussi** n'est jamais
  relancé automatiquement : il faut le demander explicitement (bouton
  « Recommencer l'examen »), pour ne pas encourages le farm de points.

## Barème, niveaux et médailles

### Formule

```
points = base(difficulté) × multiplicateur(type) × rang(first blood) × malus(indice)
```

| Difficulté | Base |
|---|---|
| Facile | 10 |
| Moyen | 15 |
| Difficile | 20 |
| Expert | 30 |

Multiplicateur de rang (« first blood ») : **désactivé par défaut**. Quand il est
activé, le premier à répondre juste obtient ×2, le deuxième ×1,8, le troisième
×1,7, le quatrième ×1,65, les suivants ×1,5. L'option se règle dans les réglages
du plugin (`secura_first_blood`) et s'appuie sur une table de statistiques.

Malus d'indice : **−50 %** sur la question concernée.

Bonus de complétion de room : `xp_bonus` de la room, **+25 %** si aucun indice
n'a été utilisé sur l'ensemble de la room.

### Les 12 niveaux

| # | Niveau | XP requis | | # | Niveau | XP requis |
|---|---|---|---|---|---|---|
| 1 | Observateur | 0 | | 7 | Spécialiste | 2 500 |
| 2 | Apprenti | 100 | | 8 | Architecte | 3 500 |
| 3 | Analyste | 250 | | 9 | Défenseur | 5 000 |
| 4 | Traceur | 500 | | 10 | Éclaireur | 7 000 |
| 5 | Auditeur | 900 | | 11 | Sentinel | 10 000 |
| 6 | Pourfendeur | 1 500 | | 12 | Maître | 15 000 |

### Les médailles

| Médaille | Condition |
|---|---|
| 🥉 Bronze | score ≥ 60 % |
| 🥈 Argent | score ≥ 80 % **et aucun indice** |
| 🥇 Or | score = 100 % **et aucun indice** |

Une médaille ne descend jamais : obtenir l'or après le bronze remplace le bronze.

## Parcours et sections

Le type de contenu `secura_path` décrit un parcours : une liste de **sections**,
chaque section contenant une liste de **rooms**. La méta-box permet d'ajouter,
renommer et réordonner les sections, de choisir les rooms, la durée totale, la
difficulté, le bonus XP et l'activation du certificat.

La progression d'un parcours est calculée à partir des rooms terminées. Quand
toutes les rooms d'un parcours sont terminées, une médaille de parcours est
attribuée et le bonus XP du parcours est versé.

Si l'option **certificat** est activée sur le parcours, un certificat nominatif
apparaît alors dans le tableau de bord : nom de l'apprenant, titre du parcours,
nombre de rooms validées, XP cumulés, date et médaille. Il s'imprime depuis le
navigateur (bouton « Imprimer »), la feuille de style d'impression n'affichant que
le certificat.

## Le terminal simulé

Certaines tâches « test » embarquent un terminal **simulé** : aucune machine réelle
n'est exécutée, le scénario est entièrement évalué côté serveur.

- Une commande correspond à une étape : soit une **comparaison exacte** (insensible
  à la casse), soit une **expression régulière** entre slashes (`/cat config\.txt/`).
- Une commande inconnue affiche la réponse du scénario et propose un indice.
- L'historique est conservé côté serveur (40 dernières entrées) et l'état du
  terminal est persisté dans le `user_meta`.
- Une question peut exiger d'avoir exploré le terminal (`requires_step`) : le
  serveur refuse la réponse tant que l'étape n'est pas atteinte.

> Le terminal est un jeu de rôle scénarisé. Ne jamais le présenter comme un
> environnement d'attaque réel.

## Le lab réel : une vraie machine déployable

Le terminal scénarisé reste le mode par défaut (il fonctionne partout, y
compris sur mutualisé). Mais une room peut maintenant **déployer une vraie
machine** : un conteneur Docker éphémère, isolé, propre à un apprenant.

- **Un conteneur par apprenant et par room** : pas de partage, pas de fuite
  entre élèves. L'isolation est assurée par Docker, pas par une simulation.
- **Un réseau par apprenant et par room** (`seca_lab_<apprenant>_<room>`),
  créé **sans sortie Internet** : les conteneurs ne peuvent parler qu'entre
  eux. En mode Compose, le projet est lui aussi renommé par apprenant
  (`seca_net01_<apprenant>_<room>`) et aucun nom de conteneur n'est figé :
  deux élèves peuvent jouer en même temps sans jamais se croiser.
- **Durcissement systématique** : utilisateur non-root (`1000:1000`),
  `--cap-drop ALL`, `no-new-privileges`, `--pids-limit`, limites CPU/mémoire,
  `/tmp` en tmpfs `noexec`, aucun montage de l'hôte, aucun socket Docker exposé.
- **Durée de vie** : une heure par défaut, nettoyage horaire automatique.
- **Commandes** : 20 s maximum par commande, sortie tronquée à 8 Ko, séquences
  ANSI retirées, 120 commandes/minute/apprenant, historique journalisé.
- **Politique** : `docker`, `sudo`, `nsenter`, `mount`, `chroot`… sont bloqués
  par défaut ; une liste blanche/blanche-noire par lab est configurable.
- **Repli automatique** : sans Docker sur l'hébergement, le terminal simulé
  prend le relais. Le site ne casse jamais.

Le contrat AJAX ne change pas : c'est le serveur qui choisit le pilote. Trois
machines sont fournies prêtes à construire (`labs/`) : une application web avec
injection SQL, un binaire C avec dépassement de tampon, un réseau à deux
nœuds pour apprendre le pivot, une machine multi-usages (`multi-01`) qui sert
sept scénarios, le nœud interne (`internal-01`) du pivot, la salle des cours
(`univ-01`), le dojo (`dojo-01`) et le lab OWASP Juice Shop. **Les 52 rooms
sont déjà branchées** ; le réglage se fait dans l'admin, ou dans
**Réglages → Secura Academy** (dossier des labs, first blood). Tout est
détaillé dans [`docs/labs.md`](docs/labs.md).

> **Déjà vérifié** : la construction des images et le test « deux apprenants
> en parallèle » sont rejoués **à chaque push** par GitHub Actions, qui dispose
> de Docker (`scripts/test-labs-ci.sh`, 42 contrôles : isolation, drapeaux,
> pile réseau, rejeu des 10 scénarios M3).

> ⚠ Docker reste un surface d'attaque majeure : un utilisateur autorisé à
> parler au socket Docker peut prendre l'hôte. Sur mutualisé, on garde le mode
> simulé.

## Multilingue

Trois langues sont fournies d'emblée : **français**, **arabe** et **anglais**.

- L'interface (dictionnaire complet FR/AR/EN) est traduite.
- Le contenu (titre, extrait, corps, titres de tâches, énoncés, indices,
  explications) est traduit via la méta-box **Traductions** de chaque room.
- L'arabe passe le document en **RTL** : `dir="rtl"` sur l'interface, propriétés
  CSS logiques dans le plugin, feuille `style-rtl.css` pour le thème.
- Résolution de la langue : paramètre `?lang=` → choix enregistré dans le compte
  → locale du site → français par défaut.
- Le choix « Arabe / English / Français » est disponible dans le tableau de bord
  et sur la page de profil, et mémorisé dans le compte.

Le stockage en méta de post rend la plateforme **autonome** (aucun plugin
multilingue tiers nécessaire) tout en restant compatible avec les standards
WordPress et avec les outils d'export.

## Éditer les rooms

**Rooms → Ajouter une room.**

- **Titre**, **extrait** et **contenu** : champs WordPress standards.
- **Ordre** : champ « Ordre de la page » (attribut `page-attributes`).
- **Parcours Secura** (méta-box) :
  - *Difficulté* — facile, moyen, difficile, expert.
  - *Durée indicative* en minutes.
  - *Bonus XP* à la complétion.
  - *Tâches* : une ligne par tâche, avec le **type** (leçon, entraînement, test,
    examen), le titre, le contenu HTML, la durée et le seuil (examens), le
    terminal simulé en JSON, et les questions.
- **Question** : énoncé, réponses acceptées (une par ligne), explication,
  indice, XP, poids, étape de terminal requise.
- **Traductions** (méta-box) : une fiche par langue pour le titre, l'extrait,
  les corps de tâche, les énoncés, les indices et les explications.

**Parcours → Ajouter un parcours** : titre, extrait, sections, rooms par section,
durée totale, bonus XP, certificat.

Une question sans réponse acceptée est ignorée à l'enregistrement. Les réponses
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

### Types de contenu

| CPT | Slug | Rôle |
|---|---|---|
| `secura_room` | `rooms` | Une room = 4 tâches |
| `secura_path` | `parcours` | Un parcours = sections de rooms |

### Données apprenant

Tout est stocké en `user_meta` de l'utilisateur connecté :

| Clé | Contenu |
|---|---|
| `secura_xp` | Total de XP accumulés |
| `secura_progress` | Progression par room : questions résolues, indices, tâches terminées |
| `secura_medals` | Médailles (clé, niveau, score, date) |
| `secura_exams` | État des examens (horodatage de départ, score, réussite, bonus versé) |
| `secura_terminals` | État des terminaux simulés (étape courante, historique) |
| `secura_streak` | Série de jours consécutifs |
| `secura_lang` | Langue choisie |
| `secura_ranks` | Rang « first blood » par question |

La table `{prefix}secura_answer_stats` compte les réponses correctes par question
pour le classement « first blood » (désactivé par défaut).

### Endpoints AJAX

Tous les endpoints sont réservés aux utilisateurs connectés et protégés par un
nonce (`secura_academy`).

| Action | Paramètres | Rôle |
|---|---|---|
| `secura_get_room` | `room_id` | Room, tâches, verrous, progression |
| `secura_get_task` | `room_id`, `task`, `reveal` | Contenu, questions **sans les réponses**, terminal sans les sorties |
| `secura_validate_answer` | `room_id`, `task`, `question`, `answer` | Validation, XP, explication, médailles |
| `secura_hint` | `room_id`, `task`, `question` | Indice (tracé, coûte −50 %) |
| `secura_terminal` | `room_id`, `task`, `command` | Exécution dans le terminal simulé |
| `secura_complete_lesson` | `room_id`, `task` | Validation d'une leçon |
| `secura_start_exam` | `room_id`, `task`, `force` | Démarrage du chronomètre d'examen (`force=1` pour repasser un examen réussi) |
| `secura_set_lang` | `lang` | Changement de langue du compte |
| `secura_lab_start` | `room_id` | Déploiement de la machine cible |
| `secura_lab_stop` | `room_id` | Arrêt de la machine cible |
| `secura_lab_status` | `room_id` | État de la machine (déployée, expirée, indisponible) |

### Normalisation des réponses

La comparaison ignore la casse, les accents, les espaces multiples et la
ponctuation finale : « AES », « aes » ou « AES. » sont la même réponse. Plusieurs
formulations peuvent être déclarées par question.

## Sécurité

- **Les réponses ne quittent jamais le serveur.** Elles ne figurent ni dans le HTML,
  ni dans les attributs `data-*`, ni dans les réponses JSON envoyées au navigateur.
  La vérification est faite côté serveur, à chaque soumission.
  *Cette propriété est vérifiée par le harnais de tests.*
- **Nonce WordPress** sur les huit endpoints AJAX, avec expiration native.
- **`current_user_can()`** sur l'enregistrement des méta-box, plus une
  vérification de nonce et le rejet des révisions automatiques.
- **Sanitisation** systématique des entrées (`sanitize_text_field`,
  `sanitize_textarea_field`, `absint`, `wp_kses_post` sur le contenu pédagogique)
  et **échappement** à la sortie (`esc_html`, `esc_attr`, `esc_url`, `esc_textarea`).
- **Idempotence** : l'XP n'est attribué qu'une seule fois par question et par
  utilisateur ; le bonus d'examen n'est versé qu'à la **première réussite**.
- **Chronométrage serveur** : le minuteur d'examen est piloté par `started_at`
  côté serveur ; le navigateur ne peut pas l'allonger.
- **Verrouillage serveur** : le refus de valider une question d'une tâche non
  déverrouillée est appliqué côté serveur, pas seulement masqué dans l'interface.
- **Réservation atomique** : une question est marquée comme résolue *avant*
  l'attribution de l'XP ; deux requêtes concurrentes ne crédite donc jamais
  deux fois la même réponse.
- **Limitation de débit** : 40 validations par minute et par utilisateur sur
  l'endpoint de validation ; au-delà, la requête est refusée (`slow_down`).
- **Schéma de progression versionné** (`secura_progress.__schema`) : une
  progression enregistrée avant une évolution du moteur est migrée
  automatiquement au format courant, sans perte.

## Tests

```bash
php tests/smoke-test.php
```

Le harnais émule les fonctions WordPress nécessaires et vérifie **250 assertions** :
normalisation des réponses, paliers de niveau, barème et multiplicateurs,
attribution et idempotence des XP, malus d'indice, verrouillage progressif,
score pondéré, médailles, examens chronométrés (démarrage, expiration, nouvelle
tentative, bonus versé une seule fois), terminal simulé (correspondances exactes
et expressions régulières, progression, indices), multilingue (dictionnaires,
direction RTL, traduction partielle), structure des rooms et des parcours,
contenu de démonstration, délivrance du **certificat de parcours**, et **contrat
AJAX** (les réponses attendues ne sont jamais envoyées au client, l'explication
n'est révélée qu'après la réussite). La **validation croisée** est couverte :
seuil de passage effectif, tâche pratique validée par son scénario, réservation
atomique d'une question, reprise d'un examen raté, formats de tâches,
terminal dans chacune des 6 rooms, limitation de débit et migration du schéma
de progression. Le **moteur de lab** est couvert lui aussi : normalisation du
manifeste, repli automatique sans Docker, politique de commandes (listes
blanche/noire, blocages systématiques), nettoyage de la sortie et troncature.

La CI exécute en plus le lint PHP de tous les fichiers et le contrôle des espaces
en fin de ligne.

### La recette complète, dans GitHub (et plus seulement dans le bac à sable)

Le workflow `wordpress.yml` installe un **vrai WordPress** (MySQL en service,
plugin et thème du dépôt, pack de langue arabe) et rejoue la recette de bout
en bout : le site répond en français, en arabe et en anglais, les 52 rooms et
les 4 parcours existent, un QCM se valide, l'XP monte, une mauvaise réponse est
refusée, et la bonne réponse ne quitte jamais le serveur.

Il le fait **avec** les plugins que le site pourrait héberger (Polylang,
LiteSpeed Cache, Elementor, Contact Form 7, WooCommerce) : voir
[`docs/COMPATIBILITE-PLUGINS.md`](docs/COMPATIBILITE-PLUGINS.md).

## Déploiement

### Le comité d'audit externe

**Quinze auditeurs spécialisés** passent la plateforme au crible **dans un
vrai WordPress**, sur les pages réellement rendues, et dans de vrais
conteneurs Docker quand il faut juger l'isolation entre élèves. Le workflow
`audit.yml` échoue si un constat bloquant apparaît ; il rejoue les audits à
chaque push et chaque lundi.

| | Spécialités |
|---|---|
| **Les cinq premiers** | SEO · Contenu · UX/UI · Développement · Sécurité & infra |
| **Les dix nouveaux** | Pédagogie · Performance & Core Web Vitals · Données structurées · Accessibilité (WCAG 2.2 AA) · Multilingue · RGPD & mineurs · Moteur de lab & Docker · Onboarding · Licences & attribution · DevOps & résilience |

**La règle de méthode : pas de rapport sans preuve.** Un auditeur n'a le
droit de conclure que s'il a **joué un scénario, lu une ligne de code ou
mesuré une valeur**. Un constat sans preuve est *rejeté*. Chaque rapport
HTML reproduit la preuve sous chaque constat, et indique aussi ce que
l'audit **ne peut pas** mesurer.

Historique : **93 contrôles, 8 constats réels, tous corrigés** → **108
contrôles, 0 constat** (conformité au guide Google sur l'IA) → **118
contrôles, 0 constat** (robots d'IA et maillage interne) → **196 contrôles,
0 constat** (le comité des quinze, bloc T) → **199 contrôles, 0 constat**
(v0.8.1 : deux défauts trouvés en rejouant la recette à la main, chacun
corrigé **et** muni d'un garde-fou automatique) → **200 contrôles, 0
constat** (v0.8.2 : un défaut que **la CI seule** a pu trouver — les pages
légales n'existaient que sur un serveur web, jamais en ligne de commande,
où WP-CLI charge WordPress dans une portée de fonction ; corrigé par une
fonction, vérifié explicitement à l'installation, et deux contrôles
automatiques interdisent le retour de la faute) → **202 contrôles, 0
constat** (v0.8.3 : la feuille de style arabe était déclarée à une adresse
qui n'existait pas — **404**, donc mise en page arabe jamais appliquée ;
corrigée, et un contrôle **bloquant** vérifie désormais que toutes les
feuilles de style d'une page se chargent) → **203 contrôles, 0
constat** (v0.8.3-bis : un saut de titre `h1` → `h3` dans la room
« Kahoot », trouvé par la CI et invisible en local — parce que le contrôle
d'accessibilité **tirait une room au hasard** ; corrigé, et **aucun audit
ne tire plus au sort** : les 53 pages et le titre de chaque room sont
vérifiés à chaque passage).

Ce que les quinze auditeurs ont trouvé — et fait corriger : les pages légales
qui n'existaient pas, l'invitation à s'inscrire que le visiteur anonyme ne
recevait pas, la création de compte bloquée, les parcours sans certification,
les entités HTML illisibles dans le JSON-LD, les workflows sans limite de
temps, les sauvegardes jamais purgées, l'absence de procédure de
restauration, le sens de lecture arabe non posé sur le document — et **la
barrière bloquante qui ne bloquait pas**.

Et ce que la **recette jouée à la main** a trouvé après coup, que les
contrôles automatiques n'avaient pas vu : les **boutons de la page qui ne
faisaient plus rien** (le nom des actions AJAX avait été raccourci dans le
plugin seulement — le site était cassé pour les élèves, sans laisser la
moindre trace dans les journaux), et le mot « fonctionnalités » **écrit en
coréen** dans la politique de confidentialité — invisible à l'écran, mais
public via l'API REST. Les deux sont corrigés, et **deux contrôles
automatiques** vérifient désormais qu'ils ne reviennent pas.

Le cadre est dans [`docs/AUDITS-CADRE.md`](docs/AUDITS-CADRE.md), le
registre des constats dans [`docs/AUDITS-REGISTRE.md`](docs/AUDITS-REGISTRE.md).

### Où mènent les parcours, et à quel prix

Chaque parcours affiche la **certification réelle** qu'il prépare, avec le
coût exact de l'examen — parce qu'un élève de 12 ans ne doit pas découvrir à
l'examen qu'il fallait payer.

| Parcours | Certification visée | Coût de l'examen |
|---|---|---|
| Fondations (6 rooms) | CompTIA **Security+ SY0-701** | 439 $ (préparation gratuite) |
| Scénarios M3 (10 rooms) | **eJPT** (eLearnSecurity) | ≈ 249 $ |
| Les universités (22 rooms) | **Google Cybersecurity Professional Certificate** | 49 $/mois (vouchers gratuits existants) |
| Les labs avancés (14 rooms) | **PortSwigger Web Security Academy → BSCP** | Académie gratuite, examen séparé et payant |

Le catalogue mondial du contenu gratuit (MIT OCW, Harvard CS50, pwn.college,
Stanford SEE, CYBER.ORG, OWASP, freeCodeCamp, Fortinet NSE…) et le détail
honête de ce qui est **gratuit** et de ce qui est **payant** sont dans
[`docs/CERTIFICATIONS.md`](docs/CERTIFICATIONS.md).

### La conformité aux réponses générées par l'IA (guide Google)

Le guide officiel de Google sur l'optimisation pour l'IA (AI Overviews,
AI Mode) a été audité **point par point**, sur les pages réellement servies.
Six écarts réels ont été trouvés et corrigés : adresses de langue en version
relative, absence d'adresse canonique, absence de données structurées
(schema.org), vidéo du cours non déclarée, room sans titre de section, étapes
pratiques dessinées par le JavaScript seulement.

Résultat : `hreflang` en adresses absolues, **canonique auto-référente par
langue**, `Organization` / `LearningResource` / `VideoObject` /
`BreadcrumbList` / `Course` déclarés, et **15 contrôles supplémentaires**
dans l'auditeur SEO (rejoués à chaque push). Le compte rendu en langage simple
est dans [`docs/SEO-GENERATION-AI.md`](docs/SEO-GENERATION-AI.md).

### Les robots d'IA et le maillage interne (v0.7.0)

Le `robots.txt` est écrit par le plugin : il **nomme** les robots au lieu de se
contenter d'un `User-agent: *` muet, en deux sections qui disent la vérité —
les robots de **recherche et de citation** (Googlebot, OAI-SearchBot,
ChatGPT-User, Claude-SearchBot, Claude-User, PerplexityBot…) et les robots
d'**entraînement** (GPTBot, ClaudeBot, Google-Extended, Applebot-Extended,
CCBot…). Google rappelle dans son guide que `Google-Extended` **ne** contrôle
pas les AI Overviews : c'est `Googlebot` qui le fait.

Un `llms.txt` est fourni — mais **généré à partir du contenu réel**, donc il
ne peut pas devenir faux.

Le second audit, refait à la main, a trouvé **dix écarts réels** que
l'automatique ne voyait pas. Le plus grave : les **52 rooms n'étaient
atteignables que par le plan du site**. L'accueil affichait le texte de
démonstration de WordPress, et la page d'un parcours n'affichait « Lire la
suite » — **aucun lien**. Tout est corrigé : l'accueil liste les 52 rooms et
les 4 parcours, chaque parcours liste ses rooms, la page d'accueil est
créée automatiquement, l'archive d'auteur est fermée (elle exposait le nom du
compte d'administration), les titres suivent la langue affichée, et **37
chaînes de traduction dégradées** ont été reprises.

Vérification mesurée : **52 rooms sur 52** liées depuis un parcours
(`scripts/audit/verif-maillage.php`). L'auditeur SEO passe de 35 à
**45 contrôles** ; le comité d'audit à **118**. Le compte rendu — y compris
la réponse honnête à « le site est-il conforme à 100 % ? » — est dans
[`docs/SEO-GENERATION-AI.md`](docs/SEO-GENERATION-AI.md).

Un point mérite d'être dit, car il a coûté cher et qu'il est instructif :
pendant la livraison de la v0.7.0, deux contrôles de la recette échouaient
**en CI seulement** — « robots.txt nomme les robots d'IA » et « llms.txt cite
les rooms ». Le site servait pourtant ces deux fichiers correctement en local.
La cause a été isolée en conteneur : **le serveur de développement intégré de
PHP répond 404 pour une adresse qui porte une extension** (`/robots.txt`,
`/llms.txt`) quand le fichier n'existe pas sur le disque — avec PHP 8.3, la
requête **n'atteignait jamais WordPress**. Un vrai hébergeur (Apache,
LiteSpeed) route ces adresses vers WordPress grâce au `.htaccess` : le site
était donc **correct**, c'est l'outillage de test qui mentait. Les workflows
servent désormais le site via `scripts/audit/router.php`, comme le faisait
déjà le workflow d'audit. La recette montre en outre le **contenu réellement
reçu** quand un contrôle échoue : on ne devine plus, on lit la preuve.

Le dépôt est versionné sur GitHub, en **repository privé**. Deux workflows
GitHub Actions sont présents :

| Workflow | Déclenchement | Rôle |
|---|---|---|
| `.github/workflows/ci.yml` | push sur `main`, pull request, manuel | Lint PHP, tests de logique, espaces en fin de ligne |
| `.github/workflows/deploy.yml` | push sur `main`, manuel | Sauvegarde la version déployée, synchronise le plugin et le thème par `rsync`, contrôle que le site répond |
| `.github/workflows/labs.yml` | push sur `main`, manuel | **Vraies machines Docker** : construit les 4 images, lance deux apprenants sur deux réseaux, vérifie l'isolation, les drapeaux, la pile réseau et rejoue les dix scénarios (45 contrôles) |
| `.github/workflows/wordpress.yml` | push sur `main`, pull request, manuel, hebdomadaire | **WordPress réel** : installe le site, rejoue la recette de bout en bout, vérifie les trois langues et la compatibilité avec les plugins tiers (Polylang, LiteSpeed Cache, Elementor, Contact Form 7, WooCommerce) |

Tant que les secrets GitHub ne sont pas configurés, le job de déploiement
s'arrête proprement en affichant « Secrets de déploiement absents » : la CI
reste verte et rien n'est envoyé sur le serveur.

La configuration des secrets est détaillée dans
[`docs/deploiement.md`](docs/deploiement.md).

## Recette serveur (une fois, sur le serveur)

Le plugin lance la commande `docker` **sur la machine où WordPress tourne** :
les machines de laboratoire ne peuvent donc fonctionner que si Docker est
installé sur le même serveur (un hébergement mutualisé ne le permet pas).

Une procédure clé en main est fournie :

| Fichier | Rôle |
|---|---|
| `scripts/recette-serveur.sh` | 22 vérifications sur le serveur (Docker, plugin, images, réseau, isolation, pile Compose, nettoyage) |
| `docs/RECETTE-SERVEUR.md` | Où coller quoi, la checklist de 10 lignes, et que faire quand une ligne échoue |

```bash
sudo bash /opt/secura-academy/scripts/recette-serveur.sh
# attendu : Recette terminee : 22 reussis, 0 echecs
```

## Quel hébergement choisir ?

La règle est simple : **le plugin appelle la commande `docker` sur la machine
où WordPress tourne.** Les vraies machines de laboratoire exigent donc un
serveur avec Docker (accès root) : un hébergement mutualisé ne peut pas les
faire tourner, mais le plugin bascule alors automatiquement sur le terminal
simulé (cours, examens, certificat : tout le reste fonctionne).

| Option | Docker | Lab réel | Prix |
|---|---|---|---|
| Mutualisé (Hostinger Premium) | ❌ | simulé | 2–3 €/mois |
| Mutualisé + serveur de lab séparé | ✅ mais pas pilotable (non implémenté) | ✅ | 2 abonnements |
| **VPS (Hostinger KVM)** | ✅ | ✅ | ~5 $/mois |

Le détail, les avantages et les défauts de chaque option sont dans
[`docs/HEBERGEMENT.md`](docs/HEBERGEMENT.md) ; la marche à suivre pour le
VPS est dans [`docs/RECETTE-SERVEUR.md`](docs/RECETTE-SERVEUR.md).

## Limites connues

À traiter avant une ouverture publique (voir aussi `AUDIT-UX.md`) :

- **Pas de vrais labs.** Le « terminal » est une simulation textuelle guidée ;
  aucun conteneur ni machine n'est exécuté. Ne pas le présenter comme un
  environnement actif.
- **Contenu éditorial limité.** 6 rooms sont livrées : elles servent de **modèle
  de rédaction**. Produire les 46 rooms du plan complet demande un effort
  éditorial d'environ 178 h (voir `docs/CONTENU-MIT.md`).
- **Pas de confirmation par e-mail**, ni mot de passe oublié personnalisé,
  ni anti-spam. La limitation de débit existe côté API de validation
  (40 requêtes/minute/utilisateur) mais elle ne remplace pas un vrai mécanisme
  anti-robots côté inscription et connexion.
- **Certificat de parcours sans export PDF** : il est imprimable depuis le
  navigateur (CSS d'impression isolé), mais aucun fichier PDF n'est produit.
- **Catalogue sans recherche ni filtres** au-delà du parcours.
- **Suppression / export des données** à formaliser (RGPD) : la progression et
  les médailles vivent dans les `user_meta`.
- **Scénarios de terminal non traduits** dans le contenu de démonstration :
  les versions arabe et anglaise des rooms partagent le scénario francophone
  du terminal. La méta-box de traduction accepte désormais un JSON de terminal
  par tâche, mais la traduction des 6 rooms livrées reste à produire.
- **Docker est une surface d'attaque.** Un utilisateur autorisé à parler au
  socket Docker peut prendre la main sur l'hôte. Sur mutualisé : mode simulé.
  Sur VPS dédié : utilisateur dédié, réseau sans sortie Internet, images
  épinglées par digest. Voir [`docs/labs.md`](docs/labs.md).
- **Isolation multi-apprenants à durcir en mode Compose** : le nom de projet
  Docker Compose est encore fixe, deux élèves pourraient se partager la même
  pile de conteneurs. À corriger avant l'ouverture publique (M1).
- **Multi-site** non pris en charge explicitement.
- **La recette automatique ne remplace pas la recette sur l'hébergement réel.**
  La CI rejoue tout dans un WordPress standard ; le cache LiteSpeed de
  l'hébergeur et le comportement exact de l'hébergement restent à vérifier sur
  la machine de staging (`docs/RECETTE-SERVEUR.md`).
- **Revue de sécurité et tests d'accessibilité** à faire avec une version
  WordPress/PHP cible en staging, avant production.

## Feuille de route — la constitution

[`docs/ROADMAP.md`](docs/ROADMAP.md) n'est plus une simple liste de tâches :
c'est la **constitution du projet**, lue et révisée **à chaque session de
travail**. Elle contient dix principes (l'apprenant d'abord, gratuit,
multilingue, faire avant de lire, comprendre ses erreurs, contenu ouvert, le
vrai lab sinon le dit, les mineurs d'abord, rien de cassé, route publique), dix
**règles de décision** (comment on tranche quand deux options sont
possibles), l'ordre des jalons, les décisions structurantes et un journal
append-only.

Documents liés :

- [`docs/AUDIT-EXPERIENCE-APPRENANT.md`](docs/AUDIT-EXPERIENCE-APPRENANT.md) —
  le **constat** (audit de l'expérience apprenant, comparaison THM sur sources
  réelles, alignement MIT).
- [`docs/ECARTS-TRYHACKME.md`](docs/ECARTS-TRYHACKME.md) — les **réponses** :
  chacun des 10 écarts (vraie machine, question sans réponse, volume, AttackBox,
  writeups, graphe, vidéos, onglets multi-machines, onboarding, classement) est
  traité par une opération unique — RATTRAPER, ORIGINAL, PAR CITATION,
  SUBSTITUER ou REFUSER — avec un critère de fermeture, un coût et un jalon.
- [`docs/SOURCES-CONTENU.md`](docs/SOURCES-CONTENU.md) — le **registre des
  sources** : licence vérifiée pour chaque source (MIT OCW, OWASP, pwn.college,
  Stanford SEE, NIST), ce que nous en prenons, comment nous attribuons.
  Règle par défaut : **lien seul** tant que la licence n'est pas vérifiée.
- [`docs/CONTENU-MIT.md`](docs/CONTENU-MIT.md) — le **plan de contenu**,
  paliers 1 à 3, dont le palier 3 « universitaire » (14 rooms 6.858 + 20 rooms
  6.857, labs notés par scripts, barème 20/35/25/20).
- [`docs/CERTIFICATIONS.md`](docs/CERTIFICATIONS.md) — **le catalogue du
  contenu gratuit des grandes universités du monde** (vidéo, exercices,
  certificat) et des certifications réelles, avec la distinction honnête
  entre certificat gratuit et examen payant, et le rappel que l'ISC2 CC est
  fermé aux nouveaux candidats depuis le 20/05/2026.

Jalons en cours : **M1** (lab réel : branchement des rooms + isolation par
apprenant), puis **M3** (10 rooms réelles, prérequis, récap de section, examen
par manipulation), **M4** (comptes), **M5** (e2e, accessibilité, staging),
**M6** (social et visuel), **M7/M8** (palier 3 universitaire). **M2 bis** —
types de question, dont la question « sans réponse » — est **livré en v0.5.0**.

## Prochaines étapes

La feuille de route complète est détaillée dans
[`docs/ANALYSE-UX-TRYHACKME.md`](docs/ANALYSE-UX-TRYHACKME.md) (analyse UX/UI,
comparaison et points à régler), [`docs/CONTENU-MIT.md`](docs/CONTENU-MIT.md)
(plan de contenu) et [`docs/MODELE-XP-MEDAILES.md`](docs/MODELE-XP-MEDAILES.md)
(barème XP, médailles, examens).

Le **P0 est livré**. Restent en priorité :

1. **Pédagogie** — détection automatique du niveau, aide contextuelle, « indice intelligent ».
2. **Contenu** — industrialiser la rédaction de rooms sur le modèle des 6 livrées.
3. **Certificat** — génération PDF du certificat de parcours.
4. **Social** — classement de parcours (optionnel, avec verticalisation de l'opt-in).
5. **Cadre de confidentialité** — export, suppression, durée de conservation.
6. **Accessibilité** — audit clavier / lecteur d'écran sur le lecteur de room.

## Licence et contenu

Le code est sous licence **MIT**.

Le contenu pédagogique livré à ce jour est **original** (6 rooms, traductions
FR/AR/EN).

Les cours MIT OpenCourseWare 6.858 (*Computer Systems Security*, Fall 2014) et
6.857 (*Network and Computer Security*, Spring 2014) sont la **référence
pédagogique** du palier 3. Leurs supports sont publiés sous **CC BY-NC-SA 4.0**
(attribution, usage non commercial, ShareAlike) : la plateforme étant
**gratuite**, la clause non commerciale est satisfaite, et toute adaptation
sera **explicitement attribuée** et redistribuée sous la même licence
(décision D6 de la constitution). Le **cadrage pédagogique** — leçon →
entraînement → test d'application → examen — est repris tel quel.

Le registre complet des sources réutilisables (licence vérifiée le jour de la
réutilisation, mention type, périmètre autorisé) est dans
[`docs/SOURCES-CONTENU.md`](docs/SOURCES-CONTENU.md) ; la justification
juridique est dans [`docs/CONTENU-MIT.md`](docs/CONTENU-MIT.md) § 0.
