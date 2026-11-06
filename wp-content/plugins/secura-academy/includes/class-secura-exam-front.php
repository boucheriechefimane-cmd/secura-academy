<?php
/**
 * Front-end des examens chronométrés et des certificats.
 *
 * Shortcodes :
 *  - [secura_exam room_id="123"] : affiche l'examen chronométré d'une room.
 *  - [secura_certificates] : liste les certificats de l'utilisateur connecté.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Front examens et certificats.
 */
final class Secura_Exam_Front {

	public static function init() {
		add_shortcode( 'secura_exam', array( __CLASS__, 'shortcode_exam' ) );
		add_shortcode( 'secura_certificates', array( __CLASS__, 'shortcode_certificates' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_assets' ) );
	}

	/**
	 * Enregistre les assets JS/CSS pour les examens.
	 */
	public static function enqueue_assets() {
		wp_enqueue_script(
			'seca-exam-front',
			plugins_url( 'js/exam-front.js', SECURA_ACADEMY_URL ),
			array( 'jquery' ),
			SECURA_ACADEMY_VERSION,
			true
		);

		wp_localize_script( 'seca-exam-front', 'secaExam', array(
			'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
			'nonce'     => wp_create_nonce( 'secura_academy' ),
			'startMsg'  => __( 'Commencer l\'examen', 'seca-academy' ),
			'submitMsg' => __( 'Soumettre l\'examen', 'seca-academy' ),
			'timeMsg'   => __( 'Temps restant', 'seca-academy' ),
		) );
	}

	/**
	 * Shortcode : examen chronométré d'une room.
	 *
	 * [secura_exam room_id="123"]
	 *
	 * @param array $atts Attributs du shortcode.
	 * @return string HTML de l'examen.
	 */
	public static function shortcode_exam( $atts ) {
		$atts = shortcode_atts( array(
			'room_id' => 0,
		), $atts, 'secura_exam' );

		$room_id = absint( $atts['room_id'] );
		if ( ! $room_id ) {
			return '<p>' . __( 'ID de room manquant.', 'seca-academy' ) . '</p>';
		}

		$room = get_post( $room_id );
		if ( ! $room ) {
			return '<p>' . __( 'Room introuvable.', 'seca-academy' ) . '</p>';
		}

		$count  = Secura_Exam_Timed::available_count( $room_id );
		$user   = wp_get_current_user();

		ob_start();
		?>
		<div class="seca-exam-container" data-room-id="<?php echo esc_attr( $room_id ); ?>" id="seca-exam-<?php echo esc_attr( $room_id ); ?>">
			<div class="seca-exam-header">
				<h2 class="seca-exam-title"><?php echo esc_html( $room->post_title ); ?></h2>
				<div class="seca-exam-meta">
					<span class="seca-exam-questions"><?php echo esc_html( $count ); ?> <?php echo _n( 'question', 'questions', $count, 'seca-academy' ); ?></span>
					<span class="seca-exam-timer" id="seca-exam-timer-<?php echo esc_attr( $room_id ); ?>"><?php echo __( 'Non démarré', 'seca-academy' ); ?></span>
				</div>
			</div>

			<div class="seca-exam-actions">
				<button type="button"
					id="seca-exam-start-<?php echo esc_attr( $room_id ); ?>"
					class="seca-exam-button seca-exam-button-start"
					data-room-id="<?php echo esc_attr( $room_id ); ?>">
					<span class="seca-exam-icon">⏱</span>
					<?php echo esc_html( __( 'Commencer l\'examen', 'seca-academy' ) ); ?>
				</button>
				<button type="button"
					id="seca-exam-submit-<?php echo esc_attr( $room_id ); ?>"
					class="seca-exam-button seca-exam-button-submit seca-hidden"
					data-room-id="<?php echo esc_attr( $room_id ); ?>">
					<span class="seca-exam-icon">✓</span>
					<?php echo esc_html( __( 'Soumettre l\'examen', 'seca-academy' ) ); ?>
				</button>
			</div>

			<div class="seca-exam-timer-display" id="seca-exam-timer-display-<?php echo esc_attr( $room_id ); ?>" style="display:none;">
				<?php echo esc_html( __( 'Temps restant : ', 'seca-academy' ) ); ?>
				<span id="seca-exam-time-<?php echo esc_attr( $room_id ); ?>">00:00</span>
			</div>

			<div class="seca-exam-questions-list" id="seca-exam-questions-<?php echo esc_attr( $room_id ); ?>" style="display:none;">
				<!-- Questions injectées par JS après démarrage -->
			</div>

			<div class="seca-exam-result" id="seca-exam-result-<?php echo esc_attr( $room_id ); ?>" style="display:none;"></div>

			<div class="seca-exam-message" id="seca-exam-message-<?php echo esc_attr( $room_id ); ?>"></div>
		</div>
		<style>
			.seca-exam-container { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; margin: 1.5em 0; border: 1px solid #e2e8f0; border-radius: 8px; padding: 1.5em; background: #ffffff; }
			.seca-exam-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1em; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.5em; }
			.seca-exam-title { margin: 0; font-size: 1.25rem; color: #1a1a2e; }
			.seca-exam-meta { display: flex; gap: 1em; font-size: 0.9rem; color: #64748b; }
			.seca-exam-timer { font-weight: 700; color: #b91c1c; font-family: monospace; }
			.seca-exam-actions { display: flex; gap: 0.75em; margin-bottom: 1.5em; }
			.seca-exam-button { padding: 0.75em 1.5em; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 14px; transition: all 0.2s; }
			.seca-exam-button-start { background: #10b981; color: #fff; }
			.seca-exam-button-start:hover { background: #059669; }
			.seca-exam-button-submit { background: #3b82f6; color: #fff; }
			.seca-exam-button-submit:hover { background: #2563eb; }
			.seca-exam-button:disabled { opacity: 0.6; cursor: not-allowed; }
			.seca-hidden { display: none; }
			.seca-exam-questions-list { max-height: 500px; overflow-y: auto; border: 1px solid #e2e8f0; border-radius: 6px; padding: 1em; background: #f8fafc; }
			.seca-exam-result { margin-top: 1em; padding: 1em; border-radius: 6px; font-weight: 600; }
			.seca-exam-result.passed { background: #dcfce7; color: #166534; border: 1px solid #86efac; }
			.seca-exam-result.failed { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
			.seca-exam-message { margin-top: 1em; font-size: 0.9rem; min-height: 1.2em; }
			.seca-exam-question { margin-bottom: 1em; padding: 1em; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 6px; }
			.seca-exam-question-text { font-weight: 600; margin-bottom: 0.5em; }
			.seca-exam-choice { display: block; margin: 0.4em 0; cursor: pointer; }
			.seca-exam-choice input { margin-right: 0.5em; }
			.seca-exam-text-answer { width: 100%; padding: 0.5em; border: 1px solid #cbd5e1; border-radius: 4px; font-family: inherit; font-size: 14px; }
		</style>
		<?php
		return ob_get_clean();
	}

	/**
	 * Shortcode : liste des certificats de l'utilisateur.
	 *
	 * [secura_certificates]
	 *
	 * @return string HTML de la liste.
	 */
	public static function shortcode_certificates() {
		if ( ! is_user_logged_in() ) {
			return '<p>' . __( 'Connectez-vous pour voir vos certificats.', 'seca-academy' ) . '</p>';
		}

		$certs = Secura_Certificate::list_user_certificates( get_current_user_id() );

		ob_start();
		?>
		<div class="seca-certificates-container">
			<h2 class="seca-certificates-title"><?php echo esc_html__( 'Mes certificats', 'seca-academy' ); ?></h2>

			<?php if ( empty( $certs ) ) : ?>
				<p class="seca-certificates-empty"><?php echo esc_html__( 'Aucun certificat délivré pour le moment. Terminez un parcours pour obtenir votre certificat.', 'seca-academy' ); ?></p>
			<?php else : ?>
				<table class="seca-certificates-table">
					<thead>
						<tr>
							<th><?php echo esc_html__( 'Parcours', 'seca-academy' ); ?></th>
							<th><?php echo esc_html__( 'Numéro', 'seca-academy' ); ?></th>
							<th><?php echo esc_html__( 'Score', 'seca-academy' ); ?></th>
							<th><?php echo esc_html__( 'Médaille', 'seca-academy' ); ?></th>
							<th><?php echo esc_html__( 'Date', 'seca-academy' ); ?></th>
							<th><?php echo esc_html__( 'Télécharger', 'seca-academy' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $certs as $cert ) : ?>
							<tr>
								<td><?php echo esc_html( $cert['path_name'] ); ?></td>
								<td><?php echo esc_html( $cert['certificate_number'] ); ?></td>
								<td><?php echo esc_html( $cert['score'] ); ?> / 100</td>
								<td>
									<span class="seca-medal seca-medal-<?php echo esc_attr( $cert['medal'] ); ?>">
										<?php
										$medal_labels = array(
											'gold'   => __( 'Or', 'seca-academy' ),
											'silver' => __( 'Argent', 'seca-academy' ),
											'bronze' => __( 'Bronze', 'seca-academy' ),
										);
										echo esc_html( $medal_labels[ $cert['medal'] ] ?? $cert['medal'] );
										?>
									</span>
								</td>
								<td><?php echo esc_html( date( 'd/m/Y', $cert['issued_at'] ) ); ?></td>
								<td>
									<a href="<?php echo esc_url( $cert['pdf_url'] ); ?>" class="seca-cert-download" target="_blank">
										<?php echo esc_html__( 'PDF', 'seca-academy' ); ?>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php endif; ?>
		</div>
		<style>
			.seca-certificates-container { margin: 1.5em 0; }
			.seca-certificates-title { font-size: 1.25rem; color: #1a1a2e; margin-bottom: 1em; }
			.seca-certificates-empty { color: #64748b; font-style: italic; }
			.seca-certificates-table { width: 100%; border-collapse: collapse; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; }
			.seca-certificates-table th, .seca-certificates-table td { padding: 0.75em 1em; text-align: left; border-bottom: 1px solid #f1f5f9; }
			.seca-certificates-table th { background: #f8fafc; font-weight: 600; color: #475569; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; }
			.seca-certificates-table td { font-size: 0.9rem; color: #334155; }
			.seca-medal { display: inline-block; padding: 0.2em 0.6em; border-radius: 20px; font-size: 0.75rem; font-weight: 700; }
			.seca-medal-gold { background: #fef3c7; color: #92400e; }
			.seca-medal-silver { background: #e0e7ff; color: #3730a3; }
			.seca-medal-bronze { background: #fdecec; color: #b91c1c; }
			.seca-cert-download { color: #3b82f6; text-decoration: none; font-weight: 600; }
			.seca-cert-download:hover { text-decoration: underline; }
		</style>
		<?php
		return ob_get_clean();
	}
}

Secura_Exam_Front::init();
