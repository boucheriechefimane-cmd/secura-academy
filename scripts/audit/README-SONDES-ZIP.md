# Sondes de contenu issues du ZIP

`probe-contenu.php` et `mesure-contenu.php` s'exécutent avec WP-CLI sur un
WordPress de test, par exemple `wp eval-file scripts/audit/probe-contenu.php`.
Elles produisent du JSON et ne modifient pas le site. La recette sur WordPress
réel reste à faire ; elles ne remplacent pas les 18 audits ni une vérification
humaine.

Leurs marqueurs de langue, vidéo, terminal et licence sont des **indices
textuels**, pas des mesures exhaustives : aucun verdict juridique ou de
conformité ne peut en être déduit. Dans `mesure-contenu.php`, les décomptes
de questions « sans indice anglais » ne signifient pas « en français », et les
« indices hors cyber » nécessitent une lecture humaine. La classification
maison/importée utilise l'absence ou la présence du champ `licence` sur les
questions de tâches ; la réserve est comptée séparément. L'existence d'un
examen est déduite d'une tâche de type `exam`, pas d'une réserve de questions.
Le nombre d'examens chronométrés est `null` : il n'est pas mesuré.

Un contrôle simulé des principaux décomptes et des sections de parcours est
exécutable avec `php tests/sondes-contenu-test.php` ; il ne constitue pas une
recette WordPress.
