<?php
/**
 * Questions importees — MIT OpenCourseWare — 6 003 signals and systems fall 2011
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_003_examens' ) ) {
	function seca_import_mit_ocw_6_003_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-003-examens', 'nom' => 'MIT OpenCourseWare — 6 003 signals and systems fall 2011', 'url' => 'https://ocw.mit.edu/courses/6-003-signals-and-systems-fall-2011/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'les-fondamentaux-du-reseau' => array(
					'title' => 'les-fondamentaux-du-reseau',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Fall 2011) Final Examination                                    December 19, 2011 Name: Kerberos Username: Please circle your section number: Section    Time 2       11 am 3       1 pm 4       2 pm Grades will be determined by the', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Z Transform                     [14 points]
Determine X(z), the Z transform of x[n], where
∞
c
x[n] =              ak δ[n − 5k] = δ[n] + aδ[n − 5] + a2 δ[n − 10] + a3 δ[n − 15] + · · ·
k=0
is plotted below.
x[n]
n
Enter a closed-form expression for X(z) in the box below.
z5
X(z) =
z5 − a
∞
c                     ∞ c
c ∞
X (z ) =           x[n]z −n =              ak δ [n − 5k ]
n=−∞                 n=−∞ k=0
The δ [n − 5k ] function is 1 if n = 5k and zero otherwise.
∞
c                      1         z5
X (z ) =         ak z −5k =             =
1 − az −5   z5 − a
k=0
Final Examination / 6.003: Signals and Systems (Fall 2011)                           3', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('Pas ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). no calculators, computers, cell phones, music players, or other aids. 1               /14
z transform               [14 points]
determine x(z), the z transform of x[n], where
∞
0
x[n] =         ak δ[n − 5k] = δ[n] + aδ[n − 5] + a2 δ[n − 10] + a3 δ[n − 15] + · · ·
k=0
is plotted below.
x[n]
n
enter a closed-form expression for x(z) in the box below.
x(z) =
final examination / 6.003: signals and systems (fall 2011)                           3', 'L\'inverse de ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). no calculators, computers, cell phones, music players, or other aids. 1               /14
z transform               [14 points]
determine x(z), the z transform of x[n], where
∞
0
x[n] =         ak δ[n − 5k] = δ[n] + aδ[n − 5] + a2 δ[n − 10] + a3 δ[n − 15] + · · ·
k=0
is plotted below.
x[n]
n
enter a closed-form expression for x(z) in the box below.
x(z) =
final examination / 6.003: signals and systems (fall 2011)                           3', 'Impossible à déterminer', 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). No calculators, computers, cell phones, music players, or other aids. 1               /14
Z Transform               [14 points]
Determine X(z), the Z transform of x[n], where
∞
0
x[n] =         ak δ[n − 5k] = δ[n] + aδ[n − 5] + a2 δ[n − 10] + a3 δ[n − 15] + · · ·
k=0
is plotted below.
x[n]
n
Enter a closed-form expression for X(z) in the box below.
X(z) =
Final Examination / 6.003: Signals and Systems (Fall 2011)                           3'), 'correct' => 3, 'answer' => 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). No calculators, computers, cell phones, music players, or other aids. 1               /14
Z Transform               [14 points]
Determine X(z), the Z transform of x[n], where
∞
0
x[n] =         ak δ[n − 5k] = δ[n] + aδ[n − 5] + a2 δ[n − 10] + a3 δ[n − 15] + · · ·
k=0
is plotted below.
x[n]
n
Enter a closed-form expression for X(z) in the box below.
X(z) =
Final Examination / 6.003: Signals and Systems (Fall 2011)                           3', '_recupere_le' => '2026-11-04T19:55:22.622200+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Fall 2011) Final Examination                                    December 19, 2011 Name: Kerberos Username: Please circle your section number: Section    Time 2       11 am 3       1 pm 4       2 pm Grades will be determined by the', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : DT Stability                [14 points]
Determine the range of K for which the following discrete-time system is stable (and
causal).
W1                 W2
X           +       K            +                   +   Y
−
delay
10
range of K:                                          K > 4.5
W2 = W1 + 10RW2
Y = W2 + RW2
Y     1+R
=
W1   1 − 10R
1+R
Y     K 1−10R          K(1 + R)          K(z + 1)
=        1+R
=                  =
X   1 + K 1−10R   1 − 10R + K + KR   z − 10 + Kz + K
For stability, the pole must be inside the unit circle.
10 − K
−1 < z =          <1
1+K
K > 4.5
Final Examination / 6.003: Signals and Systems (Fall 2011)                               4', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). No calculators, computers, cell phones, music players, or other aids. 1               /14
DT Stability          [14 points]
Determine the range of K for which the following discrete-time system is stable (and
causal).
X     +       K        +                +         Y
−
delay
10
range of K:
Final Examination / 6.003: Signals and Systems (Fall 2011)                               4', 'L\'inverse de ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). no calculators, computers, cell phones, music players, or other aids. 1               /14
dt stability          [14 points]
determine the range of k for which the following discrete-time system is stable (and
causal).
x     +       k        +                +         y
−
delay
10
range of k:
final examination / 6.003: signals and systems (fall 2011)                               4', 'Impossible à déterminer', 'Pas ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). no calculators, computers, cell phones, music players, or other aids. 1               /14
dt stability          [14 points]
determine the range of k for which the following discrete-time system is stable (and
causal).
x     +       k        +                +         y
−
delay
10
range of k:
final examination / 6.003: signals and systems (fall 2011)                               4'), 'correct' => 0, 'answer' => 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). No calculators, computers, cell phones, music players, or other aids. 1               /14
DT Stability          [14 points]
Determine the range of K for which the following discrete-time system is stable (and
causal).
X     +       K        +                +         Y
−
delay
10
range of K:
Final Examination / 6.003: Signals and Systems (Fall 2011)                               4', '_recupere_le' => '2026-11-04T19:55:22.622557+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Fall 2011) Final Examination                                    December 19, 2011 Name: Kerberos Username: Please circle your section number: Section    Time 2       11 am 3       1 pm 4       2 pm Grades will be determined by the', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Harmonic Aliasing                 [12 points]
Let x(t) represent a periodic signal with the following harmonics:
harmonic number         frequency [kHz]
1                      11
2                      22
3                      33
4                      44
5                      55
6                      66
7                      77
Throughout this problem, frequencies (f ) are expressed in cycles per second (Hz), which
ω
are related to corresponding radian frequencies (ω) by f = 2π  .
The signal x(t) is multiplied by an inﬁnite train of impulses separated by 25 × 10−6
seconds, and the result is passed through an ideal lowpass ﬁlter with a cutoﬀ frequency
of 16 kHz.
x(t)       ×      LPF (16 kHz)            y(t)
t [µs]
0 25
The plot below shows the Fourier transform Y of the output signal, for frequencies
between 0 and 20 kHz. Write the number of the harmonic of x(t) that produced each
component of Y in the box above that component. If none of 1-7 could have produced
this frequency, enter X.
7   4           3                 1            6   5
Y
0                                      10                                     20
Frequency f [kHz]
Final Examination / 6.003: Signals and Systems (Fall 2011)                                          5', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). No calculators, computers, cell phones, music players, or other aids. 1               /14
Harmonic Aliasing               [12 points]
Let x(t) represent a periodic signal with the following harmonics:
harmonic number         frequency [kHz]
1                      11
2                      22
3                      33
4                      44
5                      55
6                      66
7                      77
Throughout this problem, frequencies (f ) are expressed in cycles per second (Hz), which
ω
are related to corresponding radian frequencies (ω) by f = 2π  .
The signal x(t) is multiplied by an inﬁnite train of impulses separated by 25 × 10−6
seconds, and the result is passed through an ideal lowpass ﬁlter with a cutoﬀ frequency
of 16 kHz.
x(t)     ×       LPF (16 kHz)        y(t)
t [µs]
0 25
The plot below shows the Fourier transform Y of the output signal, for frequencies
between 0 and 20 kHz. Write the number of the harmonic of x(t) that produced each
component of Y in the box above that component. If none of 1-7 could have produced
this frequency, enter X.
Y
0                                      10                                     20
Frequency f [kHz]
Final Examination / 6.003: Signals and Systems (Fall 2011)                                          5', 'Pas ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). no calculators, computers, cell phones, music players, or other aids. 1               /14
harmonic aliasing               [12 points]
let x(t) represent a periodic signal with the following harmonics:
harmonic number         frequency [khz]
1                      11
2                      22
3                      33
4                      44
5                      55
6                      66
7                      77
throughout this problem, frequencies (f ) are expressed in cycles per second (hz), which
ω
are related to corresponding radian frequencies (ω) by f = 2π  .
the signal x(t) is multiplied by an inﬁnite train of impulses separated by 25 × 10−6
seconds, and the result is passed through an ideal lowpass ﬁlter with a cutoﬀ frequency
of 16 khz.
x(t)     ×       lpf (16 khz)        y(t)
t [µs]
0 25
the plot below shows the fourier transform y of the output signal, for frequencies
between 0 and 20 khz. write the number of the harmonic of x(t) that produced each
component of y in the box above that component. if none of 1-7 could have produced
this frequency, enter x.
y
0                                      10                                     20
frequency f [khz]
final examination / 6.003: signals and systems (fall 2011)                                          5', 'Impossible à déterminer', 'L\'inverse de ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). no calculators, computers, cell phones, music players, or other aids. 1               /14
harmonic aliasing               [12 points]
let x(t) represent a periodic signal with the following harmonics:
harmonic number         frequency [khz]
1                      11
2                      22
3                      33
4                      44
5                      55
6                      66
7                      77
throughout this problem, frequencies (f ) are expressed in cycles per second (hz), which
ω
are related to corresponding radian frequencies (ω) by f = 2π  .
the signal x(t) is multiplied by an inﬁnite train of impulses separated by 25 × 10−6
seconds, and the result is passed through an ideal lowpass ﬁlter with a cutoﬀ frequency
of 16 khz.
x(t)     ×       lpf (16 khz)        y(t)
t [µs]
0 25
the plot below shows the fourier transform y of the output signal, for frequencies
between 0 and 20 khz. write the number of the harmonic of x(t) that produced each
component of y in the box above that component. if none of 1-7 could have produced
this frequency, enter x.
y
0                                      10                                     20
frequency f [khz]
final examination / 6.003: signals and systems (fall 2011)                                          5'), 'correct' => 0, 'answer' => 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). No calculators, computers, cell phones, music players, or other aids. 1               /14
Harmonic Aliasing               [12 points]
Let x(t) represent a periodic signal with the following harmonics:
harmonic number         frequency [kHz]
1                      11
2                      22
3                      33
4                      44
5                      55
6                      66
7                      77
Throughout this problem, frequencies (f ) are expressed in cycles per second (Hz), which
ω
are related to corresponding radian frequencies (ω) by f = 2π  .
The signal x(t) is multiplied by an inﬁnite train of impulses separated by 25 × 10−6
seconds, and the result is passed through an ideal lowpass ﬁlter with a cutoﬀ frequency
of 16 kHz.
x(t)     ×       LPF (16 kHz)        y(t)
t [µs]
0 25
The plot below shows the Fourier transform Y of the output signal, for frequencies
between 0 and 20 kHz. Write the number of the harmonic of x(t) that produced each
component of Y in the box above that component. If none of 1-7 could have produced
this frequency, enter X.
Y
0                                      10                                     20
Frequency f [kHz]
Final Examination / 6.003: Signals and Systems (Fall 2011)                                          5', '_recupere_le' => '2026-11-04T19:55:22.623231+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Fall 2011) Final Examination                                    December 19, 2011 Name: Kerberos Username: Please circle your section number: Section    Time 2       11 am 3       1 pm 4       2 pm Grades will be determined by the', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Feedback                                [16 points]
Y (s)
Let H(s) =                represent the system function of the following feedback system
X(s)
X(s)        +           K   G(s)          Y (s)
−
where G(s) represents a linear, time-invariant system. The frequency response of G(s)
is given by the following Bode plots (magnitude and frequency plotted on log scales).
0.1
|G(jω)| [log scale]
0.01
0.001
0.1           1       10      100           1000
π/2
∠G(jω) [linear scale]
0
−π/2
0.1       1         10        100           1000
Frequency ω (rad/s) [log scale]
Final Examination / 6.003: Signals and Systems (Fall 2011)                              6
Part a. Determine a closed-form expression for g(t), the impulse response of G(s).
g(t) =                                  (1 − 10t)e−10t u(t)
s          1      10
G(s) =           2
=       −
(s + 10)    s + 10 (s + 10)2
g(t) = (1 − 10t)e−10t u(t)
Final Examination / 6.003: Signals and Systems (Fall 2011)                                        7
Part b. Sketch straight-line approximations (Bode plots) for the magnitude (log scale)
and angle (linear scale) of H(jω) when K = 81.
Clearly label all important magnitudes, angles, and frequencies.
1
0.1
|H(jω)|
0.01
0.001
0.1          1              10              100           1000
π/2
∠H(jω)
0
−π/2
0.1          1              10              100           1000
Frequency ω (rad/s)
s
KG(s)       K (s+10) 2
H(s) =                 =          s
1 + KG(s)   1 + K (s+10) 2
Ks                   81s                    81s
=                          =                     =
s2 + 20s + 100 + Ks       s2 + 101s + 100       (s + 1)(s + 100)
Final Examination / 6.003: Signals and Systems (Fall 2011)                                                  8', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). No calculators, computers, cell phones, music players, or other aids. 1               /14
Feedback                                [16 points]
Y (s)
Let H(s) =                represent the system function of the following feedback system
X(s)
X(s)        +           K   G(s)          Y (s)
−
where G(s) represents a linear, time-invariant system. The frequency response of G(s)
is given by the following Bode plots (magnitude and frequency plotted on log scales).
0.1
|G(jω)| [log scale]
0.01
0.001
0.1           1       10      100           1000
π/2
∠G(jω) [linear scale]
0
−π/2
0.1       1         10        100           1000
Frequency ω (rad/s) [log scale]
Final Examination / 6.003: Signals and Systems (Fall 2011)                              6
Part a. Determine a closed-form expression for g(t), the impulse response of G(s).
g(t) =
Final Examination / 6.003: Signals and Systems (Fall 2011)                             7
Part b. Sketch straight-line approximations (Bode plots) for the magnitude (log scale)
and angle (linear scale) of H(jω) when K = 81.
Clearly label all important magnitudes, angles, and frequencies.
|H(jω)| [log scale]
0.1       1         10        100       1000
∠H(jω) [linear scale]
0.1       1         10        100       1000
Frequency ω (rad/s) [log scale]
Final Examination / 6.003: Signals and Systems (Fall 2011)                               8', 'Pas ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). no calculators, computers, cell phones, music players, or other aids. 1               /14
feedback                                [16 points]
y (s)
let h(s) =                represent the system function of the following feedback system
x(s)
x(s)        +           k   g(s)          y (s)
−
where g(s) represents a linear, time-invariant system. the frequency response of g(s)
is given by the following bode plots (magnitude and frequency plotted on log scales).
0.1
|g(jω)| [log scale]
0.01
0.001
0.1           1       10      100           1000
π/2
∠g(jω) [linear scale]
0
−π/2
0.1       1         10        100           1000
frequency ω (rad/s) [log scale]
final examination / 6.003: signals and systems (fall 2011)                              6
part a. determine a closed-form expression for g(t), the impulse response of g(s).
g(t) =
final examination / 6.003: signals and systems (fall 2011)                             7
part b. sketch straight-line approximations (bode plots) for the magnitude (log scale)
and angle (linear scale) of h(jω) when k = 81.
clearly label all important magnitudes, angles, and frequencies.
|h(jω)| [log scale]
0.1       1         10        100       1000
∠h(jω) [linear scale]
0.1       1         10        100       1000
frequency ω (rad/s) [log scale]
final examination / 6.003: signals and systems (fall 2011)                               8', 'L\'inverse de ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). no calculators, computers, cell phones, music players, or other aids. 1               /14
feedback                                [16 points]
y (s)
let h(s) =                represent the system function of the following feedback system
x(s)
x(s)        +           k   g(s)          y (s)
−
where g(s) represents a linear, time-invariant system. the frequency response of g(s)
is given by the following bode plots (magnitude and frequency plotted on log scales).
0.1
|g(jω)| [log scale]
0.01
0.001
0.1           1       10      100           1000
π/2
∠g(jω) [linear scale]
0
−π/2
0.1       1         10        100           1000
frequency ω (rad/s) [log scale]
final examination / 6.003: signals and systems (fall 2011)                              6
part a. determine a closed-form expression for g(t), the impulse response of g(s).
g(t) =
final examination / 6.003: signals and systems (fall 2011)                             7
part b. sketch straight-line approximations (bode plots) for the magnitude (log scale)
and angle (linear scale) of h(jω) when k = 81.
clearly label all important magnitudes, angles, and frequencies.
|h(jω)| [log scale]
0.1       1         10        100       1000
∠h(jω) [linear scale]
0.1       1         10        100       1000
frequency ω (rad/s) [log scale]
final examination / 6.003: signals and systems (fall 2011)                               8', 'Impossible à déterminer'), 'correct' => 0, 'answer' => 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). No calculators, computers, cell phones, music players, or other aids. 1               /14
Feedback                                [16 points]
Y (s)
Let H(s) =                represent the system function of the following feedback system
X(s)
X(s)        +           K   G(s)          Y (s)
−
where G(s) represents a linear, time-invariant system. The frequency response of G(s)
is given by the following Bode plots (magnitude and frequency plotted on log scales).
0.1
|G(jω)| [log scale]
0.01
0.001
0.1           1       10      100           1000
π/2
∠G(jω) [linear scale]
0
−π/2
0.1       1         10        100           1000
Frequency ω (rad/s) [log scale]
Final Examination / 6.003: Signals and Systems (Fall 2011)                              6
Part a. Determine a closed-form expression for g(t), the impulse response of G(s).
g(t) =
Final Examination / 6.003: Signals and Systems (Fall 2011)                             7
Part b. Sketch straight-line approximations (Bode plots) for the magnitude (log scale)
and angle (linear scale) of H(jω) when K = 81.
Clearly label all important magnitudes, angles, and frequencies.
|H(jω)| [log scale]
0.1       1         10        100       1000
∠H(jω) [linear scale]
0.1       1         10        100       1000
Frequency ω (rad/s) [log scale]
Final Examination / 6.003: Signals and Systems (Fall 2011)                               8', '_recupere_le' => '2026-11-04T19:55:22.623997+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Fall 2011) Final Examination                                    December 19, 2011 Name: Kerberos Username: Please circle your section number: Section    Time 2       11 am 3       1 pm 4       2 pm Grades will be determined by the', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Triple reconstruction                    [16 points]
A CT signal x(t) is sampled to produce a DT signal y[n] = x(3n). The Fourier transform
of x(t) is given below.
X(jω)
1
ω
π π
− 12 12
We wish to compare two methods of using y[n] to reconstruct approximations to x(t).
Part a. Let w1 (t) represent a signal in which each sample of y[n] is replaced by an
impulse of area y[n] located at t = 3n. Thus w1 (t) has the following form
y[0]
y[1]
y[2]
t
0                  3                   6
which can be represented mathematically as
∞
c
w1 (t) =      y[n] δ(t − 3n) .
n=−∞
Sketch the Fourier transform of w1 (t) on the axes below.
Label all important features.
W1 (jω)
1
3
ω
π π
− 2π
3
− 12 12
2π
3
Since y[n] = x(3n), w1 (t) is equal to x(t) times and inﬁnite train of unit impulses separated by
T = 3 seconds:
∞
c                      c∞                      ∞
c
w1 (t) =     y[n]δ(t − 3n) =         x(3n)δ(t − 3n) =        x(t)δ(t − 3n)
n=−∞                   n=−∞                       n=−∞
where the last step follows from the fact that δ(t − 3n) is zero except at t = 3n. Multiplication in
time by an impulse train corresponds to convolution in frequency
W1 (jω) = X(jω) ∗ P (jω)
where P (jω) represents an inﬁnite train of impulses, each of weight 2π/3, and separated by ω =
2π/3. (i.e., the Fourier transform of an inﬁnite train of impulses spaced at T = 3 seconds). Thus
the frequency content of X(jω) is periodically replicated in frequency, spaced at Δω = 2π/3.
Final Examination / 6.003: Signals and Systems (Fall 2011)                                        9
Part b. Let w2 (t) represent a signal in which each sample of y[n] is replaced by three
impulses (one at t = 3n − 1, one at t = 3n, and one at t = 3n + 1), each with area y[n]/3.
Thus w2 (t) has the following form
y[0] y[0] y[0] y[1] y[1] y[1]
3    3    3    3    3    3 y[2] y[2] y[2]
3   3    3
t
0                   3                6
which can be represented mathematically as
∞
1 c
w2 (t) =        y[n] δ(t−3n−1) + δ(t−3n) + δ(t−3n+1) .
3 n=−∞
Sketch the Fourier transform of w2 (t) on the axes below.
Label all important frequencies as well as the value of W2 (jω) at ω = 0.
W2 (jω)
1
3
ω
π π
− 2π
3
− 12 12
2π
3
The signal w2 (t) can be derived by convolving w1 (t) with a signal
1           1      1
s(t) =     δ(t − 1) + δ(t) + δ(t + 1) .
3           3      3
Thus W2 (jω) can be determined by multiplying W1 (jω) by the Fourier transform of s(t)
1 −jω 1 1 jω 1 2
S(jω) =      e  + + e = + cos ω
3     3 3    3 3
which is shown in red above.
Final Examination / 6.003: Signals and Systems (Fall 2011)                          10', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('Impossible à déterminer', 'Pas ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). no calculators, computers, cell phones, music players, or other aids. 1               /14
triple reconstruction                      [16 points]
a ct signal x(t) is sampled to produce a dt signal y[n] = x(3n). the fourier transform
of x(t) is given below.
x(jω)
1
ω
π π
− 12 12
we wish to compare two methods of using y[n] to reconstruct approximations to x(t).
part a. let w1 (t) represent a signal in which each sample of y[n] is replaced by an
impulse of area y[n] located at t = 3n. thus w1 (t) has the following form
y[0]
y[1]
y[2]
t
0                     3              6
which can be represented mathematically as
∞
0
w1 (t) =          y[n] δ(t − 3n) .
n=−∞
sketch the fourier transform of w1 (t) on the axes below.
label all important features.
w1 (jω)
ω
final examination / 6.003: signals and systems (fall 2011)                                   9
part b. let w2 (t) represent a signal in which each sample of y[n] is replaced by three
impulses (one at t = 3n − 1, one at t = 3n, and one at t = 3n + 1), each with area y[n]/3.
thus w2 (t) has the following form
y[0] y[0] y[0] y[1] y[1] y[1]
3    3    3    3    3    3 y[2] y[2] y[2]
3   3    3
t
0               3               6
which can be represented mathematically as
∞
1 0
w2 (t) =        y[n] δ(t−3n−1) + δ(t−3n) + δ(t−3n+1) .
3 n=−∞
sketch the fourier transform of w2 (t) on the axes below.
label all important frequencies as well as the value of w2 (jω) at ω = 0.
w2 (jω)
ω
final examination / 6.003: signals and systems (fall 2011)                          10', 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). No calculators, computers, cell phones, music players, or other aids. 1               /14
Triple reconstruction                      [16 points]
A CT signal x(t) is sampled to produce a DT signal y[n] = x(3n). The Fourier transform
of x(t) is given below.
X(jω)
1
ω
π π
− 12 12
We wish to compare two methods of using y[n] to reconstruct approximations to x(t).
Part a. Let w1 (t) represent a signal in which each sample of y[n] is replaced by an
impulse of area y[n] located at t = 3n. Thus w1 (t) has the following form
y[0]
y[1]
y[2]
t
0                     3              6
which can be represented mathematically as
∞
0
w1 (t) =          y[n] δ(t − 3n) .
n=−∞
Sketch the Fourier transform of w1 (t) on the axes below.
Label all important features.
W1 (jω)
ω
Final Examination / 6.003: Signals and Systems (Fall 2011)                                   9
Part b. Let w2 (t) represent a signal in which each sample of y[n] is replaced by three
impulses (one at t = 3n − 1, one at t = 3n, and one at t = 3n + 1), each with area y[n]/3.
Thus w2 (t) has the following form
y[0] y[0] y[0] y[1] y[1] y[1]
3    3    3    3    3    3 y[2] y[2] y[2]
3   3    3
t
0               3               6
which can be represented mathematically as
∞
1 0
w2 (t) =        y[n] δ(t−3n−1) + δ(t−3n) + δ(t−3n+1) .
3 n=−∞
Sketch the Fourier transform of w2 (t) on the axes below.
Label all important frequencies as well as the value of W2 (jω) at ω = 0.
W2 (jω)
ω
Final Examination / 6.003: Signals and Systems (Fall 2011)                          10', 'L\'inverse de ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). no calculators, computers, cell phones, music players, or other aids. 1               /14
triple reconstruction                      [16 points]
a ct signal x(t) is sampled to produce a dt signal y[n] = x(3n). the fourier transform
of x(t) is given below.
x(jω)
1
ω
π π
− 12 12
we wish to compare two methods of using y[n] to reconstruct approximations to x(t).
part a. let w1 (t) represent a signal in which each sample of y[n] is replaced by an
impulse of area y[n] located at t = 3n. thus w1 (t) has the following form
y[0]
y[1]
y[2]
t
0                     3              6
which can be represented mathematically as
∞
0
w1 (t) =          y[n] δ(t − 3n) .
n=−∞
sketch the fourier transform of w1 (t) on the axes below.
label all important features.
w1 (jω)
ω
final examination / 6.003: signals and systems (fall 2011)                                   9
part b. let w2 (t) represent a signal in which each sample of y[n] is replaced by three
impulses (one at t = 3n − 1, one at t = 3n, and one at t = 3n + 1), each with area y[n]/3.
thus w2 (t) has the following form
y[0] y[0] y[0] y[1] y[1] y[1]
3    3    3    3    3    3 y[2] y[2] y[2]
3   3    3
t
0               3               6
which can be represented mathematically as
∞
1 0
w2 (t) =        y[n] δ(t−3n−1) + δ(t−3n) + δ(t−3n+1) .
3 n=−∞
sketch the fourier transform of w2 (t) on the axes below.
label all important frequencies as well as the value of w2 (jω) at ω = 0.
w2 (jω)
ω
final examination / 6.003: signals and systems (fall 2011)                          10'), 'correct' => 2, 'answer' => 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). No calculators, computers, cell phones, music players, or other aids. 1               /14
Triple reconstruction                      [16 points]
A CT signal x(t) is sampled to produce a DT signal y[n] = x(3n). The Fourier transform
of x(t) is given below.
X(jω)
1
ω
π π
− 12 12
We wish to compare two methods of using y[n] to reconstruct approximations to x(t).
Part a. Let w1 (t) represent a signal in which each sample of y[n] is replaced by an
impulse of area y[n] located at t = 3n. Thus w1 (t) has the following form
y[0]
y[1]
y[2]
t
0                     3              6
which can be represented mathematically as
∞
0
w1 (t) =          y[n] δ(t − 3n) .
n=−∞
Sketch the Fourier transform of w1 (t) on the axes below.
Label all important features.
W1 (jω)
ω
Final Examination / 6.003: Signals and Systems (Fall 2011)                                   9
Part b. Let w2 (t) represent a signal in which each sample of y[n] is replaced by three
impulses (one at t = 3n − 1, one at t = 3n, and one at t = 3n + 1), each with area y[n]/3.
Thus w2 (t) has the following form
y[0] y[0] y[0] y[1] y[1] y[1]
3    3    3    3    3    3 y[2] y[2] y[2]
3   3    3
t
0               3               6
which can be represented mathematically as
∞
1 0
w2 (t) =        y[n] δ(t−3n−1) + δ(t−3n) + δ(t−3n+1) .
3 n=−∞
Sketch the Fourier transform of w2 (t) on the axes below.
Label all important frequencies as well as the value of W2 (jω) at ω = 0.
W2 (jω)
ω
Final Examination / 6.003: Signals and Systems (Fall 2011)                          10', '_recupere_le' => '2026-11-04T19:55:22.624790+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Fall 2011) Final Examination                                    December 19, 2011 Name: Kerberos Username: Please circle your section number: Section    Time 2       11 am 3       1 pm 4       2 pm Grades will be determined by the', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : DT Filtering             [14 points]
Sketch the magnitude and angle of the frequency response of a linear, time-invariant
system with the following unit-sample response:
h[n] = δ[n] − δ[n − 3] .
Label all important magnitudes, angles, and frequencies. All scales are linear.
magnitude
2
Ω
−2π                                                       2π
angle
3π
2π
π
Ω
−2π                                                       2π
−π
−2π
−3π
3Ω
H(ejΩ ) = 1 − e−j3Ω = e−j3Ω/2 ej3Ω/2 − e−j3Ω/2 = j2e−j3Ω/2 sin
�                �
2
Final Examination / 6.003: Signals and Systems (Fall 2011)                            11', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). No calculators, computers, cell phones, music players, or other aids. 1               /14
DT Filtering             [14 points]
Sketch the magnitude and angle of the frequency response of a linear, time-invariant
system with the following unit-sample response:
h[n] = δ[n] − δ[n − 3] .
Label all important magnitudes, angles, and frequencies. All scales are linear.
magnitude [linear scale]
frequency Ω
[linear scale]
angle (radians) [linear scale]
frequency Ω
[linear scale]
Final Examination / 6.003: Signals and Systems (Fall 2011)                            11', 'Impossible à déterminer', 'L\'inverse de ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). no calculators, computers, cell phones, music players, or other aids. 1               /14
dt filtering             [14 points]
sketch the magnitude and angle of the frequency response of a linear, time-invariant
system with the following unit-sample response:
h[n] = δ[n] − δ[n − 3] .
label all important magnitudes, angles, and frequencies. all scales are linear.
magnitude [linear scale]
frequency ω
[linear scale]
angle (radians) [linear scale]
frequency ω
[linear scale]
final examination / 6.003: signals and systems (fall 2011)                            11', 'Pas ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). no calculators, computers, cell phones, music players, or other aids. 1               /14
dt filtering             [14 points]
sketch the magnitude and angle of the frequency response of a linear, time-invariant
system with the following unit-sample response:
h[n] = δ[n] − δ[n − 3] .
label all important magnitudes, angles, and frequencies. all scales are linear.
magnitude [linear scale]
frequency ω
[linear scale]
angle (radians) [linear scale]
frequency ω
[linear scale]
final examination / 6.003: signals and systems (fall 2011)                            11'), 'correct' => 0, 'answer' => 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). No calculators, computers, cell phones, music players, or other aids. 1               /14
DT Filtering             [14 points]
Sketch the magnitude and angle of the frequency response of a linear, time-invariant
system with the following unit-sample response:
h[n] = δ[n] − δ[n − 3] .
Label all important magnitudes, angles, and frequencies. All scales are linear.
magnitude [linear scale]
frequency Ω
[linear scale]
angle (radians) [linear scale]
frequency Ω
[linear scale]
Final Examination / 6.003: Signals and Systems (Fall 2011)                            11', '_recupere_le' => '2026-11-04T19:55:22.625193+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Fall 2011) Final Examination                                    December 19, 2011 Name: Kerberos Username: Please circle your section number: Section    Time 2       11 am 3       1 pm 4       2 pm Grades will be determined by the', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Bandwidth Conservation                      [14 points]
Consider the following modulation scheme, where ωc >> ωm .
             
cos 21 ωm t        cos       ωc + 12 ωm t

×         LPF            ×
X                                          +        Y
×         LPF            ×
sin 12 ωm t

             
sin       ωc + 12 ωm t
Assume that each lowpass ﬁlter (LPF) is ideal, with cutoﬀ frequency ωm /2. Also assume
that the input signal has the following Fourier transform.
X(jω)
1
ω
−ωm              ωm
Sketch Y (jω) on the following axes.
Label all important magnitudes and frequencies.
Y (jω)
1
2
ω
ωc
−ωc−ωm −ωc                                                    ωc +ωm', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('Impossible à déterminer', 'Pas ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). no calculators, computers, cell phones, music players, or other aids. 1               /14
bandwidth conservation                      [14 points]
consider the following modulation scheme, where ωc >> ωm .
             
cos 21 ωm t        cos       ωc + 12 ωm t

×         lpf            ×
x                                          +      y
×         lpf            ×
sin 12 ωm t

             
sin       ωc + 12 ωm t
assume that each lowpass ﬁlter (lpf) is ideal, with cutoﬀ frequency ωm /2. also assume
that the input signal has the following fourier transform.
x(jω)
1
ω
−ωm              ωm
sketch y (jω) on the following axes.
label all important magnitudes and frequencies.
y (jω)
ω', 'L\'inverse de ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). no calculators, computers, cell phones, music players, or other aids. 1               /14
bandwidth conservation                      [14 points]
consider the following modulation scheme, where ωc >> ωm .
             
cos 21 ωm t        cos       ωc + 12 ωm t

×         lpf            ×
x                                          +      y
×         lpf            ×
sin 12 ωm t

             
sin       ωc + 12 ωm t
assume that each lowpass ﬁlter (lpf) is ideal, with cutoﬀ frequency ωm /2. also assume
that the input signal has the following fourier transform.
x(jω)
1
ω
−ωm              ωm
sketch y (jω) on the following axes.
label all important magnitudes and frequencies.
y (jω)
ω', 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). No calculators, computers, cell phones, music players, or other aids. 1               /14
Bandwidth Conservation                      [14 points]
Consider the following modulation scheme, where ωc >> ωm .
             
cos 21 ωm t        cos       ωc + 12 ωm t

×         LPF            ×
X                                          +      Y
×         LPF            ×
sin 12 ωm t

             
sin       ωc + 12 ωm t
Assume that each lowpass ﬁlter (LPF) is ideal, with cutoﬀ frequency ωm /2. Also assume
that the input signal has the following Fourier transform.
X(jω)
1
ω
−ωm              ωm
Sketch Y (jω) on the following axes.
Label all important magnitudes and frequencies.
Y (jω)
ω'), 'correct' => 3, 'answer' => 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight sides total). No calculators, computers, cell phones, music players, or other aids. 1               /14
Bandwidth Conservation                      [14 points]
Consider the following modulation scheme, where ωc >> ωm .
             
cos 21 ωm t        cos       ωc + 12 ωm t

×         LPF            ×
X                                          +      Y
×         LPF            ×
sin 12 ωm t

             
sin       ωc + 12 ωm t
Assume that each lowpass ﬁlter (LPF) is ideal, with cutoﬀ frequency ωm /2. Also assume
that the input signal has the following Fourier transform.
X(jω)
1
ω
−ωm              ωm
Sketch Y (jω) on the following axes.
Label all important magnitudes and frequencies.
Y (jω)
ω', '_recupere_le' => '2026-11-04T19:55:22.625673+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Fall 2009) Final Examination                                    December 17, 2009 Name: Kerberos Username: Please circle your section number: Section    Instructor              Time 1       Marc Baldo              10 am 2       Marc Baldo              11 am 3       Elfar Adalsteinsson     1 pm 4       Elfar Adalsteinsson     2 pm Partial credit will be given for', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : CT System with Feedback                             [15 points]
Let G represent a causal system that is described by the following diﬀerential equation
dy(t)          dx(t)
+ y(t) =       − x(t)
dt             dt
where x(t) represents the input signal and y(t) represents the output signal.
a. Determine the output y1 (t) of G when the input is
e−t ; t ≥ 0
x1 (t) =
0;    otherwise
Enter your result in the box below.
y1 (t) =                                       (1 − 2t) e−t u(t)
(s + 1)Y = (s − 1)X
s−1
Y =        X
s+1
s−1                  1
Y1 =       X1 ;     X1 =       ;   Re s > −1
s+1                 s+1
s−1         1      2
Y1 =            =      −
(s + 1)2   s + 1 (s + 1)2
y1 (t) = e−t u(t) − 2t e−t u(t)
Final Examination / 6.003: Signals and Systems (Fall 2009)                            3
Now consider a feedback loop that contains the G system described on the previous
page. 1
x(t)
w(t)         +         K                G               y(t)
−
b. Determine a diﬀerential equation that relates w(t) to y(t) when K = 10. The diﬀer­
ential equation should not contain references to x(t).
Enter the diﬀerential equation in the box below.
11 dy(t)           dw(t)
dt − 9y(t) = 10 dt − 10w(t)
s−1
Y       K            s−1               s−1              s−1
=     s+1 =K                =K                    =K
W         s−1  s + 1 + Ks − K    (K + 1)s − (K − 1)    11s − 9
1+K
s+1
1   The minus sign near the adder indicates that the output of the adder is w(t) − y(t)
Final Examination / 6.003: Signals and Systems (Fall 2009)                                                 4
c. Determine the values of K for which the feedback system on the previous page is
stable. Enter the range (or ranges) in the box below.
−1 < K < 1
Y         s−1
=
W   (K + 1)s − (K − 1)
K −1
s=        <0
K +1
To be stable, the pole must be in the left half-plane.
Consider two cases: either K is greater than −1 or it is less than −1.
If K > −1, then the denominator is positive and K − 1 must be less than 0 to assure that the pole
is in the left half-plane. This implies K < 1. Thus K could be in the range for −1 to 1.
Now consider the possibility that K is less than −1. Then K − 1 would have to be greater than
0 for the pole to be in the left half-plane. But this could only happen if K > 1, which contradicts
the assumption that K < −1. Therefore K cannot be less than −1.
Final Examination / 6.003: Signals and Systems (Fall 2009)                                          5', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('s that demonstrate some but not all of the important conceptual issues. Explanations are not required and will not aﬀect your grade. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
CT System with Feedback                    [15 points]
Let G represent a causal system that is described by the following diﬀerential equation
dy(t)          dx(t)
+ y(t) =       − x(t)
dt             dt
where x(t) represents the input signal and y(t) represents the output signal.
a. Determine the output y1 (t) of G when the input is
e−t ; t ≥ 0
x1 (t) =
0;    otherwise
Enter your result in the box below.
y1 (t) =
Final Examination / 6.003: Signals and Systems (Fall 2009)                            3
Now consider a feedback loop that contains the G system described on the previous
page. 1
x(t)
w(t)         +         K                G               y(t)
−
b. Determine a diﬀerential equation that relates w(t) to y(t) when K = 10. The diﬀer­
ential equation should not contain references to x(t).
Enter the diﬀerential equation in the box below.
1   The minus sign near the adder indicates that the output of the adder is w(t) − y(t)
Final Examination / 6.003: Signals and Systems (Fall 2009)                         4
c. Determine the values of K for which the feedback system on the previous page is
stable. Enter the range (or ranges) in the box below.
Final Examination / 6.003: Signals and Systems (Fall 2009)                               5', 'L\'inverse de s that demonstrate some but not all of the important conceptual issues. explanations are not required and will not aﬀect your grade. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
ct system with feedback                    [15 points]
let g represent a causal system that is described by the following diﬀerential equation
dy(t)          dx(t)
+ y(t) =       − x(t)
dt             dt
where x(t) represents the input signal and y(t) represents the output signal.
a. determine the output y1 (t) of g when the input is
e−t ; t ≥ 0
x1 (t) =
0;    otherwise
enter your result in the box below.
y1 (t) =
final examination / 6.003: signals and systems (fall 2009)                            3
now consider a feedback loop that contains the g system described on the previous
page. 1
x(t)
w(t)         +         k                g               y(t)
−
b. determine a diﬀerential equation that relates w(t) to y(t) when k = 10. the diﬀer­
ential equation should not contain references to x(t).
enter the diﬀerential equation in the box below.
1   the minus sign near the adder indicates that the output of the adder is w(t) − y(t)
final examination / 6.003: signals and systems (fall 2009)                         4
c. determine the values of k for which the feedback system on the previous page is
stable. enter the range (or ranges) in the box below.
final examination / 6.003: signals and systems (fall 2009)                               5', 'Pas s that demonstrate some but not all of the important conceptual issues. explanations are not required and will not aﬀect your grade. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
ct system with feedback                    [15 points]
let g represent a causal system that is described by the following diﬀerential equation
dy(t)          dx(t)
+ y(t) =       − x(t)
dt             dt
where x(t) represents the input signal and y(t) represents the output signal.
a. determine the output y1 (t) of g when the input is
e−t ; t ≥ 0
x1 (t) =
0;    otherwise
enter your result in the box below.
y1 (t) =
final examination / 6.003: signals and systems (fall 2009)                            3
now consider a feedback loop that contains the g system described on the previous
page. 1
x(t)
w(t)         +         k                g               y(t)
−
b. determine a diﬀerential equation that relates w(t) to y(t) when k = 10. the diﬀer­
ential equation should not contain references to x(t).
enter the diﬀerential equation in the box below.
1   the minus sign near the adder indicates that the output of the adder is w(t) − y(t)
final examination / 6.003: signals and systems (fall 2009)                         4
c. determine the values of k for which the feedback system on the previous page is
stable. enter the range (or ranges) in the box below.
final examination / 6.003: signals and systems (fall 2009)                               5', 'Impossible à déterminer'), 'correct' => 0, 'answer' => 's that demonstrate some but not all of the important conceptual issues. Explanations are not required and will not aﬀect your grade. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
CT System with Feedback                    [15 points]
Let G represent a causal system that is described by the following diﬀerential equation
dy(t)          dx(t)
+ y(t) =       − x(t)
dt             dt
where x(t) represents the input signal and y(t) represents the output signal.
a. Determine the output y1 (t) of G when the input is
e−t ; t ≥ 0
x1 (t) =
0;    otherwise
Enter your result in the box below.
y1 (t) =
Final Examination / 6.003: Signals and Systems (Fall 2009)                            3
Now consider a feedback loop that contains the G system described on the previous
page. 1
x(t)
w(t)         +         K                G               y(t)
−
b. Determine a diﬀerential equation that relates w(t) to y(t) when K = 10. The diﬀer­
ential equation should not contain references to x(t).
Enter the diﬀerential equation in the box below.
1   The minus sign near the adder indicates that the output of the adder is w(t) − y(t)
Final Examination / 6.003: Signals and Systems (Fall 2009)                         4
c. Determine the values of K for which the feedback system on the previous page is
stable. Enter the range (or ranges) in the box below.
Final Examination / 6.003: Signals and Systems (Fall 2009)                               5', '_recupere_le' => '2026-11-04T19:55:22.626379+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Fall 2009) Final Examination                                    December 17, 2009 Name: Kerberos Username: Please circle your section number: Section    Instructor              Time 1       Marc Baldo              10 am 2       Marc Baldo              11 am 3       Elfar Adalsteinsson     1 pm 4       Elfar Adalsteinsson     2 pm Partial credit will be given for', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Stepping Up and Down                         [10 points]
Use a small number of delays, gains, and 2-input adders (and no other types of elements)
to implement a system whose response (starting at rest) to a unit-step signal
1 n≥0
x[n] = u[n] =
0 otherwise
is
0 n<0
⎧
⎪
1 n = 0, 3, 6, 9, . . .
⎨
y[n] =
⎩ 2 n = 1, 4, 7, 10, . . .
⎪
3 n = 2, 5, 8, 11, . . .
Draw a block diagram of your system below.
X                              +        +                       +     Y
R       −1                        R
2       +
R
3
R
First ﬁnd a system whose unit-sample response is the desired sequence. The periodicity of 3
suggests that y[n] depends on y[n − 3]. To get the correct numbers, just delay the input and
weight the delays appropriately. The resulting diﬀerence equation is
y[n] = y[n − 3] + w[n] + 2w[n − 1] + 3w[n − 2] .
A direct realization of the diﬀerence equation is shown below.
W                    +        +               Y
R                              R
2       +
R                              R
3
R
We can “reuse” 2 delays by commuting the left and right parts of this network.
Next compute w[n] which is the ﬁrst diﬀerence of x[n]:
w[n] = x[n] − x[n − 1]
The result is the cascade of the ﬁrst diﬀerence and the previous result.
Final Examination / 6.003: Signals and Systems (Fall 2009)                                             6', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('s that demonstrate some but not all of the important conceptual issues. Explanations are not required and will not aﬀect your grade. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
Stepping Up and Down                        [10 points]
Use a small number of delays, gains, and 2-input adders (and no other types of elements)
to implement a system whose response (starting at rest) to a unit-step signal
1 n≥0
x[n] = u[n] =
0 otherwise
is
0   n<0
⎧
⎪
1   n = 0, 3, 6, 9, . . .
⎨
y[n] =
⎩2
⎪     n = 1, 4, 7, 10, . . .
3   n = 2, 5, 8, 11, . . .
Draw a block diagram of your system below.
Final Examination / 6.003: Signals and Systems (Fall 2009)                                6', 'L\'inverse de s that demonstrate some but not all of the important conceptual issues. explanations are not required and will not aﬀect your grade. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
stepping up and down                        [10 points]
use a small number of delays, gains, and 2-input adders (and no other types of elements)
to implement a system whose response (starting at rest) to a unit-step signal
1 n≥0
x[n] = u[n] =
0 otherwise
is
0   n<0
⎧
⎪
1   n = 0, 3, 6, 9, . . .
⎨
y[n] =
⎩2
⎪     n = 1, 4, 7, 10, . . .
3   n = 2, 5, 8, 11, . . .
draw a block diagram of your system below.
final examination / 6.003: signals and systems (fall 2009)                                6', 'Pas s that demonstrate some but not all of the important conceptual issues. explanations are not required and will not aﬀect your grade. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
stepping up and down                        [10 points]
use a small number of delays, gains, and 2-input adders (and no other types of elements)
to implement a system whose response (starting at rest) to a unit-step signal
1 n≥0
x[n] = u[n] =
0 otherwise
is
0   n<0
⎧
⎪
1   n = 0, 3, 6, 9, . . .
⎨
y[n] =
⎩2
⎪     n = 1, 4, 7, 10, . . .
3   n = 2, 5, 8, 11, . . .
draw a block diagram of your system below.
final examination / 6.003: signals and systems (fall 2009)                                6', 'Impossible à déterminer'), 'correct' => 0, 'answer' => 's that demonstrate some but not all of the important conceptual issues. Explanations are not required and will not aﬀect your grade. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
Stepping Up and Down                        [10 points]
Use a small number of delays, gains, and 2-input adders (and no other types of elements)
to implement a system whose response (starting at rest) to a unit-step signal
1 n≥0
x[n] = u[n] =
0 otherwise
is
0   n<0
⎧
⎪
1   n = 0, 3, 6, 9, . . .
⎨
y[n] =
⎩2
⎪     n = 1, 4, 7, 10, . . .
3   n = 2, 5, 8, 11, . . .
Draw a block diagram of your system below.
Final Examination / 6.003: Signals and Systems (Fall 2009)                                6', '_recupere_le' => '2026-11-04T19:55:22.626861+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Fall 2009) Final Examination                                    December 17, 2009 Name: Kerberos Username: Please circle your section number: Section    Instructor              Time 1       Marc Baldo              10 am 2       Marc Baldo              11 am 3       Elfar Adalsteinsson     1 pm 4       Elfar Adalsteinsson     2 pm Partial credit will be given for', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : DT systems                  [14 points]
The pole-zero diagram for a DT system is shown below, where the circle has radius 1.
z-plane
− 12
It is known that when the input is 1 for all n, the output is also 1 for all n.
Sketch the unit-sample response h[n] of the system on the axes below. Label the impor­
tant features of your sketch.
h[n]
1
3
n
1
√               √
Y    z + 12 − j 23 z + 12 + j 23                    2
z + 12 + 34    z2 + z + 1
=K                                      =K               =K            = K (z+1+z −1 )
X                 z                                  z            z
H(1) = 3K = 1
Therefore, K = 13 .
1
h[n] =     (δ[n − 1] + δ[n] + δ[n + 1])
3
Final Examination / 6.003: Signals and Systems (Fall 2009)                             7
A second DT system has the following pole-zero diagram:
z-plane
1/2
It is known that the system function H(z) is 1 when z = 1.
Sketch the magnitude of the frequency response of this system on the axes below. Label
the important features of your sketch (including the axes).
|H(e jΩ )|
1
1
3
Ω
2π
Sketch the angle of the frequency response of this system on the axes below. Label the
important features of your sketch (including the axes).
∠H(e jΩ )
2π
Ω
2π
Final Examination / 6.003: Signals and Systems (Fall 2009)                                               8', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('s that demonstrate some but not all of the important conceptual issues. Explanations are not required and will not aﬀect your grade. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
DT systems             [14 points]
The pole-zero diagram for a DT system is shown below, where the circle has radius 1.
z-plane
− 12
It is known that when the input is 1 for all n, the output is also 1 for all n.
Sketch the unit-sample response h[n] of the system on the axes below. Label the impor­
tant features of your sketch.
h[n]
n
1
Final Examination / 6.003: Signals and Systems (Fall 2009)                             7
A second DT system has the following pole-zero diagram:
z-plane
1/2
It is known that the system function H(z) is 1 when z = 1.
Sketch the magnitude of the frequency response of this system on the axes below. Label
the important features of your sketch (including the axes).
Sketch the angle of the frequency response of this system on the axes below. Label the
important features of your sketch (including the axes).
Final Examination / 6.003: Signals and Systems (Fall 2009)                              8', 'Impossible à déterminer', 'L\'inverse de s that demonstrate some but not all of the important conceptual issues. explanations are not required and will not aﬀect your grade. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
dt systems             [14 points]
the pole-zero diagram for a dt system is shown below, where the circle has radius 1.
z-plane
− 12
it is known that when the input is 1 for all n, the output is also 1 for all n.
sketch the unit-sample response h[n] of the system on the axes below. label the impor­
tant features of your sketch.
h[n]
n
1
final examination / 6.003: signals and systems (fall 2009)                             7
a second dt system has the following pole-zero diagram:
z-plane
1/2
it is known that the system function h(z) is 1 when z = 1.
sketch the magnitude of the frequency response of this system on the axes below. label
the important features of your sketch (including the axes).
sketch the angle of the frequency response of this system on the axes below. label the
important features of your sketch (including the axes).
final examination / 6.003: signals and systems (fall 2009)                              8', 'Pas s that demonstrate some but not all of the important conceptual issues. explanations are not required and will not aﬀect your grade. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
dt systems             [14 points]
the pole-zero diagram for a dt system is shown below, where the circle has radius 1.
z-plane
− 12
it is known that when the input is 1 for all n, the output is also 1 for all n.
sketch the unit-sample response h[n] of the system on the axes below. label the impor­
tant features of your sketch.
h[n]
n
1
final examination / 6.003: signals and systems (fall 2009)                             7
a second dt system has the following pole-zero diagram:
z-plane
1/2
it is known that the system function h(z) is 1 when z = 1.
sketch the magnitude of the frequency response of this system on the axes below. label
the important features of your sketch (including the axes).
sketch the angle of the frequency response of this system on the axes below. label the
important features of your sketch (including the axes).
final examination / 6.003: signals and systems (fall 2009)                              8'), 'correct' => 0, 'answer' => 's that demonstrate some but not all of the important conceptual issues. Explanations are not required and will not aﬀect your grade. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
DT systems             [14 points]
The pole-zero diagram for a DT system is shown below, where the circle has radius 1.
z-plane
− 12
It is known that when the input is 1 for all n, the output is also 1 for all n.
Sketch the unit-sample response h[n] of the system on the axes below. Label the impor­
tant features of your sketch.
h[n]
n
1
Final Examination / 6.003: Signals and Systems (Fall 2009)                             7
A second DT system has the following pole-zero diagram:
z-plane
1/2
It is known that the system function H(z) is 1 when z = 1.
Sketch the magnitude of the frequency response of this system on the axes below. Label
the important features of your sketch (including the axes).
Sketch the angle of the frequency response of this system on the axes below. Label the
important features of your sketch (including the axes).
Final Examination / 6.003: Signals and Systems (Fall 2009)                              8', '_recupere_le' => '2026-11-04T19:55:22.627438+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Fall 2009) Final Examination                                    December 17, 2009 Name: Kerberos Username: Please circle your section number: Section    Instructor              Time 1       Marc Baldo              10 am 2       Marc Baldo              11 am 3       Elfar Adalsteinsson     1 pm 4       Elfar Adalsteinsson     2 pm Partial credit will be given for', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : CT Systems                  [14 points]
A causal CT system has the following pole-zero diagram:
s-plane
−1 − 12
Let y(t) = s(t) represent the response of this system to a unit-step signal

1; t ≥ 0
x(t) = u(t) =
0 ; otherwise .
Assume that the unit-step response s(t) of this system is known to approach 1 as t → ∞.
Determine y(t) = s(t) and enter it in the box below.
y(t) =                                      (1 + e−t − 2e−t/2 ) u(t)
From the pole-zero diagram,
K
H(s) =                    .
(s + 1)(s + 12 )
Since the system is stable (system is causal and poles are all in left half-plane), the unit-step
response will approach H(0) as t → ∞. Therefore
K
H(0) =             = 2K = 1
(1)( 12 )
1
and K = 12 . The Laplace transform of the unit step is X(s) =          for Re{s} > 0. Therefore
s
1
2                1     1       2
Y =                     = +     −
s(s + 1)(s + 12 )  s s + 1 s + 12
Final Examination / 6.003: Signals and Systems (Fall 2009)                                           9
A second CT system has the following pole-zero diagram:
1       s-plane
−1
Assume that the input signal is

1 ; cos t > π1
x(t) =
0 ; otherwise .
Let ak and bk represent the Fourier series coeﬃcients of the input and output signals,
respectively, where the fundamental (lowest frequency component) of each signal has a
period of 2π.
b0                 b1
It is known that     = 1. Determine .
a0                 a1
b1                             2
=
a1                          −1 + 3j
K                            K                      K
H(s) =                                   =                       =
(s + 1)(s + 1 − jω)(s + 1 + jω)   (s + 1)((s + 1)2 + 1)   (s + 1)(s2 + 2s + 2)
b0               K
= 1 = H(j0) =
a0               2
The fundamental frequency is ω = 2π
2π = 1.
b1                 K              2
= H(j1) =                 =
a1           (1 + j)(1 + 2j)   −1 + 3j
Final Examination / 6.003: Signals and Systems (Fall 2009)                                                       10', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('s that demonstrate some but not all of the important conceptual issues. Explanations are not required and will not aﬀect your grade. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
CT Systems             [14 points]
A causal CT system has the following pole-zero diagram:
s-plane
−1 − 12
Let y(t) = s(t) represent the response of this system to a unit-step signal

1; t ≥ 0
x(t) = u(t) =
0 ; otherwise .
Assume that the unit-step response s(t) of this system is known to approach 1 as t → ∞.
Determine y(t) = s(t) and enter it in the box below.
y(t) =
Final Examination / 6.003: Signals and Systems (Fall 2009)                             9
A second CT system has the following pole-zero diagram:
1     s-plane
−1
Assume that the input signal is

1 ; cos t > π1
x(t) =
0 ; otherwise .
Let ak and bk represent the Fourier series coeﬃcients of the input and output signals,
respectively, where the fundamental (lowest frequency component) of each signal has a
period of 2π.
b0                 b1
It is known that     = 1. Determine .
a0                 a1
b1
=
a1
Final Examination / 6.003: Signals and Systems (Fall 2009)                                                       10', 'Impossible à déterminer', 'L\'inverse de s that demonstrate some but not all of the important conceptual issues. explanations are not required and will not aﬀect your grade. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
ct systems             [14 points]
a causal ct system has the following pole-zero diagram:
s-plane
−1 − 12
let y(t) = s(t) represent the response of this system to a unit-step signal

1; t ≥ 0
x(t) = u(t) =
0 ; otherwise .
assume that the unit-step response s(t) of this system is known to approach 1 as t → ∞.
determine y(t) = s(t) and enter it in the box below.
y(t) =
final examination / 6.003: signals and systems (fall 2009)                             9
a second ct system has the following pole-zero diagram:
1     s-plane
−1
assume that the input signal is

1 ; cos t > π1
x(t) =
0 ; otherwise .
let ak and bk represent the fourier series coeﬃcients of the input and output signals,
respectively, where the fundamental (lowest frequency component) of each signal has a
period of 2π.
b0                 b1
it is known that     = 1. determine .
a0                 a1
b1
=
a1
final examination / 6.003: signals and systems (fall 2009)                                                       10', 'Pas s that demonstrate some but not all of the important conceptual issues. explanations are not required and will not aﬀect your grade. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
ct systems             [14 points]
a causal ct system has the following pole-zero diagram:
s-plane
−1 − 12
let y(t) = s(t) represent the response of this system to a unit-step signal

1; t ≥ 0
x(t) = u(t) =
0 ; otherwise .
assume that the unit-step response s(t) of this system is known to approach 1 as t → ∞.
determine y(t) = s(t) and enter it in the box below.
y(t) =
final examination / 6.003: signals and systems (fall 2009)                             9
a second ct system has the following pole-zero diagram:
1     s-plane
−1
assume that the input signal is

1 ; cos t > π1
x(t) =
0 ; otherwise .
let ak and bk represent the fourier series coeﬃcients of the input and output signals,
respectively, where the fundamental (lowest frequency component) of each signal has a
period of 2π.
b0                 b1
it is known that     = 1. determine .
a0                 a1
b1
=
a1
final examination / 6.003: signals and systems (fall 2009)                                                       10'), 'correct' => 0, 'answer' => 's that demonstrate some but not all of the important conceptual issues. Explanations are not required and will not aﬀect your grade. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
CT Systems             [14 points]
A causal CT system has the following pole-zero diagram:
s-plane
−1 − 12
Let y(t) = s(t) represent the response of this system to a unit-step signal

1; t ≥ 0
x(t) = u(t) =
0 ; otherwise .
Assume that the unit-step response s(t) of this system is known to approach 1 as t → ∞.
Determine y(t) = s(t) and enter it in the box below.
y(t) =
Final Examination / 6.003: Signals and Systems (Fall 2009)                             9
A second CT system has the following pole-zero diagram:
1     s-plane
−1
Assume that the input signal is

1 ; cos t > π1
x(t) =
0 ; otherwise .
Let ak and bk represent the Fourier series coeﬃcients of the input and output signals,
respectively, where the fundamental (lowest frequency component) of each signal has a
period of 2π.
b0                 b1
It is known that     = 1. Determine .
a0                 a1
b1
=
a1
Final Examination / 6.003: Signals and Systems (Fall 2009)                                                       10', '_recupere_le' => '2026-11-04T19:55:22.628126+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Fall 2009) Final Examination                                    December 17, 2009 Name: Kerberos Username: Please circle your section number: Section    Instructor              Time 1       Marc Baldo              10 am 2       Marc Baldo              11 am 3       Elfar Adalsteinsson     1 pm 4       Elfar Adalsteinsson     2 pm Partial credit will be given for', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : DT processing of CT signals                                [15 points]
Consider the following system for DT processing of CT signals:
xb (t)    uniform      xc [n]                yd [n]       sample-to-   ye (t)
xa (t)     H1 (jω)                                     H2 (e jΩ )                                      H3 (jω)        yf (t)
sampler                                           impulse
where xc [n] = xb (nT ) and
∞
0
ye (t) =          yd [n]δ(t − nT ) .
n=−∞
The frequency responses H1 (jω) and H3 (jω) are given below.
H1 (jω)
1
ω
3π            π              π                3π
−            −
2T           2T             2T                2T
H3 (jω)
T
ω
π                              π
−
T                              T
a. Assume in this part that H2 (ejΩ ) = 1 for all frequencies Ω. Determine yf (t) when
 π          5π
xa (t) = cos     t + sin       t .
2T           4T
 π  1          
3π
yf (t) =                                   cos     t − sin      t
2T    4      4T
Final Examination / 6.003: Signals and Systems (Fall 2009)                           11
b. For this part, assume that

jΩ       1 ; |Ω| < Ωc
H2 (e ) =
0 ; Ωc < |Ω| < π .
For what values of Ωc is the overall system from xa (t) to yf (t) linear and time-
invariant?
values of Ωc :                            0 < Ωc < π2
Final Examination / 6.003: Signals and Systems (Fall 2009)                                      12', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('Impossible à déterminer', 'Pas s that demonstrate some but not all of the important conceptual issues. explanations are not required and will not aﬀect your grade. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
dt processing of ct signals                                [15 points]
consider the following system for dt processing of ct signals:
xb (t)    uniform      xc [n]                yd [n]       sample-to-   ye (t)
xa (t)     h1 (jω)                                     h2 (e jω )                                      h3 (jω)        yf (t)
sampler                                           impulse
where xc [n] = xb (nt ) and
∞
0
ye (t) =          yd [n]δ(t − nt ) .
n=−∞
the frequency responses h1 (jω) and h3 (jω) are given below.
h1 (jω)
1
ω
3π            π              π                3π
−            −
2t           2t             2t                2t
h3 (jω)
t
ω
π                              π
−
t                              t
a. assume in this part that h2 (ejω ) = 1 for all frequencies ω. determine yf (t) when
� π �         5π
xa (t) = cos     t + sin       t .
2t           4t
yf (t) =
final examination / 6.003: signals and systems (fall 2009)                           11
b. for this part, assume that

jω       1 ; |ω| < ωc
h2 (e ) =
0 ; ωc < |ω| < π .
for what values of ωc is the overall system from xa (t) to yf (t) linear and time-
invariant?
values of ωc :
final examination / 6.003: signals and systems (fall 2009)                                      12', 'L\'inverse de s that demonstrate some but not all of the important conceptual issues. explanations are not required and will not aﬀect your grade. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
dt processing of ct signals                                [15 points]
consider the following system for dt processing of ct signals:
xb (t)    uniform      xc [n]                yd [n]       sample-to-   ye (t)
xa (t)     h1 (jω)                                     h2 (e jω )                                      h3 (jω)        yf (t)
sampler                                           impulse
where xc [n] = xb (nt ) and
∞
0
ye (t) =          yd [n]δ(t − nt ) .
n=−∞
the frequency responses h1 (jω) and h3 (jω) are given below.
h1 (jω)
1
ω
3π            π              π                3π
−            −
2t           2t             2t                2t
h3 (jω)
t
ω
π                              π
−
t                              t
a. assume in this part that h2 (ejω ) = 1 for all frequencies ω. determine yf (t) when
� π �         5π
xa (t) = cos     t + sin       t .
2t           4t
yf (t) =
final examination / 6.003: signals and systems (fall 2009)                           11
b. for this part, assume that

jω       1 ; |ω| < ωc
h2 (e ) =
0 ; ωc < |ω| < π .
for what values of ωc is the overall system from xa (t) to yf (t) linear and time-
invariant?
values of ωc :
final examination / 6.003: signals and systems (fall 2009)                                      12', 's that demonstrate some but not all of the important conceptual issues. Explanations are not required and will not aﬀect your grade. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
DT processing of CT signals                                [15 points]
Consider the following system for DT processing of CT signals:
xb (t)    uniform      xc [n]                yd [n]       sample-to-   ye (t)
xa (t)     H1 (jω)                                     H2 (e jΩ )                                      H3 (jω)        yf (t)
sampler                                           impulse
where xc [n] = xb (nT ) and
∞
0
ye (t) =          yd [n]δ(t − nT ) .
n=−∞
The frequency responses H1 (jω) and H3 (jω) are given below.
H1 (jω)
1
ω
3π            π              π                3π
−            −
2T           2T             2T                2T
H3 (jω)
T
ω
π                              π
−
T                              T
a. Assume in this part that H2 (ejΩ ) = 1 for all frequencies Ω. Determine yf (t) when
� π �         5π
xa (t) = cos     t + sin       t .
2T           4T
yf (t) =
Final Examination / 6.003: Signals and Systems (Fall 2009)                           11
b. For this part, assume that

jΩ       1 ; |Ω| < Ωc
H2 (e ) =
0 ; Ωc < |Ω| < π .
For what values of Ωc is the overall system from xa (t) to yf (t) linear and time-
invariant?
values of Ωc :
Final Examination / 6.003: Signals and Systems (Fall 2009)                                      12'), 'correct' => 3, 'answer' => 's that demonstrate some but not all of the important conceptual issues. Explanations are not required and will not aﬀect your grade. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
DT processing of CT signals                                [15 points]
Consider the following system for DT processing of CT signals:
xb (t)    uniform      xc [n]                yd [n]       sample-to-   ye (t)
xa (t)     H1 (jω)                                     H2 (e jΩ )                                      H3 (jω)        yf (t)
sampler                                           impulse
where xc [n] = xb (nT ) and
∞
0
ye (t) =          yd [n]δ(t − nT ) .
n=−∞
The frequency responses H1 (jω) and H3 (jω) are given below.
H1 (jω)
1
ω
3π            π              π                3π
−            −
2T           2T             2T                2T
H3 (jω)
T
ω
π                              π
−
T                              T
a. Assume in this part that H2 (ejΩ ) = 1 for all frequencies Ω. Determine yf (t) when
� π �         5π
xa (t) = cos     t + sin       t .
2T           4T
yf (t) =
Final Examination / 6.003: Signals and Systems (Fall 2009)                           11
b. For this part, assume that

jΩ       1 ; |Ω| < Ωc
H2 (e ) =
0 ; Ωc < |Ω| < π .
For what values of Ωc is the overall system from xa (t) to yf (t) linear and time-
invariant?
values of Ωc :
Final Examination / 6.003: Signals and Systems (Fall 2009)                                      12', '_recupere_le' => '2026-11-04T19:55:22.628937+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Fall 2009) Final Examination                                    December 17, 2009 Name: Kerberos Username: Please circle your section number: Section    Instructor              Time 1       Marc Baldo              10 am 2       Marc Baldo              11 am 3       Elfar Adalsteinsson     1 pm 4       Elfar Adalsteinsson     2 pm Partial credit will be given for', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Which are True?                    [16 points]
For each of the DT signals x1 [n] through x4 [n] (below), determine whether the conditions
listed in the following table are satisﬁed, and answer T for true or F for false.
x1 [n]       x2 [n]   x3 [n]        x4 [n]
X(e j0 ) = 0                                T           F         T             T
Rπ        jΩ ) dΩ = 0
−π X(e                                          T            T        T            F
X(e jΩ ) is purely imaginary                          F            F         T            F
e jkΩ X(e jΩ ) is purely real for some integer k               F             T       F             F
x1 [n]
1
n
x2 [n]
1
n
x3 [n]
1
n
x4 [n]= x4 [n + 5]
1
n
Final Examination / 6.003: Signals and Systems (Fall 2009)                                            14', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('s that demonstrate some but not all of the important conceptual issues. Explanations are not required and will not aﬀect your grade. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
Which are True?                    [16 points]
For each of the DT signals x1 [n] through x4 [n] (below), determine whether the conditions
listed in the following table are satisﬁed, and answer T for true or F for false.
x1 [n]       x2 [n]   x3 [n]        x4 [n]
X(e j0 ) = 0
Rπ        jΩ ) dΩ = 0
−π X(e
X(e jΩ ) is purely imaginary
e jkΩ X(e jΩ ) is purely real for some integer k
x1 [n]
1
n
x2 [n]
1
n
x3 [n]
1
n
x4 [n]= x4 [n + 5]
1
n
Final Examination / 6.003: Signals and Systems (Fall 2009)                                            14', 'Pas s that demonstrate some but not all of the important conceptual issues. explanations are not required and will not aﬀect your grade. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
which are true?                    [16 points]
for each of the dt signals x1 [n] through x4 [n] (below), determine whether the conditions
listed in the following table are satisﬁed, and answer t for true or f for false.
x1 [n]       x2 [n]   x3 [n]        x4 [n]
x(e j0 ) = 0
rπ        jω ) dω = 0
−π x(e
x(e jω ) is purely imaginary
e jkω x(e jω ) is purely real for some integer k
x1 [n]
1
n
x2 [n]
1
n
x3 [n]
1
n
x4 [n]= x4 [n + 5]
1
n
final examination / 6.003: signals and systems (fall 2009)                                            14', 'L\'inverse de s that demonstrate some but not all of the important conceptual issues. explanations are not required and will not aﬀect your grade. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
which are true?                    [16 points]
for each of the dt signals x1 [n] through x4 [n] (below), determine whether the conditions
listed in the following table are satisﬁed, and answer t for true or f for false.
x1 [n]       x2 [n]   x3 [n]        x4 [n]
x(e j0 ) = 0
rπ        jω ) dω = 0
−π x(e
x(e jω ) is purely imaginary
e jkω x(e jω ) is purely real for some integer k
x1 [n]
1
n
x2 [n]
1
n
x3 [n]
1
n
x4 [n]= x4 [n + 5]
1
n
final examination / 6.003: signals and systems (fall 2009)                                            14', 'Impossible à déterminer'), 'correct' => 0, 'answer' => 's that demonstrate some but not all of the important conceptual issues. Explanations are not required and will not aﬀect your grade. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
Which are True?                    [16 points]
For each of the DT signals x1 [n] through x4 [n] (below), determine whether the conditions
listed in the following table are satisﬁed, and answer T for true or F for false.
x1 [n]       x2 [n]   x3 [n]        x4 [n]
X(e j0 ) = 0
Rπ        jΩ ) dΩ = 0
−π X(e
X(e jΩ ) is purely imaginary
e jkΩ X(e jΩ ) is purely real for some integer k
x1 [n]
1
n
x2 [n]
1
n
x3 [n]
1
n
x4 [n]= x4 [n + 5]
1
n
Final Examination / 6.003: Signals and Systems (Fall 2009)                                            14', '_recupere_le' => '2026-11-04T19:55:22.629406+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Fall 2009) Final Examination                                    December 17, 2009 Name: Kerberos Username: Please circle your section number: Section    Instructor              Time 1       Marc Baldo              10 am 2       Marc Baldo              11 am 3       Elfar Adalsteinsson     1 pm 4       Elfar Adalsteinsson     2 pm Partial credit will be given for', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Multiplied Sampling                            [16 points]
The Fourier transform of a signal xa (t) is given below.
Xa (jω)
1
ω
π             π
−
2             2
This signal passes through the following system
xb (t)   uniform       xc [n]          xd [n] sample-to-   xe (t)
xa (t)      ×                                      K                                 H(jω)       xf (t)
sampler                                impulse
cos (7πt)
where xc [n] = xb (nT ) and
∞
0
xe (t) =            xd [n]δ(t − nT )
n=−∞
and
T    if |ω| < Tπ
n
H(jω) =
0    otherwise .
a. Sketch the Fourier transform of xf (t) for the case when K = 1 and T = 1. Label the
important features of your plot.
Xf (jω)
1
ω
π             π
−
2             2
Final Examination / 6.003: Signals and Systems (Fall 2009)                          15
b. Is it possible to adjust T and K so that xf (t) = xa (t)?
yes or no:           yes
If yes, specify a value T and the corresponding value of K (there may be multiple
solutions, you need only specify one of them).
2 4 6 8 10 12
T =            7 , 7 , 7 , 7 , 7 , 7 , or 2   K=                  1
If no, brieﬂy explain why not.
Final Examination / 6.003: Signals and Systems (Fall 2009)                                 16
c. Is it possible to adjust T and K so that the Fourier transform of xf (t) is equal to the
following, and is zero outside the indicated range?
Xf (jω)
1
ω
3π −π         π             π   π   3π
−             −
2            2             2        2
yes or no:          yes
If yes, specify all possible pairs of T and K that work in the table below. If there are
more rows in the table than are needed, leave the remaining entries blank.
T                       K
1
3                       2
2
3                       2
1
4                       2
1
2                       2
If no, brieﬂy explain why not.', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('Impossible à déterminer', 'Pas s that demonstrate some but not all of the important conceptual issues. explanations are not required and will not aﬀect your grade. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
multiplied sampling                            [16 points]
the fourier transform of a signal xa (t) is given below.
xa (jω)
1
ω
π             π
−
2             2
this signal passes through the following system
xb (t)   uniform       xc [n]          xd [n] sample-to-   xe (t)
xa (t)      ×                                      k                                 h(jω)       xf (t)
sampler                                impulse
cos (7πt)
where xc [n] = xb (nt ) and
∞
0
xe (t) =            xd [n]δ(t − nt )
n=−∞
and
t    if |ω| < tπ
n
h(jω) =
0    otherwise .
a. sketch the fourier transform of xf (t) for the case when k = 1 and t = 1. label the
important features of your plot.
xf (jω)
1
ω
π             π
−
2             2
final examination / 6.003: signals and systems (fall 2009)                          15
b. is it possible to adjust t and k so that xf (t) = xa (t)?
yes or no:
if yes, specify a value t and the corresponding value of k (there may be multiple
solutions, you need only specify one of them).
t =                                           k=
if no, brieﬂy explain why not.
final examination / 6.003: signals and systems (fall 2009)                                 16
c. is it possible to adjust t and k so that the fourier transform of xf (t) is equal to the
following, and is zero outside the indicated range?
xf (jω)
1
ω
3π −π         π             π   π   3π
−             −
2            2             2        2
yes or no:
if yes, specify all possible pairs of t and k that work in the table below. if there are
more rows in the table than are needed, leave the remaining entries blank.
t                       k
if no, brieﬂy explain why not.', 'L\'inverse de s that demonstrate some but not all of the important conceptual issues. explanations are not required and will not aﬀect your grade. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
multiplied sampling                            [16 points]
the fourier transform of a signal xa (t) is given below.
xa (jω)
1
ω
π             π
−
2             2
this signal passes through the following system
xb (t)   uniform       xc [n]          xd [n] sample-to-   xe (t)
xa (t)      ×                                      k                                 h(jω)       xf (t)
sampler                                impulse
cos (7πt)
where xc [n] = xb (nt ) and
∞
0
xe (t) =            xd [n]δ(t − nt )
n=−∞
and
t    if |ω| < tπ
n
h(jω) =
0    otherwise .
a. sketch the fourier transform of xf (t) for the case when k = 1 and t = 1. label the
important features of your plot.
xf (jω)
1
ω
π             π
−
2             2
final examination / 6.003: signals and systems (fall 2009)                          15
b. is it possible to adjust t and k so that xf (t) = xa (t)?
yes or no:
if yes, specify a value t and the corresponding value of k (there may be multiple
solutions, you need only specify one of them).
t =                                           k=
if no, brieﬂy explain why not.
final examination / 6.003: signals and systems (fall 2009)                                 16
c. is it possible to adjust t and k so that the fourier transform of xf (t) is equal to the
following, and is zero outside the indicated range?
xf (jω)
1
ω
3π −π         π             π   π   3π
−             −
2            2             2        2
yes or no:
if yes, specify all possible pairs of t and k that work in the table below. if there are
more rows in the table than are needed, leave the remaining entries blank.
t                       k
if no, brieﬂy explain why not.', 's that demonstrate some but not all of the important conceptual issues. Explanations are not required and will not aﬀect your grade. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
Multiplied Sampling                            [16 points]
The Fourier transform of a signal xa (t) is given below.
Xa (jω)
1
ω
π             π
−
2             2
This signal passes through the following system
xb (t)   uniform       xc [n]          xd [n] sample-to-   xe (t)
xa (t)      ×                                      K                                 H(jω)       xf (t)
sampler                                impulse
cos (7πt)
where xc [n] = xb (nT ) and
∞
0
xe (t) =            xd [n]δ(t − nT )
n=−∞
and
T    if |ω| < Tπ
n
H(jω) =
0    otherwise .
a. Sketch the Fourier transform of xf (t) for the case when K = 1 and T = 1. Label the
important features of your plot.
Xf (jω)
1
ω
π             π
−
2             2
Final Examination / 6.003: Signals and Systems (Fall 2009)                          15
b. Is it possible to adjust T and K so that xf (t) = xa (t)?
yes or no:
If yes, specify a value T and the corresponding value of K (there may be multiple
solutions, you need only specify one of them).
T =                                           K=
If no, brieﬂy explain why not.
Final Examination / 6.003: Signals and Systems (Fall 2009)                                 16
c. Is it possible to adjust T and K so that the Fourier transform of xf (t) is equal to the
following, and is zero outside the indicated range?
Xf (jω)
1
ω
3π −π         π             π   π   3π
−             −
2            2             2        2
yes or no:
If yes, specify all possible pairs of T and K that work in the table below. If there are
more rows in the table than are needed, leave the remaining entries blank.
T                       K
If no, brieﬂy explain why not.'), 'correct' => 3, 'answer' => 's that demonstrate some but not all of the important conceptual issues. Explanations are not required and will not aﬀect your grade. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four 8.5 × 11 sheets of paper (eight
Multiplied Sampling                            [16 points]
The Fourier transform of a signal xa (t) is given below.
Xa (jω)
1
ω
π             π
−
2             2
This signal passes through the following system
xb (t)   uniform       xc [n]          xd [n] sample-to-   xe (t)
xa (t)      ×                                      K                                 H(jω)       xf (t)
sampler                                impulse
cos (7πt)
where xc [n] = xb (nT ) and
∞
0
xe (t) =            xd [n]δ(t − nT )
n=−∞
and
T    if |ω| < Tπ
n
H(jω) =
0    otherwise .
a. Sketch the Fourier transform of xf (t) for the case when K = 1 and T = 1. Label the
important features of your plot.
Xf (jω)
1
ω
π             π
−
2             2
Final Examination / 6.003: Signals and Systems (Fall 2009)                          15
b. Is it possible to adjust T and K so that xf (t) = xa (t)?
yes or no:
If yes, specify a value T and the corresponding value of K (there may be multiple
solutions, you need only specify one of them).
T =                                           K=
If no, brieﬂy explain why not.
Final Examination / 6.003: Signals and Systems (Fall 2009)                                 16
c. Is it possible to adjust T and K so that the Fourier transform of xf (t) is equal to the
following, and is zero outside the indicated range?
Xf (jω)
1
ω
3π −π         π             π   π   3π
−             −
2            2             2        2
yes or no:
If yes, specify all possible pairs of T and K that work in the table below. If there are
more rows in the table than are needed, leave the remaining entries blank.
T                       K
If no, brieﬂy explain why not.', '_recupere_le' => '2026-11-04T19:55:22.630307+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Spring 2010) Final Examination                                               May 20, 2010 Name: Kerberos Username: Please circle your section number: Section    Instructor             Time 1       Peter Hagelstein       10 am 2       Peter Hagelstein       11 am 3       Rahul Sarpeshkar       1 pm 4       Rahul Sarpeshkar       2 pm Grades will be determined by the', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Z Transform                   [10 points]
Find the Z transform of x[n] deﬁned as
x[n] = αLn/3J u[n]
where α represents a positive real number, u[n] represents the unit-step function, and
In/3J represents the largest integer that is ≤ n/3. The signal x[n] is plotted below.
x[n]
α0
α1
α2
α34
α
n
−6           −3            0        3           6         9        12
Enter a closed-form expression for X(z) in the box below.
1 + z −1 + z −2
X(z) =
1 − αz −3
Enter the region of convergence of X(z) in the box below.
√
ROC =                                            |z| > | 3 α|
∞
c                         ∞
c
X(z) =           x[n]z −n =                      αn/3 z −n + αn/3 z −n−1 + αn/3 z −n−2
n=−∞                     n=0
n divisible by 3
∞
c                                    1 + z −1 + z −2
=         αm z −3m 1 + z −1 + z −2 =
m=0
1 − αz −3
√
where this sum converges iﬀ |αz −3 | < 1. Thus the region of convergence is |z| > | 3 α|.
2
Final Examination / 6.003: Signals and Systems (Spring 2010)', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four
Z Transform                [10 points]
Find the Z transform of x[n] deﬁned as
x[n] = αLn/3J u[n]
where α represents a positive real number, u[n] represents the unit-step function, and
In/3J represents the largest integer that is ≤ n/3. The signal x[n] is plotted below.
x[n]
α0
α1
α2
α34
α
n
−6       −3             0     3       6   9       12
Enter a closed-form expression for X(z) in the box below.
X(z) =
Enter the region of convergence of X(z) in the box below.
ROC =
2
Final Examination / 6.003: Signals and Systems (Spring 2010)', 'Pas ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four
z transform                [10 points]
find the z transform of x[n] deﬁned as
x[n] = αln/3j u[n]
where α represents a positive real number, u[n] represents the unit-step function, and
in/3j represents the largest integer that is ≤ n/3. the signal x[n] is plotted below.
x[n]
α0
α1
α2
α34
α
n
−6       −3             0     3       6   9       12
enter a closed-form expression for x(z) in the box below.
x(z) =
enter the region of convergence of x(z) in the box below.
roc =
2
final examination / 6.003: signals and systems (spring 2010)', 'L\'inverse de ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four
z transform                [10 points]
find the z transform of x[n] deﬁned as
x[n] = αln/3j u[n]
where α represents a positive real number, u[n] represents the unit-step function, and
in/3j represents the largest integer that is ≤ n/3. the signal x[n] is plotted below.
x[n]
α0
α1
α2
α34
α
n
−6       −3             0     3       6   9       12
enter a closed-form expression for x(z) in the box below.
x(z) =
enter the region of convergence of x(z) in the box below.
roc =
2
final examination / 6.003: signals and systems (spring 2010)', 'Impossible à déterminer'), 'correct' => 0, 'answer' => 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four
Z Transform                [10 points]
Find the Z transform of x[n] deﬁned as
x[n] = αLn/3J u[n]
where α represents a positive real number, u[n] represents the unit-step function, and
In/3J represents the largest integer that is ≤ n/3. The signal x[n] is plotted below.
x[n]
α0
α1
α2
α34
α
n
−6       −3             0     3       6   9       12
Enter a closed-form expression for X(z) in the box below.
X(z) =
Enter the region of convergence of X(z) in the box below.
ROC =
2
Final Examination / 6.003: Signals and Systems (Spring 2010)', '_recupere_le' => '2026-11-04T19:55:22.630772+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Spring 2010) Final Examination                                               May 20, 2010 Name: Kerberos Username: Please circle your section number: Section    Instructor             Time 1       Peter Hagelstein       10 am 2       Peter Hagelstein       11 am 3       Rahul Sarpeshkar       1 pm 4       Rahul Sarpeshkar       2 pm Grades will be determined by the', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : CT System Design                     [12 points]
We wish to design a linear, time-invariant, continuous-time system that is causal and
stable. For asymptotically low frequencies, the magnitude of the system’s frequency re­
sponse should be 4ω. For asymptotically high frequencies, the magnitude of the system’s
frequency response should be 100/ω.
Is it possible to design such a system so that the magnitude of its frequency response is
50 at ω = 5?
Yes or No:              Yes
If Yes, determine the poles of the resulting system.
√
poles:                              −1 ± j 24
If No, brieﬂy explain why not.
The asymptotic responses can be achieved with a zero at ω = 0 and two poles in the left half-plane,
so that the system function has the form
100s
H(s) = 2             .
s + αs + 25
Also, the magnitude at s = j5 is 50:
100 × j5      100
H(j5) =                  =     = 50 .
−25 + αj5 + 25    α
Therefore α = 2. Thus the poles are the roots of
s2 + 2s + 25
√               √
which are s = −1 ±     1 − 25 = −1 ± j 24.
3
Final Examination / 6.003: Signals and Systems (Spring 2010)', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('Pas ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four
ct system design                 [12 points]
we wish to design a linear, time-invariant, continuous-time system that is causal and
stable. for asymptotically low frequencies, the magnitude of the system’s frequency re­
sponse should be 4ω. for asymptotically high frequencies, the magnitude of the system’s
frequency response should be 100/ω.
is it possible to design such a system so that the magnitude of its frequency response is
50 at ω = 5?
yes or no:
if yes, determine the poles of the resulting system.
poles:
if no, brieﬂy explain why not.
3
final examination / 6.003: signals and systems (spring 2010)', 'Impossible à déterminer', 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four
CT System Design                 [12 points]
We wish to design a linear, time-invariant, continuous-time system that is causal and
stable. For asymptotically low frequencies, the magnitude of the system’s frequency re­
sponse should be 4ω. For asymptotically high frequencies, the magnitude of the system’s
frequency response should be 100/ω.
Is it possible to design such a system so that the magnitude of its frequency response is
50 at ω = 5?
Yes or No:
If Yes, determine the poles of the resulting system.
poles:
If No, brieﬂy explain why not.
3
Final Examination / 6.003: Signals and Systems (Spring 2010)', 'L\'inverse de ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four
ct system design                 [12 points]
we wish to design a linear, time-invariant, continuous-time system that is causal and
stable. for asymptotically low frequencies, the magnitude of the system’s frequency re­
sponse should be 4ω. for asymptotically high frequencies, the magnitude of the system’s
frequency response should be 100/ω.
is it possible to design such a system so that the magnitude of its frequency response is
50 at ω = 5?
yes or no:
if yes, determine the poles of the resulting system.
poles:
if no, brieﬂy explain why not.
3
final examination / 6.003: signals and systems (spring 2010)'), 'correct' => 2, 'answer' => 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four
CT System Design                 [12 points]
We wish to design a linear, time-invariant, continuous-time system that is causal and
stable. For asymptotically low frequencies, the magnitude of the system’s frequency re­
sponse should be 4ω. For asymptotically high frequencies, the magnitude of the system’s
frequency response should be 100/ω.
Is it possible to design such a system so that the magnitude of its frequency response is
50 at ω = 5?
Yes or No:
If Yes, determine the poles of the resulting system.
poles:
If No, brieﬂy explain why not.
3
Final Examination / 6.003: Signals and Systems (Spring 2010)', '_recupere_le' => '2026-11-04T19:55:22.631216+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Spring 2010) Final Examination                                               May 20, 2010 Name: Kerberos Username: Please circle your section number: Section    Instructor             Time 1       Peter Hagelstein       10 am 2       Peter Hagelstein       11 am 3       Rahul Sarpeshkar       1 pm 4       Rahul Sarpeshkar       2 pm Grades will be determined by the', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Frequency Responses               [18 points]
Match each system function in the left column below with the corresponding frequency
response magnitude in the right column.
Enter label of corresponding
frequency response magnitude                         magnitude A
(A-F or none) in box.                                      2
z3
H1 (z) = 3      →       F
z − 0.5
Ω
−π                   0                 π
magnitude B
2
z3 − 1
H2 (z) = 3      →       B
z − 0.5
Ω
−π                   0                 π
magnitude C
6
z3 + z2 + z
H3 (z) =               →   D
z 3 − 0.5
Ω
−π                   0                 π
magnitude D
6
z3
H4 (z) = 3      →       A
z + 0.5
Ω
−π                   0                 π
magnitude E
2
z3 + 1
H5 (z) = 3      →       E
z + 0.5
Ω
−π                   0                 π
magnitude F
2
z3 − z2 + z
H6 (z) =               →   C
z 3 + 0.5
Ω
−π                   0                 π
4
Final Examination / 6.003: Signals and Systems (Spring 2010)', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('Pas ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four
frequency responses               [18 points]
match each system function in the left column below with the corresponding frequency
response magnitude in the right column.
enter label of corresponding
frequency response magnitude                         magnitude a
(a-f or none) in box.                                      2
z3
h1 (z) = 3      →
z − 0.5
ω
−π                   0                 π
magnitude b
2
z3 − 1
h2 (z) = 3      →
z − 0.5
ω
−π                   0                 π
magnitude c
6
z3 + z2 + z
h3 (z) =               →
z 3 − 0.5
ω
−π                   0                 π
magnitude d
6
z3
h4 (z) = 3      →
z + 0.5
ω
−π                   0                 π
magnitude e
2
z3 + 1
h5 (z) = 3      →
z + 0.5
ω
−π                   0                 π
magnitude f
2
z3 − z2 + z
h6 (z) =               →
z 3 + 0.5
ω
−π                   0                 π
4
final examination / 6.003: signals and systems (spring 2010)', 'L\'inverse de ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four
frequency responses               [18 points]
match each system function in the left column below with the corresponding frequency
response magnitude in the right column.
enter label of corresponding
frequency response magnitude                         magnitude a
(a-f or none) in box.                                      2
z3
h1 (z) = 3      →
z − 0.5
ω
−π                   0                 π
magnitude b
2
z3 − 1
h2 (z) = 3      →
z − 0.5
ω
−π                   0                 π
magnitude c
6
z3 + z2 + z
h3 (z) =               →
z 3 − 0.5
ω
−π                   0                 π
magnitude d
6
z3
h4 (z) = 3      →
z + 0.5
ω
−π                   0                 π
magnitude e
2
z3 + 1
h5 (z) = 3      →
z + 0.5
ω
−π                   0                 π
magnitude f
2
z3 − z2 + z
h6 (z) =               →
z 3 + 0.5
ω
−π                   0                 π
4
final examination / 6.003: signals and systems (spring 2010)', 'Impossible à déterminer', 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four
Frequency Responses               [18 points]
Match each system function in the left column below with the corresponding frequency
response magnitude in the right column.
Enter label of corresponding
frequency response magnitude                         magnitude A
(A-F or none) in box.                                      2
z3
H1 (z) = 3      →
z − 0.5
Ω
−π                   0                 π
magnitude B
2
z3 − 1
H2 (z) = 3      →
z − 0.5
Ω
−π                   0                 π
magnitude C
6
z3 + z2 + z
H3 (z) =               →
z 3 − 0.5
Ω
−π                   0                 π
magnitude D
6
z3
H4 (z) = 3      →
z + 0.5
Ω
−π                   0                 π
magnitude E
2
z3 + 1
H5 (z) = 3      →
z + 0.5
Ω
−π                   0                 π
magnitude F
2
z3 − z2 + z
H6 (z) =               →
z 3 + 0.5
Ω
−π                   0                 π
4
Final Examination / 6.003: Signals and Systems (Spring 2010)'), 'correct' => 3, 'answer' => 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four
Frequency Responses               [18 points]
Match each system function in the left column below with the corresponding frequency
response magnitude in the right column.
Enter label of corresponding
frequency response magnitude                         magnitude A
(A-F or none) in box.                                      2
z3
H1 (z) = 3      →
z − 0.5
Ω
−π                   0                 π
magnitude B
2
z3 − 1
H2 (z) = 3      →
z − 0.5
Ω
−π                   0                 π
magnitude C
6
z3 + z2 + z
H3 (z) =               →
z 3 − 0.5
Ω
−π                   0                 π
magnitude D
6
z3
H4 (z) = 3      →
z + 0.5
Ω
−π                   0                 π
magnitude E
2
z3 + 1
H5 (z) = 3      →
z + 0.5
Ω
−π                   0                 π
magnitude F
2
z3 − z2 + z
H6 (z) =               →
z 3 + 0.5
Ω
−π                   0                 π
4
Final Examination / 6.003: Signals and Systems (Spring 2010)', '_recupere_le' => '2026-11-04T19:55:22.631879+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Spring 2010) Final Examination                                               May 20, 2010 Name: Kerberos Username: Please circle your section number: Section    Instructor             Time 1       Peter Hagelstein       10 am 2       Peter Hagelstein       11 am 3       Rahul Sarpeshkar       1 pm 4       Rahul Sarpeshkar       2 pm Grades will be determined by the', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Feedback Design                         [15 points]
Consider a feedback system of the following form
X         +            G             Y
−
where G represents a causal, linear, time-invariant, continuous-time system. The magni­
Y
tude of the frequency response of H = X    is speciﬁed by the straight-line approximation
shown below.
|H(jω)| [log scale]
1
2/9
2/27        0.1
2/90
0.01                                          ω [log scale]
0.1          1           10      100
2
The magnitude for asymptotically low frequencies is                      ≈ 0.074.
27
Determine G(s).        [You only need to ﬁnd one solution, even if others exist.]
2(s + 1)                   2(s − 1)                 −2(s + 1)                −2(s − 1)
G(s) =                        or                              or                       or
(s + 5)2               s2 + 10s + 29               s2 + 14s + 29            s2 + 14s + 25
The system function for H can be determined from the magntitude plot to be
2(s + 1)
H(s) =                  .
(s + 3)(s + 9)
The relation between G and H is given by Black’s equation
G
H=       .
1+G
This relation can be solved for G to yield
2(s+1)
H      (s+3)(s+9)                        2(s + 1)
G=       =                         =
1−H   1 − 2(s+1)(s+3)(s+9)
(s + 3)(s + 9) − 2(s + 1)
2(s + 1)            2(s + 1)    2(s + 1)
=                           = 2           =
s2 + 12s + 27 − 2s − 2  s + 10s + 25   (s + 5)2
Alternatively, the zero could be in the right half plane. Then
2(s − 1)
H(s) =
(s + 3)(s + 9)
and
5
Final Examination / 6.003: Signals and Systems (Spring 2010)
2(s−1)
H      (s+3)(s+9)                         2(s − 1)
G=     =                          =
1−H   1 − 2(s−1)  (s+3)(s+9)
(s + 3)(s + 9) − 2(s − 1)
2(s − 1)            2(s − 1)            2(s − 1)
=                          = 2           =
s2 + 12s + 27 − 2s + 2  s + 10s + 29   (s + 5 + j2)(s + 5 − j2)
For a third alternative, we could negate H(s) so that
2(s + 1)
H(s) = −                  .
(s + 3)(s + 9)
Then
2(s+1)
H     − (s+3)(s+9)           −2(s + 1)
G=     =       2(s+1)
=
1−H   1+              (s + 3)(s + 9) + 2(s + 1)
(s+3)(s+9)
−2(s + 1)           −2(s + 1)
=                          = 2
s2 + 12s + 27 + 2s + 2  s + 14s + 29
And ﬁnally, the zero could be in the right half plane with overall negation. Then
2(s − 1)
H(s) = −
(s + 3)(s + 9)
and
2(s−1)
H     − (s+3)(s+9)           −2(s − 1)
G=       =       2(s−1)
=
1−H   1+              (s + 3)(s + 9) + 2(s − 1)
(s+3)(s+9)
−2(s − 1)                 −2(s − 1)
=                              =
s2 + 12s + 27 + 2s − 2         s2 + 14s + 25
6
Final Examination / 6.003: Signals and Systems (Spring 2010)', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('Pas ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four
feedback design                 [15 points]
consider a feedback system of the following form
x         +           g         y
−
where g represents a causal, linear, time-invariant, continuous-time system. the magni-
y
tude of the frequency response of h = x    is speciﬁed by the straight-line approximation
shown below.
|h(jω)| [log scale]
1
2/9
2/27    0.1
2/90
0.01                                    ω [log scale]
0.1       1           10   100
2
the magnitude for asymptotically low frequencies is           ≈ 0.074.
27
determine g(s).     [you only need to ﬁnd one solution, even if others exist.]
g(s) =
5
final examination / 6.003: signals and systems (spring 2010)', 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four
Feedback Design                 [15 points]
Consider a feedback system of the following form
X         +           G         Y
−
where G represents a causal, linear, time-invariant, continuous-time system. The magni-
Y
tude of the frequency response of H = X    is speciﬁed by the straight-line approximation
shown below.
|H(jω)| [log scale]
1
2/9
2/27    0.1
2/90
0.01                                    ω [log scale]
0.1       1           10   100
2
The magnitude for asymptotically low frequencies is           ≈ 0.074.
27
Determine G(s).     [You only need to ﬁnd one solution, even if others exist.]
G(s) =
5
Final Examination / 6.003: Signals and Systems (Spring 2010)', 'Impossible à déterminer', 'L\'inverse de ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four
feedback design                 [15 points]
consider a feedback system of the following form
x         +           g         y
−
where g represents a causal, linear, time-invariant, continuous-time system. the magni-
y
tude of the frequency response of h = x    is speciﬁed by the straight-line approximation
shown below.
|h(jω)| [log scale]
1
2/9
2/27    0.1
2/90
0.01                                    ω [log scale]
0.1       1           10   100
2
the magnitude for asymptotically low frequencies is           ≈ 0.074.
27
determine g(s).     [you only need to ﬁnd one solution, even if others exist.]
g(s) =
5
final examination / 6.003: signals and systems (spring 2010)'), 'correct' => 1, 'answer' => 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four
Feedback Design                 [15 points]
Consider a feedback system of the following form
X         +           G         Y
−
where G represents a causal, linear, time-invariant, continuous-time system. The magni-
Y
tude of the frequency response of H = X    is speciﬁed by the straight-line approximation
shown below.
|H(jω)| [log scale]
1
2/9
2/27    0.1
2/90
0.01                                    ω [log scale]
0.1       1           10   100
2
The magnitude for asymptotically low frequencies is           ≈ 0.074.
27
Determine G(s).     [You only need to ﬁnd one solution, even if others exist.]
G(s) =
5
Final Examination / 6.003: Signals and Systems (Spring 2010)', '_recupere_le' => '2026-11-04T19:55:22.632373+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Spring 2010) Final Examination                                               May 20, 2010 Name: Kerberos Username: Please circle your section number: Section    Instructor             Time 1       Peter Hagelstein       10 am 2       Peter Hagelstein       11 am 3       Rahul Sarpeshkar       1 pm 4       Rahul Sarpeshkar       2 pm Grades will be determined by the', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Inverse Fourier                [15 points]
The magnitude and angle of the Fourier transform of x[n] are shown below.
magnitude
| sin Ω
2|
1
Ω
−2π                             0                 2π
angle
π
π/2
Ω
−2π                                               2π
−π/2
−π
Sketch and fully label x[n] on the axes below.
x[n]
1
2
n
1
− 12
Ω −jΩ/2        e jΩ/2 − e−jΩ/2            1      1
X(ejΩ ) = −j sin     e     = −j                    e−jΩ/2 = e−jΩ −
2                     j2                  2      2
�                         �                           � �
1                        1                            1                     �
x[n] =       X(e jΩ )e jΩn dΩ =          e−jΩ − 1 e jΩn dΩ =       e jΩ(n−1) − e jΩn dΩ
2π 2π                    4π 2π                        4π 2π
⎧
⎨ −1/2        n=0
= 1/2          n=1
⎩
0           otherwise
7
Final Examination / 6.003: Signals and Systems (Spring 2010)', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four
Inverse Fourier            [15 points]
The magnitude and angle of the Fourier transform of x[n] are shown below.
magnitude
| sin Ω
2|
1
Ω
−2π                      0                  2π
angle
π
π/2
Ω
−2π                                         2π
−π/2
−π
Sketch and fully label x[n] on the axes below.
x[n]
n
6
Final Examination / 6.003: Signals and Systems (Spring 2010)', 'Impossible à déterminer', 'Pas ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four
inverse fourier            [15 points]
the magnitude and angle of the fourier transform of x[n] are shown below.
magnitude
| sin ω
2|
1
ω
−2π                      0                  2π
angle
π
π/2
ω
−2π                                         2π
−π/2
−π
sketch and fully label x[n] on the axes below.
x[n]
n
6
final examination / 6.003: signals and systems (spring 2010)', 'L\'inverse de ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four
inverse fourier            [15 points]
the magnitude and angle of the fourier transform of x[n] are shown below.
magnitude
| sin ω
2|
1
ω
−2π                      0                  2π
angle
π
π/2
ω
−2π                                         2π
−π/2
−π
sketch and fully label x[n] on the axes below.
x[n]
n
6
final examination / 6.003: signals and systems (spring 2010)'), 'correct' => 0, 'answer' => 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four
Inverse Fourier            [15 points]
The magnitude and angle of the Fourier transform of x[n] are shown below.
magnitude
| sin Ω
2|
1
Ω
−2π                      0                  2π
angle
π
π/2
Ω
−2π                                         2π
−π/2
−π
Sketch and fully label x[n] on the axes below.
x[n]
n
6
Final Examination / 6.003: Signals and Systems (Spring 2010)', '_recupere_le' => '2026-11-04T19:55:22.632788+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Spring 2010) Final Examination                                               May 20, 2010 Name: Kerberos Username: Please circle your section number: Section    Instructor             Time 1       Peter Hagelstein       10 am 2       Peter Hagelstein       11 am 3       Rahul Sarpeshkar       1 pm 4       Rahul Sarpeshkar       2 pm Grades will be determined by the', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Taylor series                      [15 points]
Let xc (t) represent the convolution of xa (t) with xb (t) where
a0 + a1 t + a2!2 t2 + a3!3 t3 + · · · + ann! tn + · · · ; t > 0
xa (t) =
0                                                       ; otherwise
xb (t) =       b0 + b1 t + b2!2 t2 + b3!3 t3 + · · · + bnn! tn + · · · ; t > 0
0                                                       ; otherwise
c0 + c1 t + c2!2 t2 + c3!3 t3 + · · · + cnn! tn + · · · ; t > 0
xc (t) =
0                                                       ; otherwise
Determine expressions for the c coeﬃcients (c0 , c1 , ... cn ) in terms of the a coeﬃcients
(a0 , a1 , ... an ) and b coeﬃcients (b0 , b1 , ... bn ).
c0 =                                                                  0
c1 =                                                             a 0 b0
c2 =                                                       a1 b0 + a 0 b1
c3 =                                                   a2 b0 + a 1 b1 + a 0 b2
n
c
cn =                                                             an−k bk−1
k=1
∞                           ∞                           ∞ X
∞ 
!                           !
an                          bk                              an             b         
k k
X                           X                           X
n                           k
xc = xa ∗ xb =                   t u(t)       ∗              t u(t)       =                tn u(t) ∗    t u(t)
n=0
n!                          k!                    n=0 k=0
n!           k!
k=0
∞       c         ∞
X        n n
 X      cn
Xc (s) =         L   t u(t) =        n+1
n=0
n!           n=0
s
∞ X∞   a                          X ∞ X∞
X           n n
      bk k                an bk
= Xa (s)Xb (s) =       L       t u(t) × L      t u(t) =         n+k+2
n=0
n!              k!          n=0
s
k=0                                                      k=0
Equate terms with equal powers of s:
n
X
cn =         an−k bk−1
k=1
8
Final Examination / 6.003: Signals and Systems (Spring 2010)', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('L\'inverse de ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four
taylor series              [15 points]
let xc (t) represent the convolution of xa (t) with xb (t) where
a0 + a1 t + a2!2 t2 + a3!3 t3 + · · · + ann! tn + · · · ; t > 0
xa (t) =
0                                                       ; otherwise
xb (t) =   b0 + b1 t + b2!2 t2 + b3!3 t3 + · · · + bnn! tn + · · · ; t > 0
0                                                       ; otherwise
c0 + c1 t + c2!2 t2 + c3!3 t3 + · · · + cnn! tn + · · · ; t > 0
xc (t) =
0                                                       ; otherwise
determine expressions for the c coeﬃcients (c0 , c1 , ... cn ) in terms of the a coeﬃcients
(a0 , a1 , ... an ) and b coeﬃcients (b0 , b1 , ... bn ).
c0 =
c1 =
c2 =
c3 =
cn =
7
final examination / 6.003: signals and systems (spring 2010)', 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four
Taylor series              [15 points]
Let xc (t) represent the convolution of xa (t) with xb (t) where
a0 + a1 t + a2!2 t2 + a3!3 t3 + · · · + ann! tn + · · · ; t > 0
xa (t) =
0                                                       ; otherwise
xb (t) =   b0 + b1 t + b2!2 t2 + b3!3 t3 + · · · + bnn! tn + · · · ; t > 0
0                                                       ; otherwise
c0 + c1 t + c2!2 t2 + c3!3 t3 + · · · + cnn! tn + · · · ; t > 0
xc (t) =
0                                                       ; otherwise
Determine expressions for the c coeﬃcients (c0 , c1 , ... cn ) in terms of the a coeﬃcients
(a0 , a1 , ... an ) and b coeﬃcients (b0 , b1 , ... bn ).
c0 =
c1 =
c2 =
c3 =
cn =
7
Final Examination / 6.003: Signals and Systems (Spring 2010)', 'Impossible à déterminer', 'Pas ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four
taylor series              [15 points]
let xc (t) represent the convolution of xa (t) with xb (t) where
a0 + a1 t + a2!2 t2 + a3!3 t3 + · · · + ann! tn + · · · ; t > 0
xa (t) =
0                                                       ; otherwise
xb (t) =   b0 + b1 t + b2!2 t2 + b3!3 t3 + · · · + bnn! tn + · · · ; t > 0
0                                                       ; otherwise
c0 + c1 t + c2!2 t2 + c3!3 t3 + · · · + cnn! tn + · · · ; t > 0
xc (t) =
0                                                       ; otherwise
determine expressions for the c coeﬃcients (c0 , c1 , ... cn ) in terms of the a coeﬃcients
(a0 , a1 , ... an ) and b coeﬃcients (b0 , b1 , ... bn ).
c0 =
c1 =
c2 =
c3 =
cn =
7
final examination / 6.003: signals and systems (spring 2010)'), 'correct' => 1, 'answer' => 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four
Taylor series              [15 points]
Let xc (t) represent the convolution of xa (t) with xb (t) where
a0 + a1 t + a2!2 t2 + a3!3 t3 + · · · + ann! tn + · · · ; t > 0
xa (t) =
0                                                       ; otherwise
xb (t) =   b0 + b1 t + b2!2 t2 + b3!3 t3 + · · · + bnn! tn + · · · ; t > 0
0                                                       ; otherwise
c0 + c1 t + c2!2 t2 + c3!3 t3 + · · · + cnn! tn + · · · ; t > 0
xc (t) =
0                                                       ; otherwise
Determine expressions for the c coeﬃcients (c0 , c1 , ... cn ) in terms of the a coeﬃcients
(a0 , a1 , ... an ) and b coeﬃcients (b0 , b1 , ... bn ).
c0 =
c1 =
c2 =
c3 =
cn =
7
Final Examination / 6.003: Signals and Systems (Spring 2010)', '_recupere_le' => '2026-11-04T19:55:22.633343+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.003 — question d’examen, en anglais] 6.003 (Spring 2010) Final Examination                                               May 20, 2010 Name: Kerberos Username: Please circle your section number: Section    Instructor             Time 1       Peter Hagelstein       10 am 2       Peter Hagelstein       11 am 3       Rahul Sarpeshkar       1 pm 4       Rahul Sarpeshkar       2 pm Grades will be determined by the', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Modulated Sampling                         [15 points]
The Fourier transform of a signal xa (t) is given below.
Xa (jω)
1
ω
π             π
−
2             2
This signal passes through the following system
xb (t)     uniform       xc [n] =      sample-to- xd (t)
xa (t)      ×                                                              H(jω)     xe (t)
sampler       xb (nT )        impulse
cos ωm t
∞
c
where xd (t) =             xc [n]δ(t − nT ) and
n=−∞
H(jω) =        T    if |ω| < Tπ
0    otherwise .
The constants ωm and T can be diﬀerent in Parts a-c below.
Part a. Which (if any) of the waveforms on the following page could represent xb (t)?
A-F or none                 C
If your answer was A-F then specify the corresponding frequency ωm .
ωm =                               3π
The Fourier transform Xa (jω) can be written as the convolution of two rectangular pulses, each
with height of 2 for |ω| < π4 . Thus
2
sin πt

4
xa (t) = 4
πt
Modulation then produces
2
sin πt

4
xb (t) = 4             cos(ωm t)
πt
which corresponds to waveform C with ωm = 3π.
Final Examination / 6.003: Signals and Systems (Spring 2010)
A
t
−12        −8        −4                    4           8   12
B
t
−12        −8        −4                    4           8   12
C
t
−12        −8        −4                    4           8   12
D
t
−12        −8        −4                    4           8   12
E
t
−12        −8        −4                    4           8   12
F
t
−12        −8        −4                    4           8   12
10
Final Examination / 6.003: Signals and Systems (Spring 2010)
Part b. Sketch the Fourier transform of xe (t) for the case when ωm = 5π and T = 13 .
Label the important features of your plot.
Xe (jω)
1
2
ω
−π                     π
11
Final Examination / 6.003: Signals and Systems (Spring 2010)
Part c. Is it possible to adjust T so that Xe (jω) has the following form when ωm = 5π?
Xe (jω)
1
2
ω
−π                     π
yes or no:             yes
If yes, determine such a value of T (there may be multiple solutions, you need only
specify one of them).
4         4          8        4
T =          11   or    9    or    9   or   3
If no, brieﬂy explain why not.', 'source' => 'MIT OpenCourseWare, 6.003 Signals And Systems, Fall 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four
Modulated Sampling                         [15 points]
The Fourier transform of a signal xa (t) is given below.
Xa (jω)
1
ω
π             π
−
2             2
This signal passes through the following system
xb (t)     uniform       xc [n] =      sample-to- xd (t)
xa (t)      ×                                                              H(jω)   xe (t)
sampler       xb (nT )        impulse
cos ωm t
∞
0
where xd (t) =             xc [n]δ(t − nT ) and
n=−∞
H(jω) =        T    if |ω| < Tπ
0    otherwise .
The constants ωm and T can be diﬀerent in Parts a-c below.
Part a. Which (if any) of the waveforms on the following page could represent xb (t)?
A-F or none
If your answer was A-F then specify the corresponding frequency ωm .
ωm =
If your answer was none then brieﬂy explain why.
8
Final Examination / 6.003: Signals and Systems (Spring 2010)
A
t
−12        −8        −4                    4           8   12
B
t
−12        −8        −4                    4           8   12
C
t
−12        −8        −4                    4           8   12
D
t
−12        −8        −4                    4           8   12
E
t
−12        −8        −4                    4           8   12
F
t
−12        −8        −4                    4           8   12
9
Final Examination / 6.003: Signals and Systems (Spring 2010)
Part b. Sketch the Fourier transform of xe (t) for the case when ωm = 5π and T = 13 .
Label the important features of your plot.
Xe (jω)
ω
10
Final Examination / 6.003: Signals and Systems (Spring 2010)
Part c. Is it possible to adjust T so that Xe (jω) has the following form when ωm = 5π?
Xe (jω)
1
2
ω
−π                     π
yes or no:
If yes, determine such a value of T (there may be multiple solutions, you need only
specify one of them).
T =
If no, brieﬂy explain why not.', 'L\'inverse de ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four
modulated sampling                         [15 points]
the fourier transform of a signal xa (t) is given below.
xa (jω)
1
ω
π             π
−
2             2
this signal passes through the following system
xb (t)     uniform       xc [n] =      sample-to- xd (t)
xa (t)      ×                                                              h(jω)   xe (t)
sampler       xb (nt )        impulse
cos ωm t
∞
0
where xd (t) =             xc [n]δ(t − nt ) and
n=−∞
h(jω) =        t    if |ω| < tπ
0    otherwise .
the constants ωm and t can be diﬀerent in parts a-c below.
part a. which (if any) of the waveforms on the following page could represent xb (t)?
a-f or none
if your answer was a-f then specify the corresponding frequency ωm .
ωm =
if your answer was none then brieﬂy explain why.
8
final examination / 6.003: signals and systems (spring 2010)
a
t
−12        −8        −4                    4           8   12
b
t
−12        −8        −4                    4           8   12
c
t
−12        −8        −4                    4           8   12
d
t
−12        −8        −4                    4           8   12
e
t
−12        −8        −4                    4           8   12
f
t
−12        −8        −4                    4           8   12
9
final examination / 6.003: signals and systems (spring 2010)
part b. sketch the fourier transform of xe (t) for the case when ωm = 5π and t = 13 .
label the important features of your plot.
xe (jω)
ω
10
final examination / 6.003: signals and systems (spring 2010)
part c. is it possible to adjust t so that xe (jω) has the following form when ωm = 5π?
xe (jω)
1
2
ω
−π                     π
yes or no:
if yes, determine such a value of t (there may be multiple solutions, you need only
specify one of them).
t =
if no, brieﬂy explain why not.', 'Pas ness of your answers (explanations are not required). partial credit will be given for answers that demonstrate some but not all of the important conceptual issues. you have three hours. please put your initials on all subsequent sheets. enter your answers in the boxes. this quiz is closed book, but you may use four
modulated sampling                         [15 points]
the fourier transform of a signal xa (t) is given below.
xa (jω)
1
ω
π             π
−
2             2
this signal passes through the following system
xb (t)     uniform       xc [n] =      sample-to- xd (t)
xa (t)      ×                                                              h(jω)   xe (t)
sampler       xb (nt )        impulse
cos ωm t
∞
0
where xd (t) =             xc [n]δ(t − nt ) and
n=−∞
h(jω) =        t    if |ω| < tπ
0    otherwise .
the constants ωm and t can be diﬀerent in parts a-c below.
part a. which (if any) of the waveforms on the following page could represent xb (t)?
a-f or none
if your answer was a-f then specify the corresponding frequency ωm .
ωm =
if your answer was none then brieﬂy explain why.
8
final examination / 6.003: signals and systems (spring 2010)
a
t
−12        −8        −4                    4           8   12
b
t
−12        −8        −4                    4           8   12
c
t
−12        −8        −4                    4           8   12
d
t
−12        −8        −4                    4           8   12
e
t
−12        −8        −4                    4           8   12
f
t
−12        −8        −4                    4           8   12
9
final examination / 6.003: signals and systems (spring 2010)
part b. sketch the fourier transform of xe (t) for the case when ωm = 5π and t = 13 .
label the important features of your plot.
xe (jω)
ω
10
final examination / 6.003: signals and systems (spring 2010)
part c. is it possible to adjust t so that xe (jω) has the following form when ωm = 5π?
xe (jω)
1
2
ω
−π                     π
yes or no:
if yes, determine such a value of t (there may be multiple solutions, you need only
specify one of them).
t =
if no, brieﬂy explain why not.', 'Impossible à déterminer'), 'correct' => 0, 'answer' => 'ness of your answers (explanations are not required). Partial credit will be given for ANSWERS that demonstrate some but not all of the important conceptual issues. You have three hours. Please put your initials on all subsequent sheets. Enter your answers in the boxes. This quiz is closed book, but you may use four
Modulated Sampling                         [15 points]
The Fourier transform of a signal xa (t) is given below.
Xa (jω)
1
ω
π             π
−
2             2
This signal passes through the following system
xb (t)     uniform       xc [n] =      sample-to- xd (t)
xa (t)      ×                                                              H(jω)   xe (t)
sampler       xb (nT )        impulse
cos ωm t
∞
0
where xd (t) =             xc [n]δ(t − nT ) and
n=−∞
H(jω) =        T    if |ω| < Tπ
0    otherwise .
The constants ωm and T can be diﬀerent in Parts a-c below.
Part a. Which (if any) of the waveforms on the following page could represent xb (t)?
A-F or none
If your answer was A-F then specify the corresponding frequency ωm .
ωm =
If your answer was none then brieﬂy explain why.
8
Final Examination / 6.003: Signals and Systems (Spring 2010)
A
t
−12        −8        −4                    4           8   12
B
t
−12        −8        −4                    4           8   12
C
t
−12        −8        −4                    4           8   12
D
t
−12        −8        −4                    4           8   12
E
t
−12        −8        −4                    4           8   12
F
t
−12        −8        −4                    4           8   12
9
Final Examination / 6.003: Signals and Systems (Spring 2010)
Part b. Sketch the Fourier transform of xe (t) for the case when ωm = 5π and T = 13 .
Label the important features of your plot.
Xe (jω)
ω
10
Final Examination / 6.003: Signals and Systems (Spring 2010)
Part c. Is it possible to adjust T so that Xe (jω) has the following form when ωm = 5π?
Xe (jω)
1
2
ω
−π                     π
yes or no:
If yes, determine such a value of T (there may be multiple solutions, you need only
specify one of them).
T =
If no, brieﬂy explain why not.', '_recupere_le' => '2026-11-04T19:55:22.634292+00:00Z', '_strategie' => 'separation_enum_solution'),
						),
					),
				),
			),
		);
	}
}
