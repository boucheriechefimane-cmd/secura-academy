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
						'question'    => 'What is a defender\'s first reflex when a security alert comes in?',
						'hint'        => 'You do not react blindly.',
						'explanation' => 'Before acting, gather the facts: what, when, where, how far it reaches. Acting without understanding is how you make an incident worse.',
					),
					1 => array(
						'question'    => 'What does the principle of least privilege mean?',
						'hint'        => 'Think about how many rights an account holds.',
						'explanation' => 'An account that does not need to be an administrator must not be one: every unnecessary right is one more way in.',
					),
					2 => array(
						'question'    => 'In security, what does the "attack surface" mean?',
						'hint'        => 'Ports, URLs, accounts, APIs: everything that can be called upon.',
						'explanation' => 'Shrinking the attack surface means reducing the number of entry points: close a port, remove an account, restrict an API.',
					),
					3 => array(
						'question'    => 'Which document describes the procedures to follow when an incident is detected?',
						'hint'        => 'It says who does what, and in which order.',
						'explanation' => 'The incident response plan formalises escalation, roles and communication: it is what prevents panic and bad decisions.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: Applied test — incident triage',
				'content' => '<p><strong>Situation.</strong> A colleague tells you an internal page is showing a SQL error that contains a table name. Your manager asks you to act immediately.</p><p>Answer precisely: what has to be done first, and what must absolutely not be done.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the very first action?',
						'hint'        => 'Nothing is stabilised yet: observe before touching.',
						'explanation' => 'Capture the state (screenshot, logs, exact time) before any change: without initial evidence you can neither prove the impact nor verify the fix.',
					),
					1 => array(
						'question'    => 'What must NOT be done first?',
						'hint'        => 'You would lose the trace of what happened.',
						'explanation' => 'Restarting or cleaning destroys evidence: logs, memory, core dumps. You lose the cause and go back to guessing.',
					),
					2 => array(
						'question'    => 'Is the CIA triad still respected on all three pillars?',
						'hint'        => 'Has the data been altered?',
						'explanation' => 'An exploited SQL injection changes data: that is an integrity violation. Confidentiality may still hold, but trust in the database is gone.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: Exam',
				'content' => '<p>Three questions, 10 minutes, pass mark 70%. No hints: this is where you check that the reflexes are automatic.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Which CIA property protects against unauthorised modification of data?',
						'explanation' => 'Confidentiality protects reading, availability protects access, integrity protects modification.',
					),
					1 => array(
						'question'    => 'What is the main purpose of least privilege?',
						'explanation' => 'If an account is stolen, its rights limit the extent of the damage: this is damage limitation, not prevention.',
					),
					2 => array(
						'question'    => 'What does the incident response plan document?',
						'explanation' => 'It documents procedures, roles and escalation: its value comes from anticipation, not from the paper it is written on.',
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
						'question'    => 'At which OSI layer does TCP sit?',
						'hint'        => 'Count: 1 physical, 2 data link, 3 network, 4…',
						'explanation' => 'TCP lives at layer 4 (transport): it handles segments, ports and end-to-end reliability.',
					),
					1 => array(
						'question'    => 'Which address physically identifies a network card on a local network?',
						'hint'        => 'Six bytes, burned into the card.',
						'explanation' => 'The MAC address is a layer-2 identifier: it identifies the physical interface, not the host in the IP sense.',
					),
					2 => array(
						'question'    => 'Which protocol is used on port 443?',
						'hint'        => 'It is the encrypted version of the web.',
						'explanation' => 'Port 443 carries HTTP over TLS: the traffic is encrypted and the server identity is verified through its certificate.',
					),
					3 => array(
						'question'    => 'What is the main job of a firewall?',
						'choices'     => array(
							'Filtering network traffic',
							'Encrypting data',
							'Backing up files',
							'Speed up the connection',
						),
						'hint'        => 'It allows, refuses or logs flows.',
						'explanation' => 'A firewall applies a flow policy: that is perimeter control, not protection of the applications themselves.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: Applied test — explore the machine',
				'content' => '<p><strong>Mission.</strong> A machine has been compromised. You have access to its terminal. Find the configuration file and the flag it contains.</p><p>Use the terminal below: the commands are simulated, no real system is touched.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the flag found in the configuration file?',
						'hint'        => 'Read the output of the cat command again.',
						'explanation' => 'The flag was in config.txt: you had to list the files first, then read the right one.',
					),
					1 => array(
						'question'    => 'On which port does an encrypted web server listen?',
						'hint'        => 'It is the standard HTTPS port.',
						'explanation' => '443 is the standard port for HTTP over TLS; 80 remains the clear-text HTTP port.',
					),
					2 => array(
						'question'    => 'Which protocol carries data without a connection or a delivery guarantee?',
						'hint'        => 'Voice and streaming use it.',
						'explanation' => 'UDP does not retransmit: faster, but with no guarantee of arrival or order. That is a choice, not a defect.',
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
						'question'    => 'Which OSI layer handles the logical addressing of networks?',
						'explanation' => 'Layer 3 (network) carries IP addresses and routing between networks.',
					),
					1 => array(
						'question'    => 'What is a service port?',
						'explanation' => 'The port identifies the destination application on a machine: that is what lets several services coexist.',
					),
					2 => array(
						'question'    => 'What does a MAC address allow?',
						'explanation' => 'It identifies the physical interface on the local link; it is not routable beyond the segment.',
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
