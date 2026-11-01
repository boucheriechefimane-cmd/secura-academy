<?php
/**
 * Secura Learning — fonctions du thème.
 *
 * @package Secura_Learning
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SECURA_LEARNING_VERSION', '0.7.0' );

/**
 * Déclare les fonctionnalités du thème.
 */
function secures_learning_setup() {
	load_theme_textdomain( 'secura-learning', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 64,
			'width'       => 64,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);

	register_nav_menus(
		array(
			'primary' => __( 'Menu principal', 'secura-learning' ),
			'footer'  => __( 'Menu de pied de page', 'secura-learning' ),
		)
	);
}
add_action( 'after_setup_theme', 'secures_learning_setup' );

/* ----------------------------------------------------------------------
 * Visibilité : ce que les moteurs et les réseaux sociaux voient.
 *
 * Sans ces balises, un moteur invente le résumé d'une room, et un
 * partage sur WhatsApp ou Facebook s'affiche sans titre niaperçu.
 * -------------------------------------------------------------------- */

/**
 * La description de la page, la carte de partage et les versions
 * dans d'autres langues (hreflang).
 */
/**
 * Le sens de lecture du document.
 *
 * La direction d'ecriture est une propriete du DOCUMENT, pas d'un
 * bloc a l'interieur : elle doit etre portee par la balise <html>.
 *
 * WordPress ne le fait pas de lui-meme : sans cela, une page de
 * contenu servie en arabe (les pages legales, un article) s'affiche
 * de gauche a droite, avec la ponctuation a l'envers. C'est le
 * defaut le plus visible de la version arabe.
 *
 * @return string ltr ou rtl.
 */
function secures_learning_direction() {
	if ( class_exists( 'Secura_I18n' ) ) {
		return Secura_I18n::direction();
	}

	return 'ltr';
}

/**
 * Les balises meta de la page.
 */
function secures_learning_meta_tags() {
	$est_room = is_singular( 'secura_room' );
	$est_path = is_singular( 'secura_path' );
	$titre    = $est_room ? get_the_title() : wp_get_document_title();
	$url      = ( $est_room || $est_path ) ? get_permalink() : home_url( '/' );

	/* Le titre et le resume doivent etre dans la meme langue que le
	   texte affiche. Sans cela, la version arabe porte un titre et une
	   description en francais : Google la lit alors comme un doublon
	   de la version francaise, et ne l'indexe pas.

	   On interroge donc le plugin, qui connait la traduction ; et on
	   retombe sur le texte d'origine si le plugin est absent. */
	/* L'identifiant vient de la requete, pas de la boucle : au moment
	   du <head>, la boucle WordPress n'a pas encore demarre. */
	$id = get_queried_object_id();

	if ( $est_room && class_exists( 'Secura_Rooms' ) ) {
		$vue = Secura_Rooms::get_room_view( $id );

		if ( $vue ) {
			$titre = $vue['title'];
		}
	}

	if ( $est_path && class_exists( 'Secura_Paths' ) ) {
		$vue = Secura_Paths::get_path_view( $id );

		if ( $vue ) {
			$titre = $vue['title'];
		}
	}

	/* Le resume : celui de la room, ou celui du site. */
	$description = '';

	if ( $est_room ) {
		$description = get_the_excerpt();

		if ( class_exists( 'Secura_Rooms' ) ) {
			$vue = Secura_Rooms::get_room_view( $id );

			if ( $vue && '' !== trim( (string) $vue['excerpt'] ) ) {
				$description = $vue['excerpt'];
			}
		}
	}

	if ( $est_path ) {
		$description = get_the_excerpt();

		if ( class_exists( 'Secura_Paths' ) ) {
			$vue = Secura_Paths::get_path_view( $id );

			if ( $vue && '' !== trim( (string) $vue['excerpt'] ) ) {
				$description = $vue['excerpt'];
			}
		}
	}

	if ( '' === trim( (string) $description ) ) {
		$description = get_bloginfo( 'description' );
	}

	if ( '' === trim( (string) $description ) ) {
		$description = __( 'Plateforme gratuite et multilingue d\'apprentissage de la cybersecurite.', 'secura-learning' );
	}

	$description = wp_strip_all_tags( $description );

	printf(
		'<meta name="description" content="%s">' . "\n",
		esc_attr( wp_html_excerpt( $description, 160, '…' ) )
	);

	/* La carte de partage (Facebook, WhatsApp, LinkedIn, X). */
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
	printf( '<meta property="og:type" content="%s">' . "\n", esc_attr( $est_room ? 'article' : 'website' ) );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $titre ) );
	printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( wp_html_excerpt( $description, 160, '…' ) ) );
	printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $url ) );
	printf( '<meta property="og:locale" content="%s">' . "\n", esc_attr( str_replace( '-', '_', determine_locale() ) ) );

	/* L'image de partage : l'icone du site si l'enseignant en a mis une,
	   sinon le visuel livre avec le theme. Sans image, un partage sur
	   WhatsApp ou Facebook s'affiche sans vignette — et une reponse
	   generee par l'IA s'affiche elle aussi sans visuel. */
	$icone = get_site_icon_url( 512 );

	if ( ! $icone ) {
		$icone = get_template_directory_uri() . '/assets/img/og-default.png';
	}

	printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $icone ) );
	printf( '<meta property="og:image:width" content="1200">' . "\n" );
	printf( '<meta property="og:image:height" content="630">' . "\n" );
	printf( '<meta property="og:image:alt" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );

	/* La carte Twitter / X. */
	printf( '<meta name="twitter:card" content="%s">' . "\n", 'summary_large_image' );
	printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $titre ) );
	printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( wp_html_excerpt( $description, 160, '…' ) ) );

	if ( $icone ) {
		printf( '<meta name="twitter:image" content="%s">' . "\n", esc_url( $icone ) );
	}

	/* Les versions dans d'autres langues : sans cela, un moteur peut
	   traiter la version arabe comme un doublon de la version
	   francaise.

	   Deux règles que Google impose :
	   - les adresses doivent etre ABSOLUES (une adresse relative est
	     ignoree) ;
	   - chaque version doit se designer elle-meme (canonique
	     auto-reference), sinon la version arabe estConsideree comme
	     un doublon de la version francaise et n'est pas indexee. */
	/* L'adresse est deja absolue : remove_query_arg la renvoie telle quelle. */
	$base = remove_query_arg( 'seca_lang', $url );

	foreach ( array(
		'fr' => $base,
		'ar' => add_query_arg( 'seca_lang', 'ar', $base ),
		'en' => add_query_arg( 'seca_lang', 'en', $base ),
	) as $langue => $adresse ) {
		printf(
			'<link rel="alternate" hreflang="%s" href="%s">' . "\n",
			esc_attr( $langue ),
			esc_url( $adresse )
		);
	}

	printf( '<link rel="alternate" hreflang="x-default" href="%s">' . "\n", esc_url( $base ) );

	/* L'adresse de reference de cette page : elle se designe
	   elle-meme, dans sa langue. */
	$canonique = $base;

	if ( isset( $_GET['seca_lang'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- lecture seule, pour l'adresse canonique.
		$langue = substr( sanitize_key( wp_unslash( $_GET['seca_lang'] ) ), 0, 2 );

		if ( in_array( $langue, array( 'ar', 'en' ), true ) ) {
			$canonique = add_query_arg( 'seca_lang', $langue, $base );
		}
	}

	printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $canonique ) );
}
add_action( 'wp_head', 'secures_learning_meta_tags', 1 );

/**
 * La balise title dans la langue affichee.
 *
 * WordPress fabrique lui-meme le titre de l onglet, a partir du titre
 * du billet d origine : sur la version arabe, l onglet affiche donc
 * encore le titre francais. Google compare le titre de l onglet au
 * texte de la page : quand ils different de langue, la page arabe
 * passe pour un doublon. On remplace donc le titre par sa traduction.
 *
 * @param string $titre Le titre fabrique par WordPress.
 * @return string
 */
function secures_learning_document_title( $titre ) {
	if ( ! class_exists( 'Secura_Rooms' ) && ! class_exists( 'Secura_Paths' ) ) {
		return $titre;
	}

	$id = get_queried_object_id();

	if ( is_singular( 'secura_room' ) ) {
		$vue = Secura_Rooms::get_room_view( $id );
	} elseif ( is_singular( 'secura_path' ) ) {
		$vue = Secura_Paths::get_path_view( $id );
	} else {
		return $titre;
	}

	if ( $vue && '' !== trim( (string) $vue['title'] ) ) {
		return $vue['title'];
	}

	return $titre;
}
add_filter( 'pre_get_document_title', 'secures_learning_document_title' );

/* WordPress ajoute sa propre balise canonique, qui ignore la langue :
   la version arabe serait alors designee comme un doublon de la version
   francaise. On la retire pour garder la nôtre, qui sait, elle, que
   chaque langue se reference elle-meme. */
remove_action( 'wp_head', 'rel_canonical' );

/**
 * Les en-tetes de securite du site.
 *
 * Pas de cadres externes (clickjacking), pas de reanalyse de type
 * MIME, et une politique de referant qui ne dit pas a quel site tiers
 * l'eleve vient.
 */
function secures_learning_security_headers() {
	if ( headers_sent() ) {
		return;
	}

	header( 'X-Frame-Options: SAMEORIGIN' );
	header( 'X-Content-Type-Options: nosniff' );
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );
	header( 'Permissions-Policy: geolocation=(), microphone=(), camera=()' );
}
add_action( 'send_headers', 'secures_learning_security_headers' );

/**
 * Le choix de la langue : de vrais liens (donc utilisables meme sans
 * JavaScript, et repérables par un moteur).
 *
 * @return string
 */
function secures_learning_language_switcher() {
	$base   = remove_query_arg( 'seca_lang' );
	$actuel = substr( (string) determine_locale(), 0, 2 );

	$langues = array(
		'fr' => __( 'Francais', 'secura-learning' ),
		'ar' => __( 'Arabe', 'secura-learning' ),
		'en' => __( 'Anglais', 'secura-learning' ),
	);

	$html = '<nav class="site-lang" aria-label="' . esc_attr__( 'Choisir la langue', 'secura-learning' ) . '">';

	foreach ( $langues as $code => $nom ) {
		$adresse = ( 'fr' === $code ) ? $base : add_query_arg( 'seca_lang', $code, $base );
		$actif   = ( $code === $actuel );

		$html .= sprintf(
			'<a class="site-lang__link%s" href="%s" hreflang="%s"%s>%s</a>',
			$actif ? ' is-active' : '',
			esc_url( $adresse ),
			esc_attr( $code ),
			$actif ? ' aria-current="true"' : '',
			esc_html( $nom )
		);
	}

	$html .= '</nav>';

	return $html;
}

/**
 * Charge la feuille de style du thème.
 */
function secures_learning_assets() {
	wp_enqueue_style(
		'secura-learning-style',
		get_stylesheet_uri(),
		array(),
		SECURA_LEARNING_VERSION
	);

	/* Ajustements RTL (arabe) : chargés en plus de la feuille de base. */
	if ( is_rtl() ) {
		wp_enqueue_style(
			'secura-learning-rtl',
			get_template_directory() . '/style-rtl.css',
			array( 'secura-learning-style' ),
			SECURA_LEARNING_VERSION
		);
	}
}
add_action( 'wp_enqueue_scripts', 'secures_learning_assets' );

/**
 * Palette modifiable via Apparence → Personnaliser.
 *
 * @param WP_Customize_Manager $wp_customize Personnaliseur.
 */
function secures_learning_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'secura_palette',
		array(
			'title'       => __( 'Palette Secura', 'secura-learning' ),
			'description' => __( 'Couleurs utilisées par le thème et par le tableau de bord du plugin Secura Academy.', 'secura-learning' ),
			'priority'    => 30,
		)
	);

	$colors = array(
		'secura_accent_color'   => array(
			'label'  => __( 'Couleur d\'accent', 'secura-learning' ),
			'default' => '#2dd4a7',
		),
		'secura_bg_color'       => array(
			'label'  => __( 'Fond principal', 'secura-learning' ),
			'default' => '#0b1220',
		),
		'secura_surface_color'  => array(
			'label'  => __( 'Surfaces (cartes, panneaux)', 'secura-learning' ),
			'default' => '#131c2e',
		),
		'secura_border_color'   => array(
			'label'  => __( 'Bordures', 'secura-learning' ),
			'default' => '#26344f',
		),
		'secura_text_color'     => array(
			'label'  => __( 'Texte principal', 'secura-learning' ),
			'default' => '#e9eefc',
		),
		'secura_muted_color'    => array(
			'label'  => __( 'Texte secondaire', 'secura-learning' ),
			'default' => '#9db0d0',
		),
	);

	foreach ( $colors as $setting_id => $data ) {
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $data['default'],
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$setting_id,
				array(
					'label'   => $data['label'],
					'section' => 'secura_palette',
				)
			)
		);
	}
}
add_action( 'customize_register', 'secures_learning_customize_register' );

/**
 * Injecte les variables CSS issues du Personnaliseur.
 */
function secures_learning_inline_styles() {
	$accent  = get_theme_mod( 'secura_accent_color', '#2dd4a7' );
	$bg      = get_theme_mod( 'secura_bg_color', '#0b1220' );
	$surface = get_theme_mod( 'secura_surface_color', '#131c2e' );
	$border  = get_theme_mod( 'secura_border_color', '#26344f' );
	$text    = get_theme_mod( 'secura_text_color', '#e9eefc' );
	$muted   = get_theme_mod( 'secura_muted_color', '#9db0d0' );

	$surface_2 = $surface;

	$css = ':root{'
		. '--secura-accent:' . $accent . ';'
		. '--secura-bg:' . $bg . ';'
		. '--secura-surface:' . $surface . ';'
		. '--secura-surface-2:' . $surface_2 . ';'
		. '--secura-border:' . $border . ';'
		. '--secura-text:' . $text . ';'
		. '--secura-muted:' . $muted . ';'
		. '}';

	wp_add_inline_style( 'secura-learning-style', $css );
}
add_action( 'wp_enqueue_scripts', 'secures_learning_inline_styles', 20 );

/**
 * Menu de repli si aucun menu n'est défini.
 */
function secures_learning_menu_fallback() {
	echo '<ul>';
	printf(
		'<li><a href="%1$s">%2$s</a></li>',
		esc_url( home_url( '/' ) ),
		esc_html__( 'Accueil', 'secura-learning' )
	);
	printf(
		'<li><a href="%1$s">%2$s</a></li>',
		esc_url( get_permalink( get_page_by_path( 'parcours' ) ) ? get_permalink( get_page_by_path( 'parcours' ) ) : home_url( '/' ) ),
		esc_html__( 'Parcours', 'secura-learning' )
	);
	echo '</ul>';
}

/**
 * Menu de pied de page de repli.
 */
function secures_learning_footer_fallback() {
	echo '<ul>';
	printf(
		'<li><a href="%1$s">%2$s</a></li>',
		esc_url( home_url( '/' ) ),
		esc_html__( 'Accueil', 'secura-learning' )
	);

	/* Les pages legales doivent etre accessibles : c'est une exigence
	   legale, pas un agrement. */
	foreach ( array(
		'politique-de-confidentialite' => __( 'Politique de confidentialité', 'secura-learning' ),
		'mentions-legales'             => __( 'Mentions légales', 'secura-learning' ),
	) as $slug => $libelle ) {
		$page = get_page_by_path( $slug );

		if ( ! $page || 'publish' !== $page->post_status ) {
			continue;
		}

		printf(
			'<li><a href="%1$s">%2$s</a></li>',
			esc_url( get_permalink( $page->ID ) ),
			esc_html( $libelle )
		);
	}

	echo '</ul>';
}

/**
 * Largeur de contenu comfortable.
 */
function secures_learning_content_width() {
	$GLOBALS['content_width'] = 1180;
}
add_action( 'after_setup_theme', 'secures_learning_content_width', 0 );
