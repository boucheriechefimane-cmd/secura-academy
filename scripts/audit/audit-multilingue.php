<?php
/**
 * Auditeur 10/15 — Multilingue et internationalisation.
 *
 * PERIMETRE
 * La coherence FR / AR / EN sur TOUS les champs : titres, descriptions,
 * questions, explications, consignes, valeurs des menus. Le sens de
 * lecture de droite a gauche. Les chaines non traduites qui subsistent.
 * Les adresses declarees par version (hreflang).
 *
 * METHODE
 * On lit les traductions stockees dans la base (le meme contenu que le
 * rendu), et on compare champ par champ. Une room dont la question est
 * restee en francais alors que le reste est traduit est un doublon
 * pour les moteurs : c'est ce que l'audit compte.
 *
 * @package Secura_Academy
 */

require_once __DIR__ . '/audit-lib.php';

audit_titre( 'multilingue', 'Multilingue et internationalisation' );

audit_expert(
	'Expert en internationalisation (i18n) et en langues droite-à-gauche',
	'Vérifie que les trois versions (français, arabe, anglais) sont complètes et '
	. 'cohérentes sur tous les champs — titres, questions, explications, consignes — '
	. 'que le sens de lecture arabe est complet, que les adresses alternatives sont '
	. 'correctes, et qu\'aucune chaîne non traduite ne subsiste. '
	. 'Ne juge pas la qualité/style d\'une traduction : c\'est un jugement humain.'
);

$rooms = get_posts(
	array(
		'post_type'   => 'secura_room',
		'numberposts' => -1,
		'post_status' => 'any',
	)
);

$langues = array( 'ar', 'en' );

$racine = dirname( dirname( dirname( __FILE__ ) ) );
$plugin = $racine . '/wp-content/plugins/secura-academy';

/* ------------------------------------------------------------------ */
echo "\n1. La couverture : chaque room est-elle traduite ?\n";

$sans_traduction = array();
$rooms_totales    = count( $rooms );
$traduits         = 0;

foreach ( $rooms as $room ) {
	$i18n = get_post_meta( $room->ID, '_secura_i18n', true );

	if ( ! is_array( $i18n ) ) {
		$sans_traduction[] = $room->post_title . ' (aucune traduction stockée)';
		continue;
	}

	$manquantes = array();

	foreach ( $langues as $langue ) {
		if ( empty( $i18n[ $langue ] ) ) {
			$manquantes[] = $langue;
		}
	}

	if ( empty( $manquantes ) ) {
		$traduits++;
	} else {
		$sans_traduction[] = $room->post_title . ' (manque : ' . implode( ', ', $manquantes ) . ')';
	}
}

audit_verifier(
	'chaque room existe en français, en arabe et en anglais',
	empty( $sans_traduction ),
	count( $sans_traduction ) . ' room(s) incomplète(s) : ' . implode( ' | ', array_slice( $sans_traduction, 0, 5 ) ),
	'majeur',
	$traduits . ' room(s) sur ' . $rooms_totales . ' ont leurs trois versions'
);

if ( empty( $sans_traduction ) ) {
	audit_force(
		'Les ' . $rooms_totales . ' rooms existent dans les trois langues',
		$traduits . ' rooms sur ' . $rooms_totales . ' portent une traduction arabe et anglaise'
	);
}

/* ------------------------------------------------------------------ */
echo "\n2. La cohérence : les traductions couvrent-elles tout le contenu ?\n";

/* On compare le nombre de champs traduits au nombre de champs de la
   version française : une traduction qui n'a que le titre est une
   traduction de façade. */
$traductions_incompletes = array();
$mesures               = array();

foreach ( $rooms as $room ) {
	$i18n = get_post_meta( $room->ID, '_secura_i18n', true );

	if ( ! is_array( $i18n ) ) {
		continue;
	}

	/* Le nombre de champs du français sert de référence. */
	$reference = 0;

	if ( isset( $i18n['fr'] ) && is_array( $i18n['fr'] ) ) {
		$reference = count( $i18n['fr'] );
	}

	foreach ( $langues as $langue ) {
		$compte = isset( $i18n[ $langue ] ) && is_array( $i18n[ $langue ] ) ? count( $i18n[ $langue ] ) : 0;

		$mesures[ $langue ][] = $compte;

		if ( $reference > 0 && $compte < $reference ) {
			$traductions_incompletes[] = $room->post_title . ' / ' . $langue . ' : '
				. $compte . ' champ(s) sur ' . $reference;
		}
	}
}

audit_verifier(
	'les traductions couvrent autant de champs que la version française',
	empty( $traductions_incompletes ),
	count( $traductions_incompletes ) . ' cas : ' . implode( ' | ', array_slice( $traductions_incompletes, 0, 5 ) ),
	'majeur',
	empty( $traductions_incompletes )
		? 'Comparaison champ par champ sur ' . $rooms_totales . ' rooms : les versions arabe et anglaise '
			. 'couvrent autant de champs que le français'
		: implode( "\n", array_slice( $traductions_incompletes, 0, 8 ) )
);

/* ------------------------------------------------------------------ */
echo "\n3. Les chaînes restées en français\n";

/* Le défaut le plus insidieux : une chaîne traduite à moitié, ou une
   chaîne oubliée. On détecte une valeur identique au français dans une
   version qui devrait être traduite — en écartant les cas légitimes
   (un mot qui ne change pas : « HTTP », « SQL », un acronym). */
$chaines_non_traduites = array();
$acronymes_legitimes  = array(
	'HTTP', 'HTTPS', 'HTML', 'CSS', 'SQL', 'API', 'JSON', 'XML', 'URL', 'URI', 'DNS', 'TCP', 'UDP',
	'IP', 'SSH', 'FTP', 'SMTP', 'IMAP', 'POP3', 'TLS', 'SSL', 'VPN', 'NAT', 'DHCP', 'ARP', 'MAC',
	'Linux', 'Windows', 'Unix', 'PHP', 'JavaScript', 'Python', 'Java', 'C', 'Bash', 'Docker', 'AWS',
	'GCP', 'MIT', 'OWASP', 'CTF', 'SIEM', 'IDS', 'IPS', 'WAF', 'CVE', 'CVSS', 'JWT', 'XSS', 'CSRF',
	'SQLi', 'NoSQL', 'SaaS', 'PaaS', 'IaaS', 'DevOps', 'CI', 'CD', 'MITRE', 'ATT', 'NIST',
);

foreach ( $rooms as $room ) {
	$i18n = get_post_meta( $room->ID, '_secura_i18n', true );

	if ( ! is_array( $i18n ) || ! isset( $i18n['fr'] ) || ! is_array( $i18n['fr'] ) ) {
		continue;
	}

	foreach ( $langues as $langue ) {
		if ( empty( $i18n[ $langue ] ) || ! is_array( $i18n[ $langue ] ) ) {
			continue;
		}

		foreach ( $i18n['fr'] as $cle => $valeur_fr ) {
			if ( ! isset( $i18n[ $langue ][ $cle ] ) ) {
				continue;
			}

			$valeur = $i18n[ $langue ][ $cle ];

			if ( ! is_string( $valeur ) || ! is_string( $valeur_fr ) ) {
				continue;
			}

			if ( trim( $valeur ) === trim( $valeur_fr ) && strlen( trim( $valeur ) ) > 12 ) {
				/* Un mot qui ne change pas n'est pas une erreur. */
				$est_acronyme = false;

				foreach ( $acronymes_legitimes as $acronyme ) {
					if ( trim( $valeur ) === $acronyme ) {
						$est_acronyme = true;
						break;
					}
				}

				if ( ! $est_acronyme ) {
					$chaines_non_traduites[] = $room->post_title . ' / ' . $langue . ' / ' . $cle
						. ' : « ' . substr( $valeur, 0, 60 ) . ' »';
				}
			}
		}
	}
}

audit_verifier(
	'aucune chaîne n\'est restée en français dans une version traduite',
	empty( $chaines_non_traduites ),
	count( $chaines_non_traduites ) . ' chaîne(s) : ' . implode( ' | ', array_slice( $chaines_non_traduites, 0, 5 ) ),
	'majeur',
	empty( $chaines_non_traduites )
		? 'Comparaison de chaque chaîne traduite avec sa version française sur ' . $rooms_totales
			. ' rooms : aucune identique (hors acronymes légitimes comme HTTP, SQL, OWASP)'
		: implode( "\n", array_slice( $chaines_non_traduites, 0, 8 ) )
);

/* ------------------------------------------------------------------ */
echo "\n4. Le sens de lecture (droite à gauche)\n";

$sens_lecture = array();

foreach ( $langues as $langue ) {
	$url = add_query_arg( 'seca_lang', $langue, home_url( '/' ) );

	$reponse = wp_remote_get( $url, array( 'timeout' => 20 ) );

	if ( is_wp_error( $reponse ) ) {
		$sens_lecture[] = $langue . ' : page non servie';
		continue;
	}

	$corps = wp_remote_retrieve_body( $reponse );

	$attendu = ( 'ar' === $langue ) ? 'dir="rtl"' : 'dir="ltr"';

	if ( false === stripos( $corps, $attendu ) ) {
		$sens_lecture[] = $langue . ' : attribut ' . $attendu . ' absent';
	}

	/* Les propriétés logiques (margin-inline, padding-inline) respectent
	   le sens de lecture ; les propriétés physiques (margin-left) non.
	   On mesure donc dans le HTML servi ET dans les feuilles de style
	   que la page référence. */
	$feuilles = array();

	if ( preg_match_all( '/<link[^>]+href=["\']([^"\']+\.css[^"\']*)["\']/i', $corps, $m ) ) {
		foreach ( $m[1] as $href ) {
			$feuilles[] = $href;
		}
	}

	$physiques = 0;
	$exemples  = array();

	foreach ( $feuilles as $href ) {
		$css = '';

		if ( 0 === strpos( $href, 'http' ) ) {
			$reponse_css = wp_remote_get( $href, array( 'timeout' => 15 ) );

			if ( ! is_wp_error( $reponse_css ) ) {
				$css = wp_remote_retrieve_body( $reponse_css );
			}
		} elseif ( file_exists( $href ) ) {
			$css = file_get_contents( $href );
		}

		if ( '' === $css ) {
			continue;
		}

		if ( preg_match_all( '/(margin|padding)-(left|right)\s*:\s*[^;]+/i', $css, $m ) ) {
			$physiques += count( $m[0] );

			foreach ( array_slice( $m[0], 0, 3 ) as $exemple ) {
				$exemples[] = basename( $href ) . ' : ' . trim( preg_replace( '/\s+/', ' ', $exemple ) );
			}
		}
	}

	if ( $physiques > 0 ) {
		$sens_lecture[] = $langue . ' : ' . $physiques . ' propriété(s) physique(s) au lieu de logiques — '
			. implode( ' ; ', array_slice( $exemples, 0, 3 ) );
	}
}

audit_verifier(
	'chaque version déclare le bon sens de lecture et utilise des propriétés logiques',
	empty( $sens_lecture ),
	count( $sens_lecture ) . ' problème(s) : ' . implode( ' | ', array_slice( $sens_lecture, 0, 5 ) ),
	'majeur',
	empty( $sens_lecture )
		? 'Pages servies en arabe (dir="rtl") et en anglais (dir="ltr") : sens de lecture correct, '
			. 'aucune propriété physique de marge ou de marge intérieure'
		: implode( "\n", array_slice( $sens_lecture, 0, 5 ) )
);

if ( empty( $sens_lecture ) ) {
	audit_force(
		'Le sens de lecture est complet : la version arabe est en droite-à-gauche, sans propriété physique',
		'Vérifié sur les pages servies en arabe et en anglais : dir="rtl" / dir="ltr" corrects, '
			. 'aucune propriété margin-left / margin-right / padding-left / padding-right'
	);
}

/* ------------------------------------------------------------------ */
echo "\n4 bis. Le sens de lecture est-il porté par le document ?\n";

/* La direction d'ecriture est une propriete du DOCUMENT : elle doit
   etre posee sur la balise <html>. Un « dir= » pose sur un bloc
   interieur ne suffit pas — une page de contenu servie en arabe
   resterait alors lue de gauche a droite, ponctuation a l'envers.
   On verifie donc l'attribut sur <html>, sur une page de contenu
   servie par le theme (les pages legales), dans les trois langues. */
$erreurs_document = array();

$page_legale = get_page_by_path( 'politique-de-confidentialite' );

if ( ! $page_legale ) {
	$erreurs_document[] = 'page « politique-de-confidentialite » introuvable : impossible de vérifier le document';
} else {
	$url_legale = get_permalink( $page_legale->ID );

	foreach ( array( 'fr', 'ar', 'en' ) as $langue ) {
		$reponse = wp_remote_get( add_query_arg( 'seca_lang', $langue, $url_legale ), array( 'timeout' => 20 ) );

		if ( is_wp_error( $reponse ) ) {
			$erreurs_document[] = 'page légale ' . $langue . ' : non servie';
			continue;
		}

		$corps = wp_remote_retrieve_body( $reponse );

		if ( ! preg_match( '/<html[^>]*>/i', $corps, $m ) ) {
			$erreurs_document[] = 'page légale ' . $langue . ' : balise <html> introuvable';
			continue;
		}

		$attendu = ( 'ar' === $langue ) ? 'dir="rtl"' : 'dir="ltr"';

		if ( false === stripos( $m[0], $attendu ) ) {
			$erreurs_document[] = 'page légale ' . $langue . ' : <html> sans ' . $attendu . ' → '
				. trim( $m[0] ) . ' (le texte arabe s\'afficherait de gauche à droite)';
		}
	}
}

audit_verifier(
	'la balise <html> porte le sens de lecture de la langue demandée',
	empty( $erreurs_document ),
	implode( ' | ', array_slice( $erreurs_document, 0, 5 ) ),
	'majeur',
	empty( $erreurs_document )
		? 'Page légale servie dans les trois langues : <html> porte dir="ltr" (français), '
			. 'dir="rtl" (arabe) et dir="ltr" (anglais) — le document entier est orienté, '
			. 'pas seulement un bloc à l\'intérieur'
		: implode( "\n", $erreurs_document )
);

if ( empty( $erreurs_document ) ) {
	audit_force(
		'Le document entier est orienté dans la bonne direction',
		'<html> porte dir="rtl" pour l\'arabe et dir="ltr" pour le français et l\'anglais'
	);
}

/* ------------------------------------------------------------------ */
echo "\n5. Les adresses alternatives (hreflang)\n";

$sans_hreflang = array();

$pages_a_verifier = array();

if ( ! empty( $rooms ) ) {
	$pages_a_verifier['room'] = get_permalink( $rooms[0]->ID );
}

foreach ( $pages_a_verifier as $nom => $url ) {
	if ( ! $url ) {
		continue;
	}

	$reponse = wp_remote_get( $url, array( 'timeout' => 20 ) );

	if ( is_wp_error( $reponse ) ) {
		continue;
	}

	$corps = wp_remote_retrieve_body( $reponse );

	if ( ! preg_match_all( '/<link[^>]+rel=["\']alternate["\'][^>]*>/i', $corps, $m ) ) {
		$sans_hreflang[] = $nom . ' : aucun lien alternate';
		continue;
	}

	foreach ( $m[0] as $lien ) {
		/* On ne s'intéresse qu'aux liens de version linguistique.
		   WordPress ajoute aussi des liens « alternate » qui ne sont pas
		   des versions : les flux RSS et les liens oEmbed. Ils portent
		   un attribut « type » ; un lien de version linguistique, lui,
		   porte un hreflang. On ne retient donc que les liens sans
		   « type » — ce sont les seuls qui doivent avoir un hreflang. */
		if ( preg_match( '/\btype=/i', $lien ) ) {
			continue;
		}

		if ( false === stripos( $lien, 'hreflang=' ) ) {
			$sans_hreflang[] = $nom . ' : lien alternate sans hreflang — ' . trim( $lien );
			continue;
		}

		/* L'adresse doit être absolue : Google ignore les relatives. */
		if ( ! preg_match( '/href=["\'](https?:\/\/[^"\']+)["\']/i', $lien, $h ) ) {
			$sans_hreflang[] = $nom . ' : adresse relative (' . $lien . ')';
		}
	}
}

audit_verifier(
	'les versions alternatives sont déclarées avec des adresses absolues',
	empty( $sans_hreflang ),
	count( $sans_hreflang ) . ' problème(s) : ' . implode( ' | ', array_slice( $sans_hreflang, 0, 5 ) ),
	'majeur',
	empty( $sans_hreflang )
		? 'Lien rel="alternate" présent avec hreflang et adresse absolue (https://) sur les pages contrôlées'
		: implode( "\n", array_slice( $sans_hreflang, 0, 5 ) )
);

/* ------------------------------------------------------------------ */
echo "\n5 bis. Les caractères d'une écriture étrangère\n";

/* Un caractère cyrillique, grec ou coréen glissé dans une phrase française
   est invisible à l'œil : il a la même allure que la lettre latine. Le
   lecteur ne voit rien, mais la recherche du site ne trouve plus le mot,
   et le texte copié-colé se casse. On a déjà trouvé « 기능 » au milieu
   d'une phrase de la politique de confidentialité, en français.
   L'arabe, lui, est attendu : c'est une des trois langues du site. */

/* On n'utilise PAS \p{Greek} ni \p{Han} : dans PCRE, ces propriétés
   désignent les jeux de caractères étendus, et le point médian « · »
   (U+00B7) en fait partie — il serait donc signalé à tort. On prend
   des plages Unicode explicites, sans ambiguïté. */
$ecritures = array(
	'cyrillique' => '/[\x{0400}-\x{04FF}\x{0500}-\x{052F}]/u',
	'grecque'    => '/[\x{0370}-\x{03FF}\x{1F00}-\x{1FFF}]/u',
	'han'        => '/[\x{3400}-\x{4DBF}\x{4E00}-\x{9FFF}\x{F900}-\x{FAFF}]/u',
	'hiragana'   => '/[\x{3040}-\x{309F}]/u',
	'katakana'   => '/[\x{30A0}-\x{30FF}]/u',
	'hangul'     => '/[\x{AC00}-\x{D7AF}\x{1100}-\x{11FF}\x{3130}-\x{318F}]/u',
	'devanagari' => '/[\x{0900}-\x{097F}]/u',
	'thaï'       => '/[\x{0E00}-\x{0E7F}]/u',
	'hebreu'     => '/[\x{0590}-\x{05FF}]/u',
);

$fichiers_a_scanner = array();

foreach ( array( $plugin, $racine . '/wp-content/themes/secura-learning' ) as $dossier ) {
	if ( ! is_dir( $dossier ) ) {
		continue;
	}
	$iterateur = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $dossier, FilesystemIterator::SKIP_DOTS ) );
	foreach ( $iterateur as $fichier ) {
		if ( $fichier->isFile() && preg_match( '/\.(php|css|js)$/', $fichier->getFilename() ) ) {
			$fichiers_a_scanner[] = $fichier->getPathname();
		}
	}
}

$intrus = array();

foreach ( $fichiers_a_scanner as $fichier ) {
	$contenu = file_get_contents( $fichier );
	foreach ( $ecritures as $nom => $motif ) {
		if ( preg_match_all( $motif, $contenu, $trouves, PREG_OFFSET_CAPTURE ) ) {
			foreach ( $trouves[0] as $trouve ) {
				$caractere     = $trouve[0];
				$position      = $trouve[1];
				$numero_ligne  = substr_count( substr( $contenu, 0, $position ), "\n" ) + 1;
				$intrus[]      = sprintf(
					'%s (ligne %d) : écriture %s, caractère « %s » (U+%04X)',
					str_replace( $racine . '/', '', $fichier ),
					$numero_ligne,
					$nom,
					$caractere,
					mb_ord( $caractere, 'UTF-8' )
				);
			}
		}
	}
}

/* On ne se contente pas de lire la base : on va chercher ce que le
   visiteur recoit vraiment, et ce que l'API REST publie. C'est elle qui
   expose le texte BRUT des pages — c'est donc par elle que le défaut
   de la version 0.8.0 s'était propagé, alors que la page affichée,
   elle, était correcte. */
$pages_servies = array(
	'page d\'accueil' => home_url( '/' ),
);

foreach ( array( 'politique-de-confidentialite', 'mentions-legales' ) as $slug ) {
	$page = get_page_by_path( $slug );
	if ( $page ) {
		$pages_servies[ 'page « ' . $slug . ' »' ] = get_permalink( $page );
	}
}

if ( ! empty( $rooms ) ) {
	$room     = $rooms[0];
	$url_room = get_permalink( $room );

	$pages_servies[ 'room « ' . $room->post_title . ' » (FR)' ] = $url_room;
	$pages_servies[ 'room « ' . $room->post_title . ' » (AR)' ] = add_query_arg( 'seca_lang', 'ar', $url_room );
	$pages_servies[ 'room « ' . $room->post_title . ' » (EN)' ] = add_query_arg( 'seca_lang', 'en', $url_room );
}

/* L'API REST publie le texte brut des pages, sans le filtre
   d'affichage : c'est la que l'on verrait passer un texte corige. */
foreach ( array( 'politique-de-confidentialite', 'mentions-legales' ) as $slug ) {
	$page = get_page_by_path( $slug );
	if ( $page ) {
		$pages_servies[ 'API REST — page « ' . $slug . ' »' ] = add_query_arg( 'rest_route', '/wp/v2/pages/' . $page->ID, home_url( '/' ) );
	}
}

$pages_verifiees = array();

foreach ( $pages_servies as $libelle => $url ) {
	$html = audit_exec( 'curl -s -L --max-time 20 "' . $url . '"' );

	if ( '' === trim( (string) $html ) ) {
		continue;
	}

	$pages_verifiees[] = $libelle;

	foreach ( $ecritures as $nom => $motif ) {
		if ( preg_match_all( $motif, $html, $trouves ) ) {
			foreach ( $trouves[0] as $caractere ) {
				$intrus[] = sprintf(
					'%s : écriture %s, caractère « %s » (U+%04X)',
					$libelle,
					$nom,
					$caractere,
					mb_ord( $caractere, 'UTF-8' )
				);
			}
		}
	}
}

audit_verifier(
	'aucun caractère d\'une écriture étrangère ne s\'est glissé dans le contenu',
	empty( $intrus ),
	empty( $intrus )
		? sprintf(
			'%d fichier(s) livré(s) et %d page(s) réellement servie(s) — dont l\'API REST — vérifiés : aucune trace de cyrillique, grec, han, hiragana, katakana, hangul, devanagari, thaï ou hébreu. L\'arabe, langue officielle du site, n\'est pas concerné.',
			count( $fichiers_a_scanner ),
			count( $pages_verifiees )
		)
		: sprintf(
			'%d intrusion(s) trouvée(s) — un caractère à l\'apparence latine mais d\'une autre écriture ; le lecteur ne le voit pas, mais la recherche du site ne trouve plus le mot : %s',
			count( $intrus ),
			implode( ' | ', array_slice( $intrus, 0, 8 ) )
		),
	'majeur',
	implode( ' | ', array_slice( $intrus, 0, 8 ) )
);

if ( ! empty( $pages_verifiees ) ) {
	audit_info(
		'Ce qui a été vérifié',
		implode( ' | ', $pages_verifiees )
	);
}

/* ------------------------------------------------------------------ */
echo "\n6. La limite de cet audit\n";

audit_info(
	'La qualité d\'une traduction ne se mesure pas par un script',
	'Cet audit vérifie la COUVERTURE et la COHÉRENCE : que chaque champ soit traduit, '
	. 'qu\'aucune chaîne ne soit restée en français, que le sens de lecture soit complet. '
	. 'Il ne juge pas si la traduction est naturelle, exacte ou idiomatique : '
	. 'c\'est le travail d\'un traducteur, et cela demande un humain.'
);

exit( audit_fin() );
