<?php
/**
 * Questions importees — MIT OpenCourseWare — 6 7220j nonlinear optimization spring 2025
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.7220j Nonlinear Optimization, Spring 2025 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_7220j_examens' ) ) {
	function seca_import_mit_ocw_6_7220j_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-7220j-examens', 'nom' => 'MIT OpenCourseWare — 6 7220j nonlinear optimization spring 2025', 'url' => 'https://ocw.mit.edu/courses/6-7220j-nonlinear-optimization-spring-2025/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.7220j Nonlinear Optimization, Spring 2025 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.7220J — question d’examen, en anglais]
Existence and uniqueness of Euclidean projections
Let Ω ⊆ ℝ𝑛 be a nonempty set.
[7pts] Give a formal argument as to why, when Ω is closed and convex, the Euclidean projection
of any point 𝑥 ∈ ℝ𝑛 exists and is unique. As a reminder, the Euclidean projection of 𝑥 is a', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Existence: we choose a point 𝑦0 ∈ Ω and define Ω0 = Ω ∩ {𝑦 : ‖𝑥 − 𝑦‖2 ≤ ‖𝑥 − 𝑦0 ‖2 }. It’s
clear that for any point 𝑦 outside Ω0 , 𝑦 cannot be the minimizer of the projection problem.
Therefore, we can restrict the minimization of ‖𝑦 − 𝑥‖2 to Ω0 , and the Weierstrass Theorem
guarantees the existence of a minimizer.
Uniqueness: let 𝑧 be one of the minimizers of the problem. The first-order optimality
condition at 𝑧 reads
⟨𝑥 − 𝑧, 𝑦 − 𝑧⟩ ≤ 0      ∀𝑦 ∈ Ω.
For any 𝑦 ≠ 𝑧,
‖𝑥 − 𝑦‖22 = ‖𝑥 − 𝑧 + (𝑧 − 𝑦)‖22 = ‖𝑥 − 𝑧‖22 + ‖𝑧 − 𝑦‖22 − 2⟨𝑥 − 𝑧, 𝑦 − 𝑧⟩ > ‖𝑥 − 𝑧‖22 .
Therefore, the projection is unique.', 'source' => 'MIT OpenCourseWare, 6.7220j Nonlinear Optimization, Spring 2025 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.7220j Nonlinear Optimization, Spring 2025 — examen et corrigé officiel (MIT EECS)', 'choices' => array('L\'inverse de to the nonlinear optimization problem
min ‖𝑦 − 𝑥‖2
𝑦
s.t. 𝑦 ∈ ω.', 'Impossible à déterminer', 'Pas to the nonlinear optimization problem
min ‖𝑦 − 𝑥‖2
𝑦
s.t. 𝑦 ∈ ω.', 'to the nonlinear optimization problem
min ‖𝑦 − 𝑥‖2
𝑦
s.t. 𝑦 ∈ Ω.'), 'correct' => 3, 'answer' => 'to the nonlinear optimization problem
min ‖𝑦 − 𝑥‖2
𝑦
s.t. 𝑦 ∈ Ω.', '_recupere_le' => '2026-11-04T19:55:22.757964+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.7220J — question d’examen, en anglais]
Existence and uniqueness of Euclidean projections
Let Ω ⊆ ℝ𝑛 be a nonempty set.
[7pts] If the assumption of convexity is removed, is the existence of a projection still guaranteed?
For those cases in which a projection exists, is such a projection still guaranteed to be unique?
For each, give either a proof or a counterexample.
(Remember: a set is closed if “it contains its boundary”, that is, the limit of any converging sequence
of points that belong to the set belongs to the set. For example, the interval [1, 2] ≔ {𝑥 ∈ ℝ : 1 ≤ 𝑥 ≤
2} is a closed set, while the interval (1, 2] ≔ {𝑥 ∈ ℝ : 1 < 𝑥 ≤ 2} is not. You can take for granted that
the union of two closed sets is closed.)', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Yes. The existence argument, which is based on the Weierstrass theorem, does not require
convexity, only closedness. So, the existence of a projection is guaranteed even for nonconvex
feasible sets Ω. However, uniqueness is not guaranteed. For example, consider projecting the
origin 𝑥 = (0, 0) onto the circle

[Correction officielle MIT : [MIT 6.7220J — question d’examen, en anglais]
Existence and uniqueness of Euclidean projections
Let Ω ⊆ ℝ𝑛 be a nonempty set.
[7pts] If the assumption of convexity is removed, is the existence of a projection still guaranteed?
For those cases in which a projection exists, is such a projection still guaranteed to be unique?
For each, give either a proof or a counterexample.
(Remember: a set is closed if “it contains its boundary”, that is, the limit of any converging sequence
of points that belong to the set belongs to the set. For example, the interval [1, 2] ≔ {𝑥 ∈ ℝ : 1 ≤ 𝑥 ≤
2} is a closed set, while the interval (1, 2] ≔ {𝑥 ∈ ℝ : 1 < 𝑥 ≤ 2} is not. You can take for granted that
the union of two closed sets is closed.)]', 'source' => 'MIT OpenCourseWare, 6.7220j Nonlinear Optimization, Spring 2025 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.7220j Nonlinear Optimization, Spring 2025 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 6.7220J — question d’examen, en anglais]
Existence and uniqueness of Euclidean projections
Let Ω ⊆ ℝ𝑛 be a nonempty set.
[7pts] If the assumption of convexity is removed, is the existence of a projection still guaranteed?
For those cases in which a projection exists, is such a projection still guaranteed to be unique?
For each, give either a proof or a counterexample.
(Remember: a set is closed if “it contains its boundary”, that is, the limit of any converging sequence
of points that belong to the set belongs to the set. For example, the interval [1, 2] ≔ {𝑥 ∈ ℝ : 1 ≤ 𝑥 ≤
2} is a closed set, while the interval (1, 2] ≔ {𝑥 ∈ ℝ : 1 < 𝑥 ≤ 2} is not. You can take for granted that
the union of two closed sets is closed.)', '_recupere_le' => '2026-11-04T19:55:22.758237+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Yes. The existence argument, which is based on the Weierstrass theorem, does not require
convexity, only closedness. So, the existence of a projection is guaranteed even for')),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.7220J — question d’examen, en anglais]
Existence and uniqueness of Euclidean projections
Let Ω ⊆ ℝ𝑛 be a nonempty set.
[7pts] If the assumption of closedness is removed, is the existence of a projection still guaran-
teed? For those cases in which a projection exists, is such a projection still guaranteed to be
unique? For each, give either a proof or a counterexample.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : No, existence is not guaranteed anymore if the assumption of closedness is removed. For
example, consider projecting the point 0 onto the open interval (1, 2) ⊂ ℝ. The projection
problem has no solution, since for any candidate solution point 𝑦 ∈ (1, 2), the point
𝑦−1
𝑦′ ≔ 1 +
2
belongs to (1, 2) and achieves a strictly lower objective. However, in those cases where a
projection does exist, then the projection would be unique, again by the proof of uniqueness
in (a) (the uniqueness argument does not depend on closedness).

[Correction officielle MIT : [MIT 6.7220J — question d’examen, en anglais]
Existence and uniqueness of Euclidean projections
Let Ω ⊆ ℝ𝑛 be a nonempty set.
[7pts] If the assumption of closedness is removed, is the existence of a projection still guaran-
teed? For those cases in which a projection exists, is such a projection still guaranteed to be
unique? For each, give either a proof or a counterexample.]', 'source' => 'MIT OpenCourseWare, 6.7220j Nonlinear Optimization, Spring 2025 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.7220j Nonlinear Optimization, Spring 2025 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 6.7220J — question d’examen, en anglais]
Existence and uniqueness of Euclidean projections
Let Ω ⊆ ℝ𝑛 be a nonempty set.
[7pts] If the assumption of closedness is removed, is the existence of a projection still guaran-
teed? For those cases in which a projection exists, is such a projection still guaranteed to be
unique? For each, give either a proof or a counterexample.', '_recupere_le' => '2026-11-04T19:55:22.758376+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : No, existence is not guaranteed anymore if the assumption of closedness is removed. For
example, consider projecting the point 0 onto the open interval (1, 2) ⊂ ℝ. The projec')),
						),
					),
				),
			),
		);
	}
}
