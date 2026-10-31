# Spécification — Modèle XP, médailles et évaluations de Secura Academy

**Date :** 31 octobre 2026 · **Statut :** spécification d'implémentation (P0) · **Compatibilité :** migration depuis le modèle actuel (`secura_xp`, `secura_progress`, `secura_trophies`).

---

## 1. Principes

1. **Toute valeur est calculée par le serveur.** Le client n'affiche que des résultats déjà validés.
2. **Un point se gagne une fois.** Aucune politique de rejouabilité ne double les gains.
3. **La difficulté se paie.** Une question difficile vaut plus qu'une question facile.
4. **L'aide coûte.** Un indice n'est pas gratuit : il réduit la valeur de la question, il ne la supprime pas.
5. **L'effort mesuré est récompensé** : le first blood valorise la résolution rapide, mais ne doit jamais décourager les apprenants tardifs (le différentiel est plafonné à ×2).
6. **Le niveau est une conséquence, jamais un objectif affiché.** L'écran principal doit montrer la prochaine action, pas le compteur de points.

---

## 2. Barème de points

### 2.1 Formule

```
points_question = base(difficulté)
                × multiplicateur(type de tâche)
                × multiplicateur_first_blood
                − malus_indice
```

| Paramètre | Valeurs |
|---|---|
| `base(difficulté)` | facile **10** · moyen **15** · difficile **20** · expert **30** |
| `multiplicateur(type)` | leçon **0** · entraînement **0,5** · test **1,0** · examen **1,5** |
| `multiplicateur_first_blood` | 1ᵉʳ **2,0** · 2ᵉ **1,8** · 3ᵉ **1,7** · 4ᵉ **1,65** · après **1,5** |
| `malus_indice` | **−50 %** des points de la question, si au moins un indice a été ouvert |

Le résultat est **arrondi à l'entier supérieur** (`ceil`). La valeur minimale d'une question est **1**.

> Le barème `200/180/175/165/150` de TryHackMe a été **relativisé** : leurs points sont calibrés sur un catalogue de 1 000+ labs avec des niveaux jusqu'à 150 000 points. Notre volume de contenu (≈ 46 rooms, ≈ 8 000 points) impose une échelle cohérente ; le *principe* (rang de réponse + multiplicateurs + malus) est conservé, pas les valeurs.

### 2.2 First blood

Le rang est la position de l'apprenant **parmi tous les utilisateurs ayant déjà répondu correctement** à cette question.

- Le rang est determined **au moment de la première bonne réponse** d'un utilisateur pour cette question, puis figé pour lui.
- Compteur global : table `{prefix}secura_answer_stats` (`question_key` → `correct_count`, `first_answer`).
- `question_key` = `{room_id}:{task_index}:{question_index}`.

```sql
CREATE TABLE {prefix}secura_answer_stats (
    question_key  varchar(191) NOT NULL,
    correct_count bigint(20) unsigned NOT NULL DEFAULT 0,
    first_answer  datetime DEFAULT NULL,
    PRIMARY KEY (question_key)
) {charset_collate};
```

> **Alternative simplifiée (recommandée pour la v1) :** ne pas implémenter le first blood tant que la base n'a pas plusieurs centaines d'utilisateurs. Le multiplicateur « alors 1,5 par défaut » évite un état de compte trompeur (tout le monde 1ᵉʳ sur un site vide). **Décision : first blood activable par option, désactivé par défaut.**

### 2.3 Bonus

| Bonus | Valeur | Condition |
|---|---|---|
| Complétion de room | facile 10 · moyen 25 · difficile 40 · expert 60 | toutes les questions de la room validées |
| Bonus « sans indice » | **×1,25** sur le bonus de room | aucun indice ouvert sur la room |
| Bonus d'examen réussi | **×2** sur le total de l'examen | seuil de passage atteint |
| Bonus de parcours | **+100 XP** | toutes les rooms du parcours complétées |
| Bonus de distinctive | **+50 XP** | médaille Or sur toutes les rooms du parcours |

### 2.4 Point d'entrée unique

Toute attribution passe par **une seule fonction** :

```php
Secura_Progress::award( $user_id, $context, $points );
```

où `$context` décrit : room, tâche, index de question, type de tâche, difficulté, indice utilisé, rang first blood. Cette centralisation est la condition pour que le barème reste cohérent quand il évoluera.

---

## 3. Échelle de niveaux

**12 niveaux**, noms originaux (aucun emprunt à l'échelle TryHackMe).

| # | Nom | XP requis | Points restants |
|---|---|---|---|
| 1 | Observateur | 0 | 100 |
| 2 | Apprenti | 100 | 150 |
| 3 | Analyste | 250 | 200 |
| 4 | Traceur | 450 | 250 |
| 5 | Auditeur | 700 | 300 |
| 6 | Pourfendeur | 1 000 | 400 |
| 7 | Spécialiste | 1 400 | 500 |
| 8 | Architecte | 1 900 | 600 |
| 9 | Défenseur | 2 500 | 700 |
| 10 | Éclaireur | 3 200 | 1 000 |
| 11 | Sentinel | 4 200 | 1 300 |
| 12 | Maître | 5 500 | — |

**Règle d'affichage.** La barre de progression mesure l'avancement **vers le niveau suivant**, pas vers le plafond. Le niveau courant est toujours nommé ; le suivant est annoncé en gris avec le nombre de points manquants. Message type : *« 120 XP avant Éclaireur »*.

> L'échelle actuelle (6 niveaux, plafond 1 500 XP) est conservée en base pour la compatibilité : les seuils 0/100/250/500/900/1 500 sont des paliers de la nouvelle échelle. Une migration réécrit `secura_xp` sans changer le total.

---

## 4. Médailles

### 4.1 Médailles de room

| Médaille | Critère | Bonus XP |
|---|---|---|
| 🥉 **Bronze** | room complétée, score ≥ 60 % | +10 % du bonus de room |
| 🥈 **Argent** | score ≥ 80 % **et** 0 indice utilisé | +25 % du bonus de room |
| 🥇 **Or** | score = 100 % **et** 0 indice utilisé | +50 % du bonus de room |

Le **score** d'une room = `(questions correctes / questions totales) × 100`, pondéré : les questions de type *examen* comptent double.

### 4.2 Médailles d'examen

| Médaille | Critère |
|---|---|
| 🥉 Bronze | score ≥ seuil de passage |
| 🥈 Argent | score ≥ seuil + 10 points |
| 🥇 Or | score ≥ seuil + 20 points |

### 4.3 Médailles de parcours

| Médaille | Critère |
|---|---|
| 🥈 Argent | toutes les rooms du parcours complétées |
| 🥇 Or | médaille Or sur **toutes** les rooms du parcours |
| 🏅 Distinctive | parcours terminé + examen final réussi |

### 4.4 Stockage

```php
// user_meta : seca_medals
array(
    'room_12' => array(
        'medal'     => 'gold',        // bronze | silver | gold
        'score'     => 100,
        'hints'     => 0,
        'earned_at' => '2026-10-31 10:12:04',
    ),
    'exam_12_3' => array( 'medal' => 'silver', 'score' => 84, 'earned_at' => '…' ),
    'path_1'    => array( 'medal' => 'gold', 'earned_at' => '…' ),
);
```

La médaille est **recalculée** à chaque complétation : si un apprenant réessaute une room avec de meilleurs résultats, la médaille **monte** (jamais ne descend). Le `score` affiché est le **meilleur** score obtenu.

---

## 5. Examen chronométré

### 5.1 Règles

| Règle | Valeur |
|---|---|
| Durée | `time_limit` en minutes, par tâche |
| Seuil de passage | `pass_score` en % |
| Indice | **désactivé** pendant l'examen |
| Tentatives | illimitées, mais **l'XP n'est versé qu'à la première réussite** |
| Awardé à | la **première** tentative réussie |
| Timer | affichage client, **validation serveur** |

### 5.2 Chronométrage côté serveur

Le client ne peut pas être la source de vérité. À l'ouverture de la tâche d'examen :

```php
// L'endpoint 'secura_start_exam' enregistre l'heure de départ serveur.
$started_at = time();  // heure serveur
update_user_meta( $user_id, SECURA_USER_EXAMS, $exam_state );
```

À chaque soumission, le serveur recalcule :

```php
$elapsed = time() - $started_at;
if ( $elapsed > $task['time_limit'] * 60 ) {
    // Examen expiré : les réponses ne sont plus créditées.
    wp_send_json_error( array( 'message' => __( 'Temps écoulé.', 'seca-academy' ), 'code' => 'expired' ) );
}
```

Un `started_at` déjà présent n'est **pas** réinitialisé (le chronomètre ne repart pas à chaque rechargement).

### 5.3 Écran de résultat

```
Score : 18 / 25  (72 %)
Seuil requis : 70 %  →  REÇU
Temps utilisé : 14 min 22 s
+270 XP  (×1,5 examen ×1,5 first blood)
🥈 Médaille d'argent
[Voir mes erreurs]   [Recommencer]   [Room suivante]
```

Le bouton **« Voir mes erreurs »** affiche, pour chaque question ratée, **l'explication pédagogique** — c'est le différenciateur annoncé face à TryHackMe.

---

## 6. Modèle de données

### 6.1 Tâches d'une room

```php
// post_meta : _secura_tasks
array(
    array(
        'type'       => 'lesson',            // lesson | practice | test | exam
        'title'      => 'Task 1 : La négociation',
        'content'    => '<p>…markdown rendu…</p>',
        'time_limit' => 0,                   // minutes, > 0 si type = exam
        'pass_score' => 0,                   // %,   > 0 si type = exam
        'questions'  => array(
            array(
                'question'   => 'Quel message initiate la négociation ?',
                'answers'    => array( 'ClientHello' ),   // variantes acceptées
                'xp'         => 15,                      // valeur de base
                'hint'       => 'Le client parle en premier.',
                'explanation'=> 'Le client envoie ClientHello pour proposer…',
                'weight'     => 1,                       // 2 pour les questions d'examen
            ),
        ),
    ),
);
```

### 6.2 Clés de stockage

| Clé | Type | Contenu |
|---|---|---|
| `secura_xp` | user_meta (int) | XP total |
| `secura_progress` | user_meta (array) | `{ room_id => { tasks: { task_index => { solved: {q: true}, hints: {q: true}, score } }, completed: bool, best_score: int } }` |
| `secura_medals` | user_meta (array) | `{ medal_key => { medal, score, hints, earned_at } }` |
| `secura_exams` | user_meta (array) | `{ exam_key => { started_at, finished_at, score, passed, attempts } }` |
| `secura_streak` | user_meta (array) | `{ current, longest, last_day }` |
| `_secura_tasks` | post_meta | structure § 6.1 |
| `_secura_difficulty` | post_meta | facile \| moyen \| difficile \| expert |
| `_secura_duration` | post_meta | minutes |
| `_secura_xp_bonus` | post_meta | bonus de complétion |

`secura_trophies` (ancien modèle) est **conservé** pour compatibilité de lecture mais n'est plus écrit ; les « trophées » deviennent des **médailles**.

### 6.3 Compatibilité ascendante

`Secura_Progress::get_state()` doit :

1. lire `secura_progress` au nouveau format ;
2. si la room n'existe pas au nouveau format mais existe au format `{ solved: {q:true} }` (ancien), la **convertir en place** : une seule tâche implicite de type `practice`, indices réindexés.

Les 6 rooms existantes sont converties par un script de migration `wp-cli` :

```bash
wp seca migrate rooms --path=/chemin/wordpress
wp seca migrate progress --path=/chemin/wordpress
```

---

## 7. Contrat AJAX

| Action | Auth | Rôle |
|---|---|---|
| `secura_get_room` | connecté | Liste des tâches (types, titres, verrous) — **jamais** les réponses |
| `secura_get_task` | connecté | Contenu d'une tâche + questions (sans réponses) + indice disponible |
| `secura_validate_answer` | connecté | Valide une réponse, attribue les XP, retourne le nouveau solde, les médailles gagnées, le first blood |
| `secura_hint_used` | connecté | Marque l'indice comme ouvert (avant affichage) → déclenche le malus |
| `secura_start_exam` | connecté | Démarre (ou réutilise) le chronomètre d'un examen |
| `secura_finish_exam` | connecté | Clôture : score, seuil, médaille, XP |

**Réponse type de `secura_validate_answer` :**

```json
{
  "success": true,
  "data": {
    "correct": true,
    "message": "Bonne réponse ! +24 XP",
    "points_awarded": 24,
    "base_points": 15,
    "multipliers": { "type": 1.0, "first_blood": 1.6, "hint": 1 },
    "hint_penalty": false,
    "total_xp": 348,
    "level": { "number": 4, "label": "Traceur", "next_label": "Auditeur", "xp_to_next": 102 },
    "room": { "solved": 4, "total": 7, "best_score": 57, "completed": false },
    "medal": null,
    "new_medals": [],
    "explanation": "Le ClientHello porte la version TLS proposée…"
  }
}
```

L'`explanation` n'est renvoyée **qu'après une soumission** — jamais dans le payload d'ouverture de la tâche.

---

## 8. Intégrité et anti-triche

| Risque | Parade |
|---|---|
| Réponses dans le HTML / JSON | Vérification automatique : aucun champ `answer*` ne doit apparaître dans les réponses AJAX (test automatisé) |
| Réponse rejouée | Idempotence : `award_question()` refuse une question déjà résolue |
| Manipulation du timer d'examen | `started_at` stocké côté serveur, recalcul à chaque soumission |
| Indice ouvert puis masqué | `secura_hint_used` est appelé **avant** l'affichage de l'indice ; le malus est déjà appliqué |
| XP massif via script | `first_blood` plafonné, `award()` centralisé, journalisation des gains anormaux |
| Requêtes en rafale | Rate limiting par IP + par compte (à implémenter, cf. backlog P0) |
| Création massive de comptes | Confirmation e-mail + anti-spam (à implémenter) |

---

## 9. Tests à ajouter

| Test | Vérifie |
|---|---|
| `test_award_is_idempotent` | une question ne crédite qu'une fois |
| `test_hint_penalty_halves_points` | le malus d'indice s'applique |
| `test_first_blood_multiplier` | le rang est correct et figé |
| `test_room_completion_bonus` | bonus + ×1,25 sans indice |
| `test_medal_upgrades_only` | la médaille monte, ne descend pas |
| `test_exam_expires_server_side` | un examen hors délai est rejeté |
| `test_exam_xp_once` | l'XP d'examen n'est versé qu'à la première réussite |
| `test_answers_never_in_payload` | aucun `answer` dans les réponses AJAX |
| `test_progress_migration` | l'ancien format est converti sans perte |
| `test_level_thresholds` | les 12 paliers sont exacts |

Ces tests s'ajoutent à `tests/smoke-test.php` (harnais sans WordPress) et à une future suite PHPUnit (avec WordPress complet).

---

## 10. Ordre d'implémentation

1. `Secura_Progress::award()` + barème (§ 2) — refactor du code actuel, sans changement de comportement observable.
2. Modèle de tâches (§ 6) + migration des 6 rooms.
3. Indices tracés + malus.
4. Médailles (§ 4).
5. Examens chronométrés (§ 5).
6. First blood (optionnel, § 2.2).
7. Échelle de niveaux à 12 paliers (§ 3).
8. Reconstruction de l'UI de room (navigation par tâche, minuteur, écran de résultat).
