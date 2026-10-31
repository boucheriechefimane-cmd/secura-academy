# CONSTITUTION — Secura Academy

> **Ce document est la constitution du projet.** Il ne décrit pas ce qu'on
> *voudrait* faire : il dit **ce que nous sommes obligés de faire**, dans quel
> ordre, et selon quelles règles on tranche.
>
> Il prime sur les préférences du moment, sur la mode du jour,
> et sur l'envie de coder vite. Toute modification de la constitution est un
> **acte explicite**, daté, tracé dans le journal (§ 9).

**Document de référence unique.** Relu **au début de chaque session de travail**
(rituel « revue de constitution ») et **à chaque commit**. Toute idée nouvelle
est classée ici avant d'être codée ; tout code livré est rattaché à un jalon.

> **Rituel de revue (5 minutes, en tête de session) :**
> 1. Lire le tableau des jalons et leurs statuts.
> 2. Vérifier que le jalon « en cours » est bien celui qui doit avancer
>    (ordre du chemin critique, § 5).
> 3. Relire les **décisions structurantes** (§ 7) : elles ne se remettent pas en
>    cause sans nouvelle décision explicite de l'utilisateur.
> 4. Cocher ce qui a été fait, déplacer le « en cours », dater la revue.
> 5. Si une idée n'est pas dans la constitution : l'ajouter, ou l'écrire dans
>    « Idées à classer » (§ 8).
> 6. Passer chaque nouveau contenu par le **registre des sources**
>    (`docs/SOURCES-CONTENU.md`) avant toute réutilisation.

**Dernière revue :** 31 octobre 2026 — **v0.5.3** : **machines réellement
lancées** (runtime rootless dans le bac à sable) et **recette serveur clé en
main**. Revue précédente : **v0.5.2** : **validation en conditions
réelles** (WordPress 7.1.4 + MariaDB + plugin + thème installés dans un bac à
sable). Le protocole prévu par l'utilisateur a été joué de bout en bout :
dossier des labs hors WordPress + réglage dans l'interface, « Déployer la
machine », commandes réelles dans la machine, drapeaux lus, boucle
pédagogique complète (cours → questions → XP → médaille), nettoyage horaire,
et **test décisif à deux apprenants** : conteneurs, réseaux et projets
Compose différents, aucun croisement. Cette validation a révélé **trois
défauts réels**, corrigés dans cette version : (1) le filtre « locale »
bouclait à l'infini et **figeait le site** ; (2) le dossier des labs choisi
dans les réglages pouvait être ignoré par le cache d'options de WordPress 7.x ;
(3) le réseau dédié n'était pas créé avant la machine, ce qui aurait fait
échouer `docker run --network` sur un vrai Docker. Le démon Docker reste
absent du bac à sable (conteneur sans privilèges noyau) : la logique du
plugin a été validée avec une console Docker reproduite à l'identique, et
l'isolement noyau reste à confirmer sur le serveur.

Revue précédente : 31 octobre 2026 — **v0.5.1** livré : **M1 phase 2
terminée** (les 6 rooms de démonstration sont branchées à une vraie machine,
et l'isolation est stricte : réseau et pile Docker Compose renommés par
apprenant et par room, réseau sans sortie Internet, page de réglages). Il
reste à **vérifier sur un hôte Docker réel** (construction des images, deux
apprenants en parallèle). v0.5.0 avait livré les types de question
(réponse libre / choix multiple / **sans réponse**) et corrigé un bug bloquant
qui rendait le champ de saisie invisible dans le navigateur. Les 10 écarts
face à TryHackMe ont une réponse écrite (`docs/ECARTS-TRYHACKME.md`), le
registre des sources est ouvert (`docs/SOURCES-CONTENU.md`), et le palier 3
universitaire est planifié (`docs/CONTENU-MIT.md` § 9-13).

**Documents liés (tous dans `docs/`) :**
`AUDIT-EXPERIENCE-APPRENANT.md` (le constat) · `ECARTS-TRYHACKME.md` (les
réponses aux 10 écarts) · `SOURCES-CONTENU.md` (les licences) ·
`CONTENU-MIT.md` (le contenu, palier 3 compris) · `labs.md` (l'exploitation des
labs) · `MODELE-XP-MEDAILES.md` (la progression) · `backlog.md` (le détail
technique) · `deploiement.md` (la mise en production).

---

## 1. Article 1 — Notre mission

> **Rendre l'apprentissage de la cybersécurité accessible, gratuit, pratique et
> multilingue à un adolescent, et sérieux à un étudiant.**

Pas « une plateforme de QCM bien designée ». Une **plateforme où l'on
manipule**, où l'on **comprend ses erreurs**, et où l'on **progresse
visiblement**. Un ado de 14 ans doit pouvoir, seul et gratuitement :
comprendre ce qu'est une requête HTTP piégée, la constater sur une vraie
machine, expliquer pourquoi son script d'exploitation a marché, et repartir
avec un certificat. Un étudiant doit pouvoir, lui, suivre un syllabus de
niveau licence avec le même barème que MIT.

---

## 2. Article 2 — Les dix principes (non négociables)

| # | Principe | Ce que cela interdit concrètement |
|---|---|---|
| **P1** | **L'apprenant d'abord.** Le public cible est 12-17 ans au palier 1-2, 17-22 au palier 3. | Interdire le contenu purement théorique, les paragraphes de manuel, le jargon non expliqué. |
| **P2** | **Gratuit, vraiment gratuit.** Aucun contenu, aucun niveau, aucune note payante. | Interdire tout paywall, même « provisoire ». |
| **P3** | **Multilingue par défaut** (FR, AR, EN ; arabe en RTL). La traduction n'est pas un bonus. | Interdire de livrer une fonctionnalité monolingue. |
| **P4** | **Faire avant de lire.** L'apprenant manipule avant de comprendre. | Interdit la consigne de 6 min d'affilée avant le premier clic. |
| **P5** | **Comprendre, pas deviner.** Chaque erreur est expliquée, jamais seulement sanctionnée. | Interdire le « faux » nu ; il faut dire *pourquoi*. |
| **P6** | **Le contenu est un bien commun.** Licences ouvertes vérifiées, attribution visible. | Interdire la copie non vérifiée ; par défaut, **lien seul**. |
| **P7** | **Le vrai lab, sinon le dit.** Si la machine est simulée, on le dit. | Interdire de faire croire qu'un script simulé est une vraie compromission. |
| **P8** | **Les mineurs d'abord.** Aucun nom réel, aucune donnée de paiement, aucune publicité tierce. | Interdire le classement non opt-in, le streak culpabilisant par défaut, toute collecte inutile. |
| **P9** | **Rien de cassé.** Un flux qui ne marche pas est un bug prioritaire, pas un détail. | Interdire de livrer une feature dont le test n'existe pas. |
| **P10** | **La route est publique.** Les décisions, les licences et les échecs sont écrits. | Interdire les décisions prises « en passant ». |

---

## 3. Article 3 — Les règles de décision (comment on tranche)

Quand deux options sont possibles, on tranche dans cet ordre. Une décision
qui ne peut pas être justifiée par une de ces règles est **hors constitution**.

| # | Règle | Test à passer |
|---|---|---|
| **R1** | Toute idée est **classée** avant d'être codée. | La ligne existe dans cette constitution ou dans « Idées à classer ». |
| **R2** | Tout livrable a un **critère d'acceptation vérifiable**. | On peut le tester (assertion, capture, mesure). |
| **R3** | Les **décisions structurantes** (§ 7) ne se rouvrent pas implicitement. | Une nouvelle décision explicite de l'utilisateur est requise. |
| **R4** | On répond à **cinq questions** avant de commencer. | Pourquoi ? Pour qui ? Comment sa-t-on que c'est fini ? Quel risque ? Quel coût ? |
| **R5** | Le contenu passe le **test du 14 ans**. | Un ado de 14 ans comprend-il l'énoncé en 20 s sans aide ? |
| **R6** | Le contenu passe le **test du registre**. | La source est dans `docs/SOURCES-CONTENU.md` avec licence vérifiée + attribution prévue. |
| **R7** | Le code passe le **test de l'isolation**. | Aucune commande non filtrée, aucun privilège, aucun secret en clair, aucune réponse envoyée au client. |
| **R8** | Le **chemin critique ne se contourne pas** : on ne saute pas un jalon pour en rattraper un autre (§ 5). | Le jalon précédent est « fait » ou explicitement neutralisé par une décision. |
| **R9** | **Rien n'est « fait »** sans test automatique ou critère vérifiable et tracé. | Le journal des revues mentionne la preuve. |
| **R10** | Le journal (§ 9) est **append-only** : on n'efface pas une revue. | L'historique reste lisible et daté. |

---

## 4. Article 4 — Les dix écarts face à TryHackMe, et leur traitement

TryHackMe est la **référence d'usage**, pas le modèle à copier. Chaque écart est
traité par une opération unique : **RATTRAPER** (reprendre la mécanique),
**ORIGINAL** (inventer mieux), **PAR CITATION** (renvoyer, avec attribution),
**SUBSTITUER** (remplacer par l'équivalent chez nous), **REFUSER** (ne pas le
faire, et l'assumer).

Le détail complet — ce que fait THM, ce que nous faisons, comment on le mesure,
coût, risque — est dans **`docs/ECARTS-TRYHACKME.md`**.

| # | Écart | Opération | Jalon | Statut |
|---|---|---|---|---|
| 1 | Vraie machine branchée aux rooms | RATTRAPER | M1 | moteur fait, branchement + isolation à faire |
| 2 | Question « sans réponse » | RATTRAPER | **M2 bis** | ✅ **livré v0.5.0** |
| 3 | Volume (6 → 853 rooms) | ORIGINAL | M3 → 12 mois | 10 rooms en M3, 60 visées |
| 4 | AttackBox (bureau Linux) | SUBSTITUER | M3 | shell réel, pas de bureau |
| 5 | Communauté / writeups | SUBSTITUER | M2 bis / M6 | indices + explication d'erreur (existant) |
| 6 | Graphe de prérequis + récap | ORIGINAL | M3 | à faire |
| 7 | Vidéos courtes | PAR CITATION | M3 / M6 | cyber.org (lien) + capsules SVG maison |
| 8 | Onglets multi-machines | RATTRAPER | M3 | après l'isolation de M1 |
| 9 | Onboarding (e-mail, mot de passe oublié) | SUBSTITUER | M4 | à faire |
| 10 | Classement / first blood | RATTRAPER | M6 | opt-in obligatoire |

**Interdits permanents** : copier un texte, une illustration, un composant ou
l'échelle de niveaux de TryHackMe ; publier des writeups de challenges
pwn.college (interdit par la source) ; faire payer quoi que ce soit.

---

## 5. Article 5 — Le chemin critique et l'ordre des jalons

```
M1 (lab réel + isolation) ──┬──► M2 (UX : deux volets, clavier, « faire d'abord »)
                            └──► M3 (contenu : 10 rooms, prérequis, récap, examen pratique)
M4 (comptes)  ─────────────────────────────────► M5 (qualité : e2e, a11y, staging)
M3 ─────────────────────────────────────────────► M6 (visuel + social + PDF)
M2 bis ───────────────────────────────► M3 (les rooms profitent du « sans réponse »)
M1 ──► M7 (palier 3 : labs notés sur machines réelles)
M1 ──► M8 (palier 3 : crypto avancée, lab crypto-01)
```

**Règles d'ordre (R8) :**
- **M1 avant M3** : on n'écrit pas 10 rooms de lab tant que la machine n'est pas
  branchée et isolée.
- **M1 étape 2 avant l'écart n° 8** (onglets multi-machines) : deux apprenants
  ne doivent jamais voir la même pile.
- **M2 bis avant M3** : le type « sans réponse » doit exister avant d'écrire
  10 rooms, sinon on les réécrit.
- **M4 et M5 sont parallélisables** et ne dépendent de rien.
- **M7 et M8 ne bloquent jamais M1-M6** : le palier 3 est produit en parallèle
  et n'est visible qu'une fois complet.

---

## 6. Article 6 — Les jalons

### M1 — Lab réel : une vraie machine déployable — 🔵 EN COURS

**Objectif :** un apprenant clique « Déployer la machine » et obtient un shell
réel sur une cible vulnérable isolée.

| Livrable | Critère d'acceptation | Statut |
|---|---|---|
| Moteur de lab à deux pilotes : `simulated` et `docker` | le mode simulé reste 100 % fonctionnel | ✅ fait |
| Manifeste de lab par room (mémo `_secura_lab`) | image, service, shell, TTL, cible, politique de commandes | ✅ fait |
| `Secura_Lab::start()` / `run()` / `stop()` | conteneur éphémère par apprenant et par room, TTL, arrêt auto | ✅ fait |
| Isolement dur (`--cap-drop=ALL`, `--network` dédié, `no-new-privileges`, limites CPU/mémoire/PIDs, pas de root) | revue de sécurité : aucune option privilégiée | ✅ fait |
| Filtre de commandes + sortie tronquée + timeout | commande hors politique refusée, sortie ≤ 8 Ko, exec ≤ 10 s | ✅ fait |
| Repli automatique si Docker absent | `driver=auto` → simulation ; le site reste utilisable en mutualisé | ✅ fait |
| Bouton « Déployer la machine » + statut dans la room | état visible : en cours / prête / expirée / indisponible | ✅ fait |
| 3 labs réels : web vulnérable, binaire écrasable, réseau 4 nœuds | images + `docker-compose` fournis (`labs/`) | ✅ fait |
| Documentation d'exploitation | `docs/labs.md` | ✅ fait |
| **Branchement room ↔ machine** (3 rooms) | les rooms « Réseaux », « Web » et « Mémoire » portent un manifeste de lab | ✅ **fait (v0.5.1)** |
| **Projet Compose unique par apprenant** | projet `seca_net01_<apprenant>_<room>` : deux élèves ne partagent jamais la même pile | ✅ **fait (v0.5.1)** |
| **Réseau sans sortie** | réseau `seca_lab_<apprenant>_<room>` créé `--internal`, `internal: true` en Compose | ✅ **fait (v0.5.1)** |
| **Nettoyage des piles Compose** | étiquettes sur chaque service : le nettoyage horaire retrouve et démonte la pile | ✅ **fait (v0.5.1)** |
| **Page de réglages** | dossier des labs + first blood, sans toucher au code | ✅ **fait (v0.5.1)** |
| **Vérification en WordPress réel** | WordPress 7.1.4 + plugin + thème : page de réglages, déploiement, commandes, drapeaux, XP, nettoyage horaire | ✅ **fait (v0.5.2)** |
| **Test « deux apprenants en parallèle »** | conteneurs, réseaux et projets Compose distincts, aucun croisement | ✅ **fait (v0.5.2)** |
| **Machines réellement lancées** | construction des images, réseau sans Internet, drapeaux lus, pile Compose de 4 services montée et arrêtée (runtime rootless) | ✅ **fait (v0.5.3)** |
| **Recette serveur** | script de vérification (22 contrôles) + checklist de 10 lignes + doc « où coller quoi » | ✅ **fait (v0.5.3)** |
| **Vérification sur un hôte Docker réel** | build des images + isolement noyau (réseau sans sortie, quotas) | ⏳ **à faire sur le serveur** (le bac à sable n'a pas de démon Docker) |

**Décision structurante :** le contrat AJAX `secura_terminal` **ne change pas**.
On branche un pilote, on ne réécrit pas le front.

---

### M2 — UX : deux volets, clavier, « faire d'abord » — 🟡 PARTIEL

| Livrable | Critère d'acceptation | Statut |
|---|---|---|
| Lecteur en deux volets (consigne \| terminal) sur ≥ 1024 px | terminal toujours visible sur desktop | ✅ fait |
| Historique du terminal navigable au clavier (↑ / ↓, Tab, Ctrl+C) | ↑ rappelle la dernière commande | ✅ fait |
| **Champ de réponse présent dans la page** | le champ de saisie est dans le DOM | ✅ **corrigé v0.5.0** (il n'y était pas : le flux était cassé) |
| Défilement automatique + copie d'une commande | double-clic → presse-papier | ⬜ |
| « Faire d'abord » : la consigne devient un brief de 60 s | la leçon ne bloque plus la manipulation | ⬜ |
| Chaînes d'attaque : 2 cibles liées dans une même room | la room 2 nœuds a une cible secondaire | ⬜ (cf. écart n° 8) |

---

### M2 bis — Types de question : libre, choix multiple, sans réponse — ✅ LIVRÉ (v0.5.0)

> Issu de l'[audit apprenant](AUDIT-EXPERIENCE-APPRENANT.md) : c'est la
> mécanique de THM la plus manquante chez nous, et la moins chère à ajouter.

| Livrable | Critère d'acceptation | Statut |
|---|---|---|
| Question « sans réponse » (mode `action`) | une tâche de manipulation se valide par l'action, pas par une phrase à orthographier | ✅ fait |
| Validation serveur de l'action | impossible de valider sans avoir joué (l'étape du terminal doit être atteinte) | ✅ fait |
| Vrai QCM à choix (mode `choice`) | une seule bonne proposition, les autres ne sont jamais acceptées | ✅ fait |
| La bonne réponse n'est jamais envoyée au client | payload AJAX sans `answers` ni `correct` (assertion) | ✅ fait |
| Traduction des choix (AR/EN) | les choix sont traduisibles dans la méta-box de traduction | ✅ fait |
| Contenu de démonstration utilisant les 3 modes | room « Réseaux » : QCM à choix + action de fin de pratique | ✅ fait |
| **Corrigé détaillé débloqué après réussite** (le « walkthrough ») | l'apprenant bloqué a une porte de sortie, comme les walkthroughs THM | ⬜ à faire (0,5 j) |

---

### M3 — Contenu : 10 rooms réelles, graphe, récap, examen pratique — ⬜ À VENIR

| Livrable | Critère d'acceptation | Statut |
|---|---|---|
| 10 rooms (dont 3 labs M1) | chacune suit `leçon → entraînement → test pratique → examen` | ⬜ |
| Prérequis explicites entre rooms | l'UI affiche « requis : room X » et bloque si non validé | ⬜ |
| « Topic Recap » en fin de section | 5 questions de synthèse, hors XP, badge de section | ⬜ |
| Graphe de prérequis (SVG déduit des données) | jamais dessiné à la main → ne peut pas mentir | ⬜ |
| Examen pratique : l'examen valide par **manipulation** | une tâche `exam` peut exiger un flag à trouver (mode lab) | ⬜ |
| Shell réel dans la room (niveau 2 de l'AttackBox) | l'apprenant tape de vraies commandes sur la machine | ⬜ |
| Onglets multi-machines (écart n° 8) | une room à 2 machines s'exploite par onglets | ⬜ |
| Réutilisation OCW : adaptation + attribution + ShareAlike | chaque room adaptée cite sa source et sa licence | ⬜ |
| Chaîne de production : gabarit + import/export CSV des traductions | une room FR + AR + EN se produit sans toucher au code | ⬜ |
| Encart vidéo / capsule SVG (écart n° 7) | chaque notion difficile a une illustration < 2 min | ⬜ |

---

### M4 — Comptes : onboarding non cassé — ⬜ À VENIR

**Principe directeur :** WordPress gère les comptes, **nous n'inventons pas un
système d'authentification**. Ce qui est à construire, c'est le *parcours*
d'inscription et l'accueil.

| Livrable | Critère d'acceptation | Statut |
|---|---|---|
| Inscription ouverte (WordPress natif) + e-mail de confirmation | aucun code d'authentification maison | ⬜ |
| Mot de passe oublié | jeton à usage unique, expiration courte (natif WP) | ⬜ |
| Onboarding en 3 écrans (langue + pseudonyme, défi de 3 min, 1re room) | 5 min maximum, la barre disparaît ensuite | ⬜ |
| Anti-spam + RGPD : export JSON + suppression complète | aucun compte ne survit à une demande | ⬜ |
| Parcours mineur : pas de paiement, pas de publicité tierce | aucune donnée transmise à un tiers | ⬜ |

---

### M5 — Qualité : e2e, accessibilité, staging — ⬜ À VENIR

| Livrable | Critère d'acceptation | Statut |
|---|---|---|
| Tests Playwright : inscription → room → validation → certificat | scénario au vert en CI | ⬜ |
| Audit clavier + lecteur d'écran + contraste | nav clavier complète, focus visible, `aria-live` | ⬜ |
| Environnement de staging reproductible | `docker compose` : WP + plugin + thème + labs | ⬜ |
| Revue de sécurité avant ouverture | checklist OWASP, dépendances à jour | ⬜ |
| Revue de sécurité des labs (conteneur) | aucune commande d'évasion dans la liste blanche | 🟡 amorcé (tests) |

---

### M6 — Social & visuel : le facteur « jeu » — ⬜ À VENIR

| Livrable | Critère d'acceptation | Statut |
|---|---|---|
| Direction artistique : illustrations, icônes de tâche, anneau de niveau | 6 visuels d'ambiance, 4 icônes | ⬜ |
| Mur de succès / tableau de badges | page dédiée, triée par date et catégorie | ⬜ |
| First blood activé (rooms lab) | « première capture : il y a 12 jours » | ⬜ |
| Classement de room **opt-in** | pseudonyme obligatoire, aucune donnée nominative | ⬜ |
| Séries (streak) et objectifs hebdomadaires | rappel discret, pas culpabilisant | ⬜ |
| Certificat PDF (et pas seulement imprimable) | PDF signé, vérifiable en ligne | ⬜ |
| Série de capsules vidéo (20 × 90 s, FR/AR/EN) | sous-titrée, à nous | ⬜ |

---

### M7 — Palier 3 « Systèmes » : format MIT 6.858 — ⬜ À VENIR

> Le seul niveau où l'on peut légitimement dire « cette formation suit le cours
> MIT » : on y fait les **labs**, les **quiz** et le **projet**, avec la même
> répartition de la note. Plan complet : `docs/CONTENU-MIT.md` § 9-10.

| Livrable | Critère d'acceptation | Statut |
|---|---|---|
| Couverture **24/24 leçons 6.858** | chaque notion a une room (les 10 manques comblés : capabilities, symbolic execution, side-channels, private browsing, anonymous comm., mobile, tracking, economics, Ur/Web, …) | ⬜ |
| Barème MIT affiché tel quel (quiz 20 / labs 35 / projet 25 / homework 20) | l'apprenant voit la répartition avant de commencer | ⬜ |
| **Labs notés par scripts** (checks à points partiels) | note automatique + retour pédagogique (« le padding n'a pas été appliqué ») | ⬜ |
| Devoirs de lecture (5 PS) avec note automatique | 20 % du palier | ⬜ |
| Projet final en groupe (3-4) avec grille publiée | 25 % du palier | ⬜ |
| Relevé de notes + export PDF | tableau par composante MIT, mention, PDF | ⬜ |
| Contenu adapté de l'OCW avec attribution + ShareAlike | chaque support cité, licence affichée | ⬜ |

---

### M8 — Palier 3 « Crypto » : format MIT 6.857 — ⬜ À VENIR

> 6.857 est un cours de **cryptographie avancée** : c'est le cœur mathématique
> qui nous manque. Plan complet : `docs/CONTENU-MIT.md` § 11.

| Livrable | Critère d'acceptation | Statut |
|---|---|---|
| Couverture **18/18 séances 6.857** | OTP/parfait secret, hachage, modes, MAC, DH, Pedersen, IND-CCA2, signatures, DSA/gap groups, bilinéaires, zero-knowledge, vote, Bitcoin | ⬜ |
| Lab `labs/crypto-01` (Python, sans réseau, non-root) | challenges avec squelette + correcteur | ⬜ |
| 5 problem sets notés automatiquement | 20 % du palier | ⬜ |
| Challenge ZK et challenge vote (projets) | notés en projet | ⬜ |

---

## 7. Article 7 — Les décisions structurantes

Elles ne se remettent pas en cause implicitement (R3).

| # | Décision | Pourquoi |
|---|---|---|
| **D1** | Plateforme **gratuite**, multilingue (AR, FR, EN), sur WordPress | demande initiale |
| **D2** | Aucun copy de la marque TryHackMe : mécaniques reprises, textes et visuels originaux | cadre légal |
| **D3** | Le **QCM reste** comme test de validation, **en plus** des tests pratiques à réussir | demande du 31/10/2026 |
| **D4** | 12 niveaux aux noms originaux ; first blood et classement **opt-in** | expérience + protection des mineurs |
| **D5** | Le **code** reste sous licence **MIT** | attire les contributeurs |
| **D6** | Le **contenu adapté de l'OCW** reste sous **CC BY-NC-SA 4.0**, avec attribution explicite | clause ShareAlike ; le gratuit satisfait la clause NC |
| **D7** | **Pas de push en production** sans accord explicite | sécurité |
| **D8** | **Une seule source de vérité** : cette constitution | éviter la dérive |
| **D9** | Toute source de contenu passe par `docs/SOURCES-CONTENU.md` **avant** réutilisation ; **défaut = lien seul** | le gratuit n'est pas le libre |
| **D10** | Le **palier 3** est construit **en parallèle** et ne bloque jamais les paliers 1-2 ; il reste **gratuit** | cohérence avec P2 |
| **D11** | Le contenu **réseau** peut venir d'autres universités ou fondations (y compris « premium » si la licence le permet), **à condition qu'il aide le jeune à apprendre** | accord explicite du 31/10/2026 |
| **D12** | Un **test du 14 ans** filtre tout contenu et toute fonctionnalité | P1 + P5 |

> **Conséquence de D6 :** le contenu OCW adapté est gratuit mais **non
> commercialisable**. Toute évolution vers un modèle payant doit réécrire le
> contenu ou obtenir une autorisation écrite. Le code, lui, reste libre.
>
> **Conséquence de D9 :** aucune source n'est citée dans une room sans être
> au registre. C'est ce qui nous a évité d'écrire « CC BY-SA » pour OWASP sur
> la seule foi d'un README : la licence a été vérifiée via l'API GitHub.

---

## 8. Article 8 — Idées à classer

- Mode « hors ligne » / impression des labs.
- App native (React Native) — trop lourd au regard de l'effort actuel.
- Tuteur IA dans le terminal — dépend de M1 et d'un cadre éthique (données des mineurs).
- Réseau social / clans — hors périmètre tant que M6 n'est pas fait.
- Export du profil en badge Open Badge (LinkedIn).
- Mode « buddy » : deux apprenants sur la même room (avec contrainte de
  protection des mineurs).

---

## 9. Article 9 — Journal des revues

*(append-only — on n'efface pas une revue, on en ajoute une.)*

| Date | Version | Revue |
|---|---|---|
| 31/10/2026 | v0.2.0 | Revue « dev senior » : 10 lacunes listées. Décision : **les QCM restent**, ajout des tests pratiques obligatoires. |
| 31/10/2026 | v0.3.0 | **Validation croisée livrée** (format par tâche, seuil effectif, terminal dans chaque room, réservation atomique, reprise d'examen, rate limiting, schéma versionné). Licence OCW **corrigée** : la réutilisation gratuite est autorisée (NC satisfait), avec attribution + ShareAlike. **M1 démarrée.** |
| 31/10/2026 | audit | **Audit expérience apprenant + THM** (`docs/AUDIT-EXPERIENCE-APPRENANT.md`) : verdict senior, parcours 14 ans simulé, audit THM sur sources réelles (853 rooms, AttackBox, « no answer needed », onglets multi-machines), ce qu'on a de mieux (arabe RTL, gratuit, explication d'erreur systématique, seuil explicite) et ce qui manque. **Alignement MIT : non, et c'est normal** — 9/24 leçons 6.858, ~4/18 séances 6.857, public ≠ graduate. Ajout de **M2 bis** (question « sans réponse » + walkthrough) et **M7** (palier 3 universitaire). |
| 31/10/2026 | v0.4.0 | **M1 livrée côté moteur** : `Secura_Lab` (deux pilotes, isolement dur, TTL, politique de commandes, repli automatique), 3 endpoints lab, méta-box de lab, barre « Déployer la machine », 3 machines réelles fournies (`labs/`), documentation (`docs/labs.md`). **M2 amorcée** : lecteur en deux volets + historique clavier. 169 assertions. Reste : projet Compose unique par apprenant, branchement des rooms, réseau sans sortie. |
| 31/10/2026 | **v0.5.3 (suite)** | **Test des machines sur GitHub avec Docker** : le runner GitHub Actions dispose de Docker et des privilèges nécessaires — les machines y sont donc construites et lancées **pour de vrai à chaque push** (`.github/workflows/labs.yml` + `scripts/test-labs-ci.sh`, 17 contrôles : la machine reste allumée, le terminal répond, le drapeau est accessible, deux apprenants ne se voient pas, pas de sortie Internet, la pile réseau de 4 services monte/répond/s'arrête, aucun reste). Résultat : **17 réussis, 0 échec**. Le projet peut donc être validé avec Docker **sans serveur**, et l'hébergement de production est tranché dans `docs/HEBERGEMENT.md` (mutualisé = lab simulé ; VPS = lab réel ; les deux restent possibles, le plugin bascule seul). |
| 31/10/2026 | **v0.5.3** | **Machines réellement lancées + recette serveur** : le démon Docker reste impossible dans le bac à sable (aucun privilège noyau), mais un runtime **rootless (Podman)** y fonctionne : les trois machines ont été **construites et lancées pour de vrai**. Ce passage a révélé **six défauts qui auraient cassé les labs en production** : commande du manifeste passée en un seul argument (le conteneur s'arrêtait aussitôt), Apache sur le port 80 sans privilèges (refus de démarrer), drapeau et notes copiés en tant que dossiers (`cat` → « Is a directory »), drapeau lisible par root seulement (lab impossible à finir), environnement réduit pour le client Docker (`DOCKER_HOST` perdu), reconstruction des images à chaque déploiement. Corrections : commande découpée en arguments, port 8080, fichiers copiés fichier par fichier, drapeau `root:ctf` en 444, héritage de l'environnement, `build` puis `up --no-build` avec image partagée par les 4 services, suppression du conteneur homonyme avant création, arrêt par étiquette. Ajout de `scripts/recette-serveur.sh` (22 contrôles) et de `docs/RECETTE-SERVEUR.md` (où coller la checklist de 10 lignes : **le serveur qui a Docker**, pas GitHub, pas l'hébergement mutualisé). 226 assertions. |
| 31/10/2026 | **v0.5.2** | **Validation en WordPress réel** : bac à sable avec WordPress 7.1.4 + MariaDB, plugin et thème installés, labs déposés hors WordPress et pointés dans les réglages. Protocole joué de bout en bout : déploiement des machines, commandes réelles, drapeaux, XP, médailles, nettoyage horaire. **Test décisif à deux apprenants :** conteneurs `seca_lab_<apprenant>_<room>`, réseaux `seca_lab_<apprenant>_<room>` et projets Compose `seca_<prefixe>_<apprenant>_<room>` distincts — aucun croisement. Trois défauts réels trouvés et corrigés : récursion infinie du filtre « locale » (site figé), lecture peu fiable du dossier des labs (cache d'options WordPress 7.x), réseau dédié non créé avant la machine (`docker run --network` aurait échoué). 218 assertions. Reste : **démon Docker réel** à valider chez l'hébergeur (le bac à sable n'a aucun privilège noyau). |
| 31/10/2026 | **v0.5.1** | **M1 phase 2 livrée** : branchement des 6 rooms de démonstration sur les vraies machines (`web-01`, `bin-01`, `net-01`), **isolation stricte par apprenant** (réseau `seca_lab_<apprenant>_<room>` créé `--internal`, projet Compose `<prefixe>_<apprenant>_<room>`, plus aucun nom de conteneur fixe dans `docker-compose.yml`), nettoyage horaire des piles Compose par étiquettes, **page de réglages** (dossier des labs, first blood), commande `docker run` refactorée et vérifiée champ par champ. 208 assertions. Reste : **vérification sur un hôte Docker réel** (le bac à sable de développement n'a pas de démon Docker). |
| 31/10/2026 | **v0.5.0** | **M2 bis livrée** : trois types de question (`text` / `choice` / `action`), validation serveur de l'action par l'état réel du terminal, vrai QCM à choix, choix traduisibles, contenu de démonstration mis à jour. **Bug bloquant corrigé** : le champ de saisie de la réponse n'était jamais inséré dans le DOM — le flux de réponse était cassé dans le navigateur (les tests PHP ne le voyaient pas ; un test statique sur le JS le couvre désormais). 189 assertions. **Écarts THM documentés** (`docs/ECARTS-TRYHACKME.md`), **registre des sources** ouvert (`docs/SOURCES-CONTENU.md`), **palier 3 planifié** (`docs/CONTENU-MIT.md` § 9-13 : 14 rooms 6.858 + 20 rooms 6.857 + lab `crypto-01` + barème 20/35/25/20). **La roadmap devient la constitution** (articles, règles de décision, ordre des jalons). |
