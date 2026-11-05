<?php
/**
 * Exporte une room vers un fichier de travail JSON, pour traduction.
 *
 * Le fichier contient le français d'origine (référence) et les emplacements
 * anglais à remplir. Les traductions existantes ne sont JAMAIS écrasées par
 * l'export : elles sont recopiées dans le fichier pour servir de relecture.
 *
 * Usage :
 *   wp eval-file tools/traduction/exporter.php <identifiant-de-room> [dossier]
 */

if ( ! isset( $args[0] ) ) {
	echo "Usage : wp eval-file tools/traduction/exporter.php <room-id> [dossier]\n";
	exit( 1 );
}

$room_id = (int) $args[0];
$dossier = isset( $args[1] ) ? rtrim( $args[1], '/' ) : '/tmp/traduction';

$room = get_post( $room_id );

if ( ! $room || 'secura_room' !== $room->post_type ) {
	echo "Room introuvable.\n";
	exit( 1 );
}

$taches  = get_post_meta( $room_id, SECURA_META_TASKS, true );
$i18n    = get_post_meta( $room_id, SECURA_META_I18N, true );
$anglais = isset( $i18n['en'] ) ? $i18n['en'] : array();

$sortie = array(
	'room_id'    => $room_id,
	'clé'        => get_post_meta( $room_id, '_secura_key', true ),
	'fr'         => array(
		'title'   => $room->post_title,
		'excerpt' => $room->post_excerpt,
		'tasks'   => array(),
	),
	'en'         => array(
		'title'   => isset( $anglais['title'] ) ? $anglais['title'] : '',
		'excerpt' => isset( $anglais['excerpt'] ) ? $anglais['excerpt'] : '',
		'tasks'   => array(),
	),
	'instructions' => array(
		'Ne traduis que le bloc « en » : le bloc « fr » est la référence, il ne change pas.',
		'Garde les codes, chemins, commandes, noms de drapeaux (SECURA{...}) tels quels.',
		'Le ton est celui d\'un formateur : direct, concret, sans emphase commerciale.',
		'Chaque champ doit être traduit, y compris les indices et les explications.',
	),
);

foreach ( (array) $taches as $i => $tache ) {
	$fr_t = array(
		'title'       => isset( $tache['title'] ) ? $tache['title'] : '',
		'content'     => isset( $tache['content'] ) ? $tache['content'] : '',
		'questions'   => array(),
	);

	$en_t = array(
		'title'     => isset( $anglais['tasks'][ $i ]['title'] ) ? $anglais['tasks'][ $i ]['title'] : '',
		'content'   => isset( $anglais['tasks'][ $i ]['content'] ) ? $anglais['tasks'][ $i ]['content'] : '',
		'questions' => array(),
	);

	foreach ( (array) ( isset( $tache['questions'] ) ? $tache['questions'] : array() ) as $j => $q ) {
		$fr_t['questions'][] = array(
			'question'    => isset( $q['question'] ) ? $q['question'] : '',
			'hint'        => isset( $q['hint'] ) ? $q['hint'] : '',
			'explanation' => isset( $q['explanation'] ) ? $q['explanation'] : '',
		);

		$en_q = isset( $anglais['tasks'][ $i ]['questions'][ $j ] ) ? $anglais['tasks'][ $i ]['questions'][ $j ] : array();

		$en_t['questions'][] = array(
			'question'    => isset( $en_q['question'] ) ? $en_q['question'] : '',
			'hint'        => isset( $en_q['hint'] ) ? $en_q['hint'] : '',
			'explanation' => isset( $en_q['explanation'] ) ? $en_q['explanation'] : '',
		);
	}

	$sortie['fr']['tasks'][] = $fr_t;
	$sortie['en']['tasks'][] = $en_t;
}

if ( ! is_dir( $dossier ) ) {
	mkdir( $dossier, 0777, true );
}

$cle     = $sortie['clé'] ? $sortie['clé'] : 'room-' . $room_id;
$fichier = $dossier . '/' . $cle . '.json';

file_put_contents( $fichier, json_encode( $sortie, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . "\n" );

printf( "%s : %d tâches exportées vers %s\n", $sortie['fr']['title'], count( $taches ), $fichier );
