<?php
/**
 * Questions importees — MIT OpenCourseWare — 18 435j quantum computation fall 2003
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 18.435j Quantum Computation, Fall 2003 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_18_435j_examens' ) ) {
	function seca_import_mit_ocw_18_435j_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-18-435j-examens', 'nom' => 'MIT OpenCourseWare — 18 435j quantum computation fall 2003', 'url' => 'https://ocw.mit.edu/courses/18-435j-quantum-computation-fall-2003/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.435j Quantum Computation, Fall 2003 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.435J — question d’examen, en anglais]
In NMR quantum computing, a Hadamard gate is implemented by rotating
                 G G
around the axis (x + z )/ 2 . Compute the matrix obtained by rotation around this axis
by π radians, and compare to a Hadamard gate.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : If we denote the rotation by angle θ about (x + z )/ 2 by R(θ) , we have
R(θ) = exp[−i(θ / 2)(σX + σZ )/ 2}
θ           θ
= cos I − i sin (σX + σZ )/ 2
2           2
⇒
R(π) = −i(σX + σZ )/ 2
−i   0 1   1 0  
=                  +               
2   1 0   0 −1  
−i  1 1 
=
2  1 −1 
= −iH
where H is the Hadamard gate.', 'source' => 'MIT OpenCourseWare, 18.435j Quantum Computation, Fall 2003 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.435j Quantum Computation, Fall 2003 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.435J — question d’examen, en anglais]
Let
1
H = (σX ⊗ σX + σY ⊗ σY + σZ ⊗ σZ + I ⊗ I )
2
be an operator on two qubits.
Using (a), find exp(−i πH / 4) and exp(−i πH / 2) .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Using equation (4.7) of N&C, we have
exp(i θH ) = cos(θ)I ⊗ I + i sin(θ)H
⇒
exp(−i πH / 4) =     2I ⊗ I / 2 − i 2H / 2
and
exp(−i πH / 2) = −iH .', 'source' => 'MIT OpenCourseWare, 18.435j Quantum Computation, Fall 2003 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.435j Quantum Computation, Fall 2003 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.435J — question d’examen, en anglais]
Let
1
H = (σX ⊗ σX + σY ⊗ σY + σZ ⊗ σZ + I ⊗ I )
2
be an operator on two qubits.
Find a set of orthonormal eigenstates of H .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : You can easily verify that the Bell states, described in the first problem of Problem Set 3, are
one possible set of eigenstates. (In fact, H = Ι2AB − I ⊗ I .) The first state in that problem, the
singlet sate, has eigenvalue –1 and the other three have eigenvalues +1.', 'source' => 'MIT OpenCourseWare, 18.435j Quantum Computation, Fall 2003 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.435j Quantum Computation, Fall 2003 — examen et corrigé officiel (MIT EECS)'),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.435J — question d’examen, en anglais]
Let
1
H = (σX ⊗ σX + σY ⊗ σY + σZ ⊗ σZ + I ⊗ I )
2
be an operator on two qubits.
Find H 2 and write it in a simple form.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : We have
1
H 2 = (σX ⊗ σX + σY ⊗ σY + σZ ⊗ σZ + I ⊗ I )H .
2
Note that
1                 1
(σX ⊗ σX )H = (σX ⊗ σX )(σX ⊗ σX + σY ⊗ σY + σZ ⊗ σZ + I ⊗ I )
2                 4
1
= (σX σX ⊗ σX σX + σX σY ⊗ σX σY + σX σZ ⊗ σX σZ + σX ⊗ σX )
4
1
= (I ⊗ I + i σZ ⊗ iσZ + (−i )σY ⊗ (−i )σY + σX ⊗ σX )
4
1
= (I ⊗ I − σZ ⊗ σZ − σY ⊗ σY + σX ⊗ σX ) .
4
Similarly,
1                   1
(σY ⊗ σY )H = (−σX ⊗ σX + σY ⊗ σY − σZ ⊗ σZ + I ⊗ I )
2                   4
1                   1
(σ ⊗ σZ )H = (−σX ⊗ σX − σY ⊗ σY + σZ ⊗ σZ + I ⊗ I )
2 Z                 4
1            H
(I ⊗ I )H = .
2            2
Adding up these four relations, one can obtain
H2 = I ⊗ I .', 'source' => 'MIT OpenCourseWare, 18.435j Quantum Computation, Fall 2003 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.435j Quantum Computation, Fall 2003 — examen et corrigé officiel (MIT EECS)'),
							array('question' => '[MIT 18.435J — question d’examen, en anglais]
Let
1
H = (σX ⊗ σX + σY ⊗ σY + σZ ⊗ σZ + I ⊗ I )
2
be an operator on two qubits.
Find the eigenvalues of H .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Using Problem 1(b) in Problem Set 2, it can be seen that the only possible values for the
eigenvalues are +1 and –1.', 'source' => 'MIT OpenCourseWare, 18.435j Quantum Computation, Fall 2003 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.435j Quantum Computation, Fall 2003 — examen et corrigé officiel (MIT EECS)'),
						),
					),
				),
			),
		);
	}
}
