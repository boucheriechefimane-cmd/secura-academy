<?php
/**
 * Gabarit de l'archive des rooms Secura Academy.
 *
 * @package Secura_Learning
 */

get_header();
?>

<header class="page-header">
	<h1 class="page-title"><?php esc_html_e( 'Toutes les rooms', 'secura-learning' ); ?></h1>
	<p><?php esc_html_e( 'Chaque room suit le même rythme : une leçon, un entraînement, un test d\'application puis un examen.', 'secura-learning' ); ?></p>
</header>

<?php echo do_shortcode( '[secura_academy]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- shortcode interne. ?>

<?php
get_footer();
