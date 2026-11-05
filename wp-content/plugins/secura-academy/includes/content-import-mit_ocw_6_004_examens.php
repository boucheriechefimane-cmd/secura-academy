<?php
/**
 * Questions importees — MIT OpenCourseWare — 6.004 Computation Structures (Spring 2009)
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.004 Computation Structures, Spring 2009 — quiz d’examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_004_examens' ) ) {
	function seca_import_mit_ocw_6_004_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-004-examens', 'nom' => 'MIT OpenCourseWare — 6.004 Computation Structures (Spring 2009)', 'url' => 'https://ocw.mit.edu/courses/6-004-computation-structures-spring-2009/pages/exams/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.004 Computation Structures, Spring 2009 — quiz d’examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.004 — question d’examen, en anglais]

You are trying to guess a card picked at random from a standard 52-card deck. Sam tells
you the card is a spade; Nora tells you it\'s not an ace; Rita tells you it\'s a seven.
What is the total amount of information about the card given by Sam, Nora, and
Rita? You may give your', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Réponse officielle du MIT pour « Bits of info (number or formula) » : log 2 (52). C\'est la valeur que le corrigé officiel du MIT inscrit dans le blanc de cette question.', 'source' => 'MIT OpenCourseWare, 6.004 Computation Structures, Spring 2009 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'choices' => array('Impossible à déterminer', 'Pas as either a number or a formula.
bits of info (number or formula):', 'L\'inverse de as either a number or a formula.
bits of info (number or formula):', 'as either a number or a formula.
Bits of info (number or formula):'), 'correct' => 3, 'answer' => 'as either a number or a formula.
Bits of info (number or formula):', '_recupere_le' => '2026-11-04T19:55:22.636682+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.004 — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Réponse officielle du MIT pour « Throughput (ns-1) » : 1/3. C\'est la valeur que le corrigé officiel du MIT inscrit dans le blanc de cette question.', 'source' => 'MIT OpenCourseWare, 6.004 Computation Structures, Spring 2009 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'choices' => array('A complex combinational circuit is constructed entirely from 2-input NAND gates
having a propagation delay of 1 ns. If this circuit is pipelined for maximal
throughput by adding registers whose setup time and propagation delay are each 1 ns,
what is the throughput of the resulting pipeline? Enter a number, a formula, or
"CAN\'T TELL".
Throughput (ns-1):', 'L\'inverse de a complex combinational circuit is constructed entirely from 2-input nand gates
having a propagation delay of 1 ns. if this circuit is pipelined for maximal
throughput by adding registers whose setup time and propagation delay are each 1 ns,
what is the throughput of the resulting pipeline? enter a number, a formula, or
"can\'t tell".
throughput (ns-1):', 'Pas a complex combinational circuit is constructed entirely from 2-input nand gates
having a propagation delay of 1 ns. if this circuit is pipelined for maximal
throughput by adding registers whose setup time and propagation delay are each 1 ns,
what is the throughput of the resulting pipeline? enter a number, a formula, or
"can\'t tell".
throughput (ns-1):', 'Impossible à déterminer'), 'correct' => 0, 'answer' => 'A complex combinational circuit is constructed entirely from 2-input NAND gates
having a propagation delay of 1 ns. If this circuit is pipelined for maximal
throughput by adding registers whose setup time and propagation delay are each 1 ns,
what is the throughput of the resulting pipeline? Enter a number, a formula, or
"CAN\'T TELL".
Throughput (ns-1):', '_recupere_le' => '2026-11-04T19:55:22.636839+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.004 — question d’examen, en anglais]

Can every SUBC instruction be replaced by an equivalent ADDC instruction with the
constant negated? If so,', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Réponse officielle du MIT pour « SUBC(…) instruction, or “YES” » : SUBC(Ra, 0x8000, Rc). C\'est la valeur que le corrigé officiel du MIT inscrit dans le blanc de cette question.', 'source' => 'MIT OpenCourseWare, 6.004 Computation Structures, Spring 2009 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'choices' => array('Pas "yes"; if not, give an example of a subc
instruction that can\'t be replaced by an addc.
subc(...) instruction, or "yes":', '"YES"; if not, give an example of a SUBC
instruction that can\'t be replaced by an ADDC.
SUBC(...) instruction, or "YES":', 'Impossible à déterminer', 'L\'inverse de "yes"; if not, give an example of a subc
instruction that can\'t be replaced by an addc.
subc(...) instruction, or "yes":'), 'correct' => 1, 'answer' => '"YES"; if not, give an example of a SUBC
instruction that can\'t be replaced by an ADDC.
SUBC(...) instruction, or "YES":', '_recupere_le' => '2026-11-04T19:55:22.636962+00:00Z', '_strategie' => 'separation_enum_solution'),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.004 — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Réponse officielle du MIT pour « 4-bit 2’s complement representation of -6 » : 1010. C\'est la valeur que le corrigé officiel du MIT inscrit dans le blanc de cette question.', 'source' => 'MIT OpenCourseWare, 6.004 Computation Structures, Spring 2009 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'choices' => array('Impossible à déterminer', 'L\'inverse de give the four-bit two\'s complement representation of -6.
4-bit 2\'s complement representation of -6:', 'Pas give the four-bit two\'s complement representation of -6.
4-bit 2\'s complement representation of -6:', 'Give the four-bit two\'s complement representation of -6.
4-bit 2\'s complement representation of -6:'), 'correct' => 3, 'answer' => 'Give the four-bit two\'s complement representation of -6.
4-bit 2\'s complement representation of -6:', '_recupere_le' => '2026-11-04T19:55:22.637034+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.004 — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Réponse officielle du MIT pour « 16-bit offset portion of above BEQ instruction » : 0x0000. C\'est la valeur que le corrigé officiel du MIT inscrit dans le blanc de cette question.', 'source' => 'MIT OpenCourseWare, 6.004 Computation Structures, Spring 2009 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'choices' => array('What value will be found in the low 16 bits of the BEQ instruction resulting from the
following assembly language snippet?
. = 0x100
BEQ(R31, target, R31)
target: ADDC(R31, 0, R31)
16-bit offset portion of above BEQ instruction:', 'L\'inverse de what value will be found in the low 16 bits of the beq instruction resulting from the
following assembly language snippet?
. = 0x100
beq(r31, target, r31)
target: addc(r31, 0, r31)
16-bit offset portion of above beq instruction:', 'Pas what value will be found in the low 16 bits of the beq instruction resulting from the
following assembly language snippet?
. = 0x100
beq(r31, target, r31)
target: addc(r31, 0, r31)
16-bit offset portion of above beq instruction:', 'Impossible à déterminer'), 'correct' => 0, 'answer' => 'What value will be found in the low 16 bits of the BEQ instruction resulting from the
following assembly language snippet?
. = 0x100
BEQ(R31, target, R31)
target: ADDC(R31, 0, R31)
16-bit offset portion of above BEQ instruction:', '_recupere_le' => '2026-11-04T19:55:22.637145+00:00Z', '_strategie' => 'separation_enum_solution'),
						),
					),
				),
			),
		);
	}
}
