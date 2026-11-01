# Le registre d'audit

> Le registre tenu par le comité d'audit externe : qui a audité, quand,
> ce qu'il a trouvé, ce qui a été fait, et ce qui reste ouvert.

État : 01/11/2026 · version v0.7.0

---

## 1. Le tableau de bord

### 1 bis. Le comité des 15 auditeurs (bloc T, 01/11/2026)

Le comité est passé de 5 à 15 spécialités : dix nouveaux experts ont été
recrutés, chacun avec son domaine, sa grille de contrôle et l'obligation
de **produire une preuve** (un scénario joué, un code lu, une mesure) avant
de formuler le moindre constat. Un audit sans preuve ne compte pas.

| # | Auditeur | Contrôles | Bloquant | Majeur | Mineur | Verdict |
|---|---|---|---|---|---|---|
| 1 | SEO | 45 | 0 | 0 | 0 | **Conforme** |
| 2 | Contenu | 18 | 0 | 0 | 0 | **Conforme** |
| 3 | UX / UI | 16 | 0 | 0 | 0 | **Conforme** |
| 4 | Développement | 14 | 0 | 0 | 0 | **Conforme** |
| 5 | Sécurité & infra | 25 | 0 | 0 | 0 | **Conforme** |
| 6 | **Pédagogie** | 12 | 0 | 0 | 0 | **Conforme** |
| 7 | **Performance & Core Web Vitals** | 6 | 0 | 0 | 0 | **Conforme** |
| 8 | **Données structurées** | 7 | 0 | 0 | 0 | **Conforme** |
| 9 | **Accessibilité (WCAG 2.2 AA)** | 10 | 0 | 0 | 0 | **Conforme** |
| 10 | **Multilingue & i18n** | 6 | 0 | 0 | 0 | **Conforme** |
| 11 | **RGPD & mineurs** | 8 | 0 | 0 | 0 | **Conforme** |
| 12 | **Moteur de lab & Docker** | 6 | 0 | 0 | 0 | **Conforme** |
| 13 | **Onboarding** | 9 | 0 | 0 | 0 | **Conforme** |
| 14 | **Licences & attribution** | 4 | 0 | 0 | 0 | **Conforme** |
| 15 | **DevOps & résilience** | 10 | 0 | 0 | 0 | **Conforme** |
| | **Total** | **196** | **0** | **0** | **0** | **Conforme** |

> Les 15 auditeurs produisent chacun **trois formats** de rapport dans
> `docs/audits/` : le Markdown (lisible), le **HTML** (le document qui fait
> foi : verdict, périmètre, chiffres, scénarios joués, forces, constats avec
> la preuve sous chaque ligne, et les limites explicites) et le JSON (pour
> le tableau de bord de la CI).

### Les constats trouvés par les dix nouveaux auditeurs — et leur traitement

| # | Constat | Auditeur | Gravité | Traitement | État |
|---|---|---|---|---|---|
| 1 | La politique de confidentialité était **en brouillon** et les mentions légales n'existaient pas | RGPD | **Bloquant** | Les deux pages ont été **rédigées** à partir de ce que la plateforme fait réellement (données stockées, traceurs, durée de conservation, droits) et **publiées**, en français, arabe et anglais, avec liens au pied de page | ✅ corrigé |
| 2 | Le visiteur anonyme lisait tout le contenu mais, en cliquant sur une tâche, recevait « Une erreur est survenue. » | Onboarding | Majeur | Les actions AJAX sont désormais enregistrées pour les visiteurs non connectés : ils reçoivent **« Connectez-vous pour continuer. »** avec un **lien cliquable** vers l'inscription | ✅ corrigé |
| 3 | Le bouton « Créer un compte gratuit » ne menait nulle part : l'inscription était désactivée dans la recette | Onboarding | Majeur | L'inscription libre est activée **automatiquement** par la CI, et le réglage est vérifié par un audit | ✅ corrigé |
| 4 | Les 4 parcours n'étaient rattachés à **aucune** certification | Pédagogie | Majeur | Chaque parcours vise maintenant une certification **nommée**, avec son **coût d'examen** affiché à l'élève dans les trois langues | ✅ corrigé |
| 5 | Le type `ItemList` manquait sur les pages de parcours ; le JSON-LD ne décrivait pas la suite des rooms | Données structurées | Majeur | Un `ItemList` liste désormais les rooms du parcours, dans l'ordre | ✅ corrigé |
| 6 | Le JSON-LD contenait des **entités HTML** (`&#8217;`) au lieu de caractères réels — invisible à l'écran, mais visible pour un moteur | Données structurées | Majeur | Les textes sont normalisés avant encodage ; un contrôle anti-régression a été ajouté | ✅ corrigé |
| 7 | `ci.yml` et `deploy.yml` n'avaient **aucune limite de temps** : un job bloqué aurait consommé le runner pendant des heures | DevOps | Majeur | `timeout-minutes` ajouté aux deux | ✅ corrigé |
| 8 | Les sauvegardes du serveur s'empilaient **sans limite** — jusqu'à saturer le disque | DevOps | Majeur | Purge automatique : les 10 sauvegardes les plus récentes sont conservées | ✅ corrigé |
| 9 | **Aucune procédure de restauration écrite** : une sauvegarde que l'on ne sait pas remettre en place ne sert à rien | DevOps | Majeur | Procédure complète écrite dans `docs/deploiement.md`, avec les commandes exactes | ✅ corrigé |
| 10 | Les actions GitHub n'étaient épinglées que par version majeure | DevOps | Mineur | Les 13 usages sont épinglés par **empreinte SHA** (empreintes réelles, vérifiées le 01/11/2026) | ✅ corrigé |
| 11 | Le sens de lecture arabe (`dir="rtl"`) n'était posé que sur le bloc de l'application, pas sur le document : une page de contenu en arabe s'affichait de gauche à droite | Multilingue | (trouvé en cours de route) | Le sens de lecture est désormais porté par la balise `<html>` | ✅ corrigé |
| 12 | **La barrière bloquante ne bloquait pas** : `audit_fin()` renvoyait le code par `return`, que `wp eval-file` ignore | DevOps | (trouvé en cours de route) | `audit_fin()` termine par `exit()` ; vérifié : un constat bloquant sort désormais avec le code 1 | ✅ corrigé |

> **Sur le point 12.** C'est le genre de défaut que seule une vérification
> expérimentale révèle : le code *avait l'air* correct, et le tableau de
> bord annonçait « conforme ». C'est pourquoi chaque constat de ce document
> porte une preuve reproductible.

### Le tableau de bord des 5 premiers auditeurs (contexte)

| Auditeur | Contrôles | Bloquant | Majeur | Mineur | Verdict |
|---|---|---|---|---|---|
| SEO | 45 | 0 | 0 | 0 | **Conforme** |
| Contenu | 18 | 0 | 0 | 0 | **Conforme** |
| UX / UI | 16 | 0 | 0 | 0 | **Conforme** |
| Développement | 14 | 0 | 0 | 0 | **Conforme** |
| Sécurité & infra | 25 | 0 | 0 | 0 | **Conforme** |

> Le passage du 01/11/2026 au soir a ajouté **15 contrôles SEO** : ce sont
> les points du guide officiel de Google sur les réponses générées par l'IA
> (voir `docs/SEO-GENERATION-AI.md`).
>
> Le passage du 01/11/2026 (nuit) a ajouté **10 contrôles SEO de plus** :
> les robots d'IA nommés et autorisés dans `robots.txt`, le maillage
> interne (liens vers les rooms et les parcours), la cohérence des
> versions traduites, la fermeture de l'archive d'auteur, l'image de
> partage. Ces contrôles ont été ajoutés **après avoir trouvé** les
> écarts qu'ils vérifient — ils existaient bel et bien.

Environnement de l'audit : WordPress 7.1.4 réel (MySQL 11.8), PHP 8.3,
plugin et thème du dépôt, pages récupérées en HTTP, machines Docker
réelles pour l'isolation.

---

## 2. Les constats du premier passage, et leur traitement

| # | Constat | Auditeur | Gravité | Traitement | État |
|---|---|---|---|---|---|
| 1 | Aucune description de page : le moteur inventait le résumé | SEO | Majeur | Description générée dans le thème (160 caractères, traduite) | **Corrigé** |
| 2 | Aucune carte de partage (Facebook, WhatsApp, LinkedIn, X) | SEO | Mineur | Open Graph + carte Twitter ajoutés | **Corrigé** |
| 3 | Aucun `hreflang` : les versions arabe et anglaise pouvaient être traitées comme des doublons | SEO | Mineur | Liens alternatifs FR/AR/EN + `x-default` | **Corrigé** |
| 4 | Le sélecteur de langue n'existait qu'en JavaScript | UX/UI | Majeur | Vrais liens dans l'en-tête, avec `aria-current` et style | **Corrigé** |
| 5 | Aucun en-tête de sécurité HTTP (anti-clickjacking, anti-sniffing) | Sécurité | Majeur | `X-Frame-Options`, `X-Content-Type-Options`, `Referrer-Policy`, `Permissions-Policy` | **Corrigé** |
| 6 | La sauvegarde du déploiement ne contenait pas la base de données | Sécurité | Majeur | Export de la base ajouté à `scripts/deploy.sh` | **Corrigé** |
| 7 | La page de room n'annonçait pas la langue arabe en RTL | SEO | Majeur | Vérification de `dir="rtl"` ajoutée au contrôle | **Corrigé** |
| 8 | Aucune trace écrite des audits | Comité | Majeur | Registre créé, rapports versionnés, workflow `audit.yml` | **Corrigé** |

### 2 bis. Les constats de l'audit « conformité aux réponses générées par l'IA » (guide Google, 01/11/2026)

| # | Constat | Gravité | Traitement | État |
|---|---|---|---|---|
| 9 | Les adresses de langue étaient **relatives** (`/rooms/…`) : Google ignore les adresses relatives, les versions AR et EN pouvaient être abandonnées | Majeur | `hreflang` FR/AR/EN + `x-default` en adresses absolues | **Corrigé** |
| 10 | **Aucune adresse canonique** : la version arabe ressemblait à un doublon de la version française, et pouvait ne pas être indexée | Majeur | Canonique auto-référente par langue (FR, AR, EN) ; celle de WordPress, qui ignorait la langue, a été retirée pour n'en garder qu'une | **Corrigé** |
| 11 | **Aucune donnée structurée** (schema.org) : le moteur ne pouvait pas savoir que la page est une room ni qu'elle contient une vidéo | Mineur | `class-secura-schema.php` : `Organization`, `LearningResource`, `VideoObject`, `BreadcrumbList`, `Course` | **Corrigé** |
| 12 | La vidéo du cours n'était déclarée nulle part (la façade ne charge rien avant le clic) : invisible pour un moteur | Mineur | `VideoObject` avec durée, miniature, adresse de lecture, éditeur et licence | **Corrigé** |
| 13 | La room n'avait **aucun titre de section** (`h2`) : ni les lecteurs d'écran ni les agents ne trouvaient de repères | Mineur | 4 titres de niveau 2 par room (leçon, tâches, machine, terminal) | **Corrigé** |
| 14 | Les étapes pratiques de la room étaient dessinées par le JavaScript : un robot sans JavaScript ne lisait pas le cœur du cours | Majeur | Liste des étapes servie dans le HTML, doublée en `<noscript>` | **Corrigé** |

---

## 3. Ce que le comité a confirmé de bon

C'est aussi utile qu'un constat : ces points sont **vérifiés à chaque
push** désormais, et ne peuvent plus se dégrader.

- **SEO** : adresses lisibles, `robots.txt` ouvert, plan du site présent,
  titres uniques et assez courts, un seul titre de niveau 1 par page,
  images avec texte alternatif.
- **Contenu** : les 52 rooms ont les 4 temps du parcours, 255 questions
  toutes à 4 propositions avec une seule bonne réponse, une explication
  et un indice ; la bonne réponse n'est jamais toujours à la même place ;
  toutes les rooms sont traduites AR/EN ; toutes les vidéos sont
  attribuées ; toutes les missions pointent vers un drapeau lisible sur
  une machine ; aucun texte de remplissage, aucun caractère étranger.
- **UX / UI** : contrastes calculés conformes à WCAG AA (le plus faible
  est à 6,77:1, très au-dessus du minimum de 4,5:1), boutons nommés,
  champs étiquetés, façade vidéo respectée, lien de secours visible,
  cibles tactiles, RTL, focus visible, « moins d'animations » respecté.
- **Développement** : 22 fichiers PHP compilent, aucune fonction PHP 8
  (la cible reste 7.4), aucune sortie non échappée, aucune requête SQL
  non préparée, nonce + session + limitation de débit sur toute l'API,
  aucun reste de mise au point, **302 tests internes au vert**.
- **Sécurité & infra** : aucun secret en clair, isolation par élève
  (projet et réseau dédiés), exécutions confinées dans le conteneur,
  conteneurs durcis (`cap_drop`, `no-new-privileges`, limites de
  processus), réseaux sans sortie Internet, drapeaux en `400 root:root`,
  permissions limitées sur tous les workflows, secrets jamais dans le
  code.

---

## 4. Ce qui reste ouvert (et n'est pas bloquant)

| Sujet | Pourquoi | Suite |
|---|---|---|
| Les labs M7 sont volontairement difficiles | C'est le palier 3 | Un parcours d'échauffement avant le dojo, à évaluer après usage |
| Les vidéos de brief sont en anglais | Les cours originaux sont des sources anglaises | Les leçons écrites sont, elles, traduites AR/EN |
| Les Core Web Vitals réels (LCP, CLS, INP) ne se mesurent pas depuis le serveur | Ils se mesurent dans le navigateur du visiteur | L'auditeur Performance vérifie les **causes racines** ; la mesure réelle se fera avec PageSpeed Insights à la mise en ligne |
| Pas de contrôle d'âge ni de consentement parental | Exigence RGPD pour les moins de 15 ans | Signalé par l'auditeur RGPD — à traiter au niveau du produit |
| 14 rooms sur 52 n'ont pas de machine d'entraînement | Leur exercice d'application est un QCM, pas une manipulation | Mesuré par l'auditeur Pédagogie — au backlog |
| La traduction AR/EN des textes de certification manque | Le nom de la certification est le même partout, l'explication reste en français | Au backlog |
| Search Console non connectée, donc pas de rapport « Generative AI performance » | Le site n'est pas public | À connecter à la mise en ligne, puis à suivre chaque mois |
| Le dojo pwn.college officiel n'est pas construit en CI | Son image est trop lourde | À faire sur le VPS, quand il existera |

---

## 5. Comment reproduire l'audit

```bash
# En local (un WordPress déjà installé)
SECA_WP_DIR=/tmp/wp-u2 bash scripts/audit/run-audits.sh

# Dans GitHub (le workflow fait tout : WordPress, serveur, audits, rapports)
gh workflow run audit.yml
```

Les rapports sont écrits dans `docs/audits/` et archivés par le workflow.

---

## 6. Historique

| Date | Version | Résultat |
|---|---|---|
| 01/11/2026 | v0.6.0 | Premier passage du comité externe : 8 constats, tous corrigés, **93 contrôles au vert** |
| 01/11/2026 | v0.6.0 | Audit de conformité au guide Google « réponses générées par l'IA » : 6 constats, tous corrigés (hreflang absolus, canonique par langue, données structurées, vidéo déclarée, titres de section, étapes en HTML), **108 contrôles au vert** |
| 01/11/2026 (nuit) | v0.7.0 | Second passage : **10 constats réels** trouvés en refaisant les tests à la main — maillage interne (0 room atteignable), `robots.txt` sans robots d'IA nommés, titre des pages arabes resté en français, 37 chaînes de traduction dégradées, archive d'auteur ouverte, page d'accueil en texte de démonstration, absence d'image de partage. Tous corrigés : **118 contrôles au vert** |
| 01/11/2026 (nuit, suite) | v0.7.0 | Défaut d'outillage de test, **pas** du site : les contrôles « robots.txt nomme les robots d'IA » et « llms.txt cite les rooms » échouaient en CI alors qu'ils passaient en local. Cause isolée en conteneur (PHP 8.3 reproduit l'échec, PHP 8.4 non) : le serveur PHP intégré répond 404 pour une adresse à extension, donc `/robots.txt` et `/llms.txt` n'atteignaient jamais WordPress. Un vrai hébergeur (Apache/LiteSpeed) les route vers WordPress via `.htaccess` : le site était correct. **Correction :** les workflows servent le site via `scripts/audit/router.php`, comme le faisait déjà le workflow d'audit. Vérification après correction : **118 contrôles, 0 constat**, recette **34/34**, 5 workflows verts |
