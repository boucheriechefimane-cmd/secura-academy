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

`tools/certifications/couverture.php` mesure la couverture des 34 sujets
officiels de SY0-701, pondérée par les poids du référentiel, et distingue trois
états : `absent`, `partiel` (le contenu en parle, on ne pratique pas), `complet`
(une room pratique en parle).

**Point de départ, le 6 novembre 2026 au matin :**

```
Rooms analysees : 52 dont 18 avec au moins un exercice reellement pratique

D1 Concepts generaux          (12%) : 50.0% couvert
D2 Menaces et vulnerabilites  (22%) : 62.5% couvert
D3 Architecture               (18%) : 50.0% couvert
D4 Operations de securite     (28%) : 62.5% couvert
D5 Gouvernance                (20%) : 30.0% couvert

COUVERTURE PONDEREE : 52.2 %
```

**Le même chiffre, le 6 novembre 2026 au soir :**

```
Rooms analysees : 57 dont 29 avec au moins un exercice reellement pratique
  dont 18 sur une machine reelle, 11 sur un terminal simule

D1 Concepts generaux          (12%) : 50.0% couvert
D2 Menaces et vulnerabilites  (22%) : 93.8% couvert
D3 Architecture               (18%) : 50.0% couvert
D4 Operations de securite     (28%) : 75.0% couvert
D5 Gouvernance                (20%) : 80.0% couvert

COUVERTURE PONDEREE : 72.6 %
```

**Et ce chiffre reste généreux** : un sujet `partiel` compte pour 0,5 alors que
l'élève n'a rien pratiqué, et 11 des 29 rooms « pratiques » le sont sur un
terminal simulé. Lu sévèrement (théorie = 0, simulation = 0,5), la couverture
réelle est d'environ **55 %**.

**Ce qui manque encore, nommément** (11 sujets) : contrôles de sécurité, zero
trust, gestion du changement, sécurité physique, ingénierie sociale, cloud et
hybride, classification et DLP, IoT et industriel, forensique, automatisation
et SOAR, sensibilisation.

Les deux domaines les plus lourds — D4 (28 %) et D5 (20 %), soit 48 % du score
— sont passés de 62,5 % et 30 % à 75 % et 80 %. Ce qui reste est concentré sur
**D3 (18 % du score, encore à 50 %)** et **D1 (12 %, à 50 %)**.

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
| Mesurer la couverture au lieu de l'affirmer | **fait** | `tools/certifications/couverture.php` : 34 sujets, poids officiels, **72,6 %** mesurés, sort 1 sous le seuil |
| Fermer la porte des dix caractères | **fait** | `Secura_Solution` + `tests/solution-test.php` (8 essais) |
| Auto-évaluation explicite pour les questions sans grille | **fait** | l'élève voit le corrigé, les concepts manquants, et se positionne |
| Ne plus mentir sur la validation | **fait** | le message dit « vous avez comparé au corrigé et confirmé » |
| **Limiter les tentatives d'examen** | **fait** | `Secura_Gate` : 3 tentatives, puis 24 h ; refus de rejouer un examen réussi. `tests/gate-test.php` (16 essais) |
| **La pratique obligatoire pour valider une room** | **fait** | une room dont une manipulation reste à faire ne se valide pas ; l'élève lit combien il en reste |
| **Étiqueter les questions par sujet** | **fait** | `content-sy0-701-banque.php` : **94 questions**, étiquetées de 1.1 à 5.5 |
| **Tirage pondéré par domaine** | **fait** | `Secura_Blanc` : 90 questions réparties 11/20/16/25/18, total toujours respecté. `tests/blanc-test.php` (31 essais) |
| **Barème du référentiel** | **fait** | échelle 100–900, seuil 750. Mesuré : 73/90 → **749, échoue** ; 74/90 → **758, réussit** |
| **Contrôle anti-drapeau-lisible** | **fait, chiffre corrigé** | `tools/controle/drapeaux-lisibles.php` : **45 sur 60 sans copie possible (75 %)**, 15 en dette datée. Le contrôle ouvre désormais les documents et cherche la valeur dedans (voir l'encadré ci-dessous) |
| **Le terminal ne ment plus** | **fait** | `tests/terminal-test.php` (14 essais) : ordre libre reconnu, `ls` n'est plus « introuvable » |
| **Le domaine D5 (20 % du score)** | **fait** | 3 rooms écrites : registre, fournisseur, audit. **30 % → 80 %** |
| **Le domaine D2 (22 % du score)** | **fait** | 2 rooms : capture ARP, chronologie d'incident. **62,5 % → 93,8 %** |
| **Anglais et arabe sur les nouvelles rooms** | **fait** | 57 rooms, **1 714 champs contrôlés, 0 sans traduction** |
| **Le domaine D3 (18 % du score)** | **fait** | 3 rooms : responsabilité partagée, DLP et chiffrement, IoT industriel. **50 % → 100 %** |
| **Le dojo ne se lit plus** | **fait** | 20 défis réécrits : la valeur n'est plus dans le document, elle est **produite** par la commande. Contrôle `dojo-sans-drapeau.py` : 27 documents, **0 fuite** |
| **Les machines sont testées en vrai** | **fait** | `.github/workflows/machines.yml` : `docker build` + épreuves jouées en uid 1000. `epreuves-dojo.py` (20 défis + 2 barrières), `epreuves-web.py` (5 épreuves) |
| **Une page d'attribution unique** | **fait** | `/sources-et-licences` : 67 sources, 9 republiables / 53 à conditions / 5 en renvoi. Audit : `docs/AUDIT-LICENCES-HEBERGEABLE.md` |
| **La double mesure, en une commande** | **fait** | `couverture.php` affiche la mesure officielle **et** la borne basse sévère |

### Ce que les tests empêchent, et qui rend un QCM devinable

Un QCM peut être « juste » et mauvais quand même. Trois travers suffisent :

| Travers | Mesure avant | Mesure après |
|---|---|---|
| La bonne réponse est la plus longue | 29 cas sur 68 | **0** |
| La bonne réponse est toujours en A | 64,7 % en A (2,9 % en C) | **24 / 24 / 23 / 23** |
| Un sujet du référentiel n'est jamais interrogé | tirage au hasard | tourniquet entre les sujets + test qui exige ≥ 8 questions par domaine |

`tests/banque-test.php` (18 essais) interdit ces trois travers et vérifie que
chaque question a quatre propositions, un index valide et une explication.

### La couverture, sujet par sujet

```
D1 — Concepts generaux       (12 %) : 50,0 % couvert   (1.1, 1.3, 1.4 absents ; 1.7 theorie)
D2 — Menaces et vulnerabilites (22 %) : 93,8 % couvert   (2.3 theorie seulement)
D3 — Architecture            (18 %) : 100,0 % couvert  (3.1, 3.4, 3.6 combles)
D4 — Operations              (28 %) : 75,0 % couvert   (4.7, 4.8 absents)
D5 — Gouvernance             (20 %) : 80,0 % couvert   (5.5 absent)
COUVERTURE PONDEREE : 83,0 %
BORNE BASSE (severe) : 39,1 %
60 rooms, dont 32 avec un exercice reellement pratique
  dont 18 sur une machine reelle, 14 sur un terminal simule
```

**Sur les deux chiffres, et pourquoi ils sont si éloignés.** La mesure
officielle compte un sujet couvert dès qu'une room *pratique* en parle — un
terminal simulé fait agir l'élève, donc il compte. La mesure sévère ne compte
que les preuves **vérifiables par le serveur**, c'est-à-dire un drapeau lu
dans `/root/flags` sur un conteneur : le terminal simulé vaut 0.

L'écart 83 % / 39 % n'est donc pas une incertitude, c'est une **question de
définition**, et les deux définitions sont affichées plutôt qu'une seule. Le
premier chiffre répond à « le sujet est-il enseigné et pratiqué ? » ; le
second à « combien de sujets sont prouvés sur une vraie machine ? ». Quand le
point 5 du plan sera fait (les machines branchées sur les rooms), les deux
colonnes convergeront : c'est le seul moyen de les faire converger.

Un détail de mesure corrigé au passage : la borne basse jugeait « lecture
seule » d'après le **texte de l'indice**. Or le dojo dit désormais dans ses
indices que le drapeau n'est *pas* dans le document — l'ancienne heuristique
comptait donc ces rooms comme lecture. Elle se juge maintenant sur le
`flag_path` (`/root/flags/...`), qui est la seule preuve exploitable.

### L'écart qui reste, nommé

| Sujet | Mesure | Ce qu'il reste à faire |
|---|---|---|
| ~~D3 Architecture (18 %)~~ | ~~50 %~~ **100 %** | **fait** le 6 novembre : trois rooms avec mission dans le terminal |
| D1 Concepts (12 %) | 50 % | 3 rooms : contrôles (1.1), zero trust (1.3), gestion du changement (1.4) |
| D4 Opérations (28 %) | 75 % | 2 rooms : forensique (4.7), automatisation et SOAR (4.8) |
| D5 Sensibilisation (5.5) | absent | 1 room, la dernière du domaine le plus faible |
| ~~Les 42 drapeaux de lecture~~ | ~~18 vrais sur 60~~ **45 sur 60** | le dojo (20) est fait ; **15 drapeaux de univ-01 restent des lectures** (l'atelier de 22 livrables), en dette au 20/11/2026 |
| La banque à 600 questions | 94 écrites | 506 à écrire |
| Le seuil à 80 % sur les examens de room | encore 60 % | une ligne par examen |

---

## 3. Ce qui reste, par ordre d'impact

Le plan initial comptait cinq chantiers. Les cinq sont faits, sauf le dernier,
qui est le plus gros. Voici ce qui reste, chiffré.

| Rang | Chantier | Effort | Gain mesuré |
|---|---|---|---|
| ~~1~~ | ~~**D3 Architecture** : 3 rooms~~ | ~~1 j~~ **fait** | D3 50 % → **100 %** : +9 points mesurés (72,6 % → 83,0 % avec le reste) |
| 1 | **D1 Concepts** : 3 rooms (contrôles, zero trust, gestion du changement) | 1 j | D1 50 % → ~93 %, soit **+5 points** |
| 3 | **D4 Opérations** : 2 rooms (forensique, SOAR) | 0,5 j | D4 75 % → 100 %, soit **+7 points** |
| 4 | **D5 sensibilisation** : 1 room | 0,5 j | D5 80 % → 100 %, soit **+4 points** |
| ~~5~~ | ~~**Les 5 machines** qui remplacent les 42 drapeaux de lecture~~ | ~~4-5 j~~ **fait aux trois quarts** | 45 drapeaux sur 60 sans copie possible ; reste les 15 livrables de univ-01 à transformer en manipulations |
| 5 bis | **univ-01 : produire les 15 valeurs au lieu de les écrire** | 1 j | 45 → 60 drapeaux sans copie possible, et la borne basse de couverture remonte |
| 6 | **La banque à 600 questions** | 3 j | blancs de 90 questions renouvelables sans doublon |
| 7 | **Le seuil à 80 %** sur les 57 examens de room | 2 h | les examens cessent d'être faciles |

Le point 1 étant fait, les points 1 à 4 restants (D1, D4, D5) tiennent en
deux jours et porteraient la couverture pondérée de **83,0 % à environ 99 %**. C'est le meilleur rapport effort/résultat
disponible aujourd'hui.

Le point 5 est fait, et il l'est d'une façon qu'il faut dire précisément :
les 60 drapeaux se lisent désormais dans `/root/flags`, sur une machine, et
non dans un document. Cela ne veut pas dire que les 60 sont *produits* par
une manipulation : la distinction est celle des deux colonnes de couverture
(83 % / 39 %). Ce qui est acquis :

- le dojo : **20 défis** où la valeur est **produite** par la commande
  (vérifiés un par un dans un conteneur, par `tools/labs/epreuves-dojo.py`) ;
- web-01, bin-01, multi-01 : le drapeau est sur la machine, hors de portée
  d'un `cat` de document ;
- **univ-01 : 15 drapeaux sur 22 restent des lectures.** Le document de cours
  contient la valeur en clair (`risque_critique = SECURA{...}`) : l'élève lit,
  recopie, valide. C'est le prochain cran, en dette datée au 20/11/2026 ;
- 49 rooms sur 60 sont branchées sur une image ; 11 n'en ont pas encore.

### L'erreur de mesure que cette phase a corrigée

Le contrôle affichait « 60 manipulations sur 60 ». C'était faux, et l'erreur
était de ma part : il jugeait sur le **chemin** du drapeau (`/root/flags` ou
non). Or dans univ-01 le drapeau est bien dans `/root/flags`, mais le document
de cours contient la **même valeur** en clair. Le chemin était bon, le défaut
restait.

La version actuelle ouvre les 48 documents que les machines installent sous
`/srv/cours` et `/srv/briefs` et cherche la valeur **dedans**. C'est la seule
preuve qui ne se contourne pas. Chiffre honnête : **45 sur 60 (75 %)**, dont
27 produits par une commande.

Leçon générale, qui vaut pour toute la mesure du site : un contrôle qui
regarde une propriété **déclarée** (un chemin, une étiquette) mesure la
déclaration, pas le réel. Il faut regarder le contenu.

Le workflow `machines.yml` rejoue tout cela à chaque modification de `labs/`,
et une fois par jour : une image amont cassée se voit le lendemain, pas en
salle de classe.
