# La preuve des machines, room par room — 5 novembre 2026

Ce document repond a une question precise : **les machines annoncees pour
chaque room existent-elles vraiment, et le drapeau que la room exige est-il
reellement dans l'image ?** Il ne remplace pas les controles des machines
(`scripts/test-labs-ci.sh`), il repond a une autre question : le contrat
entre une room et sa machine.

## Ce qui a ete mesure

Docker n'est pas installable dans le bac a sable du proprietaire : il n'y a
ni binaire Docker, ni droits suffisants, ni acces aux registres d'images.
La mesure a donc ete faite par GitHub Actions, sur un vrai `ubuntu-latest`
avec un vrai Docker, en executant `tools/recette-apprenants/preuve-machines.php`
a travers WP-CLI, sur le WordPress reel installe par le travail de recette.

Travail de reference : `42010248471` (branche de la demande), septieme
execution apres correction des sondes. Mesures de ce travail :

- les 45 controles des machines : **67 reussis, 0 echec** ;
- la preuve room par room : **49 rooms, 49 prouvees, 0 echec** ;
- l'isolation des deux apprenants : deux conteneurs, deux reseaux, deux
  projets Compose, aucun croisement ;
- le drapeau de la vraie machine valide une mission, puis un second
  apprenant ouvre sa propre machine. Le rapport brut est depose par
le travail lui-meme dans la branche `preuve-machines`, dossier
`docs/preuves/` (`machines-2026-11-05.txt`), avec le diagnostic des ports
et le journal PHP. Les journaux de job et les artefacts ne sont pas
telechargeables depuis le bac a sable (redirection Azure bloquee) : c'est
pourquoi la preuve est ecrite dans le depot.

## Methode, room par room

Pour chaque room qui declare une machine, le script :

1. lit l'image ou la pile declaree dans le manifeste de la room ;
2. demarre la machine comme le plugin le fait (utilisateur 1000:1000,
   `--cap-drop ALL`, `no-new-privileges`, reseau interne sans Internet) ;
3. lit le drapeau exige par la room, en root, **a l'endroit exact ou le
   plugin le lit** (`docker compose exec -u 0 <flag_service> cat <chemin>`)
   et verifie qu'il contient une valeur exploitable ;
4. verifie que l'apprenant ne peut pas le lire directement ;
5. joint la cible annoncee **depuis l'interieur de la machine** (le plugin
   ne publie aucun port : un essai depuis l'hote ne prouverait rien) ;
6. pour une pile compose, verifie aussi que le service qui sert la cible
   tourne, puis demonte la pile.

## Resultat

`49 rooms avec machine, 49 prouvees, 0 echec` — plus 3 rooms sans machine
(cours sans lab), qui sont listees comme telles et non comptees.

## Defauts reels trouves par cette preuve, et corriges

| Room | Ce qui etait faux | Correction |
| --- | --- | --- |
| `memoire-et-defenses` | la machine annoncee etait `/home/ctf/vuln` ; l'image `bin-01` ne contient que `/home/ctf/vulnerable` (le binaire setuid). L'apprenant etait envoye vers un fichier inexistant. | `default-content.php` pointe desormais vers `/home/ctf/vulnerable`, comme le contenu de reference et les indices de la room. |
| 27 rooms `univ-01` et `dojo-01` | ces machines de cours sont des machines **a lire des livrables** : elles n'embarquent aucun serveur web, alors que leur manifeste annonce `http://127.0.0.1:8080`. | mesure explicite : « l'image n'a aucun serveur web, rien ne peut ecouter » ; le manifeste reste a corriger cote contenu, ce document ne maquille pas le defaut. |
| `traverser-le-mur` (pile `net-01`) | le noeud `internal` est injoignable directement depuis `attacker` — ce n'est **pas** un defaut : c'est le pivot a comprendre. | verifie comme tel : le drapeau est sur `internal`, le service tourne, et la cible est joignable depuis `web`. |

Trois erreurs de la sonde elle-meme ont ete corrigees avant de conclure
(et sont documentees dans l'historique) : `sh` (dash) ne connait pas
`/dev/tcp`, Juice Shop n'affiche pas `SECURA{...}` mais une empreinte
HMAC-SHA1 valide, et l'absence de client HTTP dans une image n'est pas une
faute du lab.

## Les prototypes du ZIP : construits et demarres

`web-dvwa`, `secura-lab-blue-firewall`, `secura-lab-blue-log-analysis` et
`secura-lab-buffer-overflow` sont des **copies** (marquees comme telles dans
leur Dockerfile) de `multi-01` ou de `bin-01`. Le travail de recette les
construit et les demarre desormais, pour mesurer leur ecart au lieu de les
ignorer : `docker run` demarre, puis le contenu web est verifie.

## Ce qui n'est pas prouve ici

- Le **parcours complet de l'apprenant** (se connecter, lancer la machine,
  repondre, obtenir les points) n'est pas rejoue pour les 49 rooms : il est
  rejoue sur trois rooms representatives (`wp-e2e.php` et `scenario.py`).
  La preuve ci-dessus porte sur le contrat room/machine, pas sur l'UX.
- Les drapeaux de Juice Shop dependent de l'application OWASP : la preuve
  verifie que le fichier du serveur contient la bonne empreinte et que
  l'application repond, pas qu'un apprenant resout chaque defi.
- Les 3 rooms sans machine sont des cours sans lab : rien a prouver par une
  image.

## Repondre a « est-ce que je dois passer le CI a chaque essai ? »

Non. Deux chemins existent maintenant, et ils executent exactement le meme
code :

1. **Mesurer sans toucher au CI** — onglet *Actions* du depot, workflow
   **« Machines — mesurer sans lancer le CI »**, bouton *Run workflow*, en
   choisissant la branche. Il monte un vrai MySQL (conteneur), un vrai
   WordPress, construit les vraies images Docker et produit le rapport dans
   la branche `preuve-machines` (`docs/preuves/`). Il ne pousse rien dans la
   branche de travail et ne modifie pas la demande de fusion.
2. **Le CI, une seule fois, avant de fusionner** — le workflow
   *« WordPress — recette et compatibilité »* exécute la meme action
   `.github/actions/preuves-machines`, plus la matrice de compatibilite des
   plugins. C'est lui qui doit etre vert pour fusionner.

Les deux appellent la **meme** action composite : impossible que les deux
chemins divergent. Si le bouton dit OK et que le CI dit KO, c'est la
matrice de compatibilite (plugins tiers), pas les machines.

Ce qui n'est pas possible : supprimer totalement le CI par poussee tant que
la demande de fusion est ouverte, parce que la protection de branche de
`main` l'exige. Ce qui est possible, et fait ici : ne plus s'en servir comme
outil de mesure.
