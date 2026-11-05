<?php
/**
 * Contrôles indicatifs des noms de commandes dans le HTML servi.
 *
 * La présence d'un attribut ne prouve pas le nom calculé par un lecteur
 * d'écran ; les dimensions et l'espacement exigés par WCAG 2.5.8 demandent
 * aussi une mesure dans un navigateur.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Vérifie qu'un texte, après décodage des entités, n'est pas que du blanc.
 *
 * @param string $texte Texte ou valeur d'attribut.
 * @return bool
 */
function audit_texte_non_vide( $texte ) {
	$texte = html_entity_decode( (string) $texte, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
	$sans_blanc = preg_replace( '/[\s\p{Z}]+/u', '', $texte );
	return null !== $sans_blanc && '' !== $sans_blanc;
}

/**
 * Détecte un attribut HTML non vide, sans confondre data-aria-label et
 * aria-label. Les valeurs citées et non citées sont acceptées.
 *
 * @param string $attributs Attributs de la balise.
 * @param string $nom Nom exact de l'attribut.
 * @return bool
 */
function audit_attribut_non_vide( $attributs, $nom ) {
	$motif = '/(?:^|\s)' . preg_quote( $nom, '/' ) . '\s*=\s*(?:"([^"]*)"|\'([^\']*)\'|([^\s"\'=<>`]+))/i';
	if ( ! preg_match( $motif, $attributs, $m, PREG_UNMATCHED_AS_NULL ) ) {
		return false;
	}

	$valeur = null !== $m[1] ? $m[1] : ( null !== $m[2] ? $m[2] : $m[3] );
	return audit_texte_non_vide( $valeur );
}

/**
 * Détecte les moyens courants de nommer une commande : texte visible,
 * aria-label, aria-labelledby, title ou texte alternatif d'une image.
 *
 * @param string $attributs Attributs de la commande.
 * @param string $contenu Contenu HTML de la commande.
 * @return bool
 */
function audit_commande_nom_indique( $attributs, $contenu ) {
	if ( audit_texte_non_vide( wp_strip_all_tags( $contenu ) ) ) {
		return true;
	}

	foreach ( array( 'aria-label', 'aria-labelledby', 'title' ) as $nom ) {
		if ( audit_attribut_non_vide( $attributs, $nom ) ) {
			return true;
		}
	}

	if ( preg_match_all( '/<img\b([^>]*)>/i', $contenu, $images ) ) {
		foreach ( $images[1] as $image ) {
			if ( audit_attribut_non_vide( $image, 'alt' ) ) {
				return true;
			}
		}
	}

	return false;
}

/**
 * Renvoie les liens et boutons sans aucun nom détecté par cette heuristique.
 *
 * @param array $pages HTML des pages indexé par nom.
 * @return array
 */
function audit_commandes_sans_nom( $pages ) {
	$sans_nom = array();
	foreach ( $pages as $nom => $corps ) {
		if ( preg_match_all( '/<(a|button)\b([^>]*)>(.*?)<\/\1>/is', $corps, $m ) ) {
			foreach ( $m[2] as $index => $attributs ) {
				if ( ! audit_commande_nom_indique( $attributs, $m[3][ $index ] ) ) {
					$sans_nom[] = $nom . ' : <' . $m[1][ $index ] . $attributs . '> sans nom indiqué';
				}
			}
		}
	}
	return $sans_nom;
}
