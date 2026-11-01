<?php
/**
 * Routeur minimal pour le serveur de développement intégré à PHP.
 *
 * « php -S » ne sait pas servir les « permaliens » de WordPress : sans ce
 * routeur, une adresse comme /secura-academy/une-room/ renvoie un 404,
 * et l'audit SEO ne verrait jamais la vraie page.
 *
 * Usage :
 *   php -S 0.0.0.0:8080 -t /chemin/vers/wordpress scripts/audit/router.php
 *
 * @package Secura_Academy
 */

$chemin = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
$racine = rtrim( $_SERVER['DOCUMENT_ROOT'], '/' );

/* Les fichiers réels (CSS, images, scripts) sont servis directement. */
if ( '/' !== $chemin && file_exists( $racine . $chemin ) && ! is_dir( $racine . $chemin ) ) {
	return false;
}

/* Tout le reste va a WordPress. */
$_SERVER['SCRIPT_NAME'] = '/index.php';

require $racine . '/index.php';
