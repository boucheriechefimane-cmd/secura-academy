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

### M3 — Contenu : 10 rooms réelles, graphe, récap, examen pratique — 🟡 EN COURS (v0.5.4 : les 10 scénarios sont livrés)

| Livrable | Critère d'acceptation | Statut |
|---|---|---|
| 10 rooms (dont 3 labs M1) | chacune suit `leçon → entraînement → test pratique → examen` | ✅ v0.5.4 — les 10 scénarios M3 sont livrés (`includes/content-m3.php`), branchés sur `multi-01`, `internal-01`, `bin-01` et la pile `net-01`, et rejoués par la CI Docker |
| Prérequis explicites entre rooms | l'UI affiche « requis : room X » et bloque si non validé | ⬜ |
| « Topic Recap » en fin de section | 5 questions de synthèse, hors XP, badge de section | ⬜ |
| Graphe de prérequis (SVG déduit des données) | jamais dessiné à la main → ne peut pas mentir | ⬜ |
| Examen pratique : l'examen valide par **manipulation** | une tâche `exam` peut exiger un flag à trouver (mode lab) | ✅ v0.5.4 — la **mission** (tâche `test`) valide par drapeau lu dans la machine ; l'**examen** reste un QCM, l'enchaînement des deux valide la manipulation **et** la notion |
| Shell réel dans la room (niveau 2 de l'AttackBox) | l'apprenant tape de vraies commandes sur la machine | ✅ v0.5.4 — le terminal exécute de vraies commandes dans le conteneur (`docker exec`), liste blanche comprise |
| Onglets multi-machines (écart n° 8) | une room à 2 machines s'exploite par onglets | 🟡 — les scénarios 7 et 8 jouent déjà sur **quatre machines** (attaquant, web, base, interne), mais dans un terminal unique : les onglets restent à faire |
| Réutilisation OCW : adaptation + attribution + ShareAlike | chaque room adaptée cite sa source et sa licence | ⬜ — les 10 scénarios M3 sont **entièrement originaux** (aucune réutilisation) ; le palier universitaire M7 reste le lieu de l'adaptation OCW, avec attribution + ShareAlike |
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

### BLOC U — Le bloc universitaire (M4 → M7 de la demande du 01/11/2026) — ✅ LIVRÉ (v0.6.0)

> **Pourquoi ce nom :** la demande du 01/11/2026 numérote « M4 → M7 » quatre
> chantiers qui ne recoupent **pas** les jalons M4 à M8 du présent article
> (comptes, qualité, social, palier 3). Pour ne pas confondre deux
> numérotations dans la même constitution, ce bloc est nommé **U** (universités)
> et ses quatre étapes sont **U1, U2, U3, U4**. Le contenu du bloc est celui
> validé par l'utilisateur le 01/11/2026 : *« valide tout le bloc d'un seul
> coup »*, *« choisit la façade vidéo »*, *« Docker réel sur GitHub maintenant,
> VPS en production plus tard si tout est OK »*.
>
> **Ce que le bloc change dans la doctrine :** jusqu'ici, une vidéo était
> presentationnelles (écart n° 7 : « capsule SVG de moins de 2 min, à nous »).
> Ici, la vidéo est **le cours de l'université, en complément de la room** :
> on n'écrit plus une version réduite de la leçon, on montre la leçon
> originale et on y ajoute notre pratique. C'est une décision de fond :
> **notre valeur ajoutée n'est plus le contenu, c'est la machine, la preuve et
> le chemin.**

| Étape | Livrable | Critère d'acceptation | Statut |
|---|---|---|---|
| **U1** | **Façade vidéo** (image + ▶, `youtube-nocookie`, iframe chargé **au clic**) | **aucune** requête vers YouTube avant le clic ; pas d'autoplay ; lien de secours vers la source ; fonctionne sans JavaScript (le lien seul suffit) | ✅ **v0.6.0** |
| **U1** | **Bloc d'attribution** (source, auteur, licence) affiché sous la vidéo | chaque vidéo porte institution + titre + licence + lien vers la source | ✅ **v0.6.0** |
| **U1** | Pack arabe des libellés de la façade | façade et attribution traduites AR/EN, RTL correct | ✅ **v0.6.0** |
| **U2** | **22 rooms** « Les universités » | MIT 6.858 (5) · MIT 6.857 (4) · pwn.college (4) · CYBER.ORG (4) · OWASP (3) · Stanford SEE (2) | ✅ **v0.6.0** |
| **U2** | **22 vidéos réelles** (une par room, identifiants YouTube vérifiés) | chaque identifiant **existe** (contrôle oEmbed automatisé dans `tools/videos/`) — **aucun identifiant inventé** | ✅ **v0.6.0** |
| **U2** | **155 questions** (entraînement + examen, 7 à 8 par room) | une seule bonne réponse, distracteurs = vraies erreurs d'apprenant, bonne réponse **répartie** sur les 4 positions | ✅ **v0.6.0** |
| **U2** | Parcours « Les universités » (6 modules, 22 rooms) | parcours à sections, badge propre, pas de mélange avec les parcours existants | ✅ **v0.6.0** |
| **U3** | Attribution + licence **par room** (et non par vidéo) | source, auteur, licence, lien ; le matériel adapté de l'OCW reste sous **CC BY-NC-SA** avec ShareAlike | ✅ **v0.6.0** |
| **U3** | Registre des sources complété | `docs/SOURCES-CONTENU.md` : les 6 sources university/fondation y sont inscrites **avec licence vérifiée** | ✅ **v0.6.0** (§ 12) |
| **U4** | Lab **OWASP Juice Shop** (image officielle `bkimminich/juice-shop`) | déployable en un clic, cible reachable, isolement `--internal` | ✅ **v0.6.0** (`labs/juice-shop`) |
| **U4** | Lab **dojo** (20 défis, 5 ceintures) | le dojo Secura est construit et testé en CI ; le dojo **officiel** pwn.college est fourni mais **non construit en CI** (image trop lourde) | ✅ **v0.6.0** (`labs/dojo-01`, `labs/dojo-pwncollege`) |
| **U4** | 6 **vidéos de brief** (avant de commencer) | une capsule d'introduction par grand bloc, chacune avec sa preuve | ✅ **v0.6.0** (6 rooms de brief) |
| **U4** | **Kahoot** (M3 bis) | quiz associé au parcours, exportable en CSV/JSON, sans compte obligatoire | ✅ **v0.6.0** (room Kahoot + export CSV/JSON) |

**Règles du bloc (R9) :**
- **U1 avant U2** : pas de vidéo en iframe direct. On ne charge rien avant
  le clic (pistage, lenteur sur connexion modeste, cadre vide si YouTube est
  bloqué). Le repli est un **lien** vers la source.
- **U2 avant U4** : on n'écrit pas un lab tant que la room qu'il sert n'existe pas.
- **Le bloc ne bloque pas M1-M3 ni M4-M8 du présent article** : il est produit
  en parallèle (R10 : « les paliers ne bloquent jamais »).
- **Toute vidéo est attribuée** (U3) : institution, auteur, licence, lien.

---

### BLOC Q — Le comité d'audit externe (5 auditeurs) — ✅ LIVRÉ (v0.6.0)

**L'idée.** On ne fait pas demander à celui qui écrit le code si son code est
bon. Cinq auditeurs spécialisés, avec une grille écrite d'avance, passent la
plateforme au crible **dans un vrai WordPress** (MySQL, PHP 8.3, plugin et
thème du dépôt), sur les pages **réellement rendues en HTTP**, et dans de
**vrais conteneurs Docker** quand il faut juger l'isolation entre élèves.

**Les cinq auditeurs et leur verdict au premier passage :**

| Auditeur | Contrôles | Bloquant | Majeur | Mineur | Verdict |
|---|---|---|---|---|---|
| SEO | 20 | 0 | 0 | 0 | Conforme |
| Contenu | 18 | 0 | 0 | 0 | Conforme |
| UX / UI | 16 | 0 | 0 | 0 | Conforme |
| Développement | 14 | 0 | 0 | 0 | Conforme |
| Sécurité & infrastructure | 25 | 0 | 0 | 0 | Conforme |
| **Total** | **93** | **0** | **0** | **0** | **Conforme** |

**Ce que l'audit a trouvé (et qui a été corrigé dans la même version) :**
pas de description de page (le moteur inventait le résumé) ; pas de carte de
partage ; pas de `hreflang` (les versions arabe et anglaise pouvaient être
prises pour des doublons) ; sélecteur de langue invisible sans JavaScript ;
pas d'en-têtes de sécurité HTTP ; et une sauvegarde de déploiement qui ne
contenait pas la base de données.

**La barrière.** Le workflow `audit.yml` **échoue** si un constat bloquant
apparaît. Il rejoue les cinq audits à chaque `push` sur `main`, chaque lundi
à 6 h, et à la main. Les rapports sont archivés comme artefacts (90 jours)
et repris dans le résumé du run.

**La règle du jeu** est écrite dans `docs/AUDITS-CADRE.md` (qui audite, quoi,
avec quelle méthode, l'échelle de gravité, ce que le comité ne fait pas) et
le suivi des constats dans `docs/AUDITS-REGISTRE.md`.

### BLOC R — Conformité aux réponses générées par l'IA (guide Google) — ✅ LIVRÉ (v0.6.0)

**L'idée.** Google a publié un guide sur l'optimisation d'un site pour les
réponses générées par l'IA (AI Overviews, AI Mode). On l'a lu comme une
grille d'audit, **point par point**, sur les pages réellement servies — et
on a corrigé ce qui ne l'était pas.

**Ce que le guide dit vraiment :** les réponses générées par l'IA
s'appuient sur le **même index** que la recherche classique. Il ne faut
donc pas « écrire pour l'IA » : il faut être **explorable**, **compréhensible**,
**sans doublon**, **rapide**. Les données structurées (schema.org) sont
**recommandées**, pas obligatoires. En revanche, trois idées sont des
**mythes** : le fichier `llms.txt`, le découpage « en morceaux » du texte, et
la réécriture du contenu pour l'IA — Google dit explicitement qu'ils
n'apportent rien.

**Les six écarts trouvés (et corrigés dans la même version) :**

| # | Écart trouvé | Gravité | Traitement |
|---|---|---|---|
| 9 | `hreflang` en adresses **relatives** : Google les ignore | Majeur | FR/AR/EN + `x-default` en adresses absolues |
| 10 | **Aucune adresse canonique** : la version arabe ressemblait à un doublon de la version française | Majeur | Canonique auto-référente par langue ; celle de WordPress (aveugle à la langue) retirée |
| 11 | **Aucune donnée structurée** | Mineur | `Organization`, `LearningResource`, `VideoObject`, `BreadcrumbList`, `Course` |
| 12 | La vidéo du cours n'était **déclarée nulle part** (la façade ne charge rien avant le clic) | Mineur | `VideoObject` : durée, miniature, adresse de lecture, éditeur, licence |
| 13 | Une room n'avait **aucun titre de section** (`h2`) | Mineur | 4 titres de niveau 2 par room |
| 14 | Les **étapes pratiques** étaient dessinées par le JavaScript : un robot sans JavaScript ne lisait pas le cœur du cours | Majeur | Liste des étapes servie dans le HTML, doublée en `<noscript>` |

**La barrière.** L'auditeur SEO est passé de **20 à 35 contrôles** : les 15
nouveaux portent sur les points du guide (indexabilité, contenu servi,
canonique présente/absolue/unique/auto-référente, `hreflang` absolus et
complets, données structurées valides, ressource déclarée, vidéo déclarée et
complète, absence de `llms.txt`, poids de la page, sections). Ils sont
rejoués dans le vrai WordPress de la CI, à chaque `push`.

**Le compte rendu en langage simple** est dans `docs/SEO-GENERATION-AI.md`
(le tableau point par point, les mythes, et ce qui reste à faire à la mise
en ligne : Search Console, indexation, rapport « Generative AI performance »).

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
| **D13** | Une vidéo est une **façade** : rien n'est chargé avant le clic, iframe `youtube-nocookie` ensuite, lien de secours toujours visible | accord explicite du 01/11/2026 (pistage, lenteur, cadre vide) |
| **D14** | Toute vidéo university/fondation est **attribuée** (institution, auteur, licence, lien) et **vérifiée** : aucun identifiant YouTube n'est écrit sans contrôle automatique | D9 appliqué aux médias |
| **D15** | Le bloc universitaire part **en un seul lot** ; Docker réel d'abord **sur GitHub**, VPS en production **plus tard**, seulement si tout est vert | accord explicite du 01/11/2026 |

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
| 01/11/2026 | **Conformité IA (v0.6.0)** | **Le guide de Google sur les réponses générées par l'IA a été audité point par point, sur les pages réellement servies : six écarts réels trouvés, six corrigés.** **Ce que le guide tranche :** l'IA de Google lit le même index que la recherche classique — il n'existe pas de version « pour l'IA » du site ; les données structurées sont recommandées (pas obligatoires) ; et trois idées sont des mythes à ne pas appliquer (`llms.txt`, découpage « en morceaux », réécriture du contenu). **Ce qui ne collait pas :** les adresses de langue étaient **relatives** (Google les ignore : les versions arabe et anglaise risquaient d'être abandonnées) ; il n'y avait **aucune adresse canonique** (donc la version arabe ressemblerait à un doublon de la version française) ; **aucune donnée structurée** ; la **vidéo du cours** n'était déclarée nulle part (la façade ne charge rien avant le clic) ; une room n'avait **aucun titre de section** ; et les **étapes pratiques** étaient dessinées par le JavaScript, donc invisibles pour un robot sans JavaScript. **Corrections :** hreflang en adresses absolues ; canonique auto-référente par langue (celle de WordPress, aveugle à la langue, a été retirée) ; `class-secura-schema.php` qui déclare `Organization`, `LearningResource`, `VideoObject`, `BreadcrumbList` et `Course` ; la vidéo déclarée avec sa durée, sa miniature, son éditeur et sa licence ; quatre titres de niveau 2 par room ; et la liste des étapes servie dans le HTML, doublée en `<noscript>`. **La barrière :** l'auditeur SEO passe de 20 à **35 contrôles** (15 nouveaux, exactement les points du guide), rejoués dans le vrai WordPress de la CI à chaque push ; le comité d'audit passe de **93 à 108 contrôles, 0 constat**. Compte rendu : `docs/SEO-GENERATION-AI.md`. |
| 01/11/2026 | **Comité d'audit externe (v0.6.0)** | **On ne fait pas demander à celui qui écrit le code si son code est bon : un comité de cinq auditeurs spécialisés passe la plateforme au crible, dans un vrai WordPress et avec un vrai moteur Docker, le tout sur GitHub.** **Les cinq auditeurs** : SEO (adressage, description, carte de partage, `hreflang`, plan du site), Contenu (squelette des 4 temps, questions avec explication et indice, traductions, attribution des vidéos, chemins de drapeaux, et la question qui compte : *la documentation dit-elle la vérité ?*), UX/UI (contrastes calculés selon WCAG AA, boutons nommés, RTL, cibles tactiles, sélecteur de langue), Développement (syntaxe, compatibilité PHP 7.4, échappement, injections SQL, nonces, tests) et Sécurité/infrastructure (secrets, isolation par élève, durcissement Docker, en-têtes HTTP, sauvegarde avec la base). **Premier passage : 93 contrôles, 8 constats réels, tous corrigés** — il manquait la description de page, la carte de partage, le `hreflang`, le sélecteur de langue lisible, les en-têtes de sécurité, et la sauvegarde de la base. **La barrière** : le workflow `audit.yml` échoue si un constat bloquant apparaît ; il rejoue les audits à chaque push et chaque lundi, et archive les rapports. Cadre : `docs/AUDITS-CADRE.md` ; registre : `docs/AUDITS-REGISTRE.md`. |
| 01/11/2026 | **v0.6.0 (bloc U livré)** | **Le bloc universitaire est complet, et il tient ses promesses : la vidéo du cours est dans la room, et la preuve est lue dans la machine.** **Ce qui a été livré.** Les **36 rooms** du bloc (22 « Les universités » + 14 « Les labs avancés »), **255 questions**, **quatre parcours**, et **trois nouvelles machines**. **La façade vidéo** : dans chaque room de cours, la vidéo apparaît comme une image avec un bouton ▶ ; rien n'est chargé de YouTube avant le clic (le test vérifie qu'il n'y a **aucune balise iframe** dans la page), l'iframe `youtube-nocookie` apparaît au clic, le **lien vers la source** reste visible, et l'attribution (source, auteur, licence, durée) est traduite en français, arabe et anglais. **Les labs avancés** : l'application **OWASP Juice Shop** (l'image officielle, version épinglée, réseau fermé sans sortie Internet) ; un **dojo de vingt défis** en cinq ceintures (blanche, jaune, orange, verte, noire) ; **six vidéos de brief** qui expliquent comment s'y mettre ; et le **quiz Kahoot**, jouable en classe avec le code `SECURA1` ou seul dans la plateforme, **exportable en CSV et JSON** sans compte obligatoire. **La preuve reste la preuve** : le serveur lit le drapeau dans la machine de l'élève, en root, et compare. Pour Juice Shop, l'application calcule elle-même un code par défi résolu (HMAC-SHA1 avec la clé du lab) : le serveur recalcule le même code et compare — la valeur est donc vérifiable, pas secrète. **Vérifications :** 302 assertions au vert, et — dans la vraie CI GitHub, avec un vrai Docker — **52 rooms et 4 parcours** installés dans un WordPress réel, **22 contrôles de recette** au vert (façade, Kahoot, idempotence, XP), **67 contrôles des machines** au vert (dont le dojo et ses 27 drapeaux, et le lab Juice Shop : l'application répond, le drapeau du serveur est conforme à celui de l'application, les trois services tournent, le réseau n'a pas de sortie Internet). **Trois bugs trouvés et corrigés par cette CI** (invisibles en local) : les briefs du dojo étaient copiés au mauvais endroit, le service « flags » du lab Juice Shop s'arrêtait aussitôt (commande Compose mal écrite), et le workflow ne construisait pas les nouvelles images. **Reste ouvert :** le dojo **officiel** pwn.college est fourni (`labs/dojo-pwncollege`) mais pas construit en CI (image trop lourde) ; et les labs M7 sont volontairement difficiles. |
| 01/11/2026 | **v0.6.0 (U1 → U3 livrés)** | **Le bloc universitaire commence à tourner pour de vrai.** **U1 — la façade vidéo** : dans chaque room, la vidéo du cours apparaît comme une **image avec un bouton ▶** ; rien n'est chargé de YouTube avant le clic (vérifié par le test : zéro balise `iframe` dans la page), l'iframe apparaît ensuite en `youtube-nocookie`, le **lien vers la source reste toujours visible**, et le bloc d'attribution (source, auteur, licence, durée) est traduit en français, arabe et anglais. **U2 — les 22 rooms** : MIT 6.858 (5), MIT 6.857 (4), pwn.college (4), CYBER.ORG (4), OWASP (3), Stanford (2). Chaque room suit le même patron (leçon → entraînement → mission → examen), **22 vidéos réelles** (aucun identifiant inventé : chacune est dans le catalogue vérifié), **155 questions** à quatre propositions avec la bonne réponse **répartie** sur les quatre positions (sinon l'élève apprend la place, pas la notion). Les 22 missions se valident par un **drapeau lu dans la machine** `univ-01` (22 livrables de cours, 22 drapeaux en `400 root:root` : l'élève ne lit jamais le drapeau, il le découvre dans les documents du cours). Nouveau parcours « Les universités » en 6 modules. **U3 — l'attribution** : chaque room porte sa source et sa licence, et le registre des sources gagne une section dédiée aux six universités/fondations. Vérifications : **276 assertions** au vert, et **38 rooms / 3 parcours** dans un WordPress réel (la recette de bout en bout passe avec la machine : 13/0). Reste : **U4** (Juice Shop, dojo à 20 défis, 6 vidéos de brief, Kahoot). |
| 01/11/2026 | **v0.6.0 (bloc U en cours)** | **Le bloc universitaire est ouvert, en un seul lot.** Quatre étapes nommées **U1 à U4** (pour ne pas confondre avec les jalons M4-M8 de l'article 6) : **U1** la façade vidéo (rien n'est chargé avant le clic, iframe `youtube-nocookie` au clic, lien de secours, attribution source/auteur/licence) ; **U2** les **22 rooms** « Les universités » (MIT 6.858 : 5, MIT 6.857 : 4, pwn.college : 4, CYBER.ORG : 4, OWASP : 3, Stanford : 2) avec leurs **vidéos réelles** — chaque identifiant YouTube a été **contrôlé automatiquement** (`tools/videos/yt_lookup.py`, contrôle oEmbed) : **aucun identifiant n'est inventé**, et les vidéos non intégrables (Stanford Online/CS105, accès réservé) ont été **remplacées** par des équivalents publics (Stanford CS106A) ; **U3** l'attribution et la licence par room, avec le registre des sources complété ; **U4** les labs avancés (OWASP Juice Shop, dojo pwn.college à 20 défis), les 6 vidéos de brief et le Kahoot (M3 bis). Le principe qui change : **notre valeur ajoutée n'est plus le contenu de la leçon, c'est la machine, la preuve et le chemin** — la vidéo est le cours original de l'université, la room est notre pratique. |
| 31/10/2026 | v0.2.0 | Revue « dev senior » : 10 lacunes listées. Décision : **les QCM restent**, ajout des tests pratiques obligatoires. |
| 31/10/2026 | v0.3.0 | **Validation croisée livrée** (format par tâche, seuil effectif, terminal dans chaque room, réservation atomique, reprise d'examen, rate limiting, schéma versionné). Licence OCW **corrigée** : la réutilisation gratuite est autorisée (NC satisfait), avec attribution + ShareAlike. **M1 démarrée.** |
| 31/10/2026 | audit | **Audit expérience apprenant + THM** (`docs/AUDIT-EXPERIENCE-APPRENANT.md`) : verdict senior, parcours 14 ans simulé, audit THM sur sources réelles (853 rooms, AttackBox, « no answer needed », onglets multi-machines), ce qu'on a de mieux (arabe RTL, gratuit, explication d'erreur systématique, seuil explicite) et ce qui manque. **Alignement MIT : non, et c'est normal** — 9/24 leçons 6.858, ~4/18 séances 6.857, public ≠ graduate. Ajout de **M2 bis** (question « sans réponse » + walkthrough) et **M7** (palier 3 universitaire). |
| 31/10/2026 | v0.4.0 | **M1 livrée côté moteur** : `Secura_Lab` (deux pilotes, isolement dur, TTL, politique de commandes, repli automatique), 3 endpoints lab, méta-box de lab, barre « Déployer la machine », 3 machines réelles fournies (`labs/`), documentation (`docs/labs.md`). **M2 amorcée** : lecteur en deux volets + historique clavier. 169 assertions. Reste : projet Compose unique par apprenant, branchement des rooms, réseau sans sortie. |
| 01/11/2026 | **v0.5.6** | **La recette WordPress habituelle se fait désormais dans GitHub, pas seulement dans mon bac à sable.** Le nouveau workflow `wordpress.yml` installe un vrai WordPress (MySQL en service, plugin et thème du dépôt, pack de langue arabe) et rejoue la recette de bout en bout : le site répond en français, en arabe et en anglais, les 16 rooms et les 2 parcours sont là, un QCM se valide, l'XP monte, une mauvaise réponse est refusée, la bonne réponse ne quitte jamais le serveur, et **aucune erreur PHP fatale** n'apparaît. Il rejoue aussi le scénario des deux apprenants et les 45 contrôles des machines. **Matrice de compatibilité** : la même recette est rejouée avec les plugins que le site pourrait héberger — Polylang, LiteSpeed Cache, Elementor, Contact Form 7, WooCommerce — et le résultat est dans `docs/COMPATIBILITE-PLUGINS.md`. Cette matrice a Immediately livré un vrai conflit : **Polylang utilise le paramètre d'URL `?lang=`, comme nous** ; avec lui activé, nos pages renvoyaient une erreur 404. Correction : chaque plugin garde son adresse (`?seca_lang=` pour nous), et notre choix de langue passe devant celui des autres plugins multilingues (filtre `locale` en priorité 99). Sur LiteSpeed, la vérité est dite sans détour : le plugin s'installe partout, mais son cache de pages ne fonctionne que si le serveur web est LiteSpeed (c'est le cas de l'hébergement Hostinger) ; la recette automatique vérifie qu'il n'y a pas de conflit, la dernière vérification du cache se fait sur l'hébergement réel. 250 assertions. |
| 01/11/2026 | **v0.5.5** | **Un déploiement réussi ne peut plus être déclaré en échec.** La CI a révélé un défaut invisible jusqu'ici : quand un processus vient de s'arrêter, PHP 7.4 peut encore l'annoncer « en cours d'exécution » (il n'est pas encore ramassé) ; le code de sortie lu valait alors -1, c'est-à-dire un échec. Concrètement, une machine de lab déployée avec succès était parfois annoncée « déploiement échoué » à l'élève — de façon aléatoire, environ 7 fois sur 1 000 commandes (mesuré : 2 commandes sur 300 en PHP 7.4, 0 après correction). La correction attend la fin réelle du processus avant de lire son code, et un test de non-régression a été ajouté (40 commandes rapides, aucune erreur). Le reste de la livraison : **l'espace de travail est allégé** (130 Mo → 12 Mo : le bac à sable WordPress de test n'est plus stocké, il se reconstruit en une commande avec `scripts/wordpress-local.sh`, et les outils de fabrication du contenu sont versionnés dans `tools/`), le **nœud interne** de la pile réseau lance enfin son application (le pivot fonctionnait dans le vide), et la CI Docker rejoue les dix scénarios (45 contrôles). 246 assertions. |
| 01/11/2026 | **v0.5.4** | **Les dix scénarios M3, livrés et testés pour de vrai.** Trois choses demandées le 31/10 et traitées ensemble. **(1) Dix missions jouables** (`includes/content-m3.php`) : chacune part d'une situation réelle (un service en panne, un mot de passe oublié, une page qui se trahit, une injection SQL, une sauvegarde oubliée, une rafale de journaux, des ports ouverts, un pivot, un binaire setuid, un certificat auto-signé) et se termine par une **preuve** : le serveur lit le drapeau **dans la machine de l'apprenant**, en root (`docker exec -u 0`), et compare — le fichier est en `400 root:root`, donc l'élève ne peut pas le lire, il doit le trouver. Ce n'est plus un QCM qui valide une action : c'est une **preuve de travail**. **(2) Vrais QCM** : les 68 questions d'entraînement et d'examen passent en mode `choice` à quatre propositions et **une seule** bonne réponse, les distracteurs étant de vraies erreurs d'apprenant (le « je redémarre, ça ira » incluse) — l'audit honnête avait montré qu'avant, plusieurs formulations de la même idée étaient acceptées, donc le test ne prouvait rien. **(3) Machines** : `multi-01` (une image, sept scénarios), `internal-01` (le nœud du pivot), le nœud « web » rééquipé (page de diagnostic qui expose le compte de service réutilisé + outil de supervision qui permet le pivot) et le binaire `setuid root`. Un **réseau « backstage »** rend le pivot réel : le nœud interne est *invisible* depuis la machine de l'élève. La CI GitHub rejoue désormais les dix scénarios sur Docker (42 contrôles). **Audit honnête et plan** dans `docs/SCENARIOS-M3.md` : difficulté étape par étape, ce que chaque test prouve et ne prouve pas, alignement MIT (10 scénarios sur 42 séances), et **réponse franche sur les cours externes : ils ne sont pas dans le parcours** (recensés et sous licence vérifiée, plan d'intégration en M3 bis). 243 assertions. |
| 31/10/2026 | **v0.5.3 (suite)** | **Test des machines sur GitHub avec Docker** : le runner GitHub Actions dispose de Docker et des privilèges nécessaires — les machines y sont donc construites et lancées **pour de vrai à chaque push** (`.github/workflows/labs.yml` + `scripts/test-labs-ci.sh`, 17 contrôles : la machine reste allumée, le terminal répond, le drapeau est accessible, deux apprenants ne se voient pas, pas de sortie Internet, la pile réseau de 4 services monte/répond/s'arrête, aucun reste). Résultat : **17 réussis, 0 échec**. Le projet peut donc être validé avec Docker **sans serveur**, et l'hébergement de production est tranché dans `docs/HEBERGEMENT.md` (mutualisé = lab simulé ; VPS = lab réel ; les deux restent possibles, le plugin bascule seul). |
| 31/10/2026 | **v0.5.3** | **Machines réellement lancées + recette serveur** : le démon Docker reste impossible dans le bac à sable (aucun privilège noyau), mais un runtime **rootless (Podman)** y fonctionne : les trois machines ont été **construites et lancées pour de vrai**. Ce passage a révélé **six défauts qui auraient cassé les labs en production** : commande du manifeste passée en un seul argument (le conteneur s'arrêtait aussitôt), Apache sur le port 80 sans privilèges (refus de démarrer), drapeau et notes copiés en tant que dossiers (`cat` → « Is a directory »), drapeau lisible par root seulement (lab impossible à finir), environnement réduit pour le client Docker (`DOCKER_HOST` perdu), reconstruction des images à chaque déploiement. Corrections : commande découpée en arguments, port 8080, fichiers copiés fichier par fichier, drapeau `root:ctf` en 444, héritage de l'environnement, `build` puis `up --no-build` avec image partagée par les 4 services, suppression du conteneur homonyme avant création, arrêt par étiquette. Ajout de `scripts/recette-serveur.sh` (22 contrôles) et de `docs/RECETTE-SERVEUR.md` (où coller la checklist de 10 lignes : **le serveur qui a Docker**, pas GitHub, pas l'hébergement mutualisé). 226 assertions. |
| 31/10/2026 | **v0.5.2** | **Validation en WordPress réel** : bac à sable avec WordPress 7.1.4 + MariaDB, plugin et thème installés, labs déposés hors WordPress et pointés dans les réglages. Protocole joué de bout en bout : déploiement des machines, commandes réelles, drapeaux, XP, médailles, nettoyage horaire. **Test décisif à deux apprenants :** conteneurs `seca_lab_<apprenant>_<room>`, réseaux `seca_lab_<apprenant>_<room>` et projets Compose `seca_<prefixe>_<apprenant>_<room>` distincts — aucun croisement. Trois défauts réels trouvés et corrigés : récursion infinie du filtre « locale » (site figé), lecture peu fiable du dossier des labs (cache d'options WordPress 7.x), réseau dédié non créé avant la machine (`docker run --network` aurait échoué). 218 assertions. Reste : **démon Docker réel** à valider chez l'hébergeur (le bac à sable n'a aucun privilège noyau). |
| 31/10/2026 | **v0.5.1** | **M1 phase 2 livrée** : branchement des 6 rooms de démonstration sur les vraies machines (`web-01`, `bin-01`, `net-01`), **isolation stricte par apprenant** (réseau `seca_lab_<apprenant>_<room>` créé `--internal`, projet Compose `<prefixe>_<apprenant>_<room>`, plus aucun nom de conteneur fixe dans `docker-compose.yml`), nettoyage horaire des piles Compose par étiquettes, **page de réglages** (dossier des labs, first blood), commande `docker run` refactorée et vérifiée champ par champ. 208 assertions. Reste : **vérification sur un hôte Docker réel** (le bac à sable de développement n'a pas de démon Docker). |
| 31/10/2026 | **v0.5.0** | **M2 bis livrée** : trois types de question (`text` / `choice` / `action`), validation serveur de l'action par l'état réel du terminal, vrai QCM à choix, choix traduisibles, contenu de démonstration mis à jour. **Bug bloquant corrigé** : le champ de saisie de la réponse n'était jamais inséré dans le DOM — le flux de réponse était cassé dans le navigateur (les tests PHP ne le voyaient pas ; un test statique sur le JS le couvre désormais). 189 assertions. **Écarts THM documentés** (`docs/ECARTS-TRYHACKME.md`), **registre des sources** ouvert (`docs/SOURCES-CONTENU.md`), **palier 3 planifié** (`docs/CONTENU-MIT.md` § 9-13 : 14 rooms 6.858 + 20 rooms 6.857 + lab `crypto-01` + barème 20/35/25/20). **La roadmap devient la constitution** (articles, règles de décision, ordre des jalons). |
