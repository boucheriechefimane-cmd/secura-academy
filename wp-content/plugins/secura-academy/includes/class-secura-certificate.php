<?php
/**
 * Certificats et médailles : délivrés à la fin d'un parcours réussi.
 *
 * Un certificat est généré quand un utilisateur a réussi tous les examens
 * d'un parcours. Il contient :
 *  - Nom de l'apprenant
 *  - Nom du parcours
 *  - Date d'obtention
 *  - Score global
 *  - Numéro de certificat unique (vérifiable)
 *
 * Génération PDF en PHP pur (aucune dépendance externe requise).
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Moteur de certificats et médailles.
 */
final class Secura_Certificate {

	/**
	 * Méta des certificats délivrés.
	 * Format : array( path_id => array( certificate_number, issued_at, score ) )
	 */
	const META = 'secura_certificates';

	/**
	 * Méta des médailles par utilisateur.
	 * Format : array( path_id => array( level, earned_at ) )
	 */
	const MEDAL_META = 'secura_medals';

	/**
	 * Préfixe des numéros de certificat.
	 */
	const PREFIX = 'SECA';

	/**
	 * Niveaux de médaille selon le score moyen.
	 */
	const MEDAL_BRONZE = 'bronze';
	const MEDAL_SILVER = 'silver';
	const MEDAL_GOLD   = 'gold';

	/**
	 * Délivre un certificat pour un parcours terminé.
	 *
	 * @param int   $user_id Identifiant de l'utilisateur.
	 * @param int   $path_id Identifiant du parcours.
	 * @return array Résultat avec ok, certificate_number, pdf_url.
	 */
	public static function issue( $user_id, $path_id ) {
		$user_id = absint( $user_id );
		$path_id = absint( $path_id );

		if ( ! $user_id || ! $path_id ) {
			return array( 'ok' => false, 'message' => 'Paramètres invalides.' );
		}

		// Vérifier que le parcours existe et que tous ses examens sont réussis
		$path = get_post( $path_id );
		if ( ! $path || SECURA_PATH_POST_TYPE !== $path->post_type ) {
			return array( 'ok' => false, 'message' => 'Parcours introuvable.' );
		}

		$sections = Secura_Paths::get_sections( $path_id );
		$all_passed = true;
		$total_score = 0;
		$total_exams = 0;

		foreach ( $sections as $section ) {
			foreach ( $section['rooms'] as $room_id ) {
				$result = Secura_Exam_Timed::get_result( $user_id, $room_id );
				if ( ! $result || ! $result['passed'] ) {
					$all_passed = false;
					break 2;
				}
				$total_score += $result['percentage'];
				$total_exams++;
			}
		}

		if ( ! $all_passed || $total_exams === 0 ) {
			return array( 'ok' => false, 'message' => 'Tous les examens du parcours doivent être réussis.' );
		}

		// Vérifier si déjà délivré
		$existing = self::get_certificate( $user_id, $path_id );
		if ( $existing ) {
			return array(
				'ok'             => true,
				'already_issued' => true,
				'certificate_number' => $existing['certificate_number'],
				'pdf_url'        => $existing['pdf_url'],
				'message'        => 'Certificat déjà délivré.',
			);
		}

		$average_score = round( $total_score / $total_exams );
		$medal = self::medal_level( $average_score );
		$certificate_number = self::generate_number( $user_id, $path_id );

		// Générer le PDF
		$pdf_path = self::generate_pdf( $user_id, $path_id, $certificate_number, $average_score, $medal );
		$pdf_url  = self::pdf_url( $pdf_path );

		// Enregistrer
		$certs = get_user_meta( $user_id, self::META, true );
		if ( ! is_array( $certs ) ) {
			$certs = array();
		}

		$certs[ (string) $path_id ] = array(
			'certificate_number' => $certificate_number,
			'issued_at'          => time(),
			'score'              => $average_score,
			'medal'              => $medal,
			'pdf_url'            => $pdf_url,
		);

		update_user_meta( $user_id, self::META, $certs );

		// Enregistrer la médaille
		$medals = get_user_meta( $user_id, self::MEDAL_META, true );
		if ( ! is_array( $medals ) ) {
			$medals = array();
		}

		$medals[ (string) $path_id ] = array(
			'level'     => $medal,
			'earned_at' => time(),
		);

		update_user_meta( $user_id, self::MEDAL_META, $medals );

		return array(
			'ok'                => true,
			'certificate_number' => $certificate_number,
			'pdf_url'            => $pdf_url,
			'score'              => $average_score,
			'medal'              => $medal,
			'message'            => 'Certificat délivré avec succès.',
		);
	}

	/**
	 * Récupère un certificat existant pour un utilisateur et un parcours.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $path_id Identifiant du parcours.
	 * @return array|null Données du certificat ou null.
	 */
	public static function get_certificate( $user_id, $path_id ) {
		$user_id = absint( $user_id );
		$path_id = absint( $path_id );

		$certs = get_user_meta( $user_id, self::META, true );
		if ( ! is_array( $certs ) || ! isset( $certs[ (string) $path_id ] ) ) {
			return null;
		}

		return $certs[ (string) $path_id ];
	}

	/**
	 * Récupère la médaille d'un utilisateur pour un parcours.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $path_id Identifiant du parcours.
	 * @return string|null Niveau de médaille ou null.
	 */
	public static function get_medal( $user_id, $path_id ) {
		$cert = self::get_certificate( $user_id, $path_id );
		return $cert ? $cert['medal'] : null;
	}

	/**
	 * Détermine le niveau de médaille selon le score moyen.
	 *
	 * @param int $score Score moyen (0-100).
	 * @return string 'bronze', 'silver' ou 'gold'.
	 */
	public static function medal_level( $score ) {
		$score = (int) $score;

		if ( $score >= 85 ) {
			return self::MEDAL_GOLD;
		} elseif ( $score >= 70 ) {
			return self::MEDAL_SILVER;
		} else {
			return self::MEDAL_BRONZE;
		}
	}

	/**
	 * Génère un numéro de certificat unique.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @param int $path_id Identifiant du parcours.
	 * @return string Numéro de certificat.
	 */
	private static function generate_number( $user_id, $path_id ) {
		return self::PREFIX . '-' . strtoupper( dechex( $user_id ) ) . '-' . strtoupper( dechex( $path_id ) ) . '-' . strtoupper( dechex( time() ) );
	}

	/**
	 * Génère le PDF du certificat.
	 *
	 * @param int    $user_id      Identifiant de l'utilisateur.
	 * @param int    $path_id      Identifiant du parcours.
	 * @param string $numero       Numéro de certificat.
	 * @param int    $score        Score moyen.
	 * @param string $medal        Niveau de médaille.
	 * @return string Chemin du fichier PDF généré.
	 */
	private static function generate_pdf( $user_id, $path_id, $numero, $score, $medal ) {
		$user      = get_userdata( $user_id );
		$path      = get_post( $path_id );
		$user_name = $user ? $user->display_name : 'Apprenant';
		$path_name = $path ? $path->post_title : 'Parcours';

		$upload_dir = wp_upload_dir();
		$cert_dir   = $upload_dir['basedir'] . '/secura-certificates';

		if ( ! is_dir( $cert_dir ) ) {
			wp_mkdir_p( $cert_dir );
			// Fichier .htaccess pour interdire l'exécution PHP dans ce dossier
			@file_put_contents( $cert_dir . '/.htaccess', 'Options -ExecCGI\nAddHandler cgi-script .php .phtml .php3\n' );
		}

		$safe_name = preg_replace( '/[^a-zA-Z0-9_-]/', '_', $user_name );
		$file_name = 'certificat-' . $safe_name . '-' . $numero . '.pdf';
		$file_path = $cert_dir . '/' . $file_name;

		$pdf_content = self::build_pdf( $user_name, $path_name, $numero, $score, $medal );

		file_put_contents( $file_path, $pdf_content );

		return $file_path;
	}

	/**
	 * Retourne l'URL publique d'un certificat PDF.
	 *
	 * @param string $file_path Chemin système du fichier.
	 * @return string URL publique.
	 */
	public static function pdf_url( $file_path ) {
		$upload_dir = wp_upload_dir();
		$relative   = str_replace( $upload_dir['basedir'], '', $file_path );
		return $upload_dir['baseurl'] . $relative;
	}

	/**
	 * Construit le contenu binaire d'un PDF minimal mais valide.
	 *
	 * @param string $user_name Nom de l'apprenant.
	 * @param string $path_name Nom du parcours.
	 * @param string $numero    Numéro de certificat.
	 * @param int    $score     Score moyen.
	 * @param string $medal     Niveau de médaille.
	 * @return string Contenu binaire PDF.
	 */
	private static function build_pdf( $user_name, $path_name, $numero, $score, $medal ) {
		$medal_labels = array(
			self::MEDAL_GOLD   => 'Médaille d\'Or',
			self::MEDAL_SILVER => 'Médaille d\'Argent',
			self::MEDAL_BRONZE => 'Médaille de Bronze',
		);

		$date_obtention = date( 'd/m/Y' );
		$esc_user   = self::pdf_escape( $user_name );
		$esc_path   = self::pdf_escape( $path_name );
		$esc_numero = self::pdf_escape( $numero );
		$esc_medal  = self::pdf_escape( $medal_labels[ $medal ] ?? $medal );

		// Construction d'un PDF minimal (PDF 1.4)
		$content = "";
		$content .= "BT\n";
		$content .= "/F1 24 Tf\n";
		$content .= "100 700 Td\n";
		$content .= "(Certificat de r\u00e9ussite) Tj\n";
		$content .= "ET\n";

		$content .= "BT\n";
		$content .= "/F1 16 Tf\n";
		$content .= "100 660 Td\n";
		$content .= "(" . $esc_user . ") Tj\n";
		$content .= "ET\n";

		$content .= "BT\n";
		$content .= "/F1 12 Tf\n";
		$content .= "100 630 Td\n";
		$content .= "a suivi avec succ\u00e8s le parcours : Tj\n";
		$content .= "ET\n";

		$content .= "BT\n";
		$content .= "/F1 18 Tf\n";
		$content .= "100 600 Td\n";
		$content .= "(" . $esc_path . ") Tj\n";
		$content .= "ET\n";

		$content .= "BT\n";
		$content .= "/F1 12 Tf\n";
		$content .= "100 560 Td\n";
		$content .= "(Score : " . $score . " / 100 - " . $esc_medal . ") Tj\n";
		$content .= "ET\n";

		$content .= "BT\n";
		$content .= "/F1 12 Tf\n";
		$content .= "100 530 Td\n";
		$content .= "(Date : " . $date_obtention . ") Tj\n";
		$content .= "ET\n";

		$content .= "BT\n";
		$content .= "/F1 10 Tf\n";
		$content .= "100 500 Td\n";
		$content .= "(Numero de certificat : " . $esc_numero . ") Tj\n";
		$content .= "ET\n";

		// Objets PDF
		$obj_count = 6;

		// Objet 1 : Catalogue
		$obj1 = "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n";

		// Objet 2 : Pages
		$obj2 = "2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n";

		// Objet 3 : Page
		$page_stream = $content;
		$obj3 = "3 0 obj\n<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Resources << /Font << /F1 4 0 R >> >> /Contents 5 0 R >>\nendobj\n";

		// Objet 4 : Police (Helvetica simplifiée - on utilise la police standard)
		$obj4 = "4 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\n";

		// Objet 5 : Contenu (stream)
		$stream = $content;
		$obj5 = "5 0 obj\n<< /Length " . strlen( $stream ) . " >>\nstream\n" . $stream . "\nendstream\nendobj\n";

		// Objet 6 : Informations
		$obj6 = "6 0 obj\n<< /Title (Certificat Secura Academy) /Author (Secura Academy) /CreationDate (D:" . date( 'YmdHis' ) . ") >>\nendobj\n";

		$xref_positions = array();
		$pdf = "%PDF-1.4\n";

		$pdf .= $obj1;
		$xref_positions[1] = strlen( $pdf );

		$pdf .= $obj2;
		$xref_positions[2] = strlen( $pdf );

		$pdf .= $obj3;
		$xref_positions[3] = strlen( $pdf );

		$pdf .= $obj4;
		$xref_positions[4] = strlen( $pdf );

		$pdf .= $obj5;
		$xref_positions[5] = strlen( $pdf );

		$pdf .= $obj6;
		$xref_positions[6] = strlen( $pdf );

		// XRef
		$xref_start = strlen( $pdf );
		$pdf .= "xref\n0 " . ( $obj_count + 1 ) . "\n";
		$pdf .= "0000000000 65535 f \n";

		foreach ( range( 1, $obj_count ) as $i ) {
			$pdf .= sprintf( "%010d 00000 n \n", $xref_positions[ $i ] );
		}

		$pdf .= "trailer\n<< /Size " . ( $obj_count + 1 ) . " /Root 1 0 R /Info 6 0 R >>\n";
		$pdf .= "startxref\n" . $xref_start . "\n%%EOF\n";

		return $pdf;
	}

	/**
	 * Échappe une chaîne pour l'inclure dans une chaîne PDF entre parenthèses.
	 *
	 * @param string $s Chaîne à échapper.
	 * @return string Chaîne échappée.
	 */
	private static function pdf_escape( $s ) {
		$s = str_replace( array( '\\', '(', ')' ), array( '\\\\', '\\)', '\\)' ), $s );
		return $s;
	}

	/**
	 * Liste tous les certificats d'un utilisateur.
	 *
	 * @param int $user_id Identifiant de l'utilisateur.
	 * @return array Liste des certificats.
	 */
	public static function list_user_certificates( $user_id ) {
		$user_id = absint( $user_id );

		$certs = get_user_meta( $user_id, self::META, true );
		if ( ! is_array( $certs ) ) {
			return array();
		}

		$out = array();
		foreach ( $certs as $path_id => $data ) {
			$path = get_post( absint( $path_id ) );
			$out[] = array(
				'path_id'          => absint( $path_id ),
				'path_name'        => $path ? $path->post_title : 'Parcours #' . $path_id,
				'certificate_number' => $data['certificate_number'],
				'issued_at'        => $data['issued_at'],
				'score'            => $data['score'],
				'medal'            => $data['medal'],
				'pdf_url'          => $data['pdf_url'],
			);
		}

		usort( $out, function ( $a, $b ) {
			return $b['issued_at'] - $a['issued_at'];
		} );

		return $out;
	}
}
