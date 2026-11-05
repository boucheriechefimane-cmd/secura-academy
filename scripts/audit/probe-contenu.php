<?php
/**
 * Sonde indicative de contenu. Voir README-SONDES-ZIP.md pour les limites.
 *
 * Ce script ne modifie rien : il lit le site tel qu'il est servi et
 * produit un inventaire JSON — rooms, parcours, taches, questions
 * maison, reserve d'examens, indices, explications, sources, vidéos,
 * terminal. C'est la matiere brute de l'audit de contenu.
 *
 * Usage :
 *   wp eval-file scripts/audit/probe-contenu.php
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

$salles = array();

foreach ( $posts as $post ) {
	$taches = Secura_Rooms::get_tasks( $post->ID );
	$reserve = Secura_Rooms::reserve( $post->ID );

	$par_type   = array();
	$maison     = 0;
	$avec_indice = 0;
	$avec_explication = 0;
	$avec_source = 0;
	$importees_dans_tache = 0;
	$questions_vues = 0;

	foreach ( $taches as $tache ) {
		$type = isset( $tache['type'] ) ? $tache['type'] : 'practice';
		$qs   = isset( $tache['questions'] ) && is_array( $tache['questions'] ) ? $tache['questions'] : array();
		$par_type[ $type ] = isset( $par_type[ $type ] ) ? $par_type[ $type ] + count( $qs ) : count( $qs );
		foreach ( $qs as $q ) {
			$questions_vues++;
			$mode = isset( $q['mode'] ) ? $q['mode'] : '';
			if ( ! empty( $q['hint'] ) ) {
				$avec_indice++;
			}
			if ( ! empty( $q['explanation'] ) ) {
				$avec_explication++;
			}
			if ( ! empty( $q['source'] ) ) {
				$avec_source++;
			}
			// Une question importee porte une licence et une attribution :
			// c'est ce qui la distingue d'une question ecrite pour la
			// plateforme.
			if ( ! empty( $q['licence'] ) ) {
				$importees_dans_tache++;
			} else {
				$maison++;
			}
		}
	}

	$contenu = $post->post_content;

	$salles[] = array(
		'id'         => $post->ID,
		'slug'       => $post->post_name,
		'titre'      => $post->post_title,
		'difficulte' => Secura_Rooms::get_difficulty( $post->ID ),
		'niveaux'    => array_keys( $par_type ),
		'questions_par_type' => $par_type,
		'questions_maison'   => $maison,
		'questions_importees_dans_tache' => $importees_dans_tache,
		'reserve'    => is_array( $reserve ) ? count( $reserve ) : 0,
		'total'      => $questions_vues,
		'avec_indice' => $avec_indice,
		'avec_explication' => $avec_explication,
		'avec_source' => $avec_source,
		'longueur_contenu' => strlen( $contenu ),
		'videos'     => (int) preg_match_all( '/youtube\.com|youtu\.be/', $contenu ),
		'terminal'   => (int) preg_match_all( '/secura-terminal/', $contenu ),
		'licence_dans_contenu' => (bool) preg_match( '/licen[cs]e|Creative Commons|CC BY/i', $contenu ),
		'resume'     => mb_substr( wp_strip_all_tags( $contenu ), 0, 300 ),
	);
}

$parcours = get_posts( array(
	'post_type'   => SECURA_PATH_POST_TYPE,
	'post_status' => 'publish',
	'numberposts' => -1,
	'orderby'     => 'title',
	'order'       => 'ASC',
) );

$liste_parcours = array();
foreach ( $parcours as $p ) {
	$rooms = array();
	foreach ( Secura_Paths::get_sections( $p->ID ) as $section ) {
		$rooms = array_merge( $rooms, $section['rooms'] );
	}
	$liste_parcours[] = array(
		'slug'  => $p->post_name,
		'titre' => $p->post_title,
		'rooms' => $rooms,
	);
}

echo wp_json_encode( array(
	'rooms'    => $salles,
	'parcours' => $liste_parcours,
), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
