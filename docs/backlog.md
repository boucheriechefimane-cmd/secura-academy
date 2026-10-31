# Backlog produit — Secura Academy

Priorités issues de l'audit UX/UI (`AUDIT-UX.md`) et des limites du MVP
(`README.md` → *Limites connues*). Les trois premiers blocs sont bloquants pour
une ouverture publique.

## P0 — Bloquant avant ouverture publique

### 1. Flux d'inscription durci
- [ ] Confirmation d'inscription par e-mail (plugin SMTP ou service transactionnel).
- [ ] Mot de passe oublié personnalisé (jeton à usage unique, expiration).
- [ ] Anti-spam sur l'inscription et sur les endpoints AJAX.
- [ ] Limitation des tentatives de validation (rate limiting par IP et par compte).
- [ ] Politique de confidentialité et page « données personnelles ».

### 2. Données personnelles (RGPD)
- [ ] Export des données apprenant (progression, XP, trophées) en JSON.
- [ ] Effacement complet des `user_meta` à la suppression du compte.
- [ ] Documenter la durée de conservation.

### 3. Tests et staging
- [ ] PHPUnit pour la logique serveur (`Secura_Progress`, `Secura_Ajax`).
- [ ] Tests end-to-end du parcours (inscription → validation → trophée).
- [ ] Environnement de staging séparé, avec pipeline de déploiement dédié.
- [ ] Revue de sécurité (audit externe ou revue interne formalisée).
- [ ] Test accessibilité : clavier, lecteur d'écran, zoom 200 %, petit écran.

## P1 — Expérience apprenant

### 4. Page de profil
- [ ] Historique des réponses validées et des rooms terminées.
- [ ] Collection de trophées détaillée (date d'obtention).
- [ ] Choix d'un pseudonyme public (pour la préparation du classement).

### 5. Catalogue
- [ ] Recherche par mot-clé.
- [ ] Filtres : difficulté, durée, thème.
- [ ] Compteur de rooms par niveau.
- [ ] Vue « room » accessible en URL propre (et non uniquement en panneau).

### 6. Gamification
- [ ] Badges configurables (poids, seuils, icônes).
- [ ] Streak fiable (based on dates de complétion réellement enregistrées).
- [ ] Classement (attention au RGPD : pseudonyme obligatoire).
- [ ] Notifications de nouvelle room disponible.

## P2 — Contenu et technique

### 7. Vrais labs
- [ ] Container Docker à la demande (uploading de fichiers ou posture "faire confiance à un exécutable", **jamais** de shell libre exposé).
- [ ] Terminal WebSocket isolé et éphémère.
- [ ] Quotas et nettoyage automatique des environnements.
- [ ] Honnêteté dans l'UI : distinguer explicitement simulation et machine réelle.

### 8. Édition du contenu
- [ ] Champs spécifiques de room (au lieu des métadonnées techniques).
- [ ] Import / export de rooms au format JSON.
- [ ] Révision et validation éditoriale avant publication.

### 9. Qualité du code
- [ ] `phpcs` WordPress Coding Standards dans la CI.
- [ ] Couverture de code sur `Secura_Progress` et `Secura_Ajax`.
- [ ] Documentation des endpoints (générée à partir du code).

## Hors périmètre pour l'instant
- Application native mobile.
- Contenu vidéo.
- Certification ou attestation de niveau.
- Monétisation.
