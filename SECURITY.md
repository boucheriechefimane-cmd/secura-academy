# Politique de sécurité

## Signaler une vulnérabilité

Ne publiez pas de détail exploitable, d'identifiant, de donnée personnelle ou de
preuve d'exploitation dans une issue ou une pull request publique. Demandez
plutôt un canal privé au responsable du dépôt.

Le signalement privé GitHub doit être activé par un administrateur dans les
paramètres de sécurité du dépôt. **Il n'était pas activé lors de la rédaction de
cette politique.** Une fois activé, utilisez la page
[Security Advisories](https://github.com/boucheriechefimane-cmd/secura-academy/security/advisories)
et le bouton « Report a vulnerability ». Tant que le bouton n'est pas
proposé, demandez un contact privé aux responsables, sans publier les détails
de la faille. Ne considérez pas ce canal comme opérationnel avant son activation.

Pour faciliter l'analyse privée, fournissez la version ou le commit concerné,
les conditions nécessaires, l'impact et des étapes de reproduction minimales.
Ne joignez pas de données d'élèves ou de secrets réels. Les délais de réponse
et la liste des versions prises en charge restent à définir par le responsable
du projet ; cette politique ne constitue pas une garantie de délai.

## Périmètre et précautions

Le plugin, le thème, les outils de déploiement et l'isolation des laboratoires
font partie du périmètre. Les exercices des dossiers `labs/` contiennent
**volontairement des applications vulnérables** : leurs failles pédagogiques
connues ne sont pas en elles-mêmes des vulnérabilités à publier comme telles.
En revanche, un défaut d'isolation, une exposition involontaire ou un accès
aux données d'un autre élève doivent être signalés.

Ne testez que des environnements que vous contrôlez ou pour lesquels vous avez
une autorisation explicite. Ne lancez pas les labs vulnérables sur Internet ;
utilisez une infrastructure isolée et des données fictives. Les dossiers de
prototypes du ZIP ne sont pas validés pour la production : voir
[`labs/README.md`](labs/README.md).
