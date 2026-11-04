<?php
/**
 * Questions importees — MIT OpenCourseWare — 18 05 introduction to probability and statistics spring 2022
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_18_05_examens' ) ) {
	function seca_import_mit_ocw_18_05_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-18-05-examens', 'nom' => 'MIT OpenCourseWare — 18 05 introduction to probability and statistics spring 2022', 'url' => 'https://ocw.mit.edu/courses/18-05-introduction-to-probability-and-statistics-spring-2022/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(10 pts: 4,6) Concept/Quick questions
(No explanations are necessary.)
The plot shows the pdf for three independent random variables 𝑋, 𝑌 , 𝑊 . All use the same
horizontal and vertical scale.
𝑓𝑌
𝑓𝑊
𝑓𝑋
Which random variable has the greatest variance?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑋.(Variance measures the spread away from the mean.)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(15 pts: 10,5)
You create passwords as a string of 10 characters such that:
• 5 of the characters are letters (upper and lower case, i.e. 52 characters) with repetitions
allowed,
• 3 are numbers { 0,1,2,3,4,5,6,7,8,9 } with repetitions allowed, and
• 2 are distinct symbols from the list of 5 symbols: { !, @, #, $, & }.
With all locations for symbols, letters, or numbers in your 10 character password being
equally likely, what is the probability that the two symbols are next to each other?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Count the ways to get a password where the two symbols are adjacent:
First choose locations for the two symbols: there are 9 adjacent positions.
Then there are 5 ⋅ 4 ways to choose the sequence of two symbols.
8
Then choose the locations of the letters: ( ).
5
Then count the number of ways to choose 5 upper or lower case letters (with replacement)
525 .
3
Then choose the locations of the numbers: ( ).
3
3
Then choose the numbers: 10 .
9 ⋅ (85) ⋅ 5 ⋅ 4 ⋅ 103 ⋅ 525          9   2
So, 𝑃 (two adjacent symbols) =                                     =       =
(10     8              3
2 ) ⋅ (5) ⋅ 5 ⋅ 4 ⋅ 10 ⋅ 52
5        (10
2)
10', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25 pts: 10,5,5,5)
You have 5 four-sided and 3 six-sided dice. You put them in a cup, choose one at random,
roll the die, and report the result.
Let 𝐷 be the number of sides on the chosen die and let 𝑅 be the result of the roll.
What is the probability of rolling a 3?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is the sum of the entries in the 𝑅 = 3 row of the table:
5/32 + 1/16 = 7/32
(Do you see why this has to be between 1/6 and 1/4?)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25 pts: 10,5,5,5)
You have 5 four-sided and 3 six-sided dice. You put them in a cup, choose one at random,
roll the die, and report the result.
Let 𝐷 be the number of sides on the chosen die and let 𝑅 be the result of the roll.
Are 𝐷 and 𝑅 independent?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : No, the joint probabilities in the table are not the products of the marginal
probabilities. The easiest way to see this is to note that 𝑃 (𝑅 = 6 and 𝐷 = 4) = 0, which
does not equal 𝑃 (𝑅 = 6)𝑃 (𝐷 = 4) = 5/128.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25 pts: 5,5,5,5,5)
Two students, Xeno and Yolanda are meeting up for lunch. They plan on a time to meet
at noon. Both have class before so neither will be early. Both have class that starts at 1pm,
so they will both arrive between 0 and 1 hour late. Let 𝑋 be the time in hours that Xeno
arrives late and let 𝑌 be the time in hours that Yolanda arrives late.
Assume that the joint pdf of these random variables is 𝑓(𝑥, 𝑦) = 5/4 − 𝑥𝑦.
Are 𝑋 and 𝑌 independent?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Since the joint pdf is not the product of the marginals, i.e. 𝑓(𝑥, 𝑦) ≠ 𝑓𝑋 (𝑥)𝑓𝑌 (𝑦),
𝑋 and 𝑌 are not independent.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25 pts: 5,5,5,5,5)
Two students, Xeno and Yolanda are meeting up for lunch. They plan on a time to meet
at noon. Both have class before so neither will be early. Both have class that starts at 1pm,
so they will both arrive between 0 and 1 hour late. Let 𝑋 be the time in hours that Xeno
arrives late and let 𝑌 be the time in hours that Yolanda arrives late.
Assume that the joint pdf of these random variables is 𝑓(𝑥, 𝑦) = 5/4 − 𝑥𝑦.
Compute the covariance Cov(𝑋, 𝑌 ) and correlation Cor(𝑋, 𝑌 ).
Hint: By symmetry you know the mean and variance of 𝑌 are the same as those for 𝑋.
For this part, there is no need to simplify fractions.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : By symmetry, we know 𝐸[𝑌 ] = 𝐸[𝑋] = 11/24 and Var(𝑌 ) = Var(𝑋) = 47/242 .
We use the formula Cov(𝑋, 𝑌 ) = 𝐸[𝑋𝑌 ] − 𝐸[𝑋]𝐸[𝑌 ].
1       1                                1       1
5  1  29
𝐸[𝑋𝑌 ] = ∫ ∫ 𝑥𝑦𝑓(𝑥, 𝑦) 𝑑𝑥 𝑑𝑦 = ∫ ∫ 5𝑥𝑦/4 − 𝑥2 𝑦2 𝑑𝑥 =                                − =     .
0       0                                0       0                    16 9   144
29  112  29   121         5
Cov(𝑋, 𝑌 ) = 𝐸[𝑋𝑌 ] − 𝐸[𝑋]𝐸[𝑌 ] =                   − 2 =    −        =−
144 24    144 144 ⋅ 4    144 ⋅ 4
Cov(𝑋, 𝑌 )   Cov(𝑋, 𝑌 )   −5/242    −5
Cor(𝑋, 𝑌 ) =              =        2
=       2
=
𝜎𝑋 𝜎𝑌       47/24       47/24     47', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(10 pts)
A company manufactures solar panels. When homeowners install the panels, the state pays
50% of the cost. Because this subsidy is about to expire, the company wants to manufacture
as many panels as it can in the next 20 days.
For a variety of reasons the number of panels it can manufacture in a day is a ran-
dom variable with each day independent of the others. Suppose the daily output fol-
lows a so-called gamma distribution. The pdf of this distribution is not that complicated
             𝑥4
(𝑓(𝑥) =            e−𝑥/100 ), but we’ll let Wikipedia tell us the mean and variance: mean =
         4! ⋅ 1010
500, variance = 5 ⋅ 104 .
Estimate the probability that they will be able to manufacture more than 10,500 panels
in the next 20 days.
18.05 Exam 1                                                                           9


Standard normal table of left tail probabilities.

   𝑧      Φ(𝑧)      𝑧      Φ(𝑧)      𝑧     Φ(𝑧)      𝑧     Φ(𝑧)
 -4.00   0.0000   -2.00   0.0228   0.00   0.5000   2.00   0.9772   Φ(𝑧) = 𝑃 (𝑍 ≤ 𝑧) for N(0, 1).
 -3.95   0.0000   -1.95   0.0256   0.05   0.5199   2.05   0.9798
                                                                   (Use interpolation to estimate
 -3.90   0.0000   -1.90   0.0287   0.10   0.5398   2.10   0.9821
                                                                   𝑧 values to a 3rd decimal
 -3.85   0.0001   -1.85   0.0322   0.15   0.5596   2.15   0.9842
                                                                   place.)
 -3.80   0.0001   -1.80   0.0359   0.20   0.5793   2.20   0.9861
 -3.75   0.0001   -1.75   0.0401   0.25   0.5987   2.25   0.9878
 -3.70   0.0001   -1.70   0.0446   0.30   0.6179   2.30   0.9893
 -3.65   0.0001   -1.65   0.0495   0.35   0.6368   2.35   0.9906
 -3.60   0.0002   -1.60   0.0548   0.40   0.6554   2.40   0.9918
 -3.55   0.0002   -1.55   0.0606   0.45   0.6736   2.45   0.9929
 -3.50   0.0002   -1.50   0.0668   0.50   0.6915   2.50   0.9938
 -3.45   0.0003   -1.45   0.0735   0.55   0.7088   2.55   0.9946
 -3.40   0.0003   -1.40   0.0808   0.60   0.7257   2.60   0.9953
 -3.35   0.0004   -1.35   0.0885   0.65   0.7422   2.65   0.9960
 -3.30   0.0005   -1.30   0.0968   0.70   0.7580   2.70   0.9965
 -3.25   0.0006   -1.25   0.1056   0.75   0.7734   2.75   0.9970
 -3.20   0.0007   -1.20   0.1151   0.80   0.7881   2.80   0.9974
 -3.15   0.0008   -1.15   0.1251   0.85   0.8023   2.85   0.9978
 -3.10   0.0010   -1.10   0.1357   0.90   0.8159   2.90   0.9981
 -3.05   0.0011   -1.05   0.1469   0.95   0.8289   2.95   0.9984
 -3.00   0.0013   -1.00   0.1587   1.00   0.8413   3.00   0.9987
 -2.95   0.0016   -0.95   0.1711   1.05   0.8531   3.05   0.9989
 -2.90   0.0019   -0.90   0.1841   1.10   0.8643   3.10   0.9990
 -2.85   0.0022   -0.85   0.1977   1.15   0.8749   3.15   0.9992
 -2.80   0.0026   -0.80   0.2119   1.20   0.8849   3.20   0.9993
 -2.75   0.0030   -0.75   0.2266   1.25   0.8944   3.25   0.9994
 -2.70   0.0035   -0.70   0.2420   1.30   0.9032   3.30   0.9995
 -2.65   0.0040   -0.65   0.2578   1.35   0.9115   3.35   0.9996
 -2.60   0.0047   -0.60   0.2743   1.40   0.9192   3.40   0.9997
 -2.55   0.0054   -0.55   0.2912   1.45   0.9265   3.45   0.9997
 -2.50   0.0062   -0.50   0.3085   1.50   0.9332   3.50   0.9998
 -2.45   0.0071   -0.45   0.3264   1.55   0.9394   3.55   0.9998
 -2.40   0.0082   -0.40   0.3446   1.60   0.9452   3.60   0.9998
 -2.35   0.0094   -0.35   0.3632   1.65   0.9505   3.65   0.9999
 -2.30   0.0107   -0.30   0.3821   1.70   0.9554   3.70   0.9999
 -2.25   0.0122   -0.25   0.4013   1.75   0.9599   3.75   0.9999
 -2.20   0.0139   -0.20   0.4207   1.80   0.9641   3.80   0.9999
 -2.15   0.0158   -0.15   0.4404   1.85   0.9678   3.85   0.9999
 -2.10   0.0179   -0.10   0.4602   1.90   0.9713   3.90   1.0000
 -2.05   0.0202   -0.05   0.4801   1.95   0.9744   3.95   1.0000
18.05 Exam 1   10


Extra paper




18.05 Introduction to Probability and Statistics
Spring 2022


For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑆 be the total manufactured in 20 days. The problem asks for 𝑃 (𝑆 > 10500).
Since 𝑆 is a sum of 20 i.i.d. random variables, the central limit theorem tell us that it is
approximately normal. We know that one day has mean 500 and variance 5 ⋅ 104 . So
𝐸[𝑆] = 20 ⋅ 500 = 10000            Var(𝑆) = 20 ⋅ 5 ⋅ 104 = 105     𝜎𝑆 = 103 .
Standardizing and using the CLT we get
𝑆 − 10, 000   10, 500 − 10, 000
𝑃 (𝑆 > 10500) = 𝑃 (               >                   )
1000             1000
≈ 𝑃 (𝑍 > 0.5) = 1 − 𝑃 (𝑍 ≤ 0.5) ≈ 1 − 0.6915 = 0.3085
The decimal answer came by looking up 𝑃 (𝑍 < 0.5) ≈ 0.6915 in the standard normal
table.
18.05 Introduction to Probability and Statistics
Spring 2022
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Corrupted by their power, the judges running the popular game show America’s
Next Top Mathematician have been taking bribes from many of the contestants. Each
episode, a given contestant is either allowed to stay on the show or is kicked off.
If the contestant has been bribing the judges they will be allowed to stay with probability 1.
If the contestant has not been bribing the judges, they will be allowed to stay with probability
1/3.
Suppose that 1/4 of the contestants have been bribing the judges. The same contestants
bribe the judges in both rounds, i.e., if a contestant bribes them in the first round, they bribe
them in the second round too (and vice versa).
If you pick a random contestant who was allowed to stay during the first episode, what
is the probability that they were bribing the judges?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We first compute 𝑃 (𝑆1 ) using the law of total probability.
1 1 3 1
𝑃 (𝑆1 ) = 𝑃 (𝑆1 |𝐵)𝑃 (𝐵) + 𝑃 (𝑆1 |𝐻)𝑃 (𝐻) = 1 ⋅    + ⋅ = .
4 3 4 2
𝑃 (𝐵)       1/4  1
We therefore have (by Bayes’ rule) 𝑃 (𝐵|𝑆1 ) = 𝑃 (𝑆1 |𝐵)           =1⋅     = .
𝑃 (𝑆1 )     1/2  2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Corrupted by their power, the judges running the popular game show America’s
Next Top Mathematician have been taking bribes from many of the contestants. Each
episode, a given contestant is either allowed to stay on the show or is kicked off.
If the contestant has been bribing the judges they will be allowed to stay with probability 1.
If the contestant has not been bribing the judges, they will be allowed to stay with probability
1/3.
Suppose that 1/4 of the contestants have been bribing the judges. The same contestants
bribe the judges in both rounds, i.e., if a contestant bribes them in the first round, they bribe
them in the second round too (and vice versa).
We want to compute 𝑃 (𝐿2 |𝑆1 ) =                .
𝑃 (𝑆1 )
From the calculation we did in part (a), 𝑃 (𝑆1 ) = 1/2. For the numerator, we have (see the
tree)
1 2 3  1
𝑃 (𝐿2 ∩ 𝑆1 ) = 𝑃 (𝐿2 ∩ 𝑆1 |𝐵)𝑃 (𝐵) + 𝑃 (𝐿2 ∩ 𝑆1 |𝐻)𝑃 (𝐻) = 0 ⋅    + ⋅ =
4 9 4  6
1/6  1
Therefore 𝑃 (𝐿2 |𝑆1 ) =       = .
1/2  3
4   Independence Problems', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The following tree shows the setting. Stay1 means the contestant was allowed
to stay during the first episode and stay2 means the they were allowed to stay during the
second.
1/4           3/4
Bribe                             Honest
1           0                   1/3            2/3
Stay1            Leave1           Stay1           Leave1
1       0                     1/3            2/3
Stay2     Leave2                Stay2         Leave2
Let’s name the relevant events:
𝐵 = the contestant is bribing the judges
𝐻 = the contestant is honest (not bribing the judges)
𝑆1 = the contestant was allowed to stay during the first episode
𝑆2 = the contestant was allowed to stay during the second episode
𝐿1 = the contestant was asked to leave during the first episode
𝐿2 = the contestant was asked to leave during the second episode', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
The random variable 𝑋 takes values -1, 0, 1 with probabilities 1/8, 2/8, 5/8
respectively.
Give the pmf of 𝑌 = 𝑋 2 and use it to compute 𝐸[𝑌 ].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ⇒ 𝐸[𝑌 ] = 6/8 = 3/4.
prob:     2/8     6/8', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
The random variable 𝑋 takes values -1, 0, 1 with probabilities 1/8, 2/8, 5/8
respectively.
Compute Var(𝑋).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Var(𝑋) = 𝐸[𝑋 2 ] − 𝐸[𝑋]2 = 3/4 − 1/4 = 1/2.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose that 𝑋 has probability density function 𝑓𝑋 (𝑥) = 𝜆e−𝜆𝑥 for
𝑥 ≥ 0. Compute the cdf, 𝐹𝑋 (𝑥).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have cdf of 𝑋,
𝑥
𝐹𝑋 (𝑥) = ∫ 𝜆e−𝜆𝑥 𝑑𝑥 = 1 − e−𝜆𝑥 .
0
Now for 𝑦 ≥ 0, we have', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose you roll a fair 6-sided die 100 times (independently), and you get $3
every time you roll a 6.
Let 𝑋1 be the number of dollars you win on rolls 1 through 25.
Let 𝑋2 be the number of dollars you win on rolls 26 through 50.
Let 𝑋3 be the number of dollars you win on rolls 51 through 75.
Let 𝑋4 be the number of dollars you win on rolls 76 throught 100.
Let 𝑋 = 𝑋1 + 𝑋2 + 𝑋3 + 𝑋4 be the total number of dollars you win over all 100 rolls.
What is the probability mass function of 𝑋?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : What is the probability mass function of 𝑋?', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose you roll a fair 6-sided die 100 times (independently), and you get $3
every time you roll a 6.
Let 𝑋1 be the number of dollars you win on rolls 1 through 25.
Let 𝑋2 be the number of dollars you win on rolls 26 through 50.
Let 𝑋3 be the number of dollars you win on rolls 51 through 75.
Let 𝑋4 be the number of dollars you win on rolls 76 throught 100.
Let 𝑋 = 𝑋1 + 𝑋2 + 𝑋3 + 𝑋4 be the total number of dollars you win over all 100 rolls.
(i) Let 𝑇1 be the total number of times you roll a 6 in the first 25 rolls. So, 𝑋1 = 3𝑇1
and 𝑌 = 12𝑇1 .
Now, 𝑇1 ∼ Binomial(25, 1/6), so
𝐸[𝑌 ] = 12𝐸[𝑇1 ] = 12 ⋅ 25 ⋅ 16 = 50.
and
1 5
Var(𝑌 ) = 144Var(𝑇1 ) = 144 ⋅ 25 ⋅⋅ = 500.
6 6
(ii) The expectations are the same by linearity because 𝑋 and 𝑌 are the both
3 × 100 × a Bernoulli(1/6) random variable.
For the variance, Var(𝑋) = 4Var(𝑋1 ) because 𝑋 is the sum of 4 independent variables all
identical to 𝑋1 . However Var(𝑌 ) = Var(4𝑋1 ) = 16Var(𝑋1 ). So, the variance of 𝑌 is 4
times that of 𝑋. This should make some intuitive sense because 𝑋 is built out of more
independent trials than 𝑋1 .
Another way of thinking about it is that the difference between 𝑌 and its expectation is
four times the difference between 𝑋1 and its expectation. However, the difference between
𝑋 and its expectation is the sum of such a difference for 𝑋1 , 𝑋2 , 𝑋3 , and 𝑋4 . It’s probably
the case that some of these deviations are positive and some are negative, so the absolute
value of this difference for the sum is probably less than four times the absolute value of this
difference for one of the variables, i.e. the deviations are likely to cancel to some extent.
7    Joint Probability, Covariance, Correlation Problems', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (a) There are a number of ways to present this.
Let 𝑇 be the total number of times you roll a 6 in the 100 rolls. We know 𝑇 ∼ Binomial(100, 1/6).
Since you win $3 every time you roll a 6, we have 𝑋 = 3𝑇 . So, we can write
100  1 𝑘 5 100−𝑘
𝑃 (𝑋 = 3𝑘) = (      )( ) ( )      ,         for 𝑘 = 0, 1, 2, … , 100.
𝑘   6   6
Alternatively we could write
100   1 𝑥/3 5 100−𝑥/3
𝑃 (𝑋 = 𝑥) = (     )( ) ( )          ,          for 𝑥 = 0, 3, 6, … , 300.
𝑥/3    6     6', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Covariance and Independence
Let 𝑋 be a random variable that takes values -2, -1, 0, 1, 2; each with probability 1/5.          Let
𝑌 = 𝑋2.
Show 𝑋 and 𝑌 are not independent.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We show the probabilities don’t multiply:
𝑃 (𝑋 = −2, 𝑌 = 0) = 0 ≠ 𝑃 (𝑋 = −2) ⋅ 𝑃 (𝑌 = 0) = 1/25.
Since these are not equal 𝑋 and 𝑌 are not independent. (It is obvious that 𝑋 2 is not
independent of 𝑋.)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Continuous Joint Distributions
Suppose 𝑋 and 𝑌 are continuous random variables with joint density function 𝑓(𝑥, 𝑦) =
𝑐(𝑥 + 2𝑦) on the rectangle [0, 1] × [0, 2].
When doing this problem in class: Only compute the integrals in parts (a) and (b). For the
1       2
others, just give the integrals in a form like ∫ ∫ 𝑥𝑓(𝑥, 𝑦) 𝑑𝑦 𝑑𝑥, but don’t compute them.
0       0
Find the value of 𝑐.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We need the total probability to be 1. So
1       2
∫ ∫ 𝑐(𝑥 + 2𝑦) 𝑑𝑦 𝑑𝑥 = 1.
0       0
2   2
Inner integral: 𝑐(𝑥𝑦 + 𝑦 )∣0 = 𝑐(2𝑥 + 4).
1
Outer integral: [𝑐𝑥2 + 4𝑥]0 = 5𝑐.
So 𝑐 = 1/5.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Continuous Joint Distributions
Suppose 𝑋 and 𝑌 are continuous random variables with joint density function 𝑓(𝑥, 𝑦) =
𝑐(𝑥 + 2𝑦) on the rectangle [0, 1] × [0, 2].
When doing this problem in class: Only compute the integrals in parts (a) and (b). For the
1       2
others, just give the integrals in a form like ∫ ∫ 𝑥𝑓(𝑥, 𝑦) 𝑑𝑦 𝑑𝑥, but don’t compute them.
0       0
Compute the marginal densities for 𝑋 and 𝑌 .
2                           2
1                1          2   1', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑓𝑋 (𝑥) = ∫ 𝑓(𝑥, 𝑦) 𝑑𝑦 =               ∫ (𝑥 + 2𝑦) 𝑑𝑦 = [𝑥𝑦 + 𝑦2 ]0 = (2𝑥 + 4).
0                       5 0              5              5
1
1 1
Similarly, 𝑓𝑌 (𝑦) = ∫ 𝑓(𝑥, 𝑦) 𝑑𝑥 =             ( + 2𝑦) .
0                        5 2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Continuous Joint Distributions
Suppose 𝑋 and 𝑌 are continuous random variables with joint density function 𝑓(𝑥, 𝑦) =
𝑐(𝑥 + 2𝑦) on the rectangle [0, 1] × [0, 2].
When doing this problem in class: Only compute the integrals in parts (a) and (b). For the
1       2
others, just give the integrals in a form like ∫ ∫ 𝑥𝑓(𝑥, 𝑦) 𝑑𝑦 𝑑𝑥, but don’t compute them.
0       0
Compute 𝐸[𝑋], 𝐸[𝑌 ], 𝐸[𝑋 2 + 𝑌 2 ], Cov(𝑋, 𝑌 ), Cor(𝑋, 𝑌 ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 1   2                             1   2
1
𝐸[𝑋] = ∫ ∫ 𝑥𝑓(𝑥, 𝑦) 𝑑𝑦 𝑑𝑥 = ∫ ∫ 𝑥(𝑥 + 2𝑦) 𝑑𝑦 𝑑𝑥.
0 0                 5 0 0
8
The integration is similar to all the others in this problem: 𝐸[𝑋] =                                                     ≈ 0.533.
15
1                 1
1
(Or, using (b), 𝐸[𝑋] = ∫ 𝑥𝑓𝑋 (𝑥) 𝑑𝑥 = ∫ 𝑥(2𝑥 + 4) 𝑑𝑥 = 8/15.)
0             5 0
1           2
19
Similarly, 𝐸[𝑌 ] = ∫ ∫ 𝑦𝑓(𝑥, 𝑦) 𝑑𝑦 𝑑𝑥 =                                    ≈ 1.267. .
0           0                       15
For the remaining integrals, we won’t show any computation. They all look similar.
1       2                                             1       2
1                             67
𝐸[𝑋 2 +𝑌 2 ] = ∫ ∫ (𝑥2 +𝑦2 )𝑓(𝑥, 𝑦) 𝑑𝑦 𝑑𝑥 =                                ∫ ∫ (𝑥2 +𝑦2 )(𝑥+2𝑦) 𝑑𝑦 𝑑𝑥 =    ≈ 2.333.
0       0                                        5 0 0                         30
For Cov(𝑋, 𝑌 ) we use the formula Cov(𝑋, 𝑌 ) = 𝐸[𝑋𝑌 ] − 𝐸[𝑋]𝐸[𝑌 ].
1           2                             1       2
1                        2
𝐸[𝑋𝑌 ] = ∫ ∫ 𝑥𝑦𝑓(𝑥, 𝑦) 𝑑𝑦 𝑑𝑥 =                                ∫ ∫ 𝑥𝑦(𝑥 + 2𝑦) 𝑑𝑦 𝑑𝑥 =   ≈ 0.667.
0           0                           5 0 0                    3
2   8 19
Cov(𝑋, 𝑌 ) = 𝐸[𝑋𝑌 ] − 𝐸[𝑋]𝐸[𝑌 ] =                                     −  ⋅   ≈ −0.00889.
3 15 15
To find the covariance, we need the variances of 𝑋 and 𝑌 . For this, we first compute 𝐸[𝑋 2 ],
𝐸[𝑌 2 ].
1       2                                                                             1       2
𝐸[𝑋 ] = ∫ ∫ 𝑥 𝑓(𝑥, 𝑦) 𝑑𝑦 𝑑𝑥 = 11/30 and 𝐸[𝑌 ] = ∫ ∫ 𝑦2 𝑓(𝑥, 𝑦), 𝑑𝑦 𝑑𝑥 = 28/15.
2                           2                                                     2
0       0                                                                             0       0
So, Var(𝑋) = 11/30 − (8/15)2 ≈ 0.0822 and Var(𝑌 ) = 28/15 − (19/15)2 ≈ 0.262.
√              √                        Cov(𝑋, 𝑌 )
Thus, 𝜎𝑋 ≈ 0.0822, 𝜎𝑌 ≈ 0.262 and Cor(𝑋, 𝑌 ) =                ≈ −0.0606. .
𝜎𝑋 𝜎𝑌
8     Law of Large Numbers, Central Limit Theorem Problems', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(More Central Limit Theorem)


The average IQ in a population is 100 with standard deviation 15 (by definition, IQ is
normalized so this is the case). What is the probability that a randomly selected group of
100 people has an average IQ above 115?


9   More problems', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑋𝑗 be the IQ of a randomly selected person. We are given 𝐸[𝑋𝑗 ] = 100 and
𝜎𝑋𝑗 = 15.
Let 𝑋 be the average of the IQ’s of 100 randomly selected people. Then we know
√
𝐸[𝑋] = 100 and 𝜎𝑋 = 15/ 100 = 1.5.
The problem asks for 𝑃 (𝑋 > 115). Standardizing we get 𝑃 (𝑋 > 115) ≈ 𝑃 (𝑍 > 10).
This is effectively 0.
9   More problems', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Specify 𝐻0 and 𝐻𝐴 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The first quartile is the value where 25% of the data is below it. We have 16
data points so this is between the 4th and 5th points, i.e. between 2 and 3. It is reasonable
to take the midpoint and say 2.5.
The second quartile is between 8 and 12, we say 10.
The third quartile is 14.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Discrete prior-discrete likelihood.
Jon has 1 four-sided, 2 six-sided, 2 eight-sided, 2 twelve sided, and 1 twenty-sided dice. He
picks one at random and rolls a 7.
What are the posterior odds Jon chose the 20-sided die?
𝑃 (20-sided | 𝑥1 = 7)        1/160𝑇', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Odds(20-sided | 𝑥1 = 7) =                               =               = 0.12.
𝑃 (not 20-sided | 𝑥1 = 7)   1/32𝑇 + 1/48𝑇', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Compute 𝑝-value or check if test statistic is in the rejection region.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Our definition of the geometric distribution means that 𝑥 = 6 represents 6
successes in a row and then 1 failure. The updating has the same rule as in the previous
problem:
Prior: 𝑓(𝜃) ∼ Beta(4, 2) gives posterior 𝑓(𝜃 | 𝑥 = 6) ∼ Beta(10, 3).
(We could also do this problem using an update table.)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
𝑧 and one-sample 𝑡-test. For both problems use significance level 𝛼 = 0.05.
Assume the data 2, 4, 4, 10 are independent draws from a 𝑁 (𝜇, 𝜎2 ) distribution.
Take 𝐻0 : 𝜇 = 0;              𝐻𝐴 : 𝜇 ≠ 0.
2
Assume 𝜎 = 16 is known and test 𝐻0 against 𝐻𝐴 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have 𝑥 = 5,         𝑠2 = 9+1+1+25
3    = 12
We’ll use 𝑧 for the test statistic (we could also use 𝑥).
𝑥 − 𝜇0 5
𝑧=        √ = = 2.5.
𝜎/ 𝑛   2
The null distribution for 𝑧 is N(0, 1). This is a two-sided test so the rejection region is
(𝑧 ≤ 𝑧0.975 or 𝑧 ≥ 𝑧0.025 ) = (−∞, −1.96] ∪ [1.96, ∞)
Since our 𝑧-statistic in the rejection region we reject 𝐻0 in favor of 𝐻𝐴 .
Repeating the test using a 𝑝-value:
𝑝 = 𝑃 (|𝑧| ≥ 2.5 | 𝐻0 ) = 2 ∗ pnorm(−2.5, 0, 1) ≈ 0.012
Since 𝑝 < 𝛼 we reject 𝐻0 in favor of 𝐻𝐴 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Two-sample 𝑡-test Suppose that we have data from 1408 women admitted to a maternity
hospital for (i) medical reasons or through (ii) unbooked emergency admission. The duration
of pregnancy is measured in complete weeks from the beginning of the last menstrual period.
Set up and run a two-sample 𝑡-test to investigate whether the duration differs for the
two groups.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The pooled variance for this data is
774(7.77) + 632(4.95)    1   1
𝑠2𝑝 =                         (    +    ) = 0.0187
1406            775 633
The 𝑡 statistic for the null distribution is
𝑥̄ − 𝑦̄
= −3.8064
𝑠𝑝
Rather than compute the two-sided 𝑝-value using 2*pt(-3.8064,1406) we simply note that
with 1406 degrees of freedom the 𝑡 distribution is essentially standard normal and 3.8064 is
almost 4 standard deviations. So
𝑃 (|𝑡| ≥ 3.8064) = 𝑃 (|𝑧| ≥ 3.8064)
which is very small, much smaller than 𝛼 = 0.05 or 𝛼 = 0.01. Therefore we reject the null
hypothesis in favor of the alternative that there is a difference in the mean durations.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Two-sample 𝑡-test Suppose that we have data from 1408 women admitted to a maternity
hospital for (i) medical reasons or through (ii) unbooked emergency admission. The duration
of pregnancy is measured in complete weeks from the beginning of the last menstrual period.
Medical: 775 observations with 𝑥̄ = 39.08 and 𝑠2 = 7.77.
(ii) Emergency: 633 observations with 𝑥̄ = 39.60 and 𝑠2 = 4.95.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Medical: 775 observations with 𝑥̄ = 39.08 and 𝑠2 = 7.77.
(ii) Emergency: 633 observations with 𝑥̄ = 39.60 and 𝑠2 = 4.95.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(15: 5,5,5)
You roll a fair six-sided die 8 times.
What is the probability that none of the 8 rolls is a six?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (5/6)8 ≈ 1/4. (Since 54 = 625 and 64 = 1296, we see that (5/6)4 is approxi-
mately 1/2. Squaring…)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(15: 5,5,5)
You roll a fair six-sided die 8 times.
What is the expected number of sixes in the 8 rolls?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Expected values add, so Solution: 8 ⋅ 1/6 = 4/3.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(16: 4,4,4,4)
Suppose 𝑋 is a random variable with values in [1,2] and density
𝑘𝑥2    for 1 ≤ 𝑥 ≤ 2
𝑓(𝑥) = {
0     otherwise
where 𝑘 is a fixed constant.
Find 𝑃 (𝑋 < 3/2).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is cdf(3/2) = (27/8 − 1)/7 = 19/56 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 5,5,5,5,5)
Suppose random variables 𝑋 and 𝑌 have units of dollars and:
𝐸[𝑋] = 5,       Var(𝑋) = 62 ,     and       𝐸[𝑌 ] = 10,   Var(𝑌 ) = 72 .
Define 𝑊 = 𝑋 + 𝑌 .
18.05 Final Exam Spring 2022 Solutions                                                      6
Find 𝐸[𝑊 ]. What are the units of 𝐸[𝑊 ]?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The expected value of a sum of random variables is the sum of the expected
values, so
𝐸[𝑊 ] = 𝐸[𝑋] + 𝐸[𝑌 ] = 5 + 10 = 15
The units are those of 𝑋 and 𝑌 , namely dollars : we compute the expected value by adding
up values of the variable (which are dollars) multiplied by (dimensionless) probabilities.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 5,5,5,5,5)
Suppose random variables 𝑋 and 𝑌 have units of dollars and:
𝐸[𝑋] = 5,       Var(𝑋) = 62 ,     and       𝐸[𝑌 ] = 10,   Var(𝑌 ) = 72 .
Define 𝑊 = 𝑋 + 𝑌 .
18.05 Final Exam Spring 2022 Solutions                                                      6
Assume Cov(𝑋, 𝑌 ) = 21. Find Var(𝑊 ). (Note: this assumption differs from that in
part (b), so Var(𝑊 ) can also be different.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Same formula as used in (b) gives
Var(𝑊 ) = Var(𝑋) + Var(𝑌 ) + 2Cov(𝑋, 𝑌 ) = 62 + 72 + 2 ⋅ 21 = 36 + 49 + 42 = 127 .
The units are square dollars, which seems like a very American concept.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 5,5,5,5,5)
Suppose random variables 𝑋 and 𝑌 have units of dollars and:
𝐸[𝑋] = 5,       Var(𝑋) = 62 ,     and       𝐸[𝑌 ] = 10,   Var(𝑌 ) = 72 .
Define 𝑊 = 𝑋 + 𝑌 .
18.05 Final Exam Spring 2022 Solutions                                                      6
Define 𝑍 =              = (𝑋 − 5)/6. Find 𝐸[𝑍] and Var(𝑍).
√Var(𝑋)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is the standardization of 𝑋, which is supposed to have mean 0 and variance 1 .
Here’s why. The linearity of expectation 𝐸[𝑎𝑋 + 𝑏] = 𝑎𝐸[𝑋] + 𝑏 (for constants 𝑎 and 𝑏)
gives
𝐸[𝑍] = 𝐸[𝑋]/6 − 5/6 = 5/6 − 5/6 = 0 .
The corresponding fact for variance is Var(𝑎𝑋 + 𝑏) = 𝑎2 Var(𝑋), so
Var(𝑍) = Var(𝑋)/62 = 62 /62 = 1 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 10,5,5)
You roll two fair (6-sided) dice. If the sum of the dice is greater than 9, you win $100. If
the sum is 9 or less you get to roll again. On the second roll, if your sum of dice is greater
than 9, you win $50, otherwise you win nothing. Let 𝑋 be the random variable of how much
money you win by playing this game.
What is the expected amount you will win playing the game?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This can be read from the last table in (a) : it’s
11
Expected payoff = (25/36) ⋅ $0 + (5/36) ⋅ $50 + (1/6) ⋅ $100 = $850/36 = $23               ≈ $23.61
18', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(10)
The Pareto distribution is used in economics modeling. To keep it simple we’ll use the
Pareto distribution that takes values 𝑥 ≥ 1 and has pdf

                              𝑓(𝑥 ∣ 𝜃) = 𝜃𝑥−𝜃−1   for 𝑥 ≥ 1.

It’s defined whenever 𝜃 > 0. Assume 𝑥1 , … , 𝑥𝑛 are 𝑛 independent samples from a Pareto(𝜃)
distribution, find the maximum likelihood estimate of 𝜃.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The likelihood for these 𝑛 independent samples is the product of the densities
at all the 𝑥𝑖 :
[𝜃𝑥−𝜃−1
1    ][𝜃𝑥−𝜃−1
2    ] ⋯ [𝜃𝑥−𝜃−1
𝑛    ] = 𝜃𝑛 (𝑥1 ⋯ 𝑥𝑛 )−𝜃−1
The log likelihood is
𝑛 log(𝜃) + log(𝑥1 ⋯ 𝑥𝑛 )(−𝜃 − 1).
18.05 Final Exam Spring 2022 Solutions                                                         8
The MLE is the choice of 𝜃 > 0 that maximizes this function. The function approaches −∞
as 𝜃 approaches 0 or ∞ (because all the 𝑥𝑖 need to be at least 1 to have a chance of being
modelled by Pareto; this makes log(𝑥1 ⋯ 𝑥𝑛 ) > 0). So any maximum must occur when the
derivative with respect to 𝜃 is zero. That is,
𝑛/𝜃 − log(𝑥1 ⋯ 𝑥𝑛 ) = 0,
which gives
𝑛              𝑛
𝜃=                 =             .
log(𝑥1 ⋯ 𝑥𝑛 )   ∑𝑖 log(𝑥𝑖 )', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(15: 5,10)
A certain medical condition exists in 1% of the population. A screening test for the condition
has a 4% false positive rate and a 0% false negative rate.
Suppose a random person tests positive for the condition. What are the odds they have
the condition?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The odds after the evidence are the prior odds multiplied by the likelihood ratio.
The likelihoods are
𝑃 (𝑇 + |𝐷+) = 1.00, 𝑃 (𝑇 + |𝐷−) = 0.04.
𝑃 (𝑇 + |𝐷+)    1
So, the likelihood ratio is               =      = 25. Thus, the posterior odds are
𝑃 (𝑇 + |𝐷−)   0.04
1        25
prior odds ⋅ likelihood ratio =      ⋅ 25 =    ≈ 1/4.
99        99
After a positive test, the odds are about 1 to 4 that the person has the condition (or
about a 20% chance).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 5,10,5,10 )
This question is about a robot, Bayz-E, who tries to figure out where it is located using
Bayesian updating. Bayz-E is randomly placed in front of one of four doors, A, B, C, or D.
At every time step, Bayz-E scans the color of the door in front of it. The outcome will be
either orange of blue. However, its color scanner is not entirely accurate. Bayz-E scans the
door’s color correctly with a probability 0.7, and scans the color incorrectly with a probability
0.3.
Note. To avoid confusion for you, the color of the door is written above its letter. (Bayz-E
has not yet learned to read, though its machine learning algorithm is working on it.)
18.05 Final Exam Spring 2022 Solutions                                                       9
orange         orange       blue          blue
A            B            C             D
Bayz-E scans the door color and detects “orange.” What is the posterior probability it
is in front of door B?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Time to start making tables: We’ll abbreviate Bayes numerator as BN.
likelihood
hypothesis    prior   P(orange | hypoth.)       BN    posterior
A (orange)     1/4            7/10             7/40     7/20
B (orange)     1/4            7/10             7/40     7/20
C (blue)       1/4            3/10             3/40     3/20
D (blue)       1/4            3/10             3/40     3/20
sum             1                               1/2       1
So the posterior probability of B is 𝑃 (𝐵 | orange) = 7/20 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 5,10,5,10 )
This question is about a robot, Bayz-E, who tries to figure out where it is located using
Bayesian updating. Bayz-E is randomly placed in front of one of four doors, A, B, C, or D.
At every time step, Bayz-E scans the color of the door in front of it. The outcome will be
either orange of blue. However, its color scanner is not entirely accurate. Bayz-E scans the
door’s color correctly with a probability 0.7, and scans the color incorrectly with a probability
0.3.
Note. To avoid confusion for you, the color of the door is written above its letter. (Bayz-E
has not yet learned to read, though its machine learning algorithm is working on it.)
18.05 Final Exam Spring 2022 Solutions                                                       9
orange         orange       blue          blue
A            B            C             D
What is the predictive probability that the color scan of this door (after the move in part
(c)) will detect “blue”?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We continue the table started in part (c).
18.05 Final Exam Spring 2022 Solutions                                                          10
likelihood
hypothesis      prior     P(2nd is blue | hypoth.)        BN 2    posterior 2
A (orange)      3/20                3/10                  9/200
B (orange)      7/20                3/10                 21/200
C (blue)        7/20                7/10                 49/200
D (blue)        3/20                7/10                 21/200
sum               1                                     100/200
The predictive probability is the total probability of blue, i.e. the sum of the Bayes numer-
ator column:
𝑃 (blue on second door | orange on first door) = 1/2 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 5,10,5)
Jerry wants to brag to his non-MIT colleagues about how smart MIT students are. To
give himself credibility, he decides to run a statistical test comparing the IQ scores of MIT
students and Harvard students.
He collects IQ scores from 11 MIT students. The data has a sample mean of 115, with a
sample standard deviation of 8.
He then collects IQ scores from 11 Harvard students. Their scores have a sample mean of
110, with a sample standard deviation of 6.
Run the test with a significance level of 𝛼 = 0.05. Should Jerry reject the null hypothesis
or not?
√
(In this problem there is some arithmetic. You will want to use √100/11 ≈ 9 = 3.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The 𝑡 statistic is 𝑡 = (𝑥 − 𝑦)/𝑠𝑝 , where 𝑠2𝑝 is the pooled variance
10 ⋅ 64 + 10 ⋅ 36 1   1 100
𝑠2𝑝 =                    ( + )=     .
11 + 11 − 2     11 11  11
According to the hint 𝑠𝑝 ≈ 3. The difference in means is 5, so 𝑡 ≈ 5/3 = 1.67 . The number
of degrees of freedom is 11+11−2 = 20. According to the table, the right tail probability for
the 𝑡 distribution with 20 degrees of freedom at 1.67 is between 0.05 and 0.10, (interpolating
it’s about 0.058). The two-tailed 𝑝-value is twice the right tail probability, (about 0.116 ),
which is clearly greater than 𝛼 = 0.05. So, we do not reject the null hypothesis, i.e.,
the difference between the mean IQ scores of MIT and Harvard students is not signifcant
at significance level 0.05.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 10,10)
MIT has decided to form a new Department of Statistics and Probability. In a vote for
the new head of this department, suppose 50% of the MIT population supports Sarah, 20%
18.05 Final Exam Spring 2022 Solutions                                                     12
supports So Hee, and the remaining 30% is split evenly among Jerry, Jen, Alessandre and
Gabe.
A poll asks 100 random people whom they support. Estimate the probability that at least
45% of those polled support Sarah.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Write 𝑆 for the fraction of the sample that supports Sarah.
1    1
𝐸[𝑆] = 0.5,   𝜎𝑆 = √ =
2 𝑛  20
Since 𝑆 is an average of 100 Bernoulli(0.5) variables, the CLT says it’s approximately
normal. Standardizing gives
𝑆 − 0.5   0.45 − 0.50
𝑃 (𝑆 > 0.45) = 𝑃 (           >             ) ≈ 𝑃 (𝑍 > −1) ≈ 0.84.
1/20        1/20', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(10)
You independently draw 100 data points from a N(𝜇, 1) distribution, where 𝜇 is unknown.
Suppose you test the null hypothesis 𝐻0 ∶ 𝜇 = 0 against the alternative hypothesis 𝐻𝐴 ∶
𝜇 ≠ 0 using a significance level of 𝛼 = 0.05. What is the power of the test for the alternative
𝐻𝐴 ∶ 𝜇 = 0.4?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Power = 𝑃 (reject | 𝜇 = 0.4) = 1 − 𝑃 (don’t reject|𝜇 = 0.4).
Rejection region for 𝑥 is
𝜎                     𝜎
𝑧0.975 ⋅ √ ≤ 𝑥 − 𝜇0 ≤ 𝑧0.025 ⋅ √ .
𝑛                     𝑛
We have 𝜇0 = 0, 𝜎 = 1, 𝑛 = 100, 𝛼 = 0.05. So, the rejection region is
1                1
−1.96 ⋅      ≤ 𝑥 ≤ 1.96 ⋅    ⇔ −0.196 ≤ 𝑥 ≤ 0.196.
10              10
So, 𝑃 (don’t reject|𝜇 = 0.4) = 𝑃 (−0.196 ≤ 𝑥 ≤ 0.196 | 𝜇 = 0.4).
Standardizing 𝑥 this becomes
−0.196 − 0.4   𝑥 − 0.4   0.196 − 0.4
𝑃 (don’t reject | 𝜇 = 0.4) = 𝑃 (              ≤         ≤             | 𝜇 = 0.4)
1/10        1/10        1/10
= 𝑃 (−5.96 ≤ 𝑍 ≤ −2.04).
18.05 Final Exam Spring 2022 Solutions                                                          13
In the last expression 𝑍 is a standard normal random variable. Using the standard normal
table, we get
𝑃 (don’t reject) = Φ(−2.04) − Φ(−5.96) ≈ 0.0207 − 0.
So Power = 1 − 0.0207 ≈ 0.98.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 5,10,5)
Bivariate data (4, 1), (−2, 1.5), (0, 0.5) is assumed to arise from the model 𝑦𝑖 = 𝑏|𝑥𝑖 − 2| + 𝑒𝑖 ,
where 𝑏 is a constant and 𝑒𝑖 are independent random variables.
Given the above data and the assumptions from part (a), determine the least squares
estimate for 𝑏.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The sum of the squares of the errors is
3
𝑇 = ∑(𝑦𝑖 − 𝑏|𝑥𝑖 − 2|)2 .
𝑖=1
So, setting the derivative to 0 give
3
𝑑𝑇
= ∑ −2|𝑥𝑖 − 2|(𝑦𝑖 − 𝑏|𝑥𝑖 − 2|) = 0.
𝑑𝑏   𝑖=1
Solving we get
3                 3                       3
2
∑𝑖=1 𝑦𝑖 |𝑥𝑖 − 2|
𝑏 ∑ |𝑥𝑖 − 2| = ∑ 𝑦𝑖 |𝑥𝑖 − 2| ⇔ 𝑏 =            3
.
𝑖=1               𝑖=1                    ∑𝑖=1 |𝑥𝑖 − 2|2
Plugging in numbers we find 𝑏 = 3/8.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Basketball
Suppose that against a certain opponent the number of points the MIT basketball team scores
is normally distributed with unknown mean 𝜃 and unknown variance, 𝜎2 .
Suppose that over the course of the last 10 games between the two teams MIT scored the
following points:
59, 62, 59, 74, 70, 61, 62, 66, 62, 75
Compute a 95% 𝑡–confidence interval for 𝜃. Does 95% confidence mean that the proba-
bility 𝜃 is in the interval you just found is 95%?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We compute the data mean and variance 𝑥̄ = 65, 𝑠2 = 35.778. The number of
degrees of freedom is 9. We look up the critical value 𝑡9,0.025 = 2.262 in the 𝑡-table The
95% confidence interval is
𝑡9,0.025 𝑠       𝑡9,0.025 𝑠                √                  √
[𝑥 ̄ −      √       , 𝑥̄ + √         ] = [65 − 2.262 3.5778, 65 + 2.262 3.5778] = [60.721, 69.279]
𝑛                𝑛
On the exam you will be expected to be able to use the 𝑡-table. We won’t ask you to
compute by hand the mean and variance of 10 numbers.
95% confidence means that in 95% of experiments the random interval will contain the
true 𝜃. It is not the probability that 𝜃 is in the given interval. That depends on the prior
distribution for 𝜃, which we don’t know.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Basketball
Suppose that against a certain opponent the number of points the MIT basketball team scores
is normally distributed with unknown mean 𝜃 and unknown variance, 𝜎2 .
Suppose that over the course of the last 10 games between the two teams MIT scored the
following points:
59, 62, 59, 74, 70, 61, 62, 66, 62, 75
Let 𝑋 be the number of points scored in a game. Suppose that your friend is a confirmed
Bayesian with a priori belief 𝜃 ∼ 𝑁 (60, 16) and that 𝑋 ∼ 𝑁 (𝜃, 25). He computes a 95%
probability interval for 𝜃, given the data in part (a). How does this interval compare to the
intervals in (a) and (b)?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We use the normal-normal update formulas to find the posterior pdf for 𝜃.
1          10               𝑎60 + 𝑏65            2         1
𝑎=       ,   𝑏=      ,   𝜇post =             = 64.3,   𝜎post =       = 2.16.
16          25                 𝑎+𝑏                         𝑎+𝑏
The posterior pdf is 𝑓(𝜃|data) = N(64.3, 2.16). The posterior 95% probability interval for 𝜃
is                            √                  √
[64.3 − 𝑧0.025 2.16, 64.3 + 𝑧0.025 2.16] = [61.442, 67.206]
1', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Confidence interval 2
The volume in a set of wine bottles is known to follow a N(𝜇, 25) distribution. You take a
sample of the bottles and measure their volumes. How many bottles do you have to sample
to have a 95% confidence interval for 𝜇 with width 1?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Suppose we have taken data 𝑥1 , … , 𝑥𝑛 with mean 𝑥.̄ The 95% confidence interval
𝜎                           𝜎
for the mean is 𝑥 ± 𝑧0.025 √ . This has width 2 𝑧0.025 √ . Setting the width equal to 1 and
𝑛                           𝑛
substitituting values 𝑧0.025 = 1.96 and 𝜎 = 5 we get
5      √
2 ⋅ 1.96 √ = 1 ⇒   𝑛 = 19.6.
𝑛
So, 𝑛 = (19.6)2 = 384. .
√
If we use our rule of thumb that 𝑧0.025 = 2 we have      𝑛/10 = 2 ⇒ 𝑛 = 400.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Polling confidence intervals
You do a poll to see what fraction 𝑝 of the population supports candidate A over candidate
B.
Let 𝑝 be the fraction of the population who prefer candidate A. If you poll 400 people,
how many have to prefer candidate A so that the 90% confidence interval is entirely above
𝑝 = 0.5.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The 90% confidence interval is 𝑥 ± 𝑧0.05 ⋅ 2√1𝑛 . Since 𝑧0.05 = 1.64 and 𝑛 = 400
our confidence interval is
1
𝑥 ± 1.64 ⋅     = 𝑥 ± 0.041
40
If this is entirely above 0.5 we have 𝑥 − 0.041 > 0.5, so 𝑥 > 0.541. Let 𝑇 be the number
𝑇
out of 400 who prefer A. We have 𝑥 = 400     > 0.541, so 𝑇 > 216 .
2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(Confidence intervals)
A statistician chooses 20 randomly selected class days and counts the number of students
present in 18.05. They find a standard deviation of 4.06 students If the number of students
present is normally distributed, find the 95% confidence interval for the population standard
deviation of the number of students in attendance.

                                             2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have 𝑛 = 20 and 𝑠2 = 4.062 . If we fix a hypothesis for 𝜎2 we know
(𝑛 − 1)𝑠2
∼ 𝜒2𝑛−1
𝜎2
We used R to find the critical values. (Or use the 𝜒2 table.)
c025 = qchisq(0.975,19) = 32.852
c975 = qchisq(0.025,19) = 8.907
The 95% confidence interval for 𝜎2 is
(𝑛 − 1) ⋅ 𝑠2 (𝑛 − 1) ⋅ 𝑠2     19 ⋅ 4.062 19 ⋅ 4.062
[               ,             ]=[           ,           ] = [9.53, 35.16]
𝑐0.025       𝑐0.975         32.852      8.907
We can take square roots to find the 95% confidence interval for 𝜎
[3.09, 5.93]', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Empirical bootstrap
Suppose we had 100 data points 𝑥1 , … 𝑥100 with sample median 𝑞0.5̂ = 3.3.
3
Outline the steps needed to generate an empirical percentile bootstrap 90% confidence
interval for the median 𝑞0.5 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : For the percentile bootstrap, we don’t have to pivot, so the algebra is a little
shorter.
Step 1. We have the point estimate 𝑞0.5 ≈ 𝑞0.5
̂ = 3.3.
Step 2. Use the computer to generate many (say 10000) size 100 resamples of the original
data.
∗
Step 3. For each bootstrap sample compute and save the bootstrap median 𝑞0.5 .
Step 4. Find the quantiles 𝑐0.05 and 𝑐0.95 . (Remember 𝑐0.05 is the 5th percentile in the list
of bootstrap medians, etc.)
Step 5. The 90% percentile bootstrap confidence interval for 𝑞0.5 is
[𝑐0.05 , 𝑐0.95 ]', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Parametric bootstrap
Suppose we have a sample of size 100 drawn from a geom(𝑝) distribution with unknown
𝑝. The MLE estimate for 𝑝 is given by by 𝑝̂ = 1/𝑥.̄ Assume for our data 𝑥̄ = 3.30, so
𝑝̂ = 1/𝑥̄ = 0.30303.
Outline the steps needed to generate a parametric basic bootstrap 90% confidence interval.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Step 1. We have the point estimate 𝑝 ≈ 𝑝̂ = 0.30303.
Step 2. Use the computer to generate many (say 10000) size 100 samples. (These are called
the bootstrap samples.)
Step 3. For each sample compute 𝑝∗ = 1/𝑥∗̄ and 𝛿 ∗ = 𝑝∗ − 𝑝.̂
Step 4. Sort the 𝛿 ∗ and find the critical values 𝛿0.95 and 𝛿0.05 . (Remember 𝛿0.95 is the 5th
percentile etc.)
Step 5. The 90% bootstrap confidence interval for 𝑝 is
[𝑝̂ − 𝛿0.05 , 𝑝̂ − 𝛿0.95 ]
4', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
There are 3 arrangements of the word DAD, namely DAD, ADD, and DDA.
How many arrangements are there of the word PROBABILITY?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Sort the letters: A BB II L O P R T Y. There are 11 letters in all. We build
arrangements by starting with 11 ‘slots’ and placing the letters in these slots, e.g
A B I B I L O P R T Y
Create an arrangement in stages and count the number of possibilities at each stage:
11
Stage 1: Choose one of the 11 slots to put the A: ( )
1
10
Stage 2: Choose two of the remaining 10 slots to put the B’s: ( )
2
8
Stage 3: Choose two of the remaining 8 slots to put the I’s: ( )
2
6
Stage 4: Choose one of the remaining 6 slots to put the L: ( )
1
1
5
Stage 5: Choose one of the remaining 5 slots to put the O: ( )
1
4
Stage 6: Choose one of the remaining 4 slots to put the P: ( )
1
3
Stage 7: Choose one of the remaining 3 slots to put the R: ( )
1
2
Stage 8: Choose one of the remaining 2 slots to put the T: ( )
1
1
Stage 9: Use the last slot for the Y: ( )
1
Number of arrangements:
11 10 8 6 5 4 3 2 1               10 ⋅ 9 8 ⋅ 7
( )( )( )( )( )( )( )( )( ) = 11 ⋅       ⋅      ⋅ 6 ⋅ 5 ⋅ 4 ⋅ 3 ⋅ 2 ⋅ 1 = 9979200
1  2 2 1 1 1 1 1 1                 2      2
Note: choosing 11 out of 1 is so simple we could have immediately written 11 instead of
11
belaboring the issue by writing ( ). We wrote it this way to show one systematic way to
1
think about problems like this.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose you pick two cards from a deck of 52 playing cards. What is the
probability that they are both queens?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Using choices (order doesn’t matter):
4                                      52
Number of ways to pick 2 queens: ( ). Number of ways to pick 2 cards: ( ).
2                                       2
4
( )
2
All choices of 2 cards are equally likely. So, probability of 2 queens =
52
( )
2
Using permutations (order matters):
Number of ways to pick the first queen: 4. No. of ways to pick the second queen: 3.
Number of ways to pick the first card: 52. No. of ways to pick the second card: 51.
4⋅3
All arrangements of 2 cards are equally likely. So, probability of 2 queens: 52⋅51 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝐴 and 𝐵 be two events. Suppose the probability that neither 𝐴 or 𝐵
occurs is 2/3. What is the probability that one or both occur?

                                             1', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We are given 𝑃 (𝐴𝑐 ∩ 𝐵𝑐 ) = 2/3 and asked to find 𝑃 (𝐴 ∪ 𝐵).
𝐴𝑐 ∩ 𝐵𝑐 = (𝐴 ∪ 𝐵)𝑐 ⇒ 𝑃 (𝐴 ∪ 𝐵) = 1 − 𝑃 (𝐴𝑐 ∩ 𝐵𝑐 ) = 1/3.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
You roll a four-sided die 3 times. For this problem we’ll use the sample
space with 64 equally likely outcomes.
Write down this sample space in set notation.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Write down this sample space in set notation.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose we have 8 teams labeled 𝑇1 , …, 𝑇8 . Suppose they are ordered by
placing their names in a hat and drawing the names out one at a time.
How many ways can it happen that all the odd numbered teams are in the odd numbered
slots and all the even numbered teams are in the even numbered slots?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Slots 1, 3, 5, 7 are filled by 𝑇1 , 𝑇3 , 𝑇5 , 𝑇7 in any order: 4! ways.
Slots 2, 4, 6, 8 are filled by 𝑇2 , 𝑇4 , 𝑇6 , 𝑇8 in any order: 4! ways.
Solution: 4! ⋅ 4! = 576.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
More cards! Suppose you want to divide a 52 card deck into four hands
with 13 cards each. What is the probability that each hand has a king?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝐻𝑖 be the event that the 𝑖𝑡ℎ hand has one king. We have the conditional
probabilities
4 48                           3 36                             2 24
( )( )                         ( )( )                           ( )( )
1 12                           1 12                             1 12
𝑃 (𝐻1 ) =        ;         𝑃 (𝐻2 |𝐻1 ) =        ;      𝑃 (𝐻3 |𝐻1 ∩ 𝐻2 ) =
52                             39                               26
( )                            ( )                              ( )
13                             13                               13
𝑃 (𝐻4 |𝐻1 ∩ 𝐻2 ∩ 𝐻3 ) = 1
𝑃 (𝐻1 ∩ 𝐻2 ∩ 𝐻3 ∩ 𝐻4 ) = 𝑃 (𝐻4 |𝐻1 ∩ 𝐻2 ∩ 𝐻3 ) 𝑃 (𝐻3 |𝐻1 ∩ 𝐻2 ) 𝑃 (𝐻2 |𝐻1 ) 𝑃 (𝐻1 )
2 24 3 36 4 48
( )( )( )( )( )( )
1 12 1 12 1 12
=                    .
26 39 52
( )( )( )
13 13 13', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Corrupted by their power, the judges running the popular game show Amer-
ica’s Next Top Mathematician have been taking bribes from many of the contestants. Each
episode, a given contestant is either allowed to stay on the show or is kicked off.
If the contestant has been bribing the judges they will be allowed to stay with probability 1.
If the contestant has not been bribing the judges, they will be allowed to stay with probability
1/3.
Suppose that 1/4 of the contestants have been bribing the judges. The same contestants
bribe the judges in both rounds, i.e., if a contestant bribes them in the first round, they bribe
them in the second round too (and vice versa).
If you pick a random contestant who was allowed to stay during the first episode, what
is the probability that they were bribing the judges?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We first compute 𝑃 (𝑆1 ) using the law of total probability.
1 1 3 1
𝑃 (𝑆1 ) = 𝑃 (𝑆1 |𝐵)𝑃 (𝐵) + 𝑃 (𝑆1 |𝐻)𝑃 (𝐻) = 1 ⋅                + ⋅ = .
4 3 4 2
𝑃 (𝐵)       1/4  1
We therefore have (by Bayes’ rule) 𝑃 (𝐵|𝑆1 ) = 𝑃 (𝑆1 |𝐵)                     =1⋅     = .
𝑃 (𝑆1 )     1/2  2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Corrupted by their power, the judges running the popular game show Amer-
ica’s Next Top Mathematician have been taking bribes from many of the contestants. Each
episode, a given contestant is either allowed to stay on the show or is kicked off.
If the contestant has been bribing the judges they will be allowed to stay with probability 1.
If the contestant has not been bribing the judges, they will be allowed to stay with probability
1/3.
Suppose that 1/4 of the contestants have been bribing the judges. The same contestants
bribe the judges in both rounds, i.e., if a contestant bribes them in the first round, they bribe
them in the second round too (and vice versa).
We want to compute 𝑃 (𝐿2 |𝑆1 ) =                    .
𝑃 (𝑆1 )
From the calculation we did in part (a), 𝑃 (𝑆1 ) = 1/2. For the numerator, we have (see the
tree)
1 2 3  1
𝑃 (𝐿2 ∩ 𝑆1 ) = 𝑃 (𝐿2 ∩ 𝑆1 |𝐵)𝑃 (𝐵) + 𝑃 (𝐿2 ∩ 𝑆1 |𝐻)𝑃 (𝐻) = 0 ⋅                         + ⋅ =
4 9 4  6
1/6  1
Therefore 𝑃 (𝐿2 |𝑆1 ) =       = .
1/2  3', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The following tree shows the setting. Stay1 means the contestant was allowed
to stay during the first episode and stay2 means the they were allowed to stay during the
second.
1/4           3/4
Bribe                             Honest
1           0                   1/3            2/3
Stay1            Leave1           Stay1           Leave1
1       0                     1/3            2/3
Stay2     Leave2                Stay2         Leave2
Let’s name the relevant events:
𝐵 = the contestant is bribing the judges
𝐻 = the contestant is honest (not bribing the judges)
𝑆1 = the contestant was allowed to stay during the first episode
𝑆2 = the contestant was allowed to stay during the second episode
𝐿1 = the contestant was asked to leave during the first episode
𝐿2 = the contestant was asked to leave during the second episode', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Consider the Monty Hall problem. Let’s label the door with the car behind
it 𝑎 and the other two doors 𝑏 and 𝑐. In the game the contestant chooses a door and then
Monty chooses a door, so we can label each outcome as ‘contestant followed by Monty’, e.g
𝑎𝑏 means the contestant chose 𝑎 and Monty chose 𝑏.
Make a probability tree showing all possible outcomes.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : With this strategy the contestant wins with {bc, cb}. The probability of winning is
𝑃 (𝑏𝑐) + 𝑃 (𝑐𝑏) = 2/3. (Both the tree and the table show this.)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Two dice are rolled.
𝐴 = ‘sum of two dice equals 3’
𝐵 = ‘sum of two dice equals 7’
𝐶 = ‘at least one of the dice shows a 1’
What is 𝑃 (𝐴|𝐶)?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑃 (𝐴|𝐶) =               =       = ..
𝑃 (𝐶)    11/36  11
𝑃 (𝐵 ∩ 𝐶)    2/36   2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Two dice are rolled.
𝐴 = ‘sum of two dice equals 3’
𝐵 = ‘sum of two dice equals 7’
𝐶 = ‘at least one of the dice shows a 1’
𝑃 (𝐴) = 2/36 ≠ 𝑃 (𝐴|𝐶), so they are not independent. Similarly, 𝑃 (𝐵) = 6/36 ≠
𝑃 (𝐵|𝐶), so they are not independent.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Sample space =
Ω = {(1, 1), (1, 2), (1, 3), … , (6, 6) } = {(𝑖, 𝑗) | 𝑖, 𝑗 = 1, 2, 3, 4, 5, 6 }.
(Each outcome is equally likely, with probability 1/36.)
𝐴 = {(1, 2), (2, 1)},
𝐵 = {(1, 6), (2, 5), (3, 4), (4, 3), (5, 2), (6, 1)}
𝐶 = {(1, 1), (1, 2), (1, 3), (1, 4), (1, 5), (1, 6), (2, 1), (3, 1), (4, 1), (5, 1), (6, 1)}
𝑃 (𝐴 ∩ 𝐶)    2/36   2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose you have an urn containing 7 red and 3 blue balls. You draw three
balls at random. On each draw, if the ball is red you set it aside and if the ball is blue you
put it back in the urn. What is the probability that the third draw is blue?
(If you get a blue ball it counts as a draw even though you put it back in the urn.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Here is the game tree, 𝑅1 means red on the first draw etc.
7/10                         3/10
𝑅1                                                    𝐵1
6/9                  3/9                          7/10             3/10
𝑅2                               𝐵2               𝑅2                           𝐵2
5/8       3/8            6/9             3/9      6/9        3/9     7/10          3/10
𝑅3              𝐵3 𝑅3                        𝐵3 𝑅3                 𝐵3 𝑅3                 𝐵3
Summing the probability to all the 𝐵3 nodes we get
7 6 3      7 3 3         3 7 3        3 3 3
𝑃 (𝐵3 ) =   ⋅ ⋅ +       ⋅ ⋅ +        ⋅   ⋅ +       ⋅ ⋅   = 0.350.
10 9 8    10 9 9         10 10 9      10 10 10', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose that 𝑃 (𝐴) = 0.4, 𝑃 (𝐵) = 0.3 and 𝑃 ((𝐴 ∪ 𝐵)𝐶 ) = 0.42. Are 𝐴 and
𝐵 independent?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have 𝑃 (𝐴 ∪ 𝐵) = 1 − 0.42 = 0.58 and we know because of the inclusion-
exclusion principle that
𝑃 (𝐴 ∪ 𝐵) = 𝑃 (𝐴) + 𝑃 (𝐵) − 𝑃 (𝐴 ∩ 𝐵).
Thus,
𝑃 (𝐴 ∩ 𝐵) = 𝑃 (𝐴) + 𝑃 (𝐵) − 𝑃 (𝐴 ∪ 𝐵) = 0.4 + 0.3 − 0.58 = 0.12 = (0.4)(0.3) = 𝑃 (𝐴)𝑃 (𝐵).
So, 𝐴 and 𝐵 are independent.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose 𝐴 and 𝐵 are events with 0 < 𝑃 (𝐴) < 1 and 0 < 𝑃 (𝐵) < 1.
If 𝐴 and 𝐵 are independent can they be disjoint?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : No, they cannot be disjoint: same reason as in part (a).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose that 𝑋 takes values between 0 and 1 and has probability density
function 2𝑥. Compute Var(𝑋) and Var(𝑋 2 ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We will make use of the formula Var(𝑌 ) = 𝐸[𝑌 2 ] − 𝐸[𝑌 ]2 . First we compute
1
2
𝐸[𝑋] = ∫ 𝑥 ⋅ 2𝑥𝑑𝑥 =
0                3
1
1
𝐸[𝑋 2 ] = ∫ 𝑥2 ⋅ 2𝑥𝑑𝑥 =
0                 2
1
1
𝐸[𝑋 ] = ∫ 𝑥4 ⋅ 2𝑥𝑑𝑥 = .
4
0            3
Thus,
2         1 4   1
Var(𝑋) = 𝐸[𝑋 2 ] − (𝐸[𝑋]) =               − =
2 9  18
and
2        1 1  1
Var(𝑋 2 ) = 𝐸[𝑋 4 ] − (𝐸[𝑋 2 ]) =          − = .
3 4 12', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose 𝑋 is a random variable with 𝐸[𝑋] = 5 and Var(𝑋) = 2. What is
𝐸[𝑋 2 ]?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Use Var(𝑋) = 𝐸[𝑋 2 ] − 𝐸[𝑋]2 ⇒ 2 = 𝐸[𝑋 2 ] − 25 ⇒ 𝐸[𝑋 2 ] = 27.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose you roll a fair 6-sided die 100 times (independently), and you get
$3 every time you roll a 6.
Let 𝑋1 be the number of dollars you win on rolls 1 through 25.
Let 𝑋2 be the number of dollars you win on rolls 26 through 50.
Let 𝑋3 be the number of dollars you win on rolls 51 through 75.
Let 𝑋4 be the number of dollars you win on rolls 76 throught 100.
Let 𝑋 = 𝑋1 + 𝑋2 + 𝑋3 + 𝑋4 be the total number of dollars you win over all 100 rolls.
What is the probability mass function of 𝑋?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : What is the probability mass function of 𝑋?', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose you roll a fair 6-sided die 100 times (independently), and you get
$3 every time you roll a 6.
Let 𝑋1 be the number of dollars you win on rolls 1 through 25.
Let 𝑋2 be the number of dollars you win on rolls 26 through 50.
Let 𝑋3 be the number of dollars you win on rolls 51 through 75.
Let 𝑋4 be the number of dollars you win on rolls 76 throught 100.
Let 𝑋 = 𝑋1 + 𝑋2 + 𝑋3 + 𝑋4 be the total number of dollars you win over all 100 rolls.
(i) Let 𝑇1 be the total number of times you roll a 6 in the first 25 rolls. So, 𝑋1 = 3𝑇1
and 𝑌 = 12𝑇1 .
Now, 𝑇1 ∼ Binomial(25, 1/6), so
𝐸[𝑌 ] = 12𝐸[𝑇1 ] = 12 ⋅ 25 ⋅ 16 = 50.
and
1 5
Var(𝑌 ) = 144Var(𝑇1 ) = 144 ⋅ 25 ⋅⋅ = 500.
6 6
(ii) The expectations are the same by linearity because 𝑋 and 𝑌 are the both
3 × 100 × a Bernoulli(1/6) random variable.
For the variance, Var(𝑋) = 4Var(𝑋1 ) because 𝑋 is the sum of 4 independent variables all
identical to 𝑋1 . However Var(𝑌 ) = Var(4𝑋1 ) = 16Var(𝑋1 ). So, the variance of 𝑌 is 4
times that of 𝑋. This should make some intuitive sense because 𝑋 is built out of more
independent trials than 𝑋1 .
Another way of thinking about it is that the difference between 𝑌 and its expectation is
four times the difference between 𝑋1 and its expectation. However, the difference between
𝑋 and its expectation is the sum of such a difference for 𝑋1 , 𝑋2 , 𝑋3 , and 𝑋4 . It’s probably
the case that some of these deviations are positive and some are negative, so the absolute
value of this difference for the sum is probably less than four times the absolute value of this
difference for one of the variables, i.e. the deviations are likely to cancel to some extent.
5     Probability Mass Functions, Probability Density Functions
and Cumulative Distribution Functions', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (a) There are a number of ways to present this.
Let 𝑇 be the total number of times you roll a 6 in the 100 rolls. We know 𝑇 ∼ Binomial(100, 1/6).
Since you win $3 every time you roll a 6, we have 𝑋 = 3𝑇 . So, we can write
100  1 𝑘 5 100−𝑘
𝑃 (𝑋 = 3𝑘) = (      )( ) ( )      ,         for 𝑘 = 0, 1, 2, … , 100.
𝑘   6   6
Alternatively we could write
100   1 𝑥/3 5 100−𝑥/3
𝑃 (𝑋 = 𝑥) = (       )( ) ( )          ,        for 𝑥 = 0, 3, 6, … , 300.
𝑥/3   6     6', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose that 𝑋 is uniform on [0, 1]. Compute the pdf and cdf of 𝑋.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have 𝑓𝑋 (𝑥) = 1 for 0 ≤ 𝑥 ≤ 1. The cdf of 𝑋 is
𝑥                   𝑥
𝐹𝑋 (𝑥) = ∫ 𝑓𝑋 (𝑡)𝑑𝑡 = ∫ 1𝑑𝑡 = 𝑥.
0                   0', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
If 𝑌 = 𝑋 2 , compute the pdf and cdf of 𝑌 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : √            √
𝐹𝑌 (𝑦) = 𝑃 (𝑌 ≤ 𝑦) = 𝑃 (𝑋 2 ≤ 𝑦) = 𝑃 (𝑋 ≤              𝑦) = 1 − e−𝜆 𝑦 .
Differentiating 𝐹𝑌 (𝑦) with respect to 𝑦, we have
𝜆 − 1 −𝜆√𝑦
𝑓𝑌 (𝑦) =        𝑦 2e     .
2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose that 𝑋 is a random variable that takes on values 0, 2 and 3 with
probabilities 0.3, 0.1, 0.6 respectively. Let 𝑌 = 3(𝑋 − 1)2 .
What is the variance of 𝑋?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐸[𝑋 2 ] = 0 ⋅ 0.3 + 4 ⋅ 0.1 + 9 ⋅ 0.6 = 5.8 ⇒ Var(𝑋) = 𝐸[𝑋 2 ] − 𝐸[𝑋]2 =
5.8 − 4 = 1.8.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose that 𝑋 is a random variable that takes on values 0, 2 and 3 with
probabilities 0.3, 0.1, 0.6 respectively. Let 𝑌 = 3(𝑋 − 1)2 .
Let 𝐹𝑌 (𝑡) be the cumulative density function of 𝑌 . What is 𝐹𝑌 (7)?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : From the table we see that 𝐹𝑌 (7) = 𝑃 (𝑌 ≤ 7) = 0.4.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
A continuous random variable 𝑋 has PDF 𝑓(𝑥) = 𝑥 + 𝑎𝑥2 on [0,1]
Find 𝑎, the CDF and 𝑃 (0.5 < 𝑋 < 1).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : First we find the value of 𝑎:
1                 1
1 𝑎
∫ 𝑓(𝑥) 𝑑𝑥 = 1 = ∫ 𝑥 + 𝑎𝑥2 𝑑𝑥 =           +  ⇒ 𝑎 = 3/2.
0                 0                    2 3
The CDF is 𝐹𝑋 (𝑥) = 𝑃 (𝑋 ≤ 𝑥). We break this into cases:
(i) 𝑏 < 0, so 𝐹𝑋 (𝑏) = 0.
𝑏                    2   3
(ii) 0 ≤ 𝑏 ≤ 1, so 𝐹𝑋 (𝑏) = ∫0 𝑥 + 32 𝑥2 𝑑𝑥 = 𝑏2 + 𝑏2 .
(iii) 1 < 𝑥, so 𝐹𝑋 (𝑏) = 1.
Using 𝐹𝑋 we get
0.52 + 0.53   13
𝑃 (0.5 < 𝑋 < 1) = 𝐹𝑋 (1) − 𝐹𝑋 (0.5) = 1 − (                  )= .
2        16', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝑋 be a discrete random variable with pmf 𝑝 given by:
𝑥    −2   −1    0    1   2
𝑝(𝑥) 1/15 2/15 3/15 4/15 5/15
Let 𝑌 = 𝑋 2 . Find the pmf of 𝑌 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑌 = 𝑋 2 . Find the pmf of 𝑌 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝑋 be a discrete random variable with pmf 𝑝 given by:
𝑥    −2   −1    0    1   2
𝑝(𝑥) 1/15 2/15 3/15 4/15 5/15
Find the value the cdf of 𝑌 at -3/2, 3/4, 7/8, 1, 1.5, 5.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (a) Note: 𝑌 = 1 when 𝑋 = 1 or 𝑋 = −1, so
𝑃 (𝑌 = 1) = 𝑃 (𝑋 = 1) + 𝑃 (𝑋 = −1).
Values 𝑦 of 𝑌           0        1       4
pmf 𝑝𝑌 (𝑦)         3/15     6/15    6/15', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose 𝑋 has range [0,1] and has cdf
                                 𝐹 (𝑥) = 𝑥2       for 0 ≤ 𝑥 ≤ 1.


Compute 𝑃 ( 12 < 𝑋 < 34 ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑃 (1/2 ≤ 𝑋 ≤ 3/4) = 𝐹 (3/4) − 𝐹 (1/2) = (3/4)2 − (1/2)2 = 5/16 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Exponential Distribution
Suppose that buses arrive are scheduled to arrive at a bus stop at noon but are always 𝑋
minutes late, where 𝑋 is an exponential random variable with probability density function
𝑓𝑋 (𝑥) = 𝜆e−𝜆𝑥 . Suppose that you arrive at the bus stop precisely at noon.
Compute the probability that you have to wait for more than five minutes for the bus
to arrive.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We compute
5
𝑃 (𝑋 ≥ 5) = 1 − 𝑃 (𝑋 < 5) = 1 − ∫ 𝜆e−𝜆𝑥 𝑑𝑥 = 1 − (1 − e−5𝜆 ) = e−5𝜆 .
0', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Normal Distribution: Throughout these problems, let 𝜙 and Φ be the pdf
and cdf, respectively, of the standard normal distribution Suppose 𝑍 is a standard normal
random variable and let 𝑋 = 3𝑍 + 1.
Express 𝑃 (𝑋 ≤ 𝑥) in terms of Φ', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have
𝑥−1        𝑥−1
𝐹𝑋 (𝑥) = 𝑃 (𝑋 ≤ 𝑥) = 𝑃 (3𝑍 + 1 ≤ 𝑥) = 𝑃 (𝑍 ≤        ) = Φ(     ).
3          3', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Normal Distribution: Throughout these problems, let 𝜙 and Φ be the pdf
and cdf, respectively, of the standard normal distribution Suppose 𝑍 is a standard normal
random variable and let 𝑋 = 3𝑍 + 1.
Find 𝑃 (−1 ≤ 𝑋 ≤ 1)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have
2                      2
𝑃 (−1 ≤ 𝑋 ≤ 1) = 𝑃 (− ≤ 𝑍 ≤ 0) = Φ(0) − Φ (− ) ≈ 0.2475
3                      3', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Transforming Normal Distributions
Suppose 𝑍 ∼ N(0,1) and 𝑌 = e𝑍 .
Find the cdf 𝐹𝑌 (𝑎) and pdf 𝑓𝑌 (𝑦) for 𝑌 . (For the CDF, the best you can do is write it
in terms of Φ the standard normal cdf.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Note, 𝑌 follows what is called a log-normal distribution.
𝐹𝑌 (𝑎) = 𝑃 (𝑌 ≤ 𝑎) = 𝑃 (𝑒𝑍 ≤ 𝑎) = 𝑃 (𝑍 ≤ ln(𝑎)) = Φ(ln(𝑎)).
Differentiating using the chain rule:
𝑑           𝑑            1             1             2
𝑓𝑦 (𝑎) =      𝐹𝑌 (𝑎) =    Φ(ln(𝑎)) = 𝜙(ln(𝑎)) = √      e−(ln(𝑎)) /2 .
𝑑𝑎          𝑑𝑎           𝑎             2𝜋 𝑎', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(Random variables derived from normal random variables)
Let 𝑋1 , 𝑋2 , …𝑋𝑛 be i.i.d. N(0, 1) random variables.
Let 𝑌𝑛 = 𝑋12 + … + 𝑋𝑛2 .
Use the formula Var(𝑋𝑗 ) = 𝐸[𝑋𝑗2 ] − 𝐸[𝑋𝑗 ]2 to show 𝐸[𝑋𝑗2 ] = 1.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Var(𝑋𝑗 ) = 1 = 𝐸[𝑋𝑗2 ] − 𝐸[𝑋𝑗 ]2 = 𝐸[𝑋𝑗2 ]. QED', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(Random variables derived from normal random variables)
Let 𝑋1 , 𝑋2 , …𝑋𝑛 be i.i.d. N(0, 1) random variables.
Let 𝑌𝑛 = 𝑋12 + … + 𝑋𝑛2 .
Deduce from parts (a) and (b) that Var(𝑋𝑗2 ) = 2.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Var(𝑋𝑗2 ) = 𝐸[𝑋𝑗4 ] − 𝐸[𝑋𝑗2 ]2 = 3 − 1 = 2. QED', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
More Transforming Normal Distributions
Suppose 𝑍 is a standard normal random variable and let 𝑌 = 𝑎𝑍 + 𝑏, where 𝑎 > 0 and
𝑏 are constants.
Show 𝑌 ∼ N(𝑏, 𝑎2 ) (remember our notation for normal distributions uses mean and vari-
ance).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝜙(𝑧) and Φ(𝑧) be the PDF and CDF of 𝑍.
𝐹𝑌 (𝑦) = 𝑃 (𝑌 ≤ 𝑦) = 𝑃 (𝑎𝑍 + 𝑏 ≤ 𝑦) = 𝑃 (𝑍 ≤ (𝑦 − 𝑏)/𝑎) = Φ((𝑦 − 𝑏)/𝑎).
Differentiating:
𝑑         𝑑                1                 1           2   2
𝑓𝑌 (𝑦) =     𝐹 (𝑦) =    Φ((𝑦 − 𝑏)/𝑎) = 𝜙((𝑦 − 𝑏)/𝑎) = √      e−(𝑦−𝑏) /2𝑎 .
𝑑𝑦 𝑌      𝑑𝑦               𝑎                 2𝜋 𝑎
Since this is the density for N(𝑏, 𝑎2 ) we have shown 𝑌 ∼ N(𝑏, 𝑎2 ).
𝑌 −𝜇', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(Sums of normal random variables)
Let 𝑋, 𝑌 be independent random variables where 𝑋 ∼ 𝑁 (2, 5) and 𝑌 ∼ 𝑁 (5, 9) (we use the
notation 𝑁 (𝜇, 𝜎2 )). Let 𝑊 = 3𝑋 − 2𝑌 + 1.
Compute 𝐸[𝑊 ] and Var(𝑊 ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐸[𝑊 ] = 3𝐸[𝑋] − 2𝐸[𝑌 ] + 1 = 6 − 10 + 1 = −3
Var(𝑊 ) = 9Var(𝑋) + 4Var(𝑌 ) = 45 + 36 = 81', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝑋 ∼ U(𝑎, 𝑏). Compute 𝐸[𝑋] and Var(𝑋).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Method 1
1
𝑈 (𝑎, 𝑏) has density 𝑓(𝑥) =       on [𝑎, 𝑏]. So,
𝑏−𝑎
𝑏                     𝑏                𝑏
1             𝑥2       𝑏 2 − 𝑎2   𝑎+𝑏
𝐸[𝑋] = ∫ 𝑥𝑓(𝑥) 𝑑𝑥 =    ∫ 𝑥 𝑑𝑥 =         ∣ =          =     .
𝑎            𝑏−𝑎 𝑎       2(𝑏 − 𝑎) 𝑎 2(𝑏 − 𝑎)     2
𝑏                         𝑏                𝑏
2          2     1              𝑥3       𝑏 3 − 𝑎3
𝐸[𝑋 ] = ∫ 𝑥 𝑓(𝑥) 𝑑𝑥 =    ∫ 𝑥2 𝑑𝑥 =         ∣ =          .
𝑎             𝑏−𝑎 𝑎        3(𝑏 − 𝑎) 𝑎 3(𝑏 − 𝑎)
Finding Var(𝑋) now requires a little algebra,
𝑏 3 − 𝑎3   (𝑏 + 𝑎)2
Var(𝑋) = 𝐸[𝑋 2 ] − 𝐸[𝑋]2 =              −
3(𝑏 − 𝑎)       4
4(𝑏3 − 𝑎3 ) − 3(𝑏 − 𝑎)(𝑏 + 𝑎)2   𝑏3 − 3𝑎𝑏2 + 3𝑎2 𝑏 − 𝑎3    (𝑏 − 𝑎)3   (𝑏 − 𝑎)2
=                                  =                        =           =          .
12(𝑏 − 𝑎)                   12(𝑏 − 𝑎)          12(𝑏 − 𝑎)      12
Method 2
There is an easier way to find 𝐸[𝑋] and Var(𝑋).
Let 𝑈 ∼ U(𝑎, 𝑏). Then the calculations above show 𝐸[𝑈 ] = 1/2 and (𝐸[𝑈 2 ] = 1/3 ⇒
Var(𝑈 ) = 1/3 − 1/4 = 1/12.
Now, we know 𝑋 = (𝑏 − 𝑎)𝑈 + 𝑎, so 𝐸[𝑋] = (𝑏 − 𝑎)𝐸[𝑈 ] + 𝑎 = (𝑏 − 𝑎)/2 + 𝑎 = (𝑏 + 𝑎)/2
and Var(𝑋) = (𝑏 − 𝑎)2 Var(𝑈 ) = (𝑏 − 𝑎)2 /12.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
In 𝑛 + 𝑚 independent Bernoulli(𝑝) trials, let 𝑆𝑛 be the number of successes
in the first 𝑛 trials and 𝑇𝑚 the number of successes in the last 𝑚 trials.
What is the distribution of 𝑇𝑚 ? Why?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑇𝑚 ∼ Binomial(𝑚, 𝑝), since it is the number of successes in 𝑚 independent
Bernoulli trials.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
In 𝑛 + 𝑚 independent Bernoulli(𝑝) trials, let 𝑆𝑛 be the number of successes
in the first 𝑛 trials and 𝑇𝑚 the number of successes in the last 𝑚 trials.
Are 𝑆𝑛 and 𝑇𝑚 independent? Why?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Yes, 𝑆𝑛 and 𝑇𝑚 are independent. We haven’t given a formal definition of inde-
pendent random variables yet. But, we know it means that knowing 𝑆𝑛 gives no information
about 𝑇𝑚 . This is clear since the first 𝑛 trials are independent of the last 𝑚.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Pareto and the 80-20 rule.
Pareto was an economist who used the Pareto distribution to model the wealth in a society.
For a fixed baseline 𝑚, the Pareto density with parameter 𝛼 is
𝛼 𝑚𝛼
𝑓(𝑥) =          for 𝑥 ≥ 𝑚.
𝑥𝛼+1
Assume 𝑋 is a random variable that follows such a distribution.
Compute 𝑃 (𝑋 > 𝑎) (you may assume 𝑎 ≥ 𝑚).
∞
𝛼 𝑚𝛼     𝑚𝛼 ∞   𝑚𝛼', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑃 (𝑋 > 𝑎) = ∫                 = −    ∣ =    .
𝑎       𝑥𝛼+1     𝑥𝛼 𝑎   𝑎𝛼', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(Another Arithmetic Puzzle)
Let 𝑋 and 𝑌 be two independent Bernoulli(0.5) random variables. Define 𝑆 and 𝑇 by:
𝑆 =𝑋+𝑌      and 𝑇 = 𝑋 − 𝑌 .
Find the joint and marginal pmf’s for 𝑆 and 𝑇 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Find the joint and marginal pmf’s for 𝑆 and 𝑇 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝑋 and 𝑌 be two continuous random variables with joint pdf
𝑓(𝑥, 𝑦) = 𝑐𝑥2 𝑦(1 + 𝑦) for 0 ≤ 𝑥 ≤ 3 and 0 ≤ 𝑦 ≤ 3,
and 𝑓(𝑥, 𝑦) = 0 otherwise.
Determine the joint cdf, 𝐹 (𝑎, 𝑏), of 𝑋 and 𝑌 for 𝑎 and 𝑏 between 0 and 3.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : For 0 ≤ 𝑎 ≤ 3 and 0 ≤ 𝑏 ≤ 3. we have
𝑎       𝑏
𝑎3 𝑏2 𝑎3 𝑏3
𝐹 (𝑎, 𝑏) = ∫ ∫ 𝑓(𝑥, 𝑦)𝑑𝑦 𝑑𝑥 = 𝑐 (                                         +      )
0       0                                         6     9', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝑋 and 𝑌 be two continuous random variables with joint pdf
𝑓(𝑥, 𝑦) = 𝑐𝑥2 𝑦(1 + 𝑦) for 0 ≤ 𝑥 ≤ 3 and 0 ≤ 𝑦 ≤ 3,
and 𝑓(𝑥, 𝑦) = 0 otherwise.
Find the marginal pdf 𝑓𝑋 (𝑥) directly from 𝑓(𝑥, 𝑦) and check that it is the derivative of
𝐹𝑋 (𝑥).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : For 0 ≤ 𝑥 ≤ 3, we have, by integrating over the entire range for 𝑦,
3
32 33    27   1
𝑓𝑋 (𝑥) = ∫ 𝑓(𝑥, 𝑦) 𝑑𝑦 = 𝑐𝑥2 (                                + ) = 𝑐 𝑥2 = 𝑥2 .
0                                        2  3      2   9
𝑑
This is consistent with (c) because 𝑑𝑥 (𝑥3 /27) = 𝑥2 /9.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝑋 and 𝑌 be two random variables and let 𝑟, 𝑠, 𝑡, and 𝑢 be real numbers.
Show that Cov(𝑋 + 𝑠, 𝑌 + 𝑢) = Cov(𝑋, 𝑌 ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Show that Cov(𝑋 + 𝑠, 𝑌 + 𝑢) = Cov(𝑋, 𝑌 ).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝑋 and 𝑌 be two random variables and let 𝑟, 𝑠, 𝑡, and 𝑢 be real numbers.
This is more of the same. We give the argument with far fewer algebraic details
Cov(𝑟𝑋 + 𝑠, 𝑡𝑌 + 𝑢) = Cov(𝑟𝑋, 𝑡𝑌 ) (by part (a))
= 𝑟𝑡Cov(𝑋, 𝑌 ) (by part (b))', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (a) First note by linearity of expectation we have 𝐸[𝑋 + 𝑠] = 𝐸[𝑋] + 𝑠, thus
𝑋 + 𝑠 − 𝐸[𝑋 + 𝑠] = 𝑋 − 𝐸[𝑋].
Likewise 𝑌 + 𝑢 − 𝐸[𝑌 + 𝑢] = 𝑌 − 𝐸[𝑌 ].
Now using the definition of covariance we get
Cov(𝑋 + 𝑠, 𝑌 + 𝑢) = 𝐸[(𝑋 + 𝑠 − 𝐸[𝑋 + 𝑠]) ⋅ (𝑌 + 𝑢 − 𝐸[𝑌 + 𝑢])]
= 𝐸[(𝑋 − 𝐸[𝑋]) ⋅ (𝑌 − 𝐸[𝑌 ])]
= Cov(𝑋, 𝑌 ).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Toss a fair coin 3 times. Let 𝑋 = the number of heads on the first toss, 𝑌
the total number of heads on the last two tosses, and 𝐹 the number of heads on the first two
tosses.
Give the joint probability table for 𝑋 and 𝑌 . Compute Cov(𝑋, 𝑌 ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (a) 𝑋 and 𝑌 are independent, so the table is computed from the product of the
known marginal probabilities. Since they are independent, Cov(𝑋, 𝑌 ) = 0.
𝑋
𝑌\\         0     1        𝑃𝑌
0         1/8   1/8       1/4
1         1/4   1/4       1/2
2         1/8   1/8       1/4
𝑃𝑋        1/2   1/2        1', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Covariance and Independence
Let 𝑋 be a random variable that takes values -2, -1, 0, 1, 2; each with probability 1/5.   Let
𝑌 = 𝑋2.
Find 𝐸[𝑋] and 𝐸[𝑌 ].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Using the marginal distributions:                 𝐸[𝑋] = 15 (−2 − 1 + 0 + 1 + 2) = 0.
1      2     2
𝐸[𝑌 ] = 0 ⋅ + 1 ⋅ + 4 ⋅ = 2.
5      5     5', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Covariance and Independence
Let 𝑋 be a random variable that takes values -2, -1, 0, 1, 2; each with probability 1/5.   Let
𝑌 = 𝑋2.
Show Cov(𝑋, 𝑌 ) = 0.
This is an example of uncorrelated but non-independent random variables. The reason this
can happen is that correlation only measures the linear dependence between the two variables.
In this case, 𝑋 and 𝑌 are not at all linearly related.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Using the table from part (a) and the means computed in part (d) we get:
Cov(𝑋, 𝑌 ) = 𝐸[𝑋𝑌 ] − 𝐸[𝑋]𝐸[𝑌 ]
1          1       1        1        1
= (−2)(4) + (−1)(1) + (0)(0) + (1)(1) + (2)(4)
5          5       5        5        5
= 0.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Continuous Joint Distributions
Suppose 𝑋 and 𝑌 are continuous random variables with joint density function 𝑓(𝑥, 𝑦) = 𝑥+𝑦
on the unit square [0, 1] × [0, 1].
Compute the marginal densities for 𝑋 and 𝑌 .
1                      1                              1
𝑦2       1', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑓𝑋 (𝑥) = ∫ 𝑓(𝑥, 𝑦) 𝑑𝑦 = ∫ (𝑥 + 𝑦) 𝑑𝑦 = 𝑥𝑦 +                                      ∣ = 𝑥+ .
0                      0                             2 0      2
By symmetry, 𝑓𝑌 (𝑦) = 𝑦 + 1/2.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Continuous Joint Distributions
Suppose 𝑋 and 𝑌 are continuous random variables with joint density function 𝑓(𝑥, 𝑦) = 𝑥+𝑦
on the unit square [0, 1] × [0, 1].
Compute 𝐸[𝑋], 𝐸[𝑌 ], 𝐸[𝑋 2 + 𝑌 2 ], Cov(𝑋, 𝑌 ).
1   1                              1              1        1
𝑦2              𝑥     7', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐸[𝑋] = ∫ ∫ 𝑥(𝑥 + 𝑦) 𝑑𝑦 𝑑𝑥 = ∫ [ 𝑥 𝑦 + 𝑥 ∣ ] 𝑑𝑥 = ∫ 𝑥2 + 𝑑𝑥 =    .         2
0 0                  0          2 0       0     2     12
1                      1
(Or, using (b), 𝐸[𝑋] = ∫ 𝑥𝑓𝑋 (𝑥) 𝑑𝑥 = ∫ 𝑥(𝑥 + 1/2) 𝑑𝑥 = 7/12.)
0                      0
By symmetry 𝐸[𝑌 ] = 7/12.
1       1
5
𝐸[𝑋 2 + 𝑌 2 ] = ∫ ∫ (𝑥2 + 𝑦2 )(𝑥 + 𝑦) 𝑑𝑦 𝑑𝑥 =                                   .
0       0                                              6
1       1
1
𝐸[𝑋𝑌 ] = ∫ ∫ 𝑥𝑦(𝑥 + 𝑦) 𝑑𝑦 𝑑𝑥 =                              .
0       0                                      3
1   49      1
Cov(𝑋, 𝑌 ) = 𝐸[𝑋𝑌 ] − 𝐸[𝑋]𝐸[𝑌 ] =                           −    = −     .
3 144      144', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Correlation
Flip a coin 5 times. Use properties of covariance to compute the covariance and correlation
between the number of heads on the first 3 and last 3 flips.



8   Law of Large Numbers, Central Limit Theorem', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : As usual let 𝑋𝑖 = the number of heads on the 𝑖th flip, i.e. 0 or 1.
Let 𝑋 = 𝑋1 + 𝑋2 + 𝑋3 the sum of the first 3 flips and 𝑌 = 𝑋3 + 𝑋4 + 𝑋5 the sum of the
last 3. Using the algebraic properties of covariance we have
Cov(𝑋, 𝑌 ) = Cov(𝑋1 + 𝑋2 + 𝑋3 , 𝑋3 + 𝑋4 + 𝑋5 )
= Cov(𝑋1 , 𝑋3 ) + Cov(𝑋1 , 𝑋4 ) + Cov(𝑋1 , 𝑋5 )
+ Cov(𝑋2 , 𝑋3 ) + Cov(𝑋2 , 𝑋4 ) + Cov(𝑋2 , 𝑋5 )
+ Cov(𝑋3 , 𝑋3 ) + Cov(𝑋3 , 𝑋4 ) + Cov(𝑋3 , 𝑋5 )
1
Because the 𝑋𝑖 are independent the only non-zero term in the above sum is Cov(𝑋3 𝑋3 ) = Var(𝑋3 ) =
4
Therefore, Cov(𝑋, 𝑌 ) = 14 .
We get the correlation by dividing by the standard deviations. Since 𝑋 is the sum of 3
independent Bernoulli(0.5) we have 𝜎𝑋 = √3/4
Cov(𝑋, 𝑌 )    1/4   1
Cor(𝑋, 𝑌 ) =               =       = .
𝜎𝑋 𝜎𝑌      (3)/4  3
8   Law of Large Numbers, Central Limit Theorem', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(Central Limit Theorem)
Let 𝑋1 , 𝑋2 , … , 𝑋81 be i.i.d., each with expected value 𝜇 = 𝐸[𝑋𝑖 ] = 5, and variance 𝜎2 =
Var(𝑋𝑖 ) = 4. Approximate 𝑃 (𝑋1 + 𝑋2 + ⋯ 𝑋81 > 369), using the central limit theorem.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑇 = 𝑋1 + 𝑋2 + … + 𝑋81 . The central limit theorem says that
𝑇 ≈ N(81 ∗ 5, 81 ∗ 4) = N(405, 182 )
Standardizing we have
𝑇 − 405   369 − 405
𝑃 (𝑇 > 369) = 𝑃 (         >           )
18          18
≈ 𝑃 (𝑍 > −2)
≈ 0.975
The value of 0.975 comes from the rule-of-thumb that 𝑃 (|𝑍| < 2) ≈ 0.95. A more exact
value (using R) is 𝑃 (𝑍 > −2) ≈ 0.9772.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(More Central Limit Theorem)
The average IQ in a population is 100 with standard deviation 15 (by definition, IQ is
normalized so this is the case). What is the probability that a randomly selected group of
100 people has an average IQ above 115?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑋𝑗 be the IQ of a randomly selected person. We are given 𝐸[𝑋𝑗 ] = 100 and
𝜎𝑋𝑗 = 15.
Let 𝑋 be the average of the IQ’s of 100 randomly selected people. Then we know
√
𝐸[𝑋] = 100 and 𝜎𝑋 = 15/ 100 = 1.5.
The problem asks for 𝑃 (𝑋 > 115). Standardizing we get 𝑃 (𝑋 > 115) ≈ 𝑃 (𝑍 > 10).
This is effectively 0.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Hospitals (binomial, CLT, etc)
• A certain town is served by two hospitals.
• Larger hospital: about 45 babies born each day.
• Smaller hospital about 15 babies born each day.
• For a period of 1 year, each hospital recorded the days on which more than 60% of the
babies born were boys.
Let 𝐿𝑖 (resp., 𝑆𝑖 ) be the Bernoulli random variable which takes the value 1 if more
than 60% of the babies born in the larger (resp., smaller) hospital on the 𝑖th day were boys.
Determine the distribution of 𝐿𝑖 and of 𝑆𝑖 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The random variable 𝑋𝐿 , giving the number of boys born in the larger
hospital on day 𝑖, is governed by a Bin(45, 0.5) distribution. So 𝐿𝑖 has a Ber(𝑝𝐿 ) distribution
with
45
45
𝑝𝐿 = 𝑃 (𝑋 > 27) = ∑ (          ) 0.545 ≈ 0.068
𝑘=28
𝑘
Similarly, the random variable 𝑋𝑆 , giving the number of boys born in the smaller hospital
on day 𝑖, is governed by a Bin(15, 0.5) distribution. So 𝑆𝑖 has a Ber(𝑝𝑆 ) distribution with
15
15
𝑝𝑆 = 𝑃 (𝑋𝑆 > 9) = ∑ (             ) 0.515 ≈ 0.151
𝑘=10
𝑘
We see that 𝑝𝑆 is indeed greater than 𝑝𝐿 , consistent with (𝑖𝑖).
365                  365', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Hospitals (binomial, CLT, etc)
• A certain town is served by two hospitals.
• Larger hospital: about 45 babies born each day.
• Smaller hospital about 15 babies born each day.
• For a period of 1 year, each hospital recorded the days on which more than 60% of the
babies born were boys.
Via the CLT, approximate the 0.84 quantile of 𝐿 (resp., 𝑆). Would you like to revise
your answer to part (a)?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : mean + sd in each case:
√
For 𝐿, 𝑞0.84 ≈ 25 + 23.
√
For 𝑆, 𝑞0.84 ≈ 55 + 47.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
R simulation
Consider 𝑋1 , 𝑋2 , …all independent and with distribution N(0, 1). Let 𝑋 𝑚 be the average of
𝑋1 , …𝑋𝑛 .
Give 𝐸[𝑋 𝑛 ] and 𝜎𝑋𝑛 exactly.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐸[𝑋𝑗 ] = 0 ⇒ 𝐸[𝑋 𝑛 ] = 0.
𝑋1 + … + 𝑋𝑛    1           1
Var(𝑋𝑗 ) = 1 ⇒ Var (               )=   ⇒ 𝜎𝑋 𝑛 = √ .
𝑛         𝑛            𝑛', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
R Exercise
Let 𝑋1 , 𝑋2 , 𝑋3 , 𝑋4 , 𝑋5 be independent 𝑈 (0, 1) random variables.
Let 𝑋 = 𝑋1 + 𝑋2 + 𝑋3 and 𝑌 = 𝑋3 + 𝑋4 + 𝑋5 .
Use the runif() function to simulate 1000 trials of each of these variables. Use these to
estimate Cov(𝑋, 𝑌 ).
Extra Credit
Compute this covariance exactly.




18.05 Introduction to Probability and Statistics
Spring 2022


For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : a = runif(5*1000,0,1)
data = matrix(a,5,1000)
x = colSums(data[1:3,])
y = colSums(data[3:5,])
print(cov(x,y))
Extra Credit
Compute this covariance exactly.
Solution: Method 1 (Algebra)
First, if 𝑖 ≠ 𝑗 we know 𝑋𝑖 and 𝑋𝑗 are independent, so Cov(𝑋𝑖 , 𝑋𝑗 ) = 0.
Cov(𝑋, 𝑌 ) = Cov(𝑋1 + 𝑋2 + 𝑋3 , 𝑋3 + 𝑋4 + 𝑋5 )
= Cov(𝑋1 , 𝑋3 ) + Cov(𝑋1 , 𝑋4 ) + Cov(𝑋1 , 𝑋5 )
+ Cov(𝑋2 , 𝑋3 ) + Cov(𝑋2 , 𝑋4 ) + Cov(𝑋2 , 𝑋5 )
+ Cov(𝑋3 , 𝑋3 ) + Cov(𝑋3 , 𝑋4 ) + Cov(𝑋3 , 𝑋5 )
(most of these terms are 0)
= Cov(𝑋3 , 𝑋3 )
= Var(𝑋3 )
1
=      (known variance of a uniform(0,1) distribution)
12
Method 2 (Multivariable calculus)
In 5 dimensional space we have the joint distribution
𝑓(𝑥1 , 𝑥2 , 𝑥3 , 𝑥4 , 𝑥5 ) = 1.
Computing directly
1       1       1       1       1
𝐸[𝑋] = 𝐸[𝑋1 + 𝑋2 + 𝑋3 ] = ∫ ∫ ∫ ∫ ∫ (𝑥1 + 𝑥2 + 𝑥3 ) 𝑑𝑥1 𝑑𝑥2 𝑑𝑥3 , 𝑑𝑥4 𝑑𝑥5
0       0       0       0       0
1
first integral = + 𝑥2 + 𝑥3
2
1 1
second integral = + + 𝑥3 = 1 + 𝑥3
2 2
3
third integral =
2
3
fourth integral =
2
3
fifth integral =
2
So, 𝐸[𝑋] = 3/2, likewise 𝐸[𝑌 ] = 3/2.
1       1       1       1       1
𝐸[𝑋𝑌 ] = ∫ ∫ ∫ ∫ ∫ (𝑥1 + 𝑥2 + 𝑥3 )(𝑥3 + 𝑥4 + 𝑥5 ) 𝑑𝑥1 𝑑𝑥2 𝑑𝑥3 𝑑𝑥4 𝑑𝑥5
0       0       0       0       0
= 7/3.
1
Cov(𝑋, 𝑌 ) = 𝐸[𝑋𝑌 ] − 𝐸[𝑋]𝐸[𝑌 ] = 12 = 0.08333.
18.05 Introduction to Probability and Statistics
Spring 2022
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
If 𝑌 = 𝑋 2 , compute the pdf and cdf of 𝑌 .
1', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : √            √
𝐹𝑌 (𝑦) = 𝑃 (𝑌 ≤ 𝑦) = 𝑃 (𝑋 2 ≤ 𝑦) = 𝑃 (𝑋 ≤         𝑦) = 1 − e−𝜆 𝑦 .
Differentiating 𝐹𝑌 (𝑦) with respect to 𝑦, we have
𝜆 − 1 −𝜆√𝑦
𝑓𝑌 (𝑦) =       𝑦 2e     .
2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝑋 be a discrete random variable with pmf 𝑝 given by:
𝑥    −2   −1    0   1     2
𝑝(𝑥) 1/15 2/15 3/15 4/15 5/15
Let 𝑌 = 𝑋 2 . Find the pmf of 𝑌 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑌 = 𝑋 2 . Find the pmf of 𝑌 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝑋 be a discrete random variable with pmf 𝑝 given by:
𝑥    −2   −1    0   1     2
𝑝(𝑥) 1/15 2/15 3/15 4/15 5/15
Find the value the cdf of 𝑌 at -3/2, 3/4, 7/8, 1, 1.5, 5.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (a) Note: 𝑌 = 1 when 𝑋 = 1 or 𝑋 = −1, so
𝑃 (𝑌 = 1) = 𝑃 (𝑋 = 1) + 𝑃 (𝑋 = −1).
Values 𝑦 of 𝑌     0      1       4
pmf 𝑝𝑌 (𝑦)   3/15   6/15    6/15', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Hotel
A statistician chooses 27 randomly selected dates, and when examining the occupancy
records of a particular motel for those dates, finds a standard deviation of 5.86 rooms
rented. If the number of rooms rented is normally distributed, find the 95% confidence
interval for the population standard deviation of the number of rooms rented.


3   Bootstrapping', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have 𝑛 = 27 and 𝑠2 = 5.862 . If we fix a hypothesis for 𝜎2 we know
(𝑛 − 1)𝑠2
∼ 𝜒2𝑛−1
𝜎2
We used R to find the critical values. (Or use the 𝜒2 table at the end of this file.)
c025 = qchisq(0.975,26) = 41.923
c975 = qchisq(0.025,26) = 13.844
The 95% confidence interval for 𝜎2 is
(𝑛 − 1) ⋅ 𝑠2 (𝑛 − 1) ⋅ 𝑠2     26 ⋅ 5.862 26 ⋅ 5.862
[               ,             ]=[           ,           ] = [21.2968, 64.4926]
𝑐0.025       𝑐0.975         41.923     13.844
We can take square roots to find the 95% confidence interval for 𝜎
[4.6148, 8.0307]
On the exam we will give you enough of a table to compute the critical values you need for
𝜒2 distributions.
3   Bootstrapping', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Empirical bootstrap
Suppose we had 100 data points 𝑥1 , … 𝑥100 with sample median 𝑞0.5̂ = 3.3.
Suppose now that the sorted list in the previous problem consists of 200 empirical
bootstrap medians computed from resamples of size 100 drawn from the original data. Use
the list to construct a 90% precentile CI for 𝑞0.5 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The list covers steps 1-3 in part (a). Since it is sorted, step 4 is straightforward.
∗
The 5th and 95th percentiles for 𝑞0.5 are
2.89,     3.72
(Here we just took the 10th and 190th values. We could have interpolated between the
9th and 10th, and 190th and 191st entries, but this would not change our answer to two
decimal places.)
The above interval is our empirical percentile bootstrap confidence interval for the median.
4    Linear regression/Least squares', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
In this problem we will use maximum likelihood estimates to develop Gauss’
method of least squares for fitting lines to data.
Suppose you have bivariate data, that is, a sequence of pairs (𝑥1 , 𝑦1 ), … , (𝑥𝑛 , 𝑦𝑛 ). A common
model is that there is a linear relationship between 𝑥 and 𝑦, so in principle the data should
lie exactly along a line. However, since data has random noise this will not be the case.
What we can do is look for the line that best fits the data. To do this we will use a model
called simple linear regression.
For bivariate data the simple linear regression model assumes that the 𝑥𝑖 are not random
and that, for some values of the parameters 𝑎 and 𝑏, we have
𝑦𝑖 = 𝑎𝑥𝑖 + 𝑏 + random noise
To be more precise, we will assume that the value 𝑦𝑖 is drawn from a random variable of
the form
𝑌𝑖 ∼ 𝑎𝑥𝑖 + 𝑏 + 𝜀𝑖
where 𝜀𝑖 is a normal random variable with mean 0 and variance 𝜎2 . We assume all of the
random variables 𝜀𝑖 are independent and that 𝜎 is the same for all 𝑖.
Notes. 1. The goal in simple linear regression is to find the line, i.e. the values of 𝑎 and
𝑏 that best fit the data.
2. We think of 𝜀𝑖 as the random measurement error.
3. Remember that (𝑥𝑖 , 𝑦𝑖 ) are not variables. They are data values.
For general data (𝑥1 , 𝑦1 ), … , (𝑥𝑛 , 𝑦𝑛 ) give the likelihood and log likelihood functions
(again as functions of 𝑎, 𝑏, and 𝜎).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The likelihood function is just the product of the likelihoods found in part (a).
We’ll let 𝐿(𝑎, 𝑏, 𝜎) be the likelihood of the data and 𝑙(𝑎, 𝑏, 𝜎) be the log likelihood.
𝑛
1         𝑛            2    2
𝐿(𝑎, 𝑏, 𝜎) = ( √ ) e− ∑𝑖=1 (𝑦𝑖 −𝑎𝑥𝑖 −𝑏) /2𝜎
𝜎 2𝜋
√                 𝑛
(𝑦 − 𝑎𝑥𝑖 − 𝑏)2
𝑙(𝑎, 𝑏, 𝜎) = −𝑛 ln( 2𝜋) − 𝑛 ln(𝜎) − ∑ 𝑖                  .
𝑖=1
2𝜎2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
In this problem we will use maximum likelihood estimates to develop Gauss’
method of least squares for fitting lines to data.
Suppose you have bivariate data, that is, a sequence of pairs (𝑥1 , 𝑦1 ), … , (𝑥𝑛 , 𝑦𝑛 ). A common
model is that there is a linear relationship between 𝑥 and 𝑦, so in principle the data should
lie exactly along a line. However, since data has random noise this will not be the case.
What we can do is look for the line that best fits the data. To do this we will use a model
called simple linear regression.
For bivariate data the simple linear regression model assumes that the 𝑥𝑖 are not random
and that, for some values of the parameters 𝑎 and 𝑏, we have
𝑦𝑖 = 𝑎𝑥𝑖 + 𝑏 + random noise
To be more precise, we will assume that the value 𝑦𝑖 is drawn from a random variable of
the form
𝑌𝑖 ∼ 𝑎𝑥𝑖 + 𝑏 + 𝜀𝑖
where 𝜀𝑖 is a normal random variable with mean 0 and variance 𝜎2 . We assume all of the
random variables 𝜀𝑖 are independent and that 𝜎 is the same for all 𝑖.
Notes. 1. The goal in simple linear regression is to find the line, i.e. the values of 𝑎 and
𝑏 that best fit the data.
2. We think of 𝜀𝑖 as the random measurement error.
3. Remember that (𝑥𝑖 , 𝑦𝑖 ) are not variables. They are data values.
Suppose we have data (1, 8), (3, 2), (5, 1). Use your answer in part (b) to find the value
of 𝑎 and 𝑏 which gives the MLE for the best fitting line to the data.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Suppose we have data (1, 8), (3, 2), (5, 1). Use your answer in part (b) to find the value
of 𝑎 and 𝑏 which gives the MLE for the best fitting line to the data.
We have 𝑛 = 3 points. First we compute:
𝑆𝑥 = ∑ 𝑥𝑖 = 9,          𝑥̄ = 3,           𝑆𝑦 = ∑ 𝑦𝑖 = 11,     𝑦̄ = 11/3.
𝑆𝑥𝑥 = ∑ 𝑥2𝑖 = 35,           𝑆𝑥𝑦 = ∑ 𝑥𝑖 𝑦𝑖 = 19
So,
𝑆𝑥𝑦 /𝑛 − 𝑥𝑦̄ ̄   19/3 − 3 ⋅ 11/3     7
𝑎=                  =                 = −
𝑆𝑥𝑥 /𝑛 − 𝑥2̄        35/3 − 9         4
11 21    107
𝑏 = 𝑦 ̄ − 𝑎𝑥̄ =      +   =
3   4    12', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
What is the relationship between correlation and least squares fit line?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The correlation between 𝑥 and 𝑦 is the same as the coeﬀicient 𝑏1 of the best fit
line to the standardized data
𝑥 − 𝑥̄                 𝑦𝑖 − 𝑦̄
𝑢𝑖 = √𝑖     ,          𝑣𝑖 = √
𝑠𝑥𝑥                    𝑠𝑦𝑦', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Least Squares and MLE
In this problem we will see that the least squares fit of a line is just the MLE assuming the
error terms are normally distributed.
For bivariate data (𝑥1 , 𝑦1 ), … , (𝑥𝑛 , 𝑦𝑛 ), the simple linear regression model says that 𝑦𝑖 is a
random value generated by a random variable
𝑌𝑖 = 𝑎𝑥𝑖 + 𝑏 + 𝜀𝑖
where 𝑎, 𝑏, 𝑥𝑖 are fixed (not random) values, and 𝜀𝑖 is a random variable with mean 0 and
variance 𝜎2 .
Suppose that each 𝜀𝑖 ∼ N(0, 𝜎2 ). Show that 𝑌𝑖 ∼ N(𝑎𝑥𝑖 + 𝑏, 𝜎2 ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We’re given 𝜀𝑖 ∼ N(0, 𝜎2 ). Since 𝑎𝑥𝑖 + 𝑏 is a constant, 𝑌𝑖 is simply a shift of
𝜀𝑖 . Thus
𝐸[𝑌𝑖 ] = 𝑎𝑥𝑖 + 𝑏 + 𝐸[𝜀𝑖 ] = 𝑎𝑥𝑖 + 𝑏
Var(𝑌𝑖 ) = Var(𝜀𝑖 ) = 𝜎2 .
Since a shifted normal random variable is still normal (you should be able to show this by
transforming cdf’s) we have
𝑌𝑖 ∼ N(𝑎𝑥𝑖 + 𝑏, 𝜎2 ).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Least Squares and MLE
In this problem we will see that the least squares fit of a line is just the MLE assuming the
error terms are normally distributed.
For bivariate data (𝑥1 , 𝑦1 ), … , (𝑥𝑛 , 𝑦𝑛 ), the simple linear regression model says that 𝑦𝑖 is a
random value generated by a random variable
𝑌𝑖 = 𝑎𝑥𝑖 + 𝑏 + 𝜀𝑖
where 𝑎, 𝑏, 𝑥𝑖 are fixed (not random) values, and 𝜀𝑖 is a random variable with mean 0 and
variance 𝜎2 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The log likelihood is
𝑛                   1 𝑛
ln(𝑓(data | 𝜎, 𝑎, 𝑏)) = − log 2𝜋 − 𝑛 log 𝜎 − 2 ∑ (𝑦𝑖 − 𝑎𝑥𝑖 − 𝑏)2
2                  2𝜎 𝑖=1
If 𝜎 is constant then the only part of the log likelihood that varies is the sum in the last
term. So, the maximum likelihood is found by maximizing this sum:
𝑛
− ∑ (𝑦𝑖 − 𝑎𝑥𝑖 − 𝑏)2 .
𝑖=1
Notice the minus sign out front. This is exactly the same as minimizing
𝑛
∑ (𝑦𝑖 − 𝑎𝑥𝑖 − 𝑏)2 .
𝑖=1
This last expression is the expression minimized by least squares. Therefore, under our
normality assumptions, the values of 𝑎 and 𝑏 are the same for MLE and least squares.
18.05 Introduction to Probability and Statistics
Spring 2022
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
A coin is tossed 𝑛 times and lands heads 𝑘 times. Find the maximum likelihood estimate
for the probability 𝜃 of heads.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The computation is identical to part (a). The likelihood function is
𝑛
𝑝(data|𝜃) = ( )𝜃𝑘 (1 − 𝜃)𝑛−𝑘 = 𝑐𝜃𝑘 (1 − 𝜃)𝑛−𝑘 .
𝑘
To find the MLE we set the derivative of the log-likelihood and set it to 0.
ln(𝑝(data|𝜃)) = ln(𝑐) + 𝑘 ln(𝜃) + (𝑛 − 𝑘) ln(1 − 𝜃).
𝑑 ln(𝑝(data|𝜃))  𝑘 𝑛−𝑘
= −     = 0.
𝑑𝜃         𝜃  1−𝜃
The algebra leads to the MLE 𝜃 = 𝑘/𝑛 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose data 𝑥1 , … , 𝑥𝑛 is drawn from an exponential distribution exp(𝜆).
Find the maximum likelihood for 𝜆.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The pdf of exp(𝜆) is 𝑝(𝑥|𝜆) = 𝜆e−𝜆𝑥 . So the likelihood and log-likelihood
functions are
𝑝(data|𝜆) = 𝜆𝑛 e−𝜆(𝑥1 +⋯+𝑥𝑛 ) ,    ln(𝑝(data|𝜆)) = 𝑛 ln(𝜆) − 𝜆 ∑ 𝑥𝑖 .
Taking a derivative with respect to 𝜆 and setting it equal to 0:
𝑑 ln(𝑝(data|𝜆))  𝑛                                    1   ∑ 𝑥𝑖
= − ∑ 𝑥𝑖 = 0                     ⇒      =      = 𝑥.̄
𝑑𝜆         𝜆                                    𝜆    𝑛
So the MLE is 𝜆 = 1/𝑥̄ .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
You want to estimate the size of an MIT class that is closed to visitors.
You know that the students are numbered from 1 to 𝑛, where 𝑛 is the number of students.
You call three random students out of the classroom and ask for their numbers, which turn
out to be 1, 3, 7. Find the maximum likelihood estimate for 𝑛. (Hint: the student #’s are
drawn from a discrete uniform distribution.)


5   Bayesian updating: discrete prior, discrete likelihood', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If there are 𝑛 students in the room then for the data 1, 3, 7 (occuring in any
order) the likelihood is
⎧
{0                        for 𝑛 < 7
𝑝(data | 𝑛) =     𝑛
⎨              3!
{1/( 3 ) = 𝑛(𝑛−1)(𝑛−2)    for 𝑛 ≥ 7
⎩
Maximizing this does not require calculus. It clearly has a maximum when 𝑛 is as small as
possible. Answer: 𝑛 = 7 .
5   Bayesian updating: discrete prior, discrete likelihood', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Twins
Find the posterior odds the twins are identical. Do this by multiplying the prior odds
by the Bayes factor (likelihood ratio). Check this by computing the odds directly from your
answer to part (a).
𝑃 (identical)   1/4', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The prior odds 𝑂(identical) =                   =     = 1/3.
𝑃 (fraternal)   3/4
𝑃 (same sex | identical)    1
The Bayes factor 𝐵𝐹 =                               =     = 2.
𝑃 (same sex|fraternal)     1/2
1     2
So, posterior odds 𝑂(identical | same sex) = 𝑂(identical) ⋅ 𝐵𝐹 =      ⋅2= .
3     3
2/5  2
In part (a) we found the posterior odds 𝑂(identical | same sex) =       = . This is the same
3/5  3
as above.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Dice.
You have a drawer full of 4, 6, 8, 12 and 20-sided dice. You suspect that they are in
proportion 1:2:10:2:1. Your friend picks one at random and rolls it twice getting 5 both
times.
(i) What is the probability the next roll will be a 5?
(ii) What is the probability the next roll will be a 15?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We are asked for posterior predictive probabilities. Let 𝑥 be the value of the
next roll. We have to compute the total probability
𝑝(𝑥|data) = ∑ 𝑝(𝑥|𝐻)𝑝(𝐻|data) = ∑ likelihood × posterior.
The sum is over all hypotheses. We can organize the calculation in a table where we multiply
the posterior column by the appropriate likelihood column. The total posterior predictive
probability is the sum of the product column.
hyp.    posterior   likelihood      post. to (i)   likelihood         post. to (ii)
to data     (i) 𝑥 = 5                     (ii) 𝑥 = 15
𝐻4          0             0                0             0                 0
𝐻6      0.243457        1/6             0.04058          0                 0
𝐻8      0.684723        1/8             0.08559          0                 0
𝐻12     0.060864        1/12            0.00507          0                 0
𝐻20     0.010956        1/20            0.00055        1/20             0.00055
Tot.     0.22819                        0.13179                         0.00055
So, (i) 𝑝(𝑥 = 5|data) = 0.132 and (ii) 𝑝(𝑥 = 15|data) = 0.00055.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Sameer has two coins: one fair coin and one biased coin which lands heads with probability
3/4. He picks one coin at random (50-50) and flips it repeatedly until he gets a tails.
Assume that he observes 3 heads before the first tails.
What are the prior and posterior predictive probabilities of heads on the next flip? Here
prior predictive means prior to considering the data of the first four flips.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The prior predictive probability of heads is
𝑃 (fair)𝑃 (heads | fair) + 𝑃 (3/4 coin)𝑃 (heads | 3/4 coin) = 0.5 ⋅ 0.5 + 0.5 ⋅ 0.75 = 0.625
The posterior predictive probability of heads is
𝑃 (fair | data)𝑃 (heads | fair) + 𝑃 (3/4 coin | data)𝑃 (heads | 3/4 coin)
From part (a), we have the posterior odds the coin is fair are 16/27. This tells us the
posterior probabilities are
16                              27
𝑃 (fair | data) =      ,      𝑃 (unfair | data) =
43                              43
In this problem, the coin is unfair is the same as the coin has a 0.75 probability of heads.
16         27
So, the posterior predictive probability of heads is    ⋅ 0.5 +    ⋅ 0.75 ≈ 0.657
43         43
Method 2: We can also find the posterior probabilities needed to make the prediction
using a Bayesian update table.
Let 𝜃 be the probability of the selected coin landing on heads. We have two hypothese:
𝜃 = 1/2 and 𝜃 = 3/4
Hyp.      Prior     Likelihood     Bayes numer.    Posterior
𝜃 = 1/2     1/2     (1/2)3 (1/2)        1/25         16/43
𝜃 = 3/4     1/2     (3/4)3 (1/4)     3 /(2 ⋅ 44 )
3
27/43
Total       1            –            43/512          1
These are the same probabilities we got using odds. So, they will give the same posterior
prediction for heads on the next toss.
6   Bayesian Updating: continuous prior, discrete likelihood', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Peter and Jerry disagree over whether 18.05 students prefer Bayesian or
frequentist statistics. They decide to pick a random sample of 10 students from the class
and get Shelby to ask each student which they prefer. They agree to start with a prior
𝑓(𝜃) ∼ Beta(2, 2), where 𝜃 is the percent that prefer Bayesian.
Use R to compute 50% and 90% probability intervals for 𝜃. Center the intervals so that
the leftover probability in both tails is the same.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The 50% interval is
[qbeta(0.25,8,6),           qbeta(0.75,8,6)] = [0.48330,            0.66319]
The 90% interval is
[qbeta(0.05,8,6),            qbeta(0.95,8,6)] = [0.35480,            0.77604]', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Peter and Jerry disagree over whether 18.05 students prefer Bayesian or
frequentist statistics. They decide to pick a random sample of 10 students from the class
and get Shelby to ask each student which they prefer. They agree to start with a prior
𝑓(𝜃) ∼ Beta(2, 2), where 𝜃 is the percent that prefer Bayesian.
They decide to get another sample of 10 students and ask Neil to poll them. Write
down in detail the expression for the posterior predictive probability that the majority of the
second sample prefer Bayesian statistics. The result will be an integral with several terms.
Don’t bother computing the integral.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑥2 be the result of the second poll. We want 𝑝(𝑥2 > 5|𝑥1 ). We can compute
this using the law of total probability:
1
𝑝(𝑥2 > 5|𝑥1 ) = ∫ 𝑝(𝑥2 > 5|𝜃)𝑝(𝜃|𝑥1 ) 𝑑𝜃.
0
The two factors in the integral are:
10 6               10               10
𝑝(𝑥2 > 5|𝜃) = (     )𝜃 (1 − 𝜃)4 + ( )𝜃7 (1 − 𝜃)3 + ( )𝜃8 (1 − 𝜃)2
6                 7                8
10 9              10
+ ( )𝜃 (1 − 𝜃)1 + ( )𝜃10 (1 − 𝜃)0
9                10
13! 7
𝑝(𝜃|𝑥1 ) =      𝜃 (1 − 𝜃)5
7!5!
This can be computed exactly or numerically in R using the integrate() function. The
answer is 𝑃 (𝑥2 > 5 |𝑥1 = 6) = 0.5521.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose that you have a cable whose exact length is 𝜃. You have a ruler
with known error normally distributed with mean 0 and variance 10−4 . Using this ruler, you
measure your cable, and the resulting measurement 𝑥 is distributed as 𝑁 (𝜃, 10−4 ).
Suppose your prior on the length of the cable is 𝜃 ∼ 𝑁 (9, 1). If you then measure
𝑥 = 10, what is your posterior pdf for 𝜃?
2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have 𝜇prior = 9, 𝜎prior = 1 and 𝜎2 = 10−4 . The normal-normal updating
formulas are
1             𝑛                        𝑎𝜇prior + 𝑏𝑥̄       2         1
𝑎=    2
𝑏=      ,           𝜇post =                 ,    𝜎post =       .
𝜎prior          𝜎2                          𝑎+𝑏                       𝑎+𝑏
2
So we compute 𝑎 = 1/1, 𝑏 = 10000, 𝜎𝑝𝑜𝑠𝑡 = 1/(𝑎 + 𝑏) = 1/10001 ≈ 9.999 × 10−5 and
𝑎𝜇prior + 𝑏𝑥   100009
𝜇post =                =        ≈ 9.9999
𝑎+𝑏         10001
So we have posterior distribution 𝑓(𝜃|𝑥 = 10) ∼ 𝑁 (9.9999, 9.999 × 10−5 ).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Probability, MLE, goodness of fit
There was a multicenter test of the rate of success for a certain medical procedure. At each
of the 60 centers the researchers tested 12 subjects and reported the number of successes.
Assume that 𝜃 is the probability of success for one patient and let 𝑥 be the data from
one center. What is the probability mass function of 𝑥?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is a binomial distribution. Let 𝜃 be the Bernoulli probability of success in
one test.
12
𝑝(𝑥 = 𝑘) = ( )𝜃𝑘 (1 − 𝜃)12−𝑘 , for 𝑘 = 0, 1, … , 12.
𝑘', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Probability, MLE, goodness of fit
There was a multicenter test of the rate of success for a certain medical procedure. At each
of the 60 centers the researchers tested 12 subjects and reported the number of successes.
Compute 𝑥̄ the average number of successes over the 60 centers.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The sample mean is
∑(count × 𝑥)
𝑥̄ =
∑ counts
4 ⋅ 0 + 15 ⋅ 1 + 17 ⋅ 2 + 10 ⋅ 3 + 8 ⋅ 4 + 6 ⋅ 5
=
60
= 2.35', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Probability, MLE, goodness of fit
There was a multicenter test of the rate of success for a certain medical procedure. At each
of the 60 centers the researchers tested 12 subjects and reported the number of successes.
Do a 𝜒2 goodness of fit to test the assumption that the probability of success is the same
at each center. Find the 𝑝-value and use a significance level of 0.05.
In this test the number of degrees of freedom is the number of bins - 2.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : There were 60 trials in all. Our hypotheses are:
𝐻0 = the probability of success is the same at all centers. (This determines the probabilities
of the counts in each cell of our table.)
𝐻𝐴 = the probabilities for the cell counts can be anything as long as they sum to 1, i.e. 𝑥
follows an arbitrary multinomial distribution.
Using the the value for 𝜃 ̂ in part (d) we have the table below. Here are some details of the
computation
Since, in principle, 𝑥 can take any values between 0 and 12, the last cell in the counts is
really for 𝑥 ≥ 5. Thus, the probabilities for 𝑥 = 0, 1, 2, 3, 4 are computed using R by 𝑝(𝑥) =
dbinom(x, 12, 0.1958). The last probability for 𝑥 ≥ 5 is computed by sum(dbinom(5:12,
12, 0.1058)). (It could have been computed using pbinom.)
The expected counts are just the probabilities times the number of centers, 60. The com-
ponents of 𝑋 2 are computed using the formula 𝑋𝑖2 = (𝐸𝑖 − 𝑂𝑖 )2 /𝐸𝑖 .
𝑥           0        1        2        3        4      ≥5
prob      0.0731   0.2137   0.2863   0.2324   0.1273   0.0671
Observed       4       15       17       10        8        6
Expected     4.39     12.82    17.18    13.94    7.64     4.03
𝑋𝑖2      0.0344   0.3692   0.0018   1.1149   0.0170   0.9643
The 𝜒2 statistic is 𝑋 2 = ∑ 𝑋𝑖2 = 2.502. There are 6 cells, so 4 degrees of freedom. The
𝑝-value is
𝑝 = 1-pchisq(2.502, 4) = 0.644
With this 𝑝-value we do not reject 𝐻0 .
The reason the degrees of freedom is two less than the number of cells is that there are two
constraints on assigning cell counts assuming 𝐻𝐴 but consistent with the statistics used to
compute the expected counts. They are the total number of observations = 60, and the
grand mean 𝑥 = 2.35.
18.05 Introduction to Probability and Statistics
Spring 2022
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Concept questions
A researcher collected data that fit the criteria for a two-sided 𝑍-test. He set the
significance level at 0.05. He ran 80 trials and got a 𝑧-value of 1.7. This gave a 𝑝-value of
0.0892, so he could not reject the null hypothesis. Convinced that his alternative hypothesis
was correct he ran 80 more trials. The combined data from the 160 trials now had a 𝑧-value
of 2.1. He wrote a paper carefully describing his experiments and submitted it to the journal
in part (a).
Will the journal publish his results?      Yes              No', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : No. The actual experiment that was run would reject the null hypothesis if it were true,
more than 5% of the time.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Your friend grabs a die at random from a drawer containing two 4-sided dice, one 8-sided
die, and one 12-sided die. They roll the die once and report that the result is 5.
Make a discrete Bayes table showing the prior, likelihood, and posterior for the type of
die rolled given the data.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (We include the last column for part (d).)
hypoth. prior     likelihood          Bayes         posterior          likelihood
𝜃           𝑃 (𝑥1 = 5 | 𝜃)       numer.                          𝑃 (𝑥2 = 7 | 𝜃)
4-sided   1/2          0                 0              0                   0
3
8-sided   1/4         1/8              1/32             5                  1/8
2
12-sided 1/4         1/12              1/48             5                 1/12
1     1    5
𝑇 = 32 + 48 = 96
Note, the posterior probabilites have to have the same ratio as the Bayes numerators, i.e.
1   1        3 2
0∶    ∶    = 0 ∶ ∶ = 0 ∶ 3 ∶ 2.
32 48         5 5', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Your friend grabs a die at random from a drawer containing two 4-sided dice, one 8-sided
die, and one 12-sided die. They roll the die once and report that the result is 5.
What are your posterior odds that the die has 12 sides?
𝑃 (𝜃 = 12 | 𝑥1 = 5)   2/5', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Odds(𝜃 = 12 | 𝑥1 = 5) =                         =     = 2/3.
𝑃 (𝜃 ≠ 12 | 𝑥1 = 5)   3/5', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝐴 and 𝐵 be two events. Suppose that the probability that neither
event occurs is 3/8. What is the probability that at least one of the events occurs?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑃 ((𝐴 ∪ 𝐵)𝑐 ) = 3/8 ⇒ 𝑃 (𝐴 ∪ 𝐵) = 5/8 ..
0.4
𝐴              𝐵                                       𝐶                 𝐷
0.3       0.2   0.1
Figure for part (a).                                      Figure for part (b).
𝑐', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
An urn contains 3 orange balls and 2 blue balls. A ball is drawn. If the ball
is orange, it is kept out of the urn and a second ball is drawn from the urn. If the ball is
blue, then it is put back in the urn and an orange ball is added to the urn. Then a second
ball is drawn from the urn.
What is the probability that both balls drawn are orange?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑃 (𝑂1 ∩ 𝑂2 ) =    ⋅ =    = 0.3 .
5 4  20
4 2
𝑃 (𝑂2 |𝐵1 )𝑃 (𝐵1 )         ⋅        8/30    8', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
You roll a fair six sided die repeatedly until the sum of all numbers rolled
is greater than 6. Let 𝑋 be the number of times you roll the die. Let 𝐹 be the cumulative
distribution function for 𝑋. Compute 𝐹 (1), 𝐹 (2), and 𝐹 (7).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐹 (1): Since you never get more than 6 on one roll we have 𝐹 (1) = 0 .
𝐹 (2) = 𝑃 (𝑋 = 1) + 𝑃 (𝑋 = 2):
𝑃 (𝑋 = 1) = 0
21   7
𝑃 (𝑋 = 2) = 𝑃 (total on 2 dice = 7,8,9,10,11,12) =                =    .
36   12
𝐹 (7): The smallest total on 7 rolls is 7, so 𝐹 (7) = 1 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose 𝑋 is a random variable with cdf
⎧0                  for 𝑥 < 0
{
{
𝐹 (𝑥) = 𝑥(2 − 𝑥)           for 0 ≤ 𝑥 ≤ 1
⎨
{
{
⎩1                  for 𝑥 > 1
Find 𝑃 (𝑋 < 0.4).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑃 (𝑋 ≤ 0.4) = 𝐹 (0.4) = 0.4(2 − 0.4) = 0.4(1.6) = 0.64 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Defaulting on a loan means failing to pay it back on time. The default rate
among MIT students on their student loans is 1%. As a project you develop a test to predict
which students will default. Your test is good but not perfect. It gives 4% false positives,
i.e. prediciting a student will default who in fact will not. If has a 0% false negative rate,
i.e. prediciting a student won’t default who in fact will.
Solution: Suppose a random student tests positive. What is the probability that he
will truly default.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We organize the problem in a tree. Here:
𝐷+ = default, 𝐷− = no default
𝑇 + = test is positive, 𝑇 − = test is negative
0.01                 0.99
−
1   𝐷+     0                  0.04 𝐷     0.96
𝑇+                      𝑇−    𝑇+                     𝑇−
𝑃 (𝑇 + |𝐷+ )𝑃 (𝐷+ )         0.01            0.01      1
𝑃 (𝐷+ |𝑇 + ) =                       =                    =        =      ≈ 0.2 .
𝑃 (𝑇 + )        0.01 + 0.99 ⋅ 0.04   0.0496   4.96
𝑃 (𝐷+ |𝑇 + )     1/4.96      1', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Data was taken on height and weight from the entire population of 700
mountain gorillas living in the Democratic Republic of Congo:
ht\\wt    light   average       heavy
short     170       70           30
tall      85      190          155
Let 𝑋 encode the weight, taking the values of a randomly chosen gorilla: 0, 1, 2 for light,
average, and heavy respectively.
Likewise, let 𝑌 encode the height, taking values 0 and 1 for short and tall respectively.
Determine the joint pmf of 𝑋 and 𝑌 and the marginal pmf’s of 𝑋 and of 𝑌 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Probability table:
𝑋
𝑌\\               0            1         2           marginal for 𝑌
0            170/700      70/700    30/700           270/700
1            85/700      190/700   155/700           430/700
marginal for 𝑋     255/700     260/700   185/700               1', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Data was taken on height and weight from the entire population of 700
mountain gorillas living in the Democratic Republic of Congo:
ht\\wt    light   average       heavy
short     170       70           30
tall      85      190          155
Let 𝑋 encode the weight, taking the values of a randomly chosen gorilla: 0, 1, 2 for light,
average, and heavy respectively.
Likewise, let 𝑌 encode the height, taking values 0 and 1 for short and tall respectively.
Find the covariance of 𝑋 and 𝑌 .
For this part, you need a numerical (no variables) expression, but you can leave it uneval-
uated.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 260       185   630    9
𝐸[𝑋] =     +2⋅       =     =
700       700   700   10
430    43
𝐸[𝑌 ] =      =
700    70
190       155   500   5
𝐸[𝑋𝑌 ] =      +2⋅       =     =
700       700   700   7
5   9 43   113
Cov(𝑋, 𝑌 ) − 𝐸[𝑋𝑌 ] − 𝐸[𝑋]𝐸[𝑌 ] = −    ⋅   =
7 10 70    700
Cov(𝑋, 𝑌 )', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
A political poll is taken to determine the fraction 𝑝 of the population that
would support a referendum requiring all citizens to be fluent in the language of probability
and statistics.
Assume 𝑝 = 0.5. Use the central limit theorem to estimate the probability that in a poll
of 25 people, at least 14 people support the referendum.
Your answer to this problem should be a decimal.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑋 ∼ binomial(25, 0.5) = the number supporting the referendum. We know
that
1    25             5
𝐸[𝑋] = 12.5,     Var(𝑋) = 25 ⋅ = ,         𝜎𝑋 = .
4     4             2
𝑋 − 12.5
Standardizing and using the CLT we have 𝑍 =            ≈ N(0, 1) Therefore,
5/2
𝑋 − 12.5   14 − 12.5
𝑃 (𝑋 ≥ 14) = 𝑃 (            ≥           ) ≈ 𝑃 (𝑍 ≥ 0.6) = Φ(−0.6) = 0.2743 ,
5/2         5/2
where the last probability was looked up in the 𝑍-table.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose a researcher collects 𝑥1 , … , 𝑥𝑛 i.i.d. measurements of the back-
ground radiation in Boston. Suppose also that these observations follow a Rayleigh distri-
bution with parameter 𝜏 , with pdf given by
                                                  1   2
                                     𝑓(𝑥) = 𝑥𝜏 e− 2 𝜏𝑥 .

Find the maximum likelihood estimate for 𝜏 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : For a fixed 𝜏 the pdf for 𝑥𝑖 is 𝑓(𝑥𝑖 | 𝜏 ) = 𝑥𝜏 e− 2 𝜏𝑥 . Therefore the likelihood
function of the data is
1      2
𝑓(data | 𝜏 ) = 𝑥1 𝑥2 ⋯ 𝑥𝑛 𝜏 𝑛 e− 2 𝜏 ∑ 𝑥𝑖 .
The log likelihood is
1
ln(𝑓(data | 𝜏 )) = ln(𝑥1 𝑥2 ⋯ 𝑥𝑛 ) + 𝑛 ln(𝜏 ) − 𝜏 ∑ 𝑥2𝑖 .
2
We find the MLE for 𝜏 by taking a derivative of the log likelihood with respect to 𝜏 and
setting equal to 0.
𝑑 ln(𝑓(data | 𝜏 ))  𝑛 1            𝑛  1             2𝑛
= − ∑ 𝑥2𝑖 = 0 ⇒   = ∑ 𝑥2𝑖 ⇒ 𝜏 =       .
𝑑𝜏           𝜏 2            𝜏  2            ∑ 𝑥2𝑖', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Bivariate data (4, 10), (−1, 3), (0, 2) is assumed to arise from the model
𝑦𝑖 = 𝑏|𝑥𝑖 − 3| + 𝑒𝑖 , where 𝑏 is a constant and 𝑒𝑖 are independent random variables.
Given the above data, determine the least squares estimate for 𝑏.
For this problem we want you to calculate all the way to a fraction 𝑏 = 𝑟𝑠 , where 𝑟 and 𝑠
are integers.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐸[𝑏] = sum of the squared errors
= ∑(𝑦𝑖 − 𝑏|𝑥𝑖 − 3|)2
= (10 − 𝑏)2 + (3 − 4𝑏)2 + (2 − 3𝑏)2
The least squares fit is found by setting the derivative (with respect to 𝑏) to 0,
𝑑 𝐸[𝑏]
= −2(10 − 𝑏) − 8(3 − 4𝑏) − 6(2 − 3𝑏) = 52𝑏 − 56 = 0.
𝑑𝑏
56   14
Therefore the least squares estimate of 𝑏 is 𝑏̂ =    =    .
52   13', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Taxi problem Data is collected on the time between arrivals of consecutive
taxis at a downtown hotel. We collect a data set of size 45 with sample mean 𝑥 = 5.0 and
sample standard deviation 𝑠 = 4.0.
Now make no assumptions about the distribution of of the data. By bootstrapping, we
generate 500 values for the average inter-arrival time 𝑥∗ . The smallest and largest 150 are
written in non-decreasing order on the next page.
Use this data to find an 80% percentile bootstrap confidence interval for 𝜇.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The 80% percentile bootstrap CI is [𝑐0.1 , 𝑐0.9 ], where 𝑐0.1 and 𝑐0.9 are em-
∗
pirical quantiles for 𝑥
∗
𝑐0.1 is the 50th element = 4.800. (Really it is interporlated between the 49th and 50th
element, fortunately both are 4.800)
∗
𝑐0.9 is the 450th element = 5.169. (Really it is interporlated between the 449th and 450th
element, fortunately both are 5.169)
So the 80% CI = [4.800, 5.169].', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Note. In this problem the geometric(𝑝) distribution is defined as the total
number of trials to the first failure (the value includes the failure), where 𝑝 is the probabilitiy
of success.
What sample statistic would you use to estimate 𝑝?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Since 𝜇 = 1/(1 − 𝑝), so 𝑝 = 1 − 1/𝜇, we should use the approximation
𝑝̂ = 1 − 1/𝑥 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
You independently draw 100 data points from a normal distribution.
Suppose you know the distribution is N(𝜇, 4) (4 = 𝜎2 ) and you want to test the null
hypothesis 𝐻0 ∶ 𝜇 = 3 against the alternative hypothesis 𝐻𝐴 ∶ 𝜇 ≠ 3.
If you want a significance level of 𝛼 = 0.05. What is your rejection region?
You must clearly state what test statistic you are using.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We will use the standardized mean based on 𝐻0 as a test statistic:
𝑥 − 𝜇0 𝑥−3
𝑧=      √ =      = 5(𝑥 − 3).
𝜎/ 𝑛   2/10
At 𝛼 = 0.05 we reject 𝐻0 if
𝑧 < 𝑧0.975 = −1.96     or   𝑧 > 𝑧0.025 = 1.96.
(Or we could have used 𝑥 as a test statistic and got the corresponding rejection region.)
5−3', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
You independently draw 100 data points from a normal distribution.
Determine the power of the test using the alternative 𝐻𝐴 ∶ 𝜇 = 4.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Power = 𝑃 (reject | 𝜇 = 4)
𝑥−3
Our 𝑧-statistic is 𝑧 =        and we don’t reject if
2/10
𝑥−3
−1.96 ≤ 𝑧 ≤ 1.96      ⇔       −1.96 ≤        ≤ 1.96       ⇔    2.61 ≤ 𝑥 ≤ 3.39
2/10
So,
Power = 𝑃 (reject | 𝜇 = 4)
= 1 − 𝑃 (don’t reject | 𝜇 = 4)
= 1 − 𝑃 (2.61 < 𝑥 < 3.39 | 𝜇 = 4)
We standardize using the given mean 𝜇 = 4
2.61 − 4      −0.61
=1−𝑃 (             <𝑍<        )
2/10         2/10
= 1 − 𝑃 (−6.9 < 𝑍 < −3.05)
= 1 − Φ(−3.05) + Φ(−6.9)
= 1 − 0.0011 + 0 = 0.9989 .
The probabilities were looked up in the 𝑧-table. We used Φ(−6.9) ≈ 0.
(We could have used much less calculation to find that the non-rejection range is 𝑥 between
−7𝜎𝑥 and −3𝜎𝑥 from the mean 𝜇 = 4.)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose that you have molecular type with unknown atomic mass 𝜃. You
have an atomic scale with normally-distributed error of mean 0 and variance 0.5.
With the same prior as in part (a), compute the smallest number of measurements
needed so that the posterior variance is less than 0.01.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : In this case 𝑎 = 1/4, 𝑏 = 𝑛/0.5 = 2𝑛. We know
2          1        1        4
𝜎post =        =          =
𝑎+𝑏   1/4 + 2𝑛   8𝑛 + 1
2
Now 𝜎post ≤ 0.01 gives us
4                                                   399
≤ 0.01        ⇒      400 ≤ 8𝑛 + 1       ⇒          ≤𝑛     Solution: 𝑛 = 50 .
8𝑛 + 1                                                 8', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Your friend grabs a die at random from a drawer containing two 6-sided
dice, one 8-sided die, and one 12-sided die. She rolls the die once and reports that the result
is 7.
What are your posterior odds that the die has 12 sides?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Odds =                           =     =   .
𝑝(𝜃 ≠ 12 | 𝑥1 = 7)   3/5   3', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Consider the nucleotides 𝐴, 𝐺, 𝐶, 𝑇 .
How many ways are there to make a sequence of 5 nucleotides.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Four ways to fill each slot: 45 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Consider the nucleotides 𝐴, 𝐺, 𝐶, 𝑇 .
How many sequences of length 5 have exactly one 𝐴?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Build the sequences as follows:
Step 1: Choose which of the 5 slots gets the 𝐴: 5 ways to place the one 𝐴.
Step 2: 34 ways to fill the remain 4 slots.
By the rule of product there are 5 ⋅ 34 such sequences.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(Counting)
How many arrangements of the letters in the word probability are there?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : There are several ways to think about this. Here is one.
The 11 letters are p, r, o, b,b, a, i,i, l, t, y. We use the following steps to create a sequence
of these letters.
Step 1: Choose a position for the letter p: 11 ways to do this.
Step 2: Choose a position for the letter r: 10 ways to do this.
Step 3: Choose a position for the letter o: 9 ways to do this.
Step 4: Choose two positions for the two b’s: 8 choose 2 ways to do this.
Step 5: Choose a position for the letter a: 6 ways to do this.
Step 6: Choose two positions for the two i’s: 5 choose 2 ways to do this.
Step 7: Choose a position for the letter l: 3 ways to do this.
1
Step 8: Choose a position for the letter t: 2 ways to do this.
Step 9: Choose a position for the letter y: 1 ways to do this.
Multiply these all together we get:
8         5                 11!
11 ⋅ 10 ⋅ 9 ⋅ ( ) ⋅ 6 ⋅ ( ) ⋅ 3 ⋅ 2 ⋅ 1 =
2         2                2! ⋅ 2!', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝐸 and 𝐹 be two events. Suppose the probability that at least one of
them occurs is 2/3. What is the probability that neither 𝐸 nor 𝐹 occurs?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We are given 𝑃 (𝐸 ∪ 𝐹 ) = 2/3 and asked to find 𝑃 ((𝐸 ∪ 𝐹 )𝑐 ).
𝑃 ((𝐸 ∪ 𝐹 )𝑐 ) = 1 − 𝑃 (𝐸 ∪ 𝐹 ) = 1/3.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
More cards! Suppose you want to divide a 52 card deck into four hands with
13 cards each. What is the probability that each hand has a king?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝐻𝑖 be the event that the 𝑖𝑡ℎ hand has one king. We have the conditional
probabilities
4 48                            3 36                                  2 24
( )( )                          ( )( )                                ( )( )
1 12                            1 12                                  1 12
𝑃 (𝐻1 ) =        ;          𝑃 (𝐻2 |𝐻1 ) =        ;           𝑃 (𝐻3 |𝐻1 ∩ 𝐻2 ) =
52                              39                                    26
( )                             ( )                                   ( )
13                              13                                    13
𝑃 (𝐻4 |𝐻1 ∩ 𝐻2 ∩ 𝐻3 ) = 1
𝑃 (𝐻1 ∩ 𝐻2 ∩ 𝐻3 ∩ 𝐻4 ) = 𝑃 (𝐻4 |𝐻1 ∩ 𝐻2 ∩ 𝐻3 ) 𝑃 (𝐻3 |𝐻1 ∩ 𝐻2 ) 𝑃 (𝐻2 |𝐻1 ) 𝑃 (𝐻1 )
2 24 3 36 4 48
( )( )( )( )( )( )
1 12 1 12 1 12
=                    .
26 39 52
( )( )( )
13 13 13', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose we roll a fair die twice. Let 𝐴 be the event ‘the sum of the rolls is 5’
and let 𝐵 be the event ‘at least one of the rolls is 4.’
Are 𝐴 and 𝐵 independent?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑃 (𝐴) = 4/36 ≠ 𝑃 (𝐴|𝐵), so they are not independent.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose 𝐴 and 𝐵 are events with 0 < 𝑃 (𝐴) < 1 and 0 < 𝑃 (𝐵) < 1.
No, they cannot be independent: 𝐴 ⊂ 𝐵 ⇒ 𝐴 ∩ 𝐵 = 𝐴
⇒ 𝑃 (𝐴 ∩ 𝐵) = 𝑃 (𝐴) > 𝑃 (𝐴) ⋅ 𝑃 (𝐵). The last inequality follows because 𝑃 (𝐵) < 1.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The answer to all three parts is ‘No’. Each of these answers relies on the fact
that the probabilities of 𝐴 and 𝐵 are strictly between 0 and 1.
To show 𝐴 and 𝐵 are not independent we need to show either 𝑃 (𝐴 ∩ 𝐵) ≠ 𝑃 (𝐴) ⋅ 𝑃 (𝐵)
or 𝑃 (𝐴|𝐵) ≠ 𝑃 (𝐴).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose that 𝑋 ∼ Bin(𝑛, 0.5). Find the probability mass function of
𝑌 = 2𝑋.


                                             3', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : For 𝑦 = 0, 2, 4, … , 2𝑛,
𝑦     𝑛    1 𝑛
𝑃 (𝑌 = 𝑦) = 𝑃 (𝑋 =             )=(    )( ) .
2    𝑦/2   2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose that 𝑋 is a random variable that takes on values 0, 2 and 3 with
probabilities 0.3, 0.1, 0.6 respectively. Let 𝑌 = 3(𝑋 − 1)2 .
Let 𝐹𝑌 (𝑡) be the cumulative density function of 𝑌 . What is 𝐹𝑌 (7)?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : From the table we see that 𝐹𝑌 (7) = 𝑃 (𝑌 ≤ 7) = 0.4.
8', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose you roll a fair 6-sided die 25 times (independently), and you get $3
every time you roll a 6. Let 𝑋 be the total number of dollars you win.
Find 𝐸[𝑋] and Var(𝑋).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑋 ∼ 3 binomial(25, 1/6).
Recall that the mean and variance of binomial(𝑛, 𝑝) are 𝑛𝑝 and 𝑛𝑝(1 − 𝑝). So,
1
𝐸[𝑋] = 3𝑛𝑝 = 3 ⋅ 25 ⋅       = 75/6, and Var(𝑋) = 9𝑛𝑝(1 − 𝑝) = 9 ⋅ 25(1/6)(5/6) = 125/4.
6', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
A continuous random variable 𝑋 has PDF 𝑓(𝑥) = 𝑥 + 𝑎𝑥2 on [0,1]
Find 𝑎, the CDF and 𝑃 (0.5 < 𝑋 < 1).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : First we find the value of 𝑎:
1                   1
1 𝑎
∫ 𝑓(𝑥) 𝑑𝑥 = 1 = ∫ 𝑥 + 𝑎𝑥2 𝑑𝑥 =          +  ⇒ 𝑎 = 3/2.
0                   0                 2 3
The CDF is 𝐹𝑋 (𝑥) = 𝑃 (𝑋 ≤ 𝑥). We break this into cases:
(i) 𝑏 < 0, so 𝐹𝑋 (𝑏) = 0.
𝑏                2    3
(ii) 0 ≤ 𝑏 ≤ 1, so 𝐹𝑋 (𝑏) = ∫0 𝑥 + 32 𝑥2 𝑑𝑥 = 𝑏2 + 𝑏2 .
(iii) 1 < 𝑥, so 𝐹𝑋 (𝑏) = 1.
Using 𝐹𝑋 we get
0.52 + 0.53   13
𝑃 (0.5 < 𝑋 < 1) = 𝐹𝑋 (1) − 𝐹𝑋 (0.5) = 1 − (                 )= .
2        16', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(Random variables derived from normal random variables)
Let 𝑋1 , 𝑋2 , …𝑋𝑛 be i.i.d. N(0, 1) random variables.
Let 𝑌𝑛 = 𝑋12 + … + 𝑋𝑛2 .
Use the Central Limit Theorem to approximate 𝑃 (𝑌100 > 110).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐸[𝑌100 ] = 𝐸[100𝑋𝑗2 ] = 100.             Var(𝑌100 ) = 100Var(𝑋𝑗 ) = 200.
The CLT says 𝑌100 is approximately normal. Standardizing gives
𝑌 − 100       10               √
𝑃 (𝑌100 > 110) = 𝑃 ( 100
√       >√      ) ≈ 𝑃 (𝑍 > 1/ 2) = 0.24 .
200       200
This last value was computed using R: 1 - pnorm(1/sqrt(2),0,1).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝑋 ∼ U(𝑎, 𝑏). Compute 𝐸[𝑋] and Var(𝑋).




                                               6




18.05 Introduction to Probability and Statistics
Spring 2022


For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Method 1
1
𝑈 (𝑎, 𝑏) has density 𝑓(𝑥) =       on [𝑎, 𝑏]. So,
𝑏−𝑎
𝑏                   𝑏                𝑏
1             𝑥2       𝑏 2 − 𝑎2   𝑎+𝑏
𝐸[𝑋] = ∫ 𝑥𝑓(𝑥) 𝑑𝑥 =          ∫ 𝑥 𝑑𝑥 =         ∣ =          =     .
𝑎               𝑏−𝑎 𝑎       2(𝑏 − 𝑎) 𝑎 2(𝑏 − 𝑎)     2
𝑏                       𝑏                𝑏
1              𝑥3       𝑏 3 − 𝑎3
𝐸[𝑋 2 ] = ∫ 𝑥2 𝑓(𝑥) 𝑑𝑥 =       ∫ 𝑥2 𝑑𝑥 =         ∣ =          .
𝑎                𝑏−𝑎 𝑎        3(𝑏 − 𝑎) 𝑎 3(𝑏 − 𝑎)
Finding Var(𝑋) now requires a little algebra,
𝑏 3 − 𝑎3   (𝑏 + 𝑎)2
Var(𝑋) = 𝐸[𝑋 2 ] − 𝐸[𝑋]2 =              −
3(𝑏 − 𝑎)       4
4(𝑏3 − 𝑎3 ) − 3(𝑏 − 𝑎)(𝑏 + 𝑎)2   𝑏3 − 3𝑎𝑏2 + 3𝑎2 𝑏 − 𝑎3    (𝑏 − 𝑎)3   (𝑏 − 𝑎)2
=                                  =                        =           =          .
12(𝑏 − 𝑎)                   12(𝑏 − 𝑎)          12(𝑏 − 𝑎)      12
Method 2
There is an easier way to find 𝐸[𝑋] and Var(𝑋).
Let 𝑈 ∼ U(𝑎, 𝑏). Then the calculations above show 𝐸[𝑈 ] = 1/2 and (𝐸[𝑈 2 ] = 1/3 ⇒
Var(𝑈 ) = 1/3 − 1/4 = 1/12.
Now, we know 𝑋 = (𝑏 − 𝑎)𝑈 + 𝑎, so 𝐸[𝑋] = (𝑏 − 𝑎)𝐸[𝑈 ] + 𝑎 = (𝑏 − 𝑎)/2 + 𝑎 = (𝑏 + 𝑎)/2
and Var(𝑋) = (𝑏 − 𝑎)2 Var(𝑈 ) = (𝑏 − 𝑎)2 /12.
14
18.05 Introduction to Probability and Statistics
Spring 2022
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(55: 5,5,10,5,10,10,10 pts.) (Birthdays: counting and simulation)
Ignoring leap days, the days of the year can be numbered 1 to 365. Assume that birthdays
are equally likely to fall on any day of the year. Consider a group of 𝑛 people, of which you
are not a member. An element of the sample space 𝑆 will be a sequence of 𝑛 birthdays (one
for each person).
Define the probability function 𝑃 for 𝑆. (This will depend on 𝑛.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The sample space 𝑆 is the set of all sequences of 𝑛 birthdays. That is, all
sequences
𝜔 = (𝑏1 , 𝑏2 , 𝑏3 , … , 𝑏𝑛 ),
where each entry is a number between 1 and 365.
1
There are 365𝑛 sequences of 𝑛 birthdays. Since they are all equally likely, 𝑃 (𝜔) = 365 𝑛 for
every sequence 𝜔.
18.05 Problem Set 1, Spring 2022 Solutions                                                    4', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(55: 5,5,10,5,10,10,10 pts.) (Birthdays: counting and simulation)
Ignoring leap days, the days of the year can be numbered 1 to 365. Assume that birthdays
are equally likely to fall on any day of the year. Consider a group of 𝑛 people, of which you
are not a member. An element of the sample space 𝑆 will be a sequence of 𝑛 birthdays (one
for each person).
Justify why 𝑛 in part (c) is greater than 365
2 without doing any computation. (We are
looking for a short answer giving a heuristic sense of why this is so.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Ignoring the fractions, 365/2 different birthdays would have a 50 percent chance
of matching your birthday. But, 365/2 people probably don’t all have different birthdays,
so they have a less than 50 percent chance of matching.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(55: 5,5,10,5,10,10,10 pts.) (Birthdays: counting and simulation)
Ignoring leap days, the days of the year can be numbered 1 to 365. Assume that birthdays
are equally likely to fall on any day of the year. Consider a group of 𝑛 people, of which you
are not a member. An element of the sample space 𝑆 will be a sequence of 𝑛 birthdays (one
for each person).
Find an exact formula for 𝑃 (𝐵).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : It’s easier to calculate 𝑃 (𝐵𝑐 ), the probability that all 𝑛 birthdays are distinct.
To choose 𝑛 different birthdays: there are 365 choices for the first birthday, 364 for the
second birthday, etc. So
365 ⋅ 364 ⋯ (365 − 𝑛 + 1)           365!
𝑃 (𝐵) = 1 − 𝑃 (𝐵𝑐 ) = 1 −                             =1−                   .
365𝑛               (365 − 𝑛)! ⋅ 365𝑛', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 10,10 pts.) (‘Binary’ paradox)
For this problem assume that puppies are equally probable to be male or female. Likewise
for kittens.
Be sure to carefully justify your answers.
Our dog Layla had two puppies. The older puppy is female. What is the probability that
both puppies are female?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Listing the sex of older puppy first, our sample space is {𝑀 𝑀 , 𝑀 𝐹 , 𝐹 𝑀 , 𝐹 𝐹 } .
The event “the older puppy is female” is {𝐹 𝑀 , 𝐹 𝐹 } and the event “both puppies are female”
is {𝐹 𝐹 } . Thus the probability that both puppies are females given the older is female is
𝑃 (𝐹 𝐹 )       1/4  1
𝑃 (𝐹 𝐹 |{𝐹 𝑀 , 𝐹 𝐹 }) =                    =     = .
𝑃 ({𝐹 𝑀 , 𝐹 𝐹 })   1/2  2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(15 pts.) (The blue taxi)
In a city with one hundred taxis, 1 is blue and 99 are green. A witness observes a hit-and-
run by a taxi at night and recalls that the taxi was blue, so the police arrest the blue taxi
driver who was on duty that night. The driver proclaims their innocence and hires you to
defend them in court. You hire a scientist to test the witness’ ability to distinguish blue
and green taxis under conditions similar to the night of accident. The data suggests that
the witness sees blue cars as blue 99% of the time and green cars as blue 2% of the time.
Write a speech for the jury to give them reasonable doubt about your client’s guilt. Your
speech need not be longer than the statement of this question. Keep in mind that most jurors
have not taken this course, so an illustrative table may be easier for them to understand
than fancy formulas.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The defense will try to make the case that this is likely to be a case of random
mis-identification. So we look for the probability a random taxi the witness sees as blue is
actually blue.
This is a question of ‘inverting’ conditional probability. We know
𝑃 (the witness sees blue|the car is blue)
but we’d like to know
𝑃 (the car is blue|the witness sees blue).
Our first job is to translate this to symbols.
1
18.05 Problem Set 2, Spring 2022 Solutions                                                       2
Let 𝑊𝑏 = ‘witness sees a blue taxi’ and let 𝑊𝑔 = ‘witness sees a green car’. Further, let 𝑇𝑏
= ‘taxi is blue’ and let 𝑇𝑔 = ‘taxi is green’. With this notation we want to find 𝑃 (𝑇𝑏 |𝑊𝑏 ).
We will compute this using Bayes’ formula
𝑃 (𝑊𝑏 |𝑇𝑏 ) ⋅ 𝑃 (𝑇𝑏 )
𝑃 (𝑇𝑏 |𝑊𝑏 ) =                         .
𝑃 (𝑊𝑏 )
All the pieces are represented in the following diagram.
0.01               0.99
Random taxi               𝑇𝐵                                𝑇𝐺
0.99         0.01             0.02      0.98
Witness sees
𝑊𝐵             𝑊𝐺             𝑊𝐵          𝑊𝐺
We can determine each factor in the right side of Bayes’ formula:
We are given 𝑃 (𝑇𝑏 ) = 0.01 (so 𝑃 (𝑇𝑔 ) = 0.99).
We are given, 𝑃 (𝑊𝑏 |𝑇𝑏 ) = 0.99 and 𝑃 (𝑊𝑏 |𝑇𝑔 ) = 0.02.
We compute 𝑃 (𝑊𝑏 ) using the law of total probability:
𝑃 (𝑊𝑏 ) = 𝑃 (𝑊𝑏 |𝑇𝑏 )𝑃 (𝑇𝑏 ) + 𝑃 (𝑊𝑏 |𝑇𝑔 )𝑃 (𝑇𝑔 ) = 0.99 × 0.01 + 0.02 × 0.99 = 0.99 × 0.03.
Putting all this in Bayes’ formula we get
0.99 × 0.01   1
𝑃 (𝑇𝑏 |𝑊𝑏 ) =               =
0.99 × 0.03   3
Our speech:
Ladies and gentlemen of the jury. The prosecutor tells you that the witness is nearly flawless
in their ability to distinguish whether a taxi is green or blue. They claims that this implies
that beyond a reasonable doubt the taxi involved in the hit and run was blue. However
probability theory shows without any doubt that a random taxi which the witness sees as
blue is actually blue only 1/3 of the time. This is considerably more than a reasonable
doubt. In fact it is more probable than not that the taxi involved in the accident was green.
If the probability doesn’t fit you must acquit!
Note: Confusing of 𝑃 (testimony|guilty) for 𝑃 (guilty|testimony) is known as the prosecutor’s
fallacy', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 5,10,5,5 pts.) (Dice) There are four dice in a drawer: one D4 (4 sides),
one D6 (6-sides), and two D8 (8 sides). As usual, the sides of a die are numbered 1 to 𝑛,
where 𝑛 is the number of sides.
Your friend secretly grabs one of the four dice at random. Let 𝑆 be the number of sides on
the chosen die.
What is the pmf of S?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Here is the pmf:
value 𝑠      4       6       8
pmf 𝑝(𝑠)    1/4     1/4     1/2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 5,10,5,5 pts.) (Dice) There are four dice in a drawer: one D4 (4 sides),
one D6 (6-sides), and two D8 (8 sides). As usual, the sides of a die are numbered 1 to 𝑛,
where 𝑛 is the number of sides.
Your friend secretly grabs one of the four dice at random. Let 𝑆 be the number of sides on
the chosen die.
Which die is most likely if 𝑅 = 6? Hint: You can either repeat the computation in (b),
or you can reason based on your result in (b).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : In a similar vein, we have
𝑃 (𝑅 = 6|𝑆 = 4) = 0,     𝑃 (𝑅 = 6|𝑆 = 6) = 1/6,      𝑃 (𝑅 = 6|𝑆 = 8) = 1/8.
and
1 1 1 1 1 5
𝑃 (𝑅 = 6) = 0 ⋅    + ⋅ + ⋅ = .
4 6 4 8 2 48
So,
1/24  2                            1/16  3
𝑃 (𝑆 = 4|𝑅 = 6) = 0,      𝑃 (𝑆 = 6|𝑅 = 6) =         = ,       𝑃 (𝑆 = 8|𝑅 = 6) =        = .
5/48  5                            5/48  5
The eight-sided die is more likely. Note, the denominator is the same in each probability,
i.e. the total probability 𝑃 (𝑅 = 6), so all we really had to check was the numerator.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(10 pts.) (Seating arrangement and relative height) A total of 𝑛 people
randomly take their seats around a circular table with 𝑛 chairs. No two people have the
same height. What is the expected number of people who are shorter than both of their
immediate neighbors?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Label the seats 1 to 𝑛 going clockwise around the table. Let 𝑋𝑖 be the Bernoulli
random variable with value 1 if the person in seat 𝑖 is shorter than their neighbors. Then
18.05 Problem Set 2, Spring 2022 Solutions                                                5
𝑛
𝑋 = ∑𝑖=1 𝑋𝑖 represents the total number of people who are shorter than both of their
neighbors, and, by linearity of expected value,
𝑛          𝑛
𝐸[𝑋] = 𝐸 [∑ 𝑋𝑖 ] = ∑ 𝐸[𝑋𝑖 ]
𝑖=1         𝑖=1
Recall that this property of expected values holds even when the 𝑋𝑖 are dependent, as is
the case here!
Among 3 random people the probability that the middle one is the shortest is 1/3. Therefore
𝑋𝑖 ∼ Bernoulli(1/3), which implies 𝐸[𝑋𝑖 ] = 1/3. Therefore the expected number of people
shorter than both their neighbors is
𝑛
𝑛
𝐸[𝑋] = ∑ 𝐸[𝑋𝑖 ] =        .
𝑖=1
3', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 3,2,10,5 pts.)
In this problem we will use R to simulate flipping a fair coin 50 times. We’ll use the
simulation to explore ‘runs’. That is, sequences of all 1’s or 0’s.
A run is a sequence of all 1s or all 0s. How long is the longest run in your answer to
part (a)?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Answers will vary because we can’t know the sequence you chose. However,
most people, when trying to be random, do not put in any long runs. Parts (c) and (d)
show these actually happen frequently.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 10,5,10 pts.) Independence
Three events 𝐴, 𝐵, and 𝐶 are pairwise independent if each pair is independent. They are
mutually independent if they are pairwise independent and if, in addition,
𝑃 (𝐴 ∩ 𝐵 ∩ 𝐶) = 𝑃 (𝐴)𝑃 (𝐵)𝑃 (𝐶).                                (1)
Suppose we roll two 6-sided die. Consider the events:
𝐴 = ‘odd on die 1’           𝐵 = ‘odd on die 2’            𝐶 = ‘odd sum’
Are 𝐴, 𝐵, and 𝐶 pairwise independent? Are they mutually independent?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have 𝑃 (𝐴) = 𝑃 (𝐵) = 𝑃 (𝐶) = 1/2. Writing the outcome of die 1 first, we
can easily list all outcomes in the following intersections.
𝐴 ∩ 𝐵 = {(1, 1), (1, 3), (1, 5), (3, 1), (3, 3), (3, 5), (5, 1), (5, 3), (5, 5)}
𝐴 ∩ 𝐶 = {(1, 2), (1, 4), (1, 6), (3, 2), (3, 4), (3, 6), (5, 2), (5, 4), (5, 6)}
𝐵 ∩ 𝐶 = {(2, 1), (4, 1), (6, 1), (2, 3), (4, 3), (6, 3), (2, 5), (4, 5), (6, 5)}
By counting we see
1
𝑃 (𝐴 ∩ 𝐵) =       = 𝑃 (𝐴)𝑃 (𝐵).
4
Likewise,
1                             1
𝑃 (𝐴 ∩ 𝐶) =   = 𝑃 (𝐴)𝑃 (𝐶) and 𝑃 (𝐵 ∩ 𝐶) = = 𝑃 (𝐵)𝑃 (𝐶).
4                             4
So, we see that 𝐴, 𝐵, and 𝐶 are pairwise independent.
However, 𝐴 ∩ 𝐵 ∩ 𝐶 = ∅, since if we roll an odd on die 1 and an odd on die 2, then the sum
of the two will be even. So, in this case,
𝑃 (𝐴 ∩ 𝐵 ∩ 𝐶) = 0 ≠ 𝑃 (𝐴)𝑃 (𝐵)𝑃 (𝐶),
and we conclude that 𝐴, 𝐵 and 𝐶 are not mutually independent.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 10,5,10 pts.) Independence
Three events 𝐴, 𝐵, and 𝐶 are pairwise independent if each pair is independent. They are
mutually independent if they are pairwise independent and if, in addition,
𝑃 (𝐴 ∩ 𝐵 ∩ 𝐶) = 𝑃 (𝐴)𝑃 (𝐵)𝑃 (𝐶).                                (1)
Consider a litter of 𝑛 puppies. What value(s) of 𝑛 makes the events ‘the litter has
puppies of both sexes’ and ‘there is at most one female’ independent.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝐴 be the event “the litter has puppies of both sexes” and 𝐵 be the event
“there is at most one female.” In order for 𝐴 to ever be true, we first assume that 𝑛 > 1.
Now, if we let 𝑋 be the number of female puppies then we have
𝑃 (𝐴) = 𝑃 (1 ≤ 𝑋 ≤ 𝑛 − 1),        𝑃 (𝐵) = 𝑃 (𝑋 ≤ 1),       𝑃 (𝐴 ∩ 𝐵) = 𝑃 (𝑋 = 1)
1                   𝑛 1    𝑛
Since 𝑋 ∼ binomial(𝑛, 1/2) we have: 𝑃 (𝑋 = 0) =       𝑛
and 𝑃 (𝑋 = 1) = ( ) 𝑛 = 𝑛 . So,
2                    1 2   2
2
𝑃 (𝐴) = 1 − 𝑃 (𝑋 = 0) − 𝑃 (𝑋 = 𝑛) = 1 −
2𝑛
𝑛+1
𝑃 (𝐵) = 𝑃 (𝑋 = 0) + 𝑃 (𝑋 = 1) =
2𝑛
𝑛
𝑃 (𝐴 ∩ 𝐵) = 𝑃 (𝑋 = 1) = 𝑛 .
2
Since we are told that 𝐴 and 𝐵 are independent, we must have 𝑃 (𝐴)𝑃 (𝐵) = 𝑃 (𝐴 ∩ 𝐵).
This implies
𝑛+1          2      𝑛
( 𝑛 ) (1 − 𝑛 ) = 𝑛
2         2      2
Some algebra yields
2                𝑛+1
(𝑛 + 1) (1 −      ) = 𝑛 ⇔ 𝑛 + 1 − 𝑛−1 = 𝑛 ⇔ 2𝑛−1 = 𝑛 + 1
2𝑛                 2
Plugging small values of 𝑛 into the above equation, we find that the two events are inde-
pendent when 𝑛 = 3.
If 𝑛 = 1 then 𝑃 (𝐴) = 0, so 𝐴 and 𝐵 are (vacuously) independent, i.e. 𝑛 = 1 is technically
also a solution.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 10,10,10 pts.) Dice
Let 𝑋 be the result of rolling a fair 4-sided die. Let 𝑌 be the result of rolling a fair 6-sided
die. Let 𝑍 be the average of 𝑋 and 𝑌 .
Carefully graph the pmf and cdf of 𝑍.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : To compute the pmf of 𝑍 we need all the ways 𝑋 and 𝑌 can be averaged.
𝑍=1                       ⟷ (𝑋, 𝑌 ) = {(1, 1)}
𝑍 = 3/2                   ⟷ (𝑋, 𝑌 ) = {(1, 2), (2, 1)}
𝑍=2                       ⟷ (𝑋, 𝑌 ) = {(1, 3), (2, 2), (3, 1)}
𝑍 = 5/2                   ⟷ (𝑋, 𝑌 ) = {(1, 4), (2, 3), (3, 2), (4, 1)}
𝑍=3                       ⟷ (𝑋, 𝑌 ) = {(1, 5), (2, 4), (3, 3), (4, 2)}
𝑍 = 7/2                   ⟷ (𝑋, 𝑌 ) = {(1, 6), (2, 5), (3, 4), (4, 3)}
𝑍=4                       ⟷ (𝑋, 𝑌 ) = {(2, 6), (3, 5), (4, 4)}
𝑍 = 9/2                   ⟷ (𝑋, 𝑌 ) = {(3, 6), (4, 5)}
𝑍=5                       ⟷ (𝑋, 𝑌 ) = {(4, 6)}
Since each (𝑋, 𝑌 ) pair has probability 1/24, the pmf and cdf of 𝑍 are
𝑍        1      3/2      2      5/2         3      7/2      4       9/2                5
𝑝(𝑧)      1/24    2/24    3/24    4/24       4/24    4/24    3/24     2/24              1/24
𝐹𝑍 (𝑧)     1/24    3/24    6/24    10/24     14/24   18/24   21/24    23/24             24/24
We graph the pmf of 𝑍 as point plot and then as a density histogram. The cdf is a staircase
graph.
1
0.16
0.8
P(Z <= z)
0.12
0.6
probability
0.4
0.08
0.2
0.04
0
1        2       3      4       5                                                               0   2   4   6   8   10   12
z
z', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 5,5,5,5 pts.) Two scoops
Boxes of Raisin Bran cereal are 30cm tall. Due to settling, boxes have a higher density of
raisins at the bottom (ℎ = 0) than at the top (ℎ = 30). Suppose the density (in raisins per
cm of height) is given by 𝑓(ℎ) = 40 − ℎ.
How many raisins are in a box?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The number of raisins is
30                       30
∫         𝑓(ℎ)𝑑ℎ = ∫               (40 − ℎ)𝑑ℎ = 750
0                        0', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 5,5,5,5 pts.) Two scoops
Boxes of Raisin Bran cereal are 30cm tall. Due to settling, boxes have a higher density of
raisins at the bottom (ℎ = 0) than at the top (ℎ = 30). Suppose the density (in raisins per
cm of height) is given by 𝑓(ℎ) = 40 − ℎ.
Find and graph the cdf 𝐺(ℎ) of 𝐻.
ℎ
40ℎ   ℎ2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : For 0 ≤ ℎ ≤ 30 we have 𝐺(ℎ) = ∫ 𝑔(𝑥) 𝑑𝑥 =                                               −    .
0                      750 1500
PDF                                                           CDF: G(h) vs h
1.0
0.06
0.8
0.04
0.6
G
g
0.4
0.02
0.2
0.00
0.0
0       5     10   15        20    25        30                          0   5    10   15   20    25   30
h                                                                  h
The R code for these plots is posted in mit18_05_s22_ps3_sol.r', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 5,5,10 pts.) Gallery of continuous random variables.
The pnorm() function on R gives the cdf of the normal distribution, e,g, if 𝑋 ∼ N(𝜇, 𝜎2 )
then pnorm(𝑥, 𝜇, 𝜎) = 𝑃 (𝑋 ≤ 𝑥) = 𝐹𝑋 (𝑥).
Suppose 𝑍 is a standard normal random variable. Use R to compute
(i) 𝑃 (𝑍 ≤ 0),           (ii) 𝑃 (𝑍 > 1.5)                (iii) 𝑃 (|𝑍| < 1.5).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (i) You don’t need R for this: 𝑃 (𝑍 ≤ 0) = 0.5.
18.05 Problem Set 3, Spring 2022 Solutions                                                                             7
(ii) 𝑃 (𝑍 > 1.5) = 1 - pnorm(1.5) = 0.0668072.
(iii) 𝑃 (|𝑍| ≤ 1.5) = pnorm(1.5) - pnorm(-1.5) = 0.8663856.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 5,5,10 pts.) Gallery of continuous random variables.
The pnorm() function on R gives the cdf of the normal distribution, e,g, if 𝑋 ∼ N(𝜇, 𝜎2 )
then pnorm(𝑥, 𝜇, 𝜎) = 𝑃 (𝑋 ≤ 𝑥) = 𝐹𝑋 (𝑥).
Let 𝑌 ∼ exp(𝜆). Compute the cdf of 𝑌 by integrating the pdf. What is the probability
𝑌 ≤ 1/𝜆? (You need to do an integration, but you can check your work numerically using
the pexp() function in R.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The pdf is 𝑓𝑌 (𝑦) = 𝜆e−𝜆𝑦 . The range of 𝑌 starts at 0. We compute the cdf by
integration
𝑎
𝐹𝑌 (𝑎) = 𝑃 (𝑌 ≤ 𝑎) = ∫ 𝜆e−𝜆𝑦 𝑑𝑦 = 1 − e−𝜆𝑎 .
0
We use this to compute the probability asked for:
𝑃 (𝑌 ≤ 1/𝜆) = 𝐹𝑌 (1/𝜆) = 1 − e−1 ≈ 0.6321206.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 5,5,5,5 pts.) Birth day
The length of human gestation is well-approximated by a normal distribution with mean
𝜇 = 280 days and standard deviation 𝜎 = 8.5 days.
Suppose your final exam is scheduled for May 18 and your pregnant professor has a due
date of May 25. Find the probability she will give birth on or before the day of the final.
18.05 Problem Set 3, Spring 2022 Solutions                                                8', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : There is some ambiguity here depending on the exact time of day of the due
date. In order to get whole numbers, we’ll assume the due date is at the same hour on the
25th as the final is on the 18th. So the final is exactly 7 days before the due date. (We’ll
accept any number between 6 and 8.)
Let 𝑋 be the number of days before or after May 25 that the baby is born. We want the
probability 𝑋 ≤ −7 We know 𝑋 ∼ 𝑁 (0, 8.5).
𝑃 (𝑋 ≤ −7) = pnorm(-7, 0, 8.5) = 0.205
7
(Or we could have computed 𝑃 (𝑋 ≤ −7) = 𝑃 (𝑍 ≤ − 8.5 ) = pnorm(-7/8.5, 0, 1) ≈
0.205., where 𝑍 is standard normal.)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 5,5,5,5 pts.) Birth day
The length of human gestation is well-approximated by a normal distribution with mean
𝜇 = 280 days and standard deviation 𝜎 = 8.5 days.
The professor decides to move up the exam date so there will be a 95% probability that
she will give birth afterward. What date should she pick?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We want to find 𝑥 such that 𝑃 (𝑋 ≥ 𝑥) = 0.95. That is, we want
𝑥
𝑃 (𝑍 ≥       ) = 0.95.
8.5
This says that 𝑥/8.5 must be the 0.05 quantile for 𝑍.
Using R: x = 8.5*qnorm(0.05), we find 𝑥 ≈ −14 (May 11).
Note: we could have skipped standardizing and computed this with qnorm(0.05, 0, 8.5)
18.05 Introduction to Probability and Statistics
Spring 2022
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 5,5,10,5 pts.) Time to failure
Recall that an exponential random variable 𝑋 ∼ exp(𝜆) has pdf given by 𝑓(𝑥) = 𝜆𝑒−𝜆𝑥 on
𝑥 ≥ 0.
Compute the mean and standard deviation of 𝑋. You need to set up the necessary
integrals, but you can use Wolfram Alpha or another application to do the computation. (Of
course, it will be good for you if you compute the integrals by hand!)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : First we compute the mean
∞                      ∞                               ∞
e−𝜆𝑥     1
𝐸[𝑋] = ∫               𝑥𝑓(𝑥) 𝑑𝑥 = ∫           𝜆𝑥e−𝜆𝑥 𝑑𝑥 = −𝑥e−𝜆𝑥 −         ∣ = .
0                      0                                𝜆 0     𝜆
For the variance, we use the formula Var(𝑋) = 𝐸[𝑋 2 ] − 𝐸[𝑋]2 .
∞                          ∞                                                 ∞
2              2                              2 −𝜆𝑥           2 −𝜆𝑥     2𝑥e−𝜆𝑥 2e−𝜆𝑥     2
𝐸[𝑋 ] = ∫          𝑥 𝑓(𝑥) 𝑑𝑥 = ∫              𝜆𝑥 e         𝑑𝑥 = −𝑥 e       −       −   2
∣ = 2
0                          0                                        𝜆     𝜆     0
𝜆
2   1   1                             1
So, Var(𝑋) =     −   = 2 . So, standard deviation 𝜎 = .
𝜆2 𝜆2  𝜆                              𝜆', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 10,10 pts.) Elections
To head the newly formed US Dept. of Statistics, suppose that 50% of the population
supports Alessandre, 20% supports Sarah, and the rest are split between Gabriel, Sarah and
So Hee. A poll asks 400 random people who they support.
Use the central limit theorem to estimate the probability that at least 52.5% of those
polled prefer Alessandre?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑋𝑖 be the result of polling person 𝑖:
1 if person 𝑖 supports Alessandre
𝑋𝑖 = {
0 if person 𝑖 does not support Alessandre
Then 𝑋𝑖 ∼ Bern(0.5) and the number of people who prefer Alessandre is
𝑆 = 𝑋1 + ⋯ + 𝑋400 .
We know 𝐸[𝑋𝑖 ] = 1/2 and Var(𝑋𝑖 ) = 1/4. This implies 𝐸[𝑆] = 200 and Var(𝑆) = 100.
Thus, the central limit theorem tells us that
𝑆 ≈ N(200, 100).
The problem asks for 𝑃 (𝑆 > 210):
𝑆 − 200   210 − 200
𝑃 (𝑆 > 210) = 𝑃 (           >           ) ≈ 𝑃 (𝑍 > 1) ≈ 0.16 .
10          10', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(10 pts.) A penny for your thoughts
To save a mint, in 2012 Canada decided to do away with its pennies. The Chubby Chef in
Equality, Illinois wants to be ready should the United States decide to pass a similar law.
The Chubby Chef processes 𝑛 = 1000 orders of assorted baked goods each day, and will
round the price of each order to the nearest nickel (e.g., $3.57 rounds to $3.55 while $3.58
rounds to $3.60). Let 𝑝 be the probability that the total rounding error over the course of
a day is either greater than 100 or less than -100 cents, i.e. exceeds 100 in absolute value.
Estimate 𝑝 using the central limit theorem.
Extra credit 5 points Simulate this in R with 10000 trials. (Each trial involves 1000
orders.) Print out or hand copy your code and include it. Give the result of running your
code 3 times,', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑆 be the total rounding error for a day. The problems asks for
𝑃 (|𝑆| > 100).
Let 𝑋𝑖 be the rounding error (in cents) of the 𝑖th order. Then 𝑋𝑖 takes values −2, −1, 0, 1, 2,
each with probability 15 . We compute
𝐸[𝑋𝑖 ] = 𝜇 = 0,    Var(𝑋𝑖 ) = 𝜎2 = 2.
The total rounding error 𝑆 = 𝑋1 + ⋯ + 𝑋1000 . By the Central Limit Theorem, we know
that 𝑆 ≈ N(0, 2000).
|𝑆 − 0|   100 − 0               100
𝑃 (|𝑆| ≥ 100) = 𝑃 ( √       ≥ √       ) ≈ 𝑃 (|𝑍| ≥ √      ) = 0.0253 .
2000      2000                 2000
Extra credit 5 points Simulate this in R with 10000 trials. (Each trial involves 1000
orders.) Print out or hand copy your code and include it. Give the result of running your
code 3 times,
Solution: Here’s my code.
ntrials = 10000
n_orders = 1000
threshold = 100
cnt_above_threshold = 0
for (j in 1:ntrials) {
# The rounding error is 0, -1, -2, 2, 1 depending on if the price modulo 5
is 0, 1, 2, 3, 4
# Generate 1000 random orders, just keep the rounding error
x = sample(c(0,-1,-2,2,1), n_orders, replace=TRUE)
total_error = sum(x)
if (abs(total_error) > threshold) {
cnt_above_threshold = cnt_above_threshold + 1
}
}
18.05 Problem Set 4, Spring 2022 Solutions                                                  4
prob_above_thresh = cnt_above_threshold/ntrials
print(prob_above_thresh)
In three runs it gave 0.0245, 0.0263, 0.0216. This agrees nicely with the CLT estimate.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 10,10,10 pts.) Change of scale.
In this problem we will look at scaling random variables. This is a simple, but common
thing to do. As usual with transformations, if you don’t approach it systematically, it is
easy to make mistakes.
Let 𝑉 = 𝑋 3 . Find the range and pdf of 𝑉 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We follow the same pattern as in the previous parts. The range of 𝑉 is [0, ∞).
𝐹𝑉 (𝑣) = 𝑃 (𝑉 ≤ 𝑣) = 𝑃 (𝑋 3 ≤ 𝑣) = 𝑃 (𝑋 ≤ 𝑣1/3 ) = 𝐹𝑋 (𝑣1/3 ).
Taking the derivative:
𝑑           𝑑              1                   1                 1         1/3
𝑓𝑉 (𝑣) =      𝐹𝑉 (𝑣) =                        ′
𝐹𝑋 (𝑣1/3 ) = 𝑣−2/3 𝐹𝑋 (𝑣1/3 ) = 𝑣−2/3 𝑓𝑋 (𝑣1/3 ) = 𝑣−2/3 e−𝑣 .
𝑑𝑣          𝑑𝑣             3                   3                 3', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 10,10,10 pts.) In this problem we will explore how the transformations in
the previous problem affect the mean and median.
For 𝑉 from the previous problem, compute 𝐸[𝑉 ]. As usual, you must set up the integral,
but you can use a package like Wolfram Alpha to compute the integral.
∞                    ∞
1            1/3', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐸[𝑉 ] = ∫        𝑣𝑓𝑉 (𝑣) 𝑑𝑣 =    ∫ 𝑣1/3 e−𝑣 𝑑𝑣. This integral can be computed
0                   3 0
using the change of variable 𝑢 = 𝑣1/3 , i.e. 𝑢3 = 𝑣. The final answer is 𝐸[𝑉 ] = 6. (Wolfram
Alpha agrees!)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 5,5,10,10 pts.) Fat tails
This problem will explore the tails of two distributions. The tails are important when we
want to think about probabilities of extreme events.
As an example, in the general population IQ has mean 100 and standard deviation of
15. IQ is normally distributed. Use the R function pnorm to give the probability that a
randomly chosen person has IQ greater than 160, i.e. more than 4 standard deviations
above the mean.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We use the R code p = 1 - pnorm(160, 100, 15). This gives the probability
𝑝 = 3.167124 × 10−5 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(35: 5,10,5,10,5 pts.) Aching joints
Suppose 𝑋 and 𝑌 have joint pdf 𝑓(𝑥, 𝑦) = 𝑐(𝑥2 + 𝑥𝑦) on [0, 1] × [0, 1].
Find 𝑐 and the joint cdf 𝐹 (𝑥, 𝑦).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have
1       1                          1
𝑥         1 1   7𝑐
1 = ∫ ∫ 𝑐(𝑥2 + 𝑥𝑦)𝑑𝑦𝑑𝑥 = 𝑐 ∫ 𝑥2 +                                𝑑𝑥 = 𝑐 ( + ) = .
0       0                          0            2         3 4   12
12
Thus, 𝑐 =      . We have:
7
𝑥    𝑦
12
𝐹 (𝑥, 𝑦) = 𝑃 (𝑋 ≤ 𝑥, 𝑌 ≤ 𝑦) =                 ∫ ∫ 𝑢2 + 𝑢𝑣 𝑑𝑦 𝑑𝑥
7 0 0
𝑥
12          𝑢𝑦2
=    ∫ 𝑢2 𝑦 +     𝑑𝑢
7 0          2
12 𝑥3 𝑦 𝑥2 𝑦2
=     (    +      ).
7   3    4', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(35: 5,10,5,10,5 pts.) Aching joints
Suppose 𝑋 and 𝑌 have joint pdf 𝑓(𝑥, 𝑦) = 𝑐(𝑥2 + 𝑥𝑦) on [0, 1] × [0, 1].
Find 𝐸[𝑋] and Var(𝑋).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The computation is slightly easier if we use the formula Var(𝑋) = 𝐸[𝑋 2 ]−𝐸[𝑋]2 .
1                              1
12          𝑥       12 1 1   5
𝐸[𝑋] = ∫ 𝑥𝑓𝑋 (𝑥) 𝑑𝑥 =                          ∫ 𝑥 (𝑥2 + ) 𝑑𝑥 =   ( + )=   ≈ 0.7143
0                             7 0         2       7 4 6    7
1
39
𝐸[𝑋 2 ] = ∫ 𝑥2 𝑓𝑋 (𝑥) 𝑑𝑥 =                      ≈ 0.5571.
0                             70
1
18.05 Problem Set 5, Spring 2022 Solutions                                                          2
Thus Var(𝑋) = 𝐸[𝑋 2 ] − 𝐸[𝑋]2 ≈ 0.0469 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(35: 5,10,5,10,5 pts.) Aching joints
Suppose 𝑋 and 𝑌 have joint pdf 𝑓(𝑥, 𝑦) = 𝑐(𝑥2 + 𝑥𝑦) on [0, 1] × [0, 1].
Are 𝑋 and 𝑌 independent?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : No they are not independent. We can see this in two ways. First, their joint
pdf is not the product of the marginal pdfs. Second, their covariance is not 0.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 10,10 pts.) Correlation
Suppose 𝑋 and 𝑌 are random variables with
1                                  1
𝑃 (𝑋 = 1) = 𝑃 (𝑋 = −1) = ;         𝑃 (𝑌 = 1) = 𝑃 (𝑌 = −1) = .
2                                  2
Let 𝑐 = 𝑃 (𝑋 = 1 and 𝑌 = 1).
For what value(s) of 𝑐 are 𝑋 and 𝑌 independent? For what value(s) of 𝑐 are 𝑋 and 𝑌
100% correlated?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Note that the correlation runs from −1 to 1 as 𝑐 runs from 0 to 0.5.
If 𝑋 and 𝑌 are independent then we must have Cov(𝑋, 𝑌 ) = 0. This only happens when
𝑐 = 14 . Covariance equal 0 does not guarantee independence, but for this value of 𝑐, it is
easy to check that all four probabilities in the table are 0.25 and 𝑋 and 𝑌 are, indeed,
independent.
When 𝑐 = 0 the correlation is -1, which means 𝑋 and 𝑌 are fully correlated (sometimes
called fully anti-correlated). When 𝑐 = 0.5 the correlation is 1.0 and 𝑋 and 𝑌 are fully
correlated.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(40: 5,5,10,10,10 pts.) Don’t be late!
Alicia and Bernardo are trying to meet for lunch and both will arrive, independently of each
other, uniformly and at random between noon and 1pm. Let 𝐴 and 𝐵 be the number of
minutes after noon at which Alicia and Bernardo arrive, respectively. Then 𝐴 and 𝐵 are
independent uniformly distributed random variables on [0, 60].
18.05 Problem Set 5, Spring 2022 Solutions                                                      4
Hint: For parts (c-e) you might find it easiest to find the fraction of the square [0, 60]×[0, 60]
filled by the event.
Find the probability that Alicia arrives before 12:30.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Since 𝐴 is uniformly distributed on [0, 60], 𝑃 (𝐴 ≤ 30) = 12 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(40: 5,5,10,10,10 pts.) Don’t be late!
Alicia and Bernardo are trying to meet for lunch and both will arrive, independently of each
other, uniformly and at random between noon and 1pm. Let 𝐴 and 𝐵 be the number of
minutes after noon at which Alicia and Bernardo arrive, respectively. Then 𝐴 and 𝐵 are
independent uniformly distributed random variables on [0, 60].
18.05 Problem Set 5, Spring 2022 Solutions                                                      4
Hint: For parts (c-e) you might find it easiest to find the fraction of the square [0, 60]×[0, 60]
filled by the event.
Find the probability that Alicia arrives less than five minutes after Bernardo. (Hint:
use method (ii) from part (c).)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The shaded area in the figure below corresponds to the event ‘𝐴 ≤ 𝐵 + 5’. (Note:
if Alicia arrives before Bernardo then she arrives less than 5 minutes after him.) That is,
it corresponds to all pairs of arrival times (𝑎, 𝑏) such that 𝑎 ≤ 𝑏 + 5. 𝑃 (𝐴 ≤ 𝐵 + 5) is then
just the area of the blue region divided by the area of the entire square. The area of the
blue region is the area of the full square minus the area of the unshaded triangle. The area
552
of the white region is      . So,
2
1          552
𝑃 (𝐴 ≤ 𝐵 + 5) =         (3600 −     ) = 0.5799 .
3600          2
18.05 Problem Set 5, Spring 2022 Solutions                                              5
(0, 60)                 (55, 60)
(60, 60)
5
+
𝐴
𝐵
=
𝐴
(0, 5)
(60, 0)
(0, 0)
𝐵', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(10 pts.) Overlapping sums
Suppose 𝑋1 , 𝑋2 , … are independent exponential(2) random variables. Suppose also that 𝑋
is the sum of the first 𝑛 and 𝑌 is the sum of 𝑋𝑛−7 to 𝑋2𝑛−8 . Compute Cov(𝑋, 𝑌 ) and
Cor(𝑋, 𝑌 ). You should assume that 𝑛 ≥ 8.
Hints: The variance of an exponential(𝜆) random variable is 1/𝜆2 . Use the linearity rules
for covariance. What is the size of the overlap?




18.05 Introduction to Probability and Statistics
Spring 2022


For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The problem states that
𝑛               2𝑛−8
𝑋 = ∑ 𝑋𝑖                 𝑌 = ∑ 𝑋𝑖
𝑖=1               𝑖=𝑛−7
Notice that 𝑋 and 𝑌 have an overlap of 8 terms. We can use the linearity rules for
covariance:
𝑛          2𝑛−8              𝑛   2𝑛−8
Cov(𝑋, 𝑌 ) = Cov (∑ 𝑋𝑖 , ∑ 𝑋𝑗 ) = ∑ ∑ Cov(𝑋𝑖 , 𝑋𝑗 ).
𝑖=1        𝑗=𝑛−7          𝑖=1 𝑗=𝑛−7
That is, Cov(𝑋, 𝑌 ) is the sum of all pairs consisting of a term from 𝑋 and a term from 𝑌 .
Since the different terms are independent we know that Cov(𝑋𝑖 , 𝑋𝑗 ) = 0 if 𝑖 ≠ 𝑗. So only
the overlap contributes to the covariance:
𝑛                         𝑛                   𝑛
1
Cov(𝑋, 𝑌 ) = ∑ Cov(𝑋𝑖 , 𝑋𝑖 ) = ∑ Var(𝑋𝑖 ) = ∑
𝑖=𝑛−7                       𝑖=𝑛−7              𝑖=𝑛−7
4
There are 8 such terms, all with the variance 1/4, so Cov(𝑋, 𝑌 ) = 8 ⋅ 1/4 = 2.
Since 𝑋 is the sum of 𝑛 independent variables with variance 1/4 we have Var(𝑋) = 𝑛/4.
Likewise Var(𝑌 ) = 𝑛/4. So
Cov(𝑋, 𝑌 )    2    8
Cor(𝑋, 𝑌 ) =                   =     = .
𝜎𝑋 𝜎𝑌      𝑛/4  𝑛
18.05 Introduction to Probability and Statistics
Spring 2022
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 5,10,10 pts.) Least squares
In this problem we will use maximum likelihood estimates to develop Gauss’ method of least
squares for fitting lines to data.
Bivariate data means data of the form
(𝑥1 , 𝑦1 ), (𝑥2 , 𝑦2 ), … , (𝑥𝑛 , 𝑦𝑛 ).
For bivariate data the simple linear regression model assumes that, for some values of the
parameters 𝑎 and 𝑏, we have
𝑦𝑖 = 𝑎𝑥𝑖 + 𝑏 + random measurement error.
The model assumes the measurement errors are independent and identically distributed and
follow a N(0, 𝜎2 ) distribution. (The values 𝑥𝑖 may or may not be random.)
In general terms, we can say that the value of 𝑥 ‘explains’ the value of 𝑦 except for some
random noise. Graphically, the model says to make a scatter plot and find the line that best
fits the data. This is called a simple linear regression model.
1
18.05 Problem Set 6, Spring 2022 Solutions                                                         2
It turns out that, under some assumptions about random variation of measurement error,
one way to find a “best” line is by solving a maximum likelihood problem.
The goal is to find the values of the model parameters 𝑎 and 𝑏 that give the MLE for this
model. To guide you, we note that the model says that
𝑦𝑖 ∼ N(𝑎𝑥𝑖 + 𝑏, 𝜎2 ).
Also remember that you know the density function for this distribution.
Consider the data (1, 8), (3, 2), (5, 1). Assume that 𝜎 = 3 is a known constant and find
the maximum likelihood estimate for 𝑎 and 𝑏.
Note: since there are two variables 𝑎 and 𝑏, in order to find a critical point you will have
to take partial derivatives and set them equal to 0. This part of the problem takes a fair
amount of tedius algebra –sorry.
Note: We gave you a specific value of 𝜎, to avoid the distraction of one more symbol. If
you look at your calculations, you should see that the value of 𝜎 plays no role in finding the
MLE for 𝑎 and 𝑏. We get the same answer no matter what the value.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The likelihood for all the data is the product of the individual likelihoods. So,
3
1               2         2         2     2
𝑓((1, 8), (3, 2), (5, 1) | 𝑎, 𝑏, 𝜎) = ( √     ) e−((8−𝑎−𝑏) +(2−3𝑎−𝑏) +(1−5𝑎−𝑏) )/(2𝜎 )
2𝜋 𝜎
Taking the natural log (and replacing the list of data by the word ‘data’) we get
√        (8 − 𝑎 − 𝑏)2 + (2 − 3𝑎 − 𝑏)2 + (1 − 5𝑎 − 𝑏)2
ln(𝑓(data | 𝑎, 𝑏, 𝜎)) = −3 ln( 2𝜋 𝜎) −
2𝜎2
Since we want to find 𝑎 and 𝑏 that maximize the likelihood we take the partial derivatives
and set them to 0.
𝜕 ln(𝑓(data) | 𝑎, 𝑏, 𝜎)   2
= 2 ((8 − 𝑎 − 𝑏) + 3(2 − 3𝑎 − 𝑏) + 5(1 − 5𝑎 − 𝑏)) = 0
𝜕𝑎              2𝜎
𝜕 ln(𝑓(data) | 𝑎, 𝑏, 𝜎)   2
= 2 ((8 − 𝑎 − 𝑏) + (2 − 3𝑎 − 𝑏) + (1 − 5𝑎 − 𝑏)) = 0
𝜕𝑏              2𝜎
These are two equations in the unknowns 𝑎 and 𝑏. We simplify and solve:
35𝑎 + 9𝑏 = 19
which gives       𝑎 = −7/4 = −1.75;          𝑏 = 107/12 ≈ 8.917.
9𝑎 + 3𝑏 = 11
18.05 Problem Set 6, Spring 2022 Solutions                                                  3
The linear regression fit of a line to the data is 𝑦 = 𝑎𝑥 + 𝑏 = −7𝑥/4 + 107/12.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(15: 10,5 pts.) Estimating uniform parameters
Suppose we have data 1.2, 2.1, 1.3, 10.5, 5 which we know is drawn indepenedently
from a uniform(𝑎, 𝑏) distribution. Give the maximum likelihood estimate for the parameters
𝑎 and 𝑏.
Hint: in this case you should not try to find the MLE by differentiating the likelihood
function.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The pdf for uniform(𝑎, 𝑏) distribution takes two values
1/(𝑏 − 𝑎)   if 𝑥 is in [𝑎, 𝑏]
𝑓(𝑥 | 𝑎, 𝑏) = {
0           otherwise
Since the likelihood is the product of the likelihoods of each data point, the likelihood
function is
1/(𝑏 − 𝑎)5 if all data is in [𝑎, 𝑏]
𝑓(data | 𝑎, 𝑏) = {
0          if not
This is maximized when (𝑏 − 𝑎) is as small as possible. Since all the data has to be in the
interval [𝑎, 𝑏] we minimize (𝑏 − 𝑎) by taking 𝑎 = minimum of data and 𝑏 = maximum of
data.
Answer: 𝑎 = 1.2, 𝑏 = 10.5 .
18.05 Problem Set 6, Spring 2022 Solutions                                                   4', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 10,10,10 pts.) (Monty Hall: Sober and drunk)
Recall the Monty Hall problem: Monty hosts a game show. There are three doors: one hides
a car and two hide goats. The contestant Shelby picks a door, which is not opened. Monty
then opens another door which has a goat behind it. Finally, Shelby must decide whether to
stay with her original choice or switch to the other unopened door. The problem asks which
is the better strategy: staying or switching?
To be precise, let’s label the door that Shelby picks by 𝐴, and the other two doors by 𝐵 and
𝐶. Hypothesis 𝐻𝐴 is that the car is behind door 𝐴, and similarly for hypotheses 𝐻𝐵 and
𝐻𝐶 .
In the usual formulation, Monty is sober and knows the locations of the car and goats.
So if the contestant picks a door with a goat, Monty always opens the other door with a
goat. And if the contestant picks the door with a car, Monty opens one of the other two
doors at random. Suppose that sober Monty Hall opens door 𝐵, revealing a goat. So the
data is: ‘Monty showed a goat behind 𝐵’. Our hypotheses are ‘the car is behind door A’,
etc. Make a Bayes table with prior, likelihood and posterior. Use the posterior probabilities
to determine the best strategy.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : In all three parts to this problem we have 3 hypotheses:
𝐻𝐴 = ‘the car is behind door 𝐴’
𝐻𝐵 = ‘the car is behind door 𝐵’
𝐻𝐶 = ‘the car is behind door 𝐶’.
In all three parts the data is 𝐷 = ‘Monty opens door 𝐵 and reveals a goat’.
The key to our Bayesian update table is the likelihoods: For part (a), since Monty is sober
he always reveals a goat.
𝑃 (𝐷|𝐻𝐴 ): 𝐻𝐴 says the car is behind 𝐴. So, assuming 𝐻𝐴 is true, Monty is equally likely
to pick 𝐵 or 𝐶 and reveal a goat. Thus 𝑃 (𝐷|𝐻𝐴 ) = 1/2.
𝑃 (𝐷|𝐻𝐵 ): If 𝐻𝐵 is true, the car is behind 𝐵 and sober Monty will never choose 𝐵 (and if
he did it would not reveal a goat). So 𝑃 (𝐷|𝐻𝐵 ) = 0.
𝑃 (𝐷|𝐻𝐶 ): If 𝐻𝑐 is true, the car is behind 𝐶. Since sober Monty doesn’t make mistakes he
will open door 𝐵 and reveal a goat. So 𝑃 (𝐷|𝐻𝐶 ) = 1.
Here is the table for this situation.
Hyp. Prior Likelihood        Bayes numerator      Posterior
𝐻       𝑃 (𝐻) 𝑃 (data|𝐻)    𝑃 (𝐻)𝑃 (data|𝐻)     𝑃 (𝐻|data)
𝐻𝐴        1/3        1/2           1/6              1/3
𝐻𝐵        1/3         0             0                0
𝐻𝐶        1/3         1            1/3              2/3
Total:       1         –            1/2               1
Therefore, Shelby should switch to door 𝐶, since the posterior probability 𝐻𝐶 is true is
twice that of 𝐻𝐴 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 10,10,10 pts.) (Monty Hall: Sober and drunk)
Recall the Monty Hall problem: Monty hosts a game show. There are three doors: one hides
a car and two hide goats. The contestant Shelby picks a door, which is not opened. Monty
then opens another door which has a goat behind it. Finally, Shelby must decide whether to
stay with her original choice or switch to the other unopened door. The problem asks which
is the better strategy: staying or switching?
To be precise, let’s label the door that Shelby picks by 𝐴, and the other two doors by 𝐵 and
𝐶. Hypothesis 𝐻𝐴 is that the car is behind door 𝐴, and similarly for hypotheses 𝐻𝐵 and
𝐻𝐶 .
Based on Monty’s pre-show behavior, Shelby thinks that Monty is sober with probability
0.7 and drunk with probability 0.3. Repeat the analysis from parts (a) and (b) in this
situation.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have to recompute the likelihoods. Remember the data is that Monty chooses
door 𝐵 and reveals a goat.
𝑃 (𝐷|𝐻𝐴 ): If the car is behind 𝐴 then sober or drunk Monty is equally likely to choose door
𝐵 and reveal a goat. Thus 𝑃 (𝐷|𝐻𝐴 ) = 1/2.
𝑃 (𝐷|𝐻𝐵 ): If the car is behind door 𝐵, then if he chooses it he will reveal a car, not a goat.
So the probability of the data given 𝐻𝐵 is 0, i.e., 𝑃 (𝐷|𝐻𝐵 ) = 0.
𝑃 (𝐷|𝐻𝐶 ): Let 𝑆 be the event that Monty is sober and 𝑆 𝑐 the event he is drunk. From
the table in (a), we see that 𝑃 (𝐷|𝐻𝐶 , 𝑆) = 1 and from the table in (b), we see that
𝑃 (𝐷|𝐻𝐶 , 𝑆 𝑐 ) = 1/2. Thus, by the law of total probability
1               17
𝑃 (𝐷|𝐻𝐶 ) = 𝑃 (𝐷|𝐻𝐶 , 𝑆)𝑃 (𝑆) + 𝑃 (𝐷|𝐻𝐶 , 𝑆 𝑐 )𝑃 (𝑆 𝑐 ) = 0.7 + (0.3) = 0.85 =    .
2               20
18.05 Problem Set 7, Spring 2022 Solutions                                                      3
Hyp.      Prior    Likelihood    Bayes numerator        Posterior
𝐻        𝑃 (𝐻)    𝑃 (data|𝐻)    𝑃 (𝐻)𝑃 (data|𝐻)       𝑃 (𝐻|data)
𝐻𝐴        1/3         1/2              1/6               10/27
𝐻𝐵        1/3          0                0                  0
𝐻𝐶        1/3        17/20           17/60               17/27
Total:       1          –              9/20                 1
Thus, switching gives a probability of 17/27 of winning. So switching is still the best strategy.
The intuitive feel for this is that even a little bit sober, Monty is giving some information
by picking 𝐵, or, more precisely, avoiding 𝐶.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(40: 10,10,10,5,5 pts.) Prediction
We are going to explore the dice problem from class further. I have five dice (4, 6, 8, 12, or
20 sides) and pick one at random (uniform probability). I then roll this die 𝑛 times and tell
you that, miraculously, every roll resulted in the value 7. As I am in a position of authority,
assume that I am telling the truth!
Find the posterior probability 𝑃 (𝐻|data) for each die given the data of all 𝑛 rolls (your
18.05 Problem Set 7, Spring 2022 Solutions                                                  4
answers should involve 𝑛). What is the limit of each of these probabilities as 𝑛 grows to
infinity? Explain why this makes sense.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We make the Bayesian update table. This is similar to the table in part (a).
The main difference is that the likelihood column needs to account for all 𝑛 rolls.
Hyp. Prior Likelihood                      Bayes numer.                Posterior
𝐻      𝑃 (𝐻) 𝑃 (data|𝐻)                 𝑃 (𝐻)𝑃 (data|𝐻)             𝑃 (𝐻|data)
𝐷4       1/5         0                           0                         0
𝐷6       1/5         0                           0                         0
1                          1
𝐷8       1/5      (1/8)𝑛                    5 ⋅ (1/8) 𝑛
5𝑇 (1/8) 𝑛
1                        1
𝐷12      1/5       (1/12)𝑛                      5 ⋅ (1/12)
𝑛
5𝑇 (1/12)
𝑛
1                        1
𝐷20      1/5       (1/20)𝑛                      5 ⋅ (1/20)
𝑛
5𝑇 (1/20)
𝑛
Total:     1           –          𝑇 = 15 ⋅ ((1/8) + (1/12) + (1/20)𝑛 )
𝑛           𝑛
1
The posterior probabilities are given in the table. To find what happens as 𝑛 grows large,
we rewrite the posterior probabilities by multiplying numerator and denominator by 8𝑛 :
1
𝑃 (𝐷8 |data) =            𝑛        𝑛
1 + ( 23 ) + ( 25 )
𝑛
( 23 )
𝑃 (𝐷12 |data) =            𝑛        𝑛
1 + ( 23 ) + ( 25 )
𝑛
( 25 )
𝑃 (𝐷20 |data) =            𝑛        𝑛
1 + ( 23 ) + ( 25 )
𝑛               𝑛
As 𝑛 → ∞, we know that ( 23 ) → 0 and ( 25 ) → 0. Thus, as 𝑛 grows to infinity, 𝑃 (𝐷8 |data)
approaches 1 and the posterior probability of all the other hypotheses goes to 0.
This makes sense because, as unlikely as it is, rolling 𝑛 sevens is vastly more probable with
the 8-sided die is vastly than with the bigger ones.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(40: 10,10,10,5,5 pts.) Prediction
We are going to explore the dice problem from class further. I have five dice (4, 6, 8, 12, or
20 sides) and pick one at random (uniform probability). I then roll this die 𝑛 times and tell
you that, miraculously, every roll resulted in the value 7. As I am in a position of authority,
assume that I am telling the truth!
Let 𝑥𝑖 is the result of the 𝑖th roll.
Find the posterior predictive pmf for the (𝑛 + 1)st roll given the data. That is, find
1
𝑃 (𝑥𝑛+1 |𝑥1 = 7, ⋯ , 𝑥𝑛 = 7) for 𝑥𝑛+1 = 1, … , 20. (Hint: use part (b) and the law of to-
tal probability. Many values of the pmf coincide, so you do not need to do 20 separate
computations. You should check that your answer is consistent with your ranking in part', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑥𝑖 is the result of the 𝑖th roll.
Find the posterior predictive pmf for the (𝑛 + 1)st roll given the data. That is, find
𝑃 (𝑥𝑛+1 |𝑥1 = 7, ⋯ , 𝑥𝑛 = 7) for 𝑥𝑛+1 = 1, … , 20. (Hint: use part (b) and the law of to-
tal probability. Many values of the pmf coincide, so you do not need to do 20 separate
computations. You should check that your answer is consistent with your ranking in part', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 10,10,5,5 pts.) (Odds)
You have a drawer that contains 50 coins. 10 coins have probability 𝑝 = 0.3 of heads, 30
coins have probability 𝑝 = 0.5 and 10 coins have probability 𝑝 = 0.7. You pick one coin at
random from the drawer and flip it.
What are the (prior) odds you chose a 0.3 coin? A 0.7 coin?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Odds of 𝐴 are 𝑃 (𝐴)/𝑃 (𝐴𝑐 ). So both types of coin have odds 0.2/0.8 = 1/4.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 10,10,5,5 pts.) (Odds)
You have a drawer that contains 50 coins. 10 coins have probability 𝑝 = 0.3 of heads, 30
coins have probability 𝑝 = 0.5 and 10 coins have probability 𝑝 = 0.7. You pick one coin at
random from the drawer and flip it.
Suppose the flip lands heads.
(i) What are the posterior odds the coin is a 0.3 coin?
(ii) What are the posterior odds the coin is a 0.7 coin?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (i) From the table we see the posterior probability the coin is the 0.3 coin is 0.12
0.12   12
so the posterior odds are      =     = 0.136 .
0.88   88
0.28   28
(ii) Likewise the posterior odds it’s the 0.7 coin are        =    = 0.389 .
0.72   72', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 10,10 pts.) (Courtroom fallacies)
[True story] In 1999 in Great Britain, Sally Clark was convicted of murdering her two
sons after each child died weeks after birth (the first in 1996, the second in 1998). Her
conviction was largely based on the testimony of the pediatrician Professor Sir Roy Meadow.
He claimed that, for an affluent non-smoking family like the Clarks, the probability of a
single cot death (SIDS) was 1 in 8543, so the probability of two cot deaths in the same
family was around “1 in 73 million.” Given that there are around 700,000 live births in
Britain each year, Meadow argued that a double cot death would be expected to occur once
every hundred years. Finally, he reasoned that given this vanishingly small rate, the far
more likely scenario is that Sally Clark murdered her children.
Carefully explain at least two errors in Meadow’s argument.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Here are four errors in the argument
1. The prosecutor arrived at “1 in 73 million” as follows: The probability that 1 child
from an affluent non-smoking family dies of SIDS is 1/8543, so the probability that
2 children die is (1/8543)2 . However, this assumes that the SIDS death among sib-
lings are independent. Due to genetic or environmental factors, we suspect that this
assumption is invalid.
2. The use of the figure “700,000 live births in Britain each year.” The prosecutor had
restricted attention only to affluent non-smoking families when (erroneously) comput-
ing the probability of two SIDS deaths. However, he does not similarly restrict his
attention when considering the number of births.
3. The rate “once every hundred years” is not valid: The prosecutor arrived at this by
multiplying the number of live births by the probability that two children die from
SIDS. The result is a non-sensical rate.
4. While double SIDS is very unlikely, double infanticide may be even more unlikely. It
is the odds of one explanation relative to the other given the deaths that matters, and
not just how unlikely one possibility is.
The Sally Clark case is an example of the “Prosecutor’s Fallacy.” You can read about it at
https://en.wikipedia.org/w/index.php?title=Sally_Clark&oldid=629645024
There is also a video that discusses legal fallacies at
https://www.ted.com/talks/peter_donnelly_shows_how_stats_fool_juries', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 10,10,10 pts.) (Normal is the new normal)
Your friend transmits an unknown value 𝜃 to you over a noisy channel. The noise is
normally distributed with mean 0 and a known variance 4, so the value 𝑥 that you receive is
modeled by 𝑥 ∼ 𝑁 (𝜃, 22 ). Based on previous communications, your prior on 𝜃 is 𝑁 (6, 32 ).
Suppose your friend transmits a value to you that you receive as 𝑥 = 5. Use the formulas
for normal-normal updating (given in the reading), to find the posterior pdf for 𝜃.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : For the normal-normal updating formulas given in the reading we have
2
𝑛 = 1 (number of data values) ,      𝑥 = 𝑥 = 5,    𝜇prior = 6,   𝜎prior = 9,    𝜎2 = 4
So, using the normal-normal update formulas:
1       1         𝑛    1                    𝑎𝜇prior + 𝑏𝑥  69         2         1   36
𝑎=    2
= ,   𝑏=     2
= ,      ⇒ 𝜇post =                 = ,        𝜎post =       = .
𝜎prior    9         𝜎    4                       𝑎+𝑏        13                  𝑎+𝑏  13
Thus, the posterior 𝑓(𝜃 | 𝑥) ∼ 𝑁 ( 69   36                  2
13 , 13 ) ≈ 𝑁 (5.31, 1.66 ).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 10,10,10 pts.) (Normal is the new normal)
Your friend transmits an unknown value 𝜃 to you over a noisy channel. The noise is
normally distributed with mean 0 and a known variance 4, so the value 𝑥 that you receive is
modeled by 𝑥 ∼ 𝑁 (𝜃, 22 ). Based on previous communications, your prior on 𝜃 is 𝑁 (6, 32 ).
IQ in the general population follows a 𝑁 (100, 152 ) distribution. An IQ test is unbiased
with a known normal variance of 102 ; that is, if the same person is tested multiple times,
their measured IQ will differ from their true IQ according to a normal distribution with
mean 0 and variance 100.
(i) Randall Vard scored an 80 on the test. What is the posterior expected value of their true
IQ?
(ii) Mary I. Taft scored a 150 on the test. What is the posterior expected value of their true
IQ?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : With no data we assume the prior mean for 𝜃 is the population average of 100,
i.e. our prior is 𝑓(𝜃) ∼ N(100, 152 ). For data 𝑥 = score on the IQ test we have the likelihood
𝑓(𝑥|𝜃) ∼ N(𝜃, 102 ). Using the update formulas we have
2
𝑛 = 1,    𝜇prior = 100,       𝜎prior = 152 ,   𝜎2 = 102 .
So 𝑎 = 1/225, 𝑏 = 1/100.
𝑎 ⋅ 100 + 𝑏 ⋅ 80
(i) Randall, 𝑥 = 80: 𝜇post =                  = 86.15. (This is the posterior expected value.)
𝑎+𝑏
𝑎 ⋅ 100 + 𝑏 ⋅ 150
(ii) Mary, 𝑥 = 150: 𝜇post =                   = 134.62 (This is the posterior expected value.)
𝑎+𝑏
Both their posterior expected values are closer to the population mean than their scores.
This is the Bayesian version of regression towards the mean!
18.05 Problem Set 7, Spring 2022 Solutions                                               11', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(15: 10,5 pts.) (Censored data)
Sometimes data is not reported in full. This can mean only reporting values in a certain
range or not reporting exact values. We call such data censored.
We have a 4-sided die and a 6-sided die. One of them is chosen at random and rolled 5
times. Instead of reporting the number of spots on a roll we censor the data and just report
1 if the roll is a 1;   0 if the roll is not a 1.
A censored value of 1 is evidence in favor of which die? What about 0? How is this
reflected in the posterior odds in part (a)?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : In part (a) we saw the Bayes factor when 𝑥 = 1 is 3/2. Since this is more than
1 it is evidence in favor of the 4-sided die. When 𝑥 = 0 the Bayes factor is 9/10, which is
evidence in favor of the 6-sided die.
We saw this in part (a) because after every value of 1 the odds for the 4-sided die went up
and after the value of 0 the odds went down.
18.05 Introduction to Probability and Statistics
Spring 2022
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(35: 5,5,5,5,5,5,5 pts.) (Confident coin: III)
When spun on edge 250 times a certain coin came up heads 140 times and tails 110. We
can make the statement: ‘if the coin is unbiased then the probability of getting a result at
least this extreme is 7%.’
Would you reject 𝐻0 at a significance level of 𝛼 = 0.1? What about 𝛼 = 0.05? (For
this problem assume the test has the same sidedness as the one used to get the 7% 𝑝-value
in part (a).)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : As instructed, we use a two-sided rejection region as in part (a). The exact
𝑝-value was 𝑝 = 0.066. Since 0.05 < 𝑝 < 0.1 we reject 𝐻0 at significance 𝛼 = 0.1 and don’t
reject at 𝛼 = 0.05.
1
18.05 Problem Set 8, Spring 2022 Solutions                                                  2
θ = 0.5
0.05
0.03
prob
0.01
−0.01
80   100      120       140        160       180
x
The figure shows the null distribution, the 𝛼 = 0.1 rejection region (blue-green) and the
𝛼 = 0.05 rejection region (orange). Notice that the data 𝑥 = 140 is in the 0.1 rejection
region but not the 0.05 rejection region.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(35: 5,5,5,5,5,5,5 pts.) (Confident coin: III)
When spun on edge 250 times a certain coin came up heads 140 times and tails 110. We
can make the statement: ‘if the coin is unbiased then the probability of getting a result at
least this extreme is 7%.’
(i) Fix the significance level at 𝛼 = 0.05. Compute and compare the power of the test
for values of the alternative hypothesis 𝜃 = 0.55 and 𝜃 = 0.6? (Again assume the same
sidedeness as in part (a). Here, 𝐻𝐴 is composite, so the power is different for different
values of the hypothesis.)
(ii) Sketch the pmf of each hypothesis and use it to explain the change in power observed in
part (i).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (i) Again we use a two-sided rejection region. For 𝛼 = 0.05 the rejection region
is given by the critical values
critical_value_left = qbinom(0.025,250,0.5) - 1 = 109
critical_value_right = qbinom(0.975,250,0.5) + 1 = 141
18.05 Problem Set 8, Spring 2022 Solutions                                               3
power when 𝜃 = 0.55 = 𝑃 (reject | 𝜃 = 0.55)
= 𝑃 (𝑥 ≤ 109 or 𝑥 ≥ 141 | 𝜃 = 0.55)
= sum(dbinom(0:109, 250, 0.55)) + sum(dbinom(141:250, 250,0.55)) = 0.35237
Likewise
power when 𝜃 = 0.6 = 𝑃 (reject | 𝜃 = 0.6)
= 𝑃 (𝑥 ≤ 109 or 𝑥 ≥ 141 | 𝜃 = 0.6)
= sum(dbinom(0:109, 250, 0.6)) + sum(dbinom(141:250, 250,0.6)) = 0.88963
Note: We could have used pbinom. Doing the sums with dbinom was an easy way of avoiding
off-by-one errors with pbinom.
(ii) The two plots below show the null distribution and the distribution of 𝐻𝐴 for 𝜃 = 0.55
and 𝜃 = 0.6 The blue line below the graphs shows the rejection region. The greater power
when 𝜃 = 0.6 is explained by its greater separation from 𝐻0 . Most of the probability of
𝑝(𝑥 | 𝜃 = 0.6) is over the right side of the rejection region.
θ = 0.55
0.05
0.03
prob
0.01
−0.01
80       100       120       140     160    180
x
Distributions of 𝐻0 and 𝐻𝐴 with 𝜃 = 0.55
θ = 0.6
0.05
0.03
prob
0.01
−0.01
80       100       120       140     160    180
x
Distributions of 𝐻0 and 𝐻𝐴 with 𝜃 = 0.6
18.05 Problem Set 8, Spring 2022 Solutions                                                 4', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(35: 5,5,5,5,5,5,5 pts.) (Confident coin: III)
When spun on edge 250 times a certain coin came up heads 140 times and tails 110. We
can make the statement: ‘if the coin is unbiased then the probability of getting a result at
least this extreme is 7%.’
Let 𝐻𝐴 ∶ 𝜃 = 0.55. Suppose we have only two hypotheses 𝐻0 and 𝐻𝐴 , and a flat prior
𝑃 (𝐻0 ) = 𝑃 (𝐻𝐴 ) = 0.5. What is the posterior probability of 𝐻𝐴 given the data? (In this
part 𝐻𝐴 is different from in the previous parts; it consists of one specific value of 𝜃.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We use the usual Bayesian update table.
18.05 Problem Set 8, Spring 2022 Solutions                                                      5
Hypothesis     prior   likelihood                   posterior
𝜃 = 0.5        1/2     𝑐1 (0.5)250                  𝑐2 (0.5)250 = 0.14757
𝜃 = 0.55       1/2     𝑐1 (0.55)140 (0.45)110       𝑐2 (0.55)140 (0.45)110 = 0.85243
1
The normalizing factor 𝑐2 =                                       .
(0.5)250 + (0.55)140 (0.45)110
The posterior probability that 𝜃 = 0.55 is 0.85.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(15: 10,5 pts.) Polygraph analogy.
In an experiment on the accuracy of polygraph tests, 140 people were instructed to tell the
truth and 140 people were instructed to lie. Testers used a polygraph to guess whether or
not each person was lying. By analogy, let’s say 𝐻0 corresponds to the testee telling the
truth and 𝐻𝐴 corresponds to the testee lying.
In NHST, what relationships exist between the terms significance level, power, type I
error, and type II error?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Significance = 𝑃 (type I error) = 𝑃 (reject 𝐻0 | 𝐻0 ).
Power = 1 - 𝑃 (type II error) = 𝑃 (reject 𝐻0 | 𝐻𝐴 ).
18.05 Problem Set 8, Spring 2022 Solutions                                                    6', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 10,10,5 pts.) z-test
Suppose three radar guns are set up along a stretch of road to catch people driving over the
speed limit of 40 miles per hour. Each radar gun is known to have a normal measurement
error modeled on 𝑁 (0, 52 ). For a passing car, let 𝑥̄ be the average of the three readings.
Our default assumption for a car is that it is not speeding.
The police would like to set a threshold on 𝑥̄ for issuing tickets so that no more than 4%
of law abiding, non-speeders are mistakenly given tickets. You should assume this means
that they set the threshold conservatively, so that no more 4% of drivers going exactly 40
mph get a ticket.
(i) Use the NHST description in part (a) to help determine what threshold should they set.
(ii) Sketch a graph illustrating your reasoning in part (i).
(iii) What is the probability that a person getting a ticket was not speeding?
(iv) Suppose word gets out about the speed trap and no one speeds along it anymore. What
percentage of tickets are given in error?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (i) Giving a ticket to a non-speeder is a type I error (rejecting 𝐻0 when it is
true). 𝐻0 is composite, but we can do all our computations with the most extreme value
𝜇 = 40 because the one-sided rejection region will have its largest significance level when
𝜇 = 40.
So the null distribution is 𝑥̄ ∼ N(40, 52 /3). The critical value is
𝑐0.04 = qnorm(0.96,40,5/sqrt(3)) = 45.054
(Equivalently 𝑐0.04 = 40 + 𝑧0.04 √53 = 45.054.)
That is, they should issue a ticket if the average of the three guns is more than 45.054.
(ii) Here is a plot of the null distribution N(40, 52 /3). The rejection region with probability
of 0.04 is shown.
18.05 Problem Set 8, Spring 2022 Solutions                                                   7
Null distribution for x_bar
0.16
0.14
0.12
0.1
0.08
0.06
0.04
0.02
0
30         35          40          45          50
(iii) (See (iv).) We don’t know this probability. To find it out would require a prior
probability that a random driver is speeding.
(iv) If no one is speeding then 100% of tickets are given in error.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(10: 5,5 pts.) One generates a number 𝑥 from a uniform distribution on the
interval [0, 𝜃]. One decides to test 𝐻0 ∶ 𝜃 = 2 against 𝐻𝐴 ∶ 𝜃 ≠ 2 by rejecting 𝐻0 if 𝑥 ≤ 0.1
or 𝑥 ≥ 1.9.
Compute the probability of a type I error.
0.2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑃 (type I) = 𝑃 (reject 𝐻0 | 𝐻0 ) = 𝑃 (𝑥 ≤ 0.1 or 𝑥 ≥ 1.9 | 𝜃 = 2) =       = 0.1.
2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(15: 10,5 pts.)
We perform a 𝑡-test for the null hypothesis 𝐻0 ∶ 𝜇 = 10 at significance level 𝛼 = 0.05 by
means of a dataset consisting of 𝑛 = 16 elements with sample mean 11 and sample variance
4.
Should we reject the null hypothesis in favor of 𝐻𝐴 ∶ 𝜇 ≠ 10?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is a two-sided alternative. The 𝑡-statistic is
𝑥̄ − 𝜇  1
√ =     = 2.
𝑠/ 𝑛   2/4
Since we have 𝑛 = 16 our 𝑡 statistic has 15 degrees of freedom.
We have the two-sided 𝑝-value
𝑝 = 𝑃 (|𝑡| > 2|𝐻0 ) = 2*(1-pt(2,15)) = 0.063945.
Since 𝑝 > 𝛼 = 0.05 we don’t reject the null hypothesis.
Alternatively we could have done the problem in terms of rejection regions. We are given
𝑥̄ = 11, 𝑠2 = 4, and 𝑛 = 16. The null hypothesis is 𝜇 = 10. Using 𝑥̄ as our test statistic the
rejection region is
𝑠                     𝑠
(−∞, 10 − 𝑡15,0.025 √ ] ∪ [10 + 𝑡15,0.025 √ , ∞) = (−∞, 8.93] ∪ [11.07, ∞)
𝑛                     𝑛
Here 𝑡15,0.025 means a critical value, i.e. the value with right tail probability 0.025: for
𝑇 ∼ 𝑡(15) we have 𝑃 (𝑡 > 𝑡15,0.025 ) = 0.025.
Since 11 lies outside the rejection region, we should not reject the null-hypothesis.
′', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 10,10 pts.) (Two-sample F test for equal variances)
In this problem, we want you to become comfortable using the web to learn about new
18.05 Problem Set 9, Spring 2022 Solutions                                                   6
tests and R commands. There are dozens of statistical software packages used by labs and
industry, so being able to learn new commands is probably more important than trying to
memorize them all. Look at the help file in R for var.test
We used R to secretly create a vector 𝑥 of 20 random samples from an N(0, 1) distribution
and a vector 𝑦 of 20 random samples from a N(10, 1) distribution. These are listed below.
With a tiny bit of editing you should be able to copy and paste these into R.
-0.802, 0.457, 0.972, 0.044, 0.318, -1.380, 0.111,
-0.023, -0.700, -1.977, -0.497, 1.471, -1.314, -0.078,
-0.505, 0.583, 1.363, -1.863, -2.105, 0.488
9.019, 9.852, 7.947, 9.465, 10.060, 10.508, 9.506,
9.540, 10.218, 9.407, 11.455, 11.422, 7.698, 9.972,
10.928, 11.577, 10.376, 8.605, 9.347, 10.715
Temporarily erase from your mind the variances used in generating the data. We want
to test the null hypothesis that the normal distributions which generated 𝑥 and 𝑦 have equal
variances. Now use var.test to find the 𝑝-value for the test for equal variances. (You may
need to go back and look at the documentation for var.test to see how to do this.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We let 𝑥 = the first set of 20 numbers and 𝑦 the second. R makes it almost too
easy. We give the command
var.test(x,y).
R then prints out
F test to compare two variances
data: x and y
F = 0.97034, num df = 19, denom df = 19, p-value = 0.9484
alternative hypothesis: true ratio of variances is not equal to 1
95 percent confidence interval:
0.3840737 2.4515249
sample estimates:
ratio of variances
0.9703434
So, the 𝑝-value is 0.9484 with 𝐹 -statistic 0.9703. With this 𝑝-value we do not reject the null
hypothesis that the variances are the same.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(15: 10,5 pts.) Z
Suppose we have 𝑛 data points drawn from a N(𝜃, 92 ) distribution, where the value of the
mean 𝜃 is unknown.
Suppose that 𝑛 = 30 and that the sample mean is 𝑥 = 15. Give the 95% confidence
interval for the mean 𝜃. Also give the 70% confidence interval.
In this problem you should use R to give precise confidence intervals. That is, you should
find the critical values to several decimal points of accuracy.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have 𝜎 = 9, 𝑛 = 30, 𝑥 = 15. The 𝑧-confidence interval for the mean is
√
𝑥 ± 𝑧𝛼/2 𝜎/ 𝑛.
So, using R, (𝑧𝛼/2 = pnorm(1 − 𝛼/2)) the 95% (𝛼 = 0.05) confidence interval is
15 ± 3.220549 = [11.77945, 18.22055]
Likewise, the 70% (𝛼 = 0.3) confidence interval is
15 ± 1.703034 = [13.29697, 16.70303]', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(10 pts.) (Cholesterol)
In a study on cholesterol levels a sample of 12 men and women was chosen. The plasma
cholesterol levels (mmol/L) of the subjects were as follows:
6.0, 6.4, 7.0, 5.8, 6.0, 5.8, 5.9, 6.7, 6.1, 6.5, 6.3, 5.8.
Estimate the variance of the plasma cholesterol levels with a 95% confidence interval.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is similar to problem 3c. We assume the data is normally distributed with
unknown mean 𝜇 and variance 𝜎2 .
We have the number of data points 𝑛 = 12. We use the following R code:
data = c(6.0, 6.4, 7.0, 5.8, 6.0, 5.8, 5.9, 6.7, 6.1, 6.5, 6.3, 5.8)
∑(𝑥𝑖 − 𝑥)̄2
s2 = var(data) # sample variance = 𝑠2 =
𝑛−1
n = length(data)
conf = 0.95
alpha = 1-conf
df = n - 1 # degrees of freedom
c_alpha_2 = qchisq(1-alpha/2, df) # critical value
c_1_minus_alpha_2 = qchisq(alpha/2, df) # critical value
CI = c((n-1)*s2/c_alpha_2, (n-1)*s2/c_1_minus_alpha_2)
cat(\'s2 =\', s2, \'\\n\')
cat(\'c_alpha_2 =\', c_alpha_2, \', c_1_minus_alpha_2 =\', c_1_minus_alpha_2, \'\\n\')
cat(conf, \'CI = [\', CI[1], \',\', CI[2], \']\',\'\\n\')
The code outputs:
s2 = 0.1535606
18.05 Problem Set 10, Spring 2022 Solutions                                                  3
c_alpha_2 = 21.92005 , c_1_minus_alpha_2 = 3.815748
0.95 CI = [ 0.07706035 , 0.4426829 ]
So the 95% confidence interval is
(𝑛 − 1) ⋅ 𝑠2 (𝑛 − 1) ⋅ 𝑠2
[               ,             ] ≈ [0.077, 0.443].
𝑐0.025       𝑐0.975
𝑠2 = 0.154 is our point estimate for 𝜎2 and the confidence interval is our range estimate
with 95% confidence.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(10 pts.) (Candy)
A candy manufacturer produces packs of candy targeted to weigh 52 grams. A quality control
manager was concerned that the variation in the actual weights was larger than acceptable.
That is, They were concerned that some packs weighed significantly less than 52-grams
and some weighed significantly more than 52 grams. In order to estimate 𝜎, the standard
deviation of the weights of the nominal 52-gram packs, they took a random sample of n = 10
packs off of the factory line. The random sample yielded a sample variance of 4.2 grams2 .
Use the random sample to derive a 95% confidence interval for 𝜎. Note: the interval is
for 𝜎 not 𝜎2 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have 𝑛 = 10 and 𝑠2 = 4.2. Assuming that the weights are normally dis-
2
tributed with variance 𝜎2 , we know that (𝑛−1)𝑠
𝜎2    ∼ 𝜒29 . We have
𝑐0.025 = qchisq(0.975, 9) = 19.023
𝑐0.975 = qchisq(0.025, 9) = 2.7004
The 95% confidence interval for 𝜎 is given by
𝑠2 (𝑛 − 1)    𝑠2 (𝑛 − 1)
[√               ,√            ] ≈ [1.4096, 3.7414]
𝑐0.975        𝑐0.025', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 10,5,5 pts.) (Height)
Suppose 𝜇 is the average height of a college male. You measure the heights (in inches) of
twenty college men, getting data 𝑥1 , … , 𝑥20 , with sample mean 𝑥 = 69.55 in. and sample
variance 𝑠2 = 14.26 in2 . Suppose that the 𝑥𝑖 are drawn from a normal distribution with
unknown mean 𝜇 and unknown variance 𝜎2 .
Using 𝑥 and 𝑠2 , construct a 90% 𝑡–confidence interval for 𝜇.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have 𝑛 = 20 and 𝛼 = 0.1 so
𝑡𝛼/2 = qt(0.05,19) = 1.7291.
Thus the 90% 𝑡-confidence interval is given by
𝑠              𝑠
[𝑥 − 𝑡𝛼/2 ⋅ √ , 𝑥 + 𝑡𝛼/2 ⋅ √ ] ≈ [68.09, 71.01]
𝑛              𝑛', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 10,5,5 pts.) (Height)
Suppose 𝜇 is the average height of a college male. You measure the heights (in inches) of
twenty college men, getting data 𝑥1 , … , 𝑥20 , with sample mean 𝑥 = 69.55 in. and sample
variance 𝑠2 = 14.26 in2 . Suppose that the 𝑥𝑖 are drawn from a normal distribution with
unknown mean 𝜇 and unknown variance 𝜎2 .
In (b), how many people in total would you need to measure to bring the width of the
90% z–confidence interval down to 1 inch?
√', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We need 𝑛 such that 2 ⋅ 𝑧0.05 ⋅ 𝜎/ 𝑛 = 1. So
𝑛 = (2 ⋅ 𝑧0.05 ⋅ 𝜎)2 = (2 ⋅ 1.6448 ⋅ 3.77)2 ≈ 153.8.
Since you need a whole number of people the answer is 𝑛 = 154 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(35: 15,10,10 pts.) Various variances
Consider a sample of size 𝑛 drawn from a Bernoulli(𝜃) distribution. (That is, a draw from a
binomial(𝑛, 𝜃) distribution.) In constructing a confidence interval the conservative estimate
is that the variance of the underlying Bernoulli distribution is 𝜎2 = 1/4 –this is conservative
because for any 𝜃 we know that 𝜎2 ≤ 1/4.
In this problem we want to compare how well normal distribution using the conservative
estimate matches the one using the true variance
(i) Let 𝜃 = 0.5 and 𝑛 = 250. Make a plot that includes
• the pmf 𝑝(𝑥|𝜃) of the binomial(𝑛, 𝜃) distribution.
• the pdf of the normal distribution with the same mean and variance as the binomial((𝑛, 𝜃))
distribution
• the normal distribution with the same mean (as the binomial distribution) and conservative
variance to your plot.
Note: The conservative variance for a Bernoulli(𝜃) distribution is 1/4. So the conservative
variance for a binomial(𝑛, 𝜃) is 𝑛/4.
Note. It is not reasonable to compare the probabilities in a pmf to the densities in a pdf.
In order to make them comparable, but also to make the graphs readable, you should plot
the pmf as points, but think of them as the top of a density histogram with bin width 1 and
breaks on the half integers.
(ii) Make a similar plot for 𝜃 = 0.3 and 𝑛 = 250.
(iii) Make a similar plot for 𝜃 = 0.1 and 𝑛 = 250.
18.05 Problem Set 11, Spring 2022 Solutions                                                                                                                                                                                                                                                                                                                                                                                                                                                                3
In each case, how close are each of the normal distributions to the binomial distribution?
How do the two normal distributions differ? Based on your plots, for what range of 𝜃 do you
think the conservative normal distribution is a reasonable approximation for binomial(𝑛, 𝜃)
with large 𝑛?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have 𝑥 ∼ binomial(𝑛, 𝜃), so 𝐸[𝑋] = 𝑛𝜃 and Var(𝑋) = 𝑛𝜃(1 − 𝜃). The
conservative variance is just 𝑛4 . So the distributions being plotted are
binomial(250, 𝜃),                                                                                                                                                   N(250𝜃, 250𝜃(1 − 𝜃)),                                                                                                N(250𝜃, 250/4).
Note, the whole range is from 0 to 250, but we only plotted the parts where the graphs
were not essentially 0.
θ = 0.5                                                                                                                                                                                                                                                                                                             θ = 0.3
0.05
●●●                                                                                                                                                                                                                                                                                             ●●●
●         ●                                                                                                                                                                                                                                                                                     ●
0.05
●                 ●
True variance                                                                                                                                                                                                                 ●
●
True variance
●
●                         ●
Conservative variance                                                                                                                                                                                                                                                                           Conservative variance
●
●                       Binomial pmf                                                                                                                                                                                                                                        ●                       ●                   Binomial pmf
0.04
●                                 ●
●
●
0.04
●                                         ●
●
●
●                                                 ●
0.03
●
●
●                                                         ●
0.03
●
●
●                                                                 ●
●
●                                                                         ●                                                                                                                                                                                                                                                                                           ●
0.02
0.02
●
●                                                                                 ●                                                                                                                                                                                                                                                                                           ●
●                                                                                         ●                                                                                                                                                                                                         ●                                                                                 ●
●                                                                                                 ●                                                                                                                                                                                                 ●                                                                                         ●
0.01
0.01
●                                                                                                         ●                                                                                                                                                                                                                                                                                           ●
●
●                                                                                                                 ●                                                                                                                                                                                                                                                                                           ●
●
●                                                                                                                         ●                                                                                                                                                                                                                                                                                           ●
●
●                                                                                                                                 ●                                                                                                                                                                                                                                                                                           ●
●
●                                                                                                                                         ●                                                                                                                                                                                                                                                                                           ●
●                                                                                                                                                 ●                                                                                                                                                     ●
●
0.00
0.00
●                                                                                                                                                         ●                                                                                                                                             ●                                                                                                                                             ●
●   ●●                                                                                                                                                                 ●●
● ●●                                                                                                                   ●     ●
●                                                                                                                                                     ●●
●● ●                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ●●●●
●●●●●●●●●●●●●●●●●●●                                                                                                                                                                                           ●●●● ●●●●●●●●●●●●●●●●                                                                            ●●●●●●●●●●●●●●                                                                                                                                                                             ●●●●●●●●●●●●●●●●●●●●
80               100                                                                120                                                                       140                                                           160                                                                              40                                 60                                                                        80                                                                       100                    120
x                                                                                                                                                                                                                                                                                                          x
θ = 0.1
0.08
● ●
●
●                                             True variance
●                               Conservative variance
●                                     ●           Binomial pmf
●
0.06
●
●
●
●
0.04
●
●
●
●
0.02
●                                                             ●
●
●
●
●
●
●                                                                                          ●
0.00
●                                                                                                   ●
●                                                                                                           ● ●
● ● ● ● ● ● ● ● ● ● ● ●                                                                                                                                                                     ● ● ● ● ● ● ● ● ● ● ● ● ● ● ●
0                                                     10                                                20                                    30                                      40                   50
x
We notice that for each 𝜃 the blue dots lie very close to the green (true variance) curve. So
the N(𝑛𝜃, 𝑛𝜃(1 − 𝜃)) distribution is quite close to the binomial(𝑛, 𝜃) distribution for each
of the values of 𝜃 considered. In fact, this is true for all 𝜃 by the Central Limit Theorem.
For 𝜃 = 0.5 the conservative variance is the exact variance. For 𝜃 = 0.3 the conservative
variance works well: it has smaller peak and slightly fatter tail. For 𝜃 = 0.1 the conservative
approximation breaks down and is not very good.
18.05 Problem Set 11, Spring 2022 Solutions                                                  4
In summary we can say two things about the conservative variance:
1. It gives good results for 𝜃 near 0.5 and breaks down for extreme values of 𝜃.
2. Since the conservative variance overestimates the variance (the conservative graphs are
shorter and wider) it gives us a confidence interval that is larger than is strictly necessary.
That is a nominal 95% conservative interval actually has a greater than 95% confidence
level.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(35: 15,10,10 pts.) Various variances
Consider a sample of size 𝑛 drawn from a Bernoulli(𝜃) distribution. (That is, a draw from a
binomial(𝑛, 𝜃) distribution.) In constructing a confidence interval the conservative estimate
is that the variance of the underlying Bernoulli distribution is 𝜎2 = 1/4 –this is conservative
because for any 𝜃 we know that 𝜎2 ≤ 1/4.
Using the same data as in part (b), find an 80% posterior probability interval for 𝜃
using a flat prior, i.e. Beta(1, 1). Center your interval between the 0.1 and 0.9 quantiles.
Compare this with the 80% confidence interval in part (b).
Hint: Use qbeta(p, a, b) to do the computation.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : With prior Beta(1, 1), if we observe 𝑥 successes in 250 trials, then the posterior
is Beta(1 + 𝑥, 1 + 250 − 𝑥). In our case 𝑥 = 140. So, using R we get the 80% posterior
probability interval:
prob_interval = [qbeta(0.1, 141, 111), qbeta(0.9, 141, 111)] ≈ [0.52, 0.60]
This is quite close to the 80% confidence interval. Though the two intervals have very
different technical meanings, we see that they are consistent (and numerically close). Both
give a type of estimate of 𝜃.
18.05 Introduction to Probability and Statistics
Spring 2022
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(15 pts: 10,5)
You create passwords as a string of 10 characters such that:
• 5 of the characters are letters (upper and lower case, i.e. 52 characters) with repetitions
allowed,
• 3 are numbers { 0,1,2,3,4,5,6,7,8,9 } with repetitions allowed, and
• 2 are distinct symbols from the list of 5 symbols: { !, @, #, $, & }.
How many passwords are there? (No need to simplify your answer.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : First, choose the locations of the symbols (10
2 ).
Then choose the symbols, since they have to be different and order matters, we get 5 ⋅ 4.
Then, choose the locations of the letters: (85).
Then count the number of ways to choose 5 letters (with replacement) 525 .
Then choose the locations of the numbers: (33) = 1.
Finally choose the numbers: 103 .
So, the number of passwords (10      8           3    5
2 ) ⋅ (5) ⋅ 20 ⋅ 10 ⋅ 52 .
1
18.05 Exam 1 Solutions                                                                     2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25 pts: 10,5,5,5)
You have 5 four-sided and 3 six-sided dice. You put them in a cup, choose one at random,
roll the die, and report the result.
Let 𝐷 be the number of sides on the chosen die and let 𝑅 be the result of the roll.
Make a joint probability table for 𝐷 and 𝑅. Be sure to include the marginal probabilities
for 𝐷 and 𝑅.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Each element of the table is simply the probability of getting a die with the
indicated number of sides and then rolling the indicated number. For example,
1 3     1
𝑃 (𝑅 = 3 and 𝐷 = 6) = 𝑃 (𝑅 = 3|𝐷 = 6)𝑃 (𝐷 = 6) = ⋅ =            .
6 8     16
𝑅\\𝐷      4-sided     6-sided
1        5/32        1/16           7/32
2        5/32        1/16           7/32
3        5/32        1/16           7/32
4        5/32        1/16           7/32
5        0           1/16           1/16
6        0           1/16           1/16
5/8         3/8', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25 pts: 10,5,5,5)
You have 5 four-sided and 3 six-sided dice. You put them in a cup, choose one at random,
roll the die, and report the result.
Let 𝐷 be the number of sides on the chosen die and let 𝑅 be the result of the roll.
Compute 𝑃 (𝐷 = 4|𝑅 = 3).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We compute this as the fraction
𝑃 (𝐷 = 4 and 𝑅 = 3)   5/32
=      = 5/7.
𝑃 (𝑅 = 3)        7/32
18.05 Exam 1 Solutions                                                                       3', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25 pts: 5,5,5,5,5)
Two students, Xeno and Yolanda are meeting up for lunch. They plan on a time to meet
at noon. Both have class before so neither will be early. Both have class that starts at 1pm,
so they will both arrive between 0 and 1 hour late. Let 𝑋 be the time in hours that Xeno
arrives late and let 𝑌 be the time in hours that Yolanda arrives late.
Assume that the joint pdf of these random variables is 𝑓(𝑥, 𝑦) = 5/4 − 𝑥𝑦.
Find the two marginal pdfs.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : To find the marginals we ‘integrate out’ the other variable.
1                       1
𝑓𝑋 (𝑥) = ∫ 𝑓(𝑥, 𝑦) 𝑑𝑦 = ∫ 5/4 − 𝑥𝑦 𝑑𝑦 = 5/4 − 𝑥/2.
0                       0
1                       1
𝑓𝑌 (𝑦) = ∫ 𝑓(𝑥, 𝑦) 𝑑𝑥 = ∫ 5/4 − 𝑥𝑦 𝑑𝑥 = 5/4 − 𝑦/2.
0                       0
We could have used symmetry to deduce 𝑓𝑌 (𝑦) without any integration.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25 pts: 5,5,5,5,5)
Two students, Xeno and Yolanda are meeting up for lunch. They plan on a time to meet
at noon. Both have class before so neither will be early. Both have class that starts at 1pm,
so they will both arrive between 0 and 1 hour late. Let 𝑋 be the time in hours that Xeno
arrives late and let 𝑌 be the time in hours that Yolanda arrives late.
Assume that the joint pdf of these random variables is 𝑓(𝑥, 𝑦) = 5/4 − 𝑥𝑦.
Find 𝐸[𝑋], Var(𝑋). (For these, you need to simplify the fractions.)
18.05 Exam 1 Solutions                                                                                   4', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We compute both 𝐸[𝑋] and Var(𝑋) = 𝐸[𝑋 2 ] − 𝐸[𝑋]2 using the marginal pdf
𝑓𝑋 (𝑋) found in part (a).
1                    1
5 1  11
𝐸[𝑋] = ∫ 𝑥𝑓𝑋 (𝑥) 𝑑𝑥 = ∫ 5𝑥/4 − 𝑥2 /2 𝑑𝑥 =                              − =    .
0                    0                                   8 6  24
1                        1
5  1 7
𝐸[𝑋 2 ] = ∫ 𝑥2 𝑓𝑋 (𝑥) 𝑑𝑥 = ∫ 5𝑥2 /4 − 𝑥3 /2 𝑑𝑥 =                           − = .
0                        0                                12 8  24
7  112  47
Var(𝑋) = 𝐸[𝑋 2 ] − 𝐸[𝑋]2 =             − 2 =     .
24 24   242', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25 pts: 5,5,5,5,5)
Two students, Xeno and Yolanda are meeting up for lunch. They plan on a time to meet
at noon. Both have class before so neither will be early. Both have class that starts at 1pm,
so they will both arrive between 0 and 1 hour late. Let 𝑋 be the time in hours that Xeno
arrives late and let 𝑌 be the time in hours that Yolanda arrives late.
Assume that the joint pdf of these random variables is 𝑓(𝑥, 𝑦) = 5/4 − 𝑥𝑦.
Set up, but do not compute an expression computing the probability that Xeno and
Yolanda arrive within 6 minutes (0.1 hours) of each other and that Yolanda arrives after
Xeno.
Your integral will be over a region 𝑅 in the unit square. You can leave your integral in the
form ∬ ℎ(𝑥, 𝑦) 𝑑𝑥 𝑑𝑦 and show 𝑅 in a figure elsewhere on the page. The function ℎ(𝑥, 𝑦)
𝑅
must be specified completely.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The integral is ∬ 𝑓(𝑥, 𝑦) 𝑑𝑥 𝑑𝑦 = ∬ 5/4 − 𝑥𝑦 𝑑𝑥 𝑑𝑦.
𝑅                                𝑅
The region 𝑅 is the part of the unit square where 𝑋 < 𝑌 and 𝑌 − 𝑋 < 0.1. This is the
strip of the triangle shown in the picture
𝑦 𝑅 (𝑋 < 𝑌 < 𝑋 + 0.1)
1
𝑥
1
18.05 Exam 1 Solutions                                                                          5
This was not asked for, but using 18.02 we get
0.9       𝑥+0.1                    1      1
𝑃 (𝑋 < 𝑌 < 𝑋 + 0.1) = ∫               ∫           5/4 − 𝑥𝑦 𝑑𝑦 𝑑𝑥 + ∫ ∫ 5/4 − 𝑥𝑦 𝑑𝑦 𝑑𝑥
0         𝑥                           0.9 𝑥', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
The are ( ) = 45 equally likely ways to place the two I’s.
2
There are 9 ways to place them next to each other, i.e. in slots 1 and 2, slots 2 and 3, …,
slots 9 and 10.
So the probability the I’s are adjacent is 9/45 = 0.2.
3    Conditional Probability and Bayes’ Theorem Problems', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (a) Create an arrangement in stages and count the number of possibilities at
each stage:
10
Stage 1: Choose three of the 10 slots to put the S’s: ( )
3
7
Stage 2: Choose three of the remaining 7 slots to put the T’s: ( )
3
4
Stage 3: Choose two of the remaining 4 slots to put the I’s: ( )
2
2
Stage 4: Choose one of the remaining 2 slots to put the A: ( )
1
1
Stage 5: Use the last slot for the C: ( )
1
Number of arrangements:
10 7 4 2 1
(    )( )( )( )( ) = 50400.
3   3 2 1 1
1
10', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Corrupted by their power, the judges running the popular game show America’s
Next Top Mathematician have been taking bribes from many of the contestants. Each
episode, a given contestant is either allowed to stay on the show or is kicked off.
If the contestant has been bribing the judges they will be allowed to stay with probability 1.
If the contestant has not been bribing the judges, they will be allowed to stay with probability
1/3.
Suppose that 1/4 of the contestants have been bribing the judges. The same contestants
bribe the judges in both rounds, i.e., if a contestant bribes them in the first round, they bribe
them in the second round too (and vice versa).
If you pick a random contestant, what is the probability that they are allowed to stay
during both of the first two episodes?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Using the tree we have the total probability of 𝑆2 is
1 3 1 1  1
𝑃 (𝑆2 ) =    + ⋅ ⋅ =
4 4 3 3  3
𝑃 (𝐿2 ∩ 𝑆1 )', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
The random variable 𝑋 takes values -1, 0, 1 with probabilities 1/8, 2/8, 5/8
respectively.
Compute 𝐸[𝑋].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have
𝑋 values:        -1    0     1
prob:          1/8   2/8   5/8
𝑋2              1    0     1
So, 𝐸[𝑋] = −1/8 + 5/8 = 1/2.
𝑌 values:    0       1', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
The random variable 𝑋 takes values -1, 0, 1 with probabilities 1/8, 2/8, 5/8
respectively.
Instead, compute 𝐸[𝑋 2 ] directly from an extended table.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The change of variables formula just says to use the bottom row of the table
in part (a): 𝐸[𝑋 2 ] = 1 ⋅ (1/8) + 0 ⋅ (2/8) + 1 ⋅ (5/8) = 3/4 (same as part (b)).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose 100 people all toss a hat into a box and then proceed to randomly
pick out of a hat. What is the expected number of people to get their own hat back.
Hint: express the number of people who get their own hat as a sum of random variables
whose expected value is easy to compute.


6   Probability Mass Functions, Probability Density Functions
    and Cumulative Distribution Functions Problems', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑋 be the number of people who get their own hat.
Following the hint: let 𝑋𝑗 represent whether person 𝑗 gets their own hat. That is, 𝑋𝑗 = 1
if person 𝑗 gets their hat and 0 if not.
100                 100
We have, 𝑋 = ∑ 𝑋𝑗 , so 𝐸[𝑋] = ∑ 𝐸[𝑋𝑗 ].
𝑗=1                 𝑗=1
Since person 𝑗 is equally likely to get any hat, we have 𝑃 (𝑋𝑗 = 1) = 1/100. Thus, 𝑋𝑗 ∼
Bernoulli(1/100) ⇒ 𝐸[𝑋𝑗 ] = 1/100 ⇒ 𝐸[𝑋] = 1.
6   Probability Mass Functions, Probability Density Functions
and Cumulative Distribution Functions Problems', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
If 𝑌 = 𝑋 2 , compute the pdf and cdf of 𝑌 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : √               √
𝐹𝑌 (𝑦) = 𝑃 (𝑌 ≤ 𝑦) = 𝑃 (𝑋 2 ≤ 𝑦) = 𝑃 (𝑋 ≤            𝑦) = 1 − e−𝜆 𝑦 .
Differentiating 𝐹𝑌 (𝑦) with respect to 𝑦, we have
𝜆 − 1 −𝜆√𝑦
𝑓𝑌 (𝑦) =     𝑦 2e     .
2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose you roll a fair 6-sided die 100 times (independently), and you get $3
every time you roll a 6.
Let 𝑋1 be the number of dollars you win on rolls 1 through 25.
Let 𝑋2 be the number of dollars you win on rolls 26 through 50.
Let 𝑋3 be the number of dollars you win on rolls 51 through 75.
Let 𝑋4 be the number of dollars you win on rolls 76 throught 100.
Let 𝑋 = 𝑋1 + 𝑋2 + 𝑋3 + 𝑋4 be the total number of dollars you win over all 100 rolls.
What is the expectation and variance of 𝑋?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐸[𝑋] = 𝐸[3𝑇 ] = 3𝐸[𝑇 ] = 3 ⋅ 100 ⋅ 16 = 50,
Var(𝑋) = Var(3𝑇 ) = 9Var(𝑇 ) = 9 ⋅ 100 ⋅ 16 ⋅ 56 = 125.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Covariance and Independence
Let 𝑋 be a random variable that takes values -2, -1, 0, 1, 2; each with probability 1/5.          Let
𝑌 = 𝑋2.
Find 𝐸[𝑋] and 𝐸[𝑌 ].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Using the marginal distributions:                 𝐸[𝑋] = 15 (−2 − 1 + 0 + 1 + 2) = 0.
1      2     2
𝐸[𝑌 ] = 0 ⋅ + 1 ⋅ + 4 ⋅ = 2.
5      5     5', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Covariance and Independence
Let 𝑋 be a random variable that takes values -2, -1, 0, 1, 2; each with probability 1/5.          Let
𝑌 = 𝑋2.
Show Cov(𝑋, 𝑌 ) = 0.
This is an example of uncorrelated but non-independent random variables. The reason this
can happen is that correlation only measures the linear dependence between the two variables.
In this case, 𝑋 and 𝑌 are not at all linearly related.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Using the table from part (a) and the means computed in part (d) we get:
Cov(𝑋, 𝑌 ) = 𝐸[𝑋𝑌 ] − 𝐸[𝑋]𝐸[𝑌 ]
1          1       1        1        1
= (−2)(4) + (−1)(1) + (0)(0) + (1)(1) + (2)(4)
5          5       5        5        5
= 0.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Continuous Joint Distributions
Suppose 𝑋 and 𝑌 are continuous random variables with joint density function 𝑓(𝑥, 𝑦) =
𝑐(𝑥 + 2𝑦) on the rectangle [0, 1] × [0, 2].
When doing this problem in class: Only compute the integrals in parts (a) and (b). For the
1       2
others, just give the integrals in a form like ∫ ∫ 𝑥𝑓(𝑥, 𝑦) 𝑑𝑦 𝑑𝑥, but don’t compute them.
0       0
Let 𝐹 (𝑥, 𝑦) be the joint CDF. Compute 𝐹 (𝑥, 𝑦). Compute 𝐹 (1, 2).
𝑎       𝑏                      𝑎    𝑏
1', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐹 (𝑎, 𝑏) = 𝑃 (𝑋 ≤ 𝑎, 𝑌 ≤ 𝑏) = ∫ ∫ 𝑓(𝑥, 𝑦) 𝑑𝑥 𝑑𝑦 = ∫ ∫ (𝑥 + 2𝑦) 𝑑𝑦 𝑑𝑥.
0 0                5 0 0
1           𝑏  1
Inner integral:     [𝑥𝑦 + 𝑦2 ]0 = (𝑥𝑏 + 𝑏2 ).
5              5
𝑎
1 𝑏𝑥2          1 𝑎2 𝑏
Outer integral:    [    + 𝑏2 𝑥] = (     + 𝑎𝑏2 ) .
5 2          0
5  2
1 𝑥2 𝑦
So, changing back to 𝑥, 𝑦: 𝐹 (𝑥, 𝑦) =               (    + 𝑥𝑦2 )              and   𝐹 (1, 2) = 1.
5   2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Continuous Joint Distributions
Suppose 𝑋 and 𝑌 are continuous random variables with joint density function 𝑓(𝑥, 𝑦) =
𝑐(𝑥 + 2𝑦) on the rectangle [0, 1] × [0, 2].
When doing this problem in class: Only compute the integrals in parts (a) and (b). For the
1       2
others, just give the integrals in a form like ∫ ∫ 𝑥𝑓(𝑥, 𝑦) 𝑑𝑦 𝑑𝑥, but don’t compute them.
0       0
Are 𝑋 and 𝑌 independent?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : To see if they are independent we check if the joint density is the product of the
marginal densities.
1
𝑓(𝑥, 𝑦) = 𝑥 + 𝑦, 𝑓𝑋 (𝑥) ⋅ 𝑓𝑌 (𝑦) =                       (2𝑥 + 4)(1/2 + 2𝑦).
25
Since these are not equal, 𝑋 and 𝑌 are not independent.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose 𝑋1 , … , 𝑋100 are i.i.d. with mean 1/5 and variance 1/9. Use the
central limit theorem to estimate 𝑃 (∑ 𝑋𝑖 < 30).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Standardize:
∑ 𝑋𝑖 − 𝜇  30 − 𝑛𝜇
𝑃 (∑ 𝑋𝑖 < 30) = 𝑃 (             √       < √      )
𝑖
𝑛𝜎        𝑛𝜎
30 − 20
≈ 𝑃 (𝑍 <          ) (by the central limit theorem)
10/3
= 𝑃 (𝑍 < 3)
= 0.9987 (from the table of normal probabilities)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Compute the expectation and variance of a Bernoulli(𝑝) random variable.




18.05 Introduction to Probability and Statistics
Spring 2022


For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Make a table:
𝑋:        0     1
prob:   (1-p)   p
𝑋2       0     1.
From the table, 𝐸[𝑋] = 0 ⋅ (1 − 𝑝) + 1 ⋅ 𝑝 = 𝑝.
Since 𝑋 and 𝑋 2 have the same table 𝐸[𝑋 2 ] = 𝐸[𝑋] = 𝑝.
Therefore, Var(𝑋) = 𝑝 − 𝑝2 = 𝑝(1 − 𝑝).
18.05 Introduction to Probability and Statistics
Spring 2022
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Discrete prior-discrete likelihood.
Jon has 1 four-sided, 2 six-sided, 2 eight-sided, 2 twelve sided, and 1 twenty-sided dice. He
picks one at random and rolls a 7.
For each type of die, find the posterior probability Jon chose that type.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Make a table. (The last column is included for part (d).)
Hypothesis    Prior    Likelihood       Bayes numerator         posterior        likelihood
𝜃        𝑃 (𝜃)   𝜙(𝑥1 = 7 | 𝜃)                           𝑓(𝜃 | 𝑥1 = 7)    𝑃 (𝑥2 = 8 | 𝜃)
4-sided      1/8          0                  0                    0                 0
6-sided      1/4          0                  0                    0                 0
8-sided      1/4         1/8               1/32            1/32𝑇 ≈ 0.536           1/8
12-sided      1/4        1/12               1/48            1/48𝑇 ≈ 0.357          1/12
20-sided      1/8        1/20             1/160            1/160𝑇 ≈ 0.107          1/20
1      1    1
Total         1                     𝑇 = 32  + 48 + 160            1
The posterior probabilities are given in the 5th column of the table. The total probability
7
𝑇 = 120 is also the answer to part (c).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Discrete prior-discrete likelihood.
Jon has 1 four-sided, 2 six-sided, 2 eight-sided, 2 twelve sided, and 1 twenty-sided dice. He
picks one at random and rolls a 7.
Compute the posterior predictive probability of rolling an 8 on the second roll.
1', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : See the last two columns in the table. 𝑃 (𝑥2 = 8 | 𝑥1 = 7) = 32𝑇 ⋅ 18 + 48𝑇
1     1
⋅ 12 +
1   1    49
⋅
160𝑇 20 = 480 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Reject or fail to reject 𝐻0 .

Make sure you can use the probability tables.


2.5.2 NHST: One-sample 𝑡-test

   • Data: we assume normal data with both 𝜇 and 𝜎 unknown:

                                          𝑥1 , 𝑥2 , … , 𝑥𝑛 ∼ 𝑁 (𝜇, 𝜎2 ).

   • Null hypothesis: 𝜇 = 𝜇0 for some specific value 𝜇0 .

   • Test statistic:
                                                        𝑥 − 𝜇0
                                                   𝑡=      √
                                                        𝑠/ 𝑛
      where
                                                         𝑛
                                                    1
                                           𝑠2 =         ∑(𝑥𝑖 − 𝑥)2 .
                                                  𝑛 − 1 𝑖=1

   • Null distribution: 𝑡(𝑛 − 1), Student 𝑡 with 𝑛 − 1 degs of freedom.

   • Student 𝑡 is symmetric around 0, like standard normal.


2.5.3 Two-sample 𝑡-test: equal variances

Data: we assume normal data with 𝜇𝑥 , 𝜇𝑦 and (same) 𝜎 unknown:

                          𝑥1 , … , 𝑥𝑛 ∼ N(𝜇𝑥 , 𝜎2 ),    𝑦1 , … , 𝑦𝑚 ∼ N(𝜇𝑦 , 𝜎2 )

Null hypothesis 𝐻0 :      𝜇𝑥 = 𝜇𝑦 .
                            (𝑛 − 1)𝑠2𝑥 + (𝑚 − 1)𝑠2𝑦 1 1
Pooled variance:       𝑠2𝑝 =                       ( + ).
                                  𝑛+𝑚−2             𝑛 𝑚
                      𝑥̄ − 𝑦̄
Test statistic:    𝑡=
                         𝑠𝑝
Null distribution: 𝜙(𝑡 | 𝐻0 ) is drawn from ∼ 𝑡(𝑛 + 𝑚 − 2).
                                                         𝑥 − 𝑦 ̄ − 𝜇0
(More generally we can test 𝐻0 : 𝜇𝑥 − 𝜇𝑦 = Δ𝜇 using 𝑡 =               )
                                                             𝑠𝑝

2.5.4 𝐹 -test = one-way ANOVA

Like 𝑡-test but for 𝑛 groups of data with 𝑚 data points each.

                         𝑦𝑖,𝑗 ∼ 𝑁 (𝜇𝑖 , 𝜎2 ),     𝑦𝑖,𝑗 = 𝑗th point in ith group

Assumptions: data for each group is an independent normal sample with (possibly) different
means but the same variance.
Null hypothesis is: the means are all equal: 𝜇1 = ⋯ = 𝜇𝑛
                  MS𝐵
Test statistic is MS  where:
                     𝑊


                                           𝑚
MS𝐵 = between group variance =                ∑(𝑦𝑖̄ − 𝑦)̄2
                                          𝑛−1


MS𝑊 = within group variance = sample mean of 𝑠21 , … , 𝑠2𝑛
Idea: If 𝜇𝑖 are equal, this ratio should be near 1.

Null distribution is F-statistic with 𝑛 − 1 and 𝑛(𝑚 − 1) d.o.f.:

                                    MS𝐵
                                        ∼ 𝐹𝑛−1, 𝑛(𝑚−1) .
                                    MS𝑊

2.5.5 NHST: some key points', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Prior, 𝑓(𝜃) ∼ N(100, 152 ), 𝑥 ∼ N(𝜃, 102 ).
2
So we have, 𝜇prior = 100, 𝜎prior = 152 , 𝜎2 = 102 , 𝑛 = 1, 𝑥 = 𝑥 = 120.
Applying the normal-normal update formulas: 𝑎 = 1512 , 𝑏 = 1012 . This gives
2       2
𝜇post = 100/15  +120/10
1/152 +1/102
2
= 113.8, 𝜎post         1
= 1/152 +1/102 = 69.2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
𝑧 and one-sample 𝑡-test. For both problems use significance level 𝛼 = 0.05.
Assume the data 2, 4, 4, 10 are independent draws from a 𝑁 (𝜇, 𝜎2 ) distribution.
Take 𝐻0 : 𝜇 = 0;              𝐻𝐴 : 𝜇 ≠ 0.
2
Now assume 𝜎2 is unknown and test 𝐻0 against 𝐻𝐴 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have 𝑥̄ = 5,        𝑠2 = 9+1+1+25
3    = 12
𝑥−𝜇
̄√
We’ll use 𝑡 = 𝑠/   𝑛
for the test statistic. The null distribution for 𝑡 is 𝑡3 . For the data we
√
have 𝑡 = 5/ 3. This is a two-sided test so the 𝑝-value is
√
𝑝 = 𝑃 (|𝑡| ≥ 5/ 3|𝐻0 ) = 2 ∗ pt(−5/sqrt(3), 3) ≈ 0.06318
Since 𝑝 > 𝛼 we do not reject 𝐻0 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Two-sample 𝑡-test Suppose that we have data from 1408 women admitted to a maternity
hospital for (i) medical reasons or through (ii) unbooked emergency admission. The duration
of pregnancy is measured in complete weeks from the beginning of the last menstrual period.
What assumptions did you make?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We assumed the data was normal and that the two groups had equal variances.
Given the big difference in the sample variances this assumption might not be warranted.
Note: there are significance tests to see if the data is normal and to see if the two groups
have the same variance.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Three treatments for a disease are compared in a clinical trial, yielding the
following data:
                               Treatment 1    Treatment 2      Treatment 3
                  Cured             50             30               12
                  Not cured        100             80               18
Use a chi-square test to compare the cure rates for the three treatments', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The null hypothesis 𝐻0 is: all three treatments have the same cure rate.
Under 𝐻0 the MLE for the cure rate is:       (total cured)/(total treated) = 92/290 = 0.317.
Given 𝐻0 we get the following table of observed and expected counts. We include the fixed
values in the margins
Treatment 1    Treatment 2    Treatment 3
Cured           50, 47.6       30, 34.9        12, 9.5       92
Not cured      100, 102.4      80, 75.1       18, 20.5      198
150            110             30
(𝑂𝑖 − 𝐸𝑖 )2
Pearson’s chi-square statistic:    𝑋2 = ∑                = 2.13.
𝐸𝑖
Likelihood ratio statistic:   𝐺 = 2 ∑ 𝑂𝑖 ln(𝑂𝑖 /𝐸𝑖 ) = 2.12.
To compute the expected counts, we need all the marginal counts. If we made up data that
had these same marginal counts we could put values in 2 of the cells freely and then all
the others are determined. Thus, degrees of freedom = 2. Using R we compute the 𝑝-value
using the 𝜒2 distribution with 2 degrees of freedom.
p = 1 - pchisq(2.12, 2) = 0.346
(We used the 𝐺 statistic, but we would get essentially the same answer using 𝑋 2 .)
For the exam you would have to use the 𝜒2 table to estimate the 𝑝-value. In the 𝑑𝑓 = 2
row of the table 2.12 is between the critical values for 𝑝 = 0.3 and 𝑝 = 0.5.
The problem did not specifiy a significance level, but a 𝑝-value of 0.35 does not support
rejecting 𝐻0 at any common level. We do not conclude that the treatments have differing
eﬀicacy.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(15: 5,5,5)
You roll a fair six-sided die 8 times.
What is the probability that exactly one of the 8 rolls is a six?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is a binomial probability
8     1     5 7 8 ⋅ 57
( ) ⋅ ( ) ⋅ ( ) = 8 ≈ 2/5
1     6     6     6', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(16: 4,4,4,4)
Suppose 𝑋 is a random variable with values in [1,2] and density
𝑘𝑥2    for 1 ≤ 𝑥 ≤ 2
𝑓(𝑥) = {
0     otherwise
where 𝑘 is a fixed constant.
What is 𝑘?
2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ∫1 𝑥2 𝑑𝑥 = 𝑥3 /3]21 = 8/3 − 1/3 = 7/3. So 𝑘 = 3/7 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(16: 4,4,4,4)
Suppose 𝑋 is a random variable with values in [1,2] and density
𝑘𝑥2    for 1 ≤ 𝑥 ≤ 2
𝑓(𝑥) = {
0     otherwise
where 𝑘 is a fixed constant.
Find 𝐸[𝑋]
2
2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐸[𝑋] = ∫ 𝑥 ⋅ (3𝑥2 /7) 𝑑𝑥 = 3𝑥4 /28]1 = (3 ⋅ 16 − 3 ⋅ 1)/28 = 45/28 .
1', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 5,5,5,5,5)
Suppose random variables 𝑋 and 𝑌 have units of dollars and:
𝐸[𝑋] = 5,       Var(𝑋) = 62 ,     and       𝐸[𝑌 ] = 10,   Var(𝑌 ) = 72 .
Define 𝑊 = 𝑋 + 𝑌 .
18.05 Final Exam Spring 2022 Solutions                                                      6
Assume 𝑋 and 𝑌 are independent. Find Var(𝑊 ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The magic formula is Var(𝑋 + 𝑌 ) = Var(𝑋) + Var(𝑌 ) + 2Cov(𝑋, 𝑌 ). Indepen-
dence implies that the covariance is zero, so
Var(𝑊 ) = Var(𝑋) + Var(𝑌 ) = 62 + 72 = 36 + 49 = 85 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 5,5,5,5,5)
Suppose random variables 𝑋 and 𝑌 have units of dollars and:
𝐸[𝑋] = 5,       Var(𝑋) = 62 ,     and       𝐸[𝑌 ] = 10,   Var(𝑌 ) = 72 .
Define 𝑊 = 𝑋 + 𝑌 .
18.05 Final Exam Spring 2022 Solutions                                                      6
Assume Cov(𝑋, 𝑌 ) = 21. Compute Cor(𝑋, 𝑌 ). What are the units of Cor(𝑋, 𝑌 )?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The correlation is by definition Cor(𝑋, 𝑌 ) = Cov(𝑋, 𝑌 )/√Var(𝑋)Var(𝑌 ). The
numerator has units ($)2 . What’s under the square root has units ($)4 , so the denominator
has units ($)2 , and the correlation is dimensionless . The value is
√
Cor(𝑋, 𝑌 ) = Cov(𝑋, 𝑌 )/√Var(𝑋)Var(𝑌 ) = 21/ 62 ⋅ 72 = 21/(6 ⋅ 7) = 1/2 .
(𝑋 − 𝐸[𝑋])', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 10,5,5)
You roll two fair (6-sided) dice. If the sum of the dice is greater than 9, you win $100. If
the sum is 9 or less you get to roll again. On the second roll, if your sum of dice is greater
than 9, you win $50, otherwise you win nothing. Let 𝑋 be the random variable of how much
money you win by playing this game.
Construct a probability model for 𝑋, i.e. make a probability table.
18.05 Final Exam Spring 2022 Solutions                                                             7', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : sum of dice   2        3      4      5       6        7           8      9      10      11     12
probability   1/36     2/36   3/36   4/36    5/36     6/36        5/36   4/36   3/36    2/36   1/36
So the probability of rolling less than or equal to 9 is 30/36 = 5/6, and the probability
of 10 or more is 6/36 = 1/6. The probabilities for various outcomes of the game can be
computed from the following tree.
1/6           5/6
win $100         replay
1/6            5/6
win $50             0
The table of probabilities and outcomes is
outcome      $100    $50      0
prob.        1/6     5/36     25/36', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 10,5,5)
You roll two fair (6-sided) dice. If the sum of the dice is greater than 9, you win $100. If
the sum is 9 or less you get to roll again. On the second roll, if your sum of dice is greater
than 9, you win $50, otherwise you win nothing. Let 𝑋 be the random variable of how much
money you win by playing this game.
What would you be willing to pay to play this game? (Justify your answer).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If you pay less than $23.61 , you’ll make money in the long run. But you
need a big stake to be able to be sure you can keep playing long enough if to win: since you
get nothing two-thirds of the time, you have a one in ten chance of winning nothing in ten
games, for instance; so you clearly need to have a stake (much) more than ten times the
price to be even 90% sure of winning.
So I don’t think I’d pay much more than $10 a game .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(15: 5,10)
A certain medical condition exists in 1% of the population. A screening test for the condition
has a 4% false positive rate and a 0% false negative rate.
What are the odds that a random person has the condition?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let’s let 𝐷+ = having the condition; 𝐷− = not having it; 𝑇 + = testing positive.
𝑃 (𝐷+)    1/100    1
The odds of having the condition are             =        =    .
𝑃 (𝐷−)   99/100   99', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 5,10,5,10 )
This question is about a robot, Bayz-E, who tries to figure out where it is located using
Bayesian updating. Bayz-E is randomly placed in front of one of four doors, A, B, C, or D.
At every time step, Bayz-E scans the color of the door in front of it. The outcome will be
either orange of blue. However, its color scanner is not entirely accurate. Bayz-E scans the
door’s color correctly with a probability 0.7, and scans the color incorrectly with a probability
0.3.
Note. To avoid confusion for you, the color of the door is written above its letter. (Bayz-E
has not yet learned to read, though its machine learning algorithm is working on it.)
18.05 Final Exam Spring 2022 Solutions                                                       9
orange         orange       blue          blue
A            B            C             D
Bayz-E is placed in front of door A, B, C, or D at random (i.e. the probability of each
door is the same). What is the prior probability it is in front of door B?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : There are four hypotheses, labeled A, B, C, D according to the door in front of
which Bayz-E starts. Each of the four is equally likely, so the prior for 𝐵 (or for any other
door) is 1/4 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 5,10,5,10 )
This question is about a robot, Bayz-E, who tries to figure out where it is located using
Bayesian updating. Bayz-E is randomly placed in front of one of four doors, A, B, C, or D.
At every time step, Bayz-E scans the color of the door in front of it. The outcome will be
either orange of blue. However, its color scanner is not entirely accurate. Bayz-E scans the
door’s color correctly with a probability 0.7, and scans the color incorrectly with a probability
0.3.
Note. To avoid confusion for you, the color of the door is written above its letter. (Bayz-E
has not yet learned to read, though its machine learning algorithm is working on it.)
18.05 Final Exam Spring 2022 Solutions                                                       9
orange         orange       blue          blue
A            B            C             D
After computing the posterior probabilities, Bayz-E moves to the next door to the right.
(if it was at door D, it moves to door A). What is the (new) prior probability it is now in
front of door C? (That is, after detecting orange in part (b) and after moving one to door
to the right.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : To keep things straight, we start a new table for the door Bayz-E is currently in
front of, i.e. after moving. The priors are found by rotating the posteriors from the table
in part (b), e.g. the part (b) posterior probability for 𝐴 becomes the prior probability for
𝐵 etc.
hypothesis                 prior                likelihood BN 2 posterior 2
A (orange) 3/20 –part (b) posterior for D
B (orange) 7/20 –part (b) posterior for A
C (blue)       7/20 –part (b) posterior for B
D (blue)       3/20 –part (b) posterior for C
sum                          1
𝑃 (now in front of 𝐶 | orange on first scan) = 7/20 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 5,10,5)
Jerry wants to brag to his non-MIT colleagues about how smart MIT students are. To
give himself credibility, he decides to run a statistical test comparing the IQ scores of MIT
students and Harvard students.
He collects IQ scores from 11 MIT students. The data has a sample mean of 115, with a
sample standard deviation of 8.
He then collects IQ scores from 11 Harvard students. Their scores have a sample mean of
110, with a sample standard deviation of 6.
Which test should he run to compare the IQ scores from the two schools?              What
assumptions will he need to make? What are the null and alternative hypotheses?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We can run a two-sample 𝑡 test for comparing means. This test assumes that the
two sets of data are drawn from normal distributions (a reasonable assumption for
the results of IQ tests, which are designed that way) with equal variances (a reasonable
assumption since the sample standard deviations are not far apart). The null hypothesis
is means are equal . The alternative hypothesis is means are unequal . (Can also
argue that 𝐻𝐴 should be one-sided.)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 5,10,5)
Jerry wants to brag to his non-MIT colleagues about how smart MIT students are. To
give himself credibility, he decides to run a statistical test comparing the IQ scores of MIT
students and Harvard students.
He collects IQ scores from 11 MIT students. The data has a sample mean of 115, with a
sample standard deviation of 8.
He then collects IQ scores from 11 Harvard students. Their scores have a sample mean of
110, with a sample standard deviation of 6.
Estimate the 95% confidence interval for the IQ of MIT students.
(Your answer should be a numerical expression. There is no need to work it out all the way
to a decimal answer.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The 95% confidence intervals is
𝑠                8
𝑥 ± 𝑡0.025 ⋅ √ = 115 ± 2.23 ⋅ √ .
𝑛               11
Here 𝑡0.025 is the right 𝑡-critical value with 10 degrees of freedom.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 10,10)
MIT has decided to form a new Department of Statistics and Probability. In a vote for
the new head of this department, suppose 50% of the MIT population supports Sarah, 20%
18.05 Final Exam Spring 2022 Solutions                                                     12
supports So Hee, and the remaining 30% is split evenly among Jerry, Jen, Alessandre and
Gabe.
A poll of 𝑛 people reports that 53% ± 5% support Sarah at the 95% confidence level.
What is the value of 𝑛?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The rule of thumb for 95% polling confidence intercals tells us that
1  √
0.05 = √ ⇒ 𝑛 = 20 ⇒ 𝑛 = 400.
𝑛
If we use the more precise critical 𝑧 of 1.96 (for 95%) instead of the 2 in the rule of thumb,
we get 𝑛 = 385 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 5,10,5)
Bivariate data (4, 1), (−2, 1.5), (0, 0.5) is assumed to arise from the model 𝑦𝑖 = 𝑏|𝑥𝑖 − 2| + 𝑒𝑖 ,
where 𝑏 is a constant and 𝑒𝑖 are independent random variables.
What assumptions are needed on 𝑒𝑖 so that it makes sense to do a least squares fit of a
curve 𝑦 = 𝑏|𝑥 − 2| to the data?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We need to know that the error terms 𝑒𝑖 have mean 0. It is good for them to
be independent and to have the same variance (homoscedastic). It is wonderful if they are
independent identically distributed normal of mean zero.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 5,10,5)
Bivariate data (4, 1), (−2, 1.5), (0, 0.5) is assumed to arise from the model 𝑦𝑖 = 𝑏|𝑥𝑖 − 2| + 𝑒𝑖 ,
where 𝑏 is a constant and 𝑒𝑖 are independent random variables.
Make a graph showing the data points and your least squares fit curve.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 18.05 Final Exam Spring 2022 Solutions                                                                14
2.5
2.0
1.5
y
1.0
0.5
0.0
−4     −2    0       2    4      6
x', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Basketball
Suppose that against a certain opponent the number of points the MIT basketball team scores
is normally distributed with unknown mean 𝜃 and unknown variance, 𝜎2 .
Suppose that over the course of the last 10 games between the two teams MIT scored the
following points:
59, 62, 59, 74, 70, 61, 62, 66, 62, 75
Now suppose that you learn that 𝜎2 = 25. Compute a 95% 𝑧–confidence interval for 𝜃.
How does this compare to the interval in (a)?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We can look in the 𝑧-table or simply remember that 𝑧0.025 = 1.96. The 95%
confidence interval is
𝑧0.025 𝜎  𝑧      𝜎     1.96 ⋅ 5       1.96 ⋅ 5
[𝑥̄ −     √ , 𝑥̄ + 0.025
√ ] = [65 − √       , 65 + √       ] = [61.901, 68.099]
𝑛         𝑛           10             10
This is a narrower interval than in part (a). There are two reasons for this, first the true
variance 25 is smaller than the sample variance 35.8 and second, the normal distribution
has narrower tails than the 𝑡 distribution.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Basketball
Suppose that against a certain opponent the number of points the MIT basketball team scores
is normally distributed with unknown mean 𝜃 and unknown variance, 𝜎2 .
Suppose that over the course of the last 10 games between the two teams MIT scored the
following points:
59, 62, 59, 74, 70, 61, 62, 66, 62, 75
Which of the three intervals constructed above do you prefer? Why?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : There’s no one correct answer; each method has its own advantages and disad-
vantages. In this problem they all give similar answers.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Polling confidence intervals
You do a poll to see what fraction 𝑝 of the population supports candidate A over candidate
B.
How many people do you need to poll to know 𝑝 to within 1% with 95% confidence.
√', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The rule-of-thumb is that a 95% confidence interval is 𝑥̄ ± 1/ 𝑛. To be within
1% we need
1
√ = 0.01 ⇒ 𝑛 = 10000.
𝑛
Using 𝑧0.025 = 1.96 instead the 95% confidence interval is
𝑧0.025
𝑥̄ ±     √ .
2 𝑛
To be within 1% we need
𝑧0.025
√ = 0.01 ⇒ 𝑛 = 9604.
2 𝑛
Note, we are still using the standard Bernoulli approximation 𝜎 ≤ 1/2.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Confidence intervals 3
Suppose you made 40 confidence intervals with confidence level 95%. About how many of
them would you expect to be “wrong’? That is, how many would not actually contain the
parameter being estimated? Should you be surprised if 10 of them are wrong?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : A 95% confidence means about 5% = 1/20 will be wrong. You’d expect about
2 to be wrong.
With a probability 𝑝 = 0.05 of being wrong, the number wrong follows a Binomial(40, 𝑝)
distribution. This has expected value 2, and standard deviation √40(0.05)(0.95) = 1.38. 10
wrong is (10-2)/1.38 = 5.8 standard deviations from the mean. This would be surprising.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Linear regression (least squares)
Set up fitting the least squares line through the points (1, 1), (2, 1), and (3, 3).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The model is 𝑦𝑖 = 𝑎 + 𝑏𝑥𝑖 + 𝜀𝑖 , where 𝜀𝑖 is random error. We assume the
errors are independent with mean 0 and the same variance for each 𝑖 (homoscedastic).
The total error squared is
𝐸 2 = ∑(𝑦𝑖 − 𝑎 − 𝑏𝑥𝑖 )2 = (1 − 𝑎 − 𝑏)2 + (1 − 𝑎 − 2𝑏)2 + (3 − 𝑎 − 3𝑏)2
The least squares fit is given by the values of 𝑎 and 𝑏 which minimize 𝐸 2 . We solve for
them by setting the partial derivatives of 𝐸 2 with respect to 𝑎 and 𝑏 to 0. In R we found
that 𝑎 = −1/3, 𝑏 = 1.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Empirical bootstrap
Suppose we had 100 data points 𝑥1 , … 𝑥100 with sample median 𝑞0.5̂ = 3.3.
3
Suppose now that the sorted list in the previous problem consists of 200 empirical
bootstrap medians computed from resamples of size 100 drawn from the original data. Use
the list to construct a 90% precentile CI for 𝑞0.5 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The list covers steps 1-3 in part (a). Since it is sorted, step 4 is straightforward.
∗
The 5th and 95th percentiles for 𝑞0.5 are
2.89,       3.72
(Here we just took the 10th and 190th values. We could have interpolated between the
9th and 10th, and 190th and 191st entries, but this would not change our answer to two
decimal places.)
The above interval is our empirical percentile bootstrap confidence interval for the median.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(NHST chi-square)
A study of recidivism (repeat offenses) of juvenile offenders used an experimental design with
random assignment of juveniles to experimental intervention (Family Group Counseling) or

                                               3
control group (diversion programs). 70 out of 200 people in the control group re-offended
and 30 out of 200 people in the experimental group re-offended.
Use a chi-square significance test to test whether the recidivism rates within 6 months for
the two experimental groups are significantly different at a significance level of 0.05.




                                            4




18.05 Introduction to Probability and Statistics
Spring 2022


For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We will use a chi-square test for homogeneity. Remember we need to use all the
data!. For hypotheses we have:
𝐻0 : the re-offense rate is the same for both groups.
𝐻𝐴 : the rates are different.
Here is the table of counts. The computation of the expected counts is explained below.
Control group           Experimental group
observed expected          observed expected
Re-offend            70         50              30         50     100
Don’t re-offend     130        150             170        150     300
200                        200                400
The expected counts are computed as follows. Under 𝐻0 the re-offense rates are the same,
say 𝜃. To find the expected counts we find the MLE of 𝜃 using the combined data:
total re-offend   100
𝜃̂ =                   =     .
total subjects    400
Then, for example, the expected number of re-offenders in the control group is 200 ⋅ 𝜃 ̂ = 50.
The other expected counts are computed in the same way.
The chi-square test statistic is
(observed - expected)2   202   202   202   202
𝑋2 = ∑                           =     +     +     +     ≈ 8 + 2.67 + 8 + 2.67 ≈ 21.33.
expected          50    150   50    150
Finally, we need the degrees of freedom: 𝑑𝑓 = 1 because this is a two-by-two table and
(2 − 1) ⋅ (2 − 1) = 1. (Or because we can freely fill in the count in one cell and still be
consistent with the marginal counts 200, 200, 100, 300, 400 used to compute the expected
counts.)
From the 𝜒2 table: 𝑝 = 𝑃 (𝑋 2 > 21.33|𝑑𝑓 = 1) < 0.01.
Conclusion: we reject 𝐻0 in favor of 𝐻𝐴 . The experimental intervention appears to be
effective.
6
18.05 Introduction to Probability and Statistics
Spring 2022
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
In a ballroom dancing class the students are divided into group 𝐴 and group
𝐵. There are six people in group 𝐴 and seven in group 𝐵. If four 𝐴s and four 𝐵s are chosen
and paired off, how many pairings are possible?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Build the pairings in stages and count the ways to build each stage:
6
Stage 1: Choose the 4 from group 𝐴: ( ).
4
7
Stage 2: Choose the 4 from group 𝐵: ( )
4
We need to be careful because we don’t want to build the same 4 couples in multiple ways.
Line up the 4 𝐴’s 𝐴1 , 𝐴2 , 𝐴3 , 𝐴4
Stage 3: Choose a partner from the 4 𝐵s for 𝐴1 : 4.
Stage 4: Choose a partner from the remaining 3 𝐵s for 𝐴2 : 3
Stage 5: Choose a partner from the remaining 2 𝐵s for 𝐴3 : 2
Stage 6: Pair the last 𝐵 with 𝐴4 : 1
6 7
Number of possible pairings: ( )( )4!.
4 4
Note: we could have done stages 3-6 in one go as: Stages 3-6: Arrange the 4 𝐵s opposite
the 4 𝐴s: 4! ways.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose that there are ten students in a classroom. What is the probability
that no two of them have a birthday in the same month?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We assume each month is equally likely to be a student’s birthday month.
Number of ways ten students can have birthdays in 10 different months:
12!
12 ⋅ 11 ⋅ 10 … ⋅ 3 =
2!
Number of ways 10 students can have birthday months: 1210 .
12!
Probability no two share a birthday month:         = 0.00387.
2! 1210', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝐶 and 𝐷 be two events with 𝑃 (𝐶) = 0.25, 𝑃 (𝐷) = 0.45, and 𝑃 (𝐶 ∩ 𝐷) =
0.1. What is 𝑃 (𝐶 𝑐 ∩ 𝐷)?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐷 is the disjoint union of 𝐷 ∩ 𝐶 and 𝐷 ∩ 𝐶 𝑐 .
𝐶          𝐷
So, 𝑃 (𝐷 ∩ 𝐶) + 𝑃 (𝐷 ∩ 𝐶 𝑐 ) = 𝑃 (𝐷)                                                       𝐷 ∩ 𝐶𝑐
⇒ 𝑃 (𝐷 ∩ 𝐶 𝑐 ) = 𝑃 (𝐷) − 𝑃 (𝐷 ∩ 𝐶) = 0.45 − 0.1 = 0.35.                                0.1 0.45−0.1
(We never use 𝑃 (𝐶) = 0.25.)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
You roll a four-sided die 3 times. For this problem we’ll use the sample
space with 64 equally likely outcomes.
(i) Here we’ll just list all 9 possibilities
{(4,4,1), (4,4,2), (4,4,3), (4,1,4), (4,2,4), (4,3,4), (1,4,4), (2,4,4), (3,4,4)}
(ii) This is the same as (i) with the addition of (4,4,4).
{ (4,4,1), (4,4,2), (4,4,3), (4,1,4), (4,2,4), (4,3,4), (1,4,4), (2,4,4), (3,4,4), (4,4,4)}
(iii) This is list is a little longer. If we’re systematic about it we can still just write it out.
{(1,4,1), (2,4,1), (3,4,1), (4,4,1),
(1,4,2), (2,4,2), (3,4,2), (4,4,2),
(1,4,3), (2,4,3), (3,4,3), (4,4,3),
(1,1,4), (2,1,4), (3,1,4), (4,1,4),
(1,2,4), (2,2,4), (3,2,4), (4,2,4),
(1,3,4), (2,3,4), (3,3,4), (4,3,4)}
(iv) {(4,4,1), (4,4,2), (4,4,3), (4,1,4), (4,2,4), (4,3,4)}', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (a) Writing all 64 possibilities is too tedius. Here’s a more compact representa-
tion
{(𝑖, 𝑗, 𝑘) | 𝑖, 𝑗, 𝑘 are integers from 1 to 4}', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose we have 8 teams labeled 𝑇1 , …, 𝑇8 . Suppose they are ordered by
placing their names in a hat and drawing the names out one at a time.
What is the probability of this happening?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : There are 8! ways to fill the 8 slots in any way.
4! ⋅ 4!    576
Since each outcome is equally likely the probabilitiy is            =       = 0.143 = 1.43%.
8!      40320
2   Conditional Probability and Bayes’ Theorem', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose you are taking a multiple-choice test with 𝑐 choices for each
question. In answering a question on this test, the probability that you know the answer is
𝑝. If you don’t know the answer, you choose one at random. What is the probability that
you knew the answer to a question, given that you answered it correctly?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The following tree shows the setting
𝑝      1−𝑝
Know                     Guess
1            0          1/𝑐           1 − 1/𝑐
Correct         Wrong     Correct         Wrong
Let 𝐶 be the event that you answer the question correctly. Let 𝐾 be the event that you
actually know the answer. The left circled node shows 𝑃 (𝐾 ∩ 𝐶) = 𝑝. Both circled nodes
together show 𝑃 (𝐶) = 𝑝 + (1 − 𝑝)/𝑐. So,
𝑃 (𝐾 ∩ 𝐶)         𝑝
𝑃 (𝐾|𝐶) =                 =
𝑃 (𝐶)    𝑝 + (1 − 𝑝)/𝑐
Or we could use the algebraic form of Bayes’ theorem and the law of total probability: Let
𝐺 stand for the event that you’re guessing. Then we have,
𝑃 (𝐶|𝐾) = 1, 𝑃 (𝐾) = 𝑝, 𝑃 (𝐶) = 𝑃 (𝐶|𝐾)𝑃 (𝐾) + 𝑃 (𝐶|𝐺)𝑃 (𝐺) = 𝑝 + (1 − 𝑝)/𝑐. So,
𝑃 (𝐶|𝐾)𝑃 (𝐾)         𝑝
𝑃 (𝐾|𝐶) =                   =
𝑃 (𝐶)      𝑝 + (1 − 𝑝)/𝑐', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Corrupted by their power, the judges running the popular game show Amer-
ica’s Next Top Mathematician have been taking bribes from many of the contestants. Each
episode, a given contestant is either allowed to stay on the show or is kicked off.
If the contestant has been bribing the judges they will be allowed to stay with probability 1.
If the contestant has not been bribing the judges, they will be allowed to stay with probability
1/3.
Suppose that 1/4 of the contestants have been bribing the judges. The same contestants
bribe the judges in both rounds, i.e., if a contestant bribes them in the first round, they bribe
them in the second round too (and vice versa).
If you pick a random contestant, what is the probability that they are allowed to stay
during both of the first two episodes?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Using the tree we have the total probability of 𝑆2 is
1 3 1 1  1
𝑃 (𝑆2 ) =     + ⋅ ⋅ =
4 4 3 3  3
𝑃 (𝐿2 ∩ 𝑆1 )', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Consider the Monty Hall problem. Let’s label the door with the car behind
it 𝑎 and the other two doors 𝑏 and 𝑐. In the game the contestant chooses a door and then
Monty chooses a door, so we can label each outcome as ‘contestant followed by Monty’, e.g
𝑎𝑏 means the contestant chose 𝑎 and Monty chose 𝑏.
Make a 3 × 3 probability table showing probabilities for all possible outcomes.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Make a 3 × 3 probability table showing probabilities for all possible outcomes.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Consider the Monty Hall problem. Let’s label the door with the car behind
it 𝑎 and the other two doors 𝑏 and 𝑐. In the game the contestant chooses a door and then
Monty chooses a door, so we can label each outcome as ‘contestant followed by Monty’, e.g
𝑎𝑏 means the contestant chose 𝑎 and Monty chose 𝑏.
Redo part (c) with the strategy of not switching.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (a) and (b) In the tree the first row is the contestant’s choice and the second
row is the host’s (Monty’s) choice.
Viewed as a table                                        Viewed as a tree
Contestant                                            1               1          1
a    b     c                                          3               3          3
a    0    0     0                          a                               b                          c
1       1
Host    b 1/6     0    1/3                     0   2       2               0       0 1                0       1 0
c 1/6 1/3       0                  a                   c       a                 c        a                 c
b                       b                          b', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Two dice are rolled.
𝐴 = ‘sum of two dice equals 3’
𝐵 = ‘sum of two dice equals 7’
𝐶 = ‘at least one of the dice shows a 1’
What is 𝑃 (𝐵|𝐶)?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑃 (𝐵|𝐶) =               =       = ..
𝑃 (𝐶)    11/36  11', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
A multiple choice exam has 4 choices for each question. A student has
studied enough so that the probability they will know the answer to a question is 0.5, the
probability that they will be able to eliminate one choice is 0.25, otherwise all 4 choices
seem equally plausible. If they know the answer they will get the question right. If not they
have to guess from the 3 or 4 choices.
As the teacher you want the test to measure what the student knows. If the student answers
a question correctly what’s the probability they knew the answer?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We show the probabilities in a tree:
1/2          1/4 1/4
Know                    Eliminate 1        Total guess
1          0               1/3       2/3      1/4       3/4
Correct      Wrong Correct               Wrong Correct      Wrong
For a given problem let 𝐶 be the event the student gets the problem correct and 𝐾 the
event the student knows the answer.
The question asks for 𝑃 (𝐾|𝐶).
We’ll compute this using Bayes’ rule:
𝑃 (𝐶|𝐾) 𝑃 (𝐾)         1 ⋅ 1/2       24
𝑃 (𝐾|𝐶) =                    =                   =    ≈ 0.774 = 77.4%
𝑃 (𝐶)       1/2 + 1/12 + 1/16   31', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Some games, like tennis or ping pong, reach a state called deuce. This
means that the score is tied and a player wins the game when they get two points ahead
of the other player. Suppose the probability that you win a point is 𝑝 and this is true
independently for all points. If the game is at deuce what is the probability you win the
game?
This is a tricky problem, but amusing if you like puzzles.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑊 be the event you win the game from deuce and 𝐿
Practice Exam 1: All Questions, Spring 2022                                                     11deuce
p             1-p
+1                                     −1
the event you lose. For convenience, define 𝑤 = 𝑃 (𝑊 ).
p        1-p                    p        1-p
The figure shows the complete game tree through 2 points. In the
third level we just abreviate by indicating the probability of winning              deuce                     deuce
𝑊                    w         w                𝐿
from deuce.
The nodes marked +1 and -1, indicate whether you won or lost the
first point.                                                                               𝑊              𝑊
Summing all the paths to 𝑊 we get
𝑝2
𝑤 = 𝑃 (𝑊 ) = 𝑝2 + 𝑝(1 − 𝑝)𝑤 + (1 − 𝑝)𝑝𝑤 = 𝑝2 + 2𝑝(1 − 𝑝)𝑤 ⇒ 𝑤 =                        .
1 − 2𝑝(1 − 𝑝)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose 𝐴 and 𝐵 are events with 0 < 𝑃 (𝐴) < 1 and 0 < 𝑃 (𝐵) < 1.
If 𝐴 and 𝐵 are disjoint can they be independent?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : No, they cannot be independent: 𝐴 ∩ 𝐵 = ∅ ⇒ 𝑃 (𝐴 ∩ 𝐵) = 0 ≠ 𝑃 (𝐴) ⋅ 𝑃 (𝐵).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose 𝐴 and 𝐵 are events with 0 < 𝑃 (𝐴) < 1 and 0 < 𝑃 (𝐵) < 1.
No, they cannot be independent: 𝐴 ⊂ 𝐵 ⇒ 𝐴 ∩ 𝐵 = 𝐴
⇒ 𝑃 (𝐴 ∩ 𝐵) = 𝑃 (𝐴) > 𝑃 (𝐴) ⋅ 𝑃 (𝐵). The last inequality follows because 𝑃 (𝐵) < 1.
4   Expectation and Variance', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The answer to all three parts is ‘No’. Each of these answers relies on the fact
that the probabilities of 𝐴 and 𝐵 are strictly between 0 and 1.
To show 𝐴 and 𝐵 are not independent we need to show either 𝑃 (𝐴 ∩ 𝐵) ≠ 𝑃 (𝐴) ⋅ 𝑃 (𝐵)
or 𝑃 (𝐴|𝐵) ≠ 𝑃 (𝐴).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
The random variable 𝑋 takes values -1, 0, 1 with probabilities 1/8, 2/8, 5/8
respectively.
Compute 𝐸[𝑋].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have
𝑋 values:    -1      0         1
prob:      1/8     2/8       5/8
𝑋2          1      0         1
So, 𝐸[𝑋] = −1/8 + 5/8 = 1/2.
𝑌 values:    0       1', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Compute the expectation and variance of a Bernoulli(𝑝) random variable.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Make a table:
𝑋:        0          1
prob:   (1-p)        p
𝑋2       0          1.
From the table, 𝐸[𝑋] = 0 ⋅ (1 − 𝑝) + 1 ⋅ 𝑝 = 𝑝.
Since 𝑋 and 𝑋 2 have the same table 𝐸[𝑋 2 ] = 𝐸[𝑋] = 𝑝.
Therefore, Var(𝑋) = 𝑝 − 𝑝2 = 𝑝(1 − 𝑝).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose you roll a fair 6-sided die 100 times (independently), and you get
$3 every time you roll a 6.
Let 𝑋1 be the number of dollars you win on rolls 1 through 25.
Let 𝑋2 be the number of dollars you win on rolls 26 through 50.
Let 𝑋3 be the number of dollars you win on rolls 51 through 75.
Let 𝑋4 be the number of dollars you win on rolls 76 throught 100.
Let 𝑋 = 𝑋1 + 𝑋2 + 𝑋3 + 𝑋4 be the total number of dollars you win over all 100 rolls.
What is the expectation and variance of 𝑋?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐸[𝑋] = 𝐸[3𝑇 ] = 3𝐸[𝑇 ] = 3 ⋅ 100 ⋅ 16 = 50,
Var(𝑋) = Var(3𝑇 ) = 9Var(𝑇 ) = 9 ⋅ 100 ⋅ 16 ⋅ 56 = 125.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose that 𝑋 ∼ Bin(𝑛, 0.5). Find the probability mass function of
𝑌 = 2𝑋.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : For 𝑦 = 0, 2, 4, … , 2𝑛,
𝑦      𝑛    1 𝑛
𝑃 (𝑌 = 𝑦) = 𝑃 (𝑋 =           )=(     )( ) .
2     𝑦/2   2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
If 𝑌 = 2𝑋 + 5, compute the pdf and cdf of 𝑌 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Since 𝑋 is between 0 and 1 we have 𝑌 is between 5 and 7. Now for 5 ≤ 𝑦 ≤ 7,
we have
𝑦−5          𝑦−5    𝑦−5
𝐹𝑌 (𝑦) = 𝑃 (𝑌 ≤ 𝑦) = 𝑃 (2𝑋 + 5 ≤ 𝑦) = 𝑃 (𝑋 ≤                    ) = 𝐹𝑋 (     )=     .
2            2      2
Differentiating 𝑃 (𝑌 ≤ 𝑦) with respect to 𝑦, we get the probability density function of 𝑌 ,
for 5 ≤ 𝑦 ≤ 7,
1
𝑓𝑌 (𝑦) = .
2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose that 𝑋 is a random variable that takes on values 0, 2 and 3 with
probabilities 0.3, 0.1, 0.6 respectively. Let 𝑌 = 3(𝑋 − 1)2 .
What is the expectation of 𝑋?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We first make the probability tables
𝑋       0     2          3
prob.   0.3   0.1        0.6
𝑌       3     3         12
So, 𝐸[𝑋] = 0 ⋅ 0.3 + 2 ⋅ 0.1 + 3 ⋅ 0.6 = 2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose that 𝑋 is a random variable that takes on values 0, 2 and 3 with
probabilities 0.3, 0.1, 0.6 respectively. Let 𝑌 = 3(𝑋 − 1)2 .
What is the expection of 𝑌 ?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐸[𝑌 ] = 3 ⋅ 0.3 + 3 ⋅ 0.1 + 12 ⋅ 6 = 8.4.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝑇 be the waiting time for customers in a queue. Suppose that 𝑇 is
exponential with pdf 𝑓(𝑡) = 2e−2𝑡 on [0, ∞).
Find the pdf of the rate at which customers are served 𝑅 = 1/𝑇 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The CDF for 𝑇 is
𝑡
𝑡
𝐹𝑇 (𝑡) = 𝑃 (𝑇 ≤ 𝑡) = ∫ 2e−2𝑢 𝑑𝑢 = −e−2𝑢 ∣0 = 1 − e−2𝑡 .
0
Next, we find the CDF of 𝑅. 𝑅 takes values in (0, ∞).
For 0 < 𝑟,
𝐹𝑅 (𝑟) = 𝑃 (𝑅 ≤ 𝑟) = 𝑃 (1/𝑇 < 𝑟) = 𝑃 (𝑇 > 1/𝑟) = 1 − 𝐹𝑇 (1/𝑟) = e−2/𝑟 .
𝑑 −2/𝑟     2
We differentiate to get 𝑓𝑅 (𝑟) =       (e  ) = 2 e−2/𝑟 .
𝑑𝑟        𝑟', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(PMF of a sum)
Suppose 𝑋 and 𝑌 are independent and 𝑋 ∼ Bernoulli(1/2) and 𝑌 ∼ Bernoulli(1/3). De-
termine the pmf of 𝑋 + 𝑌', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : First we’ll give the joint probability table:
𝑋
𝑌\\           0      1
0       1/3    1/3    2/3
1       1/6    1/6    1/3
1/2    1/2     1
We’ll use the joint probabilities to build the probability table for the sum.
𝑋+𝑌             0           1            2
(𝑋, 𝑌 )       (0,0)    (0,1), (1,0)    (1,1)
prob.         1/3      1/6 + 1/3       1/6
prob.         1/3         1/2          1/6', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝑋 be a discrete random variable with pmf 𝑝 given by:
𝑥    −2   −1    0    1   2
𝑝(𝑥) 1/15 2/15 3/15 4/15 5/15
Find the value the cdf of 𝑋 at -3/2, 3/4, 7/8, 1, 1.5, 5.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : and (c) To distinguish the distribution functions we’ll write 𝐹𝑋 and 𝐹𝑌 .
Using the tables in part (a) and the definition 𝐹𝑋 (𝑎) = 𝑃 (𝑋 ≤ 𝑎) etc. we get
𝑎     -3/2         3/4     7/8        1        1.5   5
𝐹𝑋 (𝑎)     1/15        6/15    6/15     10/15     10/15   1
𝐹𝑌 (𝑎)       0         3/15    3/15      9/15      9/15   1', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose that the cdf of 𝑋 is given by:

                                        ⎧ 0       for 𝑎 < 0
                                        {
                                        { 1       for 0 ≤ 𝑎 < 2
                                𝐹 (𝑎) = ⎨ 52
                                        {         for 2 ≤ 𝑎 < 4
                                        { 5
                                        ⎩ 1       for 𝑎 ≥ 4.
Determine the pmf of 𝑋.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The jumps in the distribution function are at 0, 2, 4. The value of 𝑝(𝑎) at a
jump is the height of the jump:
𝑎        0       2      4
𝑝(𝑎)       1/5     1/5    3/5', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝑋 be a random variable with range [0, 1] and cdf
𝐹 (𝑋) = 2𝑥2 − 𝑥4          for 0 ≤ 𝑥 ≤ 1.
𝑓(𝑥) = 𝐹 ′ (𝑥) = 4𝑥 − 4𝑥3 in [0,1].
6     Distributions with Names', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (a) 𝑃 (1/4 ≤ 𝑋 ≤ 3/4) = 𝐹 (3/4) − 𝐹 (1/4) = 11/16 = 0.6875.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Exponential Distribution
Suppose that buses arrive are scheduled to arrive at a bus stop at noon but are always 𝑋
minutes late, where 𝑋 is an exponential random variable with probability density function
𝑓𝑋 (𝑥) = 𝜆e−𝜆𝑥 . Suppose that you arrive at the bus stop precisely at noon.
Suppose that you have already waiting for 10 minutes. Compute the probability that you
have to wait an additional five minutes or more.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We want 𝑃 (𝑋 ≥ 15|𝑋 ≥ 10). First observe that 𝑃 (𝑋 ≥ 15, 𝑋 ≥ 10) = 𝑃 (𝑋 ≥
15). From similar computations in (a), we know
𝑃 (𝑋 ≥ 15) = e−15𝜆                    𝑃 (𝑋 ≥ 10) = e−10𝜆 .
From the definition of conditional probability,
𝑃 (𝑋 ≥ 15, 𝑋 ≥ 10)   𝑃 (𝑋 ≥ 15)
𝑃 (𝑋 ≥ 15|𝑋 ≥ 10) =                       =            = e−5𝜆
𝑃 (𝑋 ≥ 10)       𝑃 (𝑋 ≥ 10)
Note: This is an illustration of the memorylessness property of the exponential distribu-
tion.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Normal Distribution: Throughout these problems, let 𝜙 and Φ be the pdf
and cdf, respectively, of the standard normal distribution Suppose 𝑍 is a standard normal
random variable and let 𝑋 = 3𝑍 + 1.
Differentiate the expression from (𝑎) with respect to 𝑥 to get the pdf of 𝑋, 𝑓(𝑥).
Remember that Φ′ (𝑧) = 𝜙(𝑧) and don’t forget the chain rule', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Differentiating with respect to 𝑥, we have
d          1    𝑥−1
𝑓𝑋 (𝑥) =      𝐹𝑋 (𝑥) = 𝜙 (     ).
dx         3     3
1   𝑥2
Since 𝜙(𝑥) = (2𝜋)− 2 e− 2 , we conclude
1  (𝑥−1)2
𝑓𝑋 (𝑥) = √ e− 2⋅32 ,
3 2𝜋
which is the probability density function of the 𝑁 (1, 9) distribution. Note: The arguments
in (a) and (b) give a proof that 3𝑍 +1 is a normal random variable with mean 1 and variance
9. See Problem Set 3, Question 5.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Normal Distribution: Throughout these problems, let 𝜙 and Φ be the pdf
and cdf, respectively, of the standard normal distribution Suppose 𝑍 is a standard normal
random variable and let 𝑋 = 3𝑍 + 1.
Recall that the probability that 𝑍 is within one standard deviation of its mean is approx-
imately 68%. What is the probability that 𝑋 is within one standard deviation of its mean?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Since 𝐸[𝑋] = 1, Var(𝑋) = 9, we want 𝑃 (−2 ≤ 𝑋 ≤ 4). We have
𝑃 (−2 ≤ 𝑋 ≤ 4) = 𝑃 (−3 ≤ 3𝑍 ≤ 3) = 𝑃 (−1 ≤ 𝑍 ≤ 1) ≈ 0.68.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Transforming Normal Distributions
Suppose 𝑍 ∼ N(0,1) and 𝑌 = e𝑍 .
We don’t have a formula for Φ(𝑧) so we don’t have a formula for quantiles. So we have
to write quantiles in terms of Φ−1 .
(i) Write the 0.33 quantile of 𝑍 in terms of Φ−1
(ii) Write the 0.9 quantile of 𝑌 in terms of Φ−1 .
(iii) Find the median of 𝑌 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (i) The 0.33 quantile for 𝑍 is the value 𝑞0.33 such that 𝑃 (𝑍 ≤ 𝑞0.33 ) = 0.33.
That is, we want
Φ(𝑞0.33 ) = 0.33 ⇔ 𝑞0.33 = Φ−1 (0.33) .
(ii) We want to find 𝑞0.9 where
−1
𝐹𝑌 (𝑞0.9 ) = 0.9 ⇔ Φ(ln(𝑞0.9 )) = 0.9 ⇔ 𝑞0.9 = eΦ         (0.9)
.
−1
(iii) As in (ii) 𝑞0.5 = eΦ     (0.5)
= e0 = 1 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(Random variables derived from normal random variables)
Let 𝑋1 , 𝑋2 , …𝑋𝑛 be i.i.d. N(0, 1) random variables.
Let 𝑌𝑛 = 𝑋12 + … + 𝑋𝑛2 .
Set up an integral in 𝑥 for computing 𝐸[𝑋𝑗4 ].
For 3 extra credit points, use integration by parts show 𝐸[𝑋𝑗4 ] = 3.
(If you don’t do this, you can still use this result in part c.)
∞
1        2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐸[𝑋𝑗4 ] = √ ∫ 𝑥4 e−𝑥 /2 𝑑𝑥.
2𝜋 −∞
2                            2
(Extra credit) By parts: let 𝑢 = 𝑥3 , 𝑣′ = 𝑥e−𝑥 /2 ⇒ 𝑢′ = 3𝑥2 , 𝑣 = −e−𝑥 /2
∞
1       3 −𝑥2 /2
∞         1         2
𝐸[𝑋𝑗4 ] = √      [𝑥 e         ∣      + √ ∫ 3𝑥2 e−𝑥 /2 𝑑𝑥]
2𝜋                 𝑖𝑛𝑓𝑡𝑦    2𝜋 −∞
The first term is 0 and the second term is the formula for 3𝐸[𝑋𝑗2 ] = 3 (by part (a)). Thus,
𝐸[𝑋𝑗4 ] = 3.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(Random variables derived from normal random variables)
Let 𝑋1 , 𝑋2 , …𝑋𝑛 be i.i.d. N(0, 1) random variables.
Let 𝑌𝑛 = 𝑋12 + … + 𝑋𝑛2 .
Use the Central Limit Theorem to approximate 𝑃 (𝑌100 > 110).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐸[𝑌100 ] = 𝐸[100𝑋𝑗2 ] = 100.      Var(𝑌100 ) = 100Var(𝑋𝑗 ) = 200.
The CLT says 𝑌100 is approximately normal. Standardizing gives
𝑌 − 100       10               √
𝑃 (𝑌100 > 110) = 𝑃 ( 100
√       >√      ) ≈ 𝑃 (𝑍 > 1/ 2) = 0.24 .
200       200
This last value was computed using R: 1 - pnorm(1/sqrt(2),0,1).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
More Transforming Normal Distributions
Suppose 𝑌 ∼ N(𝜇, 𝜎2 ). Show             follows a standard normal distribution.
𝜎', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : By part (a), 𝑌 ∼ N(𝜇, 𝜎2 ) ⇒ 𝑌 = 𝜎𝑍 + 𝜇. But, this implies (𝑌 − 𝜇)/𝜎 = 𝑍 ∼
N(0, 1). QED', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(Sums of normal random variables)
Let 𝑋, 𝑌 be independent random variables where 𝑋 ∼ 𝑁 (2, 5) and 𝑌 ∼ 𝑁 (5, 9) (we use the
notation 𝑁 (𝜇, 𝜎2 )). Let 𝑊 = 3𝑋 − 2𝑌 + 1.
It is known that the sum of independent normal distributions is normal. Compute
𝑃 (𝑊 ≤ 6).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Since the sum of independent normal is normal part (a) shows: 𝑊 ∼ 𝑁 (−3, 81).
𝑊 +3      9
Let 𝑍 ∼ 𝑁 (0, 1). We standardize 𝑊 : 𝑃 (𝑊 ≤ 6) = 𝑃 (       ≤ ) = 𝑃 (𝑍 ≤ 1) ≈ 0.84.
9       9', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
In 𝑛 + 𝑚 independent Bernoulli(𝑝) trials, let 𝑆𝑛 be the number of successes
in the first 𝑛 trials and 𝑇𝑚 the number of successes in the last 𝑚 trials.
What is the distribution of 𝑆𝑛 ? Why?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑆𝑛 ∼ Binomial(𝑛, 𝑝), since it is the number of successes in 𝑛 independent
Bernoulli trials.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
In 𝑛 + 𝑚 independent Bernoulli(𝑝) trials, let 𝑆𝑛 be the number of successes
in the first 𝑛 trials and 𝑇𝑚 the number of successes in the last 𝑚 trials.
What is the distribution of 𝑆𝑛 + 𝑇𝑚 ? Why?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑆𝑛 + 𝑇𝑚 ∼ Binomial(𝑛 + 𝑚, 𝑝), since it is the number of successes in 𝑛 + 𝑚
independent Bernoulli trials.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Compute the median for the exponential distribution with parameter 𝜆.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The density for this distribution is 𝑓(𝑥) = 𝜆 e−𝜆𝑥 . We know (or can compute)
that the distribution function is 𝐹 (𝑎) = 1 − e−𝜆𝑎 . The median is the value of 𝑎 such that
𝐹 (𝑎) = 0.5. Thus, 1 − e−𝜆𝑎 = 0.5 ⇒ 0.5 = e−𝜆𝑎 ⇒ log(0.5) = −𝜆𝑎 ⇒ 𝑎 = log(2)/𝜆.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Pareto and the 80-20 rule.
Pareto was an economist who used the Pareto distribution to model the wealth in a society.
For a fixed baseline 𝑚, the Pareto density with parameter 𝛼 is
𝛼 𝑚𝛼
𝑓(𝑥) =          for 𝑥 ≥ 𝑚.
𝑥𝛼+1
Assume 𝑋 is a random variable that follows such a distribution.
Pareto’s principle is often paraphrased as the 80-20 rule. That is, 80% of the wealth
is owned by 20% of the people. The rule is only exact for a Pareto distribution with
𝛼 = log(5)/ log(4) = 1.16.
Suppose 𝛼 = 𝑚 = 1. Compute the 0.80 quantile for the Pareto distribution.
In general, many phenomena follow the power law described by 𝑓(𝑥). You can look up
’Pareto principle’ in Wikipedia to read more about this.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We want the value 𝑞0.8 where 𝑃 (𝑋 ≤ 𝑞0.8 ) = 0.8.
This is equivalent to 𝑃 (𝑋 > 𝑞0.8 ) = 0.2. Using part (a) and the given values of 𝑚 and 𝛼
1
we have       = 0.2 ⇒ 𝑞0.8 = 5.
𝑞0.8
7    Joint Probability, Covariance, Correlation', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝑋 and 𝑌 be two continuous random variables with joint pdf
𝑓(𝑥, 𝑦) = 𝑐𝑥2 𝑦(1 + 𝑦) for 0 ≤ 𝑥 ≤ 3 and 0 ≤ 𝑦 ≤ 3,
and 𝑓(𝑥, 𝑦) = 0 otherwise.
Find the probability 𝑃 (1 ≤ 𝑋 ≤ 2, 0 ≤ 𝑌 ≤ 1).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Find the probability 𝑃 (1 ≤ 𝑋 ≤ 2, 0 ≤ 𝑌 ≤ 1).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝑋 and 𝑌 be two continuous random variables with joint pdf
𝑓(𝑥, 𝑦) = 𝑐𝑥2 𝑦(1 + 𝑦) for 0 ≤ 𝑥 ≤ 3 and 0 ≤ 𝑦 ≤ 3,
and 𝑓(𝑥, 𝑦) = 0 otherwise.
Find marginal cdf 𝐹𝑋 (𝑎) for 𝑎 between 0 and 3.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Since 𝑦 = 3 is the maximum value for 𝑌 , we have
9𝑎3          9       𝑎3
𝐹𝑋 (𝑎) = 𝐹 (𝑎, 3) = 𝑐 (                     + 3𝑎3 ) = 𝑐 𝑎3 =
6           2       27', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝑋 and 𝑌 be two continuous random variables with joint pdf
𝑓(𝑥, 𝑦) = 𝑐𝑥2 𝑦(1 + 𝑦) for 0 ≤ 𝑥 ≤ 3 and 0 ≤ 𝑦 ≤ 3,
and 𝑓(𝑥, 𝑦) = 0 otherwise.
Since 𝑓(𝑥, 𝑦) separates into a product as a function of 𝑥 times a function of 𝑦 we know
𝑋 and 𝑌 are independent.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (a) Total probability must be 1, so
3       3                               3        3
243
1 = ∫ ∫ 𝑓(𝑥, 𝑦) 𝑑𝑦 𝑑𝑥 = ∫ ∫ 𝑐(𝑥2 𝑦 + 𝑥2 𝑦2 ) 𝑑𝑦 𝑑𝑥 = 𝑐 ⋅                                           ,
0       0                               0        0                                        2
2
(Here we skipped showing the arithmetic of the integration) Therefore, 𝑐 =                                         .
243
(b)
2       1
𝑃 (1 ≤ 𝑋 ≤ 2, 0 ≤ 𝑌 ≤ 1) = ∫ ∫ 𝑓(𝑥, 𝑦) 𝑑𝑦 𝑑𝑥
1       0
2       1
= ∫ ∫ 𝑐(𝑥2 𝑦 + 𝑥2 𝑦2 ) 𝑑𝑦 𝑑𝑥
1       0
35
=𝑐⋅
18
70
=      ≈ 0.016
4374', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝑋 and 𝑌 be two random variables and let 𝑟, 𝑠, 𝑡, and 𝑢 be real numbers.
Show that Cov(𝑟𝑋, 𝑡𝑌 ) = 𝑟𝑡Cov(𝑋, 𝑌 ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is very similar to part (a).
We know 𝐸[𝑟𝑋] = 𝑟𝐸[𝑋], so 𝑟𝑋−𝐸[𝑟𝑋] = 𝑟(𝑋−𝐸[𝑋]). Likewise 𝑡𝑌 −𝐸[𝑡𝑌 ] = 𝑠(𝑌 −𝐸[𝑌 ]).
Once again using the definition of covariance we get
Cov(𝑟𝑋, 𝑡𝑌 ) = 𝐸[(𝑟𝑋 − 𝐸[𝑟𝑋])(𝑡𝑌 − 𝐸[𝑡𝑌 ])]
= 𝐸[𝑟𝑡(𝑋 − 𝐸[𝑋])(𝑌 − 𝐸[𝑌 ])]
(Now we use linearity of expectation to pull out the factor of 𝑟𝑡)
= 𝑟𝑡𝐸[(𝑋 − 𝐸[𝑋](𝑌 − 𝐸[𝑌 ]))]
= 𝑟𝑡Cov(𝑋, 𝑌 )', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Derive the formula for the covariance: Cov(𝑋, 𝑌 ) = 𝐸[𝑋𝑌 ] − 𝐸[𝑋]𝐸[𝑌 ].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Using linearity of expectation, we have
Cov(𝑋, 𝑌 ) = 𝐸 [(𝑋 − 𝐸[𝑋])(𝑌 − 𝐸[𝑌 ])]
= 𝐸 [𝑋𝑌 − 𝐸[𝑋]𝑌 − 𝐸[𝑌 ]𝑋 + 𝐸[𝑋]𝐸[𝑌 ]]
= 𝐸[𝑋𝑌 ] − 𝐸[𝑋]𝐸[𝑌 ] − 𝐸[𝑌 ]𝐸[𝑋] + 𝐸[𝑋]𝐸[𝑌 ]
= 𝐸[𝑋𝑌 ] − 𝐸[𝑋]𝐸[𝑌 ].', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Toss a fair coin 3 times. Let 𝑋 = the number of heads on the first toss, 𝑌
the total number of heads on the last two tosses, and 𝐹 the number of heads on the first two
tosses.
Give the joint probability table for 𝑋 and 𝐹 . Compute Cov(𝑋, 𝐹 ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (b) The sample space is Ω = {HHH, HHT, HTH, HTT, THH, THT, TTH,
TTT}.
𝑃 (𝑋 = 0, 𝐹 = 0) = 𝑃 ({𝑇 𝑇 𝐻, 𝑇 𝑇 𝑇 }) = 1/4.
𝑃 (𝑋 = 0, 𝐹 = 1) = 𝑃 ({𝑇 𝐻𝐻, 𝑇 𝐻𝑇 }) = 1/4.              𝑋
𝐹\\     0   1   𝑃𝐹
𝑃 (𝑋 = 0, 𝐹 = 2) = 0.                                  0    1/4  0  1/4
𝑃 (𝑋 = 1, 𝐹 = 0) = 0.                                  1    1/4 1/4 1/2
𝑃 (𝑋 = 1, 𝐹 = 1) = 𝑃 ({𝐻𝑇 𝐻, 𝐻𝑇 𝑇 }) = 1/4.            2     0  1/4 1/4
𝑃𝑋 1/2 1/2     1
𝑃 (𝑋 = 1, 𝐹 = 2) = 𝑃 ({𝐻𝐻𝐻, 𝐻𝐻𝑇 }) = 1/4.
Cov(𝑋, 𝐹 ) = 𝐸[𝑋𝐹 ] − 𝐸[𝑋]𝐸[𝐹 ].
𝐸[𝑋] = 1/2, 𝐸[𝐹 ] = 1, 𝐸[𝑋𝐹 ] = ∑ 𝑥𝑖 𝑦𝑗 𝑝(𝑥𝑖 , 𝑦𝑗 ) = 3/4.
⇒ Cov(𝑋, 𝐹 ) = 3/4 − 1/2 = 1/4.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Covariance and Independence
Let 𝑋 be a random variable that takes values -2, -1, 0, 1, 2; each with probability 1/5.   Let
𝑌 = 𝑋2.
Show 𝑋 and 𝑌 are not independent.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We show the probabilities don’t multiply:
𝑃 (𝑋 = −2, 𝑌 = 0) = 0 ≠ 𝑃 (𝑋 = −2) ⋅ 𝑃 (𝑌 = 0) = 1/25.
Since these are not equal 𝑋 and 𝑌 are not independent. (It is obvious that 𝑋 2 is not
independent of 𝑋.)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Continuous Joint Distributions
Suppose 𝑋 and 𝑌 are continuous random variables with joint density function 𝑓(𝑥, 𝑦) = 𝑥+𝑦
on the unit square [0, 1] × [0, 1].
Let 𝐹 (𝑥, 𝑦) be the joint CDF. Compute 𝐹 (1, 1). Compute 𝐹 (𝑥, 𝑦).
𝑎       𝑏', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐹 (𝑎, 𝑏) = 𝑃 (𝑋 ≤ 𝑎, 𝑌 ≤ 𝑏) = ∫ ∫ (𝑥 + 𝑦) 𝑑𝑦 𝑑𝑥.
0       0
2 𝑏            2
𝑦         𝑏
Inner integral:     𝑥𝑦 +     ∣ = 𝑥𝑏 + .
2 0       2
𝑎
𝑥2    𝑏2    𝑎2 𝑏 + 𝑎𝑏2
Outer integral:         𝑏 + 𝑥∣ =            .
2     2 0        2
𝑥2 𝑦 + 𝑥𝑦2
So 𝐹 (𝑥, 𝑦) =                    and   𝐹 (1, 1) = 1.
2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Continuous Joint Distributions
Suppose 𝑋 and 𝑌 are continuous random variables with joint density function 𝑓(𝑥, 𝑦) = 𝑥+𝑦
on the unit square [0, 1] × [0, 1].
Are 𝑋 and 𝑌 independent?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : To see if they are independent we check if the joint density is the product of the
marginal densities.
𝑓(𝑥, 𝑦) = 𝑥 + 𝑦, 𝑓𝑋 (𝑥) ⋅ 𝑓𝑌 (𝑦) = (𝑥 + 1/2)(𝑦 + 1/2).
Since these are not equal, 𝑋 and 𝑌 are not independent.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Correlation
Flip a coin 3 times. Use a joint pmf table to compute the covariance and correlation between
the number of heads on the first 2 and the number of heads on the last 2 flips.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑋 = the number of heads on the first 2 flips and 𝑌 the number in the last
2. Considering all 8 possibe tosses: 𝐻𝐻𝐻, 𝐻𝐻𝑇 etc we get the following joint pmf for 𝑋
and 𝑌
𝑌 /𝑋 0       1      2
0      1/8 1/8 0          1/4
1      1/8 1/4 1/8 1/2
2      0     1/8 1/8 1/4
1/4 1/2 1/4 1
Using the table we find
1   1  1  1 5
𝐸[𝑋𝑌 ] =     +2 +2 +4 = .
4   8  8  8 4
We know 𝐸[𝑋] = 1 = 𝐸[𝑌 ] so
5    1
Cov(𝑋, 𝑌 ) = 𝐸[𝑋𝑌 ] − 𝐸[𝑋]𝐸[𝑌 ] =                      −1= .
4    4
Since 𝑋 is the sum of 2 independent Bernoulli(0.5) we have 𝜎𝑋 = √2/4
Cov(𝑋, 𝑌 )    1/4   1
Cor(𝑋, 𝑌 ) =               =       = .
𝜎𝑋 𝜎𝑌      (2)/4  2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
All or None
You have $100 and, never mind why, you must convert it to $1000. Anything less is no
good. Your only way to make money is to gamble for it. Your chance of winning one bet is
𝑝.
Here are two extreme strategies:
Maximum strategy: bet as much as you can each time. To be smart, if you have less than
$500 you bet it all. If you have more, you bet enough to get to $1000.


Minimum strategy: bet $1 each time.
If 𝑝 < 0.5 (the odds are against you) which is the better strategy?
What about 𝑝 > 0.5?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If 𝑝 < 0.5 your expected winnings on any bet is negative, if 𝑝 = 0.5 it is 0, and
if 𝑝 > 0.5 is is positive. By making a lot of bets the minimum strategy will ’win’ you close
to the expected average. So if 𝑝 ≤ 0.5 you should use the maximum strategy and if 𝑝 > 0.5
you should use the minumum strategy.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(Binomial ≈ normal)
Let 𝑋 ∼ binomial(100,1/3).
An ‘exact’ computation in R gives 𝑃 (𝑋 ≤ 30) = 0.2765539. Use the central limit theorem
to give an approximation of 𝑃 (𝑋 ≤ 30)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑋 ∼ binomial(100, 1/3) means 𝑋 is the sum of 100 i.i.d. Bernoulli(1/3) random
variables 𝑋𝑖 .
We know 𝐸[𝑋𝑖 ] = 1/3 and Var(𝑋𝑖 ) = (1/3)(2/3) = 2/9. Therefore the central limit theorem
says
𝑋 ≈ N(100/3, 200/9)
Standardization then gives
𝑋 − 100/3   30 − 100/3
𝑃 (𝑋 ≤ 30) = 𝑃 (             ≤            ) ≈ 𝑃 (𝑍 ≤ −0.7071068) ≈ 0.239751
√200/9      √200/9
We used R to do these calculations The approximation agrees with the ‘exact’ number to 2
decimal places.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Hospitals (binomial, CLT, etc)
• A certain town is served by two hospitals.
• Larger hospital: about 45 babies born each day.
• Smaller hospital about 15 babies born each day.
• For a period of 1 year, each hospital recorded the days on which more than 60% of the
babies born were boys.
Which hospital do you think recorded more such days?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : When this question was asked in a study, the number of undergraduates
who chose each option was 21, 21, and 55, respectively. This shows a lack of intuition for
the relevance of sample size on deviation from the true mean (i.e., variance).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Hospitals (binomial, CLT, etc)
• A certain town is served by two hospitals.
• Larger hospital: about 45 babies born each day.
• Smaller hospital about 15 babies born each day.
• For a period of 1 year, each hospital recorded the days on which more than 60% of the
babies born were boys.
Let 𝐿 (resp., 𝑆) be the number of days on which more than 60% of the babies born in
the larger (resp., smaller) hospital were boys. What type of distribution do 𝐿 and 𝑆 have?
Compute the expected value and variance in each case.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Note that 𝐿 = ∑𝑖=1 𝐿𝑖 and 𝑆 = ∑𝑖=1 𝑆𝑖 . So 𝐿 has a Bin(365, 𝑝𝐿 ) distribu-
tion and 𝑆 has a Bin(365, 𝑝𝑆 ) distribution. Thus
𝐸[𝐿] = 365𝑝𝐿 ≈ 25
𝐸[𝑆] = 365𝑝𝑆 ≈ 55
Var(𝐿) = 365𝑝𝐿 (1 − 𝑝𝐿 ) ≈ 23
Var(𝑆) = 365𝑝𝑆 (1 − 𝑝𝑆 ) ≈ 47', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Hospitals (binomial, CLT, etc)
• A certain town is served by two hospitals.
• Larger hospital: about 45 babies born each day.
• Smaller hospital about 15 babies born each day.
• For a period of 1 year, each hospital recorded the days on which more than 60% of the
babies born were boys.
What is the correlation of 𝐿 and 𝑆? What is the joint pmf of 𝐿 and 𝑆? Visualize the
region corresponding to the event 𝐿 > 𝑆. Express 𝑃 (𝐿 > 𝑆) as a double sum.
9   R Problems
R will not be on the exam. However, these problems will help you understand the concepts
we’ve been studying.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Since 𝐿 and 𝑆 are independent, their joint distribution is determined by multiplying
their individual distributions. Both 𝐿 and 𝑆 are binomial with 𝑛 = 365 and 𝑝𝐿 and 𝑝𝑆
computed above. Thus
365 𝑖                  365
𝑝𝑙,𝑠 𝑃 (𝐿 = 𝑖 and 𝑆 = 𝑗) = 𝑝(𝑖, 𝑗) = (      )𝑝𝐿 (1 − 𝑝𝐿 )365−𝑖 ( )𝑝𝑆𝑗 (1 − 𝑝𝑆 )365−𝑗
𝑖                      𝑗
Thus
364    365
𝑃 (𝐿 > 𝑆) = ∑ ∑ 𝑝(𝑖, 𝑗) ≈ 0.0000916
𝑖=0 𝑗=𝑖+1
(We used R to do the computations.)
9   R Problems
R will not be on the exam. However, these problems will help you understand the concepts
we’ve been studying.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
R simulation
Consider 𝑋1 , 𝑋2 , …all independent and with distribution N(0, 1). Let 𝑋 𝑚 be the average of
𝑋1 , …𝑋𝑛 .
Use a R simulation to estimate 𝐸[𝑋 𝑛 ] and Var(𝑋 𝑛 ) for 𝑛 = 1, 9, 100. (You should use
the rnorm function to simulate 1000 samples of each 𝑋𝑗 .)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Here’s my R code:
x = rnorm(100*1000,0,1)
data = matrix(x, nrow=100, ncol=1000)
data1 = data[1,]
m1 = mean(data1)
v1 = var(data1)
data9 = colMeans(data[1:9,])
m9 = mean(data9)
v9 = var(data9)
data100 = colMeans(data)
m100 = mean(data100)
v100 = var(data100)
#display the results
print(m1)
print(v1)
print(m9)
print(v9)
print(m100)
print(v100)
∑ 𝑥𝑘            ∑ 𝑥𝑘
Note if 𝑥 = [𝑥1 , 𝑥2 , … , 𝑥𝑛 ] then var(x) actually computes      instead of      . There is
𝑛−1               𝑛
a good reason for this which we will learn in the statistics part of the class. For now, it’s
enough to note that if 𝑛 = 1000 the using 𝑛 or 𝑛 − 1 won’t make much difference.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
A full house in poker is a hand where three cards share one rank and two
cards share another rank. How many ways are there to get a full-house? What is the
probability of getting a full-house?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We build a full-house in stages and count the number of ways to make each
stage:
13
Stage 1. Choose the rank of the pair: ( ).
1
4
Stage 2. Choose the pair from that rank, i.e. pick 2 of 4 cards: ( ).
2
12
Stage 3. Choose the rank of the triple (from the remaining 12 ranks): ( ).
1
4
Stage 4. Choose the triple from that rank: ( ).
3
13 4 12 4
Number of ways to get a full-house: (        )( )( )( )
1   2  1  3
52
Number of ways to pick any 5 cards out of 52: ( )
5
13 4 12 4
(   )( )( )( )
1   2    1 3
Probability of a full house:                      ≈ 0.00144
52
( )
5', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(Another Arithmetic Puzzle)
Let 𝑋 and 𝑌 be two independent Bernoulli(0.5) random variables. Define 𝑆 and 𝑇 by:
𝑆 =𝑋+𝑌          and 𝑇 = 𝑋 − 𝑌 .
Find the joint and marginal pmf’s for 𝑆 and 𝑇 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Find the joint and marginal pmf’s for 𝑆 and 𝑇 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝑋 be a discrete random variable with pmf 𝑝 given by:
𝑥    −2   −1    0   1     2
𝑝(𝑥) 1/15 2/15 3/15 4/15 5/15
Find the value the cdf of 𝑋 at -3/2, 3/4, 7/8, 1, 1.5, 5.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : and (c) To distinguish the distribution functions we’ll write 𝐹𝑋 and 𝐹𝑌 .
Using the tables in part (a) and the definition 𝐹𝑋 (𝑎) = 𝑃 (𝑋 ≤ 𝑎) etc. we get
𝑎    -3/2    3/4     7/8      1      1.5    5
𝐹𝑋 (𝑎)    1/15   6/15    6/15   10/15   10/15    1
𝐹𝑌 (𝑎)      0    3/15    3/15    9/15    9/15    1', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose data 𝑥1 , … , 𝑥𝑛 are i.i.d. and drawn from N(𝜇, 𝜎2 ), where 𝜇 and 𝜎
are unknown.
Suppose a data set is taken and we have 𝑛 = 49, sample mean 𝑥̄ = 92 and sample standard
deviation 𝑠 = 0.75.
Find a 90% confidence interval for 𝜇.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We need to use the studentized mean 𝑡 =             √ ..
𝑠/ 𝑛
We know 𝑡 ∼ 𝑡(𝑛−1) = 𝑡(48). So we use the 𝑚 = 48 line of the 𝑡 table and find 𝑡0.05 = 1.677.
Thus,
𝑥̄ − 𝜇
𝑃 (−1.677 < √ < 1.677 | 𝜇) = 0.90.
𝑠/ 𝑛
Unwinding this, we get the 90% confidence interval for 𝜇 is
𝑠               𝑠                 0.75               0.75
[𝑥̄ − √ ⋅ 1.677, 𝑥̄ + √ ⋅ 1.677] = [92 −      ⋅ 1.677, 92 +      ⋅ 1.677] = [91.82, 92.18].
𝑛               𝑛                  7                 7', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Empirical bootstrap
Suppose we had 100 data points 𝑥1 , … 𝑥100 with sample median 𝑞0.5̂ = 3.3.
Outline the steps needed to generate an empirical percentile bootstrap 90% confidence
interval for the median 𝑞0.5 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : For the percentile bootstrap, we don’t have to pivot, so the algebra is a little
shorter.
Step 1. We have the point estimate 𝑞0.5 ≈ 𝑞0.5
̂ = 3.3.
Step 2. Use the computer to generate many (say 10000) size 100 resamples of the original
data.
∗
Step 3. For each bootstrap sample compute and save the bootstrap median 𝑞0.5 .
Step 4. Find the quantiles 𝑐0.05 and 𝑐0.95 . (Remember 𝑐0.05 is the 5th percentile in the list
of bootstrap medians, etc.)
Step 5. The 90% percentile bootstrap confidence interval for 𝑞0.5 is
[𝑐0.05 , 𝑐0.95 ]', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
In this problem we will use maximum likelihood estimates to develop Gauss’
method of least squares for fitting lines to data.
Suppose you have bivariate data, that is, a sequence of pairs (𝑥1 , 𝑦1 ), … , (𝑥𝑛 , 𝑦𝑛 ). A common
model is that there is a linear relationship between 𝑥 and 𝑦, so in principle the data should
lie exactly along a line. However, since data has random noise this will not be the case.
What we can do is look for the line that best fits the data. To do this we will use a model
called simple linear regression.
For bivariate data the simple linear regression model assumes that the 𝑥𝑖 are not random
and that, for some values of the parameters 𝑎 and 𝑏, we have
𝑦𝑖 = 𝑎𝑥𝑖 + 𝑏 + random noise
To be more precise, we will assume that the value 𝑦𝑖 is drawn from a random variable of
the form
𝑌𝑖 ∼ 𝑎𝑥𝑖 + 𝑏 + 𝜀𝑖
where 𝜀𝑖 is a normal random variable with mean 0 and variance 𝜎2 . We assume all of the
random variables 𝜀𝑖 are independent and that 𝜎 is the same for all 𝑖.
Notes. 1. The goal in simple linear regression is to find the line, i.e. the values of 𝑎 and
𝑏 that best fit the data.
2. We think of 𝜀𝑖 as the random measurement error.
3. Remember that (𝑥𝑖 , 𝑦𝑖 ) are not variables. They are data values.
The distribution of 𝑌𝑖 depends on 𝑎, 𝑏, 𝜎 and 𝑥𝑖 . So we write its pdf as
𝑓(𝑦𝑖 | 𝑎, 𝑏, 𝑥𝑖 , 𝜎).
Give the formula for the likelihood function corresponding to one random value 𝑦𝑖 . (Hint:
𝑦𝑖 − 𝑎𝑥𝑖 − 𝑏 ∼ N(0, 𝜎2 ).)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We know that 𝑦𝑖 − 𝑎𝑥𝑖 − 𝑏 = 𝜀𝑖 ∼ N(0, 𝜎2 ). Therefore,
1          (𝑦𝑖 −𝑎𝑥𝑖 −𝑏)2
𝑓(𝑦𝑖 | 𝑎, 𝑏, 𝑥𝑖 , 𝜎) =       √     e−        2𝜎2        .
𝜎    2𝜋', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
In this problem we will use maximum likelihood estimates to develop Gauss’
method of least squares for fitting lines to data.
Suppose you have bivariate data, that is, a sequence of pairs (𝑥1 , 𝑦1 ), … , (𝑥𝑛 , 𝑦𝑛 ). A common
model is that there is a linear relationship between 𝑥 and 𝑦, so in principle the data should
lie exactly along a line. However, since data has random noise this will not be the case.
What we can do is look for the line that best fits the data. To do this we will use a model
called simple linear regression.
For bivariate data the simple linear regression model assumes that the 𝑥𝑖 are not random
and that, for some values of the parameters 𝑎 and 𝑏, we have
𝑦𝑖 = 𝑎𝑥𝑖 + 𝑏 + random noise
To be more precise, we will assume that the value 𝑦𝑖 is drawn from a random variable of
the form
𝑌𝑖 ∼ 𝑎𝑥𝑖 + 𝑏 + 𝜀𝑖
where 𝜀𝑖 is a normal random variable with mean 0 and variance 𝜎2 . We assume all of the
random variables 𝜀𝑖 are independent and that 𝜎 is the same for all 𝑖.
Notes. 1. The goal in simple linear regression is to find the line, i.e. the values of 𝑎 and
𝑏 that best fit the data.
2. We think of 𝜀𝑖 as the random measurement error.
3. Remember that (𝑥𝑖 , 𝑦𝑖 ) are not variables. They are data values.
Find the maximum likelihood estimate for 𝑎 and 𝑏 by taking partial derivatives of the
log likelihood function and setting them equal to 0.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The partial derivatives of 𝑙(𝑎, 𝑏, 𝜎) are
𝑛
𝜕𝑙
= ∑ 2𝑥𝑖 (𝑦𝑖 − 𝑎𝑥𝑖 − 𝑏)
𝜕𝑎   𝑖=1
𝑛
𝜕𝑙
= ∑ 2(𝑦𝑖 − 𝑎𝑥𝑖 − 𝑏)
𝜕𝑏   𝑖=1
Here is the algebra use in setting these to 0 and solving for 𝑎 and 𝑏:
𝑛
∑ 2𝑥𝑖 (𝑦𝑖 − 𝑎𝑥𝑖 − 𝑏) = 0 ⇒ 𝑎 ∑ 𝑥2𝑖 + 𝑏 ∑ 𝑥𝑖 = ∑ 𝑥𝑖 𝑦𝑖
𝑖=1
𝑛
∑ 2(𝑦𝑖 − 𝑎𝑥𝑖 − 𝑏) = 0 ⇒ 𝑎 ∑ 𝑥𝑖 + 𝑏 𝑛 = ∑ 𝑦𝑖
𝑖=1
It will be convenient to use the following notations:
𝑛                        𝑛
𝑆𝑥               𝑆𝑦
𝑆𝑥 = ∑ 𝑥𝑖               𝑆𝑦 = ∑ 𝑦𝑖                            𝑥̄ =             𝑦̄ =
𝑖=1                      𝑖=1
𝑛                𝑛
𝑛                        𝑛
𝑆𝑥𝑥 = ∑ 𝑥2𝑖             𝑆𝑥𝑦 = ∑ 𝑥𝑖 𝑦𝑖
𝑖=1                       𝑖=1
With this notation our equations become
𝑎𝑆𝑥𝑥 + 𝑏𝑆𝑥 = 𝑆𝑥𝑦 ,           𝑎𝑆𝑥 + 𝑏𝑛 = 𝑆𝑦 .
Solving the second equation for 𝑏 gives
𝑆𝑦 − 𝑎𝑆𝑥
𝑏=             = 𝑦 ̄ − 𝑎𝑥̄
𝑛
Putting this into the first equation and solving for 𝑎 gives
𝑆𝑥𝑦 − 𝑦𝑆
̄ 𝑥    𝑆𝑥𝑦 /𝑛 − 𝑥𝑦̄ ̄
𝑎=               =                .
𝑆𝑥𝑥 − 𝑆𝑥 𝑥̄   𝑆𝑥𝑥 /𝑛 − 𝑥2̄
(The last expression came by dividing both numerator and denominator of the middle
expression by 𝑛.)
Note: We could also find the MLE for 𝜎, but, since we don’t need it for fitting the line, we
don’t bother.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
In this problem we will use maximum likelihood estimates to develop Gauss’
method of least squares for fitting lines to data.
Suppose you have bivariate data, that is, a sequence of pairs (𝑥1 , 𝑦1 ), … , (𝑥𝑛 , 𝑦𝑛 ). A common
model is that there is a linear relationship between 𝑥 and 𝑦, so in principle the data should
lie exactly along a line. However, since data has random noise this will not be the case.
What we can do is look for the line that best fits the data. To do this we will use a model
called simple linear regression.
For bivariate data the simple linear regression model assumes that the 𝑥𝑖 are not random
and that, for some values of the parameters 𝑎 and 𝑏, we have
𝑦𝑖 = 𝑎𝑥𝑖 + 𝑏 + random noise
To be more precise, we will assume that the value 𝑦𝑖 is drawn from a random variable of
the form
𝑌𝑖 ∼ 𝑎𝑥𝑖 + 𝑏 + 𝜀𝑖
where 𝜀𝑖 is a normal random variable with mean 0 and variance 𝜎2 . We assume all of the
random variables 𝜀𝑖 are independent and that 𝜎 is the same for all 𝑖.
Notes. 1. The goal in simple linear regression is to find the line, i.e. the values of 𝑎 and
𝑏 that best fit the data.
2. We think of 𝜀𝑖 as the random measurement error.
3. Remember that (𝑥𝑖 , 𝑦𝑖 ) are not variables. They are data values.
Use R to plot the data and the regression line you found in problem (1c). The commands
plot(x, y, pch=19) and abline() will come in handy.
Print the plot and turn it in.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Here’s the R code I used to make the plot
8
x = c(1, 3, 5)
7
y = c(8, 2, 1)
6
a = -7/4
5
y
b = 107/12
4
3
plot(x, y, pch=19, col="blue")
2
abline(a=b, b=a, col="orange")
1
1       2     3     4   5
x', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
You have bivariate data (𝑥𝑖 , 𝑦𝑖 ). You have reason to suspect the data is
related by 𝑦𝑖 = 𝑎/𝑥𝑖 + 𝑈𝑖 where 𝑈𝑖 is a random variable with mean 0 and variance 𝜎2 (the
same for all 𝑖).
Find the least squares estimate of 𝑎.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The total squared error is
2
𝑎
𝑆(𝑎) = ∑ (𝑦𝑖 − ) .
𝑥𝑖
Taking the derivative and setting it to 0 gives
2       𝑎
𝑆 ′ (𝑎) = ∑ −        (𝑦𝑖 − ) = 0
𝑥𝑖      𝑥𝑖
This implies
1      𝑦         ∑ 𝑦𝑖 /𝑥𝑖
𝑎∑        = ∑ 𝑖 ⇒ 𝑎̂ =          .
𝑥2𝑖    𝑥𝑖        ∑ 1/𝑥2𝑖', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Least Squares and MLE
In this problem we will see that the least squares fit of a line is just the MLE assuming the
error terms are normally distributed.
For bivariate data (𝑥1 , 𝑦1 ), … , (𝑥𝑛 , 𝑦𝑛 ), the simple linear regression model says that 𝑦𝑖 is a
random value generated by a random variable
𝑌𝑖 = 𝑎𝑥𝑖 + 𝑏 + 𝜀𝑖
where 𝑎, 𝑏, 𝑥𝑖 are fixed (not random) values, and 𝜀𝑖 is a random variable with mean 0 and
variance 𝜎2 .
Give the formula for the pdf 𝑓𝑌𝑖 (𝑦𝑖 ) of 𝑌𝑖 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The density for a normal distribution is known
1     (𝑦𝑖 −𝑎𝑥𝑖 −𝑏)2
𝑓𝑌𝑖 (𝑦𝑖 ) = √     e− 2𝜎2 .
2𝜋 𝜎', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
A coin is tossed 100 times and lands heads 62 times. Find the maximum
likelihood estimate for the probability 𝜃 of heads.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The likelihood function is
100 62
𝑝(data|𝜃) = (      )𝜃 (1 − 𝜃)38 = 𝑐𝜃62 (1 − 𝜃)38 .
62
To find the MLE we find the derivative of the log-likelihood and set it to 0.
ln(𝑝(data|𝜃)) = ln(𝑐) + 62 ln(𝜃) + 38 ln(1 − 𝜃).
𝑑 ln(𝑝(data|𝜃))   62    38
=    −     = 0.
𝑑𝜃           𝜃   1−𝜃
The algebra leads to the MLE 𝜃 = 62/100 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose the data set 𝑦1 , … , 𝑦𝑛 is a drawn from a random sample consisting
of i.i.d. discrete uniform distributions with range 1 to 𝑁 . Find the maximum likelihood
estimate of 𝑁 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If 𝑁 < max(𝑦𝑖 ) then the likelihood 𝑝(𝑦1 , … , 𝑦𝑛 |𝑁 ) = 0. So the likelihood
function is
0     if 𝑁 < max(𝑦𝑖 )
𝑝(𝑦1 , … , 𝑦𝑛 |𝑁 ) = { 1 𝑛
(𝑁 )  if 𝑁 ≥ max(𝑦𝑖 )
This is maximized when 𝑁 is as small as possible.          Since 𝑁 ≥ max(𝑦𝑖 ) the MLE is
𝑁 = max(𝑦𝑖 ).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose 𝑥1 , … , 𝑥𝑛 is a data set drawn from a geometric(1/𝑎) distribution.
Find the maximum likelihood estimate of 𝑎. Here, geometric(𝑝) means the probability of
success is 𝑝 and we run trials until the first success and report the total number of trials,
including the success. For example, the sequence 𝐹 𝐹 𝐹 𝐹 𝑆 is 4 failures followed by a success,
which produces 𝑥 = 5.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑃 (𝑥𝑖 |𝑎) = (1 − )        .=(      )        .
𝑎       𝑎       𝑎         𝑎
So, the likelihood function is
𝑎 − 1 ∑ 𝑥𝑖 −𝑛 1 𝑛
𝑃 (data|𝑎) = (      )       ( )
𝑎           𝑎
The log likelihood is
ln(𝑃 (data|𝑎)) = (∑ 𝑥𝑖 − 𝑛) (ln(𝑎 − 1) − ln(𝑎)) − 𝑛 ln(𝑎).
Taking the derivative
𝑑 ln(𝑃 (data|𝑎))                 1  1  𝑛     ∑ 𝑥𝑖
= (∑ 𝑥𝑖 − 𝑛) (    − )− =0 ⇒      = 𝑎.
𝑑𝑎                        𝑎−1 𝑎  𝑎      𝑛
The maximum likelihood estimate is 𝑎 = 𝑥̄ .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Twins
Suppose 1/4 of twins are identical and 3/4 of twins are fraternal. If you are pregnant
with twins of the same sex, what is the probability that they are identical?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is a Bayes’ theorem problem. The likelihoods are
P(same sex | identical) = 1             P(different sex | identical) = 0
P(same sex | fraternal) = 1/2           P(different sex | fraternal) = 1/2
The data is ‘the twins are the same sex’. We find the answer with an update table
hyp.         prior   likelihood   Bayes numer.   posterior
identical       1/4         1           1/4          2/5
fraternal       3/4        1/2          3/8          3/5
Tot.          1                      5/8            1
So P(identical | same sex) = 2/5 = 0.4 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Dice.
You have a drawer full of 4, 6, 8, 12 and 20-sided dice. You suspect that they are in
proportion 1:2:10:2:1. Your friend picks one at random and rolls it twice getting 5 both
times.
What is the probability your friend picked the 8-sided die?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The data is 5. Let 𝐻𝑛 be the hypothesis the die is 𝑛-sided. Here is the update
table.
hyp. prior likelihood Bayes numer. posterior
𝐻4       1        0            0              0
𝐻6       2     (1/6)2        2/36         0.243457
𝐻8      10     (1/8)2       10/64         0.684723
𝐻12      2    (1/12)2       2/144         0.060864
2
𝐻20      1    (1/20)        1/400         0.010956
Tot.     16                 0.22819            1
So 𝑃 (𝐻8 |data) = 0.685.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Sameer has two coins: one fair coin and one biased coin which lands heads with probability
3/4. He picks one coin at random (50-50) and flips it repeatedly until he gets a tails.
Assume that he observes 3 heads before the first tails.
What are the prior and posterior odds for the fair coin?
𝑃 (fair)     1/2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The prior odds are 𝑂(fair) =                     =     = 1.
𝑃 (not fair)   1/2
The posterior odds are the product of the prior odds and the Bayes factor (likelihood ratio).
The data is 𝐻𝐻𝐻𝑇 . So, the Bayes factor is
𝑃 (data | fair)    (1/2)3 (1/2)   16
𝐵𝐹 =                     =      3
=    .
𝑃 (data | unfair)   (3/4) (1/4)    27
16    16
So the posterior odds 𝑂(fair | not fair) = 𝑂(fair) ⋅ 𝐵𝐹 = 1 ⋅    =    ≈ 0.593.
27    27', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Peter and Jerry disagree over whether 18.05 students prefer Bayesian or
frequentist statistics. They decide to pick a random sample of 10 students from the class
and get Shelby to ask each student which they prefer. They agree to start with a prior
𝑓(𝜃) ∼ Beta(2, 2), where 𝜃 is the percent that prefer Bayesian.
Compute the posterior distribution of 𝜃 given 𝑥1 = 6.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have prior:
𝑓(𝜃) = 𝑐1 𝜃(1 − 𝜃)
and likelihood:
10
𝑝(𝑥1 = 6 | 𝜃) = 𝑐2 𝜃6 (1 − 𝜃)4 ,      where    𝑐2 = (      ).
6
The Bayes numerator is 𝑓(𝜃)𝑝(𝑥1 |𝜃) = 𝑐1 𝑐2 𝜃7 (1 − 𝜃)5 . So the normalized posterior is
𝑓(𝜃|𝑥1 ) = 𝑐3 𝜃7 (1 − 𝜃)5
Since the posterior has the form of a Beta(8, 6) distribution it must be a Beta(8, 6) distri-
bution. We can look up the normalizing coeﬀicient 𝑐3 = 7!13!5! .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Peter and Jerry disagree over whether 18.05 students prefer Bayesian or
frequentist statistics. They decide to pick a random sample of 10 students from the class
and get Shelby to ask each student which they prefer. They agree to start with a prior
𝑓(𝜃) ∼ Beta(2, 2), where 𝜃 is the percent that prefer Bayesian.
The maximum a posteriori (MAP) estimate of 𝜃 (the peak of the posterior) is given by
𝜃 ̂ = 7/12, leading Jerry to concede that a majority of students are Bayesians. In light of
your answer to part (c) does Jerry have a strong case?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If the majority prefer Bayes then 𝜃 > 0.5. Since the 50% interval includes 𝜃 < 0.5
and the 90% interval covers a lot of 𝜃 < 0.5 we don’t have a strong case that 𝜃 > 0.5.
As a further test we compute 𝑃 (𝜃 < 0.5|𝑥1 ) = pbeta(0.5,8,6) = 0.29053. So there is
still a 29% posterior probability that the majority prefers frequentist statistics.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Take your medicine
A lab has an experimental treatment for a disease. The treatment will cure an unknown
fraction 𝜃 of the patients it’s used on. Because it is brand new, they have no idea what 𝜃
is, so they use a flat prior 𝑓(𝜃) = 1.
In a small preliminary study, the treatment cured 16 out of 20 patients.
Use this data to find the posterior pdf for 𝜃.
Write an integral formula for the normalizing factor (total probability of the data), but do
not compute it. Call its value 𝑇 and give the posterior pdf in terms of 𝑇 .


7    Bayesian Updating: normal-normal conjugate pairs', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Here’s the update table.
Bayes
hypoth.   prior        likelihood                            numerator              posterior
𝜃      1 ⋅ 𝑑𝜃   (20  16
16)𝜃 (1 − 𝜃)
4
(20  16      14
16)𝜃 (1 − 𝜃) 𝑑𝜃             𝑐𝜃16 (1 − 𝜃)4 𝑑𝜃
1
Total      1                             𝑇 = ∫0 (20  16      4
16)𝜃 (1 − 𝜃) 𝑑𝜃                       1
(20
16)
So, 𝑓(𝜃|𝑥) = 𝑐𝜃16 (1 − 𝜃)4 , where 𝑐 =           .
𝑇
21
A computation (or Wikipedia) would show 𝑐 =
16! 4!
(This is called a Beta distribution.) Here is a plot of the prior and posterior
Prior and posterior
4
3
Posterior
2
Prior
1
0
0.0      0.2           0.4        0.6        0.8     1.0
θ
7   Bayesian Updating: normal-normal conjugate pairs', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose that you have a cable whose exact length is 𝜃. You have a ruler
with known error normally distributed with mean 0 and variance 10−4 . Using this ruler, you
measure your cable, and the resulting measurement 𝑥 is distributed as 𝑁 (𝜃, 10−4 ).
With the same prior as in part (a), compute the total number of measurements needed
so that the posterior variance of 𝜃 is less than 10−6 .
2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have 𝜎prior  = 1 and 𝜎2 = 10−4 . The posterior variance of 𝜃 given observations
𝑥1 , … , 𝑥𝑛 is given by
1             1
1     𝑛 =
𝜎2
+ 𝜎2     1 + 𝑛 ⋅ 104
prior
We wish to find 𝑛 such that the above quantity is less than 10−6 . It is not hard to see that
𝑛 = 100 is the smallest value such that this is true.
8   NHST', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Probability, MLE, goodness of fit
There was a multicenter test of the rate of success for a certain medical procedure. At each
of the 60 centers the researchers tested 12 subjects and reported the number of successes.
Assume that the probability of success 𝜃 is the same at each center and the 60 centers
produced data: 𝑥1 , 𝑥2 , … , 𝑥60 . Find the MLE for 𝜃. Write your answer in terms of 𝑥̄', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The likelihood function for the combined data from all 60 centers is
12 𝑥1               12                    12
𝑝(𝑥1 , 𝑥2 , … , 𝑥60 | 𝜃) = (      )𝜃 (1 − 𝜃)12−𝑥1 ( )𝜃𝑥2 (1 − 𝜃)12−𝑥2 ⋯ ( )𝜃𝑥60 (1 − 𝜃)12−𝑥60
𝑥1                  𝑥2                    𝑥60
= 𝑐 𝜃∑ 𝑥𝑖 (1 − 𝜃)∑ 12−𝑥𝑖
To find the maximum we use the log likelihood. At the same time we make the substitution
60 ⋅ 𝑥̄ for ∑ 𝑥𝑖 .
ln(𝑝(data | 𝜃)) = ln(𝑐) + 60𝑥̄ ln(𝜃) + 60(12 − 𝑥)̄ ln(1 − 𝜃).
Now we set the derivative to 0:
𝑑 ln(𝑝(data | 𝜃))   60𝑥̄ 60(12 − 𝑥)̄
=     −            = 0.
𝑑𝜃            𝜃     1−𝜃
Solving for 𝜃 we get
𝑥̄
𝜃̂ =      .
12
Parts (c-e) use the following table which gives counts from 60 centers, e.g. 𝑥 = 2 occurred
in 17 out of 60 centers.
𝑥       0     1     2      3   4   5
counts    4    15    17     10   8   6
Note, the possible values of 𝑥 are 0 to 12. The table shows that 𝑥 > 5 never occurred.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Probability, MLE, goodness of fit
There was a multicenter test of the rate of success for a certain medical procedure. At each
of the 60 centers the researchers tested 12 subjects and reported the number of successes.
Assuming the probability of success at each center is the same, show that the MLE for
𝜃 is 𝜃 ̂ = 0.1958.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Just plug 𝑥̄ = 2.35 into the formula from part (b): 𝜃 ̂ = 𝑥/12
̄   = 2.35/12 = 0.1958', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Concept questions
True or false: Setting the prior probability of a hypothesis to 0 means that no amount of
data will make the posterior probability of that hypothesis the maximum over all hypotheses.
True              False', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : True. Bayesian updating involves multiplying the likelihood and the prior. If the prior
is 0 then this product will be 0.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
The Pareto distribution with parameter 𝛼 has range [1, ∞) and pdf
                                                     𝛼
                                         𝑓(𝑥) =
                                                     𝑥𝛼

Suppose the data
                                           5, 2, 3
was drawn independently from such a distribution. Find the maximum likelihood estimate
(MLE) of 𝛼.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : likelihood = 𝜙(data | 𝛼) =      𝛼
⋅ 𝛼 ⋅ 𝛼 = 𝛼.
5   2   3   30
1
18.05 Practice Exam 2b Solutions                                                                 2
Therefore, log likelihood = ln(𝜙(data | 𝛼)) = 3 ln(𝛼) − 𝛼 ln(30). We find the maximum
likelihood by setting the derivative equal to 0:
𝑑                  3
ln(𝜙(data | 𝛼)) = − ln(30) = 0.
𝑑𝛼                  𝛼
3
Solving we get 𝛼̂ =          .
ln(30)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Your friend grabs a die at random from a drawer containing two 4-sided dice, one 8-sided
die, and one 12-sided die. They roll the die once and report that the result is 5.
What is the prior predictive probability of rolling a 5?
1    1   5', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑃 (𝑥1 = 5) = 𝑇 = 32 + 48 = 96 ≈ 0.0521. (Any of these expressions is a fine
answer.)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Your friend grabs a die at random from a drawer containing two 4-sided dice, one 8-sided
die, and one 12-sided die. They roll the die once and report that the result is 5.
Given the data of the first roll, what is your probability that the next roll will be a 7?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Here we use the posterior probabilities of the for each of the dice to compute
the predictive probability
3 1 2 1    13
𝑃 (𝑥2 = 7 | 𝑥1 = 5) = 0 ⋅ 0 +    ⋅ + ⋅   =     ≈ 0.108
5 8 5 12   120
(Any of these answers is okay.)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝐶 and 𝐷 be two events. Suppose 𝑃 (𝐶) = 0.5, 𝑃 (𝐶∩𝐷) = 0.2 and 𝑃 ((𝐶∪𝐷)𝑐 ) = 0.4.
What is 𝑃 (𝐷)?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : See the figure: 𝑃 ((𝐶𝑈 𝐷) ) = 0.4 ⇒ 𝑃 ((𝐶𝑈 𝐷) = 0.6).
𝑃 (𝐶 ∪ 𝐷) = 𝑃 (𝐶) + 𝑃 (𝐷) − 𝑃 (𝐶 ∩ 𝐷) ⇒ 0.6 = 0.5 + 𝑃 (𝐷) − 0.2 ⇒ 𝑃 (𝐷) = 0.3 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
An urn contains 3 orange balls and 2 blue balls. A ball is drawn. If the ball
is orange, it is kept out of the urn and a second ball is drawn from the urn. If the ball is
blue, then it is put back in the urn and an orange ball is added to the urn. Then a second
ball is drawn from the urn.
𝑃 (𝐵1 |𝑂2 ) =                      = 2 36 54 2 =         =    .
𝑃 (𝑂2 )          4 ⋅ 5 + 6 ⋅ 5
17/30   17', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑂1 be the event the first ball is orange and 𝑂2 that the second ball is orange.
Likewise for 𝐵1 and 𝐵2 . The following tree captures all the details of the game.
3/5             2/5
2/4   𝑂1   2/4             4/6   𝐵1     2/6
𝑂2                    𝐵2   𝑂2                      𝐵2
3 2   6', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose 𝑋 is a random variable with cdf
⎧0                  for 𝑥 < 0
{
{
𝐹 (𝑥) = 𝑥(2 − 𝑥)           for 0 ≤ 𝑥 ≤ 1
⎨
{
{
⎩1                  for 𝑥 > 1
Find 𝐸[𝑋].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑓(𝑥) = 𝐹 ′ (𝑥) = 2 − 2𝑥 on [0, 1]. Therefore
1
𝐸[𝑋] = ∫ 𝑥𝑓(𝑥) 𝑑𝑥
0
1
= ∫ 2𝑥 − 2𝑥2 𝑑𝑥
0
2 1
= 𝑥2 − 𝑥3 ∣
3 0
1
=     .
3', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Compute the mean and variance of a random variable whose distribution
is uniform on the interval [𝑎, 𝑏].
It is not enough to simply state these values. You must give the details of the computation.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑋 ∼ U(𝑎, 𝑏). The pdf of 𝑋 is 𝑓(𝑥) =               on the interval [𝑎, 𝑏]. Thus,
𝑏−𝑎
𝑏              𝑏                           𝑏
𝑥          𝑥2       𝑏 2 − 𝑎2   𝑏+𝑎
𝐸[𝑋] = ∫ 𝑥𝑓(𝑥) 𝑑𝑥 = ∫     𝑑𝑥 =         ∣ =          =
𝑎            𝑎 𝑏−𝑎      2(𝑏 − 𝑎) 𝑎 2(𝑏 − 𝑎)     2
𝑏
Var(𝑋) = ∫ (𝑥 − 𝜇)2 𝑓(𝑥) 𝑑𝑥
𝑎
𝑏                 2
𝑎+𝑏     1
= ∫ (𝑥 −     )       𝑑𝑥
𝑎       2    𝑏 − 𝑎
3           𝑏
(𝑥 − 𝑎+𝑏
2 )  1
=               ∣
3     𝑏−𝑎
𝑎
= … algebra …
1         1
= (𝑏 − 𝑎)3
12       𝑏−𝑎
(𝑏 − 𝑎)2
=            .
12', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Defaulting on a loan means failing to pay it back on time. The default rate
among MIT students on their student loans is 1%. As a project you develop a test to predict
which students will default. Your test is good but not perfect. It gives 4% false positives,
i.e. prediciting a student will default who in fact will not. If has a 0% false negative rate,
i.e. prediciting a student won’t default who in fact will.
Solution: Someone offers to bet me the student in part (a) won’t default. They want
me to pay them $100 if the student doesn’t default and they’ll pay me $400 if the student
does default. Is this a good bet for me to take?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Odds(winning) = Odds(𝐷+ |𝑇 + ) =                   −    +
=           =      .
𝑃 (𝐷 |𝑇 )      3.96/4.96   3.96
4
Since the payoff ratio is greater than 1/(odds of winning), it is a good bet.
1
Equivalently we can argue the
1          3.96     4
𝐸[winnings] = 400 ⋅            − 100 ⋅      =      > 0.
4.96         4.96   4.96
A positive expected winnings means it’s a good bet.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Data was taken on height and weight from the entire population of 700
mountain gorillas living in the Democratic Republic of Congo:
ht\\wt    light   average       heavy
short     170       70           30
tall      85      190          155
Let 𝑋 encode the weight, taking the values of a randomly chosen gorilla: 0, 1, 2 for light,
average, and heavy respectively.
Likewise, let 𝑌 encode the height, taking values 0 and 1 for short and tall respectively.
Are 𝑋 and 𝑌 independent?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We check if 𝑃 (𝑋 = 0, 𝑌 = 0) = 𝑃 (𝑋 = 0)𝑃 (𝑌 = 0).
170 ? 255 270
=         .
700   700 700
Cross-multiply and do a little algebra
?                              ?               ?
170 ⋅ 700 = 255 ⋅ 270      ⇔     11900 =        ⇔ 11900 = 68850
Since they are not equal 𝑋 and 𝑌 are not independent.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Data was taken on height and weight from the entire population of 700
mountain gorillas living in the Democratic Republic of Congo:
ht\\wt    light   average       heavy
short     170       70           30
tall      85      190          155
Let 𝑋 encode the weight, taking the values of a randomly chosen gorilla: 0, 1, 2 for light,
average, and heavy respectively.
Likewise, let 𝑌 encode the height, taking values 0 and 1 for short and tall respectively.
Find the correlation of 𝑋 and 𝑌 .
For this part, you need a numerical (no variables) expression, but you can leave it uneval-
uated.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The definition of correlation is Cor(𝑋, 𝑌 ) =              . So we first need to compute
𝜎𝑋 𝜎𝑌
the variances of 𝑋 and 𝑌 .
260     185   1000   10
𝐸[𝑋 2 ] =       +4⋅     =      =
700     700   700    7
Thus,
10    81   433
Var(𝑋) = 𝐸[𝑋 2 ] − 𝐸[𝑋]2 =       −     =
7    100   700
43
𝐸[𝑌 2 ] =
70
2
2      243   43   43 ⋅ 27
Var(𝑌 ) = 𝐸[𝑌 ] − 𝐸[𝑌 ] =    −( ) =
70   70    702
therefore
113/700
Cor(𝑋, 𝑌 ) =
√433/700 √43 ⋅ 27/702
Note: We would accecpt –even encourage solutions– that left the fractions uncomputed,
e.g. 𝜎𝑌 = √43/70 − (43/70)2 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
A political poll is taken to determine the fraction 𝑝 of the population that
would support a referendum requiring all citizens to be fluent in the language of probability
and statistics.
With 𝑝 unknown and 𝑛 the number of random people polled, let 𝑋 𝑛 be the fraction of
the polled people who support the referendum.
What is the smallest sample size 𝑛 in order to have a 90% confidence that 𝑋 𝑛 is within
0.01 of the true value of 𝑝?
Your answer to this problem should be an integer.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The rule of thumb CI is
1
𝑥 ± 𝑧0.05 ⋅ √ .
2 𝑛
𝑧
So we want 0.05
√ ≤ 0.01.
2 𝑛
From the table 𝑧0.05 = Φ(−0.05) = 1.65. So we want
1.65                  √   165
√ ≤ 0.01       ⇒      𝑛≥           ⇒     𝑛 > (82.5)2 = 6806.25
2 𝑛                        2
Solution: 𝑛 = 6807', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Bivariate data (4, 10), (−1, 3), (0, 2) is assumed to arise from the model
𝑦𝑖 = 𝑏|𝑥𝑖 − 3| + 𝑒𝑖 , where 𝑏 is a constant and 𝑒𝑖 are independent random variables.
What assumptions are needed on 𝑒𝑖 so that it makes sense to do a least squares fit of
a curve 𝑦 = 𝑏|𝑥 − 3| to the data?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We assume the random error terms 𝑒𝑖 are independent, have mean 0 and all
have the same variance (homoscedastic).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Taxi problem Data is collected on the time between arrivals of consecutive
taxis at a downtown hotel. We collect a data set of size 45 with sample mean 𝑥 = 5.0 and
sample standard deviation 𝑠 = 4.0.
Assume the data follows a normal random variable.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Since 𝜎 is unknown we use the Studentized mean
𝑥−𝜇
𝑡=     √ ∼ 𝑡(44)
𝑠/ 𝑛
which follows a 𝑡 distribution with 44 degrees of freedom.
𝑠
(i) The 80% CI is 𝑥 ± 𝑡0.1 √ . From the 𝑡-table we get 𝑡0.1 with 𝑑𝑓 = 44 is approximately
𝑛
1.3. Thus,
4
80% CI = 5 ± √ ⋅ 1.3
45
(𝑛 − 1)𝑠2
(ii) We use the statistic             ∼ 𝜒2 (44). The 80% confidence interval for 𝜎2 is
𝜎2
(𝑛 − 1)𝑠2 (𝑛 − 1)𝑠2
[            ,          ],
𝑐0.9      𝑐0.1
where 𝑐0.9 and 𝑐0.1 are the right critical values from the chi-square distribution with 44
degrees of freedom.
(𝑛 − 1)𝑠2 (𝑛 − 1)𝑠2       44 ⋅ 16 44 ⋅ 16
80% CI for 𝜎2 = [               ,          ] = [        ,        ]
56.37     32.49         56.37 32.49
∗      ∗             ∗        ∗', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Taxi problem Data is collected on the time between arrivals of consecutive
taxis at a downtown hotel. We collect a data set of size 45 with sample mean 𝑥 = 5.0 and
sample standard deviation 𝑠 = 4.0.
We suspect that the time between taxis is modeled by an exponential distribution, not
a normal distribution. In this case, are the approaches in the earlier parts justified?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The approach in (b) is fine since it makes no assumptions about the under-
𝑥−𝜇
lying distribution. The approach in (a) is more problematic since √ does not follow a
𝑠/ 𝑛
Student-𝑡 distribution. However for an exponential distribution and 𝑛 = 45 the approxima-
tion is not too bad.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Note. In this problem the geometric(𝑝) distribution is defined as the total
number of trials to the first failure (the value includes the failure), where 𝑝 is the probabilitiy
of success.
Describe how you would use the parametric bootstrap to estimate a 95% basic confidence
interval for 𝑝. You can be brief, but you should give careful step-by-step instructions.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Step 1. Approximate 𝑝 by 𝑝̂ = 1 − 1/𝑥.
Step 2. Generate a bootstrap sample 𝑥∗1 , … , 𝑥∗𝑛 from geom(𝑝).
̂
Step 3. Compute 𝑝∗ = 1 − 1/𝑥∗ and 𝛿 ∗ = 𝑝∗ − 𝑝̂.
Repeat steps 2 and 3 many times (say 104 times.
Step 4. List all the 𝛿 ∗ and find the critical values.
∗
Let 𝛿0.025 = 0.025 critical value = 0.975 quantile.
∗
Let 𝛿0.975 = 0.975 critical value = 0.025 quantile.
∗             ∗
Step 5. The basic bootstrap confidence interval is [𝑝̂ − 𝛿0.025 , 𝑝̂ − 𝛿0.975 ].', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
You independently draw 100 data points from a normal distribution.
Suppose the 100 data points have sample mean 5. What is the 𝑝-value for this data?
Should you reject 𝐻0 ?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : With this data we have 𝑧 = 2/10 = 10. The rejection region is two sided so
𝑝 = 𝑃 (|𝑍| > |𝑧|) = 𝑃 (|𝑍| > 10) = 0.
Yes, since 𝑝 < 𝛼 you should reject 𝐻0 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose that you have molecular type with unknown atomic mass 𝜃. You
have an atomic scale with normally-distributed error of mean 0 and variance 0.5.
Suppose your prior on the atomic mass is N(80, 4). If the scale reads 85, what is your
posterior pdf for the atomic mass?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is a normal/normal conjugate prior/likilihood update.
Hypothesis        Prior        Likelihood          Posterior
2
𝜃            N(80, 4)   𝑓(𝑥|𝜃) ∼ N(𝜃, 0.5)   N(𝜇post , 𝜎post )
We have
1       1           1      1
𝑎=    2
= ,     𝑏=     2
=     = 2.
𝜎prior    4           𝜎     0.5
For the update
𝑎𝜇prior + 𝑏𝑥
𝜇post =
𝑎+𝑏
80/4 + 170     760
=              =     ≈ 84.44
1/4 + 2       9
2        1
𝜎post =
𝑎+𝑏
1       4
=          = ≈ 0.4444
1/4 + 2     9
So, the posterior is
2
𝑓(𝜃 | 𝑥 = 84) ∼ N(𝜇post , 𝜎post ) = N(84.44, 0.4444)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Your friend grabs a die at random from a drawer containing two 6-sided
dice, one 8-sided die, and one 12-sided die. She rolls the die once and reports that the result
is 7.
Make a discrete Bayes table showing the prior, likelihood, and posterior for the type of
die rolled given the data.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝜃 represent the number of sides to the die. The data is 𝑥1 = 7
Hypothesis    prior      likelihood        Bayes numer.                   posterior
𝑝(𝜃)𝑝(𝑥1 = 7 | 𝜃)
𝜃         𝑝(𝜃)     𝑝(𝑥1 = 7 | 𝜃)     𝑝(𝜃)𝑝(𝑥1 = 7 | 𝜃)   𝑝(𝜃 | 𝑥1 = 7) =
𝑝(𝑥1 = 7)
𝜃=6         1/2             0                  0                           0
𝜃=8         1/4           1/8                1/32                         3/5
𝜃 = 12       1/4           1/12               1/48                         2/5
𝑝(𝜃 = 12 | 𝑥1 = 7)   2/5   2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Your friend grabs a die at random from a drawer containing two 6-sided
dice, one 8-sided die, and one 12-sided die. She rolls the die once and reports that the result
is 7.
Given the data of the first roll, what is your probability that the next roll will be a 7?
18.05 Introduction to Probability and Statistics
Spring 2022
For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We extend the table in order to compute the posterior predictive probability.
𝜃       𝑝(𝜃 | 𝑥1 = 7)    𝑝(𝑥2 = 7 | 𝜃)   𝑝(𝜃 | 𝑥1 = 7)𝑝(𝑥2 = 7 | 𝜃)
𝜃=6              0              0                       0
𝜃=8            3/5             1/8                    3/40
𝜃 = 12          2/5            1/12                    2/60
Total                                               13/120
13
The total probability 𝑝(𝑥2 = 7 | 𝑥1 = 7) =            .
120
18.05 Introduction to Probability and Statistics
Spring 2022
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Consider the nucleotides 𝐴, 𝐺, 𝐶, 𝑇 .
How many sequences of length 5 are there where no adjacent nucleotides are the same', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Four ways to fill the first slot and 3 ways to fill each subsequsent slot: 4 ⋅ 34 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
How many ways are there to get a full house (3 of one rank and 2 of another)?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Number of ways to get a full-house: ( )( )( )( )
2  1  3  1
4 13 4 12
( )( )( )( )
2  1    3 1', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(Counting)
Suppose all of these arrangements are written in a list and one is chosen at random.
What is the probability it begins with ‘b’.
Probability
• Sample space, outcome, event, probability function. Rule: 𝑃 (𝐴∪𝐵) = 𝑃 (𝐴)+𝑃 (𝐵)−
𝑃 (𝐴 ∩ 𝐵).
Special case: 𝑃 (𝐴𝑐 ) = 1 − 𝑃 (𝐴)
(𝐴 and 𝐵 disjoint ⇒ 𝑃 (𝐴 ∪ 𝐵) = 𝑃 (𝐴) + 𝑃 (𝐵).)
• Conditional probability, multiplication rule, trees, law of total probability, indepen-
dence
• Bayes’ theorem, base rate fallacy', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Here are two ways to do this problem.
Method 1. Since every arrangement has equal probability of being chosen we simply have
to count the number that start with the letter ‘b’. After putting a ‘b’ in position 1 there
are 10 letters: p, r, o, b, a, i,i, l, t, y, to place in the last 10 positions. We count this in the
same manner as part (a). That is
Choose the position for p: 10 ways.
Choose the positions for r,o,b,a,: 9 ⋅ 8 ⋅ 7 ⋅ 6 ways.
Choose two positions for the two i’s: 5 choose 2 ways.
Choose the position for l: 3 ways.
Choose the position for t: 2 ways.
Choose the position for y: 1 ways.
5            10!
Multiplying this together we get 10⋅9⋅8⋅7 ⋅6⋅( )⋅3⋅2⋅1 =                arrangements start with the
2             2!
10!/2!       2
letter b. Therefore the probability a random arrangement starts with b is                      =
11!/2! ⋅ 2!   11
Method 2. Suppose we build the arrangement by picking a letter for the first position,
then the second position etc. Since there are 11 letters, two of which are b’s we have a 2/11
chance of picking a b for the first letter.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Let 𝐶 and 𝐷 be two events with 𝑃 (𝐶) = 0.3, 𝑃 (𝐷) = 0.4, and 𝑃 (𝐶 𝑐 ∩ 𝐷) =
0.2.
What is 𝑃 (𝐶 ∩ 𝐷)?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐷 is the disjoint union of 𝐷 ∩ 𝐶 and 𝐷 ∩ 𝐶 𝑐 .
So, 𝑃 (𝐷 ∩ 𝐶) + 𝑃 (𝐷 ∩ 𝐶 𝑐 ) = 𝑃 (𝐷). Thus, 𝑃 (𝐷 ∩ 𝐶) = 𝑃 (𝐷) − 𝑃 (𝐷 ∩ 𝐶 𝑐 ) = 0.4 − 0.2 =
0.2.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose we roll a fair die twice. Let 𝐴 be the event ‘the sum of the rolls is 5’
and let 𝐵 be the event ‘at least one of the rolls is 4.’
Calculate 𝑃 (𝐴|𝐵).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Sample space = 𝑆 = {(1, 1), (1, 2), (1, 3), … , (6, 6) } = {(𝑖, 𝑗) | 𝑖, 𝑗 = 1, 2, 3, 4, 5, 6 }.
(Each outcome is equally likely, with probability 1/36.)
𝐴 = {(1, 4), (2, 3), (3, 2), (4, 1)},
𝐵 = {(4, 1), (4, 2), (4, 3), (4, 4), (4, 5), (4, 6), (1, 4), (2, 4), (3, 4), (5, 4), (6, 4) }
𝑃 (𝐴 ∩ 𝐵)    2/36   2
𝑃 (𝐴|𝐵) =              =       = .
𝑃 (𝐵)    11/36  11', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
On a quiz show the contestant is given a multiple choice question with 4
options. Suppose there is a 70% chance the contestant actually knows the answer. If they
don’t know the answer they guess with a 25% chance of getting it right. Suppose they get
it right. What is the probability that they were guessing?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝐶 be the event the contestant gets the question correct and 𝐺 the event the
contestant guessed.
3
The question asks for 𝑃 (𝐺|𝐶).
𝑃 (𝐶|𝐺) 𝑃 (𝐺)
We’ll compute this using Bayes’ rule: 𝑃 (𝐺|𝐶) =                         .
𝑃 (𝐶)
We’re given:    𝑃 (𝐶|𝐺) = 0.25, 𝑃 (𝐾) = 0.7.
Law of total prob.: 𝑃 (𝐶) = 𝑃 (𝐶|𝐺) 𝑃 (𝐺) + 𝑃 (𝐶|𝐺𝑐 ) 𝑃 (𝐺𝑐 ) = 0.25 ⋅ 0.3 + 1.0 ⋅ 0.7 = 0.775
0.075
Therefore 𝑃 (𝐺|𝐶) =         = 0.097 = 9.7%.
0.775', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Compute the expectation and variance of a Bernoulli(𝑝) random variable.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Make a table:
𝑋:           0     1
prob:      (1-p)   p
𝑋2          0     1.
From the table, 𝐸[𝑋] = 0 ⋅ (1 − 𝑝) + 1 ⋅ 𝑝 = 𝑝.
Since 𝑋 and 𝑋 2 have the same table 𝐸[𝑋 2 ] = 𝐸[𝑋] = 𝑝.
Therefore, Var(𝑋) = 𝑝 − 𝑝2 = 𝑝(1 − 𝑝).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose that 𝑋 is a random variable that takes on values 0, 2 and 3 with
probabilities 0.3, 0.1, 0.6 respectively. Let 𝑌 = 3(𝑋 − 1)2 .
What is the expectation of 𝑋?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We first make the probability tables
𝑋        0     2     3
prob.    0.3   0.1   0.6
𝑌        3     3    12
So, 𝐸[𝑋] = 0 ⋅ 0.3 + 2 ⋅ 0.1 + 3 ⋅ 0.6 = 2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose you roll a fair 6-sided die 25 times (independently), and you get $3
every time you roll a 6. Let 𝑋 be the total number of dollars you win.
What is the pmf of 𝑋.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : There are a number of ways to present this. Here’s one:
𝑋 ∼ 3 binomial(25, 1/6), so
25  1 𝑘 5 25−𝑘
𝑃 (𝑋 = 3𝑘) = ( ) ( ) ( )     ,            for 𝑘 = 0, 1, 2, … , 25.
𝑘   6   6', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Suppose you roll a fair 6-sided die 25 times (independently), and you get $3
every time you roll a 6. Let 𝑋 be the total number of dollars you win.
Let 𝑌 be the total won on another 25 independent rolls. Compute and compare 𝐸[𝑋+𝑌 ],
𝐸[2𝑋], Var(𝑋 + 𝑌 ), Var(2𝑋).
Explain briefly why this makes sense.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐸[𝑋 + 𝑌 ] = 𝐸[𝑋] + 𝐸[𝑌 ] = 150/6 = 25., 𝐸[2𝑋] = 2𝐸[𝑋] = 150/6 = 25.
Var(𝑋 + 𝑌 ) = Var(𝑋) + Var(𝑌 ) = 250/4. Var(2𝑋) = 4Var(𝑋) = 500/4.
The means of 𝑋 + 𝑌 and 2𝑋 are the same, but Var(2𝑋) > Var(𝑋 + 𝑌 ).
This makes sense because in 𝑋 + 𝑌 sometimes 𝑋 and 𝑌 will be on opposite sides from the
mean so distances to the mean will tend to cancel, However in 2𝑋 the distance to the mean
is always doubled.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
Correlation
Flip a coin 5 times. Use properties of covariance to compute the covariance and correlation
between the number of heads on the first 3 and last 3 flips.


Distributions with names', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : As usual let 𝑋𝑖 = the number of heads on the 𝑖th flip, i.e. 0 or 1.
Let 𝑋 = 𝑋1 + 𝑋2 + 𝑋3 the sum of the first 3 flips and 𝑌 = 𝑋3 + 𝑋4 + 𝑋5 the sum of the
last 3. Using the algebraic properties of covariance we have
Cov(𝑋, 𝑌 ) = Cov(𝑋1 + 𝑋2 + 𝑋3 , 𝑋3 + 𝑋4 + 𝑋5 )
= Cov(𝑋1 , 𝑋3 ) + Cov(𝑋1 , 𝑋4 ) + Cov(𝑋1 , 𝑋5 )
+ Cov(𝑋2 , 𝑋3 ) + Cov(𝑋2 , 𝑋4 ) + Cov(𝑋2 , 𝑋5 )
+ Cov(𝑋3 , 𝑋3 ) + Cov(𝑋3 , 𝑋4 ) + Cov(𝑋3 , 𝑋5 )
1
Because the 𝑋𝑖 are independent the only non-zero term in the above sum is Cov(𝑋3 𝑋3 ) = Var(𝑋3 ) =
4
Therefore, Cov(𝑋, 𝑌 ) = 14 .
10
We get the correlation by dividing by the standard deviations. Since 𝑋 is the sum of 3
independent Bernoulli(0.5) we have 𝜎𝑋 = √3/4
Cov(𝑋, 𝑌 )    1/4   1
Cor(𝑋, 𝑌 ) =              =       = .
𝜎𝑋 𝜎𝑌      (3)/4  3', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
More Transforming Normal Distributions
Suppose 𝑌 ∼ N(𝜇, 𝜎2 ). Show             follows a standard normal distribution.
𝜎
13', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : By part (a), 𝑌 ∼ N(𝜇, 𝜎2 ) ⇒ 𝑌 = 𝜎𝑍 + 𝜇. But, this implies (𝑌 − 𝜇)/𝜎 = 𝑍 ∼
N(0, 1). QED', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20 pts.) (6 card draw)
You can easily look up the probability of 5 card poker hands, e.g. https://en.wikipedia.
org/wiki/Poker_probability
For this problem, let’s consider hands with 6 cards. Here are two types:
Two-pair: Two cards have one rank, two cards have another rank, and the remaining two
cards have two different ranks. e.g. {2♡, 2♠, 5♡, 5♣, 𝑄♢, 𝐾♢}
Three-of-a-kind: Three cards have one rank and the remaining three cards have three other
ranks. e.g. {2♡, 2♠, 2♣, 5♣, 9♠, 𝐾♡}
Calculate the probability of each type of hand. Which is more probable?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (Reasons below.)
𝑃 (two-pair) = 0.1214, 𝑃 (three-of-a-kind) = 0.03596,     two pairs is more likely
We create each hand by a sequence of actions and use the rule of product to count how
many ways it can be done. (Critically: the number of choices available at each step is
independent of the choices made in the earlier steps.)
two pair
We build a hand with two pair with the following steps.
13
1. Choose 2 ranks –one for each pair: ( ) ways.
2
4 4
2. Choose 2 cards from each chosen rank: 4 cards per suit: ( )( ) ways.
2 2
11
3. Choose 2 of the remaining ranks for the remaining 2 cards in the hand: ( ) ways.
2
4 4
4. Choose 1 card from each of these ranks: ( )( ) ways
1 1
So, the number of hands that are two pair is
13 4 4 11 4 4
(    )( )( )( )( )( ) = 2471040.
2   2 2   2  1 1
We divide this by the total number of hands to get
2471040
𝑃 (two pair) =           ≈ 0.1214,
(52
6)
Note that this gives the probability only because every hand is equally probable.
Three-of-a-kind:
We build a hand with three of a kind with the following steps.
13
1. Choose the rank of the triple: ( ) ways.
1
4
2. Choose 3 cards from the chosen rank: 4 cards per suit: ( ) ways.
3
1
18.05 Problem Set 1, Spring 2022 Solutions                                                 2
12
3. Choose 3 of the remaining ranks for the remaining 3 cards in the hand: (      ) ways.
3
4 4 4
4. Choose 1 card from each of these ranks: ( )( )( ) ways
1 1 1
So, the number of hands that are three of a kind is
13 4 12 4 4 4
(    )( )( )( )( )( ) = 732160.
1   3  3  1 1 1
We divide this by the total number of hands to get
732160
𝑃 (two pair) =          ≈ 0.03596,
(52
6)
Note that this gives the probability only because every hand is equally probable.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(55: 5,5,10,5,10,10,10 pts.) (Birthdays: counting and simulation)
Ignoring leap days, the days of the year can be numbered 1 to 365. Assume that birthdays
are equally likely to fall on any day of the year. Consider a group of 𝑛 people, of which you
are not a member. An element of the sample space 𝑆 will be a sequence of 𝑛 birthdays (one
for each person).
Find an exact formula for 𝑃 (𝐴). What is the smallest 𝑛 such that 𝑃 (𝐴) > 0.5?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : It’s easier to calculate 𝑃 (𝐴𝑐 ). Since there are 364 birthdays that are not mine,
there are 364𝑛 outcomes in 𝐴𝑐 .
364𝑛
𝑃 (𝐴) = 1 − 𝑃 (𝐴𝑐 ) = 1 −         .
365𝑛
We can find the size of the group needed for 𝑃 (𝐴) > 0.5 by trial and error, plugging in
different values of 𝑛. Or we can set 𝑃 (𝐴) = 0.5 and solve for 𝑛.
𝑛
364𝑛           364                    364
1−        = 0.5 ⇒ (     ) = 0.5 ⇒ 𝑛 ⋅ ln (     ) = ln(0.5) ⇒ 𝑛 ≈ 252.65
365𝑛           365                    365
So there needs to be at least 253 people for it to be more likely than not that one of them
shares your birthday.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(55: 5,5,10,5,10,10,10 pts.) (Birthdays: counting and simulation)
Ignoring leap days, the days of the year can be numbered 1 to 365. Assume that birthdays
are equally likely to fall on any day of the year. Consider a group of 𝑛 people, of which you
are not a member. An element of the sample space 𝑆 will be a sequence of 𝑛 birthdays (one
for each person).
Use R simulation to estimate the smallest 𝑛 for which 𝑃 (𝐵) > 0.9. For these simulations,
let the number of trials be 10000. (You can reuse your code from Studio 1.)
For this value of 𝑛, repeat the simulation a few times to verify that it always gives similar
results.
Using 10000 trials you saw very little variation in the estimate of 𝑃 (𝐵). Try this again
using 30 trials and verify that the estimated probabilities are much more variable. On your
pset, give the results 7 runs of 30 trials using the value of 𝑛 you just found.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Here’s the R code I ran to estimate 𝑃 (𝐵).
# colMatches is an 18.05 function. It needs to be in the R working directory
# You can find the file mit18_05_s22_colMatches.r on our class website.
source(\'mit18_05_s22_colMatches.r\')
18.05 Problem Set 1, Spring 2022 Solutions                                                   5
# Set up the parameters
ndays = 365
npeople = 20
ntrials = 10000
size_match = 2
year = 1:ndays
# Run ntrials -one per column- using sample() and matrix()
y = sample(year, npeople*ntrials, replace=TRUE)
trials = matrix(y, nrow=npeople, ncol=ntrials)
w = colMatches(trials, size_match)
prob_B = mean(w)
print(prob_B)
I ran the code with various values of npeople. Here is a table of the estimated values of
𝑃 (𝐵).
npeople    𝑃 (𝐵) (multiple values means multiple runs of the code)
20         0.4123
30         0.7007
40         0.8913, 0.8867, 0.8926, 0.8865
41         0.9005, 0.9003, 0.9037, 0.9006, 0.903
We see that the estimated probability of B is consistently less than 0.9 for npeople = 40
and consistently greater than 0.9 for npeople = 41. Therefore: Answer: 41.
When we run the code with ntrials = 30 and npeople = 41 we get the following estimates
for 𝑃 (𝐵).
0.9333, 0.9333, 0.9, 0.8333, 0.9333, 0.8, 1
This is certainly much more variable than the estimates in in the table above.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(55: 5,5,10,5,10,10,10 pts.) (Birthdays: counting and simulation)
Ignoring leap days, the days of the year can be numbered 1 to 365. Assume that birthdays
are equally likely to fall on any day of the year. Consider a group of 𝑛 people, of which you
are not a member. An element of the sample space 𝑆 will be a sequence of 𝑛 birthdays (one
for each person).
Use R simulation to estimate the smallest 𝑛 for which 𝑃 (𝐶) > 0.5. Again use 10000
trials. You will find that two adjacent values of 𝑛 are equally plausible based on simulations.
You may pick either one for your answer.
Note that it is much harder to find an exact formula for 𝑃 (𝐶), so simulation is especially
handy.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : To estimate 𝑃 (𝐶) we used the same code as in part (e), except we set size_match
= 3. Here is the table of (estimated) probabilities we found.
18.05 Problem Set 1, Spring 2022 Solutions                                          6
npeople   𝑃 (𝐶) (multiple values means multiple runs of the code)
20        0.0121
30        0.0293
50        0.1274
80        0.4241
90        0.5389
85        0.4832
86        0.4841
87        0.502, 0.4989, 0.4909, 0.5035
88        0.5081, 0.5115, 0.5149, 0.5071
The estimates for 87 are sometimes above and sometimes below 0.5. So the answer to the
question is either 87 or 88. It seems certain that with 88 people 𝑃 (𝐶) > 0.5.
18.05 Introduction to Probability and Statistics
Spring 2022
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 10,10 pts.) (‘Binary’ paradox)
For this problem assume that puppies are equally probable to be male or female. Likewise
for kittens.
Be sure to carefully justify your answers.
Our cat Ariel had two kittens. At least one of them is male. What is the probability
that both kittens are males?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The event “at least one kitten is male” is {𝑀 𝑀 , 𝑀 𝐹 , 𝐹 𝑀 } so the probability
that both kittens are male is
𝑃 (𝑀 𝑀 )           1/4  1
𝑃 (𝑀 𝑀 |{𝑀 𝑀 , 𝑀 𝐹 , 𝐹 𝑀 }) =                            =     = .
𝑃 ({𝑀 𝑀 , 𝑀 𝐹 , 𝐹 𝑀 })   3/4  3', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20 pts.) (Trees of cards) There are 8 cards in a hat:

                             {1♡, 1♠, 1♢, 1♣, 2♡, 2♠, 2♢, 2♣}

You draw one card at random. If its rank is 1 you draw one more card; if its rank is two
you draw two more cards. Let 𝑋 be the sum of the ranks on the 2 or 3 cards drawn. Find
𝐸[𝑋]. (Note: all the draws are done without replacement.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The following tree shows all the possible ways we can draw cards. The first draw
is the top row of nodes. The value of the draw is given in the circle. The probability of
that draw is given along the edge. Likewise for the second and third draws. At the end of
each path we give the value of 𝑋 resulting from those draws.
18.05 Problem Set 2, Spring 2022 Solutions                                                     3
4/8                 4/8
1                                              2
3/7             4/7                             4/7            3/7
1                      2                        1                        2
𝑋=2                    𝑋=3
3/6           3/6       4/6          2/6
1            2           1            2
𝑋=4          𝑋=5         𝑋=5          𝑋=6
This gives us the probability distribution of 𝑋:
value 𝑥     2         3       4       5     6
pmf 𝑝(𝑥)   3/14      2/7     1/7     2/7   1/14
So,
3     2   1   2    1    26
𝐸[𝑋] = 2 ⋅        +3⋅ +4⋅ +5⋅ +6⋅    =    ≈ 3.7143.
14    7   7   7    14   7', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 5,10,5,5 pts.) (Dice) There are four dice in a drawer: one D4 (4 sides),
one D6 (6-sides), and two D8 (8 sides). As usual, the sides of a die are numbered 1 to 𝑛,
where 𝑛 is the number of sides.
Your friend secretly grabs one of the four dice at random. Let 𝑆 be the number of sides on
the chosen die.
Now, without showing it to you, your friend rolls the chosen die and tells you the result.
Let 𝑅 be the result of the roll.
Use Bayes’ rule to find 𝑃 (𝑆 = 𝑠 | 𝑅 = 3) for 𝑠 = 4, 6, 8. Which die is most likely if 𝑅 = 3?
Terminology: You are computing the pmf of ‘𝑆 given 𝑅 = 3’.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Bayes’ rule says
𝑃 (𝑅 = 3 | 𝑆 = 𝑠)𝑃 (𝑆 = 𝑠)
𝑃 (𝑆 = 𝑠|𝑅 = 3) =                                 .
𝑃 (𝑅 = 3)
We summarize what we know in a tree. In the tree the notation 𝐷4 means the 4-sided die
(𝑆 = 4), likewise 𝑅3 means a 3 was rolled (𝑅 = 3). Because we only care about the case
𝑅 = 3 the tree does not include other possible rolls.
1/4     1/4          1/2
Chosen die              𝐷4              𝐷6                  𝐷8
1/4             1/6                 1/8
Roll result
𝑅3               𝑅3             𝑅3
18.05 Problem Set 2, Spring 2022 Solutions                                                     4
We have the following probabilities (you should identify them in the tree):
𝑃 (𝑅 = 3 | 𝑆 = 4) = 1/4,    𝑃 (𝑅 = 3 | 𝑆 = 6) = 1/6,    𝑃 (𝑅 = 3 | 𝑆 = 8) = 1/8.
The law of total probability gives (again, see how the tree tells us this):
𝑃 (𝑅 = 3) = 𝑃 (𝑅 = 3 | 𝑆 = 4)𝑃 (𝑆 = 4) + 𝑃 (𝑅 = 3 | 𝑆 = 6)𝑃 (𝑆 = 6) + 𝑃 (𝑅 = 3 | 𝑆 = 8)𝑃 (𝑆 = 8)
1 1 1 1 1 1
= ⋅ + ⋅ + ⋅
4 4 6 4 8 2
1
= .
6
Hence,
𝑃 (𝑅 = 3 | 𝑆 = 4) ⋅ 𝑃 (𝑆 = 4) (1/4) ⋅ (1/4)   3
𝑃 (𝑆 = 4 | 𝑅 = 3) =                                =              =
𝑃 (𝑅 = 3)                1/6         8
𝑃 (𝑅 = 3 | 𝑆 = 6) ⋅ 𝑃 (𝑆 = 6) (1/6) ⋅ (1/4)   1
𝑃 (𝑆 = 6 | 𝑅 = 3) =                                =              =
𝑃 (𝑅 = 3)                1/6         4
𝑃 (𝑅 = 3 | 𝑆 = 8) ⋅ 𝑃 (𝑆 = 8) (1/8) ⋅ (1/2)   3
𝑃 (𝑆 = 8 | 𝑅 = 3) =                                =              =   .
𝑃 (𝑅 = 3)                1/6         8
We see that the 4 and 8 sided dice are equally most likely given 𝑅 = 3.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 5,10,5,5 pts.) (Dice) There are four dice in a drawer: one D4 (4 sides),
one D6 (6-sides), and two D8 (8 sides). As usual, the sides of a die are numbered 1 to 𝑛,
where 𝑛 is the number of sides.
Your friend secretly grabs one of the four dice at random. Let 𝑆 be the number of sides on
the chosen die.
Which die is most likely if 𝑅 = 7? No computations are needed!', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The only way to get 𝑅 = 7 is if we picked an 8-sided die D8.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 3,2,10,5 pts.)
In this problem we will use R to simulate flipping a fair coin 50 times. We’ll use the
simulation to explore ‘runs’. That is, sequences of all 1’s or 0’s.
Make up a sequence of length 50 consisting of ones and zeros. Try to make the sequence
look like it was randomly generated by flipping a coin.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Any sequence of 50 zeros and ones is valid.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 3,2,10,5 pts.)
In this problem we will use R to simulate flipping a fair coin 50 times. We’ll use the
simulation to explore ‘runs’. That is, sequences of all 1’s or 0’s.
A small modification of your code will let you estimate the probability of a run of 8 or
more in 50 flips. Do this three times with 10000 trials each time. Report the three results.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Instead of keeping a total we keep a count of the number of trials with a run of
8 or more
nflips = 50
ntrials = 10000
# We\'ll keep count of all the trials with a run of 8 or more
count = 0
for (j in 1:ntrials) {
trial = rbinom(nflips, 1, 0.5) # binomial(1, 0.5) = bernoulli(0.5)
count = count + (max(rle(trial)$lengths) >= 8)
}
# The probability of a run of 8 or more is count/ntrials
prob8 = count/ntrials
print(prob8)
My run of this code produced prob8 = 0.1596, 0.1637, 0.1632
18.05 Introduction to Probability and Statistics
Spring 2022
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 10,5,10 pts.) Independence
Three events 𝐴, 𝐵, and 𝐶 are pairwise independent if each pair is independent. They are
mutually independent if they are pairwise independent and if, in addition,
𝑃 (𝐴 ∩ 𝐵 ∩ 𝐶) = 𝑃 (𝐴)𝑃 (𝐵)𝑃 (𝐶).                                (1)
Consider the Venn diagram below. 𝐴, 𝐵 and 𝐶 are the overlapping circles and the
probabilities of each region are as marked. Does equation (1) hold. Are the events 𝐴, 𝐵, 𝐶
mutually independent?
𝐴                                 𝐵
0.225     0.05     0.225
0.125
0.1           0.1
0.175
𝐶
1
18.05 Problem Set 3, Spring 2022 Solutions                                                  2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We start by totaling the probabilities in the regions shown to get the following
probabilities.
𝑃 (𝐴) = 0.225 + 0.05 + 0.1 + 0.125 = 0.5,      𝑃 (𝐵) = 0.225 + 0.05 + 0.1 + 0.125 = 0.5
𝑃 (𝐶) = 0.175 + 0.1 + 0.1 + 0.125 = 0.5,       𝑃 (𝐴 ∩ 𝐵) = 0.05 + 0.125 = 0.175
𝑃 (𝐴 ∩ 𝐶) = 0.1 + 0.125 = 0.225,               𝑃 (𝐵 ∩ 𝐶) = 0.1 + 0.125 = 0.225
𝑃 (𝐴 ∩ 𝐵 ∩ 𝐶) = 0.125
We see that 𝑃 (𝐴)𝑃 (𝐵)𝑃 (𝐶) = 0.5 ⋅ 0.5 ⋅ 0.5 = 0.125 = 𝑃 (𝐴 ∩ 𝐵 ∩ 𝐶). So, yes, equation (1)
holds.
But, 𝑃 (𝐴)𝑃 (𝐵) = 0.5⋅0.5 = 0.25 ≠ 𝑃 (𝐴∩𝐵). Since, mutual independence requires pairwise
independence as well as the multiplication formula for all three events, we see that the three
events are not independent. (Likewise 𝑃 (𝐴)𝑃 (𝐶) ≠ 𝑃 (𝐴∩𝐶) and 𝑃 (𝐵)𝑃 (𝐶) ≠ 𝑃 (𝐵∩𝐶).)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 10,10,10 pts.) Dice
Let 𝑋 be the result of rolling a fair 4-sided die. Let 𝑌 be the result of rolling a fair 6-sided
die. Let 𝑍 be the average of 𝑋 and 𝑌 .
Find the standard deviation of 𝑋, of 𝑌 , and of 𝑍.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We compute Var(𝑋) = 𝐸[𝑋 2 ] − 𝐸[𝑋]2 etc. from the tables.
𝑋     1      2      3                   4             𝑌           1         2         3      4     5     6
𝑝(𝑥)   1/4    1/4    1/4                 1/4          𝑝(𝑦)         1/6       1/6       1/6   1/6   1/6   1/6
𝑋2     1      4      9                  16            𝑌2           1         4         9     16    25    36
So, 𝐸[𝑋] = 14 (1 + 2 + 3 + 4) = 52 , 𝐸[𝑋 2 ] = 14 (1 + 4 + 9 + 16) = 15
2 . Thus,
Var(𝑋) = 𝐸[𝑋 2 ] − 𝐸[𝑋]2 = 5/4.
Similarly, 𝐸[𝑌 ] = 72 , 𝐸[𝑌 2 ] = 91
6 .                 So, Var(𝑌 ) = 35
12 .
Since 𝑋 and 𝑌 are independent,
𝑋+𝑌        1                  25
Var(𝑍) = Var (     ) = (Var(𝑋) + Var(𝑌 )) = .
2        4                  24
Taking the square root of the variances we get:
√
𝜎𝑋 = 5/2 ≈ 1.118           𝜎𝑌 = √35/12 ≈ 1.708     𝜎𝑍 = √25/24 ≈ 1.021
18.05 Problem Set 3, Spring 2022 Solutions                                                                                   5', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 10,10,10 pts.) Dice
Let 𝑋 be the result of rolling a fair 4-sided die. Let 𝑌 be the result of rolling a fair 6-sided
die. Let 𝑍 be the average of 𝑋 and 𝑌 .
Here is a gambling game: You win 2𝑋 dollars if 𝑋 > 𝑌 and lose 1 dollar otherwise. After
playing this game 60 times, what is your expected total gain (positive) or loss (negative)?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We see that the only pairs of (𝑋, 𝑌 ) which satisfy 𝑋 > 𝑌 are {(2, 1), (3, 1), (3, 2), (4, 1), (4, 2), (4, 3)} .
6
So 𝑃 (𝑋 > 𝑌 ) = 24 . Let 𝑊 be the amount won in one gaime. Again, since each (𝑋, 𝑌 ) pair
has probability 1/24, 𝑊 has the probability table
𝑊       4        6      8      -1
𝑝(𝑤)    1/24     2/24   3/24   18/24
1       2        3      18    22    11
So 𝐸[𝑊 ] = 4 ⋅    +6⋅      +8⋅     −1⋅     =     =
24      24       24      24    24    12
Now if you played the game 60 times, and received winnings 𝑊1 , … , 𝑊60 , (with 𝐸[𝑊𝑖 ] = 11
12 ),
your expected total gain is
11
𝐸[𝑊1 + ⋯ + 𝑊60 ] = 𝐸[𝑊1 ] + ⋯ + 𝐸[𝑊60 ] = 60 ⋅           = 55.
12
18.05 Problem Set 3, Spring 2022 Solutions                                                                                   6', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 5,5,5,5 pts.) Two scoops
Boxes of Raisin Bran cereal are 30cm tall. Due to settling, boxes have a higher density of
raisins at the bottom (ℎ = 0) than at the top (ℎ = 30). Suppose the density (in raisins per
cm of height) is given by 𝑓(ℎ) = 40 − ℎ.
Let 𝐻 be the height of a random raisin. Find and graph the pdf 𝑔(ℎ) of 𝐻.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The probability density is just the actual density divided by the total number
1
of raisins. 𝑔(ℎ) = 750 (40 − ℎ).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 5,5,5,5 pts.) Two scoops
Boxes of Raisin Bran cereal are 30cm tall. Due to settling, boxes have a higher density of
raisins at the bottom (ℎ = 0) than at the top (ℎ = 30). Suppose the density (in raisins per
cm of height) is given by 𝑓(ℎ) = 40 − ℎ.
What is the probability that a random raisin is in the bottom third of the box?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Since the height is 30 we need to find 𝑃 (𝐻 ≤ 10).
10                              10
1                                        7                             400 100   7
𝑃 (𝐻 ≤ 10) = ∫                𝑔(ℎ)𝑑ℎ =       ∫                (40 − ℎ)𝑑ℎ =             . Or, 𝑃 (𝐻 ≤ 10) = 𝐺(10) =    −     = .
0                    750 0                                     15                            750 1500  15', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 5,5,10 pts.) Gallery of continuous random variables.
The pnorm() function on R gives the cdf of the normal distribution, e,g, if 𝑋 ∼ N(𝜇, 𝜎2 )
then pnorm(𝑥, 𝜇, 𝜎) = 𝑃 (𝑋 ≤ 𝑥) = 𝐹𝑋 (𝑥).
Let 𝑋 ∼ N(𝜇, 𝜎2 ) where 𝜇 = 2 and 𝜎 = 3. Use R to compute
(i) 𝑃 (𝑋 ≤ 𝜇),      (ii) 𝑃 (𝑋 − 𝜇 > 1.5𝜎)                    (iii) 𝑃 (|𝑋 − 𝜇| < 1.5𝜎).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The trick you were supposed to notice is that these answers are identical to the
ones in part (a). This is because 𝑍 = (𝑋 − 𝜇)/𝜎 is standard normal. In the R code below
mu = 2, sigma = 3
(i) 𝑃 (𝑋 ≤ 𝜇) = pnorm(mu, mu, sigma) = 0.5.
(ii) 𝑃 (𝑋 − 𝜇 > 1.5 ∗ 𝜎) = 𝑃 (𝑋 > 𝜇 + 1.5 ∗ 𝜎) = 1 - pnorm(mu + 1.5*sigma, mu, sigma)
= 0.0668072.
(iii) 𝑃 (|𝑋 −𝜇| < 1.5∗𝜎) = 𝑃 (𝑋 < 𝜇+1.5∗𝜎)−𝑃 (𝑋 < 𝜇−1.5𝜎) = pnorm(mu + 1.5*sigma,
mu, sigma) - pnorm(mu - 1.5*sigma, mu, sigma) = 0.8663856.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 5,5,5,5 pts.) Birth day
The length of human gestation is well-approximated by a normal distribution with mean
𝜇 = 280 days and standard deviation 𝜎 = 8.5 days.
Graph the corresponding pdf and cdf. You should do this using the dnorm, pnorm and
plot commands in R. Print the results and turn them in with the pset.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Suppose 𝑌 ∼ 𝑁 (280, 8.5). The pdf, 𝑓(𝑦) and cdf 𝐹 (𝑦) are plotted below.
PDF: f(x) vs. x                                           CDF: F(x) vs x
1.0
0.8
0.04
0.6
F
f
0.02
0.4
0.2
0.00
0.0
250   260    270   280   290   300                        250   260    270   280   290   300
x                                                         x', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 5,5,5,5 pts.) Birth day
The length of human gestation is well-approximated by a normal distribution with mean
𝜇 = 280 days and standard deviation 𝜎 = 8.5 days.
Find the probability she will give birth in May sometime after the exam. (Assume this
means from the start of May 19 to the end of May 31.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We want the probability that the baby is born between May 19 (𝑋 = −6) and
May 31 (𝑋 = 6). We compute
6       6
𝑃 (−6 ≤ 𝑋 ≤ 6) = 𝑃 (−         ≤𝑍≤     ) ≈ 0.520
8.5     8.5
Again there is some ambiguity about the range. We’ll accept any reasonable choice.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 5,5,10,5 pts.) Time to failure
Recall that an exponential random variable 𝑋 ∼ exp(𝜆) has pdf given by 𝑓(𝑥) = 𝜆𝑒−𝜆𝑥 on
𝑥 ≥ 0.
Compute 𝑃 (𝑋 ≥ 𝑥).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑥
𝑃 (𝑋 ≥ 𝑥) = 1 − 𝑃 (𝑋 < 𝑥) = 1 − ∫ 𝜆e−𝜆𝑥 𝑑𝑥 = 1 − (1 − e−𝜆𝑥 ) = e−𝜆𝑥 .
0', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 5,5,10,5 pts.) Time to failure
Recall that an exponential random variable 𝑋 ∼ exp(𝜆) has pdf given by 𝑓(𝑥) = 𝜆𝑒−𝜆𝑥 on
𝑥 ≥ 0.
Suppose we are testing 3 different brands of light bulbs 𝐵1 , 𝐵2 , and 𝐵3 whose lifetimes
are exponential random variables with mean 1/2, 1/3, and 1/5 years, respectively. Assuming
1
18.05 Problem Set 4, Spring 2022 Solutions                                                  2
that all of the bulbs are independent, what is the expected time before one of the bulb fails.
(Hint: part (c) was a warmup for this problem.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑋1 , 𝑋2 , and 𝑋3 be the lifetimes of bulbs 𝐵1 , 𝐵2 and 𝐵3 , respectively. Then
we know 𝑋1 ∼ exp(2), 𝑋2 ∼ exp(3), 𝑋3 ∼ exp(5). Let 𝑇 = min(𝑋1 , 𝑋2 , 𝑋3 ). Then 𝑇 is the
time to the first failure of a bulb. Following the same argument as in (c), we have
𝑃 (𝑇 ≥ 𝑡) = 𝑃 (𝑋1 ≥ 𝑡)𝑃 (𝑋2 ≥ 𝑡)𝑃 (𝑋3 ≥ 𝑡) = e−10𝑡 .
Thus, the cdf of 𝑇 is 𝐹𝑇 (𝑡) = 1 − 𝑒−10𝑡 and the pdf, 𝑓𝑇 (𝑡) is given by
𝑓𝑇 (𝑡) = 𝐹𝑇′ (𝑡) = 10𝑒−10𝑡 .
1
We found that 𝑇 ∼ exp(10). Therefore, 𝐸[𝑇 ] = 10 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 10,10 pts.) Elections
To head the newly formed US Dept. of Statistics, suppose that 50% of the population
supports Alessandre, 20% supports Sarah, and the rest are split between Gabriel, Sarah and
So Hee. A poll asks 400 random people who they support.
Use the central limit theorem to estimate the probability that less than 31% of those
polled prefer Gabriel, Sarah or So Hee?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Now let 𝑌𝑖 = 1 if person 𝑖 prefers one of Gabriel, Sarah or So Hee and 0
otherwise. We have 𝑌1 , … , 𝑌400 are independent Bern(0.3). So 𝐸[𝑌𝑖 ] = 𝜇 = 0.3 and
1
Var(𝑌𝑖 ) = (0.3)(0.7) = 0.21. If 𝑌 = 400 (𝑌1 + ⋯ + 𝑌400 ), the Central Limit Theorem tells us
√
𝑌 −𝜇    (𝑌 − 0.3) 400
√    =     √
𝜎/ 400         0.21
18.05 Problem Set 4, Spring 2022 Solutions                                                   3
is approximately standard normal. Thus, using 𝑍 for a standard normal random variable,
√
(0.31 − 0.3) 400
𝑃 (𝑌 ≤ 0.31) ≈ 𝑃 (𝑍 <       √          ) = 𝑃 (𝑍 < 0.4364358) ≈ 0.67.
0.21', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 10,10,10 pts.) Change of scale.
In this problem we will look at scaling random variables. This is a simple, but common
thing to do. As usual with transformations, if you don’t approach it systematically, it is
easy to make mistakes.
For the random variable 𝑋 from part (a), find the range and pdf of 𝑊 = 𝑎𝑋 + 𝑏, where
𝑎 and 𝑏 are constants. Assume 𝑎 > 0.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We find the range and pdf by following the same pattern as in part (a). The
range of 𝑊 is [𝑏, ∞).
𝑤−𝑏          𝑤−𝑏
𝐹𝑊 (𝑤) = 𝑃 (𝑊 ≤ 𝑤) = 𝑃 (𝑎𝑋 + 𝑏 ≤ 𝑤) = 𝑃 (𝑋 ≤              ) = 𝐹𝑋 (     ).
𝑎            𝑎
Taking the derivative:
𝑑           𝑑      𝑤−𝑏    1 ′ 𝑤−𝑏     1    𝑤−𝑏
𝑓𝑊 (𝑤) =       𝐹𝑊 (𝑤) =    𝐹𝑋 (     ) = 𝐹𝑋 (   ) = 𝑓𝑋 (     ).
𝑑𝑤          𝑑𝑤       𝑎     𝑎     𝑎     𝑎     𝑎
Since we know 𝑓𝑋 ( 𝑤−𝑏
𝑎 )=e
−(𝑤−𝑏)/𝑎
, we have
1 −(𝑤−𝑏)/𝑎
𝑓𝑊 (𝑤) =     e        for 𝑤 between 𝑏 and ∞.
𝑎', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 10,10,10 pts.) In this problem we will explore how the transformations in
the previous problem affect the mean and median.
For the variables 𝑋, 𝑌 , 𝑊 in the previous problem, assume each of the variables are
given in units of minutes. Find the expected value, variance and standard deviation of each
variable. Be sure to include units in your answer.
What are the units on 𝑎 and 𝑏 in the defnition of 𝑊 ?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Since 𝑋 ∼ Exponential(1) we know
𝐸[𝑋] = 1 min., Var(𝑋) = 1 min.2 , 𝜎𝑋 = 1 min.
Since expected value is linear,
𝐸[𝑌 ] = 𝐸[3𝑋] = 3𝐸[𝑋] = 3 min.,     𝐸[𝑊 ] = 𝑎𝐸[𝑋] + 𝑏 = (𝑎 + 𝑏) min.
Likewise, the variance is invariant under translation and scales by the square of the multi-
plier:
Var(𝑌 ) = 9 ⋅ Var(𝑋) = 9 min.2 ,   𝜎𝑌 = 3 min.,
Var(𝑊 ) = 𝑎2 ⋅ Var(𝑋) = 𝑎2 min.2 ,    𝜎𝑊 = 𝑎 min..
18.05 Problem Set 4, Spring 2022 Solutions                                                 6
Because both 𝑋 and 𝑊 are in units of minutes, 𝑎 must be dimensionless and 𝑏 has units of
minutes.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 10,10,10 pts.) In this problem we will explore how the transformations in
the previous problem affect the mean and median.
Compute the median value of both 𝑋 and 𝑉 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : For 𝑋, the median value is the value 𝑞0.5 such that 𝐹𝑋 (𝑞0.5 ) = 0.5. Now,
𝑞              𝑞
𝑞
𝐹𝑋 (𝑞) = ∫ 𝑓𝑋 (𝑥) 𝑑𝑥 = ∫ e−𝑥 𝑑𝑥 = −e−𝑥 |0 = 1 − e−𝑞 .
0              0
Solving 1 − e−𝑞 = 0.5 gives the median of 𝑋 is 𝑞0.5 = ln(2) .
Since as we saw in the previous problem, 𝐹𝑉 (𝑣) = 𝐹𝑋 (𝑣1/3 ), we have
𝐹𝑉 (𝑣) = 0.5 ⇔ 𝐹𝑋 (𝑣1/3 ) = 0.5 ⇔ 𝑣1/3 = 𝑞0.5 .
That is, the median of 𝑉 = 𝑋 3 is just (the median of 𝑋)3 , i.e. ln(2)3 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 5,5,10,10 pts.) Fat tails
This problem will explore the tails of two distributions. The tails are important when we
want to think about probabilities of extreme events.
Now, in order to be able to use R or Wolfram Alpha without a lot of distracting algebraic
manipulation, we’ll√modify the definition of IQ. Suppose that Modified_IQ has mean 0 and
standard deviation 3.
Assuming Modified_IQ is normally distributed, find the probability that a randomly chosen
person has Modified_IQ more than 4 standard deviations above the mean.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : One of the important facts about normal distributions, is that, when measured
in standard deviations above the mean they all give the same probabilities. That is, the
answer is exactly the same as in part (a)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(35: 5,10,5,10,5 pts.) Aching joints
Suppose 𝑋 and 𝑌 have joint pdf 𝑓(𝑥, 𝑦) = 𝑐(𝑥2 + 𝑥𝑦) on [0, 1] × [0, 1].
Find the marginal cumulative distribution functions 𝐹𝑋 and 𝐹𝑦 and the marginal pdf
𝑓𝑋 and 𝑓𝑌 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The marginal cdf’s are:
12 𝑥3 𝑥2
𝐹𝑋 (𝑥) = 𝐹 (𝑥, 1) =         ( + )
7  3  4
12 𝑦 𝑦2
𝐹𝑌 (𝑦) = 𝐹 (1, 𝑦) =     ( + ).
7 3  4
The marginal pdf’s are found by differentiating the marginal cdf:
12 2 𝑥                            12 1 𝑦
𝑓𝑋 (𝑥) =      (𝑥 + )               𝑓𝑌 (𝑦) =     ( + ).
7     2                           7 3 2
We could also have found them by integrating the joint pdf:
1                                                                      1
12 2 𝑥                                            12 1 𝑦
𝑓𝑋 (𝑥) = ∫ 𝑓(𝑥, 𝑦) 𝑑𝑦 =                         (𝑥 + )                𝑓𝑌 (𝑦) = ∫ 𝑓(𝑥, 𝑦) 𝑑𝑥 =     ( + ).
0                                   7     2                            0              7 3 2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(35: 5,10,5,10,5 pts.) Aching joints
Suppose 𝑋 and 𝑌 have joint pdf 𝑓(𝑥, 𝑦) = 𝑐(𝑥2 + 𝑥𝑦) on [0, 1] × [0, 1].
Find the covariance and correlation of 𝑋 and 𝑌 .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : First we’ll need 𝐸[𝑌 ] and Var[𝑌 ]. The computations are similar to those in part
(c).
1                       1
12      1 𝑦      4
𝐸[𝑌 ] = ∫ 𝑦𝑓𝑌 (𝑦) 𝑑𝑦 =                     ∫ 𝑦 ( + ) 𝑑𝑦 = ≈ 0.5714
0                    7 0     3 2      7
1                  1
12       1 𝑦       17
𝐸[𝑌 2 ] = ∫ 𝑦2 𝑓𝑌 (𝑦) =                ∫ 𝑦2 ( + ) 𝑑𝑦 =    ≈ 0.4048
0               7 0      3 2       42
Var(𝑌 ) = 𝐸[𝑌 2 ] − 𝐸[𝑌 ]2 ≈ 0.0782
Now, covariance is defined as Cov(𝑋, 𝑌 ) = 𝐸[(𝑋 − 𝜇𝑥 )(𝑌 − 𝜇𝑌 )]. We could compute this
directly, but it’s slightly easier to use the formula Cov(𝑋, 𝑌 ) = 𝐸[𝑋𝑌 ] − 𝐸[𝑋]𝐸[𝑌 ].
1       1                                   1        1
12                          17
𝐸[𝑋𝑌 ] = ∫ ∫ 𝑥𝑦𝑓(𝑥, 𝑦) 𝑑𝑦 𝑑𝑥 =                       ∫ ∫ 𝑥3 𝑦 + 𝑥2 𝑦2 𝑑𝑦 𝑑𝑥 =    ≈ 0.4048
0       0                              7 0 0                       42
Cov(𝑋, 𝑌 ) = 𝐸[𝑋𝑌 ] − 𝐸[𝑋]𝐸[𝑌 ] ≈ −0.0034
Cov(𝑋, 𝑌 )
Cor(𝑋, 𝑌 ) =            = −0.0561
𝜎𝑋 𝜎𝑌', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 10,10 pts.) Correlation
Suppose 𝑋 and 𝑌 are random variables with
1                                  1
𝑃 (𝑋 = 1) = 𝑃 (𝑋 = −1) = ;         𝑃 (𝑌 = 1) = 𝑃 (𝑌 = −1) = .
2                                  2
Let 𝑐 = 𝑃 (𝑋 = 1 and 𝑌 = 1).
Determine the joint distribution of 𝑋 and 𝑌 , Cov(𝑋, 𝑌 ), and Cor(𝑋, 𝑌 ).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We make the joint distribution table by starting with the marginal distributions
and putting 𝑐 in the 𝑋 = 1, 𝑌 = 1 cell. The other three cells in the table are then
determined.
𝑋\\𝑌       1      −1    𝑝(𝑥)
1       𝑐    0.5 − 𝑐 0.5
−1    0.5 − 𝑐    𝑐     0.5
𝑝(𝑦)    0.5      0.5     1
We easily compute:    𝐸[𝑋] = 0, 𝐸[𝑌 ] = 0, Var(𝑋) = 1, Var(𝑌 ) = 1. Computing directly:
𝐸[𝑋𝑌 ] = (1 ⋅ 1)𝑐 + (−1 ⋅ 1)(0.5 − 𝑐) + (1 ⋅ −1)(0.5 − 𝑐) + (−1 ⋅ −1)𝑐
= 4𝑐 − 1
Thus,
Cov(𝑋, 𝑌 ) = 𝐸[𝑋𝑌 ] − 𝐸[𝑋]𝐸[𝑌 ] = 4𝑐 − 1
Cor(𝑋, 𝑌 )
Cor(𝑋, 𝑌 ) =            = 4𝑐 − 1.
𝜎𝑋 𝜎𝑌', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(40: 5,5,10,10,10 pts.) Don’t be late!
Alicia and Bernardo are trying to meet for lunch and both will arrive, independently of each
other, uniformly and at random between noon and 1pm. Let 𝐴 and 𝐵 be the number of
minutes after noon at which Alicia and Bernardo arrive, respectively. Then 𝐴 and 𝐵 are
independent uniformly distributed random variables on [0, 60].
18.05 Problem Set 5, Spring 2022 Solutions                                                      4
Hint: For parts (c-e) you might find it easiest to find the fraction of the square [0, 60]×[0, 60]
filled by the event.
Find the joint pdf 𝑓(𝑎, 𝑏) and joint cdf 𝐹 (𝑎, 𝑏).
1', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The joint probability density function is 𝑓(𝑎, 𝑏) = 3600 and the joint cumulative
distribution function is
𝑎       𝑏
𝑎𝑏
𝐹 (𝑎, 𝑏) = ∫ ∫ 𝑓(𝑠, 𝑡) 𝑑𝑠 𝑑𝑡 =
0       0                      3600', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(40: 5,5,10,10,10 pts.) Don’t be late!
Alicia and Bernardo are trying to meet for lunch and both will arrive, independently of each
other, uniformly and at random between noon and 1pm. Let 𝐴 and 𝐵 be the number of
minutes after noon at which Alicia and Bernardo arrive, respectively. Then 𝐴 and 𝐵 are
independent uniformly distributed random variables on [0, 60].
18.05 Problem Set 5, Spring 2022 Solutions                                                      4
Hint: For parts (c-e) you might find it easiest to find the fraction of the square [0, 60]×[0, 60]
filled by the event.
Find the probability that Alicia arrives before 12:15 and Bernardo arrives between 12:30
and 12:45 in two ways:
(i) By using the fact that 𝐴 and 𝐵 are independent.
(ii) By shading the corresponding area of the square [0, 60] × [0, 60] and finding what pro-
portion of the square is shaded.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (i) 𝑃 (𝐴 ≤ 15, 30 ≤ 𝐵 ≤ 45) = 𝑃 (𝐴 ≤ 15)𝑃 (30 ≤ 𝐵 ≤ 45) = 0.0625
(ii) The range of (𝐴, 𝐵) is the square [0, 60] × [0, 60]. The event ‘Alicia arrives before 12:15
and Bernardo arrives between 12:30 and 12:45’ is represented by the solid blue rectangle.
Since the probability distribution is uniform the probability of the blue rectangle is just the
fraction of the entire square that it covers.
Area of blue rectangle = 15 × 15 = 225. Fraction of the entire square = 225/3600 = 0.0625.
(0, 60)
(60, 60)
𝐴
(15, 45)
(60, 0)
(0, 0)        (0, 30)
𝐵', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(40: 5,5,10,10,10 pts.) Don’t be late!
Alicia and Bernardo are trying to meet for lunch and both will arrive, independently of each
other, uniformly and at random between noon and 1pm. Let 𝐴 and 𝐵 be the number of
minutes after noon at which Alicia and Bernardo arrive, respectively. Then 𝐴 and 𝐵 are
independent uniformly distributed random variables on [0, 60].
18.05 Problem Set 5, Spring 2022 Solutions                                                      4
Hint: For parts (c-e) you might find it easiest to find the fraction of the square [0, 60]×[0, 60]
filled by the event.
Now suppose that Alicia and Bernardo are both rather impatient and will leave if they
have to wait more than 15 minutes for the other to arrive. What is the probability that
Alicia and Bernardo will have lunch together?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Alicia and Bernardo arrive within 15 minutes of each other is event
𝐸 = 𝐵 − 15 ≤ 𝐴 ≤ 𝐵 + 15.
This is the blue shaded region in the figure below. We see that the area of each white
452
triangle is     . So, the combined white area is 452 and
2
3600 − 452   7
𝑃 (𝐸) =                =    .
3600      16
(0, 60)                       (45, 60)
(60, 60)
𝐴 > 𝐵 + 15
(60, 45)
15
+
𝐵
=
𝐴
𝐴
15
+
𝐴
(0, 15)
=
𝐵
𝐵 > 𝐴 + 15
(60, 0)
(0, 0) (15, 0)
𝐵', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 5,10,10 pts.) Least squares
In this problem we will use maximum likelihood estimates to develop Gauss’ method of least
squares for fitting lines to data.
Bivariate data means data of the form
(𝑥1 , 𝑦1 ), (𝑥2 , 𝑦2 ), … , (𝑥𝑛 , 𝑦𝑛 ).
For bivariate data the simple linear regression model assumes that, for some values of the
parameters 𝑎 and 𝑏, we have
𝑦𝑖 = 𝑎𝑥𝑖 + 𝑏 + random measurement error.
The model assumes the measurement errors are independent and identically distributed and
follow a N(0, 𝜎2 ) distribution. (The values 𝑥𝑖 may or may not be random.)
In general terms, we can say that the value of 𝑥 ‘explains’ the value of 𝑦 except for some
random noise. Graphically, the model says to make a scatter plot and find the line that best
fits the data. This is called a simple linear regression model.
1
18.05 Problem Set 6, Spring 2022 Solutions                                                         2
It turns out that, under some assumptions about random variation of measurement error,
one way to find a “best” line is by solving a maximum likelihood problem.
The goal is to find the values of the model parameters 𝑎 and 𝑏 that give the MLE for this
model. To guide you, we note that the model says that
𝑦𝑖 ∼ N(𝑎𝑥𝑖 + 𝑏, 𝜎2 ).
Also remember that you know the density function for this distribution.
For a general datum (𝑥1 , 𝑦1 ) give the likelihood and log likelihood functions (these will
be functions of 𝑦1 , 𝑥1 , 𝑎, 𝑏, and 𝜎.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Since 𝑦𝑖 ∼ N(𝑎𝑥𝑖 + 𝑏, 𝜎2 ) the likelihood with data (𝑥1 , 𝑦1 ) is
1                 2    2
𝑓(𝑥1 , 𝑦1 | 𝑎, 𝑏, 𝜎) = √        e−(𝑦1 −𝑎𝑥1 −𝑏) /(2𝜎 ) .
2𝜋 𝜎
The log likelihood is
√       (𝑦 − 𝑎𝑥1 − 𝑏)2
ln(𝑓(𝑥1 , 𝑦1 | 𝑎, 𝑏, 𝜎)) = − ln( 2𝜋 𝜎) − 1             .
2𝜎2', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 5,10,10 pts.) Least squares
In this problem we will use maximum likelihood estimates to develop Gauss’ method of least
squares for fitting lines to data.
Bivariate data means data of the form
(𝑥1 , 𝑦1 ), (𝑥2 , 𝑦2 ), … , (𝑥𝑛 , 𝑦𝑛 ).
For bivariate data the simple linear regression model assumes that, for some values of the
parameters 𝑎 and 𝑏, we have
𝑦𝑖 = 𝑎𝑥𝑖 + 𝑏 + random measurement error.
The model assumes the measurement errors are independent and identically distributed and
follow a N(0, 𝜎2 ) distribution. (The values 𝑥𝑖 may or may not be random.)
In general terms, we can say that the value of 𝑥 ‘explains’ the value of 𝑦 except for some
random noise. Graphically, the model says to make a scatter plot and find the line that best
fits the data. This is called a simple linear regression model.
1
18.05 Problem Set 6, Spring 2022 Solutions                                                         2
It turns out that, under some assumptions about random variation of measurement error,
one way to find a “best” line is by solving a maximum likelihood problem.
The goal is to find the values of the model parameters 𝑎 and 𝑏 that give the MLE for this
model. To guide you, we note that the model says that
𝑦𝑖 ∼ N(𝑎𝑥𝑖 + 𝑏, 𝜎2 ).
Also remember that you know the density function for this distribution.
Use R to plot the data and the regression line you found in part (ii) The commands
plot(x,y, pch=19) and abline() will come in handy. For abline be careful: the param-
eter a is the intercept and b is the slope – exactly the opposite of our usage. Print the plot
and turn it in.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Here is the code for this plot:
x = c(1,3,5)
y = c(8,2,1)
a = -7/4
b = 107/12
plot(x, y, pch=19, col=\'blue\')
#Perversely, in abline a is the intercept and b is the slope.
abline(a=b, b=a, col=\'orange\', lwd=2)
8
7
6
5
y
4
3
2
1
1    2     3     4      5
x', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(15: 10,5 pts.) Estimating uniform parameters
Suppose we have data 𝑥1 , 𝑥2 , … , 𝑥𝑛 which we know is drawn indepenedently from a
uniform(𝑎, 𝑏) distribution. Give the maximum likelihood estimate for the parameters 𝑎 and
𝑏.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The same logic as in part (a) shows 𝑎 = min(𝑥1 , … , 𝑥𝑛 ) and 𝑏 = max(𝑥1 , … , 𝑥𝑛 ) .
18.05 Introduction to Probability and Statistics
Spring 2022
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 10,10,10 pts.) (Monty Hall: Sober and drunk)
Recall the Monty Hall problem: Monty hosts a game show. There are three doors: one hides
a car and two hide goats. The contestant Shelby picks a door, which is not opened. Monty
then opens another door which has a goat behind it. Finally, Shelby must decide whether to
stay with her original choice or switch to the other unopened door. The problem asks which
is the better strategy: staying or switching?
To be precise, let’s label the door that Shelby picks by 𝐴, and the other two doors by 𝐵 and
𝐶. Hypothesis 𝐻𝐴 is that the car is behind door 𝐴, and similarly for hypotheses 𝐻𝐵 and
𝐻𝐶 .
Now suppose that Monty is drunk, i.e. he has completely forgotten where the car is and
is only aware enough to randomly open one of the two doors not chosen by the contestant.
It’s entirely possible he might accidentally reveal the car, ruining the show.
1
18.05 Problem Set 7, Spring 2022 Solutions                                                     2
Suppose that drunk Monty Hall opens door 𝐵, revealing a goat. Make a Bayes table with
prior, likelihood and posterior. Use the posterior probabilities to determine the best strategy.
(Hint: the data is the same but the likelihood function is not.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Some of the likelihoods change in this setting.
𝑃 (𝐷|𝐻𝐴 ): If 𝐻𝐴 is true, then the car is behind 𝐴. So Monty is equally likely to show 𝐵
or 𝐶 and reveal a goat. Thus 𝑃 (𝐷|𝐻𝐴 ) = 1/2. (Remember, 𝐷 is the event ’Monty opens
door 𝐵 and reveals a goat’.)
𝑃 (𝐷|𝐻𝐵 ): If 𝐻𝐵 is true, then the car is behind 𝐵, drunk Monty might show 𝐵, but if he
does we won’t reveal a goat. (He will ruin the game.) So 𝑃 (𝐷|𝐻𝐵 ) = 0.
𝑃 (𝐷|𝐻𝐶 ): 𝐻𝑐 says the car is behind 𝐶. Drunk Monty is equally likely to show 𝐵 or 𝐶. If
he chooses 𝐵 he’ll reveal a goat. So 𝑃 (𝐷|𝐻𝐶 ) = 1/2.
Our table is now:
Hyp.     Prior    Likelihood    Bayes numerator      Posterior
𝐻      𝑃 (𝐻)    𝑃 (data|𝐻)    𝑃 (𝐻)𝑃 (data|𝐻)     𝑃 (𝐻|data)
𝐻𝐴        1/3         1/2             1/6              1/2
𝐻𝐵        1/3          0               0                0
𝐻𝐶        1/3         1/2             1/6              1/2
Total:       1          –              1/3               1
So, in this case, switching is just as good (or as bad) as staying with the original choice.
The main lesson here is that, in the Bayesian framework, probability represents the uncer-
tainty of our knowledge. Sober Monty gave us information about the door he opened (it
hid a goat). But, since he would avoid the other door if the car was behind it, not picking
the other door gives us additional information. Since drunk Monty was choosing a door at
random, he gave us information about the door he opened, but, since he wasn’t avoiding the
other door, there was no information in the fact that he didn’t choose it. (Imagine there are
100 doors. If you choose 1 and sober Monty opens 98 with goats, then the door he avoided
almost certainly hides a car. On the other hand, drunk Monty is virtually guaranteed to
spoil the show if he randomly opens 98 doors.)', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(40: 10,10,10,5,5 pts.) Prediction
We are going to explore the dice problem from class further. I have five dice (4, 6, 8, 12, or
20 sides) and pick one at random (uniform probability). I then roll this die 𝑛 times and tell
you that, miraculously, every roll resulted in the value 7. As I am in a position of authority,
assume that I am telling the truth!
First, consider just the first roll. Find the prior predictive probability that the first roll
will be a 7 and the posterior (after the first roll) predictive probability that the second roll
will be a 7. Also find the posterior (after the first roll) probabilities for the chosen die.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We start by making a Bayesian update table. Let 𝐷4 , 𝐷6 , 𝐷8 , 𝐷12 , and 𝐷20 are
the hypotheses that we have selected the 4, 6, 8, 12, or 20 sided die respectively.
Hyp.      Prior    Likelihood    Bayes numerator          Posterior
𝐻        𝑃 (𝐻)    𝑃 (data|𝐻)    𝑃 (𝐻)𝑃 (data|𝐻)         𝑃 (𝐻|data)
𝐷4        1/5          0               0                    0
𝐷6        1/5          0               0                    0
1              1
𝐷8       1/5         1/8                 40           40𝑇 ≈ 0.4839
1              1
𝐷12      1/5        1/12                 60           60𝑇 ≈ 0.3226
1              1
𝐷20      1/5        1/20                100           100𝑇 ≈ 0.1935
31
Total:     1          –          𝑇 = 600 ≈ 0.0517               1
Let 𝑅1 be the event ‘the first roll is a 7’. The prior predictive probability 𝑃 (𝑅1 ) = 𝑇 ≈
0.0157, i.e. the total probability in the Bayes numerator column of the table.
The posterior probabilities 𝑃 (𝐷4 |𝑅1 ), 𝑃 (𝐷6 |𝑅1 ), 𝑃 (𝐷8 |𝑅1 ), 𝑃 (𝐷12 |𝑅1 ), 𝑃 (𝐷20 |𝑅1 ) are
given in the last column of the above table.
Let 𝑅2 be the event ‘the second roll is a 7’. The posterior predictive probability 𝑃 (𝑅2 |𝑅1 )
is also computed using the law of total probability, where we must use the posterier prob-
abilities for each of the dice.
𝑃 (𝑅2 |𝑅1 ) = 𝑃 (𝑅2 |𝐷4 )𝑃 (𝐷4 |𝑅1 ) + 𝑃 (𝑅2 |𝐷6 )𝑃 (𝐷6 |𝑅1 ) + 𝑃 (𝑅2 |𝐷8 )𝑃 (𝐷8 |𝑅1 )
+ 𝑃 (𝑅2 |𝐷12 )𝑃 (𝐷12 |𝑅1 ) + 𝑃 (𝑅2 |𝐷20 )𝑃 (𝐷20 |𝑅1 )
1               1             1
≈ 0 ⋅ 0 + 0 ⋅ 0 + ⋅ 0.4839 +       ⋅ 0.3226 +    ⋅ 0.1935
8              12            20
≈ 0.0970', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(40: 10,10,10,5,5 pts.) Prediction
We are going to explore the dice problem from class further. I have five dice (4, 6, 8, 12, or
20 sides) and pick one at random (uniform probability). I then roll this die 𝑛 times and tell
you that, miraculously, every roll resulted in the value 7. As I am in a position of authority,
assume that I am telling the truth!
for 𝑛 = 10).
18.05 Problem Set 7, Spring 2022 Solutions                                               5', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝑇 be the total probability in the table from part (b). By the law of total
probability, for 𝑥𝑛+1 = 1, 2, … , 8, we have
1   1 𝑛 1   1   1 𝑛 1      1   1 𝑛 1
𝑃 (𝑥𝑛+1 |data) =      ⋅( ) ⋅ +    ⋅( ) ⋅    +    ⋅( ) ⋅ .
5𝑇   8   8  5𝑇   12   12   5𝑇   20  20
For 𝑥𝑛+1 = 9, 10, 11, 12, we have
1   1 𝑛 1      1   1 𝑛 1
𝑃 (𝑥𝑛+1 |data) =      ⋅( ) ⋅    +    ⋅( ) ⋅ .
5𝑇   12   12   5𝑇   20  20
Finally, for 𝑥𝑛+1 = 13, 14, … , 20, we have
1   1 𝑛 1
𝑃 (𝑥𝑛+1 |data) =      ⋅( ) ⋅ .
5𝑇   20  20', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(40: 10,10,10,5,5 pts.) Prediction
We are going to explore the dice problem from class further. I have five dice (4, 6, 8, 12, or
20 sides) and pick one at random (uniform probability). I then roll this die 𝑛 times and tell
you that, miraculously, every roll resulted in the value 7. As I am in a position of authority,
assume that I am telling the truth!
What function does the pmf in part (d) converge to as 𝑛 grows to infinity? Explain why
this makes sense.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : As 𝑛 → ∞, we see that 𝑃 (𝐷𝑛+1 = 𝑥|data = all sevens) → 1/8 for 𝑥 = 1, 2, … , 8,
and 0 for 9 ≤ 𝑥 ≤ 20. This makes sense because, in the limit, all sevens makes the
probability the die is 8-sided equal to 1.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 10,10,5,5 pts.) (Odds)
You have a drawer that contains 50 coins. 10 coins have probability 𝑝 = 0.3 of heads, 30
coins have probability 𝑝 = 0.5 and 10 coins have probability 𝑝 = 0.7. You pick one coin at
random from the drawer and flip it.
What are the (prior predictive) odds of flipping a heads?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : To answer parts b-d we make a likelihood table and a Bayesian update table. We
label our hypothesis 𝐶0.3 , 𝐶0.5 and 𝐶0.7 meaning that the chosen coin has that probability
of heads. Our data from the first flip, 𝐷1 , is the event ‘heads on the first flip’.
Likelihood table
Hypothesis      outcomes
Type of coin Heads Tails
𝐶0.3        0.3    0.7
𝐶0.5        0.5    0.5
𝐶0.7        0.7    0.3
Bayesian update table
Hypoth.    Prior     likelihood Bayes numer.     posterior
𝐻       𝑃 (𝐻)     𝑃 (𝐷1 |𝐻) 𝑃 (𝐻)𝑃 (𝐷1 |𝐻)    𝑃 (𝐻|𝐷1 )
𝐶0.3      0.2          0.3          0.06          0.12
𝐶0.5      0.6          0.5          0.30          0.60
𝐶0.7      0.2          0.7          0.14          0.28
Total:       1           –           0.50           1
The prior probability of heads is the total in the Bayes numerator column: 𝑃 (heads) = 0.50
18.05 Problem Set 7, Spring 2022 Solutions                                                   6
So the prior probability of tails is 1 − 𝑃 (heads) = 0.50
So the prior odds of heads are 𝑂(heads) = 1, i.e. 50-50 odds.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 10,10,5,5 pts.) (Odds)
You have a drawer that contains 50 coins. 10 coins have probability 𝑝 = 0.3 of heads, 30
coins have probability 𝑝 = 0.5 and 10 coins have probability 𝑝 = 0.7. You pick one coin at
random from the drawer and flip it.
What are the posterior predictive odds of heads on the next (second) flip?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The posterior predictive probability of heads is found by summing the product
of the posterior column in the Bayesian update table and the heads column in the likelihood
table. We get 𝑃 (heads|𝐷1 ) = 0.12 ⋅ 0.3 + 0.60 ⋅ 0.5 + 0.28 ⋅ 0.7 = 0.532.
The posterior predictive probability of tails 𝑃 (tails|𝐷1 ) = 1−0.532 = 0.468. So the posterior
0.532
predictive odds of heads are 𝑂(heads|𝐷1 ) =             = 1.1368 .
0.468', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(15 pts.) (Bayes at the movies)
A local theater employs two ticket collectors, Oscar and Emmy, although only one of them
works on any given day. The number of tickets 𝑋 that a ticket collector can collect in an
hour is modeled by a distribution which has mean 𝜆, and probability mass function

                                                  𝜆𝑘 −𝜆
                                    𝑃 (𝑋 = 𝑘) =      𝑒
                                                  𝑘!
for 𝑘 = 0, 1, 2, … . (This distribution is called a Poisson distribution. It is an important
discrete distribution in biology and physics.)
Suppose that Oscar collects, on average, 10 tickets an hour and Emmy collects, on average,
15 tickets an hour. One day the manager stays home sick. They know Emmy is supposed
to work that day, but thinks there are 1 to 10 odds that Oscar is filling in for Emmy (based
on Emmy’s prior history of taking advantage of Oscar’s generous nature when the manager
is away). The suspicious manager monitors ticket sales online and observes that over the
span of 5 hours there are 12, 10, 11, 4, and 11 tickets collected. What are the manager’s
posterior odds that Oscar is filling in for Emmy?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Since we are computing odds, we will only give the hypothesis and likelihood
columns of the update table. Our hypotheses are Oscar, i.e. Oscar is working and Emmy,
i.e. Emmy is working. Denoting our data as 𝐷, we have the table
likelihood
hypothesis              𝑃 (𝐷|hypothesis)
1012+10+11+4+11 𝑒−50
Oscar     𝑃 (𝐷|Oscar) =
12!10!11!4!11!
1512+10+11+4+11 𝑒−75
Emmy        𝑃 (𝐷|Emmy) =
12!10!11!4!11!
𝑃 (𝐷|Oscar)
Thus the Bayes factor (likelihood ratio) is               ≈ 254.09.
𝑃 (𝐷|Emmy)
1
We are given the prior odds that Oscar is working, 𝑂(Oscar) = 10 . Thus, our posterior
odds are
𝑂(Oscar|𝐷) = prior odds × Bayes factor ≈ 25.409', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(30: 10,10,10 pts.) (Normal is the new normal)
Your friend transmits an unknown value 𝜃 to you over a noisy channel. The noise is
normally distributed with mean 0 and a known variance 4, so the value 𝑥 that you receive is
modeled by 𝑥 ∼ 𝑁 (𝜃, 22 ). Based on previous communications, your prior on 𝜃 is 𝑁 (6, 32 ).
Suppose your friend transmits the same value 𝜃 to you 8 times. You receive these signals
plus noise as 𝑥1 , … , 𝑥8 with sample mean 𝑥̄ = 5. Using the same prior and know variance
𝜎2 as in part (a), show that the posterior on 𝜃 is 𝑁 (5.05, 0.47). Plot the prior and posterior
on the same graph. Describe how the data changes your belief about the true value of 𝜃.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have
2
𝑛 = 8,   𝑥 = 𝑥 = 5,   𝜇prior = 6,   𝜎prior = 9,   𝜎2 = 4
18.05 Problem Set 7, Spring 2022 Solutions                                                            10
Using the update formulas we have
1       1          𝑛                                 𝑎𝜇prior + 𝑏𝑥   96            2         1     9
𝑎=    2
= ,   𝑏=       = 2,           ⇒ 𝜇post =                    =    ≈ 5.05,   𝜎post =       =    ≈ 0.47.
𝜎prior    9          𝜎2                                   𝑎+𝑏         19                     𝑎+𝑏   19
0.6
Prior N(6,9)
Posterior N(5.05,0.47)
0.5
0.4
0.3
0.2
0.1
0.0
−5            0               5           10          15
θ
After observing 𝑥1 , … , 𝑥4 , we see that the posterior mean is close to 𝑥 and the posterior
variance is much smaller than the prior variance. The data has made us more certain about
the location of 𝜃.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(15: 10,5 pts.) (Censored data)
Sometimes data is not reported in full. This can mean only reporting values in a certain
range or not reporting exact values. We call such data censored.
We have a 4-sided die and a 6-sided die. One of them is chosen at random and rolled 5
times. Instead of reporting the number of spots on a roll we censor the data and just report
1 if the roll is a 1;   0 if the roll is not a 1.
Suppose the data for the five rolls is 1, 0, 1, 1, 1. Starting from a flat prior on the
choice of die, update in sequence and report, after each roll, the posterior odds that the
chosen die is the 4-sided die.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : First note that we assume that, given a particular die, the rolls are independent.
Let 𝑥 be the censored value on one roll. The Bayes factor for 𝑥 is
3/4
𝑝(𝑥|4-sided)         = 9/10       if 𝑥 = 0
Bayes factor =              = { 5/6
1/4
𝑝(𝑥|6-sided)     1/6 = 3/2        if 𝑥 = 1
Starting from the prior odds of 1, we multiply by the appropriate Bayes factor and get the
posterior odds after rolls 1–5 are
Prior odds: 1
3
Posterior odds after roll 1 = 1 ⋅   = 1.5
2
3 9       27
Posterior odds after roll 2 = ⋅      =      = 1.35
2 10      20
27 3      81
Posterior odds after roll 3 =    ⋅ =        = 2.025
20 2      40
81 3      243
Posterior odds after roll 4 =    ⋅ =         = 3.0375
40 2       80
243 3       729
Posterior odds after roll 5 =      ⋅ =        = 4.55625
80 2       160', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(35: 5,5,5,5,5,5,5 pts.) (Confident coin: III)
When spun on edge 250 times a certain coin came up heads 140 times and tails 110. We
can make the statement: ‘if the coin is unbiased then the probability of getting a result at
least this extreme is 7%.’
Let 𝜃 be the probability of coming up heads. Consider the null hypothesis that the coin
is fair, 𝐻0 ∶ 𝜃 = 0.5. Carefully explain how the 7% figure arises. What term describes this
value in NHST? Does it correspond to a one-sided or two-sided test?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝐻0 : 𝜃 = 0.5
Test statistic: 𝑥 = number of heads in 250 spins.
Data: 𝑥 = 140.
The probability of geting a result at least as extreme as seen is the 𝑝-value.
We’ll show how to compute this value and decide if the test is one or two-sided at the same
time.
A one-sided test would have alternative hypothesis 𝐻𝐴 : 𝜃 > 0.5. In this case, data at least
as extreme means 𝑥 ≥ 140. Using R we compute the one-sided 𝑝-value:
𝑝 = 𝑃 (𝑥 ≥ 140 | 𝐻0 ) = 1 - pbinom(139, 250, 0.5) = 0.03321
This is not the 7% value we were looking for. So let’s consider the two-sided test.
A two-sided test would have alternate hypothesis 𝐻𝐴 : 𝜃 ≠ 0.5. Since the null distribution,
binomial(250,0.5), is symmetric around 0, each tail in the rejection region will have proba-
bility 𝛼/2 and the two-sided 𝑝-value is computed by doubling the smaller of the one-sided
𝑝-values. We computed the right tail 𝑝-value just above. This is the smaller of the two
𝑝-values so our two-sided 𝑝-value is 2 × 0.03321 = 0.06642. This rounds to 0.07, so the figure
of 7% is the two-sided 𝑝-value.
Note: We could have used the normal approximation binomial(250, 0.5) ≈ N(125, 250/4),
𝑥−125
and the 𝑧-statistic 𝑧 = √250/4  ≈ N(0, 1). In this case, our 𝑝-values would be: one-sided:
15                                               15
𝑝 = 𝑃 (𝑧 ≥          ) ≈ 0.02889 and two-sided: 𝑝 = 𝑃 (|𝑧| ≥          ) ≈ 0.05778.
√250/4                                           √250/4', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(35: 5,5,5,5,5,5,5 pts.) (Confident coin: III)
When spun on edge 250 times a certain coin came up heads 140 times and tails 110. We
can make the statement: ‘if the coin is unbiased then the probability of getting a result at
least this extreme is 7%.’
How many heads would you need to have observed out of 250 spins to reject at a
significance of 𝛼 = 0.01? (Again assume the same sidedness as the test used to get the 7%
𝑝-value in part (a).)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Again, we use two-sided rejection region. The problem asks us to find the
rejection region for 𝛼 = 0.01. We use R to find the endpoints for the rejection region (called
critical values):
critical_value_left = qbinom(0.005,250,0.5) - 1 = 104
critical_value_right = qbinom(0.995,250,0.5) + 1 = 146
Note: we added or subtracted one to the value returned by qbinom. For a discrete distri-
bution like the binomial there is not an exact critical value. So qbinom(x, n, p) returns
the smallest integer with more than 𝑥 probability in its left tail. Since the rejection region
must have at most 𝛼/2 in either tail we have to move the R answer by one towards the tail.
Conclusion: we reject for greater than or equal to 146 heads or less than or equal to 104
heads.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(35: 5,5,5,5,5,5,5 pts.) (Confident coin: III)
When spun on edge 250 times a certain coin came up heads 140 times and tails 110. We
can make the statement: ‘if the coin is unbiased then the probability of getting a result at
least this extreme is 7%.’
(i) Again fix 𝛼 = 0.05. What is the smallest number of spins necessary for the test to
have a power of 0.9 when 𝐻𝐴 ∶ 𝜃 = 0.55? (Again, use the sidedness from part (a).)
(ii) As in part (d), draw sketches and explain how they illustrate the change in power.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The answer is 𝑛 = 1055 with 𝐻𝐴 giving a power of 0.9003.
To get this we need to compute the power for various values of 𝑛. The steps for each 𝑛 are:
1. Find the rejection region.
2. Compute the power.
Here is the R-code for one value of 𝑛. We ran this code in a loop to check through all values
of 𝑛 until we found the first with power = 0.9. The full code is in mit18_05_s22_ps8_sol.r,
which is posted in the usual place.
theta = 0.55
n = 300;
# Find critical values for rejection region (based on theta=0.5)
critical_value_left = qbinom(0.025,n,0.5) - 1;
critical_value_right = qbinom(0.975,n,0.5) + 1;
rejection_region = c(0:critical_value_left, critical_value_right:n)
power = sum(dbinom(rejection_region, n, theta))
print(power)
See the two plots with part (d): power increases as 𝑛 increases because the distributions
become more separated.
θ = 0.55            n = 1055
0.025
0.015
prob
0.005
−0.005
500             550              600
x
Plot for 𝑛 = 1055 of the 𝐻0 and 𝐻𝐴 ∶ 𝜃 = 0.55 distributions. The blue lines show the
rejection region.
An alternative approach approximating the exact answer with normal distributions is given
at the end of these solutions.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(35: 5,5,5,5,5,5,5 pts.) (Confident coin: III)
When spun on edge 250 times a certain coin came up heads 140 times and tails 110. We
can make the statement: ‘if the coin is unbiased then the probability of getting a result at
least this extreme is 7%.’
Given the data, what probability would you personally place on the coin being biased
toward heads? Why? There is no one right answer, we are simply interested in your
thinking.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is a question about the probability of hypotheses. That’s a Bayesian, not a
frequentist, idea. I’d go with 90% probability the coin is biased towards heads. My Bayesian
analysis is as follows.
If we used the Beta(1, 1) (flat) prior on 𝜃 in [0,1]. Then the posterior for 𝜃 is a Beta(141, 111)
distribution. With this posterior
𝑃 (𝜃 > 0.5 | data) = 1 − pbeta(0.5, 141, 111) ≈ 0.97.
This is 97%. Likewise, 𝑃 (𝜃 > 0.53 | data) = 83%.
Strictly speaking bias means 𝜃 > 0.5. Leaving a small margin of error we can require
𝜃 > 0.53. My answer is between these two probabilities.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 10,10,5 pts.) z-test
Suppose three radar guns are set up along a stretch of road to catch people driving over the
speed limit of 40 miles per hour. Each radar gun is known to have a normal measurement
error modeled on 𝑁 (0, 52 ). For a passing car, let 𝑥̄ be the average of the three readings.
Our default assumption for a car is that it is not speeding.
Describe the above story in the context of NHST. Are the most natural null and alter-
native hypotheses simple or composite?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let 𝜇 be the actual speed of a given driver. We are given that
𝑥𝑖 ∼ N(𝜇, 52 ) ⇒ 𝑥̄ ∼ N(𝜇, 52 /3).
The most natural hypotheses are:
𝐻0 : the driver is not speeding, i.e. 𝜇 ≤ 40.
𝐻𝐴 : the driver is speeding, i.e. 𝜇 > 40.
Both are composite.
Note: we will work with 𝐻0 : 𝜇 = 40, which is simple.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(25: 10,10,5 pts.) z-test
Suppose three radar guns are set up along a stretch of road to catch people driving over the
speed limit of 40 miles per hour. Each radar gun is known to have a normal measurement
error modeled on 𝑁 (0, 52 ). For a passing car, let 𝑥̄ be the average of the three readings.
Our default assumption for a car is that it is not speeding.
What is the power of this test with the alternative hypothesis that the car is traveling at
45 miles per hour? How many cameras are needed to achieve a power of 0.9 with 𝛼 = 0.04?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Power = 𝑃 (rejection | 𝐻𝐴 ). So to find the power we first must find the rejection
region. For 𝑛 = 3 this was done in part (b): rejection region = [45.054, ∞). So
power = 𝑃 (rejection | 𝜇 = 45) = 1 - pnorm(45.054, 45, 5/sqrt(3)) = 0.493
With 𝑛 cameras (guns) let’s write 𝑥𝑛 for the sample mean. The null distribution is
𝑥𝑛̄ ∼ N(40, 52 /𝑛)
The critical value, i.e. the left endpoint of the rejection region and power depends on 𝑛.
We can use R to compute: The code for computing the power when 𝑛 = 3 is shown below.
You only have to change the first line to compute power for different values of 𝑛.
n = 3
mu = 40
sigma = 5/sqrt(n)
alpha = 0.04
xcrit = qnorm(1-alpha, mu, sigma)
power = 1-pnorm(xcrit, 45, sigma)
We can now use R to compute power for increasing values of 𝑛 and find the first value of 𝑛
gives power more than 0.9. We find that 𝑛 = 10 .
Alternative, algebraic approach.
In order to do the computations algebraically we need to write everything in terms of
standard normal values.
√                 5
𝑐0.04 = qnorm(0.96, 40, 5/ 𝑛) = 40 + 𝑧0.04 √
𝑛
where 𝑧0.04 is the standard normal critical value
𝑧0.04 = qnorm(0.96, 0, 1) = 1.751.
18.05 Problem Set 8, Spring 2022 Solutions                                                   8
We want
power = 𝑃 (𝑥 ≥ 𝑐0.04 | 𝜇 = 45) = 0.9
Standardizing and doing some algebra we get
𝑥 − 45 𝑐   − 45                                 −5
𝑃(     √ ≥ 0.04√     ) = 0.9        ⇒      𝑃 (𝑧 ≥     √ + 𝑧0.04 ) = 0.9
5/ 𝑛     5/ 𝑛                                  5/ 𝑛
−5
Thus     √ + 𝑧0.04 = 𝑧0.9 . We get
5/ 𝑛
𝑛 = (𝑧0.04 − 𝑧0.9 )2 = (1.7507 − (−1.2816))2 = 9.1945.
Setting 𝑛 to be the next biggest integer we get 𝑛 = 10.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(10: 5,5 pts.) One generates a number 𝑥 from a uniform distribution on the
interval [0, 𝜃]. One decides to test 𝐻0 ∶ 𝜃 = 2 against 𝐻𝐴 ∶ 𝜃 ≠ 2 by rejecting 𝐻0 if 𝑥 ≤ 0.1
or 𝑥 ≥ 1.9.
Compute the probability of a type II error if the true value of 𝜃 is 2.5.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 𝑃 (type II) = 𝑃 (don’t reject 𝐻0 | 𝜃 = 2.5) = 𝑃 (0.1 < 𝑥 < 1.9 | 𝜃 = 2.5) = 1.8
2.5 =
0.72.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(15: 10,5 pts.)
We perform a 𝑡-test for the null hypothesis 𝐻0 ∶ 𝜇 = 10 at significance level 𝛼 = 0.05 by
means of a dataset consisting of 𝑛 = 16 elements with sample mean 11 and sample variance
4.
What if we test against 𝐻𝐴 ∶ 𝜇 > 10?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is a one-sided alternative. The 𝑡-statistic is the same
𝑥̄ − 𝜇  1
√ =     = 2.
𝑠/ 𝑛   2/4
So we have the one-sided 𝑝-value
𝑝 = 𝑃 (𝑡 > 2|𝐻0 ) = 1-pt(2,15) = 0.031973.
Since 𝑝 < 𝛼 = 0.05 we reject the null hypothesis in favor of the alternative.
Again looking at rejection regions. We use the critical value 𝑡15,0.05 ≈ 1.753. The rejection
region for 𝑥̄ is
𝑠
[10 + 𝑡15,0.05 √ , ∞) = [10.876, ∞).
𝑛
Since 11 lies inside the rejection region, we should reject the null-hypothesis in favor of
𝐻1 ∶ 𝜇 > 10.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 10,10 pts.) (Two-sample F test for equal variances)
In this problem, we want you to become comfortable using the web to learn about new
18.05 Problem Set 9, Spring 2022 Solutions                                                   6
tests and R commands. There are dozens of statistical software packages used by labs and
industry, so being able to learn new commands is probably more important than trying to
memorize them all. Look at the help file in R for var.test
We used R to secretly create a vector 𝑥 of 20 random samples from an N(0, 1) distribution
and a vector 𝑦 of 20 random samples from a N(10, 1) distribution. These are listed below.
With a tiny bit of editing you should be able to copy and paste these into R.
-0.802, 0.457, 0.972, 0.044, 0.318, -1.380, 0.111,
-0.023, -0.700, -1.977, -0.497, 1.471, -1.314, -0.078,
-0.505, 0.583, 1.363, -1.863, -2.105, 0.488
9.019, 9.852, 7.947, 9.465, 10.060, 10.508, 9.506,
9.540, 10.218, 9.407, 11.455, 11.422, 7.698, 9.972,
10.928, 11.577, 10.376, 8.605, 9.347, 10.715
You should look up the F-test for equal variances. Give the formula and compute the F
statistic and 𝑝-value directly. You can use R to compute sample means, sample variances
and do arithmetic as needed, but you can’t use var.test to do all the work. You will need
the R function pf to compute probabilities for the F distribution
Should you reject the null-hypothesis at 𝛼 = 0.05?
Note: here is how you get a two-sided 𝑝-value for this test.
If the 𝐹 -statistic is greater than 1 then
𝑝 = 2 × the right tail probability
18.05 Problem Set 9, Spring 2022 Solutions                                                 7
If the 𝐹 -statistic is less than 1 then
𝑝 = 2 × the left tail probability', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We found the formula for the F statistic for this test at
https://en.wikipedia.org/wiki/F-test_of_equality_of_variances
𝑠2𝑥 = var(x) = 1.1302
𝑠2𝑦 = var(y) = 1.1647
Our 𝐹 -statistic is
𝑠2𝑥
fstat =       = 0.9703
𝑠2𝑦
The degrees are freedom are both 19. We are running a two-sided test. So,
𝑝 = 2*min(pf(fstat, 19, 19), 1-pf(fstat, 19, 19)) = 0.9484
which matches our result in part (a).', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(15: 10,5 pts.) Z
Suppose we have 𝑛 data points drawn from a N(𝜃, 92 ) distribution, where the value of the
mean 𝜃 is unknown.
Explain why the 95% confidence interval for the mean 𝜃 is always narrower when 𝑛 = 90
when 𝑛 = 30.
√', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The formula for the confidence interval has width 2𝑧𝛼/2 𝜎 𝑛. Since 𝜎 and 𝑧𝛼/2
are fixed, this gets smaller as 𝑛 increases.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(10 pts.) (Cholesterol)
In a study on cholesterol levels a sample of 12 men and women was chosen. The plasma
cholesterol levels (mmol/L) of the subjects were as follows:
6.0, 6.4, 7.0, 5.8, 6.0, 5.8, 5.9, 6.7, 6.1, 6.5, 6.3, 5.8.
What assumptions did you make about the sample in order to make your estimate?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have assumed that the plasma cholesterol levels are independent and nor-
mally distributed. This might not be a good assumption because, e.g. cholesterol for men
and women might follow different distributions. We’d have to do further exploration to
understand this.', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(10 pts.) (Candy)
A candy manufacturer produces packs of candy targeted to weigh 52 grams. A quality control
manager was concerned that the variation in the actual weights was larger than acceptable.
That is, They were concerned that some packs weighed significantly less than 52-grams
and some weighed significantly more than 52 grams. In order to estimate 𝜎, the standard
deviation of the weights of the nominal 52-gram packs, they took a random sample of n = 10
packs off of the factory line. The random sample yielded a sample variance of 4.2 grams2 .
What assumptions did you make about the sample in order to make your estimate.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : In order to use a 𝜒2 confidence interval we assumed that the weights of the packs
of candy are independent and normally distributed with variance 𝜎2 .', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(20: 10,5,5 pts.) (Height)
Suppose 𝜇 is the average height of a college male. You measure the heights (in inches) of
twenty college men, getting data 𝑥1 , … , 𝑥20 , with sample mean 𝑥 = 69.55 in. and sample
variance 𝑠2 = 14.26 in2 . Suppose that the 𝑥𝑖 are drawn from a normal distribution with
unknown mean 𝜇 and unknown variance 𝜎2 .
Now suppose you are told that the height of a college male is normally distributed with
standard deviation 3.77 in. Using the same data as in part (a), construct a 90% 𝑧–confidence
interval for 𝜇.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have
𝑧𝛼/2 = qnorm(0.05) = 1.6448.
So the 90% 𝑧-confidence interval is given by
𝜎              𝜎
[𝑥 − 𝑧𝛼/2 ⋅ √ , 𝑥 + 𝑧𝛼/2 ⋅ √ ] ≈ [68.16, 70.94]
𝑛              𝑛', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(10 pts.) Confidence intervals from standardized statistics
The Beta distribution arises in a surprising way: draw a sample of size 𝑛 from a uniform(0,1)
distribution and let 𝑤2 be the second smallest value. Then it turns out that

                                    𝑤2 ∼ Beta(2, 𝑛 − 1).

Now suppose you draw a sample of size 𝑛 from a uniform(0, 𝑎) distribution, where 𝑎 is
unknown. If we let 𝑦2 be the second smallest data value then the standardized order
statistic
                              𝑦2 /𝑎 ∼ Beta(2, 𝑛 − 1).
Use 𝑦2 and qbeta in R, to define a 95% confidence interval for 𝑎. (Because 𝑛 and 𝑦2 are
not given this will be a general formula not numbers.)
Finally, supposing 𝑛 = 9 and 𝑦2 = 1.5, give the 95% confidence interval for 𝑎.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is a problem about using a standardized statistic and ‘pivoting’ to compute
confidence intervals. We are told that 𝑦2 /𝑎 ∼ Beta(2, 𝑛 − 1). If 𝑐0.025 amd 𝑐0.975 are the
critical values for Beta(2, 𝑛 − 1) then this means that
𝑦2
𝑃 (𝑐0.975 <      < 𝑐0.025 | 𝑎) = 0.95.
𝑎
Here, in R notation, 𝑐0.975 = qbeta(0.025, 2, n-1) and 𝑐0.025 = qbeta(0.975, 2, n-1).
Doing some algebra to isolate 𝑎 in the middle, this becomes
𝑦2         𝑦2
𝑃(          <𝑎<        | 𝑎) = 0.95.
𝑐0.025     𝑐0.975
If 𝑛 = 9 we have
𝑐0.025 = qbeta(0.975, 2, 8) = 0.482,             𝑐0.975 = qbeta(0.025, 2, 8) = 0.0281
So, in this case, the 95% confidence interval is
𝑦2    1.5        1.5    1.5
[         ,       ]≈[      ,       ] ≈ [3.1, 53.3] .
𝑐0.025 𝑐0.975     0.482 0.0281', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.05 — question d’examen, en anglais]
(35: 15,10,10 pts.) Various variances
Consider a sample of size 𝑛 drawn from a Bernoulli(𝜃) distribution. (That is, a draw from a
binomial(𝑛, 𝜃) distribution.) In constructing a confidence interval the conservative estimate
is that the variance of the underlying Bernoulli distribution is 𝜎2 = 1/4 –this is conservative
because for any 𝜃 we know that 𝜎2 ≤ 1/4.
Suppose 𝜃 is the probability of success, and that the result of an experiment was 140 suc-
cesses out of 250 trials. Find 80% and 95% confidence intervals for 𝜃 using the conservative
variance. (For the 95% interval use the rule-of-thumb that 𝑧0.025 = 2.)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Using the conservative variance, we know that 𝑥̄ is approximately N(𝜃, 1/4𝑛).
For an 80% confidence interval, we have 𝛼 = 0.2 so
𝑧𝛼/2 = qnorm(0.9,0,1) = 1.2815.
So the 80% confidence interval for 𝜃 is given by
𝑧0.1        𝑧0.1
[𝑥 ̄ − √    , 𝑥̄ + √    ] = [0.5195, 0.6005]
2 𝑛         2 𝑛
For the 95% confidence interval, we use the rule-of-thumb that 𝑧0.025 ≈ 2. So the confidence
interval is
1        1
[𝑥̄ − √ , 𝑥̄ + √ ] = [0.497, 0.623]
𝑛        𝑛
It’s okay to have used the exact value of 𝑧0.025 . This gives a confidence interval:
1.96     1.96
[𝑥̄ − √ , 𝑥̄ + √ ] = [0.498, 0.622]
2 𝑛      2 𝑛', 'source' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.05 Introduction To Probability And Statistics, Spring 2022 — examen et corrigé officiel (MIT EECS)'),
						),
					),
				),
			),
		);
	}
}
