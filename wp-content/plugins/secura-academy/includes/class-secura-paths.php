<?php
/**
 * Parcours (learning paths) : sections ordonnées, progression, certificat.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Gère le CPT « Parcours » et ses sections.
 */
final class Secura_Paths {

	/**
	 * Branche les hooks.
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_post_type' ) );
		add_action( 'add_meta_boxes', array( __CLASS__, 'add_meta_boxes' ) );
		add_action( 'save_post_' . SECURA_PATH_POST_TYPE, array( __CLASS__, 'save_path' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( 'Secura_Rooms', 'admin_assets' ) );
	}

	/**
	 * Enregistre le type de contenu.
	 */
	public static function register_post_type() {
		$labels = array(
			'name'          => __( 'Parcours', 'seca-academy' ),
			'singular_name' => __( 'Parcours', 'seca-academy' ),
			'menu_name'     => __( 'Parcours', 'seca-academy' ),
			'add_new'       => __( 'Ajouter', 'seca-academy' ),
			'edit_item'     => __( 'Modifier le parcours', 'seca-academy' ),
			'all_items'     => __( 'Tous les parcours', 'seca-academy' ),
		);

		register_post_type(
			SECURA_PATH_POST_TYPE,
			array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_rest'       => false,
				'has_archive'        => false,
				'hierarchical'       => false,
				'menu_position'      => 25,
				'menu_icon'          => 'dashicons-networking',
				'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
				'rewrite'            => array( 'slug' => 'parcours', 'with_front' => false ),
			)
		);
	}

	/**
	 * Crée les parcours de démonstration.
	 */
	public static function create_default_paths() {
		$existing = get_posts(
			array(
				'post_type'      => SECURA_PATH_POST_TYPE,
				'post_status'    => 'any',
				'numberposts'    => 1,
				'fields'         => 'ids',
				'no_found_rows'  => true,
			)
		);

		if ( ! empty( $existing ) ) {
			return;
		}

		$rooms = get_posts(
			array(
				'post_type'      => SECURA_POST_TYPE,
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'fields'         => 'ids',
			)
		);

		$paths = seca_default_paths( $rooms );
		$order = 0;

		foreach ( $paths as $path ) {
			$post_id = wp_insert_post(
				array(
					'post_type'    => SECURA_PATH_POST_TYPE,
					'post_status'  => 'publish',
					'post_title'   => $path['title'],
					'post_excerpt' => $path['excerpt'],
					'post_content' => $path['content'],
					'menu_order'   => $order,
				),
				true
			);

			if ( is_wp_error( $post_id ) ) {
				continue;
			}

			update_post_meta( $post_id, SECURA_META_PATH_SECTIONS, $path['sections'] );
			update_post_meta( $post_id, SECURA_META_DIFFICULTY, $path['difficulty'] );
			update_post_meta( $post_id, SECURA_META_DURATION, $path['duration'] );
			update_post_meta( $post_id, SECURA_META_XP_BONUS, $path['xp_bonus'] );
			update_post_meta( $post_id, SECURA_META_PATH_I18N, isset( $path['i18n'] ) ? $path['i18n'] : array() );

			$order++;
		}
	}

	/**
	 * Liste les parcours publiés.
	 *
	 * @return WP_Post[]
	 */
	public static function get_paths() {
		$paths = get_posts(
			array(
				'post_type'      => SECURA_PATH_POST_TYPE,
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			)
		);

		return is_array( $paths ) ? $paths : array();
	}

	/**
	 * Sections normalisées d'un parcours.
	 *
	 * @param int $path_id Identifiant du parcours.
	 * @return array
	 */
	public static function get_sections( $path_id ) {
		$raw = get_post_meta( $path_id, SECURA_META_PATH_SECTIONS, true );

		if ( ! is_array( $raw ) ) {
			return array();
		}

		$sections = array();

		foreach ( $raw as $section ) {
			if ( ! is_array( $section ) ) {
				continue;
			}

			$rooms = array();

			if ( isset( $section['rooms'] ) && is_array( $section['rooms'] ) ) {
				foreach ( $section['rooms'] as $room_id ) {
					$room_id = absint( $room_id );

					if ( $room_id ) {
						$rooms[] = $room_id;
					}
				}
			}

			$sections[] = array(
				'title' => isset( $section['title'] ) ? (string) $section['title'] : '',
				'rooms' => $rooms,
			);
		}

		return $sections;
	}

	/**
	 * Vue d'un parcours, traduite.
	 *
	 * @param int    $path_id Identifiant du parcours.
	 * @param string $lang    Langue.
	 * @return array|null
	 */
	public static function get_path_view( $path_id, $lang = '' ) {
		$path = get_post( $path_id );

		if ( ! $path || SECURA_PATH_POST_TYPE !== $path->post_type ) {
			return null;
		}

		$lang        = $lang ? $lang : Secura_I18n::current_lang();
		$translation = Secura_I18n::translate_post( $path_id, $lang, SECURA_META_PATH_I18N );
		$sections    = self::get_sections( $path_id );

		if ( ! empty( $translation['sections'] ) && is_array( $translation['sections'] ) ) {
			foreach ( $sections as $index => $section ) {
				if ( isset( $translation['sections'][ $index ]['title'] ) ) {
					$sections[ $index ]['title'] = $translation['sections'][ $index ]['title'];
				}
			}
		}

		$room_count = 0;

		foreach ( $sections as $section ) {
			$room_count += count( $section['rooms'] );
		}

		return array(
			'id'          => $path->ID,
			'title'       => $translation['title'] ? $translation['title'] : get_the_title( $path ),
			'excerpt'     => $translation['excerpt'] ? $translation['excerpt'] : $path->post_excerpt,
			'content'     => $translation['content'] ? $translation['content'] : wpautop( wp_kses_post( $path->post_content ) ),
			'sections'    => $sections,
			'room_count'  => $room_count,
			'difficulty'  => Secura_Rooms::get_difficulty( $path->ID ),
			'duration'    => absint( get_post_meta( $path->ID, SECURA_META_DURATION, true ) ),
			'xp_bonus'    => absint( get_post_meta( $path->ID, SECURA_META_XP_BONUS, true ) ),
			'certificate' => (bool) get_post_meta( $path->ID, '_secura_certificate', true ),
		);
	}

	/**
	 * Progression d'un parcours pour un utilisateur.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $path_id Identifiant du parcours.
	 * @return array
	 */
	public static function get_progress( $user_id, $path_id ) {
		$sections = self::get_sections( $path_id );
		$done     = 0;
		$total    = 0;

		foreach ( $sections as $section ) {
			foreach ( $section['rooms'] as $room_id ) {
				$total++;
				$state = Secura_Progress::get_room_state( $user_id, $room_id );

				if ( ! empty( $state['completed'] ) ) {
					$done++;
				}
			}
		}

		return array(
			'done'  => $done,
			'total' => $total,
			'percent' => $total > 0 ? (int) round( ( $done / $total ) * 100 ) : 0,
		);
	}

	/**
	 * Parcours complétés par un utilisateur.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @return array Liste de certificats (un par parcours terminé).
	 */
	public static function get_certificates( $user_id ) {
		$certificates = array();

		foreach ( self::get_paths() as $path ) {
			$certificate = self::get_certificate( $user_id, $path->ID );

			if ( $certificate ) {
				$certificates[] = $certificate;
			}
		}

		return $certificates;
	}

	/**
	 * Certificat de complétion d'un parcours.
	 *
	 * Retourne null si le parcours n'est pas terminé ou si le certificat
	 * n'est pas activé sur le parcours.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $path_id Identifiant du parcours.
	 * @return array|null
	 */
	public static function get_certificate( $user_id, $path_id ) {
		$view = self::get_path_view( $path_id );

		if ( ! $view || empty( $view['certificate'] ) ) {
			return null;
		}

		$progress = self::get_progress( $user_id, $path_id );

		if ( $progress['total'] < 1 || $progress['done'] < $progress['total'] ) {
			return null;
		}

		$user = get_userdata( $user_id );
		$name = '';

		if ( $user ) {
			$name = trim( $user->first_name . ' ' . $user->last_name );

			if ( '' === $name ) {
				$name = $user->user_login;
			}
		}

		$xp = 0;

		foreach ( $view['sections'] as $section ) {
			foreach ( $section['rooms'] as $room_id ) {
				$xp += absint( get_post_meta( $room_id, SECURA_META_XP_BONUS, true ) );
			}
		}

		return array(
			'path_id'    => (int) $path_id,
			'title'      => $view['title'],
			'name'       => $name,
			'date'       => date_i18n( get_option( 'date_format' ) ),
			'medal'      => self::path_medal( $user_id, $path_id ),
			'rooms'      => $progress['total'],
			'xp'         => $xp,
			'difficulty' => $view['difficulty'],
			'duration'   => $view['duration'],
			'site'       => get_bloginfo( 'name' ),
			'url'        => get_permalink( $path_id ),
		);
	}

	/**
	 * Médailles de parcours.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $path_id Identifiant du parcours.
	 * @return string
	 */
	public static function path_medal( $user_id, $path_id ) {
		$sections = self::get_sections( $path_id );
		$medals   = get_user_meta( $user_id, SECURA_USER_MEDALS, true );
		$medals   = is_array( $medals ) ? $medals : array();

		$all_gold = true;
		$any      = false;

		foreach ( $sections as $section ) {
			foreach ( $section['rooms'] as $room_id ) {
				$state = Secura_Progress::get_room_state( $user_id, $room_id );

				if ( empty( $state['completed'] ) ) {
					$all_gold = false;
					continue;
				}

				$any = true;

				if ( 'gold' !== $state['medal'] ) {
					$all_gold = false;
				}
			}
		}

		if ( ! $any ) {
			return '';
		}

		if ( $all_gold ) {
			return 'gold';
		}

		return isset( $medals[ 'path_' . $path_id ]['medal'] ) ? $medals[ 'path_' . $path_id ]['medal'] : 'silver';
	}

	/* ---------------------------------------------------------------------
	 * Édition
	 * ------------------------------------------------------------------ */

	/**
	 * Meta box du parcours.
	 */
	public static function add_meta_boxes() {
		add_meta_box(
			'secura-path-details',
			__( 'Structure du parcours', 'seca-academy' ),
			array( __CLASS__, 'render_meta_box' ),
			SECURA_PATH_POST_TYPE,
			'normal',
			'high'
		);
	}

	/**
	 * Rendu de la meta box.
	 *
	 * @param WP_Post $post Post en cours d'édition.
	 */
	public static function render_meta_box( $post ) {
		$sections   = self::get_sections( $post->ID );
		$rooms      = get_posts(
			array(
				'post_type'      => SECURA_POST_TYPE,
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			)
		);
		$difficulty = get_post_meta( $post->ID, SECURA_META_DIFFICULTY, true );
		$duration   = absint( get_post_meta( $post->ID, SECURA_META_DURATION, true ) );

		if ( ! is_string( $difficulty ) || ! array_key_exists( $difficulty, Secura_Rooms::difficulty_labels() ) ) {
			$difficulty = 'facile';
		}
		$bonus      = absint( get_post_meta( $post->ID, SECURA_META_XP_BONUS, true ) );
		$certificate = (bool) get_post_meta( $post->ID, '_secura_certificate', true );

		if ( ! is_string( $difficulty ) || '' === $difficulty ) {
			$difficulty = 'facile';
		}

		wp_nonce_field( 'secura_save_path', 'secura_path_nonce' );
		?>
		<div class="secura-metabox">
			<p>
				<label for="secura_path_difficulty"><?php esc_html_e( 'Difficulté du parcours', 'seca-academy' ); ?></label>
				<select id="secura_path_difficulty" name="secura_path_difficulty">
					<?php foreach ( Secura_Rooms::difficulty_labels() as $key => $label ) : ?>
						<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $difficulty, $key ); ?>><?php echo esc_html( $label ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<label for="secura_path_duration"><?php esc_html_e( 'Durée totale estimée (minutes)', 'seca-academy' ); ?></label>
				<input type="number" min="0" max="10000" id="secura_path_duration" name="secura_path_duration" value="<?php echo esc_attr( $duration ); ?>" />
			</p>

			<p>
				<label for="secura_path_xp_bonus"><?php esc_html_e( 'Bonus XP de complétion', 'seca-academy' ); ?></label>
				<input type="number" min="0" max="1000" id="secura_path_xp_bonus" name="secura_path_xp_bonus" value="<?php echo esc_attr( $bonus ); ?>" />
			</p>

			<p>
				<label><input type="checkbox" name="secura_path_certificate" value="1" <?php checked( $certificate ); ?> /> <?php esc_html_e( 'Délivrer un certificat de complétion', 'seca-academy' ); ?></label>
			</p>

			<h3 class="secura-metabox-title"><?php esc_html_e( 'Sections et rooms', 'seca-academy' ); ?></h3>

			<?php if ( empty( $rooms ) ) : ?>
				<p><em><?php esc_html_e( 'Aucune room publiée : créez d\'abord des rooms.', 'seca-academy' ); ?></em></p>
			<?php endif; ?>

			<div id="secura-sections">
				<?php
				if ( empty( $sections ) ) {
					echo self::render_section_row( array( 'title' => '', 'rooms' => array() ), $rooms ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendu échappé.
				} else {
					foreach ( $sections as $index => $section ) {
						echo self::render_section_row( $section, $rooms, $index ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendu échappé.
					}
				}
				?>
			</div>

			<p>
				<button type="button" class="button button-secondary" id="secura-add-section"><?php esc_html_e( '+ Ajouter une section', 'seca-academy' ); ?></button>
			</p>

			<script type="text/html" id="secura-section-template">
				<?php
				echo self::render_section_row( array( 'title' => '', 'rooms' => array() ), $rooms ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendu échappé.
				?>
			</script>
		</div>
		<?php
	}

	/**
	 * Rendu d'une ligne de section de parcours.
	 *
	 * @param array  $section Section.
	 * @param array  $rooms   Rooms publiées.
	 * @param int    $index   Index de la section (-1 pour une nouvelle).
	 * @return string
	 */
	private static function render_section_row( $section, $rooms, $index = -1 ) {
		$title = isset( $section['title'] ) ? (string) $section['title'] : '';
		$in    = isset( $section['rooms'] ) && is_array( $section['rooms'] ) ? $section['rooms'] : array();

		if ( $index < 0 ) {
			$name = 'secura_path_sections[]';
		} else {
			$name = 'secura_path_sections[' . absint( $index ) . ']';
		}

		ob_start();
		?>
		<p class="secura-section-row">
			<input type="text" name="<?php echo esc_attr( $name ); ?>[title]" value="<?php echo esc_attr( $title ); ?>" placeholder="<?php esc_attr_e( 'Titre de la section', 'seca-academy' ); ?>" class="large-text" />
			<select name="<?php echo esc_attr( $name ); ?>[rooms][]" multiple="multiple" size="5">
				<?php foreach ( $rooms as $room ) : ?>
					<option value="<?php echo esc_attr( $room->ID ); ?>" <?php echo in_array( (int) $room->ID, array_map( 'absint', $in ), true ) ? 'selected' : ''; ?>><?php echo esc_html( get_the_title( $room ) ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<?php
		return ob_get_clean();
	}

	/**
	 * Enregistre le parcours.
	 *
	 * @param int     $post_id Identifiant du post.
	 * @param WP_Post $post    Post en cours d'enregistrement.
	 */
	public static function save_path( $post_id, $post ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! isset( $_POST['secura_path_nonce'] ) ) {
			return;
		}

		$nonce = sanitize_text_field( wp_unslash( $_POST['secura_path_nonce'] ) );

		if ( ! wp_verify_nonce( $nonce, 'secura_save_path' ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}

		$raw     = isset( $_POST['secura_path_sections'] ) && is_array( $_POST['secura_path_sections'] ) ? wp_unslash( $_POST['secura_path_sections'] ) : array();
		$sections = array();

		foreach ( $raw as $section ) {
			if ( ! is_array( $section ) ) {
				continue;
			}

			$rooms = array();

			if ( isset( $section['rooms'] ) && is_array( $section['rooms'] ) ) {
				foreach ( $section['rooms'] as $room_id ) {
					$room_id = absint( $room_id );

					if ( $room_id ) {
						$rooms[] = $room_id;
					}
				}
			}

			$sections[] = array(
				'title' => isset( $section['title'] ) ? sanitize_text_field( $section['title'] ) : '',
				'rooms' => $rooms,
			);
		}

		update_post_meta( $post_id, SECURA_META_PATH_SECTIONS, $sections );
		update_post_meta( $post_id, SECURA_META_DIFFICULTY, isset( $_POST['secura_path_difficulty'] ) ? sanitize_key( wp_unslash( $_POST['secura_path_difficulty'] ) ) : 'facile' );
		update_post_meta( $post_id, SECURA_META_DURATION, isset( $_POST['secura_path_duration'] ) ? absint( wp_unslash( $_POST['secura_path_duration'] ) ) : 0 );
		update_post_meta( $post_id, SECURA_META_XP_BONUS, isset( $_POST['secura_path_xp_bonus'] ) ? absint( wp_unslash( $_POST['secura_path_xp_bonus'] ) ) : 0 );
		update_post_meta( $post_id, '_secura_certificate', isset( $_POST['secura_path_certificate'] ) ? 1 : 0 );
	}
}
