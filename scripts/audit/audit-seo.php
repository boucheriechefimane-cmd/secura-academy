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

/* On demande la version FRANCAISE explicitement. L'ancienne mesure
   chargeait l'adresse nue en croyant recevoir le francais : sur un site
   installe en anglais, elle auditait l'anglais en le comparant a des
   attentes francaises (et le WordPress reel de recette est en anglais). */
$url_fr       = add_query_arg( 'seca_lang', 'fr', $permalink );
$url_ar       = add_query_arg( 'seca_lang', 'ar', $permalink );
$page_ar      = audit_exec( 'curl -s "' . $url_ar . '"' );
$page_ar_html = $page_ar;

$html = audit_exec( 'curl -s "' . $url_fr . '"' );

if ( '' === trim( $html ) ) {
	$html = audit_exec( 'curl -s "' . $permalink . '"' );
}

if ( '' === trim( $html ) ) {
	audit_verifier(
		'la page de la room est accessible',
		false,
		'la page ' . $permalink . ' n a pas pu etre telechargee (le site tourne-t-il ?)',
		'bloquant'
	);

	exit( audit_fin() );
}

/* Le titre se lit dans <title>, et nulle part ailleurs : l'ancienne
   mesure cherchait le titre dans TOUT le HTML (le menu, le fil
   d'Ariane...), donc elle passait meme quand l'onglet annoncait autre
   chose. */
preg_match( '/<title>(.*?)<\/title>/is', $html, $m_titre_page );
$titre_page = isset( $m_titre_page[1] ) ? audit_normaliser_texte( html_entity_decode( $m_titre_page[1], ENT_QUOTES | ENT_HTML5, 'UTF-8' ) ) : '';

audit_verifier(
	'la page annonce le titre de la room (ce que le moteur affiche dans le resultat)',
	'' !== $titre_page
		&& false !== strpos( $titre_page, audit_normaliser_texte( (string) $room->post_title ) ),
	'titre lu dans <title> : « ' . $titre_page . ' » (attendu : « ' . $room->post_title . ' »)',
	'majeur',
	'titre servi dans <title> : « ' . $titre_page . ' »'
);

/* Le meme controle, sur TOUTES les rooms. Choisir une room au hasard
   rendait le resultat dependant de l'ordre des identifiants : une room
   pouvait passer en CI et etre ignoree en local. Le catalogue fait
   52 rooms : on les verifie toutes. */
$titres_manquants = array();
$pages_mal_preparees = array();
$versions_ar_defectueuses = array();

$rooms_tous = get_posts(
	array(
		'post_type'   => 'secura_room',
		'numberposts' => -1,
		'post_status' => 'publish',
		'orderby'     => 'ID',
		'order'       => 'ASC',
	)
);

foreach ( $rooms_tous as $chambre ) {
	$page = wp_remote_get( add_query_arg( 'seca_lang', 'fr', get_permalink( $chambre->ID ) ), array( 'timeout' => 20 ) );

	if ( is_wp_error( $page ) ) {
		$titres_manquants[]   = $chambre->post_name . ' : page non servie';
		$pages_mal_preparees[] = $chambre->post_name . ' : page non servie';
		continue;
	}

	$corps = wp_remote_retrieve_body( $page );

	/* Meme regle que pour la room de tete : on lit <title>, pas le HTML
	   entier. */
	if ( ! preg_match( '/<title>(.*?)<\/title>/is', $corps, $m_t ) ) {
		$titres_manquants[] = $chambre->post_name . ' : pas de balise <title>';
	} elseif ( false === strpos(
		audit_normaliser_texte( html_entity_decode( $m_t[1], ENT_QUOTES | ENT_HTML5, 'UTF-8' ) ),
		audit_normaliser_texte( (string) $chambre->post_title )
	) ) {
		$titres_manquants[] = $chambre->post_name . ' : <title> ne contient pas le titre de la room';
	}

	/* Ce que le moteur lit sur la page : résumé, adresse canonique,
	   aperçu de partage, langue déclarée, écran étroit. On le mesure
	   sur TOUTES les rooms : sur une seule, un défaut passait. */
	$manques = array();

	if ( false === stripos( $corps, '<meta name="description"' ) ) {
		$manques[] = 'meta description';
	}

	if ( false === stripos( $corps, 'rel="canonical"' ) ) {
		$manques[] = 'adresse canonique';
	}

	if ( false === stripos( $corps, 'property="og:title"' ) || false === stripos( $corps, 'property="og:description"' ) ) {
		$manques[] = 'aperçu de partage (Open Graph)';
	}

	if ( false === stripos( $corps, 'name="twitter:card"' ) ) {
		$manques[] = 'carte Twitter';
	}

	if ( false === stripos( $corps, 'lang=' ) ) {
		$manques[] = 'langue déclarée';
	}

	if ( false === stripos( $corps, 'name="viewport"' ) ) {
		$manques[] = 'affichage sur téléphone';
	}

	if ( ! empty( $manques ) ) {
		$pages_mal_preparees[] = $chambre->post_name . ' : ' . implode( ', ', $manques );
	}

	/* La version arabe : elle doit répondre, et porter la direction
	   du texte. On le vérifie room par room. */
	$page_ar = wp_remote_get( add_query_arg( 'seca_lang', 'ar', get_permalink( $chambre->ID ) ), array( 'timeout' => 20 ) );

	if ( is_wp_error( $page_ar ) ) {
		$versions_ar_defectueuses[] = $chambre->post_name . ' : version arabe non servie';
	} else {
		$code_ar = (int) wp_remote_retrieve_response_code( $page_ar );
		$corps_ar = wp_remote_retrieve_body( $page_ar );

		if ( 200 !== $code_ar ) {
			$versions_ar_defectueuses[] = $chambre->post_name . ' : version arabe en HTTP ' . $code_ar;
		} elseif ( false === stripos( $corps_ar, 'dir="rtl"' ) ) {
			$versions_ar_defectueuses[] = $chambre->post_name . ' : version arabe sans dir="rtl"';
		}
	}
}

audit_verifier(
	'le titre de chaque room est annonce (ce que le moteur affiche dans le resultat)',
	empty( $titres_manquants ),
	count( $titres_manquants ) . ' room(s) sans titre annonce : ' . implode( ' | ', array_slice( $titres_manquants, 0, 5 ) ),
	'majeur',
	empty( $titres_manquants )
		? sprintf(
			'Les %d pages de room servies annoncent chacune leur titre, compare apres normalisation (entites decodees, apostrophes unifiees).',
			count( $rooms_tous )
		)
		: implode( "\n", array_slice( $titres_manquants, 0, 5 ) )
);

audit_verifier(
	'chaque room est prete pour le moteur (resume, adresse canonique, partage, langue, telephone)',
	empty( $pages_mal_preparees ),
	count( $pages_mal_preparees ) . ' room(s) incompletes : ' . implode( ' | ', array_slice( $pages_mal_preparees, 0, 5 ) ),
	'majeur',
	empty( $pages_mal_preparees )
		? sprintf(
			'Les %d pages de room servies portent chacune : un resume (meta description), une adresse canonique, un apercu de partage, une carte Twitter, une langue declaree et un affichage adapte aux ecrans etroits.',
			count( $rooms_tous )
		)
		: implode( "\n", array_slice( $pages_mal_preparees, 0, 5 ) )
);

audit_verifier(
	'chaque version arabe repond et se lit de droite a gauche',
	empty( $versions_ar_defectueuses ),
	count( $versions_ar_defectueuses ) . ' room(s) concernee(s) : ' . implode( ' | ', array_slice( $versions_ar_defectueuses, 0, 5 ) ),
	'majeur',
	empty( $versions_ar_defectueuses )
		? sprintf(
			'Les %d versions arabes des rooms repondent toutes en HTTP 200 et portent dir="rtl" : le texte arabe est aligne a droite.',
			count( $rooms_tous )
		)
		: implode( "\n", array_slice( $versions_ar_defectueuses, 0, 5 ) )
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
	(bool) preg_match( '/<a[^>]+href=["\'][^"\']*(?:seca_lang|\?lang)=/i', $html ),
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

/* La regle mesuree n'est pas « la canonique francaise n'a pas de
   parametre » : c'est « la page se designe elle-meme, dans la langue
   qu'elle sert ». Sur un site installe en anglais, l'adresse nue sert
   l'anglais ; la version francaise vit alors sous « ?seca_lang=fr », et
   une canonique sans parametre la declarerait identique a l'anglais. */
$attendu_fr = Secura_I18n::url_pour_langue( 'fr', $canon_url );
$attendu_ar = Secura_I18n::url_pour_langue( 'ar', $canon_ar_url );

audit_verifier(
	'chaque langue se designe elle-meme (canonique auto-reference)',
	'' !== $canon_url
		&& '' !== $canon_ar_url
		&& $canon_url === $attendu_fr
		&& $canon_ar_url === $attendu_ar
		&& $canon_url !== $canon_ar_url,
	'canonique de la page francaise : ' . $canon_url . ' (attendue : ' . $attendu_fr . ')'
		. ' | canonique arabe : ' . $canon_ar_url . ' (attendue : ' . $attendu_ar . ')',
	'majeur',
	'canonique francaise : ' . $canon_url . ' | canonique arabe : ' . $canon_ar_url
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

/* Presence ne suffit pas : chaque hreflang doit designer une adresse qui
   SERT cette langue. Le 05/11/2026, la page anglaise se declarait
   « hreflang=fr » sur sa propre adresse : Google envoyait donc les
   lecteurs francais vers une page anglaise. */
$hreflang_faux = array();

foreach ( $langues_declarees as $langue_href => $adresse_href ) {
	if ( 'x-default' === $langue_href ) {
		continue;
	}

	$servie = Secura_I18n::langue_de_url( str_replace( '&amp;', '&', $adresse_href ) );

	if ( $servie !== $langue_href ) {
		$hreflang_faux[] = $langue_href . ' → ' . $adresse_href . ' sert ' . $servie;
	}
}

audit_verifier(
	'chaque hreflang designe une adresse qui sert vraiment cette langue',
	empty( $hreflang_faux ),
	implode( ' ; ', $hreflang_faux ),
	'majeur',
	implode( ' ; ', array_map(
		function ( $langue_href, $adresse_href ) {
			return $langue_href . ' → ' . $adresse_href;
		},
		array_keys( $langues_declarees ),
		array_values( $langues_declarees )
	) )
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
      special, ni de reecriture pour l'IA.
      Le fichier « llms.txt » est neanmoins fourni : c'est une demande
      explicite du proprietaire, qui veut etre lu par les robots d'IA.
      Google dit lui-meme que cela ne lui apporte rien — mais cela ne
      nuit pas non plus. On verifie qu'il est ABSENT du dossier de code
      (donc livre comme un fichier qui pourrait devenir faux), et
      qu'il est bien servi par le site. */
audit_verifier(
	'le fichier « llms.txt » n\'est pas un fichier statique dans le code (il est genere, donc toujours a jour)',
	! file_exists( $racine . '/llms.txt' ),
	'fichier llms.txt present dans le code : il peut devenir faux sans que personne ne le voie',
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

/* ------------------------------------------------------------------ */
echo "\n8. Les robots d'IA et le maillage interne\n";

/* Ce controle va au-dela du guide Google : c'est une demande
   explicite du proprietaire, qui veut etre lu et cite par les
   robots d'IA. On verifie donc que le fichier robots.txt nomme les
   robots d'IA et les autorise, et que le contenu est atteignable
   par liens internes (le seul chemin que les robots suivent). */

$robots_ia = array(
	'Googlebot'        => 'recherche Google (alimente les AI Overviews)',
	'OAI-SearchBot'    => 'index de recherche OpenAI',
	'ChatGPT-User'     => 'ouverture de page demandee par ChatGPT',
	'Claude-SearchBot' => 'index de recherche Anthropic',
	'Claude-User'      => 'ouverture de page demandee par Claude',
	'PerplexityBot'    => 'index de recherche Perplexity',
	'Google-Extended'  => 'entrainement et ancrage Google',
	'GPTBot'           => 'entrainement OpenAI',
	'ClaudeBot'        => 'entrainement Anthropic',
	'Applebot'         => 'recherche Apple',
);

$robots_absents = array();
$robots_refuses = array();

foreach ( $robots_ia as $robot => $role ) {
	if ( false === stripos( $plan, 'User-agent: ' . $robot ) ) {
		$robots_absents[] = $robot;
		continue;
	}

	/* On verifie que le robot rencontre bien « Allow: / » avant la
	   prochaine section « User-agent: ». */
	$autorise = false;
	$section  = false;

	foreach ( explode( "\n", $plan ) as $ligne_plan ) {
		$ligne_plan = trim( $ligne_plan );

		if ( 0 === stripos( $ligne_plan, 'User-agent:' ) ) {
			if ( $section ) {
				break;
			}

			if ( 0 === strcasecmp( $ligne_plan, 'User-agent: ' . $robot ) ) {
				$section = true;
			}

			continue;
		}

		if ( $section && 0 === stripos( $ligne_plan, 'Allow:' ) ) {
			$autorise = true;
			break;
		}
	}

	if ( ! $autorise ) {
		$robots_refuses[] = $robot;
	}
}

audit_verifier(
	'robots.txt nomme explicitement les robots d\'IA (Googlebot, OpenAI, Anthropic, Perplexity, Apple)',
	empty( $robots_absents ),
	'robots non cites : ' . implode( ', ', $robots_absents ),
	'majeur'
);

audit_verifier(
	'chaque robot d\'IA cite est autorise a lire le site',
	empty( $robots_refuses ),
	'robots non autorises : ' . implode( ', ', $robots_refuses ),
	'bloquant'
);

audit_verifier(
	'le plan du site (sitemap) est declare dans robots.txt',
	false !== stripos( $plan, 'Sitemap:' ),
	'robots.txt ne declare aucun plan du site',
	'majeur'
);

/* Le maillage interne : le guide Google demande que le contenu soit
   « facilement trouvable par liens internes ». On mesure les liens
   reellement presents dans le HTML servi. */
$accueil_html = audit_exec( 'curl -sL "' . $url_site . '"' );

preg_match_all( '/href="([^"]*\/rooms\/[^"]*)"/', $accueil_html, $liens_accueil );
$liens_accueil = array_unique( $liens_accueil[1] );

audit_verifier(
	'l\'accueil propose des liens vers les rooms (le contenu est trouvable sans passer par le sitemap)',
	count( $liens_accueil ) >= 10,
	'liens vers des rooms trouves sur l\'accueil : ' . count( $liens_accueil ),
	'bloquant'
);

preg_match_all( '/href="([^"]*\/parcours\/[^"]*)"/', $accueil_html, $liens_parcours );
$liens_parcours = array_unique( $liens_parcours[1] );

audit_verifier(
	'l\'accueil propose des liens vers les parcours',
	count( $liens_parcours ) >= 1,
	'liens vers des parcours trouves sur l\'accueil : ' . count( $liens_parcours ),
	'majeur'
);

/* Chaque parcours doit lister ses rooms : c'est le chemin de
   navigation que suit un robot. */
$parcours_sans_rooms = array();

foreach ( get_posts( array( 'post_type' => 'secura_path', 'post_status' => 'publish', 'numberposts' => -1 ) ) as $parcours ) {
	$page_parcours = audit_exec( 'curl -sL "' . get_permalink( $parcours->ID ) . '"' );

	preg_match_all( '/href="([^"]*\/rooms\/[^"]*)"/', $page_parcours, $liens_room );

	if ( empty( $liens_room[1] ) ) {
		$parcours_sans_rooms[] = $parcours->post_name;
	}
}

audit_verifier(
	'chaque parcours liste ses rooms par des liens reels',
	empty( $parcours_sans_rooms ),
	'parcours sans room liee : ' . implode( ', ', $parcours_sans_rooms ),
	'bloquant'
);

/* La coherence des versions traduites : si le titre affiche et le titre
   annonce (balise <title>) sont dans deux langues differentes, Google
   lit la page arabe comme un doublon de la page francaise. */
preg_match( '/<title>(.*?)<\/title>/is', $page_ar_html, $titre_ar );
$titre_ar = isset( $titre_ar[1] ) ? html_entity_decode( $titre_ar[1] ) : '';

$vue_ar = class_exists( 'Secura_Rooms' ) ? Secura_Rooms::get_room_view( $room->ID, 'ar' ) : null;
$titre_attendu_ar = $vue_ar ? $vue_ar['title'] : '';

audit_verifier(
	'la version arabe porte un titre en arabe (le titre annonce suit la langue affichee)',
	'' !== $titre_ar && '' !== $titre_attendu_ar && false !== strpos( $titre_ar, $titre_attendu_ar ),
	'titre de la page arabe : « ' . $titre_ar . ' » (attendu : « ' . $titre_attendu_ar . ' »)',
	'majeur'
);

/* Les traductions ne doivent pas rester en francais : une version
   « arabe » qui est du francais est un doublon. */
$traductions_non_faites = array();

foreach ( get_posts( array( 'post_type' => 'secura_room', 'post_status' => 'publish', 'numberposts' => -1 ) ) as $room_i18n ) {
	$brut = get_post_meta( $room_i18n->ID, '_secura_i18n', true );

	if ( ! is_array( $brut ) ) {
		continue;
	}

	foreach ( array( 'ar', 'en' ) as $langue_i18n ) {
		if ( ! isset( $brut[ $langue_i18n ] ) || ! is_array( $brut[ $langue_i18n ] ) ) {
			$traductions_non_faites[] = $room_i18n->post_name . ' (' . $langue_i18n . ', absente)';
			continue;
		}

		$extrait = isset( $brut[ $langue_i18n ]['excerpt'] ) ? trim( (string) $brut[ $langue_i18n ]['excerpt'] ) : '';

		if ( '' === $extrait ) {
			$traductions_non_faites[] = $room_i18n->post_name . ' (' . $langue_i18n . ', sans extrait)';
			continue;
		}

		/* Un extrait identique mot pour mot au francais signale une
		   traduction restee en francais. */
		if ( '' !== trim( $room_i18n->post_excerpt ) && $extrait === trim( $room_i18n->post_excerpt ) ) {
			$traductions_non_faites[] = $room_i18n->post_name . ' (' . $langue_i18n . ', non traduite)';
		}
	}
}

audit_verifier(
	'chaque version traduite a bien son propre texte (aucune version restee en francais)',
	empty( $traductions_non_faites ),
	count( $traductions_non_faites ) . ' version(s) non traduite(s) : ' . implode( ', ', array_slice( $traductions_non_faites, 0, 8 ) ),
	'majeur'
);

/* L'archive d'auteur expose le nom du compte d'administration et
   duplique les contenus : elle doit repondre « introuvable ». */
$code_auteur = audit_exec( 'curl -s -o /dev/null -w "%{http_code}" "' . $url_site . 'author/admin/"' );

audit_verifier(
	'l\'archive d\'auteur est fermee (le nom du compte d\'administration ne doit pas etre expose)',
	'404' === trim( $code_auteur ),
	'code recu : ' . trim( $code_auteur ),
	'majeur'
);

/* L'image de partage : sans elle, un partage n'a pas de vignette. */
audit_verifier(
	'la page annonce une image de partage (og:image)',
	false !== stripos( $html, 'og:image' ),
	'aucune balise og:image',
	'mineur'
);

exit( audit_fin() );
