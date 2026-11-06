<?php
/**
 * Traductions anglaises du bloc « avance » (parcours Secura Academy).
 *
 * Meme structure que le contenu francais : les cles de tasks et de
 * questions sont identiques au FR, les choix gardent l'ordre du FR.
 *
 * @package Secura_Academy
 */

defined( 'ABSPATH' ) || exit;

return array(

	/* ---------------------------------------------------------------------
	 * avance-01 — La boutique en ligne : se connecter en administrateur
	 * ------------------------------------------------------------------ */
	'avance-01' => array(
		'title'   => 'The online shop: logging in as administrator',
		'excerpt' => 'A real vulnerable web application, alone in a closed network. We do not break it: we log in cleanly.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — a web application, and what it reveals',
				'content' => '<p>You are going to work on <strong>OWASP Juice Shop</strong>: a deliberately vulnerable e-commerce application, written by OWASP and used all over the world to learn how to test a web application. It runs here <em>alone</em> in a closed network: nobody outside can see it.</p><p>Three things to understand before starting:</p><ul><li><strong>A web application is a server that answers requests.</strong> Your terminal talks to the server (port 3000) the way a browser would. What you type into the login form goes out in an HTTP request.</li><li><strong>An SQL injection is a query that contains code.</strong> If the server naively glues what you write into its SQL query, you are not "tampering" with the data: you are <em>writing</em> another query. Where it expects an identifier, you can make it read the whole accounts table.</li><li><strong>Proof beats intuition.</strong> The application keeps a scoreboard of challenges. When you solve one, it displays a <em>flag code</em>: that code is what you will be asked for.</li></ul><p><strong>Remember:</strong> you do not attack an application "for fun". You test an <em>idea</em> — "what if this field were not validated?" — and you note what the machine answers. That is exactly a tester\'s job.</p><p><strong>Going further, for free:</strong> <a href="https://portswigger.net/web-security" target="_blank" rel="noopener">PortSwigger\'s Web Security Academy</a> offers several hundred web labs on exactly these flaws (SQL injection, XSS, bypassing access controls, forged requests…). The labs are free and run on deliberately vulnerable applications. We do not reproduce their content: we point to it, naming the source and its address.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions before touching the shop.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What happens if the server uses what you type into a field directly to build its SQL query?',
						'choices'     => array(
							'You can change the meaning of the query: that is an SQL injection',
							'The query is refused, the database is protected',
							'The server displays a more detailed error message',
							'The field is cleaned automatically, so there is nothing to do',
						),
						'hint'        => 'Think about what would happen if your text became a new statement.',
						'explanation' => 'An SQL injection comes from the missing separation between data and code. If the value is concatenated into the query, it can close the quote and add its own conditions. It is the number one OWASP Top 10 flaw and has been for years.',
					),
					1 => array(
						'question'    => 'In Juice Shop, what do you gain by logging in with an injection in the login form?',
						'choices'     => array(
							'The complete source code of the application',
							'Administrator access, which opens the administration area',
							'The OWASP production database',
							'Nothing: injections only work on signup pages',
						),
						'hint'        => 'An injection that works in one form works in the others.',
						'explanation' => 'The "e-mail" field of the login is famously injectable: an always-true condition turns the query into "return the first account", and that account is an administrator. The administration area then becomes reachable.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the flag of the "Login Admin" challenge',
				'content' => '<p>The shop is deployed in your lab: the application answers on <code>http://juice:3000</code>. Your terminal sits next to it.</p><p><strong>Mission.</strong> Log in as administrator without knowing the password (it is an SQL injection), then note the <strong>flag code</strong> the application displays when the "Login Admin" challenge is solved. It is a string of 40 hexadecimal characters: copy it exactly.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Copy the flag code displayed by the application when the "Login Admin" challenge is solved.',
						'hint'        => 'In the login form, an e-mail such as <code>\' OR 1=1--</code> changes the query condition. The code appears in the application notification, bottom right.',
						'explanation' => 'The code displayed by Juice Shop is a digest computed from the challenge name and a key we set. It is not an invention: it is the proof that the "Login Admin" challenge is really solved in the application. The platform server compares your answer with the code it keeps on its side.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Three questions on what you just did. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Why is testing an application inside a closed network good practice?',
						'choices'     => array(
							'It is faster, hence cheaper',
							'You avoid hitting a real system that never asked for it',
							'The closed network makes the flaws invisible',
							'It is the only way to see the source code',
						),
						'hint'        => 'Who authorised the test?',
						'explanation' => 'Testing an application without authorisation is an intrusion, even "to learn". The lab is isolated, off the Internet, and nobody else is concerned: that is the condition for learning quietly.',
					),
					1 => array(
						'question'    => 'An SQL injection that returns "too many results" indicates what?',
						'choices'     => array(
							'The database is too big',
							'The account is banned',
							'The query was executed but returns several rows: the injection worked',
							'The password is too long',
						),
						'hint'        => 'Read it again: is that number of results normal?',
						'explanation' => 'When the injection works, the condition is true for several accounts: the server returns several. That is the typical symptom, and it is what lets you move from a normal account to an administrator account.',
					),
					2 => array(
						'question'    => 'What separates a test from an attack?',
						'choices'     => array(
							'The speed',
							'The number of machines touched',
							'The use of a tool',
							'The intent, and the authorisation',
						),
						'hint'        => 'The same gesture can be a test or an attack: what changes?',
						'explanation' => 'A test starts from an authorisation and stops at the demonstration. An attack has neither. That is why the platform insists: we work on an application that is waiting for us, isolated, and the proof is read from the machine.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * avance-02 — La zone administrateur
	 * ------------------------------------------------------------------ */
	'avance-02' => array(
		'title'   => 'The administrator area: what an administrator sees',
		'excerpt' => 'Once inside the administrator space, you discover what the shop hides: customer orders, reports, products.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — the account that can do everything',
				'content' => '<p>An administrator account in an application is not "a bigger account". It is an account that can <strong>see and modify other people\'s data</strong>.</p><p>In Juice Shop, the administration space shows:</p><ul><li>the <strong>product catalogue</strong> (and the means to modify it);</li><li>the <strong>list of customer orders</strong> (therefore their addresses);</li><li>the users\' <strong>reports</strong>;</li><li>the application <strong>configuration</strong>.</li></ul><p>Two ideas to keep for what follows:</p><ol><li><strong>The real danger is not the account, it is what it allows.</strong> An admin account on a shop is access to the data of every customer.</li><li><strong>Every administration screen is a new place to test.</strong> You often find functions nobody uses, hence nobody tests: that is exactly where flaws hide (injection, stored XSS, file upload without checks).</li></ol><p><strong>Remember:</strong> a test does not stop at "I got in". It goes on to "here is what that access really allows you to do".</p><p><strong>Going further, for free:</strong> <a href="https://portswigger.net/web-security" target="_blank" rel="noopener">PortSwigger\'s Web Security Academy</a> offers several hundred web labs on exactly these flaws (SQL injection, XSS, bypassing access controls, forged requests…). The labs are free and run on deliberately vulnerable applications. We do not reproduce their content: we point to it, naming the source and its address.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on accounts and rights.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Why is it often said that "the administrator is not a superuser"?',
						'choices'     => array(
							'Because an administrator has fewer rights than a user',
							'Because an administrator has different rights, which are not "more rights" but "other rights"',
							'Because an administrator is a separate role, not a superuser',
							'Because the word "administrator" is an old keyword',
						),
						'hint'        => 'It is not about quantity, but about nature.',
						'explanation' => 'An administrator account is not "root": it is an administrator *of the application*. In Juice Shop it cannot encrypt or delete the server: it can modify the catalogue and read the orders. Security is a matter of context, not of volume of rights.',
					),
					1 => array(
						'question'    => 'Is a forgotten administration endpoint (not linked in the menu) dangerous?',
						'choices'     => array(
							'No, if nobody knows about it',
							'No, the server disables it on its own',
							'Yes: the absence of a link is not protection, and the URL is guessed or found',
							'Only if it accepts files',
						),
						'hint'        => 'A door without a handle is not a locked door.',
						'explanation' => 'It is a classic mistake: an administration endpoint removed from the interface but still active. A router discovers it quickly, and it stays live for months. The rule: what is no longer used must be disabled, not hidden.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the flag of the "Admin Section" challenge',
				'content' => '<p>Still in the shop (still deployed in your lab). This time the goal is no longer to log in, but to <strong>reach the administration area</strong> and look at it.</p><p><strong>Mission.</strong> Once in the administration space, note the <strong>flag code</strong> the application displays when the "Admin Section" challenge is solved (40 hexadecimal characters).</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Copy the flag code displayed by the application when the "Admin Section" challenge is solved.',
						'hint'        => 'Once logged in as administrator, the administration area becomes reachable. The code arrives in the application notification.',
						'explanation' => 'Reaching the administration space is an authorisation flaw: the application let through a session that should not give access to those screens. The displayed code is the proof that the screen was really reached.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Three questions on rights and administration screens. 60% is enough.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What should you test first in an administration space?',
						'choices'     => array(
							'The logo and the colours',
							'The number of connected users',
							'The functions that exist but are not used daily',
							'The display speed',
						),
						'hint'        => 'That is where nobody goes to look.',
						'explanation' => 'Rarely used functions escape testing: nobody uses them, so nobody watches them. That is where the most serious vulnerabilities sit, because nobody fixes them.',
					),
					1 => array(
						'question'    => 'For an administration account, "least privilege" means:',
						'choices'     => array(
							'Give every right so things go fast',
							'Give rights to whoever asks first',
							'Delete all accounts',
							'Give only the rights the task needs, and remove the rest',
						),
						'hint'        => 'Less, but just what is needed.',
						'explanation' => 'An account that can do everything can be stolen and then used for everything. Least privilege costs almost nothing to put in place and prevents a stolen account from becoming a catastrophe.',
					),
					2 => array(
						'question'    => 'Why is the shop a textbook case?',
						'choices'     => array(
							'Because it gathers in one application all the classic web flaws',
							'Because it sells interesting products',
							'Because it is the biggest shop in the world',
							'Because its code is public',
						),
						'hint'        => 'Look at the challenge list: it looks like the OWASP Top 10.',
						'explanation' => 'Juice Shop gathers in a single application vulnerabilities of every category: injection, XSS, weak passwords, configuration errors. That is why it is the most widely used learning tool in the world.',
					),
				),
			),
		),
	),

);
