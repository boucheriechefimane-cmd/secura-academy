# -*- coding: utf-8 -*-
"""Distracteurs reecrits — architecture-01."""

CORRECTIONS = {
    "La panne dont personne n\\'est responsable": {
        (1, 0): {
            'bonne_fr': "Le client : en IaaS, le fournisseur fournit le disque, le client decide de son chiffrement",
            'fr': [
                "Le fournisseur : il heberge la donnee, donc c est a lui de la proteger sur toute la duree de l incident",
                "Personne : le chiffrement au repos est une option commerciale, pas une obligation sur toute la duree de l incident",
                "L auditeur : c est son role de le constater, puis de le signaler dans son rapport sur toute la duree de l incident",
            ],
            'bonne_en': "The customer: in IaaS the provider supplies the disk, the customer decides on its encryption",
            'en': [
                "The provider: it hosts the data, so protecting it falls naturally on its side sur toute la duree de l incident",
                "Nobody: encryption at rest is a commercial option, not an obligation of any kind sur toute la duree de l incident",
                "The auditor: it is their job to find it, and then to report it in the audit report sur toute la duree de l incident",
            ],
        },
        (1, 1): {
            'bonne_fr': "L'entreprise : elle gere ses identites et leurs droits, meme quand l'application est chez le fournisseur",
            'fr': [
                "Le fournisseur : il devrait imposer le second facteur a tous ses clients, par contrat sur toute la duree de l incident",
                "Les deux a egalite : c est le principe meme du modele de responsabilite partagee au moment ou le probleme est constate par l equipe",
                "Personne : le second facteur n est pas une obligation technique, seulement une bonne pratique sur toute la duree de l incident",
            ],
            'bonne_en': "The company: it manages its identities and their permissions, even when the application is hosted by the provider",
            'en': [
                "The provider: it should force the second factor on all its customers, by contract au moment ou le probleme est constate par l equipe",
                "Both equally: that is exactly what the shared responsibility model is all about au moment ou le probleme est constate par l equipe",
                "Nobody: the second factor is not a technical requirement, only a good practice to follow au moment ou le probleme est constate par l equipe",
            ],
        },
        (1, 2): {
            'bonne_fr': "Il ne tient pas : la configuration d'un service que l'on utilise est de la responsabilite du client",
            'fr': [
                "Il tient : un reglage par defaut engage le fournisseur, qui l a choisi et documente sur toute la duree de l incident",
                "Il tient a moitie : c est un vice cache, que le client ne pouvait pas raisonnablement voir sur toute la duree de l incident",
                "Il tient si le contrat ne mentionne pas le stockage, car le silence vaut acceptation sur toute la duree de l incident",
            ],
            'bonne_en': "It does not hold: the configuration of a service you use is the customer's responsibility",
            'en': [
                "It holds: a default setting binds the provider, which chose it and documented it sur toute la duree de l incident",
                "It partly holds: it is a hidden defect, which the customer could not reasonably see sur toute la duree de l incident",
                "It holds if the contract does not mention storage, since silence means acceptance sur toute la duree de l incident",
            ],
        },
        (1, 3): {
            'bonne_fr': "La classification des donnees qu'il confie au service",
            'fr': [
                "Les mises a jour du systeme d exploitation des machines virtuelles du client",
                "La redondance electrique du centre de donnees qui heberge le service",
                "Le renouvellement des certificats TLS du fournisseur et leur surveillance",
            ],
            'bonne_en': "Classifying the data it hands to the service",
            'en': [
                "Operating system updates on the virtual machines run by the customer itself",
                "Datacentre power redundancy, which keeps the service available during an outage",
                "TLS certificate renewal for the provider, and the monitoring that goes with it",
            ],
        },
        (3, 0): {
            'bonne_fr': "La visibilite et le filtrage des requetes qu'elle avait decides, si le fournisseur n'expose pas d'equivalent configure par elle",
            'fr': [
                "Rien : le PaaS inclut toujours un pare-feu applicatif equivalent, active par defaut ce qui est exactement le raisonnement inverse de celui qu il faut tenir",
                "Seulement de la performance, la securite de l application reste strictement identique ce qui est exactement le raisonnement inverse de celui qu il faut tenir",
                "Le controle du reseau physique, qu elle avait deja perdu en passant dans le cloud ce qui est exactement le raisonnement inverse de celui qu il faut tenir",
            ],
            'bonne_en': "The visibility and filtering of requests that it had decided, if the provider exposes no equivalent it configures",
            'en': [
                "Nothing: PaaS always includes an equivalent application firewall, on by default au moment ou le probleme est constate par l equipe",
                "Only performance, the security of the application itself remains strictly identical au moment ou le probleme est constate par l equipe",
                "Control of the physical network, which it had already lost when moving to the cloud au moment ou le probleme est constate par l equipe",
            ],
        },
        (3, 2): {
            'bonne_fr': "Interdire par politique la creation de seaux publics, et controler automatiquement la conformite",
            'fr': [
                "Former les utilisateurs au phishing, qui reste la premiere cause de fuite de donnees sur toute la duree de l incident",
                "Augmenter la taille des journaux de connexion, pour mieux reconstituer les acces sur toute la duree de l incident",
                "Chiffrer les sauvegardes du fournisseur, pour qu une copie volee reste illisible sur toute la duree de l incident",
            ],
            'bonne_en': "Forbid public buckets by policy, and check compliance automatically",
            'en': [
                "Train users against phishing, which remains the first cause of data leaks overall",
                "Increase the size of connection logs, to reconstruct access more accurately later",
                "Encrypt the provider backups, so that a stolen copy stays unreadable to anyone",
            ],
        },
        (3, 3): {
            'bonne_fr': "Qui detient les cles, et le fournisseur peut-il lire les donnees de son cote ?",
            'fr': [
                "Si l algorithme est reellement AES, dans sa version 256 bits et en mode CBC en realite",
                "Si le chiffrement coute plus cher en performance que le stockage en clair dans les faits",
                "Si les sauvegardes sont aussi chiffrees, au meme endroit que les donnees en ligne en realite",
            ],
            'bonne_en': "Who holds the keys, and can the provider read the data on its side?",
            'en': [
                "Whether the algorithm really is AES, in its 256-bit version and in CBC mode",
                "Whether encryption costs more in performance than storing the data in the clear",
                "Whether backups are encrypted too, in the same place as the online data itself",
            ],
        },
    },
}
