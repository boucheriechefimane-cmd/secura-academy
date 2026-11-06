<?php
/**
 * Controle : un drapeau ne doit pas se lire dans un document.
 *
 * LE PROBLEME, MESURE
 * -------------------
 * Sur 60 drapeaux du catalogue, 42 se resolvent en ouvrant un fichier de
 * cours et en recopiant une valeur qu'il contient. Ce n'est pas un
 * exercice : c'est une lecture. L'eleve ne manipule rien, et le site
 * recompense exactement ce qu'il pretend faire apprendre.
 *
 * CE QUE FAIT CE CONTROLE
 * -----------------------
 * Il refuse tout drapeau dont l'enonce ou l'indice renvoie vers
 * /srv/cours, /srv/dojo ou /srv/briefs. Trois etats possibles :
 *
 *   1. drapeau propre (manipulation reelle) : rien a signaler ;
 *   2. drapeau fautif mais inscrit au registre de dette, avec une date
 *      limite : tolere jusqu'a cette date ;
 *   3. drapeau fautif nouveau, ou dette echue : ECHEC.
 *
 * Le registre (tools/controle/drapeaux-a-remplacer.json) n'est donc pas
 * une liste blanche permanente : c'est un echeancier. Un ajout non
 * declare casse la CI le jour meme ; une dette non payee la casse a la
 * date annoncee.
 *
 * Usage :
 *   php tools/controle/drapeaux-lisibles.php
 *   php tools/controle/drapeaux-lisibles.php date=2026-12-01
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', '/' );
}

$racine = dirname( __DIR__, 2 );
$inc    = $racine . '/wp-content/plugins/secura-academy/includes';

foreach ( array( 'default-content.php', 'content-m3.php', 'content-universites.php' ) as $f ) {
	require_once $inc . '/' . $f;
}

$aujourdhui = gmdate( 'Y-m-d' );

/* $args existe sous WP-CLI, pas en ligne de commande directe : on lit
   les deux, sans avertissement inutile. */
$arguments = isset( $args ) && is_array( $args ) ? $args : array_slice( $GLOBALS['argv'] ?? array(), 1 );

foreach ( (array) $arguments as $a ) {
	if ( 0 === strpos( (string) $a, 'date=' ) ) {
		$aujourdhui = substr( (string) $a, 5 );
	}
}

$rooms = array_merge( seca_default_rooms(), seca_default_rooms_m3() );

if ( function_exists( 'seca_default_rooms_avance' ) ) {
	$rooms = array_merge( $rooms, seca_default_rooms_avance() );
}

if ( function_exists( 'seca_default_rooms_universites' ) ) {
	$rooms = array_merge( $rooms, seca_default_rooms_universites() );
}

$registre_fichier = __DIR__ . '/drapeaux-a-remplacer.json';
$registre         = array();

if ( file_exists( $registre_fichier ) ) {
	$registre = (array) json_decode( (string) file_get_contents( $registre_fichier ), true );
}

$marqueurs = array( '/srv/cours', '/srv/briefs' );

$propres  = 0;
$toleres  = 0;
$nouveaux = array();
$echus    = array();
$vus      = array();

foreach ( $rooms as $room ) {
	$titre = isset( $room['title'] ) ? (string) $room['title'] : '?';

	foreach ( (array) ( isset( $room['tasks'] ) ? $room['tasks'] : array() ) as $ti => $task ) {
		foreach ( (array) ( isset( $task['questions'] ) ? $task['questions'] : array() ) as $qi => $question ) {
			if ( 'flag' !== ( isset( $question['mode'] ) ? $question['mode'] : '' ) ) {
				continue;
			}

			/* La regle a change le 6 novembre 2026, et elle etait fausse
			   avant. On jugeait sur le TEXTE de l'indice : une room qui dit
			   « ouvre /srv/cours » etait une lecture, ce qui est vrai. Mais
			   le dojo, reecrit, dit desormais dans son indice que le drapeau
			   n'est PAS dans le document : l'ancienne regle comptait donc
			   les vingt defis du dojo comme des lectures alors qu'ils
			   exigent une manipulation.
			   La seule preuve exploitable est le CHEMIN du drapeau : un
			   drapeau lu dans /srv/cours ou /srv/briefs est dans un
			   document ; un drapeau lu dans /root/flags est sur la machine. */
			$chemin = isset( $question['flag_path'] ) ? (string) $question['flag_path'] : '';

			$fautif = false;

			foreach ( $marqueurs as $m ) {
				if ( 0 === strpos( $chemin, $m ) ) {
					$fautif = true;
				}
			}

			if ( ! $fautif ) {
				$propres++;
				continue;
			}

			$cle         = $titre . '#' . $ti . '.' . $qi;
			$vus[ $cle ] = true;

			if ( ! isset( $registre[ $cle ] ) ) {
				$nouveaux[] = $cle;
				continue;
			}

			$avant = isset( $registre[ $cle ]['avant'] ) ? (string) $registre[ $cle ]['avant'] : '';

			if ( '' !== $avant && $aujourdhui > $avant ) {
				$echus[] = $cle . ' (echeance ' . $avant . ')';
			} else {
				$toleres++;
			}
		}
	}
}

/* Une dette declaree qui ne correspond plus a rien : soit le drapeau a
   ete corrige (bien), soit le contenu a change (a verifier). Dans les deux
   cas il faut nettoyer le registre, sinon il pourrit. */
$obsoletes = array();

foreach ( array_keys( $registre ) as $cle ) {
	if ( ! isset( $vus[ $cle ] ) ) {
		$obsoletes[] = $cle;
	}
}

echo 'DRAPEAUX — controle du ', $aujourdhui, "\n\n";
printf( "  manipulations reelles : %d\n", $propres );
printf( "  dettes tolerees       : %d\n", $toleres );
printf( "  non declarees         : %d\n", count( $nouveaux ) );
printf( "  dettes echues         : %d\n", count( $echus ) );
printf( "  entrees obsoletes     : %d\n", count( $obsoletes ) );

if ( ! empty( $nouveaux ) ) {
	echo "\nDRAPEAUX A CORRIGER (non declares dans le registre) :\n";

	foreach ( array_slice( $nouveaux, 0, 30 ) as $c ) {
		echo '  - ', $c, "\n";
	}
}

if ( ! empty( $echus ) ) {
	echo "\nDETTES ECHUES (date annoncee depassee) :\n";

	foreach ( $echus as $c ) {
		echo '  - ', $c, "\n";
	}
}

if ( ! empty( $obsoletes ) ) {
	echo "\nENTREES OBSOLETES (a retirer du registre) :\n";

	foreach ( array_slice( $obsoletes, 0, 20 ) as $c ) {
		echo '  - ', $c, "\n";
	}
}

$total  = $propres + $toleres + count( $nouveaux ) + count( $echus );
$partie = $total > 0 ? round( 100 * $propres / $total, 1 ) : 100.0;
$verdict = ( empty( $nouveaux ) && empty( $echus ) ) ? 'ACCEPTE' : 'REFUSE';

printf( "\nVERDICT : %s — %d drapeaux de manipulation sur %d (%.1f %%), la cible est 100 %%\n", $verdict, $propres, $total, $partie );

exit( ( empty( $nouveaux ) && empty( $echus ) ) ? 0 : 1 );
