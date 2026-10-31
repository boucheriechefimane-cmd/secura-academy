<?php
/**
 * Secura Learning — fonctions du thème.
 *
 * @package Secura_Learning
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SECURA_LEARNING_VERSION', '0.4.0' );

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
	echo '</ul>';
}

/**
 * Largeur de contenu comfortable.
 */
function secures_learning_content_width() {
	$GLOBALS['content_width'] = 1180;
}
add_action( 'after_setup_theme', 'secures_learning_content_width', 0 );
