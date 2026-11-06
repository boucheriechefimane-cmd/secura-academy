<?php
/**
 * Front-end des labs : bouton "Démarrer le lab" dans les rooms.
 *
 * Ajoute le shortcode [secura_lab_button] et les handlers JS pour appeler
 * l'API AJAX existante (secura_lab_start / secura_lab_stop / secura_lab_status).
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Bouton de démarrage de lab pour une room.
 */
class Secura_Lab_Front {

	public static function init() {
		add_shortcode( 'secura_lab_button', array( __CLASS__, 'shortcode_button' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_assets' ) );
	}

	/**
	 * Enregistre les assets JS/CSS et le nonce pour l'API lab.
	 */
	public static function enqueue_assets() {
		wp_enqueue_script(
			'seca-lab-front',
			plugins_url( 'js/lab-front.js', SECURA_ACADEMY_URL ),
			array( 'jquery' ),
			SECURA_ACADEMY_VERSION,
			true
		);

		wp_localize_script( 'seca-lab-front', 'secaLab', array(
			'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'seca-lab' ),
			'startMsg' => __( 'Démarrer le lab', 'seca-academy' ),
			'stopMsg'  => __( 'Arrêter le lab', 'seca-academy' ),
			'statusMsg'=> __( 'Statut du lab', 'seca-academy' ),
		) );
	}

	/**
	 * Shortcode : affiche le bouton "Démarrer le lab" + zone de statut.
	 *
	 * [secura_lab_button room_id="123"]
	 *
	 * @param array $atts Attributs du shortcode.
	 * @return string HTML du bouton.
	 */
	public static function shortcode_button( $atts ) {
		$atts = shortcode_atts( array(
			'room_id' => 0,
		), $atts, 'secura_lab_button' );

		$room_id = absint( $atts['room_id'] );
		if ( ! $room_id ) {
			return '<p>' . __( 'ID de room manquant.', 'seca-academy' ) . '</p>';
		}

		$view = Secura_Rooms::get_room_view( $room_id );
		if ( ! $view ) {
			return '<p>' . __( 'Room introuvable.', 'seca-academy' ) . '</p>';
		}

		$manifest = Secura_Lab::get_manifest( $room_id );
		$enabled  = ! empty( $manifest['enabled'] );
		$driver   = $manifest['driver'];

		$obfuscated = 'seca-lab-' . $room_id;

		ob_start();
		?>
		<div class="seca-lab-container" data-room-id="<?php echo esc_attr( $room_id ); ?>" id="<?php echo esc_attr( $obfuscated ); ?>">
			<?php if ( ! $enabled ): ?>
				<p class="seca-lab-disabled">
					<?php esc_html_e( 'Ce lab n\'est pas disponible sur cet hébergement.', 'seca-academy' ); ?>
				</p>
			<?php else: ?>
				<button type="button"
						id="seca-lab-start-<?php echo esc_attr( $room_id ); ?>"
						class="seca-lab-button seca-lab-button-start"
						data-room-id="<?php echo esc_attr( $room_id ); ?>">
					<span class="seca-lab-icon">▶</span>
					<?php echo esc_html( __( 'Démarrer le lab', 'seca-academy' ) ); ?>
				</button>
				<button type="button"
						id="seca-lab-stop-<?php echo esc_attr( $room_id ); ?>"
						class="seca-lab-button seca-lab-button-stop seca-hidden"
						data-room-id="<?php echo esc_attr( $room_id ); ?>">
					<span class="seca-lab-icon">⏹</span>
					<?php echo esc_html( __( 'Arrêter le lab', 'seca-academy' ) ); ?>
				</button>
				<button type="button"
						id="seca-lab-status-<?php echo esc_attr( $room_id ); ?>"
						class="seca-lab-button seca-lab-button-status"
						data-room-id="<?php echo esc_attr( $room_id ); ?>">
					<span class="seca-lab-icon">⟳</span>
					<?php echo esc_html( __( 'Statut', 'seca-academy' ) ); ?>
				</button>
				<div class="seca-lab-output" id="seca-lab-output-<?php echo esc_attr( $room_id ); ?>"></div>
				<div class="seca-lab-target" id="seca-lab-target-<?php echo esc_attr( $room_id ); ?>"></div>
			<?php endif; ?>
		</div>
		<style>
			.seca-lab-container { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; margin: 1em 0; }
			.seca-lab-button { display: inline-block; padding: 0.6em 1.2em; margin: 0.3em; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 14px; transition: all 0.2s; }
			.seca-lab-button-start { background: #10b981; color: #fff; }
			.seca-lab-button-start:hover { background: #059669; }
			.seca-lab-button-stop { background: #ef4444; color: #fff; }
			.seca-lab-button-stop:hover { background: #dc2626; }
			.seca-lab-button-status { background: #3b82f6; color: #fff; }
			.seca-lab-button-status:hover { background: #2563eb; }
			.seca-lab-button:disabled { opacity: 0.6; cursor: not-allowed; }
			.seca-hidden { display: none; }
			.seca-lab-output { margin-top: 1em; padding: 1em; background: #f1f5f9; border-radius: 6px; font-family: monospace; font-size: 13px; max-height: 300px; overflow-y: auto; }
			.seca-lab-target { margin-top: 1em; padding: 1em; background: #f0fdf4; border: 1px solid #86efac; border-radius: 6px; font-size: 14px; }
			.seca-lab-disabled { color: #6b7280; font-style: italic; }
			.seca-lab-icon { margin-right: 0.5em; }
		</style>
		<?php
		return ob_get_clean();
	}
}

Secura_Lab_Front::init();
