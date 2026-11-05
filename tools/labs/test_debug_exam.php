<?php
/**
 * Débogage d'un seul examen pour comprendre pourquoi le score est à 0.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( "À exécuter avec wp eval-file.\n" );
}

$user = get_user_by( 'login', 'testeleve_cert' );
$user_id = $user ? $user->ID : 446;
wp_set_current_user( $user_id );

$room_id = 4; // Penser comme un défenseur

echo "=== Démarrer l'examen sur room $room_id ===\n";
$start = Secura_Exam_Timed::start( $user_id, $room_id, 3, 30 );
if ( ! $start['ok'] ) {
	echo "Échec: {$start['message']}\n";
	exit;
}

$paper = $start['questions'];
echo "Questions: " . count( $paper ) . "\n\n";

foreach ( $paper as $i => $q ) {
	$q_data = $q['data'];
	echo "Q$i (id={$q['id']}, mode={$q_data['mode']}):\n";
	echo "  Question: " . substr( $q_data['question'] ?? '', 0, 80 ) . "\n";
	if ( 'choice' === $q_data['mode'] ) {
		echo "  Choix: " . json_encode( $q_data['choices'] ) . "\n";
		echo "  Correct index: " . ( $q_data['correct'] ?? 'NON DÉFINI' ) . "\n";
		// Répondre avec le bon index
		$correct = $q_data['correct'] ?? 0;
		$resp = Secura_Exam_Timed::answer( $user_id, $room_id, $q['id'], $correct );
		echo "  Réponse stockée: " . ( $resp['ok'] ? 'OUI' : 'NON' ) . "\n";
	} else {
		echo "  Pas un choix multiple, réponse ignorée pour ce test\n";
	}
}

echo "\n=== Soumettre ===\n";
$submit = Secura_Exam_Timed::submit( $user_id, $room_id );
print_r( $submit );

echo "\n=== Vérifier les réponses stockées ===\n";
$exams = get_user_meta( $user_id, Secura_Exam_Timed::META, true );
if ( is_array( $exams ) && isset( $exams[ (string) $room_id ]['answers'] ) ) {
	foreach ( $exams[ (string) $room_id ]['answers'] as $q_id => $ans ) {
		echo "  $q_id => " . json_encode( $ans['answer'] ) . "\n";
	}
} else {
	echo "  Aucune réponse stockée\n";
}
