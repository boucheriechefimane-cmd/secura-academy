<?php
/**
 * Gabarit d'une room Secura Academy.
 *
 * La description de la room précède le lecteur interactif.
 *
 * @package Secura_Learning
 */

get_header();
?>

<?php
while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'seca-room-article' ); ?>>
		<div class="entry-content">
			<?php if ( trim( wp_strip_all_tags( get_the_content() ) ) ) : ?>
				<section class="seca-room-intro">
					<h2 class="seca-room-section-title"><?php echo esc_html( class_exists( 'Secura_I18n' ) ? Secura_I18n::t( 'lesson', '', 'Leçon' ) : 'Leçon' ); ?></h2>
					<?php the_content(); ?>
				</section>
			<?php endif; ?>

			<?php
			echo do_shortcode( /* translators: %d : identifiant de la room. */ sprintf( '[secura_academy_room id="%d"]', get_the_ID() ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- shortcode interne.
			?>
		</div>
	</article>
	<?php
endwhile;
?>

<?php
get_footer();
