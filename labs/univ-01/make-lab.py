#!/usr/bin/env python3
"""Fabrique le contenu de la machine « univ-01 » (22 rooms universitaires).

Le script ecrit :
  - flag/flag-uNN.txt : les 22 drapeaux (lis par le serveur en root) ;
  - les livrables de cours (valeurs decouvrables par l'eleve) ;
  - notes/notes.txt : la porte d'entree de la machine.

Usage : python3 make-lab.py
"""
import hashlib
import io
import os

HERE = os.path.dirname(os.path.abspath(__file__))

# ---------------------------------------------------------------------------
# LES VALEURS SONT DERIVEES, PAS ECRITES DANS LES DOCUMENTS
#
# Correction du 6 novembre 2026. Avant, chaque livrable ecrivait sa valeur en
# clair :  `risque_critique = SECURA{modele_de_menace}`. L'eleve lisait le
# document avec `cat`, recopiait, validait. C'est le defaut que
# tools/controle/drapeaux-lisibles.php a mesure : 15 drapeaux sur 22 de cette
# machine ne demandaient aucune manipulation.
#
# Desormais le document porte la DONNEE (la liste, la trace, les tailles), et
# le drapeau est le RESULTAT d'une transformation courte que l'eleve doit
# appliquer :
#
#   empreinte    sha256 du fichier, tronque      sha256sum | cut -c1-8
#   champ        la valeur d'une ligne « cle = x »  grep | awk
#   colon        la valeur apres « cle: »        cut -d: -f2
#   compte       le nombre de lignes             wc -l < fichier
#   sans_entete  les lignes moins l'en-tete      tail -n +2 | wc -l
#   somme        la somme d'une colonne          awk
#   tri          le premier element alphabetique sort | head -1
#   colonne_triee le premier element d'une colonne
#   position     le numero de la ligne utile     grep -n | cut -d: -f1
#   extrait      un nombre lu dans une phrase    grep -o
#
# Le drapeau reste dans /root/flags, en 400 root:root : le serveur le lit en
# root, l'eleve ne le voit jamais. Il obtient la valeur en executant la
# commande que la room lui indique.
# ---------------------------------------------------------------------------

# Les fichiers de donnees : la matiere premiere de la manipulation.
DATA = {
    'opt/labs/invites.txt': """alice
bob
charlie
diane
eric
fatima
gaston
helene
ivan
""",

    'opt/labs/padding.txt': """16
24
""",

    'cours/owasp/services.txt': """vault:8200
backup:9000
cache:6379
audit:9100
""",

    'cours/owasp/processus.csv': """service,memoire_mo,processus
web,120,40
api,80,30
audit,60,20
""",

    'cours/owasp/gadgets.txt': """pop rdi ; ret
leave ; ret
pop rsi ; ret
ret2libc
""",

    'cours/owasp/specifiers.txt': """%d
%i
%u
%o
%x
%X
%s
%c
%p
%n
%f
""",

    'cours/owasp/risques.txt': """controle d'acces defaillant
injection
configuration par defaut
composants obsoletes
identification et authentification defaillantes
""",

    'cours/owasp/formats.txt': """code postal : format A9999, 5 caracteres
identifiant : 3 a 20 caracteres, lettres et chiffres
montant : nombre decimal, 2 chiffres apres la virgule
date : AAAA-MM-JJ
""",

    'cours/owasp/trace.txt': """connexion refusee pour alice depuis 10.10.0.4
changement de configuration par bob
acces au dossier eleves par le service comptage
connexion reussie pour alice depuis 10.10.0.4
acces au dossier eleves par le service comptage
connexion refusee pour alice depuis 10.10.0.9
changement de configuration par bob
""",

    'cours/mit857/comptes.csv': """compte,role,derniere_connexion
svc-web,service,2026-09-01
svc-comptage,service,2026-09-02
alice,administration,2026-09-04
""",

    'cours/mit857/tailles.txt': """1280
960
640
""",

    'cours/cyber/mots.txt': """pluie
ululement
vache
kayak
onde
""",

    'cours/cyber/signalements.txt': """le domaine ne correspond pas au service officiel
le message joue sur l'urgence pour court-circuiter la reflexion
le lien affiche n'est pas celui vers lequel il pointe
le message demande les identifiants
""",

    'cours/cyber/delais.txt': """12
24
6
""",

    'cours/cyber/facteurs.txt': """mot de passe
application d'authentification
cle de securite
empreinte digitale
""",

    'cours/stanford/canari.txt': """canari du programme du TP : 0x1f2e3d4c
compile sans pile executable, avec canari
canari regenere a chaque execution
""",

    'cours/stanford/tailles.txt': """processeur 64 bits
word_size 8 octets
adresse 8 octets
memoire 16 Go
""",

    'cours/stanford/emplacements.txt': """/etc/secura-secrets/signing.key
/etc/secura-secrets/tls.key
/home/service/.ssh/id_ed25519
/srv/data/.env.production
/etc/app/db.conf
/var/backups/keys.tar
""",
}

# (marqueur du fichier de drapeau, regle de derivation, commande pour l'eleve)
# Les 22 valeurs produites sont deux a deux differentes : un drapeau trouve
# ne peut pas servir a une autre room.
REGLES = [
    ('modele_de_menace', 'menace',     'empreinte:cours/mit858/analyse-risque.md',
     'sha256sum /srv/cours/mit858/analyse-risque.md | cut -c1-8'),

    ('offset_du_tp', 'offset',         'compte:opt/labs/invites.txt',
     'wc -l < /opt/labs/invites.txt'),

    ('privileges_separes', 'privilege',   'colon:cours/owasp/services.txt:vault',
     'grep "^vault:" /srv/cours/owasp/services.txt | cut -d: -f2'),

    ('confinement_borne', 'borne',    'somme:cours/owasp/processus.csv:2',
     "awk -F, 'NR>1{s+=$2} END{print s}' /srv/cours/owasp/processus.csv"),

    ('jeton_csrf', 'csrf',           'champ:cours/mit858/web-notes.txt:csrf',
     "awk '/^ *csrf *=/{print $3}' /srv/cours/mit858/web-notes.txt"),

    ('zone_interdite', 'zone',       'colonne_triee:cours/owasp/services.txt:1::',
     'cut -d: -f1 /srv/cours/owasp/services.txt | sort | head -1'),

    ('tls_signe', 'tls',            'champ:cours/mit857/tls-audit.txt:tls',
     "awk '/^ *tls *=/{print $3}' /srv/cours/mit857/tls-audit.txt"),

    ('mot_de_passe_long', 'auth',    'sans_entete:cours/mit857/comptes.csv',
     'tail -n +2 /srv/cours/mit857/comptes.csv | wc -l'),

    ('cle_symetrique', 'crypto',       'somme:cours/mit857/tailles.txt',
     "awk '{s+=$1} END{print s}' /srv/cours/mit857/tailles.txt"),

    ('pile_x86', 'pile',             'somme:opt/labs/padding.txt',
     "awk '{s+=$1} END{print s}' /opt/labs/padding.txt"),

    ('canari_connu', 'canari',         'empreinte:cours/stanford/canari.txt',
     'sha256sum /srv/cours/stanford/canari.txt | cut -c1-8'),

    ('chainage_de_gadgets', 'rop',  'tri:cours/owasp/gadgets.txt',
     'sort /srv/cours/owasp/gadgets.txt | head -1'),

    ('printf_parle_trop', 'printf',    'compte:cours/owasp/specifiers.txt',
     'wc -l < /srv/cours/owasp/specifiers.txt'),

    ('phrase_passe', 'passe',         'tri:cours/cyber/mots.txt',
     'sort /srv/cours/cyber/mots.txt | head -1'),

    ('urgence_artificielle', 'harpon', 'position:cours/cyber/signalements.txt:urgence',
     'grep -n urgence /srv/cours/cyber/signalements.txt | cut -d: -f1'),

    ('publie_plus_tard', 'publier',     'somme:cours/cyber/delais.txt',
     "awk '{s+=$1} END{print s}' /srv/cours/cyber/delais.txt"),

    ('deux_categories', 'facteur',      'compte:cours/cyber/facteurs.txt',
     'wc -l < /srv/cours/cyber/facteurs.txt'),

    ('risque_priorise', 'risque',      'tri:cours/owasp/risques.txt',
     'sort /srv/cours/owasp/risques.txt | head -1'),

    ('validation_stricte', 'valider',   'extrait:cours/owasp/formats.txt:code postal:([0-9]+) caracteres',
     'grep -i "code postal" /srv/cours/owasp/formats.txt | grep -o "[0-9]* caracteres" | cut -d" " -f1'),

    ('trace_utile', 'journal',          'compte:cours/owasp/trace.txt',
     'wc -l < /srv/cours/owasp/trace.txt'),

    ('adresse_64_bits', 'memoire',      'champ:cours/stanford/tailles.txt:adresse',
     'grep "^adresse " /srv/cours/stanford/tailles.txt | cut -d" " -f3'),

    ('secrets_a_part', 'ranger',       'compte:cours/stanford/emplacements.txt',
     'wc -l < /srv/cours/stanford/emplacements.txt'),
]


def contenu_de(chemin):
    """Le contenu d'un fichier de donnees : DATA d'abord, disque ensuite."""
    if chemin.startswith('/'):
        chemin = chemin.lstrip('/')
    if chemin in DATA:
        return DATA[chemin]
    with io.open(os.path.join(HERE, chemin), encoding='utf-8') as handle:
        return handle.read()


def empreinte(chemin):
    return hashlib.sha256(contenu_de(chemin).encode('utf-8')).hexdigest()[:8]


def champ(chemin, cle):
    """Le troisieme champ d'une ligne « cle = valeur » (indentation toleree)."""
    for ligne in contenu_de(chemin).splitlines():
        morceaux = ligne.split()
        if morceaux and morceaux[0] == cle and len(morceaux) >= 3:
            return morceaux[2]
    raise SystemExit('champ %s introuvable dans %s' % (cle, chemin))


def colon(chemin, cle):
    """La valeur apres « cle: »."""
    for ligne in contenu_de(chemin).splitlines():
        if ligne.startswith(cle + ':'):
            return ligne.split(':', 1)[1]
    raise SystemExit('cle %s introuvable dans %s' % (cle, chemin))


def lignes(chemin):
    return [l for l in contenu_de(chemin).splitlines() if l.strip()]


def compte(chemin):
    return str(len(lignes(chemin)))


def sans_entete(chemin):
    return str(len(lignes(chemin)) - 1)


def somme(chemin, colonne=1, separateur=None):
    total = 0
    for numero, ligne in enumerate(lignes(chemin)):
        if numero == 0 and separateur:
            continue  # en-tete du CSV
        morceaux = ligne.split(separateur) if separateur else ligne.split()
        total += int(morceaux[colonne - 1])
    return str(total)


def tri(chemin):
    return sorted(lignes(chemin))[0]


def colonne_triee(chemin, colonne, separateur):
    valeurs = [l.split(separateur)[colonne - 1] for l in lignes(chemin)]
    return sorted(valeurs)[0]


def position(chemin, motif):
    for numero, ligne in enumerate(lignes(chemin), 1):
        if motif in ligne:
            return str(numero)
    raise SystemExit('motif %s introuvable dans %s' % (motif, chemin))


def extrait(chemin, motif_ligne, expression):
    import re
    for ligne in lignes(chemin):
        if motif_ligne.lower() in ligne.lower():
            trouve = re.search(expression, ligne)
            if trouve:
                return trouve.group(1)
    raise SystemExit('extrait %s introuvable dans %s' % (motif_ligne, chemin))


def valeur_de(regle):
    morceaux = regle.split(':')
    transformation = morceaux[0]

    if transformation == 'empreinte':
        return empreinte(morceaux[1])
    if transformation == 'champ':
        return champ(morceaux[1], morceaux[2])
    if transformation == 'colon':
        return colon(morceaux[1], morceaux[2])
    if transformation == 'compte':
        return compte(morceaux[1])
    if transformation == 'sans_entete':
        return sans_entete(morceaux[1])
    if transformation == 'somme':
        colonne = int(morceaux[2]) if len(morceaux) > 2 else 1
        return somme(morceaux[1], colonne, ',' if colonne > 1 else None)
    if transformation == 'tri':
        return tri(morceaux[1])
    if transformation == 'colonne_triee':
        return colonne_triee(morceaux[1], int(morceaux[2]), ':')
    if transformation == 'position':
        return position(morceaux[1], morceaux[2])
    if transformation == 'extrait':
        return extrait(morceaux[1], morceaux[2], ':'.join(morceaux[3:]))

    raise SystemExit('transformation inconnue : %s' % transformation)


FLAGS = ['FLAG=SECURA{%s_%s}' % (regle[1], valeur_de(regle[2])) for regle in REGLES]

# (chemin dans la machine, contenu)
LIVRABLES = [
    ('cours/mit858/analyse-risque.md', """# Analyse de risque - cours 6.858 (Computer Systems Security)

Document de travail du semestre, ecrit par l'equipe securite du laboratoire.
L'empreinte de la room resume CE document : sa valeur est le sha256 de ce
fichier, tronque a ses 8 premiers caracteres.

    sha256sum /srv/cours/mit858/analyse-risque.md | cut -c1-8

## Actifs proteges
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
3. Toute tentative de connexion refusee doit etre tracee."""),

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

Offset calcule par l'equipe : compte les octets du bloc [buffer] ci-dessus
plus les 8 octets du canari, puis ajoute 8 pour atteindre la sauvegarde de
l'adresse de retour. Ecris le total.

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
niveau_privilege_du_processus_principal = a determiner par l'eleve
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
max_processes         = a determiner par l'eleve
max_fichiers_ouverts  = 32
taille_max_fichier_mb = 16
lecture_seule          = /opt/labs, /srv/cours

[alertes]
# Si un programme tente de sortir du bac a sable, l'evenement est trace.
evenement = tentative_sortie
action    = arreter_le_programme
"""),

    ('cours/mit858/web-notes.txt', """Notes de seance - le web et ses regles (6.858)
==============================================

Le meme site, deux origines
---------------------------
Un site regroupe des ressources sous une meme origine (schema, hote,
port). La politique de meme origine (SOP) empeche le script d'une page
de lire la reponse d'une autre origine.

CSRF : le navigateur fait confiance au cookie
---------------------------------------------
Un formulaire heberge ailleurs peut declencher une requete vers notre
site ; le navigateur joint le cookie de session automatiquement. Le
serveur, lui, ne voit qu'une requete authentifiee.

Le jeton anti-CSRF est la parade : une valeur aleatoire, liee a la
session, que seul notre propre formulaire connait.

Exercice de l'atelier
---------------------
Retrouve le nom du jeton utilise dans l'exemple ci-dessous :

    awk '/^ *csrf *=/{print $3}' /srv/cours/mit858/web-notes.txt

    methode  = POST
    csrf     = TOKEN-9137-SECURE
    duree    = 30 minutes
    chemin   = /compte"""),

    ('cours/mit857/segmentation-plan.txt', """Plan de segmentation - cours 6.857
==================================

Zones
-----
    zone    | sous-reseau     | qui y accede
    --------+-----------------+-----------------------------
    public  | 10.10.0.0/24    | tout le monde, en lecture
    appli   | 10.10.1.0/24    | les serveurs web seulement
    donnees | 10.10.2.0/24    | les serveurs applicatifs seulement
    admin   | 10.10.9.0/24    | les postes d'administration

Services de la zone donnees
---------------------------
Les services de cette zone, avec leur port :

    vault:8200
    backup:9000
    cache:6379
    audit:9100

Exercice de l'atelier
---------------------
Trouve le premier service dans l'ordre alphabetique (c'est lui qui
demarre en premier) :

    cut -d: -f1 /srv/cours/mit857/segmentation-plan.txt | sort | head -1"""),

    ('cours/mit857/tls-audit.txt', """Audit TLS - service de publication (6.857)
===========================================

Ce que le service annonce
-------------------------
    tls        = TLS-1.3
    autorite   = CN=Secura Lab Root CA
    validite   = 2026-01-01 -> 2027-01-01
    hsts       = max-age=31536000
    renegociation = refusee

Ce qui est verifie a la main
----------------------------
1. Le certificat est signe par l'autorite annoncee.
2. Le nom du service figure bien dans le champ SAN du certificat.
3. La chaine remonte jusqu'a la racine installee sur le poste.

Exercice de l'atelier
---------------------
Releve la version de TLS annoncee par le service :

    awk '/^ *tls *=/{print $3}' /srv/cours/mit857/tls-audit.txt"""),

    ('cours/mit857/auth-policy.md', """Politique d'authentification - services du laboratoire
(cours 6.857)

Regles de base
--------------
    longueur_minimale          = 14
    reutilisation_interdite     = oui
    second_facteur              = obligatoire sur les comptes d'administration
    tentatives_avant_blocage   = 5
    duree_session              = 30 minutes
    deconnexion_de_tous_les_appareils = possible

Ce que la politique protege : les comptes de service
---------------------------------------------------
La politique s'applique a tous les comptes. Leur nombre exact n'est pas
ecrit ici : il faut compter les lignes du fichier de comptes, en
ignorant la ligne d'en-tete.

    tail -n +2 /srv/cours/mit857/comptes.csv | wc -l

(Pour lire la commande : « tail -n +2 » saute la premiere ligne,
« wc -l » compte les lignes restantes.)"""),

    ('cours/mit857/crypto-notebook.txt', """Carnet de cryptographie - cours 6.857
=====================================

Ce qu'il faut retenir
---------------------
    chiffrement symetrique  = AES-256
    chiffrement asymetrique = RSA-2048
    signature               = HMAC-SHA256
    mode                    = GCM (authentifie)

Le bloc de chiffrement
----------------------
Ce laboratoire stocke trois blocs. La taille de cle necessaire suit la
taille totale des donnees a proteger. Les tailles, en octets, sont dans
le fichier ci-dessous :

    bloc A = 1280
    bloc B = 960
    bloc C = 640

Exercice de l'atelier
---------------------
Fais la somme des tailles des trois blocs, en octets :

    awk '{s+=$1} END{print s}' /srv/cours/mit857/tailles.txt"""),

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
    notes         = a determiner par l'eleve (canary_size / 8)

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

Valeur de canari utilisee par le programme du TP : releve-la dans
/srv/cours/stanford/canari.txt, puis calcule son empreinte :

    sha256sum /srv/cours/stanford/canari.txt | cut -c1-8
"""),

    ('home/ctf/pwn/rop-notes.md', """TP - Return Oriented Programming (pwn.college)
=============================================

NX est actif : la pile n'est pas executable. On ne depose donc pas de
shellcode. On recycle des morceaux de code deja presents (les gadgets),
qui se terminent par `ret`.

Chaine construite par l'equipe
------------------------------
    chain_length   = a determiner par l'eleve (nombre de gadgets)
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
    specifier_count = a determiner par l'eleve
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

    ('cours/cyber/password-sheet.txt', """Fiche d'hygiene numerique - CYBER.ORG
====================================

La longueur bat la complexite
-----------------------------
14 caracteres suffisent largement, et ils sont plus faciles a retenir
qu'un mot de passe court seme de « ! ». Une phrase de passe, faite de
mots sans rapport entre eux, resiste mieux qu'une suite de symboles.

Rappels
-------
- Un mot de passe par service.
- Jamais un nom, une date de naissance, un lieu evident.
- Le gestionnaire de mots de passe n'est pas un luxe.

Le sac de mots de l'atelier
---------------------------
Chaque eleve pioche trois mots dans cette liste et forme une phrase de
passe. Le premier mot dans l'ordre alphabetique sert d'exemple :

    pluie
    ululement
    vache
    kayak
    onde

Exercice de l'atelier
---------------------
Trouve le premier mot dans l'ordre alphabetique :

    sort /srv/cours/cyber/mots.txt | head -1"""),

    ('cours/cyber/phishing-example.txt', """Exemple d'hameconnage - atelier CYBER.ORG
=========================================

Le message recu
---------------
    De      : securite@compte-verif-support.com
    Objet   : Votre compte expire dans 24 h
    Lien    : http://compte-verif-support.com/login

Les indicateurs, dans l'ordre du message
----------------------------------------
1. Le domaine ne correspond pas a celui du service officiel.
2. L'urgence est artificielle : « dans 24 h » sert a court-circuiter
   la reflexion.
3. Le lien affiche n'est pas celui vers lequel il pointe.
4. Le message demande les identifiants, ce qu'aucun service serieux ne
   fait par courriel.

Exercice de l'atelier
---------------------
Trouve le numero de la ligne qui parle d'urgence :

    grep -n urgence /srv/cours/cyber/signalements.txt | head -1 | cut -d: -f1"""),

    ('cours/cyber/publishing-charter.txt', """Charte de publication - ce que les autres voient de toi
======================================================

Avant de publier
----------------
- Une photo contient souvent des metadonnees : lieu, heure, appareil.
- Une capture d'ecran peut reveler une adresse, un nom, un mot de passe.
- Un message publie reste accessible longtemps, meme apres suppression.

Le delai de verification de l'atelier
-------------------------------------
Le laboratoire applique un delai de relecture avant publication. Les
delais constates sur trois publications sont :

    publication A = 12 heures
    publication B = 24 heures
    publication C = 6 heures

Exercice de l'atelier
---------------------
Fais la somme des trois delais, en heures :

    awk '{s+=$1} END{print s}' /srv/cours/cyber/delais.txt"""),

    ('cours/cyber/factors-sheet.txt', """Fiche du deuxieme facteur - atelier CYBER.ORG
=============================================

Les trois familles de facteurs
------------------------------
    quelque chose que je SAIS        (mot de passe, code)
    quelque chose que je POSSEDE     (telephone, cle USB)
    quelque chose que je SUIS        (empreinte, visage)

Deux facteurs, ce sont deux familles differentes. Deux mots de passe ne
font pas deux facteurs : c'est la meme famille.

Les facteurs de l'atelier
-------------------------
Chaque eleve choisit un facteur dans cette liste :

    mot de passe
    application d'authentification
    cle de securite
    empreinte digitale

Exercice de l'atelier
---------------------
Combien de facteurs dans la liste ? (une ligne = un facteur)

    wc -l < /srv/cours/cyber/facteurs.txt"""),

    ('cours/owasp/risk-ranking.txt', """Classement des risques - atelier OWASP
======================================

Les risques du Top 10, ramenes a notre atelier
----------------------------------------------
    controle d'acces defaillant        (le plus frequent chez nous)
    injection
    configuration par defaut
    composants obsoletes
    identification et authentification defaillantes

Ce que « risque priorise » veut dire
------------------------------------
On ne corrige pas tout en meme temps. On corrige d'abord le risque qui
touche le plus de donnees avec le moins d'effort.

Exercice de l'atelier
---------------------
Classe les cinq risques dans l'ordre alphabetique et releve le premier :

    sort /srv/cours/owasp/risques.txt | head -1"""),

    ('cours/owasp/validation-sheet.txt', """Fiche de validation des entrees - atelier OWASP
===============================================

Le principe
-----------
Tout ce qui vient de l'exterieur est hostile jusqu'a preuve du
contraire : formulaire, parametre d'URL, en-tete, fichier importe.

Valider, c'est refuser par defaut
---------------------------------
On decrit ce qui est ACCEPTE, pas ce qui est refuse. Une liste blanche
est courte ; une liste noire est toujours incomplete.

Formats acceptes dans notre atelier
-----------------------------------
    code postal  : format AAA-999, 6 caracteres
    identifiant  : 3 a 20 caracteres, lettres et chiffres
    montant      : nombre decimal, 2 chiffres apres la virgule
    date         : AAAA-MM-JJ

Exercice de l'atelier
---------------------
Extrais le nombre de caracteres attendu pour le code postal :

    grep -i "code postal" /srv/cours/owasp/formats.txt | grep -o "[0-9]* caracteres" | cut -d" " -f1"""),

    ('cours/owasp/logging-plan.txt', """Plan de journalisation - atelier OWASP
======================================

Ce qu'on journalise
-------------------
- Les connexions reussies et refusees (qui, quand, d'ou).
- Les changements de configuration.
- Les acces aux donnees sensibles.

Ce qu'on ne journalise jamais
-----------------------------
- Les mots de passe, evidemment.
- Les numeros de carte complets.
- Les donnees personnelles inutiles a l'enquete.

Le journal de l'atelier
-----------------------
Le service a produit une trace. Chaque ligne est un evenement :

    connexion refusee pour alice depuis 10.10.0.4
    changement de configuration par bob
    acces au dossier eleves par le service comptage
    connexion reussie pour alice depuis 10.10.0.4
    acces au dossier eleves par le service comptage
    connexion refusee pour alice depuis 10.10.0.9
    changement de configuration par bob

Exercice de l'atelier
---------------------
Combien d'evenements dans cette trace ?

    wc -l < /srv/cours/owasp/trace.txt"""),

    ('cours/stanford/machine-diagram.txt', """Comment marche un ordinateur - cours Stanford CS105
===================================================

De la donnee au programme
-------------------------
La memoire est une suite de cases numerotees. Un programme est une suite
d'instructions rangees dans ces cases. L'adresse, c'est le numero de la
case.

Ce que dit le schema de la machine
----------------------------------
    processeur      = 64 bits
    word_size       = 8 octets
    adresse         = 8 octets
    memoire         = 16 Go
    registre        = 16 registres generaux

Pourquoi 64 bits compte
-----------------------
Un processeur 64 bits peut adresser beaucoup plus de memoire qu'un 32
bits : 2^64 adresses possibles, contre 2^32.

Exercice de l'atelier
---------------------
Releve la taille d'une adresse, en octets :

    grep "^adresse " /srv/cours/stanford/tailles.txt | cut -d" " -f3"""),

    ('cours/stanford/storage-plan.txt', """Plan de rangement - cours Stanford CS105
========================================

Ou vit quoi
-----------
    contenu public   : /srv/cours (livrables de cours, sans secret)
    donnees privees  : /srv/data (acces en lecture pour le service web)
    secrets          : /etc/secura-secrets (acces root, jamais servi)
    journaux         : /var/log/app (acces ecriture par le service audit)

Regles
------
- Un secret ne vit jamais a cote d'un contenu public.
- Le compte de service du site lit les donnees, il ne modifie pas le schema.
- Chaque emplacement a son propre controle d'acces.

Les emplacements de secrets de l'atelier
----------------------------------------
L'inventaire liste, un par ligne, les emplacements qui contiennent un
secret :

    /etc/secura-secrets/signing.key
    /etc/secura-secrets/tls.key
    /home/service/.ssh/id_ed25519
    /srv/data/.env.production

Exercice de l'atelier
---------------------
Combien d'emplacements contiennent un secret ?

    grep -c secrets /srv/cours/stanford/emplacements.txt"""),
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

    # Les fichiers de donnees : la matiere premiere de la manipulation.
    for path, contenu in DATA.items():
        write(path, contenu)

    # Les livrables de cours : le document, sans la valeur.
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
