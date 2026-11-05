<?php
/**
 * Page reservee a la connexion securisee.
 *
 * Le scenario « le certificat qui ne prouve rien » consiste a ouvrir la
 * connexion en TLS et a lire cette page : en HTTP simple, elle n'existe pas.
 */
if ( ! isset( $_SERVER['HTTPS'] ) || 'on' !== $_SERVER['HTTPS'] ) {
	header( 'HTTP/1.1 404 Not Found' );
	echo "Page introuvable.\n";
	exit;
}

header( 'Content-Type: text/plain; charset=utf-8' );
echo "Registre des cles de distribution\n";
echo "cle_habilitee = FLAG=SECURA{tls_not_proof}\n";
