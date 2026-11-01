<?php
/**
 * Auditeur 8/15 — Données structurées et entités.
 *
 * PERIMETRE
 * Le JSON-LD reellement servi : sa presence, sa validite syntaxique, sa
 * completude (les types declares doivent correspondre au contenu visible),
 * sa coherence entre les versions linguistiques, et la presence des types
 * que les moteurs et les systemes generatifs savent exploiter.
 *
 * METHODE
 * On lit le JSON-LD dans le HTML servi (pas dans le code source), on le
 * decode, et on verifie chaque type. Chaque constat porte le JSON
 * fautif, ou le type manquant.
 *
 * @package Secura_Academy
 */

require_once __DIR__ . '/audit-lib.php';

audit_titre( 'donnees-structurees', 'Données structurées et entités' );

audit_expert(
	'Expert en données structurées (schema.org) et en référencement sémantique',
	'Vérifie le JSON-LD réellement servi par le site : présence, validité JSON, '
	. 'complétude des types, cohérence avec le contenu visible (ce qui est déclaré '
	. 'doit exister à l\'écran), et cohérence entre les versions linguistiques. '
	. 'Ces données sont le langage que parlent les moteurs de recherche et les systèmes génératifs.'
);

$racine = dirname( dirname( dirname( __FILE__ ) ) );

/**
 * Aplatit un bloc JSON-LD en une liste d'entités.
 *
 * Un JSON-LD peut être un objet, un tableau, ou un objet contenant un
 * « @graph » (la forme la plus courante). Sans cela, on lirait une page
 * comme si elle ne déclarait rien — un faux positif.
 *
 * @param mixed $bloc Le bloc décodé.
 * @return array Les entités.
 */
function audit_entites_jsonld( $bloc ) {
	if ( ! is_array( $bloc ) ) {
		return array();
	}

	if ( isset( $bloc['@graph'] ) && is_array( $bloc['@graph'] ) ) {
		return $bloc['@graph'];
	}

	if ( isset( $bloc[0] ) ) {
		return $bloc;
	}

	return array( $bloc );
}

/* ------------------------------------------------------------------ */
echo "\n1. Le JSON-LD est-il servi et valide ?\n";

$pages = array( 'accueil' => home_url( '/' ) );

/* TOUTES les rooms et TOUS les parcours sont contrôlés. Choisir
   « une room » laissait passer les défauts de toutes les autres : le
   résultat dépendait alors de l'identifiant tiré. */
$rooms    = get_posts( array( 'post_type' => 'secura_room', 'numberposts' => -1, 'post_status' => 'any', 'orderby' => 'ID', 'order' => 'ASC' ) );
$parcours = get_posts( array( 'post_type' => 'secura_path', 'numberposts' => -1, 'post_status' => 'any', 'orderby' => 'ID', 'order' => 'ASC' ) );

foreach ( $rooms as $chambre ) {
	$pages[ 'room ' . $chambre->ID ] = get_permalink( $chambre->ID );
}

foreach ( $parcours as $chemin ) {
	$pages[ 'parcours ' . $chemin->ID ] = get_permalink( $chemin->ID );
}

$blocs_par_page = array();
$corps_par_page = array();
$json_invalide  = array();
$sans_jsonld    = array();

foreach ( $pages as $nom => $url ) {
	$reponse = wp_remote_get( $url, array( 'timeout' => 20 ) );

	if ( is_wp_error( $reponse ) ) {
		$sans_jsonld[] = $nom . ' (' . $url . ') : page non servie';
		continue;
	}

	$corps = wp_remote_retrieve_body( $reponse );

	if ( ! preg_match_all( '/<script[^>]+type=["\']application\/ld\+json["\'][^>]*>(.*?)<\/script>/is', $corps, $m ) ) {
		$sans_jsonld[] = $nom . ' (' . $url . ')';
		continue;
	}

	$blocs = array();

	foreach ( $m[1] as $bloc ) {
		$decode = json_decode( trim( $bloc ), true );

		if ( null === $decode && 'null' !== trim( $bloc ) ) {
			$json_invalide[] = $nom . ' : ' . substr( trim( $bloc ), 0, 120 );
			continue;
		}

		$blocs[] = $decode;
	}

	$blocs_par_page[ $nom ] = $blocs;
	$corps_par_page[ $nom ] = $corps;
}

audit_verifier(
	'chaque page importante sert des données structurées',
	empty( $sans_jsonld ),
	count( $sans_jsonld ) . ' page(s) sans JSON-LD : ' . implode( ' | ', $sans_jsonld ),
	'majeur',
	empty( $sans_jsonld )
		? 'Pages contrôlées : ' . implode( ', ', array_keys( $blocs_par_page ) ) . ' — toutes servent un JSON-LD valide'
		: implode( "\n", $sans_jsonld )
);

audit_verifier(
	'le JSON-LD est du JSON valide (une erreur de syntaxe fait ignorer tout le bloc)',
	empty( $json_invalide ),
	count( $json_invalide ) . ' bloc(s) invalide(s) : ' . implode( ' | ', array_slice( $json_invalide, 0, 3 ) ),
	'bloquant',
	empty( $json_invalide )
		? 'Tous les blocs JSON-LD des pages contrôlées se décodent sans erreur'
		: implode( "\n", $json_invalide )
);

if ( empty( $sans_jsonld ) && empty( $json_invalide ) ) {
	audit_force(
		'Les données structurées sont servies et valides sur toutes les pages contrôlées',
		'Pages contrôlées : ' . implode( ', ', array_keys( $blocs_par_page ) ) . ' — JSON décodé sans erreur'
	);
}

/* ------------------------------------------------------------------ */
echo "\n2. Les types déclarés, page par page\n";

$types_par_page = array();

foreach ( $blocs_par_page as $nom => $blocs ) {
	$types = array();

	foreach ( $blocs as $bloc ) {
		foreach ( audit_entites_jsonld( $bloc ) as $entree ) {
			if ( ! is_array( $entree ) || ! isset( $entree['@type'] ) ) {
				continue;
			}

			$type = $entree['@type'];

			$types[] = is_array( $type ) ? implode( ', ', $type ) : (string) $type;
		}
	}

	$types_par_page[ $nom ] = array_values( array_unique( $types ) );
}

/* Le relevé est agrégé : une ligne par type de page, pas une ligne par
   room — sinon le rapport noierait le lecteur sous 52 lignes
   identiques. */
$types_rooms = array();

foreach ( $types_par_page as $nom => $types ) {
	if ( 0 === strpos( $nom, 'room ' ) ) {
		$types_rooms[ $nom ] = implode( ', ', $types );
		continue;
	}

	audit_info(
		'Types déclarés sur « ' . $nom . ' »',
		implode( ', ', $types )
	);
}

if ( ! empty( $types_rooms ) ) {
	$formes_rooms = array_count_values( $types_rooms );

	audit_info(
		'Types déclarés sur les ' . count( $types_rooms ) . ' rooms',
		implode( ' ; ', array_map(
			function ( $nombre, $types ) {
				return $nombre . ' room(s) : ' . $types;
			},
			array_keys( $formes_rooms ),
			array_values( $formes_rooms )
		) )
	);
}

/* ------------------------------------------------------------------ */
echo "\n3. La complétude : le type attendu est-il là ?\n";

/* Un « Course » sans « LearningResource », ou l'inverse, envoie un
   signal incomplet. On vérifie page par page ce qui est attendu. */
$attendus = array( 'accueil' => array( 'Organization', 'WebSite' ) );

foreach ( $rooms as $chambre ) {
	$attendus[ 'room ' . $chambre->ID ] = array( 'LearningResource', 'BreadcrumbList' );
}

foreach ( $parcours as $chemin ) {
	$attendus[ 'parcours ' . $chemin->ID ] = array( 'ItemList' );
}

$manquants = array();

foreach ( $attendus as $page => $types_cles ) {
	if ( ! isset( $types_par_page[ $page ] ) ) {
		continue;
	}

	foreach ( $types_cles as $type ) {
		$present = false;

		foreach ( $types_par_page[ $page ] as $declare ) {
			if ( false !== stripos( $declare, $type ) ) {
				$present = true;
				break;
			}
		}

		if ( ! $present ) {
			$manquants[] = $page . ' ne déclare pas « ' . $type . ' » (déclaré : '
				. ( empty( $types_par_page[ $page ] ) ? 'rien' : implode( ', ', $types_par_page[ $page ] ) ) . ')';
		}
	}
}

audit_verifier(
	'les types attendus sont déclarés sur chaque type de page',
	empty( $manquants ),
	count( $manquants ) . ' type(s) manquant(s) : ' . implode( ' | ', $manquants ),
	'majeur',
	empty( $manquants )
		? sprintf(
			'Relevé : accueil [%s] ; %d room(s) déclarant toutes « LearningResource » et « BreadcrumbList » ; %d parcours déclarant « ItemList »',
			implode( ', ', isset( $types_par_page['accueil'] ) ? $types_par_page['accueil'] : array() ),
			count( $rooms ),
			count( $parcours )
		)
		: implode( "\n", $manquants )
);

/* Le type Course : une plateforme de formation doit se déclarer
   comme telle. C'est le type que les moteurs de recherche et les
   plateformes de cours savent lire. */
$course_declare = false;

foreach ( $types_par_page as $types ) {
	foreach ( $types as $type ) {
		if ( false !== stripos( $type, 'Course' ) ) {
			$course_declare = true;
			break 2;
		}
	}
}

audit_verifier(
	'la plateforme se déclare comme un cours (type « Course » de schema.org)',
	$course_declare,
	$course_declare ? '' : 'Le type « Course » n\'est déclaré sur aucune page contrôlée — '
		. 'alors que le site est une plateforme de formation. C\'est le type que les moteurs '
		. 'et les plateformes de cours savent lire.',
	'majeur',
	$course_declare
		? 'Type « Course » trouvé dans les types déclarés'
		: 'Types déclarés, page par page : ' . wp_json_encode( $types_par_page )
);

if ( $course_declare ) {
	audit_force(
		'La plateforme se déclare comme un cours (type « Course »)',
		'Type « Course » présent dans le JSON-LD servi'
	);
}

/* ------------------------------------------------------------------ */
echo "\n4. La cohérence : le déclaré existe-t-il à l'écran ?\n";

/* Le pire défaut des données structurées : annoncer un prix, une note
   ou une durée qui n'apparaissent nulle part sur la page. On compare
   le texte déclaré et le texte visible. */
$incoherences = array();

foreach ( $blocs_par_page as $nom_page => $blocs ) {
	if ( 0 !== strpos( $nom_page, 'room ' ) ) {
		continue;
	}

	$visible = isset( $corps_par_page[ $nom_page ] ) ? $corps_par_page[ $nom_page ] : '';

	foreach ( $blocs as $bloc ) {
		foreach ( audit_entites_jsonld( $bloc ) as $entree ) {
			if ( ! is_array( $entree ) || ! isset( $entree['@type'] ) ) {
				continue;
			}

			$nom = isset( $entree['name'] ) ? (string) $entree['name'] : '';

			if ( '' === $nom ) {
				continue;
			}

			/* On compare des textes normalisés : le HTML échappe
			   l'apostrophe typographique (&#8217;) et WordPress la
			   transforme, alors que le JSON-LD garde l'apostrophe
			   droite. Sans cette normalisation, le contrôle signalait
			   un titre qui est pourtant bien à l'écran. */
			$visible_normalise = audit_normaliser_texte( wp_strip_all_tags( $visible ) );
			$nom_normalise     = audit_normaliser_texte( $nom );

			if ( '' !== $visible_normalise && '' !== $nom_normalise
				&& false === stripos( $visible_normalise, $nom_normalise ) ) {
				$incoherences[] = $nom_page . ' : « ' . $nom . ' » est déclaré mais n\'apparaît pas dans le texte visible';
			}
		}
	}
}

audit_verifier(
	'ce qui est déclaré apparaît aussi à l\'écran (pas de donnée fantôme)',
	empty( $incoherences ),
	count( $incoherences ) . ' incohérence(s) : ' . implode( ' | ', array_slice( $incoherences, 0, 5 ) ),
	'majeur',
	empty( $incoherences )
		? 'Comparaison faite, room par room, entre le champ « name » du JSON-LD et le texte visible de la même page : les ' . count( $rooms ) . ' rooms concordent'
		: implode( "\n", $incoherences )
);

/* ------------------------------------------------------------------ */
echo "\n5. La cohérence entre les langues\n";

/* Si la version arabe déclare un titre différent du français, les
   moteurs peuvent voir deux pages différentes pour le même contenu. */
$incoherences_langue = array();

/* Chaque room est vérifiée dans les DEUX autres langues : une room
   oubliée en arabe est un piège pour le moteur (deux pages différentes
   pour le même contenu). */
foreach ( $rooms as $chambre ) {
	$titre_fr = (string) $chambre->post_title;

	foreach ( array( 'ar', 'en' ) as $langue ) {
		$reponse = wp_remote_get( add_query_arg( 'seca_lang', $langue, get_permalink( $chambre->ID ) ), array( 'timeout' => 20 ) );

		if ( is_wp_error( $reponse ) ) {
			$incoherences_langue[] = 'room ' . $chambre->ID . ' : la version ' . $langue . ' n\'a pas été servie';
			continue;
		}

		$corps = wp_remote_retrieve_body( $reponse );

		if ( ! preg_match_all( '/<script[^>]+type=["\']application\/ld\+json["\'][^>]*>(.*?)<\/script>/is', $corps, $m ) ) {
			$incoherences_langue[] = 'room ' . $chambre->ID . ' : la version ' . $langue . ' ne sert aucun JSON-LD';
			continue;
		}

		$nom_trouve = '';

		foreach ( $m[1] as $bloc ) {
			$decode = json_decode( trim( $bloc ), true );

			if ( ! is_array( $decode ) ) {
				continue;
			}

			foreach ( audit_entites_jsonld( $decode ) as $entree ) {
				if ( is_array( $entree ) && isset( $entree['name'] ) && isset( $entree['@type'] )
					&& false !== stripos( (string) $entree['@type'], 'LearningResource' ) ) {
					$nom_trouve = (string) $entree['name'];
					break 2;
				}
			}
		}

		if ( '' === $nom_trouve ) {
			$incoherences_langue[] = 'room ' . $chambre->ID . ' : la version ' . $langue . ' ne déclare pas de LearningResource';
		} elseif ( $nom_trouve === $titre_fr ) {
			$incoherences_langue[] = 'room ' . $chambre->ID . ' : la version ' . $langue . ' déclare encore le titre français « '
				. $nom_trouve . ' »';
		}
	}
}

audit_verifier(
	'chaque version linguistique déclare ses propres données structurées',
	empty( $incoherences_langue ),
	count( $incoherences_langue ) . ' problème(s) : ' . implode( ' | ', $incoherences_langue ),
	'majeur',
	empty( $incoherences_langue )
		? 'Versions contrôlées : arabe et anglais, pour les ' . count( $rooms ) . ' rooms — chacune déclare un LearningResource avec son propre titre'
		: implode( "\n", $incoherences_langue )
);

/* ------------------------------------------------------------------ */
echo "\n6. Les valeurs sont-elles lisibles telles quelles ?\n";

/* Un JSON-LD est placé dans un bloc <script> : les entités HTML n'y
   sont PAS décodées. Si le texte contient « &#8217; », le moteur
   lit littéralement ces neuf caractères. On le vérifie. */
$entites_residuelles = array();

foreach ( $blocs_par_page as $nom => $blocs ) {
	foreach ( $blocs as $bloc ) {
		$json = wp_json_encode( $bloc );

		if ( preg_match_all( '/&(?:#8217|#039|amp|quot|lt|gt|nbsp|#8220|#8221);/', (string) $json, $m ) ) {
			$entites_residuelles[] = $nom . ' : ' . count( $m[0] ) . ' entité(s) HTML non décodée(s) — '
				. implode( ', ', array_unique( $m[0] ) );
		}
	}
}

audit_verifier(
	'le JSON-LD contient des caractères réels, pas des entités HTML',
	empty( $entites_residuelles ),
	implode( ' | ', array_slice( $entites_residuelles, 0, 5 ) ),
	'majeur',
	empty( $entites_residuelles )
		? 'Recherche d\'entités HTML dans le JSON-LD des ' . count( $blocs_par_page ) . ' pages contrôlées : aucune'
		: implode( "\n", $entites_residuelles )
);

if ( empty( $entites_residuelles ) ) {
	audit_force(
		'Le JSON-LD est lisible tel quel (les apostrophes typographiques sont des caractères, pas des entités)',
		'Aucune entité HTML dans le JSON-LD servi'
	);
}

/* ------------------------------------------------------------------ */
echo "\n7. La limite de cet audit\n";

audit_info(
	'Une donnée structurée bien écrite ne garantit pas d\'apparition dans un résultat',
	'Google et les systèmes génératifs lisent ces données, mais leur usage dépend du reste : '
	. 'la qualité du contenu, la fiabilité du site, et leurs propres algorithmes. '
	. 'Cet audit vérifie la correction et la complétude des données — pas leur effet.'
);

exit( audit_fin() );
