<?php
/**
 * La preuve des machines, room par room.
 *
 * Ce script ne remplace pas `scripts/test-labs-ci.sh` : il repond a une
 * autre question, celle du proprietaire — « les machines que mon
 * developpeur annonce pour chaque room existent-elles vraiment, et le
 * drapeau que la room exige est-il VRAIMENT dans l'image ? »
 *
 * Pour chaque room qui declare une machine (`_secura_lab`), il :
 *
 *   1. lit l'image declaree et verifie qu'elle est construite sur place ;
 *   2. demarre un conteneur avec les reglages du plugin (utilisateur non
 *      privilegie, pas de capacite, pas de sortie reseau) ;
 *   3. lit le drapeau attendu par la room, avec les droits de l'apprenant
 *      PUIS en root, et compare la valeur a celle que la machine contient
 *      reellement ;
 *   4. verifie que l'apprenant ne peut pas lire le fichier directement
 *      (sinon la room se resout sans rien comprendre) ;
 *   5. verifie que la cible annoncee (l'URL du service) repond depuis le
 *      conteneur, quand la room en declare une.
 *
 * Ce qui n'est pas mesurable ici est DIT, jamais suppose : une room dont
 * la machine est en mode « compose » est signalee comme testee par la pile
 * (voir test-labs-ci.sh), une cible injoignable est un constat, pas un
 * silence.
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
 * Attend qu'un conteneur soit pret (ou rend la main apres le delai).
 *
 * @param string $nom    Nom du conteneur.
 * @param int    $essais Nombre d'essais.
 * @return bool
 */
function seca_preuve_attendre( $nom, $essais = 10 ) {
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
	if ( preg_match( '/SECURA\{[^}]+\}/i', (string) $texte, $trouve ) ) {
		return strtolower( $trouve[0] );
	}

	return '';
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

$total   = 0;
$ok      = 0;
$echecs  = array();
$non_testables = array();
$sans_machine  = array();

foreach ( $rooms as $room ) {
	$manifest = Secura_Lab::get_manifest( $room->ID );

	if ( empty( $manifest['enabled'] ) ) {
		$sans_machine[] = $room->post_name;
		continue;
	}

	$total++;

	/* Les questions qui exigent un fichier de drapeau dans la machine. */
	$drapeaux = array();

	foreach ( Secura_Rooms::get_tasks( $room->ID ) as $index => $task ) {
		foreach ( (array) ( isset( $task['questions'] ) ? $task['questions'] : array() ) as $q_index => $question ) {
			$mode = isset( $question['mode'] ) ? $question['mode'] : 'text';

			if ( 'flag' === $mode && ! empty( $question['flag_path'] ) ) {
				$drapeaux[] = array(
					'tache'    => $index,
					'question' => $q_index,
					'chemin'   => $question['flag_path'],
				);
			}
		}
	}

	$mode = isset( $manifest['mode'] ) ? $manifest['mode'] : 'single';

	if ( 'compose' === $mode ) {
		/* La pile est testee par test-labs-ci.sh : on le dit, on ne le
		   pretend pas mesure ici. */
		$non_testables[] = $room->post_name . ' (pile compose : « '
			. ( isset( $manifest['compose'] ) ? $manifest['compose'] : '?' )
			. ' », testee par test-labs-ci.sh)';
		continue;
	}

	$image = isset( $manifest['image'] ) ? (string) $manifest['image'] : '';

	if ( '' === $image ) {
		$echecs[] = $room->post_name . ' : aucune image declaree';
		continue;
	}

	$inspection = seca_preuve_exec( 'docker image inspect ' . escapeshellarg( $image ) );

	if ( 0 !== $inspection['code'] ) {
		$echecs[] = $room->post_name . ' : image absente sur la machine (' . $image . ')';
		continue;
	}

	if ( empty( $drapeaux ) ) {
		$non_testables[] = $room->post_name . ' : aucune question de drapeau (rien a prouver par l image)';
		continue;
	}

	$nom = $prefixe . $room->ID;
	$reseau = Secura_Lab::network_name( 0, $room->ID, $manifest );
	$commande = 'docker run -d --name ' . escapeshellarg( $nom )
		. ' --network ' . escapeshellarg( $reseau )
		. ' --cap-drop ALL --security-opt no-new-privileges'
		. ' --pids-limit 256 --memory 512m --cpus 1.0'
		. ' --tmpfs /tmp:rw,noexec,nosuid,size=32m'
		. ' --user 1000:1000 -w /home/ctf '
		. escapeshellarg( $image ) . ' sleep infinity';

	seca_preuve_exec( 'docker network create --internal ' . escapeshellarg( $reseau ) );
	$demarrage = seca_preuve_exec( $commande );

	if ( 0 !== $demarrage['code'] || ! seca_preuve_attendre( $nom ) ) {
		$echecs[] = $room->post_name . ' : la machine ne demarre pas (' . trim( $demarrage['sortie'] ) . ')';
		seca_preuve_exec( 'docker rm -f ' . escapeshellarg( $nom ) );
		continue;
	}

	$room_ok = true;
	$detail  = array();

	foreach ( $drapeaux as $attendu ) {
		$lecture_apprenant = seca_preuve_exec(
			'docker exec ' . escapeshellarg( $nom ) . ' cat ' . escapeshellarg( $attendu['chemin'] )
		);

		/* Le fichier doit etre lisible par le serveur (root) : c'est ce que
		   fait le plugin pour corriger la reponse. */
		$lecture_root = seca_preuve_exec(
			'docker exec -u 0 ' . escapeshellarg( $nom ) . ' cat ' . escapeshellarg( $attendu['chemin'] )
		);

		$valeur = seca_preuve_drapeau( $lecture_root['sortie'] );

		if ( '' === $valeur ) {
			$room_ok = false;
			$detail[] = 'drapeau introuvable en root : ' . $attendu['chemin'];
			continue;
		}

		/* L'apprenant ne doit pas le lire directement : sinon la room se
		   resout sans rien apprendre. */
		if ( 0 === $lecture_apprenant['code'] && '' !== seca_preuve_drapeau( $lecture_apprenant['sortie'] ) ) {
			$room_ok = false;
			$detail[] = 'l apprenant lit directement ' . $attendu['chemin'];
			continue;
		}

		$detail[] = $attendu['chemin'] . ' = ' . $valeur;
	}

	/* La cible annoncee repond-elle depuis la machine ? */
	$cible = isset( $manifest['target'] ) ? (string) $manifest['target'] : '';

	if ( '' !== $cible && 0 === strpos( $cible, 'http' ) ) {
		$reponse = seca_preuve_exec(
			'docker exec ' . escapeshellarg( $nom )
			. ' sh -c ' . escapeshellarg( 'curl -sk -o /dev/null -w "%{http_code}" --max-time 8 ' . $cible )
		);

		$code_http = (int) trim( $reponse['sortie'] );

		if ( $code_http >= 200 && $code_http < 500 ) {
			$detail[] = 'cible ' . $cible . ' → HTTP ' . $code_http;
		} else {
			$room_ok = false;
			$detail[] = 'cible ' . $cible . ' injoignable (code ' . $code_http . ')';
		}
	}

	seca_preuve_exec( 'docker rm -f ' . escapeshellarg( $nom ) );
	seca_preuve_exec( 'docker network rm ' . escapeshellarg( $reseau ) );

	if ( $room_ok ) {
		$ok++;
	} else {
		$echecs[] = $room->post_name . ' : ' . implode( ' ; ', $detail );
	}

	$lignes[] = sprintf(
		'%-4s %-46s %-28s %s',
		$room_ok ? 'OK' : 'KO',
		$room->post_name,
		$image,
		implode( ' ; ', $detail )
	);
}

echo "=== Preuve des machines, room par room ===\n\n";
echo implode( "\n", $lignes ), "\n\n";

foreach ( $non_testables as $note ) {
	echo 'NON TESTE ICI : ', $note, "\n";
}

echo "\n";
printf( "Rooms avec machine : %d\n", $total );
printf( "Rooms dont le drapeau est prouve : %d\n", $ok );
printf( "Rooms sans machine (cours sans lab) : %d\n", count( $sans_machine ) );
printf( "Rooms non testables ici : %d\n", count( $non_testables ) );
printf( "Echecs : %d\n", count( $echecs ) );

foreach ( $echecs as $echec ) {
	echo '  ECHEC ', $echec, "\n";
}

exit( empty( $echecs ) ? 0 : 1 );
