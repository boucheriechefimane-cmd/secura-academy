<?php
/**
 * Type de contenu « Rooms » : tâches, traductions, contenu par défaut.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Gère le CPT Room, ses tâches et ses traductions.
 */
final class Secura_Rooms {

	/**
	 * Types de tâches reconnus.
	 *
	 * @return array
	 */
	public static function task_types() {
		return array(
			'lesson'   => __( 'Leçon', 'seca-academy' ),
			'practice' => __( 'Entraînement', 'seca-academy' ),
			'test'     => __( "Test d'application", 'seca-academy' ),
			'exam'     => __( 'Examen', 'seca-academy' ),
		);
	}

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
	 * Crée le contenu de démonstration à l'activation.
	 */
	public static function activate() {
		self::register_post_type();
		Secura_Paths::register_post_type();

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

		Secura_Paths::create_default_paths();
		Secura_Progress::maybe_create_table();

		flush_rewrite_rules();
	}

	/**
	 * Insère les rooms et les parcours de démonstration.
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
					'post_content' => isset( $room['content'] ) ? $room['content'] : '',
					'menu_order'   => $order,
				),
				true
			);

			if ( is_wp_error( $post_id ) ) {
				continue;
			}

			update_post_meta( $post_id, SECURA_META_TASKS, $room['tasks'] );
			update_post_meta( $post_id, SECURA_META_DIFFICULTY, $room['difficulty'] );
			update_post_meta( $post_id, SECURA_META_DURATION, (int) $room['duration'] );
			update_post_meta( $post_id, SECURA_META_XP_BONUS, (int) $room['xp_bonus'] );
			update_post_meta( $post_id, SECURA_META_I18N, isset( $room['i18n'] ) ? $room['i18n'] : array() );

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
	 * Tâches normalisées d'une room.
	 *
	 * @param int $room_id Identifiant de la room.
	 * @return array
	 */
	public static function get_tasks( $room_id ) {
		$room_id = absint( $room_id );

		if ( ! $room_id ) {
			return array();
		}

		$raw = get_post_meta( $room_id, SECURA_META_TASKS, true );

		if ( ! is_array( $raw ) ) {
			return array();
		}

		$tasks = array();

		foreach ( $raw as $task ) {
			if ( ! is_array( $task ) ) {
				continue;
			}

			$type = isset( $task['type'] ) && array_key_exists( $task['type'], self::task_types() ) ? $task['type'] : 'practice';

			$questions = array();

			if ( isset( $task['questions'] ) && is_array( $task['questions'] ) ) {
				foreach ( $task['questions'] as $question ) {
					if ( ! is_array( $question ) ) {
						continue;
					}

					$text = isset( $question['question'] ) ? trim( (string) $question['question'] ) : '';

					if ( '' === $text ) {
						continue;
					}

					$answers = array();

					if ( isset( $question['answers'] ) && is_array( $question['answers'] ) ) {
						foreach ( $question['answers'] as $answer ) {
							$answer = trim( (string) $answer );

							if ( '' !== $answer ) {
								$answers[] = $answer;
							}
						}
					} elseif ( isset( $question['answer'] ) ) {
						foreach ( explode( '|', (string) $question['answer'] ) as $answer ) {
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
						'question'      => $text,
						'answers'       => $answers,
						'xp'            => isset( $question['xp'] ) ? absint( $question['xp'] ) : 0,
						'hint'          => isset( $question['hint'] ) ? (string) $question['hint'] : '',
						'explanation'   => isset( $question['explanation'] ) ? (string) $question['explanation'] : '',
						'weight'        => isset( $question['weight'] ) ? absint( $question['weight'] ) : 1,
						'requires_step' => isset( $question['requires_step'] ) ? intval( $question['requires_step'] ) : -1,
					);
				}
			}

			$tasks[] = array(
				'type'       => $type,
				'title'      => isset( $task['title'] ) ? (string) $task['title'] : '',
				'content'    => isset( $task['content'] ) ? wp_kses_post( (string) $task['content'] ) : '',
				'time_limit' => isset( $task['time_limit'] ) ? absint( $task['time_limit'] ) : 0,
				'pass_score' => isset( $task['pass_score'] ) ? absint( $task['pass_score'] ) : 0,
				'questions'  => $questions,
				'terminal'   => Secura_Terminal::normalize_definition( isset( $task['terminal'] ) ? $task['terminal'] : array() ),
			);
		}

		return $tasks;
	}

	/**
	 * Vue complète d'une room, traduite dans la langue demandée.
	 *
	 * @param int    $room_id Identifiant de la room.
	 * @param string $lang    Langue.
	 * @return array|null
	 */
	public static function get_room_view( $room_id, $lang = '' ) {
		$room = get_post( $room_id );

		if ( ! $room || SECURA_POST_TYPE !== $room->post_type ) {
			return null;
		}

		$lang       = $lang ? $lang : Secura_I18n::current_lang();
		$translation = Secura_I18n::translate_post( $room_id, $lang );
		$tasks       = self::get_tasks( $room_id );
		$tasks       = Secura_I18n::translate_tasks( $tasks, $translation, $lang );

		return array(
			'id'         => $room->ID,
			'title'      => $translation['title'] ? $translation['title'] : get_the_title( $room ),
			'excerpt'    => $translation['excerpt'] ? $translation['excerpt'] : $room->post_excerpt,
			'content'    => $translation['content'] ? $translation['content'] : wpautop( wp_kses_post( $room->post_content ) ),
			'tasks'      => $tasks,
			'difficulty'     => self::get_difficulty( $room->ID ),
			'difficulty_key' => self::get_difficulty_key( $room->ID ),
			'duration'       => absint( get_post_meta( $room->ID, SECURA_META_DURATION, true ) ),
			'xp_bonus'       => absint( get_post_meta( $room->ID, SECURA_META_XP_BONUS, true ) ),
			'slug'           => $room->post_name,
		);
	}

	/**
	 * Clé brute de la difficulté (facile, moyen, difficile, expert).
	 *
	 * @param int $room_id Identifiant de la room.
	 * @return string
	 */
	public static function get_difficulty_key( $room_id ) {
		$difficulty = get_post_meta( $room_id, SECURA_META_DIFFICULTY, true );

		if ( ! is_string( $difficulty ) || ! array_key_exists( $difficulty, self::difficulty_labels() ) ) {
			return 'facile';
		}

		return $difficulty;
	}

	/**
	 * Difficulté lisible.
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
			'facile'    => __( 'Facile', 'seca-academy' ),
			'moyen'     => __( 'Moyen', 'seca-academy' ),
			'difficile' => __( 'Difficile', 'seca-academy' ),
			'expert'    => __( 'Expert', 'seca-academy' ),
		);
	}

	/* ---------------------------------------------------------------------
	 * Édition
	 * ------------------------------------------------------------------ */

	/**
	 * Déclare les meta boxes.
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

		add_meta_box(
			'secura-room-translations',
			__( 'Traductions', 'seca-academy' ),
			array( __CLASS__, 'render_translations_box' ),
			SECURA_POST_TYPE,
			'normal',
			'default'
		);
	}

	/**
	 * Meta box : paramètres, tâches et questions.
	 *
	 * @param WP_Post $post Post en cours d'édition.
	 */
	public static function render_meta_box( $post ) {
		$tasks      = self::get_tasks( $post->ID );
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

			<p>
				<label for="secura_difficulty"><?php esc_html_e( 'Difficulté', 'seca-academy' ); ?></label>
				<select id="secura_difficulty" name="secura_difficulty">
					<?php foreach ( self::difficulty_labels() as $key => $label ) : ?>
						<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $difficulty, $key ); ?>><?php echo esc_html( $label ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<label for="secura_duration"><?php esc_html_e( 'Durée indicative (minutes)', 'seca-academy' ); ?></label>
				<input type="number" min="0" max="600" id="secura_duration" name="secura_duration" value="<?php echo esc_attr( $duration ); ?>" />
			</p>

			<p>
				<label for="secura_xp_bonus"><?php esc_html_e( 'Bonus XP à la complétion de la room', 'seca-academy' ); ?></label>
				<input type="number" min="0" max="500" id="secura_xp_bonus" name="secura_xp_bonus" value="<?php echo esc_attr( $bonus ); ?>" />
			</p>

			<h3 class="secura-metabox-title"><?php esc_html_e( 'Tâches', 'seca-academy' ); ?></h3>
			<p class="description">
				<?php esc_html_e( 'Une room suit l\'ordre : leçon → entraînement → test d\'application → examen. Les réponses attendues ne sont jamais envoyées au navigateur.', 'seca-academy' ); ?>
			</p>

			<div id="secura-tasks" class="secura-tasks">
				<?php
				if ( empty( $tasks ) ) {
					echo self::render_task_row( array( 'type' => 'lesson', 'title' => '', 'content' => '', 'time_limit' => 0, 'pass_score' => 0, 'questions' => array(), 'terminal' => array() ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendu échappé.
				} else {
					foreach ( $tasks as $task ) {
						echo self::render_task_row( $task ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendu échappé.
					}
				}
				?>
			</div>

			<p>
				<button type="button" class="button button-secondary" id="secura-add-task"><?php esc_html_e( '+ Ajouter une tâche', 'seca-academy' ); ?></button>
			</p>

			<script type="text/html" id="secura-task-template">
				<?php
				echo self::render_task_row( array( 'type' => 'lesson', 'title' => '', 'content' => '', 'time_limit' => 0, 'pass_score' => 0, 'questions' => array(), 'terminal' => array() ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendu échappé.
				?>
			</script>

			<script type="text/html" id="secura-question-template">
				<?php
				echo self::render_question_row( array( 'question' => '', 'answers' => array(), 'xp' => 10, 'hint' => '', 'explanation' => '', 'weight' => 1, 'requires_step' => -1 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendu échappé.
				?>
			</script>
		</div>
		<?php
	}

	/**
	 * Rendu d'une tâche.
	 *
	 * @param array $task Tâche.
	 * @return string
	 */
	private static function render_task_row( $task ) {
		$type    = isset( $task['type'] ) ? $task['type'] : 'lesson';
		$title   = isset( $task['title'] ) ? $task['title'] : '';
		$content = isset( $task['content'] ) ? $task['content'] : '';
		$limit   = isset( $task['time_limit'] ) ? absint( $task['time_limit'] ) : 0;
		$pass    = isset( $task['pass_score'] ) ? absint( $task['pass_score'] ) : 0;
		$terminal = isset( $task['terminal'] ) ? $task['terminal'] : array();
		$questions = isset( $task['questions'] ) && is_array( $task['questions'] ) ? $task['questions'] : array();

		$terminal_json = '';

		if ( ! empty( $terminal['steps'] ) ) {
			$terminal_json = wp_json_encode( $terminal, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
		}

		ob_start();
		?>
		<div class="secura-task-row">
			<div class="secura-task-head">
				<strong class="secura-task-label"><?php esc_html_e( 'Tâche', 'seca-academy' ); ?> <span class="secura-task-number">1</span></strong>
				<button type="button" class="button-link-delete seca-remove-task"><?php esc_html_e( 'Supprimer la tâche', 'seca-academy' ); ?></button>
			</div>

			<p>
				<label><?php esc_html_e( 'Type', 'seca-academy' ); ?></label>
				<select name="secura_tasks[][type]">
					<?php foreach ( self::task_types() as $key => $label ) : ?>
						<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $type, $key ); ?>><?php echo esc_html( $label ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<label><?php esc_html_e( 'Titre de la tâche', 'seca-academy' ); ?></label>
				<input type="text" class="large-text" name="secura_tasks[][title]" value="<?php echo esc_attr( $title ); ?>" />
			</p>

			<p>
				<label><?php esc_html_e( 'Contenu pédagogique (HTML simple)', 'seca-academy' ); ?></label>
				<textarea name="secura_tasks[][content]" rows="6" class="large-text"><?php echo esc_textarea( $content ); ?></textarea>
			</p>

			<p class="secura-inline">
				<label><?php esc_html_e( 'Durée (min, examen)', 'seca-academy' ); ?></label>
				<input type="number" min="0" max="240" name="secura_tasks[][time_limit]" value="<?php echo esc_attr( $limit ); ?>" />
				<label><?php esc_html_e( 'Seuil de passage (%, examen)', 'seca-academy' ); ?></label>
				<input type="number" min="0" max="100" name="secura_tasks[][pass_score]" value="<?php echo esc_attr( $pass ); ?>" />
			</p>

			<p>
				<label><?php esc_html_e( 'Terminal simulé (JSON, optionnel)', 'seca-academy' ); ?></label>
				<textarea name="secura_tasks[][terminal]" rows="5" class="large-text code" placeholder='{"intro":"…","steps":[{"match":["ls"],"output":"…","hint":"…"}]}'><?php echo esc_textarea( $terminal_json ); ?></textarea>
				<span class="description"><?php esc_html_e( 'Les motifs entre slashes sont des expressions régulières, sinon la comparaison est exacte.', 'seca-academy' ); ?></span>
			</p>

			<div class="secura-questions">
				<?php
				foreach ( $questions as $question ) {
					echo self::render_question_row( $question ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendu échappé.
				}
				?>
			</div>

			<p>
				<button type="button" class="button button-small seca-add-question"><?php esc_html_e( '+ Ajouter une question', 'seca-academy' ); ?></button>
			</p>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Rendu d'une question.
	 *
	 * @param array $question Question.
	 * @return string
	 */
	private static function render_question_row( $question ) {
		$text        = isset( $question['question'] ) ? $question['question'] : '';
		$answers     = isset( $question['answers'] ) && is_array( $question['answers'] ) ? implode( "\n", $question['answers'] ) : '';
		$xp          = isset( $question['xp'] ) ? absint( $question['xp'] ) : 10;
		$hint        = isset( $question['hint'] ) ? $question['hint'] : '';
		$explanation = isset( $question['explanation'] ) ? $question['explanation'] : '';
		$weight      = isset( $question['weight'] ) ? absint( $question['weight'] ) : 1;
		$requires    = isset( $question['requires_step'] ) ? intval( $question['requires_step'] ) : -1;

		ob_start();
		?>
		<div class="secura-question-row">
			<div class="secura-task-head">
				<strong class="secura-question-label"><?php esc_html_e( 'Question', 'seca-academy' ); ?> <span class="secura-question-number">1</span></strong>
				<button type="button" class="button-link-delete seca-remove-question"><?php esc_html_e( 'Supprimer', 'seca-academy' ); ?></button>
			</div>

			<p>
				<label><?php esc_html_e( 'Énoncé', 'seca-academy' ); ?></label>
				<textarea name="secura_tasks[][questions][][question]" rows="2" class="large-text"><?php echo esc_textarea( $text ); ?></textarea>
			</p>

			<p>
				<label><?php esc_html_e( 'Réponses acceptées (une par ligne)', 'seca-academy' ); ?></label>
				<textarea name="secura_tasks[][questions][][answers]" rows="3" class="large-text"><?php echo esc_textarea( $answers ); ?></textarea>
			</p>

			<p>
				<label><?php esc_html_e( 'Explication affichée après la réponse', 'seca-academy' ); ?></label>
				<textarea name="secura_tasks[][questions][][explanation]" rows="2" class="large-text"><?php echo esc_textarea( $explanation ); ?></textarea>
			</p>

			<p class="secura-inline">
				<label><?php esc_html_e( 'Indice', 'seca-academy' ); ?></label>
				<input type="text" class="regular-text" name="secura_tasks[][questions][][hint]" value="<?php echo esc_attr( $hint ); ?>" />
			</p>

			<p class="secura-inline">
				<label><?php esc_html_e( 'XP', 'seca-academy' ); ?></label>
				<input type="number" min="0" max="200" name="secura_tasks[][questions][][xp]" value="<?php echo esc_attr( $xp ); ?>" />
				<label><?php esc_html_e( 'Poids', 'seca-academy' ); ?></label>
				<input type="number" min="1" max="5" name="secura_tasks[][questions][][weight]" value="<?php echo esc_attr( $weight ); ?>" />
				<label><?php esc_html_e( 'Étape terminal requise', 'seca-academy' ); ?></label>
				<input type="number" min="-1" max="20" name="secura_tasks[][questions][][requires_step]" value="<?php echo esc_attr( $requires ); ?>" />
			</p>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Meta box : traductions.
	 *
	 * @param WP_Post $post Post en cours d'édition.
	 */
	public static function render_translations_box( $post ) {
		$tasks        = self::get_tasks( $post->ID );
		$translations = get_post_meta( $post->ID, SECURA_META_I18N, true );
		$translations = is_array( $translations ) ? $translations : array();
		$languages    = Secura_I18n::languages();

		echo '<p class="description">' . esc_html__( 'Traduisez le contenu de la room. Laissez vide pour conserver la version d\'origine.', 'seca-academy' ) . '</p>';

		foreach ( $languages as $code => $language ) {
			$data = isset( $translations[ $code ] ) && is_array( $translations[ $code ] ) ? $translations[ $code ] : array();
			?>
			<details class="secura-translation" <?php echo ( $code === 'fr' ? 'open' : '' ); ?>>
				<summary><?php echo esc_html( $language['native'] . ' (' . $language['flag'] . ')' ); ?></summary>

				<p>
					<label><?php esc_html_e( 'Titre', 'seca-academy' ); ?></label>
					<input type="text" class="large-text" name="secura_i18n[<?php echo esc_attr( $code ); ?>][title]" value="<?php echo esc_attr( isset( $data['title'] ) ? $data['title'] : '' ); ?>" />
				</p>

				<p>
					<label><?php esc_html_e( 'Extrait', 'seca-academy' ); ?></label>
					<input type="text" class="large-text" name="secura_i18n[<?php echo esc_attr( $code ); ?>][excerpt]" value="<?php echo esc_attr( isset( $data['excerpt'] ) ? $data['excerpt'] : '' ); ?>" />
				</p>

				<?php foreach ( $tasks as $index => $task ) : ?>
					<?php
					$task_title = isset( $data['tasks'][ $index ]['title'] ) ? $data['tasks'][ $index ]['title'] : '';
					?>
					<p>
						<label><?php echo esc_html( sprintf( /* translators: %d : index de la tâche. */ __( 'Tâche %d — titre', 'seca-academy' ), $index + 1 ) ); ?></label>
						<input type="text" class="large-text" name="secura_i18n[<?php echo esc_attr( $code ); ?>][tasks][<?php echo esc_attr( $index ); ?>][title]" value="<?php echo esc_attr( $task_title ); ?>" />
					</p>

					<?php
					$questions = isset( $task['questions'] ) ? $task['questions'] : array();

					foreach ( $questions as $q_index => $question ) :
						?>
						<p class="secura-translation-question">
							<label><?php echo esc_html( sprintf( /* translators: 1 : index de la tâche, 2 : index de la question. */ __( 'Tâche %1$d — question %2$d', 'seca-academy' ), $index + 1, $q_index + 1 ) ); ?></label>
							<textarea name="secura_i18n[<?php echo esc_attr( $code ); ?>][tasks][<?php echo esc_attr( $index ); ?>][questions][<?php echo esc_attr( $q_index ); ?>][question]" rows="2" class="large-text"><?php echo esc_textarea( isset( $data['tasks'][ $index ]['questions'][ $q_index ]['question'] ) ? $data['tasks'][ $index ]['questions'][ $q_index ]['question'] : '' ); ?></textarea>
							<textarea name="secura_i18n[<?php echo esc_attr( $code ); ?>][tasks][<?php echo esc_attr( $index ); ?>][questions][<?php echo esc_attr( $q_index ); ?>][hint]" rows="1" class="large-text" placeholder="<?php esc_attr_e( 'Indice traduit', 'seca-academy' ); ?>"><?php echo esc_textarea( isset( $data['tasks'][ $index ]['questions'][ $q_index ]['hint'] ) ? $data['tasks'][ $index ]['questions'][ $q_index ]['hint'] : '' ); ?></textarea>
							<textarea name="secura_i18n[<?php echo esc_attr( $code ); ?>][tasks][<?php echo esc_attr( $index ); ?>]][questions][<?php echo esc_attr( $q_index ); ?>][explanation]" rows="2" class="large-text" placeholder="<?php esc_attr_e( 'Explication traduite', 'seca-academy' ); ?>"><?php echo esc_textarea( isset( $data['tasks'][ $index ]['questions'][ $q_index ]['explanation'] ) ? $data['tasks'][ $index ]['questions'][ $q_index ]['explanation'] : '' ); ?></textarea>
						</p>
					<?php endforeach; ?>
				<?php endforeach; ?>
			</details>
			<?php
		}
	}

	/**
	 * Enregistre la room.
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

		$raw   = isset( $_POST['secura_tasks'] ) && is_array( $_POST['secura_tasks'] ) ? wp_unslash( $_POST['secura_tasks'] ) : array();
		$clean = array();

		foreach ( $raw as $task ) {
			if ( ! is_array( $task ) ) {
				continue;
			}

			$type = isset( $task['type'] ) && array_key_exists( $task['type'], self::task_types() ) ? $task['type'] : 'practice';

			$questions = array();

			if ( isset( $task['questions'] ) && is_array( $task['questions'] ) ) {
				foreach ( $task['questions'] as $question ) {
					if ( ! is_array( $question ) ) {
						continue;
					}

					$text = isset( $question['question'] ) ? trim( sanitize_textarea_field( $question['question'] ) ) : '';

					if ( '' === $text ) {
						continue;
					}

					$answers = array();

					if ( isset( $question['answers'] ) ) {
						$lines = preg_split( '/\r\n|\r|\n/', (string) $question['answers'] );

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

					$questions[] = array(
						'question'      => $text,
						'answers'       => $answers,
						'xp'            => isset( $question['xp'] ) ? absint( $question['xp'] ) : 10,
						'hint'          => isset( $question['hint'] ) ? sanitize_textarea_field( $question['hint'] ) : '',
						'explanation'   => isset( $question['explanation'] ) ? sanitize_textarea_field( $question['explanation'] ) : '',
						'weight'        => isset( $question['weight'] ) ? absint( $question['weight'] ) : 1,
						'requires_step' => isset( $question['requires_step'] ) ? intval( $question['requires_step'] ) : -1,
					);
				}
			}

			$terminal = array();

			if ( isset( $task['terminal'] ) && '' !== trim( (string) $task['terminal'] ) ) {
				$decoded = json_decode( (string) $task['terminal'], true );
				$terminal = Secura_Terminal::normalize_definition( is_array( $decoded ) ? $decoded : array() );
			}

			$clean[] = array(
				'type'       => $type,
				'title'      => isset( $task['title'] ) ? sanitize_text_field( $task['title'] ) : '',
				'content'    => isset( $task['content'] ) ? wp_kses_post( $task['content'] ) : '',
				'time_limit' => isset( $task['time_limit'] ) ? absint( $task['time_limit'] ) : 0,
				'pass_score' => isset( $task['pass_score'] ) ? absint( $task['pass_score'] ) : 0,
				'questions'  => $questions,
				'terminal'   => $terminal,
			);
		}

		update_post_meta( $post_id, SECURA_META_TASKS, $clean );

		/* Traductions. */
		$raw_tr = isset( $_POST['secura_i18n'] ) && is_array( $_POST['secura_i18n'] ) ? wp_unslash( $_POST['secura_i18n'] ) : array();
		$clean_tr = array();

		foreach ( $raw_tr as $code => $data ) {
			if ( ! is_array( $data ) ) {
				continue;
			}

			$entry = array(
				'title'   => isset( $data['title'] ) ? sanitize_text_field( $data['title'] ) : '',
				'excerpt' => isset( $data['excerpt'] ) ? sanitize_text_field( $data['excerpt'] ) : '',
				'tasks'   => array(),
			);

			if ( isset( $data['tasks'] ) && is_array( $data['tasks'] ) ) {
				foreach ( $data['tasks'] as $index => $task ) {
					if ( ! is_array( $task ) ) {
						continue;
					}

					$entry['tasks'][ $index ] = array(
						'title'     => isset( $task['title'] ) ? sanitize_text_field( $task['title'] ) : '',
						'questions' => array(),
					);

					if ( isset( $task['questions'] ) && is_array( $task['questions'] ) ) {
						foreach ( $task['questions'] as $q_index => $question ) {
							if ( ! is_array( $question ) ) {
								continue;
							}

							$entry['tasks'][ $index ]['questions'][ $q_index ] = array(
								'question'    => isset( $question['question'] ) ? sanitize_textarea_field( $question['question'] ) : '',
								'hint'        => isset( $question['hint'] ) ? sanitize_textarea_field( $question['hint'] ) : '',
								'explanation' => isset( $question['explanation'] ) ? sanitize_textarea_field( $question['explanation'] ) : '',
							);
						}
					}
				}
			}

			$clean_tr[ sanitize_key( $code ) ] = $entry;
		}

		update_post_meta( $post_id, SECURA_META_I18N, $clean_tr );
	}

	/**
	 * Charge les scripts d'édition.
	 *
	 * @param string $hook Identifiant de l'écran.
	 */
	public static function admin_assets( $hook ) {
		if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
			return;
		}

		$screen = get_current_screen();

		if ( $screen && ! in_array( $screen->post_type, array( SECURA_POST_TYPE, SECURA_PATH_POST_TYPE ), true ) ) {
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
