<?php
/**
 * La facade video : on ne charge rien avant que l'apprenant ne clique.
 *
 * Pourquoi une facade et pas un iframe direct ?
 * - Un iframe YouTube pose une « piste » (cookie, identifiant) AVANT que
 *   l'apprenant n'ait choisi de regarder : c'est ce que la RGPD et la
 *   protection des mineurs interdisent.
 * - Sur une connexion modeste (ou depuis un reseau scolaire bloque), une
 *   page qui embarque 22 iframes met des secondes a s'afficher.
 * - Si YouTube est bloque, un iframe affiche un cadre vide : l'apprenant
 *   croit que la room est cassee. Un lien, lui, marche toujours.
 *
 * Donc : une affiche (image de couverture posee sur le serveur, pas
 * d'image distante), un bouton, et au clic l iframe `youtube-nocookie`
 * qui remplace l'affiche. Le lien vers la source reste toujours visible.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Gestionnaire des videos de cours.
 */
final class Secura_Video {

	/**
	 * Meta qui porte la video d'une room.
	 */
	const META = '_secura_video';

	/**
	 * Identifiant d'une video YouTube : 11 caracteres [A-Za-z0-9_-].
	 */
	const ID_PATTERN = '/^[A-Za-z0-9_-]{11}$/';

	/**
	 * Branche les hooks.
	 */
	public static function init() {
		add_action( 'add_meta_boxes', array( __CLASS__, 'add_meta_box' ) );
		add_action( 'save_post_' . SECURA_POST_TYPE, array( __CLASS__, 'save' ), 10, 2 );
	}

	/**
	 * La video d'une room, normalisee.
	 *
	 * @param int $room_id Identifiant de la room.
	 * @return array|false
	 */
	public static function get( $room_id ) {
		$room_id = absint( $room_id );

		if ( ! $room_id ) {
			return false;
		}

		$raw = get_post_meta( $room_id, self::META, true );

		if ( ! is_array( $raw ) || empty( $raw['id'] ) ) {
			return false;
		}

		$id = trim( (string) $raw['id'] );

		if ( ! preg_match( self::ID_PATTERN, $id ) ) {
			return false;
		}

		return array(
			'id'          => $id,
			'title'       => isset( $raw['title'] ) ? (string) $raw['title'] : '',
			'channel'     => isset( $raw['channel'] ) ? (string) $raw['channel'] : '',
			'institution' => isset( $raw['institution'] ) ? (string) $raw['institution'] : '',
			'license'     => isset( $raw['license'] ) ? (string) $raw['license'] : '',
			'duration'    => isset( $raw['duration'] ) ? (string) $raw['duration'] : '',
			'note'        => isset( $raw['note'] ) ? (string) $raw['note'] : '',
		);
	}

	/**
	 * URL d'integration (sans cookie de pistage).
	 *
	 * @param string $id Identifiant de la video.
	 * @return string
	 */
	public static function embed_url( $id ) {
		return 'https://www.youtube-nocookie.com/embed/' . rawurlencode( $id ) . '?rel=0&modestbranding=1&playsinline=1';
	}

	/**
	 * URL de la source (lien de secours, toujours visible).
	 *
	 * @param string $id Identifiant de la video.
	 * @return string
	 */
	public static function watch_url( $id ) {
		return 'https://www.youtube.com/watch?v=' . rawurlencode( $id );
	}

	/**
	 * Rend le bloc video d'une room (facade + attribution).
	 *
	 * @param int    $room_id Identifiant de la room.
	 * @param string $lang    Langue ('fr', 'ar', 'en').
	 * @return string
	 */
	public static function render( $room_id, $lang = '' ) {
		$video = self::get( $room_id );

		if ( ! $video ) {
			return '';
		}

		$lang = $lang ? $lang : Secura_I18n::current_lang();

		$label_play   = Secura_I18n::t( 'video_play', $lang, 'Regarder la vidéo du cours' );
		$label_source = Secura_I18n::t( 'video_source', $lang, 'Voir la vidéo sur la source' );
		$label_attr   = Secura_I18n::t( 'video_attribution', $lang, 'Source' );
		$label_lic    = Secura_I18n::t( 'video_license', $lang, 'Licence' );
		$label_note   = Secura_I18n::t( 'video_note', $lang, 'Vidéo du cours de l’université, en complément de la room.' );
		$label_dur    = Secura_I18n::t( 'video_duration', $lang, 'Durée' );

		$title    = $video['title'] ? $video['title'] : $label_play;
		$watch    = self::watch_url( $video['id'] );
		$embed    = self::embed_url( $video['id'] );
		$instit   = $video['institution'] ? $video['institution'] : $video['channel'];
		$duration = $video['duration'] ? $video['duration'] : '';

		ob_start();
		?>
		<figure class="seca-video" data-seca-video data-seca-video-id="<?php echo esc_attr( $video['id'] ); ?>">
			<div class="seca-video-frame">
				<button type="button" class="seca-video-facade" data-seca-video-play aria-label="<?php echo esc_attr( $label_play . ' : ' . $title ); ?>">
					<span class="seca-video-play" aria-hidden="true">&#9654;</span>
					<span class="seca-video-facade-text">
						<span class="seca-video-kicker"><?php echo esc_html( $label_play ); ?></span>
						<span class="seca-video-title"><?php echo esc_html( $title ); ?></span>
						<?php if ( $instit || $duration ) : ?>
							<span class="seca-video-meta">
								<?php if ( $instit ) : ?>
									<span class="seca-video-channel"><?php echo esc_html( $instit ); ?></span>
								<?php endif; ?>
								<?php if ( $duration ) : ?>
									<span class="seca-video-duration"><?php echo esc_html( $label_dur . ' : ' . $duration ); ?></span>
								<?php endif; ?>
							</span>
						<?php endif; ?>
					</span>
				</button>
				<div class="seca-video-player" data-seca-video-player hidden></div>
			</div>
			<figcaption class="seca-video-attribution">
				<span class="seca-video-note"><?php echo esc_html( $video['note'] ? $video['note'] : $label_note ); ?></span>
				<span class="seca-video-source">
					<?php echo esc_html( $label_attr . ' : ' ); ?>
					<?php if ( $instit ) : ?>
						<strong><?php echo esc_html( $instit ); ?></strong>
					<?php endif; ?>
					<?php if ( $video['title'] ) : ?>
						<span class="seca-video-source-title">&mdash; <?php echo esc_html( $video['title'] ); ?></span>
					<?php endif; ?>
					<?php if ( $video['channel'] && $video['channel'] !== $instit ) : ?>
						<span class="seca-video-channel">(<?php echo esc_html( $video['channel'] ); ?>)</span>
					<?php endif; ?>
				</span>
				<?php if ( $video['license'] ) : ?>
					<span class="seca-video-license"><?php echo esc_html( $label_lic . ' : ' . $video['license'] ); ?></span>
				<?php endif; ?>
				<a class="seca-video-link" href="<?php echo esc_url( $watch ); ?>" target="_blank" rel="noopener noreferrer nofollow" data-seca-video-source><?php echo esc_html( $label_source ); ?></a>
				<noscript>
					<span class="seca-video-noscript" data-seca-video-embed="<?php echo esc_url( $embed ); ?>"></span>
				</noscript>
			</figcaption>
		</figure>
		<?php
		return ob_get_clean();
	}

	/**
	 * Ajoute la boite de saisie de la video dans l'editeur de room.
	 */
	public static function add_meta_box() {
		add_meta_box(
			'seca-video',
			__( 'Vidéo du cours (facade)', 'seca-academy' ),
			array( __CLASS__, 'render_meta_box' ),
			SECURA_POST_TYPE,
			'normal',
			'default'
		);
	}

	/**
	 * Contenu de la boite de saisie.
	 *
	 * @param WP_Post $post Room en cours d'edition.
	 */
	public static function render_meta_box( $post ) {
		$video = self::get( $post->ID );

		$fields = array(
			'id'          => __( 'Identifiant YouTube', 'seca-academy' ),
			'title'       => __( 'Titre de la vidéo', 'seca-academy' ),
			'channel'     => __( 'Chaîne / auteur', 'seca-academy' ),
			'institution' => __( 'Université / source', 'seca-academy' ),
			'license'     => __( 'Licence', 'seca-academy' ),
			'duration'    => __( 'Durée (ex. 1:17:13)', 'seca-academy' ),
			'note'        => __( 'Précision affichée sous la vidéo', 'seca-academy' ),
		);

		wp_nonce_field( 'seca_video_save', 'seca_video_nonce' );

		echo '<p>' . esc_html__( 'La vidéo n’est jamais chargée avant le clic : une affiche et un lien suffisent. Copiez l’identifiant de la vidéo YouTube (11 caractères) ou son URL complète.', 'seca-academy' ) . '</p>';

		echo '<table class="widefat striped"><tbody>';

		foreach ( $fields as $key => $label ) {
			$value = $video && isset( $video[ $key ] ) ? $video[ $key ] : '';
			echo '<tr><th style="width:220px"><label for="seca-video-' . esc_attr( $key ) . '">' . esc_html( $label ) . '</label></th>';
			echo '<td><input type="text" class="regular-text" id="seca-video-' . esc_attr( $key ) . '" name="seca_video[' . esc_attr( $key ) . ']" value="' . esc_attr( $value ) . '"></td></tr>';
		}

		echo '</tbody></table>';
	}

	/**
	 * Enregistre la video.
	 *
	 * @param int     $post_id Identifiant de la room.
	 * @param WP_Post $post    Room.
	 */
	public static function save( $post_id, $post ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! isset( $_POST['seca_video_nonce'] ) ) {
			return;
		}

		$nonce = sanitize_text_field( wp_unslash( $_POST['seca_video_nonce'] ) );

		if ( ! wp_verify_nonce( $nonce, 'seca_video_save' ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$raw = isset( $_POST['seca_video'] ) && is_array( $_POST['seca_video'] ) ? wp_unslash( $_POST['seca_video'] ) : array();

		$id = isset( $raw['id'] ) ? trim( (string) $raw['id'] ) : '';

		/* On accepte l'identifiant seul ou l'URL complete. */
		if ( $id && ! preg_match( self::ID_PATTERN, $id ) ) {
			if ( preg_match( '/(?:v=|youtu\.be\/)([A-Za-z0-9_-]{11})/', $id, $matches ) ) {
				$id = $matches[1];
			}
		}

		if ( ! $id || ! preg_match( self::ID_PATTERN, $id ) ) {
			delete_post_meta( $post_id, self::META );
			return;
		}

		$video = array(
			'id'          => $id,
			'title'       => isset( $raw['title'] ) ? sanitize_text_field( $raw['title'] ) : '',
			'channel'     => isset( $raw['channel'] ) ? sanitize_text_field( $raw['channel'] ) : '',
			'institution' => isset( $raw['institution'] ) ? sanitize_text_field( $raw['institution'] ) : '',
			'license'     => isset( $raw['license'] ) ? sanitize_text_field( $raw['license'] ) : '',
			'duration'    => isset( $raw['duration'] ) ? sanitize_text_field( $raw['duration'] ) : '',
			'note'        => isset( $raw['note'] ) ? sanitize_text_field( $raw['note'] ) : '',
		);

		update_post_meta( $post_id, self::META, $video );
	}
}
