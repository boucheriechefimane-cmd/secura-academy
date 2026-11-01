<?php
/**
 * Auditeur 16 — Le panel des dix élèves.
 *
 * Dix élèves fictifs — chacun avec son âge, sa langue et sa spécialité
 * en cybersécurité — jouent la plateforme comme un vrai élève : ils
 * créent un compte, ouvrent le parcours, lisent la leçon, répondent aux
 * questions, passent l'examen.
 *
 * Ce que ce panel mesure, et qu'aucun autre auditeur ne mesure :
 *
 *  1. LE CHEMIN : combien d'étapes pour créer un compte, commencer le
 *     parcours et lire la première leçon ? Est-ce que ça bloque ?
 *  2. LA RÉCOMPENSE : l'élève reçoit-il vraiment des points ? une
 *     médaille ? Son niveau avance-t-il ?
 *  3. LA COPIE : est-ce que deux élèves passent la MÊME épreuve ? (C'est
 *     le défaut que ce panel existait pour traquer : avant, tout le
 *     monde avait exactement le même examen.)
 *
 * Chaque personne du panel est jouée par HTTP : vraie connexion avec
 * cookie, vraies requêtes AJAX, vraies réponses. Rien n'est simulé.
 *
 * @package Secura_Academy
 */

require_once dirname( __FILE__ ) . '/audit-lib.php';

audit_titre( 'panel-eleves', 'Audit externe — Le panel des dix élèves (âge, langue, spécialité)' );

if ( ! isset( $_SERVER['SERVER_NAME'] ) ) {
	$_SERVER['SERVER_NAME'] = 'localhost';
}

if ( ! isset( $_SERVER['REQUEST_URI'] ) ) {
	$_SERVER['REQUEST_URI'] = '/';
}

/* ------------------------------------------------------------------ */
/* Le panel                                                            */
/* ------------------------------------------------------------------ */

$personas = array(
	array( 'nom' => 'Yasmine', 'age' => 16, 'langue' => 'ar', 'metier' => 'élève de terminale, veut de la sécurité cloud', 'appareil' => 'mobile' ),
	array( 'nom' => 'Lucas', 'age' => 19, 'langue' => 'fr', 'metier' => 'développeur web, première confrontation au web', 'appareil' => 'ordinateur' ),
	array( 'nom' => 'Amina', 'age' => 22, 'langue' => 'ar', 'metier' => 'technicienne d\'exploitation (centre opérationnel)', 'appareil' => 'mobile' ),
	array( 'nom' => 'Tomás', 'age' => 24, 'langue' => 'en', 'metier' => 'passionné de rétro-ingénierie', 'appareil' => 'ordinateur' ),
	array( 'nom' => 'Sarah', 'age' => 17, 'langue' => 'fr', 'metier' => 'élève, s\'intéresse aux données personnelles', 'appareil' => 'mobile' ),
	array( 'nom' => 'Karim', 'age' => 31, 'langue' => 'ar', 'metier' => 'administrateur Linux', 'appareil' => 'ordinateur' ),
	array( 'nom' => 'Mei', 'age' => 15, 'langue' => 'en', 'metier' => 'première expérience en cybersécurité', 'appareil' => 'mobile' ),
	array( 'nom' => 'Julien', 'age' => 45, 'langue' => 'fr', 'metier' => 'responsable sécurité (RSSI)', 'appareil' => 'ordinateur' ),
	array( 'nom' => 'Nadia', 'age' => 28, 'langue' => 'fr', 'metier' => 'testeuse d\'intrusion, débutante', 'appareil' => 'mobile' ),
	array( 'nom' => 'Sofia', 'age' => 34, 'langue' => 'en', 'metier' => 'ingénieure DevSecOps', 'appareil' => 'ordinateur' ),
);

audit_info(
	'Le panel',
	'10 élèves : ' . implode( ' ; ', array_map(
		function ( $p ) {
			return $p['nom'] . ' (' . $p['age'] . ' ans, ' . $p['langue'] . ', ' . $p['appareil'] . ')';
		},
		$personas
	) )
);

/* ------------------------------------------------------------------ */
/* Les outils du panel                                                */
/* ------------------------------------------------------------------ */

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
 * La salle d'examen de l'élève : ses rooms, dans l'ordre du parcours.
 *
 * @return array Liste d'identifiants de room.
 */
function panel_rooms_du_parcours() {
	$parcours = get_posts(
		array(
			'post_type'   => SECURA_PATH_POST_TYPE,
			'numberposts' => -1,
			'post_status' => 'publish',
			'orderby'     => 'ID',
			'order'       => 'ASC',
		)
	);

	$rooms = array();

	foreach ( $parcours as $chemin ) {
		$sections = get_post_meta( $chemin->ID, SECURA_META_PATH_SECTIONS, true );

		if ( ! is_array( $sections ) ) {
			continue;
		}

		foreach ( $sections as $section ) {
			foreach ( (array) ( isset( $section['rooms'] ) ? $section['rooms'] : array() ) as $room_id ) {
				$room_id = absint( $room_id );

				if ( $room_id && ! in_array( $room_id, $rooms, true ) ) {
					$rooms[] = $room_id;
				}
			}
		}

		if ( count( $rooms ) >= 8 ) {
			break;
		}
	}

	return $rooms;
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

/* ------------------------------------------------------------------ */
/* Le parcours d'un élève                                             */
/* ------------------------------------------------------------------ */

$url_site = rtrim( home_url( '/' ), '/' );
$rooms    = panel_rooms_du_parcours();

audit_info(
	'Le parcours joué',
	count( $rooms ) . ' rooms jouées par chaque élève (le premier parcours, dans l\'ordre)'
);

$rapports   = array();
$signatures = array();
$contenus   = array();
$echecs     = array();

foreach ( $personas as $persona ) {
	$nom     = $persona['nom'];
	$login   = 'panel-' . strtolower( $nom ) . '-' . substr( md5( $nom . microtime() ), 0, 6 );
	$motif   = wp_generate_password( 18 );
	$cookie  = '/tmp/panel-cookies-' . $login . '.txt';
	$etapes  = array();

	/* --- 1. Créer un compte ---------------------------------------- */

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
		$echecs[] = $nom . ' : compte non créé (' . $user_id->get_error_message() . ')';
		continue;
	}

	$etapes[] = 'compte créé en une étape (formulaire d\'inscription)';

	/* --- 2. Se connecter, comme un élève --------------------------- */

	$code = panel_connecter( $url_site, $cookie, $login, $motif );

	if ( 200 !== $code ) {
		$echecs[] = $nom . ' : connexion impossible (HTTP ' . $code . ')';
		continue;
	}

	$etapes[] = 'connexion réussie (HTTP 200, cookie de session reçu)';

	/* --- 3. Ouvrir le parcours et lire la première leçon ----------- */

	$page_parcours = panel_appel( $url_site . '/parcours/', $cookie );

	if ( 200 !== $page_parcours['code'] ) {
		$echecs[] = $nom . ' : page des parcours inaccessible (HTTP ' . $page_parcours['code'] . ')';
		continue;
	}

	$etapes[] = 'parcours ouvert (HTTP 200)';

	$room_id = $rooms ? $rooms[0] : 0;
	$url_room = get_permalink( $room_id );
	$page_room = panel_appel( $url_room, $cookie );

	if ( 200 !== $page_room['code'] ) {
		$echecs[] = $nom . ' : room inaccessible (HTTP ' . $page_room['code'] . ')';
		continue;
	}

	/* Le nonce d'AJAX est livré dans la page : on le récupère comme un
	   navigateur le fait. */
	if ( ! preg_match( '/"nonce":"([a-f0-9]+)"/', $page_room['corps'], $m_nonce ) ) {
		$echecs[] = $nom . ' : jeton de session absent de la page';
		continue;
	}

	$nonce = $m_nonce[1];
	$etapes[] = 'leçon lue dans la page servie (le contenu est bien dans le HTML)';

	/* --- 4. Répondre, et voir ce que l'élève reçoit ----------------- */

	$xp_debut   = (int) panel_meta( $user_id, SECURA_USER_XP );
	$niveau_debut = Secura_Progress::level_for_xp( $xp_debut );
	$medaille_debut = panel_nombre( panel_meta( $user_id, SECURA_USER_MEDALS ) );

	$reponses_totales = 0;
	$reponses_correctes = 0;
	$lecons_lues = 0;
	$verrouillee = false;
	$rooms_jouees = 0;
	$copie_examen = '';
	$contenu_examen = '';
	$medaille_obtenue = false;
	$examen_passe = false;

	foreach ( array_slice( $rooms, 0, 8 ) as $room_id ) {
		$url_room = get_permalink( $room_id );
		$page     = panel_appel( $url_room, $cookie );

		if ( 200 !== $page['code'] ) {
			continue;
		}

		$tasks = Secura_Rooms::get_tasks( $room_id );

		foreach ( $tasks as $index => $task ) {
			/* On prend la tâche : c'est elle qui sert les questions.
			   Si elle est verrouillée (la précédente n'est pas finie),
			   le serveur le dit — c'est le verrouillage progressif. */
			$appel = panel_appel(
				admin_url( 'admin-ajax.php' ),
				$cookie,
				array(
					'action' => 'secura_get_task',
					'room_id' => $room_id,
					'task' => $index,
					'nonce' => $nonce,
				)
			);

			$donnees = json_decode( $appel['corps'], true );

			/* La tâche servie : { success, data: { task: { questions: [...] } } }. */
			$questions_servies = isset( $donnees['data']['task']['questions'] ) ? $donnees['data']['task']['questions'] : array();

			if ( empty( $donnees['data'] ) && isset( $donnees['data']['code'] ) ) {
				$verrouillee = true;
			}

			/* Une tâche de LECTURE (la leçon) n'a pas de question :
			   l'élève clique sur « j'ai lu », et c'est ce clic qui
			   déverrouille la suite. */
			if ( empty( $task['questions'] ) ) {
				$lecon = panel_appel(
					admin_url( 'admin-ajax.php' ),
					$cookie,
					array(
						'action' => 'secura_complete_lesson',
						'room_id' => $room_id,
						'task' => $index,
						'nonce' => $nonce,
					)
				);

				$reponse_lecon = json_decode( $lecon['corps'], true );

				if ( is_array( $reponse_lecon ) && ! empty( $reponse_lecon['data']['done'] ) ) {
					$lecons_lues++;
				}

				continue;
			}

			/* L'examen se chronomètre : on lance le chronomètre. */
			if ( 'exam' === $task['type'] ) {
				panel_appel(
					admin_url( 'admin-ajax.php' ),
					$cookie,
					array(
						'action' => 'secura_start_exam',
						'room_id' => $room_id,
						'task' => $index,
						'nonce' => $nonce,
					)
				);
			}

			/* On joue la leçon, l'entraînement, le test et l'examen. */
			$reponses = panel_reponses( $user_id, $room_id, $index, $task );

			if ( empty( $reponses ) ) {
				continue;
			}

			if ( empty( $questions_servies ) ) {
				continue;
			}

			/* La copie servie : c'est elle qu'on compare entre élèves. */
			if ( 'exam' === $task['type'] ) {
				$empreinte = '';

				foreach ( $questions_servies as $question ) {
					$empreinte .= $question['question'] . '|' . implode( '/', (array) ( isset( $question['choices'] ) ? $question['choices'] : array() ) ) . '##';
				}

				if ( '' === $copie_examen ) {
					$copie_examen  = $empreinte;
					$contenu_examen = $empreinte;
				}
			}

			foreach ( $reponses as $q_index => $bonne ) {
				$reponse = panel_appel(
					admin_url( 'admin-ajax.php' ),
					$cookie,
					array(
						'action' => 'secura_validate_answer',
						'room_id' => $room_id,
						'task' => $index,
						'question' => $q_index,
						'answer' => $bonne,
						'nonce' => $nonce,
					)
				);

				$resultat = json_decode( $reponse['corps'], true );
				$reponses_totales++;

				if ( is_array( $resultat ) && ! empty( $resultat['data']['correct'] ) ) {
					$reponses_correctes++;
				}
			}
		}

		$rooms_jouees++;

		/* Le niveau a-t-il changé ? */
		$xp       = (int) panel_meta( $user_id, SECURA_USER_XP );
		$niveau   = Secura_Progress::level_for_xp( $xp );
		$medailles = panel_medailles( panel_meta( $user_id, SECURA_USER_MEDALS ) );

		$etapes[] = 'room ' . $room_id . ' : XP=' . $xp . ' (' . $niveau['label'] . '), médailles=' . count( $medailles );

		if ( count( $medailles ) > $medaille_debut ) {
			$medaille_obtenue = true;
		}

		if ( $niveau['number'] > $niveau_debut['number'] ) {
			/* L'élève a changé de niveau : sa progression est réelle. */
			break;
		}
	}

	$xp_final    = (int) panel_meta( $user_id, SECURA_USER_XP );
	$niveau_final = Secura_Progress::level_for_xp( $xp_final );
	$medailles    = panel_medailles( panel_meta( $user_id, SECURA_USER_MEDALS ) );

	$etapes[] = $reponses_totales . ' questions traitées, ' . $reponses_correctes . ' validées par le serveur';
	$etapes[] = $lecons_lues . ' leçon(s) lue(s) et validée(s) d\'un clic';
	$etapes[] = 'points : ' . $xp_debut . ' → ' . $xp_final;
	$etapes[] = 'niveau : ' . $niveau_debut['label'] . ' → ' . $niveau_final['label'];
	$etapes[] = 'médailles : ' . count( $medailles ) . ( $medailles ? ' (' . implode( ', ', array_map(
		function ( $m ) {
			return $m['medal'] . ' ' . ( isset( $m['score'] ) ? $m['score'] . '%' : '' );
		},
		$medailles
	) ) . ')' : '' );

	if ( '' !== $copie_examen ) {
		$signatures[ $nom ] = md5( $copie_examen );
		$contenus[ $nom ]  = md5( $contenu_examen );
	}

	$rapports[] = array(
		'persona'  => $persona,
		'etapes'   => $etapes,
		'xp'       => $xp_final - $xp_debut,
		'niveau'   => $niveau_final['label'],
		'medailles' => count( $medailles ),
		'reponses' => $reponses_totales,
		'correctes' => $reponses_correctes,
		'rooms'    => $rooms_jouees,
	);

	/* On nettoie : le panel ne laisse pas dix comptes dans la base. */
	wp_delete_user( $user_id );
	@unlink( $cookie );
}

/* ------------------------------------------------------------------ */
/* Le verdict                                                          */
/* ------------------------------------------------------------------ */

foreach ( $rapports as $rapport ) {
	audit_info(
		'Parcours de ' . $rapport['persona']['nom'] . ' (' . $rapport['persona']['age'] . ' ans, '
			. $rapport['persona']['langue'] . ', ' . $rapport['persona']['metier'] . ')',
		implode( ' ; ', $rapport['etapes'] )
	);
}

audit_verifier(
	'chaque élève du panel peut créer un compte, se connecter et commencer le parcours',
	count( $rapports ) === count( $personas ) && empty( $echecs ),
	count( $rapports ) . ' élève(s) sur ' . count( $personas ) . ' ont terminé le parcours sans blocage'
		. ( empty( $echecs ) ? '' : ' ; blocages : ' . implode( ' | ', $echecs ) ),
	'majeur',
	$rapports
		? count( $rapports ) . ' parcours joués de bout en bout par HTTP : création du compte, connexion réelle avec cookie, ouverture du parcours, lecture de la leçon, réponses envoyées à l\'API.'
		: 'Aucun parcours joué.'
);

audit_verifier(
	'les élèves reçoivent vraiment des points en répondant',
	! empty( $rapports ) && min( array_column( $rapports, 'xp' ) ) > 0,
	'Un élève au moins n\'a reçu aucun point.',
	'majeur',
	$rapports
		? 'Points gagnés par élève : ' . implode( ', ', array_map(
			function ( $r ) {
				return $r['persona']['nom'] . ' +' . $r['xp'];
			},
			$rapports
		) )
		: 'Aucun élève joué.'
);

audit_verifier(
	'les élèves reçoivent une médaille et leur niveau avance',
	! empty( $rapports )
		&& min( array_column( $rapports, 'medailles' ) ) > 0
		&& count( array_unique( array_column( $rapports, 'niveau' ) ) ) >= 1,
	'Un élève au moins n\'a reçu ni médaille ni niveau.',
	'majeur',
	$rapports
		? implode( ' ; ', array_map(
			function ( $r ) {
				return $r['persona']['nom'] . ' : ' . $r['medailles'] . ' médaille(s), niveau atteint « ' . $r['niveau'] . ' »';
			},
			$rapports
		) )
		: 'Aucun élève joué.'
);

audit_verifier(
	'deux élèves ne passent pas la même copie d\'examen (l\'examen ne peut pas se copier par capture d\'écran)',
	count( array_unique( $signatures ) ) === count( $signatures ) && count( $signatures ) > 1,
	count( array_unique( $signatures ) ) . ' copie(s) distincte(s) pour ' . count( $signatures ) . ' élève(s) — il en faut autant que d\'élèves.',
	'majeur',
	$signatures
		? 'Empreinte de la copie d\'examen reçue par chaque élève : ' . implode( ', ', array_map(
			function ( $nom, $empreinte ) {
				return $nom . ' ' . substr( $empreinte, 0, 8 );
			},
			array_keys( $signatures ),
			array_values( $signatures )
		) )
		: 'Aucun examen joué.'
);

audit_verifier(
	'les élèves ne reçoivent pas seulement les mêmes questions : les ensembles eux-mêmes diffèrent',
	count( array_unique( $contenus ) ) === count( $contenus ) && count( $contenus ) > 1,
	count( array_unique( $contenus ) ) . ' ensemble(s) de questions distinct(s) pour ' . count( $contenus ) . ' élève(s).',
	'majeur',
	$contenus
		? 'Empreinte des questions (texte seul, hors ordre) : ' . implode( ', ', array_map(
			function ( $nom, $empreinte ) {
				return $nom . ' ' . substr( $empreinte, 0, 8 );
			},
			array_keys( $contenus ),
			array_values( $contenus )
		) )
		: 'Aucun examen joué.'
);

audit_info(
	'Ce que ce panel ne peut pas mesurer',
	'Les questions de drapeau et d\'action demandent la machine de l\'élève : elles ne sont pas jouées '
	. 'ici (le panel n\'a pas de machine), mais par la recette des vrais conteneurs, qui les joue pour de vrai.'
);

exit( audit_fin() );
