<?php
/**
 * Questions importees — MIT OpenCourseWare — 6.005 Software Construction (Spring 2016)
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.005 Software Construction, Spring 2016 — quiz d’examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_005_examens' ) ) {
	function seca_import_mit_ocw_6_005_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-005-examens', 'nom' => 'MIT OpenCourseWare — 6.005 Software Construction (Spring 2016)', 'url' => 'https://ocw.mit.edu/courses/6-005-software-construction-spring-2016/pages/quizzes/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.005 Software Construction, Spring 2016 — quiz d’examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'authentification' => array(
					'title' => 'authentification',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.005 — question d’examen, en anglais] Problem 3 (Abstract Data Types) (25 points).
Silly Simon forgot to document his abstraction function and rep invariant! Select statements to put into the AF and RI of PosIntBinaryTree by circling the letters of all statements to include from the list below. Include all good statements that are compatible with Simon’s design. AF: A B C D E F G RI: A B C D E F G
A. for all 0 <= i < nodes.size(), nodes.get(i).get(0) > 0
B. if nodes.size() == 0, represents the empty tree
C. if nodes.size() > 0, nodes.get(0).get(0) is the root node
D. nodes.get(i).size() == 2^i
E. nodes.size() == 2^k for some nonnegative integer k
F. for node nodes.get(i).get(j), its left child (if any) is nodes.get(i+1).get(j*2)
G. for node nodes.get(i).get(j), its right child (if any) is nodes.get(i+1).get(j*2+1) Rob Recursive, an even more enthusiastic student, wants to represent binary trees of any integers.
Réponds par les lettres des propositions justes (A, D par exemple).', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : . AF: B, C, F, and G. RI: D.  Rob Recursive, an even more enthusiastic student, wants to represent binary trees of any integers.

[Correction officielle MIT : [MIT 6.005 — question d’examen, en anglais] Problem 3 (Abstract Data Types) (25 points).
Silly Simon forgot to document his abstraction function and rep invariant! Select statements to put into the AF and RI of PosIntBinaryTree by circling the letters of all statements to include from the list below. Include all good statements that are compatible with Simon’s design. AF: A B C D E F G RI: A B C D E F G
A. for all 0 <= i < nodes.size(), nodes.get(i).get(0) > 0
B. if nodes.size() == 0, represents the empty tree
C. if nodes.size() > 0, nodes.get(0).get(0) is the root node
D. nodes.get(i).size() == 2^i
E. nodes.size() == 2^k for some nonnegative integer k
F. for node nodes.get(i).get(j), its left child (if any) is nodes.get(i+1).get(j*2)
G. for node nodes.get(i).get(j), its right child (if any) is nodes.get(i+1).get(j*2+1) Rob Recursive, an even more enthusiastic student, wants to represent binary trees of any integers.
Réponds par les lettres des propositions justes (A, D par exemple).]', 'source' => 'MIT OpenCourseWare, 6.005 Software Construction, Spring 2016 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 6.005 — question d’examen, en anglais] Problem 3 (Abstract Data Types) (25 points).
Silly Simon forgot to document his abstraction function and rep invariant! Select statements to put into the AF and RI of PosIntBinaryTree by circling the letters of all statements to include from the list below. Include all good statements that are compatible with Simon’s design. AF: A B C D E F G RI: A B C D E F G
A. for all 0 <= i < nodes.size(), nodes.get(i).get(0) > 0
B. if nodes.size() == 0, represents the empty tree
C. if nodes.size() > 0, nodes.get(0).get(0) is the root node
D. nodes.get(i).size() == 2^i
E. nodes.size() == 2^k for some nonnegative integer k
F. for node nodes.get(i).get(j), its left child (if any) is nodes.get(i+1).get(j*2)
G. for node nodes.get(i).get(j), its right child (if any) is nodes.get(i+1).get(j*2+1) Rob Recursive, an even more enthusiastic student, wants to represent binary trees of any integers.
Réponds par les lettres des propositions justes (A, D par exemple).', '_recupere_le' => '2026-11-04T19:55:22.637898+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : . AF: B, C, F, and G. RI: D.  Rob Recursive, an even more enthusiastic student, wants to represent binary trees of any integers.

[Correction officielle MIT : [MIT 6.005 — q')),
							array('question' => '[MIT 6.005 — question d’examen, en anglais] Problem 3 (Abstract Data Types) (25 points).
Start implementing the other concrete variant by writing its field declarations, abstraction function, and rep invariant. If parts of the AF or RI would normally be assumed in 6.005, write them explicitly. Fields: AF: RI: 7 Your name: Quiz 2 (April 22, 2016)', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : private final int value; private final IntBinaryTree left, right; AF: represents the immutable binary tree of integers with root node value, left subtree left, and right subtree right RI: left,right != null 

[Correction officielle MIT : [MIT 6.005 — question d’examen, en anglais] Problem 3 (Abstract Data Types) (25 points).
Start implementing the other concrete variant by writing its field declarations, abstraction function, and rep invariant. If parts of the AF or RI would normally be assumed in 6.005, write them explicitly. Fields: AF: RI: 7 Your name: Quiz 2 (April 22, 2016)]', 'source' => 'MIT OpenCourseWare, 6.005 Software Construction, Spring 2016 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 6.005 — question d’examen, en anglais] Problem 3 (Abstract Data Types) (25 points).
Start implementing the other concrete variant by writing its field declarations, abstraction function, and rep invariant. If parts of the AF or RI would normally be assumed in 6.005, write them explicitly. Fields: AF: RI: 7 Your name: Quiz 2 (April 22, 2016)', '_recupere_le' => '2026-11-04T19:55:22.638034+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : private final int value; private final IntBinaryTree left, right; AF: represents the immutable binary tree of integers with root node value, left subtree left, and right subt')),
						),
					),
				),
				'chiffrement-et-https' => array(
					'title' => 'chiffrement-et-https',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.005 — question d’examen, en anglais] Problem 3 (AFs & RIs) (20 points).
/** * Update this tetromino’s rotation number to add 1, mod 4. */ Comment:', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The specification must be abstract, it should not talk about the representation. The specification should be declarative, not operational. 

[Correction officielle MIT : [MIT 6.005 — question d’examen, en anglais] Problem 3 (AFs & RIs) (20 points).
/** * Update this tetromino’s rotation number to add 1, mod 4. */ Comment:]', 'source' => 'MIT OpenCourseWare, 6.005 Software Construction, Spring 2016 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 6.005 — question d’examen, en anglais] Problem 3 (AFs & RIs) (20 points).
/** * Update this tetromino’s rotation number to add 1, mod 4. */ Comment:', '_recupere_le' => '2026-11-04T19:55:22.638103+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The specification must be abstract, it should not talk about the representation. The specification should be declarative, not operational. 

[Correction officielle MIT : [MI')),
						),
					),
				),
				'la-boutique-en-ligne-se-connecter-en-administrateur' => array(
					'title' => 'la-boutique-en-ligne-se-connecter-en-administrateur',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.005 — question d’examen, en anglais] Problem 4 (Recursive Data Types) (20 points).
Implement the operation. Use De Morgan’s laws and the rule for double negation: ¬(P ∧ Q) = ¬P ∨ ¬Q and ¬(P ∨ Q) = ¬P ∧ ¬Q and ¬¬P = P public class Variable implements NegNormFormula { private final String name; private final boolean isNegated; public Variable(String name, boolean isNegated) { ... } @Override public NegNormFormula negate() { } } public class And implements NegNormFormula { private final NegNormFormula left; private final NegNormFormula right; public And(NegNormFormula left, NegNormFormula right) { ... } @Override public NegNormFormula negate() { } } public class Or implements NegNormFormula { private final NegNormFormula left; private final NegNormFormula right; public Or(NegNormFormula left, NegNormFormula right) { ... } @Override public NegNormFormula negate() { } } 9 Your name: Quiz 2 (April 22, 2016)', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : return new Variable(name, ! isNegated);  } } public class And implements NegNormFormula { private final NegNormFormula left; private final NegNormFormula right; public And(NegNormFormula left, NegNormFormula right) { ... } @Override public NegNormFormula negate() {

[Correction officielle MIT : [MIT 6.005 — question d’examen, en anglais] Problem 4 (Recursive Data Types) (20 points).
Implement the operation. Use De Morgan’s laws and the rule for double negation: ¬(P ∧ Q) = ¬P ∨ ¬Q and ¬(P ∨ Q) = ¬P ∧ ¬Q and ¬¬P = P public class Variable implements NegNormFormula { private final String name; private final boolean isNegated; public Variable(String name, boolean isNegated) { ... } @Override public NegNormFormula negate() { } } public class And implements NegNormFormula { private final NegNormFormula left; private final NegNormFormula right; public And(NegNormFormula left, NegNormFormula right) { ... } @Override public NegNormFormula negate() { } } public class Or implements NegNormFormula { private final NegNormFormula left; private final NegNormFormula right; public Or(NegNormFormula left, NegNormFormula right) { ... } @Override public NegNormFormula negate() { } } 9 Your name: Quiz 2 (April 22, 2016)]', 'source' => 'MIT OpenCourseWare, 6.005 Software Construction, Spring 2016 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 6.005 — question d’examen, en anglais] Problem 4 (Recursive Data Types) (20 points).
Implement the operation. Use De Morgan’s laws and the rule for double negation: ¬(P ∧ Q) = ¬P ∨ ¬Q and ¬(P ∨ Q) = ¬P ∧ ¬Q and ¬¬P = P public class Variable implements NegNormFormula { private final String name; private final boolean isNegated; public Variable(String name, boolean isNegated) { ... } @Override public NegNormFormula negate() { } } public class And implements NegNormFormula { private final NegNormFormula left; private final NegNormFormula right; public And(NegNormFormula left, NegNormFormula right) { ... } @Override public NegNormFormula negate() { } } public class Or implements NegNormFormula { private final NegNormFormula left; private final NegNormFormula right; public Or(NegNormFormula left, NegNormFormula right) { ... } @Override public NegNormFormula negate() { } } 9 Your name: Quiz 2 (April 22, 2016)', '_recupere_le' => '2026-11-04T19:55:22.638397+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : return new Variable(name, ! isNegated);  } } public class And implements NegNormFormula { private final NegNormFormula left; private final NegNormFormula right; public And(N')),
						),
					),
				),
				'la-requete-qui-ne-se-fie-a-personne' => array(
					'title' => 'la-requete-qui-ne-se-fie-a-personne',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.005 — question d’examen, en anglais] Problem 3 (AFs & RIs) (20 points).
/** * @return this tetromino rotated by 90 degrees clockwise */ Comment:', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : The specification, which says a Tetromino is returned, does not agree with return type void. 

[Correction officielle MIT : [MIT 6.005 — question d’examen, en anglais] Problem 3 (AFs & RIs) (20 points).
/** * @return this tetromino rotated by 90 degrees clockwise */ Comment:]', 'source' => 'MIT OpenCourseWare, 6.005 Software Construction, Spring 2016 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 6.005 — question d’examen, en anglais] Problem 3 (AFs & RIs) (20 points).
/** * @return this tetromino rotated by 90 degrees clockwise */ Comment:', '_recupere_le' => '2026-11-04T19:55:22.638461+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : The specification, which says a Tetromino is returned, does not agree with return type void. 

[Correction officielle MIT : [MIT 6.005 — question d’examen, en anglais] Probl')),
						),
					),
				),
				'le-binaire-qui-obeit-trop' => array(
					'title' => 'le-binaire-qui-obeit-trop',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.005 — question d’examen, en anglais] Problem 5 (Thread Safety) (17 points).
Unfortunately, even though TwoVotesEachElection uses threadsafe datatypes, the vote() opera- tion is not threadsafe. Explain clearly an interleaving that violates thread safety for TwoVotesEachElection. Louis Reasoner is convinced that using AtomicInteger is unnecessary, so he changes the code to use primitive integers instead: public class LouisTwoVotesEachElection { private final int[] voteCounts; private final Set<String> voters; // ... constructor initializes voteCounts to an array of zeros, // and initializes voters to a threadsafe Set ... public int getNumberOfCandidates() { return voteCounts.length; } // requires: 0 <= can1, can2 < getNumberOfCandidates() // effects: if and only if the voter hasn’t already voted, casts both votes public void vote(final String voterID, final int can1, final int can2) { if (voters.contains(voterID)) { return; } voters.add(voterID); voteCounts[can1]++; voteCounts[can2]++; } // ... } Of course, this just makes the problem worse.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Two threads enter vote with the same voterID not yet in voters. Both threads call voters.contains and obtain false, then both call voters.add successfully. At this point, both threads will increment the vote counts for their can1 and can2, giving this voter 4 votes instead of 2, in violation of the postcondition.  Louis Reasoner is convinced that using AtomicInteger is unnecessary, so he changes the code to use primitive integers instead: public class LouisTwoVotesEachElection { private final int[] voteCounts; private final Set<String> voters; // ... constructor initializes voteCounts to an array of zeros, // and initializes voters to a threadsafe Set ... public int getNumberOfCandidates() { return voteCounts.length; } // requires: 0 <= can1, can2 < getNumberOfCandidates() // effects: if and only if the voter hasn’t already voted, casts both votes public void vote(final String voterID, final int can1, final int can2) { if (voters.contains(voterID)) { return; } 8 voters.add(voterID); voteCounts[can1]++; voteCounts[can2]++; } // ... } Of course, this just makes the problem worse.

[Correction officielle MIT : [MIT 6.005 — question d’examen, en anglais] Problem 5 (Thread Safety) (17 points).
Unfortunately, even though TwoVotesEachElection uses threadsafe datatypes, the vote() opera- tion is not threadsafe. Explain clearly an interleaving that violates thread safety for TwoVotesEachElection. Louis Reasoner is convinced that using AtomicInteger is unnecessary, so he changes the code to use primitive integers instead: public class LouisTwoVotesEachElection { private final int[] voteCounts; private final Set<String> voters; // ... constructor initializes voteCounts to an array of zeros, // and initializes voters to a threadsafe Set ... public int getNumberOfCandidates() { return voteCounts.length; } // requires: 0 <= can1, can2 < getNumberOfCandidates() // effects: if and only if the voter hasn’t already voted, casts both votes public void vote(final String voterID, final int can1, final int can2) { if (voters.contains(voterID)) { return; } voters.add(voterID); voteCounts[can1]++; voteCounts[can2]++; } // ... } Of course, this just makes the problem worse.]', 'source' => 'MIT OpenCourseWare, 6.005 Software Construction, Spring 2016 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 6.005 — question d’examen, en anglais] Problem 5 (Thread Safety) (17 points).
Unfortunately, even though TwoVotesEachElection uses threadsafe datatypes, the vote() opera- tion is not threadsafe. Explain clearly an interleaving that violates thread safety for TwoVotesEachElection. Louis Reasoner is convinced that using AtomicInteger is unnecessary, so he changes the code to use primitive integers instead: public class LouisTwoVotesEachElection { private final int[] voteCounts; private final Set<String> voters; // ... constructor initializes voteCounts to an array of zeros, // and initializes voters to a threadsafe Set ... public int getNumberOfCandidates() { return voteCounts.length; } // requires: 0 <= can1, can2 < getNumberOfCandidates() // effects: if and only if the voter hasn’t already voted, casts both votes public void vote(final String voterID, final int can1, final int can2) { if (voters.contains(voterID)) { return; } voters.add(voterID); voteCounts[can1]++; voteCounts[can2]++; } // ... } Of course, this just makes the problem worse.', '_recupere_le' => '2026-11-04T19:55:22.638819+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Two threads enter vote with the same voterID not yet in voters. Both threads call voters.contains and obtain false, then both call voters.add successfully. At this point, bot')),
						),
					),
				),
				'memoire-et-defenses' => array(
					'title' => 'memoire-et-defenses',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.005 — question d’examen, en anglais] Problem 1 (Multiple Choice) (20 points).
The line of Java code String t = arr[0]; involves... (choose all that apply)
A. assignment
B. equivalence relation
C. mutation
D. static typing
Réponds par les lettres des propositions justes (A, D par exemple).', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : A, D. This line assigns to t, which has static type String. 

[Correction officielle MIT : [MIT 6.005 — question d’examen, en anglais] Problem 1 (Multiple Choice) (20 points).
The line of Java code String t = arr[0]; involves... (choose all that apply)
A. assignment
B. equivalence relation
C. mutation
D. static typing
Réponds par les lettres des propositions justes (A, D par exemple).]', 'source' => 'MIT OpenCourseWare, 6.005 Software Construction, Spring 2016 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 6.005 — question d’examen, en anglais] Problem 1 (Multiple Choice) (20 points).
The line of Java code String t = arr[0]; involves... (choose all that apply)
A. assignment
B. equivalence relation
C. mutation
D. static typing
Réponds par les lettres des propositions justes (A, D par exemple).', '_recupere_le' => '2026-11-04T19:55:22.638941+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : A, D. This line assigns to t, which has static type String. 

[Correction officielle MIT : [MIT 6.005 — question d’examen, en anglais] Problem 1 (Multiple Choice) (20 points')),
							array('question' => '[MIT 6.005 — question d’examen, en anglais] Problem 2 (Specifications) (20 points).
Consider these different specifications for the isValidShape function: public static boolean isValidShape(char shape) /** Spec A * @param shape any character * @return true iff shape is a lowercase tetromino shape letter */ /** Spec B * @param shape an English alphabetic character * @return true iff shape is a lowercase tetromino shape letter */ /** Spec C * @param shape a lowercase tetromino shape letter * @return true */ Compare these specifications. For each pair below, circle one', 'mode' => 'choice', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Spec A is stronger than spec B because its precondition is weaker and its postcondition is the same.  B vs. C: equivalent to weaker than Spec B is spec C because stronger than incomparable to', 'source' => 'MIT OpenCourseWare, 6.005 Software Construction, Spring 2016 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'choices' => array('Pas option and write write a brief explanation to complete the sentence. a vs. b: equivalent to weaker than spec a is spec b because stronger than incomparable to b vs. c: equivalent to weaker than spec b is spec c because stronger than incomparable to 6 your name: quiz 1 (march 14, 2016)', 'L\'inverse de option and write write a brief explanation to complete the sentence. a vs. b: equivalent to weaker than spec a is spec b because stronger than incomparable to b vs. c: equivalent to weaker than spec b is spec c because stronger than incomparable to 6 your name: quiz 1 (march 14, 2016)', 'option and write write a brief explanation to complete the sentence. A vs. B: equivalent to weaker than Spec A is spec B because stronger than incomparable to B vs. C: equivalent to weaker than Spec B is spec C because stronger than incomparable to 6 Your name: Quiz 1 (March 14, 2016)', 'Impossible à déterminer'), 'correct' => 2, 'answer' => 'option and write write a brief explanation to complete the sentence. A vs. B: equivalent to weaker than Spec A is spec B because stronger than incomparable to B vs. C: equivalent to weaker than Spec B is spec C because stronger than incomparable to 6 Your name: Quiz 1 (March 14, 2016)', '_recupere_le' => '2026-11-04T19:55:22.639250+00:00Z', '_strategie' => 'separation_enum_solution'),
						),
					),
				),
				'securiser-une-application-web' => array(
					'title' => 'securiser-une-application-web',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.005 — question d’examen, en anglais] Problem 3 (AFs & RIs) (20 points).
For each of the statements below, say whether it should be included in the internal documentation of Tetromino by writing: AF if the statement belongs in the abstraction function RI ... the rep invariant EXP ... the argument that type has no rep exposure NONE if it should not be included in any of those You should include in the AF, RI, or EXP all good statements that are compatible with the code and specs on the previous page. Do not include statements that are not compatible with the code and specs. shape is private and an immutable value rotation is private and an immutable value this Tetromino is never returned to clients shape is an uppercase tetromino shape letter shapeLetter is an uppercase tetromino shape letter the tetromino has the shape given by shape rotation = 0 the tetromino is rotated clockwise by rotation the tetromino is rotated clockwise rotation times 90 degrees 0 <= rotation < 4 0 <= rotation < 360 rotation is one of { 0, 90, 180, 270 } 8 Your name: Quiz 1 (March 14, 2016) Consider these different specifications for the rotateClockwise method: public void rotateClockwise() For each possible specification below, write a one-sentence code review comment that identifies the most serious problem with the spec.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : EXP EXP NONE (doesn’t make sense) RI NONE (part of the precondition of the constructor) AF NONE NONE AF (see e.g. toString) RI (established by constructor, maintained by rotateClockwise) NONE NONE  Consider these different specifications for the rotateClockwise method: public void rotateClockwise() For each possible specification below, write a one-sentence code review comment that identifies the most serious problem with the spec.

[Correction officielle MIT : [MIT 6.005 — question d’examen, en anglais] Problem 3 (AFs & RIs) (20 points).
For each of the statements below, say whether it should be included in the internal documentation of Tetromino by writing: AF if the statement belongs in the abstraction function RI ... the rep invariant EXP ... the argument that type has no rep exposure NONE if it should not be included in any of those You should include in the AF, RI, or EXP all good statements that are compatible with the code and specs on the previous page. Do not include statements that are not compatible with the code and specs. shape is private and an immutable value rotation is private and an immutable value this Tetromino is never returned to clients shape is an uppercase tetromino shape letter shapeLetter is an uppercase tetromino shape letter the tetromino has the shape given by shape rotation = 0 the tetromino is rotated clockwise by rotation the tetromino is rotated clockwise rotation times 90 degrees 0 <= rotation < 4 0 <= rotation < 360 rotation is one of { 0, 90, 180, 270 } 8 Your name: Quiz 1 (March 14, 2016) Consider these different specifications for the rotateClockwise method: public void rotateClockwise() For each possible specification below, write a one-sentence code review comment that identifies the most serious problem with the spec.]', 'source' => 'MIT OpenCourseWare, 6.005 Software Construction, Spring 2016 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'xp' => 20, 'answer' => '[MIT 6.005 — question d’examen, en anglais] Problem 3 (AFs & RIs) (20 points).
For each of the statements below, say whether it should be included in the internal documentation of Tetromino by writing: AF if the statement belongs in the abstraction function RI ... the rep invariant EXP ... the argument that type has no rep exposure NONE if it should not be included in any of those You should include in the AF, RI, or EXP all good statements that are compatible with the code and specs on the previous page. Do not include statements that are not compatible with the code and specs. shape is private and an immutable value rotation is private and an immutable value this Tetromino is never returned to clients shape is an uppercase tetromino shape letter shapeLetter is an uppercase tetromino shape letter the tetromino has the shape given by shape rotation = 0 the tetromino is rotated clockwise by rotation the tetromino is rotated clockwise rotation times 90 degrees 0 <= rotation < 4 0 <= rotation < 360 rotation is one of { 0, 90, 180, 270 } 8 Your name: Quiz 1 (March 14, 2016) Consider these different specifications for the rotateClockwise method: public void rotateClockwise() For each possible specification below, write a one-sentence code review comment that identifies the most serious problem with the spec.', '_recupere_le' => '2026-11-04T19:55:22.639741+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : EXP EXP NONE (doesn’t make sense) RI NONE (part of the precondition of the constructor) AF NONE NONE AF (see e.g. toString) RI (established by constructor, maintained by rota')),
						),
					),
				),
			),
		);
	}
}
