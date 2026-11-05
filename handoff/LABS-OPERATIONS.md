# Opérations des labs Docker

Les applications des labs sont **volontairement vulnérables**. Travaillez sur
une infrastructure isolée et autorisée ; ne les publiez pas sur Internet.
Le moteur existant du plugin utilise des limites et des réseaux dédiés ; il
faut les vérifier lors d'une recette sur de vrais conteneurs.

## Inventaire

Lisez [`labs/README.md`](../labs/README.md) pour distinguer les machines
existantes des quatre dossiers supplémentaires issus du ZIP. Trois de ces
répertoires sont des copies de `multi-01` et ne prouvent pas que DVWA ou les
labs Blue sont implémentés ; le quatrième copie `bin-01`. Les recettes sous
`tools/labs/images/` sont expérimentales et non validées.

Les fichiers de drapeaux suivis sont des **valeurs pédagogiques publiques**,
pas des secrets. Ne recopiez pas les drapeaux de tous les scénarios dans
toutes les machines : conservez les correspondances nécessaires à chaque lab.
La pile Juice Shop conservée est `labs/juice-shop/docker-compose.yml`, avec
l'image officielle et le service de drapeaux du dépôt.

## Vérification sur une machine Docker de test

Consultez `scripts/test-labs-ci.sh` et `.github/workflows/labs.yml` avant de
lancer une construction. Ces tests manipulent réseaux et conteneurs Docker et
requièrent des images préalablement construites. Vérifiez l'isolation entre
apprenants, l'absence de sortie Internet, les limites de ressources, la
suppression des conteneurs et les drapeaux sur une installation jetable.

Les tests Docker n'ont pas été exécutés pendant la présente fusion.
