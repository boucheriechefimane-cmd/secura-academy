<?php
/**
 * Sonde : combien de copies distinctes pour 20 eleves, et quel est le
 * reservoir de l'epreuve (avec ou sans questions parametriques).
 */
/* $wp est un objet global de WordPress : on ne lui vole pas son nom. */
$seca_wp = getenv( 'SECA_WP_DIR' ) ? getenv( 'SECA_WP_DIR' ) : '/home/user/wp';
require_once $seca_wp . '/wp-load.php';

$rooms = get_posts( array( 'post_type' => 'secura_room', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );

foreach ( $rooms as $room ) {
	$taches = Secura_Rooms::get_tasks( $room->ID );

	foreach ( $taches as $index => $tache ) {
		if ( 'exam' !== $tache['type'] ) {
			continue;
		}

		$pool   = Secura_Exam::pool( $room->ID, array( 'exam', 'test' ) );
		$varia  = 0;
		foreach ( $pool as $entree ) {
			if ( ! empty( $entree['question']['variants'] ) ) {
				$varia++;
			}
		}

		$epreuve = count( $tache['questions'] );

		/* Copies simulees pour 20 eleves. */
		$signatures = array();
		$contenus   = array();

		for ( $u = 1; $u <= 20; $u++ ) {
			$uid = 960000 + $u;
			$copie = Secura_Exam::paper( $uid, $room->ID, $index, $tache );

			$empreinte = '';
			$ensemble  = array();

			foreach ( $copie as $question ) {
				$empreinte .= $question['question'] . '|' . implode( '/', (array) ( isset( $question['choices'] ) ? $question['choices'] : array() ) ) . '##';
				$ensemble[] = $question['question'];
			}

			$signatures[ $u ] = md5( $empreinte );
			sort( $ensemble );
			$contenus[ $u ] = md5( implode( '##', $ensemble ) );
		}

		$distinctes = count( array_unique( $signatures ) );
		$ensembles  = count( array_unique( $contenus ) );

		if ( $distinctes < 20 || $ensembles < 20 ) {
			printf( "%-52s pool=%3d epreuve=%d parametriques=%d -> copies=%d/20 ensembles=%d/20\n", $room->post_name, count( $pool ), $epreuve, $varia, $distinctes, $ensembles );
		}
	}
}
echo "FIN\n";
