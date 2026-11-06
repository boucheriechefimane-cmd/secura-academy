<?php
/**
 * L'examen blanc doit ressembler a l'examen qu'il prepare.
 *
 * Ce que ce test verifie, et pourquoi :
 *   - la repartition par domaine respecte TOUJOURS le total demande
 *     (le plus fort reste), sinon un blanc de 90 questions en compte 89 ;
 *   - le tirage tourne entre les sujets, sinon un sujet entier peut
 *     disparaitre d'une copie de 90 questions ;
 *   - deux graines differentes donnent deux copies differentes, et la
 *     meme graine redonne exactement la meme copie ;
 *   - le bareme suit l'echelle du referentiel (100 a 900, seuil 750) ;
 *   - un pool trop petit est signale, jamais complete par du vide.
 *
 * Usage : php tests/blanc-test.php
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', '/' );
}

require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-blanc.php';

$ok = 0;
$ko = 0;

/**
 * Compare et compte.
 *
 * @param string $nom     Nom de l'essai.
 * @param mixed  $attendu Attendu.
 * @param mixed  $obtenu  Obtenu.
 */
function blanc_v( $nom, $attendu, $obtenu ) {
	global $ok, $ko;

	if ( $attendu === $obtenu ) {
		$ok++;
		return;
	}

	$ko++;
	echo "ECHEC $nom : attendu ", var_export( $attendu, true ), ' / obtenu ', var_export( $obtenu, true ), "\n";
}

$ref = json_decode( (string) file_get_contents( __DIR__ . '/../tools/certifications/sy0-701.json' ), true );

/* --- 1. Repartition : le total est toujours respecte ---------------- */
foreach ( array( 90, 50, 91, 33, 1, 4 ) as $nb ) {
	$r = Secura_Blanc::repartition( $ref['domaines'], $nb );
	blanc_v( "total $nb respecte", $nb, array_sum( $r['par_domaine'] ) );
}

/* --- 2. Repartition : les poids officiels sont approches ----------- */
$r90 = Secura_Blanc::repartition( $ref['domaines'], 90 );
blanc_v( 'D1 12% de 90 = 11', 11, $r90['par_domaine']['D1'] );
blanc_v( 'D2 22% de 90 = 20', 20, $r90['par_domaine']['D2'] );
blanc_v( 'D3 18% de 90 = 16', 16, $r90['par_domaine']['D3'] );
blanc_v( 'D4 28% de 90 = 25', 25, $r90['par_domaine']['D4'] );
blanc_v( 'D5 20% de 90 = 18', 18, $r90['par_domaine']['D5'] );

/* Le domaine le plus lourd doit toujours avoir le plus de questions :
   c'est la propriete qui compte, pas le chiffre exact. */
blanc_v( 'D4 > D2', true, $r90['par_domaine']['D4'] > $r90['par_domaine']['D2'] );
blanc_v( 'D5 > D1', true, $r90['par_domaine']['D5'] > $r90['par_domaine']['D1'] );

/* --- 3. Repartition : robustesse ------------------------------------ */
blanc_v( 'liste vide', 0, Secura_Blanc::repartition( array(), 90 )['total'] );
blanc_v( 'zero question', 0, array_sum( Secura_Blanc::repartition( $ref['domaines'], 0 )['par_domaine'] ) );

/* --- 4. Tirage : chaque sujet represente est represente ------------- */
$pool = array();
$n    = 0;

foreach ( $ref['domaines'][0]['sujets'] as $sujet ) {
	$pool[ $sujet['id'] ] = array(
		array( 'topic' => $sujet['id'], 'room' => 'r' . ( ++$n ), 'task' => 0, 'q' => 0, 'texte' => 'A' ),
	);
}

$t = Secura_Blanc::tirer_domaine( $ref['domaines'][0], $pool, 7, 42 );
blanc_v( 'D1 entierement couvert (7 sujets)', 7, count( $t['sujets_couverts'] ) );
blanc_v( 'D1 tirage complet', 7, count( $t['questions'] ) );

/* --- 5. Tirage : le tourniquet evite la monopolisation -------------- */
$pool2 = array(
	'1.1' => array(),
	'1.2' => array(),
);

for ( $i = 0; $i < 20; $i++ ) {
	$pool2['1.1'][] = array( 'topic' => '1.1', 'room' => 'a', 'task' => 0, 'q' => $i );
}
$pool2['1.2'][] = array( 'topic' => '1.2', 'room' => 'b', 'task' => 0, 'q' => 0 );

$t2 = Secura_Blanc::tirer_domaine( $ref['domaines'][0], $pool2, 4, 0 );
$sujets2 = array();

foreach ( $t2['questions'] as $q ) {
	$sujets2[ $q['topic'] ] = isset( $sujets2[ $q['topic'] ] ) ? $sujets2[ $q['topic'] ] + 1 : 1;
}

blanc_v( 'le sujet rare est interroge', true, isset( $sujets2['1.2'] ) );

/* --- 6. Tirage : pool trop petit signale --------------------------- */
$t3 = Secura_Blanc::tirer_domaine( $ref['domaines'][0], $pool2, 30, 0 );
blanc_v( 'pool trop petit : manquantes', 9, $t3['manquantes'] );
blanc_v( 'pool trop petit : jamais du vide', 21, count( $t3['questions'] ) );

/* --- 7. Melange : deterministe et discriminant --------------------- */
$questions = array();

for ( $i = 0; $i < 40; $i++ ) {
	$questions[] = array( 'topic' => '1.2', 'room' => 'r', 'task' => 0, 'q' => $i );
}

$m1 = Secura_Blanc::melanger( $questions, 42 );
$m2 = Secura_Blanc::melanger( $questions, 42 );
$m3 = Secura_Blanc::melanger( $questions, 7 );

blanc_v( 'meme graine = meme copie', true, $m1 === $m2 );
blanc_v( 'graine differente = copie differente', true, $m1 !== $m3 );
blanc_v( 'melange ne perd rien', 40, count( $m1 ) );
blanc_v( 'melange change l ordre', true, $m1[0] !== $questions[0] || $m1[39] !== $questions[39] );

/* --- 8. Bareme : echelle du referentiel --------------------------- */
blanc_v( 'tout faux = 100', 100, Secura_Blanc::bareme( 0, 90 )['score'] );
blanc_v( 'tout juste = 900', 900, Secura_Blanc::bareme( 90, 90 )['score'] );
blanc_v( 'tout juste = reussi', true, Secura_Blanc::bareme( 90, 90 )['reussi'] );

/* Le seuil : 750 sur l'echelle correspond a 81,25 % de bonnes reponses.
   73 bonnes sur 90 -> 749 : echoue de peu. 74 -> 758 : reussi. */
blanc_v( '73/90 echoue (749)', false, Secura_Blanc::bareme( 73, 90 )['reussi'] );
blanc_v( '74/90 reussi (758)', true, Secura_Blanc::bareme( 74, 90 )['reussi'] );
blanc_v( 'zero question ne plante pas', 100, Secura_Blanc::bareme( 0, 0 )['score'] );

/* --- 9. Faiblesses : la liste de travail, pas le bulletin ---------- */
$faibles = Secura_Blanc::faiblesses(
	array(
		array( 'topic' => '4.3' ),
		array( 'topic' => '4.3' ),
		array( 'topic' => '1.2' ),
	),
	array( 0 => false, 1 => false, 2 => true )
);

blanc_v( 'seul le sujet rate apparait', array( '4.3' => 2 ), $faibles );

echo "\nRESULTAT : ", $ok + $ko, " essai(s), $ko echec(s)\n";

exit( $ko > 0 ? 1 : 0 );
