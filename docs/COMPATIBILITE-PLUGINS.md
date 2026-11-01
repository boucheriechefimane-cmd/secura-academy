# Compatibilité avec les autres plugins WordPress

Ce document décrit ce que la plateforme **Secura Academy** accepte comme
plugins tiers, ce qu'elle refuse, et comment la compatibility est
**vérifiée automatiquement** à chaque changement.

## La règle : on ne casse rien pour l'apprenant

Secura Academy est une plateforme d'apprentissage. Un plugin tiers ne doit
jamais empêcher un élève de :

1. ouvrir une room et lire la leçon ;
2. répondre à un QCM et gagner de l'XP ;
3. déployer sa machine et taper des commandes ;
4. changer de langue (français, arabe, anglais) ;
5. obtenir son certificat.

C'est exactement ce que vérifie la recette automatique
(`tools/recette-apprenants/wp-e2e.php`) : elle est rejouée **avec** chaque
plugin de la matrice.

## La matrice testée à chaque changement

| Plugin | Slug | Pourquoi on le teste | Résultat |
|---|---|---|---|
| (aucun) | — | La référence : le site doit être parfait sans rien | ✅ |
| Polylang | `polylang` | Multilingue très répandu ; le nôtre ne doit pas se marcher dessus | ✅ (après correction, voir plus bas) |
| LiteSpeed Cache | `litespeed-cache` | Le cache de l'hébergement Hostinger ; les pages dynamiques ne doivent jamais être mises en cache | ✅ (le cache serveur ne s'active que sur un serveur LiteSpeed) |
| Elementor | `elementor` | Éditeur de page très utilisé ; il doit pas casser les rooms | ✅ |
| Contact Form 7 | `contact-form-7` | Formulaire de contact | ✅ |
| WooCommerce | `woocommerce` | Si un jour le site vend un certificat | ✅ |

Chaque combinaison est installée **dans un vrai WordPress** (MySQL en
service), puis contrôlée :

- le site répond en français, en arabe et en anglais (HTTP 200) ;
- la page arabe est bien en écriture de droite à gauche ;
- les 16 rooms et les 2 parcours existent ;
- un QCM se valide, l'XP monte, une mauvaise réponse est refusée ;
- la bonne réponse ne quitte jamais le serveur ;
- **aucune erreur PHP fatale** dans le journal (`wp-content/debug.log`).

## Le piège de Polylang (et comment on l'a réglé)

Polylang utilise le paramètre d'URL **`?lang=`** pour ses adresses
multilingues. Notre plateforme utilisait le même paramètre pour son
sélecteur de langue. Résultat : avec Polylang activé, **nos pages
renvoyaient une erreur 404**.

La correction : chaque plugin garde son adresse.

| | Paramètre | Règle |
|---|---|---|
| Secura Academy | `?seca_lang=ar` | Toujours prioritaire, jamais partagé |
| Polylang | `?lang=ar` | Lu seulement si aucun plugin multilingue n'est actif |

Le choix de l'apprenant reste prioritaire sur la locale du site : le
filtre `locale` de WordPress est enregistré en priorité haute (99).

> Note : le sélecteur de langue de l'interface (les boutons FR / AR / EN)
> ne passe pas par l'URL : il enregistre le choix dans le compte de
> l'apprenant. Le paramètre d'URL sert aux liens partageables.

## LiteSpeed : ce qui est vrai, ce qui ne l'est pas

Il y a **deux choses** qui s'appellent « LiteSpeed » :

1. **LiteSpeed Cache** (le plugin) : il optimise le site partout
   (minification, compression des images, chargement paresseux). Son
   **cache de pages**, lui, ne fonctionne que si le serveur web est
   LiteSpeed ou OpenLiteSpeed.
2. **Le serveur LiteSpeed / OpenLiteSpeed** : c'est lui qui sert les
   pages en cache, sans passer par PHP.

Conséquence honnête : **sur un hébergement mutualisé classique (Apache),
installer LiteSpeed Cache n'accélère rien par le cache** (les autres
optimisations restent actives). Sur un hébergement avec LiteSpeed — c'est
le cas de la plupart des mutualisés Hostinger — le plugin apporte tout
son intérêt.

Ce que la recette vérifie avec le plugin : qu'il s'active, qu'il ne casse
rien, et que nos pages dynamiques (room, AJAX, certificat) ne sont pas
mises en cache. La recette **serveur** (`docs/RECETTE-SERVEUR.md`) est à
faire une dernière fois sur l'hébergement réel : c'est le seul endroit où
le cache LiteSpeed peut être observé pour de vrai.

## Ajouter un plugin à la matrice

Dans `.github/workflows/wordpress.yml`, ajouter une ligne :

```yaml
          - nom: 'Nom du plugin'
            plugins: 'slug-du-plugin'
```

Puis pousser : la CI installe le plugin, joue la recette et dit si ça
passe. Si ça casse, deux issues possibles :

- le plugin modifie les requêtes de contenu (comme Polylang) : il faut
  lui laisser son paramètre et adapter le nôtre ;
- le plugin déclare un prix ou exige une licence : on ne l'installe pas
  en test automatique (c'est le cas de WPML, Polylang Pro…).

## Voir aussi

- `.github/workflows/wordpress.yml` — la recette automatique ;
- `scripts/ci-wordpress.sh` — l'installation de WordPress + plugins ;
- `tools/recette-apprenants/wp-e2e.php` — les contrôles de bout en bout ;
- `docs/RECETTE-SERVEUR.md` — la recette à faire sur l'hébergement réel.
