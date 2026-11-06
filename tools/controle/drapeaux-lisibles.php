<?php
/**
 * Controle : un drapeau ne doit pas se lire dans un document.
 *
 * LE PROBLEME, MESURE LE 6 NOVEMBRE 2026
 * --------------------------------------
 * Sur 60 drapeaux du catalogue, 42 se resolvaient en ouvrant un fichier de
 * cours et en recopiant une valeur qu'il contenait. Ce n'est pas un
 * exercice : c'est une lecture. L'eleve ne manipule rien.
 *
 * CE QUE CE CONTROLE FAIT, ET POURQUOI IL A ETE REECRIT DEUX FOIS
 * --------------------------------------------------------------
 * Version 1 : il regardait si l'ENONCE citait /srv/cours. Insuffisant — un
 * enonce peut citer le dossier pour dire « ne cherche pas la ».
 *
 * Version 2 : il regardait le CHEMIN du drapeau (/root/flags ou non). Cette
 * version a produit un chiffre FAUX : « 60 manipulations sur 60 ». Or dans
 * univ-01, le drapeau est bien dans /root/flags, mais le document de cours
 * contient la MEME valeur en clair (`risque_critique = SECURA{...}`). L'eleve
 * lit le document avec `cat`, recopie, et valide sans rien manipuler.
 *
 * Version 3, celle-ci : elle ouvre les DOCUMENTS que la machine installe
 * sous /srv/cours et /srv/briefs et cherche la VALEUR du drapeau dedans.
 * C'est la seule preuve qui ne peut pas etre contournee : si la valeur est
 * dans un document lisible, le defi est une lecture, quel que soit le chemin.
 *
 * ETATS
 * -----
 *   1. propre     : la valeur du drapeau n'est dans aucun document lisible ;
 *   2. manipulee  : la valeur n'y est pas, mais le defi se resout par une
 *                   commande sur la machine (cas du dojo : le drapeau est
 *                   PRODUIT par la commande, il n'est ecrit nulle part) ;
 *   3. fautive    : la valeur est dans un document. Tolerance seulement si
 *                   la dette est declaree et non echue.
 *
 * Usage :
 *   php tools/controle/drapeaux-lisibles.php
 *   php tools/controle/drapeaux-lisibles.php date=2026-12-01
 *   php tools/controle/drapeaux-lisibles.php --liste
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
$liste_seule = false;

/* $args existe sous WP-CLI, pas en ligne de commande directe : on lit
   les deux, sans avertissement inutile. */
$arguments = isset( $args ) && is_array( $args ) ? $args : array_slice( $GLOBALS['argv'] ?? array(), 1 );

foreach ( (array) $arguments as $a ) {
	if ( 0 === strpos( (string) $a, 'date=' ) ) {
		$aujourdhui = substr( (string) $a, 5 );
	}

	if ( '--liste' === $a ) {
		$liste_seule = true;
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

	/* Les cles qui commencent par un souligne sont de la documentation
	   (`_note`), pas des dettes : on ne les compte pas. */
	foreach ( array_keys( $registre ) as $cle_registre ) {
		if ( '_' === substr( (string) $cle_registre, 0, 1 ) ) {
			unset( $registre[ $cle_registre ] );
		}
	}
}

/* ---------------------------------------------------------------------
 * Les documents lisibles de chaque machine.
 *
 * On les lit la ou la machine les installe : les generateurs de lab
 * ecrivent dans labs/<machine>/cours et labs/<machine>/notes. Un document
 * qui n'est pas dans l'image ne compte pas : c'est bien ce que l'eleve lit.
 * ------------------------------------------------------------------ */
$documents = array();

foreach ( (array) glob( $racine . '/labs/*/cours', GLOB_ONLYDIR ) as $dossier ) {
	$machine = basename( dirname( $dossier ) );

	foreach ( (array) glob( $dossier . '/**/*', GLOB_NOSORT ) as $fichier ) {
		if ( is_file( $fichier ) ) {
			$documents[] = array( 'machine' => $machine, 'fichier' => $fichier );
		}
	}
}

foreach ( (array) glob( $racine . '/labs/*/notes/*.txt' ) as $fichier ) {
	$documents[] = array( 'machine' => basename( dirname( dirname( $fichier ) ) ), 'fichier' => $fichier );
}

$contenus = array();

foreach ( $documents as $doc ) {
	$contenus[] = array(
		'machine' => $doc['machine'],
		'nom'     => str_replace( $racine . '/', '', $doc['fichier'] ),
		'texte'   => (string) file_get_contents( $doc['fichier'] ),
	);
}

/**
 * La valeur interieure d'un drapeau, lue dans le fichier de la machine.
 *
 * On ne fait pas confiance au catalogue : on lit le fichier reel
 * /root/flags/flag-XX.txt. Un drapeau dont le fichier manque est signale.
 */
$valeur_du_drapeau = function ( $chemin_flag ) use ( $racine ) {
	$nom = basename( (string) $chemin_flag );

	/* Deux formes de nom coexistent : flag-u01.txt (dojo, univ-01, web-01)
	   et flag.txt, le drapeau unique de bin-01. Les refuser, c'est se
	   priver de trois drapeaux et croire qu'ils sont introuvables. */
	if ( ! preg_match( '/^flag(?:-[a-z0-9-]+)?\.txt$/', $nom ) ) {
		return null;
	}

	/* Deux emplacements selon les machines : labs/<machine>/flag/ pour la
	   plupart, et labs/juice-shop/flags/ pour le service qui les garde.
	   Un drapeau « introuvable » n'est pas une fuite : c'est un controle
	   qui ne sait pas ou regarder, et il faut le lui dire. */
	/* Deux emplacements de dossier selon les machines : labs/<machine>/flag/
	   (dojo, univ-01, web-01, bin-01) et labs/<machine>/flags/ (le service
	   qui garde les drapeaux de Juice Shop). */
	$candidats = array_merge(
		(array) glob( $racine . '/labs/*/flag/' . $nom ),
		(array) glob( $racine . '/labs/*/flags/' . $nom )
	);

	$candidats = array_values( array_unique( $candidats ) );

	foreach ( $candidats as $fichier ) {
		$contenu = trim( (string) file_get_contents( $fichier ) );

		if ( preg_match( '/SECURA\{([^}]*)\}/', $contenu, $v ) ) {
			$valeur = $v[1];
		} else {
			/* Certaines machines gardent une empreinte nue, sans enveloppe
			   SECURA{...} : c'est le cas du service « flags » de Juice
			   Shop. La valeur est alors le contenu entier. */
			$valeur = trim( $contenu );
		}

		if ( '' !== $valeur ) {
			return array( 'valeur' => $valeur, 'fichier' => $fichier, 'machine' => basename( dirname( dirname( $fichier ) ) ) );
		}
	}

	return null;
};

$propres   = 0;
$tous      = array();
$produits  = 0;
$toleres   = 0;
$nouveaux  = array();
$echus     = array();
$vus       = array();
$fuites    = array();
$orphelins = array();

foreach ( $rooms as $room ) {
	$titre = isset( $room['title'] ) ? (string) $room['title'] : '?';

	foreach ( (array) ( isset( $room['tasks'] ) ? $room['tasks'] : array() ) as $ti => $task ) {
		foreach ( (array) ( isset( $task['questions'] ) ? $task['questions'] : array() ) as $qi => $question ) {
			if ( 'flag' !== ( isset( $question['mode'] ) ? $question['mode'] : '' ) ) {
				continue;
			}

			$cle     = $titre . '#' . $ti . '.' . $qi;
			$drapeau = $valeur_du_drapeau( isset( $question['flag_path'] ) ? $question['flag_path'] : '' );

			if ( null !== $drapeau ) {
				$tous[] = array( 'cle' => $cle, 'valeur' => $drapeau['valeur'] );
			}

			if ( null === $drapeau ) {
				$orphelins[] = $cle . ' -> ' . ( isset( $question['flag_path'] ) ? $question['flag_path'] : '(aucun)' );
				continue;
			}

			/* La valeur est-elle ecrite dans un document lisible de la
			   MEME machine ? Comparer a toutes les machines serait faux :
			   un drapeau du dojo n'a rien a voir avec un document de
			   univ-01, et une coincidence de valeur n'est pas une fuite
			   pedagogique. */
			$fuite = null;

			foreach ( $contenus as $doc ) {
				if ( $doc['machine'] !== $drapeau['machine'] ) {
					continue;
				}

				if ( '' !== $drapeau['valeur'] && false !== strpos( $doc['texte'], $drapeau['valeur'] ) ) {
					$fuite = $doc['nom'];
					break;
				}
			}

			if ( null === $fuite ) {
				/* La valeur n'est nulle part dans les documents. Deux cas :
				   soit elle est produite par une commande (le dojo), soit
				   elle est lue sur la machine sans etre ecrite. Dans les
				   deux cas, l'eleve ne peut pas la recopier. */
				$propres++;

				if ( false !== strpos( (string) ( $drapeau['fichier'] ?? '' ), '/dojo-01/' ) ) {
					$produits++;
				}

				continue;
			}

			$vus[ $cle ] = true;
			$fuites[]    = array( 'cle' => $cle, 'document' => $fuite, 'valeur' => $drapeau['valeur'] );

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

/* Une dette declaree qui ne correspond plus a rien : le drapeau a ete
   corrige (bien), ou le contenu a change (a verifier). Dans les deux cas il
   faut nettoyer le registre, sinon il pourrit. */
$obsoletes = array();

foreach ( array_keys( $registre ) as $cle ) {
	if ( ! isset( $vus[ $cle ] ) ) {
		$obsoletes[] = $cle;
	}
}

/* -------------------------------------------------------------------
   TOUTE VALEUR NE PROUVE PAS UNE MANIPULATION
   -------------------------------------------
   Un drapeau dont la valeur tient en un chiffre (« 9 ») ne prouve rien :
   on tombe dessus en essayant les nombres. Meme chose pour un mot du
   vocabulaire courant.

   La regle appliquee ici, ecrite noir sur blanc dans
   docs/PROUVABLE-PAR-LECTURE.md :
     - 8 caracteres ou plus, ou une empreinte hexadecimale -> PROUVEE
     - 1 a 2 caracteres, ou un petit nombre                  -> DEVINABLE
     - le reste (3 a 7)                                      -> FAIBLE

   On ne les additionne pas : un chiffre qui melange le prouve et le
   probable est un chiffre faux.
   ------------------------------------------------------------------ */
function force_de_la_valeur( $valeur ) {
	if ( '' === $valeur ) {
		return 'vide';
	}

	if ( preg_match( '/^[0-9a-f]{6,}$/i', $valeur ) ) {
		return 'empreinte';
	}

	if ( strlen( $valeur ) >= 8 ) {
		return 'prouvee';
	}

	/* Un petit nombre se devine en quelques essais. */
	if ( preg_match( '/^[0-9]{1,3}$/', $valeur ) ) {
		return 'devinable';
	}

	return 'faible';
}

/* La force se mesure sur TOUS les drapeaux, pas seulement sur ceux qui
   fuient : une valeur courte reste devinable meme bien cachee. */
/* Certaines valeurs courtes sont legitimes : elles sont DECLAREES avec
   leur raison dans drapeaux-devinables.json. On ne rallonge pas une
   valeur pour faire passer un chiffre : on dit pourquoi il est court. */
$declarees = array();

if ( is_readable( __DIR__ . '/drapeaux-devinables.json' ) ) {
	$lu = json_decode( (string) file_get_contents( __DIR__ . '/drapeaux-devinables.json' ), true );

	if ( is_array( $lu ) && isset( $lu['drapeaux'] ) && is_array( $lu['drapeaux'] ) ) {
		$declarees = $lu['drapeaux'];
	}
}

$faibles      = array();
$justifiees   = array();

foreach ( $tous as $d ) {
	$force = force_de_la_valeur( $d['valeur'] );

	if ( ! in_array( $force, array( 'devinable', 'faible', 'vide' ), true ) ) {
		continue;
	}

	if ( isset( $declarees[ $d['cle'] ] ) ) {
		$justifiees[] = $d['cle'];
		continue;
	}

	$faibles[] = $d['cle'] . ' | ' . $d['valeur'] . ' | ' . $force;
}

/* Une declaration qui ne correspond plus a rien : la valeur a change, ou
   le drapeau a disparu. Dans les deux cas la justification est perimee. */
$justifications_perimees = array();

foreach ( array_keys( $declarees ) as $cle ) {
	if ( ! in_array( $cle, $justifiees, true ) ) {
		$justifications_perimees[] = $cle;
	}
}

$total    = $propres + $toleres + count( $nouveaux ) + count( $echus );
$partie   = $total > 0 ? ( $propres / $total ) * 100 : 0;
$verdict  = 'ACCEPTE';

if ( $nouveaux || $echus || $orphelins || $faibles || $justifications_perimees ) {
	$verdict = 'REFUSE';
}

if ( $liste_seule ) {
	foreach ( $fuites as $f ) {
		echo $f['cle'], ' | ', $f['document'], ' | ', $f['valeur'], "\n";
	}

	exit( 0 );
}

printf( "DRAPEAUX — controle du %s\n\n", $aujourdhui );

printf( "  documents lisibles analyses : %d (dans %d machines)\n", count( $contenus ), count( array_unique( array_column( $contenus, 'machine' ) ) ) );
printf( "  drapeaux introuvables       : %d\n", count( $orphelins ) );
printf( "  drapeaux SANS copie possible : %d\n", $propres );
printf( "    dont la valeur tient en un chiffre ou un mot : %d (%d declaree, %d a justifier)\n", count( $faibles ) + count( $justifiees ), count( $justifiees ), count( $faibles ) );
printf( "    dont la valeur est distinctive : %d\n", $propres - count( $faibles ) - count( $justifiees ) );
printf( "    dont produits par une commande (dojo) : %d\n", $produits );
printf( "  drapeaux encore dans un document : %d\n", $toleres + count( $nouveaux ) + count( $echus ) );
printf( "    dettes tolerees : %d\n", $toleres );
printf( "    non declarees   : %d\n", count( $nouveaux ) );
printf( "    dettes echues   : %d\n", count( $echus ) );
printf( "    entrees obsoletes : %d\n", count( $obsoletes ) );

if ( $orphelins ) {
	echo "\nDRAPEAUX INTROUVABLES (le fichier de drapeau n'existe pas) :\n";

	foreach ( array_slice( $orphelins, 0, 20 ) as $o ) {
		echo '  - ', $o, "\n";
	}
}

if ( $nouveaux ) {
	echo "\nNON DECLARES (a corriger, ou a inscrire au registre avec une date) :\n";

	foreach ( array_slice( $nouveaux, 0, 20 ) as $n ) {
		echo '  - ', $n, "\n";
	}
}

if ( $faibles ) {
	echo "\nVALEURS COURTES NON JUSTIFIEES (un chiffre se devine) :\n";

	foreach ( array_slice( $faibles, 0, 20 ) as $v ) {
		echo '  - ', $v, "\n";
	}

	echo "  Corriger la valeur, ou l'inscrire dans tools/controle/drapeaux-devinables.json avec sa raison.\n";
}

if ( $justifications_perimees ) {
	echo "\nJUSTIFICATIONS PERIMEES (la valeur a change, ou le drapeau a disparu) :\n";

	foreach ( $justifications_perimees as $v ) {
		echo '  - ', $v, "\n";
	}
}

if ( $echus ) {
	echo "\nDETTES ECHUES :\n";

	foreach ( $echus as $e ) {
		echo '  - ', $e, "\n";
	}
}

if ( $obsoletes ) {
	echo "\nENTREES OBSOLETES (a retirer du registre) :\n";

	foreach ( array_slice( $obsoletes, 0, 50 ) as $o ) {
		echo '  - ', $o, "\n";
	}
}

printf(
	"\nVERDICT : %s — %d drapeaux sans copie possible sur %d (%.1f %%), la cible est 100 %%\n",
	$verdict,
	$propres,
	$total,
	$partie
);

exit( 'ACCEPTE' === $verdict ? 0 : 1 );
