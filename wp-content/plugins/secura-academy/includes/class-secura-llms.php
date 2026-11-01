<?php
/**
 * Le fichier llms.txt : un plan du site pour les robots d'IA.
 *
 * A quoi ca sert ? Google est tres clair : pour les AI Overviews et l'AI
 * Mode, « il n'y a pas besoin de llms.txt » — les reponses s'appuient sur
 * le meme index que la recherche classique. Donc ce fichier n'apporte
 * RIEN a Google.
 *
 * Mais d'autres moteurs d'IA (et des outils de recherche) regardent
 * llms.txt : c'est un usage emerging, sans harmite. Le fichier est donc
 * genere ici, a partir du contenu reel du site (parcours et rooms avec
 * leurs vraies adresses), pour qu'il ne soit jamais faux ni obsolete.
 *
 * Il est servi par WordPress : aucune page a maintenir a la main.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Le plan du site pour les robots d'IA.
 */
class Secura_Llms {

	/**
	 * Branche la generation du fichier.
	 */
	public static function init() {
		add_action( 'parse_request', array( __CLASS__, 'render' ) );
	}

	/**
	 * Sert le fichier quand l'adresse demandee est « /llms.txt ».
	 *
	 * On intercepte la demande directement, sans passer par une regle de
	 * reecriture : une regle exigerait un vidage des regles a chaque
	 * mise en production, et le fichier finirait par ne plus repondre.
	 *
	 * @param WP $wp L'objet de requete de WordPress.
	 */
	public static function render( $wp ) {
		if ( ! isset( $wp->request ) || 'llms.txt' !== $wp->request ) {
			return;
		}

		if ( ! headers_sent() ) {
			header( 'Content-Type: text/plain; charset=utf-8' );
			header( 'X-Robots-Tag: noindex, follow' );
			status_header( 200 );
		}

		echo self::contenu(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- texte brut, genere ici.

		exit;
	}

	/**
	 * Le contenu du fichier, construit a partir du site reel.
	 *
	 * @return string
	 */
	protected static function contenu() {
		$lignes = array();

		$nom = trim( (string) get_bloginfo( 'name' ) );

		if ( '' === $nom ) {
			$nom = 'Secura Academy';
		}

		$description = trim( (string) get_bloginfo( 'description' ) );

		if ( '' === $description ) {
			$description = __( 'Plateforme gratuite et multilingue d’apprentissage de la cybersécurité.', 'seca-academy' );
		}

		$lignes[] = '# ' . $nom;
		$lignes[] = '';
		$lignes[] = '> ' . $description;
		$lignes[] = '';
		$lignes[] = __( 'Plateforme d’apprentissage de la cybersécurité, gratuite, en français, en arabe et en anglais. Chaque room suit le même rythme : une leçon, un entraînement, un test d’application puis un examen. Les preuves de réussite sont lues dans une vraie machine isolée.', 'seca-academy' );
		$lignes[] = '';
		$lignes[] = __( 'Les rooms sont(indexées) dans le plan du site WordPress :', 'seca-academy' ) . ' ' . home_url( '/wp-sitemap.xml' );
		$lignes[] = '';

		foreach ( Secura_Paths::get_paths() as $parcours ) {
			$vue = Secura_Paths::get_path_view( $parcours->ID );

			if ( ! $vue ) {
				continue;
			}

			$lignes[] = '## ' . $vue['title'];
			$lignes[] = '';

			if ( '' !== trim( (string) $vue['excerpt'] ) ) {
				$lignes[] = wp_strip_all_tags( $vue['excerpt'] );
				$lignes[] = '';
			}

			$lignes[] = '- [' . $vue['title'] . '](' . get_permalink( $parcours->ID ) . ')';

			foreach ( $vue['sections'] as $section ) {
				foreach ( $section['rooms'] as $room_id ) {
					$room = Secura_Rooms::get_room_view( $room_id );

					if ( ! $room ) {
						continue;
					}

					$resume = wp_strip_all_tags( (string) $room['excerpt'] );
					$resume = trim( preg_replace( '/\s+/u', ' ', $resume ) );

					$ligne = '- [' . $room['title'] . '](' . get_permalink( $room_id ) . ')';

					if ( '' !== $resume ) {
						$ligne .= ': ' . $resume;
					}

					$lignes[] = $ligne;
				}
			}

			$lignes[] = '';
		}

		return implode( "\n", $lignes ) . "\n";
	}
}
