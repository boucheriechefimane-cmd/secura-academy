<?php
/**
 * Gabarit de la page d'erreur 404.
 *
 * Une page d'erreur n'est pas une page inutile : c'est un chemin de
 * navigation. Celle-ci propose les parcours et les rooms, pour que le
 * visiteur (ou le robot) retrouve le contenu immediatement.
 *
 * @package Secura_Learning
 */

get_header();
?>

<main id="primary" class="site-main seca-404">
	<div class="seca-404-inner">
		<h1 class="page-title"><?php esc_html_e( 'Cette page n’existe pas', 'secura-learning' ); ?></h1>

		<p class="seca-404-lead">
			<?php esc_html_e( 'Le lien est peut-être ancien, ou l’adresse a changé. Voici par où reprendre.', 'secura-learning' ); ?>
		</p>

		<p class="seca-404-actions">
			<a class="seca-btn seca-btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php esc_html_e( 'Retour à l’accueil', 'secura-learning' ); ?>
			</a>
			<a class="seca-btn" href="<?php echo esc_url( home_url( '/parcours/' ) ); ?>">
				<?php esc_html_e( 'Voir les parcours', 'secura-learning' ); ?>
			</a>
		</p>

		<?php if ( function_exists( 'Secura_Paths' ) ) : ?>
			<?php $seca_parcours = Secura_Paths::get_paths(); ?>
			<?php if ( ! empty( $seca_parcours ) ) : ?>
				<h2 class="seca-room-section-title"><?php esc_html_e( 'Les parcours', 'secura-learning' ); ?></h2>
				<ul class="seca-guest-paths">
					<?php
					foreach ( $seca_parcours as $seca_parcours_item ) :
						$seca_vue = Secura_Paths::get_path_view( $seca_parcours_item->ID );

						if ( ! $seca_vue ) {
							continue;
						}
						?>
						<li>
							<a href="<?php echo esc_url( get_permalink( $seca_parcours_item->ID ) ); ?>">
								<strong><?php echo esc_html( $seca_vue['title'] ); ?></strong>
								<span><?php echo esc_html( $seca_vue['excerpt'] ); ?></span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( function_exists( 'Secura_Rooms' ) ) : ?>
			<h2 class="seca-room-section-title"><?php esc_html_e( 'Les rooms', 'secura-learning' ); ?></h2>
			<ul class="seca-room-grid">
				<?php
				foreach ( Secura_Rooms::get_rooms() as $seca_room ) :
					$seca_vue = Secura_Rooms::get_room_view( $seca_room->ID );

					if ( ! $seca_vue ) {
						continue;
					}
					?>
					<li class="seca-room-card is-todo">
						<h3 class="seca-room-title"><a href="<?php echo esc_url( get_permalink( $seca_room->ID ) ); ?>"><?php echo esc_html( $seca_vue['title'] ); ?></a></h3>
						<p class="seca-room-excerpt"><?php echo esc_html( $seca_vue['excerpt'] ); ?></p>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
