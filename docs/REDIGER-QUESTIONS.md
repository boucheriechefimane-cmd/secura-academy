# Rédiger des questions qui ne se copient pas

> Comment écrire une question d'examen dont **les chiffres changent** d'une
> copie à l'autre — sans jamais dire une bêtise, et sans que l'explication
> devienne fausse.

Ce document s'adresse à qui écrit le contenu (enseignant, rédacteur). Il
n'exige aucune connaissance en programmation : on écrit une question
ordinaire, avec deux ou trois `{mots}` à la place des chiffres.

---

## 1. Le problème, en une phrase

Avant, **tous les élèves passaient le même examen** : mêmes questions, même
ordre, mêmes chiffres. Une photo d'écran suffisait à réussir.

Depuis la version **0.9.0**, chaque élève reçoit **sa copie** : les
questions sont tirées au sort dans le **réservoir du niveau**, les
propositions sont mélangées, et les chiffres — quand ils peuvent changer —
changent.

Mais attention : **on ne peut pas changer un chiffre qui est un fait.** Le
port 22, le code HTTP 404, SHA-256 : ces valeurs sont **vraies**, et les
changer rendrait la question fausse — et l'explication avec.

C'est pourquoi il existe deux mécanismes, et qu'ils ne se remplacent pas.

| Mécanisme | Ce qu'il fait | Quand il s'applique |
|---|---|---|
| **Le mélange des propositions** | La bonne réponse change de place | Toujours, automatiquement |
| **Le tirage dans le niveau** | Les questions ne sont pas les mêmes pour tous | Toujours, automatiquement |
| **La variation numérique « sûre »** | Change un nombre de 2 ou 3 chiffres **seulement si l'explication n'en parle pas** | Rarement, et automatiquement |
| **Les questions paramétriques** | Le nombre est **inventé par la question** et change vraiment | **C'est la solution pour « jamais les mêmes chiffres »** |

---

## 2. Écrire une question paramétrique

### La règle

On écrit le chiffre entre accolades : `{taille}`. On propose ensuite
**plusieurs jeux de valeurs**. Le moteur en tire un par copie d'examen.

### L'exemple

```php
array(
    'question' => 'Que se passe-t-il si un programme écrit {ecrit} octets dans un buffer de {taille} ?',
    'mode'     => 'choice',
    'variants' => array(
        array( 'taille' => '32', 'ecrit' => '40', 'trop' => '8' ),
        array( 'taille' => '64', 'ecrit' => '72', 'trop' => '8' ),
        array( 'taille' => '16', 'ecrit' => '24', 'trop' => '8' ),
        array( 'taille' => '128', 'ecrit' => '140', 'trop' => '12' ),
    ),
    'choices' => array(
        "Le programme s'arrête avec une erreur",
        'Le buffer s\'agrandit automatiquement',
        'La mémoire est purgée',
        'Les {trop} octets en trop écrasent ce qui se trouve après le buffer, dans la pile',
    ),
    'correct' => 3,
    'xp'      => 10,
    'hint'    => 'En C, un tableau n\'a pas de garde-fou.',
    'explanation' => 'Un tableau C n\'est qu\'une zone de mémoire : écrire {trop} octets au-delà des {taille} octets réservés écrase la mémoire voisine.',
),
```

Ce que l'élève voit, selon sa copie :

| Élève | Énoncé | Proposition |
|---|---|---|
| A | « …écrit **40** octets dans un buffer de **32** ? » | « Les **8** octets en trop écrasent… » |
| B | « …écrit **72** octets dans un buffer de **64** ? » | « Les **8** octets en trop écrasent… » |
| C | « …écrit **140** octets dans un buffer de **128** ? » | « Les **12** octets en trop écrasent… » |

### Les cinq règles à ne pas enfreindre

1. **Chaque `{mot}` utilisé dans le texte doit être défini dans *tous* les
   jeux de valeurs.** Un `{mot` oublié afficherait littéralement « `{taille` »
   à l'élève. Un contrôle automatique le signale.
2. **L'explication utilise les mêmes `{mots}`** que l'énoncé. C'est ce qui
   garantit qu'elle reste vraie : si elle écrit « 8 octets » en dur pendant
   que l'énoncé dit 12, l'élève apprend une bêtise.
3. **Au moins trois jeux de valeurs.** En dessous, deux élèves ont une
   chance sur deux de voir la même chose. Un contrôle automatique le
   signale.
4. **Les jeux doivent être plausibles** (des tailles de buffer réalistes,
   des ports crédibles) : la question reste une question de terrain.
5. **Les valeurs liées doivent être cohérentes entre elles.** Dans
   l'exemple, `trop` vaut toujours `ecrit - taille`. Si l'on change
   `taille` sans changer `ecrit`, la bonne proposition devient fausse.

### Ce qu'on ne paramètre pas

- Les **faits** : le port 22, le code 404, SHA-256, le nom d'un outil.
- Les **drapeaux** : ils sont lus sur la machine de l'élève.
- Les **consignes de terminal** : elles décrivent des commandes réelles.

---

## 3. Mesurer ce qu'on a écrit

Le moteur d'épreuves est mesuré à chaque push par l'auditeur
« Moteur d'épreuves » (`scripts/audit/audit-epreuves.php`). Il affiche :

- le **réservoir** de chaque examen (de combien de questions on tire) ;
- le nombre de **combinaisons possibles** ;
- le nombre de questions **paramétriques** ;
- la **variété** des copies (10 élèves ⇒ 10 copies différentes ?).

Pour une mesure rapide, en local :

```bash
# De combien de questions tire un examen ?
wp eval 'echo Secura_Exam::pool_size( 25, 3 );'

# La copie que reçoit un élève pour un examen
wp eval 'print_r( Secura_Exam::paper( 1, 25, 3, Secura_Rooms::get_tasks( 25 )[3] ) );'
```

---

## 4. Pourquoi « environ 200 questions par niveau »

Le propriétaire a demandé que l'on puisse disposer d'environ **200 questions
différentes par examen**, et que l'on n'en présente que quelques-unes.

Ce n'est pas un réglage : c'est **un travail de rédaction**. Aujourd'hui,
le réservoir d'un examen va de **11 à 34 questions** (médiane 26) pour
**20 sections** de parcours.

| Pour un examen de | Avec un réservoir de | Copies possibles |
|---|---|---|
| 3 questions | 26 questions | 2 600 |
| 3 questions | 200 questions | 1 313 400 |
| 5 questions | 200 questions | 2 535 040 000 |

Autrement dit : **le moteur n'est pas le goulet d'étranglement** — il tire
dans un réservoir de 200 questions aussi bien que dans un réservoir de 30.
C'est la **rédaction** qui manque, et elle se fait avec le format décrit
ci-dessus.

**Ordre de grandeur du chantier** : 20 sections × 200 questions ≈ **4 000
questions**, à écrire et à traduire (français, arabe, anglais) — chaque
question portant en moyenne 3 à 5 variantes.

---

## 5. Le tableau de bord du propriétaire

| Question posée | Réponse mesurée | Où le vérifier |
|---|---|---|
| « C'est facile de créer un compte et de commencer ? » | **Oui** : 10 élèves sur 10, en une étape | `scripts/audit/audit-panel-eleves.php` |
| « Ils reçoivent vraiment des points ? » | **Oui** : 0 → 213 XP environ | idem |
| « Et des médailles ? » | **Oui** : médaille **or** à 100 % | idem |
| « Leur rang avance ? » | **Oui** : Observateur → Apprenti | idem |
| « Ils ont tous le même examen ? » | **Non** : 10 copies pour 10 élèves | idem + `audit-epreuves.php` |
| « Jamais les mêmes chiffres ? » | **Oui pour les questions paramétriques**, non pour les faits (le port 22 reste le port 22) | `audit-epreuves.php` |
| « Une capture d'écran suffit ? » | **Non** : questions, ordre et chiffres différents | idem |
