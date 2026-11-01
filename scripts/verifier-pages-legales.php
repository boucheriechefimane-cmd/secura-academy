<?php
/**
 * Verification : les pages legales sont-elles publiees ?
 *
 * POURQUOI CE FICHIER EXISTE
 * En v0.8.1, les pages legales n'etaient creees QUE sur un vrai serveur
 * web. En ligne de commande (WP-CLI), comme dans toute la CI, elles
 * n'existaient pas : le plugin rangeait les textes dans une variable
 * globale, et WP-CLI charge WordPress dans une portee de fonction, ou
 * une variable globale n'existe pas.
 *
 * On ne peut donc pas « supposer » que l'installation a reussi : on le
 * verifie, et on echoue bruyamment si ce n'est pas le cas. C'est le
 * principe le plus simple du monde : on mesure, on ne devine pas.
 *
 * UTILISATION
 *   wp eval-file scripts/verifier-pages-legales.php
 *
 * SORTIE
 *   0 : les deux pages existent et sont publiees.
 *   1 : au moins une page est absente ou non publiee (le detail est
 *       ecrit sur la sortie standard).
 *
 * @package Secura_Academy
 */

$libelles = array(
	'politique-de-confidentialite' => 'Politique de confidentialité',
	'mentions-legales'             => 'Mentions légales',
);

$ok = true;

foreach ( $libelles as $slug => $libelle ) {
	$page = get_page_by_path( $slug );

	if ( ! $page ) {
		echo '  ' . $libelle . ' : ABSENTE' . PHP_EOL;
		$ok = false;
		continue;
	}

	if ( 'publish' !== $page->post_status ) {
		echo '  ' . $libelle . ' : statut ' . $page->post_status . ' (ID ' . $page->ID . ')' . PHP_EOL;
		$ok = false;
		continue;
	}

	echo '  ' . $libelle . ' : publiée (ID ' . $page->ID . ')' . PHP_EOL;
}

echo '  version installée : ' . (string) get_option( 'seca_version_installee', '(aucune)' ) . PHP_EOL;

exit( $ok ? 0 : 1 );
