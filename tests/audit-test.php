<?php
/**
 * Tests du harnais d'audit et du contrôle indicatif des noms accessibles.
 *
 * Exécution : php tests/audit-test.php
 * Les cas de sortie lancent de vrais processus PHP pour vérifier exit(),
 * ainsi que les trois formats de rapport, sans installer WordPress.
 */

define( 'ABSPATH', __DIR__ . '/' );

function wp_strip_all_tags( $texte ) {
	return strip_tags( $texte );
}

require_once dirname( __DIR__ ) . '/scripts/audit/audit-lib.php';
require_once dirname( __DIR__ ) . '/scripts/audit/lib-accessibilite.php';

$ok = 0;
$echecs = 0;

function verifier_test_audit( $condition, $libelle ) {
	global $ok, $echecs;
	if ( $condition ) {
		$ok++;
		echo '  ok   ' . $libelle . "\n";
	} else {
		$echecs++;
		echo '  FAIL ' . $libelle . "\n";
	}
}

/* Les attributs vides, data-aria-label et les commandes muettes ne doivent
   pas être considérés comme des noms. aria-labelledby est seulement vérifié
   pour sa présence : le calcul complet du nom reste un test navigateur. */
$html = <<<'HTML'
<p id="label-bouton">Ouvrir</p>
<a id="nom-aria" aria-label="Ouvrir le détail"><svg></svg></a>
<button id="nom-reference" aria-labelledby='label-bouton'><svg></svg></button>
<button id="nom-non-cite" aria-label=Fermer><svg></svg></button>
<a id="nom-title" title="Détails"><svg></svg></a>
<a id="nom-image"><img alt="Accueil" src="test.png"></a>
<a id="nom-texte">En savoir plus</a>
<a id="sans-nom"><svg></svg></a>
<button id="aria-vide" aria-label="  &nbsp; "><svg></svg></button>
<a id="faux-attribut" data-aria-label="ne compte pas"><svg></svg></a>
<a id="reference-vide" aria-labelledby=""><svg></svg></a>
HTML;
$sans_nom = audit_commandes_sans_nom( array( 'fixture' => $html ) );
verifier_test_audit( 4 === count( $sans_nom ), 'quatre commandes sans nom indiqué sont détectées' );
foreach ( array( 'sans-nom', 'aria-vide', 'faux-attribut', 'reference-vide' ) as $id ) {
	verifier_test_audit( false !== strpos( implode( "\n", $sans_nom ), 'id="' . $id . '"' ), $id . ' reste signalé' );
}
foreach ( array( 'nom-aria', 'nom-reference', 'nom-non-cite', 'nom-title', 'nom-image', 'nom-texte' ) as $id ) {
	verifier_test_audit( false === strpos( implode( "\n", $sans_nom ), 'id="' . $id . '"' ), $id . ' ne produit pas de faux positif' );
}

/* Tester les codes réels des sous-processus et la cohérence des rapports. */
$cas = array(
	'aucun' => array( 0, false, 0, 0, 'Conforme' ),
	'mineur-sans-preuve' => array( 0, false, 1, 0, 'Audit incomplet' ),
	'info-sans-preuve' => array( 0, false, 1, 0, 'Audit incomplet' ),
	'majeur-sans-preuve' => array( 1, true, 1, 0, 'Audit incomplet' ),
	'bloquant-sans-preuve' => array( 1, true, 1, 0, 'Audit incomplet' ),
	'majeur-etaye' => array( 1, true, 0, 1, 'Réserves' ),
	'bloquant-etaye' => array( 1, true, 0, 1, 'Non conforme' ),
	'mixte' => array( 1, true, 1, 1, 'Audit incomplet' ),
);

$dossier = sys_get_temp_dir() . '/secura-audit-test-' . bin2hex( random_bytes( 8 ) );
if ( ! mkdir( $dossier, 0700, true ) ) {
	fwrite( STDERR, "Impossible de créer le dossier temporaire.\n" );
	exit( 1 );
}

foreach ( $cas as $nom => $attendu ) {
	$sous_dossier = $dossier . '/' . $nom;
	$commande = escapeshellarg( PHP_BINARY ) . ' ' . escapeshellarg( __DIR__ . '/fixtures/audit-cas.php' )
		. ' ' . escapeshellarg( $nom ) . ' ' . escapeshellarg( $sous_dossier ) . ' 2>&1';
	$sortie = array();
	$code = -1;
	exec( $commande, $sortie, $code );
	verifier_test_audit( $attendu[0] === $code, $nom . ' : code de sortie ' . $attendu[0] );

	$fichiers = glob( $sous_dossier . '/test-harnais-*.json' );
	if ( 1 !== count( $fichiers ) ) {
		verifier_test_audit( false, $nom . ' : rapport JSON produit' );
		continue;
	}
	$base = substr( $fichiers[0], 0, -5 );
	$json = json_decode( file_get_contents( $base . '.json' ), true );
	$md = is_file( $base . '.md' ) ? file_get_contents( $base . '.md' ) : '';
	$html_rapport = is_file( $base . '.html' ) ? file_get_contents( $base . '.html' ) : '';
	verifier_test_audit( is_array( $json ) && $attendu[1] === $json['barriere_bloquee'], $nom . ' : barrière cohérente dans JSON' );
	verifier_test_audit( $attendu[2] === $json['non_etaye'] && $attendu[2] === count( $json['constats_non_etayes'] ), $nom . ' : échecs non étayés séparés' );
	verifier_test_audit( $attendu[3] === count( $json['constats'] ), $nom . ' : constats retenus séparés' );
	verifier_test_audit( false !== strpos( $md, $attendu[4] ) && false !== strpos( $html_rapport, $attendu[4] ), $nom . ' : verdict cohérent dans les deux rapports' );

	if ( $attendu[2] > 0 ) {
		verifier_test_audit( false !== strpos( $md, 'Échecs non étayés (' ) && false !== strpos( $html_rapport, 'Échecs non étayés (' ), $nom . ' : détails non étayés visibles' );
	}
	if ( 'majeur-sans-preuve' === $nom ) {
		verifier_test_audit( 0 === $json['majeur'] && 0 === $json['bloquant'], 'absence de preuve : ne pas inventer de constat étayé' );
		verifier_test_audit( false !== strpos( $html_rapport, '&lt;majeur&gt;' ) && false === strpos( $html_rapport, '<majeur>' ), 'rapport HTML : libellé échappé' );
	}
	if ( $attendu[3] > 0 ) {
		verifier_test_audit( false !== strpos( $html_rapport, 'Mesure réelle' ), $nom . ' : preuve présente dans le HTML' );
	}
}

/* Exécuter l'auditeur complet sur une page simulée, dans une copie isolée
   pour qu'il ne touche pas aux rapports réels de docs/audits/. */
$isole = $dossier . '/auditeur';
mkdir( $isole . '/scripts/audit', 0700, true );
foreach ( array( 'audit-lib.php', 'rapport-html.php', 'lib-accessibilite.php', 'audit-accessibilite.php' ) as $fichier ) {
	copy( dirname( __DIR__ ) . '/scripts/audit/' . $fichier, $isole . '/scripts/audit/' . $fichier );
}
$commande = escapeshellarg( PHP_BINARY ) . ' ' . escapeshellarg( __DIR__ . '/fixtures/audit-accessibilite-cas.php' )
	. ' ' . escapeshellarg( $isole . '/scripts/audit/audit-accessibilite.php' ) . ' 2>&1';
$sortie = array();
$code = -1;
exec( $commande, $sortie, $code );
verifier_test_audit( 1 === $code, 'auditeur réel : la commande réellement muette bloque comme constat majeur' );
$rapports = glob( $isole . '/docs/audits/accessibilite-*.json' );
verifier_test_audit( 1 === count( $rapports ), 'auditeur réel : rapport produit' );
if ( 1 === count( $rapports ) ) {
	$rapport = json_decode( file_get_contents( $rapports[0] ), true );
	$releves = array_values( array_filter( $rapport['constats'], function ( $constat ) {
		return false !== strpos( $constat['libelle'], 'commandes sans texte ni nom indiqué' );
	} ) );
	verifier_test_audit( 1 === count( $releves ) && 0 === strpos( $releves[0]['detail'], '1 commande(s)' )
		&& false !== strpos( $releves[0]['detail'], 'commande-muette' ),
		'auditeur réel : 106 boutons nommés ignorés et seule la commande muette signalée' );
	verifier_test_audit( false !== strpos( implode( "\n", array_column( $rapport['constats'], 'libelle' ) ), 'taille et espacement des cibles à vérifier' ),
		'auditeur réel : taille WCAG 2.5.8 signalée comme non mesurée' );
}

/* Le lanceur entier doit relayer un seul audit grave non étayé, et ne pas
   présenter une erreur de WP-CLI comme un constat prouvé. */
$faux_wp = $dossier . '/faux-wp';
$fixture_harnais = __DIR__ . '/fixtures/audit-cas.php';
file_put_contents(
	$faux_wp,
	"#!/bin/sh\ncase \"\$4\" in\n  *audit-seo.php) exec " . escapeshellarg( PHP_BINARY ) . ' ' . escapeshellarg( $fixture_harnais )
		. ' majeur-sans-preuve ' . escapeshellarg( $dossier . '/rapport-lanceur' ) . ";;\n  *) exit 0;;\nesac\n"
);
chmod( $faux_wp, 0700 );
$lanceur = dirname( __DIR__ ) . '/scripts/audit/run-audits.sh';
$sortie = array();
$code = -1;
exec( 'WP_CLI=' . escapeshellarg( $faux_wp ) . ' bash ' . escapeshellarg( $lanceur ) . ' 2>&1', $sortie, $code );
verifier_test_audit( 1 === $code, 'lanceur : un audit majeur non étayé fait sortir la barrière en 1' );
verifier_test_audit( false !== strpos( implode( "\n", $sortie ), '[NON ÉTAYÉ]' ), 'lanceur : le contrôle non étayé reste identifiable' );
$sortie = array();
$code = -1;
exec( 'WP_CLI=false bash ' . escapeshellarg( $lanceur ) . ' 2>&1', $sortie, $code );
verifier_test_audit( 18 === $code && false !== strpos( implode( "\n", $sortie ), 'erreur d’exécution' ), 'lanceur : les erreurs WP-CLI bloquent sans inventer de constat' );

/* Ne supprimer que les répertoires temporaires créés par ce test. */
$entries = new RecursiveIteratorIterator(
	new RecursiveDirectoryIterator( $dossier, FilesystemIterator::SKIP_DOTS ),
	RecursiveIteratorIterator::CHILD_FIRST
);
foreach ( $entries as $entry ) {
	$entry->isDir() ? rmdir( $entry->getPathname() ) : unlink( $entry->getPathname() );
}
rmdir( $dossier );

echo "\nRésultat : $ok test(s) réussi(s), $echecs échec(s).\n";
exit( $echecs > 0 ? 1 : 0 );
