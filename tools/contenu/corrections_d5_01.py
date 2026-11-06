# -*- coding: utf-8 -*-
"""Distracteurs reecrits — gouvernance-01 « Le registre que personne ne lit ».

Chaque question cite sa bonne reponse (inchangee) pour qu'on puisse relire
la coherence de l'ensemble sans ouvrir le fichier PHP. Les leurres sont
donnes dans l'ordre des options privees de la bonne reponse.
"""

CORRECTIONS = {
    'Le registre que personne ne lit': {

        # --- Task 2 : trois lignes de registre a diagnostiquer ---------------
        (1, 0): {
            'bonne_fr': 'Mesure fantome : sans responsable ni date, elle ne sera pas faite',
            'fr': [
                'Ligne correcte : la mesure est claire, suffisante et deja appliquee par l equipe',
                'Probabilite surestimee : il faudrait la baisser a « moyenne » et revoir la cotation',
                'Impact surestime : une perte de donnees n est jamais critique pour une entreprise',
            ],
            'bonne_en': 'Ghost measure: with no owner and no date, it will not happen',
            'en': [
                'This line is correct: the measure is clear, sufficient and already applied by the team',
                'Likelihood is overstated: it should be lowered to "medium" and the scoring reviewed',
                'Impact is overstated: losing customer data is never critical for a company',
            ],
        },
        (1, 1): {
            'bonne_fr': 'Ligne correcte : les quatre elements sont presents et attribues',
            'fr': [
                'Risque orphelin : il manque un responsable, meme si la mesure est decrite',
                'Acceptation muette : personne n a accepte le risque residuel, meme s il est faible',
                'Ligne inutile : un stagiaire ne represente pas un risque digne d un registre',
            ],
            'bonne_en': 'This line is correct: all four elements are present and assigned',
            'en': [
                'Orphan risk: it is missing an owner, even though the measure is described',
                'Silent acceptance: nobody accepted the residual risk, even though it is low',
                'Pointless line: an intern does not represent a risk worth a register entry',
            ],
        },
        (1, 2): {
            'bonne_fr': 'Acceptation muette d un risque critique, sans mesure ni signataire',
            'fr': [
                'Risque orphelin seulement : la cotation est correcte et le statut est justifie',
                'Ligne correcte : accepter un risque est une decision legitime des qu elle est ecrite',
                'Ligne sans objet : un fournisseur d hebergement ne peut pas faire fuiter de donnees',
            ],
            'bonne_en': 'Silent acceptance of a critical risk, with no measure and no signatory',
            'en': [
                'Orphan risk only: the scoring is correct and the status is fully justified',
                'This line is correct: accepting a risk is a legitimate decision once it is written',
                'Pointless line: a hosting provider cannot leak data it is contractually bound to protect',
            ],
        },

        # --- Task 4 : examen -------------------------------------------------
        (3, 0): {
            'bonne_fr': 'Un risque critique marque « accepte » sans signataire ni mesure',
            'fr': [
                'Un risque moyen en cours de traitement, avec une echeance et un responsable nomme',
                'Un risque faible deja traite et verifie, dont la mesure est documentee et datee',
                'Un risque eleve avec une mesure ecrite et un responsable designe pour la suivre',
            ],
            'bonne_en': 'A critical risk marked "accepted" with no signatory and no measure',
            'en': [
                'A medium risk being handled, with a due date and a named owner already designated',
                'A low risk already treated and verified, whose measure is documented and dated',
                'A high risk with a written measure and a manager appointed to follow it through',
            ],
        },
        (3, 1): {
            'bonne_fr': 'Le faire accepter explicitement par un responsable de niveau adequate',
            'fr': [
                'Le supprimer du registre puisqu il a ete traite, et rouvrir une ligne si besoin',
                'Le reclasser en risque faible pour alleger le registre et le rendre plus lisible',
                'Attendre le prochain audit pour en reparler, afin de ne pas decider dans l urgence',
            ],
            'bonne_en': 'Have it explicitly accepted by someone at the right level',
            'en': [
                'Delete it from the register since it has been treated, and reopen a line if needed',
                'Reclassify it as low to keep the register short and make it easier to read',
                'Wait for the next audit to discuss it, so as not to decide in a hurry under pressure',
            ],
        },
        (3, 2): {
            'bonne_fr': 'Parce qu une mesure sans proprietaire ne sera jamais appliquee ni verifiee',
            'fr': [
                'Parce que le proprietaire signe le budget de la mesure et repond de sa depense',
                'Parce que la mesure est confidentielle et le proprietaire, lui, doit rester public',
                'Parce qu un proprietaire peut appliquer plusieurs mesures a la fois, ce qui la rend rentable',
            ],
            'bonne_en': 'Because a measure with no owner is never applied or verified',
            'en': [
                'Because the owner signs the budget for the measure and answers for what it costs',
                'Because the measure is confidential, while the owner must stay publicly accountable',
                'Because one owner can apply several measures at once, which makes the line cost-effective',
            ],
        },
        (3, 3): {
            'bonne_fr': 'L audit lui-meme doit etre questionne : methode, perimetre, independance',
            'fr': [
                'Le registre est excellent et la gouvernance est maitrisee, c est le signe d un travail serieux',
                'Il faut ajouter des risques pour rendre le registre credible aupres de la direction',
                'L audit doit etre classe sans suite : un rapport sans ecart ne demande aucune action',
            ],
            'bonne_en': 'The audit itself must be questioned: method, scope, independence',
            'en': [
                'The register is excellent and governance is under control, which shows serious work',
                'More risks should be added to make the register credible in the eyes of management',
                'The audit should be closed with no follow-up: a report with no findings needs no action',
            ],
        },
    },
}
