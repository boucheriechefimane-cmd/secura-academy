# Machine 1 — application web vulnérable
#
# But pédagogique : une application PHP avec une injection SQL sur le formulaire
# de connexion. L'apprenant doit :
#   1. scanner la machine (nmap),
#   2. identifier le formulaire de connexion,
#   3. exploiter l'injection pour se connecter en administrateur,
#   4. lire le drapeau.
#
# Construction : docker build -t securalabs/web-01:1.0 labs/web-01
# Test         : docker run --rm -d -p 8080:8080 securalabs/web-01:1.0

FROM php:8.2-apache

# Outils présents dans la machine cible (parce que l'apprenant doit les
# pouvoir utiliser : c'est une machine de laboratoire, pas un serveur).
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

# Utilisateur non privilégié : le conteneur ne tourne jamais en root.
RUN groupadd -g 1000 ctf \
    && useradd -u 1000 -g 1000 -m -s /bin/bash ctf

WORKDIR /var/www/html

COPY app/ /var/www/html/
COPY flag/flag.txt /root/flag.txt
COPY flag/ /root/flags/
COPY notes/notes.txt /home/ctf/notes.txt

RUN mkdir -p /var/log/app /srv/app \
    && chown -R ctf:ctf /var/www/html /home/ctf /var/log/app \
    && chmod 444 /root/flag.txt \
    && chown root:ctf /root/flag.txt \
    && chmod 400 /root/flags/*.txt \
    && chown root:root /root/flags/*.txt \
    && chmod 755 /root \
    && chmod +x /var/www/html/entrypoint.sh

# Configuration interne de l'application : c'est ici qu'est le compte de
# service, reutilise tel quel sur le noeud interne (scenario « pivot »).
RUN mkdir -p /srv/app \
    && printf '# Configuration interne — ne pas diffuser.\napp_user = admin\ndb_password = Intranet2019!\nproxy_tool = /proxy.php\n' > /srv/app/app.conf \
    && chmod 644 /srv/app/app.conf \
    && chown -R ctf:ctf /srv/app

# La page d'accueil est servie par Apache.
#
# Port 8080 et non 80 : le conteneur tourne sans privileges (utilisateur
# 1000, toutes les capacites retirees). Un port inferieur a 1024 exige
# une capability speciale, que l'on ne veut pas ouvrir dans un lab.
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
