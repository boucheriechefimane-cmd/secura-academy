<?php
/**
 * Questions importees — MIT OpenCourseWare — 14.15J Networks (Spring 2018) : examen, pratique et corrigés officiels
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 14.15J Networks, Spring 2018 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_14_15j_examens' ) ) {
	function seca_import_mit_ocw_14_15j_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-14-15j-examens', 'nom' => 'MIT OpenCourseWare — 14.15J Networks (Spring 2018) : examen, pratique et corrigés officiels', 'url' => 'https://ocw.mit.edu/courses/14-15j-networks-spring-2018/pages/exams/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 14.15J Networks, Spring 2018 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'authentification' => array(
					'title' => 'authentification',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 14.15J — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : Now, consider a different construction for a random graph model. We
 take n vertices and go through each distinct trio of three vertices and with
 a
 independent probability p = connect the trio using three edges
 (n − 1)(n − 2)
 to form a triangle. Compute the mean vertex degree and clustering coefficient
 for this network model.
 Pick an arbitrary vertex i, let Δij be the indicator random variable
 denoting a link between i, j. Then
 E[Δij ] = 1 − (1 − p)n−2
 = 1 − e(−p(n−2))
 = 1 − e(−a/(n−1))
 = a/(n − 1)
 Then the average degree is E[Δij ](n − 1) = a. Observe that in this case
 the number of triangles grow linearly as the number of nodes
  
 n
 Number of Triangle = p∼
 = na/6
 Also, the number of triples of uvw occurs when either uvw is a triangle
 or there are triangles uvj and vwk and no triangle uvw where j, k = 6
 u, v, w. Call the event of no triangle in uvw but there exists a triple
 between them as Γ(uvw)
 P(Γ(uvw)) = 3(1 − (1 − p)n−3 )2 (1 − p)
 ∼
 = 3a2 /n2
 The ratio is roughly 3/(3a + 1) and points have been awarded to show
 that the clustering coefficient is a constant (does not decay to 0 as
 n → ∞).', 'source' => 'MIT OpenCourseWare, 14.15J Networks, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'choices' => array('Pas now, consider a different construction for a random graph model. we
 take n vertices and go through each distinct trio of three vertices and with
 a
 independent probability p = connect the trio using three edges
 (n − 1)(n − 2)
 to form a triangle. compute the mean vertex degree and clustering coefficient for
 this network model.', 'Impossible à déterminer', 'L\'inverse de now, consider a different construction for a random graph model. we
 take n vertices and go through each distinct trio of three vertices and with
 a
 independent probability p = connect the trio using three edges
 (n − 1)(n − 2)
 to form a triangle. compute the mean vertex degree and clustering coefficient for
 this network model.', 'Now, consider a different construction for a random graph model. We
 take n vertices and go through each distinct trio of three vertices and with
 a
 independent probability p = connect the trio using three edges
 (n − 1)(n − 2)
 to form a triangle. Compute the mean vertex degree and clustering coefficient for
 this network model.'), 'correct' => 3, 'answer' => 'Now, consider a different construction for a random graph model. We
 take n vertices and go through each distinct trio of three vertices and with
 a
 independent probability p = connect the trio using three edges
 (n − 1)(n − 2)
 to form a triangle. Compute the mean vertex degree and clustering coefficient for
 this network model.', '_recupere_le' => '2026-11-04T19:55:22.376393+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 14.15J — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : Show that the xi \'s are computed by finding the largest λ for which there
 exists a set of xi for i = 0, 1, 2, . . . such that:
 λxi = xi−1 + xi+1 , ∀i = 1, 2, . . .
 Note that we can always normalize the eigenvector centrality by dividing xi by
 x0 for all i, so that x0 = 1.
 This follows by representing the ring network as Ax = λx where λ is
 the largest eigenvalue and A is the adjacency matrix.', 'source' => 'MIT OpenCourseWare, 14.15J Networks, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'choices' => array('Impossible à déterminer', 'Show that the xi \'s are computed by finding the largest λ for which there
 exists a set of xi for i = 0, 1, 2, . . . such that:
 λxi = xi−1 + xi+1 , ∀i = 1, 2, . . .
 Note that we can always normalize the eigenvector centrality by dividing xi by
 x0 for all i, so that x0 = 1.', 'Pas show that the xi \'s are computed by finding the largest λ for which there
 exists a set of xi for i = 0, 1, 2, . . . such that:
 λxi = xi−1 + xi+1 , ∀i = 1, 2, . . .
 note that we can always normalize the eigenvector centrality by dividing xi by
 x0 for all i, so that x0 = 1.', 'L\'inverse de show that the xi \'s are computed by finding the largest λ for which there
 exists a set of xi for i = 0, 1, 2, . . . such that:
 λxi = xi−1 + xi+1 , ∀i = 1, 2, . . .
 note that we can always normalize the eigenvector centrality by dividing xi by
 x0 for all i, so that x0 = 1.'), 'correct' => 1, 'answer' => 'Show that the xi \'s are computed by finding the largest λ for which there
 exists a set of xi for i = 0, 1, 2, . . . such that:
 λxi = xi−1 + xi+1 , ∀i = 1, 2, . . .
 Note that we can always normalize the eigenvector centrality by dividing xi by
 x0 for all i, so that x0 = 1.', '_recupere_le' => '2026-11-04T19:55:22.376539+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 14.15J — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : Show that all the nodes have equal ranking. (Hint: Show that the is
 xi = 1 for all i. This should be a straightforward conclusion and can be proved
 by inspection.).
 One can argue by symmetry or show that λ = 2. If λ = 2 all xi = 1
 is a solution and hence the eigenvector. λ cannot be larger than 2. If
 so, and xt was the largest then
 λxt = xt−1 + xt+1 ≤ 2xt
 λ ≤ 2 indeed.
Part II
Next, as shown in Figure 2, we add an edge between two nodes so that the infinite
ring is divided into two symmetric halves. We will examine the eigenvector centrality
of this new network. By symmetry, we only need to find the eigenvector centrality
 Figure 2:
measures indexed by x0 , x1 , x2 , . . . . As before, we always normalize it so that x0 = 1.', 'source' => 'MIT OpenCourseWare, 14.15J Networks, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'choices' => array('L\'inverse de show that all the nodes have equal ranking. (hint: show that the is
 xi = 1 for all i. this should be a straightforward conclusion and can be proved
 by inspection.).
part ii
next, as shown in figure 2, we add an edge between two nodes so that the infinite
ring is divided into two symmetric halves. we will examine the eigenvector centrality
of this new network. by symmetry, we only need to find the eigenvector centrality
 figure 2:
measures indexed by x0 , x1 , x2 , . . . . as before, we always normalize it so that x0 = 1.', 'Pas show that all the nodes have equal ranking. (hint: show that the is
 xi = 1 for all i. this should be a straightforward conclusion and can be proved
 by inspection.).
part ii
next, as shown in figure 2, we add an edge between two nodes so that the infinite
ring is divided into two symmetric halves. we will examine the eigenvector centrality
of this new network. by symmetry, we only need to find the eigenvector centrality
 figure 2:
measures indexed by x0 , x1 , x2 , . . . . as before, we always normalize it so that x0 = 1.', 'Impossible à déterminer', 'Show that all the nodes have equal ranking. (Hint: Show that the is
 xi = 1 for all i. This should be a straightforward conclusion and can be proved
 by inspection.).
Part II
Next, as shown in Figure 2, we add an edge between two nodes so that the infinite
ring is divided into two symmetric halves. We will examine the eigenvector centrality
of this new network. By symmetry, we only need to find the eigenvector centrality
 Figure 2:
measures indexed by x0 , x1 , x2 , . . . . As before, we always normalize it so that x0 = 1.'), 'correct' => 3, 'answer' => 'Show that all the nodes have equal ranking. (Hint: Show that the is
 xi = 1 for all i. This should be a straightforward conclusion and can be proved
 by inspection.).
Part II
Next, as shown in Figure 2, we add an edge between two nodes so that the infinite
ring is divided into two symmetric halves. We will examine the eigenvector centrality
of this new network. By symmetry, we only need to find the eigenvector centrality
 Figure 2:
measures indexed by x0 , x1 , x2 , . . . . As before, we always normalize it so that x0 = 1.', '_recupere_le' => '2026-11-04T19:55:22.376787+00:00Z', '_strategie' => 'separation_enum_solution'),
						),
					),
				),
				'chiffrement-et-https' => array(
					'title' => 'chiffrement-et-https',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 14.15J — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : We have shown in Part (e) that xn is positive and decreasing in n. Please
 prove that limn→∞ xn = 0.
 (Hint: consider writing the system of equations in Q2 into the form of a linear
 dynamical system with state y[n] given by:
  
 xn+1
 y[n] = ,
 xn
 write down the recursive equation y[n + 1] = Ay[n] that describes the evolu-
 tion of the linear dynamics, and think about the equilibrium.) Now you have
 demonstrated that by adding a single edge one can change the relative centrality
 measure xxn0 drastically.
 Observe that  
 λ −1
 y[n + 1] = y[n]
 1 0
 for all n ≥ 1. Then since xn ≤ xn−1 we only need to show that there is
 an eigenvalue of A that is < 1. As it turns out that eigenvalue is
 √
 λ − λ2 − 4
 λA =
 It can be shown that λA < 1 whenever λ > 2. This implies that xn → 0.', 'source' => 'MIT OpenCourseWare, 14.15J Networks, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'choices' => array('Pas we have shown in part (e) that xn is positive and decreasing in n. please
 prove that limn→∞ xn = 0.
 (hint: consider writing the system of equations in q2 into the form of a linear
 dynamical system with state y[n] given by:
  
 xn+1
 y[n] = ,
 xn
 write down the recursive equation y[n + 1] = ay[n] that describes the evolu-
 tion of the linear dynamics, and think about the equilibrium.) now you have
 demonstrated that by adding a single edge one can change the relative centrality
 measure xxn0 drastically.', 'Impossible à déterminer', 'L\'inverse de we have shown in part (e) that xn is positive and decreasing in n. please
 prove that limn→∞ xn = 0.
 (hint: consider writing the system of equations in q2 into the form of a linear
 dynamical system with state y[n] given by:
  
 xn+1
 y[n] = ,
 xn
 write down the recursive equation y[n + 1] = ay[n] that describes the evolu-
 tion of the linear dynamics, and think about the equilibrium.) now you have
 demonstrated that by adding a single edge one can change the relative centrality
 measure xxn0 drastically.', 'We have shown in Part (e) that xn is positive and decreasing in n. Please
 prove that limn→∞ xn = 0.
 (Hint: consider writing the system of equations in Q2 into the form of a linear
 dynamical system with state y[n] given by:
  
 xn+1
 y[n] = ,
 xn
 write down the recursive equation y[n + 1] = Ay[n] that describes the evolu-
 tion of the linear dynamics, and think about the equilibrium.) Now you have
 demonstrated that by adding a single edge one can change the relative centrality
 measure xxn0 drastically.'), 'correct' => 3, 'answer' => 'We have shown in Part (e) that xn is positive and decreasing in n. Please
 prove that limn→∞ xn = 0.
 (Hint: consider writing the system of equations in Q2 into the form of a linear
 dynamical system with state y[n] given by:
  
 xn+1
 y[n] = ,
 xn
 write down the recursive equation y[n + 1] = Ay[n] that describes the evolu-
 tion of the linear dynamics, and think about the equilibrium.) Now you have
 demonstrated that by adding a single edge one can change the relative centrality
 measure xxn0 drastically.', '_recupere_le' => '2026-11-04T19:55:22.377020+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 14.15J — question d’examen, en anglais]

Characterize all', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : Characterize all solutions of the form θi (t) = ai t+bi to the set of dynamical
 equations, i.e., find ai , bi , i = 1, . . . , n.
 ai = ω, bi = b + 2ki π', 'source' => 'MIT OpenCourseWare, 14.15J Networks, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'choices' => array('Pas s of the form θi (t) = ai t+bi to the set of dynamical
 equations, i.e., find ai , bi , i = 1, . . . , n.', 'L\'inverse de s of the form θi (t) = ai t+bi to the set of dynamical
 equations, i.e., find ai , bi , i = 1, . . . , n.', 's of the form θi (t) = ai t+bi to the set of dynamical
 equations, i.e., find ai , bi , i = 1, . . . , n.', 'Impossible à déterminer'), 'correct' => 2, 'answer' => 's of the form θi (t) = ai t+bi to the set of dynamical
 equations, i.e., find ai , bi , i = 1, . . . , n.', '_recupere_le' => '2026-11-04T19:55:22.377565+00:00Z', '_strategie' => 'separation_enum_solution'),
						),
					),
				),
				'la-boutique-en-ligne-se-connecter-en-administrateur' => array(
					'title' => 'la-boutique-en-ligne-se-connecter-en-administrateur',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 14.15J — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : Argue that L is a symmetric matrix and that for any vector x we have that
 xT Lx ≥ 0. Conclude from this that all the eigenvalues of L are non-negative.
 (Hint: Use the fact that all eigenvalues, λ, of a symmetric matrix, P , are of the
 form
 vT P v
 =λ
 vT v
 where v is the corresponding eigenvector.)', 'source' => 'MIT OpenCourseWare, 14.15J Networks, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'choices' => array('Pas argue that l is a symmetric matrix and that for any vector x we have that
 xt lx ≥ 0. conclude from this that all the eigenvalues of l are non-negative.
 (hint: use the fact that all eigenvalues, λ, of a symmetric matrix, p , are of the
 form
 vt p v
 =λ
 vt v
 where v is the corresponding eigenvector.)', 'L\'inverse de argue that l is a symmetric matrix and that for any vector x we have that
 xt lx ≥ 0. conclude from this that all the eigenvalues of l are non-negative.
 (hint: use the fact that all eigenvalues, λ, of a symmetric matrix, p , are of the
 form
 vt p v
 =λ
 vt v
 where v is the corresponding eigenvector.)', 'Impossible à déterminer', 'Argue that L is a symmetric matrix and that for any vector x we have that
 xT Lx ≥ 0. Conclude from this that all the eigenvalues of L are non-negative.
 (Hint: Use the fact that all eigenvalues, λ, of a symmetric matrix, P , are of the
 form
 vT P v
 =λ
 vT v
 where v is the corresponding eigenvector.)'), 'correct' => 3, 'answer' => 'Argue that L is a symmetric matrix and that for any vector x we have that
 xT Lx ≥ 0. Conclude from this that all the eigenvalues of L are non-negative.
 (Hint: Use the fact that all eigenvalues, λ, of a symmetric matrix, P , are of the
 form
 vT P v
 =λ
 vT v
 where v is the corresponding eigenvector.)', '_recupere_le' => '2026-11-04T19:55:22.377750+00:00Z', '_strategie' => 'separation_enum_solution'),
						),
					),
				),
				'la-requete-qui-ne-se-fie-a-personne' => array(
					'title' => 'la-requete-qui-ne-se-fie-a-personne',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 14.15J — question d’examen, en anglais]

Consider a small perturbation away from the state θi = ωt + i and show
 that the vector  = (1 , 2 , . . . , ) satisfies
 d 0
 = g (0)L
 dt
 Your', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : Consider a small perturbation away from the state θi = ωt + i and show
 that the vector  = (1 , 2 , . . . , ) satisfies
 d 0
 = g (0)L
 dt
 Your solution should specify L in terms of [Aij ], the adjacency matrix of an
 undirected graph. (Hint: Using the Taylor series approximation of g(·) around
 0 2 00
 x0 , i.e., g(x) = g(x0 ) + (x − x0 )g (x0 ) + (x−2x0 ) g (x0 ) + . . .. maybe helpful)
 Substitute θi = ωt + i . Then the Taylor approximation around 0 can
 be written as
 di X 0
 = g (0)Aij (i − j )
 dt j
 X
 = g (0)di i − Aij j
 j
 Now stacking the i we get
 d 0
 = g (0)(D − A)
 dt
 (D − A) = L.
 L is also called the graph Laplacian. We will prove that L has only non-negative
 eigenvalues.', 'source' => 'MIT OpenCourseWare, 14.15J Networks, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'choices' => array('should specify L in terms of [Aij ], the adjacency matrix of an
 undirected graph. (Hint: Using the Taylor series approximation of g(·) around
 0 2 00
 x0 , i.e., g(x) = g(x0 ) + (x − x0 )g (x0 ) + (x−2x0 ) g (x0 ) + . . .. maybe helpful)', 'L\'inverse de should specify l in terms of [aij ], the adjacency matrix of an
 undirected graph. (hint: using the taylor series approximation of g(·) around
 0 2 00
 x0 , i.e., g(x) = g(x0 ) + (x − x0 )g (x0 ) + (x−2x0 ) g (x0 ) + . . .. maybe helpful)', 'Pas should specify l in terms of [aij ], the adjacency matrix of an
 undirected graph. (hint: using the taylor series approximation of g(·) around
 0 2 00
 x0 , i.e., g(x) = g(x0 ) + (x − x0 )g (x0 ) + (x−2x0 ) g (x0 ) + . . .. maybe helpful)', 'Impossible à déterminer'), 'correct' => 0, 'answer' => 'should specify L in terms of [Aij ], the adjacency matrix of an
 undirected graph. (Hint: Using the Taylor series approximation of g(·) around
 0 2 00
 x0 , i.e., g(x) = g(x0 ) + (x − x0 )g (x0 ) + (x−2x0 ) g (x0 ) + . . .. maybe helpful)', '_recupere_le' => '2026-11-04T19:55:22.377955+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 14.15J — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : Show that L = M T M where M is the incidence matrix, i.e., the rows
 correspond to the edges and columns correspond to the vertices. Therefore, for
 every edge e = (i, j) between i, j where i < j we have that
 Mev = −1 if v = i
 Mev = 1 if v = j
 Mev = 0 otherwise
 The proof is here.', 'source' => 'MIT OpenCourseWare, 14.15J Networks, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'choices' => array('Pas show that l = m t m where m is the incidence matrix, i.e., the rows
 correspond to the edges and columns correspond to the vertices. therefore, for
 every edge e = (i, j) between i, j where i < j we have that
 mev = −1 if v = i
 mev = 1 if v = j
 mev = 0 otherwise', 'Impossible à déterminer', 'Show that L = M T M where M is the incidence matrix, i.e., the rows
 correspond to the edges and columns correspond to the vertices. Therefore, for
 every edge e = (i, j) between i, j where i < j we have that
 Mev = −1 if v = i
 Mev = 1 if v = j
 Mev = 0 otherwise', 'L\'inverse de show that l = m t m where m is the incidence matrix, i.e., the rows
 correspond to the edges and columns correspond to the vertices. therefore, for
 every edge e = (i, j) between i, j where i < j we have that
 mev = −1 if v = i
 mev = 1 if v = j
 mev = 0 otherwise'), 'correct' => 2, 'answer' => 'Show that L = M T M where M is the incidence matrix, i.e., the rows
 correspond to the edges and columns correspond to the vertices. Therefore, for
 every edge e = (i, j) between i, j where i < j we have that
 Mev = −1 if v = i
 Mev = 1 if v = j
 Mev = 0 otherwise', '_recupere_le' => '2026-11-04T19:55:22.378095+00:00Z', '_strategie' => 'separation_enum_solution'),
						),
					),
				),
				'le-binaire-qui-obeit-trop' => array(
					'title' => 'le-binaire-qui-obeit-trop',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 14.15J — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : For what values of g (0) is the system stable to small perturbations around
 the origin?
 (Hint: You can use a Lyapunov argument with quadratic Lyapunov function
 V (x) = xT x to examine stability of the linearized system in part (b)).
 g (0) < 0 ensures system is stable.', 'source' => 'MIT OpenCourseWare, 14.15J Networks, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'choices' => array('For what values of g (0) is the system stable to small perturbations around
 the origin?
 (Hint: You can use a Lyapunov argument with quadratic Lyapunov function
 V (x) = xT x to examine stability of the linearized system in part (b)).', 'Impossible à déterminer', 'Pas for what values of g (0) is the system stable to small perturbations around
 the origin?
 (hint: you can use a lyapunov argument with quadratic lyapunov function
 v (x) = xt x to examine stability of the linearized system in part (b)).', 'L\'inverse de for what values of g (0) is the system stable to small perturbations around
 the origin?
 (hint: you can use a lyapunov argument with quadratic lyapunov function
 v (x) = xt x to examine stability of the linearized system in part (b)).'), 'correct' => 0, 'answer' => 'For what values of g (0) is the system stable to small perturbations around
 the origin?
 (Hint: You can use a Lyapunov argument with quadratic Lyapunov function
 V (x) = xT x to examine stability of the linearized system in part (b)).', '_recupere_le' => '2026-11-04T19:55:22.378209+00:00Z', '_strategie' => 'separation_enum_solution'),
						),
					),
				),
				'memoire-et-defenses' => array(
					'title' => 'memoire-et-defenses',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 14.15J — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : Show that in the limit of large n, the expected number of triangles in the
 network is a constant. Call Δi,j,k as the indicator random variable that
 denotes a triangle between i, j, k. Then
  
 X n
 E[ Δi,j,k ] = P (Δi,j,k = 1)
 i<j<k
  
 n 3
 = lim p
 n→∞ 3
 = a3 /6', 'source' => 'MIT OpenCourseWare, 14.15J Networks, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'choices' => array('Impossible à déterminer', 'Show that in the limit of large n, the expected number of triangles in the
 network is a constant.', 'L\'inverse de show that in the limit of large n, the expected number of triangles in the
 network is a constant.', 'Pas show that in the limit of large n, the expected number of triangles in the
 network is a constant.'), 'correct' => 1, 'answer' => 'Show that in the limit of large n, the expected number of triangles in the
 network is a constant.', '_recupere_le' => '2026-11-04T19:55:22.378277+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 14.15J — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : Calculate the clustering coefficient C in the limit of large n.
 Note: The clustering coefficient is defined as three times the number of triangles
 divided by the number of connected triplets. A "connected triplet" means three
 vertices uvw with edges (u, v) and (v, w). The edge (u, w) can be present or
 not.
 Call Γi,j,k as the indicator random variable that denotes a triple be-
 tween i, j, k.
   
 X n 3 2
 E[ Γi,j,k ] = p
 i<j<k
 3 2
 Clustering Coefficient = p
 limn→∞ p = 0.', 'source' => 'MIT OpenCourseWare, 14.15J Networks, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'choices' => array('Calculate the clustering coefficient C in the limit of large n.
 Note: The clustering coefficient is defined as three times the number of triangles
 divided by the number of connected triplets. A "connected triplet" means three
 vertices uvw with edges (u, v) and (v, w). The edge (u, w) can be present or
 not.', 'Impossible à déterminer', 'L\'inverse de calculate the clustering coefficient c in the limit of large n.
 note: the clustering coefficient is defined as three times the number of triangles
 divided by the number of connected triplets. a "connected triplet" means three
 vertices uvw with edges (u, v) and (v, w). the edge (u, w) can be present or
 not.', 'Pas calculate the clustering coefficient c in the limit of large n.
 note: the clustering coefficient is defined as three times the number of triangles
 divided by the number of connected triplets. a "connected triplet" means three
 vertices uvw with edges (u, v) and (v, w). the edge (u, w) can be present or
 not.'), 'correct' => 0, 'answer' => 'Calculate the clustering coefficient C in the limit of large n.
 Note: The clustering coefficient is defined as three times the number of triangles
 divided by the number of connected triplets. A "connected triplet" means three
 vertices uvw with edges (u, v) and (v, w). The edge (u, w) can be present or
 not.', '_recupere_le' => '2026-11-04T19:55:22.378410+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 14.15J — question d’examen, en anglais]

Calculate the clustering coefficient C for the Erdos-Renyi random graph
 G2 (n, p) with p(n) = a log(n)/n. Compare your', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : Calculate the clustering coefficient C for the Erdos-Renyi random graph
 G2 (n, p) with p(n) = a log(n)/n. Compare your answer with part (b) in the
 limit of large n.
 As shown before, it is just p, and still 0. But since p is larger in the
 latter case, there is a higher chance that a triple is actually a triangle.', 'source' => 'MIT OpenCourseWare, 14.15J Networks, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'choices' => array('Pas with part (b) in the
 limit of large n.', 'Impossible à déterminer', 'with part (b) in the
 limit of large n.', 'L\'inverse de with part (b) in the
 limit of large n.'), 'correct' => 2, 'answer' => 'with part (b) in the
 limit of large n.', '_recupere_le' => '2026-11-04T19:55:22.378511+00:00Z', '_strategie' => 'separation_enum_solution'),
						),
					),
				),
				'securiser-une-application-web' => array(
					'title' => 'securiser-une-application-web',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 14.15J — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : Show that the eigenvector centrality must satisfy:
 x0 ≥ x1 ≥ x2 ≥ · · · ≥ 0
 (Hint: start with an initial guess xi = 1 for all i, and try to iteratively compute
 the eigenvector. You can prove the inequalities by induction.) Take initial
 guess as xti = 1, where
 λxt+1
 i = xti−1 + xti+1
 Clearly for t = 0 this is true (after many iterations this will converge
 to the true centrality). Assume this for t = k. Now observe for
 λxk+1
 i − λxk+1 k k k k
 i+1 = xi−1 − xi + xi+1 − xi+2
 ≥0
 The last inequality follows from inductive hypothesis.', 'source' => 'MIT OpenCourseWare, 14.15J Networks, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'choices' => array('Show that the eigenvector centrality must satisfy:
 x0 ≥ x1 ≥ x2 ≥ · · · ≥ 0
 (Hint: start with an initial guess xi = 1 for all i, and try to iteratively compute
 the eigenvector. You can prove the inequalities by induction.)', 'L\'inverse de show that the eigenvector centrality must satisfy:
 x0 ≥ x1 ≥ x2 ≥ · · · ≥ 0
 (hint: start with an initial guess xi = 1 for all i, and try to iteratively compute
 the eigenvector. you can prove the inequalities by induction.)', 'Pas show that the eigenvector centrality must satisfy:
 x0 ≥ x1 ≥ x2 ≥ · · · ≥ 0
 (hint: start with an initial guess xi = 1 for all i, and try to iteratively compute
 the eigenvector. you can prove the inequalities by induction.)', 'Impossible à déterminer'), 'correct' => 0, 'answer' => 'Show that the eigenvector centrality must satisfy:
 x0 ≥ x1 ≥ x2 ≥ · · · ≥ 0
 (Hint: start with an initial guess xi = 1 for all i, and try to iteratively compute
 the eigenvector. You can prove the inequalities by induction.)', '_recupere_le' => '2026-11-04T19:55:22.378648+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 14.15J — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : la justification du corrigé officiel est affichée juste après ta réponse.', 'explanation' => 'Corrige officiel du MIT : Show that the largest eigenvalue λ must satisfy:
 2≤λ≤3
 (Hint: observe the system of equations you wrote down for (c).) λ ≥ 2
 because if we sum up the equation in (c) we get
 n
 X Xn
 λ( xi ) = x1 + 2( xi )
 i=0 i=0
 Since x0 is the largest, we also have that
 λx0 = 2x1 + x0 ≤ 3x0', 'source' => 'MIT OpenCourseWare, 14.15J Networks, Spring 2018 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'choices' => array('L\'inverse de show that the largest eigenvalue λ must satisfy:
 2≤λ≤3
 (hint: observe the system of equations you wrote down for (c).)', 'Impossible à déterminer', 'Pas show that the largest eigenvalue λ must satisfy:
 2≤λ≤3
 (hint: observe the system of equations you wrote down for (c).)', 'Show that the largest eigenvalue λ must satisfy:
 2≤λ≤3
 (Hint: observe the system of equations you wrote down for (c).)'), 'correct' => 3, 'answer' => 'Show that the largest eigenvalue λ must satisfy:
 2≤λ≤3
 (Hint: observe the system of equations you wrote down for (c).)', '_recupere_le' => '2026-11-04T19:55:22.378734+00:00Z', '_strategie' => 'separation_enum_solution'),
						),
					),
				),
			),
		);
	}
}
