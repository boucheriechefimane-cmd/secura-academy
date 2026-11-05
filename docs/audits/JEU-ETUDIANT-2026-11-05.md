# J'ai joué l'étudiant : les labs marchent-ils vraiment ?

Méthode : PHP 8.3 et SQLite sont disponibles dans le dépôt, donc j'ai
**reconstitué la machine `multi-01` hors Docker** (code réel de
`labs/multi-01/app`, base SQLite créée par le vrai `entrypoint.sh`, journal et
configuration réels dans `/srv/app` et `/var/log/app`), puis j'ai joué les
scénarios M3 comme un élève, sans regarder les réponses avant.

Verdict global : **ce ne sont pas des coquilles vides.** 7 scénarios sur 10
fonctionnent de bout en bout, avec de vraies failles, vraiment exploitables.
3 ont un défaut qui bloque ou qui rend le drapeau accessible sans rien
exploiter.

---

## Ce qui fonctionne pour de vrai (mesuré, avec la sortie)

| Room | Ce que l'élève fait | Résultat obtenu |
| --- | --- | --- |
| le-service-qui-ne-repond-plus | lit `status.php`, suit le chemin de config | `FLAG=SECURA{triage_patient}` — OK |
| le-mot-de-passe-oublie | lit `/srv/app/app.conf` | `Intranet2019!` accepté — OK |
| la-requete-qui-ne-se-fie-a-personne | `admin' OR 1=1 --` sur le formulaire | session ouverte, `admin.php` répond « Connecté en tant que 1 » — **injection SQL réelle** |
| (suite) extraction des secrets | `' UNION SELECT value,1,2 FROM secrets --` | le drapeau s'affiche dans la page admin : `FLAG=SECURA{sql_quotes_only}` — **exploitation complète sans client sqlite** |
| la-page-qui-se-trahit | `bot.php?url=…/search.php?q=<script>…` | le robot enregistre `FLAG=SECURA{xss_reflected}` — **XSS réfléchie réelle** |
| le-fichier-quon-naurait-pas-du-laisser | `download.php?file=../../../srv/app/app.conf` | la configuration complète sort, drapeaux compris — **traversée réelle** |
| qui-a-force-la-porte | `awk` + `sort` + `uniq` sur le journal | 48 échecs 401 depuis 198.51.100.7, puis un 200 avec le jeton — **scénario d'analyse crédible** |

Deux points remarquables, que je n'attendais pas :

1. **La room SQLi ne demande pas le drapeau de la base, elle demande
   « le jeton obtenu »** : la vraie exploitation (`UNION`) révèle
   `{sql_quotes_only}`, une autre valeur. La réponse attendue n'est donc pas
   devinable en lisant le code de l'application.
2. **Le scénario XSS n'est pas simulé en JavaScript** : le robot charge
   réellement la page et cherche un `<script>`. C'est grossier, mais c'est
   du vrai HTTP, pas une animation.

---

## Ce qui est cassé ou faux

### 1. Le buffer overflow de `bin-01` ne mène à rien (bloquant)

Compilé avec les vrais drapeaux du Makefile (`-fno-stack-protector -z
execstack -no-pie`), le binaire **segfault bien** sur une entrée de 80
caractères (code 139). Mais il n'y a **aucun chemin vers un shell** :

- `objdump` : **0** occurrence de `pop %rdi` ;
- `strings` : **0** occurrence de `/bin/sh` ;
- le code n'appelle ni `system` ni `execve`.

L'élève peut provoquer un crash, jamais obtenir le shell qui lui permettrait
de lire `/root/flag.txt`. La room « le binaire qui obéit trop » annonce un
shell root : **c'est faux en l'état**.

Bonus de crédibilité : le Dockerfile affirme « pas d'ASLR (-no-pie) ». C'est
inexact : `-no-pie` désactive PIE, pas l'ASLR du noyau. Sur le runner,
`randomize_va_space = 2`.

### 2. Le drapeau TLS existe… mais pas là où la room l'envoie

La room annonce la cible `https://127.0.0.1:8443`. Dans la configuration
Apache de l'image, **8443 est le vhost TLS** (`SSLEngine on`), et la page
`tls-secret.php` vérifie `$_SERVER['HTTPS']` : appelée en HTTP simple, elle
répond 404. Le drapeau `FLAG=SECURA{tls_not_proof}` n'est donc **pas
accessible sans TLS** — et sur mon banc d'essai (PHP en clair), je n'ai pas
pu le lire. Deux issues possibles, à trancher :

- soit l'image sert vraiment TLS sur 8443 (à prouver par un test
  `openssl s_client` + `curl -k`, qui n'existe pas aujourd'hui) ;
- soit l'élève est envoyé vers une cible qui ne répond pas — c'est ce que
  mesure `preuve-machines.php` sur 27 autres rooms.

### 3. Le drapeau du « binaire qui obéit trop » et celui du ROP sont
   imprimés en clair dans les livrables

`flag-u12.txt` vaut `FLAG=SECURA{chainage_de_gadgets}`, et la room demande
« relève le nombre de gadgets (chain_length) ». Ce nombre est écrit noir sur
blanc dans `home/ctf/pwn/rop-notes.md`. L'élève n'a aucune raison de toucher
un outil ROP : c'est un exercice de lecture, présenté comme un TP
d'exploitation.

C'est le motif général : **20 fichiers sur 22** d'`univ-01` et **27 sur 27**
de `dojo-01` contiennent le drapeau en clair dans un fichier lisible par
l'élève.

### 4. Les scénarios 7 et 9 sont résolubles par accident

- Scénario 7 : l'élève qui lit `/srv/app/app.conf` pour le scénario 1 y trouve
  aussi `admin_token = FLAG=SECURA{xss_reflected}` — le drapeau du scénario
  XSS. Trois scénarios partagent donc un même point d'entrée : une seule
  lecture résout trois rooms.
- Scénario 9 : le vrai `entrypoint.sh` de l'image met `FLAG=SECURA{triage_patient}`
  dans `app.conf` ; la room du service demande ce même drapeau. L'élève qui
  fait la room 1 tient déjà la réponse de la room 10.

### 5. Le journal contient des lignes de shell

`access.log` inclut `fi`, `cat` et `LOG` (du bruit de la génération du
fichier). Un élève attentif voit que le laboratoire est fabriqué. À nettoyer.

---

## Ce que je n'ai pas pu jouer ici, et qui doit être testé

| Room | Pourquoi | Comment le vérifier |
| --- | --- | --- |
| traverser-le-mur | dépend du cloisonnement réseau Docker (deux réseaux, pivot par `web`) | `scripts/test-labs-ci.sh` le couvre déjà (le nœud interne est injoignable, le pivot fonctionne) |
| la-boutique-en-ligne / la-zone-administrateur | Juice Shop réel : résoudre un défi demande un navigateur | preuve déjà en place : l'empreinte HMAC du serveur correspond à celle de l'application |
| le-certificat-qui-ne-prouve-rien | nécessite le vrai TLS d'Apache | à ajouter : `openssl s_client -connect 127.0.0.1:8443` + `curl -k` |

---

## Note de ce test

- **Contenu des machines M3 : 16/20.** De vraies failles, réellement
  exploitables, dans un récit cohérent.
- **Intégrité du parcours : 9/20.** Drapeaux partagés entre scénarios,
  47 drapeaux en clair, deux rooms résolues en lisant un fichier, et un
  « binaire qui obéit trop » qui n'obéit pas.
- **Conclusion** : ce n'est pas une coquille vide, c'est un **bon décor avec
  trois portes qui ne s'ouvrent pas**. Les corrections sont ciblées et peu
  coûteuses : voir `ROADMAP-CORRECTION-2026-11.md`, lots L1 (anti-triche),
  L2 (pratique) et L3 (machines crédibles).

---

## 9. Réparation de `bin-01` (5 novembre 2026, après-midi)

Le scénario 9 promettait un shell root que personne ne pouvait obtenir : le
binaire lisait bien au-delà de son tampon, mais ne contenait **aucun** chemin
vers un shell (`strings` : zéro `/bin/sh` ; `objdump` : aucun `system`, aucun
`execve`). Le drapeau était pourtant présenté comme le butin d'un débordement.

### Ce qui a changé

| Élément | Avant | Après |
|---|---|---|
| Lecture de l'entrée | `gets(buffer)` sur 64 octets | `read(0, buffer, 1024)` sur un tampon de 64 |
| Chemin vers le drapeau | aucun | fonction `carnet_root` (jamais appelée) : `setuid(0)` + `execl("/bin/sh")` |
| Adresse de la cible | — | `nm vulnerable` → `0x401196`, fixe (`-no-pie`) |
| Mention de l'ASLR | « pas d'ASLR (-no-pie) » — **faux** | corrigée : `-no-pie` ne désactive pas l'ASLR du noyau |
| Notes élève | « ldd donne la version » (sans objet) | repères `nm`, absence de PIE, sens du bit setuid |
| Contrôle machine | le serveur lit le drapeau en root (ne prouve rien) | l'**exploit du dépôt** obtient un shell et lit le drapeau |

### Preuve mesurée (hors Docker, sans setuid)

```
$ gcc -fno-stack-protector -z execstack -no-pie -fno-pie -g -o vulnerable vulnerable.c
$ python3 tools/recette-apprenants/exploit-bin01.py labs/bin-01/src/vulnerable
carnet_root      : 0x0000000000401196
bourrage retenu  : 88 octets
--- ce que le shell a répondu ---
=== Carnet de commandes (v0.9) ===
Format : <numero de lot> <reference>
> uid=1001(user) gid=1001(user) groups=1001(user),27(sudo),100(users)
SECA-SHELL-OK
--- fin ---
IDENTITE DU SHELL : pas root (normal hors image : le binaire doit etre setuid root)
```

88 = 80 octets réservés par `handle_input` (`sub $0x50,%rsp`) + 8 octets de
pointeur de pile sauve. L'exploit balaie ensuite 64→120 octets si une autre
version de gcc déplace la pile, pour que le lab ne casse pas à la première
mise à jour d'image.

### Ce que cette preuve ne dit pas

Le shell **n'est pas root hors Docker** : le binaire n'est pas setuid dans le
bac à sable. La preuve du shell root et de la lecture de
`/root/flag.txt` (`FLAG=SECURA{buffer_overflow}`) ne peut être faite que dans
l'image, donc par la mesure manuelle GitHub (voir §10). Tant que ce run n'a pas
eu lieu, la ligne « shell root » reste **non prouvée**.
