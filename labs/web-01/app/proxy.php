<?php
/**
 * Outil de supervision : « superviseur-interne ».
 *
 * L'outil va chercher une page depuis un AUTRE poste du réseau et renvoie
 * la réponse. Il a été déployé par l'équipe réseau pour surveiller les
 * applications internes depuis le nœud « web ».
 *
 * Conséquence : le nœud « web » sait joindre des machines que l'attaquant
 * ne voit pas. C'est exactement le mécanisme du pivot.
 *
 * ⚠ VULNÉRABILITÉ VOLONTAIRE (laboratoire pédagogique) : aucune validation
 *   de l'URL cible.
 */
$url = isset( $_GET['url'] ) ? trim( (string) $_GET['url'] ) : '';

if ( '' === $url ) {
	header( 'Content-Type: text/plain; charset=utf-8' );
	echo "=== superviseur-interne ===\n";
	echo "Usage : /proxy.php?url=http://poste-interne:8080/\n";
	echo "Recupere une page depuis un autre poste et la renvoie telle quelle.\n";
	exit;
}

$method = isset( $_SERVER['REQUEST_METHOD'] ) ? $_SERVER['REQUEST_METHOD'] : 'GET';

$options = array(
	'http' => array(
		'method'        => $method,
		'timeout'       => 8,
		'ignore_errors' => true,
		'header'        => "User-Agent: superviseur-interne/1.0\r\nAccept: */*\r\n",
	),
);

if ( 'POST' === $method ) {
	$body = file_get_contents( 'php://input' );

	if ( false !== $body && '' !== $body ) {
		$options['http']['content'] = $body;
		$options['http']['header'] .= "Content-Type: application/x-www-form-urlencoded\r\n";
	}
}

$context = stream_context_create( $options );
$answer  = @file_get_contents( $url, false, $context );

header( 'Content-Type: text/html; charset=utf-8' );

if ( false === $answer ) {
	echo "Cible injoignable : " . htmlspecialchars( $url ) . "\n";
	exit;
}

echo $answer;
