<?php
/**
 * Données structurées (schema.org) de la plateforme.
 *
 * Pourquoi : Google dit que les données structurées ne sont pas
 * obligatoires pour les réponses générées par l'IA, mais qu'elles
 * « valent la peine d'être maintenues » dans une stratégie SEO globale
 * (résultats enrichis, meilleure compréhension du contenu par les
 * moteurs et les agents).
 *
 * Ce que l'on déclare :
 *   - l'organisation (le site) ;
 *   - une ressource d'apprentissage pour chaque room (nom, durée,
 *     niveau, langue, gratuité) ;
 *   - l'objet vidéo pour le cours vidéo de la room (avec la miniature,
 *     l'adresse de lecture et la licence) ;
 *   - le fil d'Ariane ;
 *   - le cours pour chaque parcours.
 *
 * Tout est produit par le serveur : un robot qui ne comprend pas
 * JavaScript voit donc exactement la même chose qu'un élève.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Les données structurées de la plateforme.
 */
class Secura_Schema {

	/**
	 * Branche les données structurées sur l'en-tête de la page.
	 */
	public static function init() {
		add_action( 'wp_head', array( __CLASS__, 'render' ), 2 );
	}

	/**
	 * Écrit le bloc JSON-LD dans l'en-tête.
	 */
	public static function render() {
		if ( is_admin() || is_feed() || is_search() ) {
			return;
		}

		$graphe = self::graphe();

		if ( empty( $graphe ) ) {
			return;
		}

		$json = wp_json_encode(
			array(
				'@context' => 'https://schema.org',
				'@graph'   => $graphe,
			),
			JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
		);

		if ( ! $json ) {
			return;
		}

		echo '<script type="application/ld+json">' . $json . '</script>' . "\n";
	}

	/**
	 * Le graphe décrit pour la page courante.
	 *
	 * @return array
	 */
	protected static function graphe() {
		$graphe = array();

		$organisation = self::organisation();

		if ( $organisation ) {
			$graphe[] = $organisation;
		}

		if ( is_singular( SECURA_POST_TYPE ) ) {
			$ressource = self::ressource_apprentissage();

			if ( $ressource ) {
				$graphe[] = $ressource;
			}

			$video = self::objet_video();

			if ( $video ) {
				$graphe[] = $video;
			}

			$fil = self::fil_ariane();

			if ( $fil ) {
				$graphe[] = $fil;
			}
		} elseif ( is_singular( SECURA_PATH_POST_TYPE ) ) {
			$cours = self::cours();

			if ( $cours ) {
				$graphe[] = $cours;
			}
		} else {
			$site = self::site();

			if ( $site ) {
				$graphe[] = $site;
			}
		}

		return $graphe;
	}

	/**
	 * L'organisation (le site lui-même).
	 *
	 * @return array|null
	 */
	protected static function organisation() {
		$nom = trim( (string) get_bloginfo( 'name' ) );

		if ( '' === $nom ) {
			return null;
		}

		$description = trim( (string) get_bloginfo( 'description' ) );

		if ( '' === $description ) {
			$description = __( 'Plateforme gratuite et multilingue d’apprentissage de la cybersécurité.', 'seca-academy' );
		}

		return array(
			'@type'       => 'Organization',
			'@id'         => home_url( '/#organization' ),
			'name'        => $nom,
			'url'         => home_url( '/' ),
			'description' => $description,
		);
	}

	/**
	 * Le site (page d'accueil).
	 *
	 * @return array|null
	 */
	protected static function site() {
		return array(
			'@type'        => 'WebSite',
			'@id'          => home_url( '/#website' ),
			'name'         => get_bloginfo( 'name' ),
			'url'          => home_url( '/' ),
			'inLanguage'   => self::langue(),
			'publisher'    => array( '@id' => home_url( '/#organization' ) ),
			'isAccessibleForFree' => true,
		);
	}

	/**
	 * La ressource d'apprentissage (une room).
	 *
	 * @return array|null
	 */
	protected static function ressource_apprentissage() {
		$room = get_queried_object();

		if ( ! $room || ! isset( $room->ID ) ) {
			return null;
		}

		$vue = Secura_Rooms::get_room_view( $room->ID );

		if ( ! $vue ) {
			return null;
		}

		$description = wp_strip_all_tags( (string) $vue['excerpt'] );

		$ressource = array(
			'@type'       => 'LearningResource',
			'@id'         => get_permalink( $room->ID ) . '#ressource',
			'name'        => $vue['title'],
			'description' => $description,
			'url'         => get_permalink( $room->ID ),
			'inLanguage'  => self::langue(),
			'learningResourceType' => __( 'Exercice de cybersécurité', 'seca-academy' ),
			'educationalLevel' => self::niveau( $vue ),
			'isAccessibleForFree' => true,
			'provider'    => array( '@id' => home_url( '/#organization' ) ),
		);

		if ( ! empty( $vue['duration'] ) ) {
			$ressource['timeRequired'] = 'PT' . absint( $vue['duration'] ) . 'M';
		}

		return $ressource;
	}

	/**
	 * L'objet vidéo : le cours vidéo de la room.
	 *
	 * C'est ce qui permet aux moteurs (et aux agents) de savoir qu'il y a
	 * une vidéo, combien elle dure, d'où elle vient et sous quelle
	 * licence — même si l'élève ne clique jamais sur la façade.
	 *
	 * @return array|null
	 */
	protected static function objet_video() {
		$room = get_queried_object();

		if ( ! $room || ! isset( $room->ID ) || ! class_exists( 'Secura_Video' ) ) {
			return null;
		}

		$video = Secura_Video::get( $room->ID );

		if ( ! $video || empty( $video['id'] ) ) {
			return null;
		}

		$objet = array(
			'@type'       => 'VideoObject',
			'name'        => $video['title'],
			'description' => wp_strip_all_tags( (string) $video['note'] ),
			'thumbnailUrl' => 'https://i.ytimg.com/vi/' . rawurlencode( $video['id'] ) . '/hqdefault.jpg',
			'embedUrl'    => Secura_Video::embed_url( $video['id'] ),
			'contentUrl'  => Secura_Video::watch_url( $video['id'] ),
			'inLanguage'  => self::langue(),
			'publisher'   => array(
				'@type' => 'Organization',
				'name'  => $video['institution'] ? $video['institution'] : $video['channel'],
			),
		);

		$duree = self::duree_iso( $video['duration'] );

		if ( $duree ) {
			$objet['duration'] = $duree;
		}

		$licence = self::url_licence( $video['license'] );

		if ( $licence ) {
			$objet['license'] = $licence;
		}

		return $objet;
	}

	/**
	 * Le fil d'Ariane (accueil > parcours > room).
	 *
	 * @return array|null
	 */
	protected static function fil_ariane() {
		$room = get_queried_object();

		if ( ! $room || ! isset( $room->ID ) ) {
			return null;
		}

		$elements = array(
			array(
				'@type'    => 'ListItem',
				'position' => 1,
				'name'     => __( 'Accueil', 'seca-academy' ),
				'item'     => home_url( '/' ),
			),
		);

		$position = 2;
		$parcours = self::parcours_de( $room->ID );

		if ( $parcours ) {
			$elements[] = array(
				'@type'    => 'ListItem',
				'position' => $position,
				'name'     => $parcours['title'],
				'item'     => $parcours['url'],
			);

			$position++;
		}

		$elements[] = array(
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => get_the_title( $room ),
			'item'     => get_permalink( $room->ID ),
		);

		return array(
			'@type'           => 'BreadcrumbList',
			'itemListElement' => $elements,
		);
	}

	/**
	 * Le cours (une page de parcours).
	 *
	 * @return array|null
	 */
	protected static function cours() {
		$parcours = get_queried_object();

		if ( ! $parcours || ! isset( $parcours->ID ) ) {
			return null;
		}

		$duree = absint( get_post_meta( $parcours->ID, SECURA_META_DURATION, true ) );

		$cours = array(
			'@type'       => 'Course',
			'name'        => $parcours->post_title,
			'description' => wp_strip_all_tags( (string) $parcours->post_excerpt ),
			'url'         => get_permalink( $parcours->ID ),
			'inLanguage'  => self::langue(),
			'isAccessibleForFree' => true,
			'provider'    => array( '@id' => home_url( '/#organization' ) ),
		);

		if ( $duree ) {
			$cours['timeRequired'] = 'PT' . $duree . 'M';
		}

		return $cours;
	}

	/**
	 * Le parcours auquel appartient une room.
	 *
	 * @param int $room_id Identifiant de la room.
	 * @return array|null Titre et adresse du parcours.
	 */
	protected static function parcours_de( $room_id ) {
		foreach ( Secura_Paths::get_paths() as $parcours ) {
			$sections = Secura_Paths::get_sections( $parcours->ID );

			foreach ( $sections as $section ) {
				if ( in_array( (int) $room_id, array_map( 'intval', (array) $section['rooms'] ), true ) ) {
					return array(
						'title' => get_the_title( $parcours ),
						'url'   => get_permalink( $parcours->ID ),
					);
				}
			}
		}

		return null;
	}

	/**
	 * La langue de la page (code BCP-47).
	 *
	 * @return string
	 */
	protected static function langue() {
		$langue = substr( (string) determine_locale(), 0, 2 );

		return in_array( $langue, array( 'fr', 'ar', 'en' ), true ) ? $langue : 'fr';
	}

	/**
	 * Le niveau de difficulté, en clair.
	 *
	 * @param array $vue La vue de la room.
	 * @return string
	 */
	protected static function niveau( $vue ) {
		$facile = __( 'Débutant', 'seca-academy' );
		$moyen  = __( 'Intermédiaire', 'seca-academy' );
		$diff   = isset( $vue['difficulty'] ) ? strtolower( (string) $vue['difficulty'] ) : '';

		if ( false !== strpos( $diff, 'expert' ) ) {
			return __( 'Avancé', 'seca-academy' );
		}

		if ( false !== strpos( $diff, 'moyen' ) || false !== strpos( $diff, 'difficult' ) ) {
			return $moyen;
		}

		return $facile;
	}

	/**
	 * Convertit une durée « 1:17:13 » en durée ISO 8601 (« PT1H17M13S »).
	 *
	 * @param string $duree Durée lisible.
	 * @return string
	 */
	protected static function duree_iso( $duree ) {
		$duree = trim( (string) $duree );

		if ( '' === $duree || ! preg_match( '/^(\d{1,2})(?::(\d{1,2}))?(?::(\d{1,2}))?$/', $duree, $m ) ) {
			return '';
		}

		if ( isset( $m[3] ) && '' !== $m[3] ) {
			return sprintf( 'PT%dH%dM%dS', (int) $m[1], (int) $m[2], (int) $m[3] );
		}

		if ( isset( $m[2] ) && '' !== $m[2] ) {
			return sprintf( 'PT%dM%dS', (int) $m[1], (int) $m[2] );
		}

		return sprintf( 'PT%dM', (int) $m[1] );
	}

	/**
	 * L'adresse d'une licence Creative Commons (si on la reconnait).
	 *
	 * @param string $licence Texte de la licence.
	 * @return string
	 */
	protected static function url_licence( $licence ) {
		$licence = strtolower( (string) $licence );

		if ( false === strpos( $licence, 'cc by' ) ) {
			return '';
		}

		$variante = 'by';

		if ( false !== strpos( $licence, 'nc' ) ) {
			$variante .= '-nc';
		}

		if ( false !== strpos( $licence, 'sa' ) ) {
			$variante .= '-sa';
		}

		$version = preg_match( '/([0-9])\.([0-9])/', $licence, $v ) ? $v[0] : '4.0';

		return 'https://creativecommons.org/licenses/' . $variante . '/' . $version . '/';
	}
}
