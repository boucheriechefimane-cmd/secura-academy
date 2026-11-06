<?php
/**
 * Traductions anglaises du parcours M3 : les dix scenarios.
 *
 * Ce fichier ne contient QUE de la traduction. Il est indexe par cle stable
 * de room (`m3-01`...`m3-10`), puis par index de tache et de question, comme
 * le stockage du plugin. Consequences, verifiables :
 *   - une tache qui gagne une question en francais et pas ici est signalee
 *     par tools/recette-apprenants/mesure-anglais.php, avant l'eleve ;
 *   - les options d'un QCM sont dans le MEME ORDRE (le serveur designe la
 *     bonne reponse par son index) ;
 *   - le balisage HTML est conserve a l'identique ;
 *   - chemins, commandes, adresses et identifiants ne sont pas traduits.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(

	/* ---------------------------------------------------------------------
	 * m3-01 — Le service qui ne repond plus (triage)
	 * ------------------------------------------------------------------ */
	'm3-01' => array(
		'title'   => 'The service that stopped answering',
		'excerpt' => 'A service is down and nobody knows why. Learn to triage methodically before touching anything.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Triage in four moves',
				'content' => '<p>When a service stops answering, you do not "fix" it at random. You follow a method:</p><ol><li><strong>Gather</strong>: what is not working, since when, for whom?</li><li><strong>Observe</strong>: the machine itself. A status page, a configuration file, a log — a failure always leaves a trace there.</li><li><strong>Compare</strong>: what the trace says against what is expected.</li><li><strong>Conclude</strong>: one sentence, not a hunch.</li></ol><p><strong>Remember:</strong> a good observation beats a random fix. On this machine the application is healthy: the problem comes from the <em>configuration</em>.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Three questions to anchor the triage method.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'You have to diagnose a site that stopped answering. Where do you start?',
						'choices'     => array(
							'Changing the database password',
							'Deleting the logs to start from scratch',
							'By collecting evidence from the machine',
							'Restarting the server right away',
						),
						'hint'        => 'A fix without an observation is a guess.',
						'explanation' => 'Triage starts with observation: a status page, a log, a configuration. You fix afterwards, not before.',
					),
					1 => array(
						'question'    => 'You read a configuration file and find a password in clear text. What do you take away?',
						'choices'     => array(
							'That is normal for an internal server',
							'Restricting the file permissions is enough',
							'It is only a problem if the file is on the Internet',
							'A secret in clear text in a file is a risk, and must be reported',
						),
						'hint'        => 'Think about the fate of the file: who can read it?',
						'explanation' => 'A secret written in clear text in a file is read by anyone with access to the file. It is a defect to report, even when it is not the outage.',
					),
					2 => array(
						'question'    => 'What makes a log entry useful?',
						'choices'     => array(
							'It is timestamped and it says what happened',
							'It is printed in colour in the terminal',
							'It contains the server administrator name',
							'The bigger the log file, the more useful the entry',
						),
						'hint'        => 'Without a time and an event, a log line tells nothing.',
						'explanation' => 'A useful entry states WHEN and WHAT. That is what lets you tie an event to a precise period.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission',
				'content' => '<p><strong>Mission.</strong> Deploy the machine, then do your triage. Is the application at fault? Or the configuration?</p><p>The answer is on the machine: read the application configuration and note its internal version number. That code is the proof that you completed the triage.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the internal version code of the application (the "build_id").',
						'hint'        => 'The service status page says where the configuration lives. It is in /srv/app.',
						'explanation' => 'The version code (build_id) identifies exactly which build is deployed. In operations, it is how you know which patch applies.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-scenario exam',
				'content' => '<p>Seven questions, timed. You need 80% to pass.</p>',
				'questions' => array(
					array(
						'question'    => 'A service has stopped answering. What is the first move?',
						'choices'     => array(
							'Restart it: it is quick, and it unblocks users straight away',
							'Reinstall the service: we start again from a sound, well-known base',
							'Note the state and the logs before changing anything on the machine',
							'Cut the network so the incident cannot spread to the other services',
						),
						'hint'        => 'The first move is not to repair: it is to establish what is true.',
						'explanation' => 'A restart wipes the state that explains the failure: queue emptied, process killed, log truncated. You note first, you act afterwards.',
					),
					array(
						'question'    => 'A password is written in clear text in a file anyone can read. What is the flaw?',
						'choices'     => array(
							'The secret is protected only by the access rights on that file',
							'The file takes space and slows down the application startup',
							'The password is lost if somebody deletes the file by mistake',
							'The file prevents changing the password without redeploying',
						),
						'hint'        => 'Ask yourself what still protects the secret, once it sits on disk.',
						'explanation' => 'A clear-text secret relies on the file access control alone. And that control is often wrong, while a backup or an image copies it elsewhere.',
					),
					array(
						'question'    => 'A log entry is called usable when it holds two things. Which ones?',
						'choices'     => array(
							'The time of the event and what happened at that very moment',
							'The service name and the version number running on that very machine',
							'The server address and the name of the admin on duty right now',
							'The severity level and how long the request took to be handled',
						),
						'hint'        => 'A log answers two investigation questions: when, and what.',
						'explanation' => 'Without a timestamp you cannot correlate with other sources; without the event you do not know what took place. The rest is useful, but secondary.',
					),
					array(
						'question'    => 'On the exercise machine, where is the application configuration?',
						'choices'     => array(
							'In the application directory, under /srv/app on that machine',
							'In the web server access log, next to the requests it received',
							'In the backup directory, together with the exported database',
							'In the system accounts file, along with the other identifiers',
						),
						'hint'        => 'The service status page gives the path: that is what it is for.',
						'explanation' => '/srv/app is the application directory in this image. The access log, the backups and /etc/passwd also exist on the machine, which makes them believable — but none of them holds the configuration.',
					),
					array(
						'question'    => 'A service has answered slowly for a week. What do you do first?',
						'choices'     => array(
							'Measure latency, throughput and resources before changing anything',
							'Restart the service to free the memory the process has accumulated',
							'Add memory to the server, since the load has obviously increased',
							'Move the service to a newer, better provisioned and more powerful server',
						),
						'hint'        => 'Optimising without measuring is correcting at random.',
						'explanation' => 'Without a measurement you cannot tell whether time is lost in the database, the network or the code. You can add memory and hide the problem without solving it.',
					),
					array(
						'question'    => 'You find the production password in clear text on the server. What do you do?',
						'choices'     => array(
							'Report it, propose a secrets vault and have the password rotated',
							'Fix it yourself without telling anyone, to avoid alarming the team',
							'Do nothing: it is on an internal server, out of reach from the network',
							'Forward it to the team on the chat channel so everyone can check it',
						),
						'hint'        => 'A secret that could be read must be treated as already stolen.',
						'explanation' => 'A secret that has been read is no longer a secret: rotate it, then remove the cause. Silence and wide distribution both prolong its life.',
					),
					array(
						'question'    => 'Why is one secret copied into five files a security problem?',
						'choices'     => array(
							'Because each copy is an entry point to protect and to rotate',
							'Because the five files eventually stop being identical to each other',
							'Because the application reads five files instead of one at startup',
							'Because backing up the five files takes longer every single night',
						),
						'hint'        => 'Count where the secret can leak, then where it must be changed.',
						'explanation' => 'Five copies mean five exposed surfaces and five rotations not to forget. In practice one is forgotten and stays valid after the change.',
					),

				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * m3-02 — Le mot de passe oublie
	 * ------------------------------------------------------------------ */
	'm3-02' => array(
		'title'   => 'The forgotten password',
		'excerpt' => 'Nobody remembers the database password. A single source of truth exists — and it is readable.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Where do secrets live?',
				'content' => '<p>A secret (a password, a key, a token) must be stored once, in one place, and access to that place must be controlled. In practice you very often find the opposite:</p><ul><li>the secret is written in clear text in a configuration file;</li><li>the file can be read by everyone;</li><li>and the same secret has been copied into three other files.</li></ul><p><strong>Remember:</strong> hunting a secret means finding <em>where it is</em>, not <em>what it is</em>. And saying so is already a finding: a secret in clear text in a readable file is a secret that has to be rotated.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on how secrets are stored.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Where should a password live, in an application that is built properly?',
						'choices'     => array(
							'In a configuration file protected by a password',
							'In the source code, encrypted by the application',
							'In a session variable',
							'In a vault (a secrets manager), not in a readable file',
						),
						'hint'        => 'Think about what "reachable by anyone holding the file" really means.',
						'explanation' => 'The secret lives apart from the application: a vault, injected environment variables, a secrets service. Never in clear text in a readable file.',
					),
					1 => array(
						'question'    => 'You find a password in clear text in a configuration file. What is the right reaction?',
						'choices'     => array(
							'Report it and rotate it',
							'Fix it immediately, without telling anyone',
							'Do nothing: it is a detail',
							'Post it in the team channel so everyone can memorise it',
						),
						'hint'        => 'The problem does not vanish because you saw it.',
						'explanation' => 'You report, you propose a fix (a secrets vault), then you rotate the credential. The secret itself must also be changed.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission',
				'content' => '<p><strong>Mission.</strong> The team needs the database password for a restore. It is written down somewhere on the machine. Find it.</p><p>Hint: the service status page says where the application configuration lives.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the database password?',
						'hint'        => 'The configuration file is in /srv/app. Read it whole.',
						'explanation' => 'The password was written in clear text in the configuration. That is exactly the defect to report: it calls for a secrets vault and an immediate password change.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-scenario exam',
				'content' => '<p>Five questions, timed. You need 80% to pass.</p>',
				'questions' => array(
					array(
						'question'    => 'A password is written in clear text in a file anyone can read. What is the flaw?',
						'choices'     => array(
							'The secret depends only on who is allowed to read that file',
							'The file takes up space and slows the whole service down at startup',
							'The password is lost if somebody deletes the file by mistake',
							'The file prevents changing the password without a redeploy',
						),
						'hint'        => 'Ask yourself what still protects the secret, once it sits on disk.',
						'explanation' => 'A clear-text secret relies on the file access control alone. That control is often wrong, and a backup or an image copies it elsewhere.',
					),
					array(
						'question'    => 'A secret has been found in clear text on a production server. What do you do with it?',
						'choices'     => array(
							'Treat it as stolen and change it everywhere it has been used',
							'Keep it: it did not leak, nobody read it apart from you and me',
							'Move it into a .env file at the root of the project, which is cleaner',
							'Rename it so that its name can no longer be guessed by an attacker',
						),
						'hint'        => 'A secret that could be read must be treated as already stolen.',
						'explanation' => 'A secret that has been read is no longer a secret. Rotate it, then remove the cause: a vault, or a secret injected at startup.',
					),
					array(
						'question'    => 'What does a diagnostic page such as status.php allow?',
						'choices'     => array(
							'Giving paths and versions: a map for the attacker to use',
							'Restarting the web service remotely when it stops answering',
							'Resetting the database so everything starts from a clean state',
							'Changing the application setup without access to the server',
						),
						'hint'        => 'A diagnostic page observes: it does not command anything.',
						'explanation' => 'It gives paths, versions, sometimes environment variables. A huge help for the operator, and an entry point for an attacker.',
					),
					array(
						'question'    => 'In a clean architecture, where does an application password belong?',
						'choices'     => array(
							'In a secrets vault, injected when the application starts up',
							'In a comment inside the config file, right next to the key',
							'In the startup log, so the value is found again if forgotten',
							'In a clear-text .env file, right next to the app code',
						),
						'hint'        => 'The secret is injected at startup: it is no longer on disk.',
						'explanation' => 'Secrets vault, environment variables injected at startup, secrets service: in all three cases the secret is no longer written to a readable disk.',
					),
					array(
						'question'    => 'Why is one secret copied into several files dangerous?',
						'choices'     => array(
							'Because each copy is one more entry point and rotation to track',
							'Because the copies eventually stop being identical to each other',
							'Because the application reads several files instead of just one',
							'Because backing up all of those files takes more and more time',
						),
						'hint'        => 'Count where the secret can leak, then where it has to be changed.',
						'explanation' => 'Five copies mean five exposed surfaces and five rotations not to forget. In practice one is forgotten and stays valid after the change.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * m3-03 — La page qui se trahit (XSS reflechie)
	 * ------------------------------------------------------------------ */
	'm3-03' => array(
		'title'   => 'The page that gives you away',
		'excerpt' => 'A page echoes your input back verbatim. A robot visits the pages at night: what is going to happen?',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Why an echoing page is serious',
				'content' => '<p>A web page does three things: it receives data (URL, form), mixes it with code, and sends the result back to the browser.</p><p>If the data is returned <strong>without being escaped</strong>, the browser reads it as code: that is a <strong>script injection</strong> (XSS). The problem is not the page: it is <em>who is looking at it</em>.</p><p>An administrator who opens the page with their session still active becomes the vehicle. That is what a <strong>reflected script injection</strong> is: your input comes back inside the page, and the visitor is the one who triggers it.</p><p><strong>Remember:</strong> the fix is not to block dangerous words, it is to <strong>escape</strong> the output (turn <code>&lt;</code> into <code>&amp;lt;</code>) and to add a CSP header. As long as you reflect input into the page, you are reflecting code.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions to understand the mechanism.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What makes a script injection dangerous?',
						'choices'     => array(
							'It runs in the visitor\'s browser, with the visitor\'s rights',
							'It runs on the server, with the administrator\'s rights',
							'It runs inside the database',
							'It only runs on old browsers',
						),
						'hint'        => 'The page is on YOUR server, but it is read by THEIR browser.',
						'explanation' => 'The script runs at the visitor. If the visitor is a logged-in administrator, it is their session that gets stolen.',
					),
					1 => array(
						'question'    => 'What is the correct fix against a script injection?',
						'choices'     => array(
							'Ask the user not to click',
							'Escape the output and set a CSP',
							'Block the word "script" in the input',
							'Reject every request containing angle brackets',
						),
						'hint'        => 'Word-list filtering is always incomplete.',
						'explanation' => 'You escape the output systematically (htmlspecialchars) and set a CSP as defence in depth. Filtering "script" is a dead end.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission',
				'content' => '<p><strong>Mission.</strong> The file <code>/home/ctf/notes.txt</code> mentions a monitoring robot that visits the pages at night. Read it, then make the robot visit a page that contains a script. Observe what it records, and report the token it stole.</p><p>The robot does not understand JavaScript: it detects the presence of a script and records what the script would have stolen. The page is in <code>/var/www/html/</code>, and the robot log in <code>/var/log/app/</code>.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'The robot recorded a session token: give it.',
						'hint'        => 'The robot is started by a page of the application. Make it visit a page where your input comes back verbatim.',
						'explanation' => 'A script payload in the search page, visited by the monitoring robot, made it record the administrator token. The fix: escape the output and set a CSP.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-scenario exam',
				'content' => '<p>Five questions, timed. You need 80% to pass.</p>',
				'questions' => array(
					array(
						'question'    => 'Where does the code injected through an XSS flaw run?',
						'choices'     => array(
							'In the victim\'s browser, which runs the text that was sent',
							'On the web server, with the rights of the service hosting the site',
							'Inside the database, when the value is written down for storage',
							'In the terminal of the admin who is reading the logs of the site',
						),
						'hint'        => 'Who runs the text that the server sends back?',
						'explanation' => 'The server sends text; the browser runs it. That is why the flaw lives in the page, not in the server.',
					),
					array(
						'question'    => 'Why is a reflected XSS dangerous inside a company?',
						'choices'     => array(
							'Because an administrator may click on the booby-trapped link',
							'Because it permanently deletes the cookies kept on the server',
							'Because it floods the web server with repeated requests',
							'Because it slows the site down for every single visitor',
						),
						'hint'        => 'Think about who reads that page in a company, and with which rights.',
						'explanation' => 'The impact depends on the victim. Targeting an administrator turns a minor flaw into a takeover: the script acts with that person\'s rights.',
					),
					array(
						'question'    => 'What does escaping the output actually do?',
						'choices'     => array(
							'It turns the special characters into text to display',
							'It removes every HTML tag from the text before storing it',
							'It replaces the dangerous words with asterisks on the page',
							'It blocks the request as soon as it holds a script tag',
						),
						'hint'        => 'You do not delete the content: you change what it means to the browser.',
						'explanation' => 'The characters <, >, & and " become HTML entities: the browser displays them instead of running them. The text stays intact, its meaning changes.',
					),
					array(
						'question'    => 'Is a filter that blocks the word script enough to stop XSS?',
						'choices'     => array(
							'No: an event attribute or a variant goes straight past it',
							'Yes, as long as the filter applies to every input on the page',
							'Yes, if the page is served in UTF-8 with a correct header',
							'Yes, except on the login pages, which are already protected',
						),
						'hint'        => 'A filter can be worked around; escaping cannot.',
						'explanation' => 'scr<script>ipt or an event attribute slips through the filter. You escape the output rather than filter the input: a filter can always be worked around.',
					),
					array(
						'question'    => 'What is a CSP (Content-Security-Policy)?',
						'choices'     => array(
							'A header listing what the browser is allowed to load',
							'An application firewall placed in front of the server',
							'A file telling search robots not to visit certain pages',
							'A password that protects access to the admin panel',
						),
						'hint'        => 'It is a header the server sends to the browser.',
						'explanation' => 'Content-Security-Policy: even if a script slips in, the browser refuses to load undeclared sources. It is defence in depth, not a replacement for escaping.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * m3-04 — La requete qui ne se fie a personne (injection SQL)
	 * ------------------------------------------------------------------ */
	'm3-04' => array(
		'title'   => 'The query that trusts nobody',
		'excerpt' => 'The application builds its query out of what you type. What if it took you at your word?',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: What a ready-made query is',
				'content' => '<p>A SQL query is text. That text is built by the program, often out of what the user typed:</p><p style="background:#1b1b1b;padding:.6em;color:#eee;font-family:monospace">SELECT id, username FROM users WHERE username = \'<b>what you type</b>\' AND password = \'<b>what you type</b>\'</p><p>If you type an apostrophe, you close the program string and <strong>you write in its place</strong>. An apostrophe followed by a comment (<code>--</code>) neutralises the rest of the query: the password condition disappears.</p><p>The fix is not to forbid the apostrophe: it is to <strong>never paste data into the query text</strong>, but to pass it separately (a prepared query), so that the engine separates structure from data.</p><p><strong>Remember:</strong> a prepared query neutralises the injection; a filter on one character merely postpones it.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on queries.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What makes a SQL query injectable?',
						'choices'     => array(
							'The large number of tables in the database',
							'Pasting data into the query text',
							'Using a SQL database at all',
							'Using prepared queries',
						),
						'hint'        => 'Look at how the query is built.',
						'explanation' => 'When user data enters the query text, it can change its structure. A prepared query passes the data separately: no more injection.',
					),
					1 => array(
						'question'    => 'Why is a prepared query safe?',
						'choices'     => array(
							'Because it forbids any authentication error',
							'Because the engine rejects queries that are too long',
							'Because the structure is fixed in advance and the data is handled as data',
							'Because it is encrypted before reaching the server',
						),
						'hint'        => 'Does the engine tell structure from data?',
						'explanation' => 'The SQL engine receives structure and data separately: no data can change the structure of the query any more.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission',
				'content' => '<p><strong>Mission.</strong> The administration lost its password, but the account exists. Get past the authentication, then go and fetch the application secrets: they live in a table of the database. The administration page (served once you are logged in) will tell you which one.</p><p>Hint: the notes file mentions it, and the login page is on port 8080.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'The secret in the "secrets" table: give it.',
						'hint'        => 'An apostrophe closes the program string. Try a comment after it, so the rest of the query is ignored.',
						'explanation' => 'An apostrophe and a comment rewrote the condition: the login goes through without a password. The fix: prepared queries everywhere, and a hashed password (never clear text) in the database.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-scenario exam',
				'content' => '<p>Five questions, timed. You need 80% to pass.</p>',
				'questions' => array(
					array(
						'question'    => 'What is the real defence against an SQL injection?',
						'choices'     => array(
							'Prepared statements: the structure of the query is fixed',
							'Filtering the apostrophe at the input of every single form',
							'Encrypting the database and its backups while at rest',
							'Caching the pages so that fewer queries get executed',
						),
						'hint'        => 'The defence is in the code: data stops entering the structure.',
						'explanation' => 'Prepared statements: the query structure is fixed in advance, the value can no longer change it. Filtering and encryption do not address the cause.',
					),
					array(
						'question'    => 'Why should passwords be hashed before they are stored?',
						'choices'     => array(
							'So a stolen database does not hand over passwords in clear',
							'So the identifiers stay a lot shorter when stored on disk',
							'So the password check is performed by the application server',
							'So the password is encrypted by the browser of the client',
						),
						'hint'        => 'Think of the worst case: the database is stolen, what can be done with it?',
						'explanation' => 'If the database is stolen, a salted hash does not give access to the accounts. A clear-text password does.',
					),
					array(
						'question'    => 'What does an SQL comment (`--`) inside a payload do?',
						'choices'     => array(
							'It neutralises the end of the query that is being executed',
							'It makes the query far slower by forcing a full sort of rows',
							'It deletes the table that the original query was targeting',
							'It blocks the connection between the app and the database',
						),
						'hint'        => 'It makes the server ignore the rest of the query.',
						'explanation' => 'Everything after the comment is ignored: the password check disappears, and the always-true condition is enough to open the session.',
					),
					array(
						'question'    => 'Is a filter rejecting the apostrophe enough against SQL injection?',
						'choices'     => array(
							'No: other encodings and other queries simply go around it',
							'Yes, if the filter applies to every input across the site',
							'Yes, because the apostrophe is the only dangerous character',
							'Yes, if the database and the site share the same encoding',
						),
						'hint'        => 'A filter works on text; the attack works on structure.',
						'explanation' => 'It can be worked around: encodings, numeric queries with no apostrophe, other engines. The only durable defence is the prepared statement.',
					),
					array(
						'question'    => 'Why is the secrets table a prime target for an attacker?',
						'choices'     => array(
							'Because an injection reaches every table, not only the accounts',
							'Because its name can be guessed far more easily than the other tables',
							'Because it holds the largest number of rows in the whole database',
							'Because it is the only table that the application can modify here',
						),
						'hint'        => 'Every table is reachable; this one costs more when it leaks.',
						'explanation' => 'An SQL injection does not stop at the accounts: it reaches every table. You segment the database and limit the rights of the application account.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * m3-05 — Le fichier qu'on n'aurait pas du laisser (traversee)
	 * ------------------------------------------------------------------ */
	'm3-05' => array(
		'title'   => 'The file that should never have been left there',
		'excerpt' => 'A page downloads a file on request. What if you asked for a different file than the one intended?',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: The path you choose',
				'content' => '<p>A <strong>directory traversal</strong> means forcing a path out of the expected folder. The server takes a file name and appends it to a prefix:</p><p style="background:#1b1b1b;padding:.6em;color:#eee;font-family:monospace">/var/www/html/ + <b>what you ask for</b></p><p>If what you ask for contains <code>../</code>, the path climbs back up. Three <code>../</code> from <code>/var/www/html</code> reach the root, and the rest of the path becomes free.</p><p><strong>Remember:</strong> the fix is not to filter "../" (one is enough to block, but the variants are endless: encodings, double slashes…). The fix is to <strong>resolve the real path, then check it stays inside the allowed folder</strong>.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on paths.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'How do you separate the path from the data?',
						'choices'     => array(
							'By filtering forbidden characters',
							'By rejecting any name that contains a dot',
							'By resolving the real path and checking it stays in the allowed folder',
							'By checking the prefix of the submitted text',
						),
						'hint'        => 'A text prefix is not a barrier.',
						'explanation' => 'You normalise (realpath) and compare against the allowed folder. That is the only check that holds against the variants.',
					),
					1 => array(
						'question'    => 'Why is filtering the string "../" fragile?',
						'choices'     => array(
							'Because the server takes longer to answer',
							'Because modern browsers block that string',
							'Because the string is too short to be filtered',
							'Because there are many variants of it',
						),
						'hint'        => 'Think of double slashes, URL encodings, absolute paths.',
						'explanation' => 'A string filter is always bypassable. The check must be on the resolved path, not on the text.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission',
				'content' => '<p><strong>Mission.</strong> The documentation page (<code>/download.php</code>) downloads a file by name. The automatic backups of the application are left in <code>/var/backups/</code>. Retrieve the licence key that sits there.</p><p>Hint: <code>/robots.txt</code> on the application may already point you there.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'The licence key found in the backup: give it.',
						'hint'        => 'The file name is appended to a prefix. Try climbing three directories, then dropping into /var/backups/app/.',
						'explanation' => 'The clear-text backup of the application was reachable through directory traversal. The fix: resolve the real path and check it stays in the allowed folder, and keep backups off the web server.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-scenario exam',
				'content' => '<p>Five questions, timed. You need 80% to pass.</p>',
				'questions' => array(
					array(
						'question'    => 'What is a directory traversal?',
						'choices'     => array(
							'Making a path leave the folder the application intended',
							'Copying a file from one folder to another one on the server',
							'Listing the contents of a folder to learn which files exist',
							'Moving from one folder to the next one in the server tree',
						),
						'hint'        => 'It means stepping outside the frame the application set.',
						'explanation' => 'The path is made to leave the intended folder so that a file which was never exposed can be read: configuration, keys, /etc/passwd.',
					),
					array(
						'question'    => 'Which check survives every encoding variant?',
						'choices'     => array(
							'Resolving the path, then checking it is in the allowed root',
							'Blocking the string ../ in everything that the user types in there',
							'Rejecting every file name that contains a slash or a colon',
							'Decoding the input once before looking for the string ..',
						),
						'hint'        => 'The only solid check works on the resolved path, not on the text.',
						'explanation' => 'You resolve the path (realpath), then check it stays under the allowed root. Blocking ../ misses %2e%2e, ..%2f and the Unicode variants.',
					),
					array(
						'question'    => 'What should be done with a backup sitting in the web-served folder?',
						'choices'     => array(
							'Moving it out of the served folder, then encrypting it',
							'Renaming it to .bak so that nobody downloads the file by accident',
							'Protecting it with a password inside a .htaccess file',
							'Compressing it so that it becomes harder to read for anyone',
						),
						'hint'        => 'If the web server can read it, so can the attacker.',
						'explanation' => 'A backup has no business on a web server: move it out of the served folder, and encrypt it at rest. Renaming or compressing are not protections.',
					),
					array(
						'question'    => 'Why does a robots.txt file interest an attacker?',
						'choices'     => array(
							'It lists the paths not to visit, so the ones to visit',
							'It forces the search engines to stop in front of this whole site',
							'It allows the firewall of the whole site to be disabled',
							'It contains the password of the administration panel',
						),
						'hint'        => 'That file exists to tell the world what is on the site.',
						'explanation' => 'A robots.txt lists the sensitive paths: a map for the attacker, and a reminder for the defender to check what sits behind them.',
					),
					array(
						'question'    => 'An encrypted backup still sits in the web-served folder. Is that enough?',
						'choices'     => array(
							'No: the file stays downloadable and can be attacked offline',
							'Yes: without the key, the file reveals no usable secret at all',
							'Yes: the encryption makes the file useless to any attacker',
							'No: the file also has to be renamed to become invisible',
						),
						'hint'        => 'A file you can download can be attacked with no time limit.',
						'explanation' => 'Encryption protects the content, not the access: the attacker downloads the file and works offline, with no timer and no alert.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * m3-06 — Qui a force la porte ? (lecture de journaux)
	 * ------------------------------------------------------------------ */
	'm3-06' => array(
		'title'   => 'Who forced the door?',
		'excerpt' => 'A burst of failed attempts, then one request that goes through. Your job: put the story back in order.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Reading a log like a story',
				'content' => '<p>An access log is a series of lines, each describing one request:</p><p style="background:#1b1b1b;padding:.6em;color:#eee;font-family:monospace">IP - - [date time] "METHOD path HTTP/1.1" CODE size</p><p>Three readings are enough:</p><ul><li><strong>Who?</strong> the IP address at the start of the line; grouping lines by IP reveals the machines that keep trying.</li><li><strong>When?</strong> the timestamp: a burst of attempts within minutes is not normal behaviour.</li><li><strong>What?</strong> the response code: <code>401</code> failure, <code>200</code> success. A burst of 401 followed by a 200 means a target gave way.</li></ul><p><strong>Remember:</strong> you do not read a log line by line, you <em>group</em> it. The tools (grep, sort, uniq, wc) exist for exactly that.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on reading logs.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Which sequence indicates a successful login after several failures?',
						'choices'     => array(
							'Several 200 then one 401',
							'One 404 followed by a 301',
							'Several 500 then one 200',
							'Several 401 then one 200',
						),
						'hint'        => 'Look at the response codes.',
						'explanation' => '401 = refused, 200 = accepted. The order matters: several failures then a success is a successful brute force.',
					),
					1 => array(
						'question'    => 'Why group lines by IP address?',
						'choices'     => array(
							'To see which machine keeps insisting',
							'To count the total number of lines',
							'To encrypt the content of the requests',
							'To sort the pages alphabetically',
						),
						'hint'        => 'One line says nothing; a hundred identical ones do.',
						'explanation' => 'Grouping reveals patterns: an IP that insists, an IP that downloads a lot, an unknown IP.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission',
				'content' => '<p><strong>Mission.</strong> The service log is in <code>/var/log/app/access.log</code>. A burst of attempts took place, then an unusual request succeeded. Find the token the attacker obtained at the end of the sequence.</p><p>Hint: the last request of the burst is not a login attempt.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'The token obtained by the attacker: give it.',
						'hint'        => 'Look for a request that stands out in the last lines of the log, and read its parameters.',
						'explanation' => 'After the burst of 401, an export request succeeded with a token in its parameters: the exfiltrated data is right there, in clear text, in the log. The fix: monitor exports, rotate tokens, and never put a secret in a URL.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-scenario exam',
				'content' => '<p>Four questions, timed. You need 80% to pass.</p>',
				'questions' => array(
					array(
						'question'    => 'What does the HTTP 401 response code mean?',
						'choices'     => array(
							'The client did not send a valid authentication',
							'The client is authenticated but not allowed that resource',
							'The requested resource does not exist on this server',
							'The server changed version since the previous request',
						),
						'hint'        => '401 is about authentication; 403 is about authorisation.',
						'explanation' => '401: a valid authentication is missing, or the one sent does not fit. 403: the client is known, but has no right to that resource.',
					),
					array(
						'question'    => 'Why is putting a secret in a URL a bad idea?',
						'choices'     => array(
							'The secret ends up in the logs and in the browsing history',
							'URLs are not encrypted at all, not even under HTTPS',
							'A URL is far too short to hold a secret inside it',
							'The browser blocks any URL longer than one hundred characters',
						),
						'hint'        => 'Think about everything that keeps a copy of the URL.',
						'explanation' => 'URLs are logged by the server, the proxies and the browser, and they stay in the history. A secret has no business in there.',
					),
					array(
						'question'    => 'What does a burst of 401 followed by a 200 on one address show?',
						'choices'     => array(
							'A successful login after a long set of failures',
							'A port scan that eventually found an open door',
							'A server that changed version during the day',
							'A name service outage that was repaired in between',
						),
						'hint'        => 'The order of the codes matters as much as the codes.',
						'explanation' => 'It is the signature of a brute-force attempt that finally works: many failures, then a success on the same account. That is the event to alert on.',
					),
					array(
						'question'    => 'What is the timestamp in an access log used for?',
						'choices'     => array(
							'Placing the event in time and linking two sources',
							'Encrypting the content of the log so it cannot be read',
							'Counting the number of unique visitors every day',
							'Making the log file easier to read for a human',
						),
						'hint'        => 'With no time, two events cannot be linked together.',
						'explanation' => 'With no time you cannot correlate two systems, measure a burst, or date the beginning of an intrusion.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * m3-07 — Le reseau qui parle trop (cartographie)
	 * ------------------------------------------------------------------ */
	'm3-07' => array(
		'title'   => 'The network that talks too much',
		'excerpt' => 'One machine, three nodes, open ports. Start by knowing who is in front of you, before touching anything.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Map before you attack',
				'content' => '<p>An open port is a <strong>window</strong>: a service is listening, and that service has possible weaknesses. Mapping means listing the windows.</p><p>The four-step TCP model (6.857):</p><ol><li><strong>SYN</strong>: the client asks to open;</li><li><strong>SYN-ACK</strong>: the server agrees;</li><li><strong>ACK</strong>: the connection is established;</li><li>the data exchange begins.</li></ol><p>A scan sends SYNs across a range of ports: the answers draw the map. A <strong>filtered</strong> port does not answer (closed or blocked), a <strong>closed</strong> port answers "refused", an <strong>open</strong> port answers "open": you tell them apart by the response time.</p><p><strong>Remember:</strong> a service exposed to the Internet is an attack surface. The fix is not to close everything: it is to expose only what is needed, and to know what is exposed.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on the network.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What does an open port reveal?',
						'choices'     => array(
							'That a service is listening and makes up an attack surface',
							'That the machine is offline',
							'That the firewall is switched off',
							'That the service is up to date with its patches',
						),
						'hint'        => 'Think about what you can attempt against that service.',
						'explanation' => 'An open port is a possible way in. It is also a responsibility for the defender.',
					),
					1 => array(
						'question'    => 'Why limit what the server exposes to the Internet?',
						'choices'     => array(
							'To avoid having to update the system',
							'To reduce the attack surface',
							'To save bandwidth',
							'So the site displays faster',
						),
						'hint'        => 'Every open port is an opportunity for an attacker.',
						'explanation' => 'Fewer exposed ports = fewer possibilities. It is the principle of least privilege, applied to the network.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission',
				'content' => '<p><strong>Mission.</strong> You are on the "attacker" machine. The "web" node is reachable: find what it exposes, then fetch the licence key it hands out in an export.</p><p>Hint: a CSV export is a file you can read straight from the browser.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'The licence key found in the export: give it.',
						'hint'        => 'Start by seeing which ports answer on the web node. An export is downloaded over HTTP.',
						'explanation' => 'The web node exposed a CSV export containing the licence keys. The fix: do not serve exports in clear text on a reachable service, and monitor bulk downloads.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-scenario exam',
				'content' => '<p>Five questions, timed. You need 80% to pass.</p>',
				'questions' => array(
					array(
						'question'    => 'What does an open port on a machine actually mean?',
						'choices'     => array(
							'A service listens on that port and accepts the connections',
							'The machine firewall lets every packet through on that port',
							'The port is reserved for administrator accounts only',
							'The port is still waiting for the admin to configure it',
						),
						'hint'        => 'An open port is a possible way in.',
						'explanation' => 'A service listens there and accepts connections: that is an attack surface. Open describes a listener, not a permission.',
					),
					array(
						'question'    => 'What is the idea behind the principle of least privilege?',
						'choices'     => array(
							'Granting only the rights strictly needed for the task',
							'Granting rights to administrator accounts and nobody else',
							'Denying everything by default, then allowing it all by hand',
							'Granting every right so that a user never gets blocked',
						),
						'hint'        => 'Least privilege, in one sentence.',
						'explanation' => 'A limited access means a limited compromise. That holds for an account, for a service, and also for exposed ports.',
					),
					array(
						'question'    => 'Why does a firewall filter by port rather than by application?',
						'choices'     => array(
							'Because the app can listen on a port nobody expected',
							'Because filtering by port uses much less memory',
							'Because applications have no network address of their own',
							'Because no product on the market filters by application',
						),
						'hint'        => 'The application picks its port; it does not declare itself.',
						'explanation' => 'A network firewall sees packets and ports, not applications: an application can listen on any port, 443 included. Application filtering (a WAF) comes on top.',
					),
					array(
						'question'    => 'What does a port scan do, seen from the target machine?',
						'choices'     => array(
							'It sends probes and draws the map of the open services',
							'It copies all the files of the machine to the attacker',
							'It changes the firewall rules to open a passage through',
							'It identifies the person who really administers the machine',
						),
						'hint'        => 'It is a map, not yet an intrusion.',
						'explanation' => 'It sends probes across a range and observes the answers: that is basic mapping, before any exploitation attempt.',
					),
					array(
						'question'    => 'An internal service listens on port 22 and is reachable from the whole network. What should be done?',
						'choices'     => array(
							'Restrict the allowed source, not just change the port',
							'Change port 22 for a high port that nobody can guess',
							'Disable the firewall: the service will restrict itself',
							'Wait: an internal service is never reached by an attacker',
						),
						'hint'        => 'The port is not the door: the allowed source is.',
						'explanation' => 'Moving the port changes nothing for a scan: it finds the service. You restrict the source at the firewall, and require a key rather than a password.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * m3-08 — Traverser le mur (pivot)
	 * ------------------------------------------------------------------ */
	'm3-08' => array(
		'title'   => 'Crossing the wall',
		'excerpt' => 'A compromised server, a reused password, and a node that only listens from inside the network.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: The pivot',
				'content' => '<p>A <strong>pivot</strong> is using a compromised machine to reach a network you cannot reach directly. The attacker does not exploit a flaw: they use legitimate access, the access the compromised machine already has.</p><p>The steps are always the same:</p><ol><li><strong>Reach</strong> a first machine;</li><li><strong>Recover</strong> a credential (a password, a key, a token);</li><li><strong>Re-plant</strong>: use that identity to go further;</li><li><strong>Reach</strong> the final target, which was not reachable before.</li></ol><p>The classic trap: the password of the first machine is <strong>reused</strong> on the second. Teams that forget to change a secret after a compromise remain the first victims.</p><p><strong>Remember:</strong> a reused secret is not a secret: it is a key. Defending also means unifying passwords (a secrets manager) and rotating them.</p><p><strong>In this lab:</strong> the "web" node is not an end. It is a stepping stone. It hosts a monitoring tool ("superviseur-interne") that fetches a page from <em>another host</em> and returns it. That is not a flaw being exploited: it is a business function, used without restriction — and that is very often how pivots happen in real life.</p><p>The "internal" node is on no network your machine can see: only "web" has access to it. Two networks that never meet.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on pivoting.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is a pivot?',
						'choices'     => array(
							'Asking the user for administrator access',
							'Using a compromised machine to reach a network you cannot reach directly',
							'Changing the IP address of your machine',
							'Redirecting one site\'s traffic to another',
						),
						'hint'        => 'The final network was not reachable before.',
						'explanation' => 'A pivot changes your point of view: you use the access you already have to reach what was out of reach.',
					),
					1 => array(
						'question'    => 'Why is password reuse so dangerous?',
						'choices'     => array(
							'Because the browser may save them',
							'Because users mistype them',
							'Because a single compromise opens several doors',
							'Because passwords are often too short',
						),
						'hint'        => 'Think about what you just did in this scenario.',
						'explanation' => 'The impact of a compromise is proportional to the number of systems reachable with the same credentials.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission',
				'content' => '<p><strong>Mission.</strong> The "web" node holds a secret (a password). That secret is also valid on the "internal" node, which only listens from the lab network. Log in and retrieve the archiving flag.</p><p>Hint: the configuration file of the "web" node is in <code>/srv/app/</code>.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'The flag of the internal archiving: give it.',
						'hint'        => 'Three clues: (1) the "web" node lists its pages in robots.txt; (2) its configuration is in /srv/app/app.conf; (3) the "internal" node only listens from the internal network, but the "web" node knows how to reach it.',
						'explanation' => 'The pivot is not an exploit: it is the use of legitimate access (the monitoring tool and the reused service account). The fix: filter the destinations the proxy may reach, never reuse a secret, and actually segment the networks.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-scenario exam',
				'content' => '<p>Five questions, timed. You need 80% to pass.</p>',
				'questions' => array(
					array(
						'question'    => 'What are the two steps of a pivot?',
						'choices'     => array(
							'Reaching a machine, then using its access to go further',
							'Encrypting the files, then sending them out of the network',
							'Scanning the network, then mailing the employees',
							'Hiding the traces, then deleting the machine logs',
						),
						'hint'        => 'Two steps: an access, then the use of that access.',
						'explanation' => 'You compromise a machine, take an access, then use it to reach a target that was not directly reachable.',
					),
					array(
						'question'    => 'Why was the internal node not reachable at the beginning?',
						'choices'     => array(
							'Because it accepts connections from the internal network only',
							'Because it has several addresses on the same network card',
							'Because its web server was stopped during the whole scan',
							'Because the machine was not running while the scan was launched',
						),
						'hint'        => 'It answers once you are already inside.',
						'explanation' => 'Network segmentation limits propagation: the machine only listens from its own segment. A good defence, provided the credentials do not travel.',
					),
					array(
						'question'    => 'A secret was used on a compromised machine. What must be done with it?',
						'choices'     => array(
							'Treat it as stolen and change it everywhere it was used',
							'Keep it: it was never displayed, nobody really saw it there',
							'Move it into a .env file at the root of the project',
							'Forward it to the user who originally chose that secret',
						),
						'hint'        => 'The secret has been exposed: treat it as stolen.',
						'explanation' => 'Treat it as stolen and change it everywhere it was used: a reused secret crosses segments with no effort.',
					),
					array(
						'question'    => 'What does network segmentation do in the face of a compromise?',
						'choices'     => array(
							'It limits the spread from one segment to the others',
							'It increases the bandwidth available between segments',
							'It encrypts every exchange inside the internal network',
							'It removes the need for a firewall between segments',
						),
						'hint'        => 'It contains the impact; it does not cancel it.',
						'explanation' => 'Separate subnets limit propagation. But a reused secret crosses segments with no effort: segmentation is no substitute for rotation.',
					),
					array(
						'question'    => 'Why is a clear-text password in a config so serious during a pivot?',
						'choices'     => array(
							'Because it opens every system that shares it in one go',
							'Because it often holds special characters that are mishandled',
							'Because it slows down the request processing of the application',
							'Because it takes an extra line in the configuration file',
						),
						'hint'        => 'One single secret can open several doors.',
						'explanation' => 'A unique, reused secret is a key that opens several doors: the impact grows from one machine to the whole estate.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * m3-09 — Le binaire qui obeit trop (debordement de tampon)
	 * ------------------------------------------------------------------ */
	'm3-09' => array(
		'title'   => 'The binary that obeys too well',
		'excerpt' => 'A local program writes too fast. The stack does not forgive.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: The stack, the buffer, and the four defences',
				'content' => '<p>A program reserves some memory (the <strong>buffer</strong>) to write what the user types into. If the input is longer than the space reserved, it <strong>overwrites what comes next</strong>: the local variables, then the return address of the function. Rewriting that address is how you redirect the program towards code of your choosing.</p><p>Four defences combine (6.858):</p><ul><li><strong>NX</strong> (No-eXecute): the stack is not executable, so you cannot place code there and must reuse existing code (ROP).</li><li><strong>ASLR</strong>: addresses are randomised on each run, so you cannot guess where the code and the stack are.</li><li><strong>Canary</strong> (stack cookie): a sentinel value placed between the buffer and the return address; if it changes, the program stops before returning.</li><li><strong>PIE / RELRO</strong>: randomisation of the binary itself, and protections for the GOT.</li></ul><p><strong>Remember:</strong> no single defence is enough; it is their <em>combination</em> that makes exploitation expensive. And the best answer is still not to write without checking the length.</p><p><strong>One detail that changes everything:</strong> here, no privilege is involved. The program runs with your rights, full stop. What you are attacking is the <em>control flow</em>: the program contains an administration function it never calls, and a buffer overflow is enough to send it there. Hold on to the distinction, it is decisive in analysis: <strong>raising your privileges</strong> and <strong>redirecting a program</strong> are two different goals. The second needs no special rights — which is exactly what makes it so common in software that reads files.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on memory.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What happens when a program writes more than the buffer size?',
						'choices'     => array(
							'The extra characters are ignored',
							'Memory is extended automatically',
							'It overwrites the neighbouring memory, including the return address',
							'The program stops with an error',
						),
						'hint'        => 'The buffer sits on the stack, and the return address is right after it.',
						'explanation' => 'That is the whole idea of a buffer overflow: overwriting the return address redirects execution.',
					),
					1 => array(
						'question'    => 'What is the canary for?',
						'choices'     => array(
							'To forbid any write to the stack',
							'To encrypt the content of the stack',
							'To make the binary impossible to decompile',
							'To detect stack corruption before the return',
						),
						'hint'        => 'It blocks nothing: it reports.',
						'explanation' => 'The canary does not prevent the write; it detects that it happened and terminates the program on return, without letting the attacker control execution.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission',
				'content' => '<p><strong>Mission.</strong> A vulnerable binary sits in <code>/home/ctf/</code>. It waits for input and copies it into a buffer that is too small. Overflow that buffer to redirect its execution towards the administration function: it will print the flag on your standard output. No privilege is needed — and no file contains the flag in clear text.</p><p>Hint: the incident ticket says what the program expects.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'The flag printed by the redirected program: give it.',
						'hint'        => 'The order book (/home/ctf/vulnerable) reads your input without checking its length. Look for the administration function with "nm", then overwrite the return address with its address (the binary is not PIE, so it does not move).',
						'explanation' => 'The overflow overwrote the return address and redirected execution towards the administration function, which printed the flag. No privilege was raised: everything happened in the control flow. Defences: check lengths, compile with the defences (canary, NX, PIE, RELRO), and above all never leave a sensitive function reachable from a program that reads untrusted data.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-scenario exam',
				'content' => '<p>Five questions, timed. You need 80% to pass.</p>',
				'questions' => array(
					array(
						'question'    => 'What does the NX defence actually block?',
						'choices'     => array(
							'Running code that was dropped into the stack memory',
							'Reading the binary file by a user who is not allowed to',
							'Using several threads inside the same process',
							'Running a code dropped into the system call stack',
						),
						'hint'        => 'NX makes the stack non-executable.',
						'explanation' => 'NX marks the stack non-executable: you can write there, but not run code from it. The attacker therefore has to reuse code that is already present.',
					),
					array(
						'question'    => 'What does ASLR do to a program on every run?',
						'choices'     => array(
							'It randomises the addresses of the loaded memory areas',
							'It encrypts the binary inside the executable file on disk',
							'It checks the integrity of the binary before loading it',
							'It forbids running a binary that has not been signed',
						),
						'hint'        => 'ASLR: random addresses on every launch.',
						'explanation' => 'ASLR randomises the stack, the libraries and the binary: addresses can no longer be guessed. It checks nothing and signs nothing.',
					),
					array(
						'question'    => 'What do you gain by compiling with canary, NX and PIE enabled?',
						'choices'     => array(
							'Exploiting it becomes much harder, but the flaw is still there',
							'The vulnerable code disappears from the binary at build time',
							'The program runs faster because the source code gets checked',
							'The source code becomes shorter and far easier to review and audit',
						),
						'hint'        => 'Compiler options hinder exploitation; they do not fix code.',
						'explanation' => 'Beware of false security: the buffer overflow is still in the code. A canary, NX and PIE make it hard to exploit, they do not remove it.',
					),
					array(
						'question'    => 'What is the strongest defence against a buffer overflow?',
						'choices'     => array(
							'Checking the available size before every single write',
							'Moving the buffer into the global memory of the program',
							'Enabling ASLR on the machine that runs the program',
							'Compiling the program with the NX bit option enabled',
						),
						'hint'        => 'The ultimate defence is in the code, not in compiler options.',
						'explanation' => 'The ultimate defence is in the code: check the length before writing. ASLR, NX and canaries are the second line, when the code was never fixed.',
					),
					array(
						'question'    => 'What is a technique that reuses code already present in the binary called?',
						'choices'     => array(
							'ROP (Return-Oriented Programming), a chain of gadgets',
							'Integer overflow, which overflows a numeric variable',
							'Shellcode injection straight into the executable stack',
							'GOT table hijacking, to point an entry at the heap',
						),
						'hint'        => 'It reuses existing code: the name starts with R.',
						'explanation' => 'With NX on, code can no longer be injected: existing code fragments (gadgets) are chained to build the system call. That is ROP.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * m3-10 — Le certificat qui ne prouve rien (TLS)
	 * ------------------------------------------------------------------ */
	'm3-10' => array(
		'title'   => 'The certificate that proves nothing',
		'excerpt' => 'The padlock on the connection. Look very closely at what it says, and at what it does not say.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Encrypting, yes — proving, no',
				'content' => '<p>The TLS protocol brings two things:</p><ul><li><strong>confidentiality</strong>: what travels is encrypted, a third party cannot read it;</li><li><strong>authentication</strong>: the server proves who it is.</li></ul><p>That proof rests on a <strong>certificate</strong>, signed by an authority the browser already trusts. If the certificate is <strong>self-signed</strong> (signed by itself), the browser can only say: "I know no authority that confirms this identity" — and it must then ask you to accept the exception. A badly configured certificate = no guarantee of identity at all.</p><p>TLS has its weak spot too: <strong>server names (SNI)</strong> let one server offer several certificates depending on the requested name. That is the basis of "virtual name" hosting — and a mechanism that load-balancing environments have to watch.</p><p><strong>Remember:</strong> "the padlock is closed" does not mean "I know who I am talking to". Encryption and identity are two separate things.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on TLS.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What does TLS encryption guarantee?',
						'choices'     => array(
							'The identity of the server, not confidentiality',
							'The integrity of the server files',
							'The availability of the service',
							'The confidentiality of the data, not the identity of the server',
						),
						'hint'        => 'Two distinct functions.',
						'explanation' => 'Encryption hides the content; authentication (the certificate) proves the identity. Both are needed, and they are separate.',
					),
					1 => array(
						'question'    => 'What does a self-signed certificate signal?',
						'choices'     => array(
							'That no independent authority confirmed the identity of the server',
							'That the certificate has expired',
							'That the encryption used is too weak',
							'That the server does not support TLS 1.3',
						),
						'hint'        => 'Who signed it? Is that someone independent?',
						'explanation' => 'Self-signed = the proof comes from the server itself, so it is worth nothing. You need a chain of trust (an authority) or, for an internal service, a company PKI.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission',
				'content' => '<p><strong>Mission.</strong> The application listens over HTTPS on port 8443. Open the TLS connection, examine the certificate (who signed it? for which name?), then find the page reserved for the secure connection and report the key it contains.</p><p>Hint: that page only exists over HTTPS — over plain HTTP it answers "page not found".</p>',
				'questions' => array(
					0 => array(
						'question'    => 'The distribution key found over HTTPS: give it.',
						'hint'        => 'First look at the certificate with openssl, then try to read the reserved page over https (and over http to compare).',
						'explanation' => 'The certificate was self-signed: the encryption was fine, the identity was not. The fix: a certificate signed by an authority (or an internal PKI), with monitoring of the TLS configuration and of SNI.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-scenario exam',
				'content' => '<p>Five questions, timed. You need 80% to pass.</p>',
				'questions' => array(
					array(
						'question'    => 'What is SNI (Server Name Indication)?',
						'choices'     => array(
							'A field that picks the certificate according to the asked name',
							'A mechanism that encrypts the domain name inside the certificate',
							'A header that signs the connection on the browser side first',
							'The automatic renewal of the certificates nearing expiry',
						),
						'hint'        => 'The server offers a different certificate depending on the name.',
						'explanation' => 'SNI lets a server present a different certificate per name: essential for shared hosting, and visible in the traffic.',
					),
					array(
						'question'    => 'Why does the browser reject a self-signed certificate?',
						'choices'     => array(
							'Because no trusted authority has signed it at all',
							'Because the certificate is too large for the browser',
							'Because the private key involved is usually too short',
							'Because the browser only accepts TLS version 3',
						),
						'hint'        => 'The browser looks for a chain of trust to a known authority.',
						'explanation' => 'The chain of trust stops at the certificate: the browser does not know the authority that signed it, so it cannot vouch for the identity.',
					),
					array(
						'question'    => 'With the padlock displayed, what can you say about the server?',
						'choices'     => array(
							'It is encrypted, but not necessarily who it really is',
							'It uses the most recent version of the TLS protocol',
							'It is trustworthy and has no known flaw at all today',
							'It has passed every one of the security tests with success',
						),
						'hint'        => 'The padlock is about encryption, not about identity.',
						'explanation' => 'You know the channel is confidential. If the authority is doubtful, or the name does not match, you know nothing about the real identity.',
					),
					array(
						'question'    => 'What is the point of HSTS?',
						'choices'     => array(
							'Forcing the browser to use only HTTPS for that site',
							'Forbidding the use of weak passwords on that site',
							'Signing the certificates of the site automatically',
							'Encrypting the page content before sending it out to clients',
						),
						'hint'        => 'HTTP Strict Transport Security: the browser refuses HTTP.',
						'explanation' => 'HSTS forbids falling back to HTTP: the attacker can no longer force a clear-text connection. It encrypts nothing itself and signs nothing.',
					),
					array(
						'question'    => 'In an internal service, how do you guarantee a server\'s identity?',
						'choices'     => array(
							'With an internal authority and certificates it has issued',
							'By disabling the certificate checks on the client side',
							'By accepting any self-signed certificate on the network',
							'By using the plain HTTP protocol inside the isolated network',
						),
						'hint'        => 'You need an authority that the machines trust.',
						'explanation' => 'You deploy your own internal certificate authority: the machines trust it, and each service gets a certificate it issued. Disabling the check amounts to removing identity.',
					),
				),
			),
		),
	),

);
