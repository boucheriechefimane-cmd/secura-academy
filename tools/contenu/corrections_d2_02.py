# -*- coding: utf-8 -*-
"""Distracteurs reecrits — menaces-02."""

CORRECTIONS = {
    "La connexion de trois heures du matin": {
        (1, 0): {
            'bonne_fr': "Une vulnerabilite : cela ne prouve pas qu'un evenement a eu lieu",
            'fr': [
                "Un indicateur de compromission : le serveur est compromis, c est certain",
                "Un artefact : c est normal, les serveurs se connectent la nuit pour les sauvegardes",
                "Une attaque en cours, qu il faut interrompre tout de suite en coupant le reseau",
            ],
            'bonne_en': "A vulnerability: it does not prove that any event took place",
            'en': [
                "An indicator of compromise: the server is compromised, that much is certain",
                "An artefact: it is normal, servers connect at night to run their backups",
                "An attack in progress, which must be stopped at once by cutting the network",
            ],
        },
        (1, 2): {
            'bonne_fr': "Un indicateur de compromission : la sequence raconte une intrusion",
            'fr': [
                "Une vulnerabilite : le compte est mal configure, c est la cause du probleme",
                "Un artefact : les utilisateurs se trompent souvent de mot de passe, rien d anormal",
                "Trois evenements sans lien entre eux, que le hasard a reunis dans la meme heure",
            ],
            'bonne_en': "An indicator of compromise: the sequence tells an intrusion",
            'en': [
                "A vulnerability: the account is badly configured, which is the root cause here",
                "An artefact: users often mistype their password, and there is nothing unusual in it",
                "Three unrelated events, which chance happened to gather within the same hour",
            ],
        },
        (3, 0): {
            'bonne_fr': "La vulnerabilite est une condition, l'indicateur prouve qu'un evenement a eu lieu",
            'fr': [
                "La vulnerabilite est technique, l indicateur est humain : les deux mondes sont separes en realite",
                "L indicateur est plus grave parce qu il concerne les donnees et non le systeme dans les faits",
                "Les deux sont synonymes en pratique, seul le vocabulaire des editeurs change de bout en bout",
            ],
            'bonne_en': "A vulnerability is a condition; an indicator proves an event took place",
            'en': [
                "The vulnerability is technical, the indicator is human: two separate worlds en realite",
                "The indicator is more serious because it concerns data rather than the system en realite",
                "The two are synonyms in practice, only the vocabulary of the vendors changes en realite",
            ],
        },
        (3, 1): {
            'bonne_fr': "Pour distinguer une nouveaute d'un comportement normal deja observe",
            'fr': [
                "Pour accelerer la collecte des journaux, qui prend trop de temps chaque nuit",
                "Pour supprimer les faux positifs automatiquement, sans revue par un analyste",
                "Pour respecter une obligation legale de conservation des traces de connexion",
            ],
            'bonne_en': "To tell a novelty from behaviour already observed as normal",
            'en': [
                "To speed up log collection, which takes far too long every single night",
                "To remove false positives automatically, with no review by any analyst at all",
                "To meet a legal obligation to retain connection traces for a set period of time",
            ],
        },
        (3, 2): {
            'bonne_fr': "Collecter les preuves volatiles, puis isoler le poste",
            'fr': [
                "Eteindre le poste, puis enqueter sur le disque une fois la machine hors tension",
                "Reinstaller le poste, puis chercher la cause dans les journaux de l ancien systeme",
                "Changer le mot de passe, puis attendre de voir si la connexion revient cette nuit",
            ],
            'bonne_en': "Collect volatile evidence, then isolate the workstation",
            'en': [
                "Power it off, then investigate the disk once the machine is unplugged",
                "Reinstall the workstation, then look for the cause in the old system logs",
                "Change the password, then wait to see whether the connection comes back tonight",
            ],
        },
        (3, 3): {
            'bonne_fr': "Documenter le comportement comme normal et ajuster la regle d'alerte",
            'fr': [
                "Ouvrir un incident chaque nuit et le cloturer le matin, pour garder une trace",
                "Ignorer toutes les alertes nocturnes, elles sont fausses par construction en realite",
                "Eteindre le systeme de detection la nuit, pour ne plus etre reveille pour rien",
            ],
            'bonne_en': "Document the behaviour as normal and adjust the alert rule",
            'en': [
                "Open an incident every night and close it in the morning, to keep a trace",
                "Ignore every nocturnal alert, they are false by construction and by design",
                "Turn the detection system off at night, so that nobody is woken for nothing",
            ],
        },
    },
}
