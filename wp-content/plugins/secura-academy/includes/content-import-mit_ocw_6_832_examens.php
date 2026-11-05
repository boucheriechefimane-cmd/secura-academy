<?php
/**
 * Questions importees — MIT OpenCourseWare — 6.832 Underactuated Robotics (Spring 2009)
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.832 Underactuated Robotics, Spring 2009
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_832_examens' ) ) {
	function seca_import_mit_ocw_6_832_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-832-examens', 'nom' => 'MIT OpenCourseWare — 6.832 Underactuated Robotics (Spring 2009)', 'url' => 'https://ocw.mit.edu/courses/6-832-underactuated-robotics-spring-2009/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.832 Underactuated Robotics, Spring 2009'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.832 — question d’examen, en anglais]
The Simple Pendulum
(3 points) For this part, we will consider the full dynamics of the simple pendu­
lum with a constant input torque, but ignore any wrap-around effects. We wish
to numerically investigate the basin of attraction of the stable ﬁxed point for
three parameter sets: {{b = u = 0}; {b = 0.5, u = 0}; {b = 0.5, u = 2gl }}.
For each setting of the parameters, give the location of the stable ﬁxed point
and a plot of its basin of attraction over the domain x ∈ {−2π, 2π} and range
ẋ ∈ {−2 gl , 2 gl }. Use m = 1, l = 1, g = 9.8, and submit separate plots for each
parameter set.
Hint: A matlab routine containing the basic components to compute and plot the
basins of attraction for the simple pendulum is available on the course website
(calc_basin.m). The existing code creates a mesh over the state space which
you can use to keep track of what states are in the basin.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : For the case of b = u = 0 the basin of attraction has a single point; namely the fixed point at [0 0]T . The fixed
point (closest to the origin) for the case b = 0.5, u = 0 is [0 0]T . The fixed point for the case b = 0.5, u = 2gl is
[ π6 0]. The basins of attraction for the latter two cases are shown in Figure 1.
BOA for u=0,b=0.5                                          BOA for u=g/(2*l),b=0.5
1                                                                1
15                                          0.9             15                                               0.9
0.8                                                              0.8
10                                                          10
0.7                                                              0.7
5                                                           5
0.6                                                              0.6
0                                          0.5              0                                               0.5
θ̇
θ̇
0.4                                                              0.4
−5                                                          −5
0.3                                                              0.3
−10                                                         −10
0.2                                                              0.2
−15                                          0.1            −15                                               0.1
0                                                                0
−6   −4   −2      0        2   4   6                        −6   −4   −2        0         2     4   6
θ                                                             θ
Figure 1: The basins of attraction (green) for the case of b = 0.5, u = 0 (left) and b = 0.5, u = 2l
g
(right)', 'source' => 'MIT OpenCourseWare, 6.832 Underactuated Robotics, Spring 2009', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.832 Underactuated Robotics, Spring 2009'),
							array('question' => '[MIT 6.832 — question d’examen, en anglais]
The Simple Pendulum
(1 point) If you use feedback linearization to double gravity for the now effec­
tively undamped system, how will it change the undamped phase plot you found
in the last part? In addition to the torque used to cancel damping, how much
more torque must your motor be able to output to double gravity? To invert
gravity?
1 If you wish to be pedantic, project the visible sky onto a plane, accepting the distortion, and denote the
point the telescope is viewing on this plane by (x, y).
2
6.832 - Underactuated Robotics                               Problem Set 1, Spring 2009', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Doubling gravity will result in the phase plot of the now effectively undamped system “stretching” vertically, as
higher speeds will be reached , but it will remain qualitatively the same. Torque as large as mgl is required to
double gravity, while torque as large as 2mgl is required to invert it, as double gravity just requires the motor to
create and “extra” gravity, while inverting requires first canceling gravity, then adding another negative gravity
in.', 'source' => 'MIT OpenCourseWare, 6.832 Underactuated Robotics, Spring 2009', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.832 Underactuated Robotics, Spring 2009'),
							array('question' => '[MIT 6.832 — question d’examen, en anglais]
Optimal control of the double integrator
(2 points) Compare the time it takes the minimum time policy and the LQR policy
to get within .05 of the goal in both x and ẋ. How does the time for the LQR
policy change as Q is increased? When Q is set to 100 times the identity matrix
and R is kept the same, how does the time taken with LQR compare to time taken
by the min-time policy? Does this make sense?
3
6.832 Underactuated Robotics
Spring 2009
For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : This solution assumes that the actuator cap experienced by the min-time policy is not in place for the LQR policy.
If it is the LQR policy will never do as well as the min-time policy, and will not limit towards it either as once
hard limits on actuation magnitude are in place LQR loses its optimality guarantees and can start performing
very poorly.
The LQR solution required 9.89 seconds to reach the goal using Q = .25I. The min-time policy required 4.43
seconds to reach the goal. Using Q = 100I, however, resulted in a time of 4.04 seconds. This is due to the LQR
policy not having bounds on actuation, and thus being able to outperform the min-time solution through the use
of much larger actuator magnitudes than the min-time was permitted.
3
6.832 Underactuated Robotics
Spring 2009
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.832 Underactuated Robotics, Spring 2009', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.832 Underactuated Robotics, Spring 2009'),
							array('question' => '[MIT 6.832 — question d’examen, en anglais]
Now, give the Hamiltonian for this problem and the adjoint equation. Hint: To
see things in the more standard form, you might literally replace the x in your
dynamics equation and your cost function with a t (it’s perfectly legal).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The Hamiltonian is given by:
√
dz        1 + u2
H = g(x, u) + p(x)    =             + p(x)u.
dx          z
Using the fact that H must be at a minimum with respect to u allows us to write:
∂H         u
=0=p+ √
∂u      z 1 + u2
This gives us the value of the adjoint p:
u
p=− √       ,
z 1 + u2
and thus the Hamiltonian may be written:
√
1 + u2        u2        1
H=             − √         = √       .
z        z 1 + u2  z 1 + u2', 'source' => 'MIT OpenCourseWare, 6.832 Underactuated Robotics, Spring 2009', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.832 Underactuated Robotics, Spring 2009'),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.832 — question d’examen, en anglais]
The Simple Pendulum
(3 points) Using the same pendulum parameters as for the previous part, plot
the phase space trajectory of the pendulum for b = 0.5, u = 0 from the intial
condition θ = π/4, θ̇ = 0. Use feedback linearization to eliminate damping on
the system, and plot this phase space trajectory.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The trajectories for the system with u = 0 and with u = bθ̇ are shown in Figure 2. Note that the feedback
linearized system (u = bθ̇) creates a closed circuit (as would an undamped pendulum), with integration errors
accounting for any small wobble seen in the trajectory. The system with no torque spirals in towards the fixed
point, as would be expected given the damping.
Figure 2: Trajectories for the system without torque (left) and the system feedback linearized to be without damping
(right).
2', 'source' => 'MIT OpenCourseWare, 6.832 Underactuated Robotics, Spring 2009', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.832 Underactuated Robotics, Spring 2009'),
							array('question' => '[MIT 6.832 — question d’examen, en anglais]
Optimal control of the double integrator
(2 points) In class we used Pontrayagin to determine the optimal minimum time
policy to get to (0, 0) for the brick. In Matlab, encode this minimum-time policy
when |u| ≤ 1. Give the phase space trajectory of a brick following this trajectory
from the initial condition x(0) = 2, ẋ(0) = 1.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The trajectory followed by the min-time policy is much sharper and reaches higher speeds than those achieved
by the LQR. The LQR follows a much smoother path to the goal, and accelerates much less due to the cost put
on actuation, while the min-time policy is constantly using as much of its actuator as it can.
Figure 3: Trajectories for the system following the minimum time and the LQR policies.', 'source' => 'MIT OpenCourseWare, 6.832 Underactuated Robotics, Spring 2009', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.832 Underactuated Robotics, Spring 2009'),
							array('question' => '[MIT 6.832 — question d’examen, en anglais]
Compute the dynamics of the system z with respect to x (eg, ∂x = ...).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The dynamics are given as:
dz
= u.
dx', 'source' => 'MIT OpenCourseWare, 6.832 Underactuated Robotics, Spring 2009', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.832 Underactuated Robotics, Spring 2009'),
						),
					),
				),
			),
		);
	}
}
