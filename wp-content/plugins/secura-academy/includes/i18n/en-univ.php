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
							'The threat is the scenario; the vulnerability is a weakness',
							'The threat is the forged request; the vulnerability is the attacker himself',
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
							'Nothing: a firewall handles one threat, not the others',
							'The integrity of the data, even against a malicious administrator',
							'Integrity and availability of the service, because the firewall cannot be crossed',
						),
						'hint'        => 'A mechanism proves nothing on its own: you have to know what it assumes.',
						'explanation' => 'The firewall is a mechanism, not a proof. Until you have written down the threat model (insider? application flaw?), you cannot claim the policy is respected. That is the whole message of the lesson: security is demonstrated, not assumed.',
					),
					2 => array(
						'question'    => 'You have a {big} database of photos and a {small} web server. Which do you protect first?',
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
				'content' => 'In the classroom machine, the team left the semester deliverables. In <code>/srv/cours/mit858</code>, the document <code>analyse-risque.md</code> lists the assets, the possible adversaries and the rules to enforce.</p><p><strong>Mission.</strong> This room\'s flag is the <em>fingerprint of the document</em>, not a sentence inside it: the first eight characters of the file\'s sha256. A fingerprint cannot be read, it has to be computed — that is the proof you opened the right file.',
				'questions' => array(
					0 => array(
						'question'    => 'Compute the fingerprint (sha256, first 8 characters) of analyse-risque.md from course 6.858.',
						'hint'        => 'The command: <code>sha256sum /srv/cours/mit858/analyse-risque.md</code>, then <code>cut -c1-8</code> on the output. Check the exact file name with <code>ls</code> first.',
						'explanation' => 'A fingerprint proves two things at once: that you read the right file, and that it has not changed since. That is exactly what an auditor does with a piece of evidence: they do not trust the content, they verify the seal.',
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
							'Enforce the policy, as long as the threat model holds',
							'Replace the threat model, which then becomes unnecessary for good',
							'Document the decisions taken for the team',
						),
						'hint'        => 'A mechanism acts "as long as" a condition holds. Which one?',
						'explanation' => 'The key sentence of the course: the mechanism enforces the policy <em>as long as the adversary respects the threat model</em>. If the model is wrong, the mechanism no longer protects.',
					),
					1 => array(
						'question'    => 'Your service must be reachable from the students\' homes, but only teachers may change the settings. Which policy?',
						'choices'     => array(
							'Everyone can change the settings, it is simpler',
							'Students reach the service over the school internal network only',
							'Teachers change the settings; the students use the service',
							'The service is reachable by teachers only',
						),
						'hint'        => 'Two actions, two populations: re-read the question, it contains both.',
						'explanation' => 'A policy is written as principals × actions × objects: "students may use the service; only teachers may reconfigure it". That is the framework set by module 1 of 6.858 (threats) and 6.857 (policies).',
					),
					2 => array(
						'question'    => 'A service runs as root although it only needs to read one file. What should be done?',
						'choices'     => array(
							'Leave it as it is: root always works fine',
							'Add a second root service for redundancy purposes',
							'Uninstall the service and replace it with a home-made script',
							'Remove the unnecessary rights: that is least privilege',
						),
						'hint'        => 'It is lesson 4 of the course: "Privilege Separation".',
						'explanation' => 'Removing unnecessary rights applies least privilege: if the service is compromised, the attacker only gets an unprivileged account. Lesson 4 of the course makes it a principle in its own right.',
					),
					3 => array(
						'question'    => 'A firewall blocks 100% of external requests, but the application has a SQL injection. What do you conclude?',
						'choices'     => array(
							'The mechanism does not cover the threat: the flaw remains',
							'The system is safe: the firewall blocks everything',
							'The system is safe as long as nobody tries to really test it',
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
							'It is overwritten too, and noticed on return',
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
							'Encrypt the memory of the program at rest',
							'Stop the program from writing outside the buffer',
							'Move the memory areas on every single run',
							'Check that the binary was not modified since',
						),
						'hint'        => 'Two guesses: the layout is randomised, and the space is the address space.',
						'explanation' => 'ASLR randomises addresses, so the attacker has to guess where the return address sits. It does not stop the write: it makes the target unpredictable.',
					),
					1 => array(
						'question'    => 'Why does NX make ROP necessary?',
						'choices'     => array(
							'Because NX allows execution on the heap but not on the stack at all',
							'Because NX encrypts the whole stack in memory',
							'Because NX disables the canary on the stack',
							'Because the stack is not executable: placed code cannot run',
						),
						'hint'        => 'NX = No-eXecute. Which area do you place code in?',
						'explanation' => 'With NX the stack is only data: leaving shellcode there is no longer enough. The attacker uses code fragments already present (gadgets) and builds a chain of calls: that is Return-Oriented Programming.',
					),
					2 => array(
						'question'    => 'A C program reads with <code>gets()</code> into a {size}-byte buffer. What is the real problem?',
						'choices'     => array(
							'gets() has no limit: input can overflow it',
							'gets() is far too slow for any real input',
							'gets() only works in plain ASCII text',
							'gets() only works with arrays of bytes in memory',
						),
						'hint'        => 'The function name says it all: "get" with no "n" and no size.',
						'explanation' => '<code>gets()</code> reads a line without knowing the size of the array. It is the very example the course shows in the first minute, and the reason it must no longer be used.',
					),
					3 => array(
						'question'    => 'Why does the canary not protect against a heap overflow?',
						'choices'     => array(
							'Because the canary is far too short for the job',
							'Because the canary is on the stack, not in the heap',
							'Because the canary is encrypted by the compiler',
							'Because the canary simply expires after a few seconds',
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
				'content' => 'In the classroom, course 6.858 left its <em>web notes</em> (<code>/srv/cours/mit858/web-notes.txt</code>): they recap the same-origin policy, CSRF and its fix.</p><p><strong>Mission.</strong> The form\'s configuration block is in the file, in three columns: <code>csrf     = TOKEN-…</code>. The flag value is what follows the <code>=</code>, as written. Find it with a command, not by eye.',
				'questions' => array(
					0 => array(
						'question'    => 'Extract the value of the csrf field from the web course notes (web-notes.txt).',
						'hint'        => 'The line is indented: <code>grep "^ *csrf" /srv/cours/mit858/web-notes.txt</code> finds it, then <code>cut -d" " -f5</code> isolates the value. Shorter: <code>awk \'/^ *csrf *=/{print $3}\' /srv/cours/mit858/web-notes.txt</code>.',
						'explanation' => 'A CSRF token is a random value tied to the session: the legitimate form knows it, a third-party site cannot guess it. Reading it in a configuration file is understanding where the server keeps it and how an attacker might steal it.',
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
				'content' => 'In the classroom, the <em>segmentation plan</em> of the lab network describes the zones and what each holds. The file <code>/srv/cours/mit857/segmentation-plan.txt</code> lists the services of the most restricted zone, one per line, as <code>service:port</code>.</p><p><strong>Mission.</strong> This room\'s flag is the <em>first service in alphabetical order</em>: it is the one that starts first, and therefore the one you check first.',
				'questions' => array(
					0 => array(
						'question'    => 'Which is the first service (alphabetical order) in the sensitive data zone?',
						'hint'        => 'Cut the port, sort, take the first: <code>cut -d: -f1 /srv/cours/mit857/segmentation-plan.txt | sort | head -1</code>.',
						'explanation' => 'Sorting then taking the first is an operation you repeat constantly in administration: list the services, order them, check the one that starts before the others. A backup service that starts before its volume backs up nothing.',
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
				'content' => 'In the classroom, a <em>TLS audit</em> was left in <code>/srv/cours/mit857/tls-audit.txt</code>: the service certificate is described there line by line.</p><p><strong>Mission.</strong> The flag value is the TLS version announced by the service, exactly as written (the <code>tls</code> field).',
				'questions' => array(
					0 => array(
						'question'    => 'Which TLS version does the service announce in the audit (tls field)?',
						'hint'        => '<code>awk \'/^ *tls *=/{print $3}\' /srv/cours/mit857/tls-audit.txt</code>. The version is written after the equals sign.',
						'explanation' => 'Reading the TLS version a service announces is the first reflex of an audit: TLS 1.0 and 1.1 are retired, 1.2 is still acceptable, 1.3 is the state of the art. You do not guess, you read what the service says about itself, then you verify it.',
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
				'content' => 'In the classroom, the service <em>authentication policy</em> sets the rules: minimum length, attempts, second factor. It applies to every account, and the account inventory is in <code>/srv/cours/mit857/comptes.csv</code>.</p><p><strong>Mission.</strong> The policy does not say how many accounts it protects: you have to count. The flag value is the <em>number of lines in the accounts file, minus the header line</em>.',
				'questions' => array(
					0 => array(
						'question'    => 'How many accounts does the authentication policy protect (lines of comptes.csv minus the header)?',
						'hint'        => '<code>tail -n +2 /srv/cours/mit857/comptes.csv | wc -l</code>: "tail -n +2" skips the header, "wc -l" counts what is left.',
						'explanation' => 'A policy that applies to "all accounts" without anyone knowing how many there are is not applicable: you cannot verify a perimeter you have not counted. Counting the lines of an inventory is the basic gesture of any audit.',
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
				'content' => 'In the classroom, the <em>cryptography notebook</em> presents the course\'s three building blocks (AES-256, RSA-2048, HMAC-SHA256). The lab stores three data blocks; their sizes, in bytes, are in <code>/srv/cours/mit857/tailles.txt</code>, one per line.</p><p><strong>Mission.</strong> Key size is sized on the volume to protect. The flag value is the <em>sum of the three sizes</em>.',
				'questions' => array(
					0 => array(
						'question'    => 'What is the sum of the three block sizes, in bytes (tailles.txt)?',
						'hint'        => '<code>awk \'{s+=$1} END{print s}\' /srv/cours/mit857/tailles.txt</code>. Check with <code>cat</code> first that it only contains numbers.',
						'explanation' => 'Adding up a column is half of analysis work: sizes, volumes, event counts. awk does that calculation in one line, and the result can be checked by hand when there are three values.',
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

	/* ---------------------------------------------------------------------
	 * univ-10 — x86 et memoire : comprendre la pile
	 * ------------------------------------------------------------------ */
	'univ-10' => array(
		'title'   => 'x86 and memory: understanding the stack',
		'excerpt' => 'Registers, stack, addresses: the three ingredients the CPU handles all the time.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — registers, stack, addresses',
				'content' => '<p>A running program is three things moving all the time: <strong>data</strong>, <strong>addresses</strong>, and a <strong>program counter</strong> that says "execute this instruction". On x86-64, data lives first in <strong>registers</strong> (ultra-fast slots: <code>rax</code>, <code>rdi</code>, <code>rsp</code>, <code>rbp</code>...), then in <strong>memory</strong>, which is cut into areas.</p><p>The area that concerns us is the <strong>stack</strong>. On every function call, the stack <em>grows</em> downwards: the local variables are placed there, then the return address. Mental picture, from top to bottom:</p><ul><li>local variables (the buffer we are going to fill);</li><li>the <strong>canary</strong> (a sentinel value);</li><li>the <strong>return address</strong> (where the CPU must resume after the function);</li><li>the <strong>stack pointer</strong> (<code>rsp</code>), which says where the stack ends.</li></ul><p>Two ideas to keep:</p><ul><li><strong>An overflow spills upwards</strong>: towards the return address. That is exactly what we want to reach.</li><li><strong>Addresses are numbers</strong>: if I know the address of an instruction, I can jump to it. That is the starting point of ROP, two rooms away.</li></ul><p><strong>Remember:</strong> understanding the stack is understanding <em>where</em> a program puts its data — and therefore where an attacker can act.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on the stack and the registers.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'In which direction does the stack grow during a function call?',
						'choices'     => array(
							'Downwards, towards decreasing addresses',
							'Upwards, towards increasing addresses',
							'It never grows',
							'It depends on the compiler',
						),
						'hint'        => 'On x86-64 the stack descends: <code>rsp</code> decreases.',
						'explanation' => 'The stack grows towards decreasing addresses (the pointer moves down). <code>rsp</code> is the stack pointer: it marks the top.',
					),
					1 => array(
						'question'    => 'Why is an overflow "upwards" so sought after?',
						'choices'     => array(
							'Because it is faster',
							'Because the return address sits just above the buffer',
							'Because the local variables are at the top',
							'Because the canary is placed at the bottom',
						),
						'hint'        => 'Draw the stack: buffer, canary, return address.',
						'explanation' => 'The buffer is at the bottom of the stack frame and the return address just above it: an overflow that overwrites that address lets you control where the CPU goes next. That is where the canary comes in.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the memory notebook',
				'content' => '<p>In the folder <code>/home/ctf/pwn</code>, pwn.college left its <em>memory notebook</em>: the notes from the assembler refresher, with the practical numbers.</p><p><strong>Mission.</strong> Read those notes and note the <em>number of bytes reserved for the buffer</em> in the practical (<code>buffer_size</code> field).</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the buffer size (buffer_size, in bytes) stated in the memory notebook.',
						'hint'        => 'One <code>ls /home/ctf/pwn</code> is enough: then read the notebook file.',
						'explanation' => 'Knowing the buffer size is being able to compute the offset: it is the first number of the practical.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the <code>rsp</code> register for?',
						'choices'     => array(
							'It holds the result of the last addition',
							'It points to the top of the stack',
							'It counts the instructions executed',
							'It stores the address of the code segment',
						),
						'hint'        => 'Read the suffix of the register name: it tells you what it points at.',
						'explanation' => '<code>rsp</code> is the stack pointer: it marks the top of the current frame. <code>rbp</code> (base pointer) gives stable access to the local variables.',
					),
					1 => array(
						'question'    => 'A program allocates a {size}-byte buffer and writes no canary byte. Why is that riskier?',
						'choices'     => array(
							'Because the program will be slower',
							'Because the buffer cannot be read',
							'Because the overflow overwrites the return address directly, with no warning',
							'Because the compiler will refuse to produce the binary',
						),
						'hint'        => 'With no sentinel, nothing notices the corruption.',
						'explanation' => 'The canary is a sentinel: without it, the corruption goes unnoticed until the return, when the CPU jumps anywhere. The overflow becomes directly exploitable.',
					),
					2 => array(
						'question'    => 'What happens if a program writes {written} bytes into a {size}-byte buffer?',
						'choices'     => array(
							'The program stops with an error',
							'The buffer grows automatically',
							'Memory is purged',
							'The {extra} extra bytes overwrite what follows the buffer on the stack',
						),
						'hint'        => 'In C, an array has no guard rail.',
						'explanation' => 'A C array is just a memory area: writing {extra} bytes beyond the {size} reserved overwrites the neighbouring memory. That is exactly what the canary tries to detect.',
					),
					3 => array(
						'question'    => 'Why are registers so important for exploitation?',
						'choices'     => array(
							'Because they hold the addresses and data in use, so controlling them means controlling the program',
							'Because they store the user password',
							'Because they are the only memory that survives a reboot',
							'Because they replace the hard disk',
						),
						'hint'        => 'Think about what the CPU copies from a register into memory.',
						'explanation' => 'The CPU works in registers first, then spills to memory. Acting on registers is acting on the behaviour of the program: that is the principle of ROP.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * univ-11 — Deborder la pile : le canari et l'offset
	 * ------------------------------------------------------------------ */
	'univ-11' => array(
		'title'   => 'Overflowing the stack: the canary and the offset',
		'excerpt' => 'How you measure an offset, and why the canary is useless if you do not know where it is.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — measuring the offset',
				'content' => '<p>The canary is an obstacle, not a wall: it can be overwritten. But to do that you must know <strong>exactly</strong> how many bytes separate the start of the buffer from the canary. That <strong>offset</strong> is measured, and that is the whole work of the practical.</p><p>The classic method, in three steps:</p><ol><li>Write a long run of recognisable characters (<code>AAAAAAAA...AAAA</code>) to go past the buffer and overwrite the canary and the return address.</li><li>The program crashes (SIGSEGV or "stack smashing detected"): the crash position tells you roughly how far you got.</li><li>Refine by changing the size and the pattern (often <code>A</code>, then <code>B</code>, then <code>C</code>…) to locate <em>exactly</em> the byte that breaks something.</li></ol><p>Once the offset is known, the attack becomes precise: fill the buffer, rewrite the canary with its original value (if you know it), then place the desired address where the return address was.</p><p>And the countermeasures: <strong>ASLR</strong> (addresses move), <strong>NX</strong> (the stack is not executable) and the canary. The course shows that combining the three makes direct exploitation very expensive: you then have to go through ROP (next room).</p><p><strong>Remember:</strong> the offset is not a trick, it is a measurement. You do not "guess": you measure, you retry, you refine.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on measurement and protections.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Why write a recognisable pattern (AAAA..., BBBB...) into the buffer?',
						'choices'     => array(
							'To fill memory faster',
							'To spot at which byte the program breaks and deduce the offset',
							'To keep the canary happy',
							'To get a better grade on the practical',
						),
						'hint'        => 'The pattern works like a ruler.',
						'explanation' => 'A pattern of distinct bytes (AAAA BBBB CCCC) works like a ruler: when the program breaks, you know exactly where you are, hence how many bytes come before the return address.',
					),
					1 => array(
						'question'    => 'ASLR makes the return address unpredictable. How does the course suggest dealing with it?',
						'choices'     => array(
							'By trying random addresses until one works',
							'By disabling ASLR in the code',
							'By using address leaks (an ASLR bypass), or by accepting that direct exploitation costs more',
							'By using longer passwords',
						),
						'hint'        => 'You do not guess a random address: you recover it.',
						'explanation' => 'ASLR forces you to <em>reveal</em> the address (an information leak: an address printed on a page, a pointer in a crash, etc.). Failing that, exploitation becomes a matter of probability.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the canary',
				'content' => '<p>In <code>/home/ctf/pwn</code>, the notes from the "Smashing the stack" practical were left behind: they describe the vulnerable program and how to measure the offset.</p><p><strong>Mission.</strong> Read those notes and note the <em>canary value</em> used by the vulnerable program (<code>canary_value</code> field).</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the canary value (canary_value) stated in the stack smashing practical notes.',
						'hint'        => 'Still <code>/home/ctf/pwn</code>: one <code>ls</code>, then one <code>cat</code>.',
						'explanation' => 'Knowing the canary value is understanding that it can be "put back": the protection only stops attacks that did not anticipate it.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the offset in a buffer overflow?',
						'choices'     => array(
							'The base address of the program',
							'The size of the canary',
							'The number of bytes between the start of the buffer and the return address',
							'The gap between the code and the data',
						),
						'hint'        => 'It is the distance to travel to reach the target.',
						'explanation' => 'The offset is that distance. Once measured, you know exactly how many bytes to write to reach the return address without destroying anything else.',
					),
					1 => array(
						'question'    => 'Why does the canary not prevent exploitation, only detect it?',
						'choices'     => array(
							'Because it is too small',
							'Because it is encrypted',
							'Because it expires',
							'Because it is checked on return from the function: the corruption is already done',
						),
						'hint'        => 'When is the canary compared?',
						'explanation' => 'The canary is compared at return time, between leaving the function and jumping. The return address has already been overwritten: it is detection, not prevention.',
					),
					2 => array(
						'question'    => 'ASLR and NX are enabled: what happens to the direct approach?',
						'choices'     => array(
							'It becomes much more expensive: the address is unknown and the payload cannot run on the stack',
							'It becomes impossible',
							'It stays exactly as easy as before',
							'It necessarily becomes faster',
						),
						'hint'        => 'The three protections do not build a wall: they build a cost.',
						'explanation' => 'Direct exploitation becomes expensive: the address is unpredictable (ASLR) and the payload cannot run on the stack (NX). The attacker then moves to ROP, which is the next room.',
					),
					3 => array(
						'question'    => 'A program detects "stack smashing detected" and stops. What does that prove?',
						'choices'     => array(
							'That the offset is wrong',
							'That the canary was overwritten: the offset may be right, but the canary has to be restored',
							'That the program is patched',
							'That the stack is full',
						),
						'hint'        => 'The canary is the alarm, not the wall.',
						'explanation' => 'The detection tells you the overflow reached the canary. The offset is probably in the right area; to succeed you must rewrite the canary with its original value (hence the leaks studied next).',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * univ-12 — ROP : construire une attaque sans shellcode
	 * ------------------------------------------------------------------ */
	'univ-12' => array(
		'title'   => 'ROP: building an attack without shellcode',
		'excerpt' => 'When the stack can no longer execute, you make the program bounce off itself.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — the return as an instruction',
				'content' => '<p>With NX, the stack is a <em>data</em> area: you can no longer leave code there to execute. But you can still <strong>choose where the program resumes</strong>. That is the whole principle of ROP.</p><p>The idea is simple and startling: a program already compiled contains useful pieces of code that end with <code>ret</code>. Those are <strong>gadgets</strong>. If the return address points to a gadget that sets a register, then to another gadget that chains on, the program strings together actions <em>without executing a single one of our instructions</em>.</p><p>An example of the reasoning:</p><ol><li><code>rdi</code> must hold the address of the string <code>"/bin/sh"</code>.</li><li>Then <code>execve</code> must be called.</li><li>A <code>pop rdi ; ret</code> gadget lets you place a value in <code>rdi</code>.</li><li>You stack: <code>pop rdi</code>, then the address of the string, then the address of <code>execve</code>.</li></ol><p>Every gadget ends with <code>ret</code>: the "return" becomes the instruction that chains the sequence. It is elegant, and it is exactly the idea of the course: you do not create code, you <em>reuse</em> what exists, the way you repair an engine using parts from another engine.</p><p>And the tinkering that never stops is the <strong>"binary lego"</strong>. The tools (<code>ROPgadget</code>, <code>pwntools</code>) exist to find gadgets and build the chain automatically.</p><p><strong>Remember:</strong> ROP shows that "no injectable code" does not mean "no exploitation". It moves the difficulty, it does not remove it.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on the principle of ROP.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is a "gadget" in ROP?',
						'choices'     => array(
							'A piece of code the attacker adds to the program',
							'A tool that finds vulnerabilities',
							'A piece of code already present in the binary, ending with <code>ret</code>',
							'A function of the libc',
						),
						'hint'        => 'With NX you cannot leave code behind: what do you use instead?',
						'explanation' => 'A gadget is a sequence of already-compiled instructions ending in a <code>ret</code>. You create nothing: you recycle. That is what makes the technique so portable.',
					),
					1 => array(
						'question'    => 'Why does the NX protection (non-executable stack) not block ROP?',
						'choices'     => array(
							'Because NX only applies to the kernel',
							'Because ROP uses AES',
							'Because NX disables the canary',
							'Because you do not execute code placed on the stack: you jump to code that is already executable',
						),
						'hint'        => 'NX forbids executing the stack, not placing addresses in it.',
						'explanation' => 'The stack only holds <em>addresses</em>: the CPU jumps to code located elsewhere (the program code), which is executable. The stack remains data.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the gadget chain',
				'content' => '<p>In <code>/home/ctf/pwn</code>, the "Return Oriented Programming" practical left its annotated <em>gadget chain</em> (the order in which to stack the gadgets).</p><p><strong>Mission.</strong> Read that annotation and note the <em>number of gadgets value</em> in the chain (<code>chain_length</code> field).</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the number of gadgets (chain_length) of the chain stated in the ROP practical.',
						'hint'        => 'The ROP practical is in <code>/home/ctf/pwn</code>: several files, read the one about the chain.',
						'explanation' => 'Counting the gadgets of a chain is understanding that an exploit is an <em>assembly</em>: each piece has a role, and order matters.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Which gadget is typically used to place an argument in the first register?',
						'choices'     => array(
							'<code>syscall ; ret</code>',
							'<code>leave ; ret</code>',
							'<code>nop ; ret</code>',
							'<code>pop rdi ; ret</code>',
						),
						'hint'        => 'You have to "pop" a value into a register.',
						'explanation' => 'In the System V ABI, arguments go in <code>rdi</code>, <code>rsi</code>... A <code>pop rdi ; ret</code> gadget places the stacked value there, and the following <code>ret</code> chains the next gadget.',
					),
					1 => array(
						'question'    => 'What happens if the gadget chain is in the wrong order?',
						'choices'     => array(
							'The values land in the wrong registers and the system call fails',
							'The program does the same thing, order does not matter',
							'The program starts more slowly',
							'The canary is disabled',
						),
						'hint'        => 'Each gadget acts on the CPU state at the moment it runs.',
						'explanation' => 'ROP is a program written in return codes: the order of the pieces determines what happens. A wrong order gives badly filled registers, hence a call that fails.',
					),
					2 => array(
						'question'    => 'Why is ROP considered more advanced than the "classic" overflow?',
						'choices'     => array(
							'Because it needs more bytes',
							'Because you have to understand the calling convention, find gadgets and build a coherent chain',
							'Because it only works on old kernels',
							'Because it needs no address at all',
						),
						'hint'        => 'You no longer leave code behind: you build an assembler program out of gadgets.',
						'explanation' => 'You must know the ABI (which registers, in which order), find compatible gadgets and order the chain. That is real construction, not brute force.',
					),
					3 => array(
						'question'    => 'Is a program with no useful gadget at all (no <code>pop rdi</code>, no useful <code>syscall</code>) exploitable through ROP?',
						'choices'     => array(
							'Yes, always',
							'Yes, by writing shellcode on the heap',
							'No, not with this technique: you have to look for another primitive',
							'Yes, if the program is 64-bit',
						),
						'hint'        => 'A chain needs pieces; with no pieces, there is no chain.',
						'explanation' => 'ROP depends on the gadgets present. If the binary offers none, the attacker switches technique (ret2libc, JOP, or another primitive).',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * univ-13 — Vulnerabilite de format string
	 * ------------------------------------------------------------------ */
	'univ-13' => array(
		'title'   => 'Format string vulnerability: the printf that talks too much',
		'excerpt' => 'One %s too many, and the program goes looking for information on your behalf.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — the format that becomes an address',
				'content' => '<p>The <code>printf</code> family is dangerously flexible: <code>printf("%s", s)</code> prints a string, but <code>printf(s)</code> reads it as a <em>format</em>. If the user controls <code>s</code>, they control what the program <strong>reads from memory</strong> — and sometimes what it <strong>writes</strong>.</p><p>The mechanics are easy to grasp:</p><ul><li><code>%x</code> prints an hexadecimal word read from the stack (or from the registers);</li><li><code>%s</code> prints the string pointed to by the value it read;</li><li><code>%n</code> <strong>writes</strong> the number of characters printed to the address it read;</li><li><code>%n</code> is the most dangerous: it is an <strong>arbitrary write</strong>.</li></ul><p>Two consequences:</p><ol><li><strong>Information leak</strong>: by stacking <code>%p</code>, you make the program spit out the addresses it holds in memory. With ASLR, that is gold: you recover the program base or the address of a libc function.</li><li><strong>Arbitrary write</strong>: with <code>%n</code>, you write a chosen value to a chosen address. You can then overwrite a jump table entry, a function pointer, or the GOT (the table of already-resolved functions) to take control of the flow.</li></ol><p>The fix is simple and well known: <strong>always pass the format as a constant</strong>, never as data. <code>printf("%s", user_input)</code> and not <code>printf(user_input)</code>. The compiler can even help you: <code>gcc -Wformat-security</code> warns.</p><p><strong>Remember:</strong> a format string is a read <em>and</em> write controller handed to the user. Fixing it costs one line of code; exploiting it takes hours.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions: reading, writing, and fixing.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What does the <code>%n</code> specifier do in an exploitation context?',
						'choices'     => array(
							'It prints the number of characters already written',
							'It reads a number from the network',
							'It cleans the stack',
							'It writes the number of characters printed to the address it just read: that is an arbitrary write',
						),
						'hint'        => 'Almost every specifier reads. That one writes.',
						'explanation' => 'The other specifiers (%x, %s, %p) read. <code>%n</code> writes the character counter to the address read from the stack: hence an arbitrary write in memory.',
					),
					1 => array(
						'question'    => 'How do you fix a vulnerable format string?',
						'choices'     => array(
							'By passing the format as a constant: <code>printf("%s", input)</code>',
							'By filtering the <code>%</code> and <code>n</code> characters',
							'By allocating more memory',
							'By encrypting the input',
						),
						'hint'        => 'The course fix is a single move.',
						'explanation' => 'The format must be a constant and the data must stay data. Character filtering is a stopgap: it gets bypassed (double %% or other encodings) and it hides the real design error.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the address leak',
				'content' => '<p>In <code>/home/ctf/pwn</code>, the "Format String Exploits" practical left its <em>leak notebook</em>: the notes from the display manipulations used to recover addresses.</p><p><strong>Mission.</strong> Read that notebook and note the <em>number of specifiers value</em> used in the leak example (<code>specifier_count</code> field).</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the number of specifiers (specifier_count) used in the leak example of the notebook.',
						'hint'        => 'The leak notebook is in <code>/home/ctf/pwn</code>: read the note files.',
						'explanation' => 'Counting the specifiers is understanding the mechanics: each <code>%p</code> consumes one value from the stack, so it shifts the read by one step.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the exact risk of <code>printf(user_input)</code>?',
						'choices'     => array(
							'The user controls what printf reads (and sometimes writes) in memory',
							'A performance risk',
							'An automatic buffer overflow',
							'A leak of the PATH environment variable',
						),
						'hint'        => 'printf is not a reader by trade: it is a formatter.',
						'explanation' => 'The data is interpreted as a format: the user chooses the specifiers, hence which places in memory are read — and with <code>%n</code>, written.',
					),
					1 => array(
						'question'    => 'How does a format string let you bypass ASLR?',
						'choices'     => array(
							'By encrypting the binary',
							'By making the program spit out the addresses it holds in memory: you recover a base to compute from',
							'By disabling the kernel',
							'By changing the CPU frequency',
						),
						'hint'        => 'ASLR hides addresses; a leak reveals them.',
						'explanation' => 'An address leak (stack address, library address, program address) lets you compute the addresses despite the randomness: the randomness becomes known.',
					),
					2 => array(
						'question'    => 'Why is <code>%n</code> so sought after in exploitation?',
						'choices'     => array(
							'Because it prints very large numbers',
							'Because it stops the program',
							'Because it lets you write a chosen value to a chosen address',
							'Because it checks the password',
						),
						'hint'        => 'The other specifiers read. That one writes.',
						'explanation' => '<code>%n</code> turns the leak into a write: you can overwrite a return address, a GOT entry, a function pointer. It is the primitive that makes modern exploitation possible.',
					),
					3 => array(
						'question'    => 'A program prints user input with <code>printf("%s", input)</code>. What risk remains?',
						'choices'     => array(
							'The format string stays exploitable',
							'The program will crash',
							'The input will be encrypted twice',
							'None for the format string, but the input still has to be length-checked (a buffer overflow is possible)',
						),
						'hint'        => 'Fixing the format string does not fix everything.',
						'explanation' => 'The format string fix is secured, but the length of the input still has to be controlled (and its type, if you want to avoid injections). Security is won one brick at a time.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * univ-14 — Mots de passe : la longueur bat la complexite
	 * ------------------------------------------------------------------ */
	'univ-14' => array(
		'title'   => 'Passwords: length beats complexity',
		'excerpt' => 'Why "three unlinked words" is stronger, safer and easier to remember than "P@ssw0rd!".',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — the password that holds',
				'content' => '<p>A password is a <em>key</em>. You do not choose it to be pretty: you choose it to resist. Three rules, and the rest is decoration.</p><ol><li><strong>Length first.</strong> Every added character multiplies the number of combinations. Four unlinked words ("peach green jacket bicycle") are remembered <em>and</em> resist, whereas a complicated word is guessed from a dictionary in seconds.</li><li><strong>Uniqueness second.</strong> A password reused on two sites means two sites can be burgled with the same key. The password of a gaming forum has become the key to your mailbox.</li><li><strong>Storage last.</strong> A password manager (the one in your browser, or a dedicated program) creates a different password for every site and remembers them for you. You no longer have to remember: you have to know where they are.</li></ol><p>And the hygiene reflexes around it: never reuse the password of another account, change it as soon as you have a doubt (a service that was burgled), and check whether a password has leaked (a service that asks for it at sign-up is already storing it).</p><p><strong>Remember:</strong> length is a technique, not a whim. A long, unique, stored password is unbeatable — even if it looks less "strong".</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions: the right reflex and the classic trap.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Which password best resists a dictionary attack?',
						'choices'     => array(
							'"jeep-storm-lantern-cherry" (four unlinked words)',
							'"Basketball2024!" (a dictionary word plus a year)',
							'"Xz!7@qP" (eight unreadable characters)',
							'"mycat" (nobody guesses an animal)',
						),
						'hint'        => 'A dictionary attack tests words, not sentences.',
						'explanation' => 'Cracking tools test millions of words and variants. Four unlinked words appear in no dictionary: it is length and randomness that protect, not symbols.',
					),
					1 => array(
						'question'    => 'You notice the same password is used on a gaming forum and on your mail. What must you do?',
						'choices'     => array(
							'Nothing: it is the same password, so it is consistent',
							'Change it first on the most important account, then on all the others, with a unique password per site',
							'Add a digit at the end everywhere',
							'Message your friends so they change too',
						),
						'hint'        => 'The most important account is the most exposed if it is burgled.',
						'explanation' => 'You start with the most critical account (mail, bank), then migrate the others to unique passwords. Adding "1" at the end changes nothing: it is the reuse that has to go.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the password sheet',
				'content' => 'In the classroom, the CYBER.ORG workshop left a <em>hygiene sheet</em> (<code>/srv/cours/cyber/password-sheet.txt</code>): length beats complexity, and the sheet offers a <em>word bag</em> to build a passphrase.</p><p><strong>Mission.</strong> The words of the bag are in <code>/srv/cours/cyber/mots.txt</code>, one per line. The flag value is the <em>first of those words in alphabetical order</em>: the one the workshop gives as an example.',
				'questions' => array(
					0 => array(
						'question'    => 'What is the first word of the bag (alphabetical order) offered for a passphrase?',
						'hint'        => '<code>sort /srv/cours/cyber/mots.txt | head -1</code>. Careful: sort orders according to the locale, check the result with the full <code>sort /srv/cours/cyber/mots.txt</code>.',
						'explanation' => 'A passphrase is built from words with no relation to each other: "rain-owl-cow" is memorable and resists better than a short word peppered with symbols. Sorting a word list is also the first step to spot duplicates in a dictionary.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Why is "P@ssw0rd!" less safe than "llama-bike-rain-9"?',
						'choices'     => array(
							'Because it contains a special character',
							'Because it is short and predictable: cracking tools test it in seconds',
							'Because it contains capitals',
							'Because it is hard to type',
						),
						'hint'        => 'Cracking tools do not guess at random: they follow rules.',
						'explanation' => '"Password" plus a year plus character substitution is one of the first patterns cracking tools try. A random phrase is in no model at all.',
					),
					1 => array(
						'question'    => 'What is a password manager for?',
						'choices'     => array(
							'Making passwords shorter',
							'Sending passwords to the bank',
							'Creating and remembering a unique password per site, without you having to memorise them',
							'Sharing passwords with friends',
						),
						'hint'        => 'The problem is not remembering, it is not reusing.',
						'explanation' => 'The manager moves the burden: you no longer remember, you know where they are. Every site gets a different password, so one data theft opens only one account.',
					),
					2 => array(
						'question'    => 'A service asks you to choose a password <em>before</em> creating the account, and never lets you see it afterwards. Is that a problem?',
						'choices'     => array(
							'No, that is normal',
							'No, only if the service is in English',
							'Yes, because the password must contain digits',
							'Yes, it may hide a bad practice: asking for the password in clear text prevents hashing it properly',
						),
						'hint'        => 'A good service should never need to know your password.',
						'explanation' => 'A service that lets you log in must store a salted hash, not the password. If it asks you for it, it cannot hash it reliably: it is a red flag worth checking.',
					),
					3 => array(
						'question'    => 'What is the best rule when hesitating between two passwords?',
						'choices'     => array(
							'Choose the longer and more unique one, even if you have to write it down at first',
							'Choose the shorter one, it is more convenient',
							'Choose one that looks like a dictionary word, it is more memorable',
							'Alternate capitals and lowercase',
						),
						'hint'        => 'Convenience has a cost; the cost is paid later.',
						'explanation' => 'Length and uniqueness protect; convenience costs you a minute. The right reflex: the longest, and a manager so you do not have to remember it.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * univ-15 — Hameconnage : lire un message avant de cliquer
	 * ------------------------------------------------------------------ */
	'univ-15' => array(
		'title'   => 'Phishing: read a message before clicking',
		'excerpt' => 'Phishing does not miss: it gets spotted. Four signals to check in thirty seconds.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — the four signals',
				'content' => '<p>A message that wants you to act fast is suspicious by nature. Phishing is a <em>lie factory</em>: a fake message imitating a bank, a school, a delivery service, to obtain a password, a code, or a click that installs software.</p><p>Four signals, to check in this order:</p><ol><li><strong>The real address</strong>: look at the domain, not at the display name. "support@bank-secure.com" is not a bank. Deceptive domains (a swapped letter, an unexpected subdomain) are the number one clue.</li><li><strong>Urgency</strong>: "your account will be blocked in 24 h", "your parcel is waiting". Urgency is a lever: it short-circuits your caution. A real bank does not threaten you by SMS.</li><li><strong>The unusual request</strong>: asking for a password, a validation code or a payment by message is <em>always</em> suspicious. Validation codes, by definition, are never shared.</li><li><strong>Inconsistency</strong>: an unusual tone, a typo, a badly copied logo, a link that does not go where it says (hover over the link before clicking).</li></ol><p>The fix: <strong>never click inside the message</strong>. Open the site by typing the address yourself, or call the service on a known number. And if a message creates panic, that is exactly the moment to slow down.</p><p><strong>Remember:</strong> what attackers use is not technology: it is urgency. Learning to see it is learning to stop.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions: recognise, and react.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'You receive "Your parcel is blocked, settle it within 2 h: http://livraison-colis-urgent.xyz/paiement". What do you do first?',
						'choices'     => array(
							'Click and pay the fee, the parcel may really be blocked',
							'Do not click: open the carrier site by typing its address, or call the official number',
							'Forward the message to a friend to ask their opinion',
							'Reply to the message to ask how much it is',
						),
						'hint'        => 'The message must never be the way to reach the site.',
						'explanation' => 'The rule: you never go through the link you received. You go to the site by its known address, or you call the official number. The link can lead anywhere — and the urgency is exactly the trap.',
					),
					1 => array(
						'question'    => 'A site asks you for an SMS validation code to "confirm" a login. What should you think?',
						'choices'     => array(
							'It is a normal two-factor request',
							'It proves the site is serious',
							'It is a theft attempt: a validation code is never shared, with anyone',
							'You should give it if the site name is correct',
						),
						'hint'        => 'Whose code is the one you receive?',
						'explanation' => 'The code you receive by SMS authenticates you. Giving it to someone lets them log in as you. That is the basic con of targeted phishing.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the phishing example',
				'content' => 'In the classroom, the workshop left an annotated <em>phishing message example</em> (<code>/srv/cours/cyber/phishing-example.txt</code>), and the list of observed signals in <code>signalements.txt</code>, one per line.</p><p><strong>Mission.</strong> The flag value is the <em>number of the line that talks about urgency</em> in that list: urgency is scam lever number one.',
				'questions' => array(
					0 => array(
						'question'    => 'Which line of signalements.txt talks about urgency?',
						'hint'        => '<code>grep -n urgence /srv/cours/cyber/signalements.txt</code>: the <code>-n</code> option shows the line number, before the colon.',
						'explanation' => 'Numbering the lines of a trace is what you do to cite evidence: "line 2 of the report". An incident report that says "a hurried message" is useless; the one that cites the line can be verified.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the best reflex when a message demands urgent action?',
						'choices'     => array(
							'Reply to find out what it is about',
							'Click: urgent messages are rare, so it must be legitimate',
							'Take your time: check the address, the sender, and reach the site yourself',
							'Forward it to everyone',
						),
						'hint'        => 'Urgency is a lever, not information.',
						'explanation' => 'Urgency exists to prevent verification. The right reflex is the pause: check the real address, the sender, and reach the service by your own means.',
					),
					1 => array(
						'question'    => 'Why is the address of the link more reliable than the display name?',
						'choices'     => array(
							'Because the display name is always in English',
							'Because links are always shorter',
							'Because the browser shows it bigger',
							'Because the display name can be copied at will, whereas the real domain is registered and traceable',
						),
						'hint'        => 'What can you do with a display name? Nothing. With a domain?',
						'explanation' => 'The "display" name is free text: "MyBank" takes a second to type. The domain, on the other hand, is registered: that is where you see "bank-officiial-secure.ru" and understand.',
					),
					2 => array(
						'question'    => 'A friend sends you a link to a game, saying "click, it is funny". What is the risk?',
						'choices'     => array(
							'Your friend\'s account may have been compromised: the message is the vector',
							'None: it is your friend',
							'The link is too long',
							'Your friend is breaking the law',
						),
						'hint'        => 'A stolen account sends messages to its contacts: that is a classic vector.',
						'explanation' => 'The identity of the sender guarantees nothing: if your friend\'s account is compromised, it is the attacker writing. And even a trusted friend can forward a booby-trapped message without knowing.',
					),
					3 => array(
						'question'    => 'What is "smishing"?',
						'choices'     => array(
							'A password traded for a product',
							'A type of phishing by SMS',
							'An encryption technique',
							'An online game',
						),
						'hint'        => 'It is phishing over SMS.',
						'explanation' => 'Smishing is phishing by SMS: the message arrives on the phone, so it speaks directly to habit. Vishing is the same thing by phone call.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * univ-16 — Publier en ligne : ce que les autres voient de toi
	 * ------------------------------------------------------------------ */
	'univ-16' => array(
		'title'   => 'Publishing online: what others see of you',
		'excerpt' => 'Social networks do not only show what you post: they show what your contacts post about you.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — what you post, what others post about you',
				'content' => '<p>Publishing online is not just "posting a photo". Three things happen at once:</p><ul><li><strong>What you post</strong>: photos, location, school, opinions. What is published stays published: content can be copied, quoted, or resurface years later.</li><li><strong>What others post about you</strong>: a photo of you at a party, a mention, a like on a group photo. Others are free to post, even what you would have kept to yourself.</li><li><strong>What the platform knows</strong>: what you look at, your searches, your position, the time spent. Privacy settings exist, but they change often: you have to check them, not assume them.</li></ul><p>The useful reflexes:</p><ol><li><strong>Think before posting</strong>: the three-question rule — will this still concern me in five years? would I be happy for my family to see it? can I explain it to a recruiter?</li><li><strong>Check the settings</strong>: friend list, location, who can comment, who can add you. The defaults are often wide.</li><li><strong>Limit the traces</strong>: no full address, no badge photo, no information about your schedule.</li><li><strong>Report and step back</strong>: facing harassment or a threat, you block, you report, you keep evidence, and you do not answer.</li></ol><p><strong>Remember:</strong> on a social network you do not only publish: you make public what others say about you. That is what "visibility" means.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions: what you post, what you expose.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'A friend posts a photo of you at a party on a public account. What can you do?',
						'choices'     => array(
							'Nothing: it is their photo, they are allowed',
							'Post the same photo back',
							'Ask for removal, report the content if needed, keep a copy as evidence, and adjust your privacy settings',
							'Change your password',
						),
						'hint'        => 'It is your image: you have levers, and they have to be used quickly.',
						'explanation' => 'You can ask for removal (often enough), report, and above all keep evidence (screenshot, link, date): that is what helps if the situation worsens. In parallel, you tighten your settings for next time.',
					),
					1 => array(
						'question'    => 'Why is posting live location during a trip discouraged?',
						'choices'     => array(
							'Because it uses data',
							'Because phones switch off',
							'Because travel photos are never allowed',
							'Because it tells strangers exactly where you are, precisely when you are alone',
						),
						'hint'        => 'Who reads the information?',
						'explanation' => 'Live location is an invitation. Burglaries and ambushes often start with this kind of information. The right reflex: post afterwards, not during.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the publishing charter',
				'content' => 'In the classroom, the social media <em>publishing charter</em> sets the workshop rules. The lab applies a review delay before publishing, and the delays observed on three publications are in <code>/srv/cours/cyber/delais.txt</code>, in hours.</p><p><strong>Mission.</strong> The flag value is the <em>sum of the three delays</em>, in hours: the total review time the team spent.',
				'questions' => array(
					0 => array(
						'question'    => 'What is the sum of the observed publishing delays, in hours (delais.txt)?',
						'hint'        => 'The three delays are one number per line of <code>/srv/cours/cyber/delais.txt</code>: <code>awk \'{s+=$1} END{print s}\' /srv/cours/cyber/delais.txt</code> adds them up.',
						'explanation' => 'What is published stays accessible for a long time, even after deletion: a review delay is not wasted time, it is the only chance to catch a photo that shows an address. Adding the delays up is measuring what caution costs.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is "visibility" on a social network?',
						'choices'     => array(
							'The brightness of the screen',
							'The lifetime of a post',
							'The size of the photo',
							'The number of people who see what you post, you or your contacts',
						),
						'hint'        => 'It is the setting that decides who sees you.',
						'explanation' => 'Visibility sets the audience: public, "friends", "close friends". It is the first setting to check on any new platform.',
					),
					1 => array(
						'question'    => 'Why is "I will delete it later" not a protection?',
						'choices'     => array(
							'Because in the meantime it has already been copied, captured or indexed',
							'Because social networks are slow',
							'Because photos cannot be deleted',
							'Because friends are not allowed to look',
						),
						'hint'        => 'Who else may have saved the capture?',
						'explanation' => 'Published content can already be copied: screenshot, repost, search engine. The rule must therefore be "I do not post what I do not want to see circulating".',
					),
					2 => array(
						'question'    => 'Facing an account harassing a friend, what do you do first?',
						'choices'     => array(
							'Answer to defend your friend',
							'Report, block, and help the victim keep evidence',
							'Share the screenshots so everyone sees',
							'Do nothing: harassers stop quickly',
						),
						'hint'        => 'Answering often feeds the harasser\'s attention.',
						'explanation' => 'Reporting and blocking cut the spread; keeping evidence makes later action possible (school, platform, possibly police). Answering often declares the attacker the "winner".',
					),
					3 => array(
						'question'    => 'An online form asks for your school name and date of birth for a "contest". What do you do?',
						'choices'     => array(
							'Answer: it is only the school',
							'Answer with fake information',
							'Check who runs the form (official site, school address) before entering personal information',
							'Ask a friend to do it for you',
						),
						'hint'        => 'A school name plus a date of birth is enough to identify someone.',
						'explanation' => 'School name + date of birth = a near-complete identity. On top of that, "name + date of birth" is a very common pair for impersonation. Checking the organiser is the baseline.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * univ-17 — Hygiene numerique : le deuxieme facteur
	 * ------------------------------------------------------------------ */
	'univ-17' => array(
		'title'   => 'Digital hygiene: the second factor',
		'excerpt' => 'A six-digit code only protects if nobody can guess it: hence the code lists.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — the three factors',
				'content' => '<p>An authentication factor is a category of proof. There are three:</p><ul><li><strong>Something you know</strong>: a password, a PIN, a date of birth.</li><li><strong>Something you have</strong>: your phone, a USB key, a smart card.</li><li><strong>Something you are</strong>: your fingerprint, your face, your iris.</li></ul><p>Multi-factor authentication combines <strong>two different categories</strong>. That is what matters: a second factor that is also "something you know" (a PIN) does not protect against a stolen password.</p><p>And here is the nuance that separates "enabled" from "useful":</p><ul><li><strong>Code received by SMS</strong>: useful against password theft, but the number can be reassigned or intercepted (SIM swap). Correct, but improvable.</li><li><strong>Authenticator application</strong> (a six-digit code that changes every 30 seconds): much better, because nothing travels over the network.</li><li><strong>Physical key (FIDO2 / security key)</strong>: the most resistant, because it requires the physical presence of the key and cannot be guessed.</li></ul><p>And the two rules that remain: <strong>never share a code</strong> (no legitimate party will ever ask for it), and <strong>prefer the app to SMS</strong> when the service offers it.</p><p><strong>Remember:</strong> the second factor is only useful if it comes from a different category than the password. Otherwise it only blocks crude attempts.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions: the right factor, and the wrong reflex.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the best second factor for a mail account?',
						'choices'     => array(
							'A code received by SMS',
							'A secret question: "what was the name of your first pet?"',
							'A longer password',
							'An authenticator application (a changing code) or a physical security key',
						),
						'hint'        => 'What you want is a factor that does not travel over the network.',
						'explanation' => 'The authenticator app and the FIDO2 key are the strongest. SMS is correct but interceptable. The secret question is almost always guessable or findable online: it is "something you know", hence not a second factor.',
					),
					1 => array(
						'question'    => 'A service asks for the code you received by SMS "to check it is really you". What do you do with it?',
						'choices'     => array(
							'Never give it: a code received by SMS is shared with nobody, and a legitimate service has no need to ask for it',
							'Give it: that is the procedure',
							'Give it only if it is your bank',
							'E-mail it to your backup account',
						),
						'hint'        => 'Who is asking you to confirm something?',
						'explanation' => 'The code proves that YOU are the one logging in. Giving it to someone hands them access. A legitimate service never asks for that code: it already has it, or it sends you a new one.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the workshop factors',
				'content' => 'In the classroom, the <em>factors sheet</em> presents the three families of authentication: something I know, something I have, something I am. Two factors means two different families — two passwords do not make two factors.</p><p><strong>Mission.</strong> The factors offered to the workshop students are in <code>/srv/cours/cyber/facteurs.txt</code>, one per line. The flag value is their <em>number</em>.',
				'questions' => array(
					0 => array(
						'question'    => 'How many authentication factors are offered in facteurs.txt?',
						'hint'        => '<code>wc -l < /srv/cours/cyber/facteurs.txt</code>. The <code>&lt;</code> redirection stops wc from printing the file name too.',
						'explanation' => 'Counting the lines of a list is the most common gesture in analysis: how many factors, how many accounts, how many events. And the underlying lesson of the sheet remains: what matters is not the number, it is the diversity of families.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is an authentication factor?',
						'choices'     => array(
							'A proof of identity belonging to a category: what you know, what you have, what you are',
							'A complex password',
							'A question asked by customer service',
							'A code sent by e-mail',
						),
						'hint'        => 'The word "factor" refers to a category, not a format.',
						'explanation' => 'A factor is a <em>category</em> of proof. Multi-factor means combining two of different categories.',
					),
					1 => array(
						'question'    => 'Why is an SMS code considered a weaker second factor than an app?',
						'choices'     => array(
							'Because it is too long',
							'Because it travels over the network and can be intercepted or diverted (SIM swap)',
							'Because it expires too fast',
							'Because it is not end-to-end encrypted',
						),
						'hint'        => 'What happens between the antenna and your phone?',
						'explanation' => 'SMS goes through the mobile network: a number transfer (SIM swap) or an interception can be enough. The app computes the code on the device: nothing travels.',
					),
					2 => array(
						'question'    => 'You get a call from a service asking for the SMS code you just received. What do you do?',
						'choices'     => array(
							'Give it: they have the information about your account',
							'Ask for their postal address',
							'Hang up and block the number: no legitimate party asks for that code, and the caller was waiting for you to give it',
							'Give half of it',
						),
						'hint'        => 'The service already knows it sent you a code: it has no need to check it.',
						'explanation' => 'A service that sent you a code knows it was sent. It cannot ask you for it "to check": that is the code-theft-by-call technique. You hang up, block, and report.',
					),
					3 => array(
						'question'    => 'What makes a physical security key (FIDO2) so resistant?',
						'choices'     => array(
							'It is very long',
							'It is encrypted by the manufacturer',
							'It expires every year',
							'It requires the physical presence of the key and cannot be guessed or intercepted',
						),
						'hint'        => 'It is not length that protects it, it is what it requires.',
						'explanation' => 'The key cannot be copied by software: verification happens with the physical key, over an end-to-end protected channel. That is why phishing-resistant MFA is the benchmark.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * univ-18 — Le Top 10 OWASP et la surface d'attaque
	 * ------------------------------------------------------------------ */
	'univ-18' => array(
		'title'   => 'The OWASP Top 10 and the attack surface',
		'excerpt' => 'The list everyone quotes, and what it is really for: ranking risks, not listing flaws.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — a list of risks, not a catalogue',
				'content' => '<p>The <strong>OWASP Top 10</strong> is the list of the ten risks most often found in web applications. It is revised every year, because the web changes: browser flaws have receded, logic and configuration flaws have climbed.</p><p>Two ideas to keep from the foundation video:</p><ul><li><strong>A list is a prioritisation tool.</strong> You cannot fix the ten thousand problems of an application: you look first at what is on the list, because those are the risks found everywhere.</li><li><strong>Risks are categories, not precise flaws.</strong> "Injection" does not mean "my application is injectable": it means "my application receives data and concatenates it into a query". The category helps you think; the exact flaw is found by testing.</li></ul><p>And the notion of <strong>attack surface</strong>: everything the application accepts from the outside world (forms, URLs, headers, files, websockets). The wider the surface, the more paths there are to test. Shrinking the surface (removing an old API, an unnecessary port, a forgotten module) is a <em>free</em> defence, before writing a single line of security code.</p><p>The 2021 entries you meet most: broken access control, cryptographic failures, injection, insecure design, misconfiguration, vulnerable components, authentication failures, data integrity failures, insufficient logging and monitoring, and excessive error handling.</p><p><strong>Remember:</strong> the list is not there to say "we are protected because we read the Top 10". It is there to say "here is where to start, and here are the questions to ask".</p><p><strong>Going further, for free:</strong> <a href="https://portswigger.net/web-security" target="_blank" rel="noopener">PortSwigger\'s Web Security Academy</a> offers several hundred web labs on exactly these flaws (SQL injection, XSS, bypassing access controls, forged requests…). The labs are free and run on deliberately vulnerable applications. We do not reproduce their content: we point to it, naming the source and its address.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on using the list and on the attack surface.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Why is the list revised regularly?',
						'choices'     => array(
							'Because the web evolves: the risks that come back most often change',
							'Because publishers change their rules',
							'Because the laws change',
							'To publish more pages',
						),
						'hint'        => 'Think about browser flaws, which have receded.',
						'explanation' => 'Revision reflects reality on the ground: hygiene practices improve, so other risks climb. It is a snapshot, not a dogma.',
					),
					1 => array(
						'question'    => 'An application exposes a statistics API forgotten since 2019, without authentication. What is this?',
						'choices'     => array(
							'A system update problem',
							'An unnecessary attack surface: closing it removes possible paths without writing code',
							'A good architecture practice',
							'A naming problem',
						),
						'hint'        => 'Every entry point is a path someone can test.',
						'explanation' => 'Every reachable interface is a possible door. Shrinking the surface (delete, restrict, filter at the reverse proxy) is an immediate action, almost free, that reduces the number of paths to test.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the internal ranking',
				'content' => 'In the classroom, the team left its <em>risk ranking</em> (<code>/srv/cours/owasp/risques.txt</code>): the five OWASP Top 10 risks found in its own code, one per line.</p><p><strong>Mission.</strong> You do not fix everything at once: you start with the one that comes first in alphabetical order. The flag value is that <em>first risk</em>, as written.',
				'questions' => array(
					0 => array(
						'question'    => 'Which is the first risk (alphabetical order) in the internal ranking?',
						'hint'        => '<code>sort /srv/cours/owasp/risques.txt | head -1</code>. The value contains spaces: copy it whole, apostrophe included.',
						'explanation' => 'Prioritising means choosing what not to fix right away. The team\'s ranking is not the official Top 10: it is what they actually found in their own code, which is more useful than a list learned by heart.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the OWASP Top 10 actually for?',
						'choices'     => array(
							'Guaranteeing that an application is safe',
							'Prioritising fixes and giving a common vocabulary to talk about them',
							'Replacing security tests',
							'Setting the price of an application',
						),
						'hint'        => 'Nobody is safe because of a list.',
						'explanation' => 'The list gives a battle order and a shared language (saying "injection" and "broken access control" names a problem precisely and lets you track it).',
					),
					1 => array(
						'question'    => 'Broken access control is... ?',
						'choices'     => array(
							'A badly configured firewall',
							'A password that is too short',
							'A user reaching data or a function not meant for them',
							'An expired certificate',
						),
						'hint'        => 'It is the first entry of the 2021 Top 10.',
						'explanation' => 'Broken access control is the number 1 risk of 2021: the user reaches what they should not see. It is often a simple missing server-side check: "the interface does not show the button, so nobody can do it" is not protection.',
					),
					2 => array(
						'question'    => 'Why is shrinking the attack surface considered a security measure?',
						'choices'     => array(
							'Because it makes the site prettier',
							'Because routers require it',
							'Because it reduces the number of employees',
							'Because every entry point removed is an attack path you no longer have to watch or test',
						),
						'hint'        => 'Fewer doors, fewer keys to keep.',
						'explanation' => 'The attack surface is every reachable entry. Shrinking it (useless API, open port, obsolete module) removes paths before you even have to secure them — the cheapest defence there is.',
					),
					3 => array(
						'question'    => 'An error-handling mistake displays a full JavaScript stack trace in the browser. What is the risk?',
						'choices'     => array(
							'Exposing internal information (paths, versions, queries) that makes the next attacks easier',
							'None: it is useful for debugging',
							'The site will stop working',
							'The page will not be indexed',
						),
						'hint'        => 'What does an error trace reveal?',
						'explanation' => 'Detailed error messages are an information leak: versions, paths, database structure, sometimes connection credentials. In production you log on the server and display a neutral message.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * univ-19 — Valider les entrees
	 * ------------------------------------------------------------------ */
	'univ-19' => array(
		'title'   => 'Validating input: the first anti-injection remedy',
		'excerpt' => 'Never trust what comes from the outside world: the rule that removes half of all web flaws.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — validate, escape, prepared queries',
				'content' => '<p>Three notions not to confuse, which settle most injections:</p><ul><li><strong>Validation</strong>: check that the data is of the right <em>type</em> and inside the right <em>range</em>. "42" for an age, "AAA-BBB-123" for a postal code, "10/03/2026" for a date. If the data does not conform, you reject it — and that is the end of it.</li><li><strong>Escaping</strong> (or <em>encoding</em>): turning special characters into plain text so they are not read as code. Essential for anything displayed in HTML, JavaScript, a URL or a shell command.</li><li><strong>Prepared queries</strong> (<em>prepared statements</em>): THE answer for SQL injection. The query and the data are sent separately: the database cannot confuse "the data" with "the command".</li></ul><p>And what does not work: <strong>escaping by hand</strong>, filtering a blacklist of words (<code>OR</code>, <code>DROP</code>...), or relying on the front end. A word filter is bypassed by writing differently; validation that lives only in the browser is bypassed by a plain HTTP request.</p><p>The golden rule, repeated by the video: <strong>"Never build a command or a query out of data that came from elsewhere."</strong> If you cannot use a prepared query, you escape with the library function, never by hand.</p><p>And the same logic applies beyond SQL: a shell command built by concatenation is a command injection; a link built with unescaped data is an XSS injection.</p><p><strong>Remember:</strong> validation is the shield, escaping is the ink, the prepared query is the armour. You use all three.</p><p><strong>Going further, for free:</strong> <a href="https://portswigger.net/web-security" target="_blank" rel="noopener">PortSwigger\'s Web Security Academy</a> offers several hundred web labs on exactly these flaws (SQL injection, XSS, bypassing access controls, forged requests…). The labs are free and run on deliberately vulnerable applications. We do not reproduce their content: we point to it, naming the source and its address.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions: the right answer, and the false remedy.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the decisive advantage of a prepared query against SQL injection?',
						'choices'     => array(
							'It executes faster',
							'The query and the data are sent separately: the database can no longer read the data as code',
							'It removes the need to validate input',
							'It encrypts the database',
						),
						'hint'        => 'Think about the border between "command" and "data".',
						'explanation' => 'The prepared query enforces that border: the parameter is a value, never a piece of SQL. It is the structural answer, where escaping remains a technique.',
					),
					1 => array(
						'question'    => 'A developer filters the words "SELECT", "DROP" and "UNION" in form fields. What is the problem?',
						'choices'     => array(
							'None: it is an effective filter',
							'It is too slow for a modern site',
							'The list is endless: the same thing can be written another way (comments, encodings, other keywords)',
							'The browser refuses that filtering',
						),
						'hint'        => '"SELECT" can be written differently.',
						'explanation' => 'Keyword filtering is a game without end: spelling variants, other commands, evasion techniques. The serious answer is structural (prepared query) or contextual (escaping suited to the output context).',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the validation rule',
				'content' => 'In the classroom, the input validation lab left its <em>sheet of accepted formats</em> (<code>/srv/cours/owasp/formats.txt</code>). Validating means describing what is ACCEPTED, not what is rejected.</p><p><strong>Mission.</strong> The sheet describes the zip code format. The flag value is the <em>number of characters</em> expected for that field, extracted from the line.',
				'questions' => array(
					0 => array(
						'question'    => 'How many characters does the zip code format accept ("code postal" line of formats.txt)?',
						'hint'        => '<code>grep -i "code postal" /srv/cours/owasp/formats.txt</code> shows you the line; <code>grep -o "[0-9]* caracteres"</code> isolates the number.',
						'explanation' => 'A whitelist of formats is short and verifiable; a blacklist of forbidden characters is always incomplete. Extracting a number from a rule sentence is turning a policy into an executable check.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the difference between validation and escaping?',
						'choices'     => array(
							'They are the same thing',
							'Validation is client-side, escaping is server-side',
							'Validation checks the type and range of the data; escaping makes the characters safe for a given output context',
							'Escaping is more recent',
						),
						'hint'        => 'One rejects data, the other transforms what is left.',
						'explanation' => 'Validation says "this value is not acceptable"; escaping says "this value is acceptable, but I make it inert for this use". The two are complementary.',
					),
					1 => array(
						'question'    => 'A "quantity" field must contain a number between {min} and {max}. What is the right check?',
						'choices'     => array(
							'A <code>strip_tags()</code> on the input',
							'Escaping the input with <code>htmlspecialchars</code>',
							'Limiting the field to 3 characters',
							'Checking that the input is an integer and lies in the range, rejecting it otherwise',
						),
						'hint'        => 'The check must match the stated range.',
						'explanation' => 'Escaping does not turn "12; DROP TABLE" into a number: validation must check the type (integer) and the range ({min}..{max}). Escaping, for its part, applies to display.',
					),
					2 => array(
						'question'    => 'Why does client-side validation not protect the application?',
						'choices'     => array(
							'Because the attacker does not need the browser: they can send the HTTP request directly',
							'Because browsers are old',
							'Because JavaScript is disabled',
							'Because keyboards are QWERTY',
						),
						'hint'        => 'Think about the tool that sends the request.',
						'explanation' => 'The browser is a client like any other: the request can be written by hand (curl) or by a script. Every security rule must be enforced on the server.',
					),
					3 => array(
						'question'    => 'You build a shell command to process an uploaded file name. What is the right approach?',
						'choices'     => array(
							'Escape the name with a home-made function',
							'Validate the name (allow-list of permitted characters, no special character) and use it as a single argument',
							'Put it in quotes and hope',
							'Encode it in base64 before using it',
						),
						'hint'        => 'The shell interprets some characters: spaces, semicolons, pipes.',
						'explanation' => 'A file name containing a space or a ";" changes the command. You validate the format (allow-list) and make sure the name stays a single argument. Functions such as <code>escapeshellarg</code> exist too: the principle is never to concatenate.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * univ-20 — Journaux et audit
	 * ------------------------------------------------------------------ */
	'univ-20' => array(
		'title'   => 'Logs and audit: the trace worth its weight in gold',
		'excerpt' => 'No trace, no investigation: what to log, and what you must never log.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — log, alert, protect',
				'content' => '<p>A log is the memory of the system. Without it, an incident becomes a novel: "it must have happened to someone, but I know neither when nor how". With it, you can rebuild the timeline and answer the three questions a review board always asks after an incident: <strong>what happened, did it happen again, were we warned</strong>.</p><p>What a log must contain:</p><ul><li><strong>Who</strong>: the account concerned (and the IP address if it is reliable).</li><li><strong>What</strong>: the action attempted (login, password change, export, denial).</li><li><strong>When</strong>: a precise timestamp, with time zone.</li><li><strong>Result</strong>: success or failure, and the error code.</li><li><strong>Origin</strong>: the IP, the user agent, the session identifier.</li></ul><p>And the <strong>two traps</strong> the video points out:</p><ol><li><strong>Logging too much</strong>: logging passwords, card numbers, session tokens or personal data. The log then becomes a sensitive database — and must be protected as such (restricted access, limited retention).</li><li><strong>Logging too little</strong>: not logging authentication failures, privilege changes, or accesses to sensitive data. Without those traces, you do not see an attack being prepared.</li></ol><p>And the part that is often forgotten: <strong>alerting</strong>. A log nobody watches has been useless. A simple rule: a log must trigger an alert when it contains a rare and severe pattern (a burst of failures, a permission change, a massive export).</p><p><strong>Remember:</strong> a log is not a technical trace, it is evidence. It must be timestamped, protected, and read.</p><p><strong>Going further, for free:</strong> <a href="https://portswigger.net/web-security" target="_blank" rel="noopener">PortSwigger\'s Web Security Academy</a> offers several hundred web labs on exactly these flaws (SQL injection, XSS, bypassing access controls, forged requests…). The labs are free and run on deliberately vulnerable applications. We do not reproduce their content: we point to it, naming the source and its address.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions: what to log, what not to log.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Which element must NEVER be written to a log?',
						'choices'     => array(
							'The timestamp',
							'The source IP address',
							'The password or session token in clear text',
							'The result of the operation',
						),
						'hint'        => 'A log must let you rebuild an action, not replay an authentication.',
						'explanation' => 'A log containing a password or a token is a bomb: whoever reads it takes the account. You log the event ("successful authentication for user X"), never the secret.',
					),
					1 => array(
						'question'    => 'Why is it important to log authentication failures?',
						'choices'     => array(
							'To be able to block accounts permanently',
							'Because the server requires it',
							'To count active users',
							'Because a burst of failures is an attack signal: it is often the first alert',
						),
						'hint'        => 'What did not succeed leaves a trace, and that trace often arrives first.',
						'explanation' => 'Failure is the earliest signal of a brute-force attack. If it is not logged (or not monitored), you learn about it at the same time as the compromise: too late.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the logging plan',
				'content' => 'In the classroom, the team left its <em>logging plan</em> and the trace the service produced (<code>/srv/cours/owasp/trace.txt</code>): each line is an event.</p><p><strong>Mission.</strong> The flag value is the <em>number of events</em> in that trace. Three questions follow: how many refused logins, how many configuration changes, and who did what.',
				'questions' => array(
					0 => array(
						'question'    => 'How many events does the service trace contain (trace.txt)?',
						'hint'        => '<code>wc -l < /srv/cours/owasp/trace.txt</code>. Also look at the trace: <code>grep refusee</code>, <code>grep configuration</code>.',
						'explanation' => 'A log is only worth something if you can read it: how many lines, how many refusals, which sequence precedes the incident. Counting events is the first step; the next question is "how many are abnormal".',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Which pieces of information are essential in a security log line?',
						'choices'     => array(
							'The full error message',
							'The server version number',
							'The terminal colour',
							'Who, what, when, which result, from which origin',
						),
						'hint'        => 'Five elements: the five questions of an investigation.',
						'explanation' => 'Without those five elements, the line does not let you rebuild the action: who did what, when, with which result, from where. The error message is useful but secondary.',
					),
					1 => array(
						'question'    => 'A log contains the password in clear text "because support needs it". What should you think?',
						'choices'     => array(
							'It is a major risk: the log becomes a database of secrets, with a longer lifetime than the incident',
							'It is acceptable if the log is well protected',
							'It is the best practice',
							'It is only forbidden in Europe',
						),
						'hint'        => 'Compare the lifetime of the log with that of the password.',
						'explanation' => 'A password in a log outlives the password change: the log is often kept for months and read by many teams. The right practice is to log the event, never the secret.',
					),
					2 => array(
						'question'    => 'A log is well fed, but nobody reads it. What is the flaw?',
						'choices'     => array(
							'None: writing is enough',
							'Monitoring is part of the system: without an alert, the log is only useful after the incident',
							'The log is too big',
							'A second log must be written',
						),
						'hint'        => 'The point of a log is the alert, not the archive.',
						'explanation' => 'A monitored log lets you act during the attack; an unmonitored log is an archive afterwards. Hence the importance of alert rules on rare and severe events.',
					),
					3 => array(
						'question'    => 'Which event is most useful to log for detecting an ongoing compromise?',
						'choices'     => array(
							'A visitor arriving on the home page',
							'The size of an image',
							'A change of privilege or permissions',
							'The loading of a style sheet',
						),
						'hint'        => 'Look for the rare and severe event, not the daily noise.',
						'explanation' => 'Privilege changes (an account becoming administrator, an access to a sensitive file) are rare and severe: those are the ones that deserve an alert. The rest is noise.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * univ-21 — Comment marche un ordinateur
	 * ------------------------------------------------------------------ */
	'univ-21' => array(
		'title'   => 'How a computer works: from data to program',
		'excerpt' => 'From bits to instructions: what really happens between the keyboard and the result on screen.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — from data to program',
				'content' => '<p>A computer "understands" nothing: it executes instructions, in order, at insane speed and without ever getting tired. Everything else is organisation.</p><p>The journey of a program, in four layers:</p><ol><li><strong>Data</strong>: everything is a binary number. A character is a number, an image is an array of numbers, a sound is a series of samples. The only unit of the machine is the bit.</li><li><strong>Memory</strong>: a long series of numbered bytes. Each slot carries an <em>address</em>. A variable is a name given to an address: the program handles names, the machine handles addresses.</li><li><strong>The instruction</strong>: an elementary operation (load, add, store, jump). A program is a long series of those instructions.</li><li><strong>The cycle</strong>: the processor takes the instruction at the address pointed to by the counter, executes it, moves to the next. Nothing else. That is where the security notions creep in: who controls the program counter, and what happens when you make it jump elsewhere?</li></ol><p>The notion of <strong>high-level language</strong> comes next: you write <code>x = 5 + 3</code>, the compiler translates it into instructions, the assembler translates those into machine codes, and the processor executes them. Each layer adds comfort… and sometimes errors (the famous <em>buffer overflows</em> come from the fact that the C layer does not protect memory).</p><p><strong>Remember:</strong> the computer is an instruction machine that handles addresses. All security rests on controlling three things: the data, the addresses, and the program counter.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions: what the machine does, and what the language hides.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What does a processor actually do?',
						'choices'     => array(
							'It reads instructions, executes them one by one, and moves to the next',
							'It understands the program and runs it according to its meaning',
							'It compiles the source code',
							'It stores the data on disk',
						),
						'hint'        => 'The processor knows neither meaning nor intent: it follows a counter.',
						'explanation' => 'The processor executes a stream of instructions driven by a program counter. All system security rests on controlling that counter — hence defences such as the canary or NX.',
					),
					1 => array(
						'question'    => 'Why is the C language said to be "close to the machine"?',
						'choices'     => array(
							'Because it is faster than all other languages',
							'Because it lets the programmer manage memory: there is no garbage collector and no automatic bounds checking',
							'Because it was written in assembly',
							'Because it has no functions',
						),
						'hint'        => 'It is not a question of speed, it is a question of guarantees.',
						'explanation' => 'In C, memory management is the programmer\'s job: that is a power (performance, control) and a risk (overflows, use-after-free). That is exactly what the pwn.college labs exploit.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the machine diagram',
				'content' => 'In the classroom, the Stanford course left its <em>machine diagram</em> (<code>/srv/cours/stanford/tailles.txt</code>): processor, word size, address size, memory.</p><p><strong>Mission.</strong> The flag value is the <em>size of an address</em>, in bytes, as it appears in the diagram. It is what explains the difference between a 32-bit and a 64-bit processor.',
				'questions' => array(
					0 => array(
						'question'    => 'What is the size of an address, in bytes, according to the machine diagram?',
						'hint'        => '<code>grep "^adresse " /srv/cours/stanford/tailles.txt</code> shows the line <code>adresse       = 8 octets</code>: the value is the third field (<code>cut -d" " -f3</code>).',
						'explanation' => 'A 64-bit processor addresses 2^64 cells: that is why it can exceed 4 GB of memory. Remembering 8 bytes per address is remembering why the 4 GB limit disappeared.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is a memory address?',
						'choices'     => array(
							'The content of a memory slot',
							'A number that designates a memory slot',
							'The name of a variable in the code',
							'The size of a program',
						),
						'hint'        => 'It is what lets you reach a slot unambiguously.',
						'explanation' => 'The address is the access number of a slot. The variable name is only a translation made by the compiler: at machine level there are only numbers.',
					),
					1 => array(
						'question'    => 'What does the "program counter" correspond to?',
						'choices'     => array(
							'The number of lines in the program',
							'The size of the memory in use',
							'The address of the next instruction to execute',
							'The accumulated execution time',
						),
						'hint'        => 'It is what decides where the program goes next.',
						'explanation' => 'The program counter holds the next instruction. It is incremented after each instruction, unless a jump instruction modifies it: hence the importance of the return address on the stack.',
					),
					2 => array(
						'question'    => 'What happens when a program is compiled?',
						'choices'     => array(
							'It is copied to disk',
							'It is run immediately to check that it works',
							'It is encrypted',
							'It is translated into instructions, then into machine codes the processor can execute',
						),
						'hint'        => 'The compiler produces a new form of the program.',
						'explanation' => 'Compilation chain: source → machine code → execution. The optimiser works on intermediate code, not on the algorithms: the meaning must stay the same.',
					),
					3 => array(
						'question'    => 'Why does a garbage collector make exploitation harder?',
						'choices'     => array(
							'Because it manages memory instead of the programmer: there is no use-after-free or double free exploitable in the same way',
							'Because it slows everything down',
							'Because it forbids pointers',
							'Because it makes the code unreadable',
						),
						'hint'        => 'The problem with manual memory management is that it gets things wrong.',
						'explanation' => 'In C the programmer frees memory: a double free or an access after free is a classic exploitable flaw. An automatic garbage collector removes that family of bugs — the argument for memory-safe languages (which the 6.858 course mentions at the end).',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * univ-22 — Donnees et systemes
	 * ------------------------------------------------------------------ */
	'univ-22' => array(
		'title'   => 'Data and systems: organising information',
		'excerpt' => 'From files to databases: how information is stored, and why storage is a security question.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — store, search, separate',
				'content' => '<p>All of computing fits in one sentence: <strong>store information so you can find it again</strong>. The web, a game, a shop site: they are stored data, read back.</p><p>The levels of storage:</p><ul><li><strong>The file</strong>: a named block of bytes. Simple, but to find a piece of information you have to read everything. That is the case of a <em>log</em>: you read it at the end to know what happened.</li><li><strong>The table (database)</strong>: typed rows and columns, with indexes. The index is the "table of contents": it lets you find a row without scanning everything. It is a trade-off: more space, time saved.</li><li><strong>The query</strong>: you no longer read the data, you ask a question. "Give me the orders of customer X after 3 March". That is SQL, and it is also the classic entry point for injections.</li></ul><p>And the notion of <strong>separation of concerns</strong>: data, application code, configuration, logs. Mixing them is the number one cause of leaks: a password written in the code, an encryption key in a file served to the public, a log in the same directory as the data.</p><p>For security, two rules drawn from that organisation:</p><ol><li><strong>One access, one need</strong>: the web service reads the data, it does not modify the schema. A separate service account for reading, another for writing: the "data" version of privilege separation.</li><li><strong>The secret does not live next to the data</strong>: it lives in a protected place, with measured access and a limited lifetime.</li></ol><p><strong>Remember:</strong> data security starts with how the data is stored. Who can read, who can write, and where the secrets are: three questions to ask before anything else.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions: storing properly, and separating concerns.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Why does a database use indexes?',
						'choices'     => array(
							'To encrypt the data',
							'To find a row quickly without scanning the whole table',
							'To compress the file',
							'To force the use of prepared queries',
						),
						'hint'        => 'Think about the table of contents of a book.',
						'explanation' => 'The index is a table of contents: it speeds up searching at the cost of space and maintenance. It is also something to watch: a badly chosen index can slow down writes.',
					),
					1 => array(
						'question'    => 'A site puts its configuration file (with the encryption key) in the public folder. What is the risk?',
						'choices'     => array(
							'None: the file is protected by its name',
							'The site becomes slower',
							'Anyone can download it: the secret is public, and the encryption key protects nothing any more',
							'The database is emptied',
						),
						'hint'        => 'Public folder = downloadable folder.',
						'explanation' => 'This is the classic storage mistake: a secret next to public content. The rule: the secret lives in a protected location, outside what is served, with measured access.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the storage plan',
				'content' => 'In the classroom, the Stanford course left its <em>storage plan</em>: where public content, private data, secrets and logs live. The inventory of locations holding a secret is in <code>/srv/cours/stanford/emplacements.txt</code>.</p><p><strong>Mission.</strong> The flag value is the <em>number of locations</em> in that inventory. A secret never lives next to public content: each location is a separate access control.',
				'questions' => array(
					0 => array(
						'question'    => 'How many locations hold a secret according to the inventory (emplacements.txt)?',
						'hint'        => '<code>wc -l < /srv/cours/stanford/emplacements.txt</code>. Also look at the paths: <code>/etc/secura-secrets</code> is not where <code>/srv/data</code> is, and that is deliberate.',
						'explanation' => 'Organising, in security, is not tidying: it is separating what is allowed to sit together. A <code>.env</code> file in the folder served by the web is a leak that does not look like one.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Four timed questions. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the advantage of a database over a plain text file?',
						'choices'     => array(
							'It is smaller',
							'It is secure by nature',
							'It lets you ask questions (queries) about the data and find it without scanning everything',
							'It needs no passwords',
						),
						'hint'        => 'Think "asking" rather than "searching".',
						'explanation' => 'A database does not make data safe: it makes <em>search</em> efficient. Security comes from permissions, not from the engine.',
					),
					1 => array(
						'question'    => 'Why must the service account that reads the data not be able to change the schema?',
						'choices'     => array(
							'So the site is faster',
							'Because SQLite forbids it',
							'So backups are smaller',
							'To limit the damage: an SQL injection could neither change the structure nor drop the tables',
						),
						'hint'        => 'It is the principle of least privilege, applied to data.',
						'explanation' => 'A read-only account cannot do structural damage: even if the injection gets through, it is limited to reading. It is a classic and cheap security barrier.',
					),
					2 => array(
						'question'    => 'What does separation of concerns mean when applied to data?',
						'choices'     => array(
							'Data, configuration, secrets and logs are stored in different places, with distinct access rights',
							'Each service has its own database',
							'Each developer works on their own copy',
							'The queries are written in separate files',
						),
						'hint'        => 'Think about what must be public, private and secret.',
						'explanation' => 'Separation means storing things that do not share the same sensitivity in different places: public content, private data, protected secrets, technical logs. Each zone has its own access control.',
					),
					3 => array(
						'question'    => 'An SQL query built by concatenating user input, even with manual escaping, remains risky. Why?',
						'choices'     => array(
							'Because SQL is a slow language',
							'Because manual escaping is fragile: each data type has its own rules, and one forgotten rule reopens the flaw',
							'Because the engine refuses long queries',
							'Because indexes fire',
						),
						'hint'        => 'Escaping by hand is a list of rules not to forget.',
						'explanation' => 'The prepared query moves security into the engine: the border between code and data is guaranteed by construction. Manual escaping depends on the developer\'s attention and on the context (string, number, identifier, date).',
					),
				),
			),
		),
	),

);
