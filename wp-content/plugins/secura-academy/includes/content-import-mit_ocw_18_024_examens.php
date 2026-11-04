<?php
/**
 * Questions importees — MIT OpenCourseWare — 18 024 multivariable calculus with theory spring 2011
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_18_024_examens' ) ) {
	function seca_import_mit_ocw_18_024_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-18-024-examens', 'nom' => 'MIT OpenCourseWare — 18 024 multivariable calculus with theory spring 2011', 'url' => 'https://ocw.mit.edu/courses/18-024-multivariable-calculus-with-theory-spring-2011/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 10 - DUE APRIL 28
E.7:1,2 (Necessary deﬁnitions on previous page) (6 points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (E7:1,2)
1 Let l be the arclength of C, and parameterize C by its arclength: α(t) =
(x(t), y(t)). Then α (t) = 1 thus n(t) = (y  (t), −x (t)).
We have
�              � l                                            �
       
f · n ds =     (P (α(t)), Q(α(t))) · (y (t), −x (t)) dt =   −Q dx + P dy
C            0                                              C
2 Using Green’s Theorem for the function g = (−Q, P )
� � �           �         �
∂P    ∂Q
+       dxdy =     −Q dx + P dy
R ∂x      ∂y            C
But part(1) above gives us the value of the RHS. Combining, we have
� � �            �        �
∂P     ∂Q
+       dxdy =     f · n ds
R ∂x      ∂y            C', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 10 - DUE APRIL 28
11.22:4 (4 points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (11.22:4) Note that
�         � �        �
∂u ∂u        ∂v ∂v      ∂u ∂v ∂u  ∂v   ∂       ∂
f·g = v     −       +u   −     = v +u −v −u    =    (uv)− (uv)
∂x ∂y        ∂x ∂y      ∂x ∂x ∂y  ∂y   ∂x      ∂y
Applying Green’s Theorem for the function h = (uv, uv):
� �              � � �                 �         �               �
∂        ∂
f·gdx dy =         (uv) −    (uv) dx dy =      uv (dx+dy) = (1)(y) (dx+dy)
R               R ∂x        ∂y                 C               C
Parameterize the circle by s(t) = (cos t, sin t) then
� �                �                  � 2π
f · gdx dy =     y (dx + dy) =         sin t(− sin t + cos t) dt = −π
R               C                  0', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 10 - DUE APRIL 28
11.25:3 (4 points) make sure to prove it!', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (11.25:3) Whenever C1 and C2 cobound a region R1 ⊂ R we have
�                �                 � � �         �
∂P   ∂Q
P dx + Qdy −      P dx + Qdy =          −      dxdy
C1                C2                 R1 ∂y   ∂x
∂P    ∂Q
This evaluates to 0 when              =     . Thus
∂y     ∂x
�                      �
P dx + Qdy =     P dx + Qdy
C1                   C2
Let C be a Jordan curve, oriented counterclockwise that does not contract
�      in
the annulus. Since one cannot apply Green’s Theorem on this region C P dx+
Qdy = A for some A ∈ R, not necessarily zero. For example when (P, Q) =
x          y                      2    2
�
( 2      , −         ) on  R  = {1 ≤ x   +y   ≤ 2}, we have   C
P dx+Qdy = 2π (as
x + y 2 x2 + y 2
we will see in (11.25:1)). Now any Jordan curve C  in R either bounds a simply
connected region or it cobounds a region with C or −C. (We are somewhat
glossing over the diﬃculty that C, C  might intersect. But this problem can
be easily rectiﬁed by choosing a third curve that cobounds with both C and
C  and intersects neither of them.) In the ﬁrst case, using Green’s Theorem
implies               �                   � �
∂P     ∂Q
P dx + Qdy =              =     =0
C�                    D ∂y      ∂x
where here D ⊂ R and ∂D = C  .
In the second case, we use the observations outlined initially to determine
�                   �
P dx + Qdy = ± P dx + Qdy = ±A.
C�                        C
Thus there are 3 possible values for line integrals along piecewise smooth Jor­
dan curves.', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 3 - DUE FEBRUARY 24 Note the date change for this Pset! Due Thursday at 11:00 a.m., before class.
Let T : Rn → Rn be a linear transformation and let P denote a paralellpiped in Rn
formed by the vectors {v1 , · · · , vn }. Let m(T ) denote the matrix of the transformation of
T using the standard basis in Rn . Finally, let T (P ) denote the image of the parallelpiped
under the transformation T . Prove
vol(T (P )) = |det(m(T ))|vol(P ).
(5 pts)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : First we note that T (P�)n is again a parallelepiped. To see this notice
� that if
x ∈ T (P ) then x = T ( i=1 ci vi ) where 0 ≤ ci ≤
�1. By linearity x = i ci T (vi )
for 0 ≤ ci ≤ 1. That is, T (P ) = {x ∈ Rn |x = i ci T (vi ), 0 ≤ ci ≤ 1} and this
is precisely the deﬁnition of a parallelepiped.
Now, we determine the volume. If V denotes the matrix formed such that the
ith row is vi , then:
V ol(P ) = |det(V )|
Let W denote matrix with wi = m(T )vi as the ith row, then by the deﬁnition
of T (P ) above:
V ol(T (P )) = |det(W )| = |det(m(T )V )| = |det(m(T ))det(V )| = |det(m(T ))|vol(P ).', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 3 - DUE FEBRUARY 24 Note the date change for this Pset! Due Thursday at 11:00 a.m., before class.
Let P represent the plane containing the points (1, 0, 0), (3, 2, 4), (1, −1, 1). Find the
point on the plane that minimizes the distance between the plane and the origin.
Remark: You should solve this problem without using an optimization technique (don’t
take any derivatives). You can justify this point minimizes distance using the geometry of
vectors. (5 pts)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : First the vectors (3, 2, 4) − (1, 0, 0) = (2, 2, 4) and (1, −1, 1) − (1, 0, 0) =
(0, −1, 1) are parallel to the plane P . Thus, the vector (2, 2, 4) × (0, −1, 1) =
(6, −2, −2) is orthogonal to the plane P . The unit normal vector is thus
1
√1 (3, −1, −1) = n.  Now, we consider the projection of the point (1, 0, 0) on
11
the plane onto this normal direction n:
(1, 0, 0) · n      3       3
projn (1, 0, 0) =                 n = √   n =    (3, −1, −1)
||n||2          11     11
This gives the nearest point of P to the origin.', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 3 - DUE FEBRUARY 24 Note the date change for this Pset! Due Thursday at 11:00 a.m., before class.
14.9:15 (5 pts)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (14.9:15)
(a) As r (t) = A × r(t), a(t) = r (t) = A × r (t). Thus, A · a(t) = A · (A ×
r (t)) = 0 as per the deﬁning properties of the cross-product. Thus a(t)
is orthogonal to both A and r (t).
2
(b) Recall that a(t) = v (t)T  (t) + v  (t)T (t). As shown in part (a), a(t) is or­
thogonal to r (t) and therefore to the tangential vector T (t). This means
that the component v  (t) must be identically zero. By the mean value
theorem, this implies v(t) is constant. Now since the speed is constant
we would like to compute it at t = 0. While the speed is not deﬁned
at t = 0 (since the initial condition is for t = 0), the constancy of the
function means we can take the limit as t → 0+ of this constant function
to get its value:
v(t) = lim+ v(t) = lim+ A × r(t) = A × r(0) = A × B
t→0           t→0
The speed is |A × B| = |A||B| sin θ.
(c) The following steps enable us to determine the curve deﬁning r(t):
r (t) = A × r(t)
A · r (t) = A · (A × r(t) = 0
=⇒ r(t) · A     is constant
So the angle between the position vector and A is ﬁxed at θ. Also from
part(a), a ⊥ A implies the curve sits in a plane orthogonal to A. Both
r (t) and a(t) are orthogonal to A. This could imply a(t) r (t), but
this is not possible as a(t) = r (t) ⊥ r (t). As acceleration and velocity
are perpendicular, r(t) must deﬁne a circle. Precisely, r(t) is a circle in a
plane orthogonal to A that makes a cone angle of θ with A.', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 9 - DUE APRIL 21
11.9:8 (4 points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (11.9:8) Using Fubini’s Theorem (we assumed that the double integral exists):
                 tx            t  t txy      
ey                        e
dx dy =                 dx dy =
[0,t]×[1,t] y                      0 y
3                        3
1
 t                           t ty2
y    tx t               e −1
y −3 e y            dy =               dy =
1          t        x=0         1   ty 2
                    t
1 ty2        1        1    1       1     1 2
− 3e +                  = 2 − − 3 et + 3 et
t            ty y=1    t     t t          t', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 9 - DUE APRIL 21
11.15:6 (4 points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (11.15:6) The volume can be computed as the double integral of the function
6 − x − 2y
f (x, y) =              over region S = {(x, y)|0 ≤ x ≤ 6, 0 ≤ y ≤ (6 − x)/2}:
3
                            6  6−x                
6 − x − 2y                      2 6 − x − 2y
dy dx =                           dy dx =
S       3                 0     0         3
 6                 6−x         6                            6
6−x         y2 2                (6 − x)2            (6 − x)3
y−           dx =                   dx = −               =6
0      3        3 y=0           0       12                 36     0', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 9 - DUE APRIL 21
11.18:10 (6 points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (11.18:10) Place the coordinate system so that the sides of the rectangle be­
come parallel to the axis and A = (0, 0), B = (0, b), C = (a, b) and D = (a, 0).
The side AB then is along the y axis and the side AD is along the x axis. The
rectangle can be described as Q = {0 ≤ x ≤ a, 0 ≤ y ≤ b}. The distances
of any point (x, y) from segment AB and AD are x and y respectively. Thus,
density f (x, y) and mass m(Q) can be deﬁned as:
f (x, y) = x × y
                                2
ab
m(Q) =          f (x, y) d y d x =
Q                     2
Then the coordinates of the center of mass can be computed as:
 
1                         2
x =                  x(xy) d y d x = a
m(Q)                        3
 Q
1                         2
y =                  y(xy) d y d x = b
m(Q)       Q                3', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 5 - DUE MARCH 10
8.14:10 (6 points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (8.14:10)
(a) By hypothesis, we know f (x) = 0 for all x ∈ B(a). By deﬁnition
f (x) = (D1 f (x), . . . , Dn f (x)), thus D1 f (x) = · · · = Dn f (x) = 0. By
the 1-dimensional theorem, this means that f (x) is constant on every line
x + te1 , . . . x + ten for any x ∈ B(a). Let f (a) = c. Given y ∈ B(a), we
will prove that f (y) = c. Let y − a = d1 e1 + · · · + dn en , then:
c = f (a) = f (a + d1 e1 ) = · · · = f (a + d1 e1 + · · · + dn en ) = f (y).
(b) The condition means, that a is a local maximum of the function f . In
particular, because f (x) = 0 for all x ∈ B(a), 0 is a maximum for
all the functions f (a + tei ). By the 1-dimensional theorem Di (f (a)) =
f  (a + tei ) = 0, and thus
f (a) = (D1 f (a), . . . , Dn f (a)) = 0.
�      � �', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 5 - DUE MARCH 10
8.17:10 (6 points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (8.17:10) Denote f (x, y, z) = (x−c)2 +y 2 +z 2 and g(x, y, z) = x2 +(y −1)2 +z 2 .
Then the spheres in question are given by:
Lf (3) = {(x, y, z) : f (x, y, z) = (x − c)2 + y 2 + z 2 = 3}
Lg (1) = {(x, y, z) : g(x, y, z) = x2 + (y − 1)2 + z 2 = 1}
1
At a point (x, y, z) where the two spheres intersect:
gradient of Lf (3) is  f (x, y, z) = (2(x − c), 2y, 2z)
gradient of Lg (1) is  g(x, y, z) = (2x, 2(y − 1), 2z)
and T (Lf (3)), T (Lg (1)) are the respective tangent planes of Lf (3), Lg (1).
By deﬁnition, the gradient is perpendicular to the tangent plane. Or f (x, y, z)
is perpendicular to T (Lf (3)) and g(x, y, z) perpendicular to T (Lg (1)). Thus
the tangent planes T (Lf (3)) and T (Lg (1)) are perpendicular at the intersection
if and only if the gradients are perpendicular to each other at the intersection:
f (x, y, z) · g(x, y, z) = 0 or 4x(x − c) + 4y(y − 1) + 4z 2 = 0
To ﬁnd c for the above condition to hold, we can solve the system of 3 equa­
tions:
(x − c)2 + y 2 + z 2 = 3
x2 + (y − 1)2 + z 2 = 1
4x(x − c) + 4y(y − 1) + 4z 2 = 0
Add the ﬁrst two equations to get 2(x2 + y 2 + z 2 ) − 2xc − √
2y = 3 − c2 . This,
2
combined with the last equation, gives c = 3. Thus c = ± 3.', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 5 - DUE MARCH 10
Let f : Rn → R be a linear transformation. Prove that Ta = f for all a ∈ Rn . (6
points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Ta is deﬁned such that:
f (x) = f (a) + Ta (x − a) + |x − a|E(a, x − a)
2
where E(a, x − a) → 0 as |x − a| → 0.
Thus Ta = f if and only if:
f (x) = f (a) + f (x − a) + |x − a|E(a, x − a)
where E → 0 as |x − a| → 0.
Since f is a linear transformation,
f (x) = f (a) + f (x − a)
and thus E(a, x − a) ≡ 0 as |x − a| → 0.', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 8 - DUE APRIL 7
10.9:6 (4 points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (10.9:6) Writing the equation of the cylinder in complete square form:
a           a2
(x − )2 + y 2 =
2           4
Thus looking from high above the xy-plane the picture looks like:
The parametrization of the cylinders’ intersection with the xy-plane is:
�a         a a       �
s�(t) =    cos t + , sin t, 0
2         2 2
1
We need to lift it up to sit on the sphere:
�a         a a           �
s(t) =     cos t + , sin t, z(t) ,
2        2 2
where z(t) ≥ 0 and
�a                 a �2 � a        �2               �a            a�
2
cos t +        +      sin t + z(t) = a           cos t +       + z(t)2 = a2
2              2       2                          2           2
This means, that
a √
z(t) = √ 1 − cos t
2
Now
�
(y 2 , z 2 , x2 ) · d(x, y, z)
C
� 2π 3                                                �                                 �
a � 2                                    �                           sin t
=                  sin t, 2(1 − cos t), (cos t + 1)2 ) · − sin t, cos t, �                    dt
0      8                                                                 2(1 − cos t)
� �                                                              �
a3 2π                                             sin t(cos  t + 1) 2
=                   − sin3 t + 2 cos t(1 − cos t) + �                       dt
8 0                                                  2(1 − cos t)
�                       �                                �
a3 2π 3                   a3 2π                             a3 2π sin t(cos t + 1)2
=−                  sin tdt + +           cos t(1 − cos t)dt +               �               dt
8 0                      4 0                              8 0         2(1 − cos t)
Computing each of the integrals separately we get:
a3      a3 π
=0+         π+0=
4        4
�                      �
−y        x', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 8 - DUE APRIL 7
10.18:13 (8 points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (10.18:13) Note, that the function is not necessarily well deﬁned in (0, 0). Thus
we will ﬁx our basepoint at (1, 0). Then given a point r(cos ϑ, sin ϑ) ∈ R2 ,
then an obvious path from (1, 0) to r(cos ϑ, sin ϑ) can be parametrized by
s1 : [0, ϑ] → R2 and s2 : [1, r] → R2 with
s1 (t) = (cos t, sin t)
s2 (t) = t(cos ϑ, sin ϑ)
For n = −1
� ϑ                                         � r
n
φ(r(cos ϑ, sin ϑ)) =         a1 (cos t, sin t)·(− sin t, cos t)d t+    atn (cos ϑ, sin ϑ)·(cos ϑ, sin ϑ)d t
0                                                1
� r
arn+1   a
=0+a             tn d t =         −
1               n+1 n+1
Checking that it is a potential function:
arn+1
∇          = arn (cos ϑ, sin ϑ)
n+1
For n = −1 we have
� r                                                  � r
a                                                  1
ψ(r(cos ϑ, sin ϑ)) =             (cos ϑ, sin ϑ) · (cos ϑ, sin ϑ)dt = a              d t = a log r
1   t                                             1    t
Again checking that this is indeed a potential function:
a
∇ψ(r(cos ϑ, sin ϑ)) = (cos ϑ, sin ϑ).
r
3', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 4 - DUE MARCH 3
B.63:3. First prove that f (t) is continuous on [0, 1]. Then solve the stated problem.(6
pts)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (B63:3)                         �             � �
(t, t cos πt ) for 0 < t ≤ 1,
f (t) =
(0, 0) for t = 0.
f : R → R2 , thus it is continuous if both f1 (t) = t and
�      � �
t cos πt for 0 < t ≤ 1,
f2 (t) =
0 for t = 0.
are continuous. f1 is clearly continuous at any point t, and so is f2 at any point
t=
 0. For t = 0 we have to check that if tn → 0, then f2 (tn ) → f2 (0) = 0:
� �
π
|f2 (tn )| = |tn cos     | ≤ |tn |
tn
thus it tends to 0 too. Further, note that both f1 (t) and f2 (t) do not have any
self intersections and are therefore simple curves.
Because f (t) is simple and continuous over a continuous stretch of t, we can
assess whether f (t) has a ﬁnite arc length (is rectiﬁable) by:
(a) partitioning the space of t into n discrete blocks deﬁned by vertices t1 ,
t2 , . . . tn .
(b) deﬁning a polygonal arc connecting points (t1 , f (t1 )), (t2 , f (t2 )), . . . (tn , f (tn ))
- this represents a sampled approximation of f (t)
(c) considering the limit as n → ∞ of the length of this polygonal arc
For n = 5, the partition of t is deﬁned by the collection of points t in P5 :
�                �
1 1 1 1
P5 = 0, , , , , 1
5 4 3 2
� �
and the polygonal arc connects the points (t , t cos tπ� ):
�          �     � �         � �      � �         �           �
1 1       1 1       1 1          1 1
(0, 0),    ,−    ,    ,    ,   ,−      ,     ,    , (1, −1) .
5 5       4 4       3 3          2 2
1
∏(P5)
f2(t)
-1
Notice
��            �2       �                   �2
�n
1   1                 (−1)k (−1)k−1
|π(Pn )| = ||(1/n, (−1) /n)−(0, 0)||+
n
−           +            −
k=2
k k−1                   k    k−1
√         ��          �2 �                     �2
2   �n
1           (−1)k 2k + (−1)k+1
=     +                    +
n     k=2
k(k − 1)            k(k − 1)
√                               √                  √                 √
2 �          √                  2 � 2k − 1         2 �               2 �2
n                               n                   n                n
1                                                  1    1
=    +             4k − 4k + 2 >
2               +             =    +          + >    +    .
n k=2 k(k − 1)                   n k=2 k(k − 1)     n k=2 (k − 1) k  n k=2 k
2
(This is not quite what the notes have, but nearly so.)
Thus the length of Pn tends to ∞ as n goes to ∞, so f (t) cannot be rectiﬁable.', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 4 - DUE MARCH 3
14.15:11 (5 pts)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (14.15:11)
(a) With the notation of the exercise
v(t) = 5(cos α(t)i + sin α(t)j)
and
a(t) = v (t) = 5α (t)(− sin α(t)i + cos α(t)j)
then
|a(t) × v(t)|   |25α (t)|
κ(t) ≡                         =            = 2t
v(t)3          125
This means:
|α (t)| = 10t.
π
As a result, α (t) could be −10t or 10t. Since α(0) = and the curve
2
π
stays in the positive half plane, i.e. α(t) < ∀t, we see that α (0) < 0.
2
3
Then by continuity α (t) < 0. Thus the correct solution is α (t) = −10t.
π
Integrating we get α(t) = −5t2 + C. As α(0) = C, C = and we get
2
π
α(t) = −5t2 +         .
2
(b) We have already computed everything necessary:
π                π
v(t) = 5(cos α(t)i + sin α(t)j) = 5(cos(−5t2 +           )i + sin(−5t2 + )j)
2                2', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 4 - DUE MARCH 3
8.5:2,4 (8 pts)
The problems from Chapter 14 refer to Apostol Volume I.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (8.5:2,4) 8.5:2 Let
L :=      lim        f (x, y).
(x,y)→(a,b)
We would like to prove that if
lim(f (x, y)) exists for every y,
x→a
then
lim lim(f (x, y)) = L
y→b x→a
Let us denote limx→a f (x, y) = Ly for each y. Then we need to show limy→b Ly =
L. Suppose not. Then for some  > 0 there exists a sequence yn → b such
that |Lyn − L| > . Reindex the sequence yn , and perhaps remove some ele­
ments, so that |yn − b| < 1/n for each n. Now, for each n choose xn such that
|xn − a| < 1/n and
|f (xn , yn ) − Lyn | < /2.
4
Now consider for each n,
|f (xn , yn ) − L| ≥ |L − Lyn | − |Lyn − f (xn , yn )| >  − /2 = /2 > 0.
Thus, we constructed a sequence (xn , yn ) → (a, b) such that f (xn , yn ) does not
converge to L. This implies a contradiction and it follows that one must have
limy→b Ly → L.
8.5:4
x2 y 2
f (x, y) =                  whenever x2 y 2 + (x − y)2 =
 0
x y + (x − y)
2 2         2
Then
lim lim(f (x, y)) = lim 0 = 0,
y→0 x→0                y→0
and similarly
lim lim(f (x, y)) = lim 0 = 0.
x→0 y→0             x→0
But for y = x
x4
lim f (x, x) = lim   = 1.
x→0           x→0 x4', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 10 - DUE APRIL 28
11.22:2 (4 points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (11.22:2) Q can be written as the sum of two functions Q = Q1 + Q2 , where
2              1
Q1 = −x2 ye−y and Q2 = 2         . Thus, the integral to evaluate is
x + y2
�
P dx + Q1 dy + Q2 dy.
C
Let R1 be the square {|x| ≤ a, |y| ≤ a} and C its boundary. First note that
∂P          2  ∂Q1
= −2yxe−y =
∂y              ∂x
Then, by Green’s theorem:
�                 � �           �            �
∂P   ∂Q1
P dx + Q1 dy =                      −       dxdy = 0.
C                      R1       ∂y    ∂x
�
To compute the remaining part C Q2 dy, ﬁrst observe that the integral will
certainly be zero along y = ±a as there one has dy ≡ 0. So, we can compute
�           � a            � a
dt            dt
Q2 dy =       2    2
−      2    2
= 0.
C          −a a + t       −a a + t
1
Notice the sign on the second integral corresponds to the fact that the direction
of the parameterized curve is opposite the counterclockwise orientation on the
square.', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 10 - DUE APRIL 28
11.22:8 (6 points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (11.22:8) If C is parameterized by arclength s(t) = (x(t), y(t)) then n =
(y  , −x )
(a) We can write
�      �
∂g
ds =    ∇g · n ds =
C ∂n       C
� �       � �        �      � �                �      �
∂g ∂g     ∂y ∂x             ∂g ∂y ∂g ∂x               ∂g      ∂g
,    ·    ,      dt =            −         dt =        dy −    dx
C  ∂x ∂y     ∂t ∂t          C ∂x ∂t     ∂y ∂t          C ∂x      ∂y
Using Green’s Theorem we get
� � � 2        �      � �
∂ g ∂2g
2
+ 2 dx dy =      ∇2 g dx dy
R ∂x     ∂y           R
(b) Similarly
�            �
∂g          ∂g         ∂g
f    ds =   f     dy − f    dx
C ∂n         C ∂x          ∂y
� � �                                  �
∂f ∂g      ∂ 2 g ∂f ∂g      ∂2g
=               +f 2 +            + f 2 dx dy
R ∂x ∂x        ∂x      ∂y ∂y    ∂y
� �
�                  �
=        ∇f · ∇g + f ∇2 g dx dy
R
2
(c) To prove this part, apply part (b) with the roles of f and g reversed.
Then subtract this equation from the equation stated in part (b).', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 10 - DUE APRIL 28
11.25:1 (6 points) As always, justify all steps of your calculations with proofs or the
appropriate theorem.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (11.25:1)
3
(a) First let Br (boundary of disc Dr ) be a circle around (0, 0) with radius r.
We can parameterize Br by s(t) = (r cos t, r sin t). Then P = r sin t/r2
and Q = −r cos t/r2 . So
�                     � 2π
P dx + Q dy =          (r sin t/r2 )(−r sin t) dt + (−r cos t/r2 )(r cos t) dt
Br                    0
� 2π
−r2
=              dt = −2π
0     r2
For any piecewise smooth Jordan curve C that bounds a region R that
contains (0, 0) we can choose r small enough so that the disc Dr of radius
∂P       ∂Q
r lies inside C. Then R − Dr is a region where          =       and these
∂y      ∂x
partial derivatives are well deﬁned. Thus, as in the previous exercise we
have that
�                   �
P dx + Q dy = ±      P dx + Q dy = ±2π.
C                      Br
The sign depends on the orientation of C with respect to the orientation
of Br . The integral is positive if C is oriented clockwise and negative
otherwise.
∂P     ∂Q
(b) If (0, 0) is outside the region then in the whole region     =      (and
∂y     ∂x
these partial derivatives are everywhere� well deﬁned). Thus we can once
more use Green’s Theorem to see that C P dx + Q dy = 0.', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 3 - DUE FEBRUARY 24 Note the date change for this Pset! Due Thursday at 11:00 a.m., before class.
14.4: 23 (5 pts)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (14.4:23) Since F is continuous, we can apply the ﬁrst fundamental theorem
of calculus to determine a derivative for the expression on the right hand side
of the equation. Thus
�
       x       x    1          1 x
F (x) = e A + xe A + F (x) − 2           F (t) dt = 2ex A + xex A    ∀ x > 0.
x         x 1
Now we apply the second fundamental theorem of calculus and the above result
to get:                      �              �
x                        x
F (x) − F (1) =             F  (t) dt = A           (2et + tet ) dt
1                        1
Integrating by parts we have:
�x            �x
�    t �
�
t �
F (x) − F (1) = A(2e + te − e )� = A(e + te )� = A(ex + xex ) − 2Ae
t     t         t
1                       1
Substituting F (1) = eA we observe
F (x) = Aex + Axex − Ae', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 3 - DUE FEBRUARY 24 Note the date change for this Pset! Due Thursday at 11:00 a.m., before class.
14.9:12 (5 pts)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (14.9:12)
(a) The motion is counterclockwise. This can be seen as follows: For t such
that g(t) > 0, the particle is at some point on the upper half of the ellipse.
Here as the horizontal component of the velocity is negative (leftward),
the upper portion of the ellipse is carved out from right to left. This is
counterclockwise motion.
(b) Since r(t) = (f (t), g(t)) gives the ellipse, we see
3f (t)2 + g(t)2 = 1
Taking the derivative of both sides with respect to t, and substituting the
given fact that f  (t) = −g(t) we see
6f (t)f  (t)+2g(t)g  (t) = 0 =⇒ −6f (t)g(t)+2g(t)g  (t) = 0 =⇒ g(t)[g  (t)−3f (t)] = 0
That is, for g(t) = 0 we have g  (t) = 3f (t). Hence the vertical component
of velocity is proportional to f (t). When g(t) = 0, use the continuity of
g  (t) to get the same result.
(c) Notice that the position vector (and therefore f and g) should be periodic.
Moreover, g  (t) = 3f (t) implies g  (t) = 3f  (t) = −3√
g(t). Assuming we’ve
parameterized so that g(0) = 0, we see g(t) = sin( 3t) solves the above
second order diﬀerential equation. Since the period of this function is
2π
√ , this is precisely the time needed to travel around the ellipse once.
3', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 3 - DUE FEBRUARY 24 Note the date change for this Pset! Due Thursday at 11:00 a.m., before class.
14.13:16 (5 pts)
The problems from Chapter 14 refer to Apostol Volume I.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (14.13:16) As the area of the function f is proportional to its arc length over
the same interval, we can write:
� x             � x�
A(x) ≡      f (t)dt = c      1 + (f  (t))2 dt
a              a
Note: To compute arc length we are assuming that f  is continuous.
Applying the second fundamental theorem of calculus we see
�
A (x) = f (x) and A (x) = c 1 + (f  (x))2
Or equivalently:
�                  f 2 (x)
f (x) = c    1 + (f  (x))2 =⇒         − (f  (x))2 = 1
c2
3
Notice a ﬁrst solution is if f  ≡ 0 then f 2 = c2 works and f is just a constant
function.
Now suppose f  = 0. In this case, the equation above is solved by:
x                     x
f (x) = c cosh( ) and f  (x) = sinh( )
c                     c
As cosh2 (x)−sinh2 (x) = 1, the constraint of f 2 /c2 −f 2 = 1 is fulﬁlled. A more
complete derivation of this solution can be found in the ﬁnal exam year 2010.
Therein the Taylor series for two functions u, v such that u = v, v  = u with
conditions u(0) = 0, v(0) = 1 are examined. It is shown that u and v were the
functions cosh x and sinh x, and follow the property cosh2 (x) − sinh2 (x) = 1.', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 9 - DUE APRIL 21
11.15:2 (4 points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (11.15:2)
                                  1  1+x
(1 + x) sin y d x d y =                (1 + x) sin y d y d x =
S                              0      0
 1                                       x                                               1
(1 + x)(1 − cos(1 + x))d x =             (x + 2) − (x + 1) sin(x + 1) − cos(x + 1)
0                                      2                                                  0
3
=    + cos 1 + sin 1 − cos 2 − 2 sin 2
2', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 9 - DUE APRIL 21
11.15:13 (4 points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (11.15:13) The domain we integrate over is given as
x2 − 4
S = {−6 ≤ x ≤ 2,              ≤ y ≤ 2 − x}
4
1
Observe the points of intersection of the two functions of x are at (−6, 8) and
(2, 0). Integrating in x√ﬁrst will require dividing the domain into two regions,
as√on 0 ≤ y ≤ 8,   √ − 4 + 4y ≤ x ≤ 2 − y while on −1 ≤ y ≤ 0 we see
− 4 + 4y ≤ x ≤ 4 + 4y.
Therefore we can evaluate our integral
 2  2−x                     0  √4y+4                     8  2−y
2
f (x, y) d y d x =       √
f (x, y) d x d y +       √
f (x, y) d x d y
x −4
−6      4
−1   − 4y+4                   0    − 4y+4', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 9 - DUE APRIL 21
Let R, S be bounded subsets of the plane with corresponding density functions fR , fS
respectively. Let T = R ∪ S and deﬁne fT to be the appropriate density function on each
component of T . Let m(R), m(S) denote the respective masses of R, S. Prove
(xR m(R) + xS m(S), y R m(R) + y S m(S))
(xT , y T ) =                                            .
m(R) + m(S)
Here xU denotes the center of mass of the region U . (8 points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Let fS , fR represent the density functions for S, R respectively. We deﬁne
⎧
⎨ fR (x) if x ∈ R
fR∪S (x) =    fS (x) if x ∈ S                       (1)
⎩
0    otherwise
Then
                                        
xf R ∪S d x d y        xfR d x d y +     xf d x d y
xT =  R∪S                 =  R                S S         .
f
R∪S R∪S
dx dy            f dx dy +
R R
f dx dy
S S
2
                                                   
Now observe
        that     R
xf R d x d y = x R    R
fR d x d y = x R m(R) and    S
xfS d x d y =
xS     f
S S
d x d y = x S m(S).  Thus
xR m(R) + xS m(S)
xT =                     .
m(R) + m(S)
A similar argument works for y T and the result follows immediately.', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 5 - DUE MARCH 10
8.17:6 - also prove f is not diﬀerentiable at (0, 0). (6 points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (8.17:6) f (x, y) =    |xy| = |x| |y|
(a) f (x, y) = 0 on the lines (x, 0) and (0, y). Thus ∂f
∂x
= ∂f
∂y
= 0 at the origin.
(b) For f to have a tangent plane at the origin, it must have a total derivative
at the origin. If indeed f had a total derivative at the origin then we
expect
∂f ∂f              ∂f   ∂f
f  ((x, y); (1, 1)) to be (     ,   ) · (1, 1) =    +    = 0 + 0 = 0.
∂x ∂y              ∂x ∂y
But in reality, f  ((x, y = x); (1, 1)) is the partial derivative along the line
x = y. On this line, f (x, x) = x, thus f  ((x, y); (1, 1)) = 1. This deﬁes
our expectation. Thus f cannot have a total derivative, nor a tangent
plane at the origin.', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 5 - DUE MARCH 10
Let f : Rn → Rm such that the inverse image of every open set is open. Prove f
is continuous. (6 points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Consider a ∈ Rn . To prove continuity at a we need to ﬁnd a δ > 0 for every
given  > 0 with the property that |x − a| < δ implies |f (x) − f (a)| < .
Note that the set of points f (x) for which |f (x) − f (a)| <  are contained in
an open ball B (f (a)). Now the preimage of this open ball f −1 (B (f (a))) is
open but may not be connected. That is, it may consist of the union of a few
disjoint open sets. But, necessarily, one of these open sets contains a. Call this
open set U . Then openness implies there exists δ > 0 such that Bδ (a) ⊂ U .
Moreover, as f (U ) ⊂ B (f (a)), containment implies f (Bδ (a)) ⊂ B (f (a)). It
follows that f is continuous.', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 8 - DUE APRIL 7
10.5:11 (4 points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (10.5:11) Parameterize the sides of the square C by maps si : [0, 1] → R2 by
s1 (t)   =   (1 − t, t);
s2 (t)   =   (−t, 1 − t);
s3 (t)   =   (t − 1, −t);
s4 (t)   =   (t, t − 1).
With this parametrization:
�              � 1               � 1               � 1               � 1
dx + dy          −1 + 1            −1 − 1             1−1               1+1
=                dt+               dt+               dt+               dt
C |x| + |y|    0 (1 − t) + t     0 t + (1 − t)     0 (1 − t) + t     0 t + (1 − t)
The ﬁrst and the third summands are 0, and the second and fourth terms
cancel each other, giving: �
dx + dy
=0
C |x| + |y|', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 8 - DUE APRIL 7
C34:3 (4 points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (C34:3) As per the question, f (x, y) =                          ,          . Therefore we can
x 2 + y 2 x2 + y 2
write                                 �
1
φ(x, y) =                      (−y, x) · d(x, y)
C   x2 + y 2
As suggested in the exercise we will compute the integral along a speciﬁc path
starting at (1, 0). For given (x, y) we can parameterize the path in two parts
with s1 : [1, x] → R2 and s2 : [0, y] → R2 . (Here an interval [a,b] is understood
as [b,a] if a > b.)
s1 (t) = (t, 0)
s2 (t) = (x, t)
2
With these notations:
�
1
φ(x, y) =                   (−y, x) · d(x, y)
C x +y
2     2
� x           � y
0               x                y
=     − 2 dt +               dt = arctan
1    t        0 x +t
2     2             x
Finally, we can check that this is indeed the potential function for f (x, y):
1
∇φ(x, y) =                      (−y, x) = f (x, y).
x2 + y 2', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 8 - DUE APRIL 7
10.18:17,18 - First read Example 2 in Section 10.16. Then do the two problems. Note
that comments about 17 and 18 originate on the previous page and continue onto page
346. (2 and 8 points)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (10.18:17,18) In this exercise
�                  �
y       x
f (x, y) = − 2     ,
x + y 2 x2 + y 2
10.18:17 We have computed on the recitation that
y 2 − x2
D1 f2 (x, y) = D2 f1 (x, y) =
(x2 + y 2 )2
10.18:18 (Compare the results with 3)
(a) We will consider the 3 cases one by one. First, for x = 0 we have, by
deﬁnition, θ = π/2. Now when x = 0
sin θ   r sin θ  y
tan θ =         =         = .
cos θ   r cos θ  x
and
y           −y
arctan   = arctan    = φ ∈ (−π/2, π/2).
x           −x
For x > 0, −π/2 < θ = φ < π/2 and this corresponds directly with the
deﬁnition of the arctan function.
For x < 0, it turns out that θ = φ + π because the angle between (x, y)
and (−x, −y) is precisely π.
(b) Using the derivation rule for the inverse function. If x > 0
∂θ           ∂          y
(x, y) =     arctan
∂x          ∂x          x
y     1            y
= − 2        y 2 = − 2
x 1 + (x)        x + y2
∂θ          ∂           y
(x, y) =     arctan
∂y          ∂y          x
1     1          x
=         y 2 = 2
x 1 + (x)      x + y2
Similar argument works for x < 0 case. For x = 0 one computes the left
and right derivatives, and see that they are both equal to:
∂θ            1
(0, y) = −
∂x            y
4
and
∂θ
(0, y) = 0.
∂y
∂θ      ∂θ
Hence for all (x, y), the relations in the exercise for and    hold. This
∂x      ∂y
proves that θ is a potential function for f on the set T .', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 4 - DUE MARCH 3
14.13:21 (5 pts)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : (14.13:21) By the chain-rule the derivative of Y (t) = X[u(t)] is Y  (t) =
u (t)X  [u(t)]. Using this:
� d                           � d

|Y (t)|d t =               |u (t)X  [u(t)]|d t
c                          c
Substituting u = u(t)
� d                        � u(d)
                       |u (t)X  [u(t)]|
|Y (t)|d t =                                    du
c                          u(c)            u (t)
But u (t) > 0, as a re-parametrization of a curve is by deﬁnition an increas­
ing function (and further by assumption it is strictly increasing). Therefore
|u (t)|
= 1 and
u (t)
� d              � u(d)

|Y (t)|d t =        |X  (u)| d u
c                         u(c)', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT 18.024 — question d’examen, en anglais] PSET 4 - DUE MARCH 3
Let f : Rn → Rm be continuous. Prove the inverse image of any open set is open.
That is, let U ⊂ Rm be open. Prove that f −1 (U ) = {x ∈ Rn |f (x) ∈ U } is open. (Using , δ
arguments will be helpful.) (6 pts)', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Assume f : Rn → Rm is continuous. Given an open set U ⊂ Rm we want to
prove that f −1 (U ) is open. This means that for any point x ∈ f −1 (U ) we need
to show there exists R > 0 such that BR (x) ⊂ f −1 (U ).
Given x ∈ f −1 (U ), we know f (x) ∈ U . As U is open, there exists r > 0 such
that Br (f (x)) ⊂ U . Recall f is continuous at x, thus for any  > 0 there is a
δ > 0 such that |x − y| < δ implies |f (x) − f (y)| < . Choosing  = r, ﬁnd δ.
Then continuity tells us
f (Bδ (x)) ⊂ Br (f (x)) ⊂ U.
It follows immediately that Bδ (x) ⊂ f −1 (U ). Thus, f −1 (U ) is open.', 'source' => 'MIT OpenCourseWare, 18.024 Multivariable Calculus With Theory, Spring 2011 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
						),
					),
				),
			),
		);
	}
}
