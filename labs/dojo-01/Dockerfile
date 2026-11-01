# Machine « dojo-01 » — le dojo Secura (vingt défis, cinq ceintures)
#
# Le dojo est l'entrainement progressif : cinq ceintures, quatre defis
# chacune. Le defi ne se valide pas avec une phrase : le serveur lit le
# drapeau dans la machine de l'apprenant, en root.
#
# Construction :
#   docker build -t securalabs/dojo-01:1.0 labs/dojo-01
#
# Le vrai dojo de pwn.college (image officielle, tres lourde) est fourni
# a part : labs/dojo-pwncollege/docker-compose.yml (non construit en CI).

FROM debian:bookworm-slim

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        bash \
        coreutils \
        findutils \
        grep \
        file \
        binutils \
        openssl \
        iproute2 \
        procps \
        ca-certificates \
    && rm -rf /var/lib/apt/lists/*

# Utilisateur non privilégié : le conteneur ne tourne jamais en root.
RUN groupadd -g 1000 ctf \
    && useradd -u 1000 -g 1000 -m -s /bin/bash ctf

# Les defis (lisibles par l'eleve).
COPY cours/ /srv/dojo/
COPY notes/notes.txt /home/ctf/notes.txt

# Les drapeaux : lisibles par le serveur (root), pas par l'eleve.
COPY flag/ /root/flags/

RUN chmod 400 /root/flags/*.txt \
    && chown root:root /root/flags/*.txt \
    && chmod 755 /root \
    && chown -R ctf:ctf /home/ctf /srv \
    && chmod -R a+rX /srv \
    && chmod 644 /home/ctf/notes.txt

WORKDIR /home/ctf

CMD ["sleep", "infinity"]
