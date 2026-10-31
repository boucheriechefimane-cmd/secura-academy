# Audit UX/UI — Secura Academy / référence TryHackMe

**Date :** 31 octobre 2026  
**Périmètre :** audit heuristique de la page publique TryHackMe (sans compte utilisateur, donc sans accès à son dashboard privé) et revue du MVP WordPress livré. Il ne s’agit pas d’un audit interne de TryHackMe ni d’un test utilisateur.

## Référence produit observée
La page publique actuelle de TryHackMe met immédiatement en avant une proposition de valeur claire (« Anyone can learn cyber security »), des parcours triés par niveau et par profil, des CTA d’inscription, des exercices guidés et une pratique accessible depuis le navigateur. Elle réduit ainsi la question « par où commencer ? » grâce à une orientation par niveau/objectif et une unité pédagogique identifiable (room). La page publique ne permet pas d’inspecter les interactions d’un compte connecté, la progression privée, les états de complétion ni le dashboard authentifié.

## Revue senior — MVP initial

### Points solides
- L’apprentissage est découpé en rooms courtes et le vocabulaire reste accessible.
- Le modèle mental parcours → étapes → récompenses convient à la cible débutante.
- Le contraste sombre avec accent menthe donne un langage visuel cohérent avec l’univers sécurité.
- L’intégration en shortcode évite de verrouiller le contenu à un seul template WordPress.

### Risques / défauts à corriger avant mise en ligne
1. **Réponses exposées dans le HTML** : la valeur attendue était incluse dans `data-answer`. Le contrôle serveur était en place, mais le secret était tout de même visible dans le DOM. Correctif : retirer cette donnée du balisage, ne garder que la validation serveur.
2. **Promesse de trophées incomplète** : le backend stockait les trophées, mais l’interface ne montrait pas la collection. À traiter avant de présenter la fonctionnalité comme terminée.
3. **Progression initiale démonstrative** : les chiffres fixes du prototype précédent ne doivent pas être affichés comme s’ils provenaient réellement du compte.
4. **Pas de découverte de contenu** : un parcours unique convient au MVP, mais la navigation devra évoluer vers recherche, catégories, difficulté et durée lorsque le catalogue grandira.
5. **Édition admin peu conviviale** : métadonnées techniques pour question/réponse/XP ; prévoir une interface de champs dédiée et des validations éditoriales.
6. **WordPress n’est pas prêt à être ouvert sans durcissement** : inscription, confirmation email, anti-spam, limitation de tentatives, sauvegardes, politique de confidentialité, export/effacement et tests de permissions restent à prévoir.
7. **Aucun vrai lab** : le terminal est une simulation narrative et ne lance pas d’environnement. Il faut le nommer honnêtement et ne pas faire croire qu’une VM s’exécute.
8. **Accessibilité et UX responsive** : tester clavier, focus, lecteur d’écran, zoom, petit écran et erreurs de validation ; les interactions doivent rester utilisables hors souris.

## Décisions de refonte prises
- Hiérarchie plus nette : navigation, salutation/action suivante, barre de progression, puis parcours séquentiel.
- Cards de room avec état (terminée, en cours, verrouillée), durée, difficulté et récompense ; la prochaine action est visuellement dominante.
- Palette exprimée en variables CSS et couleurs éditables via Apparence → Personnaliser, sans imposer le vert.
- Typographie système lisible, espacements plus généreux, états de focus visibles et prise en compte de `prefers-reduced-motion`.
- Direction visuelle originale : s’inspirer des principes d’apprentissage guidé et de gamification, sans reprendre logos, textes, illustrations ou composants propriétaires TryHackMe.

## Limites de ce livrable
Cette passe améliore la fondation visuelle et retire la fuite des réponses côté navigateur. Elle ne constitue pas un pentest, un audit de sécurité complet, une validation d’accessibilité certifiée ni une reproduction du dashboard privé TryHackMe. La plateforme doit être testée en staging avant production.
