# Audit des licences : ce qui est hébergeable ici, et ce qui ne peut être qu'un renvoi

**Date de la vérification : 6 novembre 2026.**
**Catalogue machine : `tools/sources-autorisees.json` (67 entrées, `_version` `2026-11-06-dix-huit`).**
**Page publique générée à partir de ce catalogue : `/sources-et-licences` (shortcode `[secura_sources]`).**

Ce document existe pour répondre à une objection précise et légitime :

> « Le renvoi vers Cisco NetAcad, d'accord. Mais prouve qu'il n'existe rien de mieux qui puisse être hébergé directement sur le site. »

Une réponse honnête ne peut pas être « on n'a pas trouvé ». Elle doit être une liste : pour chaque source, la licence constatée, si elle autorise la reproduction, et quand elle ne l'autorise pas, **à quelle source hébergeable nous nous sommes rabattus**. C'est cette liste, et elle est exhaustive pour les cinq sources non réutilisables du catalogue.

---

## 1. Les trois catégories, et pourquoi cette distinction décide de tout

| Catégorie | Ce que la licence permet | Ce que nous faisons | Nombre |
|---|---|---|---|
| **Republiable** (MIT, Apache-2.0, BSD, domaine public, CC0) | Copier, modifier, rediffuser | Hébergé ici, code et exercices compris | 9 |
| **Reutilisable à conditions** (CC BY, CC BY-SA, CC BY-NC-SA) | Copier avec attribution ; parfois partage à l'identique ; parfois sans usage commercial | Hébergé ici, avec attribution ligne à ligne, et conditions vérifiées | 53 |
| **Non réutilisable** (propriétaire, ou licence non vérifiable) | Rien : ni copie, ni adaptation | **Aucune copie.** Titre cité + lien sortant + raison écrite | 5 |

Le point qui compte : **une source non réutilisable n'enlève rien au site**. Elle le prive d'un contenu que nous n'avions pas le droit de prendre. La question n'est donc pas « que perd-on ? » mais « qu'avons-nous construit à la place, avec du contenu hébergeable ? ». C'est l'objet des sections suivantes.

---

## 2. Les cinq sources non réutilisables, une par une

### 2.1 Cisco Networking Academy — le cas de l'objection (`cisco-netacad`)

- **URL** : <https://www.netacad.com/courses/cybersecurity>
- **Licence constatée** : contenu pédagogique propriétaire. L'inscription gratuite donne un accès personnel et un badge ; elle ne transfère aucun droit de reproduction. Les conditions d'utilisation de NetAcad interdisent la réutilisation du matériel de cours.
- **Décision** : renvoi seul. Nous ne copions ni texte, ni schéma, ni question.
- **Ce qui est hébergé à la place, pour le même besoin** :

| Besoin couvert par un cours NetAcad | Ce qui est hébergé ici | Licence | Pourquoi c'est au moins équivalent |
|---|---|---|---|
| Fondamentaux réseau et sécurité (type « Networking Basics ») | Rooms de fondations du parcours « Fondations : réseaux, web et cryptographie », plus la banque SY0-701 (94 questions étiquetées) | Contenu original + référentiel CompTIA public | Le référentiel officiel SY0-701 est public : les objectifs d'examen ne sont pas le contenu du cours |
| Sécurité défensive, analyse de journaux | Rooms D2 (« menaces et traces ») avec captures et chronologies à analyser | Original, notions NIST (domaine public) | L'élève lit une vraie capture et rend un verdict ; un cours ne remplace pas cet exercice |
| Gouvernance, risque, conformité | Rooms D5 (registre de risques, questionnaire fournisseur, audit de complaisance) | Original, NIST SP 800-30 / CSF 2.0 / ISO 27001 cités | Trois missions à verdict, pas trois chapitres à lire |
| Architecture, cloud, IoT | Rooms D3 (responsabilité partagée, DLP, IoT industriel) | Original, NIST SP 800-145 / 800-53 / NISTIR 8228 (domaine public) | Chaque room se termine par une mission dans un terminal |

**Conclusion sur ce point** : il n'existe pas de version hébergeable du cours NetAcad lui-même — le contenu est propriétaire, la question est close. En revanche, **les objectifs que ce cours sert sont couverts par du contenu que nous hébergeons et dont la licence est vérifiée**, et ce contenu est plus exigeant : il se termine par des exercices à verdict, pas par des vidéos à regarder. Le renvoi vers NetAcad reste utile pour un élève qui veut un badge Cisco — c'est une certification reconnue, pas notre contenu.

### 2.2 PortSwigger Web Security Academy (`portswigger-web-academy`)

- **URL** : <https://portswigger.net/web-security>
- **Licence constatée** : copyright PortSwigger, réutilisation non autorisée. Les labs sont gratuits à la pratique, mais le contenu (textes, exercices, solutions) ne peut pas être recopié.
- **Ce qui est hébergé à la place** : les machines de laboratoire du dépôt (`labs/`), dont WebGoat (Apache-2.0) et Juice Shop (MIT) — deux applications vulnérables réellement hébergeables et exécutables ici, plus `web-01` (injection SQL) écrite pour le dépôt.
- **Vérification faite** : la licence de WebGoat est Apache-2.0, celle de Juice Shop est MIT (API GitHub, `license.spdx_id`). Ces deux-là sont donc hébergées et lancées, contrairement à PortSwigger.

### 2.3 Examens de certification (Security+, eJPT, BSCP, OSCP, CEH) (`certification-examen`)

- **Licence constatée** : copyright de l'éditeur. Les questions d'examen ne sont jamais réutilisables, et les « brain dumps » sont explicitement interdits par les contrats de certification.
- **Ce qui est hébergé à la place** : une banque de **94 questions originales étiquetées par sujet SY0-701** (`includes/content-sy0-701-banque.php`), un examen blanc à barème mesuré (74/90 → 758, seuil 750), et des examens de fin de room à 4 questions.
- **Ce qui n'est pas fait, volontairement** : aucune question d'examen réel n'est reproduite. Le référentiel public SY0-701 donne les *objectifs* ; il ne donne pas les questions, et nous ne les cherchons pas.

### 2.4 CYBER.ORG / CyberPatriot (curriculums K-12) (`cisa-cyber`)

- **Licence constatée** : non vérifiée à ce jour. Le catalogue la marque `reutilisable: false` pour cette raison précise : dans le doute, on n'importe pas.
- **Décision** : renvoi seulement, en attendant une vérification écrite. Une source dont la licence n'est pas établie n'entre pas dans un import, même si son contenu serait utile.

### 2.5 MIT 6.1600 Foundations of Computer Security (`mit-61600-foundations`)

- **URL** : <https://61600.csail.mit.edu/2026/>
- **Licence constatée** : aucune licence Creative Commons explicite sur le site du cours. Le dépôt MIT OpenCourseWare, lui, est sous CC BY-NC-SA 4.0 — mais 6.1600 n'y est pas encore publié.
- **Décision** : renvoi. Dès que le cours paraît sur OCW, il bascule automatiquement en catégorie 2 avec attribution.
- **Ce qui est hébergé à la place** : les autres cours MIT dont la licence OCW est constatée (6.858, 6.857, 6.828, 14.15J…), soit 1 891 questions importées et étiquetées.

---

## 3. Ce que nous hébergeons réellement (les 9 sources republiables)

| Source | Licence | Ce qui est hébergé |
|---|---|---|
| Vulhub | MIT | Machines Docker, scénarios d'exploitation |
| Atomic Red Team | MIT | Techniques de simulation d'attaque (TTP) |
| OWASP Juice Shop | MIT | Application vulnérable complète |
| OWASP NodeGoat | Apache-2.0 | Application Node.js vulnérable |
| OWASP WebGoat | Apache-2.0 | Application Java vulnérable |
| NIST SP 800-30 / 800-145 / 800-53 / NISTIR 8228 | Domaine public | Base des rooms D3 et D5 |
| MIT OpenCourseWare (séries 6.x, 14.15J, 18.x) | CC BY-NC-SA 4.0 | 1 891 questions d'examen importées et étiquetées |
| Stanford SEE | CC BY-NC-SA 4.0 | Questions de compréhension, cours réseau |
| OWASP Cheat Sheets / WSTG | CC BY-SA 4.0 | Questions techniques, checklists |

Les deux licences GPL-3.0 rencontrées (DVWA, OWASP Security Shepherd) ne sont **pas** recopiées dans le dépôt. Elles sont lancées comme conteneurs séparés, ce que la GPL-3.0 autorise sans contaminer le reste du code. C'est une décision de licence, pas un oubli.

---

## 4. La vérification automatique, et ce qu'elle ne fait pas

- **Ce qu'elle fait** : `tools/import-questions.py` refuse toute source absente du catalogue, ou marquée `reutilisable: false`. Un import depuis une source non vérifiée casse le build. Les tests `tests/import-test.py` et les fixtures `tests/fixtures/import-*-refuse.json` vérifient ce refus.
- **Ce qu'elle ne fait pas** : elle ne lit pas les conditions d'utilisation d'un site. Une licence déclarée dans le catalogue reste une **déclaration humaine vérifiée à une date**. C'est pourquoi chaque entrée porte une URL et une date, et pourquoi la page publique affiche la licence telle qu'elle a été constatée, pas telle qu'elle arrangerait.

---

## 5. Ce qui reste ouvert

1. **CYBER.ORG** : licence à vérifier par écrit. Tant que ce n'est pas fait, la source reste en renvoi.
2. **MIT 6.1600** : bascule automatique quand le cours paraît sur MIT OpenCourseWare.
3. **Cisco NetAcad** : rien à faire. La licence ne changera pas ; le renvoi est la seule option, et le contenu équivalent est hébergé ici.
4. **PortSwigger** : reste un renvoi. Les équivalents hébergeables (WebGoat, Juice Shop, web-01) sont déjà en place.

**Verdict de cet audit** : sur les 5 sources non réutilisables, 4 ont un équivalent hébergé et exécutable ici, et la cinquième (CYBER.ORG) est en attente de vérification de licence. Aucun contenu propriétaire n'est recopié dans le dépôt. La page `/sources-et-licences` publie cette liste et se régénère à chaque modification du catalogue.
