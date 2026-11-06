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

);
