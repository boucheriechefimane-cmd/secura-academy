# Backlog produit — Secura Academy

Priorités issues de l'analyse UX/UI TryHackMe (`docs/ANALYSE-UX-TRYHACKME.md`)
et du plan de contenu MIT (`docs/CONTENU-MIT.md`).

**Règle de cadrage :** les chantiers P0 forment un **bloc indivisible**. Le modèle
de données conditionne l'UI, l'UI reflète le modèle. Les livrer par moitié
produit un état incohérent.

> **État au 31/10/2026 : le P0 pédagogique (0.1 → 0.6) est livré et testé
> (147 assertions dans `tests/smoke-test.php`), avec la validation croisée
> QCM + test pratique.** Le P0 conformité (0.7) reste ouvert : c'est un
> chantier de production, pas de moteur.

---

## P0 — Socle pédagogique (bloquant pour « digne de TryHackMe ») — **livré**

### 0.1 · Modèle de tâches à 4 types — [x]
- [x] Méta `_secura_tasks` : `lesson` → `practice` → `test` → `exam`.
- [x] Méta box d'édition : répétition de tâches (type, contenu, durée, seuil, terminal JSON).
- [x] Endpoint `secura_get_task` (jamais les réponses).
- [x] Navigation par tâche + progression par tâche.
- [x] Les 6 rooms existantes ont été réécrites sur le nouveau modèle (contenu
      livré dans `includes/default-content.php`).
- [x] Spec : `docs/MODELE-XP-MEDAILES.md` § 6.

### 0.2 · Barème de points unifié — [x]
- [x] Gains centralisés dans `Secura_Progress::award()`.
- [x] Multiplicateur de difficulté (10 / 15 / 20 / 30).
- [x] Multiplicateur de type (0 / 0,5 / 1,0 / 1,5).
- [x] Malus d'indice (−50 %) + traçage des indices ouverts.
- [x] Bonus de complétion + bonus « sans indice » (×1,25).
- [x] First blood : table `secura_answer_stats`, **désactivé par défaut**.

### 0.3 · Médailles — [x]
- [x] Critères bronze / argent / or par room (score + indices).
- [x] Médailles d'examen (seuil, seuil+10, seuil+20).
- [x] Médailles de parcours (or si toutes les rooms sont en or, sinon argent).
- [x] La médaille **monte** et ne descend jamais.
- [x] Affichage sur le tableau de bord et la page de profil.

### 0.4 · Examens chronométrés — [x]
- [x] `time_limit` + `pass_score` par tâche.
- [x] Chronométrage **validé côté serveur** (`started_at`).
- [x] Aucun indice en mode examen.
- [x] XP versé uniquement à la première réussite (indicateur `awarded`).
- [x] Écran de résultat : score, seuil, médaille, points ; nouvelle tentative
      possible en conservant le meilleur score et le bonus déjà versé.

### 0.5 · Parcours et sections — [x]
- [x] CPT `secura_path` : sections ordonnées, rooms, durée, difficulté, bonus.
- [x] Méta box de structure (sections, rooms, durée, certificat).
- [x] Page de parcours : modules, rooms, durée, progression, bonus.
- [x] Shortcode `[secura_academy]` avec le tableau de bord complet.
- [x] Certificat de parcours nominatif, imprimable (CSS d'impression isolé).

### 0.6 · Anatomie de room conforme — [x]
- [x] En-tête sticky : titre, progression, minuteur d'examen.
- [x] Navigation par tâche, pastilles de verrouillage et d'état.
- [x] Bloc de questions numérotées, une entrée par question.
- [x] Retour ✓ / ✗ + points + explication après réussite.
- [x] `aria-live` sur les retours, récapitulatif « voir mes erreurs » en fin de tâche.
- [x] Terminal simulé intégré aux tâches de type `test`.
- [x] Level-up, confettis et notifications.

### 0.6 bis · Validation croisée QCM + test pratique — [x]
- [x] Champ **format** par tâche : `lecon`, `qcm`, `pratique`, `mixte`.
- [x] Badge de format dans la navigation et dans l'en-tête de tâche.
- [x] `pass_score` **effectif** : une tâche à 60 % est réussie à 60 % (sans
      seuil, la barre reste à 100 %).
- [x] Tâche pratique sans questions validée par son scénario de terminal
      (`Secura_Progress::mark_terminal_done()`).
- [x] Terminal jouable dans **chacune** des 6 rooms livrées.
- [x] `Secura_Progress::claim_question()` : réservation atomique d'une question
      avant le versement des XP (plus de double crédit en concurrence).
- [x] Examen raté → reprise automatique ; examen réussi → reprise **sur demande
      explicite** (`force=1`) pour éviter le farm de points.
- [x] Limitation de débit : 40 validations/minute/utilisateur (`slow_down`).
- [x] Schéma de progression versionné (`__schema`) + migration automatique.
- [x] Messages serveur passés dans le dictionnaire FR/AR/EN.
- [x] Terminal traduisible par tâche (champ JSON dans la méta-box Traductions).

### 0.7 · Conformité et production (reste ouvert)
- [ ] Confirmation d'inscription par e-mail.
- [ ] Mot de passe oublié personnalisé.
- [ ] Anti-spam + limitation des tentatives sur inscription et connexion
      (l'API de validation est déjà limitée à 40 requêtes/minute/utilisateur).
- [ ] Export et effacement des données (progression, XP, médailles).
- [ ] Politique de confidentialité.

### 0.8 · Multilingue (extension livrée avec le P0)
- [x] Dictionnaire d'interface complet FR / AR / EN.
- [x] Traduction du contenu (titres, corps, énoncés, indices, explications).
- [x] RTL natif : `dir="rtl"`, propriétés CSS logiques, `style-rtl.css` du thème.
- [x] Changement de langue mémorisé dans le compte, sans plugin tiers.
- [ ] Traduction de l'interface en `.po/.mo` (WordPress.org) — à faire au passage
      sur le dépôt public.

---

## P1 — Produit et engagement

| # | Chantier | Description |
|---|---|---|
| 1.1 | **Catalogue** | Grille de cards (livrée), recherche, filtres (difficulté, durée, type, parcours), tri, pagination |
| 1.2 | **Page de profil** | Niveau + XP, mur de médailles, streak (**livrés**) ; historique des rooms, réinitialisation de mot de passe |
| 1.3 | **Feedback pédagogique** | Explication affichée après chaque réponse (**livré**) ; enrichir le contenu d'explications plus guidantes |
| 1.4 | **Streak** | Jours consécutifs calculés sur les dates de complétion (**livré**) |
| 1.5 | **Classement** | Mensuel (remise à zéro le 1ᵉʳ du mois) + all-time, pseudonyme obligatoire |
| 1.6 | **Certificat** | Certificat nominatif imprimable (**livré**) ; export PDF à produire |
| 1.7 | **États vides** | Aucun parcours / aucune room / profil vierge (partiellement couvert) |
| 1.8 | **Reprise de session** | « Reprendre » en tête du tableau de bord (**livré**) |
| 1.9 | **URL propres** | Page `/rooms/<slug>` accessible et partageable (**livré** via le CPT) |

---

## P2 — Contenu et différenciation

| # | Chantier | Description |
|---|---|---|
| 2.1 | **Rédaction du contenu** | ≈ 46 rooms pour couvrir les 2 parcours (≈ 178 h). Priorité : parcours 1, par vagues de 7-8 rooms |
| 2.2 | **Room témoin** | 6 rooms complètes livrées (leçon + entraînement + test + examen + terminal) servent de référence de rédaction |
| 2.3 | **Vrais labs** | Conteneur Docker éphémère, isolation réseau, quotas, nettoyage automatique |
| 2.4 | **Terminal honnête** | Badge « simulé » affiché dans le terminal (**livré**) |
| 2.8 | **Types de question** | **Livré en v0.5.0** : réponse libre, choix multiple (vrai QCM), question « sans réponse » validée par l'état réel du terminal |
| 2.5 | **Diagnostic** | Identifier les rooms ratées → recommander un parcours de remédiation |
| 2.6 | **Communauté** | Questions/réponses + signalement (modération) ; **pas de writeups** (interdits par pwn.college, et remplacés par nos indices + explications d'erreur) |
| 2.7 | **i18n** | AR / EN / FR livrés ; ouvrir à d'autres langues via le dictionnaire + les méta de traduction |

---

## Qualité continue

- [ ] `phpcs` WordPress Coding Standards dans la CI.
- [x] Suite de tests sans WordPress complet : `tests/smoke-test.php` (189 assertions).
- [ ] Suite PHPUnit avec WordPress complet.
- [ ] Tests end-to-end du parcours inscription → validation → médaille.
- [ ] Audit de contraste sur **chaque** paire de la palette personnalisable.
- [ ] Revue de sécurité formalisée avant production.
- [ ] Environnement de staging avec pipeline dédié.
