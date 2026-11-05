<?php
/** Lance un audit minimal dans un processus séparé pour tester son exit(). */
define( 'ABSPATH', __DIR__ . '/' );

function wp_mkdir_p( $dossier ) {
	return mkdir( $dossier, 0777, true );
}

function wp_json_encode( $valeur, $options = 0 ) {
	return json_encode( $valeur, $options );
}

require_once dirname( __DIR__, 2 ) . '/scripts/audit/audit-lib.php';

audit_titre( 'test-harnais', 'Test du harnais' );
$cas = isset( $argv[1] ) ? $argv[1] : '';
$dossier = isset( $argv[2] ) ? $argv[2] : '';

switch ( $cas ) {
	case 'aucun':
		audit_verifier( 'Réussite', true );
		break;
	case 'majeur-sans-preuve':
		audit_verifier( 'Échec <majeur>', false, 'Détail <test>', 'majeur', " \t\n" );
		break;
	case 'bloquant-sans-preuve':
		audit_verifier( 'Échec bloquant', false, '', 'bloquant' );
		break;
	case 'mineur-sans-preuve':
		audit_verifier( 'Échec mineur', false, '', 'mineur' );
		break;
	case 'info-sans-preuve':
		audit_verifier( 'Échec info', false, '', 'info' );
		break;
	case 'majeur-etaye':
		audit_verifier( 'Constat majeur', false, '', 'majeur', 'Mesure réelle' );
		break;
	case 'bloquant-etaye':
		audit_verifier( 'Constat bloquant', false, '', 'bloquant', 'Mesure réelle' );
		break;
	case 'mixte':
		audit_verifier( 'Constat mineur', false, '', 'mineur', 'Mesure réelle' );
		audit_verifier( 'Échec majeur', false, '', 'majeur' );
		break;
	default:
		fwrite( STDERR, "Cas inconnu\n" );
		exit( 2 );
}

audit_fin( $dossier );
