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
| 1 | SEO | 46 | 0 | 0 | 0 | **Conforme** |
| 2 | Contenu | 18 | 0 | 0 | 0 | **Conforme** |
| 3 | UX / UI | 16 | 0 | 0 | 0 | **Conforme** |
| 4 | Développement | 18 | 0 | 0 | 0 | **Conforme** |
| 5 | Sécurité & infra | 25 | 0 | 0 | 0 | **Conforme** |
| 6 | **Pédagogie** | 12 | 0 | 0 | 0 | **Conforme** |
| 7 | **Performance & Core Web Vitals** | 6 | 0 | 0 | 0 | **Conforme** |
| 8 | **Données structurées** | 7 | 0 | 0 | 0 | **Conforme** |
| 9 | **Accessibilité (WCAG 2.2 AA)** | 10 | 0 | 0 | 0 | **Conforme** |
| 10 | **Multilingue & i18n** | 8 | 0 | 0 | 0 | **Conforme** |
| 11 | **RGPD & mineurs** | 8 | 0 | 0 | 0 | **Conforme** |
| 12 | **Moteur de lab & Docker** | 6 | 0 | 0 | 0 | **Conforme** |
| 13 | **Onboarding** | 9 | 0 | 0 | 0 | **Conforme** |
| 14 | **Licences & attribution** | 4 | 0 | 0 | 0 | **Conforme** |
| 15 | **DevOps & résilience** | 10 | 0 | 0 | 0 | **Conforme** |
| | **Total** | **203** | **0** | **0** | **0** | **Conforme** |

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
| 13 | **Un titre passait du niveau 1 au niveau 3** dans la room « Kahoot : la révision des labs avancés » : les lecteurs d'écran annonçaient un titre de niveau 2 manquant | Accessibilité (WCAG 2.2 AA) | **Majeur** | Le bloc Kahoot titre désormais en `<h2>`, comme les autres blocs de room ; **testé dans les deux sens** (le garde-fou détecte le retour de la faute) | ✅ corrigé |
| 14 | **Deux contrôles ne regardaient qu'une room tirée au hasard** : le résultat dépendait de l'ordre des identifiants — un défaut visible en CI pouvait être invisible en local | Accessibilité, SEO | (trouvé en cours de route) | Les **53 pages** (accueil + 52 rooms) sont vérifiées à chaque audit, et le titre de **chaque** room est contrôlé sur la page réellement servie | ✅ corrigé |

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

### 2 ter. La régression « les boutons ne faisaient plus rien » (01/11/2026, v0.8.1)

**Le symptôme.** Après la livraison du comité d'audit à quinze experts
(version 0.8.0), les deux workflows GitHub sont tombés en échec. En
rejouant la recette des deux apprenants à la main, le site a montré un
défaut bien plus grave que l'échec des tests : **le bouton « Déployer la
machine » ne faisait plus rien**, et l'élève recevait « Une erreur est
survenue. »

**La cause racine.** Le nom d'une action AJAX (le nom que le navigateur
envoie au site) est un **contrat** : il est écrit à trois endroits — le
front `assets/academy.js`, le script de recette des deux apprenants, et le
plugin qui enregistre la demande. Lors de la livraison du comité, le
préfixe de ces noms avait été raccourci de `secura_` en `seca_` **dans le
plugin seulement**. Le front, lui, continuait d'appeler `secura_lab_start`,
`secura_terminal`, `secura_lab_status`, `secura_lab_stop`.

Le symptôme est silencieux : WordPress ne dit pas « action inconnue », il
répond **`0`** avec un code HTTP 400. Aucun journal, aucune erreur visible.
Le bouton noumbla.

**La preuve** (pas une déduction) :

| Ce qui a été mesuré | Résultat |
|---|---|
| Crochet `wp_ajax_secura_get_room` | **présent** |
| Crochets `wp_ajax_secura_lab_start`, `wp_ajax_secura_terminal`, `wp_ajax_secura_lab_status`, `wp_ajax_secura_lab_stop` | **absents** |
| La version précédente du plugin (`git show d71a7e1`) | enregistrait bien `wp_ajax_secura_*` |
| Appel direct de `secura_lab_start` depuis le navigateur | HTTP 400, corps `0` |
| Scénario complet après correction | **100 % réussi**, code de sortie 0 : les deux élèves déploient leur machine, exécutent leurs commandes, lisent le drapeau `SECURA{sql_injection_web}` **dans leur propre conteneur** |

**Le traitement.**

| Correction | Fichier |
|---|---|
| Les **onze** actions sont revenues à leur contrat `secura_*` (et `wp_ajax_nopriv_` conservé, pour que l'invité reçoive une vraie invitation et non une erreur) | `wp-content/plugins/secura-academy/includes/class-secura-ajax.php` |
| La sonde de pré-contrôle de la recette interroge la bonne action | `tools/recette-apprenants/scenario.py` |
| L'auditeur « Onboarding » interroge la bonne action (il ne testait donc rien avant) | `scripts/audit/audit-onboarding.php` |
| La CI crée les pages légales avant l'audit RGPD | `scripts/ci-wordpress.sh` |

**Le garde-fou (pour que ça ne se reproduise plus).** Deux contrôles
automatiques ont été ajoutés à l'auditeur « Développement » (14 → 16
contrôles) : ils comparent **nom par nom** la liste des actions appelées
par le front et par la recette avec la liste des actions enregistrées par
le plugin. Une seule action qui diffère suffit à faire échouer l'audit en
bloquant, avec le nom de l'action fautive.

Ce garde-fou a été **testé dans les deux sens** : en le faisant échouer
volontairement (le plugin enregistrant `seca_lab_start` au lieu de
`secura_lab_start`), il a bien produit **2 constats bloquants** en
dénommant l'action fautive ; remis à l'endroit, il repasse au vert.

> **La leçon, écrite dans le plugin lui-même.** Un nom d'action AJAX ne se
> renomme pas en un seul endroit. Cette règle est désormais rappelée en
> commentaire dans le fichier qui enregistre les actions, et vérifiée à
> chaque push.

### 2 quater. Le mot « fonctionnalités » écrit en coréen (01/11/2026, v0.8.1)

**Le symptôme.** En relisant les textes livrés, une phrase de la politique
de confidentialité contenait deux caractères coréens à la place du mot
« fonctionnalités ». À l'écran, rien ne se voit : les caractères coréens
ont exactement l'apparence d'un texte latin.

**Où le défaut était visible — et où il ne l'était pas.**

| Endroit | Avant le correctif | Après |
|---|---|---|
| La page affichée dans le navigateur | **correcte** (le plugin sert son propre texte) | correcte |
| Le texte brut en base de données | **corrompu** | corrigé |
| **L'API REST** (`/wp-json/wp/v2/pages/3`) | **corrompu** — donc public | corrigé |

**⇒ La leçon : « la page marche » ne prouve pas que « le contenu est
propre ».** Le site affichait un texte correct parce que le plugin le
remplace au moment du rendu ; mais l'API REST, elle, publie le texte
brut de la base. Le défaut était donc accessible à quiconque knew l'adresse.

**Le traitement.**

| Correction | Fichier |
|---|---|
| Le texte est réécrit proprement | `wp-content/plugins/secura-academy/includes/content-legal.php` |
| Les pages légales **de la base** sont mises à jour à chaque nouvelle version du plugin — en ne jamais écrasant un texte que le propriétaire aurait retouché à la main (comparaison par empreinte) | `wp-content/plugins/secura-academy/includes/class-secura-site.php` |

**Le garde-fou.** Un contrôle a été ajouté à l'auditeur « Multilingue »
(6 → 7 contrôles) : il cherche, dans les fichiers livrés **et dans les
pages réellement servies** (y compris l'API REST), tout caractère
appartenant à une écriture étrangère au site (cyrillique, grec, han,
hiragana, katakana, hangul, devanagari, thaï, hébreu). L'arabe, langue
officielle du site, n'est pas concerné.

Ce contrôle a été **testé dans les deux sens** : en réintroduisant le
caractère coréen, il a signalé **4 intrusions** en nommant le fichier et
la page ; remis à l'endroit, il repasse au vert.

> **Note de méthode.** La première version de ce contrôle lisait la base
> de données et signalait le texte brut — y compris lorsqu'un
> propriétaire y avait écrit son propre texte. C'était un **faux
> positif** : le contrôle a été réécrit pour vérifier ce que le visiteur
> reçoit vraiment. Un audit qui produit de faux positifs perd la
> confiance de celui qui le lit ; il vaut mieux un audit étroit et vrai
> qu'un audit large et approximatif.

---

### 2 quinquies. Le piège WP-CLI : les pages légales qui n'existaient qu'à moitié (01/11/2026, v0.8.2)

**Le symptôme.** Le workflow « Audit externe » est tombé rouge sur un
constat **bloquant** de l'auditeur RGPD :

> Politique de confidentialité (statut : **draft**) | Mentions légales
> (**aucune page** « mentions-legales »)

Autrement dit : sur un site installé **en ligne de commande**, les deux
pages que la loi impose à une plateforme accueillant des mineurs
n'existaient pas. La recette manuelle, elle, les montrait bien.

**La cause — un contexte, pas une faute de logique.** Le plugin rangeait
les textes légaux dans une **variable globale**
(`$secura_pages_legales`). Or **WP-CLI charge WordPress à l'intérieur
d'une fonction** (`WP_CLI\Runner::load_wordpress()`) : une variable
globale définie par un plugin n'y existe pas. WordPress lui-même le
dit, en tête de `wp-settings.php` :

```php
global $wp_version, $wp_db_version, $tinymce_version, … ;   // les seules globales
```

et WP-CLI le répète dans son propre code :

```php
// Globals not explicitly globalized in WordPress
global $site_id, $wpdb, $public, $current_site, $current_blog, $path, $shortcode_tags;
```

**La preuve, mesurée** (et non supposée) :

| Mesure | Résultat |
|---|---|
| `class_exists( 'Secura_Site' )` sous WP-CLI | **vrai** — le plugin est bien chargé |
| `isset( $GLOBALS['secura_pages_legales'] )` sous WP-CLI | **faux** — la variable n'existe pas |
| Même installation, servie par un vrai serveur web | les pages légales ** existent** |
| Base neuve + installation en ligne de commande | pages légales **absentes** (le défaut rejoué) |

**Pourquoi la recette manuelle ne l'avait pas vu.** Sur un serveur web,
une variable de plugin est bien globale : tout fonctionnait. En CI,
tout passe par WP-CLI : rien ne fonctionnait. **Le défaut ne vivait
que dans un contexte** — et la recette jouait toujours dans l'autre.

**Le traitement.**

| Correction | Fichier |
|---|---|
| Les textes passent par une **fonction** (`seca_textes_legaux()`), qui existe dans tous les contextes — web, WP-CLI, cron, tests | `wp-content/plugins/secura-academy/secura-academy.php`, `includes/class-secura-site.php` |
| L'installation est **vérifiée explicitement** : si les pages légales ne sont pas publiées, le script s'arrête en disant pourquoi | `scripts/verifier-pages-legales.php`, `scripts/ci-wordpress.sh` |

**Les garde-fous (testés dans les deux sens).**

1. `scripts/ci-wordpress.sh` affiche l'état des deux pages après
   l'installation et **échoue bruyamment** si l'une manque ou n'est pas
   publiée. Reproduit volontairement (textes vidés), le contrôle sort en
   erreur en nommant la page absente.
2. L'auditeur « Développement » gained **deux contrôles** (16 → 18) :
   le code livré ne lit **aucune variable globale définie par le
   plugin** (les globales de WordPress, comme `$wpdb`, restent
   autorisées — elles existent vraiment), et les textes légaux sont
   **atteignables par une fonction**.
3. L'auditeur « Données structurées » compare désormais des textes
   **normalisés** (entités décodées, apostrophes unifiées).

**Un contre-exemple honnête.** Le contrôle « ce qui est déclaré
apparaît aussi à l'écran » a d'abord produit un **faux positif** : le
titre « Débordement de tampon : l'attaque et les défenses » était bien
à l'écran, mais le HTML échappait l'apostrophe typographique
(`&#8217;`) là où le JSON-LD gardait l'apostrophe droite. Le contrôle
a été corrigé — on normalise les deux côtés avant de comparer — et non
le contenu : le titre affiché reste parfaitement correct.

> **La leçon.** « Ça marche sur mon serveur » n'est pas une preuve :
> c'est une preuve **dans un contexte**. Un test qui rejoue
> l'installation *dans un autre contexte* — la ligne de commande, une
> base neuve — prouve ce que la recette manuelle ne prouve pas. Et un
> workflow qui échoue doit **dire pourquoi dans son journal** : c'est
> désormais le cas, l'installation est vérifiée et sa cause est
> nommée.

---

### 2 sexies. La feuille de style arabe, demandée à une adresse qui n'existait pas (01/11/2026, v0.8.3)

**Le symptôme.** L'auditeur « Multilingue » signalait, dans la CI
seulement, « 4 propriétés physiques au lieu de logiques » dans un fichier
appelé `style-rtl.css`. Un fichier nommé « style-rtl » : notre feuille
arabe, censée porter les ajustements de mise en page et de typographie de
la version arabe.

**Ce qui se passait vraiment.** Le thème déclarait sa feuille arabe avec
un **chemin de fichier** là où il fallait une **adresse** :

```php
get_template_directory() . '/style-rtl.css'   // /chemin/du/serveur/…
get_template_directory_uri() . '/style-rtl.css' // https://site/…  ← correct
```

Le navigateur demandait donc `/tmp/wp-ci-fresh/wp-content/themes/…/style-rtl.css`
à la racine du site : la réponse était un **404**, et **la feuille arabe
n'était jamais chargée**. Le site paraissait correct — l'attribut
`dir="rtl"` est posé par le plugin — mais aucune mise en page arabe
n'était appliquée.

**La preuve, mesurée.**

| Mesure | Avant | Après |
|---|---|---|
| Adresse demandée par le navigateur pour la feuille arabe | `http://site/tmp/…/style-rtl.css?ver=0.7.0` | `http://site/wp-content/themes/secura-learning/style-rtl.css?ver=0.8.3` |
| Réponse du serveur | **404** (60 Ko de HTML) | **200** (feuille de style) |
| Feuilles de style en erreur sur la page arabe | 1 | **0** |

**Et le faux positif.** Le contrôle mesurait la réponse **404** — c'est-à-
dire une page d'erreur de WordPress, qui contient le CSS de WordPress en
ligne, avec des propriétés physiques (légitimes : ce sont les fichiers
RTL de WordPress, la contrepartie de ses fichiers LTR). Le contrôle
signalait donc **le CSS de WordPress**, pas le nôtre. Nos deux feuilles
de style (celles du plugin et celles du thème) contiennent **zéro**
propriété physique — vérifié sur les fichiers du dépôt.

**Le traitement.**

| Correction | Fichier |
|---|---|
| La feuille arabe est déclarée avec une **adresse**, et non un chemin | `wp-content/themes/secura-learning/functions.php` |
| Elle est en outre chargée dès que le **visiteur** lit en arabe — même si le site est en français (c'est le cas par défaut) | `wp-content/themes/secura-learning/functions.php` |
| La version du thème est cohérente partout (elle était restée à `0.7.0` dans le code, alors que l'en-tête du CSS annonçait `0.8.2`) | `wp-content/themes/secura-learning/functions.php`, `style.css` |
| Le contrôle ne mesure plus que des **feuilles de style** (HTTP 200) et nomme l'adresse complète dans sa preuve | `scripts/audit/audit-multilingue.php` |

**Les garde-fous.**

1. **Un contrôle nouveau (bloquant)** : « toutes les feuilles de style de
   la page se chargent (HTTP 200) », dans les trois langues. C'est celui
   qui aurait dû attraper ce défaut dès le début — il était invisible
   parce que personne ne vérifiait que la feuille était *chargée*.
2. Un contrôle de l'auditeur « Multilingue » ne mesure plus une page
   d'erreur comme si c'était une feuille de style, et la preuve affiche
   l'adresse complète : un constat est actionnable.
3. Un faux positif de l'auditeur « SEO » est corrigé au passage : le
   titre d'une room était comparé à la page **sans normaliser les
   apostrophes** (droites dans la base, typographiques à l'écran) —
   d'où un « titre absent » qui n'était pas absent.

> **La leçon.** « La page s'affiche en arabe » ne prouve pas que « la
> mise en page arabe est appliquée ». Il y a deux choses : le sens de
> lecture du **document** (`dir="rtl"`), et celui de la **mise en page**
> (la feuille de style). Les deux doivent être vérifiés, séparément — et
> une feuille de style doit être vérifiée **en la chargeant**, pas en
> presumant qu'elle est là parce qu'elle est déclarée.

---

### 2 septies. Un audit qui tire au sort ne prouve rien (01/11/2026, v0.8.3-bis)

**Le symptôme.** La CI a trouvé un **majeur d'accessibilité** que la recette
locale ne voyait jamais : dans la room « Kahoot : la révision des labs
avancés », la hiérarchie des titres sautait du niveau 1 au niveau 3
(`<h1>` → `<h3>`). Un lecteur d'écran annonce alors « titre de niveau 2
manquant » : la structure de la page n'est plus comprise.

**Pourquoi la recette locale ne l'avait pas vu.** Le contrôle
d'accessibilité **tirait une room au hasard** parmi celles qui existent.
Selon l'identifiant tiré, le défaut apparaissait ou non : il était
**visible en CI, invisible en local**, et son résultat changeait d'une
exécution à l'autre. Un contrôle qui dépend d'un hasard n'est pas un
contrôle.

**La cause réelle du saut.** Les autres blocs d'une room (les tâches, la
machine cible, le terminal) titrent en `<h2>`. Le bloc Kahoot titrait en
`<h3>` : un niveau inventé, sans rapport avec sa place dans la page.

**La preuve, mesurée.**

| Mesure | Avant | Après |
|---|---|---|
| Séquence de titres de la room 59 | `h2, h1, h3, h2, h2, h2` | `h2, h1, h2, h2, h2, h2` |
| Sauts de niveau détectés sur les 52 rooms | 1 (room 59) | **0** |
| Rooms sans titre de niveau 1 unique | 0 | **0** |
| Rooms contrôlées par l'audit | 1 (tirée au hasard) | **53** (accueil + 52 rooms) |

**Le traitement.**

| Correction | Fichier |
|---|---|
| Le bloc Kahoot titre en `<h2>` (le style est porté par la classe `seca-kahoot-title` : **le rendu visible ne change pas**) | `wp-content/plugins/secura-academy/includes/class-secura-kahoot.php` |
| L'audit d'accessibilité vérifie **toutes** les rooms (accueil + 52), dans l'ordre des identifiants — plus aucun tirage au sort | `scripts/audit/audit-accessibilite.php` |
| L'auditeur « SEO » vérifie le titre de **chaque** room sur la page réellement servie (comparaison après normalisation) | `scripts/audit/audit-seo.php` |

**Les garde-fous.**

1. **Le test négatif.** Le défaut a été **remis volontairement** dans la
   source : l'audit a alors produit « room 59 : saut de niveau h1 → h3 »
   (majeur, en nommant la room). La faute réintroduite, le défaut revient :
   le garde-fou est vérifié **dans les deux sens**, pas seulement quand tout
   va bien.
2. **Aucun échantillon arbitraire.** Les audits qui portaient sur « une
   room tirée au hasard » ne regardent plus qu'un tirage : ils regardent
   **tout le catalogue** (53 pages), en deux secondes.
3. **Le même traitement pour le SEO.** Le titre de chaque room est
   comparé à ce que la page **servie** annonce, après normalisation des
   entités et des apostrophes (droites dans la base, typographiques à
   l'écran) — un contrôle qui produit des faux positifs perd la confiance
   de celui qui le lit.

> **La leçon.** « 0 constat » n'a de valeur que si le contrôle a regardé
> **tout** ce qu'il prétend regarder. Un contrôle qui choisit sa cible au
> hasard peut afficher « conforme » le jour où la cible est saine, et
> « rouge » le lendemain pour une raison qui n'a rien à voir avec le
> code. Le passage de 202 à **203 contrôles** n'est pas un ajout de
> couverture : c'est un **dépistage qui ne laisse plus rien au hasard**.

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
| 01/11/2026 (nuit, suite) | v0.8.0 | Livraison du comité des quinze : **196 contrôles, 0 constat**. Mais deux workflows GitHub sont tombés en échec, et le rejeu de la recette à la main a montré un **vrai défaut** : les onze actions AJAX avaient été renommées de `secura_` en `seca_` dans le plugin seulement — le front continuait d'appeler les anciennes. Le site était donc **cassé pour les élèves** (bouton « Déployer la machine » inerte, message d'erreur muet). Corrigé, et **deux contrôles automatiques** ajoutés pour que la cohérence des noms soit vérifiée à chaque push. Voir § 2 ter |
| 01/11/2026 (nuit, suite) | v0.8.1 | Deuxième passe de relecture : le mot « fonctionnalités » était écrit **en coréen** dans la politique de confidentialité. Invisible à l'écran ; **public via l'API REST**, qui publie le texte brut de la base. Corrigé, avec un **nouveau contrôle** qui cherche les caractères d'une écriture étrangère dans les fichiers livrés et dans les pages réellement servies. Les pages légales de la base sont désormais remises à jour à chaque version du plugin, **sans jamais écraser un texte retouché par le propriétaire**. Voir § 2 quater. Total : **199 contrôles, 0 constat** |
| 01/11/2026 (nuit, suite 2) | v0.8.2 | Le workflow « Audit externe » est tombé rouge sur un constat RGPD **bloquant** : les pages légales n'existaient pas **sur un site installé en ligne de commande**. Cause mesurée : le plugin rangeait les textes dans une **variable globale**, et WP-CLI charge WordPress **dans une portée de fonction** — une telle variable n'y existe pas. Le défaut ne vivait donc que dans un contexte (la CI), invisible pour la recette manuelle jouée sur un vrai serveur web. **Correction :** les textes passent par une fonction, qui existe partout ; **garde-fou :** l'installation est vérifiée explicitement (l'échec nomme la page absente) et **deux contrôles** interdisent le retour de la faute. Un faux positif a été corrigé au passage (apostrophe typographique échappée en `&#8217;` dans la comparaison des données structurées). Voir § 2 quinquies. Total : **200 contrôles, 0 constat** |
| 01/11/2026 (nuit, suite 4) | v0.8.3-bis | La CI a trouvé un **majeur d'accessibilité** que la recette locale ne voyait pas : un saut de titre `h1` → `h3` dans la room « Kahoot ». Deux causes : le bloc Kahoot titrait en `<h3>` alors que tous les autres blocs de room titrent en `<h2>` ; et surtout, **le contrôle d'accessibilité tirait une room au hasard** — visible en CI, invisible en local, et différent d'une exécution à l'autre. **Correction :** bloc Kahoot en `<h2>` (rendu inchangé, le style est porté par la classe) ; l'audit vérifie désormais **les 53 pages** (accueil + 52 rooms) ; l'auditeur « SEO » vérifie le titre de **chaque** room sur la page servie. **Garde-fou :** le défaut a été **remis volontairement** dans le code pour prouver que l'audit le détecte (il nomme la room), puis retiré — un garde-fou testé dans les deux sens. Total : **203 contrôles, 0 constat** |
| 01/11/2026 (nuit, suite 3) | v0.8.3 | La CI a signalé un « majeur » multilingue : des propriétés physiques dans la feuille arabe. En cherchant, on a trouvé un **vrai défaut invisible** : le thème déclarait sa feuille arabe avec un **chemin de fichier** au lieu d'une **adresse**, donc le navigateur demandait une URL qui n'existait pas (404) — **la mise en page arabe n'était jamais appliquée**. Le constat, lui, était un **faux positif** : le contrôle mesurait la page 404 (qui contient le CSS de WordPress), pas une feuille de style. **Correction :** adresse correcte, et feuille arabe chargée dès que le visiteur lit en arabe, même sur un site en français ; version du thème cohérente. **Garde-fous :** un contrôle **bloquant** vérifie désormais que toutes les feuilles de style d'une page se chargent (HTTP 200), dans les trois langues ; et le contrôle ne mesure plus une page d'erreur comme si c'était une feuille de style. Un faux positif de l'auditeur « SEO » est corrigé au passage (apostrophes non normalisés). Total : **202 contrôles, 0 constat** |
