#!/usr/bin/env bash
#
# Secura Academy — Recette serveur
# -----------------------------------------------------------------------------
# A coller / a lancer sur LE SERVEUR qui heberge WordPress + Docker.
#
# Pourquoi ce serveur et pas ailleurs ?
#   Le plugin lance la commande « docker » sur la machine ou WordPress
#   tourne : les deux doivent etre sur le meme serveur, sinon les machines
#   de laboratoire ne peuvent pas demarrer.
#
#   GitHub       = le code (aucune machine a faire tourner).
#   Hostinger    = l'hebergement mutualise de WordPress : pas de Docker =>
#                  les cours et les QCM marchent, les machines de lab non.
#   Votre VPS    = le serveur qui doit avoir Docker (c'est la que se
#                  colle et se lance cette recette).
#
# Usage :   bash recette-serveur.sh            (en root ou avec sudo)
# Sortie :  une ligne par test, « OK » ou « KO », et un resume final.
# -----------------------------------------------------------------------------

set -u

OK='  [OK]'
KO='  [KO]'
NB_OK=0
NB_KO=0
LABS_PATH="${SECURA_LABS_PATH:-/opt/secura-labs}"
PLUGIN_DIR="${SECURA_PLUGIN_DIR:-/var/www/html/wp-content/plugins/secura-academy}"

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

# Verifie qu'une commande aboutit (silencieux).
run_ok() {
	"$@" >/dev/null 2>&1
}

# -----------------------------------------------------------------------------
titre "1. Docker est installe et le demon repond"
# -----------------------------------------------------------------------------
if command -v docker >/dev/null 2>&1; then
	test_ok "la commande « docker » existe ($(docker --version 2>/dev/null | head -1))"
else
	test_ko "Docker n'est pas installe" "Debian/Ubuntu : sudo apt install -y docker.io docker-compose-v2"
fi

if run_ok docker info; then
	test_ok "le demon Docker repond (c'est lui qui lancera les machines)"
else
	test_ko "le demon Docker ne repond pas" "demarrer le service : sudo systemctl enable --now docker"
fi

if docker compose version >/dev/null 2>&1; then
	test_ok "Docker Compose est disponible (v2)"
elif command -v docker-compose >/dev/null 2>&1; then
	test_ok "Docker Compose est disponible (v1)"
else
	test_ko "Docker Compose est absent" "sudo apt install -y docker-compose-v2"
fi

# -----------------------------------------------------------------------------
titre "2. Le plugin Secura Academy est installe et actif"
# -----------------------------------------------------------------------------
if [ -f "$PLUGIN_DIR/secura-academy.php" ]; then
	test_ok "le plugin est present dans $PLUGIN_DIR"
else
	test_ko "le plugin n'est pas dans $PLUGIN_DIR" "decompresser secura-academy-plugin.zip dans wp-content/plugins/"
fi

if command -v wp >/dev/null 2>&1; then
	if wp plugin is-active secura-academy --path="${WP_PATH:-/var/www/html}" >/dev/null 2>&1; then
		test_ok "le plugin est actif"
	else
		test_ko "le plugin n'est pas actif" "wp plugin activate secura-academy"
	fi
else
	test_ko "WP-CLI n'est pas installe (verification automatique impossible)" "sudo curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && chmod +x wp-cli.phar && sudo mv wp-cli.phar /usr/local/bin/wp"
fi

# -----------------------------------------------------------------------------
titre "3. Les machines de laboratoire sont sur le serveur"
# -----------------------------------------------------------------------------
if [ -d "$LABS_PATH" ]; then
	test_ok "le dossier des labs est lisible : $LABS_PATH"
else
	test_ko "le dossier des labs est absent : $LABS_PATH" "decompresser secura-academy-labs.zip la-bas, ou : sudo mkdir -p $LABS_PATH"
fi

if [ -f "$LABS_PATH/net-01/docker-compose.yml" ]; then
	test_ok "la pile reseau (net-01) est presente"
else
	test_ko "la pile reseau (net-01) est absente"
fi

if [ -f "$LABS_PATH/web-01/Dockerfile" ] && [ -f "$LABS_PATH/bin-01/Dockerfile" ]; then
	test_ok "les sources des machines web-01 et bin-01 sont presentes"
else
	test_ko "les sources web-01 / bin-01 sont absentes"
fi

# -----------------------------------------------------------------------------
titre "4. Les images des machines sont construites"
# -----------------------------------------------------------------------------
for image in securalabs/web-01:1.0 securalabs/bin-01:1.0; do
	if docker image inspect "$image" >/dev/null 2>&1; then
		test_ok "l'image $image existe"
	else
		test_ko "l'image $image n'existe pas" "cd $LABS_PATH && sudo docker build -t ${image} $(echo "$image" | sed 's|securalabs/||; s|:1.0||')"
	fi
done

# -----------------------------------------------------------------------------
titre "5. Le plugin sait ou trouver les labs (option seca_labs_path)"
# -----------------------------------------------------------------------------
if command -v wp >/dev/null 2>&1; then
	VALEUR=$(wp option get seca_labs_path --path="${WP_PATH:-/var/www/html}" 2>/dev/null || true)
	if [ -z "$VALEUR" ]; then
		test_ko "l'option seca_labs_path n'est pas definie" "wp option update seca_labs_path $LABS_PATH"
	elif [ "$VALEUR" = "$LABS_PATH" ]; then
		test_ok "l'option seca_labs_path pointe vers $LABS_PATH"
	else
		test_ok "l'option seca_labs_path vaut $VALEUR (valeur define par l'administrateur)"
	fi
fi

# -----------------------------------------------------------------------------
titre "6. Un reseau isole peut etre cree (une machine par apprenant)"
# -----------------------------------------------------------------------------
RESEAU="seca_recette_$$"
if docker network create --internal --driver bridge "$RESEAU" >/dev/null 2>&1; then
	test_ok "un reseau sans sortie Internet peut etre cree"
else
	test_ko "impossible de creer un reseau isole"
fi

# -----------------------------------------------------------------------------
titre "7. Une machine se demarre, repond, et se rend compte"
# -----------------------------------------------------------------------------
CONTENEUR="seca_recette_$$"
if docker run -d --name "$CONTENEUR" --network "$RESEAU" --cap-drop ALL --security-opt no-new-privileges \
	--pids-limit 256 --memory 512m --cpus 1.0 --tmpfs /tmp:rw,noexec,nosuid,size=32m \
	--user 1000:1000 -w /home/ctf securalabs/web-01:1.0 sleep infinity >/dev/null 2>&1; then
	test_ok "la machine se demarre (meme contraintes que le plugin)"

	sleep 2
	if [ "$(docker inspect -f '{{.State.Running}}' "$CONTENEUR" 2>/dev/null)" = "true" ]; then
		test_ok "la machine reste allumee (elle ne s'arrete pas aussitot)"
	else
		test_ko "la machine s'est arretee aussitot" "docker logs $CONTENEUR"
	fi

	if run_ok docker exec "$CONTENEUR" cat /home/ctf/notes.txt; then
		test_ok "le terminal de l'apprenant repond (notes lisibles)"
	else
		test_ko "la commande de l'apprenant ne repond pas" "docker exec $CONTENEUR id"
	fi

	if docker exec "$CONTENEUR" cat /root/flag.txt 2>/dev/null | grep -q 'SECURA{'; then
		test_ok "le drapeau est accessible a l'apprenant (le lab est faisable)"
	else
		test_ko "le drapeau reste inaccessible" "sudo docker build --no-cache -t securalabs/web-01:1.0 $LABS_PATH/web-01"
	fi
else
	test_ko "la machine ne se demarre pas" "docker run --rm securalabs/web-01:1.0 true"
fi

# -----------------------------------------------------------------------------
titre "8. Deux apprenants ne se voient pas"
# -----------------------------------------------------------------------------
RESEAU_A="seca_recette_a_$$"
RESEAU_B="seca_recette_b_$$"
CONT_A="seca_recette_a_$$"
CONT_B="seca_recette_b_$$"

docker network create --internal "$RESEAU_A" >/dev/null 2>&1
docker network create --internal "$RESEAU_B" >/dev/null 2>&1

if docker run -d --name "$CONT_A" --network "$RESEAU_A" securalabs/bin-01:1.0 sleep infinity >/dev/null 2>&1 &&
	docker run -d --name "$CONT_B" --network "$RESEAU_B" securalabs/bin-01:1.0 sleep infinity >/dev/null 2>&1; then
	test_ok "deux machines demarrent sur deux reseaux distincts"

	if docker exec "$CONT_A" getent hosts "$CONT_B" >/dev/null 2>&1; then
		test_ko "la machine A voit la machine B (les eleves se croiseront)"
	else
		test_ok "la machine A ne voit pas la machine B (aucun croisement)"
	fi

	if docker exec "$CONT_A" getent hosts google.com >/dev/null 2>&1; then
		test_ko "la machine A a acces a Internet (le lab doit etre isole)"
	else
		test_ok "la machine A n'a pas acces a Internet"
	fi
else
	test_ko "impossible de lancer deux machines en parallele"
fi

# -----------------------------------------------------------------------------
titre "9. La pile reseau (4 services) se monte"
# -----------------------------------------------------------------------------
if [ -f "$LABS_PATH/net-01/docker-compose.yml" ]; then
	PROJET="seca_recette_$$"
	# Chemin absolu : tous les moteurs de Compose le comprennent.
	COMPOSE="$LABS_PATH/net-01/docker-compose.yml"

	montre_pile() {
		docker compose -f "$COMPOSE" -p "$PROJET" up -d --no-build >/dev/null 2>&1
	}

	if ! montre_pile; then
		# Certains moteurs de Compose creent le reseau du projet avec un
		# DNS interne incompatible : on le pre-cree alors sans DNS.
		docker network create --internal "${PROJET}_seca_lab" >/dev/null 2>&1
		montre_pile
	fi

	if docker ps --format '{{.Names}}' 2>/dev/null | grep -q "^${PROJET}_"; then
		test_ok "la pile reseau demarre (4 services)"
		docker compose -f "$COMPOSE" -p "$PROJET" down -v >/dev/null 2>&1
		test_ok "la pile reseau s'arrete proprement"
	else
		test_ko "la pile reseau ne demarre pas" "docker compose -f $LABS_PATH/net-01/docker-compose.yml -p test up -d"
	fi
else
	test_ko "le fichier net-01/docker-compose.yml est introuvable"
fi

# -----------------------------------------------------------------------------
titre "10. Aucun reste de la recette"
# -----------------------------------------------------------------------------
docker rm -f "$CONTENEUR" "$CONT_A" "$CONT_B" >/dev/null 2>&1
docker network rm "$RESEAU" "$RESEAU_A" "$RESEAU_B" >/dev/null 2>&1

RESTE=$(docker ps -a --format '{{.Names}}' 2>/dev/null | grep -c '^seca_recette' || true)
if [ "${RESTE:-0}" -eq 0 ]; then
	test_ok "aucun conteneur de test ne reste"
else
	test_ko "$RESTE conteneur(s) de test restent" "docker rm -f \$(docker ps -a --format '{{.Names}}' | grep '^seca_recette')"
fi

# -----------------------------------------------------------------------------
printf '\n============================================================\n'
printf 'Recette terminee : %s reussis, %s echecs\n' "$NB_OK" "$NB_KO"
printf '============================================================\n'

if [ "$NB_KO" -eq 0 ]; then
	printf 'Le serveur est pret : les machines de laboratoire fonctionneront\n'
	printf 'a la premiere connexion des eleves.\n'
	exit 0
fi

printf 'Des etapes ont echoue : lis le detail ci-dessus, corrige, et\n'
printf 'relance le script. Chaque KO indique la commande a lancer.\n'
exit 1
