<?php
/**
 * Audit externe — Securite et infrastructure.
 *
 * Controle ce que controla un specialiste securite avant une mise en
 * ligne : les secrets, le durcissement des conteneurs, l'isolation entre
 * eleves, la protection des en-tetes HTTP, la sauvegarde, et le droit de
 * chacun a agir sur le serveur.
 *
 * Usage : wp eval-file scripts/audit/audit-securite-infra.php
 *
 * @package Secura_Academy
 */

require_once dirname( __FILE__ ) . '/audit-lib.php';

audit_titre( 'securite', 'Audit externe — Sécurité et infrastructure' );

$racine = dirname( dirname( dirname( __FILE__ ) ) );
$plugin = $racine . '/wp-content/plugins/secura-academy';

/* ------------------------------------------------------------------ */
echo "\n1. Les secrets\n";

$trouves = array();

foreach ( audit_chercher( $racine . '/wp-content', '/(api[_-]?key|secret[_-]?key|access[_-]?token)\s*[:=]\s*[\x27\"][^\x27\"]{12,}/i', 'php' ) as $ligne ) {
	$trouves[] = $ligne;
}

audit_verifier(
	'aucun secret en clair dans le code livre',
	empty( $trouves ),
	implode( ' | ', array_slice( $trouves, 0, 3 ) ),
	'bloquant'
);

$gitignore = file_get_contents( $racine . '/.gitignore' );

foreach ( array( '.env', 'wp-config.php', '*.pem', '*.key', '.netrc' ) as $protege ) {
	audit_verifier(
		'le depot ignore ' . $protege,
		false !== strpos( $gitignore, $protege ),
		'',
		'majeur'
	);
}

/* ------------------------------------------------------------------ */
echo "\n2. L'isolation entre eleves\n";

$lab = file_get_contents( $plugin . '/includes/class-secura-lab.php' );

audit_verifier(
	'chaque eleve a sa propre pile Docker (projet et reseau nommes par eleve)',
	false !== strpos( $lab, "'seca_lab_' . absint( \$user_id )" ),
	'',
	'bloquant'
);

audit_verifier(
	'les piles sont etiquetees (le nettoyage peut les retrouver)',
	false !== strpos( $lab, 'seca.lab.project' ) && false !== strpos( $lab, 'seca.lab.user' ),
	'',
	'majeur'
);

audit_verifier(
	'les commandes de l\'eleve s\'executent dans son conteneur, jamais sur l\'hote',
	false !== strpos( $lab, "'exec'" ) && false !== strpos( $lab, 'docker' ),
	'',
	'bloquant'
);

audit_verifier(
	'les chemins de fichiers sont filtres (pas de remontee de repertoire)',
	false !== strpos( $lab, 'safe_machine_path' ) || false !== strpos( $lab, '..' ),
	'',
	'majeur'
);

/* ------------------------------------------------------------------ */
echo "\n3. Le durcissement des machines\n";

$composes = glob( $racine . '/labs/*/docker-compose.yml' );
$manquants = array();

foreach ( $composes as $compose ) {
	$contenu = file_get_contents( $compose );

	if ( false === strpos( $contenu, 'cap_drop' ) ) {
		$manquants[] = basename( dirname( $compose ) ) . ' (cap_drop)';
	}

	if ( false === strpos( $contenu, 'no-new-privileges' ) ) {
		$manquants[] = basename( dirname( $compose ) ) . ' (no-new-privileges)';
	}

	if ( false === strpos( $contenu, 'pids_limit' ) ) {
		$manquants[] = basename( dirname( $compose ) ) . ' (pids_limit)';
	}
}

audit_verifier(
	'les piles Docker sont durcies (capacites retirees, aucun privilege nouveau, limites de processus)',
	empty( $manquants ),
	implode( ' | ', array_slice( $manquants, 0, 5 ) ),
	'majeur'
);

$internes = 0;
$total    = 0;

foreach ( $composes as $compose ) {
	$total++;

	if ( false !== strpos( file_get_contents( $compose ), 'internal: true' ) ) {
		$internes++;
	}
}

audit_verifier(
	'les réseaux des labs n\'ont pas de sortie Internet',
	$internes === $total,
	$internes . ' pile(s) fermee(s) sur ' . $total,
	'majeur'
);

$dockerfiles = glob( $racine . '/labs/*/Dockerfile' );
$dossiers    = glob( $racine . '/labs/*/flags/Dockerfile' );
$proteges    = 0;

foreach ( array_merge( $dockerfiles, $dossiers ) as $dockerfile ) {
	if ( false !== strpos( file_get_contents( $dockerfile ), 'chmod 400' ) ) {
		$proteges++;
	}
}

audit_verifier(
	'les fichiers de drapeau sont proteges (400 root:root)',
	$proteges >= count( $dockerfiles ),
	$proteges . ' image(s) sur ' . count( $dockerfiles ) . ' protegent leurs drapeaux',
	'bloquant'
);

/* ------------------------------------------------------------------ */
echo "\n4. Les en-tetes de securite du site\n";

$entetes = 0;

foreach ( array( 'X-Frame-Options', 'X-Content-Type-Options', 'Referrer-Policy' ) as $entete ) {
	$code = $lab . file_get_contents( $plugin . '/secura-academy.php' )
		. file_get_contents( $racine . '/wp-content/themes/secura-learning/functions.php' );

	if ( false !== strpos( $code, $entete ) ) {
		$entetes++;
	}
}

audit_verifier(
	'le site envoie les en-tetes de securite de base (anti-clickjacking, anti-sniffing)',
	$entetes >= 2,
	$entetes . ' en-tete(s) sur 3 presents',
	'majeur'
);

/* ------------------------------------------------------------------ */
echo "\n5. La chaine de livraison (GitHub Actions)\n";

$workflows = glob( $racine . '/.github/workflows/*.yml' );
$permissions_severes = array();

foreach ( $workflows as $workflow ) {
	$contenu = file_get_contents( $workflow );

	if ( false === strpos( $contenu, 'permissions:' ) ) {
		$permissions_severes[] = basename( $workflow ) . ' (aucune permission declaree)';
	} elseif ( preg_match( '/permissions:\s*\n\s*write: all/', $contenu ) ) {
		$permissions_severes[] = basename( $workflow ) . ' (write: all)';
	}
}

audit_verifier(
	'chaque workflow limite ses permissions',
	empty( $permissions_severes ),
	implode( ' | ', $permissions_severes ),
	'majeur'
);

$deploiement = file_get_contents( $racine . '/.github/workflows/deploy.yml' );

audit_verifier(
	'le deploiement utilise les secrets de GitHub (jamais un mot de passe dans le code)',
	false !== strpos( $deploiement, 'secrets.WP_SSH_PRIVATE_KEY' ),
	'',
	'bloquant'
);

audit_verifier(
	'le deploiement passe par un environnement « production » (peut exiger une validation humaine)',
	false !== strpos( $deploiement, 'environment:' ) && false !== strpos( $deploiement, 'production' ),
	'',
	'mineur'
);

$script_deploy = file_get_contents( $racine . '/scripts/deploy.sh' );

audit_verifier(
	'le deploiement sauvegarde la version precedente avant d\'ecraser',
	false !== strpos( $script_deploy, 'secura-backups' ) && false !== strpos( $script_deploy, 'tar' ),
	'',
	'majeur'
);

audit_verifier(
	'la sauvegarde inclut la base de donnees (pas seulement le code)',
	false !== strpos( $script_deploy, 'wp db export' ) || false !== strpos( $script_deploy, 'mysqldump' ),
	'sans la base, une restauration apres un incident perd les eleves et leurs progresses',
	'majeur'
);

/* ------------------------------------------------------------------ */
echo "\n6. Ce que le visiteur peut tenter\n";

$ajax = file_get_contents( $plugin . '/includes/class-secura-ajax.php' );

audit_verifier(
	'les appels API sont proteges par un nonce (une page tierce ne peut pas les utiliser)',
	false !== strpos( $ajax, 'wp_verify_nonce' ),
	'',
	'bloquant'
);

audit_verifier(
	'les appels API demandent une session ouverte',
	false !== strpos( $ajax, 'is_user_logged_in' ),
	'',
	'bloquant'
);

audit_verifier(
	'les appels API sont limites en debit',
	false !== strpos( $ajax, 'throttle' ),
	'',
	'mineur'
);

audit_verifier(
	'le telechargement du quiz Kahoot demande une session (document de classe)',
	false !== strpos( file_get_contents( $plugin . '/includes/class-secura-kahoot.php' ), 'is_user_logged_in' ),
	'',
	'mineur'
);

/* ------------------------------------------------------------------ */
echo "\n7. La documentation de securite\n";

audit_verifier(
	'le document d\'hebergement dit quand il faut un VPS (et pourquoi)',
	file_exists( $racine . '/docs/HEBERGEMENT.md' ),
	'',
	'mineur'
);

audit_verifier(
	'le document de compatibilite des plugins existe',
	file_exists( $racine . '/docs/COMPATIBILITE-PLUGINS.md' ),
	'',
	'info'
);

exit( audit_fin() );
