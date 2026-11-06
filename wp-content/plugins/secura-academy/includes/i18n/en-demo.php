<?php
/**
 * Traductions anglaises du parcours de decouverte : les six rooms « demo ».
 *
 * Meme convention que en-m3.php : uniquement de la traduction, indexee par
 * cle stable de room, avec les options des QCM dans le meme ordre.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(

	/* ---------------------------------------------------------------------
	 * demo-01 — Penser comme un defenseur
	 * ------------------------------------------------------------------ */
	'demo-01' => array(
		'title'   => 'Think like a defender',
		'excerpt' => 'The basic reflexes: attack surface, least privilege, and how to react to an incident.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: The defender\'s reflex',
				'content' => '<p>Three ideas are enough to get started:</p><ul><li><strong>The CIA triad</strong> — <em>Confidentiality</em>, <em>Integrity</em>, <em>Availability</em>. Every attack targets one of the three pillars; every defence protects one of the three.</li><li><strong>The attack surface</strong> — every entry point that can be reached: open ports, URLs, accounts, APIs, files.</li><li><strong>Least privilege</strong> — grant only the rights strictly needed for the action at hand.</li></ul><p><strong>Remember:</strong> a good defender does not look for the attack first; a good defender shrinks the attack surface first.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Six questions to check that the three reflexes have landed. You may ask for a hint: it will cost you half the points for that question.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'A defender receives a security alert. What is their first reflex?',
						'choices'     => array(
							'Record the state: page capture, logs and the exact time',
							'Restarting the web server so the error message disappears',
							'Fixing the faulty query in the source code straight away',
							'Deleting the page from the site until the cause is understood',
						),
						'hint'        => 'You do not react blind: you first establish the facts.',
						'explanation' => 'Before acting you gather the facts: what, when, where, how far. Acting without understanding risks worsening the incident and destroying the evidence.',
					),
					1 => array(
						'question'    => 'What does the principle of least privilege mean?',
						'choices'     => array(
							'Granting only the rights needed for the action at hand',
							'Granting every right, then taking them back if they get abused',
							'Granting rights only to the accounts that ask for them',
							'Granting the same rights to all accounts so audit is simpler',
						),
						'hint'        => 'Think about how many rights an account holds.',
						'explanation' => 'An account that does not need to be an administrator must not be one: every unnecessary right is one more way in, and one more target if the account is stolen.',
					),
					2 => array(
						'question'    => 'In security, what does the « attack surface » mean?',
						'choices'     => array(
							'Every entry point that can be reached on the system',
							'The number of vulnerabilities fixed over the last month',
							'The amount of data stored in the production database',
							'The number of users connected to the service at once',
						),
						'hint'        => 'Ports, URLs, accounts, APIs: anything that can be reached.',
						'explanation' => 'Shrinking the attack surface means shrinking the number of entry points: close a port, remove an account, restrict an API. It is not a measurement over time, it is an inventory.',
					),
					3 => array(
						'question'    => 'Which document describes the steps to follow when an incident is detected?',
						'choices'     => array(
							'The incident response plan, which sets roles and escalation',
							'The processing register, which lists the data being processed',
							'The password policy, which sets the minimum length required',
							'The recovery plan, which organises the restart of the services',
						),
						'hint'        => 'It says who does what, and in which order, during the crisis.',
						'explanation' => 'The incident response plan formalises escalation, roles and communication: that is what prevents panic and bad decisions. The recovery plan deals with the aftermath, not the crisis itself.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: Applied test — incident triage',
				'content' => '<p><strong>Situation.</strong> A colleague tells you an internal page is showing a SQL error that contains a table name. Your manager asks you to act immediately.</p><p>Answer precisely: what has to be done first, and what must absolutely not be done.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'An internal page shows an SQL error with a table name. What do you do first?',
						'choices'     => array(
							'Capture the state: screenshot, logs and the exact time',
							'Restarting the service so that the message disappears',
							'Fixing the query in the source code straight away',
							'Deleting the page from the site until it gets understood',
						),
						'hint'        => 'Without the initial evidence you cannot show the impact, nor check the fix.',
						'explanation' => 'Capture the state (screenshot, logs, exact time) before any change: it is the only evidence of the initial impact, and the only basis for checking that the fix worked.',
					),
					1 => array(
						'question'    => 'What should you especially NOT do first on a compromised server?',
						'choices'     => array(
							'Restart it or wipe the logs so as to start from clean',
							'Record the exact time and the capture of the error page',
							'Copy the logs onto a separate medium before touching it',
							'Call the security officer so that an incident is opened',
						),
						'hint'        => 'You would lose the trace of what actually happened.',
						'explanation' => 'Restarting or wiping destroys the evidence: logs, memory, coredump. You lose the cause and go back to guessing. Recording, copying and reporting are the right moves instead.',
					),
					2 => array(
						'question'    => 'After an incident the site still answers and nothing leaked, but rows were changed. Which pillar is hit?',
						'choices'     => array(
							'Integrity: the data was altered without authorisation',
							'Confidentiality: the data was simply read by a third party',
							'Availability: the service no longer answers clients',
							'None: a service that still answers stayed intact',
						),
						'hint'        => 'The service answers, yes — but is the data still what you think it is?',
						'explanation' => 'An unauthorised change breaches integrity. Confidentiality holds (nothing leaked) and availability holds (the site answers), but trust in the database is gone.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: Exam',
				'content' => '<p>Three questions, 10 minutes, pass mark 70%. No hints: this is where you check that the reflexes are automatic.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Which property of the CIA triad protects against unauthorised changes to data?',
						'choices'     => array(
							'Integrity, which guarantees that the data was not altered',
							'Confidentiality, which prevents any reading by a third party',
							'Availability, which guarantees access when you need it',
							'Traceability, which keeps a record of every change made',
						),
						'hint'        => 'Three pillars: reading, changing, access. Which one is about changing?',
						'explanation' => 'Confidentiality protects reading, availability protects access, integrity protects changing. Traceability is useful, but it is not part of the triad.',
					),
					1 => array(
						'question'    => 'What is the main goal of the principle of least privilege?',
						'choices'     => array(
							'Limiting the damage if an account ends up being compromised',
							'Totally preventing any account from ever being compromised at all',
							'Speeding up the logins by removing the access controls',
							'Recording every action performed by an admin account',
						),
						'hint'        => 'Least privilege does not prevent compromise: it limits the reach of it.',
						'explanation' => 'If an account is stolen, its rights limit the damage: this is damage limitation, not prevention. The account is not less attackable, it is less powerful.',
					),
					2 => array(
						'question'    => 'What does an incident response plan document?',
						'choices'     => array(
							'Procedures, roles and escalation during an incident',
							'The list of every vulnerability present on every server',
							'The encryption applied to the database backups',
							'The access rights granted to every user account in it',
						),
						'hint'        => 'Who does what, and in which order, when something happens.',
						'explanation' => 'It documents procedures, roles and escalation: its value comes from thinking ahead, not from the writing. A vulnerability list or a rights matrix are other documents.',
					),
						array(
							'question'    => 'A server exposes SSH, HTTP and a database to the Internet, but nobody uses SSH. What should be done first?',
							'choices'     => array(
								'Close the SSH service that nobody actually needs',
								'Change the server root password every single week',
								'Install an antivirus on the machine to protect it',
								'Increase the size of the database backups held',
							),
							'hint'        => 'A service that is not even used is an open door for nothing.',
							'explanation' => 'The attack surface is the set of reachable services. A service nobody uses can simply be closed: it is the cheapest and safest gain you can get.',
						),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * demo-02 — Les fondamentaux du reseau
	 * ------------------------------------------------------------------ */
	'demo-02' => array(
		'title'   => 'Network fundamentals',
		'excerpt' => 'Understand how data travels: addressing, ports, and what a firewall actually does.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: How data travels',
				'content' => '<p>Three building blocks are enough:</p><ul><li><strong>The IP address</strong> identifies a machine on the network; the <strong>MAC address</strong> identifies its network card on the local link.</li><li><strong>The port</strong> designates the service: 22 for SSH, 80 for HTTP, 443 for HTTPS.</li><li><strong>The OSI model</strong> splits communication into layers: 1 physical, 2 data link, 3 network, 4 transport, 5 session, 6 presentation, 7 application.</li></ul><p><strong>Remember:</strong> TCP (layer 4) is reliable and connection-oriented; UDP is fast and connectionless.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Four questions to anchor the basics of networking.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Which OSI layer does the TCP protocol belong to?',
						'choices'     => array(
							'Layer 4, transport, which handles segments and ports',
							'Layer 3, network, which handles addresses and the routing',
							'Layer 2, link, which handles frames on the local link',
							'Layer 7, application, which handles the business protocols',
						),
						'hint'        => 'TCP handles end-to-end reliability between two applications.',
						'explanation' => 'TCP lives at layer 4 (transport): it handles segments, ports and end-to-end reliability. UDP shares that layer, without the reliability.',
					),
					1 => array(
						'question'    => 'Which address physically identifies a network card on a local network?',
						'choices'     => array(
							'The MAC address, burned into the physical network card',
							'The IP address, handed out by the local DHCP server',
							'The port number, chosen by the service that listens on it',
							'The host name, resolved by the local name service',
						),
						'hint'        => 'Physically: this address is tied to the hardware, not the network.',
						'explanation' => 'The MAC address is a layer 2 identifier: it identifies the physical interface, not the host in the IP sense. The IP address changes with the network and the DHCP lease.',
					),
					2 => array(
						'question'    => 'Which protocol is used on port 443?',
						'choices'     => array(
							'HTTPS, that is HTTP carried inside a TLS session here',
							'HTTP, which travels in clear text and is read on the network',
							'SSH, which opens an encrypted remote shell on the server box',
							'DNS, which turns the domain names into IP addresses',
						),
						'hint'        => 'Port 443 carries HTTP over TLS: the traffic is encrypted.',
						'explanation' => 'Port 443 carries HTTP over TLS: the traffic is encrypted and the server identity is checked through its certificate. Port 80 is the same HTTP, but in clear text.',
					),
					3 => array(
						'question'    => 'What is the main role of a firewall?',
						'choices'     => array(
							'Filtering network traffic as set by a defined flow policy',
							'Encrypting the data sent between any two remote machines',
							'Backing up every single file that changed during the workday',
							'Speeding up the connection by caching all of the web pages',
						),
						'hint'        => 'A firewall applies a policy: it allows or refuses flows.',
						'explanation' => 'A firewall applies a flow policy: it is a perimeter control, not a protection of the applications themselves. Encryption and application filtering are other bricks.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: Applied test — explore the machine',
				'content' => '<p><strong>Mission.</strong> A machine has been compromised. You have access to its terminal. Find the configuration file and the flag it contains.</p><p>Use the terminal below: the commands are simulated, no real system is touched.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Which flag is inside the configuration file?',
						'answers'     => array( 'SECURA{net_les_fondamentaux}', 'SECURA{net-les-fondamentaux}' ),
						'hint'        => 'You had to list the files first, then read the configuration one.',
						'explanation' => 'The flag was inside config.txt: list the files, then read the right one.',
					),
					1 => array(
						'question'    => 'Which port does an encrypted web server listen on?',
						'choices'     => array(
							'Port 443, which carries HTTP inside a TLS session',
							'Port 80, which carries HTTP in clear text on the network',
							'Port 22, which carries SSH for remote administration',
							'Port 21, which carries FTP for transferring files',
						),
						'hint'        => 'Encrypted: this is not port 80.',
						'explanation' => '443 is the standard port for HTTP over TLS; 80 remains the clear-text HTTP port. Mixing the two up means exposing the site without encryption.',
					),
					2 => array(
						'question'    => 'Which protocol carries data with no connection and no delivery guarantee?',
						'choices'     => array(
							'UDP, which sends the datagrams with no retransmission',
							'TCP, which opens a session and resends lost segments',
							'TLS, which encrypts a session after a handshake',
							'ICMP, which carries the control messages of the network',
						),
						'hint'        => 'No connection, no acknowledgement: this is a choice, not a defect.',
						'explanation' => 'UDP does not retransmit: it is faster, but with no guarantee of arrival or order. It is a choice for voice or video, not a design defect.',
					),
					3 => array(
						'question'    => 'Finish exploring the machine and confirm that you read the configuration file.',
						'hint'        => 'No answer to type: the server checks your terminal.',
						'explanation' => 'You completed the practice: the machine was explored in the terminal, not merely read in the brief.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: Exam',
				'content' => '<p>Three questions, 10 minutes, pass mark 70%.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Which layer of the OSI model handles the logical addressing of networks?',
						'choices'     => array(
							'Layer 3, network, which carries IP addresses and routing',
							'Layer 2, link, which carries the physical addresses of cards',
							'Layer 4, transport, which handles ports and reliability',
							'Layer 7, application, which carries the application protocols',
						),
						'hint'        => 'IP addresses are logical addresses, not physical ones.',
						'explanation' => 'Layer 3 (network) carries IP addresses and routing between networks. Layer 2 carries MAC addresses, layer 4 the ports, layer 7 the application protocols.',
					),
					1 => array(
						'question'    => 'What is a service port, on a machine?',
						'choices'     => array(
							'A number that points at the application listening on it',
							'A number that points at the machine itself on the local network',
							'A number that points at the network card used by the machine',
							'A number that points at the account allowed to start it',
						),
						'hint'        => 'Several services live on one machine: what tells them apart?',
						'explanation' => 'The port identifies the destination application on a machine: that is what lets several services live on one IP address, each on its own port.',
					),
					2 => array(
						'question'    => 'What does a MAC address do, and how far does it reach?',
						'choices'     => array(
							'It identifies a network interface on the local link only',
							'It identifies a machine across the whole internet',
							'It identifies the account using the network card remotely',
							'It identifies the service listening behind that network card',
						),
						'hint'        => 'Is a MAC address routable beyond the local segment?',
						'explanation' => 'It identifies the physical interface on the local link; it is not routable beyond the segment. It is the IP address that carries routing between networks.',
					),
						array(
							'question'    => 'A site shows a padlock and an address in https:// : what does it guarantee?',
							'choices'     => array(
								'That the traffic between the browser and the site is encrypted',
								'That the site has no flaw and will never be hacked by anyone',
								'That the visitor\'s identity stays completely anonymous online',
								'That the data held by the site is backed up every single night for you',
							),
							'hint'        => 'The padlock is about the path the data takes, not the site\'s quality.',
							'explanation' => 'HTTPS encrypts the transport: somebody watching the network cannot read the content. It says nothing about how secure the site itself is, nor about the visitor\'s anonymity.',
						),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * demo-03 — Securiser une application web
	 * ------------------------------------------------------------------ */
	'demo-03' => array(
		'title'   => 'Securing a web application',
		'excerpt' => 'SQL injection, XSS, CSRF: recognise the classic web flaws and their fixes.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: The three web flaws to know',
				'content' => '<ul><li><strong>SQL injection</strong> — user data is concatenated into a query, so the attacker changes the logic of that query. <em>Fix:</em> parameterised queries.</li><li><strong>XSS</strong> — injected code runs in a victim\'s browser. <em>Fix:</em> output escaping + CSP.</li><li><strong>CSRF</strong> — a third-party site forces a logged-in user to trigger an action. <em>Fix:</em> an anti-CSRF token.</li></ul><p><strong>Remember:</strong> any data coming from the client is untrusted. Validation happens <em>on the server</em>, always.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Three questions to tell the flaw families apart.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Which practice protects a SQL query against code injection?',
						'hint'        => 'The data is never concatenated into the query.',
						'explanation' => 'With parameters, the data stays data: it cannot change the structure of the query, whatever its value.',
					),
					1 => array(
						'question'    => 'What is the attack called that steals the session of an authenticated user?',
						'hint'        => 'The authentication token travels, and changes hands.',
						'explanation' => 'The session token is a temporary secret: if it is intercepted, it grants access without a password. Hence the HttpOnly and SameSite cookie flags.',
					),
					2 => array(
						'question'    => 'What is the "Content-Security-Policy" (CSP) header for?',
						'hint'        => 'It tells the browser where it is allowed to load content from.',
						'explanation' => 'CSP limits the allowed origins: it sharply reduces the impact of a script injection, even when one gets through.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: Applied test — the suspect header',
				'content' => '<p><strong>Mission.</strong> A colleague forwards you a server response for a profile page.</p><pre>HTTP/1.1 200 OK
Content-Type: text/html
Set-Cookie: session=abc123; Secure</pre><p>Two things stand out. Identify them and say what has to be fixed.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the main problem with the Set-Cookie header?',
						'hint'        => 'What happens if JavaScript reads the cookie?',
						'explanation' => 'Without HttpOnly, an injected script can read the session cookie and exfiltrate it: that is the classic session theft chain.',
					),
					1 => array(
						'question'    => 'Which header is missing to prevent deceptive framing (clickjacking)?',
						'hint'        => 'It forbids displaying your page inside a frame.',
						'explanation' => 'X-Frame-Options (or frame-ancestors in CSP) stops your site being embedded in a frame: the user can no longer be trapped.',
					),
					2 => array(
						'question'    => 'The cookie has the Secure flag but no SameSite. What is the risk?',
						'hint'        => 'Think of a request sent automatically from another page.',
						'explanation' => 'Without SameSite, the browser attaches the cookie to requests started by other sites: the cookie\'s CSRF protection is gone.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: Exam',
				'content' => '<p>Three questions, 15 minutes, pass mark 75%.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Where must the validation of received data happen?',
						'explanation' => 'The client is under the attacker\'s control: only server-side validation carries authority.',
					),
					1 => array(
						'question'    => 'Which protection against CSRF is the most effective?',
						'explanation' => 'The anti-CSRF token ties the request to the session: without it the forged request is rejected. SameSite is an excellent complement.',
					),
					2 => array(
						'question'    => 'What happens if user data is concatenated into a SQL query?',
						'explanation' => 'Concatenation makes the query editable by the data: that is the very definition of SQL injection.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * demo-04 — Memoire et defenses
	 * ------------------------------------------------------------------ */
	'demo-04' => array(
		'title'   => 'Memory and defences',
		'excerpt' => 'Buffer overflow, NX, ASLR, canary: understand the controls that protect memory.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: The buffer overflow',
				'content' => '<p>A program reserves some memory space (a <em>buffer</em>) to write data into. If the program does not check the size it receives, the attacker writes <strong>beyond</strong> that space and overwrites the stack, where the return addresses live.</p><p>Four defences combine:</p><ul><li><strong>NX</strong> (No-Execute): the stack is not executable.</li><li><strong>ASLR</strong>: memory addresses are randomised on every run.</li><li><strong>Canary</strong> (stack cookie): a sentinel value detects corruption before the return.</li><li><strong>PIE / RELRO</strong>: randomisation and hardening of the segments.</li></ul><p><strong>Remember:</strong> no single defence is enough; it is their combination that makes exploitation expensive.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Four questions on the mechanism and its defences.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the technique called that overwrites the execution stack to hijack control of the program?',
						'hint'        => 'You write more than expected into a buffer that is too small.',
						'explanation' => 'A buffer overflow corrupts the control data on the stack: it is the classic way into memory exploitation.',
					),
					1 => array(
						'question'    => 'Which defence makes the stack non-executable?',
						'hint'        => 'A stack on which you cannot execute code.',
						'explanation' => 'NX turns the stack into data: injected shellcode can no longer be executed from the stack.',
					),
					2 => array(
						'question'    => 'What does the ASLR defence achieve?',
						'hint'        => 'The addresses change on every run.',
						'explanation' => 'ASLR makes the stack address unpredictable: the attacker needs a memory leak to use it.',
					),
					3 => array(
						'question'    => 'What is the job of a canary (stack cookie)?',
						'hint'        => 'A sentinel value placed before the return address.',
						'explanation' => 'The canary is checked before the function returns: if it changed, the stack was corrupted and the program stops.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: Applied test — hardening',
				'content' => '<p><strong>Mission.</strong> A team asks you to harden a server. Three audit answers are up for evaluation: which one is actually effective?</p><p>1. "The binary is compiled without ASLR."<br>2. "The stack is marked NX."<br>3. "The program checks the length before writing."</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Which of these measures is the most effective against a buffer overflow?',
						'hint'        => 'One of the three removes the cause, not just the consequences.',
						'explanation' => 'Checking the length removes the flaw; NX, ASLR and the canary only make exploitation harder. Cause first.',
					),
					1 => array(
						'question'    => 'What does NX make impossible?',
						'hint'        => 'The stack becomes a pure data area.',
						'explanation' => 'With NX the stack is no longer executable: shellcode has to be loaded some other way (ROP), hence the importance of combining defences.',
					),
					2 => array(
						'question'    => 'Why is ASLR alone not enough?',
						'hint'        => 'The attacker needs the exact address.',
						'explanation' => 'ASLR adds randomness, not a guarantee: a single address leak is enough to recover the right base.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: Exam',
				'content' => '<p>Three questions, 15 minutes, pass mark 75%.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Where does the return address sit, the classic target of a buffer overflow?',
						'explanation' => 'The return address is pushed onto the stack when the call is made: corrupting it redirects execution.',
					),
					1 => array(
						'question'    => 'What is the right defence strategy?',
						'explanation' => 'Defence in depth: each layer makes a different technique fail.',
					),
					2 => array(
						'question'    => 'What does the canary actually check?',
						'explanation' => 'If the sentinel changed, the stack was corrupted: the program stops before returning.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * demo-05 — Authentification
	 * ------------------------------------------------------------------ */
	'demo-05' => array(
		'title'   => 'Authentication',
		'excerpt' => 'Passwords, MFA, salted hashing: harden the proof of who your users are.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Proving who you are',
				'content' => '<p>Three notions:</p><ul><li><strong>Factor</strong> — something you know (a password), something you have (a token), something you are (biometrics).</li><li><strong>MFA</strong> — at least two factors from different families: a password plus a TOTP application is robust 2FA.</li><li><strong>Storage</strong> — the password must never be stored: you store a <em>salted</em> and slow <em>hash</em> (bcrypt, Argon2, scrypt). The salt is unique per user and makes precomputed tables useless.</li></ul><p><strong>Remember:</strong> length beats complexity. A long, unique password beats a short, complicated one that is reused.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Three questions on the fundamentals of authentication.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What does the acronym MFA mean in authentication?',
						'hint'        => 'Several pieces of evidence, of different natures.',
						'explanation' => 'MFA combines factors from different families: an SMS alone remains a single factor, and therefore weak.',
					),
					1 => array(
						'question'    => 'Which hashing algorithm is designed to be deliberately slow and salted?',
						'hint'        => 'Here, slowness is a feature.',
						'explanation' => 'bcrypt, Argon2 and scrypt are deliberately expensive: they turn brute-force cracking into an economic absurdity.',
					),
					2 => array(
						'question'    => 'What guarantee does a digital signature provide?',
						'hint'        => 'Two properties: nothing moved, and it really comes from the sender.',
						'explanation' => 'A signature guarantees integrity and authenticity; it does not guarantee confidentiality.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: Applied test — the forgotten password',
				'content' => '<p><strong>Mission.</strong> The team observed mass login attempts on the "forgotten password" form. Three possible measures.</p><p>1. Send the link by e-mail.<br>2. Limit the number of attempts per IP address.<br>3. Never say whether the address exists.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Why not reveal whether an e-mail address is registered?',
						'hint'        => 'Think about what the answer lets someone learn.',
						'explanation' => 'A different message depending on the case lets someone enumerate valid accounts: that is an exploitable information leak.',
					),
					1 => array(
						'question'    => 'Which measure blocks credential stuffing?',
						'hint'        => 'The attacker has to be slowed down.',
						'explanation' => 'Rate limiting turns a fast attack into a slow one: that is what makes it expensive.',
					),
					2 => array(
						'question'    => 'How long should a reset link stay valid?',
						'hint'        => 'A short-lived token does not have time to leak.',
						'explanation' => 'Random token, single use, short expiry: that trio is the basis of a safe reset mechanism.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: Exam',
				'content' => '<p>Three questions, 15 minutes, pass mark 75%.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Why do we salt a password before hashing it?',
						'explanation' => 'The salt prevents precomputation: each hash must be computed separately, which kills the precomputed tables.',
					),
					1 => array(
						'question'    => 'What is the main advantage of MFA over a plain password?',
						'explanation' => 'With two factors, stealing the password alone gives no access: that is what changes the game.',
					),
					2 => array(
						'question'    => 'Which property matters most for the strength of a password?',
						'explanation' => 'Length multiplies the number of possible combinations; uniqueness prevents reuse across services.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * demo-06 — Chiffrement et HTTPS
	 * ------------------------------------------------------------------ */
	'demo-06' => array(
		'title'   => 'Encryption and HTTPS',
		'excerpt' => 'Symmetric, asymmetric, hashing: the building blocks of cryptography, and how TLS works.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: The four building blocks',
				'content' => '<ul><li><strong>Hashing</strong> — one way, irreversible, salted. Used for integrity and for password storage, <em>never</em> for encryption.</li><li><strong>Symmetric encryption</strong> — a single key (AES). Fast, for large volumes.</li><li><strong>Asymmetric encryption</strong> — a private key / public key pair (RSA, ECDSA). Used for key exchange and signatures.</li><li><strong>Key exchange</strong> — Diffie-Hellman lets two parties establish a shared secret over a watched channel; TLS uses it to create a session key.</li></ul><p><strong>Remember:</strong> TLS combines both: asymmetric to authenticate and negotiate, symmetric to carry the data.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Four questions on the cryptographic primitives.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Which algorithm is a symmetric cipher (a single key)?',
						'hint'        => 'The same key encrypts and decrypts.',
						'explanation' => 'AES is the symmetric reference; ChaCha20 is an excellent alternative when the hardware has no native AES instructions.',
					),
					1 => array(
						'question'    => 'Which protocol negotiates and secures an encrypted channel between a client and a server?',
						'hint'        => 'It is what sits behind the little padlock.',
						'explanation' => 'TLS provides confidentiality, integrity and server authentication; the modern version is TLS 1.3.',
					),
					2 => array(
						'question'    => 'Which algorithm lets two parties establish a secret key over an insecure channel?',
						'hint'        => 'Each combines their own secret with the other\'s public value.',
						'explanation' => 'Diffie-Hellman rests on the discrete logarithm problem; TLS uses (EC)DHE for the session key.',
					),
					3 => array(
						'question'    => 'Which property guarantees that an encrypted message was not modified on the way?',
						'hint'        => 'Encryption alone is not enough.',
						'explanation' => 'An authenticated mode (AEAD, HMAC) is required: encryption alone does not detect modification.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: Applied test — reading the negotiation',
				'content' => '<p><strong>Mission.</strong> A capture shows the TLS negotiation of a server.</p><pre>ClientHello: TLS 1.3, cipher suites: TLS_AES_128_GCM_SHA256
ServerHello: TLS 1.3, key exchange: (EC)DHE
Certificate: CN=exemple.fr, issuer Let\'s Encrypt</pre><p>Three questions on what you observe.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the advantage of TLS 1.3 over TLS 1.2?',
						'hint'        => 'Compare the number of choices offered.',
						'explanation' => 'TLS 1.3 shrinks the surface: fewer suites, no MD5/SHA-1, and a shorter handshake, hence faster.',
					),
					1 => array(
						'question'    => 'What is the role of (EC)DHE in this negotiation?',
						'hint'        => 'It is the step right before the session key.',
						'explanation' => '(EC)DHE establishes a shared secret, which becomes the symmetric session key: the best of both worlds.',
					),
					2 => array(
						'question'    => 'What does the certificate presented by the server guarantee?',
						'hint'        => 'A certificate binds a name to a public key.',
						'explanation' => 'The certificate binds the domain name to the public key; a certificate authority signed it, hence the chain of trust.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: Exam',
				'content' => '<p>Three questions, 15 minutes, pass mark 75%.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Why does TLS use both asymmetric and symmetric cryptography?',
						'explanation' => 'Asymmetric solves key distribution; symmetric is so much faster that it cannot be dropped once the session is up.',
					),
					1 => array(
						'question'    => 'Why can you not use a hash to encrypt data?',
						'explanation' => 'A hash loses information: you cannot recover the message. It serves integrity, not confidentiality.',
					),
					2 => array(
						'question'    => 'What does an AEAD cipher suite do?',
						'explanation' => 'AEAD guarantees confidentiality <em>and</em> integrity, which removes most implementation mistakes.',
					),
				),
			),
		),
	),

);
