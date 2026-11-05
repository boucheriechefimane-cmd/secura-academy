<?php
/**
 * Questions importees — MIT OpenCourseWare — 6.661 Receivers, Antennas and Signals (Spring 2003)
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_661_examens' ) ) {
	function seca_import_mit_ocw_6_661_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-661-examens', 'nom' => 'MIT OpenCourseWare — 6.661 Receivers, Antennas and Signals (Spring 2003)', 'url' => 'https://ocw.mit.edu/courses/6-661-receivers-antennas-and-signals-spring-2003/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003'),
			'rooms' => array(
				'les-fondamentaux-du-reseau' => array(
					'title' => 'les-fondamentaux-du-reseau',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Which amplifier should be placed first in the chain to minimize the chain noise
figure? Explain briefly.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The preferred amplifier depends on both noise figure and gain. The amplifier with F
= 4 is not in the contest. Using F = F1 + (F2-1)/G1, it follows that we can choose
between:
F = 1.5 + (1.6 − 1)/10 = 1.56 and
F = 0.5 + 1.5/100 = 1.605
Clearly the first combination has the lower noise figure, so put F = 1.5 first.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Which amplifier should be placed first in the chain to minimize the chain noise
figure? Explain briefly.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Which amplifier should be placed first in the chain to minimize the chain noise
figure? Explain briefly.', '_recupere_le' => '2026-11-04T19:55:22.745082+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The preferred amplifier depends on both noise figure and gain. The amplifier with F
= 4 is not in the contest. Using F = F1 + (F2-1)/G1, it follows that we can choose
between')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
If these amplifiers exhibit undesired non-linearities when their output power exceeds
one milliwatt, what is the maximum gain Gmax we can tolerate in this amplifier
chain? Assume the input is matched and at 290K.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The equivalent input power ≅ k(FTo)B = 1.38×10-23×1.615×290×109 = 6.5×10-12 W.
If the output power is 0.001 watt = GPin, then
Gmax ≅ 0.001/6.5×10-12 = 1.5×108 = 82 dB.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
If these amplifiers exhibit undesired non-linearities when their output power exceeds
one milliwatt, what is the maximum gain Gmax we can tolerate in this amplifier
chain? Assume the input is matched and at 290K.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
If these amplifiers exhibit undesired non-linearities when their output power exceeds
one milliwatt, what is the maximum gain Gmax we can tolerate in this amplifier
chain? Assume the input is matched and at 290K.', '_recupere_le' => '2026-11-04T19:55:22.745175+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The equivalent input power ≅ k(FTo)B = 1.38×10-23×1.615×290×109 = 6.5×10-12 W.
If the output power is 0.001 watt = GPin, then
Gmax ≅ 0.001/6.5×10-12 = 1.5×108 = 82 dB.

[Corr')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Assume we can add an attenuator anywhere in this non-linear circuit by adding a
room-temperature resistor in series.         Can such a resistor improve system
performance? If so, where should it be added, and what should be its value R to
minimize the overall noise figure for this system while meeting the 80-dB gain
specification and non-linearity constraints?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We need 80 dB gain (but not over 82), so we can put the 70-dB amplifier in series
with the 10 and/or 20-dB amplifiers. The lowest noise figure results when the 20-dB
amplifier is followed by the 10 and 70-dB amplifiers, in that order. But then we
need an attenuator preceding the final amplifier. If we have all three amplifiers in
series, we need to reduce our gain by a factor of 100 - 82 dB = 18 dB ⇒ 63. If R is
added in series preceding the final amplifier and the Thevenin source resistance is 50
ohms, as is the load, then the power transferred is 0.5VI* = 0.5|VTh|250/[(R + 50)(R
+ 100)] versus 0.5|VTh|250/[(50)(100)] when R = 0. This ratio of powers equals 63
when [(1 + (R/50)][(1 + (R/100)] = 63 = 1 + 3R/100 + R2/5000. This happens when
R ≅ 485 ohms. This increases the Johnson noise from the input of the final amplifier
in the ratio [(485 + 50)/50]0.5, which is small compared to 290K increased by the 30-
dB gain that precedes the resistor.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Assume we can add an attenuator anywhere in this non-linear circuit by adding a
room-temperature resistor in series.         Can such a resistor improve system
performance? If so, where should it be added, and what should be its value R to
minimize the overall noise figure for this system while meeting the 80-dB gain
specification and non-linearity constraints?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Assume we can add an attenuator anywhere in this non-linear circuit by adding a
room-temperature resistor in series.         Can such a resistor improve system
performance? If so, where should it be added, and what should be its value R to
minimize the overall noise figure for this system while meeting the 80-dB gain
specification and non-linearity constraints?', '_recupere_le' => '2026-11-04T19:55:22.745321+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : We need 80 dB gain (but not over 82), so we can put the 70-dB amplifier in series
with the 10 and/or 20-dB amplifiers. The lowest noise figure results when the 20-dB
amplifie')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What overall amplifier chain design is best here, i.e., how should the amplifiers be
sequenced, and where, if anywhere, should a series resistor R be added?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Consideration of (a) above suggests the lowest noise system has the amplifiers in the
noise-figure sequence 1.6, 1.5, and 4.0 dB, with R just before the final amplifier.
Although we could omit the 20-dB amplifier and the resistor R, and still achieve the
desired 80-dB gain without non-linearities, the noise figure of this combination
would be 1.5 + 4/10 = `1.9, which is decidedly worse. The 20-dB amplifier followed
by a smaller R and the 70-dB amplifier would still suffer from the resistor Johnson
noise more than happens when an extra 10-dB of gain precedes and effectively
diminishes it.
-1-                                        12/22/03

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What overall amplifier chain design is best here, i.e., how should the amplifiers be
sequenced, and where, if anywhere, should a series resistor R be added?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What overall amplifier chain design is best here, i.e., how should the amplifiers be
sequenced, and where, if anywhere, should a series resistor R be added?', '_recupere_le' => '2026-11-04T19:55:22.745396+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Consideration of (a) above suggests the lowest noise system has the amplifiers in the
noise-figure sequence 1.6, 1.5, and 4.0 dB, with R just before the final amplifier.
Alth')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Define all possible scattering matrices for such a reciprocal three-port device.
Briefly explain your reasoning, showing that your list is exhaustive.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The general scattering matrix subject to the given constraints is:
a     b    c
S= c     a    b
b     c    a
where all entries are complex. Losslessness requires ST*S = I, so that:
|a|2 + |b|2 + |c|2         a*b + c*a + b*c        a*c + c*b + b*a              Σ     α        β
I = b*a + a*c + c*b              |a|2 + |b|2 + |c|2    c*a + b*c + a*b          =   α∗    Σ        β*
c*a + b*c + ba*             c*b + b*a + a*c         |a|2 + |b|2 + |c|2          β∗    β        Σ
Therefore α = β = 0 and Σ = 1. This implies only a, b, or c can be non-zero, and they
must have magnitude unity to satisfy Σ = 1. However, reciprocity requires symmetry so
that b = c, and therefore only \'a\' can be non-zero.
Thus the only allowed S is the identity matrix times a phase shift ejφ, where φ is arbitrary.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Define all possible scattering matrices for such a reciprocal three-port device.
Briefly explain your reasoning, showing that your list is exhaustive.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Define all possible scattering matrices for such a reciprocal three-port device.
Briefly explain your reasoning, showing that your list is exhaustive.', '_recupere_le' => '2026-11-04T19:55:22.745465+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The general scattering matrix subject to the given constraints is:
a     b    c
S= c     a    b
b     c    a
where all entries are complex. Losslessness requires ST*S = I, so')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Repeat (a) for non-reciprocal devices. Briefly explain your reasoning.
-1-                                        12/22/03', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If we relax the requirement for reciprocity (b = c), only three scattering matrices are
allowed (a or b or c = 1), and the phase angle φ in each case is again arbitrary.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Repeat (a) for non-reciprocal devices. Briefly explain your reasoning.
-1-                                        12/22/03]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Repeat (a) for non-reciprocal devices. Briefly explain your reasoning.
-1-                                        12/22/03', '_recupere_le' => '2026-11-04T19:55:22.745538+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : If we relax the requirement for reciprocity (b = c), only three scattering matrices are
allowed (a or b or c = 1), and the phase angle φ in each case is again arbitrary.

[Co')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
a)
f1 + 75 + 20 MHz
r.f. passbands
f (MHz)
0                     f1 - 95   f1 - 67      f1 f1 + 55
What is the single-sideband (SSB) noise figure FSSB for the first stage of this
receiver?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : See Equation (2.3.20) in the notes. FA = LC (Fif + tr - 1) = LC1(F1 + tr1 - 1)

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
a)
f1 + 75 + 20 MHz
r.f. passbands
f (MHz)
0                     f1 - 95   f1 - 67      f1 f1 + 55
What is the single-sideband (SSB) noise figure FSSB for the first stage of this
receiver?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
a)
f1 + 75 + 20 MHz
r.f. passbands
f (MHz)
0                     f1 - 95   f1 - 67      f1 f1 + 55
What is the single-sideband (SSB) noise figure FSSB for the first stage of this
receiver?', '_recupere_le' => '2026-11-04T19:55:22.745663+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : See Equation (2.3.20) in the notes. FA = LC (Fif + tr - 1) = LC1(F1 + tr1 - 1)

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
a)
f1 + 75 + 20 MHz
')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
a)
f1 + 75 + 20 MHz
r.f. passbands
f (MHz)
0                     f1 - 95   f1 - 67      f1 f1 + 55
What is the SSB noise figure for the combined receiver? Note that it is a little worse
than it might otherwise be because the unused sideband input into the second mixer
is not at 290K, but something greater that must be reflected in the', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The second mixer is like an amplifier of gain G2LC2 and noise figure FB\' = LC2(F2 +
tr2 - 1), but with excess noise (still larger FB) due to the fact that the unused sideband
into the second mixer is not at 290K, but at a higher temperature when the first
amplifier sees 290K. If we combine this excess noise input to the second mixer into
the parameter tr2\', where tr2 is the manufacturer\'s specification, then the cascade
formula for F yields:
F = FA + (FB - 1)/GA = Lc1(Fif1 + tr1 - 1) + Lc1[Lc2(Fif2 + tr2\' -1) - 1]/G1
By definition tr = Nif2/kTo = (shot etc. + kTo)/kTo. (see p 2-44 in text).
Here Nif2\' = shot etc. + (kTo/2)(1 + [G1/Lc1]) where the G1/Lc1 term accounts for the
excess thermal noise (G1/Lc1 = 1 if there is no first amplifier). Thus, tr2\' = Nif2/kTo =
tr2 + ([G1/Lc1] - 1)/2 and
F = Lc1(Fif1 + tr1 - 1) + Lc1{Lc2(Fif2 - 1 + tr2 + [([G1/Lc1] - 1)/2]) - 1}/G1
-2-                                         12/22/03', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'choices' => array('Pas .
-2-                                       12/22/03', '.
-2-                                       12/22/03', 'Impossible à déterminer', 'L\'inverse de .
-2-                                       12/22/03'), 'correct' => 1, 'answer' => '.
-2-                                       12/22/03', '_recupere_le' => '2026-11-04T19:55:22.745858+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What happens to the output signal and the
local oscillator noise when both diodes in                signal
this circuit are reversed?                                                           output', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Nothing. The local-oscillator noise is identical on both reversed diodes and still
cancels, while the signal terms are still out of phase and pass through the transformer to
the i.f. amplifier.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What happens to the output signal and the
local oscillator noise when both diodes in                signal
this circuit are reversed?                                                           output]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What happens to the output signal and the
local oscillator noise when both diodes in                signal
this circuit are reversed?                                                           output', '_recupere_le' => '2026-11-04T19:55:22.745969+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Nothing. The local-oscillator noise is identical on both reversed diodes and still
cancels, while the signal terms are still out of phase and pass through the transformer to
')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What happens to the output signal and the
local oscillator noise when the local
oscillator and signal are swapped and put                                     Configuration
in the others\' port? Should the diodes be                            (a)     before any swap
changed to make this configuration work          L.O.
and, if so, how?
-3-                                          12/22/03', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The local oscillator noise at i.f. frequencies results when the local oscillator signal at
the diode mixes with its own noise sidebands, both of which are subject to the same
phase changes at the junctions of the multiport. Therefore their product is the same in
both arms of the 4-port device regardless of whether both diodes are reversed or remain
the same, and thus both noises cancel in the transformer. The products of the signal and
local oscillator signals remain out of phase in the two diodes, provided they are both up
or both reversed, and therefore the signal passes through the transformer to the i.f.
amplifier. Therefore nothing happens and no other changes should be made.
-3-                                       12/22/03

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What happens to the output signal and the
local oscillator noise when the local
oscillator and signal are swapped and put                                     Configuration
in the others\' port? Should the diodes be                            (a)     before any swap
changed to make this configuration work          L.O.
and, if so, how?
-3-                                          12/22/03]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What happens to the output signal and the
local oscillator noise when the local
oscillator and signal are swapped and put                                     Configuration
in the others\' port? Should the diodes be                            (a)     before any swap
changed to make this configuration work          L.O.
and, if so, how?
-3-                                          12/22/03', '_recupere_le' => '2026-11-04T19:55:22.746146+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The local oscillator noise at i.f. frequencies results when the local oscillator signal at
the diode mixes with its own noise sidebands, both of which are subject to the same')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Consider the limit where the intermolecular collisions of the gas are very frequent (N
sec-1) compared to the nominal lifetime τ of the state (τ(sec) ≅ 1/A; A is the "Einstein
A"). What is the effective temperature Teff characterizing the relative values of n1, n2,
E1, and E2 for this special case where N >> A?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : When collisions are more frequent than other events influencing level populations,
the level populations are determined by the kinetic temperature of the gas, Teff = Tk.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Consider the limit where the intermolecular collisions of the gas are very frequent (N
sec-1) compared to the nominal lifetime τ of the state (τ(sec) ≅ 1/A; A is the "Einstein
A"). What is the effective temperature Teff characterizing the relative values of n1, n2,
E1, and E2 for this special case where N >> A?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Consider the limit where the intermolecular collisions of the gas are very frequent (N
sec-1) compared to the nominal lifetime τ of the state (τ(sec) ≅ 1/A; A is the "Einstein
A"). What is the effective temperature Teff characterizing the relative values of n1, n2,
E1, and E2 for this special case where N >> A?', '_recupere_le' => '2026-11-04T19:55:22.746273+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : When collisions are more frequent than other events influencing level populations,
the level populations are determined by the kinetic temperature of the gas, Teff = Tk.

[Co')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Repeat (a) for the case where intermolecular gas collisions do not occur (N→0).', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : When there are no collisions, transitions between levels are dominated by radiative
processes, so Teff = Tbb, the radiation temperature determined by the surrounding
blackbody.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Repeat (a) for the case where intermolecular gas collisions do not occur (N→0).]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Repeat (a) for the case where intermolecular gas collisions do not occur (N→0).', '_recupere_le' => '2026-11-04T19:55:22.746324+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : When there are no collisions, transitions between levels are dominated by radiative
processes, so Teff = Tbb, the radiation temperature determined by the surrounding
blackbod')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What are the relative values of n1 and n2 for case (a)?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The Boltzmann distribution for the average number of atoms in a given state is:
⎯n ∝ e-E/kT, so n1/n2 ≅ e(E2 - E1 )/kT.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What are the relative values of n1 and n2 for case (a)?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What are the relative values of n1 and n2 for case (a)?', '_recupere_le' => '2026-11-04T19:55:22.746367+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The Boltzmann distribution for the average number of atoms in a given state is:
⎯n ∝ e-E/kT, so n1/n2 ≅ e(E2 - E1 )/kT.

[Correction officielle MIT : [MIT 6.661 — question d’')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What is the least-square-error estimate for p if d = a? [Hint: a figure might help here.]', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The probability distribution p(p|a) is uniform over the
interval p = 0 → 1, and the least-square-estimate is thus a/2,          d
and not a.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the least-square-error estimate for p if d = a? [Hint: a figure might help here.]]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What is the least-square-error estimate for p if d = a? [Hint: a figure might help here.]', '_recupere_le' => '2026-11-04T19:55:22.746422+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The probability distribution p(p|a) is uniform over the
interval p = 0 → 1, and the least-square-estimate is thus a/2,          d
and not a.

[Correction officielle MIT : [MI')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Repeat (a) for the case where d = 2a.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If d = 2a, the same logic (see figure) suggests the estimate            a
p = a.
0             p

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Repeat (a) for the case where d = 2a.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Repeat (a) for the case where d = 2a.', '_recupere_le' => '2026-11-04T19:55:22.746459+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : If d = 2a, the same logic (see figure) suggests the estimate            a
p = a.
0             p

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Re')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What is the maximum-aposteriori (MAP) estimate for p for case (b), if any? Explain.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The aposteriori probability distribution here is flat, so the
maximum could be anywhere from p = 0 to p = 2a.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the maximum-aposteriori (MAP) estimate for p for case (b), if any? Explain.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What is the maximum-aposteriori (MAP) estimate for p for case (b), if any? Explain.', '_recupere_le' => '2026-11-04T19:55:22.746512+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The aposteriori probability distribution here is flat, so the
maximum could be anywhere from p = 0 to p = 2a.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Explain your', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Most credit-card based measures within purchase categories will vary non-linearly
with the personal income of the card holder. For example, there will be essentially
zero purchases of items costing more than one\'s annual income, or some reasonable
fraction thereof. And, no matter how wealthy they are, essentially no one will
purchase more of something than they can consume in a reasonable time, for
example, toothpaste. These non-linearities are plausibly different for different
categories of expenditure, no matter what they are. Because there are 100 such non-
linear measures, it is plausible that many possible combinations would yield, on
average, an estimate linearly related to personal income, even if the variance of the
estimate were high. Averaging over 1000 people to determine the influence of 100
metrics should be reasonably robust.', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'choices' => array('Impossible à déterminer', 'L\'inverse de .', 'Pas .', '.'), 'correct' => 3, 'answer' => '.', '_recupere_le' => '2026-11-04T19:55:22.746561+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What sorts of non-linear estimators might be useful for this problem?               Some
imagination might help here.', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Other non-linear credit-card metrics can also be imagined, such as payment history,
variances, and fluctuation behavior. In general, metrics relating to the fraction of
expenditures for luxury items relative to expenditures for basic needs would be
helpful, where ratios are non-linear. Also, the presence of clusters of high-cost
purchases versus rationed expenditures could also be informative, particularly if they
are discretionary, implying the bank account from which the card bill is paid must be
large.', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'choices' => array('L\'inverse de s', 'Impossible à déterminer', 'Pas s', 's'), 'correct' => 3, 'answer' => 's', '_recupere_le' => '2026-11-04T19:55:22.746663+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What transmitter power Pt is required to meet the FM threshold requirements?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Referring to Figure 4.7-10 and associated text, the FM threshold S/N for β* = 10 is
approximately 18 dB, so Pc/BkT = 101.8 and Pr = Pc > 63×2W(1 + β*)kT
= 63×2×104(1+10)1.38×10-23×4000 = 7.7×10-13 W received and 7.7×10-6 W
transmitted

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What transmitter power Pt is required to meet the FM threshold requirements?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What transmitter power Pt is required to meet the FM threshold requirements?', '_recupere_le' => '2026-11-04T19:55:22.746717+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Referring to Figure 4.7-10 and associated text, the FM threshold S/N for β* = 10 is
approximately 18 dB, so Pc/BkT = 101.8 and Pr = Pc > 63×2W(1 + β*)kT
= 63×2×104(1+10)1.38×')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What transmitter power Pt is required to meet the output SNR requirements?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The output SNR requirement is 20+40 = 60 dB, where Sout/Nout = Pc<s2>3β*2/2NoW
= 106, so Pc ≅ 106×2×1.38×10-23×4000×104/(0.5×3×100)
= 7.36×10-12W; Pt ≅ 7.4×10-5W.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What transmitter power Pt is required to meet the output SNR requirements?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What transmitter power Pt is required to meet the output SNR requirements?', '_recupere_le' => '2026-11-04T19:55:22.746765+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The output SNR requirement is 20+40 = 60 dB, where Sout/Nout = Pc<s2>3β*2/2NoW
= 106, so Pc ≅ 106×2×1.38×10-23×4000×104/(0.5×3×100)
= 7.36×10-12W; Pt ≅ 7.4×10-5W.

[Correctio')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Approximately what is the maximum β* we need here? Explain briefly.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The requirements for Pt are a factor of ~9.6 greater than the FM threshold, so we
could reduce β* slightly to x, where 102/x2 = 9.6, so the new x = β* could be 3.23, but
then the only margin left would be due to the fact that the FM threshold drops slightly
with β*.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Approximately what is the maximum β* we need here? Explain briefly.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Approximately what is the maximum β* we need here? Explain briefly.', '_recupere_le' => '2026-11-04T19:55:22.746812+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The requirements for Pt are a factor of ~9.6 greater than the FM threshold, so we
could reduce β* slightly to x, where 102/x2 = 9.6, so the new x = β* could be 3.23, but
then')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What is the minimum diameter telescope (m) we need to use to avoid aliasing?
Assume uniformly illuminated telescope apertures.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Aliasing can occur when either the stars beyond 1 arc sec or unknown objects within
the 0.1-arc-sec radius are aliased into the reconstructed image. One sensible strategy is
to set the minimum telescope diameter to avoid aliasing of those stars beyond ~1 arc
second, i.e. beyond ~5×10-6 radians, and to avoid aliasing of objects closer than 0.1 arc
sec by imaging that region with sufficiently dense observations in⎯τλ space, as discussed
below in parts (c) and (d). Basically, we want all distant stars to be beyond the first null
in the diffraction pattern of the individual telescopes, or more than ~λ/D away. Setting
λ/D ≅ 5×10-6 ⇒ D ≅ 10-6/5×10-6 ≅ 20 cm. Although telescope sidelobes do result in some
aliasing, these sidelobes can be reduced by suitably apodizing the telescope aperture.
Alternatively smaller telescopes could be used, but then a larger area must be mapped
near the target star, enabling these neighboring stars to be identified and subtracted from
the synthetic image. Also, the answer to part (c) below would increase as the square of
the diameter of the viewed region, and the reduced photon flux for smaller mirrors would
also increase the required integration time.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the minimum diameter telescope (m) we need to use to avoid aliasing?
Assume uniformly illuminated telescope apertures.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What is the minimum diameter telescope (m) we need to use to avoid aliasing?
Assume uniformly illuminated telescope apertures.', '_recupere_le' => '2026-11-04T19:55:22.746873+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Aliasing can occur when either the stars beyond 1 arc sec or unknown objects within
the 0.1-arc-sec radius are aliased into the reconstructed image. One sensible strategy is
')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What is the maximum separation (m) required between the two telescopes?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The angular resolution of a synthesized image is λ./2L, where L is the maximum
separation needed in the synthesis procedure, and 2L/λ is the full width of the field
autocorrelation function φE(τλ). Therefore 2L/λ is also the maximum angular frequency
that can be resolved, given as 108 periods/radian. Therefore L = 108×10-6/2 = 50 m.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the maximum separation (m) required between the two telescopes?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What is the maximum separation (m) required between the two telescopes?', '_recupere_le' => '2026-11-04T19:55:22.746926+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The angular resolution of a synthesized image is λ./2L, where L is the maximum
separation needed in the synthesis procedure, and 2L/λ is the full width of the field
autocorre')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
How many distinct observations of fringe magnitude and phase are required to
construct a complete two-dimensional image with the desired resolution (10-8
radians/period)?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The field autocorrelation function must be sampled sufficiently often that the
unknown region of diameter 0.2 arc sec is not aliased on top of itself. Fortunately the
region between 0.1 and 1 arc sec from center is known to be empty, and the stars beyond
that are beyond the diffraction limit of the telescopes that are being used (part (a)). The
aliased images are spaced λ/X apart, where X is the separation between the observed
samples of φE(τλ). Here we require λ/X > 0.2 arc sec = 10-6 radians to avoid aliasing of
the 0.1-arc sec region. Therefore X ≤ 106λ ≅ 1 m. Now we can compute the required
number of observations of φE(τλ). L/X = 50/1 = 50, so we need 2×502 = 5000
observations of φE(τλ). The factor of two is needed because we need to observe two
quadrants of φE(τλ), before we use φE(τλ) = φE*(-τλ) to fill in the other two quadrants.
τλy                                                      λ/D = 10-8 radians
X=1m
= 0.002 arc sec
50 m
τλx                       0.1 arc sec                       θX
0

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
How many distinct observations of fringe magnitude and phase are required to
construct a complete two-dimensional image with the desired resolution (10-8
radians/period)?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
How many distinct observations of fringe magnitude and phase are required to
construct a complete two-dimensional image with the desired resolution (10-8
radians/period)?', '_recupere_le' => '2026-11-04T19:55:22.747001+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The field autocorrelation function must be sampled sufficiently often that the
unknown region of diameter 0.2 arc sec is not aliased on top of itself. Fortunately the
region')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
If these measurements of magnitude and phase were to be made simultaneously, what
is the minimum number of telescopes required?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If the telescope apertures were square, we would need three rows of 50 telescopes
arranged along three of the four sides of a field 50 m square, or perhaps in the shape of a
tee, i.e., 150 telescopes. Since we probably are using circular apertures, the telescopes
might be arranged more in the form of a circle, and the numbers might be reduced
slightly.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
If these measurements of magnitude and phase were to be made simultaneously, what
is the minimum number of telescopes required?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
If these measurements of magnitude and phase were to be made simultaneously, what
is the minimum number of telescopes required?', '_recupere_le' => '2026-11-04T19:55:22.747063+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : If the telescope apertures were square, we would need three rows of 50 telescopes
arranged along three of the four sides of a field 50 m square, or perhaps in the shape of a
')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Sketch and dimension the antenna pattern along the x and y axes, and quantitatively
determine the on-axis antenna gain Go and the angular positions of the first nulls and
sidelobes. Are the gains of the first sidelobes on the x and y axes equal? Explain
briefly.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The on-axis gain Go is 4πA/λ2 where A is the effective area. But for a uniformly
illuminated aperture, A is the physical area, 2D×D here. So Go = 8πD2/λ2. The
antenna pattern is proportional to the square of the 2-D Fourier transform of the
aperture excitation function, or to a 2-D sinc2 function, i.e.,
G(θx,θy)
The gains at the two first sidelobes                       Go
(on x and y axes) are approximately
equal because the integrals are the
same. See (3.3.3) which shows that
the (1 + cosθ) factor would be slightly                                                     θx
different for the two sidelobes                 θy                λ/D
because they are at slightly different                  λ/2D
~1.5λ/D
angles θ.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Sketch and dimension the antenna pattern along the x and y axes, and quantitatively
determine the on-axis antenna gain Go and the angular positions of the first nulls and
sidelobes. Are the gains of the first sidelobes on the x and y axes equal? Explain
briefly.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Sketch and dimension the antenna pattern along the x and y axes, and quantitatively
determine the on-axis antenna gain Go and the angular positions of the first nulls and
sidelobes. Are the gains of the first sidelobes on the x and y axes equal? Explain
briefly.', '_recupere_le' => '2026-11-04T19:55:22.747168+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The on-axis gain Go is 4πA/λ2 where A is the effective area. But for a uniformly
illuminated aperture, A is the physical area, 2D×D here. So Go = 8πD2/λ2. The
antenna pattern')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Sketch the approximate antenna gain G(θ) along the x axis if the center of this
aperture is blocked by a square absorber of dimensions 0.2D × 0.2D. The angle θ is
measured from the z axis. For reference, sketch on the same figure the corresponding
G(θ) if the aperture had no blockage. Numerical precision is not requested here, just
the qualitative differences of magnitude and angle relevant to pattern peaks and
minima.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The on-axis electrical far field is proportional to the integral (see Eqn. 3.3.3) of the
electrical field over the illuminated portion of the aperture, which is equivalent to the
integral over the whole aperture (yielding the original⎯E pattern), minus the integral
over the blocked portion (yielding the original⎯E pattern, but 5 and 10 times wider
and with 0.022 times the on-axis gain). The magnitude of the far-field⎯E is thus
reduced by a fraction of (0.2)2/(1×2) = 0.02, leaving 0.98|⎯E |. The gain is
proportional to the square of the field, so it is reduced about 4 percent (0.982 ≅ 0.96).
This 4 percent power is half (2%) distributed into the new wide diffraction sidelobes
shown in the figure, and half into side and back lobes due to scattering from the
structure itself. Since a linear scale would not reveal the new sidelobes because they
are too small, a log scale is more useful. The new sidelobe pateau added has gain
relative to Go of 0.022 = 0.0004, which is 34 dB less. The minima positions are
changed only negligibly until we get to sidelobes below about 30 dB, so the blocked-
portion integral becomes comparable to the sidelobe contribution from the
unblocked portion.
~ -17 dB                           ~ -17 dB
~ -34 dB

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Sketch the approximate antenna gain G(θ) along the x axis if the center of this
aperture is blocked by a square absorber of dimensions 0.2D × 0.2D. The angle θ is
measured from the z axis. For reference, sketch on the same figure the corresponding
G(θ) if the aperture had no blockage. Numerical precision is not requested here, just
the qualitative differences of magnitude and angle relevant to pattern peaks and
minima.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Sketch the approximate antenna gain G(θ) along the x axis if the center of this
aperture is blocked by a square absorber of dimensions 0.2D × 0.2D. The angle θ is
measured from the z axis. For reference, sketch on the same figure the corresponding
G(θ) if the aperture had no blockage. Numerical precision is not requested here, just
the qualitative differences of magnitude and angle relevant to pattern peaks and
minima.', '_recupere_le' => '2026-11-04T19:55:22.747321+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The on-axis electrical far field is proportional to the integral (see Eqn. 3.3.3) of the
electrical field over the illuminated portion of the aperture, which is equivalent to')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What is the approximate antenna gain Go\' with the blockage of (b) in place?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Go ≅ 0.96×8πD2/λ2 (see (a) and (b) solutions).

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the approximate antenna gain Go\' with the blockage of (b) in place?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What is the approximate antenna gain Go\' with the blockage of (b) in place?', '_recupere_le' => '2026-11-04T19:55:22.747369+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Go ≅ 0.96×8πD2/λ2 (see (a) and (b) solutions).

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the approximate antenna gain Go\' with the bl')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
If we wish to have an antenna beamwidth at 3-mm wavelength that is comparable to
the angular extent of the planet Venus as seen from Earth (1-arc min in diameter,
maximum), approximately what should D be? [Sidenote: since there are ~57.3
degrees per radian and 60 arc minutes per degree, 1 arc minute subtends the same
angle as a 1-cm marble seen at ~34 m, and is approximately the diffraction limit of
the human eye.]', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : For a reasonable aperture taper, the beamwidth θB ≅ 1.3λ/D = 1/57.3×60 radians,
where λ = 0.003. It follows that D ≅ 1.3×0.003×57.3×60 = 13.4 meters.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
If we wish to have an antenna beamwidth at 3-mm wavelength that is comparable to
the angular extent of the planet Venus as seen from Earth (1-arc min in diameter,
maximum), approximately what should D be? [Sidenote: since there are ~57.3
degrees per radian and 60 arc minutes per degree, 1 arc minute subtends the same
angle as a 1-cm marble seen at ~34 m, and is approximately the diffraction limit of
the human eye.]]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
If we wish to have an antenna beamwidth at 3-mm wavelength that is comparable to
the angular extent of the planet Venus as seen from Earth (1-arc min in diameter,
maximum), approximately what should D be? [Sidenote: since there are ~57.3
degrees per radian and 60 arc minutes per degree, 1 arc minute subtends the same
angle as a 1-cm marble seen at ~34 m, and is approximately the diffraction limit of
the human eye.]', '_recupere_le' => '2026-11-04T19:55:22.747526+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : For a reasonable aperture taper, the beamwidth θB ≅ 1.3λ/D = 1/57.3×60 radians,
where λ = 0.003. It follows that D ≅ 1.3×0.003×57.3×60 = 13.4 meters.

[Correction officielle')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
2
Referring to (3.3.58), the gain reduction of one dB corresponds to the factor e-(b4π/λ)
and also to the factor 10-(one/10) = 0.79, where a factor expressed as dB = 10 log10(factor).
Therefore -0.23 = -(b4π/λ)2 and
σo ≡ b = (λ/4π)(0.23)0.5 = (6×10-7/4π)0.48 = 23 nm = λ/26.
Approximately what is the maximum value of σo that will yield near-sidelobe
levels more than 30 dB below the main lobe?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If the main diffraction lobe is diminished by 1 dB, or 21 percent, then this power
must enter the sidelobes which, in a statistical sense, correspond to the convolution
of the diffraction pattern of the original pattern with that of the perturbation
correlation function. The perturbation scale length of 1 cm corresponds to a
beamwidth for the new sidelobes on the order of λ/0.02, where we use 2 cm because
the autocorrelation function φσ(τ) is even, and the correlation length is 1 cm in one
direction and therefore 1 cm in the other. If these new sidelobes had the same width
as the unperturbed main beam, then their amplitude would be 21 percent of the
original, or down ~6.8 dB. But the beam is wider by a factor of ~20cm/1cm, and its
solid angle is 400 times (26 dB) greater. Since the power is still 21 percent of the
total, the new sidelobe plateau is down ~6.8 + 26 = 32.8 dB. If we ignore possible
interference with the original sidelobes, the level of which was not provided in the
problem but which presumably must be below 30 dB to render the problem
interesting, then we can afford somewhat poorer surface tolerances here. That is, the
6.8 dB loss can then be reduced by 2.8 dB to equal 3 dB, implying the
factor e −( b4π λ ) can now become 0.5. Solving (a) for this assumption yields
2
ln 0.5 = − ( b4π λ )
2
b     = ln 0.5 λ 4π
≅ 39.8 nm
Obviously other assumptions about the original sidelobe level could be made, and
then the interference between the two contributions might be noted. If two equal
field contributions coherently add (the old sidelobe plus the tolerance-induced
sidelobe), then the power in that direction (sidelobe) is quadurupled, or increased by
6 dB. In other directions these two contributions might cancel, but when we speak
of sidelobe levels we usually intend either their peak levels or their average levels,
which might approximate half the peak values (say ~3-dB down). Thus the peak
levels concern us more.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
2
Referring to (3.3.58), the gain reduction of one dB corresponds to the factor e-(b4π/λ)
and also to the factor 10-(one/10) = 0.79, where a factor expressed as dB = 10 log10(factor).
Therefore -0.23 = -(b4π/λ)2 and
σo ≡ b = (λ/4π)(0.23)0.5 = (6×10-7/4π)0.48 = 23 nm = λ/26.
Approximately what is the maximum value of σo that will yield near-sidelobe
levels more than 30 dB below the main lobe?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
2
Referring to (3.3.58), the gain reduction of one dB corresponds to the factor e-(b4π/λ)
and also to the factor 10-(one/10) = 0.79, where a factor expressed as dB = 10 log10(factor).
Therefore -0.23 = -(b4π/λ)2 and
σo ≡ b = (λ/4π)(0.23)0.5 = (6×10-7/4π)0.48 = 23 nm = λ/26.
Approximately what is the maximum value of σo that will yield near-sidelobe
levels more than 30 dB below the main lobe?', '_recupere_le' => '2026-11-04T19:55:22.747756+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : If the main diffraction lobe is diminished by 1 dB, or 21 percent, then this power
must enter the sidelobes which, in a statistical sense, correspond to the convolution
of th')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
2
Referring to (3.3.58), the gain reduction of one dB corresponds to the factor e-(b4π/λ)
and also to the factor 10-(one/10) = 0.79, where a factor expressed as dB = 10 log10(factor).
Therefore -0.23 = -(b4π/λ)2 and
σo ≡ b = (λ/4π)(0.23)0.5 = (6×10-7/4π)0.48 = 23 nm = λ/26.
If this telescope suffers from 1-dB losses at 1-micron wavelength, what is the
shortest wavelength at which this telescope is probably useful? Assume that at this
shortest “useful” wavelength the on-axis gain losses relative to perfect illumination are
~6 dB [~factor of four].', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Now the factor e-(b4π/λ)2 = 0.25, where b = 23 nm and λ is unknown. Therefore
λ = 4πb(ln 0.25)-0.5 = 0.34 microns, which is in the ultraviolet and beyond the
atmospheric cutoff wavelength so that atmospheric absorption precludes long
pathlengths for communications or sensing purposes.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
2
Referring to (3.3.58), the gain reduction of one dB corresponds to the factor e-(b4π/λ)
and also to the factor 10-(one/10) = 0.79, where a factor expressed as dB = 10 log10(factor).
Therefore -0.23 = -(b4π/λ)2 and
σo ≡ b = (λ/4π)(0.23)0.5 = (6×10-7/4π)0.48 = 23 nm = λ/26.
If this telescope suffers from 1-dB losses at 1-micron wavelength, what is the
shortest wavelength at which this telescope is probably useful? Assume that at this
shortest “useful” wavelength the on-axis gain losses relative to perfect illumination are
~6 dB [~factor of four].]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
2
Referring to (3.3.58), the gain reduction of one dB corresponds to the factor e-(b4π/λ)
and also to the factor 10-(one/10) = 0.79, where a factor expressed as dB = 10 log10(factor).
Therefore -0.23 = -(b4π/λ)2 and
σo ≡ b = (λ/4π)(0.23)0.5 = (6×10-7/4π)0.48 = 23 nm = λ/26.
If this telescope suffers from 1-dB losses at 1-micron wavelength, what is the
shortest wavelength at which this telescope is probably useful? Assume that at this
shortest “useful” wavelength the on-axis gain losses relative to perfect illumination are
~6 dB [~factor of four].', '_recupere_le' => '2026-11-04T19:55:22.747980+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Now the factor e-(b4π/λ)2 = 0.25, where b = 23 nm and λ is unknown. Therefore
λ = 4πb(ln 0.25)-0.5 = 0.34 microns, which is in the ultraviolet and beyond the
atmospheric cuto')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Show that the output vo(t) of the                        θ
simple adding interferometer shown here
a(t)                       b(t)
is proportional to the time average of the
product of the two signals a(t) and b(t)
after a DC term is subtracted.                       L
( )2     low-pass filter    v o (t)', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : <(a + b)2> = <a2> + <b2> + 2<ab> where the DC terms <a2> + <b2> can be
subtracted, leaving the time average of the product of the two signals a(t) and b(t).
Q.E.D.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Show that the output vo(t) of the                        θ
simple adding interferometer shown here
a(t)                       b(t)
is proportional to the time average of the
product of the two signals a(t) and b(t)
after a DC term is subtracted.                       L
( )2     low-pass filter    v o (t)]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Show that the output vo(t) of the                        θ
simple adding interferometer shown here
a(t)                       b(t)
is proportional to the time average of the
product of the two signals a(t) and b(t)
after a DC term is subtracted.                       L
( )2     low-pass filter    v o (t)', '_recupere_le' => '2026-11-04T19:55:22.748124+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : <(a + b)2> = <a2> + <b2> + 2<ab> where the DC terms <a2> + <b2> can be
subtracted, leaving the time average of the product of the two signals a(t) and b(t).
Q.E.D.

[Correcti')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Assume we must use a diode with i = v2 + cv3 instead of the illustrated square-law
device, and that a(t) and b(t) are narrowband signals centered at 100 MHz. How might
you change the circuit (minimally, if at all) so that the interferometer still works? Note
that the same issue arises in communications receivers employing matched filters.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : <(a + b)2> + <(a + b)3> = <a2> + <b2> + 2<ab> + c[<a3> + 2<a2b> + 2<ab2>
+ <b3>]. All the cubed terms average to zero, so a non-ideal diode with odd terms in
the diode characteristic still functions as an ideal multiplier. The higher-order even
powers are of greater potential interest, but the ability of the square term plus all
higher order odd terms to approximate the local i-v characteristic of a diode leaves
little room for producing much DC energy due to other terms. Only in highly
sensitive systems is this a typical concern.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Assume we must use a diode with i = v2 + cv3 instead of the illustrated square-law
device, and that a(t) and b(t) are narrowband signals centered at 100 MHz. How might
you change the circuit (minimally, if at all) so that the interferometer still works? Note
that the same issue arises in communications receivers employing matched filters.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Assume we must use a diode with i = v2 + cv3 instead of the illustrated square-law
device, and that a(t) and b(t) are narrowband signals centered at 100 MHz. How might
you change the circuit (minimally, if at all) so that the interferometer still works? Note
that the same issue arises in communications receivers employing matched filters.', '_recupere_le' => '2026-11-04T19:55:22.748255+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : <(a + b)2> + <(a + b)3> = <a2> + <b2> + 2<ab> + c[<a3> + 2<a2b> + 2<ab2>
+ <b3>]. All the cubed terms average to zero, so a non-ideal diode with odd terms in
the diode charac')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
This thermal current io introduces                                            +
shot noise vshot (rms) across the load         +                            vo
resistor R which adds to the                   V                R
i
Johnson noise vJ from the resistor
R. In order for this shot noise vshot          -
to equal vJ from R, what should R                                             -
be?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : vshot = R(2Be⎯i)0.5 and vJ = (4kTBR)0.5. Equating them ⇒ R = 2kT/(e⎯i )

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
This thermal current io introduces                                            +
shot noise vshot (rms) across the load         +                            vo
resistor R which adds to the                   V                R
i
Johnson noise vJ from the resistor
R. In order for this shot noise vshot          -
to equal vJ from R, what should R                                             -
be?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
This thermal current io introduces                                            +
shot noise vshot (rms) across the load         +                            vo
resistor R which adds to the                   V                R
i
Johnson noise vJ from the resistor
R. In order for this shot noise vshot          -
to equal vJ from R, what should R                                             -
be?', '_recupere_le' => '2026-11-04T19:55:22.748443+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : vshot = R(2Be⎯i)0.5 and vJ = (4kTBR)0.5. Equating them ⇒ R = 2kT/(e⎯i )

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
This thermal current io int')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
To within a constant multiplier, approximately how does the dark current i0 vary
with junction temperature T? Assume that T is near room temperature so that kT <<
Eg, and that the energy level distribution (states per volt) is uniform in the valence
and conduction bands.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The dark current is associated with thermal excitations of electrons across the energy
gap. We shall assume the state density (levels per e.v.) is uniform in the conduction
band. Although the gap between the acceptor levels and the conduction band is
slightly less than Eg, the doping density is generally low so that most excitations
jump the full gap. The Boltzmann energy distribution for photons/phonons is
exponential ∝ e-E/kT, and the current is proportional to the integral of the upper tail of
this distribution where E > ~Eg. Thus,
io ∝ ∫Eg∞ Te-E/kT dE = (-kT2)e-E/kGT|Eg∞ = (kT2)e-Eg/kT.
Because generally Eg >> kT, the exponential dependence on T dominates (one e.v.
corresponds to T ≅ 11,600K). In silicon Eg ≅ 1.12 volts, and has a small temperature
dependence, ignored here.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
To within a constant multiplier, approximately how does the dark current i0 vary
with junction temperature T? Assume that T is near room temperature so that kT <<
Eg, and that the energy level distribution (states per volt) is uniform in the valence
and conduction bands.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
To within a constant multiplier, approximately how does the dark current i0 vary
with junction temperature T? Assume that T is near room temperature so that kT <<
Eg, and that the energy level distribution (states per volt) is uniform in the valence
and conduction bands.', '_recupere_le' => '2026-11-04T19:55:22.748552+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The dark current is associated with thermal excitations of electrons across the energy
gap. We shall assume the state density (levels per e.v.) is uniform in the conduction
b')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
For both PD\'s and APD\'s the CNR is:
ηPS/hf2B____________                                  (1)
[(1 + PD/PS)<g2>/G2] + 2kThf/(RLηPS(eG)2)
where <g2> = G2 = 1 for PD\'s (see (2.4.14) in the text), and <g2>/G2 ≅ Gx for APD\'s ≅
G0.3 here . APD\'s perform better than PD\'s when the corresponding APD denominator is
smaller, i.e. when:
[(1 + PD/PS)G0.3] + 2kThf/(RLηPS(eG)2) < 1 + PD/PS + 2kThf/(RLηPSe2), or when
(1 - G-2)/(G0.3 - 1) > (1 + PD/PS)RLηPSe2/2kThf ⇒ APD\'s better
where (1 - G-2)/(G0.3 - 1) ≅ 1 + G-0.3 for G >> 1.
Repeat (a), but comparing PT\'s and PMT\'s to PD\'s and APD\'s. The system cost and
complexity of these devices generally increase in the order: PD, APD, PT, and PMT.
Refrigeration costs can exceed the device cost unless very low device power and
cooling is involved.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Referring to (1) above, which applies to all photodetectors, PMT\'s essentially always
outperform PT\'s, all parameters except G being equal. However this advantage
diminishes significantly when 2kThf < ~ RLηPSe2. PD\'s and PT\'s have the same
CNR equation, but the quantum efficiency η for PD\'s is typically several times
greater than for PT\'s, while the dark current power PD is many times greater. Thus
there is a preference for PT\'s when the dark-current disadvantage of photodiodes
outweighs their efficiency advantage: i.e. we prefer PT\'s over PD\'s when:
(PDD/PS) + 2kThf/(RLηDPSe2) > (PDT/PS) + 2kThf/(RLηTPSe2), or
(PDD - PDT)/(ηD - ηT) > 2kThf/(RLe2ηTηD) ⇒ PT\'s better
Referring to (1) again, we see that PMT\'s have better CNR\'s than APD\'s when the
excessive shot noise of APD\'s is more serious than their advantage in quantum
efficiency ηD:
Gx(1 + PDD/PS) + 2kThf/(RLηDPS(eG)2) > 1 + PDT/PS + 2kThf/(RLηT PS(eG)2)
or, Gx[1 + (PDD - PDT)/PS]/[ηD - ηT] > 1 + 2kThf/(RLηTηDPS(eG)2) ⇒ PMT\'s better.
Although refrigeration can markedly reduce PDD (see problem 5.1c above), it is
expensive below ~240K and especially 70K, 20K, or 4K (four common operating
zones).

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
For both PD\'s and APD\'s the CNR is:
ηPS/hf2B____________                                  (1)
[(1 + PD/PS)<g2>/G2] + 2kThf/(RLηPS(eG)2)
where <g2> = G2 = 1 for PD\'s (see (2.4.14) in the text), and <g2>/G2 ≅ Gx for APD\'s ≅
G0.3 here . APD\'s perform better than PD\'s when the corresponding APD denominator is
smaller, i.e. when:
[(1 + PD/PS)G0.3] + 2kThf/(RLηPS(eG)2) < 1 + PD/PS + 2kThf/(RLηPSe2), or when
(1 - G-2)/(G0.3 - 1) > (1 + PD/PS)RLηPSe2/2kThf ⇒ APD\'s better
where (1 - G-2)/(G0.3 - 1) ≅ 1 + G-0.3 for G >> 1.
Repeat (a), but comparing PT\'s and PMT\'s to PD\'s and APD\'s. The system cost and
complexity of these devices generally increase in the order: PD, APD, PT, and PMT.
Refrigeration costs can exceed the device cost unless very low device power and
cooling is involved.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
For both PD\'s and APD\'s the CNR is:
ηPS/hf2B____________                                  (1)
[(1 + PD/PS)<g2>/G2] + 2kThf/(RLηPS(eG)2)
where <g2> = G2 = 1 for PD\'s (see (2.4.14) in the text), and <g2>/G2 ≅ Gx for APD\'s ≅
G0.3 here . APD\'s perform better than PD\'s when the corresponding APD denominator is
smaller, i.e. when:
[(1 + PD/PS)G0.3] + 2kThf/(RLηPS(eG)2) < 1 + PD/PS + 2kThf/(RLηPSe2), or when
(1 - G-2)/(G0.3 - 1) > (1 + PD/PS)RLηPSe2/2kThf ⇒ APD\'s better
where (1 - G-2)/(G0.3 - 1) ≅ 1 + G-0.3 for G >> 1.
Repeat (a), but comparing PT\'s and PMT\'s to PD\'s and APD\'s. The system cost and
complexity of these devices generally increase in the order: PD, APD, PT, and PMT.
Refrigeration costs can exceed the device cost unless very low device power and
cooling is involved.', '_recupere_le' => '2026-11-04T19:55:22.748901+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Referring to (1) above, which applies to all photodetectors, PMT\'s essentially always
outperform PT\'s, all parameters except G being equal. However this advantage
diminishes')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Assume the dark count D is zero.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Referring to (2.4.60) for the desired case where τ ≅ 1/B, we have CNR < ~ηS/4B.
Therefore, we need S > ~4B (CNR)/η = 4×3000×100/η ≅ 1.2×106 for PD\'s with η≅1.
See pp 2-87 to 2-88 of new notes.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Assume the dark count D is zero.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Assume the dark count D is zero.', '_recupere_le' => '2026-11-04T19:55:22.748945+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Referring to (2.4.60) for the desired case where τ ≅ 1/B, we have CNR < ~ηS/4B.
Therefore, we need S > ~4B (CNR)/η = 4×3000×100/η ≅ 1.2×106 for PD\'s with η≅1.
See pp 2-87 to')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Assume D = 105 counts/sec.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : For D = 105, we choose a local oscillator power P sufficient to overwhelm D, so the
answer to (a) remains unchanged. However, since 2D >> B here, we would not
obtain a better CNR if we used a simple detector--see (2.4.62-3). Since 2D>>B,
superheterodynes are better

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Assume D = 105 counts/sec.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Assume D = 105 counts/sec.', '_recupere_le' => '2026-11-04T19:55:22.748981+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : For D = 105, we choose a local oscillator power P sufficient to overwhelm D, so the
answer to (a) remains unchanged. However, since 2D >> B here, we would not
obtain a better')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What is the nominal resistance R of the bolometer under these conditions? Hint: the
equilibrium heat flow to the bath equals the I2R power dissipated.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Heat balance: I2R = Gt(T - Tb), so R = Gt(T - Tb)/I2 = 10-7(22 - 18)/10-6 = 0.4 ohms

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the nominal resistance R of the bolometer under these conditions? Hint: the
equilibrium heat flow to the bath equals the I2R power dissipated.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What is the nominal resistance R of the bolometer under these conditions? Hint: the
equilibrium heat flow to the bath equals the I2R power dissipated.', '_recupere_le' => '2026-11-04T19:55:22.749050+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Heat balance: I2R = Gt(T - Tb), so R = Gt(T - Tb)/I2 = 10-7(22 - 18)/10-6 = 0.4 ohms

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the no')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What is the nominal rms Johnson noise nJ across the output terminals? Hint: The
bias resistor contribution should be negligible.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Johnson noise nJ = (4kTBR)0.5 = (4 × 1.38×10-23 × 22 × 0.5 × 0.4)0.5 = 1.6×10-11 volts

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the nominal rms Johnson noise nJ across the output terminals? Hint: The
bias resistor contribution should be negligible.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What is the nominal rms Johnson noise nJ across the output terminals? Hint: The
bias resistor contribution should be negligible.', '_recupere_le' => '2026-11-04T19:55:22.749113+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Johnson noise nJ = (4kTBR)0.5 = (4 × 1.38×10-23 × 22 × 0.5 × 0.4)0.5 = 1.6×10-11 volts

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What is the bolometer NEP (W/Hz) due to Johnson noise only?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : NEPJ = nJ/S (see (2.4.23), where (see (2.4.21)) S = -ITdR(1 + [I2TdR/GtT2])/GtT2 = -
M/(1 + IM) where M = ITdR/GtT2 = 10-3 × 5 × 0.4/(10-7 × 222) = 41.3, so
|S| = 41.3/(1 + 10-3×41.3) = 40 and
NEPJ = 1.6×10-11/40 = 4×10-13 [W Hz-0.5]

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the bolometer NEP (W/Hz) due to Johnson noise only?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What is the bolometer NEP (W/Hz) due to Johnson noise only?', '_recupere_le' => '2026-11-04T19:55:22.749156+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : NEPJ = nJ/S (see (2.4.23), where (see (2.4.21)) S = -ITdR(1 + [I2TdR/GtT2])/GtT2 = -
M/(1 + IM) where M = ITdR/GtT2 = 10-3 × 5 × 0.4/(10-7 × 222) = 41.3, so
|S| = 41.3/(1 + 1')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What is the contribution to bolometer NEP from phonon noise?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : See (2.4.27): NEPphonon ≅ (4kGtT2)0.5 ≅ (4×1.38×10-23×10-7×202)0.5 =
NEPphonon ≅ 4.7×10-14 [W Hz-0.5]

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the contribution to bolometer NEP from phonon noise?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What is the contribution to bolometer NEP from phonon noise?', '_recupere_le' => '2026-11-04T19:55:22.749198+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : See (2.4.27): NEPphonon ≅ (4kGtT2)0.5 ≅ (4×1.38×10-23×10-7×202)0.5 =
NEPphonon ≅ 4.7×10-14 [W Hz-0.5]

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What is the contribution to NEP from photon noise assuming infinite bandwidth and
2π solid angle?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : See (2.4.51-3): Ω = 2π here. Pr = ΑΩ σSBT4/π = 10-6 × 2π × 5.67×10-8 × 224/3.14 =
2.66×10-8 watts. NEPphoton noise = (Pr16kT)0.5 = (2.66×10-8 × 16 × 1.38×10-23 × 22)0.5
= NEPphoton noise = 1.14×10-14 [W Hz-0.5]

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the contribution to NEP from photon noise assuming infinite bandwidth and
2π solid angle?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What is the contribution to NEP from photon noise assuming infinite bandwidth and
2π solid angle?', '_recupere_le' => '2026-11-04T19:55:22.749251+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : See (2.4.51-3): Ω = 2π here. Pr = ΑΩ σSBT4/π = 10-6 × 2π × 5.67×10-8 × 224/3.14 =
2.66×10-8 watts. NEPphoton noise = (Pr16kT)0.5 = (2.66×10-8 × 16 × 1.38×10-23 × 22)0.5
= NEP')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What one or two bolometer parameters might we change first to improve its total
effective NEP? Discuss briefly.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Comparing (c-d) we see that phonon noise dominates, followed by Johnson noise.
To reduce phonon noise we might simply reduce the diode temperature T and the
thermal conductivity Gt, which could be contradictory. The remedy is probably to
reduce the bath temperature from 18 to 4K or so, thus dropping T substantially (note
that it is squared in (d)) and permitting Gt to drop too if necessary. This also reduces
nJ. If such a drop in bath temperature were not feasible, we might halve Gt, thus
doubling the temperature difference between the 18K bath and the (now) 26K diode
temperature. This reduces (GtT2)0.5 by a factor of 1.2. We could also drop NEPJ by
increasing the bias current I, but that would heat the diode, worsening the phonon
noise problem. This problem illustrates why it is difficult to build bolometers with
NEP below 10-14 without going to extremely low bath temperatures.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What one or two bolometer parameters might we change first to improve its total
effective NEP? Discuss briefly.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What one or two bolometer parameters might we change first to improve its total
effective NEP? Discuss briefly.', '_recupere_le' => '2026-11-04T19:55:22.749324+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Comparing (c-d) we see that phonon noise dominates, followed by Johnson noise.
To reduce phonon noise we might simply reduce the diode temperature T and the
thermal conductiv')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Find φm(τ) in terms of φs(0), φs(τ), and φn(τ), assuming E[nanb] = 0 and s and n are
gaussian with zero mean.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The solution follows the course notes. Part (a) is (2.2.33) where we compute
E[wxyz] = E[wx] E[yz] + E[wy] E[xz] + E[wz] E[xy], where w, x, y, and z
correspond to na1 + S1/20.5, nb1 + S1/20.5, na2 + S2/20.5, and nb2 + S2/20.5, respectively.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Find φm(τ) in terms of φs(0), φs(τ), and φn(τ), assuming E[nanb] = 0 and s and n are
gaussian with zero mean.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Find φm(τ) in terms of φs(0), φs(τ), and φn(τ), assuming E[nanb] = 0 and s and n are
gaussian with zero mean.', '_recupere_le' => '2026-11-04T19:55:22.749396+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The solution follows the course notes. Part (a) is (2.2.33) where we compute
E[wxyz] = E[wx] E[yz] + E[wy] E[xz] + E[wz] E[xy], where w, x, y, and z
correspond to na1 + S1/20')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Find Φm(f) in terms of φs(0), Φs(f), and Φn(f).', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The solution, (2.2.34), follows directly from (2.2.33) by noting the Fourier transform
of multiplication is convolution (*).

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Find Φm(f) in terms of φs(0), Φs(f), and Φn(f).]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Find Φm(f) in terms of φs(0), Φs(f), and Φn(f).', '_recupere_le' => '2026-11-04T19:55:22.749440+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The solution, (2.2.34), follows directly from (2.2.33) by noting the Fourier transform
of multiplication is convolution (*).

[Correction officielle MIT : [MIT 6.661 — questi')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
The expression produced in (b) has three parts, i.e. a “signal x signal” term, a “signal
x noise” term and a “noise x noise” term. Graph and fully dimension the power
density spectra corresponding to these three parts (using double-sided spectra in terms
of TA, TR, etc.).', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The signal and noise power density spectra have the same form:                       B
where the magnitude is kTA /2 and kTR/2 for signal and noise,                                 f
respectively. All three graphs for Φs(f) * Φs(f)/2, Φs(f) * Φn(f),           0
and Φn(f) * Φn(f) have the same form, but with different magnitudes
at the origin: they are (kTA)2B/4, k2TATBB/2, and (kTR)2B/2,                                  f
respectively. In addition, the s x s term has an impulse at the origin       0           2B
of magnitude (kTsB)2/4.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
The expression produced in (b) has three parts, i.e. a “signal x signal” term, a “signal
x noise” term and a “noise x noise” term. Graph and fully dimension the power
density spectra corresponding to these three parts (using double-sided spectra in terms
of TA, TR, etc.).]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
The expression produced in (b) has three parts, i.e. a “signal x signal” term, a “signal
x noise” term and a “noise x noise” term. Graph and fully dimension the power
density spectra corresponding to these three parts (using double-sided spectra in terms
of TA, TR, etc.).', '_recupere_le' => '2026-11-04T19:55:22.749553+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The signal and noise power density spectra have the same form:                       B
where the magnitude is kTA /2 and kTR/2 for signal and noise,')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Find the DC power and the AC power that emerges in the output vo(t).', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The output power spectral density Φo(f) = |H(f)|2Φm(f), where the components of
Φm(f) are sketched in part (c).
The output DC power is in the s x s impulse at f = 0, times |H(f=0)|2,
where |H(f=0)|2 = (∫h(t)dt)2 = (Aτ)2 by Parseval’s theorem. Thus
PDC = (kTAB)2(Aτ)2 /4
The AC power is limited to a very narrow bandwidth (~1/τ Hz) determined by H(f),
so only the power spectral densities near the origin are relevant here; these are given
in part (c) above. To integrate over frequency to obtain the total AC power we sum
the powers near zero frequency and multiply by ∫|H(f)|2df = ∫h2(t)dt = A2τ by
Parseval’s theorem. Thus
PAC = A2τ[(kTA)2B/4 + k2TATBB/2 + (kTR)2B/2]

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Find the DC power and the AC power that emerges in the output vo(t).]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Find the DC power and the AC power that emerges in the output vo(t).', '_recupere_le' => '2026-11-04T19:55:22.749599+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The output power spectral density Φo(f) = |H(f)|2Φm(f), where the components of
Φm(f) are sketched in part (c).
The output DC power is in the s x s impulse at f = 0, times |H')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Find ∆Trms.
-1-                                      12/22/03', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ∆Trms = (PAC)0.5/[∂(PDC)0.5/∂TA] where the AC and DC powers were found in (d).
(PAC)0.5 = kTeffA(Bτ)0.5/2 where Teff2 = TA2 + 2TATR + 2TR2
(PDC)0.5 = kTABAτ/2, so
∆Trms = Teff/(Bτ)0.5

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Find ∆Trms.
-1-                                      12/22/03]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Find ∆Trms.
-1-                                      12/22/03', '_recupere_le' => '2026-11-04T19:55:22.749675+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : ∆Trms = (PAC)0.5/[∂(PDC)0.5/∂TA] where the AC and DC powers were found in (d).
(PAC)0.5 = kTeffA(Bτ)0.5/2 where Teff2 = TA2 + 2TATR + 2TR2
(PDC)0.5 = kTABAτ/2, so
∆Trms = Tef')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What is the slowest sampling rate consistent with the foregoing requirements?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We wish to use only the spectrum below 10 MHz, so the 1000 spectral samples
are each 10 kHz wide (nominally). If there were no aliasing (implying perfect boxcar
-1-                                         12/22/03
filtering) and no apodization, then 1000 sample delays in the shift register are necessary
to yield 1000 independent power spectral densities. However, the aliasing resulting from
the given non-ideal 10-MHz filter requires us to increase the sampling frequency so the
1-MHz sidelobe region (see Figure in problem) does not fall inside the desired aliasing-
free central 10-MHz region. If we set the sampling frequency = 21 MHz, then the result
is as illustrated and as desired.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the slowest sampling rate consistent with the foregoing requirements?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What is the slowest sampling rate consistent with the foregoing requirements?', '_recupere_le' => '2026-11-04T19:55:22.749724+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : We wish to use only the spectrum below 10 MHz, so the 1000 spectral samples
are each 10 kHz wide (nominally). If there were no aliasing (implying perfect boxcar
-1-')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
How many stages are required for the shift register?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If we further apodize the observed autocorrelation function of the signal, then
proportionally still more taps are required to preserve 1000 independent spectral
intervals; the number of taps must therefore be further increased by a factor of 1.4 (given
in the problem). Thus the total required number of taps, or stages in the shift register, is:
1000 x 1.05 x 1.4 = 1470.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
How many stages are required for the shift register?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
How many stages are required for the shift register?', '_recupere_le' => '2026-11-04T19:55:22.749765+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : If we further apodize the observed autocorrelation function of the signal, then
proportionally still more taps are required to preserve 1000 independent spectral
intervals; t')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Prove that a conjugate match ZL = R - jX maximizes the power transferred from a
Thevenin source characterized by the impedance R + jX. This maximum is the
"available power" if R > 0. Assume the source impedance is fixed, and that of the
load is varied to yield the desired maximum.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Assume the Thevenin source has voltage Vs in series with Rs + jXs, and the load
voltage and current are V and I, respectively. The average power P dissipated in the
load resistor R is:
P = 0.5 Re{VI*}
= 0.5 Re {[Vs(R + jX)]/[(R + Rs) + j(X + Xs)] × Vs*/[(R + Rs) − j(X + Xs)]}
= 0.5|Vs|2 Re{(R + jX)/[(R + Rs)2 + (X + Xs)2]}
∂P/∂ x = 0 ⇒ X = -Xs and
∂P/∂R = 0 = 0.5|Vs|2 ∂[R/(R + Rs)2]/∂R → ∂[R/(R + Rs)2]/∂R = 0 ⇒
(R + Rs)-2 + R(-2)(R + Rs)-3 = 0 ⇒
R + Rs -2R = 0 ⇒ R = Rs Q.E.D.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Prove that a conjugate match ZL = R - jX maximizes the power transferred from a
Thevenin source characterized by the impedance R + jX. This maximum is the
"available power" if R > 0. Assume the source impedance is fixed, and that of the
load is varied to yield the desired maximum.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Prove that a conjugate match ZL = R - jX maximizes the power transferred from a
Thevenin source characterized by the impedance R + jX. This maximum is the
"available power" if R > 0. Assume the source impedance is fixed, and that of the
load is varied to yield the desired maximum.', '_recupere_le' => '2026-11-04T19:55:22.749877+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Assume the Thevenin source has voltage Vs in series with Rs + jXs, and the load
voltage and current are V and I, respectively. The average power P dissipated in the
load resi')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Recalling that the wave reflection coefficient from a load
at the end of a TEM line with characteristic impedance Zo
is Γ = V-/V+ = (ZLn - 1)/(ZLn + 1), what is the
exchangeable gain Ge of a negative-resistance load -RL?                        -RL
We define ZLn = ZL/Zo. This amplifier works by reflecting
a signal in a TEM line from a negative resistance load
which is preceded by a three-port circulator (discussed
later in the course; see Eqn. 2.3.37 in the text) that sends
the reflected signal out a different TEM port than the port through which the input
signal entered the amplifier. The negative-resistance load is often a tunnel diode
biased to its negative resistance point.
-2-                                      12/22/03', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Ge = |Γ|2 = |(ZLn - 1)/( ZLn + 1)|2 = |(-RL - R)/(-RL + R)|2 where ZLn = -RL/R
Therefore Ge → ∞ as RL→ R, Ge → 1 as RL → 0, ∞, and G ≅ 100 for RL ≅ 1.11R
The combination of a negative resistance amplifier and a 3-port circulator behaves
like a normal amplifier with positive resistance.
-2-                                       12/22/03

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Recalling that the wave reflection coefficient from a load
at the end of a TEM line with characteristic impedance Zo
is Γ = V-/V+ = (ZLn - 1)/(ZLn + 1), what is the
exchangeable gain Ge of a negative-resistance load -RL?                        -RL
We define ZLn = ZL/Zo. This amplifier works by reflecting
a signal in a TEM line from a negative resistance load
which is preceded by a three-port circulator (discussed
later in the course; see Eqn. 2.3.37 in the text) that sends
the reflected signal out a different TEM port than the port through which the input
signal entered the amplifier. The negative-resistance load is often a tunnel diode
biased to its negative resistance point.
-2-                                      12/22/03]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Recalling that the wave reflection coefficient from a load
at the end of a TEM line with characteristic impedance Zo
is Γ = V-/V+ = (ZLn - 1)/(ZLn + 1), what is the
exchangeable gain Ge of a negative-resistance load -RL?                        -RL
We define ZLn = ZL/Zo. This amplifier works by reflecting
a signal in a TEM line from a negative resistance load
which is preceded by a three-port circulator (discussed
later in the course; see Eqn. 2.3.37 in the text) that sends
the reflected signal out a different TEM port than the port through which the input
signal entered the amplifier. The negative-resistance load is often a tunnel diode
biased to its negative resistance point.
-2-                                      12/22/03', '_recupere_le' => '2026-11-04T19:55:22.750144+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Ge = |Γ|2 = |(ZLn - 1)/( ZLn + 1)|2 = |(-RL - R)/(-RL + R)|2 where ZLn = -RL/R
Therefore Ge → ∞ as RL→ R, Ge → 1 as RL → 0, ∞, and G ≅ 100 for RL ≅ 1.11R
The combination of a')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What is its Fourier transform?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : v(t) = u-1(t) e-αt, [See (1.2.1) in notes; u-1(t) = {0 for t < 0; = 1 otherwise}]
∞                         ∞                                                     ∞
V(f) = Ú-∞ u-1(t) e-αt e-j2πft dt = Ú0 e-(j2πf + α)t dt = (-1/(j2πf + α)) e-(j2πf + α)t|t=0
V(f) = +1/(j2πf + α)
∞

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is its Fourier transform?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What is its Fourier transform?', '_recupere_le' => '2026-11-04T19:55:22.750179+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : v(t) = u-1(t) e-αt, [See (1.2.1) in notes; u-1(t) = {0 for t < 0; = 1 otherwise}]
∞                         ∞                                                     ∞
V(f) = Ú-∞')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What is its autocorrelation function?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Rv(τ) = Ú-∞ [u-1(t) e-αt ] [u-1(t-τ) e-α(t-τ) ]dt [See (1.2.5) in notes]
∞                         ∞                                 ∞
If τ > 0, Rv(τ) = Úτ e-α(2t – τ) dt = eατ Úτ e-2αt dt = - (eατ /2α) e-2αt|t=τ = e-ατ/2α
∞
If τ < 0, Rv(τ) = Ú0 e-α(2t – τ) dt = eατ/2α
In general, Rv(τ) = e-α|τ|/2α

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is its autocorrelation function?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What is its autocorrelation function?', '_recupere_le' => '2026-11-04T19:55:22.750213+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Rv(τ) = Ú-∞ [u-1(t) e-αt ] [u-1(t-τ) e-α(t-τ) ]dt [See (1.2.5) in notes]
∞                         ∞                                 ∞
If τ > 0, Rv(τ) = Úτ e-α(2t – τ) dt = e')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Calculate the energy density spectrum
i)      from the Fourier transform.
ii)     from the autocorrelation function.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (i) S(f) = |V(f)|2 = | -1/(j2πf + α) |2 = 1/[(2πf)2 + α2]
∞
(ii) S(f) = F{Rv(τ)} = Ú-∞ (e-α|τ|/2α) e-j2πfτ dτ [See (1.2.5) and Solution to 1.1b]
= Ú-∞0(eατ/2α) e-j2πfτ dτ + Ú0∞(e-ατ/2α) e-j2πfτ dτ
= (1/2α){[1/(α – j2πf)] + [1/(α + j2πf)]}
= (1/2α)[(α + j2πf + α - j2πf)/(α2 + (2πf)2)] = 1/(α2 + (2πf)2)

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Calculate the energy density spectrum
i)      from the Fourier transform.
ii)     from the autocorrelation function.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Calculate the energy density spectrum
i)      from the Fourier transform.
ii)     from the autocorrelation function.', '_recupere_le' => '2026-11-04T19:55:22.750275+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (i) S(f) = |V(f)|2 = | -1/(j2πf + α) |2 = 1/[(2πf)2 + α2]
∞
(ii) S(f) = F{Rv(τ)} = Ú-∞ (e-α|τ|/2α) e-j2πfτ dτ [See (1.2.5) and Solution to 1.1b]
= Ú-∞0(eατ/2α) e-j2πfτ dτ + Ú')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Express Sy (f ) in terms of Sx (f ) and α.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : y(t) = x(t) * h(t) : Y(f) = X(f)H(f)
Sy(f) = Y(f)Y*(f) = X(f)X*(f)H(f)H*(f)
where H(f) = -1/(j2πf + α) [See solution to 1.1a]. Therefore
Sy(f) = Sx(f)/(α2 + (2πf)2)

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Express Sy (f ) in terms of Sx (f ) and α.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Express Sy (f ) in terms of Sx (f ) and α.', '_recupere_le' => '2026-11-04T19:55:22.750314+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : y(t) = x(t) * h(t) : Y(f) = X(f)H(f)
Sy(f) = Y(f)Y*(f) = X(f)X*(f)H(f)H*(f)
where H(f) = -1/(j2πf + α) [See solution to 1.1a]. Therefore
Sy(f) = Sx(f)/(α2 + (2πf)2)

[Correct')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Let x(t) be Gaussian white noise with 1 volt 2 Hz , and have zero mean. What is
the rms deviation of y(t)?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We designate σy= rms deviation of y(t)
∞               ∞
σy2 = Ú-∞ Sy(f) df = Ú-∞ |y(t)|2dt,
where one possible y(t) = u-1(t) e-αt [See solution to 1.1c(i)]. Thus
∞
σy2 = Ú-∞ |y(t)|2dt = Ú0∞e-2ατdt = 1/2α, Therefore σy= (2α)-0.5

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Let x(t) be Gaussian white noise with 1 volt 2 Hz , and have zero mean. What is
the rms deviation of y(t)?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Let x(t) be Gaussian white noise with 1 volt 2 Hz , and have zero mean. What is
the rms deviation of y(t)?', '_recupere_le' => '2026-11-04T19:55:22.750375+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : We designate σy= rms deviation of y(t)
∞               ∞
σy2 = Ú-∞ Sy(f) df = Ú-∞ |y(t)|2dt,
where one possible y(t) = u-1(t) e-αt [See solution to 1.1c(i)]. Thus
∞
σy2 = Ú-∞')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Boldface indicates vectors here; underbars indicate complex quantities
Write an expression for the electric field vector E(x, y, z, t) and for its complex
counterpart E(x, y, z) ; use the notation defined in Chapter 1 of the course notes.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Power = |E|2/2ηo = 1, so |E| = (2ηo)0.5 = 27.5 [where ηo = 377 ohms] Thus
E(t,x,y,z) = 27.5y cos(ωt – kz), where ω = 2π 109 and k = 2πf/c = 20.9 throughout
E(x,y,z) = 27.5y e-jkz where y is a unit vector in the y direction

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Boldface indicates vectors here; underbars indicate complex quantities
Write an expression for the electric field vector E(x, y, z, t) and for its complex
counterpart E(x, y, z) ; use the notation defined in Chapter 1 of the course notes.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Boldface indicates vectors here; underbars indicate complex quantities
Write an expression for the electric field vector E(x, y, z, t) and for its complex
counterpart E(x, y, z) ; use the notation defined in Chapter 1 of the course notes.', '_recupere_le' => '2026-11-04T19:55:22.750474+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Power = |E|2/2ηo = 1, so |E| = (2ηo)0.5 = 27.5 [where ηo = 377 ohms] Thus
E(t,x,y,z) = 27.5y cos(ωt – kz), where ω = 2π 109 and k = 2πf/c = 20.9 throughout
E(x,y,z) = 27.5y e')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Boldface indicates vectors here; underbars indicate complex quantities
This plane wave impacts an infinite perfectly conduction sheet at z = 0. Repeat
part (a) for the total electromagnetic field for z < 0.
∗', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (i) The boundary conditions at z = 0 dictate that E = 0 there, which is satisfied if
-1-                                              12/22/03
E(t,x,y,z) = 27.5y [cos(ωt – kz) – cos(ωt + kz)] = 55y (sinωt)(sinkz) {v/m}
(ii) E(x,y,z) = 27.5y (e-jkz – e+jkz) = -j 55y sin kz {v/m}

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Boldface indicates vectors here; underbars indicate complex quantities
This plane wave impacts an infinite perfectly conduction sheet at z = 0. Repeat
part (a) for the total electromagnetic field for z < 0.
∗]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Boldface indicates vectors here; underbars indicate complex quantities
This plane wave impacts an infinite perfectly conduction sheet at z = 0. Repeat
part (a) for the total electromagnetic field for z < 0.
∗', '_recupere_le' => '2026-11-04T19:55:22.750560+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (i) The boundary conditions at z = 0 dictate that E = 0 there, which is satisfied if
-1-                                              12/22/03
E(t,x,y,z) = 27.5y [cos(ωt – kz')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Boldface indicates vectors here; underbars indicate complex quantities
Write expressions for the real ⎡S(t)
⎣      = E(t) × H(t)⎤⎦ and the complex ⎡S = E × H ⎤
⎢⎣         ⎥⎦
Poynting vectors corresponding to your', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (i) S(t) = E(t) x H(t); H(t) = -x(2/ηo)0.5 cos(ωt-kz)
S(t) = 2z cos2(ωt-kz) {W/m2}
(ii) S = E x H*; H = -x (2/ηo)0.5 e-jkz; S = 2z {W/m2}
(iii) H(t,x,y,z) = -x (2/ηo)0.5 [cos(ωt – kz) + cos(ωt + kz)]
= -x (8/ηo)0.5 cos(ωt)cos(kz)
E(t,x,y,z) = y (8ηo)0.5 sin(ωt)sin(kz)
S(t) = 8z sinωt cosωt coskz sinkz = 2z sin2ωt sin2kz {W/m2}
(iv) H(x,y,z) = -(2/ηo)0.5x (e-jkz + e+jkz) = -(8/ηo)0.5x coskz
E(x,y,z) = -jy (8ηo)0.5 sin(kz)
S(x,y,z) = 8z sinkz coskz = 4jz sin2kz {W/m2}', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'choices' => array('L\'inverse de to part (a) valid at z = -1 meter.
repeat (c) for the waves of part (b).', 'to Part (a) valid at z = -1 meter.
Repeat (c) for the waves of Part (b).', 'Pas to part (a) valid at z = -1 meter.
repeat (c) for the waves of part (b).', 'Impossible à déterminer'), 'correct' => 1, 'answer' => 'to Part (a) valid at z = -1 meter.
Repeat (c) for the waves of Part (b).', '_recupere_le' => '2026-11-04T19:55:22.750722+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Boldface indicates vectors here; underbars indicate complex quantities
Write expressions for the instantaneous and time-average stored electric and
magnetic energy densities at z = -1 meter, corresponding to your', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : E(t,x,y,z) = (2ηo)0.5 y cos(ωt – kz); We = εο|E(t)|2/2 = (1/c) cos2(ωt+ω/c) [J/m3]
H(t) = -x(2/ηo)0.5 cos(ωt-kz); Wm = µο|H(t)|2/2 = (1/c) cos2(ωt+ω/c) [J/m3]
·WmÒ = ·WeÒ = 1/2c', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'choices' => array('s to Part
(b).', 'Impossible à déterminer', 'Pas s to part
(b).', 'L\'inverse de s to part
(b).'), 'correct' => 0, 'answer' => 's to Part
(b).', '_recupere_le' => '2026-11-04T19:55:22.750827+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Approximately how many watts are emerging from this line in the given
bandwidth on a cold day in Cambridge when the CATV transmitter is off?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Within a 100-MHz band kTB = 270k 108 = 3.7 x 10-13 Watts would flow to a
matched load.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Approximately how many watts are emerging from this line in the given
bandwidth on a cold day in Cambridge when the CATV transmitter is off?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Approximately how many watts are emerging from this line in the given
bandwidth on a cold day in Cambridge when the CATV transmitter is off?', '_recupere_le' => '2026-11-04T19:55:22.750896+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Within a 100-MHz band kTB = 270k 108 = 3.7 x 10-13 Watts would flow to a
matched load.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Approximatel')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Approximately what is the thermal rms voltage at the end of this line? State all
assumptions.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : vrms2/Zo = power, so vrms = (270kZo 108)0.5 volts = 4.3 microvolts

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Approximately what is the thermal rms voltage at the end of this line? State all
assumptions.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Approximately what is the thermal rms voltage at the end of this line? State all
assumptions.', '_recupere_le' => '2026-11-04T19:55:22.750956+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : vrms2/Zo = power, so vrms = (270kZo 108)0.5 volts = 4.3 microvolts

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Approximately what is the therma')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Over approximately what frequency band does the Rayleigh-Jeans approximation
hold for this line?
2', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Raleigh-Jeans applies when hf<<kT, or f << kT/h = ~6 x 1012 Hz
-2-                                        12/22/03

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Over approximately what frequency band does the Rayleigh-Jeans approximation
hold for this line?
2]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Over approximately what frequency band does the Rayleigh-Jeans approximation
hold for this line?
2', '_recupere_le' => '2026-11-04T19:55:22.751010+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Raleigh-Jeans applies when hf<<kT, or f << kT/h = ~6 x 1012 Hz
-2-                                        12/22/03

[Correction officielle MIT : [MIT 6.661 — question d’exame')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What is the brightness temperature Tup seen by a satellite ground station when it
looks straight up? Hint: the physics of uniform plane wave propagation here resembles
that of Figure 2.1-9 in the text for a TEM line--both cases involve only one propagating
mode.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Tup = 3e-τ + 250(1 - e-τ) = 3×0.6 + 250×0.4 = 101.8K

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the brightness temperature Tup seen by a satellite ground station when it
looks straight up? Hint: the physics of uniform plane wave propagation here resembles
that of Figure 2.1-9 in the text for a TEM line--both cases involve only one propagating
mode.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What is the brightness temperature Tup seen by a satellite ground station when it
looks straight up? Hint: the physics of uniform plane wave propagation here resembles
that of Figure 2.1-9 in the text for a TEM line--both cases involve only one propagating
mode.', '_recupere_le' => '2026-11-04T19:55:22.751112+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Tup = 3e-τ + 250(1 - e-τ) = 3×0.6 + 250×0.4 = 101.8K

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the brightness temperature Tup seen by')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What is the brightness temperature T30 seen when the station looks up at a 30-degree
elevation angle? Hint: the path length doubles.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : T30 = 3e-2τ + 250(1 - e-2τ) = 3×(0.6)2 + 250(1 - 0.62) = 161.08K

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the brightness temperature T30 seen when the station looks up at a 30-degree
elevation angle? Hint: the path length doubles.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What is the brightness temperature T30 seen when the station looks up at a 30-degree
elevation angle? Hint: the path length doubles.', '_recupere_le' => '2026-11-04T19:55:22.751176+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : T30 = 3e-2τ + 250(1 - e-2τ) = 3×(0.6)2 + 250(1 - 0.62) = 161.08K

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the brightness temperature')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Approximately how many modes can propagate below a frequency of 1 THz in a
waveguide that has dimensions 1x2 cm? Hint: a 2-dimensional version of Figure 2.1-5 in
the text might help.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : To count the propagating modes, consider the mode diagram, where the axes
represent fx and fy and where fcutoff = (fx2 + fy2)0.5:
nc/2b
The number N of propagating modes                          Area
is the total area divided by the area for        . . . .    Area per mode = (c/2a)(c/2b)/2
each mode. Thus N = 2(πr2/4)/(c2/4ab)           . . . . . . (Note: each dot has 2 modes,
N = 2πab1024/c2                                 . . . .f. .    TEmn and TMmn)
= 2×3.14×2×10-2×10-21024/(3×108)2               . . . . . .
= 13,956 modes (approximately).                               mc/2a
0              1012 Hz

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Approximately how many modes can propagate below a frequency of 1 THz in a
waveguide that has dimensions 1x2 cm? Hint: a 2-dimensional version of Figure 2.1-5 in
the text might help.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Approximately how many modes can propagate below a frequency of 1 THz in a
waveguide that has dimensions 1x2 cm? Hint: a 2-dimensional version of Figure 2.1-5 in
the text might help.', '_recupere_le' => '2026-11-04T19:55:22.751258+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : To count the propagating modes, consider the mode diagram, where the axes
represent fx and fy and where fcutoff = (fx2 + fy2)0.5:
nc/2b
The number N of propagating modes')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
If a matched load at one end of this waveguide has temperature 300K, what is the
approximate total thermal power propagating down this waveguide at frequencies below
1 THz (λ ≅ 0.3 mm)? A numerical', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Referring to the figure, each mode propagates from its own cutoff frequency (“f”
in the figure) up to 1012 Hz; thus B = (1012 – f). The total thermal power radiated for
mode i is then the integral from f to 1012, or kTBi for each mode, where the number
density of modes/Hz at frequency f is 2(fπ/2)/(c/2b)(c/2a). The factor of 2 corresponds to
the fact that mn corresponds to both a TE and a TM mode. Therefore,
P = 2kT∫010^12 (fπ/2)(1012 – f)df/(c/2b)(c/2a). Therefore,
P = (4abkTπ/c2) ∫010^12 f(1012 - f ) df = (4πabkT/c2)[1012 f2/2 – f3/3]|010^12
= (4πabkT/c2)1036/6 = 1.9 x 10-5{watts}', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'choices' => array('Impossible à déterminer', 'L\'inverse de is desired. hint: waveguide modes can be
characterized by a 2-dimensional array of quantum numbers mn, where each mode mn
corresponds to both te and tm modes (see fig. 2.1-5). if we consider this distribution
of modes as a continuum with so many modes per “square quantum number”, and note
-1-                                      12/22/03
that each mode has a different propagating bandwidth, a simple integration gives an
approximate answer to the total power radiated.', 'Pas is desired. hint: waveguide modes can be
characterized by a 2-dimensional array of quantum numbers mn, where each mode mn
corresponds to both te and tm modes (see fig. 2.1-5). if we consider this distribution
of modes as a continuum with so many modes per “square quantum number”, and note
-1-                                      12/22/03
that each mode has a different propagating bandwidth, a simple integration gives an
approximate answer to the total power radiated.', 'is desired. Hint: Waveguide modes can be
characterized by a 2-dimensional array of quantum numbers mn, where each mode mn
corresponds to both TE and TM modes (see Fig. 2.1-5). If we consider this distribution
of modes as a continuum with so many modes per “square quantum number”, and note
-1-                                      12/22/03
that each mode has a different propagating bandwidth, a simple integration gives an
approximate answer to the total power radiated.'), 'correct' => 3, 'answer' => 'is desired. Hint: Waveguide modes can be
characterized by a 2-dimensional array of quantum numbers mn, where each mode mn
corresponds to both TE and TM modes (see Fig. 2.1-5). If we consider this distribution
of modes as a continuum with so many modes per “square quantum number”, and note
-1-                                      12/22/03
that each mode has a different propagating bandwidth, a simple integration gives an
approximate answer to the total power radiated.', '_recupere_le' => '2026-11-04T19:55:22.751506+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
x
Sketch a typical instantaneous non-zero current distribution on these wires.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Instantaneous currents could be:                  z                          λ/2
y

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
x
Sketch a typical instantaneous non-zero current distribution on these wires.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
x
Sketch a typical instantaneous non-zero current distribution on these wires.', '_recupere_le' => '2026-11-04T19:55:22.751555+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Instantaneous currents could be:                  z                          λ/2
y

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
x
Sketch a typic')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
x
In what directions (x,y,z) is the gain G(θ,φ) (globally, not locally) maximum, and
what is the polarization in these directions? We define θ as zero along the +z axis,
and φ = 0 in the x-z plane. Consider only the x, y, and z directions in parts (b) and
(c).', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Maximum gain along ±x and ±z axes,                                     λ/2
nulls along ±y axis. The x-axis radiation
is z-polarized, and the z-axis radiation is
x-polarized. Off-axis radiation is more
easily determined using a computer.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
x
In what directions (x,y,z) is the gain G(θ,φ) (globally, not locally) maximum, and
what is the polarization in these directions? We define θ as zero along the +z axis,
and φ = 0 in the x-z plane. Consider only the x, y, and z directions in parts (b) and
(c).]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
x
In what directions (x,y,z) is the gain G(θ,φ) (globally, not locally) maximum, and
what is the polarization in these directions? We define θ as zero along the +z axis,
and φ = 0 in the x-z plane. Consider only the x, y, and z directions in parts (b) and
(c).', '_recupere_le' => '2026-11-04T19:55:22.751740+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Maximum gain along ±x and ±z axes,                                     λ/2
nulls along ±y axis. The x-axis radiation
is z-polarized, and the z-axis radiation is
x-polarized.')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
x
In what directions is the gain G(θ,φ) zero?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : There are nulls along the y axis.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
x
In what directions is the gain G(θ,φ) zero?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
x
In what directions is the gain G(θ,φ) zero?', '_recupere_le' => '2026-11-04T19:55:22.751783+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : There are nulls along the y axis.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
x
In what directions is the gain G(θ,φ) zero?]')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
λ/2
a)
<<λ/2
ZA
What is the approximate input impedance ZA for this antenna?
λ/2
<<λ/2
ZA', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ZA ≅ 4 ×73 ohms = 1168 Ω. Radiation
2
resistance is proportional to radiated power (see (3.2.26) in text), and we have
quadrupled the current normally flowing in a half-wave dipole, thus increasing the
radiated power and radiation resistance by a factor of 16. The Rr for a half-wave
dipole is ~73 ohms (see p 3-17 of text).

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
λ/2
a)
<<λ/2
ZA
What is the approximate input impedance ZA for this antenna?
λ/2
<<λ/2
ZA]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
λ/2
a)
<<λ/2
ZA
What is the approximate input impedance ZA for this antenna?
λ/2
<<λ/2
ZA', '_recupere_le' => '2026-11-04T19:55:22.751841+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : ZA ≅ 4 ×73 ohms = 1168 Ω. Radiation
2
resistance is proportional to radiated power (see (3.2.26) in text), and we have
quadrupled the current normally flowing in a half-wave')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Roughly what is the antenna beamwidth of this disk pattern if all dipoles are excited
equally?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : 8 half-wave dipoles end-to-end are collectively 4 wavelengths long. The figure
below suggests the location of the first null.
2λ
The first null occurs at             θ
θ = cos ([λ/2]/[2λ])
-1
λ/2     cancellation (null)
-1
= cos 0.25 = 75.5°
so the 3-dB beamwidth is ~2(90 – 77.5) = 14.4°, broadside.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Roughly what is the antenna beamwidth of this disk pattern if all dipoles are excited
equally?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Roughly what is the antenna beamwidth of this disk pattern if all dipoles are excited
equally?', '_recupere_le' => '2026-11-04T19:55:22.751893+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : 8 half-wave dipoles end-to-end are collectively 4 wavelengths long. The figure
below suggests the location of the first null.
2λ
The first null occurs at             θ
θ = co')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
The difficulty with this approach is that the TEM feed wires (say coax) may have
currents induced on them that may re-radiate out of phase (like mirrors) if they are
positioned incorrectly. Develop at least two design concepts for circumventing the
problem of excessive unwanted radiation and gain loss associated with the currents
induced on those sections of feedline that are close to the radiating dipoles. Sketch
and briefly discuss your ideas.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (i)
far enough to avoid
strong reflections
TEM feed
This feed system balances impedances and ensures in-phase excitation of all dipoles.
(ii)
Use half-wave loops between dipoles to ensure all currents are
in phase. The drawing shows a center-fed configuration,
but the feed could enter an end dipole too, although the more remote dipoles would
not be so strongly fed. Arrange the loops so their radiation is minimized.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
The difficulty with this approach is that the TEM feed wires (say coax) may have
currents induced on them that may re-radiate out of phase (like mirrors) if they are
positioned incorrectly. Develop at least two design concepts for circumventing the
problem of excessive unwanted radiation and gain loss associated with the currents
induced on those sections of feedline that are close to the radiating dipoles. Sketch
and briefly discuss your ideas.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
The difficulty with this approach is that the TEM feed wires (say coax) may have
currents induced on them that may re-radiate out of phase (like mirrors) if they are
positioned incorrectly. Develop at least two design concepts for circumventing the
problem of excessive unwanted radiation and gain loss associated with the currents
induced on those sections of feedline that are close to the radiating dipoles. Sketch
and briefly discuss your ideas.', '_recupere_le' => '2026-11-04T19:55:22.752055+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : (i)
far enough to avoid
strong reflections
TEM feed
This feed system balances impedances and ensures in-phase excitation of all dipoles.
(ii)
Use half-wave loops between dipo')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
First assume there is no frequency re-use, i.e., each band is used but once. Note that
there is no "right"', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We simply want the power received Prec to exceed the receiver noise kTB plus the
given margins. The user antenna gain should be ~1 for general use.
Prec = (Gt Pt/4πr2)(Grλ2/4π)/1000 (dividing by 1000 provides the 30-dB path margin)
≅ 2.5×10-15 watts if Gr = 3
100kTB = 100×1.38×10-23×600×3000 = 2.48×10-15 watts per channel
Thus the uplink (link to the base station) has adequate margins if the base station
antenna has a gain of 3 or more. The gain of the antenna of Problem 6.3 is
approximately 8, so a vertical stack of 4 such dipoles end-to-end should provide 360-
degree coverage out to ~20 km. Although lower gains would be directed toward
users closer to the base station antenna, less gain should then suffice. The
calculation for the down-link from the base station is identical, except that up to (1.5
MHz)/(3 kHz) = 500 users could be active at once, requiring up to 500 watts
transmitter power at one watt per user. This is a modest requirement.', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'choices' => array('Pas to this problem, so simply choose reasonable parameters and
then adjust them so they seem sensible.', 'Impossible à déterminer', 'L\'inverse de to this problem, so simply choose reasonable parameters and
then adjust them so they seem sensible.', 'to this problem, so simply choose reasonable parameters and
then adjust them so they seem sensible.'), 'correct' => 3, 'answer' => 'to this problem, so simply choose reasonable parameters and
then adjust them so they seem sensible.', '_recupere_le' => '2026-11-04T19:55:22.752163+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Now assume that as many as four calls may re-use the same frequency at once, so
that multiple antenna arrays with non-overlapping patterns may be invoked.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Frequency reuse requires independent beams. Orthogonal
polarizations don\'t separate well in complex multipath
environments, so multiple beams are better.             If digital
modulation is used, >~12-dB isolation between beams
generally suffices. If 4× reuse is desired, then at least 8 beams
should be used to provide both adequate separation and
coverage. A possible 12-beam configuration is pictured here,
where each element radiates only over 180o of azimuth due to reflecting surfaces
behind. The elements would be arranged in three rows of four each, where each 4-
element antenna array would produce 4 beams, as shown. Frequencies could be
reused in non-adjacent beams over ×6 reuse, in principal. Because users are often
not symmetrically distributed, ×6 offers a little margin if the real goal is ×4.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Now assume that as many as four calls may re-use the same frequency at once, so
that multiple antenna arrays with non-overlapping patterns may be invoked.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Now assume that as many as four calls may re-use the same frequency at once, so
that multiple antenna arrays with non-overlapping patterns may be invoked.', '_recupere_le' => '2026-11-04T19:55:22.752235+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Frequency reuse requires independent beams. Orthogonal
polarizations don\'t separate well in complex multipath
environments, so multiple beams are better.             If digit')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What should be the receiver\'s decision threshold (in volts) if the two signaling
voltages are equi-probable?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The threshold should be midway between the two alternative voltages,
i.e. at zero volts.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What should be the receiver\'s decision threshold (in volts) if the two signaling
voltages are equi-probable?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What should be the receiver\'s decision threshold (in volts) if the two signaling
voltages are equi-probable?', '_recupere_le' => '2026-11-04T19:55:22.752290+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The threshold should be midway between the two alternative voltages,
i.e. at zero volts.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What shoul')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What should be the decision threshold if the +1 volt signal is sent three times as
often as the -1 volt signal?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Referring to Figure 4.2-2b and (4.2.10) in the text, the threshold should be:
Thresh = 0 + (N/A)ln(P2/P1) = (N/2) ln 3-1 = -0.55 volts
where N in this formula (4.2.10) is not WHz-1 but rather σn2, which is 12 here.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What should be the decision threshold if the +1 volt signal is sent three times as
often as the -1 volt signal?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What should be the decision threshold if the +1 volt signal is sent three times as
often as the -1 volt signal?', '_recupere_le' => '2026-11-04T19:55:22.752350+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Referring to Figure 4.2-2b and (4.2.10) in the text, the threshold should be:
Thresh = 0 + (N/A)ln(P2/P1) = (N/2) ln 3-1 = -0.55 volts
where N in this formula (4.2.10) is not')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Repeat (b) for the case where the -1 volt signal is set to 0 volts instead, so the two
messages are 0 or +1 volt. Comment briefly on the physical significance of your
result.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Thresh = 0.5 + (N/A)ln(P2/P1) = 0.5 + (1/1) ln 3-1 = -0.6 volts
This is below any voltage ever sent, but is nonetheless a correct answer because the
noise is so large here relative to the separation between the two original signals that
only when the received voltage is extremely negative would we favor the hypothesis
that zero volts was sent.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Repeat (b) for the case where the -1 volt signal is set to 0 volts instead, so the two
messages are 0 or +1 volt. Comment briefly on the physical significance of your
result.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Repeat (b) for the case where the -1 volt signal is set to 0 volts instead, so the two
messages are 0 or +1 volt. Comment briefly on the physical significance of your
result.', '_recupere_le' => '2026-11-04T19:55:22.752431+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Thresh = 0.5 + (N/A)ln(P2/P1) = 0.5 + (1/1) ln 3-1 = -0.6 volts
This is below any voltage ever sent, but is nonetheless a correct answer because the
noise is so large here re')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What is the probability of bit error for case (a)? You may express your', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The form of the solution is clearly P{error} = 0.5 ERFC(z), so the problem is to find
the value of z. Here we want P{error} = ∫-∞-b(2πσy2)-0.5 exp(-y2/2σy2) dy (see (4.4.8))
where b = -1 and σy = 1 Referring to (4.4.10) and (4.4.12) we see that z = 2-0.5
because K = 1. Therefore P{error} = 0.5 ERFC(2-0.5).', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'choices' => array('in
terms of ERFC(x) if you wish.', 'L\'inverse de in
terms of erfc(x) if you wish.', 'Impossible à déterminer', 'Pas in
terms of erfc(x) if you wish.'), 'correct' => 0, 'answer' => 'in
terms of ERFC(x) if you wish.', '_recupere_le' => '2026-11-04T19:55:22.752502+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
See Example 4.2.2 on page ~4-10 of the text. The receiver takes the form of Figure
4.2-4 with three symbols rather that two. Using (4.2.18), the three matched filter
impulse responses are hi(t) = a(t)si(1 - t) for the three possible signals si(t) [i = 1,2,3],
where a(t) = 1 for 0 < t < 1, and a(t) = 0 otherwise. The three biases bi in (4.2.18) are
bi = N ln Pi - 0.5∫si2(t)dt where
N = (kTs/2)∫-∞∞|H(f)|2df = (kTs/2)∫01 a2(t) dt = (kTs/2) and where
Ts is the noise temperature just prior to the matched filters, which is where si(t) are
defined.      The three biases bi are therefore: 1) -1.39(kTs/2) - 0.5,
2) -1.39(kTs/2) - 0.25, and 3) -0.69(kTs/2) - 0.25.
Note that the kT factor is so small that it can be neglected here compared to the one-
volt signals.
Design an alternate symbol set vi(t), i = 1,2,3 that would be more efficient, but
subject to the same 1-volt limit. Note, many optimum sets exist and simplicity is
preferred; since a true optimum that accounts for the differences in a priori
probabilities may be elusive, a qualitative derivation would suffice. Briefly explain
your reasoning.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If we divide the symbol period into M samples, then each symbol si(t) can be
represented as a vector in M-dimensional space. Consider 3-space. In this case the
three symbols are farthest apart if they lie in a plane spaced at ~120o. The same is
true for any M. If we consider a 2-D case, the signals might each have two halves or
samples of value ai1 and ai2. They might be defined as illustrated below, where the
more probable symbol A might be positioned at the top, and thus are separated more
than the two symbols B and C at the bottom.
C                       A                             a2
+1
A
A                               t           -1             +1 a1
B
B              C
-1

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
See Example 4.2.2 on page ~4-10 of the text. The receiver takes the form of Figure
4.2-4 with three symbols rather that two. Using (4.2.18), the three matched filter
impulse responses are hi(t) = a(t)si(1 - t) for the three possible signals si(t) [i = 1,2,3],
where a(t) = 1 for 0 < t < 1, and a(t) = 0 otherwise. The three biases bi in (4.2.18) are
bi = N ln Pi - 0.5∫si2(t)dt where
N = (kTs/2)∫-∞∞|H(f)|2df = (kTs/2)∫01 a2(t) dt = (kTs/2) and where
Ts is the noise temperature just prior to the matched filters, which is where si(t) are
defined.      The three biases bi are therefore: 1) -1.39(kTs/2) - 0.5,
2) -1.39(kTs/2) - 0.25, and 3) -0.69(kTs/2) - 0.25.
Note that the kT factor is so small that it can be neglected here compared to the one-
volt signals.
Design an alternate symbol set vi(t), i = 1,2,3 that would be more efficient, but
subject to the same 1-volt limit. Note, many optimum sets exist and simplicity is
preferred; since a true optimum that accounts for the differences in a priori
probabilities may be elusive, a qualitative derivation would suffice. Briefly explain
your reasoning.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
See Example 4.2.2 on page ~4-10 of the text. The receiver takes the form of Figure
4.2-4 with three symbols rather that two. Using (4.2.18), the three matched filter
impulse responses are hi(t) = a(t)si(1 - t) for the three possible signals si(t) [i = 1,2,3],
where a(t) = 1 for 0 < t < 1, and a(t) = 0 otherwise. The three biases bi in (4.2.18) are
bi = N ln Pi - 0.5∫si2(t)dt where
N = (kTs/2)∫-∞∞|H(f)|2df = (kTs/2)∫01 a2(t) dt = (kTs/2) and where
Ts is the noise temperature just prior to the matched filters, which is where si(t) are
defined.      The three biases bi are therefore: 1) -1.39(kTs/2) - 0.5,
2) -1.39(kTs/2) - 0.25, and 3) -0.69(kTs/2) - 0.25.
Note that the kT factor is so small that it can be neglected here compared to the one-
volt signals.
Design an alternate symbol set vi(t), i = 1,2,3 that would be more efficient, but
subject to the same 1-volt limit. Note, many optimum sets exist and simplicity is
preferred; since a true optimum that accounts for the differences in a priori
probabilities may be elusive, a qualitative derivation would suffice. Briefly explain
your reasoning.', '_recupere_le' => '2026-11-04T19:55:22.752944+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : If we divide the symbol period into M samples, then each symbol si(t) can be
represented as a vector in M-dimensional space. Consider 3-space. In this case the
three symbols')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What received power [W] is required?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Figure 4.4-3 suggests that Pe = 10-4 corresponds to E/No ≅ 9.5 dB for coherent
BPSK. Therefore E = 10dB/10 kT [J/bit] and P[W] = RE = E = 100.95 1.38×10-23×100
= 1.23×10-20 watts.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What received power [W] is required?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What received power [W] is required?', '_recupere_le' => '2026-11-04T19:55:22.752985+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Figure 4.4-3 suggests that Pe = 10-4 corresponds to E/No ≅ 9.5 dB for coherent
BPSK. Therefore E = 10dB/10 kT [J/bit] and P[W] = RE = E = 100.95 1.38×10-23×100
= 1.23×10-20 w')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
For this system, how many Joules/bit are required? Is this result a function of the
chosen data rate?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : E = 1.23×10-20 [J/bit]; it is independent of the data rate.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
For this system, how many Joules/bit are required? Is this result a function of the
chosen data rate?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
For this system, how many Joules/bit are required? Is this result a function of the
chosen data rate?', '_recupere_le' => '2026-11-04T19:55:22.753040+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : E = 1.23×10-20 [J/bit]; it is independent of the data rate.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
For this system, how many Joules/bit ar')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Show that the minimum achievable energy required to communicate one bit over any
channel is Eb ≅ kT [J] in the Rayleigh-Jeans region. [Note, for interest, that when hf > kT
we have the option of timing the release of photons with great precision, so one photon
could convey many bits, based on its time of arrival. To get the', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let Eb = S/C = S/[B log2(1 + S/NoB)] = EbR/[(R/Q) log2(1 + REbQ/kTR)], so
Q = log2(1 + EbQ/kT) and 2Q - 1 = EbQ/kT. Therefore
Eb = kT(2Q - 1)/Q = kT if Q = 1. For small Q, Eb diminishes only slightly', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'choices' => array('bound in this case
we could replace No = kT with the correct Planck expression and repeat the derivation
above.]', 'Impossible à déterminer', 'L\'inverse de bound in this case
we could replace no = kt with the correct planck expression and repeat the derivation
above.]', 'Pas bound in this case
we could replace no = kt with the correct planck expression and repeat the derivation
above.]'), 'correct' => 0, 'answer' => 'bound in this case
we could replace No = kT with the correct Planck expression and repeat the derivation
above.]', '_recupere_le' => '2026-11-04T19:55:22.753212+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Find the approximate range of values for Q that permits us to operate within one or
two dB of the minimum Eb.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Numerically, Q = 2 ⇒ Eb = 1.5kT; Q = 0.3 ⇒ 0.77kT, Q = 0.1 ⇒ 0.72kT.
Q = 0.001 ⇒ 0.69kT. Lower values for Eb are generally unattainable in practice, so
Eb > ~0.7kT is a fairly hard limit, where T is the system noise temperature
characterizing the channel, not the signal. Thus the desired range is: 0 < Q < 2.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Find the approximate range of values for Q that permits us to operate within one or
two dB of the minimum Eb.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Find the approximate range of values for Q that permits us to operate within one or
two dB of the minimum Eb.', '_recupere_le' => '2026-11-04T19:55:22.753273+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Numerically, Q = 2 ⇒ Eb = 1.5kT; Q = 0.3 ⇒ 0.77kT, Q = 0.1 ⇒ 0.72kT.
Q = 0.001 ⇒ 0.69kT. Lower values for Eb are generally unattainable in practice, so
Eb > ~0.7kT is a fairl')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Please sketch nominal shapes for f(t), g(t), i(t), and r(t) for this problem and align
them on a single graph, noting that we are now in the spatial (or angular) domain, not the
time domain. Indicate the physical origins of each of these functions.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let x,y be coordinates referenced to the focal plane. We can consider f(x,y) to
correspond to the lens blurring function (arbitrarily chosen to be narrow) and g(x,y) to
be the focal plane response function of each CCD pixel; i(x,y) represents the spacing of
the pixels and r(x,y) corresponds to the viewer\'s visual response function (assumed
blurry). Thus we might have:
i(x,y) r(x,y) f(x,y)     g(x,y) i(x,y)
x,y
~15 microns

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Please sketch nominal shapes for f(t), g(t), i(t), and r(t) for this problem and align
them on a single graph, noting that we are now in the spatial (or angular) domain, not the
time domain. Indicate the physical origins of each of these functions.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Please sketch nominal shapes for f(t), g(t), i(t), and r(t) for this problem and align
them on a single graph, noting that we are now in the spatial (or angular) domain, not the
time domain. Indicate the physical origins of each of these functions.', '_recupere_le' => '2026-11-04T19:55:22.753377+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Let x,y be coordinates referenced to the focal plane. We can consider f(x,y) to
correspond to the lens blurring function (arbitrarily chosen to be narrow) and g(x,y) to
be th')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What physical processes determine n1(t) and n2(t) here?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The noise n1(t) can be considered to be the environmental noise, while n2(t) is post-
smoothing and can include the sensor noise, photon shot noise, read-out noise, and
quantization noise. Lumping the sensor noise with n1(t) is awkward because n1(t)
precedes convolution.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What physical processes determine n1(t) and n2(t) here?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What physical processes determine n1(t) and n2(t) here?', '_recupere_le' => '2026-11-04T19:55:22.753418+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The noise n1(t) can be considered to be the environmental noise, while n2(t) is post-
smoothing and can include the sensor noise, photon shot noise, read-out noise, and
quant')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What should the diameter D be for a typical circular parabolic-mirror antenna if the
SNR for a receiver having TR + TA = 600K is to be >10 dB for a single locust?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Prec = (PtGr/4πr2)(σL/4πr2)Ar =10 kTB
Assume ηA=0.65, the dish area is πD2/4, Ar = 0.65πD2/4, and Gt = Gr = 0.65(πD/λ)2.
Therefore D4 = 10kTBλ2r464/Ptπ×0.652σL
= 10×1.38×10-23600B×9×10-4×1016×64/103π×0.652×10-4= 3.6×10-4B, so
D = 0.14 B0.25 meters. (B in Hz)

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What should the diameter D be for a typical circular parabolic-mirror antenna if the
SNR for a receiver having TR + TA = 600K is to be >10 dB for a single locust?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What should the diameter D be for a typical circular parabolic-mirror antenna if the
SNR for a receiver having TR + TA = 600K is to be >10 dB for a single locust?', '_recupere_le' => '2026-11-04T19:55:22.753496+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Prec = (PtGr/4πr2)(σL/4πr2)Ar =10 kTB
Assume ηA=0.65, the dish area is πD2/4, Ar = 0.65πD2/4, and Gt = Gr = 0.65(πD/λ)2.
Therefore D4 = 10kTBλ2r464/Ptπ×0.652σL
= 10×1.38×10-2')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What considerations should govern the chosen duration τ [sec] of each CW pulse for
this situation? (No τ needs to be chosen here.)', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Longer CW pulses yield better doppler resolution because of reduced B values, but
poorer range resolution; larger B (shorter τ) requires larger antenna diameters D.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What considerations should govern the chosen duration τ [sec] of each CW pulse for
this situation? (No τ needs to be chosen here.)]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What considerations should govern the chosen duration τ [sec] of each CW pulse for
this situation? (No τ needs to be chosen here.)', '_recupere_le' => '2026-11-04T19:55:22.753561+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Longer CW pulses yield better doppler resolution because of reduced B values, but
poorer range resolution; larger B (shorter τ) requires larger antenna diameters D.

[Correct')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What considerations should govern the chosen spacing T [sec] between consecutive
CW pulses?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The ambiguity function for a pulse τ = 10 m is ~10 meters wide at its half-amplitude
points. A factor of 2 compensates the round trip; τ ≅ 2×10/c [s] ≅ 6.7×10-8[s].

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What considerations should govern the chosen spacing T [sec] between consecutive
CW pulses?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What considerations should govern the chosen spacing T [sec] between consecutive
CW pulses?', '_recupere_le' => '2026-11-04T19:55:22.753628+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The ambiguity function for a pulse τ = 10 m is ~10 meters wide at its half-amplitude
points. A factor of 2 compensates the round trip; τ ≅ 2×10/c [s] ≅ 6.7×10-8[s].

[Correct')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
How does our desire to measure the velocity vector of a swarm of locusts affect our
choice of CW pulse length τ? What τ might you recommend if locusts fly ~10 ms-1 and
we should like to know their instantaneous (using a single radar pulse) radial velocity
within ~±1 ms-1?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Referring to Fig 5.3-12, we see the ambiguity function width ∆f for a doppler shift for
∆v = ±1 ms-1 is ∆f ≅ 1/2T Hz, where fo 2∆v/c = 1/2T so
T = c/(4∆v fo) = 3×108/4×1×1010 = 7.5×10-3 seconds.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
How does our desire to measure the velocity vector of a swarm of locusts affect our
choice of CW pulse length τ? What τ might you recommend if locusts fly ~10 ms-1 and
we should like to know their instantaneous (using a single radar pulse) radial velocity
within ~±1 ms-1?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
How does our desire to measure the velocity vector of a swarm of locusts affect our
choice of CW pulse length τ? What τ might you recommend if locusts fly ~10 ms-1 and
we should like to know their instantaneous (using a single radar pulse) radial velocity
within ~±1 ms-1?', '_recupere_le' => '2026-11-04T19:55:22.753747+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Referring to Fig 5.3-12, we see the ambiguity function width ∆f for a doppler shift for
∆v = ±1 ms-1 is ∆f ≅ 1/2T Hz, where fo 2∆v/c = 1/2T so
T = c/(4∆v fo) = 3×108/4×1×1010')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What pulse length τ[sec] might you recommend in order to measure the instantaneous
distance of a swarm of locusts within ~±10 m?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The time ambiguity function is triangular with half-amplitude width = τ seconds, and
the round-trip effect means the range ambiguity function width is cτ/2 meters ≅ 2×10,
so τ ≅ 40/c = 1.33×10-7 seconds.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What pulse length τ[sec] might you recommend in order to measure the instantaneous
distance of a swarm of locusts within ~±10 m?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What pulse length τ[sec] might you recommend in order to measure the instantaneous
distance of a swarm of locusts within ~±10 m?', '_recupere_le' => '2026-11-04T19:55:22.753811+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The time ambiguity function is triangular with half-amplitude width = τ seconds, and
the round-trip effect means the range ambiguity function width is cτ/2 meters ≅ 2×10,
so')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
How should we redesign the radar pulse to resolve the conflict between (d) and (e)?
Roughly sketch and dimension the ambiguity function of your chosen pulse.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We can use a large time-bandwidth pulse. To obtain the range accuracy we need a
bandwidth B ≅ 1/τ, where we use τ ≅ 1.33×10-7 seconds, so B ≅ 7.5 MHz. To obtain
the doppler accuracy we need a pulse 7.5 milliseconds long. The ambiguity function
then is:
∆τ ≅ 1.33×10-7 sec                         ∆f        7.5 MHz
0                       τ
∆f ≅ 133 Hz                                      7.5×10-3 sec

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
How should we redesign the radar pulse to resolve the conflict between (d) and (e)?
Roughly sketch and dimension the ambiguity function of your chosen pulse.]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
How should we redesign the radar pulse to resolve the conflict between (d) and (e)?
Roughly sketch and dimension the ambiguity function of your chosen pulse.', '_recupere_le' => '2026-11-04T19:55:22.753884+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : We can use a large time-bandwidth pulse. To obtain the range accuracy we need a
bandwidth B ≅ 1/τ, where we use τ ≅ 1.33×10-7 seconds, so B ≅ 7.5 MHz. To obtain
the doppler a')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Given your', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The answer to (a) still applies, where B ≅ 7.5 MHz, so D ≅ 7.33 meters.', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'choices' => array('for (f), what should the diameter D of the antenna be?', 'Impossible à déterminer', 'L\'inverse de for (f), what should the diameter d of the antenna be?', 'Pas for (f), what should the diameter d of the antenna be?'), 'correct' => 0, 'answer' => 'for (f), what should the diameter D of the antenna be?', '_recupere_le' => '2026-11-04T19:55:22.753953+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What is the approximate lateral (not range) resolution L(m) of this radar in normal
(not ISAR) mode at 10-km altitude?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : θB ≅ λ/D, and resolution L ≅ λR/D, where R is range. Thus L ≅ 0.1×104/10 = 100 m.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the approximate lateral (not range) resolution L(m) of this radar in normal
(not ISAR) mode at 10-km altitude?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What is the approximate lateral (not range) resolution L(m) of this radar in normal
(not ISAR) mode at 10-km altitude?', '_recupere_le' => '2026-11-04T19:55:22.754020+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : θB ≅ λ/D, and resolution L ≅ λR/D, where R is range. Thus L ≅ 0.1×104/10 = 100 m.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the appro')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What sort of pulse would yield 1-m range resolution?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The range ambiguity function width is cτ/2 meters = 1 m, so τ ≅ 2/c = 6.67×10-9 sec.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What sort of pulse would yield 1-m range resolution?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What sort of pulse would yield 1-m range resolution?', '_recupere_le' => '2026-11-04T19:55:22.754063+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The range ambiguity function width is cτ/2 meters = 1 m, so τ ≅ 2/c = 6.67×10-9 sec.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What sort of p')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What is the approximate lateral resolution (m) of this radar along the flight path of a
jetliner when operated in its ISAR mode? What is the resolution in the orthogonal
direction?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This is an unfocused SAR, so the resolution down track ≅ D = 10 m, across track it is
the same as for (a): 100 m.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
What is the approximate lateral resolution (m) of this radar along the flight path of a
jetliner when operated in its ISAR mode? What is the resolution in the orthogonal
direction?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
What is the approximate lateral resolution (m) of this radar along the flight path of a
jetliner when operated in its ISAR mode? What is the resolution in the orthogonal
direction?', '_recupere_le' => '2026-11-04T19:55:22.754142+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : This is an unfocused SAR, so the resolution down track ≅ D = 10 m, across track it is
the same as for (a): 100 m.

[Correction officielle MIT : [MIT 6.661 — question d’examen')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
What changes to the radar operation are required to obtain 1-m resolution along the
flight path? Please provide quantitative', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If D = 10 meters, we must steer the dish to track the aircraft along a 10×100 m
trajectory centered overhead, 10 times the original resolution-limited 100-m track.
This longer track is then Fourier transformed as before. Note that two airliners
following within one km of each other cannot both be mapped because the radar dish
can track only one at a time.', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'choices' => array('L\'inverse de s and assume d remains 10 meters.', 's and assume D remains 10 meters.', 'Pas s and assume d remains 10 meters.', 'Impossible à déterminer'), 'correct' => 1, 'answer' => 's and assume D remains 10 meters.', '_recupere_le' => '2026-11-04T19:55:22.754226+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Assume the jetliners always fly between 8 and 12 km altitude. What is the maximum
usable pulse repetition frequency (RPF)?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : There should be no echos originating below 8 km or above 12 km, so there will be no
ambiguity if cT > 2×4000 meters; RPF = T-1 = c/8000 = 3×108/8000 = 37.5 kHz.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Assume the jetliners always fly between 8 and 12 km altitude. What is the maximum
usable pulse repetition frequency (RPF)?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Assume the jetliners always fly between 8 and 12 km altitude. What is the maximum
usable pulse repetition frequency (RPF)?', '_recupere_le' => '2026-11-04T19:55:22.754287+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : There should be no echos originating below 8 km or above 12 km, so there will be no
ambiguity if cT > 2×4000 meters; RPF = T-1 = c/8000 = 3×108/8000 = 37.5 kHz.

[Correction')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
If we use the techniques of part (d) to obtain ~10-cm resolution in range and 1-m
resolution in the flight-path direction, is delay compensation necessary for the pulse
envelope? If so, how much delay is required in the worse case?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Yes, delay compensation is needed because the correlation length of the echo is
~2×1m, and the delay for a 1-km track at 10-km altitude varies from 10 km to
104/cos[tan-1(0.5/10)] = 10,012.5 meters, a difference of 12.5 meters, >> 2 m. The
relative delay is 2×12.5/c = 83.3 ns.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
If we use the techniques of part (d) to obtain ~10-cm resolution in range and 1-m
resolution in the flight-path direction, is delay compensation necessary for the pulse
envelope? If so, how much delay is required in the worse case?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
If we use the techniques of part (d) to obtain ~10-cm resolution in range and 1-m
resolution in the flight-path direction, is delay compensation necessary for the pulse
envelope? If so, how much delay is required in the worse case?', '_recupere_le' => '2026-11-04T19:55:22.754383+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Yes, delay compensation is needed because the correlation length of the echo is
~2×1m, and the delay for a 1-km track at 10-km altitude varies from 10 km to
104/cos[tan-1(0.5')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
This ability to track the aircraft permits 10 images to be obtained with the original 10-
m resolution. What is the ratio of rms intensity fluctuations to mean intensity for each
pixel of the reconstructed average image?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Each separate image has a ratio s/m for intensity ≅ ~0.53, so if we average 10 this is
reduced by a factor of 100.5 = 0.32, yielding a ratio of ~0.17.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
This ability to track the aircraft permits 10 images to be obtained with the original 10-
m resolution. What is the ratio of rms intensity fluctuations to mean intensity for each
pixel of the reconstructed average image?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
This ability to track the aircraft permits 10 images to be obtained with the original 10-
m resolution. What is the ratio of rms intensity fluctuations to mean intensity for each
pixel of the reconstructed average image?', '_recupere_le' => '2026-11-04T19:55:22.754472+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Each separate image has a ratio s/m for intensity ≅ ~0.53, so if we average 10 this is
reduced by a factor of 100.5 = 0.32, yielding a ratio of ~0.17.

[Correction officielle')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
At what angle off axis is its first null?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : θnull = λ/D = 0.01/10 = 10-3 radian.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
At what angle off axis is its first null?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
At what angle off axis is its first null?', '_recupere_le' => '2026-11-04T19:55:22.754512+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : θnull = λ/D = 0.01/10 = 10-3 radian.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
At what angle off axis is its first null?]')),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
This antenna maps the sky, after which the high spatial frequencies of the resulting
image are boosted to yield the principal', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : RE(∧τλ) has support over ±D = 20 meters,
so TB(⎯φ ) has its first null atλ/2D = 0.01/20 = 5×10-4 radians', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'choices' => array('. If the target consists of a spatial
impulse (unresolved source), the restored image exhibits nulls at certain angles. At what
angle off axis is the first null?', 'Pas . if the target consists of a spatial
impulse (unresolved source), the restored image exhibits nulls at certain angles. at what
angle off axis is the first null?', 'Impossible à déterminer', 'L\'inverse de . if the target consists of a spatial
impulse (unresolved source), the restored image exhibits nulls at certain angles. at what
angle off axis is the first null?'), 'correct' => 0, 'answer' => '. If the target consists of a spatial
impulse (unresolved source), the restored image exhibits nulls at certain angles. At what
angle off axis is the first null?', '_recupere_le' => '2026-11-04T19:55:22.754651+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.661 — question d’examen, en anglais]
Aperture synthesis is achieved by making multiple observations using two small
antennas within the same 10-m square. At what angle off axis is the first null of the
synthesized image?', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The maximum baseline is 10 m and φ(τ) has support over a square 20 m on a side,
yielding λ/2D beamwidths = 5×10-4 radians, same as for (b). Both images are limited
by the maximum spatial frequency governed by the maximum antenna spacing 10 m.

[Correction officielle MIT : [MIT 6.661 — question d’examen, en anglais]
Aperture synthesis is achieved by making multiple observations using two small
antennas within the same 10-m square. At what angle off axis is the first null of the
synthesized image?]', 'source' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.661 Receivers, Antennas and Signals, Spring 2003', 'answer' => '[MIT 6.661 — question d’examen, en anglais]
Aperture synthesis is achieved by making multiple observations using two small
antennas within the same 10-m square. At what angle off axis is the first null of the
synthesized image?', '_recupere_le' => '2026-11-04T19:55:22.754739+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The maximum baseline is 10 m and φ(τ) has support over a square 20 m on a side,
yielding λ/2D beamwidths = 5×10-4 radians, same as for (b). Both images are limited
by the max')),
						),
					),
				),
			),
		);
	}
}
