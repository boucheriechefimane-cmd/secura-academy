<?php
/**
 * Gabarit d'une room Secura Academy.
 *
 * La description de la room précède le lecteur interactif.
 * Affiche la licence et l'attribution en bas de page si des questions importées sont présentes.
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

			/* ------------------------------------------------------------------
			 * Affiche la licence et l'attribution si des questions importées
			 * sont présentes dans cette room.
			 * ------------------------------------------------------------------ */
			if ( class_exists( 'Secura_Rooms' ) ) {
				$tasks = Secura_Rooms::get_tasks( get_the_ID() );
				$reserve = Secura_Rooms::reserve( get_the_ID() );

				$licences = array();
				$sources  = array();

				// Parcourir les questions dans les tâches
				if ( is_array( $tasks ) ) {
					foreach ( $tasks as $task ) {
						if ( ! is_array( $task ) ) {
							continue;
						}
						$qs = isset( $task['questions'] ) && is_array( $task['questions'] ) ? $task['questions'] : array();
						foreach ( $qs as $q ) {
							if ( ! is_array( $q ) ) {
								continue;
							}
							if ( ! empty( $q['licence'] ) ) {
								$licences[ $q['licence'] ] = true;
							}
							if ( ! empty( $q['source'] ) ) {
								$sources[ $q['source'] ] = true;
							}
						}
					}
				}

				// Parcourir la réserve (questions d'examen importées)
				if ( is_array( $reserve ) ) {
					foreach ( $reserve as $q ) {
						if ( ! is_array( $q ) ) {
							continue;
						}
						if ( ! empty( $q['licence'] ) ) {
							$licences[ $q['licence'] ] = true;
						}
						if ( ! empty( $q['source'] ) ) {
							$sources[ $q['source'] ] = true;
						}
					}
				}

				if ( ! empty( $licences ) ) : ?>
					<section class="seca-room-licence">
						<h3 class="seca-room-section-title"><?php echo esc_html( __( 'Licence et attribution', 'seca-academy' ) ); ?></h3>
						<ul>
							<?php foreach ( array_keys( $licences ) as $licence ) : ?>
								<li><?php echo esc_html( sprintf( __( 'Licence : %s', 'seca-academy' ), $licence ) ); ?></li>
							<?php endforeach; ?>
							<?php foreach ( array_keys( $sources ) as $source ) : ?>
								<li><?php echo esc_html( sprintf( __( 'Source : %s', 'seca-academy' ), $source ) ); ?></li>
							<?php endforeach; ?>
						</ul>
						<p class="seca-room-licence-note">
							<?php echo esc_html__( 'Ce contenu provient de sources universitaires publiques et est diffusé sous la licence indiquée. Aucune réécriture maison n\'a été effectuée.', 'seca-academy' ); ?>
						</p>
					</section>
				<?php endif;
			}
			?>
		</div>
	</article>
	<?php
endwhile;
?>

<?php
get_footer();
