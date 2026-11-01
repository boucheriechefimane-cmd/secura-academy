# Conformité au guide Google « Optimizing your website for generative AI features on Google Search »

**Date :** 1er novembre 2026
**Version :** v0.6.0 (le site fonctionne en ligne sur la machine de recette ; les mêmes fichiers sont poussés sur GitHub)
**Objet :** vérifier point par point que la plateforme est conforme au guide officiel de Google sur les réponses générées par l'IA (AI Overviews et AI Mode), corriger ce qui ne l'est pas, et empêcher que cela retombe.

---

## 1. En une phrase

**Oui, le site est conforme**, parce que Google dit lui-même que les réponses générées par l'IA s'appuient sur le même index que la recherche classique : ce qui compte, c'est une page **explorable**, **compréhensible**, **sans doublon** et **rapide** — pas une page « écrite pour l'IA ». Trois points n'étaient pas conformes et ont été corrigés : les adresses de langue en version relative, l'absence d'adresse canonique, et l'absence de données structurées. Ils sont désormais vérifiés automatiquement à chaque mise en ligne.

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
| Il faut **peu de contenu en double** | Les versions FR / AR / EN doivent se déclarer mutuellement |
| Les **données structurées** (schema.org) sont **recommandées**, pas obligatoires | Déclarer ce qu'est une room, une vidéo, un parcours : utile, et sans risque |
| **Pas besoin** de `llms.txt`, de découpage « en morceaux », ni de réécriture pour l'IA | Google traite ces idées comme des mythes : on ne les fait pas |
| Mesurer avec la **Search Console** (rapport « Generative AI performance ») | À faire au moment de la mise en ligne, quand le site est public |
| Les **agents** (navigateurs autonomes) lisent le DOM, l'affichage et l'**arbre d'accessibilité** | Nos titres, nos libellés et nos liens doivent être lisibles par une machine |

---

## 3. Le audit point par point

Légende : ✅ **conforme** — 🔧 **écart corrigé** cette semaine — 📌 **à faire à la mise en ligne** — ⛔ **sans objet** (le guide dit que ce n'est pas nécessaire).

| # | Point du guide | Ce que fait le site aujourd'hui | Verdict |
|---|---|---|---|
| 1 | Contenu original, non interchangeable | 52 rooms rédigées à la main, 4 parcours, 22 rooms issues de contenus universitaires libres (MIT OCW, pwn.college) avec attribution ; aucune page « gabarit » vide | ✅ |
| 2 | Page explorable (liens, plan) | Menu, fil d'Ariane, parcours, rooms, plan du site ; sitemap XML présent ; `robots.txt` n'interdit que `/wp-admin/` | ✅ |
| 3 | Contenu servi par le serveur | La leçon, le résumé, la vidéo et **la liste des étapes de la room** sont dans le HTML servi (un robot sans JavaScript les lit) | 🔧 |
| 4 | HTML sémantique | 1 `h1` + 4 `h2` par room (leçon, tâches, machine, terminal), `main`, `article`, `nav`, `header` | 🔧 |
| 5 | JavaScript non bloquant | Le JavaScript n'ajoute que le confort ; la page est complète sans lui (la liste des étapes est même doublée en `<noscript>`) | ✅ |
| 6 | Peu de contenu en double | Chaque langue se déclare elle-même (adresse canonique) et les versions sont liées (hreflang) | 🔧 |
| 7 | Adresses de langue valides | Les adresses FR / AR / EN et la version de repli sont en **adresse absolue** | 🔧 |
| 8 | Données structurées | `Organization`, `LearningResource`, `VideoObject`, `BreadcrumbList` (et `Course` sur les parcours), en JSON valide | 🔧 |
| 9 | Vidéo déclarée | Durée, miniature, adresse de lecture et licence déclarées — même si l'élève ne clique jamais sur la façade | 🔧 |
| 10 | Expérience de page (rapidité, mobile) | Page légère (HTML < 300 Ko), pas de vidéo chargée avant le clic, design responsive, contrastes conformes (8,5:1 à 16:1) | ✅ |
| 11 | `llms.txt` | Aucun fichier `llms.txt` : le guide indique que cela n'apporte rien | ⛔ |
| 12 | Découpage « en morceaux » pour l'IA | Aucun découpage artificiel : le texte est en paragraphes et sections naturelles | ⛔ |
| 13 | Réécriture du contenu pour l'IA | Aucune : les textes sont écrits pour les élèves, avec leur ton | ⛔ |
| 14 | Mesure | Search Console à connecter + rapport « Generative AI performance » à suivre | 📌 |
| 15 | Agents (DOM / affichage / arbre d'accessibilité) | Arborescence de titres cohérente, `aria-label` sur les zones, liens de langue lisibles, navigation au clavier testée | ✅ |
| 16 | Pagination et Performance | Sitemap à soumettre et pages à faire explorer | 📌 |

---

## 4. Les corrections faites (v0.6.0)

### 4.1 Les adresses de langue en version absolue

Google ignore une adresse relative dans `hreflang` : le moteur ne comprend pas de quelle page il s'agit et peut ignorer les versions traduites.

- **Avant :** `hreflang="ar" href="/rooms/…/?seca_lang=ar"`
- **Après :** `hreflang="ar" href="https://…/rooms/…/?seca_lang=ar"`

### 4.2 L'adresse canonique, propre à chaque langue

C'est le point le plus important du lot. Sans elle, la version arabe ressemble à un doublon de la version française : Google risque de n'en indexer qu'une.

- Chaque page se déclare **elle-même** : la page française renvoie vers l'adresse française, la page arabe vers l'adresse arabe.
- La canonique de WordPress (qui ignorait la langue) a été retirée pour ne garder qu'une seule adresse canonique par page.

### 4.3 Les données structurées (schema.org)

Un nouveau fichier `class-secura-schema.php` décrit la plateforme :

| Élément | Ce qu'il dit |
|---|---|
| `Organization` | Le site, son nom, son adresse |
| `LearningResource` | Une room : nom, résumé, durée (`PT20M`), niveau, langue, gratuité |
| `VideoObject` | Le cours vidéo : nom, durée (`PT9M43S`), miniature, adresse de lecture, éditeur, licence |
| `BreadcrumbList` | Le chemin : Accueil → Parcours → Room |
| `Course` | Une page de parcours |

### 4.4 La liste des étapes en HTML simple

Les étapes pratiques d'une room étaient dessinées par le JavaScript. Un robot sans JavaScript ne voyait donc pas le cœur du cours. La liste est maintenant présente dans le HTML (et doublée dans un `<noscript>` pour les élèves sans JavaScript).

### 4.5 Des titres de section réels

La leçon, les tâches, la machine cible et le terminal sont maintenant des titres de niveau 2 : c'est le repère que suivent les lecteurs d'écran, les agents et les modèles qui découpent la page pour y répondre.

---

## 5. Ce qu'il ne faut PAS faire (les mythes que Google a démontés)

| Idée reçue | Ce que dit Google | Ce que nous faisons |
|---|---|---|
| « Il faut un fichier `llms.txt` » | Non : aucun effet démontré sur l'indexation ni sur les réponses générées | Aucun fichier |
| « Il faut découper le texte en morceaux pour l'IA » | Non : c'est le moteur qui découpe, et un texte mal découpé nuit à tout le monde | Texte en sections naturelles, avec des titres |
| « Il faut réécrire le contenu pour l'IA » | Non : le contenu doit rester utile aux personnes | Aucun texte réécrit « pour l'IA » |
| « Il faut des données structurées, sinon on est exclu » | Non : elles sont recommandées, pas obligatoires ; leur absence n'empêche pas d'être indexé | Elles sont présentes, en plus |
| « Il faut une version « IA » du site » | Non : une seule version, la meilleure possible | Une seule version, en 3 langues |

---

## 6. Ce qui reste à faire au moment de la mise en ligne (impossible avant, le site n'est pas public)

1. **Connecter la Search Console** au domaine, et envoyer le `sitemap.xml`.
2. **Demander l'indexation** des pages principales (accueil, 4 parcours, 22 rooms principales).
3. **Suivre le rapport « Generative AI performance »** : c'est là que Google dira quelles questions amènent des élèves vers le site, et quelles pages ne sont jamais citées. C'est le tableau de bord à regarder chaque mois.
4. **Vérifier la Search Console → Pages indexées** : le nombre doit monter, et non rester bloqué à 1.
5. **Tester les agents** : avec un agent de navigation (ou une extension de type « AI reader »), vérifier que la page se lit et que le sélecteur de langue fonctionne.

---

## 7. Comment vérifier que ça ne retombe pas

Le contrôle est automatique : à chaque push sur GitHub, l'auditeur « SEO » relit le site **dans un vrai WordPress** (base de données, PHP 8.3, MySQL) et échoue si un point régresse.

```bash
# en local
SECA_WP_DIR=/tmp/wp-u2 WP_CLI="php /home/user/wp-cli.phar" bash scripts/audit/run-audits.sh
```

La section **7. Les réponses générées par l'IA** du rapport SEO contrôle 15 points : indexabilité, contenu servi, canonique présente / absolue / unique / auto-référente, hreflang absolus et complets, données structurées valides, ressource d'apprentissage déclarée, vidéo déclarée et complète, absence de `llms.txt`, poids de la page, présence de sections.

Le workflow `audit.yml` est une **barrière** : si un de ces points redevient non conforme, la mise en ligne automatique est bloquée.

---

## 8. En résumé

| | Avant | Après |
|---|---|---|
| Contrôles SEO dans l'auditeur | 20 | **35** |
| Constats (bloquant / majeur / mineur) | 0 | **0** |
| Adresse canonique | absente | présente, absolue, unique, propre à chaque langue |
| Adresses de langue | relatives | absolues (4 versions déclarées) |
| Données structurées | aucune | 5 types (Organization, LearningResource, VideoObject, BreadcrumbList, Course) |
| Titres de section dans une room | aucun | 4 (`h2`) |
| Étapes de la room visibles sans JavaScript | non | oui |
| Mythes appliqués (`llms.txt`, découpage, réécriture) | aucun | aucun |

*Documentation rédigée par l'agent, vérifiée sur les pages réellement servies (HTML récupéré en HTTP, pas la lecture du code source).*
