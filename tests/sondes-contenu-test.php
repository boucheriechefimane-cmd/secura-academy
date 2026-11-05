<?php
/**
 * Contrôle ciblé des sondes de contenu avec un WordPress simulé.
 * Exécution : php tests/sondes-contenu-test.php
 */

define( 'ABSPATH', '/tmp/' );
define( 'SECURA_POST_TYPE', 'secura_room' );
define( 'SECURA_PATH_POST_TYPE', 'secura_path' );

function get_posts( $args ) {
	if ( SECURA_PATH_POST_TYPE === $args['post_type'] ) {
		return array( (object) array( 'ID' => 99, 'post_name' => 'parcours', 'post_title' => 'Parcours' ) );
	}
	return array(
		(object) array( 'ID' => 1, 'post_name' => 'avec-examen', 'post_title' => 'Examen', 'post_content' => 'Creative Commons youtube.com secura-terminal' ),
		(object) array( 'ID' => 2, 'post_name' => 'sans-examen', 'post_title' => 'Pratique', 'post_content' => 'Texte de leçon' ),
		(object) array( 'ID' => 3, 'post_name' => 'reserve-seule', 'post_title' => 'Réserve', 'post_content' => '' ),
	);
}
function wp_json_encode( $data, $flags ) { return json_encode( $data, $flags ); }
function wp_strip_all_tags( $text ) { return strip_tags( $text ); }

final class Secura_Rooms {
	public static function get_tasks( $id ) {
		if ( 1 === $id ) {
			return array( array( 'type' => 'exam', 'questions' => array( array( 'mode' => 'choice', 'question' => 'What is the key?', 'hint' => 'Indice', 'explanation' => 'Explication' ) ) ) );
		}
		if ( 2 === $id ) {
			return array( array( 'type' => 'practice', 'questions' => array( array( 'mode' => 'text', 'question' => '¿Cuál es la clave?' ) ) ) );
		}
		return array();
	}
	public static function reserve( $id ) {
		return 3 === $id ? array( array( 'mode' => 'solution', 'question' => 'Find the answer', 'licence' => 'CC BY', 'source' => 'Exemple' ) ) : array();
	}
	public static function get_difficulty( $id ) { return 'facile'; }
}
final class Secura_Paths {
	public static function get_sections( $id ) {
		return array( array( 'rooms' => array( 1, 3 ) ), array( 'rooms' => array( 2 ) ) );
	}
}

$passed = 0;
$failed = 0;
function verifier_sonde( $condition, $message ) {
	global $passed, $failed;
	if ( $condition ) {
		$passed++;
		echo "  ok   $message\n";
	} else {
		$failed++;
		echo "  ECHEC $message\n";
	}
}
function executer_sonde( $file ) {
	ob_start();
	require __DIR__ . '/../scripts/audit/' . $file;
	return json_decode( ob_get_clean(), true );
}

$mesure = executer_sonde( 'mesure-contenu.php' );
verifier_sonde( is_array( $mesure ), 'la sonde mesure renvoie du JSON' );
verifier_sonde( 3 === $mesure['totaux']['rooms'] && 1 === $mesure['totaux']['parcours'], 'inventaire des rooms et parcours' );
verifier_sonde( true === $mesure['rooms'][0]['examen'], 'une tâche exam est détectée' );
verifier_sonde( false === $mesure['rooms'][1]['examen'] && false === $mesure['rooms'][2]['examen'], 'une réserve vide ou seule ne crée pas une tâche exam' );
verifier_sonde( 2 === $mesure['totaux']['rooms_sans_examen'], 'le nombre de rooms sans tâche exam est calculé' );
verifier_sonde( 1 === $mesure['totaux']['reserve'], 'la réserve est comptée séparément' );
verifier_sonde( array_key_exists( 'examens_chronometres', $mesure['totaux'] ) && null === $mesure['totaux']['examens_chronometres'] && null === $mesure['rooms'][0]['examen_chronometre'], 'les examens chronométrés non mesurés ne sont pas annoncés à zéro' );
verifier_sonde( 1 === $mesure['totaux']['questions_sans_indice_anglais'] && ! isset( $mesure['totaux']['questions_francais'] ), 'absence de marqueur anglais ne signifie pas français' );
verifier_sonde( 2 === $mesure['parcours_list'][0]['sections'] && 3 === $mesure['parcours_list'][0]['rooms'], 'les sections et leurs rooms sont dénombrées' );

$probe = executer_sonde( 'probe-contenu.php' );
verifier_sonde( is_array( $probe ) && 3 === count( $probe['rooms'] ), 'la sonde brute renvoie du JSON et trois rooms' );
verifier_sonde( array( 1, 3, 2 ) === $probe['parcours'][0]['rooms'], 'la sonde lit les sections réelles dans leur ordre' );
verifier_sonde( 1 === $probe['rooms'][2]['reserve'], 'la sonde brute inclut la réserve' );

echo "\nRésultat : $passed réussi(s), $failed échec(s).\n";
exit( $failed ? 1 : 0 );
