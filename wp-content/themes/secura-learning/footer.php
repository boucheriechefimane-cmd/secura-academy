<?php
/**
 * Pied de page du thème Secura Learning.
 *
 * @package Secura_Learning
 */

?>
</main><!-- #content -->

<footer class="site-footer">
	<div class="site-footer__inner">
		<p class="site-footer__copy">
			<?php
			printf(
				/* translators: 1 : année, 2 : nom du site. */
				esc_html__( '© %1$s %2$s — Secura Academy', 'secura-learning' ),
				esc_html( gmdate( 'Y' ) ),
				esc_html( get_bloginfo( 'name' ) )
			);
			?>
		</p>

		<nav class="site-nav" aria-label="<?php esc_attr_e( 'Menu de pied de page', 'secura-learning' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'fallback_cb'    => 'secures_learning_footer_fallback',
				)
			);
			?>
		</nav>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
