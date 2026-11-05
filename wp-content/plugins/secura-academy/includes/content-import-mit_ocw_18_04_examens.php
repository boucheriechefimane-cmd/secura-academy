<?php
/**
 * Questions importees — MIT OpenCourseWare — 18 04 complex variables with applications spring 2018
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_18_04_examens' ) ) {
	function seca_import_mit_ocw_18_04_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-18-04-examens', 'nom' => 'MIT OpenCourseWare — 18 04 complex variables with applications spring 2018', 'url' => 'https://ocw.mit.edu/courses/18-04-complex-variables-with-applications-spring-2018/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(30: 10,5,10,5 points)
𝑧
Let 𝑧1 = 1 + 𝑖, 𝑧2 = 1 + 3𝑖. Compute 𝑧1 𝑧2 , 𝑧1 /𝑧2 , 𝑧12 (use the principal branch of log).
𝑧
(Give 𝑧1 𝑧2 and 𝑧1 /𝑧2 in standard rectangular form and 𝑧12 in polar form.)
𝑧1    1 + 𝑖 1 − 3𝑖   4 − 2𝑖   2−𝑖', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑧1 = 1 + 𝑖, 𝑧2 = 1 + 3𝑖: 𝑧1 𝑧2 = −2 + 4𝑖 ,            =       ⋅       =        =     .
𝑧2   1 + 3𝑖 1 − 3𝑖     10      5
√                                                                             𝑦
|𝑧1 | = 2, Arg(𝑧√ 1 ) = 𝜋/4 (principal branch).
𝑧1 = 1 + 𝑖
So log(𝑧1 ) = log( 2) + 𝑖 𝜋4 = 12 log(2) + 𝑖 𝜋4 (principal branch).
Thus,                                                                                         𝑥
𝑧
𝑧12 = e𝑧2 log(𝑧1 ) = e(1+3𝑖)(log(2)/2+𝑖𝜋/4) = elog(2)/2−3𝜋/4 e𝑖(3 log(2)/2+𝜋/4) (not pretty!)

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(30: 10,5,10,5 points)
𝑧
Let 𝑧1 = 1 + 𝑖, 𝑧2 = 1 + 3𝑖. Compute 𝑧1 𝑧2 , 𝑧1 /𝑧2 , 𝑧12 (use the principal branch of log).
𝑧
(Give 𝑧1 𝑧2 and 𝑧1 /𝑧2 in standard rectangular form and 𝑧12 in polar form.)
𝑧1    1 + 𝑖 1 − 3𝑖   4 − 2𝑖   2−𝑖]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(30: 10,5,10,5 points)
𝑧
Let 𝑧1 = 1 + 𝑖, 𝑧2 = 1 + 3𝑖. Compute 𝑧1 𝑧2 , 𝑧1 /𝑧2 , 𝑧12 (use the principal branch of log).
𝑧
(Give 𝑧1 𝑧2 and 𝑧1 /𝑧2 in standard rectangular form and 𝑧12 in polar form.)
𝑧1    1 + 𝑖 1 − 3𝑖   4 − 2𝑖   2−𝑖', '_recupere_le' => '2026-11-04T19:55:22.393715+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : 𝑧1 = 1 + 𝑖, 𝑧2 = 1 + 3𝑖: 𝑧1 𝑧2 = −2 + 4𝑖 ,            =       ⋅       =        =     .
𝑧2   1 + 3𝑖 1 − 3𝑖     10      5
√')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(30: 10,5,10,5 points)
𝑧
Let 𝑧 = 1 + 𝑖 3.
(i) Compute 𝑧8 . (Give your', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (i) 𝑧 = 1 + 3 𝑖 = 2e𝑖𝜋/3 , so
√
𝑧8 = 256e𝑖8𝜋/3 = 256e𝑖2𝜋/3 = 128(−1 +              3 𝑖)
(ii) 𝑧1/4 = (2e𝑖𝜋/3+2𝑛𝜋𝑖 )1/4 = 21/4 e𝑖𝜋/12 , 21/4 e𝑖7𝜋/12 , 21/4 e𝑖13𝜋/12 , 21/4 e𝑖19𝜋/12
Since 𝜋/12 = 15∘ this doesn’t have a pretty standard form, so we’ll leave them as is. We
can always get numerical approximations if needed.', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'choices' => array('Pas in standard form.)
(ii) find all the 4th roots of 𝑧.
√', 'in standard form.)
(ii) Find all the 4th roots of 𝑧.
√', 'L\'inverse de in standard form.)
(ii) find all the 4th roots of 𝑧.
√', 'Impossible à déterminer'), 'correct' => 1, 'answer' => 'in standard form.)
(ii) Find all the 4th roots of 𝑧.
√', '_recupere_le' => '2026-11-04T19:55:22.393836+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Show that if |𝑧| = 1 then 𝑧−1 = 𝑧.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We’ll give two ways to say this:
1      𝑧      𝑧    𝑧
Method 1: =           = 2 = = 𝑧.
𝑧    𝑧⋅𝑧     |𝑧|   1
Method 2: 𝑧 = e𝑖𝜃 , so by part (a) 𝑧 = e−𝑖𝜃 = 𝑧 −1 .
18.04 Problem Set 1, Spring 2018 Solutions                                                               3

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Show that if |𝑧| = 1 then 𝑧−1 = 𝑧.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Show that if |𝑧| = 1 then 𝑧−1 = 𝑧.', '_recupere_le' => '2026-11-04T19:55:22.393898+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : We’ll give two ways to say this:
1      𝑧      𝑧    𝑧
Method 1: =           = 2 = = 𝑧.
𝑧    𝑧⋅𝑧     |𝑧|   1
Method 2: 𝑧 = e𝑖𝜃 , so by part (a) 𝑧 = e−𝑖𝜃 = 𝑧 −1 .
18.04 Problem')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,10 points)
Sketch the curve 𝑧 = e𝑡(1+𝑖) , where −∞ < 𝑡 < ∞.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : e𝑡(1+𝑖) = e𝑡 e𝑖𝑡 . So as 𝑡 grow the magnitude grows exponentially and the argument
increases. This gives a spiral!
Im(z)
Re(z)
Note, this is not to scale. The exponential e𝑡 grows too quickly, so we drew e0.2𝑡 instead.
Qualitatively this is a good representation of the curve.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(15: 5,10 points)
Sketch the curve 𝑧 = e𝑡(1+𝑖) , where −∞ < 𝑡 < ∞.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,10 points)
Sketch the curve 𝑧 = e𝑡(1+𝑖) , where −∞ < 𝑡 < ∞.', '_recupere_le' => '2026-11-04T19:55:22.393958+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : e𝑡(1+𝑖) = e𝑡 e𝑖𝑡 . So as 𝑡 grow the magnitude grows exponentially and the argument
increases. This gives a spiral!
Im(z)
Re(z)
Note, this is not to scale. The exponential e𝑡')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Let 𝑧𝑘 = e2𝜋𝑖/𝑛 . Show
                             1 + 𝑧𝑘 + 𝑧𝑘2 + 𝑧𝑘3 + … + 𝑧𝑘𝑛−1 = 0
Hint: The polynomial 𝑧𝑛 − 1 has one easy root. Use that to factor it into a linear term and
a degree 𝑛 − 1 term.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The 𝑛th roots of 1 are all the roots of the equation 𝑧𝑛 − 1 = 0. Since we know
that 𝑧 = 1 is a root we can factor the equation as
(𝑧 − 1)(𝑧 𝑛−1 + 𝑧 𝑛−2 + … + 𝑧 + 1) = 0
Since 𝑧𝑘 is also a root of 𝑧 𝑛 − 1 and 𝑧𝑘 ≠ 1, we must have 𝑧𝑘 is a root of the second factor.
This is what we were asked to show!

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Let 𝑧𝑘 = e2𝜋𝑖/𝑛 . Show
                             1 + 𝑧𝑘 + 𝑧𝑘2 + 𝑧𝑘3 + … + 𝑧𝑘𝑛−1 = 0
Hint: The polynomial 𝑧𝑛 − 1 has one easy root. Use that to factor it into a linear term and
a degree 𝑛 − 1 term.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Let 𝑧𝑘 = e2𝜋𝑖/𝑛 . Show
                             1 + 𝑧𝑘 + 𝑧𝑘2 + 𝑧𝑘3 + … + 𝑧𝑘𝑛−1 = 0
Hint: The polynomial 𝑧𝑛 − 1 has one easy root. Use that to factor it into a linear term and
a degree 𝑛 − 1 term.', '_recupere_le' => '2026-11-04T19:55:22.394074+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The 𝑛th roots of 1 are all the roots of the equation 𝑧𝑛 − 1 = 0. Since we know
that 𝑧 = 1 is a root we can factor the equation as
(𝑧 − 1)(𝑧 𝑛−1 + 𝑧 𝑛−2 + … + 𝑧 + 1) = 0
Since')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points) (Orthogonal lines stay orthogonal!)
Repeat part (a) for the mapping 𝑤 = 𝑧 2 .', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This part is similar to part (a), though we will need a little more algebraic
manipulation to identify the image curves.
(i) The vertical line 𝑥 = 𝑎 is parametrized by 𝑧 = 𝑎 + 𝑖𝑦, with −∞ < 𝑦 < ∞. So the image
is 𝑤 = 𝑎2 − 𝑦2 + 𝑖2𝑎𝑦. Let’s write this as 𝑤 = 𝑢 + 𝑖𝑣. It is easy to see that with 𝑢 = 𝑎2 − 𝑦2
and 𝑣 = 2𝑎𝑦 we have
𝑢 = 𝑎2 − (𝑣/2𝑎)2 .
This is a parabola in the 𝑢𝑣-plane which opens to the left and has vertex at (𝑎2 , 0).
(ii) Horizontal lines 𝑦 = 𝑏 are similar:
Parametrization: 𝑧 = 𝑥 + 𝑖𝑏, with −∞ < 𝑥 < ∞.
Image: 𝑤 = 𝑥2 − 𝑏2 + 𝑖2𝑏𝑥.
If 𝑤 = 𝑢 + 𝑖𝑣 then u = (𝑣/2𝑏)2 − 𝑏2 . This is a parabola opening to the right with vertex at
(−𝑏2 , 0).
The figure below is labeled in the same way as the figure in part (a). Notice the vertical
lines 𝑥 = 𝑎 and 𝑥 = −𝑎 map to the same parabola as befits the 2-to-1 mapping 𝑤 = 𝑧 2 .
The real 𝑧-axis (𝑥 = 0) maps to the positive real 𝑤-axis (𝑢 > 0). We can view this as a
degenerate parabola. Likewise for the imaginary 𝑧-axis.
Im(w)
lv1 , lv5                             lh1 , lh5
z 7→ w = z 2
Im(z)
lv1        lv2      lv3         lv4     lv5
1                        lh5                                   lv2 , lv4                                              lh2 , lh4
lh4
Re(z)                                                                                        Re(w)
−1                 0                    1   lh3                                   lv3                                                        lh3
lh2
−1                       lh1
(iii) To show the image curves are orthogonal (meet at right angles) we need to show that
their tangent vectors are orthogonal. Happily, we’ve parametrized the image curves in parts
(i) and (ii), so computing tangent vectors is easy. In keeping with the course we will write
vectors as 𝑥 + 𝑖𝑦 rather than in 18.02 notation as ⟨𝑥, 𝑦⟩
18.04 Problem Set 1, Spring 2018 Solutions                                                  6
Horizontal line: 𝑧 = 𝑎+𝑖𝑦; image 𝑤 = 𝑎2 −𝑦2 +𝑖2𝑎𝑦; image tangent vector: 𝑑𝑤
𝑑𝑦 = −2𝑦+𝑖2𝑎.
Vertical line: 𝑧 = 𝑥 + 𝑖𝑏; image 𝑤 = 𝑥 − 𝑏 + 𝑖2𝑥𝑏; image tangent vector: 𝑑𝑤
2   2
𝑑𝑥 = 2𝑥 + 𝑖2𝑏.
The lines meet at the point 𝑎 + 𝑖𝑏, so we need to check the tangents at that point.
Horizontal line image: 𝑑𝑤𝑑𝑦 = −2𝑏 + 𝑖2𝑎
𝑑𝑤
Vertical line image: 𝑑𝑥 = 2𝑎 + 𝑖2𝑏
It is easy to see that these are orthogonal. For 18.04 the nicest way to say this is to note
that −2𝑏 + 𝑖2𝑎 = 𝑖(2𝑎 + 𝑖2𝑏). Since multiplication by 𝑖 is rotation by 90∘ the vectors are at
right angles.
Extra problems not for points

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points) (Orthogonal lines stay orthogonal!)
Repeat part (a) for the mapping 𝑤 = 𝑧 2 .]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points) (Orthogonal lines stay orthogonal!)
Repeat part (a) for the mapping 𝑤 = 𝑧 2 .', '_recupere_le' => '2026-11-04T19:55:22.394149+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : This part is similar to part (a), though we will need a little more algebraic
manipulation to identify the image curves.
(i) The vertical line 𝑥 = 𝑎 is parametrized by 𝑧 = 𝑎')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Show that cos(𝑧) is an analytic for all 𝑧, i.e. it’s an entire function. Compute its
derivative and show it equals − sin(𝑧).', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Show that cos(𝑧) is an analytic for all 𝑧, i.e. it’s an entire function. Compute its
derivative and show it equals − sin(𝑧).
We’ll do this two ways, first from the definition of cos(𝑧) in terms of exponentials. Second,
we’ll write cos(𝑧) as a function of 𝑥 and 𝑦 and verify the Cauchy-Riemann equations.
e𝑖𝑧 + e−𝑖𝑧
Method 1. By definition cos(𝑧) =                 , so cos(𝑧) is entire because both e𝑖𝑧 and e−𝑖𝑧
2
are entire. Its derivative is
𝑑 cos(𝑧)   𝑖e𝑖𝑧 − 𝑖e−𝑖𝑧   −e𝑖𝑧 + e−𝑖𝑧
=              =             = − sin(𝑧)
𝑑𝑧            2            2𝑖
Method 2. First let’s write cos(𝑧) = 𝑢(𝑥, 𝑦) + 𝑖𝑣(𝑥, 𝑦)
e𝑖(𝑥+𝑖𝑦) + e−𝑖(𝑥+𝑖𝑦)   e−𝑦 e𝑖𝑥 + e𝑦 e−𝑖𝑥
cos(𝑧) =                        =                   = … = cos(𝑥) cosh(𝑦) − 𝑖 sin(𝑥) sinh(𝑦)
2                    2
(You can work out the algebraic details of this formula.) Next we compute the partials and
verify the Cauchy-Riemann equations.
𝑢𝑥 = − sin(𝑥) cosh(𝑦)       𝑢𝑦 = cos(𝑥) sinh(𝑦)
𝑣𝑥 = − cos(𝑥) sinh(𝑦)       𝑣𝑦 = −𝑖 sin(𝑥) cosh(𝑦)
Since 𝑢𝑥 = 𝑣𝑦 and 𝑢𝑦 = 𝑣𝑥 the Cauchy-Riemann equations hold for all 𝑧 and cos(𝑧) is entire
and
𝑑 cos(𝑧)
= 𝑢𝑥 − 𝑖𝑢𝑦 = − sin(𝑥) cosh(𝑦) − 𝑖 cos(𝑥) sinh(𝑦) = − sin(𝑧).
𝑑𝑧
(You can easily check that the last expression is indeed − sin(𝑧).)

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Show that cos(𝑧) is an analytic for all 𝑧, i.e. it’s an entire function. Compute its
derivative and show it equals − sin(𝑧).]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Show that cos(𝑧) is an analytic for all 𝑧, i.e. it’s an entire function. Compute its
derivative and show it equals − sin(𝑧).', '_recupere_le' => '2026-11-04T19:55:22.394230+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Show that cos(𝑧) is an analytic for all 𝑧, i.e. it’s an entire function. Compute its
derivative and show it equals − sin(𝑧).
We’ll do this two ways, first from the definition')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
𝑛
𝑃 ′ (𝑧)        1
Let 𝑃 (𝑧) = (𝑧 − 𝑟1 )(𝑧 − 𝑟2 ) … (𝑧 − 𝑟𝑛 ).       Show that           =∑
𝑃 (𝑧)    𝑗=1
𝑧 − 𝑟𝑗
Suggestion: try 𝑛 = 2 and 𝑛 = 3 first.
𝑑 𝑎𝑧 + 𝑏', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑃 (𝑧) = (𝑧 − 𝑟1 )(𝑧 − 𝑟2 ) … (𝑧 − 𝑟𝑛 ).     Show that           =∑
𝑃 (𝑧)    𝑗=1
𝑧 − 𝑟𝑗
Suggestion: try 𝑛 = 2 and 𝑛 = 3 first.
Following the suggestion for 𝑛 = 2: let 𝑃 (𝑧) = (𝑧 − 𝑟1 )(𝑧 − 𝑟2 ). Using the product rule for
𝑃 ′ we get
𝑃 ′ (𝑧)   (𝑧 − 𝑟2 ) + (𝑧 − 𝑟1 )     1         1
=                       =       +         .
𝑃 (𝑧)      (𝑧 − 𝑟1 )(𝑧 − 𝑟2 )     𝑧 − 𝑟1 𝑧 − 𝑟2
This is exactly what was claimed. The only diﬀiculty in going to larger 𝑛 is in presenting
the argument. We’ll let (𝑧 − 𝑟1 )(𝑧 − 𝑟2 ) −
(𝑧 𝑟3) … (𝑧 − 𝑟𝑛 ) mean the product of all the terms
leaving out the one with the line throught it. Then if 𝑃 (𝑧) = (𝑧 − 𝑟1 )(𝑧 − 𝑟2 ) … (𝑧 − 𝑟𝑛 ) the
product rule gives us
𝑛
𝑃 ′ (𝑧) = ∑(𝑧 − 𝑟1 )(𝑧 − 𝑟2 ) ⋯  −
(𝑧 𝑟
𝑗 ) ⋯ (𝑧 − 𝑟𝑛 ).
𝑗=1
From this it is clear that
𝑃 ′ (𝑧)   𝑛
(𝑧
(𝑧 − 𝑟1 )(𝑧 − 𝑟2 ) ⋯   −𝑟𝑘) ⋯ (𝑧 − 𝑟𝑛 )   𝑛
1
=∑                                              =∑
𝑃 (𝑧)    𝑗=1
(𝑧 − 𝑟1 )(𝑧 − 𝑟2 ) ⋯ (𝑧 − 𝑟𝑗 ) ⋯ (𝑧 − 𝑟𝑛 )  𝑗=1
𝑧 − 𝑟𝑗
𝑑 𝑎𝑧 + 𝑏

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
𝑛
𝑃 ′ (𝑧)        1
Let 𝑃 (𝑧) = (𝑧 − 𝑟1 )(𝑧 − 𝑟2 ) … (𝑧 − 𝑟𝑛 ).       Show that           =∑
𝑃 (𝑧)    𝑗=1
𝑧 − 𝑟𝑗
Suggestion: try 𝑛 = 2 and 𝑛 = 3 first.
𝑑 𝑎𝑧 + 𝑏]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
𝑛
𝑃 ′ (𝑧)        1
Let 𝑃 (𝑧) = (𝑧 − 𝑟1 )(𝑧 − 𝑟2 ) … (𝑧 − 𝑟𝑛 ).       Show that           =∑
𝑃 (𝑧)    𝑗=1
𝑧 − 𝑟𝑗
Suggestion: try 𝑛 = 2 and 𝑛 = 3 first.
𝑑 𝑎𝑧 + 𝑏', '_recupere_le' => '2026-11-04T19:55:22.394344+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Let 𝑃 (𝑧) = (𝑧 − 𝑟1 )(𝑧 − 𝑟2 ) … (𝑧 − 𝑟𝑛 ).     Show that           =∑
𝑃 (𝑧)    𝑗=1
𝑧 − 𝑟𝑗
Suggestion: try 𝑛 = 2 and 𝑛 = 3 first.
Following the suggestion for 𝑛 = 2: let 𝑃 (𝑧')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Let 𝑓(𝑧) be analytic in a 𝐷 a disk centered at the origin. Show that 𝐹1 (𝑧) = 𝑓(𝑧) is
analytic in 𝐷.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Then
𝐹1 (𝑧) = 𝑓(𝑧) = 𝑢(𝑥, −𝑦) − 𝑖𝑣(𝑥, −𝑦).
We can write 𝐹1 (𝑧) = 𝑈1 (𝑥, 𝑦) + 𝑖𝑉1 (𝑥, 𝑦), where 𝑈1 (𝑥, 𝑦) = 𝑢(𝑥, −𝑦) and 𝑉1 (𝑥, 𝑦) =
−𝑣(𝑥, −𝑦). Since 𝑓(𝑧) is analytic the Cauchy-Riemann equations say that 𝑢𝑥 = 𝑣𝑦 and
𝑢𝑦 = −𝑣𝑥 . To check the Cauchy-Riemann equations on 𝐹1 we take the partial derivatives
of 𝑈1 and 𝑉1 . (We need to be careful with the −𝑦 when taking partials with respect to 𝑦.):
𝜕𝑈1           𝜕𝑢             𝜕𝑈1     𝜕𝑢
(𝑥, 𝑦) =    (𝑥, −𝑦),        = − (𝑥, −𝑦)
𝜕𝑥           𝜕𝑥              𝜕𝑦     𝜕𝑦
𝜕𝑉1            𝜕𝑣             𝜕𝑉1   𝜕𝑣
(𝑥, 𝑦) = − (𝑥, −𝑦),           =    (𝑥, −𝑦)
𝜕𝑥             𝜕𝑥             𝜕𝑦    𝜕𝑦
Applying the C-R equations for 𝑓(𝑧) we see they are satisfied by 𝐹1 (𝑧):
𝜕𝑈1          𝜕𝑢           𝜕𝑣           𝜕𝑉1
(𝑥, 𝑦) =    (𝑥, −𝑦) =    (𝑥, −𝑦) =     (𝑥, 𝑦)
𝜕𝑥           𝜕𝑥           𝜕𝑦            𝜕𝑦
𝜕𝑈1           𝜕𝑢           𝜕𝑣              𝜕𝑉
(𝑥, 𝑦) = − (𝑥, −𝑦) =       (𝑥, −𝑦) = − 1 (𝑥, 𝑦)
𝜕𝑦           𝜕𝑦           𝜕𝑥              𝜕𝑥
Thus, 𝐹1 (𝑧) is analytic.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Let 𝑓(𝑧) be analytic in a 𝐷 a disk centered at the origin. Show that 𝐹1 (𝑧) = 𝑓(𝑧) is
analytic in 𝐷.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Let 𝑓(𝑧) be analytic in a 𝐷 a disk centered at the origin. Show that 𝐹1 (𝑧) = 𝑓(𝑧) is
analytic in 𝐷.', '_recupere_le' => '2026-11-04T19:55:22.394419+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Then
𝐹1 (𝑧) = 𝑓(𝑧) = 𝑢(𝑥, −𝑦) − 𝑖𝑣(𝑥, −𝑦).
We can write 𝐹1 (𝑧) = 𝑈1 (𝑥, 𝑦) + 𝑖𝑉1 (𝑥, 𝑦), where 𝑈1 (𝑥, 𝑦) = 𝑢(𝑥, −𝑦) and 𝑉1 (𝑥, 𝑦) =
−𝑣(𝑥, −𝑦). Since 𝑓(𝑧) is analytic the Cauc')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(30: 10,10,10 points)
1
Show that ∫𝐶 𝑧2 𝑑𝑧 = 0 for any simple closed curve 𝐶 in 2 ways.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Show that ∫𝐶 𝑧2 𝑑𝑧 = 0 for any simple closed curve 𝐶 in 2 ways.
(i) Apply the fundamental theorem of complex line integrals
(ii) Write out both the real and imaginary parts of the integral as 18.02 integrals of the form
∫𝐶 𝑀 𝑑𝑥 + 𝑁 𝑑𝑦 and apply Green’s theorem to each part.
(i) Let 𝑓(𝑧) = 𝑧 2 . We know this has the antiderivative 𝐹 (𝑧) = 𝑧 3 /3. There fore ∫𝐶 𝑓(𝑧) 𝑑𝑧 =
𝐹 (𝑧1 )−𝐹 (𝑧0 ), where 𝑧0 and 𝑧1 are the endpoints of the curve 𝐶. Since these points coincide,
the integral must be 0.
(ii) This requires some algebraic manipulation. Let 𝑧 = 𝑥 + 𝑖𝑦. Then
𝑧 2 = (𝑥 + 𝑖𝑦)2 = 𝑥2 − 𝑦2 + 𝑖2𝑥𝑦
So,
𝑧 2 𝑑𝑧 = 𝑧 2 (𝑑𝑥 + 𝑖 𝑑𝑦) = ((𝑥2 − 𝑦2 ) 𝑑𝑥 − 2𝑥𝑦 𝑑𝑦) + 𝑖 (2𝑥𝑦 𝑑𝑥 + (𝑥2 − 𝑦2 ) 𝑑𝑦) .
It is clear that everything here is defined and differentiable on all of R2 . So we can apply
Green’s theorem to each part of the integral. (Here 𝑅 is the interior of the simple closed
curve 𝐶.)
Real part: ∫(𝑥2 − 𝑦2 ) 𝑑𝑥 − 2𝑥𝑦 𝑑𝑦. So, 𝑀 = 𝑥2 − 𝑦2 , 𝑁 = −2𝑥𝑦. Taking the curl we get
𝐶
𝑁𝑥 − 𝑀𝑦 = −2𝑦 − (−2𝑦) = 0. Therefore, by Green’s theorem the integral is 0.
Imaginaray part: We have 𝑀 = 2𝑥𝑦, 𝑁 = 𝑥2 + 𝑦2 . So, 𝑁𝑥 − 𝑀𝑦 = 2𝑥 − 2𝑥 = 0. Again,
Green’s theorem implies the integral is 0.
1

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(30: 10,10,10 points)
1
Show that ∫𝐶 𝑧2 𝑑𝑧 = 0 for any simple closed curve 𝐶 in 2 ways.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(30: 10,10,10 points)
1
Show that ∫𝐶 𝑧2 𝑑𝑧 = 0 for any simple closed curve 𝐶 in 2 ways.', '_recupere_le' => '2026-11-04T19:55:22.394482+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Show that ∫𝐶 𝑧2 𝑑𝑧 = 0 for any simple closed curve 𝐶 in 2 ways.
(i) Apply the fundamental theorem of complex line integrals
(ii) Write out both the real and imaginary parts o')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Let 𝐶 be the unit circle traversed counterclockwise. Directly from the definition of
complex line integrals compute ∫ 𝑧𝑑𝑧.
𝐶
Is this the same as ∫ 𝑧 𝑑𝑧?
𝐶', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝐶 be the unit circle traversed counterclockwise. Directly from the definition of
complex line integrals compute ∫ 𝑧𝑑𝑧.
𝐶
Is this the same as ∫ 𝑧 𝑑𝑧?
𝐶
Parametrize 𝐶: 𝛾(𝑡) = e𝑖𝑡 , with 0 ≤ 𝑡 ≤ 2𝜋. So, 𝛾 ′ (𝑡) = 𝑖e𝑖𝑡 . Putting this into the integral
gives
2𝜋                        2𝜋
∫ 𝑧 𝑑𝑧 = ∫             e𝑖𝑡 𝑖 e𝑖𝑡 𝑑𝑡 = ∫          𝑖 𝑑𝑡 = 2𝜋𝑖.
𝐶            0                         0
This is not the same as ∫ 𝑧 𝑑𝑧 which equals 0.
𝐶

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Let 𝐶 be the unit circle traversed counterclockwise. Directly from the definition of
complex line integrals compute ∫ 𝑧𝑑𝑧.
𝐶
Is this the same as ∫ 𝑧 𝑑𝑧?
𝐶]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Let 𝐶 be the unit circle traversed counterclockwise. Directly from the definition of
complex line integrals compute ∫ 𝑧𝑑𝑧.
𝐶
Is this the same as ∫ 𝑧 𝑑𝑧?
𝐶', '_recupere_le' => '2026-11-04T19:55:22.394567+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Let 𝐶 be the unit circle traversed counterclockwise. Directly from the definition of
complex line integrals compute ∫ 𝑧𝑑𝑧.
𝐶
Is this the same as ∫ 𝑧 𝑑𝑧?
𝐶
Parametrize 𝐶: 𝛾(𝑡)')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Let 𝐶 be the circle of radius 1 centered at 𝑧 = −4. Let 𝑓(𝑧) = 1/(𝑧 + 4). and consider the
line integral
𝐼 = ∫ 𝑓(𝑧) 𝑑𝑧.
𝐶
Parametrize the curve 𝐶 and carry out the calculation to find the value of 𝐼. Check
that the', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Parametrize the curve 𝐶 and carry out the calculation to find the value of 𝐼. Check
that the answer confirms your excellent reasoning in part (a).
Parametrize 𝐶: 𝛾(𝑡) = −4 + e𝑖𝑡 , with 0 ≤ 𝑡 ≤ 2𝜋. So, 𝛾 ′ (𝑡) = 𝑖e𝑖𝑡 . Now compute the
integral:
2𝜋               2𝜋
1                1 𝑖𝑡
∫     𝑑𝑧 = ∫           𝑖e 𝑑𝑡 = ∫    𝑖 𝑑𝑡 = 2𝜋𝑖.
𝛾 𝑧+4         0    e𝑖𝑡         0', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'choices' => array('Impossible à déterminer', 'Pas confirms your excellent reasoning in part (a).
1', 'L\'inverse de confirms your excellent reasoning in part (a).
1', 'confirms your excellent reasoning in part (a).
1'), 'correct' => 3, 'answer' => 'confirms your excellent reasoning in part (a).
1', '_recupere_le' => '2026-11-04T19:55:22.394744+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 10,5 points)
Repeat using the branch with 𝜋 ≤ arg(𝑧) < 3𝜋.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Repeat using the branch with 𝜋 ≤ arg(𝑧) < 3𝜋.
This is the same as part (a) except we need to use 2𝜋 ≤ 𝑡 ≤ 3𝜋. So,
3𝜋
3 𝑖4𝑡/3 3𝜋 3              3
∫𝑧 1/3 𝑑𝑧 = ∫           e𝑖𝑡/3 𝑖e𝑖𝑡 =     e    ∣ = (1 − e𝑖8𝜋/3 ) = (1 − e𝑖2𝜋/3 ) = e2𝜋/3 ⋅ part (a).
𝛾           2𝜋                        4       2𝜋 4              4

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(15: 10,5 points)
Repeat using the branch with 𝜋 ≤ arg(𝑧) < 3𝜋.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(15: 10,5 points)
Repeat using the branch with 𝜋 ≤ arg(𝑧) < 3𝜋.', '_recupere_le' => '2026-11-04T19:55:22.394801+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Repeat using the branch with 𝜋 ≤ arg(𝑧) < 3𝜋.
This is the same as part (a) except we need to use 2𝜋 ≤ 𝑡 ≤ 3𝜋. So,
3𝜋
3 𝑖4𝑡/3 3𝜋 3              3
∫𝑧 1/3 𝑑𝑧 = ∫           e𝑖𝑡/3')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(20: 5,5,5,5 points)
Compute ∫      2
𝑑𝑧, where 𝐶 is the circle of radius 1 centered at 𝑧 = 𝑖.
𝐶 𝑧 +1', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute ∫ 2      𝑑𝑧, where 𝐶 is the circle of radius 1 centered at 𝑧 = 𝑖.
𝐶 𝑧 +1
𝑧2           𝑧2
Let 𝑓(𝑧) =          =                . The only singularity of 𝑓 inside 𝐶 is at 𝑧 = −𝑖.
𝑧2 + 1   (𝑧 + 𝑖)(𝑧 − 𝑖)
Im(z)
C
i
Re(z)
𝑧2
We let 𝑔(𝑧) =       , so 𝑓(𝑧) = 𝑔(𝑧)/(𝑧 − 𝑖). By Cauchy’s integral formula we have
𝑧+𝑖
𝑔(𝑧)
∫ 𝑓(𝑧) 𝑑𝑧 = ∫               𝑑𝑧 = 2𝜋𝑖𝑔(𝑖) = −𝜋 .
𝐶                   𝐶 𝑧−𝑖

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(20: 5,5,5,5 points)
Compute ∫      2
𝑑𝑧, where 𝐶 is the circle of radius 1 centered at 𝑧 = 𝑖.
𝐶 𝑧 +1]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(20: 5,5,5,5 points)
Compute ∫      2
𝑑𝑧, where 𝐶 is the circle of radius 1 centered at 𝑧 = 𝑖.
𝐶 𝑧 +1', '_recupere_le' => '2026-11-04T19:55:22.394876+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Compute ∫ 2      𝑑𝑧, where 𝐶 is the circle of radius 1 centered at 𝑧 = 𝑖.
𝐶 𝑧 +1
𝑧2           𝑧2
Let 𝑓(𝑧) =          =                . The only singularity of 𝑓 inside 𝐶 is')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(20: 5,5,5,5 points)
Let 𝜃 = arg(𝑧) Take 𝐶 to be the wavy contour in the 𝑧-plane described by 0 ≤ arg(𝑧) ≤
𝜋; |𝑧| = 1 − 0.1 cos(100𝜃). Compute the integral ∫ 𝑧2 𝑑𝑧.
𝐶', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝜃 = arg(𝑧) Take 𝐶 to be the wavy contour in the 𝑧-plane described by 0 ≤ arg(𝑧) ≤ 𝜋;
|𝑧| = 1 − 0.1 cos(100𝜃). Compute the integral ∫ 𝑧2 𝑑𝑧.
𝐶
Method 1. Use the antiderivative:
−0.9
2    𝑧3
∫ 𝑧 𝑑𝑧 =    ∣  = −2(0.9)3 .
𝐶        3 0.9
Method 2. 𝐶 is not closed so we close it off by adding the straight line 𝐶1 from -1 to 1
along the 𝑥-axis.
18.04 Problem Set 4, Spring 2018 Solutions                                                       4
Now, by Cauchy’s theorem ∫           𝑧 2 𝑑𝑧 = 0, so
𝐶+𝐶1
0.9
∫ 𝑧2 𝑑𝑧 = − ∫ 𝑧 2 𝑑𝑧 = − ∫                  𝑥2 𝑑𝑥 = −2(0.9)3 .
𝐶              𝐶1                  −0.9

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(20: 5,5,5,5 points)
Let 𝜃 = arg(𝑧) Take 𝐶 to be the wavy contour in the 𝑧-plane described by 0 ≤ arg(𝑧) ≤
𝜋; |𝑧| = 1 − 0.1 cos(100𝜃). Compute the integral ∫ 𝑧2 𝑑𝑧.
𝐶]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(20: 5,5,5,5 points)
Let 𝜃 = arg(𝑧) Take 𝐶 to be the wavy contour in the 𝑧-plane described by 0 ≤ arg(𝑧) ≤
𝜋; |𝑧| = 1 − 0.1 cos(100𝜃). Compute the integral ∫ 𝑧2 𝑑𝑧.
𝐶', '_recupere_le' => '2026-11-04T19:55:22.394976+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Let 𝜃 = arg(𝑧) Take 𝐶 to be the wavy contour in the 𝑧-plane described by 0 ≤ arg(𝑧) ≤ 𝜋;
|𝑧| = 1 − 0.1 cos(100𝜃). Compute the integral ∫ 𝑧2 𝑑𝑧.
𝐶
Method 1. Use the antideriva')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 10,5 points)
Let 𝑃 (𝑧) = 𝑐𝑜 + 𝑐1 𝑧 + 𝑐2 𝑧2 + 𝑐3 𝑧3 . Let 𝐶 be the circle |𝑧| = 𝑎, for 𝑎 > 0. Compute the
integral
∫ 𝑃 (𝑧)𝑧 −𝑛 𝑑𝑧 for n = 0, 1, 2, …
𝐶', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑃 (𝑧) = 𝑐𝑜 + 𝑐1 𝑧 + 𝑐2 𝑧2 + 𝑐3 𝑧3 . Let 𝐶 be the circle |𝑧| = 𝑎, for 𝑎 > 0. Compute the
integral
∫ 𝑃 (𝑧)𝑧−𝑛 𝑑𝑧 for n = 0, 1, 2, …
𝐶
This is harder to express that to see. The key is our well known fact:
0      if 𝑚 ≠ −1
∫ 𝑧 𝑚 𝑑𝑧 = {
𝐶                  2𝜋𝑖    if 𝑚 = −1
So
∫ 𝑃 (𝑧)𝑧−𝑛 𝑑𝑧 = ∫ 𝑐0 𝑧−𝑛 + 𝑐1 𝑧1−𝑛 + 𝑐3 𝑧3−𝑛 + 𝑐3 𝑧3−𝑛 𝑑𝑧
𝐶                      𝐶
Most of these terms integrate to 0. We have:
If 𝑛 = 1 then the integral is 2𝜋𝑖𝑐0 .
If 𝑛 = 2 then the integral is 2𝜋𝑖𝑐1 .
If 𝑛 = 3 then the integral is 2𝜋𝑖𝑐2 .
If 𝑛 = 4 then the integral is 2𝜋𝑖𝑐3 .
For all other 𝑛 the integral is 0.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(15: 10,5 points)
Let 𝑃 (𝑧) = 𝑐𝑜 + 𝑐1 𝑧 + 𝑐2 𝑧2 + 𝑐3 𝑧3 . Let 𝐶 be the circle |𝑧| = 𝑎, for 𝑎 > 0. Compute the
integral
∫ 𝑃 (𝑧)𝑧 −𝑛 𝑑𝑧 for n = 0, 1, 2, …
𝐶]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(15: 10,5 points)
Let 𝑃 (𝑧) = 𝑐𝑜 + 𝑐1 𝑧 + 𝑐2 𝑧2 + 𝑐3 𝑧3 . Let 𝐶 be the circle |𝑧| = 𝑎, for 𝑎 > 0. Compute the
integral
∫ 𝑃 (𝑧)𝑧 −𝑛 𝑑𝑧 for n = 0, 1, 2, …
𝐶', '_recupere_le' => '2026-11-04T19:55:22.395074+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Let 𝑃 (𝑧) = 𝑐𝑜 + 𝑐1 𝑧 + 𝑐2 𝑧2 + 𝑐3 𝑧3 . Let 𝐶 be the circle |𝑧| = 𝑎, for 𝑎 > 0. Compute the
integral
∫ 𝑃 (𝑧)𝑧−𝑛 𝑑𝑧 for n = 0, 1, 2, …
𝐶
This is harder to express that to see.')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
|𝑧|e𝑧
Compute ∫                               𝑑𝑥.
−∞   (𝑥2 + 1)(𝑥2 + 4)
Hint: integrate over the closed path shown below. Show that as 𝑅 goes to infinity the
contribution of the integral over 𝐶𝑅 becomes 0.
Im(z)
CR                            CR
Re(z)
−R                C1          R
1', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute ∫         2 + 1)(𝑥2 + 4)
𝑑𝑥.
−∞ (𝑥
Hint: integrate over the closed path shown below. Show that as 𝑅 goes to infinity the
contribution of the integral over 𝐶𝑅 becomes 0.
18.04 Problem Set 4, Spring 2018 Solutions                                                 6
Im(z)
CR           2i       CR
i
Re(z)
−R               C1    R
There is an example like this in the topic 4 notes. The strategy is:
𝑓(𝑧)
1. Let 𝑓(𝑧) = 2                 and use Cauchy’s formula to evaluate ∫      𝑓(𝑧) 𝑑𝑧.
(𝑧 + 1)(𝑧 2 + 4)                                       𝐶1 +𝐶𝑅
2. Notice that lim ∫ 𝑓(𝑧) 𝑑𝑠 = the integral we want to compute.
𝑅→∞
𝐶1
3. Show that lim ∫ 𝑓(𝑧) 𝑑𝑠 = 0.
𝑅→∞
𝐶𝑅
1
Step 1. 𝑓(𝑧) =                                   . For 𝑅 large enough the singularities of 𝑓
(𝑧 + 𝑖)(𝑧 − 𝑖)(𝑧 + 2𝑖)(𝑧 − 2𝑖)
inside 𝐶1 + 𝐶𝑅 are 𝑧 = 𝑖 and 𝑧 = 2𝑖. As before, we break 𝐶1 + 𝐶𝑅 into two loops, each
enclosing one of the singularities. We won’t bother drawing or naming the loops.
1
Loop around 𝑧 = 𝑖: Let 𝑔(𝑧) =                            . So, by Cauchy,
(𝑧 + 𝑖)(𝑧 + 2𝑖)(𝑧 − 2𝑖)
𝑔(𝑧)                𝜋
∫       𝑓(𝑧) 𝑑𝑧 = ∫            𝑑𝑧 = 2𝜋𝑖𝑔(𝑖) = .
loop               loop 𝑧 − 𝑖               3
1
Loop around 𝑧 = 2𝑖: Let 𝑔(𝑧) =                                . So, by Cauchy,
(𝑧 + 𝑖)(𝑧 − 𝑖)(𝑧 + 2𝑖)
𝑔(𝑧)                   𝜋
∫         𝑓(𝑧) 𝑑𝑧 = ∫           𝑑𝑧 = 2𝜋𝑖𝑔(2𝑖) = − .
loop             loop 𝑧 − 2𝑖                  6
𝜋 𝜋  𝜋
Totaling, ∫        𝑓(𝑧) 𝑑𝑧 =       − = .
𝐶1 +𝐶𝑅                 3  6 6
Step 2. This is clear: parametrize 𝐶1 as 𝛾(𝑥) = 𝑥, with −𝑅 ≤ 𝑥 ≤ 𝑅; 𝛾 ′ (𝑥) = 1. So,
𝑅
1
∫ 𝑓(𝑧) 𝑑𝑧 = ∫         2 + 1)(𝑥2 + 4)
𝑑𝑥
𝐶1              −𝑅 (𝑥
this clearly goes to the integral from −∞ to ∞ in the limit.
Note: we should verify that the improper integral is absolutely convergent. But this is clear
since the denominator grows like 𝑥4 and is never 0 on the real axis.
18.04 Problem Set 4, Spring 2018 Solutions                                                                    7
Step 3. Parametrize 𝐶𝑅 : 𝛾(𝜃) = 𝑅e𝑖𝜃 , with 0 ≤ 𝜃 ≤ 𝜋. So,
𝜋
1
∣∫ 𝑓(𝑧) 𝑑𝑧∣ = ∣∫                                             𝑖𝑅e𝑖𝜃 𝑑𝜃∣
𝐶𝑅                  0       (𝑅2 e𝑖2𝜃 + 1)(𝑅2 e𝑖2𝜃+4 )
𝜋
1
≤∫ ∣                                      𝑖𝑅e𝑖𝜃 ∣ 𝑑𝜃                 (triangle inequality)
0       (𝑅2 e𝑖2𝜃 + 1)(𝑅2 e𝑖2𝜃+4 )
𝜋
1
=∫                                            𝑅, 𝑑𝜃
0       |𝑅2 e𝑖2𝜃 + 1| |𝑅2 e𝑖2𝜃+4 |
𝜋
1
𝑙𝑒 ∫                                  𝑅, 𝑑𝜃                  (also by triangle inequality)
0       |𝑅2 − 1| |𝑅2 − 4|
𝑅𝜋
=
|𝑅2 − 1| |𝑅2 − 4|
This goes to 0 as 𝑅 goes to ∞ as required by our strategy.
Putting the steps together:
∞
1                                                𝜋  𝜋
∫                                       𝑑𝑥 = lim ∫          𝑓(𝑧) 𝑑𝑧 = lim  = .
−∞     (𝑥2 + 1)(𝑥2 + 4)                    𝑅→∞
𝐶1 +𝐶𝑅
𝑅→∞ 6   6
1

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
|𝑧|e𝑧
Compute ∫                               𝑑𝑥.
−∞   (𝑥2 + 1)(𝑥2 + 4)
Hint: integrate over the closed path shown below. Show that as 𝑅 goes to infinity the
contribution of the integral over 𝐶𝑅 becomes 0.
Im(z)
CR                            CR
Re(z)
−R                C1          R
1]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
|𝑧|e𝑧
Compute ∫                               𝑑𝑥.
−∞   (𝑥2 + 1)(𝑥2 + 4)
Hint: integrate over the closed path shown below. Show that as 𝑅 goes to infinity the
contribution of the integral over 𝐶𝑅 becomes 0.
Im(z)
CR                            CR
Re(z)
−R                C1          R
1', '_recupere_le' => '2026-11-04T19:55:22.395257+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Compute ∫         2 + 1)(𝑥2 + 4)
𝑑𝑥.
−∞ (𝑥
Hint: integrate over the closed path shown below. Show that as 𝑅 goes to infinity the
contribution of the integral over 𝐶𝑅 becomes')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(10: 5,5 points)
Prove the more general formula
2𝜋
𝑛!
𝑓 (𝑛) (𝑧0 ) =       ∫           𝑓(𝑧0 + 𝑟e𝑖𝜃 )e−𝑖𝑛𝜃 𝑑𝜃.
2𝜋𝑟𝑛 0', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Prove the more general formula
2𝜋
𝑛!
𝑓 (𝑛) (𝑧0 ) =       ∫         𝑓(𝑧0 + 𝑟e𝑖𝜃 )e−𝑖𝑛𝜃 𝑑𝜃.
2𝜋𝑟𝑛 0
Use the same curve as in part (a). This time use Cauchy’s formula for derivatives.
2𝜋                                         2𝜋
𝑛!        𝑓(𝑧)            𝑛!            𝑓(𝑧0 + 𝑟e𝑖𝜃 ) 𝑖𝜃       𝑛!
𝑓 (𝑛) (𝑧0 ) =       ∫            𝑛+1
𝑑𝑧 =     ∫                       𝑖𝑟e 𝑑𝜃 =     ∫                𝑓(𝑧0 +𝑟e𝑖𝜃 )e−𝑖𝑛𝜃 𝑑𝜃.
2𝜋𝑖 𝐶𝑟 (𝑧 − 𝑧0 )          2𝜋𝑖 0           𝑛+1
𝑟 e  𝑖(𝑛+1)𝜃          2𝜋𝑟𝑛 0
This is what we needed to prove.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(10: 5,5 points)
Prove the more general formula
2𝜋
𝑛!
𝑓 (𝑛) (𝑧0 ) =       ∫           𝑓(𝑧0 + 𝑟e𝑖𝜃 )e−𝑖𝑛𝜃 𝑑𝜃.
2𝜋𝑟𝑛 0]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(10: 5,5 points)
Prove the more general formula
2𝜋
𝑛!
𝑓 (𝑛) (𝑧0 ) =       ∫           𝑓(𝑧0 + 𝑟e𝑖𝜃 )e−𝑖𝑛𝜃 𝑑𝜃.
2𝜋𝑟𝑛 0', '_recupere_le' => '2026-11-04T19:55:22.395341+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Prove the more general formula
2𝜋
𝑛!
𝑓 (𝑛) (𝑧0 ) =       ∫         𝑓(𝑧0 + 𝑟e𝑖𝜃 )e−𝑖𝑛𝜃 𝑑𝜃.
2𝜋𝑟𝑛 0
Use the same curve as in part (a). This time use Cauchy’s formula for derivat')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Suppose 𝑓(𝑧) is analytic on a simply connected region 𝐴 and 𝛾 is a simple closed curve
in 𝐴. Fix 𝑧0 in 𝐴, but not on 𝛾. Use the Cauchy integral formulas to show that
𝑓 ′ (𝑧)            𝑓(𝑧)
∫            𝑑𝑧 = ∫            𝑑𝑧.
𝛾 𝑧 −  𝑧 0      𝛾 (𝑧 − 𝑧0 )2', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Suppose 𝑓(𝑧) is analytic on a simply connected region 𝐴 and 𝛾 is a simple closed curve
in 𝐴. Fix 𝑧0 in 𝐴, but not on 𝛾. Use the Cauchy integral formulas to show that
𝑓 ′ (𝑧)            𝑓(𝑧)
∫           𝑑𝑧 = ∫            𝑑𝑧.
𝛾 𝑧 −  𝑧 0      𝛾 (𝑧 − 𝑧0 )2
Since 𝐴 is simply connected we know 𝑓 and 𝑓 ′ are analytic on and inside 𝛾. There are two
cases: (i) 𝑧0 is inside 𝛾, (ii) 𝑧0 is outside 𝛾.
In case (i) we can use Cauchy’s formulas.
𝑓 ′ (𝑧)
∫          𝑑𝑧 = 2𝜋𝑖𝑓 ′ (𝑧0 )                (by Cauchy’s integral formula.)
𝛾 𝑧 −  𝑧 0
𝑓(𝑧)
∫            2
𝑑𝑧 = 2𝜋𝑖𝑓 ′ (𝑧0 )         (by Cauchy’s formula for derivatives.)
𝛾 (𝑧 − 𝑧 0 )
These are the same.
In case (ii) both integrands are analytic on and inside 𝛾, so both integrals are 0 by Cauchy’s
theorem. Again, the integrals are the same. QED

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Suppose 𝑓(𝑧) is analytic on a simply connected region 𝐴 and 𝛾 is a simple closed curve
in 𝐴. Fix 𝑧0 in 𝐴, but not on 𝛾. Use the Cauchy integral formulas to show that
𝑓 ′ (𝑧)            𝑓(𝑧)
∫            𝑑𝑧 = ∫            𝑑𝑧.
𝛾 𝑧 −  𝑧 0      𝛾 (𝑧 − 𝑧0 )2]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Suppose 𝑓(𝑧) is analytic on a simply connected region 𝐴 and 𝛾 is a simple closed curve
in 𝐴. Fix 𝑧0 in 𝐴, but not on 𝛾. Use the Cauchy integral formulas to show that
𝑓 ′ (𝑧)            𝑓(𝑧)
∫            𝑑𝑧 = ∫            𝑑𝑧.
𝛾 𝑧 −  𝑧 0      𝛾 (𝑧 − 𝑧0 )2', '_recupere_le' => '2026-11-04T19:55:22.395475+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Suppose 𝑓(𝑧) is analytic on a simply connected region 𝐴 and 𝛾 is a simple closed curve
in 𝐴. Fix 𝑧0 in 𝐴, but not on 𝛾. Use the Cauchy integral formulas to show that
𝑓 ′ (𝑧)')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
𝑓(𝑧)
Suppose 𝑓(𝑧) is entire and lim     = 0. Show that 𝑓(𝑧) is constant.
                            𝑧→∞𝑧
You may use Morera’s theorem: if 𝑔(𝑧) is analytic on 𝐴 − {𝑧0 } and continuous on 𝐴, then
𝑓 is analytic on 𝐴.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑔(𝑧) =                . Since 𝑔(𝑧) is analytic on C − {0} and continuous on C
𝑧
it is analytic on all of C, by Morera’s theorem
We claim 𝑔(𝑧) ≡ 0.
Suppose not, then we can pick a point 𝑧0 with 𝑔(𝑧0 ) ≠ 0. Since 𝑔(𝑧) goes to 0 as |𝑧| gets
large we can pick 𝑅 large enough that |𝑔(𝑧)| < |𝑔(𝑧0 )| for all |𝑧| = 𝑅. But this violates the
maximum modulus theorem, which says that the maximum modulus of 𝑔(𝑧) on the disk
18.04 Problem Set 4, Spring 2018 Solutions                                              12
|𝑧| ≤ 𝑅 occurs on the circle |𝑧| = 𝑅. This disaster means our assumption that 𝑔(𝑧) ≠ 0 was
wrong. We conclude 𝑔(𝑧) ≡ 0 as claimed.
This means that 𝑓(𝑧) = 𝑓(0) for all 𝑧, i.e. 𝑓(𝑧) is constant.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
𝑓(𝑧)
Suppose 𝑓(𝑧) is entire and lim     = 0. Show that 𝑓(𝑧) is constant.
                            𝑧→∞𝑧
You may use Morera’s theorem: if 𝑔(𝑧) is analytic on 𝐴 − {𝑧0 } and continuous on 𝐴, then
𝑓 is analytic on 𝐴.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
𝑓(𝑧)
Suppose 𝑓(𝑧) is entire and lim     = 0. Show that 𝑓(𝑧) is constant.
                            𝑧→∞𝑧
You may use Morera’s theorem: if 𝑔(𝑧) is analytic on 𝐴 − {𝑧0 } and continuous on 𝐴, then
𝑓 is analytic on 𝐴.', '_recupere_le' => '2026-11-04T19:55:22.395592+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Let 𝑔(𝑧) =                . Since 𝑔(𝑧) is analytic on C − {0} and continuous on C
𝑧
it is analytic on all of C, by Morera’s theorem
We claim 𝑔(𝑧) ≡ 0.
Suppose not, then we ca')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
cos(𝑧)
Compute ∫      2+𝑧+1
𝑑𝑧 where 𝐶 is the circle |𝑧| = 2.
𝐶 𝑧', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : There are two roots. Splitting the contour as we’ve done several times leads to a
total integral of 0.
18.04 Complex Variables with Applications
Spring 2018
For information about citing these materials or our Terms of Use, visit:

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
cos(𝑧)
Compute ∫      2+𝑧+1
𝑑𝑧 where 𝐶 is the circle |𝑧| = 2.
𝐶 𝑧]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
cos(𝑧)
Compute ∫      2+𝑧+1
𝑑𝑧 where 𝐶 is the circle |𝑧| = 2.
𝐶 𝑧', '_recupere_le' => '2026-11-04T19:55:22.395729+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : There are two roots. Splitting the contour as we’ve done several times leads to a
total integral of 0.
18.04 Complex Variables with Applications
Spring 2018
For information a')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Suppose 𝑢(𝑥, 𝑦) = 𝑥/𝑟2 , where 𝑟 is the usual polar 𝑟. Show that 𝑢 is harmonic and find
a harmonic conjugate 𝑣 such that 𝑓 = 𝑢 + 𝑖𝑣 is analytic.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Before we start: we’ll need the following formulas to help manage the algebra.
𝜕𝑟       𝑥       𝜕𝑟        𝑦
𝑟 = √𝑥2 + 𝑦2 ,      = 𝑟𝑥 = ,         = 𝑟𝑦 =                         (1)
𝜕𝑥       𝑟       𝜕𝑦        𝑟
First check that 𝑢 is harmonic.
𝑢 = 𝑥𝑟−2
𝑢𝑥 = 𝑟−2 − 2𝑥2 𝑟−4          𝑢𝑥𝑥 = −2𝑥𝑟−4 − 4𝑥𝑟−4 + 8𝑥3 𝑟−6 = −6𝑥𝑟−4 + 8𝑥3 𝑟−6
𝑢𝑦 = −2𝑥𝑦𝑟−4                𝑢𝑦𝑦 = −2𝑥𝑟−4 + 8𝑥𝑦2 𝑟−6
1
18.04 Problem Set 5, Spring 2018 Solutions                                                 2
So,
𝑢𝑥𝑥 + 𝑢𝑦𝑦 = −8𝑥𝑟−4 + 8𝑥3 𝑟−6 + 8𝑥𝑦2 𝑟−6 = −8𝑥𝑦−4 + 8𝑥(𝑥2 + 𝑦2 )𝑟−6 = 0.
This shows 𝑢 is harmonic. (Note: we don’t really need this, since showing that 𝑢 is the
real part of an analytic 𝑓 will guarantee it is harmonic. On the other hand, knowing it is
harmonic means our search for an analytic 𝑓 is guaranteed to be successful.)
Now, we’ll find 𝑓 directly by integrating 𝑓 ′ = 𝑢𝑥 = 𝑖𝑢𝑦 .
−𝑥2 + 𝑦2 + 𝑖2𝑥𝑦     (𝑥 − 𝑖𝑦)2      𝑧2       1
𝑓 ′ = 𝑢𝑥 − 𝑖𝑢𝑦 =           4
= −      4
= −     2
= − 2.
𝑟                𝑟           2
𝑧 𝑧      𝑧
1   𝑧   𝑥 − 𝑖𝑦                   𝑦
Thus, 𝑓(𝑧) =     = 2 =     2
and 𝑣 = Im(𝑓) = − 2 .
𝑧  𝑟      𝑟                     𝑟

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Suppose 𝑢(𝑥, 𝑦) = 𝑥/𝑟2 , where 𝑟 is the usual polar 𝑟. Show that 𝑢 is harmonic and find
a harmonic conjugate 𝑣 such that 𝑓 = 𝑢 + 𝑖𝑣 is analytic.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Suppose 𝑢(𝑥, 𝑦) = 𝑥/𝑟2 , where 𝑟 is the usual polar 𝑟. Show that 𝑢 is harmonic and find
a harmonic conjugate 𝑣 such that 𝑓 = 𝑢 + 𝑖𝑣 is analytic.', '_recupere_le' => '2026-11-04T19:55:22.395822+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Before we start: we’ll need the following formulas to help manage the algebra.
𝜕𝑟       𝑥       𝜕𝑟        𝑦
𝑟 = √𝑥2 + 𝑦2 ,      = 𝑟𝑥 = ,         = 𝑟𝑦 =')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Suppose F = ((𝑥2 − 𝑦2 )/𝑟4 , 2𝑥𝑦/𝑟4 ) is a velocity field. Show that F is divergent free and
irrotational (curl free) and find a complex potential function for F.
Hint: Find the complex potential first.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We follow the hint to find the complex potential Φ. Let F = (𝑢, 𝑣), then
𝑥2 − 𝑦2 − 2𝑖𝑥𝑦   (𝑥 − 𝑖𝑦)2   1
Φ′ = 𝑢 − 𝑖𝑣 =           4
=      4
= 2.
𝑟             𝑟       𝑧
1
So, Φ = − . Since we found a complex potential fo F we have also shown it is divergence
𝑧
and curl free.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Suppose F = ((𝑥2 − 𝑦2 )/𝑟4 , 2𝑥𝑦/𝑟4 ) is a velocity field. Show that F is divergent free and
irrotational (curl free) and find a complex potential function for F.
Hint: Find the complex potential first.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Suppose F = ((𝑥2 − 𝑦2 )/𝑟4 , 2𝑥𝑦/𝑟4 ) is a velocity field. Show that F is divergent free and
irrotational (curl free) and find a complex potential function for F.
Hint: Find the complex potential first.', '_recupere_le' => '2026-11-04T19:55:22.395926+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : We follow the hint to find the complex potential Φ. Let F = (𝑢, 𝑣), then
𝑥2 − 𝑦2 − 2𝑖𝑥𝑦   (𝑥 − 𝑖𝑦)2   1
Φ′ = 𝑢 − 𝑖𝑣 =           4
=      4
= 2.
𝑟             𝑟       𝑧
1
So,')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 10,5 points)
Let 𝐴 be the region bounded by the positive 𝑥 axis and the ray 𝑥 = 𝑦 in the first quadrant.
18.04 Problem Set 5, Spring 2018', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Since 𝜓 = Im(𝑧4 ), we get without effort that the complex potential for the flow is
Φ(𝑧) = 𝑧 4 . If we write Φ′ = 𝑢 − 𝑖𝑣, then the velocity field is F = (𝑢, 𝑣). Computing:
Φ′ = 4𝑧 3 = 4(𝑥3 − 3𝑥𝑦2 ) + 4𝑖(3𝑥2 𝑦 − 𝑦3 )
So, F = (4(𝑥3 − 3𝑥𝑦2 , −4(3𝑥2 𝑦 − 𝑦3 ).
2.0
2.0
1.5
1.5
1.0
1.0
y
y
0.5
0.5
0.0
0.0
0.0     0.5        1.0    1.5   2.0             -2      -1       0     1     2
x                                              x
𝜓𝐻 (right figure) is ‘pulled back’ to the stream function 𝜓 = 𝜓𝐻 (𝑔(𝑧)) (left).
In the figure we only show streamlines in the wedge of interest. The flow associated to
Φ(𝑧) = 𝑧 4 is defined on the entire plane, which is divide into 8 wedges, each containing
streamlines which are wholly contained in the wedge.', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'choices' => array('Pas s                                                               3
let’s interpet the level curves of 𝜓 as the streamlines for an incompressible, irrotational
flow. give the velocity field of this flow.', 'L\'inverse de s                                                               3
let’s interpet the level curves of 𝜓 as the streamlines for an incompressible, irrotational
flow. give the velocity field of this flow.', 'Impossible à déterminer', 's                                                               3
Let’s interpet the level curves of 𝜓 as the streamlines for an incompressible, irrotational
flow. Give the velocity field of this flow.'), 'correct' => 3, 'answer' => 's                                                               3
Let’s interpet the level curves of 𝜓 as the streamlines for an incompressible, irrotational
flow. Give the velocity field of this flow.', '_recupere_le' => '2026-11-04T19:55:22.396104+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Consider the complex potential for a fluid given by Φ(𝑧) = 𝐴𝑧 3 , where 𝐴 > 0:
18.04 Problem Set 5, Spring 2018', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (Figure generated using R.) The wedge boundaries are straight lines given by the level
curve 𝜓 = 0. The stagnation point at the origin is shown. In the vector field, it was diﬀicult
to get a good picture with the arrows draw proportional to the vector’s length, so we made
them all the same size.
2
2
1
1
0
0
y
y
-1
-1
-2
-2
-2     -1     0   1    2             -2   -1   0     1   2
x                                x
Vector field and streamlinesfor Φ(𝑧) = 𝐴𝑧 3 .', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'choices' => array('L\'inverse de s                                                   4
sketch the streamlines and the velocity field in the complex plane.', 'Impossible à déterminer', 'Pas s                                                   4
sketch the streamlines and the velocity field in the complex plane.', 's                                                   4
Sketch the streamlines and the velocity field in the complex plane.'), 'correct' => 3, 'answer' => 's                                                   4
Sketch the streamlines and the velocity field in the complex plane.', '_recupere_le' => '2026-11-04T19:55:22.396246+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Suppose the vector field F = (𝑢, 𝑣) is divergence free and irrotational (curl free). Show that
𝑢 is a harmonic function', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Method 1. We know that there is a complex potential function Φ with Φ′ =
𝑢 − 𝑖𝑣. Since Φ is analytic, so is Φ′ . Since 𝑢 is the real part of an analytic function, it is
harmonic.
Method 2. Divergence and curl free mean
𝑢𝑥 + 𝑣𝑦 = 0 and 𝑣𝑥 − 𝑢𝑦 = 0.
Differentiating these equations by 𝑥 and 𝑦 respectively we have
𝑢𝑥𝑥 + 𝑣𝑦𝑥 = 0 and 𝑣𝑥𝑦 − 𝑢𝑦𝑦 = 0.
Now subtract these two equations to get 𝑢𝑥𝑥 + 𝑢𝑦𝑦 = 0 as needed.
18.04 Problem Set 5, Spring 2018 Solutions                                                    5

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Suppose the vector field F = (𝑢, 𝑣) is divergence free and irrotational (curl free). Show that
𝑢 is a harmonic function]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Suppose the vector field F = (𝑢, 𝑣) is divergence free and irrotational (curl free). Show that
𝑢 is a harmonic function', '_recupere_le' => '2026-11-04T19:55:22.396318+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Method 1. We know that there is a complex potential function Φ with Φ′ =
𝑢 − 𝑖𝑣. Since Φ is analytic, so is Φ′ . Since 𝑢 is the real part of an analytic function, it is
harmo')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Let 𝐴 be the unit disk. Assume it is made of a heat conducting material and that in our
two dimensional world it only loses heat through its boundary. Then at steady state the
temperature 𝑇 (𝑥, 𝑦) in the disk is a harmonic function.
Suppose we hold the temperature of the boundary fixed at
𝑇 (e𝑖𝜃 ) = 𝑇 (cos(𝜃), sin(𝜃)) = sin2 (𝜃).
What is the maximum temperature on the disk?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The maximum value principle says 𝑇 attains its maximum on the boundary. The
maximum of sin2 (𝜃) is 1 ..

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Let 𝐴 be the unit disk. Assume it is made of a heat conducting material and that in our
two dimensional world it only loses heat through its boundary. Then at steady state the
temperature 𝑇 (𝑥, 𝑦) in the disk is a harmonic function.
Suppose we hold the temperature of the boundary fixed at
𝑇 (e𝑖𝜃 ) = 𝑇 (cos(𝜃), sin(𝜃)) = sin2 (𝜃).
What is the maximum temperature on the disk?]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Let 𝐴 be the unit disk. Assume it is made of a heat conducting material and that in our
two dimensional world it only loses heat through its boundary. Then at steady state the
temperature 𝑇 (𝑥, 𝑦) in the disk is a harmonic function.
Suppose we hold the temperature of the boundary fixed at
𝑇 (e𝑖𝜃 ) = 𝑇 (cos(𝜃), sin(𝜃)) = sin2 (𝜃).
What is the maximum temperature on the disk?', '_recupere_le' => '2026-11-04T19:55:22.396487+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The maximum value principle says 𝑇 attains its maximum on the boundary. The
maximum of sin2 (𝜃) is 1 ..

[Correction officielle MIT : [MIT 18.04 — question d’examen, en angla')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Find the radius of convergence.
∞
𝑧3𝑛
𝑓1 (𝑧) = ∑           (b) 𝑓2 (𝑧) = 1 + 3(𝑧 − 1) + 3(𝑧 − 1)2 + (𝑧 − 1)3
𝑛=0
2𝑛', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑓1 (𝑧) = ∑             (b) 𝑓2 (𝑧) = 1 + 3(𝑧 − 1) + 3(𝑧 − 1)2 + (𝑧 − 1)3
𝑛=0
2𝑛
𝑧3
answers: (a) The series is a geometric series with ratio              . The series converges if
2
|𝑧 3 |/2 < 1, i.e. for |𝑧| < 21/3 .

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Find the radius of convergence.
∞
𝑧3𝑛
𝑓1 (𝑧) = ∑           (b) 𝑓2 (𝑧) = 1 + 3(𝑧 − 1) + 3(𝑧 − 1)2 + (𝑧 − 1)3
𝑛=0
2𝑛]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Find the radius of convergence.
∞
𝑧3𝑛
𝑓1 (𝑧) = ∑           (b) 𝑓2 (𝑧) = 1 + 3(𝑧 − 1) + 3(𝑧 − 1)2 + (𝑧 − 1)3
𝑛=0
2𝑛', '_recupere_le' => '2026-11-04T19:55:22.396570+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : 𝑓1 (𝑧) = ∑             (b) 𝑓2 (𝑧) = 1 + 3(𝑧 − 1) + 3(𝑧 − 1)2 + (𝑧 − 1)3
𝑛=0
2𝑛
𝑧3
answers: (a) The series is a geometric series with ratio              . The series converges')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Suppose 𝑓 is analytic and has a zero of order 𝑚 at 𝑧0 . Show that 𝑔(𝑧) = 𝑓 ′ (𝑧)/𝑓(𝑧)
has a simple pole at 𝑧0 with Res(𝑔, 𝑧0 ) = 𝑚.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is a matter of writing out the Taylor series
𝑓(𝑧) = 𝑎𝑚 (𝑧 − 𝑧0 )𝑚 + 𝑎𝑚+1 (𝑧 − 𝑧0 )𝑚+1 + …
= 𝑎𝑚 (𝑧 − 𝑧0 )𝑚 ⋅ 𝑔(𝑧), where 𝑔(𝑧0 ) = 1
𝑓 ′ (𝑧) = 𝑚𝑎𝑚 (𝑧 − 𝑧0 )𝑚−1 + (𝑚 + 1)𝑎𝑚+1 (𝑧 − 𝑧0 )𝑚 + …
= 𝑚𝑎𝑚 (𝑧 − 𝑧0 )𝑚−1 ⋅ ℎ(𝑧), where ℎ(𝑧0 ) = 1
So,
𝑓 ′ (𝑧)   𝑚𝑎𝑚 (𝑧 − 𝑧0 )𝑚−1 ℎ(𝑧)     𝑚     ℎ(𝑧)
=              𝑚
=       ⋅
𝑓(𝑧)       𝑎𝑚 (𝑧 − 𝑧0 ) 𝑔(𝑧)      𝑧 − 𝑧0 𝑔(𝑧)
Since ℎ(𝑧)/𝑔(𝑧) is analytic and ℎ(𝑧0 )/𝑔(𝑧0 ) = 1, the desired result Res(𝑔, 𝑧0 ) = 𝑚 follows.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Suppose 𝑓 is analytic and has a zero of order 𝑚 at 𝑧0 . Show that 𝑔(𝑧) = 𝑓 ′ (𝑧)/𝑓(𝑧)
has a simple pole at 𝑧0 with Res(𝑔, 𝑧0 ) = 𝑚.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Suppose 𝑓 is analytic and has a zero of order 𝑚 at 𝑧0 . Show that 𝑔(𝑧) = 𝑓 ′ (𝑧)/𝑓(𝑧)
has a simple pole at 𝑧0 with Res(𝑔, 𝑧0 ) = 𝑚.', '_recupere_le' => '2026-11-04T19:55:22.396674+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : This is a matter of writing out the Taylor series
𝑓(𝑧) = 𝑎𝑚 (𝑧 − 𝑧0 )𝑚 + 𝑎𝑚+1 (𝑧 − 𝑧0 )𝑚+1 + …
= 𝑎𝑚 (𝑧 − 𝑧0 )𝑚 ⋅ 𝑔(𝑧), where 𝑔(𝑧0 ) = 1
𝑓 ′ (𝑧) = 𝑚𝑎𝑚 (𝑧 − 𝑧0 )𝑚−1 + (𝑚 + 1)𝑎𝑚')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
1
Find the residue of 𝑓2 (𝑧) =             at 𝑧 = 0.
2𝑧 cos(𝑧)', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Since cos(0) = 1, 𝑔(𝑧) = 𝑧𝑓2 (𝑧) is analytic at 𝑧 = 0. This tells us the pole is
simple and Res(𝑓2 , 0) = 𝑔(0) = 1/2.
e𝑧

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
1
Find the residue of 𝑓2 (𝑧) =             at 𝑧 = 0.
2𝑧 cos(𝑧)]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
1
Find the residue of 𝑓2 (𝑧) =             at 𝑧 = 0.
2𝑧 cos(𝑧)', '_recupere_le' => '2026-11-04T19:55:22.396737+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Since cos(0) = 1, 𝑔(𝑧) = 𝑧𝑓2 (𝑧) is analytic at 𝑧 = 0. This tells us the pole is
simple and Res(𝑓2 , 0) = 𝑔(0) = 1/2.
e𝑧

[Correction officielle MIT : [MIT 18.04 — question d')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
1
Find the residue at infinity of 𝑓4 (𝑧) =        .
1−𝑧', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : First we find
1              1   1         1
𝑔(𝑧) =     2
𝑓4 (1/𝑤) = 2 ⋅      =
𝑤             𝑤 1 − 1/𝑤   𝑤(𝑤 − 1)
So
Res(𝑓4 , ∞) = − Res(𝑔, 0) = 1.
cos(𝑧)

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
1
Find the residue at infinity of 𝑓4 (𝑧) =        .
1−𝑧]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
1
Find the residue at infinity of 𝑓4 (𝑧) =        .
1−𝑧', '_recupere_le' => '2026-11-04T19:55:22.396786+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : First we find
1              1   1         1
𝑔(𝑧) =     2
𝑓4 (1/𝑤) = 2 ⋅      =
𝑤             𝑤 1 − 1/𝑤   𝑤(𝑤 − 1)
So
Res(𝑓4 , ∞) = − Res(𝑔, 0) = 1.
cos(𝑧)

[Correction offic')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Write the principal part of each function at the isolated singularity. Compute the corre-
sponding residue.
𝑓1 (𝑧) = 𝑧 3 e1/𝑧', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The only singularity is at 𝑧 = 0. We know
1   1   1       1
e1/𝑧 = 1 +     + 2+     3
+      +…
𝑧 2𝑧   3!𝑧     4!𝑧4
So,
𝑧  1  1
𝑓1 (𝑧) = 𝑧 3 + 𝑧 2 +       + +    +…
2 3! 4!𝑧
1
Thus, we have Res(𝑓1 , 0) =                .
24
1 − cosh(𝑧)

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Write the principal part of each function at the isolated singularity. Compute the corre-
sponding residue.
𝑓1 (𝑧) = 𝑧 3 e1/𝑧]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Write the principal part of each function at the isolated singularity. Compute the corre-
sponding residue.
𝑓1 (𝑧) = 𝑧 3 e1/𝑧', '_recupere_le' => '2026-11-04T19:55:22.396861+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The only singularity is at 𝑧 = 0. We know
1   1   1       1
e1/𝑧 = 1 +     + 2+     3
+      +…
𝑧 2𝑧   3!𝑧     4!𝑧4
So,
𝑧  1  1
𝑓1 (𝑧) = 𝑧 3 + 𝑧 2 +       + +    +…
2 3! 4!𝑧
')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Let 𝑓(𝑧) = (1 + 𝑧)𝑎 , computed using the principal branch of log. Give the Taylor series
around 0.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We’ll do this using derivatives. Keeping the branch in mind 𝑓(𝑧) = e𝑎 log(1+𝑧) . On
the principle branch, 𝑓(0) = 1. Taking derivatives we have
𝑓 (𝑛) (𝑧) = 𝑎(𝑎 − 1) ⋯ (𝑎 − 𝑛 + 1)(1 + 𝑧)𝑎−𝑛 ,   𝑓 (𝑛) (0) = 𝑎(𝑎 − 1) ⋯ (𝑎 − 𝑛 + 1).
So
∞
𝑎(𝑎 − 1) 2    𝑎(𝑎 − 1) ⋯ (𝑎 − 𝑛 + 1) 𝑛          𝑎
𝑓(𝑧) = 1 + 𝑎𝑧 +            𝑧 +…+                       𝑧 + … = ∑ ( )𝑧𝑛
2                    𝑛!                  𝑛=0
𝑛
𝑎                 𝑎(𝑎 − 1) ⋯ (𝑎 − 𝑛 + 1)
where ( ) is defined as                         .
𝑛                            𝑛!
The question didn’t ask for the following, but they are worth noting.
1. If 𝑎 = 𝑛 is a nonnegative integer then the Taylor coeﬀicients are 0 for powers bigger than
𝑛. For such 𝑎, 𝑓 is entire and the radius of convergence is ∞.
2. For all other 𝑎 the disk of convergence centered at 0, goes as far as the first singularity,
which is at 𝑧 = 1. That is, the radius of convergence is 1.
√

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Let 𝑓(𝑧) = (1 + 𝑧)𝑎 , computed using the principal branch of log. Give the Taylor series
around 0.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Let 𝑓(𝑧) = (1 + 𝑧)𝑎 , computed using the principal branch of log. Give the Taylor series
around 0.', '_recupere_le' => '2026-11-04T19:55:22.396923+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : We’ll do this using derivatives. Keeping the branch in mind 𝑓(𝑧) = e𝑎 log(1+𝑧) . On
the principle branch, 𝑓(0) = 1. Taking derivatives we have
𝑓 (𝑛) (𝑧) = 𝑎(𝑎 − 1) ⋯ (𝑎 − 𝑛 +')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
e𝑖𝑧
Use the residue theorem to compute ∫            2
𝑑𝑧.
|𝑧|=3 𝑧 (𝑧 − 2)(𝑧 + 5𝑖)
e𝑖𝑧', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The function 𝑓(𝑧) =                      is meromorphic with poles at 0, 2, −5𝑖. Of
𝑧2 (𝑧 − 2)(𝑧 + 5𝑖)
these, only 0 and 2 are inside the countour of integration 𝐶: |𝑧| = 3.
Im(z)
C
Re(z)
0       2
−5i
So, ∫ 𝑓(𝑧) 𝑑𝑧 = 2𝜋𝑖(Res(𝑓, 0) + Res(𝑓, 2)). To finish the problem we must compute the
𝐶
residues.
e𝑖𝑧                                               −12 + 5𝑖
At 𝑧 = 0: 𝑔(𝑧) = 𝑧 2 𝑓(𝑧) =                 is analytic. Thus, Res(𝑓, 0) = 𝑔′ (0) =          .
(𝑧 − 2)(𝑧 + 5𝑖)                                           100
(We’ll leave it to you to provide the details for finding 𝑔′ (0).)
e𝑖𝑧                                             e2𝑖
At 𝑧 = 2: 𝑔(𝑧) = (𝑧 − 2)𝑓(𝑧) =                 is analytic. Thus, Res(𝑓, 2) = 𝑔(2) =           .
𝑧2 (𝑧 + 5𝑖)                                       4(2 + 5𝑖)
e𝑖𝑧                   −12 + 5𝑖      e2𝑖
We conclude that ∫            2
𝑑𝑧 = 2𝜋𝑖 (          +           ).
|𝑧|=3 𝑧 (𝑧 − 2)(𝑧 + 5𝑖)              100      4(2 + 5𝑖)
18.04 Problem Set 6, Spring 2018 Solutions                                                         7

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
e𝑖𝑧
Use the residue theorem to compute ∫            2
𝑑𝑧.
|𝑧|=3 𝑧 (𝑧 − 2)(𝑧 + 5𝑖)
e𝑖𝑧]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
e𝑖𝑧
Use the residue theorem to compute ∫            2
𝑑𝑧.
|𝑧|=3 𝑧 (𝑧 − 2)(𝑧 + 5𝑖)
e𝑖𝑧', '_recupere_le' => '2026-11-04T19:55:22.396988+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The function 𝑓(𝑧) =                      is meromorphic with poles at 0, 2, −5𝑖. Of
𝑧2 (𝑧 − 2)(𝑧 + 5𝑖)
these, only 0 and 2 are inside the countour of integration 𝐶: |𝑧| = 3.
')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
e𝑖𝑧
Explain why Cauchy’s integral formula can be viewed as a special case of the residue
theorem.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Cauchy’s integral formula says: if 𝐶 is a simple closed curve and 𝑓 is analytic on
𝑓(𝑧)
and inside 𝐶 and ∫         𝑓(𝑧0 ) = 2𝜋𝑖𝑓(𝑧0 ).
𝐶 𝑧 − 𝑧0
On the other hand, since 𝑓 is analytic the only singularity of 𝑓(𝑧)/(𝑧 − 𝑧0 ) is at 𝑧 = 𝑧0 . So,
𝑓(𝑧)
the residue theorem says ∫          𝑓(𝑧0 ) = 2𝜋𝑖 Res(𝑓(𝑧)/(𝑧 − 𝑧0 ), 𝑧0 ).
𝐶 𝑧  − 𝑧0
To see both theorems give the same result we note that 𝑧0 is a simple pole and Res(𝑓(𝑧)/(𝑧−
𝑧0 ), 𝑧0 ) = 𝑓(𝑧0 ).
Note: the condition 𝑓 is analytic on 𝐶 can be relaxed. It is enough the 𝑓 be analytic inside
𝐶 and continuous on and inside 𝐶. Even this can be further relaxed.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
e𝑖𝑧
Explain why Cauchy’s integral formula can be viewed as a special case of the residue
theorem.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
e𝑖𝑧
Explain why Cauchy’s integral formula can be viewed as a special case of the residue
theorem.', '_recupere_le' => '2026-11-04T19:55:22.397047+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Cauchy’s integral formula says: if 𝐶 is a simple closed curve and 𝑓 is analytic on
𝑓(𝑧)
and inside 𝐶 and ∫         𝑓(𝑧0 ) = 2𝜋𝑖𝑓(𝑧0 ).
𝐶 𝑧 − 𝑧0
On the other hand, since 𝑓 is')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
∞
1
In this problem we will compute ∑         using the residue theorem. The techniques learned
−∞
𝑛2
here are general. In particular, the use of cot(𝜋𝑧) is fairly common.
cos(𝜋𝑧)
Find the formula for the power series coeﬀicients of 𝑓(𝑧) directly from the differential
equation.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We express 𝑓(𝑧) and 𝑓 ′ (𝑧) as Taylor series
∞
𝑓(𝑧) = 𝑎0 + 𝑎1 𝑧 + … = ∑ 𝑎𝑛 𝑧𝑛
𝑛=0
∞
𝑓 ′ (𝑧) = 𝑎1 + … = ∑ 𝑛𝑎𝑛 𝑧𝑛−1
𝑛=0
Multiplying we get and substituting into the DE we get
∞
(1 + 𝑧)𝑓 ′ (𝑧) = ∑(𝑛𝑎𝑛 + (𝑛 + 1)𝑎𝑛+1 )𝑧𝑛 = ∑ 2𝑎𝑛 𝑧𝑛 .
𝑛=0
Equation coeﬀicients gives the relation: 2𝑎𝑛 = 𝑛𝑎𝑛 + (𝑛 + 1)𝑎𝑛+1 . A little algebra converts
this to the recursive formula
(2 − 𝑛)𝑎𝑛
𝑎𝑛+1 =            .
1+𝑛
The initial condition gives 𝑓(0) = 𝑎0 = 1. Using the recursion relation we find 𝑎1 = 2,
𝑎2 = 1, 𝑎𝑚 = 0 for 𝑚 ≥ 3. Thus, 𝑓(𝑧) = 1 + 2𝑧 + 𝑧 2 .

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
∞
1
In this problem we will compute ∑         using the residue theorem. The techniques learned
−∞
𝑛2
here are general. In particular, the use of cot(𝜋𝑧) is fairly common.
cos(𝜋𝑧)
Find the formula for the power series coeﬀicients of 𝑓(𝑧) directly from the differential
equation.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
∞
1
In this problem we will compute ∑         using the residue theorem. The techniques learned
−∞
𝑛2
here are general. In particular, the use of cot(𝜋𝑧) is fairly common.
cos(𝜋𝑧)
Find the formula for the power series coeﬀicients of 𝑓(𝑧) directly from the differential
equation.', '_recupere_le' => '2026-11-04T19:55:22.397172+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : We express 𝑓(𝑧) and 𝑓 ′ (𝑧) as Taylor series
∞
𝑓(𝑧) = 𝑎0 + 𝑎1 𝑧 + … = ∑ 𝑎𝑛 𝑧𝑛
𝑛=0
∞
𝑓 ′ (𝑧) = 𝑎1 + … = ∑ 𝑛𝑎𝑛 𝑧𝑛−1
𝑛=0
Multiplying we get and substituting into the DE we get
∞')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
∞
1
In this problem we will compute ∑         using the residue theorem. The techniques learned
−∞
𝑛2
here are general. In particular, the use of cot(𝜋𝑧) is fairly common.
cos(𝜋𝑧)
Use parts (b) and (c) to compute ∑ 2 .
𝑛=1
𝑛', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : By parts (b) and (c), letting 𝑁 → ∞, we have
∞
1    𝜋2
lim ∫ 𝑓(𝑧) 𝑑𝑧 = 2𝜋𝑖 [2 ∑             −    ] = 0.
𝑁→∞
𝐶𝑛                     𝑛=1
𝑛2   3
∞
1    𝜋2
This implies ∑       =    ..
𝑛=1
𝑛2   6
Problems below here are not assigned. Do them just for fun.
Problem Fun 1. (No points)
∞      ∞        ∞
𝑧𝑛        𝑧𝑛
By considering the 3 series      ∑  2
, ∑      , ∑   𝑧 𝑛 , show that a power series may
𝑛=1
𝑛     𝑛=1
𝑛    𝑛=1
converge on all, some or no points on the boundary of its disk of convergence.
Solution: For all three series the radius of convergence is 𝑅 = 1. So the boundary of the
disk of convergence is the circle |𝑧| = 1. (Often this is called the circle of convergence, which
is a slightly confusing name as this problem shows.)
1                                𝑧𝑛
Since ∑ 2 is convergent, the series ∑ 2 converges absolutely everywhere on the circle
𝑛                                 𝑛
|𝑧| = 1.
(−1)𝑛                                                 1
Since ∑          converges (conditionally not absolutely) and ∑ diverges. We see that
𝑛 𝑛                                                 𝑛
𝑧
the series ∑      converges at some points on |𝑧| = 1. (In fact, it turns out this series
𝑛
converges at every point on the circle except at |𝑧| = 1.)
18.04 Problem Set 6, Spring 2018 Solutions                                               10
When |𝑧| = 1 the terms in ∑ 𝑧 𝑛 do not decay to 0. Therefore the series is not convergent
for any 𝑧 on the unit circle.
Problem Fun 2. (No points)
Suppose that there exists a function 𝑓(𝑧) which is analytic at 𝑧 = 0 and which satisfies the
differential equation
(1 + 𝑧)𝑓 ′ (𝑧) = 2𝑓(𝑧), with 𝑓(0) = 1.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
∞
1
In this problem we will compute ∑         using the residue theorem. The techniques learned
−∞
𝑛2
here are general. In particular, the use of cot(𝜋𝑧) is fairly common.
cos(𝜋𝑧)
Use parts (b) and (c) to compute ∑ 2 .
𝑛=1
𝑛]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
∞
1
In this problem we will compute ∑         using the residue theorem. The techniques learned
−∞
𝑛2
here are general. In particular, the use of cot(𝜋𝑧) is fairly common.
cos(𝜋𝑧)
Use parts (b) and (c) to compute ∑ 2 .
𝑛=1
𝑛', '_recupere_le' => '2026-11-04T19:55:22.397285+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : By parts (b) and (c), letting 𝑁 → ∞, we have
∞
1    𝜋2
lim ∫ 𝑓(𝑧) 𝑑𝑧 = 2𝜋𝑖 [2 ∑             −    ] = 0.
𝑁→∞
𝐶𝑛                     𝑛=1
𝑛2   3
∞
1    𝜋2
This implies ∑       =')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
2𝜋
8 𝑑𝜃
Compute ∫                           .
0        (3 + 2 cos(𝜃))2', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Call the integral 𝐼. Using the computations from part (a) we get
1                    𝑑𝑧              𝑧
𝐼 =∫                                       ⋅          =∫                     𝑑𝑧.
|𝑧|=1   (3 + 2(𝑧2 + 1)/2𝑧)2              𝑖𝑧           2
|𝑧|=1 𝑖(𝑧 + 3𝑧 + 1)
2
√                       √
𝑧                                  −3 +                      5            −3 −     5
Let 𝑓(𝑧) =      2          2
. The poles of 𝑓 are 𝑧1 =                               and 𝑧2 =              . Of these
𝑖(𝑧 + 3𝑧 + 1)                                2                                      2
only 𝑧1 is inside |𝑧| = 1. So, by the residue theorem
𝐼 = 2𝜋𝑖 Res(𝑓, 𝑧1 )
The pole is order 2, so we need to do a little work to compute it. Let
𝑔(𝑧) = (𝑧 − 𝑧1 )2 𝑓(𝑧),              so      Res(𝑓, 𝑧1 ) = 𝑔′ (𝑧1 ).
Computing 𝑔′ (𝑧1 ) is not hard. It’s probably easiest to factor the denominator symbolically
using the roots 𝑧1 and 𝑧2 .
(𝑧 − 𝑧1 )2 𝑧             𝑧
𝑔(𝑧) =              2          2
=             .
𝑖(𝑧 − 𝑧1 ) (𝑧 − 𝑧2 )     𝑖(𝑧 − 𝑧2 )2
By direct computation using the quotient rule we have
√
′        (𝑧1 − 𝑧2 )2 − 2𝑧1 (𝑧1 − 𝑧2 )   3 5
𝑔 (𝑧1 ) =                              =     .
𝑖(𝑧1 − 𝑧2 )4            25𝑖
1
18.04 Problem Set 7, Spring 2018 Solutions                                                         2
√
√                                 6𝜋 5
The calculation was done using 𝑧1 − 𝑧2 =                5. Thus 𝐼 = 2𝜋𝑖 Res(𝑓, 𝑧1 ) =      .
25
2𝜋                                                            √
sin2 (𝜃)                                       2𝜋

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
2𝜋
8 𝑑𝜃
Compute ∫                           .
0        (3 + 2 cos(𝜃))2]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
2𝜋
8 𝑑𝜃
Compute ∫                           .
0        (3 + 2 cos(𝜃))2', '_recupere_le' => '2026-11-04T19:55:22.397351+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Call the integral 𝐼. Using the computations from part (a) we get
1                    𝑑𝑧              𝑧
𝐼 =∫                                       ⋅          =∫')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
∞
𝑑𝑥
Compute ∫    2 + 2𝑥 + 2
. (', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝐼 be the integral in question. Let 𝑓(𝑧) =                  . Since the denominator
𝑧 2 + 2𝑧 + 2
decays like 1/𝑧2 we can use a semicircular contour.
Im(z)
CR
−1 + i
Re(z)
−R     C1                  R
The residue theorem implies ∫           𝑓(𝑧) 𝑑𝑧 = 2𝜋𝑖 ∑ residues of 𝑓 inside the contour. We
𝐶1 +𝐶𝑅
examine each of the pieces in this equation.
lim ∫ 𝑓(𝑧) 𝑑𝑧 = 0 by Theorem 9.1 in the Topic 9 notes.
𝑅→∞
𝐶𝑅
lim𝑅→∞ ∫𝐶 𝑓(𝑧) 𝑑𝑥 = 𝐼 (this is clear).
1
So letting 𝑅 → ∞ we have 𝐼 = 2𝜋𝑖 ∑ residues of 𝑓 in the upper half-plane.
The poles of 𝑓 are at 𝑧1 = −1 + 𝑖 and 𝑧2 = −1 − 𝑖. Only 𝑧1 is in the upper half-plane. The
pole is simple so,
1     1
Res(𝑓, 𝑧1 ) = lim (𝑧 − 𝑧1 )𝑓(𝑧) =         = .
𝑧→𝑧1                2𝑧1 + 2  2𝑖
1
Thus 𝐼 = 2𝜋𝑖 ⋅      = 𝜋.
2𝑖
∞
𝑥2', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'choices' => array('Pas 𝜋).
−∞  𝑥
1', 'Impossible à déterminer', 'L\'inverse de 𝜋).
−∞  𝑥
1', '𝜋).
−∞  𝑥
1'), 'correct' => 3, 'answer' => '𝜋).
−∞  𝑥
1', '_recupere_le' => '2026-11-04T19:55:22.397417+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
∞
𝑑𝑥
Show ∫            𝑑𝑥 =      by integrating around the boundary of the circular sector
0    𝑥3 + 1        9
shown and letting 𝑅 → ∞. The vertex angle of the sector is 2𝜋/3.
Im(z)
Re(z)
R
Circular sector with vertex angle 2𝜋/3.
1', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝐼 be the integral in question. And let 𝑓(𝑧) = 3       . We proceed similarly
𝑧 +1
to parts (a) and (b). Here the contour is the circular sector shown. As usual, we put signs
on the pieces of the contour that make the parametrization easier.
Im(z)
CR
−C3
eiπ/3
Re(z)
C1        R
The poles of 𝑓 are at e𝑖𝜋/3 , −1, e−𝑖𝜋/3 . The only one inside the contour is 𝑧1 = e𝑖𝜋/3 . So
∫              𝑓(𝑧) 𝑑𝑧 = 2𝜋𝑖 Res(𝑓, 𝑧1 ).
𝐶1 +𝐶𝑅 −𝐶3
Looking at each segment of the curve in turn we have
∞
1
On 𝐶1 : lim ∫ 𝑓(𝑧) 𝑑𝑧 = ∫                   𝑑𝑥 = 𝐼.
R→∞
𝐶1           0       𝑥3 + 1
On 𝐶3 : Parametrize the curve by 𝛾(𝑡) = 𝑡e𝑖2𝜋/3 , where 𝑡 runs from 0 to 𝑅. So
∞
1
lim ∫ 𝑓(𝑧) 𝑑𝑧 = ∫                        e𝑖2𝜋/3 𝑑𝑡 = e𝑖2𝜋/3 𝐼.
R→∞
𝐶3                0       𝑡3 + 1
18.04 Problem Set 7, Spring 2018 Solutions                                            5
Since |𝑓(𝑧)| ≈ 1/|𝑧|3 , the same argument as for semicircles shows that
lim ∫ 𝑓(𝑧) 𝑑𝑧 = 0.
𝑅→∞
𝐶𝑅
Putting it together we have
lim ∫               𝑓(𝑧) 𝑑𝑧 = (1 − e𝑖2𝜋/3 )𝐼 = 2𝜋𝑖 Res(𝑓, 𝑧1 ).
𝑅→∞
𝐶1 +𝐶𝑅 −𝐶3
All that’s left is to compute the residue and do some algebra.
𝑧 − 𝑧1    1     1
Res(𝑓, 𝑧1 ) = lim              = 2 = 𝑖2𝜋/3 .
𝑧→𝑧1 𝑧 3 + 1  3𝑧1 3e
So,
2𝜋𝑖                    2𝜋𝑖
𝐼=                        =
3e2𝜋𝑖/3 (1 − e𝑖2𝜋/3 )    3(e2𝜋𝑖/3 − e𝑖4𝜋/3 )
2𝜋𝑖
=     𝑖2𝜋/3
(use e𝑖4𝜋/3 = e−𝑖2𝜋/3 )
3(e       − e−𝑖2𝜋/3 )
𝜋                      𝜋           2𝜋
=     𝑖2𝜋/3    −𝑖2𝜋/3
=               = √ .
3(e       −e        )/2𝑖    3 sin(2𝜋/3)      3 3

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
∞
𝑑𝑥
Show ∫            𝑑𝑥 =      by integrating around the boundary of the circular sector
0    𝑥3 + 1        9
shown and letting 𝑅 → ∞. The vertex angle of the sector is 2𝜋/3.
Im(z)
Re(z)
R
Circular sector with vertex angle 2𝜋/3.
1]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
∞
𝑑𝑥
Show ∫            𝑑𝑥 =      by integrating around the boundary of the circular sector
0    𝑥3 + 1        9
shown and letting 𝑅 → ∞. The vertex angle of the sector is 2𝜋/3.
Im(z)
Re(z)
R
Circular sector with vertex angle 2𝜋/3.
1', '_recupere_le' => '2026-11-04T19:55:22.397539+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Let 𝐼 be the integral in question. And let 𝑓(𝑧) = 3       . We proceed similarly
𝑧 +1
to parts (a) and (b). Here the contour is the circular sector shown. As usual, we put si')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
∞
cos(2𝑥)
Compute ∫         2 + 1)2
𝑑𝑥. (', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is nearly identical to part (a). In this problem the denominator is squared.
e𝑖2𝑧                  ̃ where 𝐼 ̃ = 2𝜋𝑖 Res(𝑓, 𝑖).
So very briefly, 𝑓(𝑧) = 2         and 𝐼 = Re(𝐼),
(𝑧 + 1)2
To compute the residue we make the following calculation:
(𝑧 − 𝑖)2 e𝑖2𝑧     e𝑖2𝑧
𝑔(𝑧) = (𝑧 − 𝑖)2 𝑓(𝑧) =                      =          ,        and        Res(𝑓, 𝑖) = 𝑔′ (𝑖).
(𝑧2 + 1)      (𝑧 + 𝑖)2
3𝑖e−2            3𝜋e−2
This calculation is straightforward, we get 𝑔′ (𝑖) = −                     , so 𝐼 ̃ =       . Finally, 𝐼 =
4                2
−2
3𝜋e
Re(𝐼)̃ =            .
2
Principal value.
Recall if 𝑓(𝑥) is continuous on the real axis except at, say, two points 𝑥1 < 𝑥2 then the
principal value of the integral along the entire 𝑥-axis is defined by
∞            𝑥1 −𝑟1                𝑥2 −𝑟2                    𝑅
p.v. ∫         = lim [∫          𝑓(𝑥) 𝑑𝑥 + ∫           𝑓(𝑥) 𝑑𝑥 + ∫             𝑓(𝑥) 𝑑𝑥.]
−∞             −𝑅                     𝑥1 +𝑟1                   𝑥2 +𝑟2
Here the limit is taken as 𝑅 → ∞, 𝑟1 → 0, 𝑟2 → 0. The extension to more points of
discontinuity should be clear.', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'choices' => array('3𝜋/(2𝑒2 ).)
−∞ (𝑥', 'Impossible à déterminer', 'Pas 3𝜋/(2𝑒2 ).)
−∞ (𝑥', 'L\'inverse de 3𝜋/(2𝑒2 ).)
−∞ (𝑥'), 'correct' => 0, 'answer' => '3𝜋/(2𝑒2 ).)
−∞ (𝑥', '_recupere_le' => '2026-11-04T19:55:22.397626+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
∞
e3𝑖𝑥
Derive the formula p.v. ∫                  𝑑𝑥 = {
−∞ 𝑥 − 𝑤         −𝜋𝑖e−𝑖𝑤                if Im(𝑤) < 0.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Because 𝑤 is complex our complexification trick is not going to work. Instead we
e𝑖𝑥 + e−𝑖𝑥
work with the formula cos(𝑥) =             . Using this formula we can break the integral
2
into two pieces.
∞                              ∞                             ∞                          ∞
cos(𝑥)               e𝑖𝑥 + e−𝑖𝑥                  e𝑖𝑥                   e−𝑖𝑥
p.v. ∫          𝑑𝑥 = p.v. ∫              𝑑𝑥 = p.v. ∫             𝑑𝑥 + p.v. ∫           𝑑𝑥
−∞ 𝑥 − 𝑤             −∞ 2(𝑥 − 𝑤)              −∞ 2(𝑥 − 𝑤)             −∞ 2(𝑥 − 𝑤)
(2)
We’ll apply the residue theorem on a different contour for each piece.
e𝑖𝑧                  e−𝑖𝑧
Let 𝑓1 (𝑧) =            and 𝑓2 (𝑧) =          . Consider the following two contours.
2(𝑧 − 𝑤)              2(𝑧 − 𝑤)
Im(z)                                                     Im(z)
2R1 i                   C R1
w                                                     w
C1                                         −R2                              R2
Re(z)                                           Re(z)
−R1                                      R1                            C2
−2R2 i         −CR2
We can work with the contour on the left with 𝑓1 (Topic 9 notes, Theorem 9.2a) and with
the contour on the right for 𝑓2 (same theorem part b). Paying attention to the sign in the
exponents. These theorems imply
lim ∫            𝑓1 (𝑧) 𝑑𝑧 = 0,       lim ∫          𝑓2 (𝑧) 𝑑𝑧 = 0.
𝑅1 →∞                                 𝑅2 →∞
𝐶𝑅1                                   𝐶𝑅2
The case Im(𝑤) > 0.
18.04 Problem Set 7, Spring 2018 Solutions                                                                 8
For now make the assumption Im(𝑤) > 0. Both 𝑓1 and 𝑓2 have their only pole at 𝑧 = 𝑤.
Since Im(𝑤) > 0, 𝑤 is inside the left-hand contour and the right-hand contour contains no
poles. So,
∫          𝑓1 (𝑧) 𝑑𝑧 = 2𝜋𝑖 Res(𝑓1 , 𝑤) = 𝜋𝑖e𝑖𝑤
𝐶1 +𝐶𝑅1
∫          𝑓2 (𝑧) 𝑑𝑧 = 0.
𝐶1 −𝐶𝑅2
Now we finish the problem in the usual manner: letting 𝑅1 and 𝑅2 go to infinity we have
∞                       ∞                         ∞
cos(𝑥)
p.v. ∫   2+1
𝑑𝑥 = p.v. ∫ 𝑓1 (𝑥) 𝑑𝑥 + p.v. ∫ 𝑓2 (𝑥) 𝑑𝑥 = 𝜋𝑖e𝑖𝑤 + 0 = 𝜋𝑖e𝑖𝑤 .
−∞ 𝑥                −∞                 −∞
This is exactly what we were supposed to show.
The case Im(𝑤) < 0 is the same. The minus sign occurs because the curve 𝐶1 + 𝐶𝑅2 is
traversed in a clockwise direction.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
∞
e3𝑖𝑥
Derive the formula p.v. ∫                  𝑑𝑥 = {
−∞ 𝑥 − 𝑤         −𝜋𝑖e−𝑖𝑤                if Im(𝑤) < 0.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
∞
e3𝑖𝑥
Derive the formula p.v. ∫                  𝑑𝑥 = {
−∞ 𝑥 − 𝑤         −𝜋𝑖e−𝑖𝑤                if Im(𝑤) < 0.', '_recupere_le' => '2026-11-04T19:55:22.397726+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Because 𝑤 is complex our complexification trick is not going to work. Instead we
e𝑖𝑥 + e−𝑖𝑥
work with the formula cos(𝑥) =             . Using this formula we can break the i')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
∞
e𝑖𝑥
Derive the formula ∫                   𝑑𝑥 = 𝜋/2.
0          𝑥2
1 − cos(2𝑥)    1
Hint: sin2 (𝑥) =             = Re(1 − e2𝑖𝑥 ).
2         2', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Call the integral in question 𝐼. First note that there is not problem at 𝑥 = 0
∞
since the integrand is continuous there. There is also no problem at ∞ because ∫                        1/𝑥2 𝑑𝑥
1
converges. We start by using symmetry to get
∞
sin2 (𝑥)
2𝐼 = p.v. ∫           𝑑𝑥.
−∞    𝑥2
Since the integral is known to converge the principal value will give the same value and is
convenient to use with indented contours.
1 − e𝑖2𝑧
Now, follow the hint and let 𝑓(𝑧) =          . Note that since the numerator is 0 at 𝑧 = 0,
2𝑧2
𝑓 has a simple pole at 𝑧 = 0.
We use the indented contour shown.
Im(z)
2Ri                          CR
−C2
C1                                 C3
Re(z)
−R                   −r      0     r                  R
We’ll make our argument a little more quickly than in previous problems. By Cauchy’s
theorem
∫             𝑓(𝑧) 𝑑𝑥 = 0.
𝐶1 −𝐶2 +𝐶3 +𝐶𝑅
By the usual limit theorems
lim ∫ 𝑓(𝑧) 𝑑𝑧 = 0 and lim ∫ 𝑓(𝑧) 𝑑𝑧 = 𝜋𝑖 Res(𝑓, 0)
𝑅→∞                                    𝑟→0
𝐶𝑅                                     𝐶2
By definition
∞
lim         ∫         𝑓(𝑧) 𝑑𝑧 = p.v. ∫           𝑓(𝑥) 𝑑𝑥.
𝑅→∞, 𝑟→0
𝐶1 +𝐶3                         −∞
18.04 Problem Set 7, Spring 2018 Solutions                                                              10
Computing Res(𝑓, 0):
1 − (1 + 𝑖2𝑧 − 4𝑧 2 /2 − …)   𝑖
𝑓(𝑧) =                    2
=− +𝑧+…
2𝑧                𝑧
So, Res(𝑓, 0) = −𝑖.
∞
Putting it all togother: 2𝐼 = p.v. ∫        𝑓(𝑥) 𝑑𝑥 = 𝜋𝑖 Res(𝑓, 0) = 𝜋. So, 𝐼 = 𝜋/2 ,
−∞

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
∞
e𝑖𝑥
Derive the formula ∫                   𝑑𝑥 = 𝜋/2.
0          𝑥2
1 − cos(2𝑥)    1
Hint: sin2 (𝑥) =             = Re(1 − e2𝑖𝑥 ).
2         2]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
∞
e𝑖𝑥
Derive the formula ∫                   𝑑𝑥 = 𝜋/2.
0          𝑥2
1 − cos(2𝑥)    1
Hint: sin2 (𝑥) =             = Re(1 − e2𝑖𝑥 ).
2         2', '_recupere_le' => '2026-11-04T19:55:22.397830+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Call the integral in question 𝐼. First note that there is not problem at 𝑥 = 0
∞
since the integrand is continuous there. There is also no problem at ∞ because ∫')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
1 for −1 < 𝑥 < 1
Let 𝑓(𝑥) = {
0 elsewhere.
∞
̂
Let 𝑓(𝑥) = e−𝑥 . Let 𝜔 > 0 and 𝐼 = ∫                                          𝑓(𝑥)e𝑖2𝜔𝑥 𝑑𝑥. Use the rectangle with
0
∞
2      √
vertices at 0, 𝑅, 𝑅 + 𝑖𝜔 and 𝑖𝜔 and the known integral ∫ e−𝑥 𝑑𝑥 = 𝜋/2 to show that
0
2√
𝐼 = e−𝜔 𝜋/2 + 𝑖𝐵. Here 𝐵 is the imaginary part and we are not concerned with its value.
2', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑔(𝑧) = e−𝑧 e𝑖2𝑧𝜔 . We go through the 4 sides of the rectangle one at a time.
Im(z)
−C3                   (R, iω)
iω
−C4                                            C2
C1
Re(z)
R
On 𝐶1 , 𝑧 = 𝑥, with 𝑥 from 0 to 𝑅. So,
∞
2
lim ∫ 𝑔(𝑧) 𝑑𝑧 = ∫                          e−𝑥 e𝑖2𝑥𝜔 𝑑𝑥 = 𝐼.
𝑅→∞
𝐶1                     0
On 𝐶2 , 𝑧 = 𝑅 + 𝑖𝑦, with 𝑦 from 0 to 𝜔; 𝑑𝑧 = 𝑖 𝑑𝑦; 𝑧2 = 𝑅2 − 𝑦2 + 𝑖2𝑅𝑦; 2𝑖𝑧𝜔 = 2𝑖𝑅𝜔 − 2𝑦𝜔.
So,
𝜔                                                                           𝜔
2   2                                                      2           2
∣∫ 𝑔(𝑧) 𝑑𝑧∣ = ∣∫ e−𝑅 e𝑦 e−2𝑖𝑅𝑦 e2𝑖𝑅𝜔 e−2𝑦𝜔 𝑖 𝑑𝑦∣ ≤ e−𝑅 ∫ e𝑦 e−2𝑦𝜔 𝑑𝑦.
𝐶2                  0                                                                           0
Clearly this goes to 0 as 𝑅 goes to ∞.
On 𝐶3 , 𝑧 = 𝑥 + 𝑖𝜔, with 𝑥 from 0 to 𝑅; 𝑑𝑧 = 𝑑𝑥; 𝑧 2 = 𝑥2 − 𝜔2 + 2𝑖𝑥𝜔; 2𝑖𝑧𝜔 = 2𝑖𝑥𝜔 − 2𝜔2 .
So,
𝑅                                                                       𝑅
−𝑥2 𝜔2 −2𝑖𝑥𝜔 2𝑖𝑥𝜔 −2𝜔2                                   −𝜔2               2
∫ 𝑔(𝑧) 𝑑𝑧 = ∫ e                 e e            e          e            𝑑𝑥 = e              ∫ e−𝑥 𝑑𝑥.
𝐶3                 0                                                                       0
√
𝜋           2
As 𝑅 → ∞, this integral goes to e−𝜔       .
2
On 𝐶4 , 𝑧 = 𝑖𝑦, with 𝑦 from 0 to 𝜔; 𝑑𝑧 = 𝑖 𝑑𝑦; 𝑧2 = −𝑦2 ; 2𝑖𝑧𝜔 = −2𝑦𝜔. So,
𝜔
2
∫ 𝑔(𝑧) 𝑑𝑧 = ∫ e−𝑦 e−2𝑦𝜔 𝑖 𝑑𝑦.
𝐶4                  0
This is pure imaginary, call it 𝑖𝐵.
Since 𝑔(𝑧) is entire, we have ∫                              𝑔(𝑧) 𝑑𝑧 = 0. So, using the limits above, we have
𝐶1 +𝐶2 −𝐶3 −𝐶4
√
−𝜔2    𝜋
lim ∫                             𝑔(𝑧) 𝑑𝑧 = 𝐼 − e                         − 𝑖𝐵.
𝑅→∞
𝐶1 +𝐶2 −𝐶3 −𝐶4                                                2
18.04 Problem Set 7, Spring 2018 Solutions                                                                                       14
This is what we needed to show!
∞
̂

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
1 for −1 < 𝑥 < 1
Let 𝑓(𝑥) = {
0 elsewhere.
∞
̂
Let 𝑓(𝑥) = e−𝑥 . Let 𝜔 > 0 and 𝐼 = ∫                                          𝑓(𝑥)e𝑖2𝜔𝑥 𝑑𝑥. Use the rectangle with
0
∞
2      √
vertices at 0, 𝑅, 𝑅 + 𝑖𝜔 and 𝑖𝜔 and the known integral ∫ e−𝑥 𝑑𝑥 = 𝜋/2 to show that
0
2√
𝐼 = e−𝜔 𝜋/2 + 𝑖𝐵. Here 𝐵 is the imaginary part and we are not concerned with its value.
2]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
1 for −1 < 𝑥 < 1
Let 𝑓(𝑥) = {
0 elsewhere.
∞
̂
Let 𝑓(𝑥) = e−𝑥 . Let 𝜔 > 0 and 𝐼 = ∫                                          𝑓(𝑥)e𝑖2𝜔𝑥 𝑑𝑥. Use the rectangle with
0
∞
2      √
vertices at 0, 𝑅, 𝑅 + 𝑖𝜔 and 𝑖𝜔 and the known integral ∫ e−𝑥 𝑑𝑥 = 𝜋/2 to show that
0
2√
𝐼 = e−𝜔 𝜋/2 + 𝑖𝐵. Here 𝐵 is the imaginary part and we are not concerned with its value.
2', '_recupere_le' => '2026-11-04T19:55:22.398020+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Let 𝑔(𝑧) = e−𝑧 e𝑖2𝑧𝜔 . We go through the 4 sides of the rectangle one at a time.
Im(z)
−C3                   (R, iω)
iω
−C4                                            C2
C1
R')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Find a fractional linear transformation that maps the right half-plane to the unit disk
such that the origin is mapped to -1.
𝑧−1', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑇 (𝑧) =       . To verify this works we need to check three things.
𝑧+1
1. 𝑇 (0) = −1. This is obvious.
2. 𝑇 maps the boundary of the right half-plane (𝑦-axis) to the boundary of the unit disk
(unit circle).
3. 𝑇 maps the right half-plane to the inside of the disk.
|𝑖𝑦 − 1|
To see (2): Take 𝑖𝑦 on the boundary of the half-plane.         Then, |𝑇 (𝑖𝑦)| =              =
|𝑖𝑦 + 1|
√1 + 𝑦2
= 1. This shows 𝑇 (𝑖𝑦) is on the unit circle. Since we know fractional linear
√1 + 𝑦 2
transformations map lines to lines or circles this shows the image of the 𝑦-axis must be the
entire unit circle.
To see (3): (1) shows that one point in the right half-plane maps to the inside of the disk.
This implies the entire half-plane must do so also.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Find a fractional linear transformation that maps the right half-plane to the unit disk
such that the origin is mapped to -1.
𝑧−1]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Find a fractional linear transformation that maps the right half-plane to the unit disk
such that the origin is mapped to -1.
𝑧−1', '_recupere_le' => '2026-11-04T19:55:22.398090+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : 𝑇 (𝑧) =       . To verify this works we need to check three things.
𝑧+1
1. 𝑇 (0) = −1. This is obvious.
2. 𝑇 maps the boundary of the right half-plane (𝑦-axis) to the boundar')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Let 𝑆 be a circle and 𝑧1 a point not on the circle. Show that there is exactly one point
𝑧2 such that 𝑧1 and 𝑧2 are symmetric with respect to 𝑆.
(Hint: start by proving this for 𝑆 a line.)', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑆 be a circle and 𝑧1 a point not on the circle. Show that there is exactly one point
𝑧2 such that 𝑧1 and 𝑧2 are symmetric with respect to 𝑆.
(Hint: start by proving this for 𝑆 a line.)
This is in the topic 10 notes in section 10.3.2:
Let 𝑇 be a fractional linear transformation that maps 𝑆 to a line. We know that 𝑤1 = 𝑇 (𝑧1 )
has a unique reflection 𝑤2 in this line. Since 𝑇 −1 preserves symmetry, 𝑧1 and 𝑧2 = 𝑇 −1 (𝑤2 )
are symmetric in 𝑆. Since 𝑤2 is the unique point symmetric to 𝑤1 the same is true for 𝑧2
vis-a-vis 𝑧1 .
w = T (z)
y
y
S                                            T (S)
z1
z2 = T −1 (w2 )
x
x
w1 = T (z1 )           w2

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Let 𝑆 be a circle and 𝑧1 a point not on the circle. Show that there is exactly one point
𝑧2 such that 𝑧1 and 𝑧2 are symmetric with respect to 𝑆.
(Hint: start by proving this for 𝑆 a line.)]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Let 𝑆 be a circle and 𝑧1 a point not on the circle. Show that there is exactly one point
𝑧2 such that 𝑧1 and 𝑧2 are symmetric with respect to 𝑆.
(Hint: start by proving this for 𝑆 a line.)', '_recupere_le' => '2026-11-04T19:55:22.398184+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Let 𝑆 be a circle and 𝑧1 a point not on the circle. Show that there is exactly one point
𝑧2 such that 𝑧1 and 𝑧2 are symmetric with respect to 𝑆.
(Hint: start by proving this')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Where does it map the circle |𝑧| = 1?
(This problem will be helful when we look at Joukowsky transformations.)', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If 𝑧 = e𝑖𝜃 then the computation above shows that
𝑤 = 𝑧 + 1/𝑧 = 2 cos(𝜃).
That is, 𝑤 is real. So the unit circle is mapped to the line segment −2 ≤ 𝑥 ≤ 2. (As 𝑧 goes
once around the circle, 𝑤 covers the segment twice.)
u
a=2
a = 1.5
a=1
-2                                2 v

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Where does it map the circle |𝑧| = 1?
(This problem will be helful when we look at Joukowsky transformations.)]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Where does it map the circle |𝑧| = 1?
(This problem will be helful when we look at Joukowsky transformations.)', '_recupere_le' => '2026-11-04T19:55:22.398247+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : If 𝑧 = e𝑖𝜃 then the computation above shows that
𝑤 = 𝑧 + 1/𝑧 = 2 cos(𝜃).
That is, 𝑤 is real. So the unit circle is mapped to the line segment −2 ≤ 𝑥 ≤ 2. (As 𝑧 goes
once arou')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Start with the same flow as part (a). Use the Milne-Thomson Theorem to make this
flow go around the cylinder |𝑧| = 1. Give the complex potential, the stream function and
sketch some streamlines.
1
18.04 Problem Set 9, Spring 2018', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Below on the right is the flow asked for: uniform + vortex around a cylinder. As
a bonus, on the left, we show uniform around a cylinder. Stagnation points are shown as
orange dots. The cylinder is shown as an orange circle. We include the streamlines inside
the cylinder because they look nice!
In the figures 𝑈 = 1, 𝑄 = 1, 𝑉 = 2𝑖 and 𝑅 = 1.
Left: uniform flow around a cylinder. Right: uniform plus vortex around a cylinder.
As before, uniform flow has Φ𝑈 = 𝑈 𝑧. A vortex around 𝑧 = 2𝑖 has Φ𝑉 (𝑧) = 𝑖𝑄 log(𝑧 − 2𝑖).
So uniform plus vortex has complex potential
Φ𝑈𝑉 (𝑧) = 𝑈 𝑧 + 𝑖𝑄 log(𝑧 − 2𝑖).
The Milne-Thomson circle theorem implies that this flow around a cylinder of radius 𝑅 has
complex potential
𝑈 𝑅2
Φ(𝑧) = Φ𝑈𝑉 (𝑧) + Φ𝑈𝑉 (𝑅2 /𝑧) = 𝑈 𝑧 +         + 𝑖𝑄 log(𝑧 − 2𝑖) − 𝑖𝑄 log(𝑅2 /𝑧 + 2𝑖).
𝑧
The effect of 𝑈 is just to scale and rotate the flow. Setting 𝑈 = 1 makes the arithmetic a
little simpler and doesn’t affect the basic analysis, so let’s do that. We have
𝑅2
Φ(𝑧) = 𝑧 +      + 𝑖𝑄 log(𝑧 − 2𝑖) − 𝑖𝑄 log(𝑅2 /𝑧 + 2𝑖).
𝑧
So, for 𝑧 = 𝑥 + 𝑖𝑦, the stream function is
𝑅2 𝑦
𝜓 = Im(Φ) = (𝑦 −         + 𝑄 log(|𝑧 − 2𝑖|) − 𝑄 log(|𝑅2 /𝑧 + 2𝑖|)) .
𝑟2
Again we used Φ′ to draw some arrows for the velocity field and find stagnation points.
𝑅2     𝑖𝑄      𝑖𝑄𝑅2
Φ′ (𝑧) = 1 −      +       +            .                          (2)
𝑧2   𝑧 − 2𝑖 𝑧(𝑅2 + 2𝑖𝑧)
Stagnation points are where Φ′ (𝑧) = 0. Since we end up with a fourth order polynomial,
we used Octave’s roots function to find the roots.', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'choices' => array('s                                                  2', 'Impossible à déterminer', 'Pas s                                                  2', 'L\'inverse de s                                                  2'), 'correct' => 0, 'answer' => 's                                                  2', '_recupere_le' => '2026-11-04T19:55:22.398398+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Consider 𝑓(𝑧) = 𝑧 5 − 2𝑧.
How many times does 𝑓 wind the circle |𝑧| = 3 around the origin? That is, let 𝛾(𝜃)
parametrize the circle. How many times does the curve 𝑓 ∘ 𝛾(𝜃) wind around the origin.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The figure on the left below show the plot of 𝑓 ∘ 𝛾, where 𝛾 is the circle |𝑧| = 3.
Left plot: parts (a) and (c).   Right plot: part (b).
We will use the argument principle and Rouchés theorem to show that the winding number
of 𝑓 ∘ 𝛾 around 0 is Ind(𝑓 ∘ 𝛾, 0) = 5 .
Using the notation from the class notes, the argument principle says that Ind(𝑓 ∘ 𝛾, 0) =
𝑍𝑓,𝛾 − 𝑃𝑓,𝛾 . Since 𝑓 is entire there are no poles and we have
Ind(𝑓 ∘ 𝛾, 0) = 𝑍𝑓,𝛾
So, to show the winding number is 5, it suﬀices to show that 𝑓 has exactly 5 zeros inside 𝛾.
For this, we split 𝑓 into pieces: 𝑓 = 𝑔 + 𝑧, where 𝑔(𝑧) = 𝑧 5 and ℎ(𝑧) = −2𝑧. On |𝑧| = 3 we
have
|ℎ| = 6 < 35 = |𝑔|.
So Rouchés theorem implies that 𝑍𝑔,𝛾 = 𝑍𝑔+ℎ,𝛾 . Clearly 𝑍𝑔,𝛾 = 5 This shows that 𝑓 = 𝑔 + ℎ
has 5 zeros inside 𝛾. QED.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Consider 𝑓(𝑧) = 𝑧 5 − 2𝑧.
How many times does 𝑓 wind the circle |𝑧| = 3 around the origin? That is, let 𝛾(𝜃)
parametrize the circle. How many times does the curve 𝑓 ∘ 𝛾(𝜃) wind around the origin.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Consider 𝑓(𝑧) = 𝑧 5 − 2𝑧.
How many times does 𝑓 wind the circle |𝑧| = 3 around the origin? That is, let 𝛾(𝜃)
parametrize the circle. How many times does the curve 𝑓 ∘ 𝛾(𝜃) wind around the origin.', '_recupere_le' => '2026-11-04T19:55:22.398500+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The figure on the left below show the plot of 𝑓 ∘ 𝛾, where 𝛾 is the circle |𝑧| = 3.
Left plot: parts (a) and (c).   Right plot: part (b).
We will use the argument principle a')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Consider 𝑓(𝑧) = 𝑧 5 − 2𝑧.
How many times does 𝑓 wind the circle |𝑧| = 3 around the point 𝑧 = −2?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝛾 be the circle of radius 3 around the origin. Clearly, Ind(𝑓 ∘ 𝛾, −2) =
Ind(−2 + 𝑓 ∘ 𝛾, 0). Now we apply Rouchés theorem to show that 𝑓(𝑧) − 2 has 5 zeros inside
𝛾. This will imply that Ind(𝑓 ∘ 𝛾, −2) = 5.
Let 𝑔(𝑧) = 𝑧5 . |𝑔| = 35 on 𝛾. Also 𝑔 has 5 zeros inside 𝛾.
Let ℎ(𝑧) = −2𝑧 − 2. |ℎ| ≤ 8 on 𝛾.
Since |ℎ| < |𝑔| on 𝛾, Rouchés theorem says that 𝑓 − 2 = 𝑔 + ℎ and 𝑔 both have 5 zeros inside
𝛾.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Consider 𝑓(𝑧) = 𝑧 5 − 2𝑧.
How many times does 𝑓 wind the circle |𝑧| = 3 around the point 𝑧 = −2?]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Consider 𝑓(𝑧) = 𝑧 5 − 2𝑧.
How many times does 𝑓 wind the circle |𝑧| = 3 around the point 𝑧 = −2?', '_recupere_le' => '2026-11-04T19:55:22.398564+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Let 𝛾 be the circle of radius 3 around the origin. Clearly, Ind(𝑓 ∘ 𝛾, −2) =
Ind(−2 + 𝑓 ∘ 𝛾, 0). Now we apply Rouchés theorem to show that 𝑓(𝑧) − 2 has 5 zeros inside
𝛾. This')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Show that 𝑓(𝑧) = 𝑧6 + 4𝑧 2 − 1 has exactly two roots in the disk |𝑧| < 1.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Show that 𝑓(𝑧) = 𝑧 6 + 4𝑧 2 − 1 has exactly two roots in the disk |𝑧| < 1.
Let 𝑔(𝑧) = 4𝑧 2 − 1 and ℎ(𝑧) = 𝑧 6 . On the unit circle we have
|ℎ(𝑧)| = 1 < 3 ≤ |𝑔(𝑧)|.
So, since 𝑔 and ℎ have no poles, Rouchés theorem says 𝑔 and 𝑓 = 𝑔 + ℎ have the same
number of zeros inside the unit circle. The roots of 𝑔(𝑧) are ±1/2, i.e. 𝑔 has exactly two
zeros in the disk, therefore, so does 𝑓.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Show that 𝑓(𝑧) = 𝑧6 + 4𝑧 2 − 1 has exactly two roots in the disk |𝑧| < 1.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Show that 𝑓(𝑧) = 𝑧6 + 4𝑧 2 − 1 has exactly two roots in the disk |𝑧| < 1.', '_recupere_le' => '2026-11-04T19:55:22.398641+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Show that 𝑓(𝑧) = 𝑧 6 + 4𝑧 2 − 1 has exactly two roots in the disk |𝑧| < 1.
Let 𝑔(𝑧) = 4𝑧 2 − 1 and ℎ(𝑧) = 𝑧 6 . On the unit circle we have
|ℎ(𝑧)| = 1 < 3 ≤ |𝑔(𝑧)|.
So, since')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
In this problem we will consider linear systems with negative feedback, where the feedback
gain is 𝑘. That is, if 𝐺(𝑠) is the open loop system function then the closed loop system
𝐺(𝑠)
function is 𝐺𝐶𝐿 (𝑠) =            .
1 + 𝑘𝐺(𝑠)
𝑠+1
Suppose a linear system has system function 𝐺(𝑠) =                    . Let the feedback
(𝑠 − 1)(𝑠 − 2)
gain 𝑘 = 4. Is the closed loop system stable? Do this analytically.
18.04 Problem Set 9, Spring 2018', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have
𝑠+1
𝐺       (𝑠−1)(𝑠−2)                      𝑠+1
𝐺𝐶𝐿 =           =                     =                             .
1 + 𝑘𝐺   1 + 𝑘(𝑠+1)
(𝑠−1)(𝑠−2)
(𝑠 − 1)(𝑠 − 2) + 𝑘(𝑠 + 1)
𝑠+1
For 𝑘 = 4 this becomes 𝐺𝐶𝐿 (𝑠) = 2                . It’s easy to compute that 𝐺𝐶𝐿 has poles
√                               𝑠  +𝑠+6
−1 ± −23
. Since these are in the left half-plane, 𝐺𝐶𝐿 is stable.
2', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'choices' => array('L\'inverse de s                                                5', 'Impossible à déterminer', 's                                                5', 'Pas s                                                5'), 'correct' => 2, 'answer' => 's                                                5', '_recupere_le' => '2026-11-04T19:55:22.398879+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Let 𝑓(𝑧) = (𝑧 + 1/𝑧)/2. Use a package like Matlab or Mathematic to draw 𝑓 ∘ 𝛾 for the
following curves.
Make sure that the axes both have the same scale, so that circles plot as circles and not
ellipses. In Matlab the command axis equal after you plot will do this.
The circle |𝑧| = 3/2.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Here 𝑎 = 3/2, 𝑏 = 0. The image is an ellipse
18.04 Problem Set 9, Spring 2018 Solutions                                               7
3

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Let 𝑓(𝑧) = (𝑧 + 1/𝑧)/2. Use a package like Matlab or Mathematic to draw 𝑓 ∘ 𝛾 for the
following curves.
Make sure that the axes both have the same scale, so that circles plot as circles and not
ellipses. In Matlab the command axis equal after you plot will do this.
The circle |𝑧| = 3/2.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Let 𝑓(𝑧) = (𝑧 + 1/𝑧)/2. Use a package like Matlab or Mathematic to draw 𝑓 ∘ 𝛾 for the
following curves.
Make sure that the axes both have the same scale, so that circles plot as circles and not
ellipses. In Matlab the command axis equal after you plot will do this.
The circle |𝑧| = 3/2.', '_recupere_le' => '2026-11-04T19:55:22.399035+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Here 𝑎 = 3/2, 𝑏 = 0. The image is an ellipse
18.04 Problem Set 9, Spring 2018 Solutions                                               7
3

[Correction officielle MIT : [MIT 1')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Let 𝑓(𝑧) = (𝑧 + 1/𝑧)/2. Use a package like Matlab or Mathematic to draw 𝑓 ∘ 𝛾 for the
following curves.
Make sure that the axes both have the same scale, so that circles plot as circles and not
ellipses. In Matlab the command axis equal after you plot will do this.
The circle |e𝑖𝜋/4 𝑧 + 1/2| = 3/2.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is similar to part (b).
1  3                      3     1
𝑣 = e𝑖𝜋/4 𝑧 +     = e𝑖𝜃 , so, 𝑧 = e−𝑖𝜋/4 ( e𝑖𝜃 − )
2  2                      2     2
That is, 𝑎 = e−1𝑖∗𝜋/4 ∗ 1.5 and 𝑏 = e−1𝑖∗𝜋/4 ∗ (−0.5)
Notice how this looks like an airfoil. We could use a more complicated shaping functions to
map the circle to other shapes. This map would map a flow around the cylinder to a flow
around the new shape. For example, this could be used to study flow around a wing.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Let 𝑓(𝑧) = (𝑧 + 1/𝑧)/2. Use a package like Matlab or Mathematic to draw 𝑓 ∘ 𝛾 for the
following curves.
Make sure that the axes both have the same scale, so that circles plot as circles and not
ellipses. In Matlab the command axis equal after you plot will do this.
The circle |e𝑖𝜋/4 𝑧 + 1/2| = 3/2.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Let 𝑓(𝑧) = (𝑧 + 1/𝑧)/2. Use a package like Matlab or Mathematic to draw 𝑓 ∘ 𝛾 for the
following curves.
Make sure that the axes both have the same scale, so that circles plot as circles and not
ellipses. In Matlab the command axis equal after you plot will do this.
The circle |e𝑖𝜋/4 𝑧 + 1/2| = 3/2.', '_recupere_le' => '2026-11-04T19:55:22.399174+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : This is similar to part (b).
1  3                      3     1
𝑣 = e𝑖𝜋/4 𝑧 +     = e𝑖𝜃 , so, 𝑧 = e−𝑖𝜋/4 ( e𝑖𝜃 − )
2  2                      2     2
That is, 𝑎 = e−1𝑖∗𝜋/4 ∗ 1.')),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(30: 10,5,10,5 points)
𝑧
Compute all the values of 𝑖𝑖 . Say which one comes from the principal branch of log.
(Give all your', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : |𝑖| = 1 and Arg(𝑖) = 𝜋/2, so log(𝑖) =            𝑖 + 2𝑛𝜋𝑖, where 𝑛 is any integer. Thus
2
𝑖𝑖 = e𝑖 log(𝑖) = e−𝜋/2−2𝑛𝜋
On the principal branch 𝑖𝑖 = e−𝜋/2 . I’m surprised that it’s real!
√', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'choices' => array('L\'inverse de s in standard form.)
is it surprising that 𝑖𝑖 is real?
𝜋', 'Impossible à déterminer', 's in standard form.)
Is it surprising that 𝑖𝑖 is real?
𝜋', 'Pas s in standard form.)
is it surprising that 𝑖𝑖 is real?
𝜋'), 'correct' => 2, 'answer' => 's in standard form.)
Is it surprising that 𝑖𝑖 is real?
𝜋', '_recupere_le' => '2026-11-04T19:55:22.399286+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Show e𝑧 = e𝑧 .', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑧 = 𝑥 + 𝑖𝑦, then e𝑧 = e𝑥 e𝑖𝑦 = e𝑥 cos(𝑦) + 𝑖e𝑥 sin(𝑦). So,
(e𝑧 ) = e𝑥 cos(𝑦) − 𝑖e𝑥 sin(𝑦) = e𝑥 e−𝑖𝑦 = e𝑥−𝑖𝑦 = e𝑧

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Show e𝑧 = e𝑧 .]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Show e𝑧 = e𝑧 .', '_recupere_le' => '2026-11-04T19:55:22.399327+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Let 𝑧 = 𝑥 + 𝑖𝑦, then e𝑧 = e𝑥 e𝑖𝑦 = e𝑥 cos(𝑦) + 𝑖e𝑥 sin(𝑦). So,
(e𝑧 ) = e𝑥 cos(𝑦) − 𝑖e𝑥 sin(𝑦) = e𝑥 e−𝑖𝑦 = e𝑥−𝑖𝑦 = e𝑧

[Correction officielle MIT : [MIT 18.04 — question d’exa')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Let 𝑥+𝑖𝑦                      2   2
𝑥−𝑖𝑦 = 𝑎 + 𝑖𝑏. Show that 𝑎 + 𝑏 = 1.
Hint: This takes one line if you look at it right. Think polar form.
𝑥 + 𝑖𝑦       𝑟e𝑖𝜃', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If 𝑥 + 𝑖𝑦 = 𝑟e𝑖𝜃 , then 𝑥 − 𝑖𝑦 = 𝑟e−𝑖𝜃 . So, ∣             ∣ = ∣ −𝑖𝜃 ∣ = |e2𝑖𝜃 | = 1.    QED
𝑥 − 𝑖𝑦      𝑟e

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Let 𝑥+𝑖𝑦                      2   2
𝑥−𝑖𝑦 = 𝑎 + 𝑖𝑏. Show that 𝑎 + 𝑏 = 1.
Hint: This takes one line if you look at it right. Think polar form.
𝑥 + 𝑖𝑦       𝑟e𝑖𝜃]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Let 𝑥+𝑖𝑦                      2   2
𝑥−𝑖𝑦 = 𝑎 + 𝑖𝑏. Show that 𝑎 + 𝑏 = 1.
Hint: This takes one line if you look at it right. Think polar form.
𝑥 + 𝑖𝑦       𝑟e𝑖𝜃', '_recupere_le' => '2026-11-04T19:55:22.399435+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : If 𝑥 + 𝑖𝑦 = 𝑟e𝑖𝜃 , then 𝑥 − 𝑖𝑦 = 𝑟e−𝑖𝜃 . So, ∣             ∣ = ∣ −𝑖𝜃 ∣ = |e2𝑖𝜃 | = 1.    QED
𝑥 − 𝑖𝑦      𝑟e

[Correction officielle MIT : [MIT 18.04 — question d’examen, en a')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,10 points)
Consider the mapping 𝑧 → 𝑤 = 𝑧 2 . Draw the image in the 𝑤-plane of the triangular
region in the 𝑧-plane with vertices 0, 1 and 𝑖.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The figure shows the image.
In brief we have: 𝑧 = 1 ↦ 𝑤 = 1, 𝑧 = (1 + 𝑖)/2 ↦ 𝑤 = 𝑖/2, 𝑧 = 𝑖 ↦ 𝑤 = −1.
The sides of the triangle map as follows:
the line segment [0, 1] ↦ the line segment [0, 1]
the line segment [0, 𝑖] ↦ the line segment [0, −1]
the line segment [1, 𝑖] ↦ the parabola shown in the figure (proved below).
z 7→ w = z 2
Im(z)                                                Im(w)
i
0.5i
(1 + i)/2
Re(z)                                               Re(w)
1                               −1                   1
It takes a small amount of algebra to find the equation for the image of the segment
from 1 to 𝑖. We parametrize the segment as 𝑧 = (1 − 𝑡) + 𝑡𝑖 with 0 ≤ 𝑡 ≤ 1. Then
𝑤 = 𝑧 2 = (1 − 2𝑡) + 2𝑡(1 − 𝑡)𝑖. As a curve in the plane this is
𝑤 = (𝑢(𝑡), 𝑣(𝑡)), where 𝑢(𝑡) = 1 − 2𝑡 and 𝑣(𝑡) = 2𝑡(1 − 𝑡).
A little more algebra shows that 𝑡 = (1 − 𝑢)/2 and therefore 𝑣 = −𝑢2 + 1/2. This is the
18.04 Problem Set 1, Spring 2018 Solutions                                                  4
formula for the parabola shown.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(15: 5,10 points)
Consider the mapping 𝑧 → 𝑤 = 𝑧 2 . Draw the image in the 𝑤-plane of the triangular
region in the 𝑧-plane with vertices 0, 1 and 𝑖.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,10 points)
Consider the mapping 𝑧 → 𝑤 = 𝑧 2 . Draw the image in the 𝑤-plane of the triangular
region in the 𝑧-plane with vertices 0, 1 and 𝑖.', '_recupere_le' => '2026-11-04T19:55:22.399518+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The figure shows the image.
In brief we have: 𝑧 = 1 ↦ 𝑤 = 1, 𝑧 = (1 + 𝑖)/2 ↦ 𝑤 = 𝑖/2, 𝑧 = 𝑖 ↦ 𝑤 = −1.
The sides of the triangle map as follows:
the line segment [0, 1] ↦ the')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points) (Orthogonal lines stay orthogonal!)
Consider the mapping 𝑤 = e𝑧 .
(i) Sketch in the 𝑤-plane the image under this mapping of vertical lines in the 𝑧-plane.
(ii) On the same graph sketch the image of horizontal lines.
Show enough lines to give a good idea of what’s happening.
(iii) Show (argue either geometrically or analytically) that the images of a vertical and a
horizontal lines meet at right angles.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (i) As usual, let 𝑧 = 𝑥 + 𝑖𝑦. Vertical line have the equation 𝑥 = 𝑎 for some
constant 𝑎. We can parametrize this line by 𝑧 = 𝑎 + 𝑖𝑦, with −∞ < 𝑦 < ∞. The image of
the line under the mapping is
𝑤 = e𝑎+𝑖𝑦 = e𝑎 e𝑖𝑦 .
Thus |𝑤| = e𝑎 is constant, so the image is a circle of radius e𝑎 centered on 0.
(ii) Likewise, horizontal lines have the equation 𝑦 = 𝑏 for some constant 𝑏. We parametrize
this by 𝑧 = 𝑥 + 𝑖𝑏, with −∞ < 𝑥 < ∞. The image of the line under this mapping is
𝑤 = e𝑥+𝑖𝑏 = e𝑥 e𝑖𝑏 .
Thus arg(𝑤) = 𝑏 is constant, so the image is a ray from the origin at angle 𝑏.
In the figure below we label the corresponding curves with the same label. So, for example,
the image of the vertical line 𝑙𝑣4 is the circle in the 𝑤-plane labeled 𝑙𝑣4
18.04 Problem Set 1, Spring 2018 Solutions                                                                                                                                  5
Im(z)                                                                                 Im(w)
lh3
lv1                 lv2      lv3       lv4                     z 7→ w = ez
πi                          lh5
lh4                                lh2
3π/4 i                      lh4
π/2 i                       lh3                                                                             lv4
π/4 i
lv3
lh2                                                               lv2
lv1
Re(z)                                                                                   Re(w)
−1                     0        1/2        1      lh1                               lh5                                                        lh1
−π/4 i                      lh8
−π/2 i                      lh7
−3π/4 i                     lh6
lh8
lh6
lh7
(iii) The images found in parts (i) and (ii) are circles and rays. Geometrically we know
that radii are perpendicular to circles, so rays from the origin are perpendicular to circles
centered on the origin.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points) (Orthogonal lines stay orthogonal!)
Consider the mapping 𝑤 = e𝑧 .
(i) Sketch in the 𝑤-plane the image under this mapping of vertical lines in the 𝑧-plane.
(ii) On the same graph sketch the image of horizontal lines.
Show enough lines to give a good idea of what’s happening.
(iii) Show (argue either geometrically or analytically) that the images of a vertical and a
horizontal lines meet at right angles.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points) (Orthogonal lines stay orthogonal!)
Consider the mapping 𝑤 = e𝑧 .
(i) Sketch in the 𝑤-plane the image under this mapping of vertical lines in the 𝑧-plane.
(ii) On the same graph sketch the image of horizontal lines.
Show enough lines to give a good idea of what’s happening.
(iii) Show (argue either geometrically or analytically) that the images of a vertical and a
horizontal lines meet at right angles.', '_recupere_le' => '2026-11-04T19:55:22.399749+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (i) As usual, let 𝑧 = 𝑥 + 𝑖𝑦. Vertical line have the equation 𝑥 = 𝑎 for some
constant 𝑎. We can parametrize this line by 𝑧 = 𝑎 + 𝑖𝑦, with −∞ < 𝑦 < ∞. The image of
the line un')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Find all points where', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Answer: the set of points is the circle |𝑧 + 1/2| = 3/2, excluding the points 𝑧 = 1
and 𝑧 = −2 where arg(𝑤) is not defined.
Justification. Arg(𝑤) = ±𝜋/2 means that 𝑤 is on the imaginary axis (and 𝑤 ≠ 0). Thus
we must have
𝑧−1
𝑤=         = 𝑖𝑏, where 𝑏 ≠ 0 is real.
𝑧+2
2𝑖𝑏 + 1
Solving for 𝑧 we get 𝑧 =          .
−𝑖𝑏 + 1
We can view this as a mapping 𝑏 ↦ 𝑧 from the real 𝑏-line to the complex 𝑧-plane. A tiny
amount of algebra gives
2𝑖𝑏 + 1        3
𝑧=           =          − 2.
−𝑖𝑏 + 1     −𝑖𝑏 + 1
Ignoring the scale by 3 and the shift by -2 for the moment we have:
1
Claim. The image of 𝑤 = −𝑖𝑏+1   where 𝑏 is real is the circle |𝑤 − 1/2| = 1/2, i.e. the circle
with radius 1/2 and center 1/2.
Proof.
1                1 + 𝑏𝑖     1
|𝑤 − 1/2| = ∣           − 1/2∣ = ∣           ∣= .
−𝑖𝑏 + 1            2(1 − 𝑏𝑖)   2
(The last equality follow from problem 2c.)
Since 𝑧 = 3𝑤 − 2 we have the 𝑧-image is the circle of radius 3/2 with center 3/2 − 2 = −1/2.
𝑧−1
Alternative solution. 𝑤 = (𝑧 − 1)/(𝑧 + 2) is pure imaginary, so 𝑤 = −𝑤, i.e.              =
𝑧+2
𝑧−1
−       . A little algebra gives 2|𝑧|2 + 𝑧 + 𝑧 = 4.
𝑧+2
Let 𝑧 = 𝑥 + 𝑖𝑦. The above becomes 2(𝑥2 + 𝑦2 ) + 2𝑥 = 4 or 𝑥2 + 𝑦2 + 𝑥 = 4. Completing the
square gives (𝑥 + 1/2)2 + 𝑦2 = 9/4. That is |𝑧 + 1/2|2 = 9/4.
18.04 Problem Set 1, Spring 2018 Solutions   7
18.04 Complex Variables with Applications
Spring 2018
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'choices' => array('Impossible à déterminer', 'Pas 𝑧−1     𝜋
                                    arg (       )=±
                                            𝑧+2     2
hint: let 𝑤 = (𝑧 − 1)/𝑧 + 2). what does the condition say about the relation between 𝑤
and 𝑤? be careful to note points where arg(𝑤) is not defined.

18.04 complex variables with applications
spring 2018

for information about citing these materials or our terms of use, visit:', '𝑧−1     𝜋
                                    Arg (       )=±
                                            𝑧+2     2
Hint: let 𝑤 = (𝑧 − 1)/𝑧 + 2). What does the condition say about the relation between 𝑤
and 𝑤? Be careful to note points where Arg(𝑤) is not defined.

18.04 Complex Variables with Applications
Spring 2018

For information about citing these materials or our Terms of Use, visit:', 'L\'inverse de 𝑧−1     𝜋
                                    arg (       )=±
                                            𝑧+2     2
hint: let 𝑤 = (𝑧 − 1)/𝑧 + 2). what does the condition say about the relation between 𝑤
and 𝑤? be careful to note points where arg(𝑤) is not defined.

18.04 complex variables with applications
spring 2018

for information about citing these materials or our terms of use, visit:'), 'correct' => 2, 'answer' => '𝑧−1     𝜋
                                    Arg (       )=±
                                            𝑧+2     2
Hint: let 𝑤 = (𝑧 − 1)/𝑧 + 2). What does the condition say about the relation between 𝑤
and 𝑤? Be careful to note points where Arg(𝑤) is not defined.

18.04 Complex Variables with Applications
Spring 2018

For information about citing these materials or our Terms of Use, visit:', '_recupere_le' => '2026-11-04T19:55:22.399999+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Give the region where cot(𝑧) is analytic. Compute its derivative.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Give the region where cot(𝑧) is analytic. Compute its derivative.
cos(𝑧)
Since cot(𝑧) =        is the quotient of entire functions it is analytic for all 𝑧 except where
sin(𝑧)
sin(𝑧) = 0. We know sin(𝑧) = 0 for all multiples of 𝜋. To see that this is all the zeros of sin
we use the formula
sin(𝑧) = sin(𝑥) cosh(𝑦) + 𝑖 cos(𝑥) sinh(𝑦)
Since cosh(𝑦) is never 0, the real part of sin(𝑧) is only 0 where sin(𝑥) = 0, where 𝑥 = 𝑛𝜋
for some integer 𝑛. Since cos(𝑛𝜋) ≠ 0, the imaginary part of sin(𝑧) is only 0 if sinh(𝑦) = 0.
This only happens when 𝑦 = 0 Therefore, the zeros of sin(𝑧) are at 𝑧 = 𝑥 + 𝑖𝑦 = 𝑛𝜋.
So cot(𝑧) is analytic on the set C − {𝑛𝜋 where 𝑛 is an integer}.
We use the quotient rule to compute the derivative. Since the algebra will be identical to
the real case, we know the derivative will be − csc2 (𝑧):
𝑑 cot(𝑧)   𝑑 cos(𝑧)     − sin(𝑧) sin(𝑧) − cos(𝑧) cos(𝑧)      1
=   (       )=                2
=− 2      = − csc2 (𝑧).
𝑑𝑧      𝑑𝑧 sin(𝑧)                sin (𝑧)               sin (𝑧)
1
18.04 Problem Set 2, Spring 2018 Solutions                                                     2

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Give the region where cot(𝑧) is analytic. Compute its derivative.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Give the region where cot(𝑧) is analytic. Compute its derivative.', '_recupere_le' => '2026-11-04T19:55:22.400059+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Give the region where cot(𝑧) is analytic. Compute its derivative.
cos(𝑧)
Since cot(𝑧) =        is the quotient of entire functions it is analytic for all 𝑧 except where
sin(𝑧')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
𝑛
𝑃 ′ (𝑧)        1
Compute and simplify      (        ).
𝑑𝑧 𝑐𝑧 + 𝑑
What happens when 𝑎𝑑 − 𝑏𝑐 = 0 and why?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute and simplify      (       ).
𝑑𝑧 𝑐𝑧 + 𝑑
What happens when 𝑎𝑑 − 𝑏𝑐 = 0 and why?
𝑎𝑧 + 𝑏
Let 𝑓(𝑧) =        . The quotient rule gives
𝑐𝑧 + 𝑑
𝑎(𝑐𝑧 + 𝑑) − (𝑎𝑧 + 𝑏)𝑐    𝑎𝑑 − 𝑏𝑐
𝑓 ′ (𝑧) =                  2
=           .
(𝑐𝑧 + 𝑑)          (𝑐𝑧 + 𝑑)2
If 𝑎𝑑 − 𝑏𝑐 = 0 then the derivative is always 0, so 𝑓(𝑧) must be constant. We verify this
directly: We know 𝑎/𝑐 = 𝑏/𝑑, call this ratio 𝑟. Then
𝑎𝑧 + 𝑏   𝑟𝑐𝑧 + 𝑟𝑑
𝑓(𝑧) =           =          = 𝑟.
𝑐𝑧 + 𝑑    𝑐𝑧 + 𝑑
This shows that 𝑓(𝑧) is constant.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
𝑛
𝑃 ′ (𝑧)        1
Compute and simplify      (        ).
𝑑𝑧 𝑐𝑧 + 𝑑
What happens when 𝑎𝑑 − 𝑏𝑐 = 0 and why?]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
𝑛
𝑃 ′ (𝑧)        1
Compute and simplify      (        ).
𝑑𝑧 𝑐𝑧 + 𝑑
What happens when 𝑎𝑑 − 𝑏𝑐 = 0 and why?', '_recupere_le' => '2026-11-04T19:55:22.400141+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Compute and simplify      (       ).
𝑑𝑧 𝑐𝑧 + 𝑑
What happens when 𝑎𝑑 − 𝑏𝑐 = 0 and why?
𝑎𝑧 + 𝑏
Let 𝑓(𝑧) =        . The quotient rule gives
𝑐𝑧 + 𝑑
𝑎(𝑐𝑧 + 𝑑) − (𝑎𝑧 + 𝑏)𝑐    𝑎𝑑 −')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Let 𝑓(𝑧) be as in part (a). Show that 𝐹2 (𝑧) = 𝑓(𝑧) is not analytic unless 𝑓 is constant.
Hint for both parts: Use the Cauchy-Riemann equations.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This part is similar except we’ll find that the C-R equations are not satisfied
𝐹2 (𝑧) = 𝑓(𝑧) = 𝑢(𝑥, −𝑦) + 𝑖𝑣(𝑥, −𝑦).
We can write 𝐹2 (𝑧) = 𝑈2 (𝑥, 𝑦) + 𝑖𝑉2 (𝑥, 𝑦), where 𝑈2 (𝑥, 𝑦) = 𝑢(𝑥, −𝑦) and 𝑉2 (𝑥, 𝑦) =
𝑣(𝑥, −𝑦). Taking partial derivatives we get
𝜕𝑈2          𝜕𝑢             𝜕𝑈2    𝜕𝑢
(𝑥, 𝑦) =    (𝑥, −𝑦),        = − (𝑥, −𝑦)
𝜕𝑥           𝜕𝑥              𝜕𝑦    𝜕𝑦
𝜕𝑉2          𝜕𝑣             𝜕𝑉2    𝜕𝑣
(𝑥, 𝑦) =    (𝑥, −𝑦),        = − (𝑥, −𝑦)
𝜕𝑥          𝜕𝑥             𝜕𝑦     𝜕𝑦
18.04 Problem Set 2, Spring 2018 Solutions                                                  4
We see that
𝜕𝑈2          𝜕𝑢           𝜕𝑣             𝜕𝑉
(𝑥, 𝑦) =    (𝑥, −𝑦) =    (𝑥, −𝑦) = − 2 (𝑥, 𝑦)
𝜕𝑥           𝜕𝑥           𝜕𝑦             𝜕𝑦
𝜕𝑈2           𝜕𝑢           𝜕𝑣            𝜕𝑉2
(𝑥, 𝑦) = − (𝑥, −𝑦) =       (𝑥, −𝑦) =     (𝑥, 𝑦)
𝜕𝑦           𝜕𝑦           𝜕𝑥            𝜕𝑥
Thus, the C-R equations are not satisfied unless all the partials are 0, in which case 𝑓(𝑧) is
constant.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Let 𝑓(𝑧) be as in part (a). Show that 𝐹2 (𝑧) = 𝑓(𝑧) is not analytic unless 𝑓 is constant.
Hint for both parts: Use the Cauchy-Riemann equations.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Let 𝑓(𝑧) be as in part (a). Show that 𝐹2 (𝑧) = 𝑓(𝑧) is not analytic unless 𝑓 is constant.
Hint for both parts: Use the Cauchy-Riemann equations.', '_recupere_le' => '2026-11-04T19:55:22.400229+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : This part is similar except we’ll find that the C-R equations are not satisfied
𝐹2 (𝑧) = 𝑓(𝑧) = 𝑢(𝑥, −𝑦) + 𝑖𝑣(𝑥, −𝑦).
We can write 𝐹2 (𝑧) = 𝑈2 (𝑥, 𝑦) + 𝑖𝑉2 (𝑥, 𝑦), where 𝑈2 (')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(30: 10,10,10 points)
1
Consider the integral ∫     𝑑𝑧, where 𝐶 is the unit circle. Write out both the real and
𝐶 𝑧
imaginary parts as 18.02 integrals, i.e. of the form ∫𝐶 𝑀 (𝑥, 𝑦) 𝑑𝑥 + 𝑁 (𝑥, 𝑦) 𝑑𝑦.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Consider the integral ∫ 𝑑𝑧, where 𝐶 is the unit circle. Write out both the real and
𝐶 𝑧
imaginary parts as 18.02 integrals, i.e. of the form ∫𝐶 𝑀 (𝑥, 𝑦) 𝑑𝑥 + 𝑁 (𝑥, 𝑦) 𝑑𝑦.
1
18.04 Problem Set 3, Spring 2018 Solutions                                                           2
1     1      𝑥 − 𝑖𝑦
We have     =        = 2      , So
𝑧   𝑥 + 𝑖𝑦  𝑥 + 𝑦2
1        𝑥 − 𝑖𝑦                   𝑥            𝑦                −𝑦            𝑥
∫    𝑑𝑧 = ∫ 2      2
(𝑑𝑥+𝑖 𝑑𝑦) = ∫ 2     2
𝑑𝑥 + 2     2
𝑑𝑦 + 𝑖 ∫ 2      2
𝑑𝑥 + 2      𝑑𝑦
𝐶 𝑧      𝐶 𝑥 +  𝑦               𝑐 𝑥 + 𝑦       𝑥  + 𝑦          𝐶 𝑥 +  𝑦       𝑥  + 𝑦2
Note that the real part uses the radial vector field and the imaginary part uses the tangential
(to the circle) vector field.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(30: 10,10,10 points)
1
Consider the integral ∫     𝑑𝑧, where 𝐶 is the unit circle. Write out both the real and
𝐶 𝑧
imaginary parts as 18.02 integrals, i.e. of the form ∫𝐶 𝑀 (𝑥, 𝑦) 𝑑𝑥 + 𝑁 (𝑥, 𝑦) 𝑑𝑦.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(30: 10,10,10 points)
1
Consider the integral ∫     𝑑𝑧, where 𝐶 is the unit circle. Write out both the real and
𝐶 𝑧
imaginary parts as 18.02 integrals, i.e. of the form ∫𝐶 𝑀 (𝑥, 𝑦) 𝑑𝑥 + 𝑁 (𝑥, 𝑦) 𝑑𝑦.', '_recupere_le' => '2026-11-04T19:55:22.400335+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Consider the integral ∫ 𝑑𝑧, where 𝐶 is the unit circle. Write out both the real and
𝐶 𝑧
imaginary parts as 18.02 integrals, i.e. of the form ∫𝐶 𝑀 (𝑥, 𝑦) 𝑑𝑥 + 𝑁 (𝑥, 𝑦) 𝑑𝑦.
1
1')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Let 𝐶 be the circle of radius 1 centered at 𝑧 = −4. Let 𝑓(𝑧) = 1/(𝑧 + 4). and consider the
line integral
𝐼 = ∫ 𝑓(𝑧) 𝑑𝑧.
𝐶
Does Cauchy’s Theorem imply that 𝐼 = 0? Why or why not?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Does Cauchy’s Theorem imply that 𝐼 = 0? Why or why not?
No. 𝑓(𝑧) = 1/(𝑧 + 4) is not analytic at 𝑧 = −4. Since this is in the interior of 𝐶 the function
is not analytic on a simply connected region containing 𝐶, so Cauchy’s theorem does not
apply.
Im
C
Re
-4
The singularity 𝑧 = −4 is inside the curve 𝐶.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Let 𝐶 be the circle of radius 1 centered at 𝑧 = −4. Let 𝑓(𝑧) = 1/(𝑧 + 4). and consider the
line integral
𝐼 = ∫ 𝑓(𝑧) 𝑑𝑧.
𝐶
Does Cauchy’s Theorem imply that 𝐼 = 0? Why or why not?]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Let 𝐶 be the circle of radius 1 centered at 𝑧 = −4. Let 𝑓(𝑧) = 1/(𝑧 + 4). and consider the
line integral
𝐼 = ∫ 𝑓(𝑧) 𝑑𝑧.
𝐶
Does Cauchy’s Theorem imply that 𝐼 = 0? Why or why not?', '_recupere_le' => '2026-11-04T19:55:22.400442+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Does Cauchy’s Theorem imply that 𝐼 = 0? Why or why not?
No. 𝑓(𝑧) = 1/(𝑧 + 4) is not analytic at 𝑧 = −4. Since this is in the interior of 𝐶 the function
is not analytic on a s')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 10,5 points)
Compute ∫𝐶 𝑧1/3 𝑑𝑧, where 𝐶 the unit semicircle shown. Use the principal branch of
arg(𝑧) to compute the cube root.
Im 𝑧
𝐶
Re 𝑧
−1              1', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute ∫𝐶 𝑧1/3 𝑑𝑧, where 𝐶 the unit semicircle shown. Use the principal branch of
arg(𝑧) to compute the cube root.
Im 𝑧
𝐶
Re 𝑧
−1                1
We parametrize the curve being sure to put the polar angle in the proper branch of arg:
𝛾(𝑡) = e𝑖𝑡 , where 0 ≤ 𝑡 ≤ 𝜋. So,
𝜋                        𝜋
3 𝑖4𝑡/3 𝜋 3 𝑖4𝜋/3        3      √
∫𝑧 1/3 𝑑𝑧 = ∫ e𝑖𝑡/3 𝑖e𝑖𝑡 = 𝑖 ∫ e𝑖4𝑡/3 𝑑𝑡 =                        e    ∣ = (e     − 1) = (−3 − 𝑖 3).
𝛾          0                        0                       4       0 4              8

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(15: 10,5 points)
Compute ∫𝐶 𝑧1/3 𝑑𝑧, where 𝐶 the unit semicircle shown. Use the principal branch of
arg(𝑧) to compute the cube root.
Im 𝑧
𝐶
Re 𝑧
−1              1]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(15: 10,5 points)
Compute ∫𝐶 𝑧1/3 𝑑𝑧, where 𝐶 the unit semicircle shown. Use the principal branch of
arg(𝑧) to compute the cube root.
Im 𝑧
𝐶
Re 𝑧
−1              1', '_recupere_le' => '2026-11-04T19:55:22.400532+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Compute ∫𝐶 𝑧1/3 𝑑𝑧, where 𝐶 the unit semicircle shown. Use the principal branch of
arg(𝑧) to compute the cube root.
Im 𝑧
𝐶
Re 𝑧
−1                1
We parametrize the curve b')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(20: 5,5,5,5 points)
Use Cauchy’s integral formula to compute
sin(𝜋𝑧 2 ) + cos(𝜋𝑧 2 )
∫                         𝑑𝑧,
𝐶    (𝑧 − 1)(𝑧 − 2)
where 𝐶 is the circle of radius 4: |𝑧| = 4.
𝑧2', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Use Cauchy’s integral formula to compute
sin(𝜋𝑧 2 ) + cos(𝜋𝑧 2 )
∫                         𝑑𝑧,
𝐶    (𝑧 − 1)(𝑧 − 2)
where 𝐶 is the circle of radius 4: |𝑧| = 4.
sin(𝜋𝑧 2 ) + cos(𝜋𝑧 2 )
Let 𝑓(𝑧) =                           . There are two singularities of 𝑓 inside the contour 𝐶. Let’s
(𝑧 − 1)(𝑧 − 2)
use the trick of splitting 𝐶 into two closed contours, each of which surrounds exactly on
singularity.
Im(z)
C3
C2                               C1
−C3
Re(z)
1     2       4
Split |𝑧| = 4 into two contours.
We have
∫ 𝑓(𝑧) 𝑑𝑧 = ∫                   𝑓(𝑧) 𝑑𝑧 = ∫          𝑓(𝑧) 𝑑𝑧 + ∫            𝑓(𝑧) 𝑑𝑧.
𝐶            𝐶1 +𝐶3 −𝐶3 +𝐶2               𝐶1 +𝐶3                −𝐶3 +𝐶2
We compute each integral separately.
sin(𝜋𝑧2 ) + cos(𝜋𝑧 2 )
𝐶1 + 𝐶3 : This contour contains the singularity 𝑧 = 2. We let 𝑔(𝑧) =                           ,
(𝑧 − 1)
so 𝑓(𝑧) = 𝑔(𝑧)/(𝑧 − 2). Now, 𝑔(𝑧) is analytic on and inside 𝐶1 + 𝐶3 so, by Cauchy’s integral
formula we have
𝑔(𝑧)
∫         𝑓(𝑧) 𝑑𝑧 = ∫             𝑑𝑧 = 2𝜋𝑖𝑔(2) = 2𝜋𝑖.
𝐶1 +𝐶3              𝐶1 +𝐶3 𝑧 − 2
sin(𝜋𝑧 2 ) + cos(𝜋𝑧 2 )
−𝐶3 + 𝐶2 : This contour contains the singularity 𝑧 = 1. We let 𝑔(𝑧) =                    ,
(𝑧 − 2)
so 𝑓(𝑧) = 𝑔(𝑧)/(𝑧 − 2). Now, 𝑔(𝑧) is analytic on and inside −𝐶3 + 𝐶2 so, by Cauchy’s
integral formula we have
𝑔(𝑧)
∫           𝑓(𝑧) 𝑑𝑧 = ∫              𝑑𝑧 = 2𝜋𝑖𝑔(1) = 2𝜋𝑖.
−𝐶3 +𝐶2               −𝐶3 +𝐶2 𝑧 − 1
Add the results together we get: the integral in the question equals 4𝜋𝑖.
1
18.04 Problem Set 4, Spring 2018 Solutions                                                    2
Note. We could have done this with partial fractions. In essence, that is what we’ve
done. The method shown will be formalized and made easier once we’ve learned the residue
theorem.
𝑧2

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(20: 5,5,5,5 points)
Use Cauchy’s integral formula to compute
sin(𝜋𝑧 2 ) + cos(𝜋𝑧 2 )
∫                         𝑑𝑧,
𝐶    (𝑧 − 1)(𝑧 − 2)
where 𝐶 is the circle of radius 4: |𝑧| = 4.
𝑧2]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(20: 5,5,5,5 points)
Use Cauchy’s integral formula to compute
sin(𝜋𝑧 2 ) + cos(𝜋𝑧 2 )
∫                         𝑑𝑧,
𝐶    (𝑧 − 1)(𝑧 − 2)
where 𝐶 is the circle of radius 4: |𝑧| = 4.
𝑧2', '_recupere_le' => '2026-11-04T19:55:22.400667+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Use Cauchy’s integral formula to compute
sin(𝜋𝑧 2 ) + cos(𝜋𝑧 2 )
∫                         𝑑𝑧,
𝐶    (𝑧 − 1)(𝑧 − 2)
where 𝐶 is the circle of radius 4: |𝑧| = 4.
sin(𝜋𝑧 2 ) + co')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(20: 5,5,5,5 points)
Let 𝐶 be the circle of radius 2: |𝑧| = 2. Use Cauchy’s integral formula to compute
𝑧
∫             𝑑𝑧.
𝐶   𝑧2 − 1
Be careful: 𝑧 is not analytic, but there is a way around this.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝐶 be the circle of radius 2: |𝑧| = 2. Use Cauchy’s integral formula to compute
𝑧
∫                      𝑑𝑧.
𝐶   𝑧2 − 1
Be careful: 𝑧 is not analytic, but there is a way around this.
The trick here is that on the curve 𝐶 we have 𝑧 = 4/𝑧. Therefore,
𝑧                                  4
∫                 𝑑𝑧 = ∫                               𝑑𝑧.
𝐶   𝑧2 − 1                 𝐶   𝑧(𝑧 2 − 1)
(If you don’t believe this you should parametrize 𝐶 and write out both integrals explicitly.
You will see they are the same. Of course, this is special to the circle 𝐶. It woudn’t be true
on every curve.)
4
Now, 𝑓(𝑧) =       2
has three singularities inside 𝐶: at 𝑧 = 0, ±1. We use our trick of
𝑧(𝑧 − 1)
dividing 𝐶. This time into three loops.
Im(z)
C3
C5             −C4 C4 −C2 C2                      C1
Re(z)
−1                           1         2
C6
18.04 Problem Set 4, Spring 2018 Solutions                                                3
So, ∫ 𝑓(𝑧) 𝑑𝑧 = ∫                                 𝑓(𝑧) 𝑑𝑧 = ∫ 𝑓(𝑧) 𝑑𝑧+∫ 𝑓(𝑧) 𝑑𝑧+∫ 𝑓(𝑧) 𝑑𝑧.
𝐶            𝐶1 +𝐶2 −𝐶2 +𝐶3 +𝐶4 −𝐶4 +𝐶5 +𝐶6            𝐿1         𝐿2         𝐿3
Here 𝐿1 , 𝐿2 and 𝐿3 are the names of the loops as defined below. We now do the same thing
as in part (a). We will do it without many comments.
4
First note: 𝑓(𝑧) =                 .
𝑧(𝑧 − 1)(𝑧 + 1)
4
On 𝐿1 = 𝐶1 + 𝐶2 : Inside this loop 𝑓 has a singularity at 𝑧 = 1. Let 𝑔(𝑧) = 𝑧(𝑧+1) , so
𝑓(𝑧) = 𝑔(𝑧)/(𝑧 − 1).
𝑔(𝑧)
∫ 𝑓(𝑧) 𝑑𝑧 = ∫          = 2𝜋𝑖𝑔(1) = 4𝜋𝑖.
𝐿1            𝐿1 𝑧 − 1
On 𝐿2 = −𝐶2 + 𝐶3 + 𝐶4 + 𝐶6 : Inside this loop 𝑓 has a singularity at 𝑧 = 0. Let 𝑔(𝑧) =
4
(𝑧+1)(𝑧−1) , so 𝑓(𝑧) = 𝑔(𝑧)/𝑧.
𝑔(𝑧)
∫ 𝑓(𝑧) 𝑑𝑧 = ∫           = 2𝜋𝑖𝑔(0) = −8𝜋𝑖.
𝐿2              𝐿2 𝑧
4
On 𝐿3 = −𝐶4 + 𝐶5 : Inside this loop 𝑓 has a singularity at 𝑧 = −1. Let 𝑔(𝑧) = 𝑧(𝑧−1) , so
𝑓(𝑧) = 𝑔(𝑧)/(𝑧 + 1).
𝑔(𝑧)
∫ 𝑓(𝑧) 𝑑𝑧 = ∫            = 2𝜋𝑖𝑔(−1) = 4𝜋𝑖.
𝐿3              𝐿3 𝑧 +1
Totaling the contribution from each loop we have our answer: 4𝜋𝑖 − 8𝜋𝑖 + 4𝜋𝑖 = 0 .

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(20: 5,5,5,5 points)
Let 𝐶 be the circle of radius 2: |𝑧| = 2. Use Cauchy’s integral formula to compute
𝑧
∫             𝑑𝑧.
𝐶   𝑧2 − 1
Be careful: 𝑧 is not analytic, but there is a way around this.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(20: 5,5,5,5 points)
Let 𝐶 be the circle of radius 2: |𝑧| = 2. Use Cauchy’s integral formula to compute
𝑧
∫             𝑑𝑧.
𝐶   𝑧2 − 1
Be careful: 𝑧 is not analytic, but there is a way around this.', '_recupere_le' => '2026-11-04T19:55:22.400783+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Let 𝐶 be the circle of radius 2: |𝑧| = 2. Use Cauchy’s integral formula to compute
𝑧
∫                      𝑑𝑧.
𝐶   𝑧2 − 1
Be careful: 𝑧 is not analytic, but there is a way a')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 10,5 points)
Let 𝑓(𝑧) = 𝑧 𝑛 , where 𝑛 is a positive integer. By directly computing the integral, show
that Cauchy’s integral formula holds for 𝑓(𝑧0 ) and Cauchy’s formula for derivatives holds
for 𝑓 ′ (𝑧0 ).
You may need the binomial formula for expanding (𝑎 + 𝑏)𝑛 . As a hint: you may want
to make a short argument, based on Cauchy’s theorem, reducing the integrals to circles
centered on the point of interest.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑓(𝑧) = 𝑧 𝑛 , where 𝑛 is a positive integer. By directly computing the integral, show
that Cauchy’s integral formula holds for 𝑓(𝑧0 ) and Cauchy’s formula for derivatives holds
for 𝑓 ′ (𝑧0 ).
You may need the binomial formula for expanding (𝑎 + 𝑏)𝑛 . As a hint: you may want to
make a short argument, based on Cauchy’s theorem, reducing the integrals to circles centered
on the point of interest.
First 𝑓(𝑧0 ): Fix 𝑧0 as our point of interest. Suppose 𝐶 is a simple closed curve going
(counterclockwise) around 𝑧0 . Our goal is to show that
1      𝑧𝑛
∫         = 𝑧0𝑛 .
2𝜋𝑖 𝐶 𝑧 − 𝑧0
By the extended version of Cauchy’s theorem we know
𝑧𝑛         𝑧𝑛
∫        =∫         ,
𝐶 𝑧 − 𝑧0  𝐶𝑟 𝑧 − 𝑧0
where 𝐶𝑟 is a small circle centered at 𝑧0 and entirely inside 𝐶. This last integral we can
compute directly.
Parametrize 𝐶𝑟 : 𝛾(𝑡) = 𝑧0 + 𝑟e𝑖𝜃 , with 0 ≤ 𝜃 ≤ 2𝜋. 𝛾 ′ (𝜃) = 𝑖𝑟e𝑖𝜃 . So,
2𝜋                                      2𝜋
1       𝑧𝑛         1             (𝑧0 + 𝑟e𝑖𝜃 )𝑛             1
∫          𝑑𝑧 =    ∫                  𝑖𝜃
𝑖𝑟e𝑖𝜃 𝑑𝜃 =    ∫ (𝑧0 + 𝑟e𝑖𝜃 )𝑛 𝑑𝜃
2𝜋𝑖 𝐶𝑟 𝑧 − 𝑧0      2𝜋𝑖 0              𝑟e                   2𝜋 0
The binomial formula tells us that
2𝜋                          2𝜋
1                       1
∫ (𝑧0 + 𝑟e𝑖𝜃 )𝑛 𝑑𝜃 =    ∫ (𝑧0𝑛 + 𝑛𝑧0𝑛−1 𝑟e𝑖𝜃 + 𝑎2 𝑧0𝑛−2 𝑟2 e𝑖2𝜃 + … + 𝑟𝑛 e𝑖𝑛𝜃 ) 𝑑𝜃,
2𝜋 0                    2𝜋 0
2𝜋 𝑖𝑚𝜃
where the 𝑎𝑗 are binomial coeﬀicients whose exact value doesn’t concern us. Since ∫0        e    𝑑𝜃 =
0 for 𝑚 = 1, 2, 3, …, after integration, the only nonzero term in the integral is
2𝜋
1
∫          𝑧0𝑛 𝑑𝜃 = 𝑧0𝑛 .     QED
2𝜋 0
Second 𝑓 ′ (𝑧0 ). This is similar. We have to show that
1       𝑧𝑛
∫             = 𝑛𝑧0𝑛−1 .
2𝜋𝑖 𝐶 (𝑧 − 𝑧0 )2
18.04 Problem Set 4, Spring 2018 Solutions                                                               5
Using the binomial theorem we get
2𝜋
1        𝑧𝑛             1           (𝑧0 + 𝑟e𝑖𝜃 )𝑛
∫             2
𝑑𝑧 =    ∫                       𝑖𝑟e𝑖𝜃 𝑑𝜃
2𝜋𝑖 𝐶𝑟 (𝑧 − 𝑧0 )        2𝜋𝑖 0           𝑟2 e𝑖2𝜃
2𝜋
1          (𝑧0𝑛 + 𝑛𝑧0𝑛−1 𝑟e𝑖𝜃 + 𝑎2 𝑧0𝑛−2 𝑟2 e𝑖2𝜃 + … + 𝑟𝑛 e𝑖𝑛𝜃 )
=      ∫                                                              𝑑𝜃,
2𝜋 0                                𝑟e𝑖𝜃
2𝜋
1          (𝑧0𝑛 e−𝑖𝜃 + 𝑛𝑧0𝑛−1 𝑟 + 𝑎2 𝑧0𝑛−2 𝑟2 e𝑖𝜃 + … + 𝑟𝑛 e𝑖(𝑛−1)𝜃 )
=      ∫                                                                   𝑑𝜃
2𝜋 0                                     𝑟
After integration, the only nonzero term is
2𝜋
1
∫        𝑛𝑧0𝑛−1 𝑑𝜃 = 𝑛𝑧0𝑛−1 .     QED
2𝜋 0

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(15: 10,5 points)
Let 𝑓(𝑧) = 𝑧 𝑛 , where 𝑛 is a positive integer. By directly computing the integral, show
that Cauchy’s integral formula holds for 𝑓(𝑧0 ) and Cauchy’s formula for derivatives holds
for 𝑓 ′ (𝑧0 ).
You may need the binomial formula for expanding (𝑎 + 𝑏)𝑛 . As a hint: you may want
to make a short argument, based on Cauchy’s theorem, reducing the integrals to circles
centered on the point of interest.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(15: 10,5 points)
Let 𝑓(𝑧) = 𝑧 𝑛 , where 𝑛 is a positive integer. By directly computing the integral, show
that Cauchy’s integral formula holds for 𝑓(𝑧0 ) and Cauchy’s formula for derivatives holds
for 𝑓 ′ (𝑧0 ).
You may need the binomial formula for expanding (𝑎 + 𝑏)𝑛 . As a hint: you may want
to make a short argument, based on Cauchy’s theorem, reducing the integrals to circles
centered on the point of interest.', '_recupere_le' => '2026-11-04T19:55:22.400968+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Let 𝑓(𝑧) = 𝑧 𝑛 , where 𝑛 is a positive integer. By directly computing the integral, show
that Cauchy’s integral formula holds for 𝑓(𝑧0 ) and Cauchy’s formula for derivatives')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
|𝑧|e𝑧
Compute ∫ 2 𝑑𝑧 where 𝐶 is the circle |𝑧| = 2.
𝐶 𝑧
1
∞
1', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute ∫ 2 𝑑𝑧 where 𝐶 is the circle |𝑧| = 2.
𝐶 𝑧
|𝑧|e𝑧          2e𝑧
Since |𝑧| = 2 on C, the line integral ∫      2
𝑑𝑧 =  ∫   2
𝑑𝑧. We can compute this last
𝐶 𝑧            𝐶 𝑧
integral using Cauchy’s integral formula for the derivative.
Let 𝑔(𝑧) = 2e𝑧 . Then ∫𝐶 𝑔(𝑧)           ′
𝑧2 𝑑𝑧 = (2𝜋𝑖)𝑔 (0) = 4𝜋𝑖 .
∞
1

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
|𝑧|e𝑧
Compute ∫ 2 𝑑𝑧 where 𝐶 is the circle |𝑧| = 2.
𝐶 𝑧
1
∞
1]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
|𝑧|e𝑧
Compute ∫ 2 𝑑𝑧 where 𝐶 is the circle |𝑧| = 2.
𝐶 𝑧
1
∞
1', '_recupere_le' => '2026-11-04T19:55:22.401032+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Compute ∫ 2 𝑑𝑧 where 𝐶 is the circle |𝑧| = 2.
𝐶 𝑧
|𝑧|e𝑧          2e𝑧
Since |𝑧| = 2 on C, the line integral ∫      2
𝑑𝑧 =  ∫   2
𝑑𝑧. We can compute this last
𝐶 𝑧            𝐶')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
|𝑧|e𝑧
Show that ∫                       𝑑𝑧 = 0 in two different ways.
|𝑧|=2   𝑧2 (𝑧 − 1)3', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Show that ∫                                𝑑𝑧 = 0 in two different ways.
|𝑧|=2   𝑧 2 (𝑧 − 1)3
(i) Use Cauchy’s integral formula. You’ll need to divide the contour to isolate each of the
singularities of the integrand.
(ii) First, show that the integral doesn’t change if you replace the contour by the curve
|𝑧| = 𝑅 for 𝑅 > 2. Next, show that this integral must go to 0 as 𝑅 goes to infinity.
Both parts of this problem are similar to what we’ve done in earlier problems. We give brief
answers.
(i) Let 𝑓(𝑧) = 1/(𝑧 2 (𝑧 − 1)3 ). The countour |𝑧| = 2 contains singularities of 𝑓 at 𝑧 = 0 and
𝑧 = 1.
Loop around 0: Let 𝑔(𝑧) = 1/(𝑧 − 1)3 .
𝑔(𝑧)
∫        𝑓(𝑧), 𝑑𝑧 = ∫           2
= 2𝜋𝑖𝑔′ (0) = −6𝜋𝑖.
|𝑧|=2                  |𝑧|=2  𝑧
Loop around 1: Let 𝑔(𝑧) = 1/𝑧 2 .
𝑔(𝑧)
∫           𝑓(𝑧), 𝑑𝑧 = ∫                3
= 2𝜋𝑖𝑔″ (1) = 6𝜋𝑖.
|𝑧|=2                     |𝑧|=2 (𝑧 − 1)
Adding these together we get 0.
(ii) Since all the singularities of 𝑓 are inside |𝑧| = 2 the extended Cauchy theorem allow us
18.04 Problem Set 4, Spring 2018 Solutions                                                     8
to replace the contour |𝑧| = 2 by |𝑧| = 𝑅 without changing the integral. Then,
∣∫        𝑓(𝑧) 𝑑𝑧∣ ≤ ∫       |𝑓(𝑧)| |𝑑𝑧|
|𝑧|=𝑅              |𝑧|=𝑅
2𝜋
𝑅
=∫                            𝑑𝜃
0        𝑅2 |𝑅e𝑖𝜃 − 1|3
2𝜋
𝑅
≤∫                         𝑑𝜃
0        𝑅2 (𝑅 − 1)3
2𝜋𝑅
=
𝑅2 (𝑅 − 1)3
This clearly goes to 0 as 𝑅 goes to infinity.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
|𝑧|e𝑧
Show that ∫                       𝑑𝑧 = 0 in two different ways.
|𝑧|=2   𝑧2 (𝑧 − 1)3]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
|𝑧|e𝑧
Show that ∫                       𝑑𝑧 = 0 in two different ways.
|𝑧|=2   𝑧2 (𝑧 − 1)3', '_recupere_le' => '2026-11-04T19:55:22.401109+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Show that ∫                                𝑑𝑧 = 0 in two different ways.
|𝑧|=2   𝑧 2 (𝑧 − 1)3
(i) Use Cauchy’s integral formula. You’ll need to divide the contour to isolate')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
𝜋
Show ∫ ecos 𝜃 cos(sin(𝜃)) 𝑑𝜃 = 𝜋. Hint, consider e𝑧 /𝑧 over the unit circle.
       0', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (Follow the hint.) Parametrize the unit circle as 𝛾(𝜃) = e𝑖𝜃 , with 0 ≤ 𝜃 ≤ 2𝜋. So,
2𝜋                                               2𝜋
e𝑧                   e𝑐𝑜𝑠𝜃+𝑖 sin 𝜃 𝑖𝜃
∫     𝑑𝑧 = ∫                         𝑖e 𝑑𝜃 = 𝑖 ∫                         e𝑐𝑜𝑠𝜃+𝑖 sin 𝑑𝜃
𝛾 𝑧       0                e𝑖𝜃                0
2𝜋                                                                 2𝜋
cos 𝜃
= 𝑖∫        e           (cos(sin 𝜃) + 𝑖 sin(sin 𝜃)) 𝑑𝜃 = ∫                     ecos 𝜃 (𝑖 cos(sin 𝜃) − sin(sin 𝜃)) 𝑑𝜃.
0                                                                  0
This is close to what we want. Let’s use Cauchy’s integral formula to evaluate it and then
extract the value we need. By Cauchy the integral is 2𝜋𝑖e0 = 2𝜋𝑖. So,
2𝜋
∫         ecos 𝜃 (𝑖 cos(sin 𝜃) − sin(sin 𝜃)) 𝑑𝜃 = 2𝜋𝑖.
0
Taking the imaginary part we have
2𝜋
∫         ecos 𝜃 cos(sin 𝜃) 𝑑𝜃 = 2𝜋.
0
18.04 Problem Set 4, Spring 2018 Solutions                                                       11
This integral goes to 2𝜋, while our integral goes to 𝜋. By symmetry ours is half the above.
(It might be easier to see this if you use the limits [−𝜋, 𝜋] instead of [0, 2𝜋].)
Answer: 𝜋 (as we were supposed to show).

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
𝜋
Show ∫ ecos 𝜃 cos(sin(𝜃)) 𝑑𝜃 = 𝜋. Hint, consider e𝑧 /𝑧 over the unit circle.
       0]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
𝜋
Show ∫ ecos 𝜃 cos(sin(𝜃)) 𝑑𝜃 = 𝜋. Hint, consider e𝑧 /𝑧 over the unit circle.
       0', '_recupere_le' => '2026-11-04T19:55:22.401173+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (Follow the hint.) Parametrize the unit circle as 𝛾(𝜃) = e𝑖𝜃 , with 0 ≤ 𝜃 ≤ 2𝜋. So,
2𝜋                                               2𝜋
e𝑧                   e𝑐𝑜𝑠𝜃+𝑖 sin 𝜃 𝑖𝜃
')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Challenge: Redo part (a), but drop the assumption that 𝐴 is simply connected.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Challenge: Redo part (a), but drop the assumption that 𝐴 is simply connected.
𝑓(𝑧)                                                               𝑓 ′ (𝑧)      𝑓(𝑧)
Let 𝑔(𝑧) = 𝑧−𝑧  . 𝑔 is analytic on a neighborhood of 𝛾. Note: 𝑔′ (𝑧) =                −            .
0                                                             𝑧 − 𝑧0    (𝑧 − 𝑧0 )2
So,
𝑓 ′ (𝑧)           𝑓(𝑧)
∫          𝑑𝑧 − ∫           2
𝑑𝑧 = ∫ 𝑔′ (𝑧) 𝑑𝑧 = 0.
𝛾 𝑧 − 𝑧0       𝛾 (𝑧 − 𝑧0 )        𝛾
It equals 0 because the integral of a derivative around a closed curve is 0. So, the two
integrals on the left side are equal.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Challenge: Redo part (a), but drop the assumption that 𝐴 is simply connected.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Challenge: Redo part (a), but drop the assumption that 𝐴 is simply connected.', '_recupere_le' => '2026-11-04T19:55:22.401228+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Challenge: Redo part (a), but drop the assumption that 𝐴 is simply connected.
𝑓(𝑧)                                                               𝑓 ′ (𝑧)      𝑓(𝑧)
Let 𝑔(𝑧) =')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
cos(𝑧)
Compute ∫     2
𝑑𝑧, where 𝐶 is the circle |𝑧| = 2.
𝐶 𝑧 +1', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Singularities are at ±𝑖.
−2       −2
Integral = 2𝜋𝑖      + 2𝜋𝑖     = 0.
2𝑖       −2𝑖
1

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
cos(𝑧)
Compute ∫     2
𝑑𝑧, where 𝐶 is the circle |𝑧| = 2.
𝐶 𝑧 +1]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
cos(𝑧)
Compute ∫     2
𝑑𝑧, where 𝐶 is the circle |𝑧| = 2.
𝐶 𝑧 +1', '_recupere_le' => '2026-11-04T19:55:22.401283+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Singularities are at ±𝑖.
−2       −2
Integral = 2𝜋𝑖      + 2𝜋𝑖     = 0.
2𝑖       −2𝑖
1

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
cos(𝑧)
Compu')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,10 points)
Let 𝑢(𝑥, 𝑦) = 𝑥3 − 3𝑥𝑦2 + 2𝑥.
Find a harmonic conjugate 𝑣 for 𝑢 in two ways.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (i) By Cauchy-Riemann 𝑣𝑥 = −𝑢𝑦 = 6𝑥𝑦, 𝑣𝑦 = 𝑢𝑥 = 3𝑥2 − 3𝑦2 + 2 Integrating 𝑣𝑥 with
respect to 𝑥 we get 𝑣 = 3𝑥2 𝑦 + 𝑔(𝑦), where 𝑔(𝑦) is a function of 𝑦 alone.
Integrating 𝑣𝑦 with respect to 𝑦 we get 𝑣 = 3𝑥2 − 𝑦3 + 2𝑦 + ℎ(𝑥), where ℎ(𝑥) is a function
of 𝑥 alone.
Comparing the two expressions for 𝑣 we get 𝑔(𝑦) = −𝑦3 + 2𝑦 + ℎ(𝑥). Since 𝑔 is a function
of 𝑦 alone, we must have ℎ(𝑥) is constant. So, 𝑔(𝑦) = −𝑦3 + 2𝑦 + 𝑐 and
𝑣 = 3𝑥2 𝑦 − 𝑦3 + 2𝑦 + 𝑐,
where 𝑐 is an arbitrary constant.
(ii)
𝑓 ′ = 𝑢𝑥 − 𝑖𝑢𝑦 = 3𝑥2 − 𝑦2 + 2 + 𝑖6𝑥𝑦 = 3(𝑥2 − 𝑦2 + 𝑖2𝑥𝑦) + 2 = 3𝑧 2 + 2.
Therefore 𝑓 = 𝑧3 + 2𝑧 + 𝐶 = (𝑥3 − 𝑥𝑦2 + 2𝑥 + 𝑐1 ) + 𝑖(3𝑥2 𝑦 − 𝑦3 + 2𝑦 + 𝑐2 ), where 𝐶 = 𝑐1 + 𝑖𝑐2 .
So,
𝑣 = Im(𝑓) = 3𝑥2 𝑦 − 𝑦3 + 2𝑦 + 𝑐2 .
Exactly as in part (i).

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(15: 5,10 points)
Let 𝑢(𝑥, 𝑦) = 𝑥3 − 3𝑥𝑦2 + 2𝑥.
Find a harmonic conjugate 𝑣 for 𝑢 in two ways.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,10 points)
Let 𝑢(𝑥, 𝑦) = 𝑥3 − 3𝑥𝑦2 + 2𝑥.
Find a harmonic conjugate 𝑣 for 𝑢 in two ways.', '_recupere_le' => '2026-11-04T19:55:22.401349+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (i) By Cauchy-Riemann 𝑣𝑥 = −𝑢𝑦 = 6𝑥𝑦, 𝑣𝑦 = 𝑢𝑥 = 3𝑥2 − 3𝑦2 + 2 Integrating 𝑣𝑥 with
respect to 𝑥 we get 𝑣 = 3𝑥2 𝑦 + 𝑔(𝑦), where 𝑔(𝑦) is a function of 𝑦 alone.
Integrating 𝑣𝑦 wi')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Same question for 𝑢(𝑥, 𝑦) = (𝑥2 − 𝑦2 )/𝑟4 .', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : In this case we won’t bother checking that 𝑢 is harmonic. Once we find the
analytic 𝑓 we’ll know that 𝑢 is harmonic. First we do the algebra to find 𝑓 ′ = 𝑢𝑥 − 𝑖𝑢𝑦 .
You may have to fill in a few algebraic steps to see how we did the full computation.
𝑢 = (𝑥2 − 𝑦2 )𝑟−4
2𝑥𝑟2 − 4𝑥3 + 4𝑥𝑦2    −2(𝑥3 − 3𝑥𝑦2 )
𝑢𝑥 = 2𝑥𝑟−4 − 4(𝑥2 − 𝑦2 )𝑥𝑟−6 =                   =
𝑟6                𝑟6
2       2    3
−2𝑦𝑟 − 4𝑥 𝑦 + 4𝑦      −2(3𝑥2 𝑦 − 𝑦3 )
𝑢𝑦 = −2𝑦𝑟−4 − 4(𝑥2 − 𝑦2 )𝑦𝑟−6 =                     =
𝑟6                𝑟6
So
−2[𝑥3 − 3𝑥𝑦2 − 𝑖(3𝑥2 𝑦 − 𝑦3 )]   −2(𝑥 − 𝑖𝑦)3       𝑧3        2
𝑓 ′ = 𝑢𝑥 − 𝑖𝑢𝑦 =                 6
=       6
= −2      3
= − 3.
𝑟                        𝑟            𝑧3 𝑧      𝑧
1  𝑧2   𝑥2 − 𝑦2 − 𝑖2𝑥𝑦                  2𝑥𝑦
Thus, 𝑓(𝑧) = 2 = 4 =                and 𝑣 = Im(𝑓) = − 4 .
𝑧   𝑟          𝑟4                         𝑟

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Same question for 𝑢(𝑥, 𝑦) = (𝑥2 − 𝑦2 )/𝑟4 .]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(20: 10,10 points)
Same question for 𝑢(𝑥, 𝑦) = (𝑥2 − 𝑦2 )/𝑟4 .', '_recupere_le' => '2026-11-04T19:55:22.401402+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : In this case we won’t bother checking that 𝑢 is harmonic. Once we find the
analytic 𝑓 we’ll know that 𝑢 is harmonic. First we do the algebra to find 𝑓 ′ = 𝑢𝑥 − 𝑖𝑢𝑦 .
You may')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 10,5 points)
Let 𝐴 be the region bounded by the positive 𝑥 axis and the ray 𝑥 = 𝑦 in the first quadrant.
18.04 Problem Set 5, Spring 2018', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Find a nonzero function 𝜓 that is harmonic on 𝐴 and is 0 on the boundary.
Hint: Start with the same question on the upper half-plane 𝑦 > 0.', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'choices' => array('Pas s                                                               3
find a nonzero function 𝜓 that is harmonic on 𝐴 and is 0 on the boundary.
hint: start with the same question on the upper half-plane 𝑦 > 0.', 'Impossible à déterminer', 's                                                               3
Find a nonzero function 𝜓 that is harmonic on 𝐴 and is 0 on the boundary.
Hint: Start with the same question on the upper half-plane 𝑦 > 0.', 'L\'inverse de s                                                               3
find a nonzero function 𝜓 that is harmonic on 𝐴 and is 0 on the boundary.
hint: start with the same question on the upper half-plane 𝑦 > 0.'), 'correct' => 2, 'answer' => 's                                                               3
Find a nonzero function 𝜓 that is harmonic on 𝐴 and is 0 on the boundary.
Hint: Start with the same question on the upper half-plane 𝑦 > 0.', '_recupere_le' => '2026-11-04T19:55:22.401580+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Consider the complex potential for a fluid given by Φ(𝑧) = 𝐴𝑧 3 , where 𝐴 > 0:
18.04 Problem Set 5, Spring 2018', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : So, 𝜙 = Re(Φ) = 𝐴(𝑥3 − 3𝑥𝑦2 ) . 𝜓 = Im(Φ) = 𝐴(𝑥3 − 3𝑥𝑦2 ) . (𝑢, 𝑣) = ∇𝜙 = 𝐴(3𝑥2 − 3𝑦2 , −6𝑥𝑦).', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'choices' => array('s                                                   4
Find the potential 𝜙, the stream-function 𝜓 and the velocity field (𝑢, 𝑣).', 'L\'inverse de s                                                   4
find the potential 𝜙, the stream-function 𝜓 and the velocity field (𝑢, 𝑣).', 'Impossible à déterminer', 'Pas s                                                   4
find the potential 𝜙, the stream-function 𝜓 and the velocity field (𝑢, 𝑣).'), 'correct' => 0, 'answer' => 's                                                   4
Find the potential 𝜙, the stream-function 𝜓 and the velocity field (𝑢, 𝑣).', '_recupere_le' => '2026-11-04T19:55:22.401781+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Consider the complex potential for a fluid given by Φ(𝑧) = 𝐴𝑧 3 , where 𝐴 > 0:
18.04 Problem Set 5, Spring 2018', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is similar to the previous problem. The rays at angles 𝜃 = 0, 𝜋/3, 2𝜋/3, ..., 5𝜋/3
are all streamlines. So, they divide the plane into 6 wedges with vertex angle 𝜋/3. We can
view each of the wedges as having walls at its boundary and the streamlines represent a
flow within the wedge.', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'choices' => array('s                                                   4
Use this to find an incompressible, irrotational flow in a wedge (for some angle)?
What is the angle of the wedge you can do with this solution?
1', 'Pas s                                                   4
use this to find an incompressible, irrotational flow in a wedge (for some angle)?
what is the angle of the wedge you can do with this solution?
1', 'L\'inverse de s                                                   4
use this to find an incompressible, irrotational flow in a wedge (for some angle)?
what is the angle of the wedge you can do with this solution?
1', 'Impossible à déterminer'), 'correct' => 0, 'answer' => 's                                                   4
Use this to find an incompressible, irrotational flow in a wedge (for some angle)?
What is the angle of the wedge you can do with this solution?
1', '_recupere_le' => '2026-11-04T19:55:22.402007+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Let 𝐴 be the unit disk. Assume it is made of a heat conducting material and that in our
two dimensional world it only loses heat through its boundary. Then at steady state the
temperature 𝑇 (𝑥, 𝑦) in the disk is a harmonic function.
Suppose we hold the temperature of the boundary fixed at
𝑇 (e𝑖𝜃 ) = 𝑇 (cos(𝜃), sin(𝜃)) = sin2 (𝜃).
What is the temperature at the center of the disk?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We can use the mean value theorem for harmonic functions
2𝜋                          2𝜋
1                           1                          1
𝑇 (0, 0) =      ∫        𝑇 (e𝑖𝜃 ) 𝑑𝜃 =      ∫        sin2 (𝜃) 𝑑𝜃 =     .
2𝜋 0                        2𝜋 0                        2
(We’ll leave the details of the last integration for you to supply.)

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Let 𝐴 be the unit disk. Assume it is made of a heat conducting material and that in our
two dimensional world it only loses heat through its boundary. Then at steady state the
temperature 𝑇 (𝑥, 𝑦) in the disk is a harmonic function.
Suppose we hold the temperature of the boundary fixed at
𝑇 (e𝑖𝜃 ) = 𝑇 (cos(𝜃), sin(𝜃)) = sin2 (𝜃).
What is the temperature at the center of the disk?]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Let 𝐴 be the unit disk. Assume it is made of a heat conducting material and that in our
two dimensional world it only loses heat through its boundary. Then at steady state the
temperature 𝑇 (𝑥, 𝑦) in the disk is a harmonic function.
Suppose we hold the temperature of the boundary fixed at
𝑇 (e𝑖𝜃 ) = 𝑇 (cos(𝜃), sin(𝜃)) = sin2 (𝜃).
What is the temperature at the center of the disk?', '_recupere_le' => '2026-11-04T19:55:22.402188+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : We can use the mean value theorem for harmonic functions
2𝜋                          2𝜋
1                           1                          1
𝑇 (0, 0) =      ∫        𝑇 (e')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Let 𝐴 be the unit disk. Assume it is made of a heat conducting material and that in our
two dimensional world it only loses heat through its boundary. Then at steady state the
temperature 𝑇 (𝑥, 𝑦) in the disk is a harmonic function.
Suppose we hold the temperature of the boundary fixed at
𝑇 (e𝑖𝜃 ) = 𝑇 (cos(𝜃), sin(𝜃)) = sin2 (𝜃).
What is the minimum temperature on the disk?
Challenge. Find the temperature 𝑇 (𝑥, 𝑦) throughout the disk.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Likewise, the minimum value principle says 𝑇 attains its minimum on the boundary.
The minimum of sin2 (𝜃) is 0 ..
Challenge. Method 1. The systematic way to solve this using the Poisson integral
formula. You can look it up on the web or in the textbooks linked to from the class website.
Computing the integral is doable, but a bit of a chore.
Method 2. Notice that
1 − cos(2𝜃)        1 − e𝑖2𝜃
sin2 (𝜃) =                   = Re (          )
2                2
Replacing e𝑖2𝜃 by 𝑧 2 we have that, on the unit circle 𝑧 = e𝑖𝜃
𝑇 (𝑧) = Re((1 − 𝑧 2 )/2).
Since (1 − 𝑧 2 )/2 is analytic, its real part is harmonic over the whole disk, i.e.
1 − 𝑧2   1 𝑥2 − 𝑦2
𝑇 (𝑥, 𝑦) = Re (              )= −        .
2      2    2

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Let 𝐴 be the unit disk. Assume it is made of a heat conducting material and that in our
two dimensional world it only loses heat through its boundary. Then at steady state the
temperature 𝑇 (𝑥, 𝑦) in the disk is a harmonic function.
Suppose we hold the temperature of the boundary fixed at
𝑇 (e𝑖𝜃 ) = 𝑇 (cos(𝜃), sin(𝜃)) = sin2 (𝜃).
What is the minimum temperature on the disk?
Challenge. Find the temperature 𝑇 (𝑥, 𝑦) throughout the disk.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
(15: 5,5,5 points)
Let 𝐴 be the unit disk. Assume it is made of a heat conducting material and that in our
two dimensional world it only loses heat through its boundary. Then at steady state the
temperature 𝑇 (𝑥, 𝑦) in the disk is a harmonic function.
Suppose we hold the temperature of the boundary fixed at
𝑇 (e𝑖𝜃 ) = 𝑇 (cos(𝜃), sin(𝜃)) = sin2 (𝜃).
What is the minimum temperature on the disk?
Challenge. Find the temperature 𝑇 (𝑥, 𝑦) throughout the disk.', '_recupere_le' => '2026-11-04T19:55:22.402377+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Likewise, the minimum value principle says 𝑇 attains its minimum on the boundary.
The minimum of sin2 (𝜃) is 0 ..
Challenge. Method 1. The systematic way to solve this using')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Find the radius of convergence.
∞
𝑧3𝑛', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is a finite series. The radius of convergence is ∞.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Find the radius of convergence.
∞
𝑧3𝑛]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Find the radius of convergence.
∞
𝑧3𝑛', '_recupere_le' => '2026-11-04T19:55:22.402418+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : This is a finite series. The radius of convergence is ∞.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Find the radius of convergence.
∞
𝑧3𝑛]')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
1
What is the order of the pole of 𝑓1 (𝑧) =                            at 𝑧 = 0.
(2 cos(𝑧) − 2 + 𝑧2 )2
Hint: Work with 1/𝑓1 (𝑧).', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑔 = 1/𝑓1 = (2 cos(𝑧) − 2 + 𝑧 2 )2 . We write out the Taylor series for this
2
𝑧2 𝑧4                           2
𝑔(𝑧) = (2 (1 −    +    − …) − 2 + 𝑧 2 ) = 𝑧 8 ( + 𝑎9 𝑧 + + …)
2!   4!                         4!
Since 𝑔 has a zero of order 8, 𝑓1 = 1/𝑔 has a pole of order 8 at 𝑧 = 0.
𝑧2 + 1

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
1
What is the order of the pole of 𝑓1 (𝑧) =                            at 𝑧 = 0.
(2 cos(𝑧) − 2 + 𝑧2 )2
Hint: Work with 1/𝑓1 (𝑧).]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
1
What is the order of the pole of 𝑓1 (𝑧) =                            at 𝑧 = 0.
(2 cos(𝑧) − 2 + 𝑧2 )2
Hint: Work with 1/𝑓1 (𝑧).', '_recupere_le' => '2026-11-04T19:55:22.402505+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Let 𝑔 = 1/𝑓1 = (2 cos(𝑧) − 2 + 𝑧 2 )2 . We write out the Taylor series for this
2
𝑧2 𝑧4                           2
𝑔(𝑧) = (2 (1 −    +    − …) − 2 + 𝑧 2 ) = 𝑧 8 ( + 𝑎9 𝑧 + +')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
1
Let 𝑓3 (𝑧) =           . Find all the isolated singularities and compute the residue at
𝑧(𝑧 + 1)3
each one.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : There are poles at 𝑧 = 0 and 𝑧 = −1.
At 𝑧 = 0:   the pole is simple,
Res(𝑓3 , 0) = lim 𝑧𝑓3 (𝑧) = 1 (by inspection).
𝑧→0
18.04 Problem Set 6, Spring 2018 Solutions                                                           3
e𝑧
At 𝑧 = −1:         𝑔(𝑧) = (𝑧 + 1)3 𝑓3 (𝑧) =
is analytic at 𝑧 = −1. If 𝑔(𝑧) = 𝑎0 + 𝑎1 (𝑧 + 1) + …,
𝑧
then Res(𝑓, −1) = 𝑎2 = 𝑔″ (−1)/2!. Now it’s easy to compute that Res(𝑓3 , −1) = −5e−1 /2.
1

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
1
Let 𝑓3 (𝑧) =           . Find all the isolated singularities and compute the residue at
𝑧(𝑧 + 1)3
each one.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
1
Let 𝑓3 (𝑧) =           . Find all the isolated singularities and compute the residue at
𝑧(𝑧 + 1)3
each one.', '_recupere_le' => '2026-11-04T19:55:22.402575+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : There are poles at 𝑧 = 0 and 𝑧 = −1.
At 𝑧 = 0:   the pole is simple,
Res(𝑓3 , 0) = lim 𝑧𝑓3 (𝑧) = 1 (by inspection).
𝑧→0
18.04 Problem Set 6, Spring 2018 Solutions')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
1
Let 𝑓5 (𝑧) =          𝑧            , where 𝑓(𝑧) is analytic and 𝑓(0) = 1. Find the residue at
∫0 𝑓(𝑤) 𝑑𝑤
𝑧 = 0.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑓5 (𝑧) =        𝑧             , where 𝑓(𝑧) is analytic and 𝑓(0) = 1. Find the residue at 𝑧 = 0.
∫0 𝑓(𝑤) 𝑑𝑤
𝑧
Let 𝑔(𝑧) = ∫ 𝑓(𝑤) 𝑑𝑤. So 𝑔 is analytic and 𝑔(0) = 0 and 𝑔′ (0) = 𝑓(0) = 1. That is 𝑔 has
0
a simple zero at 𝑧 = 0. Thus, 𝑓5 (𝑧) = cos(𝑧)/𝑔(𝑧) has a simple pole at 𝑧 = 0 and we have,
cos(0)
Res(𝑓5 , 0) =           =1
𝑔′ (0)

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
1
Let 𝑓5 (𝑧) =          𝑧            , where 𝑓(𝑧) is analytic and 𝑓(0) = 1. Find the residue at
∫0 𝑓(𝑤) 𝑑𝑤
𝑧 = 0.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
1
Let 𝑓5 (𝑧) =          𝑧            , where 𝑓(𝑧) is analytic and 𝑓(0) = 1. Find the residue at
∫0 𝑓(𝑤) 𝑑𝑤
𝑧 = 0.', '_recupere_le' => '2026-11-04T19:55:22.402677+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Let 𝑓5 (𝑧) =        𝑧             , where 𝑓(𝑧) is analytic and 𝑓(0) = 1. Find the residue at 𝑧 = 0.
∫0 𝑓(𝑤) 𝑑𝑤
𝑧
Let 𝑔(𝑧) = ∫ 𝑓(𝑤) 𝑑𝑤. So 𝑔 is analytic and 𝑔(0) = 0 and 𝑔′ (0')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Write the principal part of each function at the isolated singularity. Compute the corre-
sponding residue.
𝑓2 (𝑧) =
𝑧3', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The only singularity is at 𝑧 = 0. We know
𝑧2 𝑧4
cosh(𝑧) = 1 +        +    +…
2   4!
So,
−𝑧2 /2 − 𝑧 4 /4! − …   1  𝑧
𝑓2 (𝑧) =                        =− − −…
𝑧3             2𝑧 4!
1
Thus, we have Res(𝑓2 , 0) = − .
2
18.04 Problem Set 6, Spring 2018 Solutions                                                   4

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Write the principal part of each function at the isolated singularity. Compute the corre-
sponding residue.
𝑓2 (𝑧) =
𝑧3]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Write the principal part of each function at the isolated singularity. Compute the corre-
sponding residue.
𝑓2 (𝑧) =
𝑧3', '_recupere_le' => '2026-11-04T19:55:22.402748+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The only singularity is at 𝑧 = 0. We know
𝑧2 𝑧4
cosh(𝑧) = 1 +        +    +…
2   4!
So,
−𝑧2 /2 − 𝑧 4 /4! − …   1  𝑧
𝑓2 (𝑧) =                        =− − −…
𝑧3             2𝑧')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Does the principal branch of 𝑧 have a Laurent expansion in the domain 0 < |𝑧|?
√', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : No, 𝑧 is not analytic on the region 0 < |𝑧|. In fact, it is not analytic on any
annulus centered at 0.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Does the principal branch of 𝑧 have a Laurent expansion in the domain 0 < |𝑧|?
√]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Does the principal branch of 𝑧 have a Laurent expansion in the domain 0 < |𝑧|?
√', '_recupere_le' => '2026-11-04T19:55:22.402802+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : No, 𝑧 is not analytic on the region 0 < |𝑧|. In fact, it is not analytic on any
annulus centered at 0.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglai')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
e𝑖𝑧
Evaluate ∫         e1/𝑧 sin(1/𝑧) 𝑑𝑧.
|𝑧|=1', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The integrand 𝑓(𝑧) = e1/𝑧 sin(1/𝑧) has a pole at 𝑧 = 0 and no other singularities.
To compute the residue we multiply series
1   1         1  1          1  1
𝑓(𝑧) = (1 +        +   2
+ …) ( −    3
+ …) = + 2 + …
𝑧 2!𝑧         𝑧 3!𝑧         𝑧 𝑧
Thus, Res(𝑓, 0) = 1 and ∫             𝑓(𝑧) 𝑑𝑧 = 2𝜋𝑖.
|𝑧|=1

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
e𝑖𝑧
Evaluate ∫         e1/𝑧 sin(1/𝑧) 𝑑𝑧.
|𝑧|=1]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
e𝑖𝑧
Evaluate ∫         e1/𝑧 sin(1/𝑧) 𝑑𝑧.
|𝑧|=1', '_recupere_le' => '2026-11-04T19:55:22.402858+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The integrand 𝑓(𝑧) = e1/𝑧 sin(1/𝑧) has a pole at 𝑧 = 0 and no other singularities.
To compute the residue we multiply series
1   1         1  1          1  1
𝑓(𝑧) = (1 +')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
∞
1
In this problem we will compute ∑         using the residue theorem. The techniques learned
−∞
𝑛2
here are general. In particular, the use of cot(𝜋𝑧) is fairly common.
cos(𝜋𝑧)
Solve this equation to get a closed-form expression for 𝑓(𝑧).', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The differential equation is separable: 𝑓 ′ /𝑓 = 2/(1 + 𝑧). Solving we get 𝑓(𝑧) =
𝐶(𝑧 + 1)2 . The inital condition 𝑓(0) = 1 determines 𝐶 = 1. So, 𝑓(𝑧) = (𝑧 + 1)2 .

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
∞
1
In this problem we will compute ∑         using the residue theorem. The techniques learned
−∞
𝑛2
here are general. In particular, the use of cot(𝜋𝑧) is fairly common.
cos(𝜋𝑧)
Solve this equation to get a closed-form expression for 𝑓(𝑧).]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
∞
1
In this problem we will compute ∑         using the residue theorem. The techniques learned
−∞
𝑛2
here are general. In particular, the use of cot(𝜋𝑧) is fairly common.
cos(𝜋𝑧)
Solve this equation to get a closed-form expression for 𝑓(𝑧).', '_recupere_le' => '2026-11-04T19:55:22.402972+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The differential equation is separable: 𝑓 ′ /𝑓 = 2/(1 + 𝑧). Solving we get 𝑓(𝑧) =
𝐶(𝑧 + 1)2 . The inital condition 𝑓(0) = 1 determines 𝐶 = 1. So, 𝑓(𝑧) = (𝑧 + 1)2 .

[Correcti')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
∞
1
In this problem we will compute ∑         using the residue theorem. The techniques learned
−∞
𝑛2
here are general. In particular, the use of cot(𝜋𝑧) is fairly common.
cos(𝜋𝑧)
Check your', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The answers to parts (a) and (b) are clearly the same.
Problem Fun 3. (No points) Show that | cot(𝜋𝑧)| < 2 along the contour in problem 10.
Hint, show that along the vertical sides | cot(𝜋𝑧)| < 1, while along the horizontal sides
| cot(𝜋𝑧)| < 2.
Solution: We know
cos(𝜋𝑧)    e𝑖𝜋𝑧 + e−𝑖𝜋𝑧   𝑖(e2𝜋𝑖𝑧 + 1)
cot(𝜋𝑧) =           = 𝑖 𝑖𝜋𝑧         =              .
sin(𝜋𝑧)    e − e−𝑖𝜋𝑧       e2𝑖𝜋𝑖𝑧 − 1
18.04 Problem Set 6, Spring 2018 Solutions                                                 11
The right side of 𝐶𝑁 is along the line (𝑁 + 1/2) + 𝑖𝑦. On this line
e𝑖(2𝑁+1)𝜋 e−2𝜋𝑦 + 1      −e−2𝜋𝑦 + 1
| cot(𝜋𝑧)| = ∣ 𝑖(2𝑁+1)𝜋 −2𝜋𝑦      ∣ = ∣ −2𝜋𝑦      ∣.
e         e     −1       −e     −1
Since e−2𝜋𝑦 > 0, the denominator is clearly larger in magnitude than the numerator. So
|𝑐𝑜𝑡(𝜋𝑧)| < 1 along the right side of 𝐶𝑁 .
Since the left side of 𝐶𝑁 is minus the right side and cot is an odd function, the result holds
along the left side as well.
The top side of 𝐶𝑁 is along the line 𝑥 + 𝑖(𝑁 + 1/2). So along this line
e2𝜋𝑖𝑥 e−(2𝑁+1)𝜋 + 1    1 + e−(2𝑁+1)𝜋
| cot(𝜋𝑧)| = ∣ 2𝜋𝑖𝑥 −(2𝑁+1)𝜋      ∣≤
e     e         −1     1 − e−(2𝑁+1)𝜋
1+𝑎
This is of the form     , with 0 < 𝑎 ≤ e−𝜋 . Since (1 + 𝑎)/(1 − 𝑎) is an increasing function,
1 − 𝑎 −𝜋
the maximum is at 𝑎 = e and this is clearly less than 2 (in fact, less than 1.1).
Again, by symmetry the result holds on the bottom also.
We have shown that, along 𝐶𝑁 , | cot(𝜋𝑧)| < 2.
∞
Problem Fun 4. (No points) Suppose the radius of convergence of ∑ 𝑎𝑛 𝑧𝑛 is 𝑅.           Show
𝑛=0
∞
that the radius of convergence of ∑ 𝑛2 𝑎𝑛 𝑧𝑛 is also 𝑅.
𝑛=0
Solution: Idea: if the we can use ratio test then the factor of 𝑛2 does not change the limit
of the ratio test. That is,
(𝑛 + 1)2 |𝑎𝑛+1 𝑧𝑛+1 |       (𝑛 + 1)2    |𝑎 𝑧|     |𝑎 𝑧|
𝐿 = lim        2     𝑛
= lim     2
lim 𝑛+1 = lim 𝑛+1 .
𝑚→∞      𝑛 |𝑎𝑛 𝑧 |                 𝑛          |𝑎𝑛 |     |𝑎𝑛 |
Since we get the same limit with or without the factor of 𝑛2 , the radius of convergence is
the same in both cases.
The problem is that the limit might not exist. We offer two more technical proofs.
Proof 1. Let 𝑓(𝑧) = ∑ 𝑎𝑛 𝑧𝑛 . We know that 𝑓(𝑧) is anlaytic inside the radius of conver-
𝑛=0
gence 𝑅. By Taylor’s theorem we also know that
∞
𝑓 ′ (𝑧) = ∑ 𝑛𝑎𝑛 𝑧𝑛−1
𝑛=0
∞
has the same radius of convergence. Thus 𝑔(𝑧) = 𝑧𝑓 (𝑧) = ∑ 𝑛𝑎𝑛 𝑧𝑛 also has radius of
′
𝑛=0
∞
convergence 𝑅. Continuing in the same way, 𝑧𝑔 (𝑧) = ∑ 𝑛 𝑎𝑛 𝑧𝑛 has radius of convergence
′           2
𝑛=0
𝑅.
18.04 Problem Set 6, Spring 2018 Solutions                                            12
Proof 2. Pick 𝑧 with |𝑧| = 𝑟 < 𝑅. Then pick 𝑟1 with 𝑟 < 𝑟1 < 𝑅. Since the original series
has radius of convergence 𝑅, ∑ |𝑎𝑛 |𝑟1𝑛 converges. Now, since 𝑟1 /𝑟 > 1, we know
𝑛2 𝑟𝑛          𝑛2
lim      = lim          = 0.
𝑛→∞ 𝑟𝑛         (𝑟1 /𝑟)𝑛
1
Thus ∑ |𝑛2 𝑎𝑛 𝑧𝑛 | = ∑ 𝑛2 |𝑎𝑛 |𝑟𝑛 converges by asymptotic comparison with ∑ |𝑎𝑛 |𝑟1𝑛 .
QED
18.04 Complex Variables with Applications
Spring 2018
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'choices' => array('Pas to part(b) against the taylor series obtained by expanding out the
closed-form expression for the solution found in part (a).', 'Impossible à déterminer', 'to part(b) against the Taylor series obtained by expanding out the
closed-form expression for the solution found in part (a).', 'L\'inverse de to part(b) against the taylor series obtained by expanding out the
closed-form expression for the solution found in part (a).'), 'correct' => 2, 'answer' => 'to part(b) against the Taylor series obtained by expanding out the
closed-form expression for the solution found in part (a).', '_recupere_le' => '2026-11-04T19:55:22.403119+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
2𝜋
8 𝑑𝜃
Compute ∫                 .
0    5 + 2 cos(𝜃)', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Call the integral to compute 𝐼. We let 𝑧 = e𝑖𝜃 and convert the integral to a line
integral over the unit circle. As usual, we have
𝑑𝑧                             𝑧 + 1/𝑧   𝑧2 + 1
𝑑𝜃 =             and       cos(𝜃) =               =
𝑖𝑧                                2        2𝑧
So
8   𝑑𝑧                  8
𝐼 =∫                               =∫  ⋅                   𝑑𝑧
|𝑧|=1         5 + 2(𝑧 2 + 1)/2𝑧
𝑖𝑧              2
|𝑧|=1 𝑖(𝑧 + 5𝑧 + 1)
√
8                                −5 ± 21                             √
Let 𝑓(𝑧) =      2
. The poles of 𝑓 are at             . Of these only 𝑧1 = (−5+ 21)/2
𝑖(𝑧 + 5𝑧 + 1)                               2
is inside |𝑧| = 1. So, by the residue theorem
(𝑧 − 𝑧1 )8       16𝜋                 16𝜋
𝐼 = 2𝜋𝑖 Res(𝑓, 𝑧1 ) = 2𝜋𝑖 lim                             =         =             √ .
𝑧→𝑧1 𝑖(𝑧 2 + 5𝑧 + 1)   2𝑧1 + 5                21
As often, the limit was computed using L’Hospital’s rule. The fact that the limit exists
implies the pole was simple and the limit is its residue.
2𝜋
𝑑𝜃

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
2𝜋
8 𝑑𝜃
Compute ∫                 .
0    5 + 2 cos(𝜃)]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
2𝜋
8 𝑑𝜃
Compute ∫                 .
0    5 + 2 cos(𝜃)', '_recupere_le' => '2026-11-04T19:55:22.403174+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Call the integral to compute 𝐼. We let 𝑧 = e𝑖𝜃 and convert the integral to a line
integral over the unit circle. As usual, we have
𝑑𝑧                             𝑧 + 1/𝑧   𝑧2')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
2𝜋
8 𝑑𝜃
Compute ∫                          𝑑𝜃, 𝑎 > |𝑏| > 0.         (', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : As usual, call the integral in question 𝐼. The conversion of this integral to one
over the unit circle is similar to the previous parts. On the unit circle 𝑧 = e𝑖𝜃 , so:
2
𝑧 − 1/𝑧     (𝑧2 − 1)2
sin2 (𝜃) = (           ) =           .
2𝑖         −4𝑧 2
After a little algebra we have 𝐼 = ∫               𝑓(𝑧) 𝑑𝑧, where
|𝑧|=1
sin2 (𝜃)     1         (𝑧 2 − 1)2                 (𝑧 2 − 1)2
𝑓(𝑧) =               ⋅   =                        =                           .
𝑎 + 𝑏 cos(𝜃) 𝑖𝑧    −2𝑖𝑧2 (𝑏𝑧 2 + 2𝑎𝑧 + 𝑏)   −2𝑖𝑏𝑧 2 (𝑧 2 + 2𝑎𝑧/𝑏 + 1)
√                           √
−𝑎 + 𝑎2 − 𝑏2              −𝑎 − 𝑎2 − 𝑏2
The poles of 𝑓(𝑧) are at 0, 𝑧1 =                    and 𝑧2 =                   . Only 0 and 𝑧1
𝑏                          𝑏
are inside the curve |𝑧| = 1. So,
𝐼 = 2𝜋𝑖(Res(𝑓, 0) + Res(𝑓, 𝑧1 )).
All that’s left is to slog through computing the residues.
(𝑧 2 − 1)2
At 𝑧 = 0: Let 𝑔(𝑧) = 𝑧 2 𝑓(𝑧) =                      . So, Res(𝑓, 0) = 𝑔′ (0) = 𝑎/𝑖𝑏2 . (This
−2𝑖𝑏(𝑧 2 + 2𝑎𝑧/𝑏 + 1)
last value is not hard to compute.)
At 𝑧 = 𝑧1 : Since the pole is simple this is not too hard to do by brute force. Here’s a
somewhat more delicate way of doing the computation. Factoring the denominator using
the poles 𝑧1 and 𝑧2 , we have
(𝑧2 − 1)2
𝑓(𝑧) =                              .
−2𝑖𝑏𝑧 2 (𝑧 − 𝑧1 )(𝑧 − 𝑧2 )
(𝑧12 − 1)2                                                       √
So, Res(𝑓, 𝑧1 ) =        2
. It is easy to see that 𝑧1 𝑧2 = 1 and 𝑧1 − 𝑧2 = 2 𝑎2 − 𝑏2 /𝑏.
−2𝑖𝑏𝑧1 (𝑧1 − 𝑧2 )
So, multiplying top and bottom by 𝑧22 we get
√
𝑧22    (𝑧12 − 1)2             (𝑧2 𝑧12 − 𝑧2 )2        (𝑧1 − 𝑧2 )2    (𝑧1 − 𝑧2 )     𝑎2 − 𝑏2
Res(𝑓, 𝑧1 ) = 2 ⋅                   =                         =                =            =           .
𝑧2 −2𝑖𝑏𝑧12 (𝑧1 − 𝑧2 )     −2𝑖𝑏𝑧22 𝑧12 (𝑧1 − 𝑧2 )   −2𝑖𝑏(𝑧1 − 𝑧2 )     −2𝑖𝑏          𝑖𝑏2
Thus,                                         √                     √
𝑎           𝑎2 − 𝑏 2    2𝜋(𝑎 − 𝑎2 − 𝑏2 )
𝐼 = 2𝜋𝑖 ( 2 −                  )=
𝑖𝑏            𝑖𝑏2              𝑏2
as claimed.
18.04 Problem Set 7, Spring 2018 Solutions                                                    3', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'choices' => array('(𝑎 −   𝑎2 − 𝑏2 ).)
0        𝑎 + 𝑏 cos(𝜃)                                     𝑏2', 'L\'inverse de (𝑎 −   𝑎2 − 𝑏2 ).)
0        𝑎 + 𝑏 cos(𝜃)                                     𝑏2', 'Pas (𝑎 −   𝑎2 − 𝑏2 ).)
0        𝑎 + 𝑏 cos(𝜃)                                     𝑏2', 'Impossible à déterminer'), 'correct' => 0, 'answer' => '(𝑎 −   𝑎2 − 𝑏2 ).)
0        𝑎 + 𝑏 cos(𝜃)                                     𝑏2', '_recupere_le' => '2026-11-04T19:55:22.403292+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
∞
𝑑𝑥
Compute ∫         2      2
𝑑𝑥.       (', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝐼 be the integral in question. And let 𝑓(𝑧) =                    . We proceed
(𝑧 2 + 1)(𝑧 2 + 4)
exactly as in part (a). Using the contour shown below we find
𝐼 = 2𝜋𝑖 ∑ residues of 𝑓 in the upper half-plane.
Im(z)
CR
2i
i
Re(z)
−R     C1                  R
Contour for part (b).
The poles of 𝑓 are at ±𝑖 and ±2𝑖. Only 𝑖 and 2𝑖 are in the upper half-plane. All we need
18.04 Problem Set 7, Spring 2018 Solutions                                                      4
to do now is compute their residues.
(𝑧 − 𝑖)𝑧 2           𝑖2       −1
Res(𝑓, 𝑖) = lim(𝑧 − 𝑖)𝑓(𝑧) = lim   2        2
=     2
=
𝑧→𝑖              𝑧→𝑖 (𝑧 + 1)(𝑧 + 4)       2𝑖(𝑖 + 4)      6𝑖
2            2
(𝑧 − 2𝑖)𝑧            4𝑖         1
Res(𝑓, 2𝑖) = lim (𝑧 − 2𝑖)𝑓(𝑧) = lim 2                  =               = .
𝑧→2𝑖               𝑧→2𝑖 (𝑧 + 1)(𝑧 2 + 4)     4𝑖(4𝑖2 + 1)    3𝑖
In both cases we computed the limit using L’Hospital’s rule. Since the limit existed we
know the pole is simple and the limit is the residue. This gives
1  1  𝜋
𝐼 = 2𝜋𝑖 (−     + )= .
6𝑖 3𝑖 3
∞                √
1        2𝜋 3', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'choices' => array('𝜋/3.)
−∞ (𝑥 + 1)(𝑥 + 4)
𝑧2', 'Pas 𝜋/3.)
−∞ (𝑥 + 1)(𝑥 + 4)
𝑧2', 'L\'inverse de 𝜋/3.)
−∞ (𝑥 + 1)(𝑥 + 4)
𝑧2', 'Impossible à déterminer'), 'correct' => 0, 'answer' => '𝜋/3.)
−∞ (𝑥 + 1)(𝑥 + 4)
𝑧2', '_recupere_le' => '2026-11-04T19:55:22.403372+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
∞
cos(2𝑥)
Compute ∫     2
𝑑𝑥.
−∞ 𝑥 + 1', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝐼 be the integral in question. We start with complex replacement: Let
∞
e𝑖2𝑥
𝐼̃= ∫      2
𝑑𝑥.
−∞ 𝑥 + 1
So, 𝐼 = Re(𝐼)̃.
Consider the following contour
Im(z)
2Ri                  CR
i
C1
Re(z)
−R                                      R
𝑖2𝑧
Now, let 𝑓(𝑧) = 𝑧e2 +1 . Theorem 9.2 in the notes (we could also use Theorem 9.1 here)
implies that
lim ∫ 𝑓(𝑧) 𝑑𝑧 = 0.
𝑅→∞
𝐶𝑅
18.04 Problem Set 7, Spring 2018 Solutions                                                                6
The only pole of 𝑓 inside the contour is 𝑧 = 𝑖. So, as usual, we find
e−2
𝐼 ̃ = 2𝜋𝑖 Res(𝑓, 𝑖) = 2𝜋𝑖 ⋅          = e−2 𝜋.
2𝑖
Finally: 𝐼 = Re(𝐼)̃ = e−2 𝜋. .
∞
cos(2𝑥)

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
∞
cos(2𝑥)
Compute ∫     2
𝑑𝑥.
−∞ 𝑥 + 1]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
∞
cos(2𝑥)
Compute ∫     2
𝑑𝑥.
−∞ 𝑥 + 1', '_recupere_le' => '2026-11-04T19:55:22.403417+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Let 𝐼 be the integral in question. We start with complex replacement: Let
∞
e𝑖2𝑥
𝐼̃= ∫      2
𝑑𝑥.
−∞ 𝑥 + 1
So, 𝐼 = Re(𝐼)̃.
Consider the following contour
Im(z)
2Ri')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
∞
e3𝑖𝑥
Compute p.v. ∫         𝑑𝑥.
−∞ 𝑥 − 2𝑖', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : In this case, the integrand has no poles along the real axis. So, the principal value
only requires that we integrate over a symmetric interval [−𝑅, 𝑅] and let 𝑅 go to infinity.
e3𝑖𝑧
Let 𝑓(𝑧) =          . 𝑓 has one pole at 𝑧 = 2𝑖. The residue is easy to compute: Res(𝑓, 2𝑖) =
𝑧 − 2𝑖
e−6 .
Im(z)
2Ri                       CR
2i
C1
Re(z)
−R                                           R
18.04 Problem Set 7, Spring 2018 Solutions                                                                   7
The residue theorem implies
∫             𝑓(𝑧) 𝑑𝑧 = 2𝜋𝑖 Res(𝑓, 2𝑖) = 2𝜋𝑖e−6 .                            (1)
𝐶1 +𝐶𝑅
Looking at each piece:
lim ∫ 𝑓(𝑧) 𝑑𝑧 = 0 (Theorem 9.2 in the Topic 9 notes).
𝑅→0
𝐶𝑅
∞
e3𝑖𝑥
lim ∫ 𝑓(𝑧) 𝑑𝑧 = p.v. ∫               𝑑𝑥. (This is obvious).
−∞ 𝑥 − 2𝑖
𝑅→∞
𝐶1
Thus, letting 𝑅 → ∞ in Equation 1, we have
∞
e3𝑖𝑥
p.v. ∫           𝑑𝑥 = 2𝜋𝑖e−6 .
−∞ 𝑥 − 2𝑖
∞
cos(𝑥)        𝜋𝑖e𝑖𝑤                  if Im(𝑤) > 0

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
∞
e3𝑖𝑥
Compute p.v. ∫         𝑑𝑥.
−∞ 𝑥 − 2𝑖]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
∞
e3𝑖𝑥
Compute p.v. ∫         𝑑𝑥.
−∞ 𝑥 − 2𝑖', '_recupere_le' => '2026-11-04T19:55:22.403464+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : In this case, the integrand has no poles along the real axis. So, the principal value
only requires that we integrate over a symmetric interval [−𝑅, 𝑅] and let 𝑅 go to infini')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
∞
e𝑖𝑥
Derive the formula p.v. ∫                   𝑑𝑥 = 𝜋𝑖(e2𝑖 − e𝑖 ).
−∞ (𝑥 − 1)(𝑥 − 2)
e𝑖𝑧', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Call the principal value in question 𝐼. Let 𝑓(𝑧) =                                 . Consider the
(𝑧 − 1)(𝑧 − 2)
following contour
Im(z)
2Ri
CR
−C2                −C4
C1                       1          C3          2      C5
Re(z)
−R                                  1−r1       1+r1        2−r2       2+r2    R
First we’ll look at the integrals over each piece.
On 𝐶𝑅 : lim ∫ 𝑓(𝑧) 𝑑𝑧 = 0, by Theorem 9.2 in the Topic 9 notes.
𝑅→∞
𝐶𝑅
On 𝐶2 : lim ∫ 𝑓(𝑧) 𝑑𝑧 = 𝜋𝑖 Res(𝑓, 1) = −𝜋𝑖e𝑖 .              𝑓 has a simple pole at 𝑧 = 1. So, this
𝑟1 →0
𝐶2
followis using Topic 9 Theorem 9.13 on integrating over a semicircle around a simple pole.
On 𝐶4 : lim ∫ 𝑓(𝑧) 𝑑𝑧 = 𝜋𝑖 Res(𝑓, 2) = 𝜋𝑖e2𝑖 . The reasoning is the same as for 𝐶2 .
𝑟2 →0
𝐶4
∞
On 𝐶1 + 𝐶3 + 𝐶5 : Clearly lim ∫𝐶 +𝐶 +𝐶 𝑓(𝑧) 𝑑𝑧 = p.v. ∫−∞ 𝑓(𝑥) 𝑑𝑥. Here the limit is taken
1  3  5
as 𝑅 → ∞ and 𝑟1 , 𝑟2 → 0.
18.04 Problem Set 7, Spring 2018 Solutions                                                                   9
Since there are no poles of 𝑓(𝑧) inside the closed contour we have
∫                             𝑓(𝑧) 𝑑𝑧 = 0.
𝐶1 −𝐶2 +𝐶3 −𝐶4 +𝐶5 +𝐶𝑅
So, taking limits and doing a little algebra this becomes
∞
p.v. ∫          𝑓(𝑥) 𝑑𝑥 = 𝜋𝑖(e2𝑖 − e𝑖 ).              𝑄𝐸𝐷
−∞
∞
sin2 (𝑥)

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
∞
e𝑖𝑥
Derive the formula p.v. ∫                   𝑑𝑥 = 𝜋𝑖(e2𝑖 − e𝑖 ).
−∞ (𝑥 − 1)(𝑥 − 2)
e𝑖𝑧]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
∞
e𝑖𝑥
Derive the formula p.v. ∫                   𝑑𝑥 = 𝜋𝑖(e2𝑖 − e𝑖 ).
−∞ (𝑥 − 1)(𝑥 − 2)
e𝑖𝑧', '_recupere_le' => '2026-11-04T19:55:22.403536+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Call the principal value in question 𝐼. Let 𝑓(𝑧) =                                 . Consider the
(𝑧 − 1)(𝑧 − 2)
following contour
Im(z)
2Ri
CR
−C2                −C4
C1')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
(7 √
              points)
          ∞                       √
                𝑥
Compute ∫     2
                   𝑑𝑥. (', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : As always, call the integral 𝐼. We use the contour
Im(z)
CR
i
−Cr         C1
Re(z)
−C2
−i
Here the inner circle has radius 𝑟 and the outer circle has radius 𝑅.
√
𝑧
Let 𝑓(𝑧) = 2       . For 𝑓 we make a branch cut along the positive real axis and use the
𝑧 +1
branch with 0 < arg(𝑧) < 2𝜋.
Inside the contour 𝑓 has poles at ±𝑖. So,
∫                𝑓(𝑧) 𝑑𝑧 = 2𝜋𝑖(Res(𝑓, 𝑖) + Res(𝑓, −𝑖)).                          (3)
𝐶1 +𝐶𝑅 −𝐶2 −𝐶𝑟
We look at the pieces of the contour separately.
lim ∫ 𝑓(𝑧) 𝑑𝑧 = 0                                      (Usual reason using Theorem 9.1.)
𝑅→∞
𝐶𝑅
𝑟1/2
lim ∫ 𝑓(𝑧) 𝑑𝑧 = 0                                       (On 𝐶3 we have |𝑓(𝑧) =               is small for small 𝑟.)
𝑟→0
𝐶3                                                                          |1 + 𝑧 2 |
∞    √
𝑥                                                              √        √
lim        ∫ 𝑓(𝑧) 𝑑𝑧 = ∫   𝑑𝑥 = 𝐼                    (Since, on 𝐶1 , arg(𝑧) ≈ 0, so       𝑧≈       𝑥 and 𝑓(𝑧) ≈ 𝑓(𝑥).)
𝑅→∞, 𝑟→0
𝐶1        0   1 + 𝑥2
∞ √
𝑥                                                             √       √
lim ∫ 𝑓(𝑧) 𝑑𝑧 = − ∫           𝑑𝑥 = −𝐼                 (Since, on 𝐶2 , arg(𝑧) ≈ 2𝜋, so      𝑧 ≈ − 𝑥 and 𝑓(𝑧) ≈ −𝑓(𝑥).)
𝑅→∞, 𝑟→0
𝐶2          0   1 + 𝑥2
18.04 Problem Set 7, Spring 2018 Solutions                                                      11
Taking the limit in Equation 3, this gives
2𝐼 = 2𝜋𝑖(Res(𝑓, 𝑖) + Res(𝑓, −𝑖)).
√
𝑧
All that’s left is to compute the residues. Since 𝑓(𝑧) =                   , the residues are
(𝑧 + 𝑖)(𝑧 − 𝑖)
√             1/2
𝑖   (e𝑖𝜋/2 )       e𝑖𝜋/4     1+𝑖
Res(𝑓, 𝑖) =     =             =         = √
2𝑖        2𝑖          2𝑖       2 2𝑖
√          𝑖3𝜋/2 1/2
−𝑖    (e      )       e𝑖3𝜋/4    1−𝑖
Res(𝑓, −𝑖) =      =               =          = √
−2𝑖          −2𝑖           2𝑖     2 2𝑖
∞ √
1+𝑖      1−𝑖       2𝜋                                 𝑥           𝜋
So 2𝐼 = 2𝜋𝑖 ( √ + √ ) = √ . Finally, we have ∫                          2
𝑑𝑥 = √ . .
2 2𝑖 2 2𝑖           2                         0    1+𝑥             2', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'choices' => array('𝜋/ 2.)
        0   𝑥 +1', 'L\'inverse de 𝜋/ 2.)
        0   𝑥 +1', 'Pas 𝜋/ 2.)
        0   𝑥 +1', 'Impossible à déterminer'), 'correct' => 0, 'answer' => '𝜋/ 2.)
        0   𝑥 +1', '_recupere_le' => '2026-11-04T19:55:22.403726+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
1 for −1 < 𝑥 < 1
Let 𝑓(𝑥) = {
0 elsewhere.
∞
̂
Now use part (a) and symmetry to show that the Fourier transform 𝑓(𝜔) = ∫ 𝑓(𝑥)e−𝑖𝜔𝑥 𝑑𝑥 =
√ −𝜔2 /4                                                                    −∞
𝜋e     .
2', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Since, 𝑓(𝑥) = e−𝑥 is an even function we have
∞                                 ∞                                               ∞                                    ∞
∫     𝑓(𝑥)e−𝑖𝜔𝑥 𝑑𝑥 = ∫                  𝑓(𝑥)(e−𝑖𝜔𝑥 +e𝑖𝜔𝑥 ) 𝑑𝑥 = ∫                       𝑓(𝑥)2 cos(𝜔𝑥) 𝑑𝑥 = 2 Re (∫           𝑓(𝑥)e𝑖𝜔𝑥 𝑑𝑥)
−∞                              0                                               0                                    0
∞                                 ∞                                         √
2       𝜋
Part (a) implies ∫              𝑓(𝑥)e𝑖𝜔𝑥 𝑑𝑥 = ∫                   𝑓(𝑥)e2𝑖(𝜔/2)𝑥 𝑑𝑥 = e−𝜔 /4                + 𝑖𝐵. So, we have that
0                                 0                                             2
the Fourier transform
∞                                                 ∞
−𝑖𝜔𝑥                                                    2  √
∫       𝑓(𝑥)e                 𝑑𝑥 = 2 Re (∫                𝑓(𝑥)e𝑖𝜔𝑥 𝑑𝑥) = e−𝜔 /4 𝜋.            QED
−∞                                                0
Problem Fun.2. (No points)
2𝜋
2𝜋 ⋅ (2𝑛)!
Compute ∫ (cos 𝜃)2𝑛 𝑑𝜃. For 𝑛 = 1, 2, …. (Answer:                                                    .)
0                                                                              22𝑛 (𝑛!)2
Solution: Let
2𝑛
1 𝑧 + 1/𝑧                         (𝑧 2 + 1)2𝑛
𝑓(𝑧) =      (      )                   =               .
𝑖𝑧   2                            𝑖22𝑛 𝑧2𝑛+1
We know that
2𝜋
∫ (cos 𝜃)2𝑛 𝑑𝜃 = ∫                        𝑓(𝑧) 𝑑𝑧 = 2𝜋 Res(𝑓, 0).
0                                 |𝑧|=1
Expand (𝑧2 + 1)2𝑛 using the binomial theorem:
(2𝑛)! 2𝑛
(𝑧2 + 1)2𝑛 = … +                    𝑧 +…
𝑛!𝑛!
1     (2𝑛)!
From this it’s clear that Res(𝑓, 0) =   2𝑛
⋅       .
𝑖2       𝑛!𝑛!
2𝜋 ⋅ (2𝑛)!
Thus, the integral in question is 2𝑛        , as asserted.
2 𝑛!𝑛!
Problem Fun.3. (No points)
∞
𝑥2
Compute p.v. ∫    2     2
𝑑𝑥.
−∞ (𝑥 + 1)
∞
𝑥2
Is this the same as the integral ∫                      2     2
𝑑𝑥 without the principal value?
−∞ (𝑥 + 1)
𝑥2
Solution: The integrand 𝑓(𝑥) =              has no singularities on the 𝑥-axis and is asymp-
(𝑥2 + 1)2
totic to 1/𝑥2 , so the integral converges absolutely. This implies the integral is the same
with or without the principal value.
18.04 Problem Set 7, Spring 2018 Solutions                                                 15
Let 𝐼 be the integral in question. Since |𝑓(𝑧)| decays like 1/|𝑧|2 , we can use a semicircular
contour.
Im(z)
CR
i
Re(z)
−R      C1                     R
The residue theorem implies ∫           𝑓(𝑧) 𝑑𝑧 = 2𝜋𝑖 ∑ residues of 𝑓 inside the contour. We
𝐶1 +𝐶𝑅
examine each of the pieces in this equation.
lim ∫ 𝑓(𝑧) 𝑑𝑧 = 0.                    (Theorem 9.1 in the Topic 9 notes.)
𝑅→∞
𝐶𝑅
lim ∫ 𝑓(𝑧) 𝑑𝑧 = 𝐼.                    (This is clear.)
𝑅→∞
𝐶1
The only pole of 𝑓 inside the contour is at 𝑧 = 𝑖. This is a pole of order 2. Letting
𝑧2                                     𝑖
𝑔(𝑧) = (𝑧 − 𝑖)2 𝑓(𝑧) =         2
, we have Res(𝑓, 𝑖) = 𝑔′ (𝑖) = − ..
(𝑧 + 𝑖)                                   4
𝜋
Thus, 𝐼 =
2
18.04 Complex Variables with Applications
Spring 2018
For information about citing these materials or our Terms of Use, visit:

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
1 for −1 < 𝑥 < 1
Let 𝑓(𝑥) = {
0 elsewhere.
∞
̂
Now use part (a) and symmetry to show that the Fourier transform 𝑓(𝜔) = ∫ 𝑓(𝑥)e−𝑖𝜔𝑥 𝑑𝑥 =
√ −𝜔2 /4                                                                    −∞
𝜋e     .
2]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
1 for −1 < 𝑥 < 1
Let 𝑓(𝑥) = {
0 elsewhere.
∞
̂
Now use part (a) and symmetry to show that the Fourier transform 𝑓(𝜔) = ∫ 𝑓(𝑥)e−𝑖𝜔𝑥 𝑑𝑥 =
√ −𝜔2 /4                                                                    −∞
𝜋e     .
2', '_recupere_le' => '2026-11-04T19:55:22.403886+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Since, 𝑓(𝑥) = e−𝑥 is an even function we have
∞                                 ∞                                               ∞                                    ∞
∫     𝑓')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
A fixed point 𝑧 of a transformation 𝑇 is one where 𝑇 (𝑧) = 𝑧. Let 𝑇 be a fractional
linear transformation. Assume 𝑇 is not the identity map. Show 𝑇 has a most two fixed
points.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : A fixed point 𝑧 of a transformation 𝑇 is one where 𝑇 (𝑧) = 𝑧. Let 𝑇 be a fractional
linear transformation. Assume 𝑇 is not the identity map. Show 𝑇 has a most two fixed
18.04 Problem Set 8, Spring 2018 Solutions                                                    3
points.
𝑎𝑧 + 𝑏
Let 𝑇 (𝑧) =        . To find fixed points we solve the equation 𝑇 (𝑧) = 𝑧. A little algebra
𝑐𝑧 + 𝑑
puts the equation in the form
𝑎𝑧 + 𝑏
= 𝑧 ⇔ 𝑐𝑧 2 + (𝑑 − 𝑎)𝑧 − 𝑏 = 0.
𝑐𝑧 + 𝑑
There are a number of cases to consider. In all of them the number of fixed points is at
most two.
If 𝑐 ≠ 0 then the quadratic equation has at most two solutions. (It might have only one if
it has a repeated root.)
If 𝑐 = 0 then the equation is linear and there is at most one solution. (There may be none.)

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
A fixed point 𝑧 of a transformation 𝑇 is one where 𝑇 (𝑧) = 𝑧. Let 𝑇 be a fractional
linear transformation. Assume 𝑇 is not the identity map. Show 𝑇 has a most two fixed
points.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
A fixed point 𝑧 of a transformation 𝑇 is one where 𝑇 (𝑧) = 𝑧. Let 𝑇 be a fractional
linear transformation. Assume 𝑇 is not the identity map. Show 𝑇 has a most two fixed
points.', '_recupere_le' => '2026-11-04T19:55:22.403979+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : A fixed point 𝑧 of a transformation 𝑇 is one where 𝑇 (𝑧) = 𝑧. Let 𝑇 be a fractional
linear transformation. Assume 𝑇 is not the identity map. Show 𝑇 has a most two fixed
18.04')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Show that the mapping 𝑤 = 𝑧 + 1/𝑧 maps the circle |𝑧| = 𝑎 (𝑎 ≠ 1) to the ellipse
𝑢2               𝑣2
2
+               2
= 1.
(𝑎 + 1/𝑎)         (𝑎 − 1/𝑎)', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We’ll use the notation 𝑤 = 𝑢 + 𝑖𝑣. We’ll write points on the circle |𝑧| = 𝑎 as 𝑎e𝑖𝜃 .
So,
1          1
𝑤=𝑧+         = 𝑎e𝑖𝜃 + 𝑖𝜃
𝑧         𝑎e
cos(𝜃) − 𝑖 sin(𝜃)
= (𝑎 cos(𝜃) + 𝑖𝑎 sin(𝜃)) +
𝑎
1                   1
= (𝑎 + ) cos(𝜃) + 𝑖 (𝑎 − ) sin(𝜃).
𝑎                  𝑎
1                 1
This shows 𝑢 = (𝑎 + ) cos(𝜃) and (𝑎 − ) sin(𝜃). Now it is clear that
𝑎                 𝑎
𝑢2                   𝑣2
2
+               2
= cos2 (𝜃) + sin2 (𝜃) = 1.   QED
(𝑎 + 1/𝑎)           (𝑎 − 1/𝑎)

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Show that the mapping 𝑤 = 𝑧 + 1/𝑧 maps the circle |𝑧| = 𝑎 (𝑎 ≠ 1) to the ellipse
𝑢2               𝑣2
2
+               2
= 1.
(𝑎 + 1/𝑎)         (𝑎 − 1/𝑎)]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Show that the mapping 𝑤 = 𝑧 + 1/𝑧 maps the circle |𝑧| = 𝑎 (𝑎 ≠ 1) to the ellipse
𝑢2               𝑣2
2
+               2
= 1.
(𝑎 + 1/𝑎)         (𝑎 − 1/𝑎)', '_recupere_le' => '2026-11-04T19:55:22.404079+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : We’ll use the notation 𝑤 = 𝑢 + 𝑖𝑣. We’ll write points on the circle |𝑧| = 𝑎 as 𝑎e𝑖𝜃 .
So,
1          1
𝑤=𝑧+         = 𝑎e𝑖𝜃 + 𝑖𝜃
𝑧         𝑎e
cos(𝜃) − 𝑖 sin(𝜃)
= (𝑎 cos(𝜃) + 𝑖')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Start with a uniform flow and add a vortex at the point 2i. Give the complex potential
for this flow. From that compute the stream function and sketch some streamlines. You can
do this by hand or with a package like Matlab or Mathematica.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Here is the plot of some streamlines with a few velocity vectors added to show
the direction. The orange dot on the negative 𝑦-axis is the stagnation point.
Uniform flow with a vortex at 0. Here, 𝑈 = 1, 𝑄 = 1.
Uniform flow has complex potential Φ𝑈 (𝑧) = 𝑈 𝑧, where 𝑈 is the direction.
A vortex at 𝑧 = 2𝑖 has complex potential Φ𝑉 (𝑧) = 𝑖𝑄 log(𝑧 − 2𝑖), where 𝑄 is a measure of
the circulation strength.
To avoid a lot of complicated arithmetic, let’s set 𝑈 = 1. So, the combined flow has complex
potential Φ(𝑧) = 𝑧 + 𝑖𝑄 log(𝑧).
Let 𝑧 = 𝑥 + 𝑖𝑦 = 𝑟e𝑖𝜃 , then
Φ(𝑧) = (𝑥 + 𝑖𝑦) + 𝑖𝑄(log(|𝑧 − 2𝑖|) + 𝑖 arg(𝑧 − 2𝑖)) = (𝑥 − 𝑄 arg(𝑧 − 2𝑖)) + 𝑖(𝑦 + 𝑄 log(|𝑧 − 2𝑖|)).
So, the stream function is 𝜓 = Im(Φ) = 𝑦 + 𝑄 log(|𝑧 − 2𝑖|) .
To plot some velocity vectors we used the fact the Φ′ = 𝑢 − 𝑖𝑣, where (𝑢, 𝑣) is the velocity
vector field. In this case,
𝑖𝑄       𝑄(𝑦 − 2) + 𝑖𝑄𝑥
Φ′ (𝑧) = 1 +          =1+                .                           (1)
𝑧 − 2𝑖        |𝑧 − 2𝑖|2
𝑄(𝑦 − 2)         𝑄𝑥
So, (𝑢, 𝑣) = (1 +          ,−            ). Checking the velocity at 𝑧 = 1 + 2𝑖 we see the
|𝑧 − 2𝑖|2    (|𝑧 − 2𝑖|2
arrow points downward, so the circulation is clockwise around 𝑧 = 2𝑖.
Stagnation points are where Φ′ (𝑧) = 0. In this case this there is only one stagnation point
at 𝑧 = −𝑄𝑖 + 2𝑖. This shows that the stronger the circulation the farther out it pushes the
stagnation point.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Start with a uniform flow and add a vortex at the point 2i. Give the complex potential
for this flow. From that compute the stream function and sketch some streamlines. You can
do this by hand or with a package like Matlab or Mathematica.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Start with a uniform flow and add a vortex at the point 2i. Give the complex potential
for this flow. From that compute the stream function and sketch some streamlines. You can
do this by hand or with a package like Matlab or Mathematica.', '_recupere_le' => '2026-11-04T19:55:22.404182+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Here is the plot of some streamlines with a few velocity vectors added to show
the direction. The orange dot on the negative 𝑦-axis is the stagnation point.
Uniform flow with')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Explain why the flows in both parts (a) and (b) look like uniform flow far from the
origin.
18.04 Problem Set 9, Spring 2018', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : In general, the velocity field (𝑢, 𝑣) is related to Φ′ (𝑧) by Φ′ = 𝑢 − 𝑖𝑣.
In part (a) Φ′ (𝑧) = 1 + 𝑖𝑄/(𝑧 − 2𝑖). As 𝑧 goes to infinity Φ′ (𝑧) ≈ 1. This shows the vector
field is approximately uniform for large 𝑧.
Part (b) is the same: The expression in Equation 2 for Φ′ (𝑧) is approximately 1 for large
𝑧.', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'choices' => array('s                                                 3', 'L\'inverse de s                                                 3', 'Impossible à déterminer', 'Pas s                                                 3'), 'correct' => 0, 'answer' => 's                                                 3', '_recupere_le' => '2026-11-04T19:55:22.404294+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Consider 𝑓(𝑧) = 𝑧 5 − 2𝑧.
How many times does 𝑓 wind the circle |𝑧| = 1 around the origin?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The figure on the right above shows 𝑓 ∘ 𝛾 where 𝛾 is the unit circle. The style of
argument is identical to part (a).
Let 𝑓 = 𝑔 + ℎ, where 𝑔(𝑧) = −2𝑧 and ℎ = 𝑧 5 . On |𝑧| = 1, |ℎ| = 1 < 2 = |𝑔|. It is clear that
𝑔 has exactly one zero inside 𝛾. So, Rouchés theorem implies 𝑍𝑓,𝛾 = 𝑍𝑔,𝛾 = 1. That is, the
winding number is 1.
18.04 Problem Set 9, Spring 2018 Solutions                                                  4

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Consider 𝑓(𝑧) = 𝑧 5 − 2𝑧.
How many times does 𝑓 wind the circle |𝑧| = 1 around the origin?]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Consider 𝑓(𝑧) = 𝑧 5 − 2𝑧.
How many times does 𝑓 wind the circle |𝑧| = 1 around the origin?', '_recupere_le' => '2026-11-04T19:55:22.404361+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The figure on the right above shows 𝑓 ∘ 𝛾 where 𝛾 is the unit circle. The style of
argument is identical to part (a).
Let 𝑓 = 𝑔 + ℎ, where 𝑔(𝑧) = −2𝑧 and ℎ = 𝑧 5 . On |𝑧| = 1')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Show that 𝑓(𝑧) = 𝑧3 + 9𝑧 + 30 has no roots in the disk |𝑧| < 2.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Show that 𝑓(𝑧) = 𝑧 3 + 9𝑧 + 30 has no roots in the disk |𝑧| < 2.
We apply Rouchés theorem: let 𝑔(𝑧) = 9𝑧 + 30 and ℎ(𝑧) = 𝑧3 . Both 𝑔 and ℎ are analytic
and 𝑓 = 𝑔 + ℎ.
On the curve 𝐶 ∶ |𝑧| = 2 we have |𝑔| ≥ |12| and |ℎ| = 8, i.e. |ℎ| < |𝑔|. Since |ℎ| is strictly
less than |𝑔| on 𝐶, Rouchés theorem implies that 𝑔 and 𝑓 = 𝑔 + ℎ have the same number of
zeros inside 𝐶. Since 𝑔(𝑧) clearly has no zeros inside the circle, neither does 𝑓.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Show that 𝑓(𝑧) = 𝑧3 + 9𝑧 + 30 has no roots in the disk |𝑧| < 2.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Show that 𝑓(𝑧) = 𝑧3 + 9𝑧 + 30 has no roots in the disk |𝑧| < 2.', '_recupere_le' => '2026-11-04T19:55:22.404416+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Show that 𝑓(𝑧) = 𝑧 3 + 9𝑧 + 30 has no roots in the disk |𝑧| < 2.
We apply Rouchés theorem: let 𝑔(𝑧) = 9𝑧 + 30 and ℎ(𝑧) = 𝑧3 . Both 𝑔 and ℎ are analytic
and 𝑓 = 𝑔 + ℎ.
On the')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Suppose 𝑓(𝑧) is analytic on a region containing |𝑧| ≤ 1. Suppose also that |𝑓(𝑧)| < 1 on
|𝑧| = 1. Show that 𝑓(𝑧) − 𝑧 has exactly one zero in the disk |𝑧| < 1', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We know that 𝑔(𝑧) = −𝑧 has exactly one zero in the unit disk. Since |𝑓| < 1 = |𝑔|
on the unit circle, we can apply Rouchés theorem to show that
1 = 𝑍𝑔,|𝑧|=1 = 𝑍𝑓+𝑔,|𝑧|=1 = 𝑍𝑓−𝑧,|𝑧= 1    QED.

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Suppose 𝑓(𝑧) is analytic on a region containing |𝑧| ≤ 1. Suppose also that |𝑓(𝑧)| < 1 on
|𝑧| = 1. Show that 𝑓(𝑧) − 𝑧 has exactly one zero in the disk |𝑧| < 1]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Suppose 𝑓(𝑧) is analytic on a region containing |𝑧| ≤ 1. Suppose also that |𝑓(𝑧)| < 1 on
|𝑧| = 1. Show that 𝑓(𝑧) − 𝑧 has exactly one zero in the disk |𝑧| < 1', '_recupere_le' => '2026-11-04T19:55:22.404506+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : We know that 𝑔(𝑧) = −𝑧 has exactly one zero in the unit disk. Since |𝑓| < 1 = |𝑔|
on the unit circle, we can apply Rouchés theorem to show that
1 = 𝑍𝑔,|𝑧|=1 = 𝑍𝑓+𝑔,|𝑧|=1 = 𝑍𝑓')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
In this problem we will consider linear systems with negative feedback, where the feedback
gain is 𝑘. That is, if 𝐺(𝑠) is the open loop system function then the closed loop system
𝐺(𝑠)
function is 𝐺𝐶𝐿 (𝑠) =            .
1 + 𝑘𝐺(𝑠)
𝑠+1
For the system in part (a) draw the Nyquist plot, that is draw the curve 𝑘𝐺 ∘ 𝛾 where the
curve 𝛾 is the 𝑦-axis. You can use any tool you want to do this. One suggestion is to use the
following applet: https://web.mit.edu/jorloff/www/jmoapplets/nyquist/nyquistCrit.html.
(Use this version of the applet. I’ve modified the one we used in class to include feedback
gain.)
How many times does this curve wind around −1? Explain how this is consistent with your', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The plot below shows the winding number of 4𝐺 ∘ 𝛾 around −1 is 2. This is
consistent with part (a) because:
1. 𝐺(𝑠) has two poles in the right half-plane.
2. the Nyquist criterion for stability says that if 𝐺𝐶𝐿 is stable then the winding number of
the Nyquist plot around -1 equals the number of poles in the right half-plane.', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'choices' => array('Impossible à déterminer', 'L\'inverse de to part (a).', 'Pas to part (a).', 'to part (a).'), 'correct' => 3, 'answer' => 'to part (a).', '_recupere_le' => '2026-11-04T19:55:22.404820+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Let 𝑓(𝑧) = (𝑧 + 1/𝑧)/2. Use a package like Matlab or Mathematic to draw 𝑓 ∘ 𝛾 for the
following curves.
Make sure that the axes both have the same scale, so that circles plot as circles and not
ellipses. In Matlab the command axis equal after you plot will do this.
The circle |𝑧 + 1/2| = 3/2.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If 𝑣 = 𝑧 + 1/2 then |𝑣| = |𝑧 + 1/2| = 3/2. So, 𝑣 = e𝑖𝜃 , with 0 ≤ 𝜃 ≤ 2𝜋.
2
3 𝑖𝜃 1
Solving for 𝑧: 𝑧 = 𝑣 − 1/2 = e − . So 𝑎 = 3/2 and 𝑏 = −1/2
2       2

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Let 𝑓(𝑧) = (𝑧 + 1/𝑧)/2. Use a package like Matlab or Mathematic to draw 𝑓 ∘ 𝛾 for the
following curves.
Make sure that the axes both have the same scale, so that circles plot as circles and not
ellipses. In Matlab the command axis equal after you plot will do this.
The circle |𝑧 + 1/2| = 3/2.]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Let 𝑓(𝑧) = (𝑧 + 1/𝑧)/2. Use a package like Matlab or Mathematic to draw 𝑓 ∘ 𝛾 for the
following curves.
Make sure that the axes both have the same scale, so that circles plot as circles and not
ellipses. In Matlab the command axis equal after you plot will do this.
The circle |𝑧 + 1/2| = 3/2.', '_recupere_le' => '2026-11-04T19:55:22.404962+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : If 𝑣 = 𝑧 + 1/2 then |𝑣| = |𝑧 + 1/2| = 3/2. So, 𝑣 = e𝑖𝜃 , with 0 ≤ 𝜃 ≤ 2𝜋.
2
3 𝑖𝜃 1
Solving for 𝑧: 𝑧 = 𝑣 − 1/2 = e − . So 𝑎 = 3/2 and 𝑏 = −1/2
2       2

[Correction officiell')),
							array('question' => '[MIT 18.04 — question d’examen, en anglais]
Let 𝑓(𝑧) = (𝑧 + 1/𝑧)/2. Use a package like Matlab or Mathematic to draw 𝑓 ∘ 𝛾 for the
following curves.
Make sure that the axes both have the same scale, so that circles plot as circles and not
ellipses. In Matlab the command axis equal after you plot will do this.
The unit circle |𝑧| = 1.
18.04 Complex Variables with Applications
Spring 2018
For information about citing these materials or our Terms of Use, visit:', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Here 𝑎 = 1 and 𝑏 = 0. The result is a line segment on the real axis between -1 and 1.
It’s easy to see why this happens: on the unit circle 𝑧 = e𝑖𝜃 , so
𝑧 + 1/𝑧   e𝑖𝜃 + e−𝑖𝜃
=            = cos(𝜃).
2           2
This is real and stays between -1 and 1.
18.04 Problem Set 9, Spring 2018 Solutions   8
18.04 Complex Variables with Applications
Spring 2018
For information about citing these materials or our Terms of Use, visit:

[Correction officielle MIT : [MIT 18.04 — question d’examen, en anglais]
Let 𝑓(𝑧) = (𝑧 + 1/𝑧)/2. Use a package like Matlab or Mathematic to draw 𝑓 ∘ 𝛾 for the
following curves.
Make sure that the axes both have the same scale, so that circles plot as circles and not
ellipses. In Matlab the command axis equal after you plot will do this.
The unit circle |𝑧| = 1.
18.04 Complex Variables with Applications
Spring 2018
For information about citing these materials or our Terms of Use, visit:]', 'source' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.04 Complex Variables With Applications, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 18.04 — question d’examen, en anglais]
Let 𝑓(𝑧) = (𝑧 + 1/𝑧)/2. Use a package like Matlab or Mathematic to draw 𝑓 ∘ 𝛾 for the
following curves.
Make sure that the axes both have the same scale, so that circles plot as circles and not
ellipses. In Matlab the command axis equal after you plot will do this.
The unit circle |𝑧| = 1.
18.04 Complex Variables with Applications
Spring 2018
For information about citing these materials or our Terms of Use, visit:', '_recupere_le' => '2026-11-04T19:55:22.405135+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Here 𝑎 = 1 and 𝑏 = 0. The result is a line segment on the real axis between -1 and 1.
It’s easy to see why this happens: on the unit circle 𝑧 = e𝑖𝜃 , so
𝑧 + 1/𝑧   e𝑖𝜃 + e−𝑖𝜃
')),
						),
					),
				),
			),
		);
	}
}
