# Plan : amener un élève de zéro à réussir Security+

> **Objectif, dans les mots du commanditaire :** pas un certificat maison. Des
> élèves **aptes à passer les certifications de renom et à les réussir** —
> Security+ d'abord — y compris un élève qui part de très loin, avec une
> progression ludique.
>
> **Règle de ce document :** chaque proposition a un **chiffre avant**, un
> **chiffre cible**, et une **preuve** exécutable. Rien n'est « premium » sur
> parole.

---

## 0. Le chiffre de départ, mesuré

`tools/certifications/couverture.php` (nouveau, dans cette branche) mesure la
couverture des 34 sujets officiels de SY0-701, pondérée par les poids du
référentiel, et distingue trois états : `absent`, `partiel` (le contenu en
parle, on ne pratique pas), `complet` (une room pratique en parle).

```
REFERENTIEL : CompTIA Security+ (SY0-701)
Rooms analysees : 52 dont 18 avec au moins un exercice reellement pratique

D1 Concepts generaux          (12%) : 50.0% couvert
D2 Menaces et vulnerabilites  (22%) : 62.5% couvert
D3 Architecture               (18%) : 50.0% couvert
D4 Operations de securite     (28%) : 62.5% couvert
D5 Gouvernance                (20%) : 30.0% couvert

COUVERTURE PONDEREE : 52.2%
```

**Et ce chiffre est généreux** : un sujet `partiel` compte pour 0,5 alors que
l'élève n'a rien pratiqué. Lu sévèrement (théorie = 0), la couverture est de
**~35 %**. Le document disait « ~40 % » ; le vrai chiffre est celui-là.

**Ce qui manque, nommément** (19 sujets) : zéro trust, gestion du changement,
contrôles de sécurité, sécurité physique, malwares, attaques réseau, indicateurs
de compromission, cloud/hybride, classification et DLP, forensique, réponse à
incident, automatisation/SOAR, gouvernance, registre des risques, risque tiers,
conformité, sensibilisation.

Le plus grave n'est pas la liste : c'est que **D4 (28 % de l'examen) et D5
(20 %)** — 48 % du score — sont les deux domaines les plus faibles.

---

## 1. Tes six questions, une par une

### 1.1 « Un contenu premium ne laisse pas passer quelqu'un qui n'a pas compris » — comment ?

Aujourd'hui, trois portes restent ouvertes, et chacune est mesurable :

| Porte ouverte | Preuve | Correction |
|---|---|---|
| Tentatives d'examen **illimitées** | `finish_exam` incrémente `attempts` et l'ignore | 3 tentatives, puis délai de 24 h |
| Seuil à **60 %** sur 69 % de QCM à 4 choix | 25 % par question au hasard | seuil 80 %, et QCM ≤ 40 % des examens |
| Mode `solution` validé par **≥ 10 caractères** | `class-secura-ajax.php` : `$correct = strlen(trim($answer)) >= 10` | voir §1.5 |

La troisième est la plus grave, et c'est un jeu d'enfant à fermer : **n'importe
quelle réponse de dix caractères vaut « correct »**. C'est ce qui permet à ton
élève de cocher 1 777 des 1 891 questions importées sans lire.

**La règle à adopter, une seule, applicable à tout :** *un point de contrôle ne
valide pas une intention, il valide une production vérifiable.* Une commande
juste, une valeur trouvée, un drapeau. Jamais « l'élève a écrit quelque chose ».

### 1.2 Les 42 drapeaux qui se lisent — tu proposes quoi ?

**Constat :** 42 drapeaux sur 60 sont écrits en clair dans un fichier de la
machine (`/srv/cours/`, `/srv/dojo/`, `/srv/briefs/`). Les 22 rooms `univ`
partagent une seule image, sans un seul binaire vulnérable.

**Proposition — 5 machines à écrire, pas 42 :**

| Machine | Ce qu'elle contient | Rooms servies | Ce que l'élève fait vraiment |
|---|---|---|---|
| `web-02` | app avec injection SQL, XSS stockée, IDOR, upload non filtré | univ-05, univ-18, univ-19 | injecte, vole une session, contourne un contrôle d'accès |
| `bin-02` | 4 binaires C vulnérables (débordement, format string, ROP, canari) | univ-02, univ-10, univ-11, univ-12, univ-13 | déborde une pile, lit un `printf`, chaîne des gadgets |
| `net-02` | journal réel + capture + règles de pare-feu commentées | univ-06, univ-20, m3-07, m3-08 | analyse une capture, reconstitue une intrusion |
| `crypto-02` | certificat expiré, clé privée laissée, hash salé/non salé | univ-07, univ-09, avance-07 | vérifie une chaîne, casse un hash faible |
| `gov-02` | dossier d'entreprise : politique, registre des risques, contrat fournisseur, journal d'audit | univ-01, les 5 futures rooms D5 | **audite** : trouve l'écart entre la politique et la réalité |

Le drapeau n'est **jamais** dans un document : il est le **résultat** d'une
action (une requête qui renvoie autre chose, un offset calculé, une entrée
retrouvée dans le journal) ou un **identifiant** que le serveur tire d'un état
modifié dans la machine.

**Effet mesuré :** le script `couverture.php` compte les rooms « pratiques »
(18 aujourd'hui). Cible : **52/52**. Et un nouveau contrôle, `drapeaux-lisibles.php`,
refuse tout drapeau dont l'indice contient `/srv/cours`, `/srv/dojo`, `/srv/briefs`.

### 1.3 Les examens ne discriminent pas — tu proposes quoi ?

Quatre changements, tous mécaniques :

1. **Tentatives limitées** : 3 par examen, puis 24 h. Le code a déjà le compteur
   (`attempts`), il suffit de le lire.
2. **Seuil 80 %** au lieu de 60 %, et **note de pratique obligatoire** : une
   room n'est validée que si l'examen *et* l'exercice pratique sont réussis.
3. **Moins de QCM, plus de production** : cible ≤ 40 % de QCM dans les examens
   (69 % aujourd'hui). Les autres questions demandent une valeur, une commande,
   ou un drapeau.
4. **Banque de questions étiquetée par sujet officiel.** Chaque question porte
   son `sujet` (`4.3`, `5.2`…). L'examen tire **par domaine, selon les poids** :
   12 % de D1, 22 % de D2, 18 % de D3, 28 % de D4, 20 % de D5. Résultat : les
   examens de la plateforme ressemblent à l'examen réel, et un domaine faible
   ne peut plus être évité.

**Le mode `solution`** (1 777 questions MIT/Stanford) devient : évaluation
automatique quand une grille de mots-clés existe, sinon **auto-évaluation
explicite** — l'élève compare sa réponse à la correction officielle et déclare
« j'avais / je n'avais pas » — puis **répétition espacée** sur les questions
déclarées ratées. On ne prétend jamais qu'une machine corrige de la prose, mais
on ne laisse plus passer « dix caractères ».

### 1.4 Réussir les certifications renommées — comment, concrètement ?

Une préparation à un examen se juge sur quatre choses. Voilà l'état et la cible :

| Élément d'une préparation | Aujourd'hui | Cible |
|---|---|---|
| **Couverture du référentiel** | 52,2 % (35 % sévère) | **100 %** des 34 sujets, dont 80 % en pratique |
| **Banque de questions au format de l'examen** | 114 QCM importés | **600 questions** étiquetées par sujet, dont **180 PBQ** |
| **Examens blancs chronométrés au format réel** | non | **3 examens blancs** de 90 questions / 90 min, 5 domaines pondérés, score sur 100-900, seuil 750 |
| **Diagnostic de faiblesse** | non | après chaque blanc, liste des sujets < 70 %, avec les rooms à refaire |

C'est le quatrième point qui fait la différence entre « avoir suivi un cours » et
« être prêt ». Un élève qui sait *où* il est faible peut travailler ; un élève à
qui on dit « 60 %, validé, bravo » ne le sait pas.

**Calendrier proposé (mesurable, 8 semaines) :**

| Semaine | Livrable | Preuve |
|---|---|---|
| 1 | `gov-02` + 5 rooms D5 (gouvernance, risques, tiers, conformité, sensibilisation) | D5 passe de 30 % à 100 % |
| 2 | `net-02` + rooms 2.6, 2.8 (attaques réseau, IoC) | D2 passe de 62,5 % à 100 % |
| 3 | `crypto-02` + 3.1, 3.4 (cloud, DLP) | D1 100 %, D3 100 % |
| 4 | `web-02` + `bin-02` : les 22 rooms `univ` passent en pratique | 52/52 rooms pratiques |
| 5-6 | Banque de 600 questions étiquetées + 180 PBQ | tirage pondéré par domaine |
| 7 | 3 examens blancs au format réel + diagnostic | score 100-900 reproductible |
| 8 | Mode `solution` corrigé + répétition espacée | plus aucune validation à 10 caractères |

**Résultat visé :** `couverture.php` à **100 %** et un élève dont le score au
blanc est ≥ 750 avant qu'on lui conseille de payer 439 $.

### 1.5 Le cas « QI de chimpanzé, manière ludique » — ce qui marche vraiment

Je vais être direct : **on ne rend pas Security+ accessible à quelqu'un qui ne
peut pas lire un énoncé**. L'examen est en anglais technique, chronométré,
avec des PBQ à mener en 90 minutes. Aucune interface ludique ne contourne ça.

Ce qui marche, en revanche, et qui est la vraie réponse :

- **Des marches de 7 minutes.** Chaque room découpée en unités courtes, avec un
  objectif unique et un feedback immédiat. La durée déclarée moyenne est de
  63 min par room : c'est trop pour un débutant.
- **Zéro échec sec.** Une mauvaise réponse ne bloque jamais : elle ouvre un
  indice de plus en plus précis, puis la correction. Le progrès reste visible
  même en se trompant.
- **La répétition espacée** sur ce qui a été raté : c'est la seule technique
  dont l'efficacité est solidement établie, et elle est gratuite à coder.
- **Des jetons et des médailles qui disent la vérité.** Aujourd'hui une médaille
  de bronze s'obtient à 60 % avec indices. Elle ne doit plus s'obtenir qu'à
  production réelle, sinon elle ment à l'élève.
- **Le mode « guidé » vs « seul »** : les premières rooms donnent la commande
  exacte, les suivantes seulement l'objectif. C'est ce qui fait passer de
  « suivre » à « faire ».

**Ce qu'il ne faut pas promettre :** « même un débutant total réussira
Security+ ». Ce qui est promis, et qui est vérifiable : **un élève qui termine
le parcours et obtient ≥ 750 au blanc a une probabilité sérieuse de réussir**,
parce que son blanc est au format de l'examen et couvre les mêmes domaines avec
les mêmes poids.

### 1.6 Les 1 891 questions MIT/Stanford cachées — tu proposes quoi ?

**Diagnostic exact :** 1 777 sur 1 891 sont en mode `solution`, et ce mode est
validé par `strlen(trim($answer)) >= 10`. Elles sont invisibles dans les rooms
(versées dans une « réserve » de tirage) et, quand elles sortent, elles ne
prouvent rien. C'est le meilleur contenu du dépôt, et il est gâché deux fois.

**Proposition en 4 étages :**

1. **Les rendre visibles là où elles ont du sens.** Créer pour chaque cours
   source une room « Examen blanc MIT 6.858 » (ou Stanford CS107) qui présente
   les questions avec leur attribution et leur licence, en mode **révision
   assumée** : l'élève rédige, puis compare à la correction officielle. Ce n'est
   pas un point de contrôle, c'est une **banque d'entraînement de haut niveau**,
   et elle est étiquetée comme telle.
2. **Grille de correction automatique pour les questions factuelles.** Beaucoup
   de ces questions attendent 3 à 8 concepts-clés (« TGT », « ticket de
   service », « clé de session »). Une grille de mots-clés obligatoires, écrite
   à la main une fois, donne une correction objective sans prétendre comprendre
   la prose. Les autres restent en auto-évaluation.
3. **Répétition espacée.** Toute question déclarée ratée revient à J+1, J+3,
   J+7. C'est là que se joue la mémorisation réelle, et c'est mesurable : taux
   de réussite à la deuxième présentation.
4. **Alimenter les examens par sujet.** Les 114 QCM importés (choix multiples)
   rejoignent la banque étiquetée et servent au tirage pondéré par domaine. Les
   `solution` n'entrent jamais dans un examen chronométré : elles servent à
   apprendre, pas à noter.

**Effet :** le contenu le plus crédible du dépôt devient visible, attribué, et
utilisable — au lieu d'être un tirage invisible validé par dix caractères.

---

## 2. Ce que je ne promets pas

- **Aucun certificat ne sera délivré par nous.** Security+ s'achète chez
  CompTIA (439 $). Ce qu'on peut garantir, c'est la **préparation**, mesurée par
  le blanc.
- **La couverture par mots-clés n'est pas la qualité pédagogique.** Le script
  mesure la présence d'un sujet, pas sa clarté. Un sujet « complet » peut être
  mal expliqué : c'est un travail de relecture humaine, pas de script.
- **8 semaines pour 100 % de couverture et 600 questions est un rythme de
  production soutenu.** C'est faisable ; ce n'est pas gratuit en travail.
- **Je n'ai pas pu démarrer les machines** (`internal-01`, `net-01`,
  `multi-01`) dans cet environnement : Docker est absent. Je sais qu'elles sont
  construites par le CI, pas ce qu'elles contiennent à l'exécution.

---

## 2 bis. Ce qui est déjà fait dans cette branche

Les points 1 à 4 du plan sont faits et prouvés par des tests, pas par des
intentions. Chiffres mesurés le 6 novembre 2026.

| Point du plan | État | Preuve chiffrée |
|---|---|---|
| Mesurer la couverture au lieu de l'affirmer | **fait** | `tools/certifications/couverture.php` + `sy0-701.json` : 34 sujets, poids officiels, **52,2 %** mesurés, sort 1 sous le seuil |
| Fermer la porte des dix caractères | **fait** | `Secura_Solution` + `tests/solution-test.php` (8 essais) ; CI verte |
| Auto-évaluation explicite pour les questions sans grille | **fait** | l'élève voit le corrigé, les concepts manquants, et se positionne |
| Ne plus mentir sur la validation | **fait** | le message dit « vous avez comparé au corrigé et confirmé » |
| **Limiter les tentatives d'examen** | **fait** | `Secura_Gate` : 3 tentatives, puis 24 h ; refus de rejouer un examen déjà réussi. `tests/gate-test.php` (16 essais) |
| **La pratique obligatoire pour valider une room** | **fait** | une room dont une manipulation reste à faire ne se valide pas ; l'élève lit combien il en reste. Même test |
| **Étiqueter les questions par sujet** | **fait** | `content-sy0-701-banque.php` : **94 questions**, toutes étiquetées de 1.1 à 5.5, champ `topic` transporté par `Secura_Rooms` |
| **Tirage pondéré par domaine** | **fait** | `Secura_Blanc` : 90 questions réparties 11/20/16/25/18, total toujours respecté (plus fort reste). `tests/blanc-test.php` (31 essais) |
| **Barème du référentiel** | **fait** | échelle 100–900, seuil 750. Mesuré : 73/90 → **749, échoue** ; 74/90 → **758, réussit** |
| **Contrôle anti-drapeau-lisible dans le CI** | **fait** | `tools/controle/drapeaux-lisibles.php` + échéancier daté. État : **18 manipulations réelles sur 60 (30 %)** |

### Ce que les tests empêchent, et qui rend un QCM devinable

Un QCM peut être « juste » et mauvais quand même. Trois travers suffisent :

| Travers | Mesure avant | Mesure après |
|---|---|---|
| La bonne réponse est la plus longue | 29 cas sur 68 | **0** |
| La bonne réponse est toujours en A | 64,7 % en A (2,9 % en C) | **24 / 24 / 23 / 23**, soit 25 % partout |
| Un sujet du référentiel n'est jamais interrogé | tirage au hasard | tourniquet entre les sujets + test qui exige ≥ 8 questions par domaine |

`tests/banque-test.php` (18 essais) interdit ces trois travers et vérifie que
chaque question a quatre propositions, un index valide et une explication.

### L'écart qui reste, nommé

| Sujet | Mesure | Ce qu'il reste à faire |
|---|---|---|
| Les 42 drapeaux de lecture | 18 vrais sur 60 | les 5 machines du plan (le gros morceau) |
| Les 15 rooms manquantes | 52,2 % de couverture | D5 (30 % couvert) puis D2 |
| La banque à 600 questions | 94 écrites | 506 à écrire, par sujet, avec la même règle de distracteurs |
| Le seuil à 80 % sur les examens de room | encore 60 % | une ligne par examen ; dépend du contenu de chaque room |

---

## 3. Par quoi je commence, si tu dis oui

Par ordre d'impact sur le score réel de l'élève, et du moins cher au plus cher :

1. **Fermer la porte des 10 caractères** (1 h) — supprime la validation bidon de
   1 777 questions.
2. **Limiter les tentatives et passer le seuil à 80 %** (2 h) — l'examen cesse
   d'être décoratif.
3. **Ajouter l'étiquette de sujet + tirage pondéré par domaine** (1 j) — les
   examens ressemblent à l'examen réel.
4. **Le contrôle anti-drapeau-lisible dans le CI** (2 h) — plus aucun nouveau
   drapeau de lecture n'entre.
5. **Les 5 machines et les 15 rooms manquantes** (le gros morceau) — D5 puis D2,
   parce que ce sont 48 % du score.

Les points 1 à 4 se font dans cette branche et se prouvent par un run CI. Le 5
demande plusieurs jours et un ordre de priorité de ta part.
