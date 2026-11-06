<?php
/**
 * Correction des questions « solution » (problemes d'examen d'universite).
 *
 * POURQUOI CE FICHIER EXISTE
 * --------------------------
 * Avant, une question « solution » etait declaree correcte des que la
 * reponse faisait dix caracteres :
 *
 *     $correct = ( strlen( trim( (string) $answer ) ) >= 10 );
 *
 * N'importe quelle suite de dix caracteres validait donc 1 777 questions
 * importees du MIT et de Stanford. Ce n'etait pas une correction : c'etait
 * une porte ouverte, et elle rendait invisible le meilleur contenu du
 * depot.
 *
 * CE QUE FAIT CE FICHIER, ET CE QU'IL NE FAIT PAS
 * ----------------------------------------------
 * Il ne pretend pas qu'une machine comprend de la prose. Il applique, dans
 * cet ordre, trois regles honnetes :
 *
 *   1. Si la question porte une GRILLE (`grading`), la correction est
 *      objective : des concepts obligatoires valides par leurs variantes
 *      (`answers`), et un minimum de concepts attendus (`min`). On verifie
 *      que l'eleve a produit un vrai raisonnement, pas une phrase creuse.
 *
 *   2. Sinon, la reponse est trop courte ou videe de sens : elle est
 *      refusee, et l'eleve est invite a developper (`too_short`).
 *
 *   3. Sinon, la tentative est renvoyee `a_confirmer` : l'eleve compare sa
 *      reponse a la correction officielle et se declare lui-meme. C'est
 *      une auto-evaluation explicite, jamais presentee comme une note.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Correction et auto-evaluation des questions ouvertes.
 */
final class Secura_Solution {

	/** Nombre minimal de mots pour qu'une redaction soit prise au serieux. */
	const MOTS_MIN = 12;

	/** Longueur minimale, en caracteres, apres nettoyage. */
	const CARACTERES_MIN = 60;

	/**
	 * Evalue une reponse a une question « solution ».
	 *
	 * @param array  $question Question normalisee (peut porter `grading`).
	 * @param string $answer   Reponse de l'apprenant.
	 * @return array{etat:string,correct:?bool,concepts:array,attendus:int,message:string,manquants:array}
	 *         etat : `correct`, `incorrect`, `a_confirmer`, `too_short`.
	 */
	public static function evaluate( array $question, $answer ) {
		$answer = self::nettoyer( $answer );

		if ( ! self::assez_developpe( $answer ) ) {
			return array(
				'etat'      => 'too_short',
				'correct'   => false,
				'concepts'  => array(),
				'attendus'  => 0,
				'message'   => __( 'Developpez votre reponse : un raisonnement, pas un mot.', 'secura-academy' ),
				'manquants' => array(),
			);
		}

		$grille = isset( $question['grading'] ) && is_array( $question['grading'] ) ? $question['grading'] : array();

		if ( empty( $grille ) || empty( $grille['concepts'] ) ) {
			/* Pas de grille : on ne note pas a la machine. On demande a
			   l'eleve de comparer lui-meme a la correction officielle. */
			return array(
				'etat'      => 'a_confirmer',
				'correct'   => null,
				'concepts'  => array(),
				'attendus'  => 0,
				'message'   => __( 'Comparez votre reponse au corrige officiel, puis declarez si vous l\'aviez.', 'secura-academy' ),
				'manquants' => array(),
			);
		}

		$trouves   = array();
		$manquants = array();

		foreach ( (array) $grille['concepts'] as $concept ) {
			$nom      = isset( $concept['nom'] ) ? (string) $concept['nom'] : '';
			$variantes = isset( $concept['answers'] ) ? (array) $concept['answers'] : array();

			if ( '' === $nom ) {
				continue;
			}

			$vu = false;

			foreach ( $variantes as $variante ) {
				if ( self::contient( $answer, (string) $variante ) ) {
					$vu = true;
					break;
				}
			}

			if ( $vu ) {
				$trouves[] = $nom;
			} else {
				$manquants[] = $nom;
			}
		}

		$attendus = isset( $grille['min'] ) ? absint( $grille['min'] ) : count( (array) $grille['concepts'] );
		$attendus = max( 1, min( $attendus, count( (array) $grille['concepts'] ) ) );

		$correct = count( $trouves ) >= $attendus;

		return array(
			'etat'      => $correct ? 'correct' : 'incorrect',
			'correct'   => $correct,
			'concepts'  => $trouves,
			'attendus'  => $attendus,
			'message'   => $correct
				? __( 'Les concepts attendus sont la.', 'secura-academy' )
				: __( 'Il manque des concepts : relisez la correction officielle avant de reessayer.', 'secura-academy' ),
			'manquants' => $manquants,
		);
	}

	/**
	 * La reponse est-elle assez developpee pour etre jugee ?
	 *
	 * @param string $answer Reponse nettoyee.
	 * @return bool
	 */
	public static function assez_developpe( $answer ) {
		$answer = (string) $answer;

		if ( mb_strlen( $answer ) < self::CARACTERES_MIN ) {
			return false;
		}

		$mots = preg_split( '/\s+/u', trim( $answer ), -1, PREG_SPLIT_NO_EMPTY );

		return is_array( $mots ) && count( $mots ) >= self::MOTS_MIN;
	}

	/**
	 * Le texte contient-il un fragment, en respectant les bords de mot
	 * pour les fragments courts ?
	 *
	 * @param string $texte   Texte de l'apprenant.
	 * @param string $fragment Fragment cherche (deja en minuscules).
	 * @return bool
	 */
	private static function contient( $texte, $fragment ) {
		$fragment = trim( self::nettoyer( $fragment ) );

		if ( '' === $fragment ) {
			return false;
		}

		/* Mot court : mot entier, sinon « ics » trouve « graphiques ».
		   Mot long ou expression : on accepte le pluriel, parce qu'un eleve
		   ecrit « les tickets de service » et pas « le ticket de service ».
		   Sans cela, une bonne reponse etait refusee pour une seule lettre. */
		if ( mb_strlen( $fragment ) <= 4 && false === strpos( $fragment, ' ' ) ) {
			return (bool) preg_match( '#\b' . preg_quote( $fragment, '#' ) . '\b#iu', $texte );
		}

		/* Le pluriel francais ne tombe pas a la fin de l'expression : on
		   ecrit « les tickets de service », pas « ticket de services ».
		   On autorise donc un « s » apres CHAQUE mot du fragment. */
		$mots = preg_split( '/\s+/u', $fragment, -1, PREG_SPLIT_NO_EMPTY );

		$morceaux = array();

		foreach ( (array) $mots as $mot ) {
			$morceaux[] = preg_quote( $mot, '#' ) . 's?';
		}

		$motif = '#' . implode( '\s+', $morceaux ) . '#iu';

		return (bool) preg_match( $motif, $texte );
	}

	/**
	 * Normalise un texte : balises retirees, espaces reduits, minuscules,
	 * accents replies (l'eleve tape rarement les accents a la bonne place).
	 *
	 * @param string $texte Texte brut.
	 * @return string
	 */
	public static function nettoyer( $texte ) {
		$texte = wp_strip_all_tags( (string) $texte );
		$texte = preg_replace( '/\s+/u', ' ', $texte );
		$texte = trim( (string) $texte );
		$texte = mb_strtolower( $texte, 'UTF-8' );

		if ( function_exists( 'remove_accents' ) ) {
			$texte = remove_accents( $texte );
		}

		return $texte;
	}
}
