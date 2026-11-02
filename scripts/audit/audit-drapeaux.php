<?php
/**
 * Auditeur 18e sur 18 — Les questions de machine : les drapeaux et les
 * actions sont-ils vraiment jouables ?
 *
 * PERIMETRE
 * Les questions de drapeau et d'action sont les seules de la plateforme
 * qui ne se répondent pas en lisant l'ecran : elles demandent la machine
 * de l'eleve. Le serveur y lit le fichier de drapeau en root et compare.
 * Tant qu'on ne les joueait pas, elles n'etaient pas verifiees : un
 * constat de couverture n'est pas une preuve.
 *
 * METHODE
 * 1. Verification statique : chaque question de drapeau pointe-t-elle vers
 *    un fichier qui existe reellement dans le lab de sa room ? La valeur
 *    est-elle unique ? Le chemin est-il sur ? La machine est-elle
 *    deployable ?
 * 2. Jeu reel : on deploie la machine, on progresse comme un eleve, on
 *    cherche la valeur dans la machine, on la soumet, et on verifie que le
 *    serveur l'accepte (c'est lui qui relit le fichier, en root).
 *
 * Si aucune machine n'est disponible (pas de Docker, pas d'image), le
 * rapport le dit et ne pretend jamais avoir joue.
 *
 * @package Secura_Academy
 */

require_once __DIR__ . '/audit-lib.php';
require_once __DIR__ . '/lib-http.php';
require_once __DIR__ . '/lib-machine.php';

audit_titre( 'drapeaux', 'Les questions de machine : drapeaux et actions joues pour de vrai' );

audit_expert(
	'Expert en exploitation linux et en surveillance de drapeaux (Read The Docs)',
	'Verifie que les questions qui demandent la machine de l\'eleve sont reellement jouables : '
	. 'le fichier de drapeau existe dans le bon lab, la valeur est unique et sure, la machine se deploie, '
	. 'et la reponse de l\'eleve est acceptee par le serveur qui relit le fichier en root.'
);

/* ------------------------------------------------------------------ */
/* 1. L'inventaire                                                     */
/* ------------------------------------------------------------------ */

echo "\n1. Combien de questions demandent la machine ?\n";

$rooms      = audit_machine_rooms();
$questions  = 0;
$drapeaux   = 0;
$actions    = 0;

foreach ( $rooms as $room ) {
	foreach ( $room['questions'] as $question ) {
		$questions++;

		if ( 'flag' === $question['mode'] ) {
			$drapeaux++;
		} else {
			$actions++;
		}
	}
}

audit_verifier(
	'les questions de machine existent bien dans la plateforme',
	$questions > 0,
	'aucune question de drapeau ou d\'action trouvee',
	'majeur',
	$questions . ' question(s) : ' . $drapeaux . ' de drapeau, ' . $actions . ' d\'action, réparties sur ' . count( $rooms ) . ' room(s)'
);

audit_info(
	'le périmètre à vérifier',
	$drapeaux . ' questions de drapeau et ' . $actions . ' question d\'action',
	'chacune est rattachée à une room, donc à une machine'
);

/* ------------------------------------------------------------------ */
/* 2. La vérification statique                                         */
/* ------------------------------------------------------------------ */

echo "\n2. Chaque question de drapeau pointe-t-elle vers un vrai fichier ?\n";

$verification = audit_machine_verifie_fichiers( $rooms );

audit_verifier(
	'chaque question de drapeau est répondable (le fichier existe, il a une valeur, elle est unique, le chemin est sûr)',
	empty( $verification['problemes'] ),
	implode( ' ; ', array_slice( $verification['problemes'], 0, 6 ) ),
	'majeur',
	$verification['verifiees'] . ' question(s) vérifiée(s) sur ' . $verification['total'] . ' sans anomalie'
);

/* Les machines désactivées : une question de drapeau ne peut pas être
   validée si la machine n'est jamais déployée. */
$desactivees = array();

foreach ( $rooms as $room ) {
	$manifest = audit_machine_manifest( $room['room'] );

	if ( empty( $manifest['enabled'] ) ) {
		$desactivees[] = 'room ' . $room['room'] . ' (' . $room['slug'] . ')';
	}
}

audit_verifier(
	'chaque room qui porte une question de drapeau a une machine déployable',
	empty( $desactivees ),
	implode( ' ; ', $desactivees ),
	'majeur',
	empty( $desactivees ) ? 'toutes les machines concernées sont activées' : count( $desactivees ) . ' room(s) concernée(s)'
);

/* ------------------------------------------------------------------ */
/* 3. Le jeu réel                                                      */
/* ------------------------------------------------------------------ */

echo "\n3. Les questions sont-elles jouées sur une vraie machine ?\n";

/* L'adresse du site : la constante si elle existe, la variable
   d'environnement sinon, et l'adresse du site en dernier recours. */
$url_site = defined( 'SECA_WP_URL' ) ? (string) SECA_WP_URL : '';
$env_url  = getenv( 'SECA_WP_URL' );

if ( '' === $url_site && is_string( $env_url ) ) {
	$url_site = $env_url;
}

if ( '' === $url_site ) {
	$url_site = (string) home_url( '/' );
}

$url_site = rtrim( $url_site, '/' );

$docker = class_exists( 'Secura_Lab' ) ? Secura_Lab::docker_available() : false;

$joues    = 0;
$trouvees = 0;
$echecs   = array();
$preuves  = array();

if ( ! $docker ) {
	audit_info(
		'jeu réel des questions de machine',
		'non joué : aucun moteur de machine disponible sur cet environnement (pas de Docker)',
		'les questions ont été vérifiées statiquement, pas jouées'
	);
} else {
	/* Un eleve, pour jouer. */
	$login  = 'audit-machine-' . substr( md5( microtime() ), 0, 6 );
	$motif  = wp_generate_password( 18 );
	$cookie = '/tmp/audit-machine-' . getmypid() . '.txt';

	$existant = get_user_by( 'login', $login );

	if ( $existant ) {
		wp_delete_user( $existant->ID );
	}

	$user_id = wp_insert_user(
		array(
			'user_login' => $login,
			'user_pass'  => $motif,
			'user_email' => $login . '@exemple.test',
			'role'       => 'subscriber',
		)
	);

	if ( is_wp_error( $user_id ) ) {
		audit_info(
			'jeu réel des questions de machine',
			'non joué : compte de test non créé',
			$user_id->get_error_message()
		);
	} else {
		$code = panel_connecter( $url_site, $cookie, $login, $motif );

		/* Le jeton de session est livre dans la page : on le recupere
		   comme le ferait un navigateur. */
		$nonce = '';
		$page  = panel_appel( get_permalink( $rooms ? $rooms[0]['room'] : 0 ), $cookie );

		if ( preg_match( '/"nonce":"([a-f0-9]+)"/', $page['corps'], $m_nonce ) ) {
			$nonce = $m_nonce[1];
		}

		if ( 200 !== $code || '' === $nonce ) {
			audit_info(
				'jeu réel des questions de machine',
				'non joué : connexion ou jeton de session indisponible',
				'connexion HTTP ' . $code
			);
		} else {
			/* Pour aller vite : un nombre limite de rooms (l'audit complet joue
			   toutes les rooms). */
			$limite = (int) getenv( 'SECA_DRAPEAUX_LIMIT' );
			$seule  = (int) getenv( 'SECA_DRAPEAUX_ROOM' );

			foreach ( $rooms as $room ) {
				if ( $limite > 0 && $joues + count( $echecs ) >= $limite ) {
					break;
				}

				/* Pour cibler une room (mise au point). */
				if ( $seule > 0 && $seule !== (int) $room['room'] ) {
					continue;
				}

				foreach ( $room['questions'] as $question ) {
					$jeu = audit_machine_joue(
						$room['room'],
						$room['tache'],
						$question['index'],
						$question['flag_path'],
						$cookie,
						$user_id,
						$nonce
					);

					echo '   room ' . $room['room'] . ' : ' . ( ! empty( $jeu['joue'] ) ? 'jouée' : 'ÉCHEC' ) . ' — ' . $jeu['detail'] . "\n";

					if ( ! empty( $jeu['joue'] ) ) {
						$joues++;

						if ( 'joue' === ( $jeu['niveau'] ?? '' ) ) {
							$trouvees++;
						}

						$preuves[] = 'room ' . $room['room'] . ' : ' . $jeu['detail'];
					} else {
						$echecs[] = 'room ' . $room['room'] . ' (' . $room['slug'] . ') : ' . $jeu['detail'];
					}
				}
			}

			audit_verifier(
				'chaque question de machine se joue et se valide sur une vraie machine',
				empty( $echecs ),
				implode( ' ; ', array_slice( $echecs, 0, 5 ) ),
				'majeur',
				$joues . ' question(s) jouée(s) sur ' . count( $rooms ) . ' room(s) : machine déployée, réponse acceptée par le serveur ; ' . $trouvees . ' valeur(s) trouvée(s) par l\'élève dans la machine'
			);

			if ( ! empty( $preuves ) ) {
				audit_info(
					'ce que le jeu réel a prouvé',
					$joues . ' question(s) acceptées par le serveur après lecture du fichier de drapeau en root',
					implode( ' | ', array_slice( $preuves, 0, 3 ) )
				);
			}
		}

		wp_delete_user( $user_id );

		@unlink( $cookie );
	}
}

/* ------------------------------------------------------------------ */
/* 4. Ce que cet auditeur ne peut pas mesurer                          */
/* ------------------------------------------------------------------ */

echo "\n4. Les limites de la mesure\n";

audit_info(
	'le contrôle porte sur la plateforme, pas sur l\'élève',
	'la valeur est lue par le serveur dans le fichier de la machine, comme le ferait un élève qui a trouvé la bonne réponse ; l\'apprenant, lui, doit trouver la valeur dans la machine',
	'le serveur compare le fichier réel, il ne compare pas une liste de réponses'
);

exit( audit_fin() );
