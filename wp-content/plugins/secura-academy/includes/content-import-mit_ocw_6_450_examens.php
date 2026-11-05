<?php
/**
 * Questions importees — MIT OpenCourseWare — 6.450 Principles of Digital Communications I (Fall 2006)
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 6.450 Principles of Digital Communications I, Fall 2006
 */
if ( ! function_exists( 'seca_import_mit_ocw_6_450_examens' ) ) {
	function seca_import_mit_ocw_6_450_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-6-450-examens', 'nom' => 'MIT OpenCourseWare — 6.450 Principles of Digital Communications I (Fall 2006)', 'url' => 'https://ocw.mit.edu/courses/6-450-principles-of-digital-communications-i-fall-2006/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.450 Principles of Digital Communications I, Fall 2006'),
			'rooms' => array(
				'les-fondamentaux-du-reseau' => array(
					'title' => 'les-fondamentaux-du-reseau',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 6.450 — question d’examen, en anglais]
Show that a Huﬀman code can be rearranged, with no loss in expected length, into a
code for which the “binary decimal” numbers associated with the code words are increasing
with decreasing code word probabilities.', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Any set of code word length that satisﬁes Kraft can be arranged in binary
decimal order. This was shown in lecture 2 when we proved that any set of lengths that
satisﬁed the Kraft inequality could be turned into a preﬁx-free code with those lengths.
It is not in general possible to assign 0’s and 1’s in the Huﬀman construction so as to
achieve this ordering property. As an example look at the Huﬀman code for the symbol
probabilities {.15, .15, .2, .2, .3}.

[Correction officielle MIT : [MIT 6.450 — question d’examen, en anglais]
Show that a Huﬀman code can be rearranged, with no loss in expected length, into a
code for which the “binary decimal” numbers associated with the code words are increasing
with decreasing code word probabilities.]', 'source' => 'MIT OpenCourseWare, 6.450 Principles of Digital Communications I, Fall 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.450 Principles of Digital Communications I, Fall 2006', 'answer' => '[MIT 6.450 — question d’examen, en anglais]
Show that a Huﬀman code can be rearranged, with no loss in expected length, into a
code for which the “binary decimal” numbers associated with the code words are increasing
with decreasing code word probabilities.', '_recupere_le' => '2026-11-04T19:55:22.741966+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Any set of code word length that satisﬁes Kraft can be arranged in binary
decimal order. This was shown in lecture 2 when we proved that any set of lengths that
satisﬁed the')),
							array('question' => '[MIT 6.450 — question d’examen, en anglais]
Let βm = Mm /2m be the fraction of nodes at length m that are leaf nodes. Show that
βm       2δm
≤
1 − βm   1 − δm', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : Combining parts (d) and (e), we have
Mm qm   Mm (1 − δm )
δm ≥         ≥
2      2(2m − Mm )
With the substitution βm = Mm /2m , this becomes
βm qm   βm (1 − δm )
δm ≥         ≥
2      2(1 − βm )
which, on rearrangement, is what is to be proven.
Cite as: Robert Gallager, course materials for 6.450 Principles of Digital Communications I, Fall 2006.
(
3

[Correction officielle MIT : [MIT 6.450 — question d’examen, en anglais]
Let βm = Mm /2m be the fraction of nodes at length m that are leaf nodes. Show that
βm       2δm
≤
1 − βm   1 − δm]', 'source' => 'MIT OpenCourseWare, 6.450 Principles of Digital Communications I, Fall 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.450 Principles of Digital Communications I, Fall 2006', 'answer' => '[MIT 6.450 — question d’examen, en anglais]
Let βm = Mm /2m be the fraction of nodes at length m that are leaf nodes. Show that
βm       2δm
≤
1 − βm   1 − δm', '_recupere_le' => '2026-11-04T19:55:22.742038+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : Combining parts (d) and (e), we have
Mm qm   Mm (1 − δm )
δm ≥         ≥
2      2(2m − Mm )
With the substitution βm = Mm /2m , this becomes
βm qm   βm (1 − δm )
δm ≥')),
							array('question' => '[MIT 6.450 — question d’examen, en anglais]
Assume that r2 /A is extremely small and approximate the probability in (b) as e−M g(r)
for the appropriate function g(r).', 'mode' => 'text', 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'xp' => 20, 'explanation' => 'Corrigé officiel du MIT : For any ε > 0, (1 − ε)M = eM ln(1−ε) . For ε very small, ln(1 − ε) ≈ ε, so
(1 − ε)M ≈ e−M ε . Using πr2 /A for ε, this becomes
2
(1 − πr2 /A)M ≈ e−M πr /A

[Correction officielle MIT : [MIT 6.450 — question d’examen, en anglais]
Assume that r2 /A is extremely small and approximate the probability in (b) as e−M g(r)
for the appropriate function g(r).]', 'source' => 'MIT OpenCourseWare, 6.450 Principles of Digital Communications I, Fall 2006', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 6.450 Principles of Digital Communications I, Fall 2006', 'answer' => '[MIT 6.450 — question d’examen, en anglais]
Assume that r2 /A is extremely small and approximate the probability in (b) as e−M g(r)
for the appropriate function g(r).', '_recupere_le' => '2026-11-04T19:55:22.742102+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel du MIT : For any ε > 0, (1 − ε)M = eM ln(1−ε) . For ε very small, ln(1 − ε) ≈ ε, so
(1 − ε)M ≈ e−M ε . Using πr2 /A for ε, this becomes
2
(1 − πr2 /A)M ≈ e−M πr /A

[Correction offici')),
						),
					),
				),
			),
		);
	}
}
