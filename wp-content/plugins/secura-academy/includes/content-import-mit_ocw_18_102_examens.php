<?php
/**
 * Questions importees — MIT OpenCourseWare — 18 102 introduction to functional analysis spring 2009
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 18.102 Introduction To Functional Analysis, Spring 2009 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_18_102_examens' ) ) {
	function seca_import_mit_ocw_18_102_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-18-102-examens', 'nom' => 'MIT OpenCourseWare — 18 102 introduction to functional analysis spring 2009', 'url' => 'https://ocw.mit.edu/courses/18-102-introduction-to-functional-analysis-spring-2009/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.102 Introduction To Functional Analysis, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.102 — question d’examen, en anglais] sense (if you are doing p = 2 it is already the usual sense) and hence, this cut-oﬀ sequence converges. Use this to ﬁnd a putative limit of the Cauchy sequence and then check that it works. 1 2                                RICHARD MELROSE 4. Problem 1.4 Consider the ‘unit sphere’ in lp – where if you want you can set p = 2. This is the set of vectors of length 1 : S = {a ∈ lp ; �a�p = 1}. (1) Show that S is closed. (2) Recall the sequential (so not the open covering deﬁnition) characterization of compactness of a set in a metric space (e.g. by checking in Rudin). (3) Show that S is not compact by considering the sequence in lp with kth element the sequence which is all zeros except for a
sense (if you are doing p = 2 it is already the usual sense) and hence, this cut-oﬀ
sequence converges. Use this to ﬁnd a putative limit of the Cauchy sequence and
then check that it works.
1
2                                RICHARD MELROSE
4. Problem 1.4
Consider the ‘unit sphere’ in lp – where if you want you can set p = 2. This is
the set of vectors of length 1 :
S = {a ∈ lp ; �a�p = 1}.
(1) Show that S is closed.
(2) Recall the sequential (so not the open covering deﬁnition) characterization
of compactness of a set in a metric space (e.g. by checking in Rudin).
(3) Show that S is not compact by considering the sequence in lp with kth
element the sequence which is all zeros except for a 1 in the kth slot. Note
that the main problem is not to get yourself confused about sequences of
sequences!
5. Problem 1.5
Show that the norm on any normed space is continuous.
Department of Mathematics, Massachusetts Institute of Technology', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : - So, suppose we are given a Cauchy sequence a(n) in lp . Thus, each
(n)
element is a sequence {aj }∞           p
j=1 in l . From the continuity of the norm in Problem
(n)
1.5 below, �a � must be Cauchy in R and so converges. In particular the sequence
is norm bounded, there exists A such that �a(n) �p ≤ A for all n. The Cauchy
condition itself is that given � > 0 there exists M such that for all m, n > M,
�                  � p1
� (n)      (m) p
(n)     (m)
(1)                 �a − a �p =             |ai − ai |         < �/2.
i
(n)  (m)                                             (n)
Now for each i, |ai − ai | ≤ �a(n) − a(m) �p so each of the sequences ai must
be Cauchy in C. Since C is complete
(n)
(2)                   lim a = ai exists for each i = 1, 2, . . . .
n→∞ i
So, our putative limit is a, the sequence {ai }∞
i=1 . The boundedness of the norms
shows that
N
(n)
�
(3)                                  |ai |p ≤ Ap
i=1
and we can pass to the limit here as n → ∞ since there are only ﬁnitely many
terms. Thus
�N
(4)                       |ai |p ≤ Ap ∀ N =⇒ �a�p ≤ A.
i=1
4                                    RICHARD MELROSE
Thus, a ∈ lp as we hoped. Similarly, we can pass to the limit as m → ∞ in the
ﬁnite inequality which follows from the Cauchy conditions
N
�    (n)  (m)    1
(5)                           (   |ai − ai |p ) p < �/2
i=1
to see that for each N
N
�    (n)         1
(6)                            (   |ai − ai |p ) p ≤ �/2
i=1
and hence
(7)                            �a(n) − a� < � ∀ n > M.
Thus indeed, a(n) → a in lp as we were trying to show.
Notice that the trick is to ‘back oﬀ’ to ﬁnite sums to avoid any issues of inter­
changing limits.
4. Problem 1.4
Consider the ‘unit sphere’ in lp – where if you want you can set p = 2. This is
the set of vectors of length 1 :
S = {a ∈ lp ; �a�p = 1}.
(1) Show that S is closed.
(2) Recall the sequential (so not the open covering deﬁnition) characterization
of compactness of a set in a metric space (e.g. by checking in Rudin).
(3) Show that S is not compact by considering the sequence in lp with kth
element the sequence which is all zeros except for a 1 in the kth slot. Note
that the main problem is not to get yourself confused about sequences of
sequences!
Solution:- By the next problem, the norm is continuous as a function, so
(1)                                  S = {a; �a� = 1}
is the inverse image of the closed subset {1}, hence closed.
Now, the standard result on metric spaces is that a subset is compact if and only
if every sequence with values in the subset has a convergent subsequence with limit
in the subset (if you drop the last condition then the closure is compact).
In this case we consider the sequence (of sequences)
�
(n)    0 i �= n
(2)                               ai =              .
1 i=n
1
This has the property that �a(n) − a(m) �p = 2 p whenever n = � m. Thus, it cannot
have any Cauchy subsequence, and hence cannot have a convergent subsequence,
so S is not compact.
This is important. In fact it is a major diﬀerence between ﬁnite-dimensional and
inﬁnite-dimensional normed spaces. In the latter case the unit sphere cannot be
compact whereas in the former it is.
PROBLEMS 1                            5
5. Problem 1.5
Show that the norm on any normed space is continuous.
Solution:- Right, so I should have put this problem earlier!
The triangle inequality shows that for any u, v in a normed space
(1)                  �u� ≤ �u − v� + �v�, �v� ≤ �u − v� + �u�
which implies that
(2)                           |�u� − �v�| ≤ �u − v�.
This shows that � · � is continuous, indeed it is Lipschitz continuous.
Department of Mathematics, Massachusetts Institute of Technology', 'source' => 'MIT OpenCourseWare, 18.102 Introduction To Functional Analysis, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.102 — question d’examen, en anglais] PROBLEM SET 9 FOR 18.102, SPRING 2009 DUE 11AM TUESDAY 28 APR. RICHARD MELROSE Corrections to earlier versions My apologies for all these errors. Here is a list – they are ﬁxed below (I hope). (1) In P9.2 (2), and elsewhere, C ∞ (S) should be C 0 (S), the space of continuous functions on the circle – with supremum norm. (2) In (P9.2.9) it should be u = F v, not u = Sv. (3) Similarly, before (P9.2.10) it should be u = F v. (4) Discussion around (P9.2.12) clariﬁed. (5) Last part of P10.2 clariﬁed. This week I want you to go through the invertibility theory for the operator d2 (P9.1)                         Qu = (−    + V (x))u(x) dx2 acting on periodic functions. Since we have not developed
PROBLEM SET 9 FOR 18.102, SPRING 2009
DUE 11AM TUESDAY 28 APR.
RICHARD MELROSE
Corrections to earlier versions
My apologies for all these errors. Here is a list – they are ﬁxed below (I hope).
(1) In P9.2 (2), and elsewhere, C ∞ (S) should be C 0 (S), the space of continuous
functions on the circle – with supremum norm.
(2) In (P9.2.9) it should be u = F v, not u = Sv.
(3) Similarly, before (P9.2.10) it should be u = F v.
(4) Discussion around (P9.2.12) clariﬁed.
(5) Last part of P10.2 clariﬁed.
This week I want you to go through the invertibility theory for the operator
d2
(P9.1)                         Qu = (−    + V (x))u(x)
dx2
acting on periodic functions. Since we have not developed the theory to handle this
directly we need to approach it through integral operators.
Before beginning, we need to consider periodic functions.
1. P9.1: Periodic functions
Let S be the circle of radius 1 in the complex plane, centered at the origin,
S = {z; |z| = 1}.
(1) Show that there is a 1-1 correspondence
(P9.1.1) C 0 (S) = {u : S −→ C, continuous} −→
{u : R −→ C; continuous and satisfying u(x + 2π) = u(x) ∀ x ∈ R}.
(2) Show that there is a 1-1 correspondence
(P9.1.2) L2 (0, 2π) ←→ {u ∈ L1loc (R); u�(0,2π) ∈ L2 (0, 2π)
�
and u(x + 2π) = u(x) ∀ x ∈ R}/NP
where NP is the space of null functions on R satisfying u(x + 2π) = u(x)
for all x ∈ R.
(3) If we denote by L2 (S) the space on the left in (P9.1.2) show that there is a
dense inclusion
(P9.1.3)                            C 0 (S) −→ L2 (S).
So, the idea is that we can think of functions on S as 2π-periodic functions on
R.
1
2                                     RICHARD MELROSE
2. P9.2: Schrödinger’s operator
Since that is what it is, or at least it is an example thereof:
d2 u(x)
(P9.2.1)                  −       + V (x)u(x) = f (x), x ∈ R,
dx2
(1) First we will consider the special case V = 1. Why not V = 0? – Don’t try
to answer this until the end!
(2) Recall how to solve the diﬀerential equation
d2 u(x)
(P9.2.2)                      −       + u(x) = f (x), x ∈ R,
dx2
where f (x) ∈ C 0 (S) is a continuous, 2π-periodic function on the line. Show
that there is a unique 2π-periodic and twice continuously diﬀerentiable
function, u, on R satisfying (P9.2.2) and that this solution can be written
in the form
�
(P9.2.3)                 u(x) = (Sf )(x) =        A(x, y)f (y)
0,2π
0   2
where A(x, y) ∈ C (R ) satisﬁes A(x + 2π, y + 2π) = A(x, y) for all (x, y) ∈
R.
Extended hint: In case you managed to avoid a course on diﬀerential
equations! First try to ﬁnd a solution, igonoring the periodicity issue. To
do so one can (for example, there are other ways) factorize the diﬀerential
operator involved, checking that
d2 u(x)               dv              du
(P9.2.4)              −    2
+ u(x) = −(      + v) if v =    −u
dx                  dx              dx
since the cross terms cancel. Then recall the idea of integrating factors to
see that
du           dφ
− u = ex , φ = e−x u,
(P9.2.5)                      dx           dx
dv        −x dψ
+v =e          , ψ = ex v.
dx            dx
Now, solve the problem by integrating twice from the origin (say) and hence
get a solution to the diﬀerential equation (P9.2.2). Write this out explicitly
as a double integral, and then change the order of integration to write the
solution as
�
�
(P9.2.6)                     u (x) =       A� (x, y)f (y)dy
0,2π
where A is continuous on R × [0, 2π]. Compute the diﬀerence u� (2π) − u� (0)
�
�
du�                                            �
and dudx (2π) − dx (0) as integrals involving f. Now, add to u as solution
x      −x
to the homogeneous equation, for f = 0, namely c1 e + c2 e , so that the
new solution to (P9.2.2) satisﬁes u(2π) = u(0) and du            du
dx (2π) = dx (0). Now,
check that u is given by an integral of the form (P9.2.3) with A as stated.
(3) Check, either directly or indirectly, that A(y, x) = A(x, y) and that A is
real.
(4) Conclude that the operator S extends by continuity to a bounded operator
on L2 (S).
PROBLEMS 9                                      3
(5) Check, probably indirectly rather than directly, that
(P9.2.7)                  S(eikx ) = (k 2 + 1)−1 eikx , k ∈ Z.
(6) Conclude, either from the previous result or otherwise that S is a compact
self-adjoint operator on L2 (S).
(7) Show that if g ∈ C 0 (S)) then Sg is twice continuously diﬀerentiable. Hint:
Proceed directly by diﬀerentiating the integral.
(8) From (P9.2.7) conclude that S = F 2 where F is also a compact self-adjoint
1
operator on L2 (S) with eigenvalues (k 2 + 1)− 2 .
(9) Show that F : L2 (S) −→ C 0 (S).
(10) Now, going back to the real equation (P9.2.1), we assume that V is contin­
uous, real-valued and 2π-periodic. Show that if u is a twice-diﬀerentiable
2π-periodic function satisfying (P9.2.1) for a given f ∈ C 0 (S) then
(P9.2.8)      u + S((V − 1)u) = Sf and hence u = −F 2 ((V − 1)u) + F 2 f
and hence conclude that
(P9.2.9)       u = F v where v ∈ L2 (S) satisﬁes v + (F (V − 1)F )v = F f
where V − 1 is the operator deﬁned by multiplication by V − 1.
(11) Show the converse, that if v ∈ L2 (S) satisﬁes
(P9.2.10)               v + (F (V − 1)F )v = F f, f ∈ C 0 (S)
then u = F v is 2π-periodic and twice-diﬀerentiable on R and satisﬁes
(P9.2.1).
(12) Apply the Spectral theorem to F (V − 1)F (including why it applies) and
show that there is a sequence λj in R \\ {0} with |λj | → 0 such that for all
λ ∈ C \\ {0}, the equation
(P9.2.11)               λv + (F (V − 1)F )v = g, g ∈ L2 (S)
has a unique solution for every g ∈ L2 (S) if and only if λ =
� λj for any j.
(13) Show that for the λj the solutions of
(P9.2.12)               λj v + (F (V − 1)F )v = 0, v ∈ L2 (S),
are all continuous 2π-periodic functions on R.
(14) Show that the corresponding functions u = F v where v satisﬁes (P9.2.12)
are all twice continuously diﬀerentiable, 2π-periodic functions on R satis­
fying
d2 u
(P9.2.13)             −      + (1 − sj + sj V (x))u(x) = 0, sj = 1/λj .
dx2
(15) Conversely, show that if u is a twice continuously diﬀerentiable, 2π-periodic
function satisfying
d2 u
(P9.2.14)           −      + (1 − s + sV (x))u(x) = 0, s ∈ C,
dx2
and u is not identically 0 then s = sj for some j.
(16) Finally, conclude that Fredholm’s alternative holds for the equation (P9.2.1)
Theorem 1. For a given real-valued, continuous 2π-periodic function V
on R, either (P9.2.1) has a unique twice continuously diﬀerentiable, 2π­
periodic, solution for each f which is continuous and 2π-periodic or else
4                                RICHARD MELROSE
there exists a ﬁnite, but positive, dimensional space of twice continuously
diﬀerentiable 2π-periodic solutions to the homogeneous equation
d2 w(x)
(P9.2.15)                −          + V (x)w(x) = 0, x ∈ R,
dx2
�
and (P9.2.1) has a solution if and only if (0,2π) f w = 0 for every 2π­
periodic solution, w, to (P9.2.15).
3. Not to be handed in, just for the enthusiastic
Check that we really can understand all the 2π periodic eigenfunctions of the
Schrödinger operator using the discussion above. First of all, there was nothing
sacred about the addition of 1 to −d2 /dx2 , we could add any positive number
and get a similar result – the problem with 0 is that the constants satisfy the
homogeneous equation d2 u/dx2 = 0. What we have shown is that the operator
d2 u
(P9.2.1)                     u �−→ Qu = −         u+Vu
dx2
applied to twice continuously diﬀerentiable functions has at least a left inverse
unless there is a non-trivial solution of
d2 u
(P9.2.2)                          − 2 u + V u = 0.
dx
Namely, the left inverse is R = F (Id +F (V −1)F )−1 F. This is a compact self-adjoint
operator. Show – and there is still a bit of work to do – that (twice continuously
diﬀerentiable) eigenfunctions of Q, meaning solutions of Qu = τ u are precisely the
non-trivial solutions of Ru = τ −1 u.
What to do in case (P9.2.2) does have a non-trivial solution? Show that the
space of these is ﬁnite dimensional and conclude that essentially the same result
holds by working on the orthocomplement in L2 (S).
Department of Mathematics, Massachusetts Institute of Technology', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Solutions to Problem set 9
P9.1: Periodic functions
Let S be the circle of radius 1 in the complex plane, centered at the origin,
S = {z; |z| = 1}.
(1) Show that there is a 1-1 correspondence
(21.40)    C 0 (S) = {u : S −→ C, continuous} −→
{u : R −→ C; continuous and satisfying u(x + 2π) = u(x) ∀ x ∈ R}.
Solution: The map E : R � θ �−→ e2πiθ ∈ S is continuous, surjective and
2π-periodic and the inverse image of any point of the circle is precisly of
the form θ + 2πZ for some θ ∈ R. Thus composition deﬁnes a map
(21.41)                  E ∗ : C 0 (S) −→ C 0 (R), E ∗ f = f ◦ E.
This map is a linear bijection.
(2) Show that there is a 1-1 correspondence
(21.42) L2 (0, 2π) ←→ {u ∈ L1loc (R); u�(0,2π) ∈ L2 (0, 2π)
�
and u(x + 2π) = u(x) ∀ x ∈ R}/NP
where NP is the space of null functions on R satisfying u(x + 2π) = u(x)
for all x ∈ R.
Solution: Our original deﬁnition of L2 (0, 2π) is as functions on R which
are square-integrable and vanish outside (0, 2π). Given such a function u
we can deﬁne an element of the right side of (21.42) by assigning a value
at 0 and then extending by periodicity
(21.43)                         ũ(x) = u(x − 2nπ), n ∈ Z
where for each x ∈ R there is a unique integer n so that x − 2nπ ∈ [0, 2π).
Null functions are mapped to null functions his way and changing the choice
of value at 0 changes ũ by a null function. This gives a map as in (21.42)
and restriction to (0, 2π) is a 2-sided invese.
(3) If we denote by L2 (S) the space on the left in (21.42) show that there is a
dense inclusion
(21.44)                              C 0 (S) −→ L2 (S).
Solution: Combining the ﬁrst map and the inverse of the second gives an
inclusion. We know that continuous functions vanishing near the end-points
of (0, 2π) are dense in L2 (0, 2π) so density follows.
So, the idea is that we can freely think of functions on S as 2π-periodic functions
on R and conversely.
P9.2: Schrödinger’s operator
Since that is what it is, or at least it is an example thereof:
d2 u(x)
(21.45)                  −           + V (x)u(x) = f (x), x ∈ R,
dx2
(1) First we will consider the special case V = 1. Why not V = 0? – Don’t try
to answer this until the end!
Solution: The reason we take V = 1, or at least some other positive
constant is that there is 1-d space of periodic solutions to d2 u/dx2 = 0,
namely the constants.
(2) Recall how to solve the diﬀerential equation
d2 u(x)
(21.46)                     −           + u(x) = f (x), x ∈ R,
dx2
where f (x) ∈ C 0 (S) is a continuous, 2π-periodic function on the line. Show
that there is a unique 2π-periodic and twice continuously diﬀerentiable
function, u, on R satisfying (21.46) and that this solution can be written
in the form
�
(21.47)                  u(x) = (Sf )(x) =        A(x, y)f (y)
0,2π
where A(x, y) ∈ C 0 (R2 ) satisﬁes A(x + 2π, y + 2π) = A(x, y) for all (x, y) ∈
R.
Extended hint: In case you managed to avoid a course on diﬀerential
equations! First try to ﬁnd a solution, igonoring the periodicity issue. To
do so one can (for example, there are other ways) factorize the diﬀerential
operator involved, checking that
d2 u(x)             dv             du
(21.48)              −        2
+ u(x) = −(    + v) if v =    −u
dx                 dx             dx
since the cross terms cancel. Then recall the idea of integrating factors to
see that
du         dφ
− u = ex , φ = e−x u,
(21.49)                         dx         dx
dv          dψ
+ v = e−x , ψ = ex v.
dx          dx
Now, solve the problem by integrating twice from the origin (say) and hence
get a solution to the diﬀerential equation (21.46). Write this out explicitly
as a double integral, and then change the order of integration to write the
solution as
�
�
(21.50)                     u (x) =       A� (x, y)f (y)dy
0,2π
where A� is continuous on R × [0, 2π]. Compute the diﬀerence u� (2π) − u� (0)
�
du�                                             �
and du
dx (2π) − dx (0) as integrals involving f. Now, add to u as solution
x       −x
to the homogeneous equation, for f = 0, namely c1 e + c2 e , so that the
new solution to (21.46) satisﬁes u(2π) = u(0) and du              du
dx (2π) = dx (0). Now,
check that u is given by an integral of the form (21.47) with A as stated.
Solution: Integrating once we ﬁnd that if v = du
dx − u then
� x                              � x
−x                      �
(21.51)           v(x) = −e               s
e f (s)ds, u (x) = e   x
e−t v(t)dt
0                                0
2   �
gives a solution of the equation − ddxu2 + u� (x) = f (x) so combinging these
two and changing the order of integration
� x
�                                          1 � y−x
− ex−y
�
u (x) =        Ã(x, y)f (y)dy, Ã(x, y) =     e
0                                2
(21.52)                                                    �
1
(ey−x − ex−y ) x ≥ y
�
u� (x) =          A� (x, y)f (y)dy, A� (x, y) = 2
(0,2π)                                 0                  x ≤ y.
Here A� is continuous since Ã vanishes at x = y where there might other­
wise be a discontinuity. This is the only solution which vanishes with its
derivative at 0. If it is to extend to be periodic we need to add a solution
of the homogeneous equation and arrange that
du       du
(21.53)          u = u� + u�� , u�� = cex + de−x , u(0) = u(2π),         (0) =    (2π).
dx       dx
So, computing away we see that
(21.54)
� 2π                                             � 2π
1 � y−2π                du�                       1 � y−2π
u� (2π) =                   − e2π−y f (y),                                    + e2π−y f (y).
�                                                 �
e                        (2π) = −                 e
0     2                       dx                 0      2
Thus there is a unique solution to (21.53) which must satify
(21.55)
du�
c(e2π − 1) + d(e−2π − 1) = −u� (2π), c(e2π − 1) − d(e−2π − 1) = −        (2π)
dx
� 2π                                   � 2π
1                                      1
(e2π − 1)c =                 f (y), (e−2π − 1)d = −
� 2π−y �                               � y−2π �
e                                      e       f (y).
2 0                                    2 0
Putting this together we get the solution in the desired form:
(21.56)
1 e2π−y+x   1 e−2π+y−x
�
u(x) =              A(x, y)f (y), A(x, y) = A� (x, y) +             −            =⇒
(0.2π)                                         2 e2π − 1   2 e−2π − 1
cosh(|x − y| − π)
A(x, y) =                     .
eπ − e−π
(3) Check, either directly or indirectly, that A(y, x) = A(x, y) and that A is
real.
Solution: Clear from (21.56).
(4) Conclude that the operator S extends by continuity to a bounded operator
on L2 (S).                         √
Solution. We know that �S� ≤ 2π sup |A|.
(5) Check, probably indirectly rather than directly, that
(21.57)                       S(eikx ) = (k 2 + 1)−1 eikx , k ∈ Z.
Solution. We know that Sf is the unique solution with periodic bound­
ary conditions and eikx satisﬁes the boundary conditions and the equation
with f = (k 2 + 1)eikx .
(6) Conclude, either from the previous result or otherwise that S is a compact
self-adjoint operator on L2 (S).
Soluion: Self-adjointness
√        and compactness follows from (21.57) since we
know that the eikx / 2π form an orthonormal basis, so the eigenvalues of S
tend to 0. (Myabe better to say it is approximable by ﬁnite rank operators
by truncating the sum).
(7) Show that if g ∈ C 0 (S)) then Sg is twice continuously diﬀerentiable. Hint:
Proceed directly by diﬀerentiating the integral.
Solution: Clearly Sf is continuous. Going back to the formula in terms
of u� + u�� we see that both terms are twice continuously diﬀerentiable.
(8) From (21.57) conclude that S = F 2 where F is also a compact self-adjoint
1
operator on L2 (S) with eigenvalues (k 2 + 1)− 2 .
1
Solution: Deﬁne F (eikx ) = (k 2 + 1)− 2 eikx . Same argument as above
applies to show this is compact and self-adjoint.
(9) Show that F : L2 (S) −→ C 0 (S).
Solution. The series for Sf
1 � 2            1
(21.58)               Sf (x) =         (2k + 1)− 2 (f, eikx )eikx
2π
k
converges absolutely and uniformly, using Cauchy’s inequality – for instance
it is Cauchy in the supremum norm:
1
�
(21.59)              �      (2k 2 + 1)− 2 (f, eikx )eikx | ≤ ��f �L2
|k|>p
for p large since the sum of the squares of the eigenvalues is ﬁnite.
(10) Now, going back to the real equation (21.45), we assume that V is contin­
uous, real-valued and 2π-periodic. Show that if u is a twice-diﬀerentiable
2π-periodic function satisfying (21.45) for a given f ∈ C 0 (S) then
(21.60)         u + S((V − 1)u) = Sf and hence u = −F 2 ((V − 1)u) + F 2 f
and hence conclude that
(21.61)           u = F v where v ∈ L2 (S) satisﬁes v + (F (V − 1)F )v = F f
where V − 1 is the operator deﬁned by multiplication by V − 1.
Solution: If u satisﬁes (21.45) then
d2 u(x)
(21.62)               −           + u(x) = −(V (x) − 1)u(x) + f (x)
dx2
so by the uniquenss of the solution with periodic boundary conditions,
u = −S(V − 1)u + Sf so u = F (−F (V − 1)u + F f ). Thus indeed u = F v
with v = −F (V − 1)u + F f which means that v satisﬁes
(21.63)                           v + F (V − 1)F v = F f.
(11) Show the converse, that if v ∈ L2 (S) satisﬁes
(21.64)                    v + (F (V − 1)F )v = F f, f ∈ C 0 (S)
then u = F v is 2π-periodic and twice-diﬀerentiable on R and satisﬁes
(21.45).
Solution. If v ∈ L2 (0, 2π) satisﬁes (21.64) then u = F v ∈ C 0 (S) satisﬁes
u+F 2 (V −1)u = F 2 f and since F 2 = S maps C 0 (S) into twice continuously
diﬀerentiable functions it follows that u satisﬁes (21.45).
(12) Apply the Spectral theorem to F (V − 1)F (including why it applies) and
show that there is a sequence λj in R \\ {0} with |λj | → 0 such that for all
λ ∈ C \\ {0}, the equation
(21.65)                     λv + (F (V − 1)F )v = g, g ∈ L2 (S)
has a unique solution for every g ∈ L2 (S) if and only if λ =
� λj for any j.
Solution: We know that F (V − 1)F is self-adjoint and compact so
L2 (0.2π) has an orthonormal basis of eigenfunctions of −F (V − 1)F with
eigenvalues λj . This sequence tends to zero and (21.65), for given λ ∈
C \\ {0}, if and only if has a solution if and only if it is an isomorphism,
meaning λ = � λj is not an eigenvalue of −F (V − 1)F.
(13) Show that for the λj the solutions of
(21.66)                     λj v + (F (V − 1)F )v = 0, v ∈ L2 (S),
are all continuous 2π-periodic functions on R.
� 0 then v = −F (V − 1)F/λj ∈
Solution: If v satisﬁes (21.66) with λj =
C 0 (S).
(14) Show that the corresponding functions u = F v where v satisﬁes (21.66) are
all twice continuously diﬀerentiable, 2π-periodic functions on R satisfying
d2 u
(21.67)             −    + (1 − sj + sj V (x))u(x) = 0, sj = 1/λj .
dx2
Solution: Then u = F v satisﬁes u = −S(V − 1)u/λj so is twice contin­
uously diﬀerentiable and satisﬁes (21.67).
(15) Conversely, show that if u is a twice continuously diﬀerentiable, 2π-periodic
function satisfying
d2 u
(21.68)                 −   + (1 − s + sV (x))u(x) = 0, s ∈ C,
dx2
and u is not identically 0 then s = sj for some j.
Solution: From the uniquess of periodic solutions u = −S(V − 1)u/λj
as before.
(16) Finally, conclude that Fredholm’s alternative holds for the equation (21.45)
Theorem 16. For a given real-valued, continuous 2π-periodic function V
on R, either (21.45) has a unique twice continuously diﬀerentiable, 2π­
periodic, solution for each f which is continuous and 2π-periodic or else
there exists a ﬁnite, but positive, dimensional space of twice continuously
diﬀerentiable 2π-periodic solutions to the homogeneous equation
d2 w(x)
(21.69)                     −        + V (x)w(x) = 0, x ∈ R,
dx2
�
and (21.45) has a solution if and only if (0,2π) f w = 0 for every 2π-periodic
solution, w, to (21.69).
Solution: This corresponds to the special case λj = 1 above. If λj is not an
eigenvalue of −F (V − 1)F then
(21.70)                            v + F (V − 1)F v = F f
has a unque solution for all f, otherwise the necessary and suﬃcient condition is
that (v, F f ) = 0 for all v � satisfying v � + F (V − 1)F v � = 0. Correspondingly either
(21.45) has a unique solution for all f or the necessary and suﬃcient condition is
that (F v � , f ) = 0 for all w = F v � (remember that F is injetive) satisfying (21.69).
Not to be handed in, just for the enthusiastic
Check that we really can understand all the 2π periodic eigenfunctions of the
Schrödinger operator using the discussion above. First of all, there was nothing
sacred about the addition of 1 to −d2 /dx2 , we could add any positive number
and get a similar result – the problem with 0 is that the constants satisfy the
homogeneous equation d2 u/dx2 = 0. What we have shown is that the operator
d2 u
(21.71)                       u �−→ Qu = −        u+Vu
dx2
applied to twice continuously diﬀerentiable functions has at least a left inverse
unless there is a non-trivial solution of
d2 u
(21.72)                           − 2 u + V u = 0.
dx
Namely, the left inverse is R = F (Id +F (V −1)F )−1 F. This is a compact self-adjoint
operator. Show – and there is still a bit of work to do – that (twice continuously
diﬀerentiable) eigenfunctions of Q, meaning solutions of Qu = τ u are precisely the
non-trivial solutions of Ru = τ −1 u.
What to do in case (21.72) does have a non-trivial solution? Show that the space
of these is ﬁnite dimensional and conclude that essentially the same result holds by
working on the orthocomplement in L2 (S).', 'source' => 'MIT OpenCourseWare, 18.102 Introduction To Functional Analysis, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.102 — question d’examen, en anglais] PROBLEM SET 3 FOR 18.102, SPRING 2009 DUE 11AM TUESDAY 3 MAR. RICHARD MELROSE This problem set is also intended to be a guide to what will be on the in-class test on March 5. In particular I will ask you to prove some of the properties of the Lebesgue integral, as below, plus one more abstract proof. Recall that equality a.e (almost everywhere) means equality on the complement of a set of measure zero. 1. Problem 3.1 If f and g ∈ L1 (R) are Lebesgue integrable functions on the line show that � (1) If f (x) ≥ 0 a.e. then f �≥ 0. � (2) If f (x) ≤ g(x) a.e. then f ≤ g. (3) If� f is complex �     valued then its real part, Re f, is Lebesgue integrable and | Re f | ≤ |f |. (4) For a general
PROBLEM SET 3 FOR 18.102, SPRING 2009
DUE 11AM TUESDAY 3 MAR.
RICHARD MELROSE
This problem set is also intended to be a guide to what will be on the in-class
test on March 5. In particular I will ask you to prove some of the properties of the
Lebesgue integral, as below, plus one more abstract proof. Recall that equality a.e
(almost everywhere) means equality on the complement of a set of measure zero.
1. Problem 3.1
If f and g ∈ L1 (R) are Lebesgue integrable functions on the line show that
�
(1) If f (x) ≥ 0 a.e. then f �≥ 0. �
(2) If f (x) ≤ g(x) a.e. then f ≤ g.
(3) If� f is complex
�     valued then its real part, Re f, is Lebesgue integrable and
| Re f | ≤ |f |.
(4) For a general complex-valued Lebesgue integrable function
�       �
(1)                                 | f | ≤ |f |.
Hint: You can look up a proof� of this
� easily enough, but the usual trick is to
choose θ ∈ [0, 2π) so that eiθ f = (eiθ f ) ≥ 0. Then apply the preceeding
estimate to g = eiθ f.
(5) Show that the integral is a continuous linear functional
�
(2)                                  : L1 (R) −→ C.
2. Problem 3.2
If I ⊂ R is an interval, including possibly (−∞, a) or (a, ∞), we deﬁne Lebesgue
integrability of a function f : I −→ C to mean the Lebesgue integrability of
�
f (x) x ∈ I
(1)                    f˜ : R −→ C, f˜(x) =
0     x ∈ R \\ I.
The integral of f on I is then deﬁned to be
�      �
(2)                                   f = f˜.
I
(1) Show that the space of such integrable functions on I is linear, denote it
L1 (I).
(2) Show that is f is integrable on I then� so is |f |.
(3) Show that if f is integrable on I and I |f | = 0 then f = 0 a.e. in the sense
that f (x) = 0 for all x ∈ I \\ E where E ⊂ I is of measure zero as a subset
of R.
1
2                                   RICHARD MELROSE
(4) Show that the set of null functions as in the preceeding question is a linear
� it N (I).
space, denote
(5) Show that I |f | deﬁnes a norm on L1 (I) = L1 (I)/N (I).
(6) Show that if f ∈ L1 (R) then
�
f (x) x ∈ I
(3)                   g : I −→ C, g(x) =
0      x∈R\\I
is integrable on I.
(7) Show that the preceeding construction gives a surjective and continuous
linear map ‘restriction to I’
(4)                                 L1 (R) −→ L1 (I).
(Notice that these are the quotient spaces of integrable functions modulo
equality a.e.)
3. Problem 3.3
Really continuing the previous one.
(1) Show that if I = [a, b) and f ∈ L1 (I) then the restriction of f to Ix = [x, b)
is an element of L1 (Ix ) for all a ≤ x < b.
(2) Show that the function
�
(1)                          F (x) =       f : [a, b) −→ C
Ix
is continuous.
(3) Prove that the function x−1 cos(1/x) is not Lebesgue integrable on the
interval (0, 1]. Hint: Think about it a bit and use what you have shown
above.
4. Problem 3.4
[Harder but still doable] Suppose f ∈ L1 (R).
(1) Show that for each t ∈ R the translates
(1)                            ft (x) = f (x − t) : R −→ C
are elements of L1 (R).
(2) Show that
�
(2)                                 lim        |ft − f | = 0.
t→0
This is called ‘Continuity in the mean for integrable functions’. Hint: I will
add one!
(3) Conclude that for each f ∈ L1 (R) the map (it is a ‘curve’)
(3)                              R � t �−→ [ft ] ∈ L1 (R)
is continuous.
PROBLEMS 3                                    3
5. Problem 3.5
In the last problem set you showed that a continuous function on a compact
interval, extended to be zero outside, is Lebesgue integrable. Using this, and the
fact that step functions are dense in L1 (R) show that the linear space of continuous
functions on R each of which vanishes outside a compact set (which depends on the
function) form a dense subset of L1 (R).
6. Problem 3.6
(1) If g : R −→ C is bounded and continuous and f ∈ L1 (R) show that
gf ∈ L1 (R) and that
�                  �
(1)                            |gf | ≤ sup |g| · |f |.
R
(2) Suppose now that G ∈ C([0, 1] × [0, 1]) is a continuous function (I use C(K)
to denote the continuous functions on a compact metric space). Recall from
the preceeding discussion that we have deﬁned L1 ([0, 1]). Now, using the
ﬁrst part show that if f ∈ L1 ([0, 1]) then
�
(2)                         F (x) =       G(x, ·)f (·) ∈ C
[0,1]
(where · is the variable in which the integral is taken) is well-deﬁned for
each x ∈ [0, 1].
(3) Show that for each f ∈ L1 ([0, 1]), F is a continuous function on [0, 1].
(4) Show that
(3)                         L1 ([0, 1]) � f �−→ F ∈ C([0, 1])
is a bounded (i.e. continuous) linear map into the Banach space of contin­
uous functions, with supremum norm, on [0, 1].
Department of Mathematics, Massachusetts Institute of Technology', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : PROBLEM SET 3 FOR 18.102, SPRING 2009
MY SOLUTIONS.
RICHARD MELROSE
This problem set is also intended to be a guide to what will be on the in-class
test on March 5. In particular I will ask you to prove some of the properties of the
Lebesgue integral, as below, plus one more abstract proof. Recall that equality a.e
(almost everywhere) means equality on the complement of a set of measure zero.
1. Problem 3.1
If f and g ∈ L1 (R) are Lebesgue integrable functions on the line show that
�
(1) If f (x) ≥ 0 a.e. then f �≥ 0. �
(2) If f (x) ≤ g(x) a.e. then f ≤ g.
(3) If� f is complex
�     valued then its real part, Re f, is Lebesgue integrable and
| Re f | ≤ |f |.
(4) For a general complex-valued Lebesgue integrable function
�       �
(1)                                 | f | ≤ |f |.
Hint: You can look up a proof� of this
� easily enough, but the usual trick is to
choose θ ∈ [0, 2π) so that eiθ f = (eiθ f ) ≥ 0. Then apply the preceeding
estimate to g = eiθ f.
(5) Show that the integral is a continuous linear functional
�
(2)                                  : L1 (R) −→ C.
Solution:
(1) If f is real and fn is a real-valued absolutely summable series of step func­
tions converging to f where it is absolutely convergent (if we only have a
complex-valued sequence use part (3)). Then we know that
(3)                      g1 = |f1 |, gj = |fj | − |fj−1 |, f ≥ 1
is an absolutely convergent sequence converging to |f | almost everywhere.
It follows that f+ = 12 (|f | + f ) = f, if f ≥ 0, is the limit almost everywhere
of the series obtained by interlacing 12 gj and 12 fj :
�
1
gk n = 2k − 1
(4)                           hn = 2
fk    n = 2k.
Thus f+ is Lebesgue integrable. Moreover we know that
⎛                  ⎞
�             � �              �    �k         k
�
(5)             f+ = lim          hk = lim    ⎝|     fj | +   fj ⎠
k→∞                 k→∞
n≤2k                      j=1         j=1
�
where each term is a non-negative step function, so            f+ ≥ 0.
1
2                                   RICHARD MELROSE
(2) Apply the preceeding result to g − f which is integrable and satisﬁes
�      �       �
(6)                          g − f = (g − f ) ≥ 0.
(3) Arguing from ﬁrst principles again, if fn is now complex valued and an
absolutely summable series of step functions converging a.e. to f then deﬁne
⎧
⎨Re fk
⎪            n = 3k − 2
(7)                      hn = Im fk          n = 3k − 1
⎪
− Im fk n = 3k.
⎩
This series of step functions is absolutely summable and
�                      �                    �
(8)                |hn (x)| < ∞ ⇐⇒        |fn (x)| < ∞ =⇒    hn (x) = Re f.
n                      n                       n
Thus Re f is integrable. Since ± Re f ≤ |f |
�         �           �       �
(9)                      ± Re f ≤ |f | =⇒ | Re f | ≤ |f |.
(4) For a complex-valued
�         f proceed as suggested. Choose z ∈ C with |z | = 1
such that z f ∈ [0, ∞) which is possible by the properties of complex
numbers. Then by the linearity of the integral
(10)�      �        �           �             �        �       �      �
z     f=     (zf ) =   Re(zf ) ≤       |z Re f | ≤   |f | =⇒ |   f| = z   f≤   |f |.
(where the second equality follows from the fact that the integral is equal
to its real part).
(5) We know that the integral deﬁnes a linear map
�
(11)                       I : L1 (R) � [f ] �−→ f ∈ C
�      �
since f = g if f = g a.e. are two representatives of the same class in
L1 (R). To say this is continuous is equivalent to it being bounded, which
follows from the preceeding estimate
�      �
(12)                        |I([f ])| = | f | ≤ |f | = �[f ]�L1
(Note that writing [f ] instead of f ∈ L1 (R) is correct but would normally
be considered pedantic – at least after you are used to it!)
(6) I should have asked – and might do on the test: What is the norm of I as
an element of the dual space of L1 (R). It is 1 – better make sure that you
can prove this.
2. Problem 3.2
If I ⊂ R is an interval, including possibly (−∞, a) or (a, ∞), we deﬁne Lebesgue
integrability of a function f : I −→ C to mean the Lebesgue integrability of
�
˜              ˜        f (x) x ∈ I
(1)                    f : R −→ C, f (x) =
0     x ∈ R \\ I.
PROBLEMS 3, SOLVED                                    3
The integral of f on I is then deﬁned to be
�      �
(2)                                   f = f˜.
I
(1) Show that the space of such integrable functions on I is linear, denote it
L1 (I).
(2) Show that is f is integrable on I then� so is |f |.
(3) Show that if f is integrable on I and I |f | = 0 then f = 0 a.e. in the sense
that f (x) = 0 for all x ∈ I \\ E where E ⊂ I is of measure zero as a subset
of R.
(4) Show that the set of null functions as in the preceeding question is a linear
� it N (I).
space, denote
(5) Show that I |f | deﬁnes a norm on L1 (I) = L1 (I)/N (I).
(6) Show that if f ∈ L1 (R) then
�
f (x) x ∈ I
(3)                    g : I −→ C, g(x) =
0       x∈R\\I
is in L1 (R) an hence that f is integrable on I.
(7) Show that the preceeding construction gives a surjective and continuous
linear map ‘restriction to I’
(4)                               L1 (R) −→ L1 (I).
(Notice that these are the quotient spaces of integrable functions modulo
equality a.e.)
Solution:
(1) If f and g are both integrable on I then setting h = f + g, h̃ = f˜ + g̃,
directly from the deﬁnitions, so f + g is integrable on I if f and g are by
the linearity of L1 (R). Similarly if h = cf then h̃ = cf˜ is integrable for any
constant c if f˜ is integrable. Thus L1 (I) is linear.
(2) Again from the deﬁnition, |f˜| = h̃ if h = |f |. Thus f integrable on I
implies f˜ ∈ L1 (R), which, as we know, implies that |f˜| ∈ L1 (R). So in turn
h̃ ∈ L1 (R) where h� = |f |, so |f | ∈ L 1
(I).
(3) If f ∈ L (I) and I |f | = 0 then R |f˜| = 0 which implies that f˜ = 0 on
1
�
R \\ E where E ⊂ R is of measure zero. Now, EI = E ∩ I ⊂ E is also of
measure zero (as a subset of a set of measure zero) and f vanishes outside
EI .
(4) If f, g : I −→ C are both of measure zero in this sense then f + g vanishes
on I \\ (Ef ∪ Eg ) where Ef ⊂ I and Ef ⊂ I are of measure zero. The union
of two sets of measure zero (in R) is of measure zero so this shows f + g is
null. The same is true of cf + dg for constant c and d, so N (I) is a linear
space.
(5) If f ∈ L1 (I) and g ∈ N (I) then |f + g| − |f | ∈ N (I), since it vanishes where
g vanishes. Thus
�            �
(5)                      |f + g| = |f | ∀ f ∈ L1 (I), g ∈ N (I).
I            I
Thus
�
(6)                                 �[f ]�I =           |f |
I
4                                  RICHARD MELROSE
is a well-deﬁned function on L1 (I) = L1 (R)/N (I) since it is constant on
equivalence classes. Now, the norm properties follow from the same prop­
erties on the whole of R.
(6) Suppose f ∈ L1 (R) and g is deﬁned in (3) above by restriction to I. We
need to show that g ∈ L1 (R). If fn is an absolutely summable series of step
functions converging to f wherever, on R, it converges absolutely consider
�
fn (x) on I˜
(7)                         gn (x) =
0        on R \\ I˜
where I˜ is I made half-open if it isn’t already – by adding the lower end­
point (if there is one) and removing the upper end-point (if there�is one).
Then
�       gn is a step function (which is why we need I˜). Moreover, |gn | ≤
|fn | so the series gn is absolutely summable and converges to gn outside
I and at all points inside I where the series is absolutely convergent (since
it is then the same as fn ). Thus g is integrable, and since f˜ diﬀers from g
by its values at two points, at most, it too is integrable so f is integrable
on I by deﬁnition.
(7) First we check we do have a map. Namely if f ∈ N (R) then g in (3) is
certainly an element of N (I). We have already seen that ‘restriction to I’
maps L1 (R) into L1 (I) and since this is clearly a linear map it deﬁnes (4)
– the image only depends on the equivalence class of f. It is clearly linear
and to see that it is surjective observe that if g ∈ L1 (I) then extending it
as zero outside I gives an element of L1 (R) and the class of this function
maps to [g] under (4).
3. Problem 3.3
Really continuing the previous one.
(1) Show that if I = [a, b) and f ∈ L1 (I) then the restriction of f to Ix = [x, b)
is an element of L1 (Ix ) for all a ≤ x < b.
(2) Show that the function
�
(1)                          F (x) =       f : [a, b) −→ C
Ix
is continuous.
(3) Prove that the function x−1 cos(1/x) is not Lebesgue integrable on the
interval (0, 1]. Hint: Think about it a bit and use what you have shown
above.
Solution:
(1) This follows from the previous question. If f ∈ L1 ([a, b)) with f � a rep­
resentative then extending f � as zero outside the interval gives an element
of L1 (R), by deﬁntion. As an element of L1 (R) this does not depend on
the choice of f � and then (4) gives the restriction to [x, b) as an element of
L1 ([x, b)). This is a linear map.
(2) Using the discussion in the preceeding question, we now that if fn is an
absolutely summable series converging to f � (a representative of f ) where
it converges absolutely, then for any a ≤ x ≤ b, we can deﬁne
(2)                        fn� = χ([a, x))fn , fn�� = χ([x, b))fn
PROBLEMS 3, SOLVED                                                5
where χ([a, b)) is the characteristic function of the interval. It follows that
fn� converges to f χ([a, x)) and fn�� to f χ([x, b)) where they converge abso­
lutely. Thus
�         �                ��          �          �              ��
��
(3)           f = f χ([x, b)) =          fn ,        f = f χ([a, x)) =          fn� .
[x,b)                        n                   [a,x)                                     n
fn� +       fn�� so
�           �           �
Now, for step functions, we know that fn =
�        �        �
(4)                                f=       f+      f
[a,b)            [a,x)               [x,b)
as we have every right to expect. Thus it suﬃces to show (by moving the
end point from a to a general point) that
�
(5)                                 lim      f =0
x→ a   [a,x)
for any f integrable on [a, b). Thus can be seen in terms of a deﬁning
absolutely summable sequence of step functions using the usual estimate
that
�       �        �         ��
(6)                   |    f| ≤        |    fn | +        |fn |.
[a,x)          [a,x) n≤N                      n>N     [a,x)
The last sum can be made small, independent of x, by choosing N large
enough. On the other hand as x → a the ﬁrst integral, for ﬁxed N, tends
to zero by the deﬁnition for step functions. This proves (6) and hence the
continuity of F.
(3) If the function x−1 cos(1/x) were Lebesgue integrable on the interval (0, 1]
(on which it is deﬁned) then it would be integrable on [0, 1) if we deﬁne it
arbitrarily, say to be 0, at 0. The same would be true of the absolute value
and Riemann integration shows us easily that
� 1
(7)                          lim     x| cos(1/x)|dx = ∞.
t↓0    t
This is contrary to the continuity of the integral as a function of the limits
just shown.
4. Problem 3.4
[Harder but still doable] Suppose f ∈ L1 (R).
(1) Show that for each t ∈ R the translates
(1)                             ft (x) = f (x − t) : R −→ C
1
are elements of L (R).
(2) Show that
�
(2)                                   lim         |ft − f | = 0.
t→0
This is called ‘Continuity in the mean for integrable functions’. Hint: I will
add one!
6                                     RICHARD MELROSE
(3) Conclude that for each f ∈ L1 (R) the map (it is a ‘curve’)
(3)                                 R � t �−→ [ft ] ∈ L1 (R)
is continuous.
Solution:
(1) If fn is an absolutely summable series of step functions converging to f
where it converges absolutely then fn (· − t) is such a series converging to
f (· − t) for each t ∈ R. Thus, each of the f (x − t) is Lebesgue integrable,
i.e. are elements of L1 (R)
(2) Now, we know that if fn is a series converging to f as above then
�        ��
(4)                                 |f | ≤      |fn |.
n
We can sum the ﬁrst terms and then start the series again and so it follows
that for any N,
�       � �           ��
(5)                         |f | ≤ |     fn | +       |fn |.
n≤N         n>N
Applying this to the series fn (· − t) − fn (·) we ﬁnd that
�              � �                            ��
(6)           |ft − f | ≤ |      fn (· − t) − fn (·)| +        |fn (· − t) − fn (·)|
n≤N                         n>N
� �
The second sum here is bounded by 2               |fn |. Given δ > 0 we can choose
n>N
N so large that this sum is bounded by δ/2, by the absolute convergence.
So the result is reduce to proving that if |t| is small enough then
� �
(7)                            |     fn (· − t) − fn (·)| ≤ δ/2.
n≤N
This however is a ﬁnite sum of step functions. So it suﬃces to show that
�
(8)                        | g(· − t) − g(·)| → 0 as t → 0
for each component, i.e. a constant, c, times the characteristic function of
an interval [a, b) where it is bounded by 2|c||t|.
(3) For the ‘curve’ ft which is a map
(9)                                 R � t �−→ ft ∈ L1 (R)
it follows that ft+s = (ft )s so we can apply the argument above to show
that for each s,
�
(10)                  lim |ft − fs | = 0 =⇒ lim �[ft ] − [fs ]�L1 = 0
t→s                       t→s
which proves continuity of the map (9).
PROBLEMS 3, SOLVED                                 7
5. Problem 3.5
In the last problem set you showed that a continuous function on a compact
interval, extended to be zero outside, is Lebesgue integrable. Using this, and the
fact that step functions are dense in L1 (R) show that the linear space of continuous
functions on R each of which vanishes outside a compact set (which depends on the
function) form a dense subset of L1 (R).
Solution: Since we know that step functions (really of course the equivalence
classes of step functions) are dense in L1 (R) we only need to show that any step
function is the limit of a sequence of continuous functions each vanishing outside a
compact set, with respect to L1 . So, it suﬃces to prove this for the charactertistic
function of an interval [a, b) and then multiply by constants and add. The sequence
⎧
⎪
⎪
⎪ 0                x < a − 1/n
⎨n(x − a + 1/n) a − 1/n ≤ x ≤ a
⎪
⎪
⎪
(1)                 gn (x) = 0                   a<x<b
⎪
n(b + 1/n − x) b ≤ x ≤ b + 1/n
⎪
⎪
⎪
⎪
⎪
⎩0                 x > b + 1/n
is clearly continuous and vanishes outside a compact set. Since
�                    � 1       � b+1/n
(2)                 |gn − χ([a, b))| =      gn +         gn ≤ 2/n
a−1/n        b
1
it follows that [gn ] → [χ([a, b))] in L (R). This proves the density of continuous
functions with compact support in L1 (R).
6. Problem 3.6
(1) If g : R −→ C is bounded and continuous and f ∈ L1 (R) show that
gf ∈ L1 (R) and that
�                   �
(1)                            |gf | ≤ sup |g | · |f |.
R
(2) Suppose now that G ∈ C([0, 1] × [0, 1]) is a continuous function (I use C(K)
to denote the continuous functions on a compact metric space). Recall from
the preceeding discussion that we have deﬁned L1 ([0, 1]). Now, using the
ﬁrst part show that if f ∈ L1 ([0, 1]) then
�
(2)                         F (x) =       G(x, ·)f (·) ∈ C
[0,1]
(where · is the variable in which the integral is taken) is well-deﬁned for
each x ∈ [0, 1].
(3) Show that for each f ∈ L1 ([0, 1]), F is a continuous function on [0, 1].
(4) Show that
(3)                         L1 ([0, 1]) � f �−→ F ∈ C([0, 1])
is a bounded (i.e. continuous) linear map into the Banach space of contin­
uous functions, with supremum norm, on [0, 1].
Solution:
8                                            RICHARD MELROSE
(1) Let’s ﬁrst assume that f = 0 outside [−1, 1]. Applying a result form Prob­
lem set there exists a sequence of step functions gn such that for any R,
gn → g uniformly on [0, 1). By passing to a subsequence we can arrange
that sup[−1,1] |gn (x) − gn−1 (x)| < 2−n . If fn is an absolutly summable se­
ries of step functions converging a.e. to f we can replace it by fn χ([−1, 1])
as discussed above, and still have the same conclusion. Thus, from the
uniform convergence of gn ,
n
�
(4)                         gn (x)           fk (x) → g(x)f (x) a.e. on R.
k=1
n
�                          −1
n�
So deﬁne h1 = g1 f1 , hn = gn (x)                        fk (x) − gn−1 (x)         fk (x). This series
k=1                       k=1
of step functions converges to gf (x) almost everywhere and since
(5)
�                 ��                      ��                  ��
−n
|hn | ≤ A|fn (x)| + 2              |fk (x)|,               |hn | ≤ A           |fn | + 2           |fn | < ∞
k<n                  n                        n                n
it is absolutely summable. Here A is a bound for |gn | independent of n.
Thus gf ∈ L1 (R) under the assumption that f = 0 outside [0, 1) and
�                 �
(6)                                |gf | ≤ sup |g| |f |
follows from the limiting argument. Now we can apply this argument to fp
which is the restriction of p to the interval [p, p + 1), for each p ∈ Z. Then
we get gf as the limit a.e. of the absolutely summable series gfp where (6)
provides the absolute summablitly since
��                      ��
(7)                            |gfp | ≤ sup |g|            |f | < ∞.
p                                 p     [p,p+1)
Thus, gf ∈ L1 (R) by a theorem in class and
�                 �
(8)                                |gf | ≤ sup |g| |f |.
(2) If f ∈ L1 [(0, 1]) has a representative f � then G(x, ·)f � (·) ∈ L1 ([0, 1)) so
�
(9)                           F (x) =      G(x, ·)f (·) ∈ C
[0,1]
is well-deﬁned, since it is indpendent of the choice of f � , changing by a null
function if f � is changed by a null function.
(3) Now by the uniform continuity of continuous functions on a compact metric
space such as S = [0, 1] × [0, 1] given δ > 0 there exist � > 0 such that
(10)                    sup |G(x, y) − G(x� , y)| < δ if |x − x� | < �.
y∈[0,1]
Then if |x − x� | < �,
�                                            �
(11)            |F (x) − F (x� )| = |                 (G(x, ·) − G(x� , ·))f (·)| ≤ δ          |f |.
[0,1]
PROBLEMS 3, SOLVED                                    9
Thus F ∈ C([0, 1]) is a continuous function on [0, 1]. Moreover the map
f �−→ F is linear and
�
(12)                       sup |F | ≤ sup |G|   ||f |
[0,1]      S      [0,1]
which is the desired boundedness, or continuity, of the map
�
(13) I : L1 ([0, 1]) −→ C([0, 1]), F (f )(x) = G(x, ·)f (·),
�I(f )�sup ≤ sup |G|�f �L1 .
Department of Mathematics, Massachusetts Institute of Technology', 'source' => 'MIT OpenCourseWare, 18.102 Introduction To Functional Analysis, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.102 — question d’examen, en anglais] PROBLEM SET 10 (AND LAST) FOR 18.102, SPRING 2009 DUE 11AM TUESDAY 5 MAY. RICHARD MELROSE By now you should have become reasonably comfortable with a separable Hilbert space such as l2 . However, it is worthwhile checking once again that it is rather large – if you like, let me try to make you uncomfortable for one last time. An important result in this direction is Kuiper’s theorem, which I will not ask you to prove1. However, I want you to go through the closely related result sometimes known as Eilenberg’s swindle. Perhaps you will appreciate the little bit of trickery. First some preliminary results. Note that everything below is a closed curve in the x ∈ [0, 1] variable – you might
PROBLEM SET 10 (AND LAST) FOR 18.102, SPRING 2009
DUE 11AM TUESDAY 5 MAY.
RICHARD MELROSE
By now you should have become reasonably comfortable with a separable Hilbert
space such as l2 . However, it is worthwhile checking once again that it is rather large
– if you like, let me try to make you uncomfortable for one last time. An important
result in this direction is Kuiper’s theorem, which I will not ask you to prove1.
However, I want you to go through the closely related result sometimes known as
Eilenberg’s swindle. Perhaps you will appreciate the little bit of trickery. First some
preliminary results. Note that everything below is a closed curve in the x ∈ [0, 1]
variable – you might want to identify this with a circle instead, I just did it the
primitive way.
Problem P10.1
Let H be a separable, inﬁnite dimensional Hilbert space. Show that the direct
sum of two copies of H is a Hilbert space with the norm
1
(P10.1)                 H ⊕ H � (u1 , u2 ) �−→ (�u1 �2H + �u2 �2H ) 2
either by constructing an isometric isomorphism
(P10.2)          T : H −→ H ⊕ H, 1-1 and onto, �u�H = �T u�H⊕H
or otherwise. In any case, construct a map as in (P10.2).
Problem P10.2
One can repeat the preceding construction any ﬁnite number of times. Show
that it can be done ‘countably often’ in the sense that if H is a separable, inﬁnite
dimensional, Hilbert space then
�
(P10.3)         l2 (H) = {u : N −→ H; �u�2l2 (H) =    �ui �2H < ∞}
i
has a Hilbert space structure and construct an explicit isometric isomorphism from
l2 (H) to H.
1Kuiper’s theorem says that for any (norm) continuous map, say from any compact metric
space, g : M −→ GL(H) with values in the invertible operators on a separable inﬁnite-dimensional
Hilbert space there exists a continuous map, an homotopy, h : M × [0, 1] −→ GL(H) such that
h(m, 0) = g(m) and h(m, 1) = IdH for all m ∈ M.
1
2                                      RICHARD MELROSE
Problem P10.3
Recall, or perhaps learn about, the winding number of a closed curve with values
in C∗ = C\\{0}. We take as given the following fact:2 If Q = [0, 1]N and f : Q −→ C∗
is continuous then for each choice of b ∈ C satisfying exp(2πib) = f (0), there exists
a unique continuous function F : Q −→ C satisfying
(P10.4)                exp(2πiF (q)) = f (q), ∀ q ∈ Q and F (0) = b.
Of course, you are free to change b to b + n for any n ∈ Z but then F changes to
F + n, just shifting by the same integer.
(1) Now, suppose c : [0, 1] −→ C∗ is a closed curve – meaning it is continuous
and c(1) = c(0). Let C : [0, 1] −→ C be a choice of F for N = 1 and
f = c. Show that the winding number of the closed curve c may be deﬁned
unambiguously as
(P10.5)                            wn(c) = F (1) − F (0) ∈ Z.
(2) Show that wn(c) is constant under homotopy. That is if ci : [0, 1] −→ C∗ ,
i = 1, 2, are two closed curves so ci (1) = ci (0), i = 1, 2, which are homotopic
through closed curves in the sense that there exists f : [0, 1]2 −→ C∗
continuous and such that f (0, x) = c1 (x), f (1, x) = c2 (x) for all x ∈ [0, 1]
and f (y, 0) = f (y, 1) for all y ∈ [0, 1], then wn(c1 ) = wn(c2 ).
(3) Consider the closed curve Ln : [0, 1] � x �−→ e2πix Idn×n of n × n matrices.
Using the standard properties of the determinant, show that this curve is
not homotopic to the identity through closed curves in the sense that there
does not exist a continuous map G : [0, 1]2 −→ GL(n), with values in the
invertible n × n matrices, such that G(0, x) = Ln (x), G(1, x) ≡ Idn×n for
all x ∈ [0, 1], G(y, 0) = G(y, 1) for all y ∈ [0, 1].
Problem P10.4
Consider the closed curve corresponding to Ln above in the case of a separable
but now inﬁnite dimensional Hilbert space:
(P10.6)                L : [0, 1] � x �−→ e2πix IdH ∈ GL(H) ⊂ B(H)
taking values in the invertible operators on H. Show that after identifying H with
H ⊕ H as above, there is a continuous map
(P10.7)                           M : [0, 1]2 −→ GL(H ⊕ H)
with values in the invertible operators and satisfying
(P10.8)
M (0, x) = L(x), M (1, x)(u1 , u2 ) = (e4πix u1 , u2 ), M (y, 0) = M (y, 1), ∀ x, y ∈ [0, 1].
Hint: So, think of H ⊕ H as being 2-vectors (u1 , u2 ) with entries in H. This allows
one to think of ‘rotation’ between the two factors. Indeed, show that
(P10.9) U (y)(u1 , u2 ) = (cos(πy/2)u1 + sin(πy/2)u2 , − sin(πy/2)u1 + cos(πy/2)u2 )
deﬁnes a continuous map [0, 1] � y �−→ U (y) ∈ GL(H ⊕ H) such that U (0) = Id,
U (1)(u1 , u2 ) = (u2 , −u1 ). Now, consider the 2-parameter family of maps
(P10.10)                             U −1 (y)V2 (x)U (y)V1 (x)
2Of course, you are free to give a proof – it is not hard.
PROBLEMS 10                                            3
where V1 (x) and V2 (x) are deﬁned on H ⊕ H as multiplication by exp(2πix) on the
ﬁrst and the second component respectively, leaving the other ﬁxed.
Problem P10.5
Using a rotation similar to the one in the preceeding problem (or otherwise)
show that there is a continuous map
(P10.11)                       G : [0, 1]2 −→ GL(H ⊕ H)
such that
(P10.12) G(0, x)(u1 , u2 ) = (e2πix u1 , e−2πix u2 ),
G(1, x)(u1 , u2 ) = (u1 , u2 ), G(y, 0) = G(y, 1) ∀ x, y ∈ [0, 1].
Problem P10.6
Now, think about combining the various constructions above in the following way.
Show that on l2 (H) there is an homotopy like (P10.11), G̃ : [0, 1]2 −→ GL(l2 (H)),
(very like in fact) such that
∞                      �∞
(P10.13) G̃(0, x) {uk }k=1 = exp((−1)k 2πix)uk k=1 ,
�
G̃(1, x) = Id, G̃(y, 0) = G̃(y, 1) ∀ x, y ∈ [0, 1].
Problem P10.7: Eilenberg’s swindle
For an inﬁnite dimenisonal separable Hilbert space, construct an homotopy –
meaning a continuous map G : [0, 1]2 −→ GL(H) – with G(0, x) = L(x) in (P10.6)
and G(1, x) = Id and of course G(y, 0) = G(y, 1) for all x, y ∈ [0, 1].
Hint: Just put things together – of course you can rescale the interval at the end
to make it all happen over [0, 1]. First ‘divide H into 2 copies of itself’ and deform
from L to M (1, x) in (P10.8). Now, ‘divide the second H up into l2 (H)’ and apply
an argument just like the preceding problem to turn the identity on this factor into
alternating terms multiplying by exp(±4πix) – starting with −. Now, you are on
H ⊕ l2 (H), ‘renumbering’ allows you to regard this as l2 (H) again and when you
do so your curve has become alternate multiplication by exp(±4πix) (with + ﬁrst).
Finally then, apply the preceding problem again, to deform to the identity (always
of course through closed curves). Presto, Eilenberg’s swindle!
Department of Mathematics, Massachusetts Institute of Technology', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Solutions to Problem set 10
Problem P10.1 Let H be a separable, inﬁnite dimensional Hilbert space. Show
that the direct sum of two copies of H is a Hilbert space with the norm
1
(23.18)               H ⊕ H � (u1 , u2 ) �−→ (�u1 �2H + �u2 �H
2 2
)
either by constructing an isometric isomorphism
(23.19)         T : H −→ H ⊕ H, 1-1 and onto, �u�H = �T u�H⊕H
or otherwise. In any case, construct a map as in (23.19).
Solution: Let {ei }i∈N be an orthonormal basis of H, which exists by virtue of
the fact that it is an inﬁnite-dimensional but separable Hilbert space. Deﬁne the
map
∞
�                ∞
�
(23.20)        T : H � u −→ ( (u, e2i−1 )ei ,   (u, e2i )ei ) ∈ H ⊕ H
i=1                i=1
The convergence of the Fourier Bessel series shows that this map is well-deﬁned
and linear. Injectivity similarly follows from the fact that T u = 0 in the image
implies that (u, ei ) = 0 for all i and hence u = 0. Surjectivity is also clear from the
fact that
�∞
(23.21)        S : H ⊕ H � (u1 , u2 ) �−→      ((u1 , ei )e2i−1 + (u2 , ei )e2i ) ∈ H
i=1
is a 2-sided inverse and Bessel’s identity implies isometry since �S(u1 , u2 )�2 =
�u1 �2 + �u2 �2
Problem P10.2 One can repeat the preceding construction any ﬁnite number
of times. Show that it can be done ‘countably often’ in the sense that if H is a
separable, inﬁnite dimensional, Hilbert space then
�
(23.22)         l2 (H) = {u : N −→ H; �u�2l2 (H) =    �ui �2H < ∞}
i
has a Hilbert space structure and construct an explicit isometric isomorphism from
l2 (H) to H.
Solution: A similar argument as in the previous problem works. Take an orthor­
mal basis ei for H. Then the elements Ei,j ∈ l2 (H), which for each i, i consist of
the sequences with 0 entries except the jth, which is ei , given an orthonromal basis
for l2 (H). Orthormality is clear, since with the inner product is
�
(23.23)                       (u, v)l2 (H) =   (uj , vj )H .
j
Completeness follows from completeness of the orthonormal basis of H since if
v = {vj } (v, Ej,i ) = 0 for all j implies vj = 0 in H. Now, to construct an isometric
isomorphism just choose an isomorphism m : N2 −→ N then
�
(23.24)                    T u = v, vj =      (u, em(i,j) )ei ∈ H.
i
I would expect you to go through the argument to check injectivity, surjectivity
and that the map is isometric.
Problem P10.3 Recall, or perhaps learn about, the winding number of a closed
curve with values in C∗ = C \\ {0}. We take as given the following fact:4 If Q =
[0, 1]N and f : Q −→ C∗ is continuous then for each choice of b ∈ C satisfying
exp(2πib) = f (0), there exists a unique continuous function F : Q −→ C satisfying
(23.25)              exp(2πiF (q)) = f (q), ∀ q ∈ Q and F (0) = b.
Of course, you are free to change b to b + n for any n ∈ Z but then F changes to
F + n, just shifting by the same integer.
(1) Now, suppose c : [0, 1] −→ C∗ is a closed curve – meaning it is continuous
and c(1) = c(0). Let C : [0, 1] −→ C be a choice of F for N = 1 and
f = c. Show that the winding number of the closed curve c may be deﬁned
unambiguously as
(23.26)                             wn(c) = C(1) − C(0) ∈ Z.
�
Solution: Let C , be another choice of F in this case. Now, g(t) =
C � (t) − C(t) is continuous and satisﬁes exp(2πg(t)) = 1 for all t ∈ [0, 1] so
by the uniqueness must be constant, thus C � (1) − C � (0) = C(1) − C(0) and
the winding number is well-deﬁned.
(2) Show that wn(c) is constant under homotopy. That is if ci : [0, 1] −→ C∗ ,
i = 1, 2, are two closed curves so ci (1) = ci (0), i = 1, 2, which are homotopic
through closed curves in the sense that there exists f : [0, 1]2 −→ C∗
continuous and such that f (0, x) = c1 (x), f (1, x) = c2 (x) for all x ∈ [0, 1]
and f (y, 0) = f (y, 1) for all y ∈ [0, 1], then wn(c1 ) = wn(c2 ).
Solution: Choose F using the ‘fact’ corresponding to this homotopy f.
Since f is periodic in the second variable – the two curves f (y, 0), and f (y, 1)
are the same – so by the uniquess F (y, 0) − F (y, 1) must be constant, hence
wn(c2 ) = F (1, 1) − F (1, 0) = F (0, 1) − F (0, 0) = wn(c1 ).
(3) Consider the closed curve Ln : [0, 1] � x �−→ e2πix Idn×n of n × n matrices.
Using the standard properties of the determinant, show that this curve is
not homotopic to the identity through closed curves in the sense that there
does not exist a continuous map G : [0, 1]2 −→ GL(n), with values in the
invertible n × n matrices, such that G(0, x) = Ln (x), G(1, x) ≡ Idn×n for
all x ∈ [0, 1], G(y, 0) = G(y, 1) for all y ∈ [0, 1].
Solution: The determinant is a continuous (actually it is analytic) map
which vanishes precisely on non-invertible matrices. Moreover, it is given
by the product of the eigenvalues so
(23.27)                              det(Ln ) = exp(2πixn).
This is a periodic curve with winding number n since it has the ‘lift’ xn.
Now, if there were to exist such an homotopy of periodic curves of matrices,
always invertible, then by the previous result the winding number of the
determinant would have to remain constant. Since the winding number for
the constant curve with value the identity is 0 such an homotopy cannot
exist.
Problem P10.4 Consider the closed curve corresponding toLn above in the case
of a separable but now inﬁnite dimensional Hilbert space:
(23.28)              L : [0, 1] � x �−→ e2πix IdH ∈ GL(H) ⊂ B(H)
4Of course, you are free to give a proof – it is not hard.
taking values in the invertible operators on H. Show that after identifying H with
H ⊕ H as above, there is a continuous map
(23.29)                        M : [0, 1]2 −→ GL(H ⊕ H)
with values in the invertible operators and satisfying
(23.30)
M (0, x) = L(x), M (1, x)(u1 , u2 ) = (e4πix u1 , u2 ), M (y, 0) = M (y, 1), ∀ x, y ∈ [0, 1].
Hint: So, think of H ⊕ H as being 2-vectors (u1 , u2 ) with entries in H. This allows
one to think of ‘rotation’ between the two factors. Indeed, show that
(23.31) U (y)(u1 , u2 ) = (cos(πy/2)u1 + sin(πy/2)u2 , − sin(πy/2)u1 + cos(πy/2)u2 )
deﬁnes a continuous map [0, 1] � y �−→ U (y) ∈ GL(H ⊕ H) such that U (0) = Id,
U (1)(u1 , u2 ) = (u2 , −u1 ). Now, consider the 2-parameter family of maps
(23.32)                          U −1 (y)V2 (x)U (y)V1 (x)
where V1 (x) and V2 (x) are deﬁned on H ⊕ H as multiplication by exp(2πix) on the
ﬁrst and the second component respectively, leaving the other ﬁxed.
Solution: Certainly U (y) is invertible since its inverse is U (−y) as follows in
the two dimensional case. Thus the map W (x, y) on [0, 1]2 in (23.32) consists
of invertible and bounded operators on H ⊕ H, meaning a continuous map W :
[0, 1]2 −→ GL(H ⊕ H). When x = 0 or x = 1, both V1 (x) and v2 (x) reduce to the
identiy, and hence W (0, y) = W (1, y) for all y, so W is periodic in x. Moreove at
y = 0 W (x, 0) = V2 (x)V1 (x) is exactly L(x), a multiple of the identity. On the
other hand, at x = 1 we can track composite as
� �       � 2πix �        �          �      �         �      � 4πx �
u1        e     u1            u2                u2           e u1
(23.33)         �−→             �−→               � −→              �
− →           .
u2           u2            −e2πx u1         −e4πx u1           u2
This is what is required of M in (23.30).
Problem P10.5 Using a rotation similar to the one in the preceeding problem (or
otherwise) show that there is a continuous map
(23.34)                        G : [0, 1]2 −→ GL(H ⊕ H)
such that
(23.35) G(0, x)(u1 , u2 ) = (e2πix u1 , e−2πix u2 ),
G(1, x)(u1 , u2 ) = (u1 , u2 ), G(y, 0) = G(y, 1) ∀ x, y ∈ [0, 1].
Solution: We can take
�          �       � 2πix            �
Id   0             e              0
(23.36)           G(y, x) = U (−y)              U (y)                     .
0 e−2πix            0           Id
By the same reasoning as above, this is an homotopy of closed curves of invertible
operators on H ⊕ H which satisﬁes (23.35).
Problem P10.6 Now, think about combining the various constructions above in
the following way. Show that on l2 (H) there is an homotopy like (23.34), G̃ :
[0, 1]2 −→ GL(l2 (H)), (very like in fact) such that
∞                           �∞
(23.37) G̃(0, x) {uk }k=1 = exp((−1)k 2πix)uk k=1 ,
�
G̃(1, x) = Id, G̃(y, 0) = G̃(y, 1) ∀ x, y ∈ [0, 1].
Solution: We can divide l2 (H) into its odd an even parts
(23.38)      D : l2 (H) � v �−→ ({v2i−1 }, {v2i }) ∈ l2 (H) ⊕ l2 (H) ←→ H ⊕ H.
and then each copy of l2 (H) on the right with H (using the same isometric isomor­
phism). Then the homotopy in the previous problem is such that
(23.39)                       G̃(x, y) = D−1 G(y, x)D
accomplishes what we want.
Problem P10.7: Eilenberg’s swindle For an inﬁnite dimenisonal separable Hilbert
space, construct an homotopy – meaning a continuous map G : [0, 1]2 −→ GL(H)
– with G(0, x) = L(x) in (23.28) and G(1, x) = Id and of course G(y, 0) = G(y, 1)
for all x, y ∈ [0, 1].
Hint: Just put things together – of course you can rescale the interval at the end
to make it all happen over [0, 1]. First ‘divide H into 2 copies of itself’ and deform
from L to M (1, x) in (23.30). Now, ‘divide the second H up into l2 (H)’ and apply
an argument just like the preceding problem to turn the identity on this factor into
alternating terms multiplying by exp(±4πix) – starting with −. Now, you are on
H ⊕ l2 (H), ‘renumbering’ allows you to regard this as l2 (H) again and when you
do so your curve has become alternate multiplication by exp(±4πix) (with + ﬁrst).
Finally then, apply the preceding problem again, to deform to the identity (always
of course through closed curves). Presto, Eilenberg’s swindle!
Solution: By rescaling the variables above, we now have three homotopies, always
through periodic families. On H ⊕ H between L(x) = e2πix Id and the matrix
� 4πix        �
e      Id 0
(23.40)                                            .
0      Id
Then on H ⊕ l2 (H) we can deform from
� 4πix       �    � 4πix            �
e     Id 0        e     Id    0
(23.41)                            to
0      Id         0     G̃(0, x)
with G̃(0, x) in (23.37). However we can then identify
(23.42)   H ⊕ l2 (H) = l2 (H), (u, v) �−→ w = {wj }, w1 = u, wj+1 = vj , j ≥ 1.
This turns the matrix of operators in (23.41) into G̃(0, x)−1 . Now, we can apply
the same construction to deform this curve to the identity. Notice that this really
does ultimately give an homotopy, which we can renormalize to be on [0, 1] if you
insist, of curves of operators on H – at each stage we transfer the homotopy back
to H.', 'source' => 'MIT OpenCourseWare, 18.102 Introduction To Functional Analysis, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.102 — question d’examen, en anglais] Let f : R −→ C be an element of L1 (R). Deﬁne � f (x) x ∈ [−L, L] (5.1)                     fL (x) = 0      otherwise. Show that fL ∈ L1 (R) and that |fL − f | → 0 as L → ∞. � Problem 5.2 Consider a real-valued function f : R −→ R which is locally integrable in the sense that � f (x) x ∈ [−L, L] (5.2)                    gL (x) = 0     x ∈ R \\ [−L, L] is Lebesgue integrable of each L ∈ N. (1) Show that for each ﬁxed L the function ⎧ ⎨gL (x) if gL (x) ∈ [−N, N ] ⎪ (N ) (5.3)               gL (x) = N           if gL (x) > N ⎪ −N       if gL (x) < −N ⎩ is Lebesgue integrable. � (N ) (2) Show that |gL − gL | → 0 as N → ∞. (3) Show that there is a sequence, hn , of step functions such that (5.4)
Let f : R −→ C be an element of L1 (R). Deﬁne
�
f (x) x ∈ [−L, L]
(5.1)                     fL (x) =
0      otherwise.
Show that fL ∈ L1 (R) and that |fL − f | → 0 as L → ∞.
�
Problem 5.2
Consider a real-valued function f : R −→ R which is locally integrable in the
sense that
�
f (x) x ∈ [−L, L]
(5.2)                    gL (x) =
0     x ∈ R \\ [−L, L]
is Lebesgue integrable of each L ∈ N.
(1) Show that for each ﬁxed L the function
⎧
⎨gL (x) if gL (x) ∈ [−N, N ]
⎪
(N )
(5.3)               gL (x) = N           if gL (x) > N
⎪
−N       if gL (x) < −N
⎩
is Lebesgue integrable.
� (N )
(2) Show that |gL − gL | → 0 as N → ∞.
(3) Show that there is a sequence, hn , of step functions such that
(5.4)                        hn (x) → f (x) a.e. in R.
(4) Deﬁning
⎧
⎪
⎪0        x �∈ [−L, L]
⎪
⎨h (x) if h (x) ∈ [−N, N ], x ∈ [−L, L]
(N )     n           n
(5.5)          hn,L =                                         .
⎪
⎪
⎪N         if hn (x) > N, x ∈ [−L, L]
−N        if hn (x) < −N, x ∈ [−L, L]
⎩
� (N )   (N )
Show that |hn,L − gL | → 0 as n → ∞.
1
2                                RICHARD MELROSE
Problem 5.3
Show that L2 (R) is a Hilbert space.
First working with real functions, deﬁne L2 (R) as the set of functions f : R −→ R
which are locally integrable and such that |f |2 is integrable.
(N )          (N )
(1) For such f choose hn and deﬁne gL , gL and hn by (5.2), (5.3) and (5.5).
(N )                      (N )     (N )
(2) Show using the sequence hn,L for ﬁxed N and L that gL and (gL )2 are
(N )     (N )
in L1 (R) and that |(hn,L )2 − (gL )2 | → 0 as n → ∞.
�
(N )
(3) Show that (�gL )2 ∈ L1 (R) and that |(gL )2 − (gL )2 | → 0 as N → ∞.
�
2    2
(4) Show that |(gL ) − f | → 0 as L → ∞.
(5) Show that f, g ∈ L2 (R) then f g ∈ L1 (R) and that
�          �                             �
(5.6)            | f g| ≤ |f g| ≤ �f �L2 �g�L2 , �f �2L2 = |f |2 .
(6) Use these constructions to show that L2 (R) is a linear space.
(7) Conclude that the quotient space L2 (R) = L2 (R)/N , where N is the space
of null functions, is a real Hilbert space.
(8) Extend the arguments to the case of complex-valued functions.
Problem 5.4
Consider the sequence space
⎧                                          ⎫
⎨                     �                    ⎬
(5.7)         h2,1 = c : N � j �−→ cj ∈ C;  (1 + j 2 )|cj |2 < ∞ .
⎩                                          ⎭
j
(1) Show that
�
(5.8)             h2,1 × h2,1 � (c, d) �−→ �c, d� =        (1 + j 2 )cj dj
j
2,1
is an Hermitian inner form which turns h into a Hilbert space.
(2) Denoting the norm on this space by � · �2,1 and the norm on l2 by � · �2 ,
show that
(5.9)                   h2,1 ⊂ l2 , �c�2 ≤ �c�2,1 ∀ c ∈ h2,1 .
Problem 5.5
In the separable case, prove Riesz Representation Theorem directly.
Choose an orthonormal basis {ei } of the separable Hilbert space H. Suppose
T : H −→ C is a bounded linear functional. Deﬁne a sequence
(5.10)                           wi = T (ei ), i ∈ N.
(1) Now, recall that |T u| ≤ C�u�H for some constant C. Show that for every
ﬁnite N,
N
�
(5.11)                                   |wi |2 ≤ C 2 .
j=1
PROBLEMS 5                        3
(2) Conclude that {wi } ∈ l2 and that
�
(5.12)                          w=      wi ei ∈ H.
i
(3) Show that
(5.13)             T (u) = �u, w�H ∀ u ∈ H and �T � = �w�H .
Department of Mathematics, Massachusetts Institute of Technology', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : SOLUTIONS TO PROBLEM SET 5 FOR 18.102, SPRING 2009
WAS DUE l l A M TUESDAY 17 MAR.
RICHARD MELROSE
You should be thinking about using Lebesgue\'s dominated convergence a t several
points below.
Let f : R -+ C be an element of L1( R ) .Define
f ( x ) x E [-L, Ll
otherwise.
Show that f L E L1(R)and that J I f L - f 1 + 0 as L + m.
Solution. If X L is the characteristic function of [-N, N] then f L = f x L . If
f n is an absolutely summable series of step functions converging a.e. t o f then
<
f n x ~is absolutely summable, since J I fnxLI J 1 f n 1 and converges a.e. to f L , so
f~ J L 1 ( R ) .Certainly I f ~ ( x-)f (x)I + 0 for each x as L + m and I f L ( x )- f (x)I 5
+
I fi ( x )1 I$(x)I 5 21f ( x )1 so by Lebesgue\'s dominated convergence, J If - f L I + 0.
Consider a real-valued function f : R -+ R which is locally integrable in the
sense that
is Lebesgue integrable of each L E N.
(1) Show that for each fixed L the function
is Lebesgue integrable.
(2) Show that J    lgiN)
- gLI + 0 as N + m.
(3) Show that there is a sequence, h,, of step functions such that
(5.4)                           hn(x)+ f ( x ) a.e. in R.
(4) Defining
2                                   RICHARD MELROSE
Show that J lhLNi - gLN)1 t 0 as n t M.
Solution:
( 1 ) By definition gZN) = max(-NxL, m i n ( N x L ,g L ) ) where X L is the charac-
teristic funciton of -[L, L], thus it is in L1( R ) .
( 2 ) Clearly gL( N )( a ) t g~ ( x ) for every x and      lgZN) <
( x )1   lgL(x)I so by Dom-
inated Convergence, gZN) t g~ in L1, i.e. J             lgLN)     l 0 as N t M
-g ~ t
since the sequence converges to 0 pointwise and is bounded by 21g(x)1.
( 3 ) Let SL,, be a sequence of step functions converging a.e. to g~ - for ex-
ample the sequence of partial sums of an absolutely summable series of
step functions converging to g~ which exists by the assumed integrability.
Then replacing SL,, by SL,,xL we can assume that the elements all van-
ish outside [-N, N] but still have convergence a.e. to g ~ Now        .   take the
sequence
This is certainly a sequence of step functions since it is a finite sum of
-
step functions for each n - and on [-L, L] \\ [- (L - I), (L - I ) ] for large
integral L is just S L , , - ~ t g ~ Thus
.   h,(x) t f (x) outside a countable
union of sets of measure zero, so also almost everywhere.
(4) This is repetition of the first problem, h!yi ( x ) t gZN) almost everywhere
and lhLNJ1    < N X L so gLN) L 1 ( R )and J lhLNJ - gLN)I t 0 as n t M.
Show that L 2 ( R ) is a Hilbert space - since it is rather central to the course I
wanted you to go through the details carefully!
First working with real functions, define L2( R )as the set of functions f : R -+ R
which are locally integrable and such that 1 f l2 is integrable.
( 1 ) For such f choose h, and define g~ , g l N ) and hiN) by (5.2),(5.3) and (5.5).
( 2 ) Show using the sequence hkNJ for fixed N and L that gLN) and               are  (gZN))2
in L 1 ( R )and that J I(hLyi)\' -      (gZN))21 t 0 as n t             M.
(N) 2
( 3 ) Show that ( 9 ~E )L 1~( R )and that J l(gL ) - (gL)21 -+ 0 as N -+ M.
(4) Show that J l(gL)2   - f 2 1 -+ 0 as L -+ 00.
( 5 ) Show that f , g E L2( R ) then f g E L1( R ) and that
I   / 5/
fgl      lfgl   < l l f 11~211911~2,I l f   Ilt2   =   /lf   12.
(6) Use these constructions to show that L2( R ) is a linear space.
(7) Conclude that the quotient space L2( R ) = L2( R ) / N ,where N is the space
of null functions, is a real Hilbert space.
(8) Extend the arguments to the case of complex-valued functions.
Solution:
( 1 ) Done. I think it should have been hLy
PROBLEMS 5                             3
(2) We already checked that gLN) E C1(R)and the same argument applies to
( g L N ) ) namely (hLY2l2 t gLN) almost everywhere and both are bounded
by N 2 SO ~by dominated
~        convergence
,
(N) 2
+
(N) 2
)   < N 2 x a~.e. * gL( N ))2 E L1( R ) and
(N)2      (N)2
(5-8)                              Ihn,L               I
- g~ ) + 0 see. 9
(3) Now, as N t m , ( g (LN )) 2 + ( 9 ~a.e.                                   <
) ~and ( g Z N ) ) ~t ( 9 ~ ) f 2~ SO by
dominated convergence, ( 9 ~E )C1~and J 1             (giNfi))2
- ( g L ) 21 t 0 as N t m .
( 4 ) The same argument of dominated convergence shows now that                tf2
and J Igi - f 1 t 0 using the bound by f E C1( R ) .
(5) What this is all for is to show that f g E C 1 ( R )if f , F = g E C2( R ) (for
easier notation). Approximate each of them by sequences of step functions
as above, hL2 for f and H:? for g. Then the product sequence is in C1 -
being a sequence of step functions - and
(5.9)                         hLY2 ( x )H:?     ( x ) t gLN) (x)GZN)(x )
almost everywhere and with absolute value bounded by N 2 X L .Thus by
dominated convergence           gZN)~iN)
E C1( R ) .Now, let N t oo; this sequence
converges almost everywhere to g ~ ( x ) G ~ and
( x ) we have the bound
so as always by dominated convergence, the limit gLGL E C1. Finally,
letting L + m the same argument shows that f F E C1( R ) . Moreover,
1 fFl E L1( R ) and
where the last inequality follows from Cauchy\'s inequality - if you wish,
first for the approximating sequences and then taking limits.
(6) So if f , g E C 2 ( R )are real-value, f        +
g is certainly locally integrable and
by the discussion above. For constants f E C2(R)implies cf E C2(R)is
directly true.
(7) The argument is the same as for C1 versus L1. Namely J f 2 = 0 implies
that f 2 = 0 almost everywhere which is equivalent to f = 0 a@e. Then the
norm is the same for all f             +
h where h is a null function since f h and h2
+
are null so ( f h)2 = f           +        +
2f h h2. The same is true for the inner product
so it follows that the quotient by null functions
(5.13)                                   L~( R ) = C2( R )IN
is a preHilbert space.
However, it remains to show completeness. Suppose {[f,]) is an ab-
solutely summable series in L2(R) which means that C 11 fn 11 L2 < m . It
n
4                                  RICHARD MELROSE
follows that the cut-off series fnxL is absolutely summable in the L1 sense
since
n
by Cauchy7sinequality. Thus if we set Fn = C f k then Fn(x)xLconverges
k-1
almost everywhere for each L so in fact
(5.15)                Fn ( x ) + f ( x ) converges almost everywhere.
We want to show that f E L 2 ( R )where it follows already that f is locally
integrable by the completeness of L1. Now consider the series
The elements are in L1( R ) and by Cauchy7sinequality for n > 1,
where the triangle inequality has been used. Thus in fact the series gn is
(5.18)                        c
absolutely summable in L1
/ g n ~5 2(?    f n 1 1 ~ 2 ) ~ -
So indeed the sequence of partial sums, the Fz converge to f 2 E L1(R).
Thus f E L2( R ) and moroever
Indeed the first term converges to J f 2 and, by Cauchys inequality, the
series of products fn f is absulutely summable in L1 with limit f so the
third term converges to -2 J f 2 . Thus in fact [F,] + [ f ] in L 2 ( R )and we
have proved completeness.
(8) For the complex case we need to check linearity, assuming f is locally
integrable and 1 f l2 E L1(R).The real part of f is locally integrable and the
approximation FA^) discussed above is square integrable with       (FL~))~    5
1 f l2 SO by dominated convergence, letting first N + oo and then L + oo
the real part is in L 2 ( R ) .Now linearity and completeness follow from the
real case.
Consider the sequence space
(1) Show that
(5.21)               h2j1x h2j13 (c,d ) ++(c,d ) =    C(l+ j 2 ) c j 6
j
is an Hermitian inner form which turns h2j1into a Hilbert space.
PROBLEMS 5                                     5
(2) Denoting the norm on this space by 11 . 1 1 2 ~and the norm on l2 by 11 . 112,
show that
Solution:
(1) The inner product is well defined since the series defining it converges ab-
solutely by Cauchy\'s inequality:
It is sesquilinear and positive definite since
only vanishes if all cj vanish. Completeness follows as for E2 - if dn) is a
Cauchy sequence then each component c,") (                          +
converges, since (1 j)scj( n )
is Cauchy. The limits cj define an element of h2,\' since the sequence is
bounded and
N                          N
where A is a bound on the norms. Then from the Cauchy condition c ( ~+   ) c
<
in h2J by passing to the limit as m + cc in I ~ c ( ~ ) - dm)1 1 2 ~ E .
(2) Clearly h2j2c l2 since for any finite N
and we may pass to the limit as N + oo to see that
In the separable case, prove Riesz Representation Theorem directly.
Choose an orthonormal basis {ei) of the separable Hilbert space H. Suppose
T : H + C is a bounded linear functional. Define a sequence
(1) Now, recall that lTul   < CllullH for some constant C. Show that for every
finite N,
(2) Conclude that {wi)E l2 and that
6                                          RICHARD MELROSE
( 3 ) Show that
(5.31)                  T ( u ) = ( U , W ) H \'v\' u E H and IlTll = I I w I I H .
Solution:
N
(I) The finite sum W N = C wiei is an element of the Hilbert space with norm
i=l
N
llwN 11% =     x Iwi\' 1 by Bessel\'s identity. Expanding out
i=l
N                n                   N
i=l                     i=l                  i=l
and from the continuity of T ,
which is the desired inequality.
( 2 ) Letting N + oo it follows that the infinite sum converges and
since llwN - w I I   < x IwiI2 tends to zero with N.
j>N
N
(3) For any u E H u~ = C ( u ,ei)ei by the completness of the {ei) so from the
i=l
continuity of T
(5.35) T ( u ) = lim T ( u N ) = lim C ( u ,e i ) ~ ( e i )
N+m             N+oo
i=l
N
= lim C ( u ,wiei) = lim ( u ,w N ) = ( u ,w )
N+m                N+m
i=l
where the continuity of the inner product has been used. From this and
Cauchy\'s inequality it follows that IlTll = supll,l,=,          IT(u)l     <
IIwII. The
converse follows from the fact that T ( w ) = I I W I I & .', 'source' => 'MIT OpenCourseWare, 18.102 Introduction To Functional Analysis, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.102 — question d’examen, en anglais] PROBLEM SET 2 FOR 18.102, SPRING 2009 DUE 11AM TUESDAY 24 FEB. RICHARD MELROSE I was originally going to make this problem set longer, since there is a missing Tuesday. However, I would prefer you to concentrate on getting all four of these questions really right! 1. Problem 2.1 Finish the proof of the completeness of the space B constructed in lecture on February 10. The description of that construction can be found in the notes to Lecture 3 as well as an indication of one way to proceed. 2. Problem 2.2 Let’s consider an example of an absolutely summable sequence of step functions. For the interval [0, 1) (remember there is a strong preference for left-closed but right-open intervals for
PROBLEM SET 2 FOR 18.102, SPRING 2009
DUE 11AM TUESDAY 24 FEB.
RICHARD MELROSE
I was originally going to make this problem set longer, since there is a missing
Tuesday. However, I would prefer you to concentrate on getting all four of these
questions really right!
1. Problem 2.1
Finish the proof of the completeness of the space B constructed in lecture on
February 10. The description of that construction can be found in the notes to
Lecture 3 as well as an indication of one way to proceed.
2. Problem 2.2
Let’s consider an example of an absolutely summable sequence of step functions.
For the interval [0, 1) (remember there is a strong preference for left-closed but
right-open intervals for the moment) consider a variant of the construction of the
standard Cantor subset based on 3 proceeding in steps. Thus, remove the ‘central
interval [1/3, 2/3). This leave C1 = [0, 1/3) ∪ [2/3, 1). Then remove the central
interval from each of the remaining two intervals to get C2 = [0, 1/9) ∪ [2/9, 1/3) ∪
[2/3, 7/9) ∪ [8/9, 1). Carry on in this way to deﬁne successive sets Ck ⊂ Ck−1 , each
consisting of a ﬁnite union of semi-open intervals. Now, consider the series of step
functions fk where fk (x) = 1 on Ck and 0 otherwise.
(1) Check that this is an absolutely
�       summable series.
(2) For which x ∈ [0, 1) does      |fk (x)| converge?
k
(3) Describe a function on [0, 1) which is shown to be Lebesgue integrable
(as deﬁned in Lecture 4) by the existence of this series and compute its
Lebesgue integral.
(4) Is this function Riemann integrable (this is easy, not hard, if you check the
deﬁnition of Riemann integrability)?
(5) Finally consider the function g which is equal to one on the union of all the
intervals which are removed in the construction and zero elsewhere. Show
that g is Lebesgue integrable and compute its integral.
3. Problem 2.3
2
The covering lemma for R . By a rectangle we will mean a set of the form
[a1 , b1 ) × [a2 , b2 ) in R2 . The area of a rectangle is (b1 − a1 ) × (b2 − a2 ).
(1) We may subdivide a rectangle by subdividing either of the intervals – re­
placing [a1 , b1 ) by [a1 , c1 ) ∪ [c1 , b1 ). Show that the sum of the areas of
rectangles made by any repeated subdivision is always the same as that of
the original.
1
2                                 RICHARD MELROSE
(2) Suppose that a ﬁnite collection of disjoint rectangles has union a rectangle
(always in this same half-open sense). Show, and I really mean prove, that
the sum of the areas is the area of the whole rectange. Hint:- proceed by
subdivision.
(3) Now show that for any countable collection of disjoint rectangles contained
in a given rectange the sum of the areas is less than or equal to that of the
containing rectangle.
(4) Show that if a ﬁnite collection of rectangles has union containing a given
rectange then the sum of the areas of the rectangles is at least as large of
that of the rectangle contained in the union.
(5) Prove the extension of the preceeding result to a countable collection of
rectangles with union containing a given rectangle.
4. Problem 2.4
(1) Show that any continuous function on [0, 1] is the uniform limit on [0, 1)
of a sequence of step functions. Hint:- Reduce to the real case, divide the
interval into 2n equal pieces and deﬁne the step functions to take inﬁmim
of the continuous function on the corresponding interval. Then use uniform
convergence.
(2) By using the ‘telescoping trick’ show that any continuous function on [0, 1)
can be written as the sum
�
(1)                                fj (x) ∀ x ∈ [0, 1)
i
�
where the fj are step functions and       |fj (x)| < ∞ for all x ∈ [0, 1).
j
(3) Conclude that any continuous function on [0, 1], extended to be 0 outside
this interval, is a Lebesgue integrable function on R.
Department of Mathematics, Massachusetts Institute of Technology', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The proof could be shorter than this, I have tried to be fairly complete.
To recap. We start of with a normed space V. From this normed space we
construct the new linear space Ṽ with points the absolutely summable series in V.
Then we consider the subspace S ⊂ Ṽ of those absolutely summable series which
converge to 0 in V. We are interested in the quotient space
(1)                                 B = V˜ /S.
What we know already is that this is a normed space where the norm of b = {vn }+S
– where {vn } is an absolutely summable series in V is
N
�
(2)                          �b�B = lim �           vn �V .
N →∞
n=1
This is independent of which series is used to represent b – i.e. is the same if an
element of S is added to the series.
Now, what is an absolutely summable series in B? It is a sequence {bn }, thought
of a series, with the property that
�
(3)                                  �bn �B < ∞.
n
We have to show that it converges in B. The ﬁrst task is to guess what the limit
should be. The idea is that it should be a series which adds up to ‘the sum of the
(n)
bn ’s’. Each bn is represented by an absolutely summable series vk in V. So, we
can just look for the usual diagonal sum of the double series and set
� (n)
(4)                              wj =        vk .
n+k=j
The problem is that this will not in generall be absolutely summable as a series in
V. What we want is the estimate
�           � � (n)
(5)                        �wj � =      �       vk � < ∞.
j            j    j=n+k
1
2                                     RICHARD MELROSE
The only way we can really estimate this is to use the triangle inequality and
conclude that
�∞          � (n)
(6)                           �wj � ≤    �vk �V .
j=1                  k,n
Each of the sums over k on the right is ﬁnite, but we do not know that the sum
over k is then ﬁnite. This is where the ﬁrst suggestion comes in:­
(n)
We can choose the absolutely summable series vk representing bn such that
� (n)
(7)                             �vk � ≤ �bn �B + 2−n .
k
Suppose an initial choice of absolutely summable series representing bn is uk , so
�N          �
�bn � = limN →∞ �    uk � and    �uk �V < ∞. Choosing M large it follows that
k=1                 k
�
(8)                                         �uk �V ≤ 2−n−1 .
k>M
M
(n)          �                  (n)
With this choice of M set v1          =         uk and vk          = uM +k−1 for all k ≥ 2. This does
k=1
still represent bn since the diﬀerence of the sums,
N
�  (n)
N
�          �−1
N +M
(9)                           vk −   uk = −       uk
k=1             k=1                    k=N
for all N. The sum on the right tends to 0 in V (since it is a ﬁxed number of terms).
Moreover, because of (8),
(10)
� (n)           �M          �              �N           �              N
�
�vk �V = �     uj �V +       �uk � ≤ �    uj � + 2       �uk � ≤ �   uj � + 2−n
k            j=1           k>M                      j=1              k>M          j=1
for all N. Passing to the limit as N → ∞ gives (7).
Once we have chosen these ‘nice’ representatives of each of the bn ’s if we deﬁne
the wj ’s by (4) then (5) means that
�            �           �
(11)                       �wj �V ≤    �bn �B +     2−n < ∞
j                     n                    n
because the series bn is absolutely summable. Thus {wj } deﬁnes an element of Ṽ
and hence b ∈ B.                      �
Finally then we want to show that     bn = b in B. This just means that we need
n
to show
N
�
(12)                               lim �b −                 bn �B = 0.
N →∞
n=1
N
�
The norm here is itself a limit – b −                  bn is represented by the summable series
n=1
with nth term
N
(n)
�
(13)                                       wk −             vk
n=1
PROBLEMS 2                                3
and the norm is then
p                 N
(n)
�                 �
(14)                            lim �        (wk −              vk )�V .
p→∞
k=1               n=1
Then we need to understand what happens as N → ∞! Now, wk is the diagonal
(n)                                                       (n)
sum of the vj ’s so sum over k gives the diﬀerence of the sum of the vj over the
ﬁrst p anti-diagonals minus the sum over a square with height N (in n) and width
p. So, using the triangle inequality the norm of the diﬀerence can be estimated by
the sum of the norms of all the ‘missing terms’ and then some so
p             N
(n)                          (m)
�             �                        �
(15)                 �         (wk −         vk )�V ≤                  �vl       �V
k=1           n=1                  l+m≥L
where L = min(p, N ). This sum is ﬁnite and letting p → ∞ is replaced by the sum
over l + m ≥ N. Then letting N → ∞ it tends to zero by the absolute (double)
summability. Thus
N
�
(16)                              lim �b −                bn �B = 0
N →∞
n=1
�
which is the statelent we wanted, that                 bn = b.                        �
n
2. Problem 2.2
Let’s consider an example of an absolutely summable sequence of step functions.
For the interval [0, 1) (remember there is a strong preference for left-closed but
right-open intervals for the moment) consider a variant of the construction of the
standard Cantor subset based on 3 proceeding in steps. Thus, remove the ‘central
interval [1/3, 2/3). This leave C1 = [0, 1/3) ∪ [2/3, 1). Then remove the central
interval from each of the remaining two intervals to get C2 = [0, 1/9) ∪ [2/9, 1/3) ∪
[2/3, 7/9) ∪ [8/9, 1). Carry on in this way to deﬁne successive sets Ck ⊂ Ck−1 , each
consisting of a ﬁnite union of semi-open intervals. Now, consider the series of step
functions fk where fk (x) = 1 on Ck and 0 otherwise.
(1) Check that this is an absolutely
�       summable series.
(2) For which x ∈ [0, 1) does      |fk (x)| converge?
k
(3) Describe a function on [0, 1) which is shown to be Lebesgue integrable
(as deﬁned in Lecture 4) by the existence of this series and compute its
Lebesgue integral.
(4) Is this function Riemann integrable (this is easy, not hard, if you check the
deﬁnition of Riemann integrability)?
(5) Finally consider the function g which is equal to one on the union of all
the subintervals of [0, 1) which are removed in the construction and zero
elsewhere. Show that g is Lebesgue integrable and compute its integral.
Solution.     (1) The total length of the intervals is being reduced by a factor of
k
1/3 each time. Thus l(Ck ) = 23k . Thus the integral of f, which is non­
negative, is actually
∞
2k                       2k
�              ��             �
(1)                      fk = k =⇒          |fk | =       =2
3                        3k
k                   k=1
4                                     RICHARD MELROSE
Thus the series is absolutely summable.
(2) Since the Ck are decreasing, Ck ⊃ Ck+1 , only if
�
(2)                               x∈E=       Ck
k
�
does the series       |fk (x)| diverge (to +∞) otherwise it converges.
k
(3) The function deﬁned as the sum of the series where it converges and zero
otherwise
⎧�
⎨ fk (x) x ∈ R \\ E
(3)                      f (x) = k
⎩0          x∈E
is integrable by deﬁnition. Its integral is by deﬁnition
�       ��
(4)                                f=         fk = 2
k
from the discussion above.
(4) The function f is not Riemann integrable since it is not bounded – and this
is part of the deﬁnition. In particular for x ∈ Ck \\ Ck+1 , which is not an
empty set, f (x) = k.
(5) The set F, which is the union of the intervals removed is [0, 1) \\ E. Taking
step functions equal to 1 on each of the intervals removed gives an absolutely
summable series, since they are non-negative and the kth one has integral
1/3×(2/3)k−1 for k = 1, . . . . This series converges to g on F so g is Lebesgue
integrable and hence
�
(5)                                       g = 1.
�
3. Problem 2.3
2
The covering lemma for R . By a rectangle we will mean a set of the form
[a1 , b1 ) × [a2 , b2 ) in R2 . The area of a rectangle is (b1 − a1 ) × (b2 − a2 ).
(1) We may subdivide a rectangle by subdividing either of the intervals – re­
placing [a1 , b1 ) by [a1 , c1 ) ∪ [c1 , b1 ). Show that the sum of the areas of
rectangles made by any repeated subdivision is always the same as that of
the original.
(2) Suppose that a ﬁnite collection of disjoint rectangles has union a rectangle
(always in this same half-open sense). Show, and I really mean prove, that
the sum of the areas is the area of the whole rectange. Hint:- proceed by
subdivision.
(3) Now show that for any countable collection of disjoint rectangles contained
in a given rectange the sum of the areas is less than or equal to that of the
containing rectangle.
(4) Show that if a ﬁnite collection of rectangles has union containing a given
rectange then the sum of the areas of the rectangles is at least as large of
that of the rectangle contained in the union.
(5) Prove the extension of the preceeding result to a countable collection of
rectangles with union containing a given rectangle.
PROBLEMS 2                                         5
Solution.      (1) For subdivision of one rectangle this is clear enough. Namely
we either divide the ﬁrst side into two or the second side in two at an
intermediate point c. After subdivision the area of the two rectanges is
either
(c − a1 )(b2 − a2 ) + (b1 − c)(b2 − a2 ) = (b1 − c1 )(b2 − a2 ) or
(1)
(b1 − a1 )(c − a2 ) + (b1 − a1 )(b2 − c) = (b1 − c1 )(b2 − a2 ).
this shows by induction that the sum of the areas of any the rectangles
made by repeated subdivision is always the same as the original.
(2) If a ﬁnite collection of disjoint rectangles has union a rectangle, say [a1 , b2 )×
[a−2, b2 ) then the same is true after any subdivision of any of the rectangles,
by the previous result. Moreover after such subdivision the sum of the areas
is always the same. Look at all the points C1 ⊂ [a1 , b1 ) which occur as an
endpoint of the ﬁrst interval of one of the rectangles. Similarly let C2 be
the corresponding set of end-points of the second intervals of the rectangles.
Now divide each of the rectangles repeatedly using the ﬁnite number of
points in C1 and the ﬁnite number of points in C2 . The total area remains
the same and now the rectangles covering [a1 , b1 ) × [A2 , b2 ) are precisely
the Ai × Bj where the Ai are a set of disjoint intervals covering [a1 , b1 )
and the Bj are a similar set covering [a2 , b2 ). Applying the one-dimensional
result from class we see that the sum of the areas of the rectangles with
ﬁrst interval Ai is the product
(2)                               length of Ai × (b2 − a2 ).
Then we can sum over i and use the same result again to prove what we
want.
(3) For any ﬁnite collection of disjoint rectangles contained in [a1 , b1 ) × [a2 , b2 )
we can use the same division process to show that we can add more disjoint
rectangles to cover the whole big rectangle. Thus, from the preceeding
result the sum of the areas must be less than or equal to (b1 − a1 )(b2 − a2 ).
For a countable collection of disjoint rectangles the sum of the areas is
therefore bounded above by this constant.
(4) Let the rectangles be Di , i = 1, . . . , N the union of which contains the
rectangle D. Subdivide D1 using all the endpoints of the intervals of D.
Each of the resulting rectangles is either contained in D or is disjoint from
it. Replace D1 by the (one in fact) subrectangle contained in D. Proceeding
by induction we can suppose that the ﬁrst N −k of the rectangles are disjoint
and all contained in D and together all the rectangles cover D. Now look at
the next one, DN −k+1 . Subdivide it using all the endpoints of the intervals
for the earlier rectangles D1 , . . . , Dk and D. After subdivision of DN −k+1
each resulting rectangle is either contained in one of the Dj , j ≤ N − k
or is not contained in D. All these can be discarded and the result is to
decrease k by 1 (maybe increasing N but that is okay). So, by induction
we can decompose and throw away rectangles until what is left are disjoint
and individually contained in D but still cover. The sum of the areas of
the remaining rectangles is precisely the area of D by the previous result,
so the sum of the areas must originally have been at least this large.
(5) Now, for a countable collection of rectangles covering D = [a1 , b1 ) × [a2 , b2 )
we proceed as in the one-dimensional case. First, we can assume that there
6                                  RICHARD MELROSE
is a ﬁxed upper bound C on the lengths of the sides. Make the kth rectangle
a little larger by extending both the upper limits by 2−k δ where δ > 0. The
area increases, but by no more than 2C2−k . After extension the interiors
of the countable collection cover the compact set [a1 , b1 − δ] × [a2 , b1 − δ].
By compactness, a ﬁnite number of these open rectangles cover, and hence
there semi-closed version, with the same endpoints, covers [a1 , b1 − δ) ×
[a2 , b1 − δ). Applying the preceeding ﬁnite result we see that
(3)                     Sum of areas + 2Cδ ≥ Area D − 2Cδ.
Since this is true for all δ > 0 the result follows.
�
I encourage you to go through the discussion of integrals of step functions – now
based on rectangles instead of intervals – and see that everything we have done can
be extended to the case of two dimensions. In fact if you want you can go ahead
and see that everything works in Rn !
4. Problem 2.4
(1) Show that any continuous function on [0, 1] is the uniform limit on [0, 1)
of a sequence of step functions. Hint:- Reduce to the real case, divide the
interval into 2n equal pieces and deﬁne the step functions to take inﬁmim
of the continuous function on the corresponding interval. Then use uniform
convergence.
(2) By using the ‘telescoping trick’ show that any continuous function on [0, 1)
can be written as the sum
�
(1)                                fj (x) ∀ x ∈ [0, 1)
i
�
where the fj are step functions and          |fj (x)| < ∞ for all x ∈ [0, 1).
j
(3) Conclude that any continuous function on [0, 1], extended to be 0 outside
this interval, is a Lebesgue integrable function on R.
Solution.     (1) Since the real and imaginary parts of a continuous function are
continuous, it suﬃces to consider a real continous function f and then
add afterwards. By the uniform continuity of a continuous function on a
compact set, in this case [0, 1], given n there exists N such that |x − y| ≤
2−N =⇒ |f (x)−f (y)| ≤ 2−n . So, if we divide into 2N equal intervals, where
N depends on n and we insist that it be non-decreasing as a function of n
and take the step function fn on each interval which is equal to min f = inf f
on the closure of the interval then
(2)                        |f (x) − Fn (x)| ≤ 2−n ∀ x ∈ [0, 1)
since this even works at the endpoints. Thus Fn → f uniformly on [0, 1).
(2) Now just deﬁne f1 = F1 and fk = Fk − Fk−1 for all k > 1. It follows that
these are step functions and that
n
�
(3)                                          = fn .
k=1
PROBLEMS 2                                       7
Moreover, each interval for Fn+1 is a subinterval for Fn . Since f can varying
by no more than 2−n on each of the intervals for Fn it follows that
(4)               |fn (x)| = |Fn+1 (x) − Fn (x)| ≤ 2−n ∀ n > 1.
Thus |fn | ≤ 2−n and so the series is absolutely summable. Moreover, it
�
actually converges everywhere on [0, 1) and uniformly to f by (2).
(3) Hence f is Lebesgue integrable.
(4) For some reason I did not ask you to check that
�      � 1
(5)                               f=       f (x)dx
0
where on the right is the Riemann integral. However this follows from the
fact that
�          �
(6)                               f = lim    Fn
n→∞
and the integral of the step function is between the Riemann upper and
lower sums for the corresponding partition of [0, 1].
�
Department of Mathematics, Massachusetts Institute of Technology', 'source' => 'MIT OpenCourseWare, 18.102 Introduction To Functional Analysis, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.102 — question d’examen, en anglais] PROBLEM SET 4 FOR 18.102, SPRING 2009 DUE 11AM TUESDAY 10 MAR. RICHARD MELROSE Just to compensate for last week, I will make this problem set too short and easy! 1. Problem 4.1 Let H be a normed space in which the norm satisﬁes the parallelogram law: (1)             �u + v�2 + �u − v�2 = 2(�u�2 + �v�2 ) ∀ u, v ∈ H. Show that the norm comes from a positive deﬁnite sesquilinear (i.e. Hermitian) inner product. Big Hint:- Try 1� �u + v�2 − �u − v�2 + i�u + iv�2 − i�u − iv�2 ! � (2)        (u, v) = 4 2. Problem 4.2 Let H be a ﬁnite dimensional (pre)Hilbert space. So, by deﬁnition H has a basis {vi }ni=1 , meaning that any element of H can be written � (1)                                  v=
PROBLEM SET 4 FOR 18.102, SPRING 2009
DUE 11AM TUESDAY 10 MAR.
RICHARD MELROSE
Just to compensate for last week, I will make this problem set too short and
easy!
1. Problem 4.1
Let H be a normed space in which the norm satisﬁes the parallelogram law:
(1)             �u + v�2 + �u − v�2 = 2(�u�2 + �v�2 ) ∀ u, v ∈ H.
Show that the norm comes from a positive deﬁnite sesquilinear (i.e. Hermitian)
inner product. Big Hint:- Try
1�
�u + v�2 − �u − v�2 + i�u + iv�2 − i�u − iv�2 !
�
(2)        (u, v) =
4
2. Problem 4.2
Let H be a ﬁnite dimensional (pre)Hilbert space. So, by deﬁnition H has a basis
{vi }ni=1 , meaning that any element of H can be written
�
(1)                                  v=     ci vi
i
and there is no dependence relation between the vi ’s – the presentation of v = 0 in
the form (1) is unique. Show that H has an orthonormal basis, {ei }ni=1 satisfying
(ei , ej ) = δij (= 1 if i = j and 0 otherwise). Check that for the orthonormal basis
the coeﬃcients in (1) are ci = (v, ei ) and that the map
(2)                          T : H � v �−→ ((v, ei )) ∈ Cn
is a linear isomorphism with the properties
�
(3)             (u, v) =   (T u)i (T v)i , �u�H = �T u�Cn ∀ u, v ∈ H.
i
Why is a ﬁnite dimensional preHilbert space a Hilbert space?
Department of Mathematics, Massachusetts Institute of Technology
1', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : SOLUTIONS TO PROBLEM SET 4 FOR 18.102, SPRING 2009
WAS DUE 11AM TUESDAY 10 MAR.
RICHARD MELROSE
Just to compensate for last week, I will make this problem set too short and
easy!
1. Problem 4.1
Let H be a normed space in which the norm satisﬁes the parallelogram law:
(1)             �u + v�2 + �u − v�2 = 2(�u�2 + �v�2 ) ∀ u, v ∈ H.
Show that the norm comes from a positive deﬁnite sesquilinear (i.e. Hermitian)
inner product. Big Hint:- Try
1�
�u + v�2 − �u − v�2 + i�u + iv�2 − i�u − iv�2 !
�
(2)           (u, v) =
4
Solution: Setting u = v, even without the parallelogram law,
1�
(u, u) = �2u�2 + i�(1 + i)u�2 − i�(1 − i)u�2 = �u�2 .
�
(3)
4
So the point is that the parallelogram law shows that (u, v) is indeed an Hermitian
inner product. Taking complex conjugates and using properties of the norm, �u +
iv� = �v − iu� etc
1�
�v + u�2 − �v − u�2 − i�v − iu�2 + i�v + iu�2 = (v, u).
�
(4)      (u, v) =
4
Thus we only need check the linearity in the ﬁrst variable. This is a little tricky!
First compute away. Directly from the identity (u, −v) = −(u, v) so (−u, v) =
−(u, v) using (4). Now,
(5)
1�
�u + (u + v)�2 − �u + (u − v)�2 + i�u + (u + iv)�2 − i�u + (u − iv)�2
�
(2u, v) =
4
1�                                                                          � 1�
= 2 �u + v�2 + �u�2 − �u − v�2 − �u�2 + i�(u + iv)�2 + i�u�2 − i�u − iv�2 − i�u�2 −   �u − (u
4                                                                              4
= 2(u, v).
Using this and (4), for any u, u� and v,
(6)
1               11�
(u+u� , v) = (u+u� , 2v) =       �(u + v) + (u� + v)�2 − �(u − v) + (u� − v)�2 + i�(u + iv) + (u − iv)�2 − i�(u
2               24
Using the second identity to iterate the ﬁrst it follows that (ku, v) = k(u, v) for any
u and v and any positive integer k. Then setting nu� = u for any other positive
integer and r = k/n, it follows that
(7)              (ru, v) = (ku� , v) = k(u� , v) = rn(u� , v) = r(u, v)
1
2                                    RICHARD MELROSE
where the identity is reversed. Thus it follows that (ru, v) = r(u, v) for any rational
r. Now, from the deﬁnition both sides are continuous in the ﬁrst element, with
respect to the norm, so we can pass to the limit as r → x in R. Also directly from
the deﬁnition,
1�
�iu + v�2 − �iu − v�2 + i�iu + iv�2 − i�iu − iv�2 = i(u, v)
�
(8)    (iu, v) =
4
so now full linearity in the ﬁrst variable follows and that is all we need.
2. Problem 4.2
Let H be a ﬁnite dimensional (pre)Hilbert space. So, by deﬁnition H has a basis
{vi }ni=1 , meaning that any element of H can be written
�
(1)                                  v=     ci vi
i
and there is no dependence relation between the vi ’s – the presentation of v = 0 in
the form (1) is unique. Show that H has an orthonormal basis, {ei }ni=1 satisfying
(ei , ej ) = δij (= 1 if i = j and 0 otherwise). Check that for the orthonormal basis
the coeﬃcients in (1) are ci = (v, ei ) and that the map
(2)                             T : H � v �−→ ((v, ei )) ∈ Cn
is a linear isomorphism with the properties
�
(3)             (u, v) =   (T u)i (T v)i , �u�H = �T u�Cn ∀ u, v ∈ H.
i
Why is a ﬁnite dimensional preHilbert space a Hilbert space?
Solution: Since H is assumed to be ﬁnite dimensional, it has a basis vi , i =
1, . . . , n. This basis can be replaced by an orthonormal basis in n steps. First
replace v1 by e1 = v1 /�v1 � where �v1 � =� 0 by the linear indepedence of the basis.
Then replace v2 by
(4)                      e2 = w2 /�w2 �, w2 = v2 − �v2 , e1 �e1 .
Here w2 ⊥ e1 as follows by taking inner products; w2 cannot vanish since v2 and e1
must be linearly independent. Proceeding by ﬁnite induction we may assume that
we have replaced v1 , v2 , . . . , vk , k < n, by e1 , e2 , . . . , ek which are orthonormal
and span the same subspace as the vi ’s i = 1, . . . , k. Then replace vk+1 by
k
�
(5)             ek+1 = wk+1 /�wk+1 �, wk+1 = vk+1 −               �vk+1 , ei �ei .
i=1
By taking inner products, wk+1 ⊥ ei , i = 1, . . . , k and wk+1 =
� 0 by the linear
independence of the vi ’s. Thus the orthonormal set has been increased by one
element preserving the same properties and hence the basis can be orthonormalized.
Now, for each u ∈ H set
(6)                                       ci = �u, ei �.
n
�
It follows that U = u −         ci ei is orthogonal to all the ei since
i=1
�
(7)               �u, ej � = �u, ej � −        ci �ei , ej � = �u.ej � − cj = 0.
i
PROBLEMS 4 SOLVED                                             3
�
This implies that U = 0 since writing U =          di ei it follows that di = �U, ei � = 0.
i
Now, consider the map (2). We have just shown that this map is injective, since
T u = 0 implies ci = 0 for all i and hence u = 0. It is linear since the ci depend
linearly on u by the linearity of the inner
� product in the ﬁrst variable. Moreover it
is surjective, since for any ci ∈ C, u =  ci ei reproduces the ci through (6). Thus T
i
is a linear isomorphism and the ﬁrst identity in (3) follows by direct computation:­
�n                 �
(T u)i (T v)i =    �u, ei �
i=1                  i
(8)                                                �
= �u,    �v, ei �ei �
i
= �u, v�.
Setting u = v shows that �T u�Cn = �u�H .
Now, we know that Cn is complete with its standard norm. Since T is an
isomorphism, it carries Cauchy sequences in H to Cauchy sequences in Cn and T −1
carries convergent sequences in Cn to convergent sequences in H, so every Cauchy
sequence in H is convergent. Thus H is complete.
Department of Mathematics, Massachusetts Institute of Technology', 'source' => 'MIT OpenCourseWare, 18.102 Introduction To Functional Analysis, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
						),
					),
				),
			),
		);
	}
}
