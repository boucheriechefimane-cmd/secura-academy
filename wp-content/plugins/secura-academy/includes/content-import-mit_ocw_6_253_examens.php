<?php
/**
 * Questions importees — MIT OpenCourseWare — 6.253 Convex Analysis and Optimization (Spring 2012)
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_253_examens' ) ) {
	function seca_import_mit_ocw_6_253_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-253-examens', 'nom' => 'MIT OpenCourseWare — 6.253 Convex Analysis and Optimization (Spring 2012)', 'url' => 'https://ocw.mit.edu/courses/6-253-convex-analysis-and-optimization-spring-2012/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.253 — question d’examen, en anglais]
Show that the intersection ∩i∈I Ci of a collection {Ci | i ∈ I} of cones is a cone.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let x ∈ ∩i∈I Ci and let α be a positive scalar. Since x ∈ Ci for all i ∈ I and each Ci is
a cone, the vector αx belongs to Ci for all i ∈ I. Hence, αx ∈ ∩i∈I Ci , showing that ∩i∈I Ci is a cone.', 'source' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012'),
							array('question' => '[MIT 6.253 — question d’examen, en anglais]
Show that the vector sum C1 + C2 of two cones C1 and C2 is a cone.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let x ∈ C1 + C2 and let α be a positive scalar. Then, x = x1 + x2 for some x1 ∈ C1 and
x2 ∈ C2 , and since C1 and C2 are cones, αx1 ∈ C1 and αx2 ∈ C2 . Hence, αx = αx1 +αx2 ∈ C1 +C2 ,
1
showing that C1 + C2 is a cone.', 'source' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012'),
							array('question' => '[MIT 6.253 — question d’examen, en anglais]
Let X be a nonempty bounded subset of Rn . Show that
                                    cl(conv(X)) = conv(cl(X)).
In particular, if X is compact, then conv(X) is compact.

                                                  1', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The set cl(X) is compact since X is bounded by assumption. Hence, its convex hull, conv(cl(X)),
is compact, and it follows that
cl(conv(X)) ⊂ cl(conv(cl(X))) = conv(cl(X)).
It is also true that
conv(cl(X)) ⊂ conv(cl(conv(X))) = cl(conv(X)),
since, the closure of a convex set is convex. Hence, the result follows.
3', 'source' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012'),
							array('question' => '[MIT 6.253 — question d’examen, en anglais]
Show that if C1 and C2 are nonempty closed convex sets, we have
C1 ⊂ C2 ,
if and only if
σC1 (y) ≤ σC2 (y),               ∀ y ∈ Rn .
Construct an example showing that closedness of C1 and C2 is a necessary assumption.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Consider the indicator functions δC1 and δC2 of C1 and C2 . We have
C1 ⊂ C2       if and only if             δC1 (x) ≥ δC2 (x),   ∀ x ∈ Rn .
Since σC1 and σC2 are the conjugates of δC1 and δC2 , respectively, the result follows from part (a).
To see that the assumption of closedness of C1 and C2 is needed, consider two convex sets that
have the same closure, but none of the two is contained in the other, such as for example (0, 1] and
[0, 1).
2', 'source' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012'),
							array('question' => '[MIT 6.253 — question d’examen, en anglais]
Consider the problem
minimize       f (x) = 10x1 + 3x2
x
subject to 5x1 + x2 ≥ 4, x1 , x2 = 0 or 1,', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : To each of these 4 points we add the ﬁrst orphant and we get the M     ¯ set.
5', 'source' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012'),
							array('question' => '[MIT 6.253 — question d’examen, en anglais]
Let C be a nonempty convex set in Rn , and let M be a nonempty aﬃne set in Rn . Show that
M ∩rin(C) = ∅ is a necessary and suﬃcient condition for the existence of a hyperplane H containing
M , and such that rin(C) is contained in one of the open halfspaces associated with H.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If there exists a hyperplane H with the properties stated, the condition M ∩ rin(C) = ∅ clearly
holds. Conversely, if M ∩ rin(C) = ∅, then M and C can be properly separated. This hyperplane
can be chosen to contain M since M is aﬃne. If this hyperplane contains a point in rin(C), then it
must contain all of C. This contradicts the proper separation property, thus showing that rin(C)
is contained in one of the open halfspaces.
2', 'source' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012'),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.253 — question d’examen, en anglais]
Show that the image and the inverse image of a cone under a linear transformation is a cone.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : First we prove that A · C is a cone, where A is a linear transformation and A · C is the image
of C under A. Let z ∈ A · C and let α be a positive scalar. Then, Ax = z for some x ∈ C, and
since C is a cone, αx ∈ C. Because A(αx) = αz, the vector αz is in A · C, showing that A · C is a
cone.
Next we prove that the inverse image A−1 · C of C under A is a cone. Let x ∈ A−1 · C and let α
be a positive scalar. Then Ax ∈ C, and since C is a cone, αAx ∈ C. Thus, the vector A(αx) ∈ C,
implying that αx ∈ A−1 · C, and showing that A−1 · C is a cone.', 'source' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012'),
							array('question' => '[MIT 6.253 — question d’examen, en anglais]
Show that a subset C is a convex cone if and only if it is closed under addition and positive
scalar multiplication, i.e., C + C ⊂ C, and γC ⊂ C for all γ > 0.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let C be a convex cone. Then γC ⊂ C, for all γ > 0, by the deﬁnition of cone. Furthermore,
by convexity of C, for all x, y ∈ C, we have z ∈ C, where
1
z = (x + y).
2
Hence (x + y) = 2z ∈ C, since C is a cone, and it follows that C + C ⊂ C.
Conversely, assume that C + C ⊂ C, and γC ⊂ C. Then C is a cone. Furthermore, if x, y ∈ C
and α ∈ (0, 1), we have αx ∈ C and (1 − α)y ∈ C, and αx + (1 − α)y ∈ C (since C + C ⊂ C).
Hence C is convex.', 'source' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012'),
							array('question' => '[MIT 6.253 — question d’examen, en anglais]
Construct an example of a point in a nonconvex set X that has the prolongation property, but is
not a relative interior point of X.




                                              2





6.253 Convex Analysis and Optimization
Spring 2012



For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Take two intersecting lines in the plane, and consider the point of intersection.
4
6.253 Convex Analysis and Optimization
Spring 2012
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012'),
							array('question' => '[MIT 6.253 — question d’examen, en anglais]
Consider the problem
minimize       f (x) = 10x1 + 3x2
x
subject to 5x1 + x2 ≥ 4, x1 , x2 = 0 or 1,
Sketch the set of constraint-cost pairs {(4 − 5x1 − x2 , 10x1 + 3x2 )|x1 , x2 = 0 or 1}.
(b)Describe the corresponding MC/MC framework as per Section 4.2.3.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The set of constraint-cost pairs contains 4 points: (-2,13), (-1,10), (3,3), (4,0).', 'source' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012'),
							array('question' => '[MIT 6.253 — question d’examen, en anglais]
Consider the problem
minimize       f (x) = 10x1 + 3x2
x
subject to 5x1 + x2 ≥ 4, x1 , x2 = 0 or 1,
Solve the problem and its dual, and relate the solutions to your sketch in part (a).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The primal optimal solution is x∗ = (1, 0) and the primal optimal cost is p∗ = 10. The dual
function is easily found to be:
⎧
⎨4µ
⎪            if µ ≤ 2,
q(µ) = 10 − µ       if 2 ≤ µ ≤ 3,
⎪
13 − 2µ if 3 ≤ µ.
⎩
Therefore q ∗ = 8. This is the intersection of the line segment connecting the points (4,0), (-1,10)
with the y-axis.
6
6.253 Convex Analysis and Optimization
Spring 2012
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.253 Convex Analysis and Optimization, Spring 2012'),
						),
					),
				),
			),
		);
	}
}
