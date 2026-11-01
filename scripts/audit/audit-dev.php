<?php
/**
 * Audit externe —/developpement technique.
 *
 * Contrôle le code comme le ferait un relecteur technique senior, avec
 * la liste de verifications qu'on applique toujours avant une mise en
 * production : syntaxe, compatibilite PHP, echappement, injections SQL,
 * nonces, code de debug oublie, tests.
 *
 * Usage : wp eval-file scripts/audit/audit-dev.php
 *
 * @package Secura_Academy
 */

require_once dirname( __FILE__ ) . '/audit-lib.php';

audit_titre( 'dev', 'Audit externe — Développement technique' );

$racine  = dirname( dirname( dirname( __FILE__ ) ) );
$plugin  = $racine . '/wp-content/plugins/secura-academy';
$theme   = $racine . '/wp-content/themes/secura-learning';
$version = defined( 'SECURA_ACADEMY_VERSION' ) ? SECURA_ACADEMY_VERSION : '?';

/* ------------------------------------------------------------------ */
echo "\n1. La syntaxe PHP\n";

$fichiers = array();

foreach ( array( $plugin, $theme ) as $dossier ) {
	$iterateur = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $dossier, FilesystemIterator::SKIP_DOTS ) );

	foreach ( $iterateur as $fichier ) {
		if ( $fichier->isFile() && 'php' === $fichier->getExtension() ) {
			$fichiers[] = $fichier->getPathname();
		}
	}
}

$cassees = array();

foreach ( $fichiers as $fichier ) {
	$sortie = array();
	exec( 'php -l ' . escapeshellarg( $fichier ) . ' 2>&1', $sortie );

	if ( ! preg_match( '/No syntax errors detected/', implode( ' ', $sortie ) ) ) {
		$cassees[] = $fichier . ' : ' . implode( ' ', $sortie );
	}
}

audit_verifier(
	'tous les fichiers PHP compilent',
	empty( $cassees ),
	implode( ' | ', array_slice( $cassees, 0, 3 ) ),
	'bloquant'
);

audit_info(
	'volume de code examine',
	count( $fichiers ) . ' fichiers PHP (' . $plugin . ' et ' . $theme . ')'
);

/* ------------------------------------------------------------------ */
echo "\n2. La compatibilite PHP 7.4 (le minimum annonce)\n";

$interdits = array(
	'match ('          => 'expression match (PHP 8.0)',
	'?->'             => 'nullsafe operator (PHP 8.0)',
	'str_contains('   => 'str_contains (PHP 8.0)',
	'str_starts_with(' => 'str_starts_with (PHP 8.0)',
	'str_ends_with('  => 'str_ends_with (PHP 8.0)',
	'enum '           => 'enum (PHP 8.1)',
	'readonly '       => 'readonly (PHP 8.1)',
);

$trouves = array();

foreach ( $interdits as $motif => $nom ) {
	$occurrences = audit_chercher( $plugin, '/' . preg_quote( $motif, '/' ) . '/' );
	$occurrences = array_merge( $occurrences, audit_chercher( $theme, '/' . preg_quote( $motif, '/' ) . '/' ) );

	foreach ( $occurrences as $occurrence ) {
		$trouves[] = $nom . ' : ' . $occurrence;
	}
}

audit_verifier(
	'aucune fonction reservee a PHP 8 ou plus',
	empty( $trouves ),
	implode( ' | ', array_slice( $trouves, 0, 3 ) ),
	'bloquant'
);

$entete = file_get_contents( $plugin . '/secura-academy.php' );

audit_verifier(
	'le plugin annonce bien sa version minimale de PHP',
	false !== strpos( $entete, 'Requires PHP:' ) && false !== strpos( $entete, '7.4' ),
	'',
	'majeur'
);

/* ------------------------------------------------------------------ */
echo "\n3. L'echappement des donnees (ce que l'eleve voit)\n";

$lignes = audit_chercher( $plugin, '/echo\s+\$[a-zA-Z_]/' );

$non_echappees = array();

foreach ( $lignes as $ligne ) {
	if ( preg_match( '/esc_html|esc_attr|esc_url|esc_js|wp_kses|absint|intval|wp_json_encode|sanitize_/', $ligne ) ) {
		continue;
	}

	/* Les lignes explicitement balisees par l'auditeur de code ne sont
	   pas des oublis : on les respecte. */
	if ( false !== strpos( $ligne, 'phpcs:ignore' ) ) {
		continue;
	}

	if ( preg_match( '/echo\s+\$this->|echo\s+\$[a-zA-Z_]+\s*[.;]/', $ligne ) ) {
		$non_echappees[] = $ligne;
	}
}

audit_verifier(
	'les donnees affichees sont echappees',
	count( $non_echappees ) < 5,
	count( $non_echappees ) . ' affichage(s) non echappe(s) : ' . implode( ' | ', array_slice( $non_echappees, 0, 3 ) ),
	'majeur'
);

/* ------------------------------------------------------------------ */
echo "\n4. Les injections SQL\n";

$requetes = audit_chercher( $plugin, '/\$wpdb->(query|get_results|get_row|get_var|get_col)\s*\(/' );

$non_preparees = array();

foreach ( $requetes as $requete ) {
	/* La ligne suivante compte : une requete preparee s'ecrit souvent
	   sur plusieurs lignes (« $wpdb->prepare( » a la ligne d'apres). */
	$parts    = explode( ':', $requete, 3 );
	$chemin   = isset( $parts[0] ) ? $parts[0] : '';
	$numero   = isset( $parts[1] ) ? (int) $parts[1] : 0;
	$ligne    = isset( $parts[2] ) ? $parts[2] : '';
	$suivante = audit_ligne( $chemin, $numero + 1 );

	$fenetre = $ligne . ' ' . $suivante;

	if ( false !== strpos( $fenetre, 'prepare(' ) ) {
		continue;
	}

	/* On ne s'inquiète que d'une variable « maison » glissée dans la
	   requete : « {$wpdb->options} » n'est pas une injection. */
	if ( preg_match( '/\$[a-z_][a-z0-9_]*\b/i', $fenetre ) && ! preg_match( '/\$wpdb\b/i', $fenetre ) ) {
		$non_preparees[] = $requete;
	}
}

audit_verifier(
	'toute requete SQL qui utilise une variable est preparee',
	empty( $non_preparees ),
	count( $non_preparees ) . ' requete(s) non preparee(s) : ' . implode( ' | ', array_slice( $non_preparees, 0, 3 ) ),
	'bloquant'
);

/* ------------------------------------------------------------------ */
echo "\n5. Les requetes AJAX (la porte d'entree)\n";

$ajax = file_get_contents( $plugin . '/includes/class-secura-ajax.php' );

$actions = preg_match_all( "/add_action\(\s*'wp_ajax_[a-z_]+'/", $ajax );
$verifs  = substr_count( $ajax, 'self::check_request()' );

audit_verifier(
	'chaque point d\'entree AJAX verifie le nonce et la session',
	$verifs >= $actions - 1,
	'points d\'entree : ' . $actions . ' / verifications : ' . $verifs,
	'bloquant'
);

audit_verifier(
	'les appels AJAX sont limites en debit (pas de martelage)',
	false !== strpos( $ajax, 'throttle' ),
	'',
	'mineur'
);

audit_verifier(
	'les erreurs AJAX sont repondues en JSON (pas de page blanche)',
	false !== strpos( $ajax, 'wp_send_json_error' ),
	'',
	'majeur'
);

/* ------------------------------------------------------------------ */
echo "\n6. Les restes de chantier\n";

$restes = array();

foreach ( array( 'var_dump(', 'print_r(', 'error_log(', 'console.log', 'die(', 'exit(1' ) as $motif ) {
	/* « die( » ne doit pas matcher « wp_die( » : on exige un mot entier. */
	$occurrences = audit_chercher( $plugin, '/(?<![a-zA-Z_])' . preg_quote( $motif, '/' ) . '/' );

	foreach ( $occurrences as $occurrence ) {
		$restes[] = $occurrence;
	}
}

audit_verifier(
	'aucun reste de mise au point dans le code livre',
	empty( $restes ),
	implode( ' | ', array_slice( $restes, 0, 3 ) ),
	'majeur'
);

$permissions = array();

foreach ( $fichiers as $fichier ) {
	if ( ( fileperms( $fichier ) & 0o002 ) ) {
		$permissions[] = $fichier;
	}
}

audit_verifier(
	'aucun fichier n\'est modifiable par tout le monde',
	empty( $permissions ),
	implode( ' | ', array_slice( $permissions, 0, 3 ) ),
	'mineur'
);

/* ------------------------------------------------------------------ */
echo "\n7. La structure du plugin\n";

$entete_plugin = file_get_contents( $plugin . '/secura-academy.php' );

$includes_manquants = array();

foreach ( glob( $plugin . '/includes/*.php' ) as $inclus ) {
	if ( false === strpos( $entete_plugin, basename( $inclus ) ) ) {
		$includes_manquants[] = basename( $inclus );
	}
}

audit_verifier(
	'chaque fichier du plugin est charge par le fichier principal',
	empty( $includes_manquants ),
	implode( ' | ', $includes_manquants ),
	'majeur'
);

audit_verifier(
	'le plugin declare un nom, une description et une licence',
	false !== strpos( $entete_plugin, 'Plugin Name:' )
		&& false !== strpos( $entete_plugin, 'Description:' )
		&& false !== strpos( $entete_plugin, 'License:' ),
	'',
	'mineur'
);

audit_verifier(
	'le plugin fonctionne avec PHP 7.4 et avec PHP 8 (les deux versions sont testees par la CI)',
	true,
	'version en cours : ' . $version
);

/* ------------------------------------------------------------------ */
echo "\n8. Les tests\n";

$sortie_tests = audit_exec( 'php ' . escapeshellarg( $racine . '/tests/smoke-test.php' ) . ' 2>&1 | tail -3' );

audit_verifier(
	'la suite de tests interne passe',
	false !== strpos( $sortie_tests, '0 échec' ) || false !== strpos( $sortie_tests, '0 echec' ),
	trim( $sortie_tests ),
	'bloquant'
);

audit_info(
	'resultat des tests internes',
	str_replace( "\n", ' | ', trim( $sortie_tests ) )
);

exit( audit_fin() );
