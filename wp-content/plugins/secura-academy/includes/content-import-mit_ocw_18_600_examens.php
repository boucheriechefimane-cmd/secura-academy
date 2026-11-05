<?php
/**
 * Questions importees — MIT OpenCourseWare — 18 600 probability and random variables fall 2019
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_18_600_examens' ) ) {
	function seca_import_mit_ocw_18_600_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-18-600-examens', 'nom' => 'MIT OpenCourseWare — 18 600 probability and random variables fall 2019', 'url' => 'https://ocw.mit.edu/courses/18-600-probability-and-random-variables-fall-2019/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Write the three-by-three Markov transition matrix for this problem.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Ordering the states B, W, S, we may write the Markov
chain matrix as         ⎛           ⎞
.5 0 .5
M = ⎝.1 .9 0 ⎠ .
0 .5 .5', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Each morning the truck starts out B, it has a 1/2 chance of staying
B and a 1/2 chance of switching to S by the next morning.
(ii) Each morning the truck starts out W, it has 9/10 chance of staying
W, and a 1/10 chance of switching to B by the next morning.
(iii) Each morning the truck starts out S, it has a 1/2 chance of staying S
and a 1/2 chance of switching to W by the next morning.
Answer the following', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Each morning the truck starts out B, it has a 1/2 chance of staying
B and a 1/2 chance of switching to S by the next morning.
(ii) Each morning the truck starts out W, it has 9/10 chance of staying
W, and a 1/10 chance of switching to B by the next morning.
(iii) Each morning the truck starts out S, it has a 1/2 chance of staying S
and a 1/2 chance of switching to W by the next morning.
Answer the following', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] In which of the cases below is the sequence Zn a martingale? (Just
circle the corresponding letters.)
(i) Zn = Xn + Yn
(ii) Zn = ni=1 (2Xi + 1)
Q
(iii) Zn = ni=1 (−Xi + 1)
Q
(iv) Zn = ni=1 Yi
P
(v) Zn = ni=2 Xi Xi−1
P
3', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : In which of the cases below is the sequence Zn a martingale? (Just
circle the corresponding letters.)', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] P (N = 8)
4', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : There are 10
2
22 ways to pick a pair of people
to have swapped hats. So answer is 10 2 /10!.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the probability that Harry receives 10 new messages total
(including email, text, and Facebook) during his first two minutes of
waiting.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Compute the probability that Harry receives 10 new messages total
(including email, text, and Facebook) during his ﬁrst two minutes of
waiting. ANSWER: Number total in two minutes is Poisson with
rate λ = 2(λE + λT + λF ) = 12. So answer is
λk e−λ /k! = 1210 e−12 /10!.
2', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] What is the probability that Harry receives no messages of any kind
during his first five minutes of waiting?
5', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : What is the probability that Harry receives no messages of any kind
during his ﬁrst ﬁve minutes of waiting? ANSWER: Time till ﬁrst
message is exponential with parameter 6. Probability this time
exceeds 5 is e−30 .', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the conditional expectation E[Y |Z] as a function of Z (for
Z ∈ {2, 3, 4, . . . , 12}).
7', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Z = E[Z|Z] = E[X + Y |Z] = E[X|Z] + E[Y |Z]. By symmetry,
E[X|Z] = E[Y |Z] = Z/2.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute E[eX ].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Z ∞                    Z ∞
1     2              1      2
E(eX ) =       √ e−x /2 ex dx =      √ e−(x −2x+1)/2+1/2 dx =
−∞     2π              −∞    2π
Z ∞
1        2
e1/2     √ e−(x−1) /2 dx = e1/2 .
−∞  2π', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] If X1 , . . . , Xn are independent copies of X, and
Z = max{X1 , X2 , . . . , Xn }, then what is the cumulative distribution
function FZ ?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : ⎧
Qn                           ⎨0
⎪      a<0
FZ (a) = P {Z ≤ a} = i=1 P {Xi ≤ a} = FX1 (a) = a   n       n  a ∈ [0, 1]
⎪
1    a>1
⎩', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Now compute the conditional probability P (A|B). Based on this calculation, which (if
any) of parents one, two and three is correct?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : P (A|B) = P (AB)/P (B) = P (A)/P (B) = 1/901
so parent three is correct. REMARK: You can also consider a variant where there are 69 children
and only 5 girls, and Classroom 1 has 5 students. Then the question “What is the probability
Classroom 1 has 5 girls given it has at least 4?” is the same as the question “What is the
probability you match all ﬁve regular Powerball balls given that you match at least four?” Again,
it is somewhat surprising how much less likely 5 is than 4.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the expectation E[S1 S2 ].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : E[S1 S2 ] = E[A2 + 2B1 A + 2B2 A + 4B1 B2 ] = E[A2 ] + E[2B1 A] + E[2B2 A] + E[4B1 B2 ].
Latter three terms are zero (by independence) so answer is E[A2 ] = 1.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the conditional expectation E[S2 |S1 ] in terms of S1 . That is, express the
random variable E[S2 |S1 ] as a function of the
P random variable S1 . (Hint: if it helps,
you can argue that 2B1 agrees in law with 4i=1 Yi where the Yi are independent
normal random variables, each with mean zero and variance one.)
3', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Compute the conditional expectation E[S2 |S1 ] in terms of S1 . That is, express the random variable
E[S2 |S1 ] as P
a function of the random variable S1 . (Hint: if it helps, you can argue that 2B1 agrees
in law with 4i=1 Yi where the Yi are independent normal random variables, each with mean zero
and variance one.) ANSWER: By independence, E[A + 2B2 |A +P2B1 ] = E[A|A + 2B1 ]. Following
4
hint and writing P A = Y0 , we can
4                           P4 0 |S] where
P4write this as E[Y         P4S = i=0 Yi . We know that
S = E[S|S] = E[ i=0 Yi |S] = i=0 E[Yi |S] = i=0 E[Yi | i=0 Yi ] and since the Yi are i.i.d. the
latter ﬁve terms are all the same, hence equal to S/5. So answer is S/5.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Describe a strategy for asking yes-or-no questions to determine X, such that the
expected number of questions asked is as small as possible. What is the expected
number of questions in this case?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Ask “Is ﬁrst chord A major?” If no, ask “Is ﬁrst chord either F# minor or D major?”
and “Is ﬁrst chord either F# minor or B minor?” This determines ﬁrst chord in 1 question half the
time and 3 questions half the time. Repeat for all 16 chords. Expected number of question is
2 · 16 = H(X) which is the smallest possible.
2', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the joint probability density fX,Y (x, y) and the marginal density function
fX (x).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Compute the joint probability density fX,Y (x, y) and the marginal density function
√      fX (x).
1
ANSWER: fX,Y (x, y) is 1/π in the unit circle, 0 elsewhere and fX (x) = π 2 1 − x2 .', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Write Z = X 2 + Y 2 and work out the density function fZ .
8', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : First work out
p           √       √
FZ (a) = P (Z ≤ a) = P (X 2 + Y 2 < a) = P ( X 2 + Y 2 < a) = π( a)2 /π = a.
Diﬀerentiating we ﬁnd that fZ is equal to 1 on [0, 1] so that Z is a uniform random variable.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] What is the probability that Sally is granted bank acount access at least three times
during her ﬁrst year of operation?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Number of accesses during 1 year is Poisson with parameter
1 · λ = 3. So answer is 1 − 2k=0 e−3 3k /k!
P', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the quantities a = P (A1 ) and b = P (A1 A2 ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : There are 12
� 
possible
�412
collections of hats for person one, and only of them is right. So a = P (A1 ) = 1/ 4 . Similarly
b = P (A1 A2 ) = (1/ 12
�      � 8
4  )(1/  4 ).', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute P (N > 0). (Again, you can use a and b in your answer, if that helps.)
10', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Note
that P (A1 A2 A3 ) = P (A1 A2 ). Then inclusion exclusion gives P (N > 0) = 3a − 3b + b = 3a − 2b.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the correlation coeﬃcient ρ(S50 , S200 ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Using bilinearity of covariance we
have Cov(S50 , S200 ) = Cov(S50 , S200 − S50 ) + Cov(S50 , S50 ). First term is zero (since it is a
covariance of two independent random variables) and second term is Var(S50 ) = 50/4. So answer is
√ 50/4        = 1/2.
(50/4)(200/4)', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the conditional probability P [X > 10|X > 5].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : An exponential
random variable of rate λ is greater than a with probability e−λa . Thus
P [X > 5, X > 10]/P [X > 5] = P [X > 10]/P [X > 5] = e−10 /e−5 = e−5 .
Alternatively, this follows from “memoryless” property of exponentials. (If X is the
time a bus arrives, then given no bus for ﬁrst ﬁve units, conditional probability of ﬁve
more units without bus is same as original probability of ﬁve units without bus.)', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the entropy of one of Sally’s emoji. That is, compute H(X1 ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : 1       1       1       1        1        1        1        1
4 · 2 + 4 · 2 + 8 · 3 + 8 · 3 + 16 · 4 + 16 · 4 + 16 · 4 + 16 · 4 = 11/4.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Assume that a and b are ﬁxed positive constants and write Y = aX1 + b. Compute the
probability density function fY .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Recall that in general
faZ (x) = a−1 fZ (x/a) and fZ+b (x) = fZ (x − b). Applying that here we have
1
fY (x) = a−1 fX1 ((x − b)/a) = a−1 �                 .
π 1 + (x − b)2 /a2', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the probability density function for W = (X1 + 2X2 )/3. [Hint: use (c).]
4', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The average of X2 and X3 is Cauchy, so X2 + X3 has the same density
1
function as 2X2 . Hence the answer is the same as in (c), i.e., fW (x) = π(1+x 2)', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Let T be the smallest n ≥ 0 for which Yn is an integer multiple of 500. Compute E[YT ].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Eventually Yn will reach 0 or 500. By optional stopping theorem
E[YT ] = Y0 = 85.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the moment generating function for X using the “complete the square” trick.
(Show your work.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Z ∞                   Z ∞
1    2                1       2    2     2         2
MX (t) = E[etX ] =     √ e−x /2 etx dx =     √ e−(x −2tx+t )/2+t /2 dx = et /2 .
−∞  2π                −∞   2π
2', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Let K be the number of ways to divide the ten people into ﬁve groups, two people per
group, so that each person in the class has a partner. Find K.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : 10!/25
ways to get ordered set of ﬁve partnerships. Dividing by 5! we get K = 10!/(25 5!) to
get unordered division into ﬁve partnerships.. Alternatively, line people up, choose
parner for ﬁrst person (9 choices), partner for next un-partnered person (7 choices) etc.
to get K = 9 · 7 · 5 · 3 · 1.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute P (N = 6). You can use K in your answer if you did not compute an explicit
value for K.
7', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Fix partnerships for ﬁrst day. Then there are K ways to
choose partnerships  for second day. How many of these ways result in N = 6? Well,
there are 53 ways to decide which partnerships will stay unchanged on second day.
�
Pick one of remaining four people, and there are two ways to assign that person�a
partner diﬀerent from the previous day. So the number of ways to get N = 6 is 53 · 2
(5)·2
and P (N = 6) = 3K .', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Give the 8 by 8 matrix describing the monkey’s transition probabilities. (You don’t
have to write all 64 entries. Just write the entries that are non-zero.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : ⎛                                            ⎞
1/2 1/2 0         0     0     0    0     0
⎜1/2 0 1/2 0              0     0    0     0 ⎟
⎜                                            ⎟
⎜1/2 0        0    1/2    0     0    0     0 ⎟
⎜                                            ⎟
⎜1/2 0        0     0 1/2 0          0     0 ⎟
⎜                                            ⎟
⎜1/2 0        0     0     0 1/2 0          0 ⎟
⎜                                            ⎟
⎜1/2 0        0     0     0     0   1/2    0 ⎟
⎜                                            ⎟
⎝1/2 0        0     0     0     0    0 1/2⎠
1     0     0     0    0     0     0     0', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute E[S] and Var(S).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : E[S] = 100E[X1 ] = 15000. Recall that
variance of uniform random variable on [0, 1] is 1/12, so Var[X1 ] = 10000/12 and
Var[S] = 3000000/12 = 250000.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Give an interval
R 2 [a,1b] such   that E[S] = (a + b)/2 and P (S ∈ [a, b]) ≈ .95. (You may use
−x 2 /2
the fact that −2 2π e
√             dx ≈ .95.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Give an intervalR 2 [a,1b] such   that E[S] = (a + b)/2 and P (S ∈ [a, b]) ≈ .95. (You may use
−x 2 /2
the fact that −2 2π e√             dx ≈ .95.) ANSWER: Standard deviation of S is
√
250000 = 500, and CLT implies chance of S being within two standard deviations of
E[S], i.e., in [14000, 16000] is about .95.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the probability density function for Y .
Ra          2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Y is normal with mean µ = −2
2   2                  2
and variance σ 2 = 30, so fY (x) = σ√12π e−(x−µ) /2σ = √30·1√2π e−(x+2) /60 .
Ra         2', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Write Yn = ni=1 Xi . Is Yn a martingale?
P', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Yes, since
P
E[Yn |Y0 , Y1 , . . . , Yn−1 ] = E[Yn−1 + Xn |Y0 , Y1 , . . . , Yn−1 ] = E[Yn−1 |Y0 , Y1 , . . . , Yn−1 ] = Yn−1', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Is Zn a martingale?
3', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : By our deﬁnition, Zn is a martingale if and only if
E[Zn |Z0 , Z1 , Z2 , . . . , Zn−1 ] = Zn−1 , or equivalently E[Zn − Zn−1 |Z0 , Z1 , Z2 , . . . , Zn−1 ] = 0.
We rewrite this as E[2Yn−1 Xn + Xn2 − 1|Z0 , Z1 , Z2 , . . . , Zn−1 ] = 0. This is true by the
analysis used in (b) and the fact that Yn−1 and Xn are conditionally independent of each
other when Z0 , Z1 , Z2 , . . . , Zn−1 is given, with the conditional expectation of Xn being zero.
1', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Write the probability density function for A = X1 + W . (Your answer will involve an
integral that you do not have to try to evaluate explicitly.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Z ∞                          Z ∞
1       1       2
fX1 +W (a) =      fX1 (x)fW (a − x)dx =               2)
√ e−(a−x) /2 dx.
−∞                           −∞ π(1 + x     2π', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the expectation E[B].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Let Ai be 1 if ith person gets both a left and a
right shoe, zero otherwise. If we imagine shoes handed out one by one, then whatever ﬁrst
person gets as ﬁrst shoe, that person will have n/(2n − 1) chance of getting an opposite type
the second, so E[A1 ] = 2/(2n − 1). Similarly E[Ai ] = 2/(2n − 1) for any i. Thus
shoe for P
E[B] = ni=1 E[Ai ] = n2 /(2n − 1).', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the joint probability density fX,Y (x, y).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The triangle has area 1/2, so
fX,Y (x, y) is 2 if (x, y) is in the triangle and zero otherwise.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute E[X].
6', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Z ∞Z ∞                    Z 1 Z 1−y
E[X] =        fX,Y (x, y)xdxdy =           2xdxdy
−∞     −∞                          0    0
Z 1
1
=         (1 − y)2 dy = −(1 − y)3 /3       = 1/3.
0                                 0', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the probablity density function for W = X 3 .
7', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : For a ∈ (0, 1),
FW (a) = P (W ≤ a) = P (X 3 ≤ a) = P (x ≤ a1/3 ) = a1/3 . Thus,
0 (a) = (1/3)a−2/3 .
fW (a) = FW', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Let B be the second largest of the three values in {X, Y, Z}. Compute E[B].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : E[B] = 5/2 by symmetry. (In principle you could also compute this by rescaling to the
interval [0, 1] and recalling some of our problem set problems on beta random variables.)', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Suppose that X and Y are two (not necessarily independent or identically distributed)
random variables, each of which takes values in the set {1, 2, 3, 4, 5, 6}. Which of the
following is necessarily true? (Just circle the corresponding letters.)
(i) H(X, Y ) ≥ H(X) + H(Y )
(ii) H(X, Y ) = H(X) + H(Y )
(iii) H(X) ≤ H(X, Y ).
(iv) H(X + Y ) ≤ log(11).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Suppose that X and Y are two (not necessarily independent or identically distributed)
random variables, each of which takes values in the set {1, 2, 3, 4, 5, 6}. Which of the
following is necessarily true? (Just circle the corresponding letters.)', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Over the long term, what fraction of the time does the country spend under each of the
three types of leaders?
10', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : You can write
⎛                 ⎞
�           2/3   1/4  1/12      �       
a b c ⎝1/4 2/3 1/12⎠ = a b c
1/2 1/2      0
and use a + b + c = 1 to solve and ﬁnd (a, b, c) = (6/13, 6/13, 1/13), which are the long term
probabilities for states L, C and I respectively.
4', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Under the same assumption, what is the probability that, during the course of a
century, there will be at least 1 calendar year during which there are exactly 6 house
ﬁres? Compute your answer in terms of the p computed in (a).
When Jill ﬁrst moved to town, Nora thought that there was a 1/100 chance that Jill was a
witch. She also thought if Jill wasn’t a witch the number of ﬁres that year would be Poisson
with parameter 1, and that if Jill was a witch the number would be 6 with probability 1.
(Arranging for there to be exactly 6 ﬁres per year is what arsonist witches in this world do.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : 1 − (1 − p)100 .
When Jill ﬁrst moved to town, Nora thought that there was a 1/100 chance that Jill was a witch.
She also thought if Jill wasn’t a witch the number of ﬁres that year would be Poisson with
parameter 1, and that if Jill was a witch the number would be 6 with probability 1. (Arranging for
there to be exactly 6 ﬁres per year is what arsonist witches in this world do.)', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the marginal law fX (x).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Compute the marginal law fX
( √
∞                   2 1−x2
|x| ≤ 1
Z
fX (x) =        f (x, y)dy =     π                .
−∞                  0        otherwise', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the probability that there are exactly two yellow buses during the ﬁrst half
hour.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Number of yellow buses in 1/2 hour is Poisson with parameter
λ = 3/2. So probability is e−λ λk /k! with k = 2, which is e−3/2 (3/2)2 /2.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the mean, variance and standard deviation of Z1 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : E[X1 ] = .2
and E[Y1 ] = .1 so E[Z1 ] = E[X1 − Y1 ] = .1. Using independence,
Var(Z1 ) = Var(X1 − Y1 ) = Var(X1 ) + Var(−Y1 ) = Var(X1 ) + Var(Y1 ) = .09 + .16 = .25.
So SD(Z1 ) = .5.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Use the central limit theorem to approximate the probability that S100 > 0. (This is
the probability that the more capable
R a closer has closed more deals after 100 weeks.)
2
You may use the function Φ(a) = −∞ √12π e−x /2 dx in your answer.
4', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Note
that 0 is two standard deviations below the expectation of S100 . So using CLT
approximation, P (S100 > 0) ≈ P (N > −2) where N is a standard normal random
variable. This is 1 − Φ(−2) or equivalently Φ(2) ≈ .977. Remark: This is similar to a
problem set problem in which the probabilities were .5 and .6 instead of .1 and .2. In
the problem set problem, the analog of Var(Z1 ) was .25 + .24 = .49 and the analog of
SD(Z1 ) was .7. It would have taken 196 weeks in the problem set scenario to be able to
distinguish between the candidates with as much conﬁdence as we achieved with 100
weeks in this problem. But the take home message is that in both situations it takes a
long time to be able to determine (with .977 conﬁdence) which candidate is stronger
based on empirical results.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] If a software engineer is currently unemployed, what is the probability that he or she
will be unemployed in two months?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : For this to happen, either stay in
state 0 both months or transition out to company state and then back to state zero.
Adding the two probabilities gives (3/10)2 + 7(1/10) · (1/70) = .09 + .01 = 1/10.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Suppose X1 , X2 , X3 , . . . , X100 are i.i.d. random variables, each with the same law as X,
representing the calls received over an entire day. Compute H(X1 , X2 , X3 , . . . , X100 ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : By additivity of entropy (for independent random variables) this is
100H(X1 ) = 2100/8.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Write S0 = 0 and (for n ≥ 1) write Sn = nj=1 Xj . Is the sequence Sn a martingale?
P
Explain why or why not. (Recall that the deﬁnition of martingale requires that
E[ Sn | < ∞ for all n, and explicitly note whether this is true.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Write S0 = 0 and (for n ≥ 1) write Sn = nj=1 Xj . Is the sequence Sn a martingale?
P
Explain why or why not. (Recall that the deﬁnition of martingale requires that
E[ Sn | < ∞ for all n, and explicitly note whether
R ∞ this    is true.) ANSWER: This is
1
not technically a martingale since E[ S1 | = −∞ π(1+x       2 ) |x|dx = ∞.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the probability P (S10 > 10).
7', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : This is same as probability that
X1 > 1, which is 1/4, as is easily seen from spinning ﬂashlight story.
4', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the probability that there exists some positive integer n for which Sn = −20.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : This is 1. The probability that Sn hits −20 before hitting K (for large
positive K) is K/(K + 20). This is a lower bound on the probability that −20 is hit
ever. Since we can make this lower bound as close to 1 as we want (by taking K large
enough) the answer is 1.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] The expectation E[R].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The expectation
P6 E[R].PANSWER:
E[R] = E[ i=1 Ai ] = 6i=1 P (Ai = 1) = 1 + 1/2 + 1/3 + 1/4 + 1/5 + 1/6 = 49/20.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the conditional probability that the last three cards turned over are all
records given that the ﬁrst three cards are all records.
9', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Chance ﬁrst three
cards are in increasing order is 1/3!. Chance all cards are records is 1/6!. So
conditional probability is (1/6!)/(1/3!) = 3!/6! = 1/120.
5', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the correlation coeﬃcient of A =         n=1 Xn and B =      n=41 Xn .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Compute the correlation coeﬃcient of A = 60
P                 P100
n=1 Xn and B =    n=41 Xn . ANSWER:
Since A and B have mean zero, we know that
60
X           100
X               60 X
X  100
Cov(A, B) = E[AB] = E[            Xj          Xk ] =              E[Xj Xk ].
j=1        k=41            j=1 k=41
The only non-zero terms are when j = k, and there are 20 such terms, so
Cov(A, B) = 20. By additivity of variance for independent random variables, we have
Var(A) = Var(B) = 60. So the correlation coeﬃcient is
p
Cov(A, B)/ Var(A)Var(B) = 20/60 = 1/3.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the probability density function for X + Y + Z.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : This a gamma
distribution with n = 3 and λ = 1. So density is x2 e−x /2! on [0, ∞).', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the expectation and variance of min{X, Y, Z}.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The minimum is
exponential with parameter λ = 3. So expectation is 1/3 and variance 1/9.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Each morning the car starts out B, it has a .5 chance of staying B
and a .5 chance of switching to S by the next morning.
(ii) Each morning the car starts out W, it has .5 chance of staying W,
and a .5 chance of switching to B by the next morning.
(iii) Each morning the car starts out S, it has a .5 chance of staying S and
a .5 chance of switching to W by the next morning.
Answer the following', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Each morning the car starts out B, it has a .5 chance of staying B
and a .5 chance of switching to S by the next morning.
(ii) Each morning the car starts out W, it has .5 chance of staying W,
and a .5 chance of switching to B by the next morning.
(iii) Each morning the car starts out S, it has a .5 chance of staying S and
a .5 chance of switching to W by the next morning.
Answer the following', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the variance of X 2 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Var(X 2 ) = E[(X 2 )2 ] − E[X 2 ]2 ,
and                          � 1
x3 ��1
E[X 2 ] =         (x2 /2)dx =
� = 1/3,
−1            6 −1
� 1 4
2 2       4        x         x5 ��1
E[(X ) ] = E[X ] =       dx =        � = 1/5,
−1 2         10 −1
so Var(X 2 ) = E[(X 2 )2 ] − E[X 2 ]2 = 1/5 − (1/3)2 = 1/5 − 1/9 = 4/45.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Over the long term, what fraction of the time does the bench spend
in each of the three states?
3', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : We know
⎛              ⎞
   1/2 1/4  1/4               
E S D ⎝1/4 3/4 0 ⎠ = E S D
1/4 0 3/4
and E + S + D = 1. Solving gives E = S = D = 1/3.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] P (N = 0)
4', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : This is an inclusion exclusion problem. Let
Ai be the event that the ith person gets own hat. Then
P (N > 0) = P (A1 ∪ A2 ∪ A3 ∪ . . . ∪ A8 )
=        P (Ai ) −         P (Ai ∩ Aj ) +           P (Ai ∩ Aj ∩ Ak ) − . . .
i               i<j                    i<j<k
8 1       8 1          8      1
=        −           +              ...
1 8       2 8·7        3 8·7·6
= 1/1! − 1/2! + 1/3! + . . . − 1/8!
Thus,
P (N = 0) = 1−P (N > 0) = 1−1/1!+1/2!−1/3!+1/4!+1/5!−1/6!+1/7!−1/8! ≈ 1/e.
2', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] In which of the cases below is the sequence Zn a martingale? (Just
circle the corresponding letters.)
(i) Zn = 5Xn
(ii) Zn = 5−n ni=1 Xi
Q
(iii) Zn = ni=1 Xi2
Q
(iv) Zn = 17
(v) Zn = Xn − 4
5', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : In which of the cases below is the sequence Zn a martingale? (Just
circle the corresponding letters.)', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the conditional probability P [X1 = 6|Z = 16].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : One can enumerate the six possibilities that add up to 16. These are
(4, 6, 6), (6, 4, 6), (6, 6, 4) and (6, 5, 5), (5, 6, 5), (5, 5, 6). Of these, three
have X1 = 6, so P [X1 = 6|Z = 16] = 1/2.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the moment generating function for X1 .
Pn', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Compute the
e 1 moment  generating function for X1 . ANSWER:
tX        tx      et −1
E(e ) = 0 e dx = t .
1', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute E[eX ].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : E[etX ] = −∞ √5√       1
2π
e−x /(2·5) e−x dx.
A complete the square trick allows one to evaluate this and obtain
e5/2 .', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute H(2X 3Y ).
10', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Also log 6, since each distinct
(X, Y ) pair gives a distinct number for 2X 3Y .', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute EY100 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Since Yn is a martingale, we have
E[Y100 ] = 1. This can also be derived by noting that for independent
random variables, the expectation of a product is the product of the
expectations.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the probability density function for the random variable
Z = (X − Y )/2.
2   2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : If Y is Cauchy then −Y is also Cauchy. The average of two independent
1
Cauchy random variables it itself Cauchy, so the answer is π(1+x 2) .
2
2   2', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] The moment generating function MX1 (t).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The moment generating function MX1
MX1 (t) = E[etX1 ] = 16 (et + e2t + e3t + e4t + e5t + e6t ).', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute E[XY ].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : X and Y are independent normal random variables, each
with mean zero and variance one. Since they are independent
R∞ R∞ we have
1 −(x2 +y 2 )/2
E[XY ] = E[X]E[Y ] = 0. Alternatively, write E[XY ] = −∞ −∞ xy 2π   e             dxdy.
Then there are various ways to argue by symmetry that this must be zero.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the probability P (X 2 + Y 2 ≤ 4).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : This can be computed using polar
coordinates.
R 2 R 2π 1 −r2The  integral
R becomes
e   /2 rdθdr = 2 e−r2 /2 rdr = −e−r2 /2 |2 = −e−2 − (−1) = 1 − e−2 ≈ .86466
0 0 2π                    0                       0', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the conditional expectation E (X1 − Y1 )|X as a function of the random
variable X.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : We know E[X1 + . . . + X50 |X] = E[X|X] = X. And E[Xj |X] should be the same for
each j by symmetry. Hence E[X1 |X] = X/50. Since Y1 and X are independent
E[Y1 |X] = E[Y1 ] = 14. By additivity of conditional expectation, E[(X1 − Y1 )|X] = X/50 − 14.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] When j ∈ {1, 2, . . . , 10} is ﬁxed, is the sequence Aj0 , Aj1 , A2j , . . . a martingale? Explain
why or why not.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : When j ∈ {1, 2, . . . , 10} is ﬁxed, is the sequence Aj0 , Aj1 , Aj2 , . . . a martingale? Explain why or why
not. ANSWER: Yes. We put ourselves in the shoes of somebody who has seen the ﬁrst n steps
1
and knows Ajn . The only way that we have An+1  j
6= Ajn is if a pair (j, k) is chosen and both jth and
kth islanders have a positive number of apples. But if this happens, then the jth islander is just as
likely to gain as to lose an apple. So E[Ajn+1 |Fn ] = Anj .', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the expected number of islanders who never have more than 10 apples.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Same analysis as (b) but replace 0 and 25 with 0 and 11. We ﬁnd that the expected number who
1
reach 0 before 11 is 10 · 11 = 10/11.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] First choose uniformly at random one of the 10
� 
2 possible pairs of islanders.
(ii) Then, if both islanders in the pair have at least one apple, toss a fair coin to declare
one of them the “winner” and transfer one apple from the loser to the winner. (If
either islander is already out of apples, do nothing.)
The above is repeated until one islander (the “overall winner”) has all the apples. (This
happens eventually with probability 1. You don’t have to prove this; take it as given.) Let Ajn
be the number of apples the jth person has after n steps, and let T(be the number of steps
100 j is overall winner
before the game ends. So Aj0 = 10 for j ∈ {1, 2, . . . , 10} and AjT =
0   otherwise', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : First choose uniformly at random one of the 10
� 
2 possible pairs of islanders.
(ii) Then, if both islanders in the pair have at least one apple, toss a fair coin to declare one of them
the “winner” and transfer one apple from the loser to the winner. (If either islander is already out
of apples, do nothing.)
The above is repeated until one islander (the “overall winner”) has all the apples. (This happens
eventually with probability 1. You don’t have to prove this; take it as given.) Let Ajn be the number of
apples the jth person has after n steps, and  ( let T be the number of steps before the game ends. So
100 j is overall winner
Aj0 = 10 for j ∈ {1, 2, . . . , 10} and AjT =
0    otherwise', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] What is the overall probability that the person locked up at the end is guilty?
4', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Given
that the confession occurred on the kth day, the conditional probability that the person was guilty
is 1/2, by similar argument as in (b). Since this is true for any day, the overall probability is 1/2.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Let N be the number of people who get back their own hat. Let N ∗ be the number of
people who get their own hat back and ﬁnd that hat to be clean (i.e., not dirty).
Compute E[N ∗ ] and Var[N ∗ ]. (In case this notation helps: let Ni∗ be 1Pif the ith
person gets own hat and ﬁnds it clean, and 0 otherwise, so that N ∗ = 8i=1 Ni∗ .)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Let N be the number of people who get back their own hat. Let N ∗ be the number of people who
get their own hat back and ﬁnd that hat to be clean (i.e., not dirty). Compute E[N ∗ ] and Var[N ∗ ].
(In case this notation helps: let Ni∗ be 1 if the ith person gets
P8own
Phat  and ﬁnds it clean, and 0
8                                        8
∗
otherwise, so that N = i=1 Ni .) ANSWER: E[N ] = i=1 j=1 E[Ni∗ Nj∗ ]. There are 64
∗                      ∗ 2
P
terms, and 8 of them have i = j, 56 have i 6= j. So E[N ∗ ]2 = i=j P (Ni∗ = 1) + i=         ∗
P               P
6 j P (Ni =
Nj∗ = 1) = 8 · (1/8)(1/2) + 56(1/56)(1/2)(1/2) = 1/2 + 1/4 = 3/4. Similar arguments give
E[N ∗ ] = 8(1/8)(1/2) = 1/2. So Var[N ∗ ] = 3/4 − (1/2)2 = 1/2.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the derivatives C 0 and C 00 on the interval [0, 10].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Taking derivative directly
gives C 0 (x) = − 10
1
(10 − x) = x/10 − 1 and C 00 (x) = 10
1
. Alternatively, one could remember the call
function formulas derived in lecture: C (x) = FX (x) − 1 and C 00 (x) = fX (x).
0
R 10 1 3        1 4    10    1', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the probability P X1 + X2 + X3 < 2 and X1 + X2 + X3 + X4 > 2 . (Hint:
try to come up with a Poisson point process interpretation of the question.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The points
X1 , X1 + X2 , X1 + X2 + X3 , X1 + X2 + X3 + X4 , . . . form a Poisson point process of rate 1. So
answer is the probability that a Poisson point process of rate 1 has three points in [0, 2] (with the
fourth point coming after 2). This is given by e−λ λk /k! with λ set to 2 and k set to 3.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute E[R] where R = X 2 + Y 2 . (Hint: maybe use a polar coordinates integral.
Or maybe ﬁnd a way to compute FR and/or fR without doing that.)
9', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : R1
FR (a) = P (R ≤ a) = (πa2 )/π = a2 so fR (x) = 2x so E[R] = 0 2x2 dx = 2/3.
4', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Describe a strategy for asking a sequence of yes/no questions such that the expected
number of questions one has to ask to learn the value of X is exactly H(X).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Optimal approach
is to choose questions that have equal probability to be yes or no. There are many ways to do this,
but one is to ask the questions “Is ﬁrst child a girl? Is second child a girl? Is third child a girl? Is
fourth child a girl?” but stop once X is known. (For example, if ﬁrst answer is yes, second answer
is no, then one can stop asking questions since it is then clear that X = GB and there are no more
children.)', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the probability P (max{X1 , X2 } > max{X3 , X4 , X5 }).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : This just the
probability that the largest of the ﬁve elements is either X1 or X2 . Since each of the Xi is equally
likely to be largest, the answer is 2/5.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the probability P (X1 + X2 > X3 + X4 + X5 + 5).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Note that by symmetry
X1 + X2 − X3 − X4 − X5 has same law as X1 + X2 + X3 + X4 + X5 which in turn has same law as
5X1 (by a special property of Cauchy random variables). So answer is equivalent to
P (5X1 > 5) = P (X1 > 1) which in turn (recall spinning ﬂashlight story) is 1/4.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the conditional probability P (A|B).
6', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : P (AB)/P (B) =
P (A)/P (B) = 1/22. Note: it may seem surprising that even though each person has a 3/10
chance of winning separately, it is still the case that given that two win, the chance that all
three win is only 1/22. This is similar to the powerball problem (where the chance of
matching all ﬁve white balls is surprisingly small compared to chance of matching 4 or 3).', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Over the long term, what fraction of mornings does the truck start
out in each of the three states, B, S, and W ?
2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : We ﬁnd
the stationarity probability vector π = (πB , πW , πS ) = (1/7, 5/7, 1/7)
by solving πM = π (with components of π summing to 1).', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] What is the probability that Yn reaches 10 before the first time that
it reaches −30?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : What is the probability that Yn reaches 10 before the ﬁrst time that
it reaches −30? ANSWER: Probability p satisﬁes
10p + (−30)(1 − p) = 0, so 40p = 30 and p = 3/4.
1', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] E[N 2 ]', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Let Ni be 1 if ith person gets own hat, zero
otherwise. Then
E[( Ni )2 ] = 10
e         e e10
i=1  j=1 E[Ni Nj ] = 90(1/90) + 10(1/10) = 2.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] After catching up on existing messages one morning, Harry begins to
wait for new messages to arrive. Let X be the amount of time (in
minutes) that Harry has to wait to receive his first text message.
Write down the probability density function for X.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : After catching up on existing messages one morning, Harry begins to
wait for new messages to arrive. Let X be the amount of time (in
minutes) that Harry has to wait to receive his ﬁrst text message.
Write down the probability density function for X. ANSWER:
time is exponential with parameter λT = 3, so density function is
f (x) = 3e−3x for x ≥ 0.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Let Y be the amount of time elapsed before the third email message.
Compute Var(Y ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Variance of time till email message is
1/λ2E = 1. Memoryless property and additivity of variance of
independent sums gives Var(S) = 3.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the probability density function fX for X.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : ∞                 1
√
π 2 1 − x2 −1 ≤ x ≤ −1
fX (x) =      f (x, y)dy =
−∞                 0            otherwise', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute H(X + Y ).
9', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : 6
6                                        1        1
P (X+Y = i)(− log P (X+Y = i)) = 2· log 8+3· log 4 = 6/8+6/4 = 9/4.
8        4
i=1', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute E[eX 1X>0 ].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Z ∞
1    2
E(eX 1X>0 ) =      √ e−x /2 ex dx
2π
Z0 ∞
1     2
=      √ e−(x −2x+1)/2+1/2 dx
0      2π
Z ∞
1        2
= e1/2      √ e−(x−1) /2 dx
2π
Z0 ∞
1      2
= e1/2      √ e−x /2 dx = e1/2 (1 − Φ(−1)) = e1/2 Φ(1),
−1   2π
�a          2
where Φ(a) = −∞ √12π e−x /2 dx.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Let A be the event that all 30 students in Classroom 1 are girls. Let B be the event
that Classroom 1 has at least 29 girls. Compute the quantities P (A) and P (B).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Only one of the 60
� 
�60                                     30
divisions assigns all girls to Classroom 1, so P (A) = 1/ 30 . To get exactly 29 girls, one has 30
choices for the girl not �present, and 30 choices
�60for
 the boy who is present—so the probability of
exactly 29 girls is 900/ 60

30  and  P (B) = 901/  30 .', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Let G be the number of girls in Classroom 1 and B the number of boys in Classroom 1.
Compute the expectation E[GB].
2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Let Gi (resp. Bi ) be indicator function for event that ith girl
(resp. boy) is in Classroom 1. Then
30           30                 30 X
30
h�X          �X         i       X                                                  1 29
E[GB] = E           Bi          Gi        =             E[Gi Bj ] = 900P (G1 = B1 = 1) = 900 ·    ·
2 59
i=1         i=1                 i=1 j=1', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute Var(S1 ) and Var(S2 ) and the correlation coeﬃcient ρ(S1 , S2 ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : By addivity of
variance (for independent random variables) we have
Var(S1 ) = Var(A) + Var(2B1 ) = Var(A) + 4Var(B1 ) = 5.
Similarly Var(B2 ) = 5, and ρ(S1 , S2 ) = √ Cov(S1 ,S2 )        = 1/5.
Var(S1 )Var(S2 )', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the entropy H(X1 ), i.e., the entropy involved in choosing the ﬁrst chord.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : 1         1          1         1      1       1
2 (− log( 2 )) + 4 · 8 (− log( 8 )) = 2 · 1 + 2 · 3 = 2.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Let S = {i : Xi = A major}. In other words, S is the collection of times at which an A
major chord is played. Compute H(S) and H(S, X) and HS (X).
4', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : H(S) = 16 (since S encodes 16
i.i.d. fair coin tosses) and H(S, X) = H(X) = 32 (since X determines S). By a general identity,
H(S, X) = H(S) + HS (X) so HS (X) = 16.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the probability P (0 < X < Y ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The intersection of the disk, the plane
where x > 0, and the plane where x < y together forms a wedge of angle π/4, which is one eighth of
total disk, so answer is 1/8.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Write Y = X3 and compute the density function fY .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The nth term in a Poisson point
process with parameter λ (which is a sum of n independent exponentials with parameter λ) is a
Gamma random variable with parameters λ and n. In this case X3 is Gamma with parameters
n = 3 and λ = 3 so answer is fY (y) = 3 · (3y)2 e−(3y) /2.
5', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Write Y0 = 0 and Yk = Xk − k3 . Is the sequence Y0 , Y1 , . . . a martingale? Why or why
not?
9', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Yes. The increments Ik = Xk − Xk−1 are independent exponential random variables
with expectation 1/3. So the increments Yk − Yk−1 are independent random variables with
expectation 0. Alternatively, write E[Yk+1 |Fk ] = E[Yk + Ik+1 − 1/3|Fk ] = Yk .', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute E[N ] and Var(N ). (You can use the a and b from the previous part in your
answer, if that helps.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Compute E[N ] and Var(N ). (YouP   can use the a and b from the
Pprevious part in your answer, if
3                    2     3 P3
that helps.) ANSWER: E[N ] = i=1 P (Ai ) = 3a. E[N ] = i=1 j=1 P (Ai Aj ) = 3a + 6b. So
Var(N ) = E[N 2 ] − E[N ]2 = 3a + 6b − 9a2 .', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Use the Rcentral limit theorem to approximate P (S100 > 110). You may use the function
a          2
Φ(a) = −∞ √12π e−x /2 dx in your answer.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : We have E[S100 ] = 100 and Var(S100 ) = 25
and SD(S100 ) = 5. And chance to be at least two standard deviations above the mean is about
1 − Φ(2) = Φ(−2).', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute E[3X 13 ]', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Recall that 0 e−x xn = n! (which can be taken as one
of the deﬁnitions of n!). This implies that E[X n ] = n! and hence E[3X 13 ] = 3 · 13!', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Let Y = X 2 . Compute the cumulative distribution function FY .
2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : √          √        √
FY (a) = P (Y ≤ a) = P (X 2 ≤ a) = P (X ≤ a) = FX ( a) = 1 − e− a .', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Suppose you try to ﬁgure out the value of X1 by asking a series of yes or no questions
to someone who knows the value. Assume you use the strategy that minimizes the
expected number of questions you need. How many questions do you expect to ask?
3
1', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : We know that H(X) = 11/4 is the minimum number possible. Since we
can divide the space exactly in half (in terms of probability) with each question, this
minimum is achievable, and the answer is 11/4.
1
1', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the probability that X1 ∈ [−1, 1]. Give an explicit number. (Recall spinning
ﬂashlight story.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The ﬂashlight at (0, 1) goes over a π/2 range of angles as
it shifts from pointing to (0, 1) to (0, −1), as compared to the total π range of angles.
So the answer is (π/2)/π = 1/2.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Find the probability that the sequence Y0 , Y1 , Y2 , . . . reaches 50 before it reaches 100.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Write p50 for probability of reaching 50 ﬁrst and p100 for probability of
hitting 100 ﬁrst. Then by the optional stopping theorem 50p50 + 100p100 = 85 and
p50 + p100 = 1. Solving gives p50 = 3/10.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute E[3Y10 − 4Y8 |Y5 ] in terms of Y5 . In other words, recall that the conditional
expectation E[3Y10 − 4Y8 |Y5 ] can be understood as a random variable and express this
random variable as a simple function of Y5 .
5', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : E[Y10 |Y5 = Y5 ] and
E[Y8 |Y5 ] = Y5 . By additivity of conditional expectation E[3Y10 − 4Y8 |Y5 ] = −Y5 .', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Fix positive constants a, b, and c and compute E[aX 2 + bX + c] in terms of a, b, and c.
6', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Additivity of expectation gives
E[aX 2 + bX + c] = E[aX 2 ] + E[bX] + E[c] = a + c.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Assume that one of these K ways is chosen uniformly at random on one day, and
another is chosen uniformly at random (independently) on a subsequent day. Let N be
the number of people who have the same partner on both days. What is E[N ]?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Each person has 1/9 chance of getting same partner on second day.
Additivity of expectation gives E[N ] = 10/9.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the conditional expectation E[X|Y ] as a function of Y .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Given a
value for Y√in [−1, 1], the value X is conditionally uniform on [0, 1 − Y 2 ] so
E[X|Y ] = 1 − Y 2 /2 for Y ∈ [−1, 1].', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute (π0 , π1 , . . . , π7 ) where πi is the fraction of the time the monkey spends in
state i, over the long term. (Hint: ﬁrst see if you can express each πj as an integer
multiple of πj+1 for j < 7. Then see if you can express each πj as a multiple of π7 .)
10', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : ⎛                                           ⎞
1/2 1/2 0         0     0   0    0     0
⎜1/2 0 1/2 0               0   0    0     0 ⎟
⎜                                           ⎟
⎜1/2 0          0 1/2 0        0    0     0 ⎟
⎜                                           ⎟
�                                         ⎜1/2 0          0    0 1/2 0        0     0 ⎟
π0 π1 π2 π3 π4 π5 π6 π7 · ⎜              ⎜                                           ⎟
⎜  1/2    0     0    0     0  1/2   0     0 ⎟
⎟
⎜1/2 0          0    0     0   0 1/2 0 ⎟
⎜                                           ⎟
⎝1/2 0          0    0     0   0    0 1/2⎠
1     0     0    0     0   0    0     0
4
�                       
= π0 π1 π2 π3 π4 π5 π6 π7 .
� that each πj = 2πj+1 for j ∈ {0, 1, 2, 3, 4, 5, 6}.
We ﬁnd                                                   Thus the row vector has the
form 128π7 64π7 32π7 16π7 8π7 4π7 2π7 π7 . and since values add up to 1 we
get π7 = 1/255 and the answer is
�                                                                    
128/255 64/255 32/255 16/255 8/255 4/255 2/255 1/255 .', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Give a Poisson approximation for the probability that 3 ≤ Xj < 4 for exactly 3 of the
values j ∈ {1, 2, . . . , 300}.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The number of values in that interval is
roughly Poisson with parameter λ = 3, so probability we get k = 3 is
9
e−λ λk /k! = e−3 33 /3! =       .
2e3', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the mean and variance of Y = X1 − 2X2 + 3X3 − 4X4 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : By additivity
of expectation, mean is 1 − 2 + 3 − 4 = −2. By additivity of variance for independent random
variables (and fact that Var(X) = Var(−X)), variance is 1 + 4 + 9 + 16 = 30.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute P (Y > 0) in terms of the function Φ(a) =             √1 e−x /2 dx.
−∞    2π
2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Compute P (Y > 0) in terms of the function Φ
√                                                              √           √
it is 2/ 30 standard deviations above its mean, so P (Y > 0) = 1 − Φ(2/ 30) = Φ(−2/ 30).', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Write Zn = Yn2 − n. Compute E[Zn − Zn−1 |X1 , X2 , . . . , Xn−1 ]. You can use the
following calculation to help you get started:
Zn − Zn−1 = (Yn2 − n) − (Yn2−1 − (n − 1)) = Yn2 − Yn2−1 − 1
= (Yn−1 + Xn )2 − Yn2−1 − 1
= 2Yn−1 Xn + Xn2 − 1.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : By additivity of expectation, this is
E[2Yn−1 Xn |X1 , X2 , . . . , Xn−1 ] + E[Xn2 − 1|X1 , X2 , . . . , Xn−1 ]
First term is zero since E[Xn ] is zero, and 2Yn−1 can be treated as a constant for this
conditional expectation calculation (since it is known once X1 , X2 , . . . , Xn−1 is given).
Second term is same as E[Xn2 − 1] (by independence of Xn and X1 , . . . , Xn−1 ) which is zero.
Overall answer is thus zero.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Write S = X1 + X2 + X3 + X4 + X5 . Give an explicit formula for the probability
density function fS .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : We know that T = S/5 is a Cauchy random variable. So
fS (x) = f5T (x) = 15 fT (x/5) = � 1 2  .
5π 1+(x/5)', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute (as an explicit rational number) the probability that X1 + X2 > X3 + 3.
(Hint: remember the spinning ﬂashlight story.)
4', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Since −X3 is also Cauchy,
B = (X1 + X2 − X3 )/3 is Cauchy, and we are computing P (B > 1), which is 1/4.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute E[B 2 ].
5', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : E[B 2 ] = E[ ni=1 Ai nj=1 Aj ] = ni=1 nj=1 E[Ai Aj ]. There
P      P            P P
are (n2 − n) “oﬀ diagonal terms” with i 6= j and n diagonal terms with i = j. Putting them
n               n    n−1
together gives n · 2n−1 + (n2 − n) 2n−1 · 2n−3 .', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the conditional expectation E[X|Y ] as a function of Y .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Once Y is
given, X is conditionally uniform along the segment [0, 1 − Y ]. So E[X|Y ] = (1 − Y )/2.
2', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the moment generating function for Z = X + Y .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Compute the moment
R ∞ generating function
R 1 txfor Z = X   + Y . ANSWER: We know
tX               tx                     t
MX (t) = E[e ] = −∞ fX (x)e dx = 0 e dx = (e − 1)/t. Thus
MX+Y (t) = MX (t)MY (t) = MX (t)2 = (et − 1)2 /t2 .', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Set A = min{X, Y, Z}. Compute the probability density function fA .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : For
3                       3
a ∈ (0, 5), P (A > 5) = P (X > 5, Y > 5, Z > 5) = 5−a        . So FA (a) = 1 − 5−a
�                        �
5                        5     and
0
� 5−a 2
fA (a) = FA (a) = −3(−1/5) 5         for a ∈ (0, 5) and 0 for a 6∈ (0, 5).', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Let X be the number of heads that come up when three independent fair coins are
tossed. Compute the entropy H(X).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : 1�       1 3�     3 3�     3 1�    1
H(X) =      − log   + − log   + − log   + − log .
8        8  8      8  8      8  8     8', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] H(X − Y ) ≥ 0.
9', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée après ta réponse.', 'explanation' => 'Corrigé officiel du MIT : True, since entropy of any random variable is non-negative.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('True', 'False', 'Open question'), 'correct' => 0),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] If the current leader is liberal, there is a 2/3 chance the next leader will be liberal also,
a 1/4 chance the next leader will be conservative, and a 1/12 chance the next leader
will be insane.
(ii) If the currently leader is conservative, there is a 2/3 chance the next leader will be
conservative also, a 1/4 chance the next leader will be liberal, and a 1/12 chance the
next leader will be insane.
(iii) If the currently leader is insane, then there is a 1/2 chance the next leader will be
conservative and a 1/2 chance the next leader will be liberal. (They never allow two
consecutive terms of insanity.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : If the current leader is liberal, there is a 2/3 chance the next leader will be liberal also, a 1/4
chance the next leader will be conservative, and a 1/12 chance the next leader will be insane.
(ii) If the currently leader is conservative, there is a 2/3 chance the next leader will be
conservative also, a 1/4 chance the next leader will be liberal, and a 1/12 chance the next
leader will be insane.
(iii) If the currently leader is insane, then there is a 1/2 chance the next leader will be
conservative and a 1/2 chance the next leader will be liberal. (They never allow two
consecutive terms of insanity.)', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Given that the number of observed ﬁres during Jill’s ﬁrst year in town is 6, what is
Nora’s assessment of the conditional probability that Jill is a witch? Compute your
answer in terms of the p computed in (a).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Let F be event that there are six ﬁres, W event Jill is
a witch. Then
P (W F )             P (W )P (F |W )                 (1/100)
P (W |F ) =            =                        c       c
=                     .
P (F )    P (W )P (F |W ) + P (W )P (F |W )   (1/100) + (99/100)p
Remark: In more realistic variants, “Jill” is a polluting industrial facility and “house ﬁres” are
health problems allegedly caused by pollution.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Give the probability density function for T where T is the length of time until the ﬁrst
bus of any kind shows up.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : This is exponential with parameter λ = 6, so
density is fT (x) = 6e−6x for x ≥ 0.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Suppose that a yellow bus would get Ivan home in 30 minutes (from the time it arrives
at the bus stop until the time it gets to his house) while either a red or a blue bus
would get Ivan home in 15 minutes (from the time it picks Ivan up at the bus stop until
the time it gets to his house). If Ivan wants to minimize the expected amount of time
until he gets home, and a yellow bus arrives ﬁrst, should he get on the yellow bus or
should he wait for a red/blue bus to come? Give a sentence or two of explanation.
3', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : If he holds out for a red/blue bus, it will take 20 minutes to arrive (in
expectation) but only shorten transit duration for 15 minutes. So he is better oﬀ (in
expectation) taking the bird in hand (i.e., getting on the yellow bus).
1', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the mean, variance and standard deviation of S100 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : By
additivity of mean and variance (for independent sums) we get E[S100 ] = 10 and
Var(S100 ) = 25 so SD(S100 ) = 5.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Represent the employment activity as a Markov chain by writing down an 8 by 8
transition matrix with states numbered 0 (unemployment) or 1 to 7 (the companies).
You don’t have to write out all 64 terms. Just write the non-zero terms.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : ⎛                                               ⎞
3/10 1/10 1/10 1/10 1/10 1/10 1/10 1/10
⎜1/70 69/70   0     0     0     0     0     0 ⎟
⎜                                               ⎟
⎜1/70   0   69/70   0     0     0     0     0 ⎟
⎜                                               ⎟
⎜1/70   0     0   69/70   0     0     0     0   ⎟
⎜                                               ⎟
⎜1/70   0     0     0   69/70   0     0     0 ⎟
⎜                                               ⎟
⎜1/70   0     0     0     0   69/70   0     0 ⎟
⎜                                               ⎟
⎝1/70   0     0     0     0     0   69/70   0 ⎠
1/70   0     0     0     0     0     0   69/70', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute (π0 , π1 , π2 , . . . , π7 ) where πi is the fraction of months spent in state i over the
long term. [Hint: start by working out π0 .]
5', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Imagine we just focus on two
states (U for unemployed or E for employed), and note that this is still a Markov
chain. So we have                                       
�          3/10 7/10           �       
πU πE                       = πU πE ,
1/70 69/70
and ﬁrst equation we get from matrix is (3/10)πU + (1/70)πE = πU , which implies
(1/70)πE = (7/10)πU , so πE = 49πU . Combining with πE + πU = 1 we ﬁnd πE = .98
and πU = .02. Now using symmetry (all seven companies are equally likely) we ﬁnd
π0 = .02 and πj = .98/7 = .14 for j ∈ {1, 2, . . . , 7}.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Let Y be the total number of callers during the day who want to purchase a new
toaster. So Y is a random integer between 0 and 100. Write Z = Y 2 . Compute the
entropy H(Z). You can write this as a sum; no need to compute an explicit number.
6
1', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Observe that H(Z) = H(Y ) since the map x → x2 is one to one when we
restrict to the set {0, 1, 2, . . . , 100}.� Next
 note that Y is a binomial random variable
with P (Y = k) = (1/4)k (3/4)100−k 100       k  for k ∈ {0, 1, . . . , 100} so
100                                                
X
k     100−k    100           k     100−k 100
H(Z) = H(Y ) = −           (1/4) (3/4)             log (1/4) (3/4)             .
k                         k
k=0
1', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the probability density function for S10 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : We recall that S10 /10
1
has the same law as X1 , so S10 has the same law as 10X1 . So density is 10π(1+(x/10)2) .', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the probability that the sequence S0 , S1 , S2 , . . . reaches 20 before the ﬁrst
time that it reaches −30.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Let T be the ﬁrst time one of these points is hit.
Then by optional stopping theorem S0 = E[ST ] = 20P (ST = 20) + (−30)P (ST = −30).
We also know P (ST = 20) + P (ST = −30) = 1. Solving for the two unknowns, we ﬁnd
P (ST = 20) = .6 and P (ST = −30) = .4.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the moment generating function MS9 (t).
8', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Compute the moment generating function MS9
9
E[et(X1 +...+X9 ] = 0j=1 E[etXj ] = 12 e2t + 21 e−2t .
Q               �', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] The variance Var[R].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The easiest way to   Pdo this is to
P6observe that the Aj
6
P6 independent
are
1 i−1
of each other. Hence Var(R) = Var( i=1 Ai ) = i=1 Var(Ai ) =
i=1 i · i = 0/1 + 1/4 + 2/9 + 3/16 + 4/25 + 5/36.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Is the sequence X1 , X2 , . . . a martingale? Explain why or why not in one sentence.
P60                P100', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : No, because E[Xn |Fn−1 ] = 0, which is not the same as Xn−1 . In other
words, a person at stage n − 1 knows the true value of Xn−1 but considers (given all
information currently available) that the expectation of Xn is 0, and this is not
generally the same as Xn−1 .', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Write down the probability density function for A.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : This is normal with
2   2                              2
mean zero and variance 60, so density is σ√12π e−x /2σ with σ 2 = 60, i.e., √120π
1
e−x /120', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the expectation and variance of max{X, Y, Z}.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : This is the
radioactive decay problem. Expectation is 1/3 + 1/2 + 1 = 11/6. Variance is
1/9 + 1/4 + 1 = 49/36.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Over the long term, what fraction of mornings does the car start out
in each of the three states, B, S, and W ?
7', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Row vector π
such
s 1 1that1 πM = π (with components of π summing to one) is
3  3  3 .', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] What is the the probability that Yn reaches 8 before the first time
that it reaches 18 ?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : What is the the probability that Yn reaches 8 before the ﬁrst time
that it reaches 18 ? ANSWER: sequences is martingale, so
1 = EYT = 8p + (1/8)(1 − p). Solving gives 1 − 8p = (1 − p)/8, so
8 − 64p = 1 − p and 63p = 7. Answer is p = 1/9.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] If X1 , . . . , Xn are independent copies of X, and
Z = max{X1 , X2 , . . . , Xn }, then what is the cumulative distribution
function FZ ?
2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : FX1 (a) = (a + 1)/2 for a ∈ [−1, 1]. Thus
a+1 n
⎧
⎨ 2
⎪          a ∈ [−1, 1]
FZ (a) = FX1 (a)FX2 (a) . . . FXn (a) = 0         a < −1
⎪
1        a>1
⎩', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] If the bench is empty, then by the next minute it has a 1/2 chance of
being empty, a 1/4 chance of being occupied by 1 person, and a 1/4
chance of being occupied by 2 people.
(ii) If it has 1 person, then by the next minute it has 1/4 chance of being
empty and a 3/4 chance of remaining occupied by 1 person.
(iii) If it has 2 people then by the next minute it has 1/4 chance of being
empty and a 3/4 chance of remaining occupied by 2 people.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : If the bench is empty, then by the next minute it has a 1/2 chance of
being empty, a 1/4 chance of being occupied by 1 person, and a 1/4
chance of being occupied by 2 people.
(ii) If it has 1 person, then by the next minute it has 1/4 chance of being
empty and a 3/4 chance of remaining occupied by 1 person.
(iii) If it has 2 people then by the next minute it has 1/4 chance of being
empty and a 3/4 chance of remaining occupied by 2 people.
1', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] What is the probability that Yn reaches 65 before the first time that
it reaches −15?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : What is the probability that Yn reaches 65 before the ﬁrst time that
it reaches −15? ANSWER: Yn is a martingale, so by the optional
E T ] = Y0 = 1 (where
stopping theorem, we have E[Y
T = min n : Yn ∈ {−15, 65} ). We thus ﬁnd
0 = Y0 = E[YT ] = 65p + (−15)(1 − p) so 80p = 15 and p = 3/16.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Express E[cos(X 2 Y 3 )] as a double integral. (You don’t have to
explicitly evaluate the integral.)
6', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Express E[cos(X 2 Y 3 )] as a double integral. (You don’t have to
explicitly
e ∞ e ∞ evaluate       the integral.) ANSWER:
cos(x2 y 3 ) · 2e−2x · 2e−2y dydx
0   0', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the conditional expectation E[X2 |Z] as a function of Z (for
Z ∈ {3, 4, 5, . . . , 18}).
7', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Note that
E[X1 + X2 + X3 |Z] = E[Z|Z] = Z. So by symmetry and additivity
of conditional expectation we ﬁnd E[X2 |Z] = Z/3.
3', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the moment generating function for the sum         i=1 Xi .
8', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Compute the moment generating function for the sum ni=1 Xi .
e
t   n
ANSWER: e −1    t', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the entropies H(X) and H(Y ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : H(X) = −(1/2) log 12 − (1/2) log 21 = − log 21 = log 2. Similarly,
H(Y ) = −(1/3) log 13 − (1/3) log 31 − (1/3) log 31 = − log 31 = log 3.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] What is the the probability that Yn reaches 4 before the first time
1
that it reaches 64 ?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : What is the the probability that Yn reaches 4 before the ﬁrst time
1
that it reaches 64 ? ANSWER: Yn is a martingale, so by the
optional stopping theorem, EE[YT ] = Y0 = 1 (where
T = min n : Yn ∈ {1/64, 4} ). Thus E[YT ] = 4p + (1/64)(1 − p) = 1.
Solving yields p = 63/255 = 21/85.
4', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute P (X < 1).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : X is a Cauchy random variable, so the answer is 3/4 by
our spinning ﬂashlight story. Recall that in that story, we draw a line from (0, 1) with a
uniformly chosen angle and its intersection with R is a Cauchy random variable. The angle
range corresponding to (−∞, 1) is 3/4 of the total range, so the answer is 3/4.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute E[e−X −Y ]. You can leave your answer as a double
integral—no need to evaluate it explicitly.
5', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Compute E[e−X −Y ]. YouR canR leave your answer as a double integral—no need to evaluate
∞     ∞     1        1       −x2 −y 2 dxdy
it explicitly. ANSWER: −∞ −∞ π(1+x     2 ) π(1+y 2 ) e', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] The moment generating function MS (t).
6', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The moment generating function MS
sum of independent random variables is the product
 of the moment generating functions of
1 t    2t  3t  4t   5t    6t
10
the individual random variables. Hence MS (t) = 6 (e + e + e + e + e + e ) .', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the conditional expectation E[Y |Z]. That is, express the
random variable E[Y |Z] in terms of Z.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : We have Z = E[Z|Z] = E[X|Z] + E[Y |Z]. Since E[X|Z] and
E[Y |Z] are the same by symmetry, the answer must be Z/2.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Use the central limit theorem to approximate the probability that X > Y (so that the
vendor Rcorrectly identiﬁes the more eﬀective photo). You may use the function
a           2
φ(a) = −∞ √12π e−x /2 dx in your answer.
            ', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Use the central limit theorem to approximate the probability that X > Y (so thatR a the vendor
2
correctly identiﬁes the more eﬀective photo). You may use the function φ(a) = −∞ √12π e−x /2 dx in
your answer. ANSWER: (X − Y ) = 50
P
i=1 (Xi − Yi ) is approximately normal with expectation
50(16 − 14) = 100 and variance Var(X) + Var(−Y ) = 50 · 100 + 50 · 100 = 100000 and hence
standard deviation 100. Since 0 is one standard deviation below E[(X − Y )] we have
Z ∞
1      2
P (X − Y ) > 0 ≈      √ e−x /2 dx = 1 − φ(−1) − φ(1) ≈ .84.
−1   2π
             ', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute E[(X − Y )2 ].
2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Var(X − Y ) = E[(X − Y )2 ] − E[(X − Y )]2 , so
E[(X − Y )2 ] = Var(X − Y ) + E[(X − Y )]2 = 10000 + 10000 = 20000.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the expected number of islanders who at some point have exactly 25 apples.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Write S = min n : Ajn ∈ {0, 25} . Write p = P (ASj = 25). Then the optional stopping theorem

implies 10 = 25p + (1 − p) · 0 and solving gives p = .4. Each person has a .4 chance reach 25, so (by
additivity of expectation) the expected number is .4 · 10 = 4.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the probability that the overall winner is someone who at some point in the
game only had one apple. (Hint: let Bj be the event that the jth islander’s apple count
drops to 1 before subsequently rising to 100. Observe that B1 , B2 , . . . , B10 are disjoint.)
3', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : By similar
analysis to (b) and (c), the jth islander has a 90/99 = 10/11 chance to reach 1 before 100, and
given that has a 1/100 chance to reach 100. Multiplying, we ﬁnd P (Bj ) = 1/110, and since the Bj
are disjoint we have P (∪10
j=1 Bj ) = 1/11.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Let N be the total number of interrogations performed (including the ﬁnal
interrogation, the one that produces the confession). Compute P (N = k) for
k ∈ {1, 2, 3, . . .} and compute E[N ].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : P (N = k) = (1 − .18)k−1 · .18. This is geometric with parameter p = .18 so
E[N ] = 1/p = 100/18 = 50/9.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Let D be the number of hats that get dirty. Compute E[D] and Var[D].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : D is binomial
with n = 8 and p = 1/2. We have E[D] = np = 8/2 = 4 and Var[D] = npq = 8(1/2)(1/2) = 2.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute C(K) as a function of K for K ∈ [0, 10]. (Hint: you might ﬁnd that the
integral you need to compute to ﬁnd C(K) is the area of a triangle.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Compute C(K) as a function of K for K ∈ [0, 10]. (Hint: you might ﬁnd that the integral you need
to compute
R 10to1 ﬁnd C(K) is the area1ofR a10 triangle.) ANSWER:
1
C(K) = 0 10 max{x − K, 0}dx = 10 K (x − K)dx = 10          (10 − K)2 /2.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Let c be a ﬁxed constant and write Yn =              i=1 Xi − cn. (So Y0 = 0.) For which (if
any) values of c is the sequence Y0 , Y1 , Y2 , . . . a martingale?
�                                                  ', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Let c be a ﬁxed constant and write Yn =             i=1 Xi − cn. (So Y0P= 0.) For which (if any) values of
c is the sequence Y0 , Y1 , Y2 , . . . a martingale? ANSWER: Yn = ni=1 (Xi3 − c) is a cumulative sum
of i.i.d. terms and is a martingale only if the terms have expectation zero. Since in general
E[X n ] = n! we have E[Xi3 − c] = 6 − c which is zero if and only if c = 6.
�                                               ', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the correlation coeﬃcient ρ(X1 + X2 + X3 , X2 + X3 + X4 ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Each Xi has
variance one. By independence and covariance bilinearity Cov(X1 +
√ X2 + X3 , X2 + X3 + X4 ) = 2
and Var(X1 + X2 + X3 ) = Var(X2 + X3 + X4 ) = 3 so answer is 2/ 3 · 3 = 2/3.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute the entropy H(X). (The answer is a rational number. Give it explicitly.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The log probability of an outcome is the number of children in that outcome. So the entropy is the
expected number of children, which is (1/2) · 2 + (1/4) · 3 + (1/4) · 4 = 11/4.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Let Y ∈ {G, B} be the gender of the ﬁrst child born. Compute H(Y ), HY (X), and
H(X, Y ). Is it true that H(X, Y ) = H(Y ) + HY (X) in this setting?
10', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : H(Y ) = 1. And
HY (X) = 12 HY =G (X) + 12 HY =B (X). By symmetry of B and G this is the same as HY =G (X)
(which is the conditional entropy given the ﬁrst child is a girl). By same logic as above, this is just
the expected number of children (excluding the ﬁrst) given that the ﬁrst child is a girl, which comes
out to 7/4. And H(X, Y ) = H(X) = 11/4 (since X determines Y , the pair (X, Y ) contains no
more information than X does alone). So the identity holds.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Let N be the number of j ∈ {1, 2, 3, 4, 5} for which Xj > 0. (So N is a random element
of the set {0, 1, 2, 3, 4, 5}.) Compute the moment generating function MN (t).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Let Nj be 1 if
5
Xj > 0 and 0 otherwise. Then MNj (t) = E[etNj ] = 12 e0 + 21 et . And MN (t) = MNj (t)5 = 21 + 21 et .
�', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] Compute P (B).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Either all three are chosen or one �of three    left out and one of
other seven chosen. So 1 + 3 · 7 = 22 possibilities. Answer is 22/ 10

3
2', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.600 — question d’examen, en anglais] After taking her temperature, regardless of what the thermometer
shows, Janet plans to a roll a three-sided die (which takes values in
{0, 1, 2} each with equal probability). If N is the number that comes
up,
 Janet will take N ibuprofen tablets. Compute the expectation
E 2N 3 + 3X 2 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : After taking her temperature, regardless of what the thermometer shows, Janet plans to a
roll a three-sided die (which takes values in {0, 1, 2} each with equal probability). If N is
the
 number that comes up, Janet will take N ibuprofen tablets. Compute the expectation
E 2N 3 + 3X 2 . ANSWER: E[N 3 ] = 13 (0 + 1 + 8) = 3. Additivity of expectation gives
answer: 2 · 3 + 3 · 10002 = 30012.', 'source' => 'MIT OpenCourseWare, 18.600 Probability And Random Variables, Fall 2019 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
						),
					),
				),
			),
		);
	}
}
