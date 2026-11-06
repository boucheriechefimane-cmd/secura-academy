# Où sont les gisements de contenu encore libres

Ce document répond à une question posée le 06/11/2026 : *« télécharge tous
les cours de THM et PortSwigger avec dix robots et dix IP, puis on s'en
inspire »*. La réponse courte est **non**, et ce document dit pourquoi — puis
donne la liste des gisements qui, eux, sont légaux et **déjà à moitié
exploités**.

## 1. Pourquoi pas THM ni PortSwigger

Deux raisons, dans cet ordre : juridique, puis technique.

**Juridique.** Leur contenu est propriétaire. Le récupérer en masse avec
plusieurs adresses IP pour éviter d'être ralenti n'est pas une zone grise :
c'est un contournement de limitation technique, et c'est ce qui transforme
une lecture en extraction. Le dépôt refuse déjà ce contenu à l'import, et
`docs/SOURCES-CONTENU.md` § 14 explique ce qui est libre (l'idée) et ce qui
ne l'est pas (le texte).

**Technique, et c'est le point qui compte ici.** Récupérer un corpus
propriétaire ne donne pas un cours : ça donne des phrases dont on ignore la
provenance, qu'on ne peut pas citer, qu'on ne peut pas vérifier, et dont on
hérite les erreurs. C'est exactement la chaîne qui a produit les neuf mots
français coupés en deux réparés le 06/11/2026 (voir
`docs/VERIFICATION-CONTENU.md` § 5.1) : plus personne ne savait d'où venait
la phrase.

## 2. Ce qui existe déjà — et qui marche

### 2.1 Le moissonnage par le runner GitHub

`.github/workflows/recuperation-sources.yml` fait déjà ce que les « dix
robots » devaient faire, mais proprement :

- il tourne **sur le runner GitHub**, pas sur une machine à masquer ;
- il est **manuel** (`workflow_dispatch`) : rien ne se déclenche tout seul ;
- il **télécharge des documents publiés** (PDF d'examens, pages de cours)
  et les garde en artefact, sans modifier le dépôt ;
- il cible **un site à la fois**, à une heure normale, sans parallélisme.

Un robot qui se présente sous son vrai nom est dans son droit. Dix robots
qui se cachent ne le sont plus.

### 2.2 Le résultat, mesuré

| Mesure | Valeur | Où c'est vérifiable |
|---|---|---|
| Sources au catalogue | **71** | `tools/sources-autorisees.json` |
| dont réutilisables | **62** | idem |
| dont « renvoi seulement » | **9** | idem |
| Sources déjà moissonnées | **49** | `tools/lots/*.json` |
| Questions importées et **servies aux élèves** | **1 891** | `content-import-*.php` |
| Rooms qui reçoivent ces questions | **36** sur 60 | `Secura_Rooms::reserve()` |
| Questions dans les réservoirs d'examen | **4 308** | `Secura_Exam::pool()` |

Les 1 891 questions ne dorment pas dans un dossier : elles alimentent le
réservoir des épreuves, donc les copies d'examen varient d'un élève à
l'autre. C'est `class-secura-exam.php` qui les injecte.

## 2 bis. Ce qui est déjà dans le site, et ce qui ne l'est pas

Une source peut être **moissonnée** (un lot `tools/lots/*.json` existe et a
produit des questions) ou seulement **citée** (elle sert d'autorité dans une
room, sans qu'aucune question n'en soit extraite). Les deux sont utiles, mais
ce n'est pas la même chose, et le tableau ci-dessous ne les confond pas.

Mesure du 07/11/2026 sur les cinq sources prioritaires :

| Source | Lot de questions | Rooms écrites à partir d'elle | Ce qu'elle fait réellement dans le site |
|---|---|---|---|
| `nist-publications` | **aucun** | 4 rooms (D2, D3, D4, D5) | **sourcée, non moissonnée** : SP 800-61r3, 800-53, 800-30, 800-50, 800-145, 800-161, CSF 2 cités comme autorité ; aucune question extraite |
| `owasp-cheatsheets` | **aucun** | `rooms_owasp.py` (Top 10, validation, journaux) | **room écrite, lot absent** : 3 rooms publiées, aucune des 80 fiches n'a été transformée en questions |
| `owasp-wstg` | **aucun** | 1 mention (D2) | **citation seule** : le guide sert de référence, ses cas de test ne sont pas devenus des exercices |
| `openlearn-open-university` | **aucun** | aucune | **rien** : le blocage Moodle est écrit dans le catalogue (`import manuel uniquement`) |
| `mit-ocw-6857` | **aucun** | `rooms_mit857.py` (4 rooms) | **room « réseau » publiée** (segmentation, TLS, Wi-Fi) ; les examens de 6.857 ne sont pas importés, contrairement à ceux de 6.858 |
| `atomic-red-team` | **aucun** | aucune | **rien** : les seules occurrences du mot « atomic » dans le contenu sont le mot anglais (« atomic mass », « AtomicInteger ») |

**Conclusion honnête : trois sources sur cinq sont utilisées (NIST, OWASP
Cheat Sheets, MIT 6.857), sous forme de rooms originales sourcées. Aucune
des cinq n'a produit de lot de questions. OpenLearn et atomic-red-team ne
sont pas entrées dans le site.**

C'est conforme à ce que la nature des documents permet : ni NIST, ni WSTG,
ni atomic-red-team ne sont des banques de questions. Seul OpenLearn en est
une, et c'est précisément la source bloquée.

## 3. Ce qui reste à moissonner : 13 sources

Sur 63 sources réutilisables, **49 sont faites**. Voici les 13 restantes,
et ce qu'il y a réellement à en tirer.

### 3.1 Les vraies cibles (contenu de cybersécurité)

| Source | Licence | Ce qu'il y a dedans | Effort |
|---|---|---|---|
| `nist-publications` | domaine public | référentiels, guides (SP 800-53, 800-61, 800-41) | **le meilleur rapport effort/gain** : réutilisable même commercialement |
| `owasp-cheatsheets` | CC BY-SA 4.0 | 80+ fiches de référence, structurées | moyen : texte à transformer en questions |
| `owasp-wstg` | CC BY-SA 4.0 | cas de test structurés | moyen |
| `mit-ocw-6857` | CC BY-NC-SA 4.0 | 6.857 Network and Computer Security | **fort** : c'est le cours qui manque au catalogue à côté de 6.858 |
| `openlearn-open-university` | CC BY-SA 4.0 | quiz de cybersécurité déjà en QCM | **fort** : format déjà prêt |
| `stanford-see` | CC BY-NC-SA 4.0 | introduction à la sécurité réseau | moyen |
| `harvard-cs50` | CC BY-NC-SA 4.0 | exercices avec corrigés | moyen |
| `vulhub` | MIT | machines vulnérables Docker | **fort pour la pratique**, pas pour les QCM |
| `atomic-red-team` | MIT | tests de détection (SOC) | **fort pour le D4 (forensique/SOAR)**, priorité déclarée |
| `owasp-juice-shop`, `owasp-webgoat`, `owasp-nodegoat` | MIT / Apache-2.0 | applications vulnérables | déjà utilisées par les rooms avancées |

### 3.2 Les cibles hors sujet

Une seule : `mit-ocw-6-046j-2012-examens` (algorithmes). Réutilisable, mais
hors cybersécurité — à garder pour la culture générale, pas en priorité.

## 4. Le plan qui remplace les dix robots

Par ordre de rendement, et **un seul chantier à la fois** :

1. **NIST** (domaine public, commercial OK) — les référentiels D5 gouvernance
   manquent de questions sourcées. C'est la priorité : la couverture
   Security+ est à 83 % et le D5 est le plus faible.
2. **OWASP Cheat Sheets + WSTG** (CC BY-SA) — comble le D1 (attaques) et le
   D3 (architecture).
3. **OpenLearn** — quiz déjà en QCM, donc peu de travail d'extraction.
4. **MIT 6.857** — le pendant « réseau » de 6.858, déjà présent.
5. **atomic-red-team** — D4, priorité déclarée par le propriétaire du site.

Chaque étape suit la même règle, celle qui a produit les 49 sources déjà
faites : licence vérifiée, corrigé officiel présent, format couvert par un
extracteur. Une source qui échoue à l'un des trois est refusée **et la
raison est écrite** (voir `docs/PLAN-RECOLTE.md` § 9, où 6.034, 6.047 et
6.01SC sont refusés avec leur motif).

## 5. Et pour « s'inspirer » de THM

C'est permis, et c'est même recommandé — à condition de prendre ce qui
n'est pas du texte :

- **le rythme** : une leçon courte, une pratique, un test, un examen ;
- **la progression** : un concept par room, jamais deux ;
- **la mise en situation** : une alerte qui tombe, un serveur qui répond
  mal, une conséquence visible ;
- **les objectifs d'examen** publiés par CompTIA, OffSec, l'ISC2 : documents
  publics, faits pour être travaillés.

Ce qui ne se prend pas : leurs énoncés, leurs propositions, leurs
explications, leurs captures.

Le test qui tranche, et il ne demande pas de juriste : **« est-ce que
j'aurais pu écrire cet exercice sans l'avoir lu ? »** Si oui, on écrit. Si
la phrase n'existerait pas sans la leur, on ferme la page.
