<?php
/**
 * Le bloc Kahoot : le quiz de revision, jouable en classe.
 *
 * Deux usages, meme contenu :
 *
 * 1. en classe, on lance le quiz Kahoot et on donne le code aux eleves ;
 * 2. seul (sans compte), on repond aux questions dans la plateforme.
 *
 * Le quiz est aussi exportable : CSV pour Kahoot ou tout autre outil,
 * JSON pour un traitement maison. L'export ne demande aucun compte.
 *
 * @package Secura_Academy
 */

defined( 'ABSPATH' ) || exit;

/**
 * Le bloc Kahoot et l'export du quiz.
 */
class Secura_Kahoot {

	/**
	 * Meta du bloc Kahoot dans une room.
	 */
	const META = '_secura_kahoot';

	/**
	 * Cle d'option : le quiz exportable.
	 */
	const OPTION = 'secura_kahoot_quizzes';

	/**
	 * Branche la generation du fichier exportable.
	 */
	public static function init() {
		add_action( 'template_redirect', array( __CLASS__, 'maybe_export' ) );
	}

	/**
	 * Le bloc Kahoot d'une room (ou une chaine vide).
	 *
	 * @param int    $room_id Identifiant de la room.
	 * @param string $lang    Langue ('fr', 'ar', 'en').
	 * @return string
	 */
	public static function render( $room_id, $lang = '' ) {
		$room_id = absint( $room_id );
		$kahoot  = self::get( $room_id );

		if ( ! $kahoot ) {
			return '';
		}

		$lang  = $lang ? $lang : Secura_I18n::current_lang();
		$title = ! empty( $kahoot['title'] ) ? $kahoot['title'] : __( 'Quiz de classe', 'seca-academy' );
		$intro = ! empty( $kahoot['intro'] ) ? $kahoot['intro'] : '';
		$link  = ! empty( $kahoot['link'] ) ? $kahoot['link'] : '';
		$code  = ! empty( $kahoot['code'] ) ? $kahoot['code'] : '';

		$export_url = add_query_arg(
			array(
				'seca_kahoot' => 'csv',
				'room'        => $room_id,
			),
			home_url( '/' )
		);

		ob_start();
		?>
		<section class="seca-kahoot" data-seca-kahoot>
			<h3 class="seca-kahoot-title"><?php echo esc_html( $title ); ?></h3>

			<?php if ( $intro ) : ?>
				<p class="seca-kahoot-intro"><?php echo esc_html( $intro ); ?></p>
			<?php endif; ?>

			<div class="seca-kahoot-actions">
				<?php if ( $link ) : ?>
					<a class="seca-btn seca-btn--small" href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener noreferrer">
						<?php esc_html_e( 'Ouvrir Kahoot', 'seca-academy' ); ?>
					</a>
				<?php endif; ?>

				<?php if ( $code ) : ?>
					<span class="seca-kahoot-code">
						<span class="seca-kahoot-code-label"><?php esc_html_e( 'Code du quiz', 'seca-academy' ); ?></span>
						<strong><?php echo esc_html( $code ); ?></strong>
					</span>
				<?php endif; ?>

				<a class="seca-btn seca-btn--small seca-btn--ghost" href="<?php echo esc_url( $export_url ); ?>">
					<?php esc_html_e( 'Télécharger le quiz (CSV)', 'seca-academy' ); ?>
				</a>
			</div>
		</section>
		<?php
		return ob_get_clean();
	}

	/**
	 * Le bloc Kahoot enregistre dans une room.
	 *
	 * @param int $room_id Identifiant de la room.
	 * @return array
	 */
	public static function get( $room_id ) {
		$kahoot = get_post_meta( absint( $room_id ), self::META, true );

		return is_array( $kahoot ) ? $kahoot : array();
	}

	/**
	 * Les questions du quiz d'une room (les questions d'examen).
	 *
	 * @param int $room_id Identifiant de la room.
	 * @return array
	 */
	public static function questions( $room_id ) {
		$tasks = get_post_meta( absint( $room_id ), SECURA_META_TASKS, true );

		if ( ! is_array( $tasks ) ) {
			return array();
		}

		foreach ( $tasks as $task ) {
			if ( isset( $task['type'], $task['questions'] ) && 'exam' === $task['type'] ) {
				return $task['questions'];
			}
		}

		return array();
	}

	/**
	 * Le quiz au format CSV (importable dans Kahoot ou dans un tableur).
	 *
	 * @param int $room_id Identifiant de la room.
	 * @return string
	 */
	public static function csv( $room_id ) {
		$questions = self::questions( $room_id );

		if ( ! $questions ) {
			return '';
		}

		$lines = array();

		foreach ( $questions as $question ) {
			if ( empty( $question['question'] ) || empty( $question['choices'] ) ) {
				continue;
			}

			$choices  = array_values( $question['choices'] );
			$correct  = isset( $question['correct'] ) ? (int) $question['correct'] : 0;
			$time     = isset( $question['time_limit'] ) ? (int) $question['time_limit'] : 30;

			$row = array( $question['question'] );

			for ( $index = 0; $index < 4; $index++ ) {
				$row[] = isset( $choices[ $index ] ) ? $choices[ $index ] : '';
			}

			$row[] = $correct + 1;
			$row[] = $time;

			$lines[] = self::csv_line( $row );
		}

		return implode( "\r\n", $lines );
	}

	/**
	 * Le quiz au format JSON.
	 *
	 * @param int $room_id Identifiant de la room.
	 * @return string
	 */
	public static function json( $room_id ) {
		$questions = array();

		foreach ( self::questions( $room_id ) as $question ) {
			if ( empty( $question['question'] ) || empty( $question['choices'] ) ) {
				continue;
			}

			$questions[] = array(
				'question' => $question['question'],
				'choices'  => array_values( $question['choices'] ),
				'correct'  => isset( $question['correct'] ) ? (int) $question['correct'] : 0,
				'explain'  => isset( $question['explanation'] ) ? $question['explanation'] : '',
			);
		}

		return wp_json_encode( $questions );
	}

	/**
	 * Une ligne CSV (les guillemets sont doubles).
	 *
	 * @param array $row Valeurs.
	 * @return string
	 */
	protected static function csv_line( $row ) {
		$parts = array();

		foreach ( $row as $value ) {
			$value = str_replace( '"', '""', (string) $value );
			$parts[] = '"' . $value . '"';
		}

		return implode( ',', $parts );
	}

	/**
	 * Envoie le fichier exportable si l'URL le demande.
	 *
	 * Seuls les enseignants (connectes et/ou administrateurs) peuvent
	 * exporter : c'est un document de classe, pas un contenu public.
	 */
	public static function maybe_export() {
		if ( ! isset( $_GET['seca_kahoot'] ) ) {
			return;
		}

		$format = sanitize_key( wp_unslash( $_GET['seca_kahoot'] ) );
		$room   = isset( $_GET['room'] ) ? absint( $_GET['room'] ) : 0;

		if ( ! in_array( $format, array( 'csv', 'json' ), true ) || ! $room ) {
			return;
		}

		if ( ! is_user_logged_in() ) {
			wp_die( esc_html__( 'Connecte-toi pour exporter ce quiz.', 'seca-academy' ), 403 );
		}

		$user = wp_get_current_user();

		if ( ! $user || ! $user->exists() ) {
			wp_die( esc_html__( 'Export refuse.', 'seca-academy' ), 403 );
		}

		$title = get_the_title( $room );

		if ( 'csv' === $format ) {
			$content = self::csv( $room );
			$type    = 'text/csv; charset=utf-8';
			$name    = 'secura-quiz-' . $room . '.csv';
		} else {
			$content = self::json( $room );
			$type    = 'application/json; charset=utf-8';
			$name    = 'secura-quiz-' . $room . '.json';
		}

		if ( '' === $content ) {
			wp_die( esc_html__( 'Quiz introuvable.', 'seca-academy' ), 404 );
		}

		nocache_headers();
		header( 'Content-Type: ' . $type );
		header( 'Content-Disposition: attachment; filename="' . $name . '"' );

		echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- export CSV/JSON.

		exit;
	}
}
