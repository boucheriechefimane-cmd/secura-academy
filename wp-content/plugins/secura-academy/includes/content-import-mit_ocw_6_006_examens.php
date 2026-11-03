<?php
/**
 * Questions importees — MIT OpenCourseWare — 6.006 Introduction to Algorithms (Spring 2020)
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_006_examens' ) ) {
	function seca_import_mit_ocw_6_006_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-006-examens', 'nom' => 'MIT OpenCourseWare — 6.006 Introduction to Algorithms (Spring 2020)', 'url' => 'https://ocw.mit.edu/courses/6-006-introduction-to-algorithms-spring-2020/pages/exams/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Given an array A[1 . . n] of integers, the running time of Counting Sort
is polynomial in the input size n.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. Counting Sort\'s running time depends on the size of the num-
bers in the input, so it is pseudo-polynomial.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

If we augment an n-node AVL tree to store the size of every rooted
subtree, then in O(log n) we can solve a range query: given two keys x and y,
how many keys are in the interval [x, y]?', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : True. The question describes range trees, as implemented in Problem
Set 3.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Given a connected graph G = (V, E), if a vertex v ∈ V is visited
during level k of a breadth-first search from source vertex s ∈ V , then every path
from s to v has length at most k.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. The level of a vertex only provides the length of the shortest
path from s.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Given an adjacency-list representation of a directed graph G = (V, E),
it takes O(V ) time to compute the in-degree of every vertex.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. The adjacency list structure needs to be traversed to find the
incoming edges for each vertex. This structure has total size Θ(V + E), so this
takes Θ(V + E) time to compute.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

The running time of a dynamic programming algorithm is always
Θ(P ) where P is the number of subproblems.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. The running time of a dynamic program is the number of
subproblems times the time per subproblem. This would only be true if the time
per subproblem is O(1).', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

For every dynamic program, we can assign weights to edges in the
directed acyclic graph of dependences among subproblems, such that finding a
shortest path in this DAG is equivalent to solving the dynamic program.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. We saw a counter-example where we couldn\'t do this in the
matrix parenthesization problem.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

If P equals NP, then NP equals NP-complete.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : True. A problem X is NP-hard iff any problem in NP can be reduced
in polynomial time to X. If P equals NP, then we can reduce any problem in NP
to any other problem by just solving the original problem.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Give an algorithm that implements C OUNT(l, h) in O(log N ) time.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The C OUNT method in range trees returns the desired answer. The num-
ber of tree nodes between l and h is exactly the number of unoccupied rooms in the
[l, h] interval.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Give an algorithm that implements C HECKO UT(x) in O(log N ) time.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : When a guest checks out of a room, the room becomes unoccupied, so its
number must be inserted into the range tree.
C HECKO UT(x)
1 I NSERT(x)', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Problem 6. The Wedding Planner [20 points] (2 parts)
You are planning the seating arrangement for a wedding given a list of guests, V .
Suppose you are also given a lookup table T where T [u] for u ∈ V is
a list of guests that u knows. If u knows v, then v knows u. You are required to
arrange the seating such that any guest at a table knows every other guest sitting at the
same table either directly or through some other guests sitting at the same table. For
example, if x knows y, and y knows z, then x, y, z can sit at the same table. Describe
an efficient algorithm that, given V and T , returns the minimum number of tables
needed to achieve this requirement. Analyze the running time of your algorithm.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : We can construct an undirected graph G = (V, E) with guests as vertices,
and an edge between two vertices means the two guests know each other. Table T
represents the adjacency lists for the vertices. Two guests can sit at the same table if
there is a path between them. If we start from one vertex s and search the graph using
breadth-first search (BFS) or depth-first search (DFS), all the guests that are reachable
from s can sit at the same table, and additional tables are needed for vertices that are
unreachable from s.
Hence, to find the minimum number of tables, we can iterate through s ∈ V . If
s is not visited, increment the number of tables needed and call DFS-V ISIT(s, T )
or BFS(s, T ), marking vertices as visited during the traversal. Return the number
of tables needed after iterating through all the vertices. This problem is equivalent to
finding the number of connected components in the graph. The running time is Θ(V +
E) because every vertex or edge is visted exactly once. Below is the pseudocode.
N UM -TABLES(V, T )
1 visited = {}
2 n =0
3 for s ∈ V
4 if s ∈
/ visited
5 n = n +1
6 add s to visited
7 DFS-V ISIT(s, T, visitied )
8 return n
DFS-V ISIT(u, T, visitied )
1 for v ∈ T [u]
2 if v ∈
/ visited
3 add v to visited
4 DFS-V ISIT(v, T, visited )', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Give a recurrence relation to compute DP (i, b).', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The following formula computes DP (i, b) as defined in the problem:
DP (i, T RUE) = 1 + max DP (j, FALSE)
1≤j<i and xi >xj
DP (i, FALSE) = 1 + max DP (j, T RUE)
1≤j<i and xi <xj
The most common mistake for this problem involved confusion over the definition of
DP (i, b). Many people gave or attempted to give the following recurrence:

DP (i - 1, T RUE)
DP (i, T RUE) = max
DP (i - 1, FALSE) + 1 if xi > xi-1

DP (i - 1, FALSE)
DP (i, FALSE) = max
DP (i - 1, T RUE) + 1 if xi < xi-1
Unfortunately, this recurrence does not compute the value that we asked for. The value
DP (i, b) is specifically defined as "the length of the longest alternating subsequence
that ends with xi , and ends in an ascending pair if and only if b is T RUE." The above
recurrence relation instead computes the length of the longest alternating subsequence
of x1 , . . . , xi , not necessarily ending on xi , that ends in an ascending pair if and only
if b is T RUE.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Give a valid ordering of subproblems for a bottom-up computation.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The correct order is to iterate through the values of i in increasing order,
and compute DP (i, T RUE) and DP (i, FALSE) for each i. The recurrence relation has
DP (i, b) dependent only on values DP (j, b) for j < i, so increasing order will give us
what we want.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Give an algorithm that uses O(N ) calls to M EDIAN to find the heaviest
and lightest balls of fluff, without identifying which is the heaviest and which is the
lightest.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The pseudo-code below starts out by weighing the first 3 balls, and repeat-
edly replaces the median with a new ball, until the balls runs out. The two remaining
balls must be the extremes, because an extreme will never be a median, and therefore
will never be eliminated.
E XTREMES(b, N )
1 x, y = b1 , b2
2 for i ∈ 3 . . . N
3 z = bi
4 m = M EDIAN(x, y, z)
// Set x and y to non-median balls
5 if x == m
6 x, y = y, z
7 if y == m
8 y=z
9 return (x, y)
It is not sufficient to call M EDIAN on all 3 groups of adjacent balls and hope that it
will rule out all the balls except for the two extremes. Example: given 4 balls with
weights 3471, M EDIAN would point at the 2nd ball twice.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Argue that you need at least Ω(N log N ) calls to M EDIAN to sort the N
fluff balls.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The argument below closely follows the proof of the Ω(N log N ) lower
bound for comparison-based sorting.
A call to M EDIAN has 3 possible outcomes, so a decision tree based on M EDIAN
calls would have a branching factor of 3. There are N ! possible ball permutations,
so the decision tree needs Ω(log3 N !) = Ω(log N !) = Ω(N log N ) levels to cover all
possible N ! permutations.
L OWEST only provides useful information if it is called once, and it reduces the pos-
sible permutations to N2 ! . This doesn\'t change the result above, because the constant
factor gets absorbed by the asymptotic notation.
The lower bound obtained from comparison-based sorting cannot be used without ar-
gument, because it is not obvious that this problem is harder than comparison-based
sorting. To use this bound correctly, a solution would have to prove that comparison-
based sorting can be reduced to this problem, by implementing M EDIAN and L IGHTEST
with O(1) comparisons each.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Problem 3. True/False [18 points] (9 parts)
Circle (T)rue or (F)alse. You don\'t need to justify your choice.
Binary insertion sorting (insertion sort that uses binary search to find
each insertion point) requires O(n log n) total operations.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. While binary insertion sorting improves the time it takes to
find the right position for the next element being inserted, it may still take O(n)
time to perform the swaps necessary to shift it into place. This results in an O(n2 )
running time, the same as that of insertion sort.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

In a BST, we can find the next smallest element to a given element in
O(1) time.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. Finding the next smallest element, the predecessor, may re-
quire traveling down the height of the tree, making the running time O(h).', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Counting sort is a stable, in-place sorting algorithm.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. Counting sort is stable. It is not in-place, however, since we
must make additional space to store the counts of the various elements. This
space requirement grows as the size of the input increases. Additionally, we have
to make a separate output array to produce the answer using counting sort.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

The multiplication method satisfies the simple uniform hashing as-
sumption.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. We don\'t really know of hash functions that satisfy the simple
uniform hashing assumption.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Python generators can be used to iterate over potentially infinite count-
able sets with O(1) memory.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : True. Python generators do not require the whole set to reside in
memory to iterate over it, making this assertion true.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Problem 5. Who Let The Zombies Out? [20 points] (2 parts)
In an attempt to take over Earth, evil aliens have contaminated certain water supplies with a virus
that transforms humans into flesh-craving zombies. To track down the aliens, the Center for Dis-
ease Control needs to determine the epicenters of the outbreak-which water supplies have been
contaminated. There are n potentially infected cities C = {c1 , c2 , . . . , cn }, but the FBI is certain
that only k cities have contaminated water supplies.
Unfortunately, the only known test to determine the contamination of a city\'s water supply is to
serve some of that water to a human and see whether they turn ravenous. Several brave volunteers
have offered to undergo such an experiment, but they are only willing to try their luck once. Each
volunteer is willing to drink a single glass of water that mixes together samples of water from any
subset C 0 ⊆ C of the n cities, which reveals whether at least one city in C 0 had contaminated
water.
Your goal is to use the fewest possible experiments (volunteers) in order to determine, for each city
ci , whether its water was contaminated, under the assumption that exactly k cities have contami-
nated water. You can design each experiment based on the results of all preceding experiments.
You observe that, as in the comparison model, any algorithm can be
viewed as a decision tree where a node corresponds to an experiment with two out-
comes (contaminated or not) and thus two children. Prove a lower bound of Ω(k lg nk )
on the number of experiments that must be done to save the world. Assume that
lg x! ∼ x lg x and that lg(n - k) ∼ lg n (which is reasonable when k < 0.99n).', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : n The number of possible outcomes-whichn cities are contaminated-is
k
. Thus any decision tree must have at least k leaves. Because a decision tree
is binary, it must therefore have height at least
 
n n!
lg = lg ,
k k!(n - k)!
which by the first assumption is
∼ n lg n - k lg k - (n - k) lg(n - k) = n[lg n - lg(n - k)] + k[lg(n - k) - lg k],
which by the second assumption is
n
∼ k[lg n - lg k] = k lg ,
k
which is our desired lower bound.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Write pseudo-code for a function P WN -C ONTEST(N, S, K, P ) that deter-
mines whether K of the itemsPhave prices summing to S, and if so, returns K indices
b1 , b2 , . . . , bK such that S = K
i=1 P [bi ]. Unlike part (a), P WN -C ONTEST should run
in O(K · N ) and use O(K · N K/2 ) space.
K/2', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : P WN -C ONTEST(N, S, K, p)
1 h ← empty hash table
2 for c ← S UBSETS(K/2, {1 . . . N })
K/2
3 do s ← i=1 P ci
4 h[s] ← c
5 for c ← S UBSETS(K/2, {1 . . . N })
6 do s ← S - K/2 i=1 Pci
7 if s ∈ h
8 then return c + h[s]
9 return N IL', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Problem 2. True/False [28 points] (14 parts)
Circle (T)rue or (F)alse. You don\'t need to justify your choice.
√
Computing b ac for an n-bit positive integer a can be done in O(lg n)
iterations of Newton\'s method.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : True. This is the bound obtained by Newton\'s Method\'s quadratic
convergence.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Karatsuba\'s integer multiplication algorithm always runs faster than
the grade-school integer multiplication algorithm.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. Problem Set 5 has shown that the O(N 2 ) algorithm runs faster
for small numbers.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

In a weighted undirected tree G = (V, E, w), breadth-first search
from a vertex s finds single-source shortest paths from s (via parent pointers) in
O(V + E) time.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : True. In a tree, there is only one path between two vertices, and
breadth-first search finds it.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

If a graph represents tasks and their interdependencies (i.e., an edge
(u, v) indicates that u must happen before v happens), then the breadth-first
search order of vertices is a valid order in which to tackle the tasks.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : No, you\'d prefer depth-first search, which can easily be used to pro-
duce a topological sort of the graph, which would correspond to a valid task
order. BFS can produce incorrect results.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Given a weighted directed graph G = (V, E, w) and a source s ∈ V ,
if G has a negative-weight cycle somewhere, then the Bellman-Ford algorithm
will necessarily compute an incorrect result for some δ(s, v).', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. The negative-weight cycle has to be reachable from s.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

The bidirectional Dijkstra algorithm runs asymptotically faster than
the Dijkstra algorithm.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. The constant factor behind bidirectional Dijkstra is better, but
the worst-case running time is the same.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

If you use depth-first search to find a path from A to H, write down the
resulting path as a sequence of vertices.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : A, B, C, D, E, G, F, H if you use recursion, or A, C, D, F, H if you use
stack-based implemention. Essentially, the recursion-based implementation will visit
the neighbors in alphabetical order, while the stack-based implementation will visit
the neighbors in reverse alphabetical order.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Mal clearly needs a way to check her answer for bA3/4 c, using only integers.
Given a pair of positive integers A and C, explain how to check whether C ≤ A3/4
using O(1) additions, subtractions, multiplications, and comparisons.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The equation C ≤ A3/4 is equivalent to the equation C 4 ≤ A3 , which is
equivalent to C · C · C · C ≤ A · A · A.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Any n-node unbalanced tree can be balanced using O(log n) rotations.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. The worst-case unbalanced tree is a list, and balancing it re-
quires Ω(n) rotations.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

AVL trees can be used to implement an optimal comparison-based
sorting algorithm.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : True. AVL trees can be used to sort N numbers in O(N log N ) time,
by inserting all the numbers in the tree, and iteratively calling N EXT-L ARGEST
N times.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Depth-first search will take Θ(V 2 ) time on a graph G = (V, E) repre-
sented as an adjacency matrix.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : True. In this case, finding the neighbors of a vertex takes O(V ) time,
which makes the total running time Θ(V 2 ).', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

For a dynamic programming algorithm, computing all values in a
bottom-up fashion is asymptotically faster than using recursion and memoization.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. A bottom-up implementation must go through all of the sub-
problems and spend the time per subproblem for each. Using recursion and mem-
oization only spends time on the subproblems that it needs. In fact, the reverse
may be true: using recursion and memoization may be asymptotically faster than
a bottom-up implementation.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

When a recurrence relation has a cyclic dependency, it is impossible
to use that recurrence relation (unmodified) in a correct dynamic program.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : True. We need to first perform a modification like the one seen in the
recitation notes.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

If a problem X can be reduced to a known NP-hard problem, then X
must be NP-hard.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. The reverse, however, is true: if a known NP-hard problem
can be reduced to X then X must be NP-hard.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Give an algorithm that implements I NIT(N ). The running time should be
polynomial in N .', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : All the rooms are initially empty, so all their numbers (1 . . . N ) must be
inserted into the range tree.
I NIT(N )
1 for i ∈ 1 . . . N
2 I NSERT(i)', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Give an algorithm that implements C HECK I N(l, h) in O(log N ) time.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Finding the first available room with number ≤ l is equivalent to finding
the successor of l - 1 in the BST. The
C HECK I N(l, h)
1 r = N EXT-L ARGEST(l - 1)
2 if r.key > h
3 return N IL
4 D ELETE(r.key)
5 return r.key', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Give a formula for p(0) in terms of m and n.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : p(0) is essentially the probability that no keys collide. The probability
that the first element doesn\'t collide with any previous keys is 1. The probability that
the second element doesn\'t collide with any previous keys is 1 - 1/m. In general, the
probability that the ith element doesn\'t collide with any previous keys, conditioned
on the assumption that previous keys did not collide and thus occupy i - 1 slots, is
1 - (i - 1)/m. Therefore the overall probability is the product
n  
Y i-1 m! 1
1- = · n.
i=1
m (m - n)! m', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

DP (i, X) = max
for every subset S ⊆ {x0 , x1 , . . . , xn-1 }
1. Exponential
2. Polynomial
3. Pseudo-polynomial
4. Infinite', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Exponential
Solution: pseudopolynomial
infinite
pseudopolynomial
polynomial
exponential', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Give the base cases of your recurrence relation.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The base cases matching the recurrence relation above are:
DP (i, T RUE) = 1 if xi = min{x1 , . . . , xi }
DP (i, FALSE) = 1 if xi = max{x1 , . . . , xi }', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

If you were given the values of DP (i, b) for all 1 ≤ i ≤ n and all b ∈
{T RUE, FALSE}, how could you use those values to compute the length of the longest
alternating subsequence of x1 , x2 , . . . , xn ?', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : There were multiple acceptable answers here. It\'s sufficient to either take
the maximum of DP (n, T RUE) and DP (n, FALSE), or to take the maximum over all
values in the table.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Explain how the previous parts should be put together to sort the N balls
of fluff using O(N log N ) calls to M EDIAN and O(1) calls to L IGHTEST.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Call E XTREMES (the answer to part c) to obtain the lightest and heaviest
balls, then call L IGHTEST to obtain the lightest ball. Last, use L IGHTER (the answer
to part b) as the comparison operator in a fast (O(N log N ) time) comparison-based
sorting algorithm.
Out of the algorithms taught in 6.006, insertion sort with binary search makes the
fewest comparisons. Other acceptable answers are merge-sort and heap-sort, as they
all use O(N log N ) comparisons.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Find a solution to the recurrence T (n) = T ( n3 ) + T ( 2n
) + Θ(n).', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Draw recursion tree. At each level, do Θ(n) work. Number of levels is
log3/2 n = Θ(lg n), so guess T (n) = Θ(n lg n) and use the substitution method to
verify guess.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

In the merge-sort execution tree, roughly the same amount of work is
done at each level of the tree.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : True. At the top level, roughly n work is done to merge all n ele-
ments. At the next level, there are two branches, each doing roughly n/2 work to
merge n/2 elements. In total, roughly n work is done on that level. This pattern
continues on through to the leaves, where a constant amount of work is done on
n leaves, resulting in roughly n work being done on the leaf level, as well.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

In an AVL tree, during the insert operation there are at most two
rotations needed.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : True. The AVL property is restored on every operation. Therefore,
inserting another item will require at most two rotations to restore the balance.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

In a min-heap, the next largest element of any element can be found
in O(log n) time.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. A min-heap cannot provide the next largest element in O(log n)
time. To find the next largest element, we need to do a linear, O(n), search
through the heap\'s array.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Double hashing satisfies the uniform hashing assumption.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. The notes state that double hashing \'comes close.\' Double
hashing only provides n2 permutations, not n!.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Does Alyssa\'s algorithm return a peak in all cases? If so, give a short
proof of correctness. Otherwise, provide a counterexample for the algorithm.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The following is an example of a matrix where the algorithm will return
the wrong value:
0 0 0 0 0
4 5 0 0 0
0 0 1 2 0
0 0 0 0 0
0 0 0 7 0', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Save the world by designing an algorithm to determine which k of the n
cities have contaminated water supplies using O(k lg n) experiments. Describe and
analyze your algorithm.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The algorithm is based on divide and conquer: divide the n cities into two
groups of size n/2; test each group for contamination (using two experiments); and
recurse into each contaminated group. The recursion tree has exactly k leaves, and the
height of the tree is at most lg n, so the number of internal nodes leading to the leaves
is at most k lg n. Each internal node costs 2, for a total cost of O(k lg n).
In fact, it is possible to prove an O(k lg nk ) bound on the same algorithm. To minimize
the number of shared nodes among the k paths from root to leaves, the worst case is
when the recursion tree branches for the first lg k levels (to get enough leaves), and
then has k straight paths for the number of levels: lg n - lg k = lg nk . There are O(k)
nodes in the top branching, and O(k lg nk ) nodes in the bottom paths.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Analyze the running time of your pseudo-code for the previous part.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The following table shows a line-by-line analysis of our pseudo-code.
Line Time Number of iterations Total time
1 O(1) 1 O(1)
K/2
2 K ·N 1 K · N K/2
3 O(K) N K/2 K · N K/2
K/2
4 O(K) N K · N K/2
5 K · N K/2 1 K · N K/2
6 O(K) N K/2 K · N K/2
K/2
7 O(1) N N K/2
8 O(K) 1 O(K)
9 O(1) 1 O(1)
The total running time is the maximum in the "Total time" column, which is K ·N K/2 ,
as requested.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Suppose we want to solve a polynomial equation f (x) = 0. While
our choice of initial approximation x0 will affect how quickly Newton\'s method
converges, it will always converge eventually.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. Take e.g. f (x) = x3 - 2x + 2 and x0 = 0. Then x2i+1 = 1 and
x2i = 0 for all i (that is, the approximations alternate between 0 and 1 without
ever converging).', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

If we convert an n-digit base-256 number into base 2, the resulting
number of digits is Θ(n2 ).', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. log256 n = log = log82 n . By converting a base-256 number
2 256
to base 2, the number of digits is multiplied by 8. For all b1 , b2 6= 1, converting
a base-b1 number to base-b2 results in a linear increase or decrease in the number
of digits.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

In a weighted undirected tree G = (V, E, w), depth-first search from
a vertex s finds single-source shortest paths from s (via parent pointers) in O(V +
E) time.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : True. In a tree, there is only one path between two vertices, and
depth-first search finds it.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Dijkstra\'s shortest-path algorithm may relax an edge more than once
in a graph with a cycle.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. Dijkstra\'s algorithm always visits each node at most once; this
is why it produces an incorrect result in the presence of negative-weight edges.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

In a weighted directed graph G = (V, E, w) containing a negative-
weight cycle, running the Bellman-Ford algorithm from s will find a shortest
acyclic path from s to a given destination vertex t.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False. Bellman-Ford will terminate, and can detect the presence of
that negative-weight cycle, but it can\'t "route around it." (You could always
remove an edge to break the cycle and try again, though.)', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Given a weighted directed graph G = (V, E, w) and a shortest path p
from s to t, if we doubled the weight of every edge to produce G0 = (V, E, w0 ),
then p is also a shortest path in G0 .', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : True. Multiplying edge weights by any positive constant factor pre-
serves their relative order, as well as the relative order of any linear combination
of the weights. All path weights are linear combinations of edge weights, so the
relative order of path weights is preserved. This means that a shortest path in G
will still be a shortest path in G0 .', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
							array('question' => '[MIT 6.006 — question d’examen, en anglais]

Mal decides to use the technique from part (a) to compute the value B =
bA1/4 c. She then plans to compute bA3/4 c by calculating the value C = B 3 = B·B·B.
Provide an explanation of why this technique does not work.
Hint: Define α to be the fractional part of A1/4 , so that B = A1/4 - α. What happens
when you compute C = B 3 ?', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : When you expand out the formula for C, you get
C = B 3 = (A1/4 - α)3 = A3/4 - 3A2/4 α + 3A1/4 α2 - α3 .
If A is large, then γ = 3A2/4 α - 3A1/4 α2 + α3 will be significantly greater than 1,
and so we\'ll have C = A3/4 - γ with γ > 1. Hence, C will not be bA3/4 c.', 'source' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.006 Introduction to Algorithms, Spring 2020'),
						),
					),
				),
			),
		);
	}
}
