<?php
/**
 * Page d'accueil de la machine cible.
 *
 * Vulnerabilité intentionnelle : le formulaire de connexion construit sa
 * requête SQL par concaténation. C'est le point d'entrée du lab.
 */
session_start();

$message = '';

if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
	$user = isset( $_POST['username'] ) ? $_POST['username'] : '';
	$pass = isset( $_POST['password'] ) ? $_POST['password'] : '';

	// VULNÉRABILITÉ VOLONTAIRE (laboratoire pédagogique) : concaténation.
	$query = "SELECT id, username, role FROM users WHERE username = '" . $user . "' AND password = '" . $pass . "'";

	$db = new SQLite3( '/var/www/html/db.sqlite' );
	$result = $db->querySingle( $query );

	if ( false !== $result && null !== $result ) {
		$_SESSION['user'] = $result;
		header( 'Location: /admin.php' );
		exit;
	}

	$message = 'Identifiants invalides.';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Intranet — Espace clinicians</title>
</head>
<body>
	<h1>Intranet — Espace clinicians</h1>
	<p>Connectez-vous avec votre compte professionnel.</p>

	<?php if ( $message ) : ?>
		<p><strong><?php echo htmlspecialchars( $message ); ?></strong></p>
	<?php endif; ?>

	<form method="post" action="index.php">
		<p><label>Identifiant <input type="text" name="username" autocomplete="off"></label></p>
		<p><label>Mot de passe <input type="password" name="password" autocomplete="off"></label></p>
		<p><button type="submit">Se connecter</button></p>
	</form>

	<p><a href="robots.txt">robots.txt</a></p>
</body>
</html>
