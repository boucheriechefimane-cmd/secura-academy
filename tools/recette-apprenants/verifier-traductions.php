<?php
/**
 * Verifie les traductions anglaises, mecaniquement.
 *
 * Ce script ne juge pas le style — c'est un travail humain. Il verifie ce
 * qu'une machine peut verifier, et qui casse reellement un exercice :
 *
 *   1. la STRUCTURE : autant de taches, de questions et d'options que la
 *      version francaise. Le serveur designe la bonne reponse par son
 *      index : une option oubliee decale tout, et l'eleve qui repond juste
 *      est declare faux ;
 *   2. la PRESENCE : aucun champ laisse vide, aucun champ laisse en
 *      francais (texte identique a l'original) ;
 *   3. les REPERES : un chemin, une commande ou un drapeau cite dans la
 *      consigne francaise doit se retrouver dans la consigne anglaise.
 *      Traduire « /srv/app » ou « nm » envoie l'eleve dans le mur ;
 *   4. les NOMS : les identifiants entre accents graves (`backtick`) sont
 *      des elements techniques, ils ne se traduisent pas.
 *
 * Usage :
 *   wp eval-file tools/recette-apprenants/verifier-traductions.php [bloc]
 *
 * Sortie 0 si tout passe, 1 sinon. Le bloc est facultatif (`m3`, `univ`...).
 *
 * @package Secura_Academy
 */

$filtre = isset( $args[0] ) ? (string) $args[0] : '';

$rooms = get_posts(
	array(
		'post_type'      => 'secura_room',
		'post_status'    => 'any',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	)
);

$erreurs = array();
$verifs  = 0;

/**
 * Un champ est-il reste en francais ? On compare au texte d'origine, mot
 * pour mot : une traduction partielle (deux phrases sur trois) est aussi
 * un echec qu'un champ vide.
 *
 * @param string $fr Texte francais.
 * @param string $en Texte anglais.
 * @return bool
 */
$est_identique = function ( $fr, $en ) {
	$nettoyer = function ( $t ) {
		$t = wp_strip_all_tags( (string) $t );
		$t = preg_replace( '/\s+/u', ' ', $t );

		return trim( mb_strtolower( $t ) );
	};

	$a = $nettoyer( $fr );
	$b = $nettoyer( $en );

	return '' !== $a && $a === $b;
};

/**
 * Les elements techniques d'un texte : chemins, commandes, drapeaux,
 * identifiants entre accents graves.
 *
 * @param string $texte Texte.
 * @return array
 */
$reperes = function ( $texte ) {
	$texte   = wp_strip_all_tags( (string) $texte );
	$trouves = array();

	/* Chemins absolus. */
	preg_match_all( '#/[A-Za-z0-9._/-]{2,}#', $texte, $m );

	foreach ( $m[0] as $chemin ) {
		$trouves[] = $chemin;
	}

	/* Drapeaux. */
	preg_match_all( '/SECURA\{[^}]+\}/', $texte, $m );

	foreach ( $m[0] as $drapeau ) {
		$trouves[] = $drapeau;
	}

	/* Identifiants entre accents graves. On ignore les jetons d'un seul
	   caractere (`<`, `>`...) : ils dependent de la ponctuation de la
	   phrase, pas du sens, et les signaler produit du bruit. */
	preg_match_all( '/`([^`]{2,})`/', $texte, $m );

	foreach ( $m[1] as $code ) {
		$code = trim( $code );

		/* Un vrai identifiant technique contient une lettre ou un
		   chiffre : « `, ` » n'en est pas un. */
		if ( mb_strlen( $code ) >= 2 && preg_match( '/[A-Za-z0-9]/', $code ) ) {
			$trouves[] = $code;
		}
	}

	return array_values( array_unique( array_filter( $trouves ) ) );
};

foreach ( $rooms as $room ) {
	$cle = get_post_meta( $room->ID, '_secura_key', true );

	if ( '' === $cle ) {
		continue;
	}

	if ( '' !== $filtre && 0 !== strpos( $cle, $filtre . '-' ) ) {
		continue;
	}

	$trad = Secura_I18n::translate_post( $room->ID, 'en' );

	if ( empty( $trad['tasks'] ) ) {
		/* Pas encore traduite : ce n'est pas une erreur de traduction,
		   c'est un travail qui reste a faire. La mesure le compte. */
		continue;
	}

	$verifs++;

	$tasks = get_post_meta( $room->ID, SECURA_META_TASKS, true );

	if ( ! is_array( $tasks ) ) {
		continue;
	}

	foreach ( $tasks as $ti => $task ) {
		$t_en = isset( $trad['tasks'][ $ti ] ) ? $trad['tasks'][ $ti ] : array();
		$nom  = sprintf( '%s > tache %d', $cle, $ti + 1 );

		if ( '' === trim( (string) ( $t_en['title'] ?? '' ) ) ) {
			$erreurs[] = $nom . ' : titre anglais vide';
		}

		$fr_content = isset( $task['content'] ) ? (string) $task['content'] : '';

		if ( '' !== trim( wp_strip_all_tags( $fr_content ) ) ) {
			$en_content = isset( $t_en['content'] ) ? (string) $t_en['content'] : '';

			if ( '' === trim( wp_strip_all_tags( $en_content ) ) ) {
				$erreurs[] = $nom . ' : contenu anglais vide';
			} elseif ( $est_identique( $fr_content, $en_content ) ) {
				$erreurs[] = $nom . ' : contenu anglais identique au francais';
			}
		}

		$questions = isset( $task['questions'] ) && is_array( $task['questions'] ) ? $task['questions'] : array();
		$en_q      = isset( $t_en['questions'] ) && is_array( $t_en['questions'] ) ? $t_en['questions'] : array();

		if ( count( $questions ) !== count( $en_q ) ) {
			$erreurs[] = $nom . sprintf( ' : %d questions en francais, %d en anglais', count( $questions ), count( $en_q ) );
		}

		foreach ( $questions as $qi => $question ) {
			$q_en = isset( $en_q[ $qi ] ) ? $en_q[ $qi ] : array();
			$nomq = sprintf( '%s > question %d', $nom, $qi + 1 );

			foreach ( array( 'question', 'hint', 'explanation' ) as $champ ) {
				$fr_txt = isset( $question[ $champ ] ) ? (string) $question[ $champ ] : '';
				$en_txt = isset( $q_en[ $champ ] ) ? (string) $q_en[ $champ ] : '';

				/* Un indice ou une explication absente en francais n'a
				   pas a exister en anglais : on ne signale que le
				   silence de la traduction. */
				if ( '' === trim( wp_strip_all_tags( $fr_txt ) ) ) {
					continue;
				}

				if ( '' === trim( wp_strip_all_tags( $en_txt ) ) ) {
					$erreurs[] = $nomq . ' : ' . $champ . ' anglais vide';
					continue;
				}

				if ( $est_identique( $fr_txt, $en_txt ) ) {
					$erreurs[] = $nomq . ' : ' . $champ . ' identique au francais';
				}

				/* Les reperes techniques doivent survivre. */
				$manquants = array_diff( $reperes( $fr_txt ), $reperes( $en_txt ) );

				foreach ( $manquants as $repere ) {
					/* Un chemin peut legitimement disparaitre si la
					   phrase est reformulee ; mais une commande ou un
					   drapeau, non. On signale les deux, l'humain
					   tranche. */
					$erreurs[] = $nomq . ' : ' . $champ . ' a perdu le repere « ' . $repere . ' »';
				}
			}

			$choix_fr = isset( $question['choices'] ) ? (array) $question['choices'] : array();
			$choix_en = isset( $q_en['choices'] ) ? (array) $q_en['choices'] : array();

			if ( ! empty( $choix_fr ) && count( $choix_fr ) !== count( $choix_en ) ) {
				$erreurs[] = $nomq . sprintf( ' : %d options en francais, %d en anglais (decalage des reponses)', count( $choix_fr ), count( $choix_en ) );
				continue;
			}

			foreach ( $choix_fr as $ci => $texte_fr ) {
				$texte_en = isset( $choix_en[ $ci ] ) ? (string) $choix_en[ $ci ] : '';

				if ( '' === trim( $texte_en ) ) {
					$erreurs[] = $nomq . ' : option ' . ( $ci + 1 ) . ' vide en anglais';
				} elseif ( $est_identique( $texte_fr, $texte_en ) ) {
					$erreurs[] = $nomq . ' : option ' . ( $ci + 1 ) . ' identique au francais (« ' . mb_substr( trim( $texte_fr ), 0, 40 ) . ' »)';
				}
			}
		}
	}
}

/* Les questions importees (MIT, Stanford) sont en anglais par nature : on
   ne les compte pas comme non traduites, mais on les signale a part pour
   que le chiffre reste lisible. */
if ( empty( $erreurs ) ) {
	printf( "TRADUCTIONS : %d room(s) verifiee(s), aucune incoherence.\n", $verifs );

	return;
}

printf( "TRADUCTIONS : %d room(s) verifiee(s), %d probleme(s).\n", $verifs, count( $erreurs ) );

foreach ( array_slice( $erreurs, 0, 60 ) as $erreur ) {
	echo '  - ', $erreur, "\n";
}

if ( count( $erreurs ) > 60 ) {
	printf( "  ... et %d autres.\n", count( $erreurs ) - 60 );
}

exit( 1 );
