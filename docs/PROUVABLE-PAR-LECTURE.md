# Ce qu'un drapeau prouve, et ce qu'il ne prouve pas

Ce document répond à une objection précise : *un drapeau **lu** sur la machine
n'est pas encore un drapeau **produit** par une manipulation.* Cette nuance
n'est pas théorique, elle a fait changer deux fois le chiffre annoncé pour le
même parc de 60 défis. Voici la règle, écrite noir sur blanc, et la mesure qui
l'applique.

## Les trois situations, et ce qu'elles valent

| Situation | Ce que fait l'élève | Ce que ça prouve |
|---|---|---|
| **La valeur est écrite dans un document** | `cat document.txt`, il recopie | **Rien.** Il a su lire un fichier. C'est le défaut corrigé le 6 novembre 2026 sur 15 des 22 drapeaux de `univ-01` |
| **La valeur est sur la machine, hors document** | il la trouve en explorant (`/root/flags` en 400, un binaire, une base) | **Une exploration.** Mieux, mais si la valeur est un petit nombre ou un mot courant, il peut la deviner |
| **La valeur est le résultat d'un calcul** | il exécute une commande dont la sortie **est** la valeur | **La manipulation.** Il ne peut pas l'écrire sans avoir fait tourner la commande |

## La règle appliquée par `drapeaux-lisibles.php`

Le contrôle fait deux choses, dans cet ordre.

1. **Il cherche la valeur dans les documents.** 65 documents installés par les
   machines (`labs/*/cours/**`, `labs/*/notes/*.txt`) sont ouverts, et la valeur
   de chaque drapeau y est cherchée **sur la même machine seulement** (un
   drapeau du dojo n'a rien à voir avec un document de `univ-01`, et une
   coïncidence de valeur n'est pas une fuite pédagogique).
2. **Il juge la force de la valeur elle-même.** Une valeur de 8 caractères ou
   plus, ou une empreinte hexadécimale, est **prouvée** : personne ne la trouve
   par hasard. Un nombre de 1 à 3 chiffres, ou un mot du vocabulaire courant,
   est **devinable** : le drapeau peut être validé sans avoir rien fait.

Le second point est celui qui manquait. Un drapeau bien caché mais dont la
valeur est « 9 » ne prouve rien : on essaie les dix chiffres.

## Les exceptions, déclarées plutôt que maquillées

Deux valeurs sont courtes **par nature**, et les rallonger détruirait la leçon :

| Drapeau | Valeur | Pourquoi elle reste courte |
|---|---|---|
| S'authentifier (univ-08) | `auth_3` | La room demande **combien** de comptes la politique protège. La réponse est 3, et 3 est la bonne réponse. La valeur n'est pas un secret, c'est un comptage (`tail -n +2 \| wc -l`) |
| x86 et mémoire (univ-10) | `pile_40` | L'offset vaut 32 octets de tampon + 8 octets de canari = 40. C'est l'arithmétique même de la leçon |

Elles sont inscrites dans `tools/controle/drapeaux-devinables.json` **avec leur
raison**. Le contrôle échoue si une valeur courte n'y est pas déclarée, et
échoue aussi si une déclaration ne correspond plus à rien (valeur changée ou
drapeau disparu). C'est le point important : on ne rallonge pas une valeur pour
faire passer un chiffre, on dit pourquoi elle est courte.

## La preuve qui manque encore à ce contrôle

Ce contrôle lit des fichiers. Il ne fait pas tourner les commandes. Deux
propriétés différentes sont donc mesurées par deux outils :

- **aucune copie possible** → `tools/controle/drapeaux-lisibles.php` (statique) ;
- **la commande produit bien le drapeau** → `tools/labs/epreuves-univ.py` et
  `tools/labs/epreuves-dojo.py`, joués **dans la machine**, par le workflow
  `Machines`.

Un contrôle sans l'autre laisse passer la moitié du défaut : le premier ne voit
pas une commande cassée, le second ne voit pas une valeur recopiée ailleurs.
Les deux tournent à chaque `push` qui touche `labs/`.

## Ce que ce document ne prétend pas

Il ne dit pas qu'un drapeau produit est un bon exercice. Un élève peut suivre
la commande du hint sans comprendre ce qu'il fait. Ce que le drapeau garantit,
c'est le **geste** : la commande a été jouée, la sortie a été lue. La
compréhension, elle, se mesure par l'examen de fin de room et par les questions
d'application, pas par le drapeau.
