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
# Test         : docker run --rm -d -p 8080:80 securalabs/web-01:1.0

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
COPY flag/ /root/flag.txt
COPY notes/ /home/ctf/notes.txt

RUN chown -R ctf:ctf /var/www/html /home/ctf \
    && chmod 400 /root/flag.txt \
    && chown root:root /root/flag.txt \
    && chmod 755 /root \
    && chmod +x /var/www/html/entrypoint.sh

# La page d'accueil est servie par Apache, port 80 dans le conteneur.
EXPOSE 80

ENTRYPOINT ["/var/www/html/entrypoint.sh"]
CMD ["apache2-foreground"]
