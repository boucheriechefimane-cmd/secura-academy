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
| MIT OpenCourseWare (6.858, 6.857) | CC BY-NC-SA 4.0 | **Réutilisable**, avec attribution |
| StanfordSEE | CC BY-NC-SA 4.0 | **Réutilisable**, avec attribution |
| OWASP Cheat Sheet Series | CC BY-SA 4.0 | **Réutilisable**, avec attribution |
| NIST (SP 800-207, SP 800-41r1…) | Domaine public | **Réutilisable** |
| CYBER.ORG | Non vérifiée | Lien seul |
| Examens de certification | Copyright de l'éditeur | **Cas par cas** (voir ci-dessous) |

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

## 7. Ce qu'il reste à faire (décisions, pas technique)

- **Quel volume importer en premier ?** Un lot d'une university's
  (50 questions) ou une certification complète ?
- **Quelle langue ?** Les sources sont en anglais : on importe l'anglais,
  et la traduction se fait par la machine **avec relecture humaine** — ou on
  garde l'anglais en attendant ?
- **Quel public pour le panel d'élèves ?** Voir la question posée à
  l'utilisateur : élargir le panel à d'autres profils (étudiants en
  informatique, reconversions, professionnels) ou garder les 10 profils
  actuels.

---

*Document vivant : mis à jour à chaque import. Le détail des vérifications
de licence (date, URL exacte) reste dans `docs/SOURCES-CONTENU.md`.*
