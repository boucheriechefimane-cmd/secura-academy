# COPIE de bin-01 livree dans le ZIP ; ce n’est pas une nouvelle machine validee.
# Voir labs/README.md avant toute utilisation.

# Machine 2 — binaire vulnérable (dépassement de tampon)
#
# But pédagogique : un programme C compilé sans protections, que l'apprenant
# doit exploiter pour obtenir un shell, puis lire le drapeau.
#
# Construction : docker build -t securalabs/bin-01:1.0 labs/bin-01
#
# Le binaire est compilé volontairement sans protections (voir Makefile) :
#   - pas de pile protégée  (-fno-stack-protector)
#   - pas d'ASLR             (-no-pie)
#   - pas de NX sur la pile  (-z execstack)
#
# Il est en plus installé en setuid root (bit « s » du ls -l) : le shell
# obtenu par débordement de tampon est donc un shell root, ce qui permet
# de lire /root/flag.txt (400 root:root). Le scénario 9 « Le binaire qui
# obéit trop » explique ce mécanisme.
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
    && chmod 4755 /home/ctf/vulnerable

USER ctf

CMD ["/bin/bash"]
