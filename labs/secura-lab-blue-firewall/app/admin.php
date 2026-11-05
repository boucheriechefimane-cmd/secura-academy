<?php
/**
 * Espace administrateur : accessible une fois la session ouverte.
 */
session_start();

if ( empty( $_SESSION['user'] ) ) {
	header( 'Location: /index.php' );
	exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Intranet — Administration</title>
</head>
<body>
	<h1>Administration</h1>
	<p>Connecté en tant que <strong><?php echo htmlspecialchars( $_SESSION['user'] ); ?></strong>.</p>
	<p>Consultation des dossiers patients : <em>désactivée en maintenance</em>.</p>
	<p>Les secrets de l'application (clés de licence, jetons de maintenance) sont conservés
		dans la table <code>secrets</code> de la base de données.</p>
	<p>Journal d'audit : <code>/var/log/app/access.log</code>.</p>
</body>
</html>
