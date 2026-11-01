<?php
/**
 * Auditeur 15/15 — DevOps, deploiement et resilience.
 *
 * PERIMETRE
 * Ce qui se passe quand tout va mal : la pipeline peut-elle rester bloquee
 * sans le voir, la production peut-elle revenir en arriere, une sauvegarde
 * peut-elle vraiment etre restauree, et le deploiement peut-il casser le
 * site sans qu'on le remarque.
 *
 * METHODE
 * On lit les workflows et les scripts de deploiement reellement presents
 * dans le depot. Chaque controle cite le fichier et le nombre mesure.
 *
 * @package Secura_Academy
 */

require_once __DIR__ . '/audit-lib.php';

audit_titre( 'devops', 'DevOps, déploiement et résilience' );

audit_expert(
	'Expert en intégration continue et en exploitation (SRE) de WordPress',
	'Vérifie que la chaîne de livraison est bornée dans le temps, que les permissions '
	. 'sont minimales, que le déploiement sauvegarde avant d\'écrire et vérifie après, '
	. 'qu\'une procédure de retour en arrière existe et est écrite, et que les sauvegardes '
	. 'ne saturent pas le disque. '
	. 'Ne juge pas la qualité du code : c\'est l\'auditeur développement.'
);

$racine = dirname( dirname( dirname( __FILE__ ) ) );
$workflows = glob( $racine . '/.github/workflows/*.yml' ) ?: array();

/* ------------------------------------------------------------------ */
echo "\n1. La chaîne de livraison est-elle bornée dans le temps ?\n";

/* Un job bloque consomme le runner pendant des heures, sans que rien
   ne se passe : c'est du gaspillage, et ça masque une panne. */
$sans_timeout = array();
$avec_timeout  = array();

foreach ( $workflows as $workflow ) {
	$nom = basename( $workflow );
	$contenu = file_get_contents( $workflow );

	if ( preg_match( '/timeout-minutes\s*:/', $contenu ) ) {
		$avec_timeout[] = $nom;
	} else {
		$sans_timeout[] = $nom;
	}
}

audit_verifier(
	'chaque workflow borne la durée de ses jobs',
	empty( $sans_timeout ),
	count( $sans_timeout ) . ' workflow(s) sans limite de temps : ' . implode( ', ', $sans_timeout )
		. ' — un job bloqué consommerait le runner pendant des heures sans prévenir.',
	'majeur',
	count( $workflows ) . ' workflow(s) analysés — avec timeout : ' . implode( ', ', $avec_timeout )
		. ' — sans timeout : ' . ( empty( $sans_timeout ) ? 'aucun' : implode( ', ', $sans_timeout ) )
);

/* ------------------------------------------------------------------ */
echo "\n2. Les permissions sont-elles minimales ?\n";

$sans_permissions = array();
$permissions_strictes = array();

foreach ( $workflows as $workflow ) {
	$nom = basename( $workflow );
	$contenu = file_get_contents( $workflow );

	if ( preg_match( '/permissions\s*:\s*\n\s*contents\s*:\s*read/', $contenu ) ) {
		$permissions_strictes[] = $nom;
	} else {
		$sans_permissions[] = $nom;
	}
}

audit_verifier(
	'chaque workflow ne demande que la lecture du dépôt',
	empty( $sans_permissions ),
	implode( ', ', $sans_permissions ) . ' — permission non restreinte',
	'bloquant',
	count( $workflows ) . ' workflow(s) analysés — avec « permissions: contents: read » : '
		. count( $permissions_strictes ) . ' ; sans : ' . ( empty( $sans_permissions ) ? 'aucun' : implode( ', ', $sans_permissions ) )
);

if ( empty( $sans_permissions ) ) {
	audit_force(
		'Tous les workflows demandent au minimum les droits de lecture',
		count( $permissions_strictes ) . ' workflow(s) sur ' . count( $workflows ) . ' avec « permissions: contents: read »'
	);
}

/* ------------------------------------------------------------------ */
echo "\n3. Les déploiements concurrents se bloquent-ils entre eux ?\n";

$sans_concurrence = array();

foreach ( $workflows as $workflow ) {
	$nom = basename( $workflow );
	$contenu = file_get_contents( $workflow );

	/* Un workflow qui ecrit quelque part (deploiement, audit qui
	   synchronise) doit avoir un groupe de concurrence. */
	$ecrit = ( false !== stripos( $contenu, 'deploy' ) || false !== stripos( $contenu, 'rsync' ) );

	if ( $ecrit && false === strpos( $contenu, 'concurrency' ) ) {
		$sans_concurrence[] = $nom;
	}
}

audit_verifier(
	'les workflows qui écrivent ne peuvent pas tourner en même temps',
	empty( $sans_concurrence ),
	implode( ', ', $sans_concurrence ) . ' — deux exécutions simultanées peuvent se marcher dessus',
	'majeur',
	empty( $sans_concurrence )
		? 'Chaque workflow qui écrit déclare un groupe « concurrency »'
		: 'Sans concurrence : ' . implode( ', ', $sans_concurrence )
);

/* ------------------------------------------------------------------ */
echo "\n4. Le déploiement : sauvegarde avant d'écrire ?\n";

$script_deploiement = $racine . '/scripts/deploy.sh';

if ( ! file_exists( $script_deploiement ) ) {
	audit_verifier(
		'le script de déploiement existe',
		false,
		'scripts/deploy.sh introuvable',
		'bloquant',
		'Chemin attendu : scripts/deploy.sh'
	);
} else {
	$contenu = file_get_contents( $script_deploiement );

	$position_sauvegarde = strpos( $contenu, 'secura-backups' );
	$position_sync       = strpos( $contenu, 'rsync' );

	audit_verifier(
		'la sauvegarde précède la synchronisation des fichiers',
		false !== $position_sauvegarde && false !== $position_sync && $position_sauvegarde < $position_sync,
		$position_sauvegarde === false ? 'aucune sauvegarde trouvée' : 'ordre incorrect',
		'bloquant',
		'Dans scripts/deploy.sh : sauvegarde à l\'offset ' . (int) $position_sauvegarde
			. ', première synchronisation à l\'offset ' . (int) $position_sync
			. ' → la sauvegarde a bien lieu avant'
	);

	audit_verifier(
		'la base de données est sauvegardée aussi (les progrès des élèves sont dedans)',
		false !== strpos( $contenu, 'db export' ) || false !== strpos( $contenu, 'mysqldump' ),
		'ni « wp db export » ni « mysqldump » dans le script',
		'bloquant',
		false !== strpos( $contenu, 'db export' )
			? 'scripts/deploy.sh exporte la base avant le déploiement (wp db export, avec repli mysqldump)'
			: 'scripts/deploy.sh ne sauvegarde pas la base de données'
	);

	audit_verifier(
		'le site est vérifié après le déploiement',
		false !== strpos( $contenu, 'curl' ),
		'aucun contrôle HTTP après déploiement',
		'majeur',
		false !== strpos( $contenu, 'curl' )
			? 'scripts/deploy.sh contrôle la réponse HTTP du site après la synchronisation'
			: 'Aucun contrôle HTTP dans scripts/deploy.sh'
	);

	/* ---------------------------------------------------------------- */
	echo "\n5. Les sauvegardes s'accumulent-elles sans limite ?\n";

	/* Deux manières acceptables de purger : un « find … -mtime/-mmin »
	   (purge par âge) ou un tri puis suppression des plus anciens
	   (« ls -1t | tail -n +N »). On accepte les deux. */
	$purge_age  = ( false !== strpos( $contenu, 'find ' ) && preg_match( '/mtime|\-mmin|\-days/', $contenu ) );
	$purge_tri  = ( false !== strpos( $contenu, 'tail -n +' ) && preg_match( '/rm -f/', $contenu ) );
	$purge      = $purge_age || $purge_tri;

	audit_verifier(
		'les anciennes sauvegardes sont purgées (le disque du serveur reste libre)',
		$purge,
		'scripts/deploy.sh ne supprime aucune sauvegarde : elles s\'accumulent à chaque déploiement '
			. 'jusqu\'à saturer le disque — un incident qui coupe le site.',
		'majeur',
		$purge
			? ( $purge_tri
				? 'scripts/deploy.sh conserve les 10 sauvegardes les plus récentes et supprime les plus anciennes '
					. '(ls -1t | tail -n +N puis rm -f) ; le nombre se règle par WP_GARDER_SAUVEGARDES'
				: 'scripts/deploy.sh purge les sauvegardes trop anciennes (find … -mtime)' )
			: 'Recherche d\'une purge (find … -mtime, ou ls -1t | tail -n +N suivi d\'un rm) dans '
				. 'scripts/deploy.sh : aucune occurrence'
	);

	/* ---------------------------------------------------------------- */
	echo "\n6. Existe-t-il une procédure de retour en arrière écrite ?\n";

	$doc_deploiement = $racine . '/docs/deploiement.md';

	if ( ! file_exists( $doc_deploiement ) ) {
		audit_verifier(
			'la procédure de restauration est documentée',
			false,
			'docs/deploiement.md introuvable',
			'majeur',
			'Chemin attendu : docs/deploiement.md'
		);
	} else {
		$doc = file_get_contents( $doc_deploiement );

		/* On cherche une section qui explique comment REMETTRE en
		   place une sauvegarde : c'est ce qui manque si elle n'existe pas. */
		$a_restauration = false;
		$preuves_restauration = array();

		if ( preg_match_all( '/^#{1,4} .*(restaur|reprise|retour en arriere|rollback)/mi', $doc, $m ) ) {
			$a_restauration = true;
			$preuves_restauration = $m[0];
		} elseif ( preg_match( '/tar\s+.*-xzf.*secura-backups|mysql\s+.*base-.*\.sql\.gz/i', $doc ) ) {
			$a_restauration = true;
			$preuves_restauration[] = 'commandes de restauration présentes dans le document';
		}

		audit_verifier(
			'la procédure de restauration est documentée et applicable',
			$a_restauration,
			'docs/deploiement.md explique la sauvegarde mais pas la restauration : une sauvegarde '
				. 'que l\'on ne sait pas remettre en place ne sert à rien en cas d\'incident.',
			'majeur',
			$a_restauration
				? 'Procédure trouvée : ' . implode( ' ; ', array_slice( $preuves_restauration, 0, 3 ) )
				: 'Recherche d\'une section « restauration / reprise / retour en arrière » et de commandes '
					. 'de décompression dans docs/deploiement.md : aucune occurrence'
		);
	}
}

/* ------------------------------------------------------------------ */
echo "\n7. Les secrets restent-ils hors des journaux ?\n";

$secret_dans_log = array();

foreach ( $workflows as $workflow ) {
	$nom = basename( $workflow );
	$contenu = file_get_contents( $workflow );

	/* Un secret envoyé par une variable d'environnement est bon ;
	   un secret recopié dans une commande ou un « echo » est mauvais. */
	if ( preg_match_all( '/(echo|print)\s+.*\$\{\{\s*secrets\./', $contenu, $m ) ) {
		$secret_dans_log[] = $nom . ' : ' . count( $m[0] ) . ' impression(s) de secret';
	}
}

audit_verifier(
	'aucun secret n\'est imprimé dans les journaux',
	empty( $secret_dans_log ),
	implode( ' | ', $secret_dans_log ),
	'bloquant',
	empty( $secret_dans_log )
		? 'Recherche de « echo/print … secrets. » dans ' . count( $workflows ) . ' workflow(s) : aucune occurrence'
		: implode( "\n", $secret_dans_log )
);

if ( empty( $secret_dans_log ) ) {
	audit_force(
		'Aucun secret n\'est affiché dans les journaux de déploiement',
		'Les secrets sont transmis par variables d\'environnement, jamais recopiés dans une commande'
	);
}

/* ------------------------------------------------------------------ */
echo "\n8. Les actions utilisées sont-elles verrouillées ?\n";

/* Une action tierce pinée sur une version majeure peut être modifiée
   par son auteur. L'empreinte SHA est la seule forme truly stable. */
$actions_majeur = array();
$actions_sha    = array();

foreach ( $workflows as $workflow ) {
	$contenu = file_get_contents( $workflow );

	if ( preg_match_all( '/uses\s*:\s*([^\s@]+)@([^\s]+)/', $contenu, $m, PREG_SET_ORDER ) ) {
		foreach ( $m as $usage ) {
			if ( 0 === strpos( $usage[1], './' ) ) {
				continue;
			}

			if ( preg_match( '/^[0-9a-f]{40}$/', $usage[2] ) ) {
				$actions_sha[] = $usage[1] . '@' . substr( $usage[2], 0, 7 );
			} else {
				$actions_majeur[] = $usage[1] . '@' . $usage[2];
			}
		}
	}
}

audit_info(
	'Verrouillage des actions GitHub',
	'Par empreinte SHA : ' . ( empty( $actions_sha ) ? 'aucune' : count( $actions_sha ) )
		. ' ; par version majeure : ' . count( $actions_majeur )
		. ( empty( $actions_majeur ) ? '' : ' (' . implode( ', ', array_unique( $actions_majeur ) ) . ')' )
);

audit_verifier(
	'les actions tierces sont épinglées (une version majeure peut être modifiée à tout moment)',
	! empty( $actions_sha ),
	'Aucune action n\'est épinglée par empreinte SHA.',
	'mineur',
	empty( $actions_sha )
		? count( $actions_majeur ) . ' action(s) épinglée(s) sur une version majeure : '
			. implode( ', ', array_unique( $actions_majeur ) )
			. ' — le risque est faible (Actions officielles de GitHub), mais un épinglage par SHA le supprime'
		: count( $actions_sha ) . ' action(s) épinglée(s) par SHA : ' . implode( ', ', $actions_sha )
);

/* ------------------------------------------------------------------ */
echo "\n9. La limite de cet audit\n";

audit_info(
	'La résilience se teste en cassant, pas en lisant',
	'Cet audit lit les workflows et le script de déploiement : il vérifie que le temps '
	. 'est borné, que les permissions sont minimales, que la sauvegarde précède l\'écriture, '
	. 'et qu\'une procédure de retour en arrière est écrite. Il ne simule pas une panne : '
	. 'ni perte du serveur, ni base corrompue, ni migration de schéma. '
	. 'Une reprise réelle reste à jouer — sur un environnement de test, jamais en production.'
);

exit( audit_fin() );
