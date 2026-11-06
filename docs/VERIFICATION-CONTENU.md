# Vérification du contenu : quelle affirmation repose sur quelle source

Ce document existe pour répondre à une seule question, la plus gênante
qu'on puisse poser à une plateforme de formation :

> **Qu'est-ce qui prouve que ce que l'élève lit est vrai ?**

Les contrôles automatiques du dépôt (`check.py`,
`verifier-traductions.php`, `tests/smoke-test.php`) vérifient la **forme** :
la longueur, la structure, la présence des traductions, la syntaxe. **Aucun
d'entre eux ne peut dire si une phrase est vraie.** Ce document est la pièce
qui manque : pour chaque affirmation vérifiée, la source consultable, le
verdict, et la date.

## 0. Les trois verdicts, et ce qu'ils engagent

| Verdict | Sens exact | Ce qu'on en fait |
|---|---|---|
| **exact** | la source dit la même chose, sans restriction contraire | on garde, on cite la source |
| **imprécis** | la source dit « en général », le contenu dit « toujours » | on corrige la formulation |
| **faux** | la source dit le contraire | on corrige **avant** publication |

Une affirmation **sans entrée dans ce document n'est pas vérifiée**. Elle
n'est pas fausse pour autant : elle est *non prouvée*. C'est l'état honnête
de la majorité du catalogue à ce jour, et le § 4 en donne le compte.

## 1. Règle de rédaction qui découle de cet audit

**On ne raccourcit jamais une bonne réponse en coupant sa fin.** Un ciseau
de longueur produit des phrases tronquées qui gardent l'air correctes :
« il faut réutiliser », « c'est la séparation ». Le 06/11/2026, trois
bonnes réponses publiées avaient été cassées de cette façon par un
garde-fou de longueur (voir le commit `6189ac1`). Quand une bonne réponse
est trop longue, on **allonge les mauvaises**, ou on réécrit la phrase
entière — jamais on ne la coupe.

## 2. Périmètre audité au 06/11/2026

Deux rooms de démonstration et deux rooms MIT, **34 questions QCM** :

- `univ-01` (7 QCM) et `univ-02` (6 QCM) — source : MIT 6.858, automne 2014 ;
- « Penser comme un défenseur » (11 QCM) et « Les fondamentaux du réseau »
  (10 QCM) — contenu maison, `includes/default-content.php`.

Les deux rooms de démonstration ont en plus **9 questions `flag`** chacune,
non traitées ici : elles ne portent pas d'affirmation factuelle, seulement
un drapeau à lire dans la machine de l'apprenant.

## 3. Tableau des affirmations

### 3.1 `univ-02` — mémoire et défenses (6 QCM, 6 exactes)

| # | Affirmation | Verdict | Source |
|---|---|---|---|
| q0 | le canari est écrasé avec l'adresse de retour, et remarqué au retour de fonction | exact | ioriver ; CS161 |
| q1 | sous ASLR + NX + canari, le ROP reste possible | exact | learnsecuritymanagement |
| q2 | ASLR déplace les zones mémoire à chaque exécution | exact | learnsecuritymanagement |
| q3 | NX rend la pile non exécutable, donc il faut réutiliser du code existant | exact | learnsecuritymanagement |
| q4 | `gets()` n'a aucune limite de taille | exact | cppreference ; SANS |
| q5 | le canari est sur la pile, pas entre les blocs du tas | exact | CS161 ; ioriver |

**Une précision utile à l'élève, pas une erreur** : `gets()` a été *retirée*
du langage en C11 (elle était déjà dépréciée en C99 TC3). L'explication de
la room dit « la raison pour laquelle il ne doit plus être utilisé » — c'est
juste, mais un élève qui compile en C11 verra une erreur de compilation, pas
un avertissement. À signaler dans l'explication si la room est reprise.

### 3.2 `univ-01` — menaces, politique, mécanisme (7 QCM)

| # | Affirmation | Verdict | Source |
|---|---|---|---|
| q0 | la menace est le scénario, la vulnérabilité la faiblesse qui le rend possible | exact | MIT 6.858, notes de cours 1 |
| q1 | un pare-feu ne traite qu'une menace, pas les autres | exact | 6.858 leçon 1 (mécanisme / politique / modèle de menace) |
| q2 | la priorité de protection se juge au coût de la perte, pas au volume | exact | 6.858 leçon 1 |
| q3 | un mécanisme fait appliquer la politique tant que le modèle de menace tient | exact | 6.858 leçon 1 |
| q4 | une politique s'écrit en principals × actions × objets | exact | 6.858 leçon 1 |
| q5 | retirer les droits superflus, c'est le **moindre privilège** | **corrigé** le 06/11/2026 | Provos, « Preventing Privilege Escalation » |
| q6 | un pare-feu ne couvre pas une injection SQL : le mécanisme ne couvre pas la menace | exact | 6.858 leçon 1 |

**Ce qui était faux et qui est corrigé** (commit `d6471d8`, FR et EN) :

- **q5** disait « c'est la séparation des privilèges ». La source (Provos,
  lu en 6.858) définit la séparation des privilèges comme le **découpage
  d'une application en parties privilégiées et non privilégiées**, et la
  distingue explicitement du moindre privilège. Les deux termes étaient
  employés comme synonymes. La room enseigne pourtant la séparation des
  privilèges plus loin (leçon 4) : l'élève apprenait le mauvais nom pour le
  bon principe.
- **q1** disait « Rien : sans tester le système, aucune propriété ne peut
  être garantie ». C'est **faux** : une politique se garantit par la
  conception et l'analyse, pas par un test. Le vrai argument de la leçon est
  que le pare-feu ne traite qu'une seule menace.

### 3.3 « Penser comme un défenseur » (11 QCM, 11 exactes)

| # | Affirmation | Verdict | Source |
|---|---|---|---|
| q0 | le premier réflexe est de relever l'état (capture, journaux, heure) | exact | RFC 3227 § 2 ; RFC 3227 § 3.2 |
| q1 | moindre privilège = n'accorder que les droits nécessaires | exact | NIST SP 800-53 AC-6 |
| q2 | la surface d'attaque est l'ensemble des points d'entrée | exact | NIST SP 800-53 SA-15 (5) |
| q3 | le plan de réponse à incident fixe rôles et escalade | exact | NIST SP 800-61 rév. 3 ; RFC 2350 § 3.5.1 |
| q4 | relever l'état avant toute modification | exact | RFC 3227 § 2 : « When confronted with a choice between collection and analysis you should do collection first and analysis later » |
| q5 | ne pas redémarrer ni nettoyer les journaux d'un serveur compromis | exact | RFC 3227 § 2.2 : « Don't shutdown until you've completed evidence collection » |
| q6 | une modification non autorisée viole l'intégrité | exact | NIST SP 800-53 SI-7 |
| q7 | l'intégrité protège contre la modification non autorisée | exact | NIST SP 800-53 SI-7 |
| q8 | le moindre privilège limite les dégâts, il ne prévient pas la compromission | exact | NIST SP 800-53 AC-6 |
| q9 | le plan de réponse à incident documente procédures, rôles, escalade | exact | NIST SP 800-61 rév. 3 ; RFC 2350 § 3.5.1 |
| q10 | fermer un service dont personne ne se sert réduit la surface d'attaque | exact | NIST SP 800-53 CM-7 |

**La source la plus solide ici n'est pas NIST, c'est la RFC 3227.** C'est un
« Best Current Practice » de l'IETF, court, lisible, et il dit littéralement
les trois gestes enseignés par la room : collecter avant d'analyser, noter
les dates et les heures, ne pas éteindre avant d'avoir fini la collecte.
Elle est citée en renvoi dans la leçon, pas recopiée.

Le NIST SP 800-61 est cité en **révision 3** (avril 2025) : la révision 2 de
2012, encore reprise dans beaucoup de cours, est **retirée** depuis le
03/04/2025. Si une room cite « le cycle en quatre phases » du 800-61, elle
décrit un document qui n'est plus en vigueur.

### 3.4 « Les fondamentaux du réseau » (10 QCM)

| # | Affirmation | Verdict | Source |
|---|---|---|---|
| q0 | TCP est en couche 4 (transport) | exact | RFC 9293 |
| q1 | l'adresse MAC identifie l'interface physique, l'IP est attribuée par DHCP | exact **avec réserve** | IEEE 802 ; voir ci-dessous |
| q2 | le port 443 porte HTTP dans une session TLS | exact | registre IANA |
| q3 | un pare-feu filtre le trafic selon une politique de flux | exact | NIST SP 800-41 rév. 1 |
| q4 | le port 443 est le port standard du web chiffré | exact | registre IANA : `https 443/tcp` |
| q5 | UDP n'ouvre pas de session et ne garantit pas la livraison | exact | RFC 768 |
| q6 | la couche 3 porte l'adressage logique et le routage | exact | RFC 9293 ; modèle OSI |
| q7 | un port désigne l'application qui écoute | exact | RFC 9293 ; registre IANA |
| q8 | une adresse MAC identifie une interface sur le lien local seulement | exact | IEEE 802 |
| q9 | un cadenas HTTPS garantit que le trafic est chiffré | exact | voir ci-dessous |

**q1, réserve sur le mot « gravée ».** L'adresse MAC est *assignée par le
constructeur* à l'interface et stockée dans sa mémoire. Elle est
**modifiable par logiciel** : c'est le *MAC spoofing*, courant et trivial
sur la plupart des cartes. Le mot « gravée » suggère une immuabilité qui
n'existe pas. Le contenu actuel n'est pas faux — l'assignation d'usine est
bien l'origine de l'adresse — mais il induit en erreur un débutant qui
croira qu'on ne peut pas la changer. Formulation plus juste : « attribuée à
la carte par le constructeur ».

**q9, ce que le cadenas ne garantit pas.** La bonne réponse est exacte et
l'explication la borne correctement (« cela ne dit rien de la sécurité du
site lui-même »). Le point mérite d'être renforcé, parce que c'est un
contresens répandu : la quasi-totalité des sites d'hameçonnage utilisent
HTTPS et affichent le cadenas. « Le cadenas prouve le chiffrement du
transport, pas l'honnêteté du site. » Le FBI publie cette mise en garde.

## 4. Ce qui reste non vérifié — le chiffre honnête

| Périmètre | Questions | Vérifiées à ce jour |
|---|---|---|
| `univ-01`, `univ-02` | 13 | **13** |
| « Penser comme un défenseur » | 11 | **11** |
| « Les fondamentaux du réseau » | 10 | **10** |
| **Total audité** | **34** | **34** |
| Reste du catalogue (204 QCM des universités + rooms M3) | ~230 | **0** |

Autrement dit : **13 % du catalogue est adossé à une source nommée**. Les
87 % restants ne sont pas suspects, ils sont *non prouvés*. Tant que ce
document ne les couvre pas, la plateforme ne peut pas affirmer qu'ils sont
exacts — seulement qu'ils sont plausibles et cohérents.

## 5. Défauts connus, non corrigés à ce jour

Ces trois points ont été relevés pendant l'audit et **n'ont pas été
corrigés** : ils sont hors du périmètre des 34 questions, et une correction
de masse reste suspendue.

| Où | Défaut | Gravité |
|---|---|---|
| `univ-18` | « Parce que les **laws change** » — une moitié de phrase est restée en anglais dans le texte français | visible, à corriger en priorité |
| `univ-06` | « la zone publique ne devrait pas joindre la zone des données » — présenté comme une règle générale, alors qu'un pare-feu à états autorise le retour des connexions établies | **faux comme règle générale** |
| `univ-01` (texte de room) | « je gagne le niveau en 3 minutes » — promesse commerciale dans un texte pédagogique | hors sujet, à retirer |

## 6. Les sources, avec leur URL

Une URL, pas un titre d'ouvrage : c'est la règle de ce document.

| Réf. | URL | Consultée le |
|---|---|---|
| Provos, « Preventing Privilege Escalation » (6.858) | https://css.csail.mit.edu/6.858/2024/readings/openssh-privsep.pdf | 06/11/2026 |
| RFC 3227, *Guidelines for Evidence Collection and Archiving* | https://www.rfc-editor.org/rfc/rfc3227.txt | 06/11/2026 |
| RFC 768, *User Datagram Protocol* | https://www.rfc-editor.org/rfc/rfc768 | 06/11/2026 |
| RFC 9293, *Transmission Control Protocol* | https://www.rfc-editor.org/rfc/rfc9293 | 06/11/2026 |
| RFC 2350, *Expectations for Computer Security Incident Response* § 3.5.1 (triage, coordination, résolution) | https://www.rfc-editor.org/rfc/rfc2350.txt | 06/11/2026 |
| NIST SP 800-53 AC-6, *Least Privilege* | https://csrc.nist.gov/projects/cprt/catalog | 06/11/2026 |
| NIST SP 800-53 CM-7, *Least Functionality* | https://csrc.nist.gov/projects/cprt/catalog | 06/11/2026 |
| NIST SP 800-53 SI-7, *Software, Firmware, and Information Integrity* | https://csrc.nist.gov/projects/cprt/catalog | 06/11/2026 |
| NIST SP 800-53 SA-15 (5), *Attack Surface Reduction* | https://csrc.nist.gov/projects/cprt/catalog | 06/11/2026 |
| NIST SP 800-61 rév. 3, *Incident Response Recommendations* | https://csrc.nist.gov/pubs/sp/800/61/r3/final | 06/11/2026 |
| NIST SP 800-41 rév. 1, *Guidelines on Firewalls and Firewall Policy* | https://csrc.nist.gov/pubs/sp/800/41/r1/final | 06/11/2026 |
| Registre IANA des noms de service et ports | https://www.iana.org/assignments/service-names-port-numbers/ | 06/11/2026 |
| cppreference, `gets` | https://en.cppreference.com/c/io/gets | 06/11/2026 |
| Berkeley CS161, discussion 3 (solutions) | https://inst.eecs.berkeley.edu/~cs161/sp15/discussions/dis03-solutions.pdf | 06/11/2026 |
| ioriver, *stack canaries* | https://www.ioriver.io/terms/stack-canaries | 06/11/2026 |
| learnsecuritymanagement, *buffer overflow, stack canary* | https://www.learnsecuritymanagement.com/cissp-buffer-overflow-stack-canary | 06/11/2026 |
| SANS, *Stack canaries* | https://www.sans.org/blog/stack-canaries-gingerly-sidestepping-the-cage | 06/11/2026 |

## 7. Comment ce document est tenu

- Une ligne par affirmation **factuelle** — pas par question : une question
  peut porter deux affirmations.
- La source est **consultable** : une URL, pas un titre d'ouvrage.
- La date de vérification est celle du commit qui ajoute la ligne. On la
  relit **au-delà d'un an** : `gets()` a changé de statut en C11, le NIST
  SP 800-61 est passé en révision 3, les ports standards bougent.
- Quand une source est un **contenu propriétaire** (notes de cours, article
  de blog), elle sert de **preuve**, pas de matériau : on ne recopie rien.
  La règle de licence est dans `docs/SOURCES-CONTENU.md`.
- Une source primaire (RFC, NIST, registre IANA) vaut mieux qu'un article
  de vulgarisation : quand les deux se contredisent, c'est la primaire qui
  tranche.
