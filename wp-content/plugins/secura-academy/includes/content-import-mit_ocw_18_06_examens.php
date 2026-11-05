<?php
/**
 * Questions importees — MIT OpenCourseWare — 18 06 linear algebra spring 2010
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_18_06_examens' ) ) {
	function seca_import_mit_ocw_18_06_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-18-06-examens', 'nom' => 'MIT OpenCourseWare — 18 06 linear algebra spring 2010', 'url' => 'https://ocw.mit.edu/courses/18-06-linear-algebra-spring-2010/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.06 — question d’examen, en anglais] Find the matrix P that projects every vector b in R3 onto the line in the direction of
a = (2, 1, 3).', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Find the matrix P that projects every vector b in R3 onto the line in the direction of
a = (2, 1, 3).
Solution The general formula for the orthogonal projection onto the column space of a
matrix A is
P = A(AT A)−1 AT .
Here,
⎡ ⎤                             ⎡      ⎤
2                                4 2 6
⎢ ⎥                           1 ⎢      ⎥
A = ⎢1⎥         so that       P=
⎢ ⎥                             ⎢      ⎥
⎢2 1 3⎥
⎣ ⎦                          14 ⎣      ⎦
3                                6 3 9
Remarks:
• Since we’re projecting onto a one-dimensional space, AT A is just a number and we
can write things like P = (AAT )/(AT A). This won’t work in general.
• You don’t have to know the formula to do this. The ith column of P is, pretty much
by deﬁnition, the projection of ei (e1 = (1, 0, 0), e2 = (0, 1, 0), e3 = (0, 0, 1)) onto the
line in the direction of a. And this is something you should know how to do without
a formula.
RUBRIC: There was some leniency for computational errors, but otherwise there weren’t
many opportunities for partial credit.

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] Find the matrix P that projects every vector b in R3 onto the line in the direction of
a = (2, 1, 3).]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] Find the matrix P that projects every vector b in R3 onto the line in the direction of
a = (2, 1, 3).', '_recupere_le' => '2026-11-04T19:55:22.556541+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Find the matrix P that projects every vector b in R3 onto the line in the direction of
a = (2, 1, 3).
Solution The general formula for the orthogonal projection onto the colu')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] What are all the eigenvectors of P and their corresponding eigenvalues? (You can use
the geometry of projections, not a messy calculation.) The diagonal entries of P add up
to            .', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : What are all the eigenvectors of P and their corresponding eigenvalues? (You can use
the geometry of projections, not a messy calculation.) The diagonal entries of P add up
to           .
Solution The diagonal entries of P add up to 1 = the sum of the eigenvalues
Since P is a projection, it’s only possible eigenvalues are λ = 0 (with multiplicity equal to
the dimension of the nullspace, here 2) and λ = 1 (with multiplicity equal to the dimension
of the column space, here 1). So, a complete list of eigenvectors and eigenvalues is:
• λ = 0 with multiplicity 2. The eigenvectors for λ = 0 are precisely the vectors in the
�         �T      �          �T
null space. That is, all linear combinations of 3 0 −2 and −1 2 0 .
• λ = 1 with multiplicity 1. The eigenvectors for λ = 1 are precisely the vectors in the
�        �T
column space. That is, all multiples of 2 1 3 .
RUBRIC: 2 points for the sum of eigenvalues, 4 points for a full list (with multiplicities)
of eigenvalues, and 4 points for a complete description of all eigenvectors. In light of the
emphasized “all,” you’d lose 1 point if you gave two eigenvectors for λ = 0 and didn’t say
that all (at least non-zero) linear combinations were also eigenvectors for λ = 0.

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] What are all the eigenvectors of P and their corresponding eigenvalues? (You can use
the geometry of projections, not a messy calculation.) The diagonal entries of P add up
to            .]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] What are all the eigenvectors of P and their corresponding eigenvalues? (You can use
the geometry of projections, not a messy calculation.) The diagonal entries of P add up
to            .', '_recupere_le' => '2026-11-04T19:55:22.556668+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : What are all the eigenvectors of P and their corresponding eigenvalues? (You can use
the geometry of projections, not a messy calculation.) The diagonal entries of P add up
t')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] (Separate question) If q1 and q2 are any orthonormal vectors in R5 , give a formula for the
projection p of any vector b onto the plane spanned by q1 and q2 (write p as a combination
of q1 and q2 ).', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : If q1 and q2 are any orthonormal vectors in R5 , give a formula for the projection p of any
vector b onto the plane spanned by q1 and q2 (write p as a combination of q1 and q2 ).
Solution p = (q1T b)q1 + (q2T b)q 2 .
RUBRIC: little partial credit. If you identiﬁed the diﬀerence between b and p instead, you
may have gotten some points.

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] (Separate question) If q1 and q2 are any orthonormal vectors in R5 , give a formula for the
projection p of any vector b onto the plane spanned by q1 and q2 (write p as a combination
of q1 and q2 ).]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] (Separate question) If q1 and q2 are any orthonormal vectors in R5 , give a formula for the
projection p of any vector b onto the plane spanned by q1 and q2 (write p as a combination
of q1 and q2 ).', '_recupere_le' => '2026-11-04T19:55:22.556765+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : If q1 and q2 are any orthonormal vectors in R5 , give a formula for the projection p of any
vector b onto the plane spanned by q1 and q2 (write p as a combination of q1 and q')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] For any invertible matrix A, the (1, 1) entry of A−1 is the ratio of                 .
So the (1, 1) entry of A− 1
4 is                        .', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : For any invertible matrix A, the (1, 1) entry of A−1 is the ratio of                      .
So the (1, 1) entry of A− 1
4 is                         .
Solution Cramer’s rule gives A−1 = |A|
1
C T where C is the cofactor matrix, whose (i, j) entry
is (−1)i+j |Mij | where Mij is the submatrix obtained by deleting row i and column j of the
(arbitrary) invertible matrix A. Thus the entry with i = j = 1 is |M11 |/|A|.
In the case where A = An , the submatrix M11 is An−1 ; so the desired formula is |An−1 |/|An |.
Now, |An | = 1 − n by part (a). So |A4 | = −3 and |A3 | = −2. Thus the (1, 1) entry of A−1
4
is 2/3.
RUBRIC: 5 points for the correct ratio, 5 points for the correct application to the current
problem. If the wrong ratio was given, then no credit was given for applying it.

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] For any invertible matrix A, the (1, 1) entry of A−1 is the ratio of                 .
So the (1, 1) entry of A− 1
4 is                        .]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] For any invertible matrix A, the (1, 1) entry of A−1 is the ratio of                 .
So the (1, 1) entry of A− 1
4 is                        .', '_recupere_le' => '2026-11-04T19:55:22.556851+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : For any invertible matrix A, the (1, 1) entry of A−1 is the ratio of                      .
So the (1, 1) entry of A− 1
4 is                         .
Solution Cramer’s rule')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] What is the third eigenvalue of A3 and a corresponding eigenvector?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : What is the third eigenvalue of A3 and a corresponding eigenvector?
Solution In solution 2 of part (a) above, we saw that the third eigenvalue is −2 and a
corresponding eigenvector is (1, 1, 1).
Another way to proceed is to notice that the trace of A3 is 0. However, the trace is the
sum of the eigenvalues, and two of them are 1. So the third must be −2. Alternatively, in
part (a), we saw that |A3 | = −2. However, the determinant is the product of the eigenvalues,
and two of them are 1. So the third must be −2.
A third way to proceed is to ﬁnd the characteristic polynomial of A3 , which is λ3 − 3λ + 2.
Since 1 is a double root, we can ﬁnd the third root by dividing twice by λ − 1.
RUBRIC: 5 points for the eigenvalue, 5 points for a corresponding eigenvector.

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] What is the third eigenvalue of A3 and a corresponding eigenvector?]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] What is the third eigenvalue of A3 and a corresponding eigenvector?', '_recupere_le' => '2026-11-04T19:55:22.556897+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : What is the third eigenvalue of A3 and a corresponding eigenvector?
Solution In solution 2 of part (a) above, we saw that the third eigenvalue is −2 and a
corresponding eigen')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] One eigenvector of H is u itself. Find the corresponding eigenvalue.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : One eigenvector of H is u itself. Find the corresponding eigenvalue.
Solution Since Hu = (I − 2uuT )u = u − 2uuT u = u − 2u = −u, λ = −1.

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] One eigenvector of H is u itself. Find the corresponding eigenvalue.]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] One eigenvector of H is u itself. Find the corresponding eigenvalue.', '_recupere_le' => '2026-11-04T19:55:22.556949+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : One eigenvector of H is u itself. Find the corresponding eigenvalue.
Solution Since Hu = (I − 2uuT )u = u − 2uuT u = u − 2u = −u, λ = −1.

[Correction officielle MIT : [MIT 1')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] Find the diagonal entries H11 and Hii in terms of u1 , . . . , un . Add up H11 + . . . + Hnn and
separately add up the eigenvalues of H.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Find the diagonal entries H11 and Hii in terms of u1 , . . . , un . Add up H11 + . . . + Hnn and
separately add up the eigenvalues of H.
Solution Since ith diagonal entry of uuT is u2i , the i diagonal entry of H is Hii = 1−2u2i
(3 points). Summing these together gives ni=1 Hii = n − 2 ni=1 u2i = n − 2 (3 points).
�                     �
�
Adding up the eigenvalues of H also gives     λi = (1) − 1 + (n − 1)(1) = n − 2 (4 points).

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] Find the diagonal entries H11 and Hii in terms of u1 , . . . , un . Add up H11 + . . . + Hnn and
separately add up the eigenvalues of H.]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] Find the diagonal entries H11 and Hii in terms of u1 , . . . , un . Add up H11 + . . . + Hnn and
separately add up the eigenvalues of H.', '_recupere_le' => '2026-11-04T19:55:22.557024+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Find the diagonal entries H11 and Hii in terms of u1 , . . . , un . Add up H11 + . . . + Hnn and
separately add up the eigenvalues of H.
Solution Since ith diagonal entry of')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] Suppose Q is any orthogonal n by n matrix. How do you know that Q A QT = Q A Q−1
is positive deﬁnite? Write down which test you are using.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Suppose Q is any orthogonal n by n matrix. How do you know that Q A QT = Q A Q−1
is positive deﬁnite? Write down which test you are using.
Solution Using the energy text (xT Ax > 0 for nonzero x), we ﬁnd that xT QAQT x =
(QT x)T A(QT x) > 0 for all nonzero x as well (since Q is invertible). Using the positive
eigenvalue test, since A is similar to QAQ−1 and similar matrices have the same
eigenvalues, QAQ−1 also has all positive eigenvalues. (5 points for test, 5 points for
application)

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] Suppose Q is any orthogonal n by n matrix. How do you know that Q A QT = Q A Q−1
is positive deﬁnite? Write down which test you are using.]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] Suppose Q is any orthogonal n by n matrix. How do you know that Q A QT = Q A Q−1
is positive deﬁnite? Write down which test you are using.', '_recupere_le' => '2026-11-04T19:55:22.557095+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Suppose Q is any orthogonal n by n matrix. How do you know that Q A QT = Q A Q−1
is positive deﬁnite? Write down which test you are using.
Solution Using the energy text (xT')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] Find its eigenvalues and eigenvectors.
⎡ ⎤
2
Write the vector u(0) = ⎣ ⎦ as a combination of those eigenvectors.
⎢ ⎥
0
du', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Find its eigenvalues and eigenvectors.
⎡    ⎤
⎢ 2 ⎥
Write the vector u(0) = ⎣ ⎦ as a combination of those eigenvectors.
0
Solution Since det(A − λI) = λ2 + 4, the eigenvalues are 2i, −2i (4 points). Two
associated eigenvectors are [1     − 2i]T , [1 2i]T , though there are many other choices
(4 points). u(0) is just the sum of these two vectors (2 points).
du

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] Find its eigenvalues and eigenvectors.
⎡ ⎤
2
Write the vector u(0) = ⎣ ⎦ as a combination of those eigenvectors.
⎢ ⎥
0
du]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] Find its eigenvalues and eigenvectors.
⎡ ⎤
2
Write the vector u(0) = ⎣ ⎦ as a combination of those eigenvectors.
⎢ ⎥
0
du', '_recupere_le' => '2026-11-04T19:55:22.557160+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Find its eigenvalues and eigenvectors.
⎡    ⎤
⎢ 2 ⎥
Write the vector u(0) = ⎣ ⎦ as a combination of those eigenvectors.
0
Solution Since det(A − λI) = λ2 + 4, the eigenvalues')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] Find the 3 matrices in the Singular Value Decomposition A = U Σ V T in two steps.
–First, compute V and Σ using the matrix AT A.
–Second, ﬁnd the (orthonormal) columns of U.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Find the 3 matrices in the Singular Value Decomposition A = U Σ V T in two steps.
–First, compute V and Σ using the matrix AT A.
–Second, ﬁnd the (orthonormal) columns of U.
Solution Note that AT A = V ΣT U T U ΣV T = V Σ2 V T , so the diagonal entries of Σ
are simply the positive roots of the eigenvalues of
⎡         ⎤⎡          ⎤ ⎡      ⎤
⎢ 0 4 ⎥ ⎢ 0 −1 ⎥ ⎢ 16 0 ⎥
AT A = ⎣          ⎦⎣          ⎦=⎣      ⎦
−1 0        4 0         0 1
i.e. σ1 = 4, σ2 = 1. Since AT A is already diagonal, V is the identity matrix. The
columns of U should satisfy Au1 = σ1 v1 , Au2 = σ2 v2 : by inspection, one obtains
⎡ ⎤          ⎡        ⎤      ⎡           ⎤
⎢ 0 ⎥        ⎢ −1 ⎥          ⎢ 0 −1 ⎥
u1 = ⎣ ⎦ , u2 = ⎣          ⎦,U = ⎣            ⎦
1             0               1 0

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] Find the 3 matrices in the Singular Value Decomposition A = U Σ V T in two steps.
–First, compute V and Σ using the matrix AT A.
–Second, ﬁnd the (orthonormal) columns of U.]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] Find the 3 matrices in the Singular Value Decomposition A = U Σ V T in two steps.
–First, compute V and Σ using the matrix AT A.
–Second, ﬁnd the (orthonormal) columns of U.', '_recupere_le' => '2026-11-04T19:55:22.557242+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Find the 3 matrices in the Singular Value Decomposition A = U Σ V T in two steps.
–First, compute V and Σ using the matrix AT A.
–Second, ﬁnd the (orthonormal) columns of U.
')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] (10 points) If the process of elimination subtracted 3 times row 1 from row 2 and
then 5 times row 1 from row 3, what matrix connects R and d to the original A and
b? Use this matrix to ﬁnd A and b.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The matrix connecting R and d to the original A and b is
⎡           ⎤ ⎡            ⎤     ⎡            ⎤
1 0 0          1 0 0             1 0 0
⎢           ⎥ ⎢            ⎥     ⎢            ⎥
E = E31 E21 = ⎢ 0 1 0 ⎥ · ⎢ −3 1 0 ⎥ = ⎢ −3 1 0 ⎥
⎢           ⎥ ⎢            ⎥     ⎢            ⎥
⎣           ⎦ ⎣            ⎦     ⎣            ⎦
−5 0 1           0 0 1           −5 0 1
That is, R = EA and Eb = d. Thus, A = E −1 R and b = E −1 d, giving
⎡           ⎤ ⎡                  ⎤       ⎡                 ⎤
1 0 0         1 −2 −5                    1   −2   −5
⎢       ⎥ ⎢                            ⎥   ⎢           ⎥
A=⎢ 3 1 0 ⎥·⎢ 0                            =   3 −6 −15 ⎥
⎢       ⎥ ⎢                            ⎥   ⎢           ⎥
0     0 ⎥   ⎢
⎣       ⎦ ⎣                            ⎦   ⎣           ⎦
5 0 1     0                  0     0       5 −10 −25
⎡             ⎤ ⎡    ⎤       ⎡       ⎤
1 0 0       4        4
⎢       ⎥ ⎢ ⎥       ⎢    ⎥
b = ⎢ 3 1 0 ⎥ · ⎢ 0 ⎥ = ⎢ 12 ⎥
⎢       ⎥ ⎢ ⎥       ⎢    ⎥
⎣       ⎦ ⎣ ⎦       ⎣    ⎦
5 0 1       0       20

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] (10 points) If the process of elimination subtracted 3 times row 1 from row 2 and
then 5 times row 1 from row 3, what matrix connects R and d to the original A and
b? Use this matrix to ﬁnd A and b.]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] (10 points) If the process of elimination subtracted 3 times row 1 from row 2 and
then 5 times row 1 from row 3, what matrix connects R and d to the original A and
b? Use this matrix to ﬁnd A and b.', '_recupere_le' => '2026-11-04T19:55:22.557331+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The matrix connecting R and d to the original A and b is
⎡           ⎤ ⎡            ⎤     ⎡            ⎤
1 0 0          1 0 0             1 0 0
⎢           ⎥ ⎢            ⎥')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] (10 points) Describe the column space of this particular matrix A. “All combinations
of the four columns” is not a suﬃcient', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : C(A) is a plane in R3 given by all combinations of the pivot columns, namely
⎡ ⎤         ⎡ ⎤
1           2
⎢ ⎥         ⎢ ⎥
c1 ⎢ 3 ⎥ + c2 ⎢ 8 ⎥
⎢ ⎥         ⎢ ⎥
⎣ ⎦         ⎣ ⎦
0           4', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('.', 'Impossible à déterminer', 'L\'inverse de .', 'Pas .'), 'correct' => 0, 'answer' => '.', '_recupere_le' => '2026-11-04T19:55:22.557420+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] What is the column space of A? Describe the nullspace of A.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The column space is a 3-dimensional space inside a 3-dimensional space , i.e.
it contains all the vectors, and the nullspace has dimension 5 − 3 = 2 > 0 inside R5 .

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] What is the column space of A? Describe the nullspace of A.]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] What is the column space of A? Describe the nullspace of A.', '_recupere_le' => '2026-11-04T19:55:22.557467+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The column space is a 3-dimensional space inside a 3-dimensional space , i.e.
it contains all the vectors, and the nullspace has dimension 5 − 3 = 2 > 0 inside R5 .

[Correct')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] (14 points) Is the vector b = � 28 ⎢ in the column space of A?
�    ⎢
�    ⎣', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (14 points) Is the vector b = ⎢ 28 ⎥ in the column space of A?
⎢     ⎥
⎣     ⎦
14
Solution: Yes . Reducing the matrix combining A and b gives
⎡          ⎤   ⎡         ⎤    ⎡          ⎤
2 1 8           2 1 8          2 1 8
⎢          ⎥   ⎢         ⎥    ⎢          ⎥
⎢ 6 5 28 ⎥ → ⎢ 0 2 4 ⎥ → ⎢ 0 2 4 ⎥
⎢          ⎥   ⎢         ⎥    ⎢          ⎥
⎣          ⎦   ⎣         ⎦    ⎣          ⎦
2 4 14          0 3 6          0 0 0
⎡ ⎤
3
Thus, x = ⎣ ⎦ is a solution to Ax = b, and b is in the column space of A.

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] (14 points) Is the vector b = � 28 ⎢ in the column space of A?
�    ⎢
�    ⎣]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] (14 points) Is the vector b = � 28 ⎢ in the column space of A?
�    ⎢
�    ⎣', '_recupere_le' => '2026-11-04T19:55:22.557520+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (14 points) Is the vector b = ⎢ 28 ⎥ in the column space of A?
⎢     ⎥
⎣     ⎦
14
Solution: Yes . Reducing the matrix combining A and b gives
⎡          ⎤   ⎡         ⎤    ⎡')),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.06 — question d’examen, en anglais] What are the column space and nullspace of P ? Describe them geometrically and also
give a basis for each space.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : What are the column space and nullspace of P ? Describe them geometrically and also
give a basis for each space.
Solution The column space is the line in R3 in the direction of a = (2, 1, 3). One basis for
it is
⎡ ⎤
2
⎢ ⎥
⎢ ⎥
⎢1⎥
⎣ ⎦
3
and there’s not really much choice in giving this basis (you can rescale by a non-zero con­
stant).
The nullspace is the plane in R3 that is perpendicular to a = (2, 1, 3) (i.e., 2x+y+z = 0.)
One basis for it is
⎡   ⎤ ⎡ ⎤
3  −1
⎢ ⎥ ⎢ ⎥
⎢ 0 ⎥,⎢ 2 ⎥
⎢ ⎥ ⎢ ⎥
⎣ ⎦ ⎣ ⎦
−2     0
though there are a lot of diﬀerent looking choices for it (any two vectors that are perpendic­
ular to a and not in the same line will work).
RUBRIC: 6 points for giving a correct basis, and 4 points for giving the complete geometric
description. Note that it is not correct to say e.g., N (P) = R2 . It is correct to say that N (P)
is a (2-dimensional) plane in R3 , but this is not a complete geometric description unless you
say (geometrically) which plane it is: the one perpendicular to a/to the line through a.

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] What are the column space and nullspace of P ? Describe them geometrically and also
give a basis for each space.]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] What are the column space and nullspace of P ? Describe them geometrically and also
give a basis for each space.', '_recupere_le' => '2026-11-04T19:55:22.557581+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : What are the column space and nullspace of P ? Describe them geometrically and also
give a basis for each space.
Solution The column space is the line in R3 in the direction')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] Suppose A = QR where Q has orthonormal columns and R is upper triangular invertible.
Find x
� and p in terms of Q and R and b (not A).', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Suppose A = QR where Q has orthonormal columns and R is upper triangular invertible.
Find x
� and p in terms of Q and R and b (not A).
Solution Since QT Q = I and R is invertible, we obtain
� = (AT A)−1 AT b = ((QR)T (QR))−1 (QR)T b
x
= (RT QT QR)−1 RT QT b = R−1 (RT )−1 RT QT b = R−1 QT b
� = QQT b
p = (QR)x
Note that QQT is not the identity matrix in general.
RUBIC: 6 points for ﬁnding x
�, 4 points for p. One point oﬀ from each if the equations are
not simpliﬁed, more points oﬀ for bad form, having variables other than Q, R and b, etc.

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] Suppose A = QR where Q has orthonormal columns and R is upper triangular invertible.
Find x
� and p in terms of Q and R and b (not A).]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] Suppose A = QR where Q has orthonormal columns and R is upper triangular invertible.
Find x
� and p in terms of Q and R and b (not A).', '_recupere_le' => '2026-11-04T19:55:22.557672+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Suppose A = QR where Q has orthonormal columns and R is upper triangular invertible.
Find x
� and p in terms of Q and R and b (not A).
Solution Since QT Q = I and R is invert')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] Find the determinant of An . Here is a suggested approach:
Start by adding all rows (except the last) to the last row, and then factoring out a
constant. (You could check n = 3 to have a start on part b.)', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Find the determinant of An . Here is a suggested approach:
Start by adding all rows (except the last) to the last row, and then factoring out a
constant. (You could check n = 3 to have a start on part b.)
Solution Following the hint, add all of the rows to the last row (which does not change the
determinant). Thus the matrix becomes
⎡                                                    ⎤
0        −1     −1               ···       −1
⎢                                                     ⎥
⎢ −1            0    −1               ···       −1 ⎥
⎢                                                     ⎥
⎢                                                     ⎥
⎢ −1          −1                      ···       −1 ⎥ .
⎢                                                     ⎥
0
⎢                                                     ⎥
⎢     ..        ..     ..                         .. ⎥
⎢
⎣      .         .      .                          . ⎥⎦
−(n − 1) −(n − 1) −(n − 1)           ···     −(n − 1)
Next, pull out the factor of −(n − 1) from the last row. As the determinant is linear in
each row separately, we get
�                                               �        �                          �
0        −1        −1       ···       −1           � 0 −1 −1 · · ·       −1�
�                                               �        �                          �
�                                               �
�                                               �        �                          �
� −1             0       −1       ···     −1 �           �−1  0 −1 · · ·       −1�
�                                               �        �                          �
�                                               �        �                          �
� −1           −1                 ···     −1 � = (1 − n) �−1 −1  0 ···         −1� .
�                                               �        �                          �
0
�                                               �        �                          �
�     ..         ..       ..                .. �         � .. .. ..             .. �
�
�      .          .        .                 . ��        � .
�     .  .              . ��
�                                               �        �                          �
�−(n − 1) −(n − 1) −(n − 1)       ···   −(n − 1)�        � 1  1  1 ···          1�
Next, add the last row back to each of the other rows (which again keeps the determinant
the same). So now we want to ﬁnd
�                    �
�1     0 0 · · · 0�
�                    �
�                    �
�0     1 0 · · · 0�
�                    �
�                    �
(1 − n) �0     0 1 · · · 0� .
�                    �
�                    �
� ..   .. ..     .. �
�.      . .       . ��
�
�                    �
�1     1 1 · · · 1�
This matrix is lower triangular. So its determinant is the product of the entries on its
diagonal. Thus the above quantity is (1 − n).
Alternately, one can ﬁnd the determinant of the matrix by ﬁnding all its eigenvalues.
As An = I − ones(n), we know that N (An − I) = N (− ones(n)). The latter nullspace
has dimension n − 1. Thus 1 is an eigenvalue of multiplicity n − 1, and the corresponding
eigenvectors are all the nonzero vectors whose entries add up to 0.
In addition, all of the rows of An add up to 1−n. So 1−n is an eigenvalue with eigenvector
(1, 1, . . . , 1). Thus we have found all of the eigenvectors and eigenvalues. The determinant
is the product of the eigenvalues, so it is 1n−1 · (1 − n) or 1 − n.
RUBRIC: 2 points for following the hint, 2 points for pulling out the factor of (1 − n)
correctly, 2 points for adding the last row to the other rows, 2 points for the correct answer.

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] Find the determinant of An . Here is a suggested approach:
Start by adding all rows (except the last) to the last row, and then factoring out a
constant. (You could check n = 3 to have a start on part b.)]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] Find the determinant of An . Here is a suggested approach:
Start by adding all rows (except the last) to the last row, and then factoring out a
constant. (You could check n = 3 to have a start on part b.)', '_recupere_le' => '2026-11-04T19:55:22.557770+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Find the determinant of An . Here is a suggested approach:
Start by adding all rows (except the last) to the last row, and then factoring out a
constant. (You could check n =')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] Find two orthogonal eigenvectors with A3 x = x. (So λ = 1 is a double eigenvalue.)', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Find two orthogonal eigenvectors with A3 x = x. (So λ = 1 is a double eigenvalue.)
Solution In solution 2 of part (a) above, we saw that the eigenvectors are all the nonzero
vectors whose entries add up to 0. Two obvious such vectors are (1, −1, 0) and (0, 1, −1),
but there are many more linearly independent pairs.
However, (1, −1, 0) and (0, 1, −1) are not orthogonal! So we must ﬁnd another pair. We
can use the Gram–Schmidt process to get orthogonal vectors, or we can just try to guess two
orthogonal vectors whose entries add up to 1. For example, (1, −1, 0) and (1, 1, −2) work.
(Note that the vectors are not required to have unit length.)
RUBRIC: up to 5 points for a correct method, 2 points for ﬁnding linearly independent
vectors, 3 points for orthogonality.

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] Find two orthogonal eigenvectors with A3 x = x. (So λ = 1 is a double eigenvalue.)]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] Find two orthogonal eigenvectors with A3 x = x. (So λ = 1 is a double eigenvalue.)', '_recupere_le' => '2026-11-04T19:55:22.557824+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Find two orthogonal eigenvectors with A3 x = x. (So λ = 1 is a double eigenvalue.)
Solution In solution 2 of part (a) above, we saw that the eigenvectors are all the nonzero
')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] Show directly that H 2 = I. Since H = H T , we now know that H is not only
symmetric but also                                   .', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Show directly that H 2 = I. Since H = H T , we now know that H is not only
symmetric but also                                   .
Solution Explicitly, we ﬁnd H 2 = (I − 2uuT )2 = I 2 − 4uuT + 4uuuT uuT (2 points):
since uT u = 1, H 2 = I (3 points). Since H = H T , we also have H T H = 1, implying
that H is an orthogonal (or unitary) matrix.

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] Show directly that H 2 = I. Since H = H T , we now know that H is not only
symmetric but also                                   .]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] Show directly that H 2 = I. Since H = H T , we now know that H is not only
symmetric but also                                   .', '_recupere_le' => '2026-11-04T19:55:22.557900+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Show directly that H 2 = I. Since H = H T , we now know that H is not only
symmetric but also                                   .
Solution Explicitly, we ﬁnd H 2 = (I − 2uuT')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] If v is any vector perpendicular to u, show that v is an eigenvector of H and ﬁnd the
eigenvalue. With all these eigenvectors v, that eigenvalue must be repeated how many
times? Is H diagonalizable? Why or why not?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : If v is any vector perpendicular to u, show that v is an eigenvector of H and ﬁnd the
eigenvalue. With all these eigenvectors v, that eigenvalue must be repeated how many
times? Is H diagonalizable? Why or why not?
Solution For any vector v orthogonal to u (i.e. uT v = 0), we have Hv = (I−2uuT )v =
v − 2uuT v = v, so the associated λ is 1. The orthogonal complement to the space
spanned by u has dimension n−1, so there is a basis of (n−1) orthonormal eigenvectors
with this eigenvalue. Adding in the eigenvector u, we ﬁnd that H is diagonalizable.

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] If v is any vector perpendicular to u, show that v is an eigenvector of H and ﬁnd the
eigenvalue. With all these eigenvectors v, that eigenvalue must be repeated how many
times? Is H diagonalizable? Why or why not?]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] If v is any vector perpendicular to u, show that v is an eigenvector of H and ﬁnd the
eigenvalue. With all these eigenvectors v, that eigenvalue must be repeated how many
times? Is H diagonalizable? Why or why not?', '_recupere_le' => '2026-11-04T19:55:22.557997+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : If v is any vector perpendicular to u, show that v is an eigenvector of H and ﬁnd the
eigenvalue. With all these eigenvectors v, that eigenvalue must be repeated how many
tim')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] How do you know that A−1 is also positive deﬁnite? (We know A−1 is symmetric. I just
had an e-mail from the International Monetary Fund with this question.)', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : How do you know that A−1 is also positive deﬁnite? (We know A−1 is symmetric. I just
had an e-mail from the International Monetary Fund with this question.)
Solution Since a matrix is positive-deﬁnite if and only if all its eigenvalues are positive
(5 points), and since the eigenvalues of A−1 are simply the inverses of the eigenvalues
of A, A−1 is also positive deﬁnite (the inverse of a positive number is positive) (5
points).

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] How do you know that A−1 is also positive deﬁnite? (We know A−1 is symmetric. I just
had an e-mail from the International Monetary Fund with this question.)]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] How do you know that A−1 is also positive deﬁnite? (We know A−1 is symmetric. I just
had an e-mail from the International Monetary Fund with this question.)', '_recupere_le' => '2026-11-04T19:55:22.558071+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : How do you know that A−1 is also positive deﬁnite? (We know A−1 is symmetric. I just
had an e-mail from the International Monetary Fund with this question.)
Solution Since a')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] Show that the block matrix
⎡        ⎤
⎢ A A ⎥
B=⎣     ⎦
A A
is positive semideﬁnite. How do you know B is not positive deﬁnite?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Show that the block matrix
⎡  ⎤
A A
B=⎣
⎢     ⎥
⎦
A A
is positive semideﬁnite. How do you know B is not positive deﬁnite?
Solution First, since B is singular, it cannot be positive deﬁnite (it has eigenvalues
of 0). However, the pivots of B are the pivots of A in the ﬁrst n rows followed by 0s
in the remaining rows, so by the pivot test, B is still semi-deﬁnite. Similarly, the ﬁrst
n upper-left determinants of B are the same as those of A, while the remaining ones
are 0s, giving another proof. Finally, given a nonzero vector
⎡ ⎤
⎢ x ⎥
u=⎣ ⎦
y
where x and y are vectors in Rn , one has uT Bu = (x+y)T A(x+y) which is nonnegative
(and zero when x + y = 0).

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] Show that the block matrix
⎡        ⎤
⎢ A A ⎥
B=⎣     ⎦
A A
is positive semideﬁnite. How do you know B is not positive deﬁnite?]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] Show that the block matrix
⎡        ⎤
⎢ A A ⎥
B=⎣     ⎦
A A
is positive semideﬁnite. How do you know B is not positive deﬁnite?', '_recupere_le' => '2026-11-04T19:55:22.558142+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Show that the block matrix
⎡  ⎤
A A
B=⎣
⎢     ⎥
⎦
A A
is positive semideﬁnite. How do you know B is not positive deﬁnite?
Solution First, since B is singular, it cannot be po')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] Solve the equation      = Au starting with the same vector u(0) at time t = 0.
dt
In other words: the', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Solve the equation      = Au starting with the same vector u(0) at time t = 0.
dt
In other words: the solution u(t) is what combination of the eigenvectors of A?
Solution One simply adds in factors of eλt to each term, giving
⎡      ⎤          ⎡    ⎤
⎢ 1 ⎥        −2it ⎢
1 ⎥
u(t) = e2it ⎣      ⎦+e        ⎣    ⎦
−2i               2i', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('u(t) is what combination of the eigenvectors of A?', 'Impossible à déterminer', 'Pas u(t) is what combination of the eigenvectors of a?', 'L\'inverse de u(t) is what combination of the eigenvectors of a?'), 'correct' => 0, 'answer' => 'u(t) is what combination of the eigenvectors of A?', '_recupere_le' => '2026-11-04T19:55:22.558234+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] (14 points) What is the 3 by 3 reduced row echelon matrix R and what is d?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : First, since R is in reduced row echelon form, we must have
�               �T
d=       4 0 0
The other two vectors provide special solutions for R, showing that R has rank 1:
again, since it is in reduced row echelon form, the bottom two rows must be all 0, and
⎡             ⎤
1 −2 −5
�             �T           ⎢             ⎥
the top row is 1 −2 −5 , i.e. R = ⎢ 0                   0 ⎥.
⎢             ⎥
0
⎣             ⎦
0     0   0

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] (14 points) What is the 3 by 3 reduced row echelon matrix R and what is d?]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] (14 points) What is the 3 by 3 reduced row echelon matrix R and what is d?', '_recupere_le' => '2026-11-04T19:55:22.558285+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : First, since R is in reduced row echelon form, we must have
�               �T
d=       4 0 0
The other two vectors provide special solutions for R, showing that R has rank 1')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] (16 points) Find all special', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : First, by row reduction
⎡              ⎤    ⎡           ⎤ ⎡         ⎤ ⎡         ⎤
0 1 2 2             0 1 2 2      0 1 0 1     0 1 0 1
⎢              ⎥    ⎢           ⎥ ⎢         ⎥ ⎢         ⎥
⎢ 0 3 8 7 ⎥→⎢ 0 0 2 1 ⎥→⎢ 0 0 2 1 ⎥→⎢ 0 0 1 2 ⎥       1
⎢              ⎥    ⎢           ⎥ ⎢         ⎥ ⎢         ⎥
⎣              ⎦    ⎣           ⎦ ⎣         ⎦ ⎣         ⎦
0 0 4 2             0 0 4 2      0 0 0 0     0 0 0 0
so the special solutions are
⎡       ⎤      ⎡           ⎤
1              0
⎢ ⎥        ⎢     ⎥
⎢ 0 ⎥      ⎢ −1 ⎥
⎢ ⎥        ⎢     ⎥
s1 = ⎢ ⎥ , s2 = ⎢
⎢   ⎥      ⎢     ⎥
⎢ 0 ⎥          1
⎢ −2 ⎥
⎥
⎣ ⎦        ⎣     ⎦
0           1
Thus, N (A) is a plane in R4 given by all linear combinations of the special solutions.', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('Impossible à déterminer', 's to Ax = 0 and describe in words the whole
nullspace of A.', 'Pas s to ax = 0 and describe in words the whole
nullspace of a.', 'L\'inverse de s to ax = 0 and describe in words the whole
nullspace of a.'), 'correct' => 1, 'answer' => 's to Ax = 0 and describe in words the whole
nullspace of A.', '_recupere_le' => '2026-11-04T19:55:22.558350+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] (10 points) What is the reduced row echelon form R � = rref(B) when B is the 6 by
8 block matrix            �         ⎡
A A
B=�          ⎣ using the same A?
A A', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (10 points) What is the reduced row echelon form R∗ = rref(B) when B is the 6 by
8 block matrix             ⎡         ⎤
A A
B=⎣            ⎦ using the same A?
A A
Solution: Note that B immediately reduces to
⎡        ⎤
A A
B=⎣           ⎦
0 0
We reduced A above: the row reduced echelon form of of B is thus
⎡             ⎤
⎡                   ⎤                0 1 0 1
rref (A) rref (A)                ⎢             ⎥
B=   ⎣                   ⎦ , rref (A) = ⎢ 0 0 1 2 ⎥
⎢           1 ⎥
0        0                ⎣             ⎦
0 0 0 0

[Correction officielle MIT : [MIT 18.06 — question d’examen, en anglais] (10 points) What is the reduced row echelon form R � = rref(B) when B is the 6 by
8 block matrix            �         ⎡
A A
B=�          ⎣ using the same A?
A A]', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 18.06 — question d’examen, en anglais] (10 points) What is the reduced row echelon form R � = rref(B) when B is the 6 by
8 block matrix            �         ⎡
A A
B=�          ⎣ using the same A?
A A', '_recupere_le' => '2026-11-04T19:55:22.558440+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (10 points) What is the reduced row echelon form R∗ = rref(B) when B is the 6 by
8 block matrix             ⎡         ⎤
A A
B=⎣            ⎦ using the same A?
A A
Solution: N')),
							array('question' => '[MIT 18.06 — question d’examen, en anglais] (10 points) Explain in words how knowing all', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The column space of A contains all linear combinations of the columns of
A, which are precisely vectors of the form Ax for an arbitrary vector x. Thus,
Ax = b has a solution if and only if b is in the column space of A .
⎡     ⎤
8
⎢     ⎥', 'source' => 'MIT OpenCourseWare, 18.06 Linear Algebra, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('s to Ax = b decides if a given
vector b is in the column space of A.
�       ⎡
8
�    ⎢', 'L\'inverse de s to ax = b decides if a given
vector b is in the column space of a.
�       ⎡
8
�    ⎢', 'Pas s to ax = b decides if a given
vector b is in the column space of a.
�       ⎡
8
�    ⎢', 'Impossible à déterminer'), 'correct' => 0, 'answer' => 's to Ax = b decides if a given
vector b is in the column space of A.
�       ⎡
8
�    ⎢', '_recupere_le' => '2026-11-04T19:55:22.558526+00:00Z', '_strategie' => 'separation_enum_solution'),
						),
					),
				),
			),
		);
	}
}
