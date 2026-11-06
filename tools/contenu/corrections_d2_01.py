# -*- coding: utf-8 -*-
"""Distracteurs reecrits — menaces-01."""

CORRECTIONS = {
    "Le reseau qui parle trop": {
        (1, 0): {
            'bonne_fr': "Un empoisonnement ARP : la machine se place au milieu du trafic",
            'fr': [
                "Un scan de ports classique sur le reseau local, qui revele les services ouverts",
                "Une panne DHCP qui redistribue les adresses de tout le segment sans prevenir",
                "Un simple changement de carte reseau sur un poste, qui modifie son adresse MAC",
            ],
            'bonne_en': "ARP poisoning: the machine is placing itself in the middle of the traffic",
            'en': [
                "A classic port scan on the local network, which reveals the open services en realite",
                "A DHCP failure redistributing the addresses of the whole segment with no notice en realite",
                "A simple network card swap on a workstation, which changes its MAC address en realite",
            ],
        },
        (1, 2): {
            'bonne_fr': "La surveillance ARP dynamique sur les commutateurs et le cloisonnement en VLAN",
            'fr': [
                "Changer les mots de passe des postes chaque mois, pour limiter l impact d un vol en realite",
                "Installer un antivirus sur chaque machine du segment, avec les signatures a jour en realite",
                "Desactiver le protocole DHCP sur le segment, pour que plus personne ne l utilise en realite",
            ],
            'bonne_en': "Dynamic ARP inspection on switches and segmentation into VLANs",
            'en': [
                "Changing the workstation passwords every month, to limit the impact of a theft",
                "Installing an antivirus on every machine of the segment, with up-to-date signatures",
                "Disabling the DHCP protocol on the segment, so that nobody can use it any more",
            ],
        },
        (3, 0): {
            'bonne_fr': "Le trafic continue de circuler : rien ne tombe en panne",
            'fr': [
                "Il necessite un redemarrage complet du reseau, ce qui coupe la production",
                "Il ne fonctionne que sur les reseaux sans fil, jamais sur un cable Ethernet",
                "Il modifie les adresses IP des postes, ce qui oblige a les reconfigurer",
            ],
            'bonne_en': "Traffic keeps flowing: nothing goes down",
            'en': [
                "It requires a full restart of the network, stopping production",
                "It only works on wireless networks, never on a wired Ethernet connection",
                "It changes the workstation IP addresses, which then need configuring",
            ],
        },
        (3, 1): {
            'bonne_fr': "Le cache corrompt la resolution pour tous ceux qui l'utilisent, sans que personne ne tape autre chose",
            'fr': [
                "La redirection DNS n existe pas, c est une legende urbaine de l informatique au moment ou le probleme est constate par l equipe",
                "L empoisonnement de cache ne fonctionne que sur le poste de l attaquant lui-meme sur toute la duree de l incident",
                "Les deux sont strictement identiques, seul le nom change selon le fournisseur au moment ou le probleme est constate par l equipe",
            ],
            'bonne_en': "The cache corrupts resolution for everyone using it, without anyone typing anything else",
            'en': [
                "DNS redirection does not exist, it is an urban legend of the IT world sur toute la duree de l incident",
                "Cache poisoning only works on the workstation of the attacker themselves sur toute la duree de l incident",
                "The two are strictly identical, only the name changes depending on the vendor sur toute la duree de l incident",
            ],
        },
        (3, 2): {
            'bonne_fr': "Isoler la machine et capturer les preuves avant de couper",
            'fr': [
                "Redemarrer le commutateur pour remettre les tables a zero, et repartir propre",
                "Changer le mot de passe de la passerelle, qui a peut-etre ete intercepte",
                "Prevenir tous les utilisateurs par courriel, pour qu ils se mefient du reseau",
            ],
            'bonne_en': "Isolate the machine and capture evidence before cutting anything",
            'en': [
                "Restart the switch to wipe its tables clean and start again from scratch",
                "Change the gateway password, which may well have been intercepted already",
                "Warn every user by email, so that they become suspicious of the network itself",
            ],
        },
        (3, 3): {
            'bonne_fr': "Segmenter en VLAN et filtrer le trafic entre segments",
            'fr': [
                "Analyser les journaux du commutateur chaque semaine, pour reperer les anomalies",
                "Alerter sur les annonces ARP gratuites, qui signalent un changement de MAC",
                "Former les utilisateurs a ne pas cliquer sur les liens recus par courriel",
            ],
            'bonne_en': "Segmenting into VLANs and filtering traffic between segments",
            'en': [
                "Analysing the switch logs every week, to spot the anomalies that show up",
                "Alerting on gratuitous ARP announcements, which signal a MAC address change",
                "Training users not to click on the links they receive by email from strangers",
            ],
        },
    },
}
