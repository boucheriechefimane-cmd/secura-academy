# Catalogue du contenu et des certifications

> **Ce que ce document est.** Il répond à une question simple que se pose
> tout élève (et tout enseignant) : *« Qu'est-ce que je vais apprendre ici,
> et à quoi ça me sert en dehors ? »*
>
> **Il ne fait pas** la promotion d'un examen en le disant « gratuit » quand
> seul le cours est gratuit. Chaque ligne distingue ce qui est gratuit de ce
> qui est payant. C'est la règle de la plateforme : un élève de 12 ans ne
> doit pas découvrir à l'examen qu'il fallait payer.
>
> **État : 01/11/2026.** Les prix et les offres bougent. Les éléments
> marqués « vérifié » l'ont été à cette date ; les autres sont signalés
> comme à confirmer.

---

## 1. La règle de lecture de ce document

Trois colonnes, trois réponses :

| Question | Colonne | Exemple |
|---|---|---|
| Peut-on s'entraîner sans payer ? | **Contenu** | MIT OCW, pwn.college, Juice Shop |
| Y a-t-il un certificat **sans payer** ? | **Certificat gratuit** | Harvard CS50, Fortinet NSE 1-3 |
| Le certificat est-il **payant** ? | **Examen payant** | Security+ 439 $, OSCP ~1 500 $ |

Une ligne « examen payant » n'est pas une mauvaise chose : c'est un examen
reconnu, qui a une valeur sur le marché du travail. Le problème n'est jamais
le prix — c'est de ne pas l'avoir dit. Ici, c'est dit.

---

## 2. Ce que la plateforme fait déjà

| Parcours | Rooms | Contenu | Certification visée | Coût de l'examen |
|---|---|---|---|---|
| **Fondations : réseaux, web et cryptographie** | 6 | Réseaux, web, chiffrement, authentification | **CompTIA Security+ (SY0-701)** | **439 $** — préparation gratuite (Professor Messer) |
| **Scénarios M3 : dix missions réelles** | 10 | Triage d'incident, injection SQL, journaux, pivot, binaires | **eJPT — Junior Penetration Tester** (eLearnSecurity) | **≈ 249 $** |
| **Les universités : 22 rooms, 6 cours** | 22 | MIT OCW, Stanford SEE, CYBER.ORG, NIST, RFC, OWASP | **Google Cybersecurity Professional Certificate** | **49 $/mois** — des vouchers gratuits existent |
| **Les labs avancés : Juice Shop, dojo, quiz** | 14 | OWASP Juice Shop, 20 défis de dojo, 6 briefs vidéo | **PortSwigger Web Security Academy → BSCP** | L'académie et les 200+ ateliers sont **gratuits** ; l'examen BSCP est payant |

**Ce que cela veut dire.** À la fin d'un parcours, l'élève a :
1. le **certificat de la plateforme**, vérifiable en ligne, gratuit ;
2. les **compétences** correspondant à une certification reconnue du monde réel ;
3. la **liste exacte** de ce qui reste à faire pour la passer.

Chaque parcours affiche cette information sur sa page, dans les trois
langues. Ce n'est pas une page « À propos » : c'est un panneau « Où ce
parcours mène », avec le coût de l'examen.

---

## 3. Le catalogue mondial : le contenu gratuit des grandes universités

### 3.1 Ce qui est réutilisé dans la plateforme aujourd'hui

| Source | Pays | Ce qu'on prend | Licence | Ce qu'on en fait |
|---|---|---|---|---|
| **MIT OpenCourseWare** (6.858 *Computer Systems Security*, 6.857) | 🇺🇸 | 9 vidéos + les feuilles de route | **CC BY-NC-SA 4.0** | 22 rooms, avec attribution visible dans chaque room |
| **pwn.college** (Arizona State University) | 🇺🇸 | Vidéos de « Talking Web », scénarios d'exploitation | Réutilisation non commerciale, avec attribution | 6 briefs, avec le drapeau lu dans la machine |
| **Stanford Engineering Everywhere** | 🇺🇸 | Cours réseau (SEE) | **CC BY-NC-SA 4.0** | 2 rooms |
| **CYBER.ORG** (Cyber Safety Series) | 🇺🇸 | 4 séries vidéo | Usage pédagogique avec attribution | 4 rooms |
| **OWASP** (Cheat Sheet Series, Top 10, Juice Shop) | 🌍 | 138 cheat sheets, l'application vulnérable | **CC BY-SA 4.0** (cheat sheets), MIT (Juice Shop) | Méthode de rédaction + machine du lab |
| **NIST / RFC / MITRE ATT&CK** | 🇺🇸 | Référentiels | Domaine public | Références citées, jamais recopiées |

> Le registre complet (13 sections, licences vérifiées et datées, décisions
> de réutilisation ou de « lien seul ») est tenu dans
> [`docs/SOURCES-CONTENU.md`](SOURCES-CONTENU.md).

### 3.2 Le reste du monde, gratuit, à explorer

Le principe de la plateforme est **« lien seul »** par défaut : on cite une
source de référence, on ne la recopie pas. Voici le catalogue de ce qui
existe, avec le statut réel de chaque ressource.

#### Universités et fondations — cours, vidéos, et parfois un certificat

| Ressource | Pays | Vidéo | Exercices | Certificat **gratuit** ? | Verdict |
|---|---|---|---|---|---|
| **MIT OpenCourseWare** | 🇺🇸 | ✅ | ✅ (problèmes + lab) | ❌ **Aucun certificat** — même gratuit | ★★★★★ |
| **Harvard CS50** (10 cours) | 🇺🇸 | ✅ | ✅ (problèmes, lab, projet) | ✅ **Oui, gratuit** si ≥ 70 %, avec URL de vérification publique | ★★★★★ |
| **Stanford SEE** | 🇺🇸 | ✅ | ✅ | ❌ Pas de certificat (CC BY-NC-SA) | ★★★★☆ |
| **pwn.college** (ASU) | 🇺🇸 | ✅ | ✅ (500+ défis) | ❌ Pas de certificat | ★★★★★ |
| **CYBER.ORG** | 🇺🇸 | ✅ | ✅ | ❌ Pas de certificat | ★★★★☆ |
| **CMU CyLab Security Academy** *(ex-picoCTF)* | 🇺🇸 | ✅ | ✅ (500+ défis) | ❌ Pas de certificat | ★★★★☆ |
| **OpenLearn** (Open University, 900+ cours) | 🇬🇧 | ✅ | ✅ | ⚠️ Certificat de participation pour certains cours | ★★★☆☆ |
| **RUB / TU Wien / autres universités européennes** | 🇪🇺 | ✅ | ✅ | ❌ Variable — vérifier au cas par cas | ★★☆☆☆ |
| **Université du Maroc (UM6P, UMFAS, ENSA…)** | 🇲🇦 | ⚠️ Partiel | ⚠️ Partiel | ❌ Pas d'offre systématique | ★★☆☆☆ |

#### Certifications et formations professionnelles gratuites

| Ressource | Domaine | Certificat **gratuit** ? | Examen |
|---|---|---|---|
| **Fortinet Training Institute** (NSE 1, 2, 3) | Réseau / pare-feu | ✅ **Oui** — NSE 1-3 sont gratuits et délivrent un badge | gratuit |
| **Cisco Networking Basics** (NetAcad) | Réseau | ✅ **Oui** — badge gratuit | gratuit |
| **freeCodeCamp** (6 certifications) | Développement, dont **Cybersecurity** | ✅ **Oui** — certificats vérifiables | gratuit |
| **IBM SkillsBuild** | Cybersécurité, IA, cloud | ✅ **Oui** — badges | gratuit |
| **HubSpot Academy** | Marketing, CRM | ✅ **Oui** — certificats | gratuit |
| **Google Skillshop** | Google Workspace, IA, sécurité | ✅ **Oui** — certificats | gratuit |
| **AttackIQ** | Évaluation de la sécurité | ✅ badge | gratuit |
| **OPSWAT ICIP**, **Qualys**, **Centri BTJA** | Sécurité réseau | ✅ badges | gratuit |
| **Microsoft Learn** (SC-900 path) | Sécurité, identité, conformité | ❌ La **formation** est gratuite, l'**examen** coûte **99–165 $** | payant |
| **Google Cybersecurity Professional Certificate** | Cybersécurité (large) | ❌ L'**audit** est gratuit, le certificat coûte **49 $/mois** ; des vouchers gratuits existent | payant |
| **PortSwigger Web Security Academy** | Attaques web (200+ ateliers) | ✅ **L'académie est gratuite** ; l'examen **BSCP** est séparé et payant | payant |
| **OWASP Juice Shop / DVWA** | applications vulnérables | ✅ Gratuit (MIT) | gratuit |
| **OverTheWire (Bandit, Natas…)** | Linux, crypto, réseau | ✅ Gratuit | gratuit |
| **CyberDefenders** | forensics, defenders CTF | ✅ Laboratoires gratuits | gratuit |
| **SANS Cyber Aces** | Introduction cyber | ✅ Gratuit | gratuit |
| **MITRE ATT&CK Training** | cadre de référence | ✅ Gratuit | gratuit |

#### ⚠️ Le piège à connaître : ISC2 CC

> L'ISC2 Certified in Cybersecurity (CC) proposait historically une
> **formation gratuite + un voucher d'examen**. **C'est fermé aux nouveaux
> candidats depuis le 20/05/2026** (le renouvellement d'un candidat existant
> reste à 50 $/an). Beaucoup de pages « gratuites » de 2025 ou de 2026
> n'ont pas été mises à jour.
>
> **À ne pas promettre.** Vérifié le 01/11/2026.

### 3.3 Le coût réel des examens visés

| Examen | Prix constaté | Remarque |
|---|---|---|
| **AWS Cloud Practitioner** (CLF-C02) | **100 $** | Très accessible comme premier certificat cloud |
| **Microsoft SC-900** | **99–165 $** | Formation gratuite sur Microsoft Learn |
| **Google Digital Leader** | **99 $** | |
| **CompTIA Security+ (SY0-701)** | **439 $** | Hausse du 01/06/2026 (399 → 439 $) |
| **eJPT** (eLearnSecurity) | **≈ 249 $** | Le premier « pentest » reconnu, à un prix abordable |
| **CEH** | **≈ 1 000 $** | |
| **OSCP** | **≈ 1 500 $** | Très difficile, très reconnu |
| **PortSwigger BSCP** | **≈ 170 $** | webs-security, lié à l'académie gratuite |

> Ces prix sont ceux constatés le 01/11/2026. **Ils changent** : le
> Security+ a augmenté de 40 $ en juin 2026. Les reverifier avant de
> les publier dans un document destiné aux élèves.

---

## 4. Ce que la plateforme ne fait pas encore (à dire franchement)

| Manque | Pourquoi c'est important | Statut |
|---|---|---|
| **Contrôle d'âge / consentement parental** | La plateforme vise des élèves de 11 à 18 ans. Sous le RGPD, un traitement sur des données de moins de 15 ans demande normalement un accord parental. | ⚠️ Signalé par l'auditeur RGPD — **à traiter** |
| **Vidéos des parcours Fondations et M3** | 16 des 22 rooms universitaires ont une vidéo ; les parcours Fondations et M3 n'en ont pas encore. | 📋 Au backlog |
| **Exercices autres que les QCM** dans 14 rooms | L'audit Pédagogie a mesuré que 14 rooms sur 52 n'ont pas de machine : leur « exercice d'application » est un QCM, pas une manipulation. | 📋 Au backlog |
| **Traduction AR/EN des textes de certification** | Le nom de la certification est le même partout, mais les phrases d'explication sont encore en français sur les parcours. | 📋 À faire |
| **Un « portfolio » pour l'élève** | Un dossier qui rassemble certificat de la plateforme, progression, et attestation de compétences — utile pour un CV ou un dossier de candidature. | 📋 Au backlog |
| **Équivalence avec les certificats MOOC** | Aucun de nos parcours n'est validé par un organisme certificateur : on prépare, on ne délivre pas la certification elle-même. | À dire clairement aux élèves |

---

## 5. La règle de non-surpromesse

Trois phrases que la plateforme ne doit **jamais** écrire :

| ❌ À ne pas écrire | ✅ À écrire |
|---|---|
| « Un certificat gratuit en fin de parcours » | « Le certificat de la plateforme, gratuit et vérifiable en ligne. La certification **Security+** que ce parcours prépare coûte 439 $ à l'examen. » |
| « La formation gratuite avec voucher ISC2 CC » | « L'ISC2 CC est fermé aux nouveaux candidats depuis le 20/05/2026. Voici les équivalents encore ouverts : CompTIA Security+, Fortinet NSE 1-3 (gratuit). » |
| « Comparable à un MIT OCW » | « Inspiré de MIT OCW 6.858, avec notre machine d'entraînement et un drapeau vérifié côté serveur. » |

---

## 6. Comment mettre à jour ce document

1. Les prix d'examen changent : les revérifier **avant** chaque version.
2. Une certification qui ferme (comme ISC2 CC) doit être retirée ici **et**
   dans `docs/SOURCES-CONTENU.md` le jour même.
3. Chaque nouvelle room universitaire ajoutée au dépôt doit avoir une ligne
   ici, avec sa licence — sinon l'auditeur « Licences » la signalera.
4. La vérification se fait par un audit automatisé : l'auditeur
   `scripts/audit/audit-licences.php` compare le registre, les vidéos et
   l'affichage à l'écran.

---

## Voir aussi

- [`docs/SOURCES-CONTENU.md`](SOURCES-CONTENU.md) — le registre des sources et des licences
- [`docs/CONTENU-MIT.md`](CONTENU-MIT.md) — le palier 3 universitaire, en détail
- [`docs/AUDITS-REGISTRE.md`](AUDITS-REGISTRE.md) — les rapports des 15 auditeurs
- [`docs/ROADMAP.md`](ROADMAP.md) — la feuille de route (bloc T : les 15 agents)
