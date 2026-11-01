#!/usr/bin/env python3
"""Fabrique le contenu de la machine « univ-01 » (22 rooms universitaires).

Le script ecrit :
  - flag/flag-uNN.txt : les 22 drapeaux (lis par le serveur en root) ;
  - les livrables de cours (valeurs decouvrables par l'eleve) ;
  - notes/notes.txt : la porte d'entree de la machine.

Usage : python3 make-lab.py
"""
import io
import os

HERE = os.path.dirname(os.path.abspath(__file__))

FLAGS = [
    'FLAG=SECURA{modele_de_menace}',
    'FLAG=SECURA{offset_du_tp}',
    'FLAG=SECURA{privileges_separes}',
    'FLAG=SECURA{confinement_borne}',
    'FLAG=SECURA{jeton_csrf}',
    'FLAG=SECURA{zone_interdite}',
    'FLAG=SECURA{tls_signe}',
    'FLAG=SECURA{mot_de_passe_long}',
    'FLAG=SECURA{cle_symetrique}',
    'FLAG=SECURA{pile_x86}',
    'FLAG=SECURA{canari_connu}',
    'FLAG=SECURA{chainage_de_gadgets}',
    'FLAG=SECURA{printf_parle_trop}',
    'FLAG=SECURA{phrase_passe}',
    'FLAG=SECURA{urgence_artificielle}',
    'FLAG=SECURA{publie_plus_tard}',
    'FLAG=SECURA{deux_categories}',
    'FLAG=SECURA{risque_priorise}',
    'FLAG=SECURA{validation_stricte}',
    'FLAG=SECURA{trace_utile}',
    'FLAG=SECURA{adresse_64_bits}',
    'FLAG=SECURA{secrets_a_part}',
]

# (chemin dans la machine, contenu)
LIVRABLES = [
    ('cours/mit858/analyse-risque.md', """# Analyse de risque - cours 6.858 (Computer Systems Security)

Document de travail du semestre, ecrit par l'equipe securite du laboratoire.

## Actifs protects
- Base de donnees des eleves (nom, identifiant, notes)
- Cle de signature du service de publication
- Journal d'audit du service d'authentification

## Adversaires consideres
- Un attaquant externe qui decouvre un service expose
- Un compte de service compromis sur la zone interne
- Une personne non autorisee qui lit les logs par erreur

## Regles (politique de securite)
1. Seul le service de comptage lit la base des eleves.
2. Seuls les administrateurs modifient la configuration.
3. Toute tentative de connexion refusee doit etre tracee.

## Conclusion - risque critique

Le risque critique identifie par l'equipe est celui qui casse la regle 1 :
une requete non verifiee qui permet de lire la base depuis la zone publique.
La valeur de reference retenue pour ce risque est :

    risque_critique = {flag}

Toute modification de ce document doit etre reflechie dans le tableau de bord
de l'equipe avant la revue de securite du mois prochain.
"""),

    ('opt/labs/buffer-overflow/README.md', """TP 3 - Buffer Overflow Exploits and Defenses (cours 6.858)
====================================================

Programme fourni : /opt/labs/buffer-overflow/vuln.c
Compilation :       gcc -fno-stack-protector -no-pie vuln.c -o vuln

Analyse du binaire (realisee par l'equipe)
--------------------------------------------
- Le programme lit une saisie avec gets() dans un buffer local.
- La compilation sans protection de pile est volontaire : on veut observer
  le mecanisme avant de le contrer.
- La valeur de retour de gets() n'est pas verifiee.

Resultats du premier essai
---------------------------
    buffer_size   = 64
    offset        = 72
    canary_value  = 0x41414141

Le programme se termine avec « *** stack smashing detected *** » quand la
saisie depasse le canari. Il faut donc reconstruire le canari avant
d'atteindre l'adresse de retour.

Offset calcule par l'equipe : {flag}

Rappel : le canari ne protege que si l'on ne le touche pas. Avec la valeur
ci-dessus, on peut le reecrire tel quel.
"""),

    ('etc/secura-policy/policy.conf', """# Politique de separation des privileges - service web du laboratoire
# (d'apres le cours 6.858, lecon 4 : Privilege Separation)
#
# Chaque service est dcrit avec le niveau de confiance qui lui est
# accorde. Un bug dans un service ne doit pas donner plus de pouvoir
# que ce niveau.

[service-web]
role            = lecture_seule
niveau          = 2
peut_ecrire     = /var/log/app/journal.log
ne_peut_pas     = /etc/secura-policy, /root
commentaire     = le service web ne fait que lire les livrables de cours

[service-index]
role            = relecture
niveau          = 1
peut_ecrire     = /var/cache/index
ne_peut_pas     = /etc/secura-policy, /root, /var/log/app

[service-audit]
role            = ecriture_journal
niveau          = 3
peut_ecrire     = /var/log/app
ne_peut_pas     = /etc/secura-policy, /root

[regle_generale]
principe            = moindre privilege
niveau_privilege_du_processus_principal = {flag}
commentaire         = le service web tourne avec le niveau le plus bas possible
"""),

    ('etc/secura-policy/sandbox.conf', """# Profil de confinement du bac a sable de verification
# (cours 6.858, lecon 7 : Sandboxing Native Code)
#
# Le programme verifie tourne dans ce profil : la liste blanche dit ce
# qu'il a le droit de faire, les quotas disent ce qu'il peut consommer.

[confinement]
se_network            = false
se_syscall_exec       = false
se_syscall_socket     = false
memoire_max_mb        = 128
cpu_max_percent       = 50
max_processes         = {flag}
max_fichiers_ouverts  = 32
taille_max_fichier_mb = 16
lecture_seule          = /opt/labs, /srv/cours

[alertes]
# Si un programme tente de sortir du bac a sable, l'evenement est trace.
evenement = tentative_sortie
action    = arreter_le_programme
"""),

    ('cours/mit858/web-notes.txt', """Notes de la lecon 9 - Securing Web Applications (cours 6.858)
=========================================================

Rappel du modele de securite du web
-----------------------------------
La regle de meme origine (Same Origin Policy) interdit a une page de lire
la reponse d'un autre site. Elle n'interdit pas a un autre site d'ENVOYER
une requete avec les identifiants de l'utilisateur connecte : c'est la
faille CSRF.

Parade : un jeton secret dans le formulaire, verifie par le serveur a
chaque requete sensible. Un site externe ne peut pas lire ce jeton, donc
il ne peut pas le renvoyer.

Exemple du cours (a recopier tel quel dans l'exercice)
------------------------------------------------------
    <form action="/virement" method="post">
        <input type="hidden" name="jeton" value="TOKEN-9137-SECURE">
        ...
    </form>

    POST /virement   jeton=TOKEN-9137-SECURE

Nom du jeton utilise dans l'exemple du cours : {flag}

Autres parades citees : cookie HttpOnly, cookie Secure, SameSite=Lax,
verification de l'en-tete Origin, et surtout ne jamais faire confiance au
formulaire cote serveur.
"""),

    ('cours/mit857/segmentation-plan.txt', """Plan de segmentation du reseau du laboratoire
(cours 6.857 - Network and Computer Security)

Objectif : qu'une compromission dans une zone ne donne pas acces aux
autres zones. Le pare-feu est place ENTRE les zones, pas autour.

+---------------------+---------------+--------------------------+
| Zone                | zone_id       | Contenu                  |
+---------------------+---------------+--------------------------+
| Public              | 1             | Serveur web, proxy       |
| Donnees sensibles   | {flag}       | Base de notes, secrets   |
| Interne             | 3             | Nœud d'archivage         |
| Administration       | 4             | Supervision, sauvegardes  |
+---------------------+---------------+--------------------------+

Regles de flux
--------------
1. Public -> Donnees sensibles : autorise uniquement sur le port 443.
2. Public -> Interne : interdit.
3. Administration -> toutes zones : autorise (avec authentification).
4. Interne -> Public : interdit (anti-pivot).

Le plan a ete revu apres l'incident du mois dernier : le port 8080 du
service de statistiques etait joignable depuis la zone publique.
"""),

    ('cours/mit857/tls-audit.txt', """Audit TLS - service interne du laboratoire
(cours 6.857 - Network and Computer Security)

Objet : verifier ce que le certificat du service garantit reellement.

Certificat analyse
-------------------
    sujet            = CN=intranet.lab
    SAN              = DNS:intranet.lab, DNS:web.lab, IP:127.0.0.1
    validite_du      = 2026-01-15
    validite_au      = 2027-01-15
    autorite         = CN=Secura Lab Root CA
    signature_algorithm = {flag}
    chaine           = Secura Lab Root CA -> Secura Lab Intermediate CA

Points de controle
-------------------
- Le certificat couvre-t-il le nom utilise par les clients ? oui
- La chaine est-elle complete jusqu'a la racine de confiance ? oui
- La duree de validite est-elle raisonnable ? oui
- Les algorithmes proposes sont-ils encore acceptes ? oui

Ce que l'audit ne dit pas : si le site est honnete. TLS protege le tuyau,
pas ce qu'il y a a l'autre bout.
"""),

    ('cours/mit857/auth-policy.md', """Politique d'authentification - services du laboratoire
(cours 6.857 - Network and Computer Security)

Regles de base
--------------
    longueur_minimale          = 14
    min_length                 = {flag}
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
"""),

    ('cours/mit857/crypto-notebook.txt', """Carnet de cryptographie - cours 6.042 (R. Rivest)
===========================================

Rappel des trois briques
------------------------
1. Chiffrement symetrique (AES) : une cle pour chiffrer et dechiffrer.
   Rapide, solide, mais il faut se ┃ Sharing de la cle.
2. Chiffrement asymetrique (RSA, courbes elliptiques) : cle publique +
   cle privee. La cle publique peut circuler a la main.
3. Signature numerique : signe avec la cle privee, verifie avec la cle
   publique. Prouve l'origine et l'integrite, ne cache rien.

Hachage
-------
Une empreinte courte et a sens unique : sert a verifier qu'un fichier n'a
pas change, et a stocker les mots de passe (avec sel).

Exemple du carnet
-----------------
    chiffrement_symetrique  = AES-256
    key_size               = {flag}
    taille_bloc            = 128 bits
    mode                   = GCM
    hachage                = SHA-256
    signature              = ECDSA P-256

Question du cours : a qui faites-vous confiance ? La reponse decide de
tout le reste.
"""),

    ('home/ctf/pwn/memory-notebook.md', """Carnet de memoire - refresher assembleur (pwn.college)
=====================================================

Les trois choses qui bougent en permanence
-----------------------------------------
1. Les donnees
2. Les adresses
3. Le compteur de programme

Registres utiles (x86-64)
--------------------------
    rax, rbx, rcx, rdx   : usage general
    rdi, rsi, rdx         : arguments (convention System V)
    rsp                  : pointeur de pile
    rbp                  : pointeur de base

La pile
-------
Vers le bas (adresses decroissantes). A chaque appel de fonction :

    [adresse de retour]      <- la cible du debordement
    [canari]
    [variables locales]
    [buffer]
    [rsp]

Exercice du carnet
------------------
    buffer_size   = 32
    canary_size   = 8
    offset_to_return_address = 40
    notes         = {flag}

Pour verifier : 32 octets de buffer + 8 octets de canari = 40 octets
avant l'adresse de retour.
"""),

    ('home/ctf/pwn/stack-notes.md', """Notes du TP - Memory Errors: Smashing the Stack (pwn.college)
===============================================================

Programme : /home/ctf/pwn/vuln (compile sans stack protector)
Methode : ecrire un motif reconnaissable, observer le plantage, affiner.

Resultats de l'equipe
----------------------
    motif_utilise        = AAAA...AAAA
    crash_offset         = 72
    canary_value         = 0x41414141
    stack_protector      = desactive
    aslr                 = actif (adressesvariables)

Ordre de travail
----------------
1. Trouver l'offset exact (72 octets).
2. Reecrire le canari avec sa valeur d'origine.
3. Placer l'adresse visee a la place de l'adresse de retour.

Valeur de canari utilisee par le programme du TP : {flag}
"""),

    ('home/ctf/pwn/rop-notes.md', """TP - Return Oriented Programming (pwn.college)
=============================================

NX est actif : la pile n'est pas executable. On ne depose donc pas de
shellcode. On recycle des morceaux de code deja presents (les gadgets),
qui se terminent par `ret`.

Chaine construite par l'equipe
------------------------------
    chain_length   = {flag}
    gadgets         = pop rdi ; ret
                     pop rsi ; ret
                     pop rdx ; ret
                     syscall ; ret
    ordre          = remplissage -> pop rdi (adresse de "/bin/sh")
                     -> pop rsi (0) -> pop rdx (0) -> syscall

Ce que le cours rappelle
------------------------
Le ROP ne cree pas de code : il ecrit un programme avec des codes de
retour. C'est plus technique que le debordement classique, pas impossible.
Outils : ROPgadget, pwntools.
"""),

    ('home/ctf/pwn/format-notes.md', """Carnet - Format String Exploits (pwn.college)
=========================================

Le probleme
-----------
    printf(user_input);   // Dangereux
    printf("%s", user_input);   // Correct

Specificateurs utiles
---------------------
    %x      lit un mot en hexadecimal dans la pile
    %p      lit un pointeur
    %s      lit une chaine a l'adresse lue
    %n      ECRIT le compteur de caracteres a l'adresse lue

Fuite d'adresse
---------------
    specifier_count = {flag}
    format          = %p.%p.%p.%p.%p.%p.%p.%p

En empilant des %p, le programme crache les adresses qu'il a en memoire :
de la on recalcule la base du programme et celle de la bibliotheque
(ASLR bypass).

Ecriture arbitraire
-------------------
Avec %n, on ecrit une valeur choisie a une adresse choisie : on peut
ecraser une entree de table de sauts, un pointeur de fonction ou le GOT.

Regle : le format doit toujours etre une constante.
"""),

    ('cours/cyber/password-sheet.txt', """Fiche d'hygiene - mots de passe (atelier CYBER.ORG)
================================================

Regles de l'atelier
-------------------
    longueur_recommandee  = 16 caracteres minimum
    min_length            = {flag}
    phrase_de_mots        = oui (quatre mots sans lien)
    reutilisation         = interdite (une phrase par site)
    gestionnaire           = obligatoire
    changement_si_doute   = immediat

Exemples
---------
    A EVITER      : Basketball2024!  (mot du dictionnaire + annee)
    A EVITER      : P@ssw0rd!        (court, modele tres utilise)
    CONSEILLE     : jeep-orage-lanterne-cerisier

Pourquoi la longueur bat la complexite : les outils de cassage testent des
mots, des mots du dictionnaire et leurs variantes. Une phrase de mots sans
lien ne se trouve dans aucun dictionnaire.
"""),

    ('cours/cyber/phishing-example.txt', """Exemple commente - message d'hameconnage (atelier CYBER.ORG)
=====================================================

Message recu
------------
    De : support@banque-officielle-verification.com
    Objet : ACTION REQUISE - votre compte sera bloque dans 2 heures
    Bonjour Client, nous avons detecte une activite inhabituelle sur
    votre compte. Merci de vous identifier dans les 24 heures :
    http://banque-officielle-verification.com/verif

Annotations de l'atelier
------------------------
    main_signal     = {flag}
    autres_signaux  = urgence / lien trompeur / orthographe / logo
    reaction        : ne jamais cliquer, aller sur le site en tapant
                      l'adresse, ou appeler le numero officiel

Le signal principal de cet exemple est l'URGENCE : c'est elle qui
empêche la verification. Les autres signaux (domaine trompeur,
orthographe) viennent confirmer.

Memo : un code de validation recu par SMS ne se communique jamais.
"""),

    ('cours/cyber/publishing-charter.txt', """Charte de publication sur les reseaux sociaux (atelier CYBER.ORG)
============================================================

Regles de l'atelier
-------------------
    publication_delay_hours = {flag}
    localisation_en_direct  = interdite pendant un desplazamiento
    photo_de_badge          = interdite
    adresse_complete        = jamais
    regle_des_trois_questions = avant de publier :
        1. est-ce que ca me concerne encore dans cinq ans ?
        2. est-ce que j'aimerais que ma famille le voie ?
        3. est-ce que je peux l'expliquer a un recruteur ?

Ce que les autres publient sur toi
----------------------------------
Une photo de toi peut etre postee par quelqu'un d'autre. Tu peux
demander la suppression, signaler, garder une preuve, et durcir tes
reglages de visibilite.
"""),

    ('cours/cyber/factors-sheet.txt', """Fiche des facteurs d'authentification (atelier CYBER.ORG)
=====================================================

Les trois categories
--------------------
    ce que je sais : mot de passe, PIN
    ce que j'ai    : telephone, cle USB, carte
    ce que je suis : empreinte, visage

Regles de l'atelier
-------------------
    recommended_factors = {flag}
    categories_to_mix   = obligatoire (deux categories differentes)
    sms                 = tolere, moins robuste
    application         : preferee
    cle physique FIDO2  : la plus resistente
    question secrete    : refusee (ce n'est pas une autre categorie)

Rappel
------
Un code recu par SMS ne se communique a personne : il prouve que c'est
toi qui es connecte.
"""),

    ('cours/owasp/risk-ranking.txt', """Classement interne des risques - application de l'equipe
(cours OWASP Top 10)
====================================================

Nous avons repris la liste Top 10 et l avons ordonnee selon ce que nous
rencontrons reellement dans notre code.

    top_risk = {flag}
    classement :
      1. Controle d'acces casse (API de statistiques sans authentification)
      2. Injection (requetes construites par concatenation)
      3. Journalisation et surveillance insuffisantes
      4. Misconfiguration (compte de service avec trop de droits)
      5. Erreurs excessives affichees au navigateur

Regle de l'equipe : on corrige d'abord ce qui est a la fois frequent et
grave, et on revoit le classement apres chaque sprint.
"""),

    ('cours/owasp/validation-sheet.txt', """Fiche de validation des entrees (TP OWASP - injection)
=====================================================

Controles du formulaire d'inscription
--------------------------------------
    champ email        : format verifie, longueur max 254
    champ age          : entier, entre 13 et 99
    champ code postal  : format AAA-999, 6 caracteres
    zip_checks         = {flag}
    champ mot de passe : longueur min 14, refuse les listes connues
    tous les champs    : echappement a la sortie, requetes preparees

Regle de l'equipe
-----------------
Le format est verifie cote serveur. Les messages d'erreur ne disent pas
quel controle a echoue (pas de fuite d'information), mais ils disent a
l'utilisateur quoi corriger.

Trois erreurs vues en revue de code :
- un filtre de mots cles (OR, DROP) au lieu d'une requete preparee
- une validation uniquement dans le navigateur
- un echappement fait a la main au lieu de la fonction de la bibliotheque
"""),

    ('cours/owasp/logging-plan.txt', """Plan de journalisation - service applicatif (OWASP A09:2021)
==========================================================

Evenements journalises
----------------------
    event_count = {flag}
    evenements :
      - authentification reussie / refusee
      - changement de mot de passe
      - changement de privileges
      - export de donnees
      - refus d'acces (403)
      - erreur serveur (500)

Contenu d'une ligne
-------------------
    horodatage | utilisateur | action | resultat | IP | user-agent

Regles de l'equipe
------------------
- On ne journalise JAMAIS un mot de passe, une carte ou un jeton.
- Les journaux sont proteges et conserves 30 jours maximum.
- Une alerte est declenchee sur rafale d'echecs et changement de privileges.
- Un journal que personne ne lit ne sert a rien : la revue est hebdomadaire.
"""),

    ('cours/stanford/machine-diagram.txt', """Schema de la machine - cours Stanford CS105
=========================================

Quatre couches, de la donnee au programme
-----------------------------------------
1. Donnees : tout est binaire ; un caractere, une image, un son sont
   des nombres.
2. Memoire : une suite d'octets numerotes ; une adresse designe une case.
   Une variable est un nom donne a une adresse.
3. Instruction : une operation elementaire (charger, ajouter, stocker,
   sauter).
4. Cycle : le processeur prend l'instruction, l'execute, passe a la
   suivante, sauf saut.

Chiffres du schema
------------------
    address_size      = 8 octets (64 bits)
    bus_width         = 64 bits
    word_size         = 8 octets
    address_size_bytes = {flag}

Consequence pour la securite
-----------------------------
Sans ASLR, les adresses sont previsibles ; c'est pourquoi le processus
aleatoire des adresses existe, et pourquoi une fuite d'adresse est si
precieuse pour un attaquant.
"""),

    ('cours/stanford/storage-plan.txt', """Plan de rangement des donnees - cours Stanford CS105
================================================

Nous rangeons les choses selon leur niveau de sensibilite : c'est la
separation des responsabilites appliquee aux donnees.

Emplacements
------------
    secret_locations = {flag}
    contenu public   : /srv/cours (livrables de cours, sans secret)
    donnees privees  : /srv/data (acces en lecture pour le service web)
    secrets          : /etc/secura-secrets (acces root, jamais servi)
    journaux         : /var/log/app (acces ecriture par le service audit)

Regles
------
- Un secret ne vit jamais a cote d'un contenu public.
- Le compte de service du site lit les donnees, il ne modifie pas le schema.
- Chaque emplacement a son propre controle d'acces.
"""),
]


def write(path, content):
    full = os.path.join(HERE, path)
    directory = os.path.dirname(full)
    if directory and not os.path.isdir(directory):
        os.makedirs(directory)
    with io.open(full, 'w', encoding='utf-8') as handle:
        handle.write(content)


def main():
    # Les drapeaux : un fichier par room, lus par le serveur en root.
    for index, value in enumerate(FLAGS, start=1):
        write('flag/flag-u%02d.txt' % index, value + '\n')

    # Les livrables : une valeur decouvrable par l'eleve, par room.
    for (path, template), value in zip(LIVRABLES, FLAGS):
        write(path, template.replace('{flag}', value))

    write('notes/notes.txt', """Salle des cours - machine du laboratoire
=====================================

Cette machine rassemble les livrables des cours suivis par l'equipe.
Chaque dossier correspond a un cours ; chaque document contient le
resultat du travail demande dans la room associee.

Ou trouver quoi
---------------
    /srv/cours/mit858/      cours MIT 6.858 (modele de menace, web)
    /srv/cours/mit857/      cours MIT 6.857 (reseau, TLS, auth, crypto)
    /srv/cours/owasp/       atelier OWASP (Top 10, validation, journaux)
    /srv/cours/cyber/       atelier CYBER.ORG (hygiene numerique)
    /home/ctf/pwn/          TP pwn.college (memoire, pile, ROP, format)
    /srv/cours/stanford/    cours Stanford CS105 (machine, rangement)
    /etc/secura-policy/     politique du laboratoire (privileges, bac a sable)
    /opt/labs/              TP du cours 6.858 (binaire vulnerable)

La valeur a relever est toujours ecrite dans le document, precedee de son
intitule (par exemple « risque_critique = ... »).
""")

    print('lab univ-01 : %d drapeaux, %d livrables' % (len(FLAGS), len(LIVRABLES)))


if __name__ == '__main__':
    main()
