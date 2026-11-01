# Le registre d'audit

> Le registre tenu par le comité d'audit externe : qui a audité, quand,
> ce qu'il a trouvé, ce qui a été fait, et ce qui reste ouvert.

État : 01/11/2026 · version v0.7.0

---

## 1. Le tableau de bord

| Auditeur | Contrôles | Bloquant | Majeur | Mineur | Verdict |
|---|---|---|---|---|---|
| SEO | 45 | 0 | 0 | 0 | **Conforme** |
| Contenu | 18 | 0 | 0 | 0 | **Conforme** |
| UX / UI | 16 | 0 | 0 | 0 | **Conforme** |
| Développement | 14 | 0 | 0 | 0 | **Conforme** |
| Sécurité & infra | 25 | 0 | 0 | 0 | **Conforme** |
| **Total** | **118** | **0** | **0** | **0** | **Conforme** |

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
| Le dojo pwn.college officiel n'est pas construit en CI | Son image est trop lourde | À faire sur le VPS, quand il existera |
| Les labs M7 sont volontairement difficiles | C'est le palier 3 | Un parcours d'échauffement avant le dojo, à évaluer après usage |
| Les vidéos de brief sont en anglais | Les cours originaux sont des sources anglaises | Les leçons écrites sont, elles, traduites AR/EN |
| Pas de mesure de performance (Core Web Vitals) | Nécessite un vrai trafic | À installer quand le site sera en ligne |
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
