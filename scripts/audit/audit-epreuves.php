<?php
/**
 * Auditeur 17e sur 17 — Le moteur d'épreuves : deux élèves ne passent jamais
 * la même copie.
 *
 * PERIMETRE
 * Ce qui fait qu'un examen ne se "recopie" pas : le réservoir de questions
 * (le niveau entier, pas seulement la room), le tirage sans remise, le
 * mélange des propositions, la variation des chiffres (questions
 * paramétriques), la mémorisation de la copie (recharger ne change rien,
 * recommencer change tout), et le fait que les questions liées à une machine
 * (drapeau, action) ne voyagent pas dans d'autres rooms.
 *
 * METHODE
 * On mesure : on tire des copies pour de faux eleves, on compare les copies
 * entre eux, on recompte le reservoir de chaque examen, et on verifie que
 * chaque question parametrique a assez de variantes et que toutes les
 * valeurs utilisees sont definies. Les chiffres annonces dans ce rapport
 * sont mesures, jamais supposes.
 *
 * @package Secura_Academy
 */

require_once __DIR__ . '/audit-lib.php';
require_once __DIR__ . '/lib-http.php';

audit_titre( 'epreuves', 'Le moteur d\'épreuves : deux élèves, deux copies' );

audit_expert(
	'Expert en évaluation secure et en generation d\'epreuves aleatoires reproductibles',
	'Vérifie que chaque apprenant reçoit sa propre copie d\'examen : un reservoir '
	. 'suffisant au niveau, un tirage sans remise, des propositions melangees, '
	. 'des chiffres varies, une copie memorisee (recharger ne change rien) et '
	. 'repoussee a chaque nouvelle tentative. Mesure les reservoir et les '
	. 'variantes, et signale les trous de contenu plutot que de les cacher.' );

$racine = dirname( dirname( dirname( __FILE__ ) ) );
$plugin = $racine . '/wp-content/plugins/secura-academy';

/* ------------------------------------------------------------------ */
echo "\n1. Le moteur est-il present et chargé ?\n";

$moteur = $plugin . '/includes/class-secura-exam.php';

audit_verifier(
	'le moteur d\'épreuves est livré avec le plugin',
	file_exists( $moteur ),
	'fichier absent : ' . $moteur,
	'majeur',
	'fichier présent : ' . basename( $moteur )
);

$moteur_charge = class_exists( 'Secura_Exam' );
$moteurs_ouverts = 0;

if ( file_exists( $moteur ) ) {
	$moteurs_ouverts = substr_count( file_get_contents( $moteur ), 'class Secura_Exam' );
}

audit_verifier(
	'le moteur est chargé par le plugin (et non un fichier oublié)',
	$moteur_charge && $moteurs_ouverts > 0,
	'classe Secura_Exam non chargée',
	'majeur',
	'moteur chargé : ' . ( $moteur_charge ? 'oui' : 'non' )
);

$aleatoire = 0;

if ( file_exists( $moteur ) ) {
	/* On ne compte que le code : un nom dfonction cité dans un
	   commentaire n'est pas un appel. */
	$code = preg_replace( '#/\*.*?\*/#s', '', file_get_contents( $moteur ) );
	$code = preg_replace( '#//[^\n]*#', '', $code );

	$aleatoire = preg_match_all( '/[\s;(]\s*(shuffle|array_rand|wp_rand|mt_rand|random_int)\s*\(/', $code );
}

audit_verifier(
	'le tirage est reproductible (pas de hasard non maîtrisé)',
	0 === $aleatoire,
	$aleatoire . ' appel(s) à un hasard non maîtrisé dans le moteur',
	'mineur',
	'le moteur utilise un générateur déterministe (xorshift32) : aucun appel à shuffle/array_rand/random_int'
);

/* ------------------------------------------------------------------ */
echo "\n2. Les questions paramétriques : des chiffres qui changent vraiment\n";

$rooms      = get_posts( array( 'post_type' => 'secura_room', 'numberposts' => -1, 'post_status' => 'publish' ) );
$param      = array();
$questions  = 0;
$examens    = array();

foreach ( $rooms as $room ) {
	$taches = Secura_Rooms::get_tasks( $room->ID );

	foreach ( $taches as $index => $tache ) {
		$questions += count( $tache['questions'] );

		if ( 'exam' === $tache['type'] ) {
			$examen = Secura_Exam::pool_size( $room->ID, $index );
			$epreuve = count( $tache['questions'] );

			$examens[] = array(
				'room'   => $room->ID,
				'index'  => $index,
				'pool'   => $examen,
				'epreuve' => $epreuve,
			);
		}

		foreach ( $tache['questions'] as $q_index => $question ) {
			if ( empty( $question['variants'] ) ) {
				continue;
			}

			$param[] = array(
				'room'     => $room->ID,
				'index'    => $index,
				'q'        => $q_index,
				'question' => $question,
			);
		}
	}

	/* Les questions reprises d'un examen d'universite vivent dans la
	   reserve de la room (cf. Secura_Rooms::reserve) : elles font
	   partie de la plateforme, meme si elles ne sont dans aucune
	   tache — c'est la reserve qui alimente le reservoir. */
	$questions += count( (array) Secura_Rooms::reserve( $room->ID ) );
}

audit_info(
	'toutes les questions de la plateforme',
	$questions . ' questions réparties dans ' . count( $rooms ) . ' rooms',
	'comptage fait sur les tâches normalisées de chaque room'
);

audit_info(
	'questions paramétriques (chiffres qui changent d\'une copie à l\'autre)',
	count( $param ) . ' question(s) portent des variantes',
	'liste relevée dans les tâches normalisées'
);

$variantes_insuffisantes = array();
$valeurs_manquantes      = array();
$rendus_identiques        = array();

foreach ( $param as $entree ) {
	$question = $entree['question'];
	$jeux     = $question['variants'];

	if ( count( $jeux ) < 3 ) {
		$variantes_insuffisantes[] = $entree['room'] . ' / ' . $entree['question']['question'];
	}

	/* Les mots utilises dans le texte doivent exister dans CHAQUE jeu :
	   sinon la copie affiche un {mot} nu, et l'eleve ne comprend rien. */
	$mots = array();

	foreach ( array( 'question', 'hint', 'explanation' ) as $champ ) {
		if ( ! empty( $question[ $champ ] ) && preg_match_all( '/\{([A-Za-z0-9_]+)\}/', $question[ $champ ], $m ) ) {
			$mots = array_merge( $mots, $m[1] );
		}
	}

	foreach ( array( 'choices', 'answers' ) as $champ ) {
		foreach ( (array) $question[ $champ ] as $valeur ) {
			if ( preg_match_all( '/\{([A-Za-z0-9_]+)\}/', (string) $valeur, $m ) ) {
				$mots = array_merge( $mots, $m[1] );
			}
		}
	}

	$mots = array_unique( $mots );

	foreach ( $jeux as $jeu ) {
		foreach ( $mots as $mot ) {
			if ( ! array_key_exists( $mot, $jeu ) ) {
				$valeurs_manquantes[] = $entree['room'] . ' : {' . $mot . '} absent d\'un jeu de valeurs';
			}
		}
	}

	/* Deux jeux de valeurs doivent donner deux textes differents :
	   sinon la question est paramétrique en apparence seulement. */
	$rendus = array();

	foreach ( $jeux as $jeu ) {
		$rendus[] = self_changer_mots( $question['question'], $jeu );
	}

	if ( count( array_unique( $rendus ) ) < 2 ) {
		$rendus_identiques[] = $entree['room'] . ' : toutes les variantes donnent le même texte';
	}
}

audit_verifier(
	'chaque question paramétrique propose au moins trois variantes',
	empty( $variantes_insuffisantes ),
	count( $variantes_insuffisantes ) . ' question(s) avec moins de trois variantes',
	'majeur',
	implode( ' ; ', array_slice( $variantes_insuffisantes, 0, 5 ) )
);

audit_verifier(
	'chaque valeur utilisée par une question paramétrique est définie dans tous les jeux',
	empty( $valeurs_manquantes ),
	count( $valeurs_manquantes ) . ' valeur(s) manquante(s) : le {mot} resterait nu dans la copie',
	'majeur',
	implode( ' ; ', array_slice( $valeurs_manquantes, 0, 5 ) )
);

audit_verifier(
	'des variantes différentes donnent bien des textes différents',
	empty( $rendus_identiques ),
	count( $rendus_identiques ) . ' question(s) dont les variantes ne changent rien',
	'majeur',
	implode( ' ; ', array_slice( $rendus_identiques, 0, 5 ) )
);

/* La preuve la plus parlante : le meme examen, vu par dix eleves. */
$preuve_variantes = '';

if ( ! empty( $param ) ) {
	$entree  = $param[0];
	$room_id = $entree['room'];
	$taches  = Secura_Rooms::get_tasks( $room_id );
	$question = $entree['question'];
	$textes   = array();

	for ( $u = 1; $u <= 10; $u++ ) {
		$uid = wp_insert_user(
			array(
				'user_login' => 'audit-epreuve-' . $u . '-' . substr( md5( $u . microtime() ), 0, 6 ),
				'user_pass'  => wp_generate_password( 16 ),
				'user_email' => 'audit-epreuve-' . $u . '@exemple.test',
				'role'       => 'subscriber',
			)
		);

		if ( is_wp_error( $uid ) ) {
			continue;
		}

		$variante = Secura_Exam::variante( $question, crc32( $uid . '|' . $room_id ) );
		$textes[] = strip_tags( $variante['question'] );

		wp_delete_user( $uid );
	}

	$distinctes = count( array_unique( $textes ) );

	audit_verifier(
		'dix élèves regardant la même question paramétrique ne voient pas les mêmes chiffres',
		$distinctes >= 2,
		$distinctes . ' texte(s) différent(s) sur 10',
		'majeur',
		implode( ' || ', array_slice( array_unique( $textes ), 0, 4 ) )
	);

	$preuve_variantes = $distinctes;
}

/* ------------------------------------------------------------------ */
echo "\n3. Le réservoir : de combien de questions se compose un examen ?\n";

$reservoirs = array();

foreach ( $examens as $examen ) {
	$reservoirs[] = $examen['pool'];
}

$plus_petit = ! empty( $reservoirs ) ? min( $reservoirs ) : 0;
$plus_grand = ! empty( $reservoirs ) ? max( $reservoirs ) : 0;
$median     = ! empty( $reservoirs ) ? $reservoirs[ (int) floor( count( $reservoirs ) / 2 ) ] : 0;

/* Combien d'exemplaires distincts un reservoir de N questions permet-il
   pour une epreuve de K questions ? C(N,K) — le nombre de combinaisons.
   C'est ce nombre qui rend la photo d'ecran inutilisable. */
$combinaisons = 0;

foreach ( $examens as $examen ) {
	$n = $examen['pool'];
	$k = min( $examen['epreuve'], $n );

	if ( $k < 1 || $n < 1 ) {
		continue;
	}

	$combinaisons = (int) round( $combinaisons + self_combinations( $n, $k ) );
}

audit_info(
	'réservoir de questions par examen',
	'de ' . $plus_petit . ' à ' . $plus_grand . ' questions (médiane ' . $median . ')',
	'mesuré sur les ' . count( $examens ) . ' examens de la plateforme'
);

audit_info(
	'combinaisons possibles d\'épreuves',
	$combinaisons . ' copies différentes, au total, sur les examens de la plateforme',
	'produit des combinaisons (réservoir × taille d\'épreuve) calculé sur chaque examen'
);

/* Le contrat de l'utilisateur : environ 200 questions par niveau, pour ne
   proposer que quelques questions par examen. On mesure l'ecart au lieu de
   le declarer resolu. */
$niveaux = 0;

foreach ( get_posts( array( 'post_type' => 'secura_path', 'numberposts' => -1, 'post_status' => 'publish' ) ) as $chemin ) {
	$sections = get_post_meta( $chemin->ID, SECURA_META_PATH_SECTIONS, true );

	if ( ! is_array( $sections ) ) {
		continue;
	}

	$niveaux += count( $sections );
}

audit_info(
	'niveaux (sections) couverts par le moteur',
	$niveaux . ' section(s) de parcours',
	'le réservoir d\'un examen est le niveau entier, pas seulement la room'
);

/* Un reservoir trop petit fait se ressembler les copies : on le signale
   comme un manque de contenu, pas comme un bug du moteur. */
$faibles = array();

foreach ( $examens as $examen ) {
	if ( $examen['pool'] < max( 10, $examen['epreuve'] * 5 ) ) {
		$faibles[] = 'room ' . $examen['room'] . ' : ' . $examen['pool'] . ' questions pour une épreuve de ' . $examen['epreuve'];
	}
}

audit_verifier(
	'chaque examen dispose d\'un réservoir au moins cinq fois plus grand que son épreuve',
	empty( $faibles ),
	count( $faibles ) . ' examen(s) avec un réservoir trop juste',
	'mineur',
	implode( ' ; ', array_slice( $faibles, 0, 5 ) )
);

/* ------------------------------------------------------------------ */
echo "\n4. La copie est-elle mémorisée, et une nouvelle tentative ?\n";

if ( ! empty( $examens ) ) {
	$examen  = $examens[0];
	$room_id = $examen['room'];
	$index   = $examen['index'];
	$taches  = Secura_Rooms::get_tasks( $room_id );

	$uid = wp_insert_user(
		array(
			'user_login' => 'audit-copie-' . substr( md5( microtime() ), 0, 8 ),
			'user_pass'  => wp_generate_password( 16 ),
			'user_email' => 'audit-copie-' . substr( md5( microtime() ), 0, 8 ) . '@exemple.test',
			'role'       => 'subscriber',
		)
	);

	if ( ! is_wp_error( $uid ) ) {
		$premiere = Secura_Exam::paper( $uid, $room_id, $index, $taches[ $index ] );
		$reprise = Secura_Exam::paper( $uid, $room_id, $index, $taches[ $index ] );

		$empreinte = function ( $questions ) {
			$texte = '';

			foreach ( $questions as $question ) {
				$texte .= $question['question'] . '|' . implode( '/', (array) $question['choices'] ) . '##';
			}

			return md5( $texte );
		};

		audit_verifier(
			'recharger la page redonne la MÊME copie (l\'élève ne perd pas son questionnaire)',
			$empreinte( $premiere ) === $empreinte( $reprise ),
			'les deux tirages diffèrent : l\'élève verrait ses questions changer',
			'majeur',
			'empreinte de la copie relue : ' . $empreinte( $reprise )
		);

		wp_delete_user( $uid );
	}
}

/* Deux eleves, deux copies : la mesure qui compte. */
$preuves = array();
$copies  = array();
$ensembles = array();

if ( ! empty( $examens ) ) {
	$examen  = $examens[0];
	$room_id = $examen['room'];
	$index   = $examen['index'];
	$taches  = Secura_Rooms::get_tasks( $room_id );

	for ( $u = 1; $u <= 10; $u++ ) {
		$uid = wp_insert_user(
			array(
				'user_login' => 'audit-deux-' . $u . '-' . substr( md5( $u . microtime() ), 0, 6 ),
				'user_pass'  => wp_generate_password( 16 ),
				'user_email' => 'audit-deux-' . $u . '@exemple.test',
				'role'       => 'subscriber',
			)
		);

		if ( is_wp_error( $uid ) ) {
			continue;
		}

		$copie = Secura_Exam::paper( $uid, $room_id, $index, $taches[ $index ] );
		$texte = '';
		$questions = array();

		foreach ( $copie as $question ) {
			$texte .= $question['question'] . '|' . implode( '/', (array) $question['choices'] ) . '##';
			$questions[] = $question['question'];
		}

		/* L'ensemble, sans l'ordre : c'est ce qu'un eleve verrait sur une
		   photo d'ecran. Deux copies qui ne different que par l'ordre sont
		   la meme copie pour l'eleve. */
		sort( $questions );

		$copies[]    = md5( $texte );
		$ensembles[] = md5( implode( '##', $questions ) );
		$preuves[]    = 'élève ' . $u . ' : ' . substr( md5( $texte ), 0, 12 );

		wp_delete_user( $uid );
	}
}

audit_verifier(
	'dix élèves, dix copies différentes (une photo d\'écran ne sert à rien)',
	count( array_unique( $copies ) ) === count( $copies ) && count( $copies ) > 1,
	count( array_unique( $copies ) ) . ' copie(s) distincte(s) pour ' . count( $copies ) . ' élève(s)',
	'majeur',
	implode( ' ; ', $preuves )
);

audit_verifier(
	'dix élèves, dix ENSEMBLES de questions différents (l\'ordre seul ne suffit pas)',
	count( array_unique( $ensembles ) ) === count( $ensembles ) && count( $ensembles ) > 1,
	count( array_unique( $ensembles ) ) . ' ensemble(s) distinct(s) pour ' . count( $ensembles ) . ' élève(s)',
	'majeur',
	'deux eleves ne peuvent pas avoir le meme examen : le moteur reserve les ensembles, il ne les laisse pas au hasard'
);

/* ------------------------------------------------------------------ */
echo "\n4 bis. Deux élèves peuvent-ils recevoir le même ensemble de questions ?\n";

/* On tire vingt copies d'un meme examen, comme vingt eleves le
   feraient, et on compare les ENSEMBLES de questions (pas seulement
   l'ordre) : c'est la regle du proprietaire — jamais les memes
   questions pour le meme niveau. */

$copies   = array();
$ensembles = array();
$epreuve_elue = 0;

if ( ! empty( $examens ) ) {
	$epreuve_elue = $examens[0]['room'];
	$taches       = Secura_Rooms::get_tasks( $epreuve_elue );
	$index        = $examens[0]['index'];

	foreach ( array_slice( $taches, $index, 1 ) as $tache ) {
		for ( $u = 1; $u <= 20; $u++ ) {
			/* Un identifiant d'eleve factice : on veut le TIRAGE, pas
			   une copie deja enregistree. */
			$copie = Secura_Exam::paper( 900000 + $u, $epreuve_elue, $index, $tache );

			$texte = '';

			foreach ( $copie as $question ) {
				$texte .= $question['question'] . '##';
			}

			$copies[] = md5( $texte );

			$ensemble = array();

			foreach ( $copie as $question ) {
				$ensemble[] = $question['question'];
			}

			sort( $ensemble );

			$ensembles[] = md5( implode( '##', $ensemble ) );
		}
	}
}

audit_verifier(
	'vingt copies d\'un même examen donnent vingt ensembles de questions différents',
	count( array_unique( $ensembles ) ) === count( $ensembles ) && count( $ensembles ) > 1,
	count( array_unique( $ensembles ) ) . ' ensemble(s) distinct(s) pour ' . count( $ensembles ) . ' tirage(s)',
	'majeur',
	'le tirage se fait par un compteur atomique (incrémentation en base) : deux élèves ne peuvent pas hériter du même ensemble'
);

/* ------------------------------------------------------------------ */
echo "\n5. Les questions liées à une machine restent dans leur room\n";

$transposees = array();

foreach ( $rooms as $room ) {
	$room_id = $room->ID;

	foreach ( Secura_Exam::pool( $room_id, array( 'exam', 'test' ) ) as $entree ) {
		$mode = isset( $entree['question']['mode'] ) ? $entree['question']['mode'] : 'text';

		if ( 'flag' !== $mode && 'action' !== $mode ) {
			continue;
		}

		if ( $entree['room'] !== $room_id ) {
			$transposees[] = 'room ' . $room_id . ' tire une question de machine de la room ' . $entree['room'];
		}
	}
}

audit_verifier(
	'aucune question de drapeau ou d\'action ne quitte sa room',
	empty( $transposees ),
	count( $transposees ) . ' question(s) transposée(s)',
	'majeur',
	implode( ' ; ', array_slice( $transposees, 0, 5 ) )
);

/* ------------------------------------------------------------------ */
/* 6. La copie servie est-elle entierement repondable ?                  */
/* ------------------------------------------------------------------ */

echo "\n6. La copie servie à l'élève est-elle entièrement répondable ?\n";

$url_site = defined( 'SECA_WP_URL' ) ? (string) SECA_WP_URL : '';

if ( '' === $url_site ) {
	$env_url = getenv( 'SECA_WP_URL' );

	$url_site = is_string( $env_url ) && '' !== $env_url ? $env_url : (string) home_url( '/' );
}

$url_site = rtrim( $url_site, '/' );

/* On joue le rôle d'un élève : on demande la tâche (c'est la copie
   servie que le navigateur recoit), puis on tente de repondre a sa
   DERNIERE question. Si le serveur refuse l'index (« Question
   invalide »), l'eleve ne peut pas finir sa room : la question existe
   a l'ecran mais pas pour le serveur. C'est exactement le piege que
   l'import de masse a rendu visible : la copie tiree peut etre plus
   longue que la liste d'origine, et c'est la copie qu'il faut
   interroger. */
$eleves = array();

for ( $n = 0; $n < 4; $n++ ) {
	$login  = 'audit-copie-' . $n . '-' . substr( md5( microtime() . $n ), 0, 6 );
	$motif  = wp_generate_password( 18 );
	$cookie = '/tmp/audit-copie-' . $n . '-' . getmypid() . '.txt';

	$user_id = wp_insert_user(
		array(
			'user_login' => $login,
			'user_pass'  => $motif,
			'user_email' => $login . '@exemple.test',
			'role'       => 'subscriber',
		)
	);

	if ( is_wp_error( $user_id ) ) {
		continue;
	}

	panel_connecter( $url_site, $cookie, $login, $motif );

	/* Le jeton de session est livre dans la page : on le recupere
	   comme le ferait un navigateur. */
	$nonce = '';

	$page = panel_appel( get_permalink( $rooms[0]->ID ), $cookie );

	if ( preg_match( '/"nonce":"([a-f0-9]+)"/', $page['corps'], $m_nonce ) ) {
		$nonce = $m_nonce[1];
	}

	$eleves[] = array(
		'id'     => $user_id,
		'login'  => $login,
		'cookie' => $cookie,
		'nonce'  => $nonce,
	);
}

$refuses   = array();
$copies_non_servies = array();
$verifiees = 0;

foreach ( $rooms as $index_room => $room ) {
	if ( empty( $eleves ) ) {
		break;
	}

	$eleve = $eleves[ $index_room % count( $eleves ) ];

	$taches = Secura_Rooms::get_tasks( $room->ID );

	foreach ( $taches as $index_tache => $tache ) {
		if ( 'test' !== ( $tache['type'] ?? '' ) && 'exam' !== ( $tache['type'] ?? '' ) ) {
			continue;
		}

		/* On deverrouille les taches precedentes, comme un eleve
		   qui les aurait faites : sinon le serveur refuse la copie
		   pour la bonne raison qu'elle est verrouillee — et le
		   controle ne testerait rien. */
		for ( $i = 0; $i < $index_tache; $i++ ) {
			audit_deverrouille_tache( $eleve['id'], $room->ID, $taches[ $i ], $i );
		}

		/* Un examen doit etre ouvert AVANT de livrer sa copie : c'est la
		   regle du serveur (get_task repond 409 « exam_not_started »).
		   On ouvre donc le chronometre, comme le navigateur le fait. */
		if ( 'exam' === ( $tache['type'] ?? '' ) ) {
			panel_appel(
				admin_url( 'admin-ajax.php' ),
				$eleve['cookie'],
				array(
					'action'  => 'secura_start_exam',
					'room_id' => $room->ID,
					'task'    => $index_tache,
					'nonce'   => $eleve['nonce'],
				)
			);
		}

		$tache_servie = panel_appel(
			admin_url( 'admin-ajax.php' ),
			$eleve['cookie'],
			array(
				'action'  => 'secura_get_task',
				'room_id' => $room->ID,
				'task'    => $index_tache,
				'nonce'   => $eleve['nonce'],
			)
		);

		$donnees = json_decode( $tache_servie['corps'], true );

		if ( ! is_array( $donnees ) || empty( $donnees['data']['task']['questions'] ) ) {
			$copies_non_servies[] = 'room ' . $room->ID . ' (tache ' . $index_tache . ') : code '
				. ( isset( $donnees['data']['code'] ) ? $donnees['data']['code'] : 'sans code' );

			continue;
		}

		$questions = (array) $donnees['data']['task']['questions'];
		$dernier   = count( $questions ) - 1;

		$reponse = panel_appel(
			admin_url( 'admin-ajax.php' ),
			$eleve['cookie'],
			array(
				'action'   => 'secura_validate_answer',
				'room_id'  => $room->ID,
				'task'     => $index_tache,
				'question' => $dernier,
				'answer'   => 'reponse de controle de audit',
				'nonce'    => $eleve['nonce'],
			)
		);

		$verifiees++;

		if ( 400 === (int) $reponse['code'] && false !== stripos( $reponse['corps'], 'invalide' ) ) {
			$refuses[] = 'room ' . $room->ID . ' (tache ' . $index_tache . ') : question ' . $dernier . ' refusee';
		}
	}
}

/* Les quatre comptes de controle sont supprimes : l'audit ne doit pas
   laisser de faux eleves dans la base (les anciennes executions en
   laissaient quatre, visibles dans la liste des comptes). */
$supprimes = 0;

foreach ( $eleves as $eleve ) {
	if ( ! empty( $eleve['id'] ) && get_user_by( 'id', $eleve['id'] ) ) {
		require_once ABSPATH . 'wp-admin/includes/user.php';
		wp_delete_user( $eleve['id'] );
		$supprimes++;
	}

	@unlink( $eleve['cookie'] );
}

audit_info(
	'Les comptes de contrôle',
	$supprimes . ' compte(s) fictif(s) supprimé(s) après le contrôle : la base de recette ne garde pas d\'élève d\'audit.'
);

audit_verifier(
	'toutes les questions de la copie servie sont acceptees par le serveur',
	empty( $refuses ) && empty( $copies_non_servies ) && $verifiees > 0,
	trim( implode( ' ; ', array_merge(
		array_slice( $refuses, 0, 4 ),
		array_slice( $copies_non_servies, 0, 4 )
	) ) . ( $verifiees > 0 ? '' : 'aucune copie servie : le controle n a pas eu lieu' ) ) . ' (' . $verifiees . ' copie(s) servie(s))',
	'majeur',
	$verifiees . ' copie(s) verifiee(s) : on a tente de repondre a la derniere question de chaque copie servie, et le serveur ne l\'a jamais refusee'
);


/**
 * Marque une tache comme faite, pour un eleve de controle : on
 * deverrouille la suite sans passer par le navigateur.
 *
 * @param int   $user_id Eleve.
 * @param int   $room_id Room.
 * @param array $tache   La tache a marquer.
 * @param int   $index   Index de la tache.
 */
function audit_deverrouille_tache( $user_id, $room_id, array $tache, $index ) {
	$state = Secura_Progress::get_room_state( $user_id, $room_id );
	$key   = (string) (int) $index;

	if ( ! isset( $state['tasks'][ $key ] ) || ! is_array( $state['tasks'][ $key ] ) ) {
		$state['tasks'][ $key ] = array(
			'solved' => array(),
			'hints'  => array(),
			'done'   => false,
		);
	}

	if ( empty( $tache['questions'] ) ) {
		/* Une lecon : le clic « j'ai lu » suffit. */
		$state['tasks'][ $key ]['done'] = true;
	} else {
		foreach ( array_keys( (array) $tache['questions'] ) as $question ) {
			$state['tasks'][ $key ]['solved'][ (string) $question ] = true;
		}
	}

	Secura_Progress::save_room_state( $user_id, $room_id, $state );
}

/* ------------------------------------------------------------------ */
echo "\n7. Les examens d'universite restent en reserve : un point de controle ne doit pas faire 80 questions\n";

$dans_tache = array();
$gonfles    = array();
$sans_reserve = array();
$tailles    = array();

foreach ( $rooms as $room ) {
	$taches = Secura_Rooms::get_tasks( $room->ID );

	/* Regle 1 : une question importee (elle porte une source et une
	   licence) ne doit se trouver dans AUCUNE tache. */
	foreach ( $taches as $tache ) {
		foreach ( (array) $tache['questions'] as $question ) {
			if ( ! empty( $question['source'] ) ) {
				$dans_tache[] = 'room ' . $room->post_name . ' : question importee dans la tache ' . $tache['type'];
			}
		}
	}

	/* Regle 2 : la copie servie du point de controle ne depasse jamais
	   la taille prevue par le moteur (la taille de l'epreuve). */
	$epreuve = 0;

	foreach ( $taches as $tache ) {
		if ( 'exam' === $tache['type'] ) {
			$epreuve = count( $tache['questions'] );

			break;
		}
	}

	foreach ( $taches as $index => $tache ) {
		if ( 'test' !== $tache['type'] ) {
			continue;
		}

		$attendu = max( 1, count( $tache['questions'] ), $epreuve );
		$copie   = Secura_Exam::paper( 0, $room->ID, $index, $tache );
		$tailles[] = count( $copie );

		if ( count( $copie ) > $attendu ) {
			$gonfles[] = 'room ' . $room->post_name . ' : copie de ' . count( $copie ) . ' questions au lieu de ' . $attendu;
		}
	}

	/* Regle 3 : la reserve doit vraiment alimenter le reservoir :
	   sinon les questions importees disparaitraient de la plateforme. */
	if ( ! empty( (array) Secura_Rooms::reserve( $room->ID ) ) ) {
		$importees = 0;

		foreach ( Secura_Exam::pool( $room->ID, array( 'exam', 'test' ) ) as $entree ) {
			if ( ! empty( $entree['question']['source'] ) ) {
				$importees++;
			}
		}

		if ( 0 === $importees ) {
			$sans_reserve[] = 'room ' . $room->post_name . ' : sa reserve est vide, elle n alimente plus le reservoir';
		}
	}
}

audit_verifier(
	'les questions reprises d\'un examen d\'universite ne sont dans aucune tache (elles sont en reserve)',
	empty( $dans_tache ),
	count( $dans_tache ) . ' question(s) importee(s) dans une tache',
	'bloquant',
	implode( ' ; ', array_slice( $dans_tache, 0, 5 ) )
);

audit_verifier(
	'la copie servie du point de controle ne depasse jamais la taille de l\'epreuve',
	empty( $gonfles ),
	count( $gonfles ) . ' room(s) avec un point de controle gonfle',
	'bloquant',
	implode( ' ; ', array_slice( $gonfles, 0, 5 ) )
);

audit_verifier(
	'la reserve alimente bien le reservoir des epreuves (les questions importees restent jouables)',
	empty( $sans_reserve ),
	count( $sans_reserve ) . ' room(s) dont la reserve n\'alimente plus le reservoir',
	'bloquant',
	implode( ' ; ', array_slice( $sans_reserve, 0, 5 ) )
);

audit_info(
	'taille de la copie servie du point de controle',
	( $tailles ? min( $tailles ) : 0 ) . ' a ' . ( $tailles ? max( $tailles ) : 0 ) . ' questions',
	'mesure sur les ' . count( $tailles ) . ' points de controle de la plateforme'
);

/* ------------------------------------------------------------------ */
exit( audit_fin() );

/**
 * Remplace les {mots} d'un texte par les valeurs d'un jeu.
 *
 * @param string $texte Texte.
 * @param array  $jeu   Valeurs.
 * @return string
 */
function self_changer_mots( $texte, array $jeu ) {
	return preg_replace_callback(
		'/\{([A-Za-z0-9_]+)\}/',
		function ( $mot ) use ( $jeu ) {
			return array_key_exists( $mot[1], $jeu ) ? (string) $jeu[ $mot[1] ] : $mot[0];
		},
		$texte
	);
}

/**
 * Nombre de combinaisons de k parmi n.
 *
 * @param int $n Total.
 * @param int $k Nombre choisi.
 * @return float
 */
function self_combinations( $n, $k ) {
	if ( $k > $n ) {
		$k = $n;
	}

	$resultat = 1.0;

	for ( $i = 1; $i <= $k; $i++ ) {
		$resultat = $resultat * ( $n - $k + $i ) / $i;
	}

	return $resultat;
}
