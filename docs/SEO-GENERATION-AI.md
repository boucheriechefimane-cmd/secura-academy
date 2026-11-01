# Conformité au guide Google « Optimizing your website for generative AI features on Google Search »

**Date :** 1er novembre 2026
**Version :** v0.7.0
**Objet :** vérifier point par point que la plateforme est conforme au guide officiel de Google sur les réponses générées par l'IA (AI Overviews et AI Mode), corriger ce qui ne l'est pas, et empêcher que cela retombe.

---

## 1. En une phrase

**Le site est conforme aux points techniques que l'on peut vérifier sur une machine — et l'on peut le prouver.** Google dit lui-même que les réponses générées par l'IA s'appuient sur le même index que la recherche classique : ce qui compte, c'est une page **explorable**, **compréhensible**, **sans doublon** et **rapide** — pas une page « écrite pour l'IA ». L'audit automatique contrôle désormais **45 points**, dont **10 nouveaux** qui vérifient ce qui manquait vraiment : le maillage interne, l'autorisation explicite des robots d'IA, et la cohérence des versions traduites.

> **Attention, une précision d'honnêteté :** « conforme » signifie ici *conforme à ce que l'on peut mesurer*. Cela ne veut **pas** dire « indexé à 100 % » ni « cité par l'IA ». Ces deux choses dépendent de Google, pas de nous : elles se vérifient dans la Search Console, après la mise en ligne. Voir le chapitre 6.

---

## 2. Ce que dit vraiment le guide de Google (en clair)

| Idée du guide | Ce que cela veut dire pour nous, en pratique |
|---|---|
| L'IA de Google lit le **même index** que la recherche classique | Inutile d'écrire une version « pour l'IA » : il suffit d'être bien référencé, comme n'importe quel site |
| Le contenu doit être **original et non interchangeable** | Nos 52 rooms sont des leçons originales (pas des pages « à trous » ni des textes recopiés) |
| La structure technique doit être **claire et explorable** | Un robot doit pouvoir suivre les liens, comprendre les titres, et lire le texte |
| Le contenu doit être **servi par le serveur** (pas seulement en JavaScript) | Un robot sans JavaScript doit lire la même chose qu'un élève |
| Le HTML doit être **sémantique** (`h1`, `h2`, `article`, `main`, `nav`) | Les titres de section servent de « ancres » au texte |
| Le JavaScript ne doit **pas bloquer** l'accès au contenu | Notre JavaScript n'ajoute que du confort (vidéo, terminal, progression) |
| Le contenu doit être **facilement trouvable par liens internes** | Chaque room doit être reliée depuis son parcours — c'est le chemin que suivent les robots |
| Il faut **peu de contenu en double** | Les versions FR / AR / EN doivent se déclarer mutuellement **et porter du texte dans leur langue** |
| Les **données structurées** (schema.org) sont **recommandées**, pas obligatoires | Déclarer ce qu'est une room, une vidéo, un parcours : utile, et sans risque |
| **Pas besoin** de `llms.txt`, de découpage « en morceaux », ni de réécriture pour l'IA | Google traite ces idées comme des mythes : on ne les fait pas |
| Mesurer avec la **Search Console** | À faire au moment de la mise en ligne, quand le site est public (voir chapitre 6) |
| Les **agents** (navigateurs autonomes) lisent le DOM, l'affichage et l'**arbre d'accessibilité** | Nos titres, nos libellés et nos liens doivent être lisibles par une machine |

### Le point qui piège tout le monde : `Google-Extended` n'est pas « le robot de l'IA Overviews »

Google le dit explicitement dans son guide : `Google-Extended` sert à l'**entraînement** et à l'**ancrage** dans *les autres* systèmes de Google. Il ne contrôle **pas** l'apparition d'un site dans un AI Overview ou un AI Mode. Ce qui les contrôle, c'est `Googlebot` — le robot de la recherche classique.

Autrement dit : **bloquer `Google-Extended` n'empêche pas d'être cité dans une réponse IA**, et **autoriser `Google-Extended` ne l'y garantit pas**. C'est pour cela que le guide insiste sur le maillage, le contenu et les données structurées, et pas sur une liste de robots à autorisés.

---

## 3. L'audit point par point

Légende : ✅ **conforme** — 🔧 **écart corrigé** — 📌 **à faire à la mise en ligne** — ⛔ **sans objet** (le guide dit que ce n'est pas nécessaire).

| # | Point du guide | Ce que fait le site aujourd'hui | Verdict |
|---|---|---|---|
| 1 | Contenu original, non interchangeable | 52 rooms rédigées à la main, 4 parcours, 22 rooms issues de contenus universitaires libres (MIT OCW, pwn.college) avec attribution ; aucune page « gabarit » vide | ✅ |
| 2 | Page explorable (liens, plan) | L'accueil liste les 52 rooms et les 4 parcours ; chaque parcours liste ses rooms ; plan du site XML complet ; `robots.txt` n'interdit que `/wp-admin/` | 🔧 |
| 3 | Contenu servi par le serveur | La leçon, le résumé, la vidéo et **la liste des étapes de la room** sont dans le HTML servi (un robot sans JavaScript les lit) | 🔧 |
| 4 | HTML sémantique | 1 `h1` + 4 `h2` par room (leçon, tâches, machine, terminal), `main`, `article`, `nav`, `header` | 🔧 |
| 5 | JavaScript non bloquant | Le JavaScript n'ajoute que le confort ; la page est complète sans lui (la liste des étapes est même doublée en `<noscript>`) | ✅ |
| 6 | Peu de contenu en double | Chaque langue se déclare elle-même (adresse canonique), les versions sont liées (hreflang) **et le titre affiché suit la langue** | 🔧 |
| 7 | Adresses de langue valides | Les adresses FR / AR / EN et la version de repli sont en **adresse absolue** | 🔧 |
| 8 | Données structurées | `Organization`, `LearningResource`, `VideoObject`, `BreadcrumbList` (et `Course` sur les parcours), en JSON valide | 🔧 |
| 9 | Vidéo déclarée | Durée, miniature, adresse de lecture et licence déclarées — même si l'élève ne clique jamais sur la façade | 🔧 |
| 10 | Expérience de page (rapidité, mobile) | Page légère (HTML < 300 Ko), pas de vidéo chargée avant le clic, design responsive, contrastes conformes (8,5:1 à 16:1) | ✅ |
| 11 | `llms.txt` | Fourni, mais **généré à partir du contenu réel** — donc jamais faux. Sans effet pour Google (son guide le dit), utile pour les autres moteurs d'IA | 🔧 |
| 12 | Découpage « en morceaux » pour l'IA | Aucun découpage artificiel : le texte est en paragraphes et sections naturelles | ⛔ |
| 13 | Réécriture du contenu pour l'IA | Aucune : les textes sont écrits pour les élèves, avec leur ton | ⛔ |
| 14 | Mesure | Search Console à connecter ; suivi des impressions IA et des clics (voir chapitre 6) | 📌 |
| 15 | Agents (DOM / affichage / arbre d'accessibilité) | Arborescence de titres cohérente, `aria-label` sur les zones, liens de langue lisibles, navigation au clavier testée | ✅ |
| 16 | Pagination et Performance | Sitemap à soumettre et pages à faire explorer | 📌 |

---

## 4. Les corrections faites (v0.7.0)

### 4.1 Le maillage interne — l'écart le plus grave, et le moins visible

Un audit précédent vérifiait la *structure* du site (balises, données structurées) mais pas la question essentielle : **un robot peut-il atteindre les rooms ?**

La réponse était non. Les 52 rooms n'étaient atteignables que par le plan du site. Un visiteur non connecté ne trouvait aucun lien ; l'accueil affichait le texte de démonstration de WordPress (« Bonjour tout le monde ! ») ; la page d'un parcours affichait « Lire la suite » et zéro lien.

| Avant | Après |
|---|---|
| Accueil = « Bonjour tout le monde ! », **0 lien** vers une room | Accueil = la page « Parcours », **52 liens** vers les rooms et **4** vers les parcours |
| Page de parcours = extrait + « Lire la suite » | Page de parcours = **6 à 22 rooms listées**, chacune avec un vrai lien |
| Catalogue public (visiteur non connecté) = cartes sans lien | Catalogue public = chaque carte est un lien vers sa room |
| `/parcours/` = page d'erreur 404 | `/parcours/` sert la page « Parcours » (le menu du thème la visait, elle n'existait pas) |
| Gabarit de parcours | `single-secura_path.php` créé (le thème retombait sur `index.php`) |
| — | Gabarit `404.php` créé : une page d'erreur propose les parcours et les rooms |

Vérification mesurée : **52 rooms sur 52** sont liées depuis un parcours. Le script `scripts/audit/verif-maillage.php` le contrôle en téléchargeant les pages comme un robot.

### 4.2 Les robots d'IA, nommés un par un

Le fichier `robots.txt` était ouvert à tous (`User-agent: *`), mais ne nommait **aucun** robot : rien n'y disait « lisez-moi, citez-moi ». Il est maintenant écrit par le plugin (donc toujours à jour, avec la bonne adresse du site) et comporte trois sections :

| Section | Robots | Effet |
|---|---|---|
| 1. Tous les robots | `*` | Ouverture générale, seules les zones privées sont fermées |
| 2. Recherche et citation | Googlebot, Bingbot, OAI-SearchBot, ChatGPT-User, Claude-SearchBot, Claude-User, PerplexityBot, Perplexity-User, Applebot, Amazonbot, Meta-ExternalAgent | Ce sont eux qui permettent au site d'être **cité** dans une réponse |
| 3. Entraînement | GPTBot, ClaudeBot, anthropic-ai, Google-Extended, Applebot-Extended, CCBot, Bytespider, cohere-ai, omgilibot, YouBot | Ils apprennent avec le contenu : utile pour la visibilité, **sans effet** sur la citation |

Jamais de `Disallow: /` global. Le plan du site est déclaré. `/wp-admin/`, `/wp-login.php`, `/wp-json/` et les pages de recherche restent fermés.

### 4.3 `llms.txt`, généré et jamais faux

C'est une demande explicite du propriétaire, distincte du guide Google (qui dit que le fichier n'apporte rien à Google). Il est donc fourni — mais **généré à partir du contenu réel** : chaque parcours et chaque room y figurent avec leur vraie adresse et leur vrai résumé. Un fichier écrit à la main serait devenu faux à la première modification de contenu ; celui-ci ne peut pas l'être.

### 4.4 Les versions traduites : le titre suit la langue, et le texte est vraiment traduit

Un défaut invisible mais lourd de conséquences : sur la page **arabe**, le titre affiché était en arabe, mais la balise `<title>` et la description<meta> étaient restées **en français**. Google compare le titre annoncé au texte visible : quand ils diffèrent de langue, la page arabe passe pour un doublon de la page française — et n'est pas indexée.

Plus grave, l'audit a trouvé **37 chaînes de traduction dégradées** (traduction automatique bâclée) et **2 extraits français corrompus** :

| Problème | Exemple | Correction |
|---|---|---|
| Extrait français corrompu | « il travaille dans une dozen de cases àDisposed très vite » | « il travaille dans une douzaine de cases qu'on oublie aussitôt » |
| Mot anglais dans un texte français | « le navigateur mélange sometimes les sites » | « le navigateur mélange parfois les sites » |
| Extrait arabe = extrait français | 11 rooms (les ceintures et les briefs) | Traduits en arabe |
| Extrait anglais = extrait français | 11 rooms | Traduits en anglais |
| Titre arabe à moitié français | « الحزام blanche: lire, chercher, comprendre » | « الحزام الأبيض: اقرأ، ابحث، افهم » |
| Titre anglais à moitié français | « The blanche belt: lire, chercher, comprendre » | « White belt: read, search, understand » |

**72 corrections** ont été appliquées, par un script (`scripts/audit/fix-traductions.py`) qui vérifie chaque ancre et refuse de modifier un fichier s'il ne trouve pas exactement ce qu'il cherche. Les acronymes techniques (HTTPS, CSRF, TLS, ASLR, NX, canary, OWASP, `printf`, `%s`, `P@ssw0rd!`) sont **conservés en latin** : c'est la bonne pratique — on ne traduit pas un nom de technologie.

### 4.5 La page d'accueil, l'archive d'auteur et l'image de partage

| Avant | Après |
|---|---|
| Accueil = billet de démonstration de WordPress | Accueil = la page « Parcours », **créée automatiquement** à l'installation du plugin |
| « Page d'exemple » publiée (indexable, vide de sens) | Passée en brouillon |
| « Bonjour tout le monde ! » publié | Passé en brouillon |
| `/author/admin/` en ligne : **le nom du compte d'administration exposé**, et les rooms dupliquées | L'archive d'auteur répond « page introuvable », et le plan du site ne liste plus les utilisateurs |
| Aucune image de partage | Un visuel par défaut (1200×630) livré avec le thème, utilisé si l'enseignant n'a pas mis d'icône ; `og:image` et `twitter:image` toujours déclarés |

La création de la page d'accueil est **prudente** : elle ne touche jamais à un contenu écrit par l'enseignant, et elle ne force rien si le site a déjà été configuré.

### 4.6 Les autres corrections de la v0.6.0 (inchangées)

Adresses de langue absolues, adresse canonique unique et auto-référente, données structurées schema.org, liste des étapes en HTML simple, titres de section réels.

---

## 5. Ce qu'il ne faut PAS faire (les mythes que Google a démontés)

| Idée reçue | Ce que dit Google | Ce que nous faisons |
|---|---|---|
| « Il faut un fichier `llms.txt` pour l'IA » | Non : aucun effet démontré sur l'indexation ni sur les réponses générées | On le fournit quand même (demande du propriétaire), mais **généré**, et sans en faire une-version-pour-l'IA |
| « Il faut un robot spécial pour les AI Overviews » | Non : c'est `Googlebot`, le robot de la recherche classique | On autorise `Googlebot` explicitement, et on distingue les robots de citation des robots d'entraînement |
| « Autoriser `Google-Extended` suffit pour être cité » | Non : `Google-Extended` sert à l'entraînement et à l'ancrage dans les *autres* systèmes Google | On ne compte pas là-dessus : on travaille le maillage et le contenu |
| « Il faut découper le texte en morceaux pour l'IA » | Non : c'est le moteur qui découpe, et un texte mal découpage nuit à tout le monde | Texte en sections naturelles, avec des titres |
| « Il faut réécrire le contenu pour l'IA » | Non : le contenu doit rester utile aux personnes | Aucun texte réécrit « pour l'IA » |
| « Il faut des données structurées, sinon on est exclu » | Non : elles sont recommandées, pas obligatoires ; leur absence n'empêche pas d'être indexé | Elles sont présentes, en plus |
| « Il faut une version « IA » du site » | Non : une seule version, la meilleure possible | Une seule version, en 3 langues |

---

## 6. Ce qui reste à faire au moment de la mise en ligne (impossible avant, le site n'est pas public)

1. **Connecter la Search Console** au domaine, et envoyer le `wp-sitemap.xml`.
2. **Demander l'indexation** des pages principales (accueil, 4 parcours, rooms principales).
3. **Suivre les impressions IA.** Depuis le 3 juin 2026, Google a mis en place un rapport « Generative AI performance » (généralisé à tous les sites le 31 août 2026). Il montre **les impressions** — c'est-à-dire le nombre de fois où le site apparaît dans une réponse générée. **Les clics restent dans le rapport « Performance » (rubrique « Web »)**, comme pour la recherche classique : ne pas confondre les deux tableaux.
4. **Vérifier la Search Console → Pages indexées** : le nombre doit monter, et non rester bloqué à 1.
5. **Tester les agents** : avec un agent de navigation (ou une extension de type « AI reader »), vérifier que la page se lit et que le sélecteur de langue fonctionne.

> Ce qu'aucun audit local ne peut garantir : l'indexation réelle, la présence effective dans un AI Overview, les Core Web Vitals sur un vrai appareil, et le fait qu'un modèle cite un jour le site. Ces quatre choses se mesurent **après** la mise en ligne, dans la Search Console et dans le rapport de performance.

---

## 7. Comment vérifier que ça ne retombe pas

Le contrôle est automatique : à chaque push sur GitHub, l'auditeur « SEO » relit le site **dans un vrai WordPress** (base de données, PHP 8.3, MySQL) et échoue si un point régresse.

```bash
# en local
SECA_WP_DIR=/tmp/wp-u2 WP_CLI="php /home/user/wp-cli.phar" bash scripts/audit/run-audits.sh

# le maillage interne, mesuré comme un robot
php scripts/audit/verif-maillage.php http://localhost:8080
```

La section **8. Les robots d'IA et le maillage interne** du rapport SEO contrôle 10 points : robots d'IA nommés dans `robots.txt`, robots d'IA autorisés, plan du site déclaré, liens vers les rooms sur l'accueil, liens vers les parcours, chaque parcours listant ses rooms, titre arabe suivant la langue, aucune version restée en français, archive d'auteur fermée, image de partage déclarée.

Le workflow `audit.yml` est une **barrière** : si un de ces points redevient non conforme, la mise en ligne automatique est bloquée.

---

## 8. En résumé

| | Avant | Après |
|---|---|---|
| Contrôles SEO dans l'auditeur | 20 (puis 35) | **45** |
| Constats (bloquant / majeur / mineur) | 0 | **0** |
| Rooms atteignables par liens internes | **0 sur 52** | **52 sur 52** |
| Accueil | « Bonjour tout le monde ! » | La page « Parcours », créée automatiquement |
| Robots d'IA nommés dans `robots.txt` | aucun | 20 robots, en deux sections (citation / entraînement) |
| `llms.txt` | absent | généré à partir du contenu réel |
| Titre de la page arabe | en français | dans la langue affichée |
| Chaînes de traduction dégradées | 37 + 2 extraits français corrompus | **0** (72 corrections appliquées) |
| Archive `/author/admin/` | ouverte | fermée (404), absente du plan du site |
| Image de partage | absente | visuelle par défaut, `og:image` + `twitter:image` |
| Adresse canonique | absente | présente, absolue, unique, propre à chaque langue |
| Adresses de langue | relatives | absolues (4 versions déclarées) |
| Données structurées | aucune | 5 types (Organization, LearningResource, VideoObject, BreadcrumbList, Course) |
| Titres de section dans une room | aucun | 4 (`h2`) |
| Étapes de la room visibles sans JavaScript | non | oui |

*Documentation rédigée par l'agent, vérifiée sur les pages réellement servies (HTML récupéré en HTTP, pas la lecture du code source).*
