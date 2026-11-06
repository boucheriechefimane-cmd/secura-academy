# -*- coding: utf-8 -*-
"""Distracteurs reecrits — architecture-02 « Le dossier qui fuit par la porte »."""

CORRECTIONS = {
    'Le dossier qui fuit par la porte': {

        (1, 0): {
            'bonne_fr': "Chiffrer la sauvegarde avec une cle conservee hors du serveur de sauvegarde",
            'fr': [
                "Chiffrer la sauvegarde avec la cle rangee dans le meme dossier que l archive",
                "Supprimer la sauvegarde : plus de donnee, plus de risque de fuite si le support est vole",
                "Deplacer la sauvegarde sur un autre serveur non chiffre, plus difficile d acces",
            ],
            'bonne_en': "Encrypt the backup with a key kept outside the backup server",
            'en': [
                "Encrypt the backup with the key stored in the same folder as the archive",
                "Delete the backup: no data, no risk of a leak if the medium gets stolen at all",
                "Move the backup to another unencrypted server, which is harder to reach by chance",
            ],
        },
        (1, 1): {
            'bonne_fr': "Les regles reposent sur des formes trop larges, sans classification prealable des donnees",
            'fr': [
                "La DLP est mal installee : il faudrait la reinsaller en suivant la procedure de l editeur, puis rejouer les tests de non-regression prevus",
                "Les utilisateurs envoient trop de courriels : il faudrait limiter leur quota quotidien et sensibiliser les plus gros expediteurs du service commercial",
                "Il faut augmenter le seuil de blocage a 100 % pour que plus rien ne passe sans une validation manuelle de l administrateur de la plateforme",
            ],
            'bonne_en': "Rules rely on overly broad patterns, with no prior classification of the data",
            'en': [
                "The DLP is badly installed and should be reinstalled following the vendor procedure",
                "Users send too many emails, their daily quota should be reduced by the IT team",
                "The blocking threshold must be raised to 100% so that nothing gets through unchecked",
            ],
        },
        (1, 2): {
            'bonne_fr': "En usage : la donnee est en clair dans la memoire et sur le disque local le temps du traitement",
            'fr': [
                "Au repos : le fichier d origine reste chiffre, mais la copie temporaire deposee dans /tmp ne l est pas forcement selon l outil utilise",
                "En transit : /tmp est un reseau, donc la donnee circule en clair entre les deux machines pendant toute la duree du traitement batch",
                "Aucun : le chiffrement protege pendant tout le traitement, y compris dans les fichiers temporaires et dans la memoire du processus",
            ],
            'bonne_en': "In use: the data is in the clear in memory and on the local disk for the duration of processing",
            'en': [
                "At rest: the original file stays encrypted, but the temporary copy dropped in /tmp is not always so, depending on the tool used",
                "In transit: /tmp is a network, so the data travels in the clear between the two machines for the whole duration of the batch job",
                "None: encryption protects throughout processing, including in the temporary files and in the memory of the running process",
            ],
        },
        (1, 3): {
            'bonne_fr': "Une donnee a caractere personnel permettant d identifier une personne",
            'fr': [
                "Toute donnee detenue par l entreprise, sans aucune distinction de nature ni de sensibilité",
                "Uniquement les donnees bancaires, parce que ce sont les seules a avoir une valeur directe",
                "Uniquement les donnees de sante, parce qu elles relevent d une categorie renforcee",
            ],
            'bonne_en': "Personal data that can identify a person",
            'en': [
                "Any data held by the company, with no distinction of nature or sensitivity",
                "Only banking data, because it is the only kind with a resale value",
                "Only health data, because it falls under a reinforced category",
            ],
        },

        (3, 0): {
            'bonne_fr': "Classer, puis choisir la mesure selon la classe, puis verifier qu elle tient",
            'fr': [
                "Chiffrer tout, puis classer ce qui reste apres le chiffrement dans un second temps",
                "Acheter une DLP, puis classer les donnees selon les alertes qu elle remonte au fil de l eau",
                "Former les utilisateurs, puis classer les donnees selon leurs declarations annuelles",
            ],
            'bonne_en': "Classify, then choose the measure for the class, then verify it holds",
            'en': [
                "Encrypt everything, then classify whatever is left after the encryption step",
                "Buy a DLP, then classify the data from the alerts it raises as it runs day after day",
                "Train users, then classify the data from the statements they make once a year",
            ],
        },
        (3, 1): {
            'bonne_fr': "La DLP ne voit rien : la regle lit du texte, pas le contenu d une image",
            'fr': [
                "La DLP bloque : toute DLP analyse les images par defaut et compare leur empreinte",
                "La DLP chiffre le courriel automatiquement des qu elle detecte une piece jointe",
                "La DLP previent l expediteur mais envoie le courriel, c est le comportement normal",
            ],
            'bonne_en': "The DLP sees nothing: the rule reads text, not the content of an image",
            'en': [
                "The DLP blocks it: every DLP analyses images by default and compares their signature",
                "The DLP encrypts the email automatically as soon as it detects an attached file",
                "The DLP warns the sender but sends the email, which is the documented normal behaviour",
            ],
        },
        (3, 2): {
            'bonne_fr': "Il protege les donnees si le support est vole, et ne protege pas l acces par un compte autorise",
            'fr': [
                "Il protege contre tous les acces, y compris ceux des administrateurs qui detiennent les cles de dechiffrement du volume",
                "Il remplace la classification des donnees, puisqu il en protege le contenu directement et sans avoir besoin de la classer",
                "Il rend inutile la journalisation des acces, le chiffrement faisant office de preuve suffisante en cas de controle",
            ],
            'bonne_en': "It protects the data if the medium is stolen, and does not protect against access by an authorised account",
            'en': [
                "It protects against all access, including that of administrators who hold the volume encryption keys in their vault",
                "It replaces data classification, since it protects the content of the data directly without needing to classify it first",
                "It makes access logging unnecessary, since encryption itself now serves as sufficient evidence in a compliance audit",
            ],
        },
        (3, 3): {
            'bonne_fr': "Le systeme qui manipule le jeton n a jamais la vraie valeur, donc il sort du perimetre de protection de la donnee",
            'fr': [
                "Le jeton est plus court, donc plus rapide a traiter par les applications du service client qui l affichent dans leur interface quotidienne",
                "La tokenisation est un chiffrement avec une autre cle, applique au meme emplacement a chaque fois, et donc reversible par le detenteur de la cle",
                "Le jeton est reversible sans cle, ce qui simplifie les traitements et evite de gerer des secrets supplementaires dans les applications du groupe",
            ],
            'bonne_en': "The system handling the token never holds the real value, so it leaves the data protection scope",
            'en': [
                "The token is shorter, therefore faster to process by the applications of the support team that display it all day long",
                "Tokenisation is encryption with another key, applied to the same field every time, and therefore reversible by the key holder",
                "The token is reversible without a key, which simplifies processing and avoids managing extra secrets across the group",
            ],
        },
    },
}
