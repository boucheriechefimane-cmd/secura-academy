<?php
/**
 * Test de scénario étudiant : vérifie que chaque room a un lab fonctionnel.
 * Teste : méta configurée, bouton affiché, démarrage/arrêt du lab.
 *
 * Usage : wp eval-file tools/labs/test_student_scenario.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( "À exécuter avec wp eval-file.\n" );
}

$all_rooms = get_posts(array(
	'post_type'   => SECURA_POST_TYPE,
	'post_status' => 'publish',
	'numberposts' => -1,
	'orderby'     => 'title',
	'order'       => 'ASC',
));

$results = array();
$passed = 0;
$failed = 0;

foreach ( $all_rooms as $room ) {
	$room_id = $room->ID;
	$slug    = $room->post_name;
	$title   = $room->post_title;

	$test = array(
		'id'      => $room_id,
		'slug'    => $slug,
		'titre'   => $title,
		'meta_ok' => false,
		'lab_ok'  => false,
		'start_ok'=> false,
		'stop_ok' => false,
		'erreurs' => array(),
	);

	// 1. Vérifier la méta _secura_lab
	$manifest = Secura_Lab::get_manifest( $room_id );
	if ( ! empty( $manifest['enabled'] ) && 'docker' === $manifest['driver'] && ! empty( $manifest['image'] ) ) {
		$test['meta_ok'] = true;
	} else {
		$test['erreurs'][] = "Méta lab manquante ou incomplète";
		$failed++;
		$results[] = $test;
		continue;
	}

	// 2. Vérifier que le lab peut démarrer (simulé par l'émulateur Docker)
	// On crée un utilisateur de test temporaire
	$user = get_user_by( 'login', 'testeleve_audit' );
	if ( ! $user ) {
		$user_id = wp_create_user( 'testeleve_audit', 'TestPass123!', 'testeleve_audit@example.com' );
		$user = get_userdata( $user_id );
	}
	wp_set_current_user( $user->ID );

	// Supprimer le cache Docker pour forcer une vérification réelle
	delete_transient( 'seca_docker_available' );

	$result = Secura_Lab::start( $user->ID, $room_id );

	if ( ! empty( $result['ok'] ) && 'running' === $result['state'] ) {
		$test['start_ok'] = true;
	} else {
		$test['erreurs'][] = "Démarrage échoué : " . ( $result['message'] ?? 'inconnu' );
	}

	// 3. Vérifier le statut après démarrage
	$status = Secura_Lab::status( $user->ID, $room_id );
	if ( ! empty( $status['state'] ) && 'running' === $status['state'] ) {
		$test['lab_ok'] = true;
	} else {
		$test['erreurs'][] = "Statut incorrect après démarrage : " . ( $status['state'] ?? 'inconnu' );
	}

	// 4. Arrêter le lab
	Secura_Lab::stop( $user->ID, $room_id );
	$status_after = Secura_Lab::status( $user->ID, $room_id );
	if ( 'idle' === $status_after['state'] ) {
		$test['stop_ok'] = true;
	} else {
		$test['erreurs'][] = "Arrêt échoué : état = " . ( $status_after['state'] ?? 'inconnu' );
	}

	if ( $test['meta_ok'] && $test['lab_ok'] && $test['start_ok'] && $test['stop_ok'] ) {
		$passed++;
		echo "✅ Room $room_id ($slug) - lab OK\n";
	} else {
		$failed++;
		echo "❌ Room $room_id ($slug) - ERREURS: " . implode( ', ', $test['erreurs'] ) . "\n";
	}

	$results[] = $test;
}

echo "\n=== RÉSUMÉ DU TEST ÉTUDIANT ===\n";
echo "Rooms testées : " . count( $results ) . "\n";
echo "Réussies      : $passed\n";
echo "Échouées      : $failed\n";
echo "Taux de succès : " . ( count( $results ) > 0 ? round( $passed / count( $results ) * 100, 1 ) : 0 ) . "%\n";
