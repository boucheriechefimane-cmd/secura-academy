<?php
/**
 * Questions importees — MIT OpenCourseWare — 6.830 Database Systems (Fall 2010)
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.830 Database Systems, Fall 2010 — quiz d’examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_830_examens' ) ) {
	function seca_import_mit_ocw_6_830_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-830-examens', 'nom' => 'MIT OpenCourseWare — 6.830 Database Systems (Fall 2010)', 'url' => 'https://ocw.mit.edu/courses/6-830-database-systems-fall-2010/pages/exams/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010 — quiz d’examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.830 — question d’examen, en anglais]

To reduce the number of plans the query optimizer must consider, the Selinger Opti­
mizer employs a number of heuristics to reduce the search space. List three:', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : - Push selections down to the leaves.
- Push projections down.
- Consider only left deep plans.
- Join tables without join predicates (cross product joins) as late as possible.', 'source' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010'),
							array('question' => '[MIT 6.830 — question d’examen, en anglais]

Time
Read Validate Write
T1
Read set: {A,B} Write set: {B,C}
T2
Read set: {A,D} Write set: {A,B}', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Transactions that commit: T1,T2 or T1
Transactions that abort: {} or T2
Justification:
There are two correct solutions:
T1 and T2 both commit. T1 commits because it validates first. T2 will also commit because while
its write set intersects T1\'s write set, T1 finishes its write phase before T2 starts its write phase
(condition 2 in section 3.1 of the paper).
T1 commits, T2 aborts. T1 commits because it validates first. In the pseudocode from the paper
(section 5), T1 is executing the line marked "write phase" when T2 starts its validation phase. T2
finds T1 in the "finish active" set, and aborts due to a write/write conflict. This is sort of a "false"
conflict, since it would be safe for T2 to commit. However, the parallel algorithm assumes that T1
is still writing at the time that T2 detects the conflict, so it must abort.', 'source' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010'),
							array('question' => '[MIT 6.830 — question d’examen, en anglais]

What could a database administrator do to make sure the properties not explicitly en­
forced by your schema are enforced by the database?', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Use triggers or stored procedures to ensure that these constraints are checked when data is in­
serted or updated.
IV External Aggregation
Suppose you are implementing an aggregation operator for a database system, and you need to support aggre­
gation over very large data sets with more groups than can fit into memory.
Your friend Johnny Join begins writing out how he would implement the algorithm. Unfortunately, he stayed
up all night working on Lab 3 and so trails off in an incoherent stream of obscenities and drool before finishing
his code. His algorithm begins as follows:
input : Table T , aggregation function f name, aggregation field agg f , group by field gby f
/* Assume T has |T | pages and your system has |M| pages of memory */
/* Partition phase */
� |T | �
n ← |M| ;
Allocate bu f s, n pages of memory for output buffers ;
Allocate f iles, an array of n files for partitions ;
foreach record r ∈ T do
h ← hash(r.gby f ) ; /* h ∈ [1 . . . n] */
Write r into page bu f s[h] ;
if page bu f s[h] is full then
Add bu f s[h] to file f iles[h], and set the contents of bu f s[h] to empty ;
end
end
/* Aggregate phase */
foreach f ∈ f iles do
/* Your code goes here. */
end', 'source' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010'),
							array('question' => '[MIT 6.830 — question d’examen, en anglais]

Assuming the aggregate phase does only one pass over the data, and that f name
= \'AVG\', describe briefly what should go in the body of the for loop (in place of "Your code goes
here"). You may write pseudocode or a few short sentences. Suppose the system provides a function
emit(group,val) to output the value of a group.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : All tuples with the same gby f will end up in the same partition, but there may (very likely will) be multiple
gby f values per partition.
The basic algorithm should be something like:
H = new HashTable // stores (gbyf, <sum,cnt>) pairs
for tuple t in f:
if ((<sum,cnt> = H.get(t.gbyf)) == null)
<sum,cnt> = <0,0>
sum = sum + t.aggf
cnt = cnt + 1
T.put(t.gbyf,<sum,cnt>)
for (group, <sum,cnt>) in T:
emit(group,sum/cnt)
Any in-memory aggregation would work here, so if you prefer to sort the values in memory and then
bucket them as is done in the next question, that is also an acceptable answer.', 'source' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010'),
							array('question' => '[MIT 6.830 — question d’examen, en anglais]

After recovery, which transactions will be committed and which will be aborted?', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Committed:
Aborted:
T1 commits, while T2 and T3 abort, since T1 is the only transaction that has a COMMIT record in
the log.', 'source' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010'),
							array('question' => '[MIT 6.830 — question d’examen, en anglais]

Oracle claims that snapshot isolation is much faster than traditional concurrency con­
trol. Why?', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Writes never block readers. For example, if a long running transaction has written value A, with
traditional concurrency control any transaction that wants to read A will need to wait to acquire
a lock on A. With snapshot isolation, the reading transactions will read the previous version and
continue.
This is similar to optimistic concurrency control in that there are no locks and transactions do not
block each other. However, with snapshot isolation, a transaction sees a consistent snapshot of
the database, determined when it begins. With optimistic concurrency control, a transaction can
see values from transactions that commit after it begins.', 'source' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010'),
							array('question' => '[MIT 6.830 — question d’examen, en anglais]

If the data were stored in a traditional relational database system using strict two-phase
locking, and transfer() and totalAssets() were each implemented as single transactions, what would the
possible results of totalAssets() be? Provide a short explanation for your answer.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : $9,900 is the only possible solution because the DBMS will use concurrency control to execute the to­
talAssets transaction either strictly before or after the transfer transaction.
IV Distributed Query Execution
Suppose you have a database with two tables with the following schema:
T1 : (A int PRIMARY KEY, B int, C varchar)
T2 : (D int REFERENCES T1.A, E varchar)
And suppose you are running the following query:
SELECT T1.A,COUNT(*)
FROM T1,T2
AND T1.A = T2.D
AND T1.B > n
GROUP BY T1.A
Your system has the following configuration:
Parameter Description Value
|T 1| Size of table T1 300 MB
|T 2| Size of table T2 600 MB
|M| Size of memory of a single node 100 MB
||T 1|| Number of records in T 1 10 million
|int| Size of integer, in bytes 4
T Disk throughput, in bytes / sec 20 MB/sec
N Network transmit rate, in bytes / sec 10 MB/sec
f Fraction of tuples selected by T1.B > n predicate 0.5', 'source' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010'),
							array('question' => '[MIT 6.830 — question d’examen, en anglais]

Suggest an adaptive query processing technique that changes the plan while it is
running to switch between a sequential scan and a (possibly correlated) secondary index, depending
on which is better. Your solution should not require precomputing any additional statistics. Be sure to
indicate how your approach avoids producing duplicate results when it switches plans.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Start using secondary indices, assuming correlations are present.
If the number of seeks performed while scanning some small fraction of the range (e.g., the first 1%) is
close to what the original secondary model predicts, switch to sequential scan if the overall cost will be
lower.
Avoid duplicates by keeping a list of secondary index key values that the system has already scanned,
and filtering out tuples in that list. Since the scan is done in order of the secondary index key, this list
be efficiently represented as a range of keys (e.g., a (lower bound, upper bound) pair).', 'source' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010'),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.830 — question d’examen, en anglais]

Give one reason why the REDO pass of ARIES must use physical logging.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The pages on disk may be in any state between "no updates applied" and "all updates applied."
Logical redo cannot be used on an indeterminate state, whereas physically redo logging just over­
writes the data on disk with the logged values. In other words, physical logging is idempotent
whereas logical logging is not.
For the following transaction schedules, indicate which transactions would commit and which would abort
when run using the parallel validation scheme described in the Kung and Robinson paper on Optimistic
Concurrency Control. Also give a brief justification for your answer. You may assume that if a transaction
aborts, it does not execute its write phase, rolling back instantly at the end of the validation phase.', 'source' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010'),
							array('question' => '[MIT 6.830 — question d’examen, en anglais]

Read Validate Write
T1
Read set: {A,B} Write set: {B,C}
T2
Read set: {A,B} Write set: {B,D}
T3
Read set: {D} Write set: {D}', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Transactions that commit: T1,T3
Transactions that abort:T2
Justification:
T1 and T3 commit, T2 aborts. T1 commits because it validates first. T2 must abort because T1\'s
write set intersects T2\'s read set, and T2 was started reading before T1 finished writing. T3 then
commit because although it has a conflict with T2, when it begins the validation algorithm, T2 has
already aborted (it finishes aborting at the end of the validation phase).
III Schema Design
Consider a relational table:
Professor(
professor name, professor id,
professor office id, student id,
student name, student office id,
student designated refrigerator id, refrigerator owner id,
refrigerator id, refrigerator size, secretary name,
secretary id, secretary office )
Suppose the data has the following properties:
A. Professors and secretaries have individual offices, students share offices.
B. Students can work for multiple professors.
C. Refrigerators are owned by one professor.
D. Professors can own multiple refrigerators.
E. Students can only use one refrigerator.
F. The refrigerator the student uses must be owned by one of the professors they work for.
G. Secretaries can work for multiple professors.
H. Professors only have a single secretary.', 'source' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010'),
							array('question' => '[MIT 6.830 — question d’examen, en anglais]

Relative to |T |, how big must |M| be for the algorithm to function correctly? Justify your
answer with a sentence or brief analytical argument.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Because bu f s should fit in memory, n ≤ |M|.
� |T | �
The number of hash buckets is computed as n = |M| .
� |T | �
Plugging in for n, we get that |M| ≤ |M|.
Therefore, |T | ≤ |M|2 .
√
It follows that |M| ≥ |T |.', 'source' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010'),
							array('question' => '[MIT 6.830 — question d’examen, en anglais]

Describe an alternative to this hashing-based algorithm. Your answer shouldn\'t require
more than a sentence or two.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Remember that the tuples do not fit in memory.
One solution would be to use an external memory sort on the table, where the sort key for each tuple is
the gbyf field.
After sorting, sequentially scan the sorted file\'s tuples, keeping a running average for each gbyf grouping
(they will appear in contiguous chunks in the file). The average should be calculated on each aggf field.
Other solutions included using external memory indices, such as B+Trees, on gbyf to group the tuples on
which to calculate an average.
Suppose you are given a database with the following tables and sizes, and that each data page holds 100
tuples, that both leaf and non-leaf B+Tree pages are dense-packed and hold 100 keys, and that you have 102
pages of memory. Assume that the buffer pool is managed as described in the DBMIN Paper ("An Evaluation
of Buffer Management Strategies for Relational Database Systems.", VLDB 1985.)
Table Size, in pages
T1 100
T2 1000
T3 5000', 'source' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010'),
							array('question' => '[MIT 6.830 — question d’examen, en anglais]

Is snapshot isolation conflict serializable? If yes, state briefly why. If not, give an
example of a non-serializable schedule.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : No. Snapshot isolation ignores read/write conflicts. Consider T1: (RA , WB ) and T2: (RB , WA ).
These execute in the following order:
RA0 (T1), RB0 (T2), WB1 (T1), WA2 (T2)
Under snapshot isolation, this order is acceptable and both transactions can commit. However, this
is neither serial orders T1, T2 (where T2 would RB1 ) or T2, T1 (where T1 would RA2 ).', 'source' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010'),
							array('question' => '[MIT 6.830 — question d’examen, en anglais]

List two reasons why a column-oriented design is advantageous in a data warehouse
environment.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : A. Data warehouse workloads involve large scans of a few columns, meaning that column-stores
read less data from disk
B. Columns tend to compress better than rows, which is good in a read intensive setting.
Other answers are possible.', 'source' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010'),
							array('question' => '[MIT 6.830 — question d’examen, en anglais]

Suppose you run the query on a single node. Assuming there are no indices, and the
tables are not sorted, indicate what join algorithm (of the algorithms we have studied in class) would be
most efficient, and estimate the time to process the query, ignoring disk seeks and CPU costs. Include a
brief justification or calculation.', 'mode' => 'solution', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Join algorithm:
Read all of A (300MB), applying the predicate and projecting to keep only T1.A. Build an in-memory
hash table with the results: 10 million tuples in T1 × 12 = 5 million output tuples × 4 bytes per tuple
= 20 MB of data. Sequentially scan T2 (600 MB), probing T2.D in the hash table. Emit T1.A for each
matching join tuple, and build a hash aggregate to count the number of times T1.A appears (5 million
output tuples × (4 bytes id + 4 bytes count) = 40 MB). Finally iterate over the aggregate and output the
results to the user.
Estimated time, in seconds:
300MB
Read T1 in 20MB/s = 15s. Read T2 in 20MB/s
600MB
= 30s.
Total time: 45 seconds.', 'source' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.830 Database Systems, Fall 2010'),
						),
					),
				),
			),
		);
	}
}
