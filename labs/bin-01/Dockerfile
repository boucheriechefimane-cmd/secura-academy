# Machine 2 — binaire vulnérable (dépassement de tampon)
#
# But pédagogique : un programme C compilé sans protections, que l'apprenant
# doit exploiter pour obtenir un shell, puis lire le drapeau.
#
# Construction : docker build -t securalabs/bin-01:1.0 labs/bin-01
#
# Le binaire est compilé volontairement sans protections (voir Makefile) :
#   - pas de canari de pile  (-fno-stack-protector)
#   - binaire non PIE        (-no-pie) : l'adresse de ses fonctions est fixe
#   - pas de NX sur la pile  (-z execstack)
#
# Nuance importante, souvent mal expliquée : -no-pie ne désactive PAS
# l'ASLR du noyau. L'ASLR randomise la pile et les bibliothèques ; elle ne
# déplace pas les adresses du binaire lui-même. C'est précisément ce qui
# rend l'exercice faisable : l'adresse de « carnet_root » est constante,
# donc l'élève n'a pas besoin de fuite d'adresse de pile.
#
# Il est en plus installé en setuid root (bit « s » du ls -l) : le shell
# obtenu par débordement de tampon est donc un shell root, ce qui permet
# de lire /root/flag.txt (400 root:root). Le scénario 9 « Le binaire qui
# obéit trop » explique ce mécanisme.
#
# La cible de l'exploitation est la fonction « carnet_root » du programme :
# elle n'est jamais appelée par le cours normal, ouvre un shell après
# setuid(0), et son adresse est lisible avec « nm vulnerable ». Le test de
# non-régression est tools/recette-apprenants/exploit-bin01.py : si ce
# script n'obtient plus de shell, le lab est cassé et le CI doit échouer.
#
# ⚠ Ce binaire est FAIBLE PAR CONSTRUCTION. Il ne doit jamais être déployé
#   ailleurs que dans un lab isolé.

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
# Le drapeau 'externe' (celui que lit le serveur en root pour comparer la
# reponse) reste dans /root, illisible par l'apprenant.
COPY flag/flag.txt /root/flag.txt
COPY notes/notes.txt /home/ctf/notes.txt

RUN cd /home/ctf/src \
    && make \
    && cp vulnerable /home/ctf/vulnerable \
    && chmod 400 /root/flag.txt \
    && chown root:root /root/flag.txt \
    && chmod 755 /root \
    && chown -R ctf:ctf /home/ctf \
    # Le binaire est setuid root : c'est le point pedagogique du scenario.
    # Le chown recursif doit donc avoir lieu AVANT (sinon il efface root).
    && chown root:root /home/ctf/vulnerable \
    && chmod 4755 /home/ctf/vulnerable \
    # Le drapeau DU LAB, lui, est place dans /root/flag.txt (le meme
    # fichier) : l'apprenant ne peut donc le lire qu'a travers le shell
    # root obtenu par le debordement. Avant, le meme contenu trainait
    # aussi en clair dans les documents de la machine : le drapeau se
    # trouvait en « catant » un fichier, sans aucune exploitation.

USER ctf

CMD ["/bin/bash"]
