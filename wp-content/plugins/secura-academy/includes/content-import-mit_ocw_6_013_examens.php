<?php
/**
 * Questions importees — MIT OpenCourseWare — 6 013 electromagnetics and applications spring 2009
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_013_examens' ) ) {
	function seca_import_mit_ocw_6_013_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-013-examens', 'nom' => 'MIT OpenCourseWare — 6 013 electromagnetics and applications spring 2009', 'url' => 'https://ocw.mit.edu/courses/6-013-electromagnetics-and-applications-spring-2009/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'les-fondamentaux-du-reseau' => array(
					'title' => 'les-fondamentaux-du-reseau',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(25/200 points)
Two square capacitor plates in air have                            +Q         d
separation d, sides of length b, and charge ±Q as              εo        -Q
illustrated. Fringing fields can be neglected.                                 b
b
What is the capacitance Ca of this device?
Ca =
Please turn sheet over to answer parts (b) and (c).
-1-                                    5/16/09', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : What is the capacitance Ca of this device?
Ca = ob2/d
Ca = oA/d = ob2/d', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(25/200 points)
Two square capacitor plates in air have                            +Q         d
separation d, sides of length b, and charge ±Q as              εo        -Q
illustrated. Fringing fields can be neglected.                                 b
b
A perfectly conducting plate is introduced                      d/10
between the capacitor plates, leaving parallel gaps                            +Q    εo       d
of width d/10 above and below itself. What now is      y     σ=∞               -Q
the device capacitance Cb when it is fully inserted?         x                      b
z
L
Cb =', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : A perfectly conducting plate is introduced
between the capacitor plates, leaving parallel gaps
Cb = 5ob2/d
of width d/10 above and below itself. What now is
the device capacitance Cb when it is fully inserted?
Cb = Ca’/2 = ob2/2(d/10) = 5ob2/d', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(20/200 points)
The plate separation of a lossless parallel-plate TEM line many wavelengths long
(length D = 100.25λ) very slowly increases from end A to end B, as illustrated. This
increases the characteristic impedance of the line from Zo at the input end A, to 4Zo at
the output end B. This transition from A to B is so gradual that it produces no
reflections. End B is terminated with a resistor of value 4Zo
A                  100.25                        B
ZA    +
-                                               4Zo +-        4Zo
VA       Zo
VB
What is the input impedance ZA seen at end A? Explain briefly.
ZA =
Explanation:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : What is the input impedance ZA seen at end A?                     ZA = Zo []
Explanation: Line is matched:
Explain briefly.                                                no reflections.', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(20/200 points)
The plate separation of a lossless parallel-plate TEM line many wavelengths long
(length D = 100.25λ) very slowly increases from end A to end B, as illustrated. This
increases the characteristic impedance of the line from Zo at the input end A, to 4Zo at
the output end B. This transition from A to B is so gradual that it produces no
reflections. End B is terminated with a resistor of value 4Zo
A                  100.25                        B
ZA    +
-                                               4Zo +-        4Zo
VA       Zo
VB
If the sinusoidal (complex) input input voltage is VA, what is the output voltage VB?
VB =
Please turn sheet over for Problem 3.
-3-                                      5/16/09', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If the sinusoidal (complex) input input voltage is VA, what is the output voltage VB?
Pin = Pout so |VA|2/2Zo = |VB|2/8Zo  |VB| = 2|VA|               VB = -2jVA [V]
e-j/2 = -j', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(25/200 points)
t=0
At t = 0 a switch connects a voltage V to a          +
passive air-filled short-circuited TEM line of                   V      iA(t)    Zo, c                 iB(t)
length D and characteristic impedance Zo, as                 -
illustrated. Please sketch and quantify dimension:                                z         z=D
0
The line voltage v(z) at t = D/2c.
V(z) at t =D/2c
z
0                                       D', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The line voltage v(z) at t = D/2c.
V(z) at t =D/2c
V
z
0                         D/2                  D', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(25/200 points)
t=0
At t = 0 a switch connects a voltage V to a          +
passive air-filled short-circuited TEM line of                   V      iA(t)    Zo, c                 iB(t)
length D and characteristic impedance Zo, as                 -
illustrated. Please sketch and quantify dimension:                                z         z=D
0
The current iB(t) through the short circuit for 0 < t < 2D/c.
iB(t)
t
0                                       2D/c', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The current iB(t) through the short circuit for 0 < t < 2D/c.
iB(t)
2V/Zo
t
0                         D/c                  2D/c
-2-                                                 7/13/09', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(25/200 points)
t=0
At t = 0 a switch connects a voltage V to a          +
passive air-filled short-circuited TEM line of                   V      iA(t)    Zo, c                 iB(t)
length D and characteristic impedance Zo, as                 -
illustrated. Please sketch and quantify dimension:                                z         z=D
0
The current iA(t) from the voltage source (z = 0) for 0 < t < 3D/c.
IA(t)
t
0                                       3D/c
-4-                                          5/16/09', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The current iA(t) from the voltage
IA(t)
source (z = 0) for 0 < t < 3D/c.
3V/Zo
V/Zo
t
0                             2D/c        3D/c', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(30/200 points)
R = 100 
A 100-ohm air-filled lossless TEM line is
C = 10-10/2π [F]
terminated with a 100-ohm resistor and a                      Zo = 100 
10-10/2π Farad capacitor in series, as illustrated.
It is driven at 100 MHz.                                                             z
0
What fraction F = |ΓL|2 of the incident
power is reflected from this load?                 F=', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : What fraction F = |L|2 of the incident
power is reflected from this load?                     F = 1/5
Zn = 0.01(100 + 1/(j210810-10/2) = 1 – j
 = (Zn – 1)/(Zn + 1) = -j/(2 – j), ||2 = F = (1/50.5)2 = 1/5', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(30/200 points)
R = 100 
A 100-ohm air-filled lossless TEM line is
C = 10-10/2π [F]
terminated with a 100-ohm resistor and a                      Zo = 100 
10-10/2π Farad capacitor in series, as illustrated.
It is driven at 100 MHz.                                                             z
0
What is the minimum distance D(meters) from the load at which the line current
|I(z)| is maximum? You may express your answer in terms of the angle
β(degrees) shown on the Smith Chart.
β degrees             Dmin =
Rn = 1
jXn = j
jXn = 0
|ΓL|
jXn = -j
Toward
generator
Please turn sheet over to answer part (c).
-5-                                      5/16/09', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : What is the minimum distance D(meters) from the load at which the line current
|I(z)| is maximum? You may express your answer in terms of the angle
β(degrees) shown on the Smith Chart.
 degrees             Dmin = 3/8 + /240 [m]
Rn = 1
jXn = j
Dmin = l/8 + /720 = 3(/8 + /720)
jXn = 0
 = c/f = 3×108/108
|L|
jXn = -j
Toward               Can we match? YES
generator', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(30/200 points)
R = 100 
A 100-ohm air-filled lossless TEM line is
C = 10-10/2π [F]
terminated with a 100-ohm resistor and a                      Zo = 100 
10-10/2π Farad capacitor in series, as illustrated.
It is driven at 100 MHz.                                                             z
0
Can we match this load by adding another       Can we match? YES NO
capacitor in series somewhere and, if so, at
what distance D and with what value Cm?        D=
Cm =
-6-                          5/16/09', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Can we match this load by adding another                  D = ¾ + /120 [m]
capacitor in series somewhere and, if so, at
what distance D and with what value Cm?                   Cm = 10-10/2
-3-                                          7/13/09', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(20/200 points)
z
A flat perfect conductor has a surface current in the                           y
xy plane at z = 0 of:                                                  θ
Js
–jbx                                              =∞                         x
Js = x̂ Joe          [A/m].
Approximately what is⎯H in the xy plane at z = 0+?
⎯H(z = 0+) =', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Approximately what isH in the xy plane at z = 0+?              H(z = 0+) = - ŷ Joe-jbx
To induce this current one', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(20/200 points)
z
A flat perfect conductor has a surface current in the                           y
xy plane at z = 0 of:                                                  θ
Js
–jbx                                              =∞                         x
Js = x̂ Joe          [A/m].
How might one easily induce this current sheet at frequency f [Hz] on the surface of
a good conductor? Please be reasonably specific and quantitative.
To induce this current one
might:
Please turn sheet over for Problem 6.
-7-                                      5/16/09', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : How might one easily induce this current sheet
might: Reflect a TM wave
at frequency f [Hz] on the surface of a good
incident from  =  and  =
conductor? Please be reasonably specific and
quantitative (not absolute phase).                          sin-1 (bo/2), where o < 2/b
and |Hy| = Jo/2.', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(25/200 points)
x                  d
A resonator is filled with a dielectric having                     b
ε = 4εo and has dimensions b, a, and d along the x,                                    z
y, and z directions, respectively, where d > a > b.                                     ε = 4εo
y
a
What is the lowest resonant frequency fm,n,q [Hz]        fm,n,q [Hz] =
for this resonator?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : What is the lowest resonant frequency fm,n,q [Hz]          fm,n,q = c[(1/2a)2 + (1/2b)2]0.5/2
for this resonator?
fmnp = (c/2)[(m/a)2 + (n/b)2+ (p/d)2]0.5 = c[(1/2a)2 + (1/2b)2]0.5
= c[(1/2a)2 + (1/2b)2]0.5/2', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(25/200 points)
x                  d
A resonator is filled with a dielectric having                     b
ε = 4εo and has dimensions b, a, and d along the x,                                    z
y, and z directions, respectively, where d > a > b.                                     ε = 4εo
y
a
What is the polarization of the electric vector⎯E at the center of the resonator for this
lowest frequency mode?
Polarization of ⎯E is:
Please turn sheet over to answer part (c).
-9-                                               5/16/09', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : What is the polarization of the electric
vectorE at the center of the resonator for         Polarization of E is: x̂ (linear)
this lowest frequency mode?', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(25/200 points)
x                  d
A resonator is filled with a dielectric having                     b
ε = 4εo and has dimensions b, a, and d along the x,                                    z
y, and z directions, respectively, where d > a > b.                                     ε = 4εo
y
a
What is the Q of this resonance if the dielectric has a slight conductivity σ? Hint: a
ratio of integrals may suffice, so the integrals might not need to be computed.
Q =
- 10 -                                     5/16/09', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : What is the Q of this resonance if the dielectric has a slight conductivity ? Hint: a
ratio of integrals may suffice, so the integrals might not need to be computed.
Q = (o)(a-2 + d-2)
Q = woWT/Pd = 2f101 [2V (o|E|2/4)dV]/[ V (|E|2/2)dV
= 2f101/ = (o)(a-2 + d-2)
-4-                                                      7/13/09', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(20/200 points)
A certain transmitter transmits PT watts of circularly polarized radiation with antenna
gain Go (in circular polarization) toward an optimally oriented matched short-dipole
receiving antenna (gain = 1.5) located a distance R away. The wavelength is .
R/2                         Obstacle
PT [W]
at         Go                                                              Prec [W]
A
Circular
polarization
R
In the absence of any obstacles or                   PR =
reflections, what power PR is received?
Please turn sheet over to answer part (b).
- 11 -                                     5/16/09', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : In the absence of any obstacles or
PR = 0.75 PTGo(/4R)2
reflections, what power PR is received?
PR = (PTGo/4R2) Ae, Ae = 0.5 1.52/4', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(20/200 points)
A certain transmitter transmits PT watts of circularly polarized radiation with antenna
gain Go (in circular polarization) toward an optimally oriented matched short-dipole
receiving antenna (gain = 1.5) located a distance R away. The wavelength is .
R/2                         Obstacle
PT [W]
at         Go                                                              Prec [W]
A
Circular
polarization
R
A large metal fence is then erected half way
between the transmitter and receiver, and         PR =
perpendicular to the line of sight. Fortunately
it has a round hole of area A centered on that
line of sight. Assume the hole is sufficiently
small that the electrical phase of the incident
wave is constant over its entirety. What power
is received now?
- 12 -               5/16/09', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : A large metal fence is then erected half way
between the transmitter and receiver, and            PR = 0.75PTGo(A/R2)2 [W]
perpendicular to the line of sight. Fortunately
it has a round hole of area A centered on that
line of sight. Assume the hole is sufficiently
small that the electrical phase of the incident
wave is constant over its entirety. What power
is received now?', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(15/200 points)
An ideal lossless three-level laser has the illustrated energy          E2
level structure. Level 1 is  Joules above the ground state, and                     [J]
Level 2 is 3 Joules above the ground state. All rates of                  E1
[J]
spontaneous emission Aij have the same finite value except for             E0
A21, which is infinite.
What should be the laser frequency fL [Hz]?           fL [Hz] =', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : What should be the laser frequency fL [Hz]?             fL [Hz] = /h
E = hf', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(15/200 points)
An ideal lossless three-level laser has the illustrated energy          E2
level structure. Level 1 is  Joules above the ground state, and                     [J]
Level 2 is 3 Joules above the ground state. All rates of                  E1
[J]
spontaneous emission Aij have the same finite value except for             E0
A21, which is infinite.
What is this laser’s maximum possible                 η=
efficiency η = (laser power)/(pump power)?
Please turn sheet over for Problem 10.
- 13 -                            5/16/09', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : What is this laser’s maximum possible efficiency η = (laser power)/(pump power)?
η = 1/3
-5-                                      7/13/09', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
Problem 2
GIVEN
      
˜ jωt , where Ẽ is a phasor, then what is
If the electric ﬁeld is E(t) =  Ee
E(t) if
FIND
E = 1 - j        (b) E = ejπ/4 - 1      (c) ⎯E = j x̂ + (1 - j) ŷ', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Ẽ = 1 − j
WORK
ejωt = cos(ωt) + j sin(ωt) by Euler’s theory. If Ẽ = Ẽr + jẼi , where Ẽr and
Ẽi are both real quantities, then
                         
˜ jωt
Ee = Ẽr cos(ωt) − Ẽi sin(ωt) + j Ẽi cos(ωt) + Ẽr sin(ωt) ,          (2.1)
the real part of which is
˜ jωt ) = E˜r cos(ωt) − E˜i sin(ωt).
E(t) = (Ee                                                (2.2)
Alternatively, Ẽ may be expressed as the product of a magnitude and an
exponential,
                               
  jφ                               ˜
Ẽ = Ẽ  e where φ = arctan EE˜ i . Then
r
                  
˜ jωt = E˜  ej(ωt+φ) = Ẽ  (cos(ωt + φ) + j sin(ωt + φ)) ,
Ee                                                                  (2.3)
the real part of which is
 
jωt   
˜
E(t) = (Ee ) = E˜r  cos(ωt + φ).                     (2.4)
Now, turn the crank and apply trigonometric identities to get more mean-
ingful answers. In (a), E˜r = 1 and E˜i = −1, so
√
E(t) = cos(ωt) + sin(ωt) = 2 sin(ωt + 45◦ )
◦
√ Also, the phase angle, φ, is arctan(−1) = −45 , while the magnitude is
2, so
√                     √
E(t) = 2 cos(ωt − 45◦ ) = 2 sin ωt + 45◦
3
FIND
Ẽ if E(t) = x̂ cos(ωt) + ŷ sin(ωt + π/4).
WORK
The ŷ-component is identiﬁed immediately as the same result of the inverse
problem in part(a), so again, Ẽy = 1 − j. By inspection, the x̂ component
has a phase angle of φ = 0 and unity magnitude, so Ẽx = 1. Then
(1 − j)
Ẽ = x̂ + ŷ 
(2)
Useful Matlab Commands
Ep = exp(j*pi/4)-1 %Define complex phasor. You can use "i" instead of "j".
angle(Ep) %Get phase angle of phasor.
angle(Ep)*180/pi %Get phase angle of phasor in degrees.
abs(Ep) %Get magnitude of phasor.
%You could also do symbolic manipulation...
syms w t
real( Ep*exp(j*w*t) )
%...but you wouldn’t like the result (try it).
%Plot the phasor in the complex plane.
polar([0 angle(Ep)], [0 abs(Ep)])
5', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
What is the force f⊥ [N] attracting the two plates in the y direction?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Using the force/energy equation, we know that the force attracting the two plates will be equal to the
partial derivative of the stored energy in the system with respect to the changing variable (in this case, d).
f⊥ = ∂w
∂d
e
2
We know that the energy stored in a capacitor with a ﬁxed charge Q on the plates is ωe = Q d
2εA , so the force
attracting the two plates is
2       2
∂ Q d    Q
f⊥ = ∂w
∂d = ∂d 2εA = 2εA
e
Noting that Q = εAV
d  we can cast the result in terms of the applied voltage
V 2 ε◦ bL
f⊥ =                                                         (1)
2d2
It’s also possible to solve this problem using the pressure due to the electric ﬁeld on the conductor, f¯ = −Pe A.
−ε E 2
We know Pe = ◦2 ◦ , and we can relate E and A to the voltage and dimensions of the overlap.
2           2
f = −Pe A = ε2◦dV2 bL = V 2εd◦2bL
Which is the same as the result using the force/energy relation.', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
and briefly explain your design.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Consider a ring with outer radius R, and width w, having N segments (N/2 segments are conducting
plates, see diagram below).
By these conditions, each segment has angular width
Θwidth = 2Nπ
1
If we place this ring above an identical ring, than the area of overlap of conducting plates will go from zero
to (2wR − w2 )π as Θ goes from zero to Θwidth . So we can express the overlap area as a function of Θ by
A = (2wR − w2 ) N4 Θ = A◦ Θ,
where A◦ is a constant (with respect to Θ). Using this expression, we can calculate capacitance as a function
of Θ,
εA◦
C = εA
d = s Θ = C◦ Θ
where d is the separation between the two rings.
The stored energy in the overlap is
2       2
Q
we = 2C = 2CQ◦ Θ
giving a torque
2                 2
−Q ∂               Q 2d
T = − ∂w
∂Θ = 2C◦ ∂Θ Θ
e           −1
= εN (2wR−w 2 )Θ2
If we take the case of one ring, with w = R and N = 4, then the above expression becomes equation 6.2.14
from the notes.
From the notes, we know that the power from the %50 duty cycle is P = T ω/2. We know that the angular
velocity will be limited by the maximum speed of the outer edge, wmax = vmax /R. So the mechanical power
obtained from one ring is
(2wR − w2 )N ε◦ Ebd
2
dvmax
P ower =                                                          (3)
16R
To get the highest power, we want to put as many segments as possible into the total allowed volume.
This will happen when we make w and d as small as possible and R as large as possible (d = 0.5 [mm],
w = 4d = 2 [mm]).
vol = 1 [L] = 0.001 [m3 ] = dπ(R2 − (R − w)2 ) = dπ(2Rw − w2 ) = π(R8d2 − 16d3 )
R = 0.001
8πd2 + 4d = 159.16 [m]
If we limit the length of any one segment to 4d to reduce the fringing ﬁelds, we can ﬁt N = 2πR
4d = 500015.8
(but we need N to be an even whole number, so choose N = 500014) segments on the ring. So the total
mechanical power becomes:
(2wR−w2 )N ε◦ Ebd
2
dvmax                             2
)×500014×(8.85×10−12 )×(0.0005)×100 2
P ower =            16R            = (2×0.002×159.16−16×(0.002) 16×159.16                           Ebd
P ower = 5.53 × 10−11 Ebd
2
For Ebd = 106 [V /m] this becomes P ower = 55.3 [W ]', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
Please sketch the general geometry you assumed for your maximum-power motor in', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : To get the maximum power we want to have a high number of segments, but to reduce fringing ﬁelds
there is a limit to how small we can make any individual segment. Since we were not told how to make the
structure, we put all the volume into a single ring with a 159 m radius. This neglects any material used to
drive and support the structure. See diagram below.
2', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
To help gauge the plausibility of your answer to (c), evaluate Pmax for the case Ebd =
106 [V/m].', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : P ower = 55.3 [W ], and the ring has a radius of 159.16 [m].', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
What is the maximum voltage V (numerical value) induced across the ~3340-km
diameter of Io by this moving magnetic field?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : From the Lorentz force law, we know that electrons moving with velocity v̄ will experience a force
f¯ = −e(E¯ + v̄ × µ◦ H̄ ). In the case of a conductor moving through a magnetic ﬁeld, this force will cause
electrons to move within the conductor until the electric forces due to the distribution of electrons balance
the magnetic forces due to the conductors motion.
Using the notation in the following diagram, we can pretend that Io is moving through the magnetic ﬁeld
¯ = −ŷ 10−4 [A/m] with velocity v̄ = ẑ 7200[m/s].
H        µ◦
If the electric and magnetic forces are balanced, than f is zero, so we can solve for the electric ﬁeld in terms
of the magnetic ﬁeld.
f¯ = −e(E
¯ + v̄ × µ◦ H̄) = 0
¯ = −v̄ × µ◦ H
E            ¯ = −ˆ
z v × −ˆ
y µ◦ H
¯ = −x̂µ◦ vH
E
Noting that the ﬁeld is constant within the conductor, we know that the potential diﬀerence V across the
conductor will be the product of the ﬁeld and the length of the conductor, V = Ed (in this case, d is the
width of Io).
V = dµ◦ vH = (3340 × 103 )(7200)(10−4 ) = 2.4 × 106 [V ].
Knowing the direction of the induced electric ﬁeld, −x̂, we can determine that the side of Io closest to Jupiter
will accumulate a negative charge (if no other current path exists).', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
This voltage produces a current I that flows through a weak plasma along the
magnetic field lines down to Jupiter’s ionosphere and back, and then through the full
diameter of Io, with a total circuit resistance of about one ohm. What is the resulting
magnetic force vector f [N] on Io? Does this force tend to accelerate Io or slow it
down in its orbit about Jupiter (Io moves in the same direction Jupiter is
rotating)?⎯Explain briefly with a sketch showing the directions of the current through
Io and the force on Io.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Electrons will ﬂow from the side of Io closest Jupiter, along the magnetic ﬁeld lines, through Jupiter’s
ionosphere, and back to the Io. Through Io this results in a ﬂow of electrons along −x̂ (see diagram), with
a current
6
I¯ = x̂ 2.4×10
1Ω
[V ]
3
The force exerted on Io by the magnetic ﬁeld, due to the current, will be
6
¯ ◦ d = x̂ 2.4×10 [V ] × −ŷ(10−4 )(3340 × 103 )
f¯ = I¯ × Hµ             1Ω
f¯ = −ẑ 801.6 × 106 [N ]
This force speeds up Io’s movement around Jupiter.
2         6 2', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
What mechanical power P [W] is being applied to Io (numerical value)? This can be
compared to the ~1 GW electrical power typically radiated in radio and television
broadcast bands by these Io-generated currents.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : P = VR = (2.4×10
1
)
= 5.76 × 1012 [W atts]', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
What is the force f pulling the gap closed?        I
+      N                        d
V', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : To ﬁnd the force pulling the gap closed apply the force energy equation to the energy stored in the
device. In the capacitor case, the constant was total charge on one of the plates. In the case for the inductor
we’ll look at constant Λ = Li (short circuit the coil while still allowing current to ﬂow). The energy stored
2
in an inductor is wm = 2ΛL [J] by equation 3.2.23 and 3.2.16. So, the force pulling the gap closed is
2   2             2
f = ∂w    ∂ Λ     Λ ∂     d         Λ
∂d = ∂d 2L = 2 ∂d µ◦ N 2 A = 2µ◦ N 2 A
m
Which reduces to:
µ◦ N 2 Ai2
f=                                                       (6)
2d2
It is also possible to solve this problem using the pressure on the surface of the rod at the gap due to the
magnetic ﬁeld.
2       2         2     2
f = Pm A = µ◦2H A = µ◦ A(N
2d2
i)
A = µ◦ N Ai
2d2
Which is the same result as above.', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
What is L when there is no gap?                    -
A', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : When d = 0 there is no gap, so the H ﬁeld inside the iron cylinder becomes H = Hµ = NDi giving an
inductance of
µN 2 A
L=                                                   (7)
D', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
Sketch the approximate vector magnetic
field B outside the torus.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The B ¯ ﬁeld emerges from the high permeability torus nearly at right angles, and therefore representative
B¯ ﬁeld lines might include those illustrated here (plus others, not drawn).', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
If the wire is superconducting and the situation is static, the inductor voltage V = 0. If
now we mechanically force d → 2d in τ seconds with I held constant, what is V(t)
during this period? One could make a sensor this way, perhaps a microphone.
-2-                                        2/13/09
6.013 Electromagnetics and Applications
Spring 2009
For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : From equation 3.2.13 we know that the voltage across the coil is the derivative of the ﬂux linkage, Λ.
The ﬂux linkage is
2
Λ = Li = µ◦ Nd A i
We can express d as a function of time using
d(t) = d(1 + τt )
giving ∂d∂t(t) = τd
5
so the volatage across the coil will be
∂Λ  ∂ µ◦ N 2 A    −iµ◦ N 2 A
V =       = i         =                  (8)
∂t  ∂t d(t)      dτ (1 + t/τ )2
for 0 < t < τ .
Note that this voltage jumps from 0 at t = 0− to some value at t = 0+ .
6
6.013 Electromagnetics and Applications
Spring 2009
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
Sketch the total electric fieldE(x,y,t) for z < 0 and t = 0 for the waves of part (c).
DHS 3/18/09
6.013 Electromagnetics and Applications
Spring 2009
For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : First ﬁnd the real electric ﬁeld.
√                     √                √
E(x, y, z, t) = Re{Ee ¯ jωt } = Re{ √E◦ jkx/ 2 jωt
e        e (−ˆ  x2jsin(kz/ 2) + ẑ2cos(kz/ 2))}
¯                 2
√                 kx       kz
√             kx        kz
E(x, y, z, t) = x̂ 2E◦ sin(ωt + √    2
)sin( √ 2
) + ẑ 2E◦ cos(ωt + √ 2
)cos( √ 2
)
At t = 0 this becomes
√         kx        kz
√         kx        kz
E(x, y, z, t) = x̂ 2E◦ sin( √ 2
)sin( √ 2
) + ẑ 2E◦ cos( √ 2
)cos( √ 2
)
For a wave with wavelength λ, we can use k = 2λπ to get
√        √           √            √        √           √
E(x, y, z, t) = x̂ 2E◦ sin( 2π λx )sin( 2π λz ) + ẑ 2E◦ cos( 2π λx )cos( 2π λz )
We want to sketch the electric ﬁeld lines. We do this in a couple of steps, ﬁrst identiﬁng lines where the ﬁeld
is completly along x̂ or ẑ, then sketching the components along the line, and ﬁnally connecting the sketched
lines.
Step 1
From the above expression for the real electric ﬁeld we know that the ﬁeld will be only along ẑ when z = n √λ2 ,
λ
and the ﬁeld will be completly along x̂ when z = (2n − 1) 2√ 2
.
Step 2
Along these lines we sketch the electric ﬁeld vectors (just pick a few interesting points). See sketch.
6
Step 3
Now we connect the arrows drawn in step 2 to see the electric ﬁeld lines. See sketch below.
7
6.013 Electromagnetics and Applications
Spring 2009
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(a)
Based on the second
figure, what is the
1 volt                                                                Load = ZL Ω
unknown complex
load impedance ZL? A           0                                                                          z
Smith chart is attached                                                     z = - λ/8 0
and may be used.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : In this case, we can calculate VSWR and |Γ|.
¯
V SW R = 21 = 2, |Γ| = VV SW R−1
SW R+1 = 2−1
2+1 = 1
3
¯
Again, at a voltage minimum the reﬂection coeﬃcient is Γ|V min = −|Γ| = − 13 . So at the voltage minimum,
¯
the normalized impedance is
1+Γ
Z |V min = 1−¯Γ = 1−1/3   1
1+1/3 = 2
¯             ¯
From this point we can either solve the problem using a Smith Chart or by using equation 7.2.24.
1
To solve using a Smith Chart ﬁrst ﬁnd the point corresponding to ZN = 0.5. Next draw the |Γ| = const
circle. Finally, rotate from the ZN = 0.5 point toward the load by λ8 . The new point is the normalized load
impedance at the load. Based on the attached Smith Chart, ZL = Z◦ (0.8 − 0.6j).
To solve using equation 7.2.24, ﬁrst observe that when z = − λ8 , tan(kz) = tan( 2π −λ
λ 8 ) = tan(−π/4) = −1
L +jZ◦
Z( −λ )N = 21 = Z
¯ 8             Z◦ +jZL
0.5Z◦ + 0.5jZL = ZL + jZ◦
ZL (1 − 0.5j) = Z◦ (0.5 − j)
ZL = Z◦ 10−.50−.5jj = Z◦ 12−−2jj × 2+j
2+j
= Z◦ 4−53j = Z◦ (0.8 − 0.6j)
Which is the same as the answer from the Smith Chart.', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(a)
The load of part (b) is matched using a capacitor Cm shunting the TEM line at z = -Am; what
values of Cm and Am produce a match with minimum Am? A second Smith chart is attached
and may be used. “Shunting” means placed across the line rather than in series with it.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : For shunt matching it is easier to work with admittances. The admittance of a capacitor is YC = jωC >
0, so we need to ﬁnd the ﬁrst point on the line where the input admittance as a real part of 1 (matched)
and negative imaginary part (so that the admittance of the capacitor can cancel it out). Again, it’s possible
to solve this problem using a equation 7.2.24 or the Smith Chart.
To solve using the Smith Chart, ﬁrst locate the load impedance. Next draw the circle of constant |Γ|, and
¯
ﬁnd the point λ/2 from the load. This is the admittance of the load. Follow the constant |Γ| circle to the
¯
point it crosses the Re(Y ) = 1 circle, with a negative imaginary value. This is the point at which we can
¯
match the load with a shunt capacitance.
From the Smith Chart, we can match at z = −0.2225λ with a capacitance C = 0.7/(ωZ◦ ).
We can also solve this problem using equation 7.2.24. First we solve for the normalized admittance:
Z −j Z tan(kz)     Z −j Z tan(kz) Z ∗ +jZ tan(kz)       Z Z ∗ +jZ 2 tan(kz)−jZ Z ∗ tan(kz)+Z Z tan2 (kz)
YN = Z1N = Z◦L −jZ L            ◦
¯ tan(kz) = Z −jZ
L
¯L
¯ tan(kz) Z
◦
∗ +jZ tan(kz) =
◦ L
¯     ◦            L L
|ZL |2 −2ZLI Z◦¯tan(kz)+Z
¯       2
L ◦
¯2
¯                   ◦           L  ◦               ◦                                        ◦ tan (kz)
¯     ¯                ¯             ¯L                     ¯
Where ZLI is the imaginary part of the load impedance. To match the load, we need to ﬁnd a place where
the real part of the complex admittance is 1.
2
Z◦ ZLR +ZLR Z◦ tan (kz)
Re(YN ) = 1 = |ZL |2 −2Imag(Z                2    2
L )Z◦ tan(kz)+Z◦ tan (kz)
¯           ¯
We can plug in the known load impedance, and divide top and bottom by Z◦2 to get:
2
0.8+0.8tan (kz)
1 = 1+1.2tan(kz)+tan 2 (kz)
tan2 (kz) + 1.2tan(kz) + 1 = 0.8 + 0.8tan2 (kz)
0.2tan2 (kz) + 1.2tan(kz) + 0.2 = 0
tan2 (kz) + 6tan(kz) + 1 = 0
We can solve for tan(kz) using the quadratic formula
√
62 −4∗1∗1
√
tan(kz) = −6± 2∗1         = −3 ± 2 2
√
λ
z = 2π arctan(−3 ± 2 2)
Giving two possible solutions z = −0.02704λ, and z = −0.22296λ. Adding some multiple of 0.5λ to either
of these solutions will also satisify the Re(Y ) = 1 condition since tan(kz) is periodic, so we actually have an
¯
inﬁnite number of possible match points. For simplicity we’ll take the ﬁrst point that meets our requirements.
By plugging these distances into the impedance equation, we see that z = −0.22296λ is the solution we
want. At this point the input admittance is:
2
Yn = 1−j(0.8−j0.6)tan(−2π0.22296)
(0.8−j0.6)−jtan(−2π0.22296) ≈ 1 − j0.7071
¯
So we can match the load by placing a shunt capacitance of C = 0.7071/(ωZ◦ ) at position z = −0.22296λ
Blank chart © Black Magic Design. All rights reserved. This content is excluded from our Creative Commons
license. For more information, see
3
Blank chart © Black Magic Design. All rights reserved. This content is excluded from our Creative Commons
license. For more information, see
4', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(a)
f [Hz]?                    |V(z)|max
(ii) VSWR?
|V(z)|min                                                          Load = RL
(iii) Zo [Ohms]?
(iv) C [F/m] of the line?                  0                                                                  z
0', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : For an air ﬁlled line we know that the propagation velocity is c◦ . Looking at the ﬁgure we see the
distance between adjacent voltage minima is A, so the wavelength is λ = 2A. The frequency of the wave is
given by the ratio of the propagation velocity to the wavelength:
8
f = λp = 3×10  1.5   8
v
2A = A × 10 [Hz]
(ii) The voltage standing wave ratio is the ratio of the maximum voltage on the line to the minimum voltage
on the line:
|V (z)|
V SW R = |¯V (z)|max
min
¯
Z −1
(iii) At a voltage minima (at the load in this case) we know that Γ = −|Γ| = Z n
¯ +1 . So we can write:
¯     ¯    ¯
n
1+Γ   1−|Γ|1
Z(z = 0)N = R  L
Z◦ = 1−¯ Γ = 1+|Γ|
¯ = V SW R
¯                     ¯      ¯
We can solve this for Z◦
|V (z)|
RL
Z◦ = Z(z=0) n
= RL × V SW R = RL |¯V (z)|max
min
¯                           ¯
1
(iv) We know that the velocity of propagation on the line is Vp = √LC        , and that the characteristic

L
impedance of the line is Z◦ = C  , so the Capacitance per unit length of the line is
C = Vp1Z◦ = (3×108 )R1L V SW R [F/m]', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(a)
L [Hy/m] of the line?                           z=-A
(vi) Γ?
(vii) Fraction of power                    |V(z)|
reflected by the load?
2 volts', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Using the same relations as in part (iv) we know that the inductance per unit length will be
L= Z ◦
Vp =
RL V SW R
3×108
(vi) We know that the magnitude of the reﬂection coeﬃcient is given by
|Γ| = VV SW R−1
SW R+1
¯
and that at z = 0 the reﬂection coeﬃcient is Γ = −|Γ
¯     ¯
So the reﬂection coeﬃcient is
Γ(z) = − VV SW R−1 j2πz/A
SW R+1 e
¯
(vii) The fraction of the power reﬂected by the load is the square of the magnitude of the reﬂection coeﬃcient
          2
P−      V SW R−1
P+  =   V SW R+1', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
The VSWR = 3 on the twin lead antenna feed wire, and the bulb is brightest one meter from
the antenna port. What is the complex impedance ZA of the antenna port?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : From the VSWR we can determine the magnitude of the reﬂection coeﬃcient. The point where the bulb
is brightest will correspond to a current maximum (Γ(z) = −|Γ|).
¯        ¯
3−1   2    1
|Γ| = VV SW R−1
SW R+1  =  3+1 = 4 =  2
¯
2π λ
Γ(−λ/4) = − 12 = ΓL e−j2kλ/4 = ΓL e−j2 λ 4
¯                   ¯            ¯
4π λ
ΓL = − 12 ej λ 4 = − 12 ejπ = 21
¯
1+Γ
ZLN = 1−¯ΓLL = 1.50.5 = 3
¯          ¯
ZL = ZLN Z◦ = 3 × 300 = 900 [Ω]
¯      ¯', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
The ham now wants to add in either series or parallel with the antenna feed line the shortest
possible short-circuited stub of 300-ohm twin-lead wire that would achieve a near-perfect
match for the antenna. (i) How long should this stub be (S), (ii) should it be in series or
parallel with the feed line, and (iii) how far (A) from the antenna port should it be attached?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : It’s possible to match the load using a short-circuited stub in series or in parallel with the antenna feed
line. The position and length of the stub will likely be diﬀerent in each case, so we need to test both methods
and pick the one that results in the shortest stub length.
We could work the problem exactly for each matching statagie, or we can use the Smith Chart to get the
approximate solutions and then do the exact solution for the case predicted to be shorter. Since I like using
the Smith Chart that’s how we’ll solve the problem. The Smith Chart solutions are attached at the end of
this problem solution. The method for each solution is described below.
Smith Chart Series Match
To ﬁnd a match using the stub in series we work with impedances.
(1) First locate the normalized load point on the Smith Chart.
(2) Next draw the circle of constant |Γ|. There are two possible match positions. These positions occur when
¯
the circle of constant |Γ| crosses the Re{Zn } = 1 circle. The imaginary component of the short-circuited
¯                  ¯
stub impedance goes positive (from zero) before going negative, so we want the match point where the load
has a negative imaginary component of impedance.
(3) From the match point we can read oﬀ the value of the imaginary component of impedance (−j1.16Z◦ ),
and get the position ((0.333 − 0.25)λ = λ/12 towards generator). Next we ﬁnd the length of the stub needed
to match the load at this point.
(4) First ﬁnd the stub impedance point (Zn = 0, position = 0 λ towards generator). Next ﬁnd the point
corresponding to an impedance of j1.16Z◦ (position = 0.136 λ towards generator). The diﬀerence in positions
is the length of the stub needed to match the load (0.136λ = 0.544 [m]).
Smith Chart Parallel Match
To ﬁnd a match using the stub in parallel it is easier to work with admittances.
(1) First locate the normalized load point on the Smith Chart.
(2) Next draw the circle of constant |Γ|. Rotate about this circle by λ/4 to ﬁnd the normalized load
¯
admittance.
(3) Identify the two possible match positions. These positions occur when the circle of constant |Γ| crosses
¯
the Re{Yn } = 1 circle. The imaginary component of the short-circuited stub admittance goes negative
¯
(from inﬁnity) before going positive, so we want the match point where the load has a positive imaginary
component of admittance.
(4) From the match point we can read oﬀ the value of the imaginary component of admittance (+j1.155Z◦ ),
and get the position (0.1675λ towards generator). Next we ﬁnd the length of the stub needed to match the
5
load at this point.
(5) First ﬁnd the stub impedance point (Zn = 0, position = 0 λ towards generator). Now rotate by λ/4
to get the stub admittance (inﬁnity, position λ/4). Next ﬁnd the point corresponding to an admittance of
j − 1.155Z◦ (position = 0.363 λ towards generator). The diﬀerence in positions is the length of the stub
needed to match the load (0.113λ = 0.4544 [m]).
From the Smith Chart results, we know that we can match the load using the shortest short-circuited stub
when we place the stub in parallel with the feed line.
Exact Solution to the Parallel Match
◦ −jZL tan(kz)
Yn (z) = Z
ZL −jZ◦ tan(kz)
¯
Z◦ −jZL tan(kz)     L +jZ◦ tan(kz)          1                   2             2                    2
Yn (z) = Z L −jZ◦ tan(kz)
∗Z                  2 +Z 2 tan2 (kz) Z◦ ZL + jZ◦ tan(kz) − jZL tan(kz) + ZL Z◦ tan (kz)
ZL +jZ◦ tan(kz) = ZL
¯                                                 ◦
1                          2
Re{Yn (z)} = 1 = Z 2 +Z 2 tan2 (kz) Z◦ ZL + ZL Z◦ tan (kz)
¯              L    ◦
ZL2 + Z◦2 tan2 (kz) = Z◦ ZL + ZL Z◦ tan2 (kz)
ZL2 − Z◦ ZL = tan2 (kz)(ZL Z◦ − Z◦2 )
 2                               √
Z −Z◦ ZL        9002 −300∗900
tan(kz) = ± ZLL Z◦ −Z  2 = ±   900∗300−3002 = ± 3
◦
kz = ± π3 ,
z = − λ6 (this is the sign that will work for us).
Plugging this back into the expression for impedance we get
√
Y (−λ/6) = Y◦ (1 + j 3 23 )
¯
√
So our stub has to have an admittance of −j 3 23 Y◦ .
√
jY◦
YS = tan(kz) = −j 3 32 Y◦
¯
√
tan(kz) = − 23
√
2π        −1      3
λ z = tan   (− 2 )
√
λ
z = 2π tan−1 (− 23 ) = −0.1136λ = −0.4544 [m]
So,
(i) The stub should be 0.4544 meters long
(ii) The stub should be in parallel with the feed line
(iii) The stub should be placed λ6 = 23 meters from the antenna port
6
7
8
Problem Set 7 Draft Solution Problem 7.3', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
- jZo             (b)                            - jZo
Zo, c                    Zo                    Zo, c                      Zo
λ/2                                            3λ/4
Zo', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : For a half-wave line, the input impedance is just the load impedance.', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
+             (d)                        +
Zo, c               V                           Zo, c        V
-                                        -
λ/4                                             λ/4
Hint: For parts (c) and (d) it may be helpful to use the basic equations for V(z) and I(z) to relate
voltages at one position to those at another.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : In this case the problem is a little more complicated. The Thevenin equivalent resistance will be Z◦ . To
ﬁnd the open circuit voltage, we need to think about the standing wave pattern that results in the steady
state.
At the input (from the sources point of view) of the transmission line, the line’s equivalent impedance is zero
V
(the λ/4 transform of an open circuit). So the current has to be IT = ¯ZS◦ . This gives us two equations:
VT = 0 = V+ + V− = (I+ + I− )Z◦
V
IT = ¯ZS◦ = I+ − I−
V
The ﬁrst equation tells us that I− = −I+ , and when we put this into the second equation we get I+ = 2¯ZS◦ .
V
Using this we can get V+ = ¯2S . At the open circuit the voltage will be twice the forward going voltage
(since the reﬂection coeﬃcient is 1 at an open circuit). Finally, we know that the open circuit voltage will
lag behind the source voltage by a quarter wave (φ = kz = − 2λπ λ4 = − π2 ).
π
So the Thevenin voltage will be VT hevenin = VS e−j 2 .
¯', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
Assume (for this problem) that the solar cell ε = 4εo, and that in the absence of reflections
the cell yields constant power over the wavelength band 0.4-0.6 microns and zero
elsewhere. Approximately what coating thickness d and permittivity εcoat would be best?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Assume we want to match at normal incidence, and at the center of the wavelength band given (0.5μm).
Further, assume that we can neglect reﬂections from the back of the solar cell. We can approximate this
problem as a quarter wave line matching problem. The impedance of one line will be Z◦ = η◦ and the
¯
impedance of the second line will be ZL = ηL .
¯
We know from the notes that the impedance of the line used to match the two materials should be Za =
¯
(Z◦ ZL )0.5 , so we have the following relation
            
ηa = μεa◦ = ( με◦◦ εμL◦ )0.5 = ( √εμ◦◦εL )0.5
So we need to choose
√
εa = ε◦ εL = 2ε◦
√    0.5
For this value of ε, a free-space wavelength of 0.5μm has wavelength λ = λ◦ / 2 = √ 2
[μm]. The coating
thickness will be one quarter of this value.
1
d = 8√ 2
[μm] ≈ 88 [nm]', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
What fraction of the solar power is reflected at one-micron wavelength by your coating?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : At one micron, the layer will be λ8 thick, so we know the apparent impedance at the surface of the
coating will be
L +jZa            η ε−0.5 +jη ε−0.5
−0.5 ◦ a                          ε0.5 +jε0.5
Zin = Za Z
Za +jZL = η◦ εa
◦ L
η ε−0.5 +jη ε−0.5
= η◦ ε−0.5
a
a      L
ε0.5 +jε0.5
◦ L       ◦ a               L      a
√
Zin  √1   2+j2
√
Z◦ =   2 2+j 2
Zin
−1
Γ = ZZin
◦
¯    Z◦ +1
The fraction of the power reﬂected is |Γ|2 , which is
¯
|Γ|2 = 0.059, at one micron.
¯
11
Problem Set 7 Draft Solution Problem 7.5', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
What are L and C for a parallel resonance?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : For a parallel RLC resonance, we have the following relations
                    
Q=R C   L which  tells us   C
L = Q/R = 0.2
1
√
ω = √LC  = 2π × 106 which tells us LC = (2π × 106 )−1 .
√ L                          1     1
L = LC C     = (2π × 106 )−1 × 0.2   = 4π × 10−5
√ 
C = LC C   L = (2π × 10 )
6 −1
× 0.2 = π1 × 10−7', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
We now wish to add a lossless 1-MHz bandpass filter, as illustrated, to a 100-ohm amplifier
so that the combination is matched to a 100-ohm transmission line at resonance, yields a 3
dB bandwidth of 50 MHz, and approaches a short circuit far from resonance. Please sketch
the arrangement of parts inside the filter and indicate their numerical values.
-2
The Complete Smith Chart
Black Magic Design
0.12                    0.13
0.11                                                                             0.14
0.38                  0.37                                                     0.15
0.1                          0.39                                                                           0.36
90
0.4                         100                                                                      80                            0.35                         0.1
0   .09                                                                                                                                                                                              6
45
50
1                110                                                                                                             40                            70                0.3
0.4
1.0
4
0.9
1.2
0.1
55
.08
0.8
0                                                                                                                                                                                                                                                        7
35
1.4
2                                                                                                                                                                                                                                   0.3
0.7
0.4               0                                                                                                                                                                                                              60           3
12
0.6 60
)
/Yo
1.6
0.1
0.0
7                                                                            (+jB                                                                                                                                                                            30                                        8
CE                                                                                                                                                                                                                                0.3
3                                                AN
0.4
1.8
PT                                                                                               0.2                                                                                                                                       2
CE                                                                                                                                                                                                                                     50
65
0                                         S
13                                         SU
2.0
VE
0.5
06
0.
TI                                                                                                                                                                                                                                                         25
19
CI
0.
44
0.
PA
31
0.
CA
70
R
,O                                                                                                                                              0.4
o)
0
40
14
4
5
0.
0.2
0.0
/Z
5
20
0.3
jX
0.4
(+
3.0
T
75
EN
0.6
N
PO
4
0.2
0.0
0.3
OM
0
6
0.2
1
30
15
0.4
9
EC
0.8                                                                                                                                                15
>
R—
4.0
80
NC
TO
TA
1.0
0.22
AC
ERA
0.47
0.28
5.0
RE
1.0
GEN
0.2
0
IVE
20
85
1 6
10
UCT
ARD
8
0.
0.23
IND
S TOW
0.48
0.27
ANG
90
0.6
ANG
LE OF
NGTH
10
LE OF
0
0.1
17
0.4
TRANSM
0.0 —> WAVELE
0.24
0.49
0.26
REFLECTION COEFFICIENT IN DE
20
0.2
ISSION COEFFICIENT IN
50
0.1
0.2
0.3
0.4
0.5
0.6
0.7
0.8
0.9
1.0
1.2
1.4
1.6
1.8
2.0
3.0
4.0
5.0
10
20
50
0.25
0.25
± 180
0.0
50
RESISTANCE COMPONENT (R/Zo), OR CONDUCTANCE COMPONENT (G/Yo)
AD <—
0.2
20
0.24
O
0.49
0.26
D  L
0.4
70
R
0.1
DEGR
OWA
-1
G
10
RE
T
ES
EES
0.6
-90
0.23
S
)
0.48
0.27
TH
/Yo
G
(-jB
8
N
0.                                                                                                                                                                     -10
E
CE
L
0
-85
-20
6
E
0.2
1
AV
AN
1.0
-
5.0
0.22
W
T
7
0.28
0.4
P
1.0
<—
CE
US
-15 -80
4.0
ES
0.8                                                                                                                                                -15
IV
4
0.2
0
-30
T
0.0
0.3
C
6
0.2
1
0.4
DU
9
IN
0.6
-75
R
3.0
O
),
5
Zo
-20
0.2
0.0
X/
5
4                                                                                                                                                                                                                                                                                                                                            0.3
0.4
0.              (-j
40
-4
-1
0
T                                                                                                                                   0.4
EN
-70
N
PO
06
0.
19
0.
M
CO                                                                                                                                                                                                                                                                     -25
44
0.
0.5
31
0.
E
2.0
30                                                  NC                                                                                                                                                                                                                               -5
TA                                                                                                                                                                                                                                    0
-65
-1
7                                           AC                                                                                                  0.2                                                                                                                                      0.1
1.8
E
0.0                                        VE
R                                                                                                                                                                                                                                          8
0.6
ITI                                                                                                                                                                                                                                                        0.3
3
0.4                                           AC                                                                                                                                                                                                                 -30                                   2
1.6
CAP
-60
0                                                                                                                                                                                              -60       0.1
8                        -12
0.7
0.0                                                                                                                                                                                                                                      7
1.4
2                                                                                                                                                                                                    -35                                                0.3
0.8
0.4                                                                                                                                                                                                                                                3
1.2
-55
0.9
0.1
1.0
9                                                                                                                                                                   -70
0.0                 -110                                                                                                            0                                               6
-4
0
-5
5
0.3
-4
1
0.4                         0.1                      -100                                                                           -80                        0.15                         4
-90
0.11                                                                      0.14                            0.35
0.4                                                       0.12                  0.13
0.39                                                                             0.36
0.38                    0.37
O (C dB O ]
F
. C K SS [ SS C [dB
RADIALLY SCALED PARAMETERS
EF
.
N P L L EN
P)
TOWARD LOAD —>                                                                                             <— TOWARD GENERATOR
SW d S [d EFF , E o
RT
A W. L. W. TT
EF O ]
P T.
∞100 40
SM EA O O
20             10                               5              4                      3             2.5                 2        1.8         1.6         1.4             1.2 1.1 1          15               10     7        5                                        4                     3                            2           1
F, NS
N
TR S. RF S. A
R BS B] , P r I
. L L. OE
RF L. C
O CO FF
∞ 40 30                                                                                                                                                                                                                                                                                                                                                                                                                              ∞
RF
20                    15                                         10                     8                6          5          4           3         2         1      1 1                                         1.1               1.2         1.3 1.4                1.6         1.8    2                             3         4         5                   10        20
S
0                                1               2               3                 4              5               6            7        8     9         10          12         14                  20          30 ∞ 0                          0.1           0.2               0.4         0.6     0.8       1                1.5              2                   3          4         5         6                  10 15 ∞
I
or
E
1                   0.9         0.8      0.7         0.6       0.5                0.4                0.3                    0.2                      0.1                 0.05                     0.01           0 0                 1.1               1.2             1.3           1.4        1.5      1.6 1.7 1.8 1.9 2                                             2.5         3                   4         5          10 ∞
F,
EF
O
1                           0.9                 0.8              0.7                    0.6                   0.5                      0.4               0.3                   0.2                 0.1           0 1                 0.99                    0.95                0.9                        0.8                0.7                 0.6            0.5        0.4           0.3         0.2           0.1            0
.C
SM
CENTER
N
A
TR
0.0                              0.1                 0.2              0.3                    0.4                   0.5                      0.6               0.7                   0.8                 0.9            1                  1.1                  1.2                  1.3                1.4                  1.5                1.6                    1.7              1.8                   1.9                         2
ORIGIN
© Black Magic Design. All rights reserved. This content is excluded from our Creative Commons license.
For more information, see
The Complete Smith Chart
Black Magic Design
0.12                    0.13
0.11                                                                             0.14
0.38                  0.37                                                     0.15
0.1                          0.39                                                                           0.36
90
0.4                         100                                                                      80                            0.35                         0.1
0   .09                                                                                                                                                                                              6
45
50
1                110                                                                                                             40                            70                0.3
0.4
1.0
4
0.9
1.2
0.1
55
.08
0.8
0                                                                                                                                                                                                                                                        7
35
1.4
2                                                                                                                                                                                                                                   0.3
0.7
0.4               0                                                                                                                                                                                                              60           3
12
0.6 60
)
/Yo
1.6
0.1
0.0
7                                                                            (+jB                                                                                                                                                                            30                                        8
CE                                                                                                                                                                                                                                0.3
3                                                AN
0.4
1.8
PT                                                                                               0.2                                                                                                                                       2
CE                                                                                                                                                                                                                                     50
65
0                                         S
13                                         SU
2.0
VE
0.5
06
0.
TI                                                                                                                                                                                                                                                         25
19
CI
0.
44
0.
PA
31
0.
CA
70
R
,O                                                                                                                                              0.4
o)
0
40
14
4
5
0.
0.2
0.0
/Z
5
20
0.3
jX
0.4
(+
3.0
T
75
EN
0.6
N
PO
4
0.2
0.0
0.3
OM
0
6
0.2
1
30
15
0.4
9
EC
0.8                                                                                                                                                15
>
R—
4.0
80
NC
TO
TA
1.0
0.22
AC
ERA
0.47
0.28
5.0
RE
1.0
GEN
0.2
0
IVE
20
85
1 6
10
UCT
ARD
8
0.
0.23
IND
S TOW
0.48
0.27
ANG
90
0.6
ANG
LE OF
NGTH
10
LE OF
0
0.1
17
0.4
TRANSM
0.0 —> WAVELE
0.24
0.49
0.26
REFLECTION COEFFICIENT IN DE
20
0.2
ISSION COEFFICIENT IN
50
0.1
0.2
0.3
0.4
0.5
0.6
0.7
0.8
0.9
1.0
1.2
1.4
1.6
1.8
2.0
3.0
4.0
5.0
10
20
50
0.25
0.25
± 180
0.0
50
RESISTANCE COMPONENT (R/Zo), OR CONDUCTANCE COMPONENT (G/Yo)
AD <—
0.2
20
0.24
O
0.49
0.26
D  L
0.4
70
R
0.1
DEGR
OWA
-1
G
10
RE
T
ES
EES
0.6
-90
0.23
S
)
0.48
0.27
TH
/Yo
G
(-jB
8
N
0.                                                                                                                                                                     -10
E
CE
L
0
-85
-20
6
E
0.2
1
AV
AN
1.0
-
5.0
0.22
W
T
7
0.28
0.4
P
1.0
<—
CE
US
-15 -80
4.0
ES
0.8                                                                                                                                                -15
IV
4
0.2
0
-30
T
0.0
0.3
C
6
0.2
1
0.4
DU
9
IN
0.6
-75
R
3.0
O
),
5
Zo
-20
0.2
0.0
X/
5
4                                                                                                                                                                                                                                                                                                                                            0.3
0.4
0.              (-j
40
-4
-1
0
T                                                                                                                                   0.4
EN
-70
N
PO
06
0.
19
0.
M
CO                                                                                                                                                                                                                                                                     -25
44
0.
0.5
31
0.
E
2.0
30                                                  NC                                                                                                                                                                                                                               -5
TA                                                                                                                                                                                                                                    0
-65
-1
7                                           AC                                                                                                  0.2                                                                                                                                      0.1
1.8
E
0.0                                        VE
R                                                                                                                                                                                                                                          8
0.6
ITI                                                                                                                                                                                                                                                        0.3
3
0.4                                           AC                                                                                                                                                                                                                 -30                                   2
1.6
CAP
-60
0                                                                                                                                                                                              -60       0.1
8                        -12
0.7
0.0                                                                                                                                                                                                                                      7
1.4
2                                                                                                                                                                                                    -35                                                0.3
0.8
0.4                                                                                                                                                                                                                                                3
1.2
-55
0.9
0.1
1.0
9                                                                                                                                                                   -70
0.0                 -110                                                                                                            0                                               6
-4
0
-5
5
0.3
-4
1
0.4                         0.1                      -100                                                                           -80                        0.15                         4
-90
0.11                                                                      0.14                            0.35
0.4                                                       0.12                  0.13
0.39                                                                             0.36
0.38                    0.37
O (C dB O ]
F
. C K SS [ SS C [dB
RADIALLY SCALED PARAMETERS
EF
.
N P L L EN
P)
TOWARD LOAD —>                                                                                             <— TOWARD GENERATOR
SW d S [d EFF , E o
RT
A W. L. W. TT
EF O ]
P T.
∞100 40
SM EA O O
20             10                               5              4                      3             2.5                 2        1.8         1.6         1.4             1.2 1.1 1          15               10     7        5                                        4                     3                            2           1
F, NS
N
TR S. RF S. A
R BS B] , P r I
. L L. OE
RF L. C
O CO FF
∞ 40 30                                                                                                                                                                                                                                                                                                                                                                                                                              ∞
RF
20                    15                                         10                     8                6          5          4           3         2         1      1 1                                         1.1               1.2         1.3 1.4                1.6         1.8    2                             3         4         5                   10        20
S
0                                1               2               3                 4              5               6            7        8     9         10          12         14                  20          30 ∞ 0                          0.1           0.2               0.4         0.6     0.8       1                1.5              2                   3          4         5         6                  10 15 ∞
I
or
E
1                   0.9         0.8      0.7         0.6       0.5                0.4                0.3                    0.2                      0.1                 0.05                     0.01           0 0                 1.1               1.2             1.3           1.4        1.5      1.6 1.7 1.8 1.9 2                                             2.5         3                   4         5          10 ∞
F,
EF
O
1                           0.9                 0.8              0.7                    0.6                   0.5                      0.4               0.3                   0.2                 0.1           0 1                 0.99                    0.95                0.9                        0.8                0.7                 0.6            0.5        0.4           0.3         0.2           0.1            0
.C
SM
CENTER
N
A
TR
0.0                              0.1                 0.2              0.3                    0.4                   0.5                      0.6               0.7                   0.8                 0.9            1                  1.1                  1.2                  1.3                1.4                  1.5                1.6                    1.7              1.8                   1.9                         2
ORIGIN
© Black Magic Design. All rights reserved. This content is excluded from our Creative Commons license.
For more information, see
6.013 Electromagnetics and Applications
Spring 2009
For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : From the problem statement we know we are looking for a parallel resonator (short circuit far from
resonance), with the input to the ampliﬁer serving as the load resistor. We also know that QLoaded =
2π×1×106
2π×50×106 = 0.02.
QLoaded = 0.02 = ω CR th R
Rth +R , which tells us that
Rth +R      1     200    4     −10
C=Q
ω Rth R = 2π×50×106 1002 = π × 10
1
ω = √LC which tells us L = ω21C .
L = (2π×106 )21 4 ×10−10 = 161π × 10−2
π
12
6.013 Electromagnetics and Applications
Spring 2009
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
G = 10
λ = fc = 0.005 [m]', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (Minimum Power)
Step 1: Find the intensity at the target
G           10
Iped = Pt 4πr 2 = Pt 4π(50)2
Step 2: Find the intensity at the reciever, given the cross section of the target
−2
1             10
Irec = Iped σ 4π(50) 2 = Iped 4π(50)2
Step 3: Find the power at the reciever, given the intensity at the reciever
2              2
Prec = Irec Aef f = Irec G 4λπ = Irec 104πλ
Step 4: Combine
−2       2
10
Prec = Pt 4π(50)   10    10λ
2 4π(50)2 4π = Pt (4π)−3 (50)−4 (0.005)2
So the power we need to send is
Pt = Prec (4π)3 (50)4 (0.005)−2 = 10−12 (4π)3 (50)4 (0.005)−2 = 0.25(4π)3 = 16π 3 = 496 [W ]', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
G = 10
λ = fc = 0.005 [m]', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (Voltage)
P = IV = V 2 /R = V 2 /100
√           √
V = 100 × P = 100 × 496 = 223 [V ]
6
6.013 Electromagnetics and Applications
Spring 2009
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(34/100 points)

E = 2 x̂ cos(t + z) andH = ŷ sin(t  z  ) .
2
                                 z
The wave velocity v and direction [m/s]?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (t  z)  0  velocity v          1 [m/s]
t                                t', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(34/100 points)

E = 2 x̂ cos(t + z) andH = ŷ sin(t  z  ) .
2
                                 z
The time average wave intensity I [W/m2]?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Wave intensity I = E  H  2cos2 (t)  1 [W/m2 ]', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(34/100 points)

E = 2 x̂ cos(t + z) andH = ŷ sin(t  z  ) .
2
                                 z
The permeability μ [H/m] for this medium?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : η = E/H = 2. μ = η/v =     μ/ε  = 2×1 = 2 [H/m]
1                                   1', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(34/100 points)

E = 2 x̂ cos(t + z) andH = ŷ sin(t  z  ) .
2
                                 z
The pressure Pm [N/m2] the wave exerts when normally
incident (θi = 0) on a perfectly reflecting mirror?
x', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Pressure Pm = Wm =      H 2 where |H| = 2 at s = ∞. Pm = 22 = 2 [N/m2]
2                                   4', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(28/100 points)
What is H inside the toroid when the current
through the coil is I Amperes?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Ampere’s Law: πDH = NI  H = NI/πD [A/m]             (points counterclockwise)', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(28/100 points)
What is the approximate inductance L of this
I
inductor?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : L = /I.  = NAμoH. So L = NAμoNI/πDI = μoN2A/πD [H]', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(28/100 points)
The core of this coil is now one-percent filled
with many turns of iron wire having μ =            Iron wire, filling the
1000μo, as illustrated. What now is the            toroid one percent
inductance L?
-2
6.013 Electromagnetics and Applications
Spring 2009
For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : μ  0.01×1000μo + 0.99μo = 10.99 μo; A  A/100, so L  L’ = 10.99 μoN2A/πD [H]
-1
6.013 Electromagnetics and Applications
Spring 2009
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(28/100 points)
What is the numerical value of RTh?
Briefly explain your reasoning (required).
z', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : RTh = 100 ohms since there is no “glitch” at t = 2τ and therefore no reflection at the source
when the step returns at 2τ. Thus RTh is matched to the line.', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(28/100 points)
Diagram a simple load at the end of the line that could produce this response; it is not
necessary to compute element values. Simply label your components as R, L, or C, as
necessary.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : An R and C in parallel at the end of the line produces this response; the C in parallel looks
like a short circuit, yielding the zero at t = τ, and the R in parallel prevents the voltage V
from returning to the source voltage A = 2 volts.', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(22/100 points)
A certain parallel-plate TEM transmission line is filled with μo and ε = 9εo.
What is the approximate wavelength λ (numerical value) for a 1-GHz signal on this line?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : A 1-GHz signal on this TEM line has λ = 10 cm since λ = vp/f = 1/109 μo 9ε o = 0.1[m].
3ω
− jω μo 9ε o (1+ 0.01j)z            −j      1+ 0.01j z
-αz                − jkz', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(22/100 points)
A certain parallel-plate TEM transmission line is filled with μo and ε = 9εo.
Assume a sinusoidal signal propagates in the +z direction as |V(z)| = Voe-z and that ε =
9εo(1 + 0.01j). What are the sign and approximate numerical value of  at 1 GHz?
-1', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : |V(z)| = Voe . Vo e                           = Vo e                              = Vo e         c
, 1+ 0.01j = ± (1 + 0.005j) , but
the      “-”       solution               propagates                in       the       wrong               direction.          Therefore        we
3ω                        6π 109
−j    1+ 0.01j z        −j            1+ 0.01j z
have e
c
=e        3×108
= e −20 jπ (1+ 0.005 j) z = e −20 jπ (1+ 0.005 j)z ⇒ e0.1π z = e −α z
⇒ α = −π /10 = −0.314[m −1 ]                                 Therefore this transmission line amplifies.', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(22/100 points)
Explain completely but very briefly whether this is a TE or TM wave.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ⎯H = x̂ Hoe-jz - 0.6y is a TM wave because H is ⊥ z axis, the axis of propagation.', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(22/100 points)
What is the approximate angular frequency  [r/s] of this wave?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (ω [r/s]/c)2 = ko2 = kz2 + ky2 = 12 + (0.6j)2 = 0.64. So ω = 0.8c = 2.4 x 108 [r/s].', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(28/100 points)
What is the numerical value of the inductance L [Hy/m] for this line?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Numerical value of the inductance L [Hy/m] on a line having c = 3x108 [m/s] and Zo = 100
L                                                                                                                                |V(z)|
is L =        LC = 100/(3x108) = 3.33 x 10-7 [Hy/m]
C', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(28/100 points)
The magnitude of the voltage |V(z)| is
Z(z = -3 meters)                      |V(z)|
measured on this line as illustrated. The
VSWR = 3. What fraction F of the
power incident upon the load is being
reflected?                                                                                  Load ZL
z
z = -7                z = -3           0', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : |Γ| = (VSWR – 1)/(VSWR + 1) = 2/4, so F = |Γ|2 = ¼.                                                                                          Load z
z = -7           z = -3      0', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.013 — question d’examen, en anglais]
(28/100 points)
What is the complex impedance Z(z = -3 meters) seen looking toward the load?
Although a Smith chart is not required for this           Rn = 0
problem, a small one is provided here as a                                                    Rn = 2
jXn = j
courtesy.
Rn = 1
jX = 0
jXn = -j
Rn = 
To generator
-2
6.013 Electromagnetics and Applications
Spring 2009
For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Z(z = -3 meters) = real and minimum since |V| = minimum. Zn (z = -3) = (1 - |Γ|)/(1 + |Γ|)
= 1/3, so Z (z = -3) = 100/3 = 33.3 Ω.
‐1
6.013 Electromagnetics and Applications
Spring 2009
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.013 Electromagnetics And Applications, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
						),
					),
				),
			),
		);
	}
}
