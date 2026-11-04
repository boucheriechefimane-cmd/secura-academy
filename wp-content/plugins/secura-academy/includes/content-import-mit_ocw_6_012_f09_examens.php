<?php
/**
 * Questions importees — MIT OpenCourseWare — 6 012 microelectronic devices and circuits fall 2009
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_012_f09_examens' ) ) {
	function seca_import_mit_ocw_6_012_f09_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-012-f09-examens', 'nom' => 'MIT OpenCourseWare — 6 012 microelectronic devices and circuits fall 2009', 'url' => 'https://ocw.mit.edu/courses/6-012-microelectronic-devices-and-circuits-fall-2009/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'les-fondamentaux-du-reseau' => array(
					'title' => 'les-fondamentaux-du-reseau',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Fonstad', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       A less than B, because K varies inversely with L.
ii)    A similar to B, because the threshold voltage does not depend on L.
iii)   A greater than B, because A has a smaller K and thus must be biased stronger.
iv)    A less than B, because VA is bigger for the longer device, and thus go is smaller.
v)     A greater than B, because the area of the gate (WxL) is larger.
vi)    A similar to B, because Cgd is proportional to the device width and that is the
same in both devices.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Fonstad', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       A less than B, because IES is dominated by NAB and proportional to 1/NAB.
ii)    A similar to B, because ICS is dominated by NDC and that is the same in both
devices. A less than B was also accepted.
iii)   A less than B, because the emitter defect increases with NAB, and β ≈ 1/δE.
iv)    A similar to B, because gm = qIC/kT and is the same for both devices.
v)     A less than B, because VA increases as the doping increases, and go = IC/VA
vi)    A similar to B, because Cµ is nominated by the collector doping, which is the
same in both devices. A greater than B was also accepted.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Fonstad', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       Essentially unchanged, because the sum of the n- and p-channel MOSFET gate
areas is still 3WminLmin.
ii)    Decreased, because the p-FET is now narrower and delivers less current.
iii)   Increased, because the n-FET is now wider and can draw more current.
iv)    Essentially unchanged, because the static power is zero. (Trick question?)
v)     Essentially unchanged, because the logic HI voltage is still VDD.
iv)    One increased, one decreased, because the nearly vertical portion of the
transfer characteristic is no longer centered about VDD/2.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Hoyt', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : βF = iC/iB = 9.25 mA/92.5 µA = 100', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Hoyt', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : δB = 0, because the lifetime is infinite, meaning the minority carrier diffusion length
is also infinite.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Hoyt', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The factor in question appears in the emitter defect expression, and we can find the
emitter defect because we know βF and βF ≈ 1/δE, when δB is negligible, as it is here:
βF and βF ≈ 1/δE =(DeWE,effNDE)/(DhWB,effNAB) = (De/Dh) r, so r = βF(De/Dh) = 50', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Hoyt', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Use the Gummel plot to find a value for IES, and then use IES to find NAB:
IC ≈ IES exp (qVBE/kT), and IES ≈ Aqni2(De/WB,effNAB),
so NAB = Aqni2(De/WB,effIC) exp (qVBE/kT) = 1 x 1017 cm-3', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Hoyt', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : With the results of Parts (c) and (d), we find NDE = r WB,effNAB/WE,eff = 1 x 1019 cm-3', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Hoyt', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : n, p
1.45 x 1015 cm-3
1.45 x 1013 cm-3
n
p
-3
2 x 103 cm-3
10 cm                                          ≈0                   p
x [µm]
-0.25                               0.5                                          1.5
(-wE)                               (wB)                                       (wB+wC)', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Hoyt', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : n\'(x)                                             n\'(x)
Qdiff(B) =
Qdiff(A)                                                           2 Qdiff(A)
x                                              x
0                   wB                            0                 wB', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by John Hennessey for Prof. Antoniadis', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : VFB = -(φn+ - φp) = -[0.54 - (-0.3)] = - 0.84 V', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by John Hennessey for Prof. Antoniadis', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : φ(x)
Slight curvature
0.54 V                 (concave up)
0.2 V
x
-xM        -xox       0             xA                xB
-0.3 V
-0.54 V', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by John Hennessey for Prof. Antoniadis', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : xp = xA = (2 εSi Δφ/q NA)1/2 = 10 nm. We find Δφ = 0.08 V
The assumption is justified because the total potential change, which is|VFB|, is
much greater than this value.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by John Hennessey for Prof. Antoniadis', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)   Electric field:
Ε(x)
Qn\'/εox          E(0-)/E(0+) = eSi/eox = 3
Qn\'/εSi
x
-xM         -xox          0            xA          xB
Very small negative slope
ii)   Charge density:
ρ(x)
Qn\'
x
-xM          -xox       0           xA           xB
-qNA
Qp\'', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by John Hennessey for Prof. Antoniadis', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Neglecting qNAxA relative to Qn\' and Qp\', then Qp\' ≈ Qn\'. The situation looks like a
parallel plate capacitor with two different dielectrics. The total potential drop from
x = -xox to x = xA is VFB, or 0.84 V. The drop across the oxide is Qp\'xox/εox and that
across the silicon is Qp\'xSi/εSi. Adding these together and setting them equal to VFB,
Qp\'xox/εox + Qp\'xSi/εSi = VFB, we find
Qp\' = VFB/(xox/εox + xSi/εSi) = 3.5 x 10-7 C/cm2', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by John Hennessey for Prof. Antoniadis', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The charge in the depleted lightly doped p-region is:
-qNA xA = 1.6 x 10-19 1015 10-6 = - 1.6 x 10-10 coul/cm2
This is much less than Qp\', so it neglecting it was a good approximation.
Average/Standard deviation:     Problem 1          28.7      4.6
Problem 2          18.5      6.1
Problem 3          14.7      5.5
Total              62.0     12.7
Distribution to nearest 5:
Find your face in this picture
20        30         40        50         60        70          80   90   100
Total Score
6.012 Microelectronic Devices and Circuits
Fall 2009
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Hoyt', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       Na = B concentration = 2 x 1016 cm-3.
ii)    NA = Na - Nd = B concentration - As concentration = 2 x 1016 - 1 x 1016 = 1016 cm-3.
iii)   po ≈ NA = 1016 cm-3.
iv)    no = ni2/po = (1020 cm-6)/(1016 cm-6)= 104 cm-3.
v)     σo = qnoµe + qpoµh ≈ qpoµh = (1.6 x 1019 coul)(1016 cm-3)(600 cm2/V-s)= 0.96 S/cm.
vi)    φp = -(kT/q) ln (po/ni) ≈ - 60 mV x 6 = - 360 mV = - 0.36 V.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Hoyt', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       R = ρ L/w t = L/σ w t = (10-1 cm)/(0.96 S/cm)(10-3 cm)(10-4 cm) = 1.04 x 106 Ω.
ii)    E = VAB/L = 2 V/(10-1 cm) = 20 V/cm.
iii)   Jdr = σ E = 0.96 S/cm x 20 V/cm = 19.2 A/cm2', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Hoyt', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       Lmin = (Dminτmin)1/2 = [(40 cm/s)(10-7 s)]1/2 = 2 x 10-3 cm.
ii)    Far from the ohmic contacts n\' ≈ p\' ≈ GLτmin = (1023 cm-2 s-1)(10-7 s) = 1016 cm-3.
(Note this is no longer strictly low level injection, but we did not take off points
for this because we had intended it to be LLI; it did initially but then someone
whose initials are CF changed the lifetime at the last minute.)
σ ≈ qµhpo + qµen\' + qµhp\' = σo+ q(µe+ qµh)n\'
= 0.96 S/cm + (1.6 x 10-19 coul)(600 cm2/V-s + 1600 cm2/V-s)(1016 cm-3)
= 0.96 + 3.52 = 4.48 S/cm', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Fonstad', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       dn\'/dx|x = 0 = 0
ii)    n\'(L) = 0', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Fonstad', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Lmin2 = Dminτmin so τmin = Lmin2/Dmin. Dmin = De = µe/40 = 40 cm2/s, and Lmin = 100 µm
= 10-2 cm. Thus τmin = (10-2)2/40 = 2.5 x 10-6 s = 2.5 µs.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Fonstad', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       D, because the minority carrier diffusion flux must be zero at x = 0, and the flux
builds up (increases) linearly because there is uniform optical creation of hole-
electron pairs and no appreciable recombination. Alternatively one could say
that the integral of the generation function (a constant in this case) yields the
gradient in the excess population, and the flux proportional to this. The
integral of a constant is a line of constant slope.
ii)    A, because it is consistent with the answer in (i), because it is the only profile
that fits the boundary conditions, and/or it is what one gets by integrating a
constant twice.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Fonstad', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : With no recombination the total flux density into the ohmic contact must be the the
total generation within the sample, which is the integral of gL(x) from x = 0 to x
= L. In this case gL(x) is a constant, call it GL, so the integral is GLL. The current
density is the charge per carrier, -q, times the flux: Jmin(x) = -q GLL = -1.6 x 10-19
x 1019 x 10-3 = -1.6 x 10-3 A/cm2 = -1.6 mA/cm2.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Fonstad', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       The recombination at any point is n\'(x)/τmin, so the total recombination per unit
area is ∫0→L[ n\'(x)/τmin]dx. If one finds n\'(x) and does this integral you get
GLL3/3τminDmin = GLL3/3Lmin2. The numerical answer is 3.2 x 1013 cm-2s-1.
ii)    Much greater than, because even though there is non-zero recombination in the
bulk, it is still much less than occurs at the ends. If one compares the answers
in Parts (d) and (e-i), one sees that the fraction recombining in the bulk is
L2/3Lmin2. In this case this is 1/300, so 300 times as much recombination occurs
at the contact as within the bulk.
The important concept upon which Part (e) of this problem is based is that one can
find the excess carrier and flux profiles in a short base situation (i.e., long
diffusion length) assuming that the lifetime in infinite, and then turn around
and find out how much recombination occurs (and this how good the initial
assumption was) by using the true minority carrier lifetime and the profile
calculated assuming infinite lifetime to estimate the amount of recombination.
Comparing this to the total minority carrier generation and/or injection, or to
the recombination fluxes at the contacts.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Antoniadis', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       0.84 V using the 60 mV rule; 0.81 V if use kT = 0.025 V and evaluate the
exponential.
ii)    1 µm
iii)   Je/Jh = (De/Dh)(ND/NA1)[wn/(wp-xp)] = 3 x (1/3) x', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Antoniadis', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       Same as (a-i).
ii)    xp ≈ [2εSi(φb-V1)/qNA1)]1/2 so V1 = -(qNA1xp2/2εSi) + φb = -2.4 V
iii)   The small signal linear equivalent capacitance is the same as a parallel plate
capacitor with the same width as the depletion region and the dielectric
constant of silicon:
Cab(V1) = eSi/w(V1) ≈ εSi/xp(V1) = 10-12/2 x 10-4 = 5 x 10-9 F/cm2.
iv)    Figure b because xp will increase only marginally for vAB > V1 due to NA2 >>
NA1. Consequently, the depletion region width, w, which is essentially the
same as xp, will not increase either. The capacitance per unit area, Cab, is εSi/w,
so it will not decrease appreciably for vAB > V1.
Average/Standard deviation:        Problem 1           29.4        4.5
Problem 2           24.4        5.3
Problem 3           23.9        5.3
Total               77.8       11.9
Distribution to nearest 5:
Find your face in this picture
20         30          40         50         60         70            80    90        100
Total Score
6.012 Microelectronic Devices and Circuits
Fall 2009
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Fonstad', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)    Applying vGS > VT to an n-channel MOSFET accumulates additional holes at the
interface. The additional amount of interface charge is -WLCox*(vGS – VT) = -5 x
10-4 x 2 x 10-5 x 10-8 x 1 = 10-16 Coul.
ii)   The additional holes come from the p-type bulk region.
iii)   Applying vGS < VFB to an n-channel MOSFET increases the number of inversion
layer electrons at the interface. The additional charge is -WLCox*(vGS - VFB) = 5 x
10-4 x 2 x 10-5 x 10-8 x 1 = 10-16 Coul.
iv)   The additional electrons come from the n-type source and drain regions.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Fonstad', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)    One of the n+ regions (source or drain) is the emitter, the other n+ region is the
collector, and the base is the p-region, or substrate. To bias an npn BJT in its
forward active region requires VCE ≥ 0.2 V and VBE ≈ 0.6 to 0.7 V. Saying both
had to be greater than zero was accepted and earned most of the points.
ii)   The forward current gain, βF, is low because a large fraction of the electrons
injected across the emitter-base diode into the p-region are directed vertically
and not laterally toward the collector.
The early voltage is low, and thus there is a significant amount of base width
modulation, because the collector is more heavily doped than the base,
meaning that the depletion region at the collector-base junction extends
primarily into the base side of the junction.
iii)   Adding a heavily doped p-type region under the n+ regions reduces the
vertical injection of electrons across the emitter-base junction and the junction
current is now predominantly electrons flowing laterally across the junction
and toward the relatively close collector. This makes βF much larger.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Fonstad', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)    Doing a Taylor’s Series expansion about Q, and isolating the small signal terms:
id = (diD/dvGS)|Q vgs + (diD/dvDS)|Q vds
= (W/L) µe [Cox* VDS vgs + (Cox* VGS+ α) vds]
ii)   The small signal linear equivalent circuit is:
g                                   d
v gs                gmv gs     go v ds
s                                   s
with gm = (W/L) µe Cox* VDS and go = (W/L) µe (Cox* VGS+ α)
iii)   To find RL we first find ID = 10-7 (10 VGS + 1) VDS with VGS = 1 V and VDS = 1.5 V,
or ID = 1.65 x 10-6 Amps. The voltage drop across RL must be 1.5 V, so
RL = 1.5/(1.65 x 10-6) ≈ 900,000 Ohms
We can now use this result and our linear equivalent circuit to draw the linear
equivalent circuit for the full circuit, and from that we find the voltage gain:
g                                                 d
v in = v gs                        gmv gs         go v ds               RL
= v out
s                                                 s
-6                                     -6
We find gm = 1.5 x 10 mho and go = 1.1 x 10 mho, and using the RL above we
have 1/RL = GL = 1.1 x 10-6 mho. Thus, Av = vout/vin = -gm/(go+GL) ≈ - 0.7.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Weinstein', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : In flatband there is no depletion region, φ(0) = φn, and there is no voltage drop
across the dielectric.
"(x)
"(0) = "n
VFB = 1.5 "n
x
-thi       0                                                 L
!0.5 "n
As indicated in the figure, VFB = 1.5 φn.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Weinstein', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : At flatband the hole and electron populations are the same as they are in the bulk of the
semiconductor. Thus, n(x = 0+) = ND, and p(x = 0+) = ni2/ND.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Weinstein', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : At the onset of threshold φ(0) = -φn, the depletion region accommodates a change in
potential of 2 φn and thus XD = [2εSi (2 φn)/qND]1/2. The potential drop across the
dielectric qNDXDthi/εhi, and VT – VFB = - 2 φn – (thi/εhi)[2εSi (2 φn) qND]1/2.
With these results, we find VT = VFB - 2 φn – (thi/εhi)[2εSi (2 φn) qND]1/2
= - 0.5 φn – (thi/εhi)[2εSi (2 φn) qND]1/2
The electrostatic potential profile at the onset of inversion:
!(x)
!n
VFB = 1.5 !n
2 !n
x
-thi      0              XD                                    L
"0.5 !n
!(0) = -!n
VT                          (thi/#hi)(2#Si qND 2!n)1/2
The net charge distribution at the onset of inversion:
!(x)
qND
qNDXD
x
-thi     0              XD                      L
-qNDXD', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Weinstein', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : At the onset of inversion, the hole density at the interface is ND, i.e. p(x = 0+) = ND,
and n(x = 0+) = ni2/ND.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Weinstein', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If there is a net sheet charge density, σi, at the interface, then at flatband there is a
net sheet charge density, -σi, on the gate, and no other charge in semiconductor up
to the interface. The voltage drop across the gate dielectric is σi(thi/εhi), and the
flatband voltage must be more negative by this amount, ΔVFB = - σi(thi/εhi). The
threshold voltage will be more negative by this same amount: ΔVT = - σi(thi/εhi).', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Weinstein', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : With an additional dielectric layer under the gate, there is additional voltage drop
across the insulator for the same charge on the gate: ΔV (w.o. SiO2) = QG(thi/εhi)
and ΔV (w. SiO2) = QG(thi/εhi) + QG(tox/εox). CG = QG/ΔV = 1/(thi/εhi + tox/εox) =
εhi/2thi. Thus CG(w. SiO2)/ CG(w.o. SiO2) = ½.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ID,sat = (Wmin/2Lmin)µe(εox/tox)(VGS - VT)2[1+λn(VDS-VDS,sat)]
= [135/(2 x 35)] x 500 x (3.5 x 10-13/10-7) (0.6)2 (1+0.001(1-0.4))≈ 1.2 mA', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ro = 1/go = 1/λnID = 1/(10-3 x 1.2 x 10-3) = 10-6/1.2 ≈ 800,000 Ohms', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : VIN1         VIN2                VOUT
0V          0V                  1V
0V          1V                  1V
1V          0V                  1V
1V          1V                  0V', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Wn, Inverter = 1 Wmin      and            Wp, Inverter = (µe/µh) Wn, Inverter = (500/200) Wmin = 2.5 Wmin', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We want the n-MOSFETs to each be minimum length since the effective length will
be the sum of the lengths of two n-MOSFETs: Ln,NAND = 1 Lmin. and Ln,Eff = 2 Lmin.
To minimize the delay, we will require the same current capability as in a standard
inverter. To achieve this with an effective gate length Ln,Eff = 2 Lmin, the width needs
to be Wn,NAND = 2 Wmin.
As the current capability of the n-MOS branch is the same as in an inverter, the p-
MOS branch can be sized as in the inverter in question d). Thus CIN,NAND =
2.5WminLmin + 2WminLmin = 4.5 WminLmin. CIN,Inverter = WminLmin+ 2.5 WminLmin = 3.5
WminLmin, so CIN,NAND = 1.29 CIN,Inverter.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The question speaks of inverter equivalents. The inverters have 15nA leakage if
their output is high (n-MOS off), and 37.5 nA leakage if their output is low (p-
MOS, which is 2.5 x as wide, off) so the static power dissipation is 15 nA/gate x 1
V x 109 gates + 37.5 nA/gate x 1 V x 109 gates = 47.5 Watts!
If you did the problem assuming 109 NAND gates, then the output is low, we have
subthreshold current coming from each one of the two p-MOSFETs, which are
connected in parallel. Therefore, the power dissipation is: 2 transistors/gate x 15
nA/transistor x 1 V x (1 x 109) gates = 30 Watts. When the output is high, the
leakage current is due to the subthreshold current through the n-MOSFETs, which
are connected in series and the current is dominated by one of them (i.e. they share
the same current). Thus, the power dissipation in this state is: 1 transistor/gate x
15 nA/transistor x 1 V x (1 x 109) gates = 15 Watts. By adding the two
contributions, the total dissipated power is: 30 W + 15W = 45 W', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i) Eave = 1 V/(35 x 10-7 cm) ≈ 3 x 105 V/cm
ii) The average sheet charge density is qn* = Cox*(vGS – VT) = 0.6 (εox/tox) = 0.6 x 3.5 x
10-6 = 2.1 x 10-6 coul/cm2. The current, iD = W qn* sch,ave. Assuming iD = 250 µA,
we have: sch,ave = iD/(W qn*) = 2.5 x 10-4/(1.35 x 10-5 x 2.1 x 10-6) ≈ 0.88 x 107 cm/s.
Assuming iD = 1.2 mA as found in part (a), we find: sch,ave ≈ 4.2 x 107 cm/s.
iii) The current is almost 5 times smaller than the low field constant mobility model
predicts because the velocity saturates at just under 107 V/cm.
__________________________
Exam Statistics
Average/Standard deviation:       Problem 1          21.5        5.3
Problem 2          19.2        7.6
Problem 3          25.1        5.5
Total              65.8       14.9
Class median: 65
Distribution to nearest 5:
Find your face in this picture
20        30         40          50        60         70            80      90         100
Total Score
-σ            Ave & Mean         +σ
6.012 Microelectronic Devices and Circuits
Fall 2009
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Fonstad', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       n-channel MOSFET: Enhancement mode because VT ≥ 0, which for an n-
channel MOSFET means that with vGS = 0 there is no channel.
p-channel MOSFET: Depletion mode because VT ≥ 0, which for a p-channel
MOSFET means that with vGS = 0 there is already a channel.
ii)    Negative because there is a hole inversion layer in the p-channel device, i.e.
electrons depleted from the area near the interface and holes attracted to the
interface, even with vGS = 0. Concurrently, it takes more gate voltage to invert
the channel of the n-channel device, meaning more positive charge must be put
on the gate electrode which is balances by negative ions at the interface.
iii)   Larger, because the charging current is the current in saturation through the p-
channel device, and since the current in saturation for both of the devices is
proportional to (VDD – |VT|)2, this current is larger for the p-channel device
since for it |VT| is smaller.
iv)    Larger, because for both devices |VT| = |VFB| + |2φSi| + (tox/εox)(….)1/2. Thus
making tox thicker, makes |VT| larger.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Fonstad', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)                VGS:     2V          VBS:   -1V            VDS:   2V
vgs:     vAC         vds:   vAC            vbs:   vAC
The LEC is a single resistor: rac = 1/gac = 1/[gm+gmb+go]= 1/[gm(1+η)+go]
+                                     +
v ac                                  v ac                  +
gmv ac    gmb v ac go
-                                     -              v ac
-                                                               gac
v ac                                                        -
+
LEC:
ii)    n-channel, because for a transistor in strong inversion and biased in saturation,
gm = (2KID)1/2 and we can assume that Kn > Kp because in general µe > µh.
iii)   Similar, because for a transistor operating sub-threshold gm = qID/nkT, and the
ID’s are equal and the n’s will be similar.
iv)    In the linear region iD = K(vGS-VT-vDS/2)vDS
Transconductance: gm = ∂iD/∂vGS|Q = KVDS
Output conductance: go = ∂iD/∂vDS|Q = [K(vGS-VT-vDS/2)-KvDS/2]|Q=K(VGS-VT-VDS)', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The iD-vDS plot shows us that for the gate voltage applied the MOSFET saturates at a
vDS of 5 V. We can find out what the gate voltage is using: VDS,sat = VGS – VT:
VGS = VDS,sat + VT = 5 V + 1 V = 6 V', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Near the origin, iD = K(vGS-VT-vDS/2)vDS and the slope is K(vGS-VT-vDS). Evaluating
this at the origin, we find that
∂iD/∂vDS (@ VDS = 0) = K(VGS – VT) = KVDS,sat
where (VGS – VT) = 5 V. To find K and evaluate this we can use the saturation
current, 10 mA, and saturation voltage, 5 V, in iD,sat = K(vGS – VT)2/2 =K(VDS,sat)2/2 to
find:
K = 2iD,sat/(VDS,sat)2 = 2 (0.01/25) = 0.0008 A/V2
With this the slope, KVDS,sat, is: 8 x 10-4 x 5 = 4 x 10-3 S', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : At any point in the channel, qN*(y) = -(εox/tox)(VGC-VT) = -(εox/tox)(VGS-VCS-VT)
i) At the source end of the channel, VCS = 0, and we find:
qN*(0) = -(εox/tox)(VGS-VT) = -(3.5 x 10-13/10-6)5 = -1.75 x 10-6 C/cm2
ii) At the drain end of the channel, VCS = VDS = 2.5 V, and we find:
qN*(L) = -(εox/tox)(VGS-VDS-VT) = -(3.5 x 10-13/10-6) 2.5 = -8.75 x 10-7 C/cm2', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The drift velocity can be found by remembering that iD is the channel current and
that the current at any point y along the channel is the sheet charge density in the
channel, qN*(y), times the drift velocity of the carriers composing this charge, times
the width of the channel: iD = - W qN*(y) se-Drift(y). Thus: se-Drift(y) = - iD/W qN*(y)
i) At the source end of the channel we find:
se-Drift(0) = iD/W qN*(y) = 7.5 x 10-3/5 x 10-3 x 1.75 x 10-6 = 8.57 x 105 cm/s
ii) At the drain end of the channel we find:
se-Drift(L) = iD/W qN*(y) = 7.5 x 10-3/5 x 10-3 x 8.75 x 10-7 = 1.71 x 106 cm/s', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Now the relationship between the drain current and the charge density at y = L
must be iD = - W qN*(L) ssat(y). We want the charge density, so we solve for that:
qN*(L) = - iD/W ssat(y) = -10-2/5 x 10-3 x 107 = -2 x 10-7 C/cm2', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is a difficult question and almost nobody got it correct. This was anticipated
before the exam, but we decided to leave the question in with a precautionary note
added, just to see if anyone could do it. That said, the idea is to go back to the
expression for iD along the channel, and to integrate it from y = 0 to y = L/2, the
point along the channel at which we want to know vCS. Since we know iD already,
we can find vCS(L/2). The sequence leading to the expression sought is:
iD,sat = -W qN*(y) µe dvCS/dy = W (εox/tox)[VGS-vCS(y)-VT] µe dvCS/dy
iD,satdy = W (εox/tox)[VGS-vCS(y)-VT] µe dvCS
∫0y iD,satdy = iD,sat y = ∫0Vcs(y) W (εox/tox)[VGS-vCS-VT] µe dvCS', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)                                      ii)                                            b)
v OUT [V]                                              v OUT [V]                                   v OUT [V]
5        vIN = V T                                  5                                              5                 n: Saturated
n: Cut-off          p: Linear
Linear                       p: Linear
Cut-               vOUT = vIN - V Tn
off                                                    vOUT = V GG - V Tp
Saturation                                                                                     n: Saturated
p: Saturated
Saturation                                                n: LInear
Linear                                                                                               p: Saturated
v IN [V]                                       v IN [V]                                          v IN [V]
0                                5                      0                         5                 0                               5', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The threshold point occurs where both transistors are in saturation. The equation
for the curve there is:
ID-sat n = (Kn/2)(VGSn-VTn)2 = ID-sat p = (Kp/2)(VSGp-|VTp|)2
We know Kn = Kp, VTn = |VTp|, VSGp = VDD – VGG, and VGSn = VIN= VDD/2, so we find
VDD/2 - VTn = VDD – VGG -|VTp| ⇒ VGG = VDD/2 = 2.5 V', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : When both devices are in saturation at this bias point, the LEC is:
+                                                     +
v in                                                 v
gm,n v in         go,n out                go,p
-                                                    -
We find Av = -gmn/(gon+gop). There are several ways to write gm in terms of the bias
current and voltages, but the most useful here is gmn = 2IDn/(VGSn-VTn). This along
with gon = λnIDn and gop = λpIDp, and using IDn = IDp = ID, λn = λp = 0.1 V-1, VTn = 1 V,
and VGSn = 2.5 V, lead us to:
Av = -gmn/(gon+gop) = 2/[(VGSn-VTn)(λn+λp)] = 2/(1.5 x 0.2) = - 6.6', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : When VIN = 5 V the n-channel device is on, and the p-channel device is saturated
with ID = Kp(VDD-VGG-|VTp|)2/2. The corresponding static power dissipation is
IDVDD. Working through this we find
PStatic (VIN = 5V) = IDVDD = [(WP/LP)µhC*ox(VDD-VGG-|VTp|)2/2] x VDD
= (25 x 200 x 6 x 10-7 x 1.52) x 5/2 = 16.8 x 10-3 W = 16.8 mW
You did not have to include channel length modulation in this sub-section, but if
you did you had an additional term [1 + λ(VDS-VDS,sat)] = 1 + 0.1(5 – 1.5) = 1.35
multiplying the current, and found:
PStatic (VIN = 5V) = 16.8 x 1.35 = 22.7 mW', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : When VIN = 5 V the n-channel device is off, and the only static power dissipation is
due to the sub-threshold current, ID,s-t, and is ID,s-tVDD. This is probably negligible,
but just to be sure, we start by calculating the sub-threshold current when vGS = 0:
iD,s-t = [(WN/LN)µeC*ox] (kT/q)2 (n – 1) exp(-qVT/nkT)
= (10 x 5 x 102 x 6 x 10-7) (2.5 x 10-2)2 (1.5 – 1) exp[-1/(1.5 x 0.025)]
≈ 9.3 x 10-7 e-27 A ≈ 9.3 x 10-7 x 1.6 x 10-12 ≈ 1.5 x 10-18
From this we have PStatic (VIN = 0V) = 1.5 x 10-18 x 5 ≈ 10-17 W ≈ 0.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The low to high transition time is due to charging through the p-channel device
with its saturation current, ID = Kp(VDD-VGG-|VTp|)2/2 [= 3.36 mA from Part (e)], so
we have:
τLo-Hi = CL VDD/[Kp(VDD-VGG-|VTp|)2/2] = 10-13 x 5/(3.36 x 10-3) = 1.48 x 10-10 s
Exam Statistics
Average/Standard deviation:           Problem 1             26.6         6.9
Problem 2             21.7         6.6
Problem 3             22.0         6.9
Total                 70.3        16.6
Class median: 73
Distribution to nearest 5:
Find your face in this picture
20         30          40          50         60           70             80    90          100
Total Score
-σ              Ave Median            +σ
6.012 Microelectronic Devices and Circuits
Fall 2009
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       In the steady state the low level injection, zero current continuity equation
reduces to n’/τmin = gL. Thus τmin = n’/gL. = 1014/1020 = 10-6 s = 1 µs.
ii)      p = po + p’ and n = no + n’; and po = 1017 cm-3 and no = ni2/po = 103 cm-3. With n’
= p’ = 1014 cm-3, we have p ≈ po = 1017 cm-3 and n ≈ n’ = 1014 cm-3.
iii)     After the excitation is extinguished the excess minority carrier population
(actually both excesses, of course) decays as n’(t) = n’(0)exp(-t/τmin), which is
the homogeneous solution of the low level continuity equation. In the present
case this means n’(t) = 1014exp(-t/τmin) cm-3.
iv)      Faster, because the contact introduces an interface at which any excess minority
carrier encountering it recombines immediately, so the overall recombination
in the solid increases and thus the rate of decay must also increase. Because the
sample is small, and the bulk lifetime is relatively large, it can be assumed that
the increase will not be negligibly small.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       VFB = φp – φm = - 0.36 - 0.30 = - 0.66 V
!(x) [Coul/cm3]                                                  "(x) [Volts]
"m
VFB
x                                              x
-tox    0                              W                   -tox  0                      W
"p
ii)      VFB = φp – φm – Qox/Cox*= - 0.66 - 2x10-8 (3x10-6/3.5x10-13) = - 0.66 - 0.17 = - 0.83 V
"(x) [Coul/cm3]                                             !(x) [Volts]
Qox #(x)
!m
-tox                                                 VFB
x                                              x
0                              W                   -tox     0                   W
!p
Qox C ox
Qox #(x+tox)', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Palacios', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The built-in potential is determined by the doping levels on either side of the
junction so we first determine NDn from φb and NAp. From NAp we find that φp =
0.42 V, which in turn tells us that φn must equal 0.36 V to make φb 0.78 V. This
immediately tells us NDn = 1016 cm-3.
Next, wn must be adjusted to get the desired current. One way to do this is to first
calculate the electron current density at the specified bias (0.4 V ≈ 7 x 60 mV): Je =
(qni2De/NApwp)107 = (1.6x10-19 1020 4x101 107)/(1017 10-4) = 0.64 mA/cm2. Thus Jh =
0.36 mA/cm2, which in turn says wn = (qni2Dh/NDnJh)107 = (1.6x10-19 1020 1.5x101
107)/(1016 3.6x10-4) = 0.67x10-3 cm = 6.7 µm. (Note: Depending on the approxi
mations made, slightly different values can be obtained; all were accepted.)', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Fonstad', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       JElectron-B = q De dn’/dx = 1.6x10-19 4x101 [(0 - 1013)/(5x10-4 – 3x10-4)]
= - 3.2 x 10-1 A/cm2
ii)    JHole-B = - q Dh dp’/dx = 1.6x10-19 1.5x101 [(1014 – 5x1014)/(3x10-4 – 2x10-4)]
= 9.6 A/cm2
iii)   I3 = - A (JElectron-B + JHole-B) = - 10-4 [9.6 – (- 0.32)] = 9.28x10-4 A ≈ 0.93 mA
iv)    The excess minority population at the edge of a depletion region at a junction
varies as ni2/NNet, so if the excess population is 10 times lower in Region 3 than
in Region 2, the doping level there must be 10 times larger than it is in Region
2. Thus, n’(3+) = 0.1 p’(3−) implies NA3 = 10 ND2 = 1018 cm-3', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Fonstad', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       The excess minority population at the edge of a depletion region at a junction
varies as ni2/NNet, so if the doping is 10 times lower in Region 1 than in Region
2, the excess population there (at x = 2-) will be 10 times larger than it is at x =
2+. Thus, ND2 = 10 NA1 implies n’(2−) = 10 p’(2+) = 5 x 1015 cm-3.
[Note: This turns out to be high level injection, which is an oversight on our
part because we did not intend to have you worry about high level injection.
Fortunately no one even noticed, much less got hung up on it!]
ii)    The thermal equilibrium hole concentration in Region 2 is 1020/1017 = 103 cm-3.
The population at x = 2+ has therefore increased to 5 x 1014 cm-3, a factor of 5 x
1011, which is eqV12/kT. With this, and using the 60 mV rule, we estimate that V12
is 60 log10 (5x1011) = 60 (11 + log10 5) ≈ 60 x 11.7 ≈ 0.7 V.
[Sorry about the log10 5 in this problem, but any good engineer should know
log10 5 , or log10 2, anyway. The first is 0.7, and the second is 0.3. Notice that
they add to 1 because 5 x 2 = 10, so you really only need to know one of them.]', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Fonstad', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       Terminal 3 because Region 3 is the most heavily doped, and would function
well as the emitter in a pnp BJT because NA3 > ND2.
ii)    The profiles indicate there is little recombination in the base ( ≈ 0) so we can use
βF = (1 - δB)/(δE + δB) ≈ 1/δE. δE = DhNA2w2/DeNA3w3 ≈ 0.133. If we use βF ≈
1/δE, we find βF ≈ 7.5.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Antoniadis', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : φn+ = 0.55 V and φp = -0.42 V, so Δφ13 = 0.97 V.
b)
!(x) [Coul/cm 3]
qNA3xD "(x +L)
xD
x
-L             0
-qNA3
c)
E(x) [V/cm]
qNA3xD/!Si
qNA3(xD-x)/!Si
xD
x
-L             0
d)
!(x) [Volts]
!n+ = 0.55 V
Linear                                          "!2 = qNA3xD L/#Si
xD
x
-L                0
Parabolic                                   "!3 = qNA3xD2/2#Si
!p = -0.42 V', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Antoniadis', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We use the condition that the two voltage drops must add up to the built-in
potential. The equation is: Δφ13 = qNA3xDL/εSi + qNA3xD2/2εSi', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
Graded by Prof. Antoniadis', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Since the dielectric constant is the same in all parts of this structure, the
capacitance is simply that of a capacitor (L+xD) wide: Cdp* = εSi/(L+xD).
Exam Statistics
Average/Standard deviation:     Problem 1          26.6        6.2
Problem 2          23.6        7.9
Problem 3          19.7        8.6
Total              69.9       19.0
Class median:     74
Distribution to nearest 5:
Find your face in this picture
20        30         40        50         60        70            80   90   100
Total Score
-σ                   Ave   Mean         +σ
6.012 Microelectronic Devices and Circuits
Fall 2009
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
						),
					),
				),
			),
		);
	}
}
