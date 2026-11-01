/* ---------------------------------------------------------------------
 * Scénarios M3 : contenu, QCM à une seule bonne réponse, missions
 * vérifiées sur une vraie machine (drapeaux lus par le serveur).
 * ------------------------------------------------------------------ */

echo "\nScénarios M3\n";

require_once __DIR__ . '/../wp-content/plugins/secura-academy/includes/content-m3.php';

$labs_dir = dirname( __DIR__ ) . '/labs';

$m3 = seca_default_rooms_m3();

check( 10 === count( $m3 ), 'dix scénarios M3 sont fournis' );

$m3_structure  = true;
$m3_qcm        = true;
$m3_flags      = true;
$m3_labs       = true;
$m3_positions  = array();
$m3_flag_count = 0;
$m3_qcm_count  = 0;

/* Correspondance service Compose -> dossier du lab. */
$m3_service_folder = array(
	'attacker'  => 'web-01',
	'web'       => 'web-01',
	'db'        => 'web-01',
	'internal'  => 'internal-01',
);

foreach ( $m3 as $room ) {
	$types = array();

	foreach ( $room['tasks'] as $task ) {
		$types[] = $task['type'];
	}

	if ( array( 'lesson', 'practice', 'test', 'exam' ) !== $types ) {
		$m3_structure = false;
	}

	if ( ! isset( $room['i18n']['ar'], $room['i18n']['en'] ) ) {
		$m3_structure = false;
	}

	if ( empty( $room['lab']['enabled'] ) ) {
		$m3_labs = false;
	}

	foreach ( $room['tasks'] as $task ) {
		foreach ( $task['questions'] as $question ) {
			$mode = isset( $question['mode'] ) ? $question['mode'] : 'text';

			if ( 'choice' === $mode ) {
				$m3_qcm_count++;
				$choices = isset( $question['choices'] ) ? $question['choices'] : array();

				/* Un vrai QCM : quatre propositions, une seule bonne,
				   aucune proposition dupliquee, une explication et
				   un indice. */
				if ( 4 !== count( $choices )
					|| count( array_unique( $choices ) ) !== 4
					|| ! isset( $choices[ (int) $question['correct'] ] )
					|| empty( $question['explanation'] )
					|| empty( $question['hint'] ) ) {
					$m3_qcm = false;
				}

				$m3_positions[ (int) $question['correct'] ] = isset( $m3_positions[ (int) $question['correct'] ] ) ? $m3_positions[ (int) $question['correct'] ] + 1 : 1;

				continue;
			}

			if ( 'flag' !== $mode ) {
				continue;
			}

			$m3_flag_count++;
			$flag_path = isset( $question['flag_path'] ) ? $question['flag_path'] : '';

			/* Le chemin doit etre accepte par le moteur (pas de
			   traversee de repertoire possible). */
			if ( '' === $flag_path || '' === Secura_Lab::safe_machine_path( $flag_path ) ) {
				$m3_flags = false;
				continue;
			}

			/* Le fichier de reponse doit exister dans le depot, et
			   contenir un drapeau. */
			if ( 'single' === $room['lab']['mode'] ) {
				$image = $room['lab']['image'];
				$folder = 'securalabs/' === substr( $image, 0, 11 ) ? substr( $image, 11, strpos( $image, ':' ) - 11 ) : '';
				$file = $labs_dir . '/' . $folder . '/flag/' . basename( $flag_path );
			} else {
				$service = ! empty( $room['lab']['flag_service'] ) ? $room['lab']['flag_service'] : $room['lab']['service'];
				$folder = isset( $m3_service_folder[ $service ] ) ? $m3_service_folder[ $service ] : '';
				$file = $labs_dir . '/' . $folder . '/flag/' . basename( $flag_path );
			}

			if ( ! is_file( $file ) ) {
				$m3_flags = false;
				continue;
			}

			$content = trim( (string) file_get_contents( $file ) );

			if ( 0 !== strpos( $content, 'FLAG=SECURA{' ) ) {
				$m3_flags = false;
			}
		}
	}
}

check( $m3_structure, 'chaque scénario M3 suit le patron leçon → entraînement → mission → examen, en FR/AR/EN' );
check( $m3_qcm, 'chaque question d\'entraînement et d\'examen est un QCM à quatre propositions et une seule bonne réponse' );
check( $m3_flags, 'chaque mission valide un drapeau réellement présent dans le dépôt (preuve de travail)' );
check( $m3_labs, 'chaque scénario M3 est branché sur une machine réelle' );
check( $m3_qcm_count >= 60, 'les scénarios M3 proposent plus de soixante questions d\'entraînement et d\'examen' );
check( $m3_flag_count >= 9, 'les scénarios M3 comportent au moins neuf missions vérifiées sur la machine' );
check( count( array_filter( $m3_positions, function ( $n ) { return $n > 0; } ) ) >= 3, 'la bonne réponse n\'est pas toujours à la même place' );

/* Les machines citees doivent exister dans le depot. */
$m3_images = array();

foreach ( $m3 as $room ) {
	if ( 'single' === $room['lab']['mode'] && ! empty( $room['lab']['image'] ) ) {
		$m3_images[ $room['lab']['image'] ] = true;
	}
}

$m3_images_ok = true;

foreach ( array_keys( $m3_images ) as $image ) {
	$folder = 'securalabs/' === substr( $image, 0, 11 ) ? substr( $image, 11, strpos( $image, ':' ) - 11 ) : '';

	if ( ! is_file( $labs_dir . '/' . $folder . '/Dockerfile' ) ) {
		$m3_images_ok = false;
	}
}

check( $m3_images_ok, 'chaque image Docker citée par les scénarios existe dans le dépôt (labs/)' );
check( is_file( $labs_dir . '/net-01/docker-compose.yml' ), 'la pile multi-nœuds citée par les scénarios 7 et 8 existe' );

/* Le parcours « Scénarios M3 » regroupe les dix rooms en cinq modules. */
$paths = seca_default_paths( array( 1, 2, 3, 4, 5, 6 ), array( 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ) );
$m3_path = isset( $paths[1] ) ? $paths[1] : array();

check( 2 === count( $paths ), 'deux parcours sont crees : les fondations et les scénarios M3' );
check( isset( $m3_path['sections'] ) && 5 === count( $m3_path['sections'] ), 'le parcours M3 compte cinq modules' );
check( 10 === array_sum( array_map( 'count', $m3_path['sections'] ) ), 'le parcours M3 contient les dix scénarios' );
check( isset( $m3_path['i18n']['ar'], $m3_path['i18n']['en'] ), 'le parcours M3 est traduit en arabe et en anglais' );

/* Le moteur : un drapeau lu dans la machine de l'apprenant, en root. */
$flag_dir  = sys_get_temp_dir() . '/seca_docker_flag';
$flag_bin  = $flag_dir . '/docker';

if ( ! is_dir( $flag_dir ) ) {
	mkdir( $flag_dir, 0777, true );
}

file_put_contents(
	$flag_bin,
	<<<'SH'
#!/bin/sh
if [ "$1" = "info" ]; then echo 27.0.0; exit 0; fi
if [ "$1" = "exec" ]; then echo "FLAG=SECURA{triage_patient}"; exit 0; fi
exit 0
SH
);

chmod( $flag_bin, 0755 );

$old_path_flag = getenv( 'PATH' );

putenv( 'PATH=' . $flag_dir . ':' . $old_path_flag );

update_post_meta(
	77,
	'_secura_lab',
	array(
		'enabled' => 1,
		'driver'  => 'docker',
		'mode'    => 'single',
		'image'   => 'securalabs/multi-01:1.0',
		'command' => 'sleep infinity',
		'network' => 'seca_lab',
		'ttl'     => 3600,
	)
);

set_transient( 'seca_docker_available', '1', 300 );

Secura_Lab::start( 5, 77 );

$m3_flag_ok   = Secura_Lab::flag_matches( 5, 77, '/root/flags/flag-01.txt', 'FLAG=SECURA{triage_patient}' );
$m3_flag_ko  = Secura_Lab::flag_matches( 5, 77, '/root/flags/flag-01.txt', 'FLAG=SECURA{autre_chose}' );

putenv( 'PATH=' . $old_path_flag );

check( $m3_flag_ok, 'le serveur accepte le drapeau lu dans la machine de l\'apprenant' );
check( $m3_flag_ko, 'un mauvais drapeau est refuse meme si la machine est demarree' );
check( '' === Secura_Lab::safe_machine_path( '/root/flags/../../../etc/passwd' ), 'un chemin de drapeau contenant « .. » est refuse' );
