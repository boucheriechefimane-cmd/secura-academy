<?php
/**
 * D2 — Les deux rooms manquantes : attaques reseau et indicateurs de
 * compromission.
 *
 * POURQUOI CES ROOMS EXISTENT
 * ---------------------------
 * Le domaine D2 pese 22 % du score Security+. Deux de ses sujets
 * n'avaient aucune room : 2.6 (attaques reseau) et 2.8 (indicateurs de
 * compromission et attenuations).
 *
 * Ces deux sujets sont ceux ou l'on confond le plus facilement une
 * theorie apprise par coeur avec une competence. Ecrire « ARP spoofing »
 * ne sert a rien si l'on ne sait pas le reconnaitre dans une capture. On
 * demande donc de LIRE des traces reelles et de nommer ce qu'on voit.
 *
 *   - « Le reseau qui parle trop » (2.6) : une capture de trafic local, et
 *     une passerelle qui repond deux fois.
 *   - « La connexion de trois heures du matin » (2.8) : une chronologie
 *     d'incident, et des indicateurs a trier entre vulnerabilites,
 *     artefacts et faux positifs.
 *
 * Les captures sont SIMULEES, mais leur format et leurs valeurs sont
 * ceux d'un vrai poste : adresses MAC, ports, drapeaux TCP, horodatages.
 * On n'apprend pas a lire un journal avec de la prose.
 *
 * Contenu original, a partir de notions publiques : NIST SP 800-61r3
 * (reponse a incident), cadre MITRE ATT&CK (identifiants de techniques),
 * OWASP WSTG. Voir tools/sources-autorisees.json.
 *
 * @package Secura_Academy
 */

defined( 'ABSPATH' ) || exit;

/**
 * Les deux rooms du domaine D2.
 *
 * @return array[]
 */
function seca_default_rooms_d2() {
	return array(
		array(
			'title'      => 'Le reseau qui parle trop',
			'excerpt'    => 'Une capture de trafic sur un reseau local. Une seule adresse repond pour deux machines. Trouve laquelle.',
			'content'    => 'Les attaques reseau ne se voient pas sur une page web : elles se voient dans le trafic. Cette room t\'apprend a lire une capture locale et a reconnaitre une interception en cours.',
			'difficulty' => 'moyen',
			'duration'   => 35,
			'xp_bonus'   => 60,
			'track'      => 'gouvernance',
			'source'     => array(
				'nom'         => 'MITRE ATT&CK — Enterprise Matrix (T1557 Adversary-in-the-Middle)',
				'url'         => 'https://attack.mitre.org/techniques/T1557/',
				'licence'     => 'MITRE ATT&CK : usage libre avec attribution (termes d\'utilisation MITRE)',
				'attribution' => 'MITRE ATT&CK, technique T1557 Adversary-in-the-Middle',
			),
			'tasks'      => array(
				array(
					'type'      => 'lesson',
					'format'    => 'lecon',
					'title'     => 'Task 1 : ARP, ce protocole qui croit tout le monde',
					'content'   => '<p>Sur un reseau local, les machines ne s\'appellent pas par adresse IP : elles s\'appellent par adresse physique (MAC). Le protocole <strong>ARP</strong> fait la traduction « qui a cette IP ? reponds-moi ta MAC ». Et il a deux defauts historiques :</p><ul><li><strong>il ne verifie rien</strong> : n\'importe qui peut repondre, et sa reponse est acceptee ;</li><li><strong>il accepte les mises a jour</strong> : une machine qui a deja la bonne correspondance la remplace si on lui en annonce une autre.</li></ul><p>C\'est tout ce qu\'il faut a un attaquant pour une attaque de l\'<em>homme du milieu</em> : il annonce « la passerelle, c\'est moi » a toutes les machines, et « je suis chaque machine » a la passerelle. Le trafic passe chez lui. Rien ne tombe en panne : c\'est ce qui rend l\'attaque discrete.</p><p><strong>Ce qu\'on voit dans une capture.</strong> Trois signaux, dans l\'ordre de fiabilite :</p><ol><li><strong>La meme MAC annonce plusieurs adresses IP</strong> en quelques secondes — c\'est la signature de l\'empoisonnement.</li><li><strong>Des <em>gratuitous ARP</em> repetes</strong> : des annonces ARP que personne n\'a demandees.</li><li><strong>Une machine qui parle a la place d\'une autre</strong>, et des connexions qui semblent venir de la passerelle.</li></ol><p><strong>A retenir :</strong> sur un reseau local, une interception ne casse rien et ne se signale pas. Ce qui la trahit, c\'est une incoherence entre ce qui est annonce et ce qui devrait etre.</p>',
					'questions' => array(),
				),
				array(
					'type'    => 'practice',
					'format'  => 'qcm',
					'title'   => 'Task 2 : Entrainement — trois attaques reseau a reconnaitre',
					'content' => '<p>Trois situations. A chaque fois : de quelle attaque s\'agit-il ?</p>',
					'questions' => array(
						array(
							'question'    => 'Dans une capture, une meme adresse MAC annonce successivement l\'adresse IP de la passerelle, celle du serveur de fichiers et celle de l\'imprimante. Que se passe-t-il ?',
							'mode'        => 'choice',
							'topic'       => '2.6',
							'choices'     => array( 'Un empoisonnement ARP : la machine se place au milieu du trafic', 'Un scan de ports classique sur le reseau local', 'Une panne DHCP qui redistribue les adresses', 'Un simple changement de carte reseau sur un poste' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Une carte reseau n\'a qu\'une adresse physique. Pourquoi annoncerait-elle plusieurs adresses IP ?',
							'explanation' => 'Une MAC qui revendique plusieurs IP occupe la place de plusieurs machines. C\'est la signature de l\'empoisonnement ARP : elle recoit alors tout le trafic destine a ces adresses, et peut le relire ou le modifier avant de le retransmettre.',
						),
						array(
							'question'    => 'Un utilisateur tape la bonne adresse de sa banque et arrive sur un site identique, mais l\'adresse affichee dans la barre n\'est pas celle de la banque. Quelle attaque explique le mieux ce comportement ?',
							'mode'        => 'choice',
							'topic'       => '2.6',
							'choices'     => array( 'Un empoisonnement du cache DNS', 'Un deni de service par saturation', 'Un scan de ports sur le serveur de la banque', 'Une attaque par force brute sur le mot de passe' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Le nom a ete resolu, mais vers la mauvaise adresse. Ou se fait la resolution ?',
							'explanation' => 'Le cache DNS associe un nom a une adresse. S\'il est empoisonne, la machine resout le bon nom vers le mauvais serveur. C\'est plus grave qu\'une redirection classique : l\'utilisateur n\'a aucune raison de se mefier, puisqu\'il a tape la bonne adresse.',
						),
						array(
							'question'    => 'Quelle mesure reduit le mieux le risque d\'empoisonnement ARP sur un reseau d\'entreprise ?',
							'mode'        => 'choice',
							'topic'       => '2.6',
							'choices'     => array( 'La surveillance ARP dynamique sur les commutateurs et le cloisonnement en VLAN', 'Changer les mots de passe des postes chaque mois', 'Installer un antivirus sur chaque machine', 'Desactiver le protocole DHCP' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'L\'attaque exploite la confiance aveugle du protocole ARP. Que peut-on verifier automatiquement ?',
							'explanation' => 'La surveillance ARP dynamique (dynamic ARP inspection) verifie les correspondances IP/MAC contre une table de confiance, et le cloisonnement limite la portee d\'une attaque a un seul VLAN. Un antivirus ne voit rien : l\'attaque est du trafic normal, bien forme.',
						),
					),
				),
				array(
					'type'      => 'test',
					'format'    => 'pratique',
					'title'     => 'Task 3 : La mission — trouver la machine qui se fait passer pour la passerelle',
					'content'   => '<p><strong>Mission.</strong> Une capture de trafic local est dans l\'atelier. La passerelle du reseau est <code>192.168.10.1</code>. Une autre machine annonce cette meme adresse.</p><p>Ecris l\'<strong>adresse IP</strong> de la machine qui se fait passer pour la passerelle (le champ <code>source</code> des annonces ARP suspectes).</p>',
					'questions' => array(
						array(
							'question'    => 'Quelle adresse IP se fait passer pour la passerelle 192.168.10.1 ?',
							'mode'        => 'text',
							'topic'       => '2.6',
							'answers'     => array( '/^192\.168\.10\.66$/', '/192\.168\.10\.66/' ),
							'xp'          => 40,
							'hint'        => 'Dans le terminal : <code>cat /srv/atelier/capture-arp.txt</code>. Cherche les lignes ou la MAC de la passerelle apparait avec une autre IP.',
							'explanation' => 'La MAC b4:2e:99:0c:1a:7f est celle de la passerelle legitime (192.168.10.1). La machine 192.168.10.66 annonce cette meme MAC pour usurper l\'adresse de la passerelle : tout le trafic des postes part vers elle. C\'est un homme du milieu en cours, et il n\'y a eu aucune coupure de service.',
						),
					),
					'terminal' => array(
						'intro'   => 'analyste@atelier:~$ ',
						'unknown' => 'Cette commande ne donne rien ici.',
						'success' => 'Capture analysee. Tu peux repondre.',
						'steps'   => array(
							array(
								'match'  => array( 'ls /srv/atelier', '/^ls .*atelier/', '/^ls$/' ),
								'output' => "capture-arp.txt\ntable-arp-avant.txt\n",
								'hint'   => 'Deux fichiers : la capture et la table ARP de reference.',
							),
							array(
								'match'  => array( 'cat /srv/atelier/table-arp-avant.txt', '/cat .*table-arp/' ),
								'output' => "# Table ARP de reference (releve du 12/10 a 09:00, avant incident)\n192.168.10.1    b4:2e:99:0c:1a:7f    passerelle\n192.168.10.20   3c:52:82:aa:11:04    poste-compta-01\n192.168.10.21   3c:52:82:aa:11:05    poste-compta-02\n192.168.10.30   00:1b:21:44:c0:9e    serveur-fichiers\n",
								'hint'   => 'Retiens la MAC de la passerelle : c\'est la reference.',
							),
							array(
								'match'  => array( 'cat /srv/atelier/capture-arp.txt', '/cat .*capture-arp/' ),
								'output' => "# Capture ARP — 12/10 de 14:02 a 14:03 (extrait, 9 paquets)\n# horodatage        source            mac_source           type            info\n14:02:11.204  192.168.10.20    3c:52:82:aa:11:04    requete         who-has 192.168.10.1\n14:02:11.206  192.168.10.1     b4:2e:99:0c:1a:7f    reponse         is-at b4:2e:99:0c:1a:7f\n14:02:47.881  192.168.10.66    3c:52:82:aa:11:04    annonce         is-at 3c:52:82:aa:11:04  (gratuit, non demande)\n14:02:47.883  192.168.10.66    b4:2e:99:0c:1a:7f    annonce         is-at b4:2e:99:0c:1a:7f  (gratuit, non demande)\n14:02:48.005  192.168.10.21    3c:52:82:aa:11:05    requete         who-has 192.168.10.1\n14:02:48.007  192.168.10.66    b4:2e:99:0c:1a:7f    reponse         is-at b4:2e:99:0c:1a:7f\n14:02:49.442  192.168.10.66    b4:2e:99:0c:1a:7f    annonce         is-at b4:2e:99:0c:1a:7f  (gratuit, non demande)\n14:02:50.118  192.168.10.30    00:1b:21:44:c0:9e    requete         who-has 192.168.10.1\n14:02:50.120  192.168.10.66    b4:2e:99:0c:1a:7f    reponse         is-at b4:2e:99:0c:1a:7f\n",
								'hint'   => 'Compare la MAC de la passerelle (table de reference) avec les adresses qui repondent dans la capture.',
							),
						),
					),
				),
				array(
					'type'       => 'exam',
					'format'     => 'qcm',
					'title'      => 'Task 4 : Examen de fin de room',
					'content'    => '<p>Quatre questions, 8 minutes, seuil 80 %.</p>',
					'time_limit' => 8,
					'pass_score' => 80,
					'questions'  => array(
						array(
							'question'    => 'Pourquoi un empoisonnement ARP passe-t-il souvent inapercu ?',
							'mode'        => 'choice',
							'topic'       => '2.6',
							'choices'     => array( 'Le trafic continue de circuler : rien ne tombe en panne', 'Il necessite un redemarrage du reseau', 'Il ne fonctionne que sur les reseaux sans fil', 'Il modifie les adresses IP des postes' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'L\'attaquant retransmet le trafic : le service reste disponible, seule la confidentialite est atteinte. C\'est pourquoi la detection doit venir de l\'analyse du trafic, pas de la plainte des utilisateurs.',
						),
						array(
							'question'    => 'Quelle est la difference entre une redirection DNS et un empoisonnement de cache DNS ?',
							'mode'        => 'choice',
							'topic'       => '2.6',
							'choices'     => array( 'Le cache corrompt la resolution pour tous ceux qui l\'utilisent, sans que personne ne tape autre chose', 'La redirection DNS n\'existe pas', 'L\'empoisonnement de cache ne fonctionne que sur le poste de l\'attaquant', 'Les deux sont identiques, seul le nom change' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Le cache est partage : une entree corrompue redirige tous les clients du serveur, parfois pendant des heures. C\'est ce qui en fait une attaque a fort effet de levier.',
						),
						array(
							'question'    => 'Une capture montre des reponses ARP provenant d\'une machine qui n\'est pas la passerelle. Quelle action est prioritaire ?',
							'mode'        => 'choice',
							'topic'       => '2.6',
							'choices'     => array( 'Isoler la machine et capturer les preuves avant de couper', 'Redemarrer le commutateur pour remettre les tables a zero', 'Changer le mot de passe de la passerelle', 'Prevenir tous les utilisateurs par courriel' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Isoler coupe l\'interception ; capturer avant preserve les preuves. Redemarrer efface justement ce qu\'on veut garder, et un mot de passe n\'a aucun rapport avec ARP.',
						),
						array(
							'question'    => 'Quelle attenuation porte sur la CONCEPTION du reseau plutot que sur la detection ?',
							'mode'        => 'choice',
							'topic'       => '2.6',
							'choices'     => array( 'Segmenter en VLAN et filtrer le trafic entre segments', 'Analyser les journaux du commutateur chaque semaine', 'Alerter sur les annonces ARP gratuites', 'Former les utilisateurs a ne pas cliquer' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'La segmentation reduit ce qu\'une machine compromise peut atteindre, quelle que soit l\'attaque. Les trois autres reduisent le temps de detection : c\'est utile, mais ce n\'est pas la meme couche de defense.',
						),
					),
				),
			),
			'i18n'       => array(
				'en' => array(
					'title'   => 'The network that talks too much',
					'excerpt' => 'A packet capture on a local network. One address answers for two machines. Find it.',
					'tasks'   => array(
						array(
							'title'     => 'Task 1: ARP, the protocol that believes everyone',
							'questions' => array(),
						),
						array(
							'title'     => 'Task 2: Practice — three network attacks to recognise',
							'questions' => array(
								array(
									'question'    => 'In a capture, one MAC address successively claims the gateway IP, the file server IP and the printer IP. What is happening?',
									'choices'     => array( 'ARP poisoning: the machine is placing itself in the middle of the traffic', 'A routine port scan on the local network', 'A DHCP failure redistributing addresses', 'Someone simply changed a network card in a workstation' ),
									'correct'     => 0,
									'hint'        => 'A network card has one physical address. Why would it announce several IP addresses?',
									'explanation' => 'A MAC claiming several IPs takes the place of several machines. That is the signature of ARP poisoning: it now receives all traffic destined for those addresses, and can read or modify it before forwarding.',
								),
								array(
									'question'    => 'A user types their bank\'s correct address and lands on an identical site, but the address in the bar is not the bank\'s. Which attack best explains this?',
									'choices'     => array( 'DNS cache poisoning', 'A denial of service by saturation', 'A port scan on the bank\'s server', 'A brute-force attack on the password' ),
									'correct'     => 0,
									'hint'        => 'The name was resolved, but to the wrong address. Where does resolution happen?',
									'explanation' => 'The DNS cache maps a name to an address. Poison it, and the machine resolves the right name to the wrong server. This is worse than an ordinary redirect: the user has no reason to be suspicious, since they typed the right address.',
								),
								array(
									'question'    => 'Which measure best reduces the risk of ARP poisoning on an enterprise network?',
									'choices'     => array( 'Dynamic ARP inspection on switches and segmentation into VLANs', 'Changing workstation passwords every month', 'Installing antivirus on every machine', 'Disabling DHCP' ),
									'correct'     => 0,
									'hint'        => 'The attack exploits ARP\'s blind trust. What can be checked automatically?',
									'explanation' => 'Dynamic ARP inspection checks IP/MAC bindings against a trusted table, and segmentation limits an attack to a single VLAN. Antivirus sees nothing: the attack is well-formed, ordinary traffic.',
								),
							),
						),
						array(
							'title'     => 'Task 3: The mission — find the machine impersonating the gateway',
							'questions' => array(
								array(
									'question'    => 'Which IP address is impersonating the gateway 192.168.10.1?',
									'hint'        => 'In the terminal: <code>cat /srv/atelier/capture-arp.txt</code>. Look for lines where the gateway MAC appears with another IP.',
									'explanation' => 'MAC b4:2e:99:0c:1a:7f is the legitimate gateway (192.168.10.1). Machine 192.168.10.66 announces that same MAC to impersonate the gateway: all workstation traffic goes through it. This is a man-in-the-middle in progress, and no service went down.',
								),
							),
						),
						array(
							'title'     => 'Task 4: End-of-room exam',
							'questions' => array(
								array(
									'question'    => 'Why does ARP poisoning often go unnoticed?',
									'choices'     => array( 'Traffic keeps flowing: nothing goes down', 'It requires the network to be restarted', 'It only works on wireless networks', 'It changes the workstations\' IP addresses' ),
									'correct'     => 0,
									'explanation' => 'The attacker forwards the traffic: the service stays available, only confidentiality is breached. That is why detection must come from traffic analysis, not from user complaints.',
								),
								array(
									'question'    => 'What is the difference between a DNS redirect and DNS cache poisoning?',
									'choices'     => array( 'The cache corrupts resolution for everyone using it, without anyone typing anything else', 'DNS redirection does not exist', 'Cache poisoning only works on the attacker\'s own machine', 'They are identical, only the name differs' ),
									'correct'     => 0,
									'explanation' => 'The cache is shared: one poisoned entry redirects every client of that server, sometimes for hours. That is what gives the attack its leverage.',
								),
								array(
									'question'    => 'A capture shows ARP replies coming from a machine that is not the gateway. Which action comes first?',
									'choices'     => array( 'Isolate the machine and capture evidence before cutting anything', 'Reboot the switch to reset the tables', 'Change the gateway password', 'Email every user' ),
									'correct'     => 0,
									'explanation' => 'Isolating stops the interception; capturing before that preserves the evidence. Rebooting erases exactly what you want to keep, and a password has nothing to do with ARP.',
								),
								array(
									'question'    => 'Which mitigation acts on network DESIGN rather than on detection?',
									'choices'     => array( 'Segmenting into VLANs and filtering traffic between segments', 'Reviewing switch logs every week', 'Alerting on gratuitous ARP announcements', 'Training users not to click' ),
									'correct'     => 0,
									'explanation' => 'Segmentation reduces what a compromised machine can reach, whatever the attack. The other three reduce detection time: useful, but a different layer of defence.',
								),
							),
						),
					),
				),
			),
		),

		array(
			'title'      => 'La connexion de trois heures du matin',
			'excerpt'    => 'Une chronologie d\'incident et trente lignes de journal. Distinguer une vulnerabilite, un artefact et un vrai indicateur de compromission.',
			'content'    => 'Un indicateur de compromission n\'est pas une anomalie : c\'est une trace qui prouve qu\'un evenement a eu lieu. Cette room t\'apprend a trier une chronologie sans confondre une faille, une bizarrerie et une intrusion.',
			'difficulty' => 'moyen',
			'duration'   => 35,
			'xp_bonus'   => 60,
			'track'      => 'gouvernance',
			'source'     => array(
				'nom'         => 'NIST SP 800-61 Rev.3 — Incident Response Recommendations',
				'url'         => 'https://csrc.nist.gov/pubs/sp/800/61/r3/final',
				'licence'     => 'Domaine public (publication du NIST, Etats-Unis)',
				'attribution' => 'NIST Special Publication 800-61 Revision 3, Incident Response Recommendations and Considerations for Cybersecurity Risk Management',
			),
			'tasks'      => array(
				array(
					'type'      => 'lesson',
					'format'    => 'lecon',
					'title'     => 'Task 1 : Trois choses qu\'on confond tout le temps',
					'content'   => '<p>Dans une chronologie d\'incident, tout n\'a pas le meme statut. Confondre les trois categories fait perdre des heures.</p><ol><li><strong>La vulnerabilite</strong> — une faiblesse qui <em>pourrait</em> etre exploitee : un correctif manquant, un port ouvert, un mot de passe par defaut. Elle ne prouve rien sur ce qui s\'est passe.</li><li><strong>L\'artefact</strong> — une trace normale qu\'on prend pour une anomalie : une tache planifiee de mise a jour a 3 h, un scan de l\'inventaire, un service qui redemarre. Le bruit de fond d\'un systeme qui vit.</li><li><strong>L\'indicateur de compromission (IoC)</strong> — une trace qui prouve qu\'un evenement a eu lieu : une connexion sortante vers une adresse inconnue a heure fixe, un compte cree hors procedure, un fichier dont l\'empreinte correspond a un malware connu.</li></ol><p><strong>La regle de tri.</strong> Une vulnerabilite dit « ca pourrait arriver ». Un artefact dit « c\'est deja arrive, et c\'est normal ». Un IoC dit « c\'est deja arrive, et ce n\'etait pas nous ». Seul le troisieme justifie d\'ouvrir un incident.</p><p><strong>Le bon premier geste.</strong> Face a un IoC probable : preserver, puis isoler. Pas l\'inverse. Eteindre la machine detruit la memoire vive, les connexions actives et les processus — souvent les seules preuves qui disent <em>comment</em> l\'attaquant est entre.</p><p><strong>A retenir :</strong> un indicateur de compromission se relie a une <em>chaine</em> d\'evenements, pas a un evenement isole. C\'est la sequence qui fait la preuve, pas la ligne.</p>',
					'questions' => array(),
				),
				array(
					'type'    => 'practice',
					'format'  => 'qcm',
					'title'   => 'Task 2 : Entrainement — trier trois evenements',
					'content' => '<p>Trois lignes de journal. Vulnerabilite, artefact, ou indicateur de compromission ?</p>',
					'questions' => array(
						array(
							'question'    => 'Le serveur de fichiers n\'a pas recu le correctif de securite de septembre. C\'est un fait constate le 12/10.',
							'mode'        => 'choice',
							'topic'       => '2.8',
							'choices'     => array( 'Une vulnerabilite : cela ne prouve pas qu\'un evenement a eu lieu', 'Un indicateur de compromission : le serveur est compromis', 'Un artefact : c\'est normal', 'Une attaque en cours' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Le fait prouve-t-il qu\'il s\'est passe quelque chose, ou seulement que quelque chose pourrait se passer ?',
							'explanation' => 'Un correctif manquant est une condition, pas un evenement. C\'est grave et cela se corrige, mais cela ne dit pas si quelqu\'un est entre. Il faut chercher des traces d\'exploitation avant de conclure.',
						),
						array(
							'question'    => 'Chaque nuit a 03:00, la machine se connecte a un serveur de mises a jour de l\'editeur, par HTTPS. Cela se produit depuis l\'installation, sans exception.',
							'mode'        => 'choice',
							'topic'       => '2.8',
							'choices'     => array( 'Un artefact : comportement normal et documente du systeme', 'Un indicateur de compromission : le trafic de nuit est toujours suspect', 'Une vulnerabilite : la connexion n\'est pas chiffree', 'Une attaque par deni de service' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Une activite nocturne reguliere vers un editeur connu, depuis toujours : qu\'est-ce qui manque pour en faire un IoC ?',
							'explanation' => 'Ce qui distingue un artefact d\'un IoC, c\'est l\'ecart avec la baseline : meme heure, meme destination, depuis toujours. Un IoC serait une destination nouvelle, une heure qui change, ou un volume anormal. Chercher les IoC sans baseline produit cent fausses alertes par nuit.',
						),
						array(
							'question'    => 'Trois echecs de connexion sur un compte de service, puis une reussite depuis une adresse hors du reseau, suivie d\'une connexion sortante vers un pays ou l\'entreprise n\'a aucune activite.',
							'mode'        => 'choice',
							'topic'       => '2.8',
							'choices'     => array( 'Un indicateur de compromission : la sequence raconte une intrusion', 'Une vulnerabilite : le compte est mal configure', 'Un artefact : les utilisateurs se trompent souvent de mot de passe', 'Trois evenements sans lien entre eux' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Regarde la sequence, pas les lignes : echecs, puis reussite externe, puis sortie inhabituelle.',
							'explanation' => 'Chaque ligne prise seule est banale. C\'est la sequence qui fait la preuve : des echecs repetes disent une tentative, la reussite hors reseau dit un acces obtenu, la connexion sortante dit un usage. C\'est exactement ce que la correlation apporte.',
						),
					),
				),
				array(
					'type'      => 'test',
					'format'    => 'pratique',
					'title'     => 'Task 3 : La mission — trouver l\'indicateur qui ne trompe pas',
					'content'   => '<p><strong>Mission.</strong> La chronologie de l\'incident et le journal des connexions sont dans l\'atelier. Sur les quinze lignes du journal, une seule relie une authentification reussie a une destination jamais vue auparavant.</p><p>Ecris l\'<strong>adresse IP de destination</strong> de cette connexion sortante (le champ <code>dest</code>).</p>',
					'questions' => array(
						array(
							'question'    => 'Quelle adresse de destination relie une authentification reussie a un usage inhabituel ?',
							'mode'        => 'text',
							'topic'       => '2.8',
							'answers'     => array( '/^203\.0\.113\.47$/', '/203\.0\.113\.47/' ),
							'xp'          => 40,
							'hint'        => 'Dans le terminal : <code>cat /srv/atelier/journal-connexions.log</code>. Cherche une reussite depuis 203.0.113.x, puis la connexion sortante qui suit, vers une adresse absente de la liste des destinations connues.',
							'explanation' => 'La connexion vers 203.0.113.47 est la seule destination absente de la liste des sorties connues, et elle suit de six minutes l\'authentification du compte de service depuis 198.51.100.23 — une adresse hors reseau. Les deux evenements mis bout a bout racontent l\'intrusion ; pris separement, ils ne disent rien. C\'est la correlation qui fait la preuve.',
						),
					),
					'terminal' => array(
						'intro'   => 'analyste@atelier:~$ ',
						'unknown' => 'Cette commande ne donne rien ici.',
						'success' => 'Journal et destinations connues lus. Tu peux repondre.',
						'steps'   => array(
							array(
								'match'  => array( 'ls /srv/atelier', '/^ls .*atelier/', '/^ls$/' ),
								'output' => "journal-connexions.log\ndestinations-connues.txt\nchronologie-incident.txt\n",
								'hint'   => 'Trois fichiers : le journal, la liste des destinations connues, et la chronologie.',
							),
							array(
								'match'  => array( 'cat /srv/atelier/destinations-connues.txt', '/cat .*destinations-connues/' ),
								'output' => "# Destinations sortantes documentees (baseline validee le 01/10)\n203.0.113.10   mises a jour editeur\n203.0.113.20   sauvegarde externalisee\n198.51.100.5   messagerie\n198.51.100.9   proxy web\n",
								'hint'   => 'Toute destination absente de cette liste est a examiner.',
							),
							array(
								'match'  => array( 'cat /srv/atelier/journal-connexions.log', '/cat .*journal-connexions/' ),
								'output' => "# Journal des connexions — 12/10\n02:59:58 auth compte=svc_backup source=10.0.0.30 resultat=succes\n03:00:12 sortie source=10.0.0.30 dest=203.0.113.20 port=443 octets=412000\n03:00:14 sortie source=10.0.0.30 dest=203.0.113.10 port=443 octets=1840\n07:41:02 auth compte=p.leroy source=10.0.0.41 resultat=succes\n08:15:33 sortie source=10.0.0.41 dest=198.51.100.9 port=443 octets=230800\n09:02:10 auth compte=admin source=10.0.0.5 resultat=echec\n09:02:44 auth compte=admin source=10.0.0.5 resultat=echec\n09:03:19 auth compte=admin source=10.0.0.5 resultat=echec\n09:04:02 auth compte=svc_backup source=198.51.100.23 resultat=succes\n09:10:28 sortie source=10.0.0.30 dest=203.0.113.47 port=8443 octets=18540000\n09:12:05 sortie source=10.0.0.30 dest=203.0.113.20 port=443 octets=3900\n12:30:41 auth compte=r.martin source=10.0.0.22 resultat=succes\n13:05:12 sortie source=10.0.0.22 dest=198.51.100.5 port=443 octets=61200\n17:44:19 auth compte=admin source=10.0.0.5 resultat=succes\n23:59:50 sortie source=10.0.0.30 dest=203.0.113.10 port=443 octets=1500\n",
								'hint'   => 'Cherche la reussite du compte de service depuis une adresse hors reseau, puis ce qui sort juste apres.',
							),
						),
					),
				),
				array(
					'type'       => 'exam',
					'format'     => 'qcm',
					'title'      => 'Task 4 : Examen de fin de room',
					'content'    => '<p>Quatre questions, 8 minutes, seuil 80 %.</p>',
					'time_limit' => 8,
					'pass_score' => 80,
					'questions'  => array(
						array(
							'question'    => 'Quelle affirmation distingue correctement une vulnerabilite d\'un indicateur de compromission ?',
							'mode'        => 'choice',
							'topic'       => '2.8',
							'choices'     => array( 'La vulnerabilite est une condition, l\'indicateur prouve qu\'un evenement a eu lieu', 'La vulnerabilite est technique, l\'indicateur est humain', 'L\'indicateur est plus grave parce qu\'il concerne les donnees', 'Les deux sont synonymes en pratique' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Une vulnerabilite ne dit rien de ce qui s\'est passe : elle decrit une porte non verrouillee, pas un visiteur. L\'indicateur, lui, est une trace d\'evenement. Confondre les deux conduit soit a paniquer sans preuve, soit a ignorer une intrusion reelle.',
						),
						array(
							'question'    => 'Pourquoi faut-il une baseline avant de chasser les indicateurs de compromission ?',
							'mode'        => 'choice',
							'topic'       => '2.8',
							'choices'     => array( 'Pour distinguer une nouveaute d\'un comportement normal deja observe', 'Pour accelerer la collecte des journaux', 'Pour supprimer les faux positifs automatiquement', 'Pour respecter une obligation legale de conservation' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Sans reference, tout est anormal et rien ne l\'est : on produit des centaines d\'alertes que personne ne traite. La baseline transforme « c\'est bizarre » en « c\'est nouveau », ce qui est verifiable.',
						),
						array(
							'question'    => 'Face a un indicateur de compromission probable sur un poste allume, quel est l\'ordre correct ?',
							'mode'        => 'choice',
							'topic'       => '4.7',
							'choices'     => array( 'Collecter les preuves volatiles, puis isoler le poste', 'Eteindre le poste, puis enqueter sur le disque', 'Reinstaller le poste, puis chercher la cause', 'Changer le mot de passe, puis attendre' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'La memoire, les connexions actives et les processus disparaissent a l\'extinction. On capture l\'essentiel — meme en quelques minutes, sous contrainte de temps — puis on isole. Reinstaller detruit tout, et changer un mot de passe ne stoppe pas une porte derobee.',
						),
						array(
							'question'    => 'Un poste genere une alerte a 3 h du matin chaque nuit depuis un an. Que faut-il faire ?',
							'mode'        => 'choice',
							'topic'       => '4.3',
							'choices'     => array( 'Documenter le comportement comme normal et ajuster la regle d\'alerte', 'Ouvrir un incident chaque nuit et le cloturer le matin', 'Ignorer toutes les alertes nocturnes, elles sont fausses', 'Eteindre le systeme de detection la nuit' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Une alerte qui se declenche tous les jours sans raison est une regle a corriger, pas un incident. La documenter comme artefact connu permet de garder la detection utile : sinon, l\'equipe apprend a ignorer les alertes — et ignorera la vraie.',
						),
					),
				),
			),
			'i18n'       => array(
				'en' => array(
					'title'   => 'The three o\'clock connection',
					'excerpt' => 'An incident timeline and thirty log lines. Tell a vulnerability, an artefact and a real indicator of compromise apart.',
					'tasks'   => array(
						array(
							'title'     => 'Task 1: Three things people always confuse',
							'questions' => array(),
						),
						array(
							'title'     => 'Task 2: Practice — sort three events',
							'questions' => array(
								array(
									'question'    => 'The file server did not receive September\'s security patch. That is a fact observed on 10/12.',
									'choices'     => array( 'A vulnerability: it does not prove that any event took place', 'An indicator of compromise: the server is compromised', 'An artefact: this is normal', 'An attack in progress' ),
									'correct'     => 0,
									'hint'        => 'Does the fact prove something happened, or only that something could happen?',
									'explanation' => 'A missing patch is a condition, not an event. It is serious and it must be fixed, but it does not say whether anyone got in. You look for exploitation traces before concluding.',
								),
								array(
									'question'    => 'Every night at 03:00, the machine connects to a vendor update server over HTTPS. It has done so since installation, without exception.',
									'choices'     => array( 'An artefact: normal, documented system behaviour', 'An indicator of compromise: night traffic is always suspicious', 'A vulnerability: the connection is not encrypted', 'A denial-of-service attack' ),
									'correct'     => 0,
									'hint'        => 'Regular nightly activity to a known vendor, forever: what is missing to make it an IoC?',
									'explanation' => 'What separates an artefact from an IoC is the gap from the baseline: same time, same destination, always. An IoC would be a new destination, a shifting time, or an abnormal volume. Hunting IoCs without a baseline produces a hundred false alerts a night.',
								),
								array(
									'question'    => 'Three failed logins on a service account, then a success from an address outside the network, followed by an outbound connection to a country where the company has no activity.',
									'choices'     => array( 'An indicator of compromise: the sequence tells an intrusion', 'A vulnerability: the account is badly configured', 'An artefact: users often mistype passwords', 'Three unrelated events' ),
									'correct'     => 0,
									'hint'        => 'Look at the sequence, not the lines: failures, then an external success, then an unusual outbound.',
									'explanation' => 'Each line on its own is banal. The sequence is the proof: repeated failures show an attempt, the off-network success shows access obtained, the outbound shows use. That is exactly what correlation provides.',
								),
							),
						),
						array(
							'title'     => 'Task 3: The mission — find the indicator that does not lie',
							'questions' => array(
								array(
									'question'    => 'Which destination address ties a successful authentication to unusual use?',
									'hint'        => 'In the terminal: <code>cat /srv/atelier/journal-connexions.log</code>. Look for a success from 203.0.113.x, then the outbound connection that follows, to an address absent from the known destinations.',
									'explanation' => 'The connection to 203.0.113.47 is the only destination missing from the known outbound list, and it follows six minutes after the service account authenticated from 198.51.100.23 — an address outside the network. Put together, the two events tell the intrusion; taken separately, they say nothing. Correlation is the proof.',
								),
							),
						),
						array(
							'title'     => 'Task 4: End-of-room exam',
							'questions' => array(
								array(
									'question'    => 'Which statement correctly separates a vulnerability from an indicator of compromise?',
									'choices'     => array( 'A vulnerability is a condition; an indicator proves an event took place', 'A vulnerability is technical, an indicator is human', 'An indicator is more serious because it involves data', 'In practice the two are synonymous' ),
									'correct'     => 0,
									'explanation' => 'A vulnerability says nothing about what happened: it describes an unlocked door, not a visitor. The indicator is a trace of an event. Confusing them leads either to panicking without evidence, or to ignoring a real intrusion.',
								),
								array(
									'question'    => 'Why do you need a baseline before hunting for indicators of compromise?',
									'choices'     => array( 'To tell a novelty from behaviour already observed as normal', 'To speed up log collection', 'To remove false positives automatically', 'To meet a legal retention obligation' ),
									'correct'     => 0,
									'explanation' => 'Without a reference, everything is abnormal and nothing is: you produce hundreds of alerts nobody handles. A baseline turns "this is odd" into "this is new", which is verifiable.',
								),
								array(
									'question'    => 'Facing a likely indicator of compromise on a powered-on workstation, what is the right order?',
									'choices'     => array( 'Collect volatile evidence, then isolate the workstation', 'Power it off, then investigate the disk', 'Reinstall the workstation, then look for the cause', 'Change the password, then wait' ),
									'correct'     => 0,
									'explanation' => 'Memory, active connections and processes vanish on power-off. You capture the essentials — even in a few minutes, under time pressure — then isolate. Reinstalling destroys everything, and changing a password does not stop a backdoor.',
								),
								array(
									'question'    => 'A workstation raises an alert at 3 a.m. every night, and has done so for a year. What should you do?',
									'choices'     => array( 'Document the behaviour as normal and adjust the alert rule', 'Open an incident every night and close it in the morning', 'Ignore all night alerts, they are always false', 'Turn the detection system off at night' ),
									'correct'     => 0,
									'explanation' => 'An alert that fires daily with no reason is a rule to fix, not an incident. Documenting it as a known artefact keeps detection useful: otherwise the team learns to ignore alerts — and will ignore the real one.',
								),
							),
						),
					),
				),
			),
		),
	);
}
