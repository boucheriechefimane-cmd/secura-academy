<?php
/**
 * Questions importees — MIT OpenCourseWare — 6.262 Discrete Stochastic Processes (Spring 2011)
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_262_examens' ) ) {
	function seca_import_mit_ocw_6_262_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-262-examens', 'nom' => 'MIT OpenCourseWare — 6.262 Discrete Stochastic Processes (Spring 2011)', 'url' => 'https://ocw.mit.edu/courses/6-262-discrete-stochastic-processes-spring-2011/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.262 — question d’examen, en anglais]
A ﬁnal exam is started at time 0 for a class of n students. Each student
is allowed to work until completing the exam. It is known that each student’s time to
complete the exam is exponentially distributed with density fX (x) = e x ; x 0. The
times X1 , . . . , Xn are IID.
Let Z be the time at which the last student ﬁnishes. Show that Z has a distribution
function FZ (z) given by [1 exp( z]n .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Note that Z  t if and only if Xi  t for each i, 1  n, so
n
Y
Pr{Z  t} =         Pr{Xi  t} = [1    exp(   t)]n
i=1', 'source' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011'),
							array('question' => '[MIT 6.262 — question d’examen, en anglais]
A Yule process is a continuous time version of a branching process with
the special property that the process never decreases. The process starts at time 0 with
one organism. This organism splits into two organisms after a time Y1 with the density
fY1 (y) = e y , y      0. Each of these two organisms splits into two more organisms
after independent exponentially distributed delays, each with this same density e y . In
general, each old and new organism continues to split forever after a delay y with this
same density exp( y).
Let T1 be the time at which the ﬁrst organism splits, and for each i > 1, let Ti be
the interval from the i 1st splitting until the ith. Show that Ti is exponential with
parameter i and explain why the Ti are independent.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let T1 be the time at which the ﬁrst organism splits, and for each i > 1, let Ti be
the interval from the i 1st splitting until the ith. Show that Ti is exponential with
parameter i and explain why the Ti are independent.', 'source' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011'),
							array('question' => '[MIT 6.262 — question d’examen, en anglais]
A Yule process is a continuous time version of a branching process with
the special property that the process never decreases. The process starts at time 0 with
one organism. This organism splits into two organisms after a time Y1 with the density
fY1 (y) = e y , y      0. Each of these two organisms splits into two more organisms
after independent exponentially distributed delays, each with this same density e y . In
general, each old and new organism continues to split forever after a delay y with this
same density exp( y).
Let X(t) be the number of organisms at time t > 0. Express the distribution function
of X(t) for each t > 0 in terms of Sn for each n. Show that X(t) is a rv for each t > 0
(i.e., show that X(t) is ﬁnite WP1).', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Let X(t) be the number of organisms at time t > 0. Express the distribution function
of X(t) for each t > 0 in terms of Sn for each n. Show that X(t) is a rv for each t > 0
(i.e., show that X(t) is ﬁnite WP1).', 'source' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011'),
							array('question' => '[MIT 6.262 — question d’examen, en anglais]
A Yule process is a continuous time version of a branching process with
the special property that the process never decreases. The process starts at time 0 with
one organism. This organism splits into two organisms after a time Y1 with the density
fY1 (y) = e y , y      0. Each of these two organisms splits into two more organisms
after independent exponentially distributed delays, each with this same density e y . In
general, each old and new organism continues to split forever after a delay y with this
same density exp( y).
Is {Sn ; n     1} either a martingale or a submartingale?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Is {Sn ; n     1} either a martingale or a submartingale?', 'source' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011'),
							array('question' => '[MIT 6.262 — question d’examen, en anglais]
A queueing system has four queues in the conﬁguration shown. Each queue
is identical, with a single server with IID exponential service times, each with density
µe µx . The service times are IID both within each queue and between each queue.
The left most queue (queue 1, say) is M/M/1 with an input which is a Poisson process
of rate < µ. Assume that this process started at time 1. The inputs to the other
queues are indicated in the ﬁgure below. More speciﬁcally, each output from queue 1
is switched to one of the intermediate queues, say queues 2 and 3. Each output goes to
queue 2 with probability Q and to queue 3 with probabiity 1-Q. These switching decisions
are independent of the inputs and outputs from queue 1. The outputs from queues 2 and
3 are them combined and pass into queue 4.
?/M/1
-
@
M/M/1                                      @             ?/M/1
µ
Q                          @
-                                 @
R -                     -
@                                ✓
µ          @1 Q            ?/M/1
µ
@
@ -
µ
Describe the output process from queue 1. That is, describe whether it is a renewal
process, and if so, whether it is a Poisson process. At what rate do customers leave queue
1? What can you say about the relation between the outputs and the inputs of queue 1?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : From Burke’s theorem, the output process from queue 1 is a Poisson process
of rate . For any t, the output epochs before t are independent of the input epochs after
t. Similarly, by reversibility, the output epochs after t are independent of the input epochs
before t.', 'source' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011'),
							array('question' => '[MIT 6.262 — question d’examen, en anglais]
A queueing system has four queues in the conﬁguration shown. Each queue
is identical, with a single server with IID exponential service times, each with density
µe µx . The service times are IID both within each queue and between each queue.
The left most queue (queue 1, say) is M/M/1 with an input which is a Poisson process
of rate < µ. Assume that this process started at time 1. The inputs to the other
queues are indicated in the ﬁgure below. More speciﬁcally, each output from queue 1
is switched to one of the intermediate queues, say queues 2 and 3. Each output goes to
queue 2 with probability Q and to queue 3 with probabiity 1-Q. These switching decisions
are independent of the inputs and outputs from queue 1. The outputs from queues 2 and
3 are them combined and pass into queue 4.
?/M/1
-
@
M/M/1                                      @             ?/M/1
µ
Q                          @
-                                 @
R -                     -
@                                ✓
µ          @1 Q            ?/M/1
µ
@
@ -
µ
Describe the output processes from queues 2 and 3. Are they Poisson, and what is
the relationship between them? What is the rate at which customers leave each of these
queues?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : By Burke’s theorem, again, the outputs from Queue 2 and that from Queue
3 are Poisson. The two are independent of each other since the inputs are independent.', 'source' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011'),
							array('question' => '[MIT 6.262 — question d’examen, en anglais]
A queueing system has four queues in the conﬁguration shown. Each queue
is identical, with a single server with IID exponential service times, each with density
µe µx . The service times are IID both within each queue and between each queue.
The left most queue (queue 1, say) is M/M/1 with an input which is a Poisson process
of rate < µ. Assume that this process started at time 1. The inputs to the other
queues are indicated in the ﬁgure below. More speciﬁcally, each output from queue 1
is switched to one of the intermediate queues, say queues 2 and 3. Each output goes to
queue 2 with probability Q and to queue 3 with probabiity 1-Q. These switching decisions
are independent of the inputs and outputs from queue 1. The outputs from queues 2 and
3 are them combined and pass into queue 4.
?/M/1
-
@
M/M/1                                      @             ?/M/1
µ
Q                          @
-                                 @
R -                     -
@                                ✓
µ          @1 Q            ?/M/1
µ
@
@ -
µ
Find the expected delay through the entire system for those customers going through
queue 2.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The expected delay is the sum of the expected delays through the 3 queues,
i.e., µ 1 + µ 1Q + µ 1 . One can go one step further here and claim that the 3 waiting
times are independent of each other.
6
6.262 Discrete Stochastic Processes
Spring 2011
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011'),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.262 — question d’examen, en anglais]
A ﬁnal exam is started at time 0 for a class of n students. Each student
is allowed to work until completing the exam. It is known that each student’s time to
complete the exam is exponentially distributed with density fX (x) = e x ; x 0. The
times X1 , . . . , Xn are IID.
Let T1 be the time at which the ﬁrst student leaves. Show that the probability density
of T1 is given by n e n t . For each i, 2  i  n, let Ti be the interval from the departure
of the i 1st student to that of the ith. Show that the density of each Ti is exponential
and ﬁnd the parameterP  of that exponential density. Explain why each Ti is independent.
Finally note that Z = ni=1 Ti .', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : You can view T1 as the time of the ﬁrst arrival out of n Poisson processes
each of rate . Thus T1 is exponential with parameter n . More directly yet, T1 > t if
and only if Xi > t for 1  i  t, so Pr{T1 > t} = [exp( t)]n = exp( n t). The time T2
is the remaining time until the next student out of the remaining n 1 ﬁnishes. Because
of the memorylessness of the exponential distribution, each of these n 1 students has
an exponential time to go, so Pr{T2 > t2 } = exp( (n 1) t2 ). Each of these times-to-go
is independent of T1 , so T2 is independent of T1 .
In the same way Ti is exponential wih parameter (n i + 1) and is independent of the
earlier Ti ’s. Finally the remaining time T1 from the next to last to the last student is
exponential with parameter . It is curious and somewhat unintuitive that the expected
times between departures increases with the longest time 1/ for the last (but of course
this is a property of exponential rv’s rather than real students).
P
Note also that Z = ni=1 T1 has the very simple distribution given in part a). This was
the reason for this problem, to derive the distribution function of a sum of exponential
rv’s of harmonically related expected values.
1', 'source' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011'),
							array('question' => '[MIT 6.262 — question d’examen, en anglais]
A Yule process is a continuous time version of a branching process with
the special property that the process never decreases. The process starts at time 0 with
one organism. This organism splits into two organisms after a time Y1 with the density
fY1 (y) = e y , y      0. Each of these two organisms splits into two more organisms
after independent exponentially distributed delays, each with this same density e y . In
general, each old and new organism continues to split forever after a delay y with this
same density exp( y).
For each n 1, let the continuous rv Sn be the time at which the nth splitting occurs,
i.e., Sn = T1 + · · · + Tn . Find a simple expression for the distribution function of Sn .
Hint: look carefully at the solution to parts a) and b) of problem 1.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : For each n 1, let the continuous rv Sn be the time at which the nth splitting occurs,
i.e., Sn = T1 + · · · + Tn . Find a simple expression for the distribution function of Sn .
Hint: look carefully at the solution to parts a) and b) of problem 1.', 'source' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011'),
							array('question' => '[MIT 6.262 — question d’examen, en anglais]
A Yule process is a continuous time version of a branching process with
the special property that the process never decreases. The process starts at time 0 with
one organism. This organism splits into two organisms after a time Y1 with the density
fY1 (y) = e y , y      0. Each of these two organisms splits into two more organisms
after independent exponentially distributed delays, each with this same density e y . In
general, each old and new organism continues to split forever after a delay y with this
same density exp( y).
Is {X(t); t 0} a countable-state Markov process? Explain carefully. If so describe
the embedded Markov chain and identify each state as positive recurrent, null recurrent,
or transient.
f ) Is {X(t); t    0} an irreducible countable-state Markov process?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Is {X(t); t 0} a countable-state Markov process? Explain carefully. If so describe
the embedded Markov chain and identify each state as positive recurrent, null recurrent,
or transient.
f ) Is {X(t); t    0} an irreducible countable-state Markov process?', 'source' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011'),
							array('question' => '[MIT 6.262 — question d’examen, en anglais]
A Yule process is a continuous time version of a branching process with
the special property that the process never decreases. The process starts at time 0 with
one organism. This organism splits into two organisms after a time Y1 with the density
fY1 (y) = e y , y      0. Each of these two organisms splits into two more organisms
after independent exponentially distributed delays, each with this same density e y . In
general, each old and new organism continues to split forever after a delay y with this
same density exp( y).
Now suppose the births of a Yule process (viewing the original organism as being born
at time 0) constitute the input to a queueing process (each birth enters the queue at
its time of birth). The queue has a single server and whenever n organisms are in the
system (queue plus server), the time to completion of service for the given organism is
exponential with rate µn . This means that if a new organism enters the queue while the
server is busy, the service rate changes according to the new number in the system. Let
Z(t) be the number in the system at time t.
h(i): Is {Z(t); t   0} a countable-state Markov process?
h(ii): Is Z(t) a rv for each t > 0 no matter what the µn are?
3
Pn', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Now suppose the births of a Yule process (viewing the original organism as being born
at time 0) constitute the input to a queueing process (each birth enters the queue at
its time of birth). The queue has a single server and whenever n organisms are in the
system (queue plus server), the time to completion of service for the given organism is
exponential with rate µn . This means that if a new organism enters the queue while the
server is busy, the service rate changes according to the new number in the system. Let
Z(t) be the number in the system at time t.
h(i): Is {Z(t); t   0} a countable-state Markov process?
h(ii): Is Z(t) a rv for each t > 0 no matter what the µn are?
2', 'source' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011'),
							array('question' => '[MIT 6.262 — question d’examen, en anglais]
A queueing system has four queues in the conﬁguration shown. Each queue
is identical, with a single server with IID exponential service times, each with density
µe µx . The service times are IID both within each queue and between each queue.
The left most queue (queue 1, say) is M/M/1 with an input which is a Poisson process
of rate < µ. Assume that this process started at time 1. The inputs to the other
queues are indicated in the ﬁgure below. More speciﬁcally, each output from queue 1
is switched to one of the intermediate queues, say queues 2 and 3. Each output goes to
queue 2 with probability Q and to queue 3 with probabiity 1-Q. These switching decisions
are independent of the inputs and outputs from queue 1. The outputs from queues 2 and
3 are them combined and pass into queue 4.
?/M/1
-
@
M/M/1                                      @             ?/M/1
µ
Q                          @
-                                 @
R -                     -
@                                ✓
µ          @1 Q            ?/M/1
µ
@
@ -
µ
Describe the input processes to queues 2 and 3. Are they Poisson, and if so, of what
rate? What is the relationship between the input process to queue 2 and that to queue
3?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : The switching simply splits one Poisson process into two independent
Poisson processes. Thus the input to queue 2 is a Poisson process of rate Q and the
input process to queue 3 is a Poisson process of rate (1 Q) .
5', 'source' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011'),
							array('question' => '[MIT 6.262 — question d’examen, en anglais]
A queueing system has four queues in the conﬁguration shown. Each queue
is identical, with a single server with IID exponential service times, each with density
µe µx . The service times are IID both within each queue and between each queue.
The left most queue (queue 1, say) is M/M/1 with an input which is a Poisson process
of rate < µ. Assume that this process started at time 1. The inputs to the other
queues are indicated in the ﬁgure below. More speciﬁcally, each output from queue 1
is switched to one of the intermediate queues, say queues 2 and 3. Each output goes to
queue 2 with probability Q and to queue 3 with probabiity 1-Q. These switching decisions
are independent of the inputs and outputs from queue 1. The outputs from queues 2 and
3 are them combined and pass into queue 4.
?/M/1
-
@
M/M/1                                      @             ?/M/1
µ
Q                          @
-                                 @
R -                     -
@                                ✓
µ          @1 Q            ?/M/1
µ
@
@ -
µ
Describe the input and output process for queue 4 (whether they are Poisson, what
their rates are, and whether they are independent)?', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : When these two independent Poisson processes from queues 2 and 3 are
combined, we get a Poisson process of rate . Thus Queue 4 is also an M/M/1 queue and
its output is Poisson at rate and the input and output bear the same relationship as
that in queue 1.', 'source' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.262 Discrete Stochastic Processes, Spring 2011'),
						),
					),
				),
			),
		);
	}
}
