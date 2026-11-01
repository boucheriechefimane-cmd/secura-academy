<?php
/**
 * Le fichier robots.txt de la plateforme.
 *
 * Pourquoi ce fichier est écrit a la main :
 *
 * Google dit (guide « AI features and your website ») que les reponses
 * generees par l'IA s'appuient sur le meme index que la recherche
 * classique. Un site n'a donc pas besoin d'etre « special » pour les
 * robots d'IA : il lui faut etre lisible, et surtout dire clairement
 * qu'il l'est. Ce fichier est cette declaration.
 *
 * Deux familles de robots, deux effets differents — c'est la distinction
 * que fait Google lui-meme :
 *
 *   1. Les robots de recherche et de citation (OAI-SearchBot,
 *      Claude-SearchBot, PerplexityBot, Googlebot...) : ce sont eux qui
 *      permettent a une page d'etre citee dans une reponse. Ils doivent
 *      etre autorises.
 *
 *   2. Les robots d'entrainement (GPTBot, ClaudeBot, Google-Extended,
 *      Applebot-Extended, CCBot...) : ils constituent le corpus
 *      d'entrainement des modeles. Les autoriser, c'est autoriser
 *      l'apprentissage ; ne pas les autoriser n'empeche PAS la citation
 *      dans une reponse.
 *
 * Nous autorisons les deux : le contenu de la plateforme est libre,
 * gratuit, et son utilite est qu'il circule. Mais la distinction reste
 * ecrite dans le fichier, pour qu'un choix different se prenne en
 * connaissance de cause.
 *
 * Le fichier est servi par WordPress (le filtre « robots_txt »), ce qui
 * garantit qu'il est toujours a jour et qu'il contient la bonne adresse
 * du site, quel que soit le nom de domaine.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * La politique d'acces des robots.
 */
class Secura_Robots {

	/**
	 * Branche le filtre sur le fichier robots.txt.
	 */
	public static function init() {
		add_filter( 'robots_txt', array( __CLASS__, 'robots_txt' ), 10, 2 );
	}

	/**
	 * Les robots de recherche et de citation : ils doivent pouvoir lire
	 * le site pour le citer dans une reponse.
	 *
	 * @return array
	 */
	protected static function robots_citation() {
		return array(
			'Googlebot',        // Recherche Google — c'est lui qui alimente les AI Overviews.
			'Bingbot',          // Recherche Bing / Copilot.
			'OAI-SearchBot',    // Index de recherche OpenAI (ChatGPT).
			'ChatGPT-User',     // Ouverture d'une page demandee par un utilisateur de ChatGPT.
			'Claude-SearchBot', // Index de recherche Anthropic (Claude).
			'Claude-User',      // Ouverture d'une page demandee par un utilisateur de Claude.
			'PerplexityBot',    // Index de recherche Perplexity.
			'Perplexity-User',  // Ouverture d'une page demandee dans Perplexity.
			'Applebot',         // Recherche Apple (Siri, Spotlight).
			'Amazonbot',        // Recherche Amazon (Alexa, Rufus).
			'Meta-ExternalAgent', // Recherche Meta.
		);
	}

	/**
	 * Les robots d'entrainement : ils apprennent avec le contenu du site.
	 *
	 * @return array
	 */
	protected static function robots_entrainement() {
		return array(
			'GPTBot',             // Entrainement OpenAI.
			'ClaudeBot',          // Entrainement Anthropic.
			'anthropic-ai',       // Ancetre de ClaudeBot.
			'Google-Extended',    // Entrainement et ancrage Google (hors AI Overviews).
			'Applebot-Extended',  // Apple Intelligence.
			'CCBot',              // Common Crawl, corpus de depart de nombreux modeles.
			'Bytespider',         // ByteDance.
			'cohere-ai',          // Cohere.
			'omgilibot',          // Omgili.
			'YouBot',             // You.com.
		);
	}

	/**
	 * Les zones privees : on n'y va pas, pour personne.
	 *
	 * @return array
	 */
	protected static function zones_privees() {
		return array(
			'/wp-admin/',
			'/wp-login.php',
			'/wp-json/',
			'/?s=',
		);
	}

	/**
	 * Construit le contenu du fichier robots.txt.
	 *
	 * @param string $output  Le contenu par defaut de WordPress.
	 * @param bool   $public  false si le site demande a ne pas etre indexe.
	 * @return string
	 */
	public static function robots_txt( $output, $public ) {
		/* Si le site demande a rester hors index, on respecte ce choix :
		   aucune autorisation speciale ne s'y oppose. */
		if ( ! $public ) {
			return $output;
		}

		$lignes = array();

		$lignes[] = '# Secura Academy — ' . wp_parse_url( home_url( '/' ), PHP_URL_HOST );
		$lignes[] = '#';
		$lignes[] = '# Ce site est libre, gratuit et multilingue (français, arabe, anglais).';
		$lignes[] = '# Les robots de recherche et de citation sont explicitement autorisés :';
		$lignes[] = '# le contenu est fait pour etre lu, compris et cité.';
		$lignes[] = '#';
		$lignes[] = '# Google rappelle que les réponses générées par l\'IA s\'appuient sur le';
		$lignes[] = '# même index que la recherche classique : il n\'y a pas de robots spécial';
		$lignes[] = '# « pour l\'IA ». Autoriser les robots de recherche, c\'est autoriser la';
		$lignes[] = '# citation.';
		$lignes[] = '';
		$lignes[] = '# ---------------------------------------------------------------';
		$lignes[] = '# 1. Tous les robots';
		$lignes[] = '# ---------------------------------------------------------------';
		$lignes[] = 'User-agent: *';
		$lignes[] = 'Allow: /';

		foreach ( self::zones_privees() as $zone ) {
			$lignes[] = 'Disallow: ' . $zone;
		}

		$lignes[] = '';
		$lignes[] = '# ---------------------------------------------------------------';
		$lignes[] = '# 2. Robots de recherche et de citation';
		$lignes[] = '#    (ceux qui permettent au site d\'être cité dans une réponse)';
		$lignes[] = '# ---------------------------------------------------------------';

		foreach ( self::robots_citation() as $robot ) {
			$lignes[] = 'User-agent: ' . $robot;
			$lignes[] = 'Allow: /';

			foreach ( self::zones_privees() as $zone ) {
				$lignes[] = 'Disallow: ' . $zone;
			}

			$lignes[] = '';
		}

		$lignes[] = '# ---------------------------------------------------------------';
		$lignes[] = '# 3. Robots d\'entraînement';
		$lignes[] = '#    (ils apprennent avec le contenu : les réponses cites le site';
		$lignes[] = '#     grâce aux robots du point 2, pas grâce à ceux-ci)';
		$lignes[] = '# ---------------------------------------------------------------';

		foreach ( self::robots_entrainement() as $robot ) {
			$lignes[] = 'User-agent: ' . $robot;
			$lignes[] = 'Allow: /';

			foreach ( self::zones_privees() as $zone ) {
				$lignes[] = 'Disallow: ' . $zone;
			}

			$lignes[] = '';
		}

		$lignes[] = '# ---------------------------------------------------------------';
		$lignes[] = '# 4. Les plans du site (le chemin le plus simple pour un robot)';
		$lignes[] = '# ---------------------------------------------------------------';
		$lignes[] = 'Sitemap: ' . home_url( '/wp-sitemap.xml' );

		return implode( "\n", $lignes ) . "\n";
	}
}
