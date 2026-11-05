# Les dix scénarios M3 — ce qu'ils contiennent, et ce qu'ils prouvent vraiment

Version : **v0.5.4** · Date : 01/11/2026 · Auteur : l'équipe Secura Academy

Ce document répond à six questions posées le 31/10/2026 :

1. **Dix scénarios réalistes** qu'un jeune ferait vraiment, avec les exercices et les formations qui vont avec.
2. **L'audit honnête** : est-ce facile à apprendre ? Les tests valident-ils vraiment ce qui a été appris ? Quelle est la difficulté de chaque étape ?
3. **L'alignement MIT** (6.858 / 6.857) : le contenu colle-t-il aux notions et aux lectures ?
4. **Les cours gratuits d'autres universités** (pwn.college, CYBER.ORG, Stanford SEE, OWASP…) : ont-ils été ajoutés au parcours ?
5. **L'UX de professionnel** (pas un bricolage).
6. **Le moteur réel** : s'appuyer sur le Docker de GitHub Actions pour construire et tester, et un vrai moteur de validation.

---

## 1. Ce que cette version apporte

| Élément | Avant | Maintenant |
|---|---|---|
| Scénarios jouables sur une vraie machine | 6 rooms de démonstration (QCM + terminal simulé) | **6 + 10 scénarios M3**, tous branchés sur de vraies machines |
| Type de mission | « réponds juste » (QCM) | **preuve de travail** : le serveur va lire le drapeau **dans la machine de l'apprenant** |
| QCM | réponses libres, plusieurs formulations acceptées | **vrais QCM** : 4 propositions, **une seule** bonne, distracteurs = vraies erreurs d'apprenant |
| Machines | `web-01`, `bin-01`, pile `net-01` | **+ `multi-01`** (une image, 7 scénarios) **+ `internal-01`** (le nœud du pivot) |
| Test des machines | 17 contrôles sur Docker | **+ 25 contrôles** : chaque scénario M3 est rejoué sur un vrai conteneur |
| Contrôles du code | 226 assertions | **243 assertions** |

---

## 2. Les dix scénarios

| # | Scénario | Situation vécue | Machine | Difficulté | Durée | XP |
|---|---|---|---|---|---|---|
| 1 | **Le service qui ne répond plus** | Un ticket d'incident : « plus personne ne peut se connecter ». On observe avant de toucher. | `multi-01` | ★☆☆ | 25 min | 30 |
| 2 | **Le mot de passe oublié** | Personne ne se souvient du mot de passe de la base. Une seule source de vérité existe — et elle est lisible. | `multi-01` | ★☆☆ | 20 min | 25 |
| 3 | **La page qui se trahit** | Un formulaire renvoie mot pour mot ce qu'on lui écrit. Un robot visite les pages la nuit. | `multi-01` | ★★☆ | 30 min | 40 |
| 4 | **La requête qui ne se fie à personne** | L'application construit sa requête SQL avec ce que tu tapes. | `multi-01` | ★★☆ | 30 min | 40 |
| 5 | **Le fichier qu'on n'aurait pas dû laisser** | Une page de documentation sert n'importe quel fichier du serveur. | `multi-01` | ★★☆ | 25 min | 35 |
| 6 | **Qui a forcé la porte ?** | Une rafale d'échecs puis une réussite : il faut remettre l'histoire dans l'ordre. | `multi-01` | ★★☆ | 25 min | 35 |
| 7 | **Le réseau qui parle trop** | Trois nœuds, des ports ouverts : il faut dessiner la carte avant d'attaquer. | `net-01` (4 services) | ★★☆ | 30 min | 40 |
| 8 | **Traverser le mur** | Le nœud « web » est compromis, un mot de passe est réutilisé, et un nœud interne n'écoute que depuis le réseau interne. | `net-01` + `internal-01` | ★★★ | 40 min | 60 |
| 9 | **Le binaire qui obéit trop** | Un carnet de commandes écrit sans vérifier la longueur de la saisie : un débordement de tampon détourne son exécution vers une fonction d'administration qui affiche le drapeau. Aucun privilège en jeu. | `bin-01` | ★★★ | 40 min | 60 |
| 10 | **Le certificat qui ne prouve rien** | Le cadenas est vert. Le certificat est auto-signé. Le chiffrement et l'identité sont deux choses séparées. | `multi-01` (HTTPS 8443) | ★★★ | 35 min | 55 |

**Total : 78 questions** (68 QCM + 9 missions vérifiées sur la machine + 1 mission à réponse saisie) et **300 minutes** de travail effectif, soit environ **5 heures** — le volume d'un « module » de trois mois sur une plateforme de formation.

---

## 3. Le patron pédagogique : quatre étapes, quatre preuves

Chaque scénario suit exactement la même progression. C'est volontaire : l'apprenant sait toujours où il en est.

| Étape | Ce qu'il fait | Ce que cela **prouve** |
|---|---|---|
| **Task 1 — Leçon** (5 min) | Il lit une idée, avec ses mots, et un exemple tiré de la situation du jour. | Il a **compris** (pas encore compris : il va le vérifier). |
| **Task 2 — Entraînement** (2 QCM, ~4 min) | Il répond à deux questions à choix multiple. | Il **reconnaît** l'idée, et sait dire **pourquoi**. |
| **Task 3 — La mission** (10-25 min) | Il joue sur la vraie machine et rapporte le **drapeau**. | Il **sait faire** : le serveur vérifie dans sa machine, pas dans une grille. |
| **Task 4 — Examen** (4-5 questions, 5 min chronométrées) | Il répond seul, sans indice, sous le temps. | Il **retient** sans aide. |

### Le point clé : la mission ne se valide pas à la lecture

C'est le changement le plus important de cette version.

- Le drapeau **n'est jamais** envoyé au navigateur. Le serveur ne le connaît pas non plus : il va le **lire dans le conteneur de l'apprenant**, en root (`docker exec -u 0`), au moment de la validation.
- Le fichier qui porte le drapeau est en `400 root:root` : **l'apprenant ne peut pas le lire**, il doit le trouver *autrement* (dans une configuration, une sauvegarde, un journal, une page web).
- Répondre `FLAG=SECURA{...}` recopié d'un forum ne valide **rien** : le serveur compare avec le contenu réel de la machine.
- Si l'apprenant n'a pas de Docker (hébergement mutualisé), la mission ne peut pas être validée : voir § 5.4, c'est un **point faible assumé**, avec une correction prévue.

---

## 4. L'audit honnête

### 4.1 Est-ce facile à comprendre ?

| Étape | Difficulté réelle | Pour qui ? | Repère |
|---|---|---|---|
| Leçon | ★☆☆ | 14 ans, seul | 3-5 paragraphes, un exemple concret, pas de jargon non expliqué |
| Entraînement (QCM) | ★☆☆ | 14 ans, seul | 4 propositions, un indice après un échec, explication après la réussite |
| Mission | ★★☆ à ★★★ | 14 ans **avec de la patience** | il faut lire, tester, réessayer ; l'indice est progressif (il est modifiable) |
| Examen | ★★☆ | 14 ans | 4-5 questions, 5 minutes, 60 % pour passer |

**Ce qui a été fait pour l'accessibilité :**

- Chaque scénario part d'une **situation**, pas d'un concept : « un ticket d'incident », « un mot de passe oublié », « une page qui se trahit ». Le vocabulaire de la sécurité arrive après, dans la leçon.
- Les indices sont **progressifs** : le premier indice dit quoi regarder, le second dit où regarder.
- Après une réussite, l'apprenant a toujours **l'explication** : la plateforme ne dit jamais « juste ».

### 4.2 Les tests valident-ils vraiment ce qui a été appris ?

C'est la question la plus importante, et la réponse est **« oui pour la mission, partiellement pour les QCM »**.

| Test | Ce qu'il prouve | Ce qu'il **ne** prouve pas | Verdict |
|---|---|---|---|
| **QCM d'entraînement** | L'apprenant distingue 4 propositions et sait dire pourquoi la bonne est bonne (l'explication est affichée après). | Il ne prouve pas qu'il sait **faire**. Un élève qui a lu les réponses peut répondre juste. | Utile, mais insuffisant seul. |
| **Mission (drapeau)** | L'apprenant a **effectivement trouvé** la preuve sur une vraie machine. Impossible à simuler sans Docker. | Elle ne prouve pas la compréhension conceptuelle : on peut avoir trouvé le drapeau par chance, par copier-coller, ou en fouillant au hasard. | **La preuve la plus forte.** |
| **Examen** | Les notions sont retenues, sans indice, sous 5 minutes. Seuil 60 %. | 60 % permet de rater 2 questions sur 5 : on ne peut pas exiger la maîtrise complète. La médaille (or) exige 100 % sans indice. | Bon niveau de contrôle, mais « passe » ≠ « maîtrise ». |

**Les réponses à la question « les tests valident-ils ce qui a été appris ? » :**

1. **Avant cette version, la réponse était NON.** Les questions de démonstration acceptaient plusieurs formulations de la même idée : on ne pouvait pas dire si l'apprenant avait compris ou s'il avait deviné. C'est corrigé : les 68 questions M3 sont des **vrais QCM à une seule bonne réponse**, et les distracteurs sont de **vraies erreurs** (« parce que c'est plus sûr », « il suffit de redémarrer », « parce que l'URL n'est pas chiffrée »…). Un test automatique vérifie qu'aucune proposition n'est en double et que la bonne réponse n'est pas toujours à la même place.
2. **Aujourd'hui, la combinaison leçon → QCM → mission → examen** valide les trois niveaux : comprendre (leçon), reconnaître (QCM), **savoir faire** (mission), retenir (examen). C'est la seule combinaison qui ne peut pas être « passing » par la seule lecture.
3. **Il reste un angle mort assumé** : la mission valide une **action**, pas une **démarche**. Un apprenant qui trouve le drapeau en cherchant au hasard, sans comprendre le pourquoi, réussit. La parade prévue : un « récapitulatif pédagogique » en fin de room (voir § 5.4).

### 4.3 Difficulté de chaque étape, scénario par scénario

Légende : **L** = leçon · **E** = entraînement · **M** = mission · **X** = examen.

| # | L | E | M | X | Ce qui peut bloquer l'apprenant |
|---|---|---|---|---|---|
| 1 | ★☆☆ | ★☆☆ | ★★☆ | ★☆☆ | « Je ne sais pas par où commencer » → l'indice oriente vers la page d'état |
| 2 | ★☆☆ | ★☆☆ | ★★☆ | ★☆☆ | « Où est le mot de passe ? » → il faut lire une configuration, pas deviner |
| 3 | ★★☆ | ★★☆ | ★★★ | ★★☆ | Comprendre que le code s'execute **chez le visiteur** ; puis penser au robot |
| 4 | ★★☆ | ★★☆ | ★★★ | ★★☆ | L'idée de « `' OR 1=1` » ; l'apprenant doit oser casser la syntaxe |
| 5 | ★★☆ | ★★☆ | ★★★ | ★★☆ | La **traversée** demande 3 niveaux (`../../../`) : un niveau de moins ne suffit pas |
| 6 | ★☆☆ | ★☆☆ | ★★☆ | ★★☆ | Reconstituer l'histoire : 401 = échec, 200 = réussite, et **l'ordre** compte |
| 7 | ★★☆ | ★★☆ | ★★★ | ★★☆ | Le nom d'hôte `web` ne se devine pas ; il faut lire `robots.txt` |
| 8 | ★★★ | ★★☆ | ★★★ | ★★★ | **Le pivot** : le nœud interne est invisible, il faut passer par l'outil du nœud web |
| 9 | ★★★ | ★★☆ | ★★★ | ★★★ | Le débordement de tampon demande de l'aisance avec la mémoire et l'assembleur |
| 10 | ★★★ | ★★☆ | ★★★ | ★★☆ | La distinction chiffrement / identité, et le `openssl s_client` |

### 4.4 Ce qui reste faible — et le plan pour le corriger

| # | Faiblesse | Impact | Correctif prévu |
|---|---|---|---|
| 1 | **Sans Docker, la mission est impossible à valider.** Le serveur ne peut pas lire de drapeau. | Bloquant sur hébergement mutualisé | **Repli « mission expliquée »** : si aucun moteur n'est disponible, la mission bascule en mode démonstration — le drapeau est affiché après une action validée par le terminal simulé, et le badge dit « sans machine réelle ». |
| 2 | Le **niveau du scénario 9** (mémoire) est le plus dur ; les 8 et 10 suivent. | Un jeune de 14 ans peut décrocher | Un « parcours léger » (scénarios 1-6 seuls) avec certificat séparé, prévu au jalon M3 bis. |
| 3 | La mission valide une **action**, pas une **démarche**. | Un force brute peut valider | Récapitulatif pédagogique en fin de room : 3 questions « pourquoi c'était la bonne méthode ? ». |
| 4 | Pas de **retour partiel** : la mission est successful or failed. | Un apprenant qui a trouvé 90 % ne peut pas valider | Indices à paliers : chaque indice utilisé enlève des points (le barème le fait déjà pour les questions). |
| 5 | Les **10 scénarios sont en français** ; les traductions AR/EN couvrent titres et titres de tâches, pas le corps des leçons. | Un apprenant arabophone lit l'anglais des leçons | Traduction progressive des leçons, module par module, avec relecture native. |
| 6 | Pas encore de **vidéo courte** par scénario. | Le format « jeu » manque de dynamique | Enregistrement d'un « brief » de 90 s par scénario (même format que les concours de la `securityeducationresourcecollection.net`). |

---

## 5. Alignement MIT (6.858 / 6.857)

### 5.1 Ce qui a été fait

| Scénario | Notion MIT | Leçon / séance 6.858 | Séance 6.857 |
|---|---|---|---|
| 1 — Triage | Réponse à incident, observation avant action | Leçon 3 (Buffer overflows), Leçon 8 (OS) | — |
| 2 — Secret en clair | Gestion des secrets, « stored secrets » | Leçon 11 (Authentication) | — |
| 3 — XSS | Injection, same-origin policy | Leçon 9 (Web security) | — |
| 4 — Injection SQL | Injection, requêtes préparées | Leçon 9 (Web security) | — |
| 5 — Traversée | Contrôle d'accès sur le système de fichiers | Leçon 2 (Trust) | — |
| 6 — Journaux | Journalisation, détection | Leçon 6 (Networking) | — |
| 7 — Ports ouverts | TCP, scan, surface d'attaque | Leçons 4-6 (Networking) | Séance 4 (TCP/IP) |
| 8 — Pivot | Segmentation, reuse de credentials | Leçon 10 (Firewalls) | Séances 5-6 (Pare-feu, segmentation) |
| 9 — Mémoire | NX, ASLR, canary, ROP | **Leçon 3 (Buffer overflows)** + Leçon 8 (OS) | — |
| 10 — TLS | Chiffrement, authentification du serveur, SNI | Leçon 7 (Security in the browser) | Séance 8 (TLS) |

**Verdict :** les dix scénarios sont **cohérents** avec les notions de 6.858 et de 6.857, et le scénario 9 suit **exactement** le contenu de la leçon 3 (débordement de tampon → defenses → ROP). Ils ne couvrent **pas** les 24 leçons de 6.858 ni les 18 séances de 6.857 : **10 scénarios sur 42 séances**, soit environ un quart du programme. C'est annoncé, pas caché — le palier universitaire complet (14 rooms 6.858 + 20 rooms 6.857, barème 20/35/25/20) reste au jalon **M7**.

### 5.2 Ce qui n'est pas aligné (et pourquoi c'est assumé)

- **Le public n'est pas le même.** 6.858 est un cours degraduate ; le public visé ici a 14 ans. Le même contenu est traité avec des situations concrètes, pas avec des conjectures de système.
- **Pas de notation MIT.** Les scénarios donnent des XP et des médailles, pas des notes sur 100 avec barème de cours. La notation arrive au jalon M7, quand le palier universitaire existe.
- **Pas de problem sets.** Les 5 problem sets de 6.857 ne sont pas repris : ils supposent des partitioned systems et un compilateur C. La version « apprenant » correspond est le scénario 9.

---

## 6. Les cours gratuits d'autres universités : réponse honnête

**Réponse directe : non, ils n'ont pas été ajoutés au parcours.** Aucune de ces ressources n'apparaît aujourd'hui dans une room ou dans le parcours M3. Les scénarios M3 sont **entièrement écrits pour Secura Academy** (textes originaux, illustrations originales, zéro reprise de contenu).

Ce qui a été fait, en revanche, c'est le **recensement** et la **vérification des licences** (`docs/SOURCES-CONTENU.md`) :

| Ressource | Licence vérifiée | Ce qu'on pourrait reprendre | Ce qu'on ne peut pas |
|---|---|---|---|
| **MIT OCW 6.858 / 6.857** | CC BY-NC-SA 4.0 | Les **notions** et le **plan** (déjà fait : § 5), avec attribution + ShareAlike | Les textes des leçons tels quels (partage de contenu contaminé) |
| **pwn.college** (ASU) | Vidéos/slides réutilisables « for non-commercial purposes, please provide attribution » ; moteur **BSD-2-Clause** | Des **vidéos courtes** de 90 s par scénario, et l'**approche « dojo »** (défis notés) | Les writeups (interdits explicitement) |
| **CYBER.ORG** | Curriculums K-12 gratuits (vidéos courtes + Kahoot) | Le **format** de la vidéo courte et le Kahoot comme révision | Le contenu verbatim |
| **Stanford SEE** | CC BY-NC-SA 4.0 | Des **sujets d'examens** annoncés pour les élèves Gifted (les « topics ») | Les textes d'examen |
| **OWASP Cheat Sheet Series** | **CC BY-SA 4.0** (vérifié via l'API GitHub) | Des **fiches de référence** (à citer, avec lien) | Modifier et redistribuer sans obligation de partage |
| **NIST SP 800-207 / 800-41r1** | Domaine public | Des **modèles de configuration** (Zero Trust, pare-feu) | — |
| **RFC 9293 (TCP)** | Document public | Les **extraits de la RFC** (numéros de port, en-têtes) | — |

**Le plan (jalon M3 bis, non fait à ce jour) :**

1. Ajouter une **section « Pour aller plus loin »** en fin de scénario : 3-5 liens vers les ressources ci-dessus, avec la licence notée. Coût : une demi-journée. Risque : quasi nul.
2. Intégrer **6 vidéos courtes** (pwn.college / CYBER.ORG) en « brief » de scénario. Coût : une semaine (montage, sous-titres AR/EN).
3. Créer un **« dojo » de défis notés** (sur le modèle pwn.college) : 20 défis courts, notés en points, sur nos machines. Coût : deux semaines.
4. Un **Kahoot de révision** par module. Coût : deux heures, mais il faut un compte et la conformité RGPD des réponses est à vérifier.

---

## 7. L'expérience apprenant (UX)

Ce qui a été fait pour que l'ensemble soit « professionnel » et non un bricolage :

| Élément | Avant | Maintenant |
|---|---|---|
| Mission | « tape la bonne réponse » | **Machine réelle, drapeau vérifié côté serveur**, barre d'état de la machine, bouton « Arrêter » |
| QCM | champ de texte, plusieurs formulations acceptées | **4 boutons radio**, position de la bonne réponse mélangée, indice après l'échec, explication après la réussite |
| Erreur | « Pas encore, réessayez » | Message + **indice** + compteur de points (l'indice coûte la moitié des points) |
| Progression | pourcentage | Barre + **12 niveaux**, XP, médailles (bronze ≥ 60 %, argent ≥ 80 % sans indice, or = 100 % sans indice), série de jours |
| Verrouillage | aucun | **Progression verrouillée** : on ne peut pas passer à la tâche suivante sans avoir réussi la précédente |
| Exams | sans limite | **Chronométrés côté serveur**, reprise d'un examen raté, seuil 60 % |
| Parcours | aucun regroupement | **Parcours « Scénarios M3 »** en 5 modules, avec certificat à la clé |
| Nettoyage | conteneurs qui traînent | Arrêt et nettoyage automatiques (TTL 1 h + nettoyage horaire par étiquettes) |

**Deux détails qui font la différence pour un jeune :**

- Le **terminal est affiché à côté du contenu**, pas dans un onglet caché : l'apprenant lit la leçon et joue en même temps.
- La **barre « Déployer la machine »** est explicite : il sait qu'il va travailler sur une vraie machine, ce qui donne du poids à l'exercice.

---

## 8. Le moteur : une vraie validation, testée par Docker

Le moteur n'est pas une simulation : c'est Docker.

1. **Le plugin déploie** un conteneur par apprenant et par room (`seca_lab_<apprenant>_<room>`), réseau `--internal` (aucune sortie Internet), projet Compose renommé (`seca_<prefixe>_<apprenant>_<room>`).
2. **L'apprenant** tape des commandes réellement exécutées dans le conteneur (`docker exec`), avec liste blanche et blocages durs (`sudo`, `nsenter`, `docker`…).
3. **La validation** : le serveur lit le fichier de drapeau **dans le conteneur, en root**, et compare (`strcasecmp`). Le drapeau attendu **n'existe nulle part côté WordPress**.
4. **L'automatisation** : `.github/workflows/labs.yml` construit les 4 images et joue `scripts/test-labs-ci.sh` à chaque push — **42 contrôles** sur Docker réel, dont le rejeu des 10 scénarios M3 (triage, injection SQL, XSS, robot, traversée, sauvegarde, journaux, TLS, export, pivot, détournement de binaire) et la preuve que **le nœud interne est invisible depuis la machine de l'apprenant**.
5. **Le bac à sable de développement** n'a pas de démon Docker (aucun privilège noyau) : les tests y sont joués avec un runtime rootless (Podman), et c'est cette limite qui a fait écrire les corrections (port 8080, `set -e`, `mkdir` refusé en utilisateur non root…).

---

## 9. Ce qui reste à faire (par ordre)

| Priorité | Action | Pourquoi |
|---|---|---|
| 1 | **Repli « mission expliquée »** quand aucun moteur n'est disponible | Sans lui, la plateforme est inutilisable sur hébergement mutualisé (c'est le mode par défaut des Shared Hosts) |
| 2 | **Vidéos de brief** (6 scénarios) + « pour aller plus loin » | La partie « jeu » manque de dynamique ; c'est aussi la porte d'entrée pwn.college / CYBER.ORG |
| 3 | **Récapitulatif pédagogique** en fin de room | Valider la démarche, pas seulement l'action |
| 4 | **Parcours léger** (scénarios 1-6) avec certificat séparé | Servir le public 14 ans sans décrochage sur la mémoire |
| 5 | **Traduction AR/EN du corps des leçons** | Un apprenant arabophone doit lire dans sa langue |
| 6 | **Palier universitaire M7** (6.858 + 6.857, barème 20/35/25/20) | Cible : le « niveau MIT » du projet, avec problem sets notés |

---

*Document append-only : les revues suivantes s'ajoutent en bas, sans effacer les réponses données ici.*
