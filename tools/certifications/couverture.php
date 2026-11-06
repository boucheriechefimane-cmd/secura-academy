<?php
/**
 * Couverture d'un referentiel de certification, mesuree room par room.
 *
 * POURQUOI CE SCRIPT EXISTE
 * -------------------------
 * Le depot affirmait « ce parcours couvre les domaines de Security+ ».
 * Une affirmation ne se verifie pas : ce script la transforme en chiffre.
 * Il lit le referentiel (tools/certifications/*.json), regarde le contenu
 * reel des rooms telles qu'elles sont installees, et dit, sujet par sujet,
 * si le contenu parle de ce sujet — puis pese le tout selon les poids
 * officiels du referentiel.
 *
 * CE QU'IL MESURE, ET CE QU'IL NE MESURE PAS
 * ------------------------------------------
 * Il mesure la PRESENCE d'un sujet dans le contenu, par mots-cles. Il ne
 * mesure pas la qualite pedagogique, ni la difficulte d'un exercice. Un
 * sujet « couvert » ici veut dire : les rooms en parlent. C'est le premier
 * des trois niveaux de couverture ; les deux autres (exercice pratique,
 * question d'examen tiree du sujet) sont marques `partiel` quand seuls les
 * mots-cles sont trouves, `complet` quand un exercice a drapeau porte le
 * sujet.
 *
 * C'est volontairement prudent : mieux vaut annoncer 40 % et le prouver que
 * promettre 100 % et le cacher.
 *
 * Usage :
 *   wp eval-file tools/certifications/couverture.php [fichier-referentiel]
 *
 * Sortie 0 si la couverture atteint le seuil demande (option --seuil),
 * 1 sinon. Par defaut le seuil est 100 : un referentiel n'est « pret » que
 * quand tout est couvert.
 *
 * @package Secura_Academy
 */

$cible = isset( $args[0] ) ? (string) $args[0] : 'sy0-701.json';
$seuil = 100;

foreach ( (array) $args as $a ) {
	if ( 0 === strpos( (string) $a, '--seuil=' ) ) {
		$seuil = (int) substr( (string) $a, 8 );
	}
}

$fichier = __DIR__ . '/' . $cible;

if ( ! file_exists( $fichier ) ) {
	fwrite( STDERR, "Referentiel introuvable : $cible\n" );
	exit( 2 );
}

$ref = json_decode( (string) file_get_contents( $fichier ), true );

if ( ! is_array( $ref ) || empty( $ref['domaines'] ) ) {
	fwrite( STDERR, "Referentiel illisible : $cible\n" );
	exit( 2 );
}

/**
 * Texte complet d'une room : titre, extrait, contenu des taches,
 * questions, indices et explications. C'est ce que l'eleve voit.
 */
$texte_room = function ( $room_id ) {
	$morceaux = array();
	$post     = get_post( $room_id );

	if ( ! $post ) {
		return '';
	}

	$morceaux[] = $post->post_title;
	$morceaux[] = $post->post_excerpt;
	$morceaux[] = $post->post_content;

	$tasks = get_post_meta( $room_id, SECURA_META_TASKS, true );

	foreach ( (array) $tasks as $task ) {
		foreach ( array( 'title', 'content' ) as $champ ) {
			$morceaux[] = isset( $task[ $champ ] ) ? (string) $task[ $champ ] : '';
		}

		foreach ( (array) ( isset( $task['questions'] ) ? $task['questions'] : array() ) as $q ) {
			foreach ( array( 'question', 'hint', 'explanation' ) as $champ ) {
				$morceaux[] = isset( $q[ $champ ] ) ? (string) $q[ $champ ] : '';
			}

			foreach ( (array) ( isset( $q['choices'] ) ? $q['choices'] : array() ) as $c ) {
				$morceaux[] = (string) $c;
			}
		}
	}

	/* Les deux langues : une room traduite couvre le sujet en anglais
	   aussi, et le referentiel porte des mots-cles bilingues. */
	$trad = Secura_I18n::translate_post( $room_id, 'en' );
	$en   = isset( $trad['tasks'] ) ? (array) $trad['tasks'] : array();

	foreach ( $en as $task ) {
		foreach ( array( 'title', 'content' ) as $champ ) {
			$morceaux[] = isset( $task[ $champ ] ) ? (string) $task[ $champ ] : '';
		}

		foreach ( (array) ( isset( $task['questions'] ) ? $task['questions'] : array() ) as $q ) {
			foreach ( array( 'question', 'hint', 'explanation' ) as $champ ) {
				$morceaux[] = isset( $q[ $champ ] ) ? (string) $q[ $champ ] : '';
			}
		}
	}

	return wp_strip_all_tags( implode( "\n", $morceaux ) );
};

/* Toutes les rooms installees, avec leur cle stable. */
$rooms = get_posts(
	array(
		'post_type'      => 'secura_room',
		'post_status'    => 'any',
		'posts_per_page' => -1,
		'fields'         => 'ids',
	)
);

$corpus = array();

foreach ( $rooms as $rid ) {
	$cle = get_post_meta( $rid, '_secura_key', true );

	if ( '' === $cle ) {
		continue;
	}

	$corpus[ $cle ] = $texte_room( $rid );
}

/* Une room "pratique" est une room dont un exercice a drapeau ne se resout
   pas en lisant un document : c'est le seul signal fiable de pratique
   reelle dont on dispose aujourd'hui. */
$pratiques          = array();
$pratiques_machine  = 0;
$pratiques_simulees = 0;

foreach ( $corpus as $cle => $texte ) {
	$rid = 0;

	foreach ( $rooms as $candidat ) {
		if ( get_post_meta( $candidat, '_secura_key', true ) === $cle ) {
			$rid = $candidat;
			break;
		}
	}

	if ( ! $rid ) {
		continue;
	}

	$tasks = get_post_meta( $rid, SECURA_META_TASKS, true );

	/* Quatre facons de faire un exercice REELLEMENT pratique, et non de
	   lire un document :
	   1. un drapeau lu a un chemin de machine (jamais dans un document) ;
	   2. un scenario de terminal (l'eleve tape des commandes et obtient
	      des sorties : c'est une machine, meme simulee) ;
	   3. une question de solution qui exige de confronter des pieces
	      reelles (registre, questionnaire, journal) et de rendre un
	      verdict : c'est le travail d'un auditeur, pas une lecture.
	   4. un choix de conception : la room D3 « le seau ouvert » et la
	      room D2 se valident dans le terminal, sans drapeau. */
	$sur_machine = false;
	$simule      = false;

	foreach ( (array) $tasks as $task ) {
		if ( ! empty( $task['terminal']['steps'] ) ) {
			$simule = true;
		}

		foreach ( (array) ( isset( $task['questions'] ) ? $task['questions'] : array() ) as $q ) {
			$mode = isset( $q['mode'] ) ? (string) $q['mode'] : '';

			$indice = strtolower( ( isset( $q['hint'] ) ? $q['hint'] : '' ) . ' ' . ( isset( $q['question'] ) ? $q['question'] : '' ) );
			$lecture_seule = ( false !== strpos( $indice, '/srv/cours' ) || false !== strpos( $indice, '/srv/dojo' ) || false !== strpos( $indice, '/srv/briefs' ) );

			if ( 'flag' === $mode && ! $lecture_seule ) {
				$sur_machine = true;
			}

			if ( 'solution' === $mode && ! $lecture_seule && ! empty( $q['grading']['concepts'] ) ) {
				$sur_machine = true;
			}
		}
	}

	if ( $sur_machine ) {
		$pratiques[ $cle ] = true;
		$pratiques_machine++;
	} elseif ( $simule ) {
		/* Terminal simule : l'eleve agit, mais sur une machine qui
		   repond par des sorties ecrites d'avance. C'est de la pratique,
		   ce n'est pas une machine reelle. On la compte, et on le dit. */
		$pratiques[ $cle ] = true;
		$pratiques_simulees++;
	}
}

$total_poids   = 0;
$acquis_poids  = 0;

/* Deux mesures, et non une seule. La mesure officielle compte une room
   pratique meme si elle est simulee (« complet »), parce qu'un terminal
   simule fait quand meme agir l'eleve. La mesure SEVERE ne compte rien de
   simule : ni les terminaux simules, ni les sujets seulement theoriques.
   Quand quelqu'un demande « t'es sur de ton chiffre ? », la reponse est la
   seconde colonne : c'est la borne basse, celle qu'on ne peut pas gonfler. */
$acquis_poids_severe = 0;
$lignes              = array();

/* Les rooms qui valident un drapeau sur une machine reelle : seules celles-la
   comptent dans la mesure severe. */
$cles_machine = array();

foreach ( $corpus as $cle => $texte ) {
	$rid = 0;

	foreach ( $rooms as $candidat ) {
		if ( get_post_meta( $candidat, '_secura_key', true ) === $cle ) {
			$rid = $candidat;
			break;
		}
	}

	if ( ! $rid ) {
		continue;
	}

	$tasks        = get_post_meta( $rid, SECURA_META_TASKS, true );
	$sur_machine  = false;

	/* Mesure severe : on ne retient que la machine REELLE. Un drapeau lu
	   dans /root/flags sur un conteneur est une preuve que le serveur peut
	   verifier ; un terminal simule ne l'est pas. */
	$drapeau_machine = false;

	foreach ( (array) $tasks as $task ) {
		foreach ( (array) ( isset( $task['questions'] ) ? $task['questions'] : array() ) as $q ) {
			$mode  = isset( $q['mode'] ) ? (string) $q['mode'] : '';
			/* Un drapeau se lit a un CHEMIN, pas dans un document de cours.
			   On juge donc sur le chemin, pas sur le texte de l'indice : un
			   indice peut citer /srv/dojo pour dire « le drapeau n'y est
			   pas », et l'ancienne heuristique comptait alors la room
			   comme « lecture seule » a tort. */
			$chemin = isset( $q['flag_path'] ) ? (string) $q['flag_path'] : '';
			$lecture_seule = ( 0 === strpos( $chemin, '/srv/cours' ) || 0 === strpos( $chemin, '/srv/briefs' ) );

			if ( 'flag' === $mode && '' !== $chemin && ! $lecture_seule ) {
				$sur_machine     = true;
				$drapeau_machine = true;
			}

			if ( 'solution' === $mode && ! empty( $q['grading']['concepts'] ) ) {
				$sur_machine = true;
			}
		}
	}

	if ( $drapeau_machine ) {
		$cles_machine[ $cle ] = true;
	}
}
$manquants     = array();

foreach ( $ref['domaines'] as $domaine ) {
	$poids_dom     = (int) $domaine['poids'];
	$total_poids  += $poids_dom;

	$sujets        = (array) $domaine['sujets'];
	$nb            = max( 1, count( $sujets ) );
	$poids_sujet   = $poids_dom / $nb;
	$acquis_dom    = 0.0;
	$detail        = array();

	foreach ( $sujets as $sujet ) {
		$rooms_sujet  = array();
		$rooms_flag   = array();

		foreach ( (array) $sujet['mots'] as $mot ) {
			$mot = mb_strtolower( trim( (string) $mot ) );

			if ( '' === $mot ) {
				continue;
			}

			/* Un mot-cle court (3 ou 4 lettres : « iot », « ics », « dlp »)
			   cherche par sous-chaine trouve « graphiques » pour « ics » et
			   gonfle la couverture d'un sujet que le contenu ignore. Ces
			   mots-la se cherchent en mot entier. Un mot de cinq lettres et
			   plus, ou une expression, se cherche en sous-chaine : c'est ce
			   qui attrape les pluriels et les derives. */
			$mot_entier = ( mb_strlen( $mot ) <= 4 && false === strpos( $mot, ' ' ) );

			$motif = $mot_entier
				? '#\b' . preg_quote( $mot, '#' ) . '\b#iu'
				: '#' . preg_quote( $mot, '#' ) . '#iu';

			foreach ( $corpus as $cle => $texte ) {
				if ( '' === $texte ) {
					continue;
				}

				if ( preg_match( $motif, $texte ) ) {
					$rooms_sujet[ $cle ] = true;

					if ( isset( $pratiques[ $cle ] ) ) {
						$rooms_flag[ $cle ] = true;
					}
				}
			}
		}

		/* Trois etats, et on ne prend pas le plus flatteur :
		   - absent  : aucun mot-cle trouve              -> 0
		   - partiel : le contenu en parle (lecture)     -> 0,5
		   - complet : au moins une room pratique en parle -> 1 */
		if ( empty( $rooms_sujet ) ) {
			$etat = 'absent';
			$part = 0.0;
			$manquants[] = $domaine['id'] . ' ' . $sujet['id'] . ' — ' . $sujet['nom'];
		} elseif ( empty( $rooms_flag ) ) {
			$etat = 'partiel';
			$part = 0.5;
			$manquants[] = $domaine['id'] . ' ' . $sujet['id'] . ' — ' . $sujet['nom'] . ' (theorie seulement)';
		} else {
			$etat = 'complet';
			$part = 1.0;
		}

		/* Mesure severe : seules les rooms a exercice REEL comptent, et
		   un sujet theorique vaut 0 au lieu de 0,5. */
		$part_severe = 0.0;

		foreach ( array_keys( $rooms_flag ) as $cle_room ) {
			if ( isset( $cles_machine[ $cle_room ] ) ) {
				$part_severe = 1.0;
				break;
			}
		}

		$acquis_poids_severe += $poids_sujet * $part_severe;
		$acquis_dom += $poids_sujet * $part;

		$detail[] = sprintf(
			'    %-5s %-52s %-9s %d room(s)',
			$sujet['id'],
			mb_substr( $sujet['nom'], 0, 52 ),
			$etat,
			count( $rooms_sujet )
		);
	}

	$acquis_poids += $acquis_dom;

	$lignes[] = sprintf(
		"\n%s — %s (poids officiel %d%%) : %.1f%% couvert",
		$domaine['id'],
		$domaine['nom'],
		$poids_dom,
		( $poids_dom > 0 ? ( $acquis_dom / $poids_dom ) * 100 : 0 )
	);

	foreach ( $detail as $d ) {
		$lignes[] = $d;
	}
}

$couverture = $total_poids > 0 ? ( $acquis_poids / $total_poids ) * 100 : 0;

echo "\nREFERENTIEL : ", $ref['nom'], ' (', $ref['code'], ")\n";
echo "Rooms analysees : ", count( $corpus ), " dont ", count( $pratiques ), " avec au moins un exercice reellement pratique\n";
echo "  dont ", $pratiques_machine, " sur une machine reelle (drapeau ou analyse de pieces), ", $pratiques_simulees, " sur un terminal simule\n";

foreach ( $lignes as $l ) {
	echo $l, "\n";
}

$couverture_severe = $total_poids > 0 ? ( $acquis_poids_severe / $total_poids ) * 100 : 0;

echo "\n";
printf( "  %-42s %6.1f%%\n", 'mesure officielle (simule compte pour 1)', $couverture );
printf( "  %-42s %6.1f%%\n", 'mesure severe (simule et theorie = 0)', $couverture_severe );
echo "  ", str_repeat( '-', 50 ), "\n";
echo "  L'ecart entre les deux colonnes mesure ce que le site fait", "\n";
echo "  REELLEMENT faire manipuler. Un ecart large n'est pas une faute :", "\n";
echo "  c'est le prix d'un terminal utilisable par un eleve sans machine.", "\n";

printf( "\nCOUVERTURE PONDEREE : %.1f%% (poids officiels du referentiel)\n", $couverture );
printf( "BORNE BASSE (severe) : %.1f%%\n", $couverture_severe );
printf( "Sujets non couverts ou seulement theoriques : %d\n", count( $manquants ) );

if ( ! empty( $manquants ) ) {
	echo "\nCe qui manque, nommement :\n";

	foreach ( $manquants as $m ) {
		echo '  - ', $m, "\n";
	}
}

$pret = $couverture >= $seuil;

printf(
	"\nVERDICT : %s (seuil demande %d%%)\n",
	$pret ? "couverture suffisante" : "couverture INSUFFISANTE",
	$seuil
);

exit( $pret ? 0 : 1 );
