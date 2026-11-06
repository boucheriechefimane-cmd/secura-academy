<?php
/**
 * D1 — Les trois rooms qui comblent les trous du domaine general.
 *
 * POURQUOI CES ROOMS EXISTENT
 * ---------------------------
 * Mesure du 7 novembre 2026 : quatre sujets du domaine D1 n'etaient
 * couverts par aucune room — ni les controles de securite (1.1), ni le
 * zero trust (1.3), ni la gestion du changement (1.4), ni la securite
 * physique (1.7). La banque de questions les nommait, les rooms les
 * ignoraient : un eleve pouvait reussir l'examen sans avoir jamais vu
 * la notion.
 *
 * Trois rooms plutot que quatre : 1.4 et 1.7 se racontent ensemble.
 * Un changement de configuration non documente qui ouvre une porte
 * physique, c'est une seule histoire, et c'est celle qui arrive.
 *
 * Chaque room suit le gabarit en quatre temps (docs/GABARIT-ROOMS.md) :
 * lecon, entrainement, mise en situation dans un terminal simule, puis
 * examen sans indice. Le terminal est simule : ces rooms fonctionnent
 * sans conteneur.
 *
 * Sources : NIST SP 800-207 (zero trust), SP 800-53 Rev. 5 (familles AC
 * et PE), SP 800-128 (gestion de configuration). Domaine public.
 * Contenu original.
 *
 * @package Secura_Academy
 */

defined( 'ABSPATH' ) || exit;

/**
 * Les rooms du bloc.
 *
 * @return array[]
 */
function seca_default_rooms_d1() {
	return array(
		array(
			'title'       => 'Le portique qui n\'a arrete personne',
			'excerpt'     => 'Un portique de detection est installe a l\'entree. Un badge est pose sur chaque porte. Et l\'incident a quand meme eu lieu. A toi de dire ce que chaque controle est cense faire — et ce qu\'aucun d\'eux ne faisait.',
			'content'     => 'Un controle de securite ne vaut pas par son prix, mais par ce qu\'il empeche, constate ou repare. Cette room t\'apprend a classer un controle avant de l\'acheter, et a reperer le controle qui manque dans une chaine pourtant complete.',
			'difficulty'  => 'facile',
			'duration'   => 30,
			'xp_bonus'   => 55,
			'track'      => 'concepts',
			'source'     => array(
				'nom'        => 'NIST SP 800-53 Rev. 5 — Security and Privacy Controls (familles AC et PE)',
				'url'        => 'https://csrc.nist.gov/pubs/sp/800/53/r5/upd1/final',
				'licence'    => 'Domaine public (publication du NIST, Etats-Unis)',
				'attribution'=> 'NIST Special Publication 800-53 Revision 5, Security and Privacy Controls for Information Systems and Organizations',
			),
			'tasks'      => array(
				array(
					'type'       => 'lesson',
					'format'     => 'lecon',
					'title'  => 'Task 1 : Quatre categories, et une seule question a poser',
					'content'=> '<p>Un <strong>controle de securite</strong> est un dispositif qui modifie la probabilite ou l\'impact d\'un evenement. Le referentiel NIST SP 800-53 les range par <em>famille</em> (acces, audit, physique...), mais la classification qui sert au quotidien est celle du <em>moment</em> ou le controle agit. Quatre categories, et une question pour chacune :</p><ul><li><strong>preventif</strong> — il empeche l\'evenement. Question : <em>qu\'est-ce qui devient impossible ?</em> Un pare-feu, un badge, un mot de passe, une cloison.</li><li><strong>detectif</strong> — il constate l\'evenement, sans l\'empecher. Question : <em>comment le saurais-je ?</em> Une camera, un IDS, un journal, un portique de detection.</li><li><strong>correctif</strong> — il limite l\'impact une fois l\'evenement produit. Question : <em>comment je repare, et en combien de temps ?</em> Une sauvegarde restaurable, un correctif, un plan de reprise.</li><li><strong>dissuasif</strong> — il agit sur la decision de l\'attaquant. Question : <em>que voit-il, et que craint-il ?</em> Une camera visible, un panneau, un gardien.</li></ul><p>Deux controles peuvent se superposer sans se remplacer. Un portique de detection est <strong>dissuasif</strong> (il se voit) et <strong>detectif</strong> (il alerte). Il n\'est <strong>pas preventif</strong> : il ne bloque personne. C\'est exactement l\'erreur de la salle serveur racontee dans cette room.</p><p>Deux notions voisines, souvent confondues avec les quatre categories. Chacune repond a une question differente, et confondre la <em>categorie de controle</em> avec la nature du controle est l\'erreur la plus courante d\'un audit :</p><ul><li><strong>compensatoire</strong> — il remplace un controle impossible a mettre en place. Si la salle serveur ne peut pas avoir de cloison coupe-feu, on ajoute une detection incendie renforcee. Ce n\'est pas la meme chose que <em>correctif</em> : le compensatoire remplace un preventif absent ;</li><li><strong>technique, administratif ou physique</strong> — c\'est la <em>nature</em> du controle, pas son moment. Un badge est physique et preventif ; une politique de badge est administrative et preventive. Les deux sont necessaires, aucun ne suffit.</li></ul><p><strong>La question qui trie tout :</strong> « que se passe-t-il si ce controle tombe en panne ? » Un preventif qui tombe laisse passer ; un detectif qui tombe laisse passer <em>sans qu\'on le sache</em>. C\'est pour cela qu\'un dispositif detectif doit etre surveille lui-meme.</p><p><strong>A retenir :</strong> classer un controle, c\'est repondre a « a quel moment agit-il », pas a « combien coute-t-il ». Un controle qu\'on ne sait pas classer est un controle qu\'on ne saura pas verifier.</p>',
					'questions' => array(),
				),
				array(
					'type'       => 'practice',
					'format'     => 'qcm',
					'title'  => 'Task 2 : Entrainement — trois controles a classer',
					'content'=> '<p>Trois dispositifs reels. A chaque fois : quelle est leur categorie, et que font-ils vraiment ?</p>',
					'questions' => array(
						array(
							'question'    => 'Un portique de detection magnetique est installe a l\'entree du batiment. Un visiteur passe avec un objet metallique : le portique sonne, et un agent intervient. Comment le classer ?',
							'mode'        => 'choice',
							'topic'       => '1.1',
							'choices'     => array( 'Dissuasif et detectif : il se voit, et il signale — mais il ne bloque pas', 'Preventif : il empeche physiquement le passage de l\'objet metallique', 'Correctif : il repare l\'incident apres que l\'objet est entre dans le batiment', 'Compensatoire : il remplace l\'absence d\'agent de securite a l\'entree du site' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Le portique empeche-t-il le passage, ou le signale-t-il ?',
							'explanation' => 'Le portique ne ferme aucune porte : il sonne. Il est detectif par ce qu\'il fait, et dissuasif par ce qu\'il montre. Un controle preventif a cet endroit serait un tourniquet, une porte verrouillee ou un agent qui refuse le passage.',
						),
						array(
							'question'    => 'Une entreprise sauvegarde ses donnees chaque nuit, et verifie une restauration par trimestre. De quelle categorie releve cette verification ?',
							'mode'        => 'choice',
							'topic'       => '1.1',
							'choices'     => array( 'Correctif : la sauvegarde restaure, et la verification prouve qu\'elle restaure', 'Preventif : la sauvegarde empeche la perte definitive des donnees, des qu\'elle est planifiee et verifiee', 'Detectif seulement : la verification constate que la sauvegarde existe, mais ne restaure rien du tout', 'Dissuasif : la sauvegarde decourage l\'attaquant de chiffrer les fichiers, par sa simple existence annoncee' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Une sauvegarde jamais restauree est-elle un controle, ou une intention ?',
							'explanation' => 'La sauvegarde seule est une intention. C\'est la restauration verifiee qui en fait un controle correctif : on sait, preuve en main, qu\'on peut revenir en arriere. Sans ce test, on decouvre que la sauvegarde est illisible le jour de l\'incident.',
						),
						array(
							'question'    => 'Une salle serveur ne peut pas recevoir de cloison coupe-feu (batiment classe, murs porteurs). La direction installe a la place une detection incendie renforcee et un extincteur a gaz. Comment nommer ce dispositif ?',
							'mode'        => 'choice',
							'topic'       => '1.1',
							'choices'     => array( 'Compensatoire : il remplace un controle preventif impossible a installer', 'Preventif : il empeche le feu de se declencher dans la salle serveur, en coupant l\'alimentation', 'Dissuasif : il decourage un incendie volontaire dans la salle, par sa seule presence visible serveur', 'Inefficace : sans cloison, aucun autre controle ne sert a rien et l\'argent depense est perdu' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Le controle ne fait pas la meme chose que la cloison : il compense son absence.',
							'explanation' => 'Une cloison empeche la propagation ; une detection renforcee et une extinction fixe limitent l\'impact. On ne remplace pas un controle par son equivalent, on compense un manque assume. Le mot compte : il dit que le risque residuel est plus eleve, et qu\'il a ete accepte.',
						),
					),
				),
				array(
					'type'       => 'test',
					'format'     => 'pratique',
					'title'  => 'Task 3 : La mission — trouver le controle qui manque',
					'content'=> '<p><strong>Mission.</strong> L\'atelier de l\'entreprise a ete cambriole un dimanche. Quatre serveurs ont disparu, et personne ne l\'a su avant le lundi matin. Le rapport de securite de la salle serveur est sur la machine de l\'atelier.</p><p>Lis-le, et trouve <strong>le nombre de controles preventifs</strong> qui protegeaient reellement la salle, tel qu\'il est ecrit dans le rapport (un nombre, en chiffres).</p>',
					'questions' => array(
						array(
							'question'    => 'Combien de controles PREVENTIFS protegeaient reellement la salle serveur, d\'apres le rapport ?',
							'mode'        => 'text',
							'topic'       => '1.1',
							'answers'     => array( '/\\b3\\b/' ),
							'xp'          => 40,
							'hint'        => 'Dans le terminal : <code>cat /srv/atelier/rapport-securite.md</code>. Compte les lignes marquees PREVENTIF, et ignore celles marquees DETECTIF ou DISSUASIF.',
							'explanation' => 'Trois controles preventifs : la porte a badge, le sas a fermeture automatique, et le grillage des fenetres. Le rapport liste aussi une camera et un panneau — tous deux detectifs ou dissuasifs. C\'est le coeur du sujet : la salle avait l\'air protegee, et rien n\'empechait un cambriolage le dimanche, quand le badge n\'etait lu par personne et que la camera enregistrait sans alerter.',
						),
					),
					'terminal' => array(
						'intro'   => 'audit@atelier:~$ ',
						'unknown' => 'Cette commande ne donne rien ici. Le rapport est dans /srv/atelier.',
						'success' => 'Rapport lu. Tu peux compter les controles preventifs.',
						'steps'   => array(
							array(
								'match'  => array( 'ls /srv/atelier', '/^ls .*atelier/', '/^ls$/' ),
								'output' => 'rapport-securite.md
registre-visites.csv',
							),
							array(
								'match'  => array( 'cat .*rapport-securite\\.md', '^cat /srv/atelier/rapport-securite\\.md$' ),
								'output' => 'RAPPORT DE SECURITE — SALLE SERVEUR BATIMENT B
Date : 12/09
Redige par : service general

CONTROLES EN PLACE
-----------------------------------------
1. Porte a badge sur le sas d entree ............ PREVENTIF
2. SAS a fermeture automatique (une personne) ... PREVENTIF
3. Grillage fixe sur les deux fenetres .......... PREVENTIF
4. Camera fixe au plafond, enregistrement 30 j .. DETECTIF
5. Panneau « local technique, acces interdit » .. DISSUASIF
6. Extincteur a gaz, verifie en mars ............ CORRECTIF

OBSERVATIONS
-----------------------------------------
- Les badges sont attribues a 14 personnes.
- Aucun releve de badge n est imprime depuis janvier.
- La camera enregistre, mais personne ne regarde les images.
- Le sas reste ouvert en position jour le week-end.

CONCLUSION DU SERVICE
La salle est protegee : trois controles preventifs, une camera,
et un panneau d avertissement.',
							),
							array(
								'match'  => array( 'cat .*registre-visites\\.csv', '^cat /srv/atelier/registre-visites\\.csv$' ),
								'output' => 'date,entree,sortie,visiteur,motif
08/09,09:12,09:40,S. Ba,maintenance climatisation
09/09,14:02,14:20,A. Diallo,depot de materiel
10/09,10:15,10:55,S. Ba,maintenance climatisation
(rien le samedi 11 ni le dimanche 12)',
							),
							array(
								'match'  => array( 'cat .*', 'less .*', 'more .*' ),
								'output' => 'Aucun fichier de ce nom dans /srv/atelier.',
							),
						),
					),
				),
				array(
					'type'       => 'exam',
					'format'     => 'qcm',
					'title'  => 'Task 4 : Examen de fin de room',
					'content'=> '<p>Quatre questions, 8 minutes, seuil 80 %. Aucun indice.</p>',
					'time_limit' => 8,
					'pass_score' => 80,
					'questions' => array(
						array(
							'question'    => 'Un controle detectif tombe en panne. Quelle est la consequence, comparee a un controle preventif qui tombe en panne ?',
							'mode'        => 'choice',
							'topic'       => '1.1',
							'choices'     => array( 'Le preventif laisse passer l\'evenement ; le detectif laisse passer sans qu\'on le sache', 'Aucune difference : dans les deux cas l\'evenement se produit, et personne ne s\'en apercoit jamais', 'Le detectif bloque quand meme l\'evenement a lui seul, tandis que le preventif ne bloque plus rien du tout', 'Le preventif est plus grave, parce qu\'un controle preventif coute beaucoup plus cher a remplacer' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Un preventif en panne se voit a l\'usage : la porte s\'ouvre, le pare-feu laisse passer. Un detectif en panne ne se voit pas : plus aucune alerte, et l\'illusion que tout va bien. C\'est pourquoi un dispositif detectif doit etre surveille lui-meme — une camera que personne ne regarde n\'est pas un controle.',
						),
						array(
							'question'    => 'Une entreprise installe un panneau « zone video-surveillee » a l\'entree, sans installer de camera. Que peut-on dire de ce controle ?',
							'mode'        => 'choice',
							'topic'       => '1.1',
							'choices'     => array( 'Il est dissuasif seulement : il agit sur la decision, et ne constate rien', 'Il est detectif : le panneau signale une intrusion a l\'agent de securite', 'Il est preventif : le panneau empeche physiquement l\'entree non autorisee', 'Il est correctif : le panneau permet de retrouver l\'auteur apres les faits' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Le panneau joue sur la crainte d\'etre vu. Il ne constate rien, puisqu\'il n\'y a pas de camera — et c\'est un probleme ethique autant que technique : annoncer une surveillance inexistante n\'est pas un controle, c\'est une affirmation fausse.',
						),
						array(
							'question'    => 'Quelle suite de controles decrit correctement la chaine de protection d\'une sauvegarde ?',
							'mode'        => 'choice',
							'topic'       => '1.1',
							'choices'     => array( 'Preventif (acces restreint au stockage), detectif (alerte sur echec), correctif (restauration testee)', 'Detectif (acces restreint au stockage), correctif (alerte sur echec), preventif (restauration testee).', 'Correctif (acces restreint au stockage), preventif (alerte sur echec), detectif (restauration testee).', 'Un seul controle suffit : une sauvegarde chiffree couvre les trois moments a la fois, sans autre mesure a la fois' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Restreindre l\'acces empeche (preventif). Alerter sur un echec de sauvegarde constate (detectif). Restaurer verifie repare (correctif). Une sauvegarde chiffree ne couvre qu\'un seul de ces trois moments : la confidentialite du support. Elle ne dit rien de la restaurabilite.',
						),
						array(
							'question'    => 'Pourquoi un controle compensatoire doit-il etre documente comme tel, avec le risque residuel accepte ?',
							'mode'        => 'choice',
							'topic'       => '1.1',
							'choices'     => array( 'Parce qu\'il ne remplace pas le controle absent : le risque residuel est plus eleve, et doit etre accepte nommement', 'Parce qu\'un controle compensatoire coute toujours plus cher que le controle qu\'il remplace, a terme, en maintenance', 'Parce que la loi interdit d\'installer un controle compensatoire sans une autorisation prealable ecrite et signee', 'Parce qu\'un controle compensatoire devient automatiquement preventif au bout d\'un an d\'usage regulier' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Le mot « compensatoire » est un aveu : on sait ce qui manque. Si l\'aveu n\'est pas ecrit, avec le nom de celui qui accepte le risque, l\'organisation croit etre protegee alors qu\'elle a choisi de ne pas l\'etre. C\'est exactement ce que le rapport de la salle serveur cachait.',
						),
					),
				),
			),
			'i18n'       => array(
				'en' => array(
					'title'   => 'The turnstile that stopped nobody',
					'excerpt' => 'A metal detector stands at the entrance. Every door has a badge reader. And the incident happened anyway. Your job is to say what each control is supposed to do — and what none of them was doing.',
					'tasks'   => array(
						array(
							'title'  => 'Task 1: Four categories, and one question to ask',
							'content'=> '<p>A <strong>security control</strong> is a device, a rule or a procedure that changes the probability or the impact of an event. The NIST SP 800-53 framework sorts controls by <em>family</em> (access, audit, physical...), but the classification that matters day to day is the one based on <em>when</em> the control acts. Four categories, and one question for each:</p><ul><li><strong>preventive</strong> — it stops the event. Question: <em>what becomes impossible?</em> A firewall, a badge, a password, a wall.</li><li><strong>detective</strong> — it notices the event without stopping it. Question: <em>how would I know?</em> A camera, an IDS, a log, a metal detector.</li><li><strong>corrective</strong> — it limits the impact once the event has happened. Question: <em>how do I recover, and in how long?</em> A restorable backup, a patch, a recovery plan.</li><li><strong>deterrent</strong> — it acts on the attacker\'s decision. Question: <em>what do they see, and what do they fear?</em> A visible camera, a sign, a guard.</li></ul><p>Two controls can overlap without replacing each other. A metal detector is <strong>deterrent</strong> (it is visible) and <strong>detective</strong> (it alerts). It is <strong>not preventive</strong>: it does not stop anyone. That is exactly the mistake in the server room described in this room.</p><p>Two neighbouring notions, often confused with the four categories. Each answers a different question, and confusing the <em>category of control</em> with the nature of the control is the most common mistake in an audit:</p><ul><li><strong>compensating</strong> — it replaces a control that cannot be implemented. If the server room cannot have a fire wall, reinforced fire detection is added. This is not the same as <em>corrective</em>: the compensating control replaces an absent preventive one;</li><li><strong>technical, administrative or physical</strong> — this is the <em>nature</em> of the control, not its timing. A badge reader is physical and preventive; a badge policy is administrative and preventive. Both are necessary, neither is enough.</li></ul><p><strong>The question that sorts everything:</strong> "what happens if this control fails?" A preventive control that fails lets the event through; a detective control that fails lets it through <em>without anyone knowing</em>. That is why a detective device must itself be monitored.</p><p><strong>Remember:</strong> classifying a control means answering "when does it act", not "how much does it cost". A control you cannot classify is a control you will not be able to verify.</p>',
							'questions' => array(),
						),
						array(
							'title'  => 'Task 2: Practice — three controls to classify',
							'content'=> '<p>Three real devices. For each one: what is its category, and what does it actually do?</p>',
							'questions' => array(
								array(
									'question'    => 'A magnetic metal detector is installed at the building entrance. A visitor walks through with a metal object: the detector sounds, and an officer intervenes. How do you classify it?',
									'choices'     => array( 'Deterrent and detective: it is visible, and it signals — but it does not block', 'Preventive: it physically stops the metal object from passing through', 'Corrective: it repairs the incident after the object has entered the building', 'Compensating: it replaces the absence of a security officer at the site entrance' ),
									'correct'     => 0,
									'hint'        => 'Does the detector stop the passage, or does it signal it?',
									'explanation' => 'The detector closes no door: it sounds. It is detective in what it does, and deterrent in what it shows. A preventive control at that spot would be a turnstile, a locked door, or an officer who refuses entry.',
								),
								array(
									'question'    => 'A company backs up its data every night, and verifies one restore per quarter. Which category does this verification belong to?',
									'choices'     => array( 'Corrective: the backup restores, and the verification proves it restores', 'Preventive: the backup prevents the definitive loss of the data', 'Detective only: the verification observes that the backup exists, but restores nothing', 'Deterrent: the backup discourages the attacker from encrypting the files' ),
									'correct'     => 0,
									'hint'        => 'Is a backup that was never restored a control, or an intention?',
									'explanation' => 'The backup alone is an intention. It is the verified restore that makes it a corrective control: you know, proof in hand, that you can go back. Without that test, you discover the backup is unreadable on the day of the incident.',
								),
								array(
									'question'    => 'A server room cannot receive a fire wall (listed building, load-bearing walls). Management installs reinforced fire detection and a gas extinguisher instead. How do you name this arrangement?',
									'choices'     => array( 'Compensating: it replaces a preventive control that cannot be installed', 'Preventive: it stops the fire from starting in the server room at all, by cutting the power', 'Deterrent: it discourages a deliberate fire in the server room, by its visible presence', 'Ineffective: without the wall, no other control is of any use and the money is wasted' ),
									'correct'     => 0,
									'hint'        => 'The control does not do the same thing as the wall: it compensates for its absence.',
									'explanation' => 'A wall stops the spread; reinforced detection and fixed extinguishing limit the impact. You do not replace a control with its equivalent: you compensate for an accepted gap. The word matters: it says the residual risk is higher, and that it was accepted.',
								),
							),
						),
						array(
							'title'  => 'Task 3: The mission — find the missing control',
							'content'=> '<p><strong>Mission.</strong> The company workshop was burgled on a Sunday. Four servers disappeared, and nobody knew before Monday morning. The security report for the server room is on the workshop machine.</p><p>Read it, and find <strong>the number of preventive controls</strong> that actually protected the room, as it is written in the report (a number, in digits).</p>',
							'questions' => array(
								array(
									'question'    => 'How many PREVENTIVE controls actually protected the server room, according to the report?',
									'answers'     => array( '/\\b3\\b/' ),
									'hint'        => 'In the terminal: <code>cat /srv/atelier/rapport-securite.md</code>. Count the lines marked PREVENTIF, and ignore those marked DETECTIF or DISSUASIF.',
									'explanation' => 'Three preventive controls: the badge door, the one-person airlock, and the window grilles. The report also lists a camera and a sign — both detective or deterrent. That is the heart of the subject: the room looked protected, and nothing prevented a Sunday burglary, when nobody read a badge and the camera recorded without alerting anyone.',
								),
							),
						),
						array(
							'title'  => 'Task 4: End-of-room exam',
							'content'=> '<p>Four questions, 8 minutes, pass mark 80%. No hints.</p>',
							'questions' => array(
								array(
									'question'    => 'A detective control fails. What is the consequence, compared with a preventive control that fails?',
									'choices'     => array( 'The preventive one lets the event through; the detective one lets it through without anyone knowing', 'No difference: in both cases the event happens and nobody knows about it', 'The detective one still blocks the event by itself, while the preventive one no longer blocks anything', 'The preventive one is more serious, because a preventive control costs more to replace' ),
									'correct'     => 0,
									'explanation' => 'A failed preventive control shows in use: the door opens, the firewall lets traffic through. A failed detective control does not show: no more alerts, and the illusion that everything is fine. That is why a detective device must itself be monitored — a camera nobody watches is not a control.',
								),
								array(
									'question'    => 'A company installs a "CCTV in operation" sign at the entrance, without installing any camera. What can be said about this control?',
									'choices'     => array( 'It is deterrent only: it acts on the decision, and observes nothing', 'It is detective: the sign signals an intrusion to the security officer', 'It is preventive: the sign physically stops unauthorised entry', 'It is corrective: the sign helps identify the culprit after the fact' ),
									'correct'     => 0,
									'explanation' => 'The sign plays on the fear of being seen. It observes nothing, since there is no camera — and that is an ethical problem as much as a technical one: announcing surveillance that does not exist is not a control, it is a false statement.',
								),
								array(
									'question'    => 'Which sequence of controls correctly describes the protection chain of a backup?',
									'choices'     => array( 'Preventive (restricted access to storage), detective (alert on failure), corrective (verified restore)', 'Detective (restricted access to storage), corrective (alert on failure), preventive (verified restore of data)', 'Corrective (restricted access to storage), preventive (alert on failure), detective (verified restore of data)', 'One control is enough: an encrypted backup covers all three moments at once, with no other measure' ),
									'correct'     => 0,
									'explanation' => 'Restricting access prevents (preventive). Alerting on a failed backup notices (detective). A verified restore repairs (corrective). An encrypted backup covers only one of those three moments: the confidentiality of the medium. It says nothing about whether the backup can be restored.',
								),
								array(
									'question'    => 'Why must a compensating control be documented as such, with the residual risk accepted?',
									'choices'     => array( 'Because it does not replace the missing control: the residual risk is higher, and must be accepted by name', 'Because a compensating control always costs more than the control it replaces, over time, in maintenance and staff', 'Because the law forbids installing a compensating control without a prior written authorisation, signed by the owner', 'Because a compensating control automatically becomes preventive after one year of regular use, according to the law' ),
									'correct'     => 0,
									'explanation' => 'The word "compensating" is a confession: you know what is missing. If the confession is not written down, with the name of the person who accepts the risk, the organisation believes it is protected when it has chosen not to be. That is exactly what the server room report was hiding.',
								),
							),
						),
					),
				),
			),
		),
		array(
			'title'       => 'Le reseau interne etait sur',
			'excerpt'     => '« On est dans le reseau interne, donc on est en confiance. » C\'est la phrase qui a coute le plus cher a cette entreprise. Suis l\'attaque qui l\'a rendue fausse, et decide ou placer le controle.',
			'content'     => 'Le zero trust ne dit pas « ne faites confiance a personne » : il dit « ne faites confiance a rien sans l\'avoir verifie ». Cette room t\'apprend a placer un point de decision, et a reperer la confiance implicite qui reste dans une architecture.',
			'difficulty'  => 'moyen',
			'duration'   => 35,
			'xp_bonus'   => 65,
			'track'      => 'concepts',
			'source'     => array(
				'nom'        => 'NIST SP 800-207 — Zero Trust Architecture',
				'url'        => 'https://csrc.nist.gov/pubs/sp/800/207/final',
				'licence'    => 'Domaine public (publication du NIST, Etats-Unis)',
				'attribution'=> 'NIST Special Publication 800-207, Zero Trust Architecture (aout 2020)',
			),
			'tasks'      => array(
				array(
					'type'       => 'lesson',
					'format'     => 'lecon',
					'title'  => 'Task 1 : Le chateau fort, et ce qui l\'a remplace',
					'content'=> '<p>Le modele classique s\'appelle le <strong>perimetre</strong> : un reseau interieur, repute sur, protege par un rempart (le pare-feu). Une fois dedans, on circule librement. Ce modele suppose que l\'interieur est habite par des gens de confiance, et que l\'attaquant est dehors.</p><p>Trois faits ont rendu cette hypothese fausse, et aucun n\'est une mode :</p><ul><li><strong>le travail a distance</strong> — les utilisateurs sont dehors une partie du temps, et leurs postes aussi ;</li><li><strong>le cloud</strong> — les applications ne sont plus dans le batiment, et le « reseau interne » ne mene plus a elles ;</li><li><strong>la compromission par l\'interieur</strong> — hameconnage, poste infecte, prestataire, compte vole. L\'attaquant obtient souvent un point d\'appui <em>interne</em> avant d\'attaquer, et le perimetre ne l\'arrete plus.</li></ul><p>Le <strong>zero trust</strong> — que le referentiel nomme aussi <em>confiance zero</em> — (NIST SP 800-207) en tire une regle simple : <em>aucune confiance implicite, quelle que soit la position reseau</em>. Chaque acces est evalue a chaque fois, sur des faits : qui demande, depuis quel appareil, quel est son etat, vers quelle ressource, pour quelle action.</p><p>Deux composants, et il faut les distinguer :</p><ul><li>le <strong>point de decision</strong> (PDP) : il recoit la demande, applique la politique, et rend un verdict — autoriser, refuser, ou autoriser partiellement ;</li><li>le <strong>point d\'application</strong> (PEP) : il fait respecter le verdict. C\'est la porte, pas le juge.</li></ul><p>Quatre malentendus, tous frequents :</p><ul><li>« zero trust veut dire zero acces » — non. Il veut dire <em>verification avant acces</em>. Un utilisateur legitime travaille normalement ;</li><li>« zero trust, c\'est un produit » — non. C\'est une architecture : une politique, des sources de contexte, et un point d\'application. Un produit peut la servir, aucun ne la remplace ;</li><li>« le reseau interne est de confiance, seul l\'exterieur est verifie » — c\'est precisement l\'erreur que le modele corrige ;</li><li>« zero trust supprime la segmentation » — non, il la rend plus fine : le micro-segment remplace le grand VLAN interne.</li></ul><p>Le principe qui resume tout, et qui vient du moindre privilege : <strong>un acces accorde pour une action ne vaut pas pour les autres</strong>. Lire un dossier ne donne pas le droit de l\'ecrire, et se connecter le matin ne donne pas le droit de se connecter a minuit depuis un autre pays.</p><p><strong>A retenir :</strong> la question du zero trust n\'est pas « suis-je dedans ou dehors », mais « sur quels faits je viens de decider, et ou est la porte qui applique ma decision ».</p>',
					'questions' => array(),
				),
				array(
					'type'       => 'practice',
					'format'     => 'qcm',
					'title'  => 'Task 2 : Entrainement — trois confiances implicites',
					'content'=> '<p>Trois situations. A chaque fois : ou se trouve la confiance implicite, et que faudrait-il verifier ?</p>',
					'questions' => array(
						array(
							'question'    => 'Une application interne accepte toute requete venant d\'une adresse IP du reseau 10.0.0.0/8, sans autre controle. Quel est le defaut zero trust ?',
							'mode'        => 'choice',
							'topic'       => '1.3',
							'choices'     => array( 'La confiance vient de la position reseau, et non de l\'identite ni de l\'etat de l\'appareil', 'Aucun : une adresse IP interne est une preuve d\'identite suffisante en pratique, dans un reseau maitrise', 'Le defaut est la taille du reseau : un /8 est trop grand pour etre segmente un jour correctement', 'Le defaut est l\'absence de chiffrement, la position reseau n\'ayant aucun rapport avec la question' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Un attaquant qui obtient un poste interne obtient aussi une adresse interne.',
							'explanation' => 'L\'adresse IP dit d\'ou vient la connexion, pas qui la fait. Un poste infecte, un VPN mal configure ou un serveur detourne donnent une adresse interne parfaitement legitime. Le zero trust demande une identite verifiee et un etat d\'appareil, pas une position.',
						),
						array(
							'question'    => 'Un administrateur possede un compte a privileges eleves, qu\'il utilise aussi pour lire ses courriels. Pourquoi est-ce un probleme dans une architecture zero trust ?',
							'mode'        => 'choice',
							'topic'       => '1.3',
							'choices'     => array( 'Le privilege est permanent et polyvalent : une action banale expose un droit qui ne devrait servir qu\'a une action precise', 'Ce n\'est pas un probleme des lors que le compte est protege par un second facteur d\'authentification, meme s\'il est polyvalent', 'Le probleme est la boite mail, qui devrait etre interdite a tout administrateur systeme du site, pour toujours et partout', 'Le probleme est la lenteur : un compte privilegie met plus de temps a s\'authentifier a chaque fois qu\'on l\'ouvre, le matin' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Un courriel malveillant lu avec un compte administrateur, que se passe-t-il ?',
							'explanation' => 'C\'est le principe du moindre privilege applique dans le temps : un droit eleve doit exister au moment de l\'action, pas avant ni apres. Un compte d\'administration separe, et eleve a la demande, reduit la fenetre pendant laquelle une erreur de lecture devient une compromission totale.',
						),
						array(
							'question'    => 'Une entreprise a deploye un portail d\'authentification unique (SSO) devant toutes ses applications. Peut-elle dire qu\'elle a fait du zero trust ?',
							'mode'        => 'choice',
							'topic'       => '1.3',
							'choices'     => array( 'Non : le SSO verifie l\'identite une fois, il ne reevalue pas l\'acces a chaque action', 'Oui : le SSO est le composant central du zero trust, et tout le reste en decoule naturellement', 'Oui, a condition que le SSO soit heberge dans le cloud et non sur un serveur du site', 'Non : le zero trust interdit le SSO, qui cree un point unique de defaillance pour tout le monde' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Une fois la session ouverte, que verifie-t-on avant chaque action ?',
							'explanation' => 'Le SSO est une brique utile — il donne une identite fiable — mais il raisonne en session : une fois ouverte, elle dure. Le zero trust demande une decision par action, avec le contexte du moment. Le SSO repond a « qui es-tu », pas a « as-tu encore le droit, maintenant, d\'ici ».',
						),
					),
				),
				array(
					'type'       => 'test',
					'format'     => 'pratique',
					'title'  => 'Task 3 : La mission — compter les acces sans verification',
					'content'=> '<p><strong>Mission.</strong> L\'audit d\'architecture du service est sur la machine de l\'atelier. Il liste les regles d\'acces et, pour chacune, le controle applique.</p><p>Trouve <strong>le nombre de regles qui reposent sur la seule position reseau</strong>, sans verification d\'identite ni d\'etat de l\'appareil, tel qu\'il est ecrit dans l\'audit (un nombre, en chiffres).</p>',
					'questions' => array(
						array(
							'question'    => 'Combien de regles d\'acces reposent sur la seule position reseau, d\'apres l\'audit ?',
							'mode'        => 'text',
							'topic'       => '1.3',
							'answers'     => array( '/\\b5\\b/' ),
							'xp'          => 40,
							'hint'        => 'Dans le terminal : <code>cat /srv/atelier/audit-architecture.md</code>. Compte les lignes dont la colonne CONTROLE vaut « position reseau ».',
							'explanation' => 'Cinq regles sur huit ne verifient que la position. Trois verifient l\'identite (compte nominatif) et une verifie l\'etat de l\'appareil — mais elles ne sont pas combinees : aucune regle ne demande les deux a la fois. C\'est le defaut de fond : une architecture zero trust evalue plusieurs faits ensemble, pas un seul.',
						),
					),
					'terminal' => array(
						'intro'   => 'architecte@atelier:~$ ',
						'unknown' => 'Cette commande ne donne rien ici. L\'audit est dans /srv/atelier.',
						'success' => 'Audit lu. Tu peux compter les regles en confiance implicite.',
						'steps'   => array(
							array(
								'match'  => array( 'ls /srv/atelier', '/^ls .*atelier/', '/^ls$/' ),
								'output' => 'audit-architecture.md
plan-segmentation.txt',
							),
							array(
								'match'  => array( 'cat .*audit-architecture\\.md' ),
								'output' => 'AUDIT D ARCHITECTURE — ACCES AUX SERVICES INTERNES
Date : 03/10
Auditeur : cabinet externe

REGLES D ACCES (8)
-----------------------------------------
R1  Administration BDD    | source 10.0.0.0/8      | CONTROLE : position reseau
R2  Partages fichiers    | source 10.0.0.0/8      | CONTROLE : position reseau
R3  Console de sauvegarde| source 10.20.0.0/16    | CONTROLE : compte nominatif
R4  API facturation      | source 10.0.0.0/8      | CONTROLE : position reseau
R5  Supervision          | source toute         | CONTROLE : position reseau
R6  Portail RH           | source Internet      | CONTROLE : compte nominatif + etat appareil
R7  Deploiement          | source 10.0.0.0/8      | CONTROLE : position reseau
R8  Messagerie interne   | source 10.0.0.0/8      | CONTROLE : compte nominatif

OBSERVATIONS
-----------------------------------------
- Le reseau 10.0.0.0/8 couvre 16 millions d adresses.
- Le VPN attribue une adresse 10.x a tout poste connecte,
  y compris personnel, sans controle d etat.
- Une seule regle combine identite ET etat de l appareil : R6.
- Le plan de segmentation prevu n a jamais ete applique.',
							),
							array(
								'match'  => array( 'cat .*plan-segmentation\\.txt' ),
								'output' => 'PLAN DE SEGMENTATION (jamais applique)
- decouper 10.0.0.0/8 en 12 segments par metier
- un pare-feu entre chaque segment
- authentification par service, pas par reseau
Statut : valide en comite, non finance.',
							),
							array(
								'match'  => array( 'cat .*', 'less .*', 'more .*' ),
								'output' => 'Aucun fichier de ce nom dans /srv/atelier.',
							),
						),
					),
				),
				array(
					'type'       => 'exam',
					'format'     => 'qcm',
					'title'  => 'Task 4 : Examen de fin de room',
					'content'=> '<p>Quatre questions, 8 minutes, seuil 80 %. Aucun indice.</p>',
					'time_limit' => 8,
					'pass_score' => 80,
					'questions' => array(
						array(
							'question'    => 'Dans une architecture zero trust, quelle est la difference entre le point de decision et le point d\'application ?',
							'mode'        => 'choice',
							'topic'       => '1.3',
							'choices'     => array( 'Le premier rend le verdict sur la demande ; le second fait respecter ce verdict', 'Le premier fait respecter le verdict ; le second le rend apres inspection du trafic', 'Les deux sont synonymes : le vocabulaire change selon le fournisseur de la solution', 'Le premier est humain et le second automatique, dans toute architecture conforme' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Le PDP juge, le PEP applique. Les confondre revient a croire qu\'un pare-feu decide de la politique : il l\'execute, sur ordre d\'un autre composant. C\'est cette separation qui permet de changer la politique sans toucher aux portes.',
						),
						array(
							'question'    => 'Un poste de travail est infecte par un cheval de Troie. En quoi cela illustre-t-il la limite du modele perimetrique ?',
							'mode'        => 'choice',
							'topic'       => '1.3',
							'choices'     => array( 'Le poste est interne, donc repute sur : l\'attaquant circule sans franchir le rempart', 'Le pare-feu aurait du bloquer le cheval de Troie, il est donc mal configure depuis le debut', 'Le modele perimetrique est adapte, c\'est l\'antivirus du poste qui a echoue tout seul seul', 'Cela n\'illustre rien : un poste infecte reste un probleme de poste, et non un probleme de reseau' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'L\'attaquant n\'a pas eu besoin de forcer le perimetre : il est entre par un courriel, sur un poste legitime, et se retrouve a l\'interieur avec les droits de ce poste. Le zero trust repond a cela en verifiant chaque acces, y compris ceux qui viennent de l\'interieur.',
						),
						array(
							'question'    => 'Que signifie « moindre privilege » applique a un compte d\'administration, dans le temps ?',
							'mode'        => 'choice',
							'topic'       => '1.3',
							'choices'     => array( 'Le droit eleve n\'existe que pendant l\'action qui le justifie, puis il est retire', 'Le compte d\'administration doit etre cree le plus tard possible apres l\'embauche du salarie', 'Le compte doit avoir moins de droits que les autres comptes, de facon permanente et verifiee', 'Le mot de passe du compte doit etre change plus souvent que celui des autres utilisateurs' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Le privilege doit etre une fenetre, pas un statut. Eleve a la demande, pour une duree bornee, il reduit la periode pendant laquelle un vol de session ou une erreur de manipulation devient une compromission. Un compte administrateur permanent est un droit ouvert vingt-quatre heures sur vingt-quatre.',
						),
						array(
							'question'    => 'Une entreprise applique le zero trust a ses utilisateurs, mais laisse ses serveurs communiquer librement entre eux dans le meme VLAN. Quel est le probleme ?',
							'mode'        => 'choice',
							'topic'       => '1.3',
							'choices'     => array( 'La confiance implicite demeure entre serveurs : une machine compromise donne acces aux autres', 'Aucun : le zero trust ne concerne que les utilisateurs, jamais les machines qui se parlent entre elles', 'Le probleme est la taille du VLAN : au-dela de dix serveurs, il faut un autre modele reseau, plus plat', 'Le probleme est le chiffrement : les flux entre serveurs ne sont jamais chiffres, par defaut, en interne' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'C\'est le mouvement lateral, et c\'est la raison d\'etre du micro-segment : un serveur web compromis ne doit pas pouvoir joindre la base de donnees simplement parce qu\'ils partagent un VLAN. Le zero trust s\'applique aux charges de travail aussi, souvent avec plus d\'enjeu qu\'aux utilisateurs.',
						),
					),
				),
			),
			'i18n'       => array(
				'en' => array(
					'title'   => 'The internal network was safe',
					'excerpt' => '"We are on the internal network, so we are trusted." That sentence cost this company more than any other. Follow the attack that proved it false, and decide where the control belongs.',
					'tasks'   => array(
						array(
							'title'  => 'Task 1: The castle, and what replaced it',
							'content'=> '<p>The classic model is called the <strong>perimeter</strong>: an inside network, deemed safe, protected by a wall (the firewall). Once inside, you move freely. That model assumes the inside is populated by trusted people, and that the attacker is outside.</p><p>Three facts made that assumption false, and none of them is a fashion:</p><ul><li><strong>remote work</strong> — users are outside part of the time, and so are their machines;</li><li><strong>the cloud</strong> — applications are no longer in the building, and the "internal network" no longer leads to them;</li><li><strong>compromise from the inside</strong> — phishing, an infected workstation, a contractor, a stolen account. The attacker often gets an <em>internal</em> foothold before attacking, and the perimeter no longer stops them.</li></ul><p><strong>Zero trust</strong> — which the framework also calls <em>zero confidence</em> — (NIST SP 800-207) draws a simple rule from this: <em>no implicit trust, whatever the network position</em>. Every access is evaluated every time, on facts: who is asking, from which device, what its state is, towards which resource, for which action.</p><p>Two components, and they must be distinguished:</p><ul><li>the <strong>policy decision point</strong> (PDP): it receives the request, applies the policy, and returns a verdict — allow, deny, or partially allow;</li><li>the <strong>policy enforcement point</strong> (PEP): it enforces the verdict. It is the door, not the judge.</li></ul><p>Four misunderstandings, all common:</p><ul><li>"zero trust means zero access" — no. It means <em>verify before access</em>. A legitimate user works normally;</li><li>"zero trust is a product" — no. It is an architecture: a policy, context sources, and an enforcement point. A product can serve it, none can replace it;</li><li>"the internal network is trusted, only the outside is verified" — that is precisely the error the model corrects;</li><li>"zero trust removes segmentation" — no, it makes it finer: the micro-segment replaces the big internal VLAN.</li></ul><p>The principle that sums it up, and that comes from least privilege: <strong>an access granted for one action does not hold for the others</strong>. Reading a folder does not give the right to write in it, and logging in in the morning does not give the right to log in at midnight from another country.</p><p><strong>Remember:</strong> the zero trust question is not "am I inside or outside", but "on which facts did I just decide, and where is the door that enforces my decision".</p>',
							'questions' => array(),
						),
						array(
							'title'  => 'Task 2: Practice — three implicit trusts',
							'content'=> '<p>Three situations. For each one: where is the implicit trust, and what should be verified?</p>',
							'questions' => array(
								array(
									'question'    => 'An internal application accepts any request coming from an IP address in the 10.0.0.0/8 range, with no other check. What is the zero trust flaw?',
									'choices'     => array( 'Trust comes from the network position, not from identity or the device state', 'None: an internal IP address is sufficient proof of identity in practice', 'The flaw is the size of the network: a /8 is too large to ever be segmented', 'The flaw is the lack of encryption, the network position having nothing to do with it' ),
									'correct'     => 0,
									'hint'        => 'An attacker who gets an internal workstation also gets an internal address.',
									'explanation' => 'The IP address says where the connection comes from, not who makes it. An infected workstation, a badly configured VPN or a hijacked server all provide a perfectly legitimate internal address. Zero trust asks for a verified identity and a device state, not a position.',
								),
								array(
									'question'    => 'An administrator owns a highly privileged account, and also uses it to read email. Why is that a problem in a zero trust architecture?',
									'choices'     => array( 'The privilege is permanent and all-purpose: a routine action exposes a right meant for one precise action only', 'It is not a problem as long as the account is protected by a second authentication factor, even a shared one, always', 'The problem is the mailbox, which should be forbidden to every system administrator of the site, without exception', 'The problem is speed: a privileged account takes longer to authenticate every single time it is opened' ),
									'correct'     => 0,
									'hint'        => 'A malicious email read with an administrator account — what happens?',
									'explanation' => 'This is least privilege applied over time: an elevated right should exist at the moment of the action, not before or after. A separate administrative account, elevated on demand, shrinks the window during which one reading mistake becomes a total compromise.',
								),
								array(
									'question'    => 'A company has deployed a single sign-on portal (SSO) in front of all its applications. Can it say it has done zero trust?',
									'choices'     => array( 'No: SSO verifies identity once, it does not re-evaluate access for every action', 'Yes: SSO is the central component of zero trust, everything else follows from it', 'Yes, provided the SSO is hosted in the cloud rather than on site', 'No: zero trust forbids SSO, which creates a single point of failure' ),
									'correct'     => 0,
									'hint'        => 'Once the session is open, what is verified before each action?',
									'explanation' => 'SSO is a useful building block — it provides a reliable identity — but it reasons in sessions: once open, the session lasts. Zero trust asks for a decision per action, with the context of the moment. SSO answers "who are you", not "do you still have the right, now, from here".',
								),
							),
						),
						array(
							'title'  => 'Task 3: The mission — count the unchecked accesses',
							'content'=> '<p><strong>Mission.</strong> The service architecture audit is on the workshop machine. It lists the access rules and, for each one, the check applied.</p><p>Find <strong>the number of rules that rely on network position alone</strong>, with no identity check and no device state check, as written in the audit (a number, in digits).</p>',
							'questions' => array(
								array(
									'question'    => 'How many access rules rely on network position alone, according to the audit?',
									'answers'     => array( '/\\b5\\b/' ),
									'hint'        => 'In the terminal: <code>cat /srv/atelier/audit-architecture.md</code>. Count the lines whose CONTROLE column reads "position reseau".',
									'explanation' => 'Five rules out of eight check the position only. Three check identity (named account) and one checks the device state — but they are not combined: no rule asks for both at once. That is the underlying flaw: a zero trust architecture evaluates several facts together, not just one.',
								),
							),
						),
						array(
							'title'  => 'Task 4: End-of-room exam',
							'content'=> '<p>Four questions, 8 minutes, pass mark 80%. No hints.</p>',
							'questions' => array(
								array(
									'question'    => 'In a zero trust architecture, what is the difference between the policy decision point and the policy enforcement point?',
									'choices'     => array( 'The first returns the verdict on the request; the second enforces that verdict', 'The first enforces the verdict; the second returns it after inspecting the traffic', 'The two are synonyms: the vocabulary changes with the product vendor', 'The first is human and the second automatic, in every compliant architecture' ),
									'correct'     => 0,
									'explanation' => 'The PDP judges, the PEP enforces. Confusing them amounts to believing that a firewall decides the policy: it executes it, on another component\'s orders. That separation is what allows the policy to change without touching the doors.',
								),
								array(
									'question'    => 'A workstation is infected by a trojan. How does that illustrate the limit of the perimeter model?',
									'choices'     => array( 'The workstation is internal, therefore deemed safe: the attacker moves around without crossing the wall', 'The firewall should have blocked the trojan, so it is badly configured from the start, by the vendor', 'The perimeter model is fine, it is the antivirus on the workstation that failed alone this time, not the wall', 'It illustrates nothing: an infected workstation is a workstation problem, and not a network problem at all' ),
									'correct'     => 0,
									'explanation' => 'The attacker did not need to force the perimeter: they came in through an email, on a legitimate workstation, and ended up inside with that workstation\'s rights. Zero trust answers this by verifying every access, including those coming from the inside.',
								),
								array(
									'question'    => 'What does "least privilege" mean when applied to an administrative account, over time?',
									'choices'     => array( 'The elevated right exists only during the action that justifies it, then it is removed', 'The administrative account must be created as late as possible after the employee is hired', 'The account must have fewer rights than the other accounts, permanently and verifiably', 'The account password must be changed more often than the passwords of all other users' ),
									'correct'     => 0,
									'explanation' => 'Privilege should be a window, not a status. Elevated on demand, for a bounded duration, it reduces the period during which a stolen session or a manipulation mistake becomes a compromise. A permanent administrator account is a right left open twenty-four hours a day.',
								),
								array(
									'question'    => 'A company applies zero trust to its users, but lets its servers communicate freely within the same VLAN. What is the problem?',
									'choices'     => array( 'Implicit trust remains between servers: one compromised machine gives access to the others', 'None: zero trust only concerns users, and never machines that talk to each other, whatever the stakes', 'The problem is the VLAN size: beyond ten servers, another network model is needed, flatter and cheaper', 'The problem is encryption: traffic between servers is never encrypted, by default, inside the network' ),
									'correct'     => 0,
									'explanation' => 'This is lateral movement, and it is the reason micro-segmentation exists: a compromised web server must not be able to reach the database simply because they share a VLAN. Zero trust applies to workloads too, often with more at stake than for users.',
								),
							),
						),
					),
				),
			),
		),
		array(
			'title'       => 'La porte du fond, ouverte en decembre',
			'excerpt'     => 'Une intervention de maintenance ouvre une porte qui ne se refermera pas. Personne n\'a change la configuration : quelqu\'un l\'a changee, sans documenter, un vendredi. Voila comment un changement non trace devient une intrusion.',
			'content'     => 'Deux sujets du referentiel se rejoignent dans une seule histoire : la gestion du changement (1.4) et la securite physique (1.7). Un changement de configuration non autorise et non documente, qui ouvre une porte — au sens propre.',
			'difficulty'  => 'moyen',
			'duration'   => 35,
			'xp_bonus'   => 65,
			'track'      => 'concepts',
			'source'     => array(
				'nom'        => 'NIST SP 800-128 — Guide for Security-Focused Configuration Management',
				'url'        => 'https://csrc.nist.gov/pubs/sp/800/128/final',
				'licence'    => 'Domaine public (publication du NIST, Etats-Unis)',
				'attribution'=> 'NIST Special Publication 800-128, Guide for Security-Focused Configuration Management of Information Systems (aout 2011) ; NIST SP 800-53 Rev. 5, famille PE (Physical and Environmental Protection)',
			),
			'tasks'      => array(
				array(
					'type'       => 'lesson',
					'format'     => 'lecon',
					'title'  => 'Task 1 : Un changement, quatre traces, et une porte',
					'content'=> '<p>La <strong>gestion du changement</strong> (<em>change management</em> dans les referentiels anglais, et sur les offres d\'emploi) n\'est pas de la paperasse : c\'est ce qui permet de repondre, six mois plus tard, a la question « qui a modifie cela, quand, pourquoi, et qui l\'a valide ». Le NIST SP 800-128 en donne le socle : une <em>ligne de base</em> documentee, un <em>changement</em> autorise avant application, une <em>verification</em> apres, et un <em>retour arriere</em> possible.</p><p>Quatre elements, et il en manque toujours un dans les organisations en crise :</p><ul><li><strong>la ligne de base</strong> — l\'etat de reference, ecrit. Sans elle, personne ne sait ce qui a change, puisque personne ne sait ce qu\'il y avait avant ;</li><li><strong>l\'autorisation</strong> — qui a le droit de changer quoi. Une urgence n\'annule pas l\'autorisation : elle la rend <em>a posteriori</em>, avec une trace ;</li><li><strong>la trace</strong> — le changement laisse une ecriture : ticket, journal, commit, bon d\'intervention. Une modification sans trace n\'est pas un changement, c\'est un accident en attente ;</li><li><strong>le retour arriere</strong> — comment revenir a la ligne de base. Un changement qu\'on ne sait pas defaire se decide a deux fois.</li></ul><p>Trois types de changement, et un seul exige la trace complete : le <strong>standard</strong> (pre-approuve, repetitif), le <strong>normal</strong> (valide en comite), l\'<strong>urgent</strong> (applique tout de suite, valide apres). Le changement urgent est celui qui casse tout, parce qu\'il est applique par quelqu\'un qui n\'a pas le temps d\'ecrire.</p><p>La <strong>securite physique</strong> (sujet 1.7) obeit exactement aux memes regles, et c\'est la que l\'histoire de cette room se noue :</p><ul><li><strong>le controle d\'acces physique</strong> — badge, sas, registre de visiteurs. Un badge non releve n\'est pas un controle : c\'est une serrure dont personne ne verifie la clef ;</li><li><strong>le tailgating</strong> — entrer derriere une personne autorisee, sans badge. Aucun badge ne l\'empeche : seul un sas a fermeture automatique, ou une consigne tenue, le fait ;</li><li><strong>la salle serveur</strong> — un local dont l\'acces est trace, et dont l\'etat physique (temperature, eau, feu, alimentation) est surveille ;</li><li><strong>le changement physique</strong> — une intervention de maintenance qui ouvre une porte, deplace une armoire ou desactive une alarme est un changement de configuration au meme titre qu\'une modification de pare-feu. Elle doit etre autorisee, tracee, et verifiee apres.</li></ul><p><strong>Le point qui relie les deux sujets :</strong> la plupart des intrusions physiques ne demandent aucune effraction. Elles profitent d\'un changement non referme — une porte de service laissee en position jour, un badge de prestataire non revoque, une alarme coupee pour une intervention et jamais remise. Ce n\'est pas un defaut de serrure : c\'est un defaut de gestion du changement.</p><p><strong>A retenir :</strong> une porte n\'est sure que si l\'on sait qui l\'a ouverte en dernier, pourquoi, et si elle a ete refermee. La question vaut pour la porte du batiment comme pour la regle de pare-feu.</p>',
					'questions' => array(),
				),
				array(
					'type'       => 'practice',
					'format'     => 'qcm',
					'title'  => 'Task 2 : Entrainement — trois changements, trois defauts',
					'content'=> '<p>Trois changements reels. A chaque fois : quel element manque, et quelle porte s\'ouvre ?</p>',
					'questions' => array(
						array(
							'question'    => 'Un prestataire intervient sur la climatisation un vendredi. Il desactive l\'alarme de la salle serveur pour ne pas la declencher, et oublie de la remettre. Que manque-t-il ?',
							'mode'        => 'choice',
							'topic'       => '1.7',
							'choices'     => array( 'La verification apres intervention : personne n\'a controle que l\'etat initial etait retabli', 'L\'autorisation : un prestataire ne devrait jamais toucher a une alarme, meme accompagne sur site', 'La ligne de base : l\'alarme n\'etait pas documentee avant l\'intervention du prestataire du prestataire', 'Rien : c\'est une intervention de maintenance, elle est hors du perimetre du changement' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'L\'intervention etait peut-etre autorisee. Qu\'est-ce qui n\'a pas eu lieu apres ?',
							'explanation' => 'Desactiver une alarme peut etre legitime, et souvent necessaire. Ce qui manque, c\'est la verification de retour a l\'etat initial : une case a cocher en fin d\'intervention, signee par l\'accompagnant. La porte est restee ouverte pendant des semaines, sans que personne ne l\'ait decide.',
						),
						array(
							'question'    => 'Un administrateur modifie une regle de pare-feu pour depanner un utilisateur, sans ouvrir de ticket. Le changement fonctionne. Quel est le risque principal ?',
							'mode'        => 'choice',
							'topic'       => '1.4',
							'choices'     => array( 'Personne ne saura pourquoi cette regle existe, ni si elle peut etre retiree sans casser quelque chose', 'Aucun, puisque le changement a resolu le probleme et qu\'il est reversible en theorie, sans risque aucun', 'Le risque est la performance du pare-feu, qui se degrade a chaque regle ajoutee au fil des ans, lentement', 'Le risque est juridique uniquement : la loi impose un ticket pour chaque modification du systeme, sans exception' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Dans six mois, quelqu\'un voudra nettoyer les regles. Que fera-t-il de celle-la ?',
							'explanation' => 'Une regle sans trace devient une regle intouchable : personne n\'ose la retirer, de peur de casser un service dont plus personne ne se souvient. Le risque n\'est pas le changement lui-meme, c\'est qu\'il devienne invisible et permanent. C\'est ainsi qu\'un pare-feu se remplit de trous que personne n\'a decides.',
						),
						array(
							'question'    => 'Quelle est la difference entre un changement normal et un changement urgent, du point de vue de la trace ?',
							'mode'        => 'choice',
							'topic'       => '1.4',
							'choices'     => array( 'Aucune sur la trace : l\'urgent est simplement autorise apres application, pas avant', 'L\'urgent n\'a pas besoin de trace, puisqu\'il repond a une situation exceptionnelle et imprevue', 'L\'urgent se trace dans un journal different, qui n\'est pas consultable par l\'audit interne', 'L\'urgent est autorise avant application, comme un changement normal, mais avec un delai plus court' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'L\'urgence change le moment de l\'autorisation, pas son existence.',
							'explanation' => 'Un changement urgent est applique d\'abord, valide ensuite — c\'est ce qui le rend urgent. Mais la trace reste obligatoire, et c\'est elle qui permet la validation apres coup. Un changement urgent non trace est indistinguable d\'une compromission : on ne peut pas dire s\'il a ete decide ou subi.',
						),
					),
				),
				array(
					'type'       => 'test',
					'format'     => 'pratique',
					'title'  => 'Task 3 : La mission — retrouver le changement qui a ouvert la porte',
					'content'=> '<p><strong>Mission.</strong> Une intrusion a eu lieu par une porte de service. Le journal des changements est sur la machine de l\'atelier, et il contient toutes les interventions du batiment.</p><p>Trouve <strong>le numero du changement</strong> qui a laisse la porte ouverte (format <code>CHG-XX</code>). C\'est lui qui explique l\'intrusion.</p>',
					'questions' => array(
						array(
							'question'    => 'Quel numero de changement a laisse la porte de service ouverte ? (format CHG-XX)',
							'mode'        => 'text',
							'topic'       => '1.4',
							'answers'     => array( '/CHG-?\\s?0?7/i', '/chg-?0?7/i' ),
							'xp'          => 40,
							'hint'        => 'Dans le terminal : <code>cat /srv/atelier/journal-changements.log</code>. Cherche une intervention sur un acces physique dont l\'etat final n\'est pas « referme ».',
							'explanation' => 'Le CHG-07 est une intervention de maintenance sur le ferme-porte de la porte de service, cloturee sans verification de l\'etat final. Le ferme-porte n\'a pas ete remis en service, et la porte est restee ouverte pendant trois semaines. Le journal ne dit pas « porte ouverte » : il dit « non verifie ». C\'est exactement le trou que la gestion du changement doit boucher.',
						),
					),
					'terminal' => array(
						'intro'   => 'batiment@atelier:~$ ',
						'unknown' => 'Cette commande ne donne rien ici. Le journal est dans /srv/atelier.',
						'success' => 'Journal lu. Tu peux nommer le changement fautif.',
						'steps'   => array(
							array(
								'match'  => array( 'ls /srv/atelier', '/^ls .*atelier/', '/^ls$/' ),
								'output' => 'journal-changements.log
plan-acces.txt',
							),
							array(
								'match'  => array( 'cat .*journal-changements\\.log', 'grep .*CHG.*journal' ),
								'output' => 'JOURNAL DES CHANGEMENTS — BATIMENT B (trimestre 4)
----------------------------------------------------
CHG-01  02/10  Pare-feu      ajout regle 443 vers serveur MAJ   | cloture : verifie
CHG-02  09/10  Badge         ajout prestataire S. Ba            | cloture : verifie
CHG-03  14/10  Alarme        report detecteur couloir           | cloture : verifie
CHG-04  21/10  Serveur       mise a jour noyau                  | cloture : verifie
CHG-05  28/10  Reseau        changement VLAN atelier            | cloture : verifie
CHG-06  04/11  Badge         revocation stagiaire A. Diallo     | cloture : verifie
CHG-07  02/12  Physique      ferme-porte porte de service       | cloture : NON VERIFIE
CHG-08  09/12  Sauvegarde    ajout volume archive               | cloture : verifie
CHG-09  16/12  Physique      remplacement ampoule couloir       | cloture : verifie

NOTE DE L EQUIPE BATIMENT
Le ferme-porte de la porte de service a ete demonte pour
peinture le 02/12. Il devait etre repose le lendemain.
Personne ne l a repose. La porte est restee en position
jour jusqu au constat du 23/12.

Aucune intrusion n a ete detectee : l alarme de la porte
de service est sur le meme detecteur que le CHG-03,
reporte au 14/10 et jamais remis en service.',
							),
							array(
								'match'  => array( 'cat .*plan-acces\\.txt' ),
								'output' => 'PLAN D ACCES — BATIMENT B
- entree principale : badge + sas
- porte de service : badge + ferme-porte (acces parking)
- quai de livraison : badge + grille (journee seulement)
- fenetres salle serveur : grillage fixe
Regle : toute intervention sur un acces physique
        exige une verification de l etat final, signee.',
							),
							array(
								'match'  => array( 'cat .*', 'less .*', 'more .*' ),
								'output' => 'Aucun fichier de ce nom dans /srv/atelier.',
							),
						),
					),
				),
				array(
					'type'       => 'exam',
					'format'     => 'qcm',
					'title'  => 'Task 4 : Examen de fin de room',
					'content'=> '<p>Quatre questions, 8 minutes, seuil 80 %. Aucun indice.</p>',
					'time_limit' => 8,
					'pass_score' => 80,
					'questions' => array(
						array(
							'question'    => 'Pourquoi la ligne de base est-elle le premier element de la gestion du changement ?',
							'mode'        => 'choice',
							'topic'       => '1.4',
							'choices'     => array( 'Sans etat de reference ecrit, personne ne peut dire ce qui a change ni revenir en arriere', 'Parce que la ligne de base est exigee par la loi avant tout changement informatique notable', 'Parce qu\'elle remplace l\'autorisation : un changement conforme a la base est approuve d\'office', 'Parce qu\'elle permet de mesurer la performance du systeme avant et apres le changement' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'La ligne de base est ce a quoi on compare. Sans elle, un changement est invisible : on ne peut ni le detecter, ni l\'evaluer, ni l\'annuler. C\'est le sens du NIST SP 800-128 : la gestion de configuration commence par une description ecrite de l\'etat attendu.',
						),
						array(
							'question'    => 'Un sas a fermeture automatique protege contre quelle pratique, qu\'un simple badge ne bloque pas ?',
							'mode'        => 'choice',
							'topic'       => '1.7',
							'choices'     => array( 'Le tailgating : entrer derriere une personne autorisee, sans presenter de badge', 'Le vol de badge : un badge vole ne fonctionne plus des qu\'il est signale par son porteur', 'L\'usurpation d\'identite : le sas verifie la photo du porteur du badge a chaque passage', 'La perte de badge : le sas invalide le badge perdu des la premiere utilisation qui en est faite' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Le tailgating ne casse aucune serrure : il profite de la politesse. Un badge unique ne l\'empeche pas, puisqu\'une seule presentation ouvre pour deux personnes. Seul un dispositif qui compte les passages — sas, tourniquet — ou une consigne tenue par les equipes le limite.',
						),
						array(
							'question'    => 'Une intervention de maintenance desactive une alarme pendant deux heures. Quel est le controle qui manque le plus souvent, et qui compte le plus ?',
							'mode'        => 'choice',
							'topic'       => '1.7',
							'choices'     => array( 'La verification de remise en service en fin d\'intervention, signee par un temoin', 'L\'autorisation ecrite du prestataire, qui doit etre archivee pendant cinq ans par le service', 'L\'information des salaries, qui doivent etre prevenus de la desactivation par courriel', 'La presence d\'un agent de securite pendant toute la duree de l\'intervention dans le batiment' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Desactiver une alarme est parfois unavoidable — un detecteur se declenche a cause des travaux. Ce qui n\'est pas acceptable, c\'est de ne pas verifier qu\'elle est revenue. Le controle manquant est un geste simple, en fin d\'intervention, avec un nom en face. C\'est celui que le CHG-07 de la room n\'avait pas.',
						),
						array(
							'question'    => 'Un changement de configuration non trace est decouvert six mois plus tard. Pourquoi est-il plus dangereux qu\'un changement trace, meme s\'il etait legitime au depart ?',
							'mode'        => 'choice',
							'topic'       => '1.4',
							'choices'     => array( 'Personne ne peut dire s\'il a ete decide ou subi, ni s\'il est encore necessaire', 'Il consomme plus de ressources, parce qu\'il n\'a pas ete optimise a l\'application', 'Il expire automatiquement au bout d\'un an, ce qui casse le service brutalement', 'Il n\'est pas plus dangereux : seule la forme de la trace distingue les deux cas' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Un changement trace porte son auteur, son motif et sa date : on peut le comprendre, le garder ou le retirer. Un changement non trace est indiscernable d\'une porte derobee, et c\'est cette ambiguite qui coute cher : soit on garde un trou, soit on retire une regle dont un service depend peut-etre.',
						),
					),
				),
			),
			'i18n'       => array(
				'en' => array(
					'title'   => 'The back door, left open in December',
					'excerpt' => 'A maintenance job opens a door that never closes again. Nobody changed the configuration: someone changed it, undocumented, on a Friday. That is how an untracked change becomes an intrusion.',
					'tasks'   => array(
						array(
							'title'  => 'Task 1: A change, four traces, and one door',
							'content'=> '<p><strong>Change management</strong> (<em>change management</em> in English frameworks, and on job adverts) is not paperwork: it is what allows you to answer, six months later, the question "who changed this, when, why, and who approved it". NIST SP 800-128 gives its basis: a documented <em>baseline</em>, a <em>change</em> authorised before it is applied, a <em>verification</em> afterwards, and a possible <em>rollback</em>.</p><p>Four elements, and one is always missing in organisations in crisis:</p><ul><li><strong>the baseline</strong> — the written reference state. Without it, nobody knows what changed, because nobody knows what was there before;</li><li><strong>the authorisation</strong> — who has the right to change what. An emergency does not cancel authorisation: it makes it <em>after the fact</em>, with a trace;</li><li><strong>the trace</strong> — the change leaves a record: a ticket, a log, a commit, a work permit. A modification without a trace is not a change, it is an accident waiting to happen;</li><li><strong>the rollback</strong> — how to return to the baseline. A change you cannot undo is a change you must decide twice.</li></ul><p>Three types of change, and only one requires the full trace: <strong>standard</strong> (pre-approved, repetitive), <strong>normal</strong> (approved in committee), <strong>emergency</strong> (applied at once, approved afterwards). The emergency change is the one that breaks everything, because it is applied by someone who has no time to write.</p><p><strong>Physical security</strong> (topic 1.7) obeys exactly the same rules, and that is where this room\'s story comes together:</p><ul><li><strong>physical access control</strong> — badge, airlock, visitor log. A badge log nobody reads is not a control: it is a lock whose key nobody checks;</li><li><strong>tailgating</strong> — walking in behind an authorised person, without a badge. No badge reader prevents it: only a self-closing airlock, or a rule people actually follow, does;</li><li><strong>the server room</strong> — a room whose access is logged, and whose physical state (temperature, water, fire, power) is monitored;</li><li><strong>the physical change</strong> — a maintenance job that opens a door, moves a cabinet or disables an alarm is a configuration change just like a firewall edit. It must be authorised, traced, and verified afterwards.</li></ul><p><strong>The point that links the two topics:</strong> most physical intrusions involve no break-in at all. They exploit an unfinished change — a service door left in the open position, a contractor badge never revoked, an alarm switched off for a job and never switched back on. This is not a lock defect: it is a change management defect.</p><p><strong>Remember:</strong> a door is only as safe as your knowledge of who last opened it, why, and whether it was closed again. The question holds for the building door as much as for the firewall rule.</p>',
							'questions' => array(),
						),
						array(
							'title'  => 'Task 2: Practice — three changes, three defects',
							'content'=> '<p>Three real changes. For each one: what is missing, and which door opens?</p>',
							'questions' => array(
								array(
									'question'    => 'A contractor works on the air conditioning on a Friday. They disable the server room alarm so it does not trigger, and forget to switch it back on. What is missing?',
									'choices'     => array( 'Verification after the job: nobody checked that the initial state had been restored', 'Authorisation: a contractor should never touch an alarm, even when accompanied on site', 'The baseline: the alarm was not documented before the contractor\'s job on the site', 'Nothing: this is maintenance work, so it falls outside the change process entirely' ),
									'correct'     => 0,
									'hint'        => 'The job may have been authorised. What did not happen afterwards?',
									'explanation' => 'Disabling an alarm can be legitimate, and often necessary. What is missing is the verification of the return to the initial state: a box checked at the end of the job, signed by the person accompanying. The door stayed open for weeks, and nobody decided that.',
								),
								array(
									'question'    => 'An administrator edits a firewall rule to unblock a user, without opening a ticket. The change works. What is the main risk?',
									'choices'     => array( 'Nobody will know why this rule exists, or whether it can be removed without breaking something', 'None, since the change solved the problem and is reversible in theory, at any time, without risk', 'The risk is firewall performance, which degrades with every added rule over the years, slowly but surely', 'The risk is legal only: the law requires a ticket for every modification of the system, without exception' ),
									'correct'     => 0,
									'hint'        => 'In six months, someone will want to clean up the rules. What will they do with that one?',
									'explanation' => 'A rule without a trace becomes an untouchable rule: nobody dares to remove it, for fear of breaking a service nobody remembers. The risk is not the change itself, it is that it becomes invisible and permanent. That is how a firewall fills with holes nobody decided.',
								),
								array(
									'question'    => 'What is the difference between a normal change and an emergency change, from the point of view of the trace?',
									'choices'     => array( 'None on the trace: the emergency one is simply approved after it is applied, not before', 'The emergency one needs no trace, since it answers an exceptional and unforeseen situation', 'The emergency one is traced in a different log, which internal audit is not allowed to read', 'The emergency one is approved before it is applied, like a normal change, but with a shorter delay' ),
									'correct'     => 0,
									'hint'        => 'An emergency changes when the approval happens, not whether it exists.',
									'explanation' => 'An emergency change is applied first and approved afterwards — that is what makes it urgent. But the trace remains mandatory, and it is what allows the approval after the fact. An untraced emergency change is indistinguishable from a compromise: you cannot say whether it was decided or suffered.',
								),
							),
						),
						array(
							'title'  => 'Task 3: The mission — find the change that opened the door',
							'content'=> '<p><strong>Mission.</strong> An intrusion happened through a service door. The change log is on the workshop machine, and it contains every job on the building.</p><p>Find <strong>the change number</strong> that left the door open (format <code>CHG-XX</code>). It is the one that explains the intrusion.</p>',
							'questions' => array(
								array(
									'question'    => 'Which change number left the service door open? (format CHG-XX)',
									'answers'     => array( '/CHG-?\\s?0?7/i', '/chg-?0?7/i' ),
									'hint'        => 'In the terminal: <code>cat /srv/atelier/journal-changements.log</code>. Look for a job on a physical access whose final state is not "closed".',
									'explanation' => 'CHG-07 is a maintenance job on the door closer of the service door, closed without any verification of the final state. The closer was never put back into service, and the door stayed open for three weeks. The log does not say "door open": it says "not verified". That is exactly the hole change management is supposed to plug.',
								),
							),
						),
						array(
							'title'  => 'Task 4: End-of-room exam',
							'content'=> '<p>Four questions, 8 minutes, pass mark 80%. No hints.</p>',
							'questions' => array(
								array(
									'question'    => 'Why is the baseline the first element of change management?',
									'choices'     => array( 'Without a written reference state, nobody can say what changed or roll back', 'Because the baseline is required by law before any IT change', 'Because it replaces authorisation: a change matching the baseline is approved', 'Because it measures the system performance before and after the change' ),
									'correct'     => 0,
									'explanation' => 'The baseline is what you compare against. Without it, a change is invisible: it can be neither detected, nor evaluated, nor reversed. This is the meaning of NIST SP 800-128: configuration management starts with a written description of the expected state.',
								),
								array(
									'question'    => 'A self-closing airlock protects against which practice, that a simple badge does not block?',
									'choices'     => array( 'Tailgating: entering behind an authorised person, without presenting a badge', 'Badge theft: a stolen badge stops working as soon as its holder reports it', 'Identity theft: the airlock checks the photo of the badge holder at every passage', 'Badge loss: the airlock invalidates a lost badge on the first use made of it' ),
									'correct'     => 0,
									'explanation' => 'Tailgating breaks no lock: it exploits courtesy. A single badge reader does not prevent it, since one presentation opens for two people. Only a device that counts passages — airlock, turnstile — or a rule the teams actually follow limits it.',
								),
								array(
									'question'    => 'A maintenance job disables an alarm for two hours. Which control is most often missing, and matters most?',
									'choices'     => array( 'Verification that the alarm was switched back on at the end of the job, signed by a witness', 'The contractor\'s written authorisation, which must be archived for five years by the team that hired him', 'Informing employees, who must be told about the deactivation by email on the day of the job', 'The presence of a security officer for the whole duration of the job in the building, day and night' ),
									'correct'     => 0,
									'explanation' => 'Disabling an alarm is sometimes unavoidable — a detector fires because of the works. What is not acceptable is failing to verify it came back. The missing control is a simple gesture, at the end of the job, with a name attached. It is the one CHG-07 in this room did not have.',
								),
								array(
									'question'    => 'An untraced configuration change is discovered six months later. Why is it more dangerous than a traced change, even if it was legitimate at the time?',
									'choices'     => array( 'Nobody can say whether it was decided or suffered, nor whether it is still needed', 'It uses more resources, because it was not optimised when it was applied to the system', 'It expires automatically after one year, which breaks the service abruptly one morning', 'It is not more dangerous: only the form of the trace tells the two cases apart at all' ),
									'correct'     => 0,
									'explanation' => 'A traced change carries its author, its reason and its date: you can understand it, keep it or remove it. An untraced change is indistinguishable from a back door, and it is that ambiguity that costs: either you keep a hole, or you remove a rule a service may depend on.',
								),
							),
						),
					),
				),
			),
		),
	);
}
