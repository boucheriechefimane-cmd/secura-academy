# Multilingue et internationalisation

- **Date** : 04/11/2026 23:12 UTC
- **Auditeur** : multilingue
- **Contrôles réussis** : 6
- **Constats** : 1 bloquant(s), 1 majeur(s), 0 mineur(s), 2 info(s)

## Constats

### Bloquant (1)

- **toutes les feuilles de style de la page se chargent (HTTP 200)** — 2 feuille(s) de style en erreur : ar : http://localhost:8080/wp/wp-content/plugins/secura-academy/assets/academy.css?ver=0.12.7 (HTTP 404) | en : http://localhost:8080/wp/wp-content/plugins/secura-academy/assets/academy.css?ver=0.12.7 (HTTP 404)

### Majeur (1)

- **la balise <html> porte le sens de lecture de la langue demandée** — page légale fr : <html> sans dir="ltr" → <html lang="fr"> (le texte arabe s'afficherait de gauche à droite) | page légale ar : <html> sans dir="rtl" → <html lang="ar"> (le texte arabe s'afficherait de gauche à droite) | page légale en : <html> sans dir="ltr" → <html lang="en"> (le texte arabe s'afficherait de gauche à droite)

### Info (2)

- **Ce qui a été vérifié** — 161 pages réellement servies et lues : la page d'accueil, les pages légales (version affichée et version publiée par l'API REST), et 156 pages de room servies dans les trois langues (français, arabe, anglais).
- **La qualité d'une traduction ne se mesure pas par un script** — Cet audit vérifie la COUVERTURE et la COHÉRENCE : que chaque champ soit traduit, qu'aucune chaîne ne soit restée en français, que le sens de lecture soit complet. Il ne juge pas si la traduction est naturelle, exacte ou idiomatique : c'est le travail d'un traducteur, et cela demande un humain.

## Verdict

**Non conforme.** 1 constat(s) bloquant(s) : correction exigée avant mise en ligne.
