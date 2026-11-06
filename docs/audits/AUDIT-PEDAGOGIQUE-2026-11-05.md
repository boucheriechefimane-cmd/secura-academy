# Audit pédagogique et technique — Secura Academy
## 52 rooms auditées une par une, 5 novembre 2026

Auditeur : rôle d'expert en cybersécurité et en conception de formations
certifiantes. Méthode : lecture du contenu réel des 52 rooms (base WordPress
du dépôt), comptage des formats de questions, inspection des images Docker,
lecture du code d'évaluation, et confrontation aux référentiels du marché
(TryHackMe, Hack The Box Academy, CompTIA, eJPT/INE, PNPT/TCM, OSCP).

---

## 1. Verdict en une phrase

**15 / 20 aujourd'hui.** Le contenu est sérieux, exact et bien structuré —
niveau « bon cours d'initiation francophone » — mais ce n'est pas encore une
formation premium : 30 rooms sur 52 se résolvent en lisant un fichier, les
drapeaux sont écrits en clair dans les livrables pour 20 d'entre eux, et
l'évaluation peut être validée sans avoir rien exploité. Correctifs listés au
§6 : la note atteint 17,5/20 sans écrire une room de plus.

| Critère | Note | Pourquoi |
| --- | --- | --- |
| Exactitude et profondeur du contenu | **4,5 / 5** | Technique juste, sourcée (MIT OCW, Stanford, OWASP), pas de simplification fausse. Quelques coquilles de rédaction. |
| Pratique réelle (mains sur clavier) | **2,5 / 5** | 17 rooms sur 52 avec une machine réellement exploitable. Les 30 autres : lecture d'un livrable + réponse. |
| Progressivité et méthode | **2,5 / 5** | Le squelette leçon → entraînement → mission → examen est bon. Mais les indices donnent presque la commande, et aucune notion n'est réévaluée à distance. |
| Évaluation et intégrité | **1,5 / 5** | Seuil 60 %, QCM, drapeaux identiques pour tous, réponses libres notées sur la longueur, correction MIT auto-validée. Un certificat décerné là-dessus ne vaut rien à l'extérieur. |
| Couverture métier / préparation certification | **2 / 5** | Solide sur web, réseau, crypto, mémoire. Absent sur Active Directory, Windows, élévation de privilèges Linux, forensique, SOC/SIEM, cloud — c'est-à-dire le cœur des certifs et des emplois junior. |
| Environnement et fiabilité | **2,5 / 5** | Le vrai Docker fonctionne (67 contrôles, isolation par apprenant vérifiée). Mais 27 rooms annoncent une cible fausse, 3 « labs » sont des copies, et l'étape de CI reste rouge. |
| **Total** | **15 / 20** | |

---

## 2. Ce que l'audit a mesuré (chiffres, pas impressions)

- **52 rooms**, **4 parcours**, **208 tâches** — toutes au même gabarit :
  1 leçon, 1 entraînement, 1 mission, 1 examen de fin de room.
- **Questions : 273 QCM, 60 drapeaux, 58 réponses libres, 1 « action »**.
  Aucune question à réponse courte vérifiée par motif, aucune soumission de
  preuve (capture, fichier, hash).
- **Terminal scripté : 6 rooms sur 52** (17 étapes au total). Ailleurs, il
  n'y a pas de terminal : l'apprenant lit, puis répond.
- **30 rooms sur 52 n'ont rien à exploiter** : la « mission » consiste à
  ouvrir un fichier lisible et recopier la valeur qui s'y trouve.
- **Drapeaux écrits en clair dans les livrables de l'élève : 20 sur 22**
  (`univ-01`) et **27 sur 27** (`dojo-01`), du type
  `zip_checks = FLAG=SECURA{validation_stricte}`. Un `grep SECURA{` résout
  la room en trois secondes.
- **Drapeaux identiques pour tous les apprenants** : ils sont figés dans
  l'image (`/root/flags/*.txt`). Un élève peut transmettre la réponse à
  toute la promotion ; rien ne le détecte.
- **Vraies failles présentes** dans `multi-01` : injection SQL réelle
  (`index.php`), XSS réfléchie réelle (`search.php`), traversée de
  répertoire réelle (`download.php`), binaire setuid réel (`bin-01`),
  pivot réseau réellement cloisonné (`net-01`), Juice Shop réel.
- **Questions importées : ~850** (MIT OCW, Stanford) chargées par le
  plugin… et **utilisées par aucune room**. Les 58 réponses libres viennent
  du contenu maison, pas de la banque importée.
- **Vérifié en conditions réelles** : 67 contrôles machines verts, 49/49
  rooms dont la machine tient son contrat, isolation de deux apprenants.

---

## 3. Audit room par room

Légende — **Pratique** : 🟩 machine réellement exploitable · 🟨 lecture
guidée dans une machine · 🟥 lecture d'un fichier / QCM seul.

### Fondations (6 rooms)

| Room | Pratique | Constat |
| --- | --- | --- |
| penser-comme-un-defenseur | 🟥 | Bonne entrée en matière (modèle de menace). Aucune machine, 10 QCM. |
| les-fondamentaux-du-reseau | 🟩 | Seule room avec une pile à 4 services et un vrai terminal. La meilleure démonstration du produit. |
| securiser-une-application-web | 🟩 | Vraie machine web, aucun drapeau : room d'observation. Correct, mais sans enjeu. |
| memoire-et-defenses | 🟩 | Binaire setuid réel. Cible cassée (corrigée pendant cet audit). |
| authentification | 🟨 | Fond solide (MFA, hachage salé, liens de réinitialisation) mais 9 questions libres notées sur la forme. |
| chiffrement-et-https | 🟨 | Idem : contenu juste, exercice absent. |

### Scénarios M3 (10 rooms) — le cœur du produit

| Room | Pratique | Constat |
| --- | --- | --- |
| le-service-qui-ne-repond-plus | 🟩 | Diagnostic d'incident, vrai serveur. Bon scénario. |
| le-mot-de-passe-oublie | 🟩 | Recherche de configuration exposée. Correct. |
| la-page-qui-se-trahit | 🟩 | XSS réfléchie réellement exploitable. |
| la-requete-qui-ne-se-fie-a-personne | 🟩 | Injection SQL réelle, avec contournement d'authentification. La meilleure room. |
| le-fichier-quon-naurait-pas-du-laisser | 🟩 | Traversée de répertoire réelle. |
| qui-a-force-la-porte | 🟩 | Analyse de journal, vraie trace. Bonne passerelle vers le métier SOC. |
| le-reseau-qui-parle-trop | 🟩 | Pile réseau, reconnaissance. |
| traverser-le-mur | 🟩 | Pivot réellement cloisonné : l'interne n'est joignable que depuis le web. Excellent. |
| le-binaire-qui-obeit-trop | 🟩 | Débordement de tampon setuid réel. Exigeant, bien construit. |
| le-certificat-qui-ne-prouve-rien | 🟩 | TLS/SNI, certificat auto-signé réel. |

**Défaut commun aux 10** : l'indice de mission donne la manipulation
(« une apostrophe ferme la chaîne… essaie un commentaire après »). C'est un
guide, pas un indice ; la difficulté s'effondre.

### Universités (22 rooms) — savoir, pas savoir-faire

| Bloc | Rooms | Pratique | Constat |
| --- | --- | --- | --- |
| Modèle de menace, débordement, architecture de confiance, bac à sable | 4 | 🟥 | Excellent contenu (6.858), mais les valeurs demandées sont imprimées en clair dans le document à lire. |
| Web, segmentation, TLS, authentification, crypto | 5 | 🟥 | Même schéma : lire puis recopier. Aucune exploitation. |
| x86, pile, canari, ROP, format string | 5 | 🟥 | Le contenu est le plus ambitieux du catalogue (ROP expliqué proprement). Mais « relève le nombre de gadgets » est une chasse au texte. |
| Mots de passe, hameçonnage, publication, 2FA | 4 | 🟥 | Public grand public, ton juste, zéro pratique. |
| OWASP Top 10, validation, journaux, machine, données | 4 | 🟥 | Bonnes fiches d'entreprise réalistes ; encore de la lecture. |

**Défaut commun** : 20 drapeaux sur 22 sont en clair dans les livrables, et
les 22 rooms annoncent une cible `http://127.0.0.1:8080` alors que l'image
`univ-01` n'a **aucun serveur web** (mesuré). La promesse « machine » n'est
pas tenue pour cette famille.

### Labs avancés (14 rooms)

| Room | Pratique | Constat |
| --- | --- | --- |
| la-boutique-en-ligne… | 🟩 | Juice Shop réel, drapeau HMAC lié au défi. Bon. |
| la-zone-administrateur… | 🟩 | Idem, défi « Admin Section ». |
| ceintures blanche → noire (5) | 🟥 | Progression par ceintures bien pensée, mais 4 drapeaux par room tous en clair dans les documents du dojo. |
| briefs 1 → 6 (6) | 🟥 | Contenu de cadrage (comment s'entraîner, lire un binaire…). Utile, sans exercice. |
| kahoot-la-revision | 🟥 | Révision par quiz. Aucune pratique. |

**Défaut commun** : 27 drapeaux sur 27 lisibles par `grep`. Le dojo est une
excellente bibliothèque d'exercices… dont toutes les réponses sont dans la
marge.

---

## 4. La méthode pédagogique, jugée

**Ce qui est bon, et rare :**
1. **Le gabarit en quatre temps** (leçon → entraînement → mission → examen)
   est le bon. Il donne un rythme et une progressivité que beaucoup de cours
   en ligne n'ont pas.
2. **Les indices progressifs et la remédiation** (« la parade : requêtes
   préparées… ») sont du vrai travail pédagogique.
3. **Les sources sont nommées et licenciées** (MIT OCW CC BY-NC-SA,
   Stanford, OWASP, renvoi assumé à la Web Security Academy de PortSwigger).
   C'est de l'honnêteté intellectuelle, et c'est un gage de sérieux.
4. **Trois langues** (français, arabe RTL, anglais). Sur le marché
   francophone et marocain, c'est un avantage réel : TryHackMe est
   exclusivement anglophone.

**Ce qui empêche le niveau premium :**
1. **L'illusion de pratique.** Un fichier qui contient
   `FLAG=SECURA{...}` n'est pas un exercice, c'est un exercice de lecture.
   Trente rooms sur 52 sont dans ce cas.
2. **Des indices qui sont des solutions.** Un apprenant qui suit l'indice
   n'apprend pas à chercher. La règle d'or : le premier indice doit orienter,
   jamais nommer l'outil ni la charge utile.
3. **Aucune réévaluation.** Une notion vue en room 3 (SQLi) n'est jamais
   retestée en room 13 sans être annoncée. Pas de répétition espacée, pas de
   « labs de révision » mêlant plusieurs failles.
4. **Pas de montée en difficulté réelle.** Toutes les rooms font 4 tâches et
   20 à 40 minutes, y compris celles qui annoncent « difficile » (ROP,
   format string) et qui, en pratique, demandent de recopier une ligne.
5. **Le terminal est un simulateur** dans 6 rooms : il renvoie des sorties
   scriptées. C'est acceptable pour un tutoriel, pas pour une formation qui
   prétend apprendre à mener une enquête.

---

## 5. L'évaluation : le point faible décisif

| Mécanisme | Réalité mesurée | Conséquence |
| --- | --- | --- |
| Seuil de réussite | 60 % (`class-secura-exam-timed.php`) | Un élève qui répond au hasard sur 5 QCM passe 1 fois sur 3. |
| Questions | 273 QCM / 60 drapeaux / 58 libres | Le QCM domine ; rien ne prouve une exécution. |
| Réponses libres (`text`) | comparées par similarité de chaîne | Orthographe notée, raisonnement ignoré. Faux négatifs fréquents. |
| Problèmes importés MIT (`solution`) | validés dès **10 caractères** saisis, puis corrigé affiché | Auto-attestation : on « réussit » un examen du MIT en tapant dix lettres. |
| Drapeaux | identiques pour tous, figés dans l'image | Partage entre élèves indétectable ; aucun lien avec l'identité. |
| Preuve de résolution | aucune (pas de capture, pas de hash, pas de fichier) | Impossible de distinguer un apprenant d'un copieur. |
| Certificat | émis par le site, sans surveillance ni vérification d'identité | Valeur externe nulle. |

C'est le point qui, à lui seul, empêche de vendre cela comme « premium » : un
acheteur sérieux (école, entreprise, OPCO) demandera ce qui empêche la
triche. Aujourd'hui, rien.

---

## 6. Feuille de route vers 17,5/20 (sans écrire une room de plus)

1. **Drapeaux par apprenant** (2 j) — le plugin tire déjà le drapeau de la
   machine : générer un drapeau unique par apprenant et par room
   (`SECURA{<room>_<hmac(user,room)>}`) au déploiement. Partage = détection.
   **Gain : +1,5 pt.**
2. **Sortir les 47 valeurs des livrables** (3 j) — remplacer
   `FLAG=SECURA{...}` par un indice à recouper (deux fichiers, un calcul, un
   `openssl`). **Gain : +1 pt.**
3. **Corriger les 27 cibles `univ-01`/`dojo-01`** (0,5 j) — soit retirer la
   cible du manifeste, soit embarquer un vrai serveur. **Gain : +0,5 pt.**
4. **Indices en trois niveaux** (2 j) — orientation, puis outil, puis
   manipulation ; le niveau 3 coûte 50 % de l'XP (le mécanisme existe déjà).
   **Gain : +0,5 pt.**
5. **Preuve de résolution obligatoire** pour les 10 missions M3 (2 j) —
   l'élève colle la sortie obtenue (empreinte, en-tête HTTP, extrait de
   journal) et le serveur la vérifie. **Gain : +1 pt.**
6. **Noter les réponses libres par mots-clés, pas par chaîne** (1 j) —
   liste de concepts attendus, score partiel. **Gain : +0,5 pt.**
7. **Relever le seuil à 75 %** et supprimer l'auto-validation des problèmes
   MIT (`solution`) tant qu'ils ne sont pas corrigés. **Gain : +0,5 pt.**
8. **Deux modules manquants** (4 sem.) — élévation de privilèges Linux
   (SUID, sudo, cron, capabilities) et Active Directory (Kerberoasting,
   délégations). Ce sont les deux compétences que réclament eJPT, PNPT et
   les postes junior. **Gain : +1 pt.**

Les trois prototypes (`web-dvwa`, `secura-lab-blue-*`,
`secura-lab-buffer-overflow`) doivent être **supprimés ou terminés** : ce sont
des copies de `multi-01`/`bin-01`, et les présenter comme des labs Blue Team
est aujourd'hui trompeur.

---

## 7. Comparaison avec TryHackMe

| Critère | Secura Academy | TryHackMe |
| --- | --- | --- |
| Volume | 52 rooms, ~25 h | 800+ rooms, 4 parcours complets |
| Langue | FR + AR + EN | anglais uniquement |
| Drapeaux | statiques, partageables | uniques par utilisateur, anti-partage |
| Machines | 17 vraies rooms pratiques, réseau isolé par apprenant | attaque réelle, VPN/attaque-box, machines dédiées |
| Parcours métier | 4 parcours thématiques, pas de parcours « SOC » ou « pentest » complet | SOC Level 1, Jr Penetration Tester, Red Teaming, Web Fundamentals, Pre Security |
| Couverture | web, réseau, crypto, mémoire, culture | + Active Directory, Windows, forensique, malware, cloud, conteneurs, phishing |
| Gamification | XP, niveaux, médailles, ceintures | XP, rangs, séries, classements |
| Communauté / recrutement | aucune | classements, employeurs, contenu gratuit massif |
| Certificat | maison, sans valeur externe | « Jr Penetration Tester » reconnu par certains employeurs |

**Traduction honnête** : Secura Academy vaut aujourd'hui **le parcours
« Pre Security » de TryHackMe** (gratuit), avec deux choses en plus — la
langue française et arabe, et un vrai scénario de pivot réseau bien construit
— et deux choses en moins — l'ampleur et l'anti-triche. Sur les rooms web
(M3 : SQLi, XSS, traversée, TLS), la qualité est **au niveau des rooms
faciles/moyennes de THM**, pas au-delà : THM va jusqu'à l'exploitation avec
outil dédié, la chaîne complète et l'énumération méthodique.

---

## 8. Est-ce que cela vaut un apprentissage premium payant ?

**Pas en l'état, mais la matière est là.** Ce qui est vendable aujourd'hui :
un **module d'initiation francophone de 20 à 30 heures**, correct, pour un
public lycée / BTS / première année, ou de la sensibilisation en entreprise.
Ce qui n'est pas vendable : une **formation certifiante**. Les trois
conditions pour y prétendre sont, dans l'ordre : drapeaux par apprenant,
preuve de résolution, et seuil à 75 %. Sans ces trois-là, aucun certificat
délivré ici ne sera repris par un employeur.

**Recommandation de parcours pour un apprenant qui vise un emploi :**
1. Utiliser Secura Academy pour les fondamentaux (web, réseau, crypto,
   mémoire), en français — c'est son point fort.
2. Enchaîner sur **TryHackMe — Pre Security puis Jr Penetration Tester**
   (pratique quotidienne, drapeaux uniques, parcours structuré).
3. Passer une certification **reconnue** : **CompTIA Security+** pour la
   théorie et le vocabulaire (très demandée au Maroc et en France), ou
   **eJPT (INE)** / **PNPT (TCM Security)** pour le pratique et le rapport.
4. Ne pas viser l'OSCP avant d'avoir fait 100+ machines HTB/THM : le fossé
   est trop grand.

Aucune room de ce catalogue ne prépare directement à l'OSCP, au PNPT ou à
l'eJPT en l'état : il manque l'énumération méthodique, l'élévation de
privilèges, Active Directory et la rédaction de rapport d'audit.
