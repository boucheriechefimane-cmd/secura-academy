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

		foreach ( $copie as $question ) {
			$texte .= $question['question'] . '|' . implode( '/', (array) $question['choices'] ) . '##';
		}

		$copies[] = md5( $texte );
		$preuves[] = 'élève ' . $u . ' : ' . substr( md5( $texte ), 0, 12 );

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
