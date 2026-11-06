<?php
/**
 * Verifie la commande « docker run » que le plugin construit, sans Docker.
 *
 * Un piege coute tres cher et il est invisible a la relecture : une option
 * placee APRES le nom de l'image n'est plus une option, c'est la commande
 * du conteneur. Docker cherche alors un programme nomme
 * « no-new-privileges », ne le trouve pas, et le conteneur s'arrete
 * aussitot (« is not running »). C'est exactement ce qui a casse le
 * scenario des deux apprenants le 5 novembre.
 *
 * Ce script construit la commande pour deux cas — une room ordinaire et
 * une room qui enseigne le setuid — et refuse toute option placee apres
 * l'image.
 *
 * Usage :
 *   php tools/recette-apprenants/verifier-commandes-docker.php
 *
 * Sortie 0 si les commandes sont saines, 1 sinon.
 */

define( 'ABSPATH', '/tmp/' );

/*
 * Le strict minimum de WordPress utilise par Secura_Lab. Les definir ici
 * permet de tester la vraie fonction, sans charger WordPress : ce qui est
 * verifie est donc exactement le code qui tournera en production.
 */
function absint( $v ) {
	return abs( (int) $v );
}

function sanitize_key( $v ) {
	return preg_replace( '/[^a-z0-9_\-]/', '', strtolower( (string) $v ) );
}

function get_current_user_id() {
	return 1;
}

require_once __DIR__ . '/../../wp-content/plugins/secura-academy/includes/class-secura-lab.php';

$echecs = 0;

$cas = array(
	'room ordinaire (no-new-privileges attendu)' => array( 'allow_setuid' => false ),
	'room qui enseigne le setuid (exception)'    => array( 'allow_setuid' => true ),
);

foreach ( $cas as $nom => $surcharge ) {
	$manifeste = Secura_Lab::normalize_manifest(
		array_merge(
			array(
				'enabled' => 1,
				'mode'    => 'single',
				'image'   => 'securalabs/bin-01:1.0',
				'user'    => '1000:1000',
				'command' => 'sleep infinity',
				'workdir' => '/home/ctf',
			),
			$surcharge
		)
	);

	$commande = Secura_Lab::container_command( 1, 2, $manifeste );
	$position = array_search( $manifeste['image'], $commande, true );
	$apres    = false === $position ? array() : array_slice( $commande, $position + 1 );
	$options  = array_values(
		array_filter(
			$apres,
			static function ( $mot ) {
				return 0 === strpos( $mot, '--' );
			}
		)
	);

	$setuid_demande = ! empty( $surcharge['allow_setuid'] );
	$a_lnp          = in_array( 'no-new-privileges', $commande, true );

	printf( "== %s\n%s\n", $nom, implode( ' ', $commande ) );

	// 1. L'image doit exister dans la commande.
	if ( false === $position ) {
		echo "  KO : l'image n'apparait pas dans la commande.\n\n";
		$echecs++;
		continue;
	}

	// 2. Rien d'autre qu'une commande apres l'image.
	if ( $options ) {
		echo '  KO : option(s) apres l\'image : ' . implode( ' ', $options ) . "\n\n";
		$echecs++;
	}

	// 3. Les options essentielles doivent etre la.
	foreach ( array( '--cap-drop', '--pids-limit', '--memory', '--tmpfs', '--network' ) as $option ) {
		if ( ! in_array( $option, $commande, true ) ) {
			echo "  KO : option manquante : $option\n\n";
			$echecs++;
		}
	}

	// 4. L'exception setuid doit etre exactement celle demandee.
	if ( $setuid_demande && $a_lnp ) {
		echo "  KO : la room demande le setuid mais no-new-privileges est present.\n\n";
		$echecs++;
	} elseif ( ! $setuid_demande && ! $a_lnp ) {
		echo "  KO : no-new-privileges absent alors qu'aucune exception n'est demandee.\n\n";
		$echecs++;
	} else {
		printf( "  ok : no-new-privileges %s\n\n", $a_lnp ? 'present' : 'absent (exception demandee)' );
	}
}

echo $echecs
	? "KO : $echecs probleme(s) dans la commande docker run.\n"
	: "OK : les commandes docker run sont saines.\n";

exit( $echecs ? 1 : 0 );
