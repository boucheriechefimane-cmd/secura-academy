# Le comité d'audit externe

> « Dans une organisation sérieuse, on ne demande pas à celui qui a écrit
> le code si son code est bon. On fait venir un regard neuf, avec une
> grille de contrôle écrite à l'avance, et on treats ce qu'il trouve. »
>
> Ce document est la règle du jeu : **qui** audite, **quoi**, **avec quelle
> méthode**, et **ce qu'on fait des constats**.

État : 01/11/2026 · version v0.6.0 · cinq auditeurs, un rapport par
auditeur, une barrière automatique.

---

## 1. Pourquoi un comité

Nous sommes l'équipe qui a écrit le code : nous ne voyons plus ce qui
clochera. Un comité d'audit externe apporte trois choses qu'un auteur ne
peut pas se donner :

| Ce que l'auteur ne peut pas | Ce que l'auditeur apporte |
|---|---|
| Voir ses propres angles morts | Un regard neuf, sur des critères écrits avant |
| Dire « ça marche chez moi » | Un environnement réel, reproductible, qui dit vrai |
| Reparler du code sans le relire | Une grille, un verdict, une trace écrite |

Le comité est **externe par nature** : il ne.code pas le produit, il le
**regarde comme un utilisateur**. Ses contrôles tournent dans un vrai
WordPress, sur le site réellement rendu (le HTML que reçoit un visiteur),
et dans de vrais conteneurs Docker quand il faut juger l'isolation.

---

## 2. Les cinq auditeurs et leurs grilles

| Auditeur | Sa question | Ce qu'il regarde (résumé) |
|---|---|---|
| **SEO** | « Un moteur va-t-il comprendre et indexer ce site ? » | adresse lisible, titre, description, canonique, carte de partage, `hreflang`, plan du site, `robots.txt`, structure des titres, textes alternatifs |
| **Contenu** | « Un formateur peut-il valider ce programme ? » | squelette des 4 temps du parcours, questions à 4 propositions, explication obligatoire, indice, position de la bonne réponse, traductions AR/EN, attribution des vidéos, chemins de drapeaux, machine branchée, défauts de fabrication, **la documentation dit-elle la vérité ?** |
| **UX / UI** | « Un élève de 14 ans peut-il s'en servir sur son téléphone, en arabe ? » | contrastes calculés (WCAG AA), nom lisible des boutons, étiquettes des champs, titre de niveau 1, façade vidéo, lien de secours, adaptation aux écrans étroits, cibles tactiles, RTL, focus visible, animations réduites, lien d'évitement, sélecteur de langue |
| **Développement** | « Le code est-il propre, compatible, testé ? » | syntaxe de tous les fichiers, compatibilité PHP 7.4, échappement des sorties, injections SQL, nonces et sessions sur l'API, limitation de débit, restes de mise au point, permissions, structure du plugin, suite de tests |
| **Sécurité & infra** | « Peut-on ouvrir cette plateforme sans risque ? » | secrets en clair, `.gitignore`, isolation par élève, exécutions dans le conteneur, durcissement Docker, réseaux fermés, drapeaux en `400 root`, en-têtes HTTP, permissions des workflows, secrets GitHub, sauvegarde **avec la base**, sauvegarde du code, protections de l'API |

Chaque auditeur a **sa grille écrite dans le code** (`scripts/audit/`), pas
dans un tableur : la grille est donc rejouable à l'identique, et c'est la
CI qui la rejoue.

---

## 3. La méthode

1. **Un vrai WordPress** : MySQL, PHP 8.3, le plugin et le thème du dépôt,
   installés comme en production (`scripts/ci-wordpress.sh`).
2. **Un vrai serveur** : les pages sont récupérées en HTTP (avec un
   routeur pour les permaliens), pas simulées en ligne de commande — on
   juge donc le HTML réellement livré.
3. **Un vrai moteur** : quand l'auditeur doit juger l'isolation entre
   élèves, il le fait dans la CI des machines (Docker réel), pas en
   logique théorique.
4. **Un rapport par auditeur** : `docs/audits/<auditeur>-<date>.md`, avec
   la liste des constats classés par gravité et un **verdict**.

### L'échelle de gravité

| Niveau | Signification | Conséquence |
|---|---|---|
| **Bloquant** | Le site est en danger ou inutilisable | **La CI échoue.** On ne met pas en ligne. |
| **Majeur** | L'élève est gêné, ou une promesse de la roadmap n'est pas tenue | À traiter avant la version suivante |
| **Mineur** | À planifier | Listé, daté, suivi |
| **Info** | Piste d'amélioration | Noté, pas urgent |

---

## 4. La barrière

Le workflow `audit.yml` fait **échouer** le job si un seul constat
bloquant est trouvé. Il se déclenche :

- à chaque `push` sur `main` ;
- à la main (`workflow_dispatch`) ;
- **chaque lundi à 6 h** (un audit complet, comme un contrôle qualité
  récurrent — le contenu évolue, l'audit doit suivre).

Les rapports sont archivés comme artefacts (90 jours) et repris dans le
résumé du run : on garde la trace, comme on garderait un rapport d'audit
dans un dossier.

---

## 5. Ce que le comité a trouvé la première fois

L'audit n'a pas été décoratif : il a trouvé de vrais défauts, que la
recette n'avait pas vus.

| Constat | Gravité | Traitement |
|---|---|---|
| Pas de description de page (le moteur inventait le résumé) | Majeur | Description ajoutée dans le thème (160 caractères, traduite) |
| Pas de carte de partage (Facebook, WhatsApp, X) | Mineur | Open Graph + carte Twitter ajoutés |
| Pas de `hreflang` (les versions AR/EN prises pour des doublons) | Mineur | Liens alternatifs FR/AR/EN + `x-default` |
| Sélecteur de langue invisible sans JavaScript | Majeur | Vrais liens dans l'en-tête, avec `aria-current` |
| Pas d'en-têtes de sécurité (anti-clickjacking, anti-sniffing) | Majeur | `X-Frame-Options`, `X-Content-Type-Options`, `Referrer-Policy`, `Permissions-Policy` |
| La sauvegarde du déploiement ne contenait pas la base | Majeur | Export de la base ajouté à `scripts/deploy.sh` |

Ces corrections sont dans la version **v0.6.0**.

---

## 6. Ce que le comité ne fait pas

- Il ne réécrit pas le code à la place des développeurs : il **signale**,
  avec une gravité et une preuve.
- Il ne juge pas le contenu pédagogique lui-même (le fond reste l'affaire
  des enseignants) : il vérifie la **forme** (traduit, expliqué, attribué,
  cohérent).
- Il ne remplace pas la recette des élèves : il l.complete par un regard
  extérieur sur ce que le produit **donne vraiment**.

---

## 7. La suite

- **Chaque semaine**, la CI rejoue les cinq audits sur le site réel.
- **À chaque version majeure**, on relit le registre
  (`docs/AUDITS-REGISTRE.md`) et on décide quels constats restants
  rentrent dans la version.
- **Avant la mise en production**, un passage au vert est exigé : zéro
  constat bloquant, et les constats majeurs traités ou planifiés.
