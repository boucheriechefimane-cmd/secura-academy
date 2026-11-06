# Le gabarit des rooms : ce qu'on prend de THM, et ce qu'on ne prend pas

> **Décision du 06/11/2026.** Le propriétaire du site a tranché : on prend de
> TryHackMe **le rythme, la progression, la mise en situation, les objectifs
> d'examen publics**. C'est de la méthode, et la méthode est libre. On ne
> prend pas leurs énoncés. Ce document dit comment le dépôt applique les
> deux moitiés de cette règle.

## 1. Pourquoi ce document existe

Un gabarit non écrit se perd. Il se perd surtout quand plusieurs personnes
écrivent des rooms à des mois d'intervalle : chacune réinvente un rythme, et
le catalogue devient irrégulier sans que personne ne l'ait décidé.

Ce document fige le gabarit, et il donne à chaque décision sa raison. Une
règle sans raison est une règle qu'on contourne dès qu'elle gêne.

## 2. Le rythme : quatre temps, jamais trois

Une room suit toujours ce déroulé, dans cet ordre :

| # | Temps | Type technique | Ce que l'élève fait | Durée visée |
|---|---|---|---|---|
| 1 | **Leçon** | `lesson` | Il lit une notion, une seule | 5 à 8 min |
| 2 | **Entraînement** | `practice` (QCM) | Il applique sur 3 cas, avec indices | 5 à 10 min |
| 3 | **Mise en situation** | `test` | Il **agit** : terminal simulé, fichier à lire, valeur à trouver | 10 à 15 min |
| 4 | **Examen** | `exam` (QCM) | 4 questions, sans indice, seuil 80 % | 5 à 8 min |

**Pourquoi quatre et pas deux.** Deux temps (leçon + examen) mesurent la
mémoire. Quatre temps produisent un geste : l'élève a fait quelque chose
avant d'être évalué. C'est la seule différence qui compte entre un cours
qu'on lit et un cours qu'on retient.

**Une seule notion par room.** Le temps 1 n'enseigne qu'une chose. Une room
qui explique le moindre privilège *et* le chiffrement *et* la journalisation
n'apprend rien : l'élève retient la plus facile des trois.

## 3. La mise en situation : le temps qui fait la différence

C'est là que se joue la qualité d'une room, et c'est la partie la plus
souvent bâclée. Trois règles, tirées de ce qui marche chez THM :

### 3.1 Une conséquence visible, pas une question abstraite

| À éviter | Mieux |
|---|---|
| « Que signifie le moindre privilège ? » | « Ce service tourne en root alors qu'il ne lit qu'un fichier. Que fais-tu ? » |
| « Citez les propriétés de la triade CIA » | « Le site répond, rien n'a fuité, mais des lignes ont changé. Quel pilier est touché ? » |
| « Qu'est-ce qu'un registre des risques ? » | « Voici huit lignes de registre. Laquelle est dangereuse, et pourquoi ? » |

### 3.2 L'élève doit **produire une valeur**, pas seulement choisir

Le temps 3 se termine par une preuve que l'élève a réellement ouvert la
machine : un drapeau, un nom de propriétaire, un identifiant. Un QCM se
devine ; une valeur lue dans un fichier ne se devine pas.

C'est aussi ce qui distingue la **couverture officielle** (87,0 %) de la
**borne sévère** (39,1 %) : seule la seconde compte comme une preuve
vérifiable par le serveur. L'écart entre les deux mesure exactement ce que
le site fait réellement manipuler.

### 3.3 Le terminal simulé plutôt qu'un conteneur

Les rooms de gouvernance fonctionnent **sans Docker** : le terminal est
simulé, les fichiers sont écrits dans la définition de la room. C'est ce
qui les rend utilisables par un élève sans machine, tout de suite — condition
posée par le propriétaire du site (« faisable et ludique, même pour un élève
très faible »).

## 4. La progression : ce qui vient avant, ce qui vient après

Une room ne suppose jamais acquise une notion qu'aucune room précédente
n'enseigne. Le contrôle est mécanique : `tools/certifications/couverture.php`
mesure la couverture du référentiel SY0-701, sujet par sujet, et nomme les
trous.

État au 06/11/2026, après l'ajout de la room 5.5 :

```
COUVERTURE PONDEREE : 87,0 %   (83,0 % avant)
BORNE BASSE (severe) : 39,1 %
Sujets non couverts : 6
  - D1 1.1 — Controles de securite (categories et types)
  - D1 1.3 — Zero trust
  - D1 1.4 — Gestion du changement
  - D1 1.7 — Securite physique (theorie seulement)
  - D4 4.7 — Forensique et preuves
  - D4 4.8 — Automatisation et orchestration
```

**On ne comble pas un trou avec une room de vocabulaire.** Une room qui
récite « zero trust, c'est vérifier à chaque accès » ne couvre pas le sujet
1.3 : elle le nomme. La règle est celle du § 3.1 — une situation, une
décision, une conséquence.

## 5. Les objectifs d'examen : un plan, pas un texte à recopier

Les objectifs SY0-701 sont un document **public**, fait pour être travaillé.
Le dépôt les utilise comme **plan de couverture** :

- `tools/certifications/sy0-701.json` contient les 5 domaines, leurs poids
  officiels (12 / 22 / 18 / 28 / 20 %), les sujets et leurs mots-clés ;
- `tools/certifications/couverture.php` mesure, room par room, quels sujets
  sont couverts — et distingue *couvert* de *théorie seulement* ;
- le score pondéré est **recomputable et contestable** : toute personne peut
  relancer le script et obtenir le même chiffre.

Ce qui n'est **jamais** repris : les questions officielles de l'examen (elles
ne sont pas publiées, et les « braindumps » sont interdits par le contrat
CompTIA), et les énoncés de THM.

## 6. La règle d'or, celle qui tranche sans juriste

> **« Est-ce que j'aurais pu écrire cet exercice sans l'avoir lu ? »**

- *Oui* → on écrit, on ne cite rien.
- *Non* → on ferme la page, on repart des objectifs et des sources
  vérifiées (NIST, MIT OCW, OWASP, RFC).

La différence n'est jamais dans le résultat : deux exercices sur le moindre
privilège se ressembleront forcément, c'est le sujet qui l'impose. Elle est
dans **la feuille blanche de départ**. Voir `docs/SOURCES-CONTENU.md` § 14
pour la version juridique de cette règle.

## 7. Une room conforme, en pratique

La room **« La campagne qui n'a rien appris a personne »**
(`gouvernance-04`, sujet 5.5) est l'exemple de référence, parce qu'elle a
été écrite après ce document :

| Temps | Contenu | Ce que ça vérifie |
|---|---|---|
| Leçon | ce qui fait qu'une campagne apprend quelque chose (5 questions de cadrage, 3 façons d'échouer) | la notion est unique et bornée |
| Entraînement | 3 rapports de campagne à diagnostiquer | l'élève applique, avec indices |
| Mise en situation | terminal simulé : `journal-campagne.csv`, une seule ligne `signale` | l'élève **lit** et produit `agent-17` |
| Examen | 4 QCM sans indice, seuil 80 % | la méthode est acquise |

Sa source est le **NIST SP 800-50 Rev. 1** (septembre 2024) — et non
l'édition de 2003, **retirée le 12/09/2024**, que beaucoup de supports de
cours citent encore. C'est exactement le genre d'erreur que
`docs/VERIFICATION-CONTENU.md` existe pour attraper.

## 8. Ce qu'il reste à faire, dans l'ordre

1. **D1 1.1 — contrôles de sécurité** : une salle où l'élève classe des
   contrôles réels (préventif, détectif, correctif) sur un incident donné.
2. **D1 1.3 — zero trust** : une situation où le réseau interne est réputé
   sûr, et où cette hypothèse tue.
3. **D4 4.7 — forensique et preuves** : la room existe déjà en pratique
   (RFC 3227 est déjà cité) ; il manque la mise en situation terminal.
4. **D1 1.4 — gestion du changement**, **D1 1.7 — sécurité physique**,
   **D4 4.8 — automatisation**.

Chaque room suit le gabarit du § 2, et chaque affirmation factuelle entre
dans `docs/VERIFICATION-CONTENU.md` avec sa source.
