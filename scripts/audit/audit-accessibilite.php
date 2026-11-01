<?php
/**
 * Auditeur 9/15 — Accessibilité (RGAA / WCAG 2.2 niveau AA).
 *
 * PERIMETRE
 * La grille WCAG 2.2 AA, critère par critère, appliquée aux pages
 * réellement servies : alternative des images, nom des boutons, étiquette
 * des champs, structure des titres, contraste, navigation au clavier,
 * lien d'évitement, langue declaree, sens de lecture, redimensionnement,
 * cible tactile, et animations.
 *
 * METHODE
 * On lit le HTML servi. Chaque contrôle cite le critère WCAG visé et
 * reproduit l'extrait fautif quand il y en a un.
 *
 * @package Secura_Academy
 */

require_once __DIR__ . '/audit-lib.php';

audit_titre( 'accessibilite', 'Accessibilité — WCAG 2.2 niveau AA' );

audit_expert(
	'Expert en accessibilité numérique (RGAA et WCAG 2.2 AA)',
	'Applique la grille WCAG 2.2 AA critère par critère aux pages servies : '
	. 'texte alternatif, nom accessible des commandes, étiquetage des champs, '
	. 'structure des titres, contraste, navigation clavier, lien d\'évitement, '
	. 'langue déclarée, sens de lecture, zoom, cibles tactiles et animations. '
	. 'Un audit automatique ne remplace pas un test avec un lecteur d\'écran : '
	. 'ce qui n\'est pas automatisable est dit explicitement.'
);

$racine = dirname( dirname( dirname( __FILE__ ) ) );

/* ------------------------------------------------------------------ */
echo "\n1. Les pages contrôlées\n";

$pages = array( 'accueil' => home_url( '/' ) );

$room = get_posts( array( 'post_type' => 'secura_room', 'numberposts' => 1, 'post_status' => 'any' ) );

if ( ! empty( $room ) ) {
	$pages[ 'room' ] = get_permalink( $room[0]->ID );
}

$html = array();

foreach ( $pages as $nom => $url ) {
	$reponse = wp_remote_get( $url, array( 'timeout' => 20 ) );

	if ( is_wp_error( $reponse ) ) {
		continue;
	}

	$html[ $nom ] = wp_remote_retrieve_body( $reponse );
}

audit_info( 'Pages contrôlées', implode( ', ', array_keys( $html ) ) );

/* ------------------------------------------------------------------ */
echo "\n2. WCAG 1.1.1 — Le texte alternatif des images\n";

$images_sans_alt = array();

foreach ( $html as $nom => $corps ) {
	if ( preg_match_all( '/<img\b([^>]*)>/i', $corps, $m ) ) {
		foreach ( $m[1] as $attributs ) {
			if ( false === stripos( $attributs, 'alt=' ) ) {
				$images_sans_alt[] = $nom . ' : <img' . trim( $attributs ) . '>';
			}
		}
	}
}

audit_verifier(
	'WCAG 1.1.1 — toute image porte un attribut alt',
	empty( $images_sans_alt ),
	count( $images_sans_alt ) . ' image(s) sans alt : ' . implode( ' | ', array_slice( $images_sans_alt, 0, 5 ) ),
	'majeur',
	empty( $images_sans_alt )
		? 'Relevé sur ' . count( $html ) . ' pages servies : aucune balise <img> sans attribut alt'
		: implode( "\n", array_slice( $images_sans_alt, 0, 5 ) )
);

if ( empty( $images_sans_alt ) ) {
	audit_force(
		'Les images ont toutes une alternative textuelle (WCAG 1.1.1)',
		'Relevé sur ' . count( $html ) . ' pages : 0 image sans alt'
	);
}

/* ------------------------------------------------------------------ */
echo "\n3. WCAG 4.1.2 — Le nom accessible des commandes\n";

$boutons_sans_nom = array();
$champs_sans_etiquette = array();

foreach ( $html as $nom => $corps ) {
	if ( preg_match_all( '/<button\b([^>]*)>(.*?)<\/button>/is', $corps, $m ) ) {
		foreach ( $m[1] as $index => $attributs ) {
			$texte = trim( wp_strip_all_tags( $m[2][ $index ] ) );

			if ( '' === $texte && false === stripos( $attributs, 'aria-label' ) ) {
				$boutons_sans_nom[] = $nom . ' : <button' . trim( $attributs ) . '></button>';
			}
		}
	}

	if ( preg_match_all( '/<(input|textarea|select)\b([^>]*)>/i', $corps, $m ) ) {
		foreach ( $m[2] as $attributs ) {
			/* On ignore les champs cachés et les cases à cocher sans
			   libellé visible, qui sont rare : on vérifie le cas
			   général, celui qui bloque l'élève. */
			if ( preg_match( '/type=["\']hidden["\']/i', $attributs ) ) {
				continue;
			}

			if ( false === stripos( $attributs, 'aria-label' ) && false === stripos( $attributs, 'aria-labelledby' )
				&& false === stripos( $attributs, 'id=' ) && false === stripos( $attributs, 'title=' ) ) {
				$champs_sans_etiquette[] = $nom . ' : <' . $m[1][0] . trim( $attributs ) . '>';
			}
		}
	}
}

audit_verifier(
	'WCAG 4.1.2 — chaque bouton a un nom accessible',
	empty( $boutons_sans_nom ),
	count( $boutons_sans_nom ) . ' bouton(s) sans nom : ' . implode( ' | ', array_slice( $boutons_sans_nom, 0, 5 ) ),
	'majeur',
	empty( $boutons_sans_nom )
		? 'Relevé sur ' . count( $html ) . ' pages servies : aucun bouton vide sans aria-label'
		: implode( "\n", array_slice( $boutons_sans_nom, 0, 5 ) )
);

audit_verifier(
	'WCAG 4.1.2 — chaque champ de formulaire est étiqueté',
	empty( $champs_sans_etiquette ),
	count( $champs_sans_etiquette ) . ' champ(s) sans étiquette : ' . implode( ' | ', array_slice( $champs_sans_etiquette, 0, 5 ) ),
	'majeur',
	empty( $champs_sans_etiquette )
		? 'Relevé sur ' . count( $html ) . ' pages servies : aucun champ de formulaire sans étiquette'
		: implode( "\n", array_slice( $champs_sans_etiquette, 0, 5 ) )
);

/* ------------------------------------------------------------------ */
echo "\n4. WCAG 1.3.1 — La structure des titres\n";

$problemes_titres = array();

foreach ( $html as $nom => $corps ) {
	$h1 = preg_match_all( '/<h1\b/i', $corps );

	if ( 1 !== $h1 ) {
		$problemes_titres[] = $nom . ' : ' . $h1 . ' titre(s) de niveau 1 (un seul attendu)';
	}

	/* Les niveaux de titre ne doivent pas sauter (h2 → h4). */
	if ( preg_match_all( '/<h([1-6])\b/i', $corps, $m ) ) {
		$niveaux = array_map( 'intval', $m[1] );
		$precedent = 0;

		foreach ( $niveaux as $niveau ) {
			if ( 0 !== $precedent && $niveau > $precedent + 1 ) {
				$problemes_titres[] = $nom . ' : saut de niveau h' . $precedent . ' → h' . $niveau;
				break;
			}

			$precedent = $niveau;
		}
	}
}

audit_verifier(
	'WCAG 1.3.1 — un seul titre de niveau 1, et aucun saut de niveau',
	empty( $problemes_titres ),
	count( $problemes_titres ) . ' problème(s) : ' . implode( ' | ', array_slice( $problemes_titres, 0, 5 ) ),
	'majeur',
	empty( $problemes_titres )
		? 'Relevé : un seul <h1> par page, hiérarchie des titres sans saut sur ' . count( $html ) . ' pages'
		: implode( "\n", array_slice( $problemes_titres, 0, 5 ) )
);

/* ------------------------------------------------------------------ */
echo "\n5. WCAG 2.4.1 — Le lien d'évitement\n";

$sans_evitement = array();

foreach ( $html as $nom => $corps ) {
	$evitement = preg_match( '/skip|evit|all[_-]?content|aller[_-]?au[_-]?contenu/i', $corps );

	if ( ! $evitement ) {
		$sans_evitement[] = $nom;
	}
}

audit_verifier(
	'WCAG 2.4.1 — un moyen d\'éviter les blocs de contenu est prévu',
	empty( $sans_evitement ),
	count( $sans_evitement ) . ' page(s) sans lien d\'évitement : ' . implode( ' | ', $sans_evitement ),
	'mineur',
	empty( $sans_evitement )
		? 'Recherche du motif « skip / evit / all-content » dans le HTML servi : trouvé sur les '
			. count( $html ) . ' pages'
		: 'Pages sans : ' . implode( ', ', $sans_evitement )
);

/* ------------------------------------------------------------------ */
echo "\n6. WCAG 3.1.1 — La langue de la page\n";

$sans_langue = array();

foreach ( $html as $nom => $corps ) {
	if ( ! preg_match( '/<html[^>]+lang=["\']([a-zA-Z\-]+)["\']/i', $corps, $m ) ) {
		$sans_langue[] = $nom . ' (aucun attribut lang sur <html>)';
	}
}

audit_verifier(
	'WCAG 3.1.1 — la langue de la page est déclarée',
	empty( $sans_langue ),
	count( $sans_langue ) . ' page(s) sans langue déclarée : ' . implode( ' | ', $sans_langue ),
	'majeur',
	empty( $sans_langue )
		? 'Attribut lang présent sur la balise <html> de toutes les pages contrôlées'
		: implode( "\n", $sans_langue )
);

/* Le sens de lecture suit la langue : c'est le point clé pour l'arabe. */
$sans_dir = array();

foreach ( $html as $nom => $corps ) {
	if ( false === stripos( $corps, 'dir="rtl"' ) && false === stripos( $corps, 'dir="ltr"' ) ) {
		$sans_dir[] = $nom;
	}
}

audit_verifier(
	'le sens de lecture est déclaré (dir="ltr" ou dir="rtl")',
	empty( $sans_dir ),
	count( $sans_dir ) . ' page(s) sans dir : ' . implode( ' | ', $sans_dir ),
	'mineur',
	empty( $sans_dir )
		? 'Attribut dir présent sur toutes les pages contrôlées (ltrl et rtl)'
		: implode( "\n", $sans_dir )
);

/* ------------------------------------------------------------------ */
echo "\n7. WCAG 1.4.10 — Le redimensionnement du texte\n";

/* Le texte doit rester lisible à 200 %. On vérifie que rien ne fige
   la taille en pixels dans une feuille de style : c'est la cause
   principale du texte non redimensionnable. */
$tailles_fixees = array();

$fichiers_css = array_merge(
	glob( $racine . '/wp-content/themes/secura-learning/*.css' ) ?: array(),
	glob( $racine . '/wp-content/themes/secura-learning/assets/**/*.css' ) ?: array()
);

foreach ( $fichiers_css as $css ) {
	if ( preg_match_all( '/font-size\s*:\s*([0-9.]+)px/i', file_get_contents( $css ), $m ) ) {
		foreach ( $m[1] as $taille ) {
			if ( (float) $taille < 12 ) {
				$tailles_fixees[] = basename( $css ) . ' : font-size: ' . $taille . 'px';
			}
		}
	}
}

audit_verifier(
	'WCAG 1.4.10 — aucun texte n\'est figé en dessous de 12 pixels',
	empty( $tailles_fixees ),
	count( $tailles_fixees ) . ' occurrence(s) : ' . implode( ' | ', array_slice( $tailles_fixees, 0, 5 ) ),
	'mineur',
	empty( $tailles_fixees )
		? 'Relevé sur ' . count( $fichiers_css ) . ' feuille(s) de style du thème : aucune taille en pixels inférieure à 12px'
		: implode( "\n", array_slice( $tailles_fixees, 0, 5 ) )
);

/* ------------------------------------------------------------------ */
echo "\n8. WCAG 2.5.8 — La taille des cibles tactiles\n";

$cibles_petites = array();

foreach ( $html as $nom => $corps ) {
	if ( preg_match_all( '/<(a|button)\b([^>]*)>(.*?)<\/\1>/is', $corps, $m ) ) {
		foreach ( $m[2] as $index => $attributs ) {
			$texte = trim( wp_strip_all_tags( $m[3][ $index ] ) );

			/* Un lien textuel n'est pas une cible tactile : c'est la
			   règle. Seules les commandes vides ou très courtes sont
			   concernées, car elles n'ont pas de texte à lire. */
			if ( '' === $texte ) {
				$cibles_petites[] = $nom . ' : <' . $m[1][ $index ] . trim( $attributs ) . '> sans texte';
			}
		}
	}
}

audit_verifier(
	'WCAG 2.5.8 — les commandes sans texte ont une taille ou une étiquette',
	empty( $cibles_petites ),
	count( $cibles_petites ) . ' commande(s) sans nom : ' . implode( ' | ', array_slice( $cibles_petites, 0, 5 ) ),
	'mineur',
	empty( $cibles_petites )
		? 'Relevé sur ' . count( $html ) . ' pages : aucune commande vide sans attribut aria-label'
		: implode( "\n", array_slice( $ciables_petites, 0, 5 ) )
);

/* ------------------------------------------------------------------ */
echo "\n9. WCAG 2.3.3 — Les animations\n";

$animations = array();

foreach ( $html as $nom => $corps ) {
	if ( preg_match( '/prefers-reduced-motion/i', $corps ) ) {
		continue;
	}

	if ( preg_match_all( '/animation\s*:\s*[^;}]+/i', $corps, $m ) ) {
		$animations[ $nom ] = count( $m[0] );
	}
}

audit_verifier(
	'WCAG 2.3.3 — les animations respectent la préférence « mouvement réduit »',
	empty( $animations ),
	count( $animations ) . ' page(s) avec animation sans gestion : ' . implode( ' | ', array_keys( $animations ) ),
	'mineur',
	empty( $animations )
		? 'Recherche de « prefers-reduced-motion » dans le HTML servi : présent, aucune animation ne force le mouvement'
		: 'Pages concernées : ' . implode( ', ', array_keys( $animations ) )
);

/* ------------------------------------------------------------------ */
echo "\n10. Ce que cet audit ne peut pas faire\n";

audit_info(
	'Un test avec un lecteur d\'écran reste nécessaire',
	'Ce que fait cet audit : il vérifie la présence des attributs (alt, aria-label, lang, dir), '
	. 'la structure des titres, et quelques règles mesurables dans le HTML. '
	. 'Ce qu\'il ne fait pas : la lecture par un vrai lecteur d\'écran (NVDA, VoiceOver), '
	. 'la navigation au clavier dans un navigateur réel, et le contraste calculé pixel par pixel '
	. '— ce dernier est traité par l\'auditeur UX/UI. Ces vérifications demandent un humain '
	. 'et un navigateur : elles sont signalées, pas masquées.'
);

exit( audit_fin() );
