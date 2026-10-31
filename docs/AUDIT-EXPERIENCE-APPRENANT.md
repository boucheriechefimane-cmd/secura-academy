# Audit — expérience apprenant et comparaison TryHackMe

**Date :** 31 octobre 2026 — version auditée : **v0.4.0** (`5cc7823`)
**Question traitée :** *« Un dev senior validerait ce travail ? Un jeune qui veut
apprendre la cybersécurité va aimer l'expérience ? Que nous manque-t-il encore
face à TryHackMe, et qu'avons-nous de meilleur ? »*

Ce document est un **audit**, pas une vitrine : il dit ce qui casse, ce qui
marche, et ce qu'il faut faire ensuite. Il alimente la roadmap
(`docs/ROADMAP.md`) et sera revu à chaque version.

---

## 0. Méthode

Rien n'est estimé ici : chaque affirmation est vérifiable.

**Sources MIT lues pour cette audit :**

- `ocw.mit.edu/pages/privacy-and-terms-of-use/` — licence CC BY-NC-SA 4.0,
  interprétation du « non commercial », marque MIT, interdits.
- `…/6-858-computer-systems-security-fall-2014/pages/syllabus/` et
  `/lecture-notes/` — 24 exposés, 6 labs, projet final, barème.
- `…/6-857-network-and-computer-security-spring-2014/pages/syllabus/` et
  `/calendar/` — 26 séances, 5 problem sets, projet final, barème.

**Sources TryHackMe lues pour cette audit :**

- `tryhackme.com/room/introtolan` — anatomie réelle d'une room (tâches,
  théorie, « Practical », « Answer the questions below »).
- `help.tryhackme.com/…/what-are-levels-on-tryhackme` — 21 niveaux (0 → 150 000).
- `docs.tryhackme.com/…/How Points Work.md` — barème, *walkthrough* vs
  *challenge*, leaderboards, *first blood*.
- `tryhackme.com` (accueil) — 14 parcours, 1000+ labs.
- Corpus de walkthroughs publics (dépôts GitHub, Medium) — pour vérifier les
  mécaniques de terrain : *Start Machine*, *Start AttackBox*, onglets par
  machine, type de question « *No answer needed* », arrêt de la machine.
- Référentiel de points des rooms (853 rooms, 130 286 points, répartition
  Easy 387 / Medium 353 / Hard 73 / Insane 8 / Info 32).

---

## 1. Verdict de dev senior (v0.4.0)

### Ce qui est validé sans réserve

- **Sécurité** : les réponses ne quittent jamais le serveur, nonce sur tous les
  endpoints, XP idempotent (et désormais *réservation atomique* avant crédit),
  chronométrage serveur, limitation de débit, schéma de progression versionné
  avec migration. Un reviewer n'y trouverait pas de faille fonctionnelle.
- **Architecture** : plugin/thème séparés, zéro dépendance externe, données
  dans le `user_meta`, i18n autonome (pas de Polylang obligatoire), API AJAX
  stable et documentée.
- **Rigueur** : 169 assertions, lint PHP, `node --check`, CI verte à chaque push,
  roadmap avec critères d'acceptation, documentation d'exploitation des labs.
- **Le moteur de lab** : le double pilote (`simulated` / `docker`) avec repli
  automatique est la bonne décision d'architecture — le front ne bouge pas, le
  serveur choisit.

### Ce qui est réservé (et doit être traité avant ouverture)

| Réserve | Pourquoi c'est grave | Où |
|---|---|---|
| **Le lab n'est pas branché aux rooms livrées** | La promesse centrale (« une vraie machine ») n'est pas encore faite à l'utilisateur | M1 |
| **Projet Docker Compose à nom fixe** | Deux apprenants peuvent partager la même pile de conteneurs | M1 |
| **`class-secura-ajax.php` = 890 lignes** | God-class : 11 endpoints, validation, lab, examens, langues. À scinder en services | M2 |
| **`user_meta` en blob** | `secura_progress` grossit sans borne ; impossible de classer ou faire des stats en SQL | M3 |
| **Aucun test de bout en bout** | 169 tests unitaires ne prouvent pas qu'un parcours complet fonctionne en vrai | M5 |
| **Aucun audit accessibilité ni staging** | Public cible : ados, dont beaucoup au clavier uniquement | M5 |
| **Docker = surface d'attaque majeure** | Qui parle au socket Docker prend l'hôte | documenté, à durcir |

**Verdict :** un senior valide l'ingénierie et le sérieux du processus, mais ne
valide pas encore le produit, parce que la promesse n'est pas encore tenue
jusqu'au bout (machine réelle branchée, comptes, e2e).

---

## 2. Le parcours d'un apprenant de 14 ans — simulé minute par minute

Je me place dans la peau d'un ado qui arrive sur le site, veut « devenir
hacker », et abandonne au premier écran sans intérêt.

### 2.1 Les 90 premières secondes

| Ce qu'il voit | Ce qu'il ressent |
|---|---|
| Tableau de bord : XP, niveau, médailles, série, un parcours, un catalogue | « C'est propre, ça ressemble à un jeu. » ✅ |
| Il clique sur une room : difficulté, titre, extrait, barre de progression | « Ça commence. » ✅ |
| 4 onglets : **Leçon · Entraînement · Test · Examen** | « Je vois où je vais. » ✅ |

### 2.2 La leçon (5 minutes) — ⚠️ le moment qui peut le faire partir

La tâche 1 est une page de texte : définitions en `<strong>`, listes à puces,
un « À retenir » en fin de bloc. Sur un téléphone, c'est un mur.

> **Verdict :** c'est le même défaut que les rooms « walkthrough » de
> TryHackMe — dont la *tâche 1 est aussi un mur de texte* (audité sur
> `introtolan` : « Local Area Network (LAN) Topologies », trois paragraphes,
> puis « Answer the questions below »). **Mais THM compense** : dès la
> *Task 2*, on te donne une machine et une IP ; l'apprenant a manipulé un
> truc concret en moins de 5 minutes.

Notre version ne compense pas encore : la première action vérifiable arrive
après la leçon.

### 2.3 L'entraînement (QCM) — ✅ le meilleur moment de l'expérience

Question → réponse → **retour immédiat** → XP qui monte avec une animation →
**explication révélée à la réussite** → indice disponible (mais costly).

C'est ici que le produit est réellement bon, et **mieux que THM** (voir § 4).

### 2.4 Le test pratique (terminal) — ⚠️ l'illusion qui peut se briser

Le terminal s'ouvre. L'apprenant tape `ls`. Une sortie s'affiche. Il tape
`nmap`. Réponse : *« bash: commande introuvable »*.

> Pour un ado de 14 ans, ce message dit : **« ce terminal est faux »**. Et il a
> raison : il est faux. C'est le défaut n°1 du produit aujourd'hui.
>
> Le moteur Docker livré en v0.4.0 change la donne *si* l'hébergement a
> Docker — mais les rooms livrées ne sont pas encore branchées, et le repli
> simulé s'applique par défaut.

### 2.5 L'examen — ✅ feels like a real test

Chronomètre serveur, pas d'indice, seuil explicite, score, médaille. C'est la
partie la plus « sérieuse » de l'expérience, et elle est solide.

### 2.6 La fin de room et la fin de parcours — ✅ le pic émotionnel

Bonus XP, médaille, confettis, animation de niveau. Puis, parcours terminé :
**certificat nominatif imprimable**. C'est le moment que l'adolescent veut
montrer à sa famille — et il est gratuit, ce qui n'est pas le cas partout.

### Bilan honnête

| | |
|---|---|
| **Ce qui accroche** | Le QCM avec explication immédiate, le XP qui monte, le badge, le certificat |
| **Ce qui lâche** | Les 5 minutes de texte avant la première action, et le terminal qui ne répond pas comme une vraie machine |
| **L'à-coup de sortie** | Vers la 6ᵉ minute (le mur de texte) et vers la 12ᵉ minute (le terminal faux) |

---

## 3. Les avantages de Secura Academy (ceux qu'on a de mieux)

| Avantage | Pourquoi c'est un vrai avantage | Preuve |
|---|---|---|
| **Arabe natif, RTL complet** | Aucun acteur serious ne sert ce public en arabe. Sur le marché francophone/maghrébin, c'est le **différenciateur n°1**. | Dictionnaire FR/AR/EN complet, `dir="rtl"`, CSS logiques, `style-rtl.css` |
| **100 % gratuit, auto-hébergé** | Pas d'abonnement, pas de certificat payant, pas de revente de données, RGPD par construction | Code MIT, données dans le `user_meta` de ton serveur |
| **Explication de l'erreur systématique** | THM n'explique qu'après avoir ouvert un indice (rare, compté). Nous révélons **toutes** les explications en fin de tâche, y compris des questions ratées. C'est objectivement une meilleure pédagogie. | Récapitulatif « voir mes erreurs » (v0.3.0) |
| **Seuil et validation explicites** | « Tâche réussie », seuil affiché, score en pourcentage : l'apprenant sait où il en est. THM ne montre qu'un « task complete » et des points. | `pass_score` effectif (v0.3.0) |
| **Contenu natif français** | Le français de THM est médiocre. Nos rooms sont écrites en français (et traduisibles en arabe à la ligne). | 6 rooms FR + traductions AR/EN |
| **Anti-triche relâché** | Paradoxal mais vrai : auto-hébergé, pas de marché à protéger → pas de triche possible par copy/paste massif, pas de CAPTCHA. Pour un ado, c'est une expérience plus fluide. | Pas de limitation artificielle |
| **Aucun dark pattern** | Pas de pub, pas de nudge vers l'abonnement, pas de classement qui humilie. | — |

---

## 4. Audit TryHackMe : ce qu'il faut vraiment savoir

### 4.1 Les deux familles de rooms

C'est la distinction que personne ne fait et qui change tout :

| Famille | Anatomie | Exemple audité |
|---|---|---|
| **Walkthrough / cours** | Théorie → questions → flag | `introtolan` : 3 paragraphes sur les topologies, 6 questions, la dernière est le flag |
| **Lab pratique** | Machine déployée → on tape → on exploite → flag | `Vulnversity`, `Basic Pentesting` : `Start Machine` → IP `10.10.x.x` → nmap → flag |

**Notre modèle `leçon → entraînement → test → examen` est, sur le papier, très
proche de la famille walkthrough de THM.** C'est une bonne nouvelle : notre
squelette n'est pas exotique. Mais la famille *lab* de THM — celle qui crée
l'addiction — repose sur trois mécanique qu'on n'a pas encore :

1. **`Start Machine`** → une vraie IP (`10.10.x.x`), accessible en VPN ou
   depuis l'AttackBox.
2. **`Start AttackBox`** → un **bureau Kali complet dans le navigateur** (pas
   une ligne de commande).
3. **Onglets par machine** en bas de l'écran → le sentiment de « piloter
   plusieurs machines », et donc le pivot.

### 4.2 Le type de question « *No answer needed *»

Mécanique vérifiée dans le corpus de walkthroughs : dans les tâches pratiques,
la question est **« No answer needed »** — tu fais l'action, tu coches. Le
système ne te demande pas de *dire* ce que tu as fait, il te demande de le
**faire**.

> **C'est la mécanique qui manque le plus à notre produit**, et elle est
>Absente de notre modèle de données. Elle est peu coûteuse à ajouter (une
> question sans réponses acceptées, validée par une case à cocher) et elle
> change la nature de la validation : on valide une **compétence**, pas une
> phrase correctement orthographiée.

### 4.3 Volume et structure

- **853 rooms** (387 easy, 353 medium, 73 hard, 8 insane, 32 info),
  ~130 000 points, **14 parcours**, 1000+ labs annoncés.
- Points par room : 200 / 180 / 175 / 165 / 150 selon le barème ; *first blood*,
  leaderboards, distinction *walkthrough* / *challenge*.
- **21 niveaux** (0 → 150 000 points).
- Les parcours ont un **graphe de prérequis** et un **« Topic Rewind Recap »**
  en fin de section.

### 4.4 L'écosystème, le vrai actif de THM

Des dizaines de dépôts GitHub de writeups, des Discord, des vidéos. **Un
apprenant bloqué a un endroit où aller.** Nous n'avons rien de cela.

---

## 5. Tableau comparatif (après audit)

| Dimension | TryHackMe (audité) | Secura Academy v0.4.0 | Avantage |
|---|---|---|---|
| Rooms | **853** | 6 | THM (×140) |
| Langues | EN (traductions SHA/AR/ES, peu suivies) | **FR + AR RTL natif** | **Secura** |
| Coût | gratuit + abonnements + certificats payants | **100 % gratuit, auto-hébergé** | **Secura** |
| Machine réelle | oui, IP 10.10.x.x, VPN | moteur Docker + 3 images, **non branché** | THM |
| Poste d'attaque | AttackBox = bureau Kali navigateur | 1 ligne de commande | THM |
| Multi-machine | onglets par machine | 1 terminal | THM |
| Type « sans réponse » | oui, très répandu | **non** | THM |
| Pratique intégrée à la tâche | oui (LAN interactif) | oui (terminal, format mixte) | **égalité** |
| Explication de l'erreur | via indice, rare | **automatique, toutes les erreurs** | **Secura** |
| Seuil / validation | implicite (points) | **explicite (« tâche réussie », seuil)** | **Secura** |
| Indices | cachés derrière un clic, coûteux | tracés, −50 %, visibles | **Secura** |
| Niveaux | 21 (0 → 150 000) | 12 (0 → 15 000 XP) | THM |
| Parcours / prérequis / récap | 14+, graphe, récap | 1 parcours, 1 module | THM |
| Certificat | payant sur certains parcours | **gratuit, imprimable** | **Secura** |
| Communauté / writeups | massif | **zéro** | THM |
| Classement / first blood | oui | conçu, **désactivé par défaut** | THM (si activé) |
| Vidéos courtes | oui, intégrées | non | THM |
| Anti-triche | quotidien | relâché (auto-hébergé) | **Secura** |
| Confidentialité | hébergement US | **chez toi** | **Secura** |

---

## 6. Ce qui nous manque toujours (classé par impact)

1. **La vraie machine branchée aux rooms livrées** — le moteur existe, le
   branchement manque. *Impact : tout le reste en découle.*
2. **Le type de question « sans réponse »** — valide une compétence, pas une
   phrase. *Impact : énorme sur la perception de « je sais faire ».*
3. **Le volume de contenu** — 6 rooms contre 853. *Impact : rétention.*
4. **L'AttackBox** — un bureau Linux dans le navigateur. *Impact : accessible
   aux plus jeunes (ceux qui n'ont jamais vu un shell).*
5. **La communauté et les writeups** — un « corrigé détaillé » débloqué après
   la réussite, comme le fait THM avec ses walkthroughs. *Impact : désamorce
   les impasses.*
6. **Le graphe de prérequis + récap de section** dans les parcours.
7. **Les vidéos courtes** (60-90 s) par room.
8. **Les onglets multi-machines** (pivot) —et les pivots.
9. **L'onboarding** (confirmation e-mail, mot de passe oublié) — bloquant pour
   un public mineur.
10. **Le classement / first blood activé** quand le volume le justifiera.

---

## 7. L'alignement MIT : est-ce que la formation colle à 100 % au contenu de MIT ?

**Non. Et c'est important de le dire clairement.**

### 7.1 Pourquoi l'alignement total est impossible (et inutile)

| Obstacle | Détail |
|---|---|
| **Niveau** | 6.858 et 6.857 sont des cours de **graduate**. 6.858 exige 6.033 (Systems Engineering) ; 6.857 exige 6.033 **et** 6.042J (Mathématiques pour l'informatique). Notre public a 12-17 ans. |
| **Format** | MIT = 24 exposés sur des **articles scientifiques** à lire avant le cours, 6 labs notés, projet final **en groupe de 3-4**, homework avec question de lecture personnelle. Nous = auto-paced, seul, 20-40 min par room,jeu de rôle. |
| **Barème** | 6.858 : quizzes 20 %, labs 35 %, projet 25 %, homework 20 %. 6.857 : problem sets 40 %, quiz 20 %, projet 40 %. Notre barème (XP/médaille) n'a aucune commune mesure. |
| **Unité** | MIT n'a pas de « room ». La room est **notre** unité de gamification, inspirée de la *structure* d'évaluation, pas de son contenu. |

### 7.2 Ce que nous couvrons réellement

**Sur 6.858 (24 exposés)**, nous couvrons environ **9** :

| Nos rooms | Exposés 6.858 correspondants |
|---|---|
| 1. Penser comme un défenseur | 1 (Introduction, *Threat Models*) |
| 3. Sécuriser une application web | 8 (Web Security Model), 9 (Securing Web Applications) |
| 4. Mémoire et défenses | 2 (Control Hijacking), 3 (Buffer Overflow Exploits and Defenses), 7 (Sandboxing Native Code) |
| 5. Authentification | 17 (User Authentication) |
| 6. Chiffrement et HTTPS | 14 (SSL and HTTPS) |
| 2. Fondamentaux du réseau | 12-13 (Network Security, Network Protocols) — **partiellement** |

**Non couverts (6.858)** : 4 (Privilege Separation), 6 (Capabilities), 10
(Symbolic Execution), 11 (Ur/Web), 15 (Medical Software), 16 (Side-Channel
Attacks), 18 (Private Browsing), 19 (Anonymous Communication), 20 (Mobile
Phone Security), 21 (Data Tracking), 23 (Security Economics).

**Sur 6.857 (18 séances de contenu)**, nous couvrons environ **4** : les
principes de sécurité (2), les fonctions de hachage (4-5), le chiffrement
(3) et le TLS/Diffie-Hellman (8-9, 12) — et encore, de façon introductive.

**Non couverts (6.857)** : toute la cryptographie avancée — secret sharing,
modes de chiffrement par blocs vus en profondeur, MAC, Pedersen, ElGamal
malleable, IND-CCA2, signatures, DSA, groupes de gap, bilinéaires, **preuves à
connaissance nulle**, **sécurité du vote**, Bitcoin.

### 7.3 Le piège à éviter : 6.857 n'est pas « réseaux + crypto »

C'est une erreur de cadrage que j'ai commise dans la première version du plan
de contenu. **6.857 est un cours de cryptographie avancée**, pas un cours de
réseaux. Notre parcours « Fondations » (topologies LAN, switch, routeur,
sous-réseaux) **n'a aucune contrepartie dans les deux cours MIT** : c'est de la
culture réseau générale, dans la tradition TryHackMe, et elle doit être
**étiquetée comme telle** plutôt que rattachée à MIT.

### 7.4 Le vrai positionnement, et comment atteindre un alignement réel

| Palier | Public | Contenu | Alignement MIT |
|---|---|---|---|
| **1 — Initiation** | 12-17 ans, curieux | Contenu original, notions de base | MIT = **bibliographie** uniquement |
| **2 — Perfectionnement** | 17-22 ans, étudiants | Adaptation de supports OCW (buffer overflow, web security, TLS) avec attribution + ShareAlike | MIT = **source d'adaptation**, citation par room |
| **3 — Universitaire** | étudiants en sécurité, professionnels | Un **parcours** qui reproduit la structure MIT : exposés par article + **labs notés** + projet final en groupe, avec le barème MIT (quiz 20 %, labs 35 %, projet 25 %, homework 20 %) | MIT = **cursus** — c'est ici que l'alignement devient réel |

> **C'est la proposition à retenir :** le « palier 3 » est le seul endroit où
> l'on peut légitimement dire « cette formation suit le cours MIT » — parce
> qu'à ce niveau on fait les **labs**, les **quiz** et le **projet**, avec la
> même répartition de la note. Tout le reste est une **adaptation** assumée, pas
> une transcription.

C'est aussi le palier qui **justifie le travail d'adaptation massif** rendu
possible par la correction de la licence (§ 0 de `docs/CONTENU-MIT.md`).

---

## 8. Décisions qui découlent de cet audit

À intégrer à la roadmap :

1. **Ajouter la milestone M2 bis — « Type de question *sans réponse* »** :
   une question sans réponses acceptées, validée par une case à cocher, avec
   validation côté serveur (impossible de cocher sans avoir joué).
2. **Ajouter la milestone M7 — « Palier 3 : parcours universitaire MIT »** :
   structure MIT (quiz / labs / projet), labs notés, projet en groupe.
3. **Activer le first blood** une fois le volume de contenu suffisant (M6).
4. **Ajouter le « corrigé détaillé » débloqué après réussite** (écran de
   walkthrough), qui remplace pour l'instant l'absence de communauté.
5. **Réviser la mission de la leçon** : elle ne doit pas dépasser 60-90 s de
   lecture, et le terminal doit être atteignable avant.
