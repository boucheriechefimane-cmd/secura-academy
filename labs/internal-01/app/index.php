<?php
/**
 * Nœud interne : archivage des dossiers patients.
 *
 * Le compte de service est le même que celui utilisé sur la machine
 * « web » : c'est le message du scénario (« les mots de passe sont
 * réutilisés »).
 */
session_start();

$message = '';
$connecte = false;

if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
	$user = isset( $_POST['username'] ) ? $_POST['username'] : '';
	$pass = isset( $_POST['password'] ) ? $_POST['password'] : '';

	if ( 'admin' === $user && 'Intranet2019!' === $pass ) {
		$_SESSION['user'] = $user;
		$connecte         = true;
		$message          = 'Accès Granted.';
	} else {
		$message = 'Accès refusé.';
	}
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Archivage interne</title>
</head>
<body>
	<h1>Archivage interne</h1>
	<p>Réservé aux dossiers patients archivés.</p>

	<?php if ( $message ) : ?>
		<p><strong><?php echo htmlspecialchars( $message ); ?></strong></p>
	<?php endif; ?>

	<?php if ( $connecte ) : ?>
		<p>Dossier archivé : <code>FLAG=SECURA{pivot_accompli}</code></p>
	<?php else : ?>
		<form method="post" action="index.php">
			<p><label>Identifiant <input type="text" name="username" autocomplete="off"></label></p>
			<p><label>Mot de passe <input type="password" name="password"></label></p>
			<p><button type="submit">Ouvrir la session</button></p>
		</form>
	<?php endif; ?>
</body>
</html>
