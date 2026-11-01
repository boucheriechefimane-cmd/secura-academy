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

/* ------------------------------------------------------------------ */
echo "\n7. Les reponses generees par l'IA (guide officiel de Google)\n";

/* Google rappelle que les reponses generees par l'IA s'appuient sur le
   meme index que la recherche classique : ce qui compte, c'est que la
   page soit indexable, explorable, et comprise sans JavaScript. On
   verifie donc les points precis du guide « Optimizing your website for
   generative AI features on Google Search ». */

/* 1. Indexable : pas de « noindex ». */
audit_verifier(
	'la page est indexable (aucun « noindex »)',
	false === stripos( $html, 'noindex' ),
	'la page demande de ne pas etre indexee',
	'bloquant'
);

/* 2. Explorable : le contenu est dans le HTML servi. */
$texte_serve = trim( wp_strip_all_tags( $html ) );

audit_verifier(
	'le contenu est servi dans le HTML (un robot sans JavaScript voit la lecon)',
	mb_strlen( $texte_serve ) > 400,
	'le HTML servi ne contient presque aucun texte (' . mb_strlen( $texte_serve ) . ' caracteres)',
	'bloquant'
);

/* 3. La canonique : absolue, unique, et auto-reference par langue. */
preg_match( '/<link[^>]+rel=["\']canonical["\'][^>]*href=["\']([^"\']+)["\']/i', $html, $canon );
preg_match( '/<link[^>]+rel=["\']canonical["\'][^>]*href=["\']([^"\']+)["\']/i', $page_ar_html, $canon_ar );

$canon_url    = isset( $canon[1] ) ? $canon[1] : '';
$canon_ar_url = isset( $canon_ar[1] ) ? $canon_ar[1] : '';

audit_verifier(
	'la page a une adresse canonique',
	'' !== $canon_url,
	'balise <link rel="canonical"> absente',
	'majeur'
);

audit_verifier(
	'la canonique est une adresse absolue',
	'' !== $canon_url && 0 === strpos( $canon_url, 'http' ),
	'canonique relative : ' . $canon_url,
	'majeur'
);

audit_verifier(
	'il n\'y a qu\'une seule adresse canonique (pas de doublon)',
	1 === substr_count( $html, 'rel="canonical"' ),
	substr_count( $html, 'rel="canonical"' ) . ' adresses canoniques dans la page',
	'majeur'
);

audit_verifier(
	'chaque langue se designe elle-meme (canonique auto-reference)',
	'' !== $canon_url
		&& false === strpos( $canon_url, 'seca_lang' )
		&& '' !== $canon_ar_url
		&& false !== strpos( $canon_ar_url, 'seca_lang=ar' ),
	'canonique francaise : ' . $canon_url . ' | canonique arabe : ' . $canon_ar_url,
	'majeur'
);

/* 4. Les versions de langue : des adresses absolues, et reciproques. */
preg_match_all( '/<link[^>]+rel=["\']alternate["\'][^>]*hreflang=["\']([a-z-]+)["\'][^>]*href=["\']([^"\']+)["\']/i', $html, $alts, PREG_SET_ORDER );

$langues_declarees = array();

foreach ( $alts as $alt ) {
	$langues_declarees[ $alt[1] ] = $alt[2];
}

audit_verifier(
	'les versions de langue sont annoncees (francais, arabe, anglais) plus la version de repli',
	isset( $langues_declarees['fr'], $langues_declarees['ar'], $langues_declarees['en'], $langues_declarees['x-default'] ),
	'declarees : ' . implode( ', ', array_keys( $langues_declarees ) ),
	'majeur'
);

$relatives = array();

foreach ( $langues_declarees as $langue => $adresse ) {
	if ( 0 !== strpos( $adresse, 'http' ) ) {
		$relatives[] = $langue;
	}
}

audit_verifier(
	'aucune version de langue n\'est donnee en adresse relative (Google ignore les adresses relatives)',
	empty( $relatives ),
	implode( ', ', $relatives ),
	'majeur'
);

/* 5. Les donnees structurees : valides, et declarant la ressource. */
preg_match( '/<script[^>]+type=["\']application\/ld\+json["\'][^>]*>(.*?)<\/script>/is', $html, $ld );

$schema = isset( $ld[1] ) ? json_decode( $ld[1], true ) : null;

audit_verifier(
	'la page declare des donnees structurees (schema.org) au format attendu',
	is_array( $schema ) && isset( $schema['@context'] ) && isset( $schema['@graph'] ),
	'pas de bloc JSON-LD valide',
	'mineur'
);

$types = array();
$video_schema = array();

if ( is_array( $schema ) && isset( $schema['@graph'] ) ) {
	foreach ( $schema['@graph'] as $element ) {
		if ( isset( $element['@type'] ) ) {
			$types[] = $element['@type'];
		}

		if ( isset( $element['@type'] ) && 'VideoObject' === $element['@type'] ) {
			$video_schema = $element;
		}
	}
}

audit_verifier(
	'la room est declaree comme ressource d\'apprentissage',
	in_array( 'LearningResource', $types, true ),
	'types declares : ' . implode( ', ', $types ),
	'mineur'
);

audit_verifier(
	'la video du cours est declaree (le moteur la voit, meme si l\'eleve ne clique jamais)',
	in_array( 'VideoObject', $types, true ),
	'pas de VideoObject : le moteur ne peut pas voir le cours video',
	'mineur'
);

audit_verifier(
	'la declaration video est complete (duree, miniature, adresse de lecture)',
	! empty( $video_schema['duration'] ) && ! empty( $video_schema['thumbnailUrl'] ) && ! empty( $video_schema['contentUrl'] ),
	'la declaration video est incomplete',
	'info'
);

/* 6. Le guide de Google : pas besoin de « llms.txt », ni de decoupage
      special, ni de reecriture pour l\'IA. On verifie que rien de
      tout cela ne traine dans le site. */
audit_verifier(
	'le site ne contient pas de fichier « llms.txt » (Google dit que cela ne sert a rien)',
	! file_exists( $racine . '/llms.txt' ),
	'fichier llms.txt present : aucune utilite pour Google',
	'info'
);

/* 7. La page reste legere : la rapidite fait partie de l\'experience. */
audit_verifier(
	'la page servie reste raisonnable en poids',
	mb_strlen( $html ) < 300000,
	'HTML de ' . round( mb_strlen( $html ) / 1024 ) . ' Ko',
	'mineur'
);

/* 8. Un contenu structure en sections : c\'est ce que les modeles
      recuperent pour repondre. */
$h2 = substr_count( $html, '<h2' );

audit_verifier(
	'la page est structuree en sections (titres de niveau 2)',
	$h2 >= 2,
	'titres de niveau 2 trouves : ' . $h2,
	'mineur'
);

exit( audit_fin() );
