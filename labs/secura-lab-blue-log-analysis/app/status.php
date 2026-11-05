<?php
/**
 * Page d'état du service (triage).
 */
header( 'Content-Type: text/plain; charset=utf-8' );

echo "Intranet — état du service\n";
echo "version : 2.4.1\n";
echo "socle   : php " . PHP_VERSION . " / apache\n";
echo "base    : sqlite3 (/var/www/html/db.sqlite)\n";
echo "journal : /var/log/app/access.log\n";
echo "config  : /srv/app/app.conf\n";
