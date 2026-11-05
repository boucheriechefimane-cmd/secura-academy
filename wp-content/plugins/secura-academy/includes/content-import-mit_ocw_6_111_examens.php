<?php
/**
 * Questions importees — MIT OpenCourseWare — 6.111 Introductory Digital Systems Laboratory (Spring 2006)
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_111_examens' ) ) {
	function seca_import_mit_ocw_6_111_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-111-examens', 'nom' => 'MIT OpenCourseWare — 6.111 Introductory Digital Systems Laboratory (Spring 2006)', 'url' => 'https://ocw.mit.edu/courses/6-111-introductory-digital-systems-laboratory-spring-2006/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.111 — question d’exercice, en anglais]
Counters
Using a 27MHz clock, how many 74LS163’s are required to produce a 1Hz
clock?
Hint: What is the binary representation of 27000000?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The Nth output of ripple counters has twice the time period of (N-1)th output, and
thus the Nth output of ripple counters is 2N slower than the input clock. Thus, to
create a 421.875kHz clock,
27 MHz
= 64 = 2 6
421.875kHz
we must divide the input clock by two for six times, requiring two 74LS163.
Cascade the two 4-bit counters as done in Lab 1 and probe at Qb of the second
counter as shown below:
CLR             VDD                       CLR             VDD
Oscillator                                   Oscillator
CLK             RCO                       CLK             RCO
@ 27 MHz                                     @ 27 MHz
Qa                                        Qa
421.875 kHz
Qb                                        Qb
74LS163                                   74LS163
Qc                                        Qc
Qd                                        Qd
ENT             ENP                       ENT             ENP
GND              LD                       GND              LD
Figure 1: 74LS163 connections to provide a 421.875kHz clock
6.111 Spring 2006 Problem Set 2                                                      2

[Correction officielle MIT : [MIT 6.111 — question d’exercice, en anglais]
Counters
Using a 27MHz clock, how many 74LS163’s are required to produce a 1Hz
clock?
Hint: What is the binary representation of 27000000?]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — question d’exercice, en anglais]
Counters
Using a 27MHz clock, how many 74LS163’s are required to produce a 1Hz
clock?
Hint: What is the binary representation of 27000000?', '_recupere_le' => '2026-11-04T19:55:22.728367+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The Nth output of ripple counters has twice the time period of (N-1)th output, and
thus the Nth output of ripple counters is 2N slower than the input clock. Thus, to
create a')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
a + 0 =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : a + 0 = a

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
a + 0 = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
a + 0 =', '_recupere_le' => '2026-11-04T19:55:22.728429+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : a + 0 = a

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it i')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
a (a + b) =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : a ( a + b) = a a + ab = ab

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
a (a + b) = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
a (a + b) =', '_recupere_le' => '2026-11-04T19:55:22.728486+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : a ( a + b) = a a + ab = ab

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to re')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
( a + b)( a + b) =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ( a + b)(a + b) = a a + ab + b a + bb = a + ab + ab = a (1 + b + b) = a

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
( a + b)( a + b) = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
( a + b)( a + b) =', '_recupere_le' => '2026-11-04T19:55:22.728545+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : ( a + b)(a + b) = a a + ab + b a + bb = a + ab + ab = a (1 + b + b) = a

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each ex')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
(12), (13), f ( a, b, c ) = a + b + c      24) w ⋅ (wxyz ) =
f ( a, b, ab ) =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : f ( a, b, ab ) = a + b + ab = a + b

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
(12), (13), f ( a, b, c ) = a + b + c      24) w ⋅ (wxyz ) =
f ( a, b, ab ) = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
(12), (13), f ( a, b, c ) = a + b + c      24) w ⋅ (wxyz ) =
f ( a, b, ab ) =', '_recupere_le' => '2026-11-04T19:55:22.728659+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : f ( a, b, ab ) = a + b + ab = a + b

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation.')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
f [a, b, (ab)] =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : f [ a, b, ( ab)] = a + b + ( ab) = a + b + a + b = 1

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
f [a, b, (ab)] = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
f [a, b, (ab)] =', '_recupere_le' => '2026-11-04T19:55:22.728721+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : f [ a, b, ( ab)] = a + b + ( ab) = a + b + a + b = 1

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebra')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
xy + x y =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : xy + x y = x( y + y ) = x

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
xy + x y = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
xy + x y =', '_recupere_le' => '2026-11-04T19:55:22.728777+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : xy + x y = x( y + y ) = x

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to rec')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
( w + x + y + z ) y =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ( w + x + y + z ) y = y

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
( w + x + y + z ) y = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
( w + x + y + z ) y =', '_recupere_le' => '2026-11-04T19:55:22.728836+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : ( w + x + y + z ) y = y

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recog')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
w + [ w + ( wx )] =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : w + [ w + ( wx )] = w

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
w + [ w + ( wx )] = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
w + [ w + ( wx )] =', '_recupere_le' => '2026-11-04T19:55:22.728894+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : w + [ w + ( wx )] = w

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recogni')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
w + ( w x yz ) =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : w + ( w x yz ) = w(1 + x yz ) = w

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
w + ( w x yz ) = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
w + ( w x yz ) =', '_recupere_le' => '2026-11-04T19:55:22.728958+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : w + ( w x yz ) = w(1 + x yz ) = w

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Tr')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
xz + x y + zy =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : xz + x y + zy = xz + x y

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
xz + x y + zy = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
xz + x y + zy =', '_recupere_le' => '2026-11-04T19:55:22.729015+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : xz + x y + zy = xz + x y

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to reco')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
x + y + xy z =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : x + y + xy z = x + y + z

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
x + y + xy z = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
x + y + xy z =', '_recupere_le' => '2026-11-04T19:55:22.729071+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : x + y + xy z = x + y + z

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to reco')),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
a ⋅ 0 =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : a ⋅ 0 = 0

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
a ⋅ 0 = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
a ⋅ 0 =', '_recupere_le' => '2026-11-04T19:55:22.729126+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : a ⋅ 0 = 0

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it i')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
ab + ab =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ab + ab = b( a + a ) = b

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
ab + ab = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
ab + ab =', '_recupere_le' => '2026-11-04T19:55:22.729180+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : ab + ab = b( a + a ) = b

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to reco')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
a ( a + b + c + ...) =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : a ( a + b + c + ...) = aa + ab + ac + ... = a + ab + ac + ... = a

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
a ( a + b + c + ...) = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
a ( a + b + c + ...) =', '_recupere_le' => '2026-11-04T19:55:22.729241+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : a ( a + b + c + ...) = aa + ab + ac + ... = a + ab + ac + ... = a

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expressi')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
f ( a, b, a ⋅ b) =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : f ( a, b, a ⋅ b) = a + b + ab = a + b + a = 1

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
f ( a, b, a ⋅ b) = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
f ( a, b, a ⋅ b) =', '_recupere_le' => '2026-11-04T19:55:22.729299+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : f ( a, b, a ⋅ b) = a + b + ab = a + b + a = 1

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic mani')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
y + y y =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : y + y y = y

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
y + y y = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
y + y y =', '_recupere_le' => '2026-11-04T19:55:22.729353+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : y + y y = y

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
x + y x =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : x + y x = x (1 + y ) = x

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
x + y x = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
x + y x =', '_recupere_le' => '2026-11-04T19:55:22.729407+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : x + y x = x (1 + y ) = x

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to reco')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
( x + y )( x + y ) =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ( x + y )( x + y ) = x

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
( x + y )( x + y ) = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
( x + y )( x + y ) =', '_recupere_le' => '2026-11-04T19:55:22.729468+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : ( x + y )( x + y ) = x

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recogn')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
x[ x + ( xy )] =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : x[ x + ( xy )] = x

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
x[ x + ( xy )] = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
x[ x + ( xy )] =', '_recupere_le' => '2026-11-04T19:55:22.729527+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : x[ x + ( xy )] = x

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
w ⋅ ( wxyz ) =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : w ⋅ ( wxyz ) = w( w + x + y + z ) = w

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
w ⋅ ( wxyz ) = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
w ⋅ ( wxyz ) =', '_recupere_le' => '2026-11-04T19:55:22.729584+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : w ⋅ ( wxyz ) = w( w + x + y + z ) = w

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation')),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
( x + z )( x + y )( z + y ) =', 'mode' => 'text', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ( x + z )( x + y )( z + y ) = ( x + z )( x + y )

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
( x + z )( x + y )( z + y ) = ]', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'answer' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
( x + z )( x + y )( z + y ) =', '_recupere_le' => '2026-11-04T19:55:22.729670+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : ( x + z )( x + y )( z + y ) = ( x + z )( x + y )

[Correction officielle MIT : [MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic m')),
						),
					),
				),
			),
		);
	}
}
