<?php
/**
 * Questions importees — MIT OpenCourseWare — 6.858 Computer Systems Security (Fall 2014) : quiz et corrigés officiels
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Attribution : MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 — quiz d'examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_6858_examens' ) ) {
	function seca_import_mit_ocw_6858_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6858-examens', 'nom' => 'MIT OpenCourseWare — 6.858 Computer Systems Security (Fall 2014) : quiz et corrigés officiels', 'url' => 'https://ocw.mit.edu/courses/6-858-computer-systems-security-fall-2014/pages/exams/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 — quiz d\'examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.858 — question d’examen, en anglais] Suppose the foo function is as follows: struct request { void (*f)(void); // function pointer char path[240]; }; void foo(char *buf) { struct request r; r.f = /* some legitimate function */; strcpy(r.path, buf); r.f(); } Which of the following are true? — An adversary can trick the program to delete ﬁles on a system where the stack grows down.', 'mode' => 'choice', 'choices' => array('False', 'True'), 'correct' => 1, 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : The adversary can overwrite foo\'s return address on the stack.', 'source' => 'MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 — quiz d\'examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0'),
						),
					),
				),
				'kahoot-la-revision-des-labs-avances' => array(
					'title' => 'kahoot-la-revision-des-labs-avances',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.858 — question d’examen, en anglais] Which of the following are true? — If mail servers required the sending machine to solve a CAPTCHA for each email message sent, spammers would ﬁnd it prohibitively expensive to advertise their products via email.', 'mode' => 'choice', 'choices' => array('True', 'False'), 'correct' => 0, 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : Even though an adversary could solve CAPTCHAs by using Amazon\'s Mechanical Turk, or otherwise getting humans to solve CAPTCHAs, the cost of solving one CAPTCHA is several orders of magnitude higher than the cost of sending a single spam e-mail today.', 'source' => 'MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 — quiz d\'examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0'),
						),
					),
				),
				'la-boutique-en-ligne-se-connecter-en-administrateur' => array(
					'title' => 'la-boutique-en-ligne-se-connecter-en-administrateur',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.858 — question d’examen, en anglais] The tool would report a potential error/warning in the following code: mysql_query("SELECT .. $n");', 'mode' => 'choice', 'choices' => array('True', 'False'), 'correct' => 0, 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : The tool reports warnings when any variable must be sanitized on entry into the main function, and the variable is not known to be easily controlled by the user, such as $_GET and $_POST.', 'source' => 'MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 — quiz d\'examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0'),
						),
					),
				),
				'la-page-qui-se-trahit' => array(
					'title' => 'la-page-qui-se-trahit',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.858 — question d’examen, en anglais] The tool would report a potential error/warning in the following code: function q($s) { return mysql_query($s); } $x = $_GET[’id’]; q("SELECT .. $x");', 'mode' => 'choice', 'choices' => array('True', 'False'), 'correct' => 0, 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : The summary for q() indicates that the argument must be sanitized on entry, and the main function does not sanitize the argument.', 'source' => 'MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 — quiz d\'examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0'),
						),
					),
				),
				'la-requete-qui-ne-se-fie-a-personne' => array(
					'title' => 'la-requete-qui-ne-se-fie-a-personne',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.858 — question d’examen, en anglais] The tool would report a potential error/warning in the following code: function my_validate() { return isnumeric($_GET[’id’]); } $x = $_GET[’id’]; if (my_validate()) { mysql_query("SELECT .. $x"); }', 'mode' => 'choice', 'choices' => array('False', 'True'), 'correct' => 0, 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : The summary for my_validate() indicates that $_GET[id] is sanitized if the return value is true.', 'source' => 'MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 — quiz d\'examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0'),
						),
					),
				),
				'le-binaire-qui-obeit-trop' => array(
					'title' => 'le-binaire-qui-obeit-trop',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.858 — question d’examen, en anglais] Suppose the foo function is as follows: void foo(char *buf) { char tmp[200]; // assume compiler places "tmp" on the stack // copy from buf to tmp int i = 0; // assume compiler places "i" in a register while (buf[i] != 0) { tmp[i] = buf[i]; i++; } } Which of the following are true? Assume there is an unmapped page both above and below the stack in the process\'s virtual memory — An adversary can trick the program to delete ﬁles on a system where the stack grows down.', 'mode' => 'choice', 'choices' => array('False', 'True'), 'correct' => 1, 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : The adversary can overwrite foo\'s return address.', 'source' => 'MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 — quiz d\'examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0'),
						),
					),
				),
				'le-certificat-qui-ne-prouve-rien' => array(
					'title' => 'le-certificat-qui-ne-prouve-rien',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.858 — question d’examen, en anglais] Suppose the foo function is as follows: void foo(char *buf) { char tmp[200]; // assume compiler places "tmp" on the stack // copy from buf to tmp int i = 0; // assume compiler places "i" in a register while (buf[i] != 0) { tmp[i] = buf[i]; i++; } } Which of the following are true? Assume there is an unmapped page both above and below the stack in the process\'s virtual memory — An adversary can trick the program to delete ﬁles on a system where the stack grows up.', 'mode' => 'choice', 'choices' => array('True', 'False'), 'correct' => 1, 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : If the stack grows up, then no other state is placed above tmp on the stack, so even if the adversary overflows tmp, it will not affect the program\'s execution.', 'source' => 'MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 — quiz d\'examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0'),
						),
					),
				),
				'le-fichier-quon-naurait-pas-du-laisser' => array(
					'title' => 'le-fichier-quon-naurait-pas-du-laisser',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.858 — question d’examen, en anglais] Suppose the foo function is as follows: void foo(char *buf) { char tmp[200]; // assume compiler places "tmp" on the stack // copy from buf to tmp int i = 0; // assume compiler places "i" in a register while (buf[i] != 0) { tmp[i] = buf[i]; i++; } } Which of the following are true? Assume there is an unmapped page both above and below the stack in the process\'s virtual memory — An adversary can prevent the program from printing “Hello world” on a system using Baggy bounds checking with slot_size=16. (Stack grows down.)', 'mode' => 'choice', 'choices' => array('True', 'False'), 'correct' => 1, 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : The argument buf points to a string that is at most 255 bytes long, since fgets NULL-terminates the buffer. Baggy enforces a power-of-2 allocation bound for tmp, which ends up being 256 bytes.', 'source' => 'MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 — quiz d\'examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0'),
						),
					),
				),
				'le-reseau-qui-parle-trop' => array(
					'title' => 'le-reseau-qui-parle-trop',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.858 — question d’examen, en anglais] According to Mark Silis, if a firewall was deployed at MIT, would it make the following system less vulnerable to attacks, more vulnerable to attacks, or the same? Circle the best answer for each question. — MIT’s building control systems, in the context of remote buffer overﬂow attacks.', 'mode' => 'choice', 'choices' => array('Just as vulnerable.', 'More vulnerable.', 'Less vulnerable.'), 'correct' => 2, 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : The firewall makes it more difficult for outside adversaries to connect to vulnerable building control systems.', 'source' => 'MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 — quiz d\'examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0'),
						),
					),
				),
				'le-service-qui-ne-repond-plus' => array(
					'title' => 'le-service-qui-ne-repond-plus',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.858 — question d’examen, en anglais] Suppose the foo function is as follows: void foo(char *buf) { char tmp[200]; // assume compiler places "tmp" on the stack // copy from buf to tmp int i = 0; // assume compiler places "i" in a register while (buf[i] != 0) { tmp[i] = buf[i]; i++; } } Which of the following are true? Assume there is an unmapped page both above and below the stack in the process\'s virtual memory — An adversary can trick the program to delete ﬁles on a system using Baggy bounds checking with slot_size=16. (Stack grows down.)', 'mode' => 'choice', 'choices' => array('False', 'True'), 'correct' => 0, 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : Baggy will prevent memory writes to tmp from overflowing to the return address or any other stack variable.', 'source' => 'MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 — quiz d\'examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0'),
						),
					),
				),
				'le-top-10-owasp-et-la-surface-dattaque' => array(
					'title' => 'le-top-10-owasp-et-la-surface-dattaque',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.858 — question d’examen, en anglais] According to Mark Silis, if a firewall was deployed at MIT, would it make the following system less vulnerable to attacks, more vulnerable to attacks, or the same? Circle the best answer for each question. — MIT’s web servers, in the context of DDoS attacks.', 'mode' => 'choice', 'choices' => array('More vulnerable.', 'Less vulnerable.', 'Just as vulnerable.'), 'correct' => 0, 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : The firewall itself may be unable to deal with a large volume of traffic from a DDoS attack, even if the web servers are able to deal with that traffic.', 'source' => 'MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 — quiz d\'examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0'),
						),
					),
				),
				'les-fondamentaux-du-reseau' => array(
					'title' => 'les-fondamentaux-du-reseau',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.858 — question d’examen, en anglais] According to Mark Silis, if a firewall was deployed at MIT, would it make the following system less vulnerable to attacks, more vulnerable to attacks, or the same? Circle the best answer for each question. — MIT’s domain name, in the context of attacks like the hijacking in January 2013.', 'mode' => 'choice', 'choices' => array('Less vulnerable.', 'Just as vulnerable.', 'More vulnerable.'), 'correct' => 1, 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : The hijacking attack did not involve MIT\'s network at all; it took place at the EDUCAUSE registrar.', 'source' => 'MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 — quiz d\'examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0'),
						),
					),
				),
				'memoire-et-defenses' => array(
					'title' => 'memoire-et-defenses',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.858 — question d’examen, en anglais] Suppose the foo function is as follows: struct request { void (*f)(void); // function pointer char path[240]; }; void foo(char *buf) { struct request r; r.f = /* some legitimate function */; strcpy(r.path, buf); r.f(); } Which of the following are true? — An adversary can trick the program to delete ﬁles on a system using Baggy bounds checking with slot_size=16. Assume strcpy is compiled with Baggy. (Stack grows down.)', 'mode' => 'choice', 'choices' => array('False', 'True'), 'correct' => 0, 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : Baggy bounds checking will prevent strcpy from going past r\'s allocation bounds, and r.f is before r.path in r\'s memory layout.', 'source' => 'MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 — quiz d\'examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0'),
						),
					),
				),
				'penser-comme-un-defenseur' => array(
					'title' => 'penser-comme-un-defenseur',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.858 — question d’examen, en anglais] Suppose the foo function is as follows: struct request { void (*f)(void); // function pointer char path[240]; }; void foo(char *buf) { struct request r; r.f = /* some legitimate function */; strcpy(r.path, buf); r.f(); } Which of the following are true? — An adversary can trick the program to delete ﬁles on a system where the stack grows up.', 'mode' => 'choice', 'choices' => array('True', 'False'), 'correct' => 0, 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : The adversary can overwrite strcpy\'s return address on the stack.', 'source' => 'MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 — quiz d\'examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0'),
						),
					),
				),
				'qui-a-force-la-porte' => array(
					'title' => 'qui-a-force-la-porte',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.858 — question d’examen, en anglais] Suppose the foo function is as follows: void foo(char *buf) { char tmp[200]; // assume compiler places "tmp" on the stack // copy from buf to tmp int i = 0; // assume compiler places "i" in a register while (buf[i] != 0) { tmp[i] = buf[i]; i++; } } Which of the following are true? Assume there is an unmapped page both above and below the stack in the process\'s virtual memory — An adversary can prevent the program from printing “Hello world” on a system using terminator stack canaries for return addresses. (Stack grows down.)', 'mode' => 'choice', 'choices' => array('True', 'False'), 'correct' => 0, 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : The adversary could simply overwrite the canary value, which will terminate the program as foo returns.', 'source' => 'MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 — quiz d\'examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0'),
						),
					),
				),
				'securiser-une-application-web' => array(
					'title' => 'securiser-une-application-web',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.858 — question d’examen, en anglais] The tool would report a potential error/warning in the following code: function check_arg($n) { $v = $_GET[$n]; return isnumeric($v); } $x = $_GET[’id’]; if (check_arg(’id’)) { mysql_query("SELECT .. $x"); }', 'mode' => 'choice', 'choices' => array('False', 'True'), 'correct' => 1, 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : The summary for check_arg() indicates that $_GET[⊥] is sanitized if the return value is true, but the call to mysql_query() requires $_GET[id] to be sanitized.', 'source' => 'MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 — quiz d\'examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0'),
						),
					),
				),
				'traverser-le-mur' => array(
					'title' => 'traverser-le-mur',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.858 — question d’examen, en anglais] Suppose the foo function is as follows: void foo(char *buf) { char tmp[200]; // assume compiler places "tmp" on the stack // copy from buf to tmp int i = 0; // assume compiler places "i" in a register while (buf[i] != 0) { tmp[i] = buf[i]; i++; } } Which of the following are true? Assume there is an unmapped page both above and below the stack in the process\'s virtual memory — An adversary can trick the program to delete ﬁles on a system using terminator stack canaries for return addresses. (Stack grows down.)', 'mode' => 'choice', 'choices' => array('False', 'True'), 'correct' => 0, 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : A terminator stack canary includes a NULL byte, and if the adversary overwrites the return address on the stack, the canary value will necessarily not contain any NULL bytes (since otherwise the while loop would have exited).', 'source' => 'MIT OpenCourseWare, 6.858 Computer Systems Security, Fall 2014 — quiz d\'examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0'),
						),
					),
				),
			),
		);
	}
}
