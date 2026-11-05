<?php
/**
 * Test bout en bout : examens chronométrés + certificats.
 *
 * 1. Prend un parcours existant avec ses rooms.
 * 2. Pour chaque room : démarre un examen (max 10 questions), répond correctement,
 *    soumet.
 * 3. Délivre le certificat si tous passés.
 *
 * Usage : wp eval-file tools/labs/test_certificat_bout_en_bout.php
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
	echo "Utilisateur $user_login créé (ID: $user_id)\n";
} else {
	$user_id = $user->ID;
	echo "Utilisateur $user_login existe (ID: $user_id)\n";
}

wp_set_current_user( $user_id );

$path = get_post( $path_id );
if ( ! $path ) {
	die( "Parcours $path_id introuvable.\n" );
}

echo "=== Parcours : {$path->post_title} (ID: $path_id) ===\n";

$sections = Secura_Paths::get_sections( $path_id );
$all_rooms = array();
foreach ( $sections as $section ) {
	foreach ( $section['rooms'] as $room_id ) {
		$all_rooms[] = $room_id;
	}
}

echo "Rooms du parcours : " . count( $all_rooms ) . "\n";

$all_passed = true;
$results = array();
$rooms_tested = 0;

foreach ( $all_rooms as $room_id ) {
	$room = get_post( $room_id );
	if ( ! $room ) {
		echo "  ❌ Room $room_id introuvable\n";
		$all_passed = false;
		continue;
	}

	$available = Secura_Exam_Timed::available_count( $room_id );
	if ( $available === 0 ) {
		echo "  ⏭ Room {$room->post_title} : 0 questions — sautée\n";
		continue;
	}

	$count = min( 10, $available );
	$rooms_tested++;

	echo "  📝 Room {$room->post_title} (ID: $room_id) — $count questions sur $available\n";

	$start = Secura_Exam_Timed::start( $user_id, $room_id, $count, 30 );
	if ( ! $start['ok'] ) {
		echo "  ❌ Échec démarrage : {$start['message']}\n";
		$all_passed = false;
		continue;
	}

	$paper = $start['questions'];

	// Répondre correctement à chaque question
	foreach ( $paper as $q ) {
		$q_id = $q['id'];
		$q_data = $q['data'];

		$correct_index = isset( $q_data['correct'] ) ? (int) $q_data['correct'] : null;

		if ( 'choice' === $q_data['mode'] && is_int( $correct_index ) ) {
			$answer = $correct_index;
		} elseif ( 'text' === $q_data['mode'] ) {
			$answer = $q_data['answer'] ?? '';
		} elseif ( 'flag' === $q_data['mode'] ) {
			$answer = $q_data['flag_path'] ?? $q_data['answer'] ?? '';
		} else {
			$answer = $q_data['answer'] ?? '';
		}

		$resp = Secura_Exam_Timed::answer( $user_id, $room_id, $q_id, $answer );
		if ( ! $resp['ok'] ) {
			echo "     ⚠️  Erreur Q$q_id : " . ( $resp['message'] ?? 'inconnu' ) . "\n";
		}
	}

	$submit = Secura_Exam_Timed::submit( $user_id, $room_id );

	if ( ! $submit['ok'] ) {
		echo "  ❌ Échec soumission : {$submit['message']}\n";
		$all_passed = false;
		continue;
	}

	$passed = ! empty( $submit['passed'] );
	$results[] = array(
		'room_id'  => $room_id,
		'titre'    => $room->post_title,
		'score'    => $submit['score'],
		'total'    => $submit['total'],
		'pct'      => $submit['percentage'],
		'passed'   => $passed,
	);

	if ( $passed ) {
		echo "     ✅ Réussi : {$submit['score']}/{$submit['total']} ({$submit['percentage']}%)\n";
	} else {
		echo "     ❌ Échoué : {$submit['score']}/{$submit['total']} ({$submit['percentage']}%)\n";
		$all_passed = false;
	}
}

echo "\n=== RÉSUMÉ ($rooms_tested rooms testées) ===\n";
foreach ( $results as $r ) {
	$status = $r['passed'] ? '✅' : '❌';
	echo "  $status {$r['titre']} : {$r['score']}/{$r['total']} ({$r['pct']}%)\n";
}

if ( ! $all_passed ) {
	echo "\n❌ Tous les examens ne sont pas passés. Certificat non délivré.\n";
	exit;
}

echo "\n=== DÉLIVRANCE DU CERTIFICAT ===\n";
$cert = Secura_Certificate::issue( $user_id, $path_id );
print_r( $cert );

if ( $cert['ok'] ) {
	echo "\n🎉 CERTIFICAT DÉLIVRÉ !\n";
	echo "   Numéro : {$cert['certificate_number']}\n";
	echo "   Score : {$cert['score']} / 100\n";
	echo "   Médaille : {$cert['medal']}\n";
	echo "   PDF : {$cert['pdf_url']}\n";
} else {
	echo "❌ Échec délivrance : {$cert['message']}\n";
}
