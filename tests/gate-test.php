<?php
/**
 * Les examens doivent discriminer, et une room ne doit pas se valider
 * sans la manipulation.
 *
 * Ce test fige : les trois tentatives, le delai apres epuisement, le refus
 * de rejouer un examen reussi, et la distinction entre un drapeau qui se
 * lit dans un document (pas pratique) et un drapeau qui se trouve en
 * manipulant (pratique).
 *
 * Usage : php tests/gate-test.php
 *
 * @package Secura_Academy
 */

// Test isole de Secura_Gate (tentatives + pratique).
function __( $t, $d = '' ) { return $t; }
function absint( $n ) { return abs( (int) $n ); }
function wp_date( $f, $t ) { return gmdate( 'Y-m-d H:i', $t ); }
define( 'ABSPATH', '/' );
define( 'DAY_IN_SECONDS', 86400 );
class Secura_Progress {
	static $exam = null; static $state = array();
	static function exam_state( $u, $r, $i ) { return self::$exam; }
	static function get_room_state( $u, $r ) { return self::$state; }
}
require __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-gate.php';

$ok = 0; $ko = 0;
function v( $nom, $attendu, $obtenu ) { global $ok,$ko; if ( $attendu === $obtenu ) { $ok++; } else { $ko++; echo "ECHEC $nom : attendu ",var_export($attendu,true)," obtenu ",var_export($obtenu,true),"\n"; } }

// 1. jamais tente -> autorise
Secura_Progress::$exam = null;
v( 'sans historique', true, Secura_Gate::peut_commencer(1,2,3)['autorise'] );

// 2. une tentative ratee -> encore 2
Secura_Progress::$exam = array( 'attempts' => 1, 'finished_at' => time(), 'passed' => false );
$p = Secura_Gate::peut_commencer(1,2,3);
v( '1 tentative -> autorise', true, $p['autorise'] );
v( '1 tentative -> 2 restantes', 2, $p['restantes'] );

// 3. trois tentatives ratees -> refuse
Secura_Progress::$exam = array( 'attempts' => 3, 'finished_at' => time(), 'passed' => false );
$p = Secura_Gate::peut_commencer(1,2,3);
v( '3 tentatives -> refuse', false, $p['autorise'] );
v( '3 tentatives -> code', 'attempts_exhausted', $p['code'] );

// 4. delai ecoule -> nouveau cycle
Secura_Progress::$exam = array( 'attempts' => 3, 'finished_at' => time() - 90000, 'passed' => false );
$p = Secura_Gate::peut_commencer(1,2,3);
v( 'delai ecoule -> autorise', true, $p['autorise'] );
v( 'delai ecoule -> 3 restantes', 3, $p['restantes'] );

// 5. deja reussi -> refuse
Secura_Progress::$exam = array( 'attempts' => 1, 'finished_at' => time(), 'passed' => true );
v( 'deja reussi -> refuse', 'already_passed', Secura_Gate::peut_commencer(1,2,3)['code'] );

// 6. pratique : un drapeau qui renvoie vers un document n'est pas pratique
$taches = array(
	array( 'questions' => array(
		array( 'mode' => 'flag', 'hint' => 'La fiche est dans <code>/srv/cours/owasp</code>', 'question' => 'Releve la valeur.' ),
	) ),
);
$r = Secura_Gate::pratique( 1, 2, $taches );
v( 'drapeau-document non pratique', false, $r['requise'] );

// 7. pratique : un vrai drapeau compte
$taches = array(
	array( 'questions' => array(
		array( 'mode' => 'flag', 'hint' => 'Injecte dans le champ email.', 'question' => 'Recopie le code affiche.' ),
		array( 'mode' => 'choice', 'hint' => '', 'question' => 'Pourquoi ?' ),
	) ),
);
Secura_Progress::$state = array( 'tasks' => array() );
$r = Secura_Gate::pratique( 1, 2, $taches );
v( 'vrai drapeau = pratique requise', true, $r['requise'] );
v( 'pas encore faite', false, $r['faite'] );
v( '1 manipulation restante', 1, $r['restantes'] );

// 8. resolue -> faite
Secura_Progress::$state = array( 'tasks' => array( '0' => array( 'solved' => array( '0' => true ) ) ) );
$r = Secura_Gate::pratique( 1, 2, $taches );
v( 'manipulation faite', true, $r['faite'] );

// 9. compteur de cycles
v( 'cycle 1 sur 3', 3, Secura_Gate::tentatives( array( 'attempts' => 3 ) ) );
v( 'cycle 2 sur 3', 1, Secura_Gate::tentatives( array( 'attempts' => 4 ) ) );
v( 'cycle 0', 0, Secura_Gate::tentatives( null ) );

echo "RESULTAT : ", $ok + $ko, " essai(s), $ko echec(s)\n";
exit( $ko > 0 ? 1 : 0 );
