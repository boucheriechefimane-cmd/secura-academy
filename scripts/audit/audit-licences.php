<?php
/**
 * Auditeur 14/15 — Licences, attribution et reutilisation.
 *
 * PERIMETRE
 * Ce que la plateforme reprend d'ailleurs, sous quelle licence, avec quelle
 * attribution, et si les conditions sont respectees : usage non commercial,
 * partage dans les memes conditions, mention de l'auteur.
 *
 * METHODE
 * On s'appuie sur les metadonnees reelles (_secura_video : institution,
 * licence), sur le texte des rooms, et sur le registre documentaire
 * docs/SOURCES-CONTENU.md. Chaque controle cite une piece.
 *
 * @package Secura_Academy
 */

require_once __DIR__ . '/audit-lib.php';

audit_titre( 'licences', 'Licences, attribution et réutilisation' );

audit_expert(
	'Expert en licences de contenu, en droits de réutilisation et en attribution',
	'Vérifie que chaque contenu emprunté porte une licence identifiée et datée, que '
	. 'l\'attribution est visible par l\'élève, que les conditions (usage non commercial, '
	. 'partage dans les mêmes conditions) sont respectées et énoncées, et que le registre '
	. 'des sources est tenu à jour. '
	. 'Ne tranche pas les cas litigieux : cela se décide au cas par cas.'
);

$racine = dirname( dirname( dirname( __FILE__ ) ) );
$plugin = $racine . '/wp-content/plugins/secura-academy';
$registre_fichier = $racine . '/docs/SOURCES-CONTENU.md';

$rooms = get_posts( array( 'post_type' => 'secura_room', 'numberposts' => -1, 'post_status' => 'any' ) );

/* ------------------------------------------------------------------ */
echo "\n1. Les vidéos empruntées : licence et institution déclarées\n";

$avec_video = 0;
$sans_licence = array();
$licences = array();
$institutions = array();

foreach ( $rooms as $room ) {
	$video = get_post_meta( $room->ID, '_secura_video', true );

	if ( ! is_array( $video ) || empty( $video ) ) {
		continue;
	}

	$avec_video++;

	if ( empty( $video['license'] ) ) {
		$sans_licence[] = $room->post_title;
	} else {
		$licence = (string) $video['license'];
		$licences[ $licence ] = ( isset( $licences[ $licence ] ) ? $licences[ $licence ] : 0 ) + 1;
	}

	if ( ! empty( $video['institution'] ) ) {
		$institutions[ $video['institution'] ] = ( isset( $institutions[ $video['institution'] ] ) ? $institutions[ $video['institution'] ] : 0 ) + 1;
	} else {
		$sans_licence[] = $room->post_title . ' (institution absente)';
	}
}

audit_verifier(
	'chaque vidéo empruntée déclare sa licence et son institution',
	empty( $sans_licence ),
	count( $sans_licence ) . ' cas : ' . implode( ' | ', array_slice( $sans_licence, 0, 5 ) ),
	'bloquant',
	$avec_video . ' room(s) sur ' . count( $rooms ) . ' portent une vidéo, toutes avec licence et institution'
);

audit_info(
	'Licences déclarées sur les vidéos',
	empty( $licences ) ? 'Aucune' : implode( ' | ', array_map(
		function ( $lic, $n ) {
			return $lic . ' (' . $n . ')';
		},
		array_keys( $licences ),
		array_values( $licences )
	) )
);

audit_info(
	'Institutions citées',
	empty( $institutions ) ? 'Aucune' : implode( ' | ', array_map(
		function ( $ins, $n ) {
			return $ins . ' (' . $n . ')';
		},
		array_keys( $institutions ),
		array_values( $institutions )
	) )
);

if ( ! empty( $licences ) ) {
	audit_force(
		'Chaque vidéo empruntée porte une licence et une institution',
		$avec_video . ' vidéos, ' . count( $licences ) . ' licence(s) distincte(s) : ' . implode( ' | ', array_keys( $licences ) )
	);
}

/* ------------------------------------------------------------------ */
echo "\n2. L'attribution est-elle visible par l'élève ?\n";

/* Une attribution qui existe dans la base mais pas à l'écran ne
   respecte pas la licence : l'affichage EST la condition. */
$sans_attribution_ecran = array();
$avec_attribution_ecran = 0;

foreach ( $rooms as $room ) {
	$video = get_post_meta( $room->ID, '_secura_video', true );

	if ( ! is_array( $video ) || empty( $video ) ) {
		continue;
	}

	$reponse = wp_remote_get( get_permalink( $room->ID ), array( 'timeout' => 15 ) );

	if ( is_wp_error( $reponse ) ) {
		continue;
	}

	$visible = wp_strip_all_tags( wp_remote_retrieve_body( $reponse ) );

	$trouve = false;

	foreach ( array( 'institution', 'channel', 'license', 'title' ) as $cle ) {
		if ( empty( $video[ $cle ] ) ) {
			continue;
		}

		$valeur = trim( (string) $video[ $cle ] );

		if ( '' !== $valeur && false !== stripos( $visible, $valeur ) ) {
			$trouve = true;
			break;
		}
	}

	if ( $trouve ) {
		$avec_attribution_ecran++;
	} else {
		$sans_attribution_ecran[] = $room->post_title;
	}
}

audit_verifier(
	'l\'attribution est affichée à l\'élève, pas seulement stockée',
	empty( $sans_attribution_ecran ),
	count( $sans_attribution_ecran ) . ' room(s) sans attribution visible : ' . implode( ' | ', array_slice( $sans_attribution_ecran, 0, 5 ) ),
	'bloquant',
	$avec_attribution_ecran . ' room(s) sur ' . $avec_video
		. ' affichent l\'institution, la licence et le titre de la vidéo dans le HTML servi'
);

/* ------------------------------------------------------------------ */
echo "\n3. Les textes citent-ils leur source ?\n";

/* Les rooms inspirees d'un coursiversity citent la source dans leur
   texte (« d'apres pwn.college », « MIT OCW »…). On verifie que la
   citation est bien la, pour pouvoir tracer une reutilisation. */
$marqueurs = array( 'pwn.college', 'MIT', 'Stanford', 'OWASP', 'cyber.org', 'NIST', 'RFC' );

$cites = 0;
$sans_citation = array();

foreach ( $rooms as $room ) {
	$meta = get_post_meta( $room->ID, '_secura_tasks', true );
	$texte = '';

	if ( is_array( $meta ) ) {
		foreach ( $meta as $tache ) {
			if ( isset( $tache['content'] ) ) {
				$texte .= ' ' . (string) $tache['content'];
			}

			if ( isset( $tache['title'] ) ) {
				$texte .= ' ' . (string) $tache['title'];
			}
		}
	}

	$texte .= ' ' . $room->post_title;

	$trouve = false;

	foreach ( $marqueurs as $marqueur ) {
		if ( false !== stripos( $texte, $marqueur ) ) {
			$trouve = true;
			break;
		}
	}

	if ( $trouve ) {
		$cites++;
	} else {
		$sans_citation[] = $room->post_title;
	}
}

audit_info(
	'Rooms citant une source externe dans leur texte',
	$cites . ' sur ' . count( $rooms ) . ( empty( $sans_citation )
		? ' — toutes les rooms citent leur source'
		: ' — sans citation : ' . implode( ' | ', array_slice( $sans_citation, 0, 6 ) ) )
);

/* ------------------------------------------------------------------ */
echo "\n4. Le registre des sources est-il tenu ?\n";

/* Sans registre tenu a jour, on ne peut pas prouver la conformite. */
$registre_pret = false;
$preuves_registre = array();

if ( file_exists( $registre_fichier ) ) {
	$contenu = file_get_contents( $registre_fichier );

	$licences_verifiees = preg_match_all( '/^\|.*(CC BY|MIT|CC0|BSD)/m', $contenu );
	$sections           = preg_match_all( '/^## /m', $contenu );
	$date_verif         = preg_match( '/vérifi/i', $contenu );

	$registre_pret = ( $licences_verifiees > 0 && $sections > 5 );

	$preuves_registre = array(
		'fichier' => 'docs/SOURCES-CONTENU.md',
		'sections' => $sections,
		'licences' => $licences_verifiees,
		'date de vérification' => ( $date_verif ? 'oui' : 'non' ),
	);
}

audit_verifier(
	'il existe un registre des sources, avec licences vérifiées et dates',
	$registre_pret,
	$registre_pret ? '' : 'Registre des sources absent ou incomplet : impossible de prouver '
		. 'la conformité d\'une réutilisation en cas de question.',
	'majeur',
	$registre_pret
		? 'docs/SOURCES-CONTENU.md — ' . $preuves_registre['sections'] . ' sections, '
			. $preuves_registre['licences'] . ' licence(s) vérifiée(s), mention de la date de vérification : '
			. $preuves_registre['date de vérification']
		: 'Fichier docs/SOURCES-CONTENU.md introuvable ou sans licence vérifiée'
);

if ( $registre_pret ) {
	audit_force(
		'Le registre des sources existe, est structuré et mentionne les dates de vérification',
		'docs/SOURCES-CONTENU.md — ' . $preuves_registre['sections'] . ' sections, '
			. $preuves_registre['licences'] . ' licence(s) vérifiée(s)'
	);
}

/* ------------------------------------------------------------------ */
echo "\n5. Les conditions non commerciales sont-elles énoncées ?\n";

/* La regle du projet : la plateforme est gratuite et non commerciale.
   Les sources NC sont donc compatibles, a condition de le dire. */
$mentions_nc = false;
$preuves_nc = array();

if ( is_dir( $plugin . '/includes' ) ) {
	foreach ( glob( $plugin . '/includes/*.php' ) as $fichier ) {
		$contenu = file_get_contents( $fichier );

		if ( preg_match( '/(non commercial|non-commercial|SameShare|ShareAlike|partage dans les memes)/i', $contenu ) ) {
			$mentions_nc = true;
			$preuves_nc[] = basename( $fichier );
		}
	}
}

audit_verifier(
	'les conditions de réutilisation (non commercial, partage à l\'identique) sont énoncées',
	$mentions_nc,
	$mentions_nc ? '' : 'Aucune mention des conditions de réutilisation : ni l\'élève ni '
		. 'l\'enseignant ne savent ce qu\'ils peuvent faire du contenu.',
	'mineur',
	$mentions_nc
		? 'Conditions énoncées dans : ' . implode( ', ', array_unique( $preuves_nc ) )
		: 'Recherche des mentions « non commercial / SameShare / ShareAlike » dans le plugin : aucune occurrence'
);

/* ------------------------------------------------------------------ */
echo "\n6. L'usage commercial : le site peut-il devenir payant ?\n";

/* Question posee par le proprietaire : « si la source n'a pas de licence
   de diffusion gratuite, peut-on la prendre quand meme en changeant
   l'ordre ou les chiffres ? » Non : une transformation d'un contenu
   protege reste un contenu protege. Et surtout : les sources currently
   importees sont sous licence « NC » (non commerciale) — le site peut
   donc rester gratuit, mais pas devenir payant avec ce contenu. */

$catalogue_fichier = $racine . '/tools/sources-autorisees.json';
$incoherences = array();
$n_commercial = 0;
$n_non_commercial = 0;
$detail_licences = array();

if ( file_exists( $catalogue_fichier ) ) {
	$catalogue = json_decode( file_get_contents( $catalogue_fichier ), true );

	foreach ( (array) ( $catalogue['sources'] ?? array() ) as $source ) {
		$licence = (string) ( $source['licence'] ?? '' );
		$est_nc = ( false !== strpos( strtoupper( $licence ), 'NC' ) );
		$reutilisable = ! empty( $source['reutilisable'] );

		if ( ! array_key_exists( 'commercial', $source ) ) {
			$incoherences[] = ( $source['id'] ?? '?' ) . ' : le catalogue ne dit pas si la licence autorise un usage commercial';
			continue;
		}

		$attendu = $reutilisable && ! $est_nc;

		if ( (bool) $source['commercial'] !== $attendu ) {
			$incoherences[] = ( $source['id'] ?? '?' ) . ' : commercial=' . ( $source['commercial'] ? 'oui' : 'non' )
				. ' alors que la licence est « ' . $licence . ' »';
		}

		if ( $source['commercial'] ) {
			$n_commercial++;
		} else {
			$n_non_commercial++;
		}

		$detail_licences[] = ( $source['id'] ?? '?' ) . ' — ' . $licence
			. ' — ' . ( $source['commercial'] ? 'utilisable dans un service payant' : 'usage non commercial' );
	}
}

audit_verifier(
	'le catalogue des sources dit, pour chacune, si sa licence autorise un usage commercial',
	empty( $incoherences ),
	$incoherences ? implode( ' | ', $incoherences ) : '',
	'mineur',
	$detail_licences ? implode( ' ; ', $detail_licences ) : ''
);

$fichiers_import = glob( $plugin . '/includes/content-import-*.php' );
$sans_mention = array();

foreach ( (array) $fichiers_import as $fichier ) {
	$contenu = (string) file_get_contents( $fichier );

	if ( false === strpos( $contenu, 'Usage commercial' ) ) {
		$sans_mention[] = basename( $fichier );
	}
}

audit_verifier(
	'chaque fichier de questions importé dit si sa licence autorise un usage payant',
	empty( $sans_mention ),
	$sans_mention ? implode( ', ', $sans_mention ) : '',
	'mineur',
	sprintf(
		'%d fichier(s) importé(s) contrôlé(s) ; %d source(s) utilisables dans un service payant, %d en usage non commercial uniquement.',
		count( (array) $fichiers_import ),
		$n_commercial,
		$n_non_commercial
	)
);

audit_info(
	'Ce que dit la règle : réordonner ne donne pas une licence',
	'Réordonner les questions, les renuméroter ou les reformuler ne rend pas un contenu '
		. 'protégé réutilisable : la licence d\'origine continue de s\'appliquer, et les '
		. 'conditions du site d\'origine aussi. C\'est vérifié par un test automatique '
		. '(tests/import-test.py) : le même lot réordonné et renuméroté est refusé. '
		. 'Pour un service payant, deux portes s\'ouvrent : obtenir une autorisation écrite '
		. 'de l\'éditeur, ou n\'utiliser que des sources libres compatibles avec un usage '
		. 'commercial (licences sans « NC », ou domaine public).'
);

/* ------------------------------------------------------------------ */
echo "\n7. La limite de cet audit\n";

audit_info(
	'Un audit ne remplace pas la lecture des licences',
	'Cet audit vérifie que les licences sont identifiées, que les attributions sont '
	. 'visibles à l\'écran, que les conditions non commerciales sont énoncées et que le '
	. 'registre existe. Il ne peut pas vérifier qu\'un contenu a été réécrit plutôt que '
	. 'copié, ni statuer sur une réutilisation litigieuse : cela se décide au cas par cas, '
	. 'en relisant la licence d\'origine.'
);

exit( audit_fin() );
