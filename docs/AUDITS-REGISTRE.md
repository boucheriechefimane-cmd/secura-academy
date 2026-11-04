# Le registre d'audit

> Le registre tenu par le comité d'audit externe : qui a audité, quand,
> ce qu'il a trouvé, ce qui a été fait, et ce qui reste ouvert.

État : 02/11/2026 · version v0.9.1

---

## 1. Le tableau de bord

### 1 bis. Le comité des 18 auditeurs (bloc T, 01/11/2026 — complété le 02/11)

Le comité est passé de 5 à 15 spécialités : dix nouveaux experts ont été
recrutés, chacun avec son domaine, sa grille de contrôle et l'obligation
de **produire une preuve** (un scénario joué, un code lu, une mesure) avant
de formuler le moindre constat. Un audit sans preuve ne compte pas.

| # | Auditeur | Contrôles | Bloquant | Majeur | Mineur | Info | Verdict |
|---|---|---|---|---|---|---|---|
| 1 | SEO | 48 | 0 | 0 | 0 | 0 | **Conforme** |
| 2 | Contenu | 20 | 0 | 0 | 0 | 3 | **Conforme** |
| 3 | UX / UI | 16 | 0 | 0 | 0 | 2 | **Conforme** |
| 4 | Développement | 18 | 0 | 0 | 0 | 3 | **Conforme** |
| 5 | Sécurité & infra | 25 | 0 | 0 | 0 | 0 | **Conforme** |
| 6 | **Pédagogie** | 12 | 0 | 0 | 0 | 2 | **Conforme** |
| 7 | **Performance & Core Web Vitals** | 6 | 0 | 0 | 0 | 1 | **Conforme** |
| 8 | **Données structurées** | 7 | 0 | 0 | 0 | 7 | **Conforme** |
| 9 | **Accessibilité (WCAG 2.2 AA)** | 10 | 0 | 0 | 0 | 2 | **Conforme** |
| 10 | **Multilingue & i18n** | 8 | 0 | 0 | 0 | 2 | **Conforme** |
| 11 | **RGPD & mineurs** | 8 | 0 | 0 | 0 | 3 | **Conforme** |
| 12 | **Moteur de lab & Docker** | 6 | 0 | 0 | 0 | 3 | **Conforme** |
| 13 | **Onboarding** | 9 | 0 | 0 | 0 | 2 | **Conforme** |
| 14 | **Licences & attribution** | 6 | 0 | 0 | 0 | 4 | **Conforme** |
| 15 | **DevOps & résilience** | 12 | 0 | 0 | 0 | 2 | **Conforme** |
| 16 | **Panel des vingt élèves** | 5 | 0 | 0 | 0 | 23 | **Conforme** |
| 17 | **Moteur d'épreuves** | 13 | 0 | 0 | 1 | 5 | **Conforme (1 mineur de contenu)** |
| 18 | **Drapeaux et actions joués pour de vrai** | 3 (+1 en CI) | 0 | 0 | 0 | 3 | **Conforme** |
| | **Total** | **233** (233 en CI, vrais conteneurs Docker) | **0** | **0** | **1** | **64** | **Conforme** |

> **Un contrôle de plus en CI qu'en local** : le 18ᵉ auditeur (drapeaux et
> actions joués pour de vrai) vérifie une question supplémentaire quand les
> vraies machines Docker sont disponibles — en local, l'émulateur ne peut
> pas jouer ce contrôle-là. D'où **228 contrôles en local, 229 en CI**,
> pour le même code.

> Les 18 auditeurs produisent chacun **trois formats** de rapport dans
> `docs/audits/` : le Markdown (lisible), le **HTML** (le document qui fait
> foi : verdict, périmètre, chiffres, scénarios joués, forces, constats avec
> la preuve sous chaque ligne, et les limites explicites) et le JSON (pour
> le tableau de bord de la CI).

### 1 quater. Le 18ᵉ auditeur — les questions de machine jouées pour de vrai (02/11/2026)

Il est né d'une demande du propriétaire : « les questions de drapeau et
d'action demandent la machine de l'élève : elles ne sont pas jouées ici.
Trouve une solution. » Un auditeur **ne se contente pas de regarder le
code** : il **joue**.

| Contrôle | Ce qu'il vérifie | Résultat |
|---|---|---|
| 1. Le périmètre | Combien de questions demandent la machine | 60 drapeaux + 1 action |
| 2. Le contrôle statique | Chaque fichier de drapeau existe, a une valeur, elle est unique, le chemin est sûr, et la machine est déployable | 61 questions vérifiées, 0 anomalie |
| 3. **Le jeu réel** | Un élève est créé, il se connecte, lit la leçon, répond, **déploie la machine**, **cherche la valeur dans la machine**, la soumet : le serveur la compare au fichier relu **en root** | 61 questions **jouées et acceptées** |
| 4. Les limites | Ce que la mesure ne prouve pas | Dit dans le rapport |

**Ce que le jeu réel a trouvé — et qui aurait été invisible sans lui :**

| Défaut | Pourquoi c'était grave | Correction |
|---|---|---|
| Le moteur d'épreuves **remplaçait** les questions de drapeau par d'autres au tirage | Les 61 questions de machine **n'étaient jamais posées** : la room était impossible à valider | Les questions qui demandent la machine ne se tirent plus : elles restent toujours dans la copie de l'élève |
| `absint( -1 )` valait `1` | La question d'action exigeait une étape de terminal qui n'existait pas : elle était refusée à tort | Le signe est préservé (`-1` = aucune vérification automatique) |
| La machine était déployée **après** le parcours | Le terminal restait verrouillé : l'action ne pouvait pas être confirmée | On déploie d'abord, on joue ensuite |
| Les motifs de terminal contenant un point étaient écartés | `cat config.txt` n'était jamais joué | On tape le motif en clair (et on essaie le texte d'une expression régulière) |
| Les drapeaux du service « flags » n'étaient pas dans `/root/flags/` | Le serveur ne pouvait pas relire la valeur : les questions de la pile Compose étaient injouables | Le service « flags » est corrigé (et vérifié par la CI, en Docker réel) |

Le garde-fou reste **lui-même** : le 18ᵉ auditeur est rejoué à chaque push,
sur des **vrais conteneurs** dans la CI, et la CI rougit sur un constat
majeur.

### 1 quinquies. L'audit externe passé en CI réelle (02/11/2026, v0.9.1)

Les chiffres ci-dessus viennent d'une exécution locale. Pour ne pas
« croire sa propre cuisine », le même comité a été rejoué **par GitHub**,
dans un WordPress installé de zéro, avec les **vraies machines Docker** :
c'est le seul endroit où l'on peut garantir que les 60 questions de
drapeau sont acceptées par un serveur qui relit le fichier **en root**.

| Ce que la CI a fait | Résultat |
|---|---|
| WordPress + plugin installés de zéro, site servi | ✔ 8 étapes vertes |
| 6 images de machines construites, réseau isolé | ✔ |
| **Les 18 auditeurs** passés au crible | ✔ étape verte en 13 min 46 s |
| Rapports produits | ✔ 18 × 3 formats (Markdown, HTML, JSON) |
| **Bilan** | **226 contrôles · 0 bloquant · 0 majeur · 1 mineur · 55 info** |

Identifiant du passage : `41374598365` (branche `main`, commit `a1b2954`).
Les rapports de ce passage sont **ceux qui font foi** : ils sont dans
`docs/audits/` (fichiers datés du 02/11/2026) et dans l'artefact
`rapports-audit-externe` du passage.

Le verdict est **conforme**. Aucun constat bloquant ni majeur, ni en local,
ni en CI.

### 1 ter. Les deux auditeurs ajoutés le 01/11/2026 (nuit, suite 6)

#### 16. Le panel des dix élèves

Dix profils d'élèves distincts — **âge, langue et spécialité cyber
différents** — jouent la plateforme **en HTTP réel** (inscription, connexion
avec cookie, ouverture du parcours, leçon, réponses envoyées au serveur).
Le panneau ne simule rien : il lit les réponses HTTP du serveur.

| Persona | Âge | Langue | Spécialité | Appareil |
|---|---|---|---|---|
| Yasmine | 16 | arabe | sécurité cloud | mobile |
| Lucas | 19 | français | développement web | ordinateur |
| Amina | 22 | arabe | exploitation (centre opérationnel) | mobile |
| Tomás | 24 | anglais | réseau | ordinateur |
| Sarah | 17 | français | données personnelles | mobile |
| Karim | 31 | arabe | administration Linux | ordinateur |
| Mei | 15 | anglais | première expérience cyber | mobile |
| Julien | 45 | français | direction des SI | ordinateur |
| Nadia | 28 | français | test d'intrusion (débutante) | mobile |
| Sofia | 34 | anglais | DevSecOps | ordinateur |

| Ce qui est mesuré | Résultat mesuré |
|---|---|
| Créer un compte et commencer le parcours | **10 / 10** en une étape, connexion réussie (HTTP 200 + cookie), parcours ouvert |
| Recevoir vraiment des points | **10 / 10** : 0 → **213 à 220 XP** selon l'élève |
| Obtenir une médaille | **10 / 10** : **or, 100 %** |
| Voir son niveau avancer | **10 / 10** : Observateur → Apprenti |
| Recevoir une copie d'examen **différente** de celle des autres | **10 / 10** : **10 copies pour 10 élèves** |

**Test négatif (la preuve que le contrôle morbite)** : en rétablissant
l'ancien comportement — le tirage désactivé — le panel tombe à **1 copie
pour 10 élèves** et le signale en **[MAJEUR]**. Le contrôle détecte donc
bien ce qu'il prétend détecter.

**Un piège de mesure, trouvé et compris** : le premier version du panel
concluait « 0 point » alors que le serveur avait bien attribué les XP.
La cause n'était pas la plateforme : le process WP-CLI lisait un **cache
de méta-données périmé** (les XP sont écrits par le serveur web, dans un
autre process). La lecture relit désormais la base. *Un audit qui se trompe
sur la plateforme est aussi un audit raté.*

#### 17. Le moteur d'épreuves

| Ce qui est mesuré | Résultat mesuré |
|---|---|
| Le moteur est livré et chargé | oui |
| Le tirage est reproductible (pas de hasard non maîtrisé) | oui — générateur déterministe, aucun `shuffle`/`array_rand`/`random_int` |
| Réservoir d'un examen (le niveau entier) | **11 à 34 questions**, médiane **26** |
| Copies possibles, tous examens confondus | **131 365 839** |
| Questions paramétriques (chiffres qui changent) | **5** déjà écrites, format documenté |
| Deux élèves ⇒ deux copies | **10 / 10** copies différentes |
| Recharger redonne la même copie | oui |
| Une question liée à une machine (drapeau, action) voyage dans une autre room | **jamais** |

**Le seul constat ouvert (mineur, et c'est du contenu)** : le réservoir
d'un examen va de 11 à 34 questions quand l'objectif du propriétaire est
d'environ **200 questions par niveau**. Le moteur n'est pas en cause — il
sait tirer dans un réservoir de 200 questions comme dans un réservoir de 30.
C'est un **travail de rédaction** (environ 20 sections × 200 questions,
en français, arabe et anglais). Le constat est mesuré à chaque passage et
laissé visible, plutôt que masqué.

### Les constats trouvés par les dix nouveaux auditeurs — et leur traitement

| # | Constat | Auditeur | Gravité | Traitement | État |
|---|---|---|---|---|---|
| 1 | La politique de confidentialité était **en brouillon** et les mentions légales n'existaient pas | RGPD | **Bloquant** | Les deux pages ont été **rédigées** à partir de ce que la plateforme fait réellement (données stockées, traceurs, durée de conservation, droits) et **publiées**, en français, arabe et anglais, avec liens au pied de page | ✅ corrigé |
| 2 | Le visiteur anonyme lisait tout le contenu mais, en cliquant sur une tâche, recevait « Une erreur est survenue. » | Onboarding | Majeur | Les actions AJAX sont désormais enregistrées pour les visiteurs non connectés : ils reçoivent **« Connectez-vous pour continuer. »** avec un **lien cliquable** vers l'inscription | ✅ corrigé |
| 3 | Le bouton « Créer un compte gratuit » ne menait nulle part : l'inscription était désactivée dans la recette | Onboarding | Majeur | L'inscription libre est activée **automatiquement** par la CI, et le réglage est vérifié par un audit | ✅ corrigé |
| 4 | Les 4 parcours n'étaient rattachés à **aucune** certification | Pédagogie | Majeur | Chaque parcours vise maintenant une certification **nommée**, avec son **coût d'examen** affiché à l'élève dans les trois langues | ✅ corrigé |
| 5 | Le type `ItemList` manquait sur les pages de parcours ; le JSON-LD ne décrivait pas la suite des rooms | Données structurées | Majeur | Un `ItemList` liste désormais les rooms du parcours, dans l'ordre | ✅ corrigé |
| 6 | Le JSON-LD contenait des **entités HTML** (`&#8217;`) au lieu de caractères réels — invisible à l'écran, mais visible pour un moteur | Données structurées | Majeur | Les textes sont normalisés avant encodage ; un contrôle anti-régression a été ajouté | ✅ corrigé |
| 7 | `ci.yml` et `deploy.yml` n'avaient **aucune limite de temps** : un job bloqué aurait consommé le runner pendant des heures | DevOps | Majeur | `timeout-minutes` ajouté aux deux | ✅ corrigé |
| 8 | Les sauvegardes du serveur s'empilaient **sans limite** — jusqu'à saturer le disque | DevOps | Majeur | Purge automatique : les 10 sauvegardes les plus récentes sont conservées | ✅ corrigé |
| 9 | **Aucune procédure de restauration écrite** : une sauvegarde que l'on ne sait pas remettre en place ne sert à rien | DevOps | Majeur | Procédure complète écrite dans `docs/deploiement.md`, avec les commandes exactes | ✅ corrigé |
| 10 | Les actions GitHub n'étaient épinglées que par version majeure | DevOps | Mineur | Les 13 usages sont épinglés par **empreinte SHA** (empreintes réelles, vérifiées le 01/11/2026) | ✅ corrigé |
| 11 | Le sens de lecture arabe (`dir="rtl"`) n'était posé que sur le bloc de l'application, pas sur le document : une page de contenu en arabe s'affichait de gauche à droite | Multilingue | (trouvé en cours de route) | Le sens de lecture est désormais porté par la balise `<html>` | ✅ corrigé |
| 12 | **La barrière bloquante ne bloquait pas** : `audit_fin()` renvoyait le code par `return`, que `wp eval-file` ignore | DevOps | (trouvé en cours de route) | `audit_fin()` termine par `exit()` ; vérifié : un constat bloquant sort désormais avec le code 1 | ✅ corrigé |
| 13 | **Un titre passait du niveau 1 au niveau 3** dans la room « Kahoot : la révision des labs avancés » : les lecteurs d'écran annonçaient un titre de niveau 2 manquant | Accessibilité (WCAG 2.2 AA) | **Majeur** | Le bloc Kahoot titre désormais en `<h2>`, comme les autres blocs de room ; **testé dans les deux sens** (le garde-fou détecte le retour de la faute) | ✅ corrigé |
| 14 | **Deux contrôles ne regardaient qu'une room tirée au hasard** : le résultat dépendait de l'ordre des identifiants — un défaut visible en CI pouvait être invisible en local | Accessibilité, SEO | (trouvé en cours de route) | Les **53 pages** (accueil + 52 rooms) sont vérifiées à chaque audit, et le titre de **chaque** room est contrôlé sur la page réellement servie | ✅ corrigé |

> **Sur le point 12.** C'est le genre de défaut que seule une vérification
> expérimentale révèle : le code *avait l'air* correct, et le tableau de
> bord annonçait « conforme ». C'est pourquoi chaque constat de ce document
> porte une preuve reproductible.

### Le tableau de bord des 5 premiers auditeurs (contexte)

| Auditeur | Contrôles | Bloquant | Majeur | Mineur | Verdict |
|---|---|---|---|---|---|
| SEO | 45 | 0 | 0 | 0 | **Conforme** |
| Contenu | 18 | 0 | 0 | 0 | **Conforme** |
| UX / UI | 16 | 0 | 0 | 0 | **Conforme** |
| Développement | 14 | 0 | 0 | 0 | **Conforme** |
| Sécurité & infra | 25 | 0 | 0 | 0 | **Conforme** |

> Le passage du 01/11/2026 au soir a ajouté **15 contrôles SEO** : ce sont
> les points du guide officiel de Google sur les réponses générées par l'IA
> (voir `docs/SEO-GENERATION-AI.md`).
>
> Le passage du 01/11/2026 (nuit) a ajouté **10 contrôles SEO de plus** :
> les robots d'IA nommés et autorisés dans `robots.txt`, le maillage
> interne (liens vers les rooms et les parcours), la cohérence des
> versions traduites, la fermeture de l'archive d'auteur, l'image de
> partage. Ces contrôles ont été ajoutés **après avoir trouvé** les
> écarts qu'ils vérifient — ils existaient bel et bien.

Environnement de l'audit : WordPress 7.1.4 réel (MySQL 11.8), PHP 8.3,
plugin et thème du dépôt, pages récupérées en HTTP, machines Docker
réelles pour l'isolation.

### 1 octies. Le nouveau type « solution » : un vrai problème d'examen universitaire (02/11/2026, v0.11.0)

**Ce que l'import a apporté.** Les 12 quiz du MIT 6.858 (2009-2014) ne
contiennent pas que des QCM : ils contiennent surtout des **problèmes
d'examen rédigés** (« Expliquez comment un attaquant peut encore
exploiter un débordement de tampon sur une pile non exécutable »), dont la
réponse officielle est une **explication en prose**. L'extracteur ne
savait pas les lire : il en retenait 17 sur 223 items.

**La question posée à l'auditeur :** peut-on publier une question à
laquelle une machine ne sait pas répondre ? Réponse retenue : **oui, mais
jamais en inventant une note.** Une rédaction ne se corrige pas
automatiquement ; pretendre le contraire serait mentir à l'élève. Le type
`solution` a donc été ajouté au moteur :

| Élément | Règle appliquée |
|---|---|
| Affichage | Un vrai champ de réécriture (6 lignes), pas une case à cocher |
| Validation | L'élève doit écrire au moins quelques mots : le bouton « Voir la correction officielle » refuse une réponse vide |
| Retour | La **correction officielle de l'école**, mot pour mot, s'affiche après la réponse |
| Note | **Aucune** : pas de « bonne » ou « mauvaise » réponse, pas de score automatique |
| Contrôle automatique | L'auditeur de contenu **rejette** une question `solution` sans correction officielle complète (80 caractères minimum), sans source ou sans licence |

**Preuve par la mesure :** 115 problèmes d'examen du MIT sont désormais
dans la plateforme, avec la correction officielle du MIT. Le panel
d'élèves a été adapté pour savoir y répondre, et le comité est repassé au
vert : **229 contrôles, 0 bloquant, 0 majeur, 1 mineur**.

**Ce que le comité a refusé, et pourquoi (02/11/2026).** Deux sources ont
été trouvées et **écartées**, chacune avec une preuve automatique :

| Source | Matériel disponible | Décision | Preuve |
|---|---|---|---|
| PortSwigger Web Security Academy | Labs gratuits, questions d'examen | **Cité, jamais recopié** (§ 7.4, 7.7, 9.5 des conditions d'utilisation) | `tests/import-test.py` refuse un lot PortSwigger |
| MIT 6.1600 Foundations of Computer Security | Quiz d'entraînement **avec les corrigés officiels** | **Cité, jamais recopié** : le site du cours ne porte aucune licence Creative Commons | `tests/import-test.py` refuse un lot MIT 6.1600 |

> Changer l'ordre des propositions et les chiffres d'une question
> protégée ne la rend pas libre : cela reste une copie d'un document
> protégé. C'est la règle de la maison depuis le début, et elle a été
> appliquée ici par deux tests automatiques, pas par une déclaration.

### 1 nonies. Quand la CI refuse le passage — et que le coupable est la mesure, pas la plateforme (02/11/2026, v0.11.0)

**Le fait.** La CI a refusé le passage v0.11.0 : le comité des 18
auditeurs a trouvé **un constat de fond** — 35 questions de machine sur
81 jouées étaient déclarées « refusées par le serveur », alors que la
version précédente passait.

**La cause, en deux défauts de l'outil de mesure** (pas de la
plateforme) :

| Défaut | Effet |
|---|---|
| L'auditeur ne connaissait pas le type `solution` (le problème d'examen rédigé) | Il n'envoyait **aucune réponse** à ces questions. Comme il déclarait la réussite d'après l'index de la question servie, une copie dont la première question était un problème d'examen comptait pour un échec. |
| Il déclarait la réussite en comparant l'index de la question **servie** à l'index de la question **source** | Or le tirage mélange les questions : les deux index n'ont aucun rapport. Une copie dont la première question était un QCM suffisait à faire passer l'audit **sans que le drapeau ait jamais été accepté** — la mesure pouvait donc passer au vert sur une question de machine qui ne jouait pas. |

**Les corrections.** L'auditeur répond maintenant comme un élève (une
vraie phrase, que le serveur accepte) et il ne déclare la réussite que
si **la question de drapeau elle-même** a été acceptée — reconnue à son
chemin de drapeau, qui est unique dans la room.

**Et là, la mesure honnête a révélé un vrai bug de la plateforme.**
Une fois l'auditeur corrigé, les questions de machine que le serveur
refusait n'étaient plus un artefact de mesure : **le serveur refusait
réellement** certaines questions. La cause :

| Ce que l'élève voit | Ce que le serveur acceptait |
|---|---|
| sa **copie tirée** (réservoir du niveau, propositions mélangées) | la **liste d'origine** de la room |

Quand la copie est plus longue que la liste d'origine — et elle l'est
dès qu'une room a un test court et une section riche — l'élève voit des
questions que le serveur refuse (`« Question invalide »`). La question de
drapeau, qui est **en fin de copie**, devenait donc impossible à
répondre : **la room ne pouvait plus être finie**. Le même décalage
donnerait à l'élève **l'indice d'une autre question**, et ferait
compter le score sur la mauvaise liste.

**Le correctif** : un point de passage unique, `Secura_Exam::question_copie()`,
utilisé par le serveur (validation, indice, fin de tâche, score) comme par
les audits. On interroge **la copie servie**, jamais la liste d'origine.

**La récolte du 02/11/2026, et ce qu'elle a Honestement refusé.** Le site
reste **gratuit pour toujours** (décision du propriétaire) : les licences
« NC » sont utilisables, et le gisement change d'échelle. La récolte n'est
pas faite à la main : un script parcourt le sitemap de MIT OpenCourseWare
(2 587 cours), ne retient que les cours techniques et note ceux qui
publient des examens ou des énoncés **avec corrigés** (6 cours sur 26).
Trois sont importés (6.828 : 31 questions, 14.15J : 14, 6.858 déjà en place
: 132), soit **45 questions de plus**, et le manque de réservoir des examens
tombe de **80 à 31**.

Le plus important n'est pas le gain, c'est ce que la récolte a **refusé** :

| Source | Matériel | Traitement |
|---|---|---|
| 14.15 Networks (2022) | midterm + corrigé | **Refusé** : le corrigé est en prose, l'appariement énoncé ↔ corrigé ne peut pas être vérifié |
| 6.824, 6.875, 6.5630 | examens / devoirs | **Refusé** : pas de corrigé officiel — on ne devine pas la réponse |
| 6.829 Computer Networks | ps1 + corrigés | **Refusé** : PDF en PostScript à encodage cassé, texte illisible |
| Harvard CS50 | énoncés d'exercices | **Cité, pas importé** : les corrigés officiels ne sont pas publiés sous une forme lisible par machine |
| MIT 6.1600 / 6.5660 | 34 quiz + 10 examens avec corrigés | **En attente d'autorisation** : le gisement le plus gros qui reste, sans licence |

La règle qui tient tout : une question n'est importée que si **le corrigé
officiel contient la réponse**, et l'appariement est vérifié. Un contrôle
qui laisse passer une question sans réponse vérifiable ne prouve rien.

**Un défaut que le comité n'avait pas vu, trouvé par un contrôle manquant.**
Le 02/11/2026, `node --check` a été installé dans l'environnement de travail
(il manquait jusqu'alors) : il a déclaré `academy.js` **illisible**. Une
apostrophe non échappée dans une chaîne française — « écris ta réponse avant
d'afficher la correction » — fermait la chaîne au mauvais endroit. Conséquence
réelle : **le navigateur ne pouvait plus exécuter le fichier**, donc plus
aucune réponse n'était envoyée, plus aucun indice n'apparaissait.

Pourquoi aucun audit ne l'avait vu : les dix-huit auditeurs interrogent le
**serveur** ; ils n'exécutent pas le JavaScript du navigateur. Un contrôle
qui ne teste pas ce qu'il prétend tester laisse passer un défaut de cette
taille. Le contrôle a donc été ajouté à la CI **et** placé avant les
auditeurs dans le workflow d'audit externe — ajouté parce qu'il manquait, pas
parce qu'il aurait trouvé un défaut.

*Morale :* « les tests passent » ne veut pas dire « tout fonctionne ». Il faut
demander, pour chaque contrôle, ce qu'il regarde **vraiment** — et ajouter le
contrôle qui regarde ce qui n'était pas regardé.

**La preuve que le contrôle peut échouer** : le contrôle « toutes les
questions de la copie servie sont acceptées par le serveur » a été rejoué
avec l'ancien code — il produit alors un **majeur** qui nomme les rooms
concernées ; avec le correctif, il est vert. Un contrôle qui ne peut pas
échouer ne prouve rien.

**La cascade qu'on a supprimée en même temps** : quand la tâche d'entraînement
d'une room ne contenait qu'une question de machine, le tirage renvoyait
**tout le réservoir de la section** — jusqu'à 39 questions pour un simple
point de contrôle, dont 16 problèmes d'examen rédigés. La taille du test
variait de 2 à 39 questions selon la room. Règle adoptée : **le test a la
taille de l'examen de sa room** (2 à 5), et le tirage ne renvoie jamais
plus que ce qu'on demande. Les examens, eux, ne changent pas (réservoirs
de 9 à 39, 636 150 892 copies possibles).

> **La leçon, qu'on garde** : une mesure qui vérifie un *index* au lieu
> de vérifier *la chose* est une mesure qui peut mentir. C'est
> exactement ce que la plateforme reproche aux examens « captés et
> refaits » : on ne prouve rien en rejouant la même case. La preuve, ici,
> c'est le **chemin du fichier lu en root dans la machine de l'élève**.

### 1 septies. La CI rouge pour une raison extérieure au plugin (02/11/2026, v0.10.0)

**Constat.** Après la fusion des deux travaux parallèles du 02/11/2026, le
travail « WordPress — recette et compatibilité » de la CI a **échoué** sur
seul le cas « Polylang ». Le message :

```
Error: md5 hash for download (a074a706…) is different than the release hash (00e24bf7…)
```

**Ce que c'est.** WP-CLI compare le paquet téléchargé à l'empreinte
`md5` que l'API de WordPress.org annonce pour ce plugin. WordPress.org
reconstruit parfois un paquet **sans changer son numéro de version** :
l'empreinte annoncée n'est plus celle du fichier servi. La CI compare
donc deux fichiers différents et conclude à une corruption — alors que
la **recette complète (le job important : 45 contrôles de machines,
scénario des deux apprenants) était verte**.

**Pourquoi ce n'est pas un faux positif.** Le test de compatibilité avec
Polylang existe pour une bonne raison : notre plugin crée des contenu
avec des langues, et un plugin de multilingue peut le casser. Il ne
fallait pas supprimer le test — il fallait le rendre indépendant de
l'humeur du répertoire de WordPress.org.

**Traitement.** Les plugins tiers testés sont désormais **épinglés**
(version + empreinte SHA-256 dans `tools/plugins-tiers.json`) :

| Plugin | Version testée | Ce qui est vérifié |
|---|---|---|
| Polylang | 3.9.1 | SHA-256 du paquet, puis activation |
| LiteSpeed Cache | 7.9.2 | SHA-256 du paquet, puis activation |

- le paquet est téléchargé depuis l'adresse officielle de WordPress.org ;
- son empreinte est comparée à celle enregistrée dans le dépôt ;
- si l'empreinte a changé (paquet reconstruit en amont), on **n'accepte
  que si le nom et la version lus dans le paquet** sont bien ceux
  qu'on attendait ; sinon la CI échoue ;
- en dernier recours seulement, la voie WP-CLI (avec trois tentatives).

**Vérifié en local avant d'envoyer** : Polylang 3.9.1 et LiteSpeed
Cache 7.9.2 s'installent et s'activent par le chemin épinglé, sans
passer par WP-CLI. La CI rejoue ensuite les 45 contrôles de machines et
le scénario des deux apprenants.

---

### 1 decies. Les examens d'université quittent les tâches : le point de contrôle retrouve la taille de l'épreuve (03/11/2026, v0.11.4)

**Le défaut, mesuré.** En préparant la vague 2 de l'import (143 questions
de cinq cours du MIT), la mesure a montré que **36 des 52 rooms** avaient un
point de contrôle (« test ») plus gros que la règle du moteur ne l'autorise.
Les deux rooms Stanford affichaient **80 et 77 questions** à rendre, là où la
règle écrit : « le `test` fait au moins la taille de l'`exam`, jamais plus ».
La cause n'était pas les slugs : c'était l'**import** lui-même. Les questions
reprises d'un examen universitaire étaient versées dans la tâche `test` de la
room, et une tâche de 80 questions donne une copie de 80 questions — le point
de contrôle devenait un examen entier, et il fallait écrire 68 corrigés
d'algorithmes pour ouvrir la porte de l'examen suivant.

**Les trois voies possibles, et pourquoi celle retenue.**

| Voie | Ce qu'elle change | Pourquoi elle est écartée |
|---|---|---|
| A. Des rooms dédiées pour les 5 cours non-cyber | 5 à 9 rooms à créer (contenu, machine, drapeaux, traductions ar/en) | Elle n'écaille pas le défaut : les 143 questions restent dans une tâche `test`, le point de contrôle reste gros. Elle ne passe pas à l'échelle (Harvard, puis les autres), et elle demande d'écrire du contenu — alors que la règle est de ne rien rédiger. |
| B. Un plafond dans le moteur | Le moteur refuse de servir plus de N questions | `is_task_unlocked()`, `room_is_complete()` et `compute_score()` comparent la **tâche brute** aux réponses indexées sur la **copie servie**. Plafonner sans aligner les deux casse le déblocage et les médailles ; l'alignement « brute ↔ copie » a été **abandonné** (le panel des élèves ne peut pas répondre aux questions de drapeau : plus aucun examen ne s'ouvrirait et la CI rougirait). |
| C. Séparer l'import du point de contrôle (**retenue**) | Les questions importées quittent les tâches et forment une **réserve** | Le réservoir des épreuves garde **toutes** les questions : les copies d'examen restent aussi variées, et le point de contrôle retrouve la taille de l'épreuve. C'est la lecture littérale de la règle déjà écrite dans le README. |

**La correction.** `Secura_Rooms::get_tasks()` rend désormais les tâches
**maison** ; `Secura_Rooms::reserve()` rend les questions importées de la
room, normalisées par **exactement le même code** (aucune divergence de
sémantique possible) ; `Secura_Exam::pool()` tire dans les deux : la réserve
alimente le **réservoir** de la section. Le moteur de progression
(`class-secura-progress.php`), le déblocage (`class-secura-ajax.php`) et le
tirage ne sont **pas** touchés, et aucune fonction publique n'a changé de
signature.

**Les mesures, avant et après.**

| Mesure | Avant | Après |
|---|---|---|
| Questions importées dans une **tâche** | 320 | **0** |
| Copie servie du `test` (médiane / max) | 4 / **80** | 4 / **10** |
| Réservoir de la section Stanford | 164 | **164** (inchangé) |
| Questions de la plateforme | 712 | **712** (inchangé) |
| Manque de réservoir, par section | 25 | **25** |
| Examens déverrouillés après réponse à tout ce qui est répondable sans machine | 26 / 52 | **46 / 52** |

L'empreinte du réservoir a été prise avant la correction
(`run/reservoir-avant.tsv`) et comparée après : **les tailles sont
identiques** ; seul l'ordre des questions dans le réservoir change (la
réserve vient après les questions maison). Les copies d'examen changent donc,
mais restent **distinctes pour chaque élève** (20 copies → 20 ensembles
différents, contrôle de l'auditeur « épreuves »).

**Les garde-fous, vérifiés par mutation.** Trois contrôles automatiques ont
été ajoutés à l'auditeur « épreuves » : (1) aucune question importée dans
une tâche ; (2) la copie servie du point de contrôle ne dépasse jamais la
taille de l'épreuve ; (3) la réserve alimente bien le réservoir — sans quoi
les questions importées disparaîtraient de la plateforme. Ils **échouent
quand la règle est affaiblie** : la mutation a été faite exprès (l'ancien
comportement de fusion a été remis), et les contrôles sont bien passés au
rouge. Six tests de non-régression ont été ajoutés à `tests/smoke-test.php`
(**331 tests, 0 échec**) : avec la même mutation, trois tests tombent.

**Ce que le comité local dit — et ce qu'il ne dit pas.** Le comité d'audit
local trouve 5 constats majeurs : ce sont des **constats d'environnement**
(RTL `ar`/`en`, archive auteur, inscription libre-service, drapeaux absents
des machines en local), pas des constats de contenu. Pour le panel des
élèves, un test A/B a été fait : **avec l'ancien moteur et avec le nouveau,
le panel local donne exactement le même résultat** (0 question traitée) — la
cause est l'environnement local, pas la séparation. L'arbitre reste
**GitHub**, en vrais conteneurs.

## 2. Les constats du premier passage, et leur traitement

| # | Constat | Auditeur | Gravité | Traitement | État |
|---|---|---|---|---|---|
| 1 | Aucune description de page : le moteur inventait le résumé | SEO | Majeur | Description générée dans le thème (160 caractères, traduite) | **Corrigé** |
| 2 | Aucune carte de partage (Facebook, WhatsApp, LinkedIn, X) | SEO | Mineur | Open Graph + carte Twitter ajoutés | **Corrigé** |
| 3 | Aucun `hreflang` : les versions arabe et anglaise pouvaient être traitées comme des doublons | SEO | Mineur | Liens alternatifs FR/AR/EN + `x-default` | **Corrigé** |
| 4 | Le sélecteur de langue n'existait qu'en JavaScript | UX/UI | Majeur | Vrais liens dans l'en-tête, avec `aria-current` et style | **Corrigé** |
| 5 | Aucun en-tête de sécurité HTTP (anti-clickjacking, anti-sniffing) | Sécurité | Majeur | `X-Frame-Options`, `X-Content-Type-Options`, `Referrer-Policy`, `Permissions-Policy` | **Corrigé** |
| 6 | La sauvegarde du déploiement ne contenait pas la base de données | Sécurité | Majeur | Export de la base ajouté à `scripts/deploy.sh` | **Corrigé** |
| 7 | La page de room n'annonçait pas la langue arabe en RTL | SEO | Majeur | Vérification de `dir="rtl"` ajoutée au contrôle | **Corrigé** |
| 8 | Aucune trace écrite des audits | Comité | Majeur | Registre créé, rapports versionnés, workflow `audit.yml` | **Corrigé** |

### 2 bis. Les constats de l'audit « conformité aux réponses générées par l'IA » (guide Google, 01/11/2026)

| # | Constat | Gravité | Traitement | État |
|---|---|---|---|---|
| 9 | Les adresses de langue étaient **relatives** (`/rooms/…`) : Google ignore les adresses relatives, les versions AR et EN pouvaient être abandonnées | Majeur | `hreflang` FR/AR/EN + `x-default` en adresses absolues | **Corrigé** |
| 10 | **Aucune adresse canonique** : la version arabe ressemblait à un doublon de la version française, et pouvait ne pas être indexée | Majeur | Canonique auto-référente par langue (FR, AR, EN) ; celle de WordPress, qui ignorait la langue, a été retirée pour n'en garder qu'une | **Corrigé** |
| 11 | **Aucune donnée structurée** (schema.org) : le moteur ne pouvait pas savoir que la page est une room ni qu'elle contient une vidéo | Mineur | `class-secura-schema.php` : `Organization`, `LearningResource`, `VideoObject`, `BreadcrumbList`, `Course` | **Corrigé** |
| 12 | La vidéo du cours n'était déclarée nulle part (la façade ne charge rien avant le clic) : invisible pour un moteur | Mineur | `VideoObject` avec durée, miniature, adresse de lecture, éditeur et licence | **Corrigé** |
| 13 | La room n'avait **aucun titre de section** (`h2`) : ni les lecteurs d'écran ni les agents ne trouvaient de repères | Mineur | 4 titres de niveau 2 par room (leçon, tâches, machine, terminal) | **Corrigé** |
| 14 | Les étapes pratiques de la room étaient dessinées par le JavaScript : un robot sans JavaScript ne lisait pas le cœur du cours | Majeur | Liste des étapes servie dans le HTML, doublée en `<noscript>` | **Corrigé** |

---

### 2 ter. La régression « les boutons ne faisaient plus rien » (01/11/2026, v0.8.1)

**Le symptôme.** Après la livraison du comité d'audit à quinze experts
(version 0.8.0), les deux workflows GitHub sont tombés en échec. En
rejouant la recette des deux apprenants à la main, le site a montré un
défaut bien plus grave que l'échec des tests : **le bouton « Déployer la
machine » ne faisait plus rien**, et l'élève recevait « Une erreur est
survenue. »

**La cause racine.** Le nom d'une action AJAX (le nom que le navigateur
envoie au site) est un **contrat** : il est écrit à trois endroits — le
front `assets/academy.js`, le script de recette des deux apprenants, et le
plugin qui enregistre la demande. Lors de la livraison du comité, le
préfixe de ces noms avait été raccourci de `secura_` en `seca_` **dans le
plugin seulement**. Le front, lui, continuait d'appeler `secura_lab_start`,
`secura_terminal`, `secura_lab_status`, `secura_lab_stop`.

Le symptôme est silencieux : WordPress ne dit pas « action inconnue », il
répond **`0`** avec un code HTTP 400. Aucun journal, aucune erreur visible.
Le bouton noumbla.

**La preuve** (pas une déduction) :

| Ce qui a été mesuré | Résultat |
|---|---|
| Crochet `wp_ajax_secura_get_room` | **présent** |
| Crochets `wp_ajax_secura_lab_start`, `wp_ajax_secura_terminal`, `wp_ajax_secura_lab_status`, `wp_ajax_secura_lab_stop` | **absents** |
| La version précédente du plugin (`git show d71a7e1`) | enregistrait bien `wp_ajax_secura_*` |
| Appel direct de `secura_lab_start` depuis le navigateur | HTTP 400, corps `0` |
| Scénario complet après correction | **100 % réussi**, code de sortie 0 : les deux élèves déploient leur machine, exécutent leurs commandes, lisent le drapeau `SECURA{sql_injection_web}` **dans leur propre conteneur** |

**Le traitement.**

| Correction | Fichier |
|---|---|
| Les **onze** actions sont revenues à leur contrat `secura_*` (et `wp_ajax_nopriv_` conservé, pour que l'invité reçoive une vraie invitation et non une erreur) | `wp-content/plugins/secura-academy/includes/class-secura-ajax.php` |
| La sonde de pré-contrôle de la recette interroge la bonne action | `tools/recette-apprenants/scenario.py` |
| L'auditeur « Onboarding » interroge la bonne action (il ne testait donc rien avant) | `scripts/audit/audit-onboarding.php` |
| La CI crée les pages légales avant l'audit RGPD | `scripts/ci-wordpress.sh` |

**Le garde-fou (pour que ça ne se reproduise plus).** Deux contrôles
automatiques ont été ajoutés à l'auditeur « Développement » (14 → 16
contrôles) : ils comparent **nom par nom** la liste des actions appelées
par le front et par la recette avec la liste des actions enregistrées par
le plugin. Une seule action qui diffère suffit à faire échouer l'audit en
bloquant, avec le nom de l'action fautive.

Ce garde-fou a été **testé dans les deux sens** : en le faisant échouer
volontairement (le plugin enregistrant `seca_lab_start` au lieu de
`secura_lab_start`), il a bien produit **2 constats bloquants** en
dénommant l'action fautive ; remis à l'endroit, il repasse au vert.

> **La leçon, écrite dans le plugin lui-même.** Un nom d'action AJAX ne se
> renomme pas en un seul endroit. Cette règle est désormais rappelée en
> commentaire dans le fichier qui enregistre les actions, et vérifiée à
> chaque push.

### 2 quater. Le mot « fonctionnalités » écrit en coréen (01/11/2026, v0.8.1)

**Le symptôme.** En relisant les textes livrés, une phrase de la politique
de confidentialité contenait deux caractères coréens à la place du mot
« fonctionnalités ». À l'écran, rien ne se voit : les caractères coréens
ont exactement l'apparence d'un texte latin.

**Où le défaut était visible — et où il ne l'était pas.**

| Endroit | Avant le correctif | Après |
|---|---|---|
| La page affichée dans le navigateur | **correcte** (le plugin sert son propre texte) | correcte |
| Le texte brut en base de données | **corrompu** | corrigé |
| **L'API REST** (`/wp-json/wp/v2/pages/3`) | **corrompu** — donc public | corrigé |

**⇒ La leçon : « la page marche » ne prouve pas que « le contenu est
propre ».** Le site affichait un texte correct parce que le plugin le
remplace au moment du rendu ; mais l'API REST, elle, publie le texte
brut de la base. Le défaut était donc accessible à quiconque knew l'adresse.

**Le traitement.**

| Correction | Fichier |
|---|---|
| Le texte est réécrit proprement | `wp-content/plugins/secura-academy/includes/content-legal.php` |
| Les pages légales **de la base** sont mises à jour à chaque nouvelle version du plugin — en ne jamais écrasant un texte que le propriétaire aurait retouché à la main (comparaison par empreinte) | `wp-content/plugins/secura-academy/includes/class-secura-site.php` |

**Le garde-fou.** Un contrôle a été ajouté à l'auditeur « Multilingue »
(6 → 7 contrôles) : il cherche, dans les fichiers livrés **et dans les
pages réellement servies** (y compris l'API REST), tout caractère
appartenant à une écriture étrangère au site (cyrillique, grec, han,
hiragana, katakana, hangul, devanagari, thaï, hébreu). L'arabe, langue
officielle du site, n'est pas concerné.

Ce contrôle a été **testé dans les deux sens** : en réintroduisant le
caractère coréen, il a signalé **4 intrusions** en nommant le fichier et
la page ; remis à l'endroit, il repasse au vert.

> **Note de méthode.** La première version de ce contrôle lisait la base
> de données et signalait le texte brut — y compris lorsqu'un
> propriétaire y avait écrit son propre texte. C'était un **faux
> positif** : le contrôle a été réécrit pour vérifier ce que le visiteur
> reçoit vraiment. Un audit qui produit de faux positifs perd la
> confiance de celui qui le lit ; il vaut mieux un audit étroit et vrai
> qu'un audit large et approximatif.

---

### 2 quinquies. Le piège WP-CLI : les pages légales qui n'existaient qu'à moitié (01/11/2026, v0.8.2)

**Le symptôme.** Le workflow « Audit externe » est tombé rouge sur un
constat **bloquant** de l'auditeur RGPD :

> Politique de confidentialité (statut : **draft**) | Mentions légales
> (**aucune page** « mentions-legales »)

Autrement dit : sur un site installé **en ligne de commande**, les deux
pages que la loi impose à une plateforme accueillant des mineurs
n'existaient pas. La recette manuelle, elle, les montrait bien.

**La cause — un contexte, pas une faute de logique.** Le plugin rangeait
les textes légaux dans une **variable globale**
(`$secura_pages_legales`). Or **WP-CLI charge WordPress à l'intérieur
d'une fonction** (`WP_CLI\Runner::load_wordpress()`) : une variable
globale définie par un plugin n'y existe pas. WordPress lui-même le
dit, en tête de `wp-settings.php` :

```php
global $wp_version, $wp_db_version, $tinymce_version, … ;   // les seules globales
```

et WP-CLI le répète dans son propre code :

```php
// Globals not explicitly globalized in WordPress
global $site_id, $wpdb, $public, $current_site, $current_blog, $path, $shortcode_tags;
```

**La preuve, mesurée** (et non supposée) :

| Mesure | Résultat |
|---|---|
| `class_exists( 'Secura_Site' )` sous WP-CLI | **vrai** — le plugin est bien chargé |
| `isset( $GLOBALS['secura_pages_legales'] )` sous WP-CLI | **faux** — la variable n'existe pas |
| Même installation, servie par un vrai serveur web | les pages légales ** existent** |
| Base neuve + installation en ligne de commande | pages légales **absentes** (le défaut rejoué) |

**Pourquoi la recette manuelle ne l'avait pas vu.** Sur un serveur web,
une variable de plugin est bien globale : tout fonctionnait. En CI,
tout passe par WP-CLI : rien ne fonctionnait. **Le défaut ne vivait
que dans un contexte** — et la recette jouait toujours dans l'autre.

**Le traitement.**

| Correction | Fichier |
|---|---|
| Les textes passent par une **fonction** (`seca_textes_legaux()`), qui existe dans tous les contextes — web, WP-CLI, cron, tests | `wp-content/plugins/secura-academy/secura-academy.php`, `includes/class-secura-site.php` |
| L'installation est **vérifiée explicitement** : si les pages légales ne sont pas publiées, le script s'arrête en disant pourquoi | `scripts/verifier-pages-legales.php`, `scripts/ci-wordpress.sh` |

**Les garde-fous (testés dans les deux sens).**

1. `scripts/ci-wordpress.sh` affiche l'état des deux pages après
   l'installation et **échoue bruyamment** si l'une manque ou n'est pas
   publiée. Reproduit volontairement (textes vidés), le contrôle sort en
   erreur en nommant la page absente.
2. L'auditeur « Développement » gained **deux contrôles** (16 → 18) :
   le code livré ne lit **aucune variable globale définie par le
   plugin** (les globales de WordPress, comme `$wpdb`, restent
   autorisées — elles existent vraiment), et les textes légaux sont
   **atteignables par une fonction**.
3. L'auditeur « Données structurées » compare désormais des textes
   **normalisés** (entités décodées, apostrophes unifiées).

**Un contre-exemple honnête.** Le contrôle « ce qui est déclaré
apparaît aussi à l'écran » a d'abord produit un **faux positif** : le
titre « Débordement de tampon : l'attaque et les défenses » était bien
à l'écran, mais le HTML échappait l'apostrophe typographique
(`&#8217;`) là où le JSON-LD gardait l'apostrophe droite. Le contrôle
a été corrigé — on normalise les deux côtés avant de comparer — et non
le contenu : le titre affiché reste parfaitement correct.

> **La leçon.** « Ça marche sur mon serveur » n'est pas une preuve :
> c'est une preuve **dans un contexte**. Un test qui rejoue
> l'installation *dans un autre contexte* — la ligne de commande, une
> base neuve — prouve ce que la recette manuelle ne prouve pas. Et un
> workflow qui échoue doit **dire pourquoi dans son journal** : c'est
> désormais le cas, l'installation est vérifiée et sa cause est
> nommée.

---

### 2 sexies. La feuille de style arabe, demandée à une adresse qui n'existait pas (01/11/2026, v0.8.3)

**Le symptôme.** L'auditeur « Multilingue » signalait, dans la CI
seulement, « 4 propriétés physiques au lieu de logiques » dans un fichier
appelé `style-rtl.css`. Un fichier nommé « style-rtl » : notre feuille
arabe, censée porter les ajustements de mise en page et de typographie de
la version arabe.

**Ce qui se passait vraiment.** Le thème déclarait sa feuille arabe avec
un **chemin de fichier** là où il fallait une **adresse** :

```php
get_template_directory() . '/style-rtl.css'   // /chemin/du/serveur/…
get_template_directory_uri() . '/style-rtl.css' // https://site/…  ← correct
```

Le navigateur demandait donc `/tmp/wp-ci-fresh/wp-content/themes/…/style-rtl.css`
à la racine du site : la réponse était un **404**, et **la feuille arabe
n'était jamais chargée**. Le site paraissait correct — l'attribut
`dir="rtl"` est posé par le plugin — mais aucune mise en page arabe
n'était appliquée.

**La preuve, mesurée.**

| Mesure | Avant | Après |
|---|---|---|
| Adresse demandée par le navigateur pour la feuille arabe | `http://site/tmp/…/style-rtl.css?ver=0.7.0` | `http://site/wp-content/themes/secura-learning/style-rtl.css?ver=0.8.3` |
| Réponse du serveur | **404** (60 Ko de HTML) | **200** (feuille de style) |
| Feuilles de style en erreur sur la page arabe | 1 | **0** |

**Et le faux positif.** Le contrôle mesurait la réponse **404** — c'est-à-
dire une page d'erreur de WordPress, qui contient le CSS de WordPress en
ligne, avec des propriétés physiques (légitimes : ce sont les fichiers
RTL de WordPress, la contrepartie de ses fichiers LTR). Le contrôle
signalait donc **le CSS de WordPress**, pas le nôtre. Nos deux feuilles
de style (celles du plugin et celles du thème) contiennent **zéro**
propriété physique — vérifié sur les fichiers du dépôt.

**Le traitement.**

| Correction | Fichier |
|---|---|
| La feuille arabe est déclarée avec une **adresse**, et non un chemin | `wp-content/themes/secura-learning/functions.php` |
| Elle est en outre chargée dès que le **visiteur** lit en arabe — même si le site est en français (c'est le cas par défaut) | `wp-content/themes/secura-learning/functions.php` |
| La version du thème est cohérente partout (elle était restée à `0.7.0` dans le code, alors que l'en-tête du CSS annonçait `0.8.2`) | `wp-content/themes/secura-learning/functions.php`, `style.css` |
| Le contrôle ne mesure plus que des **feuilles de style** (HTTP 200) et nomme l'adresse complète dans sa preuve | `scripts/audit/audit-multilingue.php` |

**Les garde-fous.**

1. **Un contrôle nouveau (bloquant)** : « toutes les feuilles de style de
   la page se chargent (HTTP 200) », dans les trois langues. C'est celui
   qui aurait dû attraper ce défaut dès le début — il était invisible
   parce que personne ne vérifiait que la feuille était *chargée*.
2. Un contrôle de l'auditeur « Multilingue » ne mesure plus une page
   d'erreur comme si c'était une feuille de style, et la preuve affiche
   l'adresse complète : un constat est actionnable.
3. Un faux positif de l'auditeur « SEO » est corrigé au passage : le
   titre d'une room était comparé à la page **sans normaliser les
   apostrophes** (droites dans la base, typographiques à l'écran) —
   d'où un « titre absent » qui n'était pas absent.

> **La leçon.** « La page s'affiche en arabe » ne prouve pas que « la
> mise en page arabe est appliquée ». Il y a deux choses : le sens de
> lecture du **document** (`dir="rtl"`), et celui de la **mise en page**
> (la feuille de style). Les deux doivent être vérifiés, séparément — et
> une feuille de style doit être vérifiée **en la chargeant**, pas en
> presumant qu'elle est là parce qu'elle est déclarée.

---

### 2 septies. Un audit qui tire au sort ne prouve rien (01/11/2026, v0.8.3-bis)

**Le symptôme.** La CI a trouvé un **majeur d'accessibilité** que la recette
locale ne voyait jamais : dans la room « Kahoot : la révision des labs
avancés », la hiérarchie des titres sautait du niveau 1 au niveau 3
(`<h1>` → `<h3>`). Un lecteur d'écran annonce alors « titre de niveau 2
manquant » : la structure de la page n'est plus comprise.

**Pourquoi la recette locale ne l'avait pas vu.** Le contrôle
d'accessibilité **tirait une room au hasard** parmi celles qui existent.
Selon l'identifiant tiré, le défaut apparaissait ou non : il était
**visible en CI, invisible en local**, et son résultat changeait d'une
exécution à l'autre. Un contrôle qui dépend d'un hasard n'est pas un
contrôle.

**La cause réelle du saut.** Les autres blocs d'une room (les tâches, la
machine cible, le terminal) titrent en `<h2>`. Le bloc Kahoot titrait en
`<h3>` : un niveau inventé, sans rapport avec sa place dans la page.

**La preuve, mesurée.**

| Mesure | Avant | Après |
|---|---|---|
| Séquence de titres de la room 59 | `h2, h1, h3, h2, h2, h2` | `h2, h1, h2, h2, h2, h2` |
| Sauts de niveau détectés sur les 52 rooms | 1 (room 59) | **0** |
| Rooms sans titre de niveau 1 unique | 0 | **0** |
| Rooms contrôlées par l'audit | 1 (tirée au hasard) | **53** (accueil + 52 rooms) |

**Le traitement.**

| Correction | Fichier |
|---|---|
| Le bloc Kahoot titre en `<h2>` (le style est porté par la classe `seca-kahoot-title` : **le rendu visible ne change pas**) | `wp-content/plugins/secura-academy/includes/class-secura-kahoot.php` |
| L'audit d'accessibilité vérifie **toutes** les rooms (accueil + 52), dans l'ordre des identifiants — plus aucun tirage au sort | `scripts/audit/audit-accessibilite.php` |
| L'auditeur « SEO » vérifie le titre de **chaque** room sur la page réellement servie (comparaison après normalisation) | `scripts/audit/audit-seo.php` |

**Les garde-fous.**

1. **Le test négatif.** Le défaut a été **remis volontairement** dans la
   source : l'audit a alors produit « room 59 : saut de niveau h1 → h3 »
   (majeur, en nommant la room). La faute réintroduite, le défaut revient :
   le garde-fou est vérifié **dans les deux sens**, pas seulement quand tout
   va bien.
2. **Aucun échantillon arbitraire.** Les audits qui portaient sur « une
   room tirée au hasard » ne regardent plus qu'un tirage : ils regardent
   **tout le catalogue** (53 pages), en deux secondes.
3. **Le même traitement pour le SEO.** Le titre de chaque room est
   comparé à ce que la page **servie** annonce, après normalisation des
   entités et des apostrophes (droites dans la base, typographiques à
   l'écran) — un contrôle qui produit des faux positifs perd la confiance
   de celui qui le lit.

> **La leçon.** « 0 constat » n'a de valeur que si le contrôle a regardé
> **tout** ce qu'il prétend regarder. Un contrôle qui choisit sa cible au
> hasard peut afficher « conforme » le jour où la cible est saine, et
> « rouge » le lendemain pour une raison qui n'a rien à voir avec le
> code. Le passage de 202 à **203 contrôles** n'est pas un ajout de
> couverture : c'est un **dépistage qui ne laisse plus rien au hasard**.
>
> *(Complété le 01/11/2026, v0.8.4 : cette leçon ne s'appliquait qu'au
> contrôle d'accessibilité. La contre-expertise des quinze scripts a montré
> que **six autres auditeurs** tiraient eux aussi leur cible — voir
> § 2 octies. La règle est désormais appliquée à tous.)*

---

### 2 octies. Six audits qui ne regardaient qu'une room sur 52 — et une barrière qui ne rougissait que sur les constats bloquants (01/11/2026, v0.8.4)

**La question posée.** « As-tu fait tous les tests qu'il faut ? Si on
redemande aux quinze auditeurs le même audit, qu'obtiendra-t-on ? »
Autrement dit : **le « 0 constat » est-il le résultat d'un travail
exhaustif, ou celui d'un regard partiel ?**

**La contre-expertise.** La relecture des quinze scripts d'audit a cherché
une seule chose : *un contrôle qui tire sa cible au hasard, ou qui
n'en regarde qu'une*. Six l'ont fait :

| Auditeur | Ce qui était mesuré | Ce qui est mesuré désormais |
|---|---|---|
| Données structurées | 1 room + 1 parcours | **les 52 rooms + les 4 parcours**, et les **versions arabes et anglaises de chaque room** (104 pages de plus) |
| Onboarding | 1 room jouée sans compte | **les 52 rooms jouées une par une** (leçon servie + invitation à s'inscrire, pour chacune) |
| UX / UI | 1 room rendue | **les 52 rooms rendues** (titre unique, boutons nommés, champs étiquetés, façade vidéo, lien de secours) |
| Performance | accueil + parcours + 1 room | **les 54 pages** (accueil, parcours, 52 rooms) : poids, temps, scripts, iframes |
| Multilingue | 1 room pour les liens de version linguistique | **les 53 pages** (accueil + 52 rooms) ; et **160 pages réellement servies** lues à la place d'une seule |
| SEO | 1 room pour le résumé, la canonique, le partage | **les 52 rooms** pour le titre, le résumé, l'adresse canonique, l'aperçu de partage, la langue déclarée, l'affichage téléphone — **et la version arabe de chacune** (HTTP 200 + `dir="rtl"`) |

**Le résultat : aucun nouveau constat.** La plateforme était saine — mais
on ne le savait pas encore, parce qu'on ne l'avait pas cherché partout.

**La preuve que le regard est désormais complet (test négatif).** Une
room a été amputée **exprès** de son résumé (meta description) dans le
bac à sable — la room 59, celle que l'ancien contrôle ne regardait pas :

| Contrôle | Avant (une seule room) | Après (toutes les rooms) |
|---|---|---|
| « la page a une meta description » | **ok** — il regardait la room 8 | **ok** — il regarde toujours la room 8 |
| « chaque room est prête pour le moteur » | *(ce contrôle n'existait pas)* | **[MAJEUR]** — « kahoot-la-revision-des-labs-avances : meta description » |

Le défaut était **invisible** pour l'ancien contrôle et **visible** pour
le nouveau, qui nomme la room concernée. C'est exactement ce que l'on
attend d'un garde-fou : il doit voir ce que l'ancien ne voyait pas.

**Le trou de la barrière — le plus important de ce passage.** La CI
passait au **vert** dès qu'un constat existait, tant qu'il n'était pas
« bloquant ». Concrètement : le défaut `h1 → h3` de la room « Kahoot »
( Gravité **majeur**) a été **livré** ; la CI était verte ; la
plateforme était déclarée « conforme » ; et le défaut n'est apparu que
parce qu'un humain a lu le journal de la CI.

La barrière est donc **durcie** : elle bloque désormais sur un constat
**bloquant ou majeur**. Le niveau « mineur » et le niveau « info »
restent informatifs.

| État | Avant | Après |
|---|---|---|
| Aucun constat | code 0 | code 0 |
| Un constat mineur | code 0 | code 0 |
| Un constat **majeur** | **code 0** (la CI passait au vert) | **code 1** (la CI rougit) |
| Un constat bloquant | code 1 | code 1 |

**Le garde-fou de ce garde-fou.** L'auditeur « DevOps » vérifie désormais
la barrière **lui-même**, en comportement et non en lecture : il extrait
la condition de sortie du code de `audit_fin()`, l'évalue avec trois
états (aucun constat, un majeur, un bloquant) et exige les codes
**0 / 1 / 1**. Testé dans les deux sens : avec l'ancienne barrière
(« bloquant seul »), l'audit produit **[MAJEUR]** « la barrière
automatique bloque sur un constat majeur, pas seulement bloquant » ;
avec la nouvelle, il est vert.

**La reproductibilité, mesurée.** Le comité a été **rejoué deux fois de
suite** sur le même code, et les quinze rapports JSON ont été comparés
champ par champ : **15/15 identiques** (hors horodatage). Un audit dont
le résultat change d'une exécution à l'autre n'est pas un audit ; celui-ci
ne bouge plus.

> **La leçon.** « 0 constat » ne veut rien dire tant qu'on ne sait pas
> *ce qui a été regardé*. La question utile n'est donc pas « le comité
> est-il vert ? » mais « **le comité a-t-il regardé tout ?** ». Cette
> fois-ci, la réponse est mesurable : 53 pages pour l'accessibilité, 57
> pour les données structurées, 160 pages servies pour le multilingue,
> 54 pages pesées pour la performance, 52 rooms jouées pour l'onboarding
> et pour l'ergonomie, 104 versions arabes et anglaises pour le SEO — et
> une barrière qui rougit dès qu'un constat de fond existe.

---

## 3. Ce que le comité a confirmé de bon

C'est aussi utile qu'un constat : ces points sont **vérifiés à chaque
push** désormais, et ne peuvent plus se dégrader.

- **SEO** : adresses lisibles, `robots.txt` ouvert, plan du site présent,
  titres uniques et assez courts, un seul titre de niveau 1 par page,
  images avec texte alternatif.
- **Contenu** : les 52 rooms ont les 4 temps du parcours, 255 questions
  toutes à 4 propositions avec une seule bonne réponse, une explication
  et un indice ; la bonne réponse n'est jamais toujours à la même place ;
  toutes les rooms sont traduites AR/EN ; toutes les vidéos sont
  attribuées ; toutes les missions pointent vers un drapeau lisible sur
  une machine ; aucun texte de remplissage, aucun caractère étranger.
- **UX / UI** : contrastes calculés conformes à WCAG AA (le plus faible
  est à 6,77:1, très au-dessus du minimum de 4,5:1), boutons nommés,
  champs étiquetés, façade vidéo respectée, lien de secours visible,
  cibles tactiles, RTL, focus visible, « moins d'animations » respecté.
- **Développement** : 22 fichiers PHP compilent, aucune fonction PHP 8
  (la cible reste 7.4), aucune sortie non échappée, aucune requête SQL
  non préparée, nonce + session + limitation de débit sur toute l'API,
  aucun reste de mise au point, **302 tests internes au vert**.
- **Sécurité & infra** : aucun secret en clair, isolation par élève
  (projet et réseau dédiés), exécutions confinées dans le conteneur,
  conteneurs durcis (`cap_drop`, `no-new-privileges`, limites de
  processus), réseaux sans sortie Internet, drapeaux en `400 root:root`,
  permissions limitées sur tous les workflows, secrets jamais dans le
  code.
- **Le comité, rejoué en CI réelle** : le passage du 02/11/2026
  (`41374598365`) a rejoué les 18 auditeurs dans un WordPress neuf et des
  conteneurs Docker réels : **226 contrôles, 0 bloquant, 0 majeur, 1 mineur**.
  Les 61 questions qui demandent la machine y ont été **jouées et
  acceptées**, machine déployée et fichier relu en root. C'est la preuve la
  plus forte obtenue à ce jour : elle ne dépend ni du poste de travail ni
  de l'émulateur local.

---

## 4. Ce qui reste ouvert (et n'est pas bloquant)

| Sujet | Pourquoi | Suite |
|---|---|---|
| Les labs M7 sont volontairement difficiles | C'est le palier 3 | Un parcours d'échauffement avant le dojo, à évaluer après usage |
| Les vidéos de brief sont en anglais | Les cours originaux sont des sources anglaises | Les leçons écrites sont, elles, traduites AR/EN |
| Les Core Web Vitals réels (LCP, CLS, INP) ne se mesurent pas depuis le serveur | Ils se mesurent dans le navigateur du visiteur | L'auditeur Performance vérifie les **causes racines** ; la mesure réelle se fera avec PageSpeed Insights à la mise en ligne |
| Pas de contrôle d'âge ni de consentement parental | Exigence RGPD pour les moins de 15 ans | Signalé par l'auditeur RGPD — à traiter au niveau du produit |
| 14 rooms sur 52 n'ont pas de machine d'entraînement | Leur exercice d'application est un QCM, pas une manipulation | Mesuré par l'auditeur Pédagogie — au backlog |
| La traduction AR/EN des textes de certification manque | Le nom de la certification est le même partout, l'explication reste en français | Au backlog |
| Search Console non connectée, donc pas de rapport « Generative AI performance » | Le site n'est pas public | À connecter à la mise en ligne, puis à suivre chaque mois |
| Le dojo pwn.college officiel n'est pas construit en CI | Son image est trop lourde | À faire sur le VPS, quand il existera |

---

## 4 bis. Quand l'auditeur a tort : les faux positifs du 04/11/2026

Le comité du 03/11 a signalé **quatre** constats. En les reprenant un par un
avec une mesure, **trois venaient de l'auditeur lui-même** et un seul était
un vrai défaut de la plateforme. C'est exactement le piège qu'un audit
automatique tend : un contrôle mal écrit accuse le contenu au lieu de
s'accuser lui-même.

| Constat du comité | Ce que la mesure a montré | Origine | Traitement |
|---|---|---|---|
| 536 questions « solution » sans correction officielle | **0 question réellement non conforme** : correction, source et licence sont présentes sur les 536 | **Faux positif de l'auditeur** — un typo de variable : il mesurait `strlen( $explanation )` (anglais) au lieu de `$explication` (français), donc `strlen(null)` valait 0 et toute question était comptée comme trop courte | Variable corrigée ; le contrôle a reçu la **mesure réelle en preuve**, pour qu'un vrai défaut futur soit compté au lieu de passer en silence |
| 11 questions à choix malformées | Les **11** sont des QCM **Stanford CS224N à 4 propositions** (A/B/C/D), avec une seule bonne réponse à la bonne place | **Faux positif de l'auditeur** — la règle exigeait 2 ou 3 propositions, alors que son propre libellé disait « le format d'origine quand elles sont importées » | La règle accepte désormais le format **mesuré** (2, 3 ou 4), toujours avec une seule bonne réponse, une source et une licence |
| 20 questions sans indice (mineur) | **Vrai défaut** : les 20 questions du quiz **MIT 6.172** n'avaient aucun indice — l'élève était bloqué | Contenu | L'extracteur (`tools/import-mit-blocs.py`) et le lot sont corrigés à la source |
| 1 bloquant + 1 majeur DevOps | **Vrais défauts** : `criblage-ocw.yml` et `recuperation-sources.yml` demandaient plus de permissions que nécessaire, et le second n'était borné dans le temps | Configuration | `permissions: contents: read` et `timeout-minutes` ajoutés |

Deux autres corrections sont tombées en route :

- **L'attribution vidéo n'était pas trouvee** alors qu'elle est bien servie :
  l'auditeur cherchait dans le texte visible après `wp_strip_all_tags()`, qui
  efface les scripts — or l'attribution est dans les **données structurées**
  (JSON-LD) que le navigateur affiche. On cherche maintenant dans le **HTML
  servi**.
- **L'auditeur « accessibilité » plantait** sur une variable mal orthographiée
  (`$ciables_petites` au lieu de `$cibles_petites`). Invisible à l'œil,
  fatal à l'exécution : l'audit n'avait jamais pu rendre son verdict. Corrigé,
  et l'audit tourne enfin.

### La transparence du harnais

Un constat **sans preuve** est rejeté par le harnais : une affirmation sans
preuve n'est pas un constat. Mais l'affichage écrivait `BLOQUANT` en
majuscules, comme si le constat bloquait la mise en ligne — alors que le
harnais venait de le rejeter. C'est ce qui a fait lire au comité quatre
problèmes là où il y en avait un. L'écriture est désormais
`[NON ÉTAYÉ] (gravité annoncée)`, et les contrôles de contenu reçoivent la
**mesure** comme preuve.

**Règle retenue : un diagnostic se vérifie contre une seconde mesure.** Elle
a été appliquée ici, et elle a payé : sur les quatre constats, un seul
résistait à la mesure.

---

## 5. Comment reproduire l'audit

```bash
# En local (un WordPress déjà installé)
SECA_WP_DIR=/tmp/wp-u2 bash scripts/audit/run-audits.sh

# Dans GitHub (le workflow fait tout : WordPress, serveur, audits, rapports)
gh workflow run audit.yml
```

Les rapports sont écrits dans `docs/audits/` et archivés par le workflow.

---

## 6. Historique

| Date | Version | Résultat |
|---|---|---|
| 04/11/2026 (v0.12.5 a v0.12.7, la CI ne peut plus demarrer) | v0.12.5 → v0.12.7 | **Les cinq travaux GitHub echouent en deux a neuf secondes, sans executer une seule etape.** Ce n'est pas un defaut du code : dans l'API, chaque job echoue avec `steps` vide et `runner_name` vide — GitHub n'arrive pas a **affecter un runner**. Le meme symptome touche un `workflow_dispatch` lance a la main, et le commit precedent (v0.12.4) etait encore vert trente minutes avant. La page d'etat de GitHub annonce « All Systems Operational » : l'incident est donc **propre au compte** (depot prive : le quota de minutes GitHub Actions du plan gratuit est plafonne a 2 000 minutes par mois, et les travaux de criblage a six robots, de machines Docker et de recette WordPress consomment ce quota). **Ce qui depend de l'agent :** `tools/ci-relance.py` detecte ce cas (job vert en moins de dix secondes, sans etape, sans runner) et **relance automatiquement** le travail toutes les trois minutes ; la verification complete se fera des que le quota sera retabli. **Ce qui depend du proprietaire :** retablir le quota (Reglages → Facturation et licences → Actions : ajouter un moyen de paiement, ou attendre le renouvellement mensuel), ou brancher un runner auto-heberge. **Dernier etat verifie sur GitHub :** v0.12.4, les cinq travaux verts, audit externe **236 controles / 0 bloquant / 0 majeur / 0 constat non etaye**. **En attendant, les controles locaux ont ete joues :** controleur de lots **1 891 questions sans probleme**, non-regression **10/10**, import **80 controles OK**, recette **331 tests OK, 0 echec**, et les mesures du bac a sable (2 283 questions, 0 question importee dans une tache, reserve max 1 404). Le bac a sable local n'a pas ete pris pour un verdict : ses constats d'URL (`localhost:8080`), de connexion et de Docker sont des **faux positifs d'environnement**. |
| 02/11/2026 (v0.11.3, récolte et faux positif du grec) | v0.11.3 | **Deux nouveaux cours du MIT importés, et un faux positif de l'audit corrigé.** (1) La récolte continue : **6.828 Operating System Engineering** (31 questions) et **14.15J Introduction to Computer Networks** (14 questions) sont entrés dans la banque avec leurs **corrigés officiels**, sous licence **CC BY-NC-SA 4.0** — 45 questions de plus, le déficit de réservoir passant de **80 à 31**. Un second extracteur a été écrit pour le format « problème + sous-questions » : il apparie **chaque question à son corrigé officiel par l'ordre du document**, et **abandonne** la question si la correspondance ne se vérifie pas — aucune réponse n'est inventée. (2) Le même jour, l'audit externe a signalé un **constat majeur** : 51 caractères grecs (Γ, λ) dans le fichier importé. C'était **un faux positif** : l'audit cherche « un caractère à l'apparence latine mais d'une autre écriture », or λ et Γ ne ressemblent à rien de latin — ce sont des **symboles mathématiques** qui font partie de l'énoncé d'un examen de maths réseau. On ne réécrit pas un examen du MIT pour effacer une lambda. **Correction** : le grec est désormais toléré **dans les seuls fichiers de questions importées** (jamais dans le code du site ni dans le contenu rédigé) ; le cyrillique, le han et les autres écritures restent interdits partout, import compris. **Preuve que la détection reste vivante** : neuf tests automatiques dans `tests/smoke-test.php` vérifient qu'un caractère cyrillique ou han est toujours refusé, y compris dans un fichier importé, et que le grec reste refusé hors import. Le contrôle multilingue repasse au vert (8 contrôles, 0 constat). |
| 03/11/2026 (v0.11.4, les examens d'université en réserve) | v0.11.4 | **Le point de contrôle retrouve la taille de l'épreuve.** En préparant la vague 2 de l'import (143 questions de cinq cours du MIT), la mesure a montré que **36 des 52 rooms** avaient une tâche `test` plus grosse que la règle du moteur ne l'autorise — jusqu'à **80 et 77 questions** à rendre sur les deux rooms Stanford. La cause : les questions reprises d'un examen universitaire étaient versées dans la tâche `test` de la room. Correction : elles forment désormais une **réserve** (`Secura_Rooms::reserve()`) qui alimente le **réservoir** de la section ; `get_tasks()` ne rend plus que les tâches maison. **Mesures :** 0 question importée dans une tâche (contre 320), copie servie du `test` de 2 à 10 questions (max 80 avant), **réservoir Stanford inchangé à 164**, **712 questions** au total, manque de réservoir **25**, examens déverrouillés **46/52** (contre 26/52). Le moteur de progression n'est pas touché. **Trois garde-fous** ajoutés à l'auditeur « épreuves » et **six tests de non-régression** dans `tests/smoke-test.php` (331 tests, 0 échec) : la mutation (remettre l'ancien comportement de fusion) fait bien tomber les contrôles. Le test A/B du panel des élèves en local donne le même résultat avant et après : les constats locaux restants sont des constats d'environnement, l'arbitre reste GitHub en conteneurs. |
| 03/11/2026 (v0.11.5, le format « blanc à remplir ») | v0.11.5 | **La récolte continue, et l'on refuse ce qui n'est pas vérifiable.** Les quiz du MIT 6.004 (Computation Structures, Spring 2009, **CC BY-NC-SA 4.0**) demandent à l'élève d'écrire sa réponse dans un blanc ; le corrigé officiel imprime la bonne réponse juste au-dessus du blanc. Un quatrième extracteur a été écrit pour ce format : il **vérifie l'appariement** (le libellé du blanc doit être le même dans l'énoncé et dans le corrigé — pas de simple appariement par ordre) et n'accepte que les réponses **imprimées dans la colonne de droite**, seule sur sa ligne. Résultat : **5 questions retenues sur 65**, 60 refusées. Sont refusés, et c'est voulu : les options circulées (le corrigé les met en gras — `pdftotext` ne voit pas le gras, la réponse serait devinée), les réponses réparties sur deux lignes, les réponses mêlées à l'énoncé sur la même ligne, et les questions qui dépendent d'un schéma ou d'un tableau absent. Le même extracteur passe sur le MIT 6.035 (un seul quiz) : **0 question retenue**, donc rien n'est importé — la banque passe de 712 à **717 questions**. |
| 03/11/2026 (v0.11.6, le format « énoncé répété ») | v0.11.6 | **La récolte devient systématique, et elle dit ce qu'elle refuse.** Les mini-quiz du MIT 6.189 (Multicore Programming Primer, janvier 2007, **CC BY-NC-SA 4.0**) sont corrigés par le MIT en **répétant l'énoncé** avant de répondre. Un cinquième extracteur retrouve l'énoncé dans le corrigé **mot pour mot** (chaque mot échappé, les espaces tolérés car la ligne peut être coupée autrement) et ne retient que le texte qui suit : l'appariement est **vérifié**, jamais supposé par l'ordre. **3 questions retenues sur 6** (verrouillage mortel, conditions de concurrence, mur de mémoire) ; refusées : l'une repose sur du code, l'autre sur des schémas, la troisième répète l'énoncé avec un mot différent. La banque passe de 717 à **720 questions**, le manque de réservoir tombe de 25 à **22**, et 0 question importée ne se glisse dans une tâche. `docs/PLAN-RECOLTE.md` consigne la méthode (sitemap → pages d'examen → fichiers de corrigé → analyse de format) et l'inventaire des **23 cours MIT porteurs de corrigés** : pour chacun, ce qui est importable et ce qui est refusé, avec le motif — dont trois refus de principe : PDF sans couche texte (pas d'OCR, donc pas d'invention), réponses en art ASCII ou en schémas, et formules déformées par l'extraction. |
| 03/11/2026 (v0.11.7, le format « titre + items numérotés ») | v0.11.7 | **Le sixième format est couvert, et le piège du MIT est désamorcé.** Les quiz du MIT 6.006 (Introduction to Algorithms, Spring 2008, **CC BY-NC-SA 4.0**) présentent chaque problème par un titre, un préambule, puis des items numérotés ; le corrigé officiel pose un repère « Solution: » après chacun. L'extracteur apparie les problèmes **puis** les items, par ordre — mais **chaque appariement est vérifié** : même titre, mêmes premiers mots, et surtout **le même nombre d'items des deux côtés**. Ce dernier point est la garde-fou qui désamorce le piège du MIT 6.046J SMA-5503, dont le corrigé omet une sous-question : sans ce contrôle, l'item « Randomized quicksort » aurait reçu la réponse de « Strassen's algorithm ». **15 questions retenues**, 20 refusées et **dites** : réponses déformées par l'extraction (le caractère de remplacement), items qui dépendent d'un schéma absent, appariements qui ne correspondent pas, réponses trop courtes pour qu'on en apprenne quelque chose. Les items vrai/faux gardent les deux propositions du corrigé (**True / False** — les mots du MIT, pas une traduction) et la justification du MIT devient l'explication. La banque passe de 720 à **735 questions**, et 0 question importée ne se glisse dans une tâche. |
| 03/11/2026 (v0.11.8, le faux négatif de diagnostic) | v0.11.8 | **Un diagnostic se vérifie contre une seconde mesure.** Quatre cours avaient été déclarés « PDF scannés » : le diagnostic comptait les caractères **après** l'en-tête OCW du PDF — or cet en-tête se trouve à la **fin** du fichier, il ne restait donc que deux caractères à compter. Le faux négatif est corrigé dans le plan de récolte, et les cours ont été réexaminés : **MIT 6.046J Spring 2012 (56 questions)**, **MIT 6.006 Fall 2011 (57)**, **MIT 6.005 Software Construction (2, avec un septième extracteur)** et MIT 6.01SC sont lisibles. Le septième extracteur garde les **options d'origine avec leur lettre** — la correction officielle du MIT parle de la lettre (« Solution. C. »), donc la lettre doit rester visible — et **refuse** toute question dont le corrigé nomme plusieurs bonnes réponses : la plateforme n'a qu'une seule bonne réponse, en garder une parmi plusieurs en inventerait une. La banque passe de 735 à **850 questions**, le manque de réservoir de 22 à **20**, et 0 question importée ne se glisse dans une tâche. |
| 03/11/2026 (v0.11.9, les formats « parties » et Stanford) | v0.11.9 | **Deux extracteurs de plus, et une décision de fond : une question à plusieurs bonnes réponses n'est pas une réécriture.** Un **huitième extracteur** couvre les parties numérotées avec les réponses en ligne (MIT **18.404J** : 20 questions) et les énoncés numérotés avec leur corrigé (MIT **6.851** : 12 questions). Un **neuvième extracteur** couvre le format Stanford : le midterm du **CS230** apporte **8 questions**. Garde-fous : une correction qui commence par une minuscule est un fragment de mise en page (refusée) ; la correction d'une partie s'arrête à la partie suivante, sinon elle montrait la réponse d'après ; l'énoncé et le corrigé sont appariés par rang, et si les comptes ne correspondent pas on refuse plutôt que d'apparier au hasard ; une partie sans « Solution: » est refusée. Le MIT **6.005** repasse de 2 à **9 questions** : une question à plusieurs bonnes réponses devient une **rédaction**, l'énoncé et les propositions restant mot pour mot — ce n'est pas une réécriture, c'est un changement de *manière de répondre*. La correction officielle d'une question rédigée peut désormais faire **30 caractères** : la réponse d'un QCM est complète même quand elle est courte (« Solution : (i), (iv). »). La banque passe de 850 à **897 questions** (392 maison + 505 en réserve), **0 question importée dans une tâche**, 52 rooms, copie servie : médiane 4 / max 10 / min 2, 46 examens déverrouillés et 6 bloqués. |
| 02/11/2026 (v0.11.0, après refus de la CI) | v0.11.0 | **La première version de v0.11.0 a été refusée par la CI** : le 18ᵉ auditeur a trouvé un constat de fond (35 questions de machine sur 81 jouées « refusées »). La cause n'était pas la plateforme mais **l'outil de mesure** : il ne savait pas répondre au nouveau type de question, et il déclarait la réussite en comparant un index de copie à un index de source — deux index sans rapport, puisque le tirage mélange les questions. Une mesure pouvait donc passer au vert **sans que le drapeau ait jamais été accepté**. Les deux défauts sont corrigés : l'auditeur répond comme un élève, et il ne déclare la réussite que si la question de drapeau elle-même a été acceptée (reconnue à son chemin, unique dans la room). |
| 02/11/2026 (v0.11.0) | v0.11.0 | **L'import d'un examen réel passe à l'échelle : 132 questions du MIT 6.858 (dont 115 problèmes d'examen rédigés avec la correction officielle), nouveau type de question « solution », deux sources trouvées et refusées avec preuve automatique (PortSwigger, MIT 6.1600). Mesures : 524 questions, réservoirs de 9 à 39 (médiane 24), 636 150 892 copies possibles, examens au réservoir trop juste passés de 36 à 22. Comité : **229 contrôles, 0 bloquant, 0 majeur, 1 mineur**. |
| 02/11/2026 (v0.10.0, CI après fusion) | v0.10.0 | **Les cinq travaux GitHub sont verts** sur le code fusionné : CI, recette et compatibilité (dont Polylang, désormais épinglé), machines en vrais conteneurs (45 contrôles), audit externe des 18 auditeurs (**229 contrôles en CI**, 0 bloquant, 0 majeur, 1 mineur) et déploiement. |
| 02/11/2026 (v0.10.0, après fusion des deux travaux parallèles) | v0.10.0 | **Le travail distant et le travail local ont été fusionnés** (le distant avait une meilleure atomicité du tirage : `prochain_rang()` en base avec `LAST_INSERT_ID`, conservée). Le comité rejoué sur le code fusionné : **228 contrôles, 0 bloquant, 0 majeur, 1 mineur**. Un test de compatibilité CI a échoué pour une raison extérieure (empreinte de paquet Polylang périmée côté WordPress.org) : les plugins tiers sont désormais **épinglés** (version + SHA-256), ce qui rend la CI reproductible. |
| 02/11/2026 (v0.10.0, local + CI) | v0.10.0 | **Le panel passe à vingt élèves, le premier import d'examen arrive, et le réservoir cesse de compter les questions en double.** Trois faits mesurés. **(1) Panel à 20 profils** (décision du propriétaire) : 20/20 élèves créent un compte en une étape, se connectent et jouent ; 20/20 reçoivent des points (223 → 247 XP), deux médailles d'or, et passent de « Observateur » à « Apprenti » ; **20/20 copies d'examen distinctes, et 20/20 ensembles de questions distincts**. **(2) Premier import d'examen** : les quiz d'examen du MIT 6.858 (Fall 2014) et leurs corrigés officiels (licence CC BY-NC-SA 4.0) sont récupérés (24 PDF) ; l'extracteur en retient **17 questions sur 59 items**, avec l'explication officielle du MIT, dans le format d'origine (2 ou 3 propositions, en anglais). La source choisie en premier (PortSwigger) **ne peut pas être copiée** : elle est citée comme pratique liée, et **le refus est prouvé par un test de CI**. **(3) Le défaut trouvé en préparant l'import** : le réservoir d'un examen **comptait la même question deux fois** (la question d'entraînement et la question d'examen d'une même room) — la mesure était gonflée de moitié, et surtout **deux élèves pouvaient recevoir le même examen** (avec 7 questions distinctes et une épreuve de 3, la probabilité que 20 élèves ait des examens tous différents est de 0,4 %). Correction : le réservoir **déduplique**, et l'ensemble de questions est désormais tiré par un **compteur** (deux élèves ne peuvent pas recevoir le même ensemble tant que le réservoir le permet ; l'ordre et les chiffres restent tirés au sort, donc reproductibles). **Mesures après correction :** 409 questions (392 + 17), réservoir réel de 6 à 24 questions distinctes (médiane 17), **2 039 152** copies possibles (et non 131 millions : c'était un mirage), et **36 examens** au réservoir plus petit que cinq fois leur épreuve — le seul constat mineur du comité, mesuré room par room (`scripts/audit/probe-reservoirs.php`). Bilan du comité (18 auditeurs) : **226 contrôles, 0 bloquant, 0 majeur, 1 mineur**. |
| 02/11/2026 (v0.9.1, passage CI) | v0.9.1 | **Le même comité rejoué par GitHub, en vrais conteneurs** (passage `41374598365`, commit `a1b2954`) : WordPress installé de zéro, 6 images de machines construites, les 18 auditeurs passés au crible en 13 min 46 s. Bilan : **226 contrôles, 0 bloquant, 0 majeur, 1 mineur, 55 info**. Les 61 questions de machine y ont été **jouées et acceptées** par un serveur qui relit le fichier en root. Les rapports de ce passage (18 × 3 formats) sont conservés dans `docs/audits/` et archivés par la CI. |
| 02/11/2026 | v0.9.1 | **Le 18ᵉ auditeur : les questions de machine, jouées pour de vrai.** Le propriétaire a demandé que les 60 questions de drapeau et la question d'action soient **réellement** jouées. En cherchant pourquoi elles ne l'étaient pas, on a trouvé un défaut majeur : **le moteur d'épreuves pouvait remplacer les questions de machine par d'autres questions au tirage** — elles n'étaient donc jamais posées. Correction : une question qui demande la machine ne se tire plus au sort, elle reste toujours dans la copie de l'élève (le mélange des propositions et les chiffres qui changent sont intacts). L'auditeur joue ensuite **chaque** question : élève créé, connexion, leçon, réponses, **machine déployée**, **valeur cherchée dans la machine**, valeur soumise, **serveur qui la relit en root** — 61 questions jouées et acceptées. Quatre autres défauts trouvés au passage (le `absint(-1)`, l'ordre de déploiement, les motifs de terminal, l'emplacement des drapeaux Compose) : tous corrigés. **En parallèle, la stratégie de contenu change** : on n'écrit plus de questions, on **importe** des questions validées (universités, OWASP, NIST, examens de certification quand l'éditeur autorise), avec un catalogue de sources, un outil qui refuse tout ce qui n'y figure pas, et un encart « Sources » visible dans la room. Total : **226 contrôles, 0 bloquant, 0 majeur** |
| 01/11/2026 | v0.6.0 | Premier passage du comité externe : 8 constats, tous corrigés, **93 contrôles au vert** |
| 01/11/2026 | v0.6.0 | Audit de conformité au guide Google « réponses générées par l'IA » : 6 constats, tous corrigés (hreflang absolus, canonique par langue, données structurées, vidéo déclarée, titres de section, étapes en HTML), **108 contrôles au vert** |
| 01/11/2026 (nuit) | v0.7.0 | Second passage : **10 constats réels** trouvés en refaisant les tests à la main — maillage interne (0 room atteignable), `robots.txt` sans robots d'IA nommés, titre des pages arabes resté en français, 37 chaînes de traduction dégradées, archive d'auteur ouverte, page d'accueil en texte de démonstration, absence d'image de partage. Tous corrigés : **118 contrôles au vert** |
| 01/11/2026 (nuit, suite) | v0.7.0 | Défaut d'outillage de test, **pas** du site : les contrôles « robots.txt nomme les robots d'IA » et « llms.txt cite les rooms » échouaient en CI alors qu'ils passaient en local. Cause isolée en conteneur (PHP 8.3 reproduit l'échec, PHP 8.4 non) : le serveur PHP intégré répond 404 pour une adresse à extension, donc `/robots.txt` et `/llms.txt` n'atteignaient jamais WordPress. Un vrai hébergeur (Apache/LiteSpeed) les route vers WordPress via `.htaccess` : le site était correct. **Correction :** les workflows servent le site via `scripts/audit/router.php`, comme le faisait déjà le workflow d'audit. Vérification après correction : **118 contrôles, 0 constat**, recette **34/34**, 5 workflows verts |
| 01/11/2026 (nuit, suite) | v0.8.0 | Livraison du comité des quinze : **196 contrôles, 0 constat**. Mais deux workflows GitHub sont tombés en échec, et le rejeu de la recette à la main a montré un **vrai défaut** : les onze actions AJAX avaient été renommées de `secura_` en `seca_` dans le plugin seulement — le front continuait d'appeler les anciennes. Le site était donc **cassé pour les élèves** (bouton « Déployer la machine » inerte, message d'erreur muet). Corrigé, et **deux contrôles automatiques** ajoutés pour que la cohérence des noms soit vérifiée à chaque push. Voir § 2 ter |
| 01/11/2026 (nuit, suite) | v0.8.1 | Deuxième passe de relecture : le mot « fonctionnalités » était écrit **en coréen** dans la politique de confidentialité. Invisible à l'écran ; **public via l'API REST**, qui publie le texte brut de la base. Corrigé, avec un **nouveau contrôle** qui cherche les caractères d'une écriture étrangère dans les fichiers livrés et dans les pages réellement servies. Les pages légales de la base sont désormais remises à jour à chaque version du plugin, **sans jamais écraser un texte retouché par le propriétaire**. Voir § 2 quater. Total : **199 contrôles, 0 constat** |
| 01/11/2026 (nuit, suite 2) | v0.8.2 | Le workflow « Audit externe » est tombé rouge sur un constat RGPD **bloquant** : les pages légales n'existaient pas **sur un site installé en ligne de commande**. Cause mesurée : le plugin rangeait les textes dans une **variable globale**, et WP-CLI charge WordPress **dans une portée de fonction** — une telle variable n'y existe pas. Le défaut ne vivait donc que dans un contexte (la CI), invisible pour la recette manuelle jouée sur un vrai serveur web. **Correction :** les textes passent par une fonction, qui existe partout ; **garde-fou :** l'installation est vérifiée explicitement (l'échec nomme la page absente) et **deux contrôles** interdisent le retour de la faute. Un faux positif a été corrigé au passage (apostrophe typographique échappée en `&#8217;` dans la comparaison des données structurées). Voir § 2 quinquies. Total : **200 contrôles, 0 constat** |
| 01/11/2026 (nuit, suite 5) | v0.8.4 | Question posée par le propriétaire : « as-tu fait tous les tests qu'il faut ? si on redemande aux 15 agents le même audit, qu'obtiendra-t-on ? ». **Contre-expertise des quinze scripts** : six contrôles ne regardaient qu'une room sur 52 (données structurées, onboarding, UX/UI, performance, multilingue, SEO). Tous ont été étendus à **toute la collection** — 207 contrôles au lieu de 203. **Aucun nouveau constat** : la plateforme était saine, mais on ne l'avait pas vérifié partout. **Test négatif** : une room amputée de son résumé en bac à sable est invisible pour l'ancien contrôle (« ok ») et détectée par le nouveau, qui la nomme. **Trou de la barrière** : la CI ne rougissait que sur les constats *bloquants* — le défaut `h1 → h3` (majeur) avait été livré avec une CI verte ; la barrière bloque désormais sur **majeur ou bloquant**, et un contrôle de l'auditeur « DevOps » vérifie ce comportement **en l'exécutant** (codes 0/1/1), testé dans les deux sens. **Reproductibilité** : le comité rejoué deux fois donne **15/15 rapports identiques**. Total : **207 contrôles, 0 constat** |
| 01/11/2026 (nuit, suite 4) | v0.8.3-bis | La CI a trouvé un **majeur d'accessibilité** que la recette locale ne voyait pas : un saut de titre `h1` → `h3` dans la room « Kahoot ». Deux causes : le bloc Kahoot titrait en `<h3>` alors que tous les autres blocs de room titrent en `<h2>` ; et surtout, **le contrôle d'accessibilité tirait une room au hasard** — visible en CI, invisible en local, et différent d'une exécution à l'autre. **Correction :** bloc Kahoot en `<h2>` (rendu inchangé, le style est porté par la classe) ; l'audit vérifie désormais **les 53 pages** (accueil + 52 rooms) ; l'auditeur « SEO » vérifie le titre de **chaque** room sur la page servie. **Garde-fou :** le défaut a été **remis volontairement** dans le code pour prouver que l'audit le détecte (il nomme la room), puis retiré — un garde-fou testé dans les deux sens. Total : **203 contrôles, 0 constat** |
| 01/11/2026 (nuit, suite 3) | v0.8.3 | La CI a signalé un « majeur » multilingue : des propriétés physiques dans la feuille arabe. En cherchant, on a trouvé un **vrai défaut invisible** : le thème déclarait sa feuille arabe avec un **chemin de fichier** au lieu d'une **adresse**, donc le navigateur demandait une URL qui n'existait pas (404) — **la mise en page arabe n'était jamais appliquée**. Le constat, lui, était un **faux positif** : le contrôle mesurait la page 404 (qui contient le CSS de WordPress), pas une feuille de style. **Correction :** adresse correcte, et feuille arabe chargée dès que le visiteur lit en arabe, même sur un site en français ; version du thème cohérente. **Garde-fous :** un contrôle **bloquant** vérifie désormais que toutes les feuilles de style d'une page se chargent (HTTP 200), dans les trois langues ; et le contrôle ne mesure plus une page d'erreur comme si c'était une feuille de style. Un faux positif de l'auditeur « SEO » est corrigé au passage (apostrophes non normalisés). Total : **202 contrôles, 0 constat** |
| 04/11/2026 (v0.12.2, le criblage valide de bout en bout) | v0.12.2 | **Les six robots et leur fusion sont verts sur GitHub, et la recolte est archivee.** Premier run des six robots : les **six** robots verts, la **fusion rouge** — GitHub range chaque artefact dans `rapports/rapport-robot-N/rapport-N.json`, la fusion cherchait `rapports/rapport-*.json` et recevait le **motif litteral** (Python n'etend pas un motif globa par lui-meme). Corrige et teste dans les deux sens (avant : echec reproduit ; apres : les six vrais rapports fusionnent). Run final **`41753782904` = `completed success`** : **430 cours analyses, 66 avec corrige + licence CC**, identique au mesure local. Le rapport fusionne est **versionne** (`docs/recolte/criblage-ocw-2026-11-04.json`) : **55 numeros de cours jamais vus** y attendent leur extracteur. Validation des autres workflows sur le meme commit (`a64b82b`) : CI verte, Deploiement vert, audit externe **236 controles / 0 bloquant / 0 majeur / 0 constat non etaye** (run `41754178060`, artefact `13287672867`, 18 auditeurs ; identique au run `41751322860`). |
| 04/11/2026 (v0.12.1, les faux positifs corriges) | v0.12.1 | **Trois des quatre constats du comite venaient de l'auditeur, pas de la plateforme.** Le typos de variable qui signalait **536 questions « solution »** a tort (il mesurait `$explanation` au lieu de `$explication`, donc `strlen(null)` valait 0) ; la regle des questions importees contredisait son propre libelle en refusant les **4 propositions** du Stanford CS224N ; et l'auditeur « licences » cherchait l'attribution dans le texte visible, alors qu'elle est servie dans les **donnees structurees**. Le seul vrai defaut etait le manque d'indice des **20 questions du quiz MIT 6.172** — corrige a la source (extracteur et lot). Les **deux workflows** (`criblage-ocw.yml`, `recuperation-sources.yml`) ont recu `permissions: contents: read` et `timeout-minutes`. Un defaut de transparence est corrige au passage : un constat rejete pour absence de preuve s'affichait « BLOQUANT » en majuscules alors que le harnais le rejete ; il s'affiche desormais **[NON ETAYE]**, et les controles de contenu recoivent la mesure reelle en preuve. Mesure : **18 auditeurs, 0 bloquant, 0 avertissement PHP** (l'auditeur « accessibilite », qui plantait sur une variable mal orthographiee, tourne enfin). |
| 03/11/2026 (v0.12.0, le moteur et les six robots) | v0.12.0 | **Le sitemap n'est pas un moteur : c'est une boussole. Le moteur, c'est le criblage.** `tools/criblage-ocw.py` fait la seconde moitié tout seul — il lit le sitemap (2 587 cours en une requête), filtre les numéros de cours, puis pour chaque cours lit le sitemap du cours, les pages d'examen, les pages de ressources, et regarde le **nom du fichier** : c'est là, et nulle part ailleurs, que se trouve le signal du corrigé (`_sol`, `_soln`, `_solution`, `Answers`, `key`). La licence est lue dans le pied de page (`creativecommons.org/licenses/...`). Mesure réelle : **430 cours analysés en une passe**, **66 avec un corrigé ET une licence CC** (55 jamais vus), 364 sans corrigé ou sans licence exploitable — c'est du temps de calcul gagné, pas de la matière perdue. Le partage en six est réel : `--shard i/6` et le workflow `criblage-ocw.yml` (matrice à 6 robots + fusion). Téléchargement parallèle mesuré : **615 documents de 9 cours en 104 s**. Trois extracteurs de plus, avec leurs garde-fous : Stanford CS107 (41 q, appariement par (numéro de problème, lettre de partie)), Stanford CS224N (67 q : le QCM à plusieurs bonnes réponses reste une **rédaction**, l'énoncé et les propositions mot pour mot), MIT 6.867 (36 q, QCM « T/F » dont la réponse officielle est imprimée en marge à droite). La banque passe de 897 à **1 041 questions** (392 maison + 649 en réserve), **0 question importée dans une tâche**, 52 rooms, copie servie : médiane 4 / max 10 / min 2, réserve max 393, 46 examens déverrouillés et 6 bloqués. |
