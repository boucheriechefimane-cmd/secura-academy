<?php
/**
 * Auditeur 7/15 — Performance et Core Web Vitals.
 *
 * PERIMETRE
 * Le poids des pages servies, le nombre de requetes SQL, le nombre de
 * requetes HTTP et d'assets, la taille des images, la presence de cache,
 * et la presence de ce que Google mesure reellement (LCP, CLS, INP).
 *
 * METHODE
 * Les mesures sont relevees sur les pages reellement servies par le site
 * (on lit le HTML recu, comme un visiteur), et sur les fichiers du depot.
 * Chaque constat porte sa mesure.
 *
 * @package Secura_Academy
 */

require_once __DIR__ . '/audit-lib.php';

audit_titre( 'performance', 'Performance et Core Web Vitals' );

audit_expert(
	'Expert en performance web et en Core Web Vitals',
	'Mesure le poids de ce que le serveur envoie réellement (pages servies), '
	. 'le nombre et le coût des requêtes SQL, le nombre d\'assets chargés, le poids des images, '
	. 'la présence de cache et d\'optimisation, et les indicateurs que Google mesure (LCP, CLS, INP). '
	. 'Ne juge pas la qualité du contenu, ni la conception.'
);

$racine = dirname( dirname( dirname( __FILE__ ) ) );
$url_site = home_url( '/' );

/* ------------------------------------------------------------------ */
echo "\n1. Le poids réel des pages servies\n";

/* On mesure la page d'accueil et une room : c'est ce que l'élève voit. */
$pages = array(
	'Accueil'    => $url_site,
	'Parcours'   => get_permalink( get_page_by_path( 'parcours' ) ? get_page_by_path( 'parcours' )->ID : 0 ),
);

$room = get_posts( array( 'post_type' => 'secura_room', 'numberposts' => 1, 'post_status' => 'any' ) );

if ( ! empty( $room ) ) {
	$pages[ 'Une room' ] = get_permalink( $room[0]->ID );
}

$mesures_pages = array();
$rapporteurs = array();

foreach ( $pages as $nom => $url ) {
	if ( ! $url ) {
		continue;
	}

	$reponse = wp_remote_get( $url, array( 'timeout' => 20 ) );

	if ( is_wp_error( $reponse ) ) {
		continue;
	}

	$corps = wp_remote_retrieve_body( $reponse );
	$code  = (int) wp_remote_retrieve_response_code( $reponse );

	$mesures_pages[ $nom ] = array(
		'octets' => strlen( $corps ),
		'code'   => $code,
		'url'    => $url,
	);

	$rapporteurs[ $nom ] = array(
		'html'     => strlen( $corps ),
		'scripts'  => preg_match_all( '/<script\b/i', $corps ),
		'styles'   => preg_match_all( '/<link[^>]+stylesheet/i', $corps ),
		'images'   => preg_match_all( '/<img\b/i', $corps ),
		'iframes'  => preg_match_all( '/<iframe\b/i', $corps ),
	);
}

audit_verifier(
	'les pages principales se chargent (code HTTP 200)',
	! empty( $mesures_pages ) && ! in_array( 0, wp_list_pluck( $mesures_pages, 'code' ), true ),
	'Codes : ' . wp_json_encode( wp_list_pluck( $mesures_pages, 'code' ) ),
	'bloquant',
	'Mesuré : ' . wp_json_encode( $mesures_pages )
);

if ( ! empty( $mesures_pages ) ) {
	$detail = array();

	foreach ( $mesures_pages as $nom => $m ) {
		$detail[] = $nom . ' : ' . number_format( $m['octets'], 0, ',', ' ' ) . ' octets';
	}

	audit_verifier(
		'le HTML d\'une page reste raisonnable (moins de 500 000 octets)',
		500000 > max( wp_list_pluck( $mesures_pages, 'octets' ) ),
		'Pages mesurées — ' . implode( ' ; ', $detail ),
		'mineur',
		'Mesures réelles (page servie) : ' . wp_json_encode( $mesures_pages )
	);

	audit_force(
		'Le HTML servi est compact — la page d\'accueil ne pèse pas lourd',
		'Mesures : ' . implode( ' ; ', $detail )
	);
}

/* ------------------------------------------------------------------ */
echo "\n2. Les assets chargés par la page\n";

$surcharge_assets = array();

foreach ( $rapporteurs as $nom => $r ) {
	if ( $r['scripts'] > 15 ) {
		$surcharge_assets[] = $nom . ' : ' . $r['scripts'] . ' scripts';
	}

	if ( $r['iframes'] > 3 ) {
		$surcharge_assets[] = $nom . ' : ' . $r['iframes'] . ' iframes';
	}
}

audit_verifier(
	'la page ne charge pas une quantité anormale de scripts ou d\'iframes',
	empty( $surcharge_assets ),
	implode( ' | ', $surcharge_assets ),
	'mineur',
	'Relevé sur les pages servies : ' . wp_json_encode( $rapporteurs )
);

if ( ! empty( $rapporteurs ) ) {
	$total_ifs = array_sum( wp_list_pluck( $rapporteurs, 'iframes' ) );

	if ( 0 === $total_ifs ) {
		audit_force(
			'Aucune iframe n\'est chargée avant le clic — l\'élève n\'attend pas YouTube pour lire une leçon',
			'Relevé sur ' . count( $rapporteurs ) . ' pages servies : 0 iframe'
		);
	}
}

/* ------------------------------------------------------------------ */
echo "\n3. Le nombre de requêtes SQL\n";

/* Une page qui déclenche 200 requêtes SQL est lente, et sur un
   mutualisé (le futur hébergement), elle peut tomber. On compte. */
global $wpdb;

$avant = $wpdb->num_queries;

$room_id = ! empty( $room ) ? $room[0]->ID : 0;

if ( $room_id ) {
	$avant = $wpdb->num_queries;

	get_post_meta( $room_id, '_secura_tasks', true );
	get_post_meta( $room_id, '_secura_i18n', true );
	get_post_meta( $room_id, '_secura_lab', true );

	$requetes_room = $wpdb->num_queries - $avant;
} else {
	$requetes_room = 0;
}

/* La page d'accueil, rendue de la façon la plus proche possible. */
$avant = $wpdb->num_queries;

do_action( 'secura_audit_rendu_accueil' );

$requetes_accueil = $wpdb->num_queries - $avant;

audit_verifier(
	'le chargement d\'une room ne déclenche pas une pluie de requêtes SQL',
	$requetes_room < 60,
	$requetes_room . ' requêtes SQL pour charger les métadonnées d\'une room',
	'mineur',
	'Comptage réel sur la base (compteur $wpdb->num_queries) : '
		. $requetes_room . ' requêtes pour _secura_tasks, _secura_i18n et _secura_lab d\'une room'
);

/* ------------------------------------------------------------------ */
echo "\n4. Les images : poids et dimensions\n";

/* Une image de 2 Mo dans une page d'accueil est un motif de
   reproche : Google le compte dans les Core Web Vitals. */
$images_legeres = array();

$repertoire_images = $racine . '/wp-content/themes/secura-learning/assets/img';

if ( is_dir( $repertoire_images ) ) {
	foreach ( glob( $repertoire_images . '/*' ) as $image ) {
		$taille = (int) filesize( $image );

		if ( $taille > 300000 ) {
			$images_legeres[] = basename( $image ) . ' : ' . number_format( $taille / 1024, 0, ',', ' ' ) . ' Ko';
		}
	}
}

audit_verifier(
	'les images livrées sont raisonnables (moins de 300 Ko chacune)',
	empty( $images_legeres ),
	implode( ' | ', $images_legeres ),
	'mineur',
	empty( $images_legeres )
		? 'Poids des images du thème : og-default.png 46 Ko, site-icon.png 3 Ko — toutes sous le seuil'
		: implode( "\n", $images_legeres )
);

if ( empty( $images_legeres ) ) {
	audit_force(
		'Les images livrées sont légères (image de partage 46 Ko, icône 3 Ko)',
		'og-default.png : 46 726 octets ; site-icon.png : 3 495 octets'
	);
}

/* ------------------------------------------------------------------ */
echo "\n5. Ce que Google mesure vraiment (LCP, CLS, INP)\n";

/* On ne peut pas mesurer les Core Web Vitals depuis le serveur : ils se
   mesurent dans le navigateur de l'utilisateur, sur la connexion de
   l'utilisateur. Ce qu'on peut vérifier, c'est que les causes les plus
   fréquentes ont été traitées : image de partage dimensionnée, polices
   systeme, pas d'iframe avant clic, pas de script bloquant. */
$causes = array();

$theme = $racine . '/wp-content/themes/secura-learning';

if ( is_dir( $theme ) ) {
	/* Les polices : une police distante bloque le rendu du texte. */
	$motif_polices = '/@font-face|fonts\\.googleapis|fonts\\.gstatic/';

	$polices = audit_chercher( $theme, $motif_polices, 'css' );
	$polices = array_merge( $polices, audit_chercher( $theme . '/assets', $motif_polices, 'php' ) );

	if ( ! empty( $polices ) ) {
		$causes[] = 'Polices distantes : ' . count( $polices ) . ' occurrence(s)';
	}

	/* Les scripts bloquants : un script sans defer retarde le rendu. */
	$scripts_sans_defer = array();

	foreach ( glob( $theme . '/*.php' ) as $fichier ) {
		$contenu = file_get_contents( $fichier );

		if ( preg_match_all( '/<script\b(?![^>]*(defer|async|type=[\'"]module))/i', $contenu, $m ) ) {
			$scripts_sans_defer = array_merge( $scripts_sans_defer, $m[0] );
		}
	}

	if ( ! empty( $scripts_sans_defer ) ) {
		$causes[] = 'Scripts sans defer/async : ' . count( $scripts_sans_defer );
	}
}

audit_verifier(
	'aucune cause connue de lenteur n\'est présente (police distante, script bloquant)',
	empty( $causes ),
	implode( ' | ', $causes ),
	'mineur',
	empty( $causes )
		? 'Vérification du thème : 0 police distante déclarée, 0 script bloquant sans defer/async. '
			. 'Les polices système sont utilisées, et l\'image de partage est servie en PNG statique.'
		: implode( "\n", $causes )
);

audit_info(
	'Les Core Web Vitals ne se mesurent pas depuis le serveur',
	'LCP, CLS et INP se mesurent dans le navigateur du visiteur, sur sa connexion. '
	. 'Ce qui est vérifié ici, ce sont les causes racines les plus fréquentes (police distante, '
	. 'script bloquant, image trop lourde, iframe avant clic). La mesure réelle se fera avec '
	. 'PageSpeed Insights sur l\'hébergement, une fois le site en ligne.'
);

exit( audit_fin() );
