# La récolte OCW du 04/11/2026 — 430 cours analysés, 66 réutilisables

> Ce document est la **liste de travail** issue du criblage automatique.
> Source brute : `docs/recolte/criblage-ocw-2026-11-04.json` (archivé depuis l'artefact de la CI).
> Run de validation : **`41753782904`** (`completed success`) — six robots + fusion.

## Ce que le moteur a fait

| Étape | Mesure |
|---|---|
| Cours listés par le sitemap OCW | **2 587** |
| Cours analysés (numéros 6.\*, 18.\*, 3.\*) | **430** |
| Avec un corrigé **et** une licence Creative Commons | **66** |
| Dont numéro de cours **jamais vu** jusqu'ici | **55** |
| Documents téléchargés (9 cours, en parallèle) | **615 en 104 s** |

Le signal du corrigé est lu **dans le nom du fichier** (`_sol`, `_soln`, `_solution`, `Answers`, `key`) :
c'est le seul endroit fiable. La licence est lue dans le pied de page de la page OCW
(`creativecommons.org/licenses/by-nc-sa/4.0`).

## Les 55 numéros jamais vus

Les cours déjà au catalogue (32 sources) sont ici : **6.005**, **6.006**, **6.010 / 6.01SC**,
**6.046J**, **6.172**, **6.830**, **6.867**, **18.404J**, **18.435J**, **6.867**, **6.041SC**…
Les 55 ci-dessous sont **nouveaux** et attendent leur extracteur.

### Priorité informatique et sécurité (à extraire en premier)

| Cours | Sujet | Documents |
|---|---|---|
| 6.034 | Artificial Intelligence | 4 |
| 6.035 | Computer Language Engineering | 5 |
| 6.042J | Mathematics for Computer Science | 6 |
| 6.825 | Techniques in Artificial Intelligence (SMA-5504) | 5 |
| 6.830 | Database Systems | 4 |
| 6.867 | Machine Learning | 28 |
| 18.404J | Theory of Computation | 8 |
| 6.006 | Introduction to Algorithms (2008 / 2011 / 2020) | 20 / 6 / 2 |
| 6.046J | Design and Analysis of Algorithms (SMA-5503, Spring 2012) | 11 / 13 |
| 6.01SC | Introduction to EECS | 30 |
| 6.189 | Multicore Programming Primer | 12 |
| 6.004 | Computation Structures | 9 |

### Priorité secondaire (mathématiques, physique, matériaux — hors périmètre cyber)

`18.024`, `18.03`, `18.034`, `18.04`, `18.05`, `18.06`, `18.075`, `18.085`, `18.086`, `18.102`,
`18.366`, `18.440`, `18.443`, `18.600`, `18.786`, `18.966`, `3.00`, `3.012`, `3.034`, `3.052`,
`3.091SC`, `3.15`, `3.205`, `3.21`, `3.22`, `3.40J`, `6.003`, `6.011`, `6.012` (×2), `6.013`,
`6.041` (×3), `6.061`, `6.111`, `6.152J`, `6.241J`, `6.253`, `6.262`, `6.341`, `6.450`,
`6.641` (×2), `6.642`, `6.661`, `6.7220J`, `6.832`, `6.973`.

## Rappel des règles appliquées

- **Jamais de réécriture** : seul est admis un examen validé par une université ou une certification.
- **Attribution obligatoire** de la source **du test ET du cours**.
- **Licence absente** ⇒ signalée honnêtement, ce n'est pas un motif de refus automatique.
- Le site reste **gratuit à jamais** : les licences **NC** (non commercial) sont utilisables.
- **Une seule bonne réponse** par question : un corrigé nommant plusieurs bonnes réponses ⇒
  le format change (rédaction) ou la question est refusée — jamais une réponse inventée.

## Relancer le criblage

```bash
# un sixième du catalogue
python3 tools/criblage-ocw.py --shard 0/6 --sortie rapports/rapport-robot-0.json
# la fusion des six
python3 tools/criblage-ocw.py --fusion rapports/rapport-*.json --sortie rapports/criblage-ocw.json
```

La fusion accepte un motif `rapports/**/rapport-*.json` (développé récursivement) **ou** des
chemins explicites, et **échoue bruyamment** si aucun rapport n'est trouvé.
