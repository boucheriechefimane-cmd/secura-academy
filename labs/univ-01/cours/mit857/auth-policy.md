Politique d'authentification - services du laboratoire
(cours 6.857)

Regles de base
--------------
    longueur_minimale          = 14
    reutilisation_interdite     = oui
    second_facteur              = obligatoire sur les comptes d'administration
    tentatives_avant_blocage   = 5
    duree_session              = 30 minutes
    deconnexion_de_tous_les_appareils = possible

Ce que la politique protege : les comptes de service
---------------------------------------------------
La politique s'applique a tous les comptes. Leur nombre exact n'est pas
ecrit ici : il faut compter les lignes du fichier de comptes, en
ignorant la ligne d'en-tete.

    tail -n +2 /srv/cours/mit857/comptes.csv | wc -l

(Pour lire la commande : « tail -n +2 » saute la premiere ligne,
« wc -l » compte les lignes restantes.)