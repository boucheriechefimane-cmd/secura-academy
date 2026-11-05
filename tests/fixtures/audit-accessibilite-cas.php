<?php
/** WordPress minimal pour lancer l'auditeur sur une page HTML contrôlée. */
define( 'ABSPATH', __DIR__ . '/' );

function home_url( $chemin ) {
	return 'https://exemple.test' . $chemin;
}
function get_posts( $arguments ) {
	return array();
}
function wp_remote_get( $url, $arguments ) {
	$html = '<html lang="fr" dir="ltr"><body><a href="#contenu">skip</a><h1>Accueil</h1>';
	for ( $i = 0; $i < 106; $i++ ) {
		$html .= '<button aria-label="Commande ' . $i . '"><svg></svg></button>';
	}
	$html .= '<a aria-labelledby="libelle"><svg></svg></a><span id="libelle">Lien</span>';
	$html .= '<button id="commande-muette"><svg></svg></button></body></html>';
	return array( 'body' => $html );
}
function is_wp_error( $valeur ) {
	return false;
}
function wp_remote_retrieve_body( $reponse ) {
	return $reponse['body'];
}
function wp_strip_all_tags( $texte ) {
	return strip_tags( $texte );
}
function wp_mkdir_p( $dossier ) {
	return mkdir( $dossier, 0777, true );
}
function wp_json_encode( $valeur, $options = 0 ) {
	return json_encode( $valeur, $options );
}

require $argv[1];
