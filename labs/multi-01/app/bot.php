<?php
/**
 * Robot de supervision de l'administrateur.
 *
 * Il visite une page comme le ferait un navigateur, mais il ne comprend
 * pas le JavaScript : il repère la présence d'un script et enregistre ce
 * que ce script aurait pu voler, c'est-à-dire le jeton de session de
 * l'administrateur. C'est le point d'entrée du scénario « la page qui se
 * trahit ».
 *
 * Usage : /bot.php?url=http://127.0.0.1:8080/search.php?q=<charge utile>
 */
$url = isset( $_GET['url'] ) ? $_GET['url'] : '';

$jeton = '';

if ( preg_match( '/admin_token\s*=\s*([^\s]+)/', (string) @file_get_contents( '/srv/app/app.conf' ), $m ) ) {
	$jeton = trim( $m[1] );
}

$vol = false;

if ( '' !== $url ) {
	$contenu = (string) @file_get_contents( $url );

	if ( false !== stripos( $contenu, '<script' ) ) {
		$vol = true;
	}
}

$fichier = '/var/log/app/stolen.txt';

if ( $vol && '' !== $jeton ) {
	file_put_contents( $fichier, $jeton . "\n" );
}

header( 'Content-Type: text/plain; charset=utf-8' );

echo 'Robot de supervision : ' . ( $vol ? 'une page contient un script — jeton administrateur enregistré dans /var/log/app/stolen.txt' : 'aucun script détecté' ) . "\n";
