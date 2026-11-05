<?php
/**
 * Test rapide des examens chronométrés via wp-cli.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( "À exécuter avec wp eval-file.\n" );
}

$user = get_user_by( 'login', 'testeleve' );
$user_id = $user ? $user->ID : 444;
wp_set_current_user( $user_id );

echo "=== Questions disponibles dans le réservoir (room 22) ===\n";
$count = Secura_Exam_Timed::available_count( 22 );
echo "Count: $count\n";

echo "\n=== Démarrer l'examen ===\n";
$result = Secura_Exam_Timed::start( $user_id, 22, 5, 10 );
print_r( $result );

echo "\n=== Temps restant ===\n";
echo Secura_Exam_Timed::time_remaining( $user_id, 22 ) . " secondes\n";

echo "\n=== Récupérer le papier ===\n";
$paper = Secura_Exam_Timed::get_paper( $user_id, 22 );
echo "Questions dans le papier: " . count( $paper ) . "\n";
if ( count( $paper ) > 0 ) {
	echo "Première question: " . substr( $paper[0]['data']['question'] ?? '', 0, 100 ) . "\n";
	echo "Mode: " . ( $paper[0]['data']['mode'] ?? '?' ) . "\n";
	if ( isset( $paper[0]['data']['choices'] ) ) {
		echo "Choix: " . implode( ', ', array_slice( $paper[0]['data']['choices'], 0, 3 ) ) . "\n";
	}

	// Tester la réponse à la première question (choix 0)
	$firstId = $paper[0]['id'];
	$resp = Secura_Exam_Timed::answer( $user_id, 22, $firstId, 0 );
	echo "\n=== Réponse à Q1 ===\n";
	print_r( $resp );
}

echo "\n=== Soumettre l'examen ===\n";
$submit = Secura_Exam_Timed::submit( $user_id, 22 );
print_r( $submit );

echo "\n=== Résultat stocké ===\n";
$result = Secura_Exam_Timed::get_result( $user_id, 22 );
print_r( $result );

echo "\n=== Test certificat (sans parcours complet) ===\n";
$cert = Secura_Certificate::issue( $user_id, 99999 );
print_r( $cert );
