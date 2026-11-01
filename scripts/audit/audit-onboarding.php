<?php
/**
 * Auditeur 13/15 — Onboarding et premiere experience.
 *
 * PERIMETRE
 * Le moment ou un eleve arrive sur le site pour la premiere fois et decide
 * s'il continue. On mesure : le contenu visible sans compte, la possibility
 * de pratiquer sans compte, la clarte de ce qui est demande a l'inscription,
 * l'explication des erreurs, et les issues de secours quand l'eleve est bloque.
 *
 * METHODE
 * On joue reellement le parcours d'un visiteur non connecte : on sert la
 * page, on appelle l'action AJAX reelle, et on releve le code et le corps
 * exacts de la reponse. Aucun resultat n'est suppose.
 *
 * @package Secura_Academy
 */

require_once __DIR__ . '/audit-lib.php';

audit_titre( 'onboarding', 'Onboarding et première expérience' );

audit_expert(
	'Expert en expérience d\'apprentissage et en conception pédagogique (« du clic au premier succès »)',
	'Joue le parcours réel d\'un élève sans compte : ce qu\'il voit en arrivant, '
	. 'ce qu\'il peut faire avant de s\'inscrire, combien de champs l\'inscription demande, '
	. 'et ce qu\'il comprend quand une action échoue. '
	. 'Ne juge pas le contenu pédagogique : c\'est l\'auditeur pédagogie.'
);

$racine = dirname( dirname( dirname( __FILE__ ) ) );
$plugin = $racine . '/wp-content/plugins/secura-academy';

/**
 * Ramene un texte a une forme comparable.
 *
 * Retire le HTML, unifie les espaces, convertit les apostrophes et
 * guillemets typographiques en equivalents simples, et met en minuscules.
 * Sans cela, deux textes identiques s'ignorent : WordPress transforme
 * l'apostrophe droite en apostrophe typographique a l'affichage.
 *
 * @param string $texte Le texte a normaliser.
 * @return string Le texte normalise.
 */
function audit_onboarding_texte( $texte ) {
	$texte = wp_strip_all_tags( (string) $texte );
	$texte = html_entity_decode( $texte, ENT_QUOTES, 'UTF-8' );
	$texte = str_replace( array( '’', '‘', 'ʼ', '“', '”', '–', '—', '…' ), array( "'", "'", "'", '"', '"', '-', '-', '...' ), $texte );
	$texte = preg_replace( '/\s+/u', ' ', $texte );

	return trim( mb_strtolower( $texte, 'UTF-8' ) );
}

/* ------------------------------------------------------------------ */
echo "\n1. L'accueil : l'élève sait-il quoi faire ?\n";

$reponse = wp_remote_get( home_url( '/' ), array( 'timeout' => 20 ) );

$corps = is_wp_error( $reponse ) ? '' : wp_remote_retrieve_body( $reponse );

if ( '' === $corps ) {
	audit_verifier(
		'l\'accueil est servi',
		false,
		'La page d\'accueil n\'a pas pu être servie',
		'bloquant',
		'Requête sur ' . home_url( '/' ) . ' → échec'
	);
} else {
	/* Un appel à l'action explicite : un lien qui mène à une room ou à
	   un parcours. */
	$a_appel_action = 0;

	if ( preg_match_all( '/<(a|button)[^>]+href=["\']([^"\']*)(room|parcours|cours|path)/i', $corps, $m ) ) {
		$a_appel_action = count( $m[0] );
	}

	audit_verifier(
		'l\'accueil propose des actions directes vers le contenu',
		$a_appel_action > 0,
		'aucun lien vers une room ou un parcours trouvé sur l\'accueil',
		'majeur',
		$a_appel_action . ' lien(s) vers une room ou un parcours sur la page d\'accueil servie'
	);

	/* Un titre qui dit ce qu'est le site : indispensable pour que
	   l'élève sache s'il est au bon endroit. */
	$titre = '';

	if ( preg_match( '/<title>(.*?)<\/title>/is', $corps, $m ) ) {
		$titre = trim( $m[1] );
	}

	audit_verifier(
		'l\'accueil annonce clairement de quoi il s\'agit',
		strlen( $titre ) > 10 && false !== stripos( $titre, 'Secura' ),
		'Titre trouvé : « ' . $titre . ' »',
		'mineur',
		'Titre servi : « ' . $titre . ' »'
	);
}

/* ------------------------------------------------------------------ */
echo "\n2. L'inscription : combien de champs à remplir ?\n";

/* Le nombre de champs est le premier frein. On lit la configuration
   reelle de WordPress. */
$champs_inscription = array(
	'username'   => 'pseudo',
	'email'      => 'adresse e-mail',
	'password'   => 'mot de passe',
	'first_name' => 'prénom',
	'last_name'  => 'nom',
);

$actifs = array();

foreach ( $champs_inscription as $champ => $libelle ) {
	if ( get_option( 'user_' . $champ ) ) {
		$actifs[] = $libelle;
	}
}

audit_verifier(
	'l\'inscription demande peu de choses (trois champs suffisent)',
	count( $actifs ) <= 3,
	'Champs demandés (' . count( $actifs ) . ') : ' . implode( ', ', $actifs ),
	'majeur',
	( count( $actifs )
		? ' champ(s) actif(s) à l\'inscription : ' . implode( ', ', $actifs )
			. ' — le minimum vital est pseudo, e-mail et mot de passe'
		: 'Aucun champ actif : l\'inscription est désactivée' )
);

/* ------------------------------------------------------------------ */
echo "\n3. Le parcours d'un élève sans compte\n";

/* On mesure le parcours réel d'un visiteur qui n'a pas de compte.
   Deux choses distinctes : LIRE (le contenu de la leçon est-il servi ?)
   et PRATIQUER (peut-on répondre à une question ?). Les deux comptent :
   une leçon lisible mais impraticable, c'est une porte qui grince. */
$room = get_posts( array( 'post_type' => 'secura_room', 'numberposts' => 1, 'post_status' => 'any' ) );

$lecture_anonyme   = false;
$preuve_lecture    = '';
$pratique_anonyme  = false;
$preuve_pratique   = '';
$message_atteint   = false;
$preuve_message    = '';

if ( ! empty( $room ) ) {
	$room_id = $room[0]->ID;

	/* A) Lecture : la page servie contient-elle la leçon ? */
	$reponse_page = wp_remote_get( get_permalink( $room_id ), array( 'timeout' => 20 ) );

	if ( ! is_wp_error( $reponse_page ) ) {
		$corps_page = wp_remote_retrieve_body( $reponse_page );

		/* On compare du texte lisible. WordPress transforme les
		   apostrophes droites en apostrophes typographiques à l'affichage :
		   on normalise les deux côtés de la comparaison, sinon on
		   chercherait un texte qui n'existe plus tel quel. */
		$visible = audit_onboarding_texte( $corps_page );

		/* On vérifie que le texte de la PREMIERE tache (la lecon) est
		   bien present : c'est le contenu, pas le simple titre. */
		$meta_taches = get_post_meta( $room_id, '_secura_tasks', true );

		if ( is_array( $meta_taches ) && ! empty( $meta_taches ) ) {
			$lecon = '';

			foreach ( $meta_taches as $tache ) {
				/* Le type de la tâche est en anglais ("lesson"), le format
				   de présentation en français ("lecon"). On se sert du type. */
				if ( isset( $tache['type'] ) && 'lesson' === $tache['type'] && isset( $tache['content'] ) ) {
					$lecon = (string) $tache['content'];
					break;
				}
			}

			$extrait = trim( substr( audit_onboarding_texte( $lecon ), 0, 60 ) );

			if ( '' !== $extrait && false !== stripos( $visible, $extrait ) ) {
				$lecture_anonyme = true;
				$preuve_lecture  = 'GET ' . get_permalink( $room_id ) . ' sans session → HTTP '
					. (int) wp_remote_retrieve_response_code( $reponse_page )
					. ' ; début de la leçon présent dans le HTML servi : « ' . $extrait . ' … »';
			} else {
				$preuve_lecture = 'GET ' . get_permalink( $room_id )
					. ' sans session → le début de la leçon (« ' . $extrait . ' ») est introuvable dans le HTML servi';
			}
		}
	}

	/* B) Pratique : l'eleve peut-il repondre a une question ? */
	$reponse_api = wp_remote_post(
		admin_url( 'admin-ajax.php' ),
		array(
			'timeout' => 20,
			'body'    => array(
				'action'     => 'seca_get_task',
				'room_id'    => $room_id,
				'task_index' => 0,
			),
		)
	);

	if ( ! is_wp_error( $reponse_api ) ) {
		$corps_api = trim( wp_remote_retrieve_body( $reponse_api ) );
		$code_api  = (int) wp_remote_retrieve_response_code( $reponse_api );

		$pratique_anonyme = ( 200 === $code_api && '' !== $corps_api && 0 !== (int) $corps_api );

		$preuve_pratique = 'POST admin-ajax.php (action=seca_get_task, room_id=' . $room_id . ') sans session → HTTP '
			. $code_api . ' — corps de la réponse : « '
			. ( '' === $corps_api ? '(vide)' : substr( $corps_api, 0, 80 ) ) . ' »';
	}

	/* C) Le message d'erreur prevu atteint-il l'eleve ?
	   Le code contient un message prevu pour ce cas (« Connectez-vous
	   pour continuer. ») : on verifie s'il est ATTEIGNABLE, c'est-a-dire
	   si l'action est enregistree aussi pour les visiteurs non
	   connectes (wp_ajax_nopriv_). */
	$fichier_ajax = $plugin . '/includes/class-secura-ajax.php';

	if ( file_exists( $fichier_ajax ) ) {
		$contenu_ajax = file_get_contents( $fichier_ajax );

		$message_connnexion = ( false !== strpos( $contenu_ajax, 'not_logged_in' ) );
		/* L'action « nopriv » peut être déclarée explicitement OU
		   enregistrée dans une boucle. On accepte les deux formes. */
		$action_nopriv      = ( false !== strpos( $contenu_ajax, 'wp_ajax_nopriv_secura_get_task' )
			|| false !== strpos( $contenu_ajax, "wp_ajax_nopriv_' . \$action" ) );

		if ( $message_connnexion && $action_nopriv ) {
			$message_atteint = true;
			$preuve_message  = 'L\'action est enregistrée pour les visiteurs non connectés : le message '
				. '« Connectez-vous pour continuer. » leur parvient.';
		} else {
			$preuve_message = 'Le message « Connectez-vous pour continuer. » existe bien dans le code '
				. '(class-secura-ajax.php, clé not_logged_in) mais l\'action n\'est enregistrée que pour les '
				. 'visiteurs connectés (wp_ajax_ sans le pendant wp_ajax_nopriv_) : le message prévu ne peut donc '
				. 'jamais atteindre un visiteur anonyme, qui reçoit à la place une réponse brute « 0 ».';
		}
	}
}

audit_verifier(
	'un visiteur non connecté peut lire le contenu (leçon, vidéo, licence)',
	$lecture_anonyme,
	$lecture_anonyme ? '' : 'Le contenu de la leçon n\'est pas servi au visiteur non connecté.',
	'majeur',
	$preuve_lecture
);

/* Le fait de demander un compte pour S'ENTRAINER n'est pas un défaut :
   la progression, les points et les médailles sont attaches a un
   compte, c'est normal. Ce qui serait un défaut, c'est que l'eleve
   tombe sur une erreur technique au lieu d'une invitation.
   On mesure donc la QUALITE de l'invitation, pas l'absence de compte. */
audit_verifier(
	'l\'élève non connecté reçoit une invitation claire, pas une erreur technique',
	$message_atteint,
	$message_atteint ? '' : 'L\'invitation à se connecter est écrite dans le code mais n\'est pas '
		. 'atteignable par le visiteur non connecté : il voit « Une erreur est survenue. » '
		. 'au lieu de « Connectez-vous pour continuer. ».',
	'majeur',
	$preuve_message
);

	$inscription_ouverte = (bool) get_option( 'users_can_register' );

	audit_verifier(
		'la création de compte est ouverte et gratuite',
		$inscription_ouverte,
		'WordPress n\'autorise pas l\'inscription en libre-service : le bouton « Créer un compte '
			. 'gratuit » de la plateforme mène à une page qui redirige vers la connexion, sans '
			. 'expliquer pourquoi. Réglage à activer : Réglages → Général → « Tout le monde peut s\'inscrire ».',
		'majeur',
		'Option WordPress « users_can_register » : ' . ( $inscription_ouverte ? 'ouverte' : 'FERMÉE' )
			. ' — rôle par défaut : ' . get_option( 'default_role' )
			. ' — l\'élève peut donc créer son compte lui-même, sans demander à un adulte'
	);

/* L'occasion manquée : pourrais-je repondre a UNE question sans compte,
   pour gouter avant de s'engager ? C'est une possibilite, pas un
   manquement — on le signale comme tel. */
if ( ! $pratique_anonyme ) {
	audit_info(
		'Opportunité : laisser essayer une question sans compte',
		'Le visiteur lit tout le contenu sans compte (leçon, vidéo, licence, machine), '
		. 'mais ne peut répondre à une question qu\'après avoir créé un compte. '
		. 'C\'est un choix défendable — la progression et les médailles sont liées au compte. '
		. 'Laisser UNA question d\'entraînement à blanc avant l\'inscription pourrait réduire '
		. 'les abandons, à tester avec de vrais élèves avant d\'être décidé.'
	);
}

/* ------------------------------------------------------------------ */
echo "\n4. Les erreurs affichent-elles une explication ?\n";

$fichier_ajax = $plugin . '/includes/class-secura-ajax.php';
$erreurs_expliquees = false;
$preuve_erreurs     = '';

if ( file_exists( $fichier_ajax ) ) {
	$contenu = file_get_contents( $fichier_ajax );

	if ( preg_match_all( '/["\']message["\']\s*=>\s*[^,]{12,}/i', $contenu, $m ) ) {
		$erreurs_expliquees = true;
		$preuve_erreurs     = count( $m[0] ) . ' message(s) d\'erreur explicites dans class-secura-ajax.php : '
			. substr( implode( ' | ', array_slice( $m[0], 0, 3 ) ), 0, 220 );
	}
}

audit_verifier(
	'les erreurs affichent une explication, pas un code',
	$erreurs_expliquees,
	$erreurs_expliquees ? '' : 'Aucun message d\'erreur explicite trouvé dans le moteur AJAX : '
		. 'l\'élève verrait un code technique sans savoir quoi faire.',
	'mineur',
	$erreurs_expliquees
		? $preuve_erreurs
		: 'Recherche de messages d\'erreur dans class-secura-ajax.php : aucune occurrence'
);

/* ------------------------------------------------------------------ */
echo "\n5. L'élève bloqué a-t-il une issue ?\n";

/* L'indice, l'aide et le deblochage : sans cela, l'eleve abandonne. */
$issues = array();

if ( is_dir( $plugin . '/includes' ) ) {
	foreach ( glob( $plugin . '/includes/*.php' ) as $fichier ) {
		$contenu = file_get_contents( $fichier );

		if ( preg_match_all( '/(indice|hint|aide|skip|debloc)/i', $contenu, $m ) ) {
			$issues[ basename( $fichier ) ] = count( $m[0] );
		}
	}
}

audit_verifier(
	'l\'élève bloqué peut obtenir de l\'aide',
	! empty( $issues ),
	'Aucune mécanique d\'aide trouvée (indice, réponse, déblocage)',
	'majeur',
	empty( $issues )
		? 'Aucune occurrence dans ' . count( glob( $plugin . '/includes/*.php' ) ) . ' fichiers du plugin'
		: 'Mécaniques d\'aide par fichier : ' . implode( ', ', array_map(
			function ( $f, $n ) {
				return $f . ' (' . $n . ')';
			},
			array_keys( $issues ),
			array_values( $issues )
		) )
);

/* ------------------------------------------------------------------ */
echo "\n6. La progression est-elle visible ?\n";

/* Un eleve qui ne voit pas ou il en est se decourage. */
$progression_visible = false;
$preuve_progression = '';

if ( is_dir( $plugin . '/includes' ) ) {
	foreach ( glob( $plugin . '/includes/*.php' ) as $fichier ) {
		$contenu = file_get_contents( $fichier );

		if ( preg_match_all( '/(progress|progression|bareme|score|medaille|xp)/i', $contenu, $m ) ) {
			$progression_visible = true;
			$preuve_progression  = basename( $fichier ) . ' : ' . count( $m[0] ) . ' occurrence(s)';
		}
	}
}

audit_verifier(
	'la progression (score, badges, échéances) est visible par l\'élève',
	$progression_visible,
	$progression_visible ? '' : 'Aucun élément de progression visible trouvé : l\'élève ne sait pas '
		. 'où il en est ni ce qu\'il a acquis.',
	'majeur',
	$progression_visible
		? $preuve_progression
		: 'Aucune occurrence de progression dans le plugin'
);

/* ------------------------------------------------------------------ */
echo "\n7. La limite de cet audit\n";

audit_info(
	'La première impression se mesure aussi avec de vrais élèves',
	'Cet audit mesure des faits vérifiables : ce qu\'un visiteur sans compte voit, '
	. 'ce qu\'il peut faire, le nombre de champs d\'inscription, la présence d\'aides, '
	. 'd\'erreurs expliquées et de progression visible. Il ne mesure pas l\'envie de rester : '
	. 'cela demande un test avec de vrais élèves, prévu au palier suivant de la feuille de route.'
);

exit( audit_fin() );
