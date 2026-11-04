<?php
/**
 * Questions importees — MIT OpenCourseWare — 6 041sc probabilistic systems analysis and applied probability fall 2013
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.041sc Probabilistic Systems Analysis And Applied Probability, Fall 2013 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_041sc_examens' ) ) {
	function seca_import_mit_ocw_6_041sc_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-041sc-examens', 'nom' => 'MIT OpenCourseWare — 6 041sc probabilistic systems analysis and applied probability fall 2013', 'url' => 'https://ocw.mit.edu/courses/6-041sc-probabilistic-systems-analysis-and-applied-probability-fall-2013/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041sc Probabilistic Systems Analysis And Applied Probability, Fall 2013 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.041SC — question d’examen, en anglais] (5 points) Find E[N 2 ].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : E[N 2 ] = E[E[N 2 | Λ]] = E[var(N | Λ) + (E[N | Λ])2 ]
= E[Λ + Λ2 ]
= E[Λ] + var(Λ) + (E[Λ])2
1    2
=    + 2
2 2
= 1.', 'source' => 'MIT OpenCourseWare, 6.041sc Probabilistic Systems Analysis And Applied Probability, Fall 2013 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.041SC — question d’examen, en anglais] (5 points) Find the linear least squares estimator of Λ given N .
2
Massachusetts Institute of Technology
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Final Exam | Fall 2010)
Problem 1. (32 points) Consider a Markov chain {Xn ; n = 0, 1, . . .}, speciﬁed by the following
transition diagram.
0.6                0.5               0.9
0.4              0.3
1                 2              3
0.2             0.1', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : ˆ LLMS = E[Λ] + cov(N, Λ) (N − E[N ]).
Λ
var(N )
Solving for the above quantities:
1
E[Λ] =
2
1
E[N ] = E[E[N | Λ]] = E[Λ] = .
2
1   3
var(N ) = E[N 2 ] − (E[N ])2 = 1 −      2
= .
2   4
1
cov(N, Λ) = E[N Λ] − E[N ]E[Λ] = E[E[N Λ | Λ]] − (E[Λ])2 = E[Λ2 ] − (E[Λ])2 = var(Λ) = .
4
8
Massachusetts Institute of Technology
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
;&ŝŶĂůǆĂŵ^ŽůƵƚŝŽŶƐͮ&ĂůůϮϬϭϬͿ
Substituting these into the equation above:
cov(N, Λ)
Λ̂LLMS = E[Λ] +               (N − E[N ])
var(N )
�        �
1 1/4          1
=     +       N−
2 3/4          2
1
=     (N + 1) .', 'source' => 'MIT OpenCourseWare, 6.041sc Probabilistic Systems Analysis And Applied Probability, Fall 2013 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
						),
					),
				),
			),
		);
	}
}
