<?php
/**
 * Moteur des examens blancs : repartition ponderee, tirage, bareme.
 *
 * POURQUOI CE FICHIER EXISTE
 * --------------------------
 * Un examen blanc doit ressembler a l'examen qu'il prepare. Pour
 * Security+ SY0-701, cela veut dire deux choses precises :
 *
 *   - les questions sont tirees PAR DOMAINE, au prorata des poids
 *     officiels (12 / 22 / 18 / 28 / 20) : un blanc ou la gouvernance
 *     represente 5 % des questions entraine l'eleve a un examen qui
 *     n'existe pas ;
 *   - le resultat est donne sur l'echelle du referentiel (100 a 900,
 *     seuil 750), et non en pourcentage : c'est le chiffre que l'eleve
 *     retrouvera le jour J.
 *
 * Le tirage est reproductible a partir d'une graine : deux eleves avec
 * la meme graine ont exactement la meme copie, ce qui permet de
 * discuter d'une question precise. Deux graines differentes donnent deux
 * copies differentes, ce qui permet de retenter sans memoriser l'ordre.
 *
 * Toutes les fonctions de cette classe sont pures : pas de base de
 * donnees, pas d'horloge. C'est ce qui les rend testables, et c'est
 * tests/blanc-test.php qui les tient.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Examens blancs ponderes.
 */
final class Secura_Blanc {

	/**
	 * Repartition des questions entre domaines, au plus fort reste.
	 *
	 * Le plus fort reste est necessaire : arrondir chaque domaine
	 * separement donne 89 ou 91 questions pour un total demande de 90.
	 * Ici le total est toujours respecte.
	 *
	 * @param array $domaines Liste des domaines du referentiel (id, poids).
	 * @param int   $nb       Nombre total de questions voulu.
	 * @return array{par_domaine:array,total:int}
	 */
	public static function repartition( array $domaines, $nb ) {
		$nb = max( 0, (int) $nb );

		$poids_total = 0;

		foreach ( $domaines as $d ) {
			$poids_total += isset( $d['poids'] ) ? (int) $d['poids'] : 0;
		}

		if ( $poids_total <= 0 || $nb <= 0 ) {
			return array( 'par_domaine' => array(), 'total' => 0 );
		}

		$brut     = array();
		$attribue = 0;

		foreach ( $domaines as $d ) {
			$exact = $nb * ( (int) $d['poids'] / $poids_total );
			$base  = (int) floor( $exact );

			$brut[ $d['id'] ] = array(
				'base'  => $base,
				'reste' => $exact - $base,
			);

			$attribue += $base;
		}

		/* Les questions qui restent vont aux plus forts restes. A
		   egalite, l'ordre du referentiel tranche : le resultat doit
		   etre le meme d'une execution a l'autre. */
		$restant = $nb - $attribue;

		$ordre = array_keys( $brut );

		usort(
			$ordre,
			function ( $a, $b ) use ( $brut ) {
				if ( $brut[ $a ]['reste'] === $brut[ $b ]['reste'] ) {
					return 0;
				}

				return ( $brut[ $a ]['reste'] > $brut[ $b ]['reste'] ) ? -1 : 1;
			}
		);

		while ( $restant > 0 && ! empty( $ordre ) ) {
			foreach ( $ordre as $id ) {
				if ( $restant <= 0 ) {
					break;
				}

				$brut[ $id ]['base']++;
				$restant--;
			}
		}

		$par_domaine = array();

		foreach ( $brut as $id => $v ) {
			$par_domaine[ $id ] = (int) $v['base'];
		}

		return array( 'par_domaine' => $par_domaine, 'total' => $nb );
	}

	/**
	 * Tire les questions d'un domaine, en tournant entre les sujets.
	 *
	 * Tourner entre les sujets (plutot que piocher au hasard dans un
	 * sac) garantit que chaque sujet couvert est represente. Un tirage
	 * purement aleatoire peut, sur 90 questions, oublier un sujet
	 * entier — et l'eleve croit alors maitriser un domaine qu'il n'a
	 * jamais ete interroge.
	 *
	 * @param array $domaine Domaine du referentiel (id, sujets).
	 * @param array $pool    Questions indexees par identifiant de sujet.
	 * @param int   $voulu   Nombre de questions a tirer.
	 * @param int   $graine  Graine de tirage.
	 * @return array{questions:array,sujets_couverts:array,manquantes:int}
	 */
	public static function tirer_domaine( array $domaine, array $pool, $voulu, $graine ) {
		$voulu = max( 0, (int) $voulu );

		/* On ne garde que les sujets de CE domaine qui ont des
		   questions. L'ordre est celui du referentiel : il sert de
		   point de depart au tourniquet. */
		$files = array();

		foreach ( (array) $domaine['sujets'] as $sujet ) {
			$id = isset( $sujet['id'] ) ? (string) $sujet['id'] : '';

			if ( '' === $id || empty( $pool[ $id ] ) ) {
				continue;
			}

			$liste = array_values( (array) $pool[ $id ] );

			/* Decalage par graine : deux graines ne commencent pas par
			   le meme sujet. */
			$decalage = count( $liste ) > 1 ? ( (int) $graine ) % count( $liste ) : 0;

			$files[ $id ] = array_merge( array_slice( $liste, $decalage ), array_slice( $liste, 0, $decalage ) );
		}

		if ( empty( $files ) ) {
			return array( 'questions' => array(), 'sujets_couverts' => array(), 'manquantes' => $voulu );
		}

		$prises  = array();
		$curseur = array();
		$sujets  = array_keys( $files );
		$manque  = false;

		foreach ( $sujets as $id ) {
			$curseur[ $id ] = 0;
		}

		while ( count( $prises ) < $voulu ) {
			$progression = false;

			foreach ( $sujets as $id ) {
				if ( count( $prises ) >= $voulu ) {
					break;
				}

				if ( ! isset( $files[ $id ][ $curseur[ $id ] ] ) ) {
					continue;
				}

				$prises[] = $files[ $id ][ $curseur[ $id ] ];
				$curseur[ $id ]++;
				$progression = true;
			}

			/* Plus aucune question disponible : le pool est plus
			   petit que la demande. On s'arrete et on le dira. */
			if ( ! $progression ) {
				$manque = true;
				break;
			}
		}

		$couverts = array();

		foreach ( $prises as $q ) {
			$sujet = isset( $q['topic'] ) ? (string) $q['topic'] : '';

			if ( '' !== $sujet ) {
				$couverts[ $sujet ] = true;
			}
		}

		return array(
			'questions'      => $prises,
			'sujets_couverts' => array_keys( $couverts ),
			'manquantes'     => $manque ? $voulu - count( $prises ) : 0,
		);
	}

	/**
	 * Melange deterministe : la meme graine donne la meme copie.
	 *
	 * @param array $questions Questions a melanger.
	 * @param int   $graine    Graine.
	 * @return array
	 */
	public static function melanger( array $questions, $graine ) {
		$index = array();

		foreach ( $questions as $i => $q ) {
			$cle = ( isset( $q['room'] ) ? $q['room'] : '' ) . '|' . ( isset( $q['task'] ) ? $q['task'] : '' ) . '|' . ( isset( $q['q'] ) ? $q['q'] : '' ) . '|' . $i;
			$index[] = array(
				'cle'    => crc32( $graine . '|' . $cle ),
				'q'      => $q,
				'origin' => $i,
			);
		}

		usort(
			$index,
			function ( $a, $b ) {
				if ( $a['cle'] === $b['cle'] ) {
					return $a['origin'] <=> $b['origin'];
				}

				return $a['cle'] <=> $b['cle'];
			}
		);

		return array_values( array_column( $index, 'q' ) );
	}

	/**
	 * Note sur l'echelle du referentiel (100 a 900, seuil 750).
	 *
	 * @param int $bonnes Nombre de bonnes reponses.
	 * @param int $total  Nombre de questions.
	 * @return array{score:int,reussi:bool,pourcentage:float}
	 */
	public static function bareme( $bonnes, $total ) {
		$bonnes = max( 0, (int) $bonnes );
		$total  = max( 0, (int) $total );

		if ( 0 === $total ) {
			return array( 'score' => 100, 'reussi' => false, 'pourcentage' => 0.0 );
		}

		$bonnes = min( $bonnes, $total );

		return array(
			'score'       => (int) round( 100 + ( ( $bonnes / $total ) * 800 ) ),
			'reussi'      => ( (int) round( 100 + ( ( $bonnes / $total ) * 800 ) ) ) >= 750,
			'pourcentage' => round( 100 * $bonnes / $total, 1 ),
		);
	}

	/**
	 * Sujets a retravailler, du plus faible au moins faible.
	 *
	 * On ne liste que les sujets OU l'eleve s'est trompe, avec le nombre
	 * d'erreurs : c'est une liste de travail, pas un bulletin.
	 *
	 * @param array $questions Questions de la copie.
	 * @param array $reponses  Reponses indexees par position (vrai/faux).
	 * @return array
	 */
	public static function faiblesses( array $questions, array $reponses ) {
		$faibles = array();

		foreach ( $questions as $pos => $q ) {
			$juste = ! empty( $reponses[ $pos ] );

			if ( $juste ) {
				continue;
			}

			$sujet = isset( $q['topic'] ) ? (string) $q['topic'] : '?';
			$faibles[ $sujet ] = isset( $faibles[ $sujet ] ) ? $faibles[ $sujet ] + 1 : 1;
		}

		arsort( $faibles );

		return $faibles;
	}
}
