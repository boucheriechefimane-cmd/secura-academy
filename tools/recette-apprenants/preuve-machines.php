<?php
/**
 * La preuve des machines, room par room.
 *
 * Ce script ne remplace pas `scripts/test-labs-ci.sh` : il repond a une
 * autre question, celle du proprietaire — « les machines que mon
 * developpeur annonce pour chaque room existent-elles vraiment, et le
 * drapeau que la room exige est-il VRAIMENT dans l'image ? »
 *
 * Pour chaque room qui declare une machine, il :
 *
 *   1. verifie que l'image (ou la pile compose) declaree existe sur place ;
 *   2. demarre la machine avec les reglages du plugin (utilisateur non
 *      privilegie, aucune capacite, pas de sortie reseau) ;
 *   3. lit le drapeau exige par la room en root — l'endroit exact ou le
 *      plugin va le chercher (`flag_service` pour une pile compose) — et
 *      verifie qu'il contient bien une valeur `SECURA{...}` ;
 *   4. verifie que l'apprenant ne peut PAS lire ce fichier directement,
 *      sinon la room se resout sans rien comprendre ;
 *   5. joint la cible annoncee depuis l'interieur de la machine : le
 *      plugin ne publie aucun port, donc un essai depuis l'hote ne
 *      prouverait rien.
 *
 * Ce qui n'est pas mesurable est DIT, jamais suppose : une room sans
 * machine est listee comme telle, une room dont la machine est une pile
 * compose est mesuree puis demontee, et un echec est un echec.
 *
 * Execution (le script doit pouvoir appeler docker et wp) :
 *
 *   SECA_WP_DIR=/chemin/vers/wordpress \
 *   wp --path="$SECA_WP_DIR" --allow-root eval-file tools/recette-apprenants/preuve-machines.php
 *
 * Sortie : une ligne par room, une synthese, et un code 0 seulement si
 * chaque room declaree a livre son drapeau.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Lance une commande et renvoie sa sortie (stdout + stderr) et son code.
 *
 * @param string $commande Commande.
 * @return array{code:int,sortie:string}
 */
function seca_preuve_exec( $commande ) {
	$sortie = array();
	$code   = 0;

	exec( $commande . ' 2>&1', $sortie, $code );

	return array(
		'code'   => (int) $code,
		'sortie' => implode( "\n", $sortie ),
	);
}

/**
 * Attend qu'un conteneur tourne (ou rend la main apres le delai).
 *
 * @param string $nom    Nom du conteneur.
 * @param int    $essais Nombre d'essais.
 * @return bool
 */
function seca_preuve_attendre( $nom, $essais = 15 ) {
	for ( $i = 0; $i < $essais; $i++ ) {
		$etat = seca_preuve_exec( 'docker inspect -f "{{.State.Running}}" ' . escapeshellarg( $nom ) );

		if ( 'true' === trim( $etat['sortie'] ) ) {
			return true;
		}

		sleep( 1 );
	}

	return false;
}

/**
 * La valeur de drapeau contenue dans un texte (meme regle que le plugin).
 *
 * @param string $texte Texte.
 * @return string
 */
function seca_preuve_drapeau( $texte ) {
	$texte = trim( (string) $texte );

	if ( preg_match( '/SECURA\{[^}]+\}/i', $texte, $trouve ) ) {
		return strtolower( $trouve[0] );
	}

	/* Juice Shop n'affiche pas « SECURA{...} » mais une empreinte HMAC-SHA1
	   du nom du defi : le fichier de drapeau contient donc cette empreinte,
	   et le plugin la compare telle quelle (same_flag). C'est valide. */
	if ( preg_match( '/^[0-9a-f]{32,64}$/i', $texte ) ) {
		return strtolower( $texte );
	}

	return '';
}

/**
 * Joue une commande dans un conteneur, en root ou en apprenant.
 *
 * @param string $nom     Conteneur.
 * @param string $commande Commande shell.
 * @param bool   $root    Vrai pour lire avec les droits du serveur.
 * @return array{code:int,sortie:string}
 */
function seca_preuve_dans( $nom, $commande, $root = false ) {
	return seca_preuve_exec(
		'docker exec ' . ( $root ? '-u 0 ' : '' ) . escapeshellarg( $nom )
		. ' sh -c ' . escapeshellarg( $commande )
	);
}

/**
 * Demande a la machine de joindre une URL, sans dependre de curl.
 *
 * @param string $nom Conteneur.
 * @param string $url URL.
 * @return int Code HTTP mesure, 0 si rien ne repond.
 */
function seca_preuve_joindre( $nom, $url ) {
	$hote = (string) wp_parse_url( $url, PHP_URL_HOST );
	$port = wp_parse_url( $url, PHP_URL_PORT );
	$port = $port ? (int) $port : ( 'https' === wp_parse_url( $url, PHP_URL_SCHEME ) ? 443 : 80 );

	/* Les machines de cours (univ-01, dojo-01) n'ont pas curl : on essaie
	   curl, puis le client HTTP de PHP, puis un simple TCP en bash. Un
	   « 200 » synthetique signifie « le port repond », pas « la page est
	   correcte » — c'est ecrit dans le detail. */
	$script = 'if command -v curl >/dev/null 2>&1; then '
		. 'curl -sk -o /dev/null -w "%{http_code}" --max-time 8 ' . escapeshellarg( $url )
		. ' 2>/dev/null || echo 000; '
		. 'elif command -v php >/dev/null 2>&1; then '
		. 'php -r ' . escapeshellarg(
			'$e = @fsockopen(' . var_export( $hote, true ) . ', ' . $port . ', $n, $s, 8); echo $e ? "200" : "000";'
		) . '; '
		. 'elif command -v bash >/dev/null 2>&1; then '
		. 'bash -c ' . escapeshellarg( '(exec 3<>/dev/tcp/' . $hote . '/' . $port . ') 2>/dev/null && echo 200 || echo 000' ) . '; '
		. 'else echo 000; fi';

	/* Un serveur web (Apache, Node) met plusieurs secondes a ecouter : on
	   reessaie au lieu de conclure au premier refus. */
	for ( $essai = 0; $essai < 12; $essai++ ) {
		$reponse = seca_preuve_dans( $nom, $script );
		$code    = (int) trim( $reponse['sortie'] );

		if ( $code >= 200 && $code < 500 ) {
			return $code;
		}

		sleep( 2 );
	}

	return (int) trim( $reponse['sortie'] );
}

/**
 * Un port ecoute-t-il dans le conteneur ?
 *
 * dash (« sh » sous Debian) ne connait pas /dev/tcp : le test doit passer
 * par bash, sinon tout parait ferme. C'est l'erreur qui a fait declarer
 * « rien n'ecoute » a tort.
 *
 * @param string $nom  Conteneur.
 * @param string $hote Hote.
 * @param int    $port Port.
 * @return bool
 */
function seca_preuve_port_ouvert( $nom, $hote, $port ) {
	$sonde = 'if command -v bash >/dev/null 2>&1; then '
		. 'bash -c ' . escapeshellarg( '(exec 3<>/dev/tcp/' . $hote . '/' . $port . ') 2>/dev/null && echo ouvert || echo ferme' )
		. '; elif command -v php >/dev/null 2>&1; then '
		. 'php -r ' . escapeshellarg( '$e = @fsockopen(' . var_export( $hote, true ) . ', ' . (int) $port . ', $n, $s, 3); echo $e ? "ouvert" : "ferme";' )
		. '; else echo inconnu; fi';

	for ( $essai = 0; $essai < 10; $essai++ ) {
		$resultat = trim( seca_preuve_dans( $nom, $sonde )['sortie'] );

		if ( 'ouvert' === $resultat ) {
			return true;
		}

		sleep( 2 );
	}

	return false;
}

/**
 * La machine embarque-t-elle un client HTTP (curl ou wget) ?
 *
 * @param string $nom Conteneur.
 * @return bool
 */
function seca_preuve_a_client_http( $nom ) {
	$essai = seca_preuve_dans( $nom, 'command -v curl || command -v wget' );

	return '' !== trim( $essai['sortie'] );
}

/**
 * Le nom du service qui repond dans une pile, deduit de la cible.
 *
 * @param string $cible URL declaree par la room.
 * @return string
 */
function seca_preuve_service_cible( $cible ) {
	$hote = (string) wp_parse_url( $cible, PHP_URL_HOST );

	return '' === $hote ? '' : $hote;
}

/**
 * Verifie qu'un fichier cite par la room existe vraiment dans la machine.
 *
 * Une room qui demande d'ouvrir /home/ctf/vulnerable dans une image qui ne
 * le contient pas envoie l'apprenant dans le mur : c'est un echec, meme si
 * le drapeau, lui, est present.
 *
 * @param string $nom     Conteneur.
 * @param string $cible   Texte de la cible declaree.
 * @return array{0:bool,1:string} Existence et detail.
 */
function seca_preuve_cible_fichier( $nom, $cible ) {
	$candidats = array();
	$texte     = preg_replace( '/^[^:]*:\s*/', '', $cible );

	foreach ( preg_split( '/\s+/', (string) $texte ) as $mot ) {
		if ( '/' === substr( $mot, 0, 1 ) ) {
			$candidats[] = $mot;
		}
	}

	if ( empty( $candidats ) ) {
		return array( true, '' );
	}

	foreach ( $candidats as $chemin ) {
		$essai = seca_preuve_dans( $nom, 'test -e ' . escapeshellarg( $chemin ) . ' && echo present || echo absent' );

		if ( 'present' === trim( $essai['sortie'] ) ) {
			return array( true, 'fichier ' . $chemin . ' present' );
		}
	}

	return array( false, 'fichier cite par la room absent de la machine (' . implode( ', ', $candidats ) . ')' );
}

/**
 * Le nom du conteneur d'un service dans une pile compose.
 *
 * @param string $projet  Nom du projet compose.
 * @param string $service Service.
 * @return string
 */
function seca_preuve_conteneur_compose( $projet, $service ) {
	$liste = seca_preuve_exec(
		'docker ps -aq --filter ' . escapeshellarg( 'label=com.docker.compose.project=' . $projet )
		. ' --filter ' . escapeshellarg( 'label=com.docker.compose.service=' . $service )
	);

	$ids = preg_split( '/\s+/', trim( $liste['sortie'] ) );

	return isset( $ids[0] ) && '' !== $ids[0] ? $ids[0] : '';
}

/**
 * Les chemins de drapeau exiges par une room.
 *
 * @param int $room_id Room.
 * @return array<int,string>
 */
function seca_preuve_drapeaux( $room_id ) {
	$chemins = array();

	foreach ( Secura_Rooms::get_tasks( $room_id ) as $task ) {
		foreach ( (array) ( isset( $task['questions'] ) ? $task['questions'] : array() ) as $question ) {
			$mode = isset( $question['mode'] ) ? $question['mode'] : 'text';

			if ( 'flag' === $mode && ! empty( $question['flag_path'] ) ) {
				$chemins[] = (string) $question['flag_path'];
			}
		}
	}

	return array_values( array_unique( $chemins ) );
}

/**
 * Verifie les drapeaux d'une machine deja demarree.
 *
 * @param string $nom     Conteneur qui garde le drapeau.
 * @param array  $chemins Chemins exiges.
 * @return array{0:bool,1:array<int,string>} Reussite et details.
 */
function seca_preuve_verifier_drapeaux( $nom, $chemins ) {
	$ok      = true;
	$details = array();

	foreach ( $chemins as $chemin ) {
		$lecture_root = seca_preuve_dans( $nom, 'cat ' . escapeshellarg( $chemin ), true );
		$valeur       = seca_preuve_drapeau( $lecture_root['sortie'] );

		if ( '' === $valeur ) {
			$ok        = false;
			$details[] = 'drapeau absent en root : ' . $chemin;
			continue;
		}

		$lecture_eleve = seca_preuve_dans( $nom, 'cat ' . escapeshellarg( $chemin ) );

		if ( 0 === $lecture_eleve['code'] && '' !== seca_preuve_drapeau( $lecture_eleve['sortie'] ) ) {
			$ok        = false;
			$details[] = 'l apprenant lit directement ' . $chemin;
			continue;
		}

		$details[] = $chemin . ' = ' . $valeur . ' (root seulement)';
	}

	return array( $ok, $details );
}

if ( ! Secura_Lab::docker_available() ) {
	echo "Docker ne repond pas : la preuve des machines ne peut pas etre produite ici.\n";
	exit( 1 );
}

$prefixe = 'seca_preuve_' . getmypid() . '_';
$lignes  = array();
$rooms   = get_posts(
	array(
		'post_type'   => SECURA_POST_TYPE,
		'numberposts' => -1,
		'post_status' => 'any',
		'orderby'     => 'ID',
		'order'       => 'ASC',
	)
);

$total         = 0;
$ok            = 0;
$echecs        = array();
$sans_machine  = array();
$non_testables = array();

foreach ( $rooms as $room ) {
	$manifest = Secura_Lab::get_manifest( $room->ID );

	if ( empty( $manifest['enabled'] ) ) {
		$sans_machine[] = $room->post_name;
		continue;
	}

	$total++;

	$mode  = isset( $manifest['mode'] ) ? $manifest['mode'] : 'single';
	$cible = isset( $manifest['target'] ) ? (string) $manifest['target'] : '';

	/* La cible n'est pas toujours une URL nue : « noeud interne :
	   http://internal:8080 ». On en extrait l'adresse au lieu de la
	   rejeter. */
	$url = '';
	if ( preg_match( '#https?://[^\s]+#', $cible, $trouve_url ) ) {
		$url = $trouve_url[0];
	}

	$chemins = seca_preuve_drapeaux( $room->ID );

	/* ---------------- Pile compose ---------------- */
	if ( 'compose' === $mode ) {
		$compose = isset( $manifest['compose'] ) ? (string) $manifest['compose'] : '';

		if ( '' === $compose || ! file_exists( $compose ) ) {
			$echecs[] = $room->post_name . ' : fichier compose introuvable (' . $compose . ')';
			continue;
		}

		$projet  = $prefixe . 'p' . $room->ID;
		$service = isset( $manifest['service'] ) ? (string) $manifest['service'] : 'attacker';
		$garde   = isset( $manifest['flag_service'] ) && '' !== (string) $manifest['flag_service']
			? (string) $manifest['flag_service']
			: $service;

		$montee = seca_preuve_exec(
			'docker compose -f ' . escapeshellarg( $compose )
			. ' -p ' . escapeshellarg( $projet ) . ' up -d --no-build'
		);

		if ( 0 !== $montee['code'] ) {
			$echecs[] = $room->post_name . ' : la pile ne monte pas (' . trim( $montee['sortie'] ) . ')';
			seca_preuve_exec( 'docker compose -f ' . escapeshellarg( $compose ) . ' -p ' . escapeshellarg( $projet ) . ' down -v --remove-orphans' );
			continue;
		}

		$ok_room = true;
		$details = array();

		$conteneur = seca_preuve_conteneur_compose( $projet, $service );

		if ( '' === $conteneur || ! seca_preuve_attendre( $conteneur ) ) {
			$ok_room   = false;
			$details[] = 'le service ' . $service . ' ne tourne pas';
		}

		if ( $ok_room && ! empty( $chemins ) ) {
			/* Meme commande que le plugin : « compose exec -u 0 <service> cat
			   <chemin> ». C'est ce couple (service, chemin) qui doit tenir. */
			foreach ( $chemins as $chemin ) {
				$lecture = seca_preuve_exec(
					'docker compose -f ' . escapeshellarg( $compose ) . ' -p ' . escapeshellarg( $projet )
					. ' exec -T -u 0 ' . escapeshellarg( $garde ) . ' cat ' . escapeshellarg( $chemin )
				);

				$valeur = seca_preuve_drapeau( $lecture['sortie'] );

				if ( 0 !== $lecture['code'] || '' === $valeur ) {
					/* Deux issues tres differentes : soit le fichier n'existe
					   pas (la room ment), soit il existe mais sans drapeau
					   exploitable (le lab est casse). */
					$existe = seca_preuve_exec(
						'docker compose -f ' . escapeshellarg( $compose ) . ' -p ' . escapeshellarg( $projet )
						. ' exec -T -u 0 ' . escapeshellarg( $garde ) . ' test -f ' . escapeshellarg( $chemin )
					);

					$ok_room = false;
					$details[] = 0 === $existe['code']
						? 'drapeau sans valeur SECURA{...} dans ' . $chemin . ' (service ' . $garde . ')'
						: 'drapeau absent : ' . $chemin . ' n existe pas dans le service ' . $garde;
					continue;
				}

				$lecture_eleve = seca_preuve_exec(
					'docker compose -f ' . escapeshellarg( $compose ) . ' -p ' . escapeshellarg( $projet )
					. ' exec -T ' . escapeshellarg( $service ) . ' cat ' . escapeshellarg( $chemin )
				);

				if ( 0 === $lecture_eleve['code'] && '' !== seca_preuve_drapeau( $lecture_eleve['sortie'] ) ) {
					$ok_room   = false;
					$details[] = 'l apprenant lit directement ' . $chemin . ' depuis ' . $service;
					continue;
				}

				$details[] = $chemin . ' = ' . $valeur . ' (service ' . $garde . ', root seulement)';
			}
		}

		if ( '' !== $url ) {
			/* Depuis la machine de l'apprenant, comme le ferait l'eleve. */
			$code_http = $conteneur ? seca_preuve_joindre( $conteneur, $url ) : 0;

			if ( $code_http >= 200 && $code_http < 500 ) {
				$details[] = 'cible ' . $url . ' → HTTP ' . $code_http . ' depuis ' . $service;

				/* Et le service qui la sert tourne-t-il vraiment ? Sans
				   cela, un « noeud interne » absent passerait inapercu. */
				$hote    = seca_preuve_service_cible( $url );
				$servant = '' !== $hote ? seca_preuve_conteneur_compose( $projet, $hote ) : '';

				if ( '' !== $servant ) {
					$details[] = 'service ' . $hote . ' demarre';
				} else {
					$ok_room   = false;
					$details[] = 'aucun service ' . $hote . ' dans la pile';
				}
			} else {
				$ok_room   = false;
				$details[] = 'cible ' . $url . ' injoignable depuis ' . $service;
			}
		}

		seca_preuve_exec( 'docker compose -f ' . escapeshellarg( $compose ) . ' -p ' . escapeshellarg( $projet ) . ' down -v --remove-orphans' );

		if ( $ok_room ) {
			$ok++;
		} else {
			$echecs[] = $room->post_name . ' : ' . implode( ' ; ', $details );
		}

		$lignes[] = sprintf(
			'%-4s %-46s %-24s %s',
			$ok_room ? 'OK' : 'KO',
			$room->post_name,
			'pile ' . basename( dirname( $compose ) ),
			implode( ' ; ', $details )
		);

		continue;
	}

	/* ---------------- Machine unique ---------------- */
	$image = isset( $manifest['image'] ) ? (string) $manifest['image'] : '';

	if ( '' === $image ) {
		$echecs[] = $room->post_name . ' : aucune image declaree';
		continue;
	}

	if ( 0 !== seca_preuve_exec( 'docker image inspect ' . escapeshellarg( $image ) )['code'] ) {
		$echecs[] = $room->post_name . ' : image absente sur la machine (' . $image . ')';
		continue;
	}

	$nom     = $prefixe . 'r' . $room->ID;
	$reseau  = $prefixe . 'n' . $room->ID;
	$commande = 'docker run -d --name ' . escapeshellarg( $nom )
		. ' --network ' . escapeshellarg( $reseau )
		. ' --user ' . escapeshellarg( isset( $manifest['user'] ) ? (string) $manifest['user'] : '1000:1000' )
		. ' --cap-drop ALL --security-opt no-new-privileges'
		. ' --pids-limit ' . (int) ( isset( $manifest['pids'] ) ? $manifest['pids'] : 256 )
		. ' --memory ' . escapeshellarg( isset( $manifest['memory'] ) ? (string) $manifest['memory'] : '512m' )
		. ' --cpus ' . escapeshellarg( isset( $manifest['cpus'] ) ? (string) $manifest['cpus'] : '1' )
		. ' --tmpfs /tmp:rw,noexec,nosuid,size=32m'
		. ' -w ' . escapeshellarg( isset( $manifest['workdir'] ) ? (string) $manifest['workdir'] : '/home/ctf' )
		. ' ' . escapeshellarg( $image );

	/* La commande du manifeste est une chaine : Docker attend des mots. */
	foreach ( preg_split( '/\s+/', trim( (string) ( isset( $manifest['command'] ) ? $manifest['command'] : 'sleep infinity' ) ) ) as $mot ) {
		if ( '' !== $mot ) {
			$commande .= ' ' . escapeshellarg( $mot );
		}
	}

	seca_preuve_exec( 'docker network create --internal ' . escapeshellarg( $reseau ) );
	$demarrage = seca_preuve_exec( $commande );

	if ( 0 !== $demarrage['code'] || ! seca_preuve_attendre( $nom ) ) {
		$echecs[] = $room->post_name . ' : la machine ne demarre pas (' . trim( $demarrage['sortie'] ) . ')';
		seca_preuve_exec( 'docker rm -f ' . escapeshellarg( $nom ) );
		seca_preuve_exec( 'docker network rm ' . escapeshellarg( $reseau ) );
		continue;
	}

	$ok_room = true;
	$details = array();

	if ( ! empty( $chemins ) ) {
		list( $drapeaux_ok, $details ) = seca_preuve_verifier_drapeaux( $nom, $chemins );

		if ( ! $drapeaux_ok ) {
			$ok_room = false;
		}
	} else {
		$details[] = 'aucune question de drapeau (machine de cours)';
	}

	if ( '' !== $url ) {
		$port_cible = wp_parse_url( $url, PHP_URL_PORT );
		$port_cible = $port_cible ? (int) $port_cible : ( 'https' === wp_parse_url( $url, PHP_URL_SCHEME ) ? 443 : 80 );

		$ecoute = seca_preuve_port_ouvert( $nom, '127.0.0.1', $port_cible );

		if ( $ecoute ) {
			/* Le port repond : reste a savoir si l'application sert vraiment
			   quelque chose. Faute de client HTTP dans l'image, on le dit. */
			if ( seca_preuve_a_client_http( $nom ) ) {
				$code_http = seca_preuve_joindre( $nom, $url );

				if ( $code_http >= 200 && $code_http < 500 ) {
					$details[] = 'cible ' . $url . ' → HTTP ' . $code_http;
				} else {
					$ok_room   = false;
					$details[] = 'cible ' . $url . ' : le port ecoute mais ne repond pas (code ' . $code_http . ')';
				}
			} else {
				/* Une room qui annonce un site web dans une image sans curl ni
				   wget : l'apprenant ne pourrait pas le consulter non plus.
				   C'est un defaut de la machine, pas un doute du test. */
				$ok_room   = false;
				$details[] = 'cible ' . $url . ' : le port ' . $port_cible
					. ' ecoute mais l image n a ni curl ni wget (l apprenant ne peut pas consulter la cible)';
			}
		} else {
			$ok_room   = false;
			$details[] = 'cible ' . $url . ' injoignable : rien n ecoute sur le port ' . $port_cible;
		}
	} elseif ( '' !== $cible ) {
		list( $fichier_ok, $detail_fichier ) = seca_preuve_cible_fichier( $nom, $cible );

		if ( ! $fichier_ok ) {
			$ok_room = false;
		}

		$details[] = $detail_fichier;
	}

	seca_preuve_exec( 'docker rm -f ' . escapeshellarg( $nom ) );
	seca_preuve_exec( 'docker network rm ' . escapeshellarg( $reseau ) );

	if ( $ok_room ) {
		$ok++;
	} else {
		$echecs[] = $room->post_name . ' : ' . implode( ' ; ', $details );
	}

	$lignes[] = sprintf(
		'%-4s %-46s %-24s %s',
		$ok_room ? 'OK' : 'KO',
		$room->post_name,
		$image,
		implode( ' ; ', $details )
	);
}

echo "=== Preuve des machines, room par room ===\n\n";
echo implode( "\n", $lignes ), "\n\n";

foreach ( $non_testables as $note ) {
	echo 'NON TESTE ICI : ', $note, "\n";
}

echo "\n";
printf( "Rooms avec machine          : %d\n", $total );
printf( "Rooms prouvees par la machine : %d\n", $ok );
printf( "Rooms sans machine (cours)  : %d\n", count( $sans_machine ) );
printf( "Rooms non testables ici     : %d\n", count( $non_testables ) );
printf( "Echecs                      : %d\n", count( $echecs ) );

foreach ( $echecs as $echec ) {
	echo '  ECHEC ', $echec, "\n";
}

exit( empty( $echecs ) ? 0 : 1 );
