# Machine « univ-01 » — la salle des cours
#
# Une seule image pour les vingt-deux rooms « Les universités ».
# Elle ne contient aucun serveur web : la mission est de lire, dans les
# livrables des cours, la valeur demandée par la room. Les drapeaux
# (400 root:root) ne sont lisibles que par le serveur du plugin, qui les
# compare à la réponse de l'apprenant.
#
# Construction :
#   docker build -t securalabs/univ-01:1.0 labs/univ-01
#
# Test :
#   docker run --rm -d --user 1000:1000 securalabs/univ-01:1.0 sleep infinity

FROM debian:bookworm-slim

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        bash \
        coreutils \
        findutils \
        grep \
        file \
        ca-certificates \
    && rm -rf /var/lib/apt/lists/*

# Utilisateur non privilégié : le conteneur ne tourne jamais en root.
RUN groupadd -g 1000 ctf \
    && useradd -u 1000 -g 1000 -m -s /bin/bash ctf

# Les livrables des cours (lisibles par l'élève).
COPY cours/ /srv/cours/
COPY etc/secura-policy/ /etc/secura-policy/
COPY opt/labs/ /opt/labs/
COPY home/ctf/ /home/ctf/
COPY notes/notes.txt /home/ctf/notes.txt

# Les drapeaux : lisibles par le serveur (root), pas par l'élève.
COPY flag/ /root/flags/

RUN chmod 400 /root/flags/*.txt \
    && chown root:root /root/flags/*.txt \
    && chmod 755 /root \
    && chown -R ctf:ctf /home/ctf /srv /opt \
    && chmod -R a+rX /srv /opt /etc/secura-policy \
    && chmod 644 /home/ctf/notes.txt

WORKDIR /home/ctf

CMD ["sleep", "infinity"]
