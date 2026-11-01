# Les labs avancés (M7) — Juice Shop, dojo, briefs et Kahoot

> Ce que contient le bloc M7 du programme : **quatorze rooms** qui demandent
> de l'autonomie, **trois nouvelles machines** (deux labs et un service), et
> un quiz de révision jouable en classe.
>
> État : 01/11/2026 · version v0.6.0

---

## 1. Le principe : la cible est réelle, la preuve est lisible par le serveur

Dans les rooms M3, la machine est un décor : on y cherche un indice, puis on
répond à un QCM. Dans les labs avancés, la machine **est** l'exercice :

- **OWASP Juice Shop** : une vraie application web vulnérable, lancée seule
  dans un réseau fermé. On s'y connecte en administrateur, on résout un défi,
  et l'application affiche un code de drapeau.
- **Le dojo Secura** : vingt défis, cinq ceintures, quatre par ceinture.
- **Les briefs** : six vidéos d'introduction (pwn.college, CYBER.ORG, Joe Ma),
  chacune avec sa preuve.

Et dans tous les cas, **la réponse est vérifiée par le serveur, dans la
machine, en root** : l'élève ne peut pas copier la réponse, il doit la
trouver. Le fichier du drapeau est en `400 root:root` ; l'élève ne peut pas
le lire.

---

## 2. Les machines

| Machine | Rôle | Image | Construite en CI |
|---|---|---|---|
| `labs/univ-01` | La salle des cours : 22 livrables, 22 drapeaux | `securalabs/univ-01:1.0` | ✅ |
| `labs/dojo-01` | Le dojo : 20 défis + 7 briefs, 27 drapeaux | `securalabs/dojo-01:1.0` | ✅ |
| `labs/juice-shop` | L'application vulnérable + le service des drapeaux | `docker.io/bkimminich/juice-shop:v20.3.0` + `securalabs/flags-01:1.0` | ✅ (image officielle tirée par Compose) |
| `labs/dojo-pwncollege` | Le **vrai** dojo pwn.college (optionnel) | `ghcr.io/pwncollege/dojo:latest` | ❌ (documenté, pas construit) |

### 2.1 La salle des cours (`univ-01`)

Une image pour les vingt-deux rooms universitaires. L'élève travaille dans
`/home/ctf`, les livrables des cours sont dans `/srv/cours`, la politique du
laboratoire dans `/etc/secura-policy`, les TP de pwn.college dans
`/home/ctf/pwn`. Les drapeaux sont dans `/root/flags`, en `400 root:root`.

### 2.2 Le dojo (`dojo-01`)

Cinq ceintures, quatre défis chacune :

| Ceinture | Ce qu'on apprend | Dossiers |
|---|---|---|
| 1 — blanche | lire, chercher, comprendre | `/srv/dojo/1-blanche` |
| 2 — jaune | permissions, propriétaire, contenu | `/srv/dojo/2-jaune` |
| 3 — orange | réseau, processus, configuration | `/srv/dojo/3-orange` |
| 4 — verte | binaires, chaînes, mémoire | `/srv/dojo/4-verte` |
| 5 — noire | cryptographie, clés, empreintes | `/srv/dojo/5-noire` |

Plus les six briefs et le document de révision dans `/srv/briefs`.

Chaque défi est un document qui indique l'outil attendu et la valeur à
relever. La valeur est la preuve : le serveur la compare au drapeau.

### 2.3 Le lab Juice Shop

Trois services, un seul réseau **sans sortie Internet** :

| Service | Rôle |
|---|---|
| `attacker` | la machine de l'élève (terminal, outils) |
| `juice` | l'application OWASP Juice Shop (`bkimminich/juice-shop:v20.3.0`, version épinglée) |
| `flags` | le serveur : les drapeaux, en `400 root:root`, illisibles par l'élève |

**Comment la mission se valide.** Juice Shop fonctionne en « mode CTF » :
l'application calcule, pour chaque défi, un code à partir d'une clé
(`CTF_KEY`). Quand l'élève résout un défi, l'application lui affiche ce
code. L'élève le recopie ; le serveur le compare au code qu'il a calculé
lui-même (`tools/juice-shop/ctf-flag.py`).

```bash
python3 tools/juice-shop/ctf-flag.py --challenge "Login Admin"
# defi   : Login Admin
# drapeau: 42a41f4ca5dd6ebd39c22e0ef34080d2d4636935
```

La clé et le nom du défi sont donc publics dans le dépôt : ce n'est pas un
secret, c'est une **preuve vérifiable**. Le serveur ne lit pas la réponse de
l'élève dans le navigateur : il compare avec le fichier qu'il garde en root.

### 2.4 Le vrai dojo pwn.college (optionnel)

`labs/dojo-pwncollege/docker-compose.yml` lance le dojo officiel
(licence BSD-2-Clause pour le moteur). Son image est très lourde : elle
n'est **pas** construite dans la CI. C'est un complément pour qui veut
l'original, pas le chemin prévu pour les élèves de la plateforme.

---

## 3. Les quatorze rooms

| # | Room | Machine | Preuve |
|---|---|---|---|
| 1 | La boutique en ligne : se connecter en administrateur | Juice Shop | code du défi « Login Admin » |
| 2 | La zone administrateur : ce qu'un administrateur voit | Juice Shop | code du défi « Admin Section » |
| 3–7 | Ceinture blanche → noire (5 rooms) | dojo-01 | 4 drapeaux par ceinture |
| 8–13 | Briefs 1 à 6 (6 rooms) | dojo-01 | 1 drapeau par brief |
| 14 | Kahoot : la révision des labs avancés | dojo-01 | le document de révision |

Chaque room suit le même patron que les autres : **leçon → entraînement →
mission → examen**. Les vingt-deux rooms universitaires gardent le même
patron, avec la vidéo du cours en façade.

---

## 4. Le quiz Kahoot

La room « Kahoot » propose deux usages du même contenu :

1. **en classe** : on ouvre Kahoot, on donne le code (`SECURA1`), les élèves
   jouent avec leur téléphone ;
2. **seul, sans compte** : les dix questions sont dans l'examen de la room,
   avec minuteur et explication.

Le quiz est **exportable** :

- **CSV** — `?seca_kahoot=csv&room=<id>` : une ligne par question
  (question, quatre propositions, bonne réponse, durée) ;
- **JSON** — `?seca_kahoot=json&room=<id>` : la même chose, plus l'explication.

L'export demande une session ouverte (c'est un document de classe) et ne
demande **aucun compte Kahoot**.

---

## 5. Ce que la CI vérifie à chaque push

- les images `univ-01`, `dojo-01` et `flags-01` se construisent ;
- les 22 + 27 drapeaux sont lisibles **en root** et **pas** par l'élève ;
- chaque drapeau est **découvrable** dans les documents du lab (cohérence
  entre le contenu et la preuve) ;
- l'application Juice Shop démarre et répond ;
- le drapeau du serveur Juice Shop correspond à celui calculé par
  l'application ;
- le réseau du lab **n'a pas de sortie Internet**.

---

## 6. Ce qui reste ouvert

- Le vrai dojo pwn.college n'est pas construit en CI (choix assumé : image
  trop lourde) ; il est documenté pour un VPS.
- Les labs M7 sont **difficiles** : c'est voulu (palier 3), mais un parcours
  « échauffement » avant le dojo pourrait aider. À évaluer après usage.
- Les vidéos de brief sont en anglais : les leçons écrites, elles, sont
  traduites en arabe et en anglais.
