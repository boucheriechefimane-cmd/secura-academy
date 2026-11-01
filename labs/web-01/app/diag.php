<?php
/**
 * Page de diagnostic de l'application Intranet.
 *
 * Fait partie du lab : elle affiche la configuration interne du poste.
 * C'est ce que le scénario « Traverser le mur » utilise — le compte de
 * service de l'application est réutilisé sur le nœud interne.
 */
header( 'Content-Type: text/plain; charset=utf-8' );

$config = '/srv/app/app.conf';

echo "=== Diagnostic Intranet ===\n";
echo "app_name : Intranet\n";
echo "version  : 2.4.1\n";

if ( is_readable( $config ) ) {
	echo "--- /srv/app/app.conf ---\n";
	echo file_get_contents( $config );
} else {
	echo "--- configuration inaccessible ---\n";
}

echo "--- fin ---\n";
