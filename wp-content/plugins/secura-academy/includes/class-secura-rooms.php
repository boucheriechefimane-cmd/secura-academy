<?php
/**
 * Type de contenu « Rooms », édition et contenu par défaut.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Gère le CPT, sa meta box et les rooms par défaut.
 */
final class Secura_Rooms {

	/**
	 * Branche les hooks.
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_post_type' ) );
		add_action( 'add_meta_boxes', array( __CLASS__, 'add_meta_boxes' ) );
		add_action( 'save_post_' . SECURA_POST_TYPE, array( __CLASS__, 'save_room' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_assets' ) );
	}

	/**
	 * Enregistre le type de contenu.
	 */
	public static function register_post_type() {
		$labels = array(
			'name'               => __( 'Rooms', 'seca-academy' ),
			'singular_name'      => __( 'Room', 'seca-academy' ),
			'menu_name'          => __( 'Rooms', 'seca-academy' ),
			'add_new'            => __( 'Ajouter', 'seca-academy' ),
			'add_new_item'       => __( 'Ajouter une nouvelle room', 'seca-academy' ),
			'edit_item'          => __( 'Modifier la room', 'seca-academy' ),
			'new_item'           => __( 'Nouvelle room', 'seca-academy' ),
			'view_item'          => __( 'Voir la room', 'seca-academy' ),
			'search_items'       => __( 'Rechercher une room', 'seca-academy' ),
			'not_found'          => __( 'Aucune room trouvée.', 'seca-academy' ),
			'not_found_in_trash' => __( 'Aucune room dans la corbeille.', 'seca-academy' ),
			'all_items'          => __( 'Toutes les rooms', 'seca-academy' ),
		);

		register_post_type(
			SECURA_POST_TYPE,
			array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_rest'       => false,
				'has_archive'        => false,
				'hierarchical'       => false,
				'menu_position'      => 26,
				'menu_icon'          => 'dashicons-shield-alt',
				'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
				'rewrite'            => array( 'slug' => 'rooms', 'with_front' => false ),
				'capability_type'    => 'post',
			)
		);
	}

	/**
	 * Crée les rooms par défaut à l'activation.
	 */
	public static function activate() {
		self::register_post_type();

		$existing = get_posts(
			array(
				'post_type'      => SECURA_POST_TYPE,
				'post_status'    => 'any',
				'numberposts'    => 1,
				'fields'         => 'ids',
				'no_found_rows'  => true,
				'suppress_filters' => false,
			)
		);

		if ( empty( $existing ) ) {
			self::create_default_rooms();
		}

		flush_rewrite_rules();
	}

	/**
	 * Insère le contenu de démonstration.
	 */
	public static function create_default_rooms() {
		$order = 0;

		foreach ( seca_default_rooms() as $room ) {
			$post_id = wp_insert_post(
				array(
					'post_type'    => SECURA_POST_TYPE,
					'post_status'  => 'publish',
					'post_title'   => $room['title'],
					'post_excerpt' => $room['excerpt'],
					'post_content' => $room['content'],
					'menu_order'   => $order,
				),
				true
			);

			if ( is_wp_error( $post_id ) ) {
				continue;
			}

			$questions = array();

			foreach ( $room['questions'] as $question ) {
				$questions[] = array(
					'question' => $question['question'],
					'answers'  => array_values( $question['answers'] ),
					'xp'       => (int) $question['xp'],
					'hint'     => $question['hint'],
				);
			}

			update_post_meta( $post_id, SECURA_META_QUESTIONS, $questions );
			update_post_meta( $post_id, SECURA_META_DIFFICULTY, $room['difficulty'] );
			update_post_meta( $post_id, SECURA_META_DURATION, (int) $room['duration'] );
			update_post_meta( $post_id, SECURA_META_XP_BONUS, (int) $room['xp_bonus'] );

			$order++;
		}
	}

	/**
	 * Liste les rooms publiées, dans l'ordre du parcours.
	 *
	 * @return WP_Post[]
	 */
	public static function get_rooms() {
		$rooms = get_posts(
			array(
				'post_type'      => SECURA_POST_TYPE,
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'suppress_filters' => false,
			)
		);

		return is_array( $rooms ) ? $rooms : array();
	}

	/**
	 * Retourne les questions d'une room, normalisées.
	 *
	 * @param int $room_id Identifiant de la room.
	 * @return array
	 */
	public static function get_questions( $room_id ) {
		$room_id = absint( $room_id );

		if ( ! $room_id ) {
			return array();
		}

		$raw = get_post_meta( $room_id, SECURA_META_QUESTIONS, true );

		if ( ! is_array( $raw ) ) {
			return array();
		}

		$questions = array();

		foreach ( $raw as $item ) {
			if ( ! is_array( $item ) ) {
				continue;
			}

			$question = isset( $item['question'] ) ? trim( (string) $item['question'] ) : '';

			if ( '' === $question ) {
				continue;
			}

			$answers = array();

			if ( isset( $item['answers'] ) && is_array( $item['answers'] ) ) {
				foreach ( $item['answers'] as $answer ) {
					$answer = trim( (string) $answer );

					if ( '' !== $answer ) {
						$answers[] = $answer;
					}
				}
			} elseif ( isset( $item['answer'] ) ) {
				foreach ( explode( '|', (string) $item['answer'] ) as $answer ) {
					$answer = trim( $answer );

					if ( '' !== $answer ) {
						$answers[] = $answer;
					}
				}
			}

			if ( empty( $answers ) ) {
				continue;
			}

			$questions[] = array(
				'question' => $question,
				'answers'  => $answers,
				'xp'       => isset( $item['xp'] ) ? absint( $item['xp'] ) : 10,
				'hint'     => isset( $item['hint'] ) ? (string) $item['hint'] : '',
			);
		}

		return $questions;
	}

	/**
	 * Difficulté lisible d'une room.
	 *
	 * @param int $room_id Identifiant de la room.
	 * @return string
	 */
	public static function get_difficulty( $room_id ) {
		$difficulty = get_post_meta( $room_id, SECURA_META_DIFFICULTY, true );
		$labels     = self::difficulty_labels();

		if ( ! is_string( $difficulty ) || ! isset( $labels[ $difficulty ] ) ) {
			return $labels['facile'];
		}

		return $labels[ $difficulty ];
	}

	/**
	 * Libellés de difficulté.
	 *
	 * @return array
	 */
	public static function difficulty_labels() {
		return array(
			'facile'   => __( 'Facile', 'seca-academy' ),
			'moyen'    => __( 'Moyen', 'seca-academy' ),
			'difficile' => __( 'Difficile', 'seca-academy' ),
			'expert'   => __( 'Expert', 'seca-academy' ),
		);
	}

	/* ---------------------------------------------------------------------
	 * Édition dans l'admin
	 * ------------------------------------------------------------------ */

	/**
	 * Déclare la meta box.
	 */
	public static function add_meta_boxes() {
		add_meta_box(
			'secura-room-details',
			__( 'Parcours Secura', 'seca-academy' ),
			array( __CLASS__, 'render_meta_box' ),
			SECURA_POST_TYPE,
			'normal',
			'high'
		);
	}

	/**
	 * Affiche la meta box.
	 *
	 * @param WP_Post $post Post en cours d'édition.
	 */
	public static function render_meta_box( $post ) {
		$questions = self::get_questions( $post->ID );
		$difficulty = get_post_meta( $post->ID, SECURA_META_DIFFICULTY, true );
		$duration   = absint( get_post_meta( $post->ID, SECURA_META_DURATION, true ) );
		$bonus      = absint( get_post_meta( $post->ID, SECURA_META_XP_BONUS, true ) );

		if ( ! is_string( $difficulty ) || '' === $difficulty ) {
			$difficulty = 'facile';
		}

		if ( ! $bonus ) {
			$bonus = 25;
		}

		wp_nonce_field( 'secura_save_room', 'secura_room_nonce' );
		?>
		<div class="secura-metabox">

			<h3 class="secura-metabox-title"><?php esc_html_e( 'Paramètres de la room', 'seca-academy' ); ?></h3>

			<p>
				<label for="secura_difficulty"><?php esc_html_e( 'Difficulté', 'seca-academy' ); ?></label>
				<select id="secura_difficulty" name="secura_difficulty">
					<?php foreach ( self::difficulty_labels() as $key => $label ) : ?>
						<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $difficulty, $key ); ?>><?php echo esc_html( $label ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<label for="secura_duration"><?php esc_html_e( 'Durée indicative (en minutes)', 'seca-academy' ); ?></label>
				<input type="number" min="0" max="600" id="secura_duration" name="secura_duration" value="<?php echo esc_attr( $duration ); ?>" />
			</p>

			<p>
				<label for="secura_xp_bonus"><?php esc_html_e( 'Bonus XP à la complétion de la room', 'seca-academy' ); ?></label>
				<input type="number" min="0" max="500" id="secura_xp_bonus" name="secura_xp_bonus" value="<?php echo esc_attr( $bonus ); ?>" />
			</p>

			<h3 class="secura-metabox-title"><?php esc_html_e( 'Questions et réponses attendues', 'seca-academy' ); ?></h3>

			<p class="description">
				<?php esc_html_e( 'Les réponses ne sont jamais envoyées au navigateur : elles restent côté serveur et sont vérifiées en AJAX. Une réponse par ligne si vous acceptez plusieurs formulations.', 'seca-academy' ); ?>
			</p>

			<div class="secura-questions" id="secura-questions">
				<?php if ( empty( $questions ) ) : ?>
					<div class="secura-question-row" data-index="0">
						<?php self::render_question_fields( 0, array( 'question' => '', 'answers' => array(), 'xp' => 10, 'hint' => '' ) ); ?>
					</div>
				<?php else : ?>
					<?php foreach ( $questions as $index => $question ) : ?>
						<div class="secura-question-row" data-index="<?php echo esc_attr( $index ); ?>">
							<?php self::render_question_fields( $index, $question ); ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>

			<p>
				<button type="button" class="button button-secondary" id="secura-add-question"><?php esc_html_e( '+ Ajouter une question', 'seca-academy' ); ?></button>
			</p>

			<script type="text/html" id="secura-question-template">
				<div class="secura-question-row">
					<?php
					/* translators: %d : numéro de la question. */
					self::render_question_fields( '%INDEX%', array( 'question' => '', 'answers' => array(), 'xp' => 10, 'hint' => '' ) );
					?>
				</div>
			</script>
		</div>
		<?php
	}

	/**
	 * Affiche les champs d'une question.
	 *
	 * @param int|string $index    Index de la question.
	 * @param array      $question Données de la question.
	 */
	private static function render_question_fields( $index, $question ) {
		$answers = isset( $question['answers'] ) && is_array( $question['answers'] ) ? implode( "\n", $question['answers'] ) : '';
		$xp      = isset( $question['xp'] ) ? absint( $question['xp'] ) : 10;
		$hint    = isset( $question['hint'] ) ? (string) $question['hint'] : '';
		?>
		<p class="secura-question-label">
			<?php
			/* translators: %s : numéro de la question. */
			printf( esc_html__( 'Question %s', 'seca-academy' ), '<span class="secura-question-number">' . esc_html( (string) $index ) . '</span>' );
			?>
			<button type="button" class="button-link-delete seca-remove-question"><?php esc_html_e( 'Supprimer', 'seca-academy' ); ?></button>
		</p>

		<p>
			<label><?php esc_html_e( 'Énoncé', 'seca-academy' ); ?></label>
			<textarea name="secura_questions[<?php echo esc_attr( $index ); ?>][question]" rows="2" class="large-text"><?php echo esc_textarea( $question['question'] ); ?></textarea>
		</p>

		<p>
			<label><?php esc_html_e( 'Réponses acceptées (une par ligne)', 'seca-academy' ); ?></label>
			<textarea name="secura_questions[<?php echo esc_attr( $index ); ?>][answers]" rows="3" class="large-text"><?php echo esc_textarea( $answers ); ?></textarea>
		</p>

		<p>
			<label><?php esc_html_e( 'Indice (optionnel)', 'seca-academy' ); ?></label>
			<input type="text" class="large-text" name="secura_questions[<?php echo esc_attr( $index ); ?>][hint]" value="<?php echo esc_attr( $hint ); ?>" />
		</p>

		<p>
			<label><?php esc_html_e( 'XP gagnés', 'seca-academy' ); ?></label>
			<input type="number" min="0" max="200" name="secura_questions[<?php echo esc_attr( $index ); ?>][xp]" value="<?php echo esc_attr( $xp ); ?>" />
		</p>
		<?php
	}

	/**
	 * Enregistre les données de la meta box.
	 *
	 * @param int     $post_id Identifiant du post.
	 * @param WP_Post $post    Post en cours d'enregistrement.
	 */
	public static function save_room( $post_id, $post ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! isset( $_POST['secura_room_nonce'] ) ) {
			return;
		}

		$nonce = sanitize_text_field( wp_unslash( $_POST['secura_room_nonce'] ) );

		if ( ! wp_verify_nonce( $nonce, 'secura_save_room' ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}

		$difficulty = isset( $_POST['secura_difficulty'] ) ? sanitize_key( wp_unslash( $_POST['secura_difficulty'] ) ) : 'facile';

		if ( ! array_key_exists( $difficulty, self::difficulty_labels() ) ) {
			$difficulty = 'facile';
		}

		update_post_meta( $post_id, SECURA_META_DIFFICULTY, $difficulty );
		update_post_meta( $post_id, SECURA_META_DURATION, isset( $_POST['secura_duration'] ) ? absint( wp_unslash( $_POST['secura_duration'] ) ) : 0 );
		update_post_meta( $post_id, SECURA_META_XP_BONUS, isset( $_POST['secura_xp_bonus'] ) ? absint( wp_unslash( $_POST['secura_xp_bonus'] ) ) : 25 );

		$raw   = isset( $_POST['secura_questions'] ) && is_array( $_POST['secura_questions'] ) ? wp_unslash( $_POST['secura_questions'] ) : array();
		$clean = array();

		foreach ( $raw as $row ) {
			if ( ! is_array( $row ) ) {
				continue;
			}

			$question = isset( $row['question'] ) ? trim( sanitize_textarea_field( $row['question'] ) ) : '';

			if ( '' === $question ) {
				continue;
			}

			$answers = array();

			if ( isset( $row['answers'] ) ) {
				$lines = preg_split( '/\r\n|\r|\n/', (string) $row['answers'] );

				foreach ( (array) $lines as $line ) {
					$line = trim( sanitize_text_field( $line ) );

					if ( '' !== $line ) {
						$answers[] = $line;
					}
				}
			}

			if ( empty( $answers ) ) {
				continue;
			}

			$clean[] = array(
				'question' => $question,
				'answers'  => $answers,
				'xp'       => isset( $row['xp'] ) ? absint( $row['xp'] ) : 10,
				'hint'     => isset( $row['hint'] ) ? sanitize_textarea_field( $row['hint'] ) : '',
			);
		}

		update_post_meta( $post_id, SECURA_META_QUESTIONS, $clean );
	}

	/**
	 * Charge le script d'édition.
	 *
	 * @param string $hook Identifiant de l'écran admin.
	 */
	public static function admin_assets( $hook ) {
		if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
			return;
		}

		$screen = get_current_screen();

		if ( $screen && SECURA_POST_TYPE !== $screen->post_type ) {
			return;
		}

		wp_enqueue_script(
			'secura-academy-admin',
			SECURA_ACADEMY_URL . 'assets/admin.js',
			array(),
			SECURA_ACADEMY_VERSION,
			true
		);

		wp_enqueue_style(
			'secura-academy-admin',
			SECURA_ACADEMY_URL . 'assets/admin.css',
			array(),
			SECURA_ACADEMY_VERSION
		);
	}
}
