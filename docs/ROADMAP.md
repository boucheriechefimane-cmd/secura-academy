# Roadmap produit — Secura Academy

**Document de référence unique.** Il est relu **au début de chaque session de
travail** (rituel « revue de route ») et **à chaque commit**. Toute nouvelle
idée doit être classée ici avant d'être codée ; tout code livré doit être
rattaché à une milestone.

> **Rituel de revue (5 minutes, en tête de session) :**
> 1. Lire le tableau des milestones et leurs statuts.
> 2. Vérifier que la milestone « en cours » est bien celle qui doit avancer
>    (ordre du chemin critique ci-dessous).
> 3. Relire les **décisions structurantes** : elles ne se remettent pas en
>    cause sans nouvelle décision explicite de l'utilisateur.
> 4. Cocher ce qui a été fait, déplacer le « en cours », dater la revue.
> 5. Si une idée nouvelle n'est pas dans la roadmap : l'ajouter, ou l'écrire
>    dans « Idées à classer ».

**Dernière revue :** 31 octobre 2026 — v0.4.0 livré + **audit apprenant/THM**
fait. M1 presque bouclée, M2 amorcée, M2 bis et M7 ajoutés au backlog.

---

## 1. Le problème, en une phrase

TryHackMe n'est pas une plateforme de QCM bien designée : c'est une plateforme
où l'apprenant **manipule une vraie machine**. Tout l'écart se réduit là.

**Ce que Secura Academy est aujourd'hui :** une plateforme d'apprentissage
ludifiée et multilingue avec un moteur de jeu complet (tâches à 4 types,
verrouillage, barème, médailles, examens, parcours, certificats) mais **un
terminal scripté** et **6 rooms**.

**Ce que Secura Academy doit devenir :** une plateforme gratuite, multilingue,
où un ado peut déployer une vraie machine vulnérable, la compromettre, et
recevoir un certificat — sans payer et sans compte adulte.

---

## 2. Les lacunes à résoudre (source : revue « dev senior »)

Chaque lacune est un **trou** de la roadmap. Aucune ne peut rester ouverte.

| # | Lacune | Impact | Milestone |
|---|---|---|---|
| L1 | Terminal scripté, aucune vraie machine | 🔴 Structurel | **M1** |
| L2 | 6 rooms ≈ 8 h de contenu | 🔴 Rétention | **M3** |
| L3 | Une seule machine, un seul shell, pas de chaîne d'attaque | 🟠 Pédagogie | **M2** |
| L4 | L'examen = QCM chronométré (quiz, pas compétence) | 🟠 Validité | **M3** |
| L5 | Onboarding cassé (pas de confirmation e-mail, pas de mot de passe oublié) | 🔴 Bloqueur public | **M4** |
| L6 | Zéro e2e, zéro audit accessibilité, pas de staging | 🟠 Qualité | **M5** |
| L7 | Écart visuel : pas d'illustration, pas de mur de succès, pas d'anneau de niveau | 🟡 | **M6** |
| L8 | Écart UX : pas de deux volets, pas d'historique clavier | 🟡 | **M2** |
| L9 | Écart pédagogique : on lit avant de faire | 🟠 | **M2** + **M3** |
| L10 | Contenu : le plan partait de 178 h d'écriture originale | 🟠 | **M3** (licence corrigée : réutilisation gratuite autorisée) |

---

## 3. Les 4 axes face à TryHackMe

| Axe | Verdict | Écart à fermer | Milestones |
|---|---|---|---|
| Contenu | 🔴 Le plus loin | Quantité + graphe de prérequis + récap de section | M3 |
| Facilité d'apprendre/pratiquer | 🟠 | Faire d'abord, lire après | M2, M3 |
| UX | 🟡 | Deux volets, historique clavier, déploiement de machine | M2 |
| Visuel | 🟡 | Direction artistique, illustrations, mur de succès | M6 |

---

## 4. Chemin critique

```
M1 (lab réel)  ──┬──► M2 (UX deux volets + clavier + chaînes d'attaque)
                 └──► M3 (contenu : 10 rooms, prérequis, récap, examen-practical)
M4 (comptes)  ─────────────────────────────────► M5 (qualité : e2e, a11y, staging)
M3 ─────────────────────────────────────────────► M6 (visuel + social + PDF)
M2 bis ───────────────────────────────► M3 (les rooms de lab profitent du « sans réponse »)
M1 ──► M7 (palier 3 : labs notés sur machines réelles)
```

**M1 conditionne M3** : on n'écrit pas 10 rooms de labs tant que le lab n'existe pas.
**M4 et M5 sont parallélisables** et ne dépendent de rien.

---

## 5. Les milestones

### M1 — Lab réel : une vraie machine déployable — 🔵 EN COURS

**Objectif :** un apprenant clique « Déployer la machine » et obtient un shell
réel sur une cible vulnérable isolée.

| Livrable | Critère d'acceptation | Statut |
|---|---|---|
| Moteur de lab à deux pilotes : `simulated` (actuel) et `docker` | Le mode simulé reste 100 % fonctionnel, aucun contenu perdu | ✅ fait |
| manifeste de lab par room (mémo `_secura_lab`) | image, service, shell, TTL, cible, politique de commandes | ✅ fait |
| `Secura_Lab::start()` / `exec()` / `stop()` | conteneur éphémère par apprenant et par room, TTL, arrêt auto | ✅ fait |
| Isolement dur (`--cap-drop=ALL`, `--network` dédié, `no-new-privileges`, limites CPU/mémoire/PIDs, pas de root) | revue de sécurité : aucune option privilégiée, pas de socket Docker monté | ✅ fait |
| Filtre de commandes + sortie tronquée + timeout | une commande hors politique est refusée, sortie ≤ 8 Ko, exec ≤ 10 s | ✅ fait |
| Repli automatique si Docker absent | `driver=auto` → simulation ; le site reste utilisable sur hébergement mutualisé | ✅ fait |
| Bouton « Déployer la machine » + statut du lab dans la room | état visible : en cours / prête / expirée / indisponible | ✅ fait |
| 3 labs réels : web vulnérable, binaire écrasable, réseau 2 nœuds | images + `docker-compose` fournis (`labs/`) | ✅ fait |
| Branchement room ↔ machine | chaque room de lab déclare son manifeste dans l'admin | ⏳ à faire (3 rooms) |
| Documentation d'exploitation (hébergement) | `docs/labs.md` : prérequis, réseau, ports, coûts | ✅ fait |
| Projet Compose unique par apprenant | deux élèves ne partagent jamais la même pile | ⏳ à faire (risque isolation) |

**Décision structurante :** le contrat AJAX `secura_terminal` **ne change pas**.
On branche un pilote, on ne réécrit pas le front.

---

### M2 — UX : deux volets, clavier, « faire d'abord » — ⬜ À VENIR

| Livrable | Critère d'acceptation | Statut |
|---|---|---|
| Lecteur en deux volets (consigne \| terminal) sur ≥ 1024 px, empilé sinon | terminal toujours visible sur desktop, sans scroll interminable | 🟡 fait (CSS + gabarit) |
| Historique du terminal navigable au clavier (↑ / ↓, tabulation, Ctrl+C) | ↑ rappelle la dernière commande, complétion sur Tab | 🟡 fait (récupération d'historique côté client) |
| Défilement automatique + copie d'une commande | double-clic sur une commande → presse-papier | ⬜ |
| « Faire d'abord » : la consigne devient un brief de 60 s, le terminal passe avant | la leçon ne bloque plus la manipulation | ⬜ |
| Chaînes d'attaque : 2 cibles liées dans une même room | la room 2 nœuds a une cible secondaire | ⬜ |

### M2 bis — Type de question « sans réponse » + walkthrough — ⬜ À VENIR

> Issu de l'[audit apprenant](AUDIT-EXPERIENCE-APPRENANT.md) : c'est la
> mécanique de THM la plus manquante chez nous, et la moins chère à ajouter.

| Livrable | Critère d'acceptation | Statut |
|---|---|---|
| Question « sans réponse » (validation par case à cocher) | une tâche de manipulation se valide par l'action, pas par une phrase à orthographier | ⬜ |
| Validation serveur de la case | impossible de cocher sans avoir joué (l'étape du terminal doit être atteinte) | ⬜ |
| Corrigé détaillé débloqué après réussite | l'apprenant bloqué a une porte de sortie, comme les walkthroughs THM | ⬜ |
| Récapitulatif d'erreurs déjà en place | à conserver et à étendre aux manipulations | ✅ fait |

---

### M3 — Contenu : 10 rooms réelles, graphe, récap, examen pratique — ⬜ À VENIR

| Livrable | Critère d'acceptation | Statut |
|---|---|---|
| 10 rooms (dont 3 labs M1) | chacune suit `leçon → entraînement → test pratique → examen` | ⬜ |
| Prérequis explicites entre rooms | l'UI affiche «requis : room X » et bloque si non validé | ⬜ |
| « Topic Recap » en fin de section | 5 questions de synthèse, hors XP, badge de section | ⬜ |
| Examen-practical : l'examen valide par **manipulation**, pas par QCM | une tâche `exam` peut exiger un flag à trouver (mode lab) | ⬜ |
| Réutilisation OCW autorisée (gratuit) : adaptation + attribution + ShareAlike | chaque room adaptee cite la source OCW et sa licence | ⬜ |
| Chaîne de production : gabarit + import/export CSV des traductions | une room FR + AR + EN se produit sans éditer le code | ⬜ |

---

### M4 — Comptes : onboarding non cassé — ⬜ À VENIR

| Livrable | Critère d'acceptation | Statut |
|---|---|---|
| Confirmation d'inscription par e-mail | jeton signé, expiration, renvoi | ⬜ |
| Mot de passe oublié | jeton à usage unique, expiration courte | ⬜ |
| Anti-spam | limite par IP + délai minimum + piège à robots | ⬜ |
| Consentement RGPD + export/suppression des données | export JSON + suppression complète du compte | ⬜ |
| Parcours mineur : pas de données de paiement, pas de publicité tierce | aucune donnée transmise à un tiers | ⬜ |

---

### M5 — Qualité : e2e, accessibilité, staging — ⬜ À VENIR

| Livrable | Critère d'acceptation | Statut |
|---|---|---|
| Tests Playwright : inscription → room → validation → certificat | scenario(s) au vert en CI | ⬜ |
| Audit clavier + lecteur d'écran + contraste | nav clavier complète, focus visible, aria-live | ⬜ |
| Environnement de staging reproductible | `docker compose` qui monte WP + plugin + thème + labs | ⬜ |
| Revue de sécurité avant ouverture | checklist OWASP preenchue, dependances à jour | ⬜ |

---

### M6 — Social & visuel : le facteur « jeu » — ⬜ À VENIR

| Livrable | Critère d'acceptation | Statut |
|---|---|---|
| Direction artistique : illustrations de room, icônes de tâche, anneau de niveau | 6 visuels d'ambiance, 4 icônes | ⬜ |
| Mur de succès / tableau de badges | page dediee, triee par date et par categorie | ⬜ |
| First blood activé par défaut (sur les rooms lab) | classement par question, visible | ⬜ |
| Séries (streak) et objectifs hebdomadaires | rappel discret, pas culpabilisant | ⬜ |
| Certificat PDF (et non plus seulement imprimable) | PDF généré, signature, vérification en ligne | ⬜ |
| Classement de parcours optionnel | opt-in explicite (verticalisation) | ⬜ |

---

### M7 — Palier 3 : parcours universitaire « format MIT » — ⬜ À VENIR

> Le seul niveau où l'on peut légitimement dire « cette formation suit le
> cours MIT » : on y fait les **labs**, les **quiz** et le **projet**, avec la
> même répartition de la note.

| Livrable | Critère d'acceptation | Statut |
|---|---|---|
| Parcours « Sécurité des systèmes » (format 6.858) | exposés + labs notés + projet final en groupe | ⬜ |
| Barème MIT (quiz 20 %, labs 35 %, projet 25 %, homework 20 %) | le barème est affiché tel quel à l'apprenant | ⬜ |
| Labs notés par scripts de vérification | note automatique, comme les scripts de grading MIT | ⬜ |
| Devoirs de lecture avec question personnelle | le « homework reading question » de 6.858 | ⬜ |
| Contenu adapté de l'OCW avec attribution + ShareAlike | chaque support cité, licence affichée | ⬜ |
| Cours de cryptographie avancée (palier 3 de 6.857) | ZK, signatures, secret sharing, sécurité du vote | ⬜ |

---

## 6. Décisions structurantes (ne pas les rouvrir implicitement)

| # | Décision | Pourquoi |
|---|---|---|
| D1 | Plateforme **gratuite**, multilingue (AR, FR, +), sur WordPress | demande initiale |
| D2 | Aucun copy de la marque TryHackMe : mécaniques reprises, textes et visuels originaux | cadre légal |
| D3 | Le **QCM reste** comme test de validation, **en plus** des tests pratiques à réussir | demande du 31/10/2026 |
| D4 | 12 niveaux aux noms originaux, first blood désactivé par défaut | expérience + prudence |
| D5 | Le **code** reste sous licence MIT | Attire les contributeurs |
| D6 | Le **contenu adapté de l'OCW** reste sous **CC BY-NC-SA 4.0** avec attribution explicite | clause ShareAlike ; le gratuit satisfait la clause NC |
| D7 | Pas de push en production sans accord explicite | sécurité |
| D8 | Une seule source de vérité : cette roadmap | éviter la dérive |

> **Conséquence de D6 (à garder en tête) :** le contenu OCW adapté est gratuit mais
> **non commercialisable** et **non revendable**. Toute évolution vers un modèle
> payant doit réécrire le contenu ou obtenir une autorisation écrite de l'OCW.
> Le code, lui, reste libre.

---

## 7. Idées à classer

- Mode « hors ligne » / impression des labs.
- App native (React Native) — trop lourd au regard de l'effort actuel.
- IA tuteur dans le terminal (aide contextuelle) — dépend de M1.
- Réseau social / clans de learners — hors périmètre tant que M6 n'est pas fait.
- Export du profil en badge Open Badge (pour LinkedIn).

---

## 8. Journal des revues

| Date | Version | Revue |
|---|---|---|
| 31/10/2026 | v0.2.0 | Revue « dev senior » : 10 lacunes listées. Décision : **les QCM restent**, ajout des tests pratiques obligatoires. |
| 31/10/2026 | v0.3.0 | **Validation croisée livrée** (format par tâche, seuil effectif, terminal dans chaque room, réservation atomique, reprise d'examen, rate limiting, schéma versionné). Licence OCW **corrigée** : la réutilisation gratuite est autorisée (NC satisfait), avec attribution + ShareAlike. **M1 démarrée.** |
| 31/10/2026 | audit | **Audit expérience apprenant + THM** (`docs/AUDIT-EXPERIENCE-APPRENANT.md`) : verdict senior, parcours 14 ans simulé, audit THM sur sources réelles (853 rooms, AttackBox, « no answer needed », onglets multi-machines), ce qu'on a de mieux (arabe RTL, gratuit, explication d'erreur systématique, seuil explicite) et ce qui manque. **Alignement MIT : non, et c'est normal** — 9/24 exposés 6.858, ~4/18 séances 6.857, public ≠ graduate. Ajout de **M2 bis** (question « sans réponse » + walkthrough) et **M7** (palier 3 universitaire). |
| 31/10/2026 | v0.4.0 | **M1 livrée côté moteur** : `Secura_Lab` (deux pilotes, isolement dur, TTL, politique de commandes, repli automatique), 3 endpoints lab, méta-box de lab, barre « Déployer la machine », 3 machines réelles fournies (`labs/`), documentation (`docs/labs.md`). **M2 amorcée** : lecteur en deux volets + historique clavier. 169 assertions. Reste : projet Compose unique par apprenant, branchement des rooms, réseau sans sortie. |
