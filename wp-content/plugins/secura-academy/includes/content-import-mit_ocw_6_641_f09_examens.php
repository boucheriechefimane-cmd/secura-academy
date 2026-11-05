<?php
/**
 * Questions importees — MIT OpenCourseWare — 6 641 electromagnetic fields forces and motion spring 2009
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.641 Electromagnetic Fields Forces And Motion, Spring 2009 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_641_f09_examens' ) ) {
	function seca_import_mit_ocw_6_641_f09_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-641-f09-examens', 'nom' => 'MIT OpenCourseWare — 6 641 electromagnetic fields forces and motion spring 2009', 'url' => 'https://ocw.mit.edu/courses/6-641-electromagnetic-fields-forces-and-motion-spring-2009/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.641 Electromagnetic Fields Forces And Motion, Spring 2009 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'les-fondamentaux-du-reseau' => array(
					'title' => 'les-fondamentaux-du-reseau',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.641 — question d’examen, en anglais] The potential on an infinitely long cylinder of radius a is constrained to be Φ (r = a, φ ) = Vo cos nφ The cylinder has permittivity ε and is surrounded by free space. (a) Find the potential and electric field everywhere inside and outside the cylinder. (b) What is the surface charge distribution on the cylindrical surface at r=a? (c) y Vo V = 2 a φ Vo                                                           x V =− 2 ε εo The potential is now changed so that it is constant on each half of the cylinder: ⎧            π       π ⎪⎪ Vo / 2, − 2 < φ < 2 Φ ( r = a, φ ) = ⎨ ⎪− V / 2, π < φ < 3π ⎪⎩ o      2        2 Write this square wave of potential as a Fourier series. (d) Use the results of
The potential on an infinitely long cylinder of radius a is constrained to be
Φ (r = a, φ ) = Vo cos nφ
The cylinder has permittivity ε and is surrounded by free space.
(a) Find the potential and electric field everywhere inside and outside the cylinder.
(b) What is the surface charge distribution on the cylindrical surface at r=a?
(c)
y
Vo
V =
2
a
φ
Vo                                                           x
V =−
2
ε
εo
The potential is now changed so that it is constant on each half of the cylinder:
⎧            π       π
⎪⎪ Vo / 2, − 2 < φ < 2
Φ ( r = a, φ ) = ⎨
⎪− V / 2, π < φ < 3π
⎪⎩ o      2        2
Write this square wave of potential as a Fourier series.
(d) Use the results of (a) and (c) to find the potential distribution due to this square wave of
potential.
PS#6, p.1
Problem 6.2
We wish to find', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : A
1 ∂2Φ ∂2Φ
�            �
1 ∂            ∂Φ
�2 Φ =              r            +          +
r ∂r           ∂r           r2 ∂φ2   ∂z 2
Azimuthal symmetry ⇒ ∂Φ
∂φ = 0.
∂2Φ
�            �
21 ∂              ∂Φ
� Φ=                r            +        =0
r ∂r             ∂r             ∂z 2
Guess Φ = R(r)Z(z)
∂ 2 (R(r)Z(z))
�               �
1 ∂     ∂ (R(r)Z(z))
r                +                =0
r ∂r         ∂r                 ∂z 2
∂ 2 Z(z)
�         �
Z(z) ∂      ∂R(r)
r         = −R(r)
r ∂r       ∂r                 ∂z 2
Divide by Z(z)R(r):
1 ∂ 2 Z(z)
�         �
1 ∂       ∂R(r)
r         =−
rR(r) ∂r      ∂r        Z(z) ∂z 2
�        ��        � �     ��     �
only r                            only z
So, to be true for all x, y, both sides must equal the same constant. For this problem, we are asked to set
that constant to zero
1 ∂ 2 Z(z)       ∂ 2 Z(z)
−               = 0 ⇒          =0
Z(z) ∂z 2           ∂z 2
3
Problem Set 6                                                              6.641, Spring 2009
⇒ Z(z) = Az + B
�         �         �     �
1 ∂        ∂R(r)         ∂    ∂R
r         =0⇒      r      =0
rR(r) ∂r      ∂r          ∂r    ∂r
�       �
∂R                    C
⇒r     = C ⇒ dR =          dr
∂r                   r
So, R(r) = C ln r + D, And
Φ(r, z) = (Az + B)(C ln r + D)
B
Φ(r ≤ a, l) = V0          Φ(r, z = 0) = 0
Φ(r = b, z) = 0          Φ(r = a+ , z) = Φ(r = a− , z)
Φ(r = 0, z) = ﬁnite
C
0 ≤ r ≤ a :Φ(1) (r, z) = Az + Bz ln r + C ln r + D
Φ(1) (r = 0, z) is ﬁnite ⇒ B = C = 0
V0 z
Φ(1) (r, l) = V0 , Φ(1) (r, 0) = 0 ⇒ Φ(1) =
l
a ≤ r ≤ b :Φ(2) (r, z) = Ez + F z ln r + G ln r + H
Φ(2) (b, z) = 0 ⇒ E = F (− ln b) and H = G(− ln b)
r     r
so Φ(2) (r, z) = F z ln + G ln
b     b
(2)                (2)       r
Φ (r, 0) = 0 ⇒ Φ = F z ln
b
V0 z      r
Φ (r = a, z) = Φ (r = a, z) ⇒ Φ(2) =
(1)                (2)
ln
l ln ab    b
D
⎛        0       ⎞
→
−           ⎜ ∂Φ         ∂Φ�      ∂Φ ⎟
E = −�Φ = − ⎝îr    + îφ � + îz
∂r       ∂φ      ∂z
⎠
�
�          �
→(1)
−                        → V0 z
− (1)        V0
0≤r<a: E    = −�            ⇒E        = −îz
l          l
�                �
− (2)
→               V0 z      r
a≤r≤b: E     = −�       � a � ln
l ln b       b
V0 z 1             V0         r
= −îr          − îz           ln
l ln ab r         l ln ab      b
→(2)
−           V0    �     z             r�
E    =−             îr    +   îz ln
l ln ab       r             b
4
Problem Set 6                                                                6.641, Spring 2009
E
→(2)
−                  →(1)
−
�                                      �
+                  −
n̂
����  ε 0 E    (r = a  ) − ε E    (r = a  )   = σsf
îr
V0 z
−ε0               + 0 = σsf
l ln ab a
ε0 V0 z
σsf = −
al ln ab
F
→
− (2)
We need Φ(2) and E
V� 0 z0 r0    V�0z  r
Φ(2) (r = r0 , z = z0 ) = � a ln      = � a ln
l� ln�    b   l ln�  b
�b          �� b
Equipot.: z0 ln rb0 = z ln rb
Field Lines
(2)  z
dr      Er                 z
= (2) = r r =           r
dz      Ez     ln  b    r ln b
�              �
r
r ln dr = zdz
b
2
r      � r � r2      z2
ln      −    =      +c
2        b    4      2
At r = r0 and z = z0
r02 � r0 � r02  z2
c=         ln     −    − 0
2      b    4    2
Are they perpendicular? For E-ﬁeld:
�E-ﬁeld
dr ��                    z0
=
dz �(r,z)=(r0 ,z0 )   r0 ln rb0
For Equipot:
�equipot
dr ��                 −r0 ln rb0
=
dz �(r,z)=(r0 ,z0 )      z0
�       �equipot � � �E-ﬁeld �
dr ��           dr ��
= −1
dz �            dz �
Problem 6.3
Sphere, initial conditions: At t = 0, p(t) = 0. No charge anywhere. Dipole
�
0 t<0
p(t) =
p t≥0Problem Set 6                                                                                             6.641, Spring 2009
�                �       �             �
2C (t)                 C (t)
Êout = −�Φout =                   cos θ   îr +         sin θ   îθ
r3                     r3
�                 �
p0 u(t)           2C(t)
ε0               − A(t)  =ε 3                                                                                 (1)
2πε0 a3            a
II. Also, Φ is continuous at r = a, so
p0 u(t)         C(t)
3
+ A(t) = 3                                                                                            (2)
4πε0 a           a
Add 1 and 2 to get 3p0 u(3t) = (2ε+ε03)C(t) . Substitute C(t) = 4π(2ε+ε
3p0 u(t)
0)
.
4π�a            �a
p0 u(t)                 3p0 u(t)
3
+ A(t) =
4πε0 a             4π(2ε + ε0 )a3
p0 (ε0 −ε)u(t)
Therefore A(t) = 2πε 0 (ε0 +2ε)a
3
So at t = 0+
�                                     �
p0 (ε0 − ε)r       p0
Φin =                      +                    u(t) cos θ    r≤a
2πε0 (ε0 + 2ε)a3   4πε0 r2
3p0
Φout =                   u(t) cos θ         r≥a
4π(ε0 + 2ε)r2
B
For t → ∞ at steady state, ∂σ
∂t = 0
s
0        �        ∂σs
(σout Eout,r − �
σ in Ein,r )�r=a = −     =0              (σ = 0 inside sphere)
∂t
p0 u(t)                      p0 u(t)
Therefore in steady state C(t) = 0. If C(t) = 0, then 4πε   3 + A(t) = 0, A(t) = − 4πε a3 . So for t → ∞ in
0a                           0
steady state
�                   �
p0       p0 r
Φin =             −           u(t) cos θ r ≤ a
4πε0 r2   4πε0 a3
Φout = 0       r≥a
C
⎛                                            ⎞
⎟ − τt
Recall that Φ(t) =              Φss              + ⎝ Φ(t = 0+ ) −                 Φss          ⎠ e . We already have these
⎜
����                 � �� �                       ����
steady state potential        initial potential   steady state potential
terms. We have to ﬁnd the time constant τ .
∂ �
σEr (r = a+ ) +       εEr (r = a+ ) − ε0 Er (r = a− ) = 0
�
∂t
�         �        �                            �
2σC(t)        ∂     2C(t) p0 u(t)
+        ε 3 −             + ε0 A(t) = 0
a3        ∂t       a       2πa3
ε0 C(t) p0 u(t)
ε0 A(t) =          −
a3        4πa3
�         �             � �               �          �
2ε + ε0 ∂               2σ           ∂ 3p0 u(t)
C(t)  +       C(t)  =                  =0 t>0
a3     ∂t            a3           ∂t 4πε0 a3
so τ = 2ε+ε
2σ .
0
7
Problem Set 6                                                                          6.641, Spring 2009
D
�0
�                        �
0+ ) − σs (t → ∞) e−t/τ
�
σs (t) = σs (t → ∞) + �σs�
(t �
=�
�         �
= σs (t → ∞) 1 − e−t/τ
0
σs (t → ∞) = εE
�r (r = a+ , t → ∞) − ε0 Er (r = a− , t → ∞)
�
∂Φin ��
= ε0
∂r �r=a− ,t→∞
3p0 cos θ �       −t/τ
�     2ε + ε0
=−           3
1  − e        ,τ=
4πε0 a                        2σ
Problem 6.4
As no free current inside and outside the sphere, Maxwell’s equations for MQS gives:
¯ =0
� · B̄ = 0, � × H
Here
H̄ = −�χ
So
�2 χ = 0
The general solution for Laplace’s equation in spherical coordinates is
χ = Ar cos θ   r<R
χ = (Dr + C/r2 ) cos θ      r>R
The magnetic ﬁeld is
�                                        �
∂χ       1 ∂χ          1 ∂χ
H̄ = −�χ = −           īr +      īθ +            īφ
∂r       r ∂θ       r sin θ ∂φ
= −A(cos θīr − sin θīθ ) = −Aīz      r<R
= −(D − 2C/r ) cos θīr + (D + C/r3 ) sin θīθ
3
r≥R
The boundary conditions are
H̄(r = ∞) = 0 ⇒ D = 0
Hθ (r = R+ ) = Hθ (r = R− ) ⇒ A = D + C/R3
Br (r = R+ ) = Br (r = R− ) ⇒ Hr (r = R+ ) = Hr (r = R− ) + M0 cos θ
with solutions
A = M0 /3
C = M0 R3 /3
8
Problem Set 6                                                                                6.641, Spring 2009
The scalar potential and the magnetic ﬁeld are:
M0 r
χ=        cos θ    r<R
3
M0 R 3
χ=           cos θ r > R
3r2
M0                              M0
H̄ = −      (cos θīr − sin θīθ ) = −     īz r < R
3                              3
2M0 R3              M0 R 3
=       3
cos θīr +          sin θīθ r > R
3r                  3r3
M0 R 3
�        �
=             (2 cos θīr + sin θīθ ) r > R
3r3
Problem 6.5
A
From Gauss’ law � · D̄ = ρf ⇒ n̄ · (D̄1 − D̄2 ) = σsf , the polarization surface charge is
−� · P̄ = ρp ⇒ −n̄ · (P̄1 − P̄2 ) = σsp
so σsp = Pr (r = a− ) = P0 sin φ.
B
As no free charge inside and outside the cylinder, Maxwell’s equations for EQS gives:
¯ = 0, � × E
�·D          ¯=0
Here Ē = −�Φ, So �2 Φ = 0. The general solution for Laplace’s equation in cylindrical coordinates is
Φ = Ar sin φ      r≤a
= (Br + C/r) sin φ        r≥a
The electric ﬁeld is
�                                �
∂Φ       1 ∂Φ       ∂Φ
Ē = −�Φ = −             īr +      īφ +    īz
∂r       r ∂φ       ∂z
= −A(sin φīr + cos φīφ )     r≤a
= −(B − C/r2 ) sin φīr − (B + C/r2 ) cos φīφ         r≥a
The boundary conditions are
Ē(r = ∞) = 0 ⇒ B = 0
Φ(r = a+ ) = Φ(r = a− ) ⇒ Aa = C/a
ε0 Er (r = a+ ) = ε0 Er (r = a− ) + P0 sin φ
with solutions
P0            P0 a2
A=       ,   C=
2ε0            2ε0
9
Problem Set 6                                           6.641, Spring 2009
The scalar potential and the electric ﬁeld are
P0 r
Φ=         sin φ    r≤a
2ε0
P0 a2
=         sin φ    r≥a
2ε0 r
P0
Ē = −       (sin φīr + cos φīφ )   r<a
2ε0
P0 a2             P0 a 2
=          sin φīr −        cos φīφ   r>a
2ε0 r2            2ε0 r2
10', 'source' => 'MIT OpenCourseWare, 6.641 Electromagnetic Fields Forces And Motion, Spring 2009 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('L\'inverse de s to laplace’s equation in cylindrical coordinates that have
azimuthal symmetry so that the potential is independent of the angle φ , φ(r , z ) .
(a) guess a product solution of the form
φ (r , z ) = r (r ) z ( z )
and find the zero separation constant solutions only. for these solutions of r(r) and
z(z) write down the general form for the potential.
(b)
an ohmic conducting cylinder
with conductivity σ , permittivity
ε , radius a, and height a is
surrounded by free space and a
grounded perfectly conducting
cylindrical can of radius b open at
one end. a voltage v0 is applied at
the top of the resistive cylinder.
what are the boundary conditions
on the potential at z=0, at z= a for
r<a, and at r=b? what does
[φ (r = a+ , z = a) − φ (r = a− , z = a)]
equal?
(c) use the general solutions from part (a) in each region for 0 ≤ r ≤ a and a ≤ r ≤ b
together with the boundary conditions in part (b) to find the potential distribution
everywhere for 0<r<b and 0 < z < a .
(d) what is the electric field distribution?
(e) what is the free surface charge distribution and total charge on the interface at r=a?
(f) what is the equation of the equipotential line and of the electric field line in the free
space region that passes through the coordinate (r0, z0) where a< r0<b and 0 < z < a .
prove that the equipotential line and the electric field line cross perpendicularly.
dr e r                 r2        r2
hint:    =     ; ∫ r ln rdr = ln r −
dz e z                  2        4
ps#6, p.2
problem 6.3
an electric dipole having a z-directed moment p(t) is situated at the origin and at the center
of a spherical cavity of free space having a radius r in a material having uniform ε and σ .
when t < 0, p = 0 and there is no free charge anywhere. the dipole is a step function of
time, instantaneously assuming a moment p0 when t = 0.
(a) an instant after the dipole is established, what is the distribution of φ inside and
outside the cavity?
(b) long after the electric dipole is turned on and the fields have reached a steady state,
what is the distribution of φ ?
(c) determine φ (r ,θ , t ) .
(d) what is the free surface charge density at r = r?
problem 6.4
z
r
x
m = m 0 iz               μ0
a sphere of radius r is permanently magnetized as m = m 0 iz and is surrounded by free
space with magnetic permeability μ0 .
find the magnetic scalar potential χ and the magnetic field h everywhere, where
h = −∇χ .
ps#6, p.3
problem 6.5
y
a               φ
x
p = p0 iy              ε0
a dielectric cylinder of infinite length and radius a is permanently polarized as p = p0 iy and
is surrounded by free space with dielectric permittivity ε 0 . there is no free surface charge at
r = a.
(a) what is the polarization surface charge distribution at r = a?
hint: iy = sin φ ir + cos φ iφ
(b) what are the electric scalar potential φ (r , φ ) and electric field e = −∇φ .
ps#6, p.4', 'Impossible à déterminer', 's to Laplace’s equation in cylindrical coordinates that have
azimuthal symmetry so that the potential is independent of the angle φ , Φ(r , z ) .
(a) Guess a product solution of the form
Φ (r , z ) = R (r ) Z ( z )
and find the zero separation constant solutions only. For these solutions of R(r) and
Z(z) write down the general form for the potential.
(b)
An Ohmic conducting cylinder
with conductivity σ , permittivity
ε , radius a, and height A is
surrounded by free space and a
grounded perfectly conducting
cylindrical can of radius b open at
one end. A voltage V0 is applied at
the top of the resistive cylinder.
What are the boundary conditions
on the potential at z=0, at z= A for
r<a, and at r=b? What does
[Φ (r = a+ , z = A) − Φ (r = a− , z = A)]
equal?
(c) Use the general solutions from part (a) in each region for 0 ≤ r ≤ a and a ≤ r ≤ b
together with the boundary conditions in part (b) to find the potential distribution
everywhere for 0<r<b and 0 < z < A .
(d) What is the electric field distribution?
(e) What is the free surface charge distribution and total charge on the interface at r=a?
(f) What is the equation of the equipotential line and of the electric field line in the free
space region that passes through the coordinate (r0, z0) where a< r0<b and 0 < z < A .
Prove that the equipotential line and the electric field line cross perpendicularly.
dr E r                 r2        r2
Hint:    =     ; ∫ r ln rdr = ln r −
dz E z                  2        4
PS#6, p.2
Problem 6.3
An electric dipole having a z-directed moment p(t) is situated at the origin and at the center
of a spherical cavity of free space having a radius R in a material having uniform ε and σ .
When t < 0, p = 0 and there is no free charge anywhere. The dipole is a step function of
time, instantaneously assuming a moment p0 when t = 0.
(a) An instant after the dipole is established, what is the distribution of Φ inside and
outside the cavity?
(b) Long after the electric dipole is turned on and the fields have reached a steady state,
what is the distribution of Φ ?
(c) Determine Φ (r ,θ , t ) .
(d) What is the free surface charge density at r = R?
Problem 6.4
z
R
x
M = M 0 iz               μ0
A sphere of radius R is permanently magnetized as M = M 0 iz and is surrounded by free
space with magnetic permeability μ0 .
Find the magnetic scalar potential χ and the magnetic field H everywhere, where
H = −∇χ .
PS#6, p.3
Problem 6.5
y
a               φ
x
P = P0 iy              ε0
A dielectric cylinder of infinite length and radius a is permanently polarized as P = P0 iy and
is surrounded by free space with dielectric permittivity ε 0 . There is no free surface charge at
r = a.
(a) What is the polarization surface charge distribution at r = a?
Hint: iy = sin φ ir + cos φ iφ
(b) What are the electric scalar potential Φ (r , φ ) and electric field E = −∇Φ .
PS#6, p.4', 'Pas s to laplace’s equation in cylindrical coordinates that have
azimuthal symmetry so that the potential is independent of the angle φ , φ(r , z ) .
(a) guess a product solution of the form
φ (r , z ) = r (r ) z ( z )
and find the zero separation constant solutions only. for these solutions of r(r) and
z(z) write down the general form for the potential.
(b)
an ohmic conducting cylinder
with conductivity σ , permittivity
ε , radius a, and height a is
surrounded by free space and a
grounded perfectly conducting
cylindrical can of radius b open at
one end. a voltage v0 is applied at
the top of the resistive cylinder.
what are the boundary conditions
on the potential at z=0, at z= a for
r<a, and at r=b? what does
[φ (r = a+ , z = a) − φ (r = a− , z = a)]
equal?
(c) use the general solutions from part (a) in each region for 0 ≤ r ≤ a and a ≤ r ≤ b
together with the boundary conditions in part (b) to find the potential distribution
everywhere for 0<r<b and 0 < z < a .
(d) what is the electric field distribution?
(e) what is the free surface charge distribution and total charge on the interface at r=a?
(f) what is the equation of the equipotential line and of the electric field line in the free
space region that passes through the coordinate (r0, z0) where a< r0<b and 0 < z < a .
prove that the equipotential line and the electric field line cross perpendicularly.
dr e r                 r2        r2
hint:    =     ; ∫ r ln rdr = ln r −
dz e z                  2        4
ps#6, p.2
problem 6.3
an electric dipole having a z-directed moment p(t) is situated at the origin and at the center
of a spherical cavity of free space having a radius r in a material having uniform ε and σ .
when t < 0, p = 0 and there is no free charge anywhere. the dipole is a step function of
time, instantaneously assuming a moment p0 when t = 0.
(a) an instant after the dipole is established, what is the distribution of φ inside and
outside the cavity?
(b) long after the electric dipole is turned on and the fields have reached a steady state,
what is the distribution of φ ?
(c) determine φ (r ,θ , t ) .
(d) what is the free surface charge density at r = r?
problem 6.4
z
r
x
m = m 0 iz               μ0
a sphere of radius r is permanently magnetized as m = m 0 iz and is surrounded by free
space with magnetic permeability μ0 .
find the magnetic scalar potential χ and the magnetic field h everywhere, where
h = −∇χ .
ps#6, p.3
problem 6.5
y
a               φ
x
p = p0 iy              ε0
a dielectric cylinder of infinite length and radius a is permanently polarized as p = p0 iy and
is surrounded by free space with dielectric permittivity ε 0 . there is no free surface charge at
r = a.
(a) what is the polarization surface charge distribution at r = a?
hint: iy = sin φ ir + cos φ iφ
(b) what are the electric scalar potential φ (r , φ ) and electric field e = −∇φ .
ps#6, p.4'), 'correct' => 2, 'answer' => 's to Laplace’s equation in cylindrical coordinates that have
azimuthal symmetry so that the potential is independent of the angle φ , Φ(r , z ) .
(a) Guess a product solution of the form
Φ (r , z ) = R (r ) Z ( z )
and find the zero separation constant solutions only. For these solutions of R(r) and
Z(z) write down the general form for the potential.
(b)
An Ohmic conducting cylinder
with conductivity σ , permittivity
ε , radius a, and height A is
surrounded by free space and a
grounded perfectly conducting
cylindrical can of radius b open at
one end. A voltage V0 is applied at
the top of the resistive cylinder.
What are the boundary conditions
on the potential at z=0, at z= A for
r<a, and at r=b? What does
[Φ (r = a+ , z = A) − Φ (r = a− , z = A)]
equal?
(c) Use the general solutions from part (a) in each region for 0 ≤ r ≤ a and a ≤ r ≤ b
together with the boundary conditions in part (b) to find the potential distribution
everywhere for 0<r<b and 0 < z < A .
(d) What is the electric field distribution?
(e) What is the free surface charge distribution and total charge on the interface at r=a?
(f) What is the equation of the equipotential line and of the electric field line in the free
space region that passes through the coordinate (r0, z0) where a< r0<b and 0 < z < A .
Prove that the equipotential line and the electric field line cross perpendicularly.
dr E r                 r2        r2
Hint:    =     ; ∫ r ln rdr = ln r −
dz E z                  2        4
PS#6, p.2
Problem 6.3
An electric dipole having a z-directed moment p(t) is situated at the origin and at the center
of a spherical cavity of free space having a radius R in a material having uniform ε and σ .
When t < 0, p = 0 and there is no free charge anywhere. The dipole is a step function of
time, instantaneously assuming a moment p0 when t = 0.
(a) An instant after the dipole is established, what is the distribution of Φ inside and
outside the cavity?
(b) Long after the electric dipole is turned on and the fields have reached a steady state,
what is the distribution of Φ ?
(c) Determine Φ (r ,θ , t ) .
(d) What is the free surface charge density at r = R?
Problem 6.4
z
R
x
M = M 0 iz               μ0
A sphere of radius R is permanently magnetized as M = M 0 iz and is surrounded by free
space with magnetic permeability μ0 .
Find the magnetic scalar potential χ and the magnetic field H everywhere, where
H = −∇χ .
PS#6, p.3
Problem 6.5
y
a               φ
x
P = P0 iy              ε0
A dielectric cylinder of infinite length and radius a is permanently polarized as P = P0 iy and
is surrounded by free space with dielectric permittivity ε 0 . There is no free surface charge at
r = a.
(a) What is the polarization surface charge distribution at r = a?
Hint: iy = sin φ ir + cos φ iφ
(b) What are the electric scalar potential Φ (r , φ ) and electric field E = −∇Φ .
PS#6, p.4', '_recupere_le' => '2026-11-04T19:55:22.744016+00:00Z', '_strategie' => 'separation_enum_solution'),
						),
					),
				),
			),
		);
	}
}
