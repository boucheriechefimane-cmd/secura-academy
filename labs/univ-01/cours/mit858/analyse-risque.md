# Analyse de risque - cours 6.858 (Computer Systems Security)

Document de travail du semestre, ecrit par l'equipe securite du laboratoire.

## Actifs protects
- Base de donnees des eleves (nom, identifiant, notes)
- Cle de signature du service de publication
- Journal d'audit du service d'authentification

## Adversaires consideres
- Un attaquant externe qui decouvre un service expose
- Un compte de service compromis sur la zone interne
- Une personne non autorisee qui lit les logs par erreur

## Regles (politique de securite)
1. Seul le service de comptage lit la base des eleves.
2. Seuls les administrateurs modifient la configuration.
3. Toute tentative de connexion refusee doit etre tracee.

## Conclusion - risque critique

Le risque critique identifie par l'equipe est celui qui casse la regle 1 :
une requete non verifiee qui permet de lire la base depuis la zone publique.
La valeur de reference retenue pour ce risque est :

    risque_critique = FLAG=SECURA{modele_de_menace}

Toute modification de ce document doit etre reflechie dans le tableau de bord
de l'equipe avant la revue de securite du mois prochain.
