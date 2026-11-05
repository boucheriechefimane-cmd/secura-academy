<?php
/**
 * Téléchargement de documents.
 *
 * Vulnérabilité intentionnelle : le nom de fichier fourni n'est pas
 * vérifié, ce qui permet de lire n'importe quel fichier du serveur.
 * C'est le point d'entrée du scénario « le fichier qu'on n'aurait pas dû
 * laisser ».
 */
$file = isset( $_GET['file'] ) ? $_GET['file'] : '';

if ( '' === $file ) {
	echo "Précisez un fichier (par exemple ?file=notes.txt).\n";
	exit;
}

$chemin = '/var/www/html/' . $file;

if ( ! file_exists( $chemin ) || ! is_file( $chemin ) ) {
	header( 'HTTP/1.1 404 Not Found' );
	echo "Fichier introuvable.\n";
	exit;
}

header( 'Content-Type: text/plain; charset=utf-8' );
readfile( $chemin );
