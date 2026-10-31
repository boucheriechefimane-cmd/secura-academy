# Backlog produit — Secura Academy

Priorités issues de l'analyse UX/UI TryHackMe (`docs/ANALYSE-UX-TRYHACKME.md`)
et du plan de contenu MIT (`docs/CONTENU-MIT.md`).

**Règle de cadrage :** les chantiers P0 forme un **bloc indivisible**. Le modèle
de données conditionne l'UI, l'UI reflète le modèle. Les livrer par moitié
produit un état incohérent.

---

## P0 — Socle pédagogique (bloquant pour « digne de TryHackMe »)

### 0.1 · Modèle de tâches à 4 types
- [ ] Introduire `_secura_tasks` : `lesson` → `practice` → `test` → `exam`.
- [ ] Meta box d'édition : répétition de tâches (type, contenu, durée, seuil).
- [ ] Migration des 6 rooms existantes (script `wp seca migrate rooms`).
- [ ] Endpoint `secura_get_task` (jamais les réponses).
- [ ] Navigation par tâche + progression par tâche.
- [ ] Spec : `docs/MODELE-XP-MEDAILES.md` § 6.

### 0.2 · Barème de points unifié
- [ ] Centraliser les gains dans `Secura_Progress::award()`.
- [ ] Multiplicateur de difficulté (10 / 15 / 20 / 30).
- [ ] Multiplicateur de type (0 / 0,5 / 1,0 / 1,5).
- [ ] Malus d'indice (−50 %) + traçage des indices ouverts.
- [ ] Bonus de complétion + bonus « sans indice » (×1,25).
- [ ] First blood : table `secura_answer_stats`, **désactivé par défaut** (v1).

### 0.3 · Médailles
- [ ] Critères bronze / argent / or par room (score + indices).
- [ ] Médailles d'examen (seuil, seuil+10, seuil+20).
- [ ] Médailles de parcours (argent, or, distinctive).
- [ ] La médaille **monte** et ne descend jamais.
- [ ] Affichage sur le tableau de bord et la page de profil.

### 0.4 · Examens chronométrés
- [ ] `time_limit` + `pass_score` par tâche.
- [ ] Chronométrage **validé côté serveur** (`started_at`).
- [ ] Aucun indice en mode examen.
- [ ] XP versé uniquement à la première réussite.
- [ ] Écran de résultat : score, seuil, temps, points, médaille, « voir mes erreurs ».

### 0.5 · Parcours et sections
- [ ] CPT `secura_path` : sections ordonnées, rooms, durée, difficulté.
- [ ] Page de parcours : en-tête (modules, labs, durée), progression, certificat.
- [ ] Shortcode `[secura_academy path="…"]`.

### 0.6 · Anatomie de room conforme
- [ ] En-tête sticky : titre, progression, XP, CTA.
- [ ] Navigation par tâche (desktop) / steps horizontaux (mobile).
- [ ] Bloc « Answer the questions below » numéroté.
- [ ] Retour ✓ / ✗ + points + explication.
- [ ] Piège de focus complet + `aria-live` sur les retours.

### 0.7 · Sécurité (bloquant pour ouverture publique)
- [ ] Confirmation d'inscription par e-mail.
- [ ] Mot de passe oublié personnalisé.
- [ ] Anti-spam + limitation des tentatives (rate limiting).
- [ ] Export et effacement des données (progression, XP, médailles).
- [ ] Politique de confidentialité.

---

## P1 — Produit et engagement

| # | Chantier | Description |
|---|---|---|
| 1.1 | **Catalogue** | Grille de cards, recherche, filtres (difficulté, durée, type, parcours), tri, pagination |
| 1.2 | **Page de profil** | Niveau + XP, mur de médailles, historique des rooms, streak, réinitialisation de mot de passe |
| 1.3 | **Feedback pédagogique** | Explication affichée après chaque réponse, notamment en cas d'erreur |
| 1.4 | **Streak** | Jours consécutifs calculés sur les dates de complétion réelles |
| 1.5 | **Classement** | Mensuel (remise à zéro le 1ᵉʳ du mois) + all-time, pseudonyme obligatoire |
| 1.6 | **Certificat** | Certificat de complétion de parcours (HTML imprimable → PDF) |
| 1.7 | **États vides** | Aucun parcours / aucune room / profil vierge |
| 1.8 | **Reprise de session** | « Reprendre où vous en étiez » en tête du tableau de bord |
| 1.9 | **URL propres** | Page `/rooms/<slug>` accessible et partageable |

---

## P2 — Contenu et différenciation

| # | Chantier | Description |
|---|---|---|
| 2.1 | **Rédaction du contenu** | ≈ 46 rooms pour couvrir les 2 parcours (≈ 178 h). Priorité : parcours 1, par vagues de 7-8 rooms |
| 2.2 | **Room témoin** | Une room complète (leçon + entraînement + test + examen) sert de référence de rédaction et de test de bout en bout |
| 2.3 | **Vrais labs** | Conteneur Docker éphémère, isolation réseau, quotas, nettoyage automatique |
| 2.4 | **Terminal honnête** | Tant que P2.3 n'est pas livré : badge « Exercice guidé — pas de machine active » visible dans l'UI |
| 2.5 | **Diagnostic** | Identifier les rooms ratées → recommander un parcours de remédiation |
| 2.6 | **Communauté** | WRITE-ups, questions/réponses, signalement de contenu (modération) |
| 2.7 | **i18n** | Contenu français, `text domain` déjà en place ; prévoir l'anglais |

---

## Qualité continue

- [ ] `phpcs` WordPress Coding Standards dans la CI.
- [ ] Suite PHPUnit avec WordPress complet (complète `tests/smoke-test.php`).
- [ ] Tests end-to-end du parcours inscription → validation → médaille.
- [ ] Audit de contraste sur **chaque** paire de la palette personnalisable.
- [ ] Revue de sécurité formalisée avant production.
- [ ] Environnement de staging avec pipeline dédié.
