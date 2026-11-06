<?php
/**
 * D3 — Architecture de securite : les trois sujets qui n'existaient pas.
 *
 * MESURE DU 6 NOVEMBRE 2026
 * -------------------------
 * Le domaine D3 « Architecture et conception de la securite » pese 18 % du
 * score Security+ et n'etait couvert qu'a 50 %. Trois de ses six sujets
 * etaient absents, pas seulement pauvres :
 *
 *   3.1 — modeles d'architecture (cloud, sur site, hybride)
 *   3.4 — protection des donnees (classification, DLP, chiffrement au repos)
 *   3.6 — IoT, embarque, systeme industriel
 *
 * Ces trois sujets sont ceux qu'un candidat rate le plus souvent, parce
 * qu'ils s'apprennent mal par lecture : une responsabilite partagee se
 * comprend en cherchant QUI repond de QUOI sur un cas precis, pas en
 * recitant un quadrant.
 *
 * CE QUE CES ROOMS DEMANDENT
 * --------------------------
 * Chacune se termine par une mission ou l'eleve produit un verdict, et par
 * un exercice dans le terminal APPLIQUE le plus souvent :
 *
 *   - 3.1 « La panne dont personne n'est responsable » : une fuite de
 *     donnees en cloud, quatre prestataires, un contrat. Il doit designer
 *     qui devait chiffrer quoi. Le terminal demontre une chose mesurable :
 *     un seau de stockage laisse en lecture publique par la mauvaise case.
 *
 *   - 3.4 « Le dossier qui fuit par la porte » : classification des
 *     donnees, DLP, chiffrement au repos. Le terminal montre la difference
 *     entre donnee chiffree et donnee lisible, avec un chiffrement qu'il
 *     realise lui-meme.
 *
 *   - 3.6 « Le capteur qui n'a jamais parle » : IoT, embarque, ICS.
 *     Terminal : lire un journal de passerelle MQTT et trouver l'appareil
 *     qui garde les identifiants d'usine.
 *
 * Contenu original. Notions publiques : NIST SP 800-145 (cloud), shared
 * responsibility de CIS, NIST SP 800-53 (chiffrement au repos), NISTIR
 * 8228 (IoT). Voir tools/sources-autorisees.json.
 *
 * @package Secura_Academy
 */

defined( 'ABSPATH' ) || exit;

/**
 * Les trois rooms du domaine D3.
 *
 * @return array[]
 */
function seca_default_rooms_d3() {
	return array(
		/* ------------------------------------------------------------------
		 * 3.1 — Modeles d'architecture et responsabilite partagee
		 * ---------------------------------------------------------------- */
		array(
			'title'      => 'La panne dont personne n\'est responsable',
			'excerpt'    => 'Une fuite de donnees en cloud, quatre prestataires, un contrat. Trouve qui devait verrouiller quoi.',
			'content'    => 'En cloud, la responsabilite ne se partage pas comme une facture : elle se partage comme une liste de cases a cocher. Savoir laquelle vous appartient decide de qui on parlera apres la fuite.',
			'difficulty' => 'moyen',
			'duration'   => 35,
			'xp_bonus'   => 60,
			'track'      => 'gouvernance',
			'source'     => array(
				'nom'         => 'NIST SP 800-145 — The NIST Definition of Cloud Computing',
				'url'         => 'https://csrc.nist.gov/pubs/sp/800/145/final',
				'licence'     => 'Domaine public (publication du NIST, Etats-Unis)',
				'attribution' => 'NIST Special Publication 800-145, The NIST Definition of Cloud Computing, P. Mell et T. Grance (2011)',
			),
			'tasks'      => array(
				array(
					'type'    => 'lesson',
					'format'  => 'lecon',
					'title'   => 'Task 1 : La frontiere, pas le partage',
					'content' => '<p>« La responsabilite est partagee » est une phrase de contrat, pas une reponse. La seule question utile est : <strong>quelle case est cochee par qui ?</strong></p>'
						. '<p>Trois modeles, et ce qu\'ils changent pour toi :</p>'
						. '<ul>'
						. '<li><strong>Sur site</strong> — tu possedes tout, tu casses tout. La panne electrique est ton probleme, la mise a jour du noyau aussi.</li>'
						. '<li><strong>IaaS</strong> (infrastructure) — le fournisseur tient la machine et le reseau ; <em>tu</em> tiens le systeme, la configuration et les donnees. C\'est le modele ou l\'on oublie le plus souvent le disque non chiffre.</li>'
						. '<li><strong>PaaS</strong> (plateforme) — le fournisseur tient aussi le systeme et les mises a jour ; tu tiens le code applicatif, les identifiants applicatifs et les donnees.</li>'
						. '<li><strong>SaaS</strong> (logiciel) — le fournisseur tient presque tout ; ce qui reste chez toi n\'est pas technique mais decisif : <strong>qui a le droit d\'entrer, et sur quelles donnees</strong>.</li>'
						. '</ul>'
						. '<p>Ce qui reste toujours chez toi, quel que soit le modele :</p>'
						. '<ul>'
						. '<li>les <strong>identites</strong> et leurs droits (un compte administrateur trop large est ta faute, meme en SaaS) ;</li>'
						. '<li>les <strong>donnees que tu places</strong> dans le service (classer avant de stocker) ;</li>'
						. '<li>la <strong>configuration exposee</strong> — un seau de stockage public ne s\'ouvre pas tout seul ;</li>'
						. '<li>l\'<strong>journalisation</strong> des acces que tu autorises.</li>'
						. '</ul>'
						. '<p><strong>A retenir :</strong> quand une fuite arrive, la premiere question d\'un enqueteur n\'est pas « qui est le fournisseur ? » mais « <em>cette case-la etait-elle a nous ?</em> ». Un exercice concret t\'attend dans le terminal, il montre a quoi ressemble une case oubliee.</p>',
					'questions' => array(),
				),
				array(
					'type'    => 'practice',
					'format'  => 'qcm',
					'title'   => 'Task 2 : Entrainement — quatre cases, un modele',
					'content' => '<p>Pour chaque situation : a qui appartient la case ?</p>',
					'questions' => array(
						array(
							'question'    => 'Dans un abonnement IaaS, le disque de la machine virtuelle n\'est pas chiffre. Qui devait le chiffrer ?',
							'mode'        => 'choice',
							'choices'     => array('Le client : en IaaS, le fournisseur fournit le disque, le client decide de son chiffrement', 'Le fournisseur : il heberge la donnee, donc c est a lui de la proteger sur toute la duree de l incident', 'Personne : le chiffrement au repos est une option commerciale, pas une obligation sur toute la duree de l incident', 'L auditeur : c est son role de le constater, puis de le signaler dans son rapport sur toute la duree de l incident'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'En IaaS, le fournisseur garantit que le disque existe et qu\'il est accessible ; le contenu, et donc son chiffrement, restent au client. C\'est le malentendu le plus couteux du cloud : « il est chez eux » ne veut pas dire « il est protege par eux ».',
						),
						array(
							'question'    => 'Dans un service SaaS, un compte administrateur de l\'entreprise n\'a pas de second facteur. Qui est en defaut ?',
							'mode'        => 'choice',
							'choices'     => array('L\'entreprise : elle gere ses identites et leurs droits, meme quand l\'application est chez le fournisseur', 'Le fournisseur : il devrait imposer le second facteur a tous ses clients, par contrat sur toute la duree de l incident', 'Les deux a egalite : c est le principe meme du modele de responsabilite partagee au moment ou le probleme est constate par l equipe', 'Personne : le second facteur n est pas une obligation technique, seulement une bonne pratique sur toute la duree de l incident'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Le fournisseur peut proposer le second facteur, voire l\'encourager ; c\'est le client qui decide quels comptes sont administrateurs et comment ils s\'authentifient. Une identite trop puissante est une erreur de conception du client.',
						),
						array(
							'question'    => 'Un seau de stockage objet est accessible en lecture a tout Internet. L\'entreprise dit : « c\'est la faute du fournisseur, le reglage par defaut etait permissif ». Que vaut cet argument ?',
							'mode'        => 'choice',
							'choices'     => array('Il ne tient pas : la configuration d\'un service que l\'on utilise est de la responsabilite du client', 'Il tient : un reglage par defaut engage le fournisseur, qui l a choisi et documente sur toute la duree de l incident', 'Il tient a moitie : c est un vice cache, que le client ne pouvait pas raisonnablement voir sur toute la duree de l incident', 'Il tient si le contrat ne mentionne pas le stockage, car le silence vaut acceptation sur toute la duree de l incident'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Un reglage par defaut permissif est un risque connu du client, qui dispose des outils pour le verifier. En Securite, « c\'etait le defaut » n\'est pas une defense : la revue de configuration est une tache du client, et elle est souvent prevue au contrat.',
						),
						array(
							'question'    => 'Quel element reste de la responsabilite du client dans TOUS les modeles de service ?',
							'mode'        => 'choice',
							'choices'     => array('La classification des donnees qu\'il confie au service', 'Les mises a jour du systeme d exploitation des machines virtuelles du client', 'La redondance electrique du centre de donnees qui heberge le service', 'Le renouvellement des certificats TLS du fournisseur et leur surveillance'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Classer la donnee ne peut pas etre delegue : le fournisseur ne sait pas ce que vaut une information pour toi. Et sans classification, aucune mesure de protection ne peut etre choisie correctement, quel que soit le modele.',
						),
					),
				),
				array(
					'type'    => 'mission',
					'format'  => 'terminal',
					'title'   => 'Task 3 : Mission — le seau ouvert',
					'content' => '<p>Le terminal simule la console cloud de l\'entreprise. Tu disposes d\'un inventaire de ressources et des journaux d\'acces.</p>'
						. '<p><strong>Ce que tu cherches :</strong> la ressource de stockage accessible publiquement, et le compte qui l\'a configuree. Cette ressource est la cause directe de la fuite.</p>'
						. '<p>Tu ne peux pas reparer : tu constates et tu designes. C\'est le travail de l\'audit.</p>',
					'questions' => array(
						array(
							'question'    => 'Quel est le nom du seau de stockage accessible publiquement ?',
							'mode'        => 'text',
							'answers'     => array( '/^compta-exports-2026$/', '/compta-exports-2026/' ),
							'xp'          => 40,
							'hint'        => 'Dans le terminal : <code>cat /home/analyste/inventaire.txt</code>. La colonne « public » ne laisse aucun doute.',
							'explanation' => 'Le seau est ouvert depuis le 2 septembre, et le premier acces non autorise date du 14 : douze jours de fenetre d\'exposition. La colonne « cree_par » designe un compte de l\'entreprise, pas le fournisseur. C\'est la demonstration de la lecon : la case « configuration du service » est bien celle du client.',
						),
					),
					'terminal' => array(
						'intro'   => 'analyste@cloud:~$ ',
						'unknown' => 'Cette commande ne donne rien ici.',
						'success' => 'Inventaire lu. Tu peux repondre.',
						'steps'   => array(
							array(
								'match'  => array( 'ls', '/^ls$/'),
								'output' => "inventaire.txt\njournal-acces.log\n",
								'hint'   => 'Deux fichiers : l\'inventaire des ressources et le journal des acces.',
							),
							array(
								'match'  => array( 'cat /home/analyste/inventaire.txt', '/cat .*inventaire/', '/^cat inventaire.txt$/' ),
								'output' => "ressource             type       public   cree_par\ncompta-exports-2026   stockage   oui      s.berrada\ncompta-archives       stockage   non      s.berrada\nsite-vitrine          stockage   oui      prestataire-web\nfactures-2025         stockage   non      direction\n",
								'hint'   => 'Deux ressources sont publiques. Une seule appartient a l\'entreprise et contient des donnees de clients.',
							),
							array(
								'match'  => array( 'cat /home/analyste/journal-acces.log', '/cat .*journal-acces/' ),
								'output' => "2026-09-02 10:14 s.berrada configure compta-exports-2026 public=oui\n2026-09-02 10:15 s.berrada ferme le ticket 4412\n2026-09-14 03:02 inconnu lecture compta-exports-2026 4218 fichiers\n",
								'hint'   => 'La premiere ligne dit qui a ouvert, la troisieme dit quand la fuite a commence.',
							),
						),
					),
				),
				array(
					'type'    => 'exam',
					'format'  => 'qcm',
					'title'   => 'Task 4 : Examen — architecture et responsabilite',
					'content' => '<p>Quatre questions, dans l\'esprit de l\'examen : une seule reponse est juste, les autres sont des raisonnements frequents mais faux.</p>',
					'questions' => array(
						array(
							'question'    => 'Une entreprise migre son application vers un fournisseur PaaS et supprime son pare-feu applicatif. Que vient-elle de perdre ?',
							'mode'        => 'choice',
							'choices'     => array('La visibilite et le filtrage des requetes qu\'elle avait decides, si le fournisseur n\'expose pas d\'equivalent configure par elle', 'Rien : le PaaS inclut toujours un pare-feu applicatif equivalent, active par defaut ce qui est exactement le raisonnement inverse de celui qu il faut tenir', 'Seulement de la performance, la securite de l application reste strictement identique ce qui est exactement le raisonnement inverse de celui qu il faut tenir', 'Le controle du reseau physique, qu elle avait deja perdu en passant dans le cloud ce qui est exactement le raisonnement inverse de celui qu il faut tenir'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Le PaaS prend en charge la plateforme, pas les regles metier de ton trafic : si tu n\'as plus le moyen d\'exprimer « cette route est reservee aux administrateurs », la decision t\'a echappe. Avant de retirer une barriere, on verifie l\'equivalent chez le fournisseur.',
						),
						array(
							'question'    => 'Quel modele de deploiement combine un centre de donnees propre et un service cloud, avec une gestion d\'identite commune ?',
							'mode'        => 'choice',
							'choices'     => array(
								'Hybride',
								'Communautaire',
								'Public',
								'Prive',
							),
							'correct'     => 0,
							'xp'          => 10,
							'explanation' => 'Hybride : deux environnements distincts qui coopèrent. Le point sensible n\'est pas l\'infrastructure mais l\'identite : deux annuaires mal synchronises creent des comptes orphelins actifs, et c\'est par la que passe la plupart des incidents hybrides.',
						),
						array(
							'question'    => 'Une entreprise veut reduire sa surface d\'attaque en cloud. Quelle mesure agit le plus directement sur le risque de fuite par stockage mal configure ?',
							'mode'        => 'choice',
							'choices'     => array('Interdire par politique la creation de seaux publics, et controler automatiquement la conformite', 'Former les utilisateurs au phishing, qui reste la premiere cause de fuite de donnees sur toute la duree de l incident', 'Augmenter la taille des journaux de connexion, pour mieux reconstituer les acces sur toute la duree de l incident', 'Chiffrer les sauvegardes du fournisseur, pour qu une copie volee reste illisible sur toute la duree de l incident'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Une garde technique qui empeche l\'etat dangereux vaut mieux qu\'un controle apres coup : la politique empeche l\'ouverture, le controle la detecte. Le phishing et la taille des journaux ne changent pas la configuration du seau.',
						),
						array(
							'question'    => 'Un fournisseur SaaS annonce « chiffrement au repos AES-256 ». Quelle question reste ouverte ?',
							'mode'        => 'choice',
							'choices'     => array('Qui detient les cles, et le fournisseur peut-il lire les donnees de son cote ?', 'Si l algorithme est reellement AES, dans sa version 256 bits et en mode CBC en realite', 'Si le chiffrement coute plus cher en performance que le stockage en clair dans les faits', 'Si les sauvegardes sont aussi chiffrees, au meme endroit que les donnees en ligne en realite'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Chiffrer avec une cle que le fournisseur garde et peut utiliser protege contre le vol de disque, pas contre une lecture interne ou une requisition. La question des cles decide de la protection reelle : c\'est elle qu\'on pose dans un questionnaire fournisseur.',
						),
					),
				),
			),
			'i18n'       => array(
				'en' => array(
					'title'   => 'The outage nobody owns',
					'excerpt' => 'A cloud data leak, four providers, one contract. Work out who was supposed to lock what.',
					'tasks'   => array(
						array(
							'title'     => 'Task 1: The boundary, not the sharing',
							'content'   => '<p>"Responsibility is shared" is a contract sentence, not an answer. The only useful question is: <strong>which checkbox belongs to whom?</strong></p><p>Three models, and what they change for you:</p><ul><li><strong>On-premises</strong> — you own everything, so you break everything. The power cut is your problem, and so is the kernel update.</li><li><strong>IaaS</strong> (infrastructure) — the provider keeps the machine and the network; <em>you</em> keep the operating system, the configuration and the data. This is where the unencrypted disk is most often forgotten.</li><li><strong>PaaS</strong> (platform) — the provider also keeps the system and updates; you keep the application code, the application credentials and the data.</li><li><strong>SaaS</strong> (software) — the provider keeps almost everything; what remains on your side is not technical but decisive: <strong>who is allowed in, and to which data</strong>.</li></ul><p>What always stays with you, whatever the model:</p><ul><li><strong>identities</strong> and their permissions (an over-privileged admin account is your fault, even in SaaS);</li><li><strong>the data you put</strong> in the service (classify before storing);</li><li><strong>the exposed configuration</strong> — a public storage bucket does not open itself;</li><li><strong>logging</strong> of the accesses you authorise.</li></ul><p><strong>Remember:</strong> when a leak happens, an investigator\'s first question is not "who is the provider?" but "<em>was that checkbox ours?</em>". A concrete exercise awaits in the terminal: it shows what a forgotten checkbox looks like.</p>',
							'questions' => array(),
						),
						array(
							'title'     => 'Task 2: Practice — four checkboxes, one model',
							'content'   => '<p>For each situation: whose checkbox is it?</p>',
							'questions' => array(
								array(
									'question'    => 'In an IaaS subscription, the virtual machine disk is not encrypted. Who was supposed to encrypt it?',
									'choices'     => array('The customer: in IaaS the provider supplies the disk, the customer decides on its encryption', 'The provider: it hosts the data, so protecting it falls naturally on its side sur toute la duree de l incident', 'Nobody: encryption at rest is a commercial option, not an obligation of any kind sur toute la duree de l incident', 'The auditor: it is their job to find it, and then to report it in the audit report sur toute la duree de l incident'),
									'correct'     => 0,
									'explanation' => 'In IaaS the provider guarantees the disk exists and is reachable; the content, and therefore its encryption, stays with the customer. This is the costliest cloud misunderstanding: "it is hosted by them" does not mean "protected by them".',
								),
								array(
									'question'    => 'In a SaaS service, one company administrator account has no second factor. Who is at fault?',
									'choices'     => array('The company: it manages its identities and their permissions, even when the application is hosted by the provider', 'The provider: it should force the second factor on all its customers, by contract au moment ou le probleme est constate par l equipe', 'Both equally: that is exactly what the shared responsibility model is all about au moment ou le probleme est constate par l equipe', 'Nobody: the second factor is not a technical requirement, only a good practice to follow au moment ou le probleme est constate par l equipe'),
									'correct'     => 0,
									'explanation' => 'The provider may offer the second factor, or even encourage it; the customer decides which accounts are administrators and how they authenticate. An over-powerful identity is a customer design error.',
								),
								array(
									'question'    => 'An object storage bucket is readable by the whole Internet. The company says: "it is the provider\'s fault, the default setting was permissive". How good is that argument?',
									'choices'     => array('It does not hold: the configuration of a service you use is the customer\'s responsibility', 'It holds: a default setting binds the provider, which chose it and documented it sur toute la duree de l incident', 'It partly holds: it is a hidden defect, which the customer could not reasonably see sur toute la duree de l incident', 'It holds if the contract does not mention storage, since silence means acceptance sur toute la duree de l incident'),
									'correct'     => 0,
									'explanation' => 'A permissive default is a known risk for the customer, who has the tools to check it. In security, "it was the default" is not a defence: configuration review is a customer task, and it is often written into the contract.',
								),
								array(
									'question'    => 'Which element stays with the customer in EVERY service model?',
									'choices'     => array('Classifying the data it hands to the service', 'Operating system updates on the virtual machines run by the customer itself', 'Datacentre power redundancy, which keeps the service available during an outage', 'TLS certificate renewal for the provider, and the monitoring that goes with it'),
									'correct'     => 0,
									'explanation' => 'Data classification cannot be delegated: the provider does not know what an item is worth to you. And without classification, no protection measure can be chosen correctly, in any model.',
								),
							),
						),
						array(
							'title'     => 'Task 3: Mission — the open bucket',
							'content'   => '<p>The simulated terminal is the company cloud console. You have a resource inventory and access logs.</p><p><strong>What you are looking for:</strong> the publicly reachable storage resource, the account that configured it, and the date. That resource is the direct cause of the leak.</p><p><strong>Available commands:</strong> <code>ls</code>, <code>cat</code>, <code>grep</code>, <code>cloud ls</code>, <code>cloud get &lt;resource&gt;</code>.</p><p>You cannot fix it: you establish and you name. That is audit work.</p>',
							'questions' => array(
								array(
									'question'    => 'What is the name of the publicly reachable storage bucket?',
									'hint'        => 'In the terminal: <code>cat /home/analyste/inventaire.txt</code>. The "public" column leaves no doubt.',
									'explanation' => 'The bucket has been open since 2 September, and the first unauthorised access is dated 14 September: twelve days of exposure window. The "cree_par" column names a company account, not the provider. This demonstrates the lesson: the "service configuration" checkbox belongs to the customer.',
								),
							),
						),
						array(
							'title'     => 'Task 4: Exam — architecture and responsibility',
							'content'   => '<p>Four exam-style questions: one answer is right, the others are common but wrong reasoning.</p>',
							'questions' => array(
								array(
									'question'    => 'A company moves its application to a PaaS provider and removes its application firewall. What has it just lost?',
									'choices'     => array('The visibility and filtering of requests that it had decided, if the provider exposes no equivalent it configures', 'Nothing: PaaS always includes an equivalent application firewall, on by default au moment ou le probleme est constate par l equipe', 'Only performance, the security of the application itself remains strictly identical au moment ou le probleme est constate par l equipe', 'Control of the physical network, which it had already lost when moving to the cloud au moment ou le probleme est constate par l equipe'),
									'correct'     => 0,
									'explanation' => 'PaaS covers the platform, not the business rules of your traffic: if you can no longer express "this route is for administrators", that decision has left your hands. Before removing a barrier, check the provider equivalent.',
								),
								array(
									'question'    => 'Which deployment model combines its own datacentre with a cloud service, under a shared identity system?',
									'choices'     => array(
										'Hybrid: its own datacentre plus a cloud service',
										'Community: shared by several organisations with common interests',
										'Public: open to anyone, operated by a provider',
										'Private: dedicated to one organisation only, never shared with anyone else',
									),
									'correct'     => 0,
									'explanation' => 'Hybrid: two distinct environments that cooperate. The sensitive point is not the infrastructure but the identity: two badly synchronised directories create active orphan accounts, and that is the path most hybrid incidents take.',
								),
								array(
									'question'    => 'A company wants to reduce its cloud attack surface. Which measure acts most directly on the risk of a leak through misconfigured storage?',
									'choices'     => array('Forbid public buckets by policy, and check compliance automatically', 'Train users against phishing, which remains the first cause of data leaks overall', 'Increase the size of connection logs, to reconstruct access more accurately later', 'Encrypt the provider backups, so that a stolen copy stays unreadable to anyone'),
									'correct'     => 0,
									'explanation' => 'A technical guard that prevents the dangerous state beats a retroactive check: the policy blocks the opening, the check detects it. Phishing training and log size do not change the bucket configuration.',
								),
								array(
									'question'    => 'A SaaS provider advertises "AES-256 encryption at rest". Which question remains open?',
									'choices'     => array('Who holds the keys, and can the provider read the data on its side?', 'Whether the algorithm really is AES, in its 256-bit version and in CBC mode', 'Whether encryption costs more in performance than storing the data in the clear', 'Whether backups are encrypted too, in the same place as the online data itself'),
									'correct'     => 0,
									'explanation' => 'Encrypting with a key the provider holds and can use protects against disk theft, not against internal reading or a legal order. The key question decides the real protection: it is the one to ask in a supplier questionnaire.',
								),
							),
						),
					),
				),
			),
		),

		/* ------------------------------------------------------------------
		 * 3.4 — Protection des donnees : classification, DLP, chiffrement
		 * ---------------------------------------------------------------- */
		array(
			'title'      => 'Le dossier qui fuit par la porte',
			'excerpt'    => 'Une donnee non classee ne peut pas etre protegee : personne ne sait quoi proteger. Quatre dossiers, un chiffrement, une fuite.',
			'content'    => 'La classification precede toute mesure : sans elle, chiffrer est un reflexe qui protege parfois la mauvaise chose. Cette room part d\'une fuite reelle et remonte jusqu\'au classement.',
			'difficulty' => 'moyen',
			'duration'   => 40,
			'xp_bonus'   => 60,
			'track'      => 'gouvernance',
			'source'     => array(
				'nom'         => 'NIST SP 800-53 Rev.5 — Security and Privacy Controls (famille SC, protection des donnees)',
				'url'         => 'https://csrc.nist.gov/pubs/sp/800/53/r5/upd1/final',
				'licence'     => 'Domaine public (publication du NIST, Etats-Unis)',
				'attribution' => 'NIST Special Publication 800-53 Revision 5, Security and Privacy Controls for Information Systems and Organizations',
			),
			'tasks'      => array(
				array(
					'type'    => 'lesson',
					'format'  => 'lecon',
					'title'   => 'Task 1 : Classer, puis proteger — jamais l\'inverse',
					'content' => '<p>Une entreprise qui chiffre tout protege autant une note de cantine qu\'un dossier medical. Ce n\'est pas de la securite, c\'est du bruit : les vraies donnees sensibles se noient dans le volume.</p>'
						. '<p><strong>Trois etats d\'une donnee</strong>, et une mesures par etat :</p>'
						. '<ul>'
						. '<li><strong>au repos</strong> — sur un disque, dans une sauvegarde, dans un seau. Mesure : chiffrement au repos, cle separee du disque.</li>'
						. '<li><strong>en transit</strong> — sur le reseau. Mesure : TLS, et verification du certificat cote client.</li>'
						. '<li><strong>en usage</strong> — dans la memoire pendant le traitement. Mesure : la plus difficile, et la plus souvent oubliee. Un fichier dechiffre dans <code>/tmp</code> est une donnee en usage exposee.</li>'
						. '</ul>'
						. '<p><strong>La classification</strong> repond a deux questions, pas une :</p>'
						. '<ul>'
						. '<li><strong>quel dommage si cela sort ?</strong> (public / interne / confidentiel / restreint) ;</li>'
						. '<li><strong>quelle obligation si cela sort ?</strong> (donnees personnelles : notification sous 72 h en Europe ; donnees de sante : regime renforce).</li>'
						. '</ul>'
						. '<p><strong>La DLP</strong> (data loss prevention) n\'est pas un logiciel miracle : c\'est un ensemble de regles qui reconnaissent une donnee a sa forme (un numero de securite sociale, une carte bancaire) et bloquent sa sortie vers un canal non autorise. Une DLP sans classification prealable produit deux echecs : trop de faux positifs, et les vrais dossiers passent parce qu\'ils ne ressemblent a rien.</p>'
						. '<p><strong>A retenir :</strong> chiffrer sans classer, c\'est fermer une porte sans savoir ce qu\'il y a derriere. Et un chiffrement dont la cle est rangee a cote du disque n\'est pas un chiffrement, c\'est une serrure avec la cle dans la serrure. Le terminal te fait faire l\'experience des deux.</p>',
					'questions' => array(),
				),
				array(
					'type'    => 'practice',
					'format'  => 'qcm',
					'title'   => 'Task 2 : Entrainement — classer avant de proteger',
					'content' => '<p>Quatre donnees, quatre decisions. Attention, deux pieges classiques s\'y cachent.</p>',
					'questions' => array(
						array(
							'question'    => 'Un fichier de sauvegarde contient des dossiers medicaux et il n\'est pas chiffre. Quelle est la mesure la plus urgente ?',
							'mode'        => 'choice',
							'choices'     => array('Chiffrer la sauvegarde avec une cle conservee hors du serveur de sauvegarde', 'Chiffrer la sauvegarde avec la cle rangee dans le meme dossier que l archive', 'Supprimer la sauvegarde : plus de donnee, plus de risque de fuite si le support est vole', 'Deplacer la sauvegarde sur un autre serveur non chiffre, plus difficile d acces'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Le chiffrement ne protege que si la cle est separee : un attaquant qui prend le serveur prend la sauvegarde et la cle. Supprimer la sauvegarde detruit la capacite de reprise : ce n\'est pas une mesure de securite mais une perte.',
						),
						array(
							'question'    => 'Une DLP signale 400 alertes par jour, dont 398 sont des faux positifs. Quelle est la cause la plus probable ?',
							'mode'        => 'choice',
							'choices'     => array('Les regles reposent sur des formes trop larges, sans classification prealable des donnees', 'La DLP est mal installee : il faudrait la reinsaller en suivant la procedure de l editeur, puis rejouer les tests de non-regression prevus', 'Les utilisateurs envoient trop de courriels : il faudrait limiter leur quota quotidien et sensibiliser les plus gros expediteurs du service commercial', 'Il faut augmenter le seuil de blocage a 100 % pour que plus rien ne passe sans une validation manuelle de l administrateur de la plateforme'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Une regle qui cherche « une suite de 16 chiffres » trouve aussi des references de commande. Sans classification, on ne sait pas quels documents sont sensibles : on devine par la forme, et on se trompe. Le resultat est une alerte ignoree — le pire etat d\'une DLP.',
						),
						array(
							'question'    => 'Un fichier chiffre est dechiffre dans /tmp pendant un traitement. Quel etat de la donnee est expose ?',
							'mode'        => 'choice',
							'choices'     => array('En usage : la donnee est en clair dans la memoire et sur le disque local le temps du traitement', 'Au repos : le fichier d origine reste chiffre, mais la copie temporaire deposee dans /tmp ne l est pas forcement selon l outil utilise', 'En transit : /tmp est un reseau, donc la donnee circule en clair entre les deux machines pendant toute la duree du traitement batch', 'Aucun : le chiffrement protege pendant tout le traitement, y compris dans les fichiers temporaires et dans la memoire du processus'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => '/tmp est sur un disque : la donnee y est au repos en clair, et lisible par les autres processus selon les droits. C\'est exactement le chemin par lequel un fichier « chiffre » fuit. Un traitement correct utilise un espace memoire, ou efface le fichier temporaire.',
						),
						array(
							'question'    => 'Quelle donnee exige, en Europe, une notification a l\'autorite en cas de violation, generalement sous 72 heures ?',
							'mode'        => 'choice',
							'choices'     => array('Une donnee a caractere personnel permettant d\'identifier une personne', 'Toute donnee detenue par l entreprise, sans aucune distinction de nature ni de sensibilité', 'Uniquement les donnees bancaires, parce que ce sont les seules a avoir une valeur directe', 'Uniquement les donnees de sante, parce qu elles relevent d une categorie renforcee'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Le RGPD vise les donnees a caractere personnel, pas « toute donnee ». Les donnees de sante sont une categorie particuliere, pas la seule : une adresse ou un identifiant suffit a declencher le regime. Confondre « sensible » et « personnelle » fait rater la notification.',
						),
					),
				),
				array(
					'type'    => 'mission',
					'format'  => 'terminal',
					'title'   => 'Task 3 : Mission — le chiffrement qui ne chiffre rien',
					'content' => '<p>Le terminal simule un poste d\'analyste. Un dossier a ete prepare pour transfert, et le service de conformite veut savoir s\'il est vraiment protege.</p>'
						. '<p><strong>Ce que tu fais :</strong> tu examines les fichiers, tu verifies si le contenu est lisible en clair, et tu cherches ou se trouve la cle.</p>'
						. '<p><strong>Commandes :</strong> <code>ls</code>, <code>cat</code>, <code>file</code>, <code>grep</code>, <code>base64 -d</code>, <code>openssl enc</code>.</p>'
						. '<p><strong>Verite a etablir :</strong> le fichier est-il chiffre, ou seulement encode ? Et la cle est-elle protegee ?</p>',
					'questions' => array(
						array(
							'question'    => 'Quel est le nom du fichier qui contient la cle de dechiffrement ?',
							'mode'        => 'text',
							'answers'     => array( '/^cle\.txt$/', '/cle\.txt/' ),
							'xp'          => 40,
							'hint'        => 'Dans le terminal : <code>ls /srv/export</code>, puis <code>cat /srv/export/note.txt</code>. La note dit ou est la cle.',
							'explanation' => 'Le fichier est bien chiffre (en-tete « Salted »), mais la cle est dans le meme dossier que le fichier chiffre. Un attaquant qui copie le dossier obtient les deux : la protection est nulle. C\'est le cas le plus frequent de « chiffrement » en entreprise, et le plus difficile a faire comprendre sans le montrer.',
						),
					),
					'terminal' => array(
						'intro'   => 'analyste@poste:~$ ',
						'unknown' => 'Cette commande ne donne rien ici.',
						'success' => 'Dossier examine. Tu peux repondre.',
						'steps'   => array(
							array(
								'match'  => array( 'ls /srv/export', '/^ls .*export/', '/^ls$/' ),
								'output' => "dossier.enc\ncle.txt\nnote.txt\n",
								'hint'   => 'Trois fichiers. Deux retiennent l\'attention : le dossier prepare et un fichier dont le nom dit ce qu\'il contient.',
							),
							array(
								'match'  => array( 'cat /srv/export/note.txt', '/cat .*note/' ),
								'output' => "dossier prepare pour le transfert du 12/09.\nle fichier dossier.enc est chiffre.\nla cle est dans le meme dossier, pour ne pas la perdre.\n",
								'hint'   => 'La note avoue le probleme sans le nommer : la cle est rangee avec le fichier qu\'elle protege.',
							),
							array(
								'match'  => array( 'file /srv/export/dossier.enc', '/file .*dossier/', '/^cat dossier.enc$/' ),
								'output' => "dossier.enc: data (OpenSSL salted, chiffre symetrique)\n",
								'hint'   => 'L\'en-tete « Salted » : ce n\'est pas un encodage base64, c\'est un chiffrement reel. Le probleme est ailleurs.',
							),
							array(
								'match'  => array( 'cat /srv/export/cle.txt', '/cat .*cle/' ),
								'output' => "cle de session : export-2026-09\n",
								'hint'   => 'Tu viens de lire la cle en clair, a cote du fichier : c\'est exactement ce qu\'un attaquant ferait.',
							),
						),
					),
				),
				array(
					'type'    => 'exam',
					'format'  => 'qcm',
					'title'   => 'Task 4 : Examen — protection des donnees',
					'content' => '<p>Quatre questions d\'examen, avec les raisonnements pieges habituels.</p>',
					'questions' => array(
						array(
							'question'    => 'Quel ordre est correct dans une demarche de protection des donnees ?',
							'mode'        => 'choice',
							'choices'     => array('Classer, puis choisir la mesure selon la classe, puis verifier qu\'elle tient', 'Chiffrer tout, puis classer ce qui reste apres le chiffrement dans un second temps', 'Acheter une DLP, puis classer les donnees selon les alertes qu elle remonte au fil de l eau', 'Former les utilisateurs, puis classer les donnees selon leurs declarations annuelles'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'La classification est ce qui permet de choisir : sans elle, toutes les mesures se valent et le budget part au hasard. Chiffrer avant de classer revient a proteger uniformement, donc a mal proteger les cas extremes.',
						),
						array(
							'question'    => 'Une entreprise deploie une DLP qui bloque les courriels sortants contenant un numero de carte bancaire. Un employe envoie le meme numero dans une image. Que se passe-t-il ?',
							'mode'        => 'choice',
							'choices'     => array('La DLP ne voit rien : la regle lit du texte, pas le contenu d\'une image', 'La DLP bloque : toute DLP analyse les images par defaut et compare leur empreinte', 'La DLP chiffre le courriel automatiquement des qu elle detecte une piece jointe', 'La DLP previent l expediteur mais envoie le courriel, c est le comportement normal'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Une DLP par motif textuel est aveugle aux images, aux archives compressees et aux formats binaires, sauf analyse specifique. C\'est une limite de conception a connaitre : elle explique pourquoi la DLP se combine toujours avec d\'autres mesures, et pourquoi elle ne remplace jamais la classification.',
						),
						array(
							'question'    => 'Quelle affirmation sur le chiffrement au repos est exacte ?',
							'mode'        => 'choice',
							'choices'     => array('Il protege les donnees si le support est vole, et ne protege pas l\'acces par un compte autorise', 'Il protege contre tous les acces, y compris ceux des administrateurs qui detiennent les cles de dechiffrement du volume', 'Il remplace la classification des donnees, puisqu il en protege le contenu directement et sans avoir besoin de la classer', 'Il rend inutile la journalisation des acces, le chiffrement faisant office de preuve suffisante en cas de controle'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Le chiffrement au repos repond au vol de support et a l\'acces hors ligne. Un compte autorise lit la donnee dechiffree : c\'est une autre couche, le controle d\'acces, qui la protege. Croire le contraire est l\'erreur qui fait rater l\'examen et, en entreprise, laisser les droits trop larges.',
						),
						array(
							'question'    => 'Un fournisseur propose un service de « tokenisation » des numeros de carte. Quel est l\'avantage principal par rapport au chiffrement ?',
							'mode'        => 'choice',
							'choices'     => array('Le systeme qui manipule le jeton n\'a jamais la vraie valeur, donc il sort du perimetre de protection de la donnee', 'Le jeton est plus court, donc plus rapide a traiter par les applications du service client qui l affichent dans leur interface quotidienne', 'La tokenisation est un chiffrement avec une autre cle, applique au meme emplacement a chaque fois, et donc reversible par le detenteur de la cle', 'Le jeton est reversible sans cle, ce qui simplifie les traitements et evite de gerer des secrets supplementaires dans les applications du groupe'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Avec un jeton, l\'application ne detient plus la donnee sensible : la reduction de perimetre (scope reduction) est l\'interet reel, pas la performance. Un jeton reversible sans cle ne serait pas un jeton mais un encodage — et ne reduirait rien.',
						),
					),
				),
			),
			'i18n'       => array(
				'en' => array(
					'title'   => 'The folder that leaks through the door',
					'excerpt' => 'Unclassified data cannot be protected: nobody knows what to protect. Four folders, one encryption, one leak.',
					'tasks'   => array(
						array(
							'title'     => 'Task 1: Classify, then protect — never the reverse',
							'content'   => '<p>A company that encrypts everything protects a canteen note as much as a medical record. That is not security, it is noise: the truly sensitive data drowns in the volume.</p><p><strong>Three states of data</strong>, and one measure per state:</p><ul><li><strong>at rest</strong> — on a disk, in a backup, in a bucket. Measure: encryption at rest, key separate from the disk.</li><li><strong>in transit</strong> — on the network. Measure: TLS, and certificate verification on the client side.</li><li><strong>in use</strong> — in memory during processing. Measure: the hardest, and the most often forgotten. A file decrypted in <code>/tmp</code> is exposed data in use.</li></ul><p><strong>Classification</strong> answers two questions, not one:</p><ul><li><strong>what damage if it leaves?</strong> (public / internal / confidential / restricted);</li><li><strong>what obligation if it leaves?</strong> (personal data: notification within 72 h in Europe; health data: a stricter regime).</li></ul><p><strong>DLP</strong> (data loss prevention) is not a miracle piece of software: it is a set of rules that recognise data by its shape (a social security number, a bank card) and block its exit to an unauthorised channel. DLP without prior classification produces two failures: too many false positives, and the real folders slip through because they look like nothing.</p><p><strong>Remember:</strong> encrypting without classifying is closing a door without knowing what is behind it. And encryption whose key sits next to the disk is not encryption, it is a lock with the key left in it. The terminal makes you experience both.</p>',
							'questions' => array(),
						),
						array(
							'title'     => 'Task 2: Practice — classify before protecting',
							'content'   => '<p>Four data items, four decisions. Two classic traps are in there.</p>',
							'questions' => array(
								array(
									'question'    => 'A backup file contains medical records and is not encrypted. What is the most urgent measure?',
									'choices'     => array('Encrypt the backup with a key kept outside the backup server', 'Encrypt the backup with the key stored in the same folder as the archive', 'Delete the backup: no data, no risk of a leak if the medium gets stolen at all', 'Move the backup to another unencrypted server, which is harder to reach by chance'),
									'correct'     => 0,
									'explanation' => 'Encryption only protects if the key is separate: an attacker who takes the server takes the backup and the key. Deleting the backup destroys recovery capability: that is not a security measure but a loss.',
								),
								array(
									'question'    => 'A DLP raises 400 alerts a day, 398 of which are false positives. What is the most likely cause?',
									'choices'     => array('Rules rely on overly broad patterns, with no prior classification of the data', 'The DLP is badly installed and should be reinstalled following the vendor procedure', 'Users send too many emails, their daily quota should be reduced by the IT team', 'The blocking threshold must be raised to 100% so that nothing gets through unchecked'),
									'correct'     => 0,
									'explanation' => 'A rule looking for "a run of 16 digits" also finds order references. Without classification you do not know which documents are sensitive: you guess by shape, and you guess wrong. The result is an ignored alert — the worst state for a DLP.',
								),
								array(
									'question'    => 'An encrypted file is decrypted in /tmp during processing. Which data state is exposed?',
									'choices'     => array('In use: the data is in the clear in memory and on the local disk for the duration of processing', 'At rest: the original file stays encrypted, but the temporary copy dropped in /tmp is not always so, depending on the tool used', 'In transit: /tmp is a network, so the data travels in the clear between the two machines for the whole duration of the batch job', 'None: encryption protects throughout processing, including in the temporary files and in the memory of the running process'),
									'correct'     => 0,
									'explanation' => '/tmp is on a disk: the data there is at rest in the clear, and readable by other processes depending on permissions. This is exactly the path by which an "encrypted" file leaks. Correct processing uses a memory space, or wipes the temporary file.',
								),
								array(
									'question'    => 'Which data requires, in Europe, notification to the authority in the event of a breach, generally within 72 hours?',
									'choices'     => array('Personal data that can identify a person', 'Any data held by the company, with no distinction of nature or sensitivity', 'Only banking data, because it is the only kind with a resale value', 'Only health data, because it falls under a reinforced category'),
									'correct'     => 0,
									'explanation' => 'GDPR targets personal data, not "all data". Health data is a special category, not the only one: an address or an identifier is enough to trigger the regime. Confusing "sensitive" with "personal" makes you miss the notification.',
								),
							),
						),
						array(
							'title'     => 'Task 3: Mission — the encryption that encrypts nothing',
							'content'   => '<p>The terminal simulates an analyst workstation. A folder has been prepared for transfer, and compliance wants to know whether it is really protected.</p><p><strong>What you do:</strong> examine the files, check whether the content is readable in the clear, and find where the key is.</p><p><strong>Commands:</strong> <code>ls</code>, <code>cat</code>, <code>file</code>, <code>grep</code>, <code>base64 -d</code>, <code>openssl enc</code>.</p><p><strong>Truth to establish:</strong> is the file encrypted, or merely encoded? And is the key protected?</p>',
							'questions' => array(
								array(
									'question'    => 'What is the name of the file containing the decryption key?',
									'hint'        => 'In the terminal: <code>ls /srv/export</code>, then <code>cat /srv/export/note.txt</code>. The note says where the key is.',
									'explanation' => 'The file is genuinely encrypted (the "Salted" header), but the key sits in the same folder as the encrypted file. An attacker who copies the folder gets both: the protection is nil. This is the most common form of "encryption" in companies, and the hardest to make understood without showing it.',
								),
							),
						),
						array(
							'title'     => 'Task 4: Exam — data protection',
							'content'   => '<p>Four exam questions, with the usual trap reasoning.</p>',
							'questions' => array(
								array(
									'question'    => 'Which order is correct in a data protection approach?',
									'choices'     => array('Classify, then choose the measure for the class, then verify it holds', 'Encrypt everything, then classify whatever is left after the encryption step', 'Buy a DLP, then classify the data from the alerts it raises as it runs day after day', 'Train users, then classify the data from the statements they make once a year'),
									'correct'     => 0,
									'explanation' => 'Classification is what allows choice: without it, all measures are equivalent and the budget goes at random. Encrypting before classifying means protecting uniformly, therefore protecting the extreme cases badly.',
								),
								array(
									'question'    => 'A company deploys a DLP that blocks outgoing emails containing a bank card number. An employee sends the same number inside an image. What happens?',
									'choices'     => array('The DLP sees nothing: the rule reads text, not the content of an image', 'The DLP blocks it: every DLP analyses images by default and compares their signature', 'The DLP encrypts the email automatically as soon as it detects an attached file', 'The DLP warns the sender but sends the email, which is the documented normal behaviour'),
									'correct'     => 0,
									'explanation' => 'A text-pattern DLP is blind to images, compressed archives and binary formats without specific analysis. This is a design limit worth knowing: it explains why DLP is always combined with other measures, and why it never replaces classification.',
								),
								array(
									'question'    => 'Which statement about encryption at rest is accurate?',
									'choices'     => array('It protects the data if the medium is stolen, and does not protect against access by an authorised account', 'It protects against all access, including that of administrators who hold the volume encryption keys in their vault', 'It replaces data classification, since it protects the content of the data directly without needing to classify it first', 'It makes access logging unnecessary, since encryption itself now serves as sufficient evidence in a compliance audit'),
									'correct'     => 0,
									'explanation' => 'Encryption at rest answers media theft and offline access. An authorised account reads the decrypted data: a different layer, access control, protects it. Believing otherwise is the mistake that fails the exam and, in a company, leaves permissions too wide.',
								),
								array(
									'question'    => 'A provider offers a card number "tokenisation" service. What is the main advantage over encryption?',
									'choices'     => array('The system handling the token never holds the real value, so it leaves the data protection scope', 'The token is shorter, therefore faster to process by the applications of the support team that display it all day long', 'Tokenisation is encryption with another key, applied to the same field every time, and therefore reversible by the key holder', 'The token is reversible without a key, which simplifies processing and avoids managing extra secrets across the group'),
									'correct'     => 0,
									'explanation' => 'With a token, the application no longer holds the sensitive data: scope reduction is the real benefit, not performance. A token reversible without a key would not be a token but an encoding — and would reduce nothing.',
								),
							),
						),
					),
				),
			),
		),

		/* ------------------------------------------------------------------
		 * 3.6 — IoT, embarque, systeme industriel
		 * ---------------------------------------------------------------- */
		array(
			'title'      => 'Le capteur qui n\'a jamais parle',
			'excerpt'    => 'Un capteur de temperature sur le reseau d\'atelier. Il ne parle qu\'une fois par jour, et pas a qui tu crois. Trouve-le.',
			'content'    => 'Un objet connecte n\'est pas un petit ordinateur : il n\'a ni antivirus, ni mise a jour, ni redemarrage possible. Cette room t\'apprend a le trouver sur le reseau, et a voir ce qu\'il expose.',
			'difficulty' => 'difficile',
			'duration'   => 40,
			'xp_bonus'   => 70,
			'track'      => 'gouvernance',
			'source'     => array(
				'nom'         => 'NISTIR 8228 — Considerations for Managing Internet of Things Cybersecurity and Privacy Risks',
				'url'         => 'https://csrc.nist.gov/pubs/ir/8228/final',
				'licence'     => 'Domaine public (publication du NIST, Etats-Unis)',
				'attribution' => 'NIST Internal Report 8228, Considerations for Managing Internet of Things (IoT) Cybersecurity and Privacy Risks',
			),
			'tasks'      => array(
				array(
					'type'    => 'lesson',
					'format'  => 'lecon',
					'title'   => 'Task 1 : Pourquoi un objet connecte change les regles',
					'content' => '<p>Un serveur se met a jour, se sauvegarde, se redemarre. Un capteur industriel, souvent non : il a un logiciel grave en usine, un mot de passe pose en usine, et personne ne peut le modifier sans arreter la production.</p>'
						. '<p>Trois consequences, qui sont les trois axes de l\'examen :</p>'
						. '<ul>'
						. '<li><strong>inventaire impossible</strong> — personne ne sait combien d\'objets sont sur le reseau, ni lesquels. On ne protege pas ce qu\'on ignore.</li>'
						. '<li><strong>identifiants d\'usine</strong> — le compte et le mot de passe sont communs a tous les exemplaires du modele. Un mot de passe trouve sur un objet ouvre le suivant.</li>'
						. '<li><strong>cycle de vie long</strong> — l\'objet vit quinze ans, le fournisseur le met a jour trois ans. La derniere decennie se passe sans correctif.</li>'
						. '</ul>'
						. '<p><strong>Ce qu\'on fait a la place d\'un antivirus</strong> :</p>'
						. '<ul>'
						. '<li><strong>segmenter</strong> — un reseau d\'atelier ne parle pas directement a Internet, ni au reseau de bureaux ; le flux utile passe par une passerelle controlee.</li>'
						. '<li><strong>placer un point de sortie unique</strong> — la passerelle enregistre qui parle a qui. C\'est la source d\'information la plus utile en cas d\'incident.</li>'
						. '<li><strong>changer les secrets par defaut</strong>, et les tenir dans un inventaire ; un objet oublie avec les identifiants d\'usine est une porte ouverte permanente.</li>'
						. '<li><strong>surveiller le comportement</strong> : un capteur qui se connecte a une adresse externe a 3 h du matin est un signal, meme sans antivirus pour le dire.</li>'
						. '</ul>'
						. '<p><strong>A retenir :</strong> sur un objet connecte, on ne cherche pas la vulnerabilite logicielle, on cherche le <em>flux</em> : qui parle a qui, avec quel identifiant. Le terminal te donne un journal de passerelle : c\'est exactement cette lecture.</p>',
					'questions' => array(),
				),
				array(
					'type'    => 'practice',
					'format'  => 'qcm',
					'title'   => 'Task 2 : Entrainement — segmenter avant de corriger',
					'content' => '<p>Quatre situations d\'atelier. La bonne reponse est souvent celle qui ne demande pas d\'installer quoi que ce soit.</p>',
					'questions' => array(
						array(
							'question'    => 'Vingt capteurs d\'atelier utilisent le meme compte « admin » avec le meme mot de passe d\'usine. Quelle est la mesure la plus efficace ?',
							'mode'        => 'choice',
							'choices'     => array('Changer les secrets par defaut sur chaque objet et les gerer dans un inventaire', 'Ajouter un antivirus sur la passerelle, qui filtrera aussi les flux montants de l atelier avant leur sortie du site', 'Renommer le compte « admin » en « operateur » pour qu il soit moins evident a deviner par un attaquant de passage', 'Informer les operateurs du risque, en comptant sur leur vigilance quotidienne pour compenser l absence de controle'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Le mot de passe commun fait que la compromission d\'un objet compromet les vingt. Renommer le compte ne change pas le secret : c\'est un changement d\'apparence, pas de protection. La gestion des secrets est la mesure directe.',
						),
						array(
							'question'    => 'Un objet connecte ne peut pas recevoir de mise a jour. Quelle mesure compense le mieux l\'absence de correctifs ?',
							'mode'        => 'choice',
							'choices'     => array('Le confiner dans un reseau segmente avec un filtrage strict et une surveillance du flux', 'Le remplacer par un modele plus recent, sans autre mesure : le materiel neuf est toujours plus sur que l ancien', 'Le renommer pour l identifier dans l inventaire des objets connectes, ce qui suffit a le suivre dans le temps', 'Le laisser tel quel : sans mise a jour, il ne change pas, donc il est stable, previsible et sans surprise'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Sans correctif possible, on reduit ce que l\'objet peut atteindre et on surveille ce qu\'il fait. Le remplacer est une bonne reponse a long terme, mais pas une compensation immediate, et un parc d\'objets ne se remplace pas en une nuit.',
						),
						array(
							'question'    => 'Une passerelle d\'atelier voit un capteur de temperature se connecter a une adresse externe inconnue. Quel est le premier geste ?',
							'mode'        => 'choice',
							'choices'     => array('Bloquer le flux vers cette adresse, puis analyser le journal pour savoir quand et combien de donnees sont parties', 'Eteindre l ensemble de l atelier immediatement, pour couper court a toute exfiltration en cours sur la chaine de bout en bout', 'Ignorer : un capteur ne peut pas exfiltrer, il n a ni disque ni systeme d exploitation pour stocker quoi que ce soit en realite', 'Remplacer le capteur sans lire le journal, pour repartir sur une base saine, connue et documentee dans l inventaire en realite'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Bloquer d\'abord coupe l\'exfiltration en cours ; le journal ensuite dit l\'etendue, qui decide de la suite (notification, enquete). Arreter la production en premier prive l\'entreprise de la preuve que le journal contient.',
						),
						array(
							'question'    => 'Quelle caracteristique distingue le plus un systeme industriel (ICS/SCADA) d\'un systeme d\'information classique ?',
							'mode'        => 'choice',
							'choices'     => array('La priorite a la disponibilite physique : arreter un automate peut arreter une machine et blesser quelqu\'un', 'Le systeme industriel n a pas de reseau : les automates sont cables en serie entre eux, sans passer par Ethernet en realite', 'Les automates utilisent une autre cryptographie, que les outils classiques ne savent pas lire ni dechiffrer dans les faits', 'Les automates ne sont jamais vulnerables : ils n executent que du code ecrit et signe par le constructeur dans les faits'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'La triade de securite change d\'ordre : en atelier, la disponibilite passe avant la confidentialite, parce qu\'un arret non planifie peut etre dangereux. C\'est pourquoi une reponse « on coupe tout » n\'y est presque jamais acceptable.',
						),
					),
				),
				array(
					'type'    => 'mission',
					'format'  => 'terminal',
					'title'   => 'Task 3 : Mission — le capteur qui parle trop',
					'content' => '<p>Le terminal simule la passerelle de l\'atelier. Tu as son journal de flux et sa liste d\'appareils.</p>'
						. '<p><strong>Ce que tu cherches :</strong> l\'appareil qui communique vers une adresse externe non autorisee, et l\'identifiant qu\'il utilise. C\'est la preuve de la compromission.</p>'
						. '<p><strong>Commandes :</strong> <code>ls</code>, <code>cat</code>, <code>grep</code>, <code>gw flux</code>, <code>gw appareils</code>.</p>'
						. '<p><strong>Ne coupe rien :</strong> tu constates. La reaction vient apres, et elle a un ordre.</p>',
					'questions' => array(
						array(
							'question'    => 'Quel appareil se connecte a l\'adresse externe 203.0.113.90 ? (donne son identifiant complet)',
							'mode'        => 'text',
							'answers'     => array( '/^capteur-07$/', '/capteur-07/' ),
							'xp'          => 40,
							'hint'        => 'Dans le terminal : <code>cat /srv/atelier/flux.log</code>. Compare chaque destination a la liste des destinations autorisees, puis retrouve l\'identifiant dans <code>appareils.txt</code>.',
							'explanation' => 'Le capteur emet 43 Mo vers une adresse externe en deux connexions, a 3 h du matin, alors que sa destination habituelle est le collecteur interne 10.20.1.20. Un capteur de temperature n\'a aucune raison d\'emettre 21 Mo par connexion : c\'est le signal, et il ne demande aucun antivirus pour etre vu. Sur l\'IoT, le flux est la sonde.',
						),
					),
					'terminal' => array(
						'intro'   => 'operateur@passerelle-atelier:~$ ',
						'unknown' => 'Cette commande ne donne rien ici.',
						'success' => 'Flux examines. Tu peux repondre.',
						'steps'   => array(
							array(
								'match'  => array( 'ls /srv/atelier', '/^ls .*atelier/', '/^ls$/' ),
								'output' => "appareils.txt\nflux.log\ndestinations-autorisees.txt\n",
								'hint'   => 'Trois fichiers : le parc, le journal de flux, et la liste de ce qui est autorise.',
							),
							array(
								'match'  => array( 'cat /srv/atelier/destinations-autorisees.txt', '/cat .*destinations/' ),
								'output' => "# Destinations autorisees depuis le reseau d'atelier (validees le 01/09)\n10.20.1.20    collecteur temperature (interne)\n10.20.1.30    superviseur (interne)\n198.51.100.7  mises a jour constructeur (sortie filtree)\n",
								'hint'   => 'Toute destination absente de cette liste sort du perimetre autorise.',
							),
							array(
								'match'  => array( 'cat /srv/atelier/flux.log', '/cat .*flux/' ),
								'output' => "2026-09-14 02:58 capteur-01 -> 10.20.1.20:5432  autorise\n2026-09-14 03:00 capteur-02 -> 10.20.1.20:5432  autorise\n2026-09-14 03:01 capteur-07 -> 203.0.113.90:443   NON AUTORISE 12 Mo\n2026-09-14 03:02 capteur-07 -> 203.0.113.90:443   NON AUTORISE 31 Mo\n2026-09-14 03:04 vanne-03  -> 10.20.1.20:5432  autorise\n",
								'hint'   => 'Une seule ligne porte « NON AUTORISE », deux fois, a une heure ou un capteur ne devrait rien envoyer.',
							),
							array(
								'match'  => array( 'cat /srv/atelier/appareils.txt', '/cat .*appareils/' ),
								'output' => "capteur-01  temperature  10.20.3.11  admin\ncapteur-02  temperature  10.20.3.12  admin\ncapteur-07  temperature  10.20.3.17  admin\nvanne-03    actionneur   10.20.3.31  admin\npasserelle  passerelle   10.20.3.1   -\n",
								'hint'   => 'La derniere colonne montre l\'identifiant partage par tout le parc.',
							),
						),
					),
				),
				array(
					'type'    => 'exam',
					'format'  => 'qcm',
					'title'   => 'Task 4 : Examen — IoT, embarque, industriel',
					'content' => '<p>Quatre questions d\'examen sur les objets connectes et les systemes industriels.</p>',
					'questions' => array(
						array(
							'question'    => 'Quelle mesure reduit le plus directement le risque qu\'un objet connecte compromis atteigne le reseau de bureaux ?',
							'mode'        => 'choice',
							'choices'     => array('La segmentation, avec un filtrage des flux entre le reseau d\'atelier et celui des bureaux', 'Un mot de passe plus long sur l objet : douze caracteres au moins, renouveles chaque annee par l equipementier', 'Une mise a jour du firmware de l objet, des qu un correctif est publie par le constructeur sur son portail', 'Une sauvegarde quotidienne de l objet, restauree chaque semaine pour verifier qu elle tient vraiment la route'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'La segmentation limite la portee d\'une compromission, meme quand l\'objet reste vulnerable. Un mot de passe plus long protege l\'acces a l\'objet, pas le reseau d\'a cote. C\'est la difference entre proteger une porte et cloisonner un batiment.',
						),
						array(
							'question'    => 'Un parc d\'objets connectes n\'a pas d\'inventaire. Quelle est la consequence la plus grave ?',
							'mode'        => 'choice',
							'choices'     => array('On ne peut ni les mettre a jour, ni les surveiller, ni savoir lesquels sont concernes par une faille annoncee', 'On ne peut pas les facturer : ils ne rentrent dans aucun budget et n ont pas de proprietaire identifiable dans les faits', 'On ne connait pas leur consommation electrique, donc on ne sait pas lesquels coutent le plus au site sur toute la duree de l incident', 'On ne peut pas les redemarrer a distance, il faut se deplacer a chaque incident, parfois la nuit sur toute la duree de l incident'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Sans inventaire, une faille annoncee ne se transforme en action : on ne sait pas si l\'on est concerne. C\'est le premier des trois axes du NISTIR 8228, et la raison pour laquelle il commence par la decouverte du parc.',
						),
						array(
							'question'    => 'Pourquoi une reponse « on deconnecte tout l\'atelier du reseau » est-elle souvent refusee en milieu industriel ?',
							'mode'        => 'choice',
							'choices'     => array('Parce qu\'un arret non planifie d\'un procede peut creer un danger physique et un cout majeur : la disponibilite prime', 'Parce que les automates ne se deconnectent pas techniquement : le reseau est cable en dur dans les armoires sur toute la duree de l incident', 'Parce que la deconnexion ne protege rien : l automate continue a tourner sur lui-meme, sans consequence sur toute la duree de l incident', 'Parce que le reseau d atelier n a pas de risque : il est isole par construction depuis l origine du site sur toute la duree de l incident'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'En ICS, la disponibilite passe avant la confidentialite : couper peut arreter une machine, une chaine du froid ou un circuit de securite. La reponse correcte isole le flux en cause (une adresse, un port) sans arreter la production.',
						),
						array(
							'question'    => 'Quel indice, dans un journal de flux, est le plus revelateur d\'un objet connecte compromis ?',
							'mode'        => 'choice',
							'choices'     => array('Un volume ou une destination qui ne correspond pas a son role, surtout a une heure inhabituelle', 'Une adresse IP qui change tous les jours, signe d un bail DHCP mal configure sur le segment de l atelier en realite', 'Un nombre eleve de paquets de petite taille, typique d une numerisation en cours sur le reseau local en realite', 'Une connexion chiffree vers son serveur de collecte habituel, plusieurs fois par jour a heure fixe en realite'),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Un capteur de temperature qui envoie 43 Mo vers une adresse inconnue a 3 h du matin sort de son role : c\'est le signal. Le trafic chiffre vers le serveur habituel est normal ; le volume et la destination sont ce qu\'on compare au role attendu.',
						),
					),
				),
			),
			'i18n'       => array(
				'en' => array(
					'title'   => 'The sensor that never spoke',
					'excerpt' => 'A temperature sensor on the shop-floor network. It speaks once a day, and not to whom you think. Find it.',
					'tasks'   => array(
						array(
							'title'     => 'Task 1: Why a connected object changes the rules',
							'content'   => '<p>A server updates, backs up, restarts. An industrial sensor often does not: it has firmware burned in the factory, a password set in the factory, and nobody can change it without stopping production.</p><p>Three consequences, which are the three exam axes:</p><ul><li><strong>impossible inventory</strong> — nobody knows how many objects are on the network, or which ones. You cannot protect what you ignore.</li><li><strong>factory credentials</strong> — the account and password are common to every unit of the model. A password found on one object opens the next.</li><li><strong>long lifecycle</strong> — the object lives fifteen years, the vendor updates it for three. The last decade runs without patches.</li></ul><p><strong>What you do instead of an antivirus</strong>:</p><ul><li><strong>segment</strong> — a shop-floor network does not talk directly to the Internet, nor to the office network; useful traffic goes through a controlled gateway.</li><li><strong>place a single exit point</strong> — the gateway records who talks to whom. It is the most useful information source during an incident.</li><li><strong>change default secrets</strong>, and keep them in an inventory; a forgotten object with factory credentials is a permanently open door.</li><li><strong>watch behaviour</strong>: a sensor connecting to an external address at 3 a.m. is a signal, even without an antivirus to say so.</li></ul><p><strong>Remember:</strong> on a connected object you do not look for the software vulnerability, you look at the <em>flow</em>: who talks to whom, with which credential. The terminal gives you a gateway log: that is exactly this reading.</p>',
							'questions' => array(),
						),
						array(
							'title'     => 'Task 2: Practice — segment before patching',
							'content'   => '<p>Four shop-floor situations. The right answer is often the one that installs nothing.</p>',
							'questions' => array(
								array(
									'question'    => 'Twenty shop-floor sensors share the same "admin" account with the same factory password. Which is the most effective measure?',
									'choices'     => array('Change default secrets on each object and manage them in an inventory', 'Add an antivirus on the gateway, which will also filter the outbound traffic of the shop floor before it leaves', 'Rename the "admin" account to "operator" so that it is less obvious to guess for an attacker passing by', 'Inform operators of the risk, relying on their daily vigilance to make up for the lack of any control'),
									'correct'     => 0,
									'explanation' => 'A shared password means compromising one object compromises all twenty. Renaming the account does not change the secret: it is a change of appearance, not of protection. Secret management is the direct measure.',
								),
								array(
									'question'    => 'A connected object cannot receive updates. Which measure best compensates for the lack of patches?',
									'choices'     => array('Confine it in a segmented network with strict filtering and flow monitoring', 'Replace it with a newer model, with no other measure: new hardware is always safer than the old one', 'Rename it so it can be identified in the inventory of connected objects, which is enough to track it over time', 'Leave it as is: with no updates it does not change, so it is stable, predictable and without surprise'),
									'correct'     => 0,
									'explanation' => 'With no patch possible, you reduce what the object can reach and monitor what it does. Replacing it is a good long-term answer but not an immediate compensation, and a fleet of objects is not replaced overnight.',
								),
								array(
									'question'    => 'A shop-floor gateway sees a temperature sensor connecting to an unknown external address. What is the first action?',
									'choices'     => array('Block the flow to that address, then analyse the log to know when and how much data left', 'Shut down the whole shop floor immediately, to put a stop to any exfiltration running on the line right now', 'Ignore it: a sensor cannot exfiltrate, it has neither a disk nor an operating system to store anything at all', 'Replace the sensor without reading the log, to restart from a clean, known and documented baseline in the inventory'),
									'correct'     => 0,
									'explanation' => 'Blocking first stops the ongoing exfiltration; the log then tells the extent, which decides what follows (notification, investigation). Stopping production first deprives the company of the evidence the log holds.',
								),
								array(
									'question'    => 'Which characteristic most distinguishes an industrial system (ICS/SCADA) from a classic information system?',
									'choices'     => array('Priority given to physical availability: stopping a controller can stop a machine and injure someone', 'The industrial system has no network: controllers are wired in series to each other, without going through Ethernet', 'Controllers use different cryptography, which the usual tools cannot read nor decrypt on the wire at all en realite', 'Controllers are never vulnerable: they only run code written and signed by the manufacturer itself dans les faits'),
									'correct'     => 0,
									'explanation' => 'The security triad changes order: on the shop floor, availability comes before confidentiality, because an unplanned stop can be dangerous. That is why a "we cut everything" response is almost never acceptable there.',
								),
							),
						),
						array(
							'title'     => 'Task 3: Mission — the sensor that talks too much',
							'content'   => '<p>The terminal simulates the shop-floor gateway. You have its flow log and its device list.</p><p><strong>What you are looking for:</strong> the device communicating to an unauthorised external address, and the credential it uses. That is the proof of compromise.</p><p><strong>Commands:</strong> <code>ls</code>, <code>cat</code>, <code>grep</code>, <code>gw flux</code>, <code>gw appareils</code>.</p><p><strong>Cut nothing:</strong> you establish. The reaction comes later, and it has an order.</p>',
							'questions' => array(
								array(
									'question'    => 'Which device connects to the external address 203.0.113.90? (give its identifier)',
									'hint'        => 'In the terminal: <code>cat /srv/atelier/flux.log</code>. Compare each destination with the allowed list, then find the identifier in <code>appareils.txt</code>.',
									'explanation' => 'The sensor sends 43 MB to an external address in two connections, at 3 a.m., while its usual destination is the internal collector 10.20.1.20. A temperature sensor has no reason to send 21 MB per connection: that is the signal, and it needs no antivirus to be seen. On IoT, the flow is the probe.',
								),
							),
						),
						array(
							'title'     => 'Task 4: Exam — IoT, embedded, industrial',
							'content'   => '<p>Four exam questions on connected objects and industrial systems.</p>',
							'questions' => array(
								array(
									'question'    => 'Which measure most directly reduces the risk that a compromised connected object reaches the office network?',
									'choices'     => array('Segmentation, with flow filtering between the shop-floor network and the office network', 'A longer password on the object: at least twelve characters, renewed once a year by the equipment supplier', 'A firmware update on the object, as soon as a patch is published by the maker on its public portal', 'A daily backup of the object, restored once a week to check that it really holds when needed en realite'),
									'correct'     => 0,
									'explanation' => 'Segmentation limits the scope of a compromise even while the object stays vulnerable. A longer password protects access to the object, not the network next door. It is the difference between protecting a door and partitioning a building.',
								),
								array(
									'question'    => 'A fleet of connected objects has no inventory. What is the most serious consequence?',
									'choices'     => array('You can neither update them, nor monitor them, nor know which are affected by an announced flaw', 'You cannot bill for them: they fit in no budget and have no identifiable owner in the organisation en realite', 'You do not know their power consumption, so you cannot tell which ones cost the site the most dans les faits', 'You cannot reboot them remotely, so a trip on site is needed for every incident, sometimes at night en realite'),
									'correct'     => 0,
									'explanation' => 'Without an inventory, an announced flaw does not become action: you do not know whether you are affected. It is the first of the three NISTIR 8228 axes, and the reason it starts with fleet discovery.',
								),
								array(
									'question'    => 'Why is a "we disconnect the whole shop floor from the network" response often refused in an industrial setting?',
									'choices'     => array('Because an unplanned stop of a process can create physical danger and major cost: availability comes first', 'Because controllers cannot be disconnected technically: the network is hard-wired in the cabinets sur toute la duree de l incident', 'Because disconnection protects nothing: the controller keeps running on its own, with no consequence sur toute la duree de l incident', 'Because the shop-floor network carries no risk: it is isolated by construction since the plant was built dans les faits'),
									'correct'     => 0,
									'explanation' => 'In ICS, availability comes before confidentiality: cutting can stop a machine, a cold chain or a safety circuit. The correct answer isolates the flow at fault (one address, one port) without stopping production.',
								),
								array(
									'question'    => 'Which clue in a flow log most reveals a compromised connected object?',
									'choices'     => array('A volume or destination inconsistent with its role, especially at an unusual hour', 'An IP address that changes every day, a sign of a misconfigured DHCP lease on the shop-floor segment', 'A high number of small packets, typical of a scan currently running on the local network en realite', 'An encrypted connection to its usual collection server, several times a day at a fixed hour'),
									'correct'     => 0,
									'explanation' => 'A temperature sensor sending 43 MB to an unknown address at 3 a.m. is out of role: that is the signal. Encrypted traffic to the usual server is normal; volume and destination are what you compare to the expected role.',
								),
							),
						),
					),
				),
			),
		),
	);
}
