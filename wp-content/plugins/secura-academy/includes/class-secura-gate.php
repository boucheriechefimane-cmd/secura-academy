<?php
/**
 * Regles de franchise des examens : tentatives, delai, et pratique obligatoire.
 *
 * POURQUOI CE FICHIER EXISTE
 * --------------------------
 * Deux defauts mesures le 6 novembre 2026 rendaient les examens decoratifs :
 *
 *   1. Le nombre de tentatives n'etait pas limite. `finish_exam`
 *      incrementait bien un compteur `attempts`, mais aucun code ne le
 *      lisait : un eleve pouvait recommencer jusqu'a tomber sur les
 *      bonnes reponses. Un QCM a quatre choix sans limite de tentatives
 *      n'est pas un examen, c'est un tirage.
 *
 *   2. Une room pouvait etre validee en reussissant l'examen sans avoir
 *      jamais fait la mission pratique. Or les salles ou l'on manipule
 *      sont exactement celles qui apprennent quelque chose : laisser
 *      valider sans elles revient a recompenser la lecture.
 *
 * Ce que fait cette classe, et rien de plus :
 *   - elle dit si un examen peut etre (re)commence, et sinon pourquoi ;
 *   - elle compte les tentatives REELLEMENT terminees ;
 *   - elle dit si la pratique de la room est faite.
 *
 * Le seuil de reussite n'est pas ici : il appartient au contenu de chaque
 * room (`pass_score`). Le plancher recommande est de 80 % pour un examen
 * de fin de room ; voir docs/PLAN-CERTIFICATION-SECURITY-PLUS.md.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Politique d'acces aux examens.
 */
final class Secura_Gate {

	/**
	 * Nombre de tentatives autorisees par examen. Trois : assez pour
	 * apprendre de ses erreurs, trop peu pour tomber sur la bonne
	 * reponse par elimination.
	 */
	const TENTATIVES = 3;

	/**
	 * Delai, en secondes, avant de pouvoir retenter apres epuisement.
	 */
	const DELAI = DAY_IN_SECONDS;

	/**
	 * Un examen peut-il etre commence ?
	 *
	 * @param int $user_id Identifiant de l'apprenant.
	 * @param int $room_id Identifiant de la room.
	 * @param int $index   Index de la tache.
	 * @return array{autorise:bool,code:string,message:string,tentatives:int,restantes:int,disponible_le:int}
	 */
	public static function peut_commencer( $user_id, $room_id, $index ) {
		$exam       = Secura_Progress::exam_state( $user_id, $room_id, $index );
		$tentatives = self::tentatives( $exam );
		$restantes  = max( 0, self::TENTATIVES - $tentatives );

		$reussi = is_array( $exam ) && ! empty( $exam['passed'] );

		/* Rejouer un examen deja reussi n'apprend rien et ne change pas
		   la note : on le refuse, en le disant. */
		if ( $reussi ) {
			return array(
				'autorise'      => false,
				'code'          => 'already_passed',
				'message'       => __( 'Examen deja reussi. Votre meilleure note est conservee.', 'secura-academy' ),
				'tentatives'    => $tentatives,
				'restantes'     => $restantes,
				'disponible_le' => 0,
			);
		}

		if ( $restantes > 0 ) {
			return array(
				'autorise'      => true,
				'code'          => 'ok',
				'message'       => sprintf(
					/* translators: %d : tentatives restantes. */
					__( 'Tentatives restantes : %d.', 'secura-academy' ),
					$restantes
				),
				'tentatives'    => $tentatives,
				'restantes'     => $restantes,
				'disponible_le' => 0,
			);
		}

		/* Tentatives epuisees : on impose un delai, calcule sur la
		   derniere tentative terminee. Un delai, pas un blocage
		   definitif : un eleve qui a travaille entre-temps doit pouvoir
		   revenir. */
		$derniere = is_array( $exam ) && ! empty( $exam['finished_at'] ) ? absint( $exam['finished_at'] ) : 0;
		$disponible = $derniere + self::DELAI;

		if ( time() >= $disponible ) {
			return array(
				'autorise'      => true,
				'code'          => 'new_cycle',
				'message'       => __( 'Delai ecoule : trois nouvelles tentatives sont ouvertes.', 'secura-academy' ),
				'tentatives'    => $tentatives,
				'restantes'     => self::TENTATIVES,
				'disponible_le' => 0,
			);
		}

		return array(
			'autorise'      => false,
			'code'          => 'attempts_exhausted',
			'message'       => sprintf(
				/* translators: %s : date de reouverture. */
				__( 'Tentatives epuisees. Revenez le %s : relisez la lecon et refaites la mission en attendant.', 'secura-academy' ),
				wp_date( 'j F Y \a H:i', $disponible )
			),
			'tentatives'    => $tentatives,
			'restantes'     => 0,
			'disponible_le' => $disponible,
		);
	}

	/**
	 * Nombre de tentatives terminees d'un examen.
	 *
	 * On compte les cycles : apres un delai ecoule, l'apprenant repart pour
	 * trois tentatives. Sans cela, le compteur ne redescendrait jamais et le
	 * delai ne servirait a rien.
	 *
	 * @param array|null $exam Etat de l'examen.
	 * @return int
	 */
	public static function tentatives( $exam ) {
		if ( ! is_array( $exam ) || empty( $exam['attempts'] ) ) {
			return 0;
		}

		return (int) $exam['attempts'] % self::TENTATIVES === 0 && (int) $exam['attempts'] >= self::TENTATIVES
			? self::TENTATIVES
			: ( (int) $exam['attempts'] % self::TENTATIVES );
	}

	/**
	 * La pratique de la room est-elle faite ?
	 *
	 * « Pratique » veut dire : un exercice a drapeau ou a action, porte par
	 * la room elle-meme, a ete resolu. Les 42 drapeaux qui se lisaient dans
	 * un document ne comptaient pas comme pratique ; ils sont retires au fur
	 * et a mesure, et cette fonction les ignore : elle ne regarde que les
	 * exercices dont l'indice ne renvoie pas vers un fichier de cours.
	 *
	 * @param int   $user_id Identifiant de l'apprenant.
	 * @param int   $room_id Identifiant de la room.
	 * @param array $tasks   Taches normalisees de la room.
	 * @return array{requise:bool,faite:bool,nb:int,restantes:int}
	 */
	public static function pratique( $user_id, $room_id, $tasks ) {
		$state = Secura_Progress::get_room_state( $user_id, $room_id );
		$nb    = 0;
		$fait  = 0;

		foreach ( (array) $tasks as $index => $task ) {
			foreach ( (array) ( isset( $task['questions'] ) ? $task['questions'] : array() ) as $q_index => $q ) {
				$mode = isset( $q['mode'] ) ? $q['mode'] : '';

				if ( 'flag' !== $mode && 'action' !== $mode ) {
					continue;
				}

				if ( ! self::est_pratique( $q ) ) {
					continue;
				}

				$nb++;

				if ( isset( $state['tasks'][ (string) $index ]['solved'][ (string) $q_index ] ) ) {
					$fait++;
				}
			}
		}

		return array(
			'requise'   => $nb > 0,
			'faite'     => ( $nb > 0 && $fait >= $nb ),
			'nb'        => $nb,
			'restantes' => max( 0, $nb - $fait ),
		);
	}

	/**
	 * Cet exercice est-il vraiment pratique ?
	 *
	 * Un drapeau dont l'indice ou l'enonce renvoie vers /srv/cours,
	 * /srv/dojo ou /srv/briefs se resout en lisant un document : ce n'est
	 * pas une manipulation. C'est la mesure du 6 novembre : 42 drapeaux sur
	 * 60 etaient dans ce cas.
	 *
	 * @param array $question Question normalisee.
	 * @return bool
	 */
	public static function est_pratique( array $question ) {
		$texte = strtolower(
			( isset( $question['hint'] ) ? (string) $question['hint'] : '' ) . ' ' .
			( isset( $question['question'] ) ? (string) $question['question'] : '' )
		);

		foreach ( array( '/srv/cours', '/srv/dojo', '/srv/briefs' ) as $marqueur ) {
			if ( false !== strpos( $texte, $marqueur ) ) {
				return false;
			}
		}

		return true;
	}
}
