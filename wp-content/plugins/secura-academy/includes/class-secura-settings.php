<?php
/**
 * Page de réglages : hébergement des labs, options de jeu.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Réglages administrables de la plateforme.
 */
final class Secura_Settings {

	/**
	 * Branche les hooks.
	 */
	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'add_menu' ) );
		add_action( 'admin_init', array( __CLASS__, 'register_settings' ) );
	}

	/**
	 * Ajoute la page « Réglages » de la plateforme.
	 */
	public static function add_menu() {
		add_options_page(
			__( 'Secura Academy', 'seca-academy' ),
			__( 'Secura Academy', 'seca-academy' ),
			'manage_options',
			'secura-academy',
			array( __CLASS__, 'render' )
		);
	}

	/**
	 * Enregistre les options.
	 */
	public static function register_settings() {
		register_setting(
			'secura_options',
			'secura_labs_path',
			array(
				'type'              => 'string',
				'default'           => '',
				'sanitize_callback' => array( __CLASS__, 'sanitize_labs_path' ),
			)
		);

		register_setting(
			'secura_options',
			SECURA_OPTION_FIRST_BLOOD,
			array(
				'type'              => 'boolean',
				'default'           => 0,
				'sanitize_callback' => 'rest_sanitize_boolean',
			)
		);
	}

	/**
	 * Nettoie le chemin du dossier des labs.
	 *
	 * @param mixed $value Valeur reçue.
	 * @return string
	 */
	public static function sanitize_labs_path( $value ) {
		if ( ! is_string( $value ) ) {
			return '';
		}

		$value = trim( $value );

		if ( '' === $value ) {
			return '';
		}

		return rtrim( wp_kses_data( $value ), '/' );
	}

	/**
	 * Affiche la page de réglages.
	 */
	public static function render() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$labs_path = Secura_Lab::labs_path_value();
		$source    = Secura_Lab::labs_path_source();
		$used      = Secura_Lab::labs_path();
		$readable  = is_dir( $used ) && is_readable( $used );
		$first     = Secura_Progress::first_blood_enabled();
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Réglages — Secura Academy', 'seca-academy' ); ?></h1>

			<form method="post" action="options.php">
				<?php settings_fields( 'secura_options' ); ?>

				<h2><?php esc_html_e( 'Machines cibles (labs)', 'seca-academy' ); ?></h2>

				<table class="form-table" role="presentation">
					<tr>
						<th scope="row">
							<label for="secura_labs_path"><?php esc_html_e( 'Dossier des labs sur ce serveur', 'seca-academy' ); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" id="secura_labs_path" name="secura_labs_path"
								value="<?php echo esc_attr( $labs_path ); ?>"
								placeholder="<?php echo esc_attr( defined( 'WP_CONTENT_DIR' ) ? WP_CONTENT_DIR . '/secura-labs' : ABSPATH . 'wp-content/secura-labs' ); ?>" />
							<p class="description">
								<?php esc_html_e( 'Là où sont déposées les machines cibles (docker-compose.yml, images). Laissez vide pour utiliser le dossier par défaut. Un chemin relatif dans le champ « docker-compose.yml » d\'une room est résolu par rapport à ce dossier.', 'seca-academy' ); ?>
							</p>
							<p class="description">
								<?php
								printf(
									/* translators: %s : dossier effectivement utilisé. */
									esc_html__( 'Dossier actuellement utilisé : %s', 'seca-academy' ),
									'<code>' . esc_html( $used ) . '</code>'
								);
								?>
							</p>
							<p class="description">
								<?php if ( 'constante' === $source ) : ?>
									<?php esc_html_e( 'Source : constante SECURA_LABS_PATH du fichier wp-config.php (elle l\'emporte sur ce champ).', 'seca-academy' ); ?>
								<?php elseif ( 'option' === $source ) : ?>
									<?php esc_html_e( 'Source : le champ ci-dessus.', 'seca-academy' ); ?>
								<?php else : ?>
									<?php esc_html_e( 'Source : dossier par défaut du plugin.', 'seca-academy' ); ?>
								<?php endif; ?>
							</p>
							<p class="description">
								<?php if ( $readable ) : ?>
									<strong style="color:#1a7f37;">&#10003; <?php esc_html_e( 'Dossier présent et lisible.', 'seca-academy' ); ?></strong>
								<?php else : ?>
									<strong style="color:#b32d2e;">&#10007; <?php esc_html_e( 'Dossier absent ou illisible : les machines ne pourront pas démarrer.', 'seca-academy' ); ?></strong>
								<?php endif; ?>
							</p>
						</td>
					</tr>
				</table>

				<h2><?php esc_html_e( 'Jeu et compétition', 'seca-academy' ); ?></h2>

				<table class="form-table" role="presentation">
					<tr>
						<th scope="row"><?php esc_html_e( 'First blood', 'seca-academy' ); ?></th>
						<td>
							<label>
								<input type="checkbox" id="secura_first_blood" name="<?php echo esc_attr( SECURA_OPTION_FIRST_BLOOD ); ?>" value="1" <?php checked( $first ); ?> />
								<?php esc_html_e( 'Activer le badge « première capture » sur les rooms avec machine', 'seca-academy' ); ?>
							</label>
							<p class="description">
								<?php esc_html_e( 'Désactivé par défaut : le classement reste opt-in et les apprenants mineurs ne sont pas exposés.', 'seca-academy' ); ?>
							</p>
						</td>
					</tr>
				</table>

				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}
}
