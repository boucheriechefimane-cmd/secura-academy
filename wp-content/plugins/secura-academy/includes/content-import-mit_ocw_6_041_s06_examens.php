<?php
/**
 * Questions importees — MIT OpenCourseWare — 6 041 probabilistic systems analysis and applied probability spring 2006
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_041_s06_examens' ) ) {
	function seca_import_mit_ocw_6_041_s06_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-041-s06-examens', 'nom' => 'MIT OpenCourseWare — 6 041 probabilistic systems analysis and applied probability spring 2006', 'url' => 'https://ocw.mit.edu/courses/6-041-probabilistic-systems-analysis-and-applied-probability-spring-2006/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
Borders Book store has been in business for 10 years, and over that period, the store has collected
transaction data on all of its customers. Various marketing teams have been busy using the data
to classify customers in hopes of better understanding customer spending habits.
Marketing Team A has determined that out of their customers, 1/4 are low frequency buyers
(i.e., they don’t come to the store very often). They have also found that out of the low frequency
buyers, 1/3 are high spenders (i.e., they spend a signiﬁcant amount of money in the store), whereas
out of the high frequency buyers only 1/10 are high spenders. Assume each customer is either a low
or high frequency buyer.
Compute the probability that a randomly chosen customer is a high spender.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute the probability that a randomly chosen customer is a high spender.
We use the abbreviations HF, LF, HS, and LS to refer to high frequency, low frequency, high
spender, and low spender. Using the total probability theorem,
P(HS) = P(LF )P(HS | LF ) + P(HF )P(HS | HF )
1 1 3 1
=   · + ·
4 3 4 10
19
=     ≈ .1583
120

[Correction officielle MIT : [MIT 6.041 — question d’examen, en anglais]
Borders Book store has been in business for 10 years, and over that period, the store has collected
transaction data on all of its customers. Various marketing teams have been busy using the data
to classify customers in hopes of better understanding customer spending habits.
Marketing Team A has determined that out of their customers, 1/4 are low frequency buyers
(i.e., they don’t come to the store very often). They have also found that out of the low frequency
buyers, 1/3 are high spenders (i.e., they spend a signiﬁcant amount of money in the store), whereas
out of the high frequency buyers only 1/10 are high spenders. Assume each customer is either a low
or high frequency buyer.
Compute the probability that a randomly chosen customer is a high spender.]', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 6.041 — question d’examen, en anglais]
Borders Book store has been in business for 10 years, and over that period, the store has collected
transaction data on all of its customers. Various marketing teams have been busy using the data
to classify customers in hopes of better understanding customer spending habits.
Marketing Team A has determined that out of their customers, 1/4 are low frequency buyers
(i.e., they don’t come to the store very often). They have also found that out of the low frequency
buyers, 1/3 are high spenders (i.e., they spend a signiﬁcant amount of money in the store), whereas
out of the high frequency buyers only 1/10 are high spenders. Assume each customer is either a low
or high frequency buyer.
Compute the probability that a randomly chosen customer is a high spender.', '_recupere_le' => '2026-11-04T19:55:22.708896+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Compute the probability that a randomly chosen customer is a high spender.
We use the abbreviations HF, LF, HS, and LS to refer to high frequency, low frequency, high
spender')),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
Borders Book store has been in business for 10 years, and over that period, the store has collected
transaction data on all of its customers. Various marketing teams have been busy using the data
to classify customers in hopes of better understanding customer spending habits.
Marketing Team A has determined that out of their customers, 1/4 are low frequency buyers
(i.e., they don’t come to the store very often). They have also found that out of the low frequency
buyers, 1/3 are high spenders (i.e., they spend a signiﬁcant amount of money in the store), whereas
out of the high frequency buyers only 1/10 are high spenders. Assume each customer is either a low
or high frequency buyer.
Compute the probability that a customer is in group C2 or C3 given he/she purchased a book.
Now in addition to the data from Marketing Team B, you are told that each book costs $15,
each CD costs $10, and each DVD costs $15.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute the probability that a customer is in group C2 or C3 given he/she purchased a book.
We use Bayes’ rule.
P(B ∩ (C2 ∪ C3 ))
P(C2 ∪ C3 | B) =
P(B)
P(B ∩ C2 ) + P(B ∩ C3 )
=                                         .
P(B ∩ C1 ) + P(B ∩ C2 ) + P(B ∩ C3 )
To get the second line, we used the fact that C1 , C2 , and C3 are mutually disjoint and
collectively exhaustive. Now, substituting the given numbers,
1 1     1 1
3 · 2 + 3 · 3
P(C2 ∪ C3 | B) =       1 1       1 1     1 1
3 · 2 + 3 · 2 + 3 · 3
5
=     = .625
8
Now in addition to the data from Marketing Team B, you are told that each book costs $15,
each CD costs $10, and each DVD costs $15.

[Correction officielle MIT : [MIT 6.041 — question d’examen, en anglais]
Borders Book store has been in business for 10 years, and over that period, the store has collected
transaction data on all of its customers. Various marketing teams have been busy using the data
to classify customers in hopes of better understanding customer spending habits.
Marketing Team A has determined that out of their customers, 1/4 are low frequency buyers
(i.e., they don’t come to the store very often). They have also found that out of the low frequency
buyers, 1/3 are high spenders (i.e., they spend a signiﬁcant amount of money in the store), whereas
out of the high frequency buyers only 1/10 are high spenders. Assume each customer is either a low
or high frequency buyer.
Compute the probability that a customer is in group C2 or C3 given he/she purchased a book.
Now in addition to the data from Marketing Team B, you are told that each book costs $15,
each CD costs $10, and each DVD costs $15.]', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 6.041 — question d’examen, en anglais]
Borders Book store has been in business for 10 years, and over that period, the store has collected
transaction data on all of its customers. Various marketing teams have been busy using the data
to classify customers in hopes of better understanding customer spending habits.
Marketing Team A has determined that out of their customers, 1/4 are low frequency buyers
(i.e., they don’t come to the store very often). They have also found that out of the low frequency
buyers, 1/3 are high spenders (i.e., they spend a signiﬁcant amount of money in the store), whereas
out of the high frequency buyers only 1/10 are high spenders. Assume each customer is either a low
or high frequency buyer.
Compute the probability that a customer is in group C2 or C3 given he/she purchased a book.
Now in addition to the data from Marketing Team B, you are told that each book costs $15,
each CD costs $10, and each DVD costs $15.', '_recupere_le' => '2026-11-04T19:55:22.709217+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Compute the probability that a customer is in group C2 or C3 given he/she purchased a book.
We use Bayes’ rule.
P(B ∩ (C2 ∪ C3 ))
P(C2 ∪ C3 | B) =
P(B)
P(B ∩ C2 ) + P(B ∩ C3')),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(30 points, Each question is equally weighted at 6 points each)
The deer process is a Poisson process of arrival rate 8 (λD = 8). The elephant process is a Poisson
process of arrival rate 2 (λE = 2).
At the end of 3 hours, you have seen 24 deer but no elephants. What is the probability that you
will see an elephant in the next hour?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 1 − e−2
Page 6 of 12
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Spring 2006)
Since the deer arrival process is independent of the elephant arrival process, the event that “several
deer arrive by the end of 3 hours” is independent of any event deﬁned on the elephant arrival process.
Let T1 denote the ﬁrst arrival time. Then the desired probability can be expressed as
P[ an elephant arrival in the next hour | no elephant arrival by the end of 3 hours ]
= P[ T1 ≤ 4 | T1 > 3 ]
= 1 − P[ T1 > 4 | T1 > 3 ]
= 1 − P[ T1 > 1 ]                                                                           (3)
−2
= 1−e         .
Step (3) follows from the memoryless property of the Poisson process.

[Correction officielle MIT : [MIT 6.041 — question d’examen, en anglais]
(30 points, Each question is equally weighted at 6 points each)
The deer process is a Poisson process of arrival rate 8 (λD = 8). The elephant process is a Poisson
process of arrival rate 2 (λE = 2).
At the end of 3 hours, you have seen 24 deer but no elephants. What is the probability that you
will see an elephant in the next hour?]', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 6.041 — question d’examen, en anglais]
(30 points, Each question is equally weighted at 6 points each)
The deer process is a Poisson process of arrival rate 8 (λD = 8). The elephant process is a Poisson
process of arrival rate 2 (λE = 2).
At the end of 3 hours, you have seen 24 deer but no elephants. What is the probability that you
will see an elephant in the next hour?', '_recupere_le' => '2026-11-04T19:55:22.709354+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : 1 − e−2
Page 6 of 12
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Spring 2006)
Since the deer arrival process is indep')),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(28 points, Each question is equally weighted at 4 points each)
Graph the minimum state Markov chain model for the MIT football team’s performance. Be sure
to label all transition probabilities, and clearly indicate what state of the world each Markov state
represents. You may ﬁnd it convenient for the below questions to label each state with an integer.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The performance of the MIT football team is described by a Markov chain, where the state is
taken to be
(result of the game before the last game, result of the last game) .
There are four possible states: {W W, W L, LW, LL}. The corresponding transition probability graph
is We use throughout this problem the following labels for the four states.
2:WL
0.6
0.3
0.7                 0.4              0.4         4:LL
1:WW                                                  0.7
0.6                          0.3
3:LW
WW = 1,         WL = 2,            LW = 3 ,         LL = 4 .
Then we have the probability transition matrix as follows
⎛                         ⎞
0.7 0.3 0   0
⎜ 0    0 0.4 0.6 ⎟
⎜                ⎟
P = [ pij ]4×4 = ⎜                ⎟,
⎝ 0.6 0.4 0   0 ⎠
0   0 0.3 0.7
where pij is the transition probability from state i to state j.

[Correction officielle MIT : [MIT 6.041 — question d’examen, en anglais]
(28 points, Each question is equally weighted at 4 points each)
Graph the minimum state Markov chain model for the MIT football team’s performance. Be sure
to label all transition probabilities, and clearly indicate what state of the world each Markov state
represents. You may ﬁnd it convenient for the below questions to label each state with an integer.]', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 6.041 — question d’examen, en anglais]
(28 points, Each question is equally weighted at 4 points each)
Graph the minimum state Markov chain model for the MIT football team’s performance. Be sure
to label all transition probabilities, and clearly indicate what state of the world each Markov state
represents. You may ﬁnd it convenient for the below questions to label each state with an integer.', '_recupere_le' => '2026-11-04T19:55:22.709487+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The performance of the MIT football team is described by a Markov chain, where the state is
taken to be
(result of the game before the last game, result of the last game) .
T')),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(28 points, Each question is equally weighted at 4 points each)
The coach decides that he will withdraw the team from the competition immediately after the
team’s 3rd consecutive loss (i.e. three losses in a row). Let N be the number of games that the
team will play in the competition? Write a system of equations that can be used to ﬁnd E[N ].
Page 8 of 8', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : t3 = 1 + 0.6t1 + 0.4t2 ,
⎪
⎪
⎪
⎪  t4 = 1 + 0.3t3
⎪
⎩
t5 = 0
Three losses in a row can only be reached from state LL. Following this observation, we create a ﬁfth
state LLL (labeled 5) and construct the following Markov transition graph. The probability
transition matrix of this Markov chain is
⎛                               ⎞
0.7 0.3 0   0  0
⎜ 0    0 0.4 0.6 0 ⎟
⎜                  ⎟
⎜                  ⎟
P = [ pij ]4×4 = ⎜ 0.6 0.4 0   0  0 ⎟,
⎜                  ⎟
⎝ 0    0 0.3 0 0.7 ⎠
0   0 0.3 0   1
Page 11 of 12
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Spring 2006)
2:WL
0.6
0.3
0.7
0.7                   0.4          0.4
1:WW                                   4:LL         5:LLL      1
0.6                       0.3
3:LW
The number of games played by the MIT football team corresponds to the absorption time from
state 1 to state 5. Denote the average absorption time to state 5 as t1 , t2 , t3 , t4 , t5 . The linear
equation system is as follows.      ⎧
⎪
⎪  t1 = 1 + 0.7t1 + 0.3t2
⎪
⎪
⎪
⎨ t2 = 1 + 0.4t3 + 0.6t4
t3 = 1 + 0.6t1 + 0.4t2 .
⎪
⎪
⎪
⎪  t4 = 1 + 0.3t3
⎪
⎩
t5 = 0
Page 12 of 12

[Correction officielle MIT : [MIT 6.041 — question d’examen, en anglais]
(28 points, Each question is equally weighted at 4 points each)
The coach decides that he will withdraw the team from the competition immediately after the
team’s 3rd consecutive loss (i.e. three losses in a row). Let N be the number of games that the
team will play in the competition? Write a system of equations that can be used to ﬁnd E[N ].
Page 8 of 8]', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 6.041 — question d’examen, en anglais]
(28 points, Each question is equally weighted at 4 points each)
The coach decides that he will withdraw the team from the competition immediately after the
team’s 3rd consecutive loss (i.e. three losses in a row). Let N be the number of games that the
team will play in the competition? Write a system of equations that can be used to ﬁnd E[N ].
Page 8 of 8', '_recupere_le' => '2026-11-04T19:55:22.709644+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : t3 = 1 + 0.6t1 + 0.4t2 ,
⎪
⎪
⎪
⎪  t4 = 1 + 0.3t3
⎪
⎩
t5 = 0
Three losses in a row can only be reached from state LL. Following this observation, we create a ﬁfth
state LLL (l')),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
Borders Book store has been in business for 10 years, and over that period, the store has collected
transaction data on all of its customers. Various marketing teams have been busy using the data
to classify customers in hopes of better understanding customer spending habits.
Marketing Team A has determined that out of their customers, 1/4 are low frequency buyers
(i.e., they don’t come to the store very often). They have also found that out of the low frequency
buyers, 1/3 are high spenders (i.e., they spend a signiﬁcant amount of money in the store), whereas
out of the high frequency buyers only 1/10 are high spenders. Assume each customer is either a low
or high frequency buyer.
Compute the probability that a customer purchases a book or a CD.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Compute the probability that a customer purchases a book or a CD.
We use the abbreviations B, C, D for buying a book, CD, or DVD. P(B ∪ C) = P(B) + P(C)
because a customer can only buy 1 item, and hence B and C are disjoint. Applying the total
probability theorem,
P(B) = P(C1 )P(B | C1 ) + P(C2 )P(B | C2 ) + P(C3 )P(B | C3 )
1 1 1 1 1 1
=   · + · + ·
3 2 3 2 3 3
4
=   ≈ 0.4444
9
Similarly,
P(C) = P(C1 )P(C | C1 ) + P(C2 )P(C | C2 ) + P(C3 )P(C | C3 )
1 1 1          1 1
=   · + ·0+ ·
3 4 3          3 3
7
=    ≈ 0.1944
36
So, P(B ∪ C) = 49 + 367
= 23
36 ≈ .639. (Note: Alternatively, we could have used the fact that
B and C are conditionally disjoint given C1 , C2 , or C3 . Then, we could just add together the
conditional probabilities. This would give the formula P(B ∪ C) = 31 · ( 12 + 41 ) + 13 · ( 21 + 0) +
1     1   1
3 · ( 3 + 3 ).)

[Correction officielle MIT : [MIT 6.041 — question d’examen, en anglais]
Borders Book store has been in business for 10 years, and over that period, the store has collected
transaction data on all of its customers. Various marketing teams have been busy using the data
to classify customers in hopes of better understanding customer spending habits.
Marketing Team A has determined that out of their customers, 1/4 are low frequency buyers
(i.e., they don’t come to the store very often). They have also found that out of the low frequency
buyers, 1/3 are high spenders (i.e., they spend a signiﬁcant amount of money in the store), whereas
out of the high frequency buyers only 1/10 are high spenders. Assume each customer is either a low
or high frequency buyer.
Compute the probability that a customer purchases a book or a CD.]', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 6.041 — question d’examen, en anglais]
Borders Book store has been in business for 10 years, and over that period, the store has collected
transaction data on all of its customers. Various marketing teams have been busy using the data
to classify customers in hopes of better understanding customer spending habits.
Marketing Team A has determined that out of their customers, 1/4 are low frequency buyers
(i.e., they don’t come to the store very often). They have also found that out of the low frequency
buyers, 1/3 are high spenders (i.e., they spend a signiﬁcant amount of money in the store), whereas
out of the high frequency buyers only 1/10 are high spenders. Assume each customer is either a low
or high frequency buyer.
Compute the probability that a customer purchases a book or a CD.', '_recupere_le' => '2026-11-04T19:55:22.709907+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Compute the probability that a customer purchases a book or a CD.
We use the abbreviations B, C, D for buying a book, CD, or DVD. P(B ∪ C) = P(B) + P(C)
because a customer ca')),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
Borders Book store has been in business for 10 years, and over that period, the store has collected
transaction data on all of its customers. Various marketing teams have been busy using the data
to classify customers in hopes of better understanding customer spending habits.
Marketing Team A has determined that out of their customers, 1/4 are low frequency buyers
(i.e., they don’t come to the store very often). They have also found that out of the low frequency
buyers, 1/3 are high spenders (i.e., they spend a signiﬁcant amount of money in the store), whereas
out of the high frequency buyers only 1/10 are high spenders. Assume each customer is either a low
or high frequency buyer.
What’s the daily expected revenue from Skipper? What’s the variance of the daily revenue
from Skipper?
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Spring 2006)', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : What’s the daily expected revenue from Skipper?
The crucial observation is that Skipper’s revenue can be broken down as the sum of two
independent shifted geometric random variables. Let X1 and X2 be 2 independent geometric
random variables with paramater p = 12 . Let R be the total daily revenue from Skipper. We
ﬁnd R = 15(X1 − 1) + 15(X2 − 1), and thus E[R] = 15(E[X1 ] + E[X2 ]) − 30 = $30, where
we’ve used E[Xi ] = 11 . Likewise we ﬁnd var(R) = 152 (var(X1 ) + var(X2 )) = $900, where
2
1− 12
we’ve used var(Xi ) =           2   .
( 12 )
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Spring 2006)

[Correction officielle MIT : [MIT 6.041 — question d’examen, en anglais]
Borders Book store has been in business for 10 years, and over that period, the store has collected
transaction data on all of its customers. Various marketing teams have been busy using the data
to classify customers in hopes of better understanding customer spending habits.
Marketing Team A has determined that out of their customers, 1/4 are low frequency buyers
(i.e., they don’t come to the store very often). They have also found that out of the low frequency
buyers, 1/3 are high spenders (i.e., they spend a signiﬁcant amount of money in the store), whereas
out of the high frequency buyers only 1/10 are high spenders. Assume each customer is either a low
or high frequency buyer.
What’s the daily expected revenue from Skipper? What’s the variance of the daily revenue
from Skipper?
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Spring 2006)]', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 6.041 — question d’examen, en anglais]
Borders Book store has been in business for 10 years, and over that period, the store has collected
transaction data on all of its customers. Various marketing teams have been busy using the data
to classify customers in hopes of better understanding customer spending habits.
Marketing Team A has determined that out of their customers, 1/4 are low frequency buyers
(i.e., they don’t come to the store very often). They have also found that out of the low frequency
buyers, 1/3 are high spenders (i.e., they spend a signiﬁcant amount of money in the store), whereas
out of the high frequency buyers only 1/10 are high spenders. Assume each customer is either a low
or high frequency buyer.
What’s the daily expected revenue from Skipper? What’s the variance of the daily revenue
from Skipper?
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Spring 2006)', '_recupere_le' => '2026-11-04T19:55:22.710211+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : What’s the daily expected revenue from Skipper?
The crucial observation is that Skipper’s revenue can be broken down as the sum of two
independent shifted geometric random va')),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(30 points, Each question is equally weighted at 6 points each)
The deer process is a Poisson process of arrival rate 8 (λD = 8). The elephant process is a Poisson
process of arrival rate 2 (λE = 2).
It is now 6 hours since you started watching. You have seen 53 deer but there is still no sight of
an elephant. How many more deer do you expect to see before you see your ﬁrst elephant?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 4
As in part (b), regarding the arrival of elephant as “success”, it forms a Bernoulli process, with
parameter p = 51 . Owing to the memoryless property, given that no “success” in the ﬁrst 53 trials
(have seen 53 deer but no elephant), the number of trials, X1 , up to and including the ﬁrst “success”
is still a geometrical random variable with parameter p = 15 . Since the number of “failures” (deers)
before the ﬁrst “success” (elephant) is X1 − 1, then
1
E[ number of more deers before the ﬁrst elephant ] = E[ X1 − 1 ] =     − 1 = 4.
p

[Correction officielle MIT : [MIT 6.041 — question d’examen, en anglais]
(30 points, Each question is equally weighted at 6 points each)
The deer process is a Poisson process of arrival rate 8 (λD = 8). The elephant process is a Poisson
process of arrival rate 2 (λE = 2).
It is now 6 hours since you started watching. You have seen 53 deer but there is still no sight of
an elephant. How many more deer do you expect to see before you see your ﬁrst elephant?]', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 6.041 — question d’examen, en anglais]
(30 points, Each question is equally weighted at 6 points each)
The deer process is a Poisson process of arrival rate 8 (λD = 8). The elephant process is a Poisson
process of arrival rate 2 (λE = 2).
It is now 6 hours since you started watching. You have seen 53 deer but there is still no sight of
an elephant. How many more deer do you expect to see before you see your ﬁrst elephant?', '_recupere_le' => '2026-11-04T19:55:22.710362+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : 4
As in part (b), regarding the arrival of elephant as “success”, it forms a Bernoulli process, with
parameter p = 51 . Owing to the memoryless property, given that no “succe')),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(28 points, Each question is equally weighted at 4 points each)
Find a good approximation to the probability that the team will win its 1000th game, given that
the outcomes of games 1000 and 1001 are the same. Clearly state any assumptions you use in the
approximation.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 2
Recall that Xn denotes the outcome of the nth game. The desired probability is
P[ X1000 = W | X1000 = X1001 ]
P[ X1000 = X1001 = W ]
=
P[ X1000 = X1001 ]
P[ X1000 = X1001 = W ]
=
P[ X1000 = X1001 = W ] + P[ X1000 = X1001 = L ]
π1
≈         ,                                                         (5)
π1 + π4
which evaluates to be 12 .
Page 10 of 12
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Spring 2006)
⎧
⎪
⎪ t1    = 1 + 0.7 · t1 + 0.3 · t2
⎪
⎨   t2 = 1 + 0.4 · t3
(f )                                  .
⎪
⎪  t3 = 1 + 0.6 · t1 + 0.4 · t2
⎪
⎩
t4 = 0
T is the ﬁrst passage time from state 1 to state 4. Let µ1 , µ2 , µ3 , µ4 be the average ﬁrst passage time
from each state to state 4. We have that E[T ] = µ1 Since we are concerned with the ﬁrst passage
time to state 4, the Markov chain’s behavior from state 4 is irrelevant. Therefore, we focus on the
modiﬁed Markov chain graph where state 4 is converted to an absorbing state. The average ﬁrst
2:WL
0.6
0.3
0.7                     0.4          0.4
1:WW                                    4:LL       1
0.6
3:LW
passage time to state 4 in the original Markov chain is equal to the average absorption time to state 4
in the modiﬁed Markov chain. The required linear equation system is
⎧
⎪
⎪ t1 = 1 + 0.7 · t1 + 0.3 · t2
⎪
⎨ t2 = 1 + 0.4 · t3
.
⎪
⎪ t3 = 1 + 0.6 · t1 + 0.4 · t2
⎪
⎩
t4 = 0
(Though not asked in the problem, we get the solution that µ1 = 7, µ2 = 11        20
3 , µ3 = 3 ).
⎧
⎪
⎪ t1   = 1 + 0.7t1 + 0.3t2
⎪
⎪
⎪
⎨ t2   = 1 + 0.4t3 + 0.6t4

[Correction officielle MIT : [MIT 6.041 — question d’examen, en anglais]
(28 points, Each question is equally weighted at 4 points each)
Find a good approximation to the probability that the team will win its 1000th game, given that
the outcomes of games 1000 and 1001 are the same. Clearly state any assumptions you use in the
approximation.]', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'answer' => '[MIT 6.041 — question d’examen, en anglais]
(28 points, Each question is equally weighted at 4 points each)
Find a good approximation to the probability that the team will win its 1000th game, given that
the outcomes of games 1000 and 1001 are the same. Clearly state any assumptions you use in the
approximation.', '_recupere_le' => '2026-11-04T19:55:22.710470+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : 2
Recall that Xn denotes the outcome of the nth game. The desired probability is
P[ X1000 = W | X1000 = X1001 ]
P[ X1000 = X1001 = W ]
=
P[ X1000 = X1001 ]
P[ X1000 = X1001 =')),
						),
					),
				),
			),
		);
	}
}
