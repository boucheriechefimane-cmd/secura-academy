# Registre des sources de contenu — licences, réutilisation, attribution

> Document de travail. Fixe **ce que nous réutilisons**, **sous quelle licence**,
> et **comment nous attribuons**. Sert de garde-fou juridique : tant qu'une
> ligne de ce registre n'est pas vérifiée, la source reste **non réutilisée**
> (lien seul).
>
> État : 01/11/2026 · HEAD `ba403c1` (v0.5.6) → bloc U en cours (v0.6.0)

---

## 0. Règles générales (valables pour toutes les lignes)

1. **Gratuit ne veut pas dire libre.** Une ressource gratuite peut être
   protégée : on ne réutilise que si la **licence est vérifiée** dans ce
   registre, avec la date de vérification et l'URL exacte.
2. **Défaut : lien seul.** Si la licence est incertaine, on **cite** la source
   (« pour aller plus loin ») sans copier une ligne. C'est gratuit, légal et
   souvent suffisant.
3. **Réécriture > copie.** Nous préférons toujours réécrire un contenu avec
   nos mots, nos exemples et notre labs : le risque juridique tombe, la
   pédagogie reste.
4. **Non commercial assumé.** Notre plateforme est gratuite et le restera tant
   qu'elle est financée par des dons. Toute source sous licence NC est donc
   compatible **à condition** de ne pas monétiser le contenu plus tard.
   Une monétisation future impose de réécrire ou d'obtenir une autorisation
   écrite (cf. `docs/CONTENU-MIT.md` § 0, décision D6).
   Cette limite est désormais **machine-vérifiable** : chaque source du
   catalogue porte un champ `commercial` (vrai/faux), l'outil d'import
   refuse une source NC dès qu'on lui demande un contenu destiné à un
   service payant (`--commercial`), et l'auditeur « licences » vérifie la
   cohérence source par source à chaque push.
5. **Attribution visible.** Pour toute source réutilisée : auteur, titre,
   source, licence, lien, et mention des modifications — dans la room (encart
   « Sources ») et dans `docs/SOURCES-CONTENU.md`.
6. **ShareAlike assumé.** Les sources CC BY-SA / CC BY-NC-SA imposent que les
   **produits dérivés** restent sous la même licence. Notre contenu adapté
   sera donc marqué **CC BY-NC-SA 4.0** (cf. `docs/CONTENU-MIT.md` § 0).
7. **Interdiction pwn.college.** pwn.college demande explicitement de **ne pas
   publier de writeups ni de solutions de ses challenges**. Nous ne le
   ferons pas : les scénarios sont réécrits, pas copiés.

---

## 1. Tableau de synthèse

| Source | Type | Licence (vérifiée le) | Ce que nous en prenons | Décision |
|---|---|---|---|---|
| **MIT OCW 6.858 / 6.857** | Cours university (PDF, notes) | **CC BY-NC-SA 4.0** (31/10/2026, page « Privacy & Terms of Use ») | Plan de cours, ordre des notions, barème, bibliographie | **RÉUTILISABLE** (adaptation, attribution) |
| **MIT OCW 6.858 — quiz d'examen et corrigés officiels** | 24 PDF (12 quiz + 12 corrigés, 2009→2014) | **CC BY-NC-SA 4.0** (02/11/2026, métadonnées `ld+json` du cours) | **132 questions d'examen** : 17 à choix (QCM, vrai/faux) et **115 problèmes d'examen rédigés**, avec l'explication du corrigé officiel du MIT | **RÉUTILISABLE** (import, attribution, ShareAlike) |
| **MIT 6.1600 Foundations of Computer Security** | Quiz d'entraînement **avec corrigés officiels** (site du cours) | **Aucune licence Creative Commons** sur le site du cours (02/11/2026) | **Rien n'est copié** : la plateforme **cite** le cours et renvoie aux quiz et corrigés du MIT | **NON RÉUTILISABLE** (pas de licence) — à revoir si MIT publie sous licence CC |
| **PortSwigger Web Security Academy** | Labs et questions d'examen | Conditions d'utilisation PortSwigger (§ 7.4, 7.6, 7.7, 9.5 — lues le 02/11/2026) | **Rien n'est copié** : la plateforme **cite** la Web Security Academy comme pratique liée | **NON RÉUTILISABLE** (usage personnel seul) |
| **OWASP Cheat Sheet Series** | 138 fiches techniques | **CC BY-SA 4.0** (31/10/2026, GitHub API `license.spdx_id`) | Fiches comme **référence de rédaction** + extraits courts pour la room « Web » | **RÉUTILISABLE** (attribution + ShareAlike) |
| **pwn.college (ASU)** | Vidéos + slides + challenges | Vidéos/slides : « libres pour un usage non commercial, avec attribution » (31/10/2026) | **Scénarios techniques** (web, binaire, crypto) réécrits | **RÉUTILISABLE avec règles** (pas de writeup, attribution) |
| **pwncollege/dojo** | Infrastructure (code) | **BSD-2-Clause** (31/10/2026, GitHub API) | Moteur d'import de challenges, modèle des ceintures | **RÉUTILISABLE** (code libre, attribution) |
| **cyber.org** | Curriculums K-12 + vidéos courtes | Non vérifiée | **Par citation** (encart vidéo, lien) | **LIEN SEUL** |
| **Stanford SEE** | Cours d'ingénierie | **CC BY-NC-SA 4.0** (31/10/2026, FAQ « Using SEE ») | Supports réseau (fonds, protocoles) pour le **palier 1 réseau** | **RÉUTILISABLE** (adaptation + attribution) |
| **Ruhr-Universität Bochum** | Cours « System Security », IT Security | Non vérifiée | Bibliographie seulement | **LIEN SEUL** |
| **NIST (SP 800-x)** | Guides de sécurité (gouvernement US) | **Domaine public** (travaux du gouvernement fédéral US) | Listes de contrôle, vocabulaire, références | **RÉUTILISABLE** (attribution recommandée) |
| **RFC / IETF** | Normes de protocoles | Droits IETF (reproduction limitée) | Numéros, titres, extrait court | **LIEN + citation courte** |
| **securityeducationresourcecollection.net** | Catalogue de ressources gratuites | Variable selon la ressource | Veille de sources | **LIEN SEUL** |

---

## 2. MIT OpenCourseWare — le socle du palier 3

**Référence** : <https://ocw.mit.edu/courses/6-858-computer-systems-security-fall-2014/>
et <https://ocw.mit.edu/courses/6-857-network-and-computer-security-spring-2014/>

**Licence** : CC BY-NC-SA 4.0 (page « Privacy and Terms of Use » d'OCW, vérifiée
le 31/10/2026). Obligations : attribution explicite, usage non commercial,
ShareAlike, pas d'endorsement MIT.

**Ce que nous prenons — et ce que nous ne prenons pas :**

| Nous prenons | Nous ne prenons pas |
|---|---|
| L'**ordre des notions** (24 leçons 6.858, 26 séances 6.857) | Le texte des leçons (réécriture) |
| Le **barème** (quiz 20 %, labs 35 %, projet 25 %, homework 20 %) | Les **examens**graduate |
| Les **laboratoires** comme source d'inspiration de scénarios | Les **énoncés de labs** (ils exigent 6.033) |
| La **bibliographie** (elle est déjà citée dans nos rooms) | Le positionnement « graduate » |

**Mention obligatoire dans chaque room dérivée :**

> Adapté de « Computer Systems Security » (6.858), MIT OpenCourseWare,
> CC BY-NC-SA 4.0. Modifications et exemples originaux.

**Conséquence pratique** : nos adaptations sont sous **CC BY-NC-SA 4.0**.
Le code de la plateforme reste **MIT**. Les deux cohabitent : on peut diffuser
le plugin (MIT) et le contenu adapté (CC BY-NC-SA).

### 2 bis. Le premier import : les quiz d'examen du MIT 6.858 (Fall 2014)

**Ce qui a été récupéré :** la page « Exams » du cours
(<https://ocw.mit.edu/courses/6-858-computer-systems-security-fall-2014/pages/exams/>)
publie 12 quiz (2009 → 2014) et leurs **corrigés officiels** en PDF. La
licence du cours est **CC BY-NC-SA 4.0** (vérifiée le 02/11/2026 dans les
métadonnées `ld+json` de la page) : réutilisation **non commerciale**,
avec **attribution** et **partage dans les mêmes conditions**.

**Ce qui est importé :** uniquement des questions dont la réponse **et
l'explication** figurent dans le corrigé officiel, et dont l'énoncé se
comprend seul (le code listings est inclus quand il fait partie de
l'énoncé). L'ordre des propositions est remélangé par la plateforme, mais
**le texte et les propositions d'origine sont conservés** — une question
d'examen n'est pas réécrite. Un préfixe signale à l'élève qu'il s'agit
d'une « question d'examen MIT, en anglais ».

**Ce qui n'est pas importé :** les items qui renvoient à une figure ou à
un article (« Line 4 », « the figure above », « as described in the
paper ») : hors du PDF, ils seraient incompréhensibles. Les quizzes de
2009 et 2010, qui sont des questions ouvertes, ne donnent rien à
importer tel quel.

**Le refus de PortSwigger, et pourquoi il est écrit ici :** la Web
Security Academy est gratuite et excellente, mais ses conditions
d'utilisation réservent le contenu à l'usage personnel et interdisent la
copie et la diffusion des éléments d'examen. Nous ne la copions donc
**pas** : nous la **citons** (pratique liée, dans cinq leçons), et un
test automatique vérifie qu'un lot d'import PortSwigger est refusé.

---

## 3. pwn.college (Arizona State University) — la banque de scénarios

**Référence** : <https://pwn.college/>

**Ce que le site autorise (31/10/2026) :**
- gratuité et ouverture **monde entier** ;
- les **vidéos et les slides** des conférences sont réutilisables
  « *freely for non-commercial purposes, but please provide attribution* » ;
- les **éditeurs** peuvent **importer les challenges dans un dojo privé** ;
- l'infrastructure est open source (`github.com/pwncollege/dojo`, **BSD-2-Clause**).

**Ce que le site interdit :** publier des **writeups** ou des **vidéos de
solutions** de leurs challenges.

**Ce que nous faisons concrètement :**

| Usage | Décision | Comment |
|---|---|---|
| Scénarios de labs (binaire/web/crypto/pwn) | **OUI** | On **reformule** la mécanique dans nos rooms, avec nos machines (`labs/`) |
| Vidéos/slides comme illustration | **OUI, ponctuel** | Encart « en savoir plus » avec attribution ; pas de copie de contenu |
| Modèle des ceintures (blanc → noir) | **OUI** | On le transpose en « niveaux de maîtrise » par parcours (12 niveaux déjà en place) |
| Infrastructure `dojo` | **PLUS TARD** | BSD-2 → techniquement possible ; mais réécrire notre moteur n'est pas justifié. On **s'en inspire** (modèle de données), on ne le fork pas |
| Writeups | **NON** | Interdit par la source ; et de toute façon nos rooms : l'explication d'erreur est la nôtre |

**Attribution type :**

> Scénario inspiré de pwn.college (ASU), reutilisation non commerciale avec attribution —
> <https://pwn.college/>.

**Effort** : 2 jours pour construire la « table de correspondance »
(scénario pwn.college → type de room Secura → flag → explication), à faire
dans M3.

---

## 4. OWASP Cheat Sheet Series — la référence de rédaction

**Référence** : <https://cheatsheetseries.owasp.org> ·
<https://github.com/OWASP/CheatSheetSeries>

**Licence** : **CC BY-SA 4.0** (vérifiée le 31/10/2026 via l'API GitHub :
`license.spdx_id = CC-BY-SA-4.0`). 138 fiches publiées.

**Ce que nous en prenons :**
- la **structure** d'une fiche (« dangers », « bonnes pratiques », « références ») ;
- des **extraits courts** (1-3 phrases) pour les rooms web (headers, SQLi,
  XSS, CSRF, sessions), **avec attribution** ;
- la **liste des références** comme bibliographie de room.

**Ce que nous n'en prenons pas :** le texte intégral (notre contenu est
original, dans le ton « 14 ans »).

**Attribution type :**

> D'après les OWASP Cheat Sheet Series, CC BY-SA 4.0 —
> <https://cheatsheetseries.owasp.org>.

---

## 5. Le volet réseau : combler l'absence d'équivalent MIT

**Constat** : MIT 6.857 est un cours de **cryptographie avancée**, pas de
réseaux. 6.858 ne couvre les réseaux qu'en 3 leçons sur 24. **Aucun cours MIT
ne remplace nos fondations LAN** (topologies, switch, routeur, sous-réseaux).

**Décision du 31/10/2026 (approuvée)** : on accepte du contenu réseau
provenant d'autres universités ou fondations, **y compris des contenus
« premium » dont la licence le permet**, **à condition qu'il aide le jeune à
apprendre**.

**Sources retenues pour ce volet :**

| Source | Ce qu'on prend | Licence | Statut |
|---|---|---|---|
| **MIT OCW 6.858** — leçons « Network security », « Network protocols », « SSL/HTTPS » | notions + bibliographie | CC BY-NC-SA 4.0 | **utilisable** |
| **Stanford SEE** | supports de protocoles et de réseaux | CC BY-NC-SA 4.0 | **utilisable** (adaptation + attribution) |
| **NIST** (SP 800-207 Zero Trust, SP 800-61 incident, SP 800-41 firewall) | vocabulaire, checklists | domaine public | **utilisable** |
| **pwn.college** — module réseau | scénarios (sniffing, couches) | non commercial + attribution | **utilisable avec règles** |
| **cyber.org** | capsuelles réseau K-12 + Range | non vérifiée | **lien seul** |
| **RUB** — cours « System Security » (side-channels, TPM/TEE) | bibliographie | non vérifiée | **lien seul** |
| **RFC** | titres + extraits courts | droits IETF | **citation courte** |

**Plan de contenu réseau (palier 1), en original :**

1. « Une machine, un câble, un protocole » — ce qu'il se passe vraiment
   (couche 2 → couche 4), illustration SVG maison.
2. « Adressage » — IP, MAC, sous-réseau, passerelle : le module `net-01` sert
   de lab réel (4 services, réseau Docker dédié).
3. « Qui parle à qui » — ports, sockets, `nc`, `curl` : à brancher sur le shell
   réel du lab (§ 1/§ 4 de `docs/ECARTS-TRYHACKME.md`).
4. « Le filtrage » — pare-feu, ACL, ingress/egress : notre QCM à choix existe
   déjà dans la room « Réseaux ».
5. « Ecouter sans eavesdropper » — sniffing, ARP, TLS : notions 6.858/Stanford
   SEE, citées.

**Règle de ton :** on **cite** la source sérieuse (« la version canonique de
ce mécanisme est le RFC 9293 »), on **écrit** l'explication simple, et on
**fabrique** le lab. Aucun contenu n'est dupliqué mot pour mot.

---

## 6. cyber.org — le cinéma de la plateforme

**Référence** : <https://cyber.org/>

**Ce que c'est** : le Cyber Innovation Center (soutenu par CISA) publie des
curriculums K-12 **gratuits**, le « National K-12 Cybersecurity Learning
Standards v2.0 », une série de **vidéos courtes animées** (phishing,
ransomware, mots de passe, MFA, réseaux sociaux, IoT), un Kahoot de
gamification et le **CYBER.ORG Range** (plateforme d'entraînement).

**Licence** : **non vérifiée** à ce jour → **décision : lien seul**. Nous
pouvons recommander une vidéo (encart « en savoir plus ») et l'afficher par
intégration, tant que nous n'en réécrivons pas le contenu.

> **Mise à jour 01/11/2026 (bloc U).** Quatre vidéos CYBER.ORG sont désormais
> **intégrées** dans les rooms correspondantes (hameçonnage, mots de passe,
> publication en ligne, second facteur), avec la **façade** (image + ▶, rien
> n'est chargé avant le clic), l'**attribution visible** sous la vidéo et le
> **lien vers la source** toujours présent. On ne copie pas le fichier vidéo :
> la plateforme lit le flux YouTube (`youtube-nocookie`). Le texte des rooms
> est **original** (notions réécrites avec nos exemples et notre lab), et les
> conditions d réutilisation du site CYBER.ORG restent à vérifier — d'où la
> règle : **intégration et citation seulement**, jamais de copie, jamais de
> téléchargement, jamais de modification de la vidéo.

**Pourquoi c'est précieux** : c'est **exactement** notre public (12-17 ans) et
c'est la réponse au manque « vidéos courtes » (écart n° 7). Mais : anglais
seulement, donc **inadapté à l'arabe** → d'où notre décision de fabriquer nos
propres capsules SVG bilingues (M3) et une série maison (M6).

**Vérification à faire avant réemploi** : conditions de réutilisation des
vidéos (page « Terms of Use » du site) + statut CC des supports.

---

## 7. Stanford SEE — un fonds réseau propre

**Référence** : <https://see.stanford.edu/UsingSEE>

**Licence** : **CC BY-NC-SA 4.0** (FAQ officielle : « Unless otherwise
expressly indicated, SEE content is licensed under a Creative Commons
Attribution-NonCommercial-ShareAlike (CC BY NC SA) 4.0 International License »),
vérifiée le 31/10/2026.

**Usage prévu** : support de cours de réseaux pour le **palier 1** et pour le
**palier 2** (« perfectionnement »), en adaptation courte et citée. We take
**not** the videos (heavy, English-only, huge).

---

## 8. RUB et autres universités européennes — bibliographie d'abord

**Référence** : <https://informatik.rub.de/infsec/teaching/courses/system_security/>

Cours « System Security » (side-channels, malware, ASLR/NX, TPM/TEE, sécurité
des plateformes crypto et ML), cours Bachelor/Master IT Security, cours
« Usable Security and Privacy ».

**Licence des supports** : **non vérifiée** → **lien seul**. On cite le cours
comme « approfondissement pour un étudiant » dans le palier 3, sans en
reprendre le contenu.

**Intérêt réel** : c'est la meilleure source pour les notions **absentes**
chez MIT et importantes pour nous — **capabilities**, **side-channels**,
**TPM/TEE** — listées comme manques dans `docs/AUDIT-EXPERIENCE-APPRENANT.md`.
Vérifier la licence (et l'éventuelle autorisation de l'auteur) est une action
M3.

---

## 9. NIST — le domaine public, notre filet de sécurité

Les publications du NIST (agence fédérale US) sont des **travaux du
gouvernement fédéral** : **domaine public** aux États-Unis. Utilisation,
traduction et adaptation libres, attribution recommandée.

**Ce que nous en prenons** : le **vocabulaire normatif** (confidentiality,
integrity, availability, zero trust), les **checklists** (incident response,
firewall), et les **renvois** (« la référence professionnelle sur ce point »).

**Usage prévu** : glossaire bilingue FR/AR de la plateforme + ancrage de nos
rooms « posture de sécurité » (M3).

---

## 10. RFC / IETF — citer, ne pas copier

Les RFC sont des documents normatifs. L'IETF Trustynsurpose des règles
spécifiques : reproduction intégrale interdite, extraits permis avec attribution.

**Règle** : on cite (« selon le RFC 9293, le champ TTL est décrémenté à chaque
routeur ») et on **explique** avec nos mots + nos schémas. Jamais de
reproduction de paragraphe entier.

---

## 11. Ce qui reste à vérifier (actions ouvertes)

| Source | Ce qu'il faut vérifier | Qui / quand | Impact si non vérifiable |
|---|---|---|---|
| cyber.org | conditions de réutilisation des **supports** (hors intégration) | M3/U4 | on garde l'intégration + citation, sans copie |
| RUB | licence des supports de cours | M3 | on garde le lien seul |
| securityeducationresourcecollection.net | nature des ressources listées | M3 | veille uniquement |
| MIT OCW | mentions obligatoires de la page de chaque cours | M3 | on applique la règle § 2 (mention type) |
| pwn.college | conditions exactes des challenges importés | M3 | on n'importe rien, on réécrit |

---

## 12. Les vidéos des universités — réemploi vérifié (bloc U, 01/11/2026)

Les vingt-deux rooms « Les universités » montrent chacune **une vidéo de
cours** : la version longue et officielle de la notion que la room pratique
en version courte. Le principe reste « réécriture > copie » : **on ne
télécharge pas, on ne recopie pas, on ne traduit pas la vidéo** ; on la
**intègre** (façade + `youtube-nocookie`), on **cite** l'auteur et la
licence, et on garde **le lien vers la source** visible en permanence.

### 12.1 Les six sources retenues

| Établissement | Cours / chaîne | Licence (vérifiée le 01/11/2026) | Ce que nous en prenons | Décision |
|---|---|---|---|---|
| **MIT OpenCourseWare** | 6.858 Computer Systems Security (Fall 2014) | **CC BY-NC-SA 4.0** (page « Privacy & Terms of Use ») | Les 5 vidéos de la playlist officielle (menaces, tampon, privilèges, bac à sable, web) | **INTÉGRATION + attribution** |
| **MIT OpenCourseWare** | 6.857 / 6.042 (réseau, TLS, auth, crypto) | **CC BY-NC-SA 4.0** | Les vidéos de la playlist 6.858 (support réseau) et la vidéo de cryptographie (6.042) | **INTÉGRATION + attribution** (sans annoncer « 6.857 » : le cours 6.857 n'a pas de playlist officielle) |
| **pwn.college (ASU)** | Vidéos du compte officiel | « libres pour un usage non commercial, avec attribution » | 4 vidéos de technique (mémoire, pile, ROP, format string) | **INTÉGRATION + attribution**, **aucun writeup** |
| **CYBER.ORG** | Cyber Safety Series | Intégration et citation (licence des supports non vérifiée) | 4 vidéos courtes (phishing, mots de passe, publication, MFA) | **INTÉGRATION + citation** (texte original) |
| **OWASP** | Vidéos de la fondation | **CC BY-SA 4.0** (Cheat Sheet Series) | 3 vidéos (Top 10, validation des entrées, journaux et audit) | **INTÉGRATION + attribution + ShareAlike** |
| **Stanford** | CS106A / Stanford Online | **CC BY-NC-SA 4.0** (Stanford SEE) | 2 vidéos « comment marche un ordinateur » | **INTÉGRATION + attribution** |

### 12.2 Les règles appliquées dans la plateforme

1. **Façade obligatoire** : image + bouton ▶ ; l'iframe `youtube-nocookie` n'est
   créé **qu'au clic**. Aucune vidéo ne se charge toute seule, aucune
  -autoplay-.
2. **Lien de secours** : le lien direct vers la vidéo d'origine reste
   visible (utile si l'intégration est bloquée par l'école ou le réseau).
3. **Attribution sous la vidéo** : auteur, institution, titre, licence, durée
   — dans les trois langues (français, arabe, anglais).
4. **Aucune copie** : pas de fichier vidéo téléchargé, pas de transcription
   intégrale, pas de modification de la vidéo.
5. **Pas d'endorsement** : la mention « pas d'endorsement de MIT » figure dans
   le pied de page du contenu CC.
6. **ShareAlike** : tout contenu adapté reste sous **CC BY-NC-SA 4.0**.
7. **Vérification** : chaque identifiant de vidéo est présent dans
   `tools/videos/videos-verifies.json` (contrôle oEmbed + licence notée le
   01/11/2026). Le test automatisé refuse toute room dont la vidéo n'est pas
   dans ce catalogue.

### 12.3 La mention type, pour une room de cours

```
Cette room montre une vidéo de cours de <établissement>.
Vidéo : « <titre> » — <auteur/chaîne>, <licence>.
Source : <lien direct>. Intégrée sans téléchargement.
Modifications : le texte de la room est original (exemples et lab Secura Academy).
Pas d'endorsement de l'établissement.
```

---

## 13. La mention type, réutilisable

À insérer dans la room (encart « Sources ») et dans le contenu dérivé :

```
Sources de cette room :
- Adapté de « <Titre> », <Institution>, <URL> — licence <CC BY-NC-SA 4.0 | CC BY-SA 4.0 | BSD-2-Clause | domaine public>.
- Modifications : reformulation, exemples originaux, labs Secura Academy.
```

Et en pied de page du contenu CC :

```
Contenu adapted de sources ouvertes, sous licence CC BY-NC-SA 4.0.
Partage dans les mêmes conditions. Pas d'endorsement.
```

---

## 14. « S'il n'y a pas de licence, peut-on la prendre en changeant l'ordre ou les chiffres ? »

**Non.** Et ce n'est pas une question de subtilité juridique : c'est une
règle d'import, testée automatiquement à chaque push.

| Ce qu'on fait | Ce que ça change | Verdict |
|---|---|---|
| Réordonner les questions | L'ordre ne fait pas partie de ce qui est protégé… mais le contenu, si | **Aucune licence** — la licence s'applique au contenu, pas à sa mise en forme |
| Renuméroter, reformuler, traduire | Un contenu transformé reste un **contenu dérivé** : il reste soumis à la licence d'origine | **Aucune licence** — le droit d'adaptation se négocie, il ne se crée pas |
| Mélanger les questions de plusieurs sources | On change la provenance de chaque question | **Aucune licence** — chaque question porte la licence de sa source |
| Demander une autorisation à l'éditeur | C'est la voie normale | **Oui** — et c'est ce qu'on fera si un accord avec MIT ou un autre éditeur est possible |

La preuve est un test : `tests/import-test.py` contient un lot PortSwigger
**remis dans l'autre ordre et renuméroté** (`tests/fixtures/import-portswigger-reordonne-refuse.json`).
L'import est **refusé**, et le message de refus dit pourquoi : *« une
transformation d'un contenu protégé reste un contenu protégé »*.

À noter : notre besoin pédagogique — *« jamais le même examen pour le même
niveau »* — **n'a rien à voir** avec cette question. Les variantes d'un
examen sont tirées dans le réservoir de la room (mélange des questions,
ordre des propositions, chiffres paramétriques) : nous n'avons jamais besoin
de réécrire le contenu d'autrui pour obtenir des copies différentes. C'est
prouvé par la mesure : **636 150 892 copies** possibles, sans écrire une
seule question.

---

## 15. Le site peut-il devenir payant ?

C'est la vraie question derrière « site premium de cours ». Réponse courte :
**avec le contenu actuel, non — et il faut le savoir avant de le promettre.**

| Ce qui est importé aujourd'hui | Licence | Peut aller dans un service payant ? |
|---|---|---|
| MIT OCW 6.858 — 132 questions (17 QCM + 115 problèmes d'examen + corrigés officiels) | CC BY-NC-SA 4.0 | **Non** (« NC » = non commercial) |
| MIT OCW 6.857 / 6.858 (supports) | CC BY-NC-SA 4.0 | **Non** |
| StanfordSEE — Introduction to Network Security | CC BY-NC-SA 4.0 | **Non** |
| OWASP Cheat Sheets, OWASP WSTG | CC BY-SA 4.0 | **Oui** |
| OpenLearn (The Open University) — quiz | CC BY-SA 4.0 | **Oui** |
| NIST (SP 800-x) | Domaine public (gouvernement US) | **Oui** |

Trois portes s'ouvrent pour un service payant, par ordre de simplicité :

1. **Rester gratuit** (l'état actuel) : tout le catalogue est utilisable, et
   le produit se finance autrement (partenariats, sponsoring, entreprises).
2. **N'utiliser en service payant que des sources compatibles** : OWASP
   (CC BY-SA), OpenLearn (CC BY-SA), NIST (domaine public) — et compléter avec
   des questions d'examen **achetées** à un éditeur, qui vend explicitement
   le droit de rediffusion.
3. **Obtenir une autorisation écrite** de l'éditeur — en particulier du MIT
   (6.858, 6.1600). C'est la piste la plus rentable en volume et en
   crédibilité : le MIT publie déjà les corrigés officiels ; il ne manque
   qu'un accord de réutilisation commerciale. Un message à MIT Learn /
   OpenCourseWare et aux responsables du 6.858 suffit pour ouvrir la
   discussion.

Tant que cet accord n'existe pas, l'outil d'import **refuse** tout lot
destiné à un usage payant dès que la source porte « NC » : le garde-fou
est dans le code, pas seulement dans une intention.

---

## 16. La récolte du 02/11/2026 : ce que MIT OCW donne réellement

Le site restant **gratuit pour toujours**, les licences « NC » sont
utilisables : le gisement change d'échelle. Pour ne pas chercher à la
main, la récolte est **systématique** : `tools/ocw-recensement-examens.py`
parcourt le sitemap de MIT OpenCourseWare (2 587 cours), ne garde que les
cours techniques (systèmes, réseaux, crypto, sécurité), lit la page de
chacun et note les types de ressources annoncés.

**Résultat : 26 cours techniques, dont 6 publient des examens ou des
énoncés avec corrigés.** Sur ces 6 :

| Cours | Matériel | Importé ? | Pourquoi |
|---|---|---|---|
| **6.858 Computer Systems Security** (Fall 2014) | 12 quiz + corrigés officiels | **Oui — 132 questions** | déjà en place (v0.11.0) |
| **6.828 Operating System Engineering** (Fall 2012) | 4 examens (Q08→Q11) + corrigés | **Oui — 31 questions** | chaque question vérifiée contre le corrigé |
| **14.15J Networks** (Spring 2018) | examen + corrigé | **Oui — 14 questions** | format « problème + sous-questions » : un second extracteur |
| 14.15 Networks (Spring 2022) | midterm + corrigé | **Non** | le corrigé est rédigé en prose (format différent) : l'appariement ne peut pas être vérifié, donc on ne garde rien |
| 6.824 Distributed Systems (Spring 2006) | examens | **Non** | **pas de corrigé** : on ne devine pas la réponse |
| 6.875 Cryptography & Cryptanalysis | 1 seul corrigé pour 5 devoirs | **Non** | idem |
| 6.829 Computer Networks | ps1 + corrigés | **Non** | le PDF est en PostScript à encodage cassé : le texte extrait est illisible |
| 6.5630 Advanced Topics in Cryptography | un devoir, sans corrigé | **Non** | pas de corrigé |

**La règle qui tient tout :** une question n'est importée que si **le
corrigé officiel du MIT contient la réponse**, et l'appariement
énoncé ↔ corrigé est vérifié (comparaison des premiers mots, en
ignorant la ponctuation). Sans cette vérification, on inventerait des
réponses — ce que la règle du projet interdit.

**Harvard CS50** (licence **CC BY-NC-SA 4.0**, vérifiée le 02/11/2026 sur
`cs50.harvard.edu/x/license/`) entre au catalogue, mais **rien n'en est
importé** : les énoncés sont des exercices de programmation dont les
corrigés officiels ne sont pas publiés sous une forme lisible par machine
(`cs50/problems` contient les énoncés, pas les solutions). On cite, on
n'invente pas.

**Un mot sur les symboles :** un examen de mathématiques réseau
contient des lettres grecques (lambda, Gamma) qui font partie de
l'énoncé. On ne réécrit pas un examen du MIT pour supprimer une
lambda — ce serait modifier un contenu protégé. Le contrôle automatique
qui interdit les caractères d'une écriture étrangère tolère donc **le
grec dans les seuls fichiers de questions importées**, et **partout
ailleurs** (cyrillique, han, japonais, coréen…). Des tests
automatiques le vérifient dans les deux sens : si la règle est
affaiblie ou retirée, la CI rougit.

**MIT 6.1600 / 6.5660** (le cours actuel du professeur Nickolai
Zeldovich) publient **34 quiz et 10 examens avec corrigés officiels** :
c'est le plus gros gisement qui reste, et il est **sans licence** — d'où
la demande d'autorisation (`docs/DEMANDE-AUTORISATION-MIT.md`).

## 17. Où vivent les questions importées : la réserve (03/11/2026)

Une question reprise d'un examen d'université porte trois choses : son
énoncé **mot pour mot**, la **source** (le cours, l'année, la page) et la
**licence** (CC BY-NC-SA 4.0 pour tout MIT OCW). Ce n'est pas une question
« de la plateforme » : c'est un contenu d'ailleurs, avec son auteur et sa
licence.

C'est pour cela qu'elle vit dans une **réserve** (`Secura_Rooms::reserve()`)
et **pas dans une tâche**. Le raisonnement, mesuré :

- une question importée versée dans la tâche `test` de la room **gonfle le
  point de contrôle** de l'élève : mesuré à **80 questions** à rendre sur une
  room dont l'épreuve fait 4 questions ;
- la même question, versée dans la **réserve** de la room, **alimente le
  réservoir** de la section : les copies d'examen restent donc aussi
  variées qu'avant (réservoir Stanford : 164 questions, inchangé), et le
  point de contrôle retrouve la taille de l'épreuve (2 à 10 questions).

La réserve n'est pas un dépotoir : elle est **tirée au sort comme les
autres**, avec la même déduplication, et elle est **auditée comme les
autres** (l'auditeur « contenu » vérifie sur les 320 questions importées
qu'elles portent leur licence, leur source et leur correction officielle ;
l'auditeur « épreuves » vérifie qu'aucune d'elles n'entre dans une tâche et
que la réserve alimente bien le réservoir).

Et si un jour la règle change — si l'on veut un jour servir les questions
d'université **dans** une tâche — il faudra le faire pour une raison
pédagogique explicite, pas par défaut d'architecture. Les garde-fous
existants (trois contrôles automatiques) le diront.

**La suite de la récolte (03/11/2026).** Deux cours du MIT ont été
vus après la vague 2 :

- **6.004 Computation Structures (Spring 2009)** — licence **CC BY-NC-SA
  4.0** vérifiée sur la page du cours, quatre quiz (1, 2, 3 et 5)
  publiés avec leur corrigé officiel. Le format est nouveau : l'élève
  doit **écrire sa réponse dans un blanc**, et le corrigé officiel
  imprime la bonne réponse juste au-dessus. Un quatrième extracteur a
  été écrit pour ce cas : il vérifie que le libellé du blanc est le
  même dans l'énoncé et dans le corrigé, et il n'accepte que les
  réponses **imprimées dans la colonne de droite**. **5 questions
  retenues, 60 refusées** — les options circulées (le corrigé les met
  en gras, ce que `pdftotext` ne voit pas) et les questions qui
  dépendent d'un schéma sont refusées : on ne devine jamais une
  réponse.
- **6.035 Computation Structures (Spring 2010)** — même format, un
  seul quiz : **0 question retenue**, donc rien n'est importé. Le
  corrigé y répond par une étiquette qui ne se laisse pas apparier à
  l'énoncé sans risque d'erreur.
- **6.189 Multicore Programming Primer (January IAP 2007)** — licence
  **CC BY-NC-SA 4.0** (page du cours et mention dans le PDF). Six
  mini-quiz, corrigés par le MIT **en répétant l'énoncé** avant de
  répondre. Un cinquième extracteur retrouve l'énoncé dans le corrigé
  **mot pour mot** et ne retient que le texte qui suit : l'appariement
  est vérifié, jamais supposé. **3 questions retenues sur 6** —
  verrouillage mortel, conditions de concurrence, mur de mémoire. Les
  trois autres sont refusées : l'une repose sur du code, l'autre sur
  des schémas, la troisième répète l'énoncé avec un mot différent.
- **6.006 Introduction to Algorithms (Spring 2008)** — licence
  **CC BY-NC-SA 4.0**. Deux quiz et un examen final, avec leurs
  corrigés officiels. Chaque problème est présenté par un titre, un
  préambule, puis des items numérotés ; le corrigé pose un repère
  « Solution: » après chacun. Un sixième extracteur apparie les
  problèmes puis les items — par ordre, mais **vérifiés** : même titre,
  mêmes premiers mots, **même nombre d'items des deux côtés**. C'est
  cette dernière vérification qui désamorce le piège du MIT 6.046J
  SMA-5503, dont le corrigé omet une sous-question. **15 questions
  retenues**, 20 refusées (réponses déformées par l'extraction, items
  qui dépendent d'un schéma, appariements qui ne correspondent pas).
  Les items vrai/faux gardent les deux propositions du corrigé
  (**True / False**).
- **6.046J Design and Analysis of Algorithms (Spring 2012)** — licence
  **CC BY-NC-SA 4.0**. Deux quiz, l'examen final et deux examens
  pratiques, avec leurs corrigés officiels. **56 questions** retenues.
- **6.006 Introduction to Algorithms (Fall 2011)** — licence
  **CC BY-NC-SA 4.0**. Deux quiz et l'examen final, avec leurs corrigés
  officiels. **57 questions** retenues.
- **6.005 Software Construction (Spring 2016)** — licence **CC BY-NC-SA
  4.0**. Deux quiz avec leurs corrigés, sur les spécifications, les
  tests et la revue de code. Format « choix multiples » : les options
  d'origine sont conservées **avec leur lettre**, et une question dont le
  corrigé nomme plusieurs bonnes réponses est refusée.

## Harvard, Stanford, les certifications gratuites : le bilan honnete

La regle reste la meme qu'ailleurs : **licence explicite**, **corrige officiel**,
**jamais de reecriture**. On a cherche dans les trois familles. Le resultat est
le meme partout : **rien n'est importable en l'etat**.

**Harvard.** La licence CC BY-NC-SA 4.0 est bien laite — elle est ecrite sur
la page de licence de CS50 (`cs50.harvard.edu/x/2024/license/`). Mais CS50 ne
publie **aucun corrige officiel** : les quiz sont evalues par le site lui-meme,
et les « problem sets » n'ont pas de corrigé publie. Sans reponse officielle,
la plateforme ne peut pas noter la question — et.import une question sans
reponse, ce serait l'inventer. **Refuse** (manque de corrige, pas de licence).

**Stanford.** Le materiel existe et il est de qualite : les archives du CS107
(« Practice Exam 1/2/3 : PDF | Solutions », « Extra Practice Problems :
PDF | Solutions »), les partiels et les solutions du CS230, les partiels du
CS224N — tous publies par Stanford, avec les corriges. Mais **aucune licence
explicite** n'est associee a ces pages : la regle « pas d'import sans
licence » s'applique donc, et le dossier Stanford rejoint la lettre envoyee
au MIT. (Les solutions du CS224N qu'on trouve sur Studocu sont des
televersements tiers, sans licence : refusees elles aussi.)

**Les certifications gratuites.** L'examen **Fortinet NSE 1 a 3** est bien
gratuit (0 USD) et l'IBM SkillsBuild et le Cisco Networking Basics aussi. Mais
les questions officielles vivent dans des formations proprietaires
(rien n'est publie sous une licence qui autorise la reprise), et les banques
de questions qu'on trouve sur Internet (examjungle, docsity, etc.) sont
ni officielles ni libres de droits : elles sont refusees. Le cout
d'examen reste, lui, rapporte tel quel : Security+ 439 $, OSCP ~1 500 $,
CEH ~1 000 $, eJPT ~249 $.

**Consequence.** Sous la regle actuelle, la seule famille encore exploitable est
**MIT OpenCourseWare** (CC BY-NC-SA 4.0, corriges publies). La recolte y
continue — c'est la que sont encore les volumes — et les autres familles
passent en « a traiter » : ce qu'il faut, ce n'est pas un import, c'est une
**demande de licence** aupres de chaque universite et de chaque editeur de
certification.

## Ce que la phase Harvard / Stanford a donné (03/11/2026, deuxième passage)

Le premier passage disait « rien d'importable ». La décision du propriétaire
du site est différente : **le site est gratuit et le restera, et on parle de
la source des tests et du cours**. Ces sources sont donc importées, avec
l'attribution complète affichée sous chaque question (école, cours, examen,
corrigé) — et la licence réelle de chaque source est écrite dans le
catalogue, sans arrondir.

- **Stanford CS230 (Deep Learning), midterm Winter 2021 — 8 questions.**
  Le document est public (`cs230.stanford.edu/files/cs230exam_win21_soln.pdf`)
  et contient les questions **et** leur corrigé officiel. Un neuvième
  extracteur couvre ce format. **Attention : Stanford ne publie aucune
  licence explicite sur ces pages.** L'import est fait sur décision
  éditoriale du propriétaire du site, avec attribution complète ; les
  questions et les corrections sont reprises mot pour mot.
- **Stanford CS107 (Structures de données) et CS224N (NLP)** — les
  archives du CS107 (« Practice Exam 1/2/3 : PDF | Solutions », « Extra
  Practice Problems : PDF | Solutions ») et les partiels du CS224N sont
  exactement ce qu'on cherche, corrigés compris. Mais `stanford.edu` est
  **injoignable** depuis le bac à sable de développement *et* depuis les
  runners GitHub (le proxy et le réseau des runners bloquent le domaine) ;
  seul un lecteur web exterior y arrive, par morceaux. Ce qui est
  importable ici a été importé ; le reste est **écarté faute d'accès**, et
  non faute de qualité.
- **Harvard CS50** — la licence CC BY-NC-SA 4.0 est bien écrite, mais les
  « problem sets » publiés ne contiennent **pas** les questions (ce sont des
  pages d'instructions) et il n'y a **aucun corrigé officiel** : sans
  réponse officielle, la plateforme ne peut pas noter. Rien n'est importé,
  et le motif est l'absence de corrigé, pas l'absence de licence.

**Ce que ça change.** MIT OpenCourseWare reste la source la plus simple
(licence explicite, corrigés publiés). Stanford entre dans le lot **avec**
l'attribution de la source, comme demandé. Harvard attend soit des corrigés
publiés, soit une autorisation écrite.


## 4. Ce que le moteur de criblage a trouvé (v0.12.0)

Le sitemap d'OCW donne 2 587 cours en une requête : c'est une **boussole** — elle dit
où sont les cours, pas ce qu'ils contiennent. `tools/criblage-ocw.py` fait la seconde
moitié automatiquement : pour chaque cours, il lit le sitemap du cours, puis les pages
d'examen, puis les pages de ressources, et il regarde **le nom du fichier**. C'est là,
et nulle part ailleurs, que se trouve le signal du corrigé :

| Signal dans le nom | Ce que ça veut dire |
|---|---|
| `_sol`, `_soln`, `_solution`, `_solutions` | corrigé officiel publié |
| `Answers`, `key` | corrigé ou barème |
| `exam`, `final`, `quiz`, `midterm`, `hw`, `pset` | document d'examen |

La licence, elle, est lue dans le pied de page de chaque page de cours :
`creativecommons.org/licenses/by-nc-sa/4.0` pour la quasi-totalité des cours EECS.

**Mesure réelle du premier passage** (cours 6.*, 18.*, 3.*) :

| | Nombre |
|---|---|
| Cours analysés | 430 |
| Avec un corrigé **et** une licence CC | 66 |
| Dont des cours jamais vus jusqu'ici | 55 |
| Sans corrigé, ou sans licence exploitable | 364 |

Le travail se partage en six (`--shard i/6`, et le workflow
`.github/workflows/criblage-ocw.yml` : matrice à six robots, puis fusion des rapports) :
six robots, chacun son sixième du catalogue. Le téléchargement est parallèle lui aussi
(`tools/telecharger-ocw.py`) : **615 documents de neuf cours en 104 secondes**.

### Les trois cours entrés avec le moteur

| Source | Licence | Questions | Ce que le moteur a vu |
|---|---|---|---|
| MIT 6.867 Machine Learning and Neural Networks | CC BY-NC-SA 4.0 | 36 | `final_f01soln.pdf`, `midterm_f02soln.pdf`… |
| Stanford CS107 Data Structures | aucune licence explicite | 41 | `Practice-Final-1-Solutions.pdf`, `final/FinalExamSolutions.pdf`… |
| Stanford CS224N Natural Language Processing | aucune licence explicite | 67 | `cs224n-midterm-2018-solution.pdf`, `cs224n-practice-midterm-3-sol.pdf`… |

Pour Stanford, l'absence de licence explicite n'est plus un motif de refus : elle est
**signalée** dans le catalogue et **sous chaque question**, avec l'attribution complète
(école, cours, examen, corrigé). C'est une décision éditoriale du propriétaire du site,
pas une permission — elle est écrite comme telle.

---

## 9. La campagne des cours prioritaires (04/11/2026)

Douze cours MIT ont été téléchargés (132 documents) et traités. **Sept ont
donné 135 questions**, avec la licence **CC BY-NC-SA 4.0 vérifiée le
04/11/2026 sur la page de chaque cours** :

| Source | Licence (vérifiée le) | Ce que nous en prenons | Décision |
|---|---|---|---|
| **MIT 6.661** Receivers, Antennas and Signals (Spring 2003) | CC BY-NC-SA 4.0 (04/11/2026) | **74 questions** d'examen + corrigé officiel | **RÉUTILISABLE** (import, attribution, ShareAlike) |
| **MIT 6.111** Introductory Digital Systems Laboratory (Spring 2006) | CC BY-NC-SA 4.0 (04/11/2026) | **22 questions** : 21 d'algèbre booléenne (énoncé et corrigé alignés ligne à ligne) + 1 de calcul | **RÉUTILISABLE** (import, attribution, ShareAlike) |
| **MIT 6.262** Discrete Stochastic Processes (Spring 2011) | CC BY-NC-SA 4.0 (04/11/2026) | **13 questions** d'examen + corrigé officiel | **RÉUTILISABLE** |
| **MIT 6.253** Convex Analysis and Optimization (Spring 2012) | CC BY-NC-SA 4.0 (04/11/2026) | **11 questions** d'examen + corrigé officiel | **RÉUTILISABLE** |
| **MIT 6.832** Underactuated Robotics (Spring 2009) | CC BY-NC-SA 4.0 (04/11/2026) | **7 questions** d'examen + corrigé officiel | **RÉUTILISABLE** |
| **MIT 6.042J / 18.062J** Mathematics for Computer Science (Fall 2010) | CC BY-NC-SA 4.0 (04/11/2026) | **5 questions** d'examen + corrigé officiel | **RÉUTILISABLE** |
| **MIT 6.450** Principles of Digital Communications I (Fall 2006) | CC BY-NC-SA 4.0 (04/11/2026) | **3 questions** d'examen + corrigé officiel | **RÉUTILISABLE** |

**Cinq cours ont été refusés**, et le motif est écrit dans
`docs/RECOLTE-OCW-2026-11.md` :

| Source | Motif du refus |
|---|---|
| MIT 6.034 Artificial Intelligence | l'énoncé renvoie à un **arbre dessiné** ; le corrigé est un **tableau** de résultats |
| MIT 6.035 Computer Language Engineering | les blocs de base sont **sur la page suivante** ; la réponse est du **code** |
| MIT 6.341 Discrete-Time Signal Processing | les cases cochées du corrigé **n'existent pas dans la couche texte** ; schémas absents |
| MIT 6.825 Numerical Computation | l'énoncé est un examen du **6.891**, le corrigé du **6.825** : deux documents différents |
| MIT 6.01SC Introduction to EECS I | les « corrigés » sont des **copies remplies d'un quiz en ligne** ; réponses en code |

Aucun de ces cinq cours n'a été complété par du contenu rédigé ou
reformulé : c'est le refus qui fait foi.

Le catalogue `tools/sources-autorisees.json` passe de **32 à 39 entrées**.

## 9 bis. La deuxième vague : vingt cours de plus (04/11/2026)

La liste de travail est le rapport de criblage produit par la CI
(`docs/recolte/criblage-ocw-2026-11-04.json`) : **430 cours analysés,
66 avec un corrigé ET une licence Creative Commons, 55 jamais vus**.
Les **44 cours restants** ont été téléchargés (**850 documents**), puis
cartographiés (`tools/carte-cours.py`) pour choisir l'extracteur.

**Vingt cours entrent** — énoncé et corrigé **officiels du MIT**, sans
réécriture. La licence **CC BY-NC-SA 4.0** est celle vérifiée par le
moteur de criblage sur la page de chaque cours (pas déduite d'un cours
voisin) ; l'attribution nomme le **cours** et la **source des tests**.

| Source | Licence (vérifiée le) | Ce que nous en prenons | Décision |
|---|---|---|---|
| **MIT 18.05** Introduction to Probability and Statistics (Spring 2022) | CC BY-NC-SA 4.0 (04/11/2026) | **427 questions** d'examen + corrigé officiel | **RÉUTILISABLE** |
| **MIT 18.600** Probability and Random Variables (Fall 2019) | CC BY-NC-SA 4.0 (04/11/2026) | **166 questions** | **RÉUTILISABLE** |
| **MIT 18.04** Complex Variables with Applications (Spring 2018) | CC BY-NC-SA 4.0 (04/11/2026) | **108 questions** | **RÉUTILISABLE** |
| **MIT 6.012** Microelectronic Devices and Circuits (Fall 2009) | CC BY-NC-SA 4.0 (04/11/2026) | **65 questions** | **RÉUTILISABLE** |
| **MIT 6.013** Electromagnetics and Applications (Spring 2009) | CC BY-NC-SA 4.0 (04/11/2026) | **51 questions** | **RÉUTILISABLE** |
| **MIT 18.440** Probability and Random Variables (Spring 2014) | CC BY-NC-SA 4.0 (04/11/2026) | **53 questions** | **RÉUTILISABLE** |
| **MIT 18.443** Statistics for Applications (Spring 2015) | CC BY-NC-SA 4.0 (04/11/2026) | **46 questions** | **RÉUTILISABLE** |
| **MIT 18.024** Multivariable Calculus with Theory (Spring 2011) | CC BY-NC-SA 4.0 (04/11/2026) | **33 questions** | **RÉUTILISABLE** |
| **MIT 18.034** Honors Differential Equations (Spring 2009) | CC BY-NC-SA 4.0 (04/11/2026) | **30 questions** | **RÉUTILISABLE** |
| **MIT 18.06** Linear Algebra (Spring 2010) | CC BY-NC-SA 4.0 (04/11/2026) | **27 questions** | **RÉUTILISABLE** |
| **MIT 6.003** Signals and Systems (Fall 2011) | CC BY-NC-SA 4.0 (04/11/2026) | **21 questions** | **RÉUTILISABLE** |
| **MIT 6.041** Probabilistic Systems Analysis (Fall 2010) | CC BY-NC-SA 4.0 (04/11/2026) | **15 questions** | **RÉUTILISABLE** |
| **MIT 18.085** Computational Science and Engineering I (Summer 2020) | CC BY-NC-SA 4.0 (04/11/2026) | **7 questions** | **RÉUTILISABLE** |
| **MIT 18.102** Introduction to Functional Analysis (Spring 2009) | CC BY-NC-SA 4.0 (04/11/2026) | **7 questions** | **RÉUTILISABLE** |
| **MIT 18.435J** Quantum Computation (Fall 2003) | CC BY-NC-SA 4.0 (04/11/2026) | **5 questions** | **RÉUTILISABLE** |
| **MIT 6.7220J** Nonlinear Optimization (Spring 2025) | CC BY-NC-SA 4.0 (04/11/2026) | **3 questions** | **RÉUTILISABLE** |
| **MIT 6.011** Introduction to Communication, Control and Signal Processing (Spring 2010) | CC BY-NC-SA 4.0 (04/11/2026) | **2 questions** | **RÉUTILISABLE** |
| **MIT 6.041SC** Probabilistic Systems Analysis (Spring 2013) | CC BY-NC-SA 4.0 (04/11/2026) | **2 questions** | **RÉUTILISABLE** |
| **MIT 6.046J** Introduction to Algorithms (SMA 5503, Fall 2005) | CC BY-NC-SA 4.0 (04/11/2026) | **2 questions** | **RÉUTILISABLE** |
| **MIT 6.973** Communication System Design (Spring 2006) | CC BY-NC-SA 4.0 (04/11/2026) | **2 questions** | **RÉUTILISABLE** |

**Dix cours sont refusés**, et le motif est écrit : ce sont des cours de
**chimie et de sciences des matériaux** (3.00, 3.012, 3.034, 3.052,
3.091SC, 3.15, 3.205, 3.21, 3.22, 3.40J). **La plateforme est une
plateforme de sécurité** : y loger un examen de chimie serait un
mensonge, même avec la meilleure licence du monde.

**Deux cours ont un format non couvert** (18.366 Random Walks and
Diffusion, 18.786 Number Theory II) : ils sont **signalés, pas
forcés** — on ne réécrit pas un document pour le faire entrer.

Le catalogue `tools/sources-autorisees.json` passe de **39 à 59
entrées**. Le bilan par cours est `docs/recolte/bilan-suite-cours.json`.

### 9.1 Deux garde-fous ajoutés après la campagne (04/11/2026)

**Le pied de page d'OCW ne doit jamais finir dans un énoncé.** Les
PDF du MIT portent un pied de page qui est un **bloc** (numéro de page,
marqueur, URL, cours, année, conditions d'utilisation), pas une ligne.
Un seul module (`tools/ocw_pieds.py`) le retire désormais, et les
extracteurs l'utilisent. La preuve que rien n'est perdu est dans
`docs/RECOLTE-OCW-2026-11.md` § 4 bis.

**Une question qui cite une source doit être jouable là où elle est
publiée.** Le plugin ignore silencieusement les questions d'une room
qu'il ne connaît pas : une room mal orthographiée dans un lot ferait
disparaître des questions sans avertissement. `tools/rooms-connues.json`
liste les 52 rooms connues ; l'import **refuse** un lot qui cite une
autre room, et nomme la room connue la plus proche.
