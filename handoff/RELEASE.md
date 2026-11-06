# Préparer une release

## Construire les archives

Depuis la racine du dépôt, choisissez un dossier de sortie hors de Git :

```bash
bash scripts/build-archives.sh /chemin/vers/archives-test
```

Le script produit les archives plugin, WordPress, thème, labs et recette.
Vérifiez leur intégrité et leur contenu, dont les licences et les fichiers
requis par les Dockerfiles. Une archive présente ne prouve pas qu'elle a été
testée en situation réelle.

## Avant toute livraison

- Exécuter les cinq suites locales et les audits sur WordPress réel ; traiter
  les constats graves et les échecs non étayés.
- Tester les images Docker et l'isolation dans un environnement jetable.
- Vérifier les droits des contenus tiers et les licences vidéo.
- Vérifier les versions dans les en-têtes du plugin et du thème et les
  constantes correspondantes ; documenter les modifications.
- Sauvegarder et disposer d'une procédure de retour arrière vérifiée.
- Obtenir un accord explicite avant toute mise en production.

Ne supprimez un environnement de test, ses volumes ou sa base qu'après en avoir
vérifié le périmètre et l'absence de données à conserver.
