# Plan de contenu — parcours « Secura Academy » inspirés des cours MIT

**Date :** 31 octobre 2026
**Sources consultées :** MIT OpenCourseWare, 6.858 *Computer Systems Security* (Fall 2014, Pr. Nickolai Zeldovich) et 6.857 *Network and Computer Security* (Spring 2014, Pr. Ronald Rivest) — pages syllabus et cours.

---

## 0. Licence des supports OCW — ce qui est réellement permis (corrigé le 31/10/2026)

> **Correction d'une erreur du premier jet de ce document.** La version initiale
> concluait que les supports MIT OCW ne pouvaient pas être réutilisés. **C'est
> faux pour notre usage** : la plateforme est gratuite, la clause
> *NonCommercial* est donc satisfaite. Le permis de réutilisation est réel, à
> condition de respecter trois obligations.

Les supports de l'OCW sont publiés sous **CC BY-NC-SA 4.0** (Attribution -
NonCommercial - ShareAlike). L'interprétation officielle de MIT est explicite :

> « *Non-commercial use* means that users may not sell, profit from, or
> commercialize OCW materials or works derived from them. »
>
> « *A commercial education or training business may not offer courses based on
> OCW materials **if students pay a fee** for those courses and the business
> intends to profit as a result.* »
> — MIT OCW, *Privacy and Terms of Use* (dernière mise à jour 08/11/2026)

**Conséquence directe :** proposer gratuitement un cours « sur la base » des
supports OCW est **explicitement envisagé** par ces termes. Un site gratuit n'a
rien à vendre, donc rien à négocier.

### Ce qui est permis à Secura Academy

- **Adapter et republier** les notes, polycopiés, énoncés et labs de l'OCW, en
  les traduisant, les découpant en rooms, en les gamifiant, **si** la plateforme
  reste **gratuite** pour l'apprenant.
- Utiliser l'OCW comme **source** : sujets, méthodes, schémas, jeux de données,
  labs, « problem sets », barèmes d'évaluation.
- Faire un **outil payant** sur l'OCW : l'usage interne (formation d'une
  entreprise, par exemple) est autorisé tant qu'il ne s'agit pas de vendre le
  matériau lui-même.

### Les trois obligations à respecter

| Obligation | Ce qu'elle implique concrètement chez nous |
|---|---|
| **Attribution** | Credit MIT + lien vers la licence + indiquer les modifications + **ne jamais laisser entendre un approbation de MIT** (pas de logo MIT, pas de « cours officiel MIT ») |
| **NonCommercial** | Le contenu adapté reste gratuit. Toute monétisation future du contenu interdit sa réutilisation sans réécriture ou autorisation écrite de l'OCW |
| **ShareAlike** | Les **adaptations** (rooms dérivées des supports) restent publiées sous **CC BY-NC-SA 4.0**. Le **code** de la plateforme reste sous MIT : ShareAlike ne s'applique pas au logiciel qui héberge le contenu |

### Ce qui reste interdit

- Revendre, facturer, ou tirer un revenu direct ou indirect du contenu
  adapté (publicité sur une page de contenu OCW compte comme une
  commercialisation).
- Présenter la plateforme comme un produit **approuvé ou soutenu par le MIT**.
- Utiliser le nom « MIT » ou les logos à des fins promotionnelles (l'usage pour
  l'attribution reste possible).
- Réutiliser les **vidéos** de l'OCW dans notre lecteur : ce sont des fichiers
  vidéo distincts, à licence distincte ; on les **lie** plutôt qu'on les
  embarque.

### Décision retenue pour Secura Academy

1. **Le code** de la plateforme reste **MIT**.
2. **Le contenu** de chaque room indique en pied de page ses sources et sa
   licence : « *D'après MIT OpenCourseWare 6.858 / 6.857 — CC BY-NC-SA 4.0 —
   adaptation Secura Academy.* »
3. Une **page de crédits** par parcours et par room regroupant les sources.
4. Le contenu **original** (les 6 rooms actuelles) reste sous licence MIT.
5. Si un jour le projet veut gagner de l'argent **sur le contenu**, il faut
   réécrire les rooms concernées ou obtenir une autorisation écrite de l'OCW.
   Le code, lui, reste réutilisable librement.

**Effet sur la charge éditoriale :** la réutilisation autorisée réduit
considérablement le coût du contenu (voir § 8). On n'écrit plus chaque room de
zéro : on **adapte** un support existant (avec attribution), on le gamifie, on
le valide par un lab réel. L'effort éditorial restant porte sur l'adaptation, la
structuration pédagogique, les drapeaux et l'industrialisation.

> Note : les 6 rooms existantes dans le plugin sont des exercices **originaux** :
> elles restent sous licence MIT et constituent la **couche 0** du catalogue.

---

## 1. Les quatre types d'activité

Chaque type a un rôle pédagogique, une règle d'indice et un barème distincts.

| Type | Rôle | Indice | XP | Évalue |
|---|---|---|---|---|
| **Leçon** (`lesson`) | Apport de connaissances, lecture active | — | 0 | Non |
| **Entraînement** (`practice`) | Mise en œuvre assistée, acquisition | oui | ×0,5 | Non |
| **Test d'application** (`test`) | Transfert :scenario applicatif réel, sans aide | non | ×1,0 | Oui |
| **Examen** (`exam`) | Synthèse chronométrée, sans aide | non | ×1,5 | Oui (seuil) |

**Règle de progression d'une room :** une tâche de type *test* ou *exam* est **verrouillée** tant que la tâche précédente n'est pas validée. Le verrouillage est pédagogique (on ne teste pas avant d'avoir appris), jamais punitif.

---

## 2. Gabarit d'une room

C'est le patron à appliquer à **toutes** les rooms. Ordre obligatoire : `leçon → entraînement → test`.

### Exemple complet — « La poignée de main TLS » (6.858 / 6.857, difficile, 35 min)

```
ROOM : La poignée de main TLS
├── Difficulty: difficile   Durée: 35 min   Bonus XP: 60   Type: walkthrough

├── TASK 1 — type: leçon
│   Titre: « Comment s'établit un canal chiffré »
│   Contenu: ClientHello → ServerHello → Certificate → Key exchange → Finished
│   Encadrés: schéma de la négociation, tableau des versions, schéma des messages
│   Aucun point. Bouton « J'ai compris » → déverrouille la tâche 2.
│
├── TASK 2 — type: entraînement
│   Titre: « Reconstruire la négociation »
│   6 questions, indices progressifs (3 niveaux), ×0,5
│   Q1. Quel message initiates la négociation ?        → ClientHello
│   Q2. Quelle extension propose SNI ?                → server_name
│   Q3. Quel algorithme negotiate la clé de session ? → (EC)DHE
│   Q4. Que vérifie le Finished du serveur ?           → Le transcript
│   Q5. Quel élément prouve l'identité du serveur ?   → Le certificat
│   Q6. Pourquoi 1-RTT ?                              → PSK + ticket de session
│
├── TASK 3 — type: test d'application
│   Titre: « Auditer une configuration TLS »
│   Contexte: une capture d'une négociationaltimeout + 8 questions
│   Aucun indice. ×1,0
│   → "Le serveur propose TLS 1.0 : quel est le risque ?"
│   → "Aucune extension SNI : quelle conséquence ?"
│   → "Le Finished ne correspond pas au transcript : que s'est-il passé ?"
│   → …
│
└── TASK 4 — type: examen
    Titre: « Examen — TLS et PKI »
    12 questions · 15 min · seuil 70 % · aucun indice · ×1,5
    Médaille bronze ≥70 / argent ≥80 / or ≥90
```

---

## 3. Parcours 1 — « Fondations : réseaux, web et cryptographie »

**Public :** débutant · **Difficulté :** facile → intermédiaire · **Durée estimée :** 14 h · **Rooms :** 22 · **Examen final :** oui · **Projet final :** oui

*Sources : 6.857 (réseaux, cryptographie, protocoles d'authentification) + introduction 6.858 (modèles de menace, sécurité des applications web).*

| # | Module | Rooms | Tâches par room | Durée |
|---|---|---|---|---|
| M1 | Introduction à la cybersécurité | 1.1 Menaces, vulnérabilités, risques | L + E(6) + T(5) | 45 min |
| | | 1.2 Le vocabulaire de l'ingénieur sécurité | L + E(6) + T(5) | 40 min |
| | | **Récap de section** | QCM 10 (non noté) | 10 min |
| M2 | Fondamentaux des réseaux | 2.1 Topologies et commutation | L + E(6) + T(5) | 45 min |
| | | 2.2 Modèle OSI et encapsulation | L + E(7) + T(5) | 50 min |
| | | 2.3 Adressage IPv4 et sous-réseaux | L + E(8) + T(6) | 60 min |
| | | 2.4 TCP, UDP et ports | L + E(6) + T(5) | 45 min |
| | | 2.5 Routage et passerelles | L + E(6) + T(5) | 45 min |
| M3 | Le web, HTTP et DNS | 3.1 Anatomie d'une requête HTTP | L + E(7) + T(6) | 50 min |
| | | 3.2 DNS, de A à PTR | L + E(7) + T(6) | 50 min |
| | | 3.3 Anatomie d'une application web | L + E(6) + T(5) | 45 min |
| M4 | Cryptographie | 4.1 Hachage et intégrité | L + E(7) + T(6) | 55 min |
| | | 4.2 Chiffrement symétrique | L + E(7) + T(6) | 55 min |
| | | 4.3 Chiffrement asymétrique et Diffie-Hellman | L + E(8) + T(6) | 65 min |
| | | 4.4 Signatures numériques | L + E(7) + T(6) | 55 min |
| | | 4.5 Protocoles d'authentification | L + E(7) + T(6) | 55 min |
| M5 | TLS, certificats et HTTPS | 5.1 La négociation TLS | L + E(7) + T(6) | 55 min |
| | | 5.2 Certificats et PKI | L + E(6) + T(5) | 45 min |
| | | 5.3 Auditer une configuration HTTPS | L + E(6) + T(8) | 60 min |
| M6 | Contrôle d'accès et authentification | 6.1 Modèles de contrôle d'accès | L + E(6) + T(5) | 45 min |
| | | 6.2 Capacités et moindre privilège | L + E(6) + T(5) | 45 min |
| | | 6.3 MFA et gestion des secrets | L + E(6) + T(5) | 45 min |
| M7 | Menaces réseau et défense | 7.1 Attaques réseau classiques | L + E(7) + T(6) | 55 min |
| | | 7.2 Détecter et défendre | L + E(6) + T(7) | 55 min |
| M8 | **Évaluation finale** | Examen final (25 q · 30 min · seuil 70 %) | X | 30 min |
| | | Projet final (dossier + auto-évaluation) | — | 2 h |

---

## 4. Parcours 2 — « Sécurité des systèmes »

**Public :** intermédiaire → avancé · **Difficulté :** intermédiaire → difficile · **Durée estimée :** 20 h · **Rooms :** 24 · **Projet final :** oui (attaque **ou** défense)

*Sources : 6.858 intégralement (OS security, capabilities, information flow control, language security, hardware security, network protocols, web applications security).*

| # | Module | Rooms | Tâches par room | Durée |
|---|---|---|---|---|
| M1 | Modèles de menace | 1.1 Construire un modèle de menace | L + E(6) + T(8) | 60 min |
| | | 1.2 Analyse de risque et priorisation | L + E(6) + T(7) | 55 min |
| M2 | Sécurité des systèmes d'exploitation | 2.1 Isolation et moindre privilège | L + E(7) + T(6) | 55 min |
| | | 2.2 Contrôle d'accès obligatoire vs discrétionnaire | L + E(7) + T(7) | 60 min |
| M3 | Mémoire et protections | 3.1 Dépassement de tampon : mécanisme | L + E(8) + T(7) | 70 min |
| | | 3.2 NX, ASLR, canary : les contre-mesures | L + E(8) + T(8) | 70 min |
| | | 3.3 Test d'analyse défensive | L + T(10) | 50 min |
| M4 | Contrôle de flux d'information | 4.1 Étiquettes, TCB et politique | L + E(7) + T(7) | 60 min |
| | | 4.2 Fuite d'information par canal auxiliaire | L + E(6) + T(6) | 55 min |
| M5 | Sécurité des langages | 5.1 Sûreté mémoire et langages managés | L + E(7) + T(6) | 55 min |
| | | 5.2 Validation des entrées côté serveur | L + E(7) + T(7) | 55 min |
| M6 | Sécurité du matériel | 6.1 Attaques matérielles | L + E(6) + T(6) | 50 min |
| | | 6.2 TPM, Secure Boot, clés matérielles | L + E(6) + T(6) | 50 min |
| M7 | Sécurité des applications web | 7.1 Injection SQL | L + E(8) + T(8) | 65 min |
| | | 7.2 XSS et CSP | L + E(7) + T(7) | 60 min |
| | | 7.3 CSRF, SSRF, XXE | L + E(7) + T(7) | 60 min |
| | | 7.4 En-têtes de sécurité et TLS côté web | L + E(7) + T(7) | 60 min |
| M8 | **Projet final** | Serveur web miniature : auditer ou components à durcir (3–4 personnes) | — | 4 h |
| M9 | **Évaluation finale** | Examen final (30 q · 45 min · seuil 75 %) | X | 45 min |

---

## 5. Structure d'évaluation calquée sur celle du MIT

L'architecture d'évaluation des deux cours est reprise (elle n'est pas protégée) et traduite en mécanique de plateforme.

| MIT | Barème MIT | Équivalent Secura | Barème Secura |
|---|---|---|---|
| Homework / Problem Sets (40 % en 6.857, 20 % en participation en 6.858) | 5 à 6 séries | **Entraînement** (`practice`) | 20 % de la note de parcours |
| Labs (35 % en 6.858) | 6 labos | **Test d'application** (`test`) | 35 % |
| 2 quizzes (20 % en 6.858) | 2 quiz | **Examen de module** (`exam`) | 20 % |
| Final project (25–40 %) | Projet de groupe | **Projet final** | 25 % |
| — | — | Participation / récaps de section | 5 % |

**Règles issues du policy MIT, transposables :**
- *« No collaboration on quizzes »* → **l'examen est individuel et sans aide** ; le mode examen verrouille les indices.
- *« All labs must be turned in »* → **une room non complétée bloque la progression** (verrouillage déjà implémenté).
- *« Grading via checking scripts »* → **la validation est automatique et reproductible** (notre AJAX côté serveur, jamais côté client).
- *« 72 late hours »* → prévoir une **marge de tolérance** (ex. 3 tentatives par test d'application avant blocage définitif).

---

## 6. Mapping MIT → rooms → médailles

| Room | Module MIT d'origine | Type dominant | Difficulté | Médaille max |
|---|---|---|---|---|
| Menaces, vulnérabilités, risques | 6.858 *Threat models* | test | facile | 🥈 |
| Topologies et commutation | 6.857 *Networks* | test | facile | 🥈 |
| Modèle OSI et encapsulation | 6.857 *Networks* | test | facile | 🥈 |
| Adressage IPv4 et sous-réseaux | 6.857 *Problem sets* | test | moyen | 🥇 |
| Hachage et intégrité | 6.857 *Crypto* | test | moyen | 🥇 |
| Chiffrement asymétrique et DH | 6.857 *Crypto* | test | difficile | 🥇 |
| Signatures numériques | 6.857 *Crypto* | test | difficile | 🥇 |
| La négociation TLS | 6.858 *Network protocols* | test | difficile | 🥇 |
| Certificats et PKI | 6.857 *Crypto* | test | moyen | 🥇 |
| Dépassement de tampon | 6.858 *Attacks* | test | difficile | 🥇 |
| NX, ASLR, canary | 6.858 *Attacks* | test | difficile | 🥇 |
| Étiquettes et TCB | 6.858 *Information flow control* | test | difficile | 🥇 |
| Injection SQL | 6.858 *Web applications* | test | moyen | 🥇 |
| XSS et CSP | 6.858 *Web applications* | test | difficile | 🥇 |
| Serveur web miniature (projet) | 6.858 *Labs* | projet | expert | 🏅 |

---

## 7. Bibliographie à afficher en fin de room

Chaque room se termine par un bloc de références, indispensable juridiquement et utile pédagogiquement :

> **Sources et approfondissement**
> - Nickolai Zeldovich, *Computer Systems Security* (6.858), MIT OpenCourseWare, Fall 2014 — <https://ocw.mit.edu/courses/6-858-computer-systems-security-fall-2014/> — CC BY-NC-SA 4.0.
> - Ronald Rivest, *Network and Computer Security* (6.857), MIT OpenCourseWare, Spring 2014 — <https://ocw.mit.edu/courses/6-857-network-and-computer-security-spring-2014/> — CC BY-NC-SA 4.0.
> - Ce contenu est une rédaction originale de Secura Academy, inspirée des thèmes de ces cours.

---

## 8. Charge éditoriale

| Élément | Quantité | Écriture originale | Adaptation OCW (gratuite, § 0) |
|---|---|---|---|
| Rooms (parcours 1) | 22 | 3 h → 66 h | 1,5 h → 33 h |
| Rooms (parcours 2) | 24 | 3,5 h → 84 h | 1,5 h → 36 h |
| Projets finaux + barème | 2 | 8 h → 16 h | 5 h → 10 h |
| Examen final (conception + relecture) | 2 | 6 h → 12 h | 4 h → 8 h |
| **Total** | | **≈ 178 h** | **≈ 87 h** |

La réutilisation autorisée (gratuit, § 0) **divise par deux la charge
éditoriale** : le temps restant porte sur l'adaptation, la structuration
pédagogique, les drapeaux et les labs, pas sur la rédaction from scratch.
C'est le moyen de passer de 6 à 46 rooms sans exploser le budget.

À comparer : **≈ 46 rooms**, contre 6 aujourd'hui. C'est le vrai coût du « digne de TryHackMe » : la mécanique est faite (P0), mais **le contenu est le goulot d'étranglement**. Deux options réalistes :

1. **Rythme soutenable (recommandé) :** livrer le parcours 1 en 3 vagues de 7-8 rooms (≈ 21 h de rédaction par vague), le parcours 2 ensuite.
2. **Livrer la mécanique d'abord, le contenu ensuite :** c'est ce que font les phases P0 — la plateforme est prête à accueillir le contenu dès qu'il existe.

Dans les deux cas, le premier sprint doit produire **une room témoin** respectant le gabarit complet (leçon + entraînement + test + examen) : elle sert de **référence de rédaction** et de **test de bout en bout** de la nouvelle mécanique.

L'ordonnancement des chantiers est piloté par `docs/ROADMAP.md` (milestone M3
« Contenu : 10 rooms réelles »).

---

## 9. Le palier 3 — « universitaire », format MIT

### 9.1 Ce que c'est (et ce que ce n'est pas)

C'est le **troisième palier** de la plateforme, ajouté le 31/10/2026 après
l'audit apprenant (`docs/AUDIT-EXPERIENCE-APPRENANT.md`).

| | Palier 1 — Initiation | Palier 2 — Perfectionnement | **Palier 3 — Universitaire** |
|---|---|---|---|
| Public | 12-14 ans | 15-18 ans, autodidactes | 17-22 ans, étudiants |
| Durée | 6 h | 20 h | **120 h (2 semestres)** |
| Rooms | 10 | 46 | **34 (14 sys + 20 crypto)** |
| Barème | XP / médailles | XP / médailles | **notes : 20 / 35 / 25 / 20** |
| Labs | simulés + 2 réels | réels | **notés par scripts** |
| Projet | — | projet de room | **projet de groupe noté** |
| Certificat | Fin de parcours | Fin de parcours | **Certificat + relevé de notes** |
| MIT de référence | — | 6.858 (partiel) | **6.858 + 6.857 complets** |

**Ce n'est pas** un diplôme, et nous ne le prétendons pas. C'est un **parcours
niveau licence**, avec le **même barème, la même discipline d'évaluation et la
même_partition des rôles** que les cours MIT dont il est inspiré. L'apprenant
qui le suit suit réellement un syllabus graduate — il ne « fait pas semblant »
d'avoir fait un cours plus facile.

### 9.2 Le barème, mot pour mot

| Composante | Poids MIT | Poids Secura | Qui évalue | Comment |
|---|---|---|---|---|
| **Quiz** | 20 % | **20 %** | serveur | 2 quiz chronométrés, sans indice, individuelle |
| **Labs** | 35 % | **35 %** | scripts | les labs sont notés par un **script de correction** (exit code + sortie attendue) |
| **Projet** | 25 % | **25 %** | à la main + auto-évaluation | dépôt d'un dossier + code + note auto-évaluée sur grille |
| **Homework** | 20 % | **20 %** | serveur | 5 séries de devoirs (PS), notées automatiquement |

**Règles de discipline** (transposées du policy MIT, cf. § 5) :
- un quiz est **individuel et sans aide** : aucun indice, chronomètre serveur,
  une seule tentative par jour (reprise possible après échec, comme le
  prévoit déjà le moteur d'examens) ;
- les **labs doivent être rendus** : une room non complétée **bloque** la
  progression ;
- la correction est **automatique et reproductible** : c'est déjà le cas
  (`Secura_Progress::answer_matches`, `Secura_Lab::run`) ;
- pas de collaboration sur les quiz, **collaboration encouraged sur le projet**
  (groupes de 3-4), comme à MIT.

### 9.3 Le « lab noté » : ce qu'il faut inventer

C'est le seul manque technique réel du palier 3. Un lab MIT, c'est un programme
à écrire, un script qui le corrige, et une note.

**Notre implémentation (proposée) :**

1. Le lab est une **image Docker** (`labs/crypto-01` pour la crypto,
   `labs/bin-01` déjà existant pour le binaire, `labs/web-01` pour le web).
2. La room déclare un **manifeste de lab étendu** :
   `checks: [ { id, command, expect_exit, expect_output, points } ]`.
3. Le serveur lance le **script de correction** dans le conteneur de
   l'apprenant (`Secura_Lab::run`, commande déjà lista), récupère le code
   de sortie et compare la sortie au motif attendu.
4. La note du lab = **points parts** ; le total est cumulé dans
   `user_meta` et affiché dans le **relevé de notes**.
5. Le retour est **progressif** : le script dit *quel* check a échoué (« le
  Padding n'a pas été appliqué »), pas seulement « faux ».

**Coût : 4 jours** (extension du manifeste + runner de checks + relevé de
notes + affichage). C'est le seul poste technique du palier 3.

### 9.4 Les trois projets notés (25 %)

| Projet | Contenu | Se note en | Groupes |
|---|---|---|---|
| **P1 — Audit d'une application web** | trouver et corriger 5 vulnérabilités dans `labs/web-01` vulnérable, rapport + patch | grille /20 | 3-4 |
| **P2 — Implémentation cryptographique** | implémenter un schéma (ex. secret sharing, ou un MAC) **sans bibliothèque**, avec preuve de sécurité commentée | grille /20 | 2-3 |
| **P3 — Modèle de menace** | modéliser la menace sur une cible imposée (fork, serveur de vote, application mobile), rapport d'attaque et de défense | grille /20 | 3-4 |

Le projet est **déposé** dans la plateforme (fichier + lien) et évalué sur une
grille publiée à l'avance (critères, points, ce qui est attendu). Auto-évaluation
obligatoire de l'étudiant (l'auto-évaluation entre dans la note : elle vérifie
la réflexe de métacognition, exactement comme le peer review à MIT).

### 9.5 Le relevé de notes

Nouvelle page (shortcode `[secura_academy_transcript]`) :
- tableau par **composante MIT** (quiz / labs / projet / homework) ;
- note finale **/100**, mention (« 14-12 : passable », « 16-20 : très bien ») ;
- export **PDF** (le certificat existe déjà en `@media print`, on réutilise le
  moteur) ;
- **pas de classement** : c'est un relevé individuel, pas un concours.

---

## 10. Couverture 6.858 — les 24 leçons, sans exception

La liste complète des leçons du cours (page *Lecture Notes*, Fall 2014) est
reprise ci-dessous avec le **statut réel** de couverture dans la plateforme et
la **room** à écrire. Les 10 notions marquées **MANQUE** sont celles que
l'audit a identifiées comme absentes.

| # | Leçon 6.858 | Statut | Room du palier 3 | Nature |
|---|---|---|---|---|
| 1 | Threat models | couvert (palier 2) | 2.1 Modèle de menace | projet |
| 2 | Control hijacking attacks | couvert (palier 2) | 3.1 Dépassement de tampon | lab |
| 3 | Buffer overflow | couvert (palier 2) | 3.1 + 3.2 | lab |
| 4 | Privilege separation | couvert (palier 2) | 2.1 Isolation et moindre privilège | lab |
| 5 | **Capabilities** | **MANQUE** | 2.4 Capacités : possession, pas autorité | lab (C, Linux) |
| 6 | Sandboxing | couvert (palier 2) | 2.2 Sandbox et isolation | lab |
| 7 | Web security model | couvert (palier 2) | 7.1 Anatomie d'une application web | mixte |
| 8 | Securing web applications | couvert (palier 2) | 7.2-7.4 SQLi / XSS / CSRF | lab |
| 9 | **Symbolic execution** | **MANQUE** | 3.3 Exécution symbolique : tester sans exécuter | lab (Python) |
| 10 | **Ur/Web** | **MANQUE** | 7.5 Ur/Web : vérifier le comportement d'un site | projet |
| 11 | Network security | partiel (palier 1) | 2.2 Réseau : qui parle à qui | lab (`net-01`) |
| 12 | Network protocols | partiel (palier 1) | 2.3 Protocoles et ports | lab |
| 13 | SSL/HTTPS | couvert (palier 1) | 5.1-5.3 TLS et certificats | lab |
| 14 | **Side channels** | **MANQUE** | 4.2 Canaux auxiliaires : le temps, la cache, l'énergie | lab (Python, timing) |
| 15 | User authentication | couvert (palier 1) | 6.3 MFA et gestion des secrets | mixte |
| 16 | **Private browsing** | **MANQUE** | 1.2 Naviguer sans trace : ce que le navigateur oublie | mixte |
| 17 | **Anonymous communication** | **MANQUE** | 1.3 Communiquer sans se révéler : Tor, mixnets, chaînes d'anonymat | projet |
| 18 | **Mobile security** | **MANQUE** | 8.1 Sécurité mobile : permissions, stockage, hooking | lab (Android) |
| 19 | **Data tracking** | **MANQUE** | 8.2 Le pistage : cookies, pixels, fingerprinting | lab (navigateur) |
| 20 | **Security economics** | **MANQUE** | 1.4 L'économie de la sécurité : pourquoi on ne corrige pas | mixte |
| 21 | (autres leçons du syllabus : *Information flow control*, *Language-based security*, *Hardware security*, *Return-oriented programming*, *Control-flow integrity*, *Randomness*, *TPM*, *Policy*, *Case studies*) | partiel | 4.1 IFC · 5.1 Sûreté mémoire · 6.1 Attaques matérielles · 6.2 TPM | lab |

**Verdict** : avec ces 14 rooms, la **couverture 6.858 passe de 9/24 à 24/24**.
Chaque notion est **réécrite** (ton « 17-22 ans », pas « 12 ans »), avec un
**lab réel** quand c'est possible et une **bibliographie OCW** en fin de room.

**Charge** : 14 rooms × 3 h de rédaction + 4 h de lab ≈ **98 h** de contenu
(original), dont ≈ 60 h grâce à l'adaptation OCW (§ 0).

---

## 11. Couverture 6.857 — toute la cryptographie avancée

6.857 (*Network and Computer Security*, Spring 2014) est un cours de
**cryptographie avancée** : 26 séances, 5 problem sets, pas d'examen final.
C'est le cœur mathématique de ce que nous n'avons pas aujourd'hui.

| # | Séance 6.857 | Room | Lab à écrire | Difficulté |
|---|---|---|---|---|
| 1 | Introduction, cryptographie et politique | 4.1 La cryptographie, pour quoi faire ? | — | facile |
| 2 | Principes de cryptographie (Kerckhoffs) | 4.2 Kerckhoffs : la clé est secrète, le reste est public | — | facile |
| 3 | **One-time pad** et **perfect secrecy** | 4.3 Le one-time pad et le secret parfait | **Python** : PAD + test de fréquence | moyen |
| 4 | **Hash functions** | 4.4 Hachage : empreintes, sel, coût | **Python** : SHA-256 + collisions | moyen |
| 5 | **Bitcoin** (début) | 9.1 Bitcoin : chaîne, blocs, preuves de travail | **Python** : verifier un bloc | moyen |
| 6 | **Secret sharing** (Shamir) | 9.2 Partager un secret sans le transmettre | **Python** : polynôme de Shamir | difficile |
| 7 | **Block ciphers** (AES, DES) | 4.5 Chiffrement par blocs : modes et structure | **Python** : AES (ECB) | moyen |
| 8 | **Modes of operation** (CBC, CTR, AEAD) | 4.6 modes : pourquoi ECB est un mauvais choix | **Python** : implémenter CBC/CTR | difficile |
| 9 | **MAC** (HMAC) | 4.7 Intégrité : MAC, HMAC et le paradoxe | **Python** : HMAC + attaque par allongement | difficile |
| 10 | Cryptographie mathématique (groupes, Zp\*) | 4.8 Groupes, générateurs, ordre | **Python** : arithmétique modulaire | difficile |
| 11 | **Diffie-Hellman** | 4.9 Diffie-Hellman et le problème du logarithme discret | **Python** : DH + MITM | difficile |
| 12 | **Pedersen commitments** | 9.3 Engagements à Pedersen | **Python** : commit/reveal | expert |
| 13 | **ElGamal + IND-CCA2** | 9.4 Chiffrement CCA2 : ElGamal et ses variantes | **Python** : Chabaud | expert |
| 14 | **Signatures numériques** | 4.10 Signatures : signer, vérifier, et pourquoi ça ne suffit pas | **Python** : signature RSA simple | difficile |
| 15 | **DSA et gap groups** | 9.5 DSA et groupes à gap | **Python** : vérifier une signature DSA | expert |
| 16 | **Pairings bilinéaires** | 9.6 Couplages bilinéaires : la porte des cryptosystèmes avancés | **Python** pairing sur courbe elliptique | expert |
| 17 | **Zero-knowledge** | 9.7 Preuve de connaissance nulle : prouver sans révéler | **Python** : protocole de Schnorr ZK | expert |
| 18 | Quiz / révisions | 5.1 Quiz de mi-parcours (noté 20 %) | — | — |
| 19 | **Sécurité du vote** | 9.8 Élections et secret du vote | projet | expert |
| 20 | Projets finaux | 9.9 Projet final de crypto | projet noté (25 %) | expert |

**Verdict** : avec ces **20 rooms**, la **couverture 6.857 passe de ≈ 4/18 à
18/18** (crypto avancée : OTP, secret sharing, modes, MAC, IND-CCA2,
signatures, DSA, bilinéaires, zero-knowledge, vote, Bitcoin).

**Charge** : 20 rooms × 3,5 h + 10 labs Python × 4 h ≈ **110 h**.

### 11.1 Le lab crypto : `labs/crypto-01`

**Image** : `python:3.12-slim`, utilisateur non-root, sans réseau sortant
(sauf le réseau de la room), fichiers de travail éphémères.

**Contenu** :
- `challenges/` : un dossier par challenge, avec l'énoncé, le squelette de
  code (`skeleton.py`) et le script de correction (`check.py`) ;
- `framework.py` : lecture du challenge, exécution dans un délai imparti,
  capture de sortie, code de retour ;
- `check.py` : un script par challenge, qui **sort 0** si la solution est
  correcte, et **explique** sinon (« tu n'as pas appliqué le padding »).

**Formats des checks** (repris par `Secura_Lab` + le manifeste étendu) :
- `expect_exit: 0` ;
- `expect_output: "regex"` ;
- `points: 5` ;
- `feedback: "message pédagogique"` (affiché tel quel à l'apprenant).

**Contrainte de sécurité** : le code de l'apprenant s'exécute **dans le
conteneur du lab**, avec `--cap-drop=ALL`, `--network` restreint, timeout 10 s,
mémoire 256 Mo, `pids-limit` bas. Un `python` qui appelle `os.system` ne peut
rien casser de plus que le conteneur, qui est détruit à la fin.

### 11.2 Les 5 problem sets (homework, 20 %)

Cinq séries, chacune notée automatiquement, formatées comme les PS du MIT :

| PS | Contenu | Vérification |
|---|---|---|
| PS1 | Exponentiation modulaire, tests de primalité | scripts Python |
| PS2 | OTP, Vigenère, fréquences | scripts Python |
| PS3 | AES/DES, modes, MAC | scripts Python |
| PS4 | Diffie-Hellman, ElGamal, DSA | scripts Python |
| PS5 | Zero-knowledge, secret sharing | scripts Python |

**Charge** : 5 PS × 3 h (énoncés + correcteurs) ≈ **15 h**.

---

## 12. Charge éditoriale totale et planning du palier 3

| Élément | Quantité | Écriture originale | Adaptation OCW (≈ 50 %) |
|---|---|---|---|
| Rooms 6.858 | 14 | 3 h → 42 h | 3 h → 21 h |
| Rooms 6.857 | 20 | 3,5 h → 70 h | 3,5 h → 35 h |
| Labs crypto (`crypto-01`) | 10 | 4 h → 40 h | 3 h → 30 h |
| Labs sys supplémentaires (`bin-01`, `web-01`, `net-01` étendus) | 4 | 3 h → 12 h | 2 h → 8 h |
| 5 problem sets | 5 | 3 h → 15 h | 2 h → 10 h |
| 2 quiz | 2 | 4 h → 8 h | 3 h → 6 h |
| 3 projets notés + grilles | 3 | 8 h → 24 h | 6 h → 18 h |
| Relevé de notes + export PDF | 1 | 6 h → 6 h | — |
| **Total** | | **≈ 217 h** | **≈ 128 h** |

**Planning réaliste (3 personnes, 6 mois)** :

| Mois | Livrable |
|---|---|
| 1 | Chaîne technique du lab noté (manifeste `checks`, runner, relevé) + `crypto-01` v0 |
| 2 | 4 rooms crypto (OTP, hachage, modes, MAC) + 2 PS |
| 3 | 4 rooms crypto (DH, signatures, secret sharing, Bitcoin) + 2 PS |
| 4 | 5 rooms sys (capabilities, sandbox, side-channels, symbolic execution, mobile) |
| 5 | 5 rooms sys (private browsing, anonymous comm., tracking, economics, Ur/Web) + crypto avancé (bilinéaires, ZK, CCA2, vote) |
| 6 | Projets notés, quiz, relecture, certification « palier 3 », documentation |

**Décision de gouvernance :** le palier 3 **ne bloque pas** les paliers 1 et 2.
Il est produit **en parallèle**, sur la même base de code, et il ne devient
« visible » que lorsque le premier lot de rooms est complet. L'apprenant de 14
ans n'est **jamais** confronté à un cours de cryptographie avancée.

---

## 13. Ce que le palier 3 change (et ne change pas) dans le produit

**Ça change :**
- le moteur de lab accepte des **checks notés** (points partiels) ;
- la progression sait porter une **note** et pas seulement des XP ;
- une nouvelle page « relevé » exportable ;
- les rooms peuvent déclarer une **bibliographie** (bloc `sources`) affichée en
  fin de room (obligatoire pour toute adaptation OCW).

**Ça ne change pas :**
- la plateforme reste **gratuite**, multilingue (FR/AR/EN), sur WordPress ;
- les niveaux, médailles, XP et le certificat du palier 1/2 restent inchangés ;
- le code reste **MIT**, le contenu adapté reste **CC BY-NC-SA 4.0** ;
- aucune exigence de diplôme, aucun paiement, aucune mise en concurrence avec
  un fournisseur payant : on rend gratuit ce qui, ailleurs, est payant.
