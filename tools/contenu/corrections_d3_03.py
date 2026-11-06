# -*- coding: utf-8 -*-
"""Distracteurs reecrits — architecture-03."""

CORRECTIONS = {
    "Le capteur qui n\\'a jamais parle": {
        (1, 0): {
            'bonne_fr': "Changer les secrets par defaut sur chaque objet et les gerer dans un inventaire",
            'fr': [
                "Ajouter un antivirus sur la passerelle, qui filtrera aussi les flux montants de l atelier avant leur sortie du site",
                "Renommer le compte « admin » en « operateur » pour qu il soit moins evident a deviner par un attaquant de passage",
                "Informer les operateurs du risque, en comptant sur leur vigilance quotidienne pour compenser l absence de controle",
            ],
            'bonne_en': "Change default secrets on each object and manage them in an inventory",
            'en': [
                "Add an antivirus on the gateway, which will also filter the outbound traffic of the shop floor before it leaves",
                "Rename the \"admin\" account to \"operator\" so that it is less obvious to guess for an attacker passing by",
                "Inform operators of the risk, relying on their daily vigilance to make up for the lack of any control",
            ],
        },
        (1, 1): {
            'bonne_fr': "Le confiner dans un reseau segmente avec un filtrage strict et une surveillance du flux",
            'fr': [
                "Le remplacer par un modele plus recent, sans autre mesure : le materiel neuf est toujours plus sur que l ancien",
                "Le renommer pour l identifier dans l inventaire des objets connectes, ce qui suffit a le suivre dans le temps",
                "Le laisser tel quel : sans mise a jour, il ne change pas, donc il est stable, previsible et sans surprise",
            ],
            'bonne_en': "Confine it in a segmented network with strict filtering and flow monitoring",
            'en': [
                "Replace it with a newer model, with no other measure: new hardware is always safer than the old one",
                "Rename it so it can be identified in the inventory of connected objects, which is enough to track it over time",
                "Leave it as is: with no updates it does not change, so it is stable, predictable and without surprise",
            ],
        },
        (1, 2): {
            'bonne_fr': "Bloquer le flux vers cette adresse, puis analyser le journal pour savoir quand et combien de donnees sont parties",
            'fr': [
                "Eteindre l ensemble de l atelier immediatement, pour couper court a toute exfiltration en cours sur la chaine de bout en bout",
                "Ignorer : un capteur ne peut pas exfiltrer, il n a ni disque ni systeme d exploitation pour stocker quoi que ce soit en realite",
                "Remplacer le capteur sans lire le journal, pour repartir sur une base saine, connue et documentee dans l inventaire en realite",
            ],
            'bonne_en': "Block the flow to that address, then analyse the log to know when and how much data left",
            'en': [
                "Shut down the whole shop floor immediately, to put a stop to any exfiltration running on the line right now",
                "Ignore it: a sensor cannot exfiltrate, it has neither a disk nor an operating system to store anything at all",
                "Replace the sensor without reading the log, to restart from a clean, known and documented baseline in the inventory",
            ],
        },
        (1, 3): {
            'bonne_fr': "La priorite a la disponibilite physique : arreter un automate peut arreter une machine et blesser quelqu'un",
            'fr': [
                "Le systeme industriel n a pas de reseau : les automates sont cables en serie entre eux, sans passer par Ethernet en realite",
                "Les automates utilisent une autre cryptographie, que les outils classiques ne savent pas lire ni dechiffrer dans les faits",
                "Les automates ne sont jamais vulnerables : ils n executent que du code ecrit et signe par le constructeur dans les faits",
            ],
            'bonne_en': "Priority given to physical availability: stopping a controller can stop a machine and injure someone",
            'en': [
                "The industrial system has no network: controllers are wired in series to each other, without going through Ethernet",
                "Controllers use different cryptography, which the usual tools cannot read nor decrypt on the wire at all en realite",
                "Controllers are never vulnerable: they only run code written and signed by the manufacturer itself dans les faits",
            ],
        },
        (3, 0): {
            'bonne_fr': "La segmentation, avec un filtrage des flux entre le reseau d'atelier et celui des bureaux",
            'fr': [
                "Un mot de passe plus long sur l objet : douze caracteres au moins, renouveles chaque annee par l equipementier",
                "Une mise a jour du firmware de l objet, des qu un correctif est publie par le constructeur sur son portail",
                "Une sauvegarde quotidienne de l objet, restauree chaque semaine pour verifier qu elle tient vraiment la route",
            ],
            'bonne_en': "Segmentation, with flow filtering between the shop-floor network and the office network",
            'en': [
                "A longer password on the object: at least twelve characters, renewed once a year by the equipment supplier",
                "A firmware update on the object, as soon as a patch is published by the maker on its public portal",
                "A daily backup of the object, restored once a week to check that it really holds when needed en realite",
            ],
        },
        (3, 1): {
            'bonne_fr': "On ne peut ni les mettre a jour, ni les surveiller, ni savoir lesquels sont concernes par une faille annoncee",
            'fr': [
                "On ne peut pas les facturer : ils ne rentrent dans aucun budget et n ont pas de proprietaire identifiable dans les faits",
                "On ne connait pas leur consommation electrique, donc on ne sait pas lesquels coutent le plus au site sur toute la duree de l incident",
                "On ne peut pas les redemarrer a distance, il faut se deplacer a chaque incident, parfois la nuit sur toute la duree de l incident",
            ],
            'bonne_en': "You can neither update them, nor monitor them, nor know which are affected by an announced flaw",
            'en': [
                "You cannot bill for them: they fit in no budget and have no identifiable owner in the organisation en realite",
                "You do not know their power consumption, so you cannot tell which ones cost the site the most dans les faits",
                "You cannot reboot them remotely, so a trip on site is needed for every incident, sometimes at night en realite",
            ],
        },
        (3, 2): {
            'bonne_fr': "Parce qu'un arret non planifie d'un procede peut creer un danger physique et un cout majeur : la disponibilite prime",
            'fr': [
                "Parce que les automates ne se deconnectent pas techniquement : le reseau est cable en dur dans les armoires sur toute la duree de l incident",
                "Parce que la deconnexion ne protege rien : l automate continue a tourner sur lui-meme, sans consequence sur toute la duree de l incident",
                "Parce que le reseau d atelier n a pas de risque : il est isole par construction depuis l origine du site sur toute la duree de l incident",
            ],
            'bonne_en': "Because an unplanned stop of a process can create physical danger and major cost: availability comes first",
            'en': [
                "Because controllers cannot be disconnected technically: the network is hard-wired in the cabinets sur toute la duree de l incident",
                "Because disconnection protects nothing: the controller keeps running on its own, with no consequence sur toute la duree de l incident",
                "Because the shop-floor network carries no risk: it is isolated by construction since the plant was built dans les faits",
            ],
        },
        (3, 3): {
            'bonne_fr': "Un volume ou une destination qui ne correspond pas a son role, surtout a une heure inhabituelle",
            'fr': [
                "Une adresse IP qui change tous les jours, signe d un bail DHCP mal configure sur le segment de l atelier en realite",
                "Un nombre eleve de paquets de petite taille, typique d une numerisation en cours sur le reseau local en realite",
                "Une connexion chiffree vers son serveur de collecte habituel, plusieurs fois par jour a heure fixe en realite",
            ],
            'bonne_en': "A volume or destination inconsistent with its role, especially at an unusual hour",
            'en': [
                "An IP address that changes every day, a sign of a misconfigured DHCP lease on the shop-floor segment",
                "A high number of small packets, typical of a scan currently running on the local network en realite",
                "An encrypted connection to its usual collection server, several times a day at a fixed hour",
            ],
        },
    },
}
