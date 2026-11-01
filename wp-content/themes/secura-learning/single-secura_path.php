<?php
/**
 * Gabarit d'une page de parcours Secura Academy.
 *
 * Le parcours est le carrefour du site : il doit donc lister ses rooms
 * avec de vrais liens. C'est ce qui permet a un eleve de suivre le
 * parcours, et a un moteur (ou a un robot d'IA) de decouvrir toutes les
 * rooms sans passer par le plan du site.
 *
 * @package Secura_Learning
 */

get_header();

while ( have_posts() ) :
	the_post();

	$seca_parcours_id = get_the_ID();
	$seca_vue        = class_exists( 'Secura_Paths' ) ? Secura_Paths::get_path_view( $seca_parcours_id ) : null;
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'seca-path-article' ); ?>>
		<header class="entry-header seca-path-head">
			<h1 class="page-title"><?php the_title(); ?></h1>

			<?php if ( $seca_vue ) : ?>
				<p class="seca-path-meta">
					<span class="seca-chip"><?php echo esc_html( $seca_vue['difficulty'] ); ?></span>
					<span class="seca-chip"><?php echo esc_html( sprintf( /* translators: %d : nombre de rooms. */ __( '%d rooms', 'seca-academy' ), $seca_vue['room_count'] ) ); ?></span>
					<span class="seca-chip"><?php echo esc_html( sprintf( /* translators: %d : minutes. */ __( '%d min', 'seca-academy' ), $seca_vue['duration'] ) ); ?></span>
					<span class="seca-chip"><?php echo esc_html( sprintf( /* translators: %d : points d'expérience. */ __( '+%d XP', 'seca-academy' ), $seca_vue['xp_bonus'] ) ); ?></span>
				</p>
			<?php endif; ?>
		</header>

		<div class="entry-content">
			<?php if ( trim( wp_strip_all_tags( get_the_content() ) ) ) : ?>
				<section class="seca-path-intro">
					<?php the_content(); ?>
				</section>
			<?php endif; ?>

			<?php if ( $seca_vue && ! empty( $seca_vue['certification']['nom'] ) ) : ?>
				<?php $seca_cert = $seca_vue['certification']; ?>
				<section class="seca-path-certification">
					<h2 class="seca-room-section-title"><?php esc_html_e( 'Où ce parcours mène', 'seca-academy' ); ?></h2>

					<p class="seca-cert-nom">
						<span class="seca-chip"><?php esc_html_e( 'Certification visée', 'seca-academy' ); ?></span>
						<strong><?php echo esc_html( $seca_cert['nom'] ); ?></strong>
					</p>

					<?php if ( ! empty( $seca_cert['preparation'] ) ) : ?>
						<p class="seca-cert-preparation"><?php echo esc_html( $seca_cert['preparation'] ); ?></p>
					<?php endif; ?>

					<?php if ( ! empty( $seca_cert['cout'] ) ) : ?>
						<p class="seca-cert-cout">
							<span class="seca-chip"><?php esc_html_e( 'Coût de l’examen', 'seca-academy' ); ?></span>
							<?php echo esc_html( $seca_cert['cout'] ); ?>
						</p>
					<?php endif; ?>

					<?php if ( ! empty( $seca_vue['certificate'] ) ) : ?>
						<p class="seca-cert-note">
							<?php esc_html_e( 'Ce parcours délivre aussi le certificat de la plateforme, vérifiable en ligne.', 'seca-academy' ); ?>
						</p>
					<?php endif; ?>
				</section>
			<?php endif; ?>

			<?php if ( $seca_vue && ! empty( $seca_vue['sections'] ) ) : ?>
				<section class="seca-path-sections">
					<h2 class="seca-room-section-title"><?php esc_html_e( 'Les étapes de ce parcours', 'seca-academy' ); ?></h2>

					<?php foreach ( $seca_vue['sections'] as $seca_section ) : ?>
						<?php
						/* On n'affiche une section que si elle contient des
						   rooms : sinon on laisserait un titre vide. */
						$seca_rooms = array();

						foreach ( $seca_section['rooms'] as $seca_room_id ) {
							$seca_room = class_exists( 'Secura_Rooms' ) ? Secura_Rooms::get_room_view( $seca_room_id ) : null;

							if ( $seca_room ) {
								$seca_rooms[] = $seca_room;
							}
						}

						if ( empty( $seca_rooms ) ) {
							continue;
						}
						?>
						<h3 class="seca-section-title"><?php echo esc_html( $seca_section['title'] ); ?></h3>
						<ol class="seca-path-room-list">
							<?php foreach ( $seca_rooms as $seca_room ) : ?>
								<li class="seca-path-room">
									<a href="<?php echo esc_url( get_permalink( $seca_room['id'] ) ); ?>">
										<span class="seca-path-room-title"><?php echo esc_html( $seca_room['title'] ); ?></span>
										<span class="seca-path-room-meta">
											<span class="seca-chip"><?php echo esc_html( $seca_room['difficulty'] ); ?></span>
											<span class="seca-chip"><?php echo esc_html( sprintf( /* translators: %d : minutes. */ __( '%d min', 'seca-academy' ), $seca_room['duration'] ) ); ?></span>
										</span>
									</a>
									<?php if ( '' !== trim( (string) $seca_room['excerpt'] ) ) : ?>
										<p class="seca-path-room-excerpt"><?php echo esc_html( $seca_room['excerpt'] ); ?></p>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ol>
					<?php endforeach; ?>
				</section>
			<?php endif; ?>
		</div>
	</article>

	<?php
endwhile;

get_footer();
