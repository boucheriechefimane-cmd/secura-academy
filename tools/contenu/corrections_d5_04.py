# -*- coding: utf-8 -*-
"""Distracteurs reecrits — gouvernance-04 « La campagne qui n'a rien appris »."""

CORRECTIONS = {
    "La campagne qui n\\'a rien appris a personne": {

        # --- Task 2 : trois rapports de campagne a lire --------------------
        (1, 0): {
            'bonne_fr': "Le signalement quasi nul est le vrai probleme : les gens ne cliquent plus, ils ne signalent pas",
            'fr': [
                "Le rapport est bon : le seuil fixe est respecte, la campagne est donc un succes sur le papier comme dans les faits",
                "Il faut abaisser le seuil a 5 % pour ameliorer le score, et communiquer largement sur cette belle progression",
                "Il faut renvoyer le meme message au meme groupe pour confirmer la baisse avant de tirer la moindre conclusion",
            ],
            'bonne_en': "The near-zero reporting rate is the real problem: people have stopped clicking, not started reporting",
            'en': [
                "The report is good: the fixed threshold is met, so the campaign is a success on paper and in the field alike",
                "The threshold should be lowered to 5% to improve the score, and the progress communicated widely to the whole board",
                "The same message should be sent again to the same group to confirm the drop before drawing any conclusion at all",
            ],
        },
        (1, 1): {
            'bonne_fr': "Le quiz mesurait la memoire, pas le comportement : la formation n etait pas concue pour changer un geste",
            'fr': [
                "Les 2 personnes en echec expliquent a elles seules l absence de progres constate sur le terrain cette annee encore",
                "Le taux de clic est une mesure peu fiable, il faudrait le supprimer et ne garder que le quiz final comme indicateur",
                "Il faut rendre le quiz plus difficile pour trier les meilleurs et valoriser la formation effectivement suivie par chacun",
            ],
            'bonne_en': "The quiz measured memory, not behaviour: the training was not designed to change a gesture",
            'en': [
                "The 2 failures explain the lack of progress on their own, the rest of the team is perfectly trained already",
                "The click rate is an unreliable measure and should be dropped, keeping only the final quiz as a measure",
                "The quiz should be made harder to sort out the best performers and give credit to the training itself",
            ],
        },
        (1, 2): {
            'bonne_fr': "La baisse ne prouve rien tant qu aucun signalement n est possible : on mesure une peur, pas une competence",
            'fr': [
                "La baisse de moitie en deux ans prouve l efficacite du programme, il n y a pas besoin d une autre mesure du tout pour le confirmer",
                "Il faut arreter la campagne : elle coute cher pour un resultat discutable, et plus personne ne la defend en interne aujourd hui",
                "Il faut ajouter un second fournisseur de simulation pour varier les messages et eviter la lassitude des equipes sur deux ans",
            ],
            'bonne_en': "The drop proves nothing while reporting is impossible: fear is being measured, not skill",
            'en': [
                "Halving in two years proves the programme works, there is no need for any other measure of its effect",
                "The campaign should be stopped, it costs too much for a debatable result nobody is defending now",
                "A second simulation vendor should be added to vary the messages and avoid the whole staff getting bored",
            ],
        },

        # --- Task 4 : examen -----------------------------------------------
        (3, 0): {
            'bonne_fr': "Le nombre de signalements recus, rapporte au nombre de messages simules",
            'fr': [
                "Le taux de clic sur le message simule, rapporte au nombre de destinataires de la campagne",
                "Le pourcentage de personnes ayant reussi le quiz final, rapporte a l effectif forme",
                "Le nombre de sessions de formation dispensees dans l annee, rapporte au nombre de services",
            ],
            'bonne_en': "The number of reports received, against the number of simulated messages",
            'en': [
                "The click rate on the simulated message, against the number of recipients in the campaign",
                "The percentage of people who passed the final quiz, against how many were actually trained",
                "The number of training sessions delivered during the year, against the number of teams in scope",
            ],
        },
        (3, 1): {
            'bonne_fr': "Les signalements diminuent : mieux vaut se taire que figurer dans le classement",
            'fr': [
                "Le taux de clic baisse durablement, car la honte est un moteur fiable et peu couteux a entretenir",
                "Les salaries apprennent plus vite : la pression accelere l apprentissage et fixe les reflexes",
                "Aucun effet mesurable, la campagne est neutre : les clics varient surtout selon la charge de travail",
            ],
            'bonne_en': "Reports go down: staying silent beats appearing in the table",
            'en': [
                "The click rate falls durably, because shame is a reliable driver and a cheap one to maintain over time",
                "Employees learn faster: pressure speeds up learning and fixes the right reflexes for good",
                "No measurable effect, the campaign is neutral: clicks mostly follow the workload of each team",
            ],
        },
        (3, 2): {
            'bonne_fr': "Parce qu elle ne decrit aucun geste observable : on ne peut ni l appliquer ni le mesurer",
            'fr': [
                "Parce que les salaries ne lisent pas les consignes de securite, quelle que soit leur formulation exacte dans le message",
                "Parce qu elle est trop courte pour etre comprise par un lecteur presse qui parcourt sa boite le matin",
                "Parce qu elle est redondante avec la charte informatique signee a l arrivee, que personne ne relit jamais",
            ],
            'bonne_en': "Because it describes no observable gesture: it can be neither applied nor measured",
            'en': [
                "Because employees do not read security advice, whatever the exact way it is worded in the message",
                "Because it is too short to be understood by a hurried reader scanning a mailbox in the morning",
                "Because it duplicates the IT charter signed on arrival, which nobody ever reads again afterwards",
            ],
        },
        (3, 3): {
            'bonne_fr': "Il ne s appuie sur aucun resultat : sans relecture, il repete au lieu d apprendre",
            'fr': [
                "Il est trop long, il faudrait le raccourcir pour tenir dans une seule reunion annuelle de sensibilisation",
                "Il devrait etre confie a un prestataire externe, qui saurait imposer un rythme et une evaluation",
                "Il devrait cibler uniquement les nouveaux arrives, qui sont les seuls a ne pas connaitre les consignes",
            ],
            'bonne_en': "It relies on no result: without review, it repeats instead of learning",
            'en': [
                "It is too long and should be shortened so that it fits into a single annual awareness meeting",
                "It should be handed to an external provider, which would impose a pace and a proper evaluation",
                "It should target new joiners only, since they are the only ones who do not know the rules yet",
            ],
        },
    },
}
