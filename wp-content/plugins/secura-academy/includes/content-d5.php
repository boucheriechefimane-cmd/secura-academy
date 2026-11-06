<?php
/**
 * D5 — Gouvernance, risque et conformite : les trois rooms manquantes.
 *
 * POURQUOI CES ROOMS EXISTENT
 * ---------------------------
 * Mesure du 6 novembre 2026 : le domaine D5 « Gouvernance et gestion du
 * programme » pesait 20 % du score Security+ et n'etait couvert qu'a
 * 30 %. Les sujets 5.3 (risque lie aux tiers) et 5.5 (sensibilisation)
 * n'existaient pas du tout.
 *
 * Le choix de conception est deliberé : ce ne sont pas des rooms de
 * lecture. Une gouvernance s'apprend en AUDITANT, en LISANT un journal, en
 * questionnant un fournisseur. Chaque room se termine donc par une
 * mission ou l'eleve produit un verdict, pas par un QCM de vocabulaire.
 *
 *   - « Le registre que personne ne lit » (5.2) : on lui donne un registre
 *     de risques reel, et il doit trancher lesquels sont mal traites.
 *   - « Le fournisseur qui repond oui a tout » (5.3) : questionnaire de
 *     due diligence, puis analyse des reponses.
 *   - « L'audit qui ne trouve rien » (5.4) : un audit de complaisance, et
 *     les indices qui le trahissent.
 *
 * Le terminal est SIMULE : ces rooms fonctionnent sans conteneur, donc
 * pour tous les eleves, tout de suite. C'est ce qui les rend utiles.
 *
 * Contenu original, ecrit a partir de notions publiques : NIST SP 800-30
 * (gestion du risque), NIST CSF 2.0, ISO/IEC 27001:2022, RGPD (reglement
 * UE 2016/679). Voir tools/sources-autorisees.json.
 *
 * @package Secura_Academy
 */

defined( 'ABSPATH' ) || exit;

/**
 * Les trois rooms du domaine D5.
 *
 * @return array[]
 */
function seca_default_rooms_d5() {
	return array(
		array(
			'title'      => 'Le registre que personne ne lit',
			'excerpt'    => 'Une entreprise a un registre des risques. Il est complet, range, et faux. A toi de trouver pourquoi.',
			'content'    => 'Un registre des risques mal tenu est plus dangereux qu\'aucun registre : il donne l\'illusion que le risque est gere. Cette room t\'apprend a le lire comme un auditeur.',
			'difficulty' => 'moyen',
			'duration'   => 35,
			'xp_bonus'   => 60,
			'track'      => 'gouvernance',
			'source'     => array(
				'nom'         => 'NIST SP 800-30 Rev.1 — Guide for Conducting Risk Assessments',
				'url'         => 'https://csrc.nist.gov/pubs/sp/800/30/r1/final',
				'licence'     => 'Domaine public (publication du NIST, Etats-Unis)',
				'attribution' => 'NIST Special Publication 800-30 Revision 1, Guide for Conducting Risk Assessments',
			),
			'tasks'      => array(
				array(
					'type'      => 'lesson',
					'format'    => 'lecon',
					'title'     => 'Task 1 : Ce qu\'un registre doit contenir pour servir a quelque chose',
					'content'   => '<p>Un <strong>registre des risques</strong> est un tableau. S\'il est bien tenu, il repond a quatre questions pour chaque ligne, et rien de moins :</p><ol><li><strong>Quel est le risque, en une phrase ?</strong> « Un depart de l\'administrateur laisse les acces actifs » est un risque. « Risque informatique » n\'en est pas un.</li><li><strong>Quelle est la probabilite, et quelle est l\'impact ?</strong> Sur une echelle partagee, sinon la ligne ne se compare pas aux autres.</li><li><strong>Quelle mesure, et qui en est responsable avec quelle date ?</strong> Un risque sans responsable et sans date ne bouge jamais.</li><li><strong>Quel risque residuel reste apres la mesure, et qui l\'accepte ?</strong> C\'est cette derniere colonne qu\'un auditeur regarde en premier.</li></ol><p>Trois diagnostics reviennent dans tous les registres mal tenus :</p><ul><li><strong>le risque orphelin</strong> — aucune mesure, aucun responsable ;</li><li><strong>la mesure fantome</strong> — une mesure est ecrite, mais sans date ni responsable : elle n\'existe pas ;</li><li><strong>l\'acceptation muette</strong> — un risque residuel eleve, et personne pour l\'avoir accepte explicitement.</li></ul><p><strong>A retenir :</strong> un registre sans nom propre et sans date est de la decoration. La difference entre une gouvernance reelle et un document de conformite tient dans ces deux colonnes.</p>',
					'questions' => array(),
				),
				array(
					'type'    => 'practice',
					'format'  => 'qcm',
					'title'   => 'Task 2 : Entrainement — trois lignes a diagnostiquer',
					'content' => '<p>Trois lignes de registre. A chaque fois : quel est le defaut ?</p>',
					'questions' => array(
						array(
							'question'    => 'Ligne A — Risque : « perte de donnees clients ». Probabilite : elevee. Impact : critique. Mesure : « faire des sauvegardes ». Responsable : —. Date : —.',
							'mode'        => 'choice',
							'topic'       => '5.2',
							'choices'     => array( 'Mesure fantome : sans responsable ni date, elle ne sera pas faite', 'Ligne correcte : la mesure est claire et suffisante', 'Probabilite surestimee : il faudrait la baisser a « moyenne »', 'Impact surestime : une perte de donnees n\'est jamais critique' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Qui fera la sauvegarde ? Quand ? Qui verifiera qu\'elle est restaurable ?',
							'explanation' => '« Faire des sauvegardes » n\'est pas une mesure : c\'est une intention. Une mesure dit QUOI, QUI, QUAND et comment on verifie. Sans responsable ni date, rien ne se passe — et le registre donne pourtant l\'impression que le risque est traite.',
						),
						array(
							'question'    => 'Ligne B — Risque : « un stagiaire conserve son acces apres son depart ». Probabilite : moyenne. Impact : eleve. Mesure : desactivation automatique validee le 03/12. Responsable : R. Martin. Risque residuel : faible, accepte par la direction le 20/03.',
							'mode'        => 'choice',
							'topic'       => '5.2',
							'choices'     => array( 'Ligne correcte : les quatre elements sont presents et attribues', 'Risque orphelin : il manque un responsable', 'Acceptation muette : personne n\'a accepte le risque residuel', 'Ligne inutile : un stagiaire ne represente pas un risque' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Verifie les quatre elements : enonce, cotation, mesure attribuee, acceptation du residu.',
							'explanation' => 'Cette ligne est ce qu\'un registre doit etre : le risque est nomme, cote, la mesure a un responsable et une date de validation, et le risque residuel est accepte nommement par la direction. C\'est la ligne de reference.',
						),
						array(
							'question'    => 'Ligne C — Risque : « un fournisseur d\'hebergement subit une fuite ». Probabilite : faible. Impact : critique. Mesure : —. Responsable : —. Risque residuel : critique. Statut : « accepte ».',
							'mode'        => 'choice',
							'topic'       => '5.3',
							'choices'     => array( 'Acceptation muette d\'un risque critique, sans mesure ni signataire', 'Risque orphelin seulement : la cotation est correcte', 'Ligne correcte : accepter un risque est une decision legitime', 'Ligne sans objet : un fournisseur ne peut pas faire fuiter de donnees' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Un risque critique accepte sans nom ni mesure : est-ce une decision, ou un oubli deguise ?',
							'explanation' => 'Accepter un risque critique est possible, mais c\'est une decision qui engage : elle a un signataire, une date, et elle est generalement accompagnee d\'au moins une mesure (chiffrement, clause contractuelle, plan de repli). Ici, il n\'y a rien : le mot « accepte » sert a clore la ligne, pas a decider.',
						),
					),
				),
				array(
					'type'      => 'test',
					'format'    => 'pratique',
					'title'     => 'Task 3 : La mission — auditer le registre de l\'entreprise',
					'content'   => '<p><strong>Mission.</strong> Le registre complet de la societe est sur la machine de l\'atelier. Ouvre-le dans le terminal simule, lis les huit lignes, et applique les trois diagnostics de la lecon.</p><p>Le registre contient une ligne declaree <code>ACCEPTE</code> qui ne devrait pas l\'etre. Trouve son <strong>proprietaire de risque</strong> (la valeur de la colonne <code>proprietaire</code>) : c\'est la preuve que tu as lu la ligne en question et pas une autre. Ecris la reponse exacte, telle qu\'elle apparait.</p>',
					'questions' => array(
						array(
							'question'    => 'Quel est le proprietaire de la ligne ACCEPTE qui aurait du etre refusee ?',
							'mode'        => 'text',
							'topic'       => '5.2',
							'answers'     => array( '/directeur-financier/i', '/finance/i' ),
							'xp'          => 40,
							'hint'        => 'Dans le terminal : <code>cat /srv/atelier/registre-des-risques.md</code>. Cherche les lignes ou le statut est ACCEPTE, puis regarde le risque residuel.',
							'explanation' => 'La ligne R-04 est acceptee par le directeur financier sur un risque residuel CRITIQUE, sans aucune mesure, et sur un sujet — la conformite RGPD — qui n\'est pas de son domaine. Ce n\'est pas une acceptation, c\'est une signature de complaisance : le risque est porte par une personne qui n\'a ni l\'autorite ni la competence pour l\'assumer. Un auditeur relance la decision au niveau de la direction generale.',
						),
					),
					'terminal' => array(
						'intro'   => 'auditeur@atelier:~$ ',
						'unknown' => 'Cette commande ne donne rien ici.',
						'success' => 'Registre lu. Tu peux repondre a la question.',
						'steps'   => array(
							array(
								'match'  => array( 'ls /srv/atelier', '/^ls .*atelier/', '/^ls$/' ),
								'output' => "registre-des-risques.md\npolitique-acces.txt\n",
								'hint'   => 'Le registre est un fichier markdown dans /srv/atelier.',
							),
							array(
								'match'  => array( 'cat /srv/atelier/registre-des-risques.md', '/cat .*registre.*\\.md/' ),
								'output' => "# Registre des risques — SOCA SARL — revue du 14/09\n\n| id | risque | proba | impact | mesure | responsable | echeance | residuel | statut | proprietaire |\n|----|--------|-------|--------|--------|-------------|----------|----------|--------|--------------|\n| R-01 | depart d'un admin, acces actifs | moyenne | eleve | revue trimestrielle des comptes | R. Martin | 2026-10-01 | faible | traite | R. Martin |\n| R-02 | rançongiciel sur le partage | elevee | critique | sauvegardes hors ligne testees le 02/09 | A. Diallo | 2026-09-30 | moyen | traite | A. Diallo |\n| R-03 | phishing sur le service comptable | elevee | eleve | simulation trimestrielle + retour | S. Benali | 2026-11-15 | moyen | en cours | S. Benali |\n| R-04 | non-conformite RGPD sur les donnees RH | moyenne | critique | aucune | aucune | aucune | CRITIQUE | ACCEPTE | directeur-financier |\n| R-05 | prestataire d'hebergement sans clause | moyenne | eleve | clause de notification ajoutee au contrat | direction achats | 2026-08-20 | faible | traite | direction achats |\n| R-06 | poste de dev sans antivirus a jour | elevee | moyen | deploiement EDR en cours | equipe poste de travail | 2026-12-01 | faible | en cours | equipe poste de travail |\n| R-07 | acces WiFi invite partageant le VLAN interne | moyenne | eleve | VLAN dedie cree le 05/09 | reseau | 2026-09-05 | faible | traite | reseau |\n| R-08 | absence de plan de reprise teste | moyenne | critique | test de restauration planifie | direction generale | 2027-01-15 | eleve | en cours | direction generale |\n",
								'hint'   => 'Les lignes ont un statut : traite, en cours, ACCEPTE. Regarde la seule ligne ACCEPTE.',
							),
						),
					),
				),
				array(
					'type'       => 'exam',
					'format'     => 'qcm',
					'title'      => 'Task 4 : Examen de fin de room',
					'content'    => '<p>Quatre questions, 8 minutes, seuil 80 %. Aucun indice : c\'est le moment de verifier que la methode est acquise.</p>',
					'time_limit' => 8,
					'pass_score' => 80,
					'questions'  => array(
						array(
							'question'    => 'Quelle ligne de registre est la plus dangereuse pour l\'organisation ?',
							'mode'        => 'choice',
							'topic'       => '5.2',
							'choices'     => array( 'Un risque critique marque « accepte » sans signataire ni mesure', 'Un risque moyen en cours de traitement avec une echeance', 'Un risque faible deja traite et verifie', 'Un risque eleve avec une mesure et un responsable nomme' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Les trois autres lignes sont maitrisees : quelqu\'un suit le sujet. La premiere donne l\'illusion d\'une decision alors que personne ne porte le risque. C\'est le pire etat possible : ni traite, ni connu de la direction.',
						),
						array(
							'question'    => 'Un risque residuel reste eleve apres application des mesures. Quelle est la seule suite correcte ?',
							'mode'        => 'choice',
							'topic'       => '5.2',
							'choices'     => array( 'Le faire accepter explicitement par un responsable de niveau adequate', 'Le supprimer du registre puisqu\'il a ete traite', 'Le reclasser en risque faible pour alleger le registre', 'Attendre le prochain audit pour en reparler' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Le residu eleve remonte a un niveau qui a l\'autorite de l\'accepter : c\'est une decision, tracee et datee. Le supprimer ou le reclasser est exactement ce que fait une organisation qui veut un registre propre plutot qu\'un risque maitrise.',
						),
						array(
							'question'    => 'Pourquoi la colonne « proprietaire » est-elle plus importante que la colonne « mesure » ?',
							'mode'        => 'choice',
							'topic'       => '5.1',
							'choices'     => array( 'Parce qu\'une mesure sans proprietaire ne sera jamais appliquee ni verifiee', 'Parce que le proprietaire signe le budget de la mesure', 'Parce que la mesure est confidentielle et le proprietaire public', 'Parce qu\'un proprietaire peut appliquer plusieurs mesures a la fois' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'La mesure decrit une intention ; le proprietaire la transforme en engagement avec une date. C\'est la difference entre un document et une gouvernance : sans nom, personne ne rend de comptes.',
						),
						array(
							'question'    => 'Un audit interne trouve zero ecart dans un registre de 40 risques. Quelle conclusion est la plus prudente ?',
							'mode'        => 'choice',
							'topic'       => '5.4',
							'choices'     => array( 'L\'audit lui-meme doit etre questionne : methode, perimetre, independance', 'Le registre est excellent et la gouvernance est maitrisee', 'Il faut ajouter des risques pour rendre le registre credible', 'L\'audit doit etre classe sans suite' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Zero ecart sur 40 risques est un signal sur l\'audit, pas sur la qualite du registre. Les causes habituelles : perimetre trop etroit choisi avec l\'audite, preuves fournies par l\'audite, auditeur sans independance. Un bon audit trouve toujours des ecarts de forme au minimum.',
						),
					),
				),
			),
			'i18n'       => array(
				'en' => array(
					'title'   => 'The register nobody reads',
					'excerpt' => 'A company keeps a risk register. It is complete, tidy, and wrong. Find out why.',
					'tasks'   => array(
						array(
							'title'     => 'Task 1: What a register must contain to be worth anything',
							'content'   => '<p>A <strong>risk register</strong> is a table. If it is well kept, it answers four questions for every line, and nothing less:</p><ol><li><strong>What is the risk, in one sentence?</strong> "An administrator leaving keeps active access" is a risk. "IT risk" is not.</li><li><strong>What is the likelihood, and what is the impact?</strong> On a shared scale, otherwise the line cannot be compared to the others.</li><li><strong>Which measure, owned by whom, by which date?</strong> A risk with no owner and no date never moves.</li><li><strong>What residual risk remains after the measure, and who accepts it?</strong> This is the last column an auditor reads, and the first one they check.</li></ol><p>Three diagnoses recur in every badly kept register:</p><ul><li><strong>the orphan risk</strong> — no measure, no owner;</li><li><strong>the ghost measure</strong> — a measure is written, but with no date and no owner: it does not exist;</li><li><strong>the silent acceptance</strong> — a high residual risk, and nobody who explicitly accepted it.</li></ul><p><strong>Remember:</strong> a register with no name and no date is decoration. The difference between real governance and a compliance document lives in those two columns.</p>',
							'questions' => array(),
						),
						array(
							'title'     => 'Task 2: Practice — three lines to diagnose',
							'content'   => '<p>Three register lines. Each time: what is the flaw?</p>',
							'questions' => array(
								array(
									'question'    => 'Line A — Risk: "loss of customer data". Likelihood: high. Impact: critical. Measure: "take backups". Owner: —. Due date: —.',
									'choices'     => array( 'Ghost measure: with no owner and no date, it will not happen', 'This line is correct: the measure is clear and sufficient', 'Likelihood is overstated: it should be lowered to "medium"', 'Impact is overstated: losing customer data is never critical' ),
									'correct'     => 0,
									'hint'        => 'Who will take the backup? When? Who will check it can be restored?',
									'explanation' => '"Take backups" is not a measure, it is an intention. A measure says WHAT, WHO, WHEN, and how it is verified. With no owner and no date, nothing happens — yet the register looks like the risk is handled.',
								),
								array(
									'question'    => 'Line B — Risk: "an intern keeps access after leaving". Likelihood: medium. Impact: high. Measure: automatic deprovisioning, validated 03/12. Owner: R. Martin. Residual: low, accepted by management on 20/03.',
									'choices'     => array( 'This line is correct: all four elements are present and assigned', 'Orphan risk: it is missing an owner', 'Silent acceptance: nobody accepted the residual risk', 'Pointless line: an intern is not a risk' ),
									'correct'     => 0,
									'hint'        => 'Check the four elements: statement, scoring, assigned measure, acceptance of the residual.',
									'explanation' => 'This line is what a register should be: the risk is named, scored, the measure has an owner and a validation date, and the residual risk is accepted by name. This is the reference line.',
								),
								array(
									'question'    => 'Line C — Risk: "hosting provider suffers a breach". Likelihood: low. Impact: critical. Measure: —. Owner: —. Residual: critical. Status: "accepted".',
									'choices'     => array( 'Silent acceptance of a critical risk, with no measure and no signatory', 'Orphan risk only: the scoring is correct', 'This line is correct: accepting a risk is a legitimate decision', 'Pointless line: a provider cannot leak data' ),
									'correct'     => 0,
									'hint'        => 'A critical risk accepted with no name and no measure: is that a decision, or a disguised omission?',
									'explanation' => 'Accepting a critical risk is possible, but it is a decision that commits someone: it has a signatory, a date, and is usually backed by at least one measure (encryption, contractual clause, fallback plan). Here there is nothing: "accepted" closes the line instead of deciding it.',
								),
							),
						),
						array(
							'title'     => 'Task 3: The mission — audit the company register',
							'content'   => '<p><strong>Mission.</strong> The company\'s full register is on the workshop machine. Open it in the simulated terminal, read the eight lines, and apply the three diagnoses from the lesson.</p><p>The register contains a line marked <code>ACCEPTE</code> (accepted) that should never have been. Find its <strong>risk owner</strong> (the value in the <code>proprietaire</code> column): that is the proof you read that specific line and not another. Type the exact answer as it appears.</p>',
							'questions' => array(
								array(
									'question'    => 'Who is the owner of the "ACCEPTED" line that should have been rejected?',
									'hint'        => 'In the terminal: <code>cat /srv/atelier/registre-des-risques.md</code>. Find the ACCEPTE lines, then look at the residual risk.',
									'explanation' => 'Line R-04 is accepted by the finance director on a CRITICAL residual risk, with no measure at all, on a subject — GDPR compliance — that is not their domain. That is not an acceptance, it is a courtesy signature: the risk is carried by someone with neither the authority nor the competence to own it. An auditor sends the decision back to executive level.',
								),
							),
						),
						array(
							'title'     => 'Task 4: End-of-room exam',
							'content'   => '<p>Four questions, 8 minutes, pass mark 80%. No hints: this is where you check the method is in place.</p>',
							'questions' => array(
								array(
									'question'    => 'Which register line is the most dangerous for the organisation?',
									'choices'     => array( 'A critical risk marked "accepted" with no signatory and no measure', 'A medium risk being handled with a due date', 'A low risk already treated and verified', 'A high risk with a measure and a named owner' ),
									'correct'     => 0,
									'explanation' => 'The other three lines are under control: someone is following them. The first creates the illusion of a decision while nobody carries the risk. It is the worst possible state: neither treated nor known to management.',
								),
								array(
									'question'    => 'A residual risk stays high after the measures are applied. What is the only correct next step?',
									'choices'     => array( 'Have it explicitly accepted by someone at the right level', 'Delete it from the register since it has been treated', 'Reclassify it as low to keep the register short', 'Wait for the next audit to discuss it' ),
									'correct'     => 0,
									'explanation' => 'A high residual goes to someone with the authority to accept it: a decision, traced and dated. Deleting or reclassifying is exactly what an organisation does when it wants a tidy register rather than a managed risk.',
								),
								array(
									'question'    => 'Why is the "owner" column more important than the "measure" column?',
									'choices'     => array( 'Because a measure with no owner is never applied or verified', 'Because the owner signs the budget for the measure', 'Because the measure is confidential and the owner is public', 'Because one owner can apply several measures at once' ),
									'correct'     => 0,
									'explanation' => 'The measure describes an intention; the owner turns it into a commitment with a date. That is the difference between a document and governance: with no name, nobody is accountable.',
								),
								array(
									'question'    => 'An internal audit finds zero findings in a register of 40 risks. Which conclusion is the most prudent?',
									'choices'     => array( 'The audit itself must be questioned: method, scope, independence', 'The register is excellent and governance is under control', 'More risks should be added to make the register credible', 'The audit should be closed with no follow-up' ),
									'correct'     => 0,
									'explanation' => 'Zero findings across 40 risks is a signal about the audit, not about the register. The usual causes: a scope narrowed with the auditee, evidence supplied by the auditee, an auditor with no independence. A good audit always finds at least presentational gaps.',
								),
							),
						),
					),
				),
			),
		),
		array(
			'title'      => 'Le fournisseur qui repond oui a tout',
			'excerpt'    => 'Un questionnaire de due diligence rendu par un prestataire. Toutes les cases sont vertes. C\'est justement le probleme.',
			'content'    => 'Un fournisseur qui repond « oui » a tout ne vous a rien dit. Cette room t\'apprend a poser des questions auxquelles un « oui » ne suffit pas — et a lire les reponses pour ce qu\'elles ne disent pas.',
			'difficulty' => 'moyen',
			'duration'   => 30,
			'xp_bonus'   => 60,
			'track'      => 'gouvernance',
			'source'     => array(
				'nom'         => 'NIST SP 800-161 Rev.1 — Cybersecurity Supply Chain Risk Management Practices',
				'url'         => 'https://csrc.nist.gov/pubs/sp/800/161/r1/final',
				'licence'     => 'Domaine public (publication du NIST, Etats-Unis)',
				'attribution' => 'NIST Special Publication 800-161 Revision 1, Cybersecurity Supply Chain Risk Management Practices for Systems and Organizations',
			),
			'tasks'      => array(
				array(
					'type'      => 'lesson',
					'format'    => 'lecon',
					'title'     => 'Task 1 : Trois questions qu\'un « oui » ne suffit pas a repondre',
					'content'   => '<p>La due diligence d\'un fournisseur ne consiste pas a cocher des cases. Elle consiste a obtenir des reponses <em>verifiables</em>. Trois familles de questions font la difference :</p><ol><li><strong>« Selon quel referentiel, et avec quel perimetre ? »</strong> « Nous sommes ISO 27001 » ne dit rien tant qu\'on ne sait pas <em>quel</em> perimetre est certifie — parfois une seule filiale, parfois un seul service.</li><li><strong>« Que se passe-t-il en cas d\'incident, et sous quel delai nous prevenez-vous ? »</strong> Une clause de notification a 72 heures, engageante, vaut mieux que dix certifications.</li><li><strong>« Qui d\'autre touche a nos donnees ? »</strong> Un sous-traitant du sous-traitant reste votre risque. Un fournisseur qui ne liste pas ses propres sous-traitants ne peut pas vous proteger.</li></ol><p><strong>Le piege du oui.</strong> Un questionnaire rempli de oui est un questionnaire mal concu : une bonne question ouvre sur un fait, une date, un document. « Avez-vous un plan de reprise ? » se repond par oui ou non. « Quand a-t-il ete teste pour la derniere fois, et quel a ete le resultat ? » se repond par une date et un constat — et la, on peut verifier.</p><p><strong>A retenir :</strong> on ne demande pas « etes-vous surs ? », on demande « montrez-moi ». Le reste est de la politesse contractuelle.</p>',
					'questions' => array(),
				),
				array(
					'type'    => 'practice',
					'format'  => 'qcm',
					'title'   => 'Task 2 : Entrainement — reformuler une question molle',
					'content' => '<p>Quatre questions de questionnaire. A chaque fois : laquelle obtient un fait verifiable ?</p>',
					'questions' => array(
						array(
							'question'    => 'Quelle formulation obtient une reponse verifiable sur la securite d\'un fournisseur ?',
							'mode'        => 'choice',
							'topic'       => '5.3',
							'choices'     => array( 'Quand votre plan de reprise a-t-il ete teste, et quel en a ete le resultat ?', 'Disposez-vous d\'un plan de reprise informatique ?', 'Etes-vous serieux en matiere de continuite ?', 'Pouvez-vous confirmer que tout est conforme ?' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Cherche la question dont la reponse contient une date ou un constat.',
							'explanation' => 'Les trois autres se repondent par oui. Une question qui exige une date, un document ou un resultat oblige le fournisseur a produire une preuve — et vous donne de quoi la contester.',
						),
						array(
							'question'    => 'Un fournisseur affirme « nous sommes certifies ISO 27001 ». Que devez-vous demander immediatement apres ?',
							'mode'        => 'choice',
							'topic'       => '5.3',
							'choices'     => array( 'Le perimetre exact couvert par la certification', 'Le prix de la certification', 'Le nom de l\'organisme qui a facture l\'audit', 'Le nombre d\'employes du fournisseur' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Une certification porte toujours sur un perimetre ecrit noir sur blanc.',
							'explanation' => 'Le perimetre est la seule chose qui compte : si le service que vous achetez est hors perimetre, la certification ne vous dit rien. On demande le certificat et sa declaration d\'applicabilite, pas la brochure commerciale.',
						),
						array(
							'question'    => 'Quelle clause contractuelle protege le plus concretement en cas d\'incident chez le fournisseur ?',
							'mode'        => 'choice',
							'topic'       => '5.3',
							'choices'     => array( 'Une notification sous 72 h, avec un interlocuteur nomme', 'Une clause de confidentialite generale', 'Une remise commerciale en cas d\'indisponibilite', 'Une declaration annuelle de bonnes pratiques' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'De quoi avez-vous besoin le jour ou la fuite arrive ?',
							'explanation' => 'Le jour J, il vous faut savoir vite et savoir qui appeler. Une notification engageante avec un contact identifie transforme un incident chez le fournisseur en incident gere de votre cote. Une remise commerciale ne vous rend pas les donnees.',
						),
					),
				),
				array(
					'type'      => 'test',
					'format'    => 'pratique',
					'title'     => 'Task 3 : La mission — lire le questionnaire rempli',
					'content'   => '<p><strong>Mission.</strong> Le questionnaire de due diligence rempli par le prestataire est dans l\'atelier. Toutes les reponses sont favorables. Cherche la <strong>question dont la reponse contredit une autre reponse</strong> : c\'est l\'incoherence qui doit declencher une relance.</p><p>Ecris le <strong>numero de la question</strong> concernee (par exemple <code>Q7</code>).</p>',
					'questions' => array(
						array(
							'question'    => 'Quel numero de question contredit une autre reponse du meme questionnaire ?',
							'mode'        => 'text',
							'topic'       => '5.3',
							'answers'     => array( '/^q5$/i', '/question 5/i' ),
							'xp'          => 40,
							'hint'        => 'Lis d\'abord la reponse sur les sous-traitants, puis celle sur le chiffrement des sauvegardes. L\'une affirme ce que l\'autre dement.',
							'explanation' => 'La Q5 affirme que « toutes les donnees sont chiffrees au repos, y compris les sauvegardes », alors que la Q9 indique que les sauvegardes sont confiees a un prestataire tiers « qui gere le chiffrement a sa convenance ». Les deux ne peuvent pas etre vrais ensemble. C\'est exactement ce qu\'un questionnaire bien lu permet de trouver : non pas une faille declaree, mais une faille entre deux declarations.',
						),
					),
					'terminal' => array(
						'intro'   => 'acheteur@atelier:~$ ',
						'unknown' => 'Cette commande ne donne rien ici.',
						'success' => 'Questionnaire lu. Tu peux repondre.',
						'steps'   => array(
							array(
								'match'  => array( 'ls /srv/atelier', '/^ls .*atelier/', '/^ls$/' ),
								'output' => "questionnaire-fournisseur.txt\nregistre-des-risques.md\npolitique-acces.txt\n",
								'hint'   => 'Le questionnaire est dans /srv/atelier.',
							),
							array(
								'match'  => array( 'cat /srv/atelier/questionnaire-fournisseur.txt', '/cat .*questionnaire/' ),
								'output' => "# Questionnaire de due diligence — NUBE HOSTING SAS — retour du 02/10\n\nQ1. Disposez-vous d'une politique de securite approuvee par la direction ?\n    OUI. Politique v4.2, approuvee le 12/01.\n\nQ2. Vos journaux d'acces sont-ils conserves 12 mois ?\n    OUI. Conservation 12 mois, sur un stockage separe.\n\nQ3. Avez-vous un plan de reprise teste ?\n    OUI.\n\nQ4. Sous quel delai notifiez-vous un incident affectant nos donnees ?\n    OUI, nous notifions rapidement.\n\nQ5. Les donnees sont-elles chiffrees au repos, y compris les sauvegardes ?\n    OUI. Toutes les donnees sont chiffrees au repos, y compris les sauvegardes.\n\nQ6. Utilisez-vous des sous-traitants pour heberger nos donnees ?\n    OUI, un partenaire de stockage.\n\nQ7. Vos employes sont-ils formes a la securite ?\n    OUI, formation annuelle obligatoire.\n\nQ8. Pouvez-vous fournir le rapport d'audit le plus recent ?\n    OUI, sur demande ecrite.\n\nQ9. Precision sur le partenaire de stockage (Q6) :\n    Les sauvegardes sont confiees a un prestataire tiers qui gere le chiffrement a sa convenance.\n    Aucune clause de notification d'incident n'est prevue avec ce prestataire.\n\nQ10. Acceptez-vous un droit d'audit contractuel ?\n    OUI.\n",
								'hint'   => 'Compare les affirmations entre elles : Q5 sur le chiffrement, Q6 et Q9 sur le partenaire.',
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
							'question'    => 'Un questionnaire de due diligence ne contient que des reponses « OUI ». Quelle est l\'interpretation correcte ?',
							'mode'        => 'choice',
							'topic'       => '5.3',
							'choices'     => array( 'Le questionnaire est mal concu : il ne permet pas de verifier', 'Le fournisseur est particulierement mature', 'Il faut signer rapidement avant que l\'offre ne change', 'Les questions etaient trop techniques pour le fournisseur' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Un questionnaire dont toutes les reponses sont binaires ne produit aucune preuve. La question est de savoir si elle permet de distinguer un bon fournisseur d\'un mauvais : ici, non.',
						),
						array(
							'question'    => 'Le fournisseur confie vos sauvegardes a un prestataire tiers sans clause de notification. Qui porte ce risque ?',
							'mode'        => 'choice',
							'topic'       => '5.3',
							'choices'     => array( 'Vous : la chaine de sous-traitance ne transfere pas votre responsabilite', 'Le prestataire tiers, qui detient physiquement les donnees', 'Personne, tant qu\'aucun incident n\'a eu lieu', 'L\'organisme qui a certifie le fournisseur principal' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'La responsabilite vis-a-vis des personnes concernees reste la votre. Un sous-traitant du sous-traitant est un maillon de votre chaine d\'approvisionnement : c\'est a vous d\'exiger la clause, ou d\'en tirer les consequences.',
						),
						array(
							'question'    => 'Quelle reponse du questionnaire est inutilisable en tant que preuve ?',
							'mode'        => 'choice',
							'topic'       => '5.3',
							'choices'     => array( '« Nous notifions rapidement » en cas d\'incident', '« Politique v4.2, approuvee le 12/01 »', '« Conservation 12 mois, sur un stockage separe »', '« Sur demande ecrite » pour le rapport d\'audit' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => '« Rapidement » n\'est pas un delai. Les trois autres reponses citent une version, une duree ou une modalite : on peut les verifier et les opposer. La premiere ne s\'oppose a rien.',
						),
						array(
							'question'    => 'Quel est le meilleur signal d\'alerte dans un dossier fournisseur ?',
							'mode'        => 'choice',
							'topic'       => '5.3',
							'choices'     => array( 'Deux declarations qui ne peuvent pas etre vraies ensemble', 'Un certificat de securite de plus de deux ans', 'Un fournisseur qui refuse de communiquer ses tarifs', 'Un fournisseur installe dans un autre pays' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'L\'incoherence interne est le signal le plus fort : elle prouve que le dossier a ete rempli pour rassurer, pas pour decrire. Un certificat ancien ou un tarif discret sont des points a discuter, pas des contradictions.',
						),
					),
				),
			),
			'i18n'       => array(
				'en' => array(
					'title'   => 'The vendor who says yes to everything',
					'excerpt' => 'A due diligence questionnaire comes back from a provider. Every box is green. That is exactly the problem.',
					'tasks'   => array(
						array(
							'title'     => 'Task 1: Three questions that a "yes" cannot answer',
							'content'   => '<p>Vendor due diligence is not about ticking boxes. It is about obtaining <em>verifiable</em> answers. Three families of questions make the difference:</p><ol><li><strong>"Against which standard, and with which scope?"</strong> "We are ISO 27001 certified" says nothing until you know <em>which</em> scope is certified — sometimes one subsidiary, sometimes one service.</li><li><strong>"What happens during an incident, and within what delay do you notify us?"</strong> A binding 72-hour notification clause is worth more than ten certificates.</li><li><strong>"Who else touches our data?"</strong> Your subcontractor\'s subcontractor is still your risk. A vendor that does not list its own subcontractors cannot protect you.</li></ol><p><strong>The yes trap.</strong> A questionnaire filled with yeses is a badly designed questionnaire: a good question opens onto a fact, a date, a document. "Do you have a recovery plan?" is answered yes or no. "When was it last tested, and what was the result?" is answered with a date and a finding — and that can be checked.</p><p><strong>Remember:</strong> you do not ask "are you sure?", you ask "show me". The rest is contractual politeness.</p>',
							'questions' => array(),
						),
						array(
							'title'     => 'Task 2: Practice — rewrite a soft question',
							'content'   => '<p>Four questionnaire questions. Each time: which one gets a verifiable fact?</p>',
							'questions' => array(
								array(
									'question'    => 'Which wording gets a verifiable answer about a vendor\'s security?',
									'choices'     => array( 'When was your recovery plan last tested, and what was the result?', 'Do you have an IT recovery plan?', 'Are you serious about business continuity?', 'Can you confirm that everything is compliant?' ),
									'correct'     => 0,
									'hint'        => 'Look for the question whose answer contains a date or a finding.',
									'explanation' => 'The other three are answered with yes. A question that requires a date, a document or a result forces the vendor to produce evidence — which you can then challenge.',
								),
								array(
									'question'    => 'A vendor states "we are ISO 27001 certified". What must you ask immediately after?',
									'choices'     => array( 'The exact scope covered by the certification', 'How much the certification cost', 'The name of the firm that invoiced the audit', 'How many employees the vendor has' ),
									'correct'     => 0,
									'hint'        => 'A certification always covers a written scope.',
									'explanation' => 'Scope is the only thing that matters: if the service you buy is out of scope, the certificate tells you nothing. You ask for the certificate and its statement of applicability, not the brochure.',
								),
								array(
									'question'    => 'Which contractual clause protects you most concretely when an incident happens at the vendor?',
									'choices'     => array( 'Notification within 72 hours, with a named contact', 'A general confidentiality clause', 'A discount if the service is unavailable', 'An annual declaration of good practice' ),
									'correct'     => 0,
									'hint'        => 'What do you need on the day the breach happens?',
									'explanation' => 'On the day, you need to know fast and to know who to call. A binding notification with an identified contact turns an incident at the vendor into an incident you manage. A discount does not give your data back.',
								),
							),
						),
						array(
							'title'     => 'Task 3: The mission — read the filled questionnaire',
							'content'   => '<p><strong>Mission.</strong> The due diligence questionnaire filled in by the provider is in the workshop. Every answer is favourable. Find the <strong>question whose answer contradicts another answer</strong>: that inconsistency is what must trigger a follow-up.</p><p>Type the <strong>question number</strong> concerned (for example <code>Q7</code>).</p>',
							'questions' => array(
								array(
									'question'    => 'Which question number contradicts another answer in the same questionnaire?',
									'hint'        => 'Read the answer about subcontractors, then the one about backup encryption. One asserts what the other denies.',
									'explanation' => 'Q5 states that "all data is encrypted at rest, including backups", while Q9 says backups are handed to a third party "which manages encryption as it sees fit". Both cannot be true together. That is exactly what a carefully read questionnaire finds: not a declared weakness, but a weakness between two declarations.',
								),
							),
						),
						array(
							'title'     => 'Task 4: End-of-room exam',
							'content'   => '<p>Four questions, 8 minutes, pass mark 80%.</p>',
							'questions' => array(
								array(
									'question'    => 'A due diligence questionnaire contains only "YES" answers. What is the correct interpretation?',
									'choices'     => array( 'The questionnaire is badly designed: it cannot verify anything', 'The vendor is particularly mature', 'You should sign quickly before the offer changes', 'The questions were too technical for the vendor' ),
									'correct'     => 0,
									'explanation' => 'A questionnaire whose answers are all binary produces no evidence. The real question is whether it can tell a good vendor from a bad one: here, it cannot.',
								),
								array(
									'question'    => 'The vendor hands your backups to a third party with no notification clause. Who carries that risk?',
									'choices'     => array( 'You: the subcontracting chain does not transfer your responsibility', 'The third party, which physically holds the data', 'Nobody, as long as no incident has occurred', 'The body that certified the main vendor' ),
									'correct'     => 0,
									'explanation' => 'Responsibility towards the people concerned remains yours. A subcontractor of a subcontractor is a link in your supply chain: it is up to you to require the clause, or to draw the consequences.',
								),
								array(
									'question'    => 'Which answer in the questionnaire is unusable as evidence?',
									'choices'     => array( '"We notify quickly" in the event of an incident', '"Policy v4.2, approved on 01/12"', '"12-month retention, on separate storage"', '"On written request" for the audit report' ),
									'correct'     => 0,
									'explanation' => '"Quickly" is not a deadline. The other three cite a version, a duration or a modality: they can be checked and relied upon. The first cannot be relied upon at all.',
								),
								array(
									'question'    => 'What is the best warning sign in a vendor file?',
									'choices'     => array( 'Two statements that cannot both be true', 'A security certificate older than two years', 'A vendor who refuses to share pricing', 'A vendor based in another country' ),
									'correct'     => 0,
									'explanation' => 'Internal inconsistency is the strongest signal: it proves the file was filled in to reassure, not to describe. An old certificate or discreet pricing are points to discuss, not contradictions.',
								),
							),
						),
					),
				),
			),
		),
		array(
			'title'      => 'L\'audit qui ne trouve rien',
			'excerpt'    => 'Un audit de conformite rend un rapport parfait. Zero ecart. C\'est le premier signe que quelque chose ne va pas.',
			'content'    => 'Un audit qui ne trouve rien n\'est pas un audit reussi : c\'est un audit a refaire. Cette room t\'apprend a lire un rapport d\'audit, et a reperer les trois failles qui rendent un audit inutile.',
			'difficulty' => 'moyen',
			'duration'   => 30,
			'xp_bonus'   => 60,
			'track'      => 'gouvernance',
			'source'     => array(
				'nom'         => 'ISO/IEC 27001:2022 — Securite de l\'information, systemes de management',
				'url'         => 'https://www.iso.org/standard/27001',
				'licence'     => 'Norme payante — non reutilisable. Seule la structure (articles 4 a 10) est citee, comme reference.',
				'attribution' => 'ISO/IEC 27001:2022, Information security, cybersecurity and privacy protection — Information security management systems — Requirements',
			),
			'tasks'      => array(
				array(
					'type'      => 'lesson',
					'format'    => 'lecon',
					'title'     => 'Task 1 : Les trois failles d\'un audit inutile',
					'content'   => '<p>Un audit repond a une seule question : <em>ce qui est ecrit est-il vrai, et suffisant ?</em> Trois defauts le vident de son sens.</p><ol><li><strong>Le perimetre choisi par l\'audite.</strong> Si celui qu\'on audite decide ce qu\'on regarde, l\'audit exclura exactement les zones sensibles. Le perimetre doit etre ecrit avant, et valide par le commanditaire.</li><li><strong>Les preuves fournies par l\'audite.</strong> Un audit sur dossier, avec des documents selectionnes par la personne auditee, mesure la qualite de la selection — pas la qualite du systeme. Une preuve se constate : on ouvre le journal, on interroge un compte, on regarde une machine.</li><li><strong>L\'absence d\'independance.</strong> L\'auditeur qui depend de l\'audite pour sa mission suivante ne peut pas ecrire un constat desagreable. C\'est humain, et c\'est structurel.</li></ol><p><strong>Le signal des zero ecart.</strong> Sur un systeme reel, un audit trouve toujours des ecarts de forme : une procedure non datee, un document perime, une preuve manquante. Zero ecart signifie que l\'on n\'a pas cherche, ou que l\'on n\'a pas eu le droit de chercher.</p><p><strong>Ce qu\'un bon rapport contient.</strong> Des constats precis et situes (« le compte de X est encore actif alors que la procedure exige une desactivation sous 24 h, verifie le 14/09 »), une criticite, et une recommandation. Pas de « la securite est globalement satisfaisante » : ca ne se verifie pas et ca ne se corrige pas.</p><p><strong>A retenir :</strong> un rapport d\'audit se juge sur ce qu\'il permet de corriger, pas sur ce qu\'il rassure.</p>',
					'questions' => array(),
				),
				array(
					'type'    => 'practice',
					'format'  => 'qcm',
					'title'   => 'Task 2 : Entrainement — trois constats a qualifier',
					'content' => '<p>Trois extraits de rapport. Lequel est un vrai constat d\'audit ?</p>',
					'questions' => array(
						array(
							'question'    => 'Quel extrait est un constat d\'audit exploitable ?',
							'mode'        => 'choice',
							'topic'       => '5.4',
							'choices'     => array( 'Le compte de M. A. etait actif le 14/09, 40 jours apres son depart, alors que la procedure impose 24 h', 'La gestion des comptes est globalement satisfaisante', 'L\'equipe informatique doit etre plus vigilante a l\'avenir', 'Aucun ecart n\'a ete releve sur le perimetre etudie' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Un constat se situe dans le temps, nomme un fait et se rattache a une exigence.',
							'explanation' => 'Les trois autres ne peuvent etre ni contestes ni corriges : ils ne disent ni quand, ni quoi, ni par rapport a quelle regle. Le premier se verifie, se discute et se corrige.',
						),
						array(
							'question'    => 'Un audit exclut le systeme de facturation du perimetre, parce que l\'audite l\'a demande. Quel est le probleme ?',
							'mode'        => 'choice',
							'topic'       => '5.4',
							'choices'     => array( 'Le perimetre a ete choisi par la personne auditée', 'Le systeme de facturation n\'a aucun rapport avec la securite', 'Un audit doit toujours exclure les systemes financiers', 'Il n\'y a aucun probleme si la demande est ecrite' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Qui decide de ce qu\'on regarde, dans un audit honnete ?',
							'explanation' => 'Le perimetre se fixe avec le commanditaire, avant l\'audit, en fonction du risque — pas avec celui qu\'on examine. Sinon, l\'audit exclut par construction ce qui derange.',
						),
						array(
							'question'    => 'Quelle preuve est la plus solide pour un auditeur ?',
							'mode'        => 'choice',
							'topic'       => '5.4',
							'choices'     => array( 'Un journal systeme horodate, consulte directement sur la machine', 'Une procedure signee par le responsable securite', 'Une presentation de 30 pages sur les bonnes pratiques', 'Une attestation du fournisseur affirmant la conformite' ),
							'correct'     => 0,
							'xp'          => 10,
							'hint'        => 'Distingue ce qui decrit ce qui devrait se passer et ce qui montre ce qui s\'est passe.',
							'explanation' => 'Les trois autres documents disent une intention ou une declaration. Un journal horodate montre un fait : c\'est ce qui permet d\'etablir un ecart entre la regle et la realite.',
						),
					),
				),
				array(
					'type'      => 'test',
					'format'    => 'pratique',
					'title'     => 'Task 3 : La mission — trouver le constat cache',
					'content'   => '<p><strong>Mission.</strong> Le rapport d\'audit et l\'extrait du journal des acces sont dans l\'atelier. Le rapport conclut « aucun ecart ». Le journal, lui, dit autre chose.</p><p>Compare-les et ecris l\'<strong>identifiant du compte</strong> qui contredit le rapport (le champ <code>compte</code> de la ligne concernee).</p>',
					'questions' => array(
						array(
							'question'    => 'Quel compte contredit la conclusion « aucun ecart » du rapport ?',
							'mode'        => 'text',
							'topic'       => '5.4',
							'answers'     => array( '/^j\.moreau$/i', '/moreau/i' ),
							'xp'          => 40,
							'hint'        => 'Le rapport dit que tous les departs ont ete traites sous 24 h. Le journal montre des connexions. Cherche un compte qui se connecte apres une date de depart.',
							'explanation' => 'Le compte j.moreau s\'est connecte le 22/09 alors que son depart est enregistre le 03/08 : 50 jours d\'acces actifs. Le rapport affirme le contraire sans avoir consulte le journal — c\'est la preuve que les preuves ont ete fournies par l\'audite. C\'est exactement le constat qu\'un audit sur preuves constatees aurait releve.',
						),
					),
					'terminal' => array(
						'intro'   => 'auditeur@atelier:~$ ',
						'unknown' => 'Cette commande ne donne rien ici.',
						'success' => 'Rapport et journal lus. Tu peux repondre.',
						'steps'   => array(
							array(
								'match'  => array( 'ls /srv/atelier', '/^ls .*atelier/', '/^ls$/' ),
								'output' => "rapport-audit.txt\njournal-acces.log\n",
								'hint'   => 'Deux fichiers : le rapport et le journal des acces.',
							),
							array(
								'match'  => array( 'cat /srv/atelier/rapport-audit.txt', '/cat .*rapport-audit/' ),
								'output' => "# Rapport d'audit — perimetre : gestion des acces\n# Realise le 28/09 — auditeur : cabinet EXTERNE CONSEIL\n\n1. Politique d'acces : document SEC-ACC-04, version 3, approuvee.\n2. Revue trimestrielle des comptes : realisee le 30/06 et le 30/09.\n3. Departs : la procedure impose une desactivation sous 24 h.\n   -> Trois departs sur la periode. Tous traites sous 24 h (source : attestation DRH).\n4. Comptes a privilege : 2 comptes administrateurs, justifies.\n5. Formation des utilisateurs : realisee.\n\nCONCLUSION : aucun ecart releve. Systeme de gestion des acces maitrise.\n",
								'hint'   => 'Le rapport dit que tous les departs ont ete traites sous 24 h. Il cite sa source.',
							),
							array(
								'match'  => array( 'cat /srv/atelier/journal-acces.log', '/cat .*journal-acces/' ),
								'output' => "# Extrait du journal des connexions (auth.log consolide)\n2026-07-01 compte=admin source=10.0.0.5 resultat=succes\n2026-07-15 compte=r.martin source=10.0.0.22 resultat=succes\n2026-08-03 compte=j.moreau source=10.0.0.31 resultat=succes\n2026-08-04 depart_enregistre compte=j.moreau\n2026-09-22 compte=j.moreau source=185.44.12.9 resultat=succes\n2026-09-22 compte=j.moreau source=185.44.12.9 resultat=succes\n2026-09-27 compte=admin source=10.0.0.5 resultat=echec\n2026-09-28 compte=p.leroy source=10.0.0.41 resultat=succes\n",
								'hint'   => 'Compare chaque connexion avec les dates de depart du rapport.',
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
							'question'    => 'Un audit rend un rapport sans aucun ecart. Que faut-il examiner en premier ?',
							'mode'        => 'choice',
							'topic'       => '5.4',
							'choices'     => array( 'Le perimetre, la nature des preuves et l\'independance de l\'auditeur', 'La mise en page et la clarte du rapport', 'Le nombre de pages, qui doit etre suffisant', 'Le prix de la prestation d\'audit' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Un rapport parfait sur un systeme reel interroge la methode. Perimetre trop etroit, preuves fournies par l\'audite, auditeur en situation de dependance : ce sont les trois causes habituelles.',
						),
						array(
							'question'    => 'Quelle difference y a-t-il entre un audit interne et un audit de certification ?',
							'mode'        => 'choice',
							'topic'       => '5.4',
							'choices'     => array( 'L\'interne vise a corriger, le second a obtenir une reconnaissance par un tiers', 'L\'interne est moins fiable par nature', 'Le second ne regarde jamais les preuves techniques', 'L\'interne est reserve aux grandes entreprises' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Les deux regardent des preuves ; l\'objectif differe. L\'audit interne sert a ameliorer avant que le regard externe n\'arrive : c\'est un outil de progres, pas une formalite.',
						),
						array(
							'question'    => 'Un rapport affirme « les trois departs ont ete traites sous 24 h » en citant une attestation de la DRH. Le journal montre une connexion 50 jours apres un depart. Que conclure ?',
							'mode'        => 'choice',
							'topic'       => '5.4',
							'choices'     => array( 'L\'audit s\'est appuye sur une declaration au lieu de constater le fait', 'Le journal est faux, puisqu\'il contredit un document officiel', 'La DRH doit etre sanctionnee avant toute autre action', 'Il s\'agit d\'un faux positif sans consequence' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'La declaration est une intention, le journal est un fait. L\'audit a accepte la premiere sans verifier le second : c\'est le defaut de methode le plus courant, et celui qui laisse passer exactement les incidents qui comptent.',
						),
						array(
							'question'    => 'Quel constat est le plus utile pour faire progresser l\'organisation ?',
							'mode'        => 'choice',
							'topic'       => '5.1',
							'choices'     => array( 'Un ecart situe dans le temps, rattache a une exigence, avec une criticite', 'Une appreciation generale sur la culture de securite', 'Une liste d\'outils recommandes pour l\'annee suivante', 'Un rappel des obligations legales sans constat precis' ),
							'correct'     => 0,
							'xp'          => 15,
							'explanation' => 'Ce qui se corrige, c\'est un fait situe et rapporte a une exigence. Une appreciation generale ne donne aucune prise : personne ne sait quoi changer, ni quand vérifier que c\'est change.',
						),
					),
				),
			),
			'i18n'       => array(
				'en' => array(
					'title'   => 'The audit that finds nothing',
					'excerpt' => 'A compliance audit delivers a perfect report. Zero findings. That is the first sign something is wrong.',
					'tasks'   => array(
						array(
							'title'     => 'Task 1: The three flaws of a useless audit',
							'content'   => '<p>An audit answers one single question: <em>is what is written true, and sufficient?</em> Three flaws empty it of meaning.</p><ol><li><strong>The scope chosen by the auditee.</strong> If the party being audited decides what gets looked at, the audit will exclude exactly the sensitive areas. Scope must be written beforehand and approved by the commissioning party.</li><li><strong>Evidence supplied by the auditee.</strong> An audit on documents, with files selected by the person audited, measures the quality of the selection — not the quality of the system. Evidence is observed: you open the log, you query an account, you look at a machine.</li><li><strong>The absence of independence.</strong> An auditor who depends on the auditee for the next engagement cannot write an unpleasant finding. It is human, and it is structural.</li></ol><p><strong>The zero-findings signal.</strong> On a real system, an audit always finds at least presentational gaps: an undated procedure, an expired document, missing evidence. Zero findings means nobody looked, or nobody was allowed to look.</p><p><strong>What a good report contains.</strong> Precise, situated findings ("X\'s account was still active while the procedure requires deprovisioning within 24 h, verified on 14/09"), a severity, and a recommendation. Not "security is broadly satisfactory": that can neither be verified nor fixed.</p><p><strong>Remember:</strong> an audit report is judged on what it allows you to fix, not on what it reassures you about.</p>',
							'questions' => array(),
						),
						array(
							'title'     => 'Task 2: Practice — three findings to classify',
							'content'   => '<p>Three report excerpts. Which one is a real audit finding?</p>',
							'questions' => array(
								array(
									'question'    => 'Which excerpt is an actionable audit finding?',
									'choices'     => array( 'M. A.\'s account was active on 14/09, 40 days after departure, while the procedure requires 24 h', 'Account management is broadly satisfactory', 'The IT team must be more vigilant in future', 'No findings were raised within the scope studied' ),
									'correct'     => 0,
									'hint'        => 'A finding is situated in time, names a fact and ties to a requirement.',
									'explanation' => 'The other three can neither be challenged nor corrected: they do not say when, what, or against which rule. The first can be verified, discussed and fixed.',
								),
								array(
									'question'    => 'An audit excludes the billing system from scope because the auditee asked. What is the problem?',
									'choices'     => array( 'The scope was chosen by the audited party', 'The billing system has nothing to do with security', 'An audit must always exclude financial systems', 'There is no problem if the request is in writing' ),
									'correct'     => 0,
									'hint'        => 'Who decides what gets looked at, in an honest audit?',
									'explanation' => 'Scope is set with the commissioning party, before the audit, based on risk — not with the party being examined. Otherwise the audit excludes, by design, whatever is inconvenient.',
								),
								array(
									'question'    => 'Which evidence is the strongest for an auditor?',
									'choices'     => array( 'A timestamped system log, read directly on the machine', 'A procedure signed by the security manager', 'A 30-page presentation on good practice', 'A vendor statement asserting compliance' ),
									'correct'     => 0,
									'hint'        => 'Separate what describes what should happen from what shows what did happen.',
									'explanation' => 'The other three documents state an intention or a declaration. A timestamped log shows a fact: it is what lets you establish a gap between the rule and reality.',
								),
							),
						),
						array(
							'title'     => 'Task 3: The mission — find the hidden finding',
							'content'   => '<p><strong>Mission.</strong> The audit report and the access log extract are in the workshop. The report concludes "no findings". The log says otherwise.</p><p>Compare them and type the <strong>account identifier</strong> that contradicts the report (the <code>compte</code> field of the relevant line).</p>',
							'questions' => array(
								array(
									'question'    => 'Which account contradicts the report\'s conclusion of "no findings"?',
									'hint'        => 'The report says every departure was handled within 24 h. The log shows logins. Find an account logging in after a departure date.',
									'explanation' => 'Account j.moreau logged in on 22/09 while its departure is recorded on 03/08: 50 days of active access. The report claims the opposite without consulting the log — proof that the evidence was supplied by the auditee. This is exactly the finding an audit based on observed evidence would have raised.',
								),
							),
						),
						array(
							'title'     => 'Task 4: End-of-room exam',
							'content'   => '<p>Four questions, 8 minutes, pass mark 80%.</p>',
							'questions' => array(
								array(
									'question'    => 'An audit delivers a report with no findings at all. What should you examine first?',
									'choices'     => array( 'The scope, the nature of the evidence and the auditor\'s independence', 'The layout and clarity of the report', 'The page count, which must be sufficient', 'The price of the audit engagement' ),
									'correct'     => 0,
									'explanation' => 'A perfect report on a real system questions the method. Scope too narrow, evidence supplied by the auditee, auditor in a dependent position: those are the three usual causes.',
								),
								array(
									'question'    => 'What is the difference between an internal audit and a certification audit?',
									'choices'     => array( 'The internal one aims to fix, the second to obtain third-party recognition', 'The internal one is unreliable by nature', 'The second never looks at technical evidence', 'The internal one is reserved for large companies' ),
									'correct'     => 0,
									'explanation' => 'Both look at evidence; the objective differs. An internal audit improves things before the external eye arrives: it is a tool for progress, not a formality.',
								),
								array(
									'question'    => 'A report states "all three departures were handled within 24 h", citing an HR attestation. The log shows a login 50 days after a departure. What do you conclude?',
									'choices'     => array( 'The audit relied on a declaration instead of observing the fact', 'The log is wrong, since it contradicts an official document', 'HR must be sanctioned before any other action', 'It is a harmless false positive' ),
									'correct'     => 0,
									'explanation' => 'The declaration is an intention, the log is a fact. The audit accepted the first without checking the second: the most common methodological flaw, and the one that lets through exactly the incidents that matter.',
								),
								array(
									'question'    => 'Which finding is the most useful for moving the organisation forward?',
									'choices'     => array( 'A gap situated in time, tied to a requirement, with a severity', 'A general remark about security culture', 'A list of recommended tools for next year', 'A reminder of legal obligations with no specific finding' ),
									'correct'     => 0,
									'explanation' => 'What gets fixed is a situated fact tied to a requirement. A general remark gives no grip: nobody knows what to change, or when to check it changed.',
								),
							),
						),
					),
				),
			),
		),
	);
}
