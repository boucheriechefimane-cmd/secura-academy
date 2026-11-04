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
Hint: What is the binary representation of 27000000?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The Nth output of ripple counters has twice the time period of (N-1)th output, and
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
6.111 Spring 2006 Problem Set 2                                                      2', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
a + 0 =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : a + 0 = a', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
a (a + b) =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : a ( a + b) = a a + ab = ab', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
( a + b)( a + b) =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ( a + b)(a + b) = a a + ab + b a + bb = a + ab + ab = a (1 + b + b) = a', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
(12), (13), f ( a, b, c ) = a + b + c      24) w ⋅ (wxyz ) =
f ( a, b, ab ) =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : f ( a, b, ab ) = a + b + ab = a + b', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
f [a, b, (ab)] =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : f [ a, b, ( ab)] = a + b + ( ab) = a + b + a + b = 1', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
xy + x y =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : xy + x y = x( y + y ) = x', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
( w + x + y + z ) y =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ( w + x + y + z ) y = y', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
w + [ w + ( wx )] =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : w + [ w + ( wx )] = w', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
w + ( w x yz ) =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : w + ( w x yz ) = w(1 + x yz ) = w', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
xz + x y + zy =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : xz + x y + zy = xz + x y', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
x + y + xy z =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : x + y + xy z = x + y + z', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
a ⋅ 0 =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : a ⋅ 0 = 0', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
ab + ab =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ab + ab = b( a + a ) = b', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
a ( a + b + c + ...) =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : a ( a + b + c + ...) = aa + ab + ac + ... = a + ab + ac + ... = a', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
f ( a, b, a ⋅ b) =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : f ( a, b, a ⋅ b) = a + b + ab = a + b + a = 1', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
y + y y =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : y + y y = y', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
x + y x =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : x + y x = x (1 + y ) = x', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
( x + y )( x + y ) =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ( x + y )( x + y ) = x', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
x[ x + ( xy )] =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : x[ x + ( xy )] = x', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
w ⋅ ( wxyz ) =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : w ⋅ ( wxyz ) = w( w + x + y + z ) = w', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
							array('question' => '[MIT 6.111 — exercice d’algebre booléenne, en anglais]
Simplify each expression by algebraic manipulation. Try to recognize when it is
( x + z )( x + y )( z + y ) =', 'mode' => 'solution', 'hint' => 'Question d’exercice du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ( x + z )( x + y )( z + y ) = ( x + z )( x + y )', 'source' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.111 Introductory Digital Systems Laboratory, Spring 2006'),
						),
					),
				),
			),
		);
	}
}
