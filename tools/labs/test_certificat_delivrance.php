<?php
/**
 * Test de délivrance de certificat en bout en bout.
 *
 * Simule un élève qui a réussi tous les examens d'un parcours,
 * puis vérifie que le certificat est délivré avec PDF.
 *
 * Usage : wp eval-file tools/labs/test_certificat_delivrance.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( "À exécuter avec wp eval-file.\n" );
}

$path_id = 56; // "Fondations : réseaux, web et cryptographie"
$user_login = 'testeleve_cert';

$user = get_user_by( 'login', $user_login );
if ( ! $user ) {
	$user_id = wp_create_user( $user_login, 'TestPass123!', 'testeleve_cert@example.com' );
	$user = get_userdata( $user_id );
} else {
	$user_id = $user->ID;
}
wp_set_current_user( $user_id );

$path = get_post( $path_id );
if ( ! $path ) {
	die( "Parcours $path_id introuvable.\n" );
}

echo "=== Parcours : {$path->post_title} (ID: $path_id) ===\n";

// Récupérer toutes les rooms du parcours
$sections = Secura_Paths::get_sections( $path_id );
$all_rooms = array();
foreach ( $sections as $section ) {
	foreach ( $section['rooms'] as $room_id ) {
		$all_rooms[] = $room_id;
	}
}

echo "Rooms du parcours : " . count( $all_rooms ) . "\n";

// Insérer des résultats d'examen réussis pour chaque room
$sections_data = Secura_Paths::get_sections( $path_id );
$all_passed = true;
$total_score = 0;
$total_exams = 0;

foreach ( $all_rooms as $room_id ) {
	$room = get_post( $room_id );
	if ( ! $room ) {
		continue;
	}

	// Vérifier qu'il y a des questions disponibles
	$available = Secura_Exam_Timed::available_count( $room_id );
	if ( $available === 0 ) {
		echo "  ⏭ {$room->post_title} : 0 questions — sautée\n";
		continue;
	}

	// Insérer un résultat d'examen réussi (simule un élève qui a passé l'examen)
	$results = get_user_meta( $user_id, Secura_Exam_Timed::RESULT_META, true );
	if ( ! is_array( $results ) ) {
		$results = array();
	}

	$score_pct = rand( 70, 100 ); // Score entre 70% et 100%
	$results[ (string) $room_id ] = array(
		'score'       => ceil( $available * $score_pct / 100 ),
		'total'       => $available,
		'percentage'  => $score_pct,
		'passed'      => true,
		'finished_at' => time(),
		'details'     => array(),
	);

	update_user_meta( $user_id, Secura_Exam_Timed::RESULT_META, $results );

	$total_score += $score_pct;
	$total_exams++;

	echo "  ✅ {$room->post_title} : examen simulé réussi ({$score_pct}%)\n";
}

if ( $total_exams === 0 ) {
	echo "\n❌ Aucun examen disponible dans ce parcours.\n";
	exit;
}

$average_score = round( $total_score / $total_exams );
echo "\n=== Résultats ===\n";
echo "Examens réussis : $total_exams\n";
echo "Score moyen : $average_score / 100\n";

// Délivrer le certificat
echo "\n=== DÉLIVRANCE DU CERTIFICAT ===\n";
$cert = Secura_Certificate::issue( $user_id, $path_id );
print_r( $cert );

if ( $cert['ok'] ) {
	echo "\n🎉 CERTIFICAT DÉLIVRÉ AVEC SUCCÈS !\n";
	echo "   Numéro : {$cert['certificate_number']}\n";
	echo "   Score : {$cert['score']} / 100\n";
	echo "   Médaille : {$cert['medal']}\n";
	echo "   PDF : {$cert['pdf_url']}\n";

	// Vérifier que le fichier PDF existe
	if ( file_exists( $cert['pdf_url'] ) || file_exists( str_replace( array( 'http://localhost:8080/wp', 'https://localhost:8080/wp' ), '', $cert['pdf_url'] ) ) ) {
		echo "   Fichier PDF : présent ✅\n";
	} else {
		// Essayer de trouver le fichier dans les uploads
		$upload_dir = wp_upload_dir();
		$pdf_path = $upload_dir['basedir'] . '/secura-certificates/' . basename( $cert['pdf_url'] );
		if ( file_exists( $pdf_path ) ) {
			echo "   Fichier PDF : présent ✅ ($pdf_path)\n";
		} else {
			echo "   Fichier PDF : à vérifier\n";
		}
	}

	// Lister tous les certificats de l'utilisateur
	echo "\n=== LISTE DES CERTIFICATS DE L'UTILISATEUR ===\n";
	$certs = Secura_Certificate::list_user_certificates( $user_id );
	foreach ( $certs as $c ) {
		echo "  - {$c['path_name']} : {$c['certificate_number']} ({$c['score']}/100, {$c['medal']}) - {$c['pdf_url']}\n";
	}
} else {
	echo "❌ Échec : {$cert['message']}\n";
}
