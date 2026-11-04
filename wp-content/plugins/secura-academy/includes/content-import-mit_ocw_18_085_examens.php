<?php
/**
 * Questions importees — MIT OpenCourseWare — 18 085 computational science and engineering i summer 2020
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 18.085 Computational Science And Engineering I, Summer 2020 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_18_085_examens' ) ) {
	function seca_import_mit_ocw_18_085_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-18-085-examens', 'nom' => 'MIT OpenCourseWare — 18 085 computational science and engineering i summer 2020', 'url' => 'https://ocw.mit.edu/courses/18-085-computational-science-and-engineering-i-summer-2020/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.085 Computational Science And Engineering I, Summer 2020 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.085 — question d’examen, en anglais] 18.085/18.0851 Comp. Science. Engineering I                               Name: Summer 2020 Final Examination 8/10/2020 Time Limit: Unlimited This exam contains 8 pages (including this cover page) and 7 questions plus 1 bonus questions. Total of points is 63. You are allowed all your written notes for the course. There will be no use of electronic devices except for looking up speciﬁc MATLAB commands online Grade Table (for instructor use only) Question Points Score 1           4 2           4 3           5 4           5 5          10 6          25 7          10 Total:        63
(4 points) Which of the following are the appropriate Fourier basis functions over the
interval (−L, L)? Here n is an integer. Select all that applies
A. sin(nx/L), cos(nx/L)
B. sin(nπx/L), cos(nπx/L)
C. e±inx/L
D. e±inπx/L', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (4 points) Which of the following are the appropriate Fourier basis functions over the
interval (−L, L)? Here n is an integer. Select all that applies
A. sin(nx/L), cos(nx/L). INCORRECT
B. sin(nπx/L), cos(nπx/L). CORRECT
C. e±inx/L . INCORRECT
D. e±inπx/L . CORRECT', 'source' => 'MIT OpenCourseWare, 18.085 Computational Science And Engineering I, Summer 2020 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.085 — question d’examen, en anglais] 18.085/18.0851 Comp. Science. Engineering I                               Name: Summer 2020 Final Examination 8/10/2020 Time Limit: Unlimited This exam contains 8 pages (including this cover page) and 7 questions plus 1 bonus questions. Total of points is 63. You are allowed all your written notes for the course. There will be no use of electronic devices except for looking up speciﬁc MATLAB commands online Grade Table (for instructor use only) Question Points Score 1           4 2           4 3           5 4           5 5          10 6          25 7          10 Total:        63
(5 points) Circle all true statements
A. The solution to the heat equation in R can be discontinuous, depending on
the initial condition.
B. The non-smoothness of the boundary condition of the Laplace’s equation can
chip away the convergence rate of the ﬁnite diﬀerence approximation
C. In an under-damped system, the damping eﬀect is dominated by the inertia
and/or the stiﬀness of the spring
D. There should not be any terms involving rm for m > 0 in the solution to the
interior domain of the Laplace’s equation. Here r is the radial coordinate in
the polar system.
E. The ﬁnite element method via mesh generation is less ﬂexible in adapting a
complex geometry of the domain compared with the ﬁnite diﬀerence method.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (5 points) Circle all true statements
A. The solution to the heat equation in R can be discontinuous, depending on
the initial condition. INCORRECT
B. The non-smoothness of the boundary condition of the Laplace’s equation can
chip away the convergence rate of the ﬁnite diﬀerence approximation. COR-
RECT
C. In an under-damped system, the damping eﬀect is dominated by the inertia
and/or the stiﬀness of the spring. CORRECT
D. There should not be any terms involving rm for m > 0 in the solution to the
interior domain of the Laplace’s equation. Here r is the radial coordinate in
the polar system. INCORRECT
E. The ﬁnite element method via mesh generation is less ﬂexible in adapting a
complex geometry of the domain compared with the ﬁnite diﬀerence method.
INCORRECT', 'source' => 'MIT OpenCourseWare, 18.085 Computational Science And Engineering I, Summer 2020 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.085 — question d’examen, en anglais] 18.085/18.0851 Comp. Science. Engineering I                               Name: Summer 2020 Final Examination 8/10/2020 Time Limit: Unlimited This exam contains 8 pages (including this cover page) and 7 questions plus 1 bonus questions. Total of points is 63. You are allowed all your written notes for the course. There will be no use of electronic devices except for looking up speciﬁc MATLAB commands online Grade Table (for instructor use only) Question Points Score 1           4 2           4 3           5 4           5 5          10 6          25 7          10 Total:        63
(10 points) Solve the following diﬀerential equation using Laplace transform
⎧ 2
d u    du
⎨ dt2 − dt = 0
⎪
u(0) = 0                                     (2)
⎪
u0 (0) = 1
⎩
18.085/18.0851               Final Examination - Page 4 of 8                     8/10/2020', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (10 points) Solve the following diﬀerential equation for t > 0 using Laplace transform
⎧ 2
d u    du
⎨ dt2 − dt = 0
⎪
u(0) = 0                                     (2)
⎪
u0 (0) = 1
⎩
Solution:
R∞
We deﬁne U (s) to be the Laplace transform: U (s) = 0 u(t)e−st dt. We can then apply
the Laplace transform on both sides of the equation:
Z ∞ 2             Z ∞
d u −st          du −st
2
e dt −          e dt = 0                       (3)
0   dt            0  dt
Integration by parts on the ﬁrst term gives:
Z ∞ 2                          Z ∞
d u −st      du −st ∞         du
2
e   dt =    e  |t=0 −         (−s)e−st dt                 (4)
0   dt           dt               dt
Z ∞ 0
du −st
= −1 + s         e dt                              (5)
0   dt
Z ∞
−st ∞
= −1 + sue |t=0 + s  2
ue−st dt                (6)
0
= −1 + s2 U (s)                                     (7)
while integration by parts on the second term gives
Z ∞                          Z ∞
du −st        −st ∞
e dt = ue |t=0 + s       ue−st dt                      (8)
0  dt                       0
= sU (s)                                         (9)
18.085/18.0851             Final Examination - Page 4 of 11                   8/10/2020
Hence, the transformed equation looks like
−1 + s2 U (s) − sU (s) = 0                              (10)
1
U (s) =                              (11)
s(s − 1)
1      1
U (s) =       −                     (12)
s−1 s
To get u(t), we check the Laplace transform table for the inverse Laplace transform of
1/s and 1/(s − 1) and realize that u(t) = et − 1
18.085/18.0851              Final Examination - Page 5 of 11                     8/10/2020', 'source' => 'MIT OpenCourseWare, 18.085 Computational Science And Engineering I, Summer 2020 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.085 — question d’examen, en anglais] 18.085/18.0851 Comp. Science. Engineering I                               Name: Summer 2020 Final Examination 8/10/2020 Time Limit: Unlimited This exam contains 8 pages (including this cover page) and 7 questions plus 1 bonus questions. Total of points is 63. You are allowed all your written notes for the course. There will be no use of electronic devices except for looking up speciﬁc MATLAB commands online Grade Table (for instructor use only) Question Points Score 1           4 2           4 3           5 4           5 5          10 6          25 7          10 Total:        63
(10 points) Compute the Fourier transform of the following function (factor of 2π would
be forgiven)
(
0,    x<0
f (x) =                                              (5)
e−x , x ≥ 0
18.085/18.0851             Final Examination - Page 8 of 8                   8/10/2020
(Bonus) Please summarize your understandings of the research talks on Wednesday,
August 12th, 2020. A reasonable summary of each research talk will be worth 2 points,
and up to 8 points will be granted. This part is optional and is due by 11:59pm of
August 12, 2020.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (10 points) Compute the Fourier transform of the following function (factor of 2π would
be forgiven)
(
0,    x<0
f (x) =                                             (24)
e−x , x ≥ 0
We compute that
Z ∞
1
fˆ(k) = √        f (x)e−ikx dx                        (25)
2π −∞
Z ∞
1
=√         e−x e−ikx dx                         (26)
2π 0
1 e−(1+ik)x ∞
=√               |x=0                           (27)
2π −(1 + ik)
1    1
=√                                              (28)
2π 1 + ik
Alternative forms of the same answer will be accepted.
18.085/18.0851            Final Examination - Page 11 of 11                  8/10/2020
(Bonus) Please summarize your understandings of the research talks on Wednesday,
August 12th, 2020. A reasonable summary of each research talk will be worth 2 points,
and up to 8 points will be granted. This part is optional and is due by 11:59pm of
August 12, 2020.', 'source' => 'MIT OpenCourseWare, 18.085 Computational Science And Engineering I, Summer 2020 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.085 — question d’examen, en anglais] 18.085/18.0851 Comp. Science. Engineering I                               Name: Summer 2020 Final Examination 8/10/2020 Time Limit: Unlimited This exam contains 8 pages (including this cover page) and 7 questions plus 1 bonus questions. Total of points is 63. You are allowed all your written notes for the course. There will be no use of electronic devices except for looking up speciﬁc MATLAB commands online Grade Table (for instructor use only) Question Points Score 1           4 2           4 3           5 4           5 5          10 6          25 7          10 Total:        63
(4 points) Which of the following are suitable Ansatz to the damped harmonic oscillator,
d2 u     du
m         + ν    + cu = 0                            (1)
dt2      dt
where u describes the displacement from equilibrium a ball of mass m connected to a
spring with Hooke’s constant c and experiencing a friction with coeﬃcient ν. Circle all
that applies
18.085/18.0851                Final Examination - Page 2 of 8                        8/10/2020
A. u(t) = α cos(bt) + β sin(bt), with α, β, b ∈ R to be solved
B. u(t) = A exp(bt), with A, b ∈ C to be solved
C. u(t) = A exp(ibt2 ), with A, b ∈ C to be solved
D. u(t) = A exp(ibt), with A, b ∈ C to be solved', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (4 points) Which of the following are suitable Ansatz to the damped harmonic oscillator,
d2 u     du
m         + ν    + cu = 0                            (1)
dt2      dt
where u describes the displacement from equilibrium a ball of mass m connected to a
spring with Hooke’s constant c and experiencing a friction with coeﬃcient ν. Circle all
that applies
18.085/18.0851                Final Examination - Page 2 of 11                        8/10/2020
A. u(t) = α cos(bt) + β sin(bt), with α, β, b ∈ R to be solved. INCORRECT
B. u(t) = A exp(bt), with A, b ∈ C to be solved. CORRECT
C. u(t) = A exp(ibt2 ), with A, b ∈ C to be solved. INCORRECT
D. u(t) = A exp(ibt), with A, b ∈ C to be solved. CORRECT', 'source' => 'MIT OpenCourseWare, 18.085 Computational Science And Engineering I, Summer 2020 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.085 — question d’examen, en anglais] 18.085/18.0851 Comp. Science. Engineering I                               Name: Summer 2020 Final Examination 8/10/2020 Time Limit: Unlimited This exam contains 8 pages (including this cover page) and 7 questions plus 1 bonus questions. Total of points is 63. You are allowed all your written notes for the course. There will be no use of electronic devices except for looking up speciﬁc MATLAB commands online Grade Table (for instructor use only) Question Points Score 1           4 2           4 3           5 4           5 5          10 6          25 7          10 Total:        63
(5 points) Suppose I perform the FFT on a 128 data points, originally generated by the
signal sin(2π ∗ 3t), where t ∈ [0.5362, 3.5345]. Then when I plot k vs. the magnitudes of
discrete Fourier transform coeﬃcients, ûdk , for k = 0, ...127, for what values of k should
I anticipate the plot to peak? Circle all that applies
A. k = 0
B. k = 3
C. k = 124
D. k = 125
E. k = 127.
18.085/18.0851               Final Examination - Page 3 of 8                       8/10/2020', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (5 points) Suppose I perform the FFT on a 128 data points, originally generated by the
signal sin(2π ∗ 3t), where t ∈ [0.5362, 3.5345]. Then when I plot k vs. the magnitudes of
discrete Fourier transform coeﬃcients, ûdk , for k = 0, ...127, for what value(s) of k should
I anticipate the plot to peak? Circle all that applies
A. k = 0. INCORRECT
B. k = 3. CORRECT
C. k = 124. INCORRECT
D. k = 125. CORRECT
E. k = 127. INCORRECT
18.085/18.0851               Final Examination - Page 3 of 11                    8/10/2020', 'source' => 'MIT OpenCourseWare, 18.085 Computational Science And Engineering I, Summer 2020 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.085 — question d’examen, en anglais] 18.085/18.0851 Comp. Science. Engineering I                               Name: Summer 2020 Final Examination 8/10/2020 Time Limit: Unlimited This exam contains 8 pages (including this cover page) and 7 questions plus 1 bonus questions. Total of points is 63. You are allowed all your written notes for the course. There will be no use of electronic devices except for looking up speciﬁc MATLAB commands online Grade Table (for instructor use only) Question Points Score 1           4 2           4 3           5 4           5 5          10 6          25 7          10 Total:        63
(25 points) Suppose we have the Laplace’s equation Δu = 0 INSIDE a square deﬁned
by x = 0, x = 1, y = 0, and y = 1, subject to the following boundary condition
⎧
⎪u(x, 0) = 0
⎪
⎪
⎨u(x, 1) = 0
(3)
⎪
⎪
⎪  u(0, y) = 0
⎩
u(1, y) = sin (nπy)
where n is a ﬁxed integer.
a)(10 points) Solve the Laplace equation analytically.
Two hints:
• Hint 1: Recall the orthogonality of sin(lπx) for l = 1, 2, 3, .... By leveraging the
orthogonality, you should not have to do any Fourier integrals explicitly
• Hint 2: Be very careful with dummy and non-dummy indices. Here n is a non-
dummy index.
18.085/18.0851                  Final Examination - Page 5 of 8                         8/10/2020
b)(10 points) We set up the rectangular grid by dividing up the x−axis and y −axis into
N − by − N grids and run the ﬁnite diﬀerence scheme to obtain the numerical solution at
each inner node (xi , yj ), where i = 1, ..., N and j = 1, ..., N . Note that x0 = 0, xN +1 = 1,
y0 = 0 and yN +1 = 1. Let l be the linearized index (aka. global index in my notes) of
all inner nodes. Note that l = 1, 2, ..., N 2 .
Suppose the MATLAB function ”laplace1(N )” implements the second-order ﬁnite dif-
ference scheme on the N − by − N grid and spits out the numerical solution at each inner
node (l = 1, ..., N 2 ) . On the other hand, suppose the MATLAB function laplace2(N )”
implements the formula in part a) and spits out the analytic solution at the same inner
nodes.
Now we want to evaluate the order of convergence, measured by the L2 − error, as N
gets large. Below you can ﬁnd some incomplete code. You are welcome to look up
MATLAB commands online, but please do not open any codes on Stellar:
i) Fill up the missing line (denoted as ”......”)
ii) Describe the output of the code. Here is the instruction for your answer:
• Is the output a number, an array, a plot, or something else?
• If it is a number or array, explicitly write it out or describe what each entry is.
• If it is a plot, indicate key features of the plot ( x-axis, y-axis, slope (if it’s a line),
period (if it’s a sine function), etc).
———————————————
N max = 1 0 0 ;
e r r o r L 2 = zeros ( N max , 1 ) ;
for N=1:N max
u = l a p l a c e 1 (N ) ;
v = l a p l a c e 2 (N ) ;
error val = 0;
for n=1:Nˆ2
error val = . . . . . .
end
e r r o r v a l = sqrt ( 1/N ∗ e r r o r v a l ) ;
e r r o r L 2 (N) = e r r o r v a l ;
end
N array = 1 : 1 : N max ;
loglog ( N array , e r r o r L 2 )
18.085/18.0851                Final Examination - Page 6 of 8                         8/10/2020
c) (5 points) Suppose now we try to use the same machinery in part a) and the code in
part b) for the problem with the following boundary condition:
⎧
⎪
⎪ u(x, 0) = 1
⎪
⎨u(x, 1) = 1
(4)
⎪
⎪
⎪ u(0, y) = 1
⎩
u(1, y) = sin (nπy)
How and why would the output of the code in part b) change? Here’s the instruction
for your answer:
• If it is a number or array, explicitly write them out or describe how each entry
changes.
• If it is a plot, indicate how certain key features of the plot ( x-axis, y-axis, slope (if
it’s a line), period (if it’s a sine function), etc).
18.085/18.0851               Final Examination - Page 7 of 8                    8/10/2020', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (25 points) Suppose we have the Laplace’s equation Δu = 0 INSIDE a square deﬁned
by x = 0, x = 1, y = 0, and y = 1, subject to the following boundary condition
⎧
⎪u(x, 0) = 0
⎪
⎪
⎨u(x, 1) = 0
(13)
⎪
⎪
⎪  u(0, y) = 0
⎩
u(1, y) = sin (nπy)
where n is a ﬁxed integer.
a)(10 points) Solve the Laplace equation analytically.
Two hints:
• Hint 1: Recall the orthogonality of sin(lπx) for l = 1, 2, 3, .... By leveraging the
orthogonality, you should not have to do any Fourier integrals explicitly
• Hint 2: Be very careful with dummy and non-dummy indices. Here n is a non-
dummy index.
Solution:
We postulate based on the separation of variable argument that u = X(x)Y (y), so that
Δu = X 00 Y + Y 00 X = 0                         (14)
X 00 Y 00
+     =0                                           (15)
X     Y
We let Y 00 /Y = −λ2 due to its periodicity, which means that X 00 /X = λ2 . This gives
that
Y = A cos(λy) + B sin(λy)                            (16)
λx      −λx
X = Ce           + De                                 (17)
Now we shall work out the boundary conditions:
• u(x, y = 0) = 0 means that Y (y = 0) = 0, which implies that A = 0
• u(x, y = 1) = 0 means that Y (y = 1) = 0, which implies that λ = kπ, for
k = 1, 2, 3, ....
• u(x = 0, y) = 0 means that X(x = 0) = 0, which implies that C = D
Now we are left with
∞
X
u(x, y) =         Bk (ekπx − e−kπx ) sin(kπy)               (18)
k=1
18.085/18.0851               Final Examination - Page 6 of 11                        8/10/2020
where the constants C have been absorbed into Bk for each k = 1, 2, 3.... Finally, at
x = 1, u(x = 1, y) = sin(nπy), whence
∞
X
sin(nπy) =         Bk (ekπ − e−kπ ) sin(kπy)                   (19)
k=1
Performing the odd extension of sin(nπy), we observe that due to the orthognality of
sin(kπy) over (−1, 1), for k = 1, 2, 3, ..., the only nonzero Bk is for k = n, whence u(x, y)
can be written as
sin(nπy) = Bn (enπ − e−nπ ) sin(nπy)                         (20)
1
Bn = nπ                                                 (21)
e − e−nπ
Hence, the solution would look like
enπx − e−nπx
u(x, y) =                sin(nπy)                          (22)
enπ − e−nπ
18.085/18.0851                 Final Examination - Page 7 of 11                         8/10/2020
b)(10 points) We set up the rectangular grid by dividing up the x−axis and y −axis into
N − by − N grids and run the ﬁnite diﬀerence scheme to obtain the numerical solution at
each inner node (xi , yj ), where i = 1, ..., N and j = 1, ..., N . Note that x0 = 0, xN +1 = 1,
y0 = 0 and yN +1 = 1. Let l be the linearized index (aka. global index in my notes) of
all inner nodes. Note that l = 1, 2, ..., N 2 .
Suppose the MATLAB function ”laplace1(N )” implements the second-order ﬁnite dif-
ference scheme on the N − by − N grid and spits out the numerical solution at each inner
node (l = 1, ..., N 2 ) . On the other hand, suppose the MATLAB function laplace2(N )”
implements the formula in part a) and spits out the analytic solution at the same inner
nodes.
Now we want to evaluate the order of convergence, measured by the L2 − error, as N
gets large. Below you can ﬁnd some incomplete code. You are welcome to look up
MATLAB commands online, but please do not open any codes on Stellar:
i) Fill up the missing line (denoted as ”......”)
ii) Describe the output of the code. Here is the instruction for your answer:
• Is the output a number, an array, a plot, or something else?
• If it is a number or array, explicitly write it out or describe what each entry is.
• If it is a plot, indicate key features of the plot ( x-axis, y-axis, slope (if it’s a line),
period (if it’s a sine function), etc).
———————————————
N max = 1 0 0 ;
e r r o r L 2 = zeros ( N max , 1 ) ;
for N=1:N max
u = l a p l a c e 1 (N ) ;
v = l a p l a c e 2 (N ) ;
error val = 0;
for n=1:Nˆ2
error val = . . . . . .
end
e r r o r v a l = sqrt ( 1/N ∗ e r r o r v a l ) ;
e r r o r L 2 (N) = e r r o r v a l ;
end
N array = 1 : 1 : N max ;
loglog ( N array , e r r o r L 2 )
18.085/18.0851                  Final Examination - Page 8 of 11                8/10/2020
———————————————
Solution:
The missing line should be
e r r o r v a l = e r r o r v a l + ( u ( n)−v ( n ) ) ˆ 2
The output is supposed to be a plot with the N , the number of grid points, on the
x-axis, and the L2 error on the y-axis, both of which are plotted on log scales. The
plot should be a line of slope close to −2 because the second derivative ﬁnite diﬀerence
approximation is second order
18.085/18.0851                Final Examination - Page 9 of 11                        8/10/2020
c) (5 points) Suppose now we try to use the same machinery in part a) and the code in
part b) for the problem with the following boundary condition:
⎧
⎪
⎪ u(x, 0) = 1
⎪
⎨u(x, 1) = 1
(23)
⎪
⎪
⎪u(0, y) = 1
⎩
u(1, y) = sin (nπy)
How and why would the output of the code in part b) change? Here’s the instruction
for your answer:
• If it is a number or array, explicitly write them out or describe how each entry
changes.
• If it is a plot, indicate how certain key features of the plot ( x-axis, y-axis, slope (if
it’s a line), period (if it’s a sine function), etc).
Solution:
The plot will have a slope that is much more diﬀerent from −2. The absolute value of
the slope would be smaller than 2 and/or close to 1. This is due to the discontinuity in
the boundary data, which shakes the validity of the ﬁnite diﬀerence approximation.
18.085/18.0851              Final Examination - Page 10 of 11                   8/10/2020', 'source' => 'MIT OpenCourseWare, 18.085 Computational Science And Engineering I, Summer 2020 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
						),
					),
				),
			),
		);
	}
}
