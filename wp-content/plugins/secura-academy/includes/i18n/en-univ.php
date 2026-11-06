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

	/* ---------------------------------------------------------------------
	 * univ-04 — Bac a sable : confiner le code natif
	 * ------------------------------------------------------------------ */
	'univ-04' => array(
		'title'   => 'Sandboxing: confining native code',
		'excerpt' => 'Isolating a doubtful program in a closed space: the sandbox, its rules, and what it does not protect.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — the sandbox',
				'content' => '<p>A <strong>sandbox</strong> is a confined execution space: the program runs there, but its capabilities are reduced to an allow-list. That is what lets you open a downloaded file, test a doubtful regular expression, or run a plugin without trusting it.</p><p>The techniques combine:</p><ul><li><strong>System restrictions</strong>: forbid certain system calls (open a network connection, start a process).</li><li><strong>Separate memory spaces</strong>: the program runs in an area that contains only itself.</li><li><strong>Resource control</strong>: CPU time, memory, number of files — otherwise a malicious program settles in by eating the machine.</li><li><strong>Call filtering</strong>: the sandbox intercepts calls and lets through only the allowed ones.</li></ul><p>And the question the course asks: <strong>what happens if the program escapes the sandbox?</strong> All the security then rests on the strength of the mechanism itself. Hence the idea of <em>defence in depth</em>: a sandbox, plus privilege separation, plus filtering — if one fails, the others hold.</p><p><strong>Remember:</strong> a sandbox does not make code safe; it makes <em>the damage</em> bounded. That is already a great deal.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions: what the sandbox bounds, and what it does not protect.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'A sandbox limits memory, CPU time and system calls. What is the exact goal?',
						'choices'     => array(
							'Make the program faster',
							'Replace code review',
							'Guarantee that the program is correct',
							'Bound the damage if the program is malicious or buggy',
						),
						'hint'        => 'The sandbox does not judge the program: it frames its powers.',
						'explanation' => 'A sandbox does not say whether the program is good or bad: it says "even if it is, here is what it can do". The guarantee is about damage, not correctness.',
					),
					1 => array(
						'question'    => 'Why does the course insist on defence in depth after the sandbox lesson?',
						'choices'     => array(
							'Because a single mechanism can have a flaw: the others limit the damage',
							'Because the sandbox is too slow',
							'Because two web servers are needed',
							'Because the sandbox only works on Linux',
						),
						'hint'        => 'What happens if the attacker escapes the sandbox?',
						'explanation' => 'If escape is possible, a single mechanism is not enough. Stacking independent mechanisms (sandbox + separated privileges + filtering) means escaping one is not enough to break everything.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the confinement rule',
				'content' => '<p>In the classroom, the team left the <em>confinement profile</em> used for the automated checks: the file that says what the confined program is allowed to do.</p><p><strong>Mission.</strong> Read that profile and note the <em>maximum process count value</em> it allows (<code>max_processes</code>). That is the proof you understood what a sandbox bounds.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the max_processes value announced in the sandbox confinement profile.',
						'hint'        => 'The profile is a configuration file: look for a .conf or a .toml in <code>/etc/secura-policy</code>.',
						'explanation' => 'Bounding the process count stops a program from launching a rain of subprocesses.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Which technique is NOT a way to confine a program?',
						'choices'     => array(
							'Compiling it with a more aggressive optimiser',
							'Forbidding certain system calls',
							'Isolating its memory',
							'Bounding CPU time and memory',
						),
						'hint'        => 'One of the four does not change the capabilities of the program.',
						'explanation' => 'An optimiser changes speed, not rights. Confinement is a question of <em>capabilities</em>: system calls, memory, resources, communication.',
					),
					1 => array(
						'question'    => 'A confined program can still consume all the RAM of the machine if you forget what?',
						'choices'     => array(
							'The process name',
							'The memory limit',
							'The listening port',
							'The PATH environment variable',
						),
						'hint'        => 'With no resource limit, a program can "eat" the machine.',
						'explanation' => 'Confinement without quotas (memory, CPU, PIDs, file size) lets a program consume the machine: that is a denial of service, not a data leak, but it is enough to paralyse the service.',
					),
					2 => array(
						'question'    => 'After the sandbox lesson, the course moves on to "Ur/Web". Why?',
						'choices'     => array(
							'Because the language is more modern',
							'Because a faster language is needed',
							'Because memory-safe languages show another way to shrink the attack surface',
							'Because the sandbox has been abandoned',
						),
						'hint'        => 'The question is not only "where to run", but also "what to run".',
						'explanation' => 'The course shows two families of answers: confining execution (sandbox) and shrinking the attack surface at the source (memory-safe languages, where buffer overflows no longer exist).',
					),
					3 => array(
						'question'    => 'A sandbox lets every call through except file writes. What is the main remaining risk?',
						'choices'     => array(
							'None: the rest does not matter',
							'The display colour of the program',
							'The name of the account that runs it',
							'CPU and memory consumption, if nothing bounds them',
						),
						'hint'        => 'A sandbox filters actions; it does not necessarily manage resources.',
						'explanation' => 'Filtering actions does not replace quotas: a program that allocates without end remains a problem. Both dimensions (allowed actions, resources) must be bounded.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * univ-05 — Le web et ses regles : SOP, CSRF et sessions
	 * ------------------------------------------------------------------ */
	'univ-05' => array(
		'title'   => 'The web and its rules: SOP, CSRF and sessions',
		'excerpt' => 'Why the browser sometimes mixes sites together, and how to stop one site from acting in your name.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — the web security model',
				'content' => '<p>The web rests on a simple, misleading rule: <strong>the same origin</strong>. A script can only read the data of its own site. That is what protects the password you type into a bank, even when the page is fake.</p><p>But the prohibition has a blind side: the <strong>SOP policy</strong> stops a page <em>reading</em> the responses of another site, not another site <em>sending</em> a request with your credentials. That is <strong>CSRF</strong>:</p><ol><li>you are logged in to your bank;</li><li>you open, in another tab, a page from a malicious site;</li><li>that page automatically sends a request to the bank: "transfer 500 to my account";</li><li>the bank sees the request, it really does come from you (your credentials are attached), and it executes it.</li></ol><p>The simplest fix: the <strong>CSRF token</strong>. The server places a secret value in the form; the browser sends that token back with every request; the server rejects any request without a token. An external site cannot read that token (SOP rule), so it cannot send it back.</p><p>And the other fixes: the password must not be stored in clear text, the session must be protected by an <code>HttpOnly</code> and <code>Secure</code> cookie, and sensitive requests must be checked on the server (never trust the form).</p><p><strong>Remember:</strong> the browser is a trusted intermediary. It forwards tokens on request, and it does not check who is asking.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on the web model and its fixes.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'The same-origin rule (SOP) stops a page from site A reading the response of site B. What does it not stop?',
						'choices'     => array(
							'Site B receiving a request sent from page A, credentials included',
							'Displaying a link to site B',
							'Site A loading an image from site B',
							'The browser keeping the history',
						),
						'hint'        => 'SOP talks about <em>reading</em> responses. Does it say anything about requests?',
						'explanation' => 'SOP is a <em>reading</em> rule. The browser sends requests with the session credentials without asking the user: that is the blind spot CSRF exploits.',
					),
					1 => array(
						'question'    => 'Why does the CSRF token resist the attack?',
						'choices'     => array(
							'Because it is encrypted',
							'Because a third-party page cannot read the token of the page',
							'Because it expires after one second',
							'Because it is stored in an HttpOnly cookie',
						),
						'hint'        => 'The malicious site can send the request; can it read the token?',
						'explanation' => 'The token is in the page of the legitimate site; the malicious site cannot read it (SOP), so it cannot copy it. It cannot guess it either, if it is random.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the web course notes',
				'content' => '<p>In the classroom, course 6.858 left its <em>web lesson notes</em> (the document summarising SOP, CSRF and the fixes).</p><p><strong>Mission.</strong> Read those notes and note the <em>token name value</em> used in the course example (the exact parameter name, in lower case, without braces).</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the token name used in the web course example.',
						'hint'        => 'The web course notes are in <code>/srv/cours/mit858</code> (a .txt or .md file).',
						'explanation' => 'Recognising the token name in a concrete example is what lets you use it later in a real form.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'A bank uses a session cookie without the HttpOnly attribute. What is the risk?',
						'choices'     => array(
							'No risk, the cookie stays private',
							'A script injected into a page can read the session cookie',
							'The cookie gets bigger',
							'The session can no longer be closed',
						),
						'hint'        => 'HttpOnly: who can see the cookie?',
						'explanation' => 'HttpOnly stops JavaScript from reading the cookie: a script injection cannot steal the session. Secure forces HTTPS. The two go together.',
					),
					1 => array(
						'question'    => 'What is the role of the <code>SameSite</code> cookie attribute?',
						'choices'     => array(
							'Encrypt the cookie',
							'Extend the lifetime of the cookie',
							'Tell the browser not to send the cookie on a request coming from another site',
							'Sign the cookie',
						),
						'hint'        => 'SameSite = "same site". What happens when it is not?',
						'explanation' => 'SameSite=Lax or Strict means the session cookie does not accompany a cross-site request: that is an <em>additional</em> defence against CSRF, on top of the token.',
					),
					2 => array(
						'question'    => 'The server checks the user identifier sent by the form, but never checks where the request came from. What is the risk?',
						'choices'     => array(
							'None: the server does what it is asked',
							'The server will lose its data',
							'The user password will be sent in clear text',
							'A request forged from another site can impersonate the logged-in user',
						),
						'hint'        => 'Is the request proven to come from the user?',
						'explanation' => 'Without an origin check (CSRF token, Origin header, SameSite), a forged request is indistinguishable from a real one for the server: that is the definition of CSRF.',
					),
					3 => array(
						'question'    => 'In defence in depth, what does hashing the password add when a CSRF token is already in place?',
						'choices'     => array(
							'Another remedy: even if the database is stolen, the passwords are not directly usable',
							'Nothing: both protect the same thing',
							'The password becomes shorter',
							'The login becomes faster',
						),
						'hint'        => 'The two mechanisms protect different things.',
						'explanation' => 'The CSRF token protects the identity <em>during</em> the session; hashing protects the passwords <em>after</em> a database theft. Each layer deals with a different threat.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * univ-06 — Segmenter, isoler, pivoter
	 * ------------------------------------------------------------------ */
	'univ-06' => array(
		'title'   => 'Segment, isolate, pivot: network security',
		'excerpt' => 'The network does not protect anything by itself: without segmentation, one open door gives away the whole building.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — segmentation and pivoting',
				'content' => '<p>The network rests on TCP/IP, a protocol designed to <em>carry</em>, not to <em>protect</em>. Three examples of what it does not do:</p><ul><li><strong>Sequence numbers</strong> are short (32 bits): they can be guessed and data injected into a connection.</li><li><strong>The IP address</strong> is easy to spoof: nothing checks that the machine sending really is the one it claims to be.</li><li><strong>Baseline encryption</strong> does not exist in TCP/IP: everything travels in clear text on the wire.</li></ul><p>The basic answer is <strong>segmentation</strong>: cut the network into zones, and place firewalls <em>between</em> the zones. The goal is not to stop the attack, but to stop it spreading: a compromised web server in the "public" zone must not be able to reach the database in the "data" zone.</p><p>And if the attacker is <em>already</em> inside the network? That is the <strong>pivot</strong>: using a compromised machine as a relay to reach a zone you cannot see. A real firewall that blocks traffic coming from the inside is therefore essential: the public zone never talks directly to the internal zone.</p><p><strong>Remember:</strong> network security is not played out on the cable, but on the <em>plan</em>: who talks to whom, and with what justification.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on what the network does, and what it does not do.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'A machine in the public network can send a request directly to the database server. What is the defect?',
						'choices'     => array(
							'Segmentation is incomplete: the public zone should not reach the data zone',
							'None: that is normal, the public network is made for that',
							'The database server is too slow',
							'The TCP/IP protocol is too old',
						),
						'hint'        => 'What is a firewall for, if it sits between two zones that talk freely?',
						'explanation' => 'If the public reaches the data directly, there is no separation left: the smallest flaw on the web side hands over the data. Segmentation exists so that path does not exist.',
					),
					1 => array(
						'question'    => 'Why is encryption in modern protocols done "above" TCP/IP rather than "inside" it?',
						'choices'     => array(
							'Because it is faster',
							'Because security must come from the application (TLS) and not from a transport that knows no context',
							'Because TCP/IP is forbidden in Europe',
							'Because the router cannot encrypt',
						),
						'hint'        => 'The transport does not know what it is transporting: it cannot know what is secret.',
						'explanation' => 'The transport moves bytes without knowing what they mean. Confidentiality must come from the application (TLS) or from a tunnel (VPN), which do understand the data.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the segmentation plan',
				'content' => '<p>In the classroom, the team left the <em>segmentation plan</em> for the lab network (the document describing the zones and the firewall between them).</p><p><strong>Mission.</strong> Read that plan and note the <em>zone number value</em> assigned to the sensitive data zone (the <code>zone_id</code> field of the most restricted zone).</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the zone number (zone_id) of the sensitive data zone in the segmentation plan.',
						'hint'        => 'The plan is in <code>/srv/cours</code>: list the folders, then read the files whose name mentions "plan" or "segmentation".',
						'explanation' => 'Reading a segmentation plan is knowing where to put a firewall. The zone number is what lets you check you are talking about the right zone.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the main role of network segmentation?',
						'choices'     => array(
							'Speed up exchanges between zones',
							'Limit the spread of a compromise from one zone to another',
							'Reduce the number of servers',
							'Make the firewall unnecessary',
						),
						'hint'        => 'Think about the role of the firewall "between" the zones.',
						'explanation' => 'Segmentation does not aim to forbid everything, it aims to <em>compartmentalise</em>: a compromise must stay in its zone. That is the difference between a flat network and a controlled one.',
					),
					1 => array(
						'question'    => 'A compromised machine in the "public" zone manages to reach the "internal" zone. What comes first?',
						'choices'     => array(
							'Change every password',
							'Shut down the web server',
							'Find where the path was possible: firewall rule, route, or exposed service',
							'Install an antivirus on the compromised machine',
						),
						'hint'        => 'A possible path is a path to close.',
						'explanation' => 'You look for where the passage comes from: an over-broad rule, a tunnel, a service listening. Fix the cause (the path) rather than the symptoms (the compromised machine).',
					),
					2 => array(
						'question'    => 'Why does a firewall rarely block traffic coming from the inside?',
						'choices'     => array(
							'Because it does not know how',
							'Because the router blocks upstream',
							'Because the firewall only sees incoming traffic',
							'Because outgoing traffic is treated as legitimate: it is the administration of it that has to be limited',
						),
						'hint'        => 'The firewall filters the traffic it sees. Can outgoing traffic be filtered?',
						'explanation' => 'A stateful firewall sees traffic both ways, but it lets out what is "asked for". The real answer to pivoting is segmentation plus control of outbound flows.',
					),
					3 => array(
						'question'    => 'A VPN links two remote sites. What new risk does it introduce?',
						'choices'     => array(
							'It creates a path between the two networks: a compromise can spread from one site to the other',
							'None: it encrypts everything',
							'It necessarily slows down every communication',
							'It removes the need for a firewall',
						),
						'hint'        => 'A VPN links two zones. What stands on the bridge?',
						'explanation' => 'A VPN is a tunnel: it makes two zones reachable that were not. So the same rules must be applied between them as inside each zone.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * univ-07 — TLS et HTTPS
	 * ------------------------------------------------------------------ */
	'univ-07' => array(
		'title'   => 'TLS and HTTPS: encryption that holds up',
		'excerpt' => 'What TLS negotiates, what it proves, and why the browser padlock does not mean much.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — what TLS guarantees (and what it does not)',
				'content' => '<p>When you connect over HTTPS, three things are at play:</p><ol><li><strong>The channel</strong>: the client and the server negotiate an encryption algorithm and a session key. Everything that follows travels encrypted, and nobody in the middle can read or modify it.</li><li><strong>The identity</strong>: the server presents a <strong>certificate</strong>, which says "I really am intranet.lab". The client checks it: the authority signature, the validity dates, the expected name.</li><li><strong>Freshness</strong>: a unique number per session stops someone replaying an old message.</li></ol><p>The hard point, in the course, is the <strong>chain of trust</strong>. The certificate is not signed by itself: it is signed by an authority, which is itself signed by another, all the way to a root <em>already</em> inside the browser. If the root is compromised, everything falls: that is the story of certificate authorities and their incidents.</p><p>And the limits to remember:</p><ul><li>HTTPS says nothing about what the site <em>does</em> with your data once it has it.</li><li>A valid certificate does not mean the site is honest: it means someone paid for that name.</li><li>The browser padlock guarantees encryption and <em>technical</em> identity, not reputation.</li></ul><p><strong>Remember:</strong> TLS protects the <em>pipe</em>. What happens at the other end of the pipe is the application\'s business.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on what the padlock really guarantees.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'A site shows the browser padlock. What is guaranteed?',
						'choices'     => array(
							'That the site is honest and will not collect your data',
							'That the connection is encrypted and the certificate name matches the site',
							'That the site has never been attacked',
							'That the page content is accurate',
						),
						'hint'        => 'Two guarantees, not five.',
						'explanation' => 'The padlock covers the channel (encryption) and the technical identity (the certificate name). It says nothing about how the site behaves once it has your data.',
					),
					1 => array(
						'question'    => 'Why is a compromised certificate authority a major problem?',
						'choices'     => array(
							'Because it becomes slow',
							'Because it can no longer sign free certificates',
							'Because it can sign certificates for any name, and browsers trust its root',
							'Because certificates expire too fast',
						),
						'hint'        => 'The root is already in the browser: it is accepted without discussion.',
						'explanation' => 'The whole chain rests on the root. If an intermediate authority is compromised, it can obtain valid certificates for names it does not control, and every browser will accept them.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the certificate audit',
				'content' => '<p>In the classroom, a <em>TLS audit</em> was left behind: the document describing the internal service certificate (version, algorithm, signing authority).</p><p><strong>Mission.</strong> Read that audit and note the <em>signature algorithm value</em> announced for the certificate (the <code>signature_algorithm</code> field).</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the certificate signature algorithm stated in the TLS audit.',
						'hint'        => 'The audit is in <code>/srv/cours</code>, in the network course folder.',
						'explanation' => 'Reading a TLS audit means being able to judge a certificate: algorithm, key size, validity period, signing authority.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What does TLS negotiate at the start of the connection?',
						'choices'     => array(
							'The content of the page',
							'The user password',
							'The encryption algorithm and the session key',
							'The bank card number',
						),
						'hint'        => 'It is the "handshake" step.',
						'explanation' => 'The handshake negotiates the cipher suite and establishes the session key. Application data only follows afterwards, encrypted.',
					),
					1 => array(
						'question'    => 'A certificate is signed by an intermediate authority, itself signed by a root. What is the root for?',
						'choices'     => array(
							'Encrypting the traffic',
							'Storing the passwords',
							'Setting the certificate price',
							'Being the ultimate trust anchor: the browser trusts it without checking it on every connection',
						),
						'hint'        => 'The root is already in the browser: what does that change?',
						'explanation' => 'The root is the anchor point of trust: it ships with the browser, so it is accepted by default. The whole chain is verified through it.',
					),
					2 => array(
						'question'    => 'A site is on HTTPS but the page loads a script over HTTP. What happens?',
						'choices'     => array(
							'The script can be intercepted and modified: mixed content breaks the guarantee for that part',
							'Nothing: the page is on HTTPS, so everything is protected',
							'The browser refuses to display the page',
							'The certificate is revoked',
						),
						'hint'        => 'Not every part of the page is necessarily on HTTPS.',
						'explanation' => 'Mixed content (an HTTP resource inside an HTTPS page) is blocked by modern browsers, or worse, executed in clear text: the guarantee only covers HTTPS traffic.',
					),
					3 => array(
						'question'    => 'Why does the validity period of the certificate matter?',
						'choices'     => array(
							'For billing',
							'Because an old certificate may sign algorithms now considered weak, and because it has to be revocable',
							'To know who bought the domain',
							'Because the browser only supports certificates under one year old',
						),
						'hint'        => 'Think about revocation and about algorithms changing.',
						'explanation' => 'The period limits the window in which a weak algorithm or key can be exploited, and lets a compromised certificate be revoked within a bounded delay.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * univ-08 — S'authentifier : mot de passe, session, second facteur
	 * ------------------------------------------------------------------ */
	'univ-08' => array(
		'title'   => 'Authenticating: password, session, second factor',
		'excerpt' => 'How you prove who you are, and why a password alone no longer suffices.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — proving who you are',
				'content' => '<p>An authentication system answers three questions:</p><ul><li><strong>What do you prove?</strong> Something you <em>know</em> (a password), something you <em>have</em> (a card, a key), or something you <em>are</em> (a fingerprint, a face).</li><li><strong>To whom do you prove it?</strong> The server, over a protected channel; otherwise your password travels in clear text and can be replayed.</li><li><strong>And then?</strong> The server creates a <strong>session</strong>: a random identifier, hard to guess, tied to a protected cookie.</li></ul><p>The historical weakness is the password: short, reused, transmitted or stored badly. The fixes: <strong>length</strong> (a four-word phrase beats a complicated word), <strong>salted hashing</strong> (the salt is stored alongside, and stops two identical passwords producing the same result), and a <strong>second factor</strong> (a one-time code on your phone).</p><p>And above all: <strong>logout</strong> and <strong>session</strong>. A badly protected session cookie (no HttpOnly, no expiry, never revoked) is as serious as a weak password: it is not stolen, it is copied.</p><p><strong>Remember:</strong> you do not authenticate a password, you authenticate a <em>session</em>. Anything that weakens the session (unprotected cookie, no expiry, no revocation) is an authentication defect.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions: the right reflex, and the forgotten weak link.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the best password according to the course recommendations?',
						'choices'     => array(
							'A complicated word with digits and symbols',
							'The same one everywhere, with a capital added',
							'A phrase of several words, long, with no date and no personal name',
							'A dictionary word with a digit at the end',
						),
						'hint'        => 'What counts is length and unpredictability, not "complexity".',
						'explanation' => 'Current recommendations favour length: "blue cat really fast" is stronger and easier to remember than "P@ssw0rd!".',
					),
					1 => array(
						'question'    => 'The site offers "remember me" with a token that never expires and cannot be revoked. What is the problem?',
						'choices'     => array(
							'None, it is convenient',
							'The token is too short',
							'The browser will refuse to store it',
							'A stolen token stays usable forever: the session can no longer be withdrawn',
						),
						'hint'        => 'Think about what you do when you believe an account has been stolen.',
						'explanation' => 'Revocability is what lets you cut access. Without it, "log out everywhere" is impossible, and a stolen token is permanent access.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the authentication policy',
				'content' => '<p>In the classroom, the service <em>authentication policy</em> (the document setting the rules: minimum length, number of attempts, second factor).</p><p><strong>Mission.</strong> Read that policy and note the <em>minimum password length value</em> (<code>min_length</code> field).</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the minimum password length set by the authentication policy.',
						'hint'        => 'The policy is in <code>/srv/cours</code>, in the folder of the authentication course.',
						'explanation' => 'Reading an authentication policy means being able to tell whether a service is configured properly: length, attempts, second factor, unlocking.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Why salt a password before hashing it?',
						'choices'     => array(
							'To make it longer',
							'To encrypt the database',
							'To make the password faster to type',
							'So two accounts with the same password do not share a hash, and precomputed tables are useless',
						),
						'hint'        => 'What happens if everyone has the same password?',
						'explanation' => 'The salt makes the computation unique per account: a precomputed (rainbow) table can no longer be applied to the whole database at once. It is also what lets you change algorithm later.',
					),
					1 => array(
						'question'    => 'What is the role of the session cookie?',
						'choices'     => array(
							'Carry a random session identifier, hard to guess, that replaces the password on every request',
							'Store the password in clear text so it is not asked again',
							'Encrypt the page for the search engine',
							'Stop RAM from remembering the site',
						),
						'hint'        => 'The password must not travel on every request.',
						'explanation' => 'The cookie holds only a random, unguessable identifier, tied server-side to the session. Stealing the cookie means stealing the session: hence the importance of HttpOnly and Secure.',
					),
					2 => array(
						'question'    => 'Is a second factor of the "something you know" kind (a PIN) really a second factor?',
						'choices'     => array(
							'Yes, it is extra information',
							'No: a second factor must be of a different nature than the password, otherwise stealing the password is enough',
							'Yes, but only if it is long',
							'No, because PINs are forbidden',
						),
						'hint'        => 'The three factors: what you know, what you have, what you are.',
						'explanation' => 'The second factor must come from another category: what you <em>have</em> (a phone) or what you <em>are</em> (biometrics). A PIN stays "something you know".',
					),
					3 => array(
						'question'    => 'What should a server do when it receives too many login attempts?',
						'choices'     => array(
							'Block the account permanently without telling the user',
							'Do nothing: limiting is the user\'s business',
							'Slow down or temporarily block the attempts, and warn the user',
							'Send the password in clear text to check it',
						),
						'hint'        => 'Think about both the attack and the legitimate user.',
						'explanation' => 'Limiting attempts slows credential stuffing; blocking the account without warning punishes the legitimate user (and becomes a free denial of service).',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * univ-09 — Cryptographie : cle, chiffrement, signature
	 * ------------------------------------------------------------------ */
	'univ-09' => array(
		'title'   => 'Cryptography: key, encryption, signature',
		'excerpt' => 'The three building blocks of modern cryptography, and the question that decides everything: whom do you trust?',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — the three building blocks',
				'content' => '<p>Ron Rivest starts with a simple question: <strong>whom do you trust?</strong> All of modern cryptography follows from that answer.</p><ol><li><strong>Symmetric encryption</strong> (one key to encrypt and decrypt: AES). Fast, solid, but both parties must share the key: how do you exchange it <em>without</em> sending it? That is the key distribution problem.</li><li><strong>Asymmetric encryption</strong> (two linked keys: one public, one private: RSA, elliptic curves). The public key can travel openly, over an insecure channel: that is what solves the distribution problem. Slower, so reserved for keys and signatures.</li><li><strong>The digital signature</strong>: you sign with your private key, you verify with the public key. It proves the <em>origin</em> and the <em>integrity</em> of the message — not its secrecy.</li></ol><p>And <strong>hashing</strong>: a short, one-way fingerprint. It checks that a file has not changed (the course digital fingerprint), and it underpins passwords (with salt) and signatures.</p><p><strong>Remember:</strong> encryption hides, a signature proves. Confusing the two is the classic mistake in the exercise.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions: what each block is for, and whom you trust.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Why use asymmetric encryption to exchange a session key?',
						'choices'     => array(
							'Because it is faster',
							'Because symmetric encryption is forbidden',
							'Because the public key is shorter',
							'Because its public key can travel without secrecy, solving the key distribution problem',
						),
						'hint'        => 'The problem to solve is distribution, not speed.',
						'explanation' => 'Symmetric is fast but needs a safe channel for the key. Asymmetric, slow, is used to protect that key: the channel no longer needs to be secret.',
					),
					1 => array(
						'question'    => 'Is a signed message encrypted?',
						'choices'     => array(
							'No: the signature proves origin and integrity, the content stays readable by anyone',
							'Yes, signing amounts to encrypting with the private key',
							'Yes, unless the key is old',
							'It depends on the server',
						),
						'hint'        => 'What does the signature do, and what does it not do?',
						'explanation' => 'A signature hides nothing: it proves who produced the message and that it was not modified. Encryption is what hides.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the cryptography notebook',
				'content' => '<p>In the classroom, course 6.042 left its <em>cryptography notebook</em> (the document presenting the three blocks with their algorithms).</p><p><strong>Mission.</strong> Read that notebook and note the <em>key size value</em> used by the symmetric encryption example (<code>key_size</code> field, in bits).</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the key size (key_size, in bits) stated in the cryptography notebook.',
						'hint'        => 'The notebook is in <code>/srv/cours</code>, in the cryptography course folder.',
						'explanation' => 'Knowing the key size of an example is understanding what "strong" means: security rests on computation time, not on secrecy of the algorithm.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is a "one-way" hash?',
						'choices'     => array(
							'A function that cannot be inverted: recovering the original from the fingerprint is computationally impossible',
							'An encryption that can only be decrypted one way',
							'An encryption whose key is random',
							'A fingerprint that changes on every run',
						),
						'hint'        => 'You can compute the fingerprint one way; the other is out of reach.',
						'explanation' => 'Hashing is deterministic (same input, same fingerprint) but not invertible in practice. That is what lets you verify integrity without keeping a secret.',
					),
					1 => array(
						'question'    => 'What does a digital signature prove?',
						'choices'     => array(
							'That the message is secret',
							'That the message comes from the holder of the private key and was not modified',
							'That the recipient is acting in good faith',
							'That the message was sent over the network',
						),
						'hint'        => 'Two guarantees, not one.',
						'explanation' => 'A signature covers the <em>origin</em> (authentication) and the <em>integrity</em>. It says nothing about secrecy, nor about the honesty of the recipient.',
					),
					2 => array(
						'question'    => 'Why do we not trust secret algorithms?',
						'choices'     => array(
							'Because they are slower',
							'Because the law forbids them',
							'Because a secret algorithm cannot be studied: and security rests on everyone being able to check that it holds',
							'Because they only work with short keys',
						),
						'hint'        => 'Kerckhoffs: security must not rest on secrecy of the system.',
						'explanation' => 'Kerckhoffs\' principle: the secret is the key; the algorithm must be public and auditable. A secret algorithm necessarily hides weaknesses.',
					),
					3 => array(
						'question'    => 'A service uses symmetric encryption with the same key for every client. What is the defect?',
						'choices'     => array(
							'It is the most efficient',
							'It is too slow for the Internet',
							'Clients can no longer talk to each other',
							'Compromising one key exposes every client, and the key needs a safe channel to be distributed',
						),
						'hint'        => 'Think about what happens to the key if it leaks once.',
						'explanation' => 'One key per session stops a single leak compromising everybody, and asymmetric cryptography can protect the exchange of that session key.',
					),
				),
			),
		),
	),

);
