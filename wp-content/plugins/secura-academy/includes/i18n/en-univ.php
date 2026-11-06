<?php
/**
 * Traductions anglaises du parcours universitaire (vingt-deux rooms).
 *
 * Meme convention que en-m3.php. Les cours cites (6.858, 6.857) gardent
 * leur numero : c'est un identifiant, pas un mot a traduire.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(

	/* ---------------------------------------------------------------------
	 * univ-01 — Menaces, vulnerabilites et modele de menace
	 * ------------------------------------------------------------------ */
	'univ-01' => array(
		'title'   => 'Threats, vulnerabilities and the threat model',
		'excerpt' => 'Before defending anything, describe the attack: what the adversary wants, what they can do, and what you are protecting.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — the threat model',
				'content' => '<p>A <strong>threat</strong> is a <em>possibility</em> that a rule gets broken. A <strong>vulnerability</strong> is a <em>real</em> weakness that makes that possibility plausible. A <strong>threat model</strong> is the sentence that ties the two together: "if our adversary can do X, then our rule Y is in danger".</p><p>Three questions are enough to set it out:</p><ul><li><strong>What am I protecting?</strong> Data, a service, a reputation. Without that, there is no priority.</li><li><strong>Who is the adversary?</strong> A script kiddie? A competitor? A state? A disgruntled employee? The model must be more careful than the real adversary, otherwise you defend the wrong side.</li><li><strong>What are they capable of?</strong> Reading the network? Running code on your machine? Deceiving a human?</li></ul><p>And then the <strong>security policy</strong>: the rule you want enforced. "Only the billing service reads the customer folder." A <strong>mechanism</strong> is what enforces it: an ACL, encryption, a query filter. A mechanism is worth something only if the assumption of the threat model holds: <em>"as long as the adversary plays by the rules, the policy is respected"</em>.</p><p><strong>Remember:</strong> you do not encrypt "everything". You protect what is most valuable, against what is most likely.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Three questions to pin the vocabulary down before the mission.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'In the sentence "an attacker can send forged requests to the billing service", what is the threat and what is the vulnerability?',
						'choices'     => array(
							'The threat is the attacker; the vulnerability is the forged request',
							'The threat is the forged request; the vulnerability is the attacker',
							'The threat and the vulnerability are the same thing',
							'There is no vulnerability: a forged request is normal',
						),
						'hint'        => 'The threat is a scenario; the vulnerability is a technical weakness that makes the scenario possible.',
						'explanation' => 'The attacker is the adversary, not the threat. The threat is the scenario ("they send forged requests"); the vulnerability is the technical weakness that makes that scenario possible (the service does not check where the request came from).',
					),
					1 => array(
						'question'    => 'A firewall blocks every request coming from the Internet. Which property can your policy still guarantee?',
						'choices'     => array(
							'The confidentiality of customer data',
							'Nothing: without testing the system, no property can be guaranteed',
							'The integrity of the data, even against a malicious administrator',
							'Integrity and availability of the service, because the firewall cannot be crossed',
						),
						'hint'        => 'A mechanism proves nothing on its own: you have to know what it assumes.',
						'explanation' => 'The firewall is a mechanism, not a proof. Until you have written down the threat model (insider? application flaw?), you cannot claim the policy is respected. That is the whole message of the lesson: security is demonstrated, not assumed.',
					),
					2 => array(
						'question'    => 'You have a database of {big} photos and a web server of {small}. Which do you protect first?',
						'choices'     => array(
							'The web server: it is what customers touch first',
							'The photo database: it is bigger, therefore more important',
							'Whichever holds the data that is hardest to recover',
							'Both equally, otherwise it is not serious',
						),
						'hint'        => 'Think of the cost of the loss: what happens if the data disappears and cannot come back?',
						'explanation' => 'Priority comes from the <em>cost of the loss</em>, not from the volume. A bad photo can be retaken; an unrecoverable customer database is a disaster. Volume is a storage criterion, not a security one.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — risk analysis',
				'content' => '<p>On the classroom machine, the team left the semester deliverables. In <code>/srv/cours</code>, one folder holds the risk analysis for course 6.858: it lists the assets, the possible adversaries and the rules to enforce.</p><p><strong>Mission.</strong> Read that document and note the <em>critical risk value</em> it announces (the conclusion line of the analysis). That value is the proof that you read the course document.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the critical risk value announced in the course risk analysis.',
						'hint'        => 'Start by listing the folders: <code>ls -R /srv/cours</code>. The 6.858 folder holds a .md file.',
						'explanation' => 'A risk analysis reads like a conclusion: the critical risk is the one that, if it happens, breaks the security policy. Noting it means applying the course to a real case.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the exact role of a "security mechanism"?',
						'choices'     => array(
							'Guarantee on its own that the policy is respected',
							'Enforce the policy, as long as the assumptions of the threat model hold',
							'Replace the threat model, which becomes unnecessary',
							'Document the decisions taken for the team',
						),
						'hint'        => 'A mechanism acts "as long as" a condition holds. Which one?',
						'explanation' => 'The key sentence of the course: the mechanism enforces the policy <em>as long as the adversary respects the threat model</em>. If the model is wrong, the mechanism no longer protects.',
					),
					1 => array(
						'question'    => 'Your service must be reachable from the students\' homes, but only teachers may change the settings. Which policy?',
						'choices'     => array(
							'Everyone can change the settings, it is simpler',
							'Students reach the service over the internal network only',
							'Only teachers can change the settings; every student can use the service',
							'The service is reachable by teachers only',
						),
						'hint'        => 'Two actions, two populations: re-read the question, it contains both.',
						'explanation' => 'A policy is written as principals × actions × objects: "students may use the service; only teachers may reconfigure it". That is the framework set by module 1 of 6.858 (threats) and 6.857 (policies).',
					),
					2 => array(
						'question'    => 'A service runs as root although it only needs to read one file. What should be done?',
						'choices'     => array(
							'Leave it as it is: root always works',
							'Add a second root service for redundancy',
							'Uninstall the service and replace it with a home-made script',
							'Remove the unnecessary rights: that is privilege separation',
						),
						'hint'        => 'It is lesson 4 of the course: "Privilege Separation".',
						'explanation' => 'Removing unnecessary rights applies least privilege: if the service is compromised, the attacker only gets an unprivileged account. Lesson 4 of the course makes it a principle in its own right.',
					),
					3 => array(
						'question'    => 'A firewall blocks 100% of external requests, but the application has a SQL injection. What do you conclude?',
						'choices'     => array(
							'The mechanism does not cover the threat: an application vulnerability remains',
							'The system is safe: the firewall blocks everything',
							'The system is safe as long as nobody tries',
							'The firewall should be replaced by an antivirus',
						),
						'hint'        => 'A mechanism only covers the threats it was designed for.',
						'explanation' => 'The firewall handles the "coming from the network" threat. SQL injection is a "coming from inside the request" threat: no firewall covers it. That is the difference between a mechanism and a guarantee.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * univ-02 — Debordement de tampon : l'attaque et les defenses
	 * ------------------------------------------------------------------ */
	'univ-02' => array(
		'title'   => 'Buffer overflow: the attack and the defences',
		'excerpt' => 'What happens when a program writes past its own box, and why canaries, ASLR and NX changed the game.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — the overflow and its four guard rails',
				'content' => '<p>A C program allocates a 64-byte <em>buffer</em> on the stack and copies a string into it without checking its length. The excess spills over and overwrites the <strong>return address</strong>: when the function returns, the program resumes <em>wherever the attacker decides</em>. Two conditions are enough for exploitation: <strong>take control</strong> of the program counter, then <strong>run</strong> what you placed there.</p><p>The four classic defences, in the order they appeared:</p><ul><li><strong>Avoid the bug</strong>: write code that checks sizes. Effective, but it rests on humans: one slip and it is over.</li><li><strong>The canary</strong>: a secret value placed between the local variables and the return address. If it is modified, the program stops before returning. It does not block the write; it detects the corruption.</li><li><strong>ASLR</strong>: addresses change on every launch, so the attacker no longer knows where to aim. A canary plus ASLR is already very expensive to work around.</li><li><strong>NX</strong> (No-eXecute): the stack is no longer executable, so you cannot leave code there. You have to bounce off code that is already present: that is <em>ROP</em>, which you will meet at pwn.college.</li></ul><p><strong>Remember:</strong> a defence is not a wall, it is an <em>obstacle</em>. You stack obstacles; the attacker looks for the cheapest path, not an impossible one.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions: what each defence really does, and what it does not do.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'A program overflows and overwrites the return address. What happens to the canary?',
						'choices'     => array(
							'It blocks the write: the program refuses to overflow',
							'It gets overwritten too, and the program notices on return and stops',
							'It is not touched: it protects the whole stack',
							'It recompiles the program automatically',
						),
						'hint'        => 'Compare where the canary sits with where the return address sits.',
						'explanation' => 'The canary sits right before the return address: a long enough write reaches it. The check happens on return, and the program aborts instead of jumping to the attacker address.',
					),
					1 => array(
						'question'    => 'With NX enabled, which attack technique remains possible?',
						'choices'     => array(
							'None: the three defences make exploitation impossible',
							'SQL injection on the application database',
							'ROP: bouncing off pieces of code that already exist',
							'Capturing the network traffic in clear text',
						),
						'hint'        => 'NX forbids executing the stack. So how do you execute code?',
						'explanation' => 'NX makes the stack non-executable, so the attacker no longer leaves shellcode behind: they chain "gadgets" already present in the program (ROP). More technical, not impossible — and exactly what the pwn.college rooms are about.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the vulnerable binary',
				'content' => '<p>In the classroom, a 6.858 practical was prepared: the program <code>vuln</code> and its <em>readme</em>. The readme holds the result of the binary analysis (buffer size, target function, offset).</p><p><strong>Mission.</strong> Read the practical readme and note the <em>offset value</em> it announces (the number of bytes needed to reach the return address). That is the proof you understood the exploit before writing it.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the offset value announced in the practical readme about the vulnerable binary.',
						'hint'        => 'The practical is in <code>/opt/labs</code>: start with <code>ls /opt/labs</code>, then read the README file.',
						'explanation' => 'The offset is the number of bytes between the start of the buffer and the return address. Computing it is how you understand why the canary works and where it sits.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the exact purpose of ASLR?',
						'choices'     => array(
							'Encrypt the memory of the program',
							'Stop the program writing outside the buffer',
							'Move memory areas on each run so the attacker aims blind',
							'Check that the binary was not modified',
						),
						'hint'        => 'Two guesses: the layout is randomised, and the space is the address space.',
						'explanation' => 'ASLR randomises addresses, so the attacker has to guess where the return address sits. It does not stop the write: it makes the target unpredictable.',
					),
					1 => array(
						'question'    => 'Why does NX make ROP necessary?',
						'choices'     => array(
							'Because NX allows execution on the heap but not on the stack',
							'Because NX encrypts the stack',
							'Because NX disables the canary',
							'Because the stack is no longer executable: code placed there cannot be run directly',
						),
						'hint'        => 'NX = No-eXecute. Which area do you place code in?',
						'explanation' => 'With NX the stack is only data: leaving shellcode there is no longer enough. The attacker uses code fragments already present (gadgets) and builds a chain of calls: that is Return-Oriented Programming.',
					),
					2 => array(
						'question'    => 'A C program reads with <code>gets()</code> into a {size}-byte buffer. What is the real problem?',
						'choices'     => array(
							'gets() has no limit: the input can exceed the buffer and overflow',
							'gets() is too slow',
							'gets() only works in ASCII',
							'gets() only works with arrays',
						),
						'hint'        => 'The function name says it all: "get" with no "n" and no size.',
						'explanation' => '<code>gets()</code> reads a line without knowing the size of the array. It is the very example the course shows in the first minute, and the reason it must no longer be used.',
					),
					3 => array(
						'question'    => 'Why does the canary not protect against a heap overflow?',
						'choices'     => array(
							'Because the canary is too short',
							'Because the canary sits on the stack, not between heap blocks',
							'Because the canary is encrypted',
							'Because the canary expires after a few seconds',
						),
						'hint'        => 'Where does the canary live? And where is the heap?',
						'explanation' => 'The canary is a stack mechanism: between the local variables and the return address. A heap overflow overwrites other data (pointers, block sizes) and the canary never sees it. Hence "electric fences" and other heap-side protections.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * univ-03 — Architecture de confiance : separer les privileges
	 * ------------------------------------------------------------------ */
	'univ-03' => array(
		'title'   => 'Trust architecture: separating privileges',
		'excerpt' => 'How to split a program so that one bug does not have the power to destroy everything.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — splitting the powers',
				'content' => '<p>A single program that does everything (parse a request, write to the database, send an e-mail) is a program where <em>one bug</em> gives the attacker <em>every power</em>. <strong>Privilege separation</strong> means cutting it in two:</p><ul><li>an <strong>unprivileged</strong> part, which does the doubtful work (parsing, computing);</li><li>a <strong>privileged</strong> part, tiny, which does the dangerous work (writing to the database) and does <em>only</em> that, on data already validated.</li></ul><p>The two talk over a narrow, typed channel: the unprivileged part can ask "add this row", never "run this command". A bug in the parser then gives the attacker an <em>unprivileged</em> program, and the privileged part does not regain the right to do anything it likes.</p><p>The <strong>notion of trust</strong> completes the idea: you draw a boundary, and you decide "inside this boundary, I trust". Every bug that overturns a trust assumption must be reported: otherwise the boundary is fiction.</p><p><strong>Remember:</strong> security does not come from perfect code, but from a split in which one component\'s mistake stays local. That is what we call <em>defence in depth</em>.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on the split and on trust.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'In an architecture with separated privileges, who can write to the database?',
						'choices'     => array(
							'The unprivileged part, directly',
							'Any process on the server',
							'Only the privileged part, on request from the unprivileged part',
							'The client, through a direct SQL query',
						),
						'hint'        => 'Separation exists precisely to reserve the power for a single component.',
						'explanation' => 'Only the privileged component writes. The unprivileged component only <em>asks</em>, over a typed and limited channel. The client never gets direct access to the database.',
					),
					1 => array(
						'question'    => 'You find a bug in the unprivileged part. What happens if you never told anyone that this component was trusted?',
						'choices'     => array(
							'Nothing: a bug only matters if it is critical',
							'The program updates itself',
							'The program must be rewritten in Java',
							'The trust boundary is wrong: the attacker may already be past the perimeter',
						),
						'hint'        => 'Trust is an assumption written down somewhere. Who wrote it?',
						'explanation' => 'Trust must be <em>explicit</em>. A "trusted" component with no documentation of what is expected of it is an imaginary boundary: the first bug/docs pair shows it never existed.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the separation policy',
				'content' => '<p>Course 6.858 left its <em>privilege separation policy</em> in the classroom (the file describing which processes run with which rights).</p><p><strong>Mission.</strong> Read that policy and note the <em>privilege level value of the main process</em> it sets (the trust level announced for the web service).</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the privilege level of the main process announced in the privilege separation policy.',
						'hint'        => 'The policy is in <code>/etc/secura-policy</code>. One <code>ls</code> and one <code>cat</code> are enough.',
						'explanation' => 'A privilege separation policy says who does what, with which rights. Being able to read that document is being able to judge whether a service is properly split.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the main goal of privilege separation?',
						'choices'     => array(
							'Make the program faster',
							'Reduce the size of the code',
							'Avoid writing tests',
							'Make a bug in one part stay local and powerless',
						),
						'hint'        => 'Think about what the attacker gets if they find a bug.',
						'explanation' => 'Privilege separation limits the <em>power</em> a bug hands over. That is defence in depth: even with a bug, the system bends without collapsing.',
					),
					1 => array(
						'question'    => 'A "narrow, typed channel" between the two parts means what?',
						'choices'     => array(
							'An interface that only accepts expected messages, not free-form commands',
							'An encrypted tunnel between the two processes',
							'A file shared by both processes',
							'A network port reserved for administration',
						),
						'hint'        => 'The channel must forbid what would be dangerous.',
						'explanation' => 'The channel is <em>typed</em>: the unprivileged part can ask for planned operations ("write a log line"), not chain arbitrary commands. That is what makes the boundary checkable.',
					),
					2 => array(
						'question'    => 'What is the main risk when you separate privileges?',
						'choices'     => array(
							'The program gets slower',
							'The separation adds communication points that can become flaws themselves',
							'The code becomes harder to read',
							'The program has to be rewritten in Rust',
						),
						'hint'        => 'Every new boundary is a new surface.',
						'explanation' => 'Separating creates an interface: if it is badly built (no validation, races, over-broad messages), it becomes the weak link. The course shows this trade-off in every lecture.',
					),
					3 => array(
						'question'    => 'The web server runs as root and so does the backup service. What is the defect?',
						'choices'     => array(
							'None: everything runs with the same rights, which is consistent',
							'The backup cannot read the logs',
							'Both processes sit in the same trust zone, so a flaw in one grants the power of the other',
							'The web service cannot start',
						),
						'hint'        => 'Two processes with the same rights: where is the boundary?',
						'explanation' => 'If both processes hold the same privileges, there is no separation: a flaw in the web server grants root. The course insists: separation is pointless if the rights are the same.',
					),
				),
			),
		),
	),

);
