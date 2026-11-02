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

---

### BLOC S — Les robots d'IA et le maillage interne — ✅ LIVRÉ (v0.7.0)

**L'idée.** Deux demandes explicites du propriétaire, à ne pas confondre avec
le guide Google :

1. « Le fichier robots doit accepter tous les LLM — Claude, OpenAI, bref tout
   le monde — pour être lisible et cité. »
2. « Es-tu sûr que le site est conforme à 100 % au guide SEO de Google ? »

À la première, on répond par un `robots.txt` qui **nomme** les robots, au
lieu de se contenter d'un `User-agent: *` muet. À la seconde, on répond par un
audit refait à la main — et il a trouvé **dix écarts réels** que l'audit
automatique previous ne voyait pas.

**L'écart le plus grave : le maillage interne.** Un audit vérifiait la
*structure* du site (balises, données structurées) mais jamais la question
essentielle : *un robot peut-il atteindre les rooms ?* La réponse était non.
Les 52 rooms n'étaient atteignables **que par le plan du site**. L'accueil
affichait « Bonjour tout le monde ! » (le texte de démonstration de
WordPress). La page d'un parcours affichait « Lire la suite » et zéro lien.
Un visiteur non connecté ne trouvait aucun lien.

**Les dix écarts trouvés (et corrigés dans la même version) :**

| # | Écart trouvé | Gravité | Traitement |
|---|---|---|---|
| 15 | **0 room sur 52** atteignable par liens internes | Bloquant | L'accueil liste les 52 rooms et les 4 parcours ; chaque parcours liste ses rooms ; le catalogue public lie chaque carte |
| 16 | `/parcours/` = 404 (le menu du thème la visait) | Majeur | Page « Parcours » **créée automatiquement** à l'installation, et mise en accueil |
| 17 | `robots.txt` ne nommait **aucun** robot d'IA | Majeur | 20 robots nommés un par un, en deux sections (citation / entraînement) |
| 18 | Le titre des pages **arabes** restait en français (Google y voyait un doublon) | Majeur | Le titre et la description suivent la langue affichée |
| 19 | **37 chaînes de traduction dégradées** + 2 extraits français corrompus | Majeur | 72 corrections, par un script qui refuse de modifier un fichier sans ancre exacte |
| 20 | `/author/admin/` **ouverte** : le nom du compte d'administration exposé, et les contenus dupliqués | Majeur | Archive fermée (404) et retirée du plan du site |
| 21 | Accueil = texte de démonstration de WordPress | Majeur | Page d'accueil créée automatiquement ; textes de démonstration mis de côté |
| 22 | Aucune image de partage | Mineur | Visuel 1200×630 livré avec le thème ; `og:image` et `twitter:image` toujours déclarés |
| 23 | Pas de gabarit 404 dans le thème | Mineur | `404.php` créé : la page d'erreur propose les parcours et les rooms |
| 24 | Pas de `llms.txt` | Info | Généré à partir du contenu réel (impossible qu'il devienne faux) |

**La nuance qui compte, sur `Google-Extended`.** Google le dit dans son guide :
`Google-Extended` sert à l'**entraînement** et à l'**ancrage** dans *les
autres* systèmes Google — il ne contrôle **pas** les AI Overviews ni l'AI
Mode. Ce qui les contrôle, c'est `Googlebot`. Autoriser `Google-Extended`
ne garantit donc **pas** la citation : c'est le maillage, le contenu et les
données structurées qui l'obtiennent. Le `robots.txt` distingue les deux familles
pour que le choix soit fait en connaissance de cause.

**La barrière.** L'auditeur SEO passe de **35 à 45 contrôles** (10
nouveaux : robots d'IA nommés, robots d'IA autorisés, plan déclaré dans
`robots.txt`, liens vers les rooms sur l'accueil, liens vers les parcours,
chaque parcours listant ses rooms, titre arabe suivant la langue, aucune
version restée en français, archive d'auteur fermée, image de partage). Un
script séparé, `scripts/audit/verif-maillage.php`, mesure le maillage en
téléchargeant les pages **comme un robot** : il vérifie que **52 rooms sur
52** sont liées depuis un parcours. Le comité d'audit passe de **108 à 118
contrôles, 0 constat**.

**La réponse honnête à « 100 % ? »** est dans `docs/SEO-GENERATION-AI.md` :
conforme sur **tout ce qui se vérifie sur une machine**, et **pas** de
garantie sur ce qui dépend de Google (indexation réelle, présence dans un
AI Overview, Core Web Vitals, citations effectives). Ces quatre choses se
mesurent après la mise en ligne, dans la Search Console.

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

### BLOC T — Le comité d'audit à 15 experts — ✅ LIVRÉ (v0.8.0)

**L'idée.** Cinq auditeurs étaient une bonne beginnings, mais insuffisants :
ils regardaient le site à travers cinq lunettes et laissaient passer des angles
morts entiers. Le propriétaire demande un comité de **quinze** experts, un par
domaine, capable de statuer sur **le thème, le plugin et le moteur** ensemble.

**La règle qui change tout : la preuve.** Un auditeur n'a le droit de conclure
que s'il a joué un scénario, lu une ligne de code, ou mesuré une valeur. Un
constat sans preuve est **rejeté** — pas « signalé avec réserve », *rejeté*.
Cette règle est appliquée par le harnais lui-même : `audit_verifier()` exige
une preuve (tiré de la page servie, d'un fichier, d'une commande), et le rapport
HTML la reproduit mot pour mot sous chaque constat. Un rapport qui affirme
« l'ergonomie pourrait être améliorée » sans une mesure est **invalide**.

**Les quinze domaines.** Les cinq premiers sont conservés tels quels (ils sont
sains) ; les dix suivants comblent des angles morts vérifiés dans le code :

| # | Domaine | Objet | Angle mort comblé |
|---|---|---|---|
| 1 | SEO | Indexation, titres, maillage, données structurées, robots d'IA | — (existant) |
| 2 | Contenu | Squelette, qualité des questions, sources, vérité de la documentation | — (existant) |
| 3 | UX/UI | Contrastes, téléphone, RTL, messages à l'élève | — (existant) |
| 4 | Développement | Syntaxe, compatibilité, échappement, SQL, AJAX, tests | — (existant) |
| 5 | Sécurité | Secrets, isolation, durcissement, en-têtes, livraison | — (existant) |
| 6 | **Pédagogie** | Les 4 temps, le verrouillage, la difficulté, la surcharge cognitive, la qualité du feedback | Aucun audit ne vérifie que le plugin **enseigne** |
| 7 | **Performance** | Poids des pages, requêtes SQL, temps de réponse, LCP/CLS/INP | Aucun audit de performance n'existe |
| 8 | **Données structurées** | Complétude du JSON-LD sur **toutes** les pages, cohérence, correspondance au visible | Vérifié : `Course` n'est servi sur aucune page |
| 9 | **Accessibilité** | Grille WCAG 2.2 AA critère par critère, clavier, lecteurs d'écran, zoom | L'UX en prend un échantillon, pas la grille |
| 10 | **Multilingue** | Cohérence FR/AR/EN sur **tous** les champs, RTL de bout en bout, dates/nombres | 72 corrections à la main, sans garde-fou automatique |
| 11 | **RGPD & mineurs** | Confidentialité, cookies, données d'un mineur, export/suppression | La Politique de confidentialité est **en brouillon** |
| 12 | **Moteur de lab** | Cycle de vie complet, TTL, nettoyage, deux apprenants, reprise après panne | La Sécurité vérifie le durcissement, pas le **fonctionnement** |
| 13 | **Onboarding** | Inscription, première room, premier déploiement, première réussite | Aucun audit : on peut avoir 52 rooms parfaites et un élève qui abandonne |
| 14 | **Licences & attribution** | Attribution du contenu repris (MIT, Stanford, pwn.college), licences, sources | Seules les **vidéos** sont attribuées, pas le texte repris |
| 15 | **DevOps & résilience** | Déploiement, rollback **testé**, sauvegarde **et restauration**, logs, secrets | Personne ne vérifie qu'on peut revenir en arrière |

**La neutralité est une exigence de méthode, pas une politesse.** Chaque
auditeur est écrit pour **chercher la faute**, y compris dans le travail du
propriétaire. Un auditeur qui ne trouve rien sur un sujet qu'on sait imparfait
est un auditeur mal écrit : le rapport doit donc aussi porter les **forces**,
mesurées, et l'audit ne vaut que s'il est capable de dire les deux.

**Les rapports sont en HTML**, complets : verdict, forces, faiblesses, et sous
chaque constat la **preuve** (extrait de code, sortie de scénario, mesure).
Un rapport Markdown reste produit en parallèle (pour l'historique et le
dépôt), mais c'est le HTML qui fait foi.

**Ce qu'aucun audit ne peut faire — et qui ne sera pas maquillé.** Un script
mesure ; il ne *ressent* pas. Ces points resteront des jugements humains, et le
rapport le dira explicitement plutôt que de les déguiser en contrôle :
la compréhension d'une leçon, la qualité d'une traduction, le rythme d'un
parcours, la valeur perçue d'un badge.

**Le contenu : au-delà du MIT.** La commande est explicite : ne pas s'arrêter au
MIT, mais couvrir **les grandes universités du monde** — avec vidéo, avec
exercices et avec **certificats gratuits disponibles**, et préparer l'élève à
**passer les vrais examens renommés** (et non à lessimuler). Ce travail est
livré dans `docs/CERTIFICATIONS.md`, avec la distinction honnête entre :
certificats **réellement gratuits** (Harvard CS50, picoCTF de Carnegie Mellon,
PortSwigger Web Security Academy, OWASP Juice Shop, freeCodeCamp, OpenLearn),
certificats **gratuits en formation mais payants à l'examen** (CompTIA
Security+, Google Cloud Digital Leader, Microsoft SC-900, eJPT, OSCP), et
certificats **fermés aux nouveaux candidats** (ISC2 CC, depuis le 20/05/2026 —
un piège de plus-value : beaucoup de pages « gratuites » de 2025 n'ont pas
été mises à jour). Chaque **parcours** est rattaché à une certification
nommée, avec le coût exact de l'examen affiché à l'élève dans les trois
langues : l'élève sait où il va, et ce qu'il lui reste à payer lui-même.

**Le seuil.** Le workflow `audit.yml` échoue si un seul constat **bloquant
ou majeur** survient. C'est la barrière automatique : la conformité ne peut pas
se dégrader en silence.

> **Durcie le 01/11/2026 (v0.8.4).** La barrière ne s'arrêtait qu'aux
> constats *bloquants*. Un défaut réel de gravité **majeur** — le saut de
> titre `h1 → h3` de la room « Kahoot » — a donc été **livré** avec une CI
> verte et une plateforme déclarée « conforme » : il n'est apparu que parce
> qu'un humain avait lu le journal. La barrière bloque désormais sur
> *majeur* comme sur *bloquant* ; un contrôle de l'auditeur « DevOps »
> vérifie ce comportement **en l'exécutant** (codes 0 / 1 / 1), et la règle
> « un contrôle qui choisit sa cible au hasard n'est pas un contrôle » a
> été appliquée à **tous** les auditeurs : six d'entre eux ne regardaient
> qu'une room sur 52 — ils regardent désormais toute la collection.

### BLOC V — Le moteur d'épreuves et le panel des dix élèves (résultat, 01/11/2026)

Deux outils répondent à deux questions du propriétaire, et les deux sont
**mesurés**, pas affirmés :

1. **Le moteur d'épreuves (v0.9.0)** — chaque élève passe **sa** copie.
   Ce qui est vérifié à chaque push : le moteur est livré et chargé ; le
   tirage est reproductible (aucun hasard non maîtrisé) ; chaque question
   paramétrique a au moins trois variantes et toutes ses valeurs sont
   définies ; dix élèves ⇒ dix copies différentes ; recharger redonne la
   même copie ; aucune question liée à une machine ne voyage dans une
   autre room.

2. **Le panel des dix élèves (17ᵉ auditeur)** — dix profils réels jouent la
   plateforme en HTTP réel : créer un compte, se connecter, ouvrir le
   parcours, lire la leçon, répondre. Le panel mesure le chemin (combien
   d'étapes), la récompense (points, médaille, niveau) et la copie
   (l'empreinte de l'examen reçu par chacun).

**Le seul constat ouvert, et il est de contenu :** le réservoir d'un examen
va de **11 à 34 questions** (médiane 26) quand l'objectif annoncé est
d'environ **200 questions par niveau**. Ce n'est pas une panne du moteur —
le moteur sait tirer dans un réservoir de 200 questions aussi bien que dans
un réservoir de 30 — c'est **un travail de rédaction** (environ 20 sections
× 200 questions, écrites dans les trois langues). L'auditeur le mesure à
chaque passage et le signale en « mineur » : il ne cache pas l'écart.

### BLOC T — Résultat (01/11/2026)

Les quinze auditeurs sont écrits, joués et **verts** : **207 contrôles
réussis, 0 constat** (0 bloquant, 0 majeur, 0 mineur). Les rapports sont en
HTML complet (verdict, périmètre, chiffres, scénarios joués, forces, constats
avec la preuve, limites explicites), en Markdown et en JSON.

Les constats trouvés — et corrigés — sont listés dans
`docs/AUDITS-REGISTRE.md` (§ 1 bis). En résumé :

- **1 bloquant** : les pages légales (politique de confidentialité et mentions
  légales) n'existaient pas ou restaient en brouillon — écrites, publiées, en
  trois langues, avec liens au pied de page.
- **8 majeurs** : l'invitation à s'inscrire pour le visiteur anonyme, la
  création de compte ouverte, la certification de chaque parcours, le
  `ItemList` des parcours, les entités HTML dans le JSON-LD, les timeouts des
  workflows, la purge des sauvegardes, la procédure de restauration.
- **2 défauts trouvés en cours de route** : le sens de lecture arabe n'était
  pas posé sur le document, et la **barrière bloquante ne bloquait pas**
  (`return` ignoré par `wp eval-file`).
- **3 défauts trouvés après la livraison (v0.8.1)** : les actions AJAX
  renommées dans le plugin seulement — **le site était cassé pour les
  élèves** ; le mot « fonctionnalités » écrit en coréen dans la politique de
  confidentialité — **public via l'API REST** ; et les pages légales de la
  base qui n'étaient jamais remises à jour après une correction du plugin.
  Chacun a reçu **un garde-fou automatique** et un test qui prouve que le
  garde-fou détecte bien la faute (et ne signale pas de faux positif).
- **1 défaut trouvé par la CI elle-même (v0.8.2)** : les pages légales
  n'existaient **que sur un serveur web**. Le plugin rangeait les textes
  dans une variable globale ; or WP-CLI charge WordPress **dans une portée
  de fonction**, où une telle variable n'existe pas. Le défaut ne vivait
  donc que dans un contexte — invisible pour la recette manuelle, fatal
  pour la CI. Les textes passent désormais par une **fonction**, qui
  existe dans tous les contextes ; l'installation est **vérifiée
  explicitement** (l'échec nomme la page absente) ; et deux contrôles
  automatiques interdisent le retour de la faute.
- **1 défaut trouvé par la CI elle-même (v0.8.3)** : la feuille de style
  arabe était déclarée avec un **chemin de fichier** au lieu d'une
  **adresse** — le navigateur demandait donc une URL inexistante (404),
  et **la mise en page arabe n'était jamais appliquée**. Le site paraissait
  correct (le sens de lecture du document est posé), mais l'habillage
  arabe, non. Le constat qui l'a révélé était, lui, un **faux positif** :
  le contrôle mesurait la page 404, qui contient le CSS de WordPress.
  **Correction :** adresse correcte, et feuille arabe chargée dès que le
  visiteur lit en arabe, même sur un site en français. **Garde-fou :** un
  contrôle **bloquant** vérifie désormais que toutes les feuilles de style
  d'une page se chargent, dans les trois langues.

Le catalogue mondial et les certifications sont livrés dans
`docs/CERTIFICATIONS.md`.

---

### BLOC W — Les questions de machine jouées pour de vrai, et la stratégie de contenu (01-02/11/2026)

**1. Le constat du propriétaire était juste, et il cachait un défaut grave.**
« Les questions de drapeau et d'action demandent la machine de l'élève :
elles ne sont pas jouées ici. » C'est vrai — et en cherchant pourquoi, on a
trouvé un défaut qui rendait **impossible de valider ces questions** :

> Le moteur d'épreuves tirait les questions d'un test ou d'un examen
> **parmi toutes celles de la section**. Les questions de drapeau et
> d'action, elles, **restaient dans leur room** (une machine ne se
> transpose pas). Résultat : le tirage pouvait les **remplacer** par des
> QCM, et la question de drapeau **n'était jamais posée**. Sur les 52
> rooms, 60 questions de drapeau et 1 question d'action étaient donc
> **inatteignables**.

**Correction :** les questions qui demandent la machine ne se tirent plus —
elles font partie de la **mission** de la room, donc elles sont **toujours**
dans la copie de l'élève. Le reste du tirage (l'ordre, les chiffres, les
QCM) ne change pas : le principe « jamais les mêmes examens pour tout le
monde » est intact.

**2. Un 18ᵉ auditeur est né de cette exigence** : `scripts/audit/audit-drapeaux.php`.
Il ne se contente pas de regarder le code : il **joue**. Pour chaque
question de machine, il crée un élève, se connecte, lit la leçon, répond,
**déploie la machine**, **cherche la valeur dans la machine** (comme un
élève), la soumet, et vérifie que **le serveur l'accepte** en relisant le
fichier de drapeau **en root**. Les 61 questions sont ainsi **réellement
jouées**, pas supposées jouables.

**3. Les défauts trouvés en route, tous corrigés :**

| Défaut | Effet | Correction |
|---|---|---|
| Le tirage écartait les questions de machine | 61 questions jamais posées | Elles restent toujours dans la copie |
| `absint(-1)` valait `1` | La question d'action exigeait une étape de terminal inexistante | Le signe est préservé (`-1` = aucune vérification) |
| La machine était déployée **après** le parcours | Le terminal était verrouillé, l'action refusée | On déploie d'abord |
| Les motifs du terminal containing un `.` étaient ignorés | `cat config.txt` n'était jamais joué | On tape le motif en clair |
| Les drapeaux d'une pile Compose n'étaient pas en `/root/flags/` | La lecture par le serveur échouait | Le service « flags » est corrigé |

**4. La stratégie de contenu change** (décision du propriétaire, 01/11/2026) :
**on ne rédige plus de questions.** Le plan « 4 000 questions à écrire » est
**annulé**. Le contenu vient désormais d'un **import** de questions déjà
validées : cours d'universités (MIT OCW, StanfordSEE), fiches OWASP,
publications NIST — et, quand l'éditeur l'autorise, des examens de
certification. Le catalogue des sources autorisées est un fichier
(`tools/sources-autorisees.json`), l'outil d'import refuse tout ce qui n'y
figure pas (`tools/import-questions.py`), et la room affiche un encart
**« Sources »** avec le nom, le lien, la licence et l'attribution.
Détail : `docs/IMPORTER-QUESTIONS.md`.

**Ce qui ne change pas :** nos **défis pratiques** (les machines, le
terminal, les drapeaux) restent nos défis — une question de drapeau
dépend de **notre** machine, elle ne peut pas venir d'un catalogue.

### BLOC X — Le panel à vingt élèves, le premier import d'examen, et le réservoir honnête (02/11/2026) — ✅ LIVRÉ (v0.10.0)

**1. Le panel passe de dix à vingt élèves** (décision du propriétaire).
Dix profils (âge, langue, spécialité cyber, téléphone ou ordinateur) ne
couvrent pas la diversité réelle : la platforme vise des élèves de 14 à 52
ans, arabophones, francophones ou anglophones. Le panel compte donc
**vingt profils** — Yasmine (16, ar), Lucas (19, fr), Amina (22, ar), Tomás
(24, en), Sarah (17, fr), Karim (31, ar), Mei (15, en), Julien (45, fr),
Nadia (28, fr), Sofia (34, en), Adam (14, fr), Hanane (26, ar), Diego (21,
fr), Rashid (38, ar), Chloé (29, fr), Omar (16, ar), Priya (23, en),
Youssef (52, fr), Nora (19, ar), Elena (44, en).
**Mesuré :** 20/20 créent un compte en une étape, se connectent, jouent ;
20/20 reçoivent des points (0 → 223-247 XP), 2 médailles d'or, et passent
de « Observateur » à « Apprenti ». Le rapport est dans
`docs/audits/panel-eleves-2026-11-02.html`.

**2. Le premier import réel : les quiz d'examen du MIT 6.858.**
Le propriétaire avait choisi PortSwigger comme première source. La lecture
des conditions d'utilisation (usage personnel seul, usage commercial
interdit, copie des éléments d'examen interdite) montre que **la copie
verbatim est interdite** : la Web Security Academy est donc **citée comme
pratique liée** dans cinq leçons, et **rien n'est copié**. Ce refus est
**prouvé par un test automatique** (`tests/import-test.py`, dans la CI) :
un lot qui prétend venir de PortSwigger est rejeté, avec le motif.

La première source réellement importable est donc **MIT OpenCourseWare
6.858 (Fall 2014)** : 24 PDF (12 quiz + 12 corrigés officiels), licence
**CC BY-NC-SA 4.0**. L'extracteur (`tools/import-mit-ocw.py`) lit les
corrigés et **refuse** ce qui ne serait pas honnête : pas de réponse dans
le corrigé, pas d'explication du corrigé (un élève ne doit pas deviner),
item qui renvoie à une figure ou à un article (« Line 4 », « the figure
above »), énoncé tronqué, doublon. **59 items repérés, 17 retenus** —
chacun avec l'**explication officielle du MIT**, en anglais, dans le
format d'origine (2 ou 3 propositions : on n'invente pas de fausse
proposition pour atteindre quatre). L'auditeur de contenu distingue
donc les questions importées des nôtres.

**3. Le réservoir était compté deux fois — et le « jamais le même examen » tenait au hasard.**
En préparant l'import, une anomalie est apparue : une room affichait un
réservoir de 12 questions, mais **six questions distinctes** — la même
question se trouve dans la tâche d'entraînement *et* dans la tâche
d'examen, et le réservoir les comptait deux fois. Deux conséquences :

- la mesure était **gonflée** : le vrai réservoir est de 6 à 24 questions
  distinctes (médiane 17), pas de 12 à 36 ;
- et surtout, **deux élèves pouvaient recevoir le même ensemble de
  questions**. Avec sept questions distinctes et une épreuve de trois, la
  probabilité que vingt élèves aient tous des examens différents est de
  **0,4 %** : le panel le.constate, et il a eu raison.

**Corrections :**
- le réservoir **ne compte plus deux fois** la même question (`Secura_Exam::pool()` déduplique sur le texte et les propositions) ; une copie ne peut donc plus contenir la même question deux fois ;
- l'**ensemble** de questions n'est plus tiré au hasard mais par un **compteur** : deux élèves ne peuvent pas recevoir le même ensemble tant que le réservoir le permet (le hasard, lui, décide toujours de l'ordre et des chiffres, donc la copie reste reproductible pour un élève donné).

**Et la CI a vu ce que le local ne voyait pas.** Le premier correctif
(déduplication + compteur en PHP) passait en local et **a échoué en CI** :
le panel y a trouvé deux élèves avec le même examen. La cause : le
compteur était lu puis réécrit en PHP, et **deux requêtes simultanées**
pouvaient lire la même valeur — le compteur doit être incrémenté **en
base**, atomiquement. C'est fait (`LAST_INSERT_ID`), et vérifié : vingt
processus lancés en même temps obtiennent vingt copies différentes.

**4. Ce que disent les mesures, après correction :**

| Mesure | Avant | Après |
|---|---|---|
| Questions sur la plateforme | 392 | **409** (dont 17 d'examen MIT) |
| Réservoir réel d'un examen | 12 à 36 (compté deux fois) | **6 à 24 distinctes** (médiane 17) |
| Copies d'examen possibles | 131 365 839 (gonflé) | **2 039 152** (honnête) |
| Copies distinctes pour 20 élèves | 20/20 **par hasard** | **20/20 par construction** |
| Examens au réservoir trop juste (×5) | 24 (mesure gonflée) | **36** (mesure honnête) |
| Questions manquantes pour tenir la règle du ×5 | 131 (mesure gonflée) | **275** (mesure honnête) |

Le dernier chiffre est le **vrai chantier** : il ne se comble pas par du
code, mais par du contenu importé. Il est mesuré, room par room, par
`scripts/audit/probe-reservoirs.php` (275 questions à trouver pour tenir
la règle du ×5 sur les 36 examens concerned), et
`scripts/audit/probe-copies.php` vérifie qu'en attendant, vingt élèves
reçoivent bien vingt copies et vingt ensembles différents.

---

---

## 9. Article 9 — Journal des revues

*(append-only — on n'efface pas une revue, on en ajoute une.)*

| Date | Version | Revue |
|---|---|---|
| 02/11/2026 | **v0.10.0** | **Le panel à vingt élèves, le premier import d'examen, et un réservoir qui ne se ment plus à lui-même.** Le propriétaire a demandé un panel de **vingt** profils (âge, langue, spécialité cyber) au lieu de dix : livré et mesuré — 20/20 élèves créent un compte en une étape, jouent, reçoivent des points (223 à 247 XP), deux médailles d'or, et passent de « Observateur » à « Apprenti ». **Premier import d'examen :** la source choisie (PortSwigger) **ne peut pas être copiée** — ses conditions d'utilisation l'interdisent — ; elle est donc citée comme pratique liée dans cinq leçons, et **le refus est prouvé par un test de CI**. La première source réellement réutilisable est **MIT OCW 6.858 (Fall 2014)**, 24 PDF de quiz et de corrigés officiels, licence CC BY-NC-SA 4.0 : l'extracteur en tire **17 questions** sur 59 items, en refusant tout item sans réponse officielle, sans explication du corrigé, ou qui renvoie à une figure ou à un article ; le format d'origine (2 ou 3 propositions) est conservé et l'auditeur de contenu distingue les questions importées des nôtres. **Le défaut le plus important du passage :** en cherchant pourquoi les copies se ressemblaient, on a trouvé que **le réservoir comptait la même question deux fois** (la question d'entraînement et la question d'examen d'une même room) : la mesure était gonflée de moitié, et surtout, **deux élèves pouvaient recevoir le même examen** — avec sept questions distinctes et une épreuve de trois, la probabilité que vingt élèves ait des examens tous différents est de 0,4 %. Le réservoir ne compte donc plus les doublons, et l'ensemble de questions n'est plus tiré au hasard mais par un **compteur** : deux élèves ne peuvent plus recevoir le même ensemble tant que le réservoir le permet, tandis que l'ordre et les chiffres restent tirés au sort et reproductibles. **La CI a refusé la première version** : le compteur, lu puis réécrit en PHP, se partageait entre deux requêtes simultanées et deux élèves pouvaient obtenir le même examen — en local, le panneau passait quand même (c'est une question de chance). Le compteur est désormais incrémenté **en base, atomiquement**, et la concurrence est testée (vingt requêtes simultanées → vingt copies différentes). **Mesures après correction :** 409 questions (392 + 17), réservoir réel de 6 à 24 questions distinctes (médiane 17), **2 039 152** copies d'examen possibles (et non 131 millions : c'était un mirage), **20/20 copies distinctes par construction** — le panel le rejoue et le confirme. **Le reste est un chantier de contenu, pas de code :** 36 examens ont un réservoir plus petit que cinq fois leur épreuve ; c'est désormais mesuré room par room (`scripts/audit/probe-reservoirs.php`), et chaque import le réduit. |
| 02/11/2026 | **v0.9.1** | **Les questions de machine sont enfin jouées pour de vrai.** Le propriétaire avait raison : les 60 questions de drapeau et la question d'action demandaient la machine de l'élève, et **le moteur d'épreuves pouvait les remplacer par d'autres questions** — donc, dans la pratique, **elles n'étaient jamais posées**. Correction : une question qui demande la machine ne se tire plus au sort, elle reste toujours dans la copie de l'élève (le mélange des propositions et les chiffres qui changent, eux, sont intacts). Un **18ᵉ auditeur** est ajouté : il ne regarde pas le code, il **joue** — il crée un élève, se connecte, lit la leçon, déploie la machine, cherche le drapeau **dans la machine**, le soumet, et vérifie que **le serveur l'accepte** en relisant le fichier **en root**. Quatre défauts trouvés au passage, tous corrigés : le signe de `requires_step` (`absint(-1)` valait 1, la question d'action était donc refusée), l'ordre de déploiement de la machine, les motifs de terminal contenant un point, et l'emplacement des drapeaux dans la pile Compose. **En parallèle, la stratégie de contenu change** : le propriétaire a tranché — **on ne rédige plus de questions** ; le plan « 4 000 questions » est annulé, remplacé par un **import** de questions validées par les universités ou issues d'examens de certification, avec un catalogue de sources, un outil qui refuse tout ce qui n'y figure pas, et un encart « Sources » visible dans la room. **Vérification finale :** le comité des 18 auditeurs a été rejoué **par GitHub** (passage `41374598365`, commit `a1b2954`), dans un WordPress installé de zéro et des **vrais conteneurs Docker** : **226 contrôles, 0 bloquant, 0 majeur, 1 mineur**, et les **61 questions de machine jouées et acceptées** dans cet environnement-là. Les rapports de ce passage sont conservés dans `docs/audits/`. |
| 01/11/2026 (bloc T) | **Le comité des 15 experts (v0.8.0)** | **Cinq auditeurs regardaient le site à travers cinq lunettes ; le propriétaire en a demandé quinze, et surtout une méthode : pas de rapport sans preuve.** Un auditeur n'a le droit de conclure que s'il a **joué un scénario, lu une ligne de code ou mesuré une valeur** ; un constat sans preuve est rejeté, pas « signalé avec réserve ». La règle est appliquée par le harnais lui-même : `audit_verifier()` exige la preuve, et le rapport **HTML** la reproduit mot pour mot sous chaque constat. **Le comité compte maintenant quinze spécialités** — les cinq premières conservées (SEO, Contenu, UX/UI, Développement, Sécurité), et dix nouvelles : Pédagogie, Performance & Core Web Vitals, Données structurées, Accessibilité WCAG 2.2 AA, Multilingue, RGPD & mineurs, Moteur de lab & Docker, Onboarding, Licences & attribution, DevOps & résilience. **Résultat : 196 contrôles réussis, 0 constat.** Mais les constats trouvés **en chemin** valent mieux que le résultat : **la barrière bloquante ne bloquait pas.** Le code *avait l'air* correct — `audit_fin()` renvoyait le code de sortie par `return` — or `wp eval-file` **ignore la valeur de retour** : le workflow aurait donc laissé passer n'importe quel constat bloquant. Vérifié par l'expérience (`return 3` → sortie 0 ; `exit(7)` → sortie 7), corrigé à la racine dans la bibliothèque. **Ensuite, un bloquant** : la politique de confidentialité était **en brouillon** et les mentions légales n'existaient pas — inadmissible pour une plateforme qui accueille des mineurs. Les deux pages ont été **écrites à partir de ce que la plateforme fait réellement** (les données stockées, l'absence de traceur, la durée de conservation, les droits), **publiées**, et traduites en français, arabe et anglais. **Un majeur d'usage** : le visiteur anonyme lisait tout le contenu mais, en cliquant sur une tâche, recevait « Une erreur est survenue. » — parce que les actions AJAX n'étaient enregistrées que pour les connectés. Elles le sont désormais pour tous : l'invité reçoit « Connectez-vous pour continuer. » avec un **lien cliquable**. Et le bouton « Créer un compte gratuit » ne menait nulle part : l'inscription était désactivée. Elle est maintenant activée **par la CI**, donc vérifiée à chaque push. **Le reste :** chaque parcours est rattaché à une **certification nommée** avec son **coût d'examen** affiché à l'élève (Security+ 439 $, eJPT ~249 $, Google Cybersecurity, PortSwigger BSCP) ; le JSON-LD ne contient plus d'entités HTML illisibles pour un moteur ; `ci.yml` et `deploy.yml` ont une limite de temps ; les sauvegardes sont purgées ; la **procédure de restauration** est écrite ; les 13 actions GitHub sont épinglées par empreinte SHA ; et le sens de lecture arabe est porté par la balise `<html>` — une page de contenu en arabe s'affichait de gauche à droite. **Sur le contenu** : le catalogue mondial et les certifications sont livrés dans `docs/CERTIFICATIONS.md`, avec la distinction honnête entre certificat **gratuit** (Harvard CS50, Fortinet NSE 1-3, freeCodeCamp, PortSwigger Academy) et formation gratuite à examen **payant** (Security+ 439 $, OSCP ~1 500 $) — et le rappel que **l'ISC2 CC est fermé aux nouveaux candidats depuis le 20/05/2026**. |
| 01/11/2026 (nuit, suite) | **Le correctif v0.8.1 — deux défauts trouvés en rejouant la recette à la main (v0.8.1)** | **Livrer un comité d'audit vert ne suffit pas : il faut ensuite rejouer le parcours de l'élève, à la main, comme un élève.** C'est ce que la recette des deux apprenants a fait — et elle a trouvé ce que les 196 contrôles n'avaient pas vu. **Défaut 1 — le site était cassé pour les élèves.** Les onze actions AJAX (le nom que le navigateur envoie au site) avaient été renommées de `secura_` en `seca_` **dans le plugin seulement** : le front `assets/academy.js` et la recette continuaient d'appeler `secura_lab_start`, `secura_terminal`, `secura_lab_status`, `secura_lab_stop`. WordPress ne dit pas « action inconnue » : il répond **`0`** avec un code 400. **Aucun journal, aucune erreur visible — le bouton « Déployer la machine » ne faisait rien.** Preuve : l'instrumentation de `has_filter()` a montré `wp_ajax_secura_get_room` **présent** et les quatre autres **absents** ; `git show d71a7e1` a montré que la version précédente enregistrait bien `wp_ajax_secura_*`. **Correction :** les onze actions sont revenues à leur contrat `secura_*` (et `wp_ajax_nopriv_` conservé, pour que l'invité reçoive une vraie invitation et non une erreur muette). **Garde-fou :** deux contrôles automatiques vérifient désormais **nom par nom** que le front, la recette et le plugin emploient les mêmes actions ; testés **dans les deux sens** (en rejouant la faute, ils produisent 2 constats bloquants qui nomment l'action fautive). **Défaut 2 — le mot « fonctionnalités » écrit en coréen.** Invisible à l'écran (les caractères coréens ont l'apparence d'un texte latin), **mais public via l'API REST**, qui publie le texte brut de la base : « la page marche » ne prouve pas que « le contenu est propre ». **Correction :** texte réécrit ; et les pages légales de la base sont désormais remises à jour **à chaque version du plugin**, par comparaison d'empreinte — **sans jamais écraser un texte que le propriétaire aurait retouché à la main** (le cas a été testé : le texte du propriétaire survit, le défaut disparaît quand même, parce que la page affichée sert le texte du plugin). **Garde-fou :** un contrôle de l'auditeur « Multilingue » cherche toute écriture étrangère (cyrillique, grec, han, hangul, devanagari, thaï, hébreu) **dans les fichiers livrés et dans les pages réellement servies, API REST comprise** ; testé **dans les deux sens**. **Un contre-exemple honnête :** la première version de ce contrôle lisait la base de données et signalait le texte brut — même lorsqu'un propriétaire y avait écrit son propre texte. C'était un **faux positif**, et il a été réécrit : *un audit qui produit de faux positifs perd la confiance de celui qui le lit.* Résultat final : **199 contrôles réussis, 0 constat**, recette **34/34**, scénario des deux apprenants **100 % réussi** (machines déployées, drapeaux lus dans le conteneur de chacun), **302 tests** au vert. |
| 01/11/2026 (nuit, suite 2) | **Le correctif v0.8.2 — les pages légales qui n'existaient qu'à moitié (v0.8.2)** | **La CI a trouvé ce que la recette manuelle ne pouvait pas trouver : un défaut qui ne vivait que dans un contexte.** Le workflow « Audit externe » est tombé rouge sur un constat RGPD bloquant — « politique de confidentialité en brouillon, mentions légales absentes ». En cherchant la cause, on a trouvé le mécanisme : **WP-CLI charge WordPress à l'intérieur d'une fonction**, et une variable globale définie par un plugin n'y existe pas. Le plugin rangeait les textes légaux dans une telle variable : les pages légales étaient donc créées **sur un vrai serveur web**, et **jamais** sur un site installé en ligne de commande — c'est-à-dire **jamais en CI**. Le défaut était invisible parce que la recette manuelle jouait toujours dans le contexte qui le rendait invisible. **Correction :** les textes passent par une **fonction** (`seca_textes_legaux()`), qui existe dans tous les contextes — web, WP-CLI, cron, tests. **Garde-fou 1 :** `scripts/ci-wordpress.sh` **vérifie** l'installation et échoue en nommant la page absente (le journal d'un workflow en échec doit dire pourquoi). **Garde-fou 2 :** deux contrôles automatiques interdisent le retour de la faute (aucune variable globale de plugin lue ; textes atteignables par une fonction). **Garde-fou 3 :** un faux positif a été corrigé au passage — l'auditeur « Données structurées » comparait un titre à son equivalent échappé (`&#8217;`) et signalait à tort une room absente de l'écran. Résultat : **200 contrôles, 0 constat**, recette **34/34**, scénario des deux apprenants **100 % réussi**, **302 tests** au vert. **La leçon de la revue :** « ça marche sur mon serveur » est une preuve *dans un contexte* ; pour prouver le reste, il faut rejouer l'installation ailleurs. |
| 01/11/2026 (nuit, suite 3) | **Le correctif v0.8.3 — la feuille de style arabe, qui n'arrivait jamais (v0.8.3)** | **« La page s'affiche en arabe » ne prouve pas que « la mise en page arabe est appliquée ».** Il y a deux choses : le sens de lecture du **document** (`dir="rtl"`), posé par le plugin, et celui de la **mise en page**, qui vient d'une feuille de style. Le thème déclarait cette feuille avec un **chemin de fichier** (`get_template_directory()`) au lieu d'une **adresse** (`get_template_directory_uri()`) : le navigateur demandait donc une URL inexistante, la réponse était un **404**, et **la feuille arabe n'était jamais chargée**. Personne ne l'avait vu : le site « paraissait correct » — le sens de lecture du document est bien posé, la page est bien en arabe. Et le constat de l'auditeur était, lui, un **faux positif** : il mesurait la page 404, qui contient le CSS de WordPress en ligne — nos deux feuilles à nous n'ont **aucune** propriété physique (vérifié sur les fichiers du dépôt). **Correction :** l'adresse est la bonne, et la feuille arabe est désormais chargée **dès que le visiteur lit en arabe**, même si le site est en français — ce qui est le cas par défaut, et le cas le plus fréquent. La version du thème est aussi cohérente partout : le code annonçait `0.7.0` quand l'en-tête du CSS annonçait `0.8.2`. **Garde-fou :** un contrôle **bloquant** nouveau — « toutes les feuilles de style de la page se chargent (HTTP 200) », dans les trois langues ; et le contrôle multilingue ne mesure plus une page d'erreur comme si c'était une feuille de style, et nomme l'adresse complète dans sa preuve. Un faux positif de l'auditeur « SEO » est corrigé au passage : le titre d'une room était comparé sans normaliser les apostrophes (droites en base, typographiques à l'écran). Résultat : **202 contrôles, 0 constat**, recette **34/34**, **302 tests** au vert. |
| 01/11/2026 (nuit, suite 4) | **Le correctif v0.8.3-bis — un audit qui tire au sort ne prouve rien (v0.8.3-bis)** | **« 0 constat » n'a de valeur que si le contrôle a regardé *tout* ce qu'il prétend regarder.** La CI a trouvé un **majeur d'accessibilité** que la recette locale ne voyait jamais : dans la room « Kahoot : la révision des labs avancés », la hiérarchie des titres sautait du niveau 1 au niveau 3 — un lecteur d'écran annonce alors « titre de niveau 2 manquant ». **Pourquoi la recette locale ne l'avait pas vu :** le contrôle d'accessibilité **tirait une room au hasard** ; selon l'identifiant tiré, le défaut apparaissait ou non. **Il était donc visible en CI, invisible en local, et différent d'une exécution à l'autre — un contrôle qui dépend d'un hasard n'est pas un contrôle.** **La cause réelle :** les autres blocs d'une room (tâches, machine cible, terminal) titrent en `<h2>` ; le bloc Kahoot titrait en `<h3>`, un niveau inventé. **Le traitement :** bloc Kahoot en `<h2>` (le style est porté par la classe `seca-kahoot-title`, donc **le rendu visible ne change pas**) ; l'audit d'accessibilité vérifie **les 53 pages** (accueil + 52 rooms) en deux secondes ; l'auditeur « SEO » vérifie le titre de **chaque** room sur la page réellement servie, après normalisation des apostrophes. **Le garde-fou, testé dans les deux sens :** le défaut a été **remis volontairement** dans le code — l'audit a alors produit « room 59 : saut de niveau h1 → h3 », en nommant la room ; puis il a été retiré et le contrôle est repassé au vert. **La règle générale tirée de ce passage :** un contrôle qui choisit sa cible au hasard peut afficher « conforme » un jour et « rouge » le lendemain pour une raison sans rapport avec le code — donc **plus aucun audit de ce dépôt ne tire au sort**. Résultat : **203 contrôles, 0 constat**, recette **34/34**, **302 tests** au vert. |
| 01/11/2026 (nuit, suite 5) | **Le correctif v0.8.4 — la question « as-tu fait tous les tests ? » (v0.8.4)** | **La seule question qui compte devant un « 0 constat » : *qu'est-ce qui a été regardé ?*** Le propriétaire l'a posée, et elle a Immediately trouvé sa réponse : **six des quinze auditeurs ne regardaient qu'une room sur 52** — données structurées (1 room + 1 parcours), onboarding (1 room jouée), UX/UI (1 room rendue), performance (1 room pesée), multilingue (1 room lue, 1 page servie) et SEO (1 room pour le résumé, la canonique, le partage). **Chacun a été étendu à toute la collection** : 53 pages pour l'accessibilité, 57 pour les données structurées, 160 pages servies pour le multilingue, 54 pages pesées, 52 rooms jouées et rendues, 104 versions arabes et anglaises pour le SEO. **Résultat : aucun nouveau constat** — la plateforme était saine, mais on ne l'avait pas vérifié partout. **La preuve que le regard est complet (test négatif)** : une room a été amputée exprès de son résumé dans le bac à sable ; l'ancien contrôle la juge « ok » (il regarde la room 8), le nouveau la nomme en **[MAJEUR]**. **Le trou le plus important de ce passage :** la CI ne rougissait que sur les constats *bloquants*. Le défaut `h1 → h3` — un **majeur** — a été **livré** avec une CI verte ; il n'est apparu que parce qu'un humain a lu le journal. **La barrière est durcie** : elle bloque sur *majeur* comme sur *bloquant*, et l'auditeur « DevOps » le **vérifie en l'exécutant** (codes 0/1/1), testé dans les deux sens (ancienne barrière ⇒ constat majeur ; nouvelle ⇒ vert). **Reproductibilité** : le comité rejoué deux fois de suite donne **15/15 rapports identiques**. Résultat : **207 contrôles, 0 constat**, recette **34/34**, **302 tests** au vert. |
| 01/11/2026 (nuit, suite 6) | **Le moteur d'épreuves et le panel des dix élèves (v0.9.0)** | **La question du propriétaire : « si jamais tous ont les mêmes examens et tests pour le même niveau… on ne propose que 40, ce n'est pas des examens, ça va juste être capture d'écran et refait après ; jamais les mêmes chiffres ; tu es d'accord avec ça ? »** — et la question précédente : « recrute 10 agents, chacun son âge, sa langue, son expertise cyber ; dis-moi si c'est facile de créer un compte et de commencer le parcours, s'ils reçoivent vraiment points/médailles et si leur rang avance ». **Le moteur d'épreuves (v0.9.0)** répond à la première : avant, **tous les élèves passaient exactement le même examen** (mêmes questions, même ordre, mêmes chiffres) — une photo d'écran suffisait à réussir ; l'audit l'a mesuré (aucun appel à `shuffle`/`array_rand`/`random_int` dans le plugin). Le moteur tire désormais la copie dans le **réservoir du niveau** (la section entière), **mélange les propositions**, **fait varier les chiffres** — et mémorise la copie : recharger ne change rien, recommencer donne une autre copie. **Le point délicat, traité sans détour** : la variation « sûre » des chiffres ne*suffit pas* sur le contenu existant — sur 392 questions, **12 seulement** contiennent un nombre de 2-3 chiffres et **aucune n'est éligible**, parce que les chiffres du contenu sont des **faits** (le port 22, le code HTTP 404, SHA-256) : les changer rendrait la question fausse. D'où le mécanisme **paramétrique** : une question s'écrit « un buffer de `{taille}` octets », et le moteur y injecte les valeurs d'une variante tirée au sort — **l'explication utilise le même `{taille}`**, donc elle reste vraie. Cinq questions des rooms universitaires sont déjà écrites ainsi ; le format est documenté pour la suite de la rédaction. **Le panel des dix élèves (17ᵉ auditeur)** répond à la seconde : dix profils distincts (15 à 45 ans, français, arabe, anglais, spécialités cyber différentes, téléphone ou ordinateur) **jouent la plateforme en HTTP réel** — création de compte, connexion avec cookie, ouverture du parcours, leçon, réponses envoyées au serveur. **Verdict mesuré :** 10/10 créent un compte en une étape et commencent le parcours ; **10/10 reçoivent des points** (0 → 213 XP), **10/10 obtiennent une médaille** (or, 100 %) et **10/10 changent de niveau** (Observateur → Apprenti) ; **10/10 passent une copie différente** de l'examen. **Test négatif** : en rétablissant l'ancien comportement (tirage désactivé), le panel tombe à **1 copie pour 10 élèves** et le signale en **[MAJEUR]** — il détecte donc bien ce qu'il prétend détecter. **Un piège de mesure, trouvé et compris** : le process WP-CLI lisait un cache de méta-données périmé (les XP étaient écrits par le serveur web, dans un autre process) et concluait à tort « 0 point » ; la lecture relit désormais la base. **Résultat : 222 contrôles, 0 bloquant, 0 majeur**, 316 tests au vert. **Le reste — et c'est un chantier de contenu, pas de code :** le réservoir d'un examen est aujourd'hui de **11 à 34 questions** (médiane 26) ; l'objectif du propriétaire est d'environ **200 questions par niveau**. C'est un travail de rédaction (environ 20 sections × 200), pas un défaut du moteur : l'auditeur le mesure et le dit plutôt que de le cacher. |
| 01/11/2026 (nuit, suite) | **La recette tient en CI (v0.7.0)** | **Un test qui échoue à cause du test, pas du site : c'est le pire piège, et la CI l'a posé.** Les contrôles « robots.txt nomme les robots d'IA » et « llms.txt cite les rooms » passaient en local et échouaient en CI. La cause a été isolée proprement (un conteneur PHP 8.3 reproduit l'échec, un conteneur PHP 8.4 le fait disparaître) : **le serveur de développement intégré de PHP répond 404 pour une adresse qui porte une extension** (`/robots.txt`, `/llms.txt`) quand le fichier n'existe pas sur le disque — avec PHP 8.3, la requête **n'atteignait jamais WordPress**. Un vrai hébergeur (Apache, LiteSpeed) renvoie ces adresses vers WordPress grâce au `.htaccess` : le site était donc **correct**, c'est l'outillage de test qui mentait. **Correction :** les deux workflows qui démarrent le site passent désormais par `scripts/audit/router.php` — exactement ce que faisait déjà le workflow d'audit, qui était vert depuis le début. **Au passage :** la recette suit maintenant la redirection du site au lieu de s'y perdre (elle accusait un 301 de « robots absents »), et **elle montre le contenu réellement reçu** quand un contrôle échoue — on ne devine plus, on lit la preuve. Résultat : **5 workflows verts, 34 contrôles de recette réussis, 118 contrôles d'audit, 0 constat**, 52 rooms sur 52 liées. |
| 01/11/2026 (nuit) | **Robots d'IA et maillage interne (v0.7.0)** | **Deux demandes, et une réponse franche.** « Le fichier robots doit accepter tous les LLM — Claude, OpenAI, bref tout le monde — pour être lisible et cité » : c'est fait, et le `robots.txt` ne se contente plus d'un `User-agent: *` muet — il **nomme** 20 robots, en deux sections qui disent la vérité : les robots de **recherche et de citation** (Googlebot, OAI-SearchBot, ChatGPT-User, Claude-SearchBot, Claude-User, PerplexityBot…), et les robots d'**entraînement** (GPTBot, ClaudeBot, Google-Extended, Applebot-Extended, CCBot…). Google le rappelle dans son guide : `Google-Extended` **ne** contrôle pas les AI Overviews — c'est `Googlebot` qui le fait. Autoriser `Google-Extended` ne garantit donc pas la citation : le maillage, le contenu et les données structurées, si. « Es-tu sûr que le site est conforme à 100 % au guide SEO de Google ? » : la réponse est **non, et voici pourquoi** — l'audit refait à la main a trouvé **dix écarts réels** que l'audit automatique ne voyait pas. **Le pire :** les 52 rooms n'étaient atteignables **que par le plan du site** (l'accueil affichait « Bonjour tout le monde ! », le texte de démonstration de WordPress ; la page d'un parcours affichait « Lire la suite » et zéro lien) — alors que le guide demande précisément que le contenu soit « facilement trouvable par liens internes ». **Les autres :** `/parcours/` en 404 alors que le menu du thème la visait ; les titres des pages **arabes** restés en français (donc, pour Google, des doublons) ; **37 chaînes de traduction dégradées** et 2 extraits français corrompus (« il travaille dans une dozen de cases àDisposed très vite ») ; l'archive `/author/admin/` ouverte, qui exposait le nom du compte d'administration ; aucune image de partage ; pas de gabarit 404. **Tout est corrigé :** 72 corrections de traduction par un script qui refuse de modifier un fichier sans ancre exacte, la page d'accueil créée automatiquement, l'archive d'auteur fermée, un visuel de partage livré, `llms.txt` **généré** (donc jamais faux). **La barrière :** l'auditeur SEO passe de 35 à **45 contrôles** (10 nouveaux : robots d'IA nommés et autorisés, maillage mesuré, cohérence des traductions, archive fermée, image de partage) ; un script séparé vérifie le maillage **comme un robot** et mesure **52 rooms sur 52** liées depuis un parcours ; le comité d'audit passe de **108 à 118 contrôles, 0 constat**. **La réponse à « 100 % » :** conforme sur tout ce qui se vérifie sur une machine, **pas** de garantie sur ce qui dépend de Google (indexation réelle, présence dans un AI Overview, Core Web Vitals, citations effectives) — cela se mesure après la mise en ligne, dans la Search Console. Compte rendu : `docs/SEO-GENERATION-AI.md`. |
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
