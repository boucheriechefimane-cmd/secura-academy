<?php
/**
 * D4 — Operations de securite : forensique, preuves, automatisation.
 *
 * POURQUOI CES ROOMS EXISTENT
 * ---------------------------
 * Mesure du 6 novembre 2026 : les sujets 4.7 (forensique et preuves) et
 * 4.8 (automatisation et orchestration) n'existaient pas. Ce sont deux
 * sujets sur les cinq que compte le domaine le plus lourd du referentiel
 * (D4 = 28 % du score).
 *
 * Le choix de conception est le meme que pour le bloc D5 : ce ne sont pas
 * des rooms de lecture. En forensique, on apprend en ORDONNANT des faits
 * et en reperant ce qui a ete detruit. En automatisation, on apprend en
 * choisissant ce qu'on a le droit de faire sans humain.
 *
 * Sources : NIST SP 800-86 (aout 2006) et RFC 3227 (BCP 55). Les deux
 * insistent sur le meme point : l'ordre de volatilite, et le fait qu'une
 * manipulation irreversible detruit la preuve avant qu'on l'ait lue.
 *
 * Le terminal est SIMULE : ces rooms fonctionnent sans conteneur.
 * Contenu original, ecrit a partir de ces documents publics.
 *
 * @package Secura_Academy
 */

defined( 'ABSPATH' ) || exit;

/**
 * Les rooms du bloc.
 *
 * @return array[]
 */
function seca_default_rooms_d4() {
	return array(
		array(
			'title'       => 'L\'incident qui a commence par un redemarrage',
			'excerpt'     => 'Un serveur est compromis. L\'administrateur le redemarre pour repartir propre. Tu dois expliquer ce qu\'il vient de detruire, et dans quel ordre il fallait proceder.',
			'content'     => 'La forensique ne commence pas avec un outil, elle commence avec un ordre : ce qui disparait le plus vite se lit en premier. Cette room t\'apprend a classer les preuves par volatilite, et a reperer ce qu\'un geste irreversible a detruit.',
			'difficulty'  => 'moyen',
			'duration'   => 30,
			'xp_bonus'   => 60,
			'track'      => 'operations',
			'source'     => array(
				'nom'        => 'NIST SP 800-86 — Guide to Integrating Forensic Techniques into Incident Response',
				'url'        => 'https://csrc.nist.gov/pubs/sp/800/86/final',
				'licence'    => 'Domaine public (publication du NIST, Etats-Unis)',
				'attribution'=> 'NIST Special Publication 800-86, Guide to Integrating Forensic Techniques into Incident Response (aout 2006) ; complete par la RFC 3227 (BCP 55), Guidelines for Evidence Collection and Archiving',
			),
			'tasks'      => array(
				array(
					'type'       => 'lesson',
					'format'     => 'lecon',
					'title'  => 'Task 1 : L\'ordre de volatilite, et pourquoi il commande tout',
					'content'=> '<p>Une preuve numerique n\'est pas un objet stable : elle s\'efface. Certaines disparaissent en coupant le courant, d\'autres survivent des annees sur un disque. Le NIST SP 800-86 et la RFC 3227 disent la meme chose : on collecte <strong>du plus volatil au moins volatil</strong>. Inverser cet ordre, c\'est perdre ce qu\'on ne pourra jamais reconstituer.</p><p>L\'ordre de volatilite, du plus fragile au plus stable :</p><ol><li><strong>la memoire vive et l\'etat du systeme</strong> : processus en cours, connexions reseau etablies, cles de chiffrement en memoire, malware sans fichier. Une extinction efface tout cela definitivement ;</li><li><strong>les donnees temporaires</strong> : fichiers temporaires, caches, fichiers de pagination ;</li><li><strong>le disque</strong> : journaux systeme, historique, fichiers supprimes mais non ecrases ;</li><li><strong>les journaux centralises</strong> : ceux qui sont deja partis sur un serveur de collecte, hors de la machine compromise ;</li><li><strong>la configuration physique et la topologie</strong> : ce qui est branche ou et, et comment ;</li><li><strong>les supports d\'archivage</strong> : sauvegardes, bandes, images de reference.</li></ol><p>Trois gestes detruisent une preuve, et ils sont tous les trois naturels :</p><ul><li><strong>eteindre ou redemarrer</strong> — la memoire vive disparait, et l\'attaquant a parfois modifie les scripts d\'arret pour effacer ses traces ;</li><li><strong>nettoyer les journaux « pour repartir propre »</strong> — c\'est la destruction de la seule trace de la chronologie ;</li><li><strong>lancer des outils depuis la machine compromise</strong> — un rootkit peut mentir sur ce que l\'outil affiche. On travaille depuis un support externe maitrise.</li></ul><p><strong>Un point que la RFC 3227 ajoute, et qui surprend :</strong> deconnecter la machine du reseau peut declencher un mecanisme de l\'attaquant qui efface tout des qu\'il perd la connexion (« deadman switch »). L\'isolement reste la bonne action dans la majorite des cas, mais il se decide, il ne se fait pas par reflexe.</p><p><strong>A retenir :</strong> la question n\'est pas « quel outil lancer », mais « qu\'est-ce qui disparait si j\'attends une heure ». Cette question-la se pose avant de toucher a quoi que ce soit.</p>',
					'questions' => array(),
				),
				array(
					'type'       => 'practice',
					'format'     => 'qcm',
					'title'  => 'Task 2 : Entrainement — trois decisions a trancher',
					'content'=> '<p>Trois situations reelles. A chaque fois : quelle est la bonne premiere action ?</p>',
					'questions' => array(
						array(
							'question'    => 'Un serveur web vient d\'etre compromis. Il est encore allume, et l\'attaquant y a peut-etre encore une session ouverte. Quelle preuve faut-il capturer en premier ?',
							'mode'        => 'choice',
							'topic'       => '4.7',
							'choices'     => array( 'La memoire vive et les connexions reseau actives, avant toute extinction', 'Une image complete du disque, parce que c\'est la preuve la plus complete et la plus facile a obtenir en urgence', 'Les journaux applicatifs, parce qu\'ils racontent toute l\'attaque du debut a la fin, sans zone d\'ombre', 'Une capture d\'ecran du bureau, pour garder une trace visuelle de l\'etat de la machine au moment du constat' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Qu\'est-ce qui disparait si la machine s\'eteint dans une minute ?',
							'explanation' => 'La memoire vive contient les processus en cours, les connexions etablies, les cles et parfois le code malveillant qui n\'existe nulle part sur le disque. Le disque, lui, sera encore la demain : il se capture apres. C\'est exactement l\'erreur que commet l\'administrateur qui redemarre.',
						),
						array(
							'question'    => 'L\'administrateur a redemarre le serveur compromis « pour repartir propre ». Qu\'a-t-il perdu, et qu\'a-t-il conserve ?',
							'mode'        => 'choice',
							'topic'       => '4.7',
							'choices'     => array( 'Il a perdu la memoire vive et les connexions actives ; il a conserve le disque et les journaux centralises', 'Il a tout perdu : un redemarrage efface aussi les fichiers du disque, y compris ceux que l\'attaquant a deposes', 'Il n\'a rien perdu : les journaux gardent trace de tout, y compris du contenu de la memoire vive au moment du reboot', 'Il a perdu les journaux, mais conserve la memoire vive intacte, puisque celle-ci survit aux redemarrages ordinaires' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Le redemarrage n\'ecrit pas sur tout le disque. Que reste-t-il ?',
							'explanation' => 'Le redemarrage efface l\'etat volatil — processus, connexions, memoire — mais laisse le disque en place, donc les journaux locaux, l\'historique et les fichiers supprimes. Les journaux deja transmis a un serveur central sont hors de portee de l\'attaquant, et survivent meme si les journaux locaux ont ete nettoyes.',
						),
						array(
							'question'    => 'Sur une machine Linux compromise, tu veux lister les connexions reseau actives. Pourquoi ne pas lancer <code>netstat</code> depuis cette machine ?',
							'mode'        => 'choice',
							'topic'       => '4.7',
							'choices'     => array( 'Parce qu\'un rootkit peut falsifier la sortie de l\'outil : on travaille depuis un support externe maitrise', 'Parce que netstat n\'existe pas sur les systemes compromis, l\'attaquant le supprime des son arrivee sur la machine', 'Parce que netstat modifie les fichiers qu\'il lit, et efface donc les traces de connexion au passage, ce qui rend la preuve inutilisable', 'Parce que netstat ne fonctionne qu\'en mode graphique, et qu\'un serveur compromis n\'a generalement pas d\'interface graphique installee' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'A qui appartient le programme que tu lances ?',
							'explanation' => 'La RFC 3227 le dit sans detour : « don\'t trust the programs on the system ». Un attaquant qui a les droits root peut remplacer <code>netstat</code>, <code>ps</code> ou <code>ls</code> par une version qui cache sa presence. On execute donc les outils de collecte depuis un media protege, jamais depuis la machine suspecte.',
						),
					),
				),
				array(
					'type'       => 'test',
					'format'     => 'pratique',
					'title'  => 'Task 3 : La mission — reconstituer la chronologie',
					'content'=> '<p><strong>Mission.</strong> Le journal de collecte de l\'incident est sur la machine de l\'atelier. Il a ete rempli par l\'administrateur <em>apres</em> son redemarrage, dans le desordre, et il ne note pas les horodatages en UTC.</p><p>Trouve l\'<strong>heure exacte du redemarrage</strong>, telle qu\'elle est ecrite dans le journal (format <code>HH:MM</code>), et note-la : c\'est elle qui separe ce qui a ete observe de ce qui a ete detruit.</p>',
					'questions' => array(
						array(
							'question'    => 'A quelle heure le serveur a-t-il ete redemarre, d\'apres le journal de collecte ?',
							'mode'        => 'text',
							'topic'       => '4.7',
							'answers'     => array( '/14:07/', '/14h07/' ),
							'xp'          => 40,
							'hint'        => 'Dans le terminal : <code>cat /srv/atelier/journal-collecte.md</code>. Cherche la ligne qui decrit l\'arret du service, puis celle qui decrit son retour.',
							'explanation' => 'Le redemarrage est a 14:07. Tout ce qui precede cette heure decrit ce qui a ete observe avant la perte de l\'etat volatil ; tout ce qui suit decrit une machine dont la memoire a deja ete videe. Le journal le dit lui-meme : les connexions actives relevees a 14:12 ne sont pas celles de l\'attaque, mais celles d\'apres le redemarrage — et les presenter comme des preuves serait une faute d\'interpretation.',
						),
					),
					'terminal' => array(
						'intro'   => 'forensique@atelier:~$ ',
						'unknown' => 'Cette commande ne donne rien ici.',
						'success' => 'Journal lu. Tu peux repondre a la question.',
						'steps'   => array(
							array(
								'match'  => array( 'ls /srv/atelier', '/^ls .*atelier/', '/^ls$/' ),
								'output' => 'journal-collecte.md
proces-verbaux.txt
',
								'hint'   => 'Le journal de collecte est un fichier markdown dans /srv/atelier.',
							),
							array(
								'match'  => array( 'cat /srv/atelier/journal-collecte.md', '/cat .*journal.*\\.md/' ),
								'output' => '# Journal de collecte — incident du 12/09
Recueilli par : A. Diallo (administrateur systeme)
Fuseau : local (UTC+1), non converti

| heure | ce qui a ete fait | par qui |
|-------|-------------------|---------|
| 13:52 | alerte : requetes anormales sur /admin | supervision |
| 13:58 | connexion SSH de l\'administrateur | A. Diallo |
| 14:02 | service web arrete (systemctl stop) | A. Diallo |
| 14:07 | redemarrage de la machine | A. Diallo |
| 14:12 | releve des connexions actives avec netstat | A. Diallo |
| 14:31 | journaux applicatifs copies sur cle USB | A. Diallo |
| 15:40 | image disque demandee a l\'equipe | A. Diallo |
',
								'hint'   => 'Les heures sont en heure locale, non converties en UTC : c\'est une faute de methode a noter.',
							),
							array(
								'match'  => array( 'cat /srv/atelier/proces-verbaux.txt', '/cat .*proces/' ),
								'output' => 'Proces-verbaux — remarques du relecteur

1. Le releve des connexions a 14:12 decrit l\'etat d\'APRES le redemarrage.
2. La memoire vive n\'a jamais ete capturee.
3. Les journaux applicatifs ont ete copies sur une cle USB non chiffree.
4. Aucun horodatage n\'est converti en UTC.
',
								'hint'   => 'Le relecteur a deja note quatre defauts : lesquels detruisent une preuve ?',
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
							'question'    => 'Quel est l\'ordre correct de collecte des preuves ?',
							'mode'        => 'choice',
							'topic'       => '4.7',
							'choices'     => array( 'Memoire vive, donnees temporaires, disque, journaux centralises, configuration physique, archives', 'Disque, memoire vive, archives, journaux centralises, configuration physique : c\'est l\'ordre alphabetique, le plus simple a retenir', 'Archives, disque, memoire vive, journaux centralises, configuration physique : on commence par ce qui est le plus facile a copier', 'Journaux centralises, disque, memoire vive, archives, configuration physique : les journaux d\'abord, puisqu\'ils sont deja externalises' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'On va du plus volatil au moins volatil. L\'ordre inverse — commencer par ce qui est stable — fait perdre tout ce qui etait en memoire, qu\'aucune manipulation ulterieure ne pourra reconstituer.',
						),
						array(
							'question'    => 'Un attaquant a pu laisser un mecanisme qui efface les preuves des que la machine perd le reseau. Que cela change-t-il ?',
							'mode'        => 'choice',
							'topic'       => '4.7',
							'choices'     => array( 'L\'isolement reseau reste souhaitable mais doit etre decide en connaissance de cause, pas par reflexe', 'Il ne faut jamais isoler une machine compromise, dans aucun cas, parce que l\'isolement detruit les connexions en cours', 'Le mecanisme n\'existe pas, c\'est une legende : aucune machine ne peut s\'eteindre seule faute de nouvelles', 'Il faut eteindre la machine avant de l\'isoler, sinon l\'isolement reseau n\'a aucun effet sur les processus en cours' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'La RFC 3227 signale ce cas precis. L\'isolement protege l\'organisation d\'une propagation, mais peut declencher un effacement. La bonne pratique est de capturer l\'etat volatil d\'abord, puis d\'isoler en sachant ce qu\'on risque. Eteindre aggrave toujours la perte.',
						),
						array(
							'question'    => 'Pourquoi horodater les preuves en UTC plutot qu\'en heure locale ?',
							'mode'        => 'choice',
							'topic'       => '4.7',
							'choices'     => array( 'Parce qu\'une heure locale ne se compare pas a celle d\'une autre machine ou d\'un autre fuseau', 'Parce que l\'UTC est plus precis a la seconde que l\'heure locale, et que l\'analyse forensique exige une precision a la seconde', 'Parce que les systemes d\'exploitation ne savent pas ecrire l\'heure locale, ils n\'ont que l\'UTC en interne', 'Parce que l\'UTC est obligatoire dans tous les pays, et qu\'une heure locale expose a une amende en cas de litige' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Un incident implique plusieurs machines, souvent plusieurs fuseaux, et parfois un changement d\'heure. Une chronologie en heure locale devient illisible ou fausse. La RFC 3227 demande de noter l\'ecart entre l\'horloge du systeme et l\'UTC, et d\'indiquer pour chaque horodatage lequel est utilise.',
						),
						array(
							'question'    => 'Un rapport d\'incident conclut que « les connexions actives relevees apres le redemarrage prouvent la persistance de l\'attaquant ». Quelle est l\'erreur ?',
							'mode'        => 'choice',
							'topic'       => '4.7',
							'choices'     => array( 'Ces connexions datent d\'apres la perte de l\'etat volatil : elles ne prouvent rien sur ce qui existait avant', 'Aucune : un releve de connexions est toujours une preuve fiable, a condition qu\'il ait ete fait par un administrateur', 'L\'erreur est de ne pas avoir utilise un autre outil que netstat, par exemple ss, qui aurait donne la bonne liste', 'L\'erreur est de ne pas avoir converti l\'heure en UTC, ce qui rend le releve difficile a comparer a celui du pare-feu' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Une preuve vaut par ce qu\'elle peut montrer, et son horodatage dit ce qu\'elle ne peut pas montrer. Un releve posterieur au redemarrage decrit une machine neuve : il ne dit rien de l\'etat compromis. C\'est le defaut le plus frequent des rapports d\'incident — conclure d\'une observation posterieure a la destruction de l\'etat anterieur.',
						),
					),
				),
			),
			'i18n'       => array(
				'en' => array(
					'title'   => 'The incident that started with a reboot',
					'excerpt' => 'A server is compromised. The administrator reboots it to start clean. You must explain what he just destroyed, and in which order he should have proceeded.',
					'tasks'   => array(
						array(
							'title'  => 'Task 1: The order of volatility, and why it governs everything',
							'content'=> '<p>Digital evidence is not a stable object: it fades. Some of it disappears when the power is cut, some survives for years on a disk. NIST SP 800-86 and RFC 3227 say the same thing: you collect <strong>from the most volatile to the least volatile</strong>. Reversing that order means losing what can never be rebuilt.</p><p>The order of volatility, from the most fragile to the most stable:</p><ol><li><strong>live memory and system state</strong>: running processes, established network connections, encryption keys held in memory, fileless malware. A shutdown erases all of it for good;</li><li><strong>temporary data</strong>: temporary files, caches, page files;</li><li><strong>the disk</strong>: system logs, history, deleted-but-not-overwritten files;</li><li><strong>centralised logs</strong>: the ones already shipped to a collection server, away from the compromised machine;</li><li><strong>physical configuration and topology</strong>: what is plugged in where, and how;</li><li><strong>archival media</strong>: backups, tapes, reference images.</li></ol><p>Three gestures destroy evidence, and all three feel natural:</p><ul><li><strong>shutting down or rebooting</strong> — live memory is gone, and the attacker may have edited shutdown scripts to wipe traces;</li><li><strong>clearing logs "to start clean"</strong> — this destroys the only record of the timeline;</li><li><strong>running tools from the compromised machine</strong> — a rootkit can lie about what the tool displays. Work from a controlled external medium.</li></ul><p><strong>A point RFC 3227 adds, and it surprises people:</strong> disconnecting the machine from the network may trigger a mechanism planted by the attacker that wipes everything as soon as it loses connectivity (a "deadman switch"). Isolation is still the right action in most cases, but it is a decision, not a reflex.</p><p><strong>Remember:</strong> the question is not "which tool do I run", but "what disappears if I wait an hour". That question comes before touching anything.</p>',
							'questions' => array(),
						),
						array(
							'title'  => 'Task 2: Practice — three decisions to make',
							'content'=> '<p>Three real situations. Each time: what is the right first action?</p>',
							'questions' => array(
								array(
									'question'    => 'A web server has just been compromised. It is still running, and the attacker may still have a session open. Which evidence must be captured first?',
									'choices'     => array( 'Live memory and active network connections, before any shutdown', 'A full disk image, because it is the most complete evidence and the fastest one to obtain in an emergency', 'Application logs, because they tell the whole story of the attack from beginning to end', 'A screenshot of the desktop, to keep a visual record of the machine\'s state at the time' ),
									'correct'     => 0,
									'hint'        => 'What disappears if the machine powers off in a minute?',
									'explanation' => 'Live memory holds running processes, established connections, keys and sometimes malware that exists nowhere on disk. The disk will still be there tomorrow: it is captured afterwards. This is exactly the mistake the administrator makes when rebooting.',
								),
								array(
									'question'    => 'The administrator rebooted the compromised server "to start clean". What did he lose, and what did he keep?',
									'choices'     => array( 'He lost live memory and active connections; he kept the disk and the centralised logs', 'He lost everything: a reboot also erases the files on disk, including the ones the attacker dropped there', 'He lost nothing: logs record everything, including the content of live memory at the time of the reboot', 'He lost the logs, but kept live memory intact, since memory survives an ordinary reboot' ),
									'correct'     => 0,
									'hint'        => 'A reboot does not write over the whole disk. What remains?',
									'explanation' => 'The reboot wipes volatile state — processes, connections, memory — but leaves the disk in place, hence local logs, history and deleted files. Logs already forwarded to a central server are out of the attacker\'s reach, and survive even if local logs were cleared.',
								),
								array(
									'question'    => 'On a compromised Linux machine, you want to list active network connections. Why not run <code>netstat</code> from that machine?',
									'choices'     => array( 'Because a rootkit can falsify the tool\'s output: work from a controlled external medium', 'Because netstat does not exist on compromised systems: the attacker removes it as soon as they land', 'Because netstat modifies the files it reads, and therefore wipes the connection traces as it goes', 'Because netstat only works in a graphical interface, and a compromised server rarely has one installed' ),
									'correct'     => 0,
									'hint'        => 'Who owns the program you are running?',
									'explanation' => 'RFC 3227 puts it bluntly: "don\'t trust the programs on the system". An attacker with root can replace <code>netstat</code>, <code>ps</code> or <code>ls</code> with a version that hides their presence. Collection tools therefore run from protected media, never from the suspect machine.',
								),
							),
						),
						array(
							'title'  => 'Task 3: Mission — rebuild the timeline',
							'content'=> '<p><strong>Mission.</strong> The incident collection log is on the workshop machine. It was filled in by the administrator <em>after</em> the reboot, out of order, and timestamps are not recorded in UTC.</p><p>Find the <strong>exact time of the reboot</strong> as written in the log (format <code>HH:MM</code>): it is what separates what was observed from what was destroyed.</p>',
							'questions' => array(
								array(
									'question'    => 'At what time was the server rebooted, according to the collection log?',
									'answers'     => array( '/14:07/', '/14h07/' ),
									'hint'        => 'In the terminal: <code>cat /srv/atelier/journal-collecte.md</code>. Look for the line describing the service stop, then the one describing its return.',
									'explanation' => 'The reboot is at 14:07. Everything before that hour describes what was observed before the loss of volatile state; everything after describes a machine whose memory had already been wiped. The log says so itself: the active connections listed at 14:12 are not the attacker\'s, but those after the reboot — presenting them as evidence would be a misinterpretation.',
								),
							),
						),
						array(
							'title'  => 'Task 4: End-of-room exam',
							'content'=> '<p>Four questions, 8 minutes, 80% threshold. No hints.</p>',
							'questions' => array(
								array(
									'question'    => 'What is the correct order of evidence collection?',
									'choices'     => array( 'Live memory, temporary data, disk, centralised logs, physical configuration, archives', 'Disk, live memory, archives, centralised logs, physical configuration: alphabetical order, the easiest one to remember', 'Archives, disk, live memory, centralised logs, physical configuration: start with what is easiest to copy', 'Centralised logs, disk, live memory, archives, physical configuration: logs first, since they are already external' ),
									'correct'     => 0,
									'explanation' => 'You go from the most volatile to the least. The reverse order — starting with what is stable — loses everything held in memory, which no later manipulation can rebuild.',
								),
								array(
									'question'    => 'An attacker may have planted a mechanism that wipes evidence as soon as the machine loses network access. What does that change?',
									'choices'     => array( 'Network isolation remains desirable but must be a deliberate decision, not a reflex', 'A compromised machine must never be isolated, in any case, because isolation destroys the connections in progress', 'The mechanism does not exist, it is a myth: no machine can switch itself off for lack of news', 'The machine must be shut down before being isolated, otherwise network isolation has no effect on running processes' ),
									'correct'     => 0,
									'explanation' => 'RFC 3227 flags this very case. Isolation protects the organisation from spread, but may trigger a wipe. Best practice is to capture volatile state first, then isolate knowing the risk. Shutting down always worsens the loss.',
								),
								array(
									'question'    => 'Why timestamp evidence in UTC rather than local time?',
									'choices'     => array( 'Because a local time cannot be compared with that of another machine or time zone', 'Because UTC is more accurate to the second than local time, and forensic analysis requires second-level accuracy', 'Because operating systems cannot write local time at all: internally they only keep UTC', 'Because UTC is mandatory in every country, and a local time exposes you to a fine in case of litigation' ),
									'correct'     => 0,
									'explanation' => 'An incident involves several machines, often several time zones, and sometimes a daylight-saving change. A timeline in local time becomes unreadable or wrong. RFC 3227 asks you to record the offset between the system clock and UTC, and to state which one each timestamp uses.',
								),
								array(
									'question'    => 'An incident report concludes that "active connections observed after the reboot prove the attacker\'s persistence". What is the error?',
									'choices'     => array( 'Those connections date from after the loss of volatile state: they prove nothing about what existed before', 'None: a connection listing is always reliable evidence, as long as an administrator produced it from the console', 'The error is not using a tool other than netstat, for instance ss, which would have returned the right list of sockets', 'The error is not converting the time to UTC, which makes the listing hard to compare with the firewall\'s own logs' ),
									'correct'     => 0,
									'explanation' => 'Evidence is worth what it can show, and its timestamp says what it cannot show. A listing made after the reboot describes a fresh machine: it says nothing about the compromised state. This is the most common flaw in incident reports — concluding from an observation made after the earlier state was destroyed.',
								),
							),
						),
					),
				),
			),
		),
		array(
			'title'       => 'L\'automatisation qui a bloque la moitie du reseau',
			'excerpt'     => 'Une regle automatique isole toute machine qui declenche une alerte. Un soir, elle isole 40 postes, dont ceux de l\'equipe d\'astreinte. Tu dois decider ce que l\'automate avait le droit de faire seul.',
			'content'     => 'Automatiser une reponse, c\'est decider a l\'avance, sans le contexte du moment. Cette room t\'apprend a separer ce qui peut etre automatique de ce qui doit rester humain — et ce qu\'il faut mesurer avant de laisser une machine agir.',
			'difficulty'  => 'moyen',
			'duration'   => 30,
			'xp_bonus'   => 60,
			'track'      => 'operations',
			'source'     => array(
				'nom'        => 'NIST SP 800-61 Rev. 3 — Incident Response Recommendations and Considerations',
				'url'        => 'https://csrc.nist.gov/pubs/sp/800/61/r3/final',
				'licence'    => 'Domaine public (publication du NIST, Etats-Unis)',
				'attribution'=> 'NIST Special Publication 800-61 Revision 3 (avril 2025), Incident Response Recommendations and Considerations for Cybersecurity Risk Management',
			),
			'tasks'      => array(
				array(
					'type'       => 'lesson',
					'format'     => 'lecon',
					'title'  => 'Task 1 : Ce qu\'un automate peut decider, et ce qu\'il ne peut pas',
					'content'=> '<p><strong>SOAR</strong> veut dire <em>Security Orchestration, Automation and Response</em> : enchainer des actions de securite sans qu\'un humain les lance une par une. Le gain est reel — une machine isolee en trois secondes au lieu de quarante minutes. Le risque l\'est aussi, et il tient en une phrase : l\'automate agit <strong>sans le contexte</strong>.</p><p>La question n\'est pas « faut-il automatiser », mais « jusqu\'ou ». Trois criteres permettent de trancher :</p><ol><li><strong>L\'action est-elle reversible ?</strong> Isoler une machine se defait en une commande. Supprimer un compte, ecraser un disque ou envoyer un courriel a un client ne se defont pas. Une action irreversible ne part jamais seule.</li><li><strong>Le faux positif est-il supportable ?</strong> Bloquer une adresse IP externe, oui. Bloquer le compte du directeur financier un soir de cloture, non. Le cout du faux positif doit etre inferieur au gain du vrai positif.</li><li><strong>Que faut-il pour decider ?</strong> Si la decision demande de savoir <em>qui</em> est connecte et <em>pourquoi</em>, elle demande un humain. Un automate ne connait que ce qu\'on lui a donne comme signal.</li></ol><p>Ce qui s\'automatise bien :</p><ul><li><strong>l\'enrichissement</strong> — verifier une adresse IP contre des listes publiques, recuperer l\'historique d\'une alerte, rassembler les journaux d\'une machine ;</li><li><strong>la collecte</strong> — declencher une capture de memoire, copier les journaux vers un serveur central ;</li><li><strong>l\'isolement reversible</strong> — couper le reseau d\'un poste, avec un delai et un moyen de revenir en arriere ;</li><li><strong>la tracabilite</strong> — ouvrir un dossier d\'incident, noter l\'heure, la regle appliquee et la raison.</li></ul><p>Ce qui ne s\'automatise pas sans garde-fou :</p><ul><li>la suppression de donnees ou de comptes ;</li><li>toute action dont l\'effet est visible a l\'exterieur (client, partenaire, autorite) ;</li><li>toute action qui empeche l\'investigation elle-meme — eteindre, effacer, reinitialiser.</li></ul><p>Le NIST SP 800-61 Rev. 3 insiste sur un point qui vaut pour tout automate : <strong>on ne compare pas une action rapide a une action reflechie, on compare une action rapide a une action reflechie dans le meme delai</strong>. Si l\'humain met quarante minutes et que l\'attaque se propage en cinq, l\'automate gagne. S\'il met quarante minutes et que l\'attaque est deja terminee, l\'automate n\'apporte qu\'un risque de faux positif.</p><p><strong>A retenir :</strong> un automate doit pouvoir etre arrete, defait, et explique. Les trois, pas deux sur trois.</p>',
					'questions' => array(),
				),
				array(
					'type'       => 'practice',
					'format'     => 'qcm',
					'title'  => 'Task 2 : Entrainement — trois actions a classer',
					'content'=> '<p>Trois actions proposees par une equipe SOAR. Pour chacune : peut-elle partir sans humain ?</p>',
					'questions' => array(
						array(
							'question'    => 'Regle proposee : « si une alerte de type vol d\'identifiants est levee, desactiver immediatement le compte utilisateur concerne ». Faut-il l\'automatiser sans validation ?',
							'mode'        => 'choice',
							'topic'       => '4.8',
							'choices'     => array( 'Non : la desactivation est reversible mais bloquante, et le faux positif peut paralyser quelqu\'un en pleine astreinte', 'Oui : desactiver un compte est toujours sans consequence, il suffit de le reactiver quand l\'utilisateur se plaint de ne plus pouvoir travailler', 'Oui, a condition de prevenir l\'utilisateur apres coup par courriel, et de lui expliquer pourquoi son compte a ete ferme', 'Non : aucune action de securite ne doit jamais etre automatisee, quelle que soit la situation et quel que soit l\'enjeu' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Que se passe-t-il si l\'alerte est fausse et que la personne est celle qui repond a l\'incident ?',
							'explanation' => 'La desactivation est techniquement reversible, mais son cout en cas d\'erreur est eleve : la personne perd l\'acces a tout, parfois au moment ou on a besoin d\'elle. La bonne conception est une action reversible et graduee — forcer une reinitialisation, reduire les droits, alerter un humain qui decide — pas une coupure nette pilotee par une regle.',
						),
						array(
							'question'    => 'Regle proposee : « si une alerte est levee sur un poste, isoler le poste du reseau pendant 30 minutes, avec retour automatique ». Faut-il l\'automatiser ?',
							'mode'        => 'choice',
							'topic'       => '4.8',
							'choices'     => array( 'Oui : l\'action est reversible, bornee dans le temps, et le retour est prevu', 'Non : isoler un poste detruit forcement des preuves, puisqu\'il coupe les connexions que l\'attaquant avait ouvertes', 'Non : il faut toujours demander l\'accord de l\'utilisateur du poste avant de l\'isoler, meme en pleine attaque', 'Oui, mais seulement si le poste appartient a un administrateur, parce qu\'un administrateur comprendra l\'isolement' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Trois criteres : reversible, borne, defaisable. Combien sont remplis ?',
							'explanation' => 'L\'isolement avec retour automatique remplit les trois conditions : il se defait, il est borne dans le temps, et il laisse la machine allumee — donc la memoire vive intacte. C\'est le cas d\'usage typique d\'une automatisation reussie. Isoler n\'eteint pas : la nuance est celle de la room precedente.',
						),
						array(
							'question'    => 'Regle proposee : « si un fichier est detecte comme malveillant sur un serveur, supprimer le fichier immediatement ». Faut-il l\'automatiser ?',
							'mode'        => 'choice',
							'topic'       => '4.8',
							'choices'     => array( 'Non : supprimer detruit la preuve et empeche de savoir comment le fichier est arrive', 'Oui : un fichier malveillant doit disparaitre le plus vite possible, avant qu\'il ne soit execute une seconde fois', 'Oui, mais seulement apres une analyse antivirus automatique, qui confirmera qu\'il s\'agit bien d\'un fichier hostile', 'Non : il faut d\'abord eteindre le serveur, puis supprimer le fichier une fois la machine hors tension' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Que perds-tu en supprimant le fichier ? Et que gagnes-tu a le garder ?',
							'explanation' => 'Supprimer est irreversible et detruit la piece a conviction : on ne saura plus par quel chemin le fichier est entre, ni s\'il y en a d\'autres. La bonne action automatique est de le <em>mettre en quarantaine</em> — deplacement vers un espace isole, avec empreinte enregistree — et de laisser un humain decider de la suite.',
						),
					),
				),
				array(
					'type'       => 'test',
					'format'     => 'pratique',
					'title'  => 'Task 3 : La mission — lire le journal de l\'automate',
					'content'=> '<p><strong>Mission.</strong> L\'automate a tourne toute la soiree. Son journal est sur la machine de l\'atelier, et il contient la trace de chaque action, avec sa duree et son resultat.</p><p>Trouve <strong>le nombre total de postes isoles</strong> pendant l\'incident, tel qu\'il est ecrit dans le compte rendu (un nombre, en chiffres).</p>',
					'questions' => array(
						array(
							'question'    => 'Combien de postes l\'automate a-t-il isoles pendant l\'incident ?',
							'mode'        => 'text',
							'topic'       => '4.8',
							'answers'     => array( '/\\b40\\b/' ),
							'xp'          => 40,
							'hint'        => 'Dans le terminal : <code>cat /srv/atelier/journal-automate.log</code>, puis compte les lignes dont l\'action est <code>isolement</code>.',
							'explanation' => 'Quarante postes, dont quatre appartiennent a l\'equipe d\'astreinte. Le journal montre aussi que la regle s\'est declenchee sur un motif legitime — une alerte de volume — et que personne n\'a ete prevenu. Ce n\'est pas un bug de l\'automate : c\'est une regle concue sans le critere du faux positif supportable.',
						),
					),
					'terminal' => array(
						'intro'   => 'soar@atelier:~$ ',
						'unknown' => 'Cette commande ne donne rien ici.',
						'success' => 'Journal lu. Tu peux repondre a la question.',
						'steps'   => array(
							array(
								'match'  => array( 'ls /srv/atelier', '/^ls .*atelier/', '/^ls$/' ),
								'output' => 'journal-automate.log
compte-rendu.txt
',
								'hint'   => 'Deux fichiers : le journal brut, et le compte rendu.',
							),
							array(
								'match'  => array( 'cat /srv/atelier/compte-rendu.txt', '/cat .*compte/' ),
								'output' => 'Compte rendu — incident du 12/09, automate SOAR

Declencheur   : alerte de volume sur le proxy (seuil 500 requetes/min)
Debut         : 21:14
Fin           : 22:03
Action        : isolement reseau de 30 minutes, retour automatique
Postes isoles : 40
Dont astreinte: 4 (dont 1 poste de pilotage de l\'automate)
Validation    : aucune (regle en mode automatique)
Cause reelle  : mise a jour applicative poussee sur 40 postes
',
								'hint'   => 'Le compte rendu donne le total, et dit aussi pourquoi c\'etait un faux positif.',
							),
							array(
								'match'  => array( 'cat /srv/atelier/journal-automate.log', '/cat .*journal-automate/' ),
								'output' => '21:14:02 regle=volume-proxy action=declenchement motif=512 req/min
21:14:03 action=isolement poste=PC-0412 duree=30m
21:14:03 action=isolement poste=PC-0413 duree=30m
21:14:04 action=isolement poste=ASTREINTE-01 duree=30m
21:14:04 action=isolement poste=PC-0414 duree=30m
21:14:05 action=alerte envoyee destinataire=courriel-equipe
21:44:03 action=retour poste=PC-0412
21:44:04 action=retour poste=ASTREINTE-01
22:03:11 action=fin motif=quarantaine-levee
',
								'hint'   => 'Le journal detaille trois isolements, mais le compte rendu parle du total : lequel fait foi ?',
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
							'question'    => 'Quel est le critere decisif pour savoir si une action de reponse peut etre automatisee ?',
							'mode'        => 'choice',
							'topic'       => '4.8',
							'choices'     => array( 'Sa reversibilite, et le fait que se tromper coute moins que le gain espere', 'Sa rapidite d\'execution par rapport a un humain, qui met des heures a traiter la meme alerte sans jamais se fatiguer', 'Le nombre d\'alertes qu\'elle traite par jour, bien plus eleve que ce qu\'une equipe d\'analystes peut absorber en vingt-quatre heures', 'La taille de l\'equipe de securite disponible, qui determine ce qu\'il reste a automatiser dans le centre operationnel' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'La rapidite justifie d\'automatiser, mais ce n\'est pas ce qui autorise a le faire. Ce qui autorise, c\'est de pouvoir defaire l\'action, et que se tromper coute moins que le gain. Une action rapide, irreversible et couteuse a rater reste une mauvaise automatisation.',
						),
						array(
							'question'    => 'Une regle isole un poste pendant l\'incident. Deux heures plus tard, l\'analyste decouvre un faux positif. Qu\'est-ce qui aurait du exister dans la conception ?',
							'mode'        => 'choice',
							'topic'       => '4.8',
							'choices'     => array( 'Un delai borne et un retour automatique, plus une trace de la regle et de son motif', 'Une validation humaine avant chaque isolement, sans exception, meme quand l\'alerte est jugee fiable a quatre-vingt-dix-neuf pour cent', 'Un second automate charge de verifier le premier, et de corriger ses decisions avant qu\'elles ne soient appliquees sur le parc', 'Une desactivation complete de l\'automatisation d\'isolement, jusqu\'a la fin de la crise en cours et la revue complete des regles' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Le delai borne et le retour automatique limitent l\'effet d\'une erreur ; la trace permet de comprendre pourquoi la regle s\'est declenchee. Exiger une validation humaine systematique annule le benefice de rapidite et ramene l\'isolement a quarante minutes. Le probleme n\'etait pas l\'automatisation, mais l\'absence de garde-fou.',
						),
						array(
							'question'    => 'Pourquoi la mise en quarantaine est-elle preferee a la suppression d\'un fichier detecte comme malveillant ?',
							'mode'        => 'choice',
							'topic'       => '4.8',
							'choices'     => array( 'Parce qu\'elle conserve la preuve et permet de comprendre le vecteur d\'entree', 'Parce que la suppression est techniquement impossible sur un serveur allume, le fichier est verrouille par le noyau jusqu\'au redemarrage', 'Parce qu\'un fichier en quarantaine ne peut plus s\'executer, alors qu\'un fichier supprime peut tres bien etre depose de nouveau par l\'attaquant', 'Parce qu\'une suppression laisse une entree dans le journal d\'audit, entree que l\'attaquant peut lire pour savoir ce qui a ete detecte' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Les deux empechent l\'execution. La difference est epistemique : un fichier supprime ne dira plus rien du chemin par lequel il est arrive, alors qu\'un fichier en quarantaine, avec son empreinte, permet de chercher les autres machines touchees. On ne detruit pas ce qu\'on n\'a pas encore compris.',
						),
						array(
							'question'    => 'Un automate de reponse peut-il eteindre une machine compromise pour arreter une propagation ?',
							'mode'        => 'choice',
							'topic'       => '4.8',
							'choices'     => array( 'Non : l\'extinction detruit l\'etat volatil, il faut isoler du reseau sans eteindre', 'Oui : c\'est la seule facon d\'arreter une propagation active, l\'isolement reseau laissant le verrou continuer en local', 'Oui, a condition que l\'extinction soit journalisee et rejouee plus tard dans un environnement de test', 'Non : aucune action automatique ne doit toucher a une machine, l\'extinction doit rester une decision humaine' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Isoler coupe la propagation sans perdre la memoire vive. Eteindre fait les deux a la fois : on arrete l\'attaque et on detruit ce qui permettrait de la comprendre. C\'est le meme principe que la room de forensique — la preuve la plus fragile se lit avant de couper quoi que ce soit.',
						),
					),
				),
			),
			'i18n'       => array(
				'en' => array(
					'title'   => 'The automation that cut off half the network',
					'excerpt' => 'An automatic rule isolates any machine that triggers an alert. One evening it isolates 40 workstations, including the on-call team\'s. You must decide what the automaton was allowed to do on its own.',
					'tasks'   => array(
						array(
							'title'  => 'Task 1: What an automaton may decide, and what it may not',
							'content'=> '<p><strong>SOAR</strong> stands for <em>Security Orchestration, Automation and Response</em>: chaining security actions without a human launching them one by one. The gain is real — a machine isolated in three seconds instead of forty minutes. The risk is too, and it fits in one sentence: the automaton acts <strong>without the context</strong>.</p><p>The question is not whether to automate, but how far. Three criteria settle it:</p><ol><li><strong>Is the action reversible?</strong> Isolating a machine is undone with one command. Deleting an account, wiping a disk or emailing a customer is not. An irreversible action never runs alone.</li><li><strong>Is the false positive bearable?</strong> Blocking an external IP address, yes. Blocking the finance director\'s account on a closing evening, no. The cost of a false positive must be lower than the gain of a true one.</li><li><strong>What does deciding require?</strong> If it requires knowing <em>who</em> is connected and <em>why</em>, it requires a human. An automaton only knows the signal it was given.</li></ol><p>What automates well:</p><ul><li><strong>enrichment</strong> — checking an IP address against public lists, pulling the history of an alert, gathering a machine\'s logs;</li><li><strong>collection</strong> — triggering a memory capture, copying logs to a central server;</li><li><strong>reversible isolation</strong> — cutting a workstation off the network, with a time bound and a way back;</li><li><strong>traceability</strong> — opening an incident record, noting the time, the rule applied and the reason.</li></ul><p>What does not automate without a guardrail:</p><ul><li>deleting data or accounts;</li><li>any action visible outside (customer, partner, authority);</li><li>any action that prevents the investigation itself — shutting down, erasing, resetting.</li></ul><p>NIST SP 800-61 Rev. 3 makes a point that holds for every automaton: <strong>you do not compare a fast action with a considered one, you compare a fast action with a considered one taken within the same delay</strong>. If the human takes forty minutes and the attack spreads in five, the automaton wins. If it takes forty minutes and the attack is already over, the automaton adds only the risk of a false positive.</p><p><strong>Remember:</strong> an automaton must be stoppable, undoable and explainable. All three, not two out of three.</p>',
							'questions' => array(),
						),
						array(
							'title'  => 'Task 2: Practice — three actions to classify',
							'content'=> '<p>Three actions proposed by a SOAR team. For each: can it run without a human?</p>',
							'questions' => array(
								array(
									'question'    => 'Proposed rule: "if a credential-theft alert is raised, immediately disable the account concerned". Should it be automated without approval?',
									'choices'     => array( 'No: disabling is reversible but blocking, and a false positive can paralyse someone mid-shift', 'Yes: disabling an account is always harmless, it is simply re-enabled when the user complains about the lockout', 'Yes, provided the user is notified afterwards by email and told why the account was closed', 'No: no security action should ever be automated, whatever the situation and whatever is at stake' ),
									'correct'     => 0,
									'hint'        => 'What happens if the alert is wrong and that person is the one responding to the incident?',
									'explanation' => 'Disabling is technically reversible, but its cost when wrong is high: the person loses access to everything, sometimes exactly when they are needed. Good design is a reversible, graded action — force a reset, reduce rights, alert a human who decides — not a clean cut driven by a rule.',
								),
								array(
									'question'    => 'Proposed rule: "if an alert is raised on a workstation, isolate it from the network for 30 minutes, with automatic return". Should it be automated?',
									'choices'     => array( 'Yes: the action is reversible, time-bounded, and the return is planned', 'No: isolating a workstation necessarily destroys evidence, since it cuts the connections the attacker had opened', 'No: the workstation user\'s consent must always be requested before isolating it, even during an active attack', 'Yes, but only if the workstation belongs to an administrator, because an administrator will understand' ),
									'correct'     => 0,
									'hint'        => 'Three criteria: reversible, bounded, undoable. How many are met?',
									'explanation' => 'Isolation with automatic return meets all three: it is undone, it is time-bounded, and it leaves the machine powered on — hence live memory intact. This is the typical successful automation. Isolating does not shut down: that nuance is the previous room\'s.',
								),
								array(
									'question'    => 'Proposed rule: "if a file is detected as malicious on a server, delete the file immediately". Should it be automated?',
									'choices'     => array( 'No: deleting destroys the evidence and prevents finding out how the file got there', 'Yes: a malicious file must disappear as fast as possible, before it gets executed a second time', 'Yes, but only after an automatic antivirus analysis that confirms the file is indeed hostile', 'No: the server must first be shut down, then the file deleted once the machine is powered off' ),
									'correct'     => 0,
									'hint'        => 'What do you lose by deleting the file? What do you gain by keeping it?',
									'explanation' => 'Deleting is irreversible and destroys the exhibit: you will no longer know by which path the file entered, nor whether others exist. The right automatic action is to <em>quarantine</em> it — move it to an isolated space, record its hash — and let a human decide what comes next.',
								),
							),
						),
						array(
							'title'  => 'Task 3: Mission — read the automaton\'s log',
							'content'=> '<p><strong>Mission.</strong> The automaton ran all evening. Its log is on the workshop machine, and it records every action, with its duration and outcome.</p><p>Find <strong>the total number of workstations isolated</strong> during the incident, as written in the report (a number, in digits).</p>',
							'questions' => array(
								array(
									'question'    => 'How many workstations did the automaton isolate during the incident?',
									'answers'     => array( '/\\b40\\b/' ),
									'hint'        => 'In the terminal: <code>cat /srv/atelier/journal-automate.log</code>, then count the lines whose action is <code>isolement</code>.',
									'explanation' => 'Forty, four of which belong to the on-call team. The log also shows the rule fired on a legitimate pattern — a volume alert — and that nobody was notified. This is not a bug in the automaton: it is a rule designed without the bearable-false-positive criterion.',
								),
							),
						),
						array(
							'title'  => 'Task 4: End-of-room exam',
							'content'=> '<p>Four questions, 8 minutes, 80% threshold. No hints.</p>',
							'questions' => array(
								array(
									'question'    => 'What is the decisive criterion for deciding whether a response action may be automated?',
									'choices'     => array( 'Its reversibility and the cost of its false positive', 'Its execution speed compared with a human, who takes hours to handle the same alert', 'The number of alerts it handles per day, higher than what a team can absorb', 'The size of the available security team, which determines what is left to automate' ),
									'correct'     => 0,
									'explanation' => 'Speed justifies automating, but it is not what permits it. What permits it is being able to undo the action, and that being wrong costs less than the gain. A fast, irreversible, expensive-to-get-wrong action remains a bad automation.',
								),
								array(
									'question'    => 'A rule isolates a workstation during the incident. Two hours later, the analyst finds a false positive. What should the design have included?',
									'choices'     => array( 'A bounded delay and automatic return, plus a record of the rule and its reason', 'Human approval before every isolation, without exception, even when the alert is very reliable', 'A second automaton to check the first, and correct its decisions before they are applied', 'A complete disabling of isolation automation, until the current crisis is over and a review has been done' ),
									'correct'     => 0,
									'explanation' => 'The bounded delay and automatic return limit the effect of an error; the record explains why the rule fired. Requiring systematic human approval cancels the speed benefit and brings isolation back to forty minutes. The problem was not automation, but the absence of a guardrail.',
								),
								array(
									'question'    => 'Why is quarantining preferred to deleting a file detected as malicious?',
									'choices'     => array( 'Because it preserves the evidence and allows the entry vector to be understood', 'Because it is faster to execute, and speed is what matters most during containment', 'Because deletion is technically impossible on a running server, the file is locked by the kernel', 'Because a quarantined file cannot run, unlike a deleted one that the attacker may drop again later' ),
									'correct'     => 0,
									'explanation' => 'Both prevent execution. The difference is epistemic: a deleted file says nothing more about how it arrived, whereas a quarantined file, with its hash, lets you hunt for the other affected machines. You do not destroy what you have not yet understood.',
								),
								array(
									'question'    => 'May a response automaton shut down a compromised machine to stop a spread?',
									'choices'     => array( 'No: shutting down destroys volatile state; isolate from the network without powering off', 'Yes: it is the only way to stop an active spread, and network isolation would leave the worm running locally', 'Yes, provided the shutdown is logged and replayed later in a test environment', 'No: no automatic action may touch a machine, shutting down must remain a human decision' ),
									'correct'     => 0,
									'explanation' => 'Isolating cuts the spread without losing live memory. Shutting down does both at once: it stops the attack and destroys what would allow understanding it. Same principle as the forensics room — the most fragile evidence is read before anything is cut.',
								),
							),
						),
					),
				),
			),
		),
	);
}
