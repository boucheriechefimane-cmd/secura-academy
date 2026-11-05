# Machines et prototypes du ZIP

Les machines déjà référencées par le plugin restent celles du dépôt :
`web-01`, `bin-01`, `multi-01`, `internal-01`, `univ-01`, `dojo-01` et
les piles `net-01` et `juice-shop`. Les drapeaux pédagogiques suivis par Git
sont des valeurs d'exercice publiques, **pas des secrets**. Les drapeaux
copiés par le ZIP dans des machines qui ne les utilisaient pas ont été
retirés : ils pouvaient mélanger les scénarios et le dojo ne contenait plus
ses 27 drapeaux attendus.

Les quatre dossiers supplémentaires du ZIP sont conservés pour inspection,
**pas comme nouvelles machines prêtes à déployer** :

- `web-dvwa/`, `secura-lab-blue-firewall/` et
  `secura-lab-blue-log-analysis/` sont des copies de `multi-01` ; ce ne sont
  pas respectivement DVWA, un exercice de pare-feu ou d'analyse de logs.
- `secura-lab-buffer-overflow/` est une copie de `bin-01`. Son fichier
  `flag/flag.txt` est une valeur d'exercice nécessaire à la construction.

Les recettes expérimentales distinctes sous `tools/labs/images/` n'ont pas
été construites ni testées. Aucun nouveau mapping des rooms n'est appliqué.
Ne pas exposer les applications volontairement vulnérables sur Internet ;
utiliser un environnement isolé et valider chaque image avec Docker avant
usage. Les recettes et tests Docker existants sont décrits dans
`docs/LABS-AVANCES.md` et `scripts/test-labs-ci.sh`.
