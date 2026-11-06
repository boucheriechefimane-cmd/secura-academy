<?php
/**
 * La page « Sources et licences » : une seule page qui credite tout.
 *
 * POURQUOI CETTE PAGE EXISTE
 * --------------------------
 * Les licences Creative Commons de type BY (et BY-SA) exigent trois choses :
 * le nom de l'auteur, le titre de l'oeuvre, et l'URL de la licence. Une
 * mention glissee au bas d'une room ne suffit pas : elle est dispersee sur
 * plusieurs pages, et un lecteur ne peut pas la retrouver.
 *
 * Cette page est donc la page unique demandee par les licences. Elle est
 * generee a partir de deux sources de verite, jamais recopiees a la main :
 *
 *   1. tools/sources-autorisees.json — le catalogue dont la licence a ete
 *      verifiee (avec `reutilisable` et `commercial`) ;
 *   2. les sources citees dans les rooms installees (champ `source`).
 *
 * Elle separe trois categories, et c'est le point important :
 *
 *   - ce que nous hebergeons  -> attribution obligatoire, licence respectee ;
 *   - ce que nous republions sous licence libre (MIT, Apache-2.0, CC BY-SA) ;
 *   - ce que nous ne pouvons QUE citer en renvoi (contenu proprietaire).
 *
 * La troisieme colonne est celle qui repond a la question « pourquoi un
 * simple lien vers Cisco NetAcad ? » : parce que son contenu n'est pas
 * reutilisable, et qu'un lien est la seule chose honnete a faire.
 *
 * @package Secura_Academy
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enregistre le shortcode [secura_sources] et la page « Sources et licences ».
 */
class Secura_Sources {

	/**
	 * Slug de la page.
	 */
	const SLUG = 'sources-et-licences';

	/**
	 * Branche les actions.
	 */
	public static function init() {
		add_shortcode( 'secura_sources', array( __CLASS__, 'rendu' ) );
		add_action( 'init', array( __CLASS__, 'enregistrer_page' ) );
	}

	/**
	 * Cree la page si elle n'existe pas (idempotent).
	 */
	public static function enregistrer_page() {
		$existante = get_page_by_path( self::SLUG );

		if ( $existante ) {
			return;
		}

		wp_insert_post(
			array(
				'post_title'   => 'Sources et licences',
				'post_name'    => self::SLUG,
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '[secura_sources]',
			)
		);
	}

	/**
	 * Le catalogue verifie, lu depuis le depot.
	 *
	 * @return array[]
	 */
	public static function catalogue() {
		/* Deux emplacements, parce que le catalogue vit dans le depot et
		   est copie dans le plugin au moment de l'archive : la racine du
		   plugin d'abord (installation en un ZIP), puis le depot
		   (developpement et recette). Dans les deux cas, le fichier est
		   a « <racine>/tools/sources-autorisees.json ». */
		$plugin  = rtrim( dirname( __DIR__ ), '/\\' );
		$fichier = $plugin . '/tools/sources-autorisees.json';

		if ( ! is_file( $fichier ) ) {
			$fichier = dirname( $plugin, 3 ) . '/tools/sources-autorisees.json';
		}

		if ( ! is_file( $fichier ) ) {
			return array();
		}

		$json = json_decode( (string) file_get_contents( $fichier ), true );

		return is_array( $json ) && isset( $json['sources'] ) ? (array) $json['sources'] : array();
	}

	/**
	 * Les licences qui autorisent la reutilisation, et a quelles conditions.
	 *
	 * @param string $licence Licence declaree.
	 * @return array { hebergeable, partageable, note }
	 */
	public static function regime( $licence ) {
		$l = strtoupper( (string) $licence );

		if ( false !== strpos( $l, 'DOMAINE PUBLIC' ) || false !== strpos( $l, 'PUBLIC DOMAIN' ) ) {
			return array( 'hebergeable' => true, 'partageable' => true, 'note' => 'Aucune restriction : reproduction et modification libres.' );
		}

		if ( false !== strpos( $l, 'CC0' ) ) {
			return array( 'hebergeable' => true, 'partageable' => true, 'note' => 'Equivalent au domaine public : aucune attribution exigee (nous la mettons quand meme).' );
		}

		if ( false !== strpos( $l, 'MIT' ) ) {
			return array( 'hebergeable' => true, 'partageable' => true, 'note' => 'Code reutilisable : conserver la notice de copyright et la licence.' );
		}

		if ( false !== strpos( $l, 'APACHE' ) ) {
			return array( 'hebergeable' => true, 'partageable' => true, 'note' => 'Code reutilisable : conserver la licence et signaler les fichiers modifies.' );
		}

		if ( false !== strpos( $l, 'BSD' ) ) {
			return array( 'hebergeable' => true, 'partageable' => true, 'note' => 'Code reutilisable : conserver la notice de copyright.' );
		}

		if ( false !== strpos( $l, 'BY-SA' ) ) {
			return array( 'hebergeable' => true, 'partageable' => true, 'note' => 'Reutilisable avec attribution, et le partage doit rester sous la meme licence.' );
		}

		if ( false !== strpos( $l, 'BY-NC' ) ) {
			return array( 'hebergeable' => true, 'partageable' => false, 'note' => 'Reutilisable avec attribution, MAIS pas d\'usage commercial : cette plateforme est gratuite, la condition est tenue.' );
		}

		if ( false !== strpos( $l, 'BY' ) ) {
			return array( 'hebergeable' => true, 'partageable' => true, 'note' => 'Reutilisable avec attribution (auteur, titre, licence, lien).' );
		}

		return array( 'hebergeable' => false, 'partageable' => false, 'note' => 'Licence non reutilisable ou non verifiee : citation et renvoi seulement.' );
	}

	/**
	 * Le rendu du shortcode.
	 *
	 * @return string
	 */
	public static function rendu() {
		$catalogue = self::catalogue();

		$heberges    = array();
		$republies   = array();
		$renvois     = array();
		$verifiees   = 0;
		$non_verifiees = 0;

		foreach ( $catalogue as $source ) {
			$licence = isset( $source['licence'] ) ? (string) $source['licence'] : '';
			$regime  = self::regime( $licence );

			$ligne = array(
				'nom'         => isset( $source['nom'] ) ? $source['nom'] : ( isset( $source['id'] ) ? $source['id'] : '' ),
				'url'         => isset( $source['url'] ) ? $source['url'] : '',
				'licence'     => $licence,
				'attribution' => isset( $source['attribution'] ) ? $source['attribution'] : '',
				'usage'       => isset( $source['usage'] ) ? $source['usage'] : '',
				'note'        => $regime['note'],
				'commercial'  => ! empty( $source['commercial'] ),
			);

			if ( ! empty( $source['reutilisable'] ) ) {
				$verifiees++;

				if ( $regime['partageable'] ) {
					$republies[] = $ligne;
				} else {
					$heberges[] = $ligne;
				}
			} else {
				$non_verifiees++;
				$renvois[] = $ligne;
			}
		}

		/* Les sources citees par les lots importes : ceux qui alimentent
		   reellement des questions. On les ajoute pour qu'une source
		   importee ne reste jamais sans attribution sur cette page. */
		$citees = array();

		foreach ( Secura_Rooms::imports() as $lot ) {
			$source = isset( $lot['source'] ) ? (array) $lot['source'] : array();

			if ( empty( $source['attribution'] ) ) {
				continue;
			}

			$citees[ $source['attribution'] ] = $source;
		}

		$html  = '<div class="seca-sources">';
		$html .= '<p class="seca-sources__intro">Cette page est la page d\'attribution unique de la plateforme. '
			. 'Chaque licence Creative Commons de type BY exige trois elements : le nom de l\'auteur, le titre de l\'oeuvre, '
			. 'et l\'URL de la licence. Ils sont ci-dessous, source par source. Le site est gratuit : les licences '
			. '« pas d\'usage commercial » sont donc respectees, et nous le verifions source par source.</p>';

		$html .= '<p class="seca-sources__compte"><strong>'
			. sprintf(
				'%d sources au catalogue : %d republiables telles quelles, %d reutilisables a conditions, %d non reutilisables (donc citees en renvoi seulement).',
				count( $catalogue ),
				count( $republies ),
				count( $heberges ),
				$non_verifiees
			)
			. '</strong></p>';

		$html .= self::tableau(
			'Contenu republie sous licence libre',
			'Ces sources autorisent la reproduction, avec attribution. Nous les hebergeons donc ici, sans renvoi : le contenu est lisible sur la plateforme meme.',
			$republies
		);

		$html .= self::tableau(
			'Contenu reutilise a conditions',
			'Ces sources autorisent la reutilisation sous conditions (attribution, partage a l\'identique, ou pas d\'usage commercial). La plateforme etant gratuite et non commerciale, la condition est tenue ; l\'attribution est ci-dessous.',
			$heberges
		);

		$html .= self::tableau(
			'Contenu non reutilisable : renvoi et citation',
			'Pour ces sources, la licence interdit la reproduction. Nous ne copions donc rien : nous citons le titre et nous renvoyons vers la source. C\'est le cas de Cisco NetAcad, de PortSwigger Web Academy et des examens de certification : leur contenu est proprietaire, et un lien est la seule chose honnete a faire.',
			$renvois
		);

		if ( $citees ) {
			$html .= '<h2>Sources citees par les rooms</h2>';
			$html .= '<p>Ces references apparaissent dans une room. Elles sont reprises ici pour que l\'attribution reste '
				. 'retrouvable meme si la room est lue hors de son parcours.</p>';
			$html .= '<ul class="seca-sources__liste">';

			foreach ( $citees as $attribution => $source ) {
				$html .= '<li><strong>' . esc_html( $attribution ) . '</strong>';

				if ( ! empty( $source['url'] ) ) {
					$html .= ' — <a href="' . esc_url( $source['url'] ) . '" rel="noopener" target="_blank">source</a>';
				}

				if ( ! empty( $source['licence'] ) ) {
					$html .= ' — licence : ' . esc_html( $source['licence'] );
				}

				$html .= '</li>';
			}

			$html .= '</ul>';
		}

		$html .= '<h2>Les licences elles-memes</h2>';
		$html .= '<ul class="seca-sources__liste">'
			. '<li><a href="https://creativecommons.org/licenses/by/4.0/" rel="noopener" target="_blank">CC BY 4.0</a> et '
			. '<a href="https://creativecommons.org/licenses/by-sa/4.0/" rel="noopener" target="_blank">CC BY-SA 4.0</a> : '
			. 'reutilisation autorisee avec attribution ; BY-SA impose de partager a l\'identique.</li>'
			. '<li><a href="https://creativecommons.org/licenses/by-nc-sa/4.0/" rel="noopener" target="_blank">CC BY-NC-SA 4.0</a> : '
			. 'comme ci-dessus, sans usage commercial. C\'est la licence du MIT OpenCourseWare.</li>'
			. '<li><a href="https://opensource.org/license/mit" rel="noopener" target="_blank">MIT</a> et '
			. '<a href="https://www.apache.org/licenses/LICENSE-2.0" rel="noopener" target="_blank">Apache-2.0</a> : '
			. 'licences de code, utilisees pour les machines de laboratoire.</li>'
			. '<li><a href="https://www.gnu.org/licenses/gpl-3.0.html" rel="noopener" target="_blank">GPL-3.0</a> : '
			. 'certaines machines (DVWA, Security Shepherd) ne sont pas recopiees dans ce depot pour cette raison : '
			. 'elles sont lancees comme conteneurs separes, ce que la licence permet sans contaminer le reste.</li>'
			. '</ul>';

		$html .= '<h2>Signaler une erreur d\'attribution</h2>';
		$html .= '<p>Si vous etes auteur d\'un contenu cite ici et que l\'attribution est incomplete ou inexacte, '
			. 'signalez-le : la correction est immediate. Nous preferons retirer un contenu plutot que de le garder '
			. 'dans un flou de licence.</p>';

		$html .= '</div>';

		return $html;
	}

	/**
	 * Un tableau de sources.
	 *
	 * @param string  $titre   Titre de section.
	 * @param string  $intro   Phrase d'introduction.
	 * @param array[] $lignes  Lignes.
	 * @return string
	 */
	private static function tableau( $titre, $intro, array $lignes ) {
		if ( ! $lignes ) {
			return '';
		}

		$html  = '<h2>' . esc_html( $titre ) . ' <span class="seca-sources__nombre">(' . count( $lignes ) . ')</span></h2>';
		$html .= '<p>' . esc_html( $intro ) . '</p>';
		$html .= '<table class="seca-sources__table"><thead><tr>'
			. '<th>Source</th><th>Licence</th><th>Attribution exigee</th><th>Ce que nous en faisons</th>'
			. '</tr></thead><tbody>';

		foreach ( $lignes as $ligne ) {
			$html .= '<tr>';
			$html .= '<td>';

			if ( $ligne['url'] ) {
				$html .= '<a href="' . esc_url( $ligne['url'] ) . '" rel="noopener" target="_blank">' . esc_html( $ligne['nom'] ) . '</a>';
			} else {
				$html .= esc_html( $ligne['nom'] );
			}

			$html .= '</td>';
			$html .= '<td>' . esc_html( $ligne['licence'] ) . '</td>';
			$html .= '<td>' . esc_html( $ligne['attribution'] ? $ligne['attribution'] : $ligne['nom'] ) . '</td>';
			$html .= '<td>' . esc_html( $ligne['note'] );

			if ( $ligne['usage'] ) {
				$html .= '<br><em>' . esc_html( $ligne['usage'] ) . '</em>';
			}

			$html .= '</td>';
			$html .= '</tr>';
		}

		$html .= '</tbody></table>';

		return $html;
	}
}
