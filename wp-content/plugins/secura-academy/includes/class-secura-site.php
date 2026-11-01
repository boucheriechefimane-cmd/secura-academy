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

		/* Les pages legales sont servies dans la langue du visiteur. */
		add_filter( 'the_title', array( __CLASS__, 'titre_legal' ), 9, 2 );
		add_filter( 'the_content', array( __CLASS__, 'contenu_legal' ), 9 );

		/* Apres une mise a jour du plugin, on rejoue l'installation :
		   c'est elle qui met les pages legales a jour. Sans cela, un
		   site deja installe garderait forever le texte d'avant
		   correction. */
		add_action( 'init', array( __CLASS__, 'mise_a_jour_si_necessaire' ), 1 );
	}

	/**
	 * Rejoue l'installation si la version du plugin a change.
	 *
	 * La lecture d'une option est negligeable ; l'installation, elle,
	 * ne tourne qu'une fois par version.
	 */
	public static function mise_a_jour_si_necessaire() {
		$version_installee = (string) get_option( 'seca_version_installee', '' );

		if ( $version_installee === SECURA_ACADEMY_VERSION ) {
			return;
		}

		self::install();

		update_option( 'seca_version_installee', SECURA_ACADEMY_VERSION );
	}

	/**
	 * Le contenu des pages legales, dans la langue du visiteur.
	 *
	 * @param string $contenu Le contenu normal.
	 * @return string
	 */
	public static function contenu_legal( $contenu ) {
		$page = get_queried_object();

		if ( ! $page || ! isset( $page->ID ) || 'page' !== $page->post_type ) {
			return $contenu;
		}

		$textes = self::textes_legaux();

		if ( ! isset( $textes[ $page->post_name ] ) ) {
			return $contenu;
		}

		$langue = Secura_I18n::current_lang();
		$page_tr = $textes[ $page->post_name ];

		if ( isset( $page_tr[ $langue ]['content'] ) ) {
			return $page_tr[ $langue ]['content'];
		}

		return $contenu;
	}

	/**
	 * Le titre des pages legales, dans la langue du visiteur.
	 *
	 * @param string $titre Le titre normal.
	 * @param int    $id    L'identifiant du contenu.
	 * @return string
	 */
	public static function titre_legal( $titre, $id = 0 ) {
		$page = get_post( $id );

		if ( ! $page || 'page' !== $page->post_type ) {
			return $titre;
		}

		$textes = self::textes_legaux();

		if ( ! isset( $textes[ $page->post_name ] ) ) {
			return $titre;
		}

		$langue = Secura_I18n::current_lang();
		$page_tr = $textes[ $page->post_name ];

		if ( isset( $page_tr[ $langue ]['title'] ) ) {
			return $page_tr[ $langue ]['title'];
		}

		return $titre;
	}

	/**
	 * Les textes legaux, charges a la demande.
	 *
	 * On passe par la fonction « seca_textes_legaux() » et non par une
	 * variable globale : WP-CLI charge WordPress dans une portee de
	 * fonction, ou une variable globale de plugin n'existe pas. C'est
	 * precisement pour cela que les pages legales n'etaient creees que
	 * sur un vrai serveur web, et jamais en CI.
	 *
	 * @return array
	 */
	protected static function textes_legaux() {
		static $textes = null;

		if ( null === $textes ) {
			$textes = function_exists( 'seca_textes_legaux' ) ? seca_textes_legaux() : array();
		}

		return is_array( $textes ) ? $textes : array();
	}

	/**
	 * L'empreinte des textes legaux tels qu'ils avaient ete livres
	 * AVANT la version 0.8.1.
	 *
	 * En v0.8.0, un caractere etrange s'etait glisse dans une phrase de
	 * la politique de confidentialite : deux caracteres coréens a la
	 * place du mot « fonctionnalités » (on ne les reproduit pas ici :
	 * meme dans un commentaire, le code livre ne doit contenir que les
	 * ecritures du site). Invisible a l'ecran, le defaut etait bien
	 * present dans la base et dans l'API REST.
	 *
	 * On note ici l'empreinte de chaque version livree. Cela permet de
	 * distinguer trois situations, sans jamais deviner :
	 *
	 * - l'empreinte du texte en base est l'une de celles-ci : c'est
	 *   NOTRE texte, dans une version ancienne ; on le remplace par la
	 *   version corrigee ;
	 * - l'empreinte du texte en base est celle que nous avions installee
	 *   (meta « _secura_legal_hash ») : c'est NOTRE texte, on le met a
	 *   jour si le plugin a change depuis ;
	 * - l'empreinte ne correspond a aucune des deux : le proprietaire a
	 *   retouche le texte a la main ; on ne y touche JAMAIS.
	 */
	const EMPREINTES_LEGALES_ANTIEURES = array(
		'politique-de-confidentialite' => array( '2587a9dd91e7df53eb7c25157745df8c' ),
		'mentions-legales'             => array( '13ffa760fa7f913623435490de2d9936' ),
	);

	/**
	 * Cree (ou met a jour) les pages legales et les publie.
	 *
	 * Ces pages ne sont pas optionnelles : une plateforme qui accueille
	 * des mineurs doit dire ce qu'elle collecte et qui l'edite. On les
	 * publie donc a l'activation, en FR, avec les traductions AR et EN
	 * dans les metadonnees.
	 */
	public static function assurer_pages_legales() {
		$textes = self::textes_legaux();

		foreach ( $textes as $slug => $par_langue ) {
			$existante = get_page_by_path( $slug );

			$contenu_fr = isset( $par_langue['fr']['content'] ) ? $par_langue['fr']['content'] : '';
			$titre_fr  = isset( $par_langue['fr']['title'] ) ? $par_langue['fr']['title'] : $slug;

			/* L'empreinte du texte que nous livrons aujourd'hui. */
			$empreinte_livree = md5( $contenu_fr );

			if ( $existante ) {
				$id = (int) $existante->ID;

				$modifications = array( 'ID' => $id );

				if ( 'publish' !== $existante->post_status ) {
					$modifications['post_status'] = 'publish';
				}

				$contenu_base   = (string) $existante->post_content;
				$empreinte_base = md5( $contenu_base );
				$empreinte_ref  = (string) get_post_meta( $id, '_secura_legal_hash', true );

				/* Trois cas, decides par la preuve — jamais par une
				   impression. */
				if ( '' === trim( $contenu_base )
					|| false !== strpos( $contenu_base, 'privacy-policy-tutorial' ) ) {
					/* Page vide ou encore celle de WordPress : on y met
					   notre texte. */
					$a_remplacer = true;
				} elseif ( $empreinte_base === $empreinte_ref ) {
					/* C'est exactement le texte que nous avions installe :
					   si le plugin a ete corrige depuis, on met a jour. */
					$a_remplacer = ( $empreinte_base !== $empreinte_livree );
				} elseif ( isset( self::EMPREINTES_LEGALES_ANTIEURES[ $slug ] )
					&& in_array( $empreinte_base, self::EMPREINTES_LEGALES_ANTIEURES[ $slug ], true ) ) {
					/* Version anterieure de notre propre texte : on
					   remplace par la version corrigee. */
					$a_remplacer = true;
				} else {
					/* Le proprietaire a retouche le texte : on n'y touche
					   jamais. */
					$a_remplacer = false;
				}

				if ( $a_remplacer ) {
					$modifications['post_content'] = $contenu_fr;
					$modifications['post_title']   = $titre_fr;
					$modifications['post_excerpt'] = isset( $par_langue['fr']['excerpt'] ) ? $par_langue['fr']['excerpt'] : '';
				}

				if ( count( $modifications ) > 1 ) {
					wp_update_post( $modifications );
				}

				if ( $a_remplacer ) {
					/* On note l'empreinte du texte installe : la
					   prochaine fois, on saura qu'il est de nous. */
					update_post_meta( $id, '_secura_legal_hash', $empreinte_livree );
				}
			} else {
				$id = wp_insert_post(
					array(
						'post_title'   => $titre_fr,
						'post_name'    => $slug,
						'post_content' => $contenu_fr,
						'post_excerpt' => isset( $par_langue['fr']['excerpt'] ) ? $par_langue['fr']['excerpt'] : '',
						'post_status'  => 'publish',
						'post_type'    => 'page',
						'post_author'  => self::auteur_id(),
					)
				);

				if ( ! $id || is_wp_error( $id ) ) {
					continue;
				}

				/* Page creee : on note l'empreinte du texte installe. */
				update_post_meta( $id, '_secura_legal_hash', $empreinte_livree );
			}

			/* Les traductions sont rangees dans la meme metadonnee que
			   les rooms et les parcours. */
			$traductions = array();

			foreach ( array( 'ar', 'en' ) as $langue ) {
				if ( ! isset( $par_langue[ $langue ] ) ) {
					continue;
				}

				$traductions[ $langue ] = array(
					'title'   => isset( $par_langue[ $langue ]['title'] ) ? $par_langue[ $langue ]['title'] : '',
					'excerpt' => isset( $par_langue[ $langue ]['excerpt'] ) ? $par_langue[ $langue ]['excerpt'] : '',
					'content' => isset( $par_langue[ $langue ]['content'] ) ? $par_langue[ $langue ]['content'] : '',
				);
			}

			if ( ! empty( $traductions ) ) {
				update_post_meta( $id, '_secura_i18n', $traductions );
			}
		}
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
		self::assurer_pages_legales();
		self::nettoyer_contenus_par_defaut();

		update_option( 'seca_version_installee', SECURA_ACADEMY_VERSION );
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
