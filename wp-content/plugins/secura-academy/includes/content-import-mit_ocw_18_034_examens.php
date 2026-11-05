<?php
/**
 * Questions importees — MIT OpenCourseWare — 18 034 honors differential equations spring 2009
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_18_034_examens' ) ) {
	function seca_import_mit_ocw_18_034_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-18-034-examens', 'nom' => 'MIT OpenCourseWare — 18 034 honors differential equations spring 2009', 'url' => 'https://ocw.mit.edu/courses/18-034-honors-differential-equations-spring-2009/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #1 Due by Friday, February 13, 2009, by NOON.
Suppose a function y = f (x) satisﬁes the differential equation dy = 4y sin 2x dx and the initial
condition y(π) = e. The purpose of this exercise is to ﬁnd y(π/6).
(a) Separate variables and integrate to obtain ln y = c − 2 cos 2x, y > 0. By use of the initial
condition show that c = 3, and then get y(π/6).
(b) The initial condition y(π) = e means that x = π corresponds to y = e. Likewise, x = π/6
corresponds to y = a, where a = y(π/6). Integrating between corresponding limits gives
� a       � π/6
dy
=        4 sin 2x dx.
e y       π
Evaluate the deﬁnite integrals and solve the resulting equation for a.
(c) If xdy + 3ydx = 0 and y(−π) = e you can’t ﬁnd y(π). Why not?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) y(π/6) = e2
(b) Same as part (a)
(c) Because dx
x is not integrable on any interval containing the point
x = 0.

[Correction officielle MIT : [MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #1 Due by Friday, February 13, 2009, by NOON.
Suppose a function y = f (x) satisﬁes the differential equation dy = 4y sin 2x dx and the initial
condition y(π) = e. The purpose of this exercise is to ﬁnd y(π/6).
(a) Separate variables and integrate to obtain ln y = c − 2 cos 2x, y > 0. By use of the initial
condition show that c = 3, and then get y(π/6).
(b) The initial condition y(π) = e means that x = π corresponds to y = e. Likewise, x = π/6
corresponds to y = a, where a = y(π/6). Integrating between corresponding limits gives
� a       � π/6
dy
=        4 sin 2x dx.
e y       π
Evaluate the deﬁnite integrals and solve the resulting equation for a.
(c) If xdy + 3ydx = 0 and y(−π) = e you can’t ﬁnd y(π). Why not?]', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #1 Due by Friday, February 13, 2009, by NOON.
Suppose a function y = f (x) satisﬁes the differential equation dy = 4y sin 2x dx and the initial
condition y(π) = e. The purpose of this exercise is to ﬁnd y(π/6).
(a) Separate variables and integrate to obtain ln y = c − 2 cos 2x, y > 0. By use of the initial
condition show that c = 3, and then get y(π/6).
(b) The initial condition y(π) = e means that x = π corresponds to y = e. Likewise, x = π/6
corresponds to y = a, where a = y(π/6). Integrating between corresponding limits gives
� a       � π/6
dy
=        4 sin 2x dx.
e y       π
Evaluate the deﬁnite integrals and solve the resulting equation for a.
(c) If xdy + 3ydx = 0 and y(−π) = e you can’t ﬁnd y(π). Why not?', '_recupere_le' => '2026-11-04T19:55:22.384286+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (a) y(π/6) = e2
(b) Same as part (a)
(c) Because dx
x is not integrable on any interval containing the point
x = 0.

[Correction officielle MIT : [MIT 18.034 — question d’exa')),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #1 Due by Friday, February 13, 2009, by NOON.
(a) Show that y1 (x) = 0 and y2 (x) = x3/2 are', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (b) Let c = sup{x : y(x) = 0}.
If c = +∞, then y = y1 . If c < +∞, then y(x) = 0 for x ≤ c
and y(x) = (x − c)3/2 for x > c by the separation of variables and
uniqueness.', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('Impossible à déterminer', 'L\'inverse de s for x ≥ 0 of the differential equation
y � = (3/2)y 1/3 .
(b) discuss that all nonnegative solutions of the differential equation in part (a) starting at (0, 0)
lie between two solutions y1 and y2 and that the solution
�
0              for x < c,
y(x) =           3/2
(x − c)        for x ≥ c
ﬁlls out the funnel between them.', 's for x ≥ 0 of the differential equation
y � = (3/2)y 1/3 .
(b) Discuss that all nonnegative solutions of the differential equation in part (a) starting at (0, 0)
lie between two solutions y1 and y2 and that the solution
�
0              for x < c,
y(x) =           3/2
(x − c)        for x ≥ c
ﬁlls out the funnel between them.', 'Pas s for x ≥ 0 of the differential equation
y � = (3/2)y 1/3 .
(b) discuss that all nonnegative solutions of the differential equation in part (a) starting at (0, 0)
lie between two solutions y1 and y2 and that the solution
�
0              for x < c,
y(x) =           3/2
(x − c)        for x ≥ c
ﬁlls out the funnel between them.'), 'correct' => 2, 'answer' => 's for x ≥ 0 of the differential equation
y � = (3/2)y 1/3 .
(b) Discuss that all nonnegative solutions of the differential equation in part (a) starting at (0, 0)
lie between two solutions y1 and y2 and that the solution
�
0              for x < c,
y(x) =           3/2
(x − c)        for x ≥ c
ﬁlls out the funnel between them.', '_recupere_le' => '2026-11-04T19:55:22.384506+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #7 (modiﬁed on April 13, 2009) Due by Friday, April 17, 2009, by NOON.
In many applications the input f and the output y are related by L2 y = L1 f , where L1 and L2
are linear differential operators.
(a) If Pj is the characteristic polynomial of Lj , j = 1, 2, show that
P2 (s)Y (s) = P1 (s)F (s) + P0 (s),
where P0 (s)is a polynomial depending on the initial conditions of both f and y.
(b) The null initial condition gives the transfer function W (s) = P1 (s)/P2 (s). If W (s) = Lw,
express y by the convolution theorem.
(c) We can have a function w as in part (b) only if the degree of P1 is less than that of P2 . Why?
What happens to the formula of part (b) if P1 = P2 ?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) ­
(b) Y (s) = PP12 ((ss)) F (s) = W (s)F (s).           y =w∗f
(c) Because W (s) → 0 as s → ∞.
If P1 = P2 then W (s) = 1 and w(t) = δ(t). So, y = f .

[Correction officielle MIT : [MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #7 (modiﬁed on April 13, 2009) Due by Friday, April 17, 2009, by NOON.
In many applications the input f and the output y are related by L2 y = L1 f , where L1 and L2
are linear differential operators.
(a) If Pj is the characteristic polynomial of Lj , j = 1, 2, show that
P2 (s)Y (s) = P1 (s)F (s) + P0 (s),
where P0 (s)is a polynomial depending on the initial conditions of both f and y.
(b) The null initial condition gives the transfer function W (s) = P1 (s)/P2 (s). If W (s) = Lw,
express y by the convolution theorem.
(c) We can have a function w as in part (b) only if the degree of P1 is less than that of P2 . Why?
What happens to the formula of part (b) if P1 = P2 ?]', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #7 (modiﬁed on April 13, 2009) Due by Friday, April 17, 2009, by NOON.
In many applications the input f and the output y are related by L2 y = L1 f , where L1 and L2
are linear differential operators.
(a) If Pj is the characteristic polynomial of Lj , j = 1, 2, show that
P2 (s)Y (s) = P1 (s)F (s) + P0 (s),
where P0 (s)is a polynomial depending on the initial conditions of both f and y.
(b) The null initial condition gives the transfer function W (s) = P1 (s)/P2 (s). If W (s) = Lw,
express y by the convolution theorem.
(c) We can have a function w as in part (b) only if the degree of P1 is less than that of P2 . Why?
What happens to the formula of part (b) if P1 = P2 ?', '_recupere_le' => '2026-11-04T19:55:22.384810+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (a) ­
(b) Y (s) = PP12 ((ss)) F (s) = W (s)F (s).           y =w∗f
(c) Because W (s) → 0 as s → ∞.
If P1 = P2 then W (s) = 1 and w(t) = δ(t). So, y = f .

[Correction officie')),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #7 (modiﬁed on April 13, 2009) Due by Friday, April 17, 2009, by NOON.
Consider the system of differential equations Y � = AY , where
�                 �         �                 �
y11 (t) y12 (t)             a11 (t) a12 (t)
Y =                      ,    A=                     .
y21 (t) y22 (t)             a21 (t) a22 (t)
(a) If U (t) is a fundamental', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) (U C)� = U � C = (AU )C = A(U C) and |U C| = |U ||C| =
� 0
(b) V (t0 ) is a non-singular matrix.
(c) Let Y = (y�1 y�2 ).
|Y |� = |y�1 � y�2 | + |y�1 y�2 � |
= |Ay�1 y�2 | + |y�1 Ay�2 |
= D1 + D2 = (a11 + a22 )|Y |.    Liouviue’s theorem.', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('Impossible à déterminer', 'L\'inverse de and c is a nonsingular matrix, show that u c is also a funda­
mental solution.
(b) if v (t) is a fundamental solution, show that u (t) = v (t)v (t0 )−1 satisﬁes u (t0 ) = i and is also
a fundamental solution.
(c) show that |y |� = d1 + d2 , where
�                                    �
�a11 y11 + a12 y21 a11 y12 + a12 y22 �
d1 = � �                                    � = a11 |y |
y21               y22        �
and d2 = a22 |y |. deduce the liouville theorem.', 'and C is a nonsingular matrix, show that U C is also a funda­
mental solution.
(b) If V (t) is a fundamental solution, show that U (t) = V (t)V (t0 )−1 satisﬁes U (t0 ) = I and is also
a fundamental solution.
(c) Show that |Y |� = D1 + D2 , where
�                                    �
�a11 y11 + a12 y21 a11 y12 + a12 y22 �
D1 = � �                                    � = a11 |Y |
y21               y22        �
and D2 = a22 |Y |. Deduce the Liouville theorem.', 'Pas and c is a nonsingular matrix, show that u c is also a funda­
mental solution.
(b) if v (t) is a fundamental solution, show that u (t) = v (t)v (t0 )−1 satisﬁes u (t0 ) = i and is also
a fundamental solution.
(c) show that |y |� = d1 + d2 , where
�                                    �
�a11 y11 + a12 y21 a11 y12 + a12 y22 �
d1 = � �                                    � = a11 |y |
y21               y22        �
and d2 = a22 |y |. deduce the liouville theorem.'), 'correct' => 2, 'answer' => 'and C is a nonsingular matrix, show that U C is also a funda­
mental solution.
(b) If V (t) is a fundamental solution, show that U (t) = V (t)V (t0 )−1 satisﬁes U (t0 ) = I and is also
a fundamental solution.
(c) Show that |Y |� = D1 + D2 , where
�                                    �
�a11 y11 + a12 y21 a11 y12 + a12 y22 �
D1 = � �                                    � = a11 |Y |
y21               y22        �
and D2 = a22 |Y |. Deduce the Liouville theorem.', '_recupere_le' => '2026-11-04T19:55:22.385205+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #7 (modiﬁed on April 13, 2009) Due by Friday, April 17, 2009, by NOON.
Solve the initial value problem
� � �      �� �                  �         � � �
d y1     1 4   y1                      y1 (0)   0
=          ,                           =
dt y2    2 −1  y2                      y2 (0)   3
(a) by using the eigenvalues and (b) by using the Laplace transform.
(c) For which values of a and b, the', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) c1 e         + c2 e              .
1                 −1
� �         � �
a         2
(b)          =c         , c is an arbitrary const.
b         1
3
⎛    ⎞
a', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('L\'inverse de of the initial value problem
� � �            �� �            �       � � �
d y1         1 4        y1           y1 (0)    a
=                  ,               =
dt y2         2 −1       y2           y2 (0)    b
has the behavior limt→∞ (y1 (t), y2 (t))t = (0, 0)?', 'of the initial value problem
� � �            �� �            �       � � �
d y1         1 4        y1           y1 (0)    a
=                  ,               =
dt y2         2 −1       y2           y2 (0)    b
has the behavior limt→∞ (y1 (t), y2 (t))T = (0, 0)?', 'Pas of the initial value problem
� � �            �� �            �       � � �
d y1         1 4        y1           y1 (0)    a
=                  ,               =
dt y2         2 −1       y2           y2 (0)    b
has the behavior limt→∞ (y1 (t), y2 (t))t = (0, 0)?', 'Impossible à déterminer'), 'correct' => 1, 'answer' => 'of the initial value problem
� � �            �� �            �       � � �
d y1         1 4        y1           y1 (0)    a
=                  ,               =
dt y2         2 −1       y2           y2 (0)    b
has the behavior limt→∞ (y1 (t), y2 (t))T = (0, 0)?', '_recupere_le' => '2026-11-04T19:55:22.385542+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #5 (modiﬁed on March 30, 2009) Due by Friday, April 3, 2009, by NOON.
For the initial value problem x� = f (t, x) with x(t0 ) = x0 , where f is continuous and Lips­
chitzian in the rectangle |t − t0 | ≤ T and |x − x0 | ≤ K with the Lipschitzian constant L, suppose
the exact', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : In the course of the local existence theorem,       |xk (t) − xk−1 (t)| ≤
1
|t − t0 |k
M Lk−1              for k = 1, 2, . . .
k!
�                         �
� �∞                      �
|x(t) − xn (t)| = �      (xk (t) − xk−1 (t))�
�                         �
�k=n+1                    �
∞
�
≤       |xk (t) − xk−1 (t)|
k=n+1
∞
M � (LT )k
≤       L          k!
k=n+1
∞
M (LT )n+1 � (LT )k
=       L (n+1)!      k!
k=0
n T n+1 LT
=      M L (n+1)! e', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('Impossible à déterminer', 'x and the Picard iterates xn all exist over one and the same interval of t. Show
that on such an interval
T n+1 LT
|x(t) − xn (t)| ≤ M Ln          e ,
(n + 1)!
where |f (t, x)| ≤ M in |t − t0 | ≤ T and |x − x0 | ≤ K.', 'Pas x and the picard iterates xn all exist over one and the same interval of t. show
that on such an interval
t n+1 lt
|x(t) − xn (t)| ≤ m ln          e ,
(n + 1)!
where |f (t, x)| ≤ m in |t − t0 | ≤ t and |x − x0 | ≤ k.', 'L\'inverse de x and the picard iterates xn all exist over one and the same interval of t. show
that on such an interval
t n+1 lt
|x(t) − xn (t)| ≤ m ln          e ,
(n + 1)!
where |f (t, x)| ≤ m in |t − t0 | ≤ t and |x − x0 | ≤ k.'), 'correct' => 1, 'answer' => 'x and the Picard iterates xn all exist over one and the same interval of t. Show
that on such an interval
T n+1 LT
|x(t) − xn (t)| ≤ M Ln          e ,
(n + 1)!
where |f (t, x)| ≤ M in |t − t0 | ≤ T and |x − x0 | ≤ K.', '_recupere_le' => '2026-11-04T19:55:22.385799+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #5 (modiﬁed on March 30, 2009) Due by Friday, April 3, 2009, by NOON.
(a) Show that L(1/ t)(s) = π/s by using the well-known formula                  e dx =          .
0               2
√
√            π
(b) Use part (a) to show that L( t)(s) = 3/2 for s > 0.
2s
2', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) L √ =              e √ dt =        e             dx, where x2 = st.
t�      0             t    0         x s
∞
2             2
e−x dx = π/s
�
=√
s 0
√      � ∞         √       √ e−st ∞ � ∞ e−st 1
�
−st
(b) L[ t] =        e       t dt = t         −             √ dt by parts.
�0 ∞                  −s 0        0    −s 2 t
1               1      √
=0+             e−st √ dt = π/2s3/2
2s 0               t
2
� ∞
2             2

[Correction officielle MIT : [MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #5 (modiﬁed on March 30, 2009) Due by Friday, April 3, 2009, by NOON.
(a) Show that L(1/ t)(s) = π/s by using the well-known formula                  e dx =          .
0               2
√
√            π
(b) Use part (a) to show that L( t)(s) = 3/2 for s > 0.
2s
2]', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #5 (modiﬁed on March 30, 2009) Due by Friday, April 3, 2009, by NOON.
(a) Show that L(1/ t)(s) = π/s by using the well-known formula                  e dx =          .
0               2
√
√            π
(b) Use part (a) to show that L( t)(s) = 3/2 for s > 0.
2s
2', '_recupere_le' => '2026-11-04T19:55:22.385956+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (a) L √ =              e √ dt =        e             dx, where x2 = st.
t�      0             t    0         x s
∞
2             2
e−x dx = π/s
�
=√
s 0
√      � ∞         √')),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #8 (modiﬁed on April 27, 2009) Due by Friday, May 1, 2009, by NOON.
An n × n complex matrix A is called Hermitian if A = A∗ , where A∗ is the conjugate transpose
of A. That is, aij = aji for all 1 ≤ i, j ≤ n. When A is real A∗ = AT and the terms “Hermitian” and
”symmetric” mean the same thing. If �u = (u1 , . . . , un ) and �v = (v1 , . . . , vn ) are column vectors in
Rn , then �u�v ∗ = u1 v̄1 + · · · + un v̄n and �u�2 = uu∗ .
If A = A∗ show that all eienvalues of A are real. Furthermore, if A = A∗ then eigenvectors �u
and �v corresponding to different eigenvalues λ and µ are orthogonal. That is, �u�v ∗ = 0.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) Let Au = λu. Then u∗ Au = u∗ λu = λuu∗ .
¯ ∗ . So, u∗ Au = λu
On the other hand, u∗ A = u∗ A∗ = (Au)∗ = λu                ¯ ∗ u.           ⇒ λ is real.
(b) Let Au = λu, Av = µv,               u �= 0, v �= 0, λ �= µ
Using the argument above, v Au = λv u, u∗ Av = µu∗ v.
∗    ∗
And v ∗ Au = µv
¯ ∗ u. So v ∗ v = 0
2   2                                    2   2

[Correction officielle MIT : [MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #8 (modiﬁed on April 27, 2009) Due by Friday, May 1, 2009, by NOON.
An n × n complex matrix A is called Hermitian if A = A∗ , where A∗ is the conjugate transpose
of A. That is, aij = aji for all 1 ≤ i, j ≤ n. When A is real A∗ = AT and the terms “Hermitian” and
”symmetric” mean the same thing. If �u = (u1 , . . . , un ) and �v = (v1 , . . . , vn ) are column vectors in
Rn , then �u�v ∗ = u1 v̄1 + · · · + un v̄n and �u�2 = uu∗ .
If A = A∗ show that all eienvalues of A are real. Furthermore, if A = A∗ then eigenvectors �u
and �v corresponding to different eigenvalues λ and µ are orthogonal. That is, �u�v ∗ = 0.]', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #8 (modiﬁed on April 27, 2009) Due by Friday, May 1, 2009, by NOON.
An n × n complex matrix A is called Hermitian if A = A∗ , where A∗ is the conjugate transpose
of A. That is, aij = aji for all 1 ≤ i, j ≤ n. When A is real A∗ = AT and the terms “Hermitian” and
”symmetric” mean the same thing. If �u = (u1 , . . . , un ) and �v = (v1 , . . . , vn ) are column vectors in
Rn , then �u�v ∗ = u1 v̄1 + · · · + un v̄n and �u�2 = uu∗ .
If A = A∗ show that all eienvalues of A are real. Furthermore, if A = A∗ then eigenvectors �u
and �v corresponding to different eigenvalues λ and µ are orthogonal. That is, �u�v ∗ = 0.', '_recupere_le' => '2026-11-04T19:55:22.386229+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (a) Let Au = λu. Then u∗ Au = u∗ λu = λuu∗ .
¯ ∗ . So, u∗ Au = λu
On the other hand, u∗ A = u∗ A∗ = (Au)∗ = λu                ¯ ∗ u.           ⇒ λ is real.
(b) Let Au = λu, A')),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #8 (modiﬁed on April 27, 2009) Due by Friday, May 1, 2009, by NOON.
(a) For x� = 6x + y, y � = 4x + 3y show that the origin is an unstable node.
(b) If y = mx is a trajectory, show that m = 1 or m = −4.
(c) Sketch the trajectories in the (x, y)-plane.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) P (λ) = λ2 − 9λ − 14 ... unstable node.
(b) m = 4+3m   2
6+m , m + 3m − 4 = 0 So, m = 1 or m = −4.
5
(c)

[Correction officielle MIT : [MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #8 (modiﬁed on April 27, 2009) Due by Friday, May 1, 2009, by NOON.
(a) For x� = 6x + y, y � = 4x + 3y show that the origin is an unstable node.
(b) If y = mx is a trajectory, show that m = 1 or m = −4.
(c) Sketch the trajectories in the (x, y)-plane.]', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #8 (modiﬁed on April 27, 2009) Due by Friday, May 1, 2009, by NOON.
(a) For x� = 6x + y, y � = 4x + 3y show that the origin is an unstable node.
(b) If y = mx is a trajectory, show that m = 1 or m = −4.
(c) Sketch the trajectories in the (x, y)-plane.', '_recupere_le' => '2026-11-04T19:55:22.386360+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (a) P (λ) = λ2 − 9λ − 14 ... unstable node.
(b) m = 4+3m   2
6+m , m + 3m − 4 = 0 So, m = 1 or m = −4.
5
(c)

[Correction officielle MIT : [MIT 18.034 — question d’examen, en')),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #9 (modiﬁed on May 6, 2009) Due by Friday, May 8, 2009, by NOON.
Consider the plane autonomous system
x� = f (x, y),        y � = g(x, y),
where f, g are continuously differentiable.
(a) If limt→∞ (x(t), y(t)) = (x1 , y1 ), show that (x1 , y1 ) is a critical point.
(b) Near a critical point (x0 , y0 ) the system can be written as
�        �� �      ��         �
x − x0       a b     x − x0
=                    ,
y − y0       c d     y − y0
where a, b, c, d are functions of (x, y) satisfying
�     � �                             �
a b     fx (x0 , y0 ) fy (x0 , y0 )
lim              =                                .
(x,y)→(x0 ,y0 ) c d      gx (x0 , y0 ) gy (x0 , y0 )', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) Suppose not. This means at least one of the inequalities f > 0, f < 0, g > 0, g < 0 holds
at (x1 , y1 ). Without loss of generality, let f (x1 , y1 ) = −2α < 0. (other cases are similar).
By continuity, f (x(t), y(t)) < −α for t > T for some large T > 0.
Hence, x� (t) ≤ −α for t > T , and x(t) ≤ −αt + β for some β for t > T .
Then x(t) → −∞ as t → ∞, which contradicts that x(t) → x1 .
(b) Without loss of generality, let x0 = y0 = 0.
�
Let F (t) = f (xt, yt) in a disk r < δ for some δ > 0. Hence r = x2 + y 2 .
By the Mean Value Theorem, F (1) − F (0) = F � (τ ) for some 0 < τ < 1.
And, F � (τ ) = fx (xτ, yτ )x + fy (xτ, yτ )y.
Since fx and fy are continuous, |fx (xτ, yτ )−fx (0, 0)| < �(r), |fy (xτ, yτ )−fy (0, 0)| < �(r)
and �(r) → 0 as r → 0.
Therefore a → fx (0, 0), b → fy (0, 0), as r → 0. A similar argument applies to g.

[Correction officielle MIT : [MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #9 (modiﬁed on May 6, 2009) Due by Friday, May 8, 2009, by NOON.
Consider the plane autonomous system
x� = f (x, y),        y � = g(x, y),
where f, g are continuously differentiable.
(a) If limt→∞ (x(t), y(t)) = (x1 , y1 ), show that (x1 , y1 ) is a critical point.
(b) Near a critical point (x0 , y0 ) the system can be written as
�        �� �      ��         �
x − x0       a b     x − x0
=                    ,
y − y0       c d     y − y0
where a, b, c, d are functions of (x, y) satisfying
�     � �                             �
a b     fx (x0 , y0 ) fy (x0 , y0 )
lim              =                                .
(x,y)→(x0 ,y0 ) c d      gx (x0 , y0 ) gy (x0 , y0 )]', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #9 (modiﬁed on May 6, 2009) Due by Friday, May 8, 2009, by NOON.
Consider the plane autonomous system
x� = f (x, y),        y � = g(x, y),
where f, g are continuously differentiable.
(a) If limt→∞ (x(t), y(t)) = (x1 , y1 ), show that (x1 , y1 ) is a critical point.
(b) Near a critical point (x0 , y0 ) the system can be written as
�        �� �      ��         �
x − x0       a b     x − x0
=                    ,
y − y0       c d     y − y0
where a, b, c, d are functions of (x, y) satisfying
�     � �                             �
a b     fx (x0 , y0 ) fy (x0 , y0 )
lim              =                                .
(x,y)→(x0 ,y0 ) c d      gx (x0 , y0 ) gy (x0 , y0 )', '_recupere_le' => '2026-11-04T19:55:22.386705+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (a) Suppose not. This means at least one of the inequalities f > 0, f < 0, g > 0, g < 0 holds
at (x1 , y1 ). Without loss of generality, let f (x1 , y1 ) = −2α < 0. (other ca')),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #9 (modiﬁed on May 6, 2009) Due by Friday, May 8, 2009, by NOON.
(a) Let                                    �
x sin(1/x)             x �= 0,
f (x) =
0                      x = 0.
Show that the critical point 0 of x� + f (x) = 0 is neutrally stable, but not asymptotically stable.
(b) Show that the critical point (0, 0) of the plane autonomous system
x� = y − x3 ,         y � = −x3
is stable, although its linearization is unstable.
1', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) In addition to x = 0, x = nπ  , n = 1, 2, 3, ... are critical points. Let o < |x(0)| � 1 so
1               1
that (n+1)π < |x(0)| ≤ nπ for some n large.
1                1
Then (n+1)π   < |x(t)| < nπ  for all t since a non-stationary solution cannot pass through
a critical point.
Therefore |x(t)| < n+1
n |x(0)| ≤ 2|x(0)|, and 0 is stable.
1                                  1
Take xn (0) = nπ , n = 1, 2, 3... . Then xn (t) = nπ  for all t. So ,0 is not asymptotically
stable.
� �� �              �� �
x          0 1        x
(b) The linear system is           =
y          0 0        y
The solutions are x(t) = a + bt, y(t) = b. Therefore (0, 0) is unstable.
For the nonlinear system, let E(x, y) = x4 + 2y 2 . Then, E(0, 0) = 0, E(x, y) > 0 for
� (0, 0).
(x, y) =
Ė(x, y) = 4x3 (y − x3 ) + 4y(−x3 ) = −4x6 ≤ 0. So, (0, 0) is stable.
8

[Correction officielle MIT : [MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #9 (modiﬁed on May 6, 2009) Due by Friday, May 8, 2009, by NOON.
(a) Let                                    �
x sin(1/x)             x �= 0,
f (x) =
0                      x = 0.
Show that the critical point 0 of x� + f (x) = 0 is neutrally stable, but not asymptotically stable.
(b) Show that the critical point (0, 0) of the plane autonomous system
x� = y − x3 ,         y � = −x3
is stable, although its linearization is unstable.
1]', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #9 (modiﬁed on May 6, 2009) Due by Friday, May 8, 2009, by NOON.
(a) Let                                    �
x sin(1/x)             x �= 0,
f (x) =
0                      x = 0.
Show that the critical point 0 of x� + f (x) = 0 is neutrally stable, but not asymptotically stable.
(b) Show that the critical point (0, 0) of the plane autonomous system
x� = y − x3 ,         y � = −x3
is stable, although its linearization is unstable.
1', '_recupere_le' => '2026-11-04T19:55:22.386923+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (a) In addition to x = 0, x = nπ  , n = 1, 2, 3, ... are critical points. Let o < |x(0)| � 1 so
1               1
that (n+1)π < |x(0)| ≤ nπ for some n large.
1')),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #3 Due by Friday, March 6, 2009, by NOON .
(a) Birkhoff-Rota, pp. 57, #4. (Typo. I(x) = q − p2 /4 − p� /2.)
(b) Birkhoff-Rota, pp. 57, #7(a). (Use part (a) instead of #6 as is suggested in the text.)
(c) Birkhoff-Rota, pp. 57, #7(b).', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (c)         2 2
+            ≥ (n + y2 )2 . Compare the solution with
(1 − x )       1 − x2
cos(n + y2 )x.

[Correction officielle MIT : [MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #3 Due by Friday, March 6, 2009, by NOON .
(a) Birkhoff-Rota, pp. 57, #4. (Typo. I(x) = q − p2 /4 − p� /2.)
(b) Birkhoff-Rota, pp. 57, #7(a). (Use part (a) instead of #6 as is suggested in the text.)
(c) Birkhoff-Rota, pp. 57, #7(b).]', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #3 Due by Friday, March 6, 2009, by NOON .
(a) Birkhoff-Rota, pp. 57, #4. (Typo. I(x) = q − p2 /4 − p� /2.)
(b) Birkhoff-Rota, pp. 57, #7(a). (Use part (a) instead of #6 as is suggested in the text.)
(c) Birkhoff-Rota, pp. 57, #7(b).', '_recupere_le' => '2026-11-04T19:55:22.387050+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (c)         2 2
+            ≥ (n + y2 )2 . Compare the solution with
(1 − x )       1 − x2
cos(n + y2 )x.

[Correction officielle MIT : [MIT 18.034 — question d’examen, en a')),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #3 Due by Friday, March 6, 2009, by NOON .
(a) Birkhoff-Rota, pp. 75, #3, (b) Birkhoff-Rota, pp. 75, #4.
∗
It is called a one-sided Lipschitz condition.
1', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) c1 ex + c2 e−x + c3 eix + c4 e−ix or c1 ex + c2 e−x + c3 cos x + c4 sin x
√                  √           √                √
(1+i)x/ 2 + c e(1−i)x/ 2 + c e(−1+i)x/ 2 + c e(−1−i)x/ 2 or
(b) c1 e√
√2           √3         √       4
√            √
e 2 (c1 cos x/ 2+c2 sin x/ 2)+e−x/ 2 (c3 cos x/ 2+c4 sin x/ 2)
x/
1

[Correction officielle MIT : [MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #3 Due by Friday, March 6, 2009, by NOON .
(a) Birkhoff-Rota, pp. 75, #3, (b) Birkhoff-Rota, pp. 75, #4.
∗
It is called a one-sided Lipschitz condition.
1]', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #3 Due by Friday, March 6, 2009, by NOON .
(a) Birkhoff-Rota, pp. 75, #3, (b) Birkhoff-Rota, pp. 75, #4.
∗
It is called a one-sided Lipschitz condition.
1', '_recupere_le' => '2026-11-04T19:55:22.387138+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (a) c1 ex + c2 e−x + c3 eix + c4 e−ix or c1 ex + c2 e−x + c3 cos x + c4 sin x
√                  √           √                √
(1+i)x/ 2 + c e(1−i)x/ 2 + c e(−1+i)x/ 2 + c e')),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #2 Due by Friday, February 20, 2009, by NOON. Notation. � = d/dx.
Brikhoff-Rota, pp. 20, #9.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Let α = a + ib, β = c + id. In terms of polar coordinate functions,
cos(θ) Re((β + iα)eiθ )
y �� = Im(αβ)
Re(αe−iθ )
So y �� changes signs at slopes −b/a, ∞ and a+d
b−c
.

[Correction officielle MIT : [MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #2 Due by Friday, February 20, 2009, by NOON. Notation. � = d/dx.
Brikhoff-Rota, pp. 20, #9.]', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #2 Due by Friday, February 20, 2009, by NOON. Notation. � = d/dx.
Brikhoff-Rota, pp. 20, #9.', '_recupere_le' => '2026-11-04T19:55:22.387203+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Let α = a + ib, β = c + id. In terms of polar coordinate functions,
cos(θ) Re((β + iα)eiθ )
y �� = Im(αβ)
Re(αe−iθ )
So y �� changes signs at slopes −b/a, ∞ and a+d
b−c
.

[C')),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #2 Due by Friday, February 20, 2009, by NOON. Notation. � = d/dx.
Let
Ly = y �� + y.
We are going to ﬁnd the rest', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) c1 sin x + c2 cos x
(b) − sin 2x, 3, 2ex
(c) −b sin x − sin 2x + 3 + 2ex
1
d', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('L\'inverse de of the differential equation ly = 3 sin 2x + 3 + 4ex . that is the
solution with u(0) = u� (0) = 0.
(a) find the general solution of ly = 0.
(b) solve ly = 3 sin 2x, ly = 3, and ly = 4ex by use of appropriate trial solutions.
(c) determine the constants in
y(x) = c1 cos x + c2 sin x − sin 2x + 3 + 2ex
to ﬁnd the solution.', 'of the differential equation Ly = 3 sin 2x + 3 + 4ex . That is the
solution with u(0) = u� (0) = 0.
(a) Find the general solution of Ly = 0.
(b) Solve Ly = 3 sin 2x, Ly = 3, and Ly = 4ex by use of appropriate trial solutions.
(c) Determine the constants in
y(x) = c1 cos x + c2 sin x − sin 2x + 3 + 2ex
to ﬁnd the solution.', 'Impossible à déterminer', 'Pas of the differential equation ly = 3 sin 2x + 3 + 4ex . that is the
solution with u(0) = u� (0) = 0.
(a) find the general solution of ly = 0.
(b) solve ly = 3 sin 2x, ly = 3, and ly = 4ex by use of appropriate trial solutions.
(c) determine the constants in
y(x) = c1 cos x + c2 sin x − sin 2x + 3 + 2ex
to ﬁnd the solution.'), 'correct' => 1, 'answer' => 'of the differential equation Ly = 3 sin 2x + 3 + 4ex . That is the
solution with u(0) = u� (0) = 0.
(a) Find the general solution of Ly = 0.
(b) Solve Ly = 3 sin 2x, Ly = 3, and Ly = 4ex by use of appropriate trial solutions.
(c) Determine the constants in
y(x) = c1 cos x + c2 sin x − sin 2x + 3 + 2ex
to ﬁnd the solution.', '_recupere_le' => '2026-11-04T19:55:22.387416+00:00Z', '_strategie' => 'separation_enum_solution'),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #1 Due by Friday, February 13, 2009, by NOON.
Birkhoff-Rota, pp. 5, #3.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) y is increasing because y � = y 2 + 1 > 0. The formula is obtained
by the separation of variables.
(b) y(x) = tan(x − c) is deﬁned on the interval (c − π/2, c + π/2).

[Correction officielle MIT : [MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #1 Due by Friday, February 13, 2009, by NOON.
Birkhoff-Rota, pp. 5, #3.]', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #1 Due by Friday, February 13, 2009, by NOON.
Birkhoff-Rota, pp. 5, #3.', '_recupere_le' => '2026-11-04T19:55:22.387477+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (a) y is increasing because y � = y 2 + 1 > 0. The formula is obtained
by the separation of variables.
(b) y(x) = tan(x − c) is deﬁned on the interval (c − π/2, c + π/2).

[C')),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #1 Due by Friday, February 13, 2009, by NOON.
Birkhoff-Rota, pp. 11, #7. (Typo. k is n.)', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Let q(x) = an xn + an−1 xn−1 + . . . + a0 , an =
� 0
The general solution y(x) = c/x+ n+1 x + an−1
an n
n x
n−1 +. . .+a , (x �= 0)
0
where c is constant admits the only polynomial solution when c = 0.

[Correction officielle MIT : [MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #1 Due by Friday, February 13, 2009, by NOON.
Birkhoff-Rota, pp. 11, #7. (Typo. k is n.)]', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #1 Due by Friday, February 13, 2009, by NOON.
Birkhoff-Rota, pp. 11, #7. (Typo. k is n.)', '_recupere_le' => '2026-11-04T19:55:22.387540+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Let q(x) = an xn + an−1 xn−1 + . . . + a0 , an =
� 0
The general solution y(x) = c/x+ n+1 x + an−1
an n
n x
n−1 +. . .+a , (x �= 0)
0
where c is constant admits the only poly')),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #7 (modiﬁed on April 13, 2009) Due by Friday, April 17, 2009, by NOON.
One method of determining the ratio e/m of charge to mass for an electron leads to the system
mx�� + Hey � = eE,          my �� − Hex� = 0.
The initial values are x(0) = x� (0) = y(0) = y � (0) = 0 and m, e, H, E are positive constants.
(a) Solve by the Laplace transform and show that the path of a particle in the coordinates (x, y) are
given by
x(t) = E(ωH)−1 (1 − cos ωt),         y(t) = E(ωH)−1 (ωt − sin ωt),
where ω = He/m. This is a cycloid generated by a circle of radius E(ωH)−1 .
(b) How can one determine the system-parameter e/m from knowledge of the path and the values
E and H set by the experimenter?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) ­
(b) Once you have a cycloid:
T = 2π WEH is calculated by mesuring the distance between two cusps.

[Correction officielle MIT : [MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #7 (modiﬁed on April 13, 2009) Due by Friday, April 17, 2009, by NOON.
One method of determining the ratio e/m of charge to mass for an electron leads to the system
mx�� + Hey � = eE,          my �� − Hex� = 0.
The initial values are x(0) = x� (0) = y(0) = y � (0) = 0 and m, e, H, E are positive constants.
(a) Solve by the Laplace transform and show that the path of a particle in the coordinates (x, y) are
given by
x(t) = E(ωH)−1 (1 − cos ωt),         y(t) = E(ωH)−1 (ωt − sin ωt),
where ω = He/m. This is a cycloid generated by a circle of radius E(ωH)−1 .
(b) How can one determine the system-parameter e/m from knowledge of the path and the values
E and H set by the experimenter?]', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #7 (modiﬁed on April 13, 2009) Due by Friday, April 17, 2009, by NOON.
One method of determining the ratio e/m of charge to mass for an electron leads to the system
mx�� + Hey � = eE,          my �� − Hex� = 0.
The initial values are x(0) = x� (0) = y(0) = y � (0) = 0 and m, e, H, E are positive constants.
(a) Solve by the Laplace transform and show that the path of a particle in the coordinates (x, y) are
given by
x(t) = E(ωH)−1 (1 − cos ωt),         y(t) = E(ωH)−1 (ωt − sin ωt),
where ω = He/m. This is a cycloid generated by a circle of radius E(ωH)−1 .
(b) How can one determine the system-parameter e/m from knowledge of the path and the values
E and H set by the experimenter?', '_recupere_le' => '2026-11-04T19:55:22.387894+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (a) ­
(b) Once you have a cycloid:
T = 2π WEH is calculated by mesuring the distance between two cusps.

[Correction officielle MIT : [MIT 18.034 — question d’examen, en angl')),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #7 (modiﬁed on April 13, 2009) Due by Friday, April 17, 2009, by NOON.
(a) Show that if (y1 (t), y2 (t)) is a', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) ­
2 t2
�            �
(b) By setting φ(t) = tm ,                     .
t t3
�               �
2     1      φ(t)
(c) By setting φ� (t) = e t ,               2 2
t tφ(t) − t2 e t
� �             �      �
3t  2         −3t      1', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('Impossible à déterminer', 'L\'inverse de of
t2 y1� = −2ty1 + 4y2 ,       ty2� = −2ty1 + 5y2
then both y1 and y2 are solutions of the euler equation
(t2 φ� + 2tφ)� = −8φ + 5(tφ� + 2φ).
1
−2t−1 4t−2
�             �
(b) find a fundamental matrix for
−2    5t−1
�           �
1   2t     −2
(c) for a = 2 2              obtain a fundamental matrix.
t t + 2t −2', 'of
t2 y1� = −2ty1 + 4y2 ,       ty2� = −2ty1 + 5y2
then both y1 and y2 are solutions of the Euler equation
(t2 φ� + 2tφ)� = −8φ + 5(tφ� + 2φ).
1
−2t−1 4t−2
�             �
(b) Find a fundamental matrix for
−2    5t−1
�           �
1   2t     −2
(c) For A = 2 2              obtain a fundamental matrix.
t t + 2t −2', 'Pas of
t2 y1� = −2ty1 + 4y2 ,       ty2� = −2ty1 + 5y2
then both y1 and y2 are solutions of the euler equation
(t2 φ� + 2tφ)� = −8φ + 5(tφ� + 2φ).
1
−2t−1 4t−2
�             �
(b) find a fundamental matrix for
−2    5t−1
�           �
1   2t     −2
(c) for a = 2 2              obtain a fundamental matrix.
t t + 2t −2'), 'correct' => 2, 'answer' => 'of
t2 y1� = −2ty1 + 4y2 ,       ty2� = −2ty1 + 5y2
then both y1 and y2 are solutions of the Euler equation
(t2 φ� + 2tφ)� = −8φ + 5(tφ� + 2φ).
1
−2t−1 4t−2
�             �
(b) Find a fundamental matrix for
−2    5t−1
�           �
1   2t     −2
(c) For A = 2 2              obtain a fundamental matrix.
t t + 2t −2', '_recupere_le' => '2026-11-04T19:55:22.388118+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #5 (modiﬁed on March 30, 2009) Due by Friday, April 3, 2009, by NOON.
(a) Let fn (t), n = 1, 2, . . . be continuous functions on an interval [a, b] and {fn (t)} converge
uniformly to f (t) on [a, b]. Show that
� b            � b
lim     fn (t)dt =     f (t)dt.
n→∞ a                         a
(b) Construct {fn (t)} on [0, 1] such that the above equality does not hold true.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) Since fn → f uniformly on [a, b], for � > 0 given, there exists
N ∈ Z+ such that |fn (t) − f (t)| < �/(b − a) for t ∈ [a, b] whenever
n ≥ N . For n ≥ N ,
�� b             � b         � � b
�                            �
�
�    fn (t) dt −     f (t) dt�≤
�     |fn (t) − f (t)| dt < �
a                 a          a
(b) fn (t) is given by
n
0     1/2n 1/n                    1
� 1
1
fn (t) dt =     for all n,
�0 1                 2
f (t) dt = 0.
0

[Correction officielle MIT : [MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #5 (modiﬁed on March 30, 2009) Due by Friday, April 3, 2009, by NOON.
(a) Let fn (t), n = 1, 2, . . . be continuous functions on an interval [a, b] and {fn (t)} converge
uniformly to f (t) on [a, b]. Show that
� b            � b
lim     fn (t)dt =     f (t)dt.
n→∞ a                         a
(b) Construct {fn (t)} on [0, 1] such that the above equality does not hold true.]', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #5 (modiﬁed on March 30, 2009) Due by Friday, April 3, 2009, by NOON.
(a) Let fn (t), n = 1, 2, . . . be continuous functions on an interval [a, b] and {fn (t)} converge
uniformly to f (t) on [a, b]. Show that
� b            � b
lim     fn (t)dt =     f (t)dt.
n→∞ a                         a
(b) Construct {fn (t)} on [0, 1] such that the above equality does not hold true.', '_recupere_le' => '2026-11-04T19:55:22.388309+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (a) Since fn → f uniformly on [a, b], for � > 0 given, there exists
N ∈ Z+ such that |fn (t) − f (t)| < �/(b − a) for t ∈ [a, b] whenever
n ≥ N . For n ≥ N ,
�� b')),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #5 (modiﬁed on March 30, 2009) Due by Friday, April 3, 2009, by NOON.
Let f be a real-valued continuous function in the rectangle |t − t0 | ≤ T and |x − x0 | ≤ K.
Consider the initial value problem
(1)                             x�� = f (t, x),         x(t0 ) = x0 ,     x� (t0 ) = x1 .
(a) Show that φ is a', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) (⇒) Let F (t) = f (t, φ(t)) and solve x�� = F (t) when x(t0 ) = x0 ,
x� (t0 ) = x1 .
d t
�                           � t
∂f
(⇐) Use           f (s, t) ds = f (t, t) +           (s, t) ds.
dt t0                             t0 ∂t
(b) Repeat the proof of the local existence theorem by showing
�� t                    �
�                       �
(1) |xn (t) − x0 | = |x1 | |t − t0 | + � (t − s)f (s, xn−1 (s) ds��
�
t0�
t
≤ |x1 | |t − t0 | + M        |t − s| ds
t0
= |x1 | |t − t0 | + M2 |t − t0 |
2
≤ B |t − t0 |
� t
(2) |xn (t) − xn−1 (t)| ≤        (t − s)|f (s, xn−1 (s)) − f (s, xn−2 (s))| ds
t0�
t
≤ L (t − s)|xn−1 − xn−2 | ds
t0
|t − t0 |2n
≤ M Ln−1
(2n)!
where L is the Lipshitz constant.
� � � ∞                      � ∞       √
1               −st 1            −x2 s 2x', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('of (1) if and only if φ is a solution of the integral equation
� t
(2)                         x(t) = x0 + (t − t0 )x1 +       (t − s)f (s, x)ds.
t0
(b) Let {xn } be a successive approximation for (2). That is, x0 (t) = x0 and
� t
xn (t) = x0 + (t − t0 )x1 +     (t − s)f (s, xn−1 )ds n = 1, 2, . . . .
t0
If f (t, x) is continuous and Lipshitzian with respect to x in the rectangle |t − t0 | ≤ T and |x − x0 | ≤
K, show that {xn } converges on the interval |t − t0 | ≤ min(T, K/B) to the solution of (1), where
B = |x1 | + M T /2 and |f (t, x)| ≤ M in |t − t0 | ≤ T and |x − x0 | ≤ K.
� ∞             √
√         �                                         ∗         −x2        π', 'Pas of (1) if and only if φ is a solution of the integral equation
� t
(2)                         x(t) = x0 + (t − t0 )x1 +       (t − s)f (s, x)ds.
t0
(b) let {xn } be a successive approximation for (2). that is, x0 (t) = x0 and
� t
xn (t) = x0 + (t − t0 )x1 +     (t − s)f (s, xn−1 )ds n = 1, 2, . . . .
t0
if f (t, x) is continuous and lipshitzian with respect to x in the rectangle |t − t0 | ≤ t and |x − x0 | ≤
k, show that {xn } converges on the interval |t − t0 | ≤ min(t, k/b) to the solution of (1), where
b = |x1 | + m t /2 and |f (t, x)| ≤ m in |t − t0 | ≤ t and |x − x0 | ≤ k.
� ∞             √
√         �                                         ∗         −x2        π', 'Impossible à déterminer', 'L\'inverse de of (1) if and only if φ is a solution of the integral equation
� t
(2)                         x(t) = x0 + (t − t0 )x1 +       (t − s)f (s, x)ds.
t0
(b) let {xn } be a successive approximation for (2). that is, x0 (t) = x0 and
� t
xn (t) = x0 + (t − t0 )x1 +     (t − s)f (s, xn−1 )ds n = 1, 2, . . . .
t0
if f (t, x) is continuous and lipshitzian with respect to x in the rectangle |t − t0 | ≤ t and |x − x0 | ≤
k, show that {xn } converges on the interval |t − t0 | ≤ min(t, k/b) to the solution of (1), where
b = |x1 | + m t /2 and |f (t, x)| ≤ m in |t − t0 | ≤ t and |x − x0 | ≤ k.
� ∞             √
√         �                                         ∗         −x2        π'), 'correct' => 0, 'answer' => 'of (1) if and only if φ is a solution of the integral equation
� t
(2)                         x(t) = x0 + (t − t0 )x1 +       (t − s)f (s, x)ds.
t0
(b) Let {xn } be a successive approximation for (2). That is, x0 (t) = x0 and
� t
xn (t) = x0 + (t − t0 )x1 +     (t − s)f (s, xn−1 )ds n = 1, 2, . . . .
t0
If f (t, x) is continuous and Lipshitzian with respect to x in the rectangle |t − t0 | ≤ T and |x − x0 | ≤
K, show that {xn } converges on the interval |t − t0 | ≤ min(T, K/B) to the solution of (1), where
B = |x1 | + M T /2 and |f (t, x)| ≤ M in |t − t0 | ≤ T and |x − x0 | ≤ K.
� ∞             √
√         �                                         ∗         −x2        π', '_recupere_le' => '2026-11-04T19:55:22.388787+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #5 (modiﬁed on March 30, 2009) Due by Friday, April 3, 2009, by NOON.
(a) Show that L(et )(s) does not exist for any interval of the form s > a.
(b) For what values of k, will L(1/tk ) exist?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) L[et ] =         et −st dt is indeﬁnite for every real value of s, no
0
matter how large, since t2 − st > 0 for t > s and so
� ∞               � ∞               � ∞
t2 −st            t2 −st
e        dt >     e        dt >     e0 dt = ∞
0                s               s
�   � � ∞
1               1
(b) L k =          e−st k dt, (s > 0). The trouble here is when t = 0.
t        0      t                    � τ              � τ
−st                            −st 1          dt
Near t = 0, e       ≈ 1 and therefore       e     k
dt �      k
=
⎧                                        0       t        0 t
⎪
⎨ t1−k ��τ
⎪                                   � �
� k �= 1 . Therefore, L 1 exists for k < 1.
⎪  1 − k �0                          tk
τ
⎪
log t|0    k=1
⎩

[Correction officielle MIT : [MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #5 (modiﬁed on March 30, 2009) Due by Friday, April 3, 2009, by NOON.
(a) Show that L(et )(s) does not exist for any interval of the form s > a.
(b) For what values of k, will L(1/tk ) exist?]', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #5 (modiﬁed on March 30, 2009) Due by Friday, April 3, 2009, by NOON.
(a) Show that L(et )(s) does not exist for any interval of the form s > a.
(b) For what values of k, will L(1/tk ) exist?', '_recupere_le' => '2026-11-04T19:55:22.388901+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (a) L[et ] =         et −st dt is indeﬁnite for every real value of s, no
0
matter how large, since t2 − st > 0 for t > s and so
� ∞               � ∞               � ∞
t2 −s')),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #8 (modiﬁed on April 27, 2009) Due by Friday, May 1, 2009, by NOON.
(a) Let A be a 3 × 3 matrix with eigenvalues λ1 , λ2 , λ3 . Show that the nonzero columns of
(A − λ2 I)(A − λ3 I) are eigenvectors for λ1 .
(b) A 3 × 3 matrix A has characteristic polynomial p(λ) = λ(λ2 − 1). Find eAt .', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) p(λ) = (λ − λ1 )(λ − λ2 )(λ − λ3 )
By Cayley-Hamilton, (A − λ1 I)(A − λ2 I)(A − λ3 I) = 0
(b) By Cayley-Hamilton, A(A2 − I) = 0             So, A2k+1 = A and A2k = A2 .
t2 A2 t3 A3
eAt = I + tA +      +      + ···
2!    3!
t3 t5              t2 t4
= I + A(t + + + · · · ) + A2 ( + + · · · )
3! 5!              2! 4!
1             1
= I + A2 + A(et − e−t ) + A2 (et + e−t ).
2             2

[Correction officielle MIT : [MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #8 (modiﬁed on April 27, 2009) Due by Friday, May 1, 2009, by NOON.
(a) Let A be a 3 × 3 matrix with eigenvalues λ1 , λ2 , λ3 . Show that the nonzero columns of
(A − λ2 I)(A − λ3 I) are eigenvectors for λ1 .
(b) A 3 × 3 matrix A has characteristic polynomial p(λ) = λ(λ2 − 1). Find eAt .]', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #8 (modiﬁed on April 27, 2009) Due by Friday, May 1, 2009, by NOON.
(a) Let A be a 3 × 3 matrix with eigenvalues λ1 , λ2 , λ3 . Show that the nonzero columns of
(A − λ2 I)(A − λ3 I) are eigenvectors for λ1 .
(b) A 3 × 3 matrix A has characteristic polynomial p(λ) = λ(λ2 − 1). Find eAt .', '_recupere_le' => '2026-11-04T19:55:22.389046+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (a) p(λ) = (λ − λ1 )(λ − λ2 )(λ − λ3 )
By Cayley-Hamilton, (A − λ1 I)(A − λ2 I)(A − λ3 I) = 0
(b) By Cayley-Hamilton, A(A2 − I) = 0             So, A2k+1 = A and A2k = A2 .
t')),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #9 (modiﬁed on May 6, 2009) Due by Friday, May 8, 2009, by NOON.
(a) If V (x, y) is continuously differentiable, then each', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Birkhoﬀ-Rota pp. 135-136, Theorem 1 and Example 3.
Folia of Descartes are in ﬁgure 5.2.', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('L\'inverse de curve of the plane autonomous
system
∂v                    ∂v
x� =     (x, y),     y� = −    (x, y)
∂y                    ∂x
lies on some level curve v (x, y) = constant.
(b) show that the solution curves of the autonomous system
x� = x(2y 3 − x3 ),          y � = −y(2x3 − y 3 )
are the curves x3 + y 3 − 3cxy = 0, where c is an arbitrary constant. sketch typical solution curves.', 'curve of the plane autonomous
system
∂V                    ∂V
x� =     (x, y),     y� = −    (x, y)
∂y                    ∂x
lies on some level curve V (x, y) = constant.
(b) Show that the solution curves of the autonomous system
x� = x(2y 3 − x3 ),          y � = −y(2x3 − y 3 )
are the curves x3 + y 3 − 3cxy = 0, where c is an arbitrary constant. Sketch typical solution curves.', 'Pas curve of the plane autonomous
system
∂v                    ∂v
x� =     (x, y),     y� = −    (x, y)
∂y                    ∂x
lies on some level curve v (x, y) = constant.
(b) show that the solution curves of the autonomous system
x� = x(2y 3 − x3 ),          y � = −y(2x3 − y 3 )
are the curves x3 + y 3 − 3cxy = 0, where c is an arbitrary constant. sketch typical solution curves.', 'Impossible à déterminer'), 'correct' => 1, 'answer' => 'curve of the plane autonomous
system
∂V                    ∂V
x� =     (x, y),     y� = −    (x, y)
∂y                    ∂x
lies on some level curve V (x, y) = constant.
(b) Show that the solution curves of the autonomous system
x� = x(2y 3 − x3 ),          y � = −y(2x3 − y 3 )
are the curves x3 + y 3 − 3cxy = 0, where c is an arbitrary constant. Sketch typical solution curves.', '_recupere_le' => '2026-11-04T19:55:22.389285+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #9 (modiﬁed on May 6, 2009) Due by Friday, May 8, 2009, by NOON.
(a) Show that x� = f (x) has an asymptotically stable critical point 0 if and only if 0 < |x| < δ
implies xf (x) < 0 for some δ > 0.
(b) Show that x� = f (x) has an asymptotically stable critical point 0 if f (0) = 0 and f � (0) < 0.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) Birkhoﬀ-Rota pp. 153. Theorem 5.
(b) Let E(x) = x2 a Lyapunov function. E(0) = 0 and E(x) > 0 for x �= 0.
And Ė(x) = 2xf (x) < 0 for x =� 0 and x near 0 since f � (0) < 0.
Therfore 0 is asymptotically stable.
1

[Correction officielle MIT : [MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #9 (modiﬁed on May 6, 2009) Due by Friday, May 8, 2009, by NOON.
(a) Show that x� = f (x) has an asymptotically stable critical point 0 if and only if 0 < |x| < δ
implies xf (x) < 0 for some δ > 0.
(b) Show that x� = f (x) has an asymptotically stable critical point 0 if f (0) = 0 and f � (0) < 0.]', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #9 (modiﬁed on May 6, 2009) Due by Friday, May 8, 2009, by NOON.
(a) Show that x� = f (x) has an asymptotically stable critical point 0 if and only if 0 < |x| < δ
implies xf (x) < 0 for some δ > 0.
(b) Show that x� = f (x) has an asymptotically stable critical point 0 if f (0) = 0 and f � (0) < 0.', '_recupere_le' => '2026-11-04T19:55:22.389438+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (a) Birkhoﬀ-Rota pp. 153. Theorem 5.
(b) Let E(x) = x2 a Lyapunov function. E(0) = 0 and E(x) > 0 for x �= 0.
And Ė(x) = 2xf (x) < 0 for x =� 0 and x near 0 since f � (0) <')),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #3 Due by Friday, March 6, 2009, by NOON .
This problem pertains to the differential equation y �� + ω 2 y = sin ω0 t, where ω �= 0 and ω0 is
close to but different from ω.
sin ω0 t
(a) Verify that y1 (t) = 2        is a particular', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (b) y1� (0) = ω+ωω0 ω−1ω0 → +∞ as ω0 → ω.
(c) y2� (0) = − ω+1ω0 → − 21ω .
1
(d) lim y2 (t) = −            t cos ωt.
ω0 →ω                 2ω', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('.
ω − ω02
(b) As ω0 → ω show that one of the initial conditions y1 (0) or y1� (0) becomes inﬁnite.
sin ω0 t − sin ωt
(c) Check that y2 (t) =                   is the particular solution for which the initial conditions
ω 2 − ω02
remain ﬁnite as ω0 → ω.
(d) By l’Hospital’s rule show that the limit as ω0 → ω of y2 (t) gives a particular solution of y �� +
ω 2 y = sin ωt.', 'Impossible à déterminer', 'Pas .
ω − ω02
(b) as ω0 → ω show that one of the initial conditions y1 (0) or y1� (0) becomes inﬁnite.
sin ω0 t − sin ωt
(c) check that y2 (t) =                   is the particular solution for which the initial conditions
ω 2 − ω02
remain ﬁnite as ω0 → ω.
(d) by l’hospital’s rule show that the limit as ω0 → ω of y2 (t) gives a particular solution of y �� +
ω 2 y = sin ωt.', 'L\'inverse de .
ω − ω02
(b) as ω0 → ω show that one of the initial conditions y1 (0) or y1� (0) becomes inﬁnite.
sin ω0 t − sin ωt
(c) check that y2 (t) =                   is the particular solution for which the initial conditions
ω 2 − ω02
remain ﬁnite as ω0 → ω.
(d) by l’hospital’s rule show that the limit as ω0 → ω of y2 (t) gives a particular solution of y �� +
ω 2 y = sin ωt.'), 'correct' => 0, 'answer' => '.
ω − ω02
(b) As ω0 → ω show that one of the initial conditions y1 (0) or y1� (0) becomes inﬁnite.
sin ω0 t − sin ωt
(c) Check that y2 (t) =                   is the particular solution for which the initial conditions
ω 2 − ω02
remain ﬁnite as ω0 → ω.
(d) By l’Hospital’s rule show that the limit as ω0 → ω of y2 (t) gives a particular solution of y �� +
ω 2 y = sin ωt.', '_recupere_le' => '2026-11-04T19:55:22.389729+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #3 Due by Friday, March 6, 2009, by NOON .
Let (cosh x)y �� + (cos x)y � = (1 + x2 )y for a < x < b and let y(a) = y(b) = 1. Show that
0 < y(x) < 1 for a < x < b.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Suppose u(x) > 1 at some point a < x < b. Then u takes a positive
maximum > 1 at a < c < b. Observe that u(c) > 1, u� (c) = 0 and
u�� (c) ≤ 0.
At c, the diﬀerential equation reduces to
(cosh c)u�� (c) = (1 + e2 )u(c)
≤0                >0
But this is a contradiction.
The case u(x) < 0 at some point is completely analogous.

[Correction officielle MIT : [MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #3 Due by Friday, March 6, 2009, by NOON .
Let (cosh x)y �� + (cos x)y � = (1 + x2 )y for a < x < b and let y(a) = y(b) = 1. Show that
0 < y(x) < 1 for a < x < b.]', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #3 Due by Friday, March 6, 2009, by NOON .
Let (cosh x)y �� + (cos x)y � = (1 + x2 )y for a < x < b and let y(a) = y(b) = 1. Show that
0 < y(x) < 1 for a < x < b.', '_recupere_le' => '2026-11-04T19:55:22.389844+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Suppose u(x) > 1 at some point a < x < b. Then u takes a positive
maximum > 1 at a < c < b. Observe that u(c) > 1, u� (c) = 0 and
u�� (c) ≤ 0.
At c, the diﬀerential equation')),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #2 Due by Friday, February 20, 2009, by NOON. Notation. � = d/dx.
Suppose that f be a continuous bounded function for the entire real axis. If f � is continuous,
then show that the nonzero', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : As long as the solution is deﬁned, yy = f (y) (y is never zero by unique­
ness).
⇒ (log |y|)� ≤ |f (y)| ≤ M by assumption. Then
|y(x)| ≤ |y0 |eM x                        (1)
For a > 0, consider the rectangle {(x, y) : |x| ≤ a, |y| ≤ |y0 |eM a }. If
the solution does not exist on x ∈ (−a, a), then |y(a)| = |y0 |eM a . This
contradicts (??).', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('L\'inverse de of the initial value problem of y � = yf (y) with y(0) = y0 =
� 0
exists for all x. (you may need to assume the uniqueness theorem. )', 'of the initial value problem of y � = yf (y) with y(0) = y0 =
� 0
exists for all x. (You may need to assume the uniqueness theorem. )', 'Impossible à déterminer', 'Pas of the initial value problem of y � = yf (y) with y(0) = y0 =
� 0
exists for all x. (you may need to assume the uniqueness theorem. )'), 'correct' => 1, 'answer' => 'of the initial value problem of y � = yf (y) with y(0) = y0 =
� 0
exists for all x. (You may need to assume the uniqueness theorem. )', '_recupere_le' => '2026-11-04T19:55:22.390006+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #2 Due by Friday, February 20, 2009, by NOON. Notation. � = d/dx.
(The Ricatti equation) It is the differential equation of the form y � = a(x) + b(x)y + c(x)y 2 . In
general the Ricatti equation is not solvable by elementary means∗. However,
(a) show that if y1 (x) is a', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) u solves the DE y � + (−b(x) + 2c(x)y1 (x))y + c(x)y 2 = 0.
1
(b) y1 (x) = x, u(x) = − x+c .', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('Impossible à déterminer', 'then the general solution is y = y1 + u, where u is the general
solution of a certain Bernoulli equation (cf. pset #1).
(b) Solve the Ricatti equation y � = 1 − x2 + y 2 by the above method.', 'Pas then the general solution is y = y1 + u, where u is the general
solution of a certain bernoulli equation (cf. pset #1).
(b) solve the ricatti equation y � = 1 − x2 + y 2 by the above method.', 'L\'inverse de then the general solution is y = y1 + u, where u is the general
solution of a certain bernoulli equation (cf. pset #1).
(b) solve the ricatti equation y � = 1 − x2 + y 2 by the above method.'), 'correct' => 1, 'answer' => 'then the general solution is y = y1 + u, where u is the general
solution of a certain Bernoulli equation (cf. pset #1).
(b) Solve the Ricatti equation y � = 1 − x2 + y 2 by the above method.', '_recupere_le' => '2026-11-04T19:55:22.390211+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.034 — question d’examen, en anglais] 18.034 Problem Set #2 Due by Friday, February 20, 2009, by NOON. Notation. � = d/dx.
(Euler’s equi-dimensional equation) It is a differential equation of the form x2 y �� +pxy � +qy = 0,
where p, q are constants.
(a) Show that the setting x = et changes the differential equation into an equation with constant
coefﬁcients.
(b) Use this to ﬁnd the general', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a) ü + (p − 1)u̇ + qu = 0, · = dt
(b) sin log |x|, cos log |x|
(c) No solutions
2', 'source' => 'MIT OpenCourseWare, 18.034 Honors Differential Equations, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('L\'inverse de to x2 y �� + xy � + y = 0.
(c) for which values of p, the general solutions of x2 y �� + pxy � + 2y = 0 are deﬁned for the entire
real axis (−∞, ∞)?
∗
this was shown by liouville in 1841.
1', 'Pas to x2 y �� + xy � + y = 0.
(c) for which values of p, the general solutions of x2 y �� + pxy � + 2y = 0 are deﬁned for the entire
real axis (−∞, ∞)?
∗
this was shown by liouville in 1841.
1', 'to x2 y �� + xy � + y = 0.
(c) For which values of p, the general solutions of x2 y �� + pxy � + 2y = 0 are deﬁned for the entire
real axis (−∞, ∞)?
∗
This was shown by Liouville in 1841.
1', 'Impossible à déterminer'), 'correct' => 2, 'answer' => 'to x2 y �� + xy � + y = 0.
(c) For which values of p, the general solutions of x2 y �� + pxy � + 2y = 0 are deﬁned for the entire
real axis (−∞, ∞)?
∗
This was shown by Liouville in 1841.
1', '_recupere_le' => '2026-11-04T19:55:22.390437+00:00Z', '_strategie' => 'separation_enum_solution'),
						),
					),
				),
			),
		);
	}
}
