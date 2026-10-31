<?php
/**
 * Contenu par défaut créé à l'activation du plugin.
 *
 * Les 6 rooms ci-dessous sont des exercices originaux d'introduction,
 * rédigés en français. Ils ne sont ni un cours MIT, ni une adaptation
 * autorisée de supports MIT, ni une reproduction de contenus TryHackMe.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Retourne le jeu de rooms de démonstration.
 *
 * @return array
 */
function seca_default_rooms() {
	return array(
		array(
			'title'       => 'Penser comme un défenseur',
			'excerpt'     => 'Adoptez les bons réflexes : posture de défenseur, surface d\'attaque, moindre privilège et réaction à un incident.',
			'difficulty'  => 'facile',
			'duration'    => 20,
			'xp_bonus'    => 25,
			'content'     => "Bienvenue dans votre première room.\n\nAvant de manier un outil, un défenseur doit savoir ce qu'il protège, ce qu'il surveille et comment il réagit à un incident. Cette room est un parcours guidé de quatre questions, entirely réalisé dans votre navigateur : aucune machine n'est exécutée et aucun terminal réel n'est lancé.\n\nPrenez le temps de lire chaque question avant de répondre : la réponse se cherche, elle ne se devine pas.",
			'questions'   => array(
				array(
					'question' => 'Quel est le premier réflexe d\'un défenseur lorsqu\'il reçoit une alerte de sécurité ?',
					'answers'  => array( 'Collecter des informations', 'Collecter de l\'information', 'Réunir des informations' ),
					'xp'        => 10,
					'hint'      => 'On ne réagit pas à l\'aveugle : on commence par comprendre.',
				),
				array(
					'question' => 'Que signifie le principe du moindre privilège ?',
					'answers'  => array( 'N\'accorder que les droits nécessaires', 'Accorder uniquement les droits nécessaires', 'Le moindre privilège' ),
					'xp'        => 10,
					'hint'      => 'Pensez à la surface d\'exposition d\'un compte.',
				),
				array(
					'question' => 'En sécurité, que désigne la « surface d\'attaque » ?',
					'answers'  => array( 'L\'ensemble des points d\'entrée accessibles', 'La somme des points d\'entrée', 'Les points d\'entrée accessibles' ),
					'xp'        => 15,
					'hint'      => 'Ports, URL, comptes, API : tout ce qui peut être sollicité.',
				),
				array(
					'question' => 'Quel document décrit les procédures à suivre lorsqu\'un incident est détecté ?',
					'answers'  => array( 'Le plan de réponse à incident', 'La procédure de réponse à incident', 'Le plan d\'incident', 'La procédure d\'incident' ),
					'xp'        => 15,
					'hint'      => 'On y trouve généralement qui fait quoi, et dans quel ordre.',
				),
			),
		),
		array(
			'title'       => 'Les fondamentaux du réseau',
			'excerpt'     => 'Comprenez comment circulent les données : couches OSI, adresses, ports et rôle du pare-feu.',
			'difficulty'  => 'facile',
			'duration'    => 25,
			'xp_bonus'    => 25,
			'content'     => "Un réseau, ce n'est pas une boîte noire : chaque trame voyage en couches, du câble au routeur, puis jusqu'à l'application.\n\nCette room suit le trajet d'un paquet. Vous n'utilisez aucun outil de scan : vous identifiez le bon vocabulaire pour décrire ce qui se passe.",
			'questions'   => array(
				array(
					'question' => 'Sur quelle couche du modèle OSI se trouve le protocole TCP ?',
					'answers'  => array( 'Couche 4', 'La couche 4', 'Couche transport', 'La couche transport', 'Transport' ),
					'xp'        => 10,
					'hint'      => 'Comptez : 1 physique, 2 liaison, 3 réseau, 4…',
				),
				array(
					'question' => 'Quelle adresse identifie physiquement une carte réseau sur un réseau local ?',
					'answers'  => array( 'L\'adresse MAC', 'Adresse MAC', 'L\'adresse mac' ),
					'xp'        => 10,
					'hint'      => 'Six octets, gravés dans la carte.',
				),
				array(
					'question' => 'Quel protocole est utilisé sur le port 443 ?',
					'answers'  => array( 'HTTPS', 'https', 'Le protocole HTTPS' ),
					'xp'        => 10,
					'hint'      => 'C\'est la version chiffrée du web.',
				),
				array(
					'question' => 'Quel est le rôle principal d\'un pare-feu (firewall) ?',
					'answers'  => array( 'Filtrer le trafic réseau', 'Filtrer le trafic', 'Bloquer ou autoriser le trafic réseau' ),
					'xp'        => 15,
					'hint'      => 'Il autorise, refuse ou journalise les flux.',
				),
			),
		),
		array(
			'title'       => 'Sécuriser une application web',
			'excerpt'     => 'Injections SQL, XSS, CSRF : identifiez les failles web classiques et leurs parades.',
			'difficulty'  => 'moyen',
			'duration'    => 35,
			'xp_bonus'    => 40,
			'content'     => "La majorité des applications métier tournent sur le web, et la majorité des incidents applicatifs viennent de quelques familles de failles seulement.\n\nCette room met en scène quatre situations d'attaque web. Vous devez nommer la faille et, dans la plupart des cas, la parade associée. Aucun code n'est exécuté de votre côté.",
			'questions'   => array(
				array(
					'question' => 'Quelle pratique protège une requête SQL contre l\'injection de code ?',
					'answers'  => array( 'Les requêtes paramétrées', 'Requêtes paramétrées', 'La préparation de requêtes', 'Requêtes préparées', 'Les requêtes préparées' ),
					'xp'        => 15,
					'hint'      => 'Les données ne sont jamais concaténées dans la requête.',
				),
				array(
					'question' => 'Comment se nomme l\'attaque qui consiste à voler la session d\'un utilisateur authentifié ?',
					'answers'  => array( 'Le vol de session', 'Vol de session', 'Le détournement de session', 'Session hijacking', 'Le hijacking de session' ),
					'xp'        => 15,
					'hint'      => 'Le jeton d\'authentification circule et change de porteur.',
				),
				array(
					'question' => 'À quoi sert l\'en-tête de sécurité « Content-Security-Policy » (CSP) ?',
					'answers'  => array( 'Restreindre les sources de chargement', 'Restreindre les sources autorisées', 'Limiter les sources de chargement', 'Restreindre les ressources chargées' ),
					'xp'        => 15,
					'hint'      => 'Il dit au navigateur d\'où il a le droit de charger du contenu.',
				),
				array(
					'question' => 'Quel principe impose de ne jamais faire confiance aux données reçues d\'un client ?',
					'answers'  => array( 'La validation des entrées', 'Valider les entrées', 'La validation des entrées', 'Le filtrage des entrées' ),
					'xp'        => 15,
					'hint'      => 'Côté serveur, jamais côté navigateur.',
				),
			),
		),
		array(
			'title'       => 'Mémoire et défenses',
			'excerpt'     => 'Dépassement de tampon, NX, ASLR, canary : comprenez les contrôles qui protègent la mémoire.',
			'difficulty'  => 'moyen',
			'duration'    => 30,
			'xp_bonus'    => 40,
			'content'     => "Pendant des décennies, l'écart entre « le programme écrit » et « la mémoire réellement utilisée » a été la faille numéro un des systèmes.\n\nCette room explique le mécanisme du dépassement de tampon, puis les quatre défenses qui en limitent l'exploitation. Le propos est pédagogique : vous n'exploitez rien, vous apprenez à reconnaître la faille et à nommer la contre-mesure.",
			'questions'   => array(
				array(
					'question' => 'Comment se nomme la technique qui écrase la pile d\'exécution pour détourner le contrôle du programme ?',
					'answers'  => array( 'Le dépassement de tampon', 'Dépassement de tampon', 'Buffer overflow', 'Le dépassement de tampon (buffer overflow)' ),
					'xp'        => 15,
					'hint'      => 'On écrit plus que prévu dans un tampon trop petit.',
				),
				array(
					'question' => 'Quelle défense rend la pile non exécutable ?',
					'answers'  => array( 'NX', 'No-Execute', 'Le bit NX', 'NX (No-Execute)', 'La protection NX' ),
					'xp'        => 15,
					'hint'      => 'Une pile où l\'on ne peut pas exécuter de code.',
				),
				array(
					'question' => 'Que permet la défense « ASLR » ?',
					'answers'  => array( 'Randomiser les adresses mémoire', 'La randomisation des adresses mémoire', 'Randomiser la disposition de la mémoire' ),
					'xp'        => 15,
					'hint'      => 'Les adresses changent à chaque exécution.',
				),
				array(
					'question' => 'Quel est le rôle d\'un « canary » (cookie de pile) ?',
					'answers'  => array( 'Vérifier l\'intégrité de la pile', 'Détecter la corruption de la pile', 'Détecter les dépassements de tampon', 'Vérifier l\'intégrité de la pile' ),
					'xp'        => 15,
					'hint'      => 'Une valeur sentinelle placée entre les données et le retour d\'appel.',
				),
			),
		),
		array(
			'title'       => 'Authentification',
			'excerpt'     => 'Mots de passe, MFA, hachage salé : durcissez la preuve d\'identité des utilisateurs.',
			'difficulty'  => 'moyen',
			'duration'    => 30,
			'xp_bonus'    => 40,
			'content'     => "L'authentification est la porte d'entrée : le reste de la sécurité repose sur la qualité de cette porte.\n\nCette room traite du stockage des mots de passe, de la réutilisation d'identifiants et des secondes.factoriels. Vous identifiez les faiblesses, vous nommez les parades.",
			'questions'   => array(
				array(
					'question' => 'Que signifie l\'acronyme MFA dans le contexte de l\'authentification ?',
					'answers'  => array( 'L\'authentification multifacteur', 'Authentification multifacteur', 'Lauthentification multifacteur', 'Multi-factor authentication' ),
					'xp'        => 15,
					'hint'      => 'Plusieurs éléments de preuve, de natures différentes.',
				),
				array(
					'question' => 'Comment se nomme l\'attaque qui consiste à tester des couples identifiant / mot de passe volés sur un autre service ?',
					'answers'  => array( 'Le credential stuffing', 'Credential stuffing', 'La réutilisation d\'identifiants', 'Le bourrage d\'identifiants' ),
					'xp'        => 15,
					'hint'      => 'Le même mot de passe est réutilisé ailleurs.',
				),
				array(
					'question' => 'Quel algorithme de hachage est conçu pour être volontairement lent et salé ?',
					'answers'  => array( 'bcrypt', 'argon2', 'Argon2', 'Bcrypt', 'scrypt' ),
					'xp'        => 15,
					'hint'      => 'La lenteur est ici une fonctionnalité, pas un défaut.',
				),
				array(
					'question' => 'Quelle garantie apporte une signature numérique ?',
					'answers'  => array( 'L\'intégrité et l\'authenticité du message', 'L\'intégrité et l\'authenticité', 'Garantir l\'intégrité et l\'authenticité', 'L\'intégrité du message et l\'authenticité de l\'auteur' ),
					'xp'        => 15,
					'hint'      => 'Deux propriétés : rien n\'a bougé, et cela vient bien de l\'expéditeur.',
				),
			),
		),
		array(
			'title'       => 'Chiffrement et HTTPS',
			'excerpt'     => 'Symétrique, asymétrique, hachage : les briques du chiffrement et la mécanique de TLS.',
			'difficulty'  => 'difficile',
			'duration'    => 40,
			'xp_bonus'    => 60,
			'content'     => "Le chiffrement protège les données en transit et au repos, à condition de choisir la bonne primitive et de la combiner correctement.\n\nCette room termine le parcours : elle relie le hachage, le chiffrement symétrique, le chiffrement asymétrique et l'échange de clés. Elle est volontairement plus exigeante que les précédentes.",
			'questions'   => array(
				array(
					'question' => 'Quelle propriété garantit qu\'un message chiffré n\'a pas été modifié en route ?',
					'answers'  => array( 'L\'intégrité', 'L\'intégrité du message', 'L\'authentification', 'Le contrôle d\'intégrité' ),
					'xp'        => 20,
					'hint'      => 'Le chiffrement seul ne suffit pas : il faut prouver que rien n\'a changé.',
				),
				array(
					'question' => 'Quel algorithme est un chiffrement symétrique (clé unique) ?',
					'answers'  => array( 'AES', 'Aes', 'ChaCha20', 'AES-256' ),
					'xp'        => 20,
					'hint'      => 'La même clé chiffre et déchiffre.',
				),
				array(
					'question' => 'Quel protocole négocie et sécurise un canal chiffré entre un client et un serveur ?',
					'answers'  => array( 'TLS', 'Le protocole TLS', 'SSL/TLS', 'Le TLS' ),
					'xp'        => 20,
					'hint'      => 'C\'est lui qui est en place derrière le petit cadenas du navigateur.',
				),
				array(
					'question' => 'Quel algorithme permet à deux parties d\'établir une clé secrète sur un canal non sécurisé ?',
					'answers'  => array( 'Diffie-Hellman', 'L\'algorithme Diffie-Hellman', 'Diffie Hellman', 'LeDiffie-Hellman' ),
					'xp'        => 20,
					'hint'      => 'Chacun combine son secret avec la valeur publique de l\'autre.',
				),
			),
		),
	);
}
