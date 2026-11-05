<?php
/**
 * Configure les 2 rooms manquantes avec un lab Docker.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( "À exécuter avec wp eval-file.\n" );
}

$mapping = array(
	'cryptographie-cle-chiffrement-signature' => array('image' => 'vulnerables/web-dvwa', 'driver' => 'docker', 'mode' => 'single'),
	'le-fichier-quon-naurait-pas-du-laisser'  => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
);

foreach ( $mapping as $slug => $lab ) {
	$room = get_page_by_path( $slug, OBJECT, SECURA_POST_TYPE );
	if ( ! $room ) {
		echo "⚠️  Room non trouvée : $slug\n";
		continue;
	}

	update_post_meta( $room->ID, '_secura_lab', array(
		'enabled'  => true,
		'driver'   => $lab['driver'],
		'mode'     => $lab['mode'],
		'image'    => $lab['image'],
		'network'  => 'seca_lab',
	) );

	echo "✅ Room {$room->ID} ({$slug}) => lab {$lab['image']}\n";
}

echo "Terminé.\n";
