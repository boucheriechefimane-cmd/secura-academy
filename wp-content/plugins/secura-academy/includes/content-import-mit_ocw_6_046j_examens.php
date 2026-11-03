<?php
/**
 * Questions importees — MIT OpenCourseWare — 6.046J Design and Analysis of Algorithms (Spring 2015)
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_046j_examens' ) ) {
	function seca_import_mit_ocw_6_046j_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-046j-examens', 'nom' => 'MIT OpenCourseWare — 6.046J Design and Analysis of Algorithms (Spring 2015)', 'url' => 'https://ocw.mit.edu/courses/6-046j-design-and-analysis-of-algorithms-spring-2015/pages/exams/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

If a problem has a randomized algorithm that runs in time t and returns the correct
answer with probability at least 2/3, then the problem also has a deterministic
algorithm that runs in time t and always returns the correct answer.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. Sublinear time algorithms are counterexamples, as a determin-
istic algorithm would not be able to read all of the input in the time it would take
for the sublinear time algorithm to return an answer.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

If Φ is a potential function associated with a data structure S, then 2Φ is also a
potential function that can be associated with S. Moreover, the amortized running
time of each operation with respect to 2Φ is at most twice the amortized running
time of the operation with respect to Φ.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : True. By definition, the amortized cost cˆi = ci + Φ(Di ) - Φ(Di-1 ).
If we use the potential function 2Φ, then because the actual cost is positive (and
the same), the new amortized cost is bounded by 2 times the original.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

There is an NP-hard problem with a known polynomial time randomized algo-
rithm that returns the correct answer with probability 2/3 on all inputs.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. We currently don\'t know whether there are NP-hard problems
that can be solved by polynomial time randomized algorithms, and conjecture
that these do not exist.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Problem 2. Short Answer [20 points] (4 parts)
Recall the forest-of-trees solution to the disjoint-set problem. Suppose that the only
heuristic we use is a variant of the union-by-rank heuristic: when merging two roots
u and v, we compare the number of descendants (rather than the rank), and make u a
child of v if and only if u has fewer descendants. Is this asymptotically worse than the
original union-by-rank heuristic? Explain why or why not.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : No, it is not asymptotically worse. The way that heuristics affect the
runtime is by affecting the height of the trees in the data structure. Consider some
item x in the data structure. When will the path from x to the root increase in length?
Well, it can only increase in length when the root of x changes. Let u be the old root
of x, and let v be the new root of x. Let dold (·) be the number of descendants before
the merge, and let dnew (·) be the number of descendants after the merge.
Because of the union-by-descendants heuristic, the root could only change from u to
v if dold (u) ≤ dold (v). This means that dnew (v) = dold (v) + dold (u) ≥ 2dold (u). So
every time the path from x to the root increases by 1, the number of descendants of the
root at least doubles. This means that the depth of x is at most O(lg n), just as with
the union-by-rank heuristic.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

In lecture, we saw min-radius clustering, in which the goal was to pick a subset of k
points such that each point formed the center of a cluster of radius r. Suppose instead
that the center of the cluster can be a point not in the original set.
Give an example set of points where it is possible to find k clusters of radius r centered
around arbitrary points, but impossible to find k clusters of radius r centered around
points in the set.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Given arbitrary values of k and r, we can set up a counterexample in
R2 as follows. For each i ∈ {1, . . . , k}, create two points: pi,1 = (4ri, 0.9r) and
pi,2 = (4ri, -0.9r). For any pair pi,1 and pi,2 the distance is equal to 1.8r, so any
cluster centered on one of the points cannot contain the other. For all other pairs of
points, their x-coordinates must differ by at least 4r, and so they cannot belong to the
same cluster. So there\'s no way to create k clusters centered on k points in the set.
However, there is a way to create k clusters centered on k arbitrary points: for each
i ∈ {1, . . . , k}, the point (4ri, 0) has distance ≤ r to both pi,1 and pi,2 .', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Rather than using shortest paths, you think that perhaps you can formulate this as a
flow problem. Find an algorithm to find k paths ai ❀ bj that start and end at different
vertices and that share no edges, and briefly justify the correctness and running time
of your algorithm.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The algorithm is as follows:
1. Create a flow network G′ containing all vertices in V , all directed edges in E
with capacity 1, and additionally a source vertex s and a sink vertex t. Connect
the source to each starting location with a directed edge (s, ai ) and each ending
location to the sink with a directed edge (bi , t), all with capacity 1.
2. Run Ford-Fulkerson on this network to get a maximum flow f on this network. If
|f | = k, then there is a solution; if |f | < k, then there is no solution, so we return
FALSE. We will later show that it is always the case that |f | ≤ k.
3. To extract the paths from ai to bj (as well as which starting location ultimately
connects to which ending location), run a depth-first search on the returned max
flow f starting from s, tracing a path to t. Remove these edges and repeat k times
until we have the k disjoint paths.
The running time for this algorithm is O(k|E|): in the modified graph G′ , we have
|E| + 2k = O(|E|) edges, and the maximum possible flow value is k; therefore,
running Ford-Fulkerson takes O(k|E|) time. Extracting paths takes at most O(|E|)
time, as we traverse each edge at most once. In total, then, the algorithm takes O(k|E|)
time.
Some students used Edmonds-Karp, which runs in O(V E 2 ) time. In this case, because
k = O(|V |), Ford-Fulkerson provides a better bound.
To show correctness, we must show that there is a flow of size k if and only if there
are k disjoint paths.
(→) Claim. An integral flow of size f in a network with unit capacities can be de-
composed into a unit flow over a simple path p : s ❀ t and a flow of size f - 1 which
does not use p.
Proof. Pick any simple path p : s ❀ t over edges with non-zero flow. One must exist
(otherwise, we would have a cut with no flow). In the residual graph, that path has
capacity 1; send an augmenting flow of -1 over that path. We then have a resulting
flow of size f - 1, and the flow on each of the edges of p is 0.
(←)If there is a set of k disjoint paths [...]', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Show that Zelda\'s algorithm gives a 2-approximation for the number of credit cards.
HINT: Let OP T be the optimal number of credit cards. In order for the algorithm to
add a new credit card j > OP T , it must reach xi such that xi + ′ min L[j ′ ] > ℓ.
j ∈{1,...,OP T }
It will then set L[j] = xi .', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : First, we show that the following loop invariant holds. At no point are there two
distinct cards i and j, where i < j such that the balance on each card L[j] ≤ 2l and
L[i] ≤ 2l . Suppose to the contrary that there are two such cards. Then the remaining
credit on card i was sufficient to transfer all of the purchases xi from the new credit
card to the old credit card j, instead of opening up a new credit card.
We prove that Zelda\'s algorithm gives a 2-approximation by contradiction. Namely,
we assume that there is a case where at least 2OP T + 1 cards are needed. By the loop
invariant we know that no 2 credit cards have less than 2l as a balance. So, assuming
that there are no zero purchase charges, the total amount of purchases must be more
than 2OP T · 2l , which is the maximum amount that the OP T cards in the optimal
solution can hold. This is a contradiction. So, we can always find at most 2OP T
cards to pay for all of the purchases.
This problem part was worth 10 points.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Given a particular cluster Ci , if you sample t points uniformly at random (with re-
placement), give an upper bound in terms of ǫ for the probability that none of these
points are in Ci .', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Solution The number of points in Ci is at least ǫn, so the probability that a point
sampled u.a.r. lies within Ci is at least ǫn/n = ǫ. Therefore the probability that a
point sampled u.a.r. doesn\'t lie within Ci is at most 1 - ǫ. Since the points are chosen
independently, the probability that t points sampled u.a.r. don\'t lie within Ci is at most
(1 - ǫ)t .
Grading comments This problem was relatively straightforward; the full 8 marks
were given for the correct answer. An alternative (slightly weaker) bound using Cher-
noff was also given full credit as long as it was computed correctly. When the answer
was incorrect, part marks were allotted for similarity to the solution and evidence of
work.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Give a set of microscopes and an algorithm to find the bacterium with total cost
O(n lg lg n).
SCRATCH PAPER
SCRATCH PAPER', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Executive Summary We borrow our idea from the vEB data structure. We will
i
purchase microscopes of resolutions n1/2 ,n1/4 ,n1/8 , ..., n1/2 = 2. Clearly, i = lg lg n.
So we spend n lg lg n for buying microscopes. We do a linear search at each level, and
we will show that the total cost of electricity is also n lg lg n.
Algorithm We perform √ a search for the bacterium as follow√s. First we use the mi-
croscope with resolution√ n to locate which region of size n the bacterium is in.
This will take at most n √ applications of this microscope. We can then narrow our
search in the region of size n and use microscopes of resolution n1/4 to continue this
process, eventually we can narrow down the location of the bacterium to a region of
size 2. From there, it takes one simple application of a microscope of resolution 1 to
find the bacterium.
Correctness This collection of microscopes allows us to search every region ex-
haustsively, thus we can always find the bacterium.
Cost analysis The total purchase of lg lg n microscopes √ will cost √ us n lg lg n dol-
lars. At stage 1, we use the microscope of resolution n a total of n times. Each
use of this microscope costs √nn dollars, for a total of n dollars. In fact, at every sub-
√ √
sequent step, we always apply the microscope of resolution r a total of r times to
completely scan a region of size r. The total cost of this is always n. Thus, the total
electricity cost associated with using each type of microscope is at most n. Therefore,
the total electricity cost os also n lg lg n. Our combined total cost is thus O(n lg lg n).
Grading comments The maximum points for this part is 20. 2 points are given
for some very vague mentioning of vEB, demonstrating some level of understanding.
5 points are given for the correct choice of microscope resolutions (but not how to
use them to search for the bacterium). 10 points are given if the algorithm is correct
(correct choice of resolutions as well as a description of how to use them [...]', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

In a simple, undirected, connected, weighted graph with at least three vertices and
unique edge weights, the heaviest edge in the graph is in no minimum spanning
tree.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. If the heaviest edge in the graph is the only edge
connecting some vertex to the rest of the graph, then it must be in every minimum
spanning tree.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Two polynomials p, q of degree at most n - 1 are given by their coefficients, and
a number x is given. Then one can compute the multiplication p(x) · q(x) in time
O(log n).', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. We need at least Θ(n) time to evaluate each poly-
nomial on x and to multiply the results. Some students argued incorrectly that
it must take O(n log n) using FFT, but FFT overkills because it computes all
coefficients, not just one.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

There is a density 0 < ρ < 1 such that the asymptotic running time of the Floyd-
Warshall algorithm on graphs G = (V, E) where |E| = ρ |V |2 is better than that
of Johnson\'s algorithm.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. The asymptotic running time of Floyd-Warshall is
O(V 3 ), which is at best the same asymptotic running time of Johnson\'s (which
runs in O(V E + V log V ) time), since E = O(V 2 )', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Give an example of a minimum-cost translation network that is not a minimum span-
ning tree of G.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : If the graph of translators contains a cycle of translators all
willing to work for $0, then it is possible to hire all of the translators in the cycle
without increasing the overall cost of the translation network. The smallest example
of this is the following:
A
$0 $0
$0
All three MSTs of the graph have total cost $0, so any translation network of cost $0
has minimum cost. Hence, we can take all translators in the cycle to get a minimum-
cost translation network that is not an MST.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Suppose that S is a minimum-cost high-quality translation network. Let Si = S ∩
(Ci × Ci ) be the part of the network S that lies within the cluster Ci . Show that Si is
a minimum-cost translation network for the cluster Ci .', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Let Si∗ be a minimum-cost translation network for Ci . Because
S is a high-quality translation network, Si must contain a path between every pair
of nodes in Ci , so Si is a translation network for Ci . For the sake of contradiction,
assume that Si is not minimum-cost. Then w(Si ) > w(Si∗).
Consider the translation network S ∗ = (S - Si ) ∪ Si∗ . Then w(S ∗) = w(S) - w(Si ) +
w(Si∗ ) < w(S). Because Si∗ is a translation network of Ci , replacing Si with Si∗ will
not disconnect any pair of vertices in the graph. Furthermore, any pair of vertices
connected by a path in S that lay inside a particular cluster will be connected by a
path in S ∗ that lies within the same cluster. Hence, S ∗ is a high-quality translation
network with cost strictly less than S. This contradicts the definition of S, so Si must
be a minimum-cost translation network.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

(k-1) (k-1) (k-1)
7 dij = min(dij , dik + dkj )
8 return D (n)', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : In order to find shortest paths going through only blue edges, it
suffices to ignore the red edges and run Floyd-Warshall on only the blue edges of the
graph. We make the following changes:
• Replace each occurrence of W with Wb in lines 1 and 2.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Not long after the original blog post, the founders updated their numbers. Apparently,
the original claim spurred a large number of non-MIT users to friend more MIT stu-
dents. Now, after this friending spree, every user on MITbook+ who did not attend
MIT is friends with at most 2N/5 users who did attend MIT. This also had the effect
of raising the average number of friends per user to exactly 2N/3. Given this updated
information, devise an efficient algorithm that checks whether user 60461337 went to
school at MIT.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Executive Summary. We sample four users at random until we find four who are all friends.
They are more likely than not to all be MIT students, so we check whether they are friends with
60461337 to determine whether 60461337 is also an MIT student. This algorithm has runtime O(1)
and correctness probability at least 0.51.
Algorithm. Repeat the following k = 25 times:
1. Pick four users a, b, c, d uniformly at random.
2. Check whether all four are friends. If not, continue to the next repetition of the loop.
3. Otherwise, check whether all four are friends with 60461337. If so, return "60461337 is an
MIT student." If not, return "60461337 is not an MIT student."
If we finish k iterations without finding four friends, return "FAILED."
Correctness. For simplicity, we define a number of events:
1. Let Fab be the event that a and b are friends.
2. Let Fcd be the event that c and d are friends.
3. Let Fall be the event that all four random users are all friends.
4. Let Mab be the event that both a and b attended MIT.
5. Let Mcd be the event that both c and d attended MIT.
6. Let Mall be the event that all four random users attended MIT.
In order to correctly analyze the probability of correctness, we need to do some calculations. The
average number of friends per user is 2N/3. Therefore, the total number of friendships is N ·
(2N/3)/2 = N 2 /3. The number of friendships involving only MIT students is (2N/3) · (2N/3 -
1)/2 = 2N 2 /9 - N/3. This means that the number of friendships involving at least one user not
from MIT is N 2 /3 - (2N 2 /9 - N/3) = N 2 /9 + N/3. In order for a and b to be friends when they
are not both from MIT, they must be part of just such a friendship. Hence:
N 2 /9 + N/3 2 2
Pr[Fab ∧ ¬Mab ] = 2 · = +
N 2 9 3N
By symmetry, Pr[Fcd ∧ ¬Mcd ] = Pr[Fab ∧ ¬Mab ]. We can use this information to analyze cases as
follows:
• Case 1: We want to figure out Pr[Fall ∧ Mab ∧ Mcd ]. This is equal to the probability that a,
b, c, and d are all unique MIT students. [...]', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

A perfect hash table that is already built requires 2 hash functions, one for the
first level hash, and another for the second level hash.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. In the implementation of perfect hashing which we discussed in
recitation, the second level hash table requires a different hash function for every
bucket. Note that if we relax the requirement for taking only O(n) space and
allow the hash table to instead take O(n2 ) space, then we can use just one hash
function.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

If we use van Emde Boas (vEB) to sort n elements, it is possible to achieve
O(n lg lg n) running time. Thus, whenever we need to use traditional O(n lg n)
sorting, we can replace it with vEB sort and achieve a better asymptotic running
time (ignore setup time).', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. In order to use van Emde Boas, we must have a restriction on
the input (it is within a universe of integers size 1 through n).', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Every special case of an NP-hard problem is also NP-hard.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. Consider the MST problem, which is a special case of the
Steiner Tree problem.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Suppose we apply Huffman coding to an alphabet of size 4, and the resulting tree is
a perfectly balanced binary tree (one root with two children, each of which has two
children of its own). Find the maximum frequency of any letter.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The maximum frequency of any letter is 2/5. To see why, we must prove
that this is both feasible, and as large as possible.
1. Suppose that we have four characters a, b, c, d with frequencies fa = 2/5 and fb =
fc = fd = 1/5. Without loss of generality, suppose that Huffman\'s algorithm
merges c and d. Then fcd = fc + fd = 2/5. This introduces a tie1 , which we may
break by assuming that Huffman\'s algorithm chooses to merge b with a. This
yields a perfectly balanced tree.
2. To see that any frequency greater than 2/5 is impossible, let fa ≥ fb ≥ fc ≥
fd be the frequencies in decreasing order. We define these frequencies so that
fa + fb + fc + fd = 1. For the sake of contradiction, suppose that fa > 2/5.
This means that fb + fc + fd < 3/5. Because fb > fc , fd , we can conclude that
fc + fd < 2/5. But this means that when c and d are merged, their combined
frequency will be strictly less than fa , so we will not get a perfectly balanced
tree.
To avoid a tie, we must use 2/5 - ǫ as the maximum frequency instead.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Problem 3. Estate Showing. [30 points] (3 parts)
Trip Trillionaire is planning to give potential buyers private showings of his estate, which can
be modeled as a weighted, directed graph G containing locations V connected by one-way roads
E. To save time, he decides to do k of these showings at the same time, but because they were
supposed to be private, he doesn\'t want any of his clients to see each other as they are being driven
through the estate.
Trip has k grand entrances to his estate, A = {a1 , a2 , . . . , ak } ⊂ V . He wants to take each of
his buyers on a path through G from their starting location ai to some ending location in B =
{b1 , b2 , . . . , bk } ⊂ V , where there are spectacular views of his private mountain range.
Because of your prowess with algorithms, he hires you to help him plan his buyers\' visits. His goal
is to find a path for each buyer i from the entrance they take, ai , to any ending location bj such that
no two paths share any edges, and no two buyers end in the same location bj .
Trip tells you his idea: find all-pairs shortest paths on G, and then try to select k of
those shortest paths ai ❀ bj such that all k paths start and end at different vertices and
no two paths share any edges.
Give a graph where there exists a set of paths satisfying the requirements, but where
Trip\'s strategy won\'t find it.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Consider this graph:
a1
b1
1 1
1 1
b2
a2
The all-pairs shortest paths algorithm would find all shortest paths from ai to bj (a1 ❀
b1 , a1 ❀ b2 , a2 ❀ b1 , and a2 ❀ b2 ), which all go through the same edge. Trip\'s
algorithm, which considers only those paths, would find no solution. There are two
completely disjoint paths using the shortest path a2 ❀ b2 and the direct edge (a1 , b1 ),
but Trip\'s algorithm would not find this combination because one of them is not a
shortest path.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Trip, after trying out the paths found by your algorithm, realizes that making sure the k
paths don\'t share edges isn\'t enough: it\'s possible that some paths will share vertices,
and his buyers might run into each other where their paths intersect.
a1 b1 a1 b1
a2 a2
b2 b2
a1 b1 and a2 b2 share a vertex a1 b1 and a2 b2 share neither vertices nor edges
Modify your algorithm to find k paths ai ❀ bj that start and end in different locations,
and that share neither vertices nor edges.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Duplicate each vertex v into two vertices vin and vout , with a directed edge
between them. All edges (u, v) now become (u, vin ); all edges (v, w) now become
(vout , w). Assign the edge (vin , vout ) capacity 1.
With this transformation, we now have a graph in which there is a single edge cor-
responding to each vertex, and thus any paths that formerly shared vertices would be
forced to share this edge.
Now, we can use the same algorithm as in part (b) on the modified graph to find k
disjoint paths sharing neither edges nor vertices, if they exist.
The transformation of the graph takes O(|E|) time, as we are adding that many new
vertices and edges to the graph. The new graph has O(|E| + |V | + 2k) = O(|E|)
edges, and therefore the running time is unchanged.
Many students excluded the starting and ending locations ai and bi from the vertices
duplicated. This approach, however, would overlook any paths that might have gone
through some ai or bi before reaching their final destinations. (There was nothing in
the previous problem statement preventing this from occurring.)
As in part (b), some students also tried to modify the operation of Ford-Fulkerson by
removing all edges incident to vertices in the augmenting paths found, thus not allow-
ing any other augmenting paths to go through those vertices. Again, this approach
doesn\'t work because it is too greedy: the augmenting paths found by Ford-Fulkerson
are not necessarily the final paths along which there are units of flow, and therefore
this approach may miss valid solutions.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Show that minimizing the number of credit cards used is NP-hard.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : We prove that minimizing the number of credit cards is NP-hard by reducing SET-
PARTITION to the Zelda\'s problem in polynomial time.
First, we recast Zelda\'s optimization problem as a decision problem. Let the decision
problem be formulated as follows: For a given target number of cards k, we are able
to come up with an assignment of purchases x1 . . . xn to k credit cards, where the
cumulative balance on each credit card can not exceed the limit l.
Recall that we defined SET-PARTITION as follows:
Given set SP= {s1 , P
. . . sn } we can partition them into 2 disjoint subsets A and B such
that max{ i∈A si , j∈B sj } is minimized.
The decision version of the SET-PARTITION problem can be reformulated as the
question
P whether Pthe numbers can be partitioned into two sets A and B = S - A such
that i∈A si = j∈B sj .
Given an input set S = {s1 , . . . sn } to the SET-PARTITION problem, we can use the
elements in the set as the purchasesP in Zelda\'s problem, set the number of cards to be
2 and the credit card limit l = 2 i∈S si . Clearly, if the answer to the Zelda\'s decision
problem is in the affirmative, then each credit card will have balance of exactly 2l , and
we can take the disjoint subsets of purchases on each card to be the two sets A and B
that would satisfy SET-PARTITION. The reduction can be executed in linear time.
We also accepted the reduction from SUBSET-SUM to Zelda.
We gave 5 points for correctly identifying an NP-hard problem from which one could
reduce to Zelda\'s problem to prove that the problem is NP-hard (the direction of the
reduction needed to be correct to receive all the points). 10 points was given for a
correct reduction and analysis.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Give a sublinear-time algorithm that takes as input r and ǫ, and outputs a number of
clusters k that is correct with probability at least 2/3.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Executive Summary Use the algorithm from part (a) on a subset of the points cho-
sen u.a.r. The size of the subset is chosen so that the algorithm is correct with the
desired probability.
Algorithm Initialize S ′ to be a subset of S of size t (to be determined below), where
the points are chosen uniformly at random. Run the same algorithm as in part (a) on
this subset.
Correctness From part (b), the probability that t points sampled u.a.r. don\'t lie in
a given cluster is (1 - ǫ)t . Hence, by the union bound, the probability that t points
sampled u.a.r. don\'t lie in any cluster is at most k(1 - ǫ)t ; since k ≤ 1/ǫ, this can be
upper bounded by 1ǫ (1 - ǫ)t . The algorithm is incorrect iff the t sampled points miss
any cluster, so we want this probability to be at most one third:
1 1
(1 - ǫ)t ≤
ǫ 3
t ǫ
(1 - ǫ) ≤
ǫ
t log(1 - ǫ) ≤ log
log 3ǫ
t≥
log(1 - ǫ)
(the sign is reversed in the last inequality since log(1 - ǫ) is negative). The rest of
justification of correctness follows from part (a).
Runtime analysis The runtime of this algorithm is O(tk) or O(t/ǫ); the analysis
is similar to that for part (a). Since neither t nor ǫ depend on n, this algorithm is
sublinear.
Grading comments This part was worth 10 marks total, with 6 marks for achieving
the correct approach to the sublinear algorithm and 4 marks for computing the size of
the subset correctly.
Some students failed to realize that part (b) gives the probability of missing a fixed
cluster, whereas this part requires the probability of missing any cluster; this resulted
in a deduction of 2 marks. Others erroneously assumed that the events of missing each
cluster were independent; this resulted in a deduction of 1 mark. Incorrect algorithms
were given partial credit depending on their similarity with the correct solution.
Several students noted that this was a variant of the sublinear Connected Components
algorithm as discussed in class; again, while true, this was not necessary and a correct
calculation of the [...]', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

The solution to the recurrence T (n) = T (n/6) + T (7n/9) + O(n) is O(n).
(Assume T (n) = 1 for n smaller than some constant c).', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : True. Using the substitution method:
T (n) ≤ cn/6 + 7cn/9 + an
≤ 17cn/18 + an
≤ cn - (cn/18 - an)
This holds if c/18 - a ≥ 0, so it holds for any constant c such that c ≥ 18a.
Full credit was also given for solutions that uses a recursion tree, noting that the
total work at level i is (17/18)i n, which onverges to O(n).', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

The weighted task scheduling problem with weights in the set {1, 2} can be
solved optimally by the same greedy algorithm used for the unweighted case.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. The algorithm will fail given the set of tasks (given
in the form ((si , fi ), wi ):
{((0, 1), 1), ((0, 2), 2)}.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Suppose we are given an array A of n distinct elements, and we want to find n/2
elements in the array whose median is also the median of A. Any algorithm that
does this must take Ω(n log n) time.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. It\'s possible to do this in linear time using S ELECT :
first find the median of A in Θ(n) time, and then partition A around its median.
Then we can take n/4 elements from either side to get a total of n/2 elements in
A whose median is also the median of A.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Problem 2. Translation [25 points] (5 parts)
You have been hired to manage the translation process for some documentation. Unfortunately,
different sections of the documentation were written in different languages: n languages in total.
Your boss wants the entire documentation to be available in all n languages.
There are m different translators for hire. Some of those translators are volunteers that do not
get any money for their services. Each translator knows exactly two different languages and can
translate back and forth between them. Each translator has a non-negative hiring cost (some may
work for free). Unfortunately, your budget is too small to hire one translator for each pair of
languages. Instead, you must rely on chains of translators: an English-Spanish translator and
a Spanish-French translator, working together, can translate between English and French. Your
goal is to find a minimum-cost set of translators that will let you translate between every pair of
languages.
We may formulate this problem as a connected undirected graph G = (V, E) with non-negative
(i.e., zero or positive) edge weights w. The vertices V are the languages for which you wish to
generate translations. The edges E are the translators. The edge weight w(e) for a translator e
gives the cost for hiring the translator w(e). A subset S ⊆ E of translators can be used to translate
between a, b ∈ V if and only if the subgraph GS = (V, S) contains a path between a and b. The set
S ⊆ E is a translation network if and only if S can be used to translate between all pairs a, b ∈ V .
Prove that each minimum spanning tree of G is also a minimum-cost translation net-
work.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Let T be some minimum spanning tree of G. Because T is
a spanning tree, there is a path in T between any pair of vertices. Hence, T is a
translation network.
For the sake of contradiction, suppose that T is not a minimum-cost translation net-
work. Then there must be some translation network S with total cost strictly smaller
than T . Because S connects every pair of vertices, it must have some spanning tree T ∗
as a subgraph. Because all edge weights are nonnegative, we have w(T ∗) ≤ w(S) <
w(T ). Hence, T is not the minimum spanning tree. This contradiction means that all
spanning trees are also minimum-cost translation networks.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Give an efficient algorithm that takes G as input, and outputs a minimum-cost trans-
lation network of G. State the runtime of your algorithm in terms of the number of
languages n and the number of potential translators m.
Your bosses have decided that the previous approach to translation doesn\'t work. When attempting
to translate between Spanish and Portuguese - two relatively similar languages - it degrades the
translation quality to translate from Spanish to Tagalog to Mandarin to Portuguese. There are
certain clusters of languages that are more closely related than others. When translating between
two languages that lie within the same cluster, such as Spanish and Portuguese, the translation
is of high quality when the sequence of languages used to translate between them is completely
contained within the cluster.
More formally, the language set V can be divided into disjoint clusters C1 , . . . , Ck . Each cluster
Ci contains languages that are fairly similar; each language is contained in exactly one cluster.
Your bosses have decided that a translation between a, b ∈ Ci is high-quality if and only if all of
the languages used on the path from a to b are also in Ci . The translator set S is a high-quality
translation network if and only if it is a translation network, and for any language cluster Ci and
any languages a, b ∈ Ci , S can be used for a high-quality translation between a and b.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : We saw in part (a) that every minimum spanning tree is a
minimum-cost translation network of G. Hence, to find a minimum-cost translation
network, it is sufficient to find a minimum spanning tree of G. We may do so using
Kruskal\'s algorithm, for a runtime of Θ(m log n), or using Prim\'s algorithm, for a
runtime of Θ(m + n log n).
Your bosses have decided that the previous approach to translation doesn\'t work. When attempting
to translate between Spanish and Portuguese - two relatively similar languages - it degrades the
translation quality to translate from Spanish to Tagalog to Mandarin to Portuguese. There are
certain clusters of languages that are more closely related than others. When translating between
two languages that lie within the same cluster, such as Spanish and Portuguese, the translation
is of high quality when the sequence of languages used to translate between them is completely
contained within the cluster.
More formally, the language set V can be divided into disjoint clusters C1 , . . . , Ck . Each cluster
Ci contains languages that are fairly similar; each language is contained in exactly one cluster.
Your bosses have decided that a translation between a, b ∈ Ci is high-quality if and only if all of
the languages used on the path from a to b are also in Ci . The translator set S is a high-quality
translation network if and only if it is a translation network, and for any language cluster Ci and
any languages a, b ∈ Ci , S can be used for a high-quality translation between a and b.', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Give an efficient algorithm for computing a minimum-cost high-quality translation
network. Analyze the runtime of your algorithm in terms of the number of languages
n and the number of translators m.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The idea behind this algorithm is to first compute one MST for
each individual cluster, and then to compute a global MST using the remaining edges.
More specifically, we do the following:
1. For each edge (u, v), if there is some cluster Ci such that u, v ∈ Ci , then add
(u, v) to the set Ei . Otherwise, add (u, v) to the set Eglobal .
2. For each cluster Ci , run Kruskal\'s algorithm on the graph (Ci , Ei ) to get a minimum-
cost translation network Ti for the cluster. Take the union of these minimum to
get a forest T .
3. Construct an empty graph Gglobal on nodes {1, . . . , k}. For each edge (u, v) in
Eglobal , where u ∈ Ci and v ∈ Cj , check whether the edge (i, j) is in the graph
Gglobal . If so, set w(i, j) = min{w(i, j), w(u, v)}. Otherwise, add the edge (i, j)
to the graph Gglobal . In either case, keep a mapping source(i, j) = (u∗ , v ∗) such
that w(i, j) = w(u∗ , v ∗).
4. Run Kruskal\'s algorithm on the graph Gglobal to get Tglobal .
5. For each edge (i, j) ∈ Tglobal add the edge source(i, j) to T .
We begin by examining the runtime of this algorithm. The first step requires us to
be able to efficiently discover the cluster Ci that contains each vertex, which can be
precomputed in time Θ(m) and stored with the vertices for efficient lookup. So this
filtering step requires Θ(1) lookup per edge, for a total of Θ(m) time.
The second step is more complex. We run Kruskal\'s algorithm on each individual
cluster. So for the cluster Ci , the runtime is Θ(|Ei | lg |Ci !). The total runtime here is:
k
X k
X k
X
a · |Ei | lg |Ci | ≤ a · |Ei | lg n = (a lg n) |Ei | ≤ am lg n
i=1 i=1 i=1
Hence, the total runtime for this step is Θ(m lg n).
The third step also requires care. We can store the graph to allow us to efficiently
lookup w(·, ·) and to tell whether an edge (i, j) has been added to the graph. We can
also store source(·, ·) to allow for Θ(1) lookups. So the runtime here is bounded by
Θ(m). The fourth step is Kruskal\'s again, only once, on a graph with ≤ [...]', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
							array('question' => '[MIT 6.046J — question d’examen, en anglais]

Problem 4. Social Networking [25 points]
MITbook+ is a new social networking site created by MIT students. Much like other social net-
working sites, MITbook+ allows you to establish "friendship" with other users. Each user has a
unique MITbook+ ID number, and a list of all MITbook+ ID numbers is available to the general
public. Furthermore, for any pair of user IDs, there is a publically-accessible webpage that can be
used to check whether the pair are friends. However, in the interests of preserving user privacy, all
other information associated with MITbook+ IDs is available to members only.
Currently, you are not a user of MITbook+, but you want to learn more about a specific person
(known to you by his ID as 60461337). Specifically, you want to determine whether he went to
school at MIT. Fortunately, the founders of MITbook+ have posted some statistics on their blog
that may help you. Currently, MITbook+ has N users (a very large number). Exactly 2N/3 users
attended MIT; the other N/3 did not. Interestingly, because MIT is a very tight-knit community,
every current or former MIT student on MITbook+ is friends with every other current or former
MIT student on MITbook+.
In the blog post with the statistics, the MITbook+ founders originally claimed that
every user on MITbook+ who did not attend MIT was friends with at most N/4 users
who did attend MIT. Create an efficient algorithm that uses this fact to determine
whether user 60461337 attended MIT.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Executive Summary. We use a randomized algorithm that samples O(1) users to approximate
the number of friends the student has. If 60461337 has sufficiently many friends, he must have
attended MIT; otherwise, he could not have attended MIT. This results in an algorithm with runtime
O(1) and probability of correctness at least 23 .
Algorithm. Create a variable ℓ which is initialized to 0. Repeat the following operation k = 2304
times: pick a random user ID x and increment ℓ by 1 if x is friends with 60461337. After this
process, if ℓ ≥ 15
· k, return "60461337 is an MIT student." Otherwise, return "60461337 is not an
MIT student."
Correctness. For simplicity of notation, let z = 60461337. Let U be the set of all user IDs, let
M be the set of all MIT students, and let A = U - M be the set of all other students. Let f (x, y)
be a boolean relation that is true if and only if x and y are friends. Then we can use the following
notation to count the number of friends that a given user x has in a particular set S:
gS (x) = |{y ∈ S | f (x, y) = T RUE }|
This notation lets us rewrite the facts that we are given as follows:
1. The number of users is |U| = N.
2. The number of users who attended MIT is |M| = 2N/3. The number of users who did not
attend MIT is |A| = N/3.
3. Every pair of MIT students is friends: ∀x =
6 y ∈ M : f (x, y) = T RUE . This further
means that for any MIT student x ∈ M, the number of friends gM (x) that he has at MIT is
|M| - 1 = 2N/3 - 1 (every MIT user but himself).
4. Every user x ∈ A who did not attend MIT is friends with at most N/4 MIT students: gM (x) ≤
N/4.
We consider two cases:
• Case 1: The student z did not attend MIT. Then he can have at most N/3 - 1 non-MIT
friends, and at most N/4 MIT friends. More formally:
N N 7
gU (z) = gM (z) + gA (z) ≤ + -1= ·N -1
4 3 12
In this case, the algorithm will return the incorrect answer if ℓ ≥ 15
·k. What is the probability
of that occurring? To compute this, we resort to the Chernoff bound.
Let Xi be an [...]', 'source' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046J Design and Analysis of Algorithms, Spring 2015'),
						),
					),
				),
			),
		);
	}
}
