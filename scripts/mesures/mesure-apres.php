<?php
/**
 * Mesure "apres separation" : ce que voit l'eleve, ce que contient le
 * reservoir, et la repartition maison / importee.
 *
 * Regle verifiee : une question importee (elle porte une cle 'source')
 * ne doit se trouver dans AUCUNE tache : elle vit dans la reserve, qui
 * alimente le reservoir des epreuves de la section.
 */
$seca_wp = getenv( 'SECA_WP_DIR' ) ? getenv( 'SECA_WP_DIR' ) : '/home/user/wp';
require_once $seca_wp . '/wp-load.php';

$rooms = get_posts( array( 'post_type' => 'secura_room', 'numberposts' => -1, 'post_status' => 'publish' ) );

$maison     = 0;
$reserve    = 0;
$dans_tache = 0;
$test_servi = array();
$pool       = array();
$lignes     = array();

foreach ( $rooms as $room ) {
	$taches = Secura_Rooms::get_tasks( $room->ID );
	$res    = Secura_Rooms::reserve( $room->ID );

	$reserve += count( $res );
	$maison  += 0;

	foreach ( $taches as $index => $tache ) {
		foreach ( $tache['questions'] as $question ) {
			if ( ! empty( $question['source'] ) ) {
				$dans_tache++;
			} else {
				$maison++;
			}
		}

		if ( in_array( $tache['type'], array( 'test', 'exam' ), true ) ) {
			$pool[ $room->post_name . '#' . $tache['type'] ] = Secura_Exam::pool_size( $room->ID, $index );
		}
	}
}

/* La copie servie : on la mesure avec un eleve fictif dont on vide le
   cache des copies (sinon on relit une copie ancienne). */
$user = get_users( array( 'number' => 1, 'fields' => array( 'ID' ) ) );
$user_id = $user ? (int) $user[0]->ID : 0;

foreach ( $rooms as $room ) {
	$taches = Secura_Rooms::get_tasks( $room->ID );

	foreach ( $taches as $index => $tache ) {
		if ( 'test' !== $tache['type'] ) {
			continue;
		}

		$paper = Secura_Exam::paper( $user_id, $room->ID, $index, $tache );
		$test_servi[] = count( $paper );
	}
}

sort( $test_servi );
$mediane = $test_servi ? $test_servi[ (int) floor( count( $test_servi ) / 2 ) ] : 0;

echo "rooms mesurees            : " . count( $rooms ) . "\n";
echo "questions maison (taches) : $maison\n";
echo "questions importees (reserve) : $reserve\n";
echo "questions importees trouvees DANS une tache : $dans_tache\n";
echo "total des questions de la plateforme : " . ( $maison + $reserve ) . "\n";
echo "copie servie du test : mediane $mediane / max " . max( $test_servi ) . " / min " . min( $test_servi ) . "\n";
echo "reservoir max : " . max( $pool ) . "\n";
