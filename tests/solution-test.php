<?php
/**
 * La correction des questions ouvertes ne doit plus etre une passoire.
 *
 * Ce test fige la regle qui remplace « dix caracteres suffisent » :
 *   - une reponse courte ou creuse est refusee ;
 *   - une redaction serieuse sans grille est renvoyee en auto-evaluation ;
 *   - une grille juge objectivement, et dit ce qui manque ;
 *   - un mot-cle court ne matche pas n'importe quelle sous-chaine ;
 *   - les accents et les pluriels ne font pas echouer une bonne reponse.
 *
 * Usage : php tests/solution-test.php
 *
 * @package Secura_Academy
 */

// Test isole de Secura_Solution, sans WordPress.
function __( $t, $d = '' ) { return $t; }
function wp_strip_all_tags( $t ) { return strip_tags( (string) $t ); }
function remove_accents( $t ) {
	$map = array( 'à'=>'a','â'=>'a','ä'=>'a','é'=>'e','è'=>'e','ê'=>'e','ë'=>'e','î'=>'i','ï'=>'i','ô'=>'o','ö'=>'o','ù'=>'u','û'=>'u','ü'=>'u','ç'=>'c','œ'=>'oe','æ'=>'ae','É'=>'E','À'=>'A' );
	return strtr( $t, $map );
}
function absint( $n ) { return abs( (int) $n ); }
define( 'ABSPATH', '/' );
require __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-solution.php';

$essais = 0; $ko = 0;
function verifier( $nom, $attendu, $obtenu ) {
	global $essais, $ko;
	$essais++;
	if ( $attendu !== $obtenu ) { $ko++; echo "ECHEC $nom : attendu ", var_export($attendu,true), " obtenu ", var_export($obtenu,true), "\n"; }
}

// 1. dix caracteres ne suffisent plus
$q = array( 'mode' => 'solution', 'explanation' => 'x' );
verifier( 'dix caracteres refuses', 'too_short', Secura_Solution::evaluate( $q, 'abcdefghij' )['etat'] );
verifier( 'phrase creuse refusee', 'too_short', Secura_Solution::evaluate( $q, 'je ne sais pas du tout quoi repondre ici' )['etat'] );

// 2. redaction serieuse, sans grille -> auto-evaluation
$long = "Alice peut utiliser le mot de passe pour dechiffrer le TGT capture, puis la cle du TGT pour dechiffrer les tickets de service, et enfin la cle de session pour lire le courrier de Bob.";
verifier( 'sans grille -> a_confirmer', 'a_confirmer', Secura_Solution::evaluate( $q, $long )['etat'] );

// 3. avec grille : concepts trouves / manquants
$qg = array( 'mode' => 'solution', 'grading' => array(
	'min' => 2,
	'concepts' => array(
		array( 'nom' => 'TGT', 'answers' => array( 'TGT', 'ticket granting ticket' ) ),
		array( 'nom' => 'ticket de service', 'answers' => array( 'ticket de service', 'service ticket' ) ),
		array( 'nom' => 'cle de session', 'answers' => array( 'cle de session', 'session key' ) ),
	),
) );
$r = Secura_Solution::evaluate( $qg, $long );
verifier( 'grille -> correct', 'correct', $r['etat'] );
verifier( 'grille -> 3 concepts', 3, count( $r['concepts'] ) );

$faible = "Je pense que Alice peut lire les messages de Bob parce que le mot de passe suffit toujours dans ce genre de systeme.";
$r2 = Secura_Solution::evaluate( $qg, $faible );
verifier( 'grille -> incorrect sans concepts', 'incorrect', $r2['etat'] );

// 4. mot court : pas de faux positif de sous-chaine
$q3 = array( 'grading' => array( 'min' => 1, 'concepts' => array( array( 'nom' => 'ICS', 'answers' => array( 'ics' ) ) ) ) );
$r3 = Secura_Solution::evaluate( $q3, "Le systeme utilise des bibliotheques graphiques pour afficher les courbes de temperature du serveur." );
verifier( 'ICS ne matche pas graphiques', 'incorrect', $r3['etat'] );

// 5. accents et casse ignores
$r4 = Secura_Solution::evaluate( array( 'grading' => array( 'min'=>1, 'concepts'=>array(array('nom'=>'confidentialite','answers'=>array('confidentialité'))) ) ), "La confidentialite des donnees est la premiere propriete de la triade, avec l'integrite et la disponibilite." );
verifier( 'accents ignores', 'correct', $r4['etat'] );

echo "RESULTAT : $essais essai(s), $ko echec(s)\n";
exit( $ko > 0 ? 1 : 0 );
