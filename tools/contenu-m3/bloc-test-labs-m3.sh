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
		if docker exec "$WEB" curl -s http://localhost:8080/status.php 2>/dev/null | grep -q 'app.conf'; then
			test_ok "scénario 1 : la page d'état indique où est la configuration"
		else
			test_ko "scénario 1 : la page d'état ne répond pas"
		fi

		# --- Scénario 2 : le mot de passe en clair dans la configuration.
		if docker exec "$WEB" sh -c "grep -q 'db_password = Intranet2019!' /srv/app/app.conf" 2>/dev/null; then
			test_ok "scénario 2 : le mot de passe en clair est bien dans la configuration"
		else
			test_ko "scénario 2 : le mot de passe attendu est introuvable dans la configuration"
		fi

		# --- Scénario 4 : l'injection SQL passe.
		if docker exec "$WEB" curl -s -d "username=admin'--" -d "password=x" http://localhost:8080/index.php 2>/dev/null | grep -q 'Connect'; then
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
# Depuis le 6 novembre, ce lab ne repose plus sur setuid : le binaire est
# ordinaire, le scenario est un detournement de flot d'execution. Ces
# controles sont volontairement peu nombreux ici : le controle decisif
# (l'exploit obtient-il le drapeau ?) est dans scripts/test-labs-ci.sh,
# qui est la reference. Ce bloc verifie seulement l'etat de la machine.
CONT_BIN="seca_test_bin_$$"

if docker run -d --name "$CONT_BIN" --network "$RESEAU" \
	--cap-drop ALL --security-opt no-new-privileges --pids-limit 256 \
	--memory 512m --cpus 1.0 --tmpfs /tmp:rw,noexec,nosuid,size=32m \
	--user 1000:1000 -w /home/ctf securalabs/bin-01:1.0 sleep infinity >/dev/null 2>&1; then
	attendre 4

	if docker exec "$CONT_BIN" ls -l /home/ctf/vulnerable 2>/dev/null | grep -q '^[^ ]*rws'; then
		test_ko "scénario 9 : le binaire porte encore un bit setuid (scénario non portable)"
	else
		test_ok "scénario 9 : le binaire s'exécute sans aucun privilège particulier"
	fi

	if docker exec "$CONT_BIN" grep -q 'SECURA{' /root/flag.txt 2>/dev/null; then
		test_ko "scénario 9 : le corrigé est lisible en uid 1000"
	else
		test_ok "scénario 9 : le corrigé du serveur est illisible en uid 1000"
	fi

	if docker exec -u 0 "$CONT_BIN" grep -q 'FLAG=SECURA{buffer_overflow}' /root/flag.txt 2>/dev/null; then
		test_ok "scénario 9 : le serveur relit le corrigé en root"
	else
		test_ko "scénario 9 : le serveur ne peut pas relire le corrigé"
	fi

	docker rm -f "$CONT_BIN" >/dev/null 2>&1
else
	test_ko "la machine bin-01 ne démarre pas"
fi

# ---------------------------------------------------------------------------
# 8. Aucun reste
# ---------------------------------------------------------------------------
