# Machines et prototypes du ZIP

Les machines déjà référencées par le plugin restent celles du dépôt :
`web-01`, `bin-01`, `multi-01`, `internal-01`, `univ-01`, `dojo-01` et
les piles `net-01` et `juice-shop`. Les drapeaux pédagogiques suivis par Git
sont des valeurs d'exercice publiques, **pas des secrets**. Les drapeaux
copiés par le ZIP dans des machines qui ne les utilisaient pas ont été
retirés : ils pouvaient mélanger les scénarios et le dojo ne contenait plus
ses 27 drapeaux attendus.

Les quatre dossiers supplémentaires du ZIP ont été **supprimés** le
6 novembre 2026, et non pas conservés « pour inspection » :

- `web-dvwa/`, `secura-lab-blue-firewall/` et
  `secura-lab-blue-log-analysis/` étaient des copies de `multi-01` ; ce
  n'étaient ni DVWA, ni un exercice de pare-feu, ni un exercice d'analyse
  de logs. Le nom promettait quatre scénarios, le contenu en livrait zéro.
- `secura-lab-buffer-overflow/` était une copie de `bin-01`, avec en plus
  la même dépendance setuid que `bin-01` abandonne, et un `gets()` qui ne
  se compile plus sur une glibc récente : cette machine ne se construisait
  pas.

Les garder « pour inspection » n'avait qu'un effet mesurable : gonfler le
catalogue et faire dire au workflow qu'il construisait dix machines. Il en
construit six, qui sont celles que les rooms utilisent vraiment.

Les recettes expérimentales distinctes sous `tools/labs/images/` n'ont pas
été construites ni testées. Aucun nouveau mapping des rooms n'est appliqué.
Ne pas exposer les applications volontairement vulnérables sur Internet ;
utiliser un environnement isolé et valider chaque image avec Docker avant
usage. Les recettes et tests Docker existants sont décrits dans
`docs/LABS-AVANCES.md` et `scripts/test-labs-ci.sh`.
