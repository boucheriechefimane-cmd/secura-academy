# Machine « internal-01 » — le nœud interne du réseau de laboratoire
#
# Ce nœud n'est joignable qu'après un pivot : il vit sur un autre système
# de fichiers que la machine « web ». Tant que l'élève n'a pas atteint ce
# nœud, le drapeau n'existe pas dans son environnement.
#
# Construction :
#   docker build -t securalabs/internal-01:1.0 labs/internal-01

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
    && rm -rf /var/lib/apt/lists/*

RUN groupadd -g 1000 ctf \
    && useradd -u 1000 -g 1000 -m -s /bin/bash ctf

WORKDIR /var/www/html

COPY app/ /var/www/html/
COPY flag/ /root/flags/
COPY notes/notes.txt /home/ctf/notes.txt

RUN mkdir -p /var/log/app \
    && chown -R ctf:ctf /var/www/html /home/ctf /var/log/app \
    && chmod 400 /root/flags/*.txt \
    && chown root:root /root/flags/*.txt \
    && chmod 755 /root \
    && chmod +x /var/www/html/entrypoint.sh

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
    && a2enconf secura-servername

EXPOSE 8080

ENTRYPOINT ["/var/www/html/entrypoint.sh"]
CMD ["apache2-foreground"]
