<?php
/**
 * Questions importees — MIT OpenCourseWare — 6 011 introduction to communication control and signal processing spring 2010
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.011 Introduction To Communication Control And Signal Processing, Spring 2010 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_011_examens' ) ) {
	function seca_import_mit_ocw_6_011_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-011-examens', 'nom' => 'MIT OpenCourseWare — 6 011 introduction to communication control and signal processing spring 2010', 'url' => 'https://ocw.mit.edu/courses/6-011-introduction-to-communication-control-and-signal-processing-spring-2010/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.011 Introduction To Communication Control And Signal Processing, Spring 2010 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'les-fondamentaux-du-reseau' => array(
					'title' => 'les-fondamentaux-du-reseau',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.011 — question d’examen, en anglais] Consider the discrete-time LTI ﬁlter speciﬁed by its frequency response H(ejΩ ) = exp{−j(60Ω + 25Ω3 )} for |Ω| < π. Determine the following properties of the ﬁlter frequency response for all |Ω| < π: (a) (1 point) its magnitude, |H(ejΩ )|; (b) (1 point) its phase, ∠H(ejΩ ); (c) (1 point) its group delay, τg (Ω). Finally, (d) (2 points) determine which one of the following plots (labeled A, B, C, D, E) is the impulse response h[n] of this ﬁlter; list two diﬀerent features of the chosen response that support your choice. (Adjacent values of h[n] are connected by straight lines in the attached plots, for ease of visualization.) 0.8 0.6 Impulse Response A 0.4 0.2 0 −0.2 −30   0   30   60   90
Consider the discrete-time LTI ﬁlter speciﬁed by its frequency response
H(ejΩ ) = exp{−j(60Ω + 25Ω3 )}
for |Ω| < π.
Determine the following properties of the ﬁlter frequency response for all |Ω| < π:
(a) (1 point) its magnitude, |H(ejΩ )|;
(b) (1 point) its phase, ∠H(ejΩ );
(c) (1 point) its group delay, τg (Ω).
Finally,
(d) (2 points) determine which one of the following plots (labeled A, B, C, D, E) is the impulse
response h[n] of this ﬁlter; list two diﬀerent features of the chosen response that support
your choice. (Adjacent values of h[n] are connected by straight lines in the attached plots,
for ease of visualization.)
0.8
0.6
Impulse Response A
0.4
0.2
0
−0.2
−30   0   30   60   90     120 150 180   210   240   270   300
Sample Number
Figure 1: Impulse Response A
2
0.8
0.6
Impulse Response B
0.4
0.2
0
−0.2
−30    0   30   60   90     120 150 180   210   240   270   300
Sample Number
Figure 2: Impulse Response B
0.25
0.2
0.15
0.1
Impulse Response C
0.05
0
−0.05
−0.1
−0.15
−0.2
−0.25
−30   0   30   60   90     120 150 180   210   240   270   300
Sample Number
Figure 3: Impulse Response C
3
0.25
0.2
0.15
0.1
Impulse Response D
0.05
0
−0.05
−0.1
−0.15
−0.2
−0.25
−30   0   30   60   90     120 150 180   210   240   270   300
Sample Number
Figure 4: Impulse Response D
0.8
0.6
Impulse Response F
0.4
0.2
0
−0.2
−30    0   30   60   90     120 150 180   210   240   270   300
Sample Number
Figure 5: Impulse Response E
4
Problem 2 (15 points)
Suppose we know that a speciﬁc real signal x(t) has deterministic autocorrelation function
� ∞
sin(2τ )
Rxx (τ ) =      x(t)x(t − τ ) dt = 9          .
−∞                          πτ
(a) (3 points) What is the energy spectral density S xx (jω) of this signal? (A careful and fully
labeled sketch of this energy spectral density as a function of ω will suﬃce as an answer.)
Check your answer carefully, as errors here will propagate! As one check on your answer,
compute the energy of the signal, namely
� ∞
Ex =       x2 (t) dt ,
−∞
in both the time domain and the frequency domain — i.e., respectively using Rxx (τ ) and
S xx (jω) — to be sure you get the same answer both ways.
(b) (2 points) What is the magnitude of the Fourier transform of x(t), i.e., what is |X(jω)|?
(Again, a careful and fully labeled sketch of |X(jω)| as a function of ω will suﬃce as an
answer.)
(c) (2 points) Keeping in mind your answer to (b), explicitly write down an expression for one
possible signal x(t) that has the deterministic autocorrelation function Rxx (τ ) speciﬁed
above. Be sure to explain your reasoning!
(d) (2 points) Your answer in (c) is not unique; for example, the signal −x(t) would have the
same deterministic autocorrelation function. Describe precisely the relation – in either
the time domain or the frequency domain – between any other (correct but otherwise
arbitrary) answer to (c) and the speciﬁc one you have written down in (c).
(e) (3 points) Suppose the x(t) above is the input to an ideal lowpass ﬁlter that has gain 1 for
frequencies ω satisfying |ω| < 1, and gain 0 elsewhere. Denoting the corresponding output
of the ﬁlter by y(t), determine its energy spectral density S yy (jω) — draw a careful and
fully labeled sketch! — and also compute the energy Ey of y(t).
(f) (3 points) Suppose another signal f (t) has deterministic autocorrelation function
� ∞
sin(2τ )
Rf f (τ ) =     f (t)f (t − τ ) dt = cos(10τ )          .
−∞                                   τ
Determine the magnitude of the Fourier transform of the signal, i.e., determine |F (jω)|.
(As before, a careful and fully labeled sketch will suﬃce as the answer.) Now determine
the value of                       � ∞
x(t)f (t − τ ) dt ,
−∞
where x(t) is the signal above. Explain your reasoning carefully.
5
Problem 3 (10 points)
The ﬁrst ﬁgure below shows our standard conﬁguration for DT processing of a CT signal
xc (t) to produce a CT signal yc (t). Here T as usual denotes the sampling and reconstruction
interval, and the D/C converter implements an ideal bandlimited interpolation. The second
ﬁgure displays the frequency response of the DT ﬁlter, which is an ideal lowpass ﬁlter.
xc (t)-            xd [n]-                yd [n]-            yc (t)
-
C/D                Hd (ejΩ )              D/C
6                                            6
T                                            T
H (ejΩ )
6 d
1
-
−π −π/2                 π/2    π        Ω
Suppose the CT input xc (t) is chosen to be
xc (t) = sin(2πf1 t) ,
where f1 = 1300 Hz.
(a) (1 point) What minimum value does the sampling frequency 1/T have to exceed in order
to avoid aliasing at the C/D converter, for this signal?
For each of the following parts, fully specify what the output yc (t) is for the indicated choice
of the sampling/reconstruction frequency 1/T .
(b) (3 points) 1/T = 8000 Hz.
(c) (3 points) 1/T = 4000 Hz.
(d) (3 points) 1/T = 1600 Hz.
6
Problem 4 (20 points)
Consider the following CT LTI state-space model:
�     �        � �
0 1           0
q̇(t) =         q(t) +     x(t)
6 1           1
y(t) = [ 1 1 ] q(t) .
(a) (3 points) Determine the natural frequencies (or eigenvalues) λ1 and λ2 of the system,
and the associated eigenvectors v1 and v2 respectively. (Compute these carefully, because
errors will propagate, and you will lose signiﬁcant points! You should check that what you
claim is an eigenvalue/eigenvector pair does indeed satisfy the deﬁning matrix equation
for such a pair.)
(b) (1 point) Is the system asymptotically stable?
(c) (3 points) Determine the transfer function H(s) of the system. What feature of this H(s)
tells you the system is reachable and observable?
(d) (4 points) When the initial state of the system is at zero, i.e., when q(0) = 0, and when
the input for t ≥ 0 is x(t) = 5e−t , the output y(t) of the system for t ≥ 0 is
y(t) = e3t − e−2t .
(You can use this fact as a check on some of your preceding answers!) What initial
condition q(0) would we need in order to have y(t) ≡ 0 for t ≥ 0, with this same input
x(t) = 5e−t for t ≥ 0.
(e) (3 points) Suppose we implement a state feedback control of the form
x(t) = gT q(t) + p(t)
on the given system, where the feedback gain vector is gT = [g1 g2 ], and p(t) is some
new external input. Write down the resulting state-space model, with input p(t), state
vector q(t), and output y(t). You need to show the model in detail, making explicit the
entries of all matrices and vectors involved in the state evolution equation and the output
equation.
(f) (4 points) For your closed-loop system in (e), determine what choice of g1 and g2 will
result in a closed-loop characteristic polynomial of
ν(s) = s2 + 3s + 2 .
Is the resulting system observable? Be sure to show your reasoning.
(g) (2 points) With the state feedback gains picked as in (f), suppose p(t) in the closed-
loop system is kept constant at the value p = 6 for all time. What is the corresponding
equilibrium value q of the state vector q(t)?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : H(ejΩ ) = exp{−j(60Ω + 25Ω3 )} for |Ω| < π. In this frequency range,
1(a) (1 point) the magnitude |H(ejΩ )| is:
1
1(b) (1 point) the phase ∠H(ejΩ ) is:
−(60Ω + 25Ω3 )
1(c) (1 point) the group delay τg (Ω) is:
... the negative of the slope of the phase with respect to Ω, therefore 60 + 75Ω2 .
This is 60 samples at Ω = 0 and rises to around 800 samples at Ω = π.
1(d) (2 points) The impulse response h[n] of this ﬁlter is given by the plot in (choose A or B
or C or D or E):
C
Two diﬀerent features of this response that support choosing it as h[n] are:
The bulk of the response starts around time 60, with the lowest frequencies
emerging ﬁrst, and increasingly higher frequencies emerging later, which is consis­
tent with the group delay characteristic. None of the other waveforms has these
features.
Problem 2 (15 points)
The deterministic autocorrelation function of x(t) is
� ∞
sin(2τ )
Rxx (τ ) =     x(t)x(t − τ ) dt = 9          .
−∞                        πτ
2(a) (3 points) The energy spectral density S xx (jω) of this signal is given by the following —
careful and fully labeled! — sketch:
What we want is the Fourier transform of the deterministic autocorrelation
function, which is S xx (jω) = 9 for |ω| < 2, and 0 elsewhere. (You can draw the
ﬁgure!)
2
�∞   2
The energy of the signal, Ex =      −∞ x (t) dt , is:
� ∞
1                           18
Ex = Rxx (0) =             S xx (jω) dω =      .
2π     −∞                    π
The time-domain and frequency-domain expressions yield the same result.
2(b) (2 points) The magnitude of the Fourier transform of x(t), i.e., |X(jω)|, is given by the
following — careful and fully labeled! — sketch (be sure to explain your answer):
We know S xx (jω) = |X(jω)|2 , so |X(jω)| = 3 for |ω| < 2, and 0 elsewhere. (You
can draw the ﬁgure!)
2(c) (2 points) One possible signal x(t) that has the speciﬁed deterministic autocorrelation
function Rxx (τ ) is:
Assuming a signal that has zero phase, i.e., ∠X(jω) = 0, we have that X(jω) =
|X(jω)|, so an appropriate signal would be
sin(2t)
x(t) = 3           .
πt
2(d) (2 points) The relation – in either the time domain or the frequency domain – between
any other (correct but otherwise arbitrary) answer to 2(c) and the speciﬁc one you gave
in 2(c):
A solution can have an arbitrary phase characteristic (as long as the phase is
an odd function of ω). All solutions have the same magnitude characteristic,
determined as in 2(b). Stated another way, one solution can be obtained from
another by all-pass ﬁltering.
2(e) (3 points) The x(t) above is the input to an ideal lowpass ﬁlter that has gain 1 for
frequencies ω satisfying |ω| < 1, and gain 0 elsewhere. The corresponding output of the
ﬁlter is y(t), with energy spectral density S yy (jω) given by the following — careful and
fully labeled! — sketch (be sure to explain your answer):
We know
S yy (jω) = |H(jω)|2 S xx (jω)
3
where H(jω) is the frequency response of the lowpass ﬁlter, so S yy (jω) = 9 for
|ω| < 1, and 0 elsewhere. The energy of y(t) is thus
� ∞
1                   9
Ey =        S yy (jω) dω = .
2π −∞                π
2(f) (3 points) Suppose another signal f (t) has deterministic autocorrelation function
� ∞
sin(2τ )
Rf f (τ ) =     f (t)f (t − τ ) dt = cos(10τ )          .
−∞                                   τ
The magnitude of the Fourier transform of the signal, i.e., |F (jω)|, is derived below, and
given by the following — careful and fully labeled! — sketch:
Taking the Fourier transform of the given deterministic autocorrelation func­
tion,
√      we ﬁnd S f f (jω) = 0.5π for 8 < |ω| < 12, and 0 elsewhere. Thus |F (jω)| =
0.5π for 8 < |ω| < 12, and 0 elsewhere. (You can draw the ﬁgure!)
�∞
We know the deterministic correlation −∞ x(t)f (t − τ ) dt has Fourier transform
X(jω)F ∗ (jω). But since the |X(jω)| is 0 where |F (jω)| is nonzero, this product
of transforms is 0, hence the deterministic correlation of these two signals is
0.
Problem 3 (10 points)
Note xc (t) = sin(2πf1 t), with f1 = 1300 Hz.
3(a) (1 point) The minimum value that the sampling frequency 1/T has to exceed, in order to
avoid aliasing at the C/D converter:
This is the Nyquist frequency, namely twice the highest frequency in the
signal, hence 2600 Hz.
For each of the following parts, fully specify what the output yc (t) is for the indicated
choice of the sampling/reconstruction frequency 1/T . Show how you obtain your answers!
In the absence of aliasing, the ﬁlter behaves as a CT ﬁlter whose frequency
response is obtained by the substitution Ω = ωT in the DT ﬁlter characteristic,
i.e., as an ideal lowpass ﬁlter with unit gain and cut-oﬀ determined as fc =
Ωc /(2πT ) = 1/(4T ) Hz.
4
3(b) (3 points) When 1/T = 8000 Hz, the output yc (t) is:
For this sampling frequency, there is no aliasing, and the eﬀective ﬁlter cut­
oﬀ frequency is 2000 Hz, which allows the input to go through intact. Hence
yc (t) = xc (t) = sin(2600πt).
3(c) (3 points) When 1/T = 4000 Hz, the output yc (t) is:
For this sampling frequency, there is no aliasing, and the eﬀective ﬁlter cut-oﬀ
frequency is 1000 Hz, which blocks the input. Hence yc (t) = 0.
3(d) (3 points) When 1/T = 1600 Hz, the output yc (t) is:
For this sampling frequency of 1600 Hz, aliasing does occur, so we need to
work more carefully. The principal frequency band is [-800 Hz, 800 Hz] and
the ﬁlter cut-oﬀ frequency is 400 Hz. The 1300 Hz input component is outside
these. However, the lower sideband of the alias centered at the sampling
frequency of 1600 Hz appears at a frequency that is 1300 Hz lower than 1600
Hz, i.e., appears at positive frequency 300 Hz, therefore as an upper sideband
in the principal frequency range, and within the passband of the ﬁlter. The
output will therefore be yc (t) = − sin(2π300t) = − sin(600πt).
Alternatively, note that for this input the DT signal xd [n] is given by
sin(2π1300nT ) = sin(2π1300n/1600) = sin ((2πn) − (2π300n/1600)) = − sin(2π300n/1600)
which is precisely what one would get from an input signal of − sin(2π300t).
The latter signal does lie in the principal frequency band and in the passband
of the eﬀective CT ﬁlter, thus yielding an output yc (t) = − sin(2π300t) .
Problem 4 (20 points)
�         �            �       �
0 1                    0
q̇(t) =                 q(t) +               x(t)
6 1                    1
y(t) = [ 1 1 ] q(t) .
4(a) (3 points) The eigenvalues and associated eigenvectors are:
... determined by starting with the characteristic polynomial, which is
s(s − 1) − 6 = s2 − s − 6 = (s + 2)(s − 3) .
5
The roots of this are λ1 = −2 and λ2 = 3, which are the desired eigenvalues.
The corresponding eigenvectors are then directly obtained from the deﬁning
equation,
(λi I − A)vi = 0 .
Solving these, we get
�        �                           �       �
1                                   1
v1 =                ,           v2 =                    .
−2                                   3
4(b) (1 point) Is the system asymptotically stable? Explain your answer.
Because one eigenvalue is positive, the system is not asymptotically stable.
4(c) (3 points) The transfer function H(s) of the system is:
�                    �−1 �       �
s  −1                   0               s+1
H(s) = [ 1 1 ]                                         =                  .
−6 s − 1                 1           (s + 2)(s − 3)
What feature of this H(s) tells you the system is reachable and observable?
The fact that there are two poles in H(s), neither one canceled by the zero,
shows that this 2nd-order system has no hidden modes, i.e., is reachable and
observable.
4(d) (4 points) When the initial state of the system is at zero, i.e., when q(0) = 0, and when
the input for t ≥ 0 is x(t) = 5e−t , the output y(t) of the system for t ≥ 0 is
y(t) = e3t − e−2t .
(You can use this fact as a check on some of your preceding answers!) What initial
condition q(0) would we need in order to have y(t) ≡ 0 for t ≥ 0, with this same input
x(t) = 5e−t for t ≥ 0. Be sure to explain your reasoning!
We need cT q(t) for the ZIR to be the negative of the given output ZSR. So
with ZIR
q(t) = α1 v1 eλ1 t + α2 v2 eλ2 t
we need
α1 (cT v1 ) = 1 ,         and α2 (cT v2 ) = −1 ,
6
from which α1 = −1 and α2 = −1/4, so
�            �
5                −1
q(0) = −v1 − (1/4)v2 =                              .
4                1
4(e) (3 points) Suppose we implement a state feedback control of the form
x(t) = gT q(t) + p(t)
on the given system, where the feedback gain vector is gT = [g1 g2 ], and p(t) is some
new external input. Write down the resulting state-space model, with input p(t), state
vector q(t), and output y(t). You need to show the model in detail, making explicit the
entries of all matrices and vectors involved in the state evolution equation and the output
equation.
�                   �            �       �
0      1                       0
q̇(t) =                           q(t) +               p(t)
6 + g1 1 + g2                    1
y(t) = [ 1 1 ] q(t) .
4(f) (4 points) For your closed-loop system in (e), determine what choice of g1 and g2 will
result in a closed-loop characteristic polynomial of
ν(s) = s2 + 3s + 2 .
The closed-loop characteristic polynomial is
ν(s) = s(s − (1 + g2 )) − (6 + g1 ) = s2 − (1 + g2 )s − (6 + g1 ) .
Setting this equal to the desired polynomial speciﬁed above, we ﬁnd g1 = −8
and g2 = −4.
Is the resulting system observable? Be sure to show your reasoning.
We can write ν(s) = (s+1)(s+2), so the denominator of the closed-loop transfer
function has a factor due to the pole at −1 that cancels with the numerator
factor due to the (unchanged) zero of the open-loop transfer function at −1.
Since state feedback cannot modify reachability, the cause of this hidden mode
must be a loss of observability.
Alternatively, we could compute the closed-loop eigenvectors and then test
observability in the usual way.
7
4(g) (2 points) With the state feedback gains picked as in (f), suppose p(t) in the closed-
loop system is kept constant at the value p = 6 for all time. What is the corresponding
equilibrium value q of the state vector q(t)?
Setting q̇(t) = 0 in the closed-loop system of 4(e), with the gains picked as in
4(f ) and with p(t) = p = 6, we ﬁnd
� �
3
q=      .', 'source' => 'MIT OpenCourseWare, 6.011 Introduction To Communication Control And Signal Processing, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 6.011 — question d’examen, en anglais] For each of the following statements, specify whether the statement is true or false and give a brief (at most a few lines) justiﬁcation or counterexample. (1a) (1.5 points) If X and Y are independent random variables, the unconstrained MMSE estimator Y� of Y given X = x is Y� = µY . (1b) (1.5 points) The following random process is strict sense stationary: x(t) = A where A is a continuous random variable with a pdf uniform between ±1. (1c) (1.5 points) The following random process is ergodic in the mean: x(t) = A where A is a continuous random variable with a pdf uniform between ±1. (1d) (1.5 points) If the input to a stable LTI system is WSS then the output is guaranteed to be WSS. 2
For each of the following statements, specify whether the statement is true or false and
give a brief (at most a few lines) justiﬁcation or counterexample.
(1a) (1.5 points) If X and Y are independent random variables, the unconstrained MMSE
estimator Y� of Y given X = x is Y� = µY .
(1b) (1.5 points) The following random process is strict sense stationary: x(t) = A where A is
a continuous random variable with a pdf uniform between ±1.
(1c) (1.5 points) The following random process is ergodic in the mean: x(t) = A where A is a
continuous random variable with a pdf uniform between ±1.
(1d) (1.5 points) If the input to a stable LTI system is WSS then the output is guaranteed to
be WSS.
2
Problem 2 (15 points)
Suppose x(t) and v(t) are two independent WSS random processes with autocorrelation
functions respectively Rxx (τ ) and Rvv (τ ).
(2a) (3 points) Using x(t) and v(t), show how you would construct a random process g(t) whose
autocorrelation function Rgg (τ ) is that shown in Eq. (2.1). Be sure to demonstrate
that the resulting process g(t) has the desired autocorrelation function.
Rgg (τ ) = Rxx (τ )Rvv (τ )                           (2.1)
For the remainder of this problem assume that Rxx (τ ) and Rvv (τ ) are known to be
Rxx (τ ) = 2e−|τ |         Rvv (τ ) = e−3|τ |                    (2.2)
You can also invoke the Fourier transform identity
2β
e−β|τ | ⇐⇒                                             (2.3)
β 2 + ω2
(2b) (6 points) Let w(t) denote a third WSS random process with autocorrelation function
Rww (τ ) = δ(τ ). Suppose w(t) is the input to a ﬁrst-order, stable, causal LTI system for
which the linear constant coeﬃcient diﬀerential equation is
dx(t)
+ ax(t) = bw(t)                                (2.4)
dt
Determine the values of a and b so that the autocorrelation of the output x(t) is Rxx (τ )
as given in Eq. (2.2).
(2c) (6 points) Is it possible to have a WSS process z(t) whose autocorrelation function
Rzz (τ ) = Rxx (τ ) ∗ Rvv (τ ), i.e., Rzz (τ ) is the result of convolving the autocorrelation
functions Rxx (τ ) and Rvv (τ ) given in Eq. (2.2)? If no, why not? If yes, show how to gen­
erate z(t) starting from a WSS process w(t) with autocorrelation function Rww (τ ) = δ(τ )
(you can perform any necessary causal LTI ﬁltering operations).
3
Problem 3 (15 points)
A DT wide-sense stationary random process s[n] has zero mean and the autocovariance
function Css [m] shown in Figure 3.1. Css [m] = 0 for |m| ≥ 5.
15
14
13
12
11
10
9
8
Css[m]
7
6
5
4
3
2
1
0
−1
−2
−3
−4
−4   −3    −2   −1   0    1   2    3      4
m
Figure 3.1
The process s[n] is transmitted through a communication channel that introduces noise and
a one-step delay. The received process r[n] is related to s[n] as indicated by Eq. (3.1). The
noise process w[n] has zero mean, autocovariance function Cww [m] = 3δ[m]. Furthermore, the
noise process w[·] is uncorrelated with the process s[·].
r[n] = s[n − 1] + w[n]                      (3.1)
We wish to design an estimator s�[n] for s[n]. Throughout this problem the objective is to
choose the parameters in the estimator to minimize the mean squared error E deﬁned as
E � E{(s[n] − s�[n])2 }
(3a) (2 points) Express the covariance functions Crs [m] and Crr [m] in terms of the given
autocovariance functions Css [m] and Cww [m]?
(3b) (3 points) If the estimator is restricted to be of the form
s�[n] = a0 r[n] + a1 r[n − 1]
will E be minimized with the parameter values a0 = 0 and a1 = 5?
4
(3c) (5 points) If the estimator is restricted to be of the form
s�[n] = a2 r[n]
determine the value of a2 that minimizes E.
(3d) (5 points) If the estimator is of the form
1
s�[n] =       r[n − no ]
2
with no ≥ 0, determine the value of no that minimizes E.
5
Problem 4 (14 points)
Note: Nothing on this problem assumes or requires that you attended today’s
lecture.
���������
�����                                             ����
��
��                                    �����������������                   �����������������
�����        ��             ��                                    �����   ����
��
��          ��
��
�����
�����
Figure 4.1
D/A converters utilizing oversampled noise shaping often use the structure in Figure 4.1 to
quantize the output sequence to a 1-bit bitstream for which D/A conversion is then very simple.
Its eﬀectiveness assumes that x[n] is highly oversampled and that most of the error introduced
by the quantizer falls outside the signal band.
In Figure 4.1 the quantizer error is modeled as an additive, zero mean i.i.d sequence e[n]
that is uniformly distributed in amplitude between ± △  2 at each time instant n. Furthermore,
e[n] and x[n] are assumed to be independent. The input x[n] has mean µx = 0 and variance
σx2 = 1. Moreover, the input x[n] is bandlimited, i.e., the power spectral density Sxx (ejΩ ) is
zero for π2 < |Ω| < π.
The output y[n] is composed of two components: yx [n] due solely to x[n], and ye [n] due
solely to e[n]. Similarly, w[n] = wx [n] + we [n]. Note that the transfer function from x[n] to
6
yx [n] is unity, and the transfer function from e[n] to ye [n] is (1 − az −1 ).
(4a) (7 points) Determine the power spectral density of ye [n] as a function of Ω for |Ω| < π.
(4b) (7 points) Determine E{wx2 [n]}, E{we2 [n]}, and the value of the gain constant “a” that
maximizes the signal-to-noise ratio (SN R) of w[n] deﬁned as
E{wx2 [n]}
SN R =
E{we2 [n]}', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : For each of the following statements, specify whether the statement is true or false and
give a brief (at most a few lines) justiﬁcation or counterexample.
(1a) (1.5 points) If X and Y are independent random variables, the unconstrained MMSE
estimator Y� of Y given X = x is Y� = µY .
�
True: The unconstrained MMSE estimator takes the form E[Y |X] = yfY |X dy.�Since Y
and X are independent, we know that fY |X = fY . This implies E[Y |X] = µY = yfY dy.
(1b) (1.5 points) The following random process is strict sense stationary: x(t) = A where A is
a continuous random variable with a pdf uniform between ±1.
True: Intuitively, you can conclude that the process x(t) is strict sense stationary because
there is no way to tell where on the time axis you are by looking at any set of samples, no
matter at what times they are taken. Mathematically, this intuition is captured by saying
that PDF’s of all orders are shift invariant, or fx(t1 ),x(t2 ),...,x(tN ) = fx(t1 +τ ),x( t2 +τ ),...,x(tN +τ )
for all N and τ .
(1c) (1.5 points) The following random process is ergodic in the mean: x(t) = A where A is a
continuous random variable with a pdf uniform between ±1.
False: The process is not ergodic in the mean because the ensemble mean does not equal
the time-average of a realization of the process x(t). The ensemble mean of the process
x(t) is 0. The time-average of a realization of the process x(t) is the particular value of
A obtained in that realization
2
(1d) (1.5 points) If the input to a stable LTI system is WSS then the output is guaranteed to
be WSS.
True: If a WSS process x(t) with mean µx and autocorrelation function Rxx (τ ) is the
input to a stable LTI system with frequency response H(jω), then the output process has
←−
mean µy = H(j0)µx and autocorrelation function Ryy (τ ) = h ∗ h ∗ Rxx (τ ). Since the
output process has a constant mean and autocorrelation function that depends only on
the lag τ , the process y(t) is also WSS.
3
Problem 2 (15 points)
Suppose x(t) and v(t) are two independent WSS random processes with autocorrelation
functions respectively Rxx (τ ) and Rvv (τ ).
(2a) (3 points) Using x(t) and v(t), show how you would construct a random process g(t) whose
autocorrelation function Rgg (τ ) is that shown in Eq. (2.1). Be sure to demonstrate
that the resulting process g(t) has the desired autocorrelation function.
Rgg (τ ) = Rxx (τ )Rvv (τ )                           (2.1)
Solution: Choose g(t) = x(t)v(t). For this choice the autocorrelation function of g(t) is
Rgg (τ ) = E[x(t + τ )v(t + τ )x(t)v(t)]
= E[x(t + τ )x(t)]E[v(t + τ )v(t)]
= Rxx (τ )Rvv (τ )
4
For the remainder of this problem assume that Rxx (τ ) and Rvv (τ ) are known to be
Rxx (τ ) = 2e−|τ |         Rvv (τ ) = e−3|τ |                 (2.2)
You can also invoke the Fourier transform identity
2β
e−β|τ | ⇐⇒                                          (2.3)
β 2 + ω2
(2b) (6 points) Let w(t) denote a third WSS random process with autocorrelation function
Rww (τ ) = δ(τ ). Suppose w(t) is the input to a ﬁrst-order, stable, causal LTI system for
which the linear constant coeﬃcient diﬀerential equation is
dx(t)
+ ax(t) = bw(t)                             (2.4)
dt
Determine the values of a and b so that the autocorrelation of the output x(t) is Rxx (τ )
as given in Eq. (2.2).
Solution: The transfer function H(s) representing this linear, constant coeﬃcient diﬀer­
ential equation is given by
b
H(s) =
s+a
The PSD (function of jω) and complex PSD (function of s) of the output process x(t) are
4
Sxx (jω) =
1 + ω2
4
Sxx (s) =
(1 + s)(1 − s)
We know that the complex PSDs of the input process w(t) and the output process x(t)
are related as follows:
Sxx (s) = H(s)H(−s)Sww (s)
Since the complex PSD of the input process w(t) is Sww (s) = 1, we can write
5
Sxx (s) = H(s)H(−s)
4                 b2
=
(1 + s)(1 − s)    (a + s)(a − s)
From the above we recognize that b = ±2 and a = 1.
6
(2c) (6 points) Is it possible to have a WSS process z(t) whose autocorrelation function
Rzz (τ ) = Rxx (τ ) ∗ Rvv (τ ), i.e., Rzz (τ ) is the result of convolving the autocorrelation
functions Rxx (τ ) and Rvv (τ ) given in Eq. (2.2)? If no, why not? If yes, show how to gen­
erate z(t) starting from a WSS process w(t) with autocorrelation function Rww (τ ) = δ(τ )
(you can perform any necessary causal LTI ﬁltering operations).
Solution: We would like to form a process z(t) whose autocorrelation function and PSD
are
Rzz (τ ) = Rxx (τ ) ∗ Rvv (τ )
Szz (jω) = Sxx (jω)Svv (jω)
Suppose we ﬁlter the process w(t) through a causal, LTI ﬁlter with frequency response
H(jω). Then we will obtain the following relation between the Sww and Szz
Szz (jω) = |H(jω)|2 Sww (jω)
Szz (s) = H(s)H(−s)Sww (s)
Since the complex PSD of the input process w(t) is Sww (s) = 1, we can write
Szz (s) = H(s)H(−s)
Sxx (s)Svv (s) = H(s)H(−s)
2               6
= H(s)H(−s)
(1 + s)(1 − s) (3 + s)(3 − s)
Associating with H(s) the poles in the left half plane we obtain
√
2 3
H(s) =
(1 + s)(3 + s)
7
Problem 3 (15 points)
A DT wide-sense stationary random process s[n] has zero mean and the autocovariance
function Css [m] shown in Figure 3.1. Css [m] = 0 for |m| ≥ 5.
15
14
13
12
11
10
9
8
Css[m]
7
6
5
4
3
2
1
0
−1
−2
−3
−4
−4   −3   −2   −1   0   1   2   3   4
m
Figure 3.1
The process s[n] is transmitted through a communication channel that introduces noise and
a one-step delay. The received process r[n] is related to s[n] as indicated by Eq. (3.1). The
noise process w[n] has zero mean, autocovariance function Cww [m] = 3δ[m]. Furthermore, the
noise process w[·] is uncorrelated with the process s[·].
r[n] = s[n − 1] + w[n]                       (3.1)
We wish to design an estimator s�[n] for s[n]. Throughout this problem the objective is to
choose the parameters in the estimator to minimize the mean squared error E deﬁned as
E � E{(s[n] − s�[n])2 }
8
(3a) (2 points) Express the covariance functions Crs [m] and Crr [m] in terms of the given
autocovariance functions Css [m] and Cww [m]?
Solution: Since both s[n] and w[n] are zero mean, auto and cross covariance functions
will equal auto and cross correlation functions.
Crs [m] = Rrs [m]
= E[r[n + m]s[n]]
= E[(s[n + m − 1] + w[n + m])s[n]]
= Rss [m − 1]
= Css [m − 1]
Crr [m] = Rrr [m]
= E[r(n + m)r(n)]
= E[(s[n + m − 1] + w[n + m])(s[n − 1] + w[n])]
= Rss [m] + Rww [m]
= Css [m] + Cww [m]
9
(3b) (3 points) If the estimator is restricted to be of the form
s�[n] = a0 r[n] + a1 r[n − 1]
will E be minimized with the parameter values a0 = 0 and a1 = 5?
Circle: Yes/No
Clearly show how you arrived at your conclusion.
Solution: No. If s�[n] minimizes E, then the estimation error must be orthogonal to both
the data samples r[n] and r[n − 1]. We will show that orthogonality is not satisﬁed for
the choice a0 = 0 and a1 = 5.
E[(s[n] − s�[n])r[n]]
E[(s[n] − a0 r[n] − a1 r[n − 1])r[n]]
E[(s[n] − a1 r[n − 1])r[n]]
Rsr [0] − a1 Rrr [1]
−4 − 5(−4) =
6 0
Alternatively, note that if a0 = 0 in the minimum, then a1 must be the coeﬃcient that
minimizes the MSE when we use an estimator of the form s�[n] = a1 r[n − 1], but then we
would need
Csr [1]   Css [−2]   5
a1 =           =          =
Crr [0]    Crr [0]   18
10
(3c) (5 points) If the estimator is restricted to be of the form
� = a2 r[n]
s[n]
determine the value of a2 that minimizes E.
Solution: The value of a2 that minimizes E is given by
Csr [0]
a2 =
Crr [0]
Rsr [0]       −2
=                      =
Rss [0] + Rww [0]   9
11
(3d) (5 points) If the estimator is of the form
1
� =
s[n]        r[n − no ]
2
with no ≥ 0, determine the value of no that minimizes E.
Solution: Express the estimation error E in terms of no
1
E   = E[(s[n] − r[n − no ])2 ]
2
1
= E[s2 [n] − s[n]r[n − no ] + r[n − no ]2 ]
4
1
= Rss [0] − Rsr [no ] + Rrr [0]
4
1
= Rss [0] − Rrs [−no ] + Rrr [0]
4
1
= Rss [0] − Rss [n0 + 1] + Rrr [0]
4
To minimize E, we need to choose no so that Rss [n0 + 1] is as large as possible and no ≥ 0.
Looking at Figure 3.1, we see that n0 = 3 minimizes E while satisfying the constraint
no ≥ 0.
Note that the choice of no = 3 minimizes E, but does not result in an estimation error
that is orthogonal to r[n − 3]. The reason we lost orthogonality is because s�[n] = 21 r[n − 3]
is not the LMMSE estimator of s[n] given r[n − 3]. The LMMSE estimator of s[n] given
Csr [3]
r[n − 3] is s�[n] = Crr [0]
r[n − 3] = 13 r[n − 3].
12
Problem 4 (14 points)
Note: Nothing on this problem assumes or requires that you attended today’s
lecture.
���������
�����                                             ����
��
��                                     �����������������                   �����������������
�����      ��              ��                                    �����   ����
��
��          ��
��
�����
�����
Figure 4.1
D/A converters utilizing oversampled noise shaping often use the structure in Figure 4.1 to
quantize the output sequence to a 1-bit bitstream for which D/A conversion is then very simple.
Its eﬀectiveness assumes that x[n] is highly oversampled and that most of the error introduced
by the quantizer falls outside the signal band.
In Figure 4.1 the quantizer error is modeled as an additive, zero mean i.i.d sequence e[n]
that is uniformly distributed in amplitude between ± △  2 at each time instant n. Furthermore,
e[n] and x[n] are assumed to be independent. The input x[n] has mean µx = 0 and variance
σx2 = 1. Moreover, the input x[n] is bandlimited, i.e., the power spectral density Sxx (ejΩ ) is
zero for π2 < |Ω| < π.
The output y[n] is composed of two components: yx [n] due solely to x[n], and ye [n] due
solely to e[n]. Similarly, w[n] = wx [n] + we [n]. Note that the transfer function from x[n] to
13
yx [n] is unity, and the transfer function from e[n] to ye [n] is (1 − az −1 ).
(4a) (7 points) Determine the power spectral density of ye [n] as a function of Ω for |Ω| < π.
Solution: We know that the PSD of e[n] and the PDS of ye [n] are related as follows
Sye ye (ejΩ ) = Hye (ejΩ )Hye (e−jΩ )See (ejΩ )
Substituting Hye (ejΩ ) = (1 − ae−jΩ ) we get
Sye ye (ejΩ ) = (1 − ae−jΩ )(1 − aejΩ )See (ejΩ )
△2
Sye ye (ejΩ ) = (1 + a2 − 2a cos(Ω))
12
14
(4b) (7 points) Determine E{wx2 [n]}, E{we2 [n]}, and the value of the gain constant “a” that
maximizes the signal-to-noise ratio (SN R) of w[n] deﬁned as
E{wx2 [n]}
SN R =
E{we2 [n]}
Solution:
� π
1
E{wx2 [n]}   =           Sw w (ejΩ ) dΩ
2π −π x x
� π
1      �            �
=           �HLP F (ejΩ )�2 Syx yx (ejΩ ) dΩ
2π −π
� π
1    2
=           Sy y (ejΩ ) dΩ
2π −π x x
2
� π
1    2
=           Sxx (ejΩ ) dΩ
2π −π
2
=   σx2
= 1
� π
1
E{we2 [n]}   =             Sw w (ejΩ ) dΩ
2π −π e e
� π
1        �            �
=             �HLP F (ejΩ )�2 Sye ye (ejΩ ) dΩ
2π −π
� π
1     2
=             Sy y (ejΩ ) dΩ
2π −π e e
2
2 � π
△        2
=               1 + a2 − 2a cos(Ω) dΩ
24π    −π
2
△2 �               �
=       π(1 + a2 ) − 4a
24π
The SN R is given by
1
SN R = △2
2
24π (π(1 + a ) − 4a)
15
To maximize the SN R we select the gain constant a that minimizes the expression
π(1 + a2 ) − 4a. Diﬀerentiating with respect to a and setting the derivative equal to 0 re­
sults in a = π2 . We know the value of a = π2 minimizes the denominator because the second
derivative of π(1 + a2 ) − 4a is greater than zero for this choice of a.', 'source' => 'MIT OpenCourseWare, 6.011 Introduction To Communication Control And Signal Processing, Spring 2010 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
						),
					),
				),
			),
		);
	}
}
