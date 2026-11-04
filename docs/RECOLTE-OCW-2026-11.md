# Campagne d'import — les cours prioritaires du MIT (04/11/2026)

Ce document est le **carnet de bord factuel** de la campagne d'import
lancée le 04/11/2026 sur les **douze cours prioritaires** de la liste de
travail produite par le criblage (`docs/recolte/criblage-ocw-2026-11-04.json`).

Il répond à trois questions, et à trois seulement :

1. **Qu'est-ce qui a été importé ?** Combien, d'où, avec quelle licence.
2. **Qu'est-ce qui a été refusé ?** Et **pourquoi**, avec la preuve.
3. **Comment le reproduire ?** Une commande.

Rien n'y est déclaré qui n'ait été vérifié. Les chiffres viennent des
mesures ; les refus, de l'outil lui-même.

---

## 1. Le point de départ

Le criblage à six robots (run GitHub `41753782904`) a analysé **430 cours**
MIT OpenCourseWare et en a retenu **66** ayant à la fois un corrigé officiel
et une licence Creative Commons, dont **55 jamais vus**.

Parmi ces 55, douze ont été choisis comme prioritaires (informatique et
sécurité) :

| # | Cours | Slug OCW |
|---|---|---|
| 1 | 6.034 Artificial Intelligence | `6-034-artificial-intelligence-spring-2005` |
| 2 | 6.035 Computer Language Engineering | `6-035-computer-language-engineering-spring-2010` |
| 3 | 6.042J Mathematics for Computer Science | `6-042j-mathematics-for-computer-science-fall-2010` |
| 4 | 6.825 Numerical Computation | `6-825-numerical-computation-spring-2003` |
| 5 | 6.01SC Introduction to EECS I | `6-01sc-introduction-to-electrical-engineering-and-computer-science-i-fall-2005` |
| 6 | 6.111 Introductory Digital Systems Laboratory | `6-111-introductory-digital-systems-laboratory-spring-2006` |
| 7 | 6.450 Principles of Digital Communications I | `6-450-principles-of-digital-communications-i-fall-2006` |
| 8 | 6.262 Discrete Stochastic Processes | `6-262-discrete-stochastic-processes-spring-2011` |
| 9 | 6.341 Discrete-Time Signal Processing | `6-341-discrete-time-signal-processing-fall-2005` |
| 10 | 6.661 Receivers, Antennas and Signals | `6-661-receivers-antennas-and-signals-spring-2003` |
| 11 | 6.832 Underactuated Robotics | `6-832-underactuated-robotics-spring-2009` |
| 12 | 6.253 Convex Analysis and Optimization | `6-253-convex-analysis-and-optimization-spring-2012` |

**132 documents** ont été téléchargés (énoncés + corrigés) en **4 secondes**,
via l'URL directe d'OCW (`https://ocw.mit.edu/courses/<slug>/<hash>_<nom>.pdf`).

L'appariement énoncé ↔ corrigé est fait par `tools/ocw_appariement.py` :
le hash de ressource diffère d'un fichier à l'autre, on compare donc le
**squelette** du nom (`MIT6_111pset01` ↔ `MIT6_111pset01sol`) — **53 paires**
sur les 132 documents.

---

## 2. Ce qui est importé : 135 questions, sept cours

| Cours | Questions | Format | Extractor |
|---|---|---|---|
| 6.661 Receivers, Antennas and Signals | **74** | parties + réponses en ligne | 13ᵉ |
| 6.111 Introductory Digital Systems Lab | **22** | 1 (13ᵉ) + 21 (14ᵉ) | 13ᵉ + 14ᵉ |
| 6.262 Discrete Stochastic Processes | **13** | problème + parties | 13ᵉ |
| 6.253 Convex Analysis and Optimization | **11** | problème + « Solution. » | 13ᵉ |
| 6.832 Underactuated Robotics | **7** | parties + réponses en ligne | 13ᵉ |
| 6.042J Mathematics for Computer Science | **5** | QCM numéroté + « Solution. » | 13ᵉ |
| 6.450 Principles of Digital Communications I | **3** | problème + solution en ligne | 13ᵉ |
| **Total** | **135** | | |

**Licence** : `CC BY-NC-SA 4.0` pour les sept cours — **vérifiée le
04/11/2026 sur la page de chaque cours** (`creativecommons.org/licenses/by-nc-sa/4.0`),
et non déduite d'un cours voisin.

**Attribution** : elle nomme le cours *et* la source des tests
(ex. « MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003 »),
et voyage avec chaque question jusqu'à l'écran de l'élève.

### Les deux extracteurs écrits pour cette campagne

**13ᵉ — `tools/import-mit-probleme-solution.py`** : le format « problème
(numéro + titre) → parties `(a) (b) …` → solution officielle ». Le MIT écrit
ses corrigés de cinq façons différentes selon les cours : « Solution. »,
« Solution 1a): », « [6 points] » suivi de la réponse, réponses en ligne
sans repère, ou problème sans parties. L'extracteur les couvre toutes, et
**refuse** ce qui ne va pas :

| Garde-fou | Ce qu'il attrape |
|---|---|
| `RE_PIED` | pieds de page (`-2-`, `Page 3`, `12/22/03`) |
| `RE_NUMERO_COURS` | deux documents de **cours différents** appariés (6.825 ↔ 6.891) |
| `RE_CODE` | une « réponse » qui est du code |
| `RE_OUTILLAGE` | un exercice d'atelier FPGA (Xilinx, Verilog, testbench) |
| `RE_INCOMPLET` | une question qui renvoie à un schéma (« the tree shown below ») |
| `RE_DEFORME` | un caractère illisible venu de l'extraction PDF |
| `controle_paire()` | un « corrigé » qui est en fait l'énoncé recopié |
| `entete_de_page()` | une réponse qui est l'en-tête du document |

**14ᵉ — `tools/import-mit-expressions.py`** : le MIT 6.111 publie un exercice
d'algèbre booléenne où l'énoncé et le corrigé sont **alignés ligne à ligne**
(`1) a + 0 =` … `1) a + 0 = a`). C'est le seul format où l'appariement se
**prouve** : le membre de gauche doit être rigoureusement identique des deux
côtés. L'extracteur refuse une paire dont les membres de gauche diffèrent.

> **Un piège réel, trouvé et corrigé.** Les items 3 et 4 du 6.111 portent le
> même membre de gauche (`a + a`) mais des réponses différentes (`= 1` et
> `= a`) : la **barre de complément** a disparu à l'extraction. Publier
> « a + a = 1 » aurait été faux. L'extracteur détecte ce cas (même membre de
> gauche, réponses différentes) et refuse **six items** au lieu de les
> publier faux.

### Répartition dans les rooms

La répartition ne se devine pas à partir de mots anglais : elle se fait par
**thème déclaré** du cours d'origine, puis **proportionnellement au manque
mesuré** de chaque section (`tools/repartition-themes.py` +
`tools/cibles-sections.json`).

| Thème | Cours | Room |
|---|---|---|
| `communications` | 6.450, 6.661 | `les-fondamentaux-du-reseau` |
| `algorithmes` | 6.253, 6.262, 6.832, 6.042J, 6.111 | `comment-marche-un-ordinateur-de-la-donnee-au-programme`, `donnees-et-systemes-organiser-linformation` |

Le thème `communications` a été **ajouté** pour la campagne : une question
d'antennes ou de bruit gaussien n'a rien à faire dans « authentification ».
Elle va dans « les fondamentaux du réseau », qui est sa place.

---

## 3. Ce qui est refusé : cinq cours, avec le motif

Cinq des douze cours n'ont produit **aucune** question importable. Les motifs
sont écrits par l'outil, pas prononcés après coup.

| Cours | Motif du refus | Preuve |
|---|---|---|
| **6.034** Artificial Intelligence | l'énoncé renvoie à un **arbre dessiné** (« Consider the tree shown below ») et le corrigé est un **tableau** de résultats (Breadth First → `ABCDEG`, Depth First → `ABDFKLECG`…). Sans le dessin, la question n'a pas de sens ; découper un tableau en quatre questions serait une réécriture. | `RE_INCOMPLET` ; « aucune partie exploitable dans le corrigé » |
| **6.035** Computer Language Engineering | la question dit « State for each of the basic blocks **on the following page** which optimization was performed » : les blocs de base sont **sur la page suivante**, et la réponse est **du code** (le bloc optimisé). | `RE_INCOMPLET` (« the following ») + `RE_CODE` |
| **6.341** Discrete-Time Signal Processing | c'est un **questionnaire à cocher** (YES / NO / CAN'T TELL) ; les cases cochées du corrigé **n'existent pas dans la couche texte** (l'extraction ne garde que « YES NO CAN'T TELL »), et les questions renvoient à des **diagrammes de systèmes**. | marquage invisible à l'extraction + schémas absents |
| **6.825** Numerical Computation | le fichier `s2001final.pdf` est un examen du **6.891** (« 6.891 Final Examination ») et son corrigé `s2001final_sol.pdf` appartient au **6.825** (« 6.825 Recitation Problems: Spring Final »). Ce sont **deux documents différents**. | `RE_NUMERO_COURS` : 6.891 ≠ 6.825 |
| **6.01SC** Introduction to EECS I | les fichiers `_sol` sont des **copies remplies d'un quiz en ligne** (« Full Name: ANSWERS »), pas des corrigés officiels ; les réponses sont du **code Python**. | `controle_paire()` + `RE_CODE` |

**Aucun de ces cinq cours n'a été « complété » par ce que le plugin ou moi
aurions pu inventer.** C'est le refus qui est le résultat honnête.

Deux refus « techniques » valent d'être signalés :

- **6.111, les travaux pratiques** (Verilog, Xilinx ISE, CoreGen, VGA,
  tables de transition de machine à états) : ce sont des manipulations de
  laboratoire qui supposent un outillage absent de la plateforme. Le
  garde-fou `RE_OUTILLAGE` les refuse. Il reste **une** question de ce
  cours qui est du calcul pur (combien de 74LS163 pour une horloge de 1 Hz).
- **6.661 / 6.832** : quelques items changent d'un examen à l'autre ; le
  garde-fou « numéro de cours différent » les laisse passer parce que les
  deux documents portent bien le même numéro — l'appariement est alors
  vérifié **par le contenu** (le membre de gauche, ou le repère
  « Solution 1a): » qui nomme le couple problème/partie).

---

## 4. Mesures

Mesure dans un WordPress local réel (WordPress 7.1.4, plugin v0.12.4) :

| | Avant | Après |
|---|---|---|
| Questions maison (dans les tâches) | 392 | **392** |
| Questions importées (en réserve) | 649 | **784** |
| Questions importées retrouvées **dans** une tâche | 0 | **0** |
| Total de la plateforme | 1 041 | **1 176** |
| Réservoir maximal d'une exam | 393 | **451** |
| Copies servies | médiane 4 / max 10 / min 2 | médiane 4 / max 10 / min 2 |
| Examens au réservoir trop juste | 6 | **6** (manque total 16) |

Le point important : **les 135 questions importées vont toutes dans le
réservoir**, aucune ne se glisse dans une tâche. C'est ce qui permet à
l'élève de les tirer au hasard à l'examen, et à personne d'autre.

Audits locaux : contenu **20/20** (0 bloquant, 0 majeur, 0 mineur),
licences **6/6** (0 bloquant, 0 majeur, 0 mineur), épreuves **16** (0
bloquant, 0 majeur, 1 mineur : les 6 examens au réservoir trop juste).

---

## 4 bis. Un défaut trouvé dans les lots déjà livrés, et la garde-fou qui l'empêche de revenir

### Le défaut

Le contrôle automatique des lots livrés a signalé une chose simple :
la **question 12 du lot MIT 14.15J** finissait par le pied de page du
PDF d'origine :

> `… MIT OpenCourseWare — ocw.mit.edu — 14.15J/6.207J Networks — Spring
> 2018 — For information about citing these materials or our Terms of
> Use, visit: …`

L'élève lisait donc la mention de copyright du MIT à la fin de son
énoncé. C'est le genre de détail que l'on ne voit pas en relisant vite,
et qui donne l'impression que la plateforme a mal préparé ses copies.

### La cause

Le pied de page d'OCW n'est **pas une ligne**, c'est un **bloc** :

```
1                    <- numéro de page
MIT OpenCourseWare   <- le marqueur
ocw.mit.edu
14.15J/6.207J Networks
Spring 2018
For information about citing these materials or our Terms of Use, visit:
```

L'ancien nettoyage (une expression régulière) ne retirait que la ligne
qui porte le marqueur. Les autres lignes restaient, et — selon la
manière dont le PDF était coupé — le bloc pouvait même se retrouver **au
milieu** de l'énoncé.

### Le correctif

Un module unique, `tools/ocw_pieds.py`, fait le travail :

1. le texte est découpé sur les sauts de page (`\x0c`) ;
2. **un morceau entier** qui commence par un marqueur d'OCW
   (`MIT OpenCourseWare`, `ocw.mit.edu`, `Terms of Use`) est retiré —
   pas seulement sa première ligne ;
3. le numéro de page isolé qui précède ce morceau est retiré aussi.

Les deux extracteurs qui produisent ces lots (sous-questions, parties +
réponses) l'utilisent désormais.

### La preuve qu'on n'a rien perdu

Les 24 documents des deux cours ont été retéléchargés et les lots
régénérés, puis comparés question par question avec les lots livrés :

| Cours | Questions | Énoncés | Corrections | Écart |
|---|---|---|---|---|
| MIT 14.15J | 14 | 14/14 identiques | 14/14 identiques | aucun |
| MIT 6.851 | 12 | 12/12 | 12/12 | le pied de page seul |
| MIT 18.404J | 20 | 20/20 | 20/20 | le pied de page seul |

Et l'audit ligne à ligne des 24 documents (présence effective de chaque
ligne dans le texte nettoyé) : **0 ligne de contenu réellement perdue**.

### La garde-fou : une room inconnue ne peut plus disparaître en silence

En régénérant les lots, un second défaut est apparu : une room
inexistante dans un lot n'est **pas signalée** par le plugin — il ignore
simplement les questions concernées. Trente-deux questions avaient ainsi
disparu de la mesure, sans le moindre avertissement.

Désormais :

- `tools/rooms-connues.json` liste les 52 rooms que le plugin sait
  créer (le script `tools/rooms-connues.py` le produit et le compare aux
  rooms réellement créées sur le site) ;
- `tools/import-questions.py --verifier` **refuse** un lot dont la room
  n'existe pas, et propose la room connue la plus proche ;
- `tools/controler-lot.py` fait le même contrôle ;
- `tests/import-test.py` le vérifie à chaque push.

---

## 4 ter. La deuxième vague : vingt cours de plus (04/11/2026)

### Le point de départ

La liste de travail est le rapport de criblage de la CI : **430 cours
analysés, 66 avec un corrigé ET une licence Creative Commons, 55
n jamais vus**. Les **44 cours restants** ont été téléchargés par
`tools/telecharger-ocw.py --direct` : **850 documents, 66 dossiers,
193 Mo, 33 secondes**.

### La carte des formats

Avant d'écrire quoi que ce soit, `tools/carte-cours.py` a fait l'inventaire
: pour chaque cours, combien de documents, combien de paires
énoncé/corrigé, et quel extracteur les couvre. C'est cette carte qui a
dit quels extracteurs il fallait écrire, et lesquels il ne fallait pas
réécrire.

### Le résultat : 1 072 questions

| Cours | Questions | Cours | Questions |
|---|---|---|---|
| 18.05 Probability and Statistics | **427** | 18.024 Multivariable Calculus | 33 |
| 18.600 Probability and Random Variables | 166 | 18.034 Honors Differential Equations | 30 |
| 18.04 Complex Variables | 108 | 18.06 Linear Algebra | 27 |
| 6.012 Microelectronic Devices | 65 | 6.003 Signals and Systems | 21 |
| 6.013 Electromagnetics | 51 | 6.041 Probabilistic Systems | 15 |
| 18.440 Probability | 53 | 18.085 Computational Science | 7 |
| 18.443 Statistics for Applications | 46 | 18.102 Functional Analysis | 7 |
| 18.435J Quantum Computation | 5 | 6.7220J Nonlinear Optimization | 3 |
| 6.011 Communication and Control | 2 | 6.041SC Probabilistic Systems | 2 |
| 6.046J Introduction to Algorithms (SMA) | 2 | 6.973 Communication System Design | 2 |

### Les refus, avec leur motif

- **Dix cours de chimie et de sciences des matériaux** (3.00, 3.012,
  3.034, 3.052, 3.091SC, 3.15, 3.205, 3.21, 3.22, 3.40J) : **sans lien
  avec la cybersécurité**. La plateforme est une plateforme de
  sécurité ; y loger un examen de chimie serait un mensonge, même avec
  une licence parfaite.
- **Deux cours dont le format n'est pas couvert** : 18.366 (Random
  Walks and Diffusion) et 18.786 (Number Theory II). Ils sont
  **signalés, pas forcés** : on ne réécrit pas un document pour le
  faire entrer.

### La preuve : aucun des dix lots déjà livrés n'a bougé

`tools/non-regression-lots.py` rejoue les dix extracteurs sur les
documents d'origine et compare les corrections avec les lots livrés :

```
mit-ocw-14-15j-examens       ok (14 corrections identiques)
mit-ocw-18-404j-examens      ok (20 corrections identiques)
mit-ocw-6-042j-examens       ok (5 corrections identiques)
mit-ocw-6-111-examens        ok (22 corrections identiques)
mit-ocw-6-253-examens        ok (11 corrections identiques)
mit-ocw-6-262-examens        ok (13 corrections identiques)
mit-ocw-6-450-examens        ok (3 corrections identiques)
mit-ocw-6-661-examens        ok (74 corrections identiques)
mit-ocw-6-832-examens        ok (7 corrections identiques)
mit-ocw-6-851-examens        ok (12 corrections identiques)
10 lot(s) verifie(s), 0 difference(s)
```

`tools/noter-lots.py` note en plus la qualité de chaque lot (réponses
identiques à l'énoncé, réponses sans signe de réponse, réponses trop
courtes) : c'est cet outil qui a servi à choisir l'extracteur le plus
fiable pour chaque cours.

### Deux pièges trouvés en route

1. **Le contrôle de longueur arrivait trop tard.** La correction était
   nettoyée (énoncé répété retiré) **après** le contrôle de longueur :
   une réponse comme « 1/4 » passait le contrôle, puis devenait trop
   courte une fois nettoyée. L'ordre des opérations est maintenant
   inverse — on nettoie, puis on contrôle.
2. **Le titre interne du document finissait dans les corrections.**
   « Practice Exam 1: All Questions, Spring 2022   23 » apparaissait
   dans **95 corrections sur 436**. Le module `tools/ocw_pieds.py` le
   retire désormais (95 → **0**), sans toucher au contenu réel.

### Mesures

| | avant | après |
|---|---|---|
| banque de questions | 1 176 | **2 248** |
| dont maison | 392 | 392 |
| dont importées (réserve) | 784 | **1 856** |
| importées dans une tâche | 0 | **0** |
| réserve maximale | 451 | **1 373** |
| copie servie (médiane / max / min) | 4 / 10 / 2 | 4 / 10 / 2 |
| entrées du catalogue des sources | 39 | **59** |

### Reproduire

```bash
# 1. Télécharger les 44 cours restants
python3 tools/telecharger-ocw.py \
  --rapport docs/recolte/criblage-ocw-2026-11-04.json \
  --dossier run/ocw-suite --travailleurs 6 --direct --cours <44 slugs>

# 2. Cartographier les formats
python3 tools/carte-cours.py --dossier run/ocw-suite --json /tmp/carte.json

# 3. Fabriquer les vingt lots (cahier de route exécutable)
python3 tools/import-lot-mit-suite.py \
  --texte run/ocw-suite --sortie tools/lots

# 4. Contrôler la qualité
python3 tools/controler-lot.py tools/lots/mit-ocw-18-*-examens.json

# 5. Vérifier l'absence de régression sur les lots déjà livrés
python3 tools/non-regression-lots.py

# 6. Vérifier puis importer vers le plugin
python3 tools/import-questions.py --verifier tools/lots/mit-ocw-18-05-examens.json
python3 tools/import-questions.py --importer-dossier tools/lots \
  --sortie wp-content/plugins/secura-academy/includes
```

## 4 quater. Des questions dont l'enonce n'etait pas une question (04/11/2026)

### Le defaut

En relisant les livres, un controle automatique a signale que
**65 questions du MIT 6.012 (Fall 2009) avaient pour enonce
« Graded by Prof. Fonstad »** : un fragment d'en-tete de document, pas
la question. L'eleve aurait recu une page de garde en guise
d'enonce.

### La cause

L'enonce du MIT commence par une liste de consignes :

```
Notes:
 1. An effort has been made to make the various parts of these problems independent of
 2. Some questions ask for an explanation of your answer. No credit will be given for
 3. Unless otherwise indicated, you should assume room temperature and that kT/q is
```

Ces lignes portent des **numeros**. L'extracteur les prenait pour des
**problemes « 1 », « 2 », « 3 »** ; le vrai « Problem 1 - (34 points) »
etait alors refuse (un numero deja vu) et **l'enonce disparaissait**.

### Le correctif

Des que le document emploie « Problem N », les lignes numerotees qui
precedent le premier « Problem N » sont des **consignes** : elles
n'ouvrent plus aucun probleme.

Deux autres causes, trouvees au passage :

- **« kT/q = 0.025 V »** etait reconnu comme un **numero de cours**.
  Le couple enonce/corrige du 6.012 paraissait alors etre deux examens
  differents, et il etait refuse. Le numero de cours n'est desormais
  reconnu que s'il **ouvre une ligne** ou s'il suit le mot « MIT ».
- Un contexte purement administratif (« Graded by Prof. X ») n'est
  plus prefixe a l'enonce.

### Ce que cela change

| Cours | avant | apres |
|---|---|---|
| MIT 6.661 Receivers, Antennas and Signals | 74 | **105** |
| MIT 6.013 Electromagnetics | 51 | **62** |
| MIT 6.041 Probabilistic Systems (Fall 2010) | 15 | **37** |
| MIT 6.012 Microelectronic Devices (Fall 2009) | 65 | **26** (les 39 autres avaient un enonce de bout en bout) |

Le **18.05** voit aussi ses paires **reordonnees** : l'ordre avait
change, et **certaines reponses etaient deposees sur la mauvaise
question** (verifie : « P(A) = 0.4, P(B) = 0.3 » recevait la reponse
d'une autre question). C'est le meme defaut, moins visible.

### Le garde-fou

`tools/controler-lot.py` refuse desormais un enonce qui ne contient
que des mentions administratives. Les **1 881 questions** des 47 lots
passent le controle ; l'ancien lot du 6.012 est refuse.

### Mesures

| | avant | apres |
|---|---|---|
| banque de questions | 2 248 | **2 273** |
| dont importées (réserve) | 1 856 | **1 881** |
| importées dans une tâche | 0 | **0** |
| réserve maximale | 1 373 | **1 395** |

---

## 4 quinquies. La liste de travail est bouclee (04/11/2026)

### Le dernier bilan

Les **66 cours** de la liste de criblage (un examen **et** un corrige
officiel **et** une licence Creative Commons) sont tous traites :

| | nombre | detail |
|---|---|---|
| **importes** | **39** | enonce et corrige officiels, licence CC BY-NC-SA 4.0, attribution du cours et de la source des tests |
| **refuses** | **28** | chacun avec un motif ecrit dans `docs/recolte/bilan-suite-cours.json` |
| non traites | **0** | — |

### Les vingt-huit refus, et pourquoi

**Dix cours sans lien avec la cybersecurite** — chimie et sciences des
materiaux : 3.00, 3.012, 3.034, 3.052, 3.091SC, 3.15, 3.205, 3.21,
3.22, 3.40J. La plateforme est une plateforme de securite : y loger un
examen de chimie serait un mensonge, meme avec la meilleure licence du
monde.

**Dix-huit cours dont le format n'est pas exploitable** :

| cours | motif |
|---|---|
| MIT 6.034 Artificial Intelligence | l'enonce renvoie a un **arbre dessine**, le corrige est un tableau |
| MIT 6.035 Computer Language Engineering | les blocs sont **sur la page suivante**, la reponse est du code |
| MIT 6.341 Discrete-Time Signal Processing | les **cases cochees** n'existent pas dans la couche texte |
| MIT 6.012 (Fall 2005) | le corrige est un **PDF scanne** : pas de couche texte |
| MIT 6.01SC | les « corriges » sont des **copies remplies** d'un quiz en ligne |
| MIT 6.061 | le corrige ne dit **pas ou commence la reponse** (pas de repere) |
| MIT 6.152J, 18.075, 18.966 | **aucune paire** enonce + corrige (les documents ne s'apparient pas) |
| MIT 6.241J, 18.366, 18.786 | **appariement refuse** : l'enonce et le corrige n'ont pas les memes items |
| MIT 18.03 | l'enonce est **illisible** a l'extraction (police non standard dans le PDF) |
| MIT 18.086, 6.642, 6.641 (2005) | l'enonce extrait est un **fragment d'en-tete**, pas la question |
| MIT 6.825 | l'enonce est un examen du **6.891**, le corrige du **6.825** |

**Aucun de ces cours n'a ete complete par du contenu redige** : c'est le
refus qui fait foi.

### La vague finale

| Cours | Questions |
|---|---|
| MIT 6.041 Probabilistic Systems Analysis (Spring 2006) | **9** |
| MIT 6.641 Electromagnetic Fields, Forces, and Motion (Fall 2009) | **1** |

### Mesures finales

| | avant la liste | maintenant |
|---|---|---|
| banque de questions | 1 176 | **2 283** |
| dont maison | 392 | 392 |
| dont importées (réserve) | 784 | **1 891** |
| importées dans une tâche | 0 | **0** |
| réserve maximale | 451 | **1 404** |
| entrées du catalogue des sources | 39 | **61** |

---

---

## 5. Reproduire

```bash
# 1. Télécharger les documents (132 en quelques secondes)
python3 tools/telecharger-ocw.py \
  --rapport docs/recolte/criblage-ocw-2026-11-04.json \
  --dossier run/ocw-prioritaires --travailleurs 6 --direct \
  --prefixes 6-034 6-035 6-042j 6-825 6-01sc 6-111 \
  --prefixes 6-450 6-262 6-341 6-661 6-832 6-253

# 2. Fabriquer les sept lots (cahier de route executable)
python3 tools/import-lot-mit-prioritaires.py \
  --texte run/ocw-prioritaires --sortie tools/lots

# 3. Contrôler la qualité (refuse un lot douteux)
python3 tools/controler-lot.py tools/lots/mit-ocw-6-*-examens.json

# 4. Vérifier puis importer vers le plugin
python3 tools/import-questions.py --verifier tools/lots/mit-ocw-6-661-examens.json
python3 tools/import-questions.py --importer-dossier tools/lots \
  --sortie wp-content/plugins/secura-academy/includes
```

Le catalogue des sources (`tools/sources-autorisees.json`) passe de **32 à
39 entrées** : les sept cours sont maintenant listés avec leur licence
vérifiée, leur usage et l'indication « non commercial ».

---

## 6. Ce qui reste à faire

- **La liste de criblage est bouclée** : les 66 cours sont traités —
  **39 importés, 28 refusés** avec un motif écrit (voir § 4 quinquies).
  Ce qui reste, c'est une **nouvelle liste** : le criblage peut tourner
  sur d'autres promotions, d'autres facultees, ou sur les cours qui
  n'ont pas encore de corrige en ligne.
- **Les cours refusés pour « schema absent » (6.034, 6.035, 6.341) ne
  sont pas perdus** : ils demandent un traitement des **figures** des
  PDF (les extraire et les joindre aux questions). C'est un travail Out
  Of Band, pas un problème de format — et il n'est pas fait.
- **Les cours dont l'énoncé est illisible à l'extraction (18.03)**
  demandent une **autre extraction** (police non standard dans le PDF) :
  l'OCR serait une voie, mais elle réécrit le document — donc elle
  demande une décision explicite, pas une initiative.
- Le **réservoir trop juste** de 6 examens (manque 16 au total) se corrige
  en important d'autres cours dans les sections concernées, pas en
  déplaçant des questions.
