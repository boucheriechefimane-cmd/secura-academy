<?php
/**
 * Gabarit principal du thème Secura Learning.
 *
 * @package Secura_Learning
 */

get_header();
?>

<?php if ( have_posts() ) : ?>

	<?php if ( is_home() && ! is_front_page() ) : ?>
		<header class="page-header">
			<h1 class="page-title"><?php single_post_title(); ?></h1>
		</header>
	<?php endif; ?>

	<ul class="post-list">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
				<header class="entry-header">
					<h2 class="post-card__title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
					<p class="post-card__meta">
						<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					</p>
				</header>

				<div class="entry-content">
					<?php the_excerpt(); ?>
					<p><a class="read-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Lire la suite', 'secura-learning' ); ?></a></p>
				</div>
			</article>
			<?php
		endwhile;
		?>
	</ul>

	<?php
	the_posts_pagination(
		array(
			'mid_size'  => 2,
			'prev_text' => __( 'Précédent', 'secura-learning' ),
			'next_text' => __( 'Suivant', 'secura-learning' ),
		)
	);
	?>

<?php else : ?>

	<section class="no-results not-found">
		<h1 class="page-title"><?php esc_html_e( 'Rien à afficher pour le moment.', 'secura-learning' ); ?></h1>
		<p><?php esc_html_e( 'Les prochains parcours de cybersécurité arrivent bientôt.', 'secura-learning' ); ?></p>
	</section>

<?php endif; ?>

<?php
get_footer();
