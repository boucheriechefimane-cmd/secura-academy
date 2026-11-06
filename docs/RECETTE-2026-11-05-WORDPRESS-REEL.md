# Recette du 05/11/2026 — WordPress réel, défauts mesurés, corrections

**Périmètre :** installation WordPress réelle (6.7.4, PHP 8.3.31, SQLite), plugin et thème du dépôt
actifs, 52 rooms et 4 parcours ; recette HTTP (curl + cookies) ; 18 auditeurs exécutés sous WP-CLI.
**Ce que cette recette ne couvre pas :** MySQL, Docker, déploiement de lab, certificat PDF, examen
chronométré du ZIP. Ces points sont listés en fin de document, avec leur raison.

---

## 1. Ce qui a été mesuré

| Mesure | Résultat |
| --- | --- |
| Site servi | HTTP 200 ; `wp_remote_get` HTTP 200 sur une room |
| Plugin / thème | actifs ; 52 rooms, 4 parcours publiés |
| Inscription par le formulaire web | 20 POST sur `wp-login.php?action=register`, 20 comptes créés |
| Connexion | HTTP 200 avec cookie de session `wordpress_logged_in` |
| Verrouillage progressif | `get_task` répond `locked` avant la tâche précédente |
| Chronomètre d'examen | démarre à `start_exam` (300 min), refus `expired` après le délai |
| Fuite de réponses | jamais dans la copie servie (choix, explications) |
| 18 auditeurs | 18/18 sans bloquant ni majeur ; 1 mineur (épreuves), le reste en info |

Les 54 rapports HTML/Markdown/JSON de cette campagne sont dans `docs/audits/*-2026-11-05.*` et
datent de cette exécution (ils remplacent ceux produits avant les corrections).

---

## 2. Défauts réels trouvés, corrigés, et prouvés

### 2.1 Langue : la page se déclarait « fr » en servant de l'anglais

Le site de recette est installé en anglais (`WPLANG` vide ⇒ `en_US`). Mesure avant correction :

```
GET /rooms/penser-comme-un-defenseur/
  <html lang="en">            titre « Think like a defender »
  <link rel="alternate" hreflang="fr" href="…/penser-comme-un-defenseur/">
  <a class="site-lang__link" href="…/penser-comme-un-defenseur/">Francais</a>
```

La page anglaise se déclarait version française, et le lien « Français » ramenait à l'anglais.
Deux défauts distincts :

- **le thème** écrivait `fr` sur l'adresse nue, en supposant que le site est en français ;
- **le sélecteur du tableau de bord** (boutons AJAX) rechargeait l'adresse courante : avec
  `?seca_lang=ar` dans la barre, le paramètre gardait la priorité et le choix venait d'être
  enregistré … dans l'ancienne langue.

Correction (`class-secura-i18n.php`, `functions.php` du thème, `academy.js`, `class-secura-dashboard.php`) :

- la langue du site se lit dans l'option `WPLANG`, **jamais** dans `get_locale()` (notre propre
  filtre `locale` renvoie la langue demandée : s'en servir reviendrait à croire que le site est
  installé dans la langue de la page) ;
- `Secura_I18n::url_pour_langue()` construit **une adresse explicite par langue** ; la langue du
  site garde l'adresse nue (une seule adresse par page, pas de doublon) ;
- `hreflang` et `canonical` décrivent **ce que l'adresse sert réellement** ; `x-default` reste
  l'adresse nue ;
- le sélecteur est fait de **vrais liens** (`<a href>`, utilisables sans JavaScript) ; le clic
  enregistre la préférence par AJAX puis suit le lien, dont l'adresse porte déjà la langue choisie.

Mesure après correction (même site anglais) :

```
GET /rooms/…/?seca_lang=fr  → <html lang="fr">, titre français,
  hreflang fr → ?seca_lang=fr, en → adresse nue, canonical → ?seca_lang=fr
GET /rooms/…/               → <html lang="en">, hreflang en → adresse nue
GET /rooms/…/?seca_lang=ar  → <html lang="ar" dir="rtl">
```

### 2.2 Examen : l'API livrait les questions et démarrait un chronomètre sans contrôle

Mesures avant correction, par HTTP, avec un compte réel :

```
POST secura_get_task  (room 11, task 3, examen verrouillé)  → 403 locked
POST secura_start_exam(room 11, task 3, examen verrouillé)  → 200, time_left = 18000 s
POST secura_get_task  (examen déverrouillé, sans start_exam)→ 200, 5 questions, time_left = 0
POST secura_validate_answer (sans start_exam)               → accepté, chronomètre créé au passage
```

Trois défauts : `start_exam()` ne vérifiait ni le type de tâche ni le déverrouillage ; `get_task()`
livrait les questions d'un examen **avant** tout chronomètre (on pouvait chercher sans limite, puis
démarrer le temps) ; `validate_answer()` créait le chronomètre dans le dos de l'élève.

Correction (`class-secura-ajax.php`, `academy.js`) :

- `start_exam()` refuse une tâche qui n'est pas un examen (`not_an_exam`) et un examen verrouillé (`locked`) ;
- `get_task()` refuse un examen non commencé et non terminé (`exam_not_started`, HTTP 409) ;
- `validate_answer()` refuse de même, au lieu de démarrer le chronomètre ;
- le JavaScript ouvre l'examen quand le serveur répond `exam_not_started`, puis **affiche le temps
  du serveur** (`time_left`) au lieu de lancer un second compte à rebours.

Mesure après correction (même scénario, compte neuf) :

```
get_task 3 avant start_exam   → 409 exam_not_started
start_exam                    → 200, 18 000 s
get_task 3 après start_exam   → 200, 5 questions, explications vides, aucune bonne réponse envoyée
réponse avant start_exam      → exam_not_started (aucun chronomètre créé)
après 301 min                 → get_task 403 expired, validate_answer expired
```

`time_limit` est en **minutes** (documenté dans `docs/MODELE-XP-MEDAILES.md`) : 300 ⇒ 5 h, et non
300 min. Ce n'est pas un défaut.

### 2.3 Auditeurs qui mesuraient autre chose que ce qu'ils annonçaient

| Auditeur | Défaut | Correction |
| --- | --- | --- |
| `seo` | auditait l'adresse nue en la supposant française ; cherchait le titre dans tout le HTML ; exigeait une canonique sans paramètre | demande `?seca_lang=fr`, lit `<title>`, vérifie la canonique **de la langue servie** et que chaque `hreflang` désigne une adresse qui sert vraiment cette langue |
| `dev` | « PHP 7.4 et 8 testés » avec la condition `true` ; comptait les classes du ZIP en quarantaine comme des fichiers oubliés | mesure le lint de la version courante avec `PHP_BINARY`, déclare 7.4 non mesuré, distingue la quarantaine et vérifie qu'elle reste **inactive** |
| `panel-eleves` | comptes créés par `wp_insert_user` ; annonçait « 16 rooms » ; langues des personas non appliquées ; contrôle de niveau tautologique ; deux fois la même empreinte de copie ; verrou jamais compté (`empty($data) && isset($data['code'])`) ; start_exam sur un examen verrouillé ; logins accentués introuvables | inscription par le **formulaire web** ; parcours répartis, arrêt à l'examen ; niveau comparé **avant/après** ; deux mesures distinctes (copie servie / ensemble trié) ; verrou compté ; examen ouvert dans le bon ordre ; login passé par `sanitize_user()` ; ce qui n'est pas mesuré est déclaré |
| `epreuves` | n'ouvrait pas l'examen avant de lire la copie ; laissait quatre comptes `audit-copie-*` | ouvre le chronomètre, supprime les comptes créés, sépare « copie refusée » de « contrôle non réalisé » |

---

## 3. Limites, dites sans détour

- **MySQL non testé.** La base est SQLite (plugin officiel). `SELECT LAST_INSERT_ID()` n'y est pas
  supporté : `class-secura-exam.php` utilise un repli non atomique. Aucun test de concurrence.
- **Docker absent.** Aucune image (`web-01`, `multi-01`, `univ-01`, `juice-shop`, `web-dvwa`,
  prototypes Blue/buffer) n'a été construite, aucun lab déployé, aucun drapeau lu.
- **Certificat PDF et examen chronométré du ZIP : non testés.** Les classes sont en quarantaine
  (`includes/EXPERIMENTAL-ZIP.md`) ; l'audit `dev` vérifie qu'elles restent inactives.
- **Langues des personas.** Le panel joue en français : la version arabe, `dir="rtl"` et le rendu
  mobile sont mesurés par `accessibilite`, `ux` et `seo`, pas par le panel.
- **Questions de machine.** Les tâches à drapeau, action ou terminal sont déverrouillées sans être
  jouées par le panel (l'auditeur `drapeaux` les joue, lui, avec une machine), et le bilan le dit.
- **Droits sur les contenus.** Les licences déclarées sont vérifiées comme déclarations : l'audit ne
  prouve pas que chaque vidéo autorise la réutilisation.
- **PHP 7.4.** Non exécuté. Seuls l'absence de syntaxe PHP 8 et le lint 8.3 sont mesurés.
