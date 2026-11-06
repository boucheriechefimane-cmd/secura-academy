<?php
/**
 * Examens blancs au format du referentiel, ponderes par domaine.
 *
 * POURQUOI CE FICHIER EXISTE
 * --------------------------
 * Un eleve ne sait pas s'il est pret. Les examens de room font quatre
 * questions, valident a 60 %, et ne disent rien du programme officiel.
 * Un examen blanc qui respecte les POIDS du referentiel repond a une
 * autre question : « si l'examen etait demain, ou en serais-je ? »
 *
 * Ce que fait ce script :
 *   1. il lit le referentiel (tools/certifications/sy0-701.json) ;
 *   2. il tire, PAR DOMAINE et selon les poids officiels, des questions
 *      parmi celles qui portent une etiquette de sujet (`topic`) ;
 *   3. il rend une copie : ordre melange, nombre de questions fixe,
 *      duree fixe, et la repartition reelle par domaine ;
 *   4. il note sur l'echelle du referentiel quand on lui donne un
 *      bareme, et liste les sujets faibles.
 *
 * CE QU'IL NE FAIT PAS
 * --------------------
 * Il n'invente pas de questions : sans etiquette `topic`, une question
 * n'entre pas dans un blanc. Aujourd'hui, aucune question n'est encore
 * etiquetee (c'est le travail du point 3 du plan) : le script le dit et
 * sort en erreur plutot que de fabriquer un examen avec du bruit.
 *
 * Usage :
 *   wp eval-file tools/certifications/blanc.php seed=42 questions=90
 *   wp eval-file tools/certifications/blanc.php seed=42 answers=/tmp/reponses.json
 *
 * @package Secura_Academy
 */

$ref_file = __DIR__ . '/sy0-701.json';
$graine   = 42;
$nb_total = 90;
$duree    = 90;
$answers  = '';

/* WP-CLI intercepte les options qui commencent par « -- » et refuse
   celles qu'il ne connait pas. Les arguments de ce script sont donc des
   paires nom=valeur, sans tirets : « seed=42 questions=90 ». C'est moins
   joli qu'une option, et ca marche reellement, ce qui compte davantage. */
foreach ( (array) $args as $a ) {
	$a = (string) $a;

	if ( 0 === strpos( $a, 'seed=' ) ) {
		$graine = (int) substr( $a, 5 );
	} elseif ( 0 === strpos( $a, 'questions=' ) ) {
		$nb_total = max( 5, (int) substr( $a, 10 ) );
	} elseif ( 0 === strpos( $a, 'minutes=' ) ) {
		$duree = max( 5, (int) substr( $a, 8 ) );
	} elseif ( 0 === strpos( $a, 'answers=' ) ) {
		$answers = substr( $a, 8 );
	}
}

if ( ! file_exists( $ref_file ) ) {
	fwrite( STDERR, "Referentiel introuvable.\n" );
	exit( 2 );
}

$ref = json_decode( (string) file_get_contents( $ref_file ), true );

/**
 * Toutes les questions etiquetees du site, par sujet.
 *
 * Une question entre dans le blanc si elle porte `topic` (identifiant de
 * sujet du referentiel, par exemple « 4.3 ») ET une bonne reponse. Les
 * questions ouvertes sans grille sont exclues : on ne note pas de la
 * prose dans un examen chronometre.
 *
 * @return array{par_sujet:array,total:int}
 */
$collecter = function () {
	$rooms = get_posts(
		array(
			'post_type'      => 'secura_room',
			'post_status'    => 'any',
			'posts_per_page' => -1,
			'fields'         => 'ids',
		)
	);

	$par_sujet = array();
	$total     = 0;

	/* D'abord la banque ecrite pour le referentiel : ce sont les seules
	   questions qui couvrent les 34 sujets. Sans elle, un blanc ne
	   pourrait pas respecter les poids officiels. */
	if ( function_exists( 'seca_banque_sy0_701' ) ) {
		foreach ( seca_banque_sy0_701() as $sujet => $questions ) {
			foreach ( $questions as $i => $q ) {
				$par_sujet[ $sujet ][] = array(
					'room'     => 'banque',
					'task'     => 0,
					'q'        => $i,
					'question' => array_merge( $q, array( 'topic' => $sujet, 'mode' => 'choice' ) ),
				);
				$total++;
			}
		}
	}

	foreach ( $rooms as $rid ) {
		$cle   = get_post_meta( $rid, '_secura_key', true );
		$tasks = get_post_meta( $rid, SECURA_META_TASKS, true );

		foreach ( (array) $tasks as $ti => $task ) {
			foreach ( (array) ( isset( $task['questions'] ) ? $task['questions'] : array() ) as $qi => $q ) {
				$sujet = isset( $q['topic'] ) ? trim( (string) $q['topic'] ) : '';

				if ( '' === $sujet ) {
					continue;
				}

				$mode = isset( $q['mode'] ) ? $q['mode'] : '';

				if ( ! in_array( $mode, array( 'choice', 'text' ), true ) ) {
					continue;
				}

				$total++;

				$par_sujet[ $sujet ][] = array(
					'room'     => $cle,
					'task'     => $ti,
					'q'        => $qi,
					'question' => $q,
				);
			}
		}
	}

	return array( 'par_sujet' => $par_sujet, 'total' => $total );
};

$pool = $collecter();

if ( 0 === $pool['total'] ) {
	echo "\nAUCUN EXAMEN BLANC POSSIBLE POUR L'INSTANT.\n\n";
	echo "Le tirage ponderé exige que les questions portent une etiquette de sujet\n";
	echo "(`topic` => '4.3', par exemple). Aucune question n'en porte aujourd'hui.\n\n";
	echo "Ce n'est pas un echec du script : c'est l'etape 3 du plan qui reste a faire\n";
	echo "(voir docs/PLAN-CERTIFICATION-SECURITY-PLUS.md). Un blanc fabrique avec des\n";
	echo "questions non etiquetees mesurerait du bruit, pas une preparation.\n";
	exit( 3 );
}

/* Tirage par domaine, au prorata des poids officiels. */
$tirage  = array();
$reparti = array();

foreach ( $ref['domaines'] as $domaine ) {
	$voulu = (int) round( $nb_total * ( (int) $domaine['poids'] / 100 ) );
	$sujets = array();

	foreach ( (array) $domaine['sujets'] as $sujet ) {
		if ( ! empty( $pool['par_sujet'][ $sujet['id'] ] ) ) {
			$sujets[ $sujet['id'] ] = $pool['par_sujet'][ $sujet['id'] ];
		}
	}

	$pris = 0;

	while ( $pris < $voulu && ! empty( $sujets ) ) {
		foreach ( $sujets as $id => $liste ) {
			if ( $pris >= $voulu ) {
				break;
			}

			$index = $graine % count( $liste );
			$tirage[] = $liste[ $index ];
			unset( $sujets[ $id ][ $index ] );
			$sujets[ $id ] = array_values( $sujets[ $id ] );

			if ( empty( $sujets[ $id ] ) ) {
				unset( $sujets[ $id ] );
			}

			$pris++;
		}
	}

	$reparti[ $domaine['id'] ] = $pris;
}

/* Ordre melange, reproductible : deux eleves avec la meme graine ont la
   meme copie, deux eleves avec des graines differentes non. */
usort(
	$tirage,
	function ( $a, $b ) use ( $graine ) {
		return ( crc32( $graine . '|' . $a['room'] . '|' . $a['task'] . '|' . $a['q'] ) % 1000 )
			<=> ( crc32( $graine . '|' . $b['room'] . '|' . $b['task'] . '|' . $b['q'] ) % 1000 );
	}
);

$tirage = array_slice( $tirage, 0, $nb_total );

echo "\nEXAMEN BLANC — ", $ref['nom'], ' (', $ref['code'], ")\n";
printf( "Graine %d | %d questions | %d minutes\n\n", $graine, count( $tirage ), $duree );

echo "Repartition par domaine (poids officiel -> questions) :\n";

foreach ( $ref['domaines'] as $domaine ) {
	printf(
		"  %s %-42s %2d%% -> %2d question(s)\n",
		$domaine['id'],
		mb_substr( $domaine['nom'], 0, 42 ),
		(int) $domaine['poids'],
		isset( $reparti[ $domaine['id'] ] ) ? (int) $reparti[ $domaine['id'] ] : 0
	);
}

/* Bareme du referentiel : 100 a 900, seuil 750. On applique la meme
   echelle pour que le chiffre ait un sens pour l'eleve. */
$bareme = function ( $bonnes, $total ) {
	if ( $total <= 0 ) {
		return array( 'score' => 100, 'reussi' => false );
	}

	$score = (int) round( 100 + ( ( $bonnes / $total ) * 800 ) );

	return array( 'score' => $score, 'reussi' => $score >= 750 );
};

if ( '' !== $answers && file_exists( $answers ) ) {
	$donnees = json_decode( (string) file_get_contents( $answers ), true );
	$bonnes  = 0;
	$faibles = array();

	foreach ( $tirage as $pos => $item ) {
		$sujet  = isset( $item['question']['topic'] ) ? (string) $item['question']['topic'] : '';
		$juste  = isset( $donnees[ $pos ] ) && ! empty( $donnees[ $pos ] );

		if ( $juste ) {
			$bonnes++;
		} else {
			$faibles[ $sujet ] = isset( $faibles[ $sujet ] ) ? $faibles[ $sujet ] + 1 : 1;
		}
	}

	$note = $bareme( $bonnes, count( $tirage ) );

	printf( "\nRESULTAT : %d/%d — score %d sur 900 (seuil 750) : %s\n", $bonnes, count( $tirage ), $note['score'], $note['reussi'] ? 'REUSSI' : 'ECHOUE' );

	if ( ! empty( $faibles ) ) {
		echo "\nSujets a retravailler (par nombre d'erreurs) :\n";
		arsort( $faibles );

		foreach ( $faibles as $sujet => $n ) {
			printf( "  %s : %d erreur(s)\n", $sujet, $n );
		}
	}

	exit( $note['reussi'] ? 0 : 1 );
}

/* Sans reponses : la copie est rendue sans les bonnes reponses, comme un
   vrai sujet d'examen. */
$copie = array();

foreach ( $tirage as $pos => $item ) {
	$q = $item['question'];
	$copie[] = array(
		'n'        => $pos + 1,
		'sujet'    => isset( $q['topic'] ) ? $q['topic'] : '',
		'room'     => $item['room'],
		'enonce'   => isset( $q['question'] ) ? wp_strip_all_tags( $q['question'] ) : '',
		'choix'    => isset( $q['choices'] ) ? array_values( (array) $q['choices'] ) : array(),
	);
}

echo "\nCOPIE (sans les reponses) :\n\n";

foreach ( $copie as $c ) {
	printf( "%2d. [%s] %s\n", $c['n'], $c['sujet'], $c['enonce'] );

	foreach ( $c['choix'] as $i => $texte ) {
		printf( "      %s) %s\n", chr( 65 + $i ), wp_strip_all_tags( (string) $texte ) );
	}
}

exit( 0 );
