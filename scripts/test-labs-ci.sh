#!/usr/bin/env bash
#
# Secura Academy — Test des machines de laboratoire avec de VRAIS conteneurs.
#
# Ce script est exécuté par GitHub Actions (le runner a Docker et les
# privilèges nécessaires) et peut être lancé à la main sur n'importe quel
# serveur possessing Docker.
#
# Il vérifie ce qui compte vraiment :
#   1. les images se construisent ;
#   2. une machine démarre, reste allumée et répond ;
#   3. le drapeau est accessible à l'apprenant (le lab est faisable) ;
#   4. deux apprenants ne se voient pas (aucun croisement) ;
#   5. une machine n'a pas accès à Internet ;
#   6. la pile réseau (4 services) monte, répond, et s'arrête ;
#   7. il ne reste rien derrière.
#
# Sortie : « OK » ou « KO » par test, et un code de retour (0 = tout va bien).

set -u

OK='  [OK]'
KO='  [KO]'
NB_OK=0
NB_KO=0

titre() {
	printf '\n=== %s ===\n' "$1"
}

test_ok() {
	NB_OK=$((NB_OK + 1))
	printf '%s %s\n' "$OK" "$1"
}

test_ko() {
	NB_KO=$((NB_KO + 1))
	printf '%s %s\n' "$KO" "$1"
	[ $# -gt 1 ] && printf '       %s\n' "$2"
	return 0
}

# Laisse le temps au conteneur de démarrer réellement.
attendre() {
	sleep "${1:-3}"
}

# ---------------------------------------------------------------------------
titre "1. Docker répond"
# ---------------------------------------------------------------------------
if docker info >/dev/null 2>&1; then
	test_ok "le démon Docker est disponible"
else
	test_ko "le démon Docker ne répond pas" "ce test doit tourner sur une machine avec Docker (runner GitHub Actions, VPS, poste de développement)"
	printf '\nImpossible de continuer.\n'
	exit 1
fi

# ---------------------------------------------------------------------------
titre "2. Les images des machines sont construites"
# ---------------------------------------------------------------------------
for image in securalabs/web-01:1.0 securalabs/bin-01:1.0 securalabs/multi-01:1.0 securalabs/internal-01:1.0 securalabs/univ-01:1.0 securalabs/dojo-01:1.0 securalabs/flags-01:1.0; do
	if docker image inspect "$image" >/dev/null 2>&1; then
		test_ok "l'image $image existe"
	else
		test_ko "l'image $image est absente" "docker build -t $image labs/$(echo "$image" | sed 's|securalabs/||; s|:1.0||')"
	fi
done

# ---------------------------------------------------------------------------
titre "3. Une machine démarre, répond, et son drapeau est accessible"
# ---------------------------------------------------------------------------
RESEAU="seca_test_a_$$"
CONT="seca_test_a_$$"

docker network create --internal "$RESEAU" >/dev/null 2>&1

if docker run -d --name "$CONT" --network "$RESEAU" \
	--cap-drop ALL --security-opt no-new-privileges --pids-limit 256 \
	--memory 512m --cpus 1.0 --tmpfs /tmp:rw,noexec,nosuid,size=32m \
	--user 1000:1000 -w /home/ctf securalabs/web-01:1.0 sleep infinity >/dev/null 2>&1; then
	test_ok "la machine se démarre (avec les mêmes contraintes que le plugin)"

	attendre 3

	if [ "$(docker inspect -f '{{.State.Running}}' "$CONT" 2>/dev/null)" = "true" ]; then
		test_ok "la machine reste allumée (elle ne s'arrête pas aussitôt)"
	else
		test_ko "la machine s'est arrêtée aussitôt" "docker logs $CONT"
	fi

	IDENT=$(docker exec "$CONT" id 2>/dev/null | head -1)

	if [ -n "$IDENT" ]; then
		test_ok "le terminal de l'apprenant répond : $IDENT"
	else
		test_ko "le terminal de l'apprenant ne répond pas" "docker exec $CONT id"
	fi

	if docker exec "$CONT" cat /home/ctf/notes.txt >/dev/null 2>&1; then
		test_ok "les notes de l'équipe sont lisibles"
	else
		test_ko "les notes ne sont pas lisibles" "docker exec $CONT ls -l /home/ctf"
	fi

	if docker exec "$CONT" cat /root/flag.txt 2>/dev/null | grep -q 'SECURA{'; then
		test_ok "le drapeau est accessible à l'apprenant (le lab est faisable)"
	else
		test_ko "le drapeau reste inaccessible" "docker build --no-cache -t securalabs/web-01:1.0 labs/web-01"
	fi
else
	test_ko "la machine ne démarre pas" "docker run --rm securalabs/web-01:1.0 true"
fi

# ---------------------------------------------------------------------------
titre "4. Deux apprenants ne se voient pas"
# ---------------------------------------------------------------------------
RESEAU_B="seca_test_b_$$"
CONT_B="seca_test_b_$$"

docker network create --internal "$RESEAU_B" >/dev/null 2>&1

if docker run -d --name "$CONT_B" --network "$RESEAU_B" securalabs/bin-01:1.0 sleep infinity >/dev/null 2>&1; then
	attendre 2
	test_ok "deux machines tournent sur deux réseaux distincts"

	IP_B=$(docker inspect -f '{{.NetworkSettings.Networks.'"$RESEAU_B"'.IPAddress}}' "$CONT_B" 2>/dev/null)

	if docker exec "$CONT" getent hosts "$CONT_B" >/dev/null 2>&1; then
		test_ko "la machine A resolve le nom de la machine B"
	else
		test_ok "la machine A ne voit pas le nom de la machine B"
	fi

	if [ -n "$IP_B" ] && docker exec "$CONT" curl -s --connect-timeout 3 "http://$IP_B:8080/" >/dev/null 2>&1; then
		test_ko "la machine A joint la machine B par son adresse IP (les élèves se croiseront)"
	else
		test_ok "la machine A ne joint pas la machine B (aucun croisement)"
	fi
else
	test_ko "impossible de lancer la seconde machine"
fi

# ---------------------------------------------------------------------------
titre "5. Une machine n'a pas accès à Internet"
# ---------------------------------------------------------------------------
if docker exec "$CONT" getent hosts example.com >/dev/null 2>&1; then
	test_ko "la machine A atteint Internet (le lab doit être isolé)"
else
	test_ok "la machine A n'atteint pas Internet (réseau sans sortie)"
fi

# ---------------------------------------------------------------------------
titre "6. La pile réseau (4 services) monte, répond et s'arrête"
# ---------------------------------------------------------------------------
# Chemin absolu : tous les moteurs de Compose le comprennent.
COMPOSE="$(pwd)/labs/net-01/docker-compose.yml"

if [ -f "$COMPOSE" ]; then
	PROJET="seca_test_$$"

	if docker compose -f "$COMPOSE" -p "$PROJET" up -d --no-build >/dev/null 2>&1; then
		attendre 5
		NB_SERVICES=$(docker ps --format '{{.Names}}' | grep -c "^${PROJET}[_-]" || true)

		if [ "${NB_SERVICES:-0}" -ge 4 ]; then
			test_ok "les 4 services de la pile sont démarrés"
		else
			test_ko "seulement ${NB_SERVICES:-0} service(s) démarré(s)" "docker compose -f "$COMPOSE" -p $PROJET up -d"
		fi

		CODE=$(docker exec "${PROJET}-web-1" curl -s -o /dev/null -w '%{http_code}' http://localhost:8080/index.php 2>/dev/null || true)

		if [ -z "$CODE" ]; then
			CODE=$(docker exec "${PROJET}_web_1" curl -s -o /dev/null -w '%{http_code}' http://localhost:8080/index.php 2>/dev/null || true)
		fi

		if [ "${CODE:-}" = "200" ]; then
			test_ok "le serveur web du lab répond (HTTP 200 sur le port 8080)"
		else
			test_ko "le serveur web du lab ne répond pas (code obtenu : ${CODE:-aucun})" "docker compose -f $COMPOSE logs web"
		fi

		CODE_ATTAQUE=$(docker exec "${PROJET}-attacker-1" curl -s -o /dev/null -w '%{http_code}' http://web:8080/index.php 2>/dev/null || true)

		if [ -z "$CODE_ATTAQUE" ]; then
			CODE_ATTAQUE=$(docker exec "${PROJET}_attacker_1" curl -s -o /dev/null -w '%{http_code}' http://web:8080/index.php 2>/dev/null || true)
		fi

		if [ "${CODE_ATTAQUE:-}" = "200" ]; then
			test_ok "l'apprenant atteint la cible par son nom (http://web:8080)"
		else
			test_ko "l'apprenant n'atteint pas la cible (code obtenu : ${CODE_ATTAQUE:-aucun})"
		fi

		docker compose -f "$COMPOSE" -p "$PROJET" down -v >/dev/null 2>&1

		if [ "$(docker ps --format '{{.Names}}' | grep -c "^${PROJET}[_-]" || true)" -eq 0 ]; then
			test_ok "la pile s'arrête proprement"
		else
			test_ko "des conteneurs de la pile restent après l'arrêt"
		fi
	else
		test_ko "la pile réseau ne démarre pas" "docker compose -f $COMPOSE -p test up -d"
	fi
else
	test_ko "labs/net-01/docker-compose.yml est introuvable"
fi

# ---------------------------------------------------------------------------
# 7. Les dix scénarios M3 sont jouables sur de vraies machines
# ---------------------------------------------------------------------------
titre "7. Les scénarios M3 sont jouables (preuve de travail)"

# Sur le nœud « web » de la pile multi-nœuds (étape 6), on rejoue les
# scénarios qui utilisent cette machine.
if [ -f "$COMPOSE" ]; then
	PROJET_M3="seca_m3_$$"

	if docker compose -f "$COMPOSE" -p "$PROJET_M3" up -d --no-build >/dev/null 2>&1; then
		attendre 6

		WEB="${PROJET_M3}-web-1"
		WEB_ALT="${PROJET_M3}_web_1"
		ATTACKER="${PROJET_M3}-attacker-1"
		ATTACKER_ALT="${PROJET_M3}_attacker_1"
		INTERNAL="${PROJET_M3}-internal-1"
		INTERNAL_ALT="${PROJET_M3}_internal_1"

		# Le noeud « web » doit repondre.
		if docker exec "$WEB" true >/dev/null 2>&1; then
			:
		elif docker exec "$WEB_ALT" true >/dev/null 2>&1; then
			WEB="$WEB_ALT"
			ATTACKER="$ATTACKER_ALT"
			INTERNAL="$INTERNAL_ALT"
		fi

		# --- Scénario 1 : la page de diagnostic mène à la configuration.
		if docker exec "$WEB" curl -s http://localhost:8080/diag.php 2>/dev/null | grep -q 'app.conf'; then
			test_ok "scénario 1 : la page de diagnostic indique où est la configuration"
		else
			test_ko "scénario 1 : la page de diagnostic ne répond pas"
		fi

		# --- Scénario 2 : le mot de passe en clair dans la configuration.
		if docker exec "$WEB" sh -c "grep -q 'db_password = Intranet2019!' /srv/app/app.conf" 2>/dev/null; then
			test_ok "scénario 2 : le mot de passe en clair est bien dans la configuration"
		else
			test_ko "scénario 2 : le mot de passe attendu est introuvable dans la configuration"
		fi

		# --- Scénario 4 : l'injection SQL passe (le formulaire redirige
		#     vers l'espace administrateur : on suit la redirection).
		if docker exec "$WEB" sh -c "curl -s -c /tmp/cj -b /tmp/cj -L -d \"username=admin'--\" -d 'password=x' http://localhost:8080/index.php" 2>/dev/null | grep -q 'Administration'; then
			test_ok "scénario 4 : l'injection SQL permet de se connecter"
		else
			test_ko "scénario 4 : l'injection SQL ne fonctionne pas"
		fi

		# --- Scénario 7 : l'export CSV contient le drapeau.
		if docker exec "$WEB" curl -s http://localhost:8080/export.csv 2>/dev/null | grep -q 'FLAG=SECURA{ports_are_loud}'; then
			test_ok "scénario 7 : l'export CSV du nœud web contient le drapeau"
		else
			test_ko "scénario 7 : l'export CSV ne contient pas le drapeau attendu"
		fi

		# --- Scénario 8 : le nœud interne est hors d'atteinte depuis la
		#     machine de l'apprenant, mais accessible depuis le nœud web.
		if docker exec "$ATTACKER" getent hosts internal >/dev/null 2>&1; then
			test_ko "scénario 8 : l'apprenant resolve le nom du nœud interne (le pivot est inutile)"
		else
			test_ok "scénario 8 : le nœud interne est invisible depuis la machine de l'apprenant"
		fi

		if docker exec "$ATTACKER" curl -s --connect-timeout 3 http://internal:8080/ >/dev/null 2>&1; then
			test_ko "scénario 8 : l'apprenant joint le nœud interne directement (segmentation absente)"
		else
			test_ok "scénario 8 : l'apprenant ne joint pas le nœud interne directement"
		fi

		if docker exec "$WEB" curl -s --connect-timeout 3 http://internal:8080/ 2>/dev/null | grep -q 'Archivage interne'; then
			test_ok "scénario 8 : le nœud web, lui, joint le nœud interne (le pivot est possible)"
		else
			test_ko "scénario 8 : le nœud web n'atteint pas le nœud interne"
		fi

		# --- Scénario 8 : le pivot par l'outil de supervision.
		if docker exec "$ATTACKER" curl -s --connect-timeout 5 "http://web:8080/proxy.php?url=http://internal:8080/" 2>/dev/null | grep -q 'Archivage interne'; then
			test_ok "scénario 8 : l'outil de supervision du nœud web permet d'atteindre l'interne"
		else
			test_ko "scénario 8 : l'outil de supervision ne renvoie pas la page interne"
		fi

		if docker exec "$ATTACKER" curl -s --connect-timeout 5 -d "username=admin" -d "password=Intranet2019!" "http://web:8080/proxy.php?url=http://internal:8080/" 2>/dev/null | grep -q 'FLAG=SECURA{pivot_accompli}'; then
			test_ok "scénario 8 : le mot de passe réutilisé ouvre l'archivage interne (drapeau obtenu)"
		else
			test_ko "scénario 8 : le mot de passe réutilisé n'ouvre pas l'archivage interne"
		fi

		# --- Le drapeau du nœud interne est protégé, mais lisible par le
		#     serveur (comme le fera le plugin).
		if docker exec -u 0 "$INTERNAL" cat /root/flags/flag-08.txt 2>/dev/null | grep -q 'FLAG=SECURA{pivot_accompli}'; then
			test_ok "scénario 8 : le serveur lit le drapeau du nœud interne en root"
		else
			test_ko "scénario 8 : le serveur ne peut pas lire le drapeau du nœud interne"
		fi

		if docker exec "$INTERNAL" cat /root/flags/flag-08.txt >/dev/null 2>&1; then
			test_ko "scénario 8 : l'apprenant peut lire le fichier de drapeau directement"
		else
			test_ok "scénario 8 : le fichier de drapeau est illisible par l'apprenant"
		fi

		docker compose -f "$COMPOSE" -p "$PROJET_M3" down -v >/dev/null 2>&1
	fi
fi

# --- La machine « multi-01 » (scénarios 1 à 6 et 10).
CONT_M3="seca_test_multi_$$"

if docker run -d --name "$CONT_M3" --network "$RESEAU" \
	--cap-drop ALL --security-opt no-new-privileges --pids-limit 256 \
	--memory 512m --cpus 1.0 --tmpfs /tmp:rw,noexec,nosuid,size=32m \
	--user 1000:1000 -w /home/ctf securalabs/multi-01:1.0 sleep infinity >/dev/null 2>&1; then
	attendre 5

	# Scénario 1 : triage.
	if docker exec "$CONT_M3" curl -s http://localhost:8080/status.php 2>/dev/null | grep -q 'app.conf'; then
		test_ok "scénario 1 (multi-01) : la page d'état fonctionne"
	else
		test_ko "scénario 1 (multi-01) : la page d'état ne fonctionne pas"
	fi

	if docker exec "$CONT_M3" sh -c "grep -q 'build_id    = FLAG=SECURA{triage_patient}' /srv/app/app.conf" 2>/dev/null; then
		test_ok "scénario 1 (multi-01) : le code de version interne est dans la configuration"
	else
		test_ko "scénario 1 (multi-01) : le code de version interne est introuvable"
	fi

	# Scénario 3 : injection de script réfléchie + robot.
	if docker exec "$CONT_M3" curl -s "http://localhost:8080/search.php?q=<script>alert(1)</script>" 2>/dev/null | grep -q '<script>alert(1)</script>'; then
		test_ok "scénario 3 (multi-01) : la saisie est renvoyée telle quelle (XSS réfléchie)"
	else
		test_ko "scénario 3 (multi-01) : la saisie n'est pas renvoyée telle quelle"
	fi

	docker exec "$CONT_M3" curl -s "http://localhost:8080/bot.php?url=http://localhost:8080/search.php?q=<script>alert(1)</script>" >/dev/null 2>&1

	if docker exec "$CONT_M3" cat /var/log/app/stolen.txt 2>/dev/null | grep -q 'FLAG=SECURA{xss_reflected}'; then
		test_ok "scénario 3 (multi-01) : le robot a enregistré le jeton de session"
	else
		test_ko "scénario 3 (multi-01) : le robot n'a rien enregistré"
	fi

	# Scénario 4 : injection SQL.
	if docker exec "$CONT_M3" curl -s -d "username=admin'--" -d "password=x" http://localhost:8080/index.php 2>/dev/null | grep -q 'Connect'; then
		test_ok "scénario 4 (multi-01) : l'injection SQL fonctionne"
	else
		test_ko "scénario 4 (multi-01) : l'injection SQL ne fonctionne pas"
	fi

	# Scénario 5 : traversée de répertoire (trois niveaux).
	if docker exec "$CONT_M3" curl -s "http://localhost:8080/download.php?file=../../../srv/app/app.conf" 2>/dev/null | grep -q 'db_password = Intranet2019!'; then
		test_ok "scénario 5 (multi-01) : la traversée de répertoire lit la configuration"
	else
		test_ko "scénario 5 (multi-01) : la traversée de répertoire ne fonctionne pas"
	fi

	if docker exec "$CONT_M3" curl -s "http://localhost:8080/download.php?file=../../../var/backups/app/licences.sql" 2>/dev/null | grep -q 'FLAG=SECURA{backup_exposed}'; then
		test_ok "scénario 5 (multi-01) : la sauvegarde oubliée livre la clé de licence"
	else
		test_ko "scénario 5 (multi-01) : la sauvegarde oubliée ne livre pas la clé"
	fi

	# Scénario 6 : analyse de journaux.
	if docker exec "$CONT_M3" sh -c "grep -q 'jeton=FLAG=SECURA{log_never_lies}' /var/log/app/access.log" 2>/dev/null; then
		test_ok "scénario 6 (multi-01) : le journal contient la requête réussie"
	else
		test_ko "scénario 6 (multi-01) : le journal ne contient pas la requête réussie"
	fi

	# Scénario 10 : TLS.
	if docker exec "$CONT_M3" curl -sk https://localhost:8443/tls-secret.php 2>/dev/null | grep -q 'FLAG=SECURA{tls_not_proof}'; then
		test_ok "scénario 10 (multi-01) : la page secrète répond en HTTPS"
	else
		test_ko "scénario 10 (multi-01) : la page secrète ne répond pas en HTTPS"
	fi

	if docker exec "$CONT_M3" curl -s http://localhost:8080/tls-secret.php 2>/dev/null | grep -q 'introuvable'; then
		test_ok "scénario 10 (multi-01) : la page secrète est introuvable en HTTP simple"
	else
		test_ko "scénario 10 (multi-01) : la page secrète répond en HTTP simple"
	fi

	# Les fichiers de drapeau sont proteges, mais le serveur y accede.
	if docker exec "$CONT_M3" cat /root/flags/flag-01.txt >/dev/null 2>&1; then
		test_ko "scénario 1 (multi-01) : l'apprenant lit directement le fichier de drapeau"
	else
		test_ok "scénario 1 (multi-01) : les fichiers de drapeau sont illisibles par l'apprenant"
	fi

	if docker exec -u 0 "$CONT_M3" cat /root/flags/flag-01.txt 2>/dev/null | grep -q 'FLAG=SECURA{triage_patient}'; then
		test_ok "scénario 1 (multi-01) : le serveur lit le drapeau en root"
	else
		test_ko "scénario 1 (multi-01) : le serveur ne peut pas lire le drapeau"
	fi

	docker rm -f "$CONT_M3" >/dev/null 2>&1
else
	test_ko "la machine multi-01 ne démarre pas" "docker run --rm securalabs/multi-01:1.0 true"
fi

# --- La machine « bin-01 » (scénario 9).
CONT_BIN="seca_test_bin_$$"

if docker run -d --name "$CONT_BIN" --network "$RESEAU" \
	--cap-drop ALL --security-opt no-new-privileges --pids-limit 256 \
	--memory 512m --cpus 1.0 --tmpfs /tmp:rw,noexec,nosuid,size=32m \
	--user 1000:1000 -w /home/ctf securalabs/bin-01:1.0 sleep infinity >/dev/null 2>&1; then
	attendre 4

	if docker exec "$CONT_BIN" ls -l /home/ctf/vulnerable 2>/dev/null | grep -q 'rws'; then
		test_ok "scénario 9 : le binaire est bien setuid root (le shell obtenu sera root)"
	else
		test_ko "scénario 9 : le binaire n'est pas setuid root" "docker exec $CONT_BIN ls -l /home/ctf/vulnerable"
	fi

	if docker exec "$CONT_BIN" cat /root/flag.txt >/dev/null 2>&1; then
		test_ko "scénario 9 : l'apprenant lit le drapeau sans avoir obtenu de shell"
	else
		test_ok "scénario 9 : le drapeau reste protégé tant qu'aucun shell root n'est obtenu"
	fi

	if docker exec -u 0 "$CONT_BIN" cat /root/flag.txt 2>/dev/null | grep -q 'FLAG=SECURA{buffer_overflow}'; then
		test_ok "scénario 9 : le serveur lit le drapeau du binaire en root"
	else
		test_ko "scénario 9 : le serveur ne peut pas lire le drapeau du binaire"
	fi

	docker rm -f "$CONT_BIN" >/dev/null 2>&1
else
	test_ko "la machine bin-01 ne démarre pas"
fi

# ---------------------------------------------------------------------------
# 8. La machine « univ-01 » : les vingt-deux rooms universitaires
# ---------------------------------------------------------------------------
CONT_UNI="seca_test_univ_$$"

if docker run -d --name "$CONT_UNI" --network "$RESEAU" \
	--cap-drop ALL --security-opt no-new-privileges --pids-limit 256 \
	--memory 512m --cpus 1.0 --tmpfs /tmp:rw,noexec,nosuid,size=32m \
	--user 1000:1000 -w /home/ctf securalabs/univ-01:1.0 sleep infinity >/dev/null 2>&1; then
	attendre 3

	if docker exec "$CONT_UNI" cat /home/ctf/notes.txt 2>/dev/null | grep -q 'Salle des cours'; then
		test_ok "univ-01 : l'apprenant lit les notes de la salle des cours"
	else
		test_ko "univ-01 : les notes de la salle des cours sont introuvables"
	fi

	if docker exec "$CONT_UNI" cat /srv/cours/mit858/analyse-risque.md 2>/dev/null | grep -q 'risque_critique = FLAG=SECURA{modele_de_menace}'; then
		test_ok "univ-01 : le livrable du cours 6.858 contient la valeur attendue"
	else
		test_ko "univ-01 : le livrable du cours 6.858 ne contient pas la valeur attendue"
	fi

	if docker exec "$CONT_UNI" cat /etc/secura-policy/policy.conf 2>/dev/null | grep -q 'FLAG=SECURA{privileges_separes}'; then
		test_ok "univ-01 : la politique de separation des privileges est lisible"
	else
		test_ko "univ-01 : la politique de separation des privileges est introuvable"
	fi

	if docker exec "$CONT_UNI" cat /home/ctf/pwn/memory-notebook.md 2>/dev/null | grep -q 'FLAG=SECURA{pile_x86}'; then
		test_ok "univ-01 : les TP pwn.college sont lisibles"
	else
		test_ko "univ-01 : les TP pwn.college sont introuvables"
	fi

	# Les drapeaux ne doivent pas etre lisibles par l'apprenant...
	if docker exec "$CONT_UNI" cat /root/flags/flag-u01.txt >/dev/null 2>&1; then
		test_ko "univ-01 : l'apprenant lit directement un fichier de drapeau"
	else
		test_ok "univ-01 : les fichiers de drapeau sont illisibles par l'apprenant"
	fi

	# ... mais le serveur (root) doit pouvoir les lire.
	MANQUES=0

	for numero in $(seq -w 1 22); do
		if ! docker exec -u 0 "$CONT_UNI" cat "/root/flags/flag-u$numero.txt" 2>/dev/null | grep -q 'FLAG=SECURA{'; then
			MANQUES=$((MANQUES + 1))
		fi
	done

	if [ "$MANQUES" -eq 0 ]; then
		test_ok "univ-01 : le serveur lit les vingt-deux drapeaux en root"
	else
		test_ko "univ-01 : $MANQUES drapeau(s) illisibles en root"
	fi

	# Chaque valeur annoncee dans un livrable doit etre le drapeau du serveur.
	COHERENCE=0

	for numero in $(seq -w 1 22); do
		VALEUR=$(docker exec -u 0 "$CONT_UNI" cat "/root/flags/flag-u$numero.txt" 2>/dev/null | tr -d '\r\n')

		if [ -z "$VALEUR" ]; then
			continue
		fi

		if ! docker exec "$CONT_UNI" grep -rl "$VALEUR" /srv/cours /etc/secura-policy /opt/labs /home/ctf 2>/dev/null | grep -q .; then
			COHERENCE=$((COHERENCE + 1))
		fi
	done

	if [ "$COHERENCE" -eq 0 ]; then
		test_ok "univ-01 : chaque drapeau est decouvrable dans les livrables de cours"
	else
		test_ko "univ-01 : $COHERENCE drapeau(s) ne sont decouvrables nulle part"
	fi

	docker rm -f "$CONT_UNI" >/dev/null 2>&1
else
	test_ko "la machine univ-01 ne démarre pas"
fi

# ---------------------------------------------------------------------------
# 9. La machine « dojo-01 » : vingt defis, cinq ceintures, sept briefs
# ---------------------------------------------------------------------------
CONT_DOJO="seca_test_dojo_$$"

if docker run -d --name "$CONT_DOJO" --network "$RESEAU" \
	--cap-drop ALL --security-opt no-new-privileges --pids-limit 256 \
	--memory 512m --cpus 1.0 --tmpfs /tmp:rw,noexec,nosuid,size=32m \
	--user 1000:1000 -w /home/ctf securalabs/dojo-01:1.0 sleep infinity >/dev/null 2>&1; then
	attendre 3

	if docker exec "$CONT_DOJO" cat /home/ctf/notes.txt 2>/dev/null | grep -q 'Dojo Secura'; then
		test_ok "dojo-01 : l'apprenant lit les notes du dojo"
	else
		test_ko "dojo-01 : les notes du dojo sont introuvables"
	fi

	if docker exec "$CONT_DOJO" ls /srv/dojo/1-blanche >/dev/null 2>&1 && \
		docker exec "$CONT_DOJO" ls /srv/dojo/5-noire >/dev/null 2>&1; then
		test_ok "dojo-01 : les cinq ceintures sont presentes"
	else
		test_ko "dojo-01 : les ceintures du dojo sont introuvables"
	fi

	if docker exec "$CONT_DOJO" ls /srv/briefs >/dev/null 2>&1; then
		test_ok "dojo-01 : les briefs sont presents"
	else
		test_ko "dojo-01 : les briefs sont introuvables"
	fi

	MANQUES_DOJO=0

	for numero in $(seq -w 1 20); do
		if ! docker exec -u 0 "$CONT_DOJO" cat "/root/flags/flag-d$numero.txt" 2>/dev/null | grep -q 'FLAG=SECURA{'; then
			MANQUES_DOJO=$((MANQUES_DOJO + 1))
		fi
	done

	for numero in $(seq -w 01 07); do
		if ! docker exec -u 0 "$CONT_DOJO" cat "/root/flags/flag-b$numero.txt" 2>/dev/null | grep -q 'FLAG=SECURA{'; then
			MANQUES_DOJO=$((MANQUES_DOJO + 1))
		fi
	done

	if [ "$MANQUES_DOJO" -eq 0 ]; then
		test_ok "dojo-01 : le serveur lit les vingt-sept drapeaux en root"
	else
		test_ko "dojo-01 : $MANQUES_DOJO drapeau(s) illisibles en root"
	fi

	if docker exec "$CONT_DOJO" cat /root/flags/flag-d01.txt >/dev/null 2>&1; then
		test_ko "dojo-01 : l'apprenant lit directement un fichier de drapeau"
	else
		test_ok "dojo-01 : les fichiers de drapeau sont illisibles par l'apprenant"
	fi

	COHERENCE_DOJO=0

	for fichier in $(docker exec -u 0 "$CONT_DOJO" ls /root/flags 2>/dev/null); do
		VALEUR=$(docker exec -u 0 "$CONT_DOJO" cat "/root/flags/$fichier" 2>/dev/null | tr -d '\r\n')

		if [ -z "$VALEUR" ]; then
			continue
		fi

		if ! docker exec "$CONT_DOJO" grep -rl "$VALEUR" /srv/dojo /srv/briefs 2>/dev/null | grep -q .; then
			COHERENCE_DOJO=$((COHERENCE_DOJO + 1))
		fi
	done

	if [ "$COHERENCE_DOJO" -eq 0 ]; then
		test_ok "dojo-01 : chaque drapeau est decouvrable dans les documents du dojo"
	else
		test_ko "dojo-01 : $COHERENCE_DOJO drapeau(s) ne sont decouvrables nulle part"
	fi

	docker rm -f "$CONT_DOJO" >/dev/null 2>&1
else
	test_ko "la machine dojo-01 ne demarre pas"
fi

# ---------------------------------------------------------------------------
# 10. Le lab « juice-shop » : l'application web vulnerable de l'OWASP
# ---------------------------------------------------------------------------
PROJET_JUICE="seca_test_juice_$$"
COMPOSE_JUICE="labs/juice-shop/docker-compose.yml"

if docker compose -f "$COMPOSE_JUICE" -p "$PROJET_JUICE" up -d --build >/dev/null 2>&1; then
	# On demande a Compose les identifiants des conteneurs : c'est plus
	# sur que de deviner leur nom.
	CONT_ATTAQUE=$(docker compose -f "$COMPOSE_JUICE" -p "$PROJET_JUICE" ps -q attacker 2>/dev/null | head -1)
	CONT_FLAGS=$(docker compose -f "$COMPOSE_JUICE" -p "$PROJET_JUICE" ps -q flags 2>/dev/null | head -1)

	# L'application demarre en une trentaine de secondes : on attend.
	REPONSE_JUICE=0

	for essai in $(seq 1 30); do
		if docker exec "$CONT_ATTAQUE" curl -s -o /dev/null -w '%{http_code}' http://juice:3000/ 2>/dev/null | grep -q '200'; then
			REPONSE_JUICE=1
			break
		fi
		sleep 5
	done

	if [ "$REPONSE_JUICE" -eq 1 ]; then
		test_ok "juice-shop : l'application OWASP Juice Shop repond"
	else
		test_ko "juice-shop : l'application ne repond pas"
	fi

	if docker exec "$CONT_ATTAQUE" curl -s http://juice:3000/api/challenges 2>/dev/null | grep -q 'passwordHashLeakChallenge'; then
		test_ok "juice-shop : la liste des defis de l'application est lisible"
	else
		test_ko "juice-shop : la liste des defis est illisible"
	fi

	# Le drapeau du serveur : protege, et identique a celui de l'application.
	if docker exec "$CONT_FLAGS" cat /root/flags/flag-login-admin.txt >/dev/null 2>&1; then
		test_ko "juice-shop : l'apprenant lit directement le fichier de drapeau"
	else
		test_ok "juice-shop : le fichier de drapeau est illisible par l'apprenant"
	fi

	DRAPEAU_JOUE=0
	DRAPEAU_ATTENDU=$(python3 tools/juice-shop/ctf-flag.py --challenge "Login Admin" 2>/dev/null | grep '^drapeau:' | cut -d' ' -f2)

	if [ -n "$DRAPEAU_ATTENDU" ]; then
		DRAPEAU_JOUE=$(docker exec -u 0 "$CONT_FLAGS" cat /root/flags/flag-login-admin.txt 2>/dev/null | tr -d '\r\n')
	fi

	if [ -n "$DRAPEAU_ATTENDU" ] && [ "$DRAPEAU_ATTENDU" = "$DRAPEAU_JOUE" ]; then
		test_ok "juice-shop : le drapeau du serveur correspond a celui de l'application"
	else
		test_ko "juice-shop : le drapeau du serveur ne correspond pas a celui de l'application (attendu : ${DRAPEAU_ATTENDU:-vide} / lu : ${DRAPEAU_JOUE:-vide})"
	fi

	# Les conteneurs de la pile doivent etre la, tous les trois.
	if [ -n "$CONT_ATTAQUE" ] && [ -n "$CONT_FLAGS" ]; then
		test_ok "juice-shop : les trois services de la pile tournent"
	else
		test_ko "juice-shop : un service de la pile est absent"
	fi

	# L'eleve ne doit pas avoir de sortie Internet depuis le reseau du lab.
	if docker exec "$CONT_ATTAQUE" curl -s --max-time 5 -o /dev/null http://example.com 2>/dev/null; then
		test_ko "juice-shop : le reseau du lab laisse sortir vers Internet"
	else
		test_ok "juice-shop : le reseau du lab n'a pas de sortie Internet"
	fi

	docker compose -f "$COMPOSE_JUICE" -p "$PROJET_JUICE" down -v >/dev/null 2>&1
else
	test_ko "le lab juice-shop ne demarre pas"
fi

# ---------------------------------------------------------------------------
# 11. Aucun reste
# ---------------------------------------------------------------------------
docker rm -f "$CONT" "$CONT_B" "$CONT_M3" "$CONT_BIN" "$CONT_UNI" "$CONT_DOJO" >/dev/null 2>&1
docker network rm "$RESEAU" "$RESEAU_B" >/dev/null 2>&1

RESTE=$(docker ps -a --format '{{.Names}}' | grep -c '^seca_test' || true)

if [ "${RESTE:-0}" -eq 0 ]; then
	test_ok "aucun conteneur de test ne reste"
else
	test_ko "$RESTE conteneur(s) de test restent"
fi

printf '\n============================================================\n'
printf 'Tests des machines : %s reussis, %s echecs\n' "$NB_OK" "$NB_KO"
printf '============================================================\n'

if [ "$NB_KO" -eq 0 ]; then
	exit 0
fi

exit 1
