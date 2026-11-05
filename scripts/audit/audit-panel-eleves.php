<?php
/**
 * Auditeur 16e sur 18 — Le panel des vingt élèves.
 *
 * Vingt élèves fictifs — chacun avec son âge, sa langue et sa spécialité
 * en cybersécurité — jouent la plateforme comme un vrai élève : ils
 * s'INSCRIVENT par le formulaire web, ouvrent le parcours, lisent la
 * leçon, répondent aux questions, passent l'examen.
 *
 * Ce que ce panel ne fait pas, et le dit : il n'y a pas vingt parcours
 * differents. Chaque eleve joue les rooms du premier parcours, dans
 * l'ordre, et s'arrete a la premiere room ou l'examen se termine. Les
 * langues et les appareils des personas servent a decrire le public
 * vise, pas a prouver que la plateforme les sert : la version arabe et
 * le rendu mobile sont mesures par l'auditeur « accessibilite » et
 * l'auditeur « ux ».
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
require_once dirname( __FILE__ ) . '/lib-http.php';
require_once dirname( __FILE__ ) . '/lib-machine.php';

audit_titre( 'panel-eleves', 'Audit externe — Le panel des vingt élèves (âge, langue, spécialité)' );

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

	/* --- Les dix profils ajoutés le 02/11/2026 : le panel passe à
	   vingt élèves. Lepropriétaire a demandé d'élargir : plus d'âges,
	   plus de situations de départ, plus de rapport au travail. --- */
	array( 'nom' => 'Adam', 'age' => 14, 'langue' => 'fr', 'metier' => 'collège, première fois devant un terminal', 'appareil' => 'mobile' ),
	array( 'nom' => 'Hanane', 'age' => 26, 'langue' => 'ar', 'metier' => 'comptable, se met à la cybersécurité pour protéger son entreprise', 'appareil' => 'ordinateur' ),
	array( 'nom' => 'Diego', 'age' => 21, 'langue' => 'fr', 'metier' => 'étudiant en BTS, découvre le réseau', 'appareil' => 'mobile' ),
	array( 'nom' => 'Rashid', 'age' => 38, 'langue' => 'ar', 'metier' => 'technicien de maintenance, reconversion', 'appareil' => 'ordinateur' ),
	array( 'nom' => 'Chloé', 'age' => 29, 'langue' => 'fr', 'metier' => 'cheffe de projet, veut comprendre les failles qu\'on lui raconte', 'appareil' => 'ordinateur' ),
	array( 'nom' => 'Omar', 'age' => 16, 'langue' => 'ar', 'metier' => 'lycéen, apprenant sur son téléphone', 'appareil' => 'mobile' ),
	array( 'nom' => 'Priya', 'age' => 23, 'langue' => 'en', 'metier' => 'développeuse junior, première mission en production', 'appareil' => 'ordinateur' ),
	array( 'nom' => 'Youssef', 'age' => 52, 'langue' => 'fr', 'metier' => 'formateur en centre de formation, cherche un support de cours', 'appareil' => 'ordinateur' ),
	array( 'nom' => 'Nora', 'age' => 19, 'langue' => 'ar', 'metier' => 'étudiante en droit, s\'intéresse à la vie privée', 'appareil' => 'mobile' ),
	array( 'nom' => 'Elena', 'age' => 44, 'langue' => 'en', 'metier' => 'directrice des risques, prépare une certification', 'appareil' => 'ordinateur' ),
);

audit_info(
	'Le panel',
	'20 élèves : ' . implode( ' ; ', array_map(
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
 * Les rooms d'un parcours, dans l'ordre des sections.
 *
 * @param int $parcours_id Parcours.
 * @return array Liste d'identifiants de room.
 */
function panel_rooms_du_parcours( $parcours_id ) {
	$rooms    = array();
	$sections = get_post_meta( absint( $parcours_id ), SECURA_META_PATH_SECTIONS, true );

	foreach ( (array) $sections as $section ) {
		foreach ( (array) ( isset( $section['rooms'] ) ? $section['rooms'] : array() ) as $room_id ) {
			$room_id = absint( $room_id );

			if ( $room_id && ! in_array( $room_id, $rooms, true ) ) {
				$rooms[] = $room_id;
			}
		}
	}

	return $rooms;
}

/**
 * Les parcours publies, pour dire lequel chaque eleve joue.
 *
 * @return array
 */
function panel_parcours_publies() {
	return get_posts(
		array(
			'post_type'   => SECURA_PATH_POST_TYPE,
			'numberposts' => -1,
			'post_status' => 'publish',
			'orderby'     => 'ID',
			'order'       => 'ASC',
		)
	);
}

/* ------------------------------------------------------------------ */
/* Le parcours d'un élève                                             */
/* ------------------------------------------------------------------ */

$url_site = rtrim( home_url( '/' ), '/' );
$parcours = panel_parcours_publies();

$rapports   = array();
$signatures = array();
$contenus   = array();
$echecs     = array();

/**
 * Un parcours est-il jouable ? Il lui faut au moins un examen : sans
 * examen, il n'y a ni chronometre, ni medaille, ni copie a comparer, et
 * le panel ne prouverait rien de ce qu'il annonce.
 *
 * @param int $parcours_id Parcours.
 * @return bool
 */
function panel_parcours_avec_examen( $parcours_id ) {
	$sections = get_post_meta( $parcours_id, SECURA_META_PATH_SECTIONS, true );

	foreach ( (array) $sections as $section ) {
		foreach ( (array) ( isset( $section['rooms'] ) ? $section['rooms'] : array() ) as $room_id ) {
			foreach ( Secura_Rooms::get_tasks( absint( $room_id ) ) as $task ) {
				if ( 'exam' === ( isset( $task['type'] ) ? $task['type'] : '' ) ) {
					return true;
				}
			}
		}
	}

	return false;
}

$parcours_jouables = array_values( array_filter( panel_parcours_publies(), function ( $chemin ) {
	return panel_parcours_avec_examen( $chemin->ID );
} ) );

if ( empty( $parcours_jouables ) ) {
	audit_verifier(
		'au moins un parcours publié contient un examen',
		false,
		count( panel_parcours_publies() ) . ' parcours publiés, aucun ne contient d examen : '
			. 'le panel ne peut pas mesurer la copie d examen',
		'majeur',
		count( panel_parcours_publies() ) . ' parcours inspectés'
	);

	exit( audit_fin() );
}

audit_info(
	'Le parcours joué',
	count( $parcours ) . ' parcours publiés, dont ' . count( $parcours_jouables ) . ' avec un examen. '
		. 'Chaque élève joue un de ces parcours (réparti sur le panel), une seule fois, et s\'arrête à son examen.'
);
audit_info(
	'Les parcours écartés',
	count( $parcours ) - count( $parcours_jouables ) . ' parcours publié(s) sans examen : ils sont jouables '
		. 'comme cours, mais ne permettent pas de mesurer la copie d\'examen ni la médaille.'
);

/**
 * Cette tache est-elle repondable SANS la machine de l'eleve ?
 *
 * @param array $tache Tache.
 * @return bool
 */
function panel_tache_jouable( $tache ) {
	if ( ! empty( $tache['terminal']['steps'] ) ) {
		return false;
	}

	foreach ( (array) ( isset( $tache['questions'] ) ? $tache['questions'] : array() ) as $question ) {
		$mode = isset( $question['mode'] ) ? $question['mode'] : 'text';

		if ( in_array( $mode, array( 'flag', 'action' ), true ) ) {
			return false;
		}

		if ( isset( $question['requires_step'] ) && (int) $question['requires_step'] >= 0 ) {
			return false;
		}
	}

	return true;
}

/**
 * Marque une tache comme faite pour un eleve de controle (meme logique
 * que l'auditeur des epreuves : on deverrouille la suite).
 *
 * @param int   $user_id Eleve.
 * @param int   $room_id Room.
 * @param array $tache   Tache.
 * @param int   $index   Index.
 */
function panel_deverrouiller( $user_id, $room_id, array $tache, $index ) {
	$state = Secura_Progress::get_room_state( $user_id, $room_id );
	$key   = (string) (int) $index;

	if ( ! isset( $state['tasks'][ $key ] ) || ! is_array( $state['tasks'][ $key ] ) ) {
		$state['tasks'][ $key ] = array( 'solved' => array(), 'hints' => array(), 'done' => false );
	}

	if ( empty( $tache['questions'] ) ) {
		$state['tasks'][ $key ]['done'] = true;
	} else {
		foreach ( array_keys( (array) $tache['questions'] ) as $question ) {
			$state['tasks'][ $key ]['solved'][ (string) $question ] = true;
		}
	}

	Secura_Progress::save_room_state( $user_id, $room_id, $state );
}

$inscriptions_web = 0;
$taches_de_machine = 0;
$inscriptions_impossibles = array();

foreach ( $personas as $numero => $persona ) {
	$nom    = $persona['nom'];
	/* Le login passe par sanitize_user() avec WordPress : les accents
	   sont retires (« Tomás » devient « tomas »). L'ancien panel gardait
	   « panel-tomás-xxxx » et cherchait ce login apres le POST : il ne le
	   retrouvait jamais, et concluait que l'inscription avait echoue. Le
	   defaut etait dans l'auditeur, pas dans le site. */
	$login  = sanitize_user( 'panel-' . strtolower( remove_accents( $nom ) ) . '-' . substr( md5( $nom . microtime() ), 0, 6 ), true );
	$motif  = 'Pn!' . wp_generate_password( 18, false, false );
	$cookie = '/tmp/panel-cookies-' . $login . '.txt';
	$etapes = array();

	@unlink( $cookie );

	/* --- 1. Créer un compte par le FORMULAIRE WEB ------------------- */

	/* Pas de wp_insert_user : un compte cree par le code ne prouve pas
	   que l'inscription fonctionne. On poste le formulaire comme un
	   visiteur (wp-login.php?action=register), puis on verifie que le
	   compte existe vraiment. */
	$inscription = panel_appel(
		$url_site . '/wp-login.php?action=register',
		$cookie,
		array(
			'user_login'  => $login,
			'user_email'  => $login . '@exemple.test',
			'wp-submit'   => 'Register',
			'redirect_to' => $url_site . '/',
			'testcookie'  => '1',
		)
	);

	$compte  = get_user_by( 'login', $login );

	if ( ! $compte ) {
		/* Repli : l'adresse de courriel n'est pas modifiee par WordPress,
		   elle identifie le compte de facon sure. */
		$compte = get_user_by( 'email', $login . '@exemple.test' );
	}

	$user_id = $compte ? (int) $compte->ID : 0;
	$raison  = 'compte absent apres le POST';

	if ( ! $user_id ) {
		/* Pourquoi le formulaire a-t-il refuse ? WordPress ecrit le
		   message dans la page : on le cite, au lieu de dire seulement
		   « compte absent » — c'est cette raison qui dit si le defaut
		   vient du site ou de la recette (adresse deja prise). */
		if ( preg_match( '/<p[^>]*class="[^"]*message[^"]*"[^>]*>(.*?)<\/p>/is', $inscription['corps'], $m_erreur ) ) {
			$raison = trim( wp_strip_all_tags( html_entity_decode( $m_erreur[1], ENT_QUOTES, 'UTF-8' ) ) );
		}

		/* Une adresse deja prise (deux inscriptions rapprochees) se
		   retente avec une adresse unique : c'est le formulaire qui est
		   juge, pas notre manque d'entropie. */
		$login = $login . '-' . substr( md5( (string) microtime( true ) ), 0, 4 );

		$inscription = panel_appel(
			$url_site . '/wp-login.php?action=register',
			$cookie,
			array(
				'user_login'  => $login,
				'user_email'  => $login . '@exemple.test',
				'wp-submit'   => 'Register',
				'redirect_to' => $url_site . '/',
				'testcookie'  => '1',
			)
		);

		$compte  = get_user_by( 'login', $login );
		$user_id = $compte ? (int) $compte->ID : 0;
	}

	if ( ! $user_id ) {
		$inscriptions_impossibles[] = $nom . ' (HTTP ' . $inscription['code'] . ' : ' . $raison . ')';
		$echecs[] = $nom . ' : inscription web refusée (' . $raison . ')';
		continue;
	}

	/* WordPress n'envoie pas de mot de passe : le formulaire public
	   envoie un lien par courriel, et cette recette n'a pas de boite
	   aux lettres. On fixe donc le mot de passe par l'API, PUIS on se
	   connecte par HTTP : la connexion, elle, est bien reelle. */
	$inscriptions_web++;
	wp_set_password( $motif, $user_id );
	$etapes[] = 'compte créé par le formulaire d\'inscription web (' . $login . ')';

	/* --- 2. Se connecter, comme un élève --------------------------- */

	$code = panel_connecter( $url_site, $cookie, $login, $motif );

	if ( 200 !== $code ) {
		$echecs[] = $nom . ' : connexion impossible (HTTP ' . $code . ')';
		continue;
	}

	$etapes[] = 'connexion réussie (HTTP 200, cookie de session reçu)';

	/* --- 3. Ouvrir le parcours et lire la première leçon ----------- */

	$chemin_joue   = $parcours_jouables[ $numero % count( $parcours_jouables ) ];
	$url_parcours  = get_permalink( $chemin_joue->ID );
	$page_parcours = panel_appel( $url_parcours, $cookie );

	if ( 200 !== $page_parcours['code'] ) {
		$echecs[] = $nom . ' : page des parcours inaccessible (HTTP ' . $page_parcours['code'] . ')';
		continue;
	}

	$etapes[] = 'parcours « ' . $chemin_joue->post_title . ' » ouvert (HTTP 200)';

	$rooms   = panel_rooms_du_parcours( $chemin_joue->ID );
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
			/* Un examen s'OUVRE avant d'etre lu : le serveur ne livre pas ses
			   questions tant que le chronometre n'est pas parti (409
			   « exam_not_started »). On suit exactement ce que fait le
			   navigateur. */
			if ( 'exam' === ( isset( $task['type'] ) ? $task['type'] : '' ) ) {
				$ouverture = panel_appel(
					admin_url( 'admin-ajax.php' ),
					$cookie,
					array(
						'action'  => 'secura_start_exam',
						'room_id' => $room_id,
						'task'    => $index,
						'nonce'   => $nonce,
					)
				);

				$reponse_ouverture = json_decode( $ouverture['corps'], true );

				if ( empty( $reponse_ouverture['success'] ) ) {
					$etapes[] = 'room ' . $room_id . ' : examen non ouvert ('
						. ( isset( $reponse_ouverture['data']['code'] ) ? $reponse_ouverture['data']['code'] : 'sans code' ) . ')';

					continue;
				}
			}

			/* Une tache qui exige la machine de l'eleve (drapeau, action,
			   etape de terminal) ne peut pas etre jouee ici : l'auditeur
			   « drapeaux » la joue, lui, avec une vraie machine. On la
			   marque comme faite pour ne pas interrompre le parcours, et on
			   le dit dans le bilan — sans compter ses questions comme des
			   reponses de l'eleve. */
			if ( ! panel_tache_jouable( $task ) ) {
				panel_deverrouiller( $user_id, $room_id, $task, $index );
				$taches_de_machine++;

				continue;
			}

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

			/* Le code d'erreur arrive dans data.code : « empty( data ) ET
			   isset( data.code ) » ne pouvait jamais etre vrai (l'ancienne
			   mesure ne comptait donc aucun verrou, quoi qu'il arrive). */
			if ( isset( $donnees['data']['code'] ) && 'locked' === $donnees['data']['code'] ) {
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
				/* Deux empreintes differentes, parce qu'elles disent
				   deux choses differentes :
				   - « signature » : la copie telle qu'elle est SERVIE
				     (questions, propositions et leur ordre). Deux eleves
				     qui ont la meme signature ont la meme copie a l'ecran.
				   - « contenu » : l'ENSEMBLE des questions, hors ordre des
				     propositions. Deux eleves peuvent avoir des copies
				     differentes et le meme ensemble de questions.
				   L'ancien code calculait deux fois la meme empreinte
				   ordonnee : la seconde mesure ne prouvait rien de plus. */
				$signature = '';
				$textes    = array();

				foreach ( $questions_servies as $question ) {
					$signature .= $question['question'] . '|' . implode( '/', (array) ( isset( $question['choices'] ) ? $question['choices'] : array() ) ) . '##';
					$textes[]   = $question['question'];
				}

				sort( $textes );

				if ( '' === $copie_examen ) {
					$copie_examen   = $signature;
					$contenu_examen = implode( '||', $textes );
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

		/* L'examen a-t-il ete termine et reussi ? On le demande au
		   serveur : c'est lui qui corrige et delivre la medaille. */
		if ( '' !== $copie_examen && $room_id ) {
			$etat = Secura_Progress::exam_state( $user_id, $room_id, $index );
			$dernier_index = max( array_keys( $tasks ) );

			if ( $index === $dernier_index && $etat && ! empty( $etat['finished_at'] ) ) {
				$examen_passe = true;
				$etapes[] = 'examen termine : score ' . absint( $etat['score'] ) . ' %, reussi : '
					. ( ! empty( $etat['passed'] ) ? 'oui' : 'non' );
				break;
			}
		}

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
	$niveau_gagne = $niveau_final['number'] > $niveau_debut['number'];
	$medailles    = panel_medailles( panel_meta( $user_id, SECURA_USER_MEDALS ) );

	$etapes[] = $reponses_totales . ' questions traitées, ' . $reponses_correctes . ' validées par le serveur';
	if ( $taches_de_machine ) {
		$etapes[] = $taches_de_machine . ' tâche(s) de machine déverrouillée(s) sans être jouée(s) (voir l\'auditeur « drapeaux »)';
	}
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
		'niveau_gagne' => $niveau_gagne,
		'examen_passe' => $examen_passe,
		'medailles' => count( $medailles ),
		'reponses' => $reponses_totales,
		'correctes' => $reponses_correctes,
		'rooms'    => $rooms_jouees,
	);

	/* On nettoie : le panel ne laisse pas de comptes dans la base. */
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

$autant_inscrits = count( $personas ) === $inscriptions_web && empty( $inscriptions_impossibles );

audit_verifier(
	'l\'inscription par le formulaire web fonctionne pour les vingt élèves',
	$autant_inscrits,
	(int) $inscriptions_web . ' inscription(s) web sur ' . count( $personas )
		. ( $inscriptions_impossibles ? ' ; échecs : ' . implode( ' | ', $inscriptions_impossibles ) : '' ),
	'majeur',
	count( $personas ) . ' formulaires d inscription postés sur « wp-login.php?action=register » et '
		. (int) $inscriptions_web . ' compte(s) retrouvés par leur identifiant après le POST.'
);

audit_verifier(
	'chaque élève du panel peut se connecter, ouvrir le parcours et commencer le parcours',
	count( $rapports ) === count( $personas ) && empty( $echecs ),
	count( $rapports ) . ' élève(s) sur ' . count( $personas ) . ' ont joué le parcours sans blocage'
		. ( empty( $echecs ) ? '' : ' ; blocages : ' . implode( ' | ', $echecs ) ),
	'majeur',
	$rapports
		? count( $rapports ) . ' parcours joués par HTTP : connexion réelle avec cookie, ouverture du parcours, lecture de la leçon, réponses envoyées à l\'API.'
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

/* Le niveau : on compare le niveau ATTEINT a celui du depart. L'ancienne
   version comparait les niveaux des eleves entre eux (« count( unique ) >= 1 »),
   ce qui est vrai des qu'il y a un eleve : elle ne mesurait rien. */
$niveaux_gagnes = count( array_filter( array_column( $rapports, 'niveau_gagne' ) ) );

audit_verifier(
	'les élèves reçoivent une médaille, et leur niveau progresse vraiment',
	! empty( $rapports )
		&& min( array_column( $rapports, 'medailles' ) ) > 0
		&& $niveaux_gagnes > 0,
	'un élève au moins n\'a reçu aucune médaille, ou aucun élève n\'a changé de niveau ('
		. $niveaux_gagnes . ' progression(s) de niveau sur ' . count( $rapports ) . ')',
	'mineur',
	$rapports
		? implode( ' ; ', array_map(
			function ( $r ) {
				return $r['persona']['nom'] . ' : ' . $r['medailles'] . ' médaille(s), niveau « '
					. $r['niveau'] . ' »' . ( $r['niveau_gagne'] ? ' (a changé de niveau)' : ' (même niveau)' );
			},
			$rapports
		) )
		: 'Aucun élève joué.'
);

/* Le constat dit d'abord COMBIEN d'examens ont ete joues : un constat
   « majeur » sur zero copie ne mesure rien, il signale seulement que la
   recette n'a pas eu lieu. Les deux cas sont donc distingues. */
audit_verifier(
	'des élèves ont réellement passé un examen (sinon la comparaison des copies est vide)',
	count( $signatures ) > 0,
	count( $signatures ) . ' examen(s) terminé(s) par le panel : aucune copie à comparer. '
		. 'Cause probable : le parcours joué ne mène pas à un examen, ou l\'examen n\'a pas été ouvert.',
	'bloquant',
	count( $signatures ) . ' copie(s) d\'examen reçue(s)'
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

/* Ce que cette seconde mesure prouve, sans exagerer : si tous les
   ensembles sont identiques, les eleves ont vu les memes questions (seul
   l'ordre des propositions change). Si certains different, le tirage
   varie vraiment le contenu. */
$ensembles = array_unique( $contenus );

audit_verifier(
	'les élèves ne reçoivent pas seulement les mêmes questions : les ensembles eux-mêmes diffèrent',
	count( $signatures ) > 1 && count( $ensembles ) > 1,
	count( $ensembles ) . ' ensemble(s) de questions distinct(s) pour ' . count( $contenus ) . ' élève(s) : les copies diffèrent par l\'ordre, pas par le tirage.',
	'info',
	$contenus
		? 'Empreinte des questions (texte seul, ordre trié) : ' . implode( ', ', array_map(
			function ( $nom, $empreinte ) {
				return $nom . ' ' . substr( $empreinte, 0, 8 );
			},
			array_keys( $contenus ),
			array_values( $contenus )
		) )
		: 'Aucun examen joué.'
);

audit_info(
	'Ce que les langues et les appareils du panel ne prouvent pas',
	'Les personas ont une langue et un appareil, mais le panel ne change pas de langue et ne simule pas '
	. 'un telephone : il joue en francais, avec le navigateur de la machine d\'audit. La version arabe, '
	. 'le sens de lecture et le rendu mobile sont mesurés par les auditeurs « accessibilite », « ux » et « seo ».'
);

audit_info(
	'Les comptes du panel',
	(int) $inscriptions_web . ' compte(s) créé(s) par le formulaire web, puis supprimé(s) en fin de parcours '
	. '(le panel ne laisse pas de compte derrière lui).'
);

audit_info(
	'Ce que ce panel ne peut pas mesurer',
	'Les questions de drapeau et d\'action demandent la machine de l\'élève : le panel, lui, joue '
	. 'sans machine. Elles sont jouées pour de vrai par l\'auditeur « drapeaux », qui déploie les vraies '
	. 'machines, y cherche les valeurs et fait valider les réponses par le serveur.'
);

exit( audit_fin() );
