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
				'content' => '<p>Five timed questions. 60% is enough.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the main risk of a secret in clear text in a file?',
						'choices'     => array(
							'That it slows the application down at load time',
							'That it takes up one line too many in the file',
							'That it expires after a few days',
							'That it is readable by whoever holds the file',
						),
						'hint'        => 'Keep the secret apart from the application.',
						'explanation' => 'Protecting a secret rests on controlling access to the file it sits in.',
					),
					1 => array(
						'question'    => 'Must a secret found in clear text be changed?',
						'choices'     => array(
							'Yes, always',
							'No, as long as the server stays internal',
							'Only if the file was published on the Internet',
							'Only if an administrator reported it',
						),
						'hint'        => 'Assume the secret has been seen: treat it as stolen.',
						'explanation' => 'Yes: if it was in clear text, assume it may have been read, and change it.',
					),
					2 => array(
						'question'    => 'What does a diagnostic page (status.php) let you do?',
						'choices'     => array(
							'Reset the database',
							'Locate where the application information lives',
							'Change the application configuration remotely',
							'Restart the web service',
						),
						'hint'        => 'A diagnostic page observes; it does not command.',
						'explanation' => 'It hands out paths: an immense help… and an entry point for an attacker.',
					),
					3 => array(
						'question'    => 'Where does an application password go in a clean architecture?',
						'choices'     => array(
							'In the server startup log',
							'In a comment inside the configuration file',
							'In a secrets vault',
							'In a clear-text .env file next to the code',
						),
						'hint'        => 'The secret must be injected at startup.',
						'explanation' => 'A secrets vault, environment variables injected at startup, or a secrets service: the secret is no longer on a readable disk.',
					),
					4 => array(
						'question'    => 'Why is a secret copied into several files dangerous?',
						'choices'     => array(
							'Because the application starts more slowly',
							'Because the files can no longer be compared',
							'Because you have to redeploy on every secret change',
							'Because it has to be changed everywhere',
						),
						'hint'        => 'Every copy is one more door.',
						'explanation' => 'Every copy is a leak point and a forgotten rotation: the secret gets changed in one place only.',
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
				'content' => '<p>Five timed questions. 60% is enough.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Where does the code of a script injection run?',
						'choices'     => array(
							'In the visitor\'s browser',
							'In the web server, with the service rights',
							'In the database',
							'In the administrator\'s terminal',
						),
						'hint'        => 'Who executes the code you inject?',
						'explanation' => 'In the visitor\'s browser: the server sends text, the browser executes it.',
					),
					1 => array(
						'question'    => 'Why is a reflected injection dangerous in a company?',
						'choices'     => array(
							'Because it deletes the visitor\'s cookies',
							'Because a trusted visitor (an admin) can trigger it',
							'Because it floods the server with requests',
							'Because it makes the site slower for everyone',
						),
						'hint'        => 'Think about who opens that page at work.',
						'explanation' => 'The impact depends on the victim. Targeting an administrator turns a harmless flaw into a takeover.',
					),
					2 => array(
						'question'    => 'What does "escaping the output" actually do?',
						'choices'     => array(
							'Replaces dangerous words with asterisks',
							'Blocks the request if it contains a tag',
							'Converts special characters so they are no longer interpreted',
							'Removes every < and > character from the text',
						),
						'hint'        => 'You do not delete the content: you change its meaning.',
						'explanation' => 'You turn <code>&lt;</code>, <code>&gt;</code>, <code>&amp;</code>, <code>"</code> into HTML entities: the browser displays them instead of executing them.',
					),
					3 => array(
						'question'    => 'Is a filter that blocks the word "script" enough?',
						'choices'     => array(
							'Yes, if the filter runs on every page',
							'Yes, if the page encoding is UTF-8',
							'Yes, except on login pages',
							'No, it can always be bypassed',
						),
						'hint'        => 'A filter is bypassed with a variant.',
						'explanation' => 'No: "scr<script>ipt" or an event attribute walk straight past it. You have to escape, not filter.',
					),
					4 => array(
						'question'    => 'What is a CSP?',
						'choices'     => array(
							'A header that tells the browser what it is allowed to load',
							'A firewall installed in the browser',
							'A rule that forbids robots from visiting the page',
							'The administrator account password',
						),
						'hint'        => 'It is a header the server sends to the browser.',
						'explanation' => 'Content-Security-Policy: even if a script slips in, the browser refuses to load undeclared sources. It is defence in depth.',
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
				'content' => '<p>Five timed questions. 60% is enough.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the fix against SQL injection?',
						'choices'     => array(
							'Using HTTPS',
							'Prepared queries',
							'Filtering the apostrophe in the form',
							'Caching the pages',
						),
						'hint'        => 'The fix lives in the code, not in the filter.',
						'explanation' => 'Prepared queries: the structure is fixed, the data can no longer change it.',
					),
					1 => array(
						'question'    => 'Why must passwords be hashed in the database?',
						'choices'     => array(
							'So the credentials are shorter',
							'So the login is faster',
							'So that a database leak does not hand over the passwords',
							'So the database takes less space',
						),
						'hint'        => 'Think of the worst case: the database is stolen.',
						'explanation' => 'If the database is stolen, a hashed (salted) password does not open the accounts.',
					),
					2 => array(
						'question'    => 'What does a SQL comment (<code>--</code>) do in a payload?',
						'choices'     => array(
							'It makes the query slower',
							'It deletes the targeted table',
							'It blocks the connection to the server',
							'It neutralises the end of the query',
						),
						'hint'        => 'It is there to ignore the rest of the query.',
						'explanation' => 'It ignores the rest of the query: the password condition disappears and the login goes through.',
					),
					3 => array(
						'question'    => 'Is a filter that rejects the apostrophe a sufficient fix?',
						'choices'     => array(
							'No, it can be bypassed',
							'Yes, if the filter runs on every input',
							'Yes, because the apostrophe is the only dangerous character',
							'Yes, if the database uses UTF-8 encoding',
						),
						'hint'        => 'A filter works on text; the attack works on structure.',
						'explanation' => 'It can be bypassed (encodings, other engines, other techniques). The only durable fix is the prepared query.',
					),
					4 => array(
						'question'    => 'Why is the "secrets" table a favourite target?',
						'choices'     => array(
							'Because its name is easy to guess',
							'Because it holds what must not be lost',
							'Because it holds the largest number of rows',
							'Because it is the only table that can be modified',
						),
						'hint'        => 'Every table is reachable; this one costs more.',
						'explanation' => 'A SQL injection does not stop at the accounts: it reaches every table. So you segment, and you limit the privileges of the application account.',
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
				'content' => '<p>Four timed questions. 60% is enough.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is a directory traversal?',
						'choices'     => array(
							'Copying a file to another folder',
							'Listing the files present in a folder',
							'Forcing a path out of the allowed folder',
							'Moving from one folder to another in the tree',
						),
						'hint'        => 'It is stepping out of the intended frame.',
						'explanation' => 'You force the path out of the intended folder to read a file that was not exposed.',
					),
					1 => array(
						'question'    => 'Which check holds against every variant?',
						'choices'     => array(
							'Blocking the string "../" in the input',
							'Checking that the name contains no slash',
							'Rejecting requests containing "%2e%2e"',
							'Resolving the path, then checking it stays inside the folder',
						),
						'hint'        => 'The only solid check is on the resolved path.',
						'explanation' => 'The check runs on the resolved path (realpath): if it overflows, you refuse.',
					),
					2 => array(
						'question'    => 'What should be done with backups sitting in the web-served folder?',
						'choices'     => array(
							'Move them out of the web server',
							'Encrypt them with a password',
							'Rename them to .bak',
							'Protect them with HTTP authentication',
						),
						'hint'        => 'If the web server can read them, so can the attacker.',
						'explanation' => 'A backup has no business on a web server. Move it out of the served folder, and encrypt it at rest.',
					),
					3 => array(
						'question'    => 'Why is a robots.txt file useful to an attacker?',
						'choices'     => array(
							'It forces search engines to stop',
							'It lists the paths not to visit… so the paths to visit',
							'It lets you disable the site firewall',
							'It holds the administration password',
						),
						'hint'        => 'That file is meant to tell the world what exists.',
						'explanation' => 'A robots.txt lists sensitive paths: it is a map for the attacker (and a reminder for the defender to check what is exposed).',
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
				'content' => '<p>Four timed questions. 60% is enough.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What does HTTP response code 401 mean?',
						'choices'     => array(
							'Request processed successfully',
							'Resource not found',
							'The server changed version',
							'Access refused (not authenticated)',
						),
						'hint'        => 'The name says it: Unauthorized.',
						'explanation' => '401: authentication required and not provided properly. 403: authenticated but not authorised.',
					),
					1 => array(
						'question'    => 'Why is a secret in a URL a bad idea?',
						'choices'     => array(
							'Because it ends up in logs and history',
							'Because URLs are not encrypted under HTTPS',
							'Because a URL is too short for a secret',
							'Because the browser blocks long URLs',
						),
						'hint'        => 'Think of everything that keeps a copy of the URL.',
						'explanation' => 'URLs are logged by the server, by proxies and by the browser. A secret has no business in one.',
					),
					2 => array(
						'question'    => 'What does a burst of 401 followed by a 200 indicate?',
						'choices'     => array(
							'A successful port scan',
							'A login that succeeded after several failures',
							'A server that changed version',
							'A DNS service outage',
						),
						'hint'        => 'The order of the codes matters as much as the codes.',
						'explanation' => 'It is the signature of a brute-force attempt that finally succeeded: that is the event to alert on.',
					),
					3 => array(
						'question'    => 'What is the point of a timestamp in a log?',
						'choices'     => array(
							'Encrypting the log content',
							'Counting the number of events per day',
							'Placing the event in time',
							'Making the log file more readable',
						),
						'hint'        => 'Without a time, you cannot tie two events together.',
						'explanation' => 'Without a time you can neither correlate with another system, nor measure a burst, nor date the intrusion.',
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
				'content' => '<p>Four timed questions. 60% is enough.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What does an "open" port mean?',
						'choices'     => array(
							'A service is listening on it',
							'The port is blocked by the firewall',
							'The port is reserved for administrators',
							'The port is waiting for configuration',
						),
						'hint'        => 'An open port is a possible way in.',
						'explanation' => 'A service listens there and accepts connections: that is an attack surface.',
					),
					1 => array(
						'question'    => 'What is the idea behind least privilege?',
						'choices'     => array(
							'Grant rights only to administrators',
							'Grant only the rights that are needed',
							'Refuse all access to the default user',
							'Give every right to avoid blockages',
						),
						'hint'        => 'Least privilege, in one sentence.',
						'explanation' => 'Limited access = limited compromise. The same holds for exposed ports.',
					),
					2 => array(
						'question'    => 'Why does a firewall filter ports rather than applications?',
						'choices'     => array(
							'Because an application can listen on any port',
							'Because port filtering is faster',
							'Because it is simple and robust to put in place',
							'Because ports are easier to configure',
						),
						'hint'        => 'Per-application filtering is not available everywhere.',
						'explanation' => 'Port filtering is simple and effective at scale; application filtering (a WAF) comes on top.',
					),
					3 => array(
						'question'    => 'What does a port scan do?',
						'choices'     => array(
							'It copies the files of the machine',
							'It modifies the firewall rules',
							'It identifies the human owner of a machine',
							'It draws the map of the listening services',
						),
						'hint'        => 'It is mapping, not intrusion.',
						'explanation' => 'It sends probes across a range and watches the answers: that is basic reconnaissance.',
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
				'content' => '<p>Five timed questions. 60% is enough.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What are the two steps of a pivot?',
						'choices'     => array(
							'Encrypt your files, then send them outside',
							'Reach a machine, then use its access to go further',
							'Scan the network, then send e-mails',
							'Hide your traces, then delete the logs',
						),
						'hint'        => 'Two steps: an access, then a use of that access.',
						'explanation' => 'Compromise a machine, recover an access, then use it to reach a target that was not directly reachable.',
					),
					1 => array(
						'question'    => 'Why was the internal node not reachable at first?',
						'choices'     => array(
							'Because it had more IP addresses',
							'Because its web server was down',
							'Because it only listens from the internal network',
							'Because it was not started',
						),
						'hint'        => 'It answers once you are already inside.',
						'explanation' => 'Network segmentation limits propagation: a good defence… provided credentials do not travel across it.',
					),
					2 => array(
						'question'    => 'What must be done with a secret after a compromise?',
						'choices'     => array(
							'Keep it: it has already been changed',
							'Put it in a .env file',
							'Hand it to the user who used it',
							'Change it',
						),
						'hint'        => 'The secret was exposed: treat it as stolen.',
						'explanation' => 'Treat it as stolen and change it everywhere it was used.',
					),
					3 => array(
						'question'    => 'What does network segmentation do?',
						'choices'     => array(
							'It limits the spread of a compromise',
							'It increases network bandwidth',
							'It encrypts every exchange on the network',
							'It removes the need for a firewall',
						),
						'hint'        => 'It contains the impact; it does not cancel it.',
						'explanation' => 'Separate subnets limit propagation. But a reused secret crosses segments without effort.',
					),
					4 => array(
						'question'    => 'Why is a clear-text password in a configuration especially serious during a pivot?',
						'choices'     => array(
							'Because it is written with special characters',
							'Because it gives direct access to every system that uses it',
							'Because it slows request processing',
							'Because it takes up a line in the file',
						),
						'hint'        => 'One secret can open several doors.',
						'explanation' => 'A single reused secret is a key that opens several doors: the impact explodes.',
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
				'content' => '<p>Five timed questions. 60% is enough.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What does the NX defence block?',
						'choices'     => array(
							'Reading the binary file',
							'The use of threads',
							'Executing code on the stack',
							'Executing code on the heap',
						),
						'hint'        => 'NX makes the stack non-executable.',
						'explanation' => 'NX marks the stack non-executable: you cannot write code there and run it directly.',
					),
					1 => array(
						'question'    => 'What does ASLR do?',
						'choices'     => array(
							'It encrypts the binary inside the executable file',
							'It checks the integrity of the binary at startup',
							'It forbids running an unsigned binary',
							'It randomises addresses on each run',
						),
						'hint'        => 'ASLR = random addresses.',
						'explanation' => 'ASLR randomises the stack, the libraries and the heap: the addresses can no longer be guessed.',
					),
					2 => array(
						'question'    => 'What do you gain by enabling the defences (canary, NX, PIE) at compile time?',
						'choices'     => array(
							'Because the vulnerable code disappears at compile time',
							'The binary runs faster',
							'The source code gets shorter',
							'Errors are caught at run time',
						),
						'hint'        => 'Compiler flags change the code that is produced.',
						'explanation' => 'The flags (-fstack-protector-strong, -fPIE, RELRO) change the code that is produced: the flaw does not vanish, but using it becomes far more expensive.',
					),
					3 => array(
						'question'    => 'What is the most effective defence against a buffer overflow?',
						'choices'     => array(
							'Move the buffer to global memory',
							'Check the length before writing',
							'Enable ASLR',
							'Compile with the NX bit',
						),
						'hint'        => 'The ultimate fix is in the code, not in the options.',
						'explanation' => 'The ultimate fix is in the code: check the length before writing. System defences are the second line.',
					),
					4 => array(
						'question'    => 'What is a technique called that reuses pieces of code already present in the binary?',
						'choices'     => array(
							'Overwriting the GOT',
							'Integer overflow',
							'Return-oriented programming (ROP)',
							'Injecting shellcode into the stack',
						),
						'hint'        => 'You reuse existing code: the word starts with R.',
						'explanation' => 'With NX active you cannot inject code: you reuse existing fragments (gadgets) to build the system call.',
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
				'content' => '<p>Five timed questions. 60% is enough.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is SNI?',
						'choices'     => array(
							'A mechanism that encrypts the domain name',
							'A header the browser sends to sign the connection',
							'Automatic certificate renewal',
							'The mechanism that offers a certificate depending on the requested name',
						),
						'hint'        => 'The server offers a different certificate depending on the name asked for.',
						'explanation' => 'SNI (Server Name Indication) lets a server offer a different certificate per name: essential for shared hosting, and worth watching closely.',
					),
					1 => array(
						'question'    => 'Why does the browser reject a self-signed certificate?',
						'choices'     => array(
							'Because no trusted authority signed it',
							'Because the certificate is too large',
							'Because the private key is too short',
							'Because the browser requires TLS version 3',
						),
						'hint'        => 'The browser is looking for a chain of trust.',
						'explanation' => 'The chain of trust: the browser does not know that signature, so it cannot vouch for the identity.',
					),
					2 => array(
						'question'    => 'The browser padlock is green. What can you say about the server?',
						'choices'     => array(
							'That it uses the most recent TLS version',
							'That it is encrypted, but not necessarily who it is',
							'That it is trustworthy and flawless',
							'That it passed every security test',
						),
						'hint'        => 'The padlock speaks about encryption, not identity.',
						'explanation' => 'You know the channel is confidential. If the authority is doubtful, you know nothing about the identity.',
					),
					3 => array(
						'question'    => 'What is HSTS for?',
						'choices'     => array(
							'Forbidding weak passwords',
							'Signing certificates automatically',
							'Forcing the browser to use HTTPS only',
							'Encrypting page content',
						),
						'hint'        => 'The three letters stand for: Strict Transport Security.',
						'explanation' => 'HSTS (HTTP Strict Transport Security) forbids fallback to HTTP: the attacker can no longer force a clear-text connection.',
					),
					4 => array(
						'question'    => 'In an internal service, how do you guarantee the identity of the server?',
						'choices'     => array(
							'By disabling certificate verification',
							'By accepting any self-signed certificate',
							'By using plain HTTP internally',
							'With an internal authority (a PKI) and certificates it issues',
						),
						'hint'        => 'You need an authority the machines trust.',
						'explanation' => 'You deploy your own internal certificate authority: the machines trust it, and each service holds a certificate it issued.',
					),
				),
			),
		),
	),

);
