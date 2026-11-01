<?php
/**
 * Audit externe — Référencement (SEO).
 *
 * Contrôle la plateforme comme le ferait un spécialiste du référencement
 * qui reçoit une URL : est-ce que les moteurs peuvent comprendre le site,
 * l'indexer, et le présenter correctement dans les résultats ?
 *
 * Tout se passe dans un vrai WordPress : on lit les pages réellement
 * rendues (le HTML que reçoit un visiteur, pas le code source).
 *
 * Usage : wp eval-file scripts/audit/audit-seo.php
 *
 * @package Secura_Academy
 */

require_once dirname( __FILE__ ) . '/audit-lib.php';

audit_titre( 'seo', 'Audit externe — Référencement (SEO)' );

/* En ligne de commande, WordPress n'a pas de serveur HTTP : on complete
   les quelques variables qui lui manquent (sinon des avertissements
   polluent le rapport). */
if ( ! isset( $_SERVER['SERVER_NAME'] ) ) {
	$_SERVER['SERVER_NAME'] = 'localhost';
}

if ( ! isset( $_SERVER['REQUEST_URI'] ) ) {
	$_SERVER['REQUEST_URI'] = '/';
}

$racine = dirname( dirname( dirname( __FILE__ ) ) );
$theme  = $racine . '/wp-content/themes/secura-learning';

/* ------------------------------------------------------------------ */
echo "\n1. L'adresse du site\n";

$structure = get_option( 'permalink_structure' );

audit_verifier(
	'les adresses sont lisibles par un humain (pas de ?p=123)',
	'' !== $structure && false === strpos( $structure, '?p=' ),
	'structure actuelle : ' . ( $structure ? $structure : '(vide)' ),
	'majeur'
);

audit_verifier(
	'le site a un titre',
	'' !== trim( (string) get_bloginfo( 'name' ) ),
	'titre : ' . get_bloginfo( 'name' ),
	'majeur'
);

/* ------------------------------------------------------------------ */
echo "\n2. Ce que voit un moteur en arrivant sur une room\n";

$rooms = get_posts(
	array(
		'post_type'   => 'secura_room',
		'post_status' => 'publish',
		'numberposts' => -1,
	)
);

if ( empty( $rooms ) ) {
	audit_verifier( 'des rooms sont publiées', false, 'aucune room trouvée', 'bloquant' );

	exit( audit_fin() );
}

$room = $rooms[0];

/* On va chercher la page comme un visiteur la recoit : c'est la seule
   facon de juger ce qu'un moteur voit (le theme, les balises du plugin,
   les extensions). */
$permalink = get_permalink( $room->ID );

$url_ar       = add_query_arg( 'seca_lang', 'ar', $permalink );
$page_ar      = audit_exec( 'curl -s "' . $url_ar . '"' );
$page_ar_html = $page_ar;

$html = audit_exec( 'curl -s "' . $permalink . '"' );

if ( '' === trim( $html ) ) {
	audit_verifier(
		'la page de la room est accessible',
		false,
		'la page ' . $permalink . ' n a pas pu etre telechargee (le site tourne-t-il ?)',
		'bloquant'
	);

	exit( audit_fin() );
}

audit_verifier(
	'la page annonce le titre de la room (ce que le moteur affiche dans le resultat)',
	false !== strpos( $html, '<title>' ) && false !== strpos( $html, htmlspecialchars( (string) $room->post_title, ENT_QUOTES ) ),
	'title de la room absent de la balise <title>',
	'majeur'
);

audit_verifier(
	'la page a une meta description (le résumé du moteur)',
	false !== stripos( $html, '<meta name="description"' ),
	'sans meta description, le moteur invente le résumé : la page est moins cliquable',
	'majeur'
);

audit_verifier(
	'la page annonce son adresse canonique (évite le « contenu en double »)',
	false !== stripos( $html, 'rel="canonical"' ),
	'sans canonique, une room peut être indexée plusieurs fois (avec et sans paramètres)',
	'mineur'
);

audit_verifier(
	'la page se partage correctement (Open Graph : titre, image, description)',
	false !== stripos( $html, 'property="og:title"' ) && false !== stripos( $html, 'property="og:description"' ),
	'sans Open Graph, un partage sur Facebook/WhatsApp n\'a pas de titre ni d\'aperçu',
	'mineur'
);

audit_verifier(
	'la page se partage correctement (carte Twitter)',
	false !== stripos( $html, 'name="twitter:card"' ),
	'sans carte Twitter, le partage sur X/Twitter est muet',
	'info'
);

audit_verifier(
	'la page déclare sa langue (indispensable pour l\'arabe et l\'anglais)',
	false !== stripos( $html, 'lang=' ),
	'la balise lang manque : le moteur ne sait pas dans quelle langue indexer la page',
	'majeur'
);

audit_verifier(
	'la version arabe indique la direction du texte (droite à gauche)',
	false !== stripos( $page_ar_html, 'dir="rtl"' ),
	'la page arabe ne renvoie pas dir="rtl" : le texte arabe sera mal aligne',
	'majeur'
);

audit_verifier(
	'la page s\'adapte aux téléphones',
	false !== stripos( $html, 'name="viewport"' ),
	'pas de balise viewport : la page est illisible sur téléphone',
	'bloquant'
);

/* ------------------------------------------------------------------ */
echo "\n3. Les titres et les adresses des 52 rooms\n";

$titres       = array();
$slugs        = array();
$trop_long    = array();
$titres_court = array();

foreach ( $rooms as $r ) {
	$titre = trim( (string) $r->post_title );

	if ( isset( $titres[ $titre ] ) ) {
		$titres_court[] = $titre;
	}

	$titres[ $titre ] = true;

	if ( mb_strlen( $titre ) > 60 ) {
		$trop_long[] = $titre . ' (' . mb_strlen( $titre ) . ' caractères)';
	}

	$slugs[ $r->post_name ] = true;
}

audit_verifier(
	'deux rooms ne portent pas le même titre',
	empty( $titres_court ),
	'titre en double : ' . implode( ' | ', $titres_court ),
	'majeur'
);

audit_verifier(
	'les titres des rooms tiennent dans la largeur d\'un résultat de moteur',
	empty( $trop_long ),
	count( $trop_long ) . ' titre(s) trop long(s) : ' . implode( ' | ', array_slice( $trop_long, 0, 3 ) ),
	'mineur'
);

/* ------------------------------------------------------------------ */
echo "\n4. Le site vu de l'extérieur\n";

$url_site = home_url( '/' );

$robots = audit_exec( 'curl -s -o /dev/null -w "%{http_code}" "' . $url_site . 'robots.txt"' );

audit_verifier(
	'le fichier robots.txt répond',
	'200' === trim( $robots ),
	'code reçu : ' . trim( $robots ),
	'mineur'
);

$plan = audit_exec( 'curl -s "' . $url_site . 'robots.txt"' );

$interdit_tout = false;

foreach ( explode( "\n", $plan ) as $ligne_plan ) {
	if ( 'disallow: /' === strtolower( trim( $ligne_plan ) ) ) {
		$interdit_tout = true;
	}
}

audit_verifier(
	'robots.txt n\'interdit pas l\'indexation du site',
	! $interdit_tout,
	'le site demande explicitement de ne pas être indexé',
	'bloquant'
);

$plan_site = audit_exec( 'curl -s -o /dev/null -w "%{http_code}" "' . $url_site . 'wp-sitemap.xml"' );

audit_verifier(
	'le plan du site (sitemap) est disponible',
	'200' === trim( $plan_site ),
	'code reçu : ' . trim( $plan_site ) . ' (WordPress le génère n\'importe comment)',
	'info'
);

/* ------------------------------------------------------------------ */
echo "\n5. Les versions dans plusieurs langues\n";

$code_ar = audit_exec( 'curl -s -o /dev/null -w "%{http_code}" "' . $url_ar . '"' );

audit_verifier(
	'la version arabe de la page répond',
	'200' === trim( $code_ar ),
	'code reçu : ' . trim( $code_ar ),
	'majeur'
);



audit_verifier(
	'les pages en plusieurs langues se signalent les unes les autres (hreflang)',
	false !== stripos( $html, 'hreflang=' ),
	'sans hreflang, un moteur ne sait pas que ces pages sont les versions traduites : il peut les traiter comme des doublons',
	'mineur'
);

audit_verifier(
	'le changement de langue est un lien lisible (pas seulement du JavaScript)',
	false !== stripos( $html, 'seca_lang=ar' ) || false !== stripos( $html, 'seca_lang=en' ),
	'le sélecteur de langue n\'apparaît pas dans le code de la page',
	'majeur'
);

/* ------------------------------------------------------------------ */
echo "\n6. La structure des titres (pour les lecteurs d'écran et les moteurs)\n";

$h1 = substr_count( $html, '<h1' );

audit_verifier(
	'la page a exactement un titre principal (h1)',
	1 === $h1,
	'trouvé : ' . $h1,
	'majeur'
);

$images_sans_alt = preg_match_all( '/<img(?![^>]*\balt=)[^>]*>/i', $html );

audit_verifier(
	'les images portent un texte alternatif',
	0 === $images_sans_alt,
	$images_sans_alt . ' image(s) sans texte alternatif : elles sont invisibles pour un lecteur d\'écran et pour le moteur',
	'majeur'
);

exit( audit_fin() );
