<?php
/**
 * Portail de connexion de l'application « Intranet ».
 *
 * Vulnérabilité intentionnelle (laboratoire pédagogique) : la requête SQL
 * est construite par concaténation. C'est le point d'entrée du scénario
 * « la requête qui ne se fie à personne ».
 */
session_start();

$message = '';
$connecte = false;

if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
	$user = isset( $_POST['username'] ) ? $_POST['username'] : '';
	$pass = isset( $_POST['password'] ) ? $_POST['password'] : '';

	// VULNÉRABILITÉ VOLONTAIRE : concaténation au lieu d'une requête préparée.
	$query = "SELECT id, username, role FROM users WHERE username = '" . $user . "' AND password = '" . $pass . "'";

	$db     = new SQLite3( '/var/www/html/db.sqlite' );
	$result = $db->querySingle( $query );

	if ( false !== $result && null !== $result ) {
		$_SESSION['user'] = $result;
		$connecte         = true;
		$message          = 'Connecté. Redirection…';
	} else {
		$message = 'Identifiants invalides.';
	}
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Intranet — Espace clinicians</title>
</head>
<body>
	<h1>Intranet — Espace clinicians</h1>
	<p>Connectez-vous avec votre compte professionnel.</p>

	<?php if ( $message ) : ?>
		<p><strong><?php echo htmlspecialchars( $message ); ?></strong></p>
	<?php endif; ?>

	<?php if ( $connecte ) : ?>
		<p><a href="admin.php">Aller à l'espace administrateur</a></p>
	<?php else : ?>
		<form method="post" action="index.php">
			<p><label>Identifiant <input type="text" name="username" autocomplete="off"></label></p>
			<p><label>Mot de passe <input type="password" name="password"></label></p>
			<p><button type="submit">Se connecter</button></p>
		</form>
	<?php endif; ?>

	<p>
		<a href="search.php?q=patient">Recherche patient</a> ·
		<a href="status.php">État du service</a> ·
		<a href="download.php?file=notes.txt">Documentation</a> ·
		<a href="robots.txt">robots.txt</a>
	</p>
</body>
</html>
