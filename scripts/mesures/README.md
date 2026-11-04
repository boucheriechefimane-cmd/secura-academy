# Les mesures du bac a sable

Ces scripts ne sont pas des tests : ils **comparent**. Ils repondent a
une seule question, a chaque fois la meme : « la plateforme est-elle
telle qu'on la pretend ? ».

Ils se lancent dans un WordPress local (le bac a sable de developpement),
en pointant `SECURA_WP_DIR` vers la racine de l'installation :

    SECA_WP_DIR=/chemin/vers/wp php scripts/mesures/mesure-apres.php

| Script | Ce qu'il mesure |
|---|---|
| `mesure-apres.php` | le bilan global : questions maison, questions importees en reserve, questions importees glissees dans une tache (doit etre **0**), taille de la copie servie |
| `mesure-test.php` | la taille de la copie de test servie a l'eleve (mediane, max, min) |
| `mesure-maison-import.php` | la repartition maison / import, room par room |
| `mesure-alignement.php` | l'alignement entre la copie servie et la question brute |
| `mesure-deverrouillage.php` | le nombre de taches bloquees et le nombre de taches debloquees |
| `empreinte-reservoir.php` | l'empreinte de chaque reservoir, pour prouver qu'un import n'a pas change le contenu |
| `empreinte-questions.php` | l'empreinte des questions normalisees, tache par tache : apres une correction, seule la TAILLE de la tache « test » doit avoir change, le contenu doit etre identique |

La regle : **une mesure se compare a la mesure d'avant**. Les empreintes
(`empreinte-reservoir.php`) ont existe pour prouver que la separation
« examen d'universite en reserve » n'avait rien change au contenu des
reservoirs.

Ces deux empreintes se combinent : l'une dit « le reservoir est intact »,
l'autre dit « les questions servies sont intactes ». Une correction qui
deplace une question d'une room a l'autre change les deux — c'est
exactement ce qu'on veut voir.
