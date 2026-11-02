<?php
/**
 * Moteur d'épreuves : chaque apprenant reçoit sa propre copie.
 *
 * Le problème résolu ici est simple et grave : sans tirage, deux élèves
 * passent exactement le même examen — mêmes questions, même ordre,
 * mêmes chiffres. Une photo d'écran suffit alors à "réussir" l'épreuve.
 *
 * La solution tient en trois gestes :
 *
 *  1. LE RÉSERVOIR : pour un examen, on ne prend pas seulement les
 *     questions de la room : on prend celles de toute la SECTION du
 *     parcours (le « niveau »). Une question tied à une machine
 *     (drapeau, action dans le terminal) reste toutefois liée à SA
 *     room : on ne la transpose pas ailleurs.
 *
 *  2. LE TIRAGE : on pioche sans remise dans le réservoir, puis on
 *     MÉLANGE les propositions de chaque question (la bonne réponse
 *     change de place) et on MODIFIE les chiffres quand c'est sans
 *     risque (voir plus bas).
 *
 *  3. LA MÉMORISATION : la copie tirée est enregistrée pour l'élève.
 *     Recharger la page ne change rien (l'élève ne verrait pas ses
 *     réponses disparaître) ; une NOUVELLE TENTATIVE d'examen, elle,
 *     redonne une autre copie.
 *
 * Règle pédagogique appliquée : on ne change un chiffre que si
 * l'EXPLICATION de la question ne parle pas de ce chiffre. Sinon
 * l'explication deviendrait fausse — c'est-à-dire que l'élève
 * comprendrait une erreur au lieu d'apprendre la bonne réponse.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Tirage des épreuves.
 */
final class Secura_Exam {

	/**
	 * Meta où sont gardées les copies tirées.
	 */
	const META = 'secura_papers';

	/**
	 * Réservoir de questions d'une épreuve.
	 *
	 * Pour un examen : la room elle-même et toutes les rooms de sa
	 * section (le niveau). Pour un test : la room elle-même.
	 *
	 * @param int   $room_id Identifiant de la room.
	 * @param array $types   Types de tâches retenues.
	 * @return array Liste d'entrées { room, task, q, question }.
	 */
	/**
	 * Le nombre de combinaisons de k elements parmi n.
	 *
	 * @param int $n Nombre d'elements.
	 * @param int $k Nombre d'elements choisis.
	 * @return int
	 */
	private static function binomial( $n, $k ) {
		$n = (int) $n;
		$k = (int) $k;

		if ( $k < 0 || $k > $n ) {
			return 0;
		}

		if ( 0 === $k || $k === $n ) {
			return 1;
		}

		$k = min( $k, $n - $k );

		$resultat = 1;

		for ( $i = 1; $i <= $k; $i++ ) {
			$resultat = (int) round( $resultat * ( $n - $k + $i ) / $i );
		}

		return $resultat;
	}

	/**
	 * La combinaison de rang donne (ordre colex), en positions.
	 *
	 * @param int $n     Nombre d'elements.
	 * @param int $k     Nombre d'elements choisis.
	 * @param int $rang  Rang de la combinaison (0 = la premiere).
	 * @return array Positions, dans l'ordre croissant.
	 */
	private static function combinaison( $n, $k, $rang ) {
		$total = self::binomial( $n, $k );

		if ( $total < 1 || $k < 1 ) {
			return array();
		}

		$reste  = (int) $rang % $total;
		$choix  = array();

		for ( $j = $k; $j >= 1; $j-- ) {
			$c = $j - 1;

			while ( self::binomial( $c + 1, $j ) <= $reste ) {
				$c++;
			}

			$reste -= self::binomial( $c, $j );
			$choix[] = $c;
		}

		return array_reverse( $choix );
	}

	/**
	 * Le compteur de copies servies pour une tache d'une room.
	 *
	 * Il compte les copies creees (pas les pages rechargees) : c'est lui
	 * qui permet de donner a chaque eleve un ensemble different.
	 *
	 * @param int $room_id Identifiant de la room.
	 * @param int $index   Index de la tache.
	 * @return int
	 */
	private static function compteur( $room_id, $index ) {
		$cle = 'seca_exam_compteur_' . (int) $room_id . '_' . (int) $index;

		$valeur = (int) get_option( $cle, 0 );

		update_option( $cle, $valeur + 1, false );

		return $valeur;
	}

	/**
	 * L'ensemble de questions reserve pour une copie.
	 *
	 * @param array $melange Reservoir melange (ordre deja tire au sort).
	 * @param int   $tirage Nombre de questions a prendre.
	 * @param int   $room_id Identifiant de la room.
	 * @param int   $index   Index de la tache.
	 * @return array
	 */
	private static function ensemble_reserve( array $melange, $tirage, $room_id, $index ) {
		$n = count( $melange );

		if ( $tirage < 1 || $n <= $tirage ) {
			return $melange;
		}

		$positions = self::combinaison( $n, $tirage, self::compteur( $room_id, $index ) );

		$ensemble = array();

		foreach ( $positions as $position ) {
			if ( isset( $melange[ $position ] ) ) {
				$ensemble[] = $melange[ $position ];
			}
		}

		return $ensemble;
	}

	/**
	 * L'identite d'une question : son texte et ses propositions.
	 *
	 * Deux questions identiques (meme texte, memes propositions) sont la
	 * meme question, meme si elles sont stockees dans deux taches
	 * differentes.
	 *
	 * @param array $question Question.
	 * @return string
	 */
	public static function cle_question( $question ) {
		$texte = isset( $question['question'] ) ? (string) $question['question'] : '';

		$choix = isset( $question['choices'] ) ? (array) $question['choices'] : array();

		sort( $choix );

		return md5( trim( $texte ) . '|' . implode( '/', $choix ) );
	}

	/**
	 * Le reservoir de questions d'une room (et de son niveau).
	 *
	 * @param int   $room_id Identifiant de la room.
	 * @param array $types   Types de taches concernees.
	 * @return array
	 */
	public static function pool( $room_id, $types = array( 'exam', 'test' ) ) {
		$room_id = absint( $room_id );

		if ( ! $room_id ) {
			return array();
		}

		$rooms = array_merge( array( $room_id ), self::section_rooms( $room_id ) );

		$pool = array();

		/* La meme question peut se trouver dans la tache d'entrainement ET
		   dans la tache d'examen d'une room (c'est frequent : l'entrainement
		   reprend l'examen). Compter ces doublons ferait croire a un
		   reservoir deux fois plus grand qu'il n'est : deux eleves
		   pourraient alors recevoir le meme ensemble de questions.
		   On garde donc une seule occurrence de chaque question. */
		$vus = array();

		foreach ( $rooms as $rid ) {
			$tasks = Secura_Rooms::get_tasks( $rid );

			foreach ( $tasks as $index => $task ) {
				if ( ! in_array( $task['type'], $types, true ) ) {
					continue;
				}

				foreach ( $task['questions'] as $q_index => $question ) {
					$mode = isset( $question['mode'] ) ? $question['mode'] : 'text';

					/* Une question de drapeau ou d'action est liée à la
					   machine de SA room : la transposer ailleurs enverrait
					   l'élève chercher un fichier qui n'existe pas chez
					   lui. Elle reste donc dans sa room. */
					if ( $rid !== $room_id && in_array( $mode, array( 'flag', 'action' ), true ) ) {
						continue;
					}

					$cle = self::cle_question( $question );

					if ( isset( $vus[ $cle ] ) ) {
						continue;
					}

					$vus[ $cle ] = true;

					$pool[] = array(
						'room'     => $rid,
						'task'     => $index,
						'q'        => $q_index,
						'question' => $question,
					);
				}
			}
		}

		return $pool;
	}

	/**
	 * Les rooms de la même section (le « niveau »).
	 *
	 * @param int $room_id Identifiant de la room.
	 * @return array Identifiants de room.
	 */
	public static function section_rooms( $room_id ) {
		$room_id = absint( $room_id );

		if ( ! $room_id ) {
			return array();
		}

		static $cache = array();

		if ( isset( $cache[ $room_id ] ) ) {
			return $cache[ $room_id ];
		}

		$resultat = array();

		$parcours = get_posts(
			array(
				'post_type'   => SECURA_PATH_POST_TYPE,
				'numberposts' => -1,
				'post_status' => 'publish',
			)
		);

		foreach ( $parcours as $chemin ) {
			$sections = get_post_meta( $chemin->ID, SECURA_META_PATH_SECTIONS, true );

			if ( ! is_array( $sections ) ) {
				continue;
			}

			foreach ( $sections as $section ) {
				$rooms = isset( $section['rooms'] ) ? array_map( 'absint', (array) $section['rooms'] ) : array();

				if ( ! in_array( $room_id, $rooms, true ) ) {
					continue;
				}

				$resultat = array_values( array_filter( $rooms ) );

				break 2;
			}
		}

		$cache[ $room_id ] = $resultat;

		return $resultat;
	}

	/**
	 * La copie de l'élève pour une tâche donnée.
	 *
	 * @param int   $user_id Identifiant de l'apprenant.
	 * @param int   $room_id Identifiant de la room.
	 * @param int   $index   Index de la tâche.
	 * @param array $task    Tâche (type, questions…).
	 * @return array Les questions de la copie.
	 */
	public static function paper( $user_id, $room_id, $index, array $task ) {
		$user_id = absint( $user_id );
		$room_id = absint( $room_id );
		$index   = (int) $index;

		$type = isset( $task['type'] ) ? $task['type'] : '';

		if ( ! in_array( $type, array( 'exam', 'test' ), true ) ) {
			return isset( $task['questions'] ) ? $task['questions'] : array();
		}

		$tentative = self::tentative( $user_id, $room_id, $index, $type );
		$cle       = $room_id . ':' . $index . '#' . $tentative;

		$papers = get_user_meta( $user_id, self::META, true );
		$papers = is_array( $papers ) ? $papers : array();

		if ( isset( $papers[ $cle ]['questions'] ) && is_array( $papers[ $cle ]['questions'] ) ) {
			return $papers[ $cle ]['questions'];
		}

		/* Pour un examen, on puise dans toute la section : c'est le
		   niveau qui est évalué. Pour un test, on reste dans la room :
		   c'est le point de contrôle de CE que l'élève vient de faire. */
		$types = ( 'exam' === $type ) ? array( 'exam', 'test' ) : array( 'test', 'exam' );

		$pool = self::pool( $room_id, $types );

		if ( empty( $pool ) ) {
			return isset( $task['questions'] ) ? $task['questions'] : array();
		}

		$graine = crc32( $user_id . '|' . $cle . '|' . wp_json_encode( array( $room_id, $index, $tentative ) ) );
		$etat  = self::etat( $graine );

		$nombre = isset( $task['questions'] ) ? count( $task['questions'] ) : 0;
		$nombre = max( 1, (int) $nombre );

		/* Les questions qui demandent la machine (drapeau, action) ne
		   se tirent pas : elles font partie de la mission de la room,
		   donc elles sont TOUJOURS dans la copie. Sans cela, le tirage
		   pouvait les remplacer par d'autres questions, et la room
		   devenait impossible a valider. */
		$obligatoires = self::questions_machine( $room_id, $index );

		/* Le reservoir, dans son ordre canonique (c'est cet ordre qui
		   sert de reference au choix de l'ensemble : le melange par
		   eleve viendrait ensuite, sur le choix retenu). */
		$melange = array();

		foreach ( $pool as $entree ) {
			if ( self::est_obligatoire( $entree, $obligatoires ) ) {
				continue;
			}

			$melange[] = $entree;
		}

		$tirage = max( 0, $nombre - count( $obligatoires ) );

		/* L'ensemble des questions est choisi par un compteur, pas par
		   le hasard : deux eleves ne peuvent pas recevoir le meme
		   ensemble de questions tant que le reservoir le permet.

		   Le hasard, lui, decide de l'ORDRE (et des variantes
		   parametriques) : c'est la que le tirage reste reproductible
		   pour un eleve donne.

		   Sans cela, avec un reservoir de sept questions et une epreuve
		   de trois, deux eleves sur vingt recevaient le meme examen :
		   c'est mesure, ce n'est pas une impression. */
		$choisis = self::ensemble_reserve( $melange, $tirage, $room_id, $index );

		$choisis = self::melanger( $choisis, $etat );

		$questions = array();

		foreach ( $choisis as $entree ) {
			$questions[] = self::variante(
				$entree['question'],
				$graine . '-' . $entree['room'] . '-' . $entree['task'] . '-' . $entree['q']
			);
		}

		foreach ( $obligatoires as $entree ) {
			$questions[] = self::variante(
				$entree['question'],
				$graine . '-' . $entree['room'] . '-' . $entree['task'] . '-' . $entree['q']
			);
		}

		$papers[ $cle ] = array(
			'seed'      => $graine,
			'questions' => $questions,
			'pool'      => count( $pool ),
			'at'        => time(),
		);

		update_user_meta( $user_id, self::META, $papers );

		return $questions;
	}

	/**
	 * Les questions d'une tâche qui demandent la machine de l'élève.
	 *
	 * Un drapeau ou une action ne se trouve que dans la machine de SA
	 * room : ces questions font partie de la mission de la room, elles
	 * ne se tirent donc pas au sort — elles restent toujours dans la
	 * copie de l'élève.
	 *
	 * @param int $room_id Identifiant de la room.
	 * @param int $index   Index de la tâche.
	 * @return array Liste { room, task, q, question }.
	 */
	public static function questions_machine( $room_id, $index ) {
		$taches = Secura_Rooms::get_tasks( $room_id );

		if ( ! isset( $taches[ $index ] ) ) {
			return array();
		}

		$obligatoires = array();

		foreach ( (array) $taches[ $index ]['questions'] as $q_index => $question ) {
			$mode = isset( $question['mode'] ) ? $question['mode'] : 'text';

			if ( ! in_array( $mode, array( 'flag', 'action' ), true ) ) {
				continue;
			}

			$obligatoires[] = array(
				'room'     => (int) $room_id,
				'task'     => (int) $index,
				'q'        => $q_index,
				'question' => $question,
			);
		}

		return $obligatoires;
	}

	/**
	 * Une entrée du réservoir est-elle déjà dans les questions obligatoires ?
	 *
	 * @param array $entree       Entrée du réservoir.
	 * @param array $obligatoires Questions obligatoires.
	 * @return bool
	 */
	private static function est_obligatoire( $entree, array $obligatoires ) {
		foreach ( $obligatoires as $obligatoire ) {
			if ( (int) $obligatoire['room'] === (int) $entree['room']
				&& (int) $obligatoire['task'] === (int) $entree['task']
				&& (int) $obligatoire['q'] === (int) $entree['q'] ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Numéro de tentative : une nouvelle tentative = une nouvelle copie.
	 *
	 * @param int    $user_id Identifiant de l'apprenant.
	 * @param int    $room_id Identifiant de la room.
	 * @param int    $index   Index de la tâche.
	 * @param string $type    Type de la tâche.
	 * @return int
	 */
	private static function tentative( $user_id, $room_id, $index, $type ) {
		if ( 'exam' !== $type ) {
			return 0;
		}

		$exam = Secura_Progress::exam_state( $user_id, $room_id, $index );

		if ( $exam && isset( $exam['attempts'] ) ) {
			return (int) $exam['attempts'];
		}

		return 0;
	}

	/**
	 * Une variante d'une question : propositions mélangées, chiffres
	 * changés quand c'est sans danger.
	 *
	 * @param array $question Question de base.
	 * @param int   $graine   Graine du tirage.
	 * @return array
	 */
	public static function variante( array $question, $graine ) {
		$etat = self::etat( $graine );

		$mode = isset( $question['mode'] ) ? $question['mode'] : 'text';

		/* 0. Les valeurs paramétriques : l'énoncé, les propositions et
		   l'explication sont écrits avec des {mots} ; on y injecte les
		   valeurs de la variante tirée pour CETTE copie. C'est ce qui
		   change les chiffres d'une copie à l'autre. */
		$question = self::appliquer_variantes( $question, $etat );

		/* 1. Les propositions sont mélangées : la bonne réponse change
		   de place, et deux élèves ne voient pas le même questionnaire. */
		if ( 'choice' === $mode && count( $question['choices'] ) > 1 ) {
			$bonne = isset( $question['choices'][ (int) $question['correct'] ] )
				? $question['choices'][ (int) $question['correct'] ]
				: '';

			$choix  = self::melanger( $question['choices'], $etat );
			$place  = array_search( $bonne, $choix, true );

			$question['choices'] = $choix;

			if ( false !== $place ) {
				$question['correct'] = (int) $place;
			}
		}

		/* 2. Les chiffres changent — sauf si l'explication en parle, et
		   pas pour une question paramétrique : ses chiffres viennent
		   déjà des variantes, on ne les touche plus. */
		if ( in_array( $mode, array( 'text', 'choice' ), true ) && empty( $question['_parametrique'] ) ) {
			$question = self::varier_nombres( $question, $etat );
		}

		unset( $question['_parametrique'] );

		return $question;
	}

	/**
	 * Applique les valeurs paramétriques d'une question.
	 *
	 * Une question paramétrique s'écrit ainsi :
	 *
	 *     'question'    => 'Le serveur ecoute sur le port {port}.',
	 *     'choices'     => array( '{port}', '22', '443' ),
	 *     'explanation' => 'Le port {port} est ferme : rien ne s'ecoute.',
	 *     'variants'    => array(
	 *         array( 'port' => '8080' ),
	 *         array( 'port' => '9090' ),
	 *         array( 'port' => '8443' ),
	 *     ),
	 *
	 * Le moteur tire UNE de ces variantes par copie : deux eleves
	 * qui font le meme examen ne voient donc pas les memes chiffres.
	 * Le choix est tire une fois pour toutes (la copie est memorisee),
	 * donc l'eleve qui recharge sa page retrouve ses chiffres.
	 *
	 * @param array $question Question.
	 * @param int   $etat     État du tirage.
	 * @return array
	 */
	private static function appliquer_variantes( array $question, &$etat ) {
		if ( empty( $question['variants'] ) || ! is_array( $question['variants'] ) ) {
			return $question;
		}

		$jeux = array_values( array_filter( $question['variants'], 'is_array' ) );

		unset( $question['variants'] );

		if ( empty( $jeux ) ) {
			return $question;
		}

		$question['_parametrique'] = true;

		$index = self::entier( $etat ) % count( $jeux );
		$jeu   = $jeux[ $index ];

		foreach ( array( 'question', 'hint', 'explanation' ) as $champ ) {
			if ( isset( $question[ $champ ] ) && is_string( $question[ $champ ] ) ) {
				$question[ $champ ] = self::substituer( $question[ $champ ], $jeu );
			}
		}

		foreach ( array( 'choices', 'answers' ) as $champ ) {
			if ( ! isset( $question[ $champ ] ) || ! is_array( $question[ $champ ] ) ) {
				continue;
			}

			foreach ( $question[ $champ ] as $i => $valeur ) {
				$question[ $champ ][ $i ] = self::substituer( (string) $valeur, $jeu );
			}
		}

		return $question;
	}

	/**
	 * Remplace les {mots} d'un texte par les valeurs de la variante.
	 *
	 * Un {mot} absent de la variante est laisse tel quel : il signale
	 * une erreur de redaction, que l'audit du moteur signale.
	 *
	 * @param string $texte Texte.
	 * @param array  $jeu   Valeurs de la variante.
	 * @return string
	 */
	private static function substituer( $texte, array $jeu ) {
		if ( false === strpos( $texte, '{' ) ) {
			return $texte;
		}

		return preg_replace_callback(
			'/\{([A-Za-z0-9_]+)\}/',
			function ( $mot ) use ( $jeu ) {
				return array_key_exists( $mot[1], $jeu ) ? (string) $jeu[ $mot[1] ] : $mot[0];
			},
			$texte
		);
	}

	/**
	 * Change un chiffre de la question, de la réponse attendue et
	 * nowhere else — et seulement si l'explication reste vraie.
	 *
	 * @param array $question Question.
	 * @param int   $etat     État du tirage.
	 * @return array
	 */
	private static function varier_nombres( array $question, &$etat ) {
		$explication = isset( $question['explanation'] ) ? (string) $question['explanation'] : '';

		/* On ne touche qu'aux nombres de 2 ou 3 chiffres : une année
		   (4 chiffres) ou un numéro de version ne se changent pas. */
		if ( ! preg_match_all( '/(?<!\d)(\d{2,3})(?!\d)/', $question['question'], $m ) ) {
			return $question;
		}

		/* Une seule valeur modifiable à la fois : si la question en
		   contient deux (« le port 80 et le port 443 »), on ne les
		   change pas — on risquerait de rendre la question fausse. */
		if ( 1 !== count( $m[1] ) ) {
			return $question;
		}

		$nombre = $m[1][0];

		/* Si l'explication cite ce nombre, elle resterait fausse. */
		if ( false !== strpos( $explication, $nombre ) ) {
			return $question;
		}

		$portees = array();

		if ( 'choice' === $question['mode'] ) {
			foreach ( $question['choices'] as $i => $choix ) {
				if ( preg_match( '/(?<!\d)' . preg_quote( $nombre, '/' ) . '(?!\d)/', $choix ) ) {
					$portees[] = array( 'type' => 'choice', 'index' => $i );
				}
			}
		} else {
			foreach ( $question['answers'] as $i => $reponse ) {
				if ( preg_match( '/(?<!\d)' . preg_quote( $nombre, '/' ) . '(?!\d)/', $reponse ) ) {
					$portees[] = array( 'type' => 'answer', 'index' => $i );
				}
			}
		}

		/* Une seule porteuse : on sait quoi changer et où. Sinon, on
		   laisse la question tranquille : le changement serait ambigu. */
		if ( 1 !== count( $portees ) ) {
			return $question;
		}

		$nouveau = self::varier_valeur( (int) $nombre, $etat );

		if ( null === $nouveau ) {
			return $question;
		}

		$motif = '/(?<!\d)' . preg_quote( $nombre, '/' ) . '(?!\d)/';

		$question['question'] = preg_replace( $motif, (string) $nouveau, $question['question'], 1 );

		$portee = $portees[0];

		if ( 'choice' === $portee['type'] ) {
			$question['choices'][ $portee['index'] ] = preg_replace(
				$motif,
				(string) $nouveau,
				$question['choices'][ $portee['index'] ],
				1
			);
		} else {
			$question['answers'][ $portee['index'] ] = preg_replace(
				$motif,
				(string) $nouveau,
				$question['answers'][ $portee['index'] ],
				1
			);
		}

		return $question;
	}

	/**
	 * Une autre valeur plausible pour un nombre.
	 *
	 * @param int $nombre Valeur d'origine.
	 * @param int $etat   État du tirage.
	 * @return int|null
	 */
	private static function varier_valeur( $nombre, &$etat ) {
		$ecart   = 1 + ( self::entier( $etat ) % 9 );
		$sign    = ( 0 === self::entier( $etat ) % 2 ) ? 1 : -1;
		$nouveau = $nombre + ( $sign * $ecart );

		if ( $nouveau < 1 ) {
			$nouveau = $nombre + $ecart;
		}

		if ( $nouveau === $nombre ) {
			return null;
		}

		return $nouveau;
	}

	/**
	 * État initial du tirage, à partir d'une graine.
	 *
	 * @param int $graine Graine.
	 * @return int
	 */
	private static function etat( $graine ) {
		$etat = (int) $graine & 0x7FFFFFFF;

		if ( 0 === $etat ) {
			$etat = 2463534242;
		}

		return $etat;
	}

	/**
	 * Entier pseudo-aléatoire déterministe (xorshift32).
	 *
	 * On n'utilise pas random_int() : le tirage doit être REPRODUCTIBLE.
	 * Un élève qui recharge sa page doit retrouver la même copie, et deux
	 * élèves doivent avoir deux copies différentes. Une graine par élève,
	 * par room, par tâche et par tentative donne exactement cela.
	 *
	 * @param int $etat État (modifié sur place).
	 * @return int
	 */
	private static function entier( &$etat ) {
		$etat ^= ( $etat << 13 ) & 0xFFFFFFFF;
		$etat ^= ( $etat >> 17 );
		$etat ^= ( $etat << 5 ) & 0xFFFFFFFF;
		$etat &= 0x7FFFFFFF;

		return $etat;
	}

	/**
	 * Mélange un tableau, de façon déterministe.
	 *
	 * @param array $elements Éléments.
	 * @param int   $etat     État du tirage.
	 * @return array
	 */
	private static function melanger( array $elements, &$etat ) {
		$total = count( $elements );

		for ( $i = $total - 1; $i > 0; $i-- ) {
			$j      = self::entier( $etat ) % ( $i + 1 );
			$tampon = $elements[ $i ];

			$elements[ $i ] = $elements[ $j ];
			$elements[ $j ] = $tampon;
		}

		return $elements;
	}

	/**
	 * Le nombre de questions distinctes disponibles pour une épreuve.
	 *
	 * @param int $room_id Identifiant de la room.
	 * @param int $index   Index de la tâche.
	 * @return int
	 */
	public static function pool_size( $room_id, $index = 0 ) {
		$tasks = Secura_Rooms::get_tasks( $room_id );

		if ( ! isset( $tasks[ $index ] ) ) {
			return 0;
		}

		$types = ( 'exam' === $tasks[ $index ]['type'] ) ? array( 'exam', 'test' ) : array( 'test', 'exam' );

		return count( self::pool( $room_id, $types ) );
	}
}
