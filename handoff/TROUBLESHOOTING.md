# Dépannage

## HTTP 0 ou pages inaccessibles pendant les audits

Vérifiez que le site de test répond à l'URL effectivement configurée dans
WordPress, que WP-CLI et le serveur HTTP utilisent le même chemin (avec ou sans
`/wp/`), et que le thème et les feuilles de style sont accessibles. Un audit
sans accès aux pages ne démontre pas la conformité : corrigez l'environnement
et relancez-le.

## CI GitHub ne démarre pas

Consultez le détail de la tentative et les quotas/facturation du compte. Ne
changez pas la visibilité du dépôt comme remède automatique. En attendant,
lancez les tests locaux documentés dans [`DEVELOPMENT.md`](DEVELOPMENT.md) et
indiquez clairement ce qui n'a pas pu être vérifié.

## Import de questions refusé

Lisez le message de l'importateur et les règles de
`docs/IMPORTER-QUESTIONS.md`. Une réponse libre (`text`) nécessite des
réponses acceptées ; ne la convertissez pas automatiquement depuis une
correction rédigée. Le lot MIT 18.024 du dépôt conserve ses 33 questions :
leur pertinence pédagogique doit être revue séparément.

## Écarts SEO ou données structurées

Comparez le HTML réellement servi et le JSON-LD sur un site accessible ; ne
classez pas automatiquement un écart comme artefact d'environnement. Les
constats et limites de la campagne du 04/11 sont dans le rapport d'audit.
