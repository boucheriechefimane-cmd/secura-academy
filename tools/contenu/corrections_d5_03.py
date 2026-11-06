# -*- coding: utf-8 -*-
"""Distracteurs reecrits — gouvernance-03 « L'audit qui ne trouve rien ».

Les longueurs sont verifiees par `reequilibre_qcm.py --verifie` : chaque
leurre doit depasser la bonne reponse de 8 % au moins, de 90 % au plus.
"""

CORRECTIONS = {
    "L\\'audit qui ne trouve rien": {

        # --- Task 2 : trois constats d'audit a juger ------------------------
        (1, 0): {
            'bonne_fr': "Le compte de M. A. etait actif le 14/09, 40 jours apres son depart, alors que la procedure impose 24 h",
            'fr': [
                "La gestion des comptes est globalement satisfaisante, malgre quelques retards sans consequence releves en fin d annee",
                "L equipe informatique doit etre plus vigilante a l avenir, c est d abord un probleme de culture et de priorisation",
                "Aucun ecart n a ete releve sur le perimetre etudie, le dispositif peut donc etre considere comme conforme aux exigences",
            ],
            'bonne_en': "M. A.\\'s account was active on 14/09, 40 days after departure, while the procedure requires 24 h",
            'en': [
                "Account management is broadly satisfactory, despite a few delays with no real consequence for the business",
                "The IT team must be more vigilant in future, this is first of all a culture and prioritisation problem for the whole company",
                "No findings were raised within the scope studied, so the whole process may be deemed fully compliant with the standard",
            ],
        },
        (1, 1): {
            'bonne_fr': "Le perimetre a ete choisi par la personne auditée",
            'fr': [
                "Rien : le perimetre a ete valide en comite, et l audite n a fait que confirmer ce cadre",
                "Le systeme de facturation n a aucun lien avec la securite, l exclure est technique",
                "Un audit doit toujours exclure les systemes financiers, leurs donnees sont trop sensibles",
            ],
            'bonne_en': "The scope was chosen by the audited party",
            'en': [
                "Nothing: the scope was approved in committee, the auditee just confirmed it",
                "The billing system has no link with security, excluding it is technical",
                "An audit must always exclude financial systems, which are too sensitive",
            ],
        },
        (1, 2): {
            'bonne_fr': "Un journal systeme horodate, consulte directement sur la machine",
            'fr': [
                "Une procedure signee par le responsable securite, qui atteste la mise en oeuvre du controle",
                "Une presentation de 30 pages sur les bonnes pratiques, remise lors du dernier comite",
                "Une attestation du fournisseur affirmant la conformite de sa plateforme au referentiel",
            ],
            'bonne_en': "A timestamped system log, read directly on the machine",
            'en': [
                "A procedure signed by the security manager, certifying that the control is in place",
                "A 30-page presentation on good practice, handed out at the last steering committee",
                "A vendor statement asserting that its platform meets the requirements of the standard",
            ],
        },

        # --- Task 4 : examen -----------------------------------------------
        (3, 0): {
            'bonne_fr': "Le perimetre, la nature des preuves et l independance de l auditeur",
            'fr': [
                "La mise en page et la clarte du rapport, qui conditionnent la lecture par le comite",
                "Le nombre de pages, qui doit etre suffisant pour couvrir les 40 risques du registre",
                "Le prix de la prestation d audit, qui doit rester proportionne au perimetre retenu",
            ],
            'bonne_en': "The scope, the nature of the evidence and the auditor\\'s independence",
            'en': [
                "The layout and clarity of the report, which decide how the committee reads it",
                "The page count, which must be sufficient to cover all 40 risks in the register",
                "The price of the audit engagement, which must stay proportionate to the scope",
            ],
        },
        (3, 1): {
            'bonne_fr': "L interne vise a corriger, le second a obtenir une reconnaissance par un tiers",
            'fr': [
                "L interne est moins fiable par nature, puisqu il est mene par des gens de la maison, sans recul",
                "Le second ne regarde jamais les preuves techniques, il ne juge que les documents et les procedures",
                "L interne est reserve aux grandes entreprises, les autres n ont ni les moyens ni les equipes",
            ],
            'bonne_en': "The internal one aims to fix, the second to obtain third-party recognition",
            'en': [
                "The internal one is unreliable by nature, since it is run by people from the house, with no distance at all",
                "The second never looks at technical evidence, it only judges paperwork and written procedures as filed",
                "The internal one is reserved for large companies, the others have neither the budget nor the teams for it",
            ],
        },
        (3, 2): {
            'bonne_fr': "L audit s est appuye sur une declaration au lieu de constater le fait",
            'fr': [
                "Le journal est faux, puisqu il contredit un document officiel signe par la DRH le jour meme",
                "La DRH doit etre sanctionnee avant toute autre action, la faute est etablie et connue de tous",
                "Il s agit d un faux positif sans consequence, les deux documents peuvent parfaitement coexister",
            ],
            'bonne_en': "The audit relied on a declaration instead of observing the fact",
            'en': [
                "The log is wrong, since it contradicts an official document signed by HR",
                "HR must be sanctioned before any other action, the fault has been established",
                "It is a harmless false positive, the two documents can perfectly coexist",
            ],
        },
        (3, 3): {
            'bonne_fr': "Un ecart situe dans le temps, rattache a une exigence, avec une criticite",
            'fr': [
                "Une appreciation generale sur la culture de securite, qui situe le niveau de l organisation",
                "Une liste d outils recommandes pour l annee suivante, avec un ordre de priorite",
                "Un rappel des obligations legales applicables, sans constat precis sur le perimetre",
            ],
            'bonne_en': "A gap situated in time, tied to a requirement, with a severity",
            'en': [
                "A general remark about security culture, which situates the level of the organisation",
                "A list of recommended tools for next year, with an order of priority for buying them",
                "A reminder of the legal obligations that apply, with no specific finding on the scope",
            ],
        },
    },
}
