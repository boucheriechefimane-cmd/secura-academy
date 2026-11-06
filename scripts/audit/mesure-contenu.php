<?php
/**
 * Sonde indicative de contenu. Les marqueurs textuels sont des pistes,
 * pas des verdicts ; voir README-SONDES-ZIP.md pour les limites.
 *
 * Produit un rapport JSON avec :
 * - inventaire par room (taches, questions, langues, licence, videos, terminal)
 * - repartition des modes de questions (choice/text/action/flag/solution)
 * - questions sans indice / sans explication / sans source
 * - indices textuels d'anglais ou de sujets hors cyber
 * - tâches d'examen, sections des parcours (pas leur progression)
 *
 * Usage :
 *   wp eval-file scripts/audit/mesure-contenu.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( "A executer dans WordPress (wp eval-file).\n" );
}

$post_type = SECURA_POST_TYPE;
$posts     = get_posts( array(
	'post_type'   => $post_type,
	'post_status' => 'publish',
	'numberposts' => -1,
	'orderby'     => 'title',
	'order'       => 'ASC',
) );

$mots_hors_cyber = array(
	'calcul', 'multivariable', 'theory', 'derivative', 'integral',
	'p-set', 'pset', 'problem set', 'justif', 'justify all steps',
	'compute', 'compute the', 'evaluate', 'find the limit',
);

$rapport = array(
	'genere_le' => gmdate('Y-m-d\TH:i:s\Z'),
	'totaux'    => array(
		'rooms'             => 0,
		'parcours'          => 0,
		'questions_maison'  => 0,
		'questions_importees' => 0,
		'reserve'           => 0,
		'avec_indice'       => 0,
		'avec_explication'  => 0,
		'avec_source'       => 0,
		'questions_avec_indice_anglais' => 0,
		'questions_sans_indice_anglais' => 0,
		'indices_hors_cyber' => 0,
		'videos'            => 0,
		'terminaux'         => 0,
		'rooms_sans_video'  => 0,
		'rooms_sans_terminal' => 0,
		'rooms_sans_examen' => 0,
		'examens_chronometres' => null, // non mesuré
	),
	'modes'     => array(
		'choice' => 0, 'text' => 0, 'action' => 0, 'flag' => 0, 'solution' => 0, 'autre' => 0,
	),
	'rooms'     => array(),
	'points_a_verifier' => array(),
);

foreach ( $posts as $post ) {
	$taches   = Secura_Rooms::get_tasks( $post->ID );
	$reserve  = Secura_Rooms::reserve( $post->ID );
	$contenu  = $post->post_content;

	$r = array(
		'slug'         => $post->post_name,
		'titre'        => $post->post_title,
		'difficulte'   => Secura_Rooms::get_difficulty( $post->ID ),
		'types_tache'  => array(),
		'questions'    => array(
			'maison'   => 0,
			'importee' => 0,
			'total'    => 0,
		),
		'reserve'      => is_array( $reserve ) ? count( $reserve ) : 0,
		'indice'       => 0,
		'explication'  => 0,
		'source'       => 0,
		'indices_anglais' => 0,
		'sans_indice_anglais' => 0,
		'indices_hors_cyber' => 0,
		'video'        => (int) preg_match( '/youtube\.com|youtu\.be/', $contenu ),
		'terminal'     => (int) preg_match( '/secura-terminal/', $contenu ),
		'licence'      => (bool) preg_match( '/licen[cs]e|Creative Commons|CC BY/i', $contenu ),
		'examen'       => false,
		'examen_chronometre' => null, // non mesuré
	);

	$rapport['totaux']['rooms']++;
	if ( $r['video'] ) { $rapport['totaux']['videos']++; } else { $rapport['totaux']['rooms_sans_video']++; $rapport['points_a_verifier'][] = array('room' => $r['slug'], 'defaut' => 'Aucun marqueur vidéo dans le contenu de la leçon'); }
	if ( $r['terminal'] ) { $rapport['totaux']['terminaux']++; } else { $rapport['totaux']['rooms_sans_terminal']++; $rapport['points_a_verifier'][] = array('room' => $r['slug'], 'defaut' => 'Aucun marqueur terminal dans le contenu de la leçon'); }
	if ( ! $r['licence'] ) { $rapport['points_a_verifier'][] = array('room' => $r['slug'], 'defaut' => 'Aucune mention de licence détectée dans le contenu'); }

	foreach ( $taches as $tache ) {
		$type = isset( $tache['type'] ) ? $tache['type'] : 'practice';
		$r['types_tache'][ $type ] = isset( $r['types_tache'][ $type ] ) ? $r['types_tache'][ $type ] + 1 : 1;
		if ( 'exam' === $type ) { $r['examen'] = true; }
		$qs = isset( $tache['questions'] ) && is_array( $tache['questions'] ) ? $tache['questions'] : array();
		foreach ( $qs as $q ) {
			$r['questions']['total']++;
			$mode = isset( $q['mode'] ) ? $q['mode'] : 'autre';
			if ( isset( $rapport['modes'][ $mode ] ) ) { $rapport['modes'][ $mode ]++; } else { $rapport['modes']['autre']++; }

			$maison = empty( $q['licence'] );
			if ( $maison ) {
				$r['questions']['maison']++;
				$rapport['totaux']['questions_maison']++;
			} else {
				$r['questions']['importee']++;
				$rapport['totaux']['questions_importees']++;
			}

			if ( ! empty( $q['hint'] ) ) { $r['indice']++; $rapport['totaux']['avec_indice']++; } else { $rapport['points_a_verifier'][] = array('room' => $r['slug'], 'defaut' => 'Question sans indice : ' . mb_substr( $q['question'] ?? '', 0, 80 )); }
			if ( ! empty( $q['explanation'] ) ) { $r['explication']++; $rapport['totaux']['avec_explication']++; } else { $rapport['points_a_verifier'][] = array('room' => $r['slug'], 'defaut' => 'Question sans explication : ' . mb_substr( $q['question'] ?? '', 0, 80 )); }
			if ( ! empty( $q['source'] ) ) { $r['source']++; $rapport['totaux']['avec_source']++; }

			$texte = mb_strtolower( ( $q['question'] ?? '' ) . ' ' . ( isset( $q['choices'] ) ? implode( ' ', (array) $q['choices'] ) : '' ) . ' ' . ( $q['answer'] ?? '' ) );
			$est_anglais = (bool) preg_match( '/\b(the|and|of|to|in|a|is|for|on|with|as|proposes|suppose|wants|learn|identity|hidden|adversary|exploit|compromise|buffer|void|char|int|return|function)\b/i', $texte );
			if ( $est_anglais ) {
				$r['indices_anglais']++;
				$rapport['totaux']['questions_avec_indice_anglais']++;
			} else {
				$r['sans_indice_anglais']++;
				$rapport['totaux']['questions_sans_indice_anglais']++;
			}

			if ( (bool) preg_match( '/\b(' . implode( '|', $mots_hors_cyber ) . ')\b/i', $texte ) ) {
				$r['indices_hors_cyber']++;
				$rapport['totaux']['indices_hors_cyber']++;
				$rapport['points_a_verifier'][] = array('room' => $r['slug'], 'defaut' => 'Indice textuel à vérifier (maths/général) : ' . mb_substr( $q['question'] ?? '', 0, 80 ));
			}
		}
	}

	if ( is_array( $reserve ) ) {
		$rapport['totaux']['reserve'] += count( $reserve );
		foreach ( $reserve as $q ) {
			$mode = isset( $q['mode'] ) ? $q['mode'] : 'autre';
			if ( isset( $rapport['modes'][ $mode ] ) ) { $rapport['modes'][ $mode ]++; } else { $rapport['modes']['autre']++; }
			$texte = mb_strtolower( ( $q['question'] ?? '' ) . ' ' . ( isset( $q['choices'] ) ? implode( ' ', (array) $q['choices'] ) : '' ) . ' ' . ( $q['answer'] ?? '' ) );
			if ( (bool) preg_match( '/\b(the|and|of|to|in|a|is|for|on|with|as)\b/i', $texte ) ) {
				$r['indices_anglais']++;
				$rapport['totaux']['questions_avec_indice_anglais']++;
			} else {
				$r['sans_indice_anglais']++;
				$rapport['totaux']['questions_sans_indice_anglais']++;
			}
			if ( ! empty( $q['hint'] ) ) { $r['indice']++; $rapport['totaux']['avec_indice']++; }
			if ( ! empty( $q['explanation'] ) ) { $r['explication']++; $rapport['totaux']['avec_explication']++; }
			if ( ! empty( $q['source'] ) ) { $r['source']++; $rapport['totaux']['avec_source']++; }
			if ( empty( $q['licence'] ) ) { $rapport['points_a_verifier'][] = array('room' => $r['slug'], 'defaut' => 'Question importée sans licence en réserve'); }
		}
	}

	if ( ! $r['examen'] ) { $rapport['totaux']['rooms_sans_examen']++; }
	$rapport['rooms'][] = $r;
}

// Parcours
$parcours = get_posts( array(
	'post_type'   => SECURA_PATH_POST_TYPE,
	'post_status' => 'publish',
	'numberposts' => -1,
	'orderby'     => 'title',
	'order'       => 'ASC',
) );
$rapport['totaux']['parcours'] = count( $parcours );
foreach ( $parcours as $p ) {
	$sections = Secura_Paths::get_sections( $p->ID );
	$nb_rooms = 0;
	foreach ( $sections as $s ) { $nb_rooms += count( $s['rooms'] ); }
	$rapport['parcours_list'][] = array(
		'titre' => $p->post_title,
		'sections' => count( $sections ),
		'rooms'  => $nb_rooms,
	);
}


echo wp_json_encode( $rapport, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
