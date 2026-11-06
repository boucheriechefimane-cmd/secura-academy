<?php
/**
 * Générateur du rapport HTML d'un auditeur.
 *
 * Le rapport HTML fait foi : il est complet (forces ET faiblesses), et il
 * reproduit sous chaque constat la PREUVE — extrait de la page servie,
 * ligne de code, sortie de commande ou mesure.
 *
 * Un rapport qui dit « l'ergonomie pourrait être améliorée » sans une
 * mesure est invalide : ici, la preuve est obligatoire et visible.
 *
 * Le fichier est autonome : styles intégré, aucune ressource externe,
 * pour qu'il s'ouvre hors ligne et survive dans une archive.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Échappe une chaîne pour le HTML.
 *
 * @param string $texte Le texte.
 * @return string
 */
function audit_html( $texte ) {
	return htmlspecialchars( (string) $texte, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8' );
}

/**
 * Construit le rapport HTML d'un audit.
 *
 * @param array $a L'état de l'audit (audit-lib).
 * @return string Le HTML.
 */
function audit_html_rapport( $a ) {
	$gravites = array(
		'bloquant' => array( 'libelle' => 'Bloquant', 'couleur' => '#b3261e', 'fond' => '#fdecea' ),
		'majeur'   => array( 'libelle' => 'Majeur',   'couleur' => '#9a5b00', 'fond' => '#fff4e0' ),
		'mineur'   => array( 'libelle' => 'Mineur',   'couleur' => '#1d4ed8', 'fond' => '#e8effd' ),
		'info'     => array( 'libelle' => 'Info',     'couleur' => '#4b5563', 'fond' => '#f1f3f5' ),
	);

	$total = $a['bloquant'] + $a['majeur'] + $a['mineur'] + $a['info'];
	$non_etaye = isset( $a['non_etaye'] ) ? $a['non_etaye'] : 0;
	$non_etayes_graves = audit_non_etayes_graves( $a );
	$verdict = audit_verdict( $a );
	$teinte = $verdict['couleur'];

	$h  = "<!DOCTYPE html>\n";
	$h .= '<html lang="fr"><head><meta charset="utf-8">' . "\n";
	$h .= '<meta name="viewport" content="width=device-width, initial-scale=1">' . "\n";
	$h .= '<title>' . audit_html( $a['titre'] ) . ' — rapport d\'audit</title>' . "\n";
	$h .= '<style>' . "\n";
	$h .= <<<'CSS'
:root{--encre:#1a1d21;--gris:#5b6470;--trait:#e3e6ea;--fond:#f7f8fa}
*{box-sizing:border-box}
body{margin:0;font:16px/1.65 -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;color:var(--encre);background:var(--fond)}
.page{max-width:1080px;margin:0 auto;padding:0 20px 80px}
header{background:#fff;border-bottom:1px solid var(--trait);padding:36px 0 26px;margin-bottom:28px}
header .page{padding-bottom:0}
.eyebrow{font-size:13px;letter-spacing:.14em;text-transform:uppercase;color:var(--gris);font-weight:700}
h1{font-size:30px;line-height:1.25;margin:10px 0 6px}
h2{font-size:21px;margin:38px 0 14px;padding-bottom:8px;border-bottom:1px solid var(--trait)}
h3{font-size:17px;margin:24px 0 10px}
.sub{color:var(--gris);margin:0}
.verdict{display:flex;gap:16px;align-items:flex-start;background:#fff;border:1px solid var(--trait);border-left:5px solid var(--teinte);border-radius:10px;padding:18px 20px;margin:22px 0}
.verdict .badge{flex:0 0 auto;background:var(--teinte);color:#fff;font-weight:700;font-size:14px;padding:7px 14px;border-radius:999px;letter-spacing:.02em}
.verdict p{margin:0}
.grille{display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:12px;margin:20px 0}
.carte{background:#fff;border:1px solid var(--trait);border-radius:10px;padding:14px 16px}
.carte .n{font-size:26px;font-weight:700;line-height:1.1}
.carte .t{font-size:12.5px;color:var(--gris);text-transform:uppercase;letter-spacing:.08em;margin-top:4px}
.carte.ok .n{color:#1b7f4b}.carte.bad .n{color:#b3261e}.carte.warn .n{color:#9a5b00}
table{width:100%;border-collapse:collapse;background:#fff;border:1px solid var(--trait);border-radius:10px;overflow:hidden;margin:14px 0}
th,td{text-align:left;padding:11px 14px;border-bottom:1px solid var(--trait);vertical-align:top;font-size:15px}
th{background:#f2f4f7;font-size:12.5px;text-transform:uppercase;letter-spacing:.07em;color:var(--gris)}
tr:last-child td{border-bottom:0}
.constat{background:#fff;border:1px solid var(--trait);border-radius:10px;padding:0;margin:14px 0;overflow:hidden}
.constat .tete{display:flex;gap:12px;align-items:flex-start;padding:14px 16px;border-bottom:1px solid var(--trait)}
.constat .etiquette{flex:0 0 auto;font-size:11.5px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;padding:4px 10px;border-radius:999px}
.constat .corps{padding:14px 16px}
.constat .corps p{margin:0 0 8px}
.tag{font-size:11.5px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;padding:4px 10px;border-radius:999px;display:inline-block}
.preuve{background:#11161c;color:#d7e0ea;border-radius:8px;padding:13px 15px;font:13px/1.6 ui-monospace,SFMono-Regular,Menlo,Consolas,monospace;white-space:pre-wrap;word-break:break-word;margin:10px 0 0;overflow-x:auto}
.preuve .etiq{display:block;font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:#7f8ea3;margin-bottom:7px}
.forces li{margin-bottom:9px}
.aucune{background:#fff;border:1px dashed var(--trait);border-radius:10px;padding:16px;color:var(--gris)}
.honnete{background:#fff;border:1px solid var(--trait);border-left:5px solid #1d4ed8;border-radius:10px;padding:16px 18px;margin:18px 0}
.honnete h3{margin-top:0}
footer{margin-top:44px;padding-top:18px;border-top:1px solid var(--trait);color:var(--gris);font-size:13.5px}
a{color:#1d4ed8}
CSS;
	$h .= "\n" . '</style></head><body>' . "\n";

	/* En-tête */
	$h .= '<header><div class="page">' . "\n";
	$h .= '<div class="eyebrow">Comité d\'audit externe — rapport d\'expert</div>' . "\n";
	$h .= '<h1>' . audit_html( $a['titre'] ) . '</h1>' . "\n";
	$h .= '<p class="sub">' . ( '' !== $a['expert'] ? audit_html( $a['expert'] ) . ' — ' : '' )
		. 'WordPress réel, ' . gmdate( 'd/m/Y à H:i', $a['debut'] ) . ' UTC</p>' . "\n";
	$h .= '</div></header>' . "\n";

	$h .= '<div class="page">' . "\n";

	/* Verdict */
	$h .= '<div class="verdict" style="--teinte:' . $teinte . '">';
	$h .= '<span class="badge">' . audit_html( $verdict['libelle'] ) . '</span>';
	$h .= '<p>' . audit_html( $verdict['phrase'] );
	if ( $non_etaye > 0 ) {
		$h .= '<br><strong>' . (int) $non_etaye . ' échec(s) non étayé(s)</strong> : une affirmation sans preuve n\'est pas un constat établi.';
		if ( $non_etayes_graves > 0 ) {
			$h .= ' La barrière échoue car ' . (int) $non_etayes_graves . ' contrôle(s) bloquant(s) ou majeur(s) manquent de preuve.';
		}
	}
	$h .= '</p></div>' . "\n";

	/* Périmètre */
	if ( '' !== $a['perimetre'] ) {
		$h .= '<h2>Périmètre de l\'expert</h2>' . "\n";
		$h .= '<p class="sub">' . audit_html( $a['perimetre'] ) . '</p>' . "\n";
	}

	/* Chiffres */
	$h .= '<div class="grille">';
	$h .= '<div class="carte ok"><div class="n">' . (int) $a['ok'] . '</div><div class="t">Contrôles réussis</div></div>';
	$h .= '<div class="carte ' . ( $a['bloquant'] > 0 ? 'bad' : '' ) . '"><div class="n">' . (int) $a['bloquant'] . '</div><div class="t">Bloquants</div></div>';
	$h .= '<div class="carte ' . ( $a['majeur'] > 0 ? 'warn' : '' ) . '"><div class="n">' . (int) $a['majeur'] . '</div><div class="t">Majeurs</div></div>';
	$h .= '<div class="carte"><div class="n">' . (int) $a['mineur'] . '</div><div class="t">Mineurs</div></div>';
	$h .= '<div class="carte"><div class="n">' . (int) $a['info'] . '</div><div class="t">Observations</div></div>';
	$h .= '<div class="carte"><div class="n">' . (int) count( $a['scenarios'] ) . '</div><div class="t">Scénarios joués</div></div>';
	$h .= '</div>' . "\n";

	/* Scénarios joués */
	if ( ! empty( $a['scenarios'] ) ) {
		$h .= '<h2>Scénarios réellement joués</h2>' . "\n";
		$h .= '<p class="sub">Chaque scénario a été exécuté pendant cet audit. La sortie brute est reproduite telle quelle.</p>' . "\n";
		$h .= '<table><thead><tr><th style="width:34%">Scénario</th><th style="width:18%">Résultat</th><th>Sortie</th></tr></thead><tbody>';
		foreach ( $a['scenarios'] as $sc ) {
			$h .= '<tr><td>' . audit_html( $sc['nom'] ) . '</td><td>' . audit_html( $sc['resultat'] ) . '</td><td>';
			if ( '' !== trim( (string) $sc['sortie'] ) ) {
				$h .= '<pre class="preuve">' . audit_html( $sc['sortie'] ) . '</pre>';
			} else {
				$h .= '<span class="sub">—</span>';
			}
			$h .= '</td></tr>';
		}
		$h .= '</tbody></table>' . "\n";
	}

	/* Forces */
	$h .= '<h2>Forces constatées</h2>' . "\n";
	if ( empty( $a['forces'] ) ) {
		$h .= '<div class="aucune">Aucune force relevée sur ce périmètre — ce qui signifie que l\'expert n\'a rien mesuré de solide ici.</div>' . "\n";
	} else {
		$h .= '<table><thead><tr><th style="width:42%">Point fort</th><th>Preuve</th></tr></thead><tbody>';
		foreach ( $a['forces'] as $fo ) {
			$h .= '<tr><td>' . audit_html( $fo['libelle'] ) . '</td><td>';
			if ( '' !== trim( (string) $fo['preuve'] ) ) {
				$h .= '<pre class="preuve">' . audit_html( $fo['preuve'] ) . '</pre>';
			} else {
				$h .= '<span class="sub">—</span>';
			}
			$h .= '</td></tr>';
		}
		$h .= '</tbody></table>' . "\n";
	}

	/* Faiblesses par gravité */
	foreach ( array( 'bloquant', 'majeur', 'mineur', 'info' ) as $niveau ) {
		$du_niveau = array();

		foreach ( $a['constats'] as $constat ) {
			if ( $constat['gravite'] === $niveau ) {
				$du_niveau[] = $constat;
			}
		}

		if ( empty( $du_niveau ) ) {
			continue;
		}

		$h .= '<h2>' . $gravites[ $niveau ]['libelle'] . 's (' . count( $du_niveau ) . ')</h2>' . "\n";

		foreach ( $du_niveau as $constat ) {
			$etiq = $gravites[ $niveau ];

			$h .= '<div class="constat">';
			$h .= '<div class="tete"><span class="etiquette" style="background:' . $etiq['fond'] . ';color:' . $etiq['couleur'] . '">'
				. $etiq['libelle'] . '</span><strong>' . audit_html( $constat['libelle'] ) . '</strong></div>';
			$h .= '<div class="corps">';

			if ( '' !== trim( (string) $constat['detail'] ) ) {
				$h .= '<p><strong>Constat :</strong> ' . audit_html( $constat['detail'] ) . '</p>';
			}

			if ( ! empty( $constat['etaye'] ) && '' !== trim( (string) $constat['preuve'] ) ) {
				$h .= '<pre class="preuve"><span class="etiq">Preuve</span>' . audit_html( $constat['preuve'] ) . '</pre>';
			} elseif ( 'info' !== $niveau ) {
				$h .= '<p class="sub"><em>Non étayé : aucune preuve n\'a pu être produite. Ce point n\'est pas retenu comme constat.</em></p>';
			}

			$h .= '</div></div>' . "\n";
		}
	}

	/* Les échecs sans preuve sont visibles séparément, sans les présenter
	   comme des constats établis. Leur gravité reste celle annoncée. */
	if ( ! empty( $a['constats_non_etayes'] ) ) {
		$h .= '<h2>Échecs non étayés (' . count( $a['constats_non_etayes'] ) . ')</h2>' . "\n";
		$h .= '<p class="sub">Ces contrôles ont échoué mais doivent être vérifiés : aucune preuve n\'a été fournie.</p>' . "\n";
		foreach ( $a['constats_non_etayes'] as $constat ) {
			$h .= '<div class="constat"><div class="tete"><span class="etiquette">Non étayé — gravité annoncée : '
				. audit_html( $constat['gravite'] ) . '</span><strong>' . audit_html( $constat['libelle'] ) . '</strong></div>';
			if ( '' !== trim( (string) $constat['detail'] ) ) {
				$h .= '<div class="corps"><p>' . audit_html( $constat['detail'] ) . '</p></div>';
			}
			$h .= '</div>' . "\n";
		}
	}

	if ( 0 === $total ) {
		$h .= '<h2>Faiblesses étayées</h2><div class="aucune">Aucune faiblesse étayée sur ce périmètre.</div>' . "\n";
	}

	/* Honnêteté des limites */
	$h .= '<div class="honnete"><h3>Ce que cet audit ne peut pas affirmer</h3>' . "\n";
	$h .= '<p>Un audit automatisé mesure ; il ne ressent pas. Ce rapport ne dit donc rien sur la '
		. 'compréhension d\'une leçon par un élève, sur la qualité d\'une traduction, sur le rythme d\'un parcours, '
		. 'ni sur la valeur perçue d\'un badge. Ces points restent des jugements humains. '
		. 'Ce qui est affirmé ici repose sur une preuve reproduite plus haut.</p></div>' . "\n";

	$h .= '<footer>Généré par le comité d\'audit externe — ' . audit_html( $a['domaine'] )
		. ' — ' . gmdate( 'd/m/Y H:i', $a['debut'] ) . ' UTC. '
		. 'Constats : ' . (int) $a['bloquant'] . ' bloquant, ' . (int) $a['majeur'] . ' majeur, '
		. (int) $a['mineur'] . ' mineur, ' . (int) $a['info'] . ' info. '
		. 'Contrôles réussis : ' . (int) $a['ok'] . '.</footer>' . "\n";

	$h .= '</div></body></html>' . "\n";

	return $h;
}
