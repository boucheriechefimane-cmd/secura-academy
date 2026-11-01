<?php
/**
 * Shortcodes : tableau de bord, lecteur de room, profil.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Rendu de l'interface Secura Academy.
 */
final class Secura_Dashboard {

	/**
	 * Branche les hooks.
	 */
	public static function init() {
		add_shortcode( 'secura_academy', array( __CLASS__, 'shortcode' ) );
		add_shortcode( 'secura_academy_room', array( __CLASS__, 'room_shortcode' ) );
		add_shortcode( 'secura_academy_profile', array( __CLASS__, 'profile_shortcode' ) );
		add_shortcode( 'secura_academy_certificate', array( __CLASS__, 'certificate_shortcode' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_assets' ) );
	}

	/**
	 * Charge les styles et scripts.
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

		$lang = Secura_I18n::current_lang();

		wp_localize_script(
			'secura-academy',
			'SecuraAcademy',
			array(
				'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce( 'secura_academy' ),
				'loggedIn' => is_user_logged_in(),
				'lang'     => $lang,
				'dir'      => Secura_I18n::direction(),
				'levels'   => Secura_Progress::levels(),
				'i18n'     => Secura_I18n::dictionary()[ $lang ],
				'i18nAll'  => Secura_I18n::dictionary(),
				'languages' => Secura_I18n::languages(),
			)
		);
	}

	/**
	 * Sélecteur de langue.
	 *
	 * @return string
	 */
	private static function language_switcher() {
		$current = Secura_I18n::current_lang();
		$items   = '';

		foreach ( Secura_I18n::languages() as $code => $language ) {
			$items .= sprintf(
				'<button type="button" class="seca-lang %1$s" data-seca-lang="%2$s" aria-pressed="%3$s">%4$s</button>',
				$code === $current ? 'is-active' : '',
				esc_attr( $code ),
				$code === $current ? 'true' : 'false',
				esc_html( $language['native'] )
			);
		}

		return '<div class="seca-lang-switch" role="group" aria-label="' . esc_attr__( 'Langue', 'seca-academy' ) . '">' . $items . '</div>';
	}

	/**
	 * [secura_academy] : tableau de bord.
	 *
	 * @param array $atts Attributs.
	 * @return string
	 */
	public static function shortcode( $atts ) {
		$atts = shortcode_atts( array( 'path' => '' ), $atts, 'secura_academy' );

		if ( ! is_user_logged_in() ) {
			return self::render_guest();
		}

		$user_id = get_current_user_id();
		$state   = Secura_Progress::get_state( $user_id );
		$level   = $state['level'];
		$next    = Secura_Progress::next_level( $level );

		$range   = null === $level['max'] ? 1 : ( $level['max'] + 1 - $level['min'] );
		$percent = min( 100, max( 0, (int) round( ( ( $state['xp'] - $level['min'] ) / $range ) * 100 ) ) );

		$paths_html = '';
		$next_room  = null;
		$paths      = Secura_Paths::get_paths();

		/* L'attribut « path » permet de n'afficher qu'un parcours précis. */
		if ( $atts['path'] ) {
			$wanted = (string) $atts['path'];

			$paths = array_values(
				array_filter(
					$paths,
					function ( $path ) use ( $wanted ) {
						return (string) $path->ID === $wanted || $path->post_name === $wanted;
					}
				)
			);
		}

		foreach ( $paths as $path ) {
			$view     = Secura_Paths::get_path_view( $path->ID );
			$progress = Secura_Paths::get_progress( $user_id, $path->ID );

			if ( ! $view ) {
				continue;
			}

			if ( ! $next_room ) {
				foreach ( $view['sections'] as $section ) {
					foreach ( $section['rooms'] as $room_id ) {
						$room_state = Secura_Progress::get_room_state( $user_id, $room_id );

						if ( empty( $room_state['completed'] ) ) {
							$next_room = $room_id;
							break 2;
						}
					}
				}
			}

			$sections_html = '';

			foreach ( $view['sections'] as $section ) {
				$rooms_html = '';

				foreach ( $section['rooms'] as $room_id ) {
					$room_view  = Secura_Rooms::get_room_view( $room_id );
					$room_state = Secura_Progress::get_room_state( $user_id, $room_id );

					if ( ! $room_view ) {
						continue;
					}

					$status  = empty( $room_state['completed'] ) ? 'todo' : 'done';
					$medal   = isset( $room_state['medal'] ) ? $room_state['medal'] : '';
					$classes = 'seca-mini-room is-' . $status . ( $medal ? ' has-medal-' . $medal : '' );

					$rooms_html .= sprintf(
						'<li class="%1$s"><a href="%2$s"><span class="seca-mini-title">%3$s</span><span class="seca-mini-meta">%4$s</span>%5$s</a></li>',
						esc_attr( $classes ),
						esc_url( get_permalink( $room_id ) ),
						esc_html( $room_view['title'] ),
						esc_html( $room_view['difficulty'] ),
						$medal ? '<span class="seca-medal-dot seca-medal-' . esc_attr( $medal ) . '" aria-hidden="true"></span>' : ''
					);
				}

				$sections_html .= sprintf(
					'<li class="seca-section"><h4 class="seca-section-title">%1$s</h4><ul class="seca-mini-list">%2$s</ul></li>',
					esc_html( $section['title'] ),
					$rooms_html
				);
			}

			$paths_html .= sprintf(
				'<article class="seca-path-card">
					<header class="seca-path-head">
						<h3 class="seca-path-title">%1$s</h3>
						<span class="seca-chip">%2$s</span>
					</header>
					<p class="seca-path-excerpt">%3$s</p>
					<div class="seca-path-meta">
						<span class="seca-chip">%4$s</span>
						<span class="seca-chip">%5$s</span>
						<span class="seca-chip">%6$s</span>
					</div>
					<div class="seca-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="%7$d" aria-label="%8$s"><span class="seca-progress-fill" style="width:%7$d%%"></span></div>
					<p class="seca-path-progress">%9$s</p>
					<ul class="seca-section-list">%10$s</ul>
				</article>',
				esc_html( $view['title'] ),
				esc_html( $view['difficulty'] ),
				esc_html( $view['excerpt'] ),
				esc_html( sprintf( /* translators: %d : nombre de rooms. */ _n( '%d room', '%d rooms', $view['room_count'], 'seca-academy' ), $view['room_count'], 'seca-academy' ) ),
				esc_html( sprintf( /* translators: %d : minutes. */ __( '%d min', 'seca-academy' ), $view['duration'] ) ),
				esc_html( sprintf( /* translators: %d : XP. */ __( '+%d XP', 'seca-academy' ), $view['xp_bonus'] ) ),
				(int) $progress['percent'],
				esc_attr__( 'Progression du parcours', 'seca-academy' ),
				esc_html( sprintf( /* translators: 1 : rooms terminées, 2 : total. */ __( '%1$d / %2$d rooms terminées', 'seca-academy' ), $progress['done'], $progress['total'] ) ),
				$sections_html
			);
		}

		$rooms_html = '';

		foreach ( Secura_Rooms::get_rooms() as $room ) {
			$room_view  = Secura_Rooms::get_room_view( $room->ID );
			$room_state = Secura_Progress::get_room_state( $user_id, $room->ID );

			if ( ! $room_view ) {
				continue;
			}

			$status = 'todo';

			if ( ! empty( $room_state['completed'] ) ) {
				$status = 'done';
			} elseif ( ! empty( $room_state['tasks'] ) ) {
				$status = 'progress';
			}

			$medal = isset( $room_state['medal'] ) ? $room_state['medal'] : '';

			$rooms_html .= sprintf(
				'<li class="seca-room-card is-%1$s %2$s"><a href="%3$s"><span class="seca-room-status">%4$s</span><h3 class="seca-room-title">%5$s</h3><p class="seca-room-excerpt">%6$s</p><div class="seca-room-meta"><span class="seca-chip">%7$s</span><span class="seca-chip">%8$s</span><span class="seca-chip">%9$s</span></div></a></li>',
				esc_attr( $status ),
				$medal ? 'has-medal-' . esc_attr( $medal ) : '',
				esc_url( get_permalink( $room->ID ) ),
				esc_html( self::status_label( $status ) ),
				esc_html( $room_view['title'] ),
				esc_html( $room_view['excerpt'] ),
				esc_html( $room_view['difficulty'] ),
				esc_html( sprintf( /* translators: %d : minutes. */ __( '%d min', 'seca-academy' ), $room_view['duration'] ) ),
				esc_html( sprintf( /* translators: %d : XP. */ __( '+%d XP', 'seca-academy' ), $room_view['xp_bonus'] ) )
			);
		}

		$next_action = '';

		if ( $next_room ) {
			$next_view = Secura_Rooms::get_room_view( $next_room );

			if ( $next_view ) {
				$next_action = sprintf(
					'<a class="seca-next" href="%1$s"><span class="seca-next-label">%2$s</span><strong>%3$s</strong></a>',
					esc_url( get_permalink( $next_room ) ),
					esc_html__( 'Reprendre', 'seca-academy' ),
					esc_html( $next_view['title'] )
				);
			}
		}

		$user       = wp_get_current_user();
		$first_name = $user->first_name ? $user->first_name : $user->user_login;

		ob_start();
		?>
		<div class="seca-app" dir="<?php echo esc_attr( Secura_I18n::direction() ); ?>" data-seca-dashboard>
			<header class="seca-hero">
				<div class="seca-hero-main">
					<p class="seca-eyebrow"><?php esc_html_e( 'Secura Academy', 'seca-academy' ); ?> · <?php esc_html_e( '100 % gratuit', 'seca-academy' ); ?></p>
					<h2 class="seca-hero-title"><?php echo esc_html( sprintf( /* translators: %s : nom de l'utilisateur. */ __( 'Salut %s', 'seca-academy' ), $first_name ) ); ?></h2>
					<p class="seca-hero-sub"><?php esc_html_e( 'Choisis ton parcours, progresse étape par étape et collectionne les médailles.', 'seca-academy' ); ?></p>
					<?php echo $next_action; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- échappé ci-dessus. ?>
				</div>

				<div class="seca-stats">
					<div class="seca-stat"><span class="seca-stat-label"><?php esc_html_e( 'XP', 'seca-academy' ); ?></span><span class="seca-stat-value" data-seca-xp><?php echo esc_html( number_format_i18n( $state['xp'] ) ); ?></span></div>
					<div class="seca-stat"><span class="seca-stat-label"><?php esc_html_e( 'Niveau', 'seca-academy' ); ?></span><span class="seca-stat-value" data-seca-level><?php echo esc_html( $level['number'] . ' · ' . $level['label'] ); ?></span></div>
					<div class="seca-stat"><span class="seca-stat-label"><?php esc_html_e( 'Médailles', 'seca-academy' ); ?></span><span class="seca-stat-value" data-seca-medals><?php echo esc_html( count( $state['medals'] ) ); ?></span></div>
					<div class="seca-stat"><span class="seca-stat-label"><?php esc_html_e( 'Série', 'seca-academy' ); ?></span><span class="seca-stat-value" data-seca-streak><?php echo esc_html( isset( $state['streak']['current'] ) ? absint( $state['streak']['current'] ) : 0 ); ?></span></div>
					<div class="seca-level">
						<span class="seca-level-label" data-seca-level-next><?php echo esc_html( $next ? sprintf( /* translators: %s : nom du niveau suivant. */ __( '%d XP avant %s', 'seca-academy' ), max( 0, $next['min'] - $state['xp'] ), $next['label'] ) : __( 'Niveau maximum', 'seca-academy' ) ); ?></span>
						<div class="seca-xpbar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?php echo esc_attr( $percent ); ?>"><span class="seca-xpbar-fill" data-seca-xpbar style="width:<?php echo esc_attr( $percent ); ?>%"></span></div>
					</div>
				</div>

				<?php echo self::language_switcher(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- échappé ci-dessus. ?>
			</header>

			<section class="seca-section">
				<h3 class="seca-section-heading"><?php esc_html_e( 'Parcours', 'seca-academy' ); ?></h3>
				<div class="seca-path-grid"><?php echo $paths_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- échappé ci-dessus. ?></div>
			</section>

			<?php echo self::render_certificates( $user_id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendu échappé. ?>

			<section class="seca-section">
				<h3 class="seca-section-heading"><?php esc_html_e( 'Toutes les rooms', 'seca-academy' ); ?></h3>
				<ul class="seca-room-grid"><?php echo $rooms_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- échappé ci-dessus. ?></ul>
			</section>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Libellé d'un statut.
	 *
	 * @param string $status Statut.
	 * @return string
	 */
	private static function status_label( $status ) {
		$map = array(
			'done'     => __( 'Terminée', 'seca-academy' ),
			'progress' => __( 'En cours', 'seca-academy' ),
			'todo'     => __( 'À faire', 'seca-academy' ),
		);

		return isset( $map[ $status ] ) ? $map[ $status ] : $map['todo'];
	}

	/**
	 * Vue visiteur non connecté.
	 *
	 * @return string
	 */
	private static function render_guest() {
		ob_start();
		?>
		<div class="seca-app seca-app--guest" dir="<?php echo esc_attr( Secura_I18n::direction() ); ?>">
			<header class="seca-hero">
				<div class="seca-hero-main">
					<p class="seca-eyebrow"><?php esc_html_e( 'Secura Academy', 'seca-academy' ); ?> · <?php esc_html_e( '100 % gratuit', 'seca-academy' ); ?></p>
					<h2 class="seca-hero-title"><?php esc_html_e( 'Apprends la cybersécurité en jouant.', 'seca-academy' ); ?></h2>
					<p class="seca-hero-sub"><?php esc_html_e( 'Des parcours guidés, des exercices pratiques, des examens et des médailles. Créé un compte gratuit pour commencer.', 'seca-academy' ); ?></p>
					<div class="seca-hero-actions">
						<a class="seca-btn seca-btn--primary" href="<?php echo esc_url( wp_registration_url() ); ?>"><?php esc_html_e( 'Créer un compte gratuit', 'seca-academy' ); ?></a>
						<a class="seca-btn" href="<?php echo esc_url( wp_login_url() ); ?>"><?php esc_html_e( 'Se connecter', 'seca-academy' ); ?></a>
					</div>
				</div>
				<?php echo self::language_switcher(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- échappé ci-dessus. ?>
			</header>

			<ul class="seca-room-grid">
				<?php
				foreach ( Secura_Rooms::get_rooms() as $room ) :
					$view = Secura_Rooms::get_room_view( $room->ID );

					if ( ! $view ) {
						continue;
					}
					?>
					<li class="seca-room-card is-todo">
						<h3 class="seca-room-title"><?php echo esc_html( $view['title'] ); ?></h3>
						<p class="seca-room-excerpt"><?php echo esc_html( $view['excerpt'] ); ?></p>
						<div class="seca-room-meta"><span class="seca-chip"><?php echo esc_html( $view['difficulty'] ); ?></span><span class="seca-chip"><?php echo esc_html( sprintf( /* translators: %d : minutes. */ __( '%d min', 'seca-academy' ), $view['duration'] ) ); ?></span></div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * [secura_academy_room id="…"] : lecteur de room.
	 *
	 * @param array $atts Attributs.
	 * @return string
	 */
	public static function room_shortcode( $atts ) {
		$atts = shortcode_atts(
			array(
				'id'    => 0,
				'lang'  => '',
			),
			$atts,
			'secura_academy_room'
		);

		$room_id = absint( $atts['id'] );

		if ( ! $room_id ) {
			return '<p class="seca-empty">' . esc_html__( 'Room non spécifiée.', 'seca-academy' ) . '</p>';
		}

		$view = Secura_Rooms::get_room_view( $room_id, $atts['lang'] );

		if ( ! $view ) {
			return '<p class="seca-empty">' . esc_html__( 'Room introuvable.', 'seca-academy' ) . '</p>';
		}

		$lang = $atts['lang'] ? $atts['lang'] : Secura_I18n::current_lang();

		ob_start();
		?>
		<div class="seca-app seca-room" dir="<?php echo esc_attr( Secura_I18n::direction() ); ?>" data-seca-room="<?php echo esc_attr( $room_id ); ?>" data-seca-lang="<?php echo esc_attr( $lang ); ?>">

			<header class="seca-room-head">
				<div class="seca-room-head-main">
					<p class="seca-eyebrow" data-seca-room-kicker><?php echo esc_html( $view['difficulty'] ); ?> · <?php echo esc_html( sprintf( /* translators: %d : minutes. */ __( '%d min', 'seca-academy' ), $view['duration'] ) ); ?></p>
					<h1 class="seca-room-title" data-seca-room-title><?php echo esc_html( $view['title'] ); ?></h1>
					<p class="seca-room-excerpt" data-seca-room-excerpt><?php echo esc_html( $view['excerpt'] ); ?></p>
				</div>
				<div class="seca-room-head-side">
					<div class="seca-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" aria-label="<?php esc_attr_e( 'Progression de la room', 'seca-academy' ); ?>">
						<span class="seca-progress-fill" data-seca-room-bar style="width:0%"></span>
					</div>
					<span class="seca-room-progress-text" data-seca-room-progress-text><?php esc_html_e( 'Progression', 'seca-academy' ); ?></span>
				</div>
			</header>

			<?php
			/* La facade video du cours : rien n'est charge avant le clic. */
			$seca_video_html = Secura_Video::render( $room_id, $lang );

			if ( $seca_video_html ) {
				echo $seca_video_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- deja echappe dans Secura_Video::render().
			}

			/* Le bloc Kahoot : le quiz de classe, jouable en classe ou
			   seul, et exportable en CSV. */
			$seca_kahoot_html = Secura_Kahoot::render( $room_id, $lang );

			if ( $seca_kahoot_html ) {
				echo $seca_kahoot_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- deja echappe dans Secura_Kahoot::render().
			}
			?>

			<nav class="seca-task-nav" data-seca-task-nav aria-label="<?php esc_attr_e( 'Tâches de la room', 'seca-academy' ); ?>"></nav>

			<div class="seca-task-view" data-seca-task-view>
				<div class="seca-task-pane seca-task-pane--main">
					<div class="seca-task-header" data-seca-task-header></div>

					<div class="seca-task-body" data-seca-task-content></div>

					<div class="seca-questions" data-seca-questions></div>

					<div class="seca-task-actions" data-seca-task-actions></div>
					<p class="seca-task-status" data-seca-task-status role="status" aria-live="polite"></p>
				</div>

				<aside class="seca-task-pane seca-task-pane--side">
					<div class="seca-lab" data-seca-lab hidden>
						<div class="seca-lab-head">
							<span class="seca-lab-title"><?php esc_html_e( 'Machine cible', 'seca-academy' ); ?></span>
							<span class="seca-lab-state" data-seca-lab-state></span>
						</div>
						<p class="seca-lab-message" data-seca-lab-message role="status" aria-live="polite"></p>
						<p class="seca-lab-target" data-seca-lab-target></p>
						<div class="seca-lab-actions">
							<button type="button" class="seca-btn seca-btn--small" data-seca-lab-start><?php esc_html_e( 'Déployer la machine', 'seca-academy' ); ?></button>
							<button type="button" class="seca-btn seca-btn--small seca-btn--ghost" data-seca-lab-stop hidden><?php esc_html_e( 'Arrêter', 'seca-academy' ); ?></button>
						</div>
					</div>

					<div class="seca-terminal" data-seca-terminal hidden>
						<div class="seca-terminal-head">
							<span class="seca-terminal-title"><?php esc_html_e( 'Terminal', 'seca-academy' ); ?></span>
							<span class="seca-terminal-badge" data-seca-terminal-badge><?php esc_html_e( 'simulé', 'seca-academy' ); ?></span>
						</div>
						<pre class="seca-terminal-screen" data-seca-terminal-screen aria-live="polite"></pre>
						<form class="seca-terminal-form" data-seca-terminal-form>
							<label class="screen-reader-text" for="seca-terminal-input"><?php esc_html_e( 'Commande', 'seca-academy' ); ?></label>
							<span class="seca-terminal-prompt" aria-hidden="true">$</span>
							<input type="text" id="seca-terminal-input" class="seca-terminal-input" autocomplete="off" spellcheck="false" data-seca-terminal-input>
							<button type="submit" class="seca-btn seca-btn--small"><?php esc_html_e( 'Entrée', 'seca-academy' ); ?></button>
						</form>
						<p class="seca-terminal-note" data-seca-terminal-note><?php esc_html_e( 'Terminal simulé : aucune machine réelle n\'est exécutée.', 'seca-academy' ); ?></p>
					</div>
				</aside>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Rendu de la section « Certificats » du tableau de bord.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @return string
	 */
	private static function render_certificates( $user_id ) {
		$certificates = Secura_Paths::get_certificates( $user_id );

		if ( empty( $certificates ) ) {
			return '';
		}

		$items = '';

		foreach ( $certificates as $certificate ) {
			$items .= self::render_certificate( $certificate );
		}

		return sprintf(
			'<section class="seca-section seca-certificates">
				<h3 class="seca-section-heading">%1$s</h3>
				<p class="seca-section-note">%2$s</p>
				%3$s
			</section>',
			esc_html__( 'Certificats', 'seca-academy' ),
			esc_html__( 'Terminez toutes les rooms d\'un parcours pour obtenir son certificat.', 'seca-academy' ),
			$items
		);
	}

	/**
	 * Rendu d'un certificat.
	 *
	 * @param array $certificate Données du certificat.
	 * @return string
	 */
	private static function render_certificate( $certificate ) {
		$medal = isset( $certificate['medal'] ) ? $certificate['medal'] : '';

		ob_start();
		?>
		<article class="seca-certificate">
			<header class="seca-certificate-head">
				<p class="seca-certificate-kicker"><?php esc_html_e( 'Certificat de complétion', 'seca-academy' ); ?></p>
				<h3 class="seca-certificate-title"><?php echo esc_html( $certificate['title'] ); ?></h3>
			</header>

			<p class="seca-certificate-name"><?php echo esc_html( $certificate['name'] ); ?></p>

			<p class="seca-certificate-text">
				<?php
				printf(
					/* translators: %d : nombre de rooms validées. */
					esc_html__( 'a validé les %d rooms de ce parcours.', 'seca-academy' ),
					(int) $certificate['rooms']
				);
				?>
			</p>

			<ul class="seca-certificate-meta">
				<li><?php echo esc_html( $certificate['date'] ); ?></li>
				<li><?php echo esc_html( sprintf( /* translators: %d : XP. */ __( '%d XP', 'seca-academy' ), (int) $certificate['xp'] ) ); ?></li>
				<li><?php echo esc_html( $certificate['difficulty'] ); ?></li>
				<li><?php echo esc_html( sprintf( /* translators: %d : minutes. */ __( '%d min', 'seca-academy' ), (int) $certificate['duration'] ) ); ?></li>
			</ul>

			<footer class="seca-certificate-foot">
				<span class="seca-medal-badge seca-medal-<?php echo esc_attr( $medal ? $medal : 'bronze' ); ?>" aria-hidden="true"></span>
				<span class="seca-certificate-site"><?php echo esc_html( $certificate['site'] ); ?></span>
				<button type="button" class="seca-btn seca-btn--small" data-seca-print><?php esc_html_e( 'Imprimer', 'seca-academy' ); ?></button>
			</footer>
		</article>
		<?php
		return ob_get_clean();
	}

	/**
	 * [secura_academy_certificate] : certificats de parcours.
	 *
	 * @param array $atts Attributs.
	 * @return string
	 */
	public static function certificate_shortcode( $atts ) {
		$atts = shortcode_atts( array( 'path' => 0 ), $atts, 'secura_academy_certificate' );

		if ( ! is_user_logged_in() ) {
			return '<p class="seca-empty">' . esc_html__( 'Connectez-vous pour voir vos certificats.', 'seca-academy' ) . '</p>';
		}

		$user_id = get_current_user_id();

		if ( $atts['path'] ) {
			$certificate = Secura_Paths::get_certificate( $user_id, absint( $atts['path'] ) );

			if ( ! $certificate ) {
				return '<p class="seca-empty">' . esc_html__( 'Ce parcours n\'est pas encore terminé.', 'seca-academy' ) . '</p>';
			}

			return '<div class="seca-app seca-certificates">' . self::render_certificate( $certificate ) . '</div>';
		}

		$certificates = Secura_Paths::get_certificates( $user_id );

		if ( empty( $certificates ) ) {
			return '<p class="seca-empty">' . esc_html__( 'Aucun certificat pour le moment : terminez un parcours.', 'seca-academy' ) . '</p>';
		}

		$items = '';

		foreach ( $certificates as $certificate ) {
			$items .= self::render_certificate( $certificate );
		}

		return '<div class="seca-app seca-certificates">' . $items . '</div>';
	}

	/**
	 * [secura_academy_profile] : profil de l'apprenant.
	 *
	 * @param array $atts Attributs.
	 * @return string
	 */
	public static function profile_shortcode( $atts ) {
		if ( ! is_user_logged_in() ) {
			return '<p class="seca-empty">' . esc_html__( 'Connectez-vous pour voir votre profil.', 'seca-academy' ) . '</p>';
		}

		$user_id = get_current_user_id();
		$state   = Secura_Progress::get_state( $user_id );
		$level   = $state['level'];

		$medals_html = '';

		foreach ( $state['medals'] as $key => $medal ) {
			$medals_html .= sprintf(
				'<li class="seca-medal-item"><span class="seca-medal-badge seca-medal-%1$s" aria-hidden="true">%2$s</span><span class="seca-medal-name">%3$s</span></li>',
				esc_attr( isset( $medal['medal'] ) ? $medal['medal'] : '' ),
				'gold' === ( isset( $medal['medal'] ) ? $medal['medal'] : '' ) ? '🥇' : ( 'silver' === ( isset( $medal['medal'] ) ? $medal['medal'] : '' ) ? '🥈' : '🥉' ),
				esc_html( str_replace( array( 'room_', 'exam_', 'path_' ), '', $key ) )
			);
		}

		if ( '' === $medals_html ) {
			$medals_html = '<li class="seca-empty">' . esc_html__( 'Aucune médaille pour le moment.', 'seca-academy' ) . '</li>';
		}

		ob_start();
		?>
		<div class="seca-app seca-profile" dir="<?php echo esc_attr( Secura_I18n::direction() ); ?>">
			<header class="seca-hero">
				<div class="seca-hero-main">
					<p class="seca-eyebrow"><?php esc_html_e( 'Mon profil', 'seca-academy' ); ?></p>
					<h2 class="seca-hero-title"><?php echo esc_html( $level['number'] . ' · ' . $level['label'] ); ?></h2>
					<p class="seca-hero-sub"><?php echo esc_html( sprintf( /* translators: %d : XP. */ __( '%s XP au total', 'seca-academy' ), number_format_i18n( $state['xp'] ) ) ); ?></p>
				</div>
				<?php echo self::language_switcher(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- échappé ci-dessus. ?>
			</header>

			<section class="seca-section">
				<h3 class="seca-section-heading"><?php esc_html_e( 'Médailles', 'seca-academy' ); ?></h3>
				<ul class="seca-medal-grid"><?php echo $medals_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- échappé ci-dessus. ?></ul>
			</section>

			<section class="seca-section">
				<h3 class="seca-section-heading"><?php esc_html_e( 'Série', 'seca-academy' ); ?></h3>
				<p><?php echo esc_html( sprintf( /* translators: %d : nombre de jours. */ __( '%d jour(s) consécutif(s) — record : %d jours', 'seca-academy' ), isset( $state['streak']['current'] ) ? absint( $state['streak']['current'] ) : 0, isset( $state['streak']['longest'] ) ? absint( $state['streak']['longest'] ) : 0 ) ); ?></p>
			</section>
		</div>
		<?php
		return ob_get_clean();
	}
}
