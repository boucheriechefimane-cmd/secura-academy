# Prototypes du ZIP — non chargés

Les classes `class-secura-exam-timed.php`, `class-secura-certificate.php`,
`class-secura-exam-front.php` et `class-secura-lab-front.php`, ainsi que
`js/exam-front.js` et `js/lab-front.js`, sont conservées pour revue. Elles ne
sont **pas chargées par le plugin**, leurs nouveaux points d'entrée AJAX ne
sont pas enregistrés, et les shortcodes expérimentaux ne sont pas disponibles.
Ne pas les inclure manuellement en production. Le moteur d'examen et les
points d'entrée préexistants restent inchangés.

La revue de fusion a relevé notamment :

- Le front d'examen appelle un point de départ préexistant avec un contrat
  différent et une action de réponse non enregistrée ; sa soumission utilise
  une variable JavaScript non définie.
- Le moteur expérimental renvoie des données contenant les réponses et
  explications et ne traite pas tous les modes de questions de la réserve.
- Le front de lab utilise un nonce différent de celui vérifié par l'API.
- Les certificats sont écrits dans un dossier d'uploads accessible publiquement
  avec des informations personnelles ; le PDF généré doit aussi être validé.

Avant toute activation : revoir les contrats AJAX et le contrôle des réponses,
protéger les données et l'accès aux certificats, puis couvrir les parcours
complets avec des tests automatisés et une recette sur WordPress réel. Les
scripts de test du ZIP ciblent ces prototypes et ne prouvent pas leur
fonctionnement dans l'état actuel ; ils ne sont pas intégrés au dépôt.
