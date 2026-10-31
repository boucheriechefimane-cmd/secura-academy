<?php
/**
 * Shortcode [secura_academy] et rendu du tableau de bord.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Affiche le parcours de l'apprenant.
 */
final class Secura_Dashboard {

	/**
	 * Branche les hooks.
	 */
	public static function init() {
		add_shortcode( 'secura_academy', array( __CLASS__, 'shortcode' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_assets' ) );
	}

	/**
	 * Charge les styles et scripts du tableau de bord.
	 */
	public static function enqueue_assets() {
		wp_enqueue_style(
			'secura-academy',
			SECURA_ACADEMY_URL . 'assets/academy.css',
			array(),
			SECURA_ACADEMY_VERSION
		);

		wp_enqueue_script(
			'secura-academy',
			SECURA_ACADEMY_URL . 'assets/academy.js',
			array(),
			SECURA_ACADEMY_VERSION,
			true
		);

		wp_localize_script(
			'secura-academy',
			'SecuraAcademy',
			array(
				'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce( 'secura_academy' ),
				'loggedIn' => is_user_logged_in(),
				'levels'   => Secura_Progress::levels(),
				'i18n'     => array(
					'loading'      => __( 'Chargement…', 'seca-academy' ),
					'genericError' => __( 'Une erreur est survenue. Réessayez.', 'seca-academy' ),
					'networkError' => __( 'Connexion impossible. Vérifiez votre réseau.', 'seca-academy' ),
					'close'        => __( 'Fermer', 'seca-academy' ),
					'validate'     => __( 'Valider', 'seca-academy' ),
					'hint'         => __( 'Afficher l\'indice', 'seca-academy' ),
					'answerLabel'  => __( 'Votre réponse', 'seca-academy' ),
					'stepsTitle'   => __( 'Étapes de la room', 'seca-academy' ),
					'solved'       => __( 'Validée', 'seca-academy' ),
					'xpLabel'      => __( 'XP', 'seca-academy' ),
					'roomsDone'    => __( 'rooms terminées', 'seca-academy' ),
					'trophyToast'  => __( 'Trophée débloqué', 'seca-academy' ),
				),
			)
		);
	}

	/**
	 * Point d'entrée du shortcode.
	 *
	 * @param array $atts Attributs du shortcode.
	 * @return string
	 */
	public static function shortcode( $atts ) {
		$atts = shortcode_atts(
			array(
				'title'    => __( 'Votre parcours de cybersécurité', 'seca-academy' ),
				'rooms'    => -1,
			),
			$atts,
			'secura_academy'
		);

		$rooms = Secura_Rooms::get_rooms();

		if ( -1 !== (int) $atts['rooms'] ) {
			$rooms = array_slice( $rooms, 0, max( 0, (int) $atts['rooms'] ) );
		}

		if ( empty( $rooms ) ) {
			return '<p class="secura-empty">' . esc_html__( 'Aucun parcours publié pour le moment.', 'seca-academy' ) . '</p>';
		}

		if ( ! is_user_logged_in() ) {
			return self::render_guest( $atts['title'], $rooms );
		}

		return self::render_dashboard( $atts['title'], $rooms );
	}

	/**
	 * Vue pour les visiteurs non connectés.
	 *
	 * @param string $title Titre du bloc.
	 * @param array  $rooms Rooms disponibles.
	 * @return string
	 */
	private static function render_guest( $title, $rooms ) {
		$items = '';

		foreach ( $rooms as $room ) {
			$items .= sprintf(
				'<li class="secura-room-card is-locked"><span class="secura-room-title">%1$s</span><span class="secura-room-meta">%2$s · %3$s</span></li>',
				esc_html( get_the_title( $room ) ),
				esc_html( Secura_Rooms::get_difficulty( $room->ID ) ),
				esc_html( sprintf( /* translators: %d : minutes. */ __( '%d min', 'seca-academy' ), absint( get_post_meta( $room->ID, SECURA_META_DURATION, true ) ) ) )
			);
		}

		$register_url = wp_registration_url();
		$login_url    = wp_login_url( get_permalink() );

		ob_start();
		?>
		<section class="secura-dashboard seca-dashboard--guest" data-secura-dashboard>
			<header class="secura-dash-header">
				<div>
					<p class="secura-eyebrow"><?php esc_html_e( 'Secura Academy', 'seca-academy' ); ?></p>
					<h2 class="secura-dash-title"><?php echo esc_html( $title ); ?></h2>
					<p class="secura-dash-sub"><?php esc_html_e( 'Créez un compte pour suivre votre progression, gagner des XP et débloquer des trophées.', 'seca-academy' ); ?></p>
				</div>
				<div class="secura-dash-actions">
					<a class="secura-btn seca-btn--primary" href="<?php echo esc_url( $register_url ); ?>"><?php esc_html_e( 'Créer un compte', 'seca-academy' ); ?></a>
					<a class="secura-btn" href="<?php echo esc_url( $login_url ); ?>"><?php esc_html_e( 'Se connecter', 'seca-academy' ); ?></a>
				</div>
			</header>
			<ul class="secura-room-list" aria-label="<?php esc_attr_e( 'Parcours à venir', 'seca-academy' ); ?>">
				<?php echo $items; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- construit et échappé ci-dessus. ?>
			</ul>
		</section>
		<?php
		return ob_get_clean();
	}

	/**
	 * Vue pour un apprenant connecté.
	 *
	 * @param string $title Titre du bloc.
	 * @param array  $rooms Rooms disponibles.
	 * @return string
	 */
	private static function render_dashboard( $title, $rooms ) {
		$user_id = get_current_user_id();
		$state   = Secura_Progress::get_state( $user_id );
		$level   = Secura_Progress::level_for_xp( $state['xp'] );

		$range = max( 1, ( null === $level['max'] ? $level['min'] + 1 : $level['max'] + 1 ) - $level['min'] );
		$into_level = $state['xp'] - $level['min'];
		$percent = min( 100, max( 0, (int) round( ( $into_level / $range ) * 100 ) ) );

		$done = 0;
		$previous_completed = true;
		$cards = '';

		foreach ( $rooms as $index => $room ) {
			$progress = Secura_Progress::get_room_progress( $user_id, $room->ID );
			$total_questions = count( Secura_Rooms::get_questions( $room->ID ) );
			$solved_count = count( $progress['solved'] );

			$is_completed = ! empty( $progress['completed'] );
			$is_locked = ! $previous_completed;

			if ( $is_completed ) {
				$done++;
			}

			$status_class = 'is-current';
			$status_label = __( 'À faire', 'seca-academy' );

			if ( $is_completed ) {
				$status_class = 'is-done';
				$status_label = __( 'Terminée', 'seca-academy' );
			} elseif ( $is_locked ) {
				$status_class = 'is-locked';
				$status_label = __( 'Verrouillée', 'seca-academy' );
			} elseif ( $solved_count > 0 ) {
				$status_class = 'is-progress';
				$status_label = __( 'En cours', 'seca-academy' );
			}

			$percent_room = $total_questions > 0 ? (int) round( ( $solved_count / $total_questions ) * 100 ) : 0;

			$cards .= sprintf(
				'<li class="secura-room-card %1$s" data-sa-room="%2$d" data-sa-status="%3$s" role="button" tabindex="0" aria-disabled="%4$s">
					<div class="secura-room-head">
						<span class="secura-room-index">%5$s</span>
						<span class="secura-room-status">%6$s</span>
					</div>
					<h3 class="secura-room-title">%7$s</h3>
					<p class="secura-room-excerpt">%8$s</p>
					<div class="secura-room-meta">
						<span class="secura-chip">%9$s</span>
						<span class="secura-chip">%10$s</span>
						<span class="secura-chip">%11$s</span>
					</div>
					<div class="secura-room-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="%12$d" aria-label="%13$s">
						<span class="secura-room-bar-fill" style="width:%12$d%%"></span>
					</div>
					<p class="secura-room-progress-text">%14$s</p>
				</li>',
				esc_attr( $status_class ),
				(int) $room->ID,
				esc_attr( $status_label ),
				$is_locked ? 'true' : 'false',
				esc_html( sprintf( '%02d', $index + 1 ) ),
				esc_html( $status_label ),
				esc_html( get_the_title( $room ) ),
				esc_html( $room->post_excerpt ),
				esc_html( Secura_Rooms::get_difficulty( $room->ID ) ),
				esc_html( sprintf( /* translators: %d : minutes. */ __( '%d min', 'seca-academy' ), absint( get_post_meta( $room->ID, SECURA_META_DURATION, true ) ) ) ),
				esc_html( sprintf( /* translators: %d : XP. */ __( '%d XP', 'seca-academy' ), absint( get_post_meta( $room->ID, SECURA_META_XP_BONUS, true ) ) ) ),
				$percent_room,
				esc_attr( sprintf( /* translators: %s : titre de la room. */ __( 'Progression de %s', 'seca-academy' ), get_the_title( $room ) ) ),
				esc_html( sprintf( /* translators: 1 : étapes validées, 2 : total. */ __( '%1$d / %2$d étapes validées', 'seca-academy' ), $solved_count, $total_questions ) )
			);

			$previous_completed = $is_completed;
		}

		$trophies_html = '';
		foreach ( $state['trophies'] as $trophy ) {
			$trophies_html .= sprintf(
				'<li class="secura-trophy"><span class="secura-trophy-icon" aria-hidden="true">%1$s</span><span class="secura-trophy-body"><strong>%2$s</strong><span>%3$s</span></span></li>',
				esc_html( isset( $trophy['icon'] ) ? $trophy['icon'] : '🏅' ),
				esc_html( isset( $trophy['name'] ) ? $trophy['name'] : '' ),
				esc_html( isset( $trophy['description'] ) ? $trophy['description'] : '' )
			);
		}

		if ( '' === $trophies_html ) {
			$trophies_html = '<li class="secura-trophy is-empty">' . esc_html__( 'Aucun trophée pour l\'instant : validez une première réponse.', 'seca-academy' ) . '</li>';
		}

		$user       = wp_get_current_user();
		$first_name = $user->first_name ? $user->first_name : $user->user_login;
		$rooms_done = count( $rooms ) > 0 ? (int) round( ( $done / count( $rooms ) ) * 100 ) : 0;

		ob_start();
		?>
		<section class="secura-dashboard" data-secura-dashboard>
			<header class="secura-dash-header">
				<div class="secura-greeting">
					<p class="secura-eyebrow"><?php esc_html_e( 'Tableau de bord', 'seca-academy' ); ?></p>
					<h2 class="secura-dash-title"><?php echo esc_html( sprintf( /* translators: %s : nom de l'utilisateur. */ __( 'Salut %s', 'seca-academy' ), $first_name ) ); ?></h2>
					<p class="secura-dash-sub"><?php esc_html_e( 'Reprenez votre parcours : la prochaine room vous attend.', 'seca-academy' ); ?></p>
				</div>

				<div class="secura-stats">
					<div class="secura-stat">
						<span class="secura-stat-label"><?php esc_html_e( 'XP', 'seca-academy' ); ?></span>
						<span class="secura-stat-value" data-sa-xp><?php echo esc_html( number_format_i18n( $state['xp'] ) ); ?></span>
					</div>
					<div class="secura-stat">
						<span class="secura-stat-label"><?php esc_html_e( 'Rooms', 'seca-academy' ); ?></span>
						<span class="secura-stat-value" data-sa-rooms-done><?php echo esc_html( $done . ' / ' . count( $rooms ) ); ?></span>
					</div>
					<div class="secura-stat">
						<span class="secura-stat-label"><?php esc_html_e( 'Trophées', 'seca-academy' ); ?></span>
						<span class="secura-stat-value" data-sa-trophies-count><?php echo esc_html( count( $state['trophies'] ) ); ?></span>
					</div>
					<div class="secura-level">
						<span class="secura-level-label" data-sa-level><?php echo esc_html( sprintf( /* translators: 1 : numéro de niveau, 2 : libellé. */ __( 'Niveau %1$d — %2$s', 'seca-academy' ), $level['number'], $level['label'] ) ); ?></span>
						<div class="secura-xpbar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?php echo esc_attr( $percent ); ?>" aria-label="<?php esc_attr_e( 'Progression vers le niveau suivant', 'seca-academy' ); ?>">
							<span class="secura-xpbar-fill" data-sa-xpbar style="width:<?php echo esc_attr( $percent ); ?>%"></span>
						</div>
						<span class="secura-level-hint" data-sa-level-hint><?php echo esc_html( sprintf( /* translators: %d : XP restants. */ __( '%d XP avant le niveau suivant', 'seca-academy' ), max( 0, ( null === $level['max'] ? 0 : $level['max'] + 1 ) - $state['xp'] ) ) ); ?></span>
					</div>
				</div>
			</header>

			<section class="secura-section seca-section--progress">
				<h3 class="secura-section-title"><?php esc_html_e( 'Avancement du parcours', 'seca-academy' ); ?></h3>
				<div class="secura-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?php echo esc_attr( $rooms_done ); ?>" aria-label="<?php esc_attr_e( 'Avancement global du parcours', 'seca-academy' ); ?>">
					<span class="secura-progress-fill" data-sa-progress style="width:<?php echo esc_attr( $rooms_done ); ?>%"></span>
				</div>
				<p class="secura-progress-text" data-sa-progress-text><?php echo esc_html( sprintf( /* translators: 1 : rooms terminées, 2 : total. */ __( '%1$d room(s) terminée(s) sur %2$d.', 'seca-academy' ), $done, count( $rooms ) ) ); ?></p>
			</section>

			<section class="secura-section seca-section--trophies">
				<h3 class="secura-section-title"><?php esc_html_e( 'Trophées', 'seca-academy' ); ?></h3>
				<ul class="secura-trophy-list" data-sa-trophies><?php echo $trophies_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- échappé ci-dessus. ?></ul>
			</section>

			<section class="secura-section seca-section--rooms">
				<h3 class="secura-section-title"><?php esc_html_e( 'Parcours', 'seca-academy' ); ?></h3>
				<ol class="secura-room-list" data-sa-rooms><?php echo $cards; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- échappé ci-dessus. ?></ol>
			</section>
		</section>

		<div class="secura-panel" data-sa-panel hidden role="dialog" aria-modal="true" aria-labelledby="secura-panel-title">
			<div class="secura-panel-backdrop" data-sa-close></div>
			<div class="secura-panel-body" role="document">
				<header class="secura-panel-head">
					<div>
						<p class="secura-eyebrow" data-sa-panel-eyebrow></p>
						<h3 class="secura-panel-title" id="secura-panel-title" data-sa-panel-title></h3>
					</div>
					<button type="button" class="secura-panel-close" data-sa-close aria-label="<?php esc_attr_e( 'Fermer', 'seca-academy' ); ?>">&times;</button>
				</header>
				<div class="secura-panel-content" data-sa-panel-content></div>
				<div class="secura-panel-steps" data-sa-panel-steps hidden></div>
				<p class="secura-panel-status" data-sa-panel-status role="status" aria-live="polite"></p>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}
