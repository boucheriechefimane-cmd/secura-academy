<?php
/**
 * En-tête du thème Secura Learning.
 *
 * @package Secura_Learning
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#content"><?php esc_html_e( 'Aller au contenu principal', 'secura-learning' ); ?></a>

<header class="site-header">
	<div class="site-header__inner">
		<a class="site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<span class="site-brand__mark" aria-hidden="true">&#9670;</span>
			<span class="site-brand__name"><?php bloginfo( 'name' ); ?></span>
		</a>

		<nav class="site-nav" aria-label="<?php esc_attr_e( 'Menu principal', 'secura-learning' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'fallback_cb'    => 'secures_learning_menu_fallback',
				)
			);
			?>
		</nav>

		<?php
		/* Le choix de la langue : de vrais liens, utilisables meme sans
		   JavaScript (et repérables par les moteurs). */
		echo secures_learning_language_switcher(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- la fonction renvoie du HTML deja echappe.
		?>
	</div>
</header>

<main id="content" class="site-main">
