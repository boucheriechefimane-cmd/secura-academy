# Passation de projet — Secura Academy (WordPress)

**Langue de travail :** français  
**Date de passation :** 31 octobre 2026  
**Contexte :** l’utilisateur souhaite poursuivre le projet dans une autre session Arena, qui pourrait disposer d’un connecteur GitHub autorisé. Ce document résume l’objectif, les décisions, le travail présent dans le workspace et les prochaines étapes.

## Objectif produit
Construire une plateforme d’apprentissage de la cybersécurité sous WordPress, avec une expérience pédagogique et visuelle de qualité, inspirée des principes UX de TryHackMe, sans copier sa marque, ses textes, ses illustrations ou ses composants propriétaires.

Les apprenants doivent pouvoir créer un compte, suivre des parcours découpés en rooms/étapes, répondre à des exercices, conserver leur progression sur leur compte et gagner des XP, médailles/trophées à chaque étape réussie. L’utilisateur souhaite versionner le projet sur GitHub et, si possible, faire évoluer les fichiers du dépôt vers WordPress via un processus de déploiement.

## Références MIT proposées
- **MIT OCW 6.858 — Computer Systems Security (Fall 2014)** : meilleur candidat pour un MVP orienté labs; sujets, entre autres, threat models, control hijacking, buffer overflow et défenses, sandboxing, web security, network protocols, HTTPS, authentification. Niveau avancé; prérequis universitaires en systèmes. https://ocw.mit.edu/courses/6-858-computer-systems-security-fall-2014/
- **MIT OCW 6.857 — Network and Computer Security (Spring 2014)** : option orientée réseaux et cryptographie (hashes, chiffrement, signatures, échange Diffie–Hellman, zero-knowledge). Niveau supérieur. https://ocw.mit.edu/courses/6-857-network-and-computer-security-spring-2014/
- Ne pas republier les ressources MIT sans vérifier licence, attribution et restrictions. Les rooms actuelles sont des exercices d’introduction originaux inspirés de thèmes généraux; elles ne sont pas un cours MIT officiel ni une adaptation autorisée de supports MIT.

## Audit de référence TryHackMe
La page publique TryHackMe a été consultée (pas de compte/dash privé). Les principes UX observés : proposition de valeur directe, apprentissage débutant accessible, parcours orientés vers des objectifs/niveaux, rooms guidées, exercice pratique et progression gamifiée.
Page examinée : https://tryhackme.com/
Il s’agit d’une revue heuristique limitée, pas d’un audit interne, d’un test utilisateur ou d’un audit de sécurité de TryHackMe.

## Travail déjà produit
Dans le workspace, le dossier `/home/user/secura-wp/` contient :
- `wp-content/plugins/secura-academy/secura-academy.php` — plugin WordPress « Secura Academy ».
- `wp-content/plugins/secura-academy/assets/academy.css` — style du tableau de bord / rooms.
- `wp-content/plugins/secura-academy/assets/academy.js` — validation AJAX et retour de complétion.
- `wp-content/themes/secura-learning/` — thème WordPress dédié avec `style.css`, `functions.php`, `header.php`, `footer.php`, `index.php`.
- `README.md` — mise en place, publication, limites et installation.
- `AUDIT-UX.md` — audit UX/UI heuristique, points d’attention et décisions visuelles.

Archives déjà générées dans `/home/user/` :
- `secura-academy-wordpress.zip` — kit complet (dossier secura-wp).
- `secura-academy-plugin.zip` — plugin seul.
- `secura-learning-theme.zip` — thème seul.

Prototype HTML initial : `/home/user/index.html` (maquette non branchée sur WordPress; la source de vérité du kit WP est ensuite `secura-wp`).

### Fonctions MVP du plugin
- Enregistrement du type de contenu « Rooms ».
- À l’activation, création de 6 rooms en français : penser comme un défenseur, fondamentaux du réseau, sécuriser une application web, mémoire/défenses, authentification, chiffrement/HTTPS.
- Shortcode `[secura_academy]` pour intégrer le parcours sur une page WordPress.
- Progression / XP / trophées stockés en user meta quand l’apprenant est authentifié.
- Vérification de réponse via endpoint AJAX avec nonce; gains attribués la première fois seulement dans le cas standard.
- Présentation des trophées et actualisation de la collection après réussite.
- **Réponses correctes non exposées dans le HTML** après correction faite pendant l’audit.
- Les « labs » sont uniquement des exercices textuels guidés avec terminal simulé : pas de VM ni de commande réellement exécutée.

### Thème et UX
- Design sombre et responsive, navigation, en-tête et footer.
- Tokens de couleurs configurables dans Apparence → Personnaliser → Palette Secura (accent et fond).
- Hiérarchie de tableau de bord, état de room, XP, section trophées, focus clavier visible, `prefers-reduced-motion`.
- Inspiration générale TryHackMe uniquement; identité Secura originale.

### Installation / branchement
1. Mettre les deux dossiers dans `wp-content/plugins/` et `wp-content/themes/`, ou téléverser les ZIP via l’admin WP.
2. Activer plugin et thème.
3. Créer une page WordPress avec `[secura_academy]`.
4. Pour inscription publique, activer « Tout le monde peut s’inscrire » dans Réglages → Général, rôle par défaut Abonné. Configurer HTTPS, antispam et vie privée avant ouverture.
5. Rooms éditables via le CPT; les métadonnées questions/réponses/XP sont encore techniques et nécessitent une UI d’admin conviviale (ou outil de champs).

## Limites et points de revue obligatoires
Le livrable est un **starter MVP**, pas un produit prêt pour production.
- Pas encore d’authentification par email vérifié, mot de passe oublié personnalisé, anti-spam, limitation des essais/rate limiting ni tests end-to-end.
- Pas encore de vrais labs/container sandbox; ne pas présenter la simulation terminal comme une machine active.
- Pas de page complète de compte/profil, streak fiable, leaderboard, catalogue avec filtres/recherche ni badges configurables.
- L’édition en admin des questions et réponses doit être ergonomique. Important de ne jamais renvoyer les réponses exactes au client.
- Vérifier courses accessibles, permissions, multisite si nécessaire, et flux AJAX; faire revue PHP et tests avec une version WordPress/PHP cible. PHP n’était pas installé dans la sandbox, donc `php -l` n’a pas pu être exécuté.
- Mettre au point confidentialité : export/suppression des données (progression/trophées), durée de conservation et politique de confidentialité.
- Corriger les éventuels soucis d’échappement/compatibilité dans le code PHP, puis faire staging, sauvegarde DB/fichiers, test mobile/clavier/lecteur d’écran et test de charge raisonnable.
- L’inscription et le workflow GitHub vers site doivent être cadrés avec l’hébergeur; GitHub seul ne synchronise pas automatiquement WordPress.

## GitHub / accès utilisateur
L’utilisateur veut un dépôt GitHub et un mécanisme de mise à jour vers WordPress. Dans la session de rédaction du présent fichier, le connecteur GitHub n’était pas disponible. `gh` CLI 2.46.0 a été installé dans la sandbox à la demande de l’utilisateur, mais **aucune authentification n’a été exécutée** et aucun accès GitHub n’est configuré. Ne pas demander à l’utilisateur de poster dans le chat un device code, mot de passe, PAT ou clé privée.

Si une session suivante a réellement un connecteur GitHub disponible, charger l’intégration GitHub via ses outils officiels, vérifier le statut et demander l’autorisation par le flux de connexion fourni par Arena. Ne pas contourner l’intégration en récupérant des credentials dans la sandbox. Avant de modifier un repo, demander son URL/nom ou utiliser un dépôt identifié par le connecteur; examiner la branche et l’état des fichiers, proposer une branche/PR avant changement risqué. Ne jamais pousser directement en production sans accord explicite.

## Ce que le prochain agent devrait faire
1. Confirmer si le connecteur GitHub est réellement disponible dans sa session et suivre le flux OAuth intégré (aucun code d’appareil à copier dans le chat).
2. Demander repo/branche cible et préférences déploiement/hébergement, puis importer le kit ou comparer avec le dépôt existant. Garder une sauvegarde avant écrasement.
3. Faire une revue technique réelle de l’ensemble du code : PHP lint, gestion de capabilities/nonces, sanitation/escaping, stockage progression/XP transactionnel et idempotent, endpoints, accessibilité, compatibilité WP/PHP.
4. Traiter les lacunes MVP prioritaires : UI admin pour champs de room, profil progression/trophées, flow de signup correct, validation des rooms et tests automatisés.
5. Demander si la priorité est maintenant design/dashboard, création de contenu rooms, repo GitHub ou workflow de déploiement. Ne pas déclarer « prêt à produire » sans staging, tests et hébergement identifié.
