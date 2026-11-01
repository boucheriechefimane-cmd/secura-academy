<?php
/**
 * Verifie le maillage interne du site tel qu'un robot le voit.
 *
 * Ce controle ne simule rien : il telecharge les pages comme un robot
 * et compte les liens reels.
 *
 * @package Secura_Academy
 */

$racine = isset( $argv[1] ) ? rtrim( $argv[1], '/' ) : 'http://localhost:8080';

/**
 * Telecharge une page et renvoie son corps.
 *
 * @param string $url L'adresse.
 * @return string
 */
function secular_http( $url ) {
	$ch = curl_init( $url );
	curl_setopt_array(
		$ch,
		array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_TIMEOUT        => 20,
			CURLOPT_USERAGENT      => 'SecuraAcademyAudit/1.0',
		)
	);
	$body = curl_exec( $ch );
	curl_close( $ch );

	return (string) $body;
}

/**
 * Les liens internes (meme site) trouves dans une page.
 *
 * @param string $html   Le corps de la page.
 * @param string $racine L'adresse du site.
 * @return array
 */
function secular_liens( $html, $racine ) {
	$liens = array();

	if ( preg_match_all( '/href="([^"]+)"/i', $html, $matches ) ) {
		foreach ( $matches[1] as $href ) {
			$href = html_entity_decode( $href );

			if ( 0 !== strpos( $href, $racine ) ) {
				continue;
			}

			$chemin = substr( $href, strlen( $racine ) );
			$chemin = explode( '#', $chemin )[0];
			$chemin = explode( '?', $chemin )[0];

			if ( '' === $chemin ) {
				continue;
			}

			$liens[ $chemin ] = true;
		}
	}

	return array_keys( $liens );
}

$constats = array();

echo "Verification du maillage interne sur " . $racine . "\n\n";

/* 1. L'accueil doit mener aux rooms. */
$accueil = secular_http( $racine . '/' );
$liens_accueil = secular_liens( $accueil, $racine );
$rooms_accueil  = array_filter( $liens_accueil, function ( $l ) {
	return 0 === strpos( $l, '/rooms/' );
} );

printf( "Accueil : %d liens internes, dont %d vers des rooms\n", count( $liens_accueil ), count( $rooms_accueil ) );

if ( count( $rooms_accueil ) < 10 ) {
	$constats[] = 'ACCUEIL : l\'accueil ne propose que ' . count( $rooms_accueil ) . ' liens vers des rooms.';
}

/* 2. La page /parcours/ doit exister et mener aux parcours. */
$parcours = secular_http( $racine . '/parcours/' );
$statut    = secular_http( $racine . '/parcours/' );

$liens_parcours = secular_liens( $parcours, $racine );
$paths_parcours = array_filter( $liens_parcours, function ( $l ) {
	return 0 === strpos( $l, '/parcours/' ) && '/parcours/' !== $l;
} );

printf( "Page /parcours/ : %d liens, dont %d vers des pages de parcours\n", count( $liens_parcours ), count( $paths_parcours ) );

if ( count( $paths_parcours ) < 1 ) {
	$constats[] = 'PARCOURS : la page /parcours/ ne renvoie vers aucun parcours.';
}

/* 3. Chaque parcours doit lister ses rooms. */
$sitemap = secular_http( $racine . '/wp-sitemap-posts-secura_path-1.xml' );
preg_match_all( '#<loc>([^<]+)</loc>#', $sitemap, $m );
$urls_parcours = $m[1];

printf( "Parcours trouves dans le plan du site : %d\n", count( $urls_parcours ) );

$total_rooms_liees = 0;

foreach ( $urls_parcours as $url ) {
	$page = secular_http( $url );
	$liens = secular_liens( $page, $racine );
	$rooms = array_filter( $liens, function ( $l ) {
		return 0 === strpos( $l, '/rooms/' );
	} );

	$total_rooms_liees += count( $rooms );

	printf( "  %-62s %d rooms liees\n", substr( $url, strlen( $racine ) ), count( $rooms ) );

	if ( count( $rooms ) < 1 ) {
		$constats[] = 'MAILLAGE : le parcours ' . substr( $url, strlen( $racine ) ) . ' ne lie aucune room.';
	}
}

/* 4. Chaque room doit etre liee depuis au moins un parcours. */
$sitemap_rooms = secular_http( $racine . '/wp-sitemap-posts-secura_room-1.xml' );
preg_match_all( '#<loc>([^<]+)</loc>#', $sitemap_rooms, $mr );
$urls_rooms = $mr[1];

printf( "\nRooms dans le plan du site : %d\n", count( $urls_rooms ) );

$liees = 0;
$orphelines = array();

foreach ( $urls_rooms as $url_rooms ) {
	$chemin = substr( $url_rooms, strlen( $racine ) );
	$trouve = false;

	foreach ( $urls_parcours as $url ) {
		$page = secular_http( $url );

		if ( false !== strpos( $page, $url_rooms ) ) {
			$trouve = true;
			break;
		}
	}

	if ( $trouve ) {
		$liees++;
	} else {
		$orphelines[] = $chemin;
	}
}

printf( "Rooms liees depuis un parcours : %d / %d\n", $liees, count( $urls_rooms ) );

foreach ( $orphelines as $orpheline ) {
	$constats[] = 'ORPHELINE : la room ' . $orpheline . ' n\'est liee depuis aucun parcours.';
}

/* 5. L'archive d'auteur ne doit pas exister. */
$auteur = secular_http( $racine . '/author/admin/' );

/* Un gabarit 404 contient le titre « Cette page n'existe pas » ;
   une archive d'auteur, elle, affiche le nom de l'auteur et ses
   articles. On cherche donc la marque de l'archive, pas l'absence de
   mot « author » (qui apparait partout dans le code du theme). */
if ( false !== strpos( $auteur, 'author-archive' ) || false !== strpos( $auteur, 'class="author' ) || false !== strpos( $auteur, 'Posts par' ) ) {
	echo "Archive d'auteur : OUVERTE (a corriger)\n";
	$constats[] = 'AUTEUR : /author/admin/ repond encore.';
} else {
	echo "Archive d'auteur : fermee\n";
}

echo "\n";

if ( empty( $constats ) ) {
	echo "RESULTAT : maillage interne conforme, 0 constat.\n";
	exit( 0 );
}

echo "RESULTAT : " . count( $constats ) . " constat(s).\n";

foreach ( $constats as $constat ) {
	echo "  - " . $constat . "\n";
}

exit( 1 );
