# Analyse UX/UI de TryHackMe et plan de mise à niveau de Secura Academy

**Auteur de l'analyse :** revue senior UI/UX + architecture produit
**Date :** 31 octobre 2026
**Périmètre :** pages publiques TryHackMe consultées ce jour (`/`, `/path/outline/presecurity`, `/room/introtolan`, aide officielle Levels, doc officielle « How Points Work ») **plus** l'examen du code actuel de Secura Academy (plugin + thème, commits `0a0811d` → `4c6f3b4`).

> **Avertissement de méthode.** Il s'agit d'une **revue heuristique de surface publique**, pas d'un audit interne de TryHackMe, pas d'un test utilisateur et pas une rétro-ingénierie de leurs composants. Les rooms publiques consultées le sont sans compte authentifié : les comportements derrière connexion (dashboard réel, terminal, AttackBox, profil) sont déduits de la documentation officielle et non observés directement. Aucune ressource propriétaire de TryHackMe (texte, illustration, code, marque) n'est reproduite ici : on n'en retient que des **principes** et des **mécaniques** génériques.

---

## 1. Analyse UX/UI de TryHackMe

### 1.1 Architecture de l'information

TryHackMe organise l'information sur **trois couches** :

| Couche | Unité | Rôle |
|---|---|---|
| Catalogue | *Learning Path* (parcours) | Orienter : « de où vous êtes au métier visé » |
| Programme | *Section* → *Room* | Découper : 7 modules, 31 labs, ~19 h estimées pour « Pre Security » |
| Pédagogie | *Task* → *Question* | Exécuter : leçon courte + questions à réponse |

Trois décisions structurantes :

1. **Le parcours est l'unité d'orientation, pas la room.** La home ne vend pas des sujets (« réseau », « web »), elle vend des **trajectoires professionnelles** (« Jr Penetration Tester », « SOC Level 1 », « Offensive Pentesting »), avec une segmentation explicite *Starting from scratch / Already know the basics / Upskilling for experts*. C'est la réponse directe à la question « par où commencer ? », qui est le premier frein de conversion.
2. **Chaque section se termine par un « Topic Rewind Recap ».** Répétition espacée intégrée à la structure du programme, et non laissée à la bonne volonté de l'apprenant.
3. **La durée estimée et la difficulté sont des attributs de premier plan** (path : « 19h 10m », « easy » ; room : badge de difficulté). Le coût cognitif est annoncé avant l'engagement.

### 1.2 Anatomie d'une room (analyse de `/room/introtolan`)

```
Titre + proposition de valeur une ligne
└── Task 1 : [titre de tâche]
    ├── Bloc pédagogique (markdown, titres, tableaux, schémas, encadrés)
    ├── Bloc « Practical » interactif (lab embarqué)
    └── « Answer the questions below » → liste numérotée
        ├── champ de saisie par question
        ├── indice (hint) par question
        └── retour immédiat correct / incorrect
└── Task 2 : [titre de tâche] …
```

Points structurants :

- **Le contenu précède la question, dans la même tâche.** La théorie et sa vérification sont adjacentes, pas séparées par un module « quiz » en fin de parcours.
- **Numérotation explicite** (« 1. … 2. … ») : l'apprenant sait combien de réponses l'attendent.
- **Les indices sont par question**, jamais pour la tâche entière : l'aide est graduée.
- **Les questions flag sont la norme**, pas l'exception : la validation est exacte, ce qui rend le barème de points crédible.
- **Les rooms sont hétérogènes** (une room = plusieurs tasks de longueurs très inégales) : c'est le principal défaut de constance de la plateforme.

### 1.3 Modèle pédagogique

Trois formats cohabitent :

| Format | Usage | Indice | Points |
|---|---|---|---|
| Walkthrough | Apprentissage guidé pas à pas | oui | 25 % du barème selon l'ancienneté |
| Challenge | Résolution autonome | non | 100 % du barème |
| Practical / lab | Manipulation sur machine | — | inclus dans la room |

Le format **walkthrough vs challenge** est le pivot du système de points : il récompense la prise de risque cognitive sans empêcher l'apprentissage guidé.

### 1.4 Système de gamification (spécifications officielles relevées)

**Barème par question** (doc officielle « How Points Work ») :

| Rang de réponse | Points |
|---|---|
| 1ᵉʳ à répondre | 200 |
| 2ᵉ | 180 |
| 3ᵉ | 175 |
| 4ᵉ | 165 |
| Après le 4ᵉ | 150 |

Modulations : la **difficulté** de la room augmente ou diminue le barème ; les **challenge rooms** rapportent plus que les **walkthrough rooms** ; le **first blood** (terminer une machine avant les autres) est toujours valorisé ; les classements existent en **mensuel** (remise à zéro le dernier jour du mois à 23 h 59 GMT) et en **all-time**.

**Échelle de niveaux** (21 niveaux, aide officielle) :

`Neophyte` 0 → `Apprentice` 200 → `Pathfinder` 500 → `Seeker` 1 000 → `Visionary` 1 500 → `Voyager` 2 000 → `Adept` 3 000 → `Hacker` 4 000 → `Mage` 8 000 → `Wizard` 12 000 → `Master` 15 000 → `Guru` 17 000 → `Legend` 20 000 → `Guardian` 35 000 → `TITAN` 50 000 → `SAGE` 65 000 → `VANGUARD` 80 000 → `SHOGUN` 95 000 → `ASCENDED` 110 000 → `MYTHIC` 130 000 → `GRANDMASTER` 150 000.

**Autres leviers :** badges de profil, certificat de complétion de path, streak quotidien, badge mensuel pour le nº 1.

### 1.5 Analyse critique — forces et faiblesses

**Forces (à répliquer)**

1. **Orientation avant contenu.** Le parcours sells l'intention professionnelle ; la room n'est plus qu'un exécutant.
2. **Coût d'entrée nul.** Un seul CTA, inscription en un clic (SSO Google), aucune demande de carte bancaire avant la valeur.
3. **Granularité de la boucle.** Feedback immédiat, points affichés à chaque réponse, progression visible à trois échelles (question / room / path).
4. **Cadrage honnête de la difficulté.** Difficulté + durée + nombre de labs annoncés.
5. **Densité.** Une room = 20 à 40 minutes. L'unité de session est courte et nome.

**Faiblesses (opportunités pour Secura)**

1. **Mur de texte.** Les rooms sont des pavés markdown peu scannables, sans résumés, sans glossaire, sans « à retenir ».
2. **Feedback binaire.** Un ✗ n'explique pas l'erreur. L'apprenant ne sait pas *pourquoi* il a tort, ce qui est précisément ce qui fait progressing.
3. **Déficit de découverte.** 1 000+ labs, recherche faible, catalogue qui devient illisible au-delà de ~50 éléments.
4. **Pression du classement.** Les apprenants débutants se positionnent en queue : l'effet est démotivant, la gamification punit là où elle devrait soutenir.
5. **Absence de diagnostic.** Impossible de savoir *quelle* compétence manque ; le parcours est linéaire alors qu'il devrait être adaptatif.
6. **Structure non standardisée.** Une room sans modèle imposé → rendu hétérogène, navigation incohérente, statistiques incomparables.
7. **Accessibilité perfectible.** contrastes parfois justes, cibles tactiles petites, aucune politique visible sur `prefers-reduced-motion`.

> **Positionnement recommandé.** Ne pas copier TryHackMe : copier ses **mécaniques**, et lui opposer trois différenciateurs qui sont à notre portée : (a) un **feedback pédagogique** qui explique l'erreur, (b) une **évaluation réelle** avec examens chronométrés et seuils de passage, (c) une **transparence radicale** sur ce qui est simulé et ce qui est réel.

### 1.6 Analyse de l'UI — principes à reproduire

| Principe | Mise en œuvre observée | Cible Secura |
|---|---|---|
| Hiérarchie en 3 temps | Titre + description → tâche → questions | Idem + barre de progression de room persistante |
| Action suivante unique | « Enroll in path », « Join Room », « Start Machine » | Un CTA dominant par écran |
| Densité d'information | badges difficulté / durée / niveau | Chips identiques + progression |
| Retour immédiat | ✓/✗ + points | ✓/✗ + points + **raison de l'échec** |
| État vide | dashboard grisé | à concevoir (P1) |
| Micro-animations | barre de progression, points qui montent | à limiter (reduced-motion) |
| Palette | sombre, accent vert | Conservée, mais **paramétrable** (déjà fait) |

---

## 2. Comparaison : TryHackMe vs Secura Academy actuel

Légende : ✅ présent · 🟡 partiel · ❌ absent

### 2.1 Structure et navigation

| Fonctionnalité | TryHackMe | Secura actuel | Écart |
|---|---|---|---|
| Unité d'orientation = parcours | ✅ 15+ paths, segmentés par métier | ❌ rooms en liste plate | **Majeur** |
| Programme structuré (sections) | ✅ 7 sections / path | ❌ | **Majeur** |
| Récapitulatif de fin de section | ✅ Topic Rewind | ❌ | Moyen |
| Difficulté + durée estimées | ✅ path et room | ✅ room (difficulté, durée) | OK |
| Certificat de complétion | ✅ | ❌ | Moyen |
| Catalogue avec recherche/filtres | 🟡 | ❌ | **Majeur** |
| Page de profil dédiée | ✅ | ❌ | **Majeur** |
| Tableau de bord = catalogue de cards | ✅ | 🟡 tableau de bord stats + cards | Moyen |

### 2.2 Modèle pédagogique

| Fonctionnalité | TryHackMe | Secura actuel | Écart |
|---|---|---|---|
| Room = N tâches | ✅ | ❌ toutes les questions à plat | **Majeur** |
| Tâche = leçon + questions | ✅ | 🟡 contenu de room unique avant questions | **Majeur** |
| 4 types d'activité (leçon / entraînement / test / examen) | 🟡 walkthrough / challenge / practical / quiz | ❌ | **Majeur** |
| Examen chronométré avec seuil | 🟡 | ❌ | **Majeur** |
| Indice par question | ✅ (réduit les points) | 🟡 indice affiché, **non tracé** → impact XP impossible | Moyen |
| Feedback qui explique l'erreur | ❌ | ❌ | Opportunité |
| Simulation de terminal / lab | ✅ vraies machines | 🟡 non implémentée (annoncé honnêtement) | Majeur |

### 2.3 Gamification

| Fonctionnalité | TryHackMe | Secura actuel | Écart |
|---|---|---|---|
| Points par question | ✅ barème public | ✅ 10–20 XP | OK |
| First blood (rang de réponse) | ✅ 200/180/175/165/150 | ❌ | Moyen |
| Multiplicateur difficulté | ✅ | ❌ (valeur plate par question) | Moyen |
| Multiplicateur type de room | ✅ challenge > walkthrough | ❌ | Moyen |
| Bonus de complétion | ✅ | ✅ (25–60 XP) | OK |
| Malus indice | ✅ implicite | ❌ | Moyen |
| Échelle de niveaux nommée | ✅ 21 niveaux | 🟡 6 niveaux, max 1 500 XP | Moyen |
| Badges/médailles par palier | ✅ badges | 🟡 2 types de trophées, pas de médaille | **Majeur** |
| Classement mensuel + all-time | ✅ | ❌ | Moyen |
| Streak | ✅ | ❌ | Moyen |
| XP « all-time » plafonné | — | ✅ (logique simple, robuste) | OK |

### 2.4 Technique

| Fonctionnalité | TryHackMe | Secura actuel | Écart |
|---|---|---|---|
| Réponses non exposées au client | ✅ | ✅ **correctif appliqué** | ✅ Atout |
| Nonce + authentification sur les endpoints | ✅ | ✅ | ✅ |
| Idempotence des gains | ✅ | ✅ testé (26 assertions) | ✅ Atout |
| Palette personnalisable | 🟡 | ✅ 6 couleurs via Personnaliser | ✅ Atout |
| Accessibilité (focus, reduced-motion) | 🟡 | ✅ | ✅ Atout |
| CI + tests automatisés | ✅ | ✅ lint + 26 assertions | ✅ Atout |
| Statistiques de réponses (pour first blood) | ✅ | ❌ | Moyen |
| Compteur de complétion / « try again » | ✅ | 🟡 | Moyen |

**Bilan.** Sur les fondations techniques, Secura est **solide et en avance** sur plusieurs points (sécurité, tests, personnalisation). L'écart n'est pas là. Il est **entièrement pédagogique et structurel** : pas de parcours, pas de tâches, pas d'examens, pas de médailles, pas de profil. C'est ce qui explique qu'en l'état la plateforme ne soit pas « digne de TryHackMe » : elle est un bon exerciseur de QCM, pas une plateforme de formation.

---

## 3. Plan de mise à niveau — les points à régler

### P0 — Structurant (conditionne tout le reste)

Ces 6 chantiers doivent être traités **ensemble** : le modèle de données conditionne l'UI, l'UI reflète le modèle.

#### P0.1 · Modèle de tâches à 4 types

**Problème :** une room = une liste plate de questions. Impossible d'exprimer « leçon → entraînement → test → examen ».

**Solution :** remplacer `_secura_questions` (tableau plat) par `_secura_tasks` (tableau de tâches).

```php
$_secura_tasks[] = array(
    'type'        => 'lesson',   // lesson | practice | test | exam
    'title'       => 'Task 1 : Fondamentaux des LAN',
    'content'     => '<p>…markdown…</p>',   // bloc pédagogique
    'time_limit'  => 0,          // minutes, >0 uniquement pour 'exam'
    'pass_score'  => 70,         // % requis pour 'exam'
    'questions'   => array(
        array(
            'question' => '…',
            'answers'  => array( '…', '…' ),  // variantes acceptées
            'xp'       => 10,
            'hint'     => '…',
            'explanation' => 'Pourquoi la réponse X est correcte…', // feedback pédagogique
        ),
    ),
);
```

**Impact :** migration des 6 rooms existantes (conversion `questions` → une seule tâche `practice`), nouvelle meta box (répétition de tâches), nouveau rendu JS (navigation par tâche), nouveau endpoint AJAX qui renvoie une tâche et non une room.

**Fichiers :** `class-secura-rooms.php`, `class-secura-progress.php`, `class-secura-ajax.php`, `class-secura-dashboard.php`, `assets/academy.js`, `assets/admin.js`, `assets/academy.css`.

#### P0.2 · Examens chronométrés

**Problème :** aucune notion d'évaluation sommative. On peut tout lire, tout copier, passer « les 6 rooms » sans rien retenir.

**Solution :**
- Type de tâche `exam` : `time_limit` (ex. 20 min), `pass_score` (ex. 70 %), **aucun indice**, **une seule tentative comptabilisée pour l'XP et la médaille**.
- Le minuteur démarre à l'ouverture de l tâche, côté client ; **la vérification de l'expiration est faite côté serveur** (on compare `started_at + time_limit` à l'heure serveur), jamais uniquement en JavaScript.
- L'XP d'un examen n'est versé **qu'à la première réussite** ; les tentatives suivantes donnent un retour pédagogique (« vous avez obtenu 72 %, il fallait 70 % ») mais zéro point.
- Écran de résultat : score obtenu / total, seuil requis, points, temps utilisé, médaille ou non.

**Fichiers :** `class-secura-progress.php` (démarrage/fin d'examen), `class-secura-ajax.php` (endpoint dédié), `assets/academy.js` (minuteur + modal de résultat).

#### P0.3 · Système de médailles

**Problème :** les « trophées » actuels sont binaires et awardés à l'achèvement d'une room : pas de gradation, pas de sens de maîtrise.

**Solution :** trois niveaux de médaille par room, calculés sur le **score obtenu et l'usage des indices** :

| Médaille | Critère | XP bonus |
|---|---|---|
| 🥉 Bronze | room complétée, score ≥ 60 % | +10 % du bonus de room |
| 🥈 Argent | score ≥ 80 % **et** aucun indice utilisé | +25 % |
| 🥇 Or | 100 % **et** aucun indice utilisé | +50 % |

Médaille d'examen : bronze ≥ seuil, argent ≥ seuil + 10 pts, or ≥ seuil + 20 pts.
Médaille de parcours : tous les « Or » d'un path.

Stockage : `secura_medals` (user_meta) = tableau `slug_room` → `{ medal, score, hints_used, earned_at }`.
Affichage : collection sur le tableau de bord + mur sur la page de profil.

#### P0.4 · Barème de points inspiré du modèle TryHackMe

**Problème :** le XP est actuellement plat (10–20 par question), pas de first blood, pas de multiplicateur, pas de malus indice.

**Solution :** formule unique, documentée, appliquée côté serveur :

```
points_question = base(difficulté) × multiplicateur(type) × first_blood − malus(indice)

base           : facile 10 | moyen 15 | difficile 20 | expert 30
multiplicateur : leçon 0 | entraînement 0.5 | test 1.0 | examen 1.5
first_blood    : 1er 2.0 | 2e 1.8 | 3e 1.7 | 4e 1.65 | après 1.5
malus(indice)  : −50 % des points de la question si un indice a été ouvert
bonus_room     : facile 10 | moyen 25 | difficile 40 | expert 60
bonus_sans_indice : ×1.25 sur le bonus de room
bonus_parcours : +100 XP
```

Le **first blood** exige de savoir combien d'autres utilisateurs ont déjà répondu juste → **table dédiée** `{prefix}secura_answer_stats` (`question_key` → `count`), incrémentée à la première bonne réponse. C'est la seule partie du modèle qui demande une table SQL : le reste tient en `user_meta`.

#### P0.5 · Parcours (paths) et sections

**Problème :** il n'y a pas de programme, donc pas de progression globale, pas de durée, pas de certificat.

**Solution :** nouveau CPT `secura_path` :
- `sections` (ordre, titre, `rooms[]`)
- `estimated_time`, `difficulty`, `certificate` (oui/non)
- rendu : page de parcours = en-tête (7 modules, 31 labs, 19 h, difficulté) + liste des sections + rooms + barre de progression + badge de complétion.

Le shortcode devient `[secura_academy path="6-858-systemes"]` ou `[secura_academy]` (tous les parcours).

#### P0.6 · Anatomie de room conforme à TryHackMe

**Problème :** le panneau de room actuel est un bloc monolithique (contenu + toutes les questions d'un coup).

**Solution :** reproduced en trois zones :

```
┌─────────────────────────────────────────────────────────────┐
│ STICKY : Titre room · progression room · XP gagné · CTA     │
├──────────────┬──────────────────────────────────────────────┤
│ NAV TÂCHES   │  CONTENU + QUESTIONS                         │
│ Task 1 ✓     │  ┌ Task 1 : … ──────────────────────────┐   │
│ Task 2 ●     │  │ markdown, encadrés, schéma            │   │
│ Task 3 🔒    │  │                                       │   │
│              │  │ « Answer the questions below »        │   │
│              │  │ 1. [champ] [Valider]  ✓ +20 XP       │   │
│              │  │ 2. [champ] [Valider]  ✗ + explication │   │
│              │  └───────────────────────────────────────┘   │
└──────────────┴──────────────────────────────────────────────┘
```

- Navigation par tâche cliquable (desktop) / steps horizontaux (mobile).
- Progression par tâche **et** par room.
- Les questions d'une tâche ne s'ouvrent qu'après lecture (pas d'obstacle bloquant, mais le compteur « 3/5 » est affiché dès le début).

---

### P1 — Produit et engagement

| # | Chantier | Description | Fichiers |
|---|---|---|---|
| P1.1 | **Catalogue** | Grille de cards avec recherche (titre, description), filtres (difficulté, durée, type, path), tri (nouveautés, durée), pagination | `class-secura-dashboard.php`, CSS |
| P1.2 | **Page de profil** | Niveau + XP + barre, mur de médailles, historique des rooms (terminées / en cours), dates, streak | nouveau CPT/shortcode `[secura_academy_profile]` |
| P1.3 | **Feedback pédagogique** | Chaque question porte une `explanation` affichée après la réponse (et après une erreur), y compris sur les réussites (optionnel) | meta, AJAX, JS |
| P1.4 | **Streak** | Jours consécutifs de présence, calculé sur les `completed_at` réels ; badge visible | `user_meta` + profil |
| P1.5 | **Classement** | Mensuel (remise à zéro mensuel) + all-time, **pseudonyme obligatoire**, aucun classement des comptes inactifs | table + AJAX |
| P1.6 | **Certificat** | Génération d'un certificat de complétion de parcours (HTML imprimable → PDF) | path + profil |
| P1.7 | **États vides** | Aucun parcours / aucune room publiée / profil vierge | dashboard |
| P1.8 | **Reprise de session** | « Reprendre où vous en étiez » en tête du tableau de bord | dashboard |

---

### P2 — Différenciateurs et profondeur

| # | Chantier | Description |
|---|---|---|
| P2.1 | **Vrais labs** | Conteneur Docker éphémère, isolation réseau, quotas, nettoyage automatique. C'est le seul chantier qui change l'échelle du produit |
| P2.2 | **Terminal honnête** | Si la simulation reste : l'annoncer explicitement dans l'UI (badge « Exercice guidé — pas de machine active ») |
| P2.3 | **Diagnostic de compétences** | Identifier les rooms ratées → recommander un parcours de remédiation |
| P2.4 | **Communauté** | WRITE-ups, questions/réponses, signalement de contenu (modération) |
| P2.5 | **Application mobile** | hors périmètre immédiat |
| P2.6 | **i18n** | Le contenu est français ; le *text domain* existe déjà (`seca-academy`). Prévoir l'anglais pour l'international |

---

## 4. Design system — spécification de mise à niveau

Le thème `secura-learning` a une base propre (palette paramétrable, tokens CSS, focus visible, `prefers-reduced-motion`). Quatre points à ajouter.

### 4.1 Échelle typographique

| Token | Taille | Interligne | Usage |
|---|---|---|---|
| `--sa-fs-xs` | 0.78rem | 1.4 | chips, méta |
| `--sa-fs-sm` | 0.88rem | 1.5 | aide, feedback |
| `--sa-fs-base` | 1rem | 1.65 | corps |
| `--sa-fs-lg` | 1.25rem | 1.3 | titre de tâche |
| `--sa-fs-xl` | 1.75rem | 1.2 | titre de room |
| `--sa-fs-2xl` | 2.25rem | 1.15 | titre de parcours |

### 4.2 Composants à créer

| Composant | Spécification |
|---|---|
| `securacard` | card de room/parcours : illustration, statut, difficulté, durée, XP, barre de progression, CTA unique |
| `sectask` | bloc de tâche : numérotation, badge de type, contenu, compteur de questions |
| `secquestion` | champ + bouton + retour ✓/✗ + indice (dépliable) + explication |
| `secmedal` | médaillon 3D bronze/argent/or, avec titre + critères |
| `secbadge` | niveau courant + progression vers le suivant |
| `sectimer` | minuteur d'examen, alerte à 5 min et 1 min, `aria-live="polite"` |
| `seclevelbar` | barre de progression segmentée (par tâche) |

### 4.3 Accessibilité — cible WCAG 2.2 AA

- Contrastes : texte principal ≥ 7:1 (AAA), secondaire ≥ 4.5:1 ; **vérifier chaque paire de la palette personnalisable** (un accent clair sur fond sombre peut tomber sous 4.5:1 → ajouter un liseré).
- Cible tactile ≥ 24 × 24 px (AA), 44 px recommandé sur mobile.
- Navigation clavier complète : `Tab` dans la room, `Entrée`/`Espace` sur les cards, `Échap` ferme le panneau, **piégeage du focus** dans le panneau (déjà partiellement fait).
- `aria-live="polite"` sur : retour de validation, score d'examen, XP gagné, minuteur (annonces à 5 min et 1 min uniquement).
- `prefers-reduced-motion` : désactiver les transitions de barre de progression **et** l'animation de compteur de points.
- Ne jamais transmettre une information par la couleur seule (médaille = couleur + forme + texte).

### 4.4 Règles de mouvement

| Élément | Durée | Courbe |
|---|---|---|
| Barre de progression | 400 ms | `cubic-bezier(.2,.8,.2,1)` |
| Apparition d'un bloc | 180 ms | `ease-out` |
| Toast XP | 2500 ms | `ease-in-out` |
| Hover card | 150 ms | `ease-out` |

---

## 5. Ordre d'exécution recommandé

```
Sprint 1 (socle)      P0.1 modèle de tâches  →  P0.3 médailles  →  P0.4 barème de points
                      (P0.1 est un prérequis ; P0.3/P0.4 s'appuient sur le modèle)
Sprint 2 (évaluation)  P0.2 examens  →  P0.6 anatomie de room  →  tests de non-régression
Sprint 3 (programme)   P0.5 parcours + sections  →  migration des 6 rooms existantes
Sprint 4 (engagement)  P1.2 profil  →  P1.1 catalogue  →  P1.3 feedback pédagogique
Sprint 5 (différenciation) P1.4 streak  →  P1.5 classement  →  P1.6 certificat
Sprint 6 (profondeur)  P2.1 vrais labs  →  P2.3 diagnostic
```

**Critère de sortie du MVP « digne » :** un nouvel arrivant s'inscrit, choisit un parcours, comprend en 30 secondes ce qu'il va apprendre et en combien de temps, réalise une leçon puis un entraînement, échoue sur un test, comprend l'explication de son erreur, réussit, obtient une médaille, voit son XP et son niveau monter, et sait exactement quelle est sa prochaine action.

---

## 6. Ce qu'il ne faut pas faire

1. **Ne pas copier les textes, illustrations, icônes, composants ni l'échelle de niveaux de TryHackMe.** Les noms de niveaux doivent être originaux ; la mécanique, non.
2. **Ne pas annoncer des labs alors qu'il n'y a que des QCM.** Le badge « exercice guidé » doit rester visible tant que P2.1 n'est pas livré.
3. **Ne pas prioriser le classement avant les examens.** Un classement sans évaluation series est du bruit ; avec des examens, il devient un signal de compétence.
4. **Ne pas casser le modèle actuel en le refaisant à zéro.** Le socle (user_meta, nonces, idempotence, tests) est bon : il s'étend.
5. **Ne pas laisser le nombre de rooms croître sans la structure de parcours.** 6 rooms bien structurées valent mieux que 40 rooms plates.
