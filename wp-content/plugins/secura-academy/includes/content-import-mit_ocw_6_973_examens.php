<?php
/**
 * Questions importees — MIT OpenCourseWare — 6 973 communication system design spring 2006
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.973 Communication System Design, Spring 2006 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_973_examens' ) ) {
	function seca_import_mit_ocw_6_973_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-973-examens', 'nom' => 'MIT OpenCourseWare — 6 973 communication system design spring 2006', 'url' => 'https://ocw.mit.edu/courses/6-973-communication-system-design-spring-2006/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.973 Communication System Design, Spring 2006 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'les-fondamentaux-du-reseau' => array(
					'title' => 'les-fondamentaux-du-reseau',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.973 — question d’examen, en anglais]
– Minimal orthonormalization (from prof. Cioffi) (10pts)
   Each column of A given below is a data symbol that is used to construct its corresponding modulated
   waveform from the set of orthonormal basis functions {φ1 (t ), φ2 (t ),..., φ6 (t )} . The set of modulated
   waveforms described by the columns of A can be represented with a smaller number of basis functions.', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : ⎡ -3.3941e-01 3.2336e-02 -1.1243e-01 ⎤
⎢ -6.1902e-01 2.2144e-01 3.5120e-01 ⎥
⎢                                    ⎥
⎢ -6.7883e-01 6.4671e-02 -2.2486e-01⎥
Q =orth(A)= ⎢                                    ⎥
⎢ -3.3837e-02 -2.4499e-01 3.4793e-01⎥
⎢ -6.7675e-02 -4.8998e-01 6.9586e-01⎥
⎢                                    ⎥
⎣ -1.8730e-01 -8.0351e-01 -4.5626e-01⎦
A(t ) = A*φ (t ) = A*QQ*φ (t ) = ( A*Q)Q*φ (t ) = Â*φQ (t )
2) How many basis functions are actually needed to represent our signal set? What are the new basis
functions in terms of {φ1 (t ), φ2 (t ),..., φ6 (t )} ?
Cite as: Vladimir Stojanovic, course materials for 6.973 Communication System Design, Spring 2006.
Downloaded on [DD Month YYYY].
rank(Q) is three. Therefore we need three basis functions to represent the signal set. The new basis
functions are: φQ (t ) = Q φ (t )
*
3) Find the new matrix Â which gives the data symbol representation for the original modulated
waveforms using the smaller set of basis functions found in (2). Â will have 8 columns, one for each data
symbol. The number of rows in Â will be the number of basis functions you found in (2).
⎡-2.6907e+00 -6.1696e+00 -8.5609e+00 -1.2040e+01 -1.4431e+01 -1.7910e+01 -2.0301e+01 -2.3780e+01⎤
Â = ⎢⎢-1.2239e+00 -3.4513e+00 -1.4804e-02 - 2.2422e+00 1.1943e+00 -1.0331e+00 2.4034e+00 1.7598e-01 ⎥⎥
⎢-1.1235e+00
⎣            -1.5609e-01 -8.4300e-01 1.2439e-01 -5.6252e-01 4.0486e-01 -2.8204e-01 6.8534e-01 ⎦⎥', 'source' => 'MIT OpenCourseWare, 6.973 Communication System Design, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.973 Communication System Design, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'choices' => array('Impossible à déterminer', 'L\'inverse de the transmitted signals ai(t) are represented (with a superscript of * meaning matrix or vector transpose)
   as

                                                  a(t ) = a*φ (t )

   thus, each row of a(t) is a possible transmitted signal.
   1) use matlab to find an orthonormal basis for the columns of a. record the matrix of basis vectors.
   the matlab commands help and orth will be useful. in particular, if one executes q = orth(a) in
   matlab, a 6 × 3 orthogonal matrix q is produced such that q*q = i and a* = [a*q]q*. the columns of q
   can be thought of as a new basis – thus try writing a(t) and interpetting to get a new set of basis functions
   and description of the 7 possible transmit waveforms. note that help orth will give a summary of the orth
   command. to enter the matrix b in matlab (for example) shown below, simply type b=[1 2; 3 4];

   2) how many basis functions are actually needed to represent our signal set? what are the new basis
   functions in terms of {φ1 (t ), φ2 (t ),..., φ6 (t )} ?
   3) find the new matrix â which gives the data symbol representation for the original modulated
   waveforms using the smaller set of basis functions found in (2). â will have 8 columns, one for each data
   symbol. the number of rows in â will be the number of basis functions you found in (2).', 'The transmitted signals ai(t) are represented (with a superscript of * meaning matrix or vector transpose)
   as

                                                  A(t ) = A*φ (t )

   Thus, each row of A(t) is a possible transmitted signal.
   1) Use MATLAB to find an orthonormal basis for the columns of A. Record the matrix of basis vectors.
   The MATLAB commands help and orth will be useful. In particular, if one executes Q = orth(A) in
   MATLAB, a 6 × 3 orthogonal matrix Q is produced such that Q*Q = I and A* = [A*Q]Q*. The columns of Q
   can be thought of as a new basis – thus try writing A(t) and interpetting to get a new set of basis functions
   and description of the 7 possible transmit waveforms. Note that help orth will give a summary of the orth
   command. To enter the matrix B in MATLAB (for example) shown below, simply type B=[1 2; 3 4];

   2) How many basis functions are actually needed to represent our signal set? What are the new basis
   functions in terms of {φ1 (t ), φ2 (t ),..., φ6 (t )} ?
   3) Find the new matrix Â which gives the data symbol representation for the original modulated
   waveforms using the smaller set of basis functions found in (2). Â will have 8 columns, one for each data
   symbol. The number of rows in Â will be the number of basis functions you found in (2).', 'Pas the transmitted signals ai(t) are represented (with a superscript of * meaning matrix or vector transpose)
   as

                                                  a(t ) = a*φ (t )

   thus, each row of a(t) is a possible transmitted signal.
   1) use matlab to find an orthonormal basis for the columns of a. record the matrix of basis vectors.
   the matlab commands help and orth will be useful. in particular, if one executes q = orth(a) in
   matlab, a 6 × 3 orthogonal matrix q is produced such that q*q = i and a* = [a*q]q*. the columns of q
   can be thought of as a new basis – thus try writing a(t) and interpetting to get a new set of basis functions
   and description of the 7 possible transmit waveforms. note that help orth will give a summary of the orth
   command. to enter the matrix b in matlab (for example) shown below, simply type b=[1 2; 3 4];

   2) how many basis functions are actually needed to represent our signal set? what are the new basis
   functions in terms of {φ1 (t ), φ2 (t ),..., φ6 (t )} ?
   3) find the new matrix â which gives the data symbol representation for the original modulated
   waveforms using the smaller set of basis functions found in (2). â will have 8 columns, one for each data
   symbol. the number of rows in â will be the number of basis functions you found in (2).'), 'correct' => 2, 'answer' => 'The transmitted signals ai(t) are represented (with a superscript of * meaning matrix or vector transpose)
   as

                                                  A(t ) = A*φ (t )

   Thus, each row of A(t) is a possible transmitted signal.
   1) Use MATLAB to find an orthonormal basis for the columns of A. Record the matrix of basis vectors.
   The MATLAB commands help and orth will be useful. In particular, if one executes Q = orth(A) in
   MATLAB, a 6 × 3 orthogonal matrix Q is produced such that Q*Q = I and A* = [A*Q]Q*. The columns of Q
   can be thought of as a new basis – thus try writing A(t) and interpetting to get a new set of basis functions
   and description of the 7 possible transmit waveforms. Note that help orth will give a summary of the orth
   command. To enter the matrix B in MATLAB (for example) shown below, simply type B=[1 2; 3 4];

   2) How many basis functions are actually needed to represent our signal set? What are the new basis
   functions in terms of {φ1 (t ), φ2 (t ),..., φ6 (t )} ?
   3) Find the new matrix Â which gives the data symbol representation for the original modulated
   waveforms using the smaller set of basis functions found in (2). Â will have 8 columns, one for each data
   symbol. The number of rows in Â will be the number of basis functions you found in (2).', '_recupere_le' => '2026-11-04T19:55:22.775252+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 6.973 — question d’examen, en anglais]
- Water-filling (40pts)
 Our example channel is 0.9D-1+1. The script waterfill.m contains basic channel and noise information.
 1) Capacity (20pts)
 Design the waterfilling rate-adaptive algorithm (based on the iterative algorithm discussed in class). Find
 the capacity of the channel.
 2) QAM (10pts)
 Assuming a Pe=10-4, find the Gap for the QAM modulation and find the achievable bit rate for this channel
 using the algorithm in 1) modified to include the Gap for QAM at Pe=10-4.
 3) PSK (10pts)
 Find the Gap for the PSK modulation at Pe=10-4 and calculate the bit rate.', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : (waterfilling code is shown in waterfill_soln.m function and by running ps1_problem3_soln.m,
for this part of the problem we get (by setting the gap to 0dB):
c_bar = 1.5541e+00 % total channel capacity per dimension
cn_bar = 9.6934e-01 1.8456e+00 2.2297e+00 2.3436e+00 2.2297e+00 1.8456e+00 9.6934e-01 0
en_bar = 9.5470e-01 1.1916e+00 1.2329e+00 1.2415e+00 1.2329e+00 1.1916e+00 9.5470e-01 0
Nstar = 7
gn = 2.9680e+00 1.0000e+01 1.7032e+01 1.9945e+01 1.7032e+01 1.0000e+01 2.9680e+00 5.5249e-02
2) QAM (10pts)
Assuming a Pe=10-4, find the Gap for the QAM modulation and find the achievable bit rate for this channel
using the algorithm in 1) modified to include the Gap for QAM at Pe=10-4.
Solution: (waterfilling code is shown in waterfill_soln.m function and by running ps1_problem3_soln.m,
for this part of the problem we get (by setting the gap to 6.637dB).
b_bar_qam = 8.0894e-01
bn_bar_qam = 1.1774e-01 9.9396e-01 1.3781e+00 1.4920e+00 1.3781e+00 9.9396e-01 1.1774e-01    0
en_bar_qam = 2.7540e-01 1.3677e+00 1.5581e+00 1.5976e+00 1.5581e+00 1.3677e+00 2.7540e-01     0
Nstar_qam = 7
gn_qam = 2.9680e+00 1.0000e+01 1.7032e+01 1.9945e+01 1.7032e+01 1.0000e+01 2.9680e+00 5.5249e-02
The gap for QAM can be calculated from following equations:
M −1
; d  2σ Q (Pe ) ; Γ QAM = ( Q ( Pe) )
−1              1 −1         2
Ex = d 2
12                            3
⎛                   ⎞
1                    1      ⎛ 12 E x ⎞ 1      ⎜      SNR          ⎟ 1       ⎛    SNR ⎞ )
( b = log 2 (1 + (M −1)) = log 2 ⎜ 1+      = log 2 ⎜1+                   = log 2 ⎜ 1+      ⎟⎟
2 ⎟                             ⎟         ⎜ Γ
2                    2      ⎝    d ⎠ 2        ⎜ 1 ( Q −1 ( Pe) ) ⎟ 2
2
⎝     QAM ⎠
⎝ 3                 ⎠
3) PSK (10pts)
Find the Gap for the PSK modulation at Pe=10-4 and calculate the bit rate.
2
⎛π ⎞       π                               ⎛ Q −1 ( Pe) ⎞
d = 2 Ex sin ⎜ ⎟ ≈ 2 Ex   ; d ≈ 2σ Q −1 (Pe ) ; Γ PSK = ⎜            ⎟
⎝M ⎠       M                               ⎝ π          ⎠
⎛              ⎞
⎛                 ⎞         ⎜              ⎟
⎛ 2π Ex ⎞ 1               4π Ex                                         ⎛ SNR ⎞
⎟ ≈ 1 log ⎜ 1+           ⎟ 1
2
1            1                                                           SNR
b = log 2 ( M ) = log 2 ⎜        ⎟ = log 2 ⎜                          2⎜            2 ⎟
= log 2 ⎜ 1+    ⎟
⎜        ⎟
⎝ 4σ ( Q ( Pe) ) ⎠
⎜               2
⎟                                  ⎝ Γ PSK ⎠
⎜ ⎛ Q ( Pe) ⎞ ⎟
2            2                                  −1                      −1
⎝ d ⎠ 4                                  4                       4
2
⎜ ⎜ π       ⎟ ⎟
⎝ ⎝         ⎠ ⎠
Plot the energy and bit distributions for 1-3. Try increasing the number of dimensions (decrease tone
spacing). Plot the capacity, bitQAM, bitPSK vs. number of dimensions. Explain the plots.
b_bar_psk = 6.8481e-01
bn_bar_psk = 3.7926e-01 8.1737e-01 1.0094e+00 1.0664e+00 1.0094e+00 8.1737e-01 3.7926e-01    0
en_bar_psk = 8.7918e-01 1.2112e+00 1.2691e+00 1.2811e+00 1.2691e+00 1.2112e+00 8.7918e-01     0
Nstar_psk = 7
gn_psk = 2.9680e+00 1.0000e+01 1.7032e+01 1.9945e+01 1.7032e+01 1.0000e+01 2.9680e+00 5.5249e-02
Cite as: Vladimir Stojanovic, course materials for 6.973 Communication System Design, Spring 2006.
Downloaded on [DD Month YYYY].
Fig.3.1. Average number of bits per dimension for a) 0.9D-1+1 channel, b) randomly distributed 100-tap multipath
channel
Since the channel in Fig. 3.1 a) is pretty smooth, not many dimensions (>4) are needed to accurately estimate the
capacity of the channel. On the other hand, in a heavily non-line of site (multi-path) channel significant notching occurs
in frequency domain hence many points (dimensions) are needed to accurately estimate the channel capacity.
Cite as: Vladimir Stojanovic, course materials for 6.973 Communication System Design, Spring 2006.
Downloaded on [DD Month YYYY].', 'source' => 'MIT OpenCourseWare, 6.973 Communication System Design, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.973 Communication System Design, Spring 2006 — examen et corrigé officiel (MIT EECS)', 'choices' => array('L\'inverse de plot the energy and bit distributions for 1-3. try increasing the number of dimensions (decrease tone
 spacing). plot the capacity, bitqam, bitpsk vs. number of dimensions. explain the plots.

cite as: vladimir stojanovic, course materials for 6.973 communication system design, spring 2006.

                                   downloaded on [dd month yyyy].', 'Pas plot the energy and bit distributions for 1-3. try increasing the number of dimensions (decrease tone
 spacing). plot the capacity, bitqam, bitpsk vs. number of dimensions. explain the plots.

cite as: vladimir stojanovic, course materials for 6.973 communication system design, spring 2006.

                                   downloaded on [dd month yyyy].', 'Impossible à déterminer', 'Plot the energy and bit distributions for 1-3. Try increasing the number of dimensions (decrease tone
 spacing). Plot the capacity, bitQAM, bitPSK vs. number of dimensions. Explain the plots.

Cite as: Vladimir Stojanovic, course materials for 6.973 Communication System Design, Spring 2006.

                                   Downloaded on [DD Month YYYY].'), 'correct' => 3, 'answer' => 'Plot the energy and bit distributions for 1-3. Try increasing the number of dimensions (decrease tone
 spacing). Plot the capacity, bitQAM, bitPSK vs. number of dimensions. Explain the plots.

Cite as: Vladimir Stojanovic, course materials for 6.973 Communication System Design, Spring 2006.

                                   Downloaded on [DD Month YYYY].', '_recupere_le' => '2026-11-04T19:55:22.775666+00:00Z', '_strategie' => 'separation_enum_solution'),
						),
					),
				),
			),
		);
	}
}
