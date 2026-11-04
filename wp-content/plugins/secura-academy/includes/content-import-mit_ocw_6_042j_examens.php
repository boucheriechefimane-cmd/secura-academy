<?php
/**
 * Questions importees — MIT OpenCourseWare — 6.042J / 18.062J Mathematics for Computer Science (Fall 2010)
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.042J / 18.062J Mathematics for Computer Science, Fall 2010
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_042j_examens' ) ) {
	function seca_import_mit_ocw_6_042j_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-042j-examens', 'nom' => 'MIT OpenCourseWare — 6.042J / 18.062J Mathematics for Computer Science (Fall 2010)', 'url' => 'https://ocw.mit.edu/courses/6-042j-mathematics-for-computer-science-fall-2010/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.042J / 18.062J Mathematics for Computer Science, Fall 2010'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.042J — question d’examen, en anglais]
Consider the simple graph G given in ﬁgure 1.
Figure 1: Simple graph G
B
A                                                         C
D                                                         F
E
[4 pts] Give the diameter of G.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : [4 pts] Give the diameter of G.', 'source' => 'MIT OpenCourseWare, 6.042J / 18.062J Mathematics for Computer Science, Fall 2010', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.042J / 18.062J Mathematics for Computer Science, Fall 2010'),
							array('question' => '[MIT 6.042J — question d’examen, en anglais]
Consider the simple graph G given in ﬁgure 1.
Figure 1: Simple graph G
B
A                                                         C
D                                                         F
E
[4 pts] Give a coloring on G and show that it uses the smallest possible number of
colors.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : [4 pts] Give a coloring on G and show that it uses the smallest possible number of
colors.', 'source' => 'MIT OpenCourseWare, 6.042J / 18.062J Mathematics for Computer Science, Fall 2010', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.042J / 18.062J Mathematics for Computer Science, Fall 2010'),
							array('question' => '[MIT 6.042J — question d’examen, en anglais]
Consider the simple graph G given in ﬁgure 1.
Figure 1: Simple graph G
B
A                                                         C
D                                                         F
E
[4 pts] Give a list of edges reﬂecting the order in which one of the greedy algorithms
presented in class (i.e. in lecture, recitation, or the course text) would choose edges when
ﬁnding an MST on H.
Midterm                                                                            10', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : [4 pts] Give a list of edges reﬂecting the order in which one of the greedy algorithms
presented in class (i.e. in lecture, recitation, or the course text) would choose edges when
ﬁnding an MST on H.', 'source' => 'MIT OpenCourseWare, 6.042J / 18.062J Mathematics for Computer Science, Fall 2010', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.042J / 18.062J Mathematics for Computer Science, Fall 2010'),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.042J — question d’examen, en anglais]
Consider the simple graph G given in ﬁgure 1.
Figure 1: Simple graph G
B
A                                                         C
D                                                         F
E
[4 pts] Give a Hamiltonian Cycle on G.
Midterm                                                                              8', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : [4 pts] Give a Hamiltonian Cycle on G.', 'source' => 'MIT OpenCourseWare, 6.042J / 18.062J Mathematics for Computer Science, Fall 2010', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.042J / 18.062J Mathematics for Computer Science, Fall 2010'),
							array('question' => '[MIT 6.042J — question d’examen, en anglais]
Consider the simple graph G given in ﬁgure 1.
Figure 1: Simple graph G
B
A                                                         C
D                                                         F
E
[4 pts] Does G have an Eulerian cycle? Justify your answer.
Midterm                                                                                   9
Now consider graph H, which is like G but with weighted edges, in ﬁgure 2:
Figure 2: Weighted graph H
B
3                       2
A                                                        C
10
3                                         4
1
D                                                         F
E            3', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : [4 pts] Does G have an Eulerian cycle? Justify your answer.', 'source' => 'MIT OpenCourseWare, 6.042J / 18.062J Mathematics for Computer Science, Fall 2010', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.042J / 18.062J Mathematics for Computer Science, Fall 2010'),
						),
					),
				),
			),
		);
	}
}
