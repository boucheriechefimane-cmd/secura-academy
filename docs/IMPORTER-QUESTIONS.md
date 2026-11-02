# Importer des questions validées (au lieu de les rédiger)

> Décision du 01/11/2026 : **Secura Academy ne rédige plus ses questions.**
> Le contenu de l'examen vient de **sources déjà validées** : questions de
> cours validées par des universités, ou questions d'examens de
> certification (gratuits ou payants), **réutilisables avec attribution et
> respect de la licence**.

Ce document explique la règle, les sources admises, et l'outil qui fait le
travail. Il ne demande aucune connaissance en programmation.

---

## 1. Pourquoi on change

Le plan « rédiger 4 000 questions » est **annulé**. Trois raisons :

1. **Le temps.** Écrire, relire, vérifier et traduire des milliers de
   questions prend des années.
2. **Le risque.** Une question mal écrite (ou fausse) se propage à des
   milliers d'élèves. Une question d'université ou d'examen de certification
   a déjà été relue par des professionnels.
3. **La valeur.** Les questions d'un examen de certification **Security+**
   ou **OSCP** ne ressemblent à rien de ce que nous écririons : ce sont des
   questions de terrain.

Ce que la plateforme apporte reste notre travail : les **machines**, les
**défis pratiques**, le **terminal**, les **médailles**, les **explications
d'erreur**, et surtout la **moteur d'épreuves** qui fait que deux élèves
n'ont jamais les mêmes questions.

---

## 2. Ce qu'on importe — et ce qu'on n'importe pas

La règle est simple : **une source entre dans le catalogue, ou elle n'entre
pas.** Le catalogue est un fichier, il se lit d'un coup d'œil, et il est
vérifié par l'outil d'import (une source absente du catalogue est refusée,
avec un message clair).

| Source | Licence | Verdict |
|---|---|---|
| MIT OpenCourseWare 6.858 (cours) | CC BY-NC-SA 4.0 | **Réutilisable**, avec attribution |
| **MIT OCW 6.858 — quiz d'examen et corrigés** | CC BY-NC-SA 4.0 | **Réutilisable**, avec attribution — **premier import fait** |
| MIT OpenCourseWare 6.857 (cours) | CC BY-NC-SA 4.0 | **Réutilisable**, avec attribution |
| StanfordSEE | CC BY-NC-SA 4.0 | **Réutilisable**, avec attribution |
| OWASP Cheat Sheet Series | CC BY-SA 4.0 | **Réutilisable**, avec attribution |
| OWASP Web Security Testing Guide | CC BY-SA 4.0 | **Réutilisable**, avec attribution |
| OpenLearn (The Open University) | CC BY-SA 4.0 | **Réutilisable**, avec attribution (mais voir § 8) |
| NIST (SP 800-207, SP 800-41r1…) | Domaine public | **Réutilisable** |
| **PortSwigger Web Security Academy** | Copyright PortSwigger | **NON réutilisable** (voir § 8) |
| Examens de certification | Copyright de l'éditeur | **Cas par cas** (voir ci-dessous) |

Le catalogue fait foi : `tools/sources-autorisees.json` (11 sources).

### Le cas des examens payants

Un examen payant (Security+, OSCP, CEH, eJPT, BSCP…) **n'est pas libre** :
l'éditeur en détient le copyright. Deux règles :

1. **On n'importe rien** d'un examen payant sans l'accord écrit de
   l'éditeur. Acheter un examen ne donne pas le droit de le republier.
2. **Avec l'accord** de l'éditeur (ce qui arrive : beaucoup d'éditeurs
   autorisent l'usage pédagogique de leurs questions de préparation), on
   importe, et on cite : « Extrait de l'examen X, édition Y, © Éditeur ».

En attendant, ces examens restent **dans le catalogue en « non
réutilisable »** : l'outil d'import les refuse, ce qui évite l'accident.

---

## 3. L'outil

`tools/import-questions.py` fait tout le travail : il vérifie, puis il écrit
un fichier que le plugin charge au démarrage.

```bash
# 1. vérifier un lot, sans rien écrire
python3 tools/import-questions.py --verifier mon-lot.json

# 2. importer le lot (le fichier PHP est écrit dans le plugin)
python3 tools/import-questions.py --importer mon-lot.json

# 3. ou tout un dossier de lots
python3 tools/import-questions.py --importer-dossier tools/imports/
```

### Ce que l'outil refuse (et pourquoi)

| Refus | Raison |
|---|---|
| Source absente du catalogue | On ne réutilise que ce dont la licence est vérifiée |
| Licence différente de celle du catalogue | Le lot ne peut pas élargir les droits |
| Source marquée « non réutilisable » | Les examens payants, CYBER.ORG… |
| Attribution vide | On doit pouvoir créditer la source |
| Question sans explication | L'explication d'erreur est la moitié du travail |
| Question à choix sans bonne réponse | La question serait injouable |
| Question de drapeau sans chemin de fichier | Le serveur ne pourrait pas la vérifier |

Le message d'erreur est en français et en clair : pas de jargon.

---

## 4. Le format d'un lot

Un lot est un fichier JSON (une source = un lot) :

```json
{
  "source": "mit-ocw-6858",
  "licence": "CC BY-NC-SA 4.0",
  "attribution": "MIT OpenCourseWare, 6.858 Computer Systems Engineering, Spring 2014",
  "url": "https://ocw.mit.edu/courses/6-858-computer-systems-engineering-spring-2014/",
  "rooms": [
    {
      "room": "cryptographie-cle-chiffrement-signature",
      "title": "Cryptographie : clé, chiffrement, signature",
      "tasks": {
        "test": [
          {
            "question": "Que vérifie une signature numérique ?",
            "mode": "choice",
            "choices": ["…", "…", "…"],
            "correct": 0,
            "xp": 20,
            "hint": "Pense à ce que garantit la clé privée.",
            "explanation": "La signature prouve l'intégrité du message…",
            "source": "MIT OpenCourseWare, 6.858 Computer Systems Engineering, Spring 2014",
            "licence": "CC BY-NC-SA 4.0"
          }
        ]
      }
    }
  ]
}
```

- `room` : le **slug** de la room (visible dans l'URL de la room) ;
- `tasks` : `practice`, `test` ou `exam` — la question s'ajoute à cette tâche ;
- `mode` : `choice` (choix), `text` (réponse libre), `flag` (drapeau de la
  machine), `action` (action à faire dans la machine).

**Les questions de drapeau et d'action restent des nôtres** : elles ne
peuvent pas venir d'un catalogue, parce qu'elles dépendent de **notre**
machine. Le catalogue alimente le QCM et les questions de compréhension ;
nos défis pratiques restent nos défis.

---

## 5. Ce qui se passe après l'import

1. Le fichier `includes/content-import-<source>.php` est écrit dans le
   plugin.
2. Au démarrage, le plugin charge ces fichiers et **ajoute** les questions
   aux tâches de la room visée — elles passent exactement la même
   normalisation que les autres (mêmes règles, même nettoyage).
3. La **moteur d'épreuves** les tire au sort comme les autres : elles
   entrent dans le réservoir du niveau et chaque élève reçoit sa copie.
4. La room affiche un encart **« Sources »** en bas de page : nom, lien,
   licence, attribution. C'est l'exigence de la licence, elle est donc
   visible par l'apprenant, pas cachée dans un fichier technique.

---

## 6. Ce que ça change pour l'apprenant

- **Plus de questions** : le réservoir de chaque niveau s'agrandit avec
  chaque lot importé, donc les copies sont encore plus différentes.
- **Des questions de vraie valeur** : ce sont des questions d'université
  ou de certification, pas des questions dmidaillées.
- **Le même confort** : mélange des propositions, tirage dans le niveau,
  chiffres qui changent quand c'est possible.

---

## 7. Le premier import réel : les quiz d'examen du MIT 6.858

Décision du 02/11/2026 : **remplir d'abord les réservoirs d'examen trop
justes** (24 examens dont le réservoir était à peine cinq fois plus grand
que l'épreuve) en important des questions déjà écrites et corrigées par le
MIT.

### Ce qui a été récupéré

| Élément | Détail |
|---|---|
| Cours | MIT 6.858 *Computer Systems Security*, Fall 2014 |
| Fichiers | 24 PDF : 12 quiz (2011→2014) + 12 corrigés officiels |
| Licence | CC BY-NC-SA 4.0 — réutilisation non commerciale, partage dans les mêmes conditions |
| Méthode | Le zip du cours (625 Mo) téléchargé en une requête, puis les 24 PDF extraits et convertis en texte (`pdftotext`) |

### Ce qui a été retenu : 132 questions sur 223 items (v0.11.0, 02/11/2026)

Le premier import (v0.10.0) n'avait retenu que **17 questions** : le
parseur ne savait lire que les items à choix. Les corrigés du MIT
contiennent aussi — et surtout — des **problèmes d'examen rédigés**, dont
la réponse officielle est une explication en prose. C'est le gros du
matériel : **115 problèmes sur 132**.

| Type d'item dans le corrigé du MIT | Nombre | Comment la plateforme le rend |
|---|---|---|
| QCM (3 propositions) et vrai/faux | 17 | Une question à choix, propositions d'origine, ordre mélangé |
| **Problème d'examen rédigé** | **115** | Nouveau type `solution` : l'élève rédige sa réponse, puis la **correction officielle du MIT** s'affiche mot pour mot |

Le type `solution` a été ajouté au moteur (v0.11.0) :

- la question n'a **ni propositions ni note automatique** — une rédaction
  ne se note pas par une machine, et inventer une note serait mentir ;
- l'élève doit écrire au moins quelques mots (sinon le bouton refuse) ;
- la correction officielle de l'école est affichée **après** sa réponse ;
- l'auditeur de contenu exige que cette correction soit présente (80
  caractères minimum), avec source et licence — sinon la question est
  rejetée.

**Ce qui a été refusé, et pourquoi.** Le parseur refuse tout énoncé qui
ne se comprend pas seul (« Line 4 », « the figure above », « as described
in the paper »), toute correction trop courte, et tout doublon (les mêmes
quizs sont repris d'année en année).

### Ce qui avait été retenu : 17 questions sur 59 (v0.10.0)

Le parseur (`tools/import-mit-ocw.py`) lit les items du corrigé et **refuse**
ce qui ne serait pas honnête :

| Filtre | Pourquoi |
|---|---|
| La réponse doit être dans le corrigé officiel | On ne devine pas la réponse |
| Le corrigé doit **expliquer** la réponse (≥ 40 caractères) | Sans explication, l'élève devinerait — et la plateforme promet l'inverse |
| L'item doit se comprendre seul | « Line 4 », « the figure above », « as described in the paper » sont refusés : sans la figure du PDF, la question est incompréhensible |
| Énoncé de plus de 50 caractères | Un énoncé tronqué n'est pas une question |
| Pas de doublon | Les mêmes quizzes sont repris d'année en année |

Chaque item est rattaché à **son énoncé parent** (celui qui contient le
listing de code) : sans cela, « An adversary can trick the program… » ne
veut rien dire.

### Le format d'origine est conservé

Les examens du MIT ont **deux propositions** (vrai/faux) ou **trois** (QCM).
On **n'ajoute pas** de fausse proposition pour atteindre quatre : ce serait
inventer de la matière. L'auditeur de contenu a donc été adapté :

- nos questions : quatre propositions (inchangé) ;
- questions importées : deux ou trois propositions, **avec** source et
  licence obligatoires.

### Où sont allées les questions

Les questions importées sont ajoutées à la tâche **d'entraînement** de la
room, et non à la tâche d'examen. Raison : le réservoir d'un examen, c'est
la section entière (le niveau), pas l'épreuve elle-même. Ajouter une
question à l'épreuve.allongerait l'épreuve — et l'exigence « un réservoir
au moins cinq fois plus grand »_mount proportionnellement. En les mettant
dans l'entraînement :

- le **réservoir** du niveau grandit (donc les copies sont plus variety) ;
- l'**épreuve** reste à sa longueur ;
- et comme le tirage pioche dans le réservoir, ces questions du MIT peuvent
  tout de même apparaître dans une copie d'examen.

### Le résultat mesuré

| Avant import (v0.9.1) | Après le premier import (v0.10.0) | Après l'import complet (v0.11.0) |
|---|---|---|
| 392 questions sur la plateforme | 409 questions | **524 questions** |
| 24 examens au réservoir trop juste (mesure gonflée) | 36 examens (mesure honnête : le réservoir comptait les questions en double) | **22 examens** |
| 131 365 839 copies possibles (gonflé) | 2 039 152 copies | **636 150 892 copies** |
| Réservoir par examen : 6 à 24 (médiane 17) | 6 à 24 (médiane 17) | **9 à 39 (médiane 24)** |

Le reste du manque est mesuré, pas caché :
`scripts/audit/probe-reservoirs.php` donne le réservoir réel (questions
distinctes), l'épreuve et le manque de chaque examen ; et
`scripts/audit/probe-copies.php` vérifie que vingt élèves reçoivent vingt
copies **et** vingt ensembles de questions différents.

---

## 8. Les trois refus qui comptent (PortSwigger, MIT 6.1600, OpenLearn)

### PortSwigger Web Security Academy : **non réutilisable**

C'était la première source choisie. La lecture des conditions
d'utilisation (section 7.4 « personal use only », 7.7 usage commercial
interdit, et § 9.5 qui interdit la copie et la diffusion des éléments
d'examen) montre que **la copie verbatim des questions est interdite** :
la Web Security Academy n'est pas sous licence libre.

Décision : **rien n'est copié**. En revanche, la plateforme **cite** la
Web Security Academy comme *pratique liée* dans cinq leçons (les élèves
peuvent aller s'entraîner gratuitement sur PortSwigger) — c'est un lien,
pas une rediffusion. Cette décision est **prouvée par un test automatique**
(`tests/import-test.py`, exécuté dans la CI) : un lot qui prétend venir de
PortSwigger est refusé, avec le motif.

### MIT 6.1600 Foundations of Computer Security : **non réutilisable (pas de licence)**

Trouvé le 02/11/2026 : le cours du MIT 6.1600 (sécurité informatique,
MIT EECS) publie sur son site des **quiz d'entraînement avec leurs
corrigés officiels** — du matériel de très grande qualité, exactement le
type de contenu qu'on veut. Mais le site du cours **ne porte aucune licence
Creative Commons** : le droit d'auteur reste aux enseignants.

Décision : **rien n'est copié**. La plateforme cite le cours (l'élève peut
télécharger les quiz et les corrigés sur le site du MIT). Cette décision
est **prouvée par un test automatique** (`tests/import-test.py`, exécuté
dans la CI) : un lot qui prétend venir de MIT 6.1600 est refusé, avec le
motif. Si MIT publie un jour cette version sous licence CC, la source
passera dans le catalogue et l'import sera possible.

> **À retenir pour l'avenir** : une source gratuite et universitaire n'est
> pas automatiquement réutilisable. Ce qui compte, c'est la licence
> explicite. C'est pourquoi le catalogue `tools/sources-autorisees.json`
> porte, pour chaque source, la licence **et** la décision, avec la
> date de la vérification.

### OpenLearn (The Open University) : réutilisable, mais pas extractible

Les quiz hebdomadaires sont bien publiés en **CC BY-SA 4.0**. Mais les
questions ne sont pas dans le HTML de la page (elles sont derrière Moodle) et
il n'y a pas d'export : l'extraction automatique est impossible aujourd'hui.

---

## 9. Ce qu'il reste à faire (décisions, pas technique)

Les décisions prises le 02/11/2026 :

- **Panel d'élèves élargi à 20 profils** (âges, langues, spécialités
  cyber différents) — c'est fait, et c'est mesuré.
- **Première source d'import : PortSwigger** — impossible à copier (§ 8),
  donc cited comme pratique liée ; la première source réellement importable
  est le MIT OCW (§ 7).
- **Pas de langue supplémentaire** : arabe, français, anglais. Les
  questions importées restent **en anglais**, signalées à l'élève
  (« question d'examen MIT, en anglais ») et **jamais réécrites**.
- **Import ciblé** sur les 24 examens au réservoir trop juste.

Ce qui reste ouvert :

- **Quelle source pour la suite ?** Le catalogue contient sept sources
  réutilisables ; chacune doit être travaillée comme le MIT (chercher les
  questions, vérifier la licence, écrire l'extracteur). C'est du temps de
  machine, pas une décision.
- **Le reste du manque** (85 questions sur 22 examens) ne se comble pas
  avec le MIT seul : il faut d'autres sources, ou élargir le réservoir au-delà
  de la section — décision qui appartient au propriétaire.

---

*Document vivant : mis à jour à chaque import. Le détail des vérifications
de licence (date, URL exacte) reste dans `docs/SOURCES-CONTENU.md`.*
