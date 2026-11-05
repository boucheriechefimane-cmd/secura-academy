<?php
/**
 * Questions importees — MIT OpenCourseWare — 18 440 probability and random variables spring 2014
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_18_440_examens' ) ) {
	function seca_import_mit_ocw_18_440_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-18-440-examens', 'nom' => 'MIT OpenCourseWare — 18 440 probability and random variables spring 2014', 'url' => 'https://ocw.mit.edu/courses/18-440-probability-and-random-variables-spring-2014/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Lisa’s truck has three states: broken (in Lisa’s possession),
working (in Lisa’s possession), and in the shop. Denote these states B, W,
and S.
Write the three-by-three Markov transition matrix for this problem.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Write the three-by-three Markov transition matrix for this problem.
ANSWER: Ordering the states B, W, S, we may write the Markov
chain matrix as         ⎛           ⎞
.5 0 .5
M = ⎝.1 .9 0 ⎠ .
0 .5 .5', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Lisa’s truck has three states: broken (in Lisa’s possession),
working (in Lisa’s possession), and in the shop. Denote these states B, W,
and S.
Over the long term, what fraction of mornings does the truck start
out in each of the three states, B, S, and W ?
2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Over the long term, what fraction of mornings does the truck start
out in each of the three states, B, S, and W ? ANSWER: We ﬁnd
the stationarity probability vector π = (πB , πW , πS ) = (1/7, 5/7, 1/7)
by solving πM = π (with components of π summing to 1).', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Suppose that X1 , X2 , X3 , . . . is an inﬁnite sequence of
independent random variables which are each e       equal to 1 with probability
1/2 and −1 with probability 1/2. Write Yn = ni=1 Xi . Answer the
following:
In which of the cases below is the sequence Zn a martingale? (Just
circle the corresponding letters.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : In which of the cases below is the sequence Zn a martingale? (Just
circle the corresponding letters.)
(i) Zn = Xn + Yn ANSWER: NO
n
(ii) Zn =  i=1 (2Xi + 1) ANSWER: YES
(iii) Zn = ni=1 (−Xi + 1) ANSWER: YES
(iv) Zn = ni=1 Yi ANSWER: NO
e
(v) Zn = ni=2 Xi Xi−1 ANSWER: YES
e', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) When Harry’s cell phone is on, the times when he receives
new text messages form a Poisson process with parameter λT = 3/minute.
The times at which he receives new email messages form an independent
Poisson process with parameter λE = 1/minute. He receives personal
messages on Facebook as an independent Poisson process with rate
λF = 2/minute.
Compute the probability that Harry receives 10 new messages total
(including email, text, and Facebook) during his first two minutes of
waiting.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute the probability that Harry receives 10 new messages total
(including email, text, and Facebook) during his ﬁrst two minutes of
waiting. ANSWER: Number total in two minutes is Poisson with
rate λ = 2(λE + λT + λF ) = 12. So answer is
λk e−λ /k! = 1210 e−12 /10!.
2', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) When Harry’s cell phone is on, the times when he receives
new text messages form a Poisson process with parameter λT = 3/minute.
The times at which he receives new email messages form an independent
Poisson process with parameter λE = 1/minute. He receives personal
messages on Facebook as an independent Poisson process with rate
λF = 2/minute.
What is the probability that Harry receives no messages of any kind
during his first five minutes of waiting?
5', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : What is the probability that Harry receives no messages of any kind
during his ﬁrst ﬁve minutes of waiting? ANSWER: Time till ﬁrst
message is exponential with parameter 6. Probability this time
exceeds 5 is e−30 .', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Suppose that X and Y have a joint density function f given
by
1/π x2 + y 2 < 1
f (x, y) =                  .
0   x2 + y 2 ≥ 1
Express E[sin(XY )] as a double integral. (You don’t have to
explicitly evaluate the integral.)
6', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Express E[sin(XY )] as a double integral. (You don’t have to
explicitly evaluate the integral.) ANSWER:
√
1    1−x2
1
√       sin(xy)dydx.
−1   − 1−x2 π', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Let X be the number on a standard die roll (i.e., each of
{1, 2, 3, 4, 5, 6} is equally likely) and Y the number on an independent
standard die roll. Write Z = X + Y .
Compute the conditional expectation E[Y |Z] as a function of Z (for
Z ∈ {2, 3, 4, . . . , 12}).
7', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute the conditional expectation E[Y |Z] as a function of Z (for
Z ∈ {2, 3, 4, . . . , 12}). ANSWER:
Z = E[Z|Z] = E[X + Y |Z] = E[X|Z] + E[Y |Z]. By symmetry,
E[X|Z] = E[Y |Z] = Z/2.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Suppose that Xi are i.i.d. random variables, each of which
assumes a value in {−1, 0, 1}, each with probability 1/3.
Compute the moment generating function for the sum        i=1 Xi .
8', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute the moment generating function for the sum      i=1 Xi .
ANSWER: (e−t + 1 + et )n /3n', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Let X and Y be independent random variables. Suppose X
takes values in {1, 2} each with probability 1/2 and Y takes values in
{1, 2, 3, 4} each with probability 1/4. Write Z = X + Y .
Compute H(X, Z).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute H(X, Z). ANSWER: log 2 + log 4 = log 8 = 3.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Let X be a normal random variable with mean 0 and
variance 1.
Compute E[X 2 + 2X − 5].
10', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute E[X 2 + 2X − 5]. ANSWER:
E[X 2 ] + 2E[X] − 5 = 1 + 0 − 5 = −4.
4', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Let X be a random variable with density function f ,
cumulative distribution function F , variance V and mean M .
If X1 , . . . , Xn are independent copies of X. Compute (in terms of F )
the cumulative distribution function for the largest of the Xi .
4', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If X1 , . . . , Xn are independent copies of X. Compute (in terms of F )
the cumulative distribution function for the largest of the Xi .
ANSWER: F (a)n . This is the probability that all n values are less
than a.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Suppose that X and Y are outcomes of independent
standard die rolls (each equal to {1, 2, 3, 4, 5, 6} with equal probability).
Write Z = X + Y .
1
Compute H(X, Z).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute H(X, Z). ANSWER: log 36 = 2 log 6.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Suppose that X and Y are outcomes of independent
standard die rolls (each equal to {1, 2, 3, 4, 5, 6} with equal probability).
Write Z = X + Y .
1
Compute H(Z) + HZ (Y ). (Hint: you shouldn’t need to do any more
calculations.)
6', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute H(Z) + HZ (Y ). (Hint: you shouldn’t need to do any more
calculations.) ANSWER: log 36', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Elaine’s not-so-trusty old car has three states: broken (in
Elaine’s possession), working (in Elaine’s possession), and in the shop.
Denote these states B, W, and S.
If the car starts out B on one morning, what is the probability that
it will start out B two days later?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If the car starts out B on one morning, what is the probability that
it will start out B two days later? ANSWER: 1/4', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
Suppose that X1 , X2 , X3 , . . . is an inﬁnite sequence of independent
random variables which are each equal to 2 with probability 1/3 and .5
with probability 2/3. Let Y0 = 1 and Yn = ni=1 Xi for n ≥ 1.
2
What is the the probability that Yn reaches 8 before the first time
that it reaches 18 ?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : What is the the probability that Yn reaches 8 before the ﬁrst time
that it reaches 18 ? ANSWER: sequences is martingale, so
1 = EYT = 8p + (1/8)(1 − p). Solving gives 1 − 8p = (1 − p)/8, so
8 − 64p = 1 − p and 63p = 7. Answer is p = 1/9.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
Suppose that X1 , X2 , X3 , . . . is an inﬁnite sequence of independent
random variables which are each equal to 2 with probability 1/3 and .5
with probability 2/3. Let Y0 = 1 and Yn = ni=1 Xi for n ≥ 1.
2
Use the central limit theorem to approximate the probability that
log Y10000 (and hence Y10000 ) is greater than its median value.
8', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Use the central limit theorem to approximate the probability that
log Y10000 (and hence Y10000 ) is greater than its median value.
ANSWER: About .5.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Let X be a uniformly distributed random variable on [−1, 1].
If X1 , . . . , Xn are independent copies of X, and
Z = max{X1 , X2 , . . . , Xn }, then what is the cumulative distribution
function FZ ?
2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If X1 , . . . , Xn are independent copies of X, and
Z = max{X1 , X2 , . . . , Xn }, then what is the cumulative distribution
function FZ ? ANSWER: FX1 (a) = (a + 1)/2 for a ∈ [−1, 1]. Thus
a+1 n
⎧
⎨ 2
⎪          a ∈ [−1, 1]
FZ (a) = FX1 (a)FX2 (a) . . . FXn (a) = 0         a < −1
⎪
1        a>1
⎩', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) A certain bench at a popular park can hold up to two
people. People in this park walk in pairs or alone, but nobody ever sits
down next to a stranger. They are just not friendly in that particular way.
Individuals or pairs who sit on a bench stay for at least 1 minute, and tend
to stay for 4 minutes on average. Transition probabilities are as follows:
If the bench is empty, what is the probability it will be empty two
minutes later?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If the bench is empty, what is the probability it will be empty two
minutes later? ANSWER: 12 12 + 14 14 + 14 14 = 6/16 = 3/8.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) A certain bench at a popular park can hold up to two
people. People in this park walk in pairs or alone, but nobody ever sits
down next to a stranger. They are just not friendly in that particular way.
Individuals or pairs who sit on a bench stay for at least 1 minute, and tend
to stay for 4 minutes on average. Transition probabilities are as follows:
If the bench is empty, then by the next minute it has a 1/2 chance of
being empty, a 1/4 chance of being occupied by 1 person, and a 1/4
chance of being occupied by 2 people.
(ii) If it has 1 person, then by the next minute it has 1/4 chance of being
empty and a 3/4 chance of remaining occupied by 1 person.
(iii) If it has 2 people then by the next minute it has 1/4 chance of being
empty and a 3/4 chance of remaining occupied by 2 people.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If the bench is empty, then by the next minute it has a 1/2 chance of
being empty, a 1/4 chance of being occupied by 1 person, and a 1/4
chance of being occupied by 2 people.
(ii) If it has 1 person, then by the next minute it has 1/4 chance of being
empty and a 3/4 chance of remaining occupied by 1 person.
(iii) If it has 2 people then by the next minute it has 1/4 chance of being
empty and a 3/4 chance of remaining occupied by 2 people.
1', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Suppose that X1 , X2 , X3 , . . . is an inﬁnite sequence of
independent random variables which are each e       equal to 5 with probability
1/2 and −5 with probability 1/2. Write Yn = ni=1 Xi . Answer the
following:
In which of the cases below is the sequence Zn a martingale? (Just
circle the corresponding letters.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : In which of the cases below is the sequence Zn a martingale? (Just
circle the corresponding letters.)
(i) Zn = 5Xn
n
(ii) Zn = 5−n     i=1 Xi
n     2
(iii) Zn =     i=1 Xi
(iv) Zn = 17
(v) Zn = Xn − 4
ANSWER: (iv) only.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Suppose that X and Y are independent exponential random
variables with parameter λ = 2. Write Z = min{X, Y }
Express E[cos(X 2 Y 3 )] as a double integral. (You don’t have to
explicitly evaluate the integral.)
6', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Express E[cos(X 2 Y 3 )] as a double integral. (You don’t have to
explicitly
e ∞ e ∞ evaluate       the integral.) ANSWER:
cos(x2 y 3 ) · 2e−2x · 2e−2y dydx', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Let X1 , X2 , X3 be independent standard die rolls (i.e., each
of {1, 2, 3, 4, 5, 6} is equally likely). Write Z = X1 + X2 + X3 .
Compute the conditional expectation E[X2 |Z] as a function of Z (for
Z ∈ {3, 4, 5, . . . , 18}).
7', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute the conditional expectation E[X2 |Z] as a function of Z (for
Z ∈ {3, 4, 5, . . . , 18}). ANSWER: Note that
E[X1 + X2 + X3 |Z] = E[Z|Z] = Z. So by symmetry and additivity
of conditional expectation we ﬁnd E[X2 |Z] = Z/3.
3', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Suppose that Xi are i.i.d. uniform random variables on [0, 1].
Compute the moment generating function for the sum         i=1 Xi .
8', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute the moment generating function for the sum ni=1 Xi .
e
t   n
ANSWER: e −1    t', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Let X be a normal random variable with mean 0 and
variance 5.
e∞             2
Compute E[X 9 + X 3 − 50X + 7].
9', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute E[X 9 + X 3 − 50X + 7]. ANSWER:
E[X 9 ] = E[X 7 ] = E[X] = 0 by symmetry, so
E[X 9 + X 3 − 50X + 7] = 7.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Let X and Y be independent random variables. Suppose X
takes values {1, 2} each with probability 1/2 and Y takes values {1, 2, 3}
each with probability 1/3. Write Z = X + Y .
Compute H(X, Z).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute H(X, Z). ANSWER:
H(X, Z) = H(X, Y ) = H(X) + H(Y ) = log 6.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Suppose that X1 , X2 , X3 , . . . is an inﬁnite sequence of
independent random variables which are each equal to Q       2 with probability
1/3 and .5 with probability 2/3. Let Y0 = 1 and Yn = ni=1 Xi for n ≥ 1.
What is the the probability that Yn reaches 4 before the first time
1
that it reaches 64 ?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : What is the the probability that Yn reaches 4 before the ﬁrst time
1
that it reaches 64 ? ANSWER: Yn is a martingale, so by the
optional stopping theorem, EE[YT ] = Y0 = 1 (where
T = min n : Yn ∈ {1/64, 4} ). Thus E[YT ] = 4p + (1/64)(1 − p) = 1.
Solving yields p = 63/255 = 21/85.
4', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Suppose that X1 , X2 , X3 , . . . is an inﬁnite sequence of
independent random variables which are each equal to Q       2 with probability
1/3 and .5 with probability 2/3. Let Y0 = 1 and Yn = ni=1 Xi for n ≥ 1.
Compute EY100 .
11
18.440 Probability and Random Variables
Spring 2014
For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute EY100 . ANSWER: Since Yn is a martingale, we have
E[Y100 ] = 1. This can also be derived by noting that for independent
random variables, the expectation of a product is the product of the
expectations.
5
18.440 Probability and Random Variables
Spring 2014
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Lisa’s truck has three states: broken (in Lisa’s possession),
working (in Lisa’s possession), and in the shop. Denote these states B, W,
and S.
If the truck starts out W on one morning, what is the probability
that it will start out B two days later?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If the truck starts out W on one morning, what is the probability
that it will start out B two days later? ANSWER:
(9/10)(1/10) + (1/10)(1/2) = .09 + .05 = .14', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Suppose that X1 , X2 , X3 , . . . is an inﬁnite sequence of
independent random variables which are each e       equal to 1 with probability
1/2 and −1 with probability 1/2. Write Yn = ni=1 Xi . Answer the
following:
What is the probability that Yn reaches 10 before the first time that
it reaches −30?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : What is the probability that Yn reaches 10 before the ﬁrst time that
it reaches −30? ANSWER: Probability p satisﬁes
10p + (−30)(1 − p) = 0, so 40p = 30 and p = 3/4.
1', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) When Harry’s cell phone is on, the times when he receives
new text messages form a Poisson process with parameter λT = 3/minute.
The times at which he receives new email messages form an independent
Poisson process with parameter λE = 1/minute. He receives personal
messages on Facebook as an independent Poisson process with rate
λF = 2/minute.
After catching up on existing messages one morning, Harry begins to
wait for new messages to arrive. Let X be the amount of time (in
minutes) that Harry has to wait to receive his first text message.
Write down the probability density function for X.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : After catching up on existing messages one morning, Harry begins to
wait for new messages to arrive. Let X be the amount of time (in
minutes) that Harry has to wait to receive his ﬁrst text message.
Write down the probability density function for X. ANSWER:
time is exponential with parameter λT = 3, so density function is
f (x) = 3e−3x for x ≥ 0.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) When Harry’s cell phone is on, the times when he receives
new text messages form a Poisson process with parameter λT = 3/minute.
The times at which he receives new email messages form an independent
Poisson process with parameter λE = 1/minute. He receives personal
messages on Facebook as an independent Poisson process with rate
λF = 2/minute.
Let Y be the amount of time elapsed before the third email message.
Compute Var(Y ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let Y be the amount of time elapsed before the third email message.
Compute Var(Y ). ANSWER: Variance of time till email message is
1/λ2E = 1. Memoryless property and additivity of variance of
independent sums gives Var(S) = 3.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Suppose that X and Y have a joint density function f given
by
1/π x2 + y 2 < 1
f (x, y) =                  .
0   x2 + y 2 ≥ 1
Compute the probability density function fX for X.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute the probability density function fX for X. ANSWER:
∞                 1
√
π 2 1 − x2 −1 ≤ x ≤ −1
fX (x) =      f (x, y)dy =
−∞                 0            otherwise', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Let X be the number on a standard die roll (i.e., each of
{1, 2, 3, 4, 5, 6} is equally likely) and Y the number on an independent
standard die roll. Write Z = X + Y .
Compute the conditional probability P [X = 6|Z = 8].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute the conditional probability P [X = 6|Z = 8]. ANSWER:
1/5', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Suppose that Xi are i.i.d. random variables, each of which
assumes a value in {−1, 0, 1}, each with probability 1/3.
Compute the moment generating function for X1 .
Pn', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute the moment generating function for X1 . ANSWER:
EetX1 = (e−t + 1 + et )/3.
3
en', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Let X and Y be independent random variables. Suppose X
takes values in {1, 2} each with probability 1/2 and Y takes values in
{1, 2, 3, 4} each with probability 1/4. Write Z = X + Y .
Compute the entropies H(X) and H(Y ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute the entropies H(X) and H(Y ). ANSWER: log 2 = 1 and
log 4 = 2.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Let X be a normal random variable with mean 0 and
variance 1.
Compute E[eX ].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute E[eX ]. ANSWER:
Z ∞                    Z ∞
1     2              1      2
E(eX ) =       √ e−x /2 ex dx =      √ e−(x −2x+1)/2+1/2 dx =
−∞     2π              −∞    2π
Z ∞
1        2
e1/2     √ e−(x−1) /2 dx = e1/2 .
−∞  2π', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Let X be a random variable with density function f ,
cumulative distribution function F , variance V and mean M .
Compute the mean and variance of 3X + 3 in terms of V and M .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute the mean and variance of 3X + 3 in terms of V and M .
ANSWER: Mean 3M + 3, variance 9V .', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Suppose that X and Y are outcomes of independent
standard die rolls (each equal to {1, 2, 3, 4, 5, 6} with equal probability).
Write Z = X + Y .
1
Compute the entropies H(X) and H(Y ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute the entropies H(X) and H(Y ). ANSWER: log 6 and log 6', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Suppose that X and Y are outcomes of independent
standard die rolls (each equal to {1, 2, 3, 4, 5, 6} with equal probability).
Write Z = X + Y .
1
Compute H(10X + Y ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute H(10X + Y ). ANSWER: log 36 = 2 log 6 (since 36 sums
all distinct).', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Elaine’s not-so-trusty old car has three states: broken (in
Elaine’s possession), working (in Elaine’s possession), and in the shop.
Denote these states B, W, and S.
Write the three-by-three Markov transition matrix for this problem.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Write the three-by-three Markov transition matrix for this problem.
ANSWER: Markov chain matrix is
⎛           ⎞
.5 0 .5
M = ⎝.5 .5 0 ⎠
0 .5 .5', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Elaine’s not-so-trusty old car has three states: broken (in
Elaine’s possession), working (in Elaine’s possession), and in the shop.
Denote these states B, W, and S.
Over the long term, what fraction of mornings does the car start out
in each of the three states, B, S, and W ?
7', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Over the long term, what fraction of mornings does the car start out
in each of the three states, B, S, and W ? ANSWER: Row vector π
such
s 1 1that1 πM = π (with components of π summing to one) is
3  3  3 .', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
Suppose that X1 , X2 , X3 , . . . is an inﬁnite sequence of independent
random variables which are each equal to 2 with probability 1/3 and .5
with probability 2/3. Let Y0 = 1 and Yn = ni=1 Xi for n ≥ 1.
2
Find the mean and variance of log Y10000 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Find the mean and variance of log Y10000 . ANSWER: Compute for
log Y1 , multiply by 10000.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Let X be a normal random variable with mean µ and
variance σ 2 .
2
Find µ, assuming that σ 2 = 3 and E[eX ] = 1.
10', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Find µ, assuming that σ 2 = 3 and E[eX ] = 1. ANSWER:
µ + σ 2 /2 = 0 so µ = −9/2.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) A certain bench at a popular park can hold up to two
people. People in this park walk in pairs or alone, but nobody ever sits
down next to a stranger. They are just not friendly in that particular way.
Individuals or pairs who sit on a bench stay for at least 1 minute, and tend
to stay for 4 minutes on average. Transition probabilities are as follows:
Use E, S, D to denote respectively the states empty, singly occupied,
and doubly occupied. Write the three-by-three Markov transition
matrix for this problem, labeling columns and rows by E, S, and D.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Use E, S, D to denote respectively the states empty, singly occupied,
and doubly occupied. Write the three-by-three Markov transition
matrix for this problem, labeling columns and rows by E, S, and D.
ANSWER:                   ⎛               ⎞
1/2 1/4 1/4
⎝1/4 3/4 0 ⎠
1/4 0 3/4', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) A certain bench at a popular park can hold up to two
people. People in this park walk in pairs or alone, but nobody ever sits
down next to a stranger. They are just not friendly in that particular way.
Individuals or pairs who sit on a bench stay for at least 1 minute, and tend
to stay for 4 minutes on average. Transition probabilities are as follows:
Over the long term, what fraction of the time does the bench spend
in each of the three states?
3', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Over the long term, what fraction of the time does the bench spend
in each of the three states? ANSWER: We know
⎛              ⎞
   1/2 1/4  1/4               
E S D ⎝1/4 3/4 0 ⎠ = E S D
1/4 0 3/4
and E + S + D = 1. Solving gives E = S = D = 1/3.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Suppose that X1 , X2 , X3 , . . . is an inﬁnite sequence of
independent random variables which are each e       equal to 5 with probability
1/2 and −5 with probability 1/2. Write Yn = ni=1 Xi . Answer the
following:
What is the probability that Yn reaches 65 before the first time that
it reaches −15?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : What is the probability that Yn reaches 65 before the ﬁrst time that
it reaches −15? ANSWER: Yn is a martingale, so by the optional
E T ] = Y0 = 1 (where
stopping theorem, we have E[Y
T = min n : Yn ∈ {−15, 65} ). We thus ﬁnd
0 = Y0 = E[YT ] = 65p + (−15)(1 − p) so 80p = 15 and p = 3/16.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Suppose that X and Y are independent exponential random
variables with parameter λ = 2. Write Z = min{X, Y }
Compute the probability density function for Z.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute the probability density function for Z. ANSWER: Z is
exponential with parameter λ + λ = 4 so FZ (t) = 4e−4t for t ≥ 0.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Let X1 , X2 , X3 be independent standard die rolls (i.e., each
of {1, 2, 3, 4, 5, 6} is equally likely). Write Z = X1 + X2 + X3 .
Compute the conditional probability P [X1 = 6|Z = 16].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute the conditional probability P [X1 = 6|Z = 16]. ANSWER:
One can enumerate the six possibilities that add up to 16. These are
(4, 6, 6), (6, 4, 6), (6, 6, 4) and (6, 5, 5), (5, 6, 5), (5, 5, 6). Of these, three
have X1 = 6, so P [X1 = 6|Z = 16] = 1/2.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Suppose that Xi are i.i.d. uniform random variables on [0, 1].
Compute the moment generating function for X1 .
Pn', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute the
e 1 moment  generating function for X1 . ANSWER:
tX        tx      et −1
E(e ) = 0 e dx = t .
1', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Let X be a normal random variable with mean 0 and
variance 5.
e∞             2
Compute E[eX ].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute E[eX ]. ANSWER: E[etX ] = −∞ √5√       1
2π
e−x /(2·5) e−x dx.
A complete the square trick allows one to evaluate this and obtain
e5/2 .', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Let X and Y be independent random variables. Suppose X
takes values {1, 2} each with probability 1/2 and Y takes values {1, 2, 3}
each with probability 1/3. Write Z = X + Y .
Compute the entropies H(X) and H(Y ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute the entropies H(X) and H(Y ). ANSWER:
H(X) = −(1/2) log 12 − (1/2) log 21 = − log 21 = log 2. Similarly,
H(Y ) = −(1/3) log 13 − (1/3) log 31 − (1/3) log 31 = − log 31 = log 3.', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Let X and Y be independent random variables. Suppose X
takes values {1, 2} each with probability 1/2 and Y takes values {1, 2, 3}
each with probability 1/3. Write Z = X + Y .
Compute H(2X 3Y ).
10', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute H(2X 3Y ). ANSWER: Also log 6, since each distinct
(X, Y ) pair gives a distinct number for 2X 3Y .', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.440 — question d’examen, en anglais]
(10 points) Suppose that X1 , X2 , X3 , . . . is an inﬁnite sequence of
independent random variables which are each equal to Q       2 with probability
1/3 and .5 with probability 2/3. Let Y0 = 1 and Yn = ni=1 Xi for n ≥ 1.
Find the mean and variance of log Y400 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Find the mean and variance of log Y400 . ANSWER: log X1 is log 2
with probability 1/3 and − log 2 with probability 2/3. So
1        2            − log 2
E[log X1 ] =     log 2 + (− log 2) =         .
3        3               3
Similarly,
1          2
E[(log X1 )2 ] = (log 2)2 + (− log 2)2 = (log 2)2 .
3          3
Thus,
− log 2 2               1   8
Var(X1 ) = E[(log Xi )2 ]−E[log Xi ]2 = (log 2)2 −              = (log 2)2 (1− ) = (log 2)2 .
3                     9   9
Multiplying, we ﬁnd E[log Y400 ] = 400E[log X1 ] = −400(log 2)/3.
And Var[log Y400 ] = (3200/9)(log 2)2 .', 'source' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.440 Probability And Random Variables, Spring 2014 — examen et corrigé officiel (MIT EECS)'),
						),
					),
				),
			),
		);
	}
}
