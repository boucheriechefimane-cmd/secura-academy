# Machine 2 — binaire vulnerable (depassement de tampon)
#
# But pedagogique : un programme C compile sans protections, que l'apprenant
# doit detourner pour lui faire executer une fonction d'administration qu'il
# n'appelle jamais, et qui affiche le drapeau.
#
# Construction : docker build -t securalabs/bin-01:1.0 labs/bin-01
#
# Le binaire est compile volontairement sans protections (voir Makefile) :
#   - pas de canari de pile  (-fno-stack-protector)
#   - binaire non PIE        (-no-pie) : l'adresse de ses fonctions est fixe
#   - pas de NX sur la pile  (-z execstack)
#
# Nuance importante, souvent mal expliquee : -no-pie ne desactive PAS
# l'ASLR du noyau. L'ASLR randomise la pile et les bibliotheques ; elle ne
# deplace pas les adresses du binaire lui-meme. C'est precisement ce qui
# rend l'exercice faisable : l'adresse de « lire_drapeau » est constante,
# donc l'eleve n'a pas besoin de fuite d'adresse de pile.
#
# Aucun setuid, aucun privilege : le programme tourne avec les droits de
# l'utilisateur « ctf ». La version precedente de ce lab reposait sur un
# binaire setuid root installe en mode 4755 ; ce montage est abandonne
# parce qu'il ne fonctionne pas dans un conteneur moderne (l'elevation
# setuid y est neutralise par la configuration du moteur, quelle que soit
# l'image). Le scenario ne depend donc plus d'une configuration
# d'execution particuliere : il est verifiable partout, y compris sur un
# poste de developpement.
#
# Le drapeau n'est pas present en clair dans le binaire : il y est stocke
# sous forme de deux blocs recombinables par OU exclusif, ce qui rend
# « strings vulnerable | grep SECURA » muet. L'apprenant doit soit
# detourner le programme vers « lire_drapeau », soit refaire le calcul.
#
# La cible de l'exploitation est la fonction « lire_drapeau » : elle n'est
# jamais appelee par le cours normal, affiche le drapeau, et son adresse
# est lisible avec « nm vulnerable ». Le test de non-regression est
# tools/recette-apprenants/exploit-bin01.py : si ce script n'obtient plus
# le drapeau, le lab est casse et le CI doit echouer.
#
# ⚠ Ce binaire est FAIBLE PAR CONSTRUCTION. Il ne doit jamais etre deploye
#   ailleurs que dans un lab isole.

FROM debian:bookworm-slim

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        bash \
        build-essential \
        gdb \
        python3 \
        python3-pip \
        netcat-openbsd \
        curl \
        coreutils \
        file \
        binutils \
        procps \
    && rm -rf /var/lib/apt/lists/*

RUN groupadd -g 1000 ctf \
    && useradd -u 1000 -g 1000 -m -s /bin/bash ctf

WORKDIR /home/ctf

COPY src/ /home/ctf/src/
COPY notes/notes.txt /home/ctf/notes.txt

# Reference du drapeau, pour le serveur uniquement. Le plugin compare la
# reponse de l'apprenant a ce fichier, et il le lit EN ROOT dans le
# conteneur (voir Secura_Lab::read_file). Il est donc en 400 root:root,
# hors de portee de l'utilisateur « ctf » : le seul chemin vers cette
# valeur, cote apprenant, reste l'exploitation du binaire. Ce n'est PAS
# le butin du scenario, c'est le corrige du serveur.
COPY flag/flag.txt /root/flag.txt

RUN cd /home/ctf/src \
    && make \
    && cp vulnerable /home/ctf/vulnerable \
    && rm -rf /home/ctf/src \
    && chmod 755 /home/ctf/vulnerable \
    && chmod 400 /root/flag.txt \
    && chown root:root /root/flag.txt \
    && chown -R ctf:ctf /home/ctf

# Les deux copies du drapeau ont des roles distincts, et il ne faut pas les
# confondre :
#   - /root/flag.txt (400 root:root) est le CORRIGE du serveur : le plugin
#     y relit la valeur attendue en root pour valider la reponse ;
#   - le binaire embarque les deux blocs chiffres que « lire_drapeau »
#     recombine, et c'est le seul chemin cote apprenant.
# Consequence verifiee par le banc de test : « cat /root/flag.txt » et
# « strings vulnerable » echouent tous les deux en uid 1000, mais
# l'exploit de reference obtient le drapeau.

USER ctf

CMD ["/bin/bash"]
