# Analyse de risque - cours 6.858 (Computer Systems Security)

Document de travail du semestre, ecrit par l'equipe securite du laboratoire.
L'empreinte de la room resume CE document : sa valeur est le sha256 de ce
fichier, tronque a ses 8 premiers caracteres.

    sha256sum /srv/cours/mit858/analyse-risque.md | cut -c1-8

## Actifs proteges
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