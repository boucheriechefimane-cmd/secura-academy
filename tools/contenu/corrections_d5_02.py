# -*- coding: utf-8 -*-
"""Distracteurs reecrits — gouvernance-02 « Le fournisseur qui repond oui a tout »."""

CORRECTIONS = {
    'Le fournisseur qui repond oui a tout': {

        # --- Task 2 : trois formulations, une seule verifiable -------------
        (1, 0): {
            'bonne_fr': 'Quand votre plan de reprise a-t-il ete teste, et quel en a ete le resultat ?',
            'fr': [
                'Disposez-vous d un plan de reprise informatique, oui ou non, et depuis combien de temps',
                'Etes-vous serieux en matiere de continuite, et pouvez-vous nous le confirmer par ecrit',
                'Pouvez-vous confirmer que tout est conforme aux exigences du secteur, sans exception',
            ],
            'bonne_en': 'When was your recovery plan last tested, and what was the result?',
            'en': [
                'Do you have an IT recovery plan, yes or no, and for how long has it been in place',
                'Are you serious about business continuity, and can you confirm that to us in writing',
                'Can you confirm that everything meets the sector requirements, without any exception',
            ],
        },
        (1, 1): {
            'bonne_fr': 'Le perimetre exact couvert par la certification',
            'fr': [
                'Le prix de la certification, qui indique le serieux de la demarche engagee',
                'Le nom de l organisme qui a facture l audit, avec le montant facture',
                'Le nombre d employes du fournisseur, rapporte aux personnes couvertes',
            ],
            'bonne_en': 'The exact scope covered by the certification',
            'en': [
                'How much the certification cost, which shows how serious the vendor was',
                'The name of the firm that invoiced the audit, and the amount it invoiced',
                'How many employees the vendor has, compared with the people it covers',
            ],
        },
        (1, 2): {
            'bonne_fr': 'Une notification sous 72 h, avec un interlocuteur nomme',
            'fr': [
                'Une clause de confidentialite generale, qui couvre aussi les donnees que le fournisseur heberge',
                'Une remise commerciale en cas d indisponibilite, proportionnelle a la duree de la panne',
                'Une declaration annuelle de bonnes pratiques, signee par la direction du fournisseur',
            ],
            'bonne_en': 'Notification within 72 hours, with a named contact',
            'en': [
                'A general confidentiality clause, which also covers the data the vendor hosts for you',
                'A discount if the service is unavailable, proportional to how long the outage lasted',
                'An annual declaration of good practice, signed by the vendor management team',
            ],
        },

        # --- Task 4 : examen ------------------------------------------------
        (3, 0): {
            'bonne_fr': 'Le questionnaire est mal concu : il ne permet pas de verifier',
            'fr': [
                'Le fournisseur est particulierement mature, ce qui explique la coherence de ses reponses',
                'Il faut signer rapidement avant que l offre ne change, la coherence n est pas un probleme',
                'Les questions etaient trop techniques pour le fournisseur, qui a repondu comme il pouvait',
            ],
            'bonne_en': 'The questionnaire is badly designed: it cannot verify anything',
            'en': [
                'The vendor is particularly mature, which explains how consistent its answers are',
                'You should sign quickly before the offer changes, consistency is not a real problem',
                'The questions were too technical for the vendor, which answered the best it could',
            ],
        },
        (3, 1): {
            'bonne_fr': 'Vous : la chaine de sous-traitance ne transfere pas votre responsabilite',
            'fr': [
                'Le prestataire tiers, qui detient physiquement les donnees et donc la responsabilite',
                'Personne, tant qu aucun incident n a eu lieu : la responsabilite nait de l incident',
                'L organisme qui a certifie le fournisseur principal, puisque la certification couvre la chaine',
            ],
            'bonne_en': 'You: the subcontracting chain does not transfer your responsibility',
            'en': [
                'The third party, which physically holds the data and therefore carries the responsibility',
                'Nobody, as long as no incident has occurred: responsibility only arises from an incident',
                'The body that certified the main vendor, since the certification covers the whole chain',
            ],
        },
        (3, 2): {
            'bonne_fr': '« Nous notifions rapidement » en cas d incident',
            'fr': [
                '« Politique v4.2, approuvee le 12/01 par le comite de direction »',
                '« Conservation 12 mois, sur un stockage separe du systeme de production »',
                '« Sur demande ecrite » pour le rapport d audit, adressee au responsable securite',
            ],
            'bonne_en': '"We notify quickly" in the event of an incident',
            'en': [
                '"Policy v4.2, approved on 01/12 by the management committee"',
                '"12-month retention, on storage separate from the production system"',
                '"On written request" for the audit report, addressed to the security manager',
            ],
        },
        (3, 3): {
            'bonne_fr': 'Deux declarations qui ne peuvent pas etre vraies ensemble',
            'fr': [
                'Le fournisseur est particulierement mature, ce qui explique la coherence de ses reponses',
                'Il faut signer rapidement avant que l offre ne change, la coherence n est pas un probleme',
                'Les questions etaient trop techniques pour lui, il a repondu comme il pouvait',
            ],
            'bonne_en': 'Two statements that cannot both be true',
            'en': [
                'The vendor is particularly mature, which explains its answers',
                'You should sign quickly, before the offer changes for good',
                'The questions were too technical for that kind of vendor',
            ],
        },
    },
}
