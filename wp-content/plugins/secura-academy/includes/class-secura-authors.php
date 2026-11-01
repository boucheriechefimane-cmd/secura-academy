<?php
/**
 * L'archive d'auteur : on la ferme.
 *
 * WordPress cree une page par auteur (/author/admin/). Sur une
 * plateforme de formation, elle ne sert a rien : elle ne liste aucun
 * contenu utile. Elle a deux Grades :
 *
 * 1. elle expose le nom du compte d'administration dans le plan du
 *    site — une information que personne ne doit publier ;
 * 2. elle duplique les contenus (une room publiee par l'admin y
 *    apparait une seconde fois), ce que Google sanctionne.
 *
 * On repond donc « page introuvable », comme si l'archive n'existait
 * pas. Ce n'est pas une erreur : c'est une adresse qui n'a jamais
 * existe pour le visiteur.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fermeture des archives d'auteur.
 */
class Secura_Authors {

	/**
	 * Branche le filtre.
	 */
	public static function init() {
		add_action( 'template_redirect', array( __CLASS__, 'fermer' ) );
		add_filter( 'wp_sitemaps_add_provider', array( __CLASS__, 'sans_utilisateurs' ) );
	}

	/**
	 * Retire le plan du site des utilisateurs.
	 *
	 * Le plan des utilisateurs n'apporte rien : il ne liste que des
	 * adresses d'auteur vides.
	 *
	 * @param WP_Sitemaps $sitemaps Le fournisseur du plan du site.
	 * @return WP_Sitemaps
	 */
	public static function sans_utilisateurs( $sitemaps ) {
		if ( is_object( $sitemaps ) && isset( $sitemaps->providers ) && is_array( $sitemaps->providers ) ) {
			unset( $sitemaps->providers['users'] );
		}

		return $sitemaps;
	}

	/**
	 * Repond « introuvable » a toute demande d'archive d'auteur.
	 */
	public static function fermer() {
		if ( ! is_author() ) {
			return;
		}

		global $wp_query;

		$wp_query->set_404();
		status_header( 404 );
		nocache_headers();

		/* On rend le gabarit 404 du theme s'il existe ; sinon celui de
		   WordPress. On ne fait jamais une inclusion « a l'aveugle » :
		   une adresse d'auteur ne doit pas provoquer une erreur 500. */
		$modele = get_query_template( '404' );

		if ( ! $modele ) {
			$modele = ABSPATH . WPINC . '/theme-compat/404.php';
		}

		if ( file_exists( $modele ) ) {
			include $modele;
		}

		exit;
	}
}
