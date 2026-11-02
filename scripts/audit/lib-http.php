<?php
/**
 * Bibliothèque HTTP des audits : parler au site comme un navigateur.
 *
 * Un audit qui simule un utilisateur doit passer par HTTP : inscription,
 * connexion avec cookie, puis requêtes comme le ferait la page. Ces
 * outils servent au panel des dix élèves et à la recette des drapeaux.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/audit-lib.php';

/**
 * Un appel HTTP avec un fichier de cookies (on parle au site comme un
 * navigateur : connexion, puis requêtes avec le cookie).
 *
 * @param string $url    Adresse.
 * @param array  $cookie Fichier de cookies.
 * @param array  $post   Données POST (vide = GET).
 * @return array { code, corps }.
 */
function panel_appel( $url, $cookie, $post = array() ) {
	/* Chaque valeur passe par escapeshellarg() : une réponse d'élève peut
	   contenir une apostrophe, un guillemet ou un dollar — un mot de passe
	   « p@ss$word » ne doit pas casser la commande. */
	$fichier = '/tmp/panel-corps-' . getmypid() . '-' . substr( md5( $url . wp_json_encode( $post ) . microtime() ), 0, 8 ) . '.txt';

	$commande = 'curl -s -L --max-time 30 -o ' . escapeshellarg( $fichier )
		. ' -w "%{http_code}" -b ' . escapeshellarg( $cookie ) . ' -c ' . escapeshellarg( $cookie ) . ' ';

	if ( ! empty( $post ) ) {
		$commande .= '-X POST ';

		foreach ( $post as $cle => $valeur ) {
			$commande .= '--data-urlencode ' . escapeshellarg( $cle . '=' . (string) $valeur ) . ' ';
		}
	}

	$commande .= escapeshellarg( $url );

	$code  = trim( (string) audit_exec( $commande ) );
	$corps = file_exists( $fichier ) ? file_get_contents( $fichier ) : '';

	@unlink( $fichier );

	return array(
		'code'  => (int) $code,
		'corps' => is_string( $corps ) ? $corps : '',
	);
}

/**
 * Connexion réelle : le mot de passe est vérifié par WordPress, et le
 * cookie de session est réutilisé ensuite.
 *
 * @param string $url_site Adresse du site.
 * @param string $cookie  Fichier de cookies.
 * @param string $login   Identifiant.
 * @param string $motif   Mot de passe.
 * @return int Code HTTP de la page après connexion.
 */
function panel_connecter( $url_site, $cookie, $login, $motif ) {
	$reponse = panel_appel(
		$url_site . '/wp-login.php',
		$cookie,
		array(
			'log'         => $login,
			'pwd'         => $motif,
			'wp-submit'   => 'Log In',
			'redirect_to' => $url_site . '/',
			'testcookie'  => '1',
		)
	);

	return $reponse['code'];
}

/**
 * Les bonnes réponses d'une tâche, telles que l'élève les voit (donc
 * dans SA copie : propositions mélangées, chiffres variés).
 *
 * @param int   $user_id Élève.
 * @param int   $room_id Room.
 * @param int   $index   Index de la tâche.
 * @param array $task    Tâche.
 * @return array Liste de réponses justes (index => réponse).
 */
function panel_reponses( $user_id, $room_id, $index, array $task ) {
	$questions = $task['questions'];

	if ( in_array( $task['type'], array( 'exam', 'test' ), true ) ) {
		$questions = Secura_Exam::paper( $user_id, $room_id, $index, $task );
	}

	$reponses = array();

	foreach ( $questions as $q_index => $question ) {
		$mode = isset( $question['mode'] ) ? $question['mode'] : 'text';

		if ( 'choice' === $mode ) {
			$correct = isset( $question['correct'] ) ? (int) $question['correct'] : -1;

			if ( $correct >= 0 && isset( $question['choices'][ $correct ] ) ) {
				$reponses[ $q_index ] = (string) $question['choices'][ $correct ];
			}

			continue;
		}

		if ( 'text' === $mode && ! empty( $question['answers'] ) ) {
			$reponses[ $q_index ] = (string) $question['answers'][0];
		}

		/* Un probleme d'examen universitaire (type « solution ») : le
		   panel ne redacte pas une these, il montre qu'il tente sa
		   reponse — le serveur affiche ensuite la correction
		   officielle de l'ecole. */
		if ( 'solution' === $mode ) {
			$reponses[ $q_index ] = 'Reponse redigee par le panel ; la correction officielle est ensuite affichee.';
		}

		/* Les questions de drapeau ou d'action demandent la machine :
		   le panel les laisse au test d'intrusion, qui a, lui, une vraie
		   machine à piloter. */
	}

	return $reponses;
}

/**
 * Lit un meta de l'eleve en relisant la base (le cache du process
 * d'audit peut etre anterieur aux ecritures faites par le serveur web,
 * qui tourne dans un autre process).
 *
 * @param int    $user_id Eleve.
 * @param string $key     Cle du meta.
 * @return mixed
 */
function panel_meta( $user_id, $key ) {
	wp_cache_delete( $user_id, 'user_meta' );

	return get_user_meta( $user_id, $key, true );
}

/**
 * Les medailles d'un eleve (le meta peut etre vide : on ne compte pas
 * une chaine vide comme une medaille).
 *
 * @param mixed $meta Valeur brute du meta.
 * @return array
 */
function panel_medailles( $meta ) {
	if ( ! is_array( $meta ) ) {
		return array();
	}

	/* Chaque médaille est un tableau { medal, score, earned_at }. */
	return array_filter(
		$meta,
		function ( $entree ) {
			return is_array( $entree ) && ! empty( $entree['medal'] );
		}
	);
}

/**
 * Nombre d elements d'un meta.
 *
 * @param mixed $meta Valeur brute.
 * @return int
 */
function panel_nombre( $meta ) {
	return count( panel_medailles( $meta ) );
}
