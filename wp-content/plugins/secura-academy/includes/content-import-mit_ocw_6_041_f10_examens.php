<?php
/**
 * Questions importees — MIT OpenCourseWare — 6 041 probabilistic systems analysis and applied probability fall 2010
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_041_f10_examens' ) ) {
	function seca_import_mit_ocw_6_041_f10_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-041-f10-examens', 'nom' => 'MIT OpenCourseWare — 6 041 probabilistic systems analysis and applied probability fall 2010', 'url' => 'https://ocw.mit.edu/courses/6-041-probabilistic-systems-analysis-and-applied-probability-fall-2010/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
Suppose that there are exactly k gala apples among the n apples Bob picked. Caleb
comes by and gives Bob a ripe gala apple to add to his bounty. Bob then picks an apple
at random from the n + 1 apples and eats it.
(i) (12 points) What is the probability that it was a ripe apple?
(ii) (12 points) What is the probability that it was a gala apple if it was ripe?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i. (12 points) Among the n + 1 apples, his bounty includes: 1 ripe gala from Caleb,
k gala, n − k honey crisp. We can compute the probability of eating a ripe apple
conditioned on Bob selecting an apple from each of the three disjoint cases listed
above. The total probability theorem allows us to then ﬁnd the probability of Bob
eating a ripe apple.
P(ripe apple) = P(ripe apple | Caleb’s ripe gala)P(Caleb’s ripe gala)
+ P(ripe apple | k gala)P(k gala)
+ P(ripe apple | n − k honey crisp)P(n − k honey crisp)
1          k        n−k
= 1·      +g·         +h·
n+1        n+1        n+1
1 + gk + h(n − k)
=                   .
n+1
ii. (12 points) Using Bayes’ Rule:
P(ripe ∩ gala)
P(gala | ripe apple) =                  .
P(ripe apple)
We can compute the P(ripe ∩ gala) as such:
Page 1 of 3
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Fall 2009)
P(ripe ∩ gala) = P(ripe ∩ gala | Caleb’s ripe gala)P(Caleb’s ripe gala)
+ P(ripe ∩ gala | k gala)P(k gala)
+ P(ripe ∩ gala | n − k honey crisp)P(n − k honey crisp)
1            k      n−k
= 1·         +g·        +0·
n+1          n+1      n+1
1 + gk
=          .
n+1
Combining this result with that of (i),
1+gk
n+1            1 + gk
P(gala | ripe apple) = 1+gk+h(n−k) =                   .
1 + gk + h(n − k)
n+1', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(5 points) Find c.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (5 points)
We’re given that the joint PDF is constant in the shaded region, and since the PDF must
integrate to 1, we know that the constant must equal 1 over the area of the region. Thus,
1
c=       = 2.
1/2', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(5 points) What are the recurrent states?
Page 3 of 16
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Fall 2009)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (5 points)
The recurrent states are {3,4}.', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(5 points) Find the steady-state probabilities πj = limn→∞ P(Xn = j | X0 = i), or explain why they do
not exist.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (5 points)
The steady-state probabilities do not exist since there is more than one recurrent class. The
long-term state probabilities would depend on the initial state.', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(5 points) What is the probability that Al ﬁnishes his ﬁrst lap before any of the others?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (5 points)
The event that Al is the ﬁrst to ﬁnish a lap is the same as the event that the ﬁrst arrival in
the merged process came from Al’s process. This probability is
λA       21
= .
λA + λB + λC  68', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(5 points) Find X̂MAP (N ), the MAP estimator of X based on an observation of N .
Page 4 of 16
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Fall 2009)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (5 points)
The expression for X̂MAP (N ), the MAP estimator of X based on an observation of N is
X̂MAP (N ) = arg max fX|N (x | n)
x
fX (x)pN |X (n | x)
= arg max
x        pN (n)
= arg max fX (x)pN |X (n | x)
x
λ2 n+1 −(1+λ)x
= arg max   x     e
x n!
= arg max xn+1 e−(1+λ)x ,
x
where the third equality holds since pN (n) has no dependency on x and the last equality
holds by removing all quantities that have no dependency on x. The max can be found by
diﬀerentiation and the result is:
1+N
X̂MAP (N ) =       .
1+λ
This is the only local extremum in the range x ∈ [0, ∞). Moreover, fX|N (x | n) equals 0 at
x = 0 and goes to 0 as x → ∞ and fX|N (x | n) > 0 otherwise. We can therefore conclude
that X̂MAP (N ) is indeed a maximum.', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(7 points) Find the marginal PDF of Y .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (7 points)
The marginal PDF of Y can be found by integrating the joint PDF of X and Y .
Z
fY (y) =    fX,Y (x, y)dx
ZX∞
=     xe−(1+y)x dx
0
(
1
(1+y)2
,       y≥0
fY (y) =
0,             otherwise.', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(7 points) Find the conditional expectation of X, given that Y = 2.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (7 points)
Z
E[X | Y = 2] =                  x · fX|Y (x | 2)dx
X
Z ∞
=9             x2 e−3x dx
0
2
=9·
33
2
= .
3
Page 1 of 5
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Fall 2009)', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(7 points) Find the PDF of e2X .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (7 points)
Let’s define Z = e2X . Since X is an exponential random variable that takes on non-negative
values (X ≥ 0), Z ≥ 1. We find the PDF of Z by first computing its CDF.
FZ (z) = P(Z ≤ z)
= P(e2X ≤ z)
= P(2X ≤ ln z)
ln z
= P(X ≤        )
2
ln z
= 1 − e− 2
−1
= 1 − eln z 2
The CDF of Z is:
1
1 − z− 2

z≥1
FZ (z) =
0,               z<1
Page 2 of 5
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Fall 2009)
Differentiating the CDF of Z yields the PDF
 1 −3
2z
2           z≥1
fZ (z) =
0,             z<1
Alternatively, you can apply the PDF formula for a strictly monotonic function of a continuous
random variable. Recall if z = g(x) and x = h(z), then
dh
fZ (z) = fX (h(z))        (z) .
dy
In this problem, z = e2x and x = 21 ln z. Note that fZ (z) is nonzero for z > 1. Since X is an
exponential random variable with λ = 1, fX (x) = ex . Thus,
1
fZ (z) = e− 2 ln z
1
2z
−1  1
= eln z 2
2z
1 −3
= z 2 z ≥ 1,
2
where the second equality holds since the expression inside the absolute value is always positive
for z ≥ 1.', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(5 points) The quantity E[ E[X | Y, N ] | N ] is always:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (5 points) The quantity E[E[X | Y, N ] | N ] is always:
(i) A number.
(ii) A discrete random variable.
(iii) A continuous random variable.
(iv) Not enough information to choose between (i)-(iii).
If X, Y and N are not independent, then the inner expectation G(Y, N ) = E[X | Y, N ] is
a function of Y and N . Furthermore E[G(Y, N ) | N ] is a function of N , a discrete random
variable. If X, Y and N are independent, then the inner expectation E[X | Y, N ] = E[X],
which is a number. The expectation of a number given N is still a number, which is a special
case of a discrete random variable.
Page 3 of 5
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Fall 2009)', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(7 points) Find the covariance of X and Q.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (7 points)
We know that cov(X, Q) = E[XQ] − E[X]E[Q], so first let’s calculate E[XQ]:
1
E[XQ] = E[E[XQ | Q]] = E[QE[X | Q]] = E[Q2 ] = .
3
Therefore, we have
1 1 1 1
cov(X, Q) =     − · = .
3 2 2 12', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(7 points) If X and Y are standard normal, ﬁnd the probability that S ≥ 1.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (7 points)
P(S ≥ 1) = P(min{X, Y } ≥ 1) = P(X ≥ 1 and Y ≥ 1) = P(X ≥ 1)P(Y ≥ 1)
= (1 − FX (1))(1 − FY (1)) = (1 − Φ(1))2 ≈ (1 − 0.8413)2 ≈ 0.0252.
Page 4 of 5
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Fall 2009)', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
Multiple Choice (4 pts. each, 24 pts. total)
Clearly circle the appropriate choice. No partial credit will be given for individual questions in this
part of the quiz.
a. Earthquakes in Sumatra occur according to a Poisson process of rate λ = 2/year. Conditioned
on the event that exactly two earthquakes take place in a year, what is the probability that both
earthquakes occur in the ﬁrst three months of the year? (for simplicity, assume all months have
30 days, and each year has 12 months, i.e., 360 days).
R = {(x1 , x2 ) : x1 + x2 > ξ} for some value ξ.
(ii) R = {(x1 , x2 ) : x1 + x2 < ξ} for some value ξ.
(iii) R = {(x1 , x2 ) : ex1 + ex2 > ξ} for some value ξ.
(iv) R = {(x1 , x2 ) : ex1 + ex2 < ξ} for some value ξ.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : R = {(x1 , x2 ) : x1 + x2 > ξ} for some value ξ.
(ii) R = {(x1 , x2 ) : x1 + x2 < ξ} for some value ξ.
(iii) R = {(x1 , x2 ) : ex1 + ex2 > ξ} for some value ξ.
(iv) R = {(x1 , x2 ) : ex1 + ex2 < ξ} for some value ξ.', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(12 pts. total)
Aliens of two races (blue and green) are arriving on Earth independently according to Poisson process
distributions with parameters λb and λg respectively. The Alien Arrival Registration Service Authority
(AARSA) will begin registering alien arrivals soon.
Let T1 denote the time AARSA will function until it registers its ﬁrst alien. Let G be the event
that the ﬁrst alien to be registered is a green one. Let T2 be the time AARSA will function until at
least one alien of both races is registered.
(4 points.) Express µ1 = E[T1 ] in terms of λg and λb . Show your work.
1
Answer: µ1 = E[T1 ] = λg + λb', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We consider the process of arrivals of both types of Aliens. This is a merged Poisson
process with arrival rate λg +λb . T1 is the time until the ﬁrst arrival, and therefore is exponentially
1
distributed with parameter λg + λb . Therefore µ1 = E[T1 ] = λg +       λb .
One can also go about this using derived distributions, since T1 = min(T1g , T1b ) where T1g and T1b
are the ﬁrst arrival times of green and blue Aliens respectively (i.e., T1g and T1b are exponentially
distributed with parameters λg and λb , respectively. )', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(12 pts. total)
Aliens of two races (blue and green) are arriving on Earth independently according to Poisson process
distributions with parameters λb and λg respectively. The Alien Arrival Registration Service Authority
(AARSA) will begin registering alien arrivals soon.
Let T1 denote the time AARSA will function until it registers its ﬁrst alien. Let G be the event
that the ﬁrst alien to be registered is a green one. Let T2 be the time AARSA will function until at
least one alien of both races is registered.
(4 points.) Express µ2 = E[T2 ] in terms of λg and λb .
Show your work.
                               
1      λg                1             λb         1
Answer:        +                             +
λg + λb λg + λb             λb         λg + λb       λg', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The time T2 until at least one green and one red Aliens have arrived can be expressed as
T2 = max(T1g , T1b ), where T1g and T1b are the ﬁrst arrival times of green and blue Aliens respectively
(i.e., T1g and T1b are exponentially distributed with parameters λg and λb , respectively.)
1
The expected time till the 1st Alien arrives was calculated in (a), µ1 = E[T1 ] = λg +λb
. To
compute the remaining time we simply condition on the 1st Alien being green(e.g. event G) or
blue(event Gc ), and use the memoryless property of Poisson, i.e.,
E[T2 ] = E[T1 ] + P(G)E[Time until ﬁrst Blue arrives|G] + P(Gc )E[Time until ﬁrst Green arrives|Gc ]
= E[T1 ] + P(G)E[T2b ] + (1 − P(G))E[T2g ]
               
1         λg       1         λb      1
=          +                 +
λg + λb λg + λb λb           λg + λb λg
Page 10 of 18
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Spring 2009)', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(18 pts. total)
Researcher Jill is interested in studying employment in technology ﬁrms in Dilicon Valley. She denotes
by Xi the number of employees in technology ﬁrm i and assumes that Xi are independent and identically
distributed with mean p. To estimate p, Jill randomly interviews n technology ﬁrms and observes the
number of employees in these ﬁrms.
(6 points.) Find the smallest n, the number of technology ﬁrms Jill must sample, for which the
Chebyshev inequality yields a guarantee
P(|Mn − p| ≥ 0.5) ≤ 0.05.
Assume that var (Xi ) = v for some constant v. State your solution as a function of v. Show
your work.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Since Mn converges to p in probability and var(Mn ) = nn2 · var(Xi ) = v/n, Chebyshev
inequality gives
var(Mn )         v
P (|Mn − p| ≥ 0.5) ≤           =           = 0.05
0.52      n · 0.52
⇒ n = 80v.
Page 11 of 18
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Spring 2009)', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(12 pts. total)
The RandomView window factory produces window panes. After manufacturing, 1000 panes were
loaded onto a truck. The weight Wi of the i-th pane (in pounds) on the truck is modeled as a random
variable, with the assumption that the Wi ’s are independent and identically distributed.
(6 points.) Assume that the measured weight of the load on the truck was 2340 pounds, and
that var (Wi ) ≤ 4. Find an approximate 95 percent conﬁdence interval for µ = E[Wi ], using the
Central Limit Theorem (you may use the standard normal table which was handed out with this
quiz). Show your work.
           
Answer: 2.216, 2.464', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The sample mean estimator Θ̂n = W1 +···+W
n
n
in this case is
2340
Θ̂1000 =        = 2.34
1000
Using the CDF Φ(z) of the standard normal available in the normal tables, we have Φ(1.96) =
0.975, so we obtain
|Θ̂1000 − µ|
P( p                 ≤ 1.96) ≈ 0.95.
var (Wi ) /1000
Because the variance is less than 4, we have
p                                       p
P(|Θ̂1000 − µ| ≤ 1.96 var (Wi ) /1000) ≤ P(|Θ̂1000 − µ| ≤ 1.96 4/1000),
and letting the right-hand side of the above equation ≈ 0.95 gives a 95% conﬁdence, i.e.,
r                     r
                  4                     4                                
Θ̂1000 − 1.96       , Θ̂1000 + 1.96       = Θ̂1000 − 0.124, Θ̂1000 + 0.124
1000                  1000
Page 13 of 18
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Spring 2009)', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(12 pts. total)
A newscast covering the ﬁnal baseball game between Sed Rox and Y Nakee becomes noisy at the
crucial moment when the viewers are informed whether Y Nakee won the game.
Let a be the parameter describing the actual outcome: a = 1 if Y Nakee won, a = −1 otherwise.
There were n viewers listening to the telecast. Let Yi be the information received by viewer i (1 ≤ i ≤
n). Under the noisy telecast, Yi = a with probability p, and Yi = −a with probability 1 − p. Assume
that the random variables Yi are independent of each other.
The viewers as a group come up with a joint estimator
(          Pn
1     if   i=1 Yi ≥ 0,
Zn =
−1 otherwise.
(6 points.) Find limn→∞ P(Zn = a) assuming that p > 0.5 and a = 1. Show your work.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Note that
n
!              Pn          
i=1 Yi
X
lim P(Zn = 1) = lim P             Yi ≥ 0   = lim P               ≥0 .
n→∞                n→∞                        n→∞        n
i=1
Since Yi are i.i.d. with mean E[Yi ] = 2p − 1 and ﬁnite variance var(Yi ) = 1 − (2p − 1)2 , one has,
by Chebyshev inequality, for all ǫ > 0
 Pn                       
i=1 Yi
lim P              − (2p − 1) ≥ ǫ = 0.
n→∞           n
 Pn                  
i=1 Yi
Take ǫ = p− 12 , and the above equation implies limn→∞ P       n     ≤ (2p − 1)/2  = 0. Therefore,
limn→∞ P(Zn = 1) = 1.', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
Alice shows up at an Athena* cluster at time zero and spends her time
exclusively in typing emails. The times that her emails are sent are a Poisson process with rate λA per
hour.
1. (3 points) What is the probability that Alice sent exactly three emails during the time interval
[1, 2]?
(5 points) Find E[N 2 ].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (5 points) Find E[N 2 ].
Solution:
E[N 2 ] = E[E[N 2 | Λ]] = E[var(N | Λ) + (E[N | Λ])2 ]
= E[Λ + Λ2 ]
= E[Λ] + var(Λ) + (E[Λ])2
1    2
=    + 2
2 2
= 1.', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(12 points) For i = 1, 2, let Yi be the total number of ripe apples Bob picked from the
ﬁrst i trees. Find the expectation and the variance of Y2 . (Note that Y1 = X1 − 1 and
Y2 = (X1 − 1) + (X2 − 1).)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (12 points) Given that Y2 = (X1 − 1) + (X2 − 1), we can use the linearity property of
expectations to ﬁnd the expectation of Y2 .
E[Y2 ] = E[(X1 − 1) + (X2 − 1)]
= E[X1 ] + E[X2 ] − 2
2
=        −2
1−g
2g
=       .
1−g
Since adding or subtracting a constant from a random variable has no eﬀect on its
variance, and since X1 and X2 are independent, we have
var(Y2 ) = var((X1 − 1) + (X2 − 1))
= var(X1 + X2 )
= var(X1 ) + var(X2 )
2g
=          .
(1 − g)2', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(5 points) Find E[X | Y = 1/4] and Var[X | Y = 1/4], that is, the conditional mean and conditional
variance of X given that Y = 1/4.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (5 points)
To ﬁnd the conditional expectation and variance, ﬁrst we need to determine what the condi­
tional distribution is given Y = 1/4. At Y = 1/4, we take a horizontal slice of a uniform joint
PDF, which gives us a uniform distribution over the interval x ∈ [1/4, 3/4]. Thus, we have
1
E[X | Y = 1/4] = ,
2
(1/2)2   1
var(X | Y = 1/4) =           = .
12    48', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(5 points) Find P(X2 = 4 | X0 = 2).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (5 points)
The 2-step transition probability from State 2 to State 4 can be found by enumerating all the
possible sequences. They are {2 → 1 → 4} and {2 → 4 → 4}. Thus,
1 1 1   7
P(X2 = 4 | X0 = 2) =          · + ·1= .
3 6 3   18', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(5 points) What is the probability of eventually visiting state 4, given that the initial state is X0 = 1?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (5 points)
To ﬁnd the probability of being absorbed by state 4, we set up the absorption probabilities.
Note that a4 = 1 and a3 = 0.
1    1     1   1
a1 = a1 + a2 + a3 + a4
4    4     3   6
1    1     1
= a1 + a2 +
4    4     6
1     1   1
a2 = a1 + a3 + a4
3     3   3
1     1
= a1 +
3     3
Solving these equations yields a1 = 38 .
Page 2 of 7
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Fall 2009)', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(5 points) Find E[N ] and Var[N ], the unconditional mean and variance of N', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (5 points)
Using the law of iterated expectations and the law of total variance,
E[N ] = E[E[N | X]]
= E[X]
2
= ,
λ
var(N ) = E[var(N | X)] + var(E[N | X])
= E[X] + var(X)
2    2
= + 2,
λ λ
where var(N | X) = E[N | X] = X.', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(7 points) Find the joint PDF of X and Y .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (7 points)
We start by recognizing that fX (x) = e−x for x ≥ 0 and fY |X (y | x) = xe−xy for y ≥ 0.
Furthermore, fX,Y (x, y) = fX (x) · fY |X (y | x). Substituting for fx (x) and fY |X (y | x) yields,
xe−(1+y)x , x ≥ 0, y ≥ 0

fX,Y (x, y ) =
0,          otherwise.', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(7 points) Find the conditional PDF of X, given that Y = 2.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (7 points)
We are asked to compute the PDF of the random variable X while conditioning on another
random variable Y . The conditional PDF of X given that Y = 2 is
fX,Y (x, 2)  xe−3x
fX|Y (x | 2) =                      = 1
fY (2)       32
9xe−3x , x ≥ 0

fX|Y (x | 2) =
0,       otherwise.', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(7 points) Find the conditional PDF of Y , given that X = 2 and Y ≥ 3.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (7 points)
In the new universe in which X = 2, we are asked to compute the conditional PDF of Y given
the event Y ≥ 3.
fY |X (y | 2)
fY |X,Y ≥3 (y | 2) =                  .
P(Y ≥ 3 | X = 2)
We first calculate the P(Y ≥ 3 | X = 2).
Z ∞
P(Y ≥ 3 | X = 2) =                   fY |X (y | 2)dy
3
Z ∞
=           2e−2y dy
3
= 1 − FY |X (3 | 2)
= 1 − (1 − e−2·3 )
= e−6 ,
where FY |X(3|2) is the CDF of an exponential random variable with λ = 2 evaluated at y = 3.
Substituting the values of fY |X (y | 2) and P(Y ≥ 3 | X = 2) yields
2e6 e−2y , y ≥ 3

fY |X,Y ≥3 (y | 2) =
0,         otherwise.
Alternatively, fY |X (y | 2) is an exponential random variable with λ = 2. To compute the
conditional PMF fY |X,Y ≥3 (y | 2), we can apply the memorylessness property of an exponential
variable. Therefore, this conditional PMF is also an exponential random variable with λ = 2,
but it is shifted by 3.', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(5 points) The quantity E[X | Y ] is always:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (5 points) The quantity E[X | Y ] is always:
(i) A number.
(ii) A discrete random variable.
(iii) A continuous random variable.
(iv) Not enough information to choose between (i)-(iii).
If X and Y are not independent, then E[X | Y ] is a function of Y and is therefore a continuous
random variable. However if X and Y are independent, then E[X | Y ] = E[X] which is a
number.', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(i) (5 points) Find the mean of X.
(ii) (5 points) Find the variance of X.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (i) (5 points)
Using the Law of Iterated Expectations, we have
1
E[X] = E[E[X | Q]] = E[Q] = .
2
(ii) (5 points)
X is a Bernoulli random variable with a mean p = 21 and its variance is var(X ) =
p(1 − p) = 1/4.', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(8 points) Find the conditional PDF of Q given that X = 1.
3
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Fall 2009)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (8 points)
Using Bayes’ Rule, we have
fQ (q)pX |Q (1 | q)   fQ (q)P(X = 1 | Q = q)
fQ|X (q | 1) =                       =                        ,   0 ≤ q ≤ 1.
pX (1)                 P(X = 1)
Additionally, we know that
P(X = 1 | Q = q) = q,
and that for Bernoulli random variables
1
P(X = 1) = E[X] = .
2
Thus, the conditional PDF of Q given X = 1 is
1·q
fQ|X (q | 1) =
1/2

2q, 0 ≤ q ≤ 1,
=
0, otherwise.', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(7 points) Fix some s and £ with s ≤ £. Give a formula for
P(s ≤ S and L ≤ £)
involving FX and FY , and no integrals.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (7 points)
Recalling Problem 2 of Problem Set 6, we have
P(s ≤ S and L ≤ `) = P(s ≤ min{X, Y } and max{X, Y } ≤ `)
= P(s ≤ X and s ≤ Y and X ≤ ` and Y ≤ `)
= P(s ≤ X ≤ `)P(s ≤ Y ≤ `)
= (FX (`) − FX (s))(FY (`)FY (s)).', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
Multiple Choice (4 pts. each, 24 pts. total)
Clearly circle the appropriate choice. No partial credit will be given for individual questions in this
part of the quiz.
a. Earthquakes in Sumatra occur according to a Poisson process of rate λ = 2/year. Conditioned
on the event that exactly two earthquakes take place in a year, what is the probability that both
earthquakes occur in the ﬁrst three months of the year? (for simplicity, assume all months have
30 days, and each year has 12 months, i.e., 360 days).
None of the above.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We deﬁned R = {x = (x1 , x2 )|L(x) > c} where
fX (x; H1 )   θ1 e−θ1 x1 θ1 e−θ1 x2   θ12 (θ0 −θ1 )(x1 +x2 )
L(x) =               =                       =     e                  = 4e−(x1 +x2 ) .
fX (x; H0 )   θ0 e−θ0 x1 θ0 e−θ0 x2   θ02
So R = {(x1 , x2 )|x1 + x2 < − log (c/4)}
Page 8 of 18
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Spring 2009)', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(12 pts. total)
Aliens of two races (blue and green) are arriving on Earth independently according to Poisson process
distributions with parameters λb and λg respectively. The Alien Arrival Registration Service Authority
(AARSA) will begin registering alien arrivals soon.
Let T1 denote the time AARSA will function until it registers its ﬁrst alien. Let G be the event
that the ﬁrst alien to be registered is a green one. Let T2 be the time AARSA will function until at
least one alien of both races is registered.
(4 points.) Express p = P(G) in terms of λg and λb . Show your work.
λ
Answer: P(G) = λg +gλb', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We consider the same merged Poisson process as before, with arrival rate λg +λb . Any
λ
particular arrival of the merged process has probability λg +gλb of corresponding to a green Alien
λ
and probability λgλ+bλb of corresponding to a blue Alien. The question asks for P(G) = λg +gλb .
Page 9 of 18
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Spring 2009)', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(18 pts. total)
Researcher Jill is interested in studying employment in technology ﬁrms in Dilicon Valley. She denotes
by Xi the number of employees in technology ﬁrm i and assumes that Xi are independent and identically
distributed with mean p. To estimate p, Jill randomly interviews n technology ﬁrms and observes the
number of employees in these ﬁrms.
(6 points.) Jill uses
X1 + · · · + Xn
Mn =
n
as an estimator for p. Find the limit of P(Mn ≤ x) as n → ∞ for x < p. Find the limit of
P(Mn ≤ x) as n → ∞ for x > p. Show your work.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Since Xi is i.i.d., Mn converges to p in probability, i.e., limn→∞ P(|Mn − p| > ǫ) = 0,
implying limn→∞ P(Mn < p − ǫ) = 0 and limn→∞ P(Mn > p + ǫ) = 0, for all ǫ > 0. Hence

0, x < p ,
lim P(Mn ≤ x) =
n→∞                     1, x > p .', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(18 pts. total)
Researcher Jill is interested in studying employment in technology ﬁrms in Dilicon Valley. She denotes
by Xi the number of employees in technology ﬁrm i and assumes that Xi are independent and identically
distributed with mean p. To estimate p, Jill randomly interviews n technology ﬁrms and observes the
number of employees in these ﬁrms.
(6 points.) Assume now that the researcher samples n = 5000 ﬁrms. Find an approximate value
for the probability
P(|M5000 − p| ≥ 0.5)
using the Central Limit Theorem. Assume again that var (Xi ) = v for some constant v. Give
your answer in terms of v, and the standard normal CDF Φ. Show your work.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : By CLT, we can approximate by a standard normal distribution
Pn
i=1√Xi − np
nv
when n is large, and hence,
 Pn                 √            √ 
i=1√Xi − np    0.5 n            0.5 n
P (|M5000 − p| ≥ 0.5) = P                    ≥ √     = 2 − 2Φ    √   ,
nv            v                 v
where n = 5000.
Page 12 of 18
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Spring 2009)', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(12 pts. total)
The RandomView window factory produces window panes. After manufacturing, 1000 panes were
loaded onto a truck. The weight Wi of the i-th pane (in pounds) on the truck is modeled as a random
variable, with the assumption that the Wi ’s are independent and identically distributed.
(6 points.) Now assume instead that the random variables Wi are i.i.d, with an exponential
distribution with parameter θ > 0, i.e., a distribution with PDF
fW (w; θ) = θe−θw
What is the maximum likelihood estimate of θ, given that the truckload has weight 2340 pounds?
Show your work.
1000
Answer: Θ̂mle
1000 = 2340 = 0.4274', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The likelihood function is
n
Y                      n
Y
fW (w; θ) =         fWi (wi ; θ) =         θe−θwi ,
i=1                    i=1
And the log-likelihood function is
n
X
log fW (w; θ) = n log θ − θ                 wi ,
i=1
Pn
The derivative with respect to θ is nθ − i=1 wi ,, and by setting it to zero, we see that the
maximum of log fW (w; θ) over θ ≥ 0 is attained at θ̂n = P nn wi . The resulting estimator is
i=1
n
Θ̂mle
n   = Pn                 .
i=1 Wi
In our case,
1000
Θ̂mle
1000 =          = 0.4274
2340
Page 14 of 18
Department of Electrical Engineering & Computer Science
6.041/6.431: Probabilistic Systems Analysis
(Spring 2009)', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.041 — question d’examen, en anglais]
(12 pts. total)
A newscast covering the ﬁnal baseball game between Sed Rox and Y Nakee becomes noisy at the
crucial moment when the viewers are informed whether Y Nakee won the game.
Let a be the parameter describing the actual outcome: a = 1 if Y Nakee won, a = −1 otherwise.
There were n viewers listening to the telecast. Let Yi be the information received by viewer i (1 ≤ i ≤
n). Under the noisy telecast, Yi = a with probability p, and Yi = −a with probability 1 − p. Assume
that the random variables Yi are independent of each other.
The viewers as a group come up with a joint estimator
(          Pn
1     if   i=1 Yi ≥ 0,
Zn =
−1 otherwise.
(6 points.) Find limn→∞ P(Zn = a), assuming that p = 0.5 and a = 1. Show your work.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Note that
n
!            Pn        
X
i=1 Yi
lim P(Zn = 1) = lim P             Yi ≥ 0   = lim P    √      ≥0 .
n→∞                n→∞                       n→∞         n
i=1
Pn
=1 Yi
Since Yi are i.i.d. with E[Yi ] = 0 and var(Yi ) = 1, we can approximate          i√
n
as a standard
normal random variable when n goes to inﬁnity. Thus, limn→∞ P(Zn = 1) = 1/2.
Page 18 of 18
6.041 / 6.431 Probabilistic Systems Analysis and Applied Probability
Fall 2010
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.041 Probabilistic Systems Analysis And Applied Probability, Fall 2010 — examen et corrigé officiel (MIT EECS)'),
						),
					),
				),
			),
		);
	}
}
