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

# Les DOCUMENTS de defi : ils decrivent la tache, ils ne contiennent aucun
# drapeau (controle automatiquement par tools/controle/dojo-sans-drapeau.py).
COPY cours/1-blanche /srv/dojo/1-blanche
COPY cours/2-jaune /srv/dojo/2-jaune
COPY cours/3-orange /srv/dojo/3-orange
COPY cours/4-verte /srv/dojo/4-verte
COPY cours/5-noire /srv/dojo/5-noire
COPY cours/briefs /srv/briefs

# Les FICHIERS DE LA MACHINE : ce sur quoi l'eleve agit reellement. Ils sont
# produits par make-lab.py et arrivent dans /srv, a cote des documents.
COPY machine/ /

COPY notes/notes.txt /home/ctf/notes.txt

# Les drapeaux : lisibles par le serveur (root), pas par l'eleve.
COPY flag/ /root/flags/

# Les droits et proprietaires qui FONT le defi : un fichier en 000 (d05), un
# fichier appartenant a un autre compte (d06). Sans ces trois lignes, les
# ceintures 2 a 5 n'ont pas d'objet : il n'y aurait rien a decouvrir.
RUN chmod 000 /srv/dojo/2-jaune/coffre/tresor-d05.txt \
    && useradd -M -s /usr/sbin/nologin svc-dojoo \
    && chown svc-dojoo:svc-dojoo /srv/dojo/2-jaune/partage/note-du-service.txt \
    && chmod 640 /srv/dojo/2-jaune/partage/note-du-service.txt

RUN chmod 400 /root/flags/*.txt \
    && chown root:root /root/flags/*.txt \
    && chmod 755 /root \
    && chown -R ctf:ctf /home/ctf /srv \
    && chmod -R a+rX /srv \
    && chmod 000 /srv/dojo/2-jaune/coffre/tresor-d05.txt \
    && chown svc-dojoo:svc-dojoo /srv/dojo/2-jaune/partage/note-du-service.txt \
    && chmod 644 /home/ctf/notes.txt

WORKDIR /home/ctf

CMD ["sleep", "infinity"]
