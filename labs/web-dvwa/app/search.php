<?php
/**
 * Recherche patient.
 *
 * Vulnérabilité intentionnelle : la saisie de l'utilisateur est renvoyée
 * telle quelle dans la page (absence d'échappement). C'est le point d'entrée
 * du scénario « la page qui se trahit ».
 */
$q = isset( $_GET['q'] ) ? $_GET['q'] : '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Intranet — Recherche</title>
</head>
<body>
	<h1>Recherche patient</h1>
	<form method="get" action="search.php">
		<p><label>Nom ou numéro <input type="text" name="q" value="<?php echo htmlspecialchars( $q ); ?>"></label></p>
		<p><button type="submit">Rechercher</button></p>
	</form>

	<?php if ( '' !== $q ) : ?>
		<h2>Résultats pour « <?php echo $q; ?> »</h2>
		<p>Aucun dossier ne correspond à votre recherche.</p>
	<?php endif; ?>

	<p><a href="index.php">Retour au portail</a></p>
</body>
</html>
