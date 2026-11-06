<?php
/**
 * Instrument de mesure : la qualite des QCM, mesuree, pas supposee.
 *
 * Un QCM peut etre juste sur le fond et faux sur la forme. Trois pieges
 * rendent une question devinable sans aucune connaissance :
 *
 *   1. la bonne reponse est la plus LONGUE  -> on coche la plus developpee ;
 *   2. la bonne reponse est la seule a etre formulee avec nuance ;
 *   3. la position de la bonne reponse ne varie pas -> deja corrige par le
 *      melange a l'affichage (class-secura-ajax.php), donc non mesure ici.
 *
 * Ce script ne corrige rien : il chiffre. Il sert a savoir ou l'on en est,
 * a verifier qu'une correction a bien produit son effet, et a refuser de
 * declarer une room « prete » sur une impression.
 *
 * Executer sous WordPress :
 *
 *   wp eval-file tools/certifications/qualite-qcm.php
 *
 * Sortie : par room, le nombre de QCM dont la bonne reponse est l'option la
 * plus longue, puis, pour les examens chronometres, le score qu'obtiendrait
 * un eleve qui cocherait SYSTEMATIQUEMENT l'option la plus longue.
 *
 * Le second chiffre est le seul qui compte vraiment : un examen ou cette
 * strategie atteint le seuil de reussite ne mesure rien.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( "A executer sous WordPress : wp eval-file tools/certifications/qualite-qcm.php\n" );
}

/**
 * Longueur du texte utile, sans les balises HTML.
 *
 * Une reponse ecrite avec <code>netstat</code> ne doit pas etre comptee
 * comme plus longue qu'une reponse ecrite sans balise.
 */
function seca_qcm_longueur( $texte ) {
	return mb_strlen( trim( preg_replace( '/<[^>]+>/', '', (string) $texte ) ) );
}

/**
 * Indice de l'option la plus longue. En cas d'egalite, on renvoie -1 :
 * une egalite n'aide pas l'eleve, elle ne compte donc pas comme un biais.
 */
function seca_qcm_plus_longue( $choices ) {
	$longueurs = array();

	foreach ( (array) $choices as $i => $texte ) {
		$longueurs[ $i ] = seca_qcm_longueur( $texte );
	}

	$max = max( $longueurs );

	if ( 1 !== count( array_keys( $longueurs, $max, true ) ) ) {
		return -1;
	}

	return (int) array_search( $max, $longueurs, true );
}

$lignes      = array();
$total_qcm   = 0;
$total_longue = 0;
$examens     = array();

foreach ( Secura_Rooms::get_rooms() as $room ) {
	$cle   = (string) get_post_meta( $room->ID, '_secura_key', true );
	$n     = 0;
	$biais = 0;

	foreach ( (array) Secura_Rooms::get_tasks( $room->ID ) as $tache ) {
		$questions = isset( $tache['questions'] ) ? (array) $tache['questions'] : array();
		$examen    = isset( $tache['type'] ) && 'exam' === $tache['type'];
		$justes    = 0;
		$posees    = 0;

		foreach ( $questions as $q ) {
			if ( empty( $q['choices'] ) || 'choice' !== ( isset( $q['mode'] ) ? $q['mode'] : '' ) ) {
				continue;
			}

			$ok  = (int) $q['correct'];
			$gagnante = seca_qcm_plus_longue( $q['choices'] );
			$n++;

			if ( $gagnante === $ok ) {
				$biais++;
			}

			$posees++;
			$justes += ( $gagnante === $ok ) ? 1 : 0;
		}

		if ( $examen && $posees > 0 ) {
			$examens[ $cle ] = array(
				'justes' => $justes,
				'posees' => $posees,
				'seuil'  => isset( $tache['pass_score'] ) ? (int) $tache['pass_score'] : 80,
			);
		}
	}

	$total_qcm    += $n;
	$total_longue += $biais;

	if ( $n > 0 ) {
		$lignes[] = array( $cle, $n, $biais, $n ? 100 * $biais / $n : 0 );
	}
}

/* La banque de certification, qui n'est pas une room : elle est tiree au
   sort, un biais de longueur s'y paie donc en points d'examen. */
if ( function_exists( 'seca_banque_sy0_701' ) ) {
	$n = 0;
	$biais = 0;

	foreach ( seca_banque_sy0_701() as $questions ) {
		foreach ( (array) $questions as $q ) {
			if ( empty( $q['choices'] ) || count( (array) $q['choices'] ) < 2 ) {
				continue;
			}

			$n++;
			$biais += ( seca_qcm_plus_longue( $q['choices'] ) === (int) $q['correct'] ) ? 1 : 0;
		}
	}

	if ( $n > 0 ) {
		$lignes[] = array( 'BANQUE SY0-701', $n, $biais, 100 * $biais / $n );
	}

	$total_qcm    += $n;
	$total_longue += $biais;
}

usort( $lignes, function ( $a, $b ) {
	return $b[3] <=> $a[3];
} );

echo "\nBIAIS DE LONGUEUR — la bonne reponse est-elle l'option la plus longue ?\n";
echo str_repeat( '-', 72 ) . "\n";
printf( "%-26s %6s %8s %8s\n", 'room', 'QCM', 'biais', 'part' );

foreach ( $lignes as $l ) {
	$marque = $l[3] >= 60 ? '  <-- a corriger en premier' : '';
	printf( "%-26s %6d %8d %7.1f%%%s\n", $l[0], $l[1], $l[2], $l[3], $marque );
}

printf( "\nENSEIGNEMENT : %d QCM, %d biaises (%.1f %%)\n", $total_qcm, $total_longue, $total_qcm ? 100 * $total_longue / $total_qcm : 0 );

echo "\nEXAMENS CHRONOMETRES — score de l'eleve qui coche toujours la plus longue\n";
echo str_repeat( '-', 72 ) . "\n";

$jouables = 0;

foreach ( $examens as $cle => $e ) {
	$score = 100 * $e['justes'] / $e['posees'];
	$passe = $score >= $e['seuil'];

	if ( $passe ) {
		$jouables++;
	}

	printf(
		"%-26s %2d/%-2d = %5.1f %%  seuil %3d %s\n",
		$cle,
		$e['justes'],
		$e['posees'],
		$score,
		$e['seuil'],
		$passe ? '  <-- EXPLOITABLE sans connaissance' : ''
	);
}

printf( "\n%d examen(s) sur %d sont validables sans aucune connaissance.\n", $jouables, count( $examens ) );
echo "\nObjectif : 0 examen exploitable, et moins de 25 % de biais de longueur.\n\n";
