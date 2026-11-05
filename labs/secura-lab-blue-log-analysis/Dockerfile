# Machine « multi-01 » — la machine à plusieurs scénarios
#
# Une seule image sert sept scénarios différents : l'élève y cherche une
# injection SQL sur une autre, un mot de passe oublié sur une autre, une
# injection de script sur une autre… La machine ne change pas, c'est la
# mission qui change. C'est ce qui rend le contenu tenable : on n'écrit
# pas un serveur par room.
#
# Construction :
#   docker build -t securalabs/multi-01:1.0 labs/multi-01
#
# Test :
#   docker run --rm -d -p 8080:8080 securalabs/multi-01:1.0

FROM php:8.2-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        bash \
        netcat-openbsd \
        curl \
        python3 \
        procps \
        less \
        nano \
        openssl \
        ca-certificates \
    && rm -rf /var/lib/apt/lists/*

# Utilisateur non privilégié : le conteneur ne tourne jamais en root.
RUN groupadd -g 1000 ctf \
    && useradd -u 1000 -g 1000 -m -s /bin/bash ctf

WORKDIR /var/www/html

COPY app/ /var/www/html/
COPY flag/ /root/flags/
COPY notes/notes.txt /home/ctf/notes.txt

# Les repertoires de travail sont crees a la construction : le conteneur
# tourne en utilisateur 1000 et ne peut pas creer de repertoire a la racine.
RUN mkdir -p /var/backups/app /srv/app /var/log/app \
    && chown -R ctf:ctf /var/www/html /home/ctf /var/backups /srv/app /var/log/app \
    && chmod 400 /root/flags/*.txt \
    && chown root:root /root/flags/*.txt \
    && chmod 755 /root \
    && chmod +x /var/www/html/entrypoint.sh

# Port 8080 (et non 80) : le conteneur tourne sans privilèges, un port
# inférieur à 1024 exigerait une capability particulière que l'on n'ouvre
# pas. Le port 8443 sert la variante HTTPS du scénario « certificat ».
# Le site par defaut ecoute aussi sur le nouveau port, sinon Apache sert
# une page vide sur 8080. Le site SSL par defaut (port 443) est desactive :
# un port inferieur a 1024 est interdit sans privileges.
RUN sed -i 's/^Listen 80$/Listen 8080/' /etc/apache2/ports.conf \
    && sed -i 's/^Listen \[::\]:80$/Listen [::]:8080/' /etc/apache2/ports.conf \
    && sed -i 's|<VirtualHost \*:80>|<VirtualHost *:8080>|' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|<VirtualHost _default_:80>|<VirtualHost _default_:8080>|' /etc/apache2/sites-available/000-default.conf \
    && a2dissite default-ssl \
    && sed -i '/^[[:space:]]*Listen 443/d' /etc/apache2/ports.conf \
    && printf 'ServerName localhost\n' > /etc/apache2/conf-available/secura-servername.conf \
    && a2enconf secura-servername \
    && printf '\nListen 8443\n' >> /etc/apache2/ports.conf

# Certificat auto-signé : le scénario « le certificat qui ne prouve rien »
# consiste à ouvrir la connexion en TLS et à lire le certificat.
RUN mkdir -p /etc/ssl/secura \
    && openssl req -x509 -newkey rsa:2048 -nodes -days 3650 \
        -subj "/CN=intranet.lab" \
        -addext "subjectAltName=DNS:intranet.lab,DNS:web.lab,IP:127.0.0.1" \
        -keyout /etc/ssl/secura/key.pem \
        -out /etc/ssl/secura/cert.pem \
    && chmod 644 /etc/ssl/secura/cert.pem /etc/ssl/secura/key.pem

COPY conf/securesecura.conf /etc/apache2/conf-available/securesecura.conf
RUN a2enmod ssl && a2enconf securesecura

EXPOSE 8080 8443

ENTRYPOINT ["/var/www/html/entrypoint.sh"]
CMD ["apache2-foreground"]
