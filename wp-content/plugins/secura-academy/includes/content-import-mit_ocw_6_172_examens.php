<?php
/**
 * Questions importees — MIT OpenCourseWare — 6.172 Performance Engineering of Software Systems (Fall 2018)
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_172_examens' ) ) {
	function seca_import_mit_ocw_6_172_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-172-examens', 'nom' => 'MIT OpenCourseWare — 6.172 Performance Engineering of Software Systems (Fall 2018)', 'url' => 'https://ocw.mit.edu/courses/6-172-performance-engineering-of-software-systems-fall-2018/pages/exams/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

Packing is an optimization that reduces data movement but may increase computation.
True False', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : True', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 0),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

Using taskset for a serial program diminishes performance variations caused by NUMA (nonuni-
form memory access).
True False', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : True', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 0),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

In the free-list heap-allocation algorithm, allocating to the least-full page maximizes the proba-
bility that two random accesses hit the same page.
True False', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : False', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 1),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

Give the parallelism of bitonic_sort() in simple terms.
5 Heap Allocation (3 parts, 13 points)
A certain program needs to allocate memory chunks that have alternating sizes of 60 bytes and
120 bytes. In other words, the program will allocate a chunk of 60 bytes, followed by 120 bytes,
followed by 60 bytes, and so on. We shall consider two schemes for heap allocation.
Scheme F is a fixed-size allocator that uses a free-list of 120-byte blocks. Scheme V is a variable-
sized allocator that uses binned free lists with blocks that are exact powers of 2.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : O(n/log(n))
5 Heap Allocation (3 parts, 13 points)
A certain program needs to allocate memory chunks that have alternating sizes of 60 bytes and
120 bytes. In other words, the program will allocate a chunk of 60 bytes, followed by 120 bytes,
followed by 60 bytes, and so on. We shall consider two schemes for heap allocation.
Scheme F is a fixed-size allocator that uses a free-list of 120-byte blocks. Scheme V is a variable-
sized allocator that uses binned free lists with blocks that are exact powers of 2.', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018'),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

If there is a TLB miss, then the corresponding cache line is not already in cache.
True False', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : False', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 1),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

It is generally more important for a memory allocator to quickly allocate small blocks than to
quickly allocate large blocks.
True False', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : True', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 0),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

On x86, sequentially consistent behavior can always be achieved through the use of memory
fences.
True False', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : True', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 0),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

If a program that runs on 2 threads protects its critical sections using Peterson\'s algorithm, then
it is free of data races.
True False', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : True', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 0),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

Describe a performance problem that Ben might see with thread-local free lists that can cause
Ben\'s parallel program to use much more space than his original serial program.
Ben decides to modify his serial free-list code into a global free list, with push and pop oper-
ations synchronized using mutex locks. Ben wants to add as few instructions as possible to his
free-list code to implement a correct and efficient global free list. Ben\'s free list code contains
convenient labels A through J at lines where Ben might insert a new statement.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : memory drift
Ben decides to modify his serial free-list code into a global free list, with push and pop oper-
ations synchronized using mutex locks. Ben wants to add as few instructions as possible to his
free-list code to implement a correct and efficient global free list. Ben\'s free list code contains
convenient labels A through J at lines where Ben might insert a new statement.', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018'),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

Describe how the spans of those four blocks compose to make the recurrence for the span of this
parallel Strassen code equal to
T∞ (n) = 2T∞ (n/2) + Θ(lg n). (2)', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The spans of the four blocks sum to give T∞ (n) = 2T∞ (n/2) + Θ(log2 n).', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018'),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

Argue that the total space usage in the top part of the recursion tree, in all levels i ≤ k, is
Θ(n2 log4 P).', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The height of the tree is k = log4 P. Each level uses Θ(n2 ) space. The result follows from
the product of these terms.', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018'),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

What is the total worst-case space used by an execution of parallel Strassen? Express your answer
in Θ-notation.
6 Cache-oblivious Strassen (3 parts, 13 points)
This question examines the cache-efficiency of Strassen\'s algorithm for matrix multiplication. For
this question, we will consider a serial implementation of Strassen\'s algorithm, such as the serial
elision of the parallel implementation described in Question 4. For this problem, assume an
ideal cache model (fully associative with an optimal or LRU replacement policy, as appropriate)
with cache size M and cache-line length B . Assume that the cache is tall (i.e. M = ω (B 2 )).
Furthermore, assume that Strassen\'s algorithm is run using an optimal allocator that achieves
perfect utilization. Assume that the input matrix is stored in row-major order, and also assume
that the routine for adding or subtracting two m-by-m submatrices is Θ(m2 /B).
The recurrence for the worst-case number Q(n) of cache misses incurred by Strassen\'s algorithm
when multiplying two n × n matrices is given by
( √
Θ(n2 /B) if 0 ≤ n < c M for sufficiently small constant c ≤ 1;
Q(n) = (4)
7Q(n/2) + Θ(n2 /B) otherwise.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The space usage below any particular node at level k is S1 (n/2k ) = Θ(n2 /4k ). Because
k = log4 P, this equation simplifies to Θ(n2 /P). Because there are P nodes at level k, the total
space usage below level k is Θ(n2 ).
6 Cache-oblivious Strassen (3 parts, 13 points)
This question examines the cache-efficiency of Strassen\'s algorithm for matrix multiplication. For
this question, we will consider a serial implementation of Strassen\'s algorithm, such as the serial
elision of the parallel implementation described in Question 4. For this problem, assume an
ideal cache model (fully associative with an optimal or LRU replacement policy, as appropriate)
with cache size M and cache-line length B . Assume that the cache is tall (i.e. M = ω (B 2 )).
Furthermore, assume that Strassen\'s algorithm is run using an optimal allocator that achieves
perfect utilization. Assume that the input matrix is stored in row-major order, and also assume
that the routine for adding or subtracting two m-by-m submatrices is Θ(m2 /B).
The recurrence for the worst-case number Q(n) of cache misses incurred by Strassen\'s algorithm
when multiplying two n × n matrices is given by
( √
Θ(n2 /B) if 0 ≤ n < c M for sufficiently small constant c ≤ 1;
Q(n) = (4)
7Q(n/2) + Θ(n2 /B) otherwise.', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018'),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

Sketch the recursion tree for the recurrence for (4). Compute the height and the number of leaves
of the recursion tree, and label the internal nodes and leaves of the tree with the corresponding
number of cache misses incurred at them. Solve the recurrence, providing a tight asymptotic
bound in simple form.
Sketch of recursion tree for Q(n):
Height =
Number of leaves =
Misses per leaf =
Q(n) =', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Height = lg n - lg(cM).
√ √ lg 7
Number of leaves = 7lg n-lg(c M) = Θ(nlg 7 / M ).
Misses per leaf = Θ(M/B).
lg 7
Q(n) = Θ( BM(nlog 7)/2-1 ).', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018'),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

Inlining a function tends to improve performance by reducing the number of instruction cache
misses.
True False', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : False', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 1),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

Compilers eliminate data dependencies through register renaming by replacing x86 logical reg-
isters with physical registers.
True False
1.5 1 TRUE OR FALSE (8 PARTS, 16 POINTS)', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : False', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 1),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

If a memory location in a program is read by two logically parallel instructions, then a read-read
determinacy race exists.
True False', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : False', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 1),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

The time command can more readily diagnose kernel-mode performance variations (e.g., page
zeroing) than clock_gettime().
True False', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : True', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 0),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

When using reference counting for garbage collection, cyclic data structures are never garbage
collected.
True False', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : True', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 0),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

Memory-allocator performance is more important when requesting a large amount of memory
than when requesting a small amount.
True False', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : False', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 1),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

There are generally fewer conflict misses in a set-associative cache than a direct-mapped cache.
True False', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : True', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 0),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

When dealing with multiple pages, a new block should be allocated from the free list for the
emptiest page to incur the fewest TLB misses.
True False', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : False', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 1),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

Streaming writes allow for higher memory bandwidth utilization by bypassing cache with the
additional cost of higher latency.
True False', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : True', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 0),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

If a program that runs on 2 threads protects its critical sections using Peterson\'s algorithm, then
it is free of determinacy races.
True False', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : False', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 1),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

In lecture, we saw a theorem stating that a P-worker execution of any Cilk program uses at most
P times the space used in a serial execution of that Cilk program. Why does the theorem not
apply to foo, or does it?
3 Concurrent free lists (2 parts, 8 points)
Ben Bitdiddle is parallelizing a program that uses a free list to handle the allocation of objects of
a fixed size X. Ben\'s serial code uses a global free-list data structure of type FreeList_t, defined
as follows:

8 typedef struct Node_t {
9 /* A */
10 struct Node_t * next ;
11 } Node_t ;
13 typedef struct {
14 /* B */
15 Node_t * head ;
16 } FreeList_t ;
18 void push ( FreeList_t *fl , Node_t * node ) {
19 /* C */
20 node -> next = fl -> head ;
21 /* D */
22 fl - > head = node ;
23 /* E */
24 }
26 Node_t * pop ( FreeList_t * fl ) {
27 /* F */
28 Node_t * node = fl -> head ;
29 /* G */
30 if ( NULL != node ) {
31 /* H */
32 fl -> head = node -> next ;
33 /* I */
34 }
35 /* J */
36 return node ;
37 }
 
Ben considers parallelizing his free list by implementing thread-local free lists. Each thread
would only push or pop storage from its local free list. If the thread\'s local free list is empty, then
the thread simply calls the system\'s malloc.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The theorem applies to stack allocations, not heap allocations
3 Concurrent free lists (2 parts, 8 points)
Ben Bitdiddle is parallelizing a program that uses a free list to handle the allocation of objects of
a fixed size X. Ben\'s serial code uses a global free-list data structure of type FreeList_t, defined
as follows:

8 typedef struct Node_t {
9 /* A */
10 struct Node_t * next ;
11 } Node_t ;
13 typedef struct {
14 /* B */
15 Node_t * head ;
16 } FreeList_t ;
18 void push ( FreeList_t *fl , Node_t * node ) {
19 /* C */
20 node -> next = fl -> head ;
21 /* D */
22 fl - > head = node ;
23 /* E */
24 }
26 Node_t * pop ( FreeList_t * fl ) {
27 /* F */
28 Node_t * node = fl -> head ;
29 /* G */
30 if ( NULL != node ) {
31 /* H */
32 fl -> head = node -> next ;
33 /* I */
34 }
35 /* J */
36 return node ;
37 }
 
Ben considers parallelizing his free list by implementing thread-local free lists. Each thread
would only push or pop storage from its local free list. If the thread\'s local free list is empty, then
the thread simply calls the system\'s malloc.', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018'),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

Explain why the recurrence for the work T1 (n) of the parallel Strassen code satisfies
T1 (n) = 7T1 (n/2) + Θ(n2 ). (1)', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : We have seven recursive multiplications of matrices of size n/2 × n/2. At each level
of the recursion, there are a constant number of matrix additions / subtractions to produce the
intermediate matrices to pass into the next recursive calls.', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018'),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

Why is the branching factor 4 for the top part of this recursion tree?', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The code spawns off at most four recursive calls in parallel at any point during its
execution, i.e., either in block 1 or block 2. Therefore, the branching factor of the space overhead
is four because the space allocated is reused across all blocks.', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018'),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

Argue that the total space usage in the bottom part of the recursion tree, in all levels i > k, is
Θ ( n2 ).', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : As shown in 5.2, the total space used at the lower levels of the recursion is Θ(n2 ).', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018'),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

Why is Q(n) = 7Q(n/2) + Θ(n2 /B) for n sufficiently large?', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : We have seven recursive calls on matrices of size n/2. In addition, there are a constant
number of matrix additions and subtractions to construct the inputs for the recursive calls, so the
cache misses to create the inputs is Θ(n2 /B).', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018'),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

Because thermal limits prevented CPU manufacturers from increasing clock frequencies signifi-
cantly, they began to produce multicore microprocessors.
True False', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : True', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 0),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

Suppose that a recursive function performs work on a problem of size N according to the recur-
rence T ( N ) = 2T ( N/3) + Θ( N lg N ). Then coarsening the recursion is unlikely to significantly
improve performance.
True False', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : True', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 0),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

When using the MSI (modified, shared, invalid) cache coherence protocol, the state of a cache
line in a processor\'s cache may transition directly from shared to invalid.
True False', 'mode' => 'choice', 'xp' => 20, 'explanation' => 'Réponse officielle du MIT : True', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018', 'choices' => array('True', 'False'), 'correct' => 0),
							array('question' => '[MIT 6.172 — question d’examen, en anglais]

A greedy scheduler schedules a computation with work T1 and span T∞ in time Tp ≤ max ( T1 /P, T∞ )
on a P-processor ideal parallel computer.
True False
2 BACK OF THE ENVELOPE CALCULATIONS (3 PART, 10 POINTS)
2 Back Of The Envelope Calculations (3 Part, 10 Points)
Perform a back-of-the-envelope calculation for the work of a serial execution of get_row_sums on
a 1000-by-1000 matrix. Assume that you have one 3 GHz scalar processing core which executes
only one instruction per cycle, and that everything is in cache.

1 # define ROWS 1000
2 # define COLS 1000
4 typedef int32_t element_t ;
6 void get_row_sums ( element_t M [ ROWS ][ COLS ] ,
7 element_t row_sums [ ROWS ]) {
8 for ( int32_t i = 0; i < ROWS ; i ++) {
9 element_t sum = 0;
10 for ( int32_t j = 0; j < COLS ; j ++) {
11 sum += M [ i ][ j ];
12 }
13 row_sums [ i ] = sum ;
14 }
15 }
 ', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : False
2 Back Of The Envelope Calculations (3 Part, 10 Points)
Perform a back-of-the-envelope calculation for the work of a serial execution of get_row_sums on
a 1000-by-1000 matrix. Assume that you have one 3 GHz scalar processing core which executes
only one instruction per cycle, and that everything is in cache.

1 # define ROWS 1000
2 # define COLS 1000
4 typedef int32_t element_t ;
6 void get_row_sums ( element_t M [ ROWS ][ COLS ] ,
7 element_t row_sums [ ROWS ]) {
8 for ( int32_t i = 0; i < ROWS ; i ++) {
9 element_t sum = 0;
10 for ( int32_t j = 0; j < COLS ; j ++) {
11 sum += M [ i ][ j ];
12 }
13 row_sums [ i ] = sum ;
14 }
15 }
 ', 'source' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.172 Performance Engineering of Software Systems, Fall 2018'),
						),
					),
				),
			),
		);
	}
}
