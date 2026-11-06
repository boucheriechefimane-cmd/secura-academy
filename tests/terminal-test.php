<?php
/**
 * Le terminal d'entrainement ne doit pas mentir a l'eleve.
 *
 * CE QUI ETAIT CASSE (mesure du 6 novembre 2026)
 * ----------------------------------------------
 * Le terminal simulé etait strictement lineaire : il ne comparait la
 * commande qu'a l'etape courante. Un eleve qui tapait `ls` en premier —
 * le geste le plus naturel du monde — recevait « commande introuvable »,
 * alors que `ls` existe evidemment sur une machine Linux. Pire : taper
 * `cat app.conf` avant `curl status.php` renvoyait la meme chose, alors
 * que le fichier existe. L'eleve apprenait un faux fait sur la machine.
 *
 * Ce que ce test exige :
 *   1. une commande d'une AUTRE etape est reconnue, et son resultat est
 *      affiche ;
 *   2. une commande vraiment inconnue recoit une reponse honnete, qui dit
 *      ce que l'atelier accepte — pas un mensonge ;
 *   3. `ls` n'est jamais declare introuvable.
 *
 * Usage : php tests/terminal-test.php
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', '/' );
}

/* Doublures minimales : ce test n'a pas besoin de WordPress. */
$GLOBALS['faux_meta'] = array();

if ( ! function_exists( 'get_user_meta' ) ) {
	function get_user_meta( $user_id, $key, $single = false ) {
		return isset( $GLOBALS['faux_meta'][ $key ] ) ? $GLOBALS['faux_meta'][ $key ] : '';
	}

	function update_user_meta( $user_id, $key, $value ) {
		$GLOBALS['faux_meta'][ $key ] = $value;

		return true;
	}

	function absint( $n ) {
		return abs( (int) $n );
	}

	function wp_strip_all_tags( $t ) {
		return strip_tags( (string) $t );
	}

	function __( $t, $d = '' ) {
		return $t;
	}

	define( 'SECURA_USER_TERMINALS', 'secura_terminals' );
}

require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/class-secura-terminal.php';

$ok = 0;
$ko = 0;

/**
 * Compare et compte.
 *
 * @param string $nom     Nom de l'essai.
 * @param mixed  $attendu Attendu.
 * @param mixed  $obtenu  Obtenu.
 */
function term_v( $nom, $attendu, $obtenu ) {
	global $ok, $ko;

	if ( $attendu === $obtenu ) {
		$ok++;
		return;
	}

	$ko++;
	echo "ECHEC $nom : attendu ", var_export( $attendu, true ), ' / obtenu ', var_export( $obtenu, true ), "\n";
}

/* Le scenario reel de la room « Le service qui ne repond plus ». */
$tache = array(
	'terminal' => array(
		'intro'   => 'appareil@intranet:~$ ',
		'unknown' => 'bash: commande introuvable.',
		'success' => 'Diagnostic note.',
		'steps'   => array(
			array(
				'match'  => array( 'curl -s http://localhost:8080/status.php', '/curl .*status\\.php/' ),
				'output' => 'version : 2.4.1',
				'hint'   => 'La page d\'etat indique la configuration.',
			),
			array(
				'match'  => array( 'cat /srv/app/app.conf', '/cat .*app\\.conf/' ),
				'output' => 'build_id = FLAG=SECURA{triage_patient}',
				'hint'   => 'Le fichier contient le numero de version interne.',
			),
		),
	),
);

/* --- 1. Ordre normal ------------------------------------------------ */
$r = Secura_Terminal::run( 1, 10, 0, $tache, 'curl -s http://localhost:8080/status.php' );
term_v( 'etape 1 reconnue', 1, $r['step'] );
term_v( 'etape 1 sortie', 'version : 2.4.1', $r['output'] );

/* --- 2. Ordre inverse : doit marcher aussi -------------------------- */
$GLOBALS['faux_meta'] = array();
$r = Secura_Terminal::run( 1, 10, 0, $tache, 'cat /srv/app/app.conf' );
term_v( 'commande de l etape 2 reconnue en premier', true, false !== strpos( $r['output'], 'SECURA{triage_patient}' ) );
term_v( 'commande de l etape 2 fait avancer le scenario', 2, $r['step'] );
term_v( 'commande de l etape 2 marquee comme trouvee', true, $r['matched'] );

/* --- 3. Commande vraiment inconnue : reponse honnete ---------------- */
$GLOBALS['faux_meta'] = array();
$r = Secura_Terminal::run( 1, 10, 0, $tache, 'rm -rf /' );
term_v( 'commande inconnue non validee', false, $r['matched'] );
term_v( 'la reponse dit ce que l atelier accepte', true, false !== strpos( $r['output'], 'curl -s http://localhost:8080/status.php' ) );

/* --- 4. `ls` ne doit jamais etre declare introuvable ---------------- */
$GLOBALS['faux_meta'] = array();
$r = Secura_Terminal::run( 1, 10, 0, $tache, 'ls' );
term_v( 'ls n est pas une commande inexistante', false, false !== strpos( $r['output'], 'bash: commande introuvable' ) );
term_v( 'ls recoit une piste', true, false !== strpos( $r['output'], 'Piste' ) );

/* --- 5. Une fois toutes les etapes faites, le succes est rendu ------ */
$GLOBALS['faux_meta'] = array();
Secura_Terminal::run( 1, 10, 0, $tache, 'cat /srv/app/app.conf' );
Secura_Terminal::run( 1, 10, 0, $tache, 'curl -s http://localhost:8080/status.php' );
$r = Secura_Terminal::run( 1, 10, 0, $tache, 'ls' );
term_v( 'scenario termine', true, $r['completed'] );
term_v( 'message de succes', 'Diagnostic note.', $r['output'] );

/* --- 6. Le motif litteral et le motif regex marchent tous deux ------ */
term_v( 'motif exact', true, Secura_Terminal::matches( 'cat /srv/app/app.conf', 'cat /srv/app/app.conf' ) );
term_v( 'motif regex', true, Secura_Terminal::matches( '/cat .*app\\.conf/', 'cat /srv/app/app.conf' ) );
term_v( 'motif regex ne prend pas n importe quoi', false, Secura_Terminal::matches( '/cat .*app\\.conf/', 'ls /tmp' ) );

echo "\nRESULTAT : ", $ok + $ko, " essai(s), $ko echec(s)\n";

exit( $ko > 0 ? 1 : 0 );
