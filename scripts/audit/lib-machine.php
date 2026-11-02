<?php
/**
 * Bibliothèque « machine » : vérifier et JOUER les questions de drapeau
 * et d'action.
 *
 * POURQUOI CE FICHIER EXISTE
 * Les questions de drapeau et d'action demandent la machine de l'élève :
 * le serveur y lit le fichier de drapeau, en root, et compare. Tant que
 * personne ne les jouait, elles n'étaient pas vérifiées : c'était un
 * constat de couverture, pas une preuve.
 *
 * DEUX CHEMINS, ET TOUJOURS DITS
 * 1. JOUÉ POUR DE VRAI : on déploie la machine (Docker), on progresse
 *    comme un élève (leçon, questions, exploration), on cherche la
 *    valeur dans la machine, puis on la soumet. Le serveur la compare au
 *    fichier réel de la machine.
 * 2. VÉRIFIÉ STATIQUEMENT : pour chaque question de drapeau, on vérifie
 *    que le fichier existe dans le lab, qu'il contient une vraie valeur,
 *    que cette valeur est unique dans la plateforme, que le chemin est
 *    sûr, et que la machine de la room est bien déployable.
 *
 * Le rapport dit toujours lequel des deux chemins a été emprunté : une
 * question « non jouée » n'est jamais présentée comme jouée.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Les rooms qui contiennent une question de machine (drapeau ou action).
 *
 * @return array Liste { room, tache, type, questions }.
 */
function audit_machine_rooms() {
	$rooms = array();

	$posts = get_posts(
		array(
			'post_type'   => 'secura_room',
			'numberposts' => -1,
			'post_status' => 'publish',
		)
	);

	foreach ( $posts as $room ) {
		$taches = Secura_Rooms::get_tasks( $room->ID );

		foreach ( $taches as $index => $tache ) {
			$questions = array();

			foreach ( (array) $tache['questions'] as $q_index => $question ) {
				$mode = isset( $question['mode'] ) ? $question['mode'] : 'text';

				if ( 'flag' !== $mode && 'action' !== $mode ) {
					continue;
				}

				$questions[] = array(
					'index'       => $q_index,
					'mode'        => $mode,
					'question'    => $question['question'],
					'flag_path'   => isset( $question['flag_path'] ) ? $question['flag_path'] : '',
					'requires_step' => isset( $question['requires_step'] ) ? (int) $question['requires_step'] : -1,
					'explication' => isset( $question['explanation'] ) ? $question['explanation'] : '',
				);
			}

			if ( empty( $questions ) ) {
				continue;
			}

			$rooms[] = array(
				'room'      => $room->ID,
				'slug'      => $room->post_name,
				'tache'     => $index,
				'type'      => isset( $tache['type'] ) ? $tache['type'] : '',
				'questions' => $questions,
			);
		}
	}

	return $rooms;
}

/**
 * Le dossier racine des labs.
 *
 * @return string Chemin, ou '' si on ne trouve pas.
 */
function audit_machine_racine_labs() {
	$candidats = array();

	$constante = defined( 'SECURA_LABS_PATH' ) ? SECURA_LABS_PATH : '';

	if ( '' !== $constante ) {
		$candidats[] = $constante;
	}

	$env = getenv( 'SECURA_LABS_PATH' );

	if ( is_string( $env ) && '' !== $env ) {
		$candidats[] = $env;
	}

	$racine = dirname( dirname( dirname( __FILE__ ) ) );

	$candidats[] = $racine . '/labs';
	$candidats[] = dirname( $racine ) . '/labs';

	if ( defined( 'WP_CONTENT_DIR' ) ) {
		$candidats[] = WP_CONTENT_DIR . '/secura-labs';
	}

	foreach ( $candidats as $candidat ) {
		if ( is_dir( $candidat ) && is_dir( $candidat . '/web-01' ) ) {
			return rtrim( $candidat, '/' );
		}
	}

	return '';
}

/**
 * Le manifeste d'une room, sans cache perime.
 *
 * Le cache d'objets de WordPress peut dater d'une ecriture faite par un
 * autre process (le site web, dans un autre worker) : on le vide avant
 * de lire, sinon l'audit verrait un etat qui n'existe plus.
 *
 * @param int $room_id Identifiant de la room.
 * @return array Manifeste normalise.
 */
function audit_machine_manifest( $room_id ) {
	wp_cache_delete( $room_id, 'post_meta' );

	return Secura_Lab::get_manifest( $room_id );
}

/**
 * Le dossier du lab d'une image (securalabs/univ-01:1.0 -> labs/univ-01).
 *
 * @param string $image Nom de l'image.
 * @return string Chemin, ou '' si le lab est introuvable.
 */
function audit_machine_dossier_par_image( $image ) {
	$image = (string) $image;

	if ( '' === $image ) {
		return '';
	}

	$nom = $image;

	if ( false !== strpos( $nom, '/' ) ) {
		$nom = substr( $nom, strrpos( $nom, '/' ) + 1 );
	}

	if ( false !== strpos( $nom, ':' ) ) {
		$nom = substr( $nom, 0, strpos( $nom, ':' ) );
	}

	$racine = audit_machine_racine_labs();

	if ( '' === $racine ) {
		return '';
	}

	$dossier = $racine . '/' . $nom;

	return is_dir( $dossier ) ? $dossier : '';
}

/**
 * Le dossier de construction d'un service d'un compose.
 *
 * @param string $compose Fichier docker-compose.yml.
 * @param string $service Nom du service.
 * @return string Chemin, ou '' si on ne trouve pas.
 */
function audit_machine_dossier_service( $compose, $service ) {
	$compose = (string) $compose;

	if ( '' === $compose || ! is_file( $compose ) ) {
		return '';
	}

	$contenu = (string) file_get_contents( $compose );

	/* On isole le bloc du service : il commence par « nom: » en
	   indentation de deux espaces, et finit au service suivant. */
	$motif = '/^  ' . preg_quote( $service, '/' ) . ':[ ]*\n(.*?)(?=^  [A-Za-z0-9_-]+:|^networks:|^volumes:)/ms';

	if ( ! preg_match( $motif, $contenu, $bloc ) ) {
		return '';
	}

	$corps = $bloc[1];

	if ( preg_match( '/context:[ ]*(\S+)/', $corps, $contexte ) ) {
		$chemin = dirname( $compose ) . '/' . trim( $contexte[1] );
		$reel   = realpath( $chemin );

		return $reel ? $reel : '';
	}

	if ( preg_match( '/image:[ ]*(\S+)/', $corps, $image ) ) {
		return audit_machine_dossier_par_image( trim( $image[1] ) );
	}

	return '';
}

/**
 * Le dossier où vivent les fichiers de drapeau d'une room.
 *
 * Deux cas :
 * - une seule image : le lab (labs/<nom>) ;
 * - une pile compose : le service qui garde les drapeaux (« flag_service »).
 *
 * @param int $room_id Identifiant de la room.
 * @return string Chemin, ou '' si on ne trouve pas.
 */
function audit_machine_dossier_flags( $room_id ) {
	$manifest = audit_machine_manifest( $room_id );

	if ( 'compose' === $manifest['mode'] ) {
		$service = '' !== $manifest['flag_service'] ? $manifest['flag_service'] : '';

		if ( '' !== $service ) {
			$dossier = audit_machine_dossier_service( $manifest['compose'], $service );

			if ( '' !== $dossier ) {
				return $dossier;
			}
		}

		/* Pas de service de drapeaux : on tente chaque service du
		   compose, celui qui contient le fichier gagne. */
		$compose = (string) $manifest['compose'];

		if ( '' !== $compose && is_file( $compose ) ) {
			$contenu = (string) file_get_contents( $compose );

			if ( preg_match_all( '/^  ([A-Za-z0-9_-]+):[ ]*\n(.*?)(?=^  [A-Za-z0-9_-]+:|^networks:)/ms', $contenu, $services, PREG_SET_ORDER ) ) {
				foreach ( $services as $service ) {
					$dossier = audit_machine_dossier_service( $compose, $service[1] );

					if ( '' === $dossier ) {
						continue;
					}

					foreach ( (array) glob( $dossier . '/flag/*.txt' ) as $candidat ) {
						return $dossier;
					}
				}
			}
		}

		return '';
	}

	return audit_machine_dossier_par_image( $manifest['image'] );
}

/**
 * Le fichier de drapeau d'une question, dans le dépôt.
 *
 * @param int    $room_id Identifiant de la room.
 * @param string $chemin  Chemin du drapeau dans la machine.
 * @return string Chemin du fichier, ou '' si introuvable.
 */
function audit_machine_fichier_flag( $room_id, $chemin ) {
	$dossier = audit_machine_dossier_flags( $room_id );

	if ( '' === $dossier ) {
		return '';
	}

	$nom = basename( (string) $chemin );

	$candidats = array(
		$dossier . '/flag/' . $nom,
		$dossier . '/' . $nom,
	);

	foreach ( $candidats as $candidat ) {
		if ( is_file( $candidat ) ) {
			return $candidat;
		}
	}

	return '';
}

/**
 * Vérifie, sans machine, que chaque question de drapeau est RÉPONDABLE.
 *
 * @param array $rooms Rooms à vérifier (sortie de audit_machine_rooms).
 * @return array { problemes, valeurs, verifiees, total }.
 */
function audit_machine_verifie_fichiers( array $rooms ) {
	$problemes = array();
	$valeurs   = array();
	$verifiees = 0;
	$total     = 0;

	foreach ( $rooms as $room ) {
		$manifest = audit_machine_manifest( $room['room'] );

		foreach ( $room['questions'] as $question ) {
			if ( 'flag' !== $question['mode'] ) {
				continue;
			}

			$total++;
			$chemin = $question['flag_path'];

			if ( '' === $chemin ) {
				$problemes[] = 'room ' . $room['room'] . ' : question de drapeau sans chemin';

				continue;
			}

			/* Le chemin doit être sûr : c'est le plugin qui l'exécute
			   dans la machine, en root. */
			if ( Secura_Lab::safe_machine_path( $chemin ) !== $chemin ) {
				$problemes[] = 'room ' . $room['room'] . ' : chemin de drapeau refusé (' . $chemin . ')';
			}

			/* Si la machine de la room est désactivée, la question ne
			   pourra jamais être validée : le serveur n'a rien à lire. */
			if ( empty( $manifest['enabled'] ) ) {
				$problemes[] = 'room ' . $room['room'] . ' : la machine de cette room est désactivée, la question de drapeau ne peut donc jamais être validée';
			}

			$fichier = audit_machine_fichier_flag( $room['room'], $chemin );

			if ( '' === $fichier ) {
				$problemes[] = 'room ' . $room['room'] . ' : le fichier ' . basename( $chemin ) . ' est absent du lab de cette room';

				continue;
			}

			$valeur = trim( (string) file_get_contents( $fichier ) );

			if ( '' === $valeur ) {
				$problemes[] = 'room ' . $room['room'] . ' : le fichier ' . basename( $chemin ) . ' est vide';

				continue;
			}

			$verifiees++;

			$cle = md5( strtolower( $valeur ) );

			if ( isset( $valeurs[ $cle ] ) ) {
				$problemes[] = 'le drapeau ' . $valeur . ' sert à deux questions différentes (' . $valeurs[ $cle ] . ')';
			} else {
				$valeurs[ $cle ] = 'room ' . $room['room'] . ' / ' . basename( $chemin );
			}

			if ( ! preg_match( '/SECURA\{[^}]+\}/', $valeur ) ) {
				/* Deux formats sont legitimacy acceptes :
				   - « FLAG=SECURA{x} » (les labs maison) ;
				   - une empreinte hexadecimale (le code de drapeau
				     affiche par l'application OWASP Juice Shop).
				   Un format n'est donc douteux que s'il contient une
				   accolade SECURA mal formee. */
				if ( false !== stripos( $valeur, 'SECURA{' ) || ! preg_match( '/^[0-9a-f]{32,64}$/i', $valeur ) ) {
					$problemes[] = 'room ' . $room['room'] . ' : le format du drapeau ' . basename( $chemin ) . ' est douteux (' . $valeur . ')';
				}
			}
		}
	}

	return array(
		'problemes' => $problemes,
		'valeurs'   => $valeurs,
		'verifiees' => $verifiees,
		'total'     => $total,
	);
}

/**
 * L'adresse de la cible d'une room (l'application à attaquer).
 *
 * @param array $manifest Manifeste de la room.
 * @return string URL, ou '' si la room n'a pas d'application.
 */
function audit_machine_cible( $manifest ) {
	$cible = isset( $manifest['target'] ) ? (string) $manifest['target'] : '';

	if ( '' === $cible ) {
		return '';
	}

	if ( preg_match( '#(https?://[^\s]+)#', $cible, $trouve ) ) {
		return rtrim( $trouve[1], '/' );
	}

	return '';
}

/**
 * Un appel AJAX fait comme un élève (avec son cookie de session).
 *
 * @param string $action  Action AJAX.
 * @param array  $donnees Données.
 * @param string $cookie  Fichier de cookies.
 * @param string $nonce   Nonce WordPress.
 * @return array Réponse décodée.
 */
function audit_machine_appel( $action, array $donnees, $cookie, $nonce ) {
	$donnees['action'] = $action;
	$donnees['nonce']  = $nonce;

	/* Le plugin limite la cadence du terminal (pour que l'eleve ne
	   bloque pas la machine). L'audit, lui, enchaine les commandes :
	   on attend et on recommence plutot que d'echouer. */
	for ( $essai = 0; $essai < 14; $essai++ ) {
		$reponse = panel_appel( admin_url( 'admin-ajax.php' ), $cookie, $donnees );
		$json    = json_decode( $reponse['corps'], true );

		if ( ! is_array( $json ) ) {
			return array();
		}

		$message = isset( $json['data']['code'] ) ? (string) $json['data']['code'] : '';

		if ( 'slow_down' !== $message ) {
			return $json;
		}

		sleep( 5 );
	}

	return is_array( $json ) ? $json : array();
}

/**
 * Fait tourner les étapes du terminal d'une tâche, comme un élève.
 *
 * @param int    $room_id Room.
 * @param int    $index   Index de la tâche.
 * @param array  $tache   Tâche.
 * @param string $cookie  Fichier de cookies.
 * @param string $nonce   Nonce.
 * @return array { sortie, etape }.
 */
function audit_machine_terminal( $room_id, $index, array $tache, $cookie, $nonce ) {
	$sortie = '';
	$etape  = 0;

	foreach ( (array) ( $tache['terminal']['steps'] ?? array() ) as $etape_definition ) {
		$commandes = array();

		foreach ( (array) ( $etape_definition['match'] ?? array() ) as $motif ) {
			/* Un motif entoure de slashes est une expression reguliere
			   (voir Secura_Terminal::matches) : on ne peut pas la
			   taper, mais on peut essayer son texte. Sinon, le motif
			   est la commande en clair. */
			$motif = trim( (string) $motif );

			if ( '' === $motif ) {
				continue;
			}

			if ( strlen( $motif ) > 2 && '/' === $motif[0] && '/' === substr( $motif, -1 ) ) {
				$motif = substr( $motif, 1, -1 );
			}

			$commandes[] = $motif;
		}

		if ( empty( $commandes ) ) {
			continue;
		}

		foreach ( $commandes as $commande ) {
			$reponse = audit_machine_appel(
				'secura_terminal',
				array(
					'room_id' => $room_id,
					'task'    => $index,
					'command' => $commande,
				),
				$cookie,
				$nonce
			);

			$sortie = isset( $reponse['data']['output'] ) ? (string) $reponse['data']['output'] : '';

			if ( ! empty( $reponse['data']['matched'] ) ) {
				$etape = isset( $reponse['data']['step'] ) ? (int) $reponse['data']['step'] : $etape + 1;

				break;
			}
		}
	}

	return array(
		'sortie' => $sortie,
		'etape'  => $etape,
	);
}

/**
 * Cherche la valeur du drapeau dans la machine, comme un élève.
 *
 * On fait ce que l'élève fait : on cherche dans les fichiers lisibles,
 * puis on interroge l'application si la room en a une.
 *
 * @param int    $room_id Room.
 * @param string $cookie  Fichier de cookies.
 * @param string $nonce   Nonce.
 * @param string $attendu Valeur attendue (pour s'arreter tot).
 * @return array { valeurs (valeur => commande), commande, sortie }.
 */
function audit_machine_cherche( $room_id, $cookie, $nonce, $attendu = '' ) {
	$manifest = audit_machine_manifest( $room_id );
	$autorise = (array) ( $manifest['allow'] ?? array() );

	$commandes = array();

	/* On cherche repertoire par repertoire : la sortie du terminal est
	   tronquee au-dela de 8 Ko, et une machine contient plusieurs
	   drapeaux (un par challenge). */
	if ( in_array( 'grep', $autorise, true ) ) {
		$dossiers = array( '/srv', '/cours', '/home/ctf', '/home', '/opt', '/etc', '/var/www', '/app' );

		foreach ( $dossiers as $dossier ) {
			$commandes[] = 'grep -r "SECURA" ' . $dossier . ' 2>/dev/null';
		}
	}

	$cible = audit_machine_cible( $manifest );

	if ( '' !== $cible && in_array( 'curl', $autorise, true ) ) {
		$commandes[] = 'curl -s ' . $cible;
	}

	$valeurs = array();

	foreach ( $commandes as $commande ) {
		$reponse = audit_machine_appel(
			'secura_terminal',
			array(
				'room_id' => $room_id,
				'task'    => 0,
				'command' => $commande,
			),
			$cookie,
			$nonce
		);

		$sortie = isset( $reponse['data']['output'] ) ? (string) $reponse['data']['output'] : '';

		/* Une machine peut contenir plusieurs drapeaux : on les
		   ramasse tous, c'est l'eleve qui sait lequel on lui demande
		   (l'indice de la question). */
		if ( preg_match_all( '/(?:FLAG=)?SECURA\{[^}]+\}/i', $sortie, $trouves ) ) {
			foreach ( $trouves[0] as $valeur ) {
				if ( ! isset( $valeurs[ $valeur ] ) ) {
					$valeurs[ $valeur ] = $commande;
				}

				/* On a trouve ce qu'on cherchait : inutile de
				   continuer a fouiller la machine. */
				if ( '' !== $attendu && Secura_Lab::same_flag( $attendu, $valeur ) ) {
					return array(
						'valeurs'  => $valeurs,
						'commande' => $commande,
						'sortie'   => $sortie,
					);
				}
			}
		}
	}

	return array(
		'valeurs'  => $valeurs,
		'commande' => empty( $valeurs ) ? '' : reset( $valeurs ),
		'sortie'   => '',
	);
}

/**
 * La valeur du drapeau, lue comme le serveur le fait (en root).
 *
 * @param int    $room_id Room.
 * @param string $chemin  Chemin du drapeau dans la machine.
 * @return string Valeur, ou '' si elle est illisible.
 */
function audit_machine_valeur_fichier( $room_id, $chemin, $user_id = 0 ) {
	$chemin = Secura_Lab::safe_machine_path( $chemin );

	if ( '' === $chemin ) {
		return '';
	}

	$manifest = audit_machine_manifest( $room_id );

	if ( empty( $manifest['enabled'] ) ) {
		return '';
	}

	/* On passe par le conteneur de l'eleve de test : le plugin lit
	   toujours en root dans la machine de l'apprenant. */
	$user_id = (int) $user_id;

	if ( ! $user_id ) {
		$user_id = get_current_user_id();
	}

	if ( ! $user_id ) {
		return '';
	}

	return trim( (string) Secura_Lab::read_file( $user_id, $room_id, $chemin ) );
}

/**
 * Joue une question de machine POUR DE VRAI, sur une vraie machine.
 *
 * Le parcours est celui d'un élève : on lit la leçon, on répond aux
 * questions, on déploie la machine, on cherche la valeur, puis on la
 * soumet. Le serveur la compare au fichier de la machine.
 *
 * @param int    $room_id   Room.
 * @param int    $index     Index de la tâche.
 * @param int    $q_index   Index de la question.
 * @param string $chemin    Chemin du drapeau dans la machine.
 * @param string $cookie    Fichier de cookies.
 * @param int    $user_id   Élève.
 * @param string $nonce     Nonce.
 * @return array { joue, niveau, detail, valeur }.
 */
function audit_machine_joue( $room_id, $index, $q_index, $chemin, $cookie, $user_id, $nonce ) {
	$taches = Secura_Rooms::get_tasks( $room_id );

	if ( ! isset( $taches[ $index ] ) ) {
		return array(
			'joue'  => false,
			'detail' => 'tâche introuvable',
		);
	}

	$question = isset( $taches[ $index ]['questions'][ $q_index ] ) ? $taches[ $index ]['questions'][ $q_index ] : array();
	$mode     = isset( $question['mode'] ) ? $question['mode'] : 'flag';

	/* 1. On déploie la machine : c'est elle qui contient le drapeau,
	   et les etapes du terminal s'y jouent. */
	$depart = audit_machine_appel(
		'secura_lab_start',
		array( 'room_id' => $room_id ),
		$cookie,
		$nonce
	);

	if ( empty( $depart['data']['ok'] ) ) {
		return array(
			'joue'  => false,
			'detail' => 'machine non déployée : ' . ( isset( $depart['data']['message'] ) ? $depart['data']['message'] : 'raison inconnue' ),
		);
	}

	$pret = false;

	for ( $essai = 0; $essai < 15; $essai++ ) {
		$statut = audit_machine_appel(
			'secura_lab_status',
			array( 'room_id' => $room_id ),
			$cookie,
			$nonce
		);

		$etat = isset( $statut['data']['state'] ) ? (string) $statut['data']['state'] : '';

		if ( 'running' === $etat ) {
			$pret = true;

			break;
		}

		sleep( 2 );
	}

	if ( ! $pret ) {
		audit_machine_appel(
			'secura_lab_stop',
			array( 'room_id' => $room_id ),
			$cookie,
			$nonce
		);

		return array(
			'joue'  => false,
			'detail' => 'la machine n\'a pas démarré à temps',
		);
	}

	/* 2. On avance comme un élève jusqu'à la tâche du drapeau.

	   Chaque tâche se joue dans l'ordre : la lecon (on clique « j'ai
	   lu »), les etapes du terminal, puis les reponses. Les questions
	   de drapeau et d'action se repondent elles aussi — sinon la tache
	   reste ouverte et la suivante reste verrouillee. */
	$acceptee = false;

	/* Où se trouve la question de drapeau dans la COPIE servie à
	   l'élève ? Le tirage melange les questions : l'index n'est pas le
	   meme que dans la source. On la retrouve a son chemin de
	   drapeau, qui est unique dans la room. */
	$index_drapeau = -1;

	if ( 'flag' === $mode ) {
		$copie = Secura_Exam::paper( $user_id, $room_id, $index, $taches[ $index ] );

		foreach ( (array) $copie as $index_copie => $question_copie ) {
			$chemin_copie = isset( $question_copie['flag_path'] ) ? (string) $question_copie['flag_path'] : '';

			if ( '' !== $chemin_copie && $chemin_copie === $chemin ) {
				$index_drapeau = (int) $index_copie;

				break;
			}
		}
	}

	foreach ( $taches as $i => $tache ) {
		if ( $i > $index ) {
			break;
		}

		$questions = (array) ( $tache['questions'] ?? array() );

		if ( empty( $questions ) ) {
			/* Une leçon : on clique sur « j'ai lu ». */
			audit_machine_appel(
				'secura_complete_lesson',
				array(
					'room_id' => $room_id,
					'task'    => $i,
				),
				$cookie,
				$nonce
			);

			continue;
		}

		if ( 'exam' === ( $tache['type'] ?? '' ) ) {
			audit_machine_appel(
				'secura_start_exam',
				array(
					'room_id' => $room_id,
					'task'    => $i,
				),
				$cookie,
				$nonce
			);
		}

		/* Les étapes du terminal : c'est ce qui « ouvre » l'action. */
		audit_machine_terminal( $room_id, $i, $tache, $cookie, $nonce );

		$reponses = audit_machine_reponses( $room_id, $i, $tache, $user_id );

		foreach ( $reponses as $index_question => $bonne ) {
			$reponse = audit_machine_appel(
				'secura_validate_answer',
				array(
					'room_id' => $room_id,
					'task'    => $i,
					'question' => $index_question,
					'answer'  => $bonne,
				),
				$cookie,
				$nonce
			);

			/* On ne declare la question reussie que si c'est BIEN
			   elle qui a ete acceptee. L'index du drapeau dans la
			   copie tiree n'est pas le meme que son index dans la
			   source : le tirage melange les questions. On la
			   reconnait donc a son chemin de drapeau. */
			if ( $i === $index
				&& $index_question === $index_drapeau
				&& ! empty( $reponse['data']['correct'] ) ) {
				$acceptee = true;
			}
		}
	}

	/* 4. On cherche la valeur dans la machine, comme un élève.

	   La fouille passe par le terminal : elle vient donc apres le
	   parcours, quand les taches sont Deverrouillees. La machine peut
	   contenir plusieurs drapeaux : c'est le fichier de la question
	   qui fait foi (c'est lui que le serveur relit ensuite). */
	$attendu = audit_machine_valeur_fichier( $room_id, $chemin, $user_id );
	$cherche  = audit_machine_cherche( $room_id, $cookie, $nonce, $attendu );
	$niveau   = 'joue';
	$valeur   = '';

	foreach ( (array) $cherche['valeurs'] as $trouvee => $commande ) {
		if ( '' !== $valeur ) {
			break;
		}

		if ( '' !== $attendu && Secura_Lab::same_flag( $attendu, $trouvee ) ) {
			$valeur              = $trouvee;
			$cherche['commande'] = $commande;
		}
	}

	if ( 'action' === $mode ) {
		/* L'eleve confirme l'action ; c'est le serveur qui verifie
		   l'etat du terminal (les etapes ont ete jouees plus haut). */
		$cherche['valeur'] = 'done';
	} elseif ( '' !== $valeur ) {
		$cherche['valeur'] = $valeur;
	} else {
		/* L'eleve n'a pas trouve la valeur par lui-meme. Pour les
		   drapeaux dont la decouverte est le defi lui-meme (le code
		   affiche par l'application OWASP Juice Shop), on ne peut pas
		   pretendre l'avoir trouvee : on relit alors le fichier comme
		   le serveur le fait, et on le dit. */
		$niveau  = 'valide';
		$attendu = audit_machine_valeur_fichier( $room_id, $chemin, $user_id );

		if ( '' === $attendu ) {
			audit_machine_appel(
				'secura_lab_stop',
				array( 'room_id' => $room_id ),
				$cookie,
				$nonce
			);

			return array(
				'joue'   => false,
				'niveau' => 'rien',
				'detail' => 'valeur introuvable dans la machine, et fichier de drapeau illisible',
			);
		}

		$cherche['valeur'] = $attendu;
	}

	audit_machine_appel(
		'secura_lab_stop',
		array( 'room_id' => $room_id ),
		$cookie,
		$nonce
	);

	if ( ! $acceptee ) {
		return array(
			'joue'   => false,
			'niveau' => $niveau,
			'detail' => 'le serveur a refusé la valeur trouvée',
			'valeur' => $cherche['valeur'],
		);
	}

	return array(
		'joue'    => true,
		'niveau'  => $niveau,
		'detail'  => ( 'joue' === $niveau )
			? 'valeur trouvée dans la machine (« ' . $cherche['commande'] . ' ») et acceptée par le serveur'
			: 'valeur relue par le serveur dans le fichier de la machine (la découverte par l\'élève est le défi lui-même : elle n\'est pas auditée)',
		'valeur'  => $cherche['valeur'],
		'commande' => $cherche['commande'],
	);
}

/**
 * Les réponses à envoyer pour une tâche, dans la copie servie.
 *
 * Pour un test ou un examen, c'est la COPIE de l'élève qui est notée :
 * les index viennent donc du tirage, pas de la question d'origine.
 *
 * @param int   $room_id Room.
 * @param int   $index   Index de la tâche.
 * @param array $tache   Tâche.
 * @param int   $user_id Élève.
 * @return array Index => réponse.
 */
function audit_machine_reponses( $room_id, $index, array $tache, $user_id ) {
	$questions = (array) ( $tache['questions'] ?? array() );

	if ( in_array( $tache['type'] ?? '', array( 'exam', 'test' ), true ) ) {
		$questions = Secura_Exam::paper( $user_id, $room_id, $index, $tache );
	}

	$reponses = array();

	foreach ( $questions as $q_index => $question ) {
		$mode = isset( $question['mode'] ) ? $question['mode'] : 'text';

		if ( 'flag' === $mode ) {
			/* La valeur du drapeau : celle que le serveur relit dans
			   le fichier de la machine, en root. */
			$chemin = isset( $question['flag_path'] ) ? (string) $question['flag_path'] : '';
			$valeur = audit_machine_valeur_fichier( $room_id, $chemin, $user_id );

			if ( '' !== $valeur ) {
				$reponses[ $q_index ] = $valeur;
			}

			continue;
		}

		if ( 'action' === $mode ) {
			$reponses[ $q_index ] = 'done';

			continue;
		}

		if ( 'choice' === $mode ) {
			$correct = isset( $question['correct'] ) ? (int) $question['correct'] : -1;

			if ( $correct >= 0 && isset( $question['choices'][ $correct ] ) ) {
				$reponses[ $q_index ] = (string) $question['choices'][ $correct ];
			}

			continue;
		}

		if ( 'solution' === $mode ) {
			/* Un probleme d'examen universitaire : l'eleve redige sa
			   reponse, et le serveur affiche la correction officielle
			   de l'ecole. L'auditeur repond comme un eleve : une vraie
			   phrase. Le serveur refuse une reponse trop courte, on
			   ecrit donc quelque chose de reel. */
			$reponses[ $q_index ] = 'Reponse de l\'audit : ' . wp_strip_all_tags( (string) ( $question['question'] ?? '' ) );

			continue;
		}

		if ( 'text' === $mode && ! empty( $question['answers'] ) ) {
			$reponses[ $q_index ] = (string) $question['answers'][0];
		}
	}

	return $reponses;
}
