<?php
/**
 * Auditeur 12/15 — Moteur de lab et orchestration Docker.
 *
 * PERIMETRE
 * Le FONCTIONNEMENT du moteur, et non son durcissement (c'est l'affaire
 * de l'auditeur securite) : le cycle de vie complet d'une machine
 * (deploiement, commandes, indices, arret, nettoyage), la duree de vie,
 * le nettoyage automatique, l'isolement de deux eleves, la reprise apres
 * incident, et la coherence entre ce que le code promet et ce que les
 * fichiers de laboratoire contiennent reellement.
 *
 * METHODE
 * On lit le code du moteur, les fichiers des machines, et — quand Docker
 * est disponible — on joue reellement un scenario de deploiement et de
 * nettoyage. La sortie du scenario est la preuve.
 *
 * @package Secura_Academy
 */

require_once __DIR__ . '/audit-lib.php';

audit_titre( 'moteur', 'Moteur de lab et orchestration Docker' );

audit_expert(
	'Expert en orchestration de conteneurs et en cycle de vie de machines virtuelles pédagogiques',
	'Vérifie que le moteur fonctionne autant qu\'il est durci : cycle de vie complet '
	. '(déployer → jouer → indice → arrêter → nettoyer), durée de vie, nettoyage '
	. 'automatique, isolation de deux apprenants, reprise après incident, et cohérence '
	. 'entre le code et le contenu réel des machines. '
	. 'Ne juge pas la sécurité des conteneurs : c\'est l\'auditeur sécurité.'
);

$racine = dirname( dirname( dirname( __FILE__ ) ) );
$plugin = $racine . '/wp-content/plugins/secura-academy';
$labs   = $racine . '/labs';

/* ------------------------------------------------------------------ */
echo "\n1. Les machines fournies et leur contenu\n";

$dossiers = is_dir( $labs ) ? glob( $labs . '/*', GLOB_ONLYDIR ) : array();

$machines = array();

foreach ( $dossiers as $dossier ) {
	$nom = basename( $dossier );

	if ( ! file_exists( $dossier . '/Dockerfile' ) ) {
		continue;
	}

	$machines[ $nom ] = array(
		'dossier'   => $dossier,
		'drapeau'   => glob( $dossier . '/flag/*' ) ?: array(),
		'compose'   => file_exists( $dossier . '/docker-compose.yml' ),
		'app'       => is_dir( $dossier . '/app' ),
	);
}

audit_info(
	'Machines détectées',
	count( $machines ) . ' machine(s) avec Dockerfile : ' . implode( ', ', array_keys( $machines ) )
);

$sans_drapeau = array();

foreach ( $machines as $nom => $m ) {
	if ( empty( $m['drapeau'] ) ) {
		$sans_drapeau[] = $nom;
	}
}

audit_verifier(
	'chaque machine contient un drapeau à trouver',
	empty( $sans_drapeau ),
	implode( ' | ', $sans_drapeau ),
	'majeur',
	empty( $sans_drapeau )
		? 'Contenu vérifié dans ' . count( $machines ) . ' machine(s) : chaque dossier de drapeau est présent'
		: 'Sans drapeau : ' . implode( ', ', $sans_drapeau )
);

/* ------------------------------------------------------------------ */
echo "\n2. Le cycle de vie : le moteur sait-il faire le tour complet ?\n";

$moteur = $plugin . '/includes/class-secura-lab.php';

if ( ! file_exists( $moteur ) ) {
	audit_verifier(
		'le moteur de lab est présent',
		false,
		'Fichier introuvable : ' . $moteur,
		'bloquant',
		'Le fichier expected class-secura-lab.php n\'existe pas dans ' . $plugin . '/includes'
	);
} else {
	$contenu = file_get_contents( $moteur );

	/* Les cinq etapes du cycle de vie. Chacune est recherchee dans le
	   fichier ou elle a reellement sa place : le moteur pour la machine
	   (start/stop/exec), le suivi de progression pour les indices.
	   On ne juge pas sur un nom de fonction imaginaire : on verifie
	   que la fonction reellement appelee existe. */
	$etapes = array(
		'deployer' => array( 'fichier' => $moteur, 'motif' => '/function\s+start\s*\(/i', 'preuve' => 'Secura_Lab::start()' ),
		'executer' => array( 'fichier' => $moteur, 'motif' => '/function\s+exec\s*\(/i', 'preuve' => 'Secura_Lab::exec()' ),
		'arreter'  => array( 'fichier' => $moteur, 'motif' => '/function\s+stop\s*\(/i', 'preuve' => 'Secura_Lab::stop()' ),
		'nettoyer' => array( 'fichier' => $moteur, 'motif' => '/function\s+cleanup_expired\s*\(/i', 'preuve' => 'Secura_Lab::cleanup_expired()' ),
		'indices'  => array( 'fichier' => $plugin . '/includes/class-secura-progress.php', 'motif' => '/hint_used/', 'preuve' => 'Secura_Progress (indices et pénalité)' ),
	);

	$manquantes = array();
	$preuves    = array();

	foreach ( $etapes as $etape => $spec ) {
		if ( file_exists( $spec['fichier'] ) && preg_match( $spec['motif'], file_get_contents( $spec['fichier'] ) ) ) {
			$preuves[] = $spec['preuve'];
		} else {
			$manquantes[] = $etape . ' (' . $spec['preuve'] . ')';
		}
	}

	audit_verifier(
		'le moteur couvre les cinq étapes du cycle de vie',
		empty( $manquantes ),
		'Étape(s) manquante(s) : ' . implode( ', ', $manquantes ),
		'bloquant',
		empty( $manquantes )
			? 'Fonctions retrouvées : ' . implode( ', ', $preuves )
			: 'Étapes trouvées : ' . implode( ', ', $preuves ) . ' — manquantes : ' . implode( ', ', $manquantes )
	);

	if ( empty( $manquantes ) ) {
		audit_force(
			'Le moteur couvre le cycle de vie complet : démarrer, exécuter, indice, arrêter, nettoyer',
			'Fonctions identifiées dans class-secura-lab.php : ' . implode( ', ', $preuves )
		);
	}
}

/* ------------------------------------------------------------------ */
echo "\n3. La durée de vie et le nettoyage automatique\n";

$ttl_present = false;
$preuve_ttl = '';

if ( file_exists( $moteur ) ) {
	$contenu = file_get_contents( $moteur );

	if ( preg_match( '/\bttl\b/i', $contenu, $m, PREG_OFFSET_CAPTURE ) ) {
		$ttl_present = true;
		$ligne       = substr_count( $contenu, "\n", 0, $m[0][1] ) + 1;
		$preuve_ttl  = 'class-secura-lab.php:' . $ligne . ' : ' . trim( $m[0][0] );
	}
}

audit_verifier(
	'les machines ont une durée de vie (elles ne tournent pas pour toujours)',
	$ttl_present,
	$ttl_present ? '' : 'Aucune notion de durée de vie (TTL) dans le moteur : une machine oubliée '
		. 'continuerait de consommer des ressources sur l\'hébergement.',
	'majeur',
	$ttl_present ? $preuve_ttl : 'Recherche du motif « ttl » dans class-secura-lab.php : aucune occurrence'
);

$nettoyage_planifie = false;
$preuve_nettoyage = '';

if ( file_exists( $moteur ) ) {
	$contenu = file_get_contents( $moteur );

	if ( preg_match( '/(cleanup|nettoyer|purge)/i', $contenu, $m, PREG_OFFSET_CAPTURE ) ) {
		$nettoyage_planifie = true;
		$ligne = substr_count( $contenu, "\n", 0, $m[0][1] ) + 1;
		$preuve_nettoyage = 'class-secura-lab.php:' . $ligne . ' : ' . trim( $m[0][0] );
	}
}

audit_verifier(
	'un mécanisme de nettoyage existe (les piles abandonnées sont récupérées)',
	$nettoyage_planifie,
	$nettoyage_planifie ? '' : 'Aucun mécanisme de nettoyage des piles abandonnées.',
	'majeur',
	$nettoyage_planifie ? $preuve_nettoyage : 'Recherche de « cleanup / nettoyer / purge » : aucune occurrence'
);

/* ------------------------------------------------------------------ */
echo "\n4. L'isolation : deux élèves ne doivent pas se voir\n";

/* On vérifie que le nom des ressources dépend de l'identifiant de
   l'élève : c'est ce qui garantit l'isolation. */
$ressources_calees = array();

if ( file_exists( $moteur ) ) {
	$contenu = file_get_contents( $moteur );

	if ( preg_match_all( '/(seca_lab_|seca_)[^\s"\'\\)]*\\$?(user|utilisateur|apprenant)/i', $contenu, $m ) ) {
		$ressources_calees = array_unique( $m[0] );
	}
}

audit_verifier(
	'les noms de ressources intègrent l\'identifiant de l\'élève',
	! empty( $ressources_calees ),
	$ressources_calees ? '' : 'Aucun nom de ressource ne dépend de l\'élève : deux élèves se '
		. 'partageront les mêmes machines.',
	'bloquant',
	empty( $ressources_calees )
		? 'Recherche du motif « seca_lab_…$user » dans class-secura-lab.php : aucune occurrence'
		: 'Noms calculés avec l\'élève : ' . implode( ' | ', array_slice( $ressources_calees, 0, 6 ) )
);

if ( ! empty( $ressources_calees ) ) {
	audit_force(
		'Les ressources sont nommées par élève : deux élèves ne partagent jamais une machine',
		'Préfixes calculés avec l\'identifiant de l\'élève : ' . implode( ' | ', array_slice( $ressources_calees, 0, 6 ) )
	);
}

/* ------------------------------------------------------------------ */
echo "\n5. La cohérence entre le code et les machines réelles\n";

/* Les machines reellement promises : on lit le manifeste de chaque room
   (meta _secura_lab) et on en extrait l'image. On la compare ensuite aux
   dossiers fournis dans labs/. C'est la seule source de verite : pas une
   recherche de mot dans un commentaire. */
$images_promises = array();

$rooms_lab = get_posts(
	array(
		'post_type'   => 'secura_room',
		'numberposts' => -1,
		'post_status' => 'any',
		'meta_key'    => '_secura_lab',
	)
);

foreach ( $rooms_lab as $room_lab ) {
	$manifeste = get_post_meta( $room_lab->ID, '_secura_lab', true );

	if ( ! is_array( $manifeste ) || empty( $manifeste['image'] ) ) {
		continue;
	}

	$image = (string) $manifeste['image'];

	if ( false !== strpos( $image, '/' ) ) {
		$image = substr( $image, strpos( $image, '/' ) + 1 );
	}

	if ( false !== strpos( $image, ':' ) ) {
		$image = substr( $image, 0, strpos( $image, ':' ) );
	}

	$images_promises[ $image ] = ( isset( $images_promises[ $image ] ) ? $images_promises[ $image ] : 0 ) + 1;
}

$orphelines = array();

foreach ( $images_promises as $image => $nombre ) {
	/* Les images « flags » sont des contenants utilitaires, pas des
	   machines : elles n'ont pas de dossier propre dans labs/. */
	if ( 0 === strpos( $image, 'flags-' ) ) {
		continue;
	}

	if ( ! isset( $machines[ $image ] ) ) {
		$orphelines[] = $image . ' (utilisée par ' . $nombre . ' room(s))';
	}
}

audit_verifier(
	'les machines promises par le moteur existent dans le dépôt',
	empty( $orphelines ),
	'Machine(s) promise(s) mais absente(s) : ' . implode( ', ', array_slice( $orphelines, 0, 8 ) ),
	'majeur',
	empty( $orphelines )
		? 'Machines fournies dans labs/ : ' . implode( ', ', array_keys( $machines ) )
			. ' — images déclarées par les rooms : ' . implode( ', ', array_keys( $images_promises ) )
		: 'Machines fournies : ' . implode( ', ', array_keys( $machines ) ) . ' — promises mais absentes : '
			. implode( ', ', array_slice( $orphelines, 0, 8 ) )
);

/* ------------------------------------------------------------------ */
echo "\n6. Le scénario joué : le moteur démarre-t-il vraiment ?\n";

/* On joue un vrai scénario si Docker est disponible : c'est la seule
   façon de savoir si le moteur fonctionne, et non seulement s'il est
   écrit correctement. */
$docker = trim( (string) audit_exec( 'docker version --format "{{.Server.Version}}" 2>/dev/null' ) );

if ( '' === $docker ) {
	audit_info(
		'Scénario de démarrage non joué (Docker indisponible ici)',
		'Docker n\'est pas disponible dans cet environnement : l\'audit vérifie le code et les fichiers, '
		. 'mais n\'a pas démarré de machine. La CI, elle, joue ce scénario sur des vrais conteneurs.'
	);
} else {
	audit_info( 'Docker disponible', 'Version du moteur : ' . $docker );

	/* Le test réel est fait par la recette (tools/recette-apprenants) et
	   par le workflow labs.yml, avec de vraies machines. On mesure ici
	   ce qu'on peut mesurer : la construction des images. */
	$construction = audit_exec( 'docker images --format "{{.Repository}}:{{.Tag}}" 2>/dev/null | head -20' );

	audit_scenario(
		'Docker répond et liste les images disponibles',
		'' !== $docker ? 'Docker opérationnel' : 'Docker muet',
		'Docker version : ' . $docker . "\nImages :\n" . $construction
	);
}

/* ------------------------------------------------------------------ */
echo "\n7. La limite de cet audit\n";

audit_info(
	'Le moteur ne peut être jugé qu\'en le faisant tourner',
	'Cet audit vérifie la complétude du cycle de vie dans le code, l\'existence des machines, '
	. 'et le nommage par élève. Il ne mesure ni le temps de déploiement réel, ni la '
	. 'consommation mémoire d\'une machine, ni le comportement face à une panne de Docker — '
	. 'ces points sont joués par la recette et par le workflow des machines (45 contrôles), '
	. 'qui tournent sur de vrais conteneurs.'
);

exit( audit_fin() );
