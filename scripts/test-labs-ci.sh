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
for image in securalabs/web-01:1.0 securalabs/bin-01:1.0; do
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
titre "7. Aucun reste"
# ---------------------------------------------------------------------------
docker rm -f "$CONT" "$CONT_B" >/dev/null 2>&1
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
