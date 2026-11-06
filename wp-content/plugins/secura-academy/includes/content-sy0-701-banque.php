<?php
/**
 * Banque de questions etiquetees par sujet SY0-701.
 *
 * POURQUOI CE FICHIER EXISTE
 * --------------------------
 * Un examen blanc ne vaut que si ses questions sont rattachees a un
 * sujet du referentiel. Sans etiquette, impossible de dire a l'eleve
 * « tu as echoue en 5.3, risque lie aux tiers » : on ne peut que lui
 * donner un pourcentage, qui ne lui apprend rien.
 *
 * Chaque question porte donc `topic` — l'identifiant du sujet dans
 * tools/certifications/sy0-701.json — et une explication qui dit
 * POURQUOI la bonne reponse est bonne, et pourquoi le distracteur
 * principal est tentant.
 *
 * REGLE DES DISTRACTEURS
 * ----------------------
 * Un distracteur est une vraie erreur d'apprenant, pas une absurdite.
 * « Utiliser TLS » a cote de « chiffrer le fichier » apprend quelque
 * chose ; « appeler le support » n'apprend rien. Toutes les questions
 * de ce fichier suivent cette regle.
 *
 * SOURCES
 * -------
 * Les notions sont celles du referentiel CompTIA SY0-701 (objectifs
 * publics) et des publications NIST et OWASP citees en fin de fichier.
 * Aucune question n'est copiee d'un examen commercial : elles sont
 * ecrites ici, en francais, a partir de notions publiques.
 *
 * @package Secura_Academy
 */

defined( 'ABSPATH' ) || exit;

/**
 * Banque de questions, indexee par sujet.
 *
 * @return array<string,array[]>
 */
function seca_banque_sy0_701() {
	return array(

		/* ============================================================
		 * D1 — Concepts generaux de securite (12 %)
		 * ============================================================ */

		'1.1' => array(
			array(
				'question'    => 'Une entreprise installe un portique de detection a l\'entree de sa salle serveur. Dans la classification des controles de securite, de quel type s\'agit-il ?',
				'choices'     => array( 'Un controle dissuasif et detectif', 'Un controle preventif', 'Un controle correctif', 'Un controle compensatoire' ),
				'correct'     => 0,
				'explanation' => 'Un portique ne bloque pas le passage : il decourage (dissuasif, parce qu\'il est visible) et il signale (detectif, parce qu\'il alerte). Le correctif agit apres l\'incident (restauration, patch) ; le compensatoire remplace un controle impossible a mettre en place.',
			),
			array(
				'question'    => 'Quelle difference y a-t-il entre un controle preventif et un controle detectif ?',
				'choices'     => array( 'Le preventif est technique, le detectif est toujours humain', 'Le preventif empeche l\'evenement, le detectif le constate', 'Le preventif est payant, le detectif est gratuit', 'Le preventif agit apres l\'incident, le detectif avant' ),
				'correct'     => 1,
				'explanation' => 'Prevenir = empecher que l\'evenement se produise (pare-feu, MFA, badge). Detecter = le constater quand il se produit (IDS, SIEM, camera). Les deux peuvent etre techniques ou humains : la nature du controle ne depend pas de qui l\'execute.',
			),
		),

		'1.2' => array(
			array(
				'question'    => 'Un attaquant modifie des montants dans une base de donnees sans rien voler ni rien rendre indisponible. Quel pilier de la triade CIA est atteint ?',
				'choices'     => array( 'La confidentialite', 'La disponibilite', 'L\'integrite', 'Aucun : il n\'y a pas eu de vol' ),
				'correct'     => 2,
				'explanation' => 'L\'integrite couvre l\'exactitude et la completude de la donnee. Une modification non autorisee est une atteinte a l\'integrite meme si aucune donnee n\'est lue et meme si le service continue de repondre.',
			),
			array(
				'question'    => 'Une attaque par deni de service sature un site marchand. Quelle propriete est directement atteinte, et quelle consequence en decoule pour la triade ?',
				'choices'     => array( 'La confidentialite, parce que des commandes sont exposees', 'Aucune : un service lent n\'est pas un incident de securite', 'L\'integrite, parce que des transactions etaient en cours', 'La disponibilite' ),
				'correct'     => 3,
				'explanation' => 'Le deni de service vise la disponibilite. Mais une indisponibilite pendant une transaction peut aussi laisser des etats incoherents (paiement debite, commande non enregistree) : la disponibilite tombe d\'abord, l\'integrite peut suivre.',
			),
		),

		'1.3' => array(
			array(
				'question'    => 'Quel enonce resume correctement le modele zero trust ?',
				'choices'     => array( 'Ne faire confiance a rien par defaut et verifier chaque acces, y compris interne', 'Faire confiance a tout ce qui est a l\'interieur du reseau, verifier ce qui vient de l\'exterieur', 'Supprimer le pare-feu puisque le reseau interne est de confiance', 'Chiffrer tout le trafic et considerer le reste comme acquis' ),
				'correct'     => 0,
				'explanation' => 'Le zero trust supprime la notion de perimetre de confiance : aucun utilisateur, appareil ou service n\'est digne de confiance parce qu\'il est « dedans ». Chaque acces est evalue (identite, appareil, contexte) avant d\'etre accorde. Le chiffrement fait partie des moyens, pas du principe.',
			),
			array(
				'question'    => 'Dans une architecture zero trust, a quoi sert un point de decision de politique (PDP) ?',
				'choices'     => array( 'A chiffrer les flux entre deux serveurs sur toute la chaine', 'A decider si un acces est autorise', 'A remplacer l\'annuaire des utilisateurs pour les comptes', 'A heberger les journaux de securite de tout le systeme' ),
				'correct'     => 1,
				'explanation' => 'Le PDP evalue la demande (identite, appareil, contexte) et rend la decision ; le PEP (point d\'application) l\'execute sur le flux. Le PDP ne chiffre rien et ne stocke pas les journaux : il decide.',
			),
		),

		'1.4' => array(
			array(
				'question'    => 'Quel est le role principal d\'un comite consultatif de changement (CAB) ?',
				'choices'     => array( 'Executer les changements en production', 'Rediger les politiques de securite de l\'entreprise', 'Evaluer le risque d\'un changement et decider s\'il est autorise', 'Auditer les journaux applicatifs' ),
				'correct'     => 2,
				'explanation' => 'Le CAB evalue l\'impact, le risque et le plan de retour arriere, puis autorise ou refuse. L\'execution revient aux equipes ; le CAB ne touche pas a la production.',
			),
			array(
				'question'    => 'Pourquoi une procedure de retour arriere (rollback) est-elle exigee dans une demande de changement ?',
				'choices'     => array( 'Pour ralentir les equipes et eviter les changements', 'Pour satisfaire l\'auditeur sans effet reel', 'Pour remplacer les sauvegardes', 'Pour pouvoir revenir a un etat connu si le changement degrade le service' ),
				'correct'     => 3,
				'explanation' => 'Le plan de retour arriere transforme un changement risque en changement reversible : si la production se degrade, on revient a l\'etat precedent sans improviser. Il ne remplace pas les sauvegardes, il les complete.',
			),
		),

		'1.5' => array(
			array(
				'question'    => 'Un certificat X.509 est signe par une autorite de certification (CA). Qu\'est-ce que cela prouve exactement ?',
				'choices'     => array( 'Que la cle publique appartient bien a l\'identite du certificat', 'Que le serveur est techniquement fiable et disponible en permanence', 'Que le site ne contient aucune vulnerabilite connue ni inconnue', 'Que le proprietaire du site est honnete et respecte les regles' ),
				'correct'     => 0,
				'explanation' => 'La signature de la CA lie une cle publique a un nom. Elle prouve l\'identite, rien de plus : un site malveillant peut avoir un certificat parfaitement valide.',
			),
			array(
				'question'    => 'Quelle affirmation decrit correctement le chiffrement asymetrique ?',
				'choices'     => array( 'La meme cle chiffre et dechiffre', 'Une cle publique chiffre et signe verifie, la cle privee dechiffre et signe', 'Il est plus rapide que le chiffrement symetrique', 'Il sert uniquement a hacher les mots de passe' ),
				'correct'     => 1,
				'explanation' => 'Paire de cles : la publique est diffusee et sert a chiffrer ou verifier une signature ; la privee reste secrete et sert a dechiffrer ou signer. L\'asymetrique est lent : on l\'utilise pour echanger une cle symetrique, pas pour chiffrer de gros volumes.',
			),
		),

		'1.6' => array(
			array(
				'question'    => 'Quel facteur d\'authentification est le plus faible face au hameconnage ?',
				'choices'     => array( 'Une cle FIDO2 sur port USB', 'Un mot de passe', 'Un code a usage unique envoye par SMS', 'Une empreinte digitale' ),
				'correct'     => 2,
				'explanation' => 'Un code SMS se laisse relayer en direct par un site imitateur : c\'est le detournement de code en temps reel. FIDO2 est lie au domaine d\'origine et ne peut pas etre rejoue sur un faux site ; le mot de passe, lui, se saisit aussi sur un faux site, mais FIDO2 reste plus resistant que le SMS.',
			),
			array(
				'question'    => 'Une entreprise impose un mot de passe ET un badge. S\'agit-il de MFA ?',
				'choices'     => array( 'Oui, ce sont deux facteurs differents', 'Oui, a condition que le badge soit a puce', 'Non : un mot de passe et un badge sont deux facteurs, donc oui', 'Non, s\'il s\'agit de deux mots de passe de deux annuaires differents' ),
				'correct'     => 3,
				'explanation' => 'MFA exige des facteurs de NATURES differentes : savoir (mot de passe), posseder (badge, telephone), etre (biometrie). Deux mots de passe, meme dans deux annuaires, restent un seul type de facteur : c\'est du multi-etape, pas du multifacteur.',
			),
		),

		'1.7' => array(
			array(
				'question'    => 'Quel controle physique reduit le mieux le risque de vol de donnees par un visiteur legitime ?',
				'choices'     => array( 'Un accompagnement des visiteurs et un cloisonnement des zones', 'Une camera dans le hall qui enregistre et conserve les passages', 'Une politique de sensibilisation affichee dans le hall d\'accueil', 'Un antivirus a jour sur chaque poste de travail du site' ),
				'correct'     => 0,
				'explanation' => 'La camera constate apres coup. L\'accompagnement et le cloisonnement des zones empechent le visiteur d\'atteindre ce qu\'il ne doit pas voir : c\'est preventif et c\'est physique.',
			),
			array(
				'question'    => 'Pourquoi un systeme de detection d\'incendie a-t-il un statut particulier dans la securite d\'un site ?',
				'choices'     => array( 'Il est inutile en salle serveur', 'Il protege la disponibilite des actifs, pas seulement les personnes', 'Il releve uniquement de la conformite, pas de la securite', 'Il remplace les sauvegardes' ),
				'correct'     => 1,
				'explanation' => 'Un incendie detruit les serveurs : la detection et l\'extinction protegent la disponibilite et l\'integrite des actifs. C\'est un controle de continuite autant que de securite des personnes.',
			),
		),

		/* ============================================================
		 * D2 — Menaces, vulnerabilites et attenuations (22 %)
		 * ============================================================ */

		'2.1' => array(
			array(
				'question'    => 'Un groupe agit pour des motifs politiques et cherche a detruire des donnees d\'entreprise. Dans quelle categorie le classe-t-on ?',
				'choices'     => array( 'Un cybercriminel financier', 'Un acteur interne maladroit', 'Un hacktiviste', 'Un etat-nation' ),
				'correct'     => 2,
				'explanation' => 'L\'hacktiviste agit par ideologie : defacement, fuite, sabotage symbolique. L\'etat-nation vise le renseignement ou le sabotage strategique ; le cybercriminel vise l\'argent ; l\'insider maladroit n\'a pas d\'intention hostile.',
			),
			array(
				'question'    => 'Quel avantage un acteur interne represente-t-il par rapport a un attaquant externe ?',
				'choices'     => array( 'Il ne peut pas etre detecte', 'Il est toujours plus competent techniquement', 'Il dispose de meilleurs outils', 'Il connait l\'infrastructure et possede deja des acces legitimes' ),
				'correct'     => 3,
				'explanation' => 'L\'insider part de l\'interieur : il connait les actifs, les horaires, les comptes. Sa signature ressemble a un usage normal, ce qui rend la detection difficile — mais il reste detectable par l\'analyse de comportement.',
			),
		),

		'2.2' => array(
			array(
				'question'    => 'Un serveur expose un port SSH ouvert sur Internet alors que l\'administration passe par un VPN. Comment qualifie-t-on ce port ?',
				'choices'     => array( 'Une surface d\'attaque evitable', 'Une faille logicielle', 'Un controle compensatoire', 'Un indicateur de compromission' ),
				'correct'     => 0,
				'explanation' => 'Ce n\'est pas encore une vulnerabilite exploitable, c\'est une exposition inutile : chaque service joignable est une porte a defendre. Fermer ce port reduit la surface d\'attaque sans rien changer au service rendu.',
			),
			array(
				'question'    => 'Quel vecteur d\'attaque est le plus difficile a reduire par des moyens techniques seuls ?',
				'choices'     => array( 'Une faille de service expose', 'L\'hameconnage cible d\'un collaborateur', 'Un certificat expire', 'Un mot de passe faible' ),
				'correct'     => 1,
				'explanation' => 'Contre l\'hameconnage, les filtres aident mais ne suffisent pas : l\'utilisateur reste la cible. La reduction passe par la formation et par des mecanismes qui pardonnent l\'erreur (MFA resistante au hameconnage).',
			),
			array(
				'question'    => 'Une entreprise decide de fermer tous les ports sortants sauf le web. Quel effet a cette mesure ?',
				'choices'     => array( 'Elle chiffre automatiquement le trafic sortant vers Internet', 'Elle remplace le pare-feu par un filtrage applicatif complet', 'Elle reduit la surface d\'attaque en limitant les sorties possibles', 'Elle empeche les utilisateurs de travailler sans aucun interet' ),
				'correct'     => 2,
				'explanation' => 'Restreindre les sorties reduit ce qu\'un maliciel peut joindre : un canal de commande sur un port exotique est coupe. Le filtrage sortant est l\'une des mesures les plus rentables, car il gene aussi les attaquants deja presents.',
			),
		),

		'2.3' => array(
			array(
				'question'    => 'Un message imite le service informatique et demande de valider un quota de messagerie sous 10 minutes. Quels signaux doivent alerter ?',
				'choices'     => array( 'La longueur du message et le nombre de paragraphes qu\'il contient', 'Le fait qu\'il soit redige en francais correct et poli', 'L\'absence de piece jointe et la qualite de la mise en forme', 'L\'urgence, l\'expediteur inhabituel et la demande d\'action' ),
				'correct'     => 3,
				'explanation' => 'L\'urgence fabriquee court-circuite la reflexion ; l\'expediteur usurpe et le lien demandent une verification par un autre canal. Ce sont les trois marqueurs classiques d\'un hameconnage.',
			),
			array(
				'question'    => 'Quelle difference y a-t-il entre hameconnage et harponnage (spear phishing) ?',
				'choices'     => array( 'Le harponnage vise une personne precise, avec des informations ciblees', 'Le harponnage est envoye par SMS a un grand nombre de personnes', 'Aucune difference : ce sont deux mots pour la meme technique', 'Le hameconnage vise uniquement les dirigeants et les cadres' ),
				'correct'     => 0,
				'explanation' => 'Le harponnage est personnalise : nom du projet, nom du collegue, contexte reel. C\'est cette personnalisation qui le rend credible et dangereux. Le SMS, c\'est le smishing ; les dirigeants, c\'est le whale phishing.',
			),
		),

		'2.4' => array(
			array(
				'question'    => 'Un logiciel chiffre les fichiers du disque et reclame un paiement. De quel type de maliciel s\'agit-il, et quel est le premier objectif de la reponse ?',
				'choices'     => array( 'Un rootkit ; changer les mots de passe', 'Un rançongiciel ; isoler la machine pour stopper la propagation', 'Un ver ; debrancher Internet pour tout le site', 'Un cheval de Troie ; reinstaller le systeme' ),
				'correct'     => 1,
				'explanation' => 'Rançongiciel = chiffrement contre rançon. La premiere action est l\'isolement du poste : tant qu\'il est connecte, il peut chiffrer les partages reseau. On ne paie pas, on restaure depuis une sauvegarde saine.',
			),
			array(
				'question'    => 'Qu\'est-ce qui distingue un ver d\'un virus ?',
				'choices'     => array( 'Le virus se propage par le reseau, le ver par fichier', 'Le ver ne fait pas de degats', 'Le ver se propage seul sur le reseau, sans action de l\'utilisateur', 'Le ver est toujours un rançongiciel' ),
				'correct'     => 2,
				'explanation' => 'Le virus a besoin d\'un hote et d\'une action (ouvrir le fichier). Le ver s\'execute et se propage de machine en machine par lui-meme : c\'est pourquoi il peut saturer un reseau en minutes.',
			),
			array(
				'question'    => 'Quel comportement caracterise une porte derobee (backdoor) installee par un maliciel ?',
				'choices'     => array( 'Un ralentissement general du poste de travail', 'Une augmentation de la consommation electrique du serveur', 'Un message d\'erreur affiche a chaque demarrage du systeme', 'Un acces permanent qui contourne l\'authentification normale' ),
				'correct'     => 3,
				'explanation' => 'La porte derobee donne a l\'attaquant un chemin d\'acces qui ne passe pas par l\'authentification : elle survit souvent au changement de mot de passe. C\'est pourquoi on reinstalle au lieu de nettoyer apres une compromission profonde.',
			),
		),

		'2.5' => array(
			array(
				'question'    => 'Une application affiche directement dans sa page le parametre recu en URL. Quel risque principal en decoule ?',
				'choices'     => array( 'Une injection de script (XSS) reflechie', 'Un deni de service', 'Une traversee de repertoire', 'Une injection SQL' ),
				'correct'     => 0,
				'explanation' => 'Le contenu fourni par l\'utilisateur revient tel quel dans la page et le navigateur l\'execute dans le contexte du site : c\'est du XSS reflechi. La parade est l\'echappement en sortie, pas le filtrage en entree seul.',
			),
			array(
				'question'    => 'Pourquoi une requete preparee protege-t-elle de l\'injection SQL ?',
				'choices'     => array( 'Elle supprime les apostrophes des valeurs envoyees par l\'utilisateur', 'Elle separe la structure de la requete des donnees', 'Elle encode la requete complete en base64 avant de l\'envoyer', 'Elle verifie la longueur maximale de chaque champ du formulaire' ),
				'correct'     => 1,
				'explanation' => 'La requete est compilee avant que les valeurs arrivent : une valeur ne peut pas changer la structure. Un filtre d\'apostrophes, lui, se contourne par d\'autres encodages.',
			),
		),

		'2.6' => array(
			array(
				'question'    => 'Qu\'est-ce qu\'une attaque par empoisonnement ARP sur un reseau local ?',
				'choices'     => array( 'Couper le service DHCP', 'Usurper une adresse IP pour se faire passer pour un serveur web', 'Faire croire aux machines que l\'attaquant est la passerelle, pour intercepter leur trafic', 'Saturer le reseau de trames pour le rendre inutilisable' ),
				'correct'     => 2,
				'explanation' => 'ARP associe une adresse IP a une adresse MAC sans verification. L\'attaquant repond a la place de la passerelle et devient le passage oblige : c\'est de l\'interception (attaque de l\'homme du milieu). Les parades sont la surveillance ARP dynamique et le cloisonnement des VLAN.',
			),
			array(
				'question'    => 'Une entreprise subit une attaque DNS par empoisonnement de cache. Quelle en est la consequence directe ?',
				'choices'     => array( 'Les mots de passe des utilisateurs deviennent lisibles sur le reseau', 'Les serveurs de l\'entreprise tombent en panne les uns apres les autres', 'Les sauvegardes de la veille sont corrompues sans trace dans les journaux', 'Les utilisateurs sont rediriges vers un faux site' ),
				'correct'     => 3,
				'explanation' => 'Le cache DNS associe un nom a une adresse. L\'empoisonner redirige les utilisateurs vers le serveur de l\'attaquant : la victime tape la bonne adresse et arrive ailleurs. C\'est une usurpation, pas un deni de service.',
			),
		),

		'2.7' => array(
			array(
				'question'    => 'Un programme copie dans un tampon de 64 octets une chaine de 200 octets. Que se passe-t-il ?',
				'choices'     => array( 'Les octets en trop ecrasent la memoire voisine, ce qui peut detourner l\'execution', 'Rien : le systeme alloue 200 octets', 'La chaine est tronquee automatiquement', 'Le programme leve une exception et s\'arrete proprement' ),
				'correct'     => 0,
				'explanation' => 'En C, l\'ecriture n\'est pas bornee : les octets depassent le tampon et ecrasent la pile (donnee de controle, adresse de retour). C\'est le debordement de tampon, qui peut mener a l\'execution de code.',
			),
			array(
				'question'    => 'Quelle defense rend un debordement de pile beaucoup plus difficile a exploiter, sans corriger la faille ?',
				'choices'     => array( 'L\'antivirus', 'Le canari de pile (stack canary)', 'Un pare-feu applicatif', 'Le chiffrement du binaire' ),
				'correct'     => 1,
				'explanation' => 'Le canari est une valeur sentinelle placee avant l\'adresse de retour ; s\'il est ecrase, le programme s\'arrete avant de revenir. Cela ne corrige pas la faille, cela empeche l\'exploitation. La correction reste de borner l\'ecriture.',
			),
			array(
				'question'    => 'Que fait ASLR contre l\'exploitation d\'une vulnerabilite memoire ?',
				'choices'     => array( 'Elle chiffre le contenu de la pile avant chaque appel de fonction', 'Elle empeche le programme d\'ecrire au-dela d\'un tampon alloue', 'Elle rend aleatoire l\'adresse de chargement des zones memoire', 'Elle journalise chaque acces memoire pour une analyse ulterieure' ),
				'correct'     => 2,
				'explanation' => 'ASLR deplace les zones a chaque execution : l\'attaquant ne connait plus l\'adresse a viser. Cela ne corrige pas la faille et ne borne pas l\'ecriture ; cela rend l\'exploitation plus difficile et souvent instable.',
			),
		),

		'2.8' => array(
			array(
				'question'    => 'Lequel de ces elements est un indicateur de compromission plutot qu\'un indice de vulnerabilite ?',
				'choices'     => array( 'Un serveur dont le correctif de securite mensuel n\'est pas applique', 'Un mot de passe par defaut inchange depuis l\'installation', 'Un port de test encore ouvert sur le serveur de recette de l\'equipe', 'Une connexion sortante vers une adresse inconnue a 3 h du matin' ),
				'correct'     => 3,
				'explanation' => 'Un indicateur de compromission (IoC) prouve qu\'un evenement a eu lieu : trafic anormal, hachage de fichier connu malveillant, compte cree sans autorisation. Un correctif manquant est une vulnerabilite, pas une compromission.',
			),
			array(
				'question'    => 'Un editeur diffuse le hachage SHA-256 de son installeur. A quoi sert cette empreinte pour l\'utilisateur ?',
				'choices'     => array( 'A verifier que le fichier telecharge n\'a pas ete altere', 'A dechiffrer le fichier', 'A accelerer le telechargement', 'A prouver l\'identite du site web' ),
				'correct'     => 0,
				'explanation' => 'Le hachage agit comme une empreinte : si un octet change, le hachage change. L\'utilisateur compare l\'empreinte obtenue a celle publiee. Attention : cela ne vaut que si l\'empreinte est recuperee par un canal de confiance.',
			),
			array(
				'question'    => 'Une alerte signale un pic de trafic DNS vers un domaine jamais vu, a heure fixe, depuis un poste utilisateur. Que faut-il en conclure en premier ?',
				'choices'     => array( 'Le serveur DNS de l\'entreprise a besoin d\'un redemarrage', 'Le poste est probablement en communication avec une infrastructure de commande', 'L\'utilisateur consulte un site legitime et il n\'y a rien a faire', 'Le pare-feu doit etre desactive pour laisser passer le trafic' ),
				'correct'     => 1,
				'explanation' => 'Une resolution periodique vers un domaine inconnu, a heure fixe, est un signe classique de canal de commande et de controle. Premier reflexe : isoler le poste et capturer les preuves, pas couper le DNS de tout le monde.',
			),
		),

		/* ============================================================
		 * D3 — Architecture de securite (18 %)
		 * ============================================================ */

		'3.1' => array(
			array(
				'question'    => 'Quelle caracteristique distingue un modele de responsabilite partagee dans le cloud ?',
				'choices'     => array( 'Le fournisseur est responsable de tout, y compris des donnees clientes', 'La responsabilite change selon le prix et le niveau de service', 'Le client reste responsable de ses donnees et de sa configuration', 'Le client est responsable du materiel, le fournisseur du logiciel' ),
				'correct'     => 2,
				'explanation' => 'Le fournisseur securise l\'infrastructure jusqu\'a une limite (le service) ; le client securise ce qu\'il met dessus : comptes, droits, chiffrement, configuration. Un seau de stockage public est une erreur du client, pas du fournisseur.',
			),
			array(
				'question'    => 'Une entreprise veut garder ses donnees sensibles sur site mais externaliser un site web public. Quelle architecture decrit-elle ?',
				'choices'     => array( 'Un cloud prive', 'Un cloud public', 'Une architecture en cascade', 'Une architecture hybride' ),
				'correct'     => 3,
				'explanation' => 'Hybride = combinaison de ressources sur site et dans le cloud, avec un lien entre les deux. Le cloud prive, lui, resterait entierement dedie a l\'entreprise, y compris le site public.',
			),
			array(
				'question'    => 'Une entreprise heberge son site vitrine chez un fournisseur et garde son annuaire d\'identites sur site. Quel point de vigilance en decoule ?',
				'choices'     => array( 'Le lien entre les deux environnements doit etre authentifie et restreint', 'Le fournisseur devient responsable de l\'annuaire sur site', 'Le site vitrine doit etre heberge sur site pour des raisons legales', 'Aucun : les deux environnements sont independants par nature' ),
				'correct'     => 0,
				'explanation' => 'Des qu\'un service externe parle a un annuaire interne, ce lien devient une porte : il faut l\'authentifier, le restreindre par adresse et par compte, et le journaliser. C\'est le point de jonction que les attaquants cherchent.',
			),
		),

		'3.2' => array(
			array(
				'question'    => 'A quoi sert une zone demilitarisee (DMZ) ?',
				'choices'     => array( 'A accelerer le trafic entre le site public et les serveurs internes', 'A isoler les services exposes a Internet du reseau interne', 'A remplacer le pare-feu par un filtrage applicatif des requetes', 'A stocker les sauvegardes hors du site, dans un autre batiment' ),
				'correct'     => 1,
				'explanation' => 'La DMZ est un segment intermediaire : si le serveur web expose est compromis, l\'attaquant n\'a pas d\'acces direct au reseau interne. Elle reduit le mouvement lateral, elle ne remplace pas le pare-feu qui la delimite.',
			),
			array(
				'question'    => 'Pourquoi un VLAN seul ne suffit-il pas a isoler deux services sensibles ?',
				'choices'     => array( 'Parce qu\'un VLAN ne transporte pas l\'Ethernet', 'Parce qu\'un VLAN est toujours public', 'Parce que le routage entre VLAN peut autoriser le passage si les regles ne sont pas ecrites', 'Parce qu\'un VLAN ne peut pas etre configure sur un switch' ),
				'correct'     => 2,
				'explanation' => 'Le VLAN segmente la diffusion, mais un routeur peut relier les VLAN : sans regle de filtrage explicite, le trafic passe. Segmentation logique et filtrage vont ensemble.',
			),
		),

		'3.3' => array(
			array(
				'question'    => 'Un service applicatif tourne sous le compte root du serveur. Quel principe est viole ?',
				'choices'     => array( 'Le zero trust', 'La defense en profondeur', 'La separation des taches', 'Le moindre privilege' ),
				'correct'     => 3,
				'explanation' => 'Le service n\'a besoin que de ses fichiers et de son port : root lui donne tout le systeme. Une faille dans ce service compromet la machine entiere au lieu de la seule application.',
			),
			array(
				'question'    => 'Quelle pratique releve de la separation des privileges ?',
				'choices'     => array( 'Utiliser un compte administrateur distinct du compte quotidien', 'Installer un antivirus a jour sur chaque poste et le laisser actif', 'Segmenter le reseau en VLAN separes par service et par etage', 'Chiffrer le disque dur avec une cle differente par utilisateur' ),
				'correct'     => 0,
				'explanation' => 'Separer les privileges, c\'est ne pas cumuler dans une meme session les droits d\'administration et l\'usage courant. Une page web piegee ouverte dans la session quotidienne ne peut alors pas installer de logiciel.',
			),
			array(
				'question'    => 'Un service web doit ecrire dans un dossier de televersement. Quelle configuration respecte le moindre privilege ?',
				'choices'     => array( 'Le compte de l\'administrateur, pour pouvoir intervenir vite', 'Un compte dedie, avec l\'ecriture limitee a ce seul dossier', 'Un compte partage par tous les services du serveur', 'Le compte root, pour eviter tout probleme de droits' ),
				'correct'     => 1,
				'explanation' => 'Le service n\'a besoin que d\'ecrire dans son dossier : un compte dedie et un droit limite suffisent. Si ce service est compromis, l\'attaquant n\'obtient que ce perimetre, pas la machine entiere.',
			),
		),

		'3.4' => array(
			array(
				'question'    => 'Une entreprise classe ses donnees en public, interne, confidentiel et secret. Quel est l\'interet de cette classification ?',
				'choices'     => array( 'Ameliorer la vitesse du reseau', 'Satisfaire une mode documentaire', 'Adapter les controles de protection a la sensibilite de la donnee', 'Ranger les fichiers dans des dossiers' ),
				'correct'     => 2,
				'explanation' => 'La classification sert a decider : qui peut lire, comment on stocke, comment on transmet, combien de temps on garde. Sans elle, on protege tout au maximum (trop cher) ou rien (trop risque).',
			),
			array(
				'question'    => 'Quelle mesure protege une donnee au repos sur un disque vole ?',
				'choices'     => array( 'Un systeme de detection d\'intrusion sur le reseau interne', 'Un pare-feu applicatif place devant l\'application web', 'Le chiffrement TLS de la connexion entre le client et le serveur', 'Le chiffrement du volume disque' ),
				'correct'     => 3,
				'explanation' => 'TLS protege la donnee en transit ; une fois le disque sorti du serveur, plus rien ne la protege sans chiffrement du volume. Ce sont deux protections differentes et complementaires.',
			),
			array(
				'question'    => 'Quelle mesure empeche un utilisateur non autorise d\'envoyer par courriel un fichier de donnees clients ?',
				'choices'     => array( 'Une solution de prevention de fuite de donnees (DLP)', 'Un chiffrement du volume du serveur de fichiers', 'Une segmentation reseau en zones distinctes', 'Un systeme de detection d\'intrusion sur le reseau' ),
				'correct'     => 0,
				'explanation' => 'La DLP inspecte le contenu (mots-cles, empreintes, formats) et bloque la sortie par courriel, par web ou par cle USB. Le chiffrement du volume protege un disque vole, pas un envoi legitime devenu abusif.',
			),
		),

		'3.5' => array(
			array(
				'question'    => 'Quelle regle rend une sauvegarde reellement utilisable en cas de rançongiciel ?',
				'choices'     => array( 'Une sauvegarde complete effectuee une seule fois par an', 'Une copie hors ligne ou immuable, restauree au moins une fois', 'Une sauvegarde chiffree avec la meme cle que la production', 'Une sauvegarde sur le meme serveur, pour aller plus vite' ),
				'correct'     => 1,
				'explanation' => 'Un rançongiciel chiffre tout ce qui est joignable : une sauvegarde en ligne sur le meme reseau sera chiffree aussi. Il faut une copie hors d\'atteinte, et surtout une restauration deja testee — une sauvegarde jamais restauree n\'est qu\'une hypothese.',
			),
			array(
				'question'    => 'Que mesurent les objectifs RTO et RPO ?',
				'choices'     => array( 'Deux mesures de chiffrement des sauvegardes sur bande magnetique', 'Le RTO borne le volume de donnees perdues, le RPO la duree d\'arret', 'Le RTO borne la duree d\'arret, le RPO la perte de donnees', 'Deux niveaux de classification des donnees dans l\'entreprise' ),
				'correct'     => 2,
				'explanation' => 'RTO = combien de temps le service peut rester arrete. RPO = combien de donnees on accepte de perdre (donc a quelle frequence sauvegarder). Les confondre conduit a une sauvegarde quotidienne pour un service qui exige une reprise en 10 minutes.',
			),
			array(
				'question'    => 'Une entreprise teste sa restauration pour la premiere fois le jour de l\'incident et decouvre que la sauvegarde est illisible. Quel defaut de methode est en cause ?',
				'choices'     => array( 'La sauvegarde etait trop frequentement realisee', 'Le chiffrement de la sauvegarde etait trop robuste', 'Le plan de reprise manquait de redondance materielle', 'Aucun test de restauration n\'etait planifie avant l\'incident' ),
				'correct'     => 3,
				'explanation' => 'Une sauvegarde non testee n\'est pas une sauvegarde, c\'est une hypothese. Le test de restauration periodique fait partie du plan de continuite : il valide le support, la cle, la duree et la procedure.',
			),
		),

		'3.6' => array(
			array(
				'question'    => 'Pourquoi un objet connecte industriel est-il souvent plus difficile a proteger qu\'un serveur ?',
				'choices'     => array( 'Il ne peut pas etre mis a jour ou eteint facilement', 'Il ne possede pas d\'adresse reseau et reste invisible en ligne', 'Il coute beaucoup moins cher qu\'un serveur classique a l\'achat', 'Il utilise toujours un antivirus fourni par le constructeur' ),
				'correct'     => 0,
				'explanation' => 'Un automate pilote une chaine de production : on ne peut pas l\'eteindre pour le patcher, et certains modeles n\'ont plus de support. La reponse est alors la segmentation (le placer dans une zone isolee) plutot que le correctif.',
			),
			array(
				'question'    => 'Quelle mesure reduit le mieux le risque d\'un parc d\'objets connectes non maintenus ?',
				'choices'     => array( 'Les laisser en place en esperant', 'Les placer sur un reseau separe a acces restreint', 'Changer leur mot de passe une fois par semaine', 'Leur installer un antivirus' ),
				'correct'     => 1,
				'explanation' => 'Quand on ne peut pas corriger, on isole : un VLAN dedie avec des regles strictes limite ce qu\'un objet compromis peut atteindre. C\'est un controle compensatoire, pas une correction.',
			),
		),
		/* ============================================================
		 * D4 — Operations de securite (28 %)
		 * ============================================================ */

		'4.1' => array(
			array(
				'question'    => 'Quelle action releve du durcissement d\'un serveur Linux ?',
				'choices'     => array( 'Ajouter un compte administrateur par utilisateur', 'Autoriser SSH avec mot de passe pour aller plus vite', 'Desactiver les services inutiles et fermer les ports non utilises', 'Installer une interface graphique' ),
				'correct'     => 2,
				'explanation' => 'Durcir, c\'est reduire ce qui est expose : chaque service actif est une porte. Fermer les ports inutiles et refuser l\'authentification SSH par mot de passe reduit la surface sans degrader le service.',
			),
			array(
				'question'    => 'Pourquoi l\'authentification par cle SSH est-elle preferee au mot de passe sur un serveur expose ?',
				'choices'     => array( 'Parce qu\'elle supprime le besoin de pare-feu', 'Parce qu\'elle est plus rapide a taper', 'Parce qu\'elle chiffre le disque', 'Parce qu\'elle resiste au devinement et au bourrage d\'identifiants' ),
				'correct'     => 3,
				'explanation' => 'Une cle privee de 256 bits ne se devine pas : les attaques par force brute sur les mots de passe perdent leur objet. Cela ne remplace ni le pare-feu ni la mise a jour.',
			),
			array(
				'question'    => 'Pourquoi desactive-t-on l\'ouverture de session automatique sur un poste en libre-service ?',
				'choices'     => array( 'Pour qu\'une session ouverte ne permette pas d\'agir sous une identite', 'Pour reduire la consommation de la connexion reseau partagee', 'Pour accelerer le demarrage du poste et economiser l\'energie', 'Pour empecher l\'installation des mises a jour automatiques' ),
				'correct'     => 0,
				'explanation' => 'Une session ouverte sans mot de passe donne a quiconque passe devant l\'ecran les droits de l\'utilisateur, y compris sur des donnees sensibles. Le verrouillage automatique et la deconnexion sont des mesures de durcissement de base.',
			),
			array(
				'question'    => 'Un poste de developpeur dispose d\'outils d\'administration reseau non utilises en production. Que faire ?',
				'choices'     => array( 'Les conserver : ils ne pesent presque rien sur le disque du poste', 'Les retirer ou les restreindre, car ils etendent la surface d\'attaque du poste', 'Les desactiver uniquement pendant les periodes de conges', 'Les rendre accessibles a tous les utilisateurs pour mutualiser' ),
				'correct'     => 1,
				'explanation' => 'Un outil installe mais inutile est une capacite offerte a un attaquant qui prend le poste. Le durcissement consiste a retirer ce qui ne sert pas, pas a le laisser dormir : c\'est la definition de la reduction de surface.',
			),
		),

		'4.2' => array(
			array(
				'question'    => 'A quoi sert un inventaire d\'actifs dans un programme de vulnerabilites ?',
				'choices'     => array( 'A compter les employes', 'A ranger le materiel dans un local', 'A savoir ce que l\'on possede pour le scanner et le corriger', 'A calculer le budget informatique' ),
				'correct'     => 2,
				'explanation' => 'On ne peut pas corriger ce qu\'on ignore. L\'inventaire determine le perimetre du scan et permet de reperer les actifs oublies, souvent les plus vulnerables.',
			),
			array(
				'question'    => 'Un scan de vulnerabilites signale 40 failles critiques sur un serveur. Quelle est la premiere etape de traitement ?',
				'choices'     => array( 'Reinstaller le serveur avec une version a jour du systeme', 'Ignorer le rapport jusqu\'au prochain cycle trimestriel de scan', 'Corriger les 40 failles dans l\'ordre alphabetique, sans exception', 'Confirmer les failles et evaluer leur exploitabilite reelle' ),
				'correct'     => 3,
				'explanation' => 'Un scan produit des faux positifs et ignore le contexte (service non expose, fonctionnalite non utilisee). On trie par risque reel avant de corriger, sinon on passe des semaines sur des failles inexploitables.',
			),
			array(
				'question'    => 'Comment prioriser deux vulnerabilites : l\'une critique sur un serveur non expose, l\'autre moyenne sur un service en production joignable de tous ?',
				'choices'     => array( 'Traiter d\'abord celle du service expose, malgre une severite moindre', 'Traiter les deux en meme temps, quel que soit le contexte', 'Traiter d\'abord la critique, parce que son score est plus eleve', 'Reporter les deux au prochain cycle annuel de correction' ),
				'correct'     => 0,
				'explanation' => 'Le score brut ne dit pas le risque : l\'exposition change tout. Une faille moyenne joignable par Internet est souvent plus urgente qu\'une faille critique sur une machine interne sans service.',
			),
		),

		'4.3' => array(
			array(
				'question'    => 'Dans un journal d\'authentification, une rafale de reponses 401 suivie d\'un 200 sur le meme compte signifie probablement :',
				'choices'     => array( 'Un utilisateur qui a change de mot de passe', 'Un bourrage d\'identifiants reussi', 'Un certificat expire', 'Une panne du serveur' ),
				'correct'     => 1,
				'explanation' => 'Les 401 repetes sont les tentatives ratees, le 200 est la reussite. La sequence indique un mot de passe trouve apres plusieurs essais : c\'est le signal classique du bourrage d\'identifiants.',
			),
			array(
				'question'    => 'Que fait un SIEM que ne fait pas un simple fichier de journal ?',
				'choices'     => array( 'Il stocke les journaux de toutes les sources dans un espace central', 'Il remplace l\'antivirus sur les postes et sur les serveurs', 'Il correle des evenements de sources differentes', 'Il chiffre les journaux avant de les archiver pour les proteger' ),
				'correct'     => 2,
				'explanation' => 'Le fichier de journal enregistre ; le SIEM agrège, normalise et correle. C\'est la correlation qui fait apparaitre une attaque repartie sur plusieurs sources (connexion VPN puis acces anormal a un partage).',
			),
			array(
				'question'    => 'Pourquoi la synchronisation des horloges est-elle indispensable a l\'exploitation des journaux ?',
				'choices'     => array( 'Pour reduire la taille des fichiers de journaux generes', 'Pour chiffrer automatiquement les journaux archives', 'Pour empecher un attaquant de modifier les journaux', 'Pour pouvoir ordonner les evenements venus de plusieurs machines' ),
				'correct'     => 3,
				'explanation' => 'Sans heure commune, impossible de reconstituer la chronologie d\'une attaque repartie sur plusieurs sources. C\'est aussi ce qui rend une trace opposable lors d\'une procedure.',
			),
		),

		'4.4' => array(
			array(
				'question'    => 'Quelle difference y a-t-il entre un IDS et un IPS ?',
				'choices'     => array( 'L\'IDS alerte, l\'IPS bloque', 'L\'IDS est materiel, l\'IPS est logiciel', 'L\'IDS chiffre, l\'IPS dechiffre', 'Aucune' ),
				'correct'     => 0,
				'explanation' => 'L\'IDS detecte et signale en restant hors du flux ; l\'IPS est place dans le flux et peut couper. L\'IPS protege mais peut bloquer du trafic legitime : c\'est son risque.',
			),
			array(
				'question'    => 'Une alerte IDS se declenche sur une signature de scan de ports venant de l\'adresse d\'un partenaire. Que faire en premier ?',
				'choices'     => array( 'Ignorer l\'alerte puisque l\'adresse appartient a un partenaire', 'Verifier le contexte avant d\'agir', 'Eteindre l\'IDS pour eviter de nouvelles alertes identiques', 'Bloquer definitivement l\'adresse du partenaire dans le pare-feu' ),
				'correct'     => 1,
				'explanation' => 'Une alerte n\'est pas une certitude : un scan peut etre autorise par contrat, ou venir d\'un partenaire compromis. L\'analyse du contexte precede l\'action, sinon on coupe une relation d\'affaires legitime.',
			),
			array(
				'question'    => 'Quel est l\'interet d\'un EDR par rapport a un antivirus classique ?',
				'choices'     => array( 'Il chiffre le disque dur contre le vol de l\'ordinateur', 'Il supprime le besoin de former les utilisateurs', 'Il analyse les comportements et permet d\'isoler la machine a distance', 'Il remplace le pare-feu perimetral de l\'entreprise' ),
				'correct'     => 2,
				'explanation' => 'L\'antivirus classique compare des signatures ; l\'EDR observe les processus, les commandes et les connexions, et permet de confiner un poste depuis la console. C\'est la capacite d\'isolement qui fait la difference en incident.',
			),
		),

		'4.5' => array(
			array(
				'question'    => 'Quel principe guide l\'attribution des droits dans une gestion des identites saine ?',
				'choices'     => array( 'Attribuer les droits par anciennete', 'Donner le maximum pour eviter les demandes', 'Donner les memes droits a toute l\'equipe', 'Accorder le minimum necessaire, avec une revue periodique' ),
				'correct'     => 3,
				'explanation' => 'Moindre privilege et revue periodique : les droits s\'accumulent avec les mutations, et une revue reguliere les fait redescendre. Sans revue, le compte d\'un stagiaire peut garder des acces des annees.',
			),
			array(
				'question'    => 'A quoi sert le provisionnement automatise des comptes lors d\'un depart ?',
				'choices'     => array( 'A desactiver les acces immediatement et eviter les comptes orphelins', 'A accelerer l\'arrivee des nouveaux', 'A reduire le cout des licences uniquement', 'A ameliorer l\'experience utilisateur' ),
				'correct'     => 0,
				'explanation' => 'Un compte orphelin est une porte ouverte que personne ne surveille. La desactivation automatique au depart est un controle de securite, pas une commodite administrative.',
			),
			array(
				'question'    => 'Quel risque cree un compte de service partage entre plusieurs applications ?',
				'choices'     => array( 'Il empeche l\'application de demarrer correctement', 'On ne peut plus attribuer une action a une application precise', 'Il consomme davantage de ressources sur le serveur', 'Le compte expire plus vite que les autres comptes' ),
				'correct'     => 1,
				'explanation' => 'Un compte partage detruit la tracabilite : on ne sait plus quelle application a fait quoi, donc on ne peut ni investiguer ni retirer un droit sans casser les autres. Un compte par application, c\'est aussi pour pouvoir repondre a incident.',
			),
			array(
				'question'    => 'Pourquoi le MFA sur les comptes a privilege eleve est-il prioritaire sur les autres comptes ?',
				'choices'     => array( 'Parce que ces comptes sont utilises plus souvent que les autres', 'Parce que les autres comptes ne presentent aucun risque reel', 'Parce qu\'un vol de ces comptes donne acces a tout le systeme', 'Parce que le fournisseur facture le MFA par utilisateur simple' ),
				'correct'     => 2,
				'explanation' => 'Le facteur temps est ce qui limite les degats pendant la fenetre d\'attaque : la premiere heure, l\'attaquant cherche les comptes les plus puissants. Proteger les comptes a privilege eleve en priorite est un arbitrage de risque, pas une preference.',
			),
		),

		'4.6' => array(
			array(
				'question'    => 'Quel est l\'ordre correct des phases de reponse a incident ?',
				'choices'     => array( 'Detection, confinement, preparation, eradication', 'Confinement, detection, restauration, analyse', 'Analyse, confinement, detection, lecons', 'Preparation, detection et analyse, confinement, eradication, restauration, lecons' ),
				'correct'     => 3,
				'explanation' => 'On se prepare avant ; on detecte et analyse ; on confine pour arreter la propagation ; on eradique la cause ; on restaure ; on tire les lecons. Confiner avant d\'analyser fait perdre les preuves, mais attendre trop longtemps laisse propager : c\'est un arbitrage.',
			),
			array(
				'question'    => 'Pourquoi la phase de confinement peut-elle entrer en conflit avec l\'analyse ?',
				'choices'     => array( 'Confiner stoppe la propagation mais fige les indices volatils', 'Confiner detruit forcement toutes les preuves presentes sur la machine', 'Il n\'existe aucun conflit entre ces deux phases d\'un incident', 'L\'analyse des preuves empeche techniquement le confinement' ),
				'correct'     => 0,
				'explanation' => 'La memoire vive, les connexions actives et les processus disparaissent a l\'extinction. Le bon reflexe est de capturer l\'essentiel avant d\'isoler, dans la mesure ou l\'urgence le permet.',
			),
			array(
				'question'    => 'Quel document doit exister AVANT le premier incident pour que la reponse soit efficace ?',
				'choices'     => array( 'Un rapport d\'analyse redige pendant la crise', 'Un plan de reponse avec roles, contacts et seuils d\'escalade', 'Un inventaire des preuves collectees lors du dernier incident', 'Une note de service rappelant l\'interdiction de payer' ),
				'correct'     => 1,
				'explanation' => 'La preparation est la premiere phase : sans roles attribues ni numeros a appeler, les premieres heures partent en coordination improvisee. Les autres documents utiles se construisent pendant et apres, pas avant.',
			),
		),

		'4.7' => array(
			array(
				'question'    => 'Quelle preuve est la plus fragile lors d\'une intervention sur une machine allumee ?',
				'choices'     => array( 'Les sauvegardes quotidiennes conservees hors du site principal', 'Les journaux archives et compresses sur un serveur distant', 'La memoire vive et les connexions actives', 'Le contenu du disque et les fichiers de configuration du serveur' ),
				'correct'     => 2,
				'explanation' => 'La memoire et les connexions disparaissent a l\'extinction : ce sont des preuves volatiles, a capturer en premier. Le disque et les archives survivent a l\'arret.',
			),
			array(
				'question'    => 'Pourquoi calcule-t-on une empreinte (hash) d\'une image disque en forensique ?',
				'choices'     => array( 'Pour accelerer l\'analyse en supprimant les fichiers inutiles', 'Pour dechiffrer le disque complet avant de commencer l\'analyse', 'Pour compresser l\'image et reduire l\'espace de stockage necessaire', 'Pour prouver que la copie est identique a l\'original' ),
				'correct'     => 3,
				'explanation' => 'L\'empreinte de la copie doit egaler celle de l\'original : c\'est la preuve de non-alteration. Sans elle, la valeur probante de l\'analyse est contestable.',
			),
			array(
				'question'    => 'Pourquoi faut-il documenter la collecte d\'une preuve (qui, quand, comment) ?',
				'choices'     => array( 'Pour que la preuve reste exploitable et contestable par un tiers', 'Pour eviter d\'avoir a calculer l\'empreinte du disque analyse', 'Pour accelerer le traitement technique de l\'incident en cours', 'Pour respecter une formalite administrative sans portee pratique' ),
				'correct'     => 0,
				'explanation' => 'La chaine de possession repond a une question simple : la preuve presentee est-elle celle qui a ete collectee ? Sans cette tracabilite, la preuve technique la plus solide devient discutable, en interne comme devant un tribunal.',
			),
		),

		'4.8' => array(
			array(
				'question'    => 'Quel est le principal risque de l\'automatisation d\'une reponse a incident ?',
				'choices'     => array( 'L\'automatisation est plus lente qu\'un analyste qui traite l\'alerte', 'Une regle mal ecrite bloque un service legitime a grande echelle', 'L\'automatisation coute cher a mettre en place et a maintenir', 'L\'automatisation empeche toute analyse ulterieure des incidents' ),
				'correct'     => 1,
				'explanation' => 'L\'automatisation amplifie : une erreur de regle isole 500 postes au lieu d\'un. D\'ou la necessite de tester en mode observation avant d\'activer le blocage.',
			),
			array(
				'question'    => 'Qu\'apporte l\'orchestration (SOAR) par rapport a des scripts separes ?',
				'choices'     => array( 'Elle supprime le besoin de conserver les journaux des systemes', 'Elle chiffre les incidents avant de les transmettre aux equipes', 'Elle enchaine les actions dans un scenario reproductible', 'Elle remplace completement les analystes du centre operationnel' ),
				'correct'     => 2,
				'explanation' => 'Le SOAR coordonne les outils, conserve la trace des actions et rend le traitement reproductible. Il ne remplace pas le jugement : il execute ce qu\'un humain a decide.',
			),
			array(
				'question'    => 'Quelle precaution prendre avant d\'activer le blocage automatique d\'une reponse a incident ?',
				'choices'     => array( 'La tester uniquement sur les serveurs de production principaux', 'La confier a un outil sans documenter les regles appliquees', 'La deployer directement, pour gagner du temps le jour de l\'incident', 'La faire tourner en mode observation pour mesurer les faux positifs' ),
				'correct'     => 3,
				'explanation' => 'Le mode observation montre ce que la regle declencherait sans rien bloquer. C\'est le seul moyen de decouvrir qu\'elle vise aussi des usages legitimes avant qu\'elle ne coupe la production.',
			),
		),

		/* ============================================================
		 * D5 — Gouvernance et gestion du programme (20 %)
		 * ============================================================ */

		'5.1' => array(
			array(
				'question'    => 'Quelle est la difference entre une politique et une procedure ?',
				'choices'     => array( 'La politique dit ce qui est exige, la procedure dit comment le faire', 'La politique est ecrite, la procedure est orale', 'Aucune : les deux mots sont synonymes', 'La politique est technique, la procedure est legale' ),
				'correct'     => 0,
				'explanation' => 'La politique fixe l\'exigence et la responsabilite ; la procedure decrit les etapes concretes. Une politique sans procedure reste une intention ; une procedure sans politique n\'a pas d\'autorite.',
			),
			array(
				'question'    => 'Qui doit approuver une politique de securite pour qu\'elle ait une valeur reelle ?',
				'choices'     => array( 'Le prestataire informatique en charge de l\'exploitation quotidienne', 'La direction, qui porte la responsabilite', 'L\'administrateur systeme qui connait le mieux les risques techniques', 'Les utilisateurs, par un vote organise lors de la reunion annuelle' ),
				'correct'     => 1,
				'explanation' => 'Une politique applicable engage l\'organisation : elle doit venir de la direction. Sinon, elle n\'a aucun moyen de contrainte et reste un document decoratif.',
			),
			array(
				'question'    => 'Quelle caracteristique rend une politique de securite applicable plutot que decorative ?',
				'choices'     => array( 'Elle est longue et couvre tous les sujets possibles en detail', 'Elle est redigee par un expert externe reconnu du domaine', 'Elle est approuvee, diffusee, et son non-respect a des consequences', 'Elle est publiee sur le site web de l\'entreprise pour transparence' ),
				'correct'     => 2,
				'explanation' => 'Une politique sans approbation, sans diffusion ni consequence n\'est qu\'un texte. L\'applicabilite tient a trois choses : qui l\'autorise, qui la connait, et ce qui se passe quand on ne la suit pas.',
			),
			array(
				'question'    => 'Quel role joue la direction dans un programme de securite au-dela de signer la politique ?',
				'choices'     => array( 'Elle remplace le responsable securite en cas d\'absence prolongee', 'Elle execute elle-meme les procedures techniques quotidiennes', 'Elle valide chaque correctif applicatif avant sa mise en production', 'Elle arbitre les ressources et porte la responsabilite du risque residuel' ),
				'correct'     => 3,
				'explanation' => 'La direction decide des moyens et assume le risque que l\'organisation conserve. Sans cet arbitrage, la securite reste une demande sans budget, arbitree par defaut au profit d\'autres priorites.',
			),
		),

		'5.2' => array(
			array(
				'question'    => 'Dans un registre des risques, a quoi sert la notion de risque residuel ?',
				'choices'     => array( 'Au risque qui reste apres application des mesures', 'Au risque des fournisseurs', 'Au risque financier uniquement', 'Au risque qui n\'a pas ete identifie' ),
				'correct'     => 0,
				'explanation' => 'On ne supprime pas tout le risque : apres les mesures, il en reste. C\'est ce residu que la direction accepte explicitement, ou refuse, ce qui declenche de nouvelles mesures.',
			),
			array(
				'question'    => 'Comment qualifie-t-on un risque de probabilite faible et d\'impact tres eleve sur des donnees critiques ?',
				'choices'     => array( 'Un risque a ignorer puisque improbable', 'Un risque prioritaire a traiter par reduction ou transfert', 'Un risque a accepter sans documenter', 'Un risque sans objet' ),
				'correct'     => 1,
				'explanation' => 'L\'impact eleve sur des donnees critiques commande le traitement, meme a faible probabilite : assurance (transfert), mesures de reduction, et acceptation formelle si l\'on decide de vivre avec.',
			),
			array(
				'question'    => 'Que signifie « accepter » un risque dans un registre ?',
				'choices'     => array( 'La preuve que le risque a ete entierement supprime', 'Une erreur de methode qu\'un audit doit systematiquement relever', 'Une decision documentee et attribuee de vivre avec ce risque', 'Le fait d\'ignorer le risque parce qu\'il n\'a pas ete identifie' ),
				'correct'     => 2,
				'explanation' => 'Accepter est une decision : quelqu\'un, a un niveau de responsabilite suffisant, assume le risque residuel et le documente. Ignorer n\'est pas accepter : c\'est un risque non maitrise.',
			),
			array(
				'question'    => 'Quelle methode permet de comparer deux risques de nature differente dans un meme registre ?',
				'choices'     => array( 'Retenir uniquement ceux qui ont deja provoque un incident', 'Confier le classement au fournisseur de la solution technique', 'Classer les risques par ordre alphabetique de leur intitule', 'Estimer probabilite et impact sur une echelle commune' ),
				'correct'     => 3,
				'explanation' => 'Probabilite x impact sur une echelle partagee rend les risques comparables et permet de trancher. Sans echelle commune, la priorisation se fait par celui qui parle le plus fort en reunion.',
			),
		),

		'5.3' => array(
			array(
				'question'    => 'Un prestataire critique tombe en panne et bloque toute la production. Quel type de risque est-ce ?',
				'choices'     => array( 'Un risque lie aux tiers et a la chaine d\'approvisionnement', 'Un risque interne de gouvernance mal maitrise par la direction', 'Un risque physique lie a la protection des locaux et des acces', 'Un risque de conformite lie au non-respect d\'une obligation legale' ),
				'correct'     => 0,
				'explanation' => 'La dependance a un fournisseur est un risque de tiers. Il se traite par l\'evaluation du fournisseur, des clauses contractuelles, et une solution de repli (redundance, plan de continuite).',
			),
			array(
				'question'    => 'Pourquoi exiger d\'un fournisseur une attestation de securite (par exemple ISO 27001) ne suffit-il pas ?',
				'choices'     => array( 'Parce que ces attestations sont delivrees sans aucun controle prealable', 'Une certification atteste d\'un processus, pas du service utilise', 'Parce qu\'elles ne portent que sur le materiel et jamais sur les processus', 'Parce qu\'elles coutent trop cher pour les petites entreprises' ),
				'correct'     => 1,
				'explanation' => 'La certification prouve qu\'un processus existe, pas que le service precis est bien configure. Il faut completer par des questions precises : chiffrement, journalisation, delai de notification d\'incident, sous-traitants.',
			),
			array(
				'question'    => 'Quelle clause contractuelle protege le mieux une entreprise lors d\'un incident chez son fournisseur ?',
				'choices'     => array( 'Une remise commerciale en cas d\'indisponibilite du service', 'Une clause de confidentialite generale signee a la commande', 'Un delai maximal de notification d\'incident et un droit d\'audit', 'Une declaration du fournisseur qu\'il respecte les bonnes pratiques' ),
				'correct'     => 2,
				'explanation' => 'En incident, ce qui compte c\'est de savoir vite, et de pouvoir verifier. Un delai de notification engageant et un droit d\'audit donnent prise a l\'entreprise ; une declaration de bonnes intentions ne se verifie pas.',
			),
		),

		'5.4' => array(
			array(
				'question'    => 'Quelle est la difference entre un audit interne et un audit externe ?',
				'choices'     => array( 'Aucune difference, seule la duree de la mission change', 'L\'interne est toujours plus cher et plus long que l\'externe', 'L\'externe ne regarde que les finances et jamais la securite', 'L\'interne est realise par l\'organisation, l\'externe par un tiers independant' ),
				'correct'     => 3,
				'explanation' => 'L\'audit interne sert a progresser et se fait avec les equipes ; l\'externe apporte un regard independant, souvent exige pour une certification ou un contrat. Les deux ne repondent pas a la meme question.',
			),
			array(
				'question'    => 'Une entreprise veut traiter des donnees de sante de patients europeens. Quel cadre lui impose des obligations de securite particulieres ?',
				'choices'     => array( 'Le RGPD, complete par les regles nationales de sante', 'Le referentiel ISO 9001, qui definit les exigences de qualite', 'La norme PCI DSS, qui encadre la protection des moyens de paiement', 'Aucun : la sante n\'est pas un domaine reglemente en Europe' ),
				'correct'     => 0,
				'explanation' => 'Les donnees de sante sont une categorie particuliere au sens du RGPD : minimisation, securite renforcee, information des personnes, et obligations nationales specifiques. PCI DSS concerne les moyens de paiement.',
			),
			array(
				'question'    => 'Un audit releve qu\'une procedure existe mais n\'est jamais appliquee. Comment le qualifier ?',
				'choices'     => array( 'Un faux positif de l\'auditeur, a classer sans suite', 'Un ecart entre la procedure documentee et la pratique reelle', 'Une conformite acceptable puisque le document existe', 'Une preuve que la procedure doit etre supprimee du referentiel' ),
				'correct'     => 1,
				'explanation' => 'C\'est precisement ce que cherche un audit : l\'ecart entre ce qui est ecrit et ce qui est fait. Une procedure non appliquee est un risque reel, et souvent le signe qu\'elle est inapplicable en l\'etat.',
			),
		),

		'5.5' => array(
			array(
				'question'    => 'Quel format de formation reduit le mieux le taux de clic sur un message d\'hameconnage, a budget egal ?',
				'choices'     => array( 'Une affiche dans la salle de pause', 'Une note de service annuelle', 'Des simulations courtes et regulieres, suivies d\'un retour immediat', 'Une formation de deux jours une seule fois' ),
				'correct'     => 2,
				'explanation' => 'La repetition courte avec retour immediat ancre le reflexe ; une session unique est oubliee en quelques semaines. Les simulations doivent etre pedagogiques, pas punitives, sinon les equipes cachent leurs erreurs.',
			),
			array(
				'question'    => 'Un utilisateur signale un message suspect. Quel indicateur de programme cela alimente-t-il ?',
				'choices'     => array( 'Le nombre d\'incidents evites par le pare-feu', 'La duree du mot de passe', 'Le taux de clic', 'Le taux de signalement, qui mesure la vigilance active' ),
				'correct'     => 3,
				'explanation' => 'Le taux de clic mesure les erreurs ; le taux de signalement mesure la vigilance. Un programme sain fait monter le second : les utilisateurs deviennent des capteurs.',
			),
			array(
				'question'    => 'Pourquoi une simulation d\'hameconnage doit-elle etre suivie d\'un retour pedagogique immediat ?',
				'choices'     => array( 'Parce que l\'apprentissage se fait au moment de l\'erreur, pas au rapport annuel', 'Parce que les utilisateurs oublient leur mot de passe sinon', 'Parce que la loi impose de justifier chaque simulation realisee', 'Parce que cela reduit le nombre de simulations a organiser' ),
				'correct'     => 0,
				'explanation' => 'Un message qui dit « vous avez clique, voici les trois indices qui manquaient » transforme l\'erreur en reflexe. Le meme message envoye trois mois plus tard n\'a plus rien a voir avec l\'instant de la decision.',
			),
			array(
				'question'    => 'Quel indicateur montre qu\'un programme de sensibilisation progresse reellement ?',
				'choices'     => array( 'Le nombre de sanctions prononcees apres une simulation augmente', 'Le taux de signalement des messages suspects augmente', 'Le nombre de messages d\'hameconnage envoyes augmente', 'Le nombre de formations achevees par les employes augmente' ),
				'correct'     => 1,
				'explanation' => 'Un taux de signalement qui monte signifie que les equipes regardent avant de cliquer : c\'est un comportement, pas une presence. Le nombre de formations suivies ne dit rien de ce qui se passe dans la boite mail.',
			),
		),
	);
}
