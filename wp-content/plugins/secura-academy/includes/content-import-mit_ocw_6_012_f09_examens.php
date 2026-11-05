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
[6 pts] You find a sample of silicon, but the accompanying data sheet has been
partially destroyed so you only know that it is n-type, its resistivity is 100 Ohm-cm,
and its electron mobility is 1600 cm2/V-s. You also remember that ni(Si) = 1010 cm-3.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)    The resistivity is given, and is the inverse of the conductivity: σ = 1/ρ = qµeno.
Thus, no = 1/ρqµe = 1/(102x1.6x10-19x1.6x103) = 3.9x1013 cm-3 ≈ 4 x 1013 cm-3.
ii)   po = ni2/no = 1020/(3.9x1013) = 2.56 x 106 cm-3.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[10 pts] The excess hole pop                    p’(x) [cm-3]
ulation illustrated on the right         14
is established in an n-type         5 x 10
silicon sample, ND = 1017 cm-3.
The minority carrier lifetime in
this sample is 10-4 s, the hole
mobility is 640 cm2/V-s, and
the cross-section of the sample
is 10-4 cm2.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)    ih = A jh = - A q Dh dp’/dx . Dh = µh(kT/q) = 640 x 0.025 = 640/40 = 16 cm2/s.
Thus, ih = -10-4x1.6x10-19x1.6x101x(-5x1014/2x10-4) = 6.4 x 10-4 A.
ii)   The total number is the area under the profile times the cross-sectional area:
Excess holes = (5x1014x2x10-4/2)x10-4 = 5 x 106
iii)   The total recombination is the total excess divided by the minority carrier
lifetime: 5x106/τh = 5x106/10-4 = 5 x 1010 holes/s
The hole recombination current, i.e. the current supplying the holes is the total
hole recombination rate times q: 5 x 1010 x 1.6 x 10-19 = 8 x 10-9 A. This is much
smaller than the hole diffusion current found in 1-b-i, i.e. negligible.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[6 pts] In thermal equilibrium, what is the electrostatic potential, φ(x), in the left-
hand quasi-neutral region at x = -1.5 µm, and what is the electrostatic potential, φ(x),
in the right-hand quasi-neutral region at x = +1.5 µm, and what is the built-in
potential step, Δφb, seen transiting from x = -1.5 µm to x = +1.5 µm? Use the 60 mV
rule, and log 2 = 0.3.
φ(-1.5 µm) =                         V
φ(1.5 µm) =                          V
Δφb =                       V
Problem 2 continues on the next page
Page 6 of 10', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : φ(-1.5 µm) = -(kT/q) ln(1017/1010) ≈ -7 x 0.06 = - 0.42 V
φ(1.5 µm) = (kT/q) ln(1017/1010) ≈ 7 x 0.06 = 0.42 V
Δφ = φ(1.5 µm) − φ(-1.5 µm) = 0.42 – (-0.42) = 0.84 V', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[4 pts] What boundary condition is imposed on the excess minority carriers n’ at x =
0 and x = L ?
!
Boundary condition at x = 0:
Boundary condition at x = L:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : B.C. @ x = 0: n’(0) = 0.            B.C. @ x = L: n’(L) = 0.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[4 pts] We now make the assumption that the minority carrier lifetime is very long,
which simplifies the general equation to:
d 2 n\'(x)     1
2
" #    gL (x)
dx         De
What quantitative restriction is placed on the minority carrier lifetime, τe, for this
assumption to be valid?
!
τe >> ≈ <<
(circle one)   (fill in the blank)
Problem 3 continues on the next page
Page 9 of 10', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We require Le >> L, and since Le = (Deτe)1/2, we must have τe >> L2/De', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[3 pts] What is the forward current gain, βF, in this transistor?
βF =', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : βF = iC/iB = 9.25 mA/92.5 µA = 100', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[2 pts] What is the base defect, δ B, in this transistor?
δB =
Problem 2 continues on the next page
Page 6 of 10', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : δB = 0, because the lifetime is infinite, meaning the minority carrier diffusion length
is also infinite.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[4 pts] What is the value of the flatband voltage, VFB, for this MOS structure?
Flatband Voltage, VFB =                  Volts', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : VFB = -(φn+ - φp) = -[0.54 - (-0.3)] = - 0.84 V', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[5 pts] On the axes provided below, sketch carefully the electrostatic potential, φ(x),
from G to B for V GB = 0 V. Assume that the lightly doped p-region is fully depleted.
On your sketch indicate the potential difference between the bulks of the n+ and p +
regions.
φ(x)
x
-xM      -xox        0          xA               xB
Problem 3 continues on the next page
Page 9 of 10', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : φ(x)
Slight curvature
0.54 V                 (concave up)
0.2 V
x
-xM        -xox       0             xA                xB
-0.3 V
-0.54 V', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[18 pts] Assuming thermal equilibrium (vAB = 0) at room temperature, find the
following.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       Na = B concentration = 2 x 1016 cm-3.
ii)    NA = Na - Nd = B concentration - As concentration = 2 x 1016 - 1 x 1016 = 1016 cm-3.
iii)   po ≈ NA = 1016 cm-3.
iv)    no = ni2/po = (1020 cm-6)/(1016 cm-6)= 104 cm-3.
v)     σo = qnoµe + qpoµh ≈ qpoµh = (1.6 x 1019 coul)(1016 cm-3)(600 cm2/V-s)= 0.96 S/cm.
vi)    φp = -(kT/q) ln (po/ni) ≈ - 60 mV x 6 = - 360 mV = - 0.36 V.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[8 pts] What is the boundary condition on the excess minority carrier concentration
or its derivative at each end of the sample?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       dn\'/dx|x = 0 = 0
ii)    n\'(L) = 0', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[5pts] What is the minority carrier lifetime, τmin, in this sample?
τmin =                        s', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Lmin2 = Dminτmin so τmin = Lmin2/Dmin. Dmin = De = µe/40 = 40 cm2/s, and Lmin = 100 µm
= 10-2 cm. Thus τmin = (10-2)2/40 = 2.5 x 10-6 s = 2.5 µs.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[8 pts] The figures you need to answer this question are on the next page.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       D, because the minority carrier diffusion flux must be zero at x = 0, and the flux
builds up (increases) linearly because there is uniform optical creation of hole-
electron pairs and no appreciable recombination. Alternatively one could say
that the integral of the generation function (a constant in this case) yields the
gradient in the excess population, and the flux proportional to this. The
integral of a constant is a line of constant slope.
ii)    A, because it is consistent with the answer in (i), because it is the only profile
that fits the boundary conditions, and/or it is what one gets by integrating a
constant twice.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[15 pts] First consider a diode in which the two p-type sub-regions have the same
doping level with NA1 = NA2 = 1015 cm-3. In Parts i) and ii) assume there is zero
applied bias, v AB = 0 V; in Part iii) assume forward bias, vAB > 0. Calculate the
following quantities:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       0.84 V using the 60 mV rule; 0.81 V if use kT = 0.025 V and evaluate the
exponential.
ii)    1 µm
iii)   Je/Jh = (De/Dh)(ND/NA1)[wn/(wp-xp)] = 3 x (1/3) x', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[8 pts] Consider an n-channel MOSFET with a channel length, L = 0.2 µm; width, W
= of 5.0 µm; electron mobility, µe = 600 cm2/V-s; and gate oxide capacitance, C*ox =
10-8 F/cm2. The flatband voltage, VFB = - 0.2 V, and the threshold voltage, VT = +0.5
V. The bias voltages are VBS = VDS = 0 V.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)    Applying vGS > VT to an n-channel MOSFET accumulates additional holes at the
interface. The additional amount of interface charge is -WLCox*(vGS – VT) = -5 x
10-4 x 2 x 10-5 x 10-8 x 1 = 10-16 Coul.
ii)   The additional holes come from the p-type bulk region.
iii)   Applying vGS < VFB to an n-channel MOSFET increases the number of inversion
layer electrons at the interface. The additional charge is -WLCox*(vGS - VFB) = 5 x
10-4 x 2 x 10-5 x 10-8 x 1 = 10-16 Coul.
iv)   The additional electrons come from the n-type source and drain regions.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[10 pts] Consider operating the enhance
ment-mode n-channel MOSFET shown to
the right as a lateral npn bipolar transistor.
Leave the gate disconnected and focus on
terminals B, S, and D.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)    One of the n+ regions (source or drain) is the emitter, the other n+ region is the
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
[6 pts] On the axes provided, plot the electrostatic potential, φ(x), through the device
from G to B (i.e. starting in the gate metal and going into the ohmic contact metal) in
flatband when vGB = VFB. Label all relevant features on your plot, including values
for φ(0), depletion region width, and potential drop across the oxide. Finally, derive
an expression for the flatband voltage, VFB.
!(x)
x
-thi         0                                           L
VFB =
Problem 2 continues on the next page
Page 6 of 10', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : In flatband there is no depletion region, φ(0) = φn, and there is no voltage drop
across the dielectric.
"(x)
"(0) = "n
VFB = 1.5 "n
x
-thi       0                                                 L
!0.5 "n
As indicated in the figure, VFB = 1.5 φn.', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[5 pts] Calculate the drain current in saturation, ID,sat, of a minimum size n-MOS
transistor in this technology when VGS = VDS = VDD = 1.0 V. Use the general expres
sion we derived using the gradual channel approximation model in strong inversion
and assume α = 1 and that the low-field mobility model is valid.
ID,sat(VGS = VDS = 1.0 V) =                 A', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ID,sat = (Wmin/2Lmin)µe(εox/tox)(VGS - VT)2[1+λn(VDS-VDS,sat)]
= [135/(2 x 35)] x 500 x (3.5 x 10-13/10-7) (0.6)2 (1+0.001(1-0.4))≈ 1.2 mA', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[5 pts] Calculate the value of the output resistance, ro, in the small signal linear
equivalent circuit of the n-MOS transistor in saturation with VGS = 1.0 V. [If you
could not do Part a use a drain current of 1 mA (this is not the right answer for Part
a).]
ro =                 Ohms
Problem 3 continues on the next page
Page 9 of 10', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ro = 1/go = 1/λnID = 1/(10-3 x 1.2 x 10-3) = 10-6/1.2 ≈ 800,000 Ohms', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
You are in charge of a CMOS fabrication line and you have a problem because the
thresholds of your n- and p-channel MOSFETs, which are supposed to be +1 V and
-1 V, respectively, are turning out to be +3 V and +1 V, instead. You suspect that
the interface between the silicon and the 20 nm thick oxide is contaminated with
ions.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       n-channel MOSFET: Enhancement mode because VT ≥ 0, which for an n-
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
[4 pts] Given that VT = 1 V, what is the gate voltage VGS that must be applied to obtain
the characteristic shown above?
VGS =                        Volts', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The iD-vDS plot shows us that for the gate voltage applied the MOSFET saturates at a
vDS of 5 V. We can find out what the gate voltage is using: VDS,sat = VGS – VT:
VGS = VDS,sat + VT = 5 V + 1 V = 6 V', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[5 pts] What is the slope, diD/dvDS of the characteristic at VDS = 0V? Make sure you
provide a formula as well as a value so that your answer is independent of the
correctness of your Part (a).
diD/dvDS @ VDS = 0: Formula
Value                     S
Problem 2 continues on the next page
Page 6 of 10', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Near the origin, iD = K(vGS-VT-vDS/2)vDS and the slope is K(vGS-VT-vDS). Evaluating
this at the origin, we find that
∂iD/∂vDS (@ VDS = 0) = K(VGS – VT) = KVDS,sat
where (VGS – VT) = 5 V. To find K and evaluate this we can use the saturation
current, 10 mA, and saturation voltage, 5 V, in iD,sat = K(vGS – VT)2/2 =K(VDS,sat)2/2 to
find:
K = 2iD,sat/(VDS,sat)2 = 2 (0.01/25) = 0.0008 A/V2
With this the slope, KVDS,sat, is: 8 x 10-4 x 5 = 4 x 10-3 S', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[4 pts] On the two sets of axes provided below, indicate the regions in vIN-vOUT space
where each device is off, linear, and saturated.
v OUT [Volts]                                    v OUT [Volts]
5                                               5
v IN [Volts]                                 v IN [Volts]
0                    5                          0                     5', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)                                      ii)                                            b)
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
A short bar of p-type silicon, NA = 1017 cm-3, is illuminated with light that uniformly
generates 1020 hole-electron pairs/cm3-s throughout it.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       In the steady state the low level injection, zero current continuity equation
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
Looking at Junction B:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : i)       JElectron-B = q De dn’/dx = 1.6x10-19 4x101 [(0 - 1013)/(5x10-4 – 3x10-4)]
= - 3.2 x 10-1 A/cm2
ii)    JHole-B = - q Dh dp’/dx = 1.6x10-19 1.5x101 [(1014 – 5x1014)/(3x10-4 – 2x10-4)]
= 9.6 A/cm2
iii)   I3 = - A (JElectron-B + JHole-B) = - 10-4 [9.6 – (- 0.32)] = 9.28x10-4 A ≈ 0.93 mA
iv)    The excess minority population at the edge of a depletion region at a junction
varies as ni2/NNet, so if the excess population is 10 times lower in Region 3 than
in Region 2, the doping level there must be 10 times larger than it is in Region
2. Thus, n’(3+) = 0.1 p’(3−) implies NA3 = 10 ND2 = 1018 cm-3', 'source' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.012 Microelectronic Devices And Circuits, Fall 2009 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 6.012 — question d’examen, en anglais]
[5 pts] Calculate Δφ13, the built-in potential difference between the QNR (quasi
neutral region) in Region 1 (i.e. where x << -L) and the QNR in Region 3 (where x
>> 0).
Δφ13 =                   Volts', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : φn+ = 0.55 V and φp = -0.42 V, so Δφ13 = 0.97 V.
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
						),
					),
				),
			),
		);
	}
}
