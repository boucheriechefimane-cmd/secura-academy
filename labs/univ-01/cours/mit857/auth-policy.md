Politique d'authentification - services du laboratoire
(cours 6.857 - Network and Computer Security)

Regles de base
--------------
    longueur_minimale          = 14
    min_length                 = FLAG=SECURA{mot_de_passe_long}
    reutilisation_interdite     = oui
    second_facteur              = obligatoire sur les comptes d'administration
    tentatives_avant_blocage   = 5
    duree_session              = 30 minutes
    deconnexion_de_tous_les_appareils = possible

Mots de passe
--------------
Le service refuse les mots de passe issus des listes connues (mots de
passe les plus utilises, dates, numeros de telephone) et encourage les
phrases de plusieurs mots.

Second facteur
--------------
- Application d'authentification (preferee)
- Code par SMS (tolere, moins robuste)
- Question secrete : refusee, ce n'est pas une autre categorie de preuve.

Journalisation
--------------
Toutes les tentatives (reussies ou non) sont tracees dans le journal du
service d'authentification.
