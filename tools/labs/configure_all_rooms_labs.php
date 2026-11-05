<?php
/**
 * Configure les 52 rooms avec un lab Docker approprié.
 * Usage : wp eval-file tools/labs/configure_all_rooms_labs.php
 *
 * Mapping basé sur le sujet de chaque room :
 * - Web / Injection / XSS / Auth / Boutique -> owasp-juice-shop (Red Team)
 * - Buffer overflow / Binaire / Mémoire / ROP / Canari -> buffer-overflow (Red Team)
 * - Logs / Audit / Journaux -> blue-log-analysis (Blue Team)
 * - Firewall / Réseau / Segmentation -> blue-firewall (Blue Team)
 * - TLS / HTTPS / Certificat -> dvwa (Red Team)
 * - Briefs / Introduction -> owasp-juice-shop (démo web)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( "À exécuter avec wp eval-file.\n" );
}

// Mapping slug_room => [ image, driver, mode, description ]
$lab_mapping = array(

	// === Red Team : Attaque Web (OWASP Top 10) ===
	'authentification'                              => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'la-boutique-en-ligne-se-connecter-en-administrateur' => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'la-zone-administrateur-ce-quun-administrateur-voit' => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'le-top-10-owasp-et-la-surface-dattaque'        => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'securiser-une-application-web'                 => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'valider-les-entrees-le-premier-remede-anti-injection' => array('image' => 'vulnerables/web-dvwa', 'driver' => 'docker', 'mode' => 'single'),
	'la-page-qui-se-trahit'                         => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'la-requete-qui-ne-se-fie-a-personne'           => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'le-web-et-ses-regles-sop-csrf-et-sessions'     => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'hameconnage-lire-un-message-avant-de-cliquer'  => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'publier-en-ligne-ce-que-les-autres-voient-de-toi' => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),

	// === Red Team : Binaire / Mémoire / Overflow ===
	'debordement-de-tampon-lattaque-et-les-defenses' => array('image' => 'secura-lab-buffer-overflow', 'driver' => 'docker', 'mode' => 'single'),
	'deborder-la-pile-le-canari-et-loffset'         => array('image' => 'secura-lab-buffer-overflow', 'driver' => 'docker', 'mode' => 'single'),
	'le-binaire-qui-obeit-trop'                     => array('image' => 'secura-lab-buffer-overflow', 'driver' => 'docker', 'mode' => 'single'),
	'rop-construire-une-attaque-sans-shellcode'     => array('image' => 'secura-lab-buffer-overflow', 'driver' => 'docker', 'mode' => 'single'),
	'vulnerabilite-de-format-string-printf-qui-parle-trop' => array('image' => 'secura-lab-buffer-overflow', 'driver' => 'docker', 'mode' => 'single'),
	'x86-et-memoire-comprendre-la-pile'             => array('image' => 'secura-lab-buffer-overflow', 'driver' => 'docker', 'mode' => 'single'),
	'memoire-et-defenses'                           => array('image' => 'secura-lab-buffer-overflow', 'driver' => 'docker', 'mode' => 'single'),
	'traverser-le-mur'                              => array('image' => 'secura-lab-buffer-overflow', 'driver' => 'docker', 'mode' => 'single'),
	'qui-a-force-la-porte'                          => array('image' => 'secura-lab-buffer-overflow', 'driver' => 'docker', 'mode' => 'single'),

	// === Blue Team : Logs / Audit / Détection ===
	'journaux-et-audit-la-trace-qui-vaut-de-lor'    => array('image' => 'secura-lab-blue-log-analysis', 'driver' => 'docker', 'mode' => 'single'),
	'menaces-vulnerabilites-et-modele-de-menace'    => array('image' => 'secura-lab-blue-log-analysis', 'driver' => 'docker', 'mode' => 'single'),
	'hygiene-numerique-le-deuxieme-facteur'         => array('image' => 'secura-lab-blue-log-analysis', 'driver' => 'docker', 'mode' => 'single'),

	// === Blue Team : Firewall / Réseau ===
	'segmenter-isoler-pivoter-la-securite-reseau'   => array('image' => 'secura-lab-blue-firewall', 'driver' => 'docker', 'mode' => 'single'),
	'le-reseau-qui-parle-trop'                      => array('image' => 'secura-lab-blue-firewall', 'driver' => 'docker', 'mode' => 'single'),
	'les-fondamentaux-du-reseau'                    => array('image' => 'secura-lab-blue-firewall', 'driver' => 'docker', 'mode' => 'single'),
	'le-service-qui-ne-repond-plus'                 => array('image' => 'secura-lab-blue-firewall', 'driver' => 'docker', 'mode' => 'single'),

	// === Crypto / TLS / HTTPS ===
	'chiffrement-et-https'                          => array('image' => 'vulnerables/web-dvwa', 'driver' => 'docker', 'mode' => 'single'),
	'le-certificat-qui-ne-prouve-rien'              => array('image' => 'vulnerables/web-dvwa', 'driver' => 'docker', 'mode' => 'single'),
	'tls-et-https-le-chiffrement-qui-tient-la-route' => array('image' => 'vulnerables/web-dvwa', 'driver' => 'docker', 'mode' => 'single'),
	'sauthentifier-mot-de-passe-session-second-facteur' => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'mots-de-passe-la-longueur-bat-la-complexite'   => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'le-mot-de-passe-oublie'                        => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'architecture-de-confiance-separer-les-privileges' => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),

	// === Introduction / Bases ===
	'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'donnees-et-systemes-organiser-linformation'    => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'bac-a-sable-confiner-le-code-natif'            => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'penser-comme-un-defenseur'                     => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),

	// === Briefs (démo web) ===
	'brief-1-le-dojo-comment-on-sentraine'          => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'brief-2-le-web-comment-on-parle-a-un-serveur'  => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'brief-3-les-scenarios-dexploitation'           => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'brief-4-les-registres-le-carnet-du-processeur' => array('image' => 'secura-lab-buffer-overflow', 'driver' => 'docker', 'mode' => 'single'),
	'brief-5-ne-pas-se-faire-avoir'                 => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'brief-6-explorer-une-application-web'          => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),

	// === Ceintures (progression) ===
	'ceinture-blanche-lire-chercher-comprendre'     => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'ceinture-jaune-permissions-proprietaire-contenu' => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
	'ceinture-orange-reseau-processus-configuration' => array('image' => 'secura-lab-blue-firewall', 'driver' => 'docker', 'mode' => 'single'),
	'ceinture-verte-binaires-chaines-memoire'       => array('image' => 'secura-lab-buffer-overflow', 'driver' => 'docker', 'mode' => 'single'),
	'ceinture-noire-cryptographie-cles-empreintes'  => array('image' => 'vulnerables/web-dvwa', 'driver' => 'docker', 'mode' => 'single'),

	// === Kahoot (révision) ===
	'kahoot-la-revision-des-labs-avances'           => array('image' => 'bkimminich/juice-shop', 'driver' => 'docker', 'mode' => 'single'),
);

$count_configured = 0;
$count_missing = 0;

foreach ( $lab_mapping as $slug => $lab ) {
	$room = get_page_by_path( $slug, OBJECT, SECURA_POST_TYPE );
	if ( ! $room ) {
		echo "⚠️  Room non trouvée : $slug\n";
		$count_missing++;
		continue;
	}

	update_post_meta( $room->ID, '_secura_lab', array(
		'enabled'  => true,
		'driver'   => $lab['driver'],
		'mode'     => $lab['mode'],
		'image'    => $lab['image'],
		'network'  => 'seca_lab',
	) );

	$count_configured++;
	echo "✅ Room {$room->ID} ({$slug}) => lab {$lab['image']}\n";
}

echo "\n=== RÉSUMÉ ===\n";
echo "Rooms configurées : $count_configured\n";
echo "Rooms manquantes  : $count_missing\n";
echo "Total rooms dans le mapping : " . count( $lab_mapping ) . "\n";
