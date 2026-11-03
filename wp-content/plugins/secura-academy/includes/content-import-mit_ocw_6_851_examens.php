<?php
/**
 * Questions importees — MIT OpenCourseWare — 6.851 Advanced Data Structures (Spring 2012)
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.851 Advanced Data Structures, Spring 2012 — énoncés et corrigés officiels (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_851_examens' ) ) {
	function seca_import_mit_ocw_6_851_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-851-examens', 'nom' => 'MIT OpenCourseWare — 6.851 Advanced Data Structures (Spring 2012)', 'url' => 'https://ocw.mit.edu/courses/6-851-advanced-data-structures-spring-2012/pages/assignments/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.851 Advanced Data Structures, Spring 2012 — énoncés et corrigés officiels (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT — question d’examen, en anglais] Creationist successor. Given an ordered universe U of keys, develop and analyze a fully retroac­ tive data structure that maintains S ⊆ U and supports the following operations: • insert(k) :    Insert k ∈ U into S • delete(k) :    Remove k ∈ U from S • successor(k) :     Return min{k \' ∈ S | k \' ≥ k} under the constraint that all insert operations must occur at time −∞. All operations should run in time O(log m), where m is the total number of updates performed in the structure (retroactive or not). Observe that such a structure is suﬃcient to answer the “rightward ray shot” queries needed for the nonoblivious retroactive priority queue. A simple reference to the logarithmic time data
Be sure to read the instructions on the assignments section of the class web page.
Creationist successor. Given an ordered universe U of keys, develop and analyze a fully retroac­
tive data structure that maintains S ⊆ U and supports the following operations:
• insert(k) :    Insert k ∈ U into S
• delete(k) :    Remove k ∈ U from S
• successor(k) :     Return min{k \' ∈ S | k \' ≥ k}
under the constraint that all insert operations must occur at time −∞. All operations should run
in time O(log m), where m is the total number of updates performed in the structure (retroactive or
not). Observe that such a structure is suﬃcient to answer the “rightward ray shot” queries needed
for the nonoblivious retroactive priority queue.
A simple reference to the logarithmic time data structure for general retroactive successor is
not a valid solution to this problem. This is a special case of that problem, and a much simpler
solution is desired.
1
6.851 Advanced Data Structures
For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Creationist successor data structure. The data structure is a balanced BST, such as an AVL
tree or red black tree, augmented with the following ﬁelds augmented to each node x:
• td : The time at which x is deleted
• tm : The maximal deletion time among x’s subtree
Operations.    The three operations are done as following:
• Insert(−∞, “insert(k)”): The key k is inserted into the BST, with its deletion time set to
∞. We also set all its ancestors’ maximal deletion time to ∞. Rotations are done to balance
the tree. During rotation, the property that each note’s tm stores its subtree’s maximal
deletion time is preserved. This is easy because we only need to update the maximal deletion
times of the nodes being rotated. The insertion, the update for ancestors, and the rotations
each takes O(log n) time, where n is the number of elements in tree.
• Insert(t, “delete(k)”): The key k is deleted at time t. Locate k in the BST. Its deletion
time td should be greater than t. Change its deletion time td to t, and walk back to the root,
updating the maximal deletion time of all nodes on path. Both the locating and updating
takes O(log n) time.
• Delete(−∞, “insert(k)”): Delete the key k from the BST. We then update all of the maximal
deletion times of the ancestors of k. Both the deletion and the update take O(log n) time.
• Delete(t, “delete(k)”): Locate k in the BST. Increase its deletion time to ∞, and set it
and all of its ancestors’ maximal deletion times to ∞. Both the locating and updating take
O(log n) time.
• Query(t, “successor(k)”): We will essentially perform the standard successor search, except
that we will use the tm ’s to only walk over the elements of the tree where the keys have not
been deleted. Speciﬁcally, we will start by ﬁnding key k’s successor k \' in the tree. If k \' ’s
deletion time is greater than t, then return k \' , otherwise do the following. Walk up the tree,
until the ﬁrst right subtree whose maximal deletion time is greater than t. Walk down that
subtree, avoiding all subtrees whose maximal deletion time is smaller or equal than t, and
ﬁnd the smallest element (at time t). This is k’s successor at t. The walking up and down
takes O(log n) time.
Analysis of operation time.        This data structure has O(log n) for all operations, where n is
the number of elements in tree. We have n ≤ m, where m is the total number of updates. Therefore
the data structure has operation time O(log m) (for all operations.)
1
6.851 Advanced Data Structures
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.851 Advanced Data Structures, Spring 2012 — énoncés et corrigés officiels (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT — question d’examen, en anglais] to keep your solutions to one page! Compact balanced parentheses. Recall that in lecture we introduced the balanced-parentheses representation of a binary trie. A common query when using this representation is match(i), which returns the index of the close parenthesis matching the open parenthesis at index i. In this problem we will develop a compact data structure to answer these queries (though a succinct data structure is known).
Let S be a string of balanced parenthesis. Divide S into blocks of size B. We will call an
open parenthesis far if its matching parenthesis is in a diﬀerent block. A far parenthesis is
a pioneer if its matching parenthesis is in a diﬀerent block than the matching parenthesis of
the previous far parenthesis in S. Prove that there are O(|S|/B) pioneer parenthesis.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Construct a graph G with a vertex for each block, and an edge between the the block contain­
ing each parenthesis and the block containing its match. Observe that G is a simple graph,
since if two pioneer parenthesis lie in the same block, their matching parens cannot also lie
in the same block. We construct the following planar embedding for this graph: place the
vertices in order along a horizontal line, and draw the edges below this line such that the edges
do not cross. This is possible because of the nesting property that the parenthesis pairs must
obey. Since a planar embedding exists, G is a planar graph and thus the number of edges is
at most three times the number of vertices. There are |S|/B vertices, and there is a bijection
between the edges and pioneer parenthesis, thus there are at most 3|S|/B = O(|S|/B) pioneer
parenthesis, as desired. For the tight bound of 2|S|/B − 3, observe that this graph is also an
outerplanar graph (as shown by the same embedding).', 'source' => 'MIT OpenCourseWare, 6.851 Advanced Data Structures, Spring 2012 — énoncés et corrigés officiels (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT — question d’examen, en anglais] to keep your solutions to one page! Compact balanced parentheses. Recall that in lecture we introduced the balanced-parentheses representation of a binary trie. A common query when using this representation is match(i), which returns the index of the close parenthesis matching the open parenthesis at index i. In this problem we will develop a compact data structure to answer these queries (though a succinct data structure is known).
Develop and analyze a static data structure that, given a string of balanced parenthesis S,
answers match queries in O(1) time and uses O(|S|) bits of space.
1
6.851 Advanced Data Structures
For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : • Divide S into blocks of size B = 1/2 lg |S|.
• Make a table giving the block containing the matching parenthesis of each pioneer paren­
thesis.
• Make a rank data structure over the bit vector of pioneer parenthesis (1 for pioneer, 0
otherwise).
• Make a rank data structure over the open parens in S, and another over the close parens
in S.
a
• Make a lookup table T1 which given a block and an index into the block ( |S|∗1/2 lg |S|
possibilities) returns its matching paren if it is in the block, or say it isn’t there.
• Make
a a lookup table T2 which given a block and an integer k between −B and B
( |S| ∗ lg |S| possibilities) return the ﬁrst closing paren in the block such that the
number of open parens minus the number of closing parens in the block up to that paren
equals k.
To do query on a paren p, ﬁrst check T1 for its block, if its closing paren is there, then return
it. Otherwise, use rank over pioneers to look into the pioneer table to ﬁnd which block b p’s
matching paren is in. Then use T2 for b with k equal to the diﬀerence between the number of
open parens and the number of close parens up to p minus diﬀerence between the number of
open parens and the number of close parens up to b (computed using rank over open paren
and rank over close paren structures).
1
6.851 Advanced Data Structures
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.851 Advanced Data Structures, Spring 2012 — énoncés et corrigés officiels (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT — question d’examen, en anglais] Range tree construction. Recall that in class we presented the range tree and the layered range tree for answering orthogonal range trees. However, we did not describe how to construct them eﬃciently.
Describe how to construct a d-dimensional range tree on n given points in O(n lgd−1 n) time.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : If we can construct a d − 1-dimensional range tree in O(n lgd−2 n) time, then we can easily
construct a d-dimensional range tree in O(n lgd−1 n) time. To do this, we construct the tree
from the root down. First, construct a d − 1 dimensional range tree over all elements for the
root, then divide on the dth dimension and pass down the relevant elements to each subtree
and recursively build them. The total running time is then
T (n, d) = 2T (n/2, d) + T (n, d − 1) = 2T (n/2, d) + O(n lgd−2 n)
which solves to O(n lgd−1 n) by the Master theorem. All that remains then, is to show how
to construct a 2-dimensional range tree in O(n lg n) time. To do this, ﬁrst sort the elements
by y in O(n lg n) time. We then build the tree over x as before, except since the elements are
sorted by y (which we can easily maintain as we work down the tree) the time to build each
balanced tree over y is O(n), for a total of
T (n, 2) = 2T (n/2, 2) + T (n, 1) = 2T (n/2, 2) + O(n) = O(n lg n).', 'source' => 'MIT OpenCourseWare, 6.851 Advanced Data Structures, Spring 2012 — énoncés et corrigés officiels (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT — question d’examen, en anglais] Range tree construction. Recall that in class we presented the range tree and the layered range tree for answering orthogonal range trees. However, we did not describe how to construct them eﬃciently.
Describe how to construct a d-dimensional layered range tree on n given points in O(n lgd−1 n)
time.
1
6.851 Advanced Data Structures
For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The procedure for a constructing a layered range tree is identical to the previous section,
except instead of building the tree over y in O(n) time, we must instead compute the pointers
between adjacent layers in O(n) time. This can be done by with a merge-like operation on the
child and parent arrays. Keep a pointer to the head of each array, if the y value at the child
head is less than the y value at the parent head, then increment the child head. Otherwise,
the parent head points to the child head and we increment the parent head.
1
6.851 Advanced Data Structures
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.851 Advanced Data Structures, Spring 2012 — énoncés et corrigés officiels (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT — question d’examen, en anglais] Geometric basics. Recall that in class we introduced the geometric view for binary search tree execution. Using only this view, prove that for any set of m queries on n items, there is a BST that will answer the queries in total time O(m lg n). You should reason only about point sets, not about BSTs. Working-set is harder. In class we introduced the entropy bound and the working-set        property for BSTs. The entropy bound holds if all searches in the BST have amortized time O( nk=1 pk lg p1k ), n where pk is the fraction of the time that key k is queried. The working-set property holds if the time to search for an element xi is O(lg ti ), where ti is the number of elements queried since
Be sure to read the instructions on the assignments section of the class web page.
Geometric basics. Recall that in class we introduced the geometric view for binary search tree
execution. Using only this view, prove that for any set of m queries on n items, there is a BST
that will answer the queries in total time O(m lg n). You should reason only about point sets, not
about BSTs.
Working-set is harder. In class we introduced the entropy bound and the working-set        property
for BSTs. The entropy bound holds if all searches in the BST have amortized time O( nk=1 pk lg p1k ),
n
where pk is the fraction of the time that key k is queried. The working-set property holds if the
time to search for an element xi is O(lg ti ), where ti is the number of elements queried since the
last access to xi . Prove that any BST with the working-set property also has the entropy bound.
1
6.851 Advanced Data Structures
For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Geometric basics. To show that there is a binary search tree supporting any m searches on n
items in O(m log n) total time, we will show that given a set of m points with y-coordinates 1..m
and x-coordinates in the set {1..n}, we can insert at most O(m log n) additional points such that
the total set is arborally satisﬁed. By making the set arborally satisﬁed, it will represent a valid
BST execution, and by having a total of O(m log n) points in the set, it means that the tree touches
O(m log n) points in performing its m queries, thus it runs in O(m log n) total time.
Our procedure for inserting these points is as follows. Initially, we observe that given a set of
points with x-coordinates in the range [1, a], if for each point (x, y) we insert a new point (a/2, y)
then any pair of points (xi , yi ), (xj , yj ) such that xi < a/2 < xj will be arborally satisﬁed as the
rectangle they generate will cross two of the points. We can now recursively perform the same
procedure on the range [1, a/2) and (a/2, a] until we yield a region with all points having the same
x value. In doing so, it is clear we will have created an arborally satisﬁed set. To show that we
have created O(m log n) points, we observe that for each of our m original points, we create log n
new points. This is because each time we recurse on the two sides [1, a/2) and (a/2, a], this original
point will contribute to only one side, so the number of points created in this row is equal to the
depth of the recursion, and as we are only working with integers in the range 1..n, the depth is
log n.
Working-set is harder. Under the working-set property, if x is requested in times i1 , i2 , . . . , ifx
then the total cost of all accesses to x is
O(          lg ti (x)).
i∈{i1 ,...,ifx }
We know that i∈{i1 ,...,if } ti (x) ≤ m, so this last sum is maximized when all the ti (x)’s are equal
x
to m/fx (by AM-GM or Jensen’s inequality), thus
m               m
lg ti (x) ≤                 lg         = fx lg
fx              fx
i∈{i1 ,...,ifx }           i∈{i1 ,...,ifx }
Therefore, the amortized cost of accessing an element is
1                 m                       fx m
O                fx lg         =O                  lg       .
m     x
fx                 x
m fx
Thus, since px = fmx , the entropy bound holds.
1
6.851 Advanced Data Structures
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.851 Advanced Data Structures, Spring 2012 — énoncés et corrigés officiels (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT — question d’examen, en anglais] to keep your solutions to one page! Cache-oblivious median ﬁnding. Given an unordered array of N elements, develop and ana­ lyze a cache-oblivious algorithm to ﬁnd the median of the array in O(IN/Bl) memory transfers. In your solution, you may assume knowledge of the standard median-of-medians deterministic selection algorithm. Cache-oblivous queue. Develop and analyze a cache-oblivious FIFO queue. Both the enqueue and the dequeue operation should take O(1/B) amortized memory transfers. Your data structure should only use external memory indices in {0, 1, · · · , O(N )}, where N is the maximum number of elements stored in the queue at once. 1 6.851 Advanced Data Structures For information
Be sure to read the instructions on the assignments section of the class web page. Remember
to keep your solutions to one page!
Cache-oblivious median ﬁnding. Given an unordered array of N elements, develop and ana­
lyze a cache-oblivious algorithm to ﬁnd the median of the array in O(IN/Bl) memory transfers. In
your solution, you may assume knowledge of the standard median-of-medians deterministic selection
algorithm.
Cache-oblivous queue. Develop and analyze a cache-oblivious FIFO queue. Both the enqueue
and the dequeue operation should take O(1/B) amortized memory transfers. Your data structure
should only use external memory indices in {0, 1, · · · , O(N )}, where N is the maximum number of
elements stored in the queue at once.
1
6.851 Advanced Data Structures
For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Cache-oblivious median ﬁnding. The standard median of medians algorithm is already a
cache-oblivious algorithm meeting the desired bounds, so all the remains is to prove this. Each
step of the recursion (ﬁnding the medians of the groups of ﬁve and selecting the elements for
recursion) can be done in O(1) passes over the the array for a total of O(IN/Bl) memory transfers.
The number of memory transfers is then
T (N ) = T (N/5) + T (7N/10) + O(IN/Bl).
With a base case of T (B) = O(1) since once the list ﬁts in a single line of cache, the median can
be found with a single memory transfer. T (N ) decreases geometrically from the root, down to
O((N/B)c ) (c < 1) work at the leaves. Thus, T (N ) = O(IN/Bl).
Cache-oblivious queue. We will store the items in the queue sequentially in external memory
from an index head to an index tail. Initially, head = tail = 0. To enqueue an item, we store it at
index tail, and we add 1 to tail. To dequeue an item, we report the item stored at index head and
add 1 head. Assuming optimal cache behavior, and M/B ≥ 2, enqueue and dequeue clearly take
an amortized O(1/B) memory transfers per operation. This is because we can just keep the lines
containing head and tail in cache at all times so a memory transfer only occurs one out of every B
enqueues or dequeues.
Note that this algorithm does not stay in memory indices {0, 1, · · · , O(N )}. To ﬁx this, whenever
2 ∗ head > tail, we shift all the elements to the beginning of external memory. This shift takes
O(k/B) memory transfers, where k is the current size of the queue, and we can charge it to the Ω(k)
dequeues that must have occurred between it and the previous shift, so we still have an amortized
O(1/B) memory transfers per operation.
1
6.851 Advanced Data Structures
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.851 Advanced Data Structures, Spring 2012 — énoncés et corrigés officiels (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT — question d’examen, en anglais] to keep your solutions to one page! Concise van Emde Boas. Develop and analyze a data structure that supports insert, delete, successor and predecessor in the word-RAM model in O(lg lg u) worst-case time. Your data struc­ ture should use O(u) bits of space. Note that the van Emde Boas data structure from lecture used Θ(u) words of space, and thus Θ(u lg u) bits of space. Union-Split-Find. Develop and analyze a word-RAM data structure to maintain a set of disjoint intervals of the form [a, b) such that a, b ∈ U. Your data structure should support the following operations in O(lg lg u) time: • make(a, b) : Create the interval [a, b) (must not overlap existing intervals). • union(a, b, c) :
Be sure to read the instructions on the assignments section of the class web page. Remember
to keep your solutions to one page!
Concise van Emde Boas. Develop and analyze a data structure that supports insert, delete,
successor and predecessor in the word-RAM model in O(lg lg u) worst-case time. Your data struc­
ture should use O(u) bits of space. Note that the van Emde Boas data structure from lecture used
Θ(u) words of space, and thus Θ(u lg u) bits of space.
Union-Split-Find. Develop and analyze a word-RAM data structure to maintain a set of disjoint
intervals of the form [a, b) such that a, b ∈ U. Your data structure should support the following
operations in O(lg lg u) time:
• make(a, b) : Create the interval [a, b) (must not overlap existing intervals).
• union(a, b, c) : Merge the adjacent intervals [a, b) and [b, c) into [a, c).
• split(a, b, k) : For k ∈ [a, b), split the interval [a, b) into [a, k) and [k, b).
• find(k) : Return the interval [a, b) that contains k, or report that no interval contains k.
1
6.851 Advanced Data Structures
For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Concise van Emde Boas. We can shave oﬀ a factor of lg u bits of space through indirection.
Divide the universe into chunks of size lg u, corresponding to the last lg lg u bits of the word. We will
maintain a van Emde Boas structure over the ﬁrst lg u − lg lg u bits. For each chunk, we maintain
a single word to represent it. To insert into a chunk, simply set the corresponding bit to 1, and to
delete, set it to 0. To ﬁnd a successor or predecessor in a chunk, shift out the corresponding query
bit and then ﬁnd the least signiﬁcant or most signiﬁcant bit (as described in class).
Whenever we insert an element, insert its ﬁrst lg u − lg lg u bits into the summary vEB. When
we delete, if the chunk we delete from empties then we delete from the summary structure as well.
To ﬁnd a successor, ﬁrst check the corresponding chunk for a successor, and if one exists return it,
otherwise search the summary structure for the successor chunk and return the smallest element
in it.
All operations run in O(lg lg u) time since they take a constant number of operations in the vEB
structure and all work in the chunks take constant time. The summary vEB takes O(u lg u/ lg u) =
O(u) bits of space, and the chunks take O(u) bits of space since there are u/ lg u chunks, and each
takes lg u bits. Thus the total structure takes O(u) bits of space.
Union-Split-Find. We will maintain two van Emde Boas structures, A and B. A consists of
the interval start points, and B consists of the interval end points. We perform the operations as
follows:
• make(a, b) : Insert a into A and b into B.
• union(a, b, c) : Delete b from A and B.
• split(a, b, k) : Insert k into A and B.
• find(k) : Let a be the predecessor of k in A, b be the successor of a in B. If k is in the range
[a, b), return it, otherwise report that no interval contains k.
All operations require 2 vEB insert/delete/queries, thus they each take O(lg lg u) time.
1
6.851 Advanced Data Structures
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.851 Advanced Data Structures, Spring 2012 — énoncés et corrigés officiels (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT — question d’examen, en anglais] to keep your solutions to one page! Speeding up static d    vann Emde Boas. In this problem we will develop a static data structure w−lg n matching the O lg a     predecessor time bound mentioned in class.
Develop and analyze a data structure that supports successor and predecessor queries in the
word-RAM model in O (lg(w − lg n)) worst-case time using O(n) space.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Construct a lookup table over the ﬁrst lg n bits in a word. Each entry in the table will point to
a vEB (built with perfect hashing) over the last w − lg n bits of all words whose ﬁrst lg n bits
match the table index. Additionally, each table entry will contain a pointer to the previous
and next table entry whose vEBs are not empty.
The procedure for a successor operation is then to ﬁrst use the ﬁrst lg n bits of the input word
to ﬁnd the relevant table entry. If the vEB for that entry contains a successor for the input
word, we return it. Otherwise, use the table’s pointer to the next non-empty vEB and return
the smallest key in that vEB. The running time for each vEB lookup is O(lg(w − lg n)) since
each vEB is over words of size w − lg n. The total space used is O(n) since the table is of size
O(n) and each key is in only one vEB.', 'source' => 'MIT OpenCourseWare, 6.851 Advanced Data Structures, Spring 2012 — énoncés et corrigés officiels (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT — question d’examen, en anglais] to keep your solutions to one page! Speeding up static d    vann Emde Boas. In this problem we will develop a static data structure w−lg n matching the O lg a     predecessor time bound mentioned in class.
Develop and analyze a data
d    structure
n     that supports successor and predecessor queries in the
w
word-RAM model in O lg lg lg n worst-case time using O(n log n) space.
Neither of your data structures needs to support insertions or deletions.
1
6.851 Advanced Data Structures
For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : We will construct a normal vEB structure (built with perfect hashing), except once the
recursion gets down to a key size less of at most lg lg n, we will stop and instead use a
complete lookup table. Speciﬁcally, the table will have lg n entries, one for each bit string
of length lg lg n and each entry will have the predecessor and successor for that query. The
running time of queries is clearly O(lg lg wlg n ) since the key length halves with each step in the
recursion until it stops at lg lg n, and then an O(1) lookup occurs. The space used is O(n lg n)
since each lookup table has size lg n and there are at most n such tables.
1
6.851 Advanced Data Structures
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.851 Advanced Data Structures, Spring 2012 — énoncés et corrigés officiels (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT — question d’examen, en anglais] to keep your solutions to one page! Signature compression. Recall that the ﬁrst step in Signature Sort was to reduce each w = lg2+ε n bit input word to a O(lg1+ε n)-bit signature. We achieved this by dividing each word into k = lgε n chunks of w/k = lg2 n bits each and applying a hash function to each chunk, reducing it to lg n bits. After hashing, our word was of the form 0w/k−lg n h1 0w/k−lg n h2 · · · 0w/k−lg n hk , where each chunk hash hi is lg n bits long. Describe how to compress this word so that all of the hashed chunks are adjacent in the least signiﬁcant bits of the word, so that it has the form needed by the algorithm: 0w−k lg n h1 h2 · · · hk . Your algorithm should take O(1)
Be sure to read the instructions on the assignments section of the class web page. Remember
to keep your solutions to one page!
Signature compression. Recall that the ﬁrst step in Signature Sort was to reduce each w =
lg2+ε n bit input word to a O(lg1+ε n)-bit signature. We achieved this by dividing each word into
k = lgε n chunks of w/k = lg2 n bits each and applying a hash function to each chunk, reducing it
to lg n bits. After hashing, our word was of the form
0w/k−lg n h1 0w/k−lg n h2 · · · 0w/k−lg n hk ,
where each chunk hash hi is lg n bits long. Describe how to compress this word so that all of the
hashed chunks are adjacent in the least signiﬁcant bits of the word, so that it has the form needed
by the algorithm:
0w−k lg n h1 h2 · · · hk .
Your algorithm should take O(1) time using the word-RAM operations (+, -, *, /, %, &, |, ~, ^,
<<, >>). You may assume that ε < 1.
Level ancestors construction. In class we presented a data structure for answering level an­
cestor queries in O(1) time using O(n) space. Develop and analyze an algorithm for constructing
this data structure in O(n) time.
1
6.851 Advanced Data Structures
For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Signature compression. We will ﬁrst multiply the input word x by an integer m which will
arrange h1 , h2 , · · · , hk into a lg2 n bit segment, then shift this segment to the least signiﬁcant bits
of the word, and ﬁnally mask out all of the other bits. This consists of 3 word-RAM operations,
thus it clearly runs in O(1) time.
Let m = 0w/k−lg n−1 10w/k−lg n−1 1 · · · 0w/k−lg n−1 1. m ∗ x consists of each hi shifted left by
(w/k − lg n)j and added together. In x, hi appears at position w/k(i − 1) so the version of it which
is shifted left by j = k −i appears at position w −w/k −(k +i) lg n. And since each block hi has size
lg n, h1 , · · · , hk lie adjacent in m ∗ x at positions w − w/k − (k + 1) lg n through w − w/k − (2k) lg n.
We can then shift right by w − w/k − (2k) lg n + lg n and mask out the result to get our desired
0w−k lg n h1 h2 · · · hk .
Level ancestors construction. Create the lookup table for all possible subtrees of size k =
1/4 lg n by iterating through the binary string representations of them (of which there are 4k ). For
each tree, iterate through each level ancestor query that falls within it (of which there are k 2 ) and
determine the answer by looping up the tree (in O(k) time). Thus the lookup table is constructed
in O(4k k 3 ) = o(n) time. Prune oﬀ the small subtrees, by recursively computing the size of the
subtrees rooted at each node.
In order to compute the ladder decomposition, ﬁrst compute the long-path decomposition, and
then iterate through each path and extend it into a ladder in O(n) time. To compute the long-path
decomposition, ﬁrst traverse the tree and compute the maximum depth below each node, as well
as a pointer to the maximum depth child of each node. Next build the paths by following these
pointers and recursively building the paths from the other children.
To compute the jump pointers from each leaf, we will use the ladder decomposition. All lg n
jump pointers fall within O(lg n) ladders from the leaf to the root, so simply follow these ladders
and extract all of the jump pointers in O(lg n) time per leaf.
1
6.851 Advanced Data Structures
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.851 Advanced Data Structures, Spring 2012 — énoncés et corrigés officiels (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
							array('question' => '[MIT — question d’examen, en anglais] to keep your solutions to one page! Substring matching. Given two strings S1 and S2 , and a positive integer k, ﬁnd the number of substrings of S1 of length at least k that occur in S2 . Develop and analyze an algorithm to solve this problem in O(|S1 | + |S2 | + sort(Σ)) time. 1 6.851 Advanced Data Structures For information about citing these materials or our Terms of Use, visit:
Be sure to read the instructions on the assignments section of the class web page. Remember
to keep your solutions to one page!
Substring matching. Given two strings S1 and S2 , and a positive integer k, ﬁnd the number of
substrings of S1 of length at least k that occur in S2 . Develop and analyze an algorithm to solve
this problem in O(|S1 | + |S2 | + sort(Σ)) time.
1
6.851 Advanced Data Structures
For information about citing these materials or our Terms of Use, visit:', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : String matching. Construct a compressed suﬃx trie over S = S1 $1 S2 $2 , and then trim below
$1 so that all leaves are either $1 or $2 . The construction takes O(|S1 | + |S2 | + sort(Σ)), and the
trimming can be done with a traversal of the trie in O(|S1 | + |S2 |) time.
Traverse the trie and record for each node whether it has a $2 in its subtree as well as the
number of $1 s in its subtree. A given node corresponds to a substring appearing in S2 iﬀ it has an
$2 in its subtree and it corresponds to a number of substrings in S1 equal to the number of $1 s in
its subtree. To compute the total number of substrings of S1 of length at least k that occur in S2 ,
traverse the tree and sum the number of $1 leaves for each node which has an $2 leaf and has letter
depth at least k.
This procedure would work correctly on an uncompressed suﬃx trie, but it does not account for
those substrings corresponding to nodes compressed into edges. To correct for this, when adding
the number of $1 leaves for a node, multiply it by the length of the edge to its parent (or if the
parent has letter depth less than k, multiply it by the node’s letter depth minus k − 1).
1
6.851 Advanced Data Structures
For information about citing these materials or our Terms of Use, visit:', 'source' => 'MIT OpenCourseWare, 6.851 Advanced Data Structures, Spring 2012 — énoncés et corrigés officiels (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
						),
					),
				),
			),
		);
	}
}
