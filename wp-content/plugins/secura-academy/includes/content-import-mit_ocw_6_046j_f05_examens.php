<?php
/**
 * Questions importees — MIT OpenCourseWare — 6 046j introduction to algorithms sma 5503 fall 2005
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.046j Introduction To Algorithms Sma 5503, Fall 2005 — examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_046j_f05_examens' ) ) {
	function seca_import_mit_ocw_6_046j_f05_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-046j-f05-examens', 'nom' => 'MIT OpenCourseWare — 6 046j introduction to algorithms sma 5503 fall 2005', 'url' => 'https://ocw.mit.edu/courses/6-046j-introduction-to-algorithms-sma-5503-fall-2005/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.046j Introduction To Algorithms Sma 5503, Fall 2005 — examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.046J — question d’examen, en anglais] Give a tight asymptotic upper bound ( � notation) on the solution to each of the following recur­ rences. You need not justify your answers. (a)               . (b)                           $# %\'& (c)               %  !"  if  $(  )%+* if  % where           is a variable independent from  . 6.046J/18.410J Final Exam                    Name                                                     4 Problem 2. Algorithms and running times [9 points] Match each algorithm below with the tightest asymptotic upper bound for its worst-case running time by inserting one of the letters A, B, ��� , I into the
Give a tight asymptotic upper bound ( � notation) on the solution to each of the following recur­
rences. You need not justify your answers.
(a)               .
(b)  
                        $# %\'&
(c)               %  !" 
if  $(
 )%+*
if 
%
where           is a variable independent from  .
6.046J/18.410J Final Exam                    Name                                                     4
Problem 2. Algorithms and running times [9 points]
Match each algorithm below with the tightest asymptotic upper bound for its worst-case running
time by inserting one of the letters A, B, ��� , I into the corresponding box. For sorting algorithms,
 is the number of input elements. For matrix algorithms, the input matrix has size    . For
graph algorithms, the number of vertices is  , and the number of edges is !" .
You need not justify your answers. Some running times may be used multiple times or not at all.
Because points will be deducted for wrong answers, do not guess unless you are reasonably sure.
Insertion sort                                          A: �       
Heapsort                                                B: �    
B UILD -H EAP                                           C: �      

Strassen’s                                              D: �      
 
Bellman-Ford                                            E: �               
 
Depth-ﬁrst search                                       F: �    
Floyd-Warshall                                          G: �       
Johnson’s                                               H: �      
Prim’s                                                  I: �     
6.046J/18.410J Final Exam                 Name                                                5
Problem 3. Substitution method [10 points]
Use the substitution method to prove a tight asymptotic lower bound ( -notation) on the solution
�
to the recurrence

 )        �
6.046J/18.410J Final Exam                   Name                                                      6
Problem 4. True or False, and Justify [35 points] (7 parts)
Circle T or F for each of the following statements to indicate whether the statement is true or
false, respectively. If the statement is correct, brieﬂy state why. If the statement is wrong, explain
why. The more content you provide in your justiﬁcation, the higher your grade, but be brief. Your
justiﬁcation is worth more points than your true-or-false designation.
T F Let �  , �  , and � be three sorted arrays of  real numbers (all distinct). In the comparison
                                                                    
model, constructing a balanced binary search tree of the set �  �   � requires         

�
time.
T F Let  be a complete binary tree with  nodes. Finding a path from the root of  to a given

vertex   using breadth-ﬁrst search takes �   time.
6.046J/18.410J Final Exam                 Name                                                  7
T F Given an unsorted array �
�  ��  of  integers, building a max-heap out of the elements of
� can be performed asymptotically faster than building a red-black tree out of the elements
of � .
T F Suppose we use a hash function  to hash  distinct keys into an array  of length  .

Assuming     simple uniform hashing, the expected number of colliding pairs of elements is
!    .
6.046J/18.410J Final Exam               Name                                                8
T F Every sorting network with  inputs has depth   �      .
T F If a dynamic-programming problem satisﬁes the optimal-substructure property, then a lo­
cally optimal solution is globally optimal.
6.046J/18.410J Final Exam               Name                                                 9
&
T F Let �       be a directed graph with negative-weight edges, but no negative-weight


cycles. Then, one can compute all shortest paths from a source     to all   faster
than Bellman-Ford using the technique of reweighting.
6.046J/18.410J Final Exam                  Name                                                 10
Problem 5. Red-black trees [15 points] (3 parts)
& & �& & & & � &
(a) Assign the keys                     to the nodes of the binary search tree below so
that they satisfy the binary-search-tree property.
nil      nil
nil         nil
nil        nil               nil
nil         nil
(b) Explain why this binary search tree cannot be colored to form a legal red-black tree.
6.046J/18.410J Final Exam                  Name                                                   11
(c) The binary search tree can be transformed into a red-black tree by performing a single
rotation. Draw the red-black tree that results, labeling each node with “red” or “black.”
Include the keys from part (a).
6.046J/18.410J Final Exam                  Name                                                  12
Problem 6. Wiggly arrays [10 points]
(                (              (
An array � � ��    is wiggly if � �     �� � � �  ��  � ��� � � � � �    .
Given an unsorted array  � ��    of real numbers, describe an efﬁcient algorithm that outputs
a permutation � � � �    of  such that � is a wiggly array.
6.046J/18.410J Final Exam                             Name                                       13
Problem 7. Difference constraints [12 points] (2 parts)
Consider the following linear-programming system of difference constraints (note that one con­
straint is an equality):
�           �       ( 
�          �         (
�         �        (  

�        �       (  

�        � 
�               �  (
�             � (  
�         �  (
�         � (
(a) Draw the constraint graph for these constraints.
(b) Solve for the unknowns �  , �  , � , � , and �  , or explain why no solution exists.

6.046J/18.410J Final Exam                     Name                                                          14
Problem 8. Amortized increment [12 points]


           
An array             of bits (each array element is or ) stores a binary number                      .


To add (modulo           ) to , we use the following procedure:
&
I NCREMENT       
1 
2 while  and   
3      do  
4               
5 if 
6    then  
Given a number , define the potential    of to be the number of ’s in the binary representation
of . For example,       , because  
    . Use a potential-function argument to prove
that the amortized cost of an increment is   , where the initial value in the counter is  .
6.046J/18.410J Final Exam                     Name                                                          15
�     , and
Problem 9. Minimum spanning trees [12 points]
&
Let �             be a connected, undirected graph with &edge-weight

                 
& & & function
assume all & edge weights are distinct. Consider a cycle     ���      in � , where&  
                                                                                  does,
and let        be the edge in the cycle with the largest edge weight. Prove that     

not belong to the minimum spanning tree  of � .
6.046J/18.410J Final Exam                 Name                                                 16
Problem 10. Multithreaded scheduling [10 points]
A greedy scheduler runs a multithreaded computation in � seconds on  processors and in 
�                                   �
seconds on  processors. Is it possible that the computation has work       and critical-path
�
 �
length    ? Justify your answer.
6.046J/18.410J Final Exam                              Name                                                                  17
Problem 11. Transposing a matrix [40 points] (4 parts)
 � � be: an    matrix, where  is an exact power of . The following code computes
Let
T
 � &  &  
to 
T
RANS

do for 
 to& 
1 for

&
do �   � �  
2
3                                    
%

& & & � and
Consider the cache-oblivious two-level memory model with a cache of                           elements and blocks of
 elements. Assume that both& matrices               & & are & stored& in& row-major
& & order,  & & that& is, &the linear        & &
order& of & � in& memory        � �   �   �           �   �   � �       � �              �  �               �   �     
� �  � �� � � &   , and similarly for  .
is                
� �  �                               �
   � �              �  � �
%
(a) Analyze the number MT    of memory transfers incurred by T                      RANS when                .
6.046J/18.410J Final Exam                    Name                                                            18
Now, consider the following divide-and-conquer algorithm for computing the transpose:
� & &
R-T RANS          
1 if        &          &
then �     � � 
�                            "  submatrices  �   , �    , �   , and �   .
2
else Partition into four  "  
                 submatrices   ,   ,   , and   .
3
Partition into& four&  "        "
�
4
R-T RANS    &   & " 
5
�           
R-T RANS    &   & " 
6
�            
R-T RANS    &   & " 
7
8                  �
R-T RANS      " 
 
Assume that the cost of partitioning is �    .
% for the number MT               of memory transfers incurred by

(b) Give and solve a recurrence
R-T RANS when            .
6.046J/18.410J Final Exam                     Name                                                                    19
The following multithreaded algorithm computes the transpose in parallel:
� &  & 
P-T RANS          
1 if        &         &
then �       �
 � 
�                                submatrices  �   , �    , �   , and �   .
2
else Partition into four  "    "
         
3
Partition into four  "&   &   "       submatrices   ,   ,   , and   .
�        
4
spawn P-T RANS       & &" 
�
5
spawn P-T RANS    &   & " 
�        
 
6
spawn P-T RANS    &   & " 
�
7
8          spawn P-T RANS      " 
9          sync

(c) Give and solve recurrences describing the work     and critical-path length "                      
of P-T RANS . What is the asymptotic parallelism of the algorithm?
6.046J/18.410J Final Exam                       Name                                                             20
Professor Kellogg inadvertantly places two additional sync statements into his code as follows:
& &
K-T RANS              
1 if       &         &
     
               
2    then
else Partition into four  "    "
                            submatrices    ,    ,   , and   .
          
3
Partition into four  " &   &   "         submatrices   ,   ,   , and   .
          
4
5         spawn K-T RANS                " 
6
7
sync
  & &
spawn K-T RANS      " 
 
8         sync
   & &  
spawn K-T RANS    &   & " 
9
10                               
spawn K-T RANS      " 
 
11         sync

(d) Give and solve recurrences describing the work     and critical-path length "                  
of K-T RANS . What is the asymptotic parallelism of this algorithm?
SCRATCH PAPER — Please detach this page before handing in your exam.
SCRATCH PAPER — Please detach this page before handing in your exam.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Give a tight asymptotic upper bound (O notation) on the solution to each of the following recur­
rences. You need not justify your answers.
∈
(a) T (n) = 2T (n/8) + 3 n.
Solution:     �(n1/3 lg n) by Case 2 of the Master Method.
(b) T (n) = T (n/3) + T (n/4) + 5n
Solution:     �(n).
8T (n/2) + �(1) if n2 > M ,
⎤
(c) T (n) =
M                   if n2 ← M ;
where M is a variable independent from n.
∈ �                                                   ∈
Solution: � n3 / M . The recursion tree has approximately lg n − lg M =
�
� ∈ �
lg n/ M levels. In the tree, every internal node has 8 children, each with cost
�      � ∈ �3
O(1). At the bottom of the tree, there are approximately 8lg(n/ M ) = n/ M
leaves. Since�each leaf costs� M , and the total cost is dominated by the leaves, the
� ∈ �3                  ∈ �
solution is � M n/ M           = � n3 / M .
�
Handout 36: Final Exam Solutions                                                                     3
Problem 2. Algorithms and running times [9 points]
Match each algorithm below with the tightest asymptotic upper bound for its worst-case running
time by inserting one of the letters A, B, . . ., I into the corresponding box. For sorting algorithms,
n is the number of input elements. For matrix algorithms, the input matrix has size n × n. For
graph algorithms, the number of vertices is n, and the number of edges is �(n).
You need not justify your answers. Some running times may be used multiple times or not at all.
Because points will be deducted for wrong answers, do not guess unless you are reasonably sure.
Insertion sort                                       A: O(lg n)
Heapsort                                             B: O(n)
B UILD -H EAP                                        C: O(n lg n)
Strassen’s                                           D: O(n2 )
Bellman-Ford                                         E: O(n2 lg n)
Depth-ﬁrst search                                    F: O(n2.5 )
Floyd-Warshall                                       G: O(nlg 7 )
Johnson’s                                            H: O(n3 )
Prim’s                                               I: O(n3 lg n)
Solution:     From top to bottom: D, C, B, G, D, B, H, E, C.
Handout 36: Final Exam Solutions                                                              4
Problem 3. Substitution method [10 points]
Use the substitution method to prove a tight asymptotic lower bound (Δ-notation) on the solution
to the recurrence
T (n) = 4T (n/2) + n2 .
Solution: By the master method, we know T (n) = �(n2 lg n). Therefore, our induction hypoth­
esis is T (m) √ cm2 lg m for all m < n.
For m = 1, we have the base case that T (1) = 1 > c12 lg 1 for all c > 0.
For the inductive step, assume for all m < n, T (m) √ cm2 lg m. The induction hypothesis yields
T (n) = 4T (n/2) + n2
� �2 � �
n        n
√ 4c       lg       + n2
2        2
= cn2 lg n − cn2 lg 2 + n2
= cn2 lg n + (1 − c)n2 .
For c < 1, this quantity is always greater than cn2 lg n. Therefore, T (n) = Δ(cn2 lg n).
Handout 36: Final Exam Solutions                                                                    5
Problem 4. True or False, and Justify [35 points] (7 parts)
Circle T or F for each of the following statements to indicate whether the statement is true or
false, respectively. If the statement is correct, brieﬂy state why. If the statement is wrong, explain
why. The more content you provide in your justiﬁcation, the higher your grade, but be brief. Your
justiﬁcation is worth more points than your true-or-false designation.
T F Let A1 , A2 , and A3 be three sorted arrays of n real numbers (all distinct). In the comparison
model, constructing a balanced binary search tree of the set A 1 �A2 �A3 requires Δ(n lg n)
time.
Solution: False. First, merge the three arrays, A1 , A2 , and A3 in O(n) time. Second,
construct a balanced binary search tree from the merged array: the median of the array
is the root; recursively build the left subtree from the ﬁrst half of the array and the right
subtree from the second half of the array. The resulting running time is T (n) = 2T (n/2)+
O(1) = O(n).
T F Let T be a complete binary tree with n nodes. Finding a path from the root of T to a given
vertex v � T using breadth-ﬁrst search takes O(lg n) time.
Solution: False. Breadth-ﬁrst search requires Δ(n) time. Breadth-ﬁrst search examines
each node in the tree in breadth-ﬁrst order. The vertex v could well be the last vertex
explored. (Also, notice that T is not necessarily sorted.)
Handout 36: Final Exam Solutions                                                                   6
T F Given an unsorted array A[1 . . n] of n integers, building a max-heap out of the elements of
A can be performed asymptotically faster than building a red-black tree out of the elements
of A.
Solution: True. Building a heap takes O(n) time, as described in CLRS. On the other
hand, building a red-black tree takes Δ(n lg n) time, since it is possible to produce a sorted
list of elements from a red-black tree in O(n) time by doing an in-order tree walk (and
sorting requires Δ(n lg n) time in a comparison model).
T F Suppose we use a hash function h to hash n distinct keys into an array T of length m.
Assuming simple uniform hashing, the expected number of colliding pairs of elements is
�(n2 /m).
Solution: True. Let Xi,j be an indicator random variable equal to 1 if elements i and j
collide, and equal to 0 otherwise. Simple uniform hashing means that the probability of
element i hashing to slot k is 1/m. Therefore, the probability that i and j both hash to the
same slot Pr(Xi,j ) = 1/m. Hence, E [Xi,j ] = 1/m. We now use linearity of expectation
to sum over all possible pairs i and j:
�                     �
n ⎦
n
E [number of colliding pairs] = E �
⎦
Xi,j ⎡
i=1 j=i+1
n
⎦      ⎦n
=               E [Xi,j ]
i=1 j=i+1
⎦n ⎦  n
=               1/m
i=1 j=i+1
n(n + 1)
=
2m
= �(n2 /m)
Handout 36: Final Exam Solutions                                                               7
T F Every sorting network with n inputs has depth Δ(lg n).
Solution: True. Let d be the depth of the network. Since there are n inputs to the
network, there can be at most nd comparators. (One way of seeing this is by the pigeon­
hole principle: if there are n wires and more than nd comparators, then some wire must
traverse more than d comparators, resulting in a depth > d.)
In the comparison-based model, it is possible to simulate the sorting network one compara­
tor at a time. The running time is equal to the number of comparators (times a constant
factor overhead). Therefore, every sorting network must have at least Δ(n lg n) compara­
tors, by the lower-bound for sorting in the comparison-based model.
Therefore, nd > Δ(n lg n), implying that the depth d is Δ(lg n).
T F If a dynamic-programming problem satisﬁes the optimal-substructure property, then a lo­
cally optimal solution is globally optimal.
Solution: False. The property which implies that locally optimal solutions are globally
optimal is the greedy-choice property. Consider as a counterexample the edit distance
problem. This problem has optimal substructure, as was shown on the problem set, how­
ever a locally optimal solution—making the best edit next—does not result in a globally
optimal solution.
Handout 36: Final Exam Solutions                                                               8
T F Let G = (V, E) be a directed graph with negative-weight edges, but no negative-weight
cycles. Then, one can compute all shortest paths from a source s � V to all v � V faster
than Bellman-Ford using the technique of reweighting.
Solution: False. The technique of reweighting preserves the shortest path by assigning
a value h(v) to each vertex v � V , and using this to calculate new weights for the edges:
w̃(u, v) = w(u, v) + h(u) − h(v). However, to determine values for h(v) such that the
edge weights are all non-negative, we use Bellman-Ford to solve the resulting system
of difference constraints. Since the technique of reweighting relies on Bellman-Ford, it
cannot run faster than Bellman-Ford.
Handout 36: Final Exam Solutions                                                                  9
Problem 5. Red-black trees [15 points] (3 parts)
(a) Assign the keys 2, 3, 5, 7, 11, 13, 17, 19 to the nodes of the binary search tree below so
that they satisfy the binary-search-tree property.
nil      nil
nil       nil
nil          nil                nil
nil       nil
Solution:    5 points for the correct answer:
Handout 36: Final Exam Solutions                                                                  10
(b) Explain why this binary search tree cannot be colored to form a legal red-black tree.
Solution: We prove this by contradiction. Suppose that a valid coloring exists. In a
red-black tree, all paths from a node to descendant leaves contain the same number of
black nodes. The path (17, 19, NIL) can contain at most three black nodes. Therefore
the path (17, 11, 3, 5, 7, NIL) must also contain at most three black nodes and at least
three red nodes. By the red-black tree properties, the root 17 must be black and the
NIL node must also be black. This means that there must be three red nodes in the
path (11, 3, 5, 7), but this would mean there are two consecutive red nodes, which
violates the red-black tree properties. This is a contradiction, therefore the tree cannot
be colored to form a legal red-black tree.
5 points for correct answer. 2-4 points for stating the red-black tree rules, but not
proving why the tree does not satisfy the rules. 1 point for stating that the tree is
unbalanced.
Handout 36: Final Exam Solutions                                                                   11
(c) The binary search tree can be transformed into a red-black tree by performing a single
rotation. Draw the red-black tree that results, labeling each node with “red” or “black.”
Include the keys from part (a).
Solution: Rotate right around the root. There are several valid ways to color the
resulting tree. Here is one possible answer (all nodes are colored black except for 7).
5 points for the correct answer. 2 points for the correct rotation but incorrect coloring.
Handout 36: Final Exam Solutions                                                                  12
Problem 6. Wiggly arrays [10 points]
An array A[1 . . 2n + 1] is wiggly if A[1] ← A[2] √ A[3] ← A[4] √ . . . ← A[2n] √ A[2n + 1].
Given an unsorted array B[1 . . 2n + 1] of real numbers, describe an efﬁcient algorithm that outputs
a permutation A[1 . . 2n + 1] of B such that A is a wiggly array.
Solution: There are several ways to solve this problem in �(n) time. You can ﬁnd the median k
of B using the deterministic �(n) select algorithm and partition B around the median k into two
equal sized sets Blow and Bhigh . Assign A[1] � k. Then for each i > 1, if i is even, assign an
element from Bhigh to A[i], otherwise assign an element from Blow to A[i]. Since all elements in
Bhigh are greater than or equal to all elements in Blow and the median is less than or equal to all
elements in Bhigh , the array is wiggly. The overall running time is �(n).
10 points for correct �(n) solution and correct analysis. 8-9 points for correct solution but missing
a minor step in the analysis.
5 points for correct �(n lg n) solution and correct analysis. 2-4 points for correct solution but
incomplete analysis.
Handout 36: Final Exam Solutions                                                                 13
Problem 7. Difference constraints [12 points] (2 parts)
Consider the following linear-programming system of difference constraints (note that one con­
straint is an equality):
x1 − x 4   ←    −1
x1 − x 5   ←    −4
x2 − x 1   ←    −4
x2 − x 3   =    −9
x3 − x 1   ←     5
x3 − x 5   ←     2
x4 − x 3   ←    −3
x5 − x 1   ←     5
x5 − x 4   ←     1
(a) Draw the constraint graph for these constraints.
Solution: The equality constraint can be written as two inequality constraints, x 2 −
x3 ← −9, and x3 − x2 ← 9. A completely correct constraint graph received 6 points.
Solutions that had edges in the wrong direction received only 4 points, and solutions
that did not handle the equality constraint received 3 points.
(b) Solve for the unknowns x1 , x2 , x3 , x4 , and x5 , or explain why no solution exists.
Solution: No solution to this system exists because the constraint graph has a negative-
weight cycle. For example, x1 � x3 � x4 � x5 � x1 has weight 5−3+1−4 = −1.
A full-credit solution (6 points) must exhibit the negative weight cycle.
Handout 36: Final Exam Solutions                                                                         14
Problem 8. Amortized increment [12 points]
k−1
An array A[0 . . k − 1] of bits (each array element is 0 or 1) stores a binary number x =         A[i] · 2i .
⎦
i=0
To add 1 (modulo 2k ) to x, we use the following procedure:
I NCREMENT (A, k)
1 i�0
2 while i < k and A[i] = 1
3      do A[i] � 0
4          i�i+1
5 if i < k
6     then A[i] � 1
Given a number x, deﬁne the potential �(x) of x to be the number of 1’s in the binary representation
of x. For example, �(19) = 3, because 19 = 100112 . Use a potential-function argument to prove
that the amortized cost of an increment is O(1), where the initial value in the counter is x = 0.
Solution: �(x) is a valid potential function the number of 1’s in the binary representation of x is
always nonnegative, i.e., �(x) √ 0 for all x. Since the initial value of the counter is 0, � 0 = 0.
Let ck be the real cost of the operation I NCREMENT (A, k), and let dk be the number of times the
while loop body in Lines 3 and 4 execute (i.e., dk is the number of consecutive 1’s counting from
the least-signiﬁcant bit of the binary representation of x). If we assume that executing all of Lines
1, 2, 5, and 6 require unit cost, and executing the body of the while loop requires unit cost, then
the real cost is ck = 1 + dk ,
The potential decreases by one every time the while loop is executed. Therefore, the change in
potential, �� = �k − �k−1 is at most 1 − dk . More speciﬁcally, �� = 1 − dk if we execute Line
6 , and �� = −dk if we do not.
Thus, using the formula for amortized cost, we get
cˆk =   ck + ��
=   1 + dk + ��
←   1 + dk + 1 − dk
=   2.
Therefore, the amortized cost of an increment is O(1).
Only solutions that explicitly calculate/explain the real cost ck of a single increment received full
credit. Solutions that give an aggregate analysis or any other method that did not use the potential
function received at most 6 points. One or two points were deducted from correct solutions that
did not explain why the potential function is valid or calculate �0 .
Handout 36: Final Exam Solutions                                                                          15
Problem 9. Minimum spanning trees [12 points]
Let G = (V, E) be a connected, undirected graph with edge-weight function w : E ∪ , and
�
assume all edge weights are distinct. Consider a cycle ≤v1 , v2 , . . . , vk , vk+1 ≥ in G, where vk+1 = v1 ,
and let (vi , vi+1 ) be the edge in the cycle with the largest edge weight. Prove that (v i , vi+1 ) does
not belong to the minimum spanning tree T of G.
Solution: Proof by contradiction. Assume for the sake of contradiction that (v i , vi+1 ) does be­
long to the minimum spanning tree T . Removing (vi , vi+1 ) from T divides T into two connected
components P and Q, where some nodes of the given cycle are in P and some are in Q. For any
cycle, at least two edges must cross this cut, and therefore there is some other edge (v j , vj+1 ) on
the cycle, such that adding this edge connects P and Q again and creates another spanning tree T � .
Since the weight of (vj , vj+1 ) is less than (vi , vi+1 ), the weight of T � is less than T and T cannot
be a minimum spanning tree. Contradiction.
Handout 36: Final Exam Solutions                                                                16
Problem 10. Multithreaded scheduling [10 points]
A greedy scheduler runs a multithreaded computation in 260 seconds on 4 processors and in 90
seconds on 32 processors. Is it possible that the computation has work T 1 = 1024 and critical-path
length T� = 64? Justify your answer.
Solution: For greedy schedulers, we know that min{T1 /P, T� } ← TP ← T1 /P + T� . The
numbers given above satisfy all of the above inequalities for both values of P . Therefore, it is
possible that the work and critical path are correct.
Handout 36: Final Exam Solutions                                                                           17
Problem 11. Transposing a matrix [40 points] (4 parts)
Let X be an N × N matrix, where N is an exact power of 2. The following code computes
Y = X T:
T RANS(X, Y, N)
1 for i � 1 to N
2      do for j � 1 to N
3             do Y [j, i] � X[i, j]
Consider the cache-oblivious two-level memory model with a cache of M elements and blocks of
B elements. Assume that both matrices X and Y are stored in row-major order, that is, the linear
order of X in memory is X[1, 1], X[1, 2], . . . , X[1, N], X[2, 1], X[2, 2], . . . , X[2, N], . . . , X[N, 1],
X[N, 2], . . . , X[N, N ], and similarly for Y .
(a) Analyze the number MT(N ) of memory transfers incurred by T RANS when N → M .
Solution: Since the loop scans through matrix X one row at a time, the number of
memory transfers required for accessing X is O(N 2 /B). We incur O(N 2 ) memory
transfers to access Y , however, because Y is accessed one column at a time. When we
access the block containing Y [j, i], since N → M and we scan through all of column
i before accessing Y [j + 1, i], each access to Y may incur a memory transfer.
Therefore, M T (N ) = O(N 2 ).
Handout 36: Final Exam Solutions                                                             18
Now, consider the following divide-and-conquer algorithm for computing the transpose:
R-T RANS (X, Y, N )
1 if N = 1
2    then Y [1, 1] � X[1, 1]
3    else Partition X into four (N/2) × (N/2) submatrices X11 , X12 , X21 , and X22 .
4         Partition Y into four (N/2) × (N/2) submatrices Y11 , Y12 , Y21 , and Y22 .
5         R-T RANS (X11 , Y11 , N/2)
6         R-T RANS (X12 , Y21 , N/2)
7         R-T RANS (X21 , Y12 , N/2)
8         R-T RANS (X22 , Y22 , N/2)
Assume that the cost of partitioning is O(1).
(b) Give and solve a recurrence for the number MT(N ) of memory transfers incurred by
R-T RANS when N → M .
Solution: If we make either the tall-cache assumption (i.e., M = Δ(B 2 )), or we
assume that the matrix is stored in the recursive block layout, then
4T (n/2) + �(1) if cn2 > M ,
⎤
M T (n) =                                    .
M/B             if cn2 ← M
The recursion tree has approximately lg N − lg( M/c) levels. Since every level
�
has 4 times as many nodes as the previous level, the solution
� �
to the recurrence is
dominated by the cost of the leaves. The tree has 4 lg(N c/ M )
leaves, each of cost
M/B. Therefore, M T (N ) is
� ∈ ⎣2
M N c
M T (N ) =      ∈
B      M
2
cN
=
B� ⎣
N2
= O       .
B
Handout 36: Final Exam Solutions                                                                19
The following multithreaded algorithm computes the transpose in parallel:
P-T RANS (X, Y, N )
1 if N = 1
2     then Y [1, 1] � X[1, 1]
3     else Partition X into four (N/2) × (N/2) submatrices X11 , X12 , X21 , and X22 .
4          Partition Y into four (N/2) × (N/2) submatrices Y11 , Y12 , Y21 , and Y22 .
5          spawn P-T RANS (X11 , Y11 , N/2)
6          spawn P-T RANS (X12 , Y21 , N/2)
7          spawn P-T RANS (X21 , Y12 , N/2)
8          spawn P-T RANS (X22 , Y22 , N/2)
9          sync
(c) Give and solve recurrences describing the work T1 (N ) and critical-path length T� (N )
of P-T RANS . What is the asymptotic parallelism of the algorithm?
Solution:
N
�    �
T1 (N ) =    4T1       + O(1)
2
=   �(N 2 ).
N
� �
T� (N ) =     T�        + O(1)
2
=   �(lg N ).
The parallelism of the algoritm is T1 /T� , or �(N 2 / lg N ).
Handout 36: Final Exam Solutions                                                                  20
Professor Kellogg inadvertantly places two additional sync statements into his code as follows:
K-T RANS (X, Y, N )
1 if N = 1
2    then Y [1, 1] � X[1, 1]
3    else Partition X into four (N/2) × (N/2) submatrices X11 , X12 , X21 , and X22 .
4         Partition Y into four (N/2) × (N/2) submatrices Y11 , Y12 , Y21 , and Y22 .
5         spawn K-T RANS (X11 , Y11 , N/2)
6         sync
7         spawn K-T RANS (X12 , Y21 , N/2)
8         sync
9         spawn K-T RANS (X21 , Y12 , N/2)
10         spawn K-T RANS (X22 , Y22 , N/2)
11         sync
(d) Give and solve recurrences describing the work T1 (N ) and critical-path length T� (N )
of K-T RANS . What is the asymptotic parallelism of this algorithm?
Solution:   The work for the algorithm remains the same.
N
�    �
T1 (N ) = 4T1              + O(1)
2
= �(N 2 ).
The critical path increases, however, because we only solve one of the subproblems in
parallel.
N
�   �
T� (N ) = 3T�         + O(1)
2
= �(N lg 3 ).
The parallelism of the algorithm is T1 /T� , or �(N 2−lg 3 ).
SCRATCH PAPER — Please detach this page before handing in your exam.
SCRATCH PAPER — Please detach this page before handing in your exam.', 'source' => 'MIT OpenCourseWare, 6.046j Introduction To Algorithms Sma 5503, Fall 2005 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.046J — question d’examen, en anglais] For each algorithm listed below, �   give a recurrence that describes its worst-case running time, and �   give its worst-case running time using   �   -notation. You need not justify your answers. (a) Binary search (b) Insertion sort 6.046J/18.410J Quiz 1        Name   3 (c) Randomized quicksort (d) Strassen’s algorithm (e) Merge sort 6.046J/18.410J Quiz 1               Name                                                     4 Problem 2. Substitution Method [7 points] Consider the recurrence            -notation. Use the substitution method to give a tight upper bound on the solution to the recurrence using 6.046J/18.410J Quiz 1                    Name
For each algorithm listed below,
�   give a recurrence that describes its worst-case running time, and
�   give its worst-case running time using   �   -notation.
You need not justify your answers.
(a) Binary search
(b) Insertion sort
6.046J/18.410J Quiz 1        Name   3
(c) Randomized quicksort
(d) Strassen’s algorithm
(e) Merge sort
6.046J/18.410J Quiz 1               Name                                                     4
Problem 2. Substitution Method [7 points]
Consider the recurrence          
 -notation.
Use the substitution method to give a tight upper bound on the solution to the recurrence using
6.046J/18.410J Quiz 1                    Name                                                                  5
Problem 3. True or False, and Justify [48 points] (12 parts)
Circle T or F for each of the following statements to indicate whether the statement is true or
false, respectively. If the statement is correct, briefly state why. If the statement is wrong, explain
why. The more content you provide in your justification, the higher your grade, but be brief. Your
justification is worth more points than your true-or-false designation.
T F Let
   be  asymptotically
  and 
and 
   nonnegative
       functions. Then, at least one relationship of
must always hold.
                
T F The solution to the recurrence                                          is                           .
6.046J/18.410J Quiz 1               Name                                                           6


   th Fibonacci number. Then, the
T F Let � denote the                                           th Fibonacci number � can be
computed in              time.

can be sorted in
  time
T F Suppose that an array    contains numbers, each of which is 
in the worst case.
,  , or . Then, the array
6.046J/18.410J Quiz 1                         Name                                                    7


T F An adversary can provide randomized
      quicksort with an input array of length       that forces
the algorithm to run in �           time on that input.
T F The array
       

                
forms a max-heap.
6.046J/18.410J Quiz 1               Name                                                       8
T F Heapsort can be used as the auxiliary sorting routine in radix sort, because it operates in
place.

T F There exists a comparison sort of  numbers that uses at most comparisons in the worst
case.
6.046J/18.410J Quiz 1               Name                                                       9


 table with collisions resolved by chaining contains items and has a

T F Suppose that a hash
load factor of �                  simple uniform hashing, the expected time to search
. Assuming
for an item in the table is           .
                                              
                               
T F Let be an indicator random variable such that              . Then, we have 
 
 .
6.046J/18.410J Quiz 1                   Name                                                  10
T F Suppose that a hash table of slots contains a single element with key  and the rest of
�
the slots are empty. Suppose further that we search times in the table for various other

keys not equal to  . Assuming simple uniform hashing, the probability is     �that one of
the searches probes the slot containing the single element stored in the table.



   for so that determining
T F Let be a set of integers. One can create a data structure


whether an integer belongs to can be performed in
                              time in the worst case.
6.046J/18.410J Quiz 1                             Name                                                              11
�
Problem 4. Close  Numbers [15 points] (2 parts)
Consider a set

of        distinct numbers. Call a pair of distinct numbers           
close in

if
 

   

         
       
that is, if the distance between and is at most the average distance between consecutive numbers
in the sorted order.

 �
(a) Explain brieﬂy why every set                 of           distinct numbers contains a pair of close
elements.
6.046J/18.410J Quiz 1                           Name                                                          12
                                            �                  � �
                                           �
                                               
(b) Suppose that we partition    around a pivot element        , organizing the result into
two subsets of :                       and                                
 
                                                                 
. Prove that, for
                                            
                                                          
some                                         of numbers that are close in (not just
                                      
, there exists a pair                
in  ).

6.046J/18.410J Quiz 1               Name                                                     13
                                                 
(c) Describe an         -time algorithm to ﬁnd a close pair of numbers in . Analyze your
algorithm. (Hint: Use divide and conquer.)
SCRATCH PAPER — Please detach this page before handing in your exam.
SCRATCH PAPER — Please detach this page before handing in your exam.', 'mode' => 'solution', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : For each algorithm listed below,
• give a recurrence that describes its worst-case running time, and
• give its worst-case running time using �-notation.
You need not justify your answers.
(a) Binary search
Solution:   T (n) = T (n/2) + �(1) = �(lg n)
(b) Insertion sort
Solution:   T (n) = T (n − 1) + �(n) = �(n2 )
Handout 14: Quiz 1 Solutions                              3
(c) Strassen’s algorithm
Solution:    T (n) = 7T (n/2) + �(n2 ) = �(nlg 7 )
(d) Merge sort
Solution:    T (n) = 2T (n/2) + �(n) = �(n lg n)
Handout 14: Quiz 1 Solutions                                                                 4
Problem 2. Substitution Method [7 points]
Consider the recurrence
T (n) = T (n/2) + T (n/4) + n ,
T (m) = 1 for m � 5.
Use the substitution method to give a tight upper bound on the solution to the recurrence using
O-notation.
Solution: We guess T (n) = O(n), which leads to the induction hypothesis T (m) � cm for all
m < n. For c � 1, we have the base cases T (n) = 1 � cn for n � 5. The induction hypothesis
yields
T (n) = T (n/2) + T (n/4) + n � cn/2 + cn/4 + n = (3c/4 + 1)n.
If we choose c = 4, then T (n) � (3 + 1)n = 4n = cn. By induction on n, T (n) � cn for c � 4
and all n � 1.
Handout 14: Quiz 1 Solutions                                                                        5
Problem 3. True or False, and Justify [44 points] (11 parts)
Circle T or F for each of the following statements to indicate whether the statement is true or
false, respectively. If the statement is correct, brieﬂy state why. If the statement is wrong, explain
why. The more content you provide in your justiﬁcation, the higher your grade, but be brief. Your
justiﬁcation is worth more points than your true-or-false designation.
T F The solution to the recurrence T (n) = 3T (n/3) + O(lg n) is T (n) = �(n lg n).
Solution: False. Case 3 of the master theorem applies: f (n) = O(nlog3 3 ) = O(n) for
f (n) = O(lg n), hence, T (n) = O(n).
T F Let Fk denote the kth Fibonacci number. Then, the n2 th Fibonacci number Fn2 can be
computed in O(lg n) time.
Solution: True. The n2 th Fibonacci number can be computed in O(lg n2 ) = O(lg n)
time by using square and multiply method with matrix
�
1 1
.
1 0
Handout 14: Quiz 1 Solutions                                                                     6
T F Suppose that an array contains n numbers, each of which is −1, 0, or 1. Then, the array
can be sorted in O(n) time in the worst case.
Solution: True. We may use counting sort. We ﬁrst add 1 to each of the elements in the
input array such that the precondition of counting sort is satisﬁed. After running counting
sort, we subtract 1 from each of the elements in the sorted output array.
A solution based on partitioning is as follows. Let A[1 . . n] be the input array. We deﬁne
the invariant
•A[1 . . i] contains only −1,
•A[i + 1 . . j] contains only 0, and
•A[h . . n] contains only +1.
Initially, i = 0, j = 0, and h = n + 1. If h = j + 1, then we are done; the array is sorted.
In the loop we examine A[j + 1]. If A[j +1] = −1, then we exchange A[j +1] and A[i + 1]
and we increase both i and j with 1 (as in partition in quicksort). If A[j + 1] = 0, then we
increase j with 1. Finally, if A[j + 1] = +1, then we exchange A[j + 1] and A[h − 1] and
we decrease h by 1.
T F An adversary can provide randomized quicksort with an input array of length n that forces
the algorithm to run in �(n lg n) time on that input.
Solution: False. As we saw in lecture, for any input, the expected running time of
quicksort is O(n lg n), where the expectation is taken over the random choices made by
quicksort, independent of the choice of the input.
Handout 14: Quiz 1 Solutions                                                                   7
T F The array
20 15 18 7 9 5 12 3 6 2
forms a max-heap.
Solution:   True.
•A[1] = 20 has children A[2] = 15 � 20 and A[3] = 18 � 20.
•A[2] = 15 has children A[4] = 7 � 15 and A[5] = 9 � 15.
•A[3] = 18 has children A[6] = 5 � 18 and A[7] = 12 � 18.
•A[4] = 7 has children A[8] = 3 � 7 and A[9] = 6 � 7.
•A[5] = 9 has child A[10] = 2.
•A[6], . . . , A[10] have no children.
T F Heapsort can be used as the auxiliary sorting routine in radix sort, because it operates in
place.
Solution: False. The auxiliary sorting routine in radix sort needs to be stable, meaining
that numbers with the same value appear in the output array in the same order as they do
appear in the input array. Heapsort is not stable. It does operate in place, meaning that
only a constant number of elements of the input array are ever stored outside the array.
Handout 14: Quiz 1 Solutions                                                                 8
T F There exists a comparison sort of 5 numbers that uses at most 6 comparisons in the worst
case.
Solution: False. The number of leaves of a decision tree which sorts 5 numbers is 5!
and the height of the tree is at least lg(5!). Since 5! = 120, 26 = 64, and 27 = 128, we
have 6 < lg(5!) < 7. Thus at least 7 comparisons are required.
T F Suppose that a hash table with collisions resolved by chaining contains n items and has a
load factor of � = 1/ lg n. Assuming simple uniform hashing, the expected time to search
for an item in the table is O(1/ lg n).
Solution: False. The expected time to search for an item in the table is O(1 + �) =
O(1 + 1/ lg n) = O(1). At least a constant running time O(1) is needed to search for an
item; subconstant running time O(1/ lg n) is not possible.
Handout 14: Quiz 1 Solutions                                                                      9
��
T F Let X be an indicator random variable such that E [X] = 1/2. Then, we have E
�
X =
�
1/ 2.
Solution: False.
� Since X is an indicator random
�� variable, X = 0 or X = 1. For both
possible values X = X, which implies that E X = E [X] = 1/2.
�
T F Suppose that a hash table of m slots contains a single element with key k and the rest of
the slots are empty. Suppose further that we search r times in the table for various other
keys not equal to k. Assuming simple uniform hashing, the probability is r/m that one of
the r searches probes the slot containing the single element stored in the table.
Solution: False. The probability p that one of the r searches collides with the single
element stored in the table is equal to 1 minus the probability that none of the r searches
collides with the single element stored in the table. That is, p = 1 − (1 − 1/m) r .
Handout 14: Quiz 1 Solutions                                                              10
T F Let S be a set of n integers. One can create a data structure for S so that determining
whether an integer x belongs to S can be performed in O(1) time in the worst case.
Solution:   True. Perfect hashing.
Handout 14: Quiz 1 Solutions                                                                       11
Problem 4. Close Numbers [17 points] (3 parts)
Consider a set S of n � 2 distinct numbers. For simplicity, assume that n = 2 k + 1 for some
k � 0. Call a pair of distinct numbers x, y ≤ S close in S if
1
�                 �
|x − y| �         max z − min z         ,
n − 1 z�S     z�S
that is, if the distance between x and y is at most the average distance between consecutive numbers
in the sorted order.
(a) Explain brieﬂy why every set S of n � 2 distinct numbers contains a close pair of
numbers.
Solution: Without loss of generality, assume S = {z1 , z2 , . . . , zn }, with zi � zi+1 .
The average distance between two consecutive numbers zi and zi+1 is
1 n−1
�                   1
(zi+1 − zi ) =     (zn − z1 ).
n − 1 i=1                n−1
There exists at least one pair of consecutive numbers x and y whose distance between
them is less than or equal to the avearge. The result then follows from the deﬁnition
of the close pair.
Handout 14: Quiz 1 Solutions                                                                       12
(b) Suppose that we partition S around a pivot element p ≤ S, organizing the result into
two subsets of S: S1 = {x ≤ S | x � p} and S2 = {x ≤ S | x � p}. Prove that either
1. every pair x, y ≤ S1 of numbers that is close in S1 is also close in S, or
2. every pair x, y ≤ S2 of numbers that is close in S2 is also close in S.
Show how to determine, in O(n) time, a value k ≤ {1, 2} such that every pair x, y ≤
Sk of numbers that is close in Sk is also close in S.
Solution: Without loss of generality, assume that the elements in Si are in sorted
order. For k = 1, 2, let ak be the average distance between two consecutive numbers
in Sk , and let nk the number of elements in Sk . Using the result from Part (a), we have
1                      1
�                 �            �           �
a1 =        max z − min z =        p − min z ,
n1 − 1 z�S 1   z�S 1   n1 − 1     z�S
and
1                           1
�                �             �            �
a2 =          max z − min z =            max z − p .
n2 − 1   z�S 2   z�S 2      n2 − 1 z�S
The average distance a between two consecutive numbers in S in sorted order is then
given by
1
�                 �
a =         max z − min z
n − 1 z�S        z�S
1                       1
�          �           �           �
=         p − min z +            max z − p
n−1         z�S         n − 1 z�S
n1 − 1      n2 − 1
=        a1 +        a2 .
n−1         n−1
Note that n1 + n2 = n + 1, because p is included in both S1 and S2 . So, a is a weighted
average of a1 and a2 :
a = (1 − �)a1 + �a2 ,
where � = (n2 − 1)/(n − 1).
Suppose that a1 � a2 . If x and y are a close pair in S1 , then
|x − y | � a1 = (1 − �)a1 + �a1 � (1 − �)a1 + �a2 = a.
This implies that every close pair in S1 is also a close pair in S. Similarly, if a2 � a1 ,
then every close pair in S2 is a close pair in S.
The average distance ak can be computed in O(n) time, by searching for the minimum
or the maximum number in Sk . Therefore, the subset Sk with the speciﬁed property
can be computed in O(n) time.
Handout 14: Quiz 1 Solutions                                                                      13
(c) Describe an O(n)-time algorithm to ﬁnd a close pair of numbers in S. Explain brieﬂy
why your algorithm is correct, and analyze its running time. (Hint: Use divide and
conquer.)
Solution:    The idea is to partition S recursively until we ﬁnd a close pair.
1. Determine the median of S and use it to partion S into S1 and S2 .
2. Use the result from Part (b) to determine the set Sk that contains a close pair of S.
3. Recurse on Sk until Sk contains 2 elements.
Since each recursive step reduces the cardinality of the set by roughly a half, the
recursion is guaranteed to terminate. After each recursive step, the remaining set
contains a close pair of S.
Step 1 takes O(n) time in the worst case, if we use the deterministic median-ﬁnding
algorithm. Step 2 takes O(n) time based on the result from Part (b). Therefore, the
running time of the algorithm is given by the following recurrence:
T (n) = T (n/2) + O(n),
with the solution T (n) = O(n) according to the master theorem.
SCRATCH PAPER — Please detach this page before handing in your exam.
SCRATCH PAPER — Please detach this page before handing in your exam.', 'source' => 'MIT OpenCourseWare, 6.046j Introduction To Algorithms Sma 5503, Fall 2005 — examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20),
						),
					),
				),
			),
		);
	}
}
