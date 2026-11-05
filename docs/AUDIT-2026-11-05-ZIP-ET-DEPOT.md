# Audit — ZIP `secura-academy-COMPLET` et dépôt GitHub

**Date :** 05/11/2026
**Périmètre :** le ZIP livré sur Google Drive (1 648 fichiers, 10,2 Mo, modifié le 04/11/2026 à 23:49) — `sources/`, `handoff/`, `livrables/` et `docs/audits/` (159 rapports) — et le dépôt `boucheriechefimane-cmd/secura-academy` (branche `main`, commit `da510ef`).
**Méthode :** lecture des 18 auditeurs et de leurs rapports, comparaison fichier par fichier ZIP ↔ dépôt, revue statique du code PHP/Docker/CI, **exécution réelle** des deux suites de tests dans un interpréteur PHP compilé en WebAssembly (`php-wasm`), analyse de l'historique des workflows GitHub.

> Ce rapport décrit l'état observé lors de l'audit initial, avant la fusion sélective.
> Des erreurs factuelles ont été corrigées après une revue plus approfondie : les
> quatre classes du ZIP sont des prototypes non chargés, les quatre dossiers
> supplémentaires de labs sont des copies, et le décompte initial des drapeaux
> était erroné. L'état après intervention et les limites des tests figurent dans
> [`FUSION-ZIP-2026-11-05.md`](FUSION-ZIP-2026-11-05.md). Les campagnes
> d'audit historiques restent inchangées.

---

## 1. Verdict en une page

**La plateforme est de bonne qualité technique ; le dépôt GitHub n'est pas l'état livré, et la CI ne le prouve plus.**

| # | Constat | Gravité |
|---|---|---|
| 1 | **Le ZIP diffère de GitHub** : 4 classes PHP neuves (1 194 lignes : certificats, examens chronométrés, fronts), 4 dossiers de labs supplémentaires, 54 rapports supplémentaires, 2 sondes d'audit et une roadmap n'existaient **que** dans le ZIP. Les classes et labs supplémentaires ne sont pas validés | Bloquant pour la traçabilité |
| 2 | **Même numéro de version (0.12.7) pour deux codes différents** — impossible de savoir ce qui est déployé | Majeur |
| 3 | **La CI ne démarre plus** : les 5 workflows déclenchés sur `push` échouent en **3 à 10 secondes**, sans exécuter une seule étape (quota du compte) | Majeur |
| 4 | **Le harnais d'audit se contredit** : des constats « bloquants » apparaissent dans le rapport sans être comptés, donc **sans faire échouer la barrière** | Majeur |
| 5 | **Les constats bloquants du 04/11 sont en majorité des artefacts d'environnement** (thème non actif, site servi sous `/wp/`, `academy.css` en 404) : le code du dépôt corrige déjà la moitié de ces points | Majeur |
| 6 | **Deux constats de fond réels** : licences vidéo (16 vidéos en « YouTube Standard License », 16 sans institution) et 52 objets JSON-LD qui déclarent un titre anglais absent du texte visible | Majeur |
| 7 | **Le code neuf n'est pas testé** : `tests/smoke-test.php` est identique dans le ZIP et dans le dépôt — les 1 194 nouvelles lignes ne sont couvertes par aucune assertion | Majeur |
| 8 | **Pas de `LICENSE`, ni `SECURITY.md`, ni `CONTRIBUTING.md`** dans un dépôt public qui enseigne la cybersécurité et le droit d'auteur | Majeur |
| 9 | **La documentation dérive du code** : README annonce 250 assertions (réel : 331), 6 rooms (réel : 52), « pas de vrais labs » (le ZIP contient 11 Dockerfiles, dont des copies non validées) | Mineur |
| 10 | **Deux « constitutions » concurrentes** : `docs/ROADMAP.md` (1 021 lignes) et `ROADMAP-QUALITE-PREMIUM-ANGLAIS.md` (187 lignes) qui se déclare elle aussi « la constitution » | Mineur |

**Ce qui est solide, et qu'il faut dire aussi :** 132 fichiers PHP sans une seule erreur de syntaxe ; 11 endpoints AJAX tous protégés (nonce + session) ; aucune requête SQL non préparée ; exécution Docker par `proc_open` en forme tableau (jamais de shell) ; durcissement des conteneurs réel (`cap_drop: ALL`, `no-new-privileges`, `pids_limit`, `mem_limit`, réseau `internal`) ; aucun secret en clair ; et un harnais de test de **331 assertions** qui tourne sans WordPress.

---

## 2. Ce que le ZIP contient, et ce que le dépôt n'a pas

### 2.1 Structure du ZIP

| Dossier | Contenu | Statut |
|---|---|---|
| `sources/` | L'arborescence de travail complète (1 631 fichiers) | Partiellement dans le dépôt |
| `livrables/` | 5 archives prêtes à livrer : `wordpress`, `recette`, `plugin`, `labs`, `learning-theme` | Absent du dépôt (normal, `*.zip` est gitignoré) |
| `handoff/` | 10 documents de passation (installation, développement, contribution, labs, release, dépannage, audits, `.env.example`, `docker-compose.dev.yml`) | **Absent du dépôt** |
| racine | `README-DEVELOPPEUR.md` | **Absent du dépôt** |

### 2.2 L'écart mesuré avec `main`

| Mesure | Valeur |
|---|---|
| Fichiers présents **uniquement dans le ZIP** | **377** |
| Fichiers **différents** entre ZIP et dépôt | **101** |
| Fichiers présents uniquement dans le dépôt | 3 (`.github/`, `.gitignore`, `labs/juice-shop/flags`) |
| Dernier `push` GitHub | 04/11/2026 17:10 UTC |
| Date du ZIP | 04/11/2026 23:49 UTC — **6 h 40 après le dernier push** |

### 2.3 Les quatre classes absentes de `main` lors de l'audit initial

C'est le point le plus important du rapport.

| Fichier | Lignes | Ce qu'il apporte |
|---|---|---|
| `includes/class-secura-certificate.php` | 431 | Certificats de parcours, numéro vérifiable, PDF généré en PHP pur, médailles bronze/argent/or |
| `includes/class-secura-exam-timed.php` | 407 | Examen chronométré côté serveur (temps restant, soumission, abandon, expiration) |
| `includes/class-secura-exam-front.php` | 227 | Shortcodes `[secura_exam]`, `[secura_certificates]` |
| `includes/class-secura-lab-front.php` | 129 | Bouton de déploiement du lab côté élève |
| `js/exam-front.js`, `js/lab-front.js` | — | Front de l'examen et du lab |

Dans le ZIP, ces classes étaient chargées par le plugin, mais aucune n'était chargée par le harnais de test. Une revue ultérieure a trouvé des défauts de contrat AJAX, d'exposition des réponses et de protection des certificats. Les 1 194 lignes sont conservées pour revue mais **ne sont pas chargées** dans la fusion ; elles ne doivent pas être considérées comme une fonctionnalité prête à l'emploi. Voir `wp-content/plugins/secura-academy/includes/EXPERIMENTAL-ZIP.md`.

### 2.4 Les quatre dossiers de labs absents de `main` lors de l'audit initial

| Machine | Dans le ZIP `sources/labs` | Dans le dépôt |
|---|---|---|
| `secura-lab-blue-firewall` | oui | **non** |
| `secura-lab-blue-log-analysis` | oui | **non** |
| `secura-lab-buffer-overflow` | oui | **non** |
| `web-dvwa` | oui | **non** |
| Total Dockerfiles | 11 | 7 |

Une revue des fichiers a montré que `web-dvwa`, `secura-lab-blue-firewall` et `secura-lab-blue-log-analysis` sont des copies de `multi-01` ; `secura-lab-buffer-overflow` copie `bin-01`. Ces dossiers n'attestent donc pas l'existence de quatre nouveaux scénarios fonctionnels. Ils sont conservés avec avertissement, sans nouveau mapping ni validation Docker.

### 2.5 Le reste de l'écart

- **54 rapports d'audit** du 04/11 (18 catégories × 3 formats) : le dépôt s'arrête au 02/11 (105 fichiers). Les preuves de la dernière campagne n'ont jamais été archivées.
- **2 sondes d'audit** neuves : `scripts/audit/probe-contenu.php`, `scripts/audit/mesure-contenu.php`.
- **Correction du décompte des fichiers de labs :** le chiffre initial « 301 fichiers gitignorés à dessein » n'était pas étayé. Lors de la fusion, 520 drapeaux copiés en double ont été retirés ; les drapeaux pédagogiques suivis nécessaires aux scénarios historiques ont été conservés. Voir `labs/README.md`.
- **49 lots de questions** (`tools/lots/*.json`) et **49 fichiers du plugin** (`content-import-*.php`) différents : la campagne de récolte du 04/11 après 17 h.
- `tools/lots-origine-sauvegarde/`, `tools/lots/cleaned/`, `tools/lots/recovered/` : sauvegardes intermédiaires, absentes du dépôt (souhaitable).
- `handoff/` : **le dépôt n'a aucune documentation opérationnelle de passation** — ni installation, ni développement, ni contribution, ni release. Le seul document approchant est `docs/PASSATION-SECURA-ARENA.md`.

---

## 3. Les 18 audits du 04/11 — lecture critique

### 3.1 Les verdicts

| Auditeur | Contrôles OK | B | M | m | i | Verdict annoncé |
|---|---|---|---|---|---|---|
| securite | 25 | 0 | 0 | 0 | 0 | Conforme |
| contenu | 20 | 0 | 0 | 0 | 3 | Conforme avec observations |
| dev | 17 | 0 | 0 | 0 | 3 | Conforme avec observations |
| pedagogie | 12 | 0 | 0 | 0 | 2 | Conforme avec observations |
| devops | 12 | 0 | 0 | 0 | 2 | Conforme avec observations |
| accessibilite | 8 | 0 | 0 | 2 | 2 | Conforme avec observations |
| rgpd | 8 | 0 | 0 | 0 | 3 | Conforme avec observations |
| onboarding | 8 | 0 | 1 | 0 | 2 | Réserves |
| donnees-structurees | 6 | 0 | 1 | 0 | 7 | Réserves |
| moteur | 6 | 0 | 0 | 0 | 3 | Conforme avec observations |
| performance | 6 | 0 | 0 | 0 | 1 | Conforme avec observations |
| multilingue | 6 | 1 | 1 | 0 | 2 | **Non conforme** |
| epreuves | 16 | 0 | 0 | 1 | 6 | Conforme avec observations |
| licences | 5 | 1 | 0 | 0 | 5 | **Non conforme** |
| ux | 15 | 0 | 0 | 0 | 2 | Conforme avec observations |
| seo | 31 | 0 | 2 | 0 | 0 | Réserves |
| drapeaux | 3 | 0 | 0 | 0 | 3 | Conforme avec observations |
| panel-eleves | **0** | 0 | **5** | 0 | 3 | **Réserves** |

### 3.2 Le bug du harnais : un constat bloquant qui ne bloque rien

`scripts/audit/audit-lib.php`, fonction `audit_verifier()` (lignes 113-166) :

```
si la condition est fausse :
    si le constat n'a PAS de preuve :
        on l'ajoute à constats[]      ← il apparaîtra dans le rapport
        on incrémente « non étayé »
        on sort                        ← mais le compteur « bloquant » n'est PAS incrémenté
    sinon :
        on l'ajoute à constats[]
        on incrémente le compteur « bloquant »   ← seulement ici
```

Or `audit_fin()` termine par `exit( ($a['bloquant'] > 0 || $a['majeur'] > 0) ? 1 : 0 )`, et `run-audits.sh` compte les codes de sortie.

**Conséquence :** un constat de gravité « bloquant » dont la preuve est vide **s'affiche en rouge dans le rapport** (« ### Bloquant (1) ») **mais ne fait pas échouer la CI**, et l'en-tête du rapport annonce « Constats : 0 bloquant(s) » puis conclut « Aucun constat bloquant ni majeur ».

C'est exactement ce qui s'est produit le 04/11 :

| Rapport | Ce que dit la section | Ce que dit l'en-tête | Ce que dit le verdict |
|---|---|---|---|
| `dev-2026-11-04` | « ### Bloquant (1) : la suite de tests interne passe — 327 réussis, 4 échecs » | 0 bloquant | « Aucun constat bloquant ni majeur » |
| `ux-2026-11-04` | « ### Majeur (1) : le sélecteur de langue » | 0 majeur | « Aucun constat bloquant ni majeur » |
| `seo-2026-11-04` | « ### Bloquant (1) » + « ### Majeur (10) » + « Mineur (4) » | 0 bloquant, 2 majeurs | « Réserves » |

**4 tests en échec et une dizaine de majeurs SEO sont donc passés sous la barrière.** C'est un défaut de conception du harnais, pas des auditeurs : la règle « un constat sans preuve n'est pas un constat » est bonne, mais elle doit alors **exclure le constat du rapport** ou **le compter comme bloquant**, pas le montrer en rouge en le retirant du décompte.

**Correctif proposé (2 lignes) :** dans `audit_verifier()`, un constat non étayé ne doit pas être poussé dans `constats[]` ; il doit aller dans une liste `constats_non_etayes[]` rendue dans une section « ### Non étayé (n) », et `audit_fin()` doit sortir en code 1 dès qu'un constat non étayé existe de gravité bloquante ou majeure.

### 3.3 Les artefacts d'environnement : le 04/11 a audité un autre site

Trois preuves convergentes :

1. **`multilingue`** : `academy.css` renvoie **404** sur `http://localhost:8080/wp/wp-content/plugins/...` — le site est servi dans un sous-répertoire `/wp/` et le plugin n'y est pas à l'emplacement attendu.
2. **`accessibilite`** : « 52 pages sans `dir` ». Or `wp-content/themes/secura-learning/header.php:9` écrit `dir="<?php echo esc_attr( secures_learning_direction() ); ?>"`. **Le thème du dépôt le fait déjà.**
3. **`seo`** : « pas de meta description, pas d'Open Graph, pas de carte Twitter, pas de hreflang ». Or le thème les génère (`functions.php` lignes 154-215), y compris le sélecteur de langue en vrais liens (`<a class="site-lang__link" hreflang=…>`) que l'audit dit absent. De même `class-secura-robots.php` cite bien Googlebot, OAI-SearchBot, ChatGPT-User et le plan de site — l'audit reçoit un **404** sur `robots.txt`.

**Interprétation :** le 04/11, WordPress tournait avec un autre thème (ou le thème en place n'était pas celui du dépôt) et sans permaliens. Les constats SEO/accessibilité/multilingue de cette campagne décrivent **le site de recette, pas le code livré**.

**Mais il en sort une leçon d'architecture qui, elle, est réelle :** les fonctions critiques de SEO et d'accessibilité (`meta description`, Open Graph, Twitter, hreflang, `dir`) vivent **dans le thème**, pas dans le plugin. Changer ou mettre à jour le thème efface silencieusement la moitié de la conformité — et c'est précisément ce que les audits ont mesuré. **Recommandation :** déplacer ce bloc dans le plugin (ou ajouter un repli plugin), et faire échouer l'audit « multilingue » si `dir` ou `hreflang` manquent, au lieu de le déclarer conforme.

### 3.4 Deux faux positifs d'auditeur (à corriger dans les scripts)

| Auditeur | Constat | Pourquoi c'est faux |
|---|---|---|
| `accessibilite` §8 | « 106 commandes sans nom » en citant `<button aria-label="Open menu" …> sans texte` | Le bloc WCAG 2.5.8 (`audit-accessibilite.php:294-311`) ne regarde que le texte vide, **sans tester `aria-label`** — alors que le bloc WCAG 4.1.2 (ligne 116) le teste, et que la preuve du contrôle dit « aucune commande vide sans attribut aria-label ». Ce sont les boutons du bloc de navigation WordPress, qui portent bien un nom accessible. |
| `panel-eleves` | 5 majeurs, dont « 0 élève sur 20 a terminé le parcours — connexion impossible (HTTP 0) » | Les 20 connexions ont échoué en **HTTP 0** : ce n'est pas une mesure du produit, c'est un site injoignable. L'auditeur devrait **refuser de conclure** (« non mesuré ») au lieu de produire 5 majeurs qui polluent le verdict. Même situation pour `drapeaux` (« non joué : connexion ou jeton indisponible »), qui a la bonne attitude. |

### 3.5 Les constats de fond qui méritent d'être traités

| Source | Constat | Pourquoi c'est réel |
|---|---|---|
| `licences` (bloquant) | 16 vidéos déclarées « YouTube Standard License » et 16 cas « institution absente » | Les droits, les conditions YouTube et la possibilité d'intégration doivent être vérifiés au cas par cas. La licence standard ne vaut pas licence générale de republication ; elle ne suffit pas non plus à conclure que tout lecteur intégré est interdit. Documenter l'attribution et suspendre les usages non autorisés. |
| `donnees-structurees` (majeur) | 52 objets `LearningResource`/`VideoObject` déclarent un titre anglais (« Cyber Security Defense Explained ») qui n'apparaît **pas** dans le texte visible (français) | Les données structurées décrivent un contenu que la page ne montre pas : c'est un écart Google (donnée trompeuse) et un risque de pénalité. Il faut soit localiser le `name`, soit ajouter le titre d'origine visible (ce qui sert aussi l'attribution). |
| `epreuves` (mineur) | 7 examens ont un réservoir < 5× la taille de l'épreuve | Réel, mesuré sur les données : les copies se ressemblent trop sur ces 7 examens. |
| `contenu` (info) | 639 questions importées, dont **33 de type « solution »** (l'élève rédige, la correction officielle s'affiche) | Réel et assumé. À vérifier : ces 33 questions ne doivent pas être notées automatiquement. |
| `onboarding` (majeur) | Le contenu de la leçon n'est pas servi au visiteur non connecté, dans 52 rooms sur 52 | À trancher. Le thème du dépôt n'a **aucun** `is_user_logged_in` autour du contenu (`single-secura_room.php:19-23` rend `the_content()` inconditionnellement). Si le site réel masque le contenu, c'est une décision produit non documentée — et elle contredit la roadmap (« site gratuit, route publique »). |

### 3.6 Tendance sur trois jours — et un signal d'alarme

| Date | Audits « conformes » | Constats bloquants | Constats majeurs | Contrôles OK (total) |
|---|---|---|---|---|
| 01/11 | 18 / 18 | 0 | 0 | 222 |
| 02/11 | 18 / 18 | 0 | 0 | 233 |
| 04/11 | 12 / 18 | 2 | 10 | 204 |

**Deux campagnes parfaitement vertes, puis une chute brutale.** Le code n'a pas régressé de moitié en 48 h : l'environnement a changé (§ 3.3). Une suite d'audit dont le résultat dépend à ce point de la configuration du site **n'est pas encore une barrière** : il lui manque un contrôle d'installation (thème attendu actif, URL de base, permaliens, `academy.css` joignable) qui, s'il échoue, **annule la campagne** au lieu de produire des constats.

---

## 4. Audit du dépôt

### 4.1 Architecture

| Élément | Mesure |
|---|---|
| Code PHP | 56 970 lignes, 132 fichiers |
| Plugin | 17 fichiers `class-*.php` + 49 fichiers `content-import-*.php` (environ 2,9 Mo de contenu en PHP) |
| Thème | 13 fichiers, `header/footer/functions` + gabarits `secura_room`, `secura_path` |
| Labs | 9 dossiers, 7 Dockerfiles, 3 `docker-compose.yml` |
| Outils | 61 fichiers Python (récolte OCW, imports, criblage) |
| Docs | 41 documents, 1,7 Mo |

**Le point faible d'architecture :** le contenu pédagogique (2 283 questions mesurées par l'auditeur `epreuves`, 2,9 Mo) est **du code PHP** — un fichier par cours, généré. Cela rend le plugin lourd, le diff illisible, et toute correction de contenu indissociable d'une livraison de code. Un stockage en JSON/WP-CLI d'import (comme le font déjà `tools/import-questions.py` et `tests/import-test.py`) serait plus sain ; le dépôt a d'ailleurs les deux mécanismes en parallèle.

### 4.2 Sécurité — ce que j'ai vérifié

| Contrôle | Résultat | Preuve |
|---|---|---|
| Syntaxe PHP (132 fichiers) | **0 erreur** | `token_get_all(..., TOKEN_PARSE)` sur tout le dépôt |
| Syntaxe JS (2 fichiers) | 0 erreur | `node --check` |
| Secrets en clair | **aucun** | recherche `api_key`, `AKIA…`, `ghp_…`, clés privées : seules des références `secrets.*` GitHub Actions |
| Requêtes SQL | **aucune non préparée** | 6 appels `$wpdb` ; 4 avec `prepare()`, 2 sur des chaînes statiques (`LAST_INSERT_ID()`, `option_name = 'seca_labs_path'`) |
| Endpoints AJAX | **11/11 protégés** | `check_request()` en tête de chaque gestionnaire : nonce `secura_academy` + `is_user_logged_in()` (403/401 explicites) |
| Exécution de commandes | **pas de shell** | `proc_open()` en forme tableau (`class-secura-lab.php:1139`), jamais de chaîne |
| Durcissement des conteneurs | **réel** | `cap_drop: ALL`, `no-new-privileges:true`, `pids_limit`, `mem_limit`, `cpus`, `tmpfs: noexec,nosuid`, réseau `internal: true` |
| Isolation par apprenant | **fait** | projet Compose et réseau uniques par (apprenant, room), vérifié par 12 assertions |
| Échappement à la sortie | 321 appels `esc_*` / `wp_kses_post` | 7 `echo $var` restants, tous annotés `phpcs:ignore` avec justification |

**Les deux réserves :**

1. **La liste `HARD_DENY`** (`docker nsenter mount umount sudo su …`, `class-secura-lab.php:37`) est une **liste noire par recherche de sous-chaîne** : `d""ocker` ou `d\ocker` passent. Ce n'est pas grave *parce que* le vrai contrôle est l'isolation du conteneur — mais il faut l'écrire dans le code, sinon un futur contributeur croira que c'est la barrière.
2. **`throttle()` n'est appliqué qu'à l'exécution de commandes** (`lab_exec_`, 120/min). Rien ne limite `validate_answer` : un script peut essayer des réponses de drapeau en boucle. La limitation de 40 req/min annoncée dans le README n'existe pas dans ce fichier — **à corriger** (throttle par utilisateur + par room sur `validate_answer`).

### 4.3 Tests — exécutés, pas supposés

| Suite | Attendu (audit du 04/11) | Mesure réelle | Commentaire |
|---|---|---|---|
| `tests/smoke-test.php` | 327 réussis, 4 échecs | **328 réussis, 3 échecs** | Les 3 échecs sont **causés par mon environnement** : `php-wasm` ne peut pas lancer de processus enfant, j'ai donc rejoué le faux `docker` du test. Les 3 assertions concernées (`printenv HOME`, héritage d'environnement, lecture du drapeau) mesurent justement cette capacité. **Le code du dépôt passe tout le reste.** |
| `tests/import-test.py` | non mesuré | **79/79** | Exécuté tel quel, aucune dépendance |

**Ce que cela dit des 4 échecs du 04/11 :** ils appartiennent très probablement à la même famille — les assertions qui **lancent réellement un processus** et dépendent de l'environnement (`HOME`, `DOCKER_HOST`, disponibilité du démon). Autrement dit : des tests fragiles, pas des bugs produit. **Mais rien ne le prouve** tant que la CI ne tourne pas. C'est le premier chantier.

**Ce qui n'avait pas été testé lors de l'audit initial :** les 1 194 lignes neuves (désormais non chargées), ni les conteneurs Docker. `scripts/test-labs-ci.sh` vérifie sept images historiques ; il ne valide pas les quatre dossiers supplémentaires du ZIP.

### 4.4 CI/CD

| Workflow | Dernière exécution | Durée | Conclusion |
|---|---|---|---|
| `ci.yml` | 04/11 17:11 | **3 s** | échec à l'étape 1 |
| `audit.yml` | 04/11 17:11 | 4 s | échec |
| `wordpress.yml` | 04/11 17:11 | 5 s | échec |
| `labs.yml` | 04/11 17:11 | 4 s | échec |
| `deploy.yml` | 04/11 17:11 | 4 s | échec |

Aucune étape n'a été exécutée (`jobs[].steps: []`) : les runners ne sont pas alloués (quota du compte, comme l'écrit le dernier commit). **Depuis 17 h 11, plus aucune preuve d'exécution n'existe** : ni lint, ni tests, ni audits, ni recette WordPress, ni machines Docker. Les rapports du 04/11 à 23 h ont donc été produits **localement**, hors CI — ce qui explique aussi pourquoi leur environnement diffère de la recette.

Bonne pratique déjà en place : `permissions: contents: read` sur les 8 workflows, `timeout-minutes` posé, et 14 actions épinglées par empreinte SHA. **Reste à faire :** épingler les 8 actions encore référencées par tag majeur (`actions/checkout@v4`, `setup-python@v5`, `upload-artifact@v4`, `download-artifact@v4`) — c'est le premier vecteur de compromission d'une CI.

### 4.5 Documentation et gouvernance

| Manque | Impact |
|---|---|
| **Pas de `LICENSE`** | Le plugin annonçait déjà MIT dans son en-tête ; le texte complet et le périmètre des licences manquaient à la racine. Le thème et les contenus tiers conservent leurs propres conditions. |
| **Pas de `SECURITY.md`** | Aucun canal de signalement de vulnérabilité, pour une plateforme qui enseigne la sécurité. |
| **Pas de `CONTRIBUTING.md`**, ni `CHANGELOG.md`, ni `.editorconfig`, ni `composer.json`/`phpcs.xml` | Le ZIP livre `handoff/CONTRIBUTING.md` et `handoff/DEVELOPMENT.md` : **la doc existe, elle n'est pas dans le dépôt**. |
| **Pas de version unique** | 0.12.7 dans le dépôt **et** 0.12.7 dans le ZIP, pour deux codes différents. Un `VERSION` + tag Git + `SECURA_ACADEMY_VERSION` dérivé résoudrait le problème. |

**La dérive documentaire, mesurée :**

| Affirmation du README | Réalité | Écart |
|---|---|---|
| « vérifie **250 assertions** » (ligne 591) | 331 | −81 |
| « **6 rooms** sont livrées » (ligne 934) | 52 (`tools/rooms-connues.json`) | × 8,7 |
| « **Pas de vrais labs** … aucun conteneur ni machine n'est exécuté » (ligne 931) | moteur à deux pilotes et recettes Docker ; le ZIP contient 11 Dockerfiles, dont quatre dossiers copiés | affirmation à actualiser sans assimiler des copies à de nouveaux labs |
| « le nom de projet Docker Compose est encore fixe … à corriger avant l'ouverture publique » (ligne 956) | corrigé et testé (`project_name()`, 6 assertions) | limitation périmée |
| `handoff/README-DEVELOPPEUR` : « les **16 labs** (8 Red + 8 Blue) » | 13 dossiers, 11 Dockerfiles | −3 à −5 |

Ce n'est pas cosmétique : ce README est la seule porte d'entrée du dépôt. Un relecteur externe (jury, recruteur, enseignant, financeur) y lit que le projet n'a ni vrais labs ni contenu — l'inverse de la réalité.

---

## 5. La roadmap « qualité premium, anglais d'abord »

### 5.1 Ce qui est excellent

- **La règle d'or est la bonne** : « on ne réécrit rien soi-même ; seules les sources validées sont admises, chaque question porte sa source et sa licence ». C'est exactement ce qui manque à 90 % des plateformes de ce type.
- **L'ancrage sur les référentiels** (MITRE ATT&CK, OWASP Top 10, NIST CSF, ISO 27001) est un argument crédible devant un expert.
- **La paire Red/Blue** par vulnérabilité est une exigence pédagogique sérieuse, rarement tenue.
- **L'honnêteté sur les limites** (« un expert humain reste nécessaire », « une donnée structurée ne garantit pas l'apparition ») : c'est la culture des 18 audits, et elle est précieuse.
- **La phase 0 implicite** (nettoyer : retirer les 2 questions de maths hors sujet, vérifier les licences, vérifier les rooms orphelines) est la bonne façon de commencer.

### 5.2 Ce qui pose problème

| Problème | Détail |
|---|---|
| **Deux constitutions** | `docs/ROADMAP.md` (1 021 lignes, « prime sur les préférences du moment », relue à chaque commit) et ce document qui conclut « Cette roadmap est la constitution : on ne code pas avant qu'elle soit validée ». **Deux textes ne peuvent pas primer.** À fusionner : la roadmap premium devient l'article 6 bis de la constitution. |
| **Baseline « 8 / 20 » introuvable** | Aucun des 18 rapports ne produit de note sur 20. Le score d'arrivée (« au moins 16 / 20 ») n'est donc ni mesurable ni vérifiable. Il faut soit une grille de notation explicite, soit renoncer au chiffre et garder les 8 critères binaires (qui, eux, sont bons). |
| **Chiffres incohérents entre documents** | Questions à traduire : **1 777** (roadmap) / **1 891** (réservoir) / **2 283** (audit `epreuves`, mesuré) / **639** importées auditées / **392** maison. Quatre comptages pour un même corpus : personne ne peut suivre l'avancement. |
| **16 labs annoncés, 11 Dockerfiles, 13 dossiers** | Le décompte « 8 Red + 8 Blue » ne correspond à rien de mesurable aujourd'hui. |
| **Phase 5 = « À implémenter » sur des points déjà faits** | « HTTPS partout », « isolation des labs », « journaux d'audit », « copies différentes » : l'isolation et les variantes ont des tests simulés ; leur comportement réel reste à vérifier sur WordPress et Docker. La roadmap décrit un état ancien. |
| **Aucune ligne de moyens** | 6 phases, 13 semaines, 52 vidéos, 1 777 QCM anglais relus par un pentester certifié, 1 777 traductions FR + AR, 52 labs… **sans un seul nom, budget, ni tarif de relecture**. Le document dit *quoi* et *quand*, jamais *qui paie*. C'est ce qui fait échouer ce type de plan. |
| **Le verrou juridique n'est pas traité comme bloquant** | La phase 1 se propose de « vérifier les licences » en une semaine. Or `licences-2026-11-04` est **non conforme** : 16 vidéos en YouTube Standard License, 16 sans institution. Les licences CC **BY-NC-SA** comportent une restriction d'usage commercial ; le caractère gratuit d'un service ne tranche pas à lui seul tous les cas, notamment les partenariats. Vérification par source nécessaire. |

### 5.3 Ce que la roadmap ne voit pas

1. **Le code du ZIP n'était pas versionné dans `main`.** Les 1 194 lignes et les quatre dossiers de labs demandaient une revue sélective avant intégration, pas une activation aveugle.
2. **La CI est morte.** La phase 2 promet « 0 erreur technique bloquante après relecture experte » : sans CI, aucune des 1 777 questions ne sera validée automatiquement à l'import.
3. **Les 33 questions de type « solution »** (l'élève rédige, la correction s'affiche) ne sont pas des QCM : la roadmap les compte dans « 1 777 QCM anglais ». Elles demandent une notation humaine ou une grille — un chantier non prévu.

---

## 6. Plan d'action priorisé

### P0 — cette semaine (avant toute nouvelle fonctionnalité)

| # | Action | Critère de vérification |
|---|---|---|
| 1 | **Fusionner sélectivement le ZIP** : préserver les fichiers plus récents, isoler les prototypes et écarter les régressions | Décisions documentées ; tests ; cinq archives reconstruisibles et vérifiées, sans exiger une reproduction à l'octet des archives anciennes |
| 2 | **Rétablir la CI** (facturation/quota) | 5 workflows verts sur un commit de test |
| 3 | **Corriger `audit_verifier()`** (constats non étayés) | Un test de non-régression : rapport avec constat bloquant non étayé → `run-audits.sh` sort en 1 |
| 4 | **Trancher les 4 échecs** de `smoke-test.php` | `php tests/smoke-test.php` → 0 échec, ou tests marqués `skip` avec justification |
| 5 | **Traiter le bloquant licences** : examiner les droits et conditions d'intégration des 16 vidéos signalées et suspendre les usages non autorisés | Décisions sourcées par vidéo et nouvel audit des licences |

### P1 — ce mois

| # | Action | Critère |
|---|---|---|
| 6 | **Contrôle d'installation en tête de campagne d'audit** (thème attendu actif, URL de base, permaliens, `academy.css` 200, `robots.txt` 200) — sinon campagne **annulée**, pas de constats | Une campagne lancée sur un site nu échoue en 5 s avec « environnement non conforme » |
| 7 | **Déplacer SEO/accessibilité du thème vers le plugin** (ou repli plugin) : `meta description`, OG, Twitter, hreflang, `dir` | Désactiver le thème → `curl` montre toujours `dir`, `og:title`, `hreflang` |
| 8 | **Corriger les 2 faux positifs d'auditeur** (WCAG 2.5.8 sans `aria-label` ; `panel-eleves` doit refuser de conclure sur HTTP 0) | Rejeu : 106 commandes → 0, `panel-eleves` → « non mesuré » |
| 9 | **Version unique** : `VERSION`, tag Git, `SECURA_ACADEMY_VERSION` dérivé, contrôle CI « le tag = la version » | Deux builds différents ne peuvent plus porter 0.12.7 |
| 10 | **Couverture des 1 194 lignes neuves** dans `smoke-test.php` (certificats, examens chronométrés, fronts) | +1 assertion par méthode publique |
| 11 | **Throttle sur `validate_answer`** | Test : 41 requêtes/min → réponse `slow_down` |
| 12 | **Traiter le majeur JSON-LD** (52 titres anglais absents du texte) | `donnees-structurees-*.md` → 0 majeur |
| 13 | **`LICENSE`, `SECURITY.md`, `CONTRIBUTING.md`, `CHANGELOG.md`**, et remonter `handoff/` à la racine | `ls` de la racine |

### P2 — avant l'ouverture publique

| # | Action | Critère |
|---|---|---|
| 14 | **Réécrire « Limites connues »** du README à partir des 18 rapports du jour | 0 affirmation contredite par le code |
| 15 | **Fusionner les deux roadmaps** ; supprimer la note « 8/20 » ou publier la grille | Un seul document de référence |
| 16 | **Harmoniser les comptages de questions** (1 777 / 1 891 / 2 283 / 639 / 392) avec une requête unique et versionnée | Un seul chiffre, produit par un script |
| 17 | **Épingler les 8 actions CI restantes par SHA** | `grep 'uses:.*@v' .github/workflows` → 0 résultat |
| 18 | **Sortir le contenu de 2,9 Mo du PHP** vers JSON + import | Le plugin ne contient plus de `content-import-*.php` |
| 19 | **Trancher l'accès visiteur non connecté** (onboarding majeur) et l'écrire dans la constitution | Le comportement du site et le document disent la même chose |
| 20 | **Chiffrer la roadmap** : qui relit les 1 777 questions, à quel tarif, sur quel budget | Une ligne « moyens » par phase |

---

## 7. Annexe — ce que j'ai exécuté, et les limites de cet audit

**Commandes exécutées (toutes reproductibles) :**

```bash
# Écart ZIP ↔ dépôt
diff -rq --exclude=.git sources/ ../../secura-academy/

# Syntaxe PHP des 132 fichiers (via php-wasm, PHP 8.4)
node run-php.mjs lint.php secura-academy        # 132 fichiers, 0 erreur

# Suite de tests serveur
node run-php.mjs secura-academy/tests/smoke-test.php secura-academy
#   328 réussis, 3 échecs (tous dus à l'impossibilité de lancer un processus)

# Chaîne d'import
python3 tests/import-test.py                    # 79/79

# CI
gh run list --limit 20 ; gh api .../actions/runs/<id>/jobs
```

**Limites assumées :**

1. **Pas de PHP natif lors de l'audit initial** : j'ai utilisé `php-wasm` (PHP 8.4). Après l'audit, des tests ont été rejoués en PHP natif 8.3 et la syntaxe vérifiée en PHP 7.4 émulé. Les suites dépendant des processus enfants ne sont pas validées en PHP 7.4 natif : voir le [suivi de fusion](FUSION-ZIP-2026-11-05.md).
2. **Pas de WordPress, pas de MySQL, pas de Docker** : je n'ai pas pu rejouer les 18 audits, ni la recette `wordpress.yml`, ni les 45 contrôles de `test-labs-ci.sh`. Mon jugement sur les rapports du 04/11 est donc une **analyse des rapports**, pas une re-mesure.
3. **Les 3 échecs de `smoke-test` sont les miens**, pas ceux du projet : je l'ai écrit au § 4.3 et je ne les compte pas comme des défauts.
4. **Lectures non exhaustives** : je n'ai pas relu les 41 documents du dossier `docs/` ligne à ligne (1,7 Mo), ni les 2 283 questions. Les volumes cités viennent des audits du 04/11 et de `tools/rooms-connues.json`.
5. **Le ZIP a été sorti du dépôt** et décompressé hors de lui (`/home/user/import/`) : votre arbre de travail Git est resté propre pendant tout l'audit.

---

*Rapport d'audit initial — 05/11/2026, rectifié après revue. Les interprétations et hypothèses restent soumises aux limites indiquées ci-dessus.*
