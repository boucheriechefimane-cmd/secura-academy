# Service « flags » du lab Juice Shop
#
# Ce conteneur ne fait rien d'utile : il garde le drapeau. Les fichiers
# sont en 400 root:root, donc l'apprenant ne peut pas les lire ; seul le
# plugin (docker exec -u 0) les lit pour comparer la reponse.
#
# Construction :
#   docker build -t securalabs/flags-01:1.0 labs/juice-shop/flags

FROM debian:bookworm-slim

RUN groupadd -g 1000 ctf \
    && useradd -u 1000 -g 1000 -m -s /bin/bash ctf

COPY flag-*.txt /root/flags/

RUN chmod 400 /root/flags/*.txt \
    && chown root:root /root/flags/*.txt \
    && chmod 755 /root

WORKDIR /home/ctf

CMD ["sleep", "infinity"]
