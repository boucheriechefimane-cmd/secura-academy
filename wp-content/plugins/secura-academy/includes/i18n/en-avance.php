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

	/* ---------------------------------------------------------------------
	 * avance-03 — Ceinture blanche
	 * ------------------------------------------------------------------ */
	'avance-03' => array(
		'title'   => 'White belt: read, search, understand',
		'excerpt' => 'Four challenges to learn how to look at a file and find what you are looking for.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — the white belt',
				'content' => '<p>The first belt is the belt of observation. No complicated technique: just learning to look at a file, to go through it, and to spot a value in it.</p><p>What you will learn:</p><ul><li><code>cat</code> — the whole file, at once;</li><li><code>ls -a</code> — including what is <em>hidden</em> (the leading dot);</li><li><code>grep</code> — find a line containing a word;</li><li><code>head</code> and <code>tail</code> — the beginning and the end.</li></ul><p><strong>Remember:</strong> before asking "how do I hack this?", ask "what exactly is in that file?". Most of the time the answer is already there, in plain text.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on the tools of this belt.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Which command displays the whole content of a file?',
						'choices'     => array(
							'ls',
							'cd',
							'cat',
							'ps',
						),
						'hint'        => 'One command reads, another lists.',
						'explanation' => '<code>cat</code> displays the content. <code>ls</code> lists files, <code>cd</code> changes directory, <code>ps</code> lists processes. Classic confusion: the tool of the day is not always the tool of the moment.',
					),
					1 => array(
						'question'    => 'Why use `ls -a` rather than `ls`?',
						'choices'     => array(
							'To get file sizes',
							'To sort by date',
							'To list folders only',
							'To also see hidden files (those starting with a dot)',
						),
						'hint'        => 'What could `ls` be missing?',
						'explanation' => 'Hidden files start with a dot. <code>ls</code> skips them; <code>ls -a</code> shows them. That is where "secret" configuration files hide — and sometimes the flags.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the four challenges of the belt',
				'content' => '<p>The dojo is deployed on your machine. The four challenges of the <strong>white</strong> belt are in:</p><ul><li><strong>The first file</strong> — The report file of the first challenge. (<code>/srv/dojo/1-blanche/01-premier-fichier.txt</code>)</li><li><strong>The hidden folder</strong> — A file starts with a dot: simple tools do not see it. (<code>/srv/dojo/1-blanche/02-dossier-cache.txt</code>)</li><li><strong>The word in the text</strong> — One line contains a specific word: you have to find it. (<code>/srv/dojo/1-blanche/03-mot-dans-le-texte.txt</code>)</li><li><strong>The first and last lines</strong> — The start and the end of the file are often where the information is. (<code>/srv/dojo/1-blanche/04-extremites.txt</code>)</li></ul><p><strong>Mission.</strong> Open each document, note the report value (the line <code>... = FLAG=SECURA{...}</code>), and answer the four questions. The server compares each answer with the flag it keeps in root.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the value of the "The first file" challenge (d01).',
						'hint'        => 'The white belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
					1 => array(
						'question'    => 'Note the value of the "The hidden folder" challenge (d02).',
						'hint'        => 'The white belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
					2 => array(
						'question'    => 'Note the value of the "The word in the text" challenge (d03).',
						'hint'        => 'The white belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
					3 => array(
						'question'    => 'Note the value of the "The first and last lines" challenge (d04).',
						'hint'        => 'The white belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Three questions on this belt. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'You are looking for a line containing "session". Which command is made for that?',
						'choices'     => array(
							'chmod',
							'kill',
							'tar',
							'grep',
						),
						'hint'        => 'A text search command.',
						'explanation' => '<code>grep</code> filters the lines containing a pattern. <code>chmod</code> changes permissions, <code>kill</code> stops a process, <code>tar</code> archives files. Remember the family: <code>grep</code> = search text.',
					),
					1 => array(
						'question'    => 'A file is called `.secret`. Which simple command does not show it?',
						'choices'     => array(
							'ls',
							'ls -a',
							'cat .secret',
							'find .',
						),
						'hint'        => 'The leading dot changes everything.',
						'explanation' => 'That is exactly the trap of challenge 2: <code>ls</code> without an option ignores hidden files. <code>ls -a</code> shows them, and <code>cat .secret</code> reads that one.',
					),
					2 => array(
						'question'    => 'You want the last line of a long log file. You use?',
						'choices'     => array(
							'head -1',
							'tail -1',
							'grep -c',
							'wc -l',
						),
						'hint'        => 'The end of the file.',
						'explanation' => '<code>tail</code> shows the end, <code>head</code> the beginning. For a log, the last line is often the most recent: that is where the interesting event is.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * avance-04 — Ceinture jaune
	 * ------------------------------------------------------------------ */
	'avance-04' => array(
		'title'   => 'Yellow belt: permissions, owner, content',
		'excerpt' => 'When the system says no: who owns the file, what its permissions are, and what it really contains.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — the yellow belt',
				'content' => '<p>The yellow belt is the moment when the simple tool is no longer enough. The file is there, but something blocks you: <strong>permissions</strong>, an <strong>owner</strong> other than you, content you only see in part.</p><p>What you will learn:</p><ul><li><code>ls -l</code> — permissions, owner, group, size;</li><li><code>stat</code> — the details of a file (type, size, permissions);</li><li><code>grep -n</code> — the <em>number</em> of the line containing the word;</li><li><code>wc</code> — count lines, words or bytes.</li></ul><p><strong>Remember:</strong> a file you cannot read is not necessarily absent. It may be protected: and there the right question is not "how do I read it?" but "<em>who</em> reads it, and why them?".</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on the tools of this belt.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'In `ls -l`, what does the string `-rwxr-xr-x` mean?',
						'choices'     => array(
							'The file is read-only for everyone',
							'The file belongs to the root group',
							'The file is a folder',
							'The owner can read, write and execute; the others can read and execute',
						),
						'hint'        => 'Three groups of three letters: owner, group, others.',
						'explanation' => 'The first triplet is the owner, the second the group, the third the others. <code>rwx</code> = read, write, execute. <code>-rwxr-xr-x</code>: the owner has every right, the group and the others only read and execute.',
					),
					1 => array(
						'question'    => 'What does `grep -n` do in addition to `grep`?',
						'choices'     => array(
							'It displays the line number of each result',
							'It ignores case',
							'It counts the results',
							'It searches in subfolders',
						),
						'hint'        => 'The "n" stands for number.',
						'explanation' => '<code>-n</code> displays the line number: handy to locate an item in a long file. <code>-i</code> ignores case, <code>-c</code> counts, <code>-r</code> descends into folders.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the four challenges of the belt',
				'content' => '<p>The dojo is deployed on your machine. The four challenges of the <strong>yellow</strong> belt are in:</p><ul><li><strong>The protected file</strong> — A file\'s permissions can be read at a glance with `ls -l`. (<code>/srv/dojo/2-jaune/05-fichier-protege.txt</code>)</li><li><strong>The real owner\'s folder</strong> — A file\'s owner is not necessarily you. (<code>/srv/dojo/2-jaune/06-proprietaire.txt</code>)</li><li><strong>The hidden line</strong> — A line hidden in the middle: `grep -n` gives its number. (<code>/srv/dojo/2-jaune/07-ligne-cachee.txt</code>)</li><li><strong>The character count</strong> — Counting what is in a file is sometimes the answer. (<code>/srv/dojo/2-jaune/08-taille.txt</code>)</li></ul><p><strong>Mission.</strong> Open each document, note the report value (the line <code>... = FLAG=SECURA{...}</code>), and answer the four questions. The server compares each answer with the flag it keeps in root.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the value of the "The protected file" challenge (d05).',
						'hint'        => 'The yellow belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
					1 => array(
						'question'    => 'Note the value of the "The real owner\'s folder" challenge (d06).',
						'hint'        => 'The yellow belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
					2 => array(
						'question'    => 'Note the value of the "The hidden line" challenge (d07).',
						'hint'        => 'The yellow belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
					3 => array(
						'question'    => 'Note the value of the "The character count" challenge (d08).',
						'hint'        => 'The yellow belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Three questions on this belt. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'You see `-rw-------` on a file. Who can read it?',
						'choices'     => array(
							'The owner only',
							'Everyone',
							'The file\'s group',
							'Nobody, not even the owner',
						),
						'hint'        => 'Six dashes or six letters: what is left for the owner?',
						'explanation' => 'The first three signs concern the owner: <code>-rw-</code> means read and write for them, and nothing for the group or the others. That is the typical mode of a secret file.',
					),
					1 => array(
						'question'    => 'What is the point of `stat` compared with `ls -l`?',
						'choices'     => array(
							'It changes the permissions',
							'It gives finer details (type, inode, timestamps)',
							'It copies the file',
							'It opens the file in an editor',
						),
						'hint'        => 'It is the detailed version of the inspection.',
						'explanation' => '<code>stat</code> displays the inode, the exact type (file, folder, link), the size and the dates. <code>ls -l</code> gives the condensed view: <code>stat</code> gives the full record.',
					),
					2 => array(
						'question'    => 'A file belongs to `www-data` and you are `ctf`. What can you do with it?',
						'choices'     => array(
							'Modify it, since the folder belongs to you',
							'Delete it unconditionally',
							'Read it if it has the right permissions for "others", otherwise nothing',
							'Become its owner',
						),
						'hint'        => 'Ownership and read permissions are not the same thing.',
						'explanation' => 'A service account (<code>www-data</code>) often owns the application files: that is normal. Your rights depend on the "others" permissions. You never become the owner of a file that is not yours.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * avance-05 — Ceinture orange
	 * ------------------------------------------------------------------ */
	'avance-05' => array(
		'title'   => 'Orange belt: network, processes, configuration',
		'excerpt' => 'Leaving files behind: what listens, what runs, and what was forgotten in the configuration.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — the orange belt',
				'content' => '<p>With the orange belt you stop reading files to look at <strong>what is alive</strong>: open ports, running processes, and configurations somebody forgot.</p><p>What you will learn:</p><ul><li><code>ss</code> (or <code>netstat</code>) — sockets and listening ports;</li><li><code>ps</code> — running processes;</li><li><code>cat</code> and <code>grep</code> on configuration files — the secrets left inside them.</li></ul><p><strong>Remember:</strong> a compromised machine tells its story through its processes and its ports. Before "looking for a flaw", look at what is already running: often the flaw is a service somebody forgot.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on the tools of this belt.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Which command lists the listening ports?',
						'choices'     => array(
							'ss -lnt',
							'ls -l /ports',
							'cat /proc/ports.conf',
							'ping -c1',
						),
						'hint'        => '"sockets" and "listening".',
						'explanation' => '<code>ss -lnt</code> lists the listening sockets in numeric format. <code>netstat -tlnp</code> does the same with the process name — handier when asking "which program holds that port".',
					),
					1 => array(
						'question'    => 'Why is a secret variable in a configuration file dangerous?',
						'choices'     => array(
							'Because the file is slow to read',
							'Because it is often copied, backed up, or read by a broader service than expected',
							'Because configuration files crash the server',
							'Because variables only work in production',
						),
						'hint'        => 'Who reads that file?',
						'explanation' => 'An API key forgotten in a configuration file ends up copied into a ticket, into a backup, or read by a script that passes it on. A secret stops being secret as soon as it is stored in clear text.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the four challenges of the belt',
				'content' => '<p>The dojo is deployed on your machine. The four challenges of the <strong>orange</strong> belt are in:</p><ul><li><strong>The open port</strong> — What listens is visible with `ss` or `netstat`. (<code>/srv/dojo/3-orange/09-port-ouvert.txt</code>)</li><li><strong>The suspicious process</strong> — What runs is visible with `ps`. (<code>/srv/dojo/3-orange/10-processus.txt</code>)</li><li><strong>The forgotten configuration</strong> — A variable left in a configuration file. (<code>/srv/dojo/3-orange/11-configuration.txt</code>)</li><li><strong>The firewall rule</strong> — A filtering rule, readable as text. (<code>/srv/dojo/3-orange/12-pare-feu.txt</code>)</li></ul><p><strong>Mission.</strong> Open each document, note the report value (the line <code>... = FLAG=SECURA{...}</code>), and answer the four questions. The server compares each answer with the flag it keeps in root.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the value of the "The open port" challenge (d09).',
						'hint'        => 'The orange belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
					1 => array(
						'question'    => 'Note the value of the "The suspicious process" challenge (d10).',
						'hint'        => 'The orange belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
					2 => array(
						'question'    => 'Note the value of the "The forgotten configuration" challenge (d11).',
						'hint'        => 'The orange belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
					3 => array(
						'question'    => 'Note the value of the "The firewall rule" challenge (d12).',
						'hint'        => 'The orange belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Three questions on this belt. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'A service listens on port 8080. Which question do you ask first?',
						'choices'     => array(
							'Why is the port not 80?',
							'Which program holds it, and is it supposed to be reachable from outside?',
							'Is port 8080 forbidden?',
							'Should the server be restarted?',
						),
						'hint'        => 'An open port is not a flaw: it is a question.',
						'explanation' => 'The right question is "is this normal?". Port 8080 may be the public shopfront, or an administration interface that should never have been exposed. It is the tester\'s job to compare it with what is expected.',
					),
					1 => array(
						'question'    => 'What does a process running with root rights reveal, when the service does not need them?',
						'choices'     => array(
							'Nothing particular',
							'A good performance practice',
							'A least-privilege flaw: if the service is compromised, the attacker inherits root',
							'The server is misconfigured at the network level',
						),
						'hint'        => 'What happens if that service is compromised?',
						'explanation' => 'That is the principle of least privilege: a service running as root has no safety net once it is abused. Remove the superfluous rights: a bug then becomes an incident, not a catastrophe.',
					),
					2 => array(
						'question'    => 'Why are filtering rules (firewall) a prime target?',
						'choices'     => array(
							'They are written in Perl',
							'Because they are stored in binary',
							'Because they slow the server down',
							'Because they decide what goes in and what goes out: a badly written rule opens a passage',
						),
						'hint'        => 'A rule is a door: badly written, it stays open.',
						'explanation' => 'Filtering is a policy: "who may pass, and to where". A forgotten rule (one "Any" too many) is often more serious than an application flaw, because it does not need exploiting: it is already there.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * avance-06 — Ceinture verte
	 * ------------------------------------------------------------------ */
	'avance-06' => array(
		'title'   => 'Green belt: binaries, strings, memory',
		'excerpt' => 'Looking at compiled programs: what they contain, what they are, and what is inside them.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — the green belt',
				'content' => '<p>The green belt changes medium: you no longer read texts, you look at <strong>binaries</strong> — compiled programs.</p><p>What you will learn:</p><ul><li><code>file</code> — what that file really is (executable, archive, image);</li><li><code>strings</code> — the pieces of text hidden in the binary;</li><li><code>stat</code> — the exact size, a clue that jumps out at you;</li><li><code>grep</code> — find an address, an error message, a password.</li></ul><p><strong>Remember:</strong> a binary hides almost nothing, it <em>shows</em> badly. Character strings stay in the file: the password, the URL, the error message that betrays a library. That is the very point of the 6.858 course: "the program does not say what it does, but it shows the pieces".</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on the tools of this belt.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What does the `strings` command do?',
						'choices'     => array(
							'It turns a file into text, line by line',
							'It displays the readable character strings contained in a file',
							'It sends strings over the network',
							'It checks the signature of a file',
						),
						'hint'        => 'It pulls the text out of the binary, thread by thread.',
						'explanation' => 'A compiled binary is made of machine code, but it also contains pieces of text: error messages, paths, URLs, identifiers. <code>strings</code> extracts them. It is often the first thing to do on an unknown program.',
					),
					1 => array(
						'question'    => 'Why is an absurd file size a clue?',
						'choices'     => array(
							'Because big files are compressed',
							'Because the size tells the age of the file',
							'Because a file often hides something else: an executable inside an image file, an archive inside a picture',
							'Because small files are always safe',
						),
						'hint'        => 'Think about what gets hidden inside a picture.',
						'explanation' => 'So-called "image" or "document" files often contain an executable or an archive: that is the basis of many trojans. A size that does not match the stated format is the signal to check it (<code>file</code>, then <code>strings</code>).',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the four challenges of the belt',
				'content' => '<p>The dojo is deployed on your machine. The four challenges of the <strong>green</strong> belt are in:</p><ul><li><strong>The binary and its strings</strong> — A binary\'s strings are read with `strings`. (<code>/srv/dojo/4-verte/13-chaines.txt</code>)</li><li><strong>The file type</strong> — A file\'s real type is seen with `file`. (<code>/srv/dojo/4-verte/14-type.txt</code>)</li><li><strong>The address of the failure</strong> — A memorable address is often written in clear text in the binary. (<code>/srv/dojo/4-verte/15-adresse.txt</code>)</li><li><strong>The file size</strong> — An abnormal size betrays a file that contains more than it says. (<code>/srv/dojo/4-verte/16-taille.txt</code>)</li></ul><p><strong>Mission.</strong> Open each document, note the report value (the line <code>... = FLAG=SECURA{...}</code>), and answer the four questions. The server compares each answer with the flag it keeps in root.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the value of the "The binary and its strings" challenge (d13).',
						'hint'        => 'The green belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
					1 => array(
						'question'    => 'Note the value of the "The file type" challenge (d14).',
						'hint'        => 'The green belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
					2 => array(
						'question'    => 'Note the value of the "The address of the failure" challenge (d15).',
						'hint'        => 'The green belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
					3 => array(
						'question'    => 'Note the value of the "The file size" challenge (d16).',
						'hint'        => 'The green belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Three questions on this belt. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'You find the string "/etc/passwd" in a binary. What does that indicate?',
						'choices'     => array(
							'That the binary is signed',
							'That the file is compressed',
							'That the program probably reads that file — so it is tied to the account mechanism',
							'That the binary comes from Linux',
						),
						'hint'        => 'A path string is an intention.',
						'explanation' => 'A binary\'s strings are traces of what it handles. Finding "/etc/passwd" or "/bin/sh" in a program is a strong clue: it is what you use to understand — and sometimes to become root.',
					),
					1 => array(
						'question'    => 'What is the `file` command for?',
						'choices'     => array(
							'Opening a file in an editor',
							'Deleting a file',
							'Comparing two files',
							'Guessing the real type of a file from its content',
						),
						'hint'        => 'It says what the file really is.',
						'explanation' => 'A file can carry a misleading extension. <code>file</code> looks at the first bytes (the "magic number") and tells the truth: ELF executable, archive, image, script. One more lie to unmask.',
					),
					2 => array(
						'question'    => 'Why do binaries still contain readable strings?',
						'choices'     => array(
							'Because the programmer needs messages, paths and labels: the compiler keeps them',
							'Because the C language cannot do otherwise',
							'Because the binary is encrypted',
							'Because the processor reads strings',
						),
						'hint'        => 'The programmer needs to talk to the user.',
						'explanation' => 'Machine code cannot display "Hello". Every displayed text, every path used, every error message is kept as is in the binary. That is what makes static analysis (<code>strings</code>) so useful.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * avance-07 — Ceinture noire
	 * ------------------------------------------------------------------ */
	'avance-07' => array(
		'title'   => 'Black belt: cryptography, keys, digests',
		'excerpt' => 'The last belt: read a digest, recognise a key, read a certificate.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — the black belt',
				'content' => '<p>The black belt is the world of <strong>secrets that are not in clear text</strong>: digests, keys, certificates. You do not break them (you do not "crack" a key): you <em>recognise</em> them, you read them, you verify them.</p><p>What you will learn:</p><ul><li><code>sha256sum</code> — compute the digest of a file, and compare it;</li><li><code>grep</code> — spot a key or a secret in a file;</li><li><code>openssl</code> — read a certificate and understand what it says.</li></ul><p><strong>Remember:</strong> a digest is not reversible: you do not "decrypt" a hash, you compare it. And comparing assumes you know what to compare against: that is the server\'s job, on our platform.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions on the tools of this belt.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What does the command `sha256sum fichier` do?',
						'choices'     => array(
							'It encrypts the file',
							'It compares the file with another one',
							'It computes a 64-character hexadecimal digest of the file',
							'It compresses the file',
						),
						'hint'        => 'A digest, not an encryption.',
						'explanation' => '<code>sha256sum</code> computes a digest: the same data always gives the same digest, and you cannot go back from the digest to the data. That is what lets you verify that a file has not been modified.',
					),
					1 => array(
						'question'    => 'Why can you not recover a password from its digest?',
						'choices'     => array(
							'Because the digest is too short',
							'Because the password is encrypted twice',
							'Because sha256sum is an old tool',
							'Because the digest is computed one way only: you verify by recomputing it',
						),
						'hint'        => 'You do not read a digest back: you recompute it.',
						'explanation' => 'A hash function is one-way by design. To verify a password, you hash it and compare the digests. That is also why digests are salted: two users with the same password then do not have the same digest.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the four challenges of the belt',
				'content' => '<p>The dojo is deployed on your machine. The four challenges of the <strong>black</strong> belt are in:</p><ul><li><strong>The digest of the secret</strong> — A file\'s digest is computed with `sha256sum`. (<code>/srv/dojo/5-noire/17-empreinte.txt</code>)</li><li><strong>The private key</strong> — A key leaves traces in configuration files. (<code>/srv/dojo/5-noire/18-cle.txt</code>)</li><li><strong>The certificate</strong> — A certificate says who issued it, for whom, and until when. (<code>/srv/dojo/5-noire/19-certificat.txt</code>)</li><li><strong>The hashed password</strong> — A password hash is verified, not read back. (<code>/srv/dojo/5-noire/20-hache.txt</code>)</li></ul><p><strong>Mission.</strong> Open each document, note the report value (the line <code>... = FLAG=SECURA{...}</code>), and answer the four questions. The server compares each answer with the flag it keeps in root.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the value of the "The digest of the secret" challenge (d17).',
						'hint'        => 'The black belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
					1 => array(
						'question'    => 'Note the value of the "The private key" challenge (d18).',
						'hint'        => 'The black belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
					2 => array(
						'question'    => 'Note the value of the "The certificate" challenge (d19).',
						'hint'        => 'The black belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
					3 => array(
						'question'    => 'Note the value of the "The hashed password" challenge (d20).',
						'hint'        => 'The black belt folder is in <code>/srv/dojo</code>. Open the challenge file and copy the value between the braces.',
						'explanation' => 'Every dojo challenge is validated with proof read from the machine: the server compares your answer with the flag it keeps in root. The tool for the challenge is given in the document itself.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Three questions on this belt. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'A TLS certificate contains the site address. Why does that matter?',
						'choices'     => array(
							'Because the browser displays it',
							'Because it speeds up the connection',
							'Because it encrypts the site',
							'Because it lets you verify who you are talking to: it is the server\'s identity',
						),
						'hint'        => 'What does the certificate prove?',
						'explanation' => 'The certificate binds a public key to a domain name, and it is signed by an authority. It is a verifiable promise: "this key really belongs to this site". Without that verification, encryption protects against eavesdropping, but not against impersonation.',
					),
					1 => array(
						'question'    => 'A configuration file contains a private key in clear text. What is the main risk?',
						'choices'     => array(
							'Anyone who reads that file can impersonate the service',
							'The file becomes heavier',
							'The server becomes slower',
							'The key becomes shorter',
						),
						'hint'        => 'A private key is either used or stolen.',
						'explanation' => 'The private key is the secret that makes the public key credible. Readable by a badly configured service account, or copied into a backup, it lets someone impersonate the service — and decrypt what was meant to stay encrypted.',
					),
					2 => array(
						'question'    => 'What is the difference between a hash and an encryption?',
						'choices'     => array(
							'None, they are the same thing',
							'Encryption is reversible with the key; a hash is not',
							'Hashing is older',
							'Encryption only works on files',
						),
						'hint'        => 'Reversible or not: that is the difference.',
						'explanation' => 'Encryption is a door: you go in with the key, you come out with the data. Hashing is a fingerprint: impossible to go backwards. Confusing the two means believing you can "decode" a hashed password.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * avance-08 — Brief 1 : le dojo
	 * ------------------------------------------------------------------ */
	'avance-08' => array(
		'title'   => 'Brief 1: the dojo, how we train',
		'excerpt' => 'Before the challenges: the method. The dojo is not a cracking game, it is a ladder.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — the dojo, how we train',
				'content' => '<p>A dojo is not a list of flaws to batter down: it is a <strong>ladder</strong>. You climb belt by belt, and each belt builds a skill.</p><p>The dojo rule, in three points:</p><ol><li><strong>Look for the proof, not the flaw.</strong> An exercise asks you to note a precise value. That is a proof: it can be checked that you understood, instead of guessing what the author had in mind.</li><li><strong>One command at a time.</strong> First you read. Only then do you break. The belts do it in that order, and it works.</li><li><strong>The dojo is not a solo game.</strong> It is training: you can start over, get it wrong, and start over. The goal is not victory, it is the skill.</li></ol><p><strong>Remember:</strong> on our platform, each challenge is validated with a flag read from your machine, by the server, as root. You cannot cheat: you can only learn.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions to check the brief went in.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What separates a "proof" exercise from a "guessing" exercise?',
						'choices'     => array(
							'The price',
							'The number of questions',
							'The duration',
							'The proof is checked automatically: there is only one right answer, to be read from the machine',
						),
						'hint'        => 'What lets someone say "that is correct"?',
						'explanation' => 'A proof can be checked: the server reads the value from the machine and compares it. A "guessing" exercise asks you to rephrase what the author had in mind: it is fuzzy, and it is demotivating.',
					),
					1 => array(
						'question'    => 'Why start by reading before trying to break?',
						'choices'     => array(
							'Because you do not know where to look before seeing what is there',
							'Because it is slower, hence more serious',
							'Because reading tools are prettier',
							'Because access accounts are complicated',
						),
						'hint'        => 'What exactly are you looking for, before you have looked?',
						'explanation' => 'That is the dojo method: observe first (what runs, what is written, who owns what), then act. A head-on crash against an application you have not read is guesswork.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the proof of the brief',
				'content' => '<p>The brief is written in the dojo machine, in <code>/srv/briefs/01-presentation.txt</code>.</p><p><strong>Mission.</strong> Open that document and note the value it announces. The server compares it with the flag it keeps in root.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the value of brief 1 (the dojo method).',
						'hint'        => 'The briefs are in <code>/srv/briefs</code>.',
						'explanation' => 'Each brief is validated with proof read from the dojo machine: the same mechanism as for the challenges, and it holds for every room.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Two questions on this brief. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'The server compares your answer with the flag it keeps in the machine, as root. Why "as root"?',
						'choices'     => array(
							'So the flag is unreadable by the learner: they must find it, not copy it',
							'To go faster',
							'Because containers run as root',
							'To compress the file',
						),
						'hint'        => 'Who must be able to read the flag file?',
						'explanation' => 'If the learner could read the flag file, the mission would prove nothing: they would copy the answer. By putting it in 400 root:root, we force the learner to go through understanding.',
					),
					1 => array(
						'question'    => 'An exercise is a "proof" exercise when…',
						'choices'     => array(
							'it has an image to download',
							'the answer is found in the machine and checked without ambiguity',
							'it lasts more than ten minutes',
							'it comes from a university',
						),
						'hint'        => 'Automatic checking is the key.',
						'explanation' => 'The rule we apply to every mission: one right answer, readable in the machine, checked by the server. That is what separates a learning platform from a quiz.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * avance-09 — Brief 2 : le web, comment on parle a un serveur
	 * ------------------------------------------------------------------ */
	'avance-09' => array(
		'title'   => 'Brief 2: the web, how we talk to a server',
		'excerpt' => 'HTTP, in clear text: a request, a response. The web is not magic.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — the web, how we talk to a server',
				'content' => '<p>A website is a program that receives texts and answers with texts. Nothing more. The "web" is not magic: it is a dialogue, and the dialogue can be read.</p><p>The mechanics, in four steps:</p><ol><li>The browser sends a <strong>request</strong>: a method (GET, POST), an address, headers, and sometimes a body.</li><li>The server reads the request, runs its code, prepares a <strong>response</strong>: a status code (200, 404, 500…), headers, then a body.</li><li>The body can be HTML, JSON, an image… or text that is then executed by your browser (JavaScript).</li><li>Every exchange leaves a trace: in the server logs, in the browser history, in the server memory.</li></ol><p><strong>Remember:</strong> testing a web application means first <em>reading the exchanges</em>. An SQL injection, an XSS, a leaked secret: in all three cases, something you should not have been able to write ends up in a request.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions to check the brief went in.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What does an HTTP GET request contain?',
						'choices'     => array(
							'A method, an address, headers and sometimes a body',
							'Only the address of the site',
							'Only encrypted data',
							'A password and a user name',
						),
						'hint'        => 'A request is an envelope: what is inside it?',
						'explanation' => 'An HTTP request is a method (GET, POST…), an address (the route and the query), headers (who is talking, which format, which browser) and sometimes a body. POST sends data; GET puts it in the address.',
					),
					1 => array(
						'question'    => 'What does the HTTP status code 404 mean?',
						'choices'     => array(
							'The server crashed',
							'The requested resource does not exist',
							'The request was refused by the firewall',
							'The site is under maintenance',
						),
						'hint'        => '404: a mix of "not found" and "400-something".',
						'explanation' => '404 = Not Found: the server answers, but the page does not exist. 500 = Internal Server Error: the server crashed while handling the request. 403 = Forbidden: the server understood, but refuses.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the proof of the brief',
				'content' => '<p>The brief is written in the dojo machine, in <code>/srv/briefs/02-talking-web.txt</code>.</p><p><strong>Mission.</strong> Open that document and note the value it announces. The server compares it with the flag it keeps in root.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the value of brief 2 (the web in clear text).',
						'hint'        => 'The briefs are in <code>/srv/briefs</code>.',
						'explanation' => 'Same mechanism: proof read from the machine, compared by the server as root.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Two questions on this brief. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'An XSS (script injection) consists in…',
						'choices'     => array(
							'Destroying the database',
							'Making another person\'s browser execute code',
							'Flooding the server with requests',
							'Encrypting the exchanges',
						),
						'hint'        => 'The "X" in XSS stands for script.',
						'explanation' => 'An XSS is code you place in data the application reuses without escaping, and which runs on the machine of whoever displays the page. The risk: stealing a session, or acting with the victim\'s rights.',
					),
					1 => array(
						'question'    => 'Why is reading the server logs useful during a test?',
						'choices'     => array(
							'Because they contain the source code',
							'Because they speed the server up',
							'Because they show the requests received: you see what the application understood of what you sent',
							'Because they replace testing',
						),
						'hint'        => 'The log is the story of the request.',
						'explanation' => 'When the application behaves strangely, the log shows the request as it was received. That is often where you see the difference between what you sent and what the server understood.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * avance-10 — Brief 3 : les scenarios d'exploitation
	 * ------------------------------------------------------------------ */
	'avance-10' => array(
		'title'   => 'Brief 3: exploitation scenarios',
		'excerpt' => 'Exploiting is not "breaking": it is making a program do something it did not plan for.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — exploitation scenarios',
				'content' => '<p>The word "exploitation" is scary, but the idea is simple: <strong>make a program do something it did not plan for</strong>.</p><p>Every exploitation scenario has the same shape, in four steps:</p><ol><li><strong>The trigger</strong>: the input the program does not control (data sent over the network, a file, a parameter).</li><li><strong>The gap</strong>: the program makes an assumption that is not guaranteed ("this text fits in 32 bytes", "that name is the right one").</li><li><strong>The deviation</strong>: the triggering input overflows, gets deformed, or executes in place of something else.</li><li><strong>The effect</strong>: what the attacker gets — read a file, run a command, become root.</li></ol><p>The right reflex: <strong>look for the fragile assumption</strong>. In a program it is almost always a size, a number, or a permission: "what if the data were bigger than expected?".</p><p><strong>Remember:</strong> an exploitation is always a <em>scenario</em>, so it gets written down. If you cannot explain in three sentences how it works, you probably found nothing.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions to check the brief went in.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'In an exploitation scenario, what is "the fragile assumption"?',
						'choices'     => array(
							'The company firewall',
							'A belief of the program that is not guaranteed, for example "this data fits in 32 bytes"',
							'The name of the program',
							'The network speed',
						),
						'hint'        => 'Which sentence does the program assume to be true?',
						'explanation' => 'The fragile assumption is where the program trusts without verifying: a maximum size, an identifier, an access right. That is where the exploitation slips in.',
					),
					1 => array(
						'question'    => 'Why is "it crashes" not proof of exploitation?',
						'choices'     => array(
							'Because a program that crashes is simply badly written',
							'Because crashes are rare',
							'Because a crash is a result, not a control: you have to obtain the intended effect',
							'Because you have to reboot',
						),
						'hint'        => 'A crash is a side effect. Exploitation is an intended effect.',
						'explanation' => 'Making a program crash is a denial of service, not an exploitation. Exploitation means obtaining a capability you did not have: read a confidential file, run a command, escalate privileges.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the proof of the brief',
				'content' => '<p>The brief is written in the dojo machine, in <code>/srv/briefs/03-exploitation.txt</code>.</p><p><strong>Mission.</strong> Open that document and note the value it announces. The server compares it with the flag it keeps in root.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the value of brief 3 (the exploitation scenario).',
						'hint'        => 'The briefs are in <code>/srv/briefs</code>.',
						'explanation' => 'Same mechanism: proof read from the machine, compared by the server as root.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Two questions on this brief. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'In a buffer overflow, what gets overwritten?',
						'choices'     => array(
							'The file on disk',
							'The account password',
							'Data located just after the buffer in memory (variables, return address)',
							'The network configuration',
						),
						'hint'        => 'The overflow goes further than the space provided.',
						'explanation' => 'That is lesson 3 of the 6.858 course: the program allocates a buffer but does not check that the write fits inside it. What follows the buffer in memory — local variables, the canary, the return address — gets overwritten. Hence the defences (canary, NX, ASLR).',
					),
					1 => array(
						'question'    => 'How does a tester write an exploitation scenario?',
						'choices'     => array(
							'By trying tools at random until something works',
							'By copying a script found online',
							'By reading the application source code',
							'By first writing the assumption, the trigger and the expected effect, then verifying it',
						),
						'hint'        => 'An assumption, a trigger, an effect.',
						'explanation' => 'The method is discipline: you write what you assume, how you trigger it, and what you must obtain. Only then do you try. That is what separates a test from a series of commands.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * avance-11 — Brief 4 : les registres
	 * ------------------------------------------------------------------ */
	'avance-11' => array(
		'title'   => 'Brief 4: registers, the processor\'s notebook',
		'excerpt' => 'The processor keeps almost nothing in memory: it works in a dozen slots we forget right away.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — registers, the processor\'s notebook',
				'content' => '<p>A processor does not read variables. It reads <strong>registers</strong>: tiny, very fast memory slots, in fixed number (about a dozen on x86-64).</p><p>The ones most worth knowing:</p><ul><li><code>rax</code>, <code>rbx</code>, <code>rcx</code>, <code>rdx</code> — general purpose;</li><li><code>rdi</code>, <code>rsi</code>, <code>rdx</code> — the first three arguments (System V calling convention, the Linux one on x86-64);</li><li><code>rsp</code> — the stack pointer: it says where the top of the stack is;</li><li><code>rbp</code> — the base pointer, the frame of the current function.</li></ul><p>Why that matters for security: when a function is called, the <strong>return address</strong> is pushed onto the stack. If an overflow reaches that address, the program will jump elsewhere: that is the principle of the "smashing the stack" attack.</p><p><strong>Remember:</strong> to understand an exploitation, you have to know where the data is <em>right now</em>. Registers are the answer.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions to check the brief went in.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Where is the return address of a function?',
						'choices'     => array(
							'In a file on disk',
							'In a processor register',
							'On the stack, above the local variables',
							'In the server log',
						),
						'hint'        => 'At call time, what gets pushed?',
						'explanation' => 'The calling convention pushes the return address, then the local variables. A buffer overflow writes past the local buffer and ends up reaching that address: hence the possibility of hijacking execution.',
					),
					1 => array(
						'question'    => 'What are registers like `rdi`, `rsi`, `rdx` for?',
						'choices'     => array(
							'Storing files on disk',
							'Measuring execution time',
							'Encrypting memory',
							'Passing the arguments of a function, according to the calling convention',
						),
						'hint'        => 'How does a program pass a value to a function?',
						'explanation' => 'On x86-64 under Linux, the first three arguments go in rdi, rsi and rdx. Knowing that lets you read a disassembly — and understand an exploitation that builds a "/bin/sh" string.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the proof of the brief',
				'content' => '<p>The brief is written in the dojo machine, in <code>/srv/briefs/04-registres.txt</code>.</p><p><strong>Mission.</strong> Open that document and note the value it announces. The server compares it with the flag it keeps in root.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the value of brief 4 (the registers).',
						'hint'        => 'The briefs are in <code>/srv/briefs</code>.',
						'explanation' => 'Same mechanism: proof read from the machine, compared by the server as root.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Two questions on this brief. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Why would an architecture without registers be very slow?',
						'choices'     => array(
							'Because registers cost a lot of memory',
							'Because registers are not reliable',
							'Because the code would be longer',
							'Because the processor is fast, but ordinary memory is not: registers are the fastest memory there is',
						),
						'hint'        => 'Speed comes from distance, not from quantity.',
						'explanation' => 'A register is inside the processor: one cycle. An ordinary memory slot takes dozens of cycles. A program that works in memory is therefore slow. Registers are the fastest memory — and the smallest.',
					),
					1 => array(
						'question'    => 'What is the "canary" (stack protector)?',
						'choices'     => array(
							'A value placed between the buffer and the return address, checked before returning: if it has changed, the program stops',
							'A system password',
							'A kernel firewall',
							'A backup copy of the buffer',
						),
						'hint'        => 'A guard between the buffer and the return address.',
						'explanation' => 'The canary is a random value placed between the local buffer and the return address. Before returning, the function compares it: if it has changed, an overflow has occurred, and the program aborts. That is the defence taught in the 6.858 course.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * avance-12 — Brief 5 : ne pas se faire avoir
	 * ------------------------------------------------------------------ */
	'avance-12' => array(
		'title'   => 'Brief 5: not getting caught out',
		'excerpt' => 'The golden rule of digital hygiene: what looks too good, or too urgent, is almost always staged.',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — not getting caught out',
				'content' => '<p>The CYBER.ORG video is aimed at younger people: that is the level where traps become <em>everyday</em>. Three reflexes:</p><ul><li><strong>Urgency is a tool.</strong> "Your account will be closed in two hours", "you have 3 minutes left": urgency prevents thinking. A real service does not threaten to punish you.</li><li><strong>The emotional lever.</strong> Fear ("you have been hacked"), curiosity ("look at this photo"), sympathy ("I need help"): those are doorways, not feelings.</li><li><strong>The pause rule.</strong> When a message pushes you, you stop: you check the address, you open the site by typing its address yourself, you ask an adult.</li></ul><p><strong>Remember:</strong> the most effective technique against phishing is not recognising a fake message: it is knowing <em>where to go</em> without going through the message.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions to check the brief went in.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Why is urgency a sign of phishing?',
						'choices'     => array(
							'Because real services are always slow',
							'Because urgent e-mails are rare',
							'Because it makes the message shorter',
							'Because it prevents checking: you act before thinking',
						),
						'hint'        => 'What does urgency do to you?',
						'explanation' => 'Urgency is a social technique: it short-circuits verification. If a threat pushes you to act immediately, that is exactly the moment to slow down — and to check where the message comes from.',
					),
					1 => array(
						'question'    => 'What is the best way to check a message asking you to log in?',
						'choices'     => array(
							'Open the site by typing its address in the browser, without going through the link',
							'Click the link then look at the address',
							'Reply to the message to ask',
							'Click the link and check the padlock',
						),
						'hint'        => 'If you go through the link, you can no longer check.',
						'explanation' => 'The padlock only means the connection is encrypted — not that the site is the right one. The only reliable method: type the address yourself, or call the service on a number you already know.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the proof of the brief',
				'content' => '<p>The brief is written in the dojo machine, in <code>/srv/briefs/05-ne-pas-se-faire-avor.txt</code>.</p><p><strong>Mission.</strong> Open that document and note the value it announces. The server compares it with the flag it keeps in root.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the value of brief 5 (not getting caught out).',
						'hint'        => 'The briefs are in <code>/srv/briefs</code>.',
						'explanation' => 'Same mechanism: proof read from the machine, compared by the server as root.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Two questions on this brief. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the role of the second authentication factor (MFA)?',
						'choices'     => array(
							'Add a proof the password thief normally does not have: a code, a key, an app',
							'Make the password longer',
							'Block spam',
							'Back up the accounts',
						),
						'hint'        => 'A password alone is a single proof.',
						'explanation' => 'The second factor changes the nature of authentication: even with the password, something is missing. That is what makes password phishing far less profitable — hence those CYBER.ORG videos on the subject.',
					),
					1 => array(
						'question'    => 'Why does the length of a password matter more than its complexity?',
						'choices'     => array(
							'Because complex passwords take too long to type',
							'Because length makes enumeration impossible in a reasonable time, even with a full alphabet',
							'Because sites require it',
							'Because a complex password is harder to remember, so people write it down',
						),
						'hint'        => 'Trying every combination takes an enormous amount of time.',
						'explanation' => 'The strength of a password is measured in how many tries it takes. Each extra character multiplies the number of combinations; going from 8 to 12 characters multiplies it by more than 16,000. A long, predictable password beats a short, complicated one.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * avance-13 — Brief 6 : explorer une application web
	 * ------------------------------------------------------------------ */
	'avance-13' => array(
		'title'   => 'Brief 6: exploring a web application',
		'excerpt' => 'Before looking for a flaw: look at the application as a user, then as an attacker.',
		'tasks'   => array(
			0 => array(
					'title'   => 'Task 1: Lesson — exploring a web application',
				'content' => '<p>Joe Ma\'s demonstration shows the order to follow: <strong>look first, attack afterwards</strong>.</p><ol><li><strong>Look as a user.</strong> Every button, every field, every link: what is it for, who reaches it, what happens when it fails.</li><li><strong>Look at the roles.</strong> A visitor, a customer, an administrator: what should a visitor not be able to see?</li><li><strong>Look at the inputs.</strong> Every form sends something: what happens if it is not what is expected?</li><li><strong>Look at what is exposed.</strong> Error messages, files left on the server, forgotten pages.</li></ol><p><strong>Remember:</strong> a badly tested application is first of all a badly <em>understood</em> one. The flaw is often in an area nobody bothered to look at.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions to check the brief went in.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Where do you start when testing a web application?',
						'choices'     => array(
							'With careful reading of the application: its functions, its roles, its inputs',
							'With an automatic scanner',
							'By sending many requests',
							'With the source code, if it is available',
						),
						'hint'        => 'Before launching anything, what do you understand?',
						'explanation' => 'A scanner finds anomalies the application forgot; a human understands the functions. Order matters: understand first, then test.',
					),
					1 => array(
						'question'    => 'What is the point of trying the application with a "plain" account, then an "administrator" account?',
						'choices'     => array(
							'To go faster',
							'To see what the plain role should not see: that is where authorisation flaws live',
							'To occupy the account',
							'To test the browser',
						),
						'hint'        => 'A test is a comparison.',
						'explanation' => 'The plain role is the reference: anything it sees, everyone should see. Anything extra it sees is an authorisation flaw to document.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the proof of the brief',
				'content' => '<p>The brief is written in the dojo machine, in <code>/srv/briefs/06-explorer-application.txt</code>.</p><p><strong>Mission.</strong> Open that document and note the value it announces. The server compares it with the flag it keeps in root.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the value of brief 6 (exploring a web application).',
						'hint'        => 'The briefs are in <code>/srv/briefs</code>.',
						'explanation' => 'Same mechanism: proof read from the machine, compared by the server as root.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>Two questions on this brief. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Is a detailed error message (file path, library version) a problem?',
						'choices'     => array(
							'No, it is useful for the user',
							'Yes: it gives the attacker a map of the application (technologies, tree, versions)',
							'No, if the site uses HTTPS',
							'No, as long as no secret appears',
						),
						'hint'        => 'An overly talkative error is an information leak.',
						'explanation' => 'The detailed error message is an OWASP classic: it makes exploitation easier. In production you show a generic message and keep the detail in the logs, on the server side.',
					),
					1 => array(
						'question'    => 'What is the difference between a flaw and a misconfiguration?',
						'choices'     => array(
							'None, they are the same thing',
							'Configuration is fixed faster',
							'A flaw is a bug in the code; a misconfiguration is a setting that leaves a door open while the code is correct',
							'A flaw is always more serious',
						),
						'hint'        => 'One is code, the other is settings.',
						'explanation' => 'Both are doors, but not of the same nature: one is fixed in the code, the other in configuration files or access rules. An audit looks for both.',
					),
				),
			),
		),
	),

	/* ---------------------------------------------------------------------
	 * avance-14 — Kahoot : la revision des labs avances
	 * ------------------------------------------------------------------ */
	'avance-14' => array(
		'title'   => 'Kahoot: revising the advanced labs',
		'excerpt' => 'The same content, playable in class (with Kahoot) or alone on the platform (no account).',
		'tasks'   => array(
			0 => array(
				'title'   => 'Task 1: Lesson — how we revise',
				'content' => '<p>Revising is not re-reading: it is <strong>answering without looking</strong>.</p><p>The format of this room is made for that: ten questions, a timer, and an explanation after every answer — even a wrong one. In class you can go through Kahoot: same duration, same series of questions, and the students play on their phone. Without a Kahoot account, the room works as it is.</p><p><strong>Remember:</strong> an explained mistake is worth more than a right answer with no reason. That is why every wrong option is commented on.</p>',
			),
			1 => array(
				'title'   => 'Task 2: Practice',
				'content' => '<p>Two questions to get going.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is the best way to memorise a security notion?',
						'choices'     => array(
							'Re-read it three times',
							'Explain it to someone else, and check what you understood',
							'Copy it word for word',
							'Watch it in a video a second time',
						),
						'hint'        => 'What counts is retrieving it.',
						'explanation' => 'Explaining forces you to rebuild the logic, and therefore to spot the gaps. That is why the rooms on the platform explain every mistake: spaced repetition does the rest.',
					),
					1 => array(
						'question'    => 'What is a classroom quiz for, besides grading?',
						'choices'     => array(
							'Ranking the students',
							'Filling the time',
							'Showing each person right away what they got wrong, and discussing it',
							'Replacing the lessons',
						),
						'hint'        => 'A quiz is a discussion tool.',
						'explanation' => 'The value of a quiz is not the mark: it is the moment when each person discovers their blind spot, and the class discusses it. That is exactly what the platform does: the explanation is systematic.',
					),
				),
			),
			2 => array(
				'title'   => 'Task 3: The mission — the revision proof',
				'content' => '<p>The revision left a trace in the dojo machine: <code>/srv/briefs/07-revision.txt</code>.</p><p><strong>Mission.</strong> Open the document and note the announced value.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'Note the value of the revision document.',
						'hint'        => 'The document is in <code>/srv/briefs</code>.',
						'explanation' => 'Same mechanism as everywhere else: a proof read from the machine, compared by the server as root.',
					),
				),
			),
			3 => array(
				'title'   => 'Task 4: End-of-room exam',
				'content' => '<p>The ten quiz questions, timed. 60% is enough to pass.</p>',
				'questions' => array(
					0 => array(
						'question'    => 'What is a threat model?',
						'choices'     => array(
							'The list of known flaws in a product',
							'The test plan of an application',
							'The sentence that links what you protect, who the adversary is, and what they can do',
							'The list of the company servers',
						),
						'hint'        => 'Three questions, one sentence.',
						'explanation' => 'The threat model is the basis of all security: you start from what you protect and what the adversary can do, then deduce the mechanisms. Without it, you protect at random.',
					),
					1 => array(
						'question'    => 'What is a long, predictable password worth?',
						'choices'     => array(
							'Less than a short, complicated password',
							'The same, if the site is well protected',
							'Nothing: length does not count',
							'More than a short, complicated password',
						),
						'hint'        => 'The number of combinations to try.',
						'explanation' => 'Strength is measured in number of tries. A long password multiplies the combinations to test: "chat1234" (8 characters) is found in a few hours on one machine, "Correct-Horse-Battery-9" (24) would take years.',
					),
					2 => array(
						'question'    => 'An SQL injection is…',
						'choices'     => array(
							'Code that slips into the SQL query because the data is not separated from the code',
							'A virus that infects the database',
							'Too many connections',
							'A backup of the database',
						),
						'hint'        => 'Data and code mixed together.',
						'explanation' => 'The injection comes from the missing separation: the user data is concatenated into the query. It then becomes SQL code — and can read, write, or delete.',
					),
					3 => array(
						'question'    => 'What is the role of a firewall?',
						'choices'     => array(
							'Making the network faster',
							'Enforcing a policy: who may pass, and to where',
							'Encrypting data in transit',
							'Removing viruses',
						),
						'hint'        => 'A crossing policy.',
						'explanation' => 'The firewall is a filtering rule. It encrypts nothing and cleans nothing: it enforces a flow policy. A badly written rule lets through what it was meant to block.',
					),
					4 => array(
						'question'    => '"Least privilege" means…',
						'choices'     => array(
							'Giving every right to the administrator',
							'Creating a single account for the whole company',
							'Giving a service only the rights it needs',
							'Closing every port',
						),
						'hint'        => 'Just what is needed, and no more.',
						'explanation' => 'A service running with too many rights turns a bug into a catastrophe. Least privilege costs little to put in place and limits the impact of a compromise.',
					),
					5 => array(
						'question'    => 'An XSS is…',
						'choices'     => array(
							'A password in clear text in a database',
							'A server that no longer answers',
							'A site that loads slowly',
							'Code executed in a visitor\'s browser, because of unescaped data',
						),
						'hint'        => 'The script travels with the data.',
						'explanation' => 'XSS = Cross-Site Scripting: the application reinjects data into its page without escaping it, and the browser executes the code. The consequence: steal a session, or act in the victim\'s name.',
					),
					6 => array(
						'question'    => 'What does the TLS certificate prove?',
						'choices'     => array(
							'Who you are talking to: the public key really is bound to that domain name',
							'That the site is fast',
							'That the site is high quality',
							'That the password is strong',
						),
						'hint'        => 'The identity of the server.',
						'explanation' => 'Encryption protects against eavesdropping; the certificate protects against impersonation. Both are needed: HTTPS without a verified certificate only protects against the network, not against a middleman.',
					),
					7 => array(
						'question'    => 'The hash of a password is…',
						'choices'     => array(
							'Reversible with the right key',
							'One-way: you recompute it to verify',
							'Reversible with the user name',
							'Too slow to be useful',
						),
						'hint'        => 'You do not read a digest back.',
						'explanation' => 'A hash function is one-way. You verify a password by recomputing its digest and comparing — hence the salt, so that two accounts with the same password do not have the same digest.',
					),
					8 => array(
						'question'    => 'How do you protect yourself from phishing?',
						'choices'     => array(
							'By carefully checking every message',
							'By never replying',
							'By going to the site typing its address, without going through the link in the message',
							'By installing an antivirus',
						),
						'hint'        => 'Do not go through the link.',
						'explanation' => 'Manual checking is fallible: a well-written message fools everybody. The most effective defence is mechanical: type the address yourself, or call the service on a number you already know.',
					),
					9 => array(
						'question'    => 'An exploited buffer overflow is…',
						'choices'     => array(
							'A program that crashes',
							'A compilation error',
							'A full disk',
							'A write past the buffer, which overwrites the return address and makes execution jump elsewhere',
						),
						'hint'        => 'What follows the buffer in memory.',
						'explanation' => 'That is lesson 3 of the 6.858 course: the program does not check the size of the input. By overwriting the return address, the attacker chooses where the program continues. Hence the defences: canary, NX, ASLR.',
					),
				),
			),
		),
	),

);
