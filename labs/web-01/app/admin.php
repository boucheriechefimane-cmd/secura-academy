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
	<meta charset="utf-8">
	<title>Intranet — Administration</title>
</head>
<body>
	<h1>Administration</h1>
	<p>Connecté en tant que <strong><?php echo htmlspecialchars( $_SESSION['user'] ); ?></strong>.</p>
	<p>Consultation des dossiers patients : <em>désactivée en maintenance</em>.</p>
	<p>Le journal d'audit est disponible sur le serveur, dans <code>/root/</code>.</p>
</body>
</html>
