# Feuille de route de correction — Secura Academy
## Du 15/20 au 18/20, et de « bon cours » à « formation vendable »

Objectif : que chaque room tienne sa promesse (une compétence réellement
pratiquée), que l'évaluation résiste à la triche, et que le catalogue couvre
ce qu'exigent les certifications et les employeurs.

Chaque lot a un **critère de sortie mesurable**, vérifié par un script — pas
par une déclaration. Les scripts sont exécutés par le workflow
« Machines — mesurer sans lancer le CI ».

---

## Vue d'ensemble

| Lot | Ce qui change | Effort | Gain note | Dépend de |
| --- | --- | --- | --- | --- |
| **L1 — Anti-triche** | drapeaux uniques par apprenant, preuve de résolution | 4 j | +2,5 | — |
| **L2 — Vraie pratique** | 30 rooms transformées (fini le « grep la réponse ») | 15 j | +1,5 | L1 |
| **L3 — Machines crédibles** | cibles corrigées, prototype supprimés, bin-01 réparé | 5 j | +0,5 | — |
| **L4 — Évaluation sérieuse** | seuil 75 %, notation par concepts, fin de l'auto-validation | 3 j | +1 | L1 |
| **L5 — Couverture métier** | 2 modules neufs : Linux privesc, AD | 20 j | +1 | L3 |
| **L6 — Contenu à jour** | bibliothèque MIT réellement utilisée | 5 j | +0,5 | L4 |
| **L7 — Qualité éditoriale** | 3 langues complètes, coquilles, accessibilité | 5 j | +0,5 | — |

Total : environ **57 jours-homme** (≈ 11 semaines à une personne, 5-6
semaines à deux). L1 + L3 + L4 (12 jours) suffisent à passer de 15 à 17,5.

---

## L1 — Anti-triche (4 jours) — priorité absolue

**Problème mesuré** : 49 drapeaux figés dans les images, identiques pour tous
les apprenants ; aucune preuve de résolution ; un apprenant peut transmettre
la réponse à toute la promotion.

**Ce qu'on fait**
1. `Secura_Lab::flag_value()` rend déjà le contenu du fichier. Ajouter
   `Secura_Flags::pour( $user_id, $room_id )` : le drapeau attendu devient
   `SECURA{<room>_<8 premiers hex de hmac(user_id|room_id, secret_site)>}`.
   Le drapeau est écrit dans le fichier de la machine **au démarrage du
   conteneur** (montage `--mount` en lecture seule, ou `docker exec` juste
   après `run`), jamais dans l'image.
2. La correction compare la réponse au drapeau **calculé pour cet apprenant**,
   pas au contenu générique du fichier.
3. Ajouter un délai minimal par question (5 s) et une limite de tentatives
   (10) : le brute force devient visible.
4. Pour les 10 missions M3 : un champ « preuve » (sortie d'empreinte, en-tête
   HTTP, extrait de journal) dont le serveur vérifie la forme et la valeur.

**Critère de sortie**
- `tools/recette-apprenants/preuve-anti-triche.php` : deux apprenants
  virtuels, mêmes rooms → **drapeaux différents** (échec si identiques) ;
  réponse d'Alice refusée pour Bob (échec si acceptée).
- 0 drapeau `SECURA{...}` présent dans les images publiées (vérifié par
  `docker run --rm image sh -c 'grep -r SECURA{ / || true'`).

**Gain** : +2,5 points de la note d'évaluation.

---

## L2 — Vraie pratique : transformer 30 rooms (15 jours)

**Problème mesuré** : sur 52 rooms, 30 n'ont rien à exploiter ; 20 valeurs
sur 22 (`univ-01`) et 27 sur 27 (`dojo-01`) sont écrites en clair dans les
documents de l'élève.

**Méthode, par room — trois niveaux selon l'effort**

| Niveau | Ce qu'on fait | Rooms concernées |
| --- | --- | --- |
| **A. Reclé** (0,5 j/room) | retirer la valeur du livrable ; la faire dériver de deux fichiers à recouper (ex. `zip_checks = concat(prefixe, suffixe)` où chaque moitié est dans un fichier différent) | 20 rooms `univ-01`, 6 briefs |
| **B. Outil** (1 j/room) | la valeur n'existe qu'en exécutant une commande réelle sur la machine (`openssl x509 -fingerprint`, `strings`, `sha256sum`, `sqlite3`) | 5 ceintures, crypto, TLS |
| **C. Exploitation** (2 j/room) | la room passe en pratique réelle : la machine expose un service, l'élève doit l'exploiter | 8 rooms `univ-01` qui prétendent enseigner le ROP, le buffer overflow, le format string, la validation d'entrée |

**Ordre de priorité** (impact pédagogique / effort) :
1. Les 5 ceintures du dojo (progression par niveaux, public motivé).
2. Les 8 rooms « exploitation » d'`univ-01` : elles promettent le ROP et le
   buffer overflow et ne livrent que de la lecture — c'est le plus gros écart
   entre la promesse et le contenu.
3. Les 20 rooms de culture (`univ-01`) : niveau A suffit, mais obligatoire.

**Critère de sortie**
- Script `tools/recette-apprenants/preuve-pratique.php` : pour chaque room,
  vérifie qu'**aucun** fichier lisible par l'utilisateur 1000 ne contient le
  drapeau attendu, **et** qu'une commande listée dans `allow` permet de
  l'obtenir. Sortie : `OK` / `COQUILLE VIDE` par room. Objectif : 0 coquille.

**Gain** : +1,5 point (pratique) et c'est ce qui fait la différence avec THM.

---

## L3 — Machines crédibles (5 jours)

**Problème mesuré**
- 27 rooms `univ-01`/`dojo-01` annoncent `http://127.0.0.1:8080` alors que
  l'image n'a **aucun serveur web**.
- `web-dvwa`, `secura-lab-blue-firewall`, `secura-lab-blue-log-analysis`,
  `secura-lab-buffer-overflow` sont des **copies** annoncées comme des labs
  distincts.
- `bin-01` : le binaire segfault mais **ne peut pas mener au drapeau** —
  aucun `system("/bin/sh")`, aucun `pop rdi`, pas de `/bin/sh`, et le
  Dockerfile promet « pas d'ASLR » alors que `-no-pie` ne désactive pas
  l'ASLR (elle se contourne par `setarch -R`).

**Ce qu'on fait**
1. `univ-01`/`dojo-01` : retirer `target` du manifeste (machines de lecture)
   **ou** embarquer un vrai serveur de consultation des livrables.
2. Prototypes : soit les terminer (2 semaines), soit les supprimer. Ne pas
   les laisser dans `labs/` avec une étiquette « PROTOTYPE » que personne ne
   lit.
3. `bin-01` : ajouter un chemin d'exploitation crédible — soit un binaire qui
   appelle réellement `execve("/bin/sh")` après le débordement (le plus
   pédagogique), soit un `system("/bin/sh")` atteignable, et documenter
   l'ASLR correctement (`setarch $(uname -m) -R`).
4. Corriger le Dockerfile : retirer la mention « pas d'ASLR », expliquer
   `-no-pie` (PIE désactivé = adresses fixes **dans** le binaire).

**Critère de sortie**
- `preuve-machines.php` : 0 avertissement « cible à corriger ».
- Test d'exploitabilité `bin-01` : une charge utile fournie par le dépôt
  (`tools/recette-apprenants/exploit-bin01.py`) obtient un shell et lit le
  drapeau. S'il échoue, le lab n'est pas livrable.

**Gain** : +0,5 point (fiabilité) et la fin d'une promesse non tenue.

---

## L4 — Évaluation sérieuse (3 jours)

**Problème mesuré** : seuil 60 %, 273 QCM sur 392 questions, réponses libres
comparées par chaîne, problèmes MIT validés dès **10 caractères**, certificat
sans surveillance.

**Ce qu'on fait**
1. Seuil de réussite **75 %** pour l'examen de room, **80 %** pour le
   certificat de parcours.
2. Réponses libres : liste de concepts attendus (mots-clés normalisés,
   synonymes FR/EN), score partiel ; jamais de note sur l'orthographe.
3. Problèmes MIT (`mode = solution`) : sortir du calcul du score tant qu'ils
   ne sont pas corrigés ; les afficher comme « lecture d'examen + corrigé ».
4. QCM : 4 propositions minimum, une seule correcte, pas de « toutes les
   réponses ci-dessus », ordre mélangé.
5. Certificat : mention explicite du périmètre (« attestation de suivi ») et
   du score ; pas de logo ni de formulation suggérant une certification
   professionnelle.

**Critère de sortie** : `tests/` — un test qui soumet 10 réponses au hasard
sur un examen et vérifie l'échec ; un test qui soumet 10 caractères sur un
problème MIT et vérifie qu'aucun point n'est accordé.

**Gain** : +1 point.

---

## L5 — Couverture métier : deux modules neufs (20 jours)

**Problème mesuré** : absents — élévation de privilèges Linux, Active
Directory, forensique, SOC/SIEM. Ce sont les compétences des certifications
eJPT/PNPT et des postes junior.

**Module « Linux privesc » (10 j, 8 rooms)**
- SUID/SGID : trouver et exploiter (`find / -perm -4000`).
- `sudo -l` mal configuré (GTFOBins), capabilities (`getcap`).
- Tâches cron modifiables, services systemd faibles, PATH détourné.
- Conteneurs : échappement par socket Docker montée.
- Chaque room : machine réelle, drapeau unique, **rapport de 5 lignes**
  exigé (constat, commande, impact, remédiation).

**Module « Active Directory » (10 j, 8 rooms)**
- Énumération (BloodHound), Kerberoasting, AS-REP roasting.
- Délégations, ACL faibles, `GenericAll`, DCSync.
- Un domaine vulnérable léger (Samba AD ou GOAD réduit) plutôt qu'un AD
  Windows complet : coût d'infrastructure maîtrisé.
- Room finale : chaîne complète utilisateur → domain admin, avec rapport.

**Critère de sortie** : 16 rooms, 16 drapeaux prouvés par la preuve
room-par-room, 16 rapports vérifiés par un modèle de grille.

**Gain** : +1 point, et c'est ce qui rend le catalogue comparable à un
parcours THM « Jr Penetration Tester ».

---

## L6 — Contenu importé réellement utilisé (5 jours)

**Problème mesuré** : ~850 questions MIT/Stanford sont chargées par le plugin
et **aucune room ne les utilise** ; les 58 questions libres viennent du
contenu maison.

**Ce qu'on fait**
1. Brancher les lots importés sur les tâches `test` des rooms concernées
   (`ajoute_questions_importees` existe déjà : il faut que `type` corresponde).
2. Afficher l'attribution et la licence dans la room (le mécanisme
   `sources_importees()` existe).
3. Mode `solution` : conformément à L4, hors score, avec corrigé affiché.

**Critère de sortie** : ≥ 200 questions importées effectivement servies,
attribution visible sur la page de la room, 0 question sans licence.

**Gain** : +0,5 point (crédibilité académique).

---

## L7 — Qualité éditoriale (5 jours)

- Coquilles relevées à l'audit : « startling » (ROP), « une injection de
  script dangerous », « l'taquer », « ✕ Sharing de la cle », « jeton de
  maintenance », accents manquants par endroits.
- Trois langues : vérifier que les 52 rooms ont bien AR et EN complets
  (les traductions existent, mais le contenu des tâches importées est en
  anglais uniquement — le dire).
- Accessibilité : contrastes, navigation clavier, lecteurs d'écran sur les
  QCM.

**Critère de sortie** : `tools/audit-orthographe.py` à 0 erreur ; les trois
langues à 100 % de couverture sur le contenu maison.

**Gain** : +0,5 point.

---

## Calendrier proposé

| Semaine | Lot | Livrable vérifiable |
| --- | --- | --- |
| S1 | L1 | preuve anti-triche verte, drapeaux uniques |
| S2 | L3 | 0 cible fausse, bin-01 exploitable, prototypes tranchés |
| S2 | L4 | seuil 75 %, tests de triche |
| S3-S4 | L2 (niveaux A et B) | 30 rooms sans drapeau en clair |
| S5-S6 | L2 (niveau C) | 8 rooms d'exploitation réelles |
| S7-S8 | L5 (Linux) | 8 rooms privesc + rapports |
| S9-S10 | L5 (AD) | 8 rooms AD + domaine vulnérable |
| S11 | L6 + L7 | banque importée utilisée, 3 langues, coquilles |

À la fin de S2 (12 jours), le produit vaut **17,5/20** et peut être vendu
comme initiation sérieuse. À la fin de S10, il vaut **18/20** et devient
comparable à un parcours THM d'entrée de gamme, avec l'avantage du français
et de l'arabe.

---

## Ce qu'il ne faut PAS promettre

- Une équivalence avec l'OSCP, le PNPT ou l'eJPT : il faudra des dizaines de
  machines, du rapport professionnel et de l'AD avancé.
- Un certificat « reconnu par les employeurs » : il faut un organisme
  certificateur, une surveillance et une vérification d'identité. Le produit
  peut délivrer une **attestation de suivi honnête** en attendant.
