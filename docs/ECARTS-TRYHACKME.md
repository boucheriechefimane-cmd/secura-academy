# Les 10 écarts face à TryHackMe — et nos réponses concrètes

> Document de travail. Complète `docs/AUDIT-EXPERIENCE-APPRENANT.md` (le constat)
> et `docs/ROADMAP.md` (la constitution et l'ordre des jalons).
>
> État : 31/10/2026 · HEAD `3d44950` (v0.5.0) · 189 tests verts.

---

## 0. La règle que nous appliquons

TryHackMe est un catalogue de 853 rooms **écrites par des adultes pour des
adultes**, avec une mécanique inventée depuis 2020. Nous ne la concurrençons pas :
nous construisons un produit **différent** qui doit être **meilleur pour un apprenant
de 12 à 17 ans** et **complet pour un étudiant**.

Chaque écart est donc traité par l'une de ces cinq opérations, et **une seule** :

| Opération | Ce que ça veut dire | Exemple |
|---|---|---|
| **RATTRAPER** | On prend la mécanique, on l'adapte à notre public | Onglets multi-machines |
| **ORIGINAL** | On invente une version meilleure, pas une copie | Graphe de prérequis |
| **PAR CITATION** | On renvoie vers une source externe avec attribution | Vidéos cyber.org |
| **SUBSTITUER** | On remplace par quelque chose d'équivalent chez nous | Writeups → indice progressif |
| **REFUSER** | On ne le fait pas, et on assume | Échelle de niveaux THM |

**Interdit explicite** : copier un texte, une illustration, un composant ou
l'échelle de niveaux de TryHackMe. On reprend des mécaniques (qui ne sont pas
protégées), on écrit des contenus originaux, on nomme nos niveaux comme THM
l'a fait (noms génériques : Apprenti, Analyste, …).

**Le vrai criterion de fermeture**, pour les 10 écarts :

> L'écart est fermé quand un apprenant de 14 ans peut faire la chose **seul**,
> sans compte payant, sans forum, et sans que l'écran de la room ressemble à
> une page de manuel.

---

## 1. Vraie machine branchée aux rooms

**Ce que fait THM** : bouton « Start Machine », la room obtient une IP
`10.10.x.x` dans un VPN, la machine vit 1 h, bouton « Terminate ».

**Notre état** : le moteur `Secura_Lab` existe et fonctionne (v0.4.0) —
3 images réelles (`labs/web-01`, `labs/bin-01`, `labs/net-01`), déploiement
Docker éphémère isolé (`--cap-drop=ALL`, `--network` dédié, `--user 1000:1000`,
`--pids-limit`, `--memory`, `--cpus`, `--tmpfs /tmp:noexec`), commande exécutée
sans shell, timeout, troncature 8 Ko, liste blanche + liste de refus dur
(`nsenter`, `mount`, `sudo`, `unshare`, `kubectl`…), repli automatique sur le
terminal simulé si Docker est absent. **Mais les rooms ne sont pas branchées** :
le manifeste `_secura_lab` existe côté admin, aucune room de démonstration ne
le porte, et le nom de projet Compose est fixe (partage possible entre
apprenants).

**Solution — 3 étapes, dans cet ordre :**

1. **Branchement** : poser le manifeste sur `web-01` (room « Web : l'en-tête
   suspect ») et sur `bin-01` (room « Mémoire : le dépassement de tampon »), et
   faire pointer le badge de terminal « simulé » vers « machine réelle » dès que
   le conteneur est `running`. Coût : 1 jour.
2. **Isolation multi-apprenants** : nom de projet `seca_lab_<user_id>_<room_id>`
   au lieu du nom fixe, réseau Docker sans sortie (`internal: true`) pour
   `net-01` uniquement, `docker compose down` à l'expiration du TTL, et un
   « bouton Terminate » côté apprenant qui détruit le conteneur. Coût : 1 jour.
   *Condition de ouverture publique : ce point est bloquant (cf. `docs/labs.md` § 7).*
3. **Fallback honnête** : quand Docker est absent (mutualisé), le panneau
   affiche « machine simulée » et le contenu de la room s'adapte — on ne
   ment jamais à l'apprenant sur ce qu'il manipule.

**Critère de fermeture** : la room « Web » affiche une IP réelle, la console
répond, le flag est dans le conteneur, et un second apprenant ne voit jamais le
conteneur du premier.

**Coût total : 2 jours.** Reste le seul écart qui exige de l'infrastructure :
c'est un choix assumé — le lab réel est notre **différenciateur**, pas un
agrégat de contenu.

---

## 2. Type de question « sans réponse »

**Ce que fait THM** : « No answer needed » est un type de question officiel :
l'apprenant coche « I have completed this task ».

**Notre état** : **livré en v0.5.0** (ce document est écrit après coup).
Trois types de question coexistent désormais côté serveur et client :

| Type | Données stockées | Validation serveur |
|---|---|---|
| `text` (défaut) | liste de réponses acceptées | comparaison normalisée (existing) |
| `choice` | `choices[]` + index de la bonne réponse | la proposition choisie est comparée à la bonne |
| `action` | aucune réponse | **l'état réel du terminal** est vérifié |

Points durs résolus :
- la bonne réponse **n'est jamais envoyée au client** (`answers` et `correct`
  absents du payload AJAX) — vérifié par test ;
- une question `action` liée à un scénario terminal (`requires_step`) est
  refusée tant que l'étape n'est pas atteinte : on ne peut pas cocher une
  action qu'on n'a pas faite ;
- le contenu de démonstration utilise les trois types (room « Réseaux » :
  QCM à choix sur le rôle d'un pare-feu, question sans réponse en fin de
  pratique).

**Critère de fermeture** : atteint. Reste à étendre l'usage à toutes les rooms
lors de M3 (chaque tâche pratique finit par une `action`).

---

## 3. Volume : 6 rooms → 853

**Ce que fait THM** : 853 rooms (387 easy, 353 medium, 73 hard, 8 insane,
32 info), ≈ 130 286 points.

**Pourquoi nous ne-visons pas ce volume** : le volume de THM est le produit
d'une équipe de rédacteurs professionnels, d'un réseau d'auteurs et d'un marché
payant. Un volume artificiellement gonflé (rooms « à trous », textes recyclés)
est **plus nocif** que peu de rooms : il apprend à l'apprenant que la
plateforme est du remplissage.

**Solution — une stratégie de volume, pas un objectif de volume :**

1. **M3 : 10 rooms réelles** = 2 parcours complets (6 rooms de niveau 1 +
   4 rooms de niveau 2), chacune avec 4 tâches, un terminal, un flag et une
   explication d'erreur.
2. **Modèle « gabarit reproductible »** : chaque room suit la même ossature
   (leçon 12 min → entraînement 8 min → test pratique 15 min → examen 10 min).
   Un auteur de contenu n'a plus qu'à produire le texte et le scénario.
3. **Import pwn.college** (voir `docs/SOURCES-CONTENU.md`) : l'infrastructure
   `pwncollege/dojo` est **BSD-2-Clause**, donc réutilisable, et l'éditeur peut
   **importer les challenges dans un dojo privé**. On n'importe pas les
   énoncés : on s'en sert comme **banque de scénarios techniques** (mécaniques
   de binaire, de web, de crypto), réécrits dans nos rooms. C'est le seul moyen
   d'atteindre 50-100 rooms de qualité en les gonflant artificiellement.;
4. **Objectif public à 12 mois** : 60 rooms originales, 3 parcours, 2 niveaux
   de difficulté. **Jamais** 853.

**Critère de fermeture** : 3 parcours bouclables de bout en bout avec un
certificat, sans zone vide. Le volume exact n'est pas un critère.

---

## 4. AttackBox (bureau Linux dans le navigateur)

**Ce que fait THM** : « Start AttackBox » ouvre un bureau Kali complet dans
le navigateur (noVNC).

**Notre état** : le terminal simulé est un **scénario** (pas un shell) : il
reconnaît des motifs et renvoie des sorties écrites à la main. C'est volontaire
pour la sécurité (aucune exécution libre), mais ce n'est pas un « bureau ».

**Solution — trois niveaux, du plus simple au plus réaliste :**

1. **Niveau 1 (livré) — terminal scénarisé** : suffisant pour un cycle
   « lire → agir → observer → comprendre ». C'est le socle de nos 6 rooms.
2. **Niveau 2 (M3) — micro-machine réelle par tâche** : le conteneur est
   déjà là (§ 1) ; on lui ajoute un vrai shell (`docker exec`) pour les
   commandes d'exploration (`ls`, `cat`, `grep`, `nc`) — la liste blanche
   existe déjà dans `Secura_Lab`. L'apprenant tape de vraies commandes sur une
   vraie machine, **sans bureau**. Gain énorme de réalisme pour ~2 jours.
3. **Niveau 3 (plus tard, si infrastructure) — « AttackBox » allégé** : pas un
   bureau Linux complet (coût et surface d'attaque !) mais **un bac à sable
   interactif** : un terminal réel branché sur le réseau de la room, plus 2-3
   outils (`nmap`, `python3`, `curl`) accessibles. Un vrai bureau KALI dans le
   navigateur est **hors budget** pour une association : on ne s'y engage pas.

**Critère de fermeture** : l'apprenant tape des commandes réelles sur la
machine de la room. Le bureau graphique n'est pas requis.

---

## 5. Communauté et writeups

**Ce que fait THM** : un écosystème massif de writeups sur GitHub (des
milliers de dépôts), des forums, des Discord, des fils Reddit (ironie : les writeups
sont souvent la première source d'usage réel).

**Pourquoi on ne peut pas copier** : ce sont des contenus d'auteurs, pas les
nôtres. Et pwn.college demande explicitement de **ne pas publier de
writeups/solutions** de ses challenges.

**Solution — remplacer la fonction, pas la communauté :**

1. **Indice progressif** (déjà en place) : 3 niveaux d'indice par question,
   malus XP de −50 %. C'est le walkthrough, mais intégré et gratuit.
2. **Explication systématique** (déjà en place) : après chaque erreur, une
   explication *du pourquoi*, pas seulement *la réponse*. C'est ce que THM ne
   fait pas bien et c'est notre force.
3. **« Souvrir le walkthrough »** (M2 bis, non commencé) : à la fin d'une
   tâche ratée, l'apprenant peut déverrouiller le déroulé pas à pas, en
   perdant le bonus d'achèvement de la room. Coût : 0,5 jour.
4. **Communauté** (M6) : commentaires attachés à une question, avec
   pseudonymat + modération ; **pas** de writeups downloadable.
5. **Numérique** : chaque room publie son **empreinte pédagogique** (temps
   moyen, taux d'échec par question) — utile pour l'apprenant (« 78 % des
   apprenants se trompent ici ») et pour l'auteur. Un signal social
   honnête, inventé pour nous.

**Critère de fermeture** : l'apprenant bloqué peut avancer sans jamais quitter
la plateforme, et comprend **pourquoi** il se trompait.

---

## 6. Graphe de prérequis + récap de section

**Ce que fait THM** : 14 « learning paths » → modules → sections → rooms, avec
un **« Topic Rewind Recap »** à la fin de chaque section (le petit résumé qui
reboucle les notions).

**Notre état** : les parcours existent (`secura_path`, sections, Difficulté,
durée, XP bonus, certificat) mais **l'affichage est plat** : pas de graphe, pas
de récap.

**Solution — deux livraisons :**

1. **Récap de section (M3, 2 jours)** : à la fin d'une section, une page
   « Ce que tu sais maintenant » : 5 points essential, un mini-quiz de 3
   questions (non noté, XP 0) et le lien vers la room suivante. Le récap
   **réutilise** les questions déjà vues (mode `choice`) → 0 nouveau contenu
   pédagogique, 100 % de la valeur. Format identique à THM dans l'esprit,
   contenu original.
2. **Graphe de prérequis (M3, 2 jours)** : SVG généré côté serveur à partir
   des `requires_step` / tasks, rendu en `prerequis` d'une room : « cette room
   suppose que tu as validé X ». Le graphe est **déduit des données**, jamais
   dessiné à la main → il ne peut pas mentir.

**Critère de fermeture** : un apprenant sait **toujours** par où continuer, et
revoit les bases quand il décroche.

---

## 7. Vidéos courtes

**Ce que fait THM** : peu de vidéos ; THM mise surtout sur le texte et le
« Practical ».

**Ce qui existe ailleurs, gratuitement** : **cyber.org** (Cyber Innovation
Center) publie une série de **vidéos courtes animées** (phishing, ransomware,
mots de passe, MFA, réseaux sociaux, IoT) pour le K-12, avec un Kahoot et le
**CYBER.ORG Range**. Public 12-17 ans exactement.

**Solution :**

1. **M3 — « Le saviez-vous ? »** : dans le panneau latéral d'une room, une
   vidéo de 60-90 s liée à la notion du moment. **Règle absolue :**
   *vidéo = illustration, jamais le contenu*. Le contenu reste le nôtre (texte,
   terminal, question). La vidéo est choisie dans une source libre, avec
   attribution visible (auteur + licence + lien).
2. **M3 — alternative sans vidéo** : pour chaque notion couverte par une
   vidéo, une **animation SVG maison de 20 s** (schéma en 4 images) — coût
   faible, licence 100 % nôtre, fonctionne hors ligne, bilingue (FR/AR) — ce
   que les vidéos de cyber.org ne font pas (anglais seulement).
3. **M6 — notre propre série** : 20 capsules de 90 s, tournées en studio
   simple, sous-titrées FR/AR/EN, sur les 10 notions principales. Budget : ~1 500 € d'enregistrement + montage maison.

**Critère de fermeture** : chaque notion difficile a **une** illustration
(visuelle ou animée) de moins de 2 minutes.

---

## 8. Onglets multi-machines

**Ce que fait THM** : onglet par machine (`MACHINE_1`, `MACHINE_2`), chacun
avec sa console et son IP ; l'apprenant passe d'une machine à l'autre.

**Notre état** : une room = un terminal. `net-01` (compose) a 4 services mais
un seul panneau.

**Solution — « Cible active » (M3, 2 jours) :**

- une room peut déclarer **plusieurs cibles** dans son manifeste lab
  (`targets: [ {id, label, image, role} ]`) ;
- le panneau latéral devient un **ensemble d'onglets** (`.seca-lab-tabs`) :
  onglet par cible + onglet « Machine de l'apprenant » ;
- le terminal est **lié à la cible sélectionnée** : les réponses attendues
  changent selon la cible (ex. : le flag est dans `web-01`, pas dans `db`) ;
- l'état (running/stopped) est par onglet.

**Prérequis** : § 1 étape 2 (isolation par apprenant) — sinon deux
apprenants se volent les machines. **Ordre imposé : § 1 avant § 8.**

**Critère de fermeture** : une room à deux machines s'exploite entièrement
depuis l'interface, onglet par onglet.

---

## 9. Onboarding : e-mail, mot de passe oublié

**Ce que fait THM** : e-mail + mot de passe, réinitialisation par lien, profil
public optionnel.

**Notre état** : le plugin **ne gère aucun compte** — WordPress fait le
travail. C'est notre plus grande faiblesse *perçue* : « j'ai oublié mon mot de
passe » n'est pas traité.

**Solution — M4 (3 jours), sans réécrire WordPress :**

1. **Comptes WordPress** : l'administrateur active l'inscription libre
   (réglages → membership) : le plugin n'a rien à faire, WordPress gère
   l'e-mail de confirmation et la réinitialisation par lien. **Décision :
   on n'implémente pas notre propre système de compte** (le reinventer serait
   une faute de sécurité et de temps).
2. **Onboarding** : 3 écrans après la première connexion — (a) choisir sa
   langue (FR/AR/EN) + son pseudonyme, (b) « 3 minutes de défi » : 3
   questions d'entrée sans note, (c) première room recommandée. Coût : 1 jour.
3. **Progression** : la barre « onboarding » disparaît une fois la première
   room terminée ; le tableau de bord affiche « Reprendre où j'en étais ».
4. **Pas d'e-mail de relance** (pas de SMTP = pas d'envoi) : c'est assumé.

**Critère de fermeture** : un apprenant de 14 ans qui a oublié son mot de
passe **récupère son accès seul**, en 2 minutes, sans intervention d'un adulte.

---

## 10. Classement et « first blood »

**Ce que fait THM** : leaderboards par room, « first blood » (premier
apprenant à trouver le flag), points, niveaux (21), « completion % ».

**Notre état** : XP, 12 niveaux, médailles, `secura_ranks` (meta existe),
option `secura_first_blood` (désactivée), aucun classement.

**Solution — M6 (2 jours), dans cet ordre :**

1. **Classement de room, opt-in et pseudonyme** : tableau simple (10 premiers,
   pseudonyme + XP de la room + date). **Opt-in explicite** : un apprenant de
   14 ans ne doit pas se retrouver exposé par défaut. Affichage par défaut :
   « X apprenants ont terminé cette room ».
2. **First blood** : premier à trouver le flag → badge special, affiché sur
   la room (« première capture : il y a 12 jours »). L'option existe déjà dans
   le code ; il faut l'activer et la documenter.
3. **Jamais de classement global sur un nom réel** : pseudonyme obligatoire,
   pas d'e-mail, pas de pays.
4. **Pas de « streak » au début** : la série de jours consécutifs est
  glacial et culpabilisant ; on l'ajoute en dernier, opt-in, avec une
   notification douce.

**Critère de fermeture** : le classement ajoute du désir **sans exposer** les
apprenants mineurs.

---

## Tableau de synthèse

| # | Écart | Opération | Jalon | Coût | Risque |
|---|---|---|---|---|---|
| 1 | Machine branchée | RATTRAPER | M1 | 2 j | Infra / isolation |
| 2 | Question sans réponse | RATTRAPER | **M2 bis — livré v0.5.0** | 1 j | — |
| 3 | Volume | ORIGINAL | M3 (10 rooms) → 12 mois (60) | 3 mois | Qualité |
| 4 | AttackBox | SUBSTITUER | M3 (shell réel) | 2 j | Surface d'attaque |
| 5 | Communauté / writeups | SUBSTITUER | M2 bis (walkthrough) + M6 | 2,5 j | — |
| 6 | Graphe + récap | ORIGINAL | M3 | 4 j | — |
| 7 | Vidéos courtes | PAR CITATION | M3 (encart) + M6 (série) | 1 j + budget | Licence |
| 8 | Onglets multi-machines | RATTRAPER | M3 (après § 1) | 2 j | Isolation |
| 9 | Onboarding | SUBSTITUER | M4 | 3 j | — |
| 10 | Classement / first blood | RATTRAPER | M6 | 2 j | Protection mineurs |

**Total : ~22 jours de développement** (hors contenu), concentrés sur M1, M3 et
M4. C'est un plan réaliste : 60 % du travail est déjà fait (M1 moteur, M2 bis,
M6 fonds de XP/médailles/ranks).

---

## Ce que nous ne ferons pas (et pourquoi)

- **Pas l'échelle de 21 niveaux de THM** : 12 niveaux suffisent ; au-delà,
  l'apprenant ne perçoit plus l'écart.
- **Pas de copie de writeups** : ni les nôtres, ni ceux d'autres (pwn.college
  l'interdit explicitement pour ses challenges).
- **Pas de AttackBox = bureau Kali** : coût + surface d'attaque incompatibles
  avec une association. Un shell réel dans la room suffit.
- **Pas de contenu « payant-premium » caché** : tout est gratuit, y compris les
  niveaux universitaires (cf. `docs/CONTENU-MIT.md`).
- **Pas de room qui exige un compte payant externe** (TryHackMe subscription) :
  nos rooms doivent être jouables seules.
- **Pas de noms, logos, textes ou visuels THM** : mécanique oui, identité non.
