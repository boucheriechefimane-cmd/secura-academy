<?php
/**
 * Mesure : le moteur déverrouille-t-il l'examen quand l'eleve a
 * repondu a TOUTES les questions qu'il peut repondre (toutes sauf
 * celles qui demandent la machine, qu'un eleve sans lab ne peut pas
 * avoir) ?
 *
 * C'est la question decisive : elle dit si le gonflement de la tache
 * « test » par les imports rend l'examen inaccessible, ou seulement
 * penible.
 */
$seca_wp = getenv( 'SECA_WP_DIR' ) ? getenv( 'SECA_WP_DIR' ) : '/home/user/wp';
require_once $seca_wp . '/wp-load.php';

$user    = get_users( array( 'number' => 1, 'fields' => array( 'ID' ) ) );
$user_id = $user ? (int) $user[0]->ID : 0;

$rooms = get_posts( array( 'post_type' => 'secura_room', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );

$bloques       = 0;
$deverrouilles = 0;
$lignes        = array();

foreach ( $rooms as $room ) {
	$view  = Secura_Rooms::get_room_view( $room->ID );
	$taches = $view['tasks'];

	// Index de la tache « exam ».
	$index_exam = null;
	foreach ( $taches as $i => $t ) {
		if ( 'exam' === $t['type'] ) {
			$index_exam = $i;
		}
	}

	if ( null === $index_exam || $index_exam < 1 ) {
		continue;
	}

	// La copie servie de la tache precedente (le « test »).
	$index_test = $index_exam - 1;
	$copie      = Secura_Exam::paper( $user_id, $room->ID, $index_test, $taches[ $index_test ] );

	// L'eleve repond a tout ce qu'il peut : toutes les questions
	// sauf celles qui demandent sa machine.
	$state = array( 'tasks' => array() );

	foreach ( $taches as $i => $t ) {
		$state['tasks'][ (string) $i ] = array( 'solved' => array(), 'hints' => array(), 'done' => false );
	}

	foreach ( $copie as $q_index => $question ) {
		$mode = isset( $question['mode'] ) ? $question['mode'] : 'text';

		if ( in_array( $mode, array( 'flag', 'action' ), true ) ) {
			continue; // Sans lab, l'eleve ne peut pas la repondre.
		}

		$state['tasks'][ (string) $index_test ]['solved'][ (string) $q_index ] = true;
	}

	$deverrouille = Secura_Progress::is_task_unlocked( $taches, $index_exam, $state );

	$brute = count( $taches[ $index_test ]['questions'] );
	$servi = count( $copie );

	if ( $deverrouille ) {
		$deverrouilles++;
	} else {
		$bloques++;
		$lignes[] = sprintf( 'BLOQUE  %-52s brute=%-3d servi=%-3d', substr( $room->post_name, 0, 52 ), $brute, $servi );
	}
}

foreach ( $lignes as $ligne ) {
	echo $ligne . "\n";
}

printf(
	"\n%d examen(s) deverrouille(s) | %d BLOQUE(S) apres reponse a tout ce qui est repondable sans machine.\n",
	$deverrouilles,
	$bloques
);
