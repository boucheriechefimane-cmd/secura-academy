# Registre des sources de contenu — licences, réutilisation, attribution

> Document de travail. Fixe **ce que nous réutilisons**, **sous quelle licence**,
> et **comment nous attribuons**. Sert de garde-fou juridique : tant qu'une
> ligne de ce registre n'est pas vérifiée, la source reste **non réutilisée**
> (lien seul).
>
> État : 31/10/2026 · HEAD `3d44950` (v0.5.0)

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
| cyber.org | conditions de réutilisation des vidéos | M3 | on garde le lien seul |
| RUB | licence des supports de cours | M3 | on garde le lien seul |
| securityeducationresourcecollection.net | nature des ressources listées | M3 | veille uniquement |
| MIT OCW | mentions obligatoires de la page de chaque cours | M3 | on applique la règle § 2 (mention type) |
| pwn.college | conditions exactes des challenges importés | M3 | on n'importe rien, on réécrit |

---

## 12. La mention type, réutilisable

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
