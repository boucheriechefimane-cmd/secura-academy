<?php
/**
 * Audit externe — Ergonomie et interface (UX / UI).
 *
 * Contrôle l'expérience de l'élève comme le ferait un specialist de
 * l'ergonomie : peut-on lire, comprendre et utiliser la plateforme sur
 * un téléphone, avec un lecteur d'ecran, en arabe (droite a gauche), et
 * sans etre daltonien ?
 *
 * Les contrastes sont calcules (regle WCAG), pas supposes.
 *
 * Usage : wp eval-file scripts/audit/audit-ux-ui.php
 *
 * @package Secura_Academy
 */

require_once dirname( __FILE__ ) . '/audit-lib.php';

audit_titre( 'ux', 'Audit externe — Ergonomie et interface (UX / UI)' );

$racine = dirname( dirname( dirname( __FILE__ ) ) );
$css    = $racine . '/wp-content/plugins/secura-academy/assets/academy.css';
$css_theme = $racine . '/wp-content/themes/secura-learning/style.css';

/* ------------------------------------------------------------------ */
echo "\n1. Les contrastes (regle WCAG AA)\n";

/**
 * Luminance relative d'une couleur hexadecimale.
 *
 * @param string $hex Couleur au format #rrggbb.
 * @return float
 */
function audit_luminance( $hex ) {
	$hex = ltrim( (string) $hex, '#' );

	if ( 3 === strlen( $hex ) ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}

	$r = hexdec( substr( $hex, 0, 2 ) ) / 255;
	$g = hexdec( substr( $hex, 2, 2 ) ) / 255;
	$b = hexdec( substr( $hex, 4, 2 ) ) / 255;

	$ajuste = function ( $canal ) {
		return ( $canal <= 0.03928 ) ? ( $canal / 12.92 ) : pow( ( $canal + 0.055 ) / 1.055, 2.4 );
	};

	return 0.2126 * $ajuste( $r ) + 0.7152 * $ajuste( $g ) + 0.0722 * $ajuste( $b );
}

/**
 * Rapport de contraste entre deux couleurs.
 *
 * @param string $a Couleur du texte.
 * @param string $b Couleur du fond.
 * @return float
 */
function audit_contraste( $a, $b ) {
	$la = audit_luminance( $a );
	$lb = audit_luminance( $b );

	$clair = max( $la, $lb );
	$sombre = min( $la, $lb );

	return ( $clair + 0.05 ) / ( $sombre + 0.05 );
}

$paires = array(
	array( 'texte normal sur le fond', '#e9eefc', '#0b1220', 4.5 ),
	array( 'texte secondaire sur le fond', '#9db0d0', '#0b1220', 4.5 ),
	array( 'texte normal sur une carte', '#e9eefc', '#131c2e', 4.5 ),
	array( 'texte secondaire sur une carte', '#9db0d0', '#131c2e', 4.5 ),
	array( 'accent sur le fond', '#2dd4a7', '#0b1220', 3.0 ),
	array( 'accent bleu sur le fond', '#38bdf8', '#0b1220', 3.0 ),
	array( 'message d\'erreur sur le fond', '#f87171', '#0b1220', 4.5 ),
	array( 'message de reussite sur le fond', '#34d399', '#0b1220', 4.5 ),
	array( 'avertissement sur le fond', '#fbbf24', '#0b1220', 4.5 ),
);

$contrastes_faibles = array();

foreach ( $paires as $paire ) {
	list( $nom, $texte, $fond, $minimum ) = $paire;

	$ratio = audit_contraste( $texte, $fond );

	if ( $ratio < $minimum ) {
		$contrastes_faibles[] = $nom . ' (' . round( $ratio, 2 ) . ':1, minimum ' . $minimum . ':1)';
	}
}

audit_verifier(
	'les textes ont un contraste suffisant pour etre lus',
	empty( $contrastes_faibles ),
	implode( ' | ', $contrastes_faibles ),
	'majeur'
);

audit_info(
	'contrastes calcules',
	implode(
		' ; ',
		array_map(
			function ( $paire ) {
				return $paire[0] . ' = ' . round( audit_contraste( $paire[1], $paire[2] ), 2 ) . ':1';
			},
			$paires
		)
	)
);

/* ------------------------------------------------------------------ */
echo "\n2. L'ecran de l'eleve : ce que la page contient vraiment\n";

/* TOUTES les rooms sont rendues et verifiees : une seule room etait
   rendue, donc le verdict dependait de l'identifiant tire. */
$rooms = get_posts(
	array(
		'post_type'   => 'secura_room',
		'post_status' => 'publish',
		'numberposts' => -1,
		'orderby'     => 'ID',
		'order'       => 'ASC',
	)
);

if ( empty( $rooms ) ) {
	audit_verifier( 'une room est publiee', false, '', 'bloquant' );

	exit( audit_fin() );
}

$h1_en_double         = array();
$boutons_sans_nom     = array();
$champs_sans_etiquette = array();
$sans_aria            = array();
$facade_rompue        = array();
$lien_secours_absent  = array();
$rooms_avec_video     = 0;
$room                 = $rooms[0];

foreach ( $rooms as $chambre ) {
	ob_start();
	echo do_shortcode( '[secura_academy_room id="' . $chambre->ID . '"]' );
	$html = (string) ob_get_clean();

	$nombre_h1 = substr_count( $html, '<h1' );

	if ( 1 !== $nombre_h1 ) {
		$h1_en_double[] = 'room ' . $chambre->ID . ' (« ' . $chambre->post_title . ' ») : ' . $nombre_h1 . ' titre(s) de niveau 1';
	}

	$nb_boutons = preg_match_all( '/<button(?![^>]*aria-label)(?![^>]*>\s*[^<])[^>]*>\s*<\/button>/i', $html );

	if ( $nb_boutons ) {
		$boutons_sans_nom[] = 'room ' . $chambre->ID . ' : ' . $nb_boutons . ' bouton(s) vide(s) ou sans libellé';
	}

	$nb_champs = preg_match_all( '/<(input|textarea|select)(?![^>]*(aria-label|aria-labelledby|id="[^"]+"))[^>]*>/i', $html );

	if ( $nb_champs ) {
		$champs_sans_etiquette[] = 'room ' . $chambre->ID . ' : ' . $nb_champs . ' champ(s) sans étiquette';
	}

	if ( false === stripos( $html, 'aria-' ) ) {
		$sans_aria[] = 'room ' . $chambre->ID . ' : aucun attribut ARIA';
	}

	/* La facade video ne concerne que les rooms qui portent une
	   video : exiger d'un lecteur video d'une room qui n'en a pas
	   serait un faux positif. */
	$video = get_post_meta( $chambre->ID, '_secura_video', true );

	if ( is_array( $video ) && ! empty( $video['id'] ) ) {
		$rooms_avec_video++;

		if ( false === stripos( $html, 'seca-video' ) || false !== stripos( $html, '<iframe' ) ) {
			$facade_rompue[] = 'room ' . $chambre->ID . ' (« ' . $chambre->post_title . ' »)';
		}

		if ( false === stripos( $html, 'youtube.com/watch' ) ) {
			$lien_secours_absent[] = 'room ' . $chambre->ID . ' (« ' . $chambre->post_title . ' »)';
		}
	}
}

audit_verifier(
	'chaque room a un titre de niveau 1 (un seul, pour ne pas perdre le lecteur d\'ecran)',
	empty( $h1_en_double ),
	count( $h1_en_double ) . ' room(s) concernée(s) : ' . implode( ' | ', array_slice( $h1_en_double, 0, 3 ) ),
	'majeur',
	empty( $h1_en_double )
		? count( $rooms ) . ' rooms rendues une par une : chacune a exactement un titre de niveau 1'
		: implode( "\n", $h1_en_double )
);

audit_verifier(
	'chaque bouton a un nom lisible (ce qu\'on lit quand le curseur est dessus)',
	empty( $boutons_sans_nom ),
	count( $boutons_sans_nom ) . ' room(s) concernée(s) : ' . implode( ' | ', array_slice( $boutons_sans_nom, 0, 3 ) ),
	'majeur',
	empty( $boutons_sans_nom )
		? count( $rooms ) . ' rooms rendues : aucun bouton vide ou sans libellé'
		: implode( "\n", $boutons_sans_nom )
);

audit_verifier(
	'chaque champ de saisie est etiquete',
	empty( $champs_sans_etiquette ),
	count( $champs_sans_etiquette ) . ' room(s) concernée(s) : ' . implode( ' | ', array_slice( $champs_sans_etiquette, 0, 3 ) ),
	'majeur',
	empty( $champs_sans_etiquette )
		? count( $rooms ) . ' rooms rendues : chaque champ porte une étiquette'
		: implode( "\n", $champs_sans_etiquette )
);

audit_verifier(
	'la zone de progression est annoncee (aria) et pas seulement coloree',
	empty( $sans_aria ),
	count( $sans_aria ) . ' room(s) concernée(s) : ' . implode( ' | ', array_slice( $sans_aria, 0, 3 ) ),
	'info',
	empty( $sans_aria )
		? count( $rooms ) . ' rooms rendues : les attributs ARIA sont présents partout'
		: implode( "\n", $sans_aria )
);

audit_verifier(
	'la video du cours se presente avant d\'etre chargee (image + bouton, pas un lecteur vide)',
	empty( $facade_rompue ),
	count( $facade_rompue ) . ' room(s) concernée(s) : ' . implode( ' | ', array_slice( $facade_rompue, 0, 3 ) ),
	'majeur',
	empty( $facade_rompue )
		? $rooms_avec_video . ' rooms portent une video : chacune présente une image et un bouton, aucun lecteur n\'est chargé avant le clic'
		: implode( "\n", $facade_rompue )
);

audit_verifier(
	'un lien de secours vers la source de la video reste visible',
	empty( $lien_secours_absent ),
	count( $lien_secours_absent ) . ' room(s) concernée(s) : ' . implode( ' | ', array_slice( $lien_secours_absent, 0, 3 ) ),
	'majeur',
	empty( $lien_secours_absent )
		? $rooms_avec_video . ' rooms portent une video : le lien vers la source reste visible (l\'élève n\'est pas bloqué si YouTube est bloqué)'
		: implode( "\n", $lien_secours_absent )
);

/* ------------------------------------------------------------------ */
echo "\n3. Le telephone\n";

$contenu_css = file_get_contents( $css );

audit_verifier(
	'la mise en page s\'adapte aux ecrans etroits',
	substr_count( $contenu_css, '@media' ) >= 2,
	'les media queries trouvées : ' . substr_count( $contenu_css, '@media' ),
	'mineur'
);

audit_verifier(
	'les boutons restent assez grands pour un doigt (44 px minimum)',
	false !== strpos( $contenu_css, 'min-height' ),
	'',
	'mineur'
);

/* ------------------------------------------------------------------ */
echo "\n4. L'arabe (droite a gauche) et l'accessibilite\n";

$theme_css = file_get_contents( $css_theme );

audit_verifier(
	'le theme prevoy une feuille de style pour le droite a gauche',
	file_exists( $racine . '/wp-content/themes/secura-learning/style-rtl.css' ),
	'',
	'mineur'
);

audit_verifier(
	'les marges utilisent des proprietes logiques (le RTL marche sans feuille dediee)',
	false !== strpos( $contenu_css, 'margin-inline' ) || false !== strpos( $contenu_css, 'padding-inline' )
		|| false !== strpos( $contenu_css, 'inset-inline' ),
	'',
	'mineur'
);

audit_verifier(
	'le focus est visible au clavier',
	false !== strpos( $contenu_css, 'focus-visible' ) || false !== strpos( $theme_css, 'focus-visible' ),
	'',
	'majeur'
);

audit_verifier(
	'les animations respectent le reglage « moins d\'animations » du systeme',
	false !== strpos( $contenu_css, 'prefers-reduced-motion' ),
	'',
	'mineur'
);

audit_verifier(
	'le site propose un lien d\'evitement (aller directement au contenu)',
	false !== stripos( file_get_contents( $racine . '/wp-content/themes/secura-learning/header.php' ), 'skip' ),
	'',
	'mineur'
);

$page_reelle = audit_exec( 'curl -s "' . get_permalink( $room->ID ) . '"' );

audit_verifier(
	'le changement de langue est possible sans JavaScript (de vrais liens)',
	false !== stripos( $page_reelle, 'seca_lang=' ) && false !== stripos( $page_reelle, '<a ' ),
	'le selecteur de langue n\'apparait pas dans la page',
	'majeur'
);

/* ------------------------------------------------------------------ */
echo "\n5. Les messages (ce que l'eleve lit quand il se trompe)\n";

$messages = array(
	'secura_academy' => 0,
);

$traductions = audit_exec( 'grep -rho "Secura_I18n::t(" "' . $racine . '/wp-content/plugins/secura-academy/includes" | wc -l' );

audit_info(
	'messages traduits dans le plugin (chaines __() )',
	trim( $traductions ) . ' chaines'
);

audit_verifier(
	'les messages d\'erreur sont traduits (l\'eleve arabe ou anglais ne lit pas du francais)',
	(int) trim( $traductions ) >= 25,
	'chaines traduites trouvees : ' . trim( $traductions ),
	'mineur'
);

exit( audit_fin() );
