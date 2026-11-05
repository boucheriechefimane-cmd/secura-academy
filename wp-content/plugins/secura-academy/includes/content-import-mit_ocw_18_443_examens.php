<?php
/**
 * Questions importees — MIT OpenCourseWare — 18 443 statistics for applications spring 2015
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_18_443_examens' ) ) {
	function seca_import_mit_ocw_18_443_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-18-443-examens', 'nom' => 'MIT OpenCourseWare — 18 443 statistics for applications spring 2015', 'url' => 'https://ocw.mit.edu/courses/18-443-statistics-for-applications-spring-2015/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 7 Spring 2015 Statistics for Applications Due Date: 4/17/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem] For full credit, explain your reasoning and detail any calculations.
10.9.6 (See script in RProject7)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : See the script/html ﬁle “Rproject7 5 beeswax solution.r”
(a). The data appears normal with some deviations at the extreme
tails. These deviations can happen with normal samples, but occur
about 1 in 15 times. (It is possible to formally test for normality using
the Kolmogorov-Smirnov Test, which gives a P -value of about 0.06).
(b). There are several ways to answer this question. The R script
evaluates the power of level-0.05 test of H0 (no dilution with distri­
bution that is normal with mean and variance equal to those in the
sample) versus H1 (dilution increasing the mean hydrocarbon level).
The analysis ﬁnds the power for detecting the alternative is 0.231 for
dilution of 1%, 0.859 for dilution of 2% and 0.998 for dilution of 3%
An alternative way is to construct a 95% conﬁdence interval for the
mean hydrocarbon level of beeswax using the sample data. Then,
evaluate whether the means of the diluted beeswax distributions are
in the conﬁdence interval. For those dilutions which have mean values
outside the interval, we would expect the power of the test to be greater
than 50%. The ﬁrst approach provides some insight into how the power
varies at diﬀerent dilution levels.', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 7 Spring 2015 Statistics for Applications Due Date: 4/17/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem] For full credit, explain your reasoning and detail any calculations.
10.9.35', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : For a normal sample, the proportion of observations ex­
pected to be marked by an asterisk on a boxplot is equal to the per­
centage of a normal sample that falls more than 1.5 IQRs above the
third quartile and lower than 1.5 IQRs below the lower quartile. The
answer is 0.000697 (less than 1%).
> # For boxplot, an asterisk on the high side is the upper-probability
> # of a N(0,1) distribution corresponding to a crititcal value
> #which is 1.5 IQRs above the third quartile
> z0=qnorm(.75)+(qnorm(.75)-qnorm(.25))*1.5
>
> 1-pnorm(z0)
[1] 0.003488302
>
> 2*(1-pnorm(z0))
[1] 0.006976603', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 7 Spring 2015 Statistics for Applications Due Date: 4/17/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem] For full credit, explain your reasoning and detail any calculations.
10.9.43 (See script in RProject7)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : 10.9.43 (See script RProject7 7 kevlar.r)
From the output, for the higher stresses, there is a faster rate of failure
– the slopes become stronger (negative).
At 70% stress, the ESF is mostly linear but steepens at the end (indi­
cating a faster failure rate).
This is more pronounced in the 80% stress case.
At 90% stress, the ESF is mostly linear.', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Exam 1 Spring 2015 Statistics for Applications 3/5/2015
The Pareto distribution is used in economics to model values exceed­
ing a threshhold (e.g., liability losses greater than $100 million for a
consumer products company). For a ﬁxed, known threshhold value of
x0 > 0, the density function is
f (x | x0 , θ) = θxθ0 x−θ−1 ,   x ≥ x0 , and θ > 1.
Note that the cumulative distribution function of X is
x −θ
P (X ≤ x) = FX (x) = 1 −           .
x0
(a). Find the method-of-moments estimate of θ.
(b). Find the mle of θ.
(c). Find the asymptotic variance of the mle.
(d). What is the large-sample asymptotic distribution of the mle?
2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The Pareto distribution is used in economics to model values exceed­
ing a threshhold (e.g., liability losses greater than $100 million for a
consumer products company). For a ﬁxed, known threshhold value of
x0 > 0, the density function is
f (x | x0 , θ) = θxθ0 x−θ−1 ,    x ≥ x0 , and θ > 1.
Note that the cumulative distribution function of X is
( o−θ
x
P (X ≤ x) = FX (x) = 1 −           .
x0
(a). Find the method-of-moments estimate of θ.
(b). Find the mle of θ.
(c). Find the asymptotic variance of the mle.
(d). What is the large-sample asymptotic distribution of the mle?
Solution:
(a) Compute the ﬁrst moment of a Pareto random variable X :
J∞
µ1 = x0 xf (x | x0 , θ)dx
J∞
= x0 x × θxθ0 x−θ−1 dx
J∞
= θxθ0 x0 x−θ dx
1        −(θ−1)
= θxθ0(( θ−1  )xo
0
θ
= x0
θ−1
Solving µ1 = µ̂1 = x for θ gives:
θˆ =    x
x−x0
(b). For a single observation X = x, we can write
log[f (x | θ)] = ln(θ) + θ ln(x0 ) − (θ − 1) ln(x)
∂ log[f (x|θ)
∂θ       ]   = 1θ + ln(x0 ) − ln(x)
2
∂ log[f (x|θ)
∂θ2
] = − θ12
The mle for θ solves
0 = ∂J(θ)
∂θ   = P  ∂ Pn
∂θ ( i=1 ln[f (xi | θ)])
n 1
=       1 [ θ + ln(x0 ) P − ln(xi )]
= θ + n ln(x0 ) − n1 ln(xi )
n
n
= [ n1 n1 ln(xi /x0 )]−1
P
=⇒ θ̂ =       n
ln(xi )−n ln(x0 )
1
(c). The asymptotic variance of θ̂ is
1     θ2
V ar(θ̂) ≈     nI(θ) = n
3
2
Because I(θ) = E[− ∂ ln[f
∂θ2
(x|θ)]
] = θ12
(d) The asymptotic distribution of θ̂ is
√            D         1
n(θ̂ − θ) −−→ N (0, I(θ) ) = N (0, θ2 )
or
D          2
θ̂ −−→ N (θ, θn )
4', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Exam 1 Spring 2015 Statistics for Applications 3/5/2015
Hardy-Weinberg (Multinomial) Model of Gene Frequencies
For a certain population, gene frequencies are in equilibrium: the geno­
types AA, Aa, and aa occur with probabilities (1 − θ)2 , 2θ(1 − θ), and
θ2 . A random sample of 50 people from the population yielded the
following data:
Genotype Type
AA Aa aa
35   10 5
The table counts can be modeled as the multinomial distribution:
(X1 , X2 , X3 ) ∼ M ultinomial(n = 50, p = ((1 − θ)2 , 2θ(1 − θ), θ2 ).
(a). Find the mle of θ
(b). Find the asymptotic variance of the mle.
(c). What is the large sample asymptotic distribution of the mle?
(d). Find an approximate 90% conﬁdence interval for θ. To construct
the interval you may use the follow table of cumulative probabilities
for a standard normal N (0, 1) random variable Z
P (Z < z)    z
0.99         2.326
0.975        1.960
0.950        1.645
0.90         1.182
(e). Using the mle θ̂ in (a), 1000 samples from the
M ultinomial(n = 50, p = ((1 − θ̂)2 , 2θ̂(1 − θ̂), θ̂2 ))
distribution were randomly generated, and mle estimates were com­
puted for each sample: θ̂j∗ , j = 1, . . . , 1000.
For the true parameter θ0 , the sampling distribution of Δ = θ̂ − θ0 is
approximated by that of Δ          ˆ The 50-th largest value of Δ̃ was
˜ = θ̂∗ − θ.
+0.065 and the 50-th smallest value was −0.067.
Use this information and the estimate in (a) to construct a (para­
metric) bootstrap conﬁdence interval for the true θ0 . What is the
conﬁdence level of the interval? (If you do not have an answer to part
(a), assume the mle θ̂ = 0.25).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a). Find the mle of θ
8
• (X1 , X2 , X3 ) ∼ M ultinomial(n, p = ((1 − θ)2 , 2θ(1 − θ), θ2 ))
• Log Likelihood for θ
£(θ) = log(f (x1 , x2 , x3 | p1 (θ), p2 (θ), p3 (θ)))
= log( x1 !xn!2 !x3 ! p1 (θ)x1 p2 (θ)x2 p3 (θ)x3 )
= x1 log((1 − θ)2 ) + x2 log(2θ(1 − θ))
+x3 log(θ2 ) + (non-θ terms)
= (2x1 + x2 )log(1 − θ) + (2x3 + x2 )log(θ) + (non-θ terms)
• First Diﬀerential of log likelihood:
(2x1 + x2 ) (2x3 + x2 )
£" (θ) = −                      +
1−θ                       θ
2x3 + x2      2x3 + x2   2(5) + 10
=⇒ θˆ =                    =          =           = 0.2
2x1 + 2x2 + 2x3      2n        2(50)
(b). Find the asymptotic variance of the mle.
1
• V ar(θ̂) −→
E[−£"" (θ)]
• Second Diﬀerential of log likelihood:
d     (2x1 + x2 ) (2x3 + x2 )
£"" (θ) =    [−             +           ]
dθ       1−θ             θ
(2x1 + x2 ) (2x3 + x2 )
= −           −
(1 − θ)2       θ2
• Each of the Xi are Binomial(n, pi (θ)) so
E[X1 ] = np1 (θ) = n(1 − θ)2
E[X2 ] = np2 (θ) = n2θ(1 − θ)
E[X3 ] = np3 (θ) = nθ2
2n
• E[−£"" (θ)] =
θ(1 − θ)
θ̂(1 − θ̂)   0.8(1 − 0.8)
• σ̂θ̂2 =              =              = 0.16/100 = (.4/10)2 = (.04)2
2n          2 × 50
(c) The asymptotic distribution of θ̂ is N (θ, θ(1−θ)
2n )
(d) An approximate 90% conﬁdence interval for θ is given by
i                          i
{θ : θ̂ − z(α/2) V ar(θ̂) < θ < θ̂ + z(α/2) V ar(θ̂)}
i
where α = 1 − 0.90 and z(.05) = 1.645, and V ar(θ̂) ≈ (.04).
9
So the approximate 90% conﬁdence interval is:
{θ : 0.20 − .06580 < θ < 0.20 + .06580}
(e). For the bootstrap distribution of the errors Δ = θ̂ − θ0 , (where θ0
is the true value), the approximate 5% and 95% quantiles are
δ = −0.067 and δ = 0.065.
The approximate 90% conﬁdence interval is
{θ : θ̂ − δ < θ < θ̂ − δ}
= [0.2 − 0.065, 0.2 + 0.067]', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] NAME: 18.443 Exam 3 Spring 2015 Statistics for Applications 5/7/2015
Simple Linear Regression
Consider ﬁtting the simple linear regression model:
ŷ = β1 + β2 xi
to the following bivariate data:
i   xi    yi
1   -5    -2
2   -2     0
3   3      3
4   4      5
The following code in R ﬁts the model:
> x=c(-5,-2,3,4)
> y=c(-2,0,3,5)
> plot(x,y)
> lmfit1<-lm(y ~ x)
> abline(lmfit1)
> print(summary(lmfit1))
Call:
lm(formula = y ~ x)
Residuals:
1
1        2        3             4
0.11111 -0.05556 -0.66667       0.61111
Coefficients:
Estimate Std. Error t value Pr(>|t|)
(Intercept) 1.50000     0.32275   4.648   0.0433 *
x            0.72222    0.08784   8.222   0.0145 *
---
Signif. codes: 0 \'***\' 0.001 \'**\' 0.01 \'*\' 0.05 \'.\' 0.1 \' \' 1
Residual standard error: 0.6455 on 2 degrees of freedom
Multiple R-squared: 0.9713,         Adjusted R-squared:             0.9569
F-statistic: 67.6 on 1 and 2 DF, p-value: 0.01447
5
4
3
2
y
1
0
−1
−2
−4       −2          0       2          4
x
(a). Solve directly for the least-squares estimates of the intercept and
slope of the simple linear regression (obtain the same values as in the R
print summary)
(b). Give formulas for the least-squares estimates of β1 and β2 in terms
of the simple statistics
x = 0, and y = 1.5
sx =    Sx2 =4.2426
2
�
sy =    Sy2 =3.1091
S
r = Corr(x, y) = Sxxy
Sy =0.9855
(c). In the R print summary, the standard error of the slope β̂2 is given
as σ̂βˆ2 =0.0878
Using σ̂ =0.65, give a formula for this standard error, using the statistics
in (b).
(d). What is the least-squares prediction of Ŷ when X = x = 0, and what
is its standard error (estimate of its standard deviation)?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Simple Linear Regression
Consider ﬁtting the simple linear regression model:
ŷ = β1 + β2 xi
to the following bivariate data:
i   xi    yi
1   -5    -2
2   -2     0
3   3      3
4   4      5
The following code in R ﬁts the model:
> x=c(-5,-2,3,4)
> y=c(-2,0,3,5)
> plot(x,y)
> lmfit1<-lm(y ~ x)
2
> abline(lmfit1)
> print(summary(lmfit1))
Call:
lm(formula = y ~ x)
Residuals:
1        2        3             4
0.11111 -0.05556 -0.66667       0.61111
Coefficients:
Estimate Std. Error t value Pr(>|t|)
(Intercept) 1.50000     0.32275   4.648   0.0433 *
x            0.72222    0.08784   8.222   0.0145 *
---
Signif. codes: 0 \'***\' 0.001 \'**\' 0.01 \'*\' 0.05 \'.\' 0.1 \' \' 1
Residual standard error: 0.6455 on 2 degrees of freedom
Multiple R-squared: 0.9713,         Adjusted R-squared:             0.9569
F-statistic: 67.6 on 1 and 2 DF, p-value: 0.01447
5
4
3
2
y
1
0
−1
−2
−4        −2           0       2          4
x
(a). Solve directly for the least-squares estimates of the intercept and
slope of the simple linear regression (obtain the same values as in the R
3
print summary)
Solution: The least-squares estimates are given by
β̂1
β̂ =               = (X T X)−1 X T Y , where
β̂2
⎡             ⎤ ⎡        ⎤         ⎡    ⎤ ⎡      ⎤
1             x1       1 −5             y1       −2
⎥ = ⎢ 1 −2 ⎥ and Y = ⎢ y2 ⎥ = ⎢ 0 ⎥
⎢ 1             x2 ⎥   ⎢      ⎥         ⎢    ⎥ ⎢      ⎥
X=⎢
⎣ 1             x3 ⎦   ⎣ 1  3 ⎦         ⎣ y3 ⎦   ⎣  3 ⎦
1             x4       1  4             y4        5
Plugging in we get
P4    P     −1    P
β̂ = (X X)  T      −1
X Y T
=   P1 1 P x2i        P yi
xi   xi         xi yi
−1
4 0        6
=
0 54       39
6/4        1.5
=         =
39/54      0.7222
(b). Give formulas for the least-squares estimates of β1 and β2 in terms
of the simple statistics
x = 0, and y = 1.5
sx =        Sx2 =4.2426
sy =       Sy2 =3.1091
S
r = Corr(x, y) = Sxxy
Sy =0.9855
Solution: We know formulas for the least-squares estimates of the slope
and intercept are given by:
Pn                            √ 2
(xi −x)(yi −(y))   Sxy      S     s
ˆ
β2 =        1P
n                       √
= S 2 = r y2 = r sxy
(x −x)2    i        x        Sx
1
=         (0.9855) × 3.1091
4.2426 = 0.7222
β̂1   = y − β̂2 x
= 1.5 − (0.7222) × (0) = 1.5
(c). In the R print summary, the standard error of the slope β̂2 is given
as σ̂βˆ2 =0.0878
Using σ̂ =0.65, give a formula for this standard error, using the statistics
in (b).
Solution: We know that the variance of the slope from a simple linear
regression model (where the errors have mean zero, constant variance σ 2
and are uncorrelated) is
Pn
V ar(β̂2 ) = σ 2 / 1 (xi − x)2 = σ 2 /[(n − 1)Sx2 ]
The standard error of β̂2 is the square-root of this variance, plugging in
the estimate σ̂ for the standard deviation of the errors:
4
p                    √
StErr(β̂2 ) = σ/(
ˆ    (n − 1)sx ) = 0.65/( 34.2526) = .088
(d). What is the least-squares prediction of Ŷ when X = x = 0, and what
is its standard error (estimate of its standard deviation)?
Solution: The least-squres prediction of Ŷ when X = x must be y, the
mean of the dependent variable. The simple least-squares regression line
always goes through the point of means: (x, y) = (x, y)
The standard error of this prediction is just the estimate of the standard
deviation of the sample mean y which is
q
2
σ̂y = σ̂n = √σ̂4 = 0.65/2 = 0.325', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] NAME: 18.443 Exam 3 Spring 2015 Statistics for Applications 5/7/2015
CAPM Model
The CAPM model was ﬁt to model the excess returns of Exxon-Mobil (Y)
as a linear function of the excess returns of the market (X) as represented
by the S&P 500 Index.
Yi = α + βXi + Ei
where the Ei are assumed to be uncorrelated, with zero mean and constant
variance σ 2 . Using a recent 500-day analysis period the following output
was generated in R:
3
XOM
0.03
0.02
0.01
Y (Stock Excess Return)
0.00
−0.02
−0.04
−0.02   −0.01      0.00       0.01    0.02
X (Market Excess Return)
> print(summary(lmfit0))
Call:
lm(formula = r.daily.symbol0.0[index.window] ~ r.daily.SP500.0[index.window],
x = TRUE, y = TRUE)
Residuals:
Min        1Q                            Median             3Q        Max
-0.038885 -0.004415                          0.000187       0.004445   0.026748
Coefficients:
Estimate Std. Error t value Pr(>|t|)
(Intercept)                  -0.0004805 0.0003360    -1.43    0.153
r.daily.SP500.0[index.window] 0.9190652 0.0454380    20.23   <2e-16
Residual standard error: 0.007489 on 498 degrees of freedom
Multiple R-squared: 0.451,         Adjusted R-squared: 0.4499
F-statistic: 409.1 on 1 and 498 DF, p-value: < 2.2e-16
(a). Explain the meaning of the residual standard error.
(b). What does “498 degrees of freedom” mean?
4
(c). What is the correlation between Y (Stock Excess Return) and X
(Market Excess Return)?
(d). Using this output, can you test whether the alpha of Exxon Mobil is
zero (consistent with asset pricing in an eﬃcient market).
H0 : α = 0 at the signiﬁcance level α = .05?
If so, conduct the test, explain any assumptions which are necessary, and
state the result of the test?
(e). Using this output, can you test whether the β of Exxon Mobil is less
than 1, i.e., is Exxon Mobil less risky than the market:
H0 : β = 1 versus HA : β < 1.
If so, what is your test statistic; what is the approximate P -value of the
test (clearly state any assumptions you make)? Would you reject H0 in
favor of HA ?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : CAPM Model
The CAPM model was ﬁt to model the excess returns of Exxon-Mobil (Y)
as a linear function of the excess returns of the market (X) as represented
by the S&P 500 Index.
Yi = α + βXi + Ei
where the Ei are assumed to be uncorrelated, with zero mean and constant
variance σ 2 . Using a recent 500-day analysis period the following output
was generated in R:
XOM
0.03
0.02
0.01
Y (Stock Excess Return)
0.00
−0.02
−0.04
−0.02    −0.01      0.00       0.01    0.02
X (Market Excess Return)
> print(summary(lmfit0))
Call:
lm(formula = r.daily.symbol0.0[index.window] ~ r.daily.SP500.0[index.window],
x = TRUE, y = TRUE)
Residuals:
Min        1Q                                 Median             3Q        Max
-0.038885 -0.004415                               0.000187       0.004445   0.026748
Coefficients:
Estimate Std. Error t value Pr(>|t|)
(Intercept)                                                      -0.0004805 0.0003360    -1.43    0.153
6
r.daily.SP500.0[index.window]         0.9190652    0.0454380      20.23       <2e-16
Residual standard error: 0.007489 on 498 degrees of freedom
Multiple R-squared: 0.451,         Adjusted R-squared: 0.4499
F-statistic: 409.1 on 1 and 498 DF, p-value: < 2.2e-16
(a). Explain the meaning of the residual standard error.
Solution: The residual standard error is an estimate of the standard devi­
ation of the error term in the regression model. It is given by
Pn
(yi −ŷi )2
q
σ̂ = SS  ERR
(n−p) =       1
n−p
It measures the standard deviation of the diﬀerence between the actual
and ﬁtted value of the dependent variable.
(b). What does “498 degrees of freedom” mean?
Solution: The degrees of freedom equals (n − p) where n = 500 is the
number of sample values and p = 2 is the number of regression parameters
being estimated.
(c). What is the correlation between Y (Stock Excess Return) and X
(Market Excess Return)?
√              √
Solution: The correlation is R − Squared = .451 ≈ .67
(we know it is positive because of the positive slope coeﬃcient 0.919)
(d). Using this output, can you test whether the alpha of Exxon Mobil is
zero (consistent with asset pricing in an eﬃcient market).
H0 : α = 0 at the signiﬁcance level α = .05?
If so, conduct the test, explain any assumptions which are necessary, and
state the result of the test?
Solution: Yes, apply a t-test of H0 : intercept equals 0. R computes this
in the coeﬃcients table and the statistic value is −1.43 with a (two-sided)
p-value of 0.153. For a nominal signiﬁcance level of .05 for the test (two-
sided), the null hypothesis is not rejected because the p-value is higher
than the signiﬁcance level. The assumptions necessary to conduct the test
are that the error terms in the regression are i.i.d. normal variables with
mean zero and constant variance σ 2 > 0. If the normal distribution doesn’t
apply, then so long as the error distribution has mean zero and constant
variance, the test is approximately approximately correct and equivalent
to using a z-test for the parameter/estimate and the CLT.)
(e). Using this output, can you test whether the β of Exxon Mobil is less
than 1, i.e., is Exxon Mobil less risky than the market:
H0 : β = 1 versus HA : β < 1.
If so, what is your test statistic; what is the approximate P -value of the
test (clearly state any assumptions you make)? Would you reject H0 in
favor of HA ?
7
Solution: Yes, we apply a one-sided t-test using the statistic:
β̂−1
T = stErr(β̂) = 0.919−1
0.0454 = −.081/.0454 = −1.7841
Under the null hypothesis T has a t-distribution with 498 degrees of free­
dom. This distribution is essentially the N (0, 1) distribution since the
degrees of freedom is so high. The p-value of this statistic (one-sided)
is less than 0.05 because P (Z < −1.645) = 0.05 for a Z ∼ N (0, 1) so
P (T < −1.7841) ≈ P (Z < −1.7841) which is smaller.', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] NAME: 18.443 Exam 3 Spring 2015 Statistics for Applications 5/7/2015
Suppose X1 , . . . , Xn are n values sampled at random from a ﬁxed distri­
bution:
Xi = θ + Ei
where θ is a location parameter and the Ei are i.i.d. random variables with
mean zero and median zero.
(a). Give explicit deﬁnitions of 3 diﬀerent estimators of the location pa­
rameter θ.
(b). For each estimator in (a), explain under what conditions it would be
expected to be better than the other two.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Suppose X1 , . . . , Xn are n values sampled at random from a ﬁxed distri­
bution:
X i = θ + Ei
where θ is a location parameter and the Ei are i.i.d. random variables with
mean zero and median zero.
(a). Give explicit deﬁnitions of 3 diﬀerent estimators of the location pa­
rameter θ.
(b). For each estimator in (a), explain under what conditions it would be
expected to be better than the other two.
Solution:
(a). Consider the sample mean, the sample median, and the 10%-Trimmed
mean.
Pn
θ̂M EAN = n1 1 Xi .
θ̂M EDIAN = median(X1 , X2 , . . . , Xn )
10
θ̂T rimmedM ean = average of {Xi } after excluding the highest 10%
and the lowest 10% values.
(b). We expect the sample mean to be the best when the data are a
random sample from the same normal distribution. In this case it is the
MLE and will have lower variability than any other estimate.
We expect the same median to be the best when the data are a random
sample from the bilateral exponential distribution. In this case it is the
MLE and will hve lower variability, asymptotically than any other esti­
mate. Also, the median is robust against gross outliers in the data result­
ing from the possibility of sampling distribution including a contamination
component.
We expect the trimmed mean to be best when the chance of gross errors
in the data are such that no more than 10% of the highest and 10% of the
lowest could be such gross errors/outliers. For this estimate to be better
than the median, it must be that the information in the mean of the re­
maining values (80% untrimmed) is more than the median. This would be
the case if 80% of the data values came from a normal distribution/model.
arise from a normal distribution with
11
Percentiles of the Normal and t Distributions
q 0.5   q 0.75   q 0.9   q 0.95   q 0.99   q 0.999
N(0,1)    0.00     0.67    1.28     1.64     2.33      3.09
t (df=1)    0.00     1.00    3.08     6.31    31.82    318.31
t (df=2)    0.00     0.82    1.89     2.92     6.96     22.33
t (df=3)    0.00     0.76    1.64     2.35     4.54     10.21
t (df=4)    0.00     0.74    1.53     2.13     3.75      7.17
t (df=5)    0.00     0.73    1.48     2.02     3.36      5.89
t (df=6)    0.00     0.72    1.44     1.94     3.14      5.21
t (df=7)    0.00     0.71    1.41     1.89     3.00      4.79
t (df=8)    0.00     0.71    1.40     1.86     2.90      4.50
t (df=9)    0.00     0.70    1.38     1.83     2.82      4.30
t (df=10)     0.00     0.70    1.37     1.81     2.76      4.14
t (df=25)     0.00     0.68    1.32     1.71     2.49      3.45
t (df=50)     0.00     0.68    1.30     1.68     2.40      3.26
t (df=100)     0.00     0.68    1.29     1.66     2.36      3.17
t (df=500)     0.00     0.67    1.28     1.65     2.33      3.11', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 1 Spring 2014 Statistics for Applications Due Date: 2/13/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
Suppose the random variable X has a t distribution with n degrees of
freedom. For what values of n is the variance ﬁnite/inﬁnite. Derive a
formula for the variance of X (when it is ﬁnite).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Suppose the random variable X has a t distribution with n degrees of
freedom.
(a). For what values of n is the variance ﬁnite/inﬁnite.
(b). Derive a formula for the variance of X (when it is ﬁnite).
Solution:
(a). For the variance of the t distribution to be ﬁnite it must have a
ﬁnite second moment:
2
E[T 2 ] =       t2 fT (t)dt < ∞.
a
The integrand of this second moment calculation is proportional to
t2 fT (t) ∝     t2          t→∞    (n+1)/2 × t2−(n+1) ∝ t1−n
2
(n+1)/2 −−−−−→ n
t
1+
n
The integral of this integrand thus converges if and only if
(1 − n) < (−1), which is equivalent to n > 2.
(b). If n > 2, then the variance of T is ﬁnite.pFor such n, the mean
of T exists and is zero, so writing T = Z/ U/n for independent
Z ∼ N (0, 1) and U ∼ χ2n
p
V ar(T ) = E[T 2 ] = E[[Z/ U/n]2 ] = E[nZ    2 /U ]
2       1
E
= n × E[Z ] × E U
1
= 1 × n × (n−2)
n
=
n−2
1
The expectation E[ U ] = 1/(n − 2) can be computed directly for n > 2.
(Note that the formula is undeﬁned for n = 2 and gives negative values
for n < 2)', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 1 Spring 2014 Statistics for Applications Due Date: 2/13/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
Problem 8.10.10.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Problem 8.10.10.
Use the normal approximation of the Poisson distribution to sketch
the approximate sampling distribution of λ̂ of Example A of Section
8.4. According to this approximation, what is
4
P (|λ0 − λ̂| > δ) for δ = −.5, 1, 1.5, 2, 2.5
where λ0 is the true value of λ.
Solution:
n
In the example, the estimate λ̂ = X = n1           1 Xi = 24.9, with n = 23.
The X1 , . . . , Xn are assumed to be i.i.d. (independent and identically
distributed) P oisson(λ0 ) random variables with
E[Xi ] = λ0 and V ar[Xi ] = λ0
By the Central Limit Theorem
√ (X−λ0 )     n→∞
n √λ      −−−−→ N (0, 1).
0
The approximate sampling distribution of λ̂ is thus a Normal distri­
bution centered λ0 with
standard deviation equal to λ0 /n ≈ nλ̂ = 24.9/23 = 1.040485.
p                p
For the probability computations:
P (|λ0 − λ̂| > δ) = P (|λ0 − X| > δ)
√
n|λ0 − X| √ δ
= P(     √        > n√ )
λ0 √         λ0
≈ P (|N (0, 1)| > n √δ )
√    λ̂
23
= P (|N (0, 1)| > √24.9 δ)
p
= 2 × (1 − Φ( 23/24.9 × δ))
Using R and the function pnorm we can compute the desired values:
> 2 * 1-pnorm( sqrt(23/24.9) * c(.5,1.,1.5,2.,2.5))
[1] 1.315420 1.168253 1.074703 1.027292 1.008137
5', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 4 Spring 2015 Statistics for Applications Due Date: 3/13/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
Problem 8.10.5', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Problem 8.10.5
X is a descrete random varialbe with
P (X = 1) = θ and P (X = 2) = 1 − θ.
Three independent ovservations of X are made:
x1 = 1, x2 = 2, x = 2.
(a). Find the method of moments estimate of θ
µ1 = E[X] = 1 × (θ) + 2 × (1 − θ) = 2 − θ.
Setting µ̂1 = X = µ1 and solving for θ gives
θˆ = 2 − µ̂1 = 2 − X = 2 − 5/3 = 1/3.
(b). What is the likelihood function?
Lik(θ) = f (x1 | θ) × f (x2 | θ) × f (x3 | θ)
= θ × (1 − θ) × (1 − θ) = θ(1 − θ)2 .
(c).The mle for θ is found by solving
∂                    ∂
0 = ∂θ [log (Lik(θ))] = ∂θ [ln(θ) + 2 ln(1 − θ)]
1      2
= θ − 1−θ
=⇒ θ̂ = 1/3.
(d). The uniform distribution has density
π(θ) = 1, 0 < θ < 1
The posterior distribution has density
π(θ | x) ∝ π(θ) × Lik(θ)
= θ(1 − θ)2 × 1
By inspection, the posterior density must be that of a Beta(a, b) dis­
tribution with
a = 2 and b = 3.
1', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 4 Spring 2015 Statistics for Applications Due Date: 3/13/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
Problem 8.10.32', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Problem 8.10.32
The R code in P roblem 8 10 32.html provides numerical solutions to
(a), (b), and (c).
(a). Reasonable guesses for the mean µ and variance σ 2 are the mle
for µ and the unbaised sample variance for σ 2 .
µ̂ = X.
1    Pn
σ̂ 2 = n−1    i=1 (Xi − X)
2
(Alternates are reasonable if suggested, e.g., the mle for the variance.)
(b). Conﬁdence intervals for µ :
Let CI.level (×100%) be the conﬁdence level of the interval.
Set α = 1 − CI.level and deﬁne t∗ = t(α/2, df = (n − 1)), the upper
α/2 quantile of a t distribution with n − 1 degrees of freedom. Then
the conﬁdence interval for µ is
√ √                  √ √
{µ : µ̂ − t∗ s2 / n < µ < µ̂ + t∗ s2 / n}.
Conﬁdence intervals for σ 2 :
Let CI.level (×100%) be the conﬁdence level of the interval.
Set α = 1 − CI.level and deﬁne χ∗U pper = χ(α/2, df = (n − 1)), the
upper α/2 quantile of a chi − square random variable with (n − 1)
degrees of freedom, and χ∗Lower = χ(1 − α/2, df = (n − 1)), the lower
α/2 quantile of the same distribution. The conﬁdence interval is:
{σ 2 : σ̂ 2 × χn−1
U pper
n−1
< σ 2 < σ̂ 2 × χLower }
(c). To compute conﬁdence intervals for σ rather than σ 2 , just take
the square roots of the corresponding conﬁdence intervals for sigma2 .
3
(d). To halve the conﬁdence interval for µ, the sample size should
increase about 4 times. The standard deviation of the sample mean is
√
σ/ n so this is halved when the sample size is increased by a factor
of 4. This argument does not account for the fact that the critical
value of the t distribution of a given α/2 level is smaller the higher
the degrees of freedom. So, the factor of 4 is an upper bound on the
the sample size increase required. Also, the length of the conﬁdence
interval for µ is random. The previous comments apply on average,
but in any sample, the conﬁdence interval will have random length
and could be arbitrarily large, albeit with very small probability.', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 9 Spring 2015 Statistics for Applications Due Date: 5/1/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
14.9.4.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : 14.9.4.
For modeling freshman GPA to depend linearly on high school GPA,
a standard linear regression model is:
Yi = β0 + β1 xi + ei , i = 1, 2, . . . , n.
Suppose that diﬀerent intercepts were to be allowed for femalses and
males, and write the model as
Yi = IF (i)βF + IM (i)βM + β1 xi + ei , i = 1, 2, . . . , n.
where IF (i) and IM (i) are indicator variables takingon values of 0 and
1 according to whether the generder of the ith person is female or
male.
The design matrix for such a model will be
⎡                     ⎤
IF (1) IM (1) x1
⎢ IF (2) IM (2) x2 ⎥
X=⎢
⎢                     ⎥
..      ..   .. ⎥
⎣      .       .    . ⎦
IF (n) IM (n) xn
⎡                           L              ⎤
nF           0          F emale i xi
Note that X T X = ⎣ L 0
L
L nM                i xi
⎦
LnM ale
2
F emale i xi  M ale i xi   1 xi
where nF and nM are the number of femals and males, respectively.
The regression model is setup as
⎡    ⎤                ⎡    ⎤
Y1         ⎡      ⎤   e1
⎢ Y2 ⎥          βF    ⎢ e2 ⎥
Y = ⎢ . ⎥ = X ⎣ βM ⎦ + ⎢ . ⎥
⎢    ⎥                ⎢    ⎥
⎣ .. ⎦                ⎣ .. ⎦
β1
Yn                    en
1', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 9 Spring 2015 Statistics for Applications Due Date: 5/1/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
14.9.18.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : 14.9.18.
Suppose that
Yi = β0 + β1 xi + ei , i = 1, . . . , n
where the ei are i.i.d. N (0, σ 2 ). Find the mle’s of β0 and β1 and verify
that they are the least squares estimates. This follows immediately
from the lecture notes: Regression Analysis II in the section on max­
imum likelihood. The likelihood function       is a monotonic function of
the least-squares criterion Q(β) = n1 (Yi − Ŷi )2 . Therefore the least-
L
squares estimates of β and the mle’s are identical.', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 3 Spring 2015 Statistics for Applications Due Date: 2/27/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
Problem 8.10.45. A Random walk Model for Chromatin
Only parts (a) through (g). See R script ﬁle “Rproject3 script4 Chromatin.r’
in Rproject3. You can edit this ﬁle for your answers; turn in hard­
copy of an html ﬁle compiled by creating a “notebook” from the script
(press the button on the script window that looks like a notebook).
Circle/highlight your answers on the hard-copy.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Problem 8.10.45. A Random walk Model for Chromatin
The html in Rproject3.zip ”Rproject3//Rproject3r mdr ayleight heory.html”
details estimation theory for a sample from a Rayleigh distribution.
(a). MLE of θ :
Data consisting of:
R1 , R2 , . . . , Rn
are i.i.d. Rayleigh(θ) random variables. The likelihood function is
θ) = �ni=1 f (ri | θ)
f
lik(θ) = f (r1 , . . . , rn | �
fn � r i               −ri2 �
=    i=1         exp
θ2          2θ2
The log-likelihood function is
£(θ) = log[lik(θ)]
= [ n1 log(ri )] − 2nlog(θ) − θ12 n1 [ri2 /2]
o                             o
2
d
The mle solves dθ £(θ) = 0:
d
0                = dθ  (£(θ))
= −2n( 1θ ) + 2( θ13 ) 1n [ri2 /2]
o
= ( n1 n1 [ri2 /2])1/2
o
=⇒     θ̂M LE
(b). Method of moments estimate:
The ﬁrst moment of the Rayleigh(θ) distribution is
R∞
µ1 = E[R | θ] = 0 rf (r | θ)dr
R∞ r              r2
= 0 r θ2 exp( −   2θ2 2
)dr
∞
= θ12 R0 r2 exp( −    r
R
2θ2
)dr
∞            −v
= θ2 0 v · exp( 2θ2 )[ 2dv
1                       √ ] (change of variables: v = r 2 )
v
∞     3
= 2θ12 0 v 2 −1 · exp( 2−θv2 )dv
R
3
1
= √
2θ2
Γ( 32 )(2θ)√2
3
=    2θΓ(
√ 2
) = 2θ × ( 21 )Γ( 21 )
= θ × √π2
√
(using the facts that Γ(n + 1) = nΓ(n) and Γ( 12 ) =        π)
The MOM estimate solves:
= µ̂1 = n1
o
√1
µ                      Ri = R
θ × √π2    = R
√
=⇒ θˆM OM       = R × √π2
(c). Approximate Variance of the MLE and method of moments esti­
mate.
1
The approximate variance of the MLE is V ar(θ̂M LE ) ≈ nI(θ)
where
d  2
I(θ) =     E[− dθ 2 (log(f (x | θ)))]
d2                    2
=     E[− dθ2 [log( θx2 exp(− 2xθ2 ))]]
2
=          d
E[− dθ [−2( 1θ ) − ( x2 )(−2)θ−3 ]]
=     E[−[( θ22 ) + (x2 ))(−3)θ−4 ]]
=     3θ−4 E[x2 ] − ( θ22 ) = 3θ−4 (2θ2 ) − ( θ22 )
4
=     θ2
3
θ  2
So, V ar(θ̂M LE ) ≈ 4n
Variance of the MOM estimate of Rayleigh Distribution Parameter:
The MOM estimate
√
θˆM OM = R × √ 2  π
has variance:
√
V ar(θ̂M OM ) = ( √π2 )2 V ar(R) = ( π2 ) V ar(R)
n
V ar(R) = E[R2 ] −((E[R])
2
2         π 2
= 2θ − ( 2 θ)
= θ2 (2 − π2 )
2
So, V ar(θ̂M OM ) = θ2 (2 − π2 )( π2 )( n1 ) = θ2 ( π4 − 1)( n1 ) ≈ θn × 0.2732
2
This exceeds the approximate V ar(θ̂M LE ) ≈ θn × 0.25
See the R script ﬁle:
Rproject3 script4 Chromatin solution.r', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 3 Spring 2015 Statistics for Applications Due Date: 2/27/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
Problem 8.10.58 Gene Frequencies of Haptoglobin Type See
R Script ﬁle “Rproject3 script1 multinomial simulation.r” in Rpro­
ject3. You can edit this ﬁle for your answers; turn in hard-copy of
an html ﬁle compiled by creating a “notebook” from the script (press
the button on the script window that looks like a notebook). Cir­
cle/highlight your answers on the hard-copy.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Problem 8.10.58 Gene Frequencies of Haptoglobin Type
Gene frequencies are in equilibrium, the genotypes AA, Aa, and aa oc­
cur with probabilities (1 − θ)2 , 2θ(1 − θ), and θ2 . Plato et al. published
the following data on Haptoglobin Type in a sample of 190 people
Haptoglobin Type
Hp1-1 Hp1-2 Hp2-2
10      68      112
This is precisely the same problem as Example 8.5.1.A of the text
and class notes which corresponds to count data: (X1 , X2 , X3 ) ∼
M ultinomial(n = 3, p = ((1 − θ)2 , 2θ(1 − θ), θ2 ) distribution.
(a). Find the mle of θ
• (X1 , X2 , X3 ) ∼ M ultinomial(n, p = ((1 − θ)2 , 2θ(1 − θ), θ2 ))
• Log Likelihood for θ
£(θ) = log(f (x1 , x2 , x3 | p1 (θ), p2 (θ), p3 (θ)))
= log( x1 !xn!2 !x3 ! p1 (θ)x1 p2 (θ)x2 p3 (θ)x3 )
= x1 log((1 − θ)2 ) + x2 log(2θ(1 − θ))
+x3 log(θ2 ) + (non-θ terms)
= (2x1 + x2 )log(1 − θ) + (2x3 + x2 )log(θ) + (non-θ terms)
• First Diﬀerential of log likelihood:
(2x1 + x2 ) (2x3 + x2 )
£/ (θ) = −               +
1−θ               θ
2x3 + x2      2x3 + x2   2(112) + 68
=⇒ θˆ =                   =          =             = 0.76842
2x1 + 2x2 + 2x3      2n        2(190)
(b). Find the asymptotic variance of the mle.
1
• V ar(θ̂) −→
E[−£// (θ)]
• Second Diﬀerential of log likelihood:
5
d     (2x1 + x2 ) (2x3 + x2 )
£// (θ) =        [−            +            ]
dθ      1−θ            θ
(2x1 + x2 ) (2x3 + x2 )
= −           −
(1 − θ)2       θ2
• Each of the Xi are Binomial(n, pi (θ)) so
E[X1 ] = np1 (θ) = n(1 − θ)2
E[X2 ] = np2 (θ) = n2θ(1 − θ)
E[X3 ] = np3 (θ) = nθ2
2n
• E[−£// (θ)] =
θ(1 − θ)
θ̂(1 − θ̂)   0.76842(1 − 0.76842)
• σ̂θ̂2 =              =                      = 0.0004682898 = (.02164)2
2n             2 × 190
Parts (c), (d), and (e): see the R script
Rproject3 script1 multinomial simulation P roblem 8 57.r', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 10 Spring 2015 Statistics for Applications Due Date: 5/15/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
12.5.17. Find the mle’s of the parameters αi , βj , δij , and µ of the model
for the two-way layout.
The model for the two-way layout is given by:
Yijk = µ + αi + βj + δij + Eijk
where
I
i=1 αi = 0
J
j=1 βj = 0
I            J
i=1 δij =    j=1 δij = 0
As noted in Rice (p. 493) the log likelihood is
1
PI     PJ         PK
l = − I J2K log(2πσ 2 ) − 2σ1 2    i=1       j =1    k=1 (Yijk − µ − αi − βj − δij )
2
Solving the following equations:
∂l
∂µi = 0 =⇒ µ̂ = Y···
∂l
∂αi = 0 =⇒ α̂i = Yi·· − µ̂
∂l         ˆ
∂ βi = 0 =⇒ βi = Y·j· − µ̂
∂l         ˆ                        ˆ
∂δij = 0 =⇒ δij = Yij · − µ̂ − α̂i − βj
These terms yield the answer formulas of the problem.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : 12.5.17. Find the mle’s of the parameters αi , βj , δij , and µ of the model
for the two-way layout.
The model for the two-way layout is given by:
Yijk = µ + αi + βj + δij + Eijk
where
I
i=1 αi = 0
J
j=1 βj = 0
I            J
i=1 δij =    j=1 δij = 0
As noted in Rice (p. 493) the log likelihood is
1
PI        PJ        PK
l = − IJK       2     1
2 log(2πσ ) − 2σ 2       i=1       j=1    k=1 (Yijk − µ − αi − βj − δij )
2
Solving the following equations:
∂l
∂ µi = 0 =⇒ µ
ˆ = Y···
∂l
∂αi = 0 =⇒ α̂i = Yi·· − µ̂
∂l        ˆ
∂βi = 0 =⇒ βi = Y·j · − µ̂
∂l         ˆ                        ˆ
∂δij = 0 =⇒ δij = Yij · − µ̂ − α̂i − βj
These terms yield the answer formulas of the problem.', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 2 Spring 2014 Statistics for Applications Due Date: 2/20/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
Problem 8.10.31; answer if George observes three heads and Hilary
spins the coin ﬁve times.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Problem 8.10.31; answer if George observes three heads and Hilary
spins the coin ﬁve times.
George spins a coin three times and observes no heads. He then gives
the coin to Hilary. She spins it until the ﬁrst head occurs, and ends
up spinning it four times total. Let θ be the probabiity the coin comes
up heads.
(a). What is the likelihood function?
Let X1 , X2 , X3 be the outcomes of George’s 3 spins (1=Head, 0=Tail).
and Let Y be the number of spins Hilary makes until the ﬁrst head
occurs.
2
• X1 , X2 , X3 are i.i.d. (independent and identically distributed)
Bernoulli(θ) random variables
• Y is independent of X1 , X2 , X3 and has a geometric distribution
with parameter p = θ (see p. A1 of Appendix A)
The likelihood function is the value of the joint pmf function for
(X1 , X2 , X3 , Y ) as a function of θ for ﬁxed outcome
(X1 , X2 , X3 , Y ) = (1, 1, 1, 5)
Thus:
lik(θ) =      f (x1 , x2 , x3 , y | θ)
=      f (x1 | θ)f (x2 | θ)f (x3 | θ)f (y | θ)
[ 3i=1 θxi (1 − θ)1−xi ] × [θ(1 − θ)(y−1) ]
Q
=
=      θ4 (1 − θ)4
(b). What is the MLE of θ?
The MLE solves
0 = J0 (θ) = dθd
log[lik(θ)]
d
= dθ (4 ln[θ] + 4 ln[(1 − θ)])
= 4θ + 1−θ
4
× (−1)
=⇒ 4θ = 4(1 − θ)
=⇒ θ̂ = 4/8
Note that the MLE of θ is identical to the MLE for 8 Bernoulli trials
which have 4 Heads and 4 Tails.', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 6 Spring 2015 Statistics for Applications Due Date: 4/3/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem] For full credit, explain your reasoning and detail any calculations.
Problem 9.11.4', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Problem 9.11.4
Let X have one of the following distributions:
X     H0   H1
x1    .2   .1
x2    .3   .4
x3    .3   .1
x4    .2   .4
(a). Compare the likelihood ratio, Λ for each possible value X and
order the xi according to Λ.
X     H0   HA     Λ
x1    .2   .1     2.
x2    .3   .4    3/4
x3    .3   .1     3
x4    .2   .4    2/4
Sorting the xi from highest to lowest Λ : x3 , x1 , x2 , x4
(b). What is the likelihood ratio test of H0 versus HA at level α = 0.2?
We rewrite the table, ordering the rows by decreasing Λ. We add a
column corresponding to P (Λ < Λ(xi ) | H0 ) this is the level of the test
that rejects H0 if Λ < Λ(xi )
X     H0   HA     Λ     P (Λ(X) < Λ(xi ) | H0 )
x3    .3   .1     3              0.7
x1    .2   .1     2.             0.5
x2    .3   .4    3/4             0.2
x4    .2   .4    2/4              0.
The test that rejects H0 if Λ(X) < Λ(x2 ) has level 0.2 and the test
that rejects H0 if Λ(X) < Λ(x1 ) has level 0.5.
1
(c). If the prior probabilities are P (H0 ) = P (HA ) then the out­
comes favoring H0 are those for which the posterior probability ratio
is greater than 1:
P (H0 |X)         P (H0 )P (X|H0 )
1 <    P (HA |X) = P (HA )P (X|HA )
=        (H0 )
( PP(H A)
) · ( PP(X|H
(X|H0 )
A)
)
P (H0 )
=   ( P (HA ) ) · Λ(X)
= Λ(X)
For equal prior probabilities, the posterior odds is greater than 1 if the
likeihood ratio is greater than 1. This is true for outcomes x3 and x1 .
(d). What prior probabilities correspond to the decision rules with
α = 0.2 and α = 0.5
For α = 0.2, the rejection region of the test is {x4 } = {x : Λ < 3/4}.
For the posterior odds to be less than one, the prior odds must be less
than 4/3, which corresponds to
P (H0 ) = 1 − P (HA ) < 4/7.
For α = 0.5, the rejection region of the test is {x4 , x2 } = {x : Λ < 2}.
For the posterior odds to be less than one, the prior odds must be less
than 1/2, which corresponds to
P (H0 ) = 1 − P (HA ) < 1/3.
To include {x2 } in the rejection region it must be that P (H0 ) > 4/7.
So for α = 0.5, the prior probabilities are such that
4/7 < P (H0 ) = 1 − P (HA ) < 1/3.
Note that higher prior probability of H0 leads to requiring stronger
evidence (lower Λ) to reject H0 .', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 6 Spring 2015 Statistics for Applications Due Date: 4/3/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem] For full credit, explain your reasoning and detail any calculations.
Problem 9.11.23', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Problem 9.11.23
Suppose that a 99% conﬁdence interval for the mean µ of a normal
distribution is found to be
(−2.0, 3.0). Would a test of H0 : µ = −3 versus HA : µ = −3 be
rejected at the 0.01 signiﬁcane level?
Yes, by the duality of conﬁdence intervals and hypothesis tests (with
two-sided alternatives).
The conﬁdence interval contains the true parameter with probability
0.99 (before observing the data). Accepting H0 if and only if the
conﬁdence interval contains H0 must have level 1 − 0.99.', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 6 Spring 2015 Statistics for Applications Due Date: 4/3/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem] For full credit, explain your reasoning and detail any calculations.
Problem 9.11.31', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Problem 9.11.31
What values of the generalized likelihood ratio Λ are necessary to reject
the null hypothesis at the signiﬁcance level α = 0.1 if the degrees of
freedom are 1, 5, 10, 20.
The generalized likelihood ratio statistic −LRstat = 2 log(Λ) has a (or
an approximate) chi-square distribution under the null hypothesis.
The following R commands compute the table
vec.df=c(1,5,10,20)
alpha=0.10
vec.LRstat.criticalValue<-qchisq(1-alpha, df=vec.df)
Lambda= exp(-.5*vec.LRstat.criticalValue)
> data.frame(df=vec.df,
+            LRstat0=vec.LRstat.criticalValue,
+            Lambda=Lambda)
df   LRstat0       Lambda
1 1 2.705543 2.585227e-01
2 5 9.236357 9.870760e-03
3 10 15.987179 3.376200e-04
4 20 28.411981 6.767321e-07
>
5', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] NAME: 18.443 Exam 2 Spring 2015 Statistics for Applications 4/9/2015
Testing Goodness of Fit.
Let X be a binomial random variable with n trials and probability p of
success.
(a). Suppose n = 100 and X = 38. Compute the Pearson chi-square
statistic for testing the goodness of ﬁt to the multinomial distribution
with two cells with H0 : p = 0.5.
(b). What is the approximate distribution of the test statistic in (a), under
the null Hypothesis H0 .
(c). What can you say about the P -value of the Pearson chi-square statis­
tic in (a) using the following table of percentiles for chi-square random
variables ? (i.e., P (χ23 ≤ q.90 = 6.25) = .90 )
df   q.90    q.95     q.975 q.99        q.995
1   2.71    3.84     5.02  6.63         9.14
2   4.61    5.99     7.38  9.21        11.98
3   6.25    7.81     9.35 11.34        14.32
4   7.78    9.49    11.14 13.28        16.42
1
(d). Consider the general case of the Pearson chi-square statistic in (a),
where the outcome X = x is kept as a variable (yet to be observed). Show
that the Pearson chi-square statistic is an increasing function of |x − n/2|.
(e). Suppose the rejection region of a test of H0 is {X : |X − n/2| > k}
for some ﬁxed known number k. Using the central limit theorem (CLT)
as an approximation to the distribution of X, write an expression that
approximates the signiﬁcance level of the test for given k. (Your answer
can use the cdf of Z ∼ N (0, 1) : Φ(z) = P (Z ≤ z).)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Testing Goodness of Fit.
Let X be a binomial random variable with n trials and probability p of
success.
(a). Suppose n = 100 and X = 38. Compute the Pearson chi-square
statistic for testing the goodness of ﬁt to the multinomial distribution
with two cells with H0 : p = p0 = 0.5.
(b). What is the approximate distribution of the test statistic in (a), under
the null Hypothesis H0 .
(c). What can you say about the P -value of the Pearson chi-square statis­
tic in (a) using the following table of percentiles for chi-square random
variables ? (i.e., P (χ23 ≤ q.90 = 6.25) = .90 )
df   q.90    q.95     q.975 q.99        q.995
1   2.71    3.84     5.02  6.63         9.14
2   4.61    5.99     7.38  9.21        11.98
3   6.25    7.81     9.35 11.34        14.32
4   7.78    9.49    11.14 13.28        16.42
(d). Consider the general case of the Pearson chi-square statistic in (a),
where the outcome X = x is kept as a variable (yet to be observed). Show
that the Pearson chi-square statistic is an increasing function of |x − n/2|.
(e). Suppose the rejection region of a test of H0 is {X : |X − n/2| > k}
for some ﬁxed known number k. Using the central limit theorem (CLT)
1
as an approximation to the distribution of X, write an expression that
approximates the signiﬁcance level of the test for given k. (Your answer
can use the cdf of Z ∼ N (0, 1) : Φ(z) = P (Z ≤ z).)
Solution:
(a). The Pearson chi-square statistic for a multinomial distribution with
(m = 2) cells is
m
�    (Oi − Ei )2
X2 =
j=1
Ei
where the observed counts are
O1 = x = 38 and O2 = n − x = 62,
and the expected counts under the null hypothesis are
E1 = n × p0 = n × 1/2 = 50 and E2 = (n − x) × (1 − p0 ) =
(n − x) × (1 − 1/2) = 50
Plugging these in gives
m
�    (Oi − Ei )2
X2 =
j=1
Ei
(38 − 50)2    (62 − 50)2
=           +
50           50
144 144       288
=        +     =       = 5.76
50     50     50
(b). The approximate distribution of X 2 is chi-squared with degrees of
freedom q = dim({p, 0 ≤ p ≤ 1}) − dim({p : p = 1/2}) = (m − 1) − 0 = 1.
(c). The P -value of the Pearson chi-square statistic is the probability
that a chi-square random variable with q = 1 degrees of freedom exceeds
the 5.76, the observed value of the statistic. Since 5.76 is greater than
q.975 = 5.02 and less than q.99 = 6.63, (the percentiles of the chi-square
distribution with q = 1 degrees of freedom) we know that the P -value is
smaller than (1 − .975) = .025 but larger than (1 − .99) = .01.
(d). Substituing O1 = x and O2 = (n − x)
and E1 = n × p0 = n/2 and E2 = n × (1 − p0 ) = n/2
in the formula from (a) we get
m
�   (Oi − Ei )2
X2 =
j=1
Ei
(x − n/2)2      ((n − x) − n/2)2
=                +
n/2                n/2
(x − n/2)2      ((n/2 − x))2
=                +
n/2              n/2
2
(x−n/2)
=   2 × n/2
4              2
=   n × |x − n/2|
2
(e). Since X is the sum of n independent Bernoulli(p) random variables,
E[X] = np and V ar(X) = np(1 − p)
so by the CLT
X ∼ N (np, np(1 − p)) (approximately)
which is N ( n2 , n4 ) when the null hypothesis (p = 0.5) is true.
The signiﬁcance level of the test is the probability of rejecting the null
hypothesis when it is true which is given by:
α = P (Reject H0 | H0 )     =   P (|X − n/2| > k | H0 )
=   P (| X−n/2
√     | > √k | H0 )
n/4        n/4
≈   P (|N (0, 1)| > √k )
n/4
=   2 × [1 − Φ( √k )]
n/4
3', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] NAME: 18.443 Exam 2 Spring 2015 Statistics for Applications 4/9/2015
Probability Plots
Random samples of size n = 100 were simulated from four distributions:
• U nif orm(0, 1)
• Exponential(1)
• N ormal(50, 10)
• Student’s t (4 degrees of freedom).
The quantile-quantile plots are plotted for each of these 4 samples:
Uniform QQ Plot                                                          Normal QQ Plot
70
Ordered Observations
Ordered Observations
0.8
60
50
0.4
40
0.0
0.0     0.2   0.4   0.6   0.8    1.0                                        30     40    50    60      70
Uniform Quantiles                                                      Normal(0,1) Quantiles
Exponential QQ Plot                                                        t Dist. QQ Plot
5
Ordered Observations
Ordered Observations
0 2 4 6 8
4
3
2
1
−4
0
0      1     2     3     4      5                                         −4      −2     0      2      4
Exponential(1) Quantiles                                                    t (df=4) Quantiles
For each sample, the values were re-scaled to have sample mean zero and
sample standard deviation 1
{xi , i = 1, . . . , 100} =⇒ {Zi = xis−x
x
, i = 1, . . . , 100}
n                                              n
where x = n1                                            2   1
1 xi and sx = n                                1 (xi − x)
2
3
The Normal QQ plot for each set of standardized sample values is given
in the next display but they are in a random order. For each distribution,
identify the corresponding Normal QQ plot, and explain your reasoning.
• U nif orm(0, 1) = Plot
• Exponential(1) = Plot
• N ormal(50, 10) = Plot
• Student’s t (4 degrees of freedom) = Plot
Plot A                                                      Plot C
1.5
Sample Quantiles
Sample Quantiles
4
0.5
2
−1.5 −0.5
0
−2
−2   −1     0      1     2                                  −2   −1     0      1     2
Theoretical Quantiles                                       Theoretical Quantiles
Plot B                                                      Plot D
4
2
Sample Quantiles
Sample Quantiles
3
1
2
0
1
−1
0
−2
−1
−2   −1     0      1     2                                  −2   −1     0      1     2
Theoretical Quantiles                                       Theoretical Quantiles
4', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Probability Plots
Random samples of size n = 100 were simulated from four distributions:
• U nif orm(0, 1)
• Exponential(1)
• N ormal(50, 10)
• Student’s t (4 degrees of freedom).
The quantile-quantile plots are plotted for each of these 4 samples:
Uniform QQ Plot                                                          Normal QQ Plot
70
Ordered Observations
Ordered Observations
0.8
60
50
0.4
40
0.0
0.0     0.2   0.4   0.6   0.8    1.0                                        30     40    50    60      70
Uniform Quantiles                                                      Normal(0,1) Quantiles
Exponential QQ Plot                                                        t Dist. QQ Plot
5
Ordered Observations
Ordered Observations
0 2 4 6 8
4
3
2
1
−4
0
0      1     2     3     4      5                                         −4      −2     0      2      4
Exponential(1) Quantiles                                                    t (df=4) Quantiles
For each sample, the values were re-scaled to have sample mean zero and
sample standard deviation 1
{xi , i = 1, . . . , 100} =⇒ {Zi = xis−x
x
, i = 1, . . . , 100}
n                                              n
where x = n1                                            2   1
1 xi and sx = n                                1 (xi − x)
2
8
The Normal QQ plot for each set of standardized sample values is given
in the next display but they are in a random order. For each distribution,
identify the corresponding Normal QQ plot, and explain your reasoning.
• U nif orm(0, 1) = Plot
• Exponential(1) = Plot
• N ormal(50, 10) = Plot
• Student’s t (4 degrees of freedom) = Plot
Plot A                                                      Plot C
1.5
Sample Quantiles
Sample Quantiles
4
0.5
2
−1.5 −0.5
0
−2
−2   −1     0      1     2                                  −2   −1     0      1     2
Theoretical Quantiles                                       Theoretical Quantiles
Plot B                                                      Plot D
4
2
Sample Quantiles
Sample Quantiles
3
1
2
0
1
−1
0
−2
−1
−2   −1     0      1     2                                  −2   −1     0      1     2
Theoretical Quantiles                                       Theoretical Quantiles
Solution:
The Student’s t sample has two extreme high values and one extreme low
value which are evident in Plot A, so
Plot A = t distribution
Plot B is the only plot that has a bow shape which indicates larger ob­
servations are higher than would be expected for a normal sample and
smaller observations are less small than would be expected for a normal
sample. This is true for the Exponential distribution which is asymmetric
with a right-tail that is heavier than a normal distribution.
Plot B = Exponential.
9
The U nif orm(0, 1) sample has true mean 0.5 and true variance equal
to E[X 2 ] − (E[X])2 = 1/3 − (1/2)2 = 1/12. For a typical sample, the
standardized sample values will be bounded (using the true mean and
d deviation to standardize, the values would no larger than +(1 −
standard
.5)/ 1/12 = 1.73). For Plot C the range of the standardized values is
smallest, consistent with what would be expected for a sample from a
uniform distribution.
Plot C = Uniform distribution.
The QQ Plot for the normal distribution is unchanged and follows a
straight-line pattern indicating consistency of the ordered observations
with the theoretical quantiles – distribution
Plot D = Normal
10', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 7 Spring 2015 Statistics for Applications Due Date: 4/17/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem] For full credit, explain your reasoning and detail any calculations.
10.9.8', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : In lecture we derived the following expression for the vari­
ance of the survival function (see p. 384 or Rice)
F (t)
V ar(log[Sn (t)]) = V ar(log[1 − Fn (t)]) = n1   1−F (t)
where F (t) = 1 − e−t = P (X ≤ t), the cdf of an exponential(λ = 1)
random variable.
The R script “Problem10 9 8.r” graphs           V ar(log[Sn (t)]) versus t.', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 7 Spring 2015 Statistics for Applications Due Date: 4/17/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem] For full credit, explain your reasoning and detail any calculations.
10.9.39 Read in the data and generate the boxplot by executing the
following code snippet in Rproject7
windspeed=read.table(file="Rice 3e Datasets/ASCII Comma/Chapter 10/windspeed.txt",
sep=",",stringsAsFactors = FALSE)
windspeed.0=t(windspeed[,-1])
dimnames(windspeed.0)<-list(c(1:nrow(windspeed.0)), windspeed[,1])
dim(windspeed.0)
head(windspeed.0); tail(windspeed.0)
boxplot(windspeed.0)
Also, using your answer to 10.9.35, comment on the data points dis­
played as asterisks in the boxplots. is their frequency consistent with
a normal distribution? Would you expect these data to be consistent
with a normal distribution?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : 10.9.39 Read in the data and generate the boxplot by executing the
following code snippet in Rproject7
windspeed=read.table(file="Rice 3e Datasets/ASCII Comma/Chapter 10/windspeed.txt"
sep=",",stringsAsFactors = FALSE)
windspeed.0=t(windspeed[,-1])
dimnames(windspeed.0)<-list(c(1:nrow(windspeed.0)), windspeed[,1])
dim(windspeed.0)
head(windspeed.0); tail(windspeed.0)
boxplot(windspeed.0)
Also, using your answer to 10.9.35, comment on the data points dis­
played as asterisks in the boxplots. is their frequency consistent with
2
a normal distribution? Would you expect these data to be consistent
with a normal distribution?
Soluton: See Script ”RProject8 1 windspeed.r”. There are many as­
terisk points in the boxplots which is not consistent with normal dis­
tributions for the small samples with sizes 37. The extreme wind
speeds are postively skewed distributions that diﬀer signﬁcantly from
the normal model.', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Exam 1 Spring 2015 Statistics for Applications 3/5/2015
Log Normal Distribution: A random variable X follows a Lognormal(θ, σ 2 )
distribution if Y = ln(X) follows a N ormal(θ, σ 2 ) distribution.
For the normal random variable Y = ln(X)
• The probability density function of Y is
1 (y − θ)2
1     −
f (y | µ, σ 2 ) = √       e 2 σ 2 , −∞ < y < ∞.
2πσ 2
• The moment-generating function of Y is
1
tY     2
tθ + σ 2 t2
MY (t) = E[e | θ, σ ] = e           2
(a). Compute the ﬁrst two moments of a random variable X ∼
Lognormal(θ, σ 2 ).
µ1 = E[X | θ, σ 2 ] and µ2 = E[X 2 | θ]
Hint: Note that X = eY and X 2 = e2Y where Y ∼ N (θ, σ 2 ) and use
the moment-generating function of Y .
(b). Suppose that X1 , . . . , Xn is an i.i.d. sample from the Lognormal(θ, σ 2 )
distribution of size n. Find the method of moments estimates of θ and
σ2.
Hint: evaluate µ2 /µ12 and ﬁnd a method-of-moments estimate for σ 2
ﬁrst.
(c). For the log-normal random variable X = eY , where
Y ∼ N ormal(θ, σ 2 ),
prove that the probability density of X is
1 (ln(x) − θ)2
1     1  −
f (x | θ, σ 2 ) = √      ( )e 2       σ2      ,   0 < x < ∞.
2πσ 2  x
(d). Suppose that X1 , . . . , Xn is an i.i.d. sample from the Lognormal(θ, σ 2 )
distribution of size n. Find the mle for θ assuming that σ 2 is known
to equal σ02 .
(e). Find the asymptotic variance of the mle for θ in (d).
1', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : 1
(a).
2
µ1 = E[X] = E[eY ] = MY (1) = eθ+σ /2
2
µ2 = E[X 2 ] = E[e2Y ] = MY (2) = e2θ+2σ
(b). First, note that:
2
µ2 /(µ21 ) = eσ
It follows that a method-of-moments estimate for σ 2 is
σ̂ 2 = ln(µ̂2 /µ̂21 )
where
n
µ̂1 = n1i=1 Xi
µ̂2 = n1 ni=1 Xi2
Substituting σ̂ 2 for σ 2 in the formula for µ1 we get
2
µ̂1 = eθ+σ̂ /2
=⇒ θ̂ = ln(µ̂1 ) − σ̂ 2 /2
(c). Consider the transformation
X = eY .
which has the inverse: y = ln(x) and dy/dx = 1/x.
It follows that
1             2
fX (x) = fY (ln(x))|dy/dx| = √ 1 2 x1 e− 2σ2 (ln(x)−θ)
2πσ
(d). The log of the density function for single realizations x is
2
ln[f (x | θ, σ02 ] = − 21 ln(2πσ02 ) − ln(x) − 12 (ln(x)−θ)
σ2
0
For a sample x1 , . . . , xn , the likelihood function is
n                  2
£(θ) =   i=1 ln[f (xi | θ, σ0 ]
1    n
= − 2σ2 i=1 (ln(xi ) − θ)2 + (terms not depending on θ)
0
n
£(θ) is minimized by θ̂ = n1              i=1 ln(xi ) – the mle from the sample of
Yi = ln(Xi ) values.
(e). The asymptotic variance satisﬁes
2
E[− d dθJ(θ)
2 ] ≈ 1/V ar(θ̂)
2
Since d dθJ(θ)
2   = σn2 is constant
0
V ar(θ̂) ≈ σ02 /n
ˆ
This asymptotic variance is in fact the actual variance of θ.
2', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Exam 1 Spring 2015 Statistics for Applications 3/5/2015
Distributions derived from Normal random variables. Consider two
independent random samples from two normal distributions:
• X1 , . . . , Xn are n i.i.d. N ormal(µ1 , σ12 ) random variables.
• Y1 , . . . , Ym are m i.i.d. N ormal(µ2 , σ22 ) random variables.
(a). If µ1 = µ2 = 0, ﬁnd two statistics
T1 (X1 , . . . , Xn , Y1 , . . . , Ym )
T2 (X1 , . . . , Xn , Y1 , . . . , Ym )
each of which is a t random variable and which are statistically inde­
pendent. Explain in detail why your answers have a t distribution and
why they are independent.
(b). If σ12 = σ22 > 0, deﬁne a statistic
T3 (X1 , . . . , Xn , Y1 , . . . , Ym )
which has an F distribution.
An F distribution is determined by the numerator and denominator
degrees of freedom. State the degrees of freedom for your statistic T3 .
(c). For your answer in (b), deﬁne the statistic
1
T4 (X1 , . . . , Xn , Y1 , . . . , Ym ) =
T3 (X1 , . . . , Xn , Y1 , . . . , Ym )
What is the distribution of T4 under the conditions of (b)?
2 = 1       n
(d). Suppose that σ12 = σ22 . If SX      n−1
2        2
i=1 (Xi − X) , and SY =
1    m            2
m−1    i=1 (Yi − Y ) , are the sample variances of the two samples, show
how to use the F distribution to ﬁnd
P (SX 2 /SY2 > c).
(e). Repeat question (d) if it is known that σ12 = 2σ22 .
3', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Distributions derived from Normal random variables. Consider two
independent random samples from two normal distributions:
• X1 , . . . , Xn are n i.i.d. N ormal(µ1 , σ12 ) random variables.
• Y1 , . . . , Ym are m i.i.d. N ormal(µ2 , σ22 ) random variables.
(a). If µ1 = µ2 = 0, ﬁnd two statistics
T1 (X1 , . . . , Xn , Y1 , . . . , Ym )
T2 (X1 , . . . , Xn , Y1 , . . . , Ym )
each of which is a t random variable and which are statistically inde­
pendent. Explain in detail why your answers have a t distribution and
why they are independent.
(b). If σ12 = σ22 > 0, deﬁne a statistic
T3 (X1 , . . . , Xn , Y1 , . . . , Ym )
which has an F distribution.
An F distribution is determined by the numerator and denominator
degrees of freedom. State the degrees of freedom for your statistic T3 .
(c). For your answer in (b), deﬁne the statistic
1
T4 (X1 , . . . , Xn , Y1 , . . . , Ym ) =
T3 (X1 , . . . , Xn , Y1 , . . . , Ym )
What is the distribution of T4 under the conditions of (b)?
2 = 1
Pn
(d). Suppose that σ12 = σ22 . If SX      n−1
2        2
i=1 (Xi − X) , and SY =
1  P m            2
m−1    i=1 (Yi − Y ) , are the sample variances of the two samples, show
how to use the F distribution to ﬁnd
P (SX 2 /SY2 > c).
(e). Repeat question (d) if it is known that σ12 = 2σ22 .
Solution:
(a). Consider
√
T1 = √nX2
SX
√
mY
T2 = √ 2
SY
where
5
1 Pn
X =      n   1 Xi               ∼ N (µ1 , σ12 /n)
2           1 Pn             2         σ2
SX    =    n−1    1 (Xi − X)      ∼ ( n−1
1
) × χ2n−1
1 Pm
Y    =    m    1 Yi              ∼ N (µ2 , σ22 /n)
2           1 Pm             2         σ2
SX    =    m−1     1 (Yi − Y )    ∼ ( m−1
2
) × χ2m−1
We know from theory that X and SX     2 are independent, and Y and
SY2 are independent, and all 4 are mutually independent because they
depend on independent samples.
For µ1 = 0, we can write
√
T1 = √nX/σ
2
1
2
∼ tn−1
SX /σ1
a t distribution with (m−1) degrees of freedom, because the numerator
is
i N (0, 1) random variable independent of the denominator which is
χ2m−1 /(m − 1).
And for µ2 = 0, we can write
√
T2 = √mY2 /σ22 ∼ tm−1
SY /σ2
a t distribution with (n−1) degrees of freedom, because the numerator
is
i N (0, 1) random variable independent of the denominator which is
χ2n−1 /(n − 1).
(b). For σ12 = σ22 consider the statistic:
2
SX
T3 =       SY2
2 /σ 2
SX     1
=      SY2 /σ22
The numerator is a χ2n−1 random variable divided by its degrees of
freedom (n − 1) and the denominator is an independent χ2m−1 random
variable divided by its degrees of freedom (m − 1). By deﬁnition the
distribution of such a ratio is an F distribution with (n−1) and (m−1)
degrees of freedom in the numerator/denominator.
(c). The inverse of an F random variable is also an F random variable
– the degrees of freedom for numerator and denominator reverse.
(d). In general we know:
(n−1)SX2
2
σ1
∼ χ2n−1
(m−1)SY2
σ22
∼ χ2m−1
which are independent.
6
So, we can develop the expression:
2 /σ 2
S2             (n − 1)SX    1    (n − 1)/σ12
P ( SX2 > c) = P (                >                × c)
Y          (m − 1)SY2 /σ22    (m − 1)σ22
σ 2
(n−1)
= P (F(n−1),(m−1) > (m−1)  × ( σ22 ) × c)
1
The answer is the upper-tail probability of an F distribution with
(n−1), (m−1) degrees of freedom, equal to the probability of exceeding
(n−1)     σ2
( (m−1) × ( σ22 ) × c)
1
σ2                   σ2
For (d), use σ22 = 1 and for (e) use σ22 = 1/2
1                    1
7', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] NAME: 18.443 Exam 3 Spring 2015 Statistics for Applications 5/7/2015
Regression Through the Origin
For bivariate data on n cases: {(xi , yi ), i = 1, 2, . . . , n}, consider the linear
model with zero intercept:
Yi = βxi + Ei , i = 1, 2, . . . , n
where Ei are independent and identically distribution N (0, σ 2 ) random
variables with ﬁxed, but unknown variance σ 2 > 0.
When xi = 0, then E[Yi | xi , β] = 0.
ˆ
(a). Solve for the least-squares line – Yˆ = βx.
ˆ the slope of the least squares line.
(b). Find the distribution of β,
(c). What is the distribution of the sum of squared residuals from the
least-squares ﬁt:
n        ˆ i )2
SSERR =        (yi − βx
i=1
(d). Find an unbiased estimate of σ 2 using your answer to (c).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Regression Through the Origin
For bivariate data on n cases: {(xi , yi ), i = 1, 2, . . . , n}, consider the linear
model with zero intercept:
Yi = βxi + Ei , i = 1, 2, . . . , n
where Ei are independent and identically distribution N (0, σ 2 ) random
variables with ﬁxed, but unknown variance σ 2 > 0.
When xi = 0, then E[Yi | xi , β] = 0.
ˆ
(a). Solve for the least-squares line – Yˆ = βx.
ˆ the slope of the least squares line.
(b). Find the distribution of β,
(c). What is the distribution of the sum of squared residuals from the
least-squares ﬁt:
n               2
SSERR =        i=1 (yi − β̂xi )
(d). Find an unbiased estimate of σ 2 using your answer to (c).
Solution:
(a). Set up the regression model with vectors/matrices:
⎡     ⎤       ⎡     ⎤           ⎡     ⎤
y1           x1                E1
⎢ y2 ⎥        ⎢ x2 ⎥            ⎢ E2 ⎥
Y = ⎢ . ⎥, X = ⎢ . ⎥ and e = ⎢ . ⎥
⎢     ⎥       ⎢     ⎥           ⎢     ⎥
⎣ .. ⎦        ⎣ .. ⎦            ⎣ .. ⎦
yn           xn                En
and β = [β]
Y = Xβ + e
The least-squares line minimizes
n            2          T
Q(β) =       1 (yi − βxi ) = (Y − Xβ) (Y − Xβ)
∂Q(β)
The least squares estimate βˆ solves the ﬁrst order equation:                        ∂β     = 0
and is given by
n
n 2 −1      n                 xi yi
β̂ = (X T X)−1 X T Y = (          1 xi )      1 xi yi =
1
n
x2i
1
The least squares line is
ˆ
y = βx
n                            xi
(b). Since β̂ =       i=1 wi yi , where wi =       n
xj2
it is a weighted sum of the
j=1
independent normal random variables: yi ∼ N (xi β, σ 2 ). It has a normal
1
distribution and all we need to do is compute the expectation and variance
of β̂:
Pn
E[β̂] = P  E[ i=1 wi yi ] P
n                n
= Pi=1 wi E[yi ] = i=1 wi × (xi β)
n       x
=       i=1 (
Pn 2 )xi β
i
x
j=1 j
2
Pn           x
= β i=1 ( Pn i x2 ) = β
j=1   j
Pn
V ar[β̂]   =     V ar[ i=1 wi yi ] P
P  n    2             n    2 2
=        i=1 wi V ar[yi ] = i=1 wi σ
2
n        x
σ 2 × i=1 ( (Pni x2 )2 )
P
=
Pn 2 j=1 j
x
=     σ 2 × (Pni=1x2i)2
j=1   j
=     σ 2 × (Pn1 x2 )
j=1   j
So, β̂ ∼ N (β, σβ2 ) where σβ2 = σ 2 × (Pn1 x2 )
j
j=1
(c). For a normal linear regression model the distribution of the sum of
least-squares residuals has a distribution equal to σ 2 (the error variance)
times a Chi-square distribution with degrees of freedom equal to (n − p),
where p is the number of independent variables and n is the number of
cases. In this case, p = 1 so
Pn
SSERR = i=1 (yi − xi β̂)2 ∼ σ 2 χ2df =(n−1) .
(d). Since a Chi-square random variable has expectation equal to its
degrees of freedom. E[SSERR ] = σ 2 (n − 1) so
ˆ 2 = SSn−1
σ        ERR
is an unbiased estiamte of σ 2 .', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] NAME: 18.443 Exam 3 Spring 2015 Statistics for Applications 5/7/2015
Suppose that grades on a midterm and ﬁnal have a correlation coeﬃcient of
0.6 and both exams have an average score of 75. and a standard deviation
of 10.
(a). If a student’s score on the midterm is 90 what would you predict her
score on the ﬁnal to be?
(b). If a student’s score on the ﬁnal was 75, what would you guess that
his score was on the midterm?
(c). Consider all students scoring at the 75th percentile or higher on the
midterm. What proportion of these students would you expect to be at
or above the 75th percentile of the ﬁnal? (i) 75%, (ii) 50%, (iii) less than
50%, or (iv) more than 50%.
Justify your answers.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (a). Let x be the midterm score and y be the ﬁnal score. The least-squares
regression of y on x is given in terms of the standardized values:
ŷ−y    x−x
sy = r sx
A score of 90 on the midterm is (90 − 75)/10 = 1.5 standard deviations
above the mean. The predicted score on the ﬁnal will be r × 1.5 = .9
standard deviations above the mean ﬁnal score, which is 75+(.9)×10 = 84.
(b). For this case we need to regress the midterm score (x) on (y). The
same argument in (a), reversing x and y leads to:
x̂−x    y−y
sx = r sy
Since the ﬁnal score was 75, which is zero-standard deviations above y,
the prediction of the midterm score is x = 75.
(c). By the regression eﬀect we expect dependent variable scores to be
closer to their mean in standard-deviation units than the independdent
variable is to its mean, in standard-deviation units. Since the 75th per­
centile is on the midterm is above the mean, we expect these students to
have average ﬁnal score which is lower than the 75th percentile (i.e., closer
to the mean). This means (iii) is the correct answer.
5', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] NAME: 18.443 Exam 3 Spring 2015 Statistics for Applications 5/7/2015
For the following batch of numbers:
5, 8, 9, 9, 11, 13, 15, 19, 19, 20, 29
(a). Make a stem-and-leaf plot of the batch.
(b). Plot the ECDF (empirical cumulative distribution function) of the
batch.
(c). Draw the Boxplot of the batch.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : > x=c(5,8,9,9,11,13,15,19,19,20,29)
> stem(x)
The decimal point is 1 digit(s) to the right of the |
0 | 5899
1 | 13
1 | 599
2 | 0
2 | 9
> plot(ecdf(x))
8
ecdf(x)
1.0
0.8
0.6
Fn(x)
0.4
0.2
0.0
5   10      15        20   25   30
x
> median(x)
[1] 13
> quantile(x,probs=.25)
25%
9
> quantile(x,probs=.75)
75%
19
> boxplot(x)
9
25
20
15
10
5
Note that the center of the box is at the median (19), the bottom is at
the 25-th percentile and top is at the 75-th percentile. The inter-quartile
range is (19-9)=10, so any value more than 1.5 × 9 = 13.5 units above or
below the box will be plotted as outliers. There are no such outliers.', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 1 Spring 2014 Statistics for Applications Due Date: 2/13/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
Problem 6.4.1', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Problem 6.4.1
Z ∼ N (0, 1) and U ∼ χ2n and Z and U are independent.
T = Z/ U/n a Student’s t random variable with n degrees
of freedom.
Find the density function of T.
Solution:
−1 2
• The density of Z is fZ (z) = √12π e 2 x , −∞ < x < +∞.
• The density of U is
1
Γ(n/2)2n/2
u(n/2)−1 e−u/2   , if   u>0
fU (u) =
0                           , if   u≤0
• Because Z and U are independent their joint density is
fZ,U (z, u) = fZ (z)fU (u)
• Consider transforming (Z, U ) to (T, V ), where
T = Z/ U/n and V = U,
computing the joint density of (T, V ) and then integrating out V
to obtain the marginal density of T .
– Determine the functions g(T, V ) = Z and h(T, V ) = U
g(T, V ) = V /nT
h(T, V ) = V
Then the joint density of (T, V ) is given by
fT,V (t, v) = fZ,U (g(t, v), h(t, v)) × J
where J is the Jacobian of the transformation from (Z, U ) to
(Z, U ).
Compute J:
∂g(t, v) ∂g(t, v)                       T 1
∂t         ∂v               V /n ( √ ) V −1/2
J = ∂h(t, v) ∂h(t, v) =                       n 2       = V /n
0              1
∂t         ∂v
1
The joint density of (T, V ) is thus
fT,V (t, v) = fZ (g(t, v)) × fU (h(t, v)) × J
1      1
√    2           1
= √ e− 2 ( v/nt) ×                         (n/2)−1 −v/2
p
v         e    ×  v/n
2π                   Γ(n/2)2n/2
1           1            v     t2
= √                     v 2 (n+1)−1 e− 2 (1+ n )
2πnΓ(n/2)2   n/2
Integrate over
a∞ v to  obtain the marginal density of T :
fT (t) = J0 fT,V (t, v)dv
∞
1           1            v     t2
=       √                  v 2 (n+1)−1 e− 2 (1+ n ) dv
0      2πnΓ(n/2)2Jn/2
∞ 1
1                              v     t2
= √                         v 2 (n+1)−1 e− 2 (1+ n ) dv
2πnΓ(n/2)2n/2 0
The integral factor can be evaluated by recognizing that it
is identical to integrating a Gamma(α, λ) density function
apart from the normalization constant, with α = (n + 1)/2
2
and λ = 12 (1 + tn ), that is
a ∞ 1 α α−1 −λv
1 = 0 Γ(α)     λ v     e dv
−α
a ∞ α−1 −λv
So Γ(α)λ          = 0 v      e    dv
which
J ∞   gives
1            v    t2
v 2 (n+1)−1 e− 2 (1+ n ) dv = Γ(α) × λ−α
0                                                         2
= Γ((n + 1)/2) × [ 12 (1 + tn )]−(n+1)/2
Finally we can
a ∞write
fT (t) = 0 fT,V (t, v)dv J
∞ 1
1                            v    t2
= √                       v 2 (n+1)−1 e− 2 (1+ n ) dv
2πnΓ(n/2)2n/2 0
1                           1       t2
= √                 Γ((n + 1)/2) × [ (1 + )]−(n+1)/2
2πnΓ(n/2)2n/2                     2        n
2   −(n+1)/2
Γ((n + 1)/2)        t
= √              × 1+
πnΓ(n/2)         n', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 1 Spring 2014 Statistics for Applications Due Date: 2/13/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
6.4.4. Also, answer the question if the random variable T follows a
standard normal distribution N (0, 1). Comment on the diﬀerences
and why that should be.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : 6.4.4. Also, add part (c) answer the question if the random variable
T follows a standard normal distribution N (0, 1). Comment on the
diﬀerences and why that should be.
Solution:
We are given that T follows a t7 distribution. The problem is solved
by ﬁnding an expression for t0 in terms of the cumulative distribution
function of T.
(a). To ﬁnd the t0 such that P (|T | < t0 ) = .9 this is equivalent to
P (T < .95), which is solved in R using the function qt() – the quantile
function for the t distribution
> args(qt)
function (p, df, ncp, lower.tail = TRUE, log.p = FALSE)
>qt(.95,df=7)
[1] 1.894579
3
So, t0 = 1.894579.
(b). P (T > t0 ) = .05 is equivalent to P (T ≤ t0 ) = 1 − .05 = .95. This
is the same t0 found in (a).
> args(qt)
function (p, df, ncp, lower.tail = TRUE, log.p = FALSE)
> qt(p=.95, df=7)
[1] 1.894579
# Which is equivalent to
> qt(p=.05, df=7, lower.tail=FALSE)
[1] 1.894579
(c). For the standard normal distribution we use qnorm() – the quan­
tile function for the N ormal(0, 1) distribution
> args(qnorm)
function (p, mean = 0, sd = 1, lower.tail = TRUE, log.p = FALSE)
NULL
> qnorm(.95)
[1] 1.644854
> qnorm(p=.05, lower.tail=FALSE)
[1] 1.644854
So for both parts (a) and (b) t0 = 1.644854 for the N (0, 1) r.v. versus
t0 = 1.894579 for the t distribution with 7 degrees of freedom.
The t0 values are larger for the t distribution indicating that the t
distribution has heavier tail areas than the N ormal(0, 1) distribution.
This makes sense because the t distribution equals a N ormal(0, 1)
random variable divided by a random variable with expectation equal
to 1 but positive variance. The possibility of the denominator of the t
ratio being less than 1 increases the probability of larger values.', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 1 Spring 2014 Statistics for Applications Due Date: 2/13/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
Problem 8.10.13.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Problem 8.10.13.
In Example D of Secton 8.4, the method of moments estimate was
found to be α̂ = 3X. In this example, consider the sampling distribu­
tion of α̂.
(a). Show that E(α̂) = α, that is, that the estimate is unbiased.
(b). Show that V ar(α̂) = (3 − α2 )/n.
(c). Use the central limit theorem to deduce a normal approximation
to the sampling distribution of α̂.
According to this approximation, if n = 25 and α = 0, what is the
P (|α̂| > .5).
Solution
The sample of values X1 , . . . , Xn giving X are i.i.d. with density func­
tion
f (x | α) = 1+αx
2 , for −1 ≤ x ≤ +1,
with parameter α : −1 ≤ α ≤ 1. (The values are such that xi = cos(θi ),
where θi is the angle at which electrons are emitted in muon decay.)
(a). Since the Xi are i.i.d.
a1
E[X] = E[Xi ] = −1 x × ( 1+αx
2 )dx = α/3
It follows that
E[α̂] = E[3X] = 3E[X] = 3(α/3) = α
(b). Since the Xi are i.i.d.
V ar[X] =       V ar[Xi ]/n = ( n1 ) × (E[X 2 ] − E[X]2 )
a1
=       ( n1 ) × ([ −1 x2 × ( 1+αx             2
2 )dx] − (α/3) )
1   2
( n1 ) × ([ −1 x2 dx] − (α/3)2 )
a
=
=       ( n1 ) × ([1/3] − (α/3)2 )
3 − α2
=
9n
It follows that:
3 − α2
V ar[α̂] = V ar[3X] = 9 × V ar[X] =              .
n
(c) By the central limit theorm, for true parameter α = α0 , it follows
that
n→∞               3 − α02
α̂ −−−−−→ N (α0 ,             )
n', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 4 Spring 2015 Statistics for Applications Due Date: 3/13/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
Problem 8.10.7', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Problem 8.10.7
Suppose that X follows a geometric distribution
P (X = x | p) = p(1 − p)x−1 , x = 1, 2 . . .
Assume an i.i.d. sample of size n.
(a). Find the method of moments estimate of p.
The ﬁrst moment of X is
∞             k−1 = 1/p
µ1 =           k=1 kp(1 − p)
(See Appendex A, page A1.)
n
Solving µ̂1 = X = n1        i=1 Xi = µ1 gives
p̂ = X1 .
(b). Find the mle of p. The mle of a sample x1 , . . . , xn minimizes
n            xi −1 ] = pn (1 − p)( n
(
Lik(p) =       [p(1 − p)                       i=1 Xi )−n
i=1
The mle is the same as the mle for a sample of size ( ni=1 xi ) from a
Bernoulli(p) distribution with n successes:
p̂ = (n xni −n+n = 1/X (same as the method-of-moments
i=1
estimate)
(c) The asympotic variance of the mle is
2
V ar(ˆ           1
pM LE ) ≈ nI(p) = p (1−p)
n
where
2
I(p) = E[− ∂ log[P
∂p2
(x|p)]
]
∂    2
= E[− ∂p 2 [ln(p) + (x − 1) ln(1 − p)]
(x−1)
= E[−[− p12 − (1−p) 2 ]]
=   1
p2
+ E[X]−1
(1−p)2
1      (1−p)
=   p2
+ p(1−p)  2
1        1
=   p2
+ p(1−p)
1
=    2
p (1−p)
(d). Let p have a uniform distribution on [0, 1]. The posterior distri­
bution of p has density
π(p | x1 , . . . , xn ) ∝ Lik(p) × π(θ)
(n
= pn (1 − p)( i=1 xi )−n × 1
∗           ∗
= pa −1 (1 − p)b −1
which can be recognized as a Beta(a∗ , b∗ ) distribution with
2
a∗ = (n + 1) and b∗ = ( ni=1 xi ) − n + 1
P
The mean of the posterior distribution is the mean of the Beta(a∗ , b∗ )
distribution which is
a∗
E[p | x1 , . . . , xn ] =
a∗ + b∗
n+1
=
n + 1 + ( ni=1 xi ) − n + 1
P
n+1
= Pn
i=1 xi + 2
(Note: the book solution is only for n = 1 and x1 = k)', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 4 Spring 2015 Statistics for Applications Due Date: 3/13/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
Problem 8.10.63', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Problem 8.10.63
Suppose that 100 items are sampled from a manufacturing process
and 3 are found to be defective. Let X = 3 be the outcome of a
Binomial(n = 100, θ) random variable.
The likelihood of the data is
100
Lik(θ) =           θ3 (1 − θ)97
3
Consider a prior distribution for θ which is Beta(a, b), (with a > 0, b >
0).
1
π(θ) = β(a,b) θa−1 (1 − θ)b−1 .
The posterior distribution has density:
π(θ | x) ∝ Lik(θ) × π(θ)
100                          1
= [         ]θ3 (1 − θ)97 ] × [ β(a,b) θa−1 (1 − θ)b−1 ]
3
∝ θa+3−1 (1 − θ)97+b−1
Which normalizes to a Beta(a∗ , b∗ ) distribution where
a∗ = a + 3, and b∗ = b + 97.
The mean of the posterior distribution is
E[θ | X] = a∗ /(a∗ + b∗ ).
For a = b = 1 we have E[θ | X] = 4/102 and
For a.5, and b = 5 we have E[θ | X] = 3.5/105.5.
The R code in P roblem 8 10 63.html plots the prior/posterior densi­
ties and computes the posterior means.', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 9 Spring 2015 Statistics for Applications Due Date: 5/1/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
14.9.6.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : 14.9.6. The 4 weighings correspond to 4 outcomes of the dependent
variable y
⎡ ⎤
3
⎢ 3 ⎥
Y =⎢
⎣ 1 ⎦
⎥
7
For the regression parameter vector
w1
β=
w2
the design matrix is
⎡         ⎤
1     0
⎢ 0     1 ⎥
X=⎢  ⎣ 1 −1 ⎦
⎥
1     1
The regression model is
Y = Xβ + e
(b). The least squares estimates of w1 and w2 are given by
ŵ1
β̂ =           = (X T X)−1 X T Y
ŵ2
Note that
3 0                                  1/3 0
(X T X) =                 so          (X T X)−1 =
0 3                                   0 1/3
11
and              (X T Y ) =      ,
9
1/3 0               11            11/3
so βˆ =                  ×               =
0 1/3               9              3
(c). The estimate of σ 2 is given by the sum of squared residuals divided
by n − 2, where 2 is the number of columns of X which equals the
number of regression parameters estimated.
The vector of least squares residuals is:
⎡          ⎤ ⎡               ⎤ ⎡      ⎤
y1 − ŷ1        3 − 11/3       −2/3
⎢ y2 − ŷ2 ⎥ ⎢ 3 − 3 ⎥ ⎢ 0 ⎥
⎣ y3 − ŷ3 ⎦ = ⎣ 1 − 2/3 ⎦ = ⎣ 1/3 ⎦
ê = ⎢          ⎥ ⎢               ⎥ ⎢      ⎥
y4 − ŷ4        7 − 20/3        1/3
From this we can compute
2
2   2       2       2
σ̂ 2 = (−2/3) +0 +(1/3)
4−2
+(1/3)
= 6/9
2 = 1/3
(d). The estimated standard errors of the least squares estimates of
part (b) are the square roots of the diagonal entries of
ˆ β)
Cov(  ˆ = σ̂ 2 (X T X)−1
which are both equal to          σ 2 × 1/3 = 1/3.
(e). The estimate of w1 − w2 is given by β̂1 − β̂2 = 11/3 − 3 = 2/3
The standard error of the estimate is the estimate of its standard
deviation which is the square root of the estimate of its variance.
Now
V ar(β̂1 − β̂2 ) = V ar(β̂1 ) + V ar(β̂2 ) − 2Cov(β̂1 , β̂2 ).
This is the sum of the diagonal elements of Ĉov(hatβ) minus the sum
of oﬀ-diagonal entries (which are 0).
So          Vˆ ar(β̂1 − β̂2 ) = 1/9 + 1/9 − 2 × 0 = 2/9.
and the standard error is          2/9
(f). To test H0 : w1 = w2 , we can compute the t-statistic
ŵ1 −ŵ2        2/3   √
t = stErr( ˆ 1 −w
w    ˆ2 ) = √   =   2
2/9
Under H0 this has a t distribution with n − 2 = 2 degrees of freedom.
Using R we can compute the P -value as
P-Value = 2*(1-pt(sqrt(2),df=2)) = 0.2928932
For normal signiﬁcance levels (.05 or .01) the null hypothesis is not
rejected because the P-Value is higher.', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 3 Spring 2015 Statistics for Applications Due Date: 2/27/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
Problem 8.10.21.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Problem 8.10.21.
Suppose that X1 , X2 , . . . , Xn are i.i.d. with density function
e−(x−θ) , if    x≥θ
f (x | θ) =
0,        otherwise
(a). Find the method of moments estimate of θ.
The ﬁrst moment of X is
∞
µ1 = E[X] = θ xe−(x−θ) dx
∞
= θ + 0 ye−y dy
∞ −y
= θ + [(y)(−ey )]|y=∞
y=0 + 0 e dy
= θ+1
(The second line follows by tranforming to y = x − θ; the third line
follows from integration-by-parts.)
Equating the sample ﬁrst moment to the population ﬁrst moment:
µ1 = µ̂1
n
1
θ+1 =        Xi = X
n
1
=⇒ θˆ = X − 1
(b). Find the mle of θ. The likelihood of the data is
lik(θ) = ff(X1 , . . . , Xn | θ)
n
=         f (Xi | θ)
fi=1
n      −(Xi −θ) 1
=    i=1 [e            [θ,∞) (Xi )]
n               n
−   i=1 (Xi −θ) ]
f
= [e                     i=1 [1[0,Xi ] (θ)]
n
= [e− i=1 Xi enθ ][1[0,min(X1 ,...,Xn )] (θ)
lik(θ) is maximized by maximizing θ subject to θ ≤ Xi ,
for all i = 1, . . . , n
i.e.,          θˆM LE = min(X1 , . . . , Xn )
(c). Find a suﬃcient statistic for θ. Consider
1
T (X1 , . . . , Xn ) = min(X1 , . . . , Xn )
The distribution function of T , FT (t) satisﬁes
[1 − FT (t)] =       P (T > t)
=       P
f(X  1 > t, X2 > t, . . . Xn > t)
n
=               P (Xi > t)
fi=1
n     −(t−θ) ]
=          i=1 [e
=       [e−n(t−θ)  ]
for values t ≥ θ.
The density of T is simply the derivative:
fT (t | θ) = ne−n(t−θ) , t ≥ θ.
The conditional density of the sample given T = t is
f (X1 , . . . , Xn | θ)
f (X1 , . . . , Xn | T, θ) =
PfnT (t | θ)
[e− i=1 Xi enθ ][1[0,min(X1 ,...,Xn )] (θ)]
=
[e−n(t−θ) ]1[0,t] (θ)
Pn               nn
= [e− i=1 (Xi −t) ][ 1[t,∞) (Xi )]
i=1
The density function does not depend on θ, so
T = min(X1 , . . . , Xn ) is suﬃcient for θ.', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 3 Spring 2015 Statistics for Applications Due Date: 2/27/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
Problem 8.10.51 Double Exponential (Laplace) Distribution', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Problem 8.10.51 Double Exponential (Laplace) Distribution
The double exponential distribution is
f (x | θ) = 12 e|x−θ| , −∞ < x < ∞.
For an iid sample of size n = 2m + 1, show that the mle of θ is the
median of the sample.
Let X1 , . . . , Xn denote the sample random variables with outcomes
x1 , . . . , xn . The likelihood function of the data is
fn                  fn 1 −|xi −θ|
lik(θ) =       i=1 f (x
Pn i | θ) =  i=1 [ 2 e    ]
1 n − i=1 |xi −θ|
= (2) e
This is maximized by minimizing the sum in the exponent:
g(θ) = ni=1 |xi − θ|
o
Note that g(θ) is a continuous function of θ and its derivative exists
at all points θ that are not equal to any xi
g / (θ) = dθd
g(θ) =o ni=1 [−1 × 1(xi > θ) + (+1)
o
n                       on × 1(xi < θ)]
= (−1)
     × [  i=1 1(xi > θ)] + (+1) ×   i=1 1(xi < θ)]
positive if θ > median(xi )
=
negative if θ < median(xi )
4
It follows that g(θ) is minimized at θ = median(xi ). A graph of g(θ) is
piecewise linear with slope changes at each of the xi values; the slope
at any given θ (not equal to an xj ) is
count(xi < θ) − count(xi > θ).', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 10 Spring 2015 Statistics for Applications Due Date: 5/15/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
12.5.6
Prove this version of the Bonferroni inequality:
n
P (∩ni=1 Ai ) ≥ 1 −             c
i=1 P (Ai )
Let A∗ = ∩ni=1 Ai . Then
A∗c = ∪k=1
n Ac
i
n
So P (Ac∗ ) = P (∪nk=1 Aci ) ≤           c
k=1 P (Ai )
Because P (A∗ ) = 1 − P (A∗c ), it follows that
n       c
P (A∗ ) ≥ 1 −     k=1 P (Ai )
In the context of simulataneous conﬁdence intervals
Ai is the the event that the ith conﬁdence interval contains the
associated parameter
∩ni=1 Ai is the the event that all conﬁdence intervals contains
the associated parameters simultaneously.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : 12.5.6
Prove this version of the Bonferroni inequality:
n
P (∩ni=1 Ai ) ≥ 1 −             c
i=1 P (Ai )
Let A∗ = ∩ni=1 Ai . Then
A∗c = ∪k=1
n Ac
i
n
So P (Ac∗ ) = P (∪nk=1 Aci ) ≤           c
k=1 P (Ai )
Because P (A∗ ) = 1 − P (A∗c ), it follows that
n       c
P (A∗ ) ≥ 1 −     k=1 P (Ai )
In the context of simulataneous conﬁdence intervals
Ai is the the event that the ith conﬁdence interval contains the
associated parameter
∩ni=1 Ai is the the event that all conﬁdence intervals contains
the associated parameters simultaneously.', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 2 Spring 2014 Statistics for Applications Due Date: 2/20/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
Problem 8.10.27; instead of 5 components, suppose there are 8 and
that the ﬁrst one fails at 50 days.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Problem 8.10.27; instead of 5 components, suppose there are 8 and
that the ﬁrst one fails at 50 days.
Suppose that certain electronic components have lifetimes that are
exponentially distributed
f (t | τ ) = (1/τ )exp(−t/τ ), t ≥ 0.
Five new components are put on test. The ﬁrst one fails at 100 days,
and no further observations are recorded.
By the Hint (Example A of Section 3.7), let T1 , T2 , . . . , Tn be the time
until failure of n components (we shall set n = 8 below).
These random variables are i.i.d. with cumulative distribution function
FT (t) = 1 − exp(−t/τ )
Let TM IN = min(T1 , T2 , . . . , Tn ) be the shortest time to failure. (If
a system operates with components 1-n connected in a series, then
TM IN is the time until failure of the sytem.)
The cumulative distribution function of TM in , FTM IN (t) must satisfy:
[1 − FTM IN (t)] = P (TM IN > t)
n
= P (T1 > t, T2 > t, . . . , Tn > t) =    i=1 P (Ti > t)
n                                n
=   j=1 [1 − FT (t)] = [1 − FT (t)]
It follows that the probability density function of TM IN is
d
fTM IN (t) =    − dt [1 − FTM IN (t)]
d
=    n[1 − FT (t)]n−1 dt [FT (t)]
=    n[exp(−t/τ )]  n−1 (1/τ )exp(−t/τ )
=    (n/τ )exp[−t(n/τ )]
That is, TM IN ∼ Exponential(rate = n/τ ).
(a). What is the likelihood function of τ ? The data consists of TM IN =
50 with n = 8, so
lik(τ ) = fTM IN (t = 50) = (n/τ )exp[−t(n/τ )]|t=50,n=8
= (8/τ )exp[−50(8/τ )]
1
(b). What is the mle of τ ?
The mle maximizes lik(τ ) and J(τ ) = log lik(τ ), which is the solution
to
d
0 = J (τ ) = dτ   J(τ )
d               d
= dτ [ln(n/τ )] + dτ  [−t(n/τ )]
1      1 2
= − τ − tn( τ ) (−1)
=⇒ τ̂      = tn = TM IN × n = (50 × 8) = 400.
(c). What is the sampling distribution of the mle?
The mle is τ̂ = TM IN × n which is n times the minimum of n i.i.d.
Exponential(rate = 1/τ ) random variables. The distribution of TM IN
is Exponential(rate = 5/τ ) The mle is 5 the minimum of n exponential
1 − Fτ̂ (u) =   P (τ̂ ≥ u)
=   P (TM IN × n ≥ u) = P (TM IN ≥ u/n)
=   [1 − FT (u/n)]n
=   [exp(−(u/n)/τ ]n
=   [exp(−u/τ )]
So Fτ̂ (u) = 1 − exp(−u/τ ) which is the cdf of an Exponential(rate =
1/τ ) random variable.
(d). What is the standard error of the mle?
The standard error of the mle is the formula for the square root of the
variance of the mle, plugging in the mle estimate for the value of the
true parameter
StError(τ̂ ) = √ V ar(τ̂ )|τ =τ̂
=     τ 2 |τ =τ̂ = τ̂ = 400.
The variance formula follows from p. A2 Appendix A for
Gamma(α = 1, λ = 1/τ ), which is Exponential(rate = 1/τ ).', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 2 Spring 2014 Statistics for Applications Due Date: 2/20/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem]
Problem 8.10.53; (for credit you must detail all calculations', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Problem 8.10.53
Let X1 , . . . , Xn be i.i.d. uniform on [0, θ]
(a). Find the method of moments estimate of θ and its mean and
variance.
The ﬁrst moment of each Xi is
θ
µ1 = E[Xi | θ] = 0 xf (x | θ)dx
θ
= 0 x 1θ dx = 1θ [x2 /2]|θx=0
1 2
= θ [θ /2] = θ/2
The method of moments estimate solves
n
x = n1    1 xi = µ1 = θ/2
So
θˆM OM = 2x.
3
The mean and variance of θˆM OM = 2x can be computed from the
mean and variance of the i.i.d. Xi :
µ1 = E[Xi ] = θ/2 (shown above)
σ 2 = µ2 − (µ1 )2 = E[Xi2 ] − E[Xi ]2
Rθ
= 0 x2 f (x | θ)dx − [θ/2]2
= 1θ [x3 /3]|x=θ
x=0 − [θ/2]
2
2         2
= [θ /3] − [θ /4] = θ /122
It follows that
E[2X] = 2 × n1 1n E[Xi ] = 2 × nn θ = θ
P
E[θ̂M OM ]     =
V ar[θ̂M OM ] =      V ar[2X] = 4 × V ar[X]
=     4 × V ar[Xi ]/n
=     4 × (θ2 /12)/n = θ2 /(3n).
(b). Find the mle of θ.
The mle θ̂M LE maximizes the likelihood function
lik(θ) = f (x1 , . . . , xn | θ) = ni=1 [ 1θ × 1[0,θ] (xi )]
Q
= θ1n 1[0,θ] (max(x1 , . . . , xn ))
= θ1n 1[max(x1 ,...,xn ),∞) (θ)
1, if         x ∈ [a, b]
Where 1[a,b] (x) =
0, if         x ∈ [a, b]
The likelihood function is maximized by the minimizing θ. Since θ ≥
max(x1 , . . . , xn ) the likelihood is maximized with
θ̂ = max(x1 , . . . , xn )
(c). Find the probability density of the mle, and calculate its mean
and variance. Compare the variance, the bias, and the mean squared
error to those of the method of moments estimate.
The probability density of the mle is the probability density of the
maximum member of the sample X1 , . . . , Xn
We compute the cdf (cumulative distribution function) of the mle ﬁrst.
FθˆM LE (t) = P (θ̂M LE ≤ t)
= P (max(X1 , . . . , Xn ) ≤ t) = P (X1 ≤ t, X2 ≤ t, . . . Xn ≤ t)
= [P (Xi ≤ t)]n = [ θt ]n
The density of θ̂M LE is the derivative of the cdf:
d                   t n−1 1
fθ̂M LE (t) =      dt Fθ̂M LE (t) = n[ θ ]  [θ]
nt n−1
=               , 0<t<θ
θn
4
The mean and variance of θˆM LE can be computed directly
Rθ
E[θˆM LE ] = 0 [tfθˆM LE (t)]dt
� θ
ntn−1
=       [t n ]dt
0      θ
n tn+1 t=θ
=      [      ]|
θn n + 1 t=0
n θ  n+1
=      [      ]
θn n + 1
n
=          θ
n+1
V ar[θ̂M LE ] = E[θ̂M2    ] − (E[θ̂M LE ])2
R θ 2 LE
= 0 [t fθˆM LE (t)]dt − (E[θ̂M LE ])2
� θ
ntn−1
=     [t2 n ]dt
0       θ
n tn+2 t=θ
=    [        ]|   − (E[θ̂M LE ])2
θn n + 2 t=0
n θn+2
=    [        ] − (E[θ̂M LE ])2
θn n + 2
n 2
=        θ − (E[θ̂M LE ])2
n+2
n 2           n
=        θ −[           θ]2
n+2            n + 21
n        n
= θ2 × [ n+2   − (n+1)  2]
2           n
= θ × (n+2)(n+1)2
Now, to compare the variance, the bias, and the mean squared error
to those of the method of moments estimate, we apply the formulas:
Bias(θ̂) = E[θ̂] − θ
M SE(θ̂) = V ar(θ̂) + [Bias(θ̂)]2
So, we can compare:
n
V ar(θ̂M LE )   = θ2 × (n+2)(n+1)2
1
Bias(θ̂M LE ) = E[θ̂M LE ] − θ = − n+1 θ
M SE(θ̂M LE ) = V ar(θ̂M LE ) + [Bias(θ̂M LE )]2
n            1 2
= θ2 × [ (n+2)(n+1)2 + (− n+1 ) ]
2n+2
= θ2 × [ (n+2)(n+1)2]
V ar(θ̂M OM ) = θ2 /3n
Bias(θ̂M OM ) = E[θ̂M OM ] − θ = 0
M SE(θ̂M OM ) = V ar(θ̂M OM ) + [Bias(θ̂M OM )]2
= θ2 /3n
5
Note that as n grows large, the MLE has variance and MSE which
decline to order O(n−2 ) while the MOM estimate declines slower, to
order O(n−1 ).
(d). Find a modiﬁcation of the mle that renders it unbiased.
To adjust θ̂M LE to make it unbiased, simply multiply it by the factor
( n+1
n )
∗       n+1 ˆ
θ̂M LE = ( n )θM LE', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 6 Spring 2015 Statistics for Applications Due Date: 4/3/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem] For full credit, explain your reasoning and detail any calculations.
Problem 9.11.5', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Problem 9.11.5
(a). The signiﬁcance level of a statistical test is equal to the probability
that the null hypothesis is true.
False. In non-Bayesian hypothesis testing, there are no probabilities on
the truth of the null (or alternative) hypothesis. The signiﬁcance level
is the conditional probability of rejecting the null hypothesis when
the null hypothesis is true. The probability is computed under the
conditional distribution of the data under the null hypothesis.
2
(b). If the signiﬁcance level of a test is decreased, the power would be
expected to increase.
False. If the signiﬁcance level of a test is decreased, then the test re­
jects the null hypothesis with lower probability (less frequently) under
the null hypothesis. The power of the test is 1 minus the probability
of rejecting the null hypothesis evaluated under the conditional proba­
bility for a given alternate hypothesis. The power should decrease too
since the test rejects less often if it has a lower level .
(c). If a test is rejecte at the signiﬁcance level α, the probability that
the null hypothesis is true equals α.
False. See (a) – we cannot evaluate the probability of the null hypoth­
esis being true.
(d). The probability that the null hypothesis is falsely rejected is equal
to the power of the test.
False. The power of the test is the probability that the null hypothesis
is correctly rejected.
(e). A type I error occurs when the test statistic falls in the rejection
region of the test.
False. When the test statistic falls in the rejection region of the test,
the test procedure rejects the null hypothesis. This may lead to a cor­
rect decision of the null hypothesis is false, or to an incorrect decision
(the type I error) if the null hypothesis is true. We do not know which.
(f). A type II error is more serious than a type I error.
False. Both error types are serious. In Neyman-Pearson testing, we
limit the size of the type I error and ﬁnd the test that minimizes the
type II error subject to the constraint. By controlling the size of the
type I error, it is given precedence in specifying tests.
(g). The power of a test is determined by the null distribution of the
test statistic.
False. The power of a test is the conditional probability of correctly
rejecting the null hypothesis when the alternate hypothesis is true. It
is a function which is computed for every distribution in the alternate
hypothesis.
(h). The likelihood ratio is a random variable.
3
True. The likelihood ratio is the ratio of the conditional pmf/pdf of
the data (X) under H0 and HA . It is a function of the data which is
a random variable.', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] 18.443 Problem Set 6 Spring 2015 Statistics for Applications Due Date: 4/3/2015 prior to 3:00pm Problems from John A. Rice, Third Edition. [Chapter.Section.P roblem] For full credit, explain your reasoning and detail any calculations.
Problem 9.11.26', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Problem 9.11.26
(a). The generalized likelihood ratio statistic Λ is always less than or
equal to 1.
maxθ∈Θ0 Lik(θ)
True. Λ =
maxθ∈Θ Lik(θ)
where Θ0 ⊂ Θ.
(b). If the p-value is 0.03, the corresponding test will reject at the
signﬁcance level 0.02.
False. Since the p-value is greater than 0.02, the data not surprising
enough to reject the null hypothesis. The p-value is the lowest signif­
icance level of tests that reject the null hypothesis.
(c). If a test rejects at signiﬁcance level 0.06, then the p-value is less
than or equal to 0.06.
True. The p-value of the test statistic must be as low or lower than
the signiﬁcance level for the test to reject.
(d). The p-value of a test is the probability that the null hypothesis is
correct.
False. The p-value is a conditional probability given the null hypothesis
is true.
(e). In testing a simple versus simple hyopthesis via the likleihood
ratio, the p-value equals the likelihood ratio.
4
False. The p-value is a probability computed assuming the null hy­
pothesis is true. For the likelihood ratio test, it is the probability that
the likelihood ratio (H0 to H1 ) is smaller than the observed value,
computed under the conditional probability given H0 .
(f). If a chi-square test statisti with 4 degrees of freedom has a value
of 8.5, the p-value is less than 0.05
False. Using R, the p value of the test statistic is
1 − pchisq(8.5, df = 4) = 0.07488723
The p-value is greater than 0.05.', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] NAME: 18.443 Exam 2 Spring 2015 Statistics for Applications 4/9/2015
True or False:
(a). The signiﬁcance level of a statistical test is not equal to the probability
that the null hypothesis is true.
(b). If a 99% conﬁdence interval for a distribution parameter θ does not
include θ0 , the value under the null hypothesis, then the corresponding
test with signiﬁcance level 1% would reject the null hypothesis.
(c). Increasing the size of the rejection region will lower the power of a
test.
(d). The likelihood ratio of a simple null hypothesis to a simple alternate
hypothesis is a statistic which is higher the stronger the evidence of the
data in favor of the null hypothesis.
(e). If the p-value is 0.02, then the corresponding test will reject the null
at the 0.05 level.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : True or False (and state why).
(a). The signiﬁcance level of a statistical test is not equal to the probability
that the null hypothesis is true.
(b). If a 99% conﬁdence interval for a distribution parameter θ does not
include θ0 , the value under the null hypothesis, then the corresponding
test with signiﬁcance level 1% would reject the null hypothesis.
(c). Increasing the size of the rejection region will lower the power of a
test.
(d). The likelihood ratio of a simple null hypothesis to a simple alternate
hypothesis is a statistic which is higher the stronger the evidence of the
data in favor of the null hypothesis.
(e). If the p-value is 0.02, then the corresponding test will reject the null
at the 0.05 level.
Solution: T, T, F, T, T', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] NAME: 18.443 Exam 2 Spring 2015 Statistics for Applications 4/9/2015
Reliability Analysis
Suppose that n = 10 items are sampled from a manufacturing process
and S items are found to be defective. A beta(a, b) prior 1 is used for
the unknown proportion θ of defective items, where a > 0, and b > 0 are
known.
(a). Consider the case of a beta prior with a = 1 and b = 1. Sketch a plot
of the prior density of θ and of the posterior density of θ given S = 2. For
each density, what is the distribution’s mean/expected value and identify
it on your plot.
(b). Repeat (a) for the case of a beta(a = 1, b = 10) prior for θ.
(c). What prior beliefs are implied by each prior in (a) and (b); explain
how they diﬀer?
(d). Suppose that X = 1 or 0 according to whether an item is defective
(X=1). For the general case of a prior beta(a, b) distribution with ﬁxed a
and b, what is the marginal distribution of X before the n = 10 sample is
taken and S is observed? (Hint: specify the joint distribution of X and θ
ﬁrst.)
(e). What is the marginal distribution of X after the sample is taken?
(Hint: specify the joint distribution of X and θ using the posterior distri­
bution of θ.)
Γ(a + b) a−1
1 A beta(a, b) distribution has density f
Θ (θ) =      θ   (1 − θ)b−1 , 0 < θ < 1.
Γ(a)Γ(b)
Recall that for a beta(a, b) distribution, the expected value is a/(a + b), the variance is
ab
. Also, when both a > 1 and b > 1, the mode of the probability density is
(a + b)2 (a + b + 1)
at (a − 1)/(a + b − 2),
2', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The random variable S ∼ Binomial(n, θ). If θ ∼ beta(a =
1, b = 1), then because the beta distribution is a conjugate prior for the
binomial distribution, the posterior distribution of θ given S is
beta(a∗ = a + S, b∗ = b + (n − s))
For S = 2, the posterior distribution of θ is thus beta(a = 3, b = 9)
Since the mean of a beta(a, b) distribution is a/(a + b), the prior mean is
1/2 = 1/(1 + 1), and the posterior mean is 3/12 = (a + s)/(a + b + n)
These densities are graphed below
Γ(a + b) a−1
1 A beta(a, b) distribution has density f
Θ (θ) =      θ   (1 − θ)b−1 , 0 < θ < 1.
Γ(a)Γ(b)
Recall that for a beta(a, b) distribution, the expected value is a/(a + b), the variance is
ab
. Also, when both a > 1 and b > 1, the mode of the probability density is
(a + b)2 (a + b + 1)
at (a − 1)/(a + b − 2),
4
Prior beta(1,1) with mean = 1/2
Posterior beta(1+2, 1+8) with mean = 3/12
3.0
2.5
2.0
density
1.5
1.0
0.5
0.0
0.0       0.2       0.4           0.6   0.8       1.0
theta
(b). Repeat (a) for the case of a beta(a = 1, b = 10) prior for θ.
Solution: The random variable S ∼ Binomial(n, θ). If θ ∼ beta(a =
1, b = 10), then because the beta distribution is a conjugate prior for the
binomial distribution, the posterior distribution of θ given S is
beta(a∗ = a + S, b∗ = b + (n − s))
For S = 2, the posterior distribution of θ is thus beta(a = 3, b = 18)
Since the mean of a beta(a, b) distribution is a/(a + b), the prior mean is
1/11 = 1/(10 + 1), and the posterior mean is 3/21 = (a + s)/(a + b + n)
These densities are graphed below
5
Prior beta(1,10) with mean = 1/11
Posterior beta(1+2, 10+8) with mean = 3/21
10
8
6
density
4
2
0
0.0        0.2       0.4           0.6   0.8       1.0
theta
(c). What prior beliefs are implied by each prior in (a) and (b); explain
how they diﬀer?
Solution: The prior in (a) is a uniform distribution on the interval 0 <
θ < 1. It is a ﬂat prior and represents ignorance about θ such that any
two intervals of θ have the same probability if they have the same width.
The prior in (b) gives higher density to values of θ closer to zero. The
mean value of the prior in (b) is 1/11 which is much smaller than the mean
value of the uniform prior in (a) which is 1/2.
(d). Suppose that X S = 1 or 0 according to whether an item is defective
(X=1). For the general case of a prior beta(a, b) distribution with ﬁxed a
and b, what is the marginal distribution of X before the n = 10 sample is
taken and S is observed? (Hint: specify the joint distribution of X and θ
ﬁrst.) Solution: The joint distribution of X and θ has pdf/cdf:
f (x, θ) = f (x | θ)π(θ)
where f (x | θ) is the pmf of a Bernoulli(θ) random variable and π(θ) is
the pdf of a beta(a, b) distribution.
The marginal distribution of X has pdf
6
J1
f (x)   = 0 f (x, θ)dθ
J1
= 0 θx (1 − θ)1−x π(θ)dθ
J1
= 0 θπ(θ)dθ,       f or x = 1
J1
and     = 1 − 0 θπ(θ)dθ f or x = 0
J1
That is, X is Bernoulli(p) with p = 0 θπ(θ)dθ = E[θ | prior] = a/(a+b).
(e). What is the marginal distribution of X after the sample is taken?
(Hint: specify the joint distribution of X and θ using the posterior distri­
bution of θ.)
Solution: The marginal distribution of X afer the sample is computed
using the same argument as (c), replacing the prior distribution with the
posterior distribution for θ given S = s.
X is Bernoulli(p)
with
J1
p=   0
θπ(θ | S)dθ = E[θ | S] = (a + s)/(a + b + n).
7', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.443 — question d’examen, en anglais] NAME: 18.443 Exam 2 Spring 2015 Statistics for Applications 4/9/2015
Betas for Stocks in S&P 500 Index. In ﬁnancial modeling of stock
returns, the Capital Asset Pricing Model associates a “Beta” for any stock
which measures how risky that stock is compared to the “market portfolio”.
(Note: this name has nothing to do with the beta(a,b) distribution!) Using
monthly data, the Beta for each stock in the S&P 500 Index was computed.
The following display gives an index plot, histogram, Normal QQ plot for
these Beta values.
Index Plot of 500 Stock Betas (X)
Beta (x)
1.5
0.0
0           100               200                     300             400         500
Index
Histogram
0.8
Density
0.4
0.0
0.0        0.5           1.0               1.5             2.0         2.5
Stock Beta (x)
Normal Q−Q Plot
Sample Quantiles
1.5
0.0
−3         −2            −1               0                 1           2         3
Theoretical Quantiles
For the sample of 500 Beta values, x =1.0902 and sx =0.5053.
(a). On the basis of the histogram and the Normal QQ plot, are the values
consistent with being a random sample from a Normal distribution?
(b). Reﬁne your answer to (a) focusing separately on the extreme low
values (smallest quantiles) and on the extreme large values (highest quan­
tiles).
5
Bayesian Analysis of a Normal Distribution. For a stock that is
similar to those that are constituents of the S&P 500 index above, let
X = 1.6 be an estimate of the Beta coeﬃcient θ.
Suppose that the following assumptions are reasonable:
• The conditional distribution X given θ is Normal with known vari­
ance:
X | θ ∼ N ormal(θ, σ02 ), where σ02 = (0.2)2 .
• As a prior for θ, assume that θ is Normal with mean and variance
equal to those in the sample
2
θ ∼ N ormal(µprior , σprior )
where µprior = 1.0902 anad σprior = 0.5053
(c). Determine the posterior distribution of θ given X = 1.6.
(d). Is the posterior mean between X and µprior ? Would this always be
the case if a diﬀerent value of X had been observed?
(e). Is the variance of the posterior distribution for θ given X greater or
less than the variance of the prior distribution for θ? Does your answer
depend on the value of X?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Yes, the values are consistent with being a random sample from
a Normal distribution. The normal QQ-plot is quite straight.
(b). Reﬁne your answer to (a) focusing separately on the extreme low
values (smallest quantiles) and on the extreme large values (highest quan­
tiles).
Solution: Consider the extremes of the distribution. The high positive
points appear a bit higher than would be expected for a normal sample
suggesting there are some outlier stocks with higher betas than would be
expected under a normal model. The lowest values near zero appear a
bit above the straight line through most of the ordered points, suggesting
11
that the stocks with lowest beta values aren’t as low as might be expected
under a normal model.
12
Bayesian Analysis of a Normal Distribution. For a stock that is
similar to those that are constituents of the S&P 500 index above, let
X = 1.6 be an estimate of the Beta coeﬃcient θ.
Suppose that the following assumptions are reasonable:
• The conditional distribution X given θ is Normal with known vari­
ance:
X | θ ∼ N ormal(θ, σ02 ), where σ02 = (0.2)2 .
• As a prior for θ, assume that θ is Normal with mean and variance
equal to those in the sample
2
θ ∼ N ormal(µprior , σprior )
where µprior = 1.0902 anad σprior = 0.5053
(c). Determine the posterior distribution of θ given X = 1.6.
Solution: This is the case of a normal conjugate prior distribution for the
normal sample observation. The posterior distribution of θ is given by
[θ | X = x] ∼ N (µ∗ , σ∗2 )
where
1     1       1
σ∗2 = σ02 + σprior
2
and
( 12 )x+(      1
)µprior
σ          σ2
0       prior
µ∗ =             1
+ 2  1
σ2  σ
0    prior
Plugging in values we get
τ∗2 = (0.186)2
1            1
( 2 )1.6 + (        )1.0902
µ∗ = .2            .50532         = 1.531
1          1
( 2) + (         )
.2       .50532
(d). Is the posterior mean between X and µprior ? Would this always be
the case if a diﬀerent value of X had been observed?
(e). Is the variance of the posterior distribution for θ given X greater or
less than the variance of the prior distribution for θ? Does your answer
depend on the value of X?
Solution:
(d). Yes, the posterior mean is a weighted average of X and µprior which
will always be between the two values.
(e). The variance of the posterior distribution τ∗2 = (0.186)2 is less than
(.5053)2 = σprior
2
. From part (c), the posterior variance does not vary with
the outcome X = x.', 'source' => 'MIT OpenCourseWare, 18.443 Statistics For Applications, Spring 2015 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
						),
					),
				),
			),
		);
	}
}
