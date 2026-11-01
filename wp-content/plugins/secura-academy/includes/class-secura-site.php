<?php
/**
 * Installation du site : la page d'accueil, le nettoyage d'installation.
 *
 * WordPress, neuf, arrive avec trois choses qui nuisent au référencement :
 *
 * 1. une page d'accueil qui affiche le billet « Bonjour tout le monde ! »
 *    (le texte de démonstration de WordPress) ;
 * 2. une « Page d'exemple », vide de sens, publiee et donc indexable ;
 * 3. une archive d'auteur (/author/admin/) qui expose le nom du compte
 *    d'administration dans le plan du site.
 *
 * Cette classe remet le site en etat, une fois, a l'activation du
 * plugin. Elle est prudente : elle ne touche jamais a un contenu que
 * l'enseignant a ecrit, et elle ne force rien si le site a deja ete
 * configure.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Mise en place du site.
 */
class Secura_Site {

	/**
	 * Le nom du code de la page d'accueil.
	 */
	const PAGE_SLUG = 'parcours';

	/**
	 * Branche l'appel.
	 */
	public static function init() {
		add_action( 'admin_notices', array( __CLASS__, 'notice' ) );
	}

	/**
	 * La page d'accueil existe-t-elle deja ?
	 *
	 * @return int L'identifiant de la page, 0 si elle n'existe pas.
	 */
	public static function page_parcours_id() {
		$page = get_page_by_path( self::PAGE_SLUG );

		if ( $page && 'publish' === $page->post_status ) {
			return (int) $page->ID;
		}

		return 0;
	}

	/**
	 * Prepare le site : page d'accueil, nettoyage des contenus de
	 * demonstration de WordPress.
	 *
	 * Cette methode est appelee a chaque activation du plugin ; elle est
	 * concue pour etre rejouee sans jamais casser un site deja utilise.
	 */
	public static function install() {
		self::assurer_page_parcours();
		self::nettoyer_contenus_par_defaut();
	}

	/**
	 * Cree la page « Parcours » et la met en page d'accueil.
	 *
	 * On ne touche pas a une page existante, et on ne force pas
	 * l'accueil si l'enseignant a deja choisi une page statique.
	 */
	public static function assurer_page_parcours() {
		$existe = get_page_by_path( self::PAGE_SLUG );

		if ( ! $existe ) {
			$id = wp_insert_post(
				array(
					'post_title'   => __( 'Parcours', 'seca-academy' ),
					'post_name'    => self::PAGE_SLUG,
					'post_content' => '[secura_academy]',
					'post_status'  => 'publish',
					'post_type'    => 'page',
					'post_author'  => self::auteur_id(),
				)
			);

			if ( ! $id || is_wp_error( $id ) ) {
				return;
			}
		} else {
			$id = (int) $existe->ID;

			/* La page existe mais n'est pas publiee : on publie. */
			if ( 'publish' !== $existe->post_status ) {
				wp_update_post(
					array(
						'ID'          => $id,
						'post_status' => 'publish',
					)
				);
			}
		}

		/* L'accueil : seulement si le site n'en a pas deja un. */
		$page_front = (int) get_option( 'page_on_front' );

		if ( 'page' !== get_option( 'show_on_front' ) || ! $page_front ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $id );
		}
	}

	/**
	 * Met de cote les contenus de demonstration de WordPress.
	 *
	 * Seuls les textes par defaut de WordPress sont concernes : si
	 * l'enseignant a ecrit quelque chose, on n'y touche pas. On
	 * reconnait ces textes a leurs titres (dans les langues de WordPress)
	 * et a une phrase signature du texte d'origine.
	 */
	public static function nettoyer_contenus_par_defaut() {
		$titres = array(
			'post' => array( 'Hello world!', 'Bonjour tout le monde !' ),
			'page' => array( 'Sample Page', "Page d'exemple" ),
		);

		/* Une phrase qui n'existe que dans le texte livre par WordPress. */
		$signatures = array(
			'post' => array( 'This is your first post', 'Ceci est votre premier article' ),
			'page' => array( 'This is an example page', "Ceci est une page d'exemple" ),
		);

		foreach ( $titres as $type => $liste_titres ) {
			$posts = get_posts(
				array(
					'post_type'       => $type,
					'post_status'     => 'any',
					'numberposts'     => -1,
					'fields'          => 'ids',
					'no_found_rows'   => true,
					'suppress_filters' => false,
				)
			);

			foreach ( $posts as $id ) {
				$post = get_post( $id );

				if ( ! $post ) {
					continue;
				}

				/* Le titre doit etre celui de WordPress, mot pour mot.
				   On normalise les espaces : WordPress ecrit parfois
				   une espace insecable (le « Bonjour tout le monde ! »
				   francais), qui ferait echouer une comparaison brute. */
				if ( ! in_array( self::normaliser( $post->post_title ), $liste_titres, true ) ) {
					continue;
				}

				$contenu = trim( wp_strip_all_tags( $post->post_content ) );

				/* Et le texte doit contenir la phrase d'origine. */
				$signature = false;

				foreach ( $signatures[ $type ] as $phrase ) {
					if ( false !== strpos( $contenu, $phrase ) ) {
						$signature = true;
						break;
					}
				}

				if ( ! $signature ) {
					continue;
				}

				wp_update_post(
					array(
						'ID'          => $id,
						'post_status' => 'draft',
					)
				);
			}
		}
	}

	/**
	 * Normalise un texte pour comparaison : espaces (y compris
	 * insecables) et apostrophes typographiques.
	 *
	 * @param string $texte Le texte a normaliser.
	 * @return string
	 */
	protected static function normaliser( $texte ) {
		$texte = str_replace( array( "\xc2\xa0", "\xe2\x80\xaf" ), ' ', (string) $texte );
		$texte = str_replace( array( "\xe2\x80\x99", "\xe2\x80\x98" ), "'", $texte );

		return trim( $texte );
	}

	/**
	 * L'identifiant de l'auteur des contenus crees.
	 *
	 * @return int
	 */
	protected static function auteur_id() {
		$admin = get_users(
			array(
				'role'    => 'administrator',
				'number'  => 1,
				'fields'  => 'ID',
				'orderby' => 'ID',
			)
		);

		return $admin ? (int) $admin[0] : 0;
	}

	/**
	 * Un rappel dans l'administration, si la page d'accueil n'existe pas.
	 */
	public static function notice() {
		if ( self::page_parcours_id() ) {
			return;
		}

		if ( ! current_user_can( 'edit_pages' ) ) {
			return;
		}

		printf(
			'<div class="notice notice-warning"><p>%s</p></div>',
			esc_html__( 'Secura Academy : la page « Parcours » est absente. Recreez-la pour que les parcours et les rooms soient accessibles par liens.', 'seca-academy' )
		);
	}
}
