# Un élève qui ne comprend rien peut-il devenir un pro ? — constat mesuré

> **Question posée :** le contenu est-il « ultra premium » ? Les labs aident-ils à
> obtenir de vrais certificats ? Tout le contenu du dépôt est-il lisible et rangé
> dans les rooms, ou y a-t-il des structures inutilisées ? Et surtout : un élève
> à la limite du chimpanzé, qui fait tous les cours, tous les QCM, tous les
> drapeaux, tous les labs et tous les examens, devient-il un pro de la
> cybersécurité — ou est-ce du contenu de merde ?
>
> **Méthode :** tout ce qui suit est mesuré sur le dépôt au 6 novembre 2026
> (branche `arena/a792cc4e-secura-academy`), pas estimé. Les commandes sont
> rejouables. Là où je ne peux pas mesurer, je l'écris.

---

## 1. La réponse courte

**Non. Un élève passif qui fait tout ce qui est présent aujourd'hui ne devient pas
un pro.** Il devient quelqu'un qui a de bonnes bases théoriques, une bonne
culture, et l'illusion d'avoir pratiqué.

Le contenu n'est pas « de la merde » : il est **sérieux, honnête, bien écrit, et
souvent meilleur que ce qu'on trouve gratuitement**. Mais il y a un écart précis
et mesurable entre « avoir tout coché » et « savoir faire », et cet écart est
aujourd'hui de **42 défis sur 60 qui se résolvent en lisant un fichier**.

Le problème n'est pas la qualité du texte. Le problème est la **mécanique de
validation** : elle récompense la lecture, pas la capacité.

---

## 2. Ce qui est réellement solide (et il faut le dire)

| Mesure | Valeur constatée |
|---|---|
| Rooms installées | **52** (6 démo + 10 scénarios M3 + 22 universitaires + 14 labs avancés) |
| Volume de texte | **43 206 mots** (~268 000 caractères), 831 mots par room |
| Structure | chaque room = leçon + entraînement + mission + examen ; **52/52** ont un examen |
| Durée annoncée | **54 heures** de contenu (3 245 min déclarées) |
| Traduction anglaise | **1 574 champs, 0 manquant, 0 resté en français** (prouvé par run CI) |
| Sources | MIT OCW, Stanford, CYBER.ORG, OWASP, PortSwigger — avec licence et attribution |
| Honnêteté | le coût des examens (439 $, 249 $) est affiché, pas caché |
| Tests du dépôt | smoke 356, audit 68, sondes 12, import 80, archives 4 — tous verts |

Le contenu **explique** bien. Les leçons sont justes, les pièges classiques
(injection SQL, buffer overflow, format string, ROP, CSRF, TLS, phishing) sont
couverts avec sérieux. Un lycéen qui lit vraiment ces 54 heures en sort avec une
culture cybersécurité supérieure à la moyenne des candidats Security+.

**Ce n'est pas de la merde.** C'est même plutôt bien au-dessus du tout-venant.

---

## 3. Le problème central : 42 drapeaux sur 60 se lisent, ils ne s'exploitent pas

C'est la mesure la plus importante de ce document.

J'ai classé les **60 questions à drapeau** du dépôt selon la façon de les résoudre :

| Nature du défi | Nombre | Exemple |
|---|---|---|
| **Lire un fichier posé dans la machine** | **42** | « Relevez la valeur d'offset annoncée dans le readme du TP » |
| Autre (dont lecture d'un service) | 18 | « Recopie le code affiché par Juice Shop » |

Concrètement, les 22 rooms universitaires pointent vers **une seule image**
(`securalabs/univ-01:1.0`), et les défis de cette image sont des documents texte :

```
labs/univ-01/cours/
├── cyber/    factors-sheet.txt, password-sheet.txt, phishing-example.txt, publishing-charter.txt
├── mit857/   auth-policy.md, crypto-notebook.txt, segmentation-plan.txt, tls-audit.txt
├── mit858/   analyse-risque.md, web-notes.txt
├── owasp/    logging-plan.txt, risk-ranking.txt, validation-sheet.txt
└── stanford/ machine-diagram.txt, storage-plan.txt
```

Le drapeau est **écrit en clair dans le fichier** :

```
event_count = FLAG=SECURA{trace_utile}
```

Il n'y a **aucun binaire vulnérable** dans la machine `univ-01` :

```
$ find labs/univ-01 -name "*.c" -o -name "*bin*"
(rien)
```

Autrement dit : la room « Déborder la pile : le canari et l'offset » n'enseigne
pas à déborder une pile. Elle demande de lire le readme d'un TP qui *parle* de
débordement de pile. **L'élève coche la room, le drapeau est validé, et il n'a
rien exploité.**

Sur les 18 autres, une partie est réelle : `avance-01` et `avance-02` demandent
vraiment de réussir les défis « Login Admin » et « Admin Section » de Juice Shop
(une vraie injection SQL sur une vraie application vulnérable). `m3-03` à `m3-10`
demandent un vrai travail sur un vrai service. **C'est là que se trouve le vrai
apprentissage pratique du dépôt — et c'est 18 défis sur 60.**

---

## 4. Le deuxième problème : les examens ne discriminent pas

| Mécanique | État constaté |
|---|---|
| Nombre de tentatives illimité | **aucune limite** dans le code |
| Seuil de réussite | 60 % |
| Part de QCM | 273 questions sur 392 (**69 %**) |
| Choix par QCM | 4 |
| Probabilité par question au hasard | 25 % |
| Aide disponible pendant l'examen | indices et explications fournis |

Un examen de 4 QCM à 4 choix, sans limite de tentatives, avec un seuil à 60 %,
se valide **par essais successifs sans jamais comprendre**. La variante des
questions (mélange des propositions, chiffres changés) empêche deux élèves
d'avoir la même copie — elle n'empêche pas un élève seul de recommencer.

Il n'y a donc **aucun coût à l'échec**, et donc **aucune raison d'apprendre**.

---

## 5. Le troisième problème : le code de validation est vérifiable, pas la compétence

Ce point n'est pas de la mauvaise foi, c'est une conséquence directe de
l'architecture :

- les 22 drapeaux de `univ-01` sont **écrits en dur dans le dépôt** (`make-lab.py`) ;
- ils sont poussés dans le dépôt public (`flag/flag-u01.txt = FLAG=SECURA{modele_de_menace}`) ;
- le serveur lit le fichier dans la machine et le compare.

Un élève qui trouve le dépôt peut lire les 60 drapeaux sans lancer une seule
machine. Ce n'est pas une faille de sécurité du site : c'est la démonstration que
**la preuve porte sur un fichier, pas sur un geste**. La vérification prouve que
l'élève sait trouver une chaîne de caractères dans un conteneur, ce qui est déjà
une compétence — mais ce n'est pas « savoir exploiter ».

---

## 6. La réponse à « est-ce que ça aide pour de vrais certificats ? »

**Ça aide à comprendre, ça ne suffit pas à obtenir.**

### Security+ (SY0-701) — le parcours « Fondations » y prétend

L'examen officiel est réparti ainsi :

| Domaine | Poids officiel | Couverture réelle du dépôt |
|---|---|---|
| 1. Concepts généraux (12 %) | 12 % | ✅ bien couvert (rooms 1, 5, 8, 9) |
| 2. Menaces et vulnérabilités (22 %) | 22 % | 🟡 partiel : attaques web/mémoire bien, **malware, acteurs de menace, ingénierie sociale en entreprise absents** |
| 3. Architecture (18 %) | 18 % | 🟡 partiel : segmentation et isolation oui, **cloud, IoT, architecture d'entreprise absents** |
| 4. Opérations de sécurité (28 %) | 28 % | 🔴 **le plus gros domaine, le moins couvert** : pas de SIEM, pas d'EDR, pas de réponse à incident outillée, pas de gestion des vulnérabilités |
| 5. Gouvernance et gestion du programme (20 %) | 20 % | 🔴 **quasi absent** : pas de registre des risques, pas de conformité (ISO 27001, SOC 2, RGPD en profondeur), pas de gestion des tiers |

**Verdict :** le dépôt couvre bien environ **35 à 40 %** du programme Security+.
Il en manque **60 %**, et le manque est concentré sur les deux domaines les plus
lourds (48 % de l'examen à eux deux). Un élève qui termine les 52 rooms **échouera
à Security+**, non par manque d'intelligence, mais parce que la moitié du
programme n'est pas là.

### eJPT — le parcours « Scénarios M3 » y prétend

C'est le plus crédible : 10 missions sur de vrais services, avec de vraies
vérifications. Mais eJPT demande une méthodologie complète de test d'intrusion
(reconnaissance, énumération, exploitation, post-exploitation, rapport). Ici on a
**10 scénarios isolés**, sans la trame qui les relie. C'est une bonne base, pas
une préparation.

### PortSwigger / BSCP — le parcours « Labs avancés » y prétend

Le dépôt **renvoie** honnêtement vers PortSwigger (avec attribution). Mais un
renvoi n'est pas une préparation : le BSCP demande de résoudre de vrais labs
notés. Les 14 rooms `avance` enseignent les commandes (`cat`, `grep`, `ls -l`,
`strings`, `sha256sum`) et la lecture d'indices ; elles ne font pas résoudre des
labs. **C'est une initiation, pas une préparation à l'examen.**

### Conclusion sur les certificats

> Le dépôt **ne délivre aucun certificat reconnu par le marché**. Il délivre un
> certificat maison (généré, vérifiable par numéro) qui n'a **aucune valeur
> d'employabilité**. Les certifications visées sont correctement nommées et leur
> coût est affiché honnêtement — c'est une qualité rare — mais **le contenu
> présent ne suffit pas à les passer**.

---

## 7. La réponse à « tout est-il lisible et dans les rooms ? »

**Le contenu pédagogique, oui. Le reste du dépôt, non — et c'est normal, mais il
faut savoir ce qui dort.**

### Ce qui est bien rangé

- **52 rooms** installées, toutes avec leçon + entraînement + mission + examen.
- Les **36 rooms** `univ` + `avance` ont toutes un lab déclaré et actif.
- Le contenu français, anglais, et l'arabe sont dans le plugin, pas éparpillés.

### Ce qui dort (mesuré)

| Élément | État | Verdict |
|---|---|---|
| `labs/net-01` | **utilisé** par m3-07, m3-08 et la room démo réseau | pas orphelin — corrigé après vérification |
| `labs/internal-01` | construit par le CI, **aucune room ne le nomme** | cible interne du compose `net-01` (le pivot), pas une room |
| `labs/dojo-pwncollege/` | `docker-compose.yml` seul, **0 flag, aucune room** | squelette vide |
| `content/en/univ-21.en.json`, `avance-14.en.json` | 2 fichiers JSON **jamais lus par le plugin** | doublons morts de la traduction |
| `class-secura-certificate.php` | **pas chargé** (commenté dans le bootstrap) | certificat PDF désactivé |
| `class-secura-exam-front.php`, `class-secura-exam-timed.php`, `class-secura-lab-front.php` | **pas chargés** | prototypes en quarantaine |
| `tools/lots/` | 49 fichiers JSON, 3 Mo, **produits par les imports** | sources d'import, pas du contenu servi |
| `tools/` (50 scripts) | chaîne de récolte OCW | outillage, normal |
| `docs/` (32 documents) | dont `AUDITS-REGISTRE.md` (94 Ko) | documentation, normal |

**Le plus gênant n'est pas le volume de fichiers non utilisés — c'est leur
nature :** les 1 891 questions importées du MIT et de Stanford (dans
`content-import-*.php`) sont **volontairement retirées des tâches** et versées
dans une « réserve » qui alimente les tirages d'examen. C'est un choix assumé et
documenté. Mais en pratique, **le contenu le plus prestigieux du dépôt (les
examens du MIT) n'apparaît nulle part dans les 52 rooms** : il tourne en arrière-plan
dans des copies d'examen que l'élève ne voit pas comme du MIT.

---

## 8. Le parcours de l'élève « à la limite du chimpanzé »

Voici, honnêtement, ce qui se passe si un élève sans aucune compréhension suit
tout, dans l'ordre, en cochant tout.

### Étape 1 — Les 6 rooms de démonstration (2 h)
Il lit. Il répond aux QCM. S'il se trompe, l'explication lui donne la réponse.
**Il valide sans comprendre.** Aucun drapeau ici : rien ne le retient.
→ *Compétence acquise : aucune. Culture : quelques mots de vocabulaire.*

### Étape 2 — Les 10 scénarios M3 (5 h)
Là, **ça devient réel** : il doit déployer une machine, lancer des commandes,
trouver un secret dans un service. 9 drapeaux sur 10 sont de vraies recherches.
Sans comprendre, il peut parfois copier une commande indiquée dans l'indice.
**C'est la partie qui a le plus de valeur — et c'est 5 h sur 54.**
→ *Compétence acquise : sait lancer une machine, lire un fichier, suivre une piste.*

### Étape 3 — Les 22 rooms universitaires (13 h)
Il lit des leçons solides, puis **ouvre des fichiers texte et copie la valeur
écrite dedans**. Les rooms « buffer overflow », « ROP », « format string » ne lui
font **rien exploiter** : elles lui font lire un TP qui en parle.
→ *Compétence acquise : du vocabulaire. Aucune pratique d'exploitation.*

### Étape 4 — Les 14 rooms avancées (7 h)
5 ceintures de commandes (`cat`, `grep`, `ls -l`, `strings`, `sha256sum`) : utiles,
mais ce sont les commandes qu'on apprend en une journée. 6 briefs vidéo. 2 vrais
défis Juice Shop (injection SQL réelle) : **les deux meilleurs moments du
parcours**. Kahoot de révision.
→ *Compétence acquise : sait se servir d'un terminal ; a réussi une injection SQL
guidée une fois.*

### Étape 5 — Les examens (0 h supplémentaire)
4 QCM, 4 choix, 60 %, tentatives illimitées. Il recommence jusqu'à passer.
→ *Compétence acquise : aucune. Médaille : bronze, quand même.*

### Résultat final

| Question | Réponse mesurée |
|---|---|
| Saura-t-il exploiter une injection SQL seul, sur une cible inconnue ? | **Non.** Il l'a fait une fois, guidé, sur Juice Shop. |
| Saura-t-il trouver et exploiter un buffer overflow ? | **Non.** Il a lu un TP qui en parle. Aucun binaire vulnérable dans ses machines. |
| Saura-t-il mener un test d'intrusion ? | **Non.** Aucune trame reconnaissance → énumération → exploitation → rapport. |
| Saura-t-il détecter une attaque (blue team) ? | **Presque.** Les rooms journaux et audit sont bonnes, mais sans outil (pas de SIEM, pas de EDR). |
| Passera-t-il Security+ ? | **Non** : ~60 % du programme est absent, dont les 2 domaines les plus lourds. |
| Passera-t-il eJPT ? | **Non** : 10 scénarios isolés ne font pas une méthodologie. |
| Aura-t-il une culture cybersécurité réelle ? | **Oui, nettement au-dessus de la moyenne.** Et c'est déjà beaucoup. |
| Aura-t-il un certificat reconnu ? | **Non.** Certificat maison uniquement. |

**Il ne devient pas un pro. Il devient quelqu'un qui a lu 54 heures de bon
contenu et qui croit avoir pratiqué.** Et c'est le pire des deux mondes : assez
pour se croire compétent, pas assez pour l'être.

---

## 9. Est-ce « ultra premium » ?

Non, et le mot importe peu : ce qui compte est **où** se situe l'écart.

| Critère « premium » | État |
|---|---|
| Texte clair, progressif, sans erreur | ✅ oui |
| Sources citées, licences respectées, coûts affichés | ✅ oui, rare |
| Couverture complète d'un référentiel | ❌ non (~40 % de Security+) |
| Pratique réelle vérifiée | 🟡 18 défis sur 60 |
| Mécanique qui empêche de tricher | ❌ non (tentatives illimitées) |
| Progression adaptative, remédiation | ❌ non |
| Préparation réelle à une certification payante | ❌ non |

Un contenu « premium » se reconnaît à une chose : **il ne laisse pas passer
quelqu'un qui n'a pas compris.** Aujourd'hui, celui-ci laisse passer.

---

## 10. Ce qu'il faudrait changer, par ordre d'impact

Ce ne sont pas des idées vagues : chacune se mesure.

1. **Rendre les 42 drapeaux « de lecture » réellement exploitables.**
   Remplacer les documents à lire par des binaires vulnérables et des services
   réels dans les machines. Un drapeau ne devrait jamais être écrit en clair
   dans un fichier que l'élève peut ouvrir.

2. **Limiter les tentatives d'examen** (3, par exemple) et **baisser le seuil de
   QCM** au profit de questions où il faut *produire* (une commande, une valeur
   trouvée, un drapeau). Objectif mesurable : moins de 40 % de QCM dans les
   examens, contre 69 % aujourd'hui.

3. **Compléter les deux domaines manquants de Security+** (opérations 28 %,
   gouvernance 20 %) : SIEM, EDR, réponse à incident, registre des risques,
   conformité. Sans eux, la promesse « préparation Security+ » est fausse.

4. **Faire remonter les questions MIT/Stanford dans les rooms visibles**, au lieu
   de les cacher dans une réserve de tirage. C'est le contenu le plus crédible du
   dépôt et l'élève ne le voit pas.

5. **Nettoyer ce qui dort** : supprimer `dojo-pwncollege/` (vide), documenter `internal-01`
   (cible du pivot, pas une room), supprimer `content/en/*.json` (jamais lus),
   décider du sort des 4 classes en quarantaine.

6. **Ne plus promettre une certification dans le nom du parcours** tant que la
   couverture n'est pas là. Le document `docs/CERTIFICATIONS.md` dit honnêtement
   que l'examen est payant ; il devrait dire aussi **ce qui manque**.

---

## 11. Ce que je n'ai pas mesuré

- **La qualité pédagogique réelle** (un élève apprend-il ?) : aucun test
  d'apprentissage n'existe dans le dépôt. Ce document mesure la structure et la
  couverture, pas l'effet sur un cerveau.
- **Le taux de réussite réel** aux certifications visées : personne ne l'a mesuré.
  Les 35-40 % de couverture Security+ sont une estimation par domaine, pas un
  score à un examen blanc.
- **Le contenu des machines `internal-01`, `net-01`, `multi-01`** : je n'ai pas
  pu les démarrer ici (Docker absent du bac à sable). Je sais qu'elles sont
  construites par le CI, pas ce qu'elles contiennent réellement.

Ces trois points sont écrits ici pour qu'on ne me fasse pas dire ce que je n'ai
pas prouvé.
