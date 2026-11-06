<?php
/**
 * La banque de questions doit etre utilisable, et non seulement correcte.
 *
 * Un QCM peut etre « juste » et mauvais quand meme. Trois travers suffisent
 * a rendre un examen devinable, et ce test les interdit :
 *
 *   1. la bonne reponse est la plus longue — l'eleve apprend a cocher la
 *      plus longue au lieu d'apprendre la notion ;
 *   2. la bonne reponse est presque toujours en A — l'eleve apprend la
 *      lettre ;
 *   3. un sujet du referentiel n'est jamais interroge — l'eleve croit
 *      maitriser un domaine qu'on ne lui a jamais demande.
 *
 * Il verifie aussi que chaque question porte une etiquette de sujet
 * existante, quatre propositions, un index correct valide et une
 * explication non vide : sans cela, l'examen blanc ne peut pas nommer les
 * faiblesses de l'eleve.
 *
 * Usage : php tests/banque-test.php
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', '/' );
}

require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/content-sy0-701-banque.php';

$ok = 0;
$ko = 0;

/**
 * Compare et compte.
 *
 * @param string $nom     Nom de l'essai.
 * @param mixed  $attendu Attendu.
 * @param mixed  $obtenu  Obtenu.
 */
function banque_v( $nom, $attendu, $obtenu ) {
	global $ok, $ko;

	if ( $attendu === $obtenu ) {
		$ok++;
		return;
	}

	$ko++;
	echo "ECHEC $nom : attendu ", var_export( $attendu, true ), ' / obtenu ', var_export( $obtenu, true ), "\n";
}

$ref    = json_decode( (string) file_get_contents( __DIR__ . '/../tools/certifications/sy0-701.json' ), true );
$banque = seca_banque_sy0_701();

$sujets_valides = array();

foreach ( $ref['domaines'] as $d ) {
	foreach ( $d['sujets'] as $s ) {
		$sujets_valides[ $s['id'] ] = $d['id'];
	}
}

/* --- 1. Chaque sujet interroge existe dans le referentiel ----------- */
$inconnus = array();

foreach ( array_keys( $banque ) as $topic ) {
	if ( ! isset( $sujets_valides[ $topic ] ) ) {
		$inconnus[] = $topic;
	}
}

banque_v( 'aucun sujet inconnu', array(), $inconnus );

/* --- 2. Chaque question est exploitable ---------------------------- */
$nb            = 0;
$sans_expl     = 0;
$pas_quatre    = 0;
$index_invalide = 0;
$par_domaine   = array();

foreach ( $banque as $topic => $questions ) {
	$domaine = isset( $sujets_valides[ $topic ] ) ? $sujets_valides[ $topic ] : '?';

	foreach ( $questions as $q ) {
		$nb++;
		$par_domaine[ $domaine ] = isset( $par_domaine[ $domaine ] ) ? $par_domaine[ $domaine ] + 1 : 1;

		if ( 4 !== count( $q['choices'] ) ) {
			$pas_quatre++;
		}

		if ( empty( $q['explanation'] ) ) {
			$sans_expl++;
		}

		if ( $q['correct'] < 0 || $q['correct'] >= count( $q['choices'] ) ) {
			$index_invalide++;
		}
	}
}

banque_v( 'quatre propositions partout', 0, $pas_quatre );
banque_v( 'explication partout', 0, $sans_expl );
banque_v( 'index de bonne reponse valide', 0, $index_invalide );
banque_v( 'au moins 60 questions', true, $nb >= 60 );

/* --- 3. Pas d'indice de longueur ----------------------------------- */
$indices = array();

foreach ( $banque as $topic => $questions ) {
	foreach ( $questions as $q ) {
		$longueurs = array_map( 'mb_strlen', $q['choices'] );
		$moyenne   = array_sum( $longueurs ) / count( $longueurs );
		$max       = max( $longueurs );

		if ( $longueurs[ $q['correct'] ] === $max && $max > 1.6 * $moyenne ) {
			$indices[] = $topic . ' : ' . mb_substr( $q['choices'][ $q['correct'] ], 0, 60 );
		}
	}
}

banque_v( 'aucune bonne reponse plus longue que les autres', array(), $indices );

/* --- 4. Repartition des bonnes reponses equilibree ------------------ */
$positions = array( 0 => 0, 1 => 0, 2 => 0, 3 => 0 );

foreach ( $banque as $questions ) {
	foreach ( $questions as $q ) {
		$positions[ $q['correct'] ]++;
	}
}

foreach ( $positions as $pos => $compte ) {
	$part = $compte / max( 1, $nb );
	banque_v( 'position ' . chr( 65 + $pos ) . ' entre 15 et 35 %', true, $part >= 0.15 && $part <= 0.35 );
}

/* --- 5. Tous les domaines ont des questions ------------------------ */
foreach ( $ref['domaines'] as $d ) {
	$n = isset( $par_domaine[ $d['id'] ] ) ? $par_domaine[ $d['id'] ] : 0;
	banque_v( $d['id'] . ' alimente le tirage', true, $n >= 8 );
}

/* --- 6. Le tirage pondere fonctionne avec la banque reelle --------- */
require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-blanc.php';

$pool = array();

foreach ( $banque as $topic => $questions ) {
	foreach ( $questions as $i => $q ) {
		$pool[ $topic ][] = array(
			'topic' => $topic,
			'room'  => 'banque',
			'task'  => 0,
			'q'     => $i,
			'q_obj' => $q,
		);
	}
}

$tirage = array();
$manque = 0;

foreach ( $ref['domaines'] as $d ) {
	$part = Secura_Blanc::repartition( $ref['domaines'], 90 )['par_domaine'][ $d['id'] ];
	$t    = Secura_Blanc::tirer_domaine( $d, $pool, $part, 42 );
	$tirage = array_merge( $tirage, $t['questions'] );
	$manque += $t['manquantes'];
}

banque_v( 'un blanc de 90 questions est realisable', 0, $manque );
banque_v( 'le blanc fait bien 90 questions', 90, count( $tirage ) );

$domaines_couverts = array();

foreach ( $tirage as $q ) {
	$domaines_couverts[ $sujets_valides[ $q['topic'] ] ] = true;
}

banque_v( 'les cinq domaines sont couverts', 5, count( $domaines_couverts ) );

echo "\nRESULTAT : ", $ok + $ko, " essai(s), $ko echec(s)\n";
echo "Banque : $nb questions, reparties par domaine : ";

ksort( $par_domaine );

foreach ( $par_domaine as $d => $c ) {
	echo "$d=$c ";
}

echo "\n";

exit( $ko > 0 ? 1 : 0 );
