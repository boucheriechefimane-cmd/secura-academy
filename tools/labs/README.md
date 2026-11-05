# Outillage de labs provenant du ZIP

Les recettes dans `images/` et les scripts de test sont des prototypes à
relire et à tester dans un environnement isolé ; ils ne constituent pas une
validation des labs ni une configuration de production. Voir `labs/README.md`.

Les deux scripts de réécriture automatique des questions ne sont pas intégrés :
ils créaient des QCM artificiels ou transformaient des réponses rédigées en
réponses exactes. Les lots validés du dépôt sont conservés.

L'orchestrateur expérimental, sa pile Compose et les scripts qui remappaient
les rooms ne sont pas intégrés : ils utilisaient un réseau partagé ou
publiaient des applications vulnérables sur toutes les interfaces, ou
écrasaient des configurations sans migration vérifiée. Les originaux restent
dans le ZIP source, pour une revue ultérieure. Le moteur existant du plugin
reste inchangé.
